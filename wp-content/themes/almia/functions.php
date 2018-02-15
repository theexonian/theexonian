<?php
/**
 * Almia functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * 
 * @package Almia
 * @since Almia 1.0
 */

/**
 * Almia only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'almia_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own almia_setup() function to override in a child theme.
 *
 * @since Almia 1.0
 */
function almia_setup() {

	/*
 	 * Sets the content width in pixels, based on the theme's design and stylesheet.
 	 */
	$GLOBALS['content_width'] = apply_filters( 'almia_content_width', 840 );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Almia, use a find and replace
	 * to change 'almia' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'almia', get_template_directory() . '/languages' );

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
	 * Enable support for custom logo.
	 *
	 *  @since Almia 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 350,
		'width'       => 350,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'almia' ),
		'social'  => __( 'Social Links Menu', 'almia' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', almia_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // almia_setup
add_action( 'after_setup_theme', 'almia_setup' );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Almia 1.0
 */
function almia_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'almia' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'almia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title lined-title"><span>',
		'after_title'   => '</span></h2>',
	) );


	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'almia' ),
		'id'            => 'footer-widget-1',
		'description'   => __( 'Appears at the footer of the site.', 'almia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'almia' ),
		'id'            => 'footer-widget-2',
		'description'   => __( 'Appears at the footer of the site.', 'almia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'almia' ),
		'id'            => 'footer-widget-3',
		'description'   => __( 'Appears at the footer of the site.', 'almia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 4', 'almia' ),
		'id'            => 'footer-widget-4',
		'description'   => __( 'Appears at the footer of the site.', 'almia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'almia_widgets_init' );

if ( ! function_exists( 'almia_fonts_url' ) ) :
/**
 * Register Google fonts for Almia.
 *
 * Create your own almia_fonts_url() function to override in a child theme.
 *
 * @since Almia 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function almia_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'almia' ) ) {
		$fonts[] = 'Open+Sans:400,700,400italic,700italic';
	}

	/* translators: If there are characters in your language that are not supported by Old Standard TT, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Old Standard TT font: on or off', 'almia' ) ) {
		$fonts[] = 'Old+Standard+TT:400,400italic,700';
	}


	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => /*urlencode*/( implode( '|', $fonts ) ),
			'subset' => /*urlencode*/( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Almia 1.0
 */
function almia_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'almia_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Almia 1.0
 */
function almia_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'almia-fonts', almia_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'almia-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'almia-ie', get_template_directory_uri() . '/css/ie.css', array( 'almia-style' ), '20160412' );
	wp_style_add_data( 'ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'almia-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'almia-style' ), '20160412' );
	wp_style_add_data( 'almia-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'almia-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'almia-style' ), '20160412' );
	wp_style_add_data( 'almia-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'almia-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160412', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'almia-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160412' );
	}

	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), '2.6.1', true );

	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array(), '20160818', true );

	$sidebar_class = '';
	if ( get_theme_mod( 'layout_sidebar_sticky', false ) ) {
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array(), '20161110', true );
		$sidebar_class = '.sidebar';
	}

	wp_enqueue_script( 'almia-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160412', true );

	wp_localize_script( 'almia-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'almia' ),
		'collapse' => __( 'collapse child menu', 'almia' ),
	) );

	$featured_posts_type =  get_theme_mod('featured_posts_type', 'carousel');
	wp_localize_script( 'almia-script', 'sliderOptions', array(
		'slideshowSpeed'	=> 5000,
		'prevText'			=> __('Previous', 'almia'),
		'nextText'			=> __('Next', 'almia'),
		'itemWidth'			=> ( $featured_posts_type == 'carousel' ) ? 300 : 0,
		'minItems'			=> ( $featured_posts_type == 'carousel' ) ? 2 : 1,
		'maxItems'			=> ( $featured_posts_type == 'carousel' ) ? 3 : 0,
		'sidebarClass'      => $sidebar_class,
		'itemMargin'        => ( $featured_posts_type == 'carousel' ) ? 10 : 0,
	) );
}
add_action( 'wp_enqueue_scripts', 'almia_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Almia 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function almia_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	if ( has_header_image() ) {
		$classes[] = 'custom-header-image';
	}
	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of left-sidebar to sites with active sidebar and have option as left sidebar.
	if ( is_active_sidebar( 'sidebar-1' ) && get_theme_mod( 'layout_left_sidebar', false ) ) {
		$classes[] = 'left-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'almia_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Almia 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function almia_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Widgets Includes
 */
require get_template_directory() . '/inc/widgets/recent-posts.php';

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Almia 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function almia_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'almia_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Almia 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function almia_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'almia_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Almia 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function almia_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'almia_widget_tag_cloud_args' );

/**
 * Setup a font controls & settings for Easy Google Fonts plugin (if installed)
 *
 * @since Almia 1.0
 *
 * @param array $options Default control list by the plugin.
 * @return array Modified $options parameter to applied in filter 'tt_font_get_option_parameters'.
 */
function almia_easy_google_fonts($options) {

	// Just replace all the plugin default font control

	unset(  $options['tt_default_body'],
			$options['tt_default_heading_2'],
			$options['tt_default_heading_3'],
			$options['tt_default_heading_4'],
			$options['tt_default_heading_5'],
			$options['tt_default_heading_6'],
			$options['tt_default_heading_1']
		);

	$new_options = array(
		
		'almia_default_body' => array(
			'name'        => 'almia_default_body',
			'title'       => __( 'Body & Paragraphs', 'almia' ),
			'description' => __( "Please select a font for the theme's body and paragraph text", 'almia' ),
			'properties'  => array( 'selector' => apply_filters( 'almia_default_body', 'body, button, input, select, textarea, blockquote cite, .entry-footer' ) ),
		),

		'almia_default_heading' => array(
			'name'        => 'almia_default_heading',
			'title'       => __( 'Headings', 'almia' ),
			'description' => __( "Please select a font for the theme's headings styles", 'almia' ),
			'properties'  => array( 'selector' => apply_filters( 'almia_default_heading', 'h1, h2, h3, h4, h5, h6, .widget .widget-title, .entry-footer .cat-links, .site-featured-posts .slider-nav .featured-title, .site-header .site-title, .site-footer .site-title, button, input[type="button"], input[type="reset"], input[type="submit"], .comment-form label, blockquote' ) ),
		),

		'almia_default_menu' => array(
			'name'        => 'almia_default_menu',
			'title'       => __( 'Menu', 'almia' ),
			'description' => __( "Please select a font for the theme's menu styles", 'almia' ),
			'properties'  => array( 'selector' => apply_filters( 'almia_default_menu', '.main-navigation' ) ),
		),

		'almia_default_entry_title' => array(
			'name'        => 'almia_default_entry_title',
			'title'       => __( 'Entry Title', 'almia' ),
			'description' => __( "Please select a font for the theme's Entry title styles", 'almia' ),
			'properties'  => array( 'selector' => apply_filters( 'almia_default_entry_title', '.entry-title, .post-navigation .post-title' ) ),
		),

		'almia_default_entry_meta' => array(
			'name'        => 'almia_default_entry_meta',
			'title'       => __( 'Entry Meta', 'almia' ),
			'description' => __( "Please select a font for the theme's Entry meta styles", 'almia' ),
			'properties'  => array( 'selector' => apply_filters( 'almia_default_entry_meta', '.entry-meta' ) ),
		),

		'almia_default_widget_title' => array(
			'name'        => 'almia_default_widget_title',
			'title'       => __( 'Widget Title', 'almia' ),
			'description' => __( "Please select a font for the theme's Widget title styles", 'almia' ),
			'properties'  => array( 'selector' => apply_filters( 'almia_default_widget_title', '.widget .widget-title, .comments-title, .comment-reply-title' ) ),
		),

	);

	return array_merge( $options, $new_options);
}
add_filter( 'tt_font_get_option_parameters', 'almia_easy_google_fonts', 10 , 1 );

/**
 * Setup for installation of plugins required and recommended by the theme
 *
 * @since Almia 1.0
 *
 */
function almia_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// The theme recommend the Optin forms.
		array(
			'name'               => 'Optin Forms', 
			'slug'               => 'optin-forms', 
			'required'           => false, 
		),

	);

	$config = array(
		'id'           => 'almia',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'almia_register_required_plugins' );
