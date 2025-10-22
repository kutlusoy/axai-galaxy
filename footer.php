<?php
/**
 * The footer for AxAI Galaxy theme
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$has_content = trim(get_the_content()) !== '';
?>

    </div><!-- #content -->

    <?php if ($has_content) : ?>
    <!-- Footer -->
    <footer id="colophon" class="site-footer">
        <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) : ?>
            <div class="footer-widgets">
                <div class="footer-container <?php echo esc_attr(get_theme_mod('axai_footer_container_width', 'boxed')); ?>">
                    <div class="footer-widgets-grid">
                        <?php for ($i = 1; $i <= 4; $i++) : ?>
                            <?php if (is_active_sidebar('footer-' . $i)) : ?>
                                <div class="footer-widget-area footer-widget-<?php echo $i; ?>">
                                    <?php dynamic_sidebar('footer-' . $i); ?>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div><!-- .footer-widgets -->
        <?php endif; ?>

        <div class="site-info">
            <div class="footer-container <?php echo esc_attr(get_theme_mod('axai_footer_container_width', 'boxed')); ?>">
                <div class="footer-content">
                    <div class="copyright">
                        <?php
                        $copyright_text = get_theme_mod('axai_copyright_text', 
                            sprintf(
                                esc_html__('© %1$s %2$s. All rights reserved.', 'axai-galaxy'),
                                date('Y'),
                                get_bloginfo('name')
                            )
                        );
                        echo wp_kses_post($copyright_text);
                        
                        if (get_theme_mod('axai_show_theme_credit', true)) {
                            echo ' | ' . sprintf(
                                esc_html__('Theme: %1$s by %2$s', 'axai-galaxy'),
                                '<a href="https://axai.at" target="_blank" rel="noopener">AxAI Galaxy</a>',
                                '<a href="https://axai.at" target="_blank" rel="noopener">Ali Kutlusoy</a>'
                            );
                        }
                        ?>
                    </div>
                    
                    <?php if (has_nav_menu('footer')) : ?>
                        <div class="footer-links">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'menu_id'        => 'footer-menu',
                                'menu_class'     => 'footer-menu',
                                'container'      => 'nav',
                                'container_class' => 'footer-navigation',
                                'depth'          => 1,
                                'fallback_cb'    => false,
                            ));
                            ?>
                        </div>
                    <?php endif; ?>
                </div><!-- .footer-content -->
            </div><!-- .footer-container -->
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
    <?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
