<?php
/**
 * Oncanvas Theme Customizer.
 *
 * @package Oncanvas
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Oncanvas 1.0
 *
 * @see oncanvas_header_style()
 */
function oncanvas_custom_header_and_background() {
	$color_scheme             = oncanvas_get_color_scheme();
	$default_background_color = sanitize_hex_color_no_hash( $color_scheme[0], '#' );
	$default_text_color       = sanitize_hex_color_no_hash( $color_scheme[4], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Oncanvas.
	 *
	 * @since Oncanvas 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'oncanvas_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

}
add_action( 'after_setup_theme', 'oncanvas_custom_header_and_background' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function oncanvas_customize_register( $wp_customize ) {

	$color_scheme = oncanvas_get_color_scheme();
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

		// Add page background color setting and control.
		$wp_customize->add_setting( 'page_background_color', array(
			'default'           => $color_scheme[1],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
			'label'       => __( 'Page Background Color', 'oncanvas' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'footer_background_color', array(
			'default'           => $color_scheme[7],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
			'label'       => __( 'Footer Background Color', 'oncanvas' ),
			'section'     => 'colors',
		) ) );
	
		// Remove the core header textcolor control, as it shares the main text color.
		$wp_customize->remove_control( 'header_textcolor' );
	
		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color', array(
			'default'           => $color_scheme[3],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'       => __( 'Link Color', 'oncanvas' ),
			'section'     => 'colors',
		) ) );

		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color_hover', array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_hover', array(
			'label'       => __( 'Link Color :hover', 'oncanvas' ),
			'section'     => 'colors',
		) ) );
	
		// Add main text color setting and control.
		$wp_customize->add_setting( 'main_text_color', array(
			'default'           => $color_scheme[5],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
			'label'       => __( 'Main Text Color', 'oncanvas' ),
			'section'     => 'colors',
		) ) );
	
		// Add secondary text color setting and control.
		$wp_customize->add_setting( 'secondary_text_color', array(
			'default'           => $color_scheme[6],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
			'label'       => __( 'Secondary Text Color', 'oncanvas' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'highlight_background_color', array(
			'default'           => $color_scheme[9],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_background_color', array(
			'label'       => __( 'Highlight Background Color', 'oncanvas' ),
			'section'     => 'colors',
		) ) );

	$wp_customize->add_panel( 'oncanvas_panel', array(
		'priority'       => 130,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'oncanvas' ),
		'description'    => esc_html__( 'Oncanvas Theme Options', 'oncanvas' ),
	) );

	$wp_customize->add_section( 'oncanvas_header_options', array(
		'title'		  => esc_html__( 'Header', 'oncanvas' ),
		'panel'		  => 'oncanvas_panel',
	) );

		$wp_customize->add_setting( 'oncanvas_header_display_tagline', array(
			'default'           => 1,
			'sanitize_callback' => 'oncanvas_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'oncanvas_header_display_tagline', array(
			'label'             => esc_html__( 'Display site title and tagline in the header.', 'oncanvas' ),
			'section'           => 'oncanvas_header_options',
			'type'              => 'checkbox',
		) );

	return $wp_customize;

}
add_action( 'customize_register', 'oncanvas_customize_register' );


if ( ! function_exists( 'oncanvas_get_terms' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function oncanvas_get_terms() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'oncanvas' ) );

	// Post Tags
	$type_terms = get_terms( 'post_tag' );
	if ( ! empty( $type_terms ) ) {
		$type_slugs = wp_list_pluck( $type_terms, 'slug' );
		$type_names = wp_list_pluck( $type_terms, 'name' );
		$type_list = array_combine( $type_slugs, $type_names );
		$choices = $choices + $type_list;
	}

	return apply_filters( 'oncanvas_get_terms', $choices );
}
endif;

if ( ! function_exists( 'oncanvas_sanitize_terms' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function oncanvas_sanitize_terms( $value ) {

	$choices = oncanvas_get_terms();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'oncanvas_get_categories' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function oncanvas_get_categories() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'oncanvas' ) );

	// Categories
	$type_terms = get_terms( 'category' );
	if ( ! empty( $type_terms ) ) {

		$type_names = wp_list_pluck( $type_terms, 'name', 'term_id' );
		$choices = $choices + $type_names;

	}

	return apply_filters( 'oncanvas_get_categories', $choices );
}
endif;

if ( ! function_exists( 'oncanvas_sanitize_categories' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function oncanvas_sanitize_categories( $value ) {

	$choices = oncanvas_get_categories();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'oncanvas_sanitize_checkbox' ) ) :
/**
 * Sanitize the checkbox.
 *
 * @param  mixed 	$input.
 * @return boolean	(true|false).
 */
function oncanvas_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}
endif;

if ( ! function_exists( 'oncanvas_sanitize_widget_layout' ) ) :
/**
 * Sanitize the Featured Posts layout.
 *
 * @param  boolean	$input.
 * @return boolean	(true|false).
 */
function oncanvas_sanitize_widget_layout( $input ) {
	$choices = array( 'default', 'large' );

	if ( ! in_array( $input, $choices ) ) {
		$input = 'default';
	}

	return $input;
}
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function oncanvas_customize_preview_js() {
	wp_enqueue_script( 'oncanvas_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160513', true );
}
add_action( 'customize_preview_init', 'oncanvas_customize_preview_js' );

/**
 * Registers color schemes for Oncanvas.
 *
 * Can be filtered with {@see 'oncanvas_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since Oncanvas 1.0
 *
 * @return array An associative array of color scheme options.
 */
function oncanvas_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Oncanvas.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since Oncanvas 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	 
	return apply_filters( 'oncanvas_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'oncanvas' ),
			'colors' => array(
				'#f1eadf', // [0] background color 
				'#ffffff', // [1] content container background color
				'#262626', // [2] footer featured content background color 
				'#3F88C5', // [3] link color
				'#e3713d', // [4] link :hover color
				'#333333', // [5] main text color
				'#888888', // [6] secondary text color
				'', // [7] footer background color
				'#131313', // [8] main menu background color
				'#3F88C5', // [9] highlight background color
			),
		),
	) );
}

if ( ! function_exists( 'oncanvas_get_color_scheme' ) ) :
/**
 * Retrieves the current Oncanvas color scheme.
 *
 * Create your own oncanvas_get_color_scheme() function to override in a child theme.
 *
 * @since Oncanvas 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function oncanvas_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = oncanvas_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // oncanvas_get_color_scheme

if ( ! function_exists( 'oncanvas_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for Oncanvas.
 *
 * Create your own oncanvas_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * @since Oncanvas 1.0
 *
 * @return array Array of color schemes.
 */
function oncanvas_get_color_scheme_choices() {
	$color_schemes                = oncanvas_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // oncanvas_get_color_scheme_choices


if ( ! function_exists( 'oncanvas_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for Oncanvas color schemes.
 *
 * Create your own oncanvas_sanitize_color_scheme() function to override
 * in a child theme.
 *
 * @since Oncanvas 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function oncanvas_sanitize_color_scheme( $value ) {
	$color_schemes = oncanvas_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}

	return $value;
}
endif; // oncanvas_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Oncanvas 1.0
 *
 * @see wp_add_inline_style()
 */
function oncanvas_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = oncanvas_get_color_scheme();

	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'        		 => $color_scheme[0],
		'page_background_color'  		 => $color_scheme[1],
		'footer_featured_background_color' => $color_scheme[2],
		'link_color'             		 => $color_scheme[3],
		'link_color_hover'        		 => $color_scheme[4],
		'main_text_color'         		 => $color_scheme[5],
		'secondary_text_color'    		 => $color_scheme[6],
		'footer_background_color' 		 => $color_scheme[7],
		'main_menu_background_color' 	 => $color_scheme[8],
		'highlight_background_color' 	 => $color_scheme[9],

	);

	$color_scheme_css = oncanvas_get_color_scheme_css( $colors );

	wp_add_inline_style( 'oncanvas-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'oncanvas_color_scheme_css' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Oncanvas 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function oncanvas_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'        		=> '',
		'page_background_color'   		=> '',
		'footer_featured_background_color' 		=> '',
		'link_color'              		=> '',
		'link_color_hover'        		=> '',
		'main_text_color'         		=> '',
		'secondary_text_color'    		=> '',
		'footer_background_color' 		=> '',
		'main_menu_background_color' 	=> '',
		'highlight_background_color' 	=> '',
	) );

	return <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	/* Page Background Color */
	.site-header .wrapper-header,
	.wrapper-site-menu,
	.wrapper-main {
		background-color: {$colors['page_background_color']};
	}

	/* Footer Background Color */
	.site-footer {
		background-color: {$colors['footer_background_color']};
	}

	/* Link Color */
	a {
		color: {$colors['link_color']};
	}

	/* Link:hover Color */
	a:hover,
	a:focus,
	.ilovewp-post .post-meta .entry-date a:hover,
	.ilovewp-post .post-meta .entry-date a:focus {
		color: {$colors['link_color_hover']};
	}

	/* Main Text Color */
	body {
		color: {$colors['main_text_color']};
	}

	/* Secondary Text Color */

	.post-meta,
	.ilovewp-post .post-meta,
	.ilovewp-post .post-meta .entry-date a {
		color: {$colors['secondary_text_color']};
	}

	/* Highlight Background Color */
	.infinite-scroll #infinite-handle span {
		background-color: {$colors['highlight_background_color']};
	}

CSS;
}


/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since Oncanvas 1.0
 *
 * @see wp_add_inline_style()
 */
function oncanvas_page_background_color_css() {
	$color_scheme          = oncanvas_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		.site-header .wrapper-header, .wrapper-site-menu, .wrapper-main {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'oncanvas-style', sprintf( $css, esc_attr( $page_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'oncanvas_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the footer background color.
 *
 * @since Oncanvas 1.0
 *
 * @see wp_add_inline_style()
 */
function oncanvas_footer_background_color_css() {
	$color_scheme          = oncanvas_get_color_scheme();
	$default_color         = $color_scheme[1];
	$footer_background_color = get_theme_mod( 'footer_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $footer_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Footer Background Color */
		.site-footer {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'oncanvas-style', sprintf( $css, esc_attr( $footer_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'oncanvas_footer_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Highlights background color.
 *
 * @since Oncanvas 1.0
 *
 * @see wp_add_inline_style()
 */
function oncanvas_highlight_background_color_css() {
	$color_scheme          = oncanvas_get_color_scheme();
	$default_color         = $color_scheme[9];
	$highlight_background_color = get_theme_mod( 'highlight_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $highlight_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Highlight Background Color */
		.infinite-scroll #infinite-handle span{
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'oncanvas-style', sprintf( $css, esc_attr( $highlight_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'oncanvas_highlight_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Oncanvas 1.0
 *
 * @see wp_add_inline_style()
 */
function oncanvas_link_color_css() {
	$color_scheme    = oncanvas_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = get_theme_mod( 'link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link Color */
		a {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'oncanvas-style', sprintf( $css, esc_attr( $link_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'oncanvas_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the link :hover color.
 *
 * @since Oncanvas 1.0
 *
 * @see wp_add_inline_style()
 */
function oncanvas_link_color_hover_css() {
	$color_scheme    = oncanvas_get_color_scheme();
	$default_color   = $color_scheme[3];
	$link_color = get_theme_mod( 'link_color_hover', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link:hover Color */
		a:hover,
		a:focus,
		.ilovewp-post .post-meta .entry-date a:hover,
		.ilovewp-post .post-meta .entry-date a:focus,
		h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
		h1 a:focus, h2 a:focus, h3 a:focus, h4 a:focus, h5 a:focus, h6 a:focus,
		.ilovewp-featured-posts a:hover, .ilovewp-featured-posts a:focus {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'oncanvas-style', sprintf( $css, esc_attr( $link_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'oncanvas_link_color_hover_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Oncanvas 1.0
 *
 * @see wp_add_inline_style()
 */
function oncanvas_main_text_color_css() {
	$color_scheme    = oncanvas_get_color_scheme();
	$default_color   = $color_scheme[4];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Main Text Color */
		body {
			color: %1$s
		}
	';

	wp_add_inline_style( 'oncanvas-style', sprintf( $css, esc_attr( $main_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'oncanvas_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Oncanvas 1.0
 *
 * @see wp_add_inline_style()
 */
function oncanvas_secondary_text_color_css() {
	$color_scheme    = oncanvas_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */

		body:not(.search-results) .entry-summary {
			color: %1$s;
		}

		.post-meta,
		.ilovewp-post .post-meta {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'oncanvas-style', sprintf( $css, esc_attr( $secondary_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'oncanvas_secondary_text_color_css', 11 );