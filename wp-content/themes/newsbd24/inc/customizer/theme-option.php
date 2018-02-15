<?php 

/**
 * Theme Options Panel.
 *
 * @package newsbd24
 */

$default = newsbd24_get_default_theme_options();





// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'newsbd24' ),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
	)
);

// Global Section Start.*/

$wp_customize->add_section( 'social_option_section_settings',
	array(
		'title'      => esc_html__( 'Social Profile Options', 'newsbd24' ),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Social Profile*/
		$wp_customize->add_setting( 'social_profile',
			array(
				'default'           => $default['social_profile'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'newsbd24_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'social_profile',
			array(
				'label'    => esc_html__( 'Global Social Profile ( Top Right )', 'newsbd24' ),
				'section'  => 'social_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		/*
		Social media
		*/
		$sornacommerce_options['social']['fa-facebook']= array(
			'label' => esc_html__('Facebook URL', 'newsbd24')
		);
		$sornacommerce_options['social']['fa-twitter']= array(
			'label' => esc_html__('Twitter URL', 'newsbd24')
		);
		$sornacommerce_options['social']['fa-linkedin']= array(
			'label' => esc_html__('Linkedin URL', 'newsbd24')
		);
		$sornacommerce_options['social']['fa-google-plus']= array(
			'label' => esc_html__('Google-plus URL', 'newsbd24')
		);
		$sornacommerce_options['social']['fa-pinterest']= array(
			'label' => esc_html__('pinterest URL', 'newsbd24')
		);
		$sornacommerce_options['social']['fa-youtube']= array(
			'label' => esc_html__('Youtube URL', 'newsbd24')
		);
		$sornacommerce_options['social']['fa-instagram']= array(
			'label' => esc_html__('Instagram URL', 'newsbd24')
		);
		$sornacommerce_options['social']['fa-reddit']= array(
			'label' => esc_html__('Reddit URL', 'newsbd24')
		);
		foreach( $sornacommerce_options as $key => $options ):
			foreach( $options as $k => $val ):
				// SETTINGS
				if ( isset( $key ) && isset( $k ) ){
					$wp_customize->add_setting('newsbd24_social_profile_link['.$key .']['. $k .']',
						array(
							'default'           => $default['social_profile_link'],
							'capability'     => 'edit_theme_options',
							'sanitize_callback' => 'esc_url_raw'
						)
					);
					// CONTROLS
					$wp_customize->add_control('newsbd24_social_profile_link['.$key .']['. $k .']', 
						array(
							'label' => $val['label'], 
							'section'    => 'social_option_section_settings',
							'type'     => 'text',
							
						)
					);
				}
			
			endforeach;
		endforeach;


/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'newsbd24' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Posts Layout*/
		$wp_customize->add_setting( 'blog_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'newsbd24_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_layout',
			array(
				'label'    => esc_html__( 'Blog Layout Options', 'newsbd24' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'newsbd24' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'newsbd24' ),
					'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'newsbd24' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'newsbd24' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);
		
		
		/*content excerpt in global*/
		$wp_customize->add_setting( 'excerpt_length_blog',
			array(
				'default'           => $default['excerpt_length_blog'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'newsbd24_sanitize_positive_integer',
			)
		);
		$wp_customize->add_control( 'excerpt_length_blog',
			array(
				'label'    => esc_html__( 'Set Blog Excerpt Length', 'newsbd24' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'number',
				'priority' => 175,
				'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),
		
			)
		);
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'newsbd24_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Blog Looop Content', 'newsbd24' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt-only' => __( 'Excerpt Only', 'newsbd24' ),
					'full-post' => __( 'Full Post', 'newsbd24' ),
					),
				'type'     => 'select',
				'priority' => 180,
			)
		);
		
		
		
		
		// Setting pagination_type.
		$wp_customize->add_setting( 'pagination_type',
			array(
			'default'           => $default['pagination_type'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'newsbd24_sanitize_select',
			)
		);
		$wp_customize->add_control( 'pagination_type',
			array(
			'label'       => __( 'Pagination Type', 'newsbd24' ),
			'section'     => 'theme_option_section_settings',
			'type'        => 'select',
			'choices'               => array(
				'default' => __( 'Default (Older / Newer Post)', 'newsbd24' ),
				'numeric' => __( 'Numeric', 'newsbd24' ),
				),
			'priority'    => 190,
			)
		);

/*Posts management section start */
$wp_customize->add_section( 'page_option_section_settings',
	array(
		'title'      => esc_html__( 'Page Management', 'newsbd24' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	
		/*Home Page Layout*/
		$wp_customize->add_setting( 'page_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'newsbd24_sanitize_select',
			)
		);
		$wp_customize->add_control( 'page_layout',
			array(
				'label'    => esc_html__( 'Page Layout Options', 'newsbd24' ),
				'section'  => 'page_option_section_settings',
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'newsbd24' ),
				'choices'   => array(
					'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'newsbd24' ),
					'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'newsbd24' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'newsbd24' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);


// Footer Section.
$wp_customize->add_section( 'footer_section',
	array(
	'title'      => esc_html__( 'Footer Options', 'newsbd24' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'newsbd24' ),
	'section'  => 'footer_section',
	'type'     => 'text',
	'priority' => 120,
	)
);



// Slider Main Section.
$wp_customize->add_section( 'news_ticker_section',
	array(
		'title'      => esc_html__( 'News ticker', 'newsbd24' ),
		'priority'   => 95,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	// Setting - show_slider_section.
	$wp_customize->add_setting( 'show_news_ticker_section_settings',
		array(
			'default'           => $default['show_news_ticker_section_settings'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'newsbd24_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'show_news_ticker_section_settings',
		array(
			'label'    => esc_html__( 'Enable News ticker', 'newsbd24' ),
			'section'  => 'news_ticker_section',
			'type'     => 'checkbox',
			'priority' => 100,
		)
	);
	// Setting news_ticker_number.
	$wp_customize->add_setting( 'news_ticker_title',
		array(
		'default'           => $default['news_ticker_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'news_ticker_title',
		array(
		'label'    => esc_html__( 'Title', 'newsbd24' ),
		'section'  => 'news_ticker_section',
		'type'     => 'text',
		'priority' => 120,
		)
	);
	// Setting news_ticker_number.
	$wp_customize->add_setting( 'news_ticker_number',
		array(
		'default'           => $default['news_ticker_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( 'news_ticker_number',
		array(
		'label'    => esc_html__( 'news Ticker Number', 'newsbd24' ),
		'section'  => 'news_ticker_section',
		'type'     => 'number',
		'priority' => 120,
		)
	);
	// Setting - drop down category for News.
	$wp_customize->add_setting( 'select_category_for_news_ticker',
		array(
			'default'           => $default['select_category_for_news_ticker'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( new NewsBD24_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_news_ticker',
		array(
			'label'           => esc_html__( 'Category for news ticker', 'newsbd24' ),
			'description'     => esc_html__( 'Select category to be shown on news ticker ', 'newsbd24' ),
			'section'         => 'news_ticker_section',
			'type'            => 'dropdown-taxonomies',
			'taxonomy'        => 'category',
			'priority'    	  => 130,
	
		) ) );


