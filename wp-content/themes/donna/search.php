<?php
/**
 * The template for displaying search results pages
 *
 * @package Donna
 */
 get_header(); 
 
 $donna_theme_options = donna_get_options( 'donna_theme_options' );
 $sidebar_layout = $donna_theme_options['sidebar_layout'];
 $layout_style = $donna_theme_options['layout_style']; ?>
 
 <div id="main" class="sidebar-<?php echo esc_attr($sidebar_layout); ?>">
		 	
		 	<?php get_template_part( 'content', 'posts-'. esc_attr($layout_style) . ''); ?>
		 	
 </div><!--main-->
 <?php get_footer();?>