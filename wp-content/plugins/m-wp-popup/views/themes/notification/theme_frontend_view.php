<div id='<?php echo $this->id . '-auto_popup-' . $popup_id ?>' style='padding:10px;' class="g<?php echo $uniq_id ?> wpp_theme_slate mfp-hide">

	
	<h1 class='wpp_mnp_h1'><?php echo $settings['header'] ?></h1>
	<div class='wpp_mnp_p'><?php echo $content ?></div>
	
	<div style="text-align: center" class="wpp_cta"><a href="<?php echo $settings['cta_url'] ?>"><?php echo $settings['btntxt'] ?></a></div>

</div>

<script>
jQuery(function ($) {

	var id = "<?php echo esc_js( $popup_id ) ?>";

	var uniq_id = "g<?php echo esc_js( $uniq_id ) ?>";

	var options = <?php $this->echo_popup_options_in_json( $popup_id ) ?>;

	var rules = options.rules;
	
	if ( ! wpp_check_rules( rules, id ) )
		return false;

	var do_popup_function = function() {

		$.magnificPopup.open({
		  items: {
		    src: "#<?php echo $this->id . '-auto_popup-' . $popup_id ?>",
		    type: 'inline',
		  },
		  
		  closeOnBgClick: false,
		  enableEscapeKey: false,
		  callbacks: {
				open: function() {
				    $('.mfp-bg').css( 'background', options.mask_color );
				    $('.wpp_theme_slate').css( 'border-color', options.border_color );
				},
				close: function() {
			      
				    if ( rules.use_cookies )
						wpp_place_popup_close_cookie( id, rules.cookie_expiration_time );
				}
			    
			}
			
		});

	
	};

	if ( rules.exit_popup ) {

		wpp_do_exit_popup( do_popup_function );

	} else if ( rules.exit_intent_popup ) {

		wpp_do_exit_intent_popup( do_popup_function );

	} else if ( rules.when_post_end_rule ) {

		wpp_check_when_post_rule( do_popup_function );

	} else {

		setTimeout( do_popup_function, options.delay_time );
	
	}


	if ( rules.comment_autofill ) {
		
		wpp_do_comment_autofill( uniq_id, '<?php echo esc_js(COOKIEHASH) ?>' );
	
	}

});
</script>
<style>
.wpp_theme_slate {
	position: relative;
	background: #FFF;
	width: auto;
	max-width: 600px;
	margin: 20px auto;
	box-shadow: 0px 0px 2px 2px #888888;
	border: 1px solid;
	height: auto;
}

.wpp_theme_slate .wpp_mnp_h1{
	
	text-align: center;
	color: #333333;
	font-size: 2.4rem;
}

.wpp_theme_slate .wpp_mnp_p{
	
	margin-top: 25px;
	color: #333333;
	margin-left: 25px;
	font-size: 16px;
	
}
.wpp_theme_slate .wpp_cta{
	background: #FF6600;
	color: #fff;
	width: 50%;
	height: 50px;
	border: none;
	font-family: verdana;
	font-size: 2.2rem;
	margin: 0 auto;
	box-shadow: 0px 0px 2px 0px #888888;
	cursor: pointer;
}

.wpp_theme_slate .wpp_cta a {
	line-height: 1.9;
}

.wpp_theme_slate .wpp_cta a:hover {
	text-decoration: none !important;
}

.wpp_theme_slate .wpp_cta:hover {
	box-shadow: 0px 0px 2px 2px #888888;	
}

.g<?php echo $uniq_id ?> {
	background-color: <?php echo $settings['style']['box_color'] ?> !important;
}
.g<?php echo $uniq_id ?> .wpp_mnp_h1 {
	color: <?php echo $settings['style']['heading_color'] ?> !important;
	font-family: <?php echo $settings['style']['font'] ?>, sans-serif !important;
}

.g<?php echo $uniq_id ?> .wpp_mnp_p {
	font-family: <?php echo $settings['style']['font'] ?>, sans-serif !important;	
}

.g<?php echo $uniq_id ?> .wpp_cta {
	background-color: <?php echo $settings['style']['btn_color'] ?> !important;
	color: <?php echo $settings['style']['btntxt_color'] ?> !important;
	font-family: <?php echo $settings['style']['font'] ?>, sans-serif !important;
}

.g<?php echo $uniq_id ?> .wpp_cta a{
	color: <?php echo $settings['style']['btntxt_color'] ?> !important;
}
</style>