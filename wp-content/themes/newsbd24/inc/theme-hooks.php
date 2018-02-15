<?php
/**
 * Functions hooked to custom hook.
 *
 * @package newsbd24
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 
if( !function_exists('newsbd24_header_part_1st') ){
	/**
	* Add Header 1st part.
	*
	* @since 1.0.0
	*/
	function newsbd24_header_part_1st(){
	if( ( newsbd24_get_option('social_profile') === 1 && count (  newsbd24_get_option('newsbd24_social_profile_link') ) > 0 ) ) :	
	?>
    <header class="header">
    <div class="container">
    	<div class="row">
            <div class="col-md-7 col-sm-7">
                <?php newsbd24_news_ticker();?>
            </div>
            <?php if ( newsbd24_get_option('social_profile') === 1 && count (  newsbd24_get_option('newsbd24_social_profile_link') ) > 0 ) :?>
            <?php $social_link = newsbd24_get_option('newsbd24_social_profile_link');?>
             <div class="pull-right col-md-5 col-sm-5">
                <ul class="social">
                    <?php if( count ( $social_link['social'] ) > 0 ): foreach ($social_link['social'] as $key => $link): 
                        if( $link != ""):
                        ?>
                        <li><a href="<?php echo esc_url( $link );?>" class="fa <?php echo esc_attr($key);?>" target="_blank"></a></li>
                        <?php endif; 
                    endforeach;endif;?>
                </ul>
            </div>
            <?php endif;?>
            <div class="clearfix"></div>
        </div>
    </div><!-- end container -->
    </header>
    <?php
	endif;
	}
}
add_action( 'newsbd24_header_container', 'newsbd24_header_part_1st', 10 );
 
if( !function_exists('newsbd24_header_part_2nd') ){
	/**
	* Add Header 2nd part ( Logo & Ad ).
	*
	* @since 1.0.0
	*/
	function newsbd24_header_part_2nd(){
	?>
        <div class="header-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        
						<?php
							/**
							* Hook - sorna_action_top_bar.
							*
							* @hooked sorna_action_top_bar - 10
							*/
							do_action( 'newsbd24_site_branding' );
                        ?>
                    </div>
					<?php if ( is_active_sidebar( 'header_ad' ) ) : ?>
                   	 	<?php dynamic_sidebar( 'header_ad' ); ?>
                    <?php endif ?>
                     
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end header -->
    <?php
	}
}
add_action( 'newsbd24_header_container', 'newsbd24_header_part_2nd', 11 );


if( !function_exists('newsbd24_header_part_3rd') ){
	/**
	* Add Header 3rd part ( navigation ).
	*
	* @since 1.0.0
	*/
	function newsbd24_header_part_3rd(){
	?>
       <header class="header">
            <div class="container">
            	<div class="row">
                <nav class="navbar navbar-inverse navbar-toggleable-md col-md-11 col-sm-11">
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#matildamenu" aria-controls="matildamenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="matildamenu" role="main-menu"> 
                  
						<?php
                        wp_nav_menu( array(
                            'theme_location'    => 'primary',
                            'depth'             => 3,
                            'container'       => false, 
                            'menu_class'        => 'navbar-nav',
							'items_wrap'		=> '<ul id="%1$s" class="%2$s" role="menubar" aria-hidden="false">%3$s</ul>',
                            'fallback_cb'       => 'newsbd24_bootstrap_navwalker::fallback',
                            'walker'            => new newsbd24_bootstrap_navwalker())
                        );
                        ?>
                    
                    </div>
                    
                </nav>
                <div class="col-md-1 col-sm-1 pull-right" id="nav_icon_right">
                    <a href="#" id="popup-search" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr__( 'Search...', 'newsbd24' );?>"><i class="fa fa-search"></i></a>	
                    <?php 	if (  is_active_sidebar( 'flysidebar' ) ) { ?>
                    <a id="nav-expander" href="#" data-toggle="tooltip" data-placement="bottom" title="<?php echo esc_attr__( 'Open Right Sidebar', 'newsbd24' );?>"><i class="fa fa-bars"></i></a>			<?php }?>
                    </div><!-- end social -->
                </div><!-- end row -->
            </div><!-- end container -->
        </header>
    <?php
	}
}
add_action( 'newsbd24_header_container', 'newsbd24_header_part_3rd', 12 );

if ( ! function_exists( 'newsbd24_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 1.0.0
	 */
	function newsbd24_site_branding() {
	?>
    <div class="logo">
    <?php
    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
    
    	the_custom_logo();
    
    }else{
    ?>	
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
        <?php $description = get_bloginfo( 'description', 'display' );
        if ( $description || is_customize_preview() ) : ?>
       	 	<p class="site-description"><?php echo esc_html($description); ?></p>
        <?php endif; ?>
        <?php }?>   
    </div><!-- end logo -->
	<?php
	}

endif;

add_action( 'newsbd24_site_branding', 'newsbd24_site_branding' );

if( !function_exists('newsbd24_footer_part_1st') ){
	/**
	* Add footer 1st part ( instagram ).
	*
	* @since 1.0.0
	*/
	function newsbd24_footer_part_1st(){
		if (  is_active_sidebar( 'instagram' ) ) :
	?>
        <section class="section wb">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        
                         <?php dynamic_sidebar( 'instagram' ); ?>
                       
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->
    <?php
		endif;
	}
}
add_action( 'newsbd24_footer_container', 'newsbd24_footer_part_1st', 10 );


if( !function_exists('newsbd24_footer_part_2nd') ){
	/**
	* Add footer 2nd part ( widgets ).
	*
	* @since 1.0.0
	*/
	function newsbd24_footer_part_2nd(){
	?>
    	<?php if ( is_active_sidebar( 'footer' ) ) : ?>	
          <footer class="footer" id="footer">
            <div class="container">
                <div class="row">
                 <?php dynamic_sidebar( 'footer' ); ?>
                </div><!-- end row -->
            </div><!-- end container -->
        </footer><!-- end footer -->
         <?php endif ?>
    <?php
	}
}
add_action( 'newsbd24_footer_container', 'newsbd24_footer_part_2nd', 11 );


if( !function_exists('newsbd24_footer_part_3rd') ){
	/**
	* Add footer 3rd part ( Sidebar fly widgets ).
	*
	* @since 1.0.0
	*/
	function newsbd24_footer_part_3rd(){
	?>
    <div class="container">
        <div class="row">
        <div class="col-md-6">
           
                <?php
                 $options = newsbd24_get_option( 'copyright_text' );
                 if( $options != "" ){
                 echo esc_html( $options );
                 
                 }?>  
        
            </div>
           <div class="col-md-6" style="text-align:right">
           		
                <a href="<?php /* translators:straing */ echo esc_url(  'https://wordpress.org/' ); ?>"><?php /* translators:straing */  printf( esc_html__( 'Proudly powered by %s', 'newsbd24' ),esc_html__( 'WordPress', 'newsbd24' ) ); ?></a>
            | 
        <?php
        printf(  /* translators: %s: aThemeArt */ esc_html__( 'Theme: %1$s by %2$s.', 'newsbd24' ), 'NewsBD24', '<a href="' . esc_url('https://athemeart.com' ) . '" target="_blank">' . esc_html__( 'aThemeArt', 'newsbd24' ) . '</a>' ); ?>
               
           </div>
            
        
        </div>
     </div>   
     <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>

    <?php
	}
}
add_action( 'newsbd24_footer_container', 'newsbd24_footer_part_3rd', 12 );

if( !function_exists('newsbd24_popup_search') ){
	/**
	* Add footer 3rd part ( Sidebar fly widgets ).
	*
	* @since 1.0.0
	*/
	function newsbd24_popup_search(){
	?>
  	<div class="popup-search">
      
        <div class="v-align-middle">
            <?php get_search_form(); ?>
        </div>
        
        <div class="close-popup"><i class="fa fa-times"></i></div>
	</div>
    <?php
	}
}
add_action( 'newsbd24_footer_container', 'newsbd24_popup_search', 14 );



if( !function_exists('newsbd24_fly_sidebar') ){
	/**
	* Add footer 3rd part ( Sidebar fly widgets ).
	*
	* @since 1.0.0
	*/
	function newsbd24_fly_sidebar(){
		if (  is_active_sidebar( 'flysidebar' ) ) {
	?>
    <div class="sidewrapper sidenav">
    <div class="text-right"><a href="#" id="nav-close"><i class="fa fa-close"></i></a></div>
   		 <?php dynamic_sidebar( 'flysidebar' ); ?>
    
    </div>
    <?php
		}
	}
}
add_action( 'newsbd24_footer_container', 'newsbd24_fly_sidebar', 15 );

if( !function_exists('newsbd24_before_page_content') ){
	/**
	* Add Before page content Element
	*
	* @since 1.0.0
	*/
	function newsbd24_before_page_content(){
	?>
    <section class="site-section">
    	<div class="container">
    		<div class="row">
    <?php
	}
}
add_action( 'newsbd24_before_page_content', 'newsbd24_before_page_content', 15 );

if( !function_exists('newsbd24_after_page_content') ){
	/**
	* Add After page content Element
	*
	* @since 1.0.0
	*/
	function newsbd24_after_page_content(){
	?>
    		</div><!-- end row -->
    	</div><!-- end container -->
    </section>
    <?php
	}
}
add_action( 'newsbd24_after_page_content', 'newsbd24_after_page_content', 10 );
/*
----------------------------------------------------
START BLOG THEME  STYLE
----------------------------------------------------
*/

if( !function_exists('newsbd24_left_sidebar') ){
	/**
	* Add Sidebar
	*
	* @since 1.0.0
	*/
	function newsbd24_left_sidebar(){
	 if( newsbd24_get_option('blog_layout') === 'left-sidebar' ):
	?>
    
   	 <aside class="sidebar col-md-4 col-sm-5" role="aside">
     	<?php get_sidebar();?>
     </aside>
    <?php
	 endif;
	}
}
add_action( 'newsbd24_blog_content_wrapper_before', 'newsbd24_left_sidebar', 11 );

if( !function_exists('newsbd24_blog_content_wrapper_before') ){
	/**
	* Add Before Posts Loop Element
	*
	* @since 1.0.0
	*/
	function newsbd24_blog_content_wrapper_before(){
	if( newsbd24_get_option('blog_layout') === 'no-sidebar' ):
	?>
    <div class="content col-md-10 col-sm-10 offset-md-1">
    <?php else:?>
    <div class="content col-md-8 col-sm-7">
    <?php endif;?>
    	<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
            
    <?php
	}
}
add_action( 'newsbd24_blog_content_wrapper_before', 'newsbd24_blog_content_wrapper_before', 12 );



if( !function_exists('newsbd24_blog_content_wrapper_after') ){
	/**
	* Add Before Posts Loop Element
	*
	* @since 1.0.0
	*/
	function newsbd24_blog_content_wrapper_after(){
	?>
    		</main>
    	</div>
    </div>
    		
    <?php
	}
}
add_action( 'newsbd24_blog_content_wrapper_after', 'newsbd24_blog_content_wrapper_after', 10 );

if( !function_exists('newsbd24_right_sidebar') ){
	/**
	* Add Sidebar
	*
	* @since 1.0.0
	*/
	function newsbd24_right_sidebar(){
	 if( newsbd24_get_option('blog_layout') === 'right-sidebar' ):
	?>
    
   	 <aside class="sidebar col-md-4 col-sm-5" role="aside">
     	<?php get_sidebar();?>
     </aside>
    		
    <?php
	endif;
	}
}
add_action( 'newsbd24_blog_content_wrapper_after', 'newsbd24_right_sidebar', 11 );


/*
----------------------------------------------------
START PAGE THEME STYLE
----------------------------------------------------
*/


if( !function_exists('newsbd24_page_left_sidebar') ){
	/**
	* Add Sidebar
	*
	* @since 1.0.0
	*/
	function newsbd24_page_left_sidebar(){
	 if( newsbd24_get_option('page_layout') === 'left-sidebar' ):
	?>
    
   	 <aside class="sidebar col-md-4 col-sm-5" role="aside">
     	<?php get_sidebar();?>
     </aside>
    <?php
	 endif;
	}
}
add_action( 'newsbd24_page_content_wrapper_before', 'newsbd24_page_left_sidebar', 11 );

if( !function_exists('newsbd24_page_content_wrapper_before') ){
	/**
	* Add Before Posts Loop Element
	*
	* @since 1.0.0
	*/
	function newsbd24_page_content_wrapper_before(){
	if( newsbd24_get_option('page_layout') === 'no-sidebar' ):
	?>
    <div class="content col-md-12 col-sm-12">
    <?php else:?>
    <div class="content col-md-8 col-sm-7">
    <?php endif;?>
    	<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
            
    <?php
	}
}
add_action( 'newsbd24_page_content_wrapper_before', 'newsbd24_page_content_wrapper_before', 12 );



if( !function_exists('newsbd24_page_content_wrapper_after') ){
	/**
	* Add Before Posts Loop Element
	*
	* @since 1.0.0
	*/
	function newsbd24_page_content_wrapper_after(){
	?>
    		</main>
    	</div>
    </div>
    		
    <?php
	}
}
add_action( 'newsbd24_page_content_wrapper_after', 'newsbd24_page_content_wrapper_after', 10 );

if( !function_exists('newsbd24_page_right_sidebar') ){
	/**
	* Add Sidebar
	*
	* @since 1.0.0
	*/
	function newsbd24_page_right_sidebar(){
	 if( newsbd24_get_option('page_layout') === 'right-sidebar' ):
	?>
    
   	 <aside class="sidebar col-md-4 col-sm-5" role="aside">
     	<?php get_sidebar();?>
     </aside>
    		
    <?php
	endif;
	}
}
add_action( 'newsbd24_page_content_wrapper_after', 'newsbd24_page_right_sidebar', 11 );

