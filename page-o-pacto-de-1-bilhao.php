<?php
/**
 * Template Name: Landing Page - O Pacto de 1 Bilhão
 * Description: Template editorial de alta conversão para o livro "O Pacto de 1 Bilhão", baseado no projeto oficial de design editorial com suporte nativo a WooCommerce.
 * Version: 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Configurações dos IDs dos produtos no WooCommerce
$id_produto_fisico  = apply_filters('pacto_produto_fisico_id', 101);
$id_produto_digital = apply_filters('pacto_produto_digital_id', 102);
$id_produto_amazon  = apply_filters('pacto_produto_amazon_id', 103);

// Valores padrão editáveis (Promoção de Lançamento)
$preco_de_fisico  = '69,00';
$preco_fisico     = '59,00';
$preco_de_digital = '39,00';
$preco_digital    = '29,00';
$preco_de_amazon  = '39,00';
$preco_amazon     = '29,00';

$link_compra_fisico  = '?add-to-cart=' . $id_produto_fisico;
$link_compra_digital = '?add-to-cart=' . $id_produto_digital;
$link_compra_amazon  = apply_filters('pacto_link_amazon', 'https://www.amazon.com.br');

if (function_exists('wc_get_product')) {
    $prod_fisico = wc_get_product($id_produto_fisico);
    if ($prod_fisico) {
        $preco_fisico = number_format((float)$prod_fisico->get_price(), 2, ',', '.');
        $link_compra_fisico = wc_get_checkout_url() ? add_query_arg('add-to-cart', $id_produto_fisico, wc_get_checkout_url()) : '?add-to-cart=' . $id_produto_fisico;
    }

    $prod_digital = wc_get_product($id_produto_digital);
    if ($prod_digital) {
        $preco_digital = number_format((float)$prod_digital->get_price(), 2, ',', '.');
        $link_compra_digital = wc_get_checkout_url() ? add_query_arg('add-to-cart', $id_produto_digital, wc_get_checkout_url()) : '?add-to-cart=' . $id_produto_digital;
    }
}

$template_uri = get_stylesheet_directory_uri();
$asset_hero   = file_exists(get_stylesheet_directory() . '/hero_autor_livro.png') ? $template_uri . '/hero_autor_livro.png' : $template_uri . '/assets/images/hero_autor_livro.png';
$asset_hero_mobile = file_exists(get_stylesheet_directory() . '/hero_autor_livro_mobile.jpg') ? $template_uri . '/hero_autor_livro_mobile.jpg' : $asset_hero;
$asset_hero_slide2 = file_exists(get_stylesheet_directory() . '/hero_slide_2.webp') ? $template_uri . '/hero_slide_2.webp' : (file_exists(get_stylesheet_directory() . '/hero_slide_2.jpg') ? $template_uri . '/hero_slide_2.jpg' : $template_uri . '/assets/images/hero_slide_2.webp');
$asset_editorial = file_exists(get_stylesheet_directory() . '/editorial_autor_livro.png') ? $template_uri . '/editorial_autor_livro.png' : $template_uri . '/assets/images/editorial_autor_livro.png';
$asset_pb2 = file_exists(get_stylesheet_directory() . '/PB2.png') ? $template_uri . '/PB2.png' : $template_uri . '/assets/images/PB2.png';
$asset_pb3 = file_exists(get_stylesheet_directory() . '/PB3.png') ? $template_uri . '/PB3.png' : $template_uri . '/assets/images/PB3.png';
$asset_capa_oficial = file_exists(get_stylesheet_directory() . '/capa_livro_oficial.jpg') ? $template_uri . '/capa_livro_oficial.jpg' : $template_uri . '/assets/images/capa_livro_oficial.jpg';
$asset_capa_digital = file_exists(get_stylesheet_directory() . '/capa_digital_oficial.jpg') ? $template_uri . '/capa_digital_oficial.jpg' : $template_uri . '/assets/images/capa_digital_oficial.jpg';
$asset_capa_kindle  = file_exists(get_stylesheet_directory() . '/capa_kindle_oficial.jpg') ? $template_uri . '/capa_kindle_oficial.jpg' : $template_uri . '/assets/images/capa_kindle_oficial.jpg';
$asset_logo = file_exists(get_stylesheet_directory() . '/logo_o_pacto_de_1_bilhao.png') ? $template_uri . '/logo_o_pacto_de_1_bilhao.png' : $template_uri . '/assets/images/logo_o_pacto_de_1_bilhao.png';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">
  <meta name="theme-color" content="#0a1d2f">
  <title><?php wp_title('|', true, 'right'); ?> O Pacto de 1 Bilhão — Por Salih Abdulatif</title>
  
  <meta name="description" content="O Pacto de 1 Bilhão — uma leitura sobre visão, poder e transformação, disponível em edição física e digital.">
  <meta property="og:type" content="book">
  <meta property="og:title" content="O Pacto de 1 Bilhão — Por Salih Abdulatif">
  <meta property="og:description" content="Uma leitura para quem quer ampliar a própria visão sobre dinheiro, poder e as grandes viradas da vida.">
  <meta property="og:image" content="<?php echo esc_url($asset_hero); ?>">
  <meta property="og:locale" content="pt_BR">
  <meta property="og:site_name" content="O Pacto de 1 Bilhão">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo esc_url($template_uri . '/style.css?v=12.79'); ?>">

  <?php wp_head(); ?>
</head>
<body <?php body_class('editorial-landing-page'); ?>>
  <div class="site-shell">



    <!-- CABEÇALHO -->
    <header class="site-header shell-container" aria-label="Navegação principal">
      <nav class="desktop-nav" aria-label="Navegação da página">
        <a href="#livro">O livro</a>
        <a href="#autor">O autor</a>
        <a href="#temas">Capítulos</a>
        <a href="#compra">Edições</a>
        <a href="#faq">Dúvidas</a>
      </nav>
      <button class="header-cta" id="btn-header-cta">Comprar com desconto agora <span>↗</span></button>
    </header>

    <main>
      <!-- 2. HERO PRINCIPAL & SLIDER (2 BANNERS) -->
      <section class="hero hero-slider" id="inicio" data-section="hero" aria-roledescription="carousel" aria-label="Apresentação da Obra">
        
        <!-- BACKGROUNDS EM CROSSFADE -->
        <div class="hero-slider__backgrounds" aria-hidden="true">
          <!-- Slide 1 Background (LANÇAMENTO - Retrato Editorial) -->
          <div class="hero-slider__bg-slide is-active" data-slide="0">
            <img 
              class="hero-bg-img" 
              src="<?php echo esc_url($asset_hero_slide2); ?>" 
              alt="Salih Abdulatif em retrato editorial exclusivo" 
              width="1024" 
              height="576" 
              fetchpriority="high"
            >
            <div class="hero-bg-overlay hero-bg-overlay--slide2"></div>
          </div>

          <!-- Slide 2 Background (O Pacto de 1 Bilhão - Livro) -->
          <div class="hero-slider__bg-slide" data-slide="1">
            <picture>
              <source media="(max-width: 720px)" srcset="<?php echo esc_url($asset_hero_mobile); ?>">
              <img 
                class="hero-bg-img" 
                src="<?php echo esc_url($asset_hero); ?>" 
                alt="Salih Abdulatif segurando o livro O Pacto de 1 Bilhão" 
                width="2560" 
                height="1440" 
                loading="lazy"
              >
            </picture>
            <div class="hero-bg-overlay"></div>
          </div>
        </div>

        <div class="shell-container hero__grid">
          
          <div class="hero-slider__content-wrap">
            
            <!-- Slide 1 Conteúdo (LANÇAMENTO) -->
            <div class="hero__copy hero-slide-item hero-slide-item--lancamento is-active" data-slide="0" role="group" aria-roledescription="slide" aria-label="Banner 1 de 2: Bastidores de Quem Decide Permanecer">
              <p class="eyebrow">
                <span aria-hidden="true"></span> Bastidores de quem decide permanecer
              </p>
              <h1 class="hero-slide-title" aria-label="LANÇAMENTO">LANÇAMENTO</h1>
              <p class="hero-subtitle">
                Uma imersão nos bastidores das grandes negociações e nas decisões silenciosas que constroem uma grande virada.
              </p>
              <blockquote class="hero-quote">
                <p class="hero-quote__text">“Sei exatamente quem sou com um milhão de dólares na conta.<br class="br-desktop">E sei exatamente quem sou com um milhão de dólares em dívidas.”</p>
                <cite class="hero-quote__author">— Salih Abdulatif</cite>
              </blockquote>
              <div class="hero-meta">
                <span class="meta-lock" aria-hidden="true">⌁</span>
                <span>Biografia e Princípios • Edição Oficial Salih Abdulatif</span>
              </div>
            </div>

            <!-- Slide 2 Conteúdo (O Pacto de 1 Bilhão) -->
            <div class="hero__copy hero-slide-item hero-slide-item--pacto" data-slide="1" role="group" aria-roledescription="slide" aria-label="Banner 2 de 2: O Pacto de 1 Bilhão">
              <p class="eyebrow">
                <span aria-hidden="true"></span> Um livro sobre visão, poder e transformação
              </p>
              <h2 class="hero-title--typewriter" aria-label="O Pacto de 1 Bilhão">
                <span class="hero-title-line hero-title-line--1">O Pacto de</span><br><em class="hero-title-line hero-title-line--2">1 Bilhão</em>
              </h2>
              <p class="hero-subtitle">
                Uma leitura para quem quer ampliar a própria visão sobre dinheiro, poder e as grandes viradas da vida.
              </p>
              <div class="hero-actions">
                <button class="button button--gold" id="btn-hero-primary" data-track="cta_hero_primary">
                  Comprar agora <span>↗</span>
                </button>
                <a class="text-link" href="#livro" id="btn-hero-secondary" data-track="cta_hero_secondary">
                  Conhecer o livro <span>↓</span>
                </a>
              </div>
              <div class="hero-meta">
                <span class="meta-lock" aria-hidden="true">⌁</span>
                <span>Pagamento seguro • Checkout protegido • Acesso conforme a opção escolhida</span>
              </div>
            </div>

          </div>

          <div class="hero__visual-space" aria-hidden="true"></div>

        </div>

        <!-- CONTROLES DO SLIDER (01 / 02) -->
        <div class="hero-slider__controls" aria-label="Navegação dos banners">
          <div class="hero-slider__dots" role="tablist">
            <button class="hero-slider__dot is-active" data-slide-to="0" role="tab" aria-selected="true" aria-label="Banner 1">
              <span class="dot-num">01</span>
              <span class="dot-bar"><span class="dot-progress"></span></span>
            </button>
            <button class="hero-slider__dot" data-slide-to="1" role="tab" aria-selected="false" aria-label="Banner 2">
              <span class="dot-num">02</span>
              <span class="dot-bar"><span class="dot-progress"></span></span>
            </button>
          </div>
        </div>

        <a class="hero-scroll" href="#livro" aria-label="Descer para o livro">
          <span>Scroll para explorar</span>
          <i aria-hidden="true"></i>
        </a>
      </section>

      <!-- 3. POR QUE ESTE LIVRO? -->
      <section class="section section--light why" id="livro" data-section="book-value">
        <div class="shell-container">
          <div class="section-heading section-heading--split" data-reveal>
            <div>
              <span class="section-index">01 — POR QUE ESTE LIVRO?</span>
              <h2>Uma obra para<br class="br-why-tablet"> levar<br class="br-why-desktop"> consigo<br class="br-why-tablet"> <em>além da<br>primeira leitura.</em></h2>
            </div>
            <div class="section-heading__desc">
              <p>
                Mais do que um livro, esta é uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam uma grande virada. A obra convida o leitor a enxergar novas possibilidades com mais clareza, intenção e responsabilidade.
              </p>
              <p>
                Uma trajetória marcada por altos e baixos, desafios superados e uma busca constante pelo crescimento.
              </p>
            </div>
          </div>
          <div class="why__body">
            <div class="book-still" data-reveal id="book-still-interactive">
              <img 
                src="<?php echo esc_url($asset_pb2); ?>" 
                alt="Livro O Pacto de 1 Bilhão por Salih Abdulatif — Edição Oficial em 3D" 
                class="book-still__img"
                id="book-still-img"
              />
            </div>
            <div class="why-list" data-reveal>
              <div class="why-list__item">
                <b>01</b>
                <p>Uma leitura para ampliar sua perspectiva.</p>
              </div>
              <div class="why-list__item">
                <b>02</b>
                <p>Para quem busca uma nova estratégia sobre crescimento e realização.</p>
              </div>
              <div class="why-list__item">
                <b>03</b>
                <p>Conteúdo para revisitar e aplicar ao longo do tempo.</p>
              </div>
              <div class="why-list__item">
                <b>04</b>
                <p>Para quem valoriza histórias, aprendizados<br>e decisões que deixam marca.</p>
              </div>
              <div class="why-social" aria-label="Redes Sociais">
                <span class="why-social__title">Nossas Mídias —</span>
                <div class="why-social__icons">
                  <a href="https://www.tiktok.com" target="_blank" rel="noopener noreferrer" class="why-social__link" aria-label="TikTok">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.89 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1v-3.52a6.37 6.37 0 0 0-.79-.05A6.34 6.34 0 0 0 3 15.67 6.34 6.34 0 0 0 9.34 22a6.34 6.34 0 0 0 6.34-6.33V9.05c1.23.86 2.72 1.36 4.33 1.41V7.01a4.84 4.84 0 0 1-.42-.32z"/></svg>
                  </a>
                  <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="why-social__link" aria-label="YouTube">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                  </a>
                  <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="why-social__link" aria-label="Instagram">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                  </a>
                  <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="why-social__link" aria-label="Facebook">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 5. AUTORIDADE DO AUTOR -->
      <section class="section author" id="autor" data-section="author">
        <div class="shell-container author__grid">
          <div class="author__visual" data-reveal>
            <div class="asset-frame asset-frame--author is-loaded">
              <img 
                class="client-asset" 
                src="<?php echo esc_url($asset_editorial); ?>" 
                alt="Salih Abdulatif em composição editorial segurando edições do livro" 
                width="1664" 
                height="2080"
                loading="lazy"
              >
            </div>
          </div>
          <div class="author__copy" data-reveal>
            <div class="author__title-group">
              <span class="section-index">02 — A HISTÓRIA POR TRÁS DA OBRA</span>
              <h2>A palavra ganha peso quando carrega uma <em>trajetória.</em></h2>
            </div>
            <div class="author__desc-group">
              <p class="author__lead">
                Salih Abdulatif é um empresário brasileiro e turco que se orgulha das duas nacionalidades. Nasceu numa roça em Rondônia, foi criado pelo avô libanês e começou a trabalhar aos 12 anos de idade. Aprendeu árabe e outros três idiomas quase por acidente, sem nunca ter entrado em uma universidade formal.
              </p>
              <p class="author__lead" style="margin-top: 1rem;">
                Em sua jornada, abriu 23 empresas em nove países, conhecendo tanto a geração de grandes volumes quanto o peso de perdas completas. Falido cinco vezes e com dívidas acumuladas aos 40 anos, começou a escrever este livro para relatar o seu pacto de um bilhão. Casado e pai de três filhos, vive entre Istambul, Dubai e o Rio de Janeiro.
              </p>
              <div class="author__line" aria-hidden="true"></div>
              <p class="author__caption">
                “Um homem que já morreu uma vez não tem mais medo de quase nada.” — Salih Abdulatif
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- FAIXA ROTATIVA / MARQUEE TICKER -->
      <aside class="marquee-ticker" role="region" aria-label="Mensagem em destaque">
        <div class="marquee-ticker__inner" aria-hidden="true">
          <div class="marquee-ticker__track">
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
          </div>
          <div class="marquee-ticker__track">
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
            <span class="marquee-ticker__item">Uma oportunidade de parar, observar o próprio caminho e rever as decisões que moldam a sua <em>grande virada.</em> <span class="marquee-ticker__sep">◆</span></span>
          </div>
        </div>
      </aside>

      <!-- 6. O QUE O LEITOR ENCONTRARÁ -->
      <section class="section section--navy topics" id="temas" data-section="topics">
        <div class="topics-ambient" aria-hidden="true"></div>
        <div class="shell-container">
          <div class="section-heading section-heading--topics" data-reveal>
            <div>
              <span class="section-index">03 — O QUE O LEITOR ENCONTRARÁ</span>
              <h2>Uma jornada em<br><em>cinco movimentos.</em></h2>
            </div>
            <div class="section-heading__desc">
              <p>
                Uma narrativa estruturada em torno dos dilemas fundamentais de quem decide persistir diante dos cenários mais improváveis.
              </p>
              <p class="editorial-quote">
                <em>“Perdi tudo cinco vezes. Depois da última, fiz um pacto.”</em> <span class="quote-author">— Salih Abdulatif</span>
              </p>
            </div>
          </div>
          <div class="topic-list">
            <div class="topic-row" data-reveal>
              <span class="topic-number">01</span>
              <h3>O Ponto de Ruptura</h3>
              <p>A desconstrução de certezas antigas e a compreensão exata do momento em que recuar não é mais uma alternativa.</p>
              <span class="topic-arrow" aria-hidden="true">↗</span>
            </div>
            <div class="topic-row" data-reveal>
              <span class="topic-number">02</span>
              <h3>A Travessia das Adversidades</h3>
              <p>Os bastidores reais e silenciosos de quem já faliu, perdeu tudo e teve de reconstruir a própria reputação e clareza do zero.</p>
              <span class="topic-arrow" aria-hidden="true">↗</span>
            </div>
            <div class="topic-row" data-reveal>
              <span class="topic-number">03</span>
              <h3>Visão, Dinheiro e Poder</h3>
              <p>Uma abordagem madura e livre de romantismo sobre o papel dos recursos materiais, a ambição equilibrada e a responsabilidade das escolhas.</p>
              <span class="topic-arrow" aria-hidden="true">↗</span>
            </div>
            <div class="topic-row" data-reveal>
              <span class="topic-number">04</span>
              <h3>O Pacto e os Princípios</h3>
              <p>As diretrizes e compromissos internos que impedem um líder de negociar sua dignidade e seu foco nas fases mais exigentes.</p>
              <span class="topic-arrow" aria-hidden="true">↗</span>
            </div>
            <div class="topic-row" data-reveal>
              <span class="topic-number">05</span>
              <h3>O Próximo Capítulo</h3>
              <p>Como transformar cicatrizes e aprendizados acumulados em sabedoria prática para construir uma história digna de ser contada.</p>
              <span class="topic-arrow" aria-hidden="true">↗</span>
            </div>
          </div>
        </div>
      </section>

      <!-- 7. ESCOLHA SUA EDIÇÃO (WooCommerce) -->
      <section class="section editions" id="compra" data-section="purchase">
        <div class="shell-container">
          <div class="section-heading section-heading--purchase" data-reveal>
            <div>
              <span class="section-index">04 — ESCOLHA SUA EDIÇÃO</span>
              <h2>Leve esta leitura<br><em>para o seu próximo capítulo.</em></h2>
            </div>
            <p>
              Falido pela quinta vez, devendo um milhão de dólares, um homem faz um pacto com Deus. Sete cláusulas. A última delas: <strong style="color: #92774a; font-weight: 700;">um bilhão de dólares</strong>. O que ele ofereceu em troca, se recusa a revelar. Para chegar até ali, saiu de uma roça no interior de Rondônia para <strong style="color: #92774a; font-weight: 700;">Dubai</strong> e Istambul, abriu <strong style="color: #92774a; font-weight: 700;">vinte e três empresas</strong>, ganhou fortunas e perdeu todas. Este não é um livro sobre como alguém ficou rico. É o registro, em tempo real, de alguém tentando. E ninguém, nem mesmo ele, sabe ainda como termina.
            </p>
          </div>
          <div class="edition-grid" id="edicoes">
            
            <!-- Edição 01: Livro Digital -->
            <article class="edition-card edition-card--digital edition-card--reveal-left" data-edition="digital" data-reveal="left" id="card-edicao-digital">
              <div class="edition-card__top">
                <span class="edition-format">DIGITAL</span>
              </div>
              <div class="edition-card__visual">
                <div class="digital-sheet">
                  <img src="<?php echo esc_url($asset_capa_digital . '?v=3'); ?>" alt="Edição Digital do livro O Pacto de 1 Bilhão (PDF / EPUB) — Salih Abdulatif" class="digital-sheet__img" width="347" height="500" loading="lazy">
                </div>
                <span class="mini-note">Download instantâneo</span>
              </div>
              <div class="edition-card__content">
                <h3>Livro digital</h3>
                <p>Acesso imediato nos formatos PDF e ePub, otimizado para leitura fluida em Kindle, Kobo, iPad, celular ou computador.</p>
                <div class="edition-pricing">
                  <span class="edition-badge-promo">PROMOÇÃO DE LANÇAMENTO</span>
                  <div class="edition-price-from">De <del>R$ <?php echo esc_html($preco_de_digital); ?></del> por</div>
                  <div class="edition-price">R$ <?php echo esc_html($preco_digital); ?></div>
                  <span class="edition-savings">Economize R$ 10,00</span>
                </div>
                <span class="edition-detail">Entrega: Acesso imediato por e-mail e painel da conta após a confirmação</span>
                <a 
                  href="<?php echo esc_url($link_compra_digital); ?>" 
                  class="button button--green btn--purchase"
                  data-edition="digital"
                >
                  <span>COMPRAR EDIÇÃO DIGITAL</span>
                  <span>↗</span>
                </a>
              </div>
            </article>

            <!-- Edição 02: Livro Físico (Destaque Central) -->
            <article class="edition-card edition-card--featured edition-card--reveal-up" data-edition="physical" data-reveal="up" id="card-edicao-fisica">
              <div class="edition-card__top">
                <span class="edition-format">FÍSICO</span>
              </div>
              <div class="edition-card__visual">
                <div class="mini-book">
                  <img src="<?php echo esc_url($asset_capa_oficial); ?>" alt="Capa oficial do livro O Pacto de 1 Bilhão — Salih Abdulatif" class="mini-book__img" width="711" height="1024" loading="lazy">
                </div>
                <span class="mini-note">Acabamento editorial com orelhas</span>
              </div>
              <div class="edition-card__content">
                <h3>Livro físico</h3>
                <p>Exemplar impresso com capa nobre, papel encorpado de alta gramatura e tipografia confortável para sua estante e biblioteca.</p>
                <div class="edition-pricing">
                  <span class="edition-badge-promo">PROMOÇÃO DE LANÇAMENTO</span>
                  <div class="edition-price-from">De <del>R$ <?php echo esc_html($preco_de_fisico); ?></del> por</div>
                  <div class="edition-price">R$ <?php echo esc_html($preco_fisico); ?></div>
                  <span class="edition-savings">Economize R$ 10,00</span>
                </div>
                <span class="edition-detail">Envio: Envio para todo o Brasil • Frete e prazo calculados no checkout</span>
                <a 
                  href="<?php echo esc_url($link_compra_fisico); ?>" 
                  class="button button--green btn--purchase"
                  data-edition="physical"
                >
                  <span>COMPRAR LIVRO FÍSICO</span>
                  <span>↗</span>
                </a>
              </div>
            </article>

            <!-- Edição 03: Livro Digital na Amazon -->
            <article class="edition-card edition-card--amazon edition-card--reveal-right" data-edition="amazon" data-reveal="right" id="card-edicao-amazon">
              <div class="edition-card__top">
                <span class="edition-format">AMAZON KINDLE</span>
              </div>
              <div class="edition-card__visual">
                <div class="kindle-device">
                  <div class="kindle-screen">
                    <img src="<?php echo esc_url($asset_capa_kindle . '?v=1'); ?>" alt="Capa oficial de O Pacto de 1 Bilhão no Amazon Kindle — Salih Abdulatif" class="kindle-screen__img" width="347" height="500" loading="lazy">
                  </div>
                  <span class="kindle-brand">amazon kindle</span>
                </div>
                <span class="mini-note">Disponível na Amazon Brasil</span>
              </div>
              <div class="edition-card__content">
                <h3>Livro digital na Amazon</h3>
                <p>Adquira diretamente na Amazon para ler no seu Kindle ou no aplicativo Kindle em qualquer smartphone, tablet ou computador.</p>
                <div class="edition-pricing">
                  <span class="edition-badge-promo">PROMOÇÃO DE LANÇAMENTO</span>
                  <div class="edition-price-from">De <del>R$ <?php echo esc_html($preco_de_amazon); ?></del> por</div>
                  <div class="edition-price">R$ <?php echo esc_html($preco_amazon); ?></div>
                  <span class="edition-savings">Economize R$ 10,00</span>
                </div>
                <span class="edition-detail">Entrega: Sincronização automática e instantânea na sua conta Amazon Kindle</span>
                <a 
                  href="<?php echo esc_url($link_compra_amazon); ?>" 
                  target="_blank" 
                  rel="noopener noreferrer"
                  class="button button--green btn--purchase btn--amazon"
                  data-edition="amazon"
                >
                  <span>COMPRAR NA AMAZON</span>
                  <span>↗</span>
                </a>
              </div>
            </article>

          </div>
          <p class="purchase-note">
            <span aria-hidden="true">◌</span> Compra processada com total segurança pelo WooCommerce. Checkout protegido por criptografia SSL de 256 bits.
          </p>
        </div>
      </section>

      <!-- 8. PROVA SOCIAL -->
      <section class="section social-proof" data-section="social-proof">
        <div class="shell-container">
          <div class="social-proof__head" data-reveal>
            <div>
              <span class="section-index">05 — PROVA SOCIAL</span>
              <h2>A experiência de<br class="br-sp-tablet"><br class="br-sp-mobile"> quem<br class="br-sp-desktop"> <em>já<br class="br-sp-tablet"> encontrou<br class="br-sp-mobile"> estas<br class="br-sp-tablet"> páginas.</em></h2>
            </div>
            <div class="social-proof__desc">
              <p>Palavras e reflexões autênticas dos primeiros leitores e da síntese editorial oficial da obra.</p>
              <p class="editorial-quote"><em>“Este não é um livro de quem chegou lá. É um livro escrito de dentro do buraco.”</em> <span class="quote-author">— Salih Abdulatif</span></p>
            </div>
          </div>

          <!-- Controles do Carrossel de Leitores -->
          <div class="social-carousel-controls" data-reveal>
            <div class="social-carousel-nav">
              <button type="button" class="carousel-nav-btn carousel-nav-btn--prev" id="social-prev-btn" aria-label="Depoimento anterior">
                <svg width="42" height="14" viewBox="0 0 42 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <line x1="41" y1="7" x2="1" y2="7" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                  <polyline points="6.5 1.5 1 7 6.5 12.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="miter"/>
                </svg>
              </button>
              <button type="button" class="carousel-nav-btn carousel-nav-btn--next" id="social-next-btn" aria-label="Próximo depoimento">
                <svg width="42" height="14" viewBox="0 0 42 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <line x1="1" y1="7" x2="41" y2="7" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/>
                  <polyline points="35.5 1.5 41 7 35.5 12.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="miter"/>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Carrossel em Largura Total (Full Width 100vw) -->
        <div class="social-carousel-fullwidth" data-reveal>
          <div class="social-carousel-fade social-carousel-fade--left" aria-hidden="true"></div>
          <div class="social-carousel-fade social-carousel-fade--right" aria-hidden="true"></div>
          <div class="social-carousel-track" id="social-carousel-track" tabindex="0" role="region" aria-label="Depoimentos de leitores em formato carrossel">
            
            <!-- 01: Lucas Pinheiro (Citação 01) -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80" alt="Lucas Pinheiro" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #0a1d2f, #1e3a5f);">LP</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Lucas Pinheiro</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Ontem às 21:40</span>
                  </div>
                  <div class="chat-bubble">
                    <p>O trecho <em>“um homem que já morreu uma vez não tem mais medo de quase nada”</em> me arrepiou. Que história impactante, comecei ontem à noite e já estou quase no final!</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 02: Rodrigo Silveira (Citação 02) -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?w=100&auto=format&fit=crop&q=80" alt="Rodrigo Silveira" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #1e3a5f, #2563eb);">RS</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Rodrigo Silveira</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Hoje às 10:15</span>
                  </div>
                  <div class="chat-bubble">
                    <p><em>“Perdi tudo cinco vezes. Depois da última, fiz um pacto de sete cláusulas. A última delas: um bilhão de dólares.”</em> A honestidade desse livro é surreal, não tem fórmula mágica. É vida real de quem quebrou e deu a volta por cima.</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 03: Camila Vasconcelos (Citação 03) -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&auto=format&fit=crop&q=80" alt="Camila Vasconcelos" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #7c2d12, #ea580c);">CV</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Camila Vasconcelos</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Hoje às 14:02</span>
                  </div>
                  <div class="chat-bubble">
                    <p><em>“Este não é um livro sobre como alguém ficou rico. É o registro, em tempo real, de alguém tentando. E ninguém sabe ainda como termina.”</em> Que leitura incrível! É um alívio ler algo tão cru e autêntico.</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 04: Mariana Duarte (Exemplo Usuário 1) -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80" alt="Mariana Duarte" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #047857, #10b981);">MD</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Mariana Duarte</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Hoje às 11:28</span>
                  </div>
                  <div class="chat-bubble">
                    <p>O meu livro acabou de chegar aqui em casa e já estou devorando! O acabamento editorial com orelhas e o papel encorpado são impecáveis, parabéns pelo capricho.</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 05: Felipe Menezes (Exemplo Usuário 2) -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="Felipe Menezes" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #4338ca, #6366f1);">FM</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Felipe Menezes</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Ontem às 18:35</span>
                  </div>
                  <div class="chat-bubble">
                    <p>Fiz a compra do livro físico e chegou super rápido. Podem comprar de olhos fechados, entrega nota 10 e o conteúdo é ouro puro!</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 06: Renata Barreto (Exemplo Usuário 3) -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=100&auto=format&fit=crop&q=80" alt="Renata Barreto" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #b91c1c, #f87171);">RB</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Renata Barreto</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Hoje às 16:50</span>
                  </div>
                  <div class="chat-bubble">
                    <p>Esse livro está abrindo minha mente para sair da zona de conforto e cumprir meu propósito. Já fiz várias anotações no primeiro capítulo, virada de chave total!</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 07: Thiago Martins -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&auto=format&fit=crop&q=80" alt="Thiago Martins" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #0f766e, #14b8a6);">TM</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Thiago Martins</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Hoje às 09:12</span>
                  </div>
                  <div class="chat-bubble">
                    <p>Comprei a edição digital pro Kindle ontem de madrugada e não consegui largar até terminar a primeira parte. Visão de negócios e gestão de risco fora da curva!</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 08: Beatriz Nogueira -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Beatriz Nogueira" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #6d28d9, #8b5cf6);">BN</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Beatriz Nogueira</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Há 3 horas</span>
                  </div>
                  <div class="chat-bubble">
                    <p>A história do trabalho na roça aos 12 anos e o avô libanês me emocionou muito. Dá pra sentir a verdade em cada linha escrita. Recomendo demais a leitura!</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 09: Marcelo Fonseca -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&auto=format&fit=crop&q=80" alt="Marcelo Fonseca" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #111827, #374151);">MF</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Marcelo Fonseca</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Há 5 horas</span>
                  </div>
                  <div class="chat-bubble">
                    <p>A clareza sobre como lidar com perdas e recomeçar do zero vale mais do que qualquer MBA. É o livro que todo empreendedor brasileiro precisava ler.</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

            <!-- 10: Juliana Esteves -->
            <div class="chat-card">
              <div class="chat-card__message-row">
                <div class="chat-avatar">
                  <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&auto=format&fit=crop&q=80" alt="Juliana Esteves" loading="lazy" class="chat-avatar__img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <span class="chat-avatar__fallback" style="display:none; background: linear-gradient(135deg, #9d174d, #f43f5e);">JE</span>
                </div>
                <div class="chat-bubble-col">
                  <div class="chat-sender-header">
                    <span class="chat-sender-name">Juliana Esteves</span>
                    <span class="chat-sender-badge">✓ Compra verificada</span>
                    <span class="chat-time">Há 1 hora</span>
                  </div>
                  <div class="chat-bubble">
                    <p>Chegou hoje de manhã aqui no escritório! Mostrei pro meu sócio dar uma olhada e ele já comprou o dele também haha. Podem comprar sem medo!</p>
                  </div>
                </div>
              </div>
              <div class="chat-card__input-bar">
                <span class="chat-cam-btn">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </span>
                <span class="chat-input-placeholder">Mensagem...</span>
                <div class="chat-input-icons">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 13a2.5 2.5 0 0 0 5 0"/></svg>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      <!-- 9. OBJEÇÕES E FAQ -->
      <section class="section faq" id="faq" data-section="faq">
        <div class="shell-container faq__grid">
          <div class="faq__intro" data-reveal>
            <span class="section-index">06 — OBJEÇÕES E FAQ</span>
            <h2>Antes de escolher,<br><em>tire suas dúvidas.</em></h2>
            <p>Respostas transparentes e oficiais sobre o formato, envio e pagamento da sua compra.</p>
            <a href="#rodape">Falar com o suporte <span>↗</span></a>
          </div>
          <div class="faq-list" data-reveal id="faq-list">
            
            <div class="faq-item">
              <button id="faq-button-0" aria-expanded="false" aria-controls="faq-answer-0">
                <span>Qual é a diferença entre a edição física e a digital?</span>
                <i aria-hidden="true">+</i>
              </button>
              <div id="faq-answer-0" role="region" aria-labelledby="faq-button-0" class="faq-answer">
                <p>O conteúdo integral da obra é rigorosamente o mesmo em ambas as versões. A edição física é impressa com acabamento editorial superior, orelhas e papel encorpado de alta gramatura para leitura tátil. A edição digital está disponível nos formatos PDF e ePub, pronta para ser lida instantaneamente em Kindle, Kobo, tablets, smartphones e computadores.</p>
              </div>
            </div>

            <div class="faq-item">
              <button id="faq-button-1" aria-expanded="false" aria-controls="faq-answer-1">
                <span>Como funciona o envio do livro físico?</span>
                <i aria-hidden="true">+</i>
              </button>
              <div id="faq-answer-1" role="region" aria-labelledby="faq-button-1" class="faq-answer">
                <p>O exemplar físico é despachado via correios ou transportadora oficial com código de rastreamento enviado por e-mail. O frete e o prazo exato de entrega para a sua região são calculados diretamente na tela de checkout do WooCommerce antes da confirmação do pagamento.</p>
              </div>
            </div>

            <div class="faq-item">
              <button id="faq-button-2" aria-expanded="false" aria-controls="faq-answer-2">
                <span>Como recebo a edição digital?</span>
                <i aria-hidden="true">+</i>
              </button>
              <div id="faq-answer-2" role="region" aria-labelledby="faq-button-2" class="faq-answer">
                <p>Assim que a confirmação do pagamento for processada, você receberá instantaneamente um e-mail com os links seguros para download nos formatos PDF e ePub, além de ter os arquivos disponíveis em sua área de cliente na loja.</p>
              </div>
            </div>

            <div class="faq-item">
              <button id="faq-button-3" aria-expanded="false" aria-controls="faq-answer-3">
                <span>Quais formas de pagamento estão disponíveis?</span>
                <i aria-hidden="true">+</i>
              </button>
              <div id="faq-answer-3" role="region" aria-labelledby="faq-button-3" class="faq-answer">
                <p>A compra é processada com segurança total via checkout WooCommerce, com suporte a PIX (com liberação imediata), Cartão de Crédito (com parcelamento disponível conforme as condições da loja) e Boleto Bancário.</p>
              </div>
            </div>

            <div class="faq-item">
              <button id="faq-button-4" aria-expanded="false" aria-controls="faq-answer-4">
                <span>Posso comprar para presentear?</span>
                <i aria-hidden="true">+</i>
              </button>
              <div id="faq-answer-4" role="region" aria-labelledby="faq-button-4" class="faq-answer">
                <p>Sim. Para o livro físico, basta inserir o endereço da pessoa presenteada como endereço de entrega no checkout. Para a edição digital, você pode adquirir o exemplar e encaminhar o arquivo e o link de acesso ao destinatário.</p>
              </div>
            </div>

            <div class="faq-item">
              <button id="faq-button-5" aria-expanded="false" aria-controls="faq-answer-5">
                <span>Como falar com o suporte?</span>
                <i aria-hidden="true">+</i>
              </button>
              <div id="faq-answer-5" role="region" aria-labelledby="faq-button-5" class="faq-answer">
                <p>Caso tenha qualquer dúvida sobre o pedido, código de rastreio ou acesso aos arquivos digitais, nossa equipe de suporte está à disposição pelos canais oficiais de atendimento informados no rodapé da página.</p>
              </div>
            </div>

          </div>
        </div>
      </section>

      <!-- 10. CTA FINAL (UMA DECISÃO) -->
      <section class="final-cta" data-section="final-cta">
        <div class="final-cta__orb" aria-hidden="true"></div>
        <div class="shell-container final-cta__inner" data-reveal>
          <div>
            <span class="section-index">07 — UMA DECISÃO</span>
            <h2>A próxima grande<br class="br-cta-tablet"><br class="br-cta-mobile"> virada<br class="br-cta-desktop"> <em>começa<br class="br-cta-tablet"> com<br class="br-cta-mobile"> uma decisão.</em></h2>
            <p>Escolha sua edição e leve esta leitura para o seu próximo capítulo. Uma obra sóbria, profunda e transformadora para a sua jornada.</p>
            <button class="button button--gold" id="btn-final-cta">
              Comprar agora <span>↗</span>
            </button>
          </div>
          <div class="final-mini-book">
            <img 
              src="<?php echo esc_url($asset_pb3); ?>" 
              alt="Livro O Pacto de 1 Bilhão por Salih Abdulatif — Edição Oficial em 3D" 
              class="final-mini-book__img"
            />
          </div>
        </div>
      </section>
    </main>

    <!-- 11. RODAPÉ -->
    <footer class="site-footer" id="rodape">
      <div class="shell-container site-footer__top">
        <div class="footer-brand">
          <a href="#inicio" class="footer-brand__link" aria-label="Voltar ao início">
            <img src="<?php echo esc_url($asset_logo); ?>" alt="O Pacto de 1 Bilhão" class="footer-brand__logo" width="175" height="76" loading="lazy">
          </a>
          <p>
            Registro editorial e reflexões de Salih Abdulatif.<br>
            Canais oficiais de atendimento e distribuição WooCommerce
          </p>
        </div>
        <div class="footer-links">
          <a href="#inicio">Início</a>
          <a href="#livro">Sobre a obra</a>
          <a href="#autor">O autor</a>
          <a href="#compra">Comprar Agora</a>
          <a href="#faq">Dúvidas frequentes</a>
        </div>
        <div class="footer-links">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('politica-de-privacidade')) ?: home_url('/politica-de-privacidade.html')); ?>">Política de Privacidade</a>
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('termos-e-condicoes')) ?: home_url('/termos-e-condicoes.html')); ?>">Termos e Condições</a>
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('trocas-e-devolucoes')) ?: home_url('/trocas-e-devolucoes.html')); ?>">Troca e Devoluções</a>
          <div class="footer-social" aria-label="Redes Sociais">
            <a href="https://www.tiktok.com" target="_blank" rel="noopener noreferrer" class="footer-social__link" aria-label="TikTok">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.89 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1v-3.52a6.37 6.37 0 0 0-.79-.05A6.34 6.34 0 0 0 3 15.67 6.34 6.34 0 0 0 9.34 22a6.34 6.34 0 0 0 6.34-6.33V9.05c1.23.86 2.72 1.36 4.33 1.41V7.01a4.84 4.84 0 0 1-.42-.32z"/></svg>
            </a>
            <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="footer-social__link" aria-label="YouTube">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
            <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="footer-social__link" aria-label="Instagram">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="footer-social__link" aria-label="Facebook">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
          </div>
        </div>
      </div>
      <div class="shell-container site-footer__bottom">
        <span>© Copyright 2026 - Salih Abdulatif - Feito com ♥ Baita Site - <a title="Criação de Sites" href="https://www.baitasite.com.br/" target="_blank" rel="noopener">Criação de Site</a></span>
        <span>Aviso legal: O livro retrata a experiência pessoal do autor. Não constitui promessa de ganhos ou sucesso financeiro garantido.</span>
        <a href="#inicio">Voltar ao topo ↑</a>
      </div>
    </footer>

    <!-- STICKY CTA MOBILE -->
    <div class="sticky-cta" id="sticky-cta" role="complementary" style="display: none;">
      <button class="sticky-cta__close" id="btn-close-sticky" aria-label="Fechar chamada fixa">×</button>
      <div>
        <span>O Pacto de 1 Bilhão</span>
        <small>Físico e Digital</small>
      </div>
      <button class="button button--green" id="btn-sticky-action">
        <span>Comprar agora!</span> <span>↗</span>
      </button>
    </div>

    <!-- NOTIFICAÇÃO DO CARRINHO (TOAST) -->
    <div class="cart-notice" id="cart-notice" role="status" style="display: none;">
      <span>✓</span>
      <p id="cart-notice-text">Produto adicionado ao carrinho WooCommerce.</p>
    </div>

  </div>

  <!-- PALCO DA ANIMAÇÃO DO LIVRO (VÍDEO OFICIAL FULLSCREEN OU 3D) -->
  <div class="book-riffle-stage" id="book-riffle-stage" aria-hidden="true">
    <video
      id="book-riffle-video"
      class="riffle-video"
      src="<?php echo esc_url($template_uri . '/livro_animacao.mp4'); ?>"
      playsinline
      muted
      preload="auto"
    ></video>

    <!-- ANIMAÇÃO DOM 3D ANTERIOR (PRESERVADA PARA FÁCIL RETORNO) -->
    <!--
    <div class="riffle-book-scene" id="riffle-book-scene">
      <div class="riffle-book">
        <div class="riffle-book__spine"></div>
        <div class="riffle-book__back-cover"></div>
        <div class="riffle-book__page-block"></div>
        <div class="riffle-leaf" style="z-index: 10;" data-leaf="0"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 11;" data-leaf="1"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 12;" data-leaf="2"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 13;" data-leaf="3"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 14;" data-leaf="4"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 15;" data-leaf="5"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 16;" data-leaf="6"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 17;" data-leaf="7"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 18;" data-leaf="8"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 19;" data-leaf="9"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 20;" data-leaf="10"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 21;" data-leaf="11"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 22;" data-leaf="12"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-leaf" style="z-index: 23;" data-leaf="13"><div class="riffle-leaf__shadow"></div></div>
        <div class="riffle-book__front-cover" id="riffle-front-cover" style="background-image: url('<?php echo esc_url($template_uri . '/capa_frontal_oficial.jpg'); ?>');"></div>
      </div>
    </div>

    <div class="riffle-final-title" id="riffle-final-title" aria-hidden="true">
      <span class="riffle-final-title__line-1">O Pacto de</span>
      <em class="riffle-final-title__line-2">1 Bilhão</em>
    </div>
    -->
  </div>

  <script src="<?php echo esc_url($template_uri . '/script.js?v=6.7'); ?>"></script>
  <?php wp_footer(); ?>
</body>
</html>
