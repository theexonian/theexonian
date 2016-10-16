<?php

	require_once(dirname(__FILE__).'/wa-includes/class-wiziapp-theme-metro-touch-controller-admin.php');
	require_once(dirname(__FILE__).'/wa-includes/class-wiziapp-theme-metro-touch-settings.php');

	if (!is_admin() )
	{
		// They are not loaded in the admin display
		add_action('wp_enqueue_scripts', 'wiziapp_theme_metro_touch_styles_scripts');
		add_action('wp_head', 'wiziapp_theme_parent_styles', 6);
		add_filter('wiziapp_theme_menu_button_class', 'wiziapp_theme_metro_touch_hidden');
		add_action('wiziapp_theme_customized_style', 'wiziapp_theme_metro_touch_customized_style');
		add_filter('wiziapp_theme_header_title', 'wiziapp_theme_metro_touch_header_title');
	}

	add_filter('wiziapp_theme_settings_name', 'wiziapp_theme_metro_touch_settings_name');
	add_filter('wiziapp_theme_default_settings', 'wiziapp_theme_metro_touch_default_settings');
	add_filter('wiziapp_theme_special_frontpage_list', 'wiziapp_theme_metro_touch_special_frontpage_list');
	add_filter('wiziapp_theme_special_frontpage_request', 'wiziapp_theme_metro_touch_special_frontpage_request', 10, 2);
	add_filter('request', 'wiziapp_theme_metro_touch_request', 10, 2);
	add_action('wiziapp_theme_back_button', 'wiziapp_theme_metro_touch_back_button', 10, 2);
	add_filter('wiziapp_theme_post_featured', 'wiziapp_theme_metro_touch_post_featured');

	function wiziapp_theme_metro_touch_styles_scripts()
	{
		wp_register_script('wiziapp-theme-metro-touch', get_stylesheet_directory_uri() . '/scripts/metro-touch.js', array('jquery-mobile'));
		wp_enqueue_script('wiziapp-theme-metro-touch');
	}

	function wiziapp_theme_metro_touch_settings_name()
	{
		return 'wiziapp_theme_metro_touch_parent_settings';
	}

	function wiziapp_theme_metro_touch_default_settings($list)
	{
		$list['front_page'] = 'added::homescreen';
		return $list;
	}

	function wiziapp_theme_metro_touch_special_frontpage_list($list)
	{
		$list['homescreen'] = __('Homescreen', 'wiziapp-theme-metro-touch');
		return $list;
	}

	function wiziapp_theme_metro_touch_special_frontpage_request($id, $query_vars)
	{
		if ($id === 'homescreen')
		{
			return array('wiziapp_theme_metro_touch_menu' => true, 'wiziapp_theme_mainpage' => true);
		}
		return $query_vars;
	}

	function wiziapp_theme_metro_touch_request($query_vars)
	{
		if (isset($query_vars['wiziapp_display']) && $query_vars['wiziapp_display'] === 'homescreen')
		{
			return array('wiziapp_theme_metro_touch_menu' => true, 'wiziapp_theme_mainpage' => true);
		}
		return $query_vars;
	}

	function wiziapp_theme_metro_touch_hidden()
	{
		return 'wiziapp-theme-metro-touch-hidden';
	}

	function wiziapp_theme_metro_touch_items_attributes($attributes, $item)
	{
		$icon = 'link';
		if (wiziapp_theme_metro_touch_settings()->getBrickIcon($GLOBALS['wiziapp-metro-touch-menu-item']) !== false)
		{
			$icon = $GLOBALS['wiziapp-metro-touch-menu-item'];
		}
		else if ($item->type === 'post_type' && $item->object === 'wiziapp')
		{
			$post = get_post($item->object_id);
			if ($post)
			{
				$icon = $post->post_name;
			}
		}
		else if ($item->type === 'post_type')
		{
			$icon = 'page';
		}
		$GLOBALS['wiziapp-metro-touch-menu-item']++;
		$attributes['class'] = (isset($attributes['class'])?$attributes['class'].' ':'').'wiziapp-theme-metro-touch-menu-icon-'.$icon;
		$attributes['data-transition'] = 'slide';
		return $attributes;
	}

	function wiziapp_theme_metro_touch_back_button(&$wiziapp_theme_header_class, &$wiziapp_theme_back_url)
	{
		if (strpos($wiziapp_theme_header_class, 'wiziapp-header-has-back') !== false || get_query_var('wiziapp_theme_metro_touch_menu'))
		{
			return;
		}
		$wiziapp_theme_back_url = add_query_arg('wiziapp_display', 'homescreen', trailingslashit(get_bloginfo('url')));
		$wiziapp_theme_header_class .= ' wiziapp-header-has-back';
	}

	function wiziapp_theme_metro_touch_header_title($title)
	{
		if (wiziapp_theme_metro_touch_settings()->getAppHeaderType() !== 'text')
		{
			return '';
		}
		$custom_title = wiziapp_theme_metro_touch_settings()->getAppHeaderTitle();
		return empty($custom_title)?$title:$custom_title;
	}

	function wiziapp_theme_metro_touch_customized_style()
	{
		if (wiziapp_theme_metro_touch_settings()->getAppHeaderType() === 'text')
		{
			$wiziapp_header_background = wiziapp_theme_metro_touch_settings()->getAppHeaderBackground();
		}
		else if (wiziapp_theme_metro_touch_settings()->getAppHeaderType() === 'image')
		{
			$wiziapp_header_background = 'url('.esc_html(wiziapp_theme_metro_touch_settings()->getAppHeaderImage()).') no-repeat center center';
		}
?>
		<style type="text/css">
			div.wiziapp-header {
				color: <?php echo esc_html(wiziapp_theme_metro_touch_settings()->getAppHeaderColor()); ?>;
				background: <?php echo esc_html($wiziapp_header_background); ?>;
			}

			div.wiziapp-customized-background {
				background: <?php echo esc_html(wiziapp_theme_metro_touch_settings()->getAppContentBackground()); ?>;
			}

			div.wiziapp-content-post, div.wiziapp-content-page {
				color: <?php echo esc_html(wiziapp_theme_metro_touch_settings()->getAppContentColor()); ?> !important;
			}

			.wiziapp-content-list.wiziapp-content-post-list li, .wiziapp-content-list.wiziapp-content-post-list li.ui-li {
				background: <?php echo esc_html(wiziapp_theme_metro_touch_settings()->getLatestBackground()); ?>;
			}

			.wiziapp-metro-touch-menu li.ui-btn {
				background: <?php echo esc_html(wiziapp_theme_metro_touch_settings()->getBrickBackground()); ?>;
			}

			.wiziapp-metro-touch-menu-bg {
				background: <?php echo esc_html(wiziapp_theme_metro_touch_settings()->getHomescreenBackground()); ?>;
			}

			.wiziapp-content-list .ui-icon,
			.wiziapp-content-archive-list li.ui-btn,
			.wiziapp-metro-touch-menu li.ui-btn {
				background-color: <?php echo esc_html(wiziapp_theme_metro_touch_settings()->getBrickBackground()); ?>;
			}

			.wiziapp-metro-touch-menu li.ui-btn a.ui-link-inherit {
				color: <?php echo esc_html(wiziapp_theme_metro_touch_settings()->getBrickTextColor()); ?>;
			}
<?php
		for ($i = 0; $i < 9; $i++)
		{
			$icon = wiziapp_theme_metro_touch_settings()->getBrickIcon($i);
			if ($icon !== false)
			{
?>
			.wiziapp-theme-metro-touch-menu-icon-<?php echo esc_html($i); ?> {
				background-image: url(<?php echo json_encode($icon) ?>);
				background-size: contain;
			}
<?php
			}
		}
?>
		</style>
		<ins class="wiziapp-metro-touch-style-temp" style="height: 1px; top: -100px; overflow: hidden"></ins>
		<script type="text/javascript">
			(function($) {
				var ins = $("ins.wiziapp-metro-touch-style-temp");
				ins.removeClass("wiziapp-metro-touch-style-temp");
				var todo = 0;
				var style = "", prestyle = "";
				$([
					[".wiziapp-header a.wiziapp-back-button", "btn_back", 51, 51, <?php echo json_encode(wiziapp_theme_metro_touch_settings()->getBackIconColor()); ?>],
					[".wiziapp-content-archive-list li.ui-btn, .wiziapp-theme-metro-touch-menu-icon-archive_months, .wiziapp-theme-metro-touch-menu-icon-archive_years", "icon_archive", 55, 46],
					[".wiziapp-content-category-list .ui-icon, .wiziapp-theme-metro-touch-menu-icon-categories", "icon_categories", 78, 52],
					[".wiziapp-theme-metro-touch-menu-icon-latest", "icon_latest", 74, 75],
					[".wiziapp-content-bookmark-list .ui-icon, .wiziapp-theme-metro-touch-menu-icon-bookmarks, .wiziapp-theme-metro-touch-menu-icon-link", "icon_links", 47, 71],
					[".wiziapp-content-page-list .ui-icon, .wiziapp-theme-metro-touch-menu-icon-pages, .wiziapp-theme-metro-touch-menu-icon-page", "icon_pages", 61, 71],
					[".wiziapp-theme-metro-touch-menu-icon-search", "icon_search", 69, 72],
					[".wiziapp-content-tag-list .ui-icon, .wiziapp-theme-metro-touch-menu-icon-tags", "icon_tags", 72, 72]
				]).each(function() {
					var ir = this[0], img = $(<?php echo json_encode('<img src="'.esc_attr(get_stylesheet_directory_uri().'/images/')); ?>+this[1]+".png\" />"), iw = this[2], ih = this[3],
						c = $("<canvas width=\""+iw+"\" height=\""+ih+"\"></canvas>"), ctx = c.get(0).getContext("2d"), cl = this[4]?this[4]:<?php echo json_encode(wiziapp_theme_metro_touch_settings()->getBrickIconColor()); ?>;
					todo++;
					prestyle += ir+"{background-image: none;}";
					ins.append(img);
					img.bind("load", function() {
						ctx.drawImage(this, 0, 0);
						ctx.globalCompositeOperation = "source-atop";
						ctx.fillStyle = cl;
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

	function wiziapp_theme_metro_touch_post_featured()
	{
		return 'wiziapp-post-not-featured';
	}

if (isset($_GET['wiziapp_display']) && $_GET['wiziapp_display'] == 'getconfig') {
    $header = array(
		'title' => wiziapp_theme_metro_touch_settings()->getAppHeaderTitle(),
        'bgcolor' => wiziapp_theme_metro_touch_settings()->getAppHeaderBackground(),
        'image' => wiziapp_theme_metro_touch_settings()->getAppHeaderImage(),
		'titlecolor' => wiziapp_theme_metro_touch_settings()->getAppHeaderColor()
		);
        do_action('roni_wiziapp_config', 'pushNavigation' , $header);
}
