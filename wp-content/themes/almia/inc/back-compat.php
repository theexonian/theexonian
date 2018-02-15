<?php
/**
 * Almia back compat functionality
 *
 * Prevents Almia from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * 
 * @package Almia
 * @since Almia 1.0
 */

/**
 * Prevent switching to Almia on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Almia 1.0
 */
function almia_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'almia_upgrade_notice' );
}
add_action( 'after_switch_theme', 'almia_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Almia on WordPress versions prior to 4.4.
 *
 * @since Almia 1.0
 *
 * @global string $wp_version WordPress version.
 */
function almia_upgrade_notice() {
	$message = sprintf( __( 'Almia requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'almia' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Almia 1.0
 *
 * @global string $wp_version WordPress version.
 */
function almia_customize() {
	wp_die( sprintf( __( 'Almia requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'almia' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'almia_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Almia 1.0
 *
 * @global string $wp_version WordPress version.
 */
function almia_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Almia requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'almia' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'almia_preview' );
