<?php
/**
 * The template for displaying 404 pages (not found)
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
    <div class="error-404-wrapper">
        <div class="content-container boxed">
            
            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('404', 'axai-galaxy'); ?></h1>
                    <p class="error-subtitle"><?php esc_html_e('Oops! Lost in Space', 'axai-galaxy'); ?></p>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e('It looks like nothing was found at this location. The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'axai-galaxy'); ?></p>
                    
                    <div class="error-search">
                        <?php get_search_form(); ?>
                    </div>
                    
                    <div class="error-actions">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hero-button">
                            <?php esc_html_e('Return to Homepage', 'axai-galaxy'); ?>
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
                                <path d="M3 12l9-9 9 9M5 10v10h14V10" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                        </a>
                    </div>
                    
                    <?php if (is_active_sidebar('sidebar-1')) : ?>
                        <div class="widget-area">
                            <h2><?php esc_html_e('You Might Also Like', 'axai-galaxy'); ?></h2>
                            <?php dynamic_sidebar('sidebar-1'); ?>
                        </div>
                    <?php endif; ?>
                    
                </div><!-- .page-content -->
            </section><!-- .error-404 -->
            
        </div>
    </div>
</main><!-- #primary -->

<?php
get_footer();