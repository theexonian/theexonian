<?php

class Wpmmp_Settings {

	function __construct() {

		$this->previous_default_settings();
		
		if ( ! get_option( 'mmp_favicon' ) ) {

			$this->default_settings();

		}



		$this->hooks();

		$this->filters();

	}

	function hooks() {

		add_action( 'admin_menu', array( $this, 'add_menu' ) );

		add_action( 'init', array( $this, 'add_css_js_assets' ) );

		add_action( 'wp_ajax_wpmmp_reset_settings', array( $this, 'reset_settings' ) );

		add_action( 'init', array( $this, 'plugin_activation_notice' ) );

		add_action( 'admin_init', array( $this, 'tabs_register_settings' ) );

	}

	function filters() {

		add_filter( 'plugin_action_links_' . plugin_basename(WPMMP_PLUGIN_MAIN_FILE ), array( $this, 'add_settings_link' ) );

	}

	function add_menu() {

		$parent_slug = 'options-general.php';

		$page_title = __( 'Maintenance Mode Settings', 'wpmp' );

		$menu_title = __( 'Maintenance Mode', 'wpmp' );

		$capability = 'manage_options';

		$menu_slug = 'wpmmp-settings';

		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, array( $this, 'settings_page' ), 'dashicons-hammer' );

	}

	function add_css_js_assets() {

		if ( ! isset( $_GET['page'] ) )
			return FALSE;

		if ( $_GET['page'] !== 'wpmmp-settings' )
			return FALSE;

		wp_enqueue_script( 'wp-color-picker'  );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-accordion' );

		wp_enqueue_media();

		wp_enqueue_style( 'wpmp-settings', 
			plugins_url( 'css/admin-settings.css', WPMMP_PLUGIN_MAIN_FILE ) );

		wp_enqueue_script( 'wpmp-settings', 
			plugins_url( 'js/admin-settings.js', WPMMP_PLUGIN_MAIN_FILE ), array( 'wp-color-picker' ) );

		$translation_array = array( 
				'confirm_reset' => __( 'Are you sure you want to reset the settings ?', 'wpmmp' ),
				'successfull_reset' => __( 'The settings have been restored to the default settings', 'wpmmp' ),
				'reset_nonce' => wp_create_nonce( 'wpmmp_reset_nonce' ),
				'ajax_url' => admin_url( 'admin-ajax.php' )
			);
		
		wp_localize_script( 'wpmp-settings', 'wpmmpjs', $translation_array );

	}

	function settings_page() {

		$nonce = wp_create_nonce( 'wpmmp_settings_page_nonce' );

		$themes = wpmmp_get_themes();

		include wpmmp_settings_part( 'premiumui' );

	}

	function save_settings() {

		if ( ! current_user_can( 'manage_options' ) )
			wp_die( 'You are not allowed to change plugin options' );



		include wpmmp_settings_part( 'settings-saved' );
	}

	function reset_settings() {

		if ( ! current_user_can( 'manage_options' ) )
			exit( '1' );

		if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'wpmmp_reset_nonce' ) )
			exit( '2' );

		delete_option('mmp_on_off');
		delete_option('mmp_favicon');
		delete_option('mmp_title');
		delete_option('mmp_seo_meta');
		delete_option('mmp_analytics');
		delete_option('mmp_logo');
		delete_option('mmp_headline');
		delete_option('mmp_message');
		delete_option('mmp_bgcolor');
		delete_option('mmp_text_color');
		delete_option('mmp_links_color');
		delete_option('mmp_links_hover_color');
		delete_option('mmp_background_image');
		delete_option('mmp_res_bg');
		delete_option('mmp_fft');
		delete_option('mmp_ffht');
		delete_option('mmp_custom_css');
		delete_option('mmp_custom_header_script');
		delete_option('mmp_custom_footrt_script');
		delete_option('mmp_fb_page');
		delete_option('mmp_tw_page');
		delete_option('mmp_lkin_page');
		delete_option('mmp_pin_page');
		delete_option('mmp_insta_page');
		delete_option('mmp_show_fb');
		delete_option('mmp_show_tw');
		delete_option('mmp_show_lk');
		delete_option('mmp_show_pin');
		delete_option('mmp_show_insta');
		delete_option('mmp_on_off_countdown');
		delete_option('mmp_on_off_progress');
		delete_option('mmp_set_dateTime');
		delete_option('mmp_set_progress');
		delete_option('mmp_on_off_subscribe');
		delete_option('mmp_http_503');
		delete_option('mmp_feed_access');
		delete_option('mmp_themes');
		delete_option('mmp_mc_api');
	    delete_option('mmp_mc_listid'); 
	    delete_option('mmp_mc_optin');
	    delete_option('mmp_mc_sbt');
	    delete_option('mmp_mc_pt');
	    delete_option('mmp_subheading');
	    delete_option('mmp_headingcolor');
	    delete_option('mmp_userroles');

		exit( '10' );

	}

	function previous_default_settings() {

		if ( ! get_option( 'wpmmp_settings' ) )
			return false;

		if ( get_option( 'wpmmp_preToNewDone' ) )
			return false;

		$options = get_option( 'wpmmp_settings' );

		if ( $options['status'] == 'enabled' )
			update_option( 'mmp_on_off', 1 );
		else
			update_option( 'mmp_on_off', 0 );

		update_option( 'mmp_themes' , 'default' );

		update_option('mmp_title', $options['title'] );

		update_option( 'mmp_headline' , $options['heading1'] );

		update_option( 'mmp_subheading' , $options['heading2'] );

		update_option( 'mmp_message' , $options['content'] );

		if ( $options['countdown_timer'] )
			update_option( 'mmp_on_off_countdown' , 1 );
		else
			update_option( 'mmp_on_off_countdown' , 0 );

		update_option( 'mmp_set_dateTime' , $options['countdown_time'] );

		if ( $options['progress_bar'] )
			update_option( 'mmp_on_off_progress' , 1 );
		else
			update_option( 'mmp_on_off_progress' , 0 );

		update_option( 'mmp_set_progress' , $options['progress_bar_range'] );

		if ( $options['http_503_header'] == 'enabled' )
			update_option( 'mmp_http_503' , 1 );
		else
			update_option( 'mmp_http_503' , 0 );

		if ( $options['feed'] == 'enabled' )
			update_option( 'mmp_feed_access' , 1 );
		else
			update_option( 'mmp_feed_access' , 0 );

		update_option( 'wpmmp_preToNewDone', true );

	}

	function default_settings() {

	  add_option('mmp_on_off' , 0);
	  add_option('mmp_favicon', '');
	  add_option('mmp_title', 'Site is Down');
	  add_option('mmp_seo_meta', '');
	  add_option('mmp_analytics', '');
	  add_option('mmp_logo' , '');
	  add_option('mmp_headline' , 'We are down for maintenance');
	  add_option('mmp_message' , 'Ad your message here');
	  add_option('mmp_bgcolor' , '');
	  add_option('mmp_text_color', '');
	  add_option('mmp_links_color' ,'');
	  add_option('mmp_links_hover_color','');
	  add_option('mmp_background_image' , '');
	  add_option('mmp_res_bg' , '0');
	  add_option('mmp_fft' , ' ');
	  add_option('mmp_ffht' , '');
	  add_option('mmp_custom_css' , '');
	  add_option('mmp_custom_header_script' , '');
	  add_option('mmp_custom_footrt_script', '');
	  add_option('mmp_fb_page' , '');
	  add_option('mmp_tw_page' , '');
	  add_option('mmp_lkin_page' , '');
	  add_option('mmp_pin_page' ,'');
	  add_option('mmp_insta_page', '');
	  add_option('mmp_show_fb' , 0);
	  add_option('mmp_show_tw' , 0);
	  add_option('mmp_show_lk' , 0);
	  add_option('mmp_show_pin' , 0);
	  add_option('mmp_show_insta' , 0);
	  add_option('mmp_on_off_countdown' , 0);
	  add_option('mmp_on_off_progress' , 0);
	  add_option('mmp_set_dateTime', date('m/d/Y'));
	  add_option('mmp_set_progress' , '');
	  add_option('mmp_on_off_subscribe' , 0);
	  add_option('mmp_http_503' , 0);
	  add_option('mmp_feed_access' , 0);
	  
	  add_option('mmp_themes' , 'default');
	  add_option('mmp_mc_api' , '');
	  add_option('mmp_mc_listid' , '' ); 
	  add_option('mmp_mc_optin' ,  1);
	  add_option('mmp_mc_sbt' ,  'Subscribe');
	  add_option('mmp_mc_pt' ,  'Enter Email');

	  add_option('mmp_subheading', '');
	  add_option( 'mmp_headingcolor', '' );

	  add_option( 'mmp_userroles', array( 'administrator' ) );


	}

	public static function get_settings() {

		$settings = get_option( 'wpmmp_settings' );

		return apply_filters( 'wpmmp_settings', $settings );

	}

	function admin_tabs( $current = 'general-settings' ) {
	    
	    $tabs = array( 
	    		'general-settings' => __( 'General Settings', 'wpmmp' ), 
	    		
	    		'theme-settings' => __( 'Themes', 'wpmmp' ),
	    		
	    		'page-settings' => __( 'Page', 'wpmmp' ), 
	    		
	    		'header-settings' => __( 'Header', 'wpmmp' ),
	    		
	    		'design-settings' => __( 'Design', 'wpmmp' ),
	    		
	    		'social-settings' => __( 'Social Icons', 'wpmmp' ),

	    		'email-settings' => __( 'Email Settings', 'wpmmp' ),
	    		
	    		
	    		
	    		'script-settings' => __( 'Scripts', 'wpmmp' ),
	    		
	    		'advanced-settings' => __( 'Advanced', 'wpmmp' ),
	    	);

	    echo '<div id="icon-themes" class="icon32"><br></div>';
	    
	    echo '<h2 class="nav-tab-wrapper">';
	    
	    foreach( $tabs as $tab => $name ){
	        
	        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
	        
	        echo "<a class='nav-tab$class' href='?page=wpmmp-settings&tab=$tab'>$name</a>";

	    }

	    echo '</h2>';
	}

	function general_settings_meta_box( $settings ) {

		$themes = wpmmp_get_themes();

		include wpmmp_settings_part( 'general-meta-box.php' );

	}


	function plugin_activation_notice() {

		if ( get_option( 'wpmmp-activation-notice' ) )
			return FALSE;

		if ( isset( $_REQUEST['page'] ) ) {

			if ( $_REQUEST['page'] == 'wpmmp-settings' ) {

				add_option( 'wpmmp-activation-notice', 'showed', '', 'yes' );

				return FALSE;

			}

		}

		$settings_link = admin_url( 'admin.php?page=wpmmp-settings' );

		include wpmmp_view_path( 'admin-settings/plugin_actiavtion_notice' );

	}

	function add_settings_link( $links ) {

		$settings_link = admin_url( 'admin.php?page=wpmmp-settings' );

		$settings_link = sprintf( '<a href="%s">Settings</a>', $settings_link );

		return array_merge( $links, array( 
				'settings' => $settings_link
		 	) );

	}


	function tabs_register_settings(){

	  register_setting('mmp-settings-group','mmp_on_off');
	  register_setting('mmp-settings-group','mmp_favicon');
	  register_setting('mmp-settings-group','mmp_title');
	  register_setting('mmp-settings-group','mmp_seo_meta');
	  register_setting('mmp-settings-group','mmp_analytics');
	  register_setting('mmp-settings-group','mmp_logo');
	  register_setting('mmp-settings-group','mmp_headline');
	  register_setting('mmp-settings-group','mmp_message');
	  register_setting('mmp-settings-group','mmp_bgcolor');
	  register_setting('mmp-settings-group','mmp_text_color');
	  register_setting('mmp-settings-group','mmp_links_color');
	  register_setting('mmp-settings-group','mmp_links_hover_color');
	  register_setting('mmp-settings-group','mmp_background_image');
	  register_setting('mmp-settings-group','mmp_res_bg');
	  register_setting('mmp-settings-group','mmp_fft');
	  register_setting('mmp-settings-group','mmp_ffht');
	  register_setting('mmp-settings-group','mmp_custom_css');
	  register_setting('mmp-settings-group','mmp_custom_header_script');
	  register_setting('mmp-settings-group','mmp_custom_footrt_script');
	  register_setting('mmp-settings-group','mmp_fb_page');
	  register_setting('mmp-settings-group','mmp_tw_page');
	  register_setting('mmp-settings-group','mmp_lkin_page');
	  register_setting('mmp-settings-group','mmp_pin_page');
	  register_setting('mmp-settings-group','mmp_insta_page');
	  register_setting('mmp-settings-group','mmp_show_fb');
	  register_setting('mmp-settings-group','mmp_show_tw');
	  register_setting('mmp-settings-group','mmp_show_lk');
	  register_setting('mmp-settings-group','mmp_show_pin');
	  register_setting('mmp-settings-group','mmp_show_insta');
	  register_setting('mmp-settings-group','mmp_on_off_countdown');
	  register_setting('mmp-settings-group','mmp_on_off_progress');
	  register_setting('mmp-settings-group','mmp_set_dateTime');
	  register_setting('mmp-settings-group','mmp_set_progress');
	  register_setting('mmp-settings-group','mmp_on_off_subscribe');
	  register_setting('mmp-settings-group','mmp_http_503');
	  register_setting('mmp-settings-group','mmp_feed_access');
	  register_setting('mmp-settings-group','mmp_themes');
	  register_setting('mmp-settings-group','mmp_mc_api');
	  register_setting('mmp-settings-group','mmp_mc_listid'); 
	  register_setting('mmp-settings-group','mmp_mc_optin');
	  register_setting('mmp-settings-group','mmp_mc_sbt');
	  register_setting('mmp-settings-group','mmp_mc_pt');
	  register_setting('mmp-settings-group','mmp_subheading');
	  register_setting('mmp-settings-group','mmp_headingcolor');
	  register_setting('mmp-settings-group','mmp_userroles');
	  register_setting('mmp-settings-group','');

	}

}