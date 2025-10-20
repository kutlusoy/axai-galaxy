<?php
/**
 * Custom template tags for this theme
 *
 * @package AxAI_Galaxy
 * @since 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Prints HTML with meta information for the current post-date/time
 */
function axai_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        '<span class="posted-on">%s</span>',
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo $posted_on;
}

/**
 * Prints HTML with meta information for the current author
 */
function axai_posted_by() {
    $byline = sprintf(
        '<span class="byline">%s <span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span></span>',
        esc_html_x('by', 'post author', 'axai-galaxy')
    );

    echo $byline;
}

/**
 * Prints HTML with meta information for categories, tags and comments
 */
function axai_entry_footer() {
    // Hide category and tag text for pages
    if ('post' === get_post_type()) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list(esc_html__(', ', 'axai-galaxy'));
        if ($categories_list) {
            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'axai-galaxy') . '</span>', $categories_list);
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'axai-galaxy'));
        if ($tags_list) {
            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'axai-galaxy') . '</span>', $tags_list);
        }
    }

    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'axai-galaxy'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );
        echo '</span>';
    }

    edit_post_link(
        sprintf(
            wp_kses(
                __('Edit <span class="screen-reader-text">%s</span>', 'axai-galaxy'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post(get_the_title())
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

/**
 * Display navigation to next/previous set of posts
 */
function axai_posts_navigation() {
    the_posts_navigation(array(
        'prev_text'          => __('<span class="nav-subtitle">' . esc_html__('Previous', 'axai-galaxy') . '</span>', 'axai-galaxy'),
        'next_text'          => __('<span class="nav-subtitle">' . esc_html__('Next', 'axai-galaxy') . '</span>', 'axai-galaxy'),
        'screen_reader_text' => __('Posts navigation', 'axai-galaxy'),
    ));
}

/**
 * Display navigation to next/previous post
 */
function axai_post_navigation() {
    the_post_navigation(array(
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'axai-galaxy') . '</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'axai-galaxy') . '</span> <span class="nav-title">%title</span>',
    ));
}

/**
 * Display read more link for excerpts
 */
function axai_read_more_link() {
    echo '<a href="' . esc_url(get_permalink()) . '" class="read-more">' . 
         esc_html__('Read More', 'axai-galaxy') . 
         '<svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
            <path d="M5 12h14m-7-7l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none"/>
          </svg>
         </a>';
}