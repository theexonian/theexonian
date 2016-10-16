<script>
jQuery(function ($) {

	var url = "<?php echo esc_js( $href ) ?>";

	var id = "<?php echo esc_js( $popup_id ) ?>";

	var theme_id = "<?php echo esc_js( $theme_id ) ?>";

	$('a').click(function(e) {

		if ( $(this).attr('href') === url ) {
			$('.link_<?php echo $theme_id . '-' . $popup_id ?>').trigger('click');
			return false;
		}

	});

});
</script>