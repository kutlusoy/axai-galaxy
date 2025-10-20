<?php
/**
 * Template part for displaying posts - KORRIGIERT
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php if (has_post_thumbnail() && get_theme_mod('axai_show_blog_featured_image', true)) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('axai-blog-thumb'); ?>
            </a>
        </div>
    <?php endif; ?>
    
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        ?>
        
        <div class="entry-meta">
            <?php
            axai_posted_on();
            axai_posted_by();
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        if (is_singular() || !get_theme_mod('axai_show_blog_excerpt', true)) :
            the_content(sprintf(
                wp_kses(
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'axai-galaxy'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ));
        else :
            the_excerpt();
        endif;
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php if (!is_singular()) : ?>
            <?php
            // Categories
            $categories_list = get_the_category_list(esc_html__(', ', 'axai-galaxy'));
            if ($categories_list) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'axai-galaxy') . '</span>', $categories_list);
            }
            
            // Tags
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'axai-galaxy'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'axai-galaxy') . '</span>', $tags_list);
            }
            ?>
            
            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php esc_html_e('Read More', 'axai-galaxy'); ?>
                <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
                    <path d="M5 12h14m-7-7l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
            </a>
        <?php else : ?>
            <?php axai_entry_footer(); ?>
        <?php endif; ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->