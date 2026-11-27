<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">
  <meta name="theme-color" content="#0a1d2f">
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri() . '/favicon-32x32.png'); ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri() . '/favicon-16x16.png'); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri() . '/apple-touch-icon.png'); ?>">
  <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/favicon.ico'); ?>">
  <link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri() . '/favicon.ico'); ?>">

  <!-- Open Graph -->
  <meta property="og:type" content="book">
  <meta property="og:title" content="<?php echo esc_attr(wp_get_document_title()); ?>">
  <meta property="og:description" content="O Pacto de 1 Bilhão — uma leitura sobre visão, poder e transformação, disponível em edição física e digital.">
  <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri() . '/editorial_autor_livro.png'); ?>">
  <meta property="og:locale" content="pt_BR">
  <meta property="og:site_name" content="O Pacto de 1 Bilhão">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- BARRA DE ANÚNCIO / TOPO EXCLUSIVO -->
  <header class="top-nav" role="banner">
    <div class="top-nav__container">
      <div class="top-nav__brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-link" aria-label="Ir para a página inicial">
          <span class="brand-title">O PACTO DE 1 BILHÃO</span>
          <span class="brand-author">SALIH ABDULATIF</span>
        </a>
      </div>

      <nav class="top-nav__menu" aria-label="Navegação principal">
        <?php
        if (has_nav_menu('primary')) {
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-list',
                'fallback_cb'    => false,
            ));
        } else {
        ?>
        <ul class="nav-list">
          <li><a href="<?php echo esc_url(home_url('/#livro')); ?>">O Livro</a></li>
          <li><a href="<?php echo esc_url(home_url('/#sobre')); ?>">O Autor</a></li>
          <li><a href="<?php echo esc_url(home_url('/#depoimentos')); ?>">Depoimentos</a></li>
          <li><a href="<?php echo esc_url(home_url('/#edicoes')); ?>" class="nav-highlight">Comprar</a></li>
        </ul>
        <?php } ?>
      </nav>

      <div class="top-nav__actions">
        <?php if (function_exists('WC') && WC()->cart) : ?>
          <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="pacto-header-cart" title="Ver carrinho de compras">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="9" cy="21" r="1"></circle>
              <circle cx="20" cy="21" r="1"></circle>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="pacto-cart-count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
          </a>
        <?php endif; ?>
        <a href="<?php echo esc_url(home_url('/#edicoes')); ?>" class="top-nav__cta">
          Garantir Exemplar ↗
        </a>
      </div>
    </div>
  </header>
