<?php
/**
 * O Pacto de 1 Bilhão — Theme Functions & WooCommerce Integration
 *
 * @package OPactoDe1Bilhao
 * @version 2.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('PACTO_THEME_VERSION', '2.1.0');
define('PACTO_THEME_DIR', get_template_directory());
define('PACTO_THEME_URI', get_template_directory_uri());

/**
 * 1. Suporte do Tema e Configurações Iniciais
 */
function pacto_setup() {
    // Suporte a traduções
    load_theme_textdomain('o-pacto-de-1-bilhao', PACTO_THEME_DIR . '/languages');

    // Suporte a título dinâmico da página
    add_theme_support('title-tag');

    // Suporte a imagens destacadas
    add_theme_support('post-thumbnails');

    // Suporte a logotipo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Suporte a tags HTML5 semânticas
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    // Menus de navegação
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'o-pacto-de-1-bilhao'),
        'footer'  => __('Menu Rodapé', 'o-pacto-de-1-bilhao'),
        'legal'   => __('Menu Páginas Legais', 'o-pacto-de-1-bilhao'),
    ));

    // =========================================================================
    // Suporte Nativo Completo ao WooCommerce
    // =========================================================================
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 450,
        'single_image_width'    => 800,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 6,
            'default_columns' => 3,
            'min_columns'     => 1,
            'max_columns'     => 4,
        ),
    ));

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'pacto_setup');

/**
 * 2. Enfileiramento de Scripts e Estilos
 */
function pacto_scripts() {
    // Fontes Oficiais: DM Sans, Libre Baskerville e Source Serif 4
    wp_enqueue_style(
        'pacto-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400;1,700&family=Source+Serif+4:ital,opsz,wght@1,8..60,300&display=swap',
        array(),
        null
    );

    // Estilo Principal do Tema (style.css)
    wp_enqueue_style(
        'pacto-style',
        get_stylesheet_uri(),
        array('pacto-fonts'),
        PACTO_THEME_VERSION
    );

    // Script Principal do Tema (script.js)
    wp_enqueue_script(
        'pacto-script',
        PACTO_THEME_URI . '/script.js',
        array(),
        PACTO_THEME_VERSION,
        true
    );

    // Dados dinâmicos do WooCommerce passados para o JavaScript
    $id_fisico  = get_theme_mod('pacto_produto_fisico_id', 101);
    $id_digital = get_theme_mod('pacto_produto_digital_id', 102);

    $checkout_url = function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/');
    $cart_url     = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/carrinho/');

    wp_localize_script('pacto-script', 'pactoData', array(
        'ajaxUrl'           => admin_url('admin-ajax.php'),
        'checkoutUrl'       => $checkout_url,
        'cartUrl'           => $cart_url,
        'produtoFisicoId'   => $id_fisico,
        'produtoDigitalId'  => $id_digital,
        'currencySymbol'    => function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : 'R$',
        'directToCheckout'  => get_theme_mod('pacto_direct_checkout', '1'),
    ));

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'pacto_scripts');

/**
 * 3. Painel de Customização do WordPress (WP Customizer)
 * Permite ao administrador alterar IDs dos produtos, links e dados da loja sem mexer no código.
 */
function pacto_customize_register($wp_customize) {
    // Seção Principal da Loja & Livro
    $wp_customize->add_section('pacto_woocommerce_section', array(
        'title'       => __('O Pacto de 1 Bilhão — Loja & Produtos', 'o-pacto-de-1-bilhao'),
        'priority'    => 30,
        'description' => __('Configure os IDs dos produtos WooCommerce e links da página oficial de vendas.', 'o-pacto-de-1-bilhao'),
    ));

    // ID do Produto Físico
    $wp_customize->add_setting('pacto_produto_fisico_id', array(
        'default'           => 101,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('pacto_produto_fisico_id', array(
        'label'       => __('ID do Produto Físico (WooCommerce)', 'o-pacto-de-1-bilhao'),
        'description' => __('Insira o ID numérico do produto físico cadastrado no WooCommerce.', 'o-pacto-de-1-bilhao'),
        'section'     => 'pacto_woocommerce_section',
        'type'        => 'number',
    ));

    // ID do Produto Digital (E-book)
    $wp_customize->add_setting('pacto_produto_digital_id', array(
        'default'           => 102,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('pacto_produto_digital_id', array(
        'label'       => __('ID do Produto Digital (WooCommerce)', 'o-pacto-de-1-bilhao'),
        'description' => __('Insira o ID numérico do produto e-book digital cadastrado no WooCommerce.', 'o-pacto-de-1-bilhao'),
        'section'     => 'pacto_woocommerce_section',
        'type'        => 'number',
    ));

    // Link Externo Amazon Kindle
    $wp_customize->add_setting('pacto_link_amazon', array(
        'default'           => 'https://www.amazon.com.br',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('pacto_link_amazon', array(
        'label'       => __('Link da Edição Amazon Kindle', 'o-pacto-de-1-bilhao'),
        'description' => __('URL de compra direta da edição oficial na Amazon.', 'o-pacto-de-1-bilhao'),
        'section'     => 'pacto_woocommerce_section',
        'type'        => 'url',
    ));

    // Redirecionamento Direto para o Checkout (High-Conversion CRO)
    $wp_customize->add_setting('pacto_direct_checkout', array(
        'default'           => '1',
        'sanitize_callback' => 'pacto_sanitize_checkbox',
    ));
    $wp_customize->add_control('pacto_direct_checkout', array(
        'label'       => __('Redirecionar direto para o Checkout ao Comprar', 'o-pacto-de-1-bilhao'),
        'description' => __('Pula a tela de carrinho e leva o cliente direto para o pagamento seguro.', 'o-pacto-de-1-bilhao'),
        'section'     => 'pacto_woocommerce_section',
        'type'        => 'checkbox',
    ));

    // WhatsApp para Suporte
    $wp_customize->add_setting('pacto_whatsapp', array(
        'default'           => '5511999999999',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pacto_whatsapp', array(
        'label'       => __('WhatsApp de Suporte (com DDI e DDD)', 'o-pacto-de-1-bilhao'),
        'section'     => 'pacto_woocommerce_section',
        'type'        => 'text',
    ));

    // E-mail de Suporte
    $wp_customize->add_setting('pacto_email_suporte', array(
        'default'           => 'contato@opactode1bilhao.com.br',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('pacto_email_suporte', array(
        'label'       => __('E-mail Oficial de Atendimento', 'o-pacto-de-1-bilhao'),
        'section'     => 'pacto_woocommerce_section',
        'type'        => 'email',
    ));
}
add_action('customize_register', 'pacto_customize_register');

function pacto_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? '1' : '0');
}

/**
 * 4. Otimização de Conversão WooCommerce (CRO)
 * Redirecionamento direto ao checkout quando configurado.
 */
function pacto_add_to_cart_redirect($url) {
    if (get_theme_mod('pacto_direct_checkout', '1') === '1' && function_exists('wc_get_checkout_url')) {
        return wc_get_checkout_url();
    }
    return $url;
}
add_filter('woocommerce_add_to_cart_redirect', 'pacto_add_to_cart_redirect');

/**
 * 5. Helpers para Resgate de Informações de Produtos WooCommerce
 */
function pacto_get_product_info($product_id, $fallback_price = '59,00', $fallback_regular = '69,00') {
    $info = array(
        'price'        => $fallback_price,
        'regular_price'=> $fallback_regular,
        'is_on_sale'   => false,
        'in_stock'     => true,
        'checkout_url' => '?add-to-cart=' . $product_id,
    );

    if (function_exists('wc_get_product')) {
        $product = wc_get_product($product_id);
        if ($product) {
            $info['price'] = number_format((float)$product->get_price(), 2, ',', '.');
            if ($product->is_on_sale()) {
                $info['is_on_sale'] = true;
                $info['regular_price'] = number_format((float)$product->get_regular_price(), 2, ',', '.');
            }
            $info['in_stock'] = $product->is_in_stock();

            $checkout = wc_get_checkout_url();
            $info['checkout_url'] = $checkout ? add_query_arg('add-to-cart', $product_id, $checkout) : '?add-to-cart=' . $product_id;
        }
    }

    return $info;
}

/**
 * 6. Fragmento AJAX para atualizar a contagem do carrinho em tempo real
 */
function pacto_cart_count_fragments($fragments) {
    if (!function_exists('WC')) return $fragments;
    $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    $fragments['span.pacto-cart-count'] = '<span class="pacto-cart-count">' . esc_html($count) . '</span>';
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'pacto_cart_count_fragments');

/**
 * 7. Wrappers de Layout do WooCommerce para integrar ao design editorial
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

function pacto_woocommerce_wrapper_before() {
    echo '<div class="pacto-woo-container"><div class="site-container">';
}
add_action('woocommerce_before_main_content', 'pacto_woocommerce_wrapper_before', 10);

function pacto_woocommerce_wrapper_after() {
    echo '</div></div>';
}
add_action('woocommerce_after_main_content', 'pacto_woocommerce_wrapper_after', 10);
