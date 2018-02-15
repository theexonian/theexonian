<?php 
/**
 * @package Donna
 */
?>
<div class="entry-cats">
<?php $categories = get_the_category();
	$separator = ' , ';
	$output = '';
	if ( ! empty( $categories ) ) {
		foreach( $categories as $category ) {
			$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'donna' ), $category->name ) ) . '">' . 	esc_html( $category->name ) . '</a>' . $separator;
		}
		echo trim( $output, $separator );
	} ?>
</div><!--entry-cats-->