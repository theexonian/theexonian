<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package newsbd24
 */

?>
<?php
	/**
	* Hook - newsbd24_after_page_content.
	*
	* @hooked newsbd24_after_page_content - 10
	*/
	do_action( 'newsbd24_after_page_content' );
?>
<?php
	/**
	* Hook - newsbd24_footer_container.
	*
	* @hooked newsbd24_footer_part_1st - 10
	* @hooked newsbd24_footer_part_2nd - 11
	* @hooked newsbd24_footer_part_3rd - 12
	*/
	do_action( 'newsbd24_footer_container' );
?>

</div><!-- #wrapper -->
<?php wp_footer(); ?>

</body>
</html>
