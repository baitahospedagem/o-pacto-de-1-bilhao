<?php
/**
 * WooCommerce Custom Wrapper Template
 *
 * @package OPactoDe1Bilhao
 */

get_header();
?>

<main id="primary" class="site-main pacto-woo-container">
  <div class="site-container">
    <?php woocommerce_content(); ?>
  </div>
</main>

<?php
get_footer();
