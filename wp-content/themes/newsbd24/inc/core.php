<?php
/**
 * newsbd24 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package newsbd24
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'newsbd24_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newsbd24_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on newsbd24, use a find and replace
		 * to change 'newsbd24' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'newsbd24', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'newsbd24' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
			'quote'
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'newsbd24_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		// Enable support for custom logo.
		add_theme_support( 'custom-logo' );
		
		// Declare WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		
		
		add_image_size( 'bdnews24_news_block_size', 400, 400, array( 'left', 'top' ) ); // Hard crop left top
		add_image_size( 'bdnews24_block_size_cropping', 400, 400, true );
		
		add_editor_style();
	}
endif;
add_action( 'after_setup_theme', 'newsbd24_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newsbd24_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'newsbd24_content_width', 640 );
}
add_action( 'after_setup_theme', 'newsbd24_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newsbd24_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'newsbd24' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'newsbd24' ),
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Fly Sidebar', 'newsbd24' ),
		'id'            => 'flysidebar',
		'description'   => esc_html__( 'Add widgets here.', 'newsbd24' ),
		'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'newsbd24' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'newsbd24' ),
		'before_widget' => '<div id="%1$s" class="col-md-4  col-sm-6 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Ad', 'newsbd24' ),
		'id'            => 'header_ad',
		'description'   => esc_html__( 'Add Google Ads widgets here.', 'newsbd24' ),
		'before_widget' => '<div id="header_ad" class="col-md-8 text-align-right">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Instagram Widgets', 'newsbd24' ),
		'id'            => 'instagram',
		'description'   => esc_html__( 'Add  Instagram  widgets here.', 'newsbd24' ),
		'before_widget' => '<div id="%1$s"  class="instagram-wrapper clearfix text-center %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="instagram-widget-title">',
		'after_title'   => '</h3>',
	) );
	
	
}
add_action( 'widgets_init', 'newsbd24_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function newsbd24_scripts() {
	/* FONTS*/
	wp_enqueue_style( 'Work-Sans', '//fonts.googleapis.com/css?family=Work+Sans:300,400,500,700');
	wp_enqueue_style( 'Josefin-Sans', '//fonts.googleapis.com/css?family=Josefin+Sans:300,400,400i,600,700');
	
	/* PLUGIN CSS */
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.css' ), '4.0.0' );
	wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/assets/css/magnific-popup.css' ), '3.3.7' );
	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/font-awesome.css' ), '4.7.0' );
	
	
	/* STYLE */
	wp_enqueue_style( 'newsbd24-style', get_stylesheet_uri() );
	

	//Vendor Js
	wp_enqueue_script( 'tether', get_theme_file_uri( '/assets/js/tether.js' ),0,'1.4.0',true );
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array('jquery','masonry','imagesloaded'), '4.0.0', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri().'/assets/js/jquery.magnific-popup.js', 0, '1.1.0',true );
	
	wp_enqueue_script( 'jquery.newsTicker', get_theme_file_uri( '/assets/js/jquery.newsTicker.js' ), 0,'1.0.11',true  );
	
	wp_enqueue_script( 'newsbd24-core', get_template_directory_uri().'/assets/js/newsbd24.js', 0, '1.0',true );
	
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newsbd24_scripts' );





/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package newsbd24
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses newsbd24_header_style()
 */
function newsbd24_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'newsbd24_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'newsbd24_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'newsbd24_custom_header_setup' );

if ( ! function_exists( 'newsbd24_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see newsbd24_custom_header_setup().
	 */
	function newsbd24_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function newsbd24_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'newsbd24_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function newsbd24_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'newsbd24_pingback_header' );


