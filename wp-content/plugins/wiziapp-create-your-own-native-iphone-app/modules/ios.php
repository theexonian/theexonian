<?php
	require_once(dirname(dirname(__FILE__)).'/includes/hook.php');

	class WiziappPluginModuleIOS
	{
		function init()
		{
			$hook = new WiziappPluginPurchaseHook();
			
                        $hook->hook('build_ios', '/build/ios', array(&$this, '_licensed'), array(&$this, '_analytics'));
                        $hook->hookExpiration(array(&$this, '_expiration'));
                        wiziapp_plugin_module_switcher()->hookGetTheme(array($this, 'getTheme'));
                        
			add_action('load-admin.php', array(&$this, 'load'));
                        if ($GLOBALS['pagenow'] != 'admin.php' || isset($_GET['page']) || !isset($_GET['wiziapp_plugin']) || $_GET['wiziapp_plugin'] !== 'install_ios')
			{
				return;
			}
			add_filter('wp_admin_bar_class', array(&$this, '_wp_admin_bar_class'));
		}
                function getTheme()
		{
			if (!wiziapp_plugin_settings()->getIosActive())
			{
                            if (!isset($_SERVER['HTTP_USER_AGENT']) || ($_SERVER['HTTP_USER_AGENT'] !== '72dcc186a8d3d7b3d8554a14256389a4' && stripos($_SERVER['HTTP_USER_AGENT'], 'wiziapp_user_agent=iphone_app') === false)){
                                
                            }
                            else {
                                define('wpsxp_PLUGINS_URL', '1');
                             }
				return false;
			}
			if (!isset($_SERVER['HTTP_USER_AGENT']) || ($_SERVER['HTTP_USER_AGENT'] !== '72dcc186a8d3d7b3d8554a14256389a4' && stripos($_SERVER['HTTP_USER_AGENT'], 'wiziapp_user_agent=iphone_app') === false))
			{
				if (wiziapp_plugin_settings()->getIOSIntroScreen() && wiziapp_plugin_settings()->getIOSAppStoreUrl() !== "" && startsWith(wiziapp_plugin_settings()->getIOSAppStoreUrl(), 'https://itunes.apple.com'))
				{
					add_action('wp_head', array(&$this, 'wp_head'));
				}
				return false;
			}
                        define('wpsxp_PLUGINS_URL', '1'); 
			return array('theme' => wiziapp_plugin_settings()->getIosTheme(), 'menu' => wiziapp_plugin_settings()->getIosMenu(), 'extras' => array('no_ads' => true));
		}
                function _expiration($expiration)
		{
                    if (is_array($expiration) && isset($expiration['Token']))
                    {
			wiziapp_plugin_settings()->setIosBuildToken($expiration['Token']);
                    }
                    else {
                        wiziapp_plugin_settings()->setIosBuildToken('');
                    }
			wiziapp_plugin_settings()->setIOSExpiration($expiration['expiration']);
			return $expiration;
		}
		function load()
		{
			if (!isset($_GET['wiziapp_plugin']) || $_GET['wiziapp_plugin'] !== 'install_ios')
			{
				return;
			}

			require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // Need for plugins_api
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // Need for upgrade classes

			$api = plugins_api('plugin_information', array('slug' => 'wiziapp-ios-app', 'fields' => array('sections' => false)));
			if (is_wp_error($api))
			{
				return;
			}

			wp_register_style('wiziapp-plugin-admin', wiziapp_plugin_hook()->plugins_url('/styles/admin.css'), array());

			wp_enqueue_style('wiziapp-plugin-admin');
			wp_enqueue_style( 'colors' );
			wp_enqueue_style( 'ie' );
			wp_enqueue_script('utils');

			header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
			wp_ob_end_flush_all();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
		<title><?php _e('Installing WiziApp iOS plugin', 'wiziapp-plugin'); ?></title>
<?php
			do_action('admin_enqueue_scripts');
			do_action('admin_print_styles');
			do_action('admin_print_scripts');
			do_action('admin_head');
?>
	</head>
	<body>
		<div id="wpwrap">
			<div id="wpbody">
<?php

			$nonce = 'install-plugin_wiziapp-ios-app';
			$siteurl = trailingslashit(get_bloginfo('wpurl'));
			$upgrader = new Plugin_Upgrader($skin = new Plugin_Installer_Skin(array('type' => 'web', 'title' => __('Installing WiziApp iOS plugin', 'wiziapp-plugin'), 'url' => $siteurl.'wp-admin/admin.php?wiziapp_plugin=install_ios', 'nonce' => $nonce, 'plugin' => array('name' => 'WiziApp iOS', 'slug' => 'wiziapp-ios-app', 'source' => $api->download_link), 'api' => $api)));

			$upgrader->init();
			$upgrader->install_strings();

			add_filter('upgrader_source_selection', array($upgrader, 'check_package') );

			$upgrader->run( array(
				'package' => $api->download_link,
				'destination' => WP_PLUGIN_DIR,
				'clear_destination' => true,
				'clear_working' => true,
				'hook_extra' => array(
					'type' => 'plugin',
					'action' => 'install',
				)
			) );

			remove_filter('upgrader_source_selection', array($upgrader, 'check_package') );

			if ( $upgrader->result && !is_wp_error($upgrader->result) )
			{
				// Force refresh of plugin update information
				wp_clean_plugins_cache(true);
			}
			wp_cache_flush();
?>
			</div>
		</div>
	</body>
</html>
<?php
		}

		function _wp_admin_bar_class()
		{
			return '';
		}

		function _licensed($params, $license)
		{
?>
					<script type="text/javascript">
						if (window.parent && window.parent.jQuery) {
							window.parent.jQuery("#wiziapp-plugin-admin-settings-box-ios-body-buy").removeClass("wiziapp-plugin-admin-settings-box-body-active");
<?php
			if ($license !== false)
			{
?>
							window.parent.jQuery("#wiziapp-plugin-admin-settings-box-ios-body-available .wiziapp-plugin-admin-state-available-license").append(window.parent.document.createTextNode(<?php echo json_encode($license); ?>));
<?php
			}
?>
							window.parent.jQuery("#wiziapp-plugin-admin-settings-box-ios-body-available").addClass("wiziapp-plugin-admin-settings-box-body-active");
						}
						if (window.parent && window.parent.tb_remove) {
							window.parent.tb_remove();
						}
					</script>
<?php
		}

		function _analytics()
		{
			return '/ios/purchased';
		}
        function wp_head()
		{
			$published = FALSE;

			echo '<script type="text/javascript">'.PHP_EOL;
			// Outputs minified intro screen JavaScript - Do not alter
			echo '(function(){';
				echo 'var d=document,w=window,o=!1,t,x,y,z;';
                                
				// Browser detect
				echo 'if(!/iphone/.test(navigator.userAgent.toLowerCase()) || /(;|^)\\s*wiziapp_iphone_seen\\s*\\=\\s*true\\s*(;|$)/.test(d.cookie)){';
                                    
                                    echo 'return;';
                                 echo '}';
								 
				echo "jQuery('html').css('margin-top', '50px');";
				echo 'd.cookie="wiziapp_iphone_seen=true";';

				// OnReady detect
				echo 'if(d.readyState==="complete")';
					echo 'r();';
				echo 'else if(d.addEventListener){';
					echo 'd.addEventListener("DOMContentLoaded",r,o);';

					// Safety fallback: onLoad
					echo 'w.addEventListener("load",r,o);';
				echo '}';
				echo 'else{';
					echo 'd.attachEvent("onreadystatechange",r);';

					// Safety fallback: onLoad
					echo 'w.attachEvent("onload",r);';

					// Repeatedly test doScroll
					echo 'try{';
						echo 't=w.frameElement;';
						echo 'if(!t)t=d.documentElement;';
						echo 'if(t.doScroll)';
							echo '(function s(){';
								echo 'try{';
									echo 't.doScroll("left");';
									echo 'r();';
								echo '}';
								echo 'catch(e){';
									echo 'setTimeout(s,50);';
								echo '}';
							echo '})();';
					echo '}';
					echo 'catch(e){';
					echo '}';
				echo '}';

				// Ready handler
				echo 'function r(){';
					// Only activate once
					echo 'if(o)';
						echo 'return;';
					echo 'o=!0;';

					// Create our layer
					echo 'y=d.createElement("div");';//url("+'.json_encode(wiziapp_plugin_hook()->plugins_url('/images/intro/bg.png')).'+") #e9e7e9
					echo 'y.setAttribute("style", "position:fixed; background-color:#ffffff;width:100%;height:50px; line-height: 50px;z-index:9999; top:0;");';
					echo 'y.innerHTML="';//background:url("+'.json_encode(wiziapp_plugin_hook()->plugins_url('/images/intro/bg.png')).'+")
						echo '<div style=\\"position:fixed; background-color:#ffffff;width:100%;height:50px; line-height: 50px;z-index:9999; top:0;\\">';
						
                                                //X
                                                echo '<div style=\\"margin-left:10px;float:left;padding:0 5px 5px 5px\\">'.__('X', 'wiziapp-plugin').'</div>';	
                                                //Image
                                                
                                                echo '<div style=\\"background:url("+'.json_encode(wiziapp_plugin_hook()->plugins_url('/images/intro/ic_iphone.png')).'+") center center no-repeat;height:50px;width:30px;float:left;padding:0 5px 0 0\\"></div>';
//Text
                                                echo __('Get the iPhone App!', 'wiziapp-plugin');
			if ($published)
			{
								echo '<div style=\\"display:block;position:absolute;top:33px;bottom:60px;left:75px;right:40px;width:auto;height:auto;background:none;border:none;border-radius:0;padding:0;margin:0;color:#fff;font:bold 20px serif;text-decoration:none;cursor:default;float:none\\">'.__('App store', 'wiziapp-plugin').'</div>';
								echo '<a style=\\"display:block;position:absolute;top:10px;bottom:50px;left:30px;right:30px;margin:0;padding:0;width:200px;height:70px;border-radius:0;border:none;background:none;cursor:pointer\\" rel=\\"external\\" href=\\""+'.urlencode(wiziapp_plugin_settings()->getIOSAppStoreUrl()).'+"\\"></a>';
			}
			else
			{
								echo '<a style=\\"text-decoration:none;color:black;float:right;margin-top: 13px;background-color: #FF9968;padding: 5px 8px; line-height: 1; margin-right:10px;\\" rel=\\"external\\" href=\\""+'.json_encode(wiziapp_plugin_settings()->getIOSAppStoreUrl()).'+"\\">'.__('Install now', 'wiziapp-plugin').'</a>';
			}
							
						echo '</div>';
					echo '";';

					echo 'function a() {';
						// Get the close button div
						echo 'x=y.firstChild;';
						echo 'while((x.tagName||"").toLowerCase()!="div")';
							echo 'x=x.previousSibling;';
						echo 'x=x.firstChild;';
						echo 'while((x.tagName||"").toLowerCase()!="div")';
							echo 'x=x.previousSibling;';

						// Apply hide click handler
						echo 'c(x,function(){';
							echo 'y.parentNode.removeChild(y);';
							echo 'jQuery("html").css("margin-top", 0);';
						echo '});';
					echo '}';

					echo 'a();';
/*
			if (!$published)
			{
					// Get the link
					echo 'x=x.previousSibling;';
					echo 'while((x.tagName||"").toLowerCase()!="div")';
						echo 'x=x.previousSibling;';
					echo 'x=x.lastChild;';
					echo 'while((x.tagName||"").toLowerCase()!="a")';
						echo 'x=x.previousSibling;';

					// Apply download click handler
					echo 'c(x,function(){';
						echo 'setTimeout(function(){';
							echo 'y.innerHTML="';
								echo '\\x3cdiv style=\\"display:block;position:static;width:auto;height:auto;background:url("+'.json_encode(wiziapp_plugin_hook()->plugins_url('/images/intro/bg.png')).'+");border:none;border-radius:0;padding:10px;margin:0;text-align:center;color:#555;font:bold 14px sans-serif;text-decoration:none;cursor:default;float:none\\"\\x3e';
									echo '\\x3cdiv style=\\"display:block;position:relative;top:0;bottom:0;left:0;right:0;width:auto;height:100px;background:url("+'.json_encode(wiziapp_plugin_hook()->plugins_url('/images/intro/au.png')).'+") left top no-repeat;padding:0;margin:0;border-radius:0;border:none;cursor:default;float:none\\"\\x3e\\x3c/div\\x3e';
									echo '\\x3cdiv style=\\"display:block;position:relative;top:0;bottom:0;left:0;right:0;width:auto;height:60px;background:url("+'.json_encode(wiziapp_plugin_hook()->plugins_url('/images/intro/in.png')).'+") left top no-repeat;padding:0 0 0 60px;margin:10px;text-align:left;color:#000;font:bold 16px sans-serif;text-decoration:none;border-radius:0;border:none;cursor:default;float:none\\"\\x3e';
										echo __('Please pull-down your notification center to complete the installation', 'wiziapp-plugin');
									echo '\\x3c/div\\x3e';
									echo __('Continue to:', 'wiziapp-plugin');
									echo '\\x3cdiv style=\\"display:block;position:static;width:200px;height:auto;margin:10px auto 0;padding:10px 0px;background:#777;color:#fff;font:bold 14px sans-serif;border-radius:5px;text-decoration:none;border:none;cursor:pointer;float:none\\"\\x3e'.__('Mobile Site', 'wiziapp-plugin').'\\x3c/div\\x3e';
								echo '\\x3c/div\\x3e';
							echo '";';
							echo 'a();';
						echo '},1000);';
					echo '});';
			}
*/
					// Append to body
					echo 'd.body.appendChild(y);';

					// Click handler
					echo 'function c(e,l){';
						echo 'if(e.addEventListener)';
							echo 'e.addEventListener("click",l,!1);';
						echo 'else ';
							echo 'e.attachEvent("onclick",l);';
					echo '}';
				echo '}';
			echo '})();';
			echo PHP_EOL.'</script>'.PHP_EOL;
		}
	}

	$module = new WiziappPluginModuleIOS();
	$module->init();
