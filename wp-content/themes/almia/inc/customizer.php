<?php
/**
 * Almia Customizer functionality
 *
 * 
 * @package Almia
 * @since Almia 1.0
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Almia 1.0
 *
 * @see almia_header_style()
 */
function almia_custom_header_and_background() {
	$color_scheme             = almia_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[3], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Almia.
	 *
	 * @since Almia 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'almia_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Almia.
	 *
	 * @since Almia 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'almia_custom_header_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 1300,
		'height'                 => 450,
		'flex-height'            => true,
		'wp-head-callback'       => 'almia_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'almia_custom_header_and_background' );

if ( ! function_exists( 'almia_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own almia_header_style() function to override in a child theme.
 *
 * @since Almia 1.0
 *
 * @see almia_custom_header_and_background().
 */
function almia_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() || get_theme_mod('display_header_description', true ) ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="almia-header-css">
		.site-branding {
			margin-bottom: 0;
			margin-top: 0;
		}
	</style>
	<?php
} 
endif; // almia_header_style 

/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since Almia 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function almia_customize_register( $wp_customize ) {
	$color_scheme = almia_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->get_control('display_header_text')->label    = __('Display Site Title', 'almia');
	//$wp_customize->get_setting('display_header_text')->transport = 'postMessage';

	$wp_customize->add_setting( 'display_header_description', array(
		'default'	=> true,
		'sanitize_callback' => 'almia_sanitize_checkbox',
		//'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'display_header_description', array(
		'setting'	=> 'display_header_description',
		'label'		=> __('Display Site Tagline', 'almia'),
		'type'		=> 'checkbox',
		'section'	=> 'title_tagline',
		'priority'  => 45,
	) );


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'almia_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'almia_customize_partial_blogdescription',
		) );
		$wp_customize->selective_refresh->add_partial( 'footer_credit', array(
			'selector' => '.site-info',
			'container_inclusive' => false,
			'render_callback' => 'almia_footer_credit',
		) );
	}

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'almia_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'almia' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => almia_get_color_scheme_choices(),
		'priority' => 1,
	) );

	// Add page background color setting and control.
	$wp_customize->add_setting( 'page_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
		'label'       => __( 'Page Background Color', 'almia' ),
		'section'     => 'colors',
	) ) );

	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link Color', 'almia' ),
		'section'     => 'colors',
	) ) );

	// Add main text color setting and control.
	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       => __( 'Main Text Color', 'almia' ),
		'section'     => 'colors',
	) ) );

	// Add secondary text color setting and control.
	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'       => __( 'Secondary Text Color', 'almia' ),
		'section'     => 'colors',
	) ) );


	/* 
	 * Section Featured Posts
	 *
	 * All the featured posts setting, most of the setting used on featured-posts.php
	 */
	$wp_customize->add_section('featured_posts', array (
		'title'		  => __('Featured Posts', 'almia'),
		/*'priority'	  => 30,*/
	) );

	// Add activate featured posts' section setting and control.
	$wp_customize->add_setting( 'featured_posts_on', array(
		'default'	=> false,
		'sanitize_callback' => 'almia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'featured_posts_on', array(
		'setting'	=> 'featured_posts_on',
		'label'		=> __('Activate featured posts', 'almia'),
		'type'		=> 'checkbox',
		'section'	=> 'featured_posts'
	) );

	// Add featured posts tags
	$wp_customize->add_setting('featured_posts_tags', array(
		'default'	=> 'featured',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control('featured_posts_tags', array(
		'setting'		=> 'featured_posts_tags',
		'label'			=> __('Tags', 'almia'),
		'type'			=> 'text',
		'section'		=> 'featured_posts',
	) );

	// Add featured posts number
	$wp_customize->add_setting('featured_posts_number', array(
		'default'	=> 5,
		'sanitize_callback' => 'almia_sanitize_number_absint',
	) );

	$wp_customize->add_control('featured_posts_number', array(
		'setting'		=> 'featured_posts_number',
		'label'			=> __('Maximum number of posts', 'almia'),
		'type'			=> 'select',
		'choices'		=> array( 1 => 1, 2 => 2 , 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10),
		'section'		=> 'featured_posts',
	) );

	// Add featured posts type setting
	$wp_customize->add_setting('featured_posts_type', array(
		'default'	=> 'carousel',
		'sanitize_callback' => 'almia_sanitize_featured_posts_type',
	) );

	$wp_customize->add_control('featured_posts_type', array(
		'setting'		=> 'featured_posts_type',
		'label'			=> __('Slider type', 'almia'),
		'type'			=> 'radio',
		'choices'		=> array( 'carousel' => __('Carousel', 'almia'), 'full' => __('Full width', 'almia') ),
		'section'		=> 'featured_posts',
	) );

	/* 
	 * Section Footer
	 *
	 * All the footer setting
	 */
	$wp_customize->add_section('layout_setting', array (
		'title'		  => __('Layout Setting', 'almia'),
	) );

	$wp_customize->add_setting( 'layout_left_sidebar', array(
		'default'	=> false,
		'sanitize_callback' => 'almia_sanitize_checkbox',
	) );
	$wp_customize->add_control('layout_left_sidebar', array(
		'setting'		=> 'layout_left_sidebar',
		'label'			=> __('Left Sidebar', 'almia'),
		'description'   => __('Put sidebar on the left side of content.', 'almia'),
		'type'			=> 'checkbox',
		'section'		=> 'layout_setting',
	) );

	$wp_customize->add_setting( 'layout_sidebar_sticky', array(
		'default'	=> false,
		'sanitize_callback' => 'almia_sanitize_checkbox',
	) );
	$wp_customize->add_control('layout_sidebar_sticky', array(
		'setting'		=> 'layout_sidebar_sticky',
		'label'			=> __('Sticky Sidebar', 'almia'),
		'description'   => __('Make the sidebar sticky on scroll. When sidebar height is shorter than the content area', 'almia'),
		'type'			=> 'checkbox',
		'section'		=> 'layout_setting',
	) );

	/* 
	 * Section Footer
	 *
	 * All the footer setting
	 */
	$wp_customize->add_section('footer_setting', array (
		'title'		  => __('Footer Setting', 'almia'),
	) );
	
	if ( shortcode_exists('optinform')) {
		$wp_customize->add_setting( 'footer_optin_form', array(
			'default'	=> false,
			'sanitize_callback' => 'almia_sanitize_checkbox',
		) );
		$wp_customize->add_control('footer_optin_form', array(
			'setting'		=> 'footer_optin_form',
			'label'			=> __('Activate Optin Form', 'almia'),
			'description'   => __('Only if you have Optin Form plugin activated', 'almia'),
			'type'			=> 'checkbox',
			'section'		=> 'footer_setting',
		) );
	}

	$wp_customize->add_setting( 'footer_credit', array(
		'default'	=> '',
		'sanitize_callback' => 'almia_sanitize_footer_credit',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control('footer_credit', array(
		'setting'		=> 'footer_credit',
		'label'			=> __('Footer credit text', 'almia'),
		'type'			=> 'textarea',
		'section'		=> 'footer_setting',
	) );


}
add_action( 'customize_register', 'almia_customize_register', 11 );

/**
 * Sanitize the option with only 'carousel' and 'full'.
 *
 * @since Almia 1.0
 *
 * @return HTML string sanitized with wpkses.
 */
function almia_sanitize_featured_posts_type($value) {
	return in_array( $value, array( 'carousel', 'full' ) ) ? $value : 'carousel';
}

/**
 * Allowed html tags for footer credit.
 *
 * @since Almia 1.0
 *
 * @return HTML string sanitized with wpkses.
 */
function almia_sanitize_footer_credit($value) {
	$allowed_tags = array(
						'a' => array(
							'href' => array(),
							'title' => array(),
							'rel' => array(),
						),
						'br' => array(),
						'em' => array(),
						'strong' => array(),
						);
	return wp_kses( $value, $allowed_tags );
}

/**
 * Checkbox sanitization callback.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @since Almia 1.0
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function almia_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Number sanitization callback.
 *
 * - Sanitization: number_absint
 * - Control: number
 * 
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 * 
 * NOTE: absint() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function almia_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}


/**
 * Render the site title for the selective refresh partial.
 *
 * @since Almia 1.2
 * @see almia_customize_register()
 *
 * @return void
 */
function almia_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Almia 1.2
 * @see almia_customize_register()
 *
 * @return void
 */
function almia_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Registers color schemes for Almia.
 *
 * Can be filtered with {@see 'almia_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since Almia 1.0
 *
 * @return array An associative array of color scheme options.
 */
function almia_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Almia.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since Almia 1.0
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
	return apply_filters( 'almia_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'almia' ),
			'colors' => array(
				'#1a1a1a',
				'#ffffff',
				'#007acc',
				'#1a1a1a',
				'#686868',
			),
		),
		'dark' => array(
			'label'  => __( 'Dark', 'almia' ),
			'colors' => array(
				'#454545',
				'#1a1a1a',
				'#9adffd',
				'#e5e5e5',
				'#c1c1c1',
			),
		),
		'gray' => array(
			'label'  => __( 'Gray', 'almia' ),
			'colors' => array(
				'#616a73',
				'#4d545c',
				'#c7c7c7',
				'#f2f2f2',
				'#f2f2f2',
			),
		),
		'red' => array(
			'label'  => __( 'Red', 'almia' ),
			'colors' => array(
				'#ffffff',
				'#ff675f',
				'#640c1f',
				'#402b30',
				'#402b30',
			),
		),
		'yellow' => array(
			'label'  => __( 'Yellow', 'almia' ),
			'colors' => array(
				'#3b3721',
				'#ffef8e',
				'#774e24',
				'#3b3721',
				'#5b4d3e',
			),
		),
	) );
}

if ( ! function_exists( 'almia_get_color_scheme' ) ) :
/**
 * Retrieves the current Almia color scheme.
 *
 * Create your own almia_get_color_scheme() function to override in a child theme.
 *
 * @since Almia 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function almia_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = almia_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // almia_get_color_scheme

if ( ! function_exists( 'almia_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for Almia.
 *
 * Create your own almia_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * @since Almia 1.0
 *
 * @return array Array of color schemes.
 */
function almia_get_color_scheme_choices() {
	$color_schemes                = almia_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // almia_get_color_scheme_choices


if ( ! function_exists( 'almia_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for Almia color schemes.
 *
 * Create your own almia_sanitize_color_scheme() function to override
 * in a child theme.
 *
 * @since Almia 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function almia_sanitize_color_scheme( $value ) {
	$color_schemes = almia_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}

	return $value;
}
endif; // almia_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Almia 1.0
 *
 * @see wp_add_inline_style()
 */
function almia_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = almia_get_color_scheme();

	// Convert main text hex color to rgba.
	$color_textcolor_rgb = almia_hex2rgb( $color_scheme[3] );

	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'      => $color_scheme[0],
		'page_background_color' => $color_scheme[1],
		'link_color'            => $color_scheme[2],
		'main_text_color'       => $color_scheme[3],
		'secondary_text_color'  => $color_scheme[4],
		'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),
		'sidebar_background_color' => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.05)', $color_textcolor_rgb ),

	);

	$color_scheme_css = almia_get_color_scheme_css( $colors );

	wp_add_inline_style( 'almia-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'almia_color_scheme_css' );

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Almia 1.0
 */
function almia_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20160412', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', almia_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'almia_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Almia 1.0
 */
function almia_customize_preview_js() {
	wp_enqueue_script( 'almia-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160412', true );
}
add_action( 'customize_preview_init', 'almia_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Almia 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function almia_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'      => '',
		'page_background_color' => '',
		'link_color'            => '',
		'main_text_color'       => '',
		'secondary_text_color'  => '',
		'border_color'          => '',
		'sidebar_background_color' => '',
	) );

	return <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	/* Page Background Color */
	.site {
		background-color: {$colors['page_background_color']};
	}

	mark,
	ins,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus {
		color: {$colors['page_background_color']};
	}

	/* Link Color */
	.menu-toggle:hover,
	.menu-toggle:focus,
	a,
	.main-navigation a:hover,
	.main-navigation a:focus,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus,
	.social-navigation a:hover:before,
	.social-navigation a:focus:before,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.site-branding .site-title a:hover,
	.site-branding .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	.entry-meta a:hover,
	.entry-meta a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .comment-edit-link:hover,
	.pingback .comment-edit-link:focus,
	.comment-reply-link,
	.comment-reply-link:hover,
	.comment-reply-link:focus,
	.required,
	.site-info a:hover,
	.site-info a:focus,
	.widget_archive a:hover,
	.widget_categories a:hover,
	.widget_links a:hover,
	.widget_meta a:hover,
	.widget_nav_menu a:hover,
	.widget_pages a:hover,
	.widget_recent_comments a:hover,
	.widget_recent_entries a:hover {
		color: {$colors['link_color']};
	}

	mark,
	ins,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.widget_calendar tbody a,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['link_color']};
	}

	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus {
		border-color: {$colors['link_color']};
	}

	/* Main Text Color */
	body,
	blockquote cite,
	blockquote small,
	.main-navigation a,
	.menu-toggle,
	.dropdown-toggle,
	.social-navigation a,
	.post-navigation a,
	.widget-title a,
	.site-branding .site-title a,
	.entry-title a,
	.page-links > .page-links-title,
	.comment-author,
	.comment-reply-title small a:hover,
	.comment-reply-title small a:focus,
	.widget_archive a,
	.widget_categories a,
	.widget_links a,
	.widget_meta a,
	.widget_nav_menu a,
	.widget_pages a,
	.widget_recent_comments a,
	.widget_recent_entries a,
	.social-share button:hover {
		color: {$colors['main_text_color']};
	}

	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.page-links a {
		background-color: {$colors['main_text_color']};
	}

	/* Secondary Text Color */

	/**
	 * IE8 and earlier will drop any block with CSS3 selectors.
	 * Do not combine these styles with the next block.
	 */
	body:not(.search-results) .entry-summary {
		color: {$colors['secondary_text_color']};
	}

	blockquote,
	.post-password-form label,
	a:hover,
	a:focus,
	a:active,
	.post-navigation .meta-nav,
	.image-navigation,
	.comment-navigation,
	.widget_recent_entries .post-date,
	.widget_rss .rss-date,
	.widget_rss cite,
	.site-description,
	.author-bio,
	.entry-meta,
	.entry-meta a,
	.sticky-post,
	.taxonomy-description,
	.entry-caption,
	.comment-metadata,
	.pingback .edit-link,
	.comment-metadata a,
	.pingback .comment-edit-link,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.site-info,
	.site-info a,
	.wp-caption .wp-caption-text,
	.gallery-caption,
	.widecolumn label,
	.widecolumn .mu_register label,
	.social-share button {
		color: {$colors['secondary_text_color']};
	}

	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus {
		background-color: {$colors['secondary_text_color']};
	}

	/* Border Color */
	fieldset,
	pre,
	abbr,
	acronym,
	table,
	th,
	td,
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	textarea,
	.main-navigation li,
	.main-navigation .primary-menu,
	.menu-toggle,
	.dropdown-toggle:after,
	.social-navigation a,
	.image-navigation,
	.comment-navigation,
	.tagcloud a,
	.entry-content,
	.entry-summary,
	.page-links a,
	.page-links > span,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-reply-link,
	.no-comments,
	.widecolumn .mu_register .mu_alert,
	blockquote,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.widget,
	.page-header,
	.page-links a,
	.comments-title,
	.comment-reply-title,
	.author-info,
	.site-header,
	.site-footer,
	.widget-title > span,
	.widget_archive li,
	.widget_categories li,
	.widget_links li,
	.widget_meta li,
	.widget_nav_menu li,
	.widget_pages li,
	.widget_recent_comments li,
	.widget_recent_entries li,
	.widget-twitter .tweet,
	.widget-recent-posts ul li {
		border-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}

	hr,
	code,
	.widget-title:before,
	.widget-title:after,
	.hentry .entry-title:after {
		background-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}

	.site-main > article {
		border-color: {$colors['sidebar_background_color']};
	}

	@media screen and (min-width: 56.875em) {
		.main-navigation li:hover > a,
		.main-navigation li.focus > a {
			color: {$colors['link_color']};
		}

		.main-navigation ul ul,
		.main-navigation ul ul li {
			border-color: {$colors['border_color']};
		}

		.main-navigation ul ul:before {
			border-top-color: {$colors['border_color']};
			border-bottom-color: {$colors['border_color']};
		}

		.main-navigation ul ul li {
			background-color: {$colors['page_background_color']};
		}

		.main-navigation ul ul:after {
			border-top-color: {$colors['page_background_color']};
			border-bottom-color: {$colors['page_background_color']};
		}

		.site-content::before {
			background-color: {$colors['sidebar_background_color']};
		}
	}

CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since Almia 1.0
 */
function almia_color_scheme_css_template() {
	$colors = array(
		'background_color'      => '{{ data.background_color }}',
		'page_background_color' => '{{ data.page_background_color }}',
		'link_color'            => '{{ data.link_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'secondary_text_color'  => '{{ data.secondary_text_color }}',
		'border_color'          => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-almia-color-scheme">
		<?php echo almia_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'almia_color_scheme_css_template' );

/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since Almia 1.0
 *
 * @see wp_add_inline_style()
 */
function almia_page_background_color_css() {
	$color_scheme          = almia_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = esc_attr( get_theme_mod( 'page_background_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		.site {
			background-color: %1$s;
		}

		mark,
		ins,
		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.page-links a,
		.page-links a:hover,
		.page-links a:focus {
			color: %1$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul li {
				background-color: %1$s;
			}

			.main-navigation ul ul:after {
				border-top-color: %1$s;
				border-bottom-color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'almia-style', sprintf( $css, $page_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'almia_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Almia 1.0
 *
 * @see wp_add_inline_style()
 */
function almia_link_color_css() {
	$color_scheme    = almia_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = esc_attr( get_theme_mod( 'link_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link Color */
		.menu-toggle:hover,
		.menu-toggle:focus,
		a,
		.main-navigation a:hover,
		.main-navigation a:focus,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.social-navigation a:hover:before,
		.social-navigation a:focus:before,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-meta a:hover,
		.entry-meta a:focus,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.comment-reply-link,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.required,
		.site-info a:hover,
		.site-info a:focus,
		.widget_archive a,
		.widget_categories a:hover,
		.widget_links a:hover,
		.widget_meta a:hover,
		.widget_nav_menu a:hover,
		.widget_pages a:hover,
		.widget_recent_comments a:hover,
		.widget_recent_entries a:hover {
			color: %1$s;
		}

		mark,
		ins,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus {
			background-color: %1$s;
		}

		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		textarea:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.menu-toggle:hover,
		.menu-toggle:focus {
			border-color: %1$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'almia-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'almia_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Almia 1.0
 *
 * @see wp_add_inline_style()
 */
function almia_main_text_color_css() {
	$color_scheme    = almia_get_color_scheme();
	$default_color   = $color_scheme[3];
	$main_text_color = esc_attr( get_theme_mod( 'main_text_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	// Convert main text hex color to rgba.
	$main_text_color_rgb = almia_hex2rgb( $main_text_color );

	// If the rgba values are empty return early.
	if ( empty( $main_text_color_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );
	$sidebar_background_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.05)', $main_text_color_rgb );

	$css = '
		/* Custom Main Text Color */
		body,
		blockquote cite,
		blockquote small,
		.main-navigation a,
		.menu-toggle,
		.dropdown-toggle,
		.social-navigation a,
		.post-navigation a,
		.widget-title a,
		.site-branding .site-title a,
		.entry-title a,
		.page-links > .page-links-title,
		.comment-author,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus,
		.widget_archive a,
		.widget_categories a,
		.widget_links a,
		.widget_meta a,
		.widget_nav_menu a,
		.widget_pages a,
		.widget_recent_comments a,
		.widget_recent_entries a,
		.social-share button:hover {
			color: %1$s
		}

		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.page-links a {
			background-color: %1$s;
		}

		/* Border Color */
		fieldset,
		pre,
		abbr,
		acronym,
		table,
		th,
		td,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		textarea,
		.main-navigation li,
		.main-navigation .primary-menu,
		.menu-toggle,
		.dropdown-toggle:after,
		.social-navigation a,
		.image-navigation,
		.comment-navigation,
		.tagcloud a,
		.entry-content,
		.entry-summary,
		.page-links a,
		.page-links > span,
		.comment-list article,
		.comment-list .pingback,
		.comment-list .trackback,
		.comment-reply-link,
		.no-comments,
		.widecolumn .mu_register .mu_alert,
		blockquote,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.post-navigation,
		.post-navigation div + div,
		.pagination,
		.widget,
		.page-header,
		.page-links a,
		.comments-title,
		.comment-reply-title,
		.author-info,
		.site-header,
		.site-footer,
		.widget-title > span,
		.widget_archive li,
		.widget_categories li,
		.widget_links li,
		.widget_meta li,
		.widget_nav_menu li,
		.widget_pages li,
		.widget_recent_comments li,
		.widget_recent_entries li,
		.widget-twitter .tweet,
		.widget-recent-posts ul li {
			border-color: %1$s; /* Fallback for IE7 and IE8 */
			border-color: %2$s;
		}

		hr,
		code,
		.widget-title:before,
		.widget-title:after,
		.hentry .entry-title:after {
			background-color: %1$s; /* Fallback for IE7 and IE8 */
			background-color: %2$s;
		}

		.site-main > article {
			border-color: %3$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul,
			.main-navigation ul ul li {
				border-color: %2$s;
			}

			.main-navigation ul ul:before {
				border-top-color: %2$s;
				border-bottom-color: %2$s;
			}

			.site-content::before {
				background-color: %3$s;
			}
		}
	';

	wp_add_inline_style( 'almia-style', sprintf( $css, $main_text_color, $border_color, $sidebar_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'almia_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Almia 1.0
 *
 * @see wp_add_inline_style()
 */
function almia_secondary_text_color_css() {
	$color_scheme    = almia_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = esc_attr( get_theme_mod( 'secondary_text_color', $default_color ) );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */

		/**
		 * IE8 and earlier will drop any block with CSS3 selectors.
		 * Do not combine these styles with the next block.
		 */
		body:not(.search-results) .entry-summary {
			color: %1$s;
		}

		blockquote,
		.post-password-form label,
		a:hover,
		a:focus,
		a:active,
		.post-navigation .meta-nav,
		.image-navigation,
		.comment-navigation,
		.widget_recent_entries .post-date,
		.widget_rss .rss-date,
		.widget_rss cite,
		.site-description,
		.author-bio,
		.entry-meta,
		.entry-meta a,
		.sticky-post,
		.taxonomy-description,
		.entry-caption,
		.comment-metadata,
		.pingback .edit-link,
		.comment-metadata a,
		.pingback .comment-edit-link,
		.comment-form label,
		.comment-notes,
		.comment-awaiting-moderation,
		.logged-in-as,
		.form-allowed-tags,
		.site-info,
		.site-info a,
		.wp-caption .wp-caption-text,
		.gallery-caption,
		.widecolumn label,
		.widecolumn .mu_register label,
		.social-share button {
			color: %1$s;
		}

		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'almia-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'almia_secondary_text_color_css', 11 );
