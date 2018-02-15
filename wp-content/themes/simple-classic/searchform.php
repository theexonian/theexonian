<?php
/**
 * The template for displaying search forms in SimpleClassic
 *
 * @subpackage Simple_Classic
 * @since      Simple Classic
 */
?>

<form id="smplclssc_search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<div>
		<input class="smplclssc_search-txt" type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Enter search keyword', 'simple-classic' ); ?>" value="<?php echo get_search_query(); ?>"  />
	</div>
	<div>
		<input class="smplclssc_search-btn" type="submit" value="<?php _e( 'search', 'simple-classic' ); ?>" />
	</div>
</form>
