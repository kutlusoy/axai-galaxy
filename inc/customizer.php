<?php
/**
 * AxAI Galaxy Theme Customizer - VOLLSTÄNDIG
 * @package AxAI_Galaxy
 */

if (!defined('ABSPATH')) exit;

function axai_sanitize_small_float($value) {
    return filter_var($value, FILTER_VALIDATE_FLOAT) !== false ? (float)$value : 0.0001;
}

function axai_customize_register($wp_customize) {
    $wp_customize->add_panel('axai_galaxy_panel', array('title' => __('Galaxy Settings', 'axai-galaxy'), 'priority' => 30));
    
    // SPEED
    $wp_customize->add_section('axai_speed_section', array('title' => __('Speed Settings', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 10));
    $wp_customize->add_setting('axai_idle_speed', array('default' => 0.5, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_idle_speed', array('label' => __('Idle Speed', 'axai-galaxy'), 'section' => 'axai_speed_section', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 10, 'step' => 0.1)));
    $wp_customize->add_setting('axai_warp_speed', array('default' => 250, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_warp_speed', array('label' => __('Warp Speed', 'axai-galaxy'), 'section' => 'axai_speed_section', 'type' => 'number', 'input_attrs' => array('min' => 50, 'max' => 500, 'step' => 10)));
    
    // STARS
    $wp_customize->add_section('axai_stars_section', array('title' => __('Stars', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 20));
    $wp_customize->add_setting('axai_star_count', array('default' => 1000, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_count', array('label' => __('Star Count', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 100, 'max' => 5000, 'step' => 100)));
    $wp_customize->add_setting('axai_star_min_radius', array('default' => 100, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_min_radius', array('label' => __('Star Min Radius', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 50, 'max' => 500, 'step' => 10)));
    $wp_customize->add_setting('axai_star_max_radius', array('default' => 500, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_max_radius', array('label' => __('Star Max Radius', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 100, 'max' => 1000, 'step' => 50)));
    $wp_customize->add_setting('axai_star_depth_range', array('default' => 4000, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_depth_range', array('label' => __('Star Depth Range', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 1000, 'max' => 10000, 'step' => 500)));
    $wp_customize->add_setting('axai_star_base_opacity', array('default' => 0.9, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_base_opacity', array('label' => __('Star Base Opacity', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_star_brightness', array('default' => 2.5, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_brightness', array('label' => __('Star Brightness', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 0.5, 'max' => 5.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_star_warp_brightness', array('default' => 0.5, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_warp_brightness', array('label' => __('Star Warp Brightness', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 2.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_star_min_size', array('default' => 0.5, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_min_size', array('label' => __('Star Min Size', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 2.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_star_max_size', array('default' => 1.0, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_max_size', array('label' => __('Star Max Size', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 0.5, 'max' => 3.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_star_close_count', array('default' => 50, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_star_close_count', array('label' => __('Close Stars Count', 'axai-galaxy'), 'section' => 'axai_stars_section', 'type' => 'number', 'input_attrs' => array('min' => 10, 'max' => 200, 'step' => 10)));
    
    // NEBULA
    $wp_customize->add_section('axai_nebula_section', array('title' => __('Nebula', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 30));
    $wp_customize->add_setting('axai_nebula_count', array('default' => 80, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_nebula_count', array('label' => __('Nebula Count', 'axai-galaxy'), 'section' => 'axai_nebula_section', 'type' => 'number', 'input_attrs' => array('min' => 20, 'max' => 200, 'step' => 10)));
    $wp_customize->add_setting('axai_nebula_min_radius', array('default' => 300, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_nebula_min_radius', array('label' => __('Nebula Min Radius', 'axai-galaxy'), 'section' => 'axai_nebula_section', 'type' => 'number', 'input_attrs' => array('min' => 100, 'max' => 1000, 'step' => 50)));
    $wp_customize->add_setting('axai_nebula_max_radius', array('default' => 900, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_nebula_max_radius', array('label' => __('Nebula Max Radius', 'axai-galaxy'), 'section' => 'axai_nebula_section', 'type' => 'number', 'input_attrs' => array('min' => 300, 'max' => 2000, 'step' => 100)));
    $wp_customize->add_setting('axai_nebula_base_opacity', array('default' => 0.3, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_nebula_base_opacity', array('label' => __('Nebula Base Opacity', 'axai-galaxy'), 'section' => 'axai_nebula_section', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_nebula_base_size', array('default' => 1200, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_nebula_base_size', array('label' => __('Nebula Base Size', 'axai-galaxy'), 'section' => 'axai_nebula_section', 'type' => 'number', 'input_attrs' => array('min' => 500, 'max' => 3000, 'step' => 100)));
    
    // GALAXIES GENERAL
    $wp_customize->add_section('axai_galaxies_section', array('title' => __('Galaxies General', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 40));
    $wp_customize->add_setting('axai_galaxies_enabled', array('default' => true, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxies_enabled', array('label' => __('Enable Galaxies', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_galaxy_count', array('default' => 5, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_count', array('label' => __('Galaxy Count', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 20, 'step' => 1)));
    $wp_customize->add_setting('axai_galaxy_min_radius', array('default' => 600, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_min_radius', array('label' => __('Galaxy Min Radius', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 300, 'max' => 1000, 'step' => 50)));
    $wp_customize->add_setting('axai_galaxy_max_radius', array('default' => 800, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_max_radius', array('label' => __('Galaxy Max Radius', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 500, 'max' => 1500, 'step' => 50)));
    $wp_customize->add_setting('axai_galaxy_speed', array('default' => 0.02, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_speed', array('label' => __('Galaxy Speed', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 0.001, 'max' => 0.1, 'step' => 0.001)));
    $wp_customize->add_setting('axai_galaxy_base_size', array('default' => 800, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_base_size', array('label' => __('Galaxy Base Size', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 400, 'max' => 2000, 'step' => 50)));
    $wp_customize->add_setting('axai_galaxy_max_size', array('default' => 1200, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_max_size', array('label' => __('Galaxy Max Size', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 600, 'max' => 3000, 'step' => 100)));
    $wp_customize->add_setting('axai_galaxy_opacity', array('default' => 0.3, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_opacity', array('label' => __('Galaxy Opacity', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_rotation_speed', array('default' => 0.0001, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_rotation_speed', array('label' => __('Galaxy Rotation Speed', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 0.00001, 'max' => 0.001, 'step' => 0.00001)));
    $wp_customize->add_setting('axai_galaxy_core_size', array('default' => 200, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_core_size', array('label' => __('Galaxy Core Size', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 50, 'max' => 500, 'step' => 50)));
    $wp_customize->add_setting('axai_galaxy_spawn_chance', array('default' => 0.6, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_spawn_chance', array('label' => __('Galaxy Spawn Chance', 'axai-galaxy'), 'section' => 'axai_galaxies_section', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.1)));
    
    // GALAXY TYPE: MILKY WAY
    $wp_customize->add_section('axai_galaxy_milky_way', array('title' => __('Galaxy: Milky Way', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 50));
    $wp_customize->add_setting('axai_galaxy_milky_way_arms', array('default' => 4, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_arms', array('label' => __('Arms', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 10, 'step' => 1)));
    $wp_customize->add_setting('axai_galaxy_milky_way_armPoints', array('default' => 2500, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_armPoints', array('label' => __('Arm Points', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'number', 'input_attrs' => array('min' => 500, 'max' => 10000, 'step' => 250)));
    $wp_customize->add_setting('axai_galaxy_milky_way_tightness', array('default' => 2.5, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_tightness', array('label' => __('Tightness', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'number', 'input_attrs' => array('min' => 0.5, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_milky_way_hasBar', array('default' => true, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_hasBar', array('label' => __('Has Bar', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_galaxy_milky_way_diskThickness', array('default' => 0.25, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_diskThickness', array('label' => __('Disk Thickness', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_milky_way_armWidth', array('default' => 0.08, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_armWidth', array('label' => __('Arm Width', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'number', 'input_attrs' => array('min' => 0.01, 'max' => 0.3, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_milky_way_armDensity', array('default' => 6.5, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_armDensity', array('label' => __('Arm Density', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'number', 'input_attrs' => array('min' => 1.0, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_milky_way_core_color', array('default' => '#fff2d9', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_milky_way_core_color', array('label' => __('Core Color', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way')));
    $wp_customize->add_setting('axai_galaxy_milky_way_inner_color', array('default' => '#f2d9b3', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_milky_way_inner_color', array('label' => __('Inner Color', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way')));
    $wp_customize->add_setting('axai_galaxy_milky_way_outer_color', array('default' => '#8099d9', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_milky_way_outer_color', array('label' => __('Outer Color', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way')));
    $wp_customize->add_setting('axai_galaxy_milky_way_dust_color', array('default' => '#66594d', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_milky_way_dust_color', array('label' => __('Dust Color', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way')));
    $wp_customize->add_setting('axai_galaxy_milky_way_speed', array('default' => 0.02, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_speed', array('label' => __('Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'number', 'input_attrs' => array('min' => 0.001, 'max' => 0.1, 'step' => 0.001)));
    $wp_customize->add_setting('axai_galaxy_milky_way_rotationSpeed', array('default' => 0.0001, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_milky_way_rotationSpeed', array('label' => __('Rotation Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_milky_way', 'type' => 'number', 'input_attrs' => array('min' => 0.00001, 'max' => 0.001, 'step' => 0.00001)));
    
    // GALAXY TYPE: ANDROMEDA
    $wp_customize->add_section('axai_galaxy_andromeda', array('title' => __('Galaxy: Andromeda', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 60));
    $wp_customize->add_setting('axai_galaxy_andromeda_arms', array('default' => 2, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_arms', array('label' => __('Arms', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 10, 'step' => 1)));
    $wp_customize->add_setting('axai_galaxy_andromeda_armPoints', array('default' => 5250, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_armPoints', array('label' => __('Arm Points', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'number', 'input_attrs' => array('min' => 500, 'max' => 10000, 'step' => 250)));
    $wp_customize->add_setting('axai_galaxy_andromeda_tightness', array('default' => 5.3, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_tightness', array('label' => __('Tightness', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'number', 'input_attrs' => array('min' => 0.5, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_andromeda_hasBar', array('default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_hasBar', array('label' => __('Has Bar', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_galaxy_andromeda_diskThickness', array('default' => 0.32, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_diskThickness', array('label' => __('Disk Thickness', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_andromeda_armWidth', array('default' => 0.06, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_armWidth', array('label' => __('Arm Width', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'number', 'input_attrs' => array('min' => 0.01, 'max' => 0.3, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_andromeda_armDensity', array('default' => 3.0, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_armDensity', array('label' => __('Arm Density', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'number', 'input_attrs' => array('min' => 1.0, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_andromeda_core_color', array('default' => '#ffecbf', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_andromeda_core_color', array('label' => __('Core Color', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda')));
    $wp_customize->add_setting('axai_galaxy_andromeda_inner_color', array('default' => '#d9bff2', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_andromeda_inner_color', array('label' => __('Inner Color', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda')));
    $wp_customize->add_setting('axai_galaxy_andromeda_outer_color', array('default' => '#6680e6', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_andromeda_outer_color', array('label' => __('Outer Color', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda')));
    $wp_customize->add_setting('axai_galaxy_andromeda_dust_color', array('default' => '#804d66', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_andromeda_dust_color', array('label' => __('Dust Color', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda')));
    $wp_customize->add_setting('axai_galaxy_andromeda_speed', array('default' => 0.015, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_speed', array('label' => __('Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'number', 'input_attrs' => array('min' => 0.001, 'max' => 0.1, 'step' => 0.001)));
    $wp_customize->add_setting('axai_galaxy_andromeda_rotationSpeed', array('default' => 0.00008, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_andromeda_rotationSpeed', array('label' => __('Rotation Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_andromeda', 'type' => 'number', 'input_attrs' => array('min' => 0.00001, 'max' => 0.001, 'step' => 0.00001)));
    
    // GALAXY TYPE: WHIRLPOOL
    $wp_customize->add_section('axai_galaxy_whirlpool', array('title' => __('Galaxy: Whirlpool', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 70));
    $wp_customize->add_setting('axai_galaxy_whirlpool_arms', array('default' => 2, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_arms', array('label' => __('Arms', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 10, 'step' => 1)));
    $wp_customize->add_setting('axai_galaxy_whirlpool_armPoints', array('default' => 2600, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_armPoints', array('label' => __('Arm Points', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'number', 'input_attrs' => array('min' => 500, 'max' => 10000, 'step' => 250)));
    $wp_customize->add_setting('axai_galaxy_whirlpool_tightness', array('default' => 2.5, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_tightness', array('label' => __('Tightness', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'number', 'input_attrs' => array('min' => 0.5, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_whirlpool_hasBar', array('default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_hasBar', array('label' => __('Has Bar', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_galaxy_whirlpool_diskThickness', array('default' => 0.3, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_diskThickness', array('label' => __('Disk Thickness', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_whirlpool_armWidth', array('default' => 0.05, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_armWidth', array('label' => __('Arm Width', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'number', 'input_attrs' => array('min' => 0.01, 'max' => 0.3, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_whirlpool_armDensity', array('default' => 3.2, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_armDensity', array('label' => __('Arm Density', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'number', 'input_attrs' => array('min' => 1.0, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_whirlpool_core_color', array('default' => '#cc3380', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_whirlpool_core_color', array('label' => __('Core Color', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool')));
    $wp_customize->add_setting('axai_galaxy_whirlpool_inner_color', array('default' => '#f2a6cc', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_whirlpool_inner_color', array('label' => __('Inner Color', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool')));
    $wp_customize->add_setting('axai_galaxy_whirlpool_outer_color', array('default' => '#9966d9', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_whirlpool_outer_color', array('label' => __('Outer Color', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool')));
    $wp_customize->add_setting('axai_galaxy_whirlpool_dust_color', array('default' => '#3366cc', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_whirlpool_dust_color', array('label' => __('Dust Color', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool')));
    $wp_customize->add_setting('axai_galaxy_whirlpool_speed', array('default' => 0.025, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_speed', array('label' => __('Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'number', 'input_attrs' => array('min' => 0.001, 'max' => 0.1, 'step' => 0.001)));
    $wp_customize->add_setting('axai_galaxy_whirlpool_rotationSpeed', array('default' => 0.00012, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_whirlpool_rotationSpeed', array('label' => __('Rotation Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_whirlpool', 'type' => 'number', 'input_attrs' => array('min' => 0.00001, 'max' => 0.001, 'step' => 0.00001)));
    
    // GALAXY TYPE: PINWHEEL
    $wp_customize->add_section('axai_galaxy_pinwheel', array('title' => __('Galaxy: Pinwheel', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 80));
    $wp_customize->add_setting('axai_galaxy_pinwheel_arms', array('default' => 5, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_arms', array('label' => __('Arms', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 10, 'step' => 1)));
    $wp_customize->add_setting('axai_galaxy_pinwheel_armPoints', array('default' => 1750, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_armPoints', array('label' => __('Arm Points', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'number', 'input_attrs' => array('min' => 500, 'max' => 10000, 'step' => 250)));
    $wp_customize->add_setting('axai_galaxy_pinwheel_tightness', array('default' => 7.25, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_tightness', array('label' => __('Tightness', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'number', 'input_attrs' => array('min' => 0.5, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_pinwheel_hasBar', array('default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_hasBar', array('label' => __('Has Bar', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_galaxy_pinwheel_diskThickness', array('default' => 0.33, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_diskThickness', array('label' => __('Disk Thickness', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_pinwheel_armWidth', array('default' => 0.07, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_armWidth', array('label' => __('Arm Width', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'number', 'input_attrs' => array('min' => 0.01, 'max' => 0.3, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_pinwheel_armDensity', array('default' => 2.8, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_armDensity', array('label' => __('Arm Density', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'number', 'input_attrs' => array('min' => 1.0, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_pinwheel_core_color', array('default' => '#f2ffe6', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_pinwheel_core_color', array('label' => __('Core Color', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel')));
    $wp_customize->add_setting('axai_galaxy_pinwheel_inner_color', array('default' => '#ff1a1a', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_pinwheel_inner_color', array('label' => __('Inner Color', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel')));
    $wp_customize->add_setting('axai_galaxy_pinwheel_outer_color', array('default' => '#66a6f2', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_pinwheel_outer_color', array('label' => __('Outer Color', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel')));
    $wp_customize->add_setting('axai_galaxy_pinwheel_dust_color', array('default' => '#598073', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_pinwheel_dust_color', array('label' => __('Dust Color', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel')));
    $wp_customize->add_setting('axai_galaxy_pinwheel_speed', array('default' => 0.018, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_speed', array('label' => __('Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'number', 'input_attrs' => array('min' => 0.001, 'max' => 0.1, 'step' => 0.001)));
    $wp_customize->add_setting('axai_galaxy_pinwheel_rotationSpeed', array('default' => 0.00015, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_pinwheel_rotationSpeed', array('label' => __('Rotation Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_pinwheel', 'type' => 'number', 'input_attrs' => array('min' => 0.00001, 'max' => 0.001, 'step' => 0.00001)));
    
    // GALAXY TYPE: TRIANGULUM
    $wp_customize->add_section('axai_galaxy_triangulum', array('title' => __('Galaxy: Triangulum', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 90));
    $wp_customize->add_setting('axai_galaxy_triangulum_arms', array('default' => 3, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_arms', array('label' => __('Arms', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 10, 'step' => 1)));
    $wp_customize->add_setting('axai_galaxy_triangulum_armPoints', array('default' => 1300, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_armPoints', array('label' => __('Arm Points', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'number', 'input_attrs' => array('min' => 500, 'max' => 10000, 'step' => 250)));
    $wp_customize->add_setting('axai_galaxy_triangulum_tightness', array('default' => 9.35, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_tightness', array('label' => __('Tightness', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'number', 'input_attrs' => array('min' => 0.5, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_triangulum_hasBar', array('default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_hasBar', array('label' => __('Has Bar', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_galaxy_triangulum_diskThickness', array('default' => 0.24, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_diskThickness', array('label' => __('Disk Thickness', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_triangulum_armWidth', array('default' => 0.065, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_armWidth', array('label' => __('Arm Width', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'number', 'input_attrs' => array('min' => 0.01, 'max' => 0.3, 'step' => 0.001)));
    $wp_customize->add_setting('axai_galaxy_triangulum_armDensity', array('default' => 2.6, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_armDensity', array('label' => __('Arm Density', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'number', 'input_attrs' => array('min' => 1.0, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_triangulum_core_color', array('default' => '#3366cc', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_triangulum_core_color', array('label' => __('Core Color', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum')));
    $wp_customize->add_setting('axai_galaxy_triangulum_inner_color', array('default' => '#ccb3f2', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_triangulum_inner_color', array('label' => __('Inner Color', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum')));
    $wp_customize->add_setting('axai_galaxy_triangulum_outer_color', array('default' => '#8066d9', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_triangulum_outer_color', array('label' => __('Outer Color', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum')));
    $wp_customize->add_setting('axai_galaxy_triangulum_dust_color', array('default' => '#734d80', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_triangulum_dust_color', array('label' => __('Dust Color', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum')));
    $wp_customize->add_setting('axai_galaxy_triangulum_speed', array('default' => 0.022, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_speed', array('label' => __('Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'number', 'input_attrs' => array('min' => 0.001, 'max' => 0.1, 'step' => 0.001)));
    $wp_customize->add_setting('axai_galaxy_triangulum_rotationSpeed', array('default' => 0.0001, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_triangulum_rotationSpeed', array('label' => __('Rotation Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_triangulum', 'type' => 'number', 'input_attrs' => array('min' => 0.00001, 'max' => 0.001, 'step' => 0.00001)));
    
    // GALAXY TYPE: SOMBRERO
    $wp_customize->add_section('axai_galaxy_sombrero', array('title' => __('Galaxy: Sombrero', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 100));
    $wp_customize->add_setting('axai_galaxy_sombrero_arms', array('default' => 2, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_arms', array('label' => __('Arms', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 10, 'step' => 1)));
    $wp_customize->add_setting('axai_galaxy_sombrero_armPoints', array('default' => 2500, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_armPoints', array('label' => __('Arm Points', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'number', 'input_attrs' => array('min' => 500, 'max' => 10000, 'step' => 250)));
    $wp_customize->add_setting('axai_galaxy_sombrero_tightness', array('default' => 5.6, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_tightness', array('label' => __('Tightness', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'number', 'input_attrs' => array('min' => 0.5, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_sombrero_hasBar', array('default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_hasBar', array('label' => __('Has Bar', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_galaxy_sombrero_diskThickness', array('default' => 0.28, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_diskThickness', array('label' => __('Disk Thickness', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'number', 'input_attrs' => array('min' => 0.1, 'max' => 1.0, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_sombrero_armWidth', array('default' => 0.04, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_armWidth', array('label' => __('Arm Width', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'number', 'input_attrs' => array('min' => 0.01, 'max' => 0.3, 'step' => 0.01)));
    $wp_customize->add_setting('axai_galaxy_sombrero_armDensity', array('default' => 3.5, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_armDensity', array('label' => __('Arm Density', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'number', 'input_attrs' => array('min' => 1.0, 'max' => 15.0, 'step' => 0.1)));
    $wp_customize->add_setting('axai_galaxy_sombrero_core_color', array('default' => '#8033cc', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_sombrero_core_color', array('label' => __('Core Color', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero')));
    $wp_customize->add_setting('axai_galaxy_sombrero_inner_color', array('default' => '#e6a673', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_sombrero_inner_color', array('label' => __('Inner Color', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero')));
    $wp_customize->add_setting('axai_galaxy_sombrero_outer_color', array('default' => '#99664d', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_sombrero_outer_color', array('label' => __('Outer Color', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero')));
    $wp_customize->add_setting('axai_galaxy_sombrero_dust_color', array('default' => '#593326', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_galaxy_sombrero_dust_color', array('label' => __('Dust Color', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero')));
    $wp_customize->add_setting('axai_galaxy_sombrero_speed', array('default' => 0.016, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_speed', array('label' => __('Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'number', 'input_attrs' => array('min' => 0.001, 'max' => 0.1, 'step' => 0.001)));
    $wp_customize->add_setting('axai_galaxy_sombrero_rotationSpeed', array('default' => 0.00009, 'sanitize_callback' => 'axai_sanitize_small_float', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_galaxy_sombrero_rotationSpeed', array('label' => __('Rotation Speed', 'axai-galaxy'), 'section' => 'axai_galaxy_sombrero', 'type' => 'number', 'input_attrs' => array('min' => 0.00001, 'max' => 0.001, 'step' => 0.00001)));
    
    // CAMERA & PARALLAX
    $wp_customize->add_section('axai_camera_section', array('title' => __('Camera & Parallax', 'axai-galaxy'), 'panel' => 'axai_galaxy_panel', 'priority' => 110));
    $wp_customize->add_setting('axai_camera_fov', array('default' => 85, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_camera_fov', array('label' => __('Camera FOV', 'axai-galaxy'), 'section' => 'axai_camera_section', 'type' => 'number', 'input_attrs' => array('min' => 30, 'max' => 120, 'step' => 5)));
    $wp_customize->add_setting('axai_parallax_intensity', array('default' => 10, 'sanitize_callback' => 'floatval', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_parallax_intensity', array('label' => __('Parallax Intensity', 'axai-galaxy'), 'section' => 'axai_camera_section', 'type' => 'number', 'input_attrs' => array('min' => 0, 'max' => 50, 'step' => 1)));
    
    // LAYOUT
    $wp_customize->add_panel('axai_layout_panel', array('title' => __('Layout Settings', 'axai-galaxy'), 'priority' => 40));
    $wp_customize->add_section('axai_header_layout', array('title' => __('Header Layout', 'axai-galaxy'), 'panel' => 'axai_layout_panel', 'priority' => 10));
    $wp_customize->add_setting('axai_header_container_width', array('default' => 'boxed', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('axai_header_container_width', array('label' => __('Header Container Width', 'axai-galaxy'), 'section' => 'axai_header_layout', 'type' => 'select', 'choices' => array('boxed' => __('Boxed', 'axai-galaxy'), 'full-width' => __('Full Width', 'axai-galaxy'))));
    $wp_customize->add_setting('axai_header_boxed_width', array('default' => 1200, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_header_boxed_width', array('label' => __('Boxed Width (px)', 'axai-galaxy'), 'section' => 'axai_header_layout', 'type' => 'number', 'input_attrs' => array('min' => 800, 'max' => 1920, 'step' => 10)));
    $wp_customize->add_setting('axai_header_sticky', array('default' => true, 'sanitize_callback' => 'rest_sanitize_boolean'));
    $wp_customize->add_control('axai_header_sticky', array('label' => __('Sticky Header', 'axai-galaxy'), 'section' => 'axai_header_layout', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_header_transparency', array('default' => 80, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_header_transparency', array('label' => __('Header Transparency (%)', 'axai-galaxy'), 'section' => 'axai_header_layout', 'type' => 'range', 'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 5)));
    $wp_customize->add_setting('axai_logo_position', array('default' => 'left', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('axai_logo_position', array('label' => __('Logo Position', 'axai-galaxy'), 'section' => 'axai_header_layout', 'type' => 'select', 'choices' => array('left' => __('Left', 'axai-galaxy'), 'center' => __('Center', 'axai-galaxy'), 'right' => __('Right', 'axai-galaxy'))));
    $wp_customize->add_setting('axai_menu_alignment', array('default' => 'right', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('axai_menu_alignment', array('label' => __('Menu Alignment', 'axai-galaxy'), 'section' => 'axai_header_layout', 'type' => 'select', 'choices' => array('left' => __('Left', 'axai-galaxy'), 'center' => __('Center', 'axai-galaxy'), 'right' => __('Right', 'axai-galaxy'))));
    $wp_customize->add_setting('axai_logo_spacing', array('default' => 40, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_logo_spacing', array('label' => __('Logo Spacing (px)', 'axai-galaxy'), 'section' => 'axai_header_layout', 'type' => 'number', 'input_attrs' => array('min' => 0, 'max' => 200, 'step' => 5)));
    $wp_customize->add_setting('axai_menu_text_color', array('default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_menu_text_color', array('label' => __('Menu Text Color', 'axai-galaxy'), 'section' => 'axai_header_layout')));
    $wp_customize->add_setting('axai_menu_text_size', array('default' => 16, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_menu_text_size', array('label' => __('Menu Text Size (px)', 'axai-galaxy'), 'section' => 'axai_header_layout', 'type' => 'number', 'input_attrs' => array('min' => 12, 'max' => 24, 'step' => 1)));
    
    // CONTENT
    $wp_customize->add_section('axai_content_layout', array('title' => __('Content Layout', 'axai-galaxy'), 'panel' => 'axai_layout_panel', 'priority' => 20));
    $wp_customize->add_setting('axai_content_width_type', array('default' => 'boxed', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('axai_content_width_type', array('label' => __('Content Width Type', 'axai-galaxy'), 'section' => 'axai_content_layout', 'type' => 'select', 'choices' => array('boxed' => __('Boxed', 'axai-galaxy'), 'full-width' => __('Full Width', 'axai-galaxy'))));
    $wp_customize->add_setting('axai_content_boxed_width', array('default' => 1200, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_content_boxed_width', array('label' => __('Boxed Width (px)', 'axai-galaxy'), 'section' => 'axai_content_layout', 'type' => 'number', 'input_attrs' => array('min' => 800, 'max' => 1920, 'step' => 10)));
    $wp_customize->add_setting('axai_content_transparency', array('default' => 60, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_content_transparency', array('label' => __('Content Transparency (%)', 'axai-galaxy'), 'section' => 'axai_content_layout', 'type' => 'range', 'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 5)));
    $wp_customize->add_setting('axai_content_bg_color', array('default' => '#0a0e1a', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_content_bg_color', array('label' => __('Content Background Color', 'axai-galaxy'), 'section' => 'axai_content_layout')));
    $wp_customize->add_setting('axai_link_color', array('default' => '#667eea', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_link_color', array('label' => __('Link Color', 'axai-galaxy'), 'section' => 'axai_content_layout')));
    $wp_customize->add_setting('axai_link_hover_color', array('default' => '#764ba2', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'axai_link_hover_color', array('label' => __('Link Hover Color', 'axai-galaxy'), 'section' => 'axai_content_layout')));
    
    // FOOTER
    $wp_customize->add_section('axai_footer_layout', array('title' => __('Footer Layout', 'axai-galaxy'), 'panel' => 'axai_layout_panel', 'priority' => 30));
    $wp_customize->add_setting('axai_footer_container_width', array('default' => 'boxed', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('axai_footer_container_width', array('label' => __('Footer Container Width', 'axai-galaxy'), 'section' => 'axai_footer_layout', 'type' => 'select', 'choices' => array('boxed' => __('Boxed', 'axai-galaxy'), 'full-width' => __('Full Width', 'axai-galaxy'))));
    $wp_customize->add_setting('axai_footer_boxed_width', array('default' => 1200, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_footer_boxed_width', array('label' => __('Boxed Width (px)', 'axai-galaxy'), 'section' => 'axai_footer_layout', 'type' => 'number', 'input_attrs' => array('min' => 800, 'max' => 1920, 'step' => 10)));
    $wp_customize->add_setting('axai_footer_transparency', array('default' => 95, 'sanitize_callback' => 'absint', 'transport' => 'postMessage'));
    $wp_customize->add_control('axai_footer_transparency', array('label' => __('Footer Transparency (%)', 'axai-galaxy'), 'section' => 'axai_footer_layout', 'type' => 'range', 'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 5)));
    $wp_customize->add_setting('axai_copyright_text', array('default' => sprintf(esc_html__('© %1$s %2$s. All rights reserved.', 'axai-galaxy'), date('Y'), get_bloginfo('name')), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('axai_copyright_text', array('label' => __('Copyright Text', 'axai-galaxy'), 'section' => 'axai_footer_layout', 'type' => 'textarea'));
    $wp_customize->add_setting('axai_show_theme_credit', array('default' => true, 'sanitize_callback' => 'rest_sanitize_boolean'));
    $wp_customize->add_control('axai_show_theme_credit', array('label' => __('Show Theme Credit', 'axai-galaxy'), 'section' => 'axai_footer_layout', 'type' => 'checkbox'));
    
    // BLOG
    $wp_customize->add_section('axai_blog_settings', array('title' => __('Blog Settings', 'axai-galaxy'), 'panel' => 'axai_layout_panel', 'priority' => 40));
    $wp_customize->add_setting('axai_blog_columns', array('default' => 3, 'sanitize_callback' => 'absint'));
    $wp_customize->add_control('axai_blog_columns', array('label' => __('Blog Grid Columns', 'axai-galaxy'), 'section' => 'axai_blog_settings', 'type' => 'select', 'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4')));
    
    // HERO
    $wp_customize->add_section('axai_hero_section', array('title' => __('Hero Section', 'axai-galaxy'), 'panel' => 'axai_layout_panel', 'priority' => 5));
    $wp_customize->add_setting('axai_show_hero_section', array('default' => true, 'sanitize_callback' => 'rest_sanitize_boolean'));
    $wp_customize->add_control('axai_show_hero_section', array('label' => __('Show Hero Section', 'axai-galaxy'), 'section' => 'axai_hero_section', 'type' => 'checkbox'));
    $wp_customize->add_setting('axai_hero_title', array('default' => get_bloginfo('name'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('axai_hero_title', array('label' => __('Hero Title', 'axai-galaxy'), 'section' => 'axai_hero_section', 'type' => 'text'));
    $wp_customize->add_setting('axai_hero_subtitle', array('default' => get_bloginfo('description'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('axai_hero_subtitle', array('label' => __('Hero Subtitle', 'axai-galaxy'), 'section' => 'axai_hero_section', 'type' => 'textarea'));
    $wp_customize->add_setting('axai_hero_text', array('default' => '', 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('axai_hero_text', array('label' => __('Hero Text', 'axai-galaxy'), 'section' => 'axai_hero_section', 'type' => 'textarea'));
    $wp_customize->add_setting('axai_hero_button_text', array('default' => __('Learn More', 'axai-galaxy'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('axai_hero_button_text', array('label' => __('Button Text', 'axai-galaxy'), 'section' => 'axai_hero_section', 'type' => 'text'));
    $wp_customize->add_setting('axai_hero_button_url', array('default' => '#content', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('axai_hero_button_url', array('label' => __('Button URL', 'axai-galaxy'), 'section' => 'axai_hero_section', 'type' => 'url'));
    
    // ADVANCED
    $wp_customize->add_section('axai_advanced_section', array('title' => __('Advanced Settings', 'axai-galaxy'), 'priority' => 200));
    $wp_customize->add_setting('axai_threejs_url', array('default' => 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('axai_threejs_url', array('label' => __('Three.js URL', 'axai-galaxy'), 'section' => 'axai_advanced_section', 'type' => 'url', 'description' => __('URL to Three.js library', 'axai-galaxy')));
    
    if ($wp_customize->is_preview() && !isset($_GET['changeset_uuid'])) {
        wp_enqueue_script('axai-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array('jquery', 'customize-controls'), AXAI_VERSION, true);
        wp_localize_script('axai-customizer-controls', 'axaiCustomizer', array('ajaxUrl' => admin_url('admin-ajax.php'), 'resetNonce' => wp_create_nonce('axai_reset_settings')));
    }
}
add_action('customize_register', 'axai_customize_register');

function axai_customize_partial_refresh($wp_customize) {
    if (!isset($wp_customize->selective_refresh)) return;
    $wp_customize->selective_refresh->add_partial('axai_hero_title', array('selector' => '.hero-title', 'render_callback' => function() { return get_theme_mod('axai_hero_title', get_bloginfo('name')); }));
}
add_action('customize_register', 'axai_customize_partial_refresh');

function axai_reset_settings_ajax() {
    check_ajax_referer('axai_reset_settings', 'nonce');
    if (!current_user_can('customize')) wp_send_json_error('Permission denied');
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'theme_mods_axai-galaxy%'");
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'axai_%'");
    wp_cache_flush();
    wp_send_json_success();
}
add_action('wp_ajax_axai_reset_settings', 'axai_reset_settings_ajax');
