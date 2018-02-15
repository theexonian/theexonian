<?php
/**
 * Custom template function for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Metro_Magazine
 */


if( ! function_exists( 'metro_magazine_doctype_cb' ) ) :
/**
 * Doctype Declaration
 * 
 * @since 1.0.1
*/
function metro_magazine_doctype_cb(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;

if( ! function_exists( 'metro_magazine_head' ) ) :
/**
 * Before wp_head
 * 
 * @since 1.0.1
*/
function metro_magazine_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
}
endif;

if( ! function_exists( 'metro_magazine_page_start' ) ) :
/**
 * Page Start
 * 
 * @since 1.0.1
*/
function metro_magazine_page_start(){
    ?>
        <div id="page" class="site">
    <?php
}
endif;

if( ! function_exists( 'metro_magazine_header_start' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_start(){
    ?>
    <header id="masthead" class="site-header" role="banner">
    <?php 
}
endif;

if( ! function_exists( 'metro_magazine_header_top' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_top(){
     $metro_magazine_ed_social = get_theme_mod( 'metro_magazine_ed_social' );

     if( has_nav_menu( 'secondary' ) || $metro_magazine_ed_social ){
    ?>
   <!-- header-top -->
    
		<div class="header-t">
            <div class="container">
            <?php if( has_nav_menu( 'secondary' ) ) { ?> 
				<div id="secondary-mobile-header">
				    <a id="secondary-responsive-menu-button" href="#responsive-sidr-main">
				    	<span></span>
				    	<span></span>
				    	<span></span>
				    </a>
				</div>
                <nav class="secondary-menu">
    				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'secondary-nav' ) ); ?> 
    			</nav>
                
            
            <?php                     
                } 
                if( $metro_magazine_ed_social ){
                 /**
                  * metro_magazine_social_link_cb
                  * 
                  * 
                  */
                  do_action( 'metro_magazine_social_link' );
                }
            ?>

			</div>
        </div>
    <?php 
    }

}
endif;

if( ! function_exists( 'metro_magazine_header_bottom' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_bottom(){
    ?>
   	<!-- header-bottom -->
		<div class="header-b">
            <div class="container">
			<!-- logo of the site -->
                <div class="site-branding">
                    <?php 
                        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                                  the_custom_logo();
                              } 
                    ?>
                        <div class="text-logo">
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                          <?php
                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) { ?>
                                  <p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                          <?php } ?>
                        </div>  
                </div><!-- .site-branding -->
                <?php do_action('metro_magazine_ads'); ?>
		  </div>
    <?php 
}
endif;

if( ! function_exists( 'metro_magazine_header_menu' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_menu(){
    ?>
    
   	<div class="nav-holder">
		<div class="container">
            <div class="nav-content">
                <div class="search-content">
					<a class="btn-search" id="myBtn" href="#"><span class="fa fa-search"></span></a>
					<div id="formModal" class="modal">
					  	<div class="modal-content">
						    <span class="close"></span>
						    <?php get_search_form(); ?>
					  	</div>
					</div>
                </div>
        		<!-- main-navigation of the site -->
        		<div id="mobile-header">
        		    <a id="responsive-menu-button" href="#sidr-main"><span></span><span></span><span></span></a>
        		</div>
        		<nav id="site-navigation" class="main-navigation" /*role="navigation"*/>
        			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
	</div>
    <?php 
}
endif;

if( ! function_exists( 'metro_magazine_header_end' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function metro_magazine_header_end(){
    ?>
		</div>
	</header><!-- #masthead -->
    <?php 
}
endif;

/* Homepage Section */

if( ! function_exists( 'metro_magazine_featured_section' ) ) :
/**
 * Featured Section
 * 
 * @since 1.0.1
*/
function metro_magazine_featured_section(){

    $featured_post_one        = get_theme_mod( 'metro_magazine_featured_post_one' ); // from customizer
    $featured_post_two        = get_theme_mod( 'metro_magazine_featured_post_two' ); // from customizer
    $featured_post_three      = get_theme_mod( 'metro_magazine_featured_post_three' ); // from customizer
    $featured_post_four       = get_theme_mod( 'metro_magazine_featured_post_four' ); // from customizer
    $featured_post_five       = get_theme_mod( 'metro_magazine_featured_post_five' ); // from customizer    
    $featured_post_six        = get_theme_mod( 'metro_magazine_featured_post_six' ); // from customizer    
    $ed_featured_post_home    = get_theme_mod( 'metro_magazine_ed_featured_post_section_home' ); // from customizer
    $ed_featured_post_archive = get_theme_mod( 'metro_magazine_ed_featured_post_section_archive' ); // from customizer
    
    $featured_posts = array( $featured_post_three, $featured_post_four, $featured_post_five, $featured_post_six);
    $featured_posts = array_diff( array_unique( $featured_posts ), array('') );
    
    if( $featured_post_one && $featured_post_two && $featured_posts && ( ( ( is_front_page() || is_home() ) && $ed_featured_post_home ) || ( is_archive() && $ed_featured_post_archive ) ) ){
    ?>
    <!-- These section are for home page only -->
    <div class="all-post">
        <div class="container">
            <ul>
    		<?php 
                if( $featured_post_one ){ 
                    $featured_qry = new WP_Query( "p=$featured_post_one" );  
                    if( $featured_qry->have_posts() ){
                        while( $featured_qry->have_posts() ){
                            $featured_qry->the_post();
                            if( has_post_thumbnail() ){
                            ?>
                            <li class="large">
                                <article class="post">
                                	<?php metro_magazine_colored_category(); ?>
                    				<a href="<?php the_permalink(); ?>">
                                        <?php 
                                            the_post_thumbnail( 'metro-magazine-featured-big' ); 
                                        ?>
                                    </a>
                					<header class="entry-header">
                						<h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                					</header>
                    			</article>
                    		</li>
                            <?php                        
                            }
                        }
                    }
                    wp_reset_postdata();
                }  
                if( $featured_post_two ){ 
                    $featured_qry = new WP_Query( "p=$featured_post_two" );  
                    if( $featured_qry->have_posts() ){
                        while( $featured_qry->have_posts() ){
                            $featured_qry->the_post();
                            if( has_post_thumbnail() ){
                            ?>
                            <li class="medium">
                                <article class="post">
                                	<?php metro_magazine_colored_category(); ?>
                    				<a href="<?php the_permalink(); ?>">
                                        <?php 
                                             the_post_thumbnail( 'metro-magazine-featured-mid' ); 
                                        ?>
                                    </a>
                    				<header class="entry-header">
                						<h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                					</header>
                    			</article>
                    		</li>
                            <?php                        
                            }
                        }
                    }
                    wp_reset_postdata();
                }
                if( $featured_posts ){
                    $args = array(
                        'post_type'           => 'post',
                        'posts_per_page'      => -1,
                        'post_status'         => 'publish',
                        'post__in'            => $featured_posts,
                        'orderby'             => 'post__in',
                        'ignore_sticky_posts' => true
                    );
                    
                    $feature_qry = new WP_Query( $args );
                    if( $feature_qry->have_posts() ){
                        while( $feature_qry->have_posts() ){
                            $feature_qry->the_post();
                                if( has_post_thumbnail() ){
                                ?>
                                <li>
                					<article class="post">
                                	<?php metro_magazine_colored_category(); ?>
                						<a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'metro-magazine-featured-small' ); ?>
                                        </a>
                						<header class="entry-header">
                						<h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                					</header>
                    			</article>
                				</li>
                                <?php
                                }
                            }
                    }
                    wp_reset_postdata();
                }
            ?>
			</ul>
		</div>
	</div>
    
    <!-- These section are for home page only -->
    <?php
    }
}
endif;

if( ! function_exists( 'metro_magazine_top_news_section' ) ) :
/**
 * Top News Section
 * 
 * @since 1.0.1
*/
function metro_magazine_top_news_section(){
    $top_news_title = get_theme_mod( 'metro_magazine_top_news_label', __( 'Top News', 'metro-magazine' ) ); //from customizer
    $top_news_one   = get_theme_mod( 'metro_magazine_top_news_one' ); //from customizer
    $top_news_two   = get_theme_mod( 'metro_magazine_top_news_two' ); //from customizer
    $top_news_three = get_theme_mod( 'metro_magazine_top_news_three' ); //from customizer
    $top_news_four  = get_theme_mod( 'metro_magazine_top_news_four' ); //from customizer
    $top_news_five  = get_theme_mod( 'metro_magazine_top_news_five' ); //from customizer
    $top_news_six   = get_theme_mod( 'metro_magazine_top_news_six' ); //from customizer
    $ed_topnews_sec = get_theme_mod( 'metro_magazine_ed_top_news_section' ); //from customizer
    
    $top_news_posts = array( $top_news_one, $top_news_two, $top_news_three, $top_news_four, $top_news_five, $top_news_six );
    $top_news_posts = array_diff( array_unique( $top_news_posts ), array('') );
    
    if( $ed_topnews_sec && is_front_page() ){ 
          
    ?>
    <section class="section-two top-news">
		<div class="container">			
            <?php if( $top_news_title ){ ?>
            <header class="header">
                <h2 class="header-title"><span><?php echo esc_html( $top_news_title ); ?></span></h2>
            </header>    
			<?php } ?>
            
            <div class="row">
				<?php
                if( $top_news_posts ){
                   $args = array(
                        'post_type'           => 'post',
                        'posts_per_page'      => -1,
                        'post_status'         => 'publish',
                        'post__in'            => $top_news_posts,
                        'orderby'             => 'post__in',
                        'ignore_sticky_posts' => true
                    );
                    
                    $top_news_qry = new WP_Query( $args );
                    if( $top_news_qry->have_posts() ){
                        while( $top_news_qry->have_posts() ){
                            $top_news_qry->the_post();
                            ?>
                            <div class="col">
            					<article class="post">
            						<div class="image-holder">
            							<a href="<?php the_permalink(); ?>" class="post-thumbnail"><?php the_post_thumbnail( 'metro-magazine-three-col' ); ?></a>
            							<?php metro_magazine_colored_category(); ?>
            						</div>
                                    <header class="entry-header">
                                        <div class="entry-meta">           						
                                            <?php metro_magazine_posted_on_date(); ?>
                                        </div>
            							<h3 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
            						</header>

                                    <div class="entry-content">
                                        <?php the_excerpt(); ?>
                                    </div>
            					</article>
            				</div>
                            <?php
                        }
                    }
                    wp_reset_postdata();
                }
                ?>
               
			</div>
		</div>
	</section><!-- These section are for home page only -->
    <?php
    }
}
endif;

if( ! function_exists( 'metro_magazine_three_col_cat_content' ) ) :
/**
 * Category Section One
*/
function metro_magazine_three_col_cat_content(){
    $first_cat  = get_theme_mod( 'metro_magazine_category_one' ); //from customizer
       
    if( $first_cat ){
    $cat = get_category( $first_cat );    
    $single_qry = new WP_Query( "post_type=post&posts_per_page=3&cat=$first_cat" );
    
    ?>
    <section class="section-two">
        <div class="container">
            <header class="header">
    		    <h2 class="header-title"><span><a href="<?php echo esc_url( get_category_link( $first_cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></span></h2>
            </header>
        
            <div class="row">
            <?php 
            if( $single_qry->have_posts() ){
                while( $single_qry->have_posts() ){
                    $single_qry->the_post();
                                    
                    echo '<div class="col">';
                    ?>
                        <article class="post">
                            <div class="image-holder">
                        	   <a href="<?php the_permalink(); ?>" class="post-thumbnail"><?php the_post_thumbnail( 'metro-magazine-three-col' ); ?></a>
                        	   <?php metro_magazine_colored_category(); ?>
                            </div>
                            <header class="entry-header">
                                <div class="entry-meta">
                                    <?php metro_magazine_posted_on_date(); ?>
                                </div>
                        		<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        	</header>
                        </article>        
                    <?php
                    echo '</div>';
                }
                wp_reset_postdata();
            }
    
            ?>
            </div>
        </div>
	</section>
    <?php 
    }   
}
endif;


if( ! function_exists( 'metro_magazine_three_row_cat_content' ) ) :
/**
 * Category Section Three
*/
function metro_magazine_three_row_cat_content(){
    $second_cat = get_theme_mod( 'metro_magazine_category_two' ); //from customizer
    
    if( $second_cat ){
    $cat = get_category( $second_cat );   
    ?>
    <section class="section-three">
		<div class="container">
			<header class="header">
		         <h2 class="header-title"><span><a href="<?php echo esc_url( get_category_link( $second_cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></span></h2>
			</header>
            
            <?php
                $single_qry = new WP_Query( "post_type=post&posts_per_page=3&cat=$second_cat" );
                if( $single_qry->have_posts() ){
                    while( $single_qry->have_posts() ){
                        $single_qry->the_post();
            ?>
                        <div class="col">
                            <article class="post">
                        	   <a href="<?php the_permalink(); ?>" class="post-thumbnail"><?php the_post_thumbnail( 'metro-magazine-three-row' ); ?></a>
                            	<div class="text-holder">
                                    <header class="entry-header">
                                        <div class="entry-meta">
                                            <?php metro_magazine_posted_on_date(); ?>
                                        </div>
                                		<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                	</header>
                                    <div class="div entry-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </article>  
                        </div>      
                <?php
            }
            wp_reset_postdata();
        }
        ?>
		</div>
	</section>
    <?php
    }
}
endif;

if( ! function_exists( 'metro_magazine_three_video_cat_content' ) ) :
/**
 * Category Section Three
*/
function metro_magazine_three_video_cat_content(){
    $third_cat = get_theme_mod( 'metro_magazine_category_three' ); //from customizer
        
    if( $third_cat ){ 
    $cat = get_category( $third_cat );  
    ?>
    <section class="videos">
		<div class="container">
			<header class="header">
		         <h2 class="header-title"><span><a href="<?php echo esc_url( get_category_link( $third_cat ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></span></h2>
			</header>
            
            <?php 
                $single_qry = new WP_Query( "post_type=post&posts_per_page=3&cat=$third_cat" );
                if( $single_qry->have_posts() ){
                    
                    echo '<div class="row">';
                    while( $single_qry->have_posts() ){
                        $single_qry->the_post();

                        ?>
                        <div class="col" >
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="image-holder">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'metro-magazine-three-col' ); ?></a>
                                	<div class="text">
                                        <span><?php the_title(); ?></span>
                                    </div>
                                </div> 
                            </div>    
                        </div>
                        <?php
                    } 
                    wp_reset_postdata();
                    echo '</div>';
                }
        ?>
		</div>
	</section>
    <?php
    }
}
endif;

if( ! function_exists( 'metro_magazine_big_img_single_cat_content' ) ) :
/**
 * Category Section Four
*/
function metro_magazine_big_img_single_cat_content(){
    $fourth_cat = get_theme_mod( 'metro_magazine_category_four' ); //from customizer
    
    if( $fourth_cat ){
    $cat = get_category( $fourth_cat );  
    ?>
    <section class="section-four">
		<div class="img-holder">
			<div class="table">
				<div class="table-row">
					<div class="table-cell">
						<div class="text">
							<h2 class="main-title"><span><?php echo esc_html( $cat->name ); ?></span></h2>
							<?php echo  category_description( $fourth_cat ) ; ?> 
						</div>
					</div>
				</div>
			</div>
		</div>
        
        <?php 
            $single_qry = new WP_Query( "post_type=post&posts_per_page=3&cat=$fourth_cat" );
            if( $single_qry->have_posts() ){
                
                echo '<div class="text-holder">';
                    echo '<div class="post-holder">';
                while( $single_qry->have_posts() ){
                    $single_qry->the_post();
                    ?>
                    <div class="post">
						<header class="entry-header">
							<div class="entry-meta">
								<?php metro_magazine_posted_on_date(); ?>
							</div>
							<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</header>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
					</div> 
                    <?php
                }
                wp_reset_postdata();
                echo '</div></div>';
            }
        ?>
	</section>
    <?php
    }    
}
endif;

if( ! function_exists( 'metro_magazine_more_news_content' ) ) :
/**
 * Category Section Five
*/
function metro_magazine_more_news_content(){
    if( is_front_page() ){
        $fifth_cat = get_theme_mod( 'metro_magazine_category_five' ); //from customizer
        
        $cat = get_category( $fifth_cat );  ?>
           <section class="section-five">
    			<div class="container">
    				<header class="header">
    					<h2 class="header-title"><span><?php if( $fifth_cat ){ echo esc_html( $cat->name ); }else{ esc_html_e( 'Latest Posts', 'metro-magazine' ); } ?></span></h2>
    				</header>
    				
                    <?php 
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'cat' => $fifth_cat,            
                        );
                        $single_qry = new WP_Query( $args );
                        if( $single_qry->have_posts() ){
                        $read_more = get_theme_mod( 'metro_magazine_read_more', __( 'View Detail', 'metro-magazine' ) );    
                            echo '<div class="row">';
                                while( $single_qry->have_posts() ){
                                    $single_qry->the_post();
                                    ?>
                                    <div class="col">
                                        <div class="post">
                							<div class="entry-meta">
                								<?php metro_magazine_posted_on_date(); ?>
                							</div>
                                            <div class="image-holder">
                								<a href="<?php the_permalink(); ?>" class="post-thumbnail"><?php the_post_thumbnail( 'metro-magazine-more-news' ); ?></a>
                								<?php metro_magazine_colored_category(); ?>
                							</div>
                							<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    						<?php if( $read_more ){ ?>
                                                <div class="btn-detail"><a href="<?php the_permalink(); ?>">
                                                    <span class="fa fa-plus-circle"></span> 
                                                    <?php echo esc_html( $read_more ); ?></a>
                                                </div>
                                            <?php } ?>
                    					</div> 
                                    </div>
                                    <?php
                                }
                                wp_reset_postdata();
                            echo '</div>';
                        }
                    ?>
    				<div class="btn-holder"><a href="<?php if( $fifth_cat ){ echo esc_url( get_category_link( $fifth_cat ) ); }else{ echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); } ?>">               
                    <?php esc_html_e( 'View all','metro-magazine' ); ?></a></div>
    			</div>
    		</section>
    <?php 
    }
}
endif;


/* Homepage Section End*/

if( ! function_exists( 'metro_magazine_breadcrumbs_cb' ) ) :
/**
 * App Landing Page Breadcrumb
 * 
 * @since 1.0.1
*/

function metro_magazine_breadcrumbs_cb() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = esc_html( get_theme_mod( 'metro_magazine_breadcrumb_separator', __( '>', 'metro-magazine' ) ) ); // delimiter between crumbs
  $home = esc_html( get_theme_mod( 'metro_magazine_breadcrumb_home_text', __( 'Home', 'metro-magazine' ) ) ); // text for the 'Home' link
  $showCurrent = get_theme_mod( 'metro_magazine_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = esc_url( home_url() );
  
  if( ( get_theme_mod( 'metro_magazine_ed_breadcrumb' ) ) && !is_page_template( 'template-home.php' ) ){
  
  if ( is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . single_cat_title('', false) . $after;
 
    } elseif ( is_search() ) {
      echo $before . esc_html__( 'Search Result', 'metro-magazine' ) . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . $delimiter . ' ';
      echo '<a href="' . esc_url( get_month_link( get_the_time('Y'), get_the_time('m') ) ) . '">' . esc_html( get_the_time('F') ) . '</a> ' . $delimiter . ' ';
      echo $before . esc_html( get_the_time('d') ) . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '">' . esc_html( get_the_time('Y') ) . '</a> ' . $delimiter . ' ';
      echo $before . esc_html( get_the_time('F') ) . $after;
 
    } elseif ( is_year() ) {
      echo $before . esc_html( get_the_time('Y') ) . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
       if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            if( $post_type->has_archive == true ){
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url( $homeLink . '/' . $slug['slug'] ) . '/">' . esc_html( $post_type->labels->singular_name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span>';
            }
            if ( $showCurrent == 1 ) echo $before . esc_html( get_the_title() ) . $after;
        } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . esc_html( get_the_title() ) . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . esc_html( $post_type->labels->singular_name ) . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . esc_html( $parent->post_title ) . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . esc_html( get_the_title() ) . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_post($parent_id);
        $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html( get_the_title() ) . $after;
 
    } elseif ( is_tag() ) {
      echo $before . esc_html( single_tag_title('', false) ) . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . esc_html( $userdata->display_name ) . $after;
 
    } elseif ( is_404() ) {
        echo $before . esc_html__( '404 Error - Page not Found', 'metro-magazine' ) . $after;
    } elseif( is_home() ){
        echo $before;
        single_post_title();
        echo $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __( 'Page', 'metro-magazine' ) . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
    }
    } 
}// end metro_magazine_breadcrumbs()

endif;

if( ! function_exists( 'metro_magazine_page_header_cb' ) ) :
/**
 * Page Header for inner pages
 * 
 * @since 1.0.1
*/
function metro_magazine_page_header_cb(){  
    if ( is_page_template( 'template-home.php' ) || ( is_front_page() && ! is_home() ) ){ 
        echo '<div class="home-content">'; 
    } else { 
   
        if( is_home() && ! is_front_page() ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                    <div class="page-header">
                        <h1 class="page-title">
                            <?php single_post_title(); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php } elseif( is_archive() ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                    <div class="page-header">
                        <h1 class="page-title">
                            <?php the_archive_title(); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php }elseif( is_404() ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                    <div class="page-header">
                        <h1 class="page-title">
                            <?php esc_html_e( '404 Error - Page Not Found','metro-magazine' ); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php }elseif( is_search() ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                    <div class="page-header">
                        <h1 class="page-title">
                            <?php printf( esc_html__( 'Search Results for: %s', 'metro-magazine' ), get_search_query() ); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php }elseif( is_singular() && ( get_theme_mod( 'metro_magazine_ed_breadcrumb' ) == true ) ){ ?>
            <div class="top-bar">
                <div class="container">
                    <?php do_action( 'metro_magazine_breadcrumbs' ); ?>
                </div>
            </div>
            <?php 
            }
        }
    } 
endif;


if( ! function_exists( 'metro_magazine_content_start' ) ) :
/**
 * Content Start
 * 
 * @since 1.0.1
*/
function metro_magazine_content_start(){ 
    
    $class = is_404() ? 'error-holder' : 'row' ;
    $first_cat  = get_theme_mod( 'metro_magazine_category_one' ); //from customizer
    $second_cat = get_theme_mod( 'metro_magazine_category_two' ); //from customizer
    $third_cat  = get_theme_mod( 'metro_magazine_category_three' ); //from customizer
    $fourth_cat = get_theme_mod( 'metro_magazine_category_four' ); //from customizer
    $fifth_cat  = get_theme_mod( 'metro_magazine_category_five' ); //from customizer
    
    if( is_home() || !( $first_cat || $second_cat ||  $third_cat || $fourth_cat || $fifth_cat ) || !( is_front_page() || is_page_template( 'template-home.php' ) ) ){
    ?>
    <div id="content" class="site-content">
        <div class="container">
             <div class="<?php echo esc_attr( $class ); ?>">
    <?php
    }
}
endif;

if( ! function_exists( 'metro_magazine_page_content_image' ) ) :
/**
 * Page Featured Image
 * 
 * @since 1.0.1
*/
function metro_magazine_page_content_image(){
    $sidebar_layout = metro_magazine_sidebar_layout();
    if( has_post_thumbnail() )
    ( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) ? the_post_thumbnail( 'metro-magazine-with-sidebar' ) : the_post_thumbnail( 'metro-magazine-without-sidebar' );    
}
endif;

if( ! function_exists( 'metro_magazine_archive_content_image' ) ) :
/**
 * Archive Image
 * 
 * @since 1.0.1
*/
function metro_magazine_archive_content_image(){
    echo '<a href="' . esc_url( get_the_permalink() ) . '" class="post-thumbnail">'; 
 		the_post_thumbnail( 'metro-magazine-three-row' ); 
    echo '</a>';
}
endif;

if( ! function_exists( 'metro_magazine_post_content_image' ) ) :
/**
 * Post Featured Image
 * 
 * @since 1.0.1
*/
function metro_magazine_post_content_image(){
    if( has_post_thumbnail() ){
    echo ( !is_single() ) ? '<a href="' . get_the_permalink() . '" class="post-thumbnail">' : '<div class="post-thumbnail">'; 
         ( is_active_sidebar( 'right-sidebar' ) ) ? the_post_thumbnail( 'metro-magazine-with-sidebar' ) : the_post_thumbnail( 'metro-magazine-without-sidebar' ) ; 
    echo ( !is_single() ) ? '</a>' : '</div>' ;    
    }
}
endif;

if( ! function_exists( 'metro_magazine_post_entry_header' ) ) :
/**
 * Post Entry Header
 * 
 * @since 1.0.1
*/
function metro_magazine_post_entry_header(){
    ?>
    
   	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php metro_magazine_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header>

    <?php
}
endif;

if( ! function_exists( 'metro_magazine_archive_entry_header_before' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.1
*/
function metro_magazine_archive_entry_header_before(){
    echo '<div class = "text-holder" >';
}    
endif;   
    
if( ! function_exists( 'metro_magazine_archive_entry_header' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.1
*/
function metro_magazine_archive_entry_header(){
    ?>
   	<header class="entry-header">
		<div class="entry-meta">
			<?php metro_magazine_posted_on_date(); ?>
		</div><!-- .entry-meta -->
        <h2 class="entry-title"><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>
    </header>	
    <?php
}
endif;

if( ! function_exists( 'metro_magazine_post_author' ) ) :
/**
 * Post Author Bio
 * 
 * @since 1.0.1
*/
function metro_magazine_post_author(){
    if( get_the_author_meta( 'description' ) ){
        global $post;
    ?>
    <section class="author-section">
        <div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 126 ); ?></div>
            <div class="text-holder">
                <strong class="name"><?php echo esc_html( get_the_author_meta( 'display_name', $post->post_author ) ); ?></strong>
                <?php echo wpautop( esc_html( get_the_author_meta( 'description' ) ) ); ?>
            </div>
    </section>
    <?php  
    }  
}
endif;
add_action( 'metro_magazine_author_info_box', 'metro_magazine_post_author' );

if( ! function_exists( 'metro_magazine_get_comment_section' ) ) :
/**
 * Comment template
 * 
 * @since 1.0.1
*/
function metro_magazine_get_comment_section(){
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
}
endif;

if( ! function_exists( 'metro_magazine_content_end' ) ) :
/**
 * Content End
 * 
 * @since 1.0.1
*/
function metro_magazine_content_end(){
    $first_cat  = get_theme_mod( 'metro_magazine_category_one' ); //from customizer
    $second_cat = get_theme_mod( 'metro_magazine_category_two' ); //from customizer
    $third_cat  = get_theme_mod( 'metro_magazine_category_three' ); //from customizer
    $fourth_cat = get_theme_mod( 'metro_magazine_category_four' ); //from customizer
    $fifth_cat  = get_theme_mod( 'metro_magazine_category_five' ); //from customizer
    
    if ( is_page_template( 'template-home.php' ) || ( is_front_page() && ! is_home() ) ){ 
        echo '</div>'; 
    }
    if( is_home() || !( $first_cat || $second_cat ||  $third_cat || $fourth_cat || $fifth_cat ) || !( is_front_page() || is_page_template( 'template-home.php' ) ) ){
        echo '</div></div></div>';// .row /#content /.container
    }
}
endif;

if( ! function_exists( 'metro_magazine_footer_start' ) ) :
/**
 * Footer Start
 * 
 * @since 1.0.1
*/
function metro_magazine_footer_start(){
    echo '<footer id="colophon" class="site-footer" role="contentinfo">';

}
endif;


if( ! function_exists( 'metro_magazine_footer_widgets' ) ) :
/**
 * Footer Bottom
 * 
 * @since 1.0.1 
*/
function metro_magazine_footer_widgets(){
    echo '<div class="footer-t">';
        echo '<div class="container">';
            echo '<div class="row">';
                 echo '<div class= "col">';
                     if( is_active_sidebar( 'footer-sidebar-one') ) dynamic_sidebar( 'footer-sidebar-one' ); 
                 echo '</div>';
                 echo '<div class= "col">';
                     if( is_active_sidebar( 'footer-sidebar-two') ) dynamic_sidebar( 'footer-sidebar-two' ); 
                 echo '</div>';
                 echo '<div class= "col">';
                     if( is_active_sidebar( 'footer-sidebar-three') ) dynamic_sidebar( 'footer-sidebar-three' ); 
                 echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
endif;

if( ! function_exists( 'metro_magazine_footer_credit' ) ) :
/**
 * Footer Credits 
 */
function metro_magazine_footer_credit(){
    $copyright_text = get_theme_mod( 'metro_magazine_footer_copyright_text' );
    echo '<div class="footer-b">';
        echo '<div class="container">'; 
            echo '<div class="site-info">';
                if( $copyright_text ){
                    echo wp_kses_post( $copyright_text );
                }else{
                esc_html_e( '&copy;&nbsp;', 'metro-magazine' ); 
                echo esc_html( date_i18n( 'Y' ), 'metro-magazine' );
                esc_html_e( '&nbsp;', 'metro-magazine' );
                echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
                }
                esc_html_e( '&nbsp;', 'metro-magazine' );

                printf( esc_html__( '%s', 'metro-magazine' ), '<a href="'. esc_url( __( 'http://raratheme.com/wordpress-themes/metro-magazine/', 'metro-magazine' ) ) .'" target="_blank">'. esc_html__( 'Metro Magazine By Rara Theme. ', 'metro-magazine' ) .'</a>' );
                printf( esc_html__( 'Powered by %s', 'metro-magazine' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'metro-magazine' ) ) .'" target="_blank">'. esc_html__( 'WordPress', 'metro-magazine' ) . '</a>' );
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
endif;

if( ! function_exists( 'metro_magazine_footer_end' ) ) :
/**
 * Footer End
 * 
 * @since 1.0.1 
*/
function metro_magazine_footer_end(){
    echo '</footer>'; // #colophon 
}
endif;

if( ! function_exists( 'metro_magazine_page_end' ) ) :
/**
 * Page End
 * 
 * @since 1.0.1
*/
function metro_magazine_page_end(){
    ?>
    </div><!-- #page -->
    <?php
}
endif;