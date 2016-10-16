<?php
/**
 *
 * @package   ChimpMate - WordPress MailChimp Assistant
 * @author    Voltroid<care@voltroid.com>
 * @license   GPL-2.0+
 * @link      http://voltroid.com/chimpmate
 * @copyright 2015 Voltroid
 *
 * @wordpress-plugin
 * Plugin Name:       ChimpMate - WordPress MailChimp Assistant
 * Plugin URI:        http://voltroid.com/chimpmate
 * Description:       Easy to Use MailChimp Plugin
 * Version:           1.2.8
 * Author:            Voltroid
 * Author URI:        http://voltroid.com
 * Text Domain:       wp-mailchimp-assistant
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'WPMCA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPMCA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-chimpmate-wpmc-assistant.php' );
require_once( plugin_dir_path( __FILE__ ) . 'src/MailChimp1.php' );
require_once( plugin_dir_path( __FILE__ ) . 'src/MailChimp.php' );

register_activation_hook( __FILE__, array( 'ChimpMate_WPMC_Assistant', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ChimpMate_WPMC_Assistant', 'deactivate' ) );


add_action( 'plugins_loaded', array( 'ChimpMate_WPMC_Assistant', 'get_instance' ) );


if ( is_admin() ) {
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-chimpmate-wpmc-assistant-admin.php' );
	add_action( 'plugins_loaded', array( 'ChimpMate_WPMC_Assistant_Admin', 'get_instance' ) );
}


require_once( plugin_dir_path( __FILE__ ) . 'widget/class-chimpmate-wpmc-assistant-widget.php' );