<?php
/**
 * Donna functions
 *
 * @package Donna
*/

function donna_customize_register($wp_customize) {

	class Donna_WP_Customize_Info_Control extends WP_Customize_Control {
		public $type = 'info';
	
		public function render_content() {
			?>
				<strong> <?php esc_html_e('If you like our work. Buy us a beer.','donna'); ?></strong>
                <div class="donate">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="T5VCDMLPPLBBS">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="<?php echo esc_attr_e('PayPal - The safer, easier way to pay online!','donna') ?>">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>
				<p class="btn">
					<a class="button button-primary" target="_blank" href="https://www.vmthemes.com/support/"><?php esc_html_e('Theme Support','donna') ?></a><br><br>
					<a class="button button-primary" target="_blank" href="https://www.vmthemes.com/preview/donna/"><?php esc_html_e('View Theme Demo','donna') ?></a><br><br>
					<a class="button button-primary" target="_blank" href="https://www.vmthemes.com/donna-wordpress-theme/"><?php  esc_html_e('Upgrade to Pro','donna') ?></a>
				</p>
        	<?php	
		}
	}
	
	class Donna_WP_Customize_Radio_Image_Control extends WP_Customize_Control {
		public $type = 'radio-image';
		
		/**
		 * Enqueue scripts/styles.
		 *
		 */
		public function enqueue() {
        	wp_enqueue_script('jquery-ui-button');
        	wp_enqueue_style('donna-customizer-style', trailingslashit( get_template_directory_uri() ) . 'css/customizer-control.css' );
    	}

		/**
		 * Render the control's content.
		 *
		 */
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			
			$name = '_customize-radio-' . $this->id; ?>
			<span class="customize-control-title">
				<?php echo esc_attr( $this->label ); ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</span>
			<div id="input_<?php echo $this->id; ?>" class="image">
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $this->id . $value; ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
						<label for="<?php echo $this->id . $value; ?>">
							<img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
						</label>
					</input>
				<?php endforeach; ?>
			</div>
			<script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
		<?php
		}
	}
	
	// Theme Global Sidebar Layout Choices
	$global_sidebar_layout = array(
			'none'  => esc_url(get_template_directory_uri() . '/images/icons/1c.png'),
			'left'	=> esc_url(get_template_directory_uri() . '/images/icons/2cl.png'),
			'right' => esc_url(get_template_directory_uri() . '/images/icons/2cr.png'),
			'two-left'  => esc_url(get_template_directory_uri() . '/images/icons/3cl.png'),
			'two-right'  => esc_url(get_template_directory_uri() . '/images/icons/3cr.png'),
			'two-sides'  => esc_url(get_template_directory_uri() . '/images/icons/3cm.png'),		
	);
	
	// Theme Sidebar Layout Choices
	$sidebar_layout = array(
			'global'  => esc_url(get_template_directory_uri() . '/images/icons/none.png'),
			'none'  => esc_url(get_template_directory_uri() . '/images/icons/1c.png'),
			'left'	=> esc_url(get_template_directory_uri() . '/images/icons/2cl.png'),
			'right' => esc_url(get_template_directory_uri() . '/images/icons/2cr.png'),
			'two-left'  => esc_url(get_template_directory_uri() . '/images/icons/3cl.png'),
			'two-right'  => esc_url(get_template_directory_uri() . '/images/icons/3cr.png'),
			'two-sides'  => esc_url(get_template_directory_uri() . '/images/icons/3cm.png'),		
	);
	
	$layout_style = array(
			'featured' => __('Featured','donna'),
			'grid' => __('Grid', 'donna'),
			'list' => __('List with the image on top','donna'),
			'list-left' => __('List with the image on the left','donna'),
			'masonry' => __('Masonry','donna'),
	);
	
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Google Fonts
	$google_fonts = array(
		__('Open Sans','donna')	=> __('Open Sans','donna'),
		__('Pacifico','donna')	=> __('Pacifico','donna'),
	);
	//  =============================
    //  = Theme Options Panel       =
    //  =============================
	$wp_customize->add_panel( 'donna_theme_options_panel', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Donna Theme Options', 'donna' ),
	));
	
	//  =============================
    //  = Theme Info Section        =
    //  =============================					
	$wp_customize->add_section( 'donna_theme_settings', array(
    	'title'          => __( 'Theme Information', 'donna' ),
    	'priority'       => 998, 
		'panel' => 'donna_theme_options_panel',
	) );
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[theme_info]', array(
    	'default'        => '',
		'sanitize_callback' => 'sanitize_text_field',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new Donna_WP_Customize_Info_Control($wp_customize, 'theme_info', array(
        'label'    => __(' ', 'donna'),
        'section'  => 'donna_theme_settings',
        'settings' => 'donna_theme_options[theme_info]',
    )));
	//  =============================
    //  = General Section           =
    //  =============================
	$wp_customize->add_section( 'donna_general_settings', array(
    	'title'          => __( 'General Settings', 'donna' ),
    	'priority'       => 999,
		'panel' => 'donna_theme_options_panel',
	) );
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[theme_color]', array(
    	'default'        => '#ff0000',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'theme_color', array(
        'label'    => __('Theme Color', 'donna'),
        'section'  => 'donna_general_settings',
        'settings' => 'donna_theme_options[theme_color]',
    )));
	//===============================
     $wp_customize->add_setting('donna_theme_options[google_font_body]', array(
		'sanitize_callback' => 'donna_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => __('Open Sans','donna'),
 
    ));

    $wp_customize->add_control( 'google_font_body', array(
        'settings' => 'donna_theme_options[google_font_body]',
        'label'   => __('Select Body Font Family','donna'),
        'section' => 'donna_general_settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[body_font_size]', array(
        'default'        => 16,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('body_font_size', array(
        'label'      => __('Body Font Size (in px)', 'donna'),
        'section'    => 'donna_general_settings',
        'settings'   => 'donna_theme_options[body_font_size]',
        'type'     => 'number',
    ));
	//===============================
	$wp_customize->add_setting('donna_theme_options[featured_img_post]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'donna_sanitize_checkbox',
        'type'       => 'option',
		'default'        => true,
    ));
 
    $wp_customize->add_control('featured_img_post', array(
        'settings' => 'donna_theme_options[featured_img_post]',
        'label'    => __('Display Featured Image Inside the Post or Page', 'donna'),
        'section'  => 'donna_general_settings',
        'type'     => 'checkbox',
    ));
    //===============================
	$wp_customize->add_setting('donna_theme_options[author_info]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'donna_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('author_info', array(
        'settings' => 'donna_theme_options[author_info]',
        'label'    => __('Display Author Bio Inside the Post', 'donna'),
        'section'  => 'donna_general_settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Layout Section            =
    //  =============================
	$wp_customize->add_section( 'donna_layout_settings', array(
    	'title'          => __( 'Layout Settings', 'donna' ),
    	'priority'       => 1000,
		'panel' => 'donna_theme_options_panel',
	) );
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[site_width]', array(
        'default'        => 1600,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('site_width', array(
        'label'      => __('Site Width (in px)', 'donna'),
        'section'    => 'donna_layout_settings',
        'settings'   => 'donna_theme_options[site_width]',
        'type'     => 'number',
    ));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[sidebar_layout]', array(
    	'default'        => 'two-sides',
		'sanitize_callback' => 'donna_sanitize_global_sidebar_layout',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );
	
	$wp_customize->add_control( new Donna_WP_Customize_Radio_Image_Control($wp_customize, 'sidebar_layout', array(
		'label'         => __( 'Global Sidebar Position', 'donna' ),
		'section'  => 'donna_layout_settings',
		'settings' => 'donna_theme_options[sidebar_layout]',
		'choices'       => $global_sidebar_layout,
		'description' => __('Other layouts will override this option if they are set.', 'donna'),
	)));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[page_sidebar_layout]', array(
    	'default'        => 'global',
		'sanitize_callback' => 'donna_sanitize_sidebar_layout',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );
	
	$wp_customize->add_control( new Donna_WP_Customize_Radio_Image_Control($wp_customize, 'page_sidebar_layout', array(
		'label'         => __( 'Page Sidebar Position', 'donna' ),
		'section'  => 'donna_layout_settings',
		'settings' => 'donna_theme_options[page_sidebar_layout]',
		'choices'       => $sidebar_layout,
		'description' => __('Default page sidebar position - it will override global settings.', 'donna'),
	)));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[single_sidebar_layout]', array(
    	'default'        => 'global',
		'sanitize_callback' => 'donna_sanitize_sidebar_layout',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );
	
	$wp_customize->add_control( new Donna_WP_Customize_Radio_Image_Control($wp_customize, 'single_sidebar_layout', array(
		'label'         => __( 'Single Post Sidebar Position', 'donna' ),
		'section'  => 'donna_layout_settings',
		'settings' => 'donna_theme_options[single_sidebar_layout]',
		'choices'       => $sidebar_layout,
		'description' => __('Single post sidebar position - it will override global settings.', 'donna'),
	)));
	//===============================    
    $wp_customize->add_setting( 'donna_theme_options[sections_padding]', array(
        'default'        => 15,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
   $wp_customize->add_control('sections_padding', array(
        'label'      => __('Padding Between Sidebars / Posts  (px)', 'donna'),
        'section'    => 'donna_layout_settings',
        'settings'   => 'donna_theme_options[sections_padding]',
        'type'     => 'number',
    ));
    //===============================
     $wp_customize->add_setting('donna_theme_options[layout_style]', array(
		'sanitize_callback' => 'donna_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'list-left',
 
    ));

    $wp_customize->add_control( 'layout_style', array(
        'settings' => 'donna_theme_options[layout_style]',
        'label'   => __('Layout Style','donna'),
        'section' => 'donna_layout_settings',
        'type'    => 'select',
        'choices'    => $layout_style,
    ));
	//===============================
	$wp_customize->add_setting('donna_theme_options[enable_image_placeholder]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'donna_sanitize_checkbox',
        'type'       => 'option',
		'default'        => true,
    ));
 
    $wp_customize->add_control('enable_image_placeholder', array(
        'settings' => 'donna_theme_options[enable_image_placeholder]',
        'label'    => __('Enable Image Placeholder', 'donna'),
        'section'  => 'donna_layout_settings',
        'type'     => 'checkbox',
        'description' => __('Applies only to Grid layout style', 'donna'),
    ));
	//  =============================
    //  = Logo Section              =
    //  =============================
	$wp_customize->add_section( 'donna_logo_settings', array(
    	'title'          => __( 'Logo Settings', 'donna' ),
    	'priority'       => 1001,
		'panel' => 'donna_theme_options_panel',
		'description' => __('To upload custom logo image - go to Appearance > Customize > Site Identity', 'donna'),
	) );
	//===============================    
    $wp_customize->add_setting( 'donna_theme_options[image_logo_width]', array(
        'default'        => 100,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
   $wp_customize->add_control('image_logo_width', array(
        'label'      => __('Image Logo Width (px)', 'donna'),
        'section'    => 'donna_logo_settings',
        'settings'   => 'donna_theme_options[image_logo_width]',
        'type'     => 'number',
    ));
    
	//===============================    
    $wp_customize->add_setting( 'donna_theme_options[text_logo_width]', array(
        'default'        => 300,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('text_logo_width', array(
        'label'      => __('Text Logo Width (px)', 'donna'),
        'section'    => 'donna_logo_settings',
        'settings'   => 'donna_theme_options[text_logo_width]',
        'type'     => 'number',
    ));
	//===============================
     $wp_customize->add_setting('donna_theme_options[google_font_logo]', array(
		'sanitize_callback' => 'donna_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => __('Pacifico','donna'),
 
    ));

    $wp_customize->add_control( 'google_font_logo', array(
        'settings' => 'donna_theme_options[google_font_logo]',
        'label'   => __('Select Logo Font Family','donna'),
        'section' => 'donna_logo_settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================    
    $wp_customize->add_setting( 'donna_theme_options[text_logo_font_size]', array(
        'default'        => 38,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('text_logo_font_size', array(
        'label'      => __('Text Logo Font Size (px)', 'donna'),
        'section'    => 'donna_logo_settings',
        'settings'   => 'donna_theme_options[text_logo_font_size]',
        'type'     => 'number',
    ));
    
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[logo_top_margin]', array(
        'default'        => 5,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_top_margin', array(
        'label'      => __('Logo Top Margin (px)', 'donna'),
        'section'    => 'donna_logo_settings',
        'settings'   => 'donna_theme_options[logo_top_margin]',
        'type'     => 'number',
    ));
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[logo_left_margin]', array(
        'default'        => 0,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_left_margin', array(
        'label'      => __('Logo Left Margin (px)', 'donna'),
        'section'    => 'donna_logo_settings',
        'settings'   => 'donna_theme_options[logo_left_margin]',
        'type'     => 'number',
    ));
    
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[logo_bottom_margin]', array(
        'default'        => 0,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_bottom_margin', array(
        'label'      => __('Logo Bottom Margin (px)', 'donna'),
        'section'    => 'donna_logo_settings',
        'settings'   => 'donna_theme_options[logo_bottom_margin]',
        'type'     => 'number',
    ));
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[logo_right_margin]', array(
        'default'        => 0,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_right_margin', array(
        'label'      => __('Logo Right Margin (px)', 'donna'),
        'section'    => 'donna_logo_settings',
        'settings'   => 'donna_theme_options[logo_right_margin]',
        'type'     => 'number',
    ));
	//===============================
	$wp_customize->add_setting('donna_theme_options[enable_logo_tagline]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'donna_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('enable_logo_tagline', array(
        'settings' => 'donna_theme_options[enable_logo_tagline]',
        'label'    => __('Display Tagline Underneath Logo', 'donna'),
        'section'  => 'donna_logo_settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Nav Menu Section          =
    //  =============================
	$wp_customize->add_section( 'donna_nav_settings', array(
    	'title'          => __( 'Nav Menu Settings', 'donna' ),
    	'priority'       => 1002,
		'panel' => 'donna_theme_options_panel',
	) );
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[nav_font_size]', array(
        'default'        => 13,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('nav_font_size', array(
        'label'      => __('Menu Font Size (px)', 'donna'),
        'section'    => 'donna_nav_settings',
        'settings'   => 'donna_theme_options[nav_font_size]',
        'type'     => 'number',
    ));
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[nav_font_weight]', array(
        'default'        => 600,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('nav_font_weight', array(
        'label'      => __('Menu Font Weight', 'donna'),
        'section'    => 'donna_nav_settings',
        'settings'   => 'donna_theme_options[nav_font_weight]',
        'type'     => 'number',
        'description' => __('Defines from thin to thick characters. 400 is the same as normal, and 700 is the same as bold.', 'donna'),
    ));
	//===============================
	$wp_customize->add_setting('donna_theme_options[menu_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'donna_sanitize_checkbox',
        'type'       => 'option',
		'default'        => true,
    ));
 
    $wp_customize->add_control('menu_uppercase', array(
        'settings' => 'donna_theme_options[menu_uppercase]',
        'label'    => __('Menu Uppercase', 'donna'),
        'section'  => 'donna_nav_settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[nav_font_color]', array(
    	'default'        => '#151515',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_font_color', array(
        'label'    => __('Menu Font Color', 'donna'),
        'section'  => 'donna_nav_settings',
        'settings' => 'donna_theme_options[nav_font_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[nav_active_color]', array(
    	'default'        => '#e7e7e7',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_active_color', array(
        'label'    => __('Selected Menu Background  Color', 'donna'),
        'section'  => 'donna_nav_settings',
        'settings' => 'donna_theme_options[nav_active_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[sub_nav_font_color]', array(
    	'default'        => '#151515',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sub_nav_font_color', array(
        'label'    => __('Drop-Down Menu Font Color', 'donna'),
        'section'  => 'donna_nav_settings',
        'settings' => 'donna_theme_options[sub_nav_font_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[sub_nav_bg_color]', array(
    	'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'sub_nav_bg_color', array(
        'label'    => __('Drop-Down Menu Background Color', 'donna'),
        'section'  => 'donna_nav_settings',
        'settings' => 'donna_theme_options[sub_nav_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[nav_top_margin]', array(
        'default'        => 5,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('nav_top_margin', array(
        'label'      => __('Menu Top Margin (px)', 'donna'),
        'section'    => 'donna_nav_settings',
        'settings'   => 'donna_theme_options[nav_top_margin]',
        'type'     => 'number',
    ));
	//  =============================
    //  = Sidebars Color Section    =
    //  =============================
	$wp_customize->add_section( 'donna_colors_settings', array(
    	'title'          => __( 'Sidebars Colors Settings', 'donna' ),
    	'priority'       => 1009,
		'panel' => 'donna_theme_options_panel',
	) );
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[primary_sidebar_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'primary_sidebar_bg_color', array(
        'label'    => __('Primary Sidebar Background Color', 'donna'),
        'section'  => 'donna_colors_settings',
        'settings' => 'donna_theme_options[primary_sidebar_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[primary_sidebar_title_color]', array(
    	'default'        => '#151515',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'primary_sidebar_title_color', array(
        'label'    => __('Primary Sidebar Title Color', 'donna'),
        'section'  => 'donna_colors_settings',
        'settings' => 'donna_theme_options[primary_sidebar_title_color]',
    )));
    //===============================
	$wp_customize->add_setting( 'donna_theme_options[primary_sidebar_text_color]', array(
    	'default'        => '#808080',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'primary_sidebar_text_color', array(
        'label'    => __('Primary Sidebar Text Color', 'donna'),
        'section'  => 'donna_colors_settings',
        'settings' => 'donna_theme_options[primary_sidebar_text_color]',
    )));
    //===============================
	$wp_customize->add_setting( 'donna_theme_options[primary_sidebar_text_hover_color]', array(
    	'default'        => '#151515',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'primary_sidebar_text_hover_color', array(
        'label'    => __('Primary Sidebar Text Hover Color', 'donna'),
        'section'  => 'donna_colors_settings',
        'settings' => 'donna_theme_options[primary_sidebar_text_hover_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[secondary_sidebar_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_sidebar_bg_color', array(
        'label'    => __('Secondary Sidebar Background Color', 'donna'),
        'section'  => 'donna_colors_settings',
        'settings' => 'donna_theme_options[secondary_sidebar_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'donna_theme_options[secondary_sidebar_title_color]', array(
    	'default'        => '#151515',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_sidebar_title_color', array(
        'label'    => __('Secondary Sidebar Title Color', 'donna'),
        'section'  => 'donna_colors_settings',
        'settings' => 'donna_theme_options[secondary_sidebar_title_color]',
    )));
    //===============================
	$wp_customize->add_setting( 'donna_theme_options[secondary_sidebar_text_color]', array(
    	'default'        => '#808080',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_sidebar_text_color', array(
        'label'    => __('Secondary Sidebar Text Color', 'donna'),
        'section'  => 'donna_colors_settings',
        'settings' => 'donna_theme_options[secondary_sidebar_text_color]',
    )));
    //===============================
	$wp_customize->add_setting( 'donna_theme_options[secondary_sidebar_text_hover_color]', array(
    	'default'        => '#151515',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_sidebar_text_hover_color', array(
        'label'    => __('Secondary Sidebar Text Hover Color', 'donna'),
        'section'  => 'donna_colors_settings',
        'settings' => 'donna_theme_options[secondary_sidebar_text_hover_color]',
    )));
	//  =============================
    //  = Image Slider Section      =
    //  =============================
	$wp_customize->add_section( 'donna_slider_settings', array(
    	'title'          => __( 'Image Slider Settings', 'donna' ),
    	'priority'       => 1006,
		'panel' => 'donna_theme_options_panel',
	) );
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[image_slider_cat]', array(
        'default'        => '',
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('image_slider_cat', array(
        'label'      => __('Image Slider Category', 'donna'),
        'section'    => 'donna_slider_settings',
        'settings'   => 'donna_theme_options[image_slider_cat]',
        'type'    => 'select',
        'choices'    => $options_categories,
    ));
	//===============================
    $wp_customize->add_setting( 'donna_theme_options[slider_num]', array(
        'default'        => 3,
		'sanitize_callback' => 'donna_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('slider_num', array(
        'label'      => __('Number of Slides', 'donna'),
        'section'    => 'donna_slider_settings',
        'settings'   => 'donna_theme_options[slider_num]',
        'type'     => 'number',
    ));
    //===============================
	$wp_customize->add_setting( 'donna_theme_options[slider_title_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'slider_title_color', array(
        'label'    => __('Title Color', 'donna'),
        'section'  => 'donna_slider_settings',
        'settings' => 'donna_theme_options[slider_title_color]',
    )));
    //===============================
	$wp_customize->add_setting( 'donna_theme_options[slider_meta_color]', array(
    	'default'        => '#aaaaaa',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'slider_meta_color', array(
        'label'    => __('Meta Color', 'donna'),
        'section'  => 'donna_slider_settings',
        'settings' => 'donna_theme_options[slider_meta_color]',
    )));
}

add_action('customize_register', 'donna_customize_register');

function donna_get_option_defaults() {
	$defaults = array(
		'theme_color' => '#ff0000',
		'google_font_body' => __('Open Sans','donna'),
		'body_font_size' => 16,
		'featured_img_post' => true,
		'author_info' => false,
		'image_logo_width' => 100,
		'text_logo_width' => 300,
		'google_font_logo' => __('Pacifico','donna'),
		'text_logo_font_size' => 38,
		'logo_top_margin' => 5,
		'logo_left_margin' => 0,
		'logo_bottom_margin' => 0,
		'logo_right_margin' => 0,
		'enable_logo_tagline' => false,
		'sidebar_layout' => 'two-sides',
		'page_sidebar_layout' => 'global',
		'single_sidebar_layout' => 'global',
		'site_width' => 1600,
		'sections_padding' => 15,
		'layout_style' => 'list-left',
		'enable_image_placeholder' => true,
		'nav_font_size' => 13,
		'nav_font_weight' => 600,
		'menu_uppercase' => true,
		'nav_font_color' => '#151515',
		'nav_active_color' => '#e7e7e7',
		'sub_nav_font_color' => '#151515',
		'sub_nav_bg_color' => '#ffffff',
		'nav_top_margin' => 5,
		'primary_sidebar_bg_color' => '#ffffff',
		'primary_sidebar_title_color' => '#151515',
		'primary_sidebar_text_color' => '#808080',
		'primary_sidebar_text_hover_color' => '#151515',
		'secondary_sidebar_bg_color' => '#ffffff',
		'secondary_sidebar_title_color' => '#151515',
		'secondary_sidebar_text_color' => '#808080',
		'secondary_sidebar_text_hover_color' => '#151515',
		'image_slider_cat' => '',
		'slider_num' => 3,
		'slider_title_color' => '#ffffff',
		'slider_meta_color' => '#aaaaaa',
	);
	return apply_filters( 'donna_get_option_defaults', $defaults );
}

function donna_get_options() {
    // Options API
    return wp_parse_args( 
        get_option( 'donna_theme_options', array() ), 
        donna_get_option_defaults() 
    );
}

/**
 * Function to setup theme custom styling
 */
function donna_theme_custom_styling() {
	$donna_theme_options = donna_get_options( 'donna_theme_options' );
	$output = '';
	
	/**
	 * Image Slider Settings
	 */	
	$slider_title_color = $donna_theme_options['slider_title_color'];
	if ( $slider_title_color )
	$output .= '.donna-slider h2.entry-title {color:' . esc_html($slider_title_color) . '; }' . "\n";
	
	$slider_meta_color = $donna_theme_options['slider_meta_color'];
	if ( $slider_meta_color )
	$output .= '.donna-slider .entry-meta a, .donna-slider .entry-meta, .donna-slider .entry-cats, .donna-slider .entry-cats a {color:' . esc_html($slider_meta_color) . '; }' . "\n";
	/**
	 * General Settings
	 */	
	$google_font_body = $donna_theme_options['google_font_body'];
	if ( $google_font_body )
	$output .= 'body {font-family:' . esc_html($google_font_body) . ';}' . "\n";
	
	$body_font_size = $donna_theme_options['body_font_size'];
	if ( $body_font_size )
	$output .= 'body {font-size:' . esc_html($body_font_size) . 'px; }' . "\n";
	
	$theme_color = $donna_theme_options['theme_color'];
	if ( $theme_color )
	$output .= '.entry-title:hover, .single-content .link-pages .previous-link a .nav-title:hover, .single-content .link-pages .next-link a .nav-title:hover {color:' . esc_html($theme_color) . '; }' . "\n";
	$output .= '::selection {background:' . esc_html($theme_color) . '; }' . "\n";
	$output .= '::-moz-selection {background:' . esc_html($theme_color) . '; }' . "\n";
	$output .= 'button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover, form.search-form .searchSubmit:hover {background:' . esc_html($theme_color) . '; }' . "\n";
	$output .= 'button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover {border-color:' . esc_html($theme_color) . '; }' . "\n";
	$output .= '.back-to-top:hover {background-color:' . esc_html($theme_color) . '; }' . "\n"; 
	/**
	 * Logo Settings
	 */	
	$image_logo_width = $donna_theme_options['image_logo_width'];
	if ( $image_logo_width )
	$output .= '#logo img {width:' . esc_html($image_logo_width) . 'px; }' . "\n";
	
	$text_logo_width = $donna_theme_options['text_logo_width'];
	if ( $text_logo_width )
	$output .= '#logo a {width:' . esc_html($text_logo_width) . 'px; }' . "\n";
	
	$google_font_logo = $donna_theme_options['google_font_logo'];
	if ( $google_font_logo )
	$output .= '#logo {font-family:' . esc_html($google_font_logo) . ';}' . "\n";
	
	$text_logo_font_size = $donna_theme_options['text_logo_font_size'];
	if ( $text_logo_font_size )
	$output .= '#logo a {font-size:' . esc_html($text_logo_font_size) . 'px; }' . "\n";
	
	$logo_top_margin = $donna_theme_options['logo_top_margin'];
	if ( $logo_top_margin )
	$output .= '#logo {margin-top:' . esc_html($logo_top_margin) . 'px; }' . "\n";
	
	$logo_left_margin = $donna_theme_options['logo_left_margin'];
	if ( $logo_left_margin )
	$output .= '#logo {margin-left:' . esc_html($logo_left_margin) . 'px; }' . "\n";
	
	$logo_bottom_margin = $donna_theme_options['logo_bottom_margin'];
	if ( $logo_bottom_margin )
	$output .= '#logo {margin-bottom:' . esc_html($logo_bottom_margin) . 'px; }' . "\n";
	
	$logo_right_margin = $donna_theme_options['logo_right_margin'];
	if ( $logo_right_margin )
	$output .= '#logo {margin-right:' . esc_html($logo_right_margin) . 'px; }' . "\n";
	
	/**
	 * Layout Settings
	 */
	$site_width = $donna_theme_options['site_width'];
	$layout_style = $donna_theme_options['layout_style'];
	if ( $site_width )
	$output .= '.container { max-width:' . esc_html($site_width) . 'px; }' . "\n";
	if ($layout_style == 'featured') {
		$output .= '.donna-slider { max-width:' . esc_html($site_width - 60) . 'px; }' . "\n";
	} else {
		$output .= '.donna-slider { max-width:' . esc_html($site_width - 30) . 'px; }' . "\n";
	}
	
	$sections_padding = $donna_theme_options['sections_padding'];
	if ( $sections_padding )
	$output .= '.col-md-4, .col-md-8 { padding-left:' . esc_html($sections_padding) . 'px; }' . "\n";
	$output .= '.col-md-4, .col-md-8 { padding-right:' . esc_html($sections_padding) . 'px; }' . "\n";
	$output .= '.row .col-md-8 article, .sidebar-area .widget  { margin-bottom:' . esc_html($sections_padding * 2) . 'px; }' . "\n";
	
	/**
	 * Nav Menu Settings
	 */
	$nav_font_size = $donna_theme_options['nav_font_size'];
	if ( $nav_font_size )
	$output .= '.navbar-nav li a { font-size:' . esc_html($nav_font_size) . 'px; }' . "\n";
	
	$nav_font_weight = $donna_theme_options['nav_font_weight'];
	if ( $nav_font_weight )
	$output .= '.navbar-default .navbar-nav > li > a { font-weight:' . esc_html($nav_font_weight) . '; }' . "\n";
	
	$menu_uppercase = $donna_theme_options['menu_uppercase'];
	if ( $menu_uppercase == true ) {
		$output .= '.navbar-nav li a { text-transform: uppercase; }' . "\n";
	}
	
	$nav_font_color = $donna_theme_options['nav_font_color'];
	if ( $nav_font_color )
	$output .= '.navbar-default .navbar-nav > li > a { color:' . esc_html($nav_font_color) . '; }' . "\n";
	
	$sub_nav_font_color = $donna_theme_options['sub_nav_font_color'];
	if ( $sub_nav_font_color )
	$output .= '.dropdown-menu li a { color:' . esc_html($sub_nav_font_color) . '; }' . "\n";
	
	$sub_nav_bg_color = $donna_theme_options['sub_nav_bg_color'];
	if ( $sub_nav_bg_color )
	$output .= '.dropdown-menu { background-color:' . esc_html($sub_nav_bg_color) . '; }' . "\n";
	
	$nav_active_color = $donna_theme_options['nav_active_color'];
	if ( $nav_active_color )
	$output .= '.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus { background-color:' . esc_html($nav_active_color) . '; }' . "\n";
	$output .= '.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus { background-color:' . esc_html($nav_active_color) . '; }' . "\n";
	$output .= '.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus { background-color:' . esc_html($nav_active_color) . '; }' . "\n";
	$output .= '.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus { background-color:' . esc_html($nav_active_color) . '; }' . "\n";
	
	$nav_top_margin = $donna_theme_options['nav_top_margin'];
	if ( $nav_top_margin )
	$output .= '.navbar-default .navbar-collapse, .navbar-default .navbar-form { margin-top:' . esc_html($nav_top_margin) . 'px; }' . "\n";
	/**
	 * Sidebar Color Settings
	 */
	$primary_sidebar_bg_color = $donna_theme_options['primary_sidebar_bg_color'];
	if ( $primary_sidebar_bg_color )
	$output .= '.sidebar-area.primary.col-md-4 .widget { background-color:' . esc_html($primary_sidebar_bg_color) . '; }' . "\n";
	
	$primary_sidebar_title_color = $donna_theme_options['primary_sidebar_title_color'];
	if ( $primary_sidebar_title_color )
	$output .= '.sidebar-area.primary.col-md-4 .widget-title h3 { color:' . esc_html($primary_sidebar_title_color) . '; }' . "\n";
	
	$primary_sidebar_text_color = $donna_theme_options['primary_sidebar_text_color'];
	if ( $primary_sidebar_text_color )
	$output .= '.sidebar-area.primary.col-md-4 .widget ul li a, .sidebar-area.primary.col-md-4 { color:' . esc_html($primary_sidebar_text_color) . '; }' . "\n";
	
	$primary_sidebar_text_hover_color = $donna_theme_options['primary_sidebar_text_hover_color'];
	if ( $primary_sidebar_text_hover_color )
	$output .= '.sidebar-area.primary.col-md-4 .widget ul li a:hover { color:' . esc_html($primary_sidebar_text_hover_color) . '; }' . "\n";
	
	$secondary_sidebar_bg_color = $donna_theme_options['secondary_sidebar_bg_color'];
	if ( $secondary_sidebar_bg_color )
	$output .= '.sidebar-area.secondary.col-md-4 .widget { background-color:' . esc_html($secondary_sidebar_bg_color) . '; }' . "\n";
	
	$secondary_sidebar_title_color = $donna_theme_options['secondary_sidebar_title_color'];
	if ( $secondary_sidebar_title_color )
	$output .= '.sidebar-area.secondary.col-md-4 .widget-title h3 { color:' . esc_html($secondary_sidebar_title_color) . '; }' . "\n";
	
	$secondary_sidebar_text_color = $donna_theme_options['secondary_sidebar_text_color'];
	if ( $secondary_sidebar_text_color )
	$output .= '.sidebar-area.secondary.col-md-4 .widget ul li a, .sidebar-area.secondary.col-md-4 { color:' . esc_html($secondary_sidebar_text_color) . '; }' . "\n";
	
	$secondary_sidebar_text_hover_color = $donna_theme_options['secondary_sidebar_text_hover_color'];
	if ( $secondary_sidebar_text_hover_color )
	$output .= '.sidebar-area.secondary.col-md-4 .widget ul li a:hover { color:' . esc_html($secondary_sidebar_text_hover_color) . '; }' . "\n";
	
	// Output styles
	if ( isset( $output ) && $output != '' ) {
		$output = strip_tags( $output );
		$output = "<!--Custom Styling-->\n<style media=\"screen\" type=\"text/css\">\n" . $output . "</style>\n";
		echo $output;
	}
}

add_action('wp_head','donna_theme_custom_styling');

/**
 * Function to sanitize input value is an integer.
 */
function donna_sanitize_number( $input ) {
	return absint( $input );
}

/**
 * Sanitization callback function
 */
function donna_sanitize_cb( $input ) {     
	return wp_kses_post( $input );
}

/**
 * Function for options that sanitize global sidebar position.
 */
function donna_sanitize_global_sidebar_layout ( $value ) {
	$recognized = donna_global_sidebar_layout();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'donna_global_sidebar_layout', current( $recognized ) );
}

function donna_global_sidebar_layout() {
	$default = array(
		'none' => 'none', 
		'left' => 'left',
		'right' => 'right', 
		'two-left' => 'two-left',
		'two-right' => 'two-right', 
		'two-sides' => 'two-sides', 
	);
	return apply_filters( 'donna_global_sidebar_layout', $default );
}

/**
 * Function for options that sanitize sidebar position.
 */
function donna_sanitize_sidebar_layout ( $value ) {
	$recognized = donna_sidebar_layout();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'donna_sidebar_layout', current( $recognized ) );
}

function donna_sidebar_layout() {
	$default = array(
		'global' => 'global',
		'none' => 'none', 
		'left' => 'left',
		'right' => 'right', 
		'two-left' => 'two-left',
		'two-right' => 'two-right', 
		'two-sides' => 'two-sides', 
	);
	return apply_filters( 'donna_sidebar_layout', $default );
}

/**
 * Sanitization for checkbox input
 *
 * @param $input string (1 or empty) checkbox state
 * @return $output '1' or false
 */
function donna_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}

/**
 * Sanitization for font style
 */
function donna_sanitize_font_style( $value ) {
	$recognized = donna_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'donna_font_style', current( $recognized ) );
}

function donna_font_styles() {
	$default = array(
		__('Open Sans','donna')	=> __('Open Sans','donna'),
		__('Pacifico','donna') => __('Pacifico','donna'),
		);
	return apply_filters( 'donna_font_styles', $default );
}
