<?php 
/**
 * @package Donna
 */
wp_link_pages( array(
	'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html( 'Pages:', 'donna' ) . '</span>',
	'after'       => '</div>',
	'link_before' => '<span>',
	'link_after'  => '</span>',
) );