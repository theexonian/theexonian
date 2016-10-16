<?php

	require_once(dirname(__FILE__).'/wa-includes/class-wiziapp-theme-business-touch-controller-admin.php');
	require_once(dirname(__FILE__).'/wa-includes/class-wiziapp-theme-business-touch-settings.php');

	if (!is_admin() )
	{
		// They are not loaded in the admin display
		add_action('wp_enqueue_scripts', 'wiziapp_theme_business_touch_styles_scripts');
		add_action('wp_head', 'wiziapp_theme_parent_styles', 6);
		add_action('wiziapp_theme_customized_style', 'wiziapp_theme_business_touch_customized_style');
		add_filter('wiziapp_theme_header_title', 'wiziapp_theme_business_touch_header_title');
	}

	add_filter('wiziapp_theme_settings_name', 'wiziapp_theme_business_touch_settings_name');
	add_filter('wiziapp_theme_default_settings', 'wiziapp_theme_business_touch_default_settings');
	add_filter('wiziapp_theme_special_frontpage_list', 'wiziapp_theme_business_touch_special_frontpage_list');
	add_filter('wiziapp_theme_special_frontpage_request', 'wiziapp_theme_business_touch_special_frontpage_request', 10, 2);
	add_filter('request', 'wiziapp_theme_business_touch_request', 10, 2);
	add_action('wiziapp_theme_back_button', 'wiziapp_theme_business_touch_back_button', 10, 2);
	add_filter('wiziapp_theme_menu_button_class', 'wiziapp_theme_business_touch_hidden');
	add_filter('wiziapp_theme_post_featured', 'wiziapp_theme_business_touch_post_featured');

	function wiziapp_theme_business_touch_styles_scripts()
	{
		wp_register_script('wiziapp-theme-business-touch', get_stylesheet_directory_uri() . '/scripts/business-touch.js', array('jquery-mobile'));
		wp_enqueue_script('wiziapp-theme-business-touch');
	}

	function wiziapp_theme_business_touch_settings_name()
	{
		return 'wiziapp_theme_business_touch_parent_settings';
	}

	function wiziapp_theme_business_touch_default_settings($list)
	{
		$list['front_page'] = 'added::homescreen';
		return $list;
	}

	function wiziapp_theme_business_touch_special_frontpage_list($list)
	{
		$list['homescreen'] = __('Homescreen', 'wiziapp-theme-business-touch');
		return $list;
	}

	function wiziapp_theme_business_touch_special_frontpage_request($id, $query_vars)
	{
		if ($id === 'homescreen')
		{
			return array('wiziapp_theme_business_touch_menu' => true, 'wiziapp_theme_mainpage' => true);
		}
		return $query_vars;
	}

	function wiziapp_theme_business_touch_request($query_vars)
	{
		if (isset($query_vars['wiziapp_display']) && $query_vars['wiziapp_display'] === 'homescreen')
		{
			return array('wiziapp_theme_business_touch_menu' => true, 'wiziapp_theme_mainpage' => true);
		}
		return $query_vars;
	}

	function wiziapp_theme_business_touch_back_button(&$wiziapp_theme_header_class, &$wiziapp_theme_back_url)
	{
		if (strpos($wiziapp_theme_header_class, 'wiziapp-header-has-back') !== false || get_query_var('wiziapp_theme_business_touch_menu'))
		{
			return;
		}
		$wiziapp_theme_back_url = add_query_arg('wiziapp_display', 'homescreen', trailingslashit(get_bloginfo('url')));
		$wiziapp_theme_header_class .= ' wiziapp-header-has-back';
	}

	function wiziapp_theme_business_touch_hidden()
	{
		return 'wiziapp-theme-business-touch-hidden';
	}

	function wiziapp_theme_business_touch_post_featured()
	{
		return 'wiziapp-post-not-featured';
	}

	function wiziapp_theme_business_touch_header_title($title)
	{
		if (wiziapp_theme_business_touch_settings()->getAppHeaderType() !== 'text')
		{
			return '';
		}
		$custom_title = wiziapp_theme_business_touch_settings()->getAppHeaderTitle();
		return empty($custom_title)?$title:$custom_title;
	}

	function wiziapp_theme_business_touch_customized_style()
	{
		if (wiziapp_theme_business_touch_settings()->getAppHeaderType() === 'text')
		{
			$wiziapp_header_background = wiziapp_theme_business_touch_settings()->getAppHeaderBackground();
		}
		else if (wiziapp_theme_business_touch_settings()->getAppHeaderType() === 'image')
		{
			$wiziapp_header_background = 'url('.esc_html(wiziapp_theme_business_touch_settings()->getAppHeaderImage()).') no-repeat center center';
		}
?>
		<style type="text/css">
			div.wiziapp-header {
				color: <?php echo esc_html(wiziapp_theme_business_touch_settings()->getAppHeaderColor()); ?>;
				background: <?php echo esc_html($wiziapp_header_background); ?>;
			}

			div.wiziapp-customized-background {
				background: <?php echo esc_html(wiziapp_theme_business_touch_settings()->getAppContentBackground()); ?>;
			}

			div.wiziapp-content-post, div.wiziapp-content-page, .wiziapp-business-touch-homescreen a {
				color: <?php echo esc_html(wiziapp_theme_business_touch_settings()->getAppContentColor()); ?> !important;
			}

			.wiziapp-business-touch-homescreen-gallery-overlay {
				background-color: <?php echo esc_html(wiziapp_theme_business_touch_settings()->getGalleryOverlayBackground()); ?>;
			}

			.wiziapp-business-touch-homescreen-gallery-text-overlay-text {
				color: <?php echo esc_html(wiziapp_theme_business_touch_settings()->getGalleryTextColor()); ?>;
			}

			.wiziapp-business-touch-homescreen-gallery-text-overlay-button a {
				color: <?php echo esc_html(wiziapp_theme_business_touch_settings()->getGalleryButtonTextColor()); ?> !important;
				background-color: <?php echo esc_html(wiziapp_theme_business_touch_settings()->getGalleryButtonBackground()); ?>;
			}
		</style>
		<ins class="wiziapp-business-touch-style-temp" style="height: 1px; top: -100px; overflow: hidden"></ins>
		<script type="text/javascript">
			(function($) {
				var ins = $("ins.wiziapp-business-touch-style-temp");
				ins.removeClass("wiziapp-business-touch-style-temp");
				var todo = 0;
				var style = "", prestyle = "";
				$([
					[".wiziapp-business-touch-homescreen li .ui-icon", "more", 14, 30]
				]).each(function() {
					var ir = this[0], img = $(<?php echo json_encode('<img src="'.esc_attr(get_stylesheet_directory_uri().'/images/')); ?>+this[1]+".png\" />"), iw = this[2], ih = this[3],
						c = $("<canvas width=\""+iw+"\" height=\""+ih+"\"></canvas>"), ctx = c.get(0).getContext("2d");
					todo++;
					prestyle += ir+"{background-image: none;}";
					ins.append(img);
					img.bind("load", function() {
						ctx.drawImage(this, 0, 0);
						ctx.globalCompositeOperation = "source-atop";
						ctx.fillStyle = <?php echo json_encode(wiziapp_theme_business_touch_settings()->getIconColor()); ?>;
						ctx.fillRect(0, 0, iw, ih);
						style += ir+"{background-image: url("+c.get(0).toDataURL()+");}";
						todo--;
						if (!todo)
						{
							var st = $("<style type=\"text/css\"></style>");
							st.text(style);
							ins.after(st).remove();
						}
					});
				});
				var st = $("<style type=\"text/css\"></style>");
				st.text(prestyle);
				ins.append(st);
			})(jQuery);
		</script>
<?php
	}

if (isset($_GET['wiziapp_display']) && $_GET['wiziapp_display'] == 'getconfig') {
    $header = array(
		'title' => wiziapp_theme_business_touch_settings()->getAppHeaderTitle(),
        'bgcolor' => wiziapp_theme_business_touch_settings()->getAppHeaderBackground(),
        'image' => wiziapp_theme_business_touch_settings()->getAppHeaderImage(),
		'titlecolor' => wiziapp_theme_business_touch_settings()->getAppHeaderColor()
		);
        do_action('roni_wiziapp_config', 'pushNavigation' , $header);
}