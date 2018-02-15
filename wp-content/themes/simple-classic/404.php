<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */
get_header(); ?>
	<div id="smplclssc_content">
		<h1 class="smplclssc_titleinmain"><?php _e( '404: Page not found', 'simple-classic' ); ?></h1>
		<p><?php _e( 'Sorry, unfortunately, we could not find the requested page.', 'simple-classic' ); ?></p>
	</div><!-- #smplclssc_content -->
<?php get_sidebar();
get_footer();
