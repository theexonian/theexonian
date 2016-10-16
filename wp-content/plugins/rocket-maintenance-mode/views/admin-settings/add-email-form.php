<?php if ( get_option('mmp_on_off_subscribe') === '1' ): ?>
	<form class="mm-form <?php if ( $center ) echo 'w3-center' ?> ">
	<span>
		<input type="email" name="email" class="mm-input" placeholder='<?php esc_attr_e( get_option('mmp_mc_pt') )?>' id=""> <input type="submit" value="<?php esc_attr_e( get_option('mmp_mc_sbt') ) ?>" class="mm-btn">
	</span>
	<input type="hidden" value="<?php echo wp_create_nonce('wpmmp_email_manager_nonce') ?>" name="wpmmp_email_manager_nonce" />
	<div class="success-message"></div>
    <div class="error-message"></div>
	<br>
	<br>
	</form>
<?php endif; ?>

<script>
/*
        Subscription form
    */
jQuery(function ($) {
    $('.success-message').hide();
    $('.error-message').hide();

    ajax_url = "<?php echo admin_url( 'admin-ajax.php' ) ?>";

    $('.mm-form').submit(function() {
        var postdata = $('.mm-form').serialize();
        $.ajax({
            type: 'POST',
            url: ajax_url + '?action=wpmmp_c_soon_store_email',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                if(json.valid == 0) {
                    $('.success-message').hide();
                    $('.error-message').hide();
                    $('.error-message').html(json.message);
                    $('.error-message').fadeIn();
                }
                else {
                    $('.error-message').hide();
                    $('.success-message').hide();
                    $('.subscribe form').hide();
                    $('.success-message').html(json.message);
                    $('.success-message').fadeIn();
                }
            }
        });
        return false;
    });
});
</script>