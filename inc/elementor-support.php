<?php
/**
 * Elementor Compatibility
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Elementor locations
 */
function axai_register_elementor_locations($elementor_theme_manager) {
    $elementor_theme_manager->register_all_core_location();
}
add_action('elementor/theme/register_locations', 'axai_register_elementor_locations');

/**
 * Add Elementor support
 */
function axai_add_elementor_support() {
    // Elementor `header` location
    add_theme_support('elementor-header-footer');
    
    // Add Elementor global colors
    add_theme_support('elementor-global-colors');
    
    // Add Elementor global typography
    add_theme_support('elementor-global-typography');
}
add_action('after_setup_theme', 'axai_add_elementor_support');

/**
 * Enqueue Elementor frontend styles
 */
function axai_enqueue_elementor_styles() {
    if (did_action('elementor/loaded')) {
        wp_enqueue_style('axai-elementor', AXAI_URI . '/assets/css/elementor.css', array(), AXAI_VERSION);
    }
}
add_action('wp_enqueue_scripts', 'axai_enqueue_elementor_styles', 20);

/**
 * Elementor canvas template body class
 */
function axai_elementor_canvas_body_class($classes) {
    if (class_exists('\Elementor\Plugin')) {
        $elementor = \Elementor\Plugin::instance();
        $document = $elementor->documents->get(get_the_ID());
        
        if ($document && 'elementor_canvas' === $document->get_settings('template')) {
            $classes[] = 'elementor-template-canvas';
        }
    }
    
    return $classes;
}
add_filter('body_class', 'axai_elementor_canvas_body_class');

/**
 * Register Elementor widgets
 */
function axai_register_elementor_widgets() {
    if (!did_action('elementor/loaded')) {
        return;
    }
    
    // Custom widgets can be registered here
    // Example: \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Custom_Widget());
}
add_action('elementor/widgets/widgets_registered', 'axai_register_elementor_widgets');

/**
 * Disable Elementor default colors and fonts
 */
function axai_disable_elementor_defaults() {
    if (!did_action('elementor/loaded')) {
        return;
    }
    
    // Remove default Elementor color schemes
    remove_action('elementor/editor/before_enqueue_scripts', ['\Elementor\Plugin::$instance->schemes_manager', 'register_schemes']);
}
add_action('init', 'axai_disable_elementor_defaults');

/**
 * Add custom Elementor categories
 */
function axai_add_elementor_categories($elements_manager) {
    $elements_manager->add_category(
        'axai-elements',
        array(
            'title' => __('AxAI Galaxy Elements', 'axai-galaxy'),
            'icon'  => 'fa fa-plug',
        )
    );
}
add_action('elementor/elements/categories_registered', 'axai_add_elementor_categories');