<?php
/**
 * Template part for displaying single posts - KORRIGIERT
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php if (!has_post_thumbnail() || !get_theme_mod('axai_show_post_featured_image', true)) : ?>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            
            <div class="entry-meta">
                <?php
                axai_posted_on();
                axai_posted_by();
                ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
    <?php endif; ?>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'axai-galaxy'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php axai_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->