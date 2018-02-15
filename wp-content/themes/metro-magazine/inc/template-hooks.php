<?php
/**
 * Template hooks for this theme.
 *
 * @package Metro_Magazine
 */
 
/**
 * Doctype
 * 
 * @see metro_magazine_doctype_cb
 */
add_action( 'metro_magazine_doctype', 'metro_magazine_doctype_cb' );

/**
 * Before wp_head
 * 
 * @see metro_magazine_head
  */
add_action( 'metro_magazine_before_wp_head', 'metro_magazine_head' );

/**
 * Before Header
 * 
 * @see metro_magazine_page_start - 20
*/
add_action( 'metro_magazine_before_header', 'metro_magazine_page_start', 20 );

/**
 * metro_magazine Header
 * 
 * @see metro_magazine_header_start  - 20
 * @see metro_magazine_header_top - 30
 * @see metro_magazine_header_bottom - 40
 * @see metro_magazine_header_menu - 50
 * @see metro_magazine_header_end - 60
 * 
 */
add_action( 'metro_magazine_header', 'metro_magazine_header_start', 20 );
add_action( 'metro_magazine_header', 'metro_magazine_header_top', 30 );
add_action( 'metro_magazine_header', 'metro_magazine_header_bottom', 40 );
add_action( 'metro_magazine_header', 'metro_magazine_header_menu', 50 );
add_action( 'metro_magazine_header', 'metro_magazine_header_end', 60 );

/**
 * After Header
 *  
 * @see metro_magazine_page_header_cb - 10
 * @see metro_magazine_featured_section - 20
 * 
 * 
*/
add_action( 'metro_magazine_after_header', 'metro_magazine_page_header_cb', 10 );
add_action( 'metro_magazine_after_header', 'metro_magazine_featured_section', 20 );



/**
 * BreadCrumb
 * 
 * @see metro_magazine_breadcrumbs_cb 
*/
add_action( 'metro_magazine_breadcrumbs', 'metro_magazine_breadcrumbs_cb' );

/**
 * Before Content
 * 
 * @see metro_magazine_content_start - 20
*/
add_action( 'metro_magazine_before_content', 'metro_magazine_content_start', 20 );

/**
 * Home Page Content
 * 
 * @see metro_magazine_top_news_section - 10 
 * @see metro_magazine_three_col_cat_content - 20
 * @see metro_magazine_three_row_cat_content - 30
 * @see metro_magazine_three_video_cat_content - 40
 * @see metro_magazine_big_img_single_cat_content - 50
 * @see metro_magazine_more_news_content          - 60  
*/
add_action( 'metro_magazine_home_page', 'metro_magazine_top_news_section', 10 );
add_action( 'metro_magazine_home_page', 'metro_magazine_three_col_cat_content', 20 );
add_action( 'metro_magazine_home_page', 'metro_magazine_three_row_cat_content', 30 );
add_action( 'metro_magazine_home_page', 'metro_magazine_three_video_cat_content', 40 );
add_action( 'metro_magazine_home_page', 'metro_magazine_big_img_single_cat_content', 50 );
add_action( 'metro_magazine_home_page', 'metro_magazine_more_news_content', 60 );

/**
 * Before Page entry content
 * 
 * @see metro_magazine_page_content_image
*/
add_action( 'metro_magazine_before_page_entry_content', 'metro_magazine_page_content_image' );

/**
 * Before Post entry content
 * 
 * @see metro_magazine_post_content_image - 10
 * @see metro_magazine_post_entry_header  - 20
*/
add_action( 'metro_magazine_before_post_entry_content', 'metro_magazine_post_content_image', 10 );
add_action( 'metro_magazine_before_post_entry_content', 'metro_magazine_post_entry_header', 20 );

/**
 * Before Archive entry content
 * 
 * @see metro_magazine_archive_content_image - 10
 * @see metro_magazine_archive_entry_header_before  - 20
 * @see metro_magazine_archive_entry_header  - 20
*/
add_action( 'metro_magazine_before_archive_entry_content', 'metro_magazine_archive_content_image', 10 );
add_action( 'metro_magazine_before_archive_entry_content', 'metro_magazine_archive_entry_header_before', 20 );
add_action( 'metro_magazine_before_archive_entry_content', 'metro_magazine_archive_entry_header', 20 );


/**
 * Before Search entry summary
 * 
 * @see metro_magazine_post_content_image  - 10
 * @see metro_magazine_post_entry_header - 20
*/
add_action( 'metro_magazine_before_search_entry_summary', 'metro_magazine_post_content_image', 10 );
add_action( 'metro_magazine_before_search_entry_summary', 'metro_magazine_post_entry_header', 20 );



/**
 * After post content
 * 
 * @see metro_magazine_post_author  - 10
*/
add_action( 'metro_magazine_after_post_content', 'metro_magazine_post_author', 10 );

/**
 * metro_magazine Comment
 * 
 * @see metro_magazine_get_comment_section 
*/
add_action( 'metro_magazine_comment', 'metro_magazine_get_comment_section' );

/**
 * After Content
 * 
 * @see metro_magazine_content_end - 20
*/
add_action( 'metro_magazine_after_content', 'metro_magazine_content_end', 20 );


/**
 * app Landing Page Footer
 * 
 * @see metro_magazine_footer_start  - 20
 * @see metro_magazine_footer_widgets   - 30
 * @see metro_magazine_footer_credit - 40
 * @see metro_magazine_footer_end    - 50
*/
add_action( 'metro_magazine_footer', 'metro_magazine_footer_start', 20 );
add_action( 'metro_magazine_footer', 'metro_magazine_footer_widgets', 30 );
add_action( 'metro_magazine_footer', 'metro_magazine_footer_credit', 40 );
add_action( 'metro_magazine_footer', 'metro_magazine_footer_end', 50 );

/**
 * After Footer
 * 
 * @see metro_magazine_page_end - 20
*/
add_action( 'metro_magazine_after_footer', 'metro_magazine_page_end', 20 );