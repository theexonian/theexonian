<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Oncanvas
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function oncanvas_jetpack_setup() {

    /*
     * JetPack Infinite Scroll
     */
    add_theme_support( 'infinite-scroll', array(
        'container' => 'recent-posts',
        'type' => 'click',
		'wrapper' => false,
		'render' => 'oncanvas_infinite_scroll_render',
        'footer' => false,
    ) );

	add_theme_support( 'site-logo', array( 'size' => 'full' ) );

} // end function oncanvas_jetpack_setup
add_action( 'after_setup_theme', 'oncanvas_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function oncanvas_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}
} // end function oncanvas_infinite_scroll_render

function oncanvas_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load more posts', 'oncanvas' );
	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'oncanvas_jetpack_infinite_scroll_js_settings' );