<script>
jQuery(function ($) {

	var id = "<?php echo esc_js( $popup_id ) ?>";

	var uniq_id = "<?php echo esc_js( $uniq_id ) ?>";

	var submit_url = "<?php echo wpp_email_manager_store_link() ?>";

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
		 
		  showCloseBtn: true,
		  closeBtnInside: true,
		  closeOnBgClick: false,
		  enableEscapeKey: false,
		  callbacks: {
				open: function() {
				    $('.mfp-bg').css( 'background', options.mask_color );
				    $('.wpp_default_theme').css( 'border-color', options.border_color );
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

	$('.' + uniq_id + ' input[type=submit]' ).click(function(e){
		e.preventDefault();

		wpp_handle_form_submit( id, uniq_id, submit_url, rules.cookie_expiration_time );
	});

});
</script>


<!-- This contains the hidden content for popup -->
<div style='display:none'>
	
	<div id='<?php echo $this->id . '-auto_popup-' . $popup_id ?>' style='padding:10px; background:#fff;' class="<?php echo $uniq_id ?> wpp_default_theme mfp-hide">
		
		<div class="wpp_popup_default_theme">
			
			<div class="sub_content">
				
				<h3><?php echo $settings['header'] ?></h3>
				
				<ul>
	            	<li><?php echo $settings['list_items'][0] ?></li>
	                <li><?php echo $settings['list_items'][1] ?></li>
	                <li><?php echo $settings['list_items'][2] ?></li>	
				</ul>
				
				<h4><?php echo $settings['sub_header'] ?></h4>
				
				<div class="form_cont">

					<form method="POST" action="<?php echo wpp_email_manager_store_link() ?>">

						<div class="wpp_field_cont"><input type="text" name="name" size="40" placeholder="<?php echo $settings['first_name_text'] ?>" value=""></div>
						
						<div class="wpp_field_cont"><input style="" type="text"  name="email" size="40" value="" placeholder="<?php echo $settings['enter_email_text'] ?>" required="required"></div>
						
			            <div class="wpp_field_cont"><input type="submit" class="sbutton sorange" name="submit" value="<?php echo $settings['button_txt'] ?>"></div>

						<input type="hidden" name="wpp_email_manager_nonce" value="<?php echo wpp_email_manager_nonce() ?>" />

						<input type="hidden" name="theme_id" value="<?php echo $this->id  ?>" />

						<input type="hidden" name="popup_id" value="<?php echo $popup_id  ?>" />

					</form>

				</div>

			</div>

		</div>

	</div>

</div>

<style type="text/css">

.wpp_default_theme {
  position: relative;
  background: #FFF;
  padding: 20px;
  width: auto;
  max-width: 500px;
  margin: 20px auto;
  border: 1px solid;
  box-shadow: 0px 0px 2px 2px #888888;
}

.wpp_popup_default_theme .sub_content{
	
	width:370px !important;
	
    line-height: 1.5em;
    margin:5px;
    
    margin: auto;

}

.wpp_popup_default_theme .wpp_field_cont {
	margin-bottom: 20px;
}

.wpp_popup_default_theme .sub_content h3{
	text-align:center;
	font-weight:800;
	font-size:18px;
	padding-bottom:5px;
}
.wpp_popup_default_theme .sub_content h4{
	text-align:center;
	font-weight:800;
	margin:5px;
}
.wpp_popup_default_theme .sub_content form{
	text-align:center;
}

.wpp_popup_default_theme .sub_content form input[type="text"] {
	height: 35px;
	margin: 2px;
	font-size: 14px;
}
.wpp_popup_default_theme .sub_content ul{
	font-size:13px;
	margin-top:10px;
	margin-bottom:10px;
    margin-left:20px;
    list-style-image: url('<?php echo wpp_image_url( "green-tick.png" ) ?>');
    color: black;
}
.wpp_popup_default_theme .sub_content ul li{
	color: black;
}
.sbutton {
    background: #e05d22;
	background: -webkit-linear-gradient(top, #e05d22 0%, #d94412 100%);
	background: linear-gradient(to bottom, #e05d22 0%, #d94412 100%);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e05d22', endColorstr='#d94412', GradientType=0);
	display: inline-block;
	padding: 11px 24px 10px;
	color: #fff;
	text-decoration: none;
	border: none;
	border-bottom: 3px solid #b93207;
	border-radius: 2px;
    
    
    display: block;
    margin: auto;
}
.sbutton:hover {
    text-decoration: none;
}
.sbutton:active {
    position: relative;
    top: 1px;
}

<?php if ( defined( 'WPP_PREMIUM_FUNCTIONALITY' ) ){ include 'theme_style_frontend.php'; } ?>

</style>