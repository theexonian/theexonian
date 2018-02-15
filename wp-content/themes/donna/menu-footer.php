<?php
/**
 * Donna functions and definitions
 *
 * @package Donna
 *
 *
 */
if ( has_nav_menu( 'footer' ) ) {

	wp_nav_menu(
		array(
			'theme_location'  => 'footer',
			'container'       => 'div',
			'container_id'    => 'menu-footer',
			'container_class' => 'menu',
			'menu_id'         => 'menu-footer-items',
			'menu_class'      => 'menu-items',
			'depth'           => 1,
			'link_before'     => '<span class="menu-text">',
			'link_after'      => '</span>',
			'fallback_cb'     => '',
		)
	);

}