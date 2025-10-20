<?php
/**
 * The header for AxAI Galaxy theme - VOLLSTÄNDIG KORRIGIERT
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'axai-galaxy'); ?></a>
    
    <!-- Starfield Canvas -->
    <canvas id="starfield-canvas" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></canvas>
    
    <!-- Pause/Resume Button -->
    <button id="pauseButton" title="<?php esc_attr_e('Pause animation', 'axai-galaxy'); ?>" style="
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(147, 51, 234, 0.2);
        border: 2px solid rgba(147, 51, 234, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #fff;
        backdrop-filter: blur(10px);
    ">⏸</button>
    
    <header id="masthead" class="site-header <?php echo esc_attr('logo-' . get_theme_mod('axai_logo_position', 'left')); ?> <?php echo esc_attr('menu-' . get_theme_mod('axai_menu_alignment', 'right')); ?>">
        <div class="header-container <?php echo esc_attr(get_theme_mod('axai_header_container_width', 'boxed')); ?>">
            <div class="header-inner">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                    }
                    
                    $axai_description = get_bloginfo('description', 'display');
                    if ($axai_description || is_customize_preview()) {
                        ?>
                        <p class="site-description"><?php echo $axai_description; ?></p>
                        <?php
                    }
                    ?>
                </div>
                
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" id="menuToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'main-menu',
                        'container'      => false,
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </header>
    
    <div id="content" class="site-content">