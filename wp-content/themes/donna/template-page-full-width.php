<?php
/**
 * Template Name: Full Width
 *
 * Template to display the full width page.
 *
 * @package Donna
 */
get_header(); 
$donna_theme_options = donna_get_options( 'donna_theme_options' );
$sidebar_layout = $donna_theme_options['sidebar_layout']; 
$page_sidebar_layout = $donna_theme_options['page_sidebar_layout']; 
if ( $page_sidebar_layout !='global' ) {$sidebar_layout = $donna_theme_options['page_sidebar_layout']; } ?>
	<div id="main" class="sidebar-none">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="posts-container container">
				<div class="row">
					<div class="content-area right-sidebar col-md-8">	
						<div class="single-content">
							<article <?php post_class('single'); ?>>
								<h1 <?php post_class('entry-title'); ?>><?php the_title(); ?> </h1>
								<?php if ( $donna_theme_options['featured_img_post'] == true ) { ?>
									<div class="post-media single-media-thumb">
										<?php 
										if ( has_post_thumbnail() ) { 
											the_post_thumbnail( 'full' ); 
										} ?>
									</div><!--post-media-->
								<?php } ?>
								<div class="single-padding">
									<div class="entry-content">
										<?php the_content(); ?>
									</div><!--entry-content-->
								</div><!--single-padding-->
							<div class="clear"></div>
							</article>
							<div class="single-padding">
								<?php get_template_part( 'entry', 'link-pages' ); ?>
								<?php 
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template( '', true );
								} ?>
							</div><!--single-padding-->
						</div><!--single-content-->
					</div><!--content-area-->
				</div><!--row-->
			</div><!--posts-container-->
		<?php endwhile; ?>
 	</div><!--main-->
 <?php get_footer();?>