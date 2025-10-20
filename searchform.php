<?php
/**
 * The template for displaying search forms
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_x('Search for:', 'label', 'axai-galaxy'); ?></span>
        <input type="search" 
               class="search-field" 
               placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'axai-galaxy'); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               required />
    </label>
    <button type="submit" class="search-submit">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.35-4.35"/>
        </svg>
        <span class="screen-reader-text"><?php echo esc_html_x('Search', 'submit button', 'axai-galaxy'); ?></span>
    </button>
</form>