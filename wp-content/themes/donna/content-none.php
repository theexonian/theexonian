<?php 
/**
 * @package Donna
 *
 */ 
 get_header(); 
 $donna_theme_options = donna_get_options( 'donna_theme_options' );
 $sidebar_layout = $donna_theme_options['sidebar_layout'];?>
 <div class="main-content <?php echo 'sidebar-'. esc_attr($sidebar_layout); ?>">
	<div class="notfound-container container posts-container">
		<div class="row">
			<?php if ($sidebar_layout =='two-sides') { ?>
				<div class="sidebar-area secondary col-md-4">
					<div class="sidebar-inner">
						<?php get_sidebar('secondary'); ?>
					</div><!--sidebar-inner-->
				</div><!--sidebar-area-->	
			<?php } ?>
			<div class="content-area posts-area col-md-8">
				<div class="entry-content post-entry">
					<div class="single-content">
						<h1 class="error-title"><?php esc_html_e('Nothing Found!', 'donna'); ?></h1>
						<p class="error-desc"><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'donna' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</div><!--entry-content-->
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
	</div><!--notfound-container-->
</div><!--main-->
 <?php get_footer();?>