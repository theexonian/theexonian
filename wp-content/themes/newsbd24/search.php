<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package newsbd24
 */

get_header(); ?>
	
<?php
/**
* Hook - newsbd24_blog_content_wrapper_before.
*
* @hooked newsbd24_blog_content_wrapper_before - 10
*/
do_action( 'newsbd24_blog_content_wrapper_before' );
?>
		<?php
		if ( have_posts() ) : 
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			newsbd24_posts_loop_navigation();

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
