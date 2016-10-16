<?php
	if (class_exists('WP_Customize_Image_Control'))
	{
		// Only loaded while in customize mode
		class WiziappThemeMetroTouchControllerAdminImageControl extends WP_Customize_Image_Control
		{
			public function tab_uploaded() {
				$images = get_posts( array(
					'post_type'  => 'attachment',
					'meta_key'   => '_wp_attachment_context',
					'meta_value' => $this->context,
					'orderby'    => 'none',
					'nopaging'   => true,
				) );

				?><div class="uploaded-target"></div><?php

				if ( empty( $images ) )
				{
					return;
				}

				foreach ( (array) $images as $image )
				{
					$this->print_tab_image( esc_url_raw( $image->guid ) );
				}
			}
		}
	}

	class WiziappThemeMetroTouchControllerAdminBrickIconCallback
	{
		var $wp_customize;
		var $index;

		function init($wp_customize, $index)
		{
			$this->wp_customize = $wp_customize;
			$this->index = $index;
			add_action('customize_preview_wiziapp_theme_metro_touch_settings_brick_icon_'.$this->index, array($this, 'preview'));
			add_action('customize_update_wiziapp_theme_metro_touch_settings_brick_icon_'.$this->index, array($this, 'update'));
			add_filter('customize_value_wiziapp_theme_metro_touch_settings_brick_icon_'.$this->index, array($this, 'value'));
		}

		function update($value)
		{
			wiziapp_theme_metro_touch_settings()->setBrickIcon($this->index, $value);
		}

		function preview()
		{
			$value = $this->wp_customize->get_setting('wiziapp_theme_metro_touch_settings_brick_icon_'.$this->index)->post_value();
			wiziapp_theme_metro_touch_settings()->setPreview();
			wiziapp_theme_metro_touch_settings()->setBrickIcon($this->index, $value);
		}

		function value()
		{
			return wiziapp_theme_metro_touch_settings()->getBrickIcon($this->index);
		}
	}

	class WiziappThemeMetroTouchControllerAdmin
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

			$wp_customize->add_section('wiziapp_theme_metro_touch_header_customizing', array(
				'title' => __('App Header', 'wiziapp-theme-metro-touch'),
				'priority' => 1,
				'capability' => 'edit_theme_options',
				'description' => __('Customize your App Header settings', 'wiziapp-theme-metro-touch'),
			));

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_header_type', array(
				'type' => 'wiziapp_theme_metro_touch_settings_header_type',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control('wiziapp_theme_metro_touch_settings_header_type', array(
				'label' => 'Layout',
				'section' => 'wiziapp_theme_metro_touch_header_customizing',
				'type'           => 'radio',
				'choices'        => array(
					'text'   => __('Text Header', 'wiziapp-theme-metro-touch'),
					'image'  => __('Image Header', 'wiziapp-theme-metro-touch'),
				),
			));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_header_type', 'AppHeaderType');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_header_title', array(
				'type' => 'wiziapp_theme_metro_touch_settings_header_title',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control('wiziapp_theme_metro_touch_settings_header_title', array(
				'label' => 'Title',
				'section' => 'wiziapp_theme_metro_touch_header_customizing',
			));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_header_title', 'AppHeaderTitle');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_header_image', array(
			'type' => 'wiziapp_theme_metro_touch_settings_header_image',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage',
			));
			$icon_select = new WP_Customize_Image_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_header_image', array(
			'label' => 'Choose Image (320/44 pixel)',
			'section' => 'wiziapp_theme_metro_touch_header_customizing',
                            'description' => 'The header size should be 320*44 (center any image you add in), also if you have created an image header with a light color like white or transparent, make sure the “BackGround” color on the “App Header” settings (Text Header) will provide the required contradiction. ',
			));
			$wp_customize->add_control($icon_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_header_image', 'AppHeaderImage');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_header_color', array(
				'type' => 'wiziapp_theme_metro_touch_settings_header_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$background_select = new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_header_color', array(
				'label' => 'Title Color',
				'section' => 'wiziapp_theme_metro_touch_header_customizing',
			));
			$wp_customize->add_control($background_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_header_color', 'AppHeaderColor');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_header_background', array(
				'type' => 'wiziapp_theme_metro_touch_settings_header_background',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$background_select = new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_header_background', array(
				'label' => 'Background Color',
				'section' => 'wiziapp_theme_metro_touch_header_customizing',
			));
			$wp_customize->add_control($background_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_header_background', 'AppHeaderBackground');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_back_icon_color', array(
				'type' => 'wiziapp_theme_metro_touch_settings_back_icon_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_back_icon_color', array(
				'label' => __('Back Icon Color', 'wiziapp-theme-metro-touch'),
				'section' => 'wiziapp_theme_metro_touch_header_customizing',
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_back_icon_color', 'BackIconColor');
		}

		function add_color_section($wp_customize)
		{
			$wp_customize->add_section('wiziapp_theme_metro_touch_color_customizing', array(
				'title' => __('Main Colors', 'wiziapp-theme-metro-touch'),
				'priority' => 2,
				'capability' => 'edit_theme_options',
				'description' => __('Customize the Latest, posts, pages and categories screens colors', 'wiziapp-theme-metro-touch'),
			));

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_content_color', array(
				'type' => 'wiziapp_theme_metro_touch_settings_content_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			add_action('customize_render_control_' . 'wiziapp_theme_metro_touch_settings_content_color', array($this, 'show_edit_css_link'));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_content_color', array(
				'label' => __('Text Color', 'wiziapp-theme-metro-touch'),
				'section' => 'wiziapp_theme_metro_touch_color_customizing',
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_content_color', 'AppContentColor');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_background_color', array(
				'type' => 'wiziapp_theme_metro_touch_settings_background_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$background_select = new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_background_color', array(
				'label' => 'Background Color',
				'section' => 'wiziapp_theme_metro_touch_color_customizing',
			));
			$wp_customize->add_control($background_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_background_color', 'AppContentBackground');
		}

		function add_homescreen_section($wp_customize)
		{
			$order = 10;

			$wp_customize->add_section('wiziapp_theme_metro_touch_homescreen', array(
				'title' => __('Home Screen Settings', 'wiziapp-theme-metro-touch'),
				'priority' => 3,
				'capability' => 'edit_theme_options',
				'description' => __('Customize your Homescreen colors', 'wiziapp-theme-metro-touch'),
			));

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_homescreen_background', array(
				'type' => 'wiziapp_theme_metro_touch_settings_homescreen_background',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_homescreen_background', array(
				'label' => __('Screen Background Color', 'wiziapp-theme-metro-touch'),
				'section' => 'wiziapp_theme_metro_touch_homescreen',
				'priority' => $order++,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_homescreen_background', 'HomescreenBackground');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_brick_background', array(
				'type' => 'wiziapp_theme_metro_touch_settings_brick_background',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_brick_background', array(
				'label' => __('Tiles Background Color ', 'wiziapp-theme-metro-touch'),
				'section' => 'wiziapp_theme_metro_touch_homescreen',
				'priority' => $order++,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_brick_background', 'BrickBackground');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_brick_text_color', array(
				'type' => 'wiziapp_theme_metro_touch_settings_brick_text_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_brick_text_color', array(
				'label' => __('Tiles Title Color', 'wiziapp-theme-metro-touch'),
				'section' => 'wiziapp_theme_metro_touch_homescreen',
				'priority' => $order++,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_brick_text_color', 'BrickTextColor');

			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_brick_icon_color', array(
				'type' => 'wiziapp_theme_metro_touch_settings_brick_icon_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_brick_icon_color', array(
				'label' => __('Tiles Icon Color', 'wiziapp-theme-metro-touch'),
				'section' => 'wiziapp_theme_metro_touch_homescreen',
				'priority' => $order++,
			)));
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_brick_icon_color', 'BrickIconColor');

			$wp_customize->add_section('wiziapp_theme_metro_touch_homescreen_icons', array(
				'title' => __('Custom Tile Icons', 'wiziapp-theme-metro-touch'),
				'priority' => 4,
				'capability' => 'edit_theme_options',
				'description' => __('Upload transparent png files', 'wiziapp-theme-metro-touch'),
			));

			for ($i = 0; $i < 9; $i++)
			{
				$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_brick_icon_'.$i, array(
					'type' => 'wiziapp_theme_metro_touch_settings_brick_icon_'.$i,
					'capability' => 'edit_theme_options',
					'transport' => 'postMessage',
				));
				$wp_customize->add_control(new WiziappThemeMetroTouchControllerAdminImageControl($wp_customize, 'wiziapp_theme_metro_touch_settings_brick_icon_'.$i, array(
					'label' => 'Custom Tile Icon '.($i+1),
					'section' => 'wiziapp_theme_metro_touch_homescreen_icons',
					'context' => 'wiziapp_theme_metro_touch_settings_brick_icon',
					'priority' => $order++,
				)));
				$callback = new WiziappThemeMetroTouchControllerAdminBrickIconCallback();
				$callback->init($wp_customize, $i);
			}
		}

		function modify_latest_section($wp_customize)
		{
			$wp_customize->add_setting('wiziapp_theme_metro_touch_settings_latest_background_color', array(
				'type' => 'wiziapp_theme_metro_touch_settings_latest_background_color',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$background_select = new WP_Customize_Color_Control($wp_customize, 'wiziapp_theme_metro_touch_settings_latest_background_color', array(
				'label' => 'Post Summery Background color',
				'section' => 'wiziapp_post_list_meta',
			));
			$wp_customize->add_control($background_select);
			$callback = new WiziappThemeControllerAdminSettingCallback();
			$callback->init($wp_customize, wiziapp_theme_metro_touch_settings(), 'wiziapp_theme_metro_touch_settings_latest_background_color', 'LatestBackground');

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
			wiziapp_theme_metro_touch_settings()->deleteAll();
		}
	}

	$wiziapp_theme_metro_touch_admin = new WiziappThemeMetroTouchControllerAdmin();
	add_action('customize_register', array($wiziapp_theme_metro_touch_admin, 'register'), 12);
	add_action('switch_theme', array($wiziapp_theme_metro_touch_admin, 'theme_deactivation'));
