<?php
/**
 * Funções e definições do tema filho O Pacto de 1 Bilhão Child
 *
 * @package OPactoDe1BilhaoChild
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enfileira os estilos do tema pai e do tema filho
 */
function pacto_child_enqueue_styles() {
    wp_enqueue_style(
        'pacto-parent-style',
        get_template_directory_uri() . '/style.css',
        array('pacto-fonts'),
        defined('PACTO_THEME_VERSION') ? PACTO_THEME_VERSION : '2.1.0'
    );

    wp_enqueue_style(
        'pacto-child-style',
        get_stylesheet_uri(),
        array('pacto-parent-style'),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'pacto_child_enqueue_styles', 20);

/**
 * Adicione suas funções personalizadas, filtros e hooks do WooCommerce abaixo.
 * Exemplo: customizar textos de botões, adicionar novos campos ou integrar novos gateways.
 */
