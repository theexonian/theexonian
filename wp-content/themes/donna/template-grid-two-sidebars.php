<?php
/**
 * Template Name: Two Sidebars, Grid in the Middle
 *
 * Template to display the page with two sidebars and content in the middle.
 *
 * @package Donna
 */
get_header(); 
 $donna_theme_options = donna_get_options( 'donna_theme_options' );
 $sidebar_layout = 'two-sides';
 $layout_style = 'grid'; ?>
 
 <div id="main" class="sidebar-<?php echo esc_attr($sidebar_layout); ?>">
		 	
		 	<?php donna_image_slider(); 
		 	
			$enable_image_placeholder = $donna_theme_options['enable_image_placeholder'];
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$posts_query = new WP_Query(array(
				'post_type'=>'post', 
				'post_status'=>'publish',
				'paged' => $paged
			));
			// Pagination fix
			$temp_query = $wp_query;
			$wp_query   = NULL;
			$wp_query   = $posts_query;
			
			if ( $posts_query->have_posts() ) : ?>
				<div class="clear"></div>
				<div class="posts-container container grid-layout">
					<div class="row">
						<?php if ($sidebar_layout =='two-sides') { ?>
							<div class="sidebar-area secondary col-md-4">
								<div class="sidebar-inner">
									<?php get_sidebar('secondary'); ?>
								</div><!--sidebar-inner-->
							</div><!--sidebar-area-->	
						<?php } ?>
						<div class="posts-area col-md-8">
							<?php global $wp_query; echo '<div class="post-row">'; while ( $posts_query->have_posts() ): $posts_query->the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class( array('group', 'grid-item')); ?>>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-media">
											<div class="post-thumbnail">
												<?php the_post_thumbnail( 'full' ); ?>
											</div><!--post-thumbnail-->
										</div><!--post-media-->
									<?php } else { ?>
										<?php if ($enable_image_placeholder == true ) { ?>
											<div class="post-media">
												<div class="post-thumbnail">	
												</div><!--post-thumbnail-->
											</div><!--post-media-->
										<?php } ?>
									<?php } ?>
									<div class="post-entry">
										<?php get_template_part( 'entry', 'cats' ); ?>
										<a class="post-title" href="<?php the_permalink(); ?>"><h2 <?php post_class('entry-title'); ?>><?php the_title(); ?></h2></a>
										<div class="clear"></div>
										<?php get_template_part( 'entry', 'meta' ); ?>
										<div class="entry-content clearfix">
											<?php the_excerpt(); ?>
										</div><!--entry-content-->
									</div><!--post-entry-->
								</article>
							<?php if( ( $wp_query->current_post + 1 ) % 2 == 0 ) { echo '</div><div class="post-row">'; }; endwhile; wp_reset_postdata(); echo '</div>'; ?>
							<div class="clear"></div>
							<?php the_posts_pagination(); ?>
						</div><!--col-md-8-->		
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
			<?php 
			else:
				get_template_part( 'content', 'none' );
			endif; ?>
		 	
 </div><!--main-->
 <?php get_footer();?>