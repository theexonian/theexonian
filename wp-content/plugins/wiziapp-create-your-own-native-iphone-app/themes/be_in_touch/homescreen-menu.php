<?php
	get_header();
?>
<div class="wiziapp-be-in-touch-homescreen">
	<div class="wiziapp-be-in-touch-homescreen-gallery">
		<div class="wiziapp-be-in-touch-homescreen-gallery-scroller">
<?php
	$i = 0;
	foreach (wiziapp_theme_be_in_touch_settings()->getGalleryImages() as $image_url)
	{
?>
			<div class="wiziapp-be-in-touch-homescreen-gallery-image" style="background-image: url(<?php echo esc_attr($image_url); ?>); left: <?php echo $i; ?>00%"></div>
<?php
		$i++;
	}
?>
		</div>
		<div class="wiziapp-be-in-touch-homescreen-gallery-buttons">
			<div class="wiziapp-be-in-touch-homescreen-gallery-button-left"></div>
			<div class="wiziapp-be-in-touch-homescreen-gallery-button-right"></div>
		</div>
	</div>
	<div class="wiziapp-be-in-touch-homescreen-buttons">
		<div class="wiziapp-be-in-touch-homescreen-button-map"><a href="#wiziapp-be-in-touch-map-select" data-rel="popup"><span><?php _e('Get directions', 'wiziapp-theme-be-in-touch'); ?></span></a></div>
		<div class="wiziapp-be-in-touch-homescreen-button-call"><a href="tel:<?php echo urlencode(wiziapp_theme_be_in_touch_settings()->getPhoneNumber()); ?>"><span><?php _e('Call us', 'wiziapp-theme-be-in-touch'); ?></span></a></div>
	</div>
<?php
	if (has_nav_menu('wiziapp_custom'))
	{
		wp_nav_menu(array(
			'theme_location' => 'wiziapp_custom',
			'container' => false,
			'items_wrap' => '<ul data-role="listview" id="%1$s" class="%2$s">%3$s</ul>',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'container' => '',
			'fallback_cb' => ''
		));
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
	<div data-role="popup" id="wiziapp-be-in-touch-map-select" data-position-to="window" data-overlay-theme="a">
		<div class="wiziapp-be-in-touch-map-select-gmap"><a href="http://maps.google.com/maps?saddr=&amp;daddr=<?php echo urlencode(wiziapp_theme_be_in_touch_settings()->getAddressLatitude().','.wiziapp_theme_be_in_touch_settings()->getAddressLongitude()); ?>&amp;directionsmode=driving"><span><?php _e('Google Maps', 'wiziapp-theme-be-in-touch'); ?></span></a></div>
		<div class="wiziapp-be-in-touch-map-select-waze"><a href="waze://?ll=<?php echo urlencode(wiziapp_theme_be_in_touch_settings()->getAddressLatitude().','.wiziapp_theme_be_in_touch_settings()->getAddressLongitude()); ?>&amp;navigate=yes"><span><?php _e('Waze', 'wiziapp-theme-be-in-touch'); ?></span></a></div>
	</div>
</div>
<?php
	get_footer();
