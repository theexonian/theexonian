<?php
/**
 * WP hooks for this theme.
 *
 * @package Metro_Magazine
 */

/**
 * @see metro_magazine_setup
*/
add_action( 'after_setup_theme', 'metro_magazine_setup' );

/**
 * @see metro_magazine_content_width
*/
add_action( 'after_setup_theme', 'metro_magazine_content_width', 0 );

/**
 * @see metro_magazine_template_redirect_content_width
*/
add_action( 'template_redirect', 'metro_magazine_template_redirect_content_width' );

/**
 * @see metro_magazine_scripts 
*/
add_action( 'wp_enqueue_scripts', 'metro_magazine_scripts' );

/**
 * @see metro_magazine_body_classes
*/
add_filter( 'body_class', 'metro_magazine_body_classes' );

/**
 * @see metro_magazine_category_transient_flusher
*/
add_action( 'edit_category', 'metro_magazine_category_transient_flusher' );
add_action( 'save_post',     'metro_magazine_category_transient_flusher' );

/**
 * Move comment field to the bottm
 * @see metro_magazine_move_comment_field_to_bottom
*/
add_filter( 'comment_form_fields', 'metro_magazine_move_comment_field_to_bottom' );

/**
 * @see metro_magazine_excerpt_more
 * @see metro_magazine_excerpt_length
*/
add_filter( 'excerpt_more', 'metro_magazine_excerpt_more' );
add_filter( 'excerpt_length', 'metro_magazine_excerpt_length', 999 );

/**
 * Dynamic CSS
 * @see metro_magazine_dynamic_css
*/
add_action( 'wp_head', 'metro_magazine_dynamic_css', 99 );