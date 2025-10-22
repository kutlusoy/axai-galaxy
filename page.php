<?php
/**
 * The template for displaying all single pages
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$has_content = trim(get_the_content()) !== '';
?>

<main id="primary" class="site-main">

    <?php if (has_post_thumbnail() && get_theme_mod('axai_show_page_header_image', true)) : ?>
        <div class="page-header has-thumbnail">
            <div class="page-header-image">
                <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="page-header-overlay">
                <div class="page-header-content <?php echo esc_attr(get_theme_mod('axai_page_header_layout', 'boxed')); ?>">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($has_content) : ?>
    <div class="page-content-wrapper <?php echo esc_attr(get_theme_mod('axai_content_layout', 'boxed')); ?>">
        <div class="content-container <?php echo esc_attr(get_theme_mod('axai_content_width_type', 'boxed') === 'boxed' ? 'boxed' : 'full-width'); ?>">
            
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <?php if (!has_post_thumbnail() || !get_theme_mod('axai_show_page_header_image', true)) : ?>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'axai-galaxy'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <?php if (get_edit_post_link()) : ?>
                        <footer class="entry-footer">
                            <?php
                            edit_post_link(
                                sprintf(
                                    wp_kses(
                                        __('Edit <span class="screen-reader-text">%s</span>', 'axai-galaxy'),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                    ),
                                    wp_kses_post(get_the_title())
                                ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </footer>
                    <?php endif; ?>
                </article>

                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile;
            ?>

        </div>
    </div>
    <?php endif; ?>

</main>

<?php
get_footer();
