<?php
/**
 * Template for displaying search forms in Almia
 *
 * 
 * @package Almia
 * @since Almia 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'almia' ); ?></span>
	</label>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'almia' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', 'almia' ); ?></span></button>
</form>
