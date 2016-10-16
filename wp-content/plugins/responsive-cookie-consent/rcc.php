<?php
/*
* Plugin Name: Responsive Cookie Consent
* Plugin URI: http://www.jameskoussertari.co.uk
* Description: A really simple, lightweight, responsive cookie consent plugin for WordPress.
* Version: 1.5
* Author: James Koussertari
* Author URI: http://www.jameskoussertari.co.uk
* Text Domain: responsive-cookie-consent
* Domain Path: /languages/
* License: GPL2
*/

/*  Copyright 2015  James Koussertari  (email : hello@jameskoussertari.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



/*******************************
* Plugin activation
*******************************/

function rcc_plugin_install() {
	// checks version of wordpress and deactives if lower than 3.1
    if (version_compare( get_bloginfo('version'), '3.1', '<')) {
        deactivate_plugins(basename(__FILE__)); // Deactivate my plugin
		wp_die( 'Your version of WordPress must be atleast 3.1 to use this plugin.' );
    }
}
register_activation_hook(__FILE__, 'rcc_plugin_install');



function rcc_load_plugin_textdomain() {
  load_plugin_textdomain( 'responsive-cookie-consent', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'rcc_load_plugin_textdomain' );



/*******************************
* Default option values
*******************************/

function rcc_value($option) {
	$rcc_options = get_option('rcc_settings');
	$defaults = array (
		'enable' => 0,
		'front-only' => 0,
		'message' => "We use cookies to ensure that we give you the best experience on our website.",
		'accept' => 'ACCEPT',
		'more-info' => 'MORE INFO',
		'policy-url' => '/cookie-policy',
		'font' => 'Arial',
		'width' => 90,
		'max-width' => 1140,
		'padding' => 20,
		'background' => '#222222',
		'border' => '#555555',
		'border-size' => '3',
		'text-color' => '#FFFFFF',
		'button-bg' => '#07A6D0',
		'button-color' => '#FFFFFF',
	);
	echo (isset($rcc_options[$option])) ? $rcc_options[$option] : $defaults[$option];
}



/*******************************
* The cookie consent markup
*******************************/

function rccInsert() {
	
	$rcc_options = get_option('rcc_settings');
	
	function rccContent() { ?>
        <div class="rcc-panel group" style="background:<?php rcc_value('background'); ?>; border-bottom:<?php rcc_value('border-size'); ?>px solid <?php rcc_value('border'); ?>; font-family:'<?php rcc_value('font'); ?>';">
            <div class="rcc-wrapper group" style="width:<?php rcc_value('width'); ?>%; max-width:<?php rcc_value('max-width'); ?>px; padding:<?php rcc_value('padding'); ?>px 0;">
                <p style="font-family:<?php rcc_value('font'); ?>; color:<?php rcc_value('text-color'); ?>;"><?php rcc_value('message'); ?></p>
                <div class="rcc-links">
                    <a style="background:<?php rcc_value('button-bg'); ?>; color:<?php rcc_value('button-color'); ?>; font-family:'<?php rcc_value('font'); ?>';" class="rcc-accept-btn" href="#"><?php rcc_value('accept'); ?></a>
                    <a style="font-family:'<?php rcc_value('font'); ?>'; color:<?php rcc_value('button-color'); ?>;" href="<?php rcc_value('policy-url'); ?>" class="rcc-info-btn" ><?php rcc_value('more-info'); ?></a>
                </div>
            </div>
        </div>
	<?php 
	}
	
	// Enabled
	if (isset($rcc_options['enable'])) {
		// If disabled
		if ( $rcc_options['enable'] == 0 ) {
			return;
		}
	} else {
		// If not set it will fall back to the default(0) and exit here.
		return;
	}
	
	// Front page only
	if (isset($rcc_options['front-only'])) {
		// If front page only has been selected
		if ( $rcc_options['front-only'] == 1 ) {
			// Show only on front page
			if (is_front_page()) {
				echo rccContent();
			}
		}
	} else {
		// If not set it will fall back to the default(0) and display on all pages.
		echo rccContent();
	}
	
}




/*******************************
* Includes
*******************************/

include_once( plugin_dir_path( __FILE__ ) . 'includes/enqueue.php');

if ( is_admin() ) {
	include_once( plugin_dir_path( __FILE__ ) . 'includes/admin-page.php'); 
	include_once( plugin_dir_path( __FILE__ ) . 'includes/admin-menu.php'); 
	include_once( plugin_dir_path( __FILE__ ) . 'includes/register-settings.php'); 
}



/*******************************
* Actions
*******************************/
add_action('wp_footer', 'rccInsert');
?>