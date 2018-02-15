<?php
/**
 * Oncanvas functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Oncanvas
 */

if ( ! function_exists( 'oncanvas_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function oncanvas_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Oncanvas, use a find and replace
	 * to change 'oncanvas' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'oncanvas', get_template_directory() . '/languages' );

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

	set_post_thumbnail_size( 340, 220, true );
	
	// Featured Post Main Thumbnail on the front page & single page template
	add_image_size( 'oncanvas-large-thumbnail', 340, 220, true );
	add_image_size( 'oncanvas-featured-thumbnail-large', 550, 330, true );
	add_image_size( 'oncanvas-featured-thumbnail-small', 255, 150, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'	=> esc_html__( 'Primary Menu', 'oncanvas' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

    add_theme_support( 'custom-logo', array(
	   'height'      => 100,
	   'width'       => 300,
	   'flex-width'  => true,
	   'flex-height' => true,
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', oncanvas_fonts_url() ) );

}
endif; // oncanvas_setup
add_action( 'after_setup_theme', 'oncanvas_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function oncanvas_content_width() {
	
	$GLOBALS['content_width'] = apply_filters( 'oncanvas_content_width', 800 );

}
add_action( 'after_setup_theme', 'oncanvas_content_width', 0 );

/* Custom Excerpt Length
==================================== */

add_filter( 'excerpt_length', 'oncanvas_new_excerpt_length' );

function oncanvas_new_excerpt_length( $length ) {
	return is_admin() ? $length : 60;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function oncanvas_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'oncanvas' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'This is the main sidebar area that appears on all pages', 'oncanvas' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage: Welcome (Left)', 'oncanvas' ),
		'id'            => 'homepage-welcome-1',
		'description'   => esc_html__( 'This is displayed on the homepage. It is recommended to add a single Text Widget. The widget title is wrapped inside a <h1></h1> tag.', 'oncanvas' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title homepage-welcome-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage: Welcome (Right)', 'oncanvas' ),
		'id'            => 'homepage-welcome-2',
		'description'   => esc_html__( 'This is displayed on the homepage. Works best with an Image widget and/or a Social Icons widget.', 'oncanvas' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 1', 'oncanvas' ),
		'id'            => 'sidebar-footer-1',
		'description'   => esc_html__( 'This is displayed in the footer of the website. By default has a width of 340px.', 'oncanvas' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 2', 'oncanvas' ),
		'id'            => 'sidebar-footer-2',
		'description'   => esc_html__( 'This is displayed in the footer of the website. By default has a width of 340px.', 'oncanvas' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 3', 'oncanvas' ),
		'id'            => 'sidebar-footer-3',
		'description'   => esc_html__( 'This is displayed in the footer of the website. By default has a width of 340px.', 'oncanvas' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );

}
add_action( 'widgets_init', 'oncanvas_widgets_init' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function oncanvas_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'oncanvas_pingback_header' );

if ( ! function_exists( 'oncanvas_fonts_url' ) ) :

/**
 * Register Google fonts for Oncanvas.
 *
 * Create your own oncanvas_fonts_url() function to override in a child theme.
 *
 * @since Oncanvas 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function oncanvas_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'oncanvas' ) ) {
		$fonts[] = 'Lato:300,400,400i,700,700i,900';
	}

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'oncanvas' ) ) {
		$fonts[] = 'Merriweather:400,400i,700,700i';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function oncanvas_scripts() {

	wp_enqueue_style( 'oncanvas-style', get_stylesheet_uri() );

	// Add Dashicons font.
	wp_enqueue_style( 'dashicons' );

	// Add Genericons font.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	wp_enqueue_script(
		'jquery-slicknav',
		get_template_directory_uri() . '/js/jquery.slicknav.min.js',
		array('jquery'),
		null
	);

	wp_enqueue_script(
		'jquery-superfish',
		get_template_directory_uri() . '/js/superfish.min.js',
		array('jquery'),
		null
	);

	wp_register_script( 'oncanvas-scripts', get_template_directory_uri() . '/js/oncanvas.js', array( 'jquery' ), '20160820', true );

	/* Contains the strings used in our JavaScript file */
	$oncanvasStrings = array (
		'slicknav_menu_home' => _x( 'HOME', 'The main label for the expandable mobile menu', 'oncanvas' )
	);

	wp_localize_script( 'oncanvas-scripts', 'oncanvasStrings', $oncanvasStrings );

	wp_enqueue_script( 'oncanvas-scripts' );

	// Loads our default Google Webfont
	wp_enqueue_style( 'oncanvas-webfonts', oncanvas_fonts_url(), array(), null, null );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'oncanvas_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Oncanvas 1.0
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function oncanvas_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'oncanvas_widget_tag_cloud_args' );