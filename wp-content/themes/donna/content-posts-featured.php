<?php 
/**
 * @package Donna
 *
 */ 
$donna_theme_options = donna_get_options( 'donna_theme_options' );
$sidebar_layout = $donna_theme_options['sidebar_layout'];
if ( have_posts() ) : ?>
	<div class="clear"></div>
	<div class="posts-container container featured">
		<div class="row">
			<?php if ($sidebar_layout =='two-sides') { ?>
				<div class="sidebar-area secondary col-md-4">
					<div class="sidebar-inner">
						<?php get_sidebar('secondary'); ?>
					</div><!--sidebar-inner-->
				</div><!--sidebar-area-->	
			<?php } ?>
			<div class="posts-area col-md-8">
				<?php while ( have_posts() ) : the_post();?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?>>
						<div class="entry-post">
							<div class="entry-media">
								<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
								<div class="post-thumbnail" style="background: url(<?php echo esc_url($image[0]); ?>) center">
								</div><!--post-thumbnail-->
							</div><!--entry-media-->
							<?php get_template_part( 'entry', 'cats' ); ?>
							<a class="post-title" href="<?php the_permalink(); ?>"><h2 <?php post_class('entry-title'); ?>><?php the_title(); ?></h2></a>
							<?php get_template_part( 'entry', 'meta' ); ?>
						</div><!--entry-post-->
					</article>
				<?php endwhile; ?>
				<div class="clear"></div>
				<?php the_posts_pagination(); ?>
			</div><!--posts-area-->
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
endif;