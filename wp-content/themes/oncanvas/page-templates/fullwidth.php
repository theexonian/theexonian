<?php
/**
 * Template Name: Full Width Page
 *
 * @package Oncanvas
 */

get_header(); ?>

	<div id="site-main">

		<div class="wrapper wrapper-main wrapper-full clearfix">
		
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
			
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

<?php get_footer(); ?>