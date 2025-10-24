<?php
/**
 * AxAI Galaxy Theme Functions
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

define('AXAI_VERSION', '1.0');
define('AXAI_DIR', get_template_directory());
define('AXAI_URI', get_template_directory_uri());

function axai_setup() {
    load_theme_textdomain('axai-galaxy', AXAI_DIR . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 630, true);
    add_image_size('axai-hero', 1920, 1080, true);
    add_image_size('axai-blog-thumb', 800, 600, true);
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'axai-galaxy'),
        'footer' => esc_html__('Footer Menu', 'axai-galaxy'),
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo', array('height' => 100, 'width' => 400, 'flex-height' => true, 'flex-width' => true));
    add_theme_support('custom-header', array('default-image' => '', 'width' => 1920, 'height' => 1080, 'flex-height' => true, 'flex-width' => true));
    add_theme_support('custom-background', array('default-color' => '000000'));
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'axai_setup');

function axai_content_width() {
    $GLOBALS['content_width'] = apply_filters('axai_content_width', 1200);
}
add_action('after_setup_theme', 'axai_content_width', 0);

function axai_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'axai-galaxy'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'axai-galaxy'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name' => sprintf(esc_html__('Footer %d', 'axai-galaxy'), $i),
            'id' => 'footer-' . $i,
            'description' => sprintf(esc_html__('Footer widget area %d', 'axai-galaxy'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}
add_action('widgets_init', 'axai_widgets_init');

function axai_scripts() {
    $threejs_url = get_theme_mod('axai_threejs_url', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js');
    wp_enqueue_script('threejs', esc_url($threejs_url), array(), 'r128', false);
    wp_enqueue_style('axai-style', AXAI_URI . '/assets/css/theme.css', array(), AXAI_VERSION);
    wp_enqueue_script('axai-starfield', AXAI_URI . '/assets/js/starfield.js', array('threejs'), AXAI_VERSION, true);
    wp_enqueue_script('axai-scripts', AXAI_URI . '/assets/js/theme.js', array('jquery'), AXAI_VERSION, true);
    wp_localize_script('axai-starfield', 'axaiConfig', axai_get_galaxy_config());
    wp_localize_script('axai-scripts', 'axaiTheme', array('logoSpacing' => get_theme_mod('axai_logo_spacing', 40)));
    $inline_css = axai_get_customizer_css();
    wp_add_inline_style('axai-style', $inline_css);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'axai_scripts');

function axai_get_customizer_css() {
    $css = ':root {';
    $css .= '--logo-spacing: ' . absint(get_theme_mod('axai_logo_spacing', 40)) . 'px;';
    $css .= '--header-boxed-width: ' . absint(get_theme_mod('axai_header_boxed_width', 1200)) . 'px;';
    $css .= '--content-boxed-width: ' . absint(get_theme_mod('axai_content_boxed_width', 1200)) . 'px;';
    $css .= '--footer-boxed-width: ' . absint(get_theme_mod('axai_footer_boxed_width', 1200)) . 'px;';
    $header_transparency = absint(get_theme_mod('axai_header_transparency', 80)) / 100;
    $css .= '--header-transparency: ' . $header_transparency . ';';
    $footer_transparency = absint(get_theme_mod('axai_footer_transparency', 95)) / 100;
    $css .= '--footer-transparency: ' . $footer_transparency . ';';
    $content_transparency = absint(get_theme_mod('axai_content_transparency', 60));
    $css .= '--content-transparency: ' . $content_transparency . ';';
    $content_bg = sanitize_hex_color(get_theme_mod('axai_content_bg_color', '#0a0e1a'));
    $css .= '--content-bg-color: ' . $content_bg . ';';
    $link_color = sanitize_hex_color(get_theme_mod('axai_link_color', '#667eea'));
    $css .= '--link-color: ' . $link_color . ';';
    $link_hover = sanitize_hex_color(get_theme_mod('axai_link_hover_color', '#764ba2'));
    $css .= '--link-hover-color: ' . $link_hover . ';';
    $menu_color = sanitize_hex_color(get_theme_mod('axai_menu_text_color', '#ffffff'));
    $css .= '--menu-text-color: ' . $menu_color . ';';
    $menu_size = absint(get_theme_mod('axai_menu_text_size', 16));
    $css .= '--menu-text-size: ' . $menu_size . 'px;';
    $css .= '}';
    $css .= 'article {';
    $css .= 'background-color: ' . $content_bg . ';';
    $css .= 'opacity: ' . ($content_transparency / 100) . ';';
    $css .= '}';
    return $css;
}

function axai_get_galaxy_config() {
    return array(
        'idleSpeed' => (float)get_theme_mod('axai_idle_speed', 0.5),
        'warpSpeed' => (float)get_theme_mod('axai_warp_speed', 250),
        'starCount' => (int)get_theme_mod('axai_star_count', 1000),
        'starMinRadius' => (float)get_theme_mod('axai_star_min_radius', 100),
        'starMaxRadius' => (float)get_theme_mod('axai_star_max_radius', 500),
        'starDepthRange' => (float)get_theme_mod('axai_star_depth_range', 4000),
        'starBaseOpacity' => (float)get_theme_mod('axai_star_base_opacity', 0.9),
        'starBrightness' => (float)get_theme_mod('axai_star_brightness', 2.5),
        'starWarpBrightness' => (float)get_theme_mod('axai_star_warp_brightness', 0.5),
        'starMinSize' => (float)get_theme_mod('axai_star_min_size', 0.5),
        'starMaxSize' => (float)get_theme_mod('axai_star_max_size', 1.0),
        'starCloseCount' => (int)get_theme_mod('axai_star_close_count', 50),
        'nebulaCount' => (int)get_theme_mod('axai_nebula_count', 80),
        'nebulaMinRadius' => (float)get_theme_mod('axai_nebula_min_radius', 300),
        'nebulaMaxRadius' => (float)get_theme_mod('axai_nebula_max_radius', 900),
        'nebulaBaseOpacity' => (float)get_theme_mod('axai_nebula_base_opacity', 0.3),
        'nebulaBaseSize' => (float)get_theme_mod('axai_nebula_base_size', 1200),
        'galaxiesEnabled' => (bool)get_theme_mod('axai_galaxies_enabled', true),
        'galaxyCount' => (int)get_theme_mod('axai_galaxy_count', 5),
        'galaxyMinRadius' => (float)get_theme_mod('axai_galaxy_min_radius', 600),
        'galaxyMaxRadius' => (float)get_theme_mod('axai_galaxy_max_radius', 800),
        'galaxySpeed' => (float)get_theme_mod('axai_galaxy_speed', 0.02),
        'galaxyBaseSize' => (float)get_theme_mod('axai_galaxy_base_size', 800),
        'galaxyMaxSize' => (float)get_theme_mod('axai_galaxy_max_size', 1200),
        'galaxyOpacity' => (float)get_theme_mod('axai_galaxy_opacity', 0.3),
        'galaxyRotationSpeed' => (float)get_theme_mod('axai_galaxy_rotation_speed', 0.0001),
        'galaxyCoreSize' => (float)get_theme_mod('axai_galaxy_core_size', 200),
        'galaxySpawnChance' => (float)get_theme_mod('axai_galaxy_spawn_chance', 0.6),
        'cameraFOV' => (float)get_theme_mod('axai_camera_fov', 85),
        'parallaxIntensity' => (float)get_theme_mod('axai_parallax_intensity', 10),
        'galaxyTypes' => axai_get_galaxy_types_config(),
        'colors' => array(
            'nebula' => array(
                'purple' => axai_get_color_array('axai_nebula_color_purple', array('r' => 0.5, 'g' => 0.2, 'b' => 0.8)),
                'blue' => axai_get_color_array('axai_nebula_color_blue', array('r' => 0.2, 'g' => 0.4, 'b' => 0.8)),
                'pink' => axai_get_color_array('axai_nebula_color_pink', array('r' => 0.8, 'g' => 0.2, 'b' => 0.5)),
                'warpViolet' => axai_get_color_array('axai_nebula_color_warp_violet', array('r' => 0.6, 'g' => 0.1, 'b' => 0.9)),
                'warpRed' => axai_get_color_array('axai_nebula_color_warp_red', array('r' => 1.0, 'g' => 0.1, 'b' => 0.1)),
            ),
            'star' => array(
                'purple' => axai_get_color_array('axai_star_color_purple', array('r' => 0.65, 'g' => 0.3, 'b' => 1.0)),
                'pink' => axai_get_color_array('axai_star_color_pink', array('r' => 1.0, 'g' => 0.3, 'b' => 0.6)),
                'blue' => axai_get_color_array('axai_star_color_blue', array('r' => 0.3, 'g' => 0.6, 'b' => 1.0)),
                'white' => axai_get_color_array('axai_star_color_white', array('r' => 1.0, 'g' => 1.0, 'b' => 1.0)),
            ),
        ),
        'warpTriggerClass' => 'hero-button'
    );
}

function axai_get_color_array($mod_name, $default) {
    $color = get_theme_mod($mod_name, $default);
    if (is_string($color)) {
        if (strpos($color, '#') === 0) {
            $hex = ltrim($color, '#');
            if (strlen($hex) == 6) {
                return array(
                    'r' => round(hexdec(substr($hex, 0, 2)) / 255, 2),
                    'g' => round(hexdec(substr($hex, 2, 2)) / 255, 2),
                    'b' => round(hexdec(substr($hex, 4, 2)) / 255, 2)
                );
            }
        }
        $decoded = json_decode($color, true);
        if (is_array($decoded)) {
            $color = $decoded;
        }
    }
    if (is_array($color) && isset($color['r']) && isset($color['g']) && isset($color['b'])) {
        return array('r' => (float)$color['r'], 'g' => (float)$color['g'], 'b' => (float)$color['b']);
    }
    return $default;
}

function axai_get_galaxy_types_config() {
    $default_types = array(
        array('name' => 'Milky Way Style', 'arms' => 4, 'armPoints' => 2500, 'tightness' => 2.5, 'coreColor' => array('r' => 1.0, 'g' => 0.95, 'b' => 0.85), 'innerColor' => array('r' => 0.95, 'g' => 0.85, 'b' => 0.7), 'outerColor' => array('r' => 0.5, 'g' => 0.6, 'b' => 0.85), 'dustColor' => array('r' => 0.4, 'g' => 0.35, 'b' => 0.3), 'hasBar' => true, 'diskThickness' => 0.25, 'armWidth' => 0.08, 'armDensity' => 6.5, 'speed' => 0.02, 'rotationSpeed' => 0.0001),
        array('name' => 'Andromeda Style', 'arms' => 2, 'armPoints' => 5250, 'tightness' => 5.3, 'coreColor' => array('r' => 1.0, 'g' => 0.92, 'b' => 0.75), 'innerColor' => array('r' => 0.85, 'g' => 0.75, 'b' => 0.95), 'outerColor' => array('r' => 0.4, 'g' => 0.5, 'b' => 0.9), 'dustColor' => array('r' => 0.5, 'g' => 0.3, 'b' => 0.4), 'hasBar' => false, 'diskThickness' => 0.32, 'armWidth' => 0.06, 'armDensity' => 3.0, 'speed' => 0.015, 'rotationSpeed' => 0.00008),
        array('name' => 'Whirlpool Style', 'arms' => 2, 'armPoints' => 2600, 'tightness' => 2.5, 'coreColor' => array('r' => 0.8, 'g' => 0.2, 'b' => 0.5), 'innerColor' => array('r' => 0.95, 'g' => 0.65, 'b' => 0.8), 'outerColor' => array('r' => 0.6, 'g' => 0.4, 'b' => 0.85), 'dustColor' => array('r' => 0.2, 'g' => 0.4, 'b' => 0.8), 'hasBar' => false, 'diskThickness' => 0.3, 'armWidth' => 0.05, 'armDensity' => 3.2, 'speed' => 0.025, 'rotationSpeed' => 0.00012),
        array('name' => 'Pinwheel Style', 'arms' => 5, 'armPoints' => 1750, 'tightness' => 7.25, 'coreColor' => array('r' => 0.95, 'g' => 1.0, 'b' => 0.9), 'innerColor' => array('r' => 1.0, 'g' => 0.1, 'b' => 0.1), 'outerColor' => array('r' => 0.4, 'g' => 0.65, 'b' => 0.95), 'dustColor' => array('r' => 0.35, 'g' => 0.5, 'b' => 0.45), 'hasBar' => false, 'diskThickness' => 0.33, 'armWidth' => 0.07, 'armDensity' => 2.8, 'speed' => 0.018, 'rotationSpeed' => 0.00015),
        array('name' => 'Triangulum Style', 'arms' => 3, 'armPoints' => 1300, 'tightness' => 9.35, 'coreColor' => array('r' => 0.2, 'g' => 0.4, 'b' => 0.8), 'innerColor' => array('r' => 0.8, 'g' => 0.7, 'b' => 0.95), 'outerColor' => array('r' => 0.5, 'g' => 0.4, 'b' => 0.85), 'dustColor' => array('r' => 0.45, 'g' => 0.3, 'b' => 0.5), 'hasBar' => false, 'diskThickness' => 0.24, 'armWidth' => 0.065, 'armDensity' => 2.6, 'speed' => 0.022, 'rotationSpeed' => 0.0001),
        array('name' => 'Sombrero Style', 'arms' => 2, 'armPoints' => 2500, 'tightness' => 5.6, 'coreColor' => array('r' => 0.5, 'g' => 0.2, 'b' => 0.8), 'innerColor' => array('r' => 0.9, 'g' => 0.65, 'b' => 0.45), 'outerColor' => array('r' => 0.6, 'g' => 0.4, 'b' => 0.3), 'dustColor' => array('r' => 0.35, 'g' => 0.2, 'b' => 0.15), 'hasBar' => false, 'diskThickness' => 0.28, 'armWidth' => 0.04, 'armDensity' => 3.5, 'speed' => 0.016, 'rotationSpeed' => 0.00009)
    );
    $types = array();
    $type_names = array('milky_way', 'andromeda', 'whirlpool', 'pinwheel', 'triangulum', 'sombrero');
    foreach ($type_names as $index => $type) {
        $types[] = array(
            'name' => $default_types[$index]['name'],
            'arms' => (int)get_theme_mod("axai_galaxy_{$type}_arms", $default_types[$index]['arms']),
            'armPoints' => (int)get_theme_mod("axai_galaxy_{$type}_armPoints", $default_types[$index]['armPoints']),
            'tightness' => (float)get_theme_mod("axai_galaxy_{$type}_tightness", $default_types[$index]['tightness']),
            'coreColor' => axai_get_color_array("axai_galaxy_{$type}_core_color", $default_types[$index]['coreColor']),
            'innerColor' => axai_get_color_array("axai_galaxy_{$type}_inner_color", $default_types[$index]['innerColor']),
            'outerColor' => axai_get_color_array("axai_galaxy_{$type}_outer_color", $default_types[$index]['outerColor']),
            'dustColor' => axai_get_color_array("axai_galaxy_{$type}_dust_color", $default_types[$index]['dustColor']),
            'hasBar' => (bool)get_theme_mod("axai_galaxy_{$type}_hasBar", $default_types[$index]['hasBar']),
            'diskThickness' => (float)get_theme_mod("axai_galaxy_{$type}_diskThickness", $default_types[$index]['diskThickness']),
            'armWidth' => (float)get_theme_mod("axai_galaxy_{$type}_armWidth", $default_types[$index]['armWidth']),
            'armDensity' => (float)get_theme_mod("axai_galaxy_{$type}_armDensity", $default_types[$index]['armDensity']),
            'speed' => (float)get_theme_mod("axai_galaxy_{$type}_speed", $default_types[$index]['speed']),
            'rotationSpeed' => (float)get_theme_mod("axai_galaxy_{$type}_rotationSpeed", $default_types[$index]['rotationSpeed']),
        );
    }
    return $types;
}

require AXAI_DIR . '/inc/customizer.php';
require AXAI_DIR . '/inc/template-tags.php';
require AXAI_DIR . '/inc/elementor-support.php';

function axai_body_classes($classes) {
    if (get_theme_mod('axai_header_sticky', true)) {
        $classes[] = 'sticky-header';
    }
    if (get_theme_mod('axai_header_transparent', false) && is_front_page()) {
        $classes[] = 'transparent-header';
    }
    $logo_position = get_theme_mod('axai_logo_position', 'left');
    $menu_alignment = get_theme_mod('axai_menu_alignment', 'right');
    $classes[] = 'logo-' . $logo_position;
    $classes[] = 'menu-' . $menu_alignment;
    $layout = get_theme_mod('axai_site_layout', 'boxed');
    $classes[] = 'layout-' . $layout;
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    return $classes;
}
add_filter('body_class', 'axai_body_classes');

function axai_body_data_attributes() {
    $logo_spacing = get_theme_mod('axai_logo_spacing', 40);
    echo ' data-logo-spacing="' . esc_attr($logo_spacing) . '"';
}
add_action('body_tag', 'axai_body_data_attributes');

function axai_theme_uninstall() {
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'theme_mods_axai-galaxy%'");
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'axai_%'");
    delete_option('axai_theme_version');
    wp_cache_flush();
}
register_uninstall_hook(__FILE__, 'axai_theme_uninstall');
