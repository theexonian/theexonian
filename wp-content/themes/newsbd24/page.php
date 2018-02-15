<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
* @hooked newsbd24_blog_content_wrapper_before - 11
* @hooked newsbd24_blog_content_wrapper_before - 12
*/
do_action( 'newsbd24_page_content_wrapper_before' );
?>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>


<?php
/**
* Hook - newsbd24_blog_content_wrapper_after.
*
* @hooked newsbd24_blog_content_wrapper_after - 10
* @hooked newsbd24_sidebar - 11
*/
do_action( 'newsbd24_page_content_wrapper_after' );
?>
<?php

get_footer();
