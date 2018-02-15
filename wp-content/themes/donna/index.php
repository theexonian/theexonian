<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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