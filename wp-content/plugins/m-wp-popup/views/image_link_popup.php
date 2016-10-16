<script>
jQuery(function ($) {

	var img_url = "<?php echo esc_js( $image_url ) ?>";

	var id = "<?php echo esc_js( $popup_id ) ?>";

	var theme_id = "<?php echo esc_js( $theme_id ) ?>";

	$('img').click(function(e) {

		if ( $(this).attr('src') === img_url )
			$('.link_<?php echo $theme_id . '-' . $popup_id ?>').trigger('click');

	});

});
</script>