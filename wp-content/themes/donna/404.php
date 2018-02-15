<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Donna
 */
 get_header(); ?>
 <div id="main">
	<div class="notfound-container container">
		<div class="row">
			<div class="content-area col-md-12">
				<div class="entry-content error-404">
					<h1 class="error-title"><?php esc_html_e('404', 'donna'); ?></h1>
					<h3><?php esc_html_e('Page not found.','donna'); ?></h3>
					<p class="error-desc"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'donna' ); ?></p>
					<?php get_search_form(); ?>
				</div><!--entry-content-->
			</div><!--content-area-->
		</div><!--row-->
	</div><!--notfound-container-->
</div><!--main-->
 <?php get_footer();?>