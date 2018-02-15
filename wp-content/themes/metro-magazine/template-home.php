
<?php
/**
 * Template Name: Home Page
 *
 * @package Metro_Magazine
 */

get_header(); 

/**
 * @hooked metro_magazine_top_news_section - 10 
 * @hooked metro_magazine_three_col_cat_content - 20
 * @hooked metro_magazine_three_row_cat_content - 30
 * @hooked metro_magazine_three_video_cat_content - 40
 * @hooked metro_magazine_big_img_single_cat_content - 50
 * @hooked metro_magazine_more_news_content          - 60  
   */
    do_action( 'metro_magazine_home_page' );
get_footer();
