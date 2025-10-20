<?php
/**
 * The template for displaying the front page
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main front-page">
    
    <?php if (get_theme_mod('axai_show_hero_section', true)) : ?>
        <!-- Hero Section -->
        <section class="hero-section <?php echo esc_attr(get_theme_mod('axai_hero_layout', 'full-width')); ?>">
            <div class="hero-container <?php echo esc_attr(get_theme_mod('axai_hero_content_width', 'boxed') === 'boxed' ? 'boxed' : 'full-width'); ?>">
                <div class="hero-content">
                    <?php
                    $hero_title = get_theme_mod('axai_hero_title', get_bloginfo('name'));
                    $hero_subtitle = get_theme_mod('axai_hero_subtitle', get_bloginfo('description'));
                    $hero_button_text = get_theme_mod('axai_hero_button_text', __('Learn More', 'axai-galaxy'));
                    $hero_button_url = get_theme_mod('axai_hero_button_url', '#content');
                    ?>
                    
                    <?php if ($hero_title) : ?>
                        <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                    <?php endif; ?>
                    
                    <?php if ($hero_subtitle) : ?>
                        <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                    <?php endif; ?>
                    
                    <?php if ($hero_button_text && $hero_button_url) : ?>
                        <a href="<?php echo esc_url($hero_button_url); ?>" class="hero-button">
                            <?php echo esc_html($hero_button_text); ?>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M5 12h14m-7-7l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="front-page-content <?php echo esc_attr(get_theme_mod('axai_content_layout', 'boxed')); ?>">
        <div class="content-container <?php echo esc_attr(get_theme_mod('axai_content_width_type', 'boxed') === 'boxed' ? 'boxed' : 'full-width'); ?>">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'axai-galaxy'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile;
            ?>
        </div>
    </div>

</main><!-- #primary -->

<?php
get_footer();