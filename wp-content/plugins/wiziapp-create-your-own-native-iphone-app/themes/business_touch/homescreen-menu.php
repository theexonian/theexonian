<?php
	get_header();
?>
<div class="wiziapp-business-touch-homescreen">
	<div class="wiziapp-business-touch-homescreen-gallery">
		<div class="wiziapp-business-touch-homescreen-gallery-scroller">
<?php
	$i = 0;
	foreach (wiziapp_theme_business_touch_settings()->getGalleryImages() as $image_url)
	{
?>
			<div class="wiziapp-business-touch-homescreen-gallery-image" style="background-image: url(<?php echo esc_attr($image_url); ?>); left: <?php echo $i; ?>00%"></div>
<?php
		$i++;
	}
?>
		</div>
		<div class="wiziapp-business-touch-homescreen-gallery-overlay"></div>
		<div class="wiziapp-business-touch-homescreen-gallery-text-overlay">
			<div class="wiziapp-business-touch-homescreen-gallery-text-overlay-text">
				<?php echo esc_html(wiziapp_theme_business_touch_settings()->getGalleryOverlayText()); ?>
			</div>
			<div class="wiziapp-business-touch-homescreen-gallery-text-overlay-button">
				<a href="<?php echo esc_attr(wiziapp_theme_business_touch_settings()->getGalleryButtonLink()); ?>"><?php echo esc_html(wiziapp_theme_business_touch_settings()->getGalleryButtonText()); ?></a>
			</div>
		</div>
		<div class="wiziapp-business-touch-homescreen-gallery-buttons">
			<div class="wiziapp-business-touch-homescreen-gallery-button-left"></div>
			<div class="wiziapp-business-touch-homescreen-gallery-button-right"></div>
		</div>
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
</div>
<?php
	get_footer();
