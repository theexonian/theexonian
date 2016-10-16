<?php

class Wpmmp_Theme_Handler {

	protected $name;

	protected $description;

	protected $id;

	protected $path;

	protected $template_name;

	protected $settings_page;

	protected $settings_page_title;

	protected $settings_page_slug;

	protected $use_styles;

	function __construct() {

		$this->_hooks();

		$this->_filters();

		$this->hooks();

		$this->filters();

		$this->init();

	}

	function init() {


	}

	function hooks() {

	}

	function filters() {


	}

	private function _filters() {

		add_filter( 'wpmmp_themes', array( $this, 'register_theme' ) );
		
		if ( $this->is_activated() && $this->check_rules() )
				$this->theme_change();

	}

	private function _hooks() {

		add_action( 'wp_ajax_nopriv_wpmmp_c_soon_store_email', array( $this, 'store_email' ) );
		add_action( 'wp_ajax_wpmmp_c_soon_store_email', array( $this, 'store_email' ) );
 
	}

	public function name( $name = '' ) {

		if (  empty( $name ) )
			return $this->name;

		$this->name = $name;

	}

	public function description( $description = '' ) {

		if (  empty( $description ) )
			return $this->description;

		$this->description = $description;

	}

	public function id( $id = '' ) {

		if (  empty( $id ) )
			return $this->id;

		$this->id = $id;

	}

	function register_theme( $themes ) {

		if ( isset( $themes[$this->id] ) )
			return $themes;

		$themes[$this->id] = $this;

		return $themes;

	}

	public function is_activated( $theme_id = '' ) {

		if ( empty( $id ) )
			$id = $this->id();

		$theme = wpmmp_get_active_theme();

		
		if ( $id === 'default' ) {

			if ( strpos( $theme, 'default' ) !== false )
				return true;

		}

		return $theme == $id;

	}

	public function check_rules( $theme_id = '' ) {
		
		if ( empty( $id ) )
			$id = $this->id();

		if ( isset( $_GET['wpmmp-mode'] ) ) {

			if ( $_GET['wpmmp-mode'] === 'enabled' ) {
				
				if ( wp_verify_nonce( $_GET['nonce'], 'wpmmp-preview-nonce' ) ) {

					if ( ! defined( 'WPMMP_DEBUG_MODE' ) )
						define( 'WPMMP_DEBUG_MODE', TRUE );
					
					return 
						apply_filters( 'wpmmp_check_rules', TRUE, 'preview' );
				}



			}
		}

		

		$status = get_option( 'mmp_on_off' );

		if ( $status !== '1' )
			return apply_filters( 'wpmmp_check_rules', FALSE, 'disabled' );

		return apply_filters( 'wpmmp_check_rules', TRUE, 'success' );

	}

	function theme_change() {

		if ( ! is_user_logged_in() ) {

			add_action( 'template_redirect', array( $this, 'template_hook' ) );

			return;
		}

		$allowed_roles = get_option( 'mmp_userroles' );

		if ( ! is_array( $allowed_roles ) )
			$allowed_roles = array('administrator');

		$current_user = wp_get_current_user();

		if ( array_intersect( $allowed_roles, $current_user->roles ) 
			&& ! defined( 'WPMMP_DEBUG_MODE' ) )
			return FALSE;

		

		add_action( 'template_redirect', array( $this, 'template_hook' ) );

	}

	function theme_settings() {

		/* The message will be shown on the theme settings page if the theme do not support theme settings feature */

		_e( 'The current selected/activated theme do not have any settings or the theme might not have support for this feature.', 'wpmmp' );

	}

	function template_hook() {

		if ( get_option('mmp_feed_access') === '1' )
			$this->disable_feed();

		if ( file_exists( $this->path ) ) {

			if ( get_option('mmp_http_503') === '1' ) {

				header('HTTP/1.1 503 Service Temporarily Unavailable');
				header('Status: 503 Service Temporarily Unavailable');
				header('Retry-After: 3600');

			}

			$cd_date = '';

			$cd_hr_min = '';

			$dateTime = esc_attr(get_option('mmp_set_dateTime'));
			
			if ( $dateTime !== '' ) {
				
				$cd_date = $dateTime;
				
				$cd_date = str_replace( '-' , '/', $cd_date);
			
			}

			include( $this->path );

			exit();

		}

	}

	function disable_feed() {

		add_action('do_feed', array( $this, 'disable_feed_message' ), 1);
		add_action('do_feed_rdf', array( $this, 'disable_feed_message' ), 1);
		add_action('do_feed_rss', array( $this, 'disable_feed_message' ), 1);
		add_action('do_feed_rss2', array( $this, 'disable_feed_message' ), 1);
		add_action('do_feed_atom', array( $this, 'disable_feed_message' ), 1);
		add_action('do_feed_rss2_comments', array( $this, 'disable_feed_message' ), 1);
		add_action('do_feed_atom_comments', array( $this, 'disable_feed_message' ), 1);

	}

	function disable_feed_message() {

		wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );

	}

	function _content( $content ) {

		if ( ! isset( $content_width ) )
			$content_width = 750;
		
		global $wp_embed;

		$content = $wp_embed->autoembed( $content );
    	$content = $wp_embed->run_shortcode( $content );
    	$content = do_shortcode( $content );
    	$content = wpautop( $content );

		return $content;
	}

	function add_settings_tab( $tabs ) {}

	function settings_get_tab( $tab ) {}

	function save_settings($tab){}
	function get_settings() { return array(); }

	function filter_settings( $settings ) {

		$settings[$this->id] = $this->get_settings();

		return $settings;

	}

	function add_styles() {

		include wpmmp_settings_part( 'add-styles' );

	}

	function hook_to_head() {

		include wpmmp_settings_part( 'add-hooktohead' );

	}

	function store_email() {

		usleep( 500 );

		error_reporting(0);

		if ( ! wp_verify_nonce( $_POST['wpmmp_email_manager_nonce'], 
			'wpmmp_email_manager_nonce' ) ) {
			$response = array(
					'valid' => 0,
					'message' => 'Error ' . ' - ' .  'Invalid Nonce'
				);

			exit( json_encode( $response ) );
		}

		if ( ! isset( $_POST['name'] ) )
			$_POST['name'] = '';

		$email = $_POST['email'];

		$name = $_POST['name'];

		if ( ! is_email( $email ) ) {

			$response = array(
					'valid' => 0,
					'message' => 'Error ' . ' - ' .  'Invalid email address'
				);

			exit( json_encode( $response ) );

		}

		wpmmp_include( '/libs/MCAPI.class.php' );

		$api_key = get_option( 'mmp_mc_api' );
		
		$list_id = get_option( 'mmp_mc_listid' );

		$api = new Wpmmp_MCAPI( $api_key );

		list($fname,$lname) = preg_split('/\s+(?=[^\s]+$)/', $name, 2); 
		
		$merge_vars = array(
			'FNAME' => $fname, 
			'LNAME' => $lname
		);

		$retval = $api->listSubscribe( $list_id, $email, $merge_vars, 'html' );

		if( $api->errorCode ) {

			$response = array(
					'valid' => 0,
					'message' => 'Error ' . ' - ' .  $api->errorMessage
				);

			exit( json_encode( $response ) );

		}

		$response = array(
					'valid' => 1,
					'message' => 'Email submitted successfully!'
				);
		
		exit( json_encode( $response ) );

	}

	function add_email_form($center=false) {

		include wpmmp_settings_part( 'add-email-form' );

	}

	function add_social_icons($center=false) {

		include wpmmp_settings_part( 'add-social-icons' );

	}

}