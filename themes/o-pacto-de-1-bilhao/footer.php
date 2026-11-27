  <!-- RODAPÉ OFICIAL -->
  <footer class="footer" role="contentinfo">
    <div class="site-container">
      <div class="footer__inner">
        <div class="footer__brand">
          <span class="footer__logo">O Pacto de 1 Bilhão</span>
          <p class="footer__tagline">Uma reflexão essencial sobre negócios, visão e legado por Salih Abdulatif.</p>
        </div>

        <div class="footer__links">
          <nav aria-label="Links institucionais e legais">
            <?php
            if (has_nav_menu('legal')) {
                wp_nav_menu(array(
                    'theme_location' => 'legal',
                    'container'      => false,
                    'menu_class'     => 'legal-nav-list',
                    'fallback_cb'    => false,
                ));
            } else {
            ?>
            <a href="<?php echo esc_url(home_url('/politica-de-privacidade/')); ?>">Política de Privacidade</a>
            <a href="<?php echo esc_url(home_url('/termos-e-condicoes/')); ?>">Termos de Uso</a>
            <a href="<?php echo esc_url(home_url('/trocas-e-devolucoes/')); ?>">Trocas e Devoluções</a>
            <?php } ?>
          </nav>
        </div>
      </div>

      <div class="footer__bottom">
        <p>© <?php echo date('Y'); ?> Salih Abdulatif. Todos os direitos reservados. Edição Oficial autorizada.</p>
        <p class="footer__credits">Desenvolvido com tecnologia editorial de alta conversão & WooCommerce.</p>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
