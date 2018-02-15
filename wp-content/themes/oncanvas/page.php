<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Oncanvas
 */

get_header(); ?>

	<div id="site-main">

		<div class="wrapper wrapper-main clearfix">
		
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="thumbnail-post-intro">
				<?php the_post_thumbnail('large'); ?>
			</div><!-- .thumbnail-post-intro -->
			<?php endif; ?>

			<main id="site-content" class="site-main" role="main">
			
				<?php while ( have_posts() ) : the_post(); ?>
				
				<div class="site-content-wrapper clearfix">

					<?php get_template_part( 'template-parts/content', 'page' ); ?>
					
					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) {
							comments_template();
						}
					?>
					
				</div><!-- .site-content-wrapper .clearfix -->
				
				<?php endwhile; // End of the loop. ?>
			
			</main><!-- #site-content .site-main -->
			
			<?php get_sidebar(); ?>
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

<?php get_footer(); ?>