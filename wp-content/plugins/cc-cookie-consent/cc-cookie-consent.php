<?php
/**
 * Plugin Name: CC Cookie Consent (Silktide)
 * Plugin URI: https://progweb.hu/cc
 * Description: Cookie Consent Plugin for WordPress. Original javascript plugin developed by Silktide
 * Version: 1.0.6
 * Author: WebPositive <hello@progweb.hu>
 * Author URI: https://progweb.hu
 * Tags: cookie, cookie consent, wordpress, silktide
 * Author e-mail: developer@progweb.hu
 */

if(!defined('ABSPATH')) exit;
define('CC_VERSION','1.0.6');
define('CC_BUILD_DATE','2016-05-19');

global $theme;
global $message;
global $more_info;
global $more_link;
global $ok_button;

$theme = "light-bottom";
$message = "Hello! This website uses cookies to ensure you get the best experience on our website";
$more_info = "More info";
$more_link = null;
$ok_button = "Got it!";

function wpSilktideCookieScripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('cc-js', ''.plugins_url( 'assets/plugin-js/cookieconsent.latest.min.js', __FILE__ ).'', array(), CC_VERSION, true);
        wp_enqueue_script('cc-js');
    }
}
add_action('wp_enqueue_scripts', 'wpSilktideCookieScripts');

/**
 * Load css to wp_head() without js/http request
 * Github issue: https://github.com/progcode/WPCookieConsent/issues/2
 */
function wpSilktideCookieStyle() {

    $theme = get_option('silktide_cc_theme');

    switch ($theme) {
        case "dark-bottom":
            wp_register_style('cc-dark-bottom', plugins_url('/assets/plugin-css/dark-bottom.css', __FILE__), array(), CC_VERSION);
            wp_enqueue_style('cc-dark-bottom');
            break;
        case "dark-floating":
            wp_register_style('cc-dark-floating', plugins_url('/assets/plugin-css/dark-floating.css', __FILE__), array(), CC_VERSION);
            wp_enqueue_style('cc-dark-floating');
            break;
        case "dark-top":
            wp_register_style('cc-dark-top', plugins_url('/assets/plugin-css/dark-top.css', __FILE__), array(), CC_VERSION);
            wp_enqueue_style('cc-dark-top');
            break;
        case "light-bottom":
            wp_register_style('cc-light-bottom', plugins_url('/assets/plugin-css/light-bottom.css', __FILE__), array(), CC_VERSION);
            wp_enqueue_style('cc-light-bottom');
            break;
        case "light-floating":
            wp_register_style('cc-light-floating', plugins_url('/assets/plugin-css/light-floating.css', __FILE__), array(), CC_VERSION);
            wp_enqueue_style('cc-light-floating');
            break;
        case "light-top":
            wp_register_style('cc-light-top', plugins_url('/assets/plugin-css/light-top.css', __FILE__), array(), CC_VERSION);
            wp_enqueue_style('cc-light-top');
            break;
        default:
            wp_register_style('cc-dark-bottom', plugins_url('/assets/plugin-css/dark-bottom.css', __FILE__), array(), CC_VERSION);
            wp_enqueue_style('cc-dark-bottom');
    }
}
add_action('wp_enqueue_scripts', 'wpSilktideCookieStyle');

/** Add CC config js if cookie.consent.js loaded */
function wpSilktideCookieInlineScripts() { ?>
    <script>
        window.cookieconsent_options = {
            "message":"<?php if(get_option('silktide_cc_text_headline')): echo esc_js(get_option('silktide_cc_text_headline')); else: global $message; echo esc_js($message); endif; ?>",
            "dismiss":"<?php if(get_option('silktide_cc_text_button')): echo esc_js(get_option('silktide_cc_text_button')); else: global $ok_button; echo esc_js($ok_button); endif; ?>",
            "learnMore":"<?php if(get_option('silktide_cc_text_more_button')): echo esc_js(get_option('silktide_cc_text_more_button')); else: global $more_info; echo esc_js($more_info); endif; ?>",
            "link":"<?php if(get_option('silktide_cc_cookie_page')): echo esc_js(get_option('silktide_cc_cookie_page')); else: global $more_link; echo esc_js($more_link); endif; ?>",
            "theme":"<?php if(get_option('silktide_cc_theme')): echo esc_js(get_option('silktide_cc_theme')); else: global $theme; echo esc_js($theme); endif; ?>"
        };
    </script>
    <?php
}
add_action('wp_footer', 'wpSilktideCookieInlineScripts');

/** Add Settings link */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wpSilktideCookieSettingsLinks' );
function wpSilktideCookieSettingsLinks( $links ) {
    $links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=cookie-consent') ) .'">Settings</a>';
    return $links;
}

/**
 * Add Settings Page
 */
add_action('admin_menu', 'wpSilktideCookieSettings');
function wpSilktideCookieSettings() {
    add_menu_page(__('Cookie Consent','cookie-consent'), __('Cookie Consent','cookie-consent'), 'manage_options', 'cookie-consent', 'wpSilktideCookieSettingsPage');
}

add_action('admin_menu', 'wpSilktideCookieSubMenu');
function wpSilktideCookieSubMenu() {
    add_submenu_page( 'cookie-consent', 'Help/Information', 'Help/Information', 'manage_options', 'cookie-consent-info', 'wpSilktideCookieHelpPage' );
}

/** option template for settings pages */
function wpSilktideCustomOptionTemplate($option_title, $option_desc, $option_section, $option_options)
{
    ?>
    <div class="wrap">
        <h1><?php _e($option_title); ?></h1>
        <p><?php _e($option_desc) ?></p>
        <div class="updated"><p><?php _e('Wow! Your plugin is ready! Would you like support the development? <a target="_blank" href="https://progweb.hu/cc?utm_soure=plugin_admin">Click here</a>!'); ?></p></div>
        <form class="cc" method="post" action="options.php" id="cookieConsentSettings">
            <?php
            settings_fields($option_section);
            do_settings_sections($option_options);
            submit_button();
            ?>
        </form>
        <hr/>
        <a class="button" href="admin.php?page=cookie-consent-info"><?php _e('Click here for plugin help & information'); ?></a>
    </div>
    <?php
}

function wpSilktideInputField($input, $placeholder) {
    echo '<input class="regular-text" type="text" name="'.$input.'" id="'.$input.'" value="'.get_option($input).'" placeholder="'.$placeholder.'" />';
}

function wpSilktideSelectField($link) {
    echo '<select name="'.$link.'">';	
	echo '<option value="0">-- Not selected --</option>';
        $selected_page = get_option($link);
        $pages = get_pages();
        foreach ( $pages as $page ) {
            $option = '<option value="' . get_page_link( $page->ID ) . '" ';
            $option .= ( get_page_link( $page->ID ) == $selected_page ) ? 'selected="selected"' : '';
            $option .= '>';
            $option .= $page->post_title;
            $option .= '</option>';
            echo $option;
        }
    echo '</select>';
}

/** Plugin Settings Tab */
function wpSilktideCookieSettingsPage() {
    $option_title = "Cookie Consent Settings";
    $option_desc = "This settings are required to use Cookie Consent plugin on Your website. Please fill the form then see the frontend page!";
    $option_section = "silktide-cc-plugin-section";
    $option_options = "silktide-cc-plugin-options";
    wpSilktideCustomOptionTemplate($option_title, $option_desc, $option_section, $option_options);
}

/** Plugin Settings Fields */
function wpSilktideCookieChooseTheme() {
    echo
        "<select name='silktide_cc_theme' id='silktide_cc_theme'>".
            "<option value='dark-top' ".selected( get_option('silktide_cc_theme'), 'dark-top', false).">Dark Top</option>".
            "<option value='dark-floating' ".selected( get_option('silktide_cc_theme'), 'dark-floating', false).">Dark Floating</option>".
            "<option value='dark-bottom' ".selected( get_option('silktide_cc_theme'), 'dark-bottom', false).">Dark Bottom</option>".
            "<option value='light-floating' ".selected( get_option('silktide_cc_theme'), 'light-floating', false).">Light Floating</option>".
            "<option value='light-top' ".selected( get_option('silktide_cc_theme'), 'light-top', false).">Light Top</option>".
            "<option value='light-bottom' ".selected( get_option('silktide_cc_theme'), 'light-bottom', false).">Light Bottom</option>".
        "</select>";
}

function wpSilktideCookieTextHeadline() {
    $input = "silktide_cc_text_headline";
    $placeholder = "Headline text";
    wpSilktideInputField($input, $placeholder);
}

function wpSilktideCookieTextAcceptButton() {
    $input = "silktide_cc_text_button";
    $placeholder = "Accept button text";
    wpSilktideInputField($input, $placeholder);
}

function wpSilktideCookieTextReadMoreButton() {
    $input = "silktide_cc_text_more_button";
    $placeholder = "Read more button text";
    wpSilktideInputField($input, $placeholder);
}

function wpSilktideCookieLinkCookiePolicy() {
    $link = "silktide_cc_cookie_page";
    wpSilktideSelectField($link);
}

/** Plugin help & Information Tab */
function wpSilktideCookieHelpPage() {
    include_once('view/help.php');
}

/**
 * Save and get options
 */
function wpSilktideCookieFields()
{
    add_settings_section("silktide-cc-plugin-section", null, null, "silktide-cc-plugin-options");

    add_settings_field("silktide_cc_theme", "Choose theme", "wpSilktideCookieChooseTheme", "silktide-cc-plugin-options", "silktide-cc-plugin-section");
    add_settings_field("silktide_cc_text_headline", "Headline text", "wpSilktideCookieTextHeadline", "silktide-cc-plugin-options", "silktide-cc-plugin-section");
    add_settings_field("silktide_cc_text_button", "Accept button text", "wpSilktideCookieTextAcceptButton", "silktide-cc-plugin-options", "silktide-cc-plugin-section");
    add_settings_field("silktide_cc_text_more_button", "Read more button text", "wpSilktideCookieTextReadMoreButton", "silktide-cc-plugin-options", "silktide-cc-plugin-section");
    add_settings_field("silktide_cc_cookie_page", "Your cookie policy page", "wpSilktideCookieLinkCookiePolicy", "silktide-cc-plugin-options", "silktide-cc-plugin-section");

    register_setting("silktide-cc-plugin-section", "silktide_cc_theme");
    register_setting("silktide-cc-plugin-section", "silktide_cc_text_headline");
    register_setting("silktide-cc-plugin-section", "silktide_cc_text_button");
    register_setting("silktide-cc-plugin-section", "silktide_cc_text_more_button");
    register_setting("silktide-cc-plugin-section", "silktide_cc_cookie_page");

}
add_action("admin_init", "wpSilktideCookieFields");