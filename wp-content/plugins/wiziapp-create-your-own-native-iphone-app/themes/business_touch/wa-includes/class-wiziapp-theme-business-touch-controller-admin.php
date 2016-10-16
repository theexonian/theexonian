<?php
	if (class_exists('WP_Customize_Control'))
	{
		// Only loaded while in customize mode
		class WiziappThemeBusinessTouchControllerAdminImageControl extends WP_Customize_Control
		{
			public $type = 'wiziapp-multi-image';
			public $mime_type = 'image';

			public function render_content()
			{
?>
<label for="<?php echo esc_html($this->settings['default']->id); ?>-button">
<?php
				if ( !empty($this->label) )
				{
?>
	<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
<?php
				}
				if ( !empty($this->description) ) {
?>
	<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
<?php
				}
?>
</label>
<div class="actions">
	<button type="button" class="button upload-button" id="<?php echo esc_html($this->settings['default']->id); ?>-button" data-frame-title="<?php _e( 'Select Images', 'wiziapp-theme-be-in-touch' ); ?>" data-frame-button="<?php _e( 'Choose Image' ); ?>"><?php _e( 'Select Image' ); ?></button>
	<div style="clear:both"></div>
</div>
<?php
			}

			public function enqueue() {
				wp_enqueue_media();
				wp_enqueue_style('wiziapp-theme-admin-style', get_stylesheet_directory_uri(). '/style/admin-style.css');

				parent::enqueue();
			}
		}
	}

	class WiziappThemeBusinessTouchControllerAdmin
	{
		/**
		 * To add new sections and controls to the Theme Customize screen.
		 *
		 * @see add_action('customize_register',$func)
		 * @param \WP_Customize_Manager $wp_customize
		 */
		function register($wp_customize)
		{
			$wp_customize->remove_section('title_tagline');

			$this->add_header_section($wp_customize);
			$this->add_color_section($wp_customize);
			$this->add_homescreen_section($wp_customize);

			$this->modify_latest_section($wp_customize);
		}

		function add_header_section($wp_customize)
		{
			add_action('customize_controls_enqueue_scripts', array($this, 'header_customize_js'));

			$wp_customize->add_section('wiziapp_theme_business_touch_header_customizing', array(
				'title' => __('App Header', 'wiziapp-theme-business-touch'),
				'priority' => 1,
				'capability' => 'edit_theme_options',
				'description' => __('Customize your App Header settings', 'wiziapp-theme-business-touch'),
			));

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_header_type', array(
				'type' => 'wiziapp_theme_business_touch_settings_header_type',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control('wiziapp_theme_business_touch_settings_header_type', array(
				'label' => 'Layout',
				'section' => 'wiziapp_theme_business_touch_header_customizing',
				'type'           => 'radio',
				'choices'        => array(
					'text'   => __('Text Header', 'wiziapp-theme-business-touch'),
					'image'  => __('Image Header', 'wiziapp-theme-business-touch'),
				),
			));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_header_type', 'AppHeaderType');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_header_title', array(
				'type' => 'wiziapp_theme_business_touch_settings_header_title',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control('wiziapp_theme_business_touch_settings_header_title', array(
				'label' => 'Title',
				'section' => 'wiziapp_theme_business_touch_header_customizing',
			));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_header_title', 'AppHeaderTitle');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_header_image', array(
			'type' => 'wiziapp_theme_business_touch_settings_header_image',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			));
			$icon_select = new WP_Customize_Image_Control($wp_customize, 'wiziapp_theme_business_touch_settings_header_image', array(
			'label' => 'Choose Image (320/44 pixel)',
			'section' => 'wiziapp_theme_business_touch_header_customizing',
                            'description' => 'The header size should be 320*44 (center any image you add in), also if you have created an image header with a light color like white or transparent, make sure the “BackGround” color on the “App Header” settings (Text Header) will provide the required contradiction. ',
			));
			$wp_customize->add_control($icon_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_header_image', 'AppHeaderImage');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_header_color', array(
				'type' => 'wiziapp_theme_business_touch_settings_header_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$background_select = new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_header_color', array(
				'label' => 'Title Color',
				'section' => 'wiziapp_theme_business_touch_header_customizing',
			));
			$wp_customize->add_control($background_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_header_color', 'AppHeaderColor');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_header_background', array(
				'type' => 'wiziapp_theme_business_touch_settings_header_background',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$background_select = new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_header_background', array(
				'label' => 'Background Color',
				'section' => 'wiziapp_theme_business_touch_header_customizing',
			));
			$wp_customize->add_control($background_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_header_background', 'AppHeaderBackground');
		}

		function add_color_section($wp_customize)
		{
			$wp_customize->add_section('wiziapp_theme_business_touch_color_customizing', array(
				'title' => __('Main Colors', 'wiziapp-theme-business-touch'),
				'priority' => 2,
				'capability' => 'edit_theme_options',
				'description' => __('Customize the Latest, posts, pages and categories screens colors', 'wiziapp-theme-business-touch'),
			));

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_content_color', array(
				'type' => 'wiziapp_theme_business_touch_settings_content_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			add_action('customize_render_control_' . 'wiziapp_theme_business_touch_settings_content_color', array($this, 'show_edit_css_link'));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_content_color', array(
				'label' => __('Text Color', 'wiziapp-theme-business-touch'),
				'section' => 'wiziapp_theme_business_touch_color_customizing',
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_content_color', 'AppContentColor');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_background_color', array(
				'type' => 'wiziapp_theme_business_touch_settings_background_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$background_select = new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_background_color', array(
				'label' => 'Background Color',
				'section' => 'wiziapp_theme_business_touch_color_customizing',
			));
			$wp_customize->add_control($background_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_background_color', 'AppContentBackground');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_icon_color', array(
				'type' => 'wiziapp_theme_business_touch_settings_icon_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_icon_color', array(
				'label' => __('Icons Color', 'wiziapp-theme-business-touch'),
				'section' => 'wiziapp_theme_business_touch_color_customizing',
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_icon_color', 'IconColor');
		}

		function add_homescreen_section($wp_customize)
		{
			$wp_customize->add_section('wiziapp_theme_business_touch_homescreen', array(
				'title' => __('Home Screen Settings', 'wiziapp-theme-business-touch'),
				'priority' => 2,
				'capability' => 'edit_theme_options',
				'description' => __('Customize your Homescreen'),
			));

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_text', array(
				'type' => 'wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_text',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control('wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_text', array(
				'label' => __('Overlay Text', 'wiziapp-theme-business-touch'),
				'section' => 'wiziapp_theme_business_touch_homescreen',
				'priority' => 1,
			));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_text', 'GalleryOverlayText');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_text_color', array(
				'type' => 'wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_text_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_text_color', array(
				'label' => 'Overlay Text Color',
				'section' => 'wiziapp_theme_business_touch_homescreen',
				'priority' => 2,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_text_color', 'GalleryTextColor');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_homescreen_gallery_button_text', array(
				'type' => 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_text',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control('wiziapp_theme_business_touch_settings_homescreen_gallery_button_text', array(
				'label' => __('Overlay Button Text', 'wiziapp-theme-business-touch'),
				'section' => 'wiziapp_theme_business_touch_homescreen',
				'priority' => 3,
			));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_text', 'GalleryButtonText');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_homescreen_gallery_button_background', array(
				'type' => 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_background',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_background', array(
				'label' => 'Overlay Button Color',
				'section' => 'wiziapp_theme_business_touch_homescreen',
				'priority' => 4,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_background', 'GalleryButtonBackground');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_homescreen_gallery_button_text_color', array(
				'type' => 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_text_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_text_color', array(
				'label' => 'Overlay Button Text Color',
				'section' => 'wiziapp_theme_business_touch_homescreen',
				'priority' => 5,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_text_color', 'GalleryButtonTextColor');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_homescreen_gallery_button_link', array(
				'type' => 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_link',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control('wiziapp_theme_business_touch_settings_homescreen_gallery_button_link', array(
				'label' => __('Overlay Button Link', 'wiziapp-theme-business-touch'),
				'section' => 'wiziapp_theme_business_touch_homescreen',
				'priority' => 6,
			));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_homescreen_gallery_button_link', 'GalleryButtonLink');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_background', array(
				'type' => 'wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_background',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_background', array(
				'label' => 'Background Images Color Overlay',
				'section' => 'wiziapp_theme_business_touch_homescreen',
				'priority' => 7,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_homescreen_gallery_overlay_background', 'GalleryOverlayBackground');

			$wp_customize->add_setting('wiziapp_theme_business_touch_settings_homescreen_gallery', array(
				'default' => '',
				'type' => 'wiziapp_theme_business_touch_settings_homescreen_gallery',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WiziappThemeBusinessTouchControllerAdminImageControl($wp_customize, 'wiziapp_theme_business_touch_settings_homescreen_gallery', array(
				'label' => __('Background Images (640x500)', 'wiziapp-theme-business-touch'),
				'section' => 'wiziapp_theme_business_touch_homescreen',
				'priority' => 8,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_business_touch_settings(), 'wiziapp_theme_business_touch_settings_homescreen_gallery', 'GalleryImageIds');
		}

		function modify_latest_section($wp_customize)
		{
			$wp_customize->remove_control('wiziapp_post_list_comments');
			$wp_customize->remove_control('wiziapp_post_list_featured');
			$wp_customize->remove_control('wiziapp_post_list_thumbnail_overlay');
		}

		function header_customize_js()
		{
			wp_register_script('wiziapp_advanced_theme_header_customize', get_stylesheet_directory_uri().'/scripts/header-customize.js', array('jquery',));
			wp_enqueue_script('wiziapp_advanced_theme_header_customize');
		}

		function show_edit_css_link()
		{
?>
			<li>
				<a href="<?php echo add_query_arg(array('theme' => 'metro_touch',), get_admin_url(get_current_blog_id(), 'theme-editor.php')); ?>">
					Edit CSS
				</a>
			</li>
<?php
		}

		function theme_deactivation()
		{
			wiziapp_theme_business_touch_settings()->deleteAll();
		}
	}

	$wiziapp_theme_business_touch_admin = new WiziappThemeBusinessTouchControllerAdmin();
	add_action('customize_register', array($wiziapp_theme_business_touch_admin, 'register'), 12);
	add_action('switch_theme', array($wiziapp_theme_business_touch_admin, 'theme_deactivation'));
