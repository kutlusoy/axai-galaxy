<?php
/**
 * The template for displaying all single posts - KORRIGIERT
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main single-post">
    
    <?php if (has_post_thumbnail() && get_theme_mod('axai_show_post_featured_image', true)) : ?>
        <!-- Post Header with Featured Image -->
        <div class="post-header has-thumbnail">
            <div class="post-header-image">
                <?php the_post_thumbnail('full'); ?>
            </div>
            <div class="post-header-overlay">
                <div class="post-header-content <?php echo esc_attr(get_theme_mod('axai_single_post_layout', 'boxed')); ?>">
                    <div class="entry-meta">
                        <?php
                        axai_posted_on();
                        axai_posted_by();
                        ?>
                    </div>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="post-content-wrapper <?php echo esc_attr(get_theme_mod('axai_single_post_layout', 'boxed')); ?>">
        <div class="content-container <?php echo esc_attr(get_theme_mod('axai_content_width_type', 'boxed') === 'boxed' ? 'boxed' : 'full-width'); ?>">
            
            <?php
            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', 'single');

                // Previous/Next post navigation
                the_post_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'axai-galaxy') . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'axai-galaxy') . '</span> <span class="nav-title">%title</span>',
                ));

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile;
            ?>

        </div>
    </div>

</main><!-- #primary -->

<?php
get_footer();