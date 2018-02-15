<?php 
/**
 * @package Donna
 *
 */ 
$donna_theme_options = donna_get_options( 'donna_theme_options' );
$sidebar_layout = $donna_theme_options['sidebar_layout'];

if ( have_posts() ) : ?>
 	<div class="clear"></div>
 	<div class="posts-container container mansonry-layout">
		<div class="row">
			<?php if ($sidebar_layout =='two-sides') { ?>
				<div class="sidebar-area secondary col-md-4">
					<div class="sidebar-inner">
						<?php get_sidebar('secondary'); ?>
					</div><!--sidebar-inner-->
				</div><!--sidebar-area-->	
			<?php } ?>
			<div class="content-area col-md-8">
				<div class="row" data-masonry='{ "itemSelector": ".masonry-item" }'>
					<?php while ( have_posts() ) : the_post();?>
						<article id="post-<?php the_ID(); ?>" class="masonry-item col-md-4">
							<div class="post-media">
								<div class="post-thumbnail">
									<?php if ( has_post_thumbnail() ) { ?>
										<?php the_post_thumbnail( array(400, 250) ); ?>
									<?php } ?>
								</div><!--post-thumbnail-->
							</div><!--post-media-->
							<div class="post-entry">
								<?php get_template_part( 'entry', 'cats' ); ?>
								<a class="post-title" href="<?php the_permalink(); ?>"><h2 <?php post_class('entry-title'); ?>><?php the_title(); ?></h2></a>
								<?php get_template_part( 'entry', 'meta' ); ?>
								<div class="entry-content clearfix">
									<?php the_excerpt(); ?>
								</div><!--entry-content-->
							</div><!--post-entry-->
						</article>
					<?php endwhile; ?>
				</div><!--row-->
			<?php the_posts_pagination(); ?>
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
 	</div><!--container-->
<?php else: ?>
	<?php get_template_part( 'content', 'none' );
endif;