<?php
/**
 * Functions hooked to custom hook.
 *
 * @package newsbd24
 */
 
if( ! function_exists( 'newsbd24_blog_expert_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     * @since  Blog Expert 1.0.0
     *
     * @param null
     * @return int
     */
    function newsbd24_blog_expert_excerpt_length( $length ){
        $excerpt_length = newsbd24_get_option( 'excerpt_length_blog' );
	
        if ( absint( $excerpt_length ) > 0 && !is_admin() ) {
        	$length = absint( $excerpt_length );
        }

        return $length;

    }

add_filter( 'excerpt_length', 'newsbd24_blog_expert_excerpt_length', 999 );
endif; 


function newsbd24_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	$link = sprintf( '  <div class="clearfix"><div class="blog-bottom text-center"><a href="%1$s" class="btn btn-primary">%2$s <i class="fa fa-fw fa-angle-double-right"></i> </a>  </div></div>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'newsbd24' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'newsbd24_excerpt_more' );



if( ! function_exists( 'newsbd24_read_more_link' ) ) :
	/**
	* Adds custom Read More.
	*
	*/
	function newsbd24_read_more_link() {
		return '<div class="clearfix"><br/><br/><div class="blog-bottom text-center"><a class="btn btn-primary" href="' . esc_url( get_permalink() ) . '">'.esc_html__( 'Continue reading', 'newsbd24' ).'<i class="fa fa-long-arrow-right"></i></a></div></div>';
	}
	add_filter( 'the_content_more_link', 'newsbd24_read_more_link' );
endif;
