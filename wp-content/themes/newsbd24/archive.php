<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newsbd24
 */

get_header(); ?>
	
<?php
/**
* Hook - newsbd24_blog_content_wrapper_before.
*
* @hooked newsbd24_left_sidebar - 11
* @hooked newsbd24_blog_content_wrapper_before - 12
*/
do_action( 'newsbd24_blog_content_wrapper_before' );
?>

   
        
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;
			/**
			* Hook - newsbd24_blog_content_wrapper_before.
			*
			* @hooked newsbd24_blog_content_wrapper_before - 10
			*/
			do_action( 'newsbd24_posts_loop_before' );
			$i = 0;
			/* Start the Loop */
			while ( have_posts() ) : the_post(); $i++;

				/**
				* Hook - newsbd24_posts_loop_template_part.
				*
				* @hooked newsbd24_posts_loop_template_part - 10
				*/
				do_action( 'newsbd24_posts_loop_template_part', $i );
				
			endwhile;
			/**
			* Hook - newsbd24_posts_loop_after.
			*
			* @hooked newsbd24_posts_loop_after - 10
			* @hooked newsbd24_posts_loop_navigation - 11
			*/
			do_action( 'newsbd24_posts_loop_after' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
	
<?php
/**
* Hook - newsbd24_blog_content_wrapper_after.
*
* @hooked newsbd24_blog_content_wrapper_after - 10
* @hooked newsbd24_sidebar - 11
*/
do_action( 'newsbd24_blog_content_wrapper_after' );
?>

<?php

get_footer();

