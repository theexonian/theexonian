<?php

	require_once(dirname(__FILE__).'/wa-includes/class-wiziapp-new-child-controller-admin.php');
	require_once(dirname(__FILE__).'/wa-includes/class-wiziapp-new-child-settings.php');

	if (!is_admin() )
	{
		// They are not loaded in the admin display
		add_action('wp_head', 'wiziapp_new_child_parent_styles', 6);
		add_action('wiziapp_theme_customized_style', 'wiziapp_new_child_customized_style');
		add_filter('wiziapp_theme_header_title', 'wiziapp_new_child_header_title');
		add_action('wp_head', 'wiziapp_new_child_check_compatibility_head', 15);
		add_action('get_header', 'wiziapp_new_child_check_compatibility_header');
		add_action('wiziapp_theme_header_app_icon', 'wiziapp_new_child_header_app_icon_print');
		add_action('wiziapp_theme_search_button', 'wiziapp_new_child_search_button_print');
		add_filter('request', 'wiziapp_new_child_request', 99);
		add_filter('wiziapp_theme_menu_button_class', 'wiziapp_new_child_menu_button_class');
		add_filter('wiziapp_theme_post_details', 'wiziapp_new_child_post_details');
		add_filter('wiziapp_theme_dark_background', 'wiziapp_new_child_dark_background');
		add_filter('wiziapp_theme_post_featured', 'wiziapp_new_child_post_featured');
	}

	function wiziapp_new_child_parent_styles()
	{
		global $wp_locale;

		// Loads parent stylesheet.
		$stylesheets = array();
		$stylesheets[] = get_template_directory_uri().'/style.css';

		// Load localized stylesheet
		$stylesheet_dir_uri = get_template_directory_uri();
		$dir = get_template_directory();
		$locale = get_locale();
		if (file_exists("$dir/$locale.css"))
		{
			$stylesheet_uri = "$stylesheet_dir_uri/$locale.css";
		}
		elseif (!empty($wp_locale->text_direction) && file_exists("$dir/{$wp_locale->text_direction}.css"))
		{
			$stylesheet_uri = "$stylesheet_dir_uri/{$wp_locale->text_direction}.css";
		}
		else
		{
			$stylesheet_uri = '';
		}
		$stylesheets[] = apply_filters('locale_stylesheet_uri', $stylesheet_uri, $stylesheet_dir_uri);
		foreach ($stylesheets as $stylesheet)
		{
			if ($stylesheet)
			{
				echo '<link rel="stylesheet" href="' . $stylesheet . '" type="text/css" media="screen" />'.PHP_EOL;
			}
		}
	}

	function wiziapp_new_child_header_title($title)
	{
		if (wiziapp_new_child_settings()->getAppHeaderType() !== 'text')
		{
			return '';
		}
		$custom_title = wiziapp_new_child_settings()->getAppHeaderTitle();
		return empty($custom_title)?$title:$custom_title;
	}

	function wiziapp_new_child_customized_style()
	{
                if (wiziapp_new_child_settings()->getAppHeaderType() === 'text')
		{
			$wiziapp_header_background = wiziapp_new_child_settings()->getAppHeaderBackground();
		}
		else if (wiziapp_new_child_settings()->getAppHeaderType() === 'image')
		{
			$wiziapp_header_background = 'url('.esc_html(wiziapp_new_child_settings()->getAppHeaderImage()).') no-repeat center center';
		}
?>
		<style type="text/css">
                        div.wiziapp-header {
				color: <?php echo esc_html(wiziapp_new_child_settings()->getAppHeaderColor()); ?>;
				background: <?php echo esc_html($wiziapp_header_background); ?>;
			}
			div.wiziapp-customized-background {
				background: <?php echo esc_html(wiziapp_new_child_settings()->getAppContentEndBackground()); ?>;
			}

			div.wiziapp-content-post, div.wiziapp-content-page {
				color: <?php echo esc_html(wiziapp_new_child_settings()->getAppContentColor()); ?>;
			}

			.wiziapp-content-list li {
				background: #eee;
				background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo esc_html(wiziapp_new_child_settings()->getAppContentStartBackground()); ?>), to(<?php echo esc_html(wiziapp_new_child_settings()->getAppContentEndBackground()); ?>));
				background-image: -webkit-linear-gradient(<?php echo esc_html(wiziapp_new_child_settings()->getAppContentStartBackground()); ?>, <?php echo esc_html(wiziapp_new_child_settings()->getAppContentEndBackground()); ?>);
				background-image:    -moz-linear-gradient(<?php echo esc_html(wiziapp_new_child_settings()->getAppContentStartBackground()); ?>, <?php echo esc_html(wiziapp_new_child_settings()->getAppContentEndBackground()); ?>);
				background-image:     -ms-linear-gradient(<?php echo esc_html(wiziapp_new_child_settings()->getAppContentStartBackground()); ?>, <?php echo esc_html(wiziapp_new_child_settings()->getAppContentEndBackground()); ?>);
				background-image:      -o-linear-gradient(<?php echo esc_html(wiziapp_new_child_settings()->getAppContentStartBackground()); ?>, <?php echo esc_html(wiziapp_new_child_settings()->getAppContentEndBackground()); ?>);
				background-image:         linear-gradient(<?php echo esc_html(wiziapp_new_child_settings()->getAppContentStartBackground()); ?>, <?php echo esc_html(wiziapp_new_child_settings()->getAppContentEndBackground()); ?>);
			}

			a.wiziapp-content-list-item {
				color: <?php echo esc_html(wiziapp_new_child_settings()->getAppContentColor()); ?> !important;
			}
		</style>
<?php
	}

	function wiziapp_new_child_request($query_vars)
	{
		$temp_query = new WP_Query();
		$temp_query->query($query_vars);
		if (!$temp_query->is_single())
		{
			return $query_vars;
		}
		$post = $temp_query->get_queried_object_id();

		$query_categories = new WiziappThemeTaxonomyQuery();
		$query_categories->query(array('post' => $post,));
		$query_vars['wiziapp_new_child_categories'] = $query_categories;

		$query_tags = new WiziappThemeTaxonomyQuery();
		$query_tags->query(array('post' => $post, 'type' => 'post_tag',));
		$query_vars['wiziapp_new_child_tags'] = $query_tags;

		return $query_vars;
	}

	function wiziapp_new_child_menu_button_class($class)
	{
		return 'ui-btn-left wiziapp_new_child_menu';
	}

	function wiziapp_new_child_post_details($post_details)
	{
		return '';
	}

	function wiziapp_new_child_dark_background($dark_background)
	{
		return 'wiziapp-white-background';
	}

	function wiziapp_new_child_post_featured($featured)
	{
		return 'wiziapp-post-not-featured';
	}

	function wiziapp_new_child_header_app_icon_print()
	{
		$style = '';
		$app_icon = wiziapp_new_child_settings()->getAppHeaderImage();
		if (empty($app_icon))
		{
			$app_icon = wiziapp_plugin_settings()->getWebappIcon();
		}
		if (!empty($app_icon))
		{
			$style = '.wiziapp-header { background: url("'.esc_html($app_icon).'") no-repeat center center; }';
		}
?>
		<div class="new-child-app-icon"></div>
		<style type="text/css">
			<?php echo $style.PHP_EOL; ?>
		</style>
<?php
	}

	function wiziapp_new_child_search_button_print($url)
	{
?>
		<a href="<?php echo $url; ?>" data-icon="search" data-iconpos="notext" data-role="button" class="ui-btn-right">Search</a>
<?php
	}

	function wiziapp_new_child_check_compatibility_head()
	{
		$support_ajax = true;
		$stylesheets = array();
		if (wiziapp_new_child_detect_woocommerce())
		{
			$stylesheets[] = get_stylesheet_directory_uri().'/woocommerce.css';
			$support_ajax = false;
		}
		if (wiziapp_new_child_detect_buddypress())
		{
			$stylesheets[] = get_stylesheet_directory_uri().'/buddypress.css';
			$support_ajax = false;
		}
		foreach ($stylesheets as $stylesheet)
		{
			echo '<link rel="stylesheet" href="' . $stylesheet . '" type="text/css" media="screen" />'.PHP_EOL;
		}
		if ($support_ajax)
		{
			return;
		}
?>
<script type="text/javascript">
	jQuery.mobile.ajaxEnabled = false;
</script>
<?php
	}

	function wiziapp_new_child_check_compatibility_header($name)
	{
		if (wiziapp_new_child_detect_woocommerce() && $name === 'shop')
		{
			if (is_archive())
			{
				wiziapp_theme_settings()->fromPageList();
			}
			else
			{
				wiziapp_theme_settings()->back_url = get_permalink((int) woocommerce_get_page_id('shop'));
			}
		}
	}

	function wiziapp_new_child_detect_woocommerce()
	{
		return function_exists('woocommerce_get_page_id');
	}

	function wiziapp_new_child_detect_buddypress()
	{
		return function_exists('buddypress');
	}
if (isset($_GET['wiziapp_display']) && $_GET['wiziapp_display'] == 'getconfig') {
    $header = array(
		'title' => wiziapp_new_child_settings()->getAppHeaderTitle(),
        'bgcolor' => wiziapp_new_child_settings()->getAppHeaderBackground(),
        'image' => wiziapp_new_child_settings()->getAppHeaderImage(),
		'titlecolor' => wiziapp_new_child_settings()->getAppHeaderColor()
		);
        do_action('roni_wiziapp_config', 'sideMenu' , $header);
}