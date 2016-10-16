<table class="form-table t1_table">
	<tbody>

		<tr>
			<th scope="row">
				<label for="t1_header"><?php _e( 'Header Text', 'wpp' ) ?></label>
			</th>
			<td>
				<input type="text" name="t1_header" value="<?php echo $settings['header'] ?>" id="t1_header" style="width: 98%" />
			</td>
		</tr>

		<tr>
			<th scope="row">
				<label for="t1_btntxt"><?php _e( 'CTA button text', 'wpp' ) ?></label>
			</th>
			<td>
				<input type="text" name="t1_btntxt" value="<?php echo $settings['btntxt'] ?>" id="t1_btntxt" style="width: 98%" />
			</td>
		</tr>

		<tr>
			<th scope="row">
				<label for="t1_cta_url"><?php _e( 'CTA link', 'wpp' ) ?></label>
			</th>
			<td>
				<input type="text" name="t1_cta_url" value="<?php echo $settings['cta_url'] ?>" id="t1_cta_url" style="width: 98%" />
			</td>
		</tr>

		<tr>
			<th scope="row">
				<label for="t1_content"><?php _e( 'Description', 'wpp' ) ?></label>
			</th>
			<td>
				<?php wp_editor( $content, 't1_content', array( 'textarea_rows' => 5 ) ); ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><a id="t1_preview" href="#t1_preview_popup"><?php _e( 'Preview', 'wpp' ) ?></a></th>
		</tr>

	</tbody>
</table>

<script>

jQuery(function ($) {

 $(document).ready(function() {
	$("#t1_preview").magnificPopup({
			  type: 'inline',
			  modal: false,
			  closeOnBgClick: false,
			  enableEscapeKey: false,
			  callbacks: {
					open: function() {
					    $('.mfp-bg').css( 'background', '#000' );
					    $('.wpp_theme_slate').css( 'border-color', '#000' );

					    $('#wpp_mnp_h1').html( $('#t1_header').val() );

					    $('#wpp_mnp_p').html( $('#t1_content').val() );

					    $('#wpp_cta').html( $('#t1_btntxt').val() );
					},
					close: function() {
				      
					}
				    
			}
				
	});

});

});

</script>

<style type="text/css">

	.t1_table {
		margin: 10px;
	}

	.t1_table th {
		width: auto !important;
	}
	

	
	#wpp_mnp_h1{
		text-align: center;
		color: #333333;
		font-size: 2.4rem;
		line-height: 1.2;
	}
	
	.wpp_mnp_p{
		margin-top: 25px;
		color: #333333;
		margin-left: 25px;
		font-size: 16px;
	}

	#wpp_cta{
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
		margin-bottom: 25px;
	}

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


</style>


<div id="t1_preview_popup" class="wpp_theme_slate mfp-hide">


	
	<h1 id='wpp_mnp_h1'></h1>
	<div id='wpp_mnp_p' class='wpp_mnp_p'></div>
	<br />
	<div style="text-align: center"><button id='wpp_cta'></button></div>
</div>



<input type="hidden" name="theme_is_1" value="yes" />