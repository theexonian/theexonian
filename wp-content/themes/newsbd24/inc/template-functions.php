<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package newsbd24
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}   
if ( ! function_exists( 'newsbd24_walker_comment' ) ) : 
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
	  
	function newsbd24_walker_comment($comment, $args, $depth) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? 'comment shift' : 'comment' ) ?> id="comment-<?php comment_ID() ?>">
            <div class="media">
               
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 70 ); ?>
               
                <div class="media-body">
                    <h4 class="media-heading user_name"><?php echo get_comment_author_link();?>
                <small><?php
                /* translators: 1: date, 2: time */
                printf( esc_html__('%1$s at %2$s', 'newsbd24' ), get_comment_date(),  get_comment_time() ); ?></a> </small>
                <small>  <?php edit_comment_link( esc_html__( '(Edit)' , 'newsbd24' ), '  ', '' );?>  </small></h4>
                  
               <p><?php comment_text(); ?></p>
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
            </div>
	
	   </li>
		<?php
	}
	
	function newsbd24_replace_reply_link_class($class){
		$class = str_replace("class='comment-reply-link", "class='btn btn-primary btn-sm", $class);
		return $class;
	}
	add_filter('comment_reply_link', 'newsbd24_replace_reply_link_class');
endif;



if ( ! function_exists( 'newsbd24_news_ticker' ) ) : 
	/**
	 * Implement newsbd24_news_ticker.
	 *
	 * @since 1.0.0
	 *
	 
	 * @return $html
	 */
	function newsbd24_news_ticker() {
		if( newsbd24_get_option('show_news_ticker_section_settings') != 1 ){ return false; }
		
	
		
		$args = array();
		
		if( newsbd24_get_option('select_category_for_news_ticker') > 0  ){
			$args['cat'] = absint( newsbd24_get_option('select_category_for_news_ticker') );
		}
		$args['posts_per_page'] = ( newsbd24_get_option('select_category_for_news_ticker') != "" && newsbd24_get_option('select_category_for_news_ticker') > 0  ) ? absint( newsbd24_get_option('select_category_for_news_ticker') ) : 5;
		
		$the_query = new WP_Query( $args );
		
		$html = '<div class="newsbd24_news_ticker">';
		$html .= '<span class="braking_news">'. esc_html( newsbd24_get_option('news_ticker_title') ) .'</span>';
		if ( $the_query->have_posts() ) :
			
			$html .= '<ul class="news_list newsbd24_news_ticker_js_action">';
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$html .= '<li><a href="'.esc_url( get_permalink( get_the_id() ) ).'">'.get_the_title().'</a></li>';
			endwhile;
			$html .= '</ul>';
			
		else:
		$html .= '<ul class="ed_news_ticker_list newsticker"><li>';
		$html .= esc_html__('No Posts found.', 'newsbd24');	
		$html .= '</li></ul>';
		endif;
		$html .= '</div>';
			wp_reset_postdata();
			wp_reset_query();
		echo apply_filters( 'newsbd24_news_ticker', $html );
	}
endif;








	 
	 



