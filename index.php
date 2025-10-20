<?php
/**
 * The main template file - KORRIGIERT
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main">
    <div class="blog-wrapper <?php echo esc_attr(get_theme_mod('axai_blog_layout', 'boxed')); ?>">
        <div class="content-container <?php echo esc_attr(get_theme_mod('axai_content_width_type', 'boxed') === 'boxed' ? 'boxed' : 'full-width'); ?>">
            
            <?php if (have_posts()) : ?>

                <header class="page-header">
                    <?php
                    if (is_home() && !is_front_page()) :
                        ?>
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                        <?php
                    endif;
                    ?>
                </header><!-- .page-header -->

                <div class="blog-grid <?php echo esc_attr('columns-' . get_theme_mod('axai_blog_columns', 3)); ?>">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', get_post_type());
                    endwhile;
                    ?>
                </div>

                <?php
                the_posts_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous', 'axai-galaxy') . '</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next', 'axai-galaxy') . '</span>',
                ));

            else :

                get_template_part('template-parts/content', 'none');

            endif;
            ?>

        </div>
    </div>
</main><!-- #primary -->

<?php
get_footer();