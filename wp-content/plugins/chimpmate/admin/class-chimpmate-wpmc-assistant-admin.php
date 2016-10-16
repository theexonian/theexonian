<?php
/** 
 * ChimpMate - WordPress MailChimp Assistant
 *
 * @package   ChimpMate - WordPress MailChimp Assistant
 * @author    Voltroid<care@voltroid.com>
 * @license   GPL-2.0+
 * @link      http://voltroid.com/chimpmate
 * @copyright 2015 Voltroid
 */

/**
 *
 * @package   ChimpMate - WordPress MailChimp Assistant
 * @author    Voltroid<care@voltroid.com>
 * 
 */
class ChimpMate_WPMC_Assistant_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * @since     1.0.0
	 */
	private function __construct() {

		$this->plugin = ChimpMate_WPMC_Assistant::get_instance();
		$this->plugin_slug = $this->plugin->get_plugin_slug();
		$this->wpmchimpa = $this->plugin->wpmchimpa;

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		$plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		add_action( 'admin_head', array( $this,'admin_css' ));
		
		add_action('wp_ajax_wpmchimpa_us_ajax', array( $this, 'wpmchimpa_update_setting' ) );
		add_action('wp_ajax_wpmchimpa_secure', array( $this, 'wpmchimpa_secure' ) );
		add_action('wp_ajax_wpmchimpa_syncom', array( $this, 'wpmchimpa_syncom' ) );
		add_action('wp_ajax_wpmchimpa_synreg', array( $this, 'wpmchimpa_synreg' ) );

		add_action('wp_ajax_wpmchimpa_load_list', array( $this, 'wpmchimpa_load_list' ) );
		add_action('wp_ajax_wpmchimpa_load_field', array( $this, 'wpmchimpa_load_field' ) );
 		add_action('wp_ajax_wpmchimpa_prev_ajax', array( $this, 'wpmchimpa_prev' ) );
 		add_action('wp_ajax_wpmchimpa_tab', array( $this, 'wpmchimpa_tab' ) );
	}
	/**
	 * ajax call to update settings
	 * @since    1.0.0
	 * 
	 */
	public function wpmchimpa_update_setting(){
		$_POST = stripslashes_deep( $_POST );
		$settings_array = array_filter((array) json_decode($_POST['data']),array($this , 'myFilter'));
		$settings_array['theme'] = (array)$settings_array['theme'];
		foreach ($settings_array['theme'] as $key => $value)
			$settings_array['theme'][$key] = array_filter((array) $value,array($this , 'myFilter'));
		$wpmchimpa = $this->wpmchimpa;
		if (function_exists('curl_init') && function_exists('curl_setopt')){
			$up=0;if(function_exists('curl_init')){if(isset($settings_array['get_email_update'])){if(!isset($wpmchimpa['get_email_update']) || (isset($wpmchimpa['get_email_update']) && $settings_array['email_update'] != $wpmchimpa['email_update'])){$up=1;}}else{if(isset($wpmchimpa['get_email_update'])){$up=2;}}if($up>0){$curl = curl_init();curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1,CURLOPT_URL => 'http://voltroid.com/chimpmate/api.php',CURLOPT_REFERER => home_url(),CURLOPT_POST => 1));if($up==1)curl_setopt($curl, CURLOPT_POSTFIELDS, array('action' => 'subs','email' => $settings_array['email_update']));else curl_setopt($curl, CURLOPT_POSTFIELDS, array('action' => 'unsubs'));$res=curl_exec($curl);curl_close($curl);}}		
		}
		$json = json_encode($settings_array);
		update_option('wpmchimpa_options',$json);
		die('1');
	}

	function myFilter($var){return ($var !== NULL && $var !== FALSE && $var !== '');}
	/**
	 * ajax call for 1 Click Backup and Restore
	 * @since    1.0.0
	 * 
	 */
	public function wpmchimpa_secure(){
		if ( !is_super_admin()) die();
		if($_REQUEST['q']=='backup'){
			$wpmchimpa = $this->wpmchimpa;
			header('Content-disposition: attachment; filename=ChimpMate_Backup-'.date('Y-m-d H:i:s').'.json');
			header('Content-Type: application/json');
			echo json_encode($wpmchimpa);
		}
		else if ($_REQUEST['q'] == 'restore'){
				$json = json_encode($_REQUEST['data']);
				update_option('wpmchimpa_options',$json);
		}
		else if ($_REQUEST['q'] == 'reset'){
			$json=file_get_contents(WPMCA_PLUGIN_PATH.'src/default.json');
				update_option('wpmchimpa_options',$json);
		}
		die();
	}
	/**
	 * ajax call to load list
	 * @since    1.0.3
	 * 
	 */
	public function wpmchimpa_load_list(){
		$_POST = stripslashes_deep( $_POST );
		$api = $_POST['api_key'];
		$MailChimp = new ChimpMate_WPMC_MailChimp($api);
		$result=$MailChimp->get('/lists/?count=50&offset=0');
		if($result['total_items'] == 0){
			$lists =array("stat" => "0");
	    }
	   else{
	   		$list = array();
	   		foreach($result['lists'] as $mclist){
					array_push($list, array(
							"id" => $mclist['id'],
							"name" => $mclist['name']));
			}
	   		for($i=50;$result['total_items'] > 50;$i+=50,$result['total_items']-=50){
				$res=$MailChimp->get('/lists/?count=50&offset='.$i);
		   		foreach($res['lists'] as $mclist){
						array_push($list, array(
								"id" => $mclist['id'],
								"name" => $mclist['name']));
				}
	   		}
			$lists =array("stat" => "2", 
				"lists" => $list);
	   }
	   print(json_encode($lists));
	   die();
	}
	/**
	 * Ajax call to retrieve fields
	 * @since    1.0.3
	 * 
	 */
	public function wpmchimpa_load_field(){
		$_POST = stripslashes_deep( $_POST );
		$api = $_POST['api_key'];
		$list = $_POST['list'];
		$MailChimp = new ChimpMate_WPMC_MailChimp($api);
		print(json_encode(array_merge($this->retrieve_groups($list,$MailChimp), $this->retrieve_fields($list,$MailChimp))));
		die();
	}
	function retrieve_groups($list,$MailChimp){
		$groups_result =  $MailChimp->get('/lists/'.$list.'/interest-categories?count=50');
		$groups = array();
		if($groups_result['total_items'] > 0){
			foreach ($groups_result['categories'] as $grouping) {
				if($grouping['type'] == 'hidden')continue;
				$g = array();
				$g['id'] = $grouping['id'];
				$g['name'] = $grouping['title'];
				$g['label'] = $grouping['title'];
				$g['type'] = $grouping['type'];
				$g['cat'] = 'group';
				$s = array();
				$res = $MailChimp->get('/lists/'.$list.'/interest-categories/'.$grouping['id'].'/interests');
				foreach ($res['interests'] as $group) {
					$t = array();
					$t['id']=$group['id'];
					$t['gname']=$group['name'];
					array_push($s, $t);
				}
				$g['groups'] = $s;
				array_push($groups,$g);
			}
		}
		return $groups;
	}

	function retrieve_fields($list,$MailChimp){
		$groups_result =  $MailChimp->get('/lists/'.$list.'/merge-fields?count=50');
		$groups = array(array("name"=>"Email address","icon"=>"idef","label"=>"Email address","tag"=>"email","type"=>"email","req"=>true,"cat"=>"field"));
		if($groups_result['total_items'] > 0){
			foreach ($groups_result['merge_fields'] as $grouping) {
				if($grouping['type'] == 'address')continue;
				$g = array();
				$g['name'] = $grouping['name'];
				$g['icon'] = 'idef';
				$g['label'] = $grouping['name'];
				$g['tag'] = $grouping['tag'];
				$g['type'] = $grouping['type'];
				$g['opt'] = $grouping['options'];
				$g['req'] = $grouping['required'];
				$g['cat'] = 'field';
				array_push($groups,$g);
			}
		}
		return $groups;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', WPMCA_PLUGIN_URL. 'admin/assets/css/admin.css', array(), ChimpMate_WPMC_Assistant::VERSION );
			wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Roboto:300');
            wp_enqueue_style( 'googleFonts');
        }

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {

			$wpmchimpa = $this->wpmchimpa;
			$opt['goog_fonts']=json_decode(file_get_contents(WPMCA_PLUGIN_PATH.'src/google_fonts.json'),true);
			$opt['web_fonts']=$this->plugin->webfont();
			$opt['svglist']=$this->plugin->svglist();
			$opt['iconlist']=$this->plugin->iconlist();
			wp_enqueue_script('jquery');
			wp_enqueue_script( $this->plugin_slug . '-admin-script', WPMCA_PLUGIN_URL. 'admin/assets/js/admin.js', array( 'jquery'), ChimpMate_WPMC_Assistant::VERSION );
			wp_localize_script( $this->plugin_slug . '-admin-script', 'wpmchimpa', $wpmchimpa );
			wp_localize_script( $this->plugin_slug . '-admin-script', 'wpmcopt', $opt );
			wp_enqueue_script( $this->plugin_slug . '-admin-script1', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.8/angular.min.js', ChimpMate_WPMC_Assistant::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-admin-script2', 'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', ChimpMate_WPMC_Assistant::VERSION );
			wp_enqueue_script( $this->plugin_slug . '-admin-script3', 'https://www.google.com/jsapi', ChimpMate_WPMC_Assistant::VERSION );
			wp_enqueue_media();
		}

	}

	/**
	 * voltroid admin panel icon
	 * @since    1.0.0
	 * 
	 */
	public function admin_css() { ?>
	<style>@font-face {font-family: "vapanel_fonts";src:url("<?php echo WPMCA_PLUGIN_URL;?>assets/fonts/vapanel_fonts.eot");src:url("<?php echo WPMCA_PLUGIN_URL;?>assets/fonts/vapanel_fonts.eot?#iefix") format("embedded-opentype"),url("<?php echo WPMCA_PLUGIN_URL;?>assets/fonts/vapanel_fonts.woff") format("woff"),url("<?php echo WPMCA_PLUGIN_URL;?>assets/fonts/vapanel_fonts.ttf") format("truetype"),url("<?php echo WPMCA_PLUGIN_URL;?>assets/fonts/vapanel_fonts.svg#vapanel_fonts") format("svg");font-weight: normal;font-style: normal;}#toplevel_page_chimpmate .wp-menu-image::before{content :'\c032';font-family: "vapanel_fonts"!important;font-size:17px;}</style>
	<?php }
	
	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'ChimpMate - WP MailChimp Assistant', $this->plugin_slug ),
			__( 'ChimpMate', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' ),
			'none' , 85
		);
		add_submenu_page( 
			$this->plugin_slug,
			$this->plugin_slug,
			$this->plugin_slug,
			'manage_options',
		  $this->plugin_slug,
			array( $this, 'display_plugin_admin_page' ));
		remove_submenu_page( $this->plugin_slug, $this->plugin_slug );
		add_submenu_page( 
			$this->plugin_slug,
		  'General',
		  'General',
			'manage_options',
		  $this->plugin_slug.'#general',
			array( $this, 'display_plugin_admin_page' ));
		add_submenu_page( 
			$this->plugin_slug,
		  'Lightbox',
		  'Lightbox',
			'manage_options',
		  $this->plugin_slug.'#lightbox',
			array( $this, 'display_plugin_admin_page' ));
		add_submenu_page( 
			$this->plugin_slug,
		  'Slider',
		  'Slider',
			'manage_options',
		  $this->plugin_slug.'#slider',
			array( $this, 'display_plugin_admin_page' ));
		add_submenu_page( 
			$this->plugin_slug,
		  'Widget',
		  'Widget',
			'manage_options',
		  $this->plugin_slug.'#widget',
			array( $this, 'display_plugin_admin_page' ));
		add_submenu_page( 
			$this->plugin_slug,
		  'Addon',
		  'Addon',
			'manage_options',
		  $this->plugin_slug.'#addon',
			array( $this, 'display_plugin_admin_page' ));
		add_submenu_page( 
			$this->plugin_slug,
		  'Advanced',
		  'Advanced',
			'manage_options',
		  $this->plugin_slug.'#advanced',
			array( $this, 'display_plugin_admin_page' ));
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}
	public function wpmchimpa_prev(){
		include_once( 'includes/'.$_GET['type'].$_GET['theme'].'.php' );
		die();
	}
	public function wpmchimpa_tab(){
		$tab = $_GET['tab'];
		include_once( 'views/admin_opt.php' );
		die();
	}
	public function wpmchimpa_syncom(){
		$emails = array();
		foreach (get_comments() as $comment){
			array_push($emails, array('email' => array('email'=>$comment->comment_author_email)));
		}
		if(empty($emails))die('1');
		$this->wpmchimpa_batchsubs($emails);
	}
	public function wpmchimpa_synreg(){
		$emails = array();
		foreach ( get_users() as $user ) {
			if(isset($_GET['role']) && in_array($user->roles[0], $_GET['role']))
				array_push($emails, array('email' => array('email'=>$user->user_email)));
		}
		if(empty($emails))die('0');
		$this->wpmchimpa_batchsubs($emails);
	}
	public function wpmchimpa_batchsubs($emails){
		$api = $_GET['api'];
		$list = $_GET['list'];
		if(empty($api) || empty($list)){ die("0");}
		$MailChimp = new ChimpMate_WPMC_MailChimp1($api);
		$opt_in = $this->wpmchimpa['opt_in'];
		$options =array(
                'id'                => $list,
                'batch'             => $emails,
                'double_optin'      => $_GET['optin'],
                'update_existing'   => false
            );
		$result = $MailChimp->call('/lists/batch-subscribe', $options);
		if( $result['status'] === 'error' ) {
			echo json_encode($result);
		}
		else{
			echo 1;
		}
		die();
	}
}