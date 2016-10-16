<?php

	/*
	* Plugin Name: Wiziapp
	* Description: Create your own free HTML5 mobile App for iPhone, Android and WP8 users. Publish your App as a native App to the App Store and Google Play Market!
	* Author: WiziApp Solutions Ltd.
	* Version: 4.1.3
	* Author URI: http://www.wiziapp.com/
	*/

        
	require_once(dirname(__FILE__).'/modules/app_config.php');
	require_once(dirname(__FILE__).'/modules/admin.php');
        
	require_once(dirname(__FILE__).'/modules/android.php');
        require_once(dirname(__FILE__).'/modules/ios.php');
	require_once(dirname(__FILE__).'/modules/ipad.php');
	require_once(dirname(__FILE__).'/modules/html5.php');
	
	require_once(dirname(__FILE__).'/modules/push.php');
	require_once(dirname(__FILE__).'/modules/theme_purchase.php');
	require_once(dirname(__FILE__).'/modules/pages.php');
	require_once(dirname(__FILE__).'/modules/monetization.php');
        require_once(dirname(__FILE__).'/modules/bundle.php');
	require_once(dirname(__FILE__).'/modules/multisite.php');
	require_once(dirname(__FILE__).'/modules/customize.php');
	require_once(dirname(__FILE__).'/modules/compatibility.php');
     
       
    /*
function detect_plugin_activation(  $plugin, $network_activation ) {
    global $current_user;
    get_currentuserinfo();
    
   
     $response = wp_remote_post('http://devadmin.wiziapp.com/ws/RegisterSite' , array(
         'body'=> array(
                'SiteUrl'=>trailingslashit(get_bloginfo('wpurl')),// get_bloginfo('wpurl'),
                'Email'=> $current_user->user_email
            )
     ));
}
       
add_action( 'activated_plugin', 'detect_plugin_activation', 10, 2 );
*/
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

