<?php
/**
 * Default theme options.
 *
 * @package newsbd24
 */

if ( ! function_exists( 'newsbd24_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function newsbd24_get_default_theme_options() {

		$defaults = array();
		
		
		// Slider Section.
		$defaults['show_slider_section']				= 1;
		$defaults['number_of_home_slider']				= 3;
		$defaults['number_of_content_home_slider']		= 30;
		$defaults['select_slider_from']					= 'from-category';
		$defaults['select-page-for-slider']				= 0;
		$defaults['select_category_for_slider']			= 1;
		$defaults['button_text_on_slider']				= esc_html__( 'Browse More', 'newsbd24' );
		
		/*Global Layout*/
		$defaults['social_profile']     			= 1;
		$defaults['social_profile_link']     		= '#';
		
		/*Posts Layout*/
		$defaults['blog_layout']     				= 'right-sidebar';
		$defaults['excerpt_length_blog']     		= 60;
		$defaults['blog_loop_content_type']     	= 'excerpt-only';
		$defaults['blog_share_button']     			= 1;
		$defaults['single_posts_share']     		= 1;
		$defaults['pagination_type']				= 'default';
		/*Posts Layout*/
		$defaults['page_layout']     				= 'right-sidebar';
		
		/*layout*/
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'newsbd24' );
		
		$defaults['show_news_ticker_section_settings']       = 1;
		$defaults['news_ticker_number']       				 = 5;
		$defaults['select_category_for_news_ticker'] 		 = 0;
		$defaults['news_ticker_title'] 						 = esc_html__( 'Breaking News', 'newsbd24' );
	

		// Pass through filter.
		$defaults = apply_filters( 'newsbd24_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
