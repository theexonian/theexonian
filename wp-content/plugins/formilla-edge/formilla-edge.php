<?php
/*
Plugin Name: Formilla Edge
Plugin URI: http://www.formillaedge.com
Description: Use Formilla Edge to grow your email marketing lists, Facebook, and Twitter following by up to 200%.  Create unlimited lightbox popups, website bars, and corner widgets.
Version: 1.0
Author: Formillaedge.com
Author URI: http://www.formillaedge.com/
*/

$plugurldir = get_option('siteurl').'/'.PLUGINDIR.'/formilla-edge/';
$formilla_edge_domain = 'FormillaEdge';
load_plugin_textdomain($formilla_edge_domain, false, 'wp-content/plugins/formilla-edge');
add_action('init', 'formilla_edge_init');
add_action('wp_footer', 'formilla_edge_script', 100);
add_action('wp_ajax_save_formilla_edge_settings', 'save_formilla_edge_settings');
add_filter('plugin_action_links', 'formilla_edge_plugin_actions', 10, 2);
add_filter('plugin_row_meta', 'formilla_edge_plugin_links', 10, 2);
register_uninstall_hook(__FILE__, 'formilla_edge_uninstall');

define('FORMILLA_EDGE_DASH', "https://www.formilla.com/dashboard.aspx");
define('FORMILLA_EDGE_REG', "https://www.formilla.com/sign-up.aspx?u=wp&source=1");

function formilla_edge_init() {
    if(function_exists('current_user_can') && current_user_can('manage_options')) {
        add_action('admin_menu', 'formilla_add_edge_settings_page');
        add_action('admin_menu', 'formilla_edge_create_menu');
    }
}

function save_formilla_edge_settings() {
	$nonce = $_GET['_wpnonce'];

	if (!wp_verify_nonce($nonce,'update-options'))
	{
		echo "Error";
	    die( 'Security check' );
	}
	else
	{
	    $formillaPluginID = trim($_GET['FormillaPluginID']);

		$succeeded = add_option('FormillaPluginID', $formillaPluginID);

		if(!$succeeded)
		{
			update_option('FormillaPluginID', $formillaPluginID);
		}

		echo "Success";
		die(); // this is required to return a proper result
	}
}

/**
* Display the launch link if a FormillaPluginID exists for this user.
* Otherwise, display the signup page.
*/
function Formilla_edge_dashboard() {
	?>
	<br /> <br />
    <img src="<?php echo plugin_dir_url( __FILE__ ).'main-logo.png'; ?>"/>

    <?php

    if(!get_option('FormillaPluginID'))
    {
    ?>
    	   <form method="post" id="optionsform" action="options.php">
				<div class="error settings-error" id="setting-error-invalid_admin_email" style="margin: 4px 0px 5px 0px; width: 1100px;">
					<p style="padding:0px;">
						<?php echo '<a href="'.FORMILLA_EDGE_REG.'"';?> target="_blank">Sign Up</a> and save the Plugin ID you receive to activate your account.<br/><br/>
						<?php wp_nonce_field('update-options') ?>
						<label for="FormillaPluginID">
						<input type="text" name="FormillaPluginID" id="FormillaPluginID" value="<?php echo(get_option('FormillaPluginID')) ?>" style="width:300px" />
						<input type="hidden" name="page_options" value="FormillaPluginID" />
						<input type="submit" onclick="saveFormillaEdgeSettings();return false;" name="formillaSettingsSubmit" id="formillaSettingsSubmit" value="<?php _e('Save Settings') ?>" class="button-primary" />
					</p>
				</div>
		   </form>
		   <p id="successMessage" style="display:none; color:green;">Your settings were saved successfully!</p>
		   <p id="failureMessage" style="display:none; color:red;">There was an error saving your settings.  Please try again.</p>

	<?php
	    }
	?>

		<div class="metabox-holder" id="formillaLinks" <?php  if(!get_option('FormillaPluginID')){echo 'style="display:none"';} ?> >
			<div class="postbox">
				<div style="padding:10px;">
				<?php echo '<a href="'.FORMILLA_EDGE_DASH.'"';?> target="_blank">Launch Formilla</a> to create or modify your widgets.
				<br/><br/>
				<a href="options-general.php?page=formilla-edge">Modify</a> my Formilla Plugin ID.
				</div>
			</div>
		</div>


    <script>
    	function saveFormillaEdgeSettings()
    	{			
    		if(!verifyFormillaPluginID())
    		{
				alert('You entered an invalid Plugin ID.  Please try again.');
				return false;
    		}

			var data = { action: 'save_formilla_edge_settings' };
			
			jQuery.post(ajaxurl + '?' + jQuery('#optionsform').serialize(), data, function(response)
			{
				if(response == 'Success')
				{
					jQuery('#optionsform').hide();
					jQuery('#failureMessage').hide();
					jQuery('#successMessage').show();
					jQuery('#formillaLinks').slideDown(600);
					setTimeout('jQuery("#successMessage").slideUp(1000)', 10000);
				}
				else
				{
					jQuery('#failureMessage').show();
				}
			});
		}

		function verifyFormillaPluginID() {
		    if(jQuery('#FormillaPluginID').val().trim().length != 36)
		    	return false;
		    else
		    	return true;
		}

	</script>
	<?php
}

/**
* The Formilla script to load the edge widgets on the wordpress site.
*/
function formilla_edge_script() {
    global $current_user;

    if(get_option('FormillaPluginID')) {
        echo("\n\n <div id=\"formillaedge\" style=\"z-index:100 \"></div><div id=\"formillawindowholder\"><span style=\"display:none\"></span></div><script type=\"text/javascript\">");
		  echo("      (function () { ");
		    echo("      var head = document.getElementsByTagName(\"head\").item(0); ");
		    echo("      var script = document.createElement('script'); ");
		    
			echo("      var src = (document.location.protocol == \"https:\" ? 'https://www.formilla.com/scripts/feedback.js' : 'http://www.formilla.com/scripts/feedback.js');");
			echo("      script.setAttribute(\"type\", \"text/javascript\"); script.setAttribute(\"src\", src); script.setAttribute(\"async\", true); ");
		    echo("      var complete = false; ");
		    echo("      script.onload = script.onreadystatechange = function () { ");
		    echo("        if (!complete && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { ");
		    echo("          complete = true; ");
		    echo("          Formilla.guid = '".get_option('FormillaPluginID')."';");
		    echo("          Formilla.loadWidgets(); ");
		    echo("            }");
		    echo("      }; ");

		    echo("      head.appendChild(script); ");
		    echo("  })(); ");
    		echo(" </script> ");
    }
}

function formilla_edge_plugin_links($links, $file) {
	$base = plugin_basename(__FILE__);
	if ($file == $base) {
		$links[] = '<a href="options-general.php?page=formilla-edge">' . __('Settings','formilla_widget') . '</a>';
	}
	return $links;
}

function formilla_edge_plugin_actions($links, $file) {
    static $this_plugin;
    if(!$this_plugin) $this_plugin = plugin_basename(__FILE__);
    if($file == $this_plugin && function_exists('admin_url')) {

        if(trim(get_option('FormillaPluginID')) == "") {
        	$settings_link = '<a href="'.admin_url('admin.php?page=Formilla_edge_dashboard').'">'.__('Get Started').'</a>';
        }
        else {
        	$settings_link = '<a href="'.admin_url('options-general.php?page=formilla-edge').'">'.__('Settings').'</a>';
        }

        array_unshift($links, $settings_link);
    }
    return($links);
}

/**
* Formilla Edge Settings page. Once user signs up, Formilla Plugin ID must be entered here to activate account.
*/
function formilla_add_edge_settings_page() {
    function formilla_edge_settings_page() {
        global $formilla_edge_domain, $plugurldir; ?>
<div class="wrap">
        <?php screen_icon() ?>
    <img src="<?php echo plugin_dir_url( __FILE__ ).'main-logo.png'; ?>"/>
    <div class="metabox-holder meta-box-sortables ui-sortable pointer">
        <div class="postbox" style="float:left;width:40em;margin-right:10px">
            <div class="inside" style="padding: 0 10px">
                <form method="post" action="options.php">
                    <p style="text-align:center">
                    <?php wp_nonce_field('update-options') ?>
                    <p><label for="FormillaPluginID">Activate Formilla Edge by entering the Plugin ID received when registering.

                    <?php
						if(trim(get_option('FormillaPluginID')) == "") {
					?>
							If you don't have an account, click <a href="admin.php?page=Formilla_edge_dashboard">here</a> to get started.
					<?php
						}
					?>
                    <input type="text" name="FormillaPluginID" id="FormillaPluginID" value="<?php echo(get_option('FormillaPluginID')) ?>" style="width:100%" /></p>
                    <p class="submit" style="padding:0"><input type="hidden" name="action" value="update" />
                        <input type="hidden" name="page_options" value="FormillaPluginID" />
                        <input type="submit" name="formillaSettingsSubmit" id="formillaSettingsSubmit" value="<?php _e('Save Settings') ?>" class="button-primary" /> </p>
               </form>
            </div>
        </div>
    </div>
</div>

    <?php }
    add_submenu_page('options-general.php', __('Formilla Edge Settings'), __('Formilla Edge Settings'), 'manage_options', 'formilla-edge', 'formilla_edge_settings_page');
}

function formilla_edge_create_menu() {
    //create new top-level menu
    add_menu_page('Account Configuration', 'Formilla Edge', 'administrator', 'Formilla_edge_dashboard', 'Formilla_edge_dashboard', plugin_dir_url( __FILE__ ).'logo.png');
    add_submenu_page('Formilla_edge_dashboard', 'Dashboard', 'Dashboard', 'administrator', 'Formilla_edge_dashboard', 'Formilla_edge_dashboard');
}

function formilla_edge_uninstall() {
    if(get_option('FormillaPluginID')) {
	    delete_option( 'FormillaPluginID');
	}
}
?>