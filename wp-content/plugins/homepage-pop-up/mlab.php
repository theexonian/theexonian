<?php
/**
 * Plugin Name: Homepage Pop-up
 * Plugin URI: http://www.magneticlab.ch/mlabpopup
 * Description: Plugin permettant d'ajouter un Pop-up sur la page d'accueil. Ajoutez un titre et une information importante sur votre page d'accueil sans vous faire bloquer par un AdBlock.
 * Version: Version 1.2.5
 * Requires at least: 3.5.0
 * Tested up to: 4.5
 *
 * Text Domain: mlab_popup
 * Author: Magneticlab Sàrl
 * Author URI:  http://www.magneticlab.ch/
 */
  
	// Constants
	define( 'MLAB_ROOT_FILE', __FILE__ );
	define( 'MLAB_ROOT_PATH', dirname( __FILE__ ) );
	define( 'MLAB_ROOT_URL', plugins_url( '', __FILE__ ) );
	define( 'MLAB_PLUGIN_VERSION', '1.2.5');
	define( 'MLAB_PLUGIN_SLUG', basename( dirname( __FILE__ ) ) );
	define( 'MLAB_PLUGIN_BASE', plugin_basename( __FILE__ ) );
	define( 'MLAB_DB_TABLE', 'mlab_popup' );
		
 	include_once( MLAB_ROOT_PATH . '/includes/functions.php' ); 
	include_once( MLAB_ROOT_PATH . '/includes/ini.php' );	
 	include_once( MLAB_ROOT_PATH . '/views/admin.php' );  
	
	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );
	add_action( 'admin_menu', 'mlab_create_settings_page' );
  	add_action( 'admin_enqueue_scripts', 'mlab_load_scripts' );
	add_action('init', 'StartSession', 1);
	add_action('wp_logout', 'KillSession'); 
	add_action( 'plugins_loaded', 'mlab_init' ); 
	add_action( 'wp_footer', 'add_popup' );	

  	// Installation et initialisation seulement lors de l'installation du plugin
 	register_activation_hook( __FILE__, 'mlab_install' );
 	register_activation_hook( __FILE__, 'mlab_install_data' );
	register_uninstall_hook( __FILE__, 'mlab_uninstall' );
	 