<?php
/**
 * The template for displaying all single pages
 *
 * @package OPactoDe1Bilhao
 */

get_header();
?>

<main id="primary" class="site-main pacto-woo-container">
  <div class="site-container">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header>

          <div class="entry-content">
            <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Páginas:', 'o-pacto-de-1-bilhao'),
                'after'  => '</div>',
            ));
            ?>
          </div>
        </article>
        <?php
    endwhile;
    ?>
  </div>
</main>

<?php
get_footer();
