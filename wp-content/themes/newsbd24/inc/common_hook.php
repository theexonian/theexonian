<?php
/**
 * All Hook For template-parts Folder.
 *
 * @package newsbd24
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 
if ( ! function_exists( 'newsbd24_page_post_title_wrapper_before' ) ) :
	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_page_post_title_wrapper_before() {
	?>
    <div class="page-title withoutdesc">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-12 text-center">
    <?php
	}
endif; 
add_action( 'newsbd24_page_post_title_block', 'newsbd24_page_post_title_wrapper_before', 10 );


if ( ! function_exists( 'newsbd24_page_post_title_h1_text' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_page_post_title_h1_text() {
		
		if ( is_home() ) {
			if( get_option( 'page_for_posts' ) ){
				echo '<h1 class="title">';
				echo get_the_title( get_option( 'page_for_posts' ) );
				echo '</h1>';
			}
		}else if ( function_exists('is_shop') && apply_filters( 'woocommerce_show_page_title', true ) && is_shop() ){
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				echo '<h1 class="title">';
				echo woocommerce_page_title();
				echo '</h1>';
			}
		} elseif ( is_singular() ) {
			echo '<h1 class="title">';
			echo single_post_title( '', false );
			echo '</h1>';
		} elseif ( is_archive() ) {
			the_archive_title( '<h1 class="title">', '</h1>' );
		} elseif ( is_search() ) {
			echo '<h1 class="title">';
			printf( esc_html__( 'Search Results for: %s', 'newsbd24' ),  get_search_query() );
			echo '</h1>';
		} elseif ( is_404() ) {
			echo '<h1 class="title">';
			esc_html_e( 'Page Not Found', 'newsbd24' );
			echo '</h1>';
		}else{
			echo '<h1 class="title">';
			echo single_post_title(  );
			echo '</h1>';
		}

		

	}

endif;
add_action( 'newsbd24_page_post_title_block', 'newsbd24_page_post_title_h1_text', 11 );



if ( ! function_exists( 'newsbd24_page_post_sub_title_render' ) ) :

	/**
	 * Add Sub Title title in custom header.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_page_post_sub_title_text() {
		
		echo '<div class="subtitle">';

		if ( is_archive() ) {
			?>
              <?php the_archive_description( '<div class="subtitle">', '</div>' );?>
            <?php
		}else{
			?>
             <?php if ( function_exists( 'the_subtitle' ) ) { ?>
                 <div class="subtitle"><?php  the_subtitle() ;?></div>  
              <?php }?>
             
            <?php
			
		}

		echo '</div>';

	}

endif;
add_action( 'newsbd24_page_post_title_block', 'newsbd24_page_post_sub_title_text',12 );


if ( ! function_exists( 'newsbd24_page_post_title_wrapper_after' ) ) :
	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_page_post_title_wrapper_after() {
	?>
            </div>
        </div>
    </div>
    </div>
    <?php
	}
endif; 
add_action( 'newsbd24_page_post_title_block', 'newsbd24_page_post_title_wrapper_after', 20 );


if ( ! function_exists( 'newsbd24_reader_title_block' ) ) :
	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_reader_title_block() {
		if ( is_home() || is_front_page() ) :
			return true;	
		endif;
		/**
		* Hook - newsreader_page_post_title_block.
		*
		* @hooked newsreader_page_post_title_wrapper_before - 10
		* @hooked newsreader_page_post_title_render - 11
		* @hooked newsreader_page_post_sub_title_render - 12
		* @hooked newsreader_page_post_title_wrapper_after - 20
		*/
		do_action( 'newsbd24_page_post_title_block' );
	}
endif; 
add_action( 'newsbd24_before_page_content', 'newsbd24_reader_title_block', 10 );