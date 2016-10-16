      <span>

		<span>

            <?php if ( get_option('mmp_show_fb') === '1' ): ?>
            <a href="<?php echo esc_url(get_option('mmp_fb_page')) ?>"><img class="w3-image mm-img-social" src="<?php echo wpmmp_image_url('fb.png') ?>"></a>
            <?php endif; ?>

            <?php if ( get_option('mmp_show_tw') === '1' ): ?>
            <a href="<?php echo esc_url(get_option('mmp_tw_page')) ?>"><img class="w3-image mm-img-social" src="<?php echo wpmmp_image_url('twitter.png') ?>"></a>
            <?php endif; ?>
            
            <?php if ( get_option('mmp_show_insta') === '1' ): ?>
            <a href="<?php echo esc_url(get_option('mmp_insta_page')) ?>"><img class="w3-image mm-img-social" src="<?php echo wpmmp_image_url('instagram.png') ?>"></a>
            <?php endif; ?>
           
            <?php if ( get_option('mmp_show_pin') === '1' ): ?>
            <a href="<?php echo esc_url(get_option('mmp_pin_page')) ?>"><img class="w3-image mm-img-social" src="<?php echo wpmmp_image_url('pinterest.png') ?>"></a>
            <?php endif; ?>

            <?php if ( get_option('mmp_show_lk') === '1' ): ?>
            <a href="<?php echo esc_url(get_option('mmp_lkin_page')) ?>"><img class="w3-image mm-img-social" src="<?php echo wpmmp_image_url('linkedin.png') ?>"></a>
            <?php endif; ?>

          </span>

      </span>