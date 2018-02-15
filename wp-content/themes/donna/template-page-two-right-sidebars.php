<?php
/**
 * Template Name: Two Right Sidebars
 *
 * Template to display the page with two right sidebars.
 *
 * @package Donna
 */
get_header(); 
$donna_theme_options = donna_get_options( 'donna_theme_options' );
$sidebar_layout = 'two-right'; 
$page_sidebar_layout = $donna_theme_options['page_sidebar_layout']; ?>
	<div id="main" class="sidebar-<?php echo esc_attr($sidebar_layout); ?>">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="posts-container container">
				<div class="row">
					<?php if ($sidebar_layout =='two-sides') { ?>
						<div class="sidebar-area secondary col-md-4">
							<div class="sidebar-inner">
								<?php get_sidebar('secondary'); ?>
							</div><!--sidebar-inner-->
						</div><!--sidebar-area-->	
					<?php } ?>
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
					<?php if ($sidebar_layout =='right' xor $sidebar_layout =='left' xor $sidebar_layout =='two-sides') { ?>
						<div class="sidebar-area primary col-md-4">
							<div class="sidebar-inner">
								<?php get_sidebar(); ?>
							</div><!--sidebar-inner-->
						</div><!--sidebar-area-->			
					<?php } else { ?>
						<?php if ($sidebar_layout =='two-right' xor $sidebar_layout =='two-left') { ?>
							<div class="sidebar-area primary col-md-4">
								<div class="sidebar-inner">
									<?php get_sidebar(); ?>
								</div><!--sidebar-inner-->
							</div><!--sidebar-area-->
							<div class="sidebar-area secondary col-md-4">
								<div class="sidebar-inner">
									<?php get_sidebar('secondary'); ?>
								</div><!--sidebar-inner-->
							</div><!--sidebar-area-->
						<?php } ?>
					<?php }?>
				</div><!--row-->
			</div><!--posts-container-->
		<?php endwhile; ?>
 	</div><!--main-->
 <?php get_footer();?>