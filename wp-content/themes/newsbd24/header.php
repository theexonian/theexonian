<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package newsbd24
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
<?php
	/**
	* Hook - newsbd24_header_container.
	*
	* @hooked newsbd24_header_part_1st - 10
	* @hooked newsbd24_header_part_2nd - 11
	* @hooked newsbd24_header_part_3rd - 12
	*/
	do_action( 'newsbd24_header_container' );

	


	/**
	* Hook - newsbd24_before_page_content.
	*
	* @hooked newsbd24_reader_title_block - 10
	* @hooked newsbd24_before_page_content - 15
	*/
	do_action( 'newsbd24_before_page_content' );
?>






