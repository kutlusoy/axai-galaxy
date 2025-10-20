<?php
/**
 * AxAI Galaxy Theme Customizer - DEZIMALZAHLEN KORRIGIERT
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sanitize float - konvertiert Komma zu Punkt
 */
function axai_sanitize_float($value) {
    // Konvertiere Komma zu Punkt für Dezimalzahlen
    $value = str_replace(',', '.', $value);
    // Konvertiere zu Float
    $float_value = floatval($value);
    return $float_value;
}

/**
 * Sanitize RGB color
 */
function axai_sanitize_rgb_color($value) {
    if (is_string($value)) {
        $value = json_decode($value, true);
    }
    
    if (!is_array($value) || !isset($value['r']) || !isset($value['g']) || !isset($value['b'])) {
        return array('r' => 1.0, 'g' => 1.0, 'b' => 1.0);
    }
    
    // Konvertiere Kommas zu Punkten
    $r = str_replace(',', '.', strval($value['r']));
    $g = str_replace(',', '.', strval($value['g']));
    $b = str_replace(',', '.', strval($value['b']));
    
    return array(
        'r' => max(0, min(1, floatval($r))),
        'g' => max(0, min(1, floatval($g))),
        'b' => max(0, min(1, floatval($b)))
    );
}

/**
 * Sanitize select/radio
 */
function axai_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Sanitize hex color
 */
function axai_sanitize_hex_color($color) {
    if ('' === $color) {
        return '';
    }
    
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color)) {
        return $color;
    }
    
    return '';
}

/**
 * Register custom controls
 */
function axai_register_custom_controls() {
    /**
     * Custom RGB Color Control
     */
    if (class_exists('WP_Customize_Control')) {
        class Axai_RGB_Color_Control extends WP_Customize_Control {
            public $type = 'axai_rgb_color';
            
            public function render_content() {
                $value = $this->value();
                if (!is_array($value)) {
                    $value = array('r' => 1, 'g' => 1, 'b' => 1);
                }
                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                    <?php if (!empty($this->description)) : ?>
                        <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                    <?php endif; ?>
                    <div class="rgb-color-inputs" style="margin-top: 8px;">
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <div style="flex: 1;">
                                <label style="display: block; font-size: 11px; margin-bottom: 3px;">R</label>
                                <input type="text" 
                                       class="rgb-r" 
                                       value="<?php echo esc_attr($value['r']); ?>"
                                       placeholder="0.0-1.0"
                                       style="width: 100%;" />
                            </div>
                            <div style="flex: 1;">
                                <label style="display: block; font-size: 11px; margin-bottom: 3px;">G</label>
                                <input type="text" 
                                       class="rgb-g" 
                                       value="<?php echo esc_attr($value['g']); ?>"
                                       placeholder="0.0-1.0"
                                       style="width: 100%;" />
                            </div>
                            <div style="flex: 1;">
                                <label style="display: block; font-size: 11px; margin-bottom: 3px;">B</label>
                                <input type="text" 
                                       class="rgb-b" 
                                       value="<?php echo esc_attr($value['b']); ?>"
                                       placeholder="0.0-1.0"
                                       style="width: 100%;" />
                            </div>
                            <div style="width: 40px; height: 40px; border-radius: 4px; border: 1px solid #ddd; margin-top: 16px;"
                                 class="rgb-preview"></div>
                        </div>
                        <input type="hidden" 
                               class="rgb-value" 
                               <?php $this->link(); ?> 
                               value='<?php echo esc_attr(json_encode($value)); ?>' />
                    </div>
                </label>
                <script>
                (function($) {
                    $(document).ready(function() {
                        var container = $('#customize-control-<?php echo esc_js($this->id); ?>');
                        var rInput = container.find('.rgb-r');
                        var gInput = container.find('.rgb-g');
                        var bInput = container.find('.rgb-b');
                        var preview = container.find('.rgb-preview');
                        var hiddenInput = container.find('.rgb-value');
                        
                        function parseFloat(val) {
                            // Ersetze Komma mit Punkt für korrekte Dezimalzahlen
                            val = String(val).replace(',', '.');
                            return window.parseFloat(val) || 0;
                        }
                        
                        function updateValue() {
                            var r = parseFloat(rInput.val());
                            var g = parseFloat(gInput.val());
                            var b = parseFloat(bInput.val());
                            
                            r = Math.max(0, Math.min(1, r));
                            g = Math.max(0, Math.min(1, g));
                            b = Math.max(0, Math.min(1, b));
                            
                            // Formatiere mit Punkt (nicht Komma)
                            rInput.val(r.toFixed(2));
                            gInput.val(g.toFixed(2));
                            bInput.val(b.toFixed(2));
                            
                            var value = {r: r, g: g, b: b};
                            hiddenInput.val(JSON.stringify(value)).trigger('change');
                            
                            var rHex = Math.round(r * 255);
                            var gHex = Math.round(g * 255);
                            var bHex = Math.round(b * 255);
                            preview.css('background-color', 'rgb(' + rHex + ',' + gHex + ',' + bHex + ')');
                        }
                        
                        rInput.on('input change blur', updateValue);
                        gInput.on('input change blur', updateValue);
                        bInput.on('input change blur', updateValue);
                        
                        updateValue();
                    });
                })(jQuery);
                </script>
                <?php
            }
        }
    }
}
add_action('customize_register', 'axai_register_custom_controls', 1);

/**
 * Register customizer settings
 */
function axai_customize_register($wp_customize) {
    
    // Register RGB Color Control
    if (class_exists('Axai_RGB_Color_Control')) {
        $wp_customize->register_control_type('Axai_RGB_Color_Control');
    }
    
    // ==========================================
    // RESET BUTTON SECTION
    // ==========================================
    $wp_customize->add_section('axai_reset_section', array(
        'title'    => __('Reset Settings', 'axai-galaxy'),
        'priority' => 1,
    ));
    
    $wp_customize->add_setting('axai_reset_settings', array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('axai_reset_settings', array(
        'label'       => __('Reset All Theme Settings', 'axai-galaxy'),
        'description' => __('Click to reset ALL theme settings to defaults. Cannot be undone!', 'axai-galaxy'),
        'section'     => 'axai_reset_section',
        'type'        => 'button',
        'input_attrs' => array(
            'value' => __('Reset to Defaults', 'axai-galaxy'),
            'class' => 'button button-secondary axai-reset-button',
        ),
    ));
    
    // ==========================================
    // LAYOUT SETTINGS PANEL
    // ==========================================
    $wp_customize->add_panel('axai_layout_panel', array(
        'title'       => __('Layout Settings', 'axai-galaxy'),
        'description' => __('Configure site layout options', 'axai-galaxy'),
        'priority'    => 30,
    ));
    
    // ==========================================
    // SECTION: Header Settings
    // ==========================================
    $wp_customize->add_section('axai_header_section', array(
        'title'    => __('Header', 'axai-galaxy'),
        'panel'    => 'axai_layout_panel',
        'priority' => 10,
    ));
    
    // Header Container Width
    $wp_customize->add_setting('axai_header_container_width', array(
        'default'           => 'boxed',
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_select',
    ));
    $wp_customize->add_control('axai_header_container_width', array(
        'label'   => __('Header Container Width', 'axai-galaxy'),
        'section' => 'axai_header_section',
        'type'    => 'radio',
        'choices' => array(
            'boxed'      => __('Boxed', 'axai-galaxy'),
            'full-width' => __('Full Width', 'axai-galaxy'),
        ),
    ));
    
    // Header Boxed Max Width
    $wp_customize->add_setting('axai_header_boxed_width', array(
        'default'           => 1200,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_header_boxed_width', array(
        'label'       => __('Header Boxed Max Width (px)', 'axai-galaxy'),
        'description' => __('Maximum width for boxed header', 'axai-galaxy'),
        'section'     => 'axai_header_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 800,
            'max'  => 2000,
            'step' => 10,
        ),
    ));
    
    // Logo Position
    $wp_customize->add_setting('axai_logo_position', array(
        'default'           => 'left',
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_select',
    ));
    $wp_customize->add_control('axai_logo_position', array(
        'label'   => __('Logo Position', 'axai-galaxy'),
        'section' => 'axai_header_section',
        'type'    => 'radio',
        'choices' => array(
            'left'   => __('Left', 'axai-galaxy'),
            'center' => __('Center', 'axai-galaxy'),
            'right'  => __('Right', 'axai-galaxy'),
        ),
    ));
    
    // Menu Alignment
    $wp_customize->add_setting('axai_menu_alignment', array(
        'default'           => 'right',
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_select',
    ));
    $wp_customize->add_control('axai_menu_alignment', array(
        'label'       => __('Menu Alignment', 'axai-galaxy'),
        'description' => __('Menu alignment relative to logo', 'axai-galaxy'),
        'section'     => 'axai_header_section',
        'type'        => 'radio',
        'choices'     => array(
            'left'   => __('Left', 'axai-galaxy'),
            'center' => __('Center', 'axai-galaxy'),
            'right'  => __('Right', 'axai-galaxy'),
        ),
    ));
    
    // Logo Spacing
    $wp_customize->add_setting('axai_logo_spacing', array(
        'default'           => 40,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_logo_spacing', array(
        'label'       => __('Logo Spacing (px)', 'axai-galaxy'),
        'description' => __('Space between logo and menu', 'axai-galaxy'),
        'section'     => 'axai_header_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // Header Sticky
    $wp_customize->add_setting('axai_header_sticky', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('axai_header_sticky', array(
        'label'   => __('Sticky Header', 'axai-galaxy'),
        'section' => 'axai_header_section',
        'type'    => 'checkbox',
    ));
    
    // Header Transparent
    $wp_customize->add_setting('axai_header_transparent', array(
        'default'           => false,
        'transport'         => 'refresh',
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('axai_header_transparent', array(
        'label'       => __('Transparent Header on Front Page', 'axai-galaxy'),
        'description' => __('Make header transparent on homepage', 'axai-galaxy'),
        'section'     => 'axai_header_section',
        'type'        => 'checkbox',
    ));
    
    // Header Transparency Level
    $wp_customize->add_setting('axai_header_transparency', array(
        'default'           => 80,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_header_transparency', array(
        'label'       => __('Header Transparency (%)', 'axai-galaxy'),
        'description' => __('Transparency level when transparent is enabled', 'axai-galaxy'),
        'section'     => 'axai_header_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // Menu Text Color
    $wp_customize->add_setting('axai_menu_text_color', array(
        'default'           => '#ffffff',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_menu_text_color', array(
        'label'   => __('Menu Text Color', 'axai-galaxy'),
        'section' => 'axai_header_section',
    )));
    
    // Menu Text Size
    $wp_customize->add_setting('axai_menu_text_size', array(
        'default'           => 16,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_menu_text_size', array(
        'label'       => __('Menu Text Size (px)', 'axai-galaxy'),
        'section'     => 'axai_header_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
    ));
    
    // ==========================================
    // SECTION: Content Width Settings
    // ==========================================
    $wp_customize->add_section('axai_content_width_section', array(
        'title'    => __('Content Width', 'axai-galaxy'),
        'panel'    => 'axai_layout_panel',
        'priority' => 20,
    ));
    
    // Content Width Type
    $wp_customize->add_setting('axai_content_width_type', array(
        'default'           => 'boxed',
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_select',
    ));
    $wp_customize->add_control('axai_content_width_type', array(
        'label'   => __('Content Width Type', 'axai-galaxy'),
        'section' => 'axai_content_width_section',
        'type'    => 'radio',
        'choices' => array(
            'boxed'      => __('Boxed', 'axai-galaxy'),
            'full-width' => __('Full Width', 'axai-galaxy'),
        ),
    ));
    
    // Content Boxed Max Width
    $wp_customize->add_setting('axai_content_boxed_width', array(
        'default'           => 1200,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_content_boxed_width', array(
        'label'       => __('Content Boxed Max Width (px)', 'axai-galaxy'),
        'description' => __('Maximum width for boxed content', 'axai-galaxy'),
        'section'     => 'axai_content_width_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 800,
            'max'  => 2000,
            'step' => 10,
        ),
    ));
    
    // Content Container Background Color
    $wp_customize->add_setting('axai_content_bg_color', array(
        'default'           => '#0a0e1a',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_content_bg_color', array(
        'label'   => __('Content Background Color', 'axai-galaxy'),
        'section' => 'axai_content_width_section',
    )));
    
    // Content Container Transparency
    $wp_customize->add_setting('axai_content_transparency', array(
        'default'           => 60,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_content_transparency', array(
        'label'       => __('Content Container Transparency (%)', 'axai-galaxy'),
        'description' => __('0 = fully transparent, 100 = fully opaque', 'axai-galaxy'),
        'section'     => 'axai_content_width_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // ==========================================
    // SECTION: Link Colors
    // ==========================================
    $wp_customize->add_section('axai_link_colors_section', array(
        'title'    => __('Link Colors', 'axai-galaxy'),
        'panel'    => 'axai_layout_panel',
        'priority' => 25,
    ));
    
    // Link Color
    $wp_customize->add_setting('axai_link_color', array(
        'default'           => '#667eea',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_link_color', array(
        'label'   => __('Link Color', 'axai-galaxy'),
        'section' => 'axai_link_colors_section',
    )));
    
    // Link Hover Color
    $wp_customize->add_setting('axai_link_hover_color', array(
        'default'           => '#764ba2',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_link_hover_color', array(
        'label'   => __('Link Hover Color', 'axai-galaxy'),
        'section' => 'axai_link_colors_section',
    )));
    
    // ==========================================
    // SECTION: Hero Settings
    // ==========================================
    $wp_customize->add_section('axai_hero_section', array(
        'title'    => __('Hero Section', 'axai-galaxy'),
        'panel'    => 'axai_layout_panel',
        'priority' => 30,
    ));
    
    // Show Hero Section
    $wp_customize->add_setting('axai_show_hero_section', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('axai_show_hero_section', array(
        'label'   => __('Show Hero Section', 'axai-galaxy'),
        'section' => 'axai_hero_section',
        'type'    => 'checkbox',
    ));
    
    // Hero Title
    $wp_customize->add_setting('axai_hero_title', array(
        'default'           => get_bloginfo('name'),
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('axai_hero_title', array(
        'label'   => __('Hero Title', 'axai-galaxy'),
        'section' => 'axai_hero_section',
        'type'    => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('axai_hero_subtitle', array(
        'default'           => get_bloginfo('description'),
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('axai_hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'axai-galaxy'),
        'section' => 'axai_hero_section',
        'type'    => 'textarea',
    ));
    
    // Hero Button Text
    $wp_customize->add_setting('axai_hero_button_text', array(
        'default'           => __('Learn More', 'axai-galaxy'),
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('axai_hero_button_text', array(
        'label'   => __('Button Text', 'axai-galaxy'),
        'section' => 'axai_hero_section',
        'type'    => 'text',
    ));
    
    // Hero Button URL
    $wp_customize->add_setting('axai_hero_button_url', array(
        'default'           => '#content',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('axai_hero_button_url', array(
        'label'   => __('Button URL', 'axai-galaxy'),
        'section' => 'axai_hero_section',
        'type'    => 'url',
    ));
    
    // ==========================================
    // SECTION: Blog Settings
    // ==========================================
    $wp_customize->add_section('axai_blog_section', array(
        'title'    => __('Blog', 'axai-galaxy'),
        'panel'    => 'axai_layout_panel',
        'priority' => 40,
    ));
    
    // Blog Columns
    $wp_customize->add_setting('axai_blog_columns', array(
        'default'           => 3,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_blog_columns', array(
        'label'   => __('Blog Columns', 'axai-galaxy'),
        'section' => 'axai_blog_section',
        'type'    => 'select',
        'choices' => array(
            1 => __('1 Column', 'axai-galaxy'),
            2 => __('2 Columns', 'axai-galaxy'),
            3 => __('3 Columns', 'axai-galaxy'),
            4 => __('4 Columns', 'axai-galaxy'),
        ),
    ));
    
    // Show Featured Image
    $wp_customize->add_setting('axai_show_blog_featured_image', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('axai_show_blog_featured_image', array(
        'label'   => __('Show Featured Images', 'axai-galaxy'),
        'section' => 'axai_blog_section',
        'type'    => 'checkbox',
    ));
    
    // Show Excerpt
    $wp_customize->add_setting('axai_show_blog_excerpt', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('axai_show_blog_excerpt', array(
        'label'   => __('Show Excerpts', 'axai-galaxy'),
        'section' => 'axai_blog_section',
        'type'    => 'checkbox',
    ));
    
    // ==========================================
    // SECTION: Footer Settings
    // ==========================================
    $wp_customize->add_section('axai_footer_section', array(
        'title'    => __('Footer', 'axai-galaxy'),
        'panel'    => 'axai_layout_panel',
        'priority' => 50,
    ));
    
    // Footer Container Width
    $wp_customize->add_setting('axai_footer_container_width', array(
        'default'           => 'boxed',
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_select',
    ));
    $wp_customize->add_control('axai_footer_container_width', array(
        'label'   => __('Footer Container Width', 'axai-galaxy'),
        'section' => 'axai_footer_section',
        'type'    => 'radio',
        'choices' => array(
            'boxed'      => __('Boxed', 'axai-galaxy'),
            'full-width' => __('Full Width', 'axai-galaxy'),
        ),
    ));
    
    // Footer Boxed Max Width
    $wp_customize->add_setting('axai_footer_boxed_width', array(
        'default'           => 1200,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_footer_boxed_width', array(
        'label'       => __('Footer Boxed Max Width (px)', 'axai-galaxy'),
        'description' => __('Maximum width for boxed footer', 'axai-galaxy'),
        'section'     => 'axai_footer_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 800,
            'max'  => 2000,
            'step' => 10,
        ),
    ));
    
    // Footer Transparent
    $wp_customize->add_setting('axai_footer_transparent', array(
        'default'           => false,
        'transport'         => 'refresh',
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('axai_footer_transparent', array(
        'label'       => __('Transparent Footer', 'axai-galaxy'),
        'description' => __('Enable footer transparency', 'axai-galaxy'),
        'section'     => 'axai_footer_section',
        'type'        => 'checkbox',
    ));
    
    // Footer Transparency Level
    $wp_customize->add_setting('axai_footer_transparency', array(
        'default'           => 95,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_footer_transparency', array(
        'label'       => __('Footer Transparency (%)', 'axai-galaxy'),
        'description' => __('Transparency level when transparent is enabled', 'axai-galaxy'),
        'section'     => 'axai_footer_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));
    
    // Copyright Text
    $wp_customize->add_setting('axai_copyright_text', array(
        'default'           => sprintf('© %1$s %2$s. All rights reserved.', date('Y'), get_bloginfo('name')),
        'transport'         => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('axai_copyright_text', array(
        'label'   => __('Copyright Text', 'axai-galaxy'),
        'section' => 'axai_footer_section',
        'type'    => 'textarea',
    ));
    
    // Show Theme Credit
    $wp_customize->add_setting('axai_show_theme_credit', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('axai_show_theme_credit', array(
        'label'   => __('Show Theme Credit', 'axai-galaxy'),
        'section' => 'axai_footer_section',
        'type'    => 'checkbox',
    ));

    // ==========================================
    // GALAXY PARAMETERS PANEL
    // ==========================================
    $wp_customize->add_panel('axai_galaxy_panel', array(
        'title'       => __('Galaxy Parameters', 'axai-galaxy'),
        'description' => __('Customize the 3D galaxy starfield animation. Use decimal point (.) not comma (,) for decimal numbers.', 'axai-galaxy'),
        'priority'    => 31,
    ));
    
    // ==========================================
    // SECTION: Speed Settings
    // ==========================================
    $wp_customize->add_section('axai_speed_section', array(
        'title'    => __('Speed Settings', 'axai-galaxy'),
        'panel'    => 'axai_galaxy_panel',
        'priority' => 10,
    ));
    
    // Idle Speed
    $wp_customize->add_setting('axai_idle_speed', array(
        'default'           => 0.5,
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_float',
    ));
    $wp_customize->add_control('axai_idle_speed', array(
        'label'       => __('Idle Speed', 'axai-galaxy'),
        'description' => __('Normal animation speed (use decimal point: 0.1 - 5.0)', 'axai-galaxy'),
        'section'     => 'axai_speed_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => '0.5',
        ),
    ));
    
    // Warp Speed
    $wp_customize->add_setting('axai_warp_speed', array(
        'default'           => 250,
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_float',
    ));
    $wp_customize->add_control('axai_warp_speed', array(
        'label'       => __('Warp Speed', 'axai-galaxy'),
        'description' => __('Speed when hovering warp triggers (50 - 500)', 'axai-galaxy'),
        'section'     => 'axai_speed_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 500,
            'step' => 10,
        ),
    ));
    
    // ==========================================
    // SECTION: Star Settings
    // ==========================================
    $wp_customize->add_section('axai_star_section', array(
        'title'    => __('Star Settings', 'axai-galaxy'),
        'panel'    => 'axai_galaxy_panel',
        'priority' => 20,
    ));
    
    // Star Count
    $wp_customize->add_setting('axai_star_count', array(
        'default'           => 1000,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_star_count', array(
        'label'       => __('Star Count', 'axai-galaxy'),
        'description' => __('Total number of stars (500 - 3000)', 'axai-galaxy'),
        'section'     => 'axai_star_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 500,
            'max'  => 3000,
            'step' => 100,
        ),
    ));
    
    // Star Colors
    $star_colors = array(
        'purple' => array('label' => 'Purple Stars', 'default' => array('r' => 0.65, 'g' => 0.3, 'b' => 1.0)),
        'pink'   => array('label' => 'Pink Stars', 'default' => array('r' => 1.0, 'g' => 0.3, 'b' => 0.6)),
        'blue'   => array('label' => 'Blue Stars', 'default' => array('r' => 0.3, 'g' => 0.6, 'b' => 1.0)),
        'white'  => array('label' => 'White Stars', 'default' => array('r' => 1.0, 'g' => 1.0, 'b' => 1.0)),
    );
    
    foreach ($star_colors as $key => $color) {
        $wp_customize->add_setting('axai_star_color_' . $key, array(
            'default'           => $color['default'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_rgb_color',
        ));
        $wp_customize->add_control(new Axai_RGB_Color_Control($wp_customize, 'axai_star_color_' . $key, array(
            'label'   => __($color['label'], 'axai-galaxy'),
            'section' => 'axai_star_section',
        )));
    }
    
    // More star settings
    $wp_customize->add_setting('axai_star_min_radius', array(
        'default'           => 100,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_star_min_radius', array(
        'label'       => __('Star Minimum Radius', 'axai-galaxy'),
        'description' => __('Minimum distance from center (50 - 500)', 'axai-galaxy'),
        'section'     => 'axai_star_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 50, 'max' => 500, 'step' => 10),
    ));
    
    $wp_customize->add_setting('axai_star_max_radius', array(
        'default'           => 500,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_star_max_radius', array(
        'label'       => __('Star Maximum Radius', 'axai-galaxy'),
        'description' => __('Maximum distance from center (200 - 1000)', 'axai-galaxy'),
        'section'     => 'axai_star_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 200, 'max' => 1000, 'step' => 10),
    ));
    
    // Star Brightness
    $wp_customize->add_setting('axai_star_brightness', array(
        'default'           => 2.5,
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_float',
    ));
    $wp_customize->add_control('axai_star_brightness', array(
        'label'       => __('Star Brightness', 'axai-galaxy'),
        'description' => __('Use decimal point (example: 2.5)', 'axai-galaxy'),
        'section'     => 'axai_star_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => '2.5',
        ),
    ));
    
    // ==========================================
    // SECTION: Nebula Settings
    // ==========================================
    $wp_customize->add_section('axai_nebula_section', array(
        'title'    => __('Nebula Settings', 'axai-galaxy'),
        'panel'    => 'axai_galaxy_panel',
        'priority' => 30,
    ));
    
    // Nebula Count
    $wp_customize->add_setting('axai_nebula_count', array(
        'default'           => 80,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_nebula_count', array(
        'label'       => __('Nebula Count', 'axai-galaxy'),
        'description' => __('Number of nebula particles (20 - 200)', 'axai-galaxy'),
        'section'     => 'axai_nebula_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 20, 'max' => 200, 'step' => 10),
    ));
    
    // Nebula Base Opacity
    $wp_customize->add_setting('axai_nebula_base_opacity', array(
        'default'           => 0.3,
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_float',
    ));
    $wp_customize->add_control('axai_nebula_base_opacity', array(
        'label'       => __('Nebula Base Opacity', 'axai-galaxy'),
        'description' => __('Use decimal point (example: 0.3)', 'axai-galaxy'),
        'section'     => 'axai_nebula_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => '0.3',
        ),
    ));
    
    // Nebula Colors
    $nebula_colors = array(
        'purple'      => array('label' => 'Purple Nebula', 'default' => array('r' => 0.5, 'g' => 0.2, 'b' => 0.8)),
        'blue'        => array('label' => 'Blue Nebula', 'default' => array('r' => 0.2, 'g' => 0.4, 'b' => 0.8)),
        'pink'        => array('label' => 'Pink Nebula', 'default' => array('r' => 0.8, 'g' => 0.2, 'b' => 0.5)),
        'warp_violet' => array('label' => 'Warp Violet', 'default' => array('r' => 0.6, 'g' => 0.1, 'b' => 0.9)),
        'warp_red'    => array('label' => 'Warp Red', 'default' => array('r' => 1.0, 'g' => 0.1, 'b' => 0.1)),
    );
    
    foreach ($nebula_colors as $key => $color) {
        $wp_customize->add_setting('axai_nebula_color_' . $key, array(
            'default'           => $color['default'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_rgb_color',
        ));
        $wp_customize->add_control(new Axai_RGB_Color_Control($wp_customize, 'axai_nebula_color_' . $key, array(
            'label'   => __($color['label'], 'axai-galaxy'),
            'section' => 'axai_nebula_section',
        )));
    }
    
    // ==========================================
    // SECTION: Galaxy Settings
    // ==========================================
    $wp_customize->add_section('axai_galaxy_section', array(
        'title'    => __('Galaxy Settings', 'axai-galaxy'),
        'panel'    => 'axai_galaxy_panel',
        'priority' => 40,
    ));
    
    // Galaxies Enabled
    $wp_customize->add_setting('axai_galaxies_enabled', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    $wp_customize->add_control('axai_galaxies_enabled', array(
        'label'       => __('Enable Galaxies', 'axai-galaxy'),
        'description' => __('Show spiral galaxies in warp mode', 'axai-galaxy'),
        'section'     => 'axai_galaxy_section',
        'type'        => 'checkbox',
    ));
    
    $wp_customize->add_setting('axai_galaxy_count', array(
        'default'           => 5,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_galaxy_count', array(
        'label'       => __('Maximum Galaxies', 'axai-galaxy'),
        'description' => __('Maximum number of visible galaxies (1 - 10)', 'axai-galaxy'),
        'section'     => 'axai_galaxy_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 1, 'max' => 10, 'step' => 1),
    ));
    
    $wp_customize->add_setting('axai_galaxy_opacity', array(
        'default'           => 0.3,
        'transport'         => 'refresh',
        'sanitize_callback' => 'axai_sanitize_float',
    ));
    $wp_customize->add_control('axai_galaxy_opacity', array(
        'label'       => __('Galaxy Opacity', 'axai-galaxy'),
        'description' => __('Use decimal point (example: 0.3)', 'axai-galaxy'),
        'section'     => 'axai_galaxy_section',
        'type'        => 'text',
        'input_attrs' => array(
            'placeholder' => '0.3',
        ),
    ));
    
    // ==========================================
    // SECTION: Galaxy Types - mit Float-Handling
    // ==========================================
    $galaxy_types = array(
        'milky_way' => array(
            'name' => 'Milky Way Style',
            'arms' => 4,
            'armPoints' => 2500,
            'tightness' => 2.5,
            'diskThickness' => 0.25,
            'armWidth' => 0.08,
            'armDensity' => 6.5,
            'coreColor' => array('r' => 1.0, 'g' => 0.95, 'b' => 0.85),
            'innerColor' => array('r' => 0.95, 'g' => 0.85, 'b' => 0.7),
            'outerColor' => array('r' => 0.5, 'g' => 0.6, 'b' => 0.85),
            'dustColor' => array('r' => 0.4, 'g' => 0.35, 'b' => 0.3),
            'hasBar' => true,
        ),
        'andromeda' => array(
            'name' => 'Andromeda Style',
            'arms' => 2,
            'armPoints' => 5250,
            'tightness' => 5.3,
            'diskThickness' => 0.32,
            'armWidth' => 0.06,
            'armDensity' => 3.0,
            'coreColor' => array('r' => 1.0, 'g' => 0.92, 'b' => 0.75),
            'innerColor' => array('r' => 0.85, 'g' => 0.75, 'b' => 0.95),
            'outerColor' => array('r' => 0.4, 'g' => 0.5, 'b' => 0.9),
            'dustColor' => array('r' => 0.5, 'g' => 0.3, 'b' => 0.4),
            'hasBar' => false,
        ),
    );
    
    foreach ($galaxy_types as $type_key => $type_data) {
        $wp_customize->add_section('axai_galaxy_' . $type_key . '_section', array(
            'title'    => __($type_data['name'], 'axai-galaxy'),
            'panel'    => 'axai_galaxy_panel',
            'priority' => 50,
        ));
        
        // Spiral Arms
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_arms', array(
            'default'           => $type_data['arms'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control('axai_galaxy_' . $type_key . '_arms', array(
            'label'       => __('Number of Spiral Arms', 'axai-galaxy'),
            'section'     => 'axai_galaxy_' . $type_key . '_section',
            'type'        => 'number',
            'input_attrs' => array('min' => 1, 'max' => 10, 'step' => 1),
        ));
        
        // Arm Points
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_armPoints', array(
            'default'           => $type_data['armPoints'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control('axai_galaxy_' . $type_key . '_armPoints', array(
            'label'       => __('Points Per Arm', 'axai-galaxy'),
            'description' => __('Number of stars per spiral arm', 'axai-galaxy'),
            'section'     => 'axai_galaxy_' . $type_key . '_section',
            'type'        => 'number',
            'input_attrs' => array('min' => 500, 'max' => 10000, 'step' => 100),
        ));
        
        // Tightness - TEXT FIELD mit Float Sanitization
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_tightness', array(
            'default'           => $type_data['tightness'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_float',
        ));
        $wp_customize->add_control('axai_galaxy_' . $type_key . '_tightness', array(
            'label'       => __('Spiral Tightness', 'axai-galaxy'),
            'description' => __('Use decimal point (example: 2.5)', 'axai-galaxy'),
            'section'     => 'axai_galaxy_' . $type_key . '_section',
            'type'        => 'text',
            'input_attrs' => array(
                'placeholder' => number_format($type_data['tightness'], 1, '.', ''),
            ),
        ));
        
        // Disk Thickness
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_diskThickness', array(
            'default'           => $type_data['diskThickness'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_float',
        ));
        $wp_customize->add_control('axai_galaxy_' . $type_key . '_diskThickness', array(
            'label'       => __('Disk Thickness', 'axai-galaxy'),
            'description' => __('Use decimal point (example: 0.25)', 'axai-galaxy'),
            'section'     => 'axai_galaxy_' . $type_key . '_section',
            'type'        => 'text',
            'input_attrs' => array(
                'placeholder' => number_format($type_data['diskThickness'], 2, '.', ''),
            ),
        ));
        
        // Arm Width
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_armWidth', array(
            'default'           => $type_data['armWidth'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_float',
        ));
        $wp_customize->add_control('axai_galaxy_' . $type_key . '_armWidth', array(
            'label'       => __('Arm Width', 'axai-galaxy'),
            'description' => __('Use decimal point (example: 0.08)', 'axai-galaxy'),
            'section'     => 'axai_galaxy_' . $type_key . '_section',
            'type'        => 'text',
            'input_attrs' => array(
                'placeholder' => number_format($type_data['armWidth'], 2, '.', ''),
            ),
        ));
        
        // Arm Density
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_armDensity', array(
            'default'           => $type_data['armDensity'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_float',
        ));
        $wp_customize->add_control('axai_galaxy_' . $type_key . '_armDensity', array(
            'label'       => __('Arm Density', 'axai-galaxy'),
            'description' => __('Use decimal point (example: 6.5)', 'axai-galaxy'),
            'section'     => 'axai_galaxy_' . $type_key . '_section',
            'type'        => 'text',
            'input_attrs' => array(
                'placeholder' => number_format($type_data['armDensity'], 1, '.', ''),
            ),
        ));
        
        // Has Bar
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_hasBar', array(
            'default'           => $type_data['hasBar'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'rest_sanitize_boolean',
        ));
        $wp_customize->add_control('axai_galaxy_' . $type_key . '_hasBar', array(
            'label'       => __('Has Central Bar', 'axai-galaxy'),
            'description' => __('Show bar structure in center', 'axai-galaxy'),
            'section'     => 'axai_galaxy_' . $type_key . '_section',
            'type'        => 'checkbox',
        ));
        
        // Core Color
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_core_color', array(
            'default'           => $type_data['coreColor'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_rgb_color',
        ));
        $wp_customize->add_control(new Axai_RGB_Color_Control($wp_customize, 'axai_galaxy_' . $type_key . '_core_color', array(
            'label'   => __('Core Color', 'axai-galaxy'),
            'section' => 'axai_galaxy_' . $type_key . '_section',
        )));
        
        // Inner Color
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_inner_color', array(
            'default'           => $type_data['innerColor'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_rgb_color',
        ));
        $wp_customize->add_control(new Axai_RGB_Color_Control($wp_customize, 'axai_galaxy_' . $type_key . '_inner_color', array(
            'label'   => __('Inner Arm Color', 'axai-galaxy'),
            'section' => 'axai_galaxy_' . $type_key . '_section',
        )));
        
        // Outer Color
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_outer_color', array(
            'default'           => $type_data['outerColor'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_rgb_color',
        ));
        $wp_customize->add_control(new Axai_RGB_Color_Control($wp_customize, 'axai_galaxy_' . $type_key . '_outer_color', array(
            'label'   => __('Outer Arm Color', 'axai-galaxy'),
            'section' => 'axai_galaxy_' . $type_key . '_section',
        )));
        
        // Dust Color
        $wp_customize->add_setting('axai_galaxy_' . $type_key . '_dust_color', array(
            'default'           => $type_data['dustColor'],
            'transport'         => 'refresh',
            'sanitize_callback' => 'axai_sanitize_rgb_color',
        ));
        $wp_customize->add_control(new Axai_RGB_Color_Control($wp_customize, 'axai_galaxy_' . $type_key . '_dust_color', array(
            'label'   => __('Dust Lane Color', 'axai-galaxy'),
            'section' => 'axai_galaxy_' . $type_key . '_section',
        )));
    }
    
    // ==========================================
    // SECTION: Camera & Parallax Settings
    // ==========================================
    $wp_customize->add_section('axai_camera_section', array(
        'title'    => __('Camera & Parallax', 'axai-galaxy'),
        'panel'    => 'axai_galaxy_panel',
        'priority' => 60,
    ));
    
    // Camera FOV
    $wp_customize->add_setting('axai_camera_fov', array(
        'default'           => 85,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_camera_fov', array(
        'label'       => __('Camera Field of View', 'axai-galaxy'),
        'description' => __('Camera FOV in degrees (60 - 120)', 'axai-galaxy'),
        'section'     => 'axai_camera_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 60, 'max' => 120, 'step' => 5),
    ));
    
    // Parallax Intensity
    $wp_customize->add_setting('axai_parallax_intensity', array(
        'default'           => 10,
        'transport'         => 'refresh',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('axai_parallax_intensity', array(
        'label'       => __('Parallax Intensity', 'axai-galaxy'),
        'description' => __('Mouse movement parallax effect (0 - 30)', 'axai-galaxy'),
        'section'     => 'axai_camera_section',
        'type'        => 'number',
        'input_attrs' => array('min' => 0, 'max' => 30, 'step' => 1),
    ));
}
add_action('customize_register', 'axai_customize_register');

/**
 * Reset settings AJAX handler
 */
function axai_reset_theme_settings() {
    check_ajax_referer('axai_reset_nonce', 'nonce');
    
    if (!current_user_can('edit_theme_options')) {
        wp_send_json_error('Unauthorized');
    }
    
    // Alle theme mods löschen
    $all_mods = get_theme_mods();
    
    if ($all_mods) {
        foreach ($all_mods as $key => $value) {
            // Alle axai_ prefixed Einstellungen entfernen
            if (strpos($key, 'axai_') === 0) {
                remove_theme_mod($key);
            }
        }
    }
    
    // Auch nav_menu_locations zurücksetzen
    remove_theme_mod('nav_menu_locations');
    
    // Cache leeren
    wp_cache_flush();
    
    wp_send_json_success('All theme settings have been reset to defaults');
}
add_action('wp_ajax_axai_reset_settings', 'axai_reset_theme_settings');

/**
 * Customizer controls scripts
 */
function axai_customizer_controls_scripts() {
    wp_enqueue_script(
        'axai-customizer-controls',
        get_template_directory_uri() . '/assets/js/customizer-controls.js',
        array('jquery', 'customize-controls'),
        AXAI_VERSION,
        true
    );
    
    wp_localize_script('axai-customizer-controls', 'axaiCustomizer', array(
        'resetNonce' => wp_create_nonce('axai_reset_nonce'),
        'ajaxUrl'    => admin_url('admin-ajax.php'),
    ));
}
add_action('customize_controls_enqueue_scripts', 'axai_customizer_controls_scripts');
