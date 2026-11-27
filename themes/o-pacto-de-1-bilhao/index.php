<?php
/**
 * The main template file
 *
 * @package OPactoDe1Bilhao
 */

get_header();
?>

<main id="primary" class="site-main pacto-woo-container">
  <div class="site-container">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('pacto-article'); ?>>
              <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
              </header>
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
            </article>
            <?php
        endwhile;
        the_posts_navigation();
    else :
        ?>
        <p><?php esc_html_e('Nenhum conteúdo encontrado.', 'o-pacto-de-1-bilhao'); ?></p>
        <?php
    endif;
    ?>
  </div>
</main>

<?php
get_footer();
