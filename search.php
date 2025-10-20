<?php
/**
 * The template for displaying search results pages
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main search-results">
    <div class="blog-wrapper <?php echo esc_attr(get_theme_mod('axai_blog_layout', 'boxed')); ?>">
        <div class="content-container <?php echo esc_attr(get_theme_mod('axai_content_width_type', 'boxed') === 'boxed' ? 'boxed' : 'full-width'); ?>">

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        esc_html__('Search Results for: %s', 'axai-galaxy'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
                <?php
                if (have_posts()) {
                    $result_count = $wp_query->found_posts;
                    printf(
                        '<p class="search-results-count">' . 
                        _nx(
                            'Found %s result',
                            'Found %s results',
                            $result_count,
                            'search results count',
                            'axai-galaxy'
                        ) . '</p>',
                        number_format_i18n($result_count)
                    );
                }
                ?>
            </header><!-- .page-header -->

            <?php if (have_posts()) : ?>

                <div class="blog-grid <?php echo esc_attr('columns-' . get_theme_mod('axai_blog_columns', 3)); ?>">
                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'search');
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