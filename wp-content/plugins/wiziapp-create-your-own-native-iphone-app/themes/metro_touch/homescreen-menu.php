<?php
	get_header();
?>
<div class="wiziapp-metro-touch-menu-bg"></div>
<div class="wiziapp-metro-touch-menu">
<?php
	if (has_nav_menu('wiziapp_custom'))
	{
		add_filter('nav_menu_link_attributes', 'wiziapp_theme_metro_touch_items_attributes', 10, 2);
		$GLOBALS['wiziapp-metro-touch-menu-item'] = 0;
		wp_nav_menu(array(
			'theme_location' => 'wiziapp_custom',
			'container' => false,
			'items_wrap' => '<ul data-role="listview" id="%1$s" class="%2$s">%3$s</ul>',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'container' => '',
			'fallback_cb' => ''
		));
		remove_filter('nav_menu_link_attributes', 'wiziapp_theme_metro_touch_items_attributes');
	}
	else
	{
?>
	<ul data-role="listview">
<?php
		$count = wiziapp_theme_settings()->getMenuItemCount();
		for ($i = 0; $i < $count; $i++)
		{
			echo wiziapp_theme_get_menu_item($i);
		}
?>
	</ul>
<?php
	}
?>
</div>
<?php
	get_footer();
