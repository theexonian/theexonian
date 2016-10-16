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
class ChimpMate_WPMC_Assistant {
	/**
	 * @since   1.0.0
	 *
	 * @var      string
	 */
	const VERSION = '1.2.7';

	/**
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'chimpmate';

	/**
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * @since     1.0.0
	 */

	public $wpmchimpa;

	private function __construct() {
		$this->wpmchimp_update_db_check();
		$this->wpmchimpa = stripslashes_deep(json_decode(get_option('wpmchimpa_options'),true));
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		add_action( 'template_redirect', array( $this, 'chimpmate_loader' ) );

		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'wp_footer', array( $this, 'wpmchimpa_show' ) );
		add_action( 'wp_footer', array( $this, 'wpmchimpa_topbar' ) );
		add_action( 'wp_footer', array( $this, 'wpmchimpa_flipbox' ) );
		add_action( 'wp_head', array( $this, 'wpmchimpa_slide' ) );
		add_action( 'wp_footer', array( $this, 'wpmchimpa_social' ) );
		add_action( 'init', array($this,'register_shortcodes'));
		add_filter( 'comment_form_field_comment', array($this,'wpmchimpa_commentfield' ));
		add_action( 'comment_post', array($this,'wpmchimpa_commentpost' ));

		add_action( 'register_form', array($this,'wpmchimpa_regfield' ));
		add_action( 'user_register',array($this,'wpmchimpa_regpost' ));

		add_action('wp_ajax_wpmchimpa_add_email_ajax',  array( $this, 'wpmchimpa_add_email' ));
		add_action('wp_ajax_nopriv_wpmchimpa_add_email_ajax',  array( $this, 'wpmchimpa_add_email' )); 

		add_action('wp_ajax_wpmchimpa_setcookie_ajax',  array( $this, 'wpmchimpa_setcookie' ));
		add_action('wp_ajax_nopriv_wpmchimpa_setcookie_ajax',  array( $this, 'wpmchimpa_setcookie' ));

		add_filter('the_content', array( $this, 'addon_adder'));

		
		if(isset($this->wpmchimpa["widget"])){
			add_action( 'widgets_init', create_function( '', 'register_widget("ChimpMate_WPMC_Assistant_Widget");' ) );
		}
	}
	public static function wpmchimp_update_db_check(){
		$wpmchimpa=json_decode(get_option('wpmchimpa_options'),true);

		if(isset($wpmchimpa['list_record'])){
			$oldlist = $wpmchimpa['list_record'];
			$namebox=(isset($wpmchimpa['namebox']))?true:false;;
			$labelnb=(isset($wpmchimpa['labelnb']))?$wpmchimpa['labelnb']:'Name';
			$labeleb=(isset($wpmchimpa['labeleb']))?$wpmchimpa['labeleb']:'Email';
			$f=array();
			$list = '[{"id": 1,"name": "Form 1","fields": [';
			if($namebox)
				array_push($f, '{"name": "First Name","icon": "idef","label": "'.$labelnb.'","tag": "FNAME","type": "text","opt": {"size": 25},"req": false,"cat": "field","uid": 1}');
			array_push($f, '{"name": "Email address","icon": "idef","label": "'.$labeleb.'","tag": "email","type": "email","req": true,"cat": "field","uid": 2}');
			if(isset($oldlist['groups'])){
				foreach ( $oldlist['groups'] as $k => $v) {
					$l = '{"id": "'.$v['id'].'","name": "'.$v['group_name'].'","label": "","type": "checkboxes","cat": "group","groups": [';
			        $g=array();
			        foreach ($v['groups'] as $w) {
			        	array_push($g, '{"id": "'.$w['id'].'","gname": "'.$w['gname'].'"}');
			        }
			        $l.=implode(",", $g).'],"uid": '.($k+3).'}';
				}
				array_push($f, $l);
			}
			$list.=implode(",", $f).'],"list": {"id": "'.$oldlist['id'].'","name": "'.$oldlist['list_name'].'"}}]';
			$wpmchimpa['cforms'] = json_decode($list,true);
			unset($wpmchimpa['list_record'],$wpmchimpa['labelnb'],$wpmchimpa['labeleb'],$wpmchimpa['namebox']);
			update_option('wpmchimpa_options',json_encode($wpmchimpa));
		}
	}
	public function wpmchimp_update_procedure(){
		$opt = $this->wpmchimpa;
		update_option('wpmchimpa_options',json_encode($opt));
	}
	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();

					restore_current_blog();
				}

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

					restore_current_blog();

				}

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}
	public function chimpmate_loader(){
		if(isset($this->wpmchimpa["litebox"]) && $this->wpmchimpa_user_status() && $this->wpmchimpa_referral() && $this->wpmchimpa_pagetype('l'))
			$this->isload['l']=true;
		if(isset($this->wpmchimpa["slider"]) && $this->wpmchimpa_pagetype('s') && $this->wpmchimpa_user_status() && $this->wpmchimpa_referral())
			$this->isload['s']=true;
		if(isset($this->wpmchimpa["addon"]) && $this->wpmchimpa_user_status() && $this->wpmchimpa_referral() && $this->wpmchimpa_pagetype_addon())
			$this->isload['a']=true;
		if(isset($this->wpmchimpa["flipbox"]) && $this->wpmchimpa_pagetype('f'))
			$this->isload['f']=true;
		if(isset($this->wpmchimpa["topbar"]) && $this->wpmchimpa_pagetype('t'))
			$this->isload['t']=true;
		if(isset($this->wpmchimpa["widget"]))
			$this->isload['w']=true;

	}
	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		$goo_fonts =array();
		$fonts = array('lite_heading_f','lite_msg_f','lite_tbox_f','lite_check_f','lite_button_f','lite_status_f','lite_tag_f','lite_soc_f','slider_heading_f','slider_msg_f','slider_tbox_f','slider_check_f','slider_button_f','slider_status_f','slider_tag_f','slider_soc_f','widget_msg_f','widget_tbox_f','widget_check_f','widget_button_f','widget_status_f','widget_soc_f','addon_heading_f','addon_msg_f','addon_tbox_f','addon_check_f','addon_button_f','addon_status_f','addon_soc_f');

		foreach ($fonts as $font) {
			switch ($font[0]) {
				case 's':$t=$this->wpmchimpa['slider_theme'];
					break;
				case 'l':$t=$this->wpmchimpa['litebox_theme'];
					break;
				case 'a':$t=$this->wpmchimpa['addon_theme'];
					break;
				case 'w':$t=$this->wpmchimpa['widget_theme'];
					break;
			}
			if (isset($this->wpmchimpa['theme'][$font[0].$t][$font]) && !in_array($this->wpmchimpa['theme'][$font[0].$t][$font], $this->webfont()))array_push($goo_fonts, $this->wpmchimpa['theme'][$font[0].$t][$font]);
		}
		if(!empty($goo_fonts)){
			$goo = implode('|', array_values(array_unique($goo_fonts)));
			wp_register_style($this->plugin_slug . '-googleFonts', '//fonts.googleapis.com/css?family='.$goo, array(), self::VERSION);
		}

	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.4
	 */
	public function enqueue_scripts() {
		wp_register_script( $this->plugin_slug . '-plugin-script', WPMCA_PLUGIN_URL. 'public/assets/js/public.js', array( 'jquery' ), self::VERSION );

	}
	public function loadscripts(){
		if(isset($this->scriptsloaded))return false;
		$this->scriptsloaded=true;
		echo'<style type="text/css">.wpmchimpa-reset,.wpmchimpa-reset div,.wpmchimpa-reset span,.wpmchimpa-reset h1,.wpmchimpa-reset h2,.wpmchimpa-reset h3,.wpmchimpa-reset h4,.wpmchimpa-reset h5,.wpmchimpa-reset h6,.wpmchimpa-reset p,.wpmchimpa-reset a,.wpmchimpa-reset img,.wpmchimpa-reset fieldset,.wpmchimpa-reset form,.wpmchimpa-reset label,.wpmchimpa-reset legend,.wpmchimpa-reset table,.wpmchimpa-reset caption,.wpmchimpa-reset tbody,.wpmchimpa-reset tfoot,.wpmchimpa-reset thead,.wpmchimpa-reset tr,.wpmchimpa-reset th,.wpmchimpa-reset td,.wpmchimpa-reset button,.wpmchimpa-reset button:hover,.wpmchimpa-reset button:active,.wpmchimpa-reset button:focus {margin: 0;padding: 0;border: 0;font: inherit;font-size: 100%;font-weight: normal;color: #000;background: 0;vertical-align: baseline;box-sizing: border-box;float: none;letter-spacing:0;}.wpmchimpa-reset table {border-collapse: collapse;border-spacing: 0;border-bottom: 0;border: 0;}.wpmchimpa-reset ol,.wpmchimpa-reset ul {list-style: none;}.wpmchimpa-reset caption,.wpmchimpa-reset th {text-align: left;}.wpmchimpa-reset input,.wpmchimpa-reset label {display: block;}.wpmchimpa-reset button,.wpmchimpa-reset button:hover,.wpmchimpa-reset input,.wpmchimpa-reset input:focus,.wpmchimpa-reset textarea,.wpmchimpa-reset select {margin: 0;padding: 0;max-width: 100%;border: 0;font-family:"Times New Roman", Times, serif;font-size: 100%;outline: 0;color: #000;-webkit-appearance: none;-webkit-border-radius: 0;-moz-appearance: none;-moz-border-radius: 0;-ms-appearance: none;-ms-border-radius: 0;-o-appearance: none;-o-border-radius: 0;appearance: none;border-radius: 0;opacity: 1;-webkit-box-shadow:none;-moz-box-shadow:none;-ms-box-shadow:none;-o-box-shadow:none;box-shadow:none;clear:both;text-decoration:none;text-shadow:none;box-sizing: border-box;float: none;}.wpmchimpa-reset input:focus,.wpmchimpa-reset textarea:focus {border: 0;-webkit-border-radius: 0;-moz-border-radius: 0;-ms-border-radius: 0;-o-border-radius: 0;border-radius: 0;padding: 0;outline: 0;-webkit-appearance: none;}.wpmchimpa-reset button,.wpmchimpa-reset input {line-height: normal;}.wpmchimpa-reset th,.wpmchimpa-reset tr,.wpmchimpa-reset td {border-top: 0;border-bottom: 0;border: 0 !important;}.wpmcerrora{-webkit-animation: wpmcshake .5s linear;animation: wpmcshake .5s linear;}@-webkit-keyframes wpmcshake {8%, 41% {-webkit-transform: translateX(-10px);}25%, 58% {-webkit-transform: translateX(10px);}75% {-webkit-transform: translateX(-5px);}92% {-webkit-transform: translateX(5px);}0%, 100% {-webkit-transform: translateX(0);}}@keyframes wpmcshake {8%, 41% {transform: translateX(-10px);}25%, 58% {transform: translateX(10px);}75% {transform: translateX(-5px);}92% {transform: translateX(5px);}0%, 100% {transform: translateX(0);}}</style>';
		wp_enqueue_style( $this->plugin_slug . '-googleFonts');
		wp_enqueue_script('jquery');
		wp_enqueue_script( $this->plugin_slug . '-plugin-script');
			$opts = $this->wpmchimpa;
			unset($opts['theme'],$opts['api_key']);
			unset($opts['theme'],$opts['cforms']);
			$opts['ajax_url'] = admin_url('admin-ajax.php');
			wp_localize_script( $this->plugin_slug . '-plugin-script', 'wpmchimpa', $opts );
	}
public function webfont(){
return array("Georgia, serif","Palatino Linotype, Book Antiqua, Palatino, serif","Times New Roman, Times, serif","Arial, Helvetica, sans-serif","Arial Black, Gadget, sans-serif","Comic Sans MS, cursive, sans-serif","Impact, Charcoal, sans-serif","Lucida Sans Unicode, Lucida Grande, sans-serif","Open Sans, sans-serif","Tahoma, Geneva, sans-serif","Trebuchet MS, Helvetica, sans-serif","Verdana, Geneva, sans-serif","Courier New, Courier, monospace","Lucida Console, Monaco, monospace");
}
	/**
	 * Show Popup
	 * @since    1.0.0
	 */
public function wpmchimpa_show() {
	if(isset($this->isload['l'])){
		$this->loadscripts();
		include_once( 'views/public.php' );
	}
}
public function wpmchimpa_slide() {	
	if(isset($this->isload['s'])){
		$this->loadscripts();
		include_once( 'includes/slide_content.php');
	}
}
public function wpmchimpa_topbar(){
	if(isset($this->isload['t'])){
		$this->loadscripts();
		include_once( 'includes/topbar_content.php');
	}
}
public function wpmchimpa_flipbox(){
	if(isset($this->isload['f'])){
		$this->loadscripts();
		include_once( 'includes/flipbox_content.php');
	}
}
public function wpmchimpa_social(){

		$t=array('l1','w1','a1','s1','l8','w8','a8','s8');
	$n=false;

	if(in_array('l'.$this->wpmchimpa['litebox_theme'], $t) && !isset($this->wpmchimpa['theme']['l'.$this->wpmchimpa['litebox_theme']]['lite_dissoc']) && isset($this->wpmchimpa["litebox"])) {
		$n=true;
	}
	else if(in_array('w'.$this->wpmchimpa['widget_theme'], $t) && !isset($this->wpmchimpa['theme']['w'.$this->wpmchimpa['widget_theme']]['widget_dissoc']) && isset($this->wpmchimpa["widget"])) {
		$n=true;
	}
	else if(in_array('a'.$this->wpmchimpa['addon_theme'], $t) && !isset($this->wpmchimpa['theme']['a'.$this->wpmchimpa['addon_theme']]['addon_dissoc']) && isset($this->wpmchimpa["addon"])) {
		$n=true;
	}
	else if(in_array('s'.$this->wpmchimpa['slider_theme'], $t) && !isset($this->wpmchimpa['theme']['s'.$this->wpmchimpa['slider_theme']]['slider_dissoc']) && isset($this->wpmchimpa["slider"])) {
		$n=true;
	}

	if($n){
		if(isset($this->wpmchimpa['fb_api'])){
			?>
			<script>
			window.fbAsyncInit = function() {
			  FB.init({
			  appId      : '<?php echo $this->wpmchimpa["fb_api"];?>',
			cookie : false, xfbml : true, version : 'v2.2'});};(function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js"; fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
			</script>
			<?php
		}
		if(isset($this->wpmchimpa['gp_api'])){
			?>
			<meta name="google-signin-clientid" content="<?php echo $this->wpmchimpa["gp_api"];?>" />
			<meta name="google-signin-scope" content="profile" /><meta name="google-signin-scope" content="email" /><meta name="google-signin-cookiepolicy" content="single_host_origin" /><script src="https://apis.google.com/js/client:platform.js?onload=render" async defer></script>
			<?php
		}
		if(isset($this->wpmchimpa['ms_api'])){
			?>
			<script type="text/javascript" src="//js.live.net/v5.0/wl.js"></script>
			<script type="text/javascript">
			WL.init({
			    client_id: '<?php echo $this->wpmchimpa["ms_api"];?>',
			    redirect_uri: "<?php echo plugins_url( 'assets/ms-oauth.php', dirname(__FILE__) );?>"
			});
			</script>
			<?php
		}
	}
}

	/**
	 * 
	 * @since    1.0.0
	 * @var boolean visitors pagetype for popup
	 */
function wpmchimpa_pagetype($e){
	switch ($e) {
		case 'l':
			if(isset($this->wpmchimpa["lite_homepage"]) && is_front_page()) return true;
			else if(isset($this->wpmchimpa["lite_blog"]) && !is_front_page() && is_home()) return true;
			else if(isset($this->wpmchimpa["lite_page"]) && is_page()) return true;
			else if(isset($this->wpmchimpa["lite_post"]) && is_single()) return true;
			else if(isset($this->wpmchimpa["lite_category"]) && is_archive()) return true;
			else if(isset($this->wpmchimpa["lite_search"]) && is_search()) return true;
			else if(isset($this->wpmchimpa["lite_404error"]) && is_404()) return true;
			break;
		case 's':
			if(isset($this->wpmchimpa["slider_homepage"]) && is_front_page()) return true;
			else if(isset($this->wpmchimpa["slider_blog"]) && !is_front_page() && is_home()) return true;
			else if(isset($this->wpmchimpa["slider_page"]) && is_page()) return true;
			else if(isset($this->wpmchimpa["slider_post"]) && is_single()) return true;
			else if(isset($this->wpmchimpa["slider_category"]) && is_archive()) return true;
			else if(isset($this->wpmchimpa["slider_search"]) && is_search()) return true;
			else if(isset($this->wpmchimpa["slider_404error"]) && is_404()) return true;
			break;	
		case 't':
			if(isset($this->wpmchimpa["topbar_homepage"]) && is_front_page()) return true;
			else if(isset($this->wpmchimpa["topbar_blog"]) && !is_front_page() && is_home()) return true;
			else if(isset($this->wpmchimpa["topbar_page"]) && is_page()) return true;
			else if(isset($this->wpmchimpa["topbar_post"]) && is_single()) return true;
			else if(isset($this->wpmchimpa["topbar_category"]) && is_archive()) return true;
			else if(isset($this->wpmchimpa["topbar_search"]) && is_search()) return true;
			else if(isset($this->wpmchimpa["topbar_404error"]) && is_404()) return true;
			break;	
		case 'f':
			if(isset($this->wpmchimpa["flipbox_homepage"]) && is_front_page()) return true;
			else if(isset($this->wpmchimpa["flipbox_blog"]) && !is_front_page() && is_home()) return true;
			else if(isset($this->wpmchimpa["flipbox_page"]) && is_page()) return true;
			else if(isset($this->wpmchimpa["flipbox_post"]) && is_single()) return true;
			else if(isset($this->wpmchimpa["flipbox_category"]) && is_archive()) return true;
			else if(isset($this->wpmchimpa["flipbox_search"]) && is_search()) return true;
			else if(isset($this->wpmchimpa["flipbox_404error"]) && is_404()) return true;
			break;	
	}
	return false;
}
	/**
	 * 
	 * @since    1.0.0
	 * @var boolean visitors pagetype for addon
	 */
function wpmchimpa_pagetype_addon(){
	
	if(isset($this->wpmchimpa["addon_page"]) && is_page()) return true;
	else if(isset($this->wpmchimpa["addon_post"]) && is_single()) return true;
	return false;
}
	/**
	 * 
	 * @since    1.0.0
	 * @var boolean visitors login status
	 */
function wpmchimpa_user_status() {
	
	if(!isset($this->wpmchimpa["loggedin"]) && !isset($this->wpmchimpa["notloggedin"])) return false;
	if(!isset($this->wpmchimpa["loggedin"]) && isset($this->wpmchimpa["notloggedin"]) && is_user_logged_in()) return false;
	if(isset($this->wpmchimpa["loggedin"]) && !isset($this->wpmchimpa["notloggedin"]) && !is_user_logged_in()) return false;
	if(is_single() && is_user_logged_in()){
		$comm = get_comments( array('post_id' => get_the_ID(),'user_id' => get_current_user_id()));
		if(!isset($this->wpmchimpa["commented"]) && !isset($this->wpmchimpa["notcommented"])) return false;
		if(!isset($this->wpmchimpa["commented"]) && isset($this->wpmchimpa["notcommented"]) && !empty($comm)) return false;
		if(isset($this->wpmchimpa["commented"]) && !isset($this->wpmchimpa["notcommented"]) && empty($comm)) return false;
	}
	return true;
}
	/**
	 * 
	 * @since    1.0.0
	 * @var boolean visitors referrer
	 */
function wpmchimpa_referral() {
	if(!isset($_SERVER["HTTP_REFERER"]))return true;
	$referrer = $_SERVER["HTTP_REFERER"];
	if(isset($this->wpmchimpa["searchengine"])){
		$organic_sources = array('www.google' => '',
	           'bing.com/' => array('q='),
	           'search.yahoo.com' => '',
	           'ask.com/' => array('q='),
	           'search.aol.com/' => array('query=', 'encquery=','q='),
	           'wow.com/' => array('q='),
	           'webcrawler.com/' => array('q='),
	           'search.mywebsearch.com/' => array('searchfor='),
	           'search.infospace.com/' => array('q='),
	           'info.com/' => array('qkw='),
	           'duckduckgo.com/' => '',
	           'entireweb.com/' => '',
	           'blekko.com/' => '',
	           'contenko.com/' => '',
	           'dogpile.com/' => array('q='),
	           'alhea.com/' => array('q='),
	           'daum.net/' => array('q='),
	           'lycos.com/' => array('q='),
	           'mamma.com/' => array('query='),
	           'search.virgilio.it/' => array('qs='),
	           'baidu.com/' => array('wd='),
	           'alice.com/' => array('qs='),
	           'yandex.com/' => array('text='),
	           'seznam.cz/' => array('q='),
	           'search.com/' => array('q='),
	           'wp.pl/' => array('q='),
	           'yam.com/' => array('q='),
	           'kvasir.no/' => array('q='),
	           'mynet.com/' => array('query='),
	           'rambler.ru/' => array('query=')
	     );
		foreach($organic_sources as $searchEngine => $queries) {
	        if (strpos($referrer, $searchEngine) !== false) {
	        		if(is_array($queries)){
		                foreach ($queries as $query) {
		                        if (strpos($referrer, $query) !== false) {
		                                return true;
		                        }
		                }
		            }
		            else return true;
	        }
	    }
	    return false;
	}
	return true;
}

	/**
	 * Ajax call to add email to list
	 * @since    1.0.2
	 * 
	 */
	public function wpmchimpa_add_email($a)
	{	
		$_POST = stripslashes_deep( $_POST );
		$settings=$this->wpmchimpa;
		$api = $settings['api_key'];
		$form = $this->getformbyid($_POST['wpmcform']);
		$list = $form['list']['id'];
		if(empty($api) || empty($list)){ if($a == 1)return;die("0");}
		$MailChimp = new ChimpMate_WPMC_MailChimp($api);
		$email=$_POST['email'];
		$merge=$_POST['merge_fields'];
		$interests = array();
		if(isset($_POST['group'])){
			foreach ($_POST['group'] as $v) {
				if($v)$interests[$v]=true;
			}
		}
		$set = array(
		    'email_address' => $email,
		    'status' => (isset($settings['opt_in']))?'pending':'subscribed'
		);
		if(!empty($interests))$set['interests']=$interests;
		if(!empty($merge))$set['merge_fields']=$merge;
		$result = $MailChimp->post('/lists/'.$list.'/members',$set);
		if( $result['detail'] ){
			//echo json_encode($result);
			echo json_encode(array(
				'status' =>  (strpos($result['detail'],'already a list member') !== false)?200:$result['status'],
				'detail' =>  $result['detail']
				));
		}
		else{
			echo 1;
		}
	    if($a == 1)return;
	    die();
	}
	/**
	 * Ajax call to set cookie
	 * @since    1.0.0
	 * 
	 */
	public function wpmchimpa_setcookie(){
		setcookie("wpmchimpa_show", 'true', time() + (86400), "/");
		die();
	}
	/**
	 * filter addon
	 * @since    1.0.0
	 * 
	 */
	public function addon_adder($content){

		
		if(isset($this->isload['a'])){
			$this->loadscripts();
			$tempseek = '[chimpmate';

		    $temppos = strpos($content,$tempseek);
		    if(strpos($content,$tempseek)) return $content;
			ob_start(); 
			include('includes/bottom_content.php');
			$msg = ob_get_clean();
			switch ($this->wpmchimpa["addon_orient"]) {
				case 'top': return stripslashes( $msg) . $content;
				case 'mid':
						if( substr_count(strtolower($content), '</p>')>=2 ) {
							$sch = "</p>";
							$content = str_replace("</P>", $sch, $content);
							$arr = explode($sch, $content);                 
							$nn = 0; $mm = strlen($content)/2;
							for($i=0;$i<count($arr);$i++) {
						        $nn += strlen($arr[$i]) + 4;
						        if($nn>$mm) {
					                if( ($mm - ($nn - strlen($arr[$i]))) > ($nn - $mm) && $i+1<count($arr) ) {
					                    $arr[$i+1] = stripslashes( $msg).$arr[$i+1];                                                       
					                } else {
					                    $arr[$i] = stripslashes( $msg).$arr[$i];
					                }
					                break;
						        }
							}
							return implode($sch, $arr);
						}
					break;
				case 'bot':return $content . stripslashes( $msg);
			}
			return $content . stripslashes( $msg);
		}
		return $content;
	}
function register_shortcodes(){
	if(isset($this->wpmchimpa["addon_scode"]))
   		add_shortcode('chimpmate', array($this,'addon_scode'));
}
function addon_scode($atts, $content = null) {
	if($this->wpmchimpa_user_status() && $this->wpmchimpa_referral()){
		$this->loadscripts();
		ob_start(); 
		include('includes/bottom_content.php');
		$msg = ob_get_clean();
		return stripslashes( $msg);
	}
}
	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		$json=file_get_contents(WPMCA_PLUGIN_PATH.'src/default.json');
		add_option('wpmchimpa_options',$json);
		if (function_exists('curl_init') && function_exists('curl_setopt')){
			$curl = curl_init();
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => 'http://voltroid.com/chimpmate/api.php',
			    CURLOPT_REFERER => home_url(),
			    CURLOPT_POST => 1
			));
			curl_setopt($curl, CURLOPT_POSTFIELDS, array(
				        'action' => 'subs',
				        'email' => ''
				    ));
			$res=curl_exec($curl);
			curl_close($curl);
		}
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		
	}
	public function getIcon($icon,$size='250',$color='#000',$attr='1'){
		if(!isset($icon))return '';
		$svglist = $this->svglist();
		$iconlist = $this->iconlist();
		$ico = ((array_key_exists($icon,$iconlist))?$iconlist[$icon]:((array_key_exists($icon,$svglist))?$svglist[$icon]:null));
		$str = $ico['path'].(isset($ico['cont'])?$attr.$ico['cont']:'');
		$dim = (isset($ico['dim'])?$ico['dim']:512);
		$stra = '<svg xmlns="http://www.w3.org/2000/svg" fill="'.$color.'" x="0px" y="0px" width="'.$size.'px" height="'.$size.'px" viewBox="0 0 '.$dim.' '.$dim.'" enable-background="new 0 0 '.$dim.' '.$dim.'" xml:space="preserve">';
		$str = $stra . $str . '</svg>';
		return "url('data:image/svg+xml;base64,".base64_encode($str)."')";
	}
	public function svglist(){
		return array(
			'fb' => array('path' => '<path d="M223.22,71.227c16.066-15.298,38.918-20.465,60.475-21.109c22.799-0.205,45.589-0.081,68.388-0.072c0.09,24.051,0.098,48.111-0.009,72.161c-14.734-0.026-29.478,0.036-44.212-0.026c-9.343-0.582-18.937,6.5-20.635,15.762c-0.224,16.093-0.081,32.195-0.072,48.289c21.61,0.089,43.22-0.027,64.829,0.054c-1.582,23.281-4.47,46.456-7.858,69.541c-19.088,0.179-38.187-0.018-57.274,0.099c-0.17,68.665,0.089,137.33-0.134,205.995c-28.352,0.116-56.721-0.054-85.072,0.08c-0.537-68.674,0.044-137.383-0.295-206.066c-13.832-0.144-27.672,0.099-41.503-0.116c0.053-23.085,0.018-46.169,0.026-69.246c13.822-0.169,27.654,0.036,41.477-0.098c0.42-22.442-0.421-44.91,0.438-67.333C203.175,101.384,209.943,83.493,223.22,71.227z"/>'),
			'gp' => array('path' => '<path d="M42.691 170.261c0-61.716 46.356-110.561 111.903-110.561 18.227 0 29.635 2.416 38.471 3.645 4.157 1.219 8.325 1.219 12.482 1.219l64.492-0.604c1.075 0 1.587 0.604 1.587 1.198 0 3.103-1.587 7.342-3.656 7.342l-48.363 7.353c16.138 14.653 24.965 40.929 24.965 64.727 0 60.477-40.048 95.908-93.635 105.063-6.768 1.239-16.138 3.072-25.487 7.342-20.838 6.717-40.080 16.497-40.080 25.026 0 11.008 38.502 17.122 73.871 22.599 67.645 9.165 109.281 20.798 109.281 65.382 0 50.688-55.685 89.784-139.417 89.784-63.468 0-109.261-20.142-109.261-58.644 0-28.058 21.35-41.543 80.087-77.599-16.128-4.25-32.225-10.353-40.571-15.237-6.215-3.676-9.871-10.404-9.871-23.204 0-4.905 1.075-6.738 4.157-8.571 19.742-9.144 40.571-18.934 56.719-26.256-35.369-6.113-67.666-36.014-67.666-79.431v-0.573zM141.589 448.809c44.728 0 83.722-24.474 84.265-59.914 0-39.68-43.714-48.22-104.581-59.218-6.789-1.219-10.404-1.219-16.138 2.437-18.176 12.841-40.059 32.993-40.059 62.3 0 34.202 32.256 54.395 75.961 54.395h0.553zM142.602 240.496c30.69 0 57.744-26.245 57.744-87.982 0-47.012-18.186-82.442-52.5-82.442-40.622 0-60.365 41.544-60.365 92.242 0 48.261 24.965 78.183 54.661 78.183h0.461z"/><path d="M299.684 134.738h192.492v27.525h-192.491v-27.525z"/><path d="M382.167 52.224h27.515v192.532h-27.515v-192.532z"/>'),
			'ms' => array('path' => '<path d="M0.175,256L0,99.963l192-26.072V256H0.175z M224,69.241L479.936,32v224H224V69.241z M479.999,288l-0.063,224L224,475.992 V288H479.999z M192,471.918L0.156,445.621L0.146,288H192V471.918z"/>'),
			'fb1' => array('path' => '<path d="M296.296,512H200.36V256h-64v-88.225l64-0.029l-0.104-51.976C200.256,43.794,219.773,0,304.556,0h70.588v88.242h-44.115 c-33.016,0-34.604,12.328-34.604,35.342l-0.131,44.162h79.346l-9.354,88.225L296.36,256L296.296,512z"/>'),
			'gp1' => array('path' => '<path d="M273.372,302.498c-5.041-6.762-10.608-13.045-16.7-18.842c-6.091-5.804-12.183-11.088-18.271-15.845 c-6.092-4.757-11.659-9.329-16.702-13.709c-5.042-4.374-9.135-8.945-12.275-13.702c-3.14-4.757-4.711-9.61-4.711-14.558 c0-6.855,2.19-13.278,6.567-19.274c4.377-5.996,9.707-11.799,15.986-17.417c6.28-5.617,12.559-11.753,18.844-18.415 c6.276-6.665,11.604-15.465,15.985-26.412c4.373-10.944,6.563-23.458,6.563-37.542c0-16.75-3.713-32.835-11.136-48.25 c-7.423-15.418-17.89-27.412-31.405-35.976h38.54L303.2,0H178.441c-17.699,0-35.498,1.906-53.384,5.72 c-26.453,5.9-48.723,19.368-66.806,40.397C40.171,67.15,31.129,90.99,31.129,117.637c0,28.171,10.138,51.583,30.406,70.233 c20.269,18.649,44.585,27.978,72.945,27.978c5.71,0,12.371-0.478,19.985-1.427c-0.381,1.521-1.043,3.567-1.997,6.136 s-1.715,4.62-2.286,6.14c-0.57,1.521-1.047,3.375-1.425,5.566c-0.382,2.19-0.571,4.428-0.571,6.71 c0,12.563,6.086,26.744,18.271,42.541c-14.465,0.387-28.737,1.67-42.825,3.86c-14.084,2.19-28.833,5.616-44.252,10.28 c-15.417,4.661-29.217,11.42-41.396,20.27c-12.182,8.854-21.317,19.366-27.408,31.549C3.533,361.559,0.01,374.405,0.01,386.017 c0,12.751,2.857,24.314,8.565,34.69c5.708,10.369,13.035,18.842,21.982,25.406c8.945,6.57,19.273,12.083,30.978,16.562 c11.704,4.47,23.315,7.659,34.829,9.562c11.516,1.903,22.888,2.854,34.119,2.854c51.007,0,90.981-12.464,119.909-37.397 c26.648-23.223,39.971-50.062,39.971-80.517c0-10.855-1.57-20.984-4.712-30.409C282.51,317.337,278.42,309.254,273.372,302.498z M163.311,198.722c-9.707,0-18.937-2.475-27.694-7.426c-8.757-4.95-16.18-11.374-22.27-19.273 c-6.088-7.898-11.418-16.796-15.987-26.695c-4.567-9.896-7.944-19.792-10.135-29.692c-2.19-9.895-3.284-19.318-3.284-28.265 c0-18.271,4.854-33.974,14.562-47.108c9.705-13.134,23.411-19.701,41.112-19.701c12.563,0,23.935,3.899,34.118,11.704 c10.183,7.804,18.177,17.701,23.984,29.692c5.802,11.991,10.277,24.407,13.417,37.257c3.14,12.847,4.711,24.983,4.711,36.403 c0,19.036-4.139,34.317-12.419,45.833C195.144,192.964,181.775,198.722,163.311,198.722z M242.251,413.123 c-5.23,8.949-12.319,15.94-21.267,20.981c-8.946,5.048-18.509,8.758-28.693,11.14c-10.183,2.385-20.889,3.572-32.12,3.572 c-12.182,0-24.27-1.431-36.258-4.284c-11.99-2.851-23.459-7.187-34.403-12.991c-10.944-5.8-19.795-13.798-26.551-23.982 c-6.757-10.184-10.135-21.744-10.135-34.69c0-11.419,2.568-21.601,7.708-30.55c5.142-8.945,11.709-16.084,19.702-21.408 c7.994-5.332,17.319-9.713,27.979-13.131c10.66-3.433,20.937-5.808,30.833-7.139c9.895-1.335,19.985-1.995,30.262-1.995 c6.283,0,11.043,0.191,14.277,0.567c1.143,0.767,4.043,2.759,8.708,5.996s7.804,5.428,9.423,6.57 c1.615,1.137,4.567,3.326,8.85,6.563c4.281,3.237,7.327,5.661,9.135,7.279c1.803,1.618,4.421,4.045,7.849,7.279 c3.424,3.237,5.948,6.043,7.566,8.422c1.615,2.378,3.616,5.28,5.996,8.702c2.38,3.433,4.043,6.715,4.998,9.855 c0.948,3.142,1.854,6.567,2.707,10.277c0.855,3.72,1.283,7.569,1.283,11.57C250.105,393.713,247.487,404.182,242.251,413.123z"/> <polygon points="401.998,73.089 401.998,0 365.449,0 365.449,73.089 292.358,73.089 292.358,109.636 365.449,109.636  365.449,182.725 401.998,182.725 401.998,109.636 475.081,109.636 475.081,73.089"/>'),
			'ms1' => array(
				'path' => '<path d="M8.021,1.385v6.437h8.791V0.127L8.021,1.385z M0,7.822h6.648V1.494L0,2.443V7.822z M0,14.175 l6.648,1.031V8.63H0V14.175z M8.021,15.321l8.791,1.364V8.63H8.021V15.321z"/>',
				'dim' => 17
			),
			'lock1' => array('path' => '<path d="M417.566,209.83h-9.484v-44.388c0-82.099-65.151-150.681-146.582-152.145c-2.224-0.04-6.671-0.04-8.895,0 c-81.432,1.464-146.582,70.046-146.582,152.145v44.388h-9.485C81.922,209.83,70,224.912,70,243.539v222.632  C70,484.777,81.922,500,96.539,500h321.028c14.617,0,26.539-15.223,26.539-33.829V243.539  C444.105,224.912,432.184,209.83,417.566,209.83z M287.129,354.629v67.27c0,7.704-6.449,14.222-14.159,14.222h-31.834  c-7.71,0-14.159-6.518-14.159-14.222v-67.27c-7.477-7.361-11.83-17.537-11.83-28.795c0-21.334,16.491-39.666,37.459-40.512  c2.222-0.09,6.673-0.09,8.895,0c20.968,0.846,37.459,19.178,37.459,40.512C298.959,337.092,294.605,347.268,287.129,354.629z M345.572,209.83H261.5h-8.895h-84.072v-44.388c0-48.905,39.744-89.342,88.519-89.342s88.52,40.437,88.52,89.342V209.83z"/>'),
			'ch1' => array('path' => '<polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"/>'),
			'ch2' => array(
				'path' => '<path d="M26.474,70c-2.176,0-4.234-1.018-5.557-2.764L3.049,43.639C0.725,40.57,1.33,36.2,4.399,33.875 c3.074-2.326,7.441-1.717,9.766,1.35l11.752,15.518L55.474,3.285c2.035-3.265,6.332-4.264,9.604-2.232 c3.268,2.034,4.266,6.334,2.23,9.602l-34.916,56.06c-1.213,1.949-3.307,3.175-5.6,3.279C26.685,69.998,26.58,70,26.474,70z"/>',
				'dim' => 70
			),
			'ch3' => array(
				'path' => '<polygon points="5.912,0.709 2.117,3.626 0.04,1.987 0,2.747 2.062,5.244 5.953,1.468  "/>',
				'dim' => 6
			),
			'ch4' => array(
				'path' => '<path d="M593.641,142.29c0,3.876-1.432,7.242-4.285,10.098l-385.56,385.56 c-2.448,2.856-5.712,4.284-9.792,4.284h-0.612h-0.612c-3.672,0-6.936-1.428-9.792-4.284L4.284,359.856 C1.428,356.184,0,352.717,0,349.452c0-3.264,1.428-6.729,4.284-10.403l76.5-76.5c6.936-6.12,13.872-6.12,20.808,0l91.8,92.412 L492.049,55.693c3.674-2.856,7.141-4.284,10.402-4.284c3.268,0,6.732,1.428,10.404,4.284l76.5,76.5 C592.211,135.048,593.641,138.414,593.641,142.29z"/>',
				'dim' => 600
			),
			'ch5' => array(
				'path' => '<path d="M92.356,223.549c7.41,7.5,23.914,5.014,25.691-6.779c11.056-73.217,66.378-134.985,108.243-193.189 C237.898,7.452,211.207-7.87,199.75,8.067C161.493,61.249,113.274,117.21,94.41,181.744 c-21.557-22.031-43.201-43.853-67.379-63.212c-15.312-12.265-37.215,9.343-21.738,21.737 C36.794,165.501,64.017,194.924,92.356,223.549z"/>',
				'dim' => 230
			),
			'ch6' => array(
				'path' => '<path d="M10.691,0.148c-0.322-0.212-0.757-0.121-0.969,0.203l-5.503,8.82l-3.044-2.96 C0.891,5.947,0.449,5.965,0.186,6.249c-0.262,0.283-0.245,0.727,0.039,0.988L3.887,10.8l0.026,0.017l0.053,0.055l0.096,0.036 l0.115,0.048l0.117,0.018l0.168-0.002l0.068-0.016l0.196-0.082l0.031-0.022l0.12-0.087l0.056-0.092l0.003-0.004l5.958-9.551 C11.106,0.794,11.016,0.36,10.691,0.148z"/>',
				'dim' => 11
			),
			'glowblur1' => array(
				'path' => '<filter  id="f1" x="0" y="0"><feGaussianBlur  in="SourceGraphic" stdDeviation="',
				'cont' => '"></feGaussianBlur></filter><g filter="url(#f1)"><path d="M56.4,58.3c-9.9,0-30.3-9.6-13-19c9.6-5.2,29.6-9.5,37-10c60.5-3.9,87.1,7.7,147,12c25.3,1.8,50.7,2.1,76,4 c8.7,0.6,25.9,1.9,33,10c0.7,0.8,0.4,2.1,0,3c-1.3,3.3-6.7,4.6-13,5c-47.7,2.9-26.2,0-65-4c-7.3-0.8-14.7-1-22-1 c-46-0.3-92-0.9-138,0c-18.7,0.4-36.8,7.7-53-2"/><line x1="0" y1="0" x2="0" y2="200"/></g>',
				'dim' => 400
			),
			'glowblur2' => array(
				'path' => '<filter  id="f1" x="0" y="0"><feGaussianBlur  in="SourceGraphic" stdDeviation="',
				'cont' => '"></feGaussianBlur></filter><g filter="url(#f1)"><path d="M215.3,35.5c5.6,1.7,11.5,1.7,17.4,1.7c19.5-0.1,38.9-0.1,58.4-0.2c5.8,0,11.6-0.1,17.3-0.9 c11.1-1.6,22.1-6.3,33.1-4c1.9,0.4,4.2,1.4,4.5,3.3c5.4,0.4,10.7,0.7,16.1,1.1c-1.9,2.5-2.9,5.7-2.7,8.9 c-11.8,1.5-23.8-4.9-35.3-2.1c-3.1,0.7-5.9,2.1-8.9,3c-12.9,3.9-26.5-0.8-39.9-1.9c-19.5-1.6-38.8,4.5-58.3,3.5c-2-0.1-4-0.3-5.9-1 c-1.5-0.6-2.9-1.5-4.5-1.9c-3.1-0.9-6.5-0.1-9.7,0.6c-20.9,4.9-42.9,4.9-63.9,0.3c-3.3-0.7-6.7-1.6-9.9-0.7c-2.9,0.7-5.3,2.7-8,3.8 c-5.2,2.2-11.1,1.3-16.7,2.5c-6.2,1.3-11.9,4.9-18.1,5.1c-4.3,0.1-8.5-1.5-12.5-3.2c-2.9-1.2-5.9-2.5-8.9-1.7c-3,0.7-5.3,4.6-3.3,7 c-3.5-0.3-4.4-5-4.4-8.5c0-4.1,0.3-8.9,3.5-11.5c2.2-1.9,5.3-2.2,8.2-2.4c11-0.7,22.1-0.4,33.1,1c6.1,0.8,12.5,1.9,18.3-0.1 c4.2-1.4,8.2-4.3,12.5-3.5c2.6,0.5,4.8,2.2,7.2,3.3c3.9,1.7,8.3,1.7,12.5,1.7c8.5-0.1,17-0.1,25.5-0.1c6.7,0,13.7-0.1,19.9-2.6 c3.3-1.3,6.5-3.4,10.1-3.7C206.5,31.7,210.9,34.2,215.3,35.5z"/><line x1="0" y1="0" x2="0" y2="200"/></g>',
				'dim' => 400
			),
			'glowblur3' => array(
				'path' => '<filter  id="f1" x="0" y="0"><feGaussianBlur  in="SourceGraphic" stdDeviation="',
				'cont' => '"></feGaussianBlur></filter><g filter="url(#f1)"><path d="M255.1,66c-10.7-1.4-21.5-0.9-32.3-0.2c-17.8,1-35.5,2-53.3,3.1c-8,0.5-16.1,0.9-23.9-0.8 c-5.7-1.3-11-3.5-16.5-5.4c-12.3-4.1-25.9-5.6-37.8-0.5c-4.9,2-9.3,5.2-14.2,7.2c-8.8,3.5-18.6,3.3-27.4,6.9 c-2.1,0.9-4.2,2-5.6,3.9c-3.7,5.3-0.1,12.6,0.1,19.2c0.2,7.6-4.1,15.3-1.5,22.3c2.4,6.5,9.4,8.9,15.1,12 c5.7,3.1,11.5,10.1,8.5,16.2c-1.5,3.2-4.7,4.7-7.3,6.9c-2.6,2.1-4.8,6.1-3.1,9.1c6.5,2.8,12.9,5.6,19.4,8.4c1.8,2.9-1,6.9-4.1,8 c-3.1,1.2-6.6,1.1-9.2,3.2c-2.6,2.1-2.7,7.8,0.6,8.1c-4.8-0.8-9.8,1.2-13.1,5c12,3.8,24.6,5.7,37,5.4c1.3,0,2.3-2.6,1.2-2 c72.7-0.5,145.5-0.9,218.2-1.4c5.5,0,11.1-0.1,16.3-2c5.2-1.9,10.1-5.9,11.8-11.6c2.5-8.6-2.7-18.3,0.1-26.8 c2-6.1,7.6-10,10.5-15.8c3.5-7.1,2.2-15.8,3.1-23.7c0.7-6.1,2.8-12,3.1-18.2c0.5-14.3-9.3-27.2-21.3-33c-12.1-5.7-25.8-5.4-38.8-3 c-4.3,0.8-8.6,1.7-13,2C270.1,69.1,262.6,67.1,255.1,66z"/><line x1="0" y1="0" x2="0" y2="200"/></g>',
				'dim' => 400
			),
			'glowblur4' => array(
				'path' => '<filter  id="f1" x="0" y="0"><feGaussianBlur  in="SourceGraphic" stdDeviation="',
				'cont' => '"></feGaussianBlur></filter><g filter="url(#f1)"><path d="M47.7,99.4c-3.6-3.7-4.3-9.7-2.2-14.5c2-4.8,6.3-8.3,11-10.5c4.7-2.1,9.9-3,15.1-3.6 c20.2-2.3,40.8-1.1,61-4.4c3.7-0.6,7.5-1.4,11.1-2.3c2.1-0.5,4.6-1.1,6.3,0.3c1.7,1.4,1.7,4.1,0.6,6s-3,3.2-4.8,4.5 c-4.9,3.5-9.4,7.5-13.6,11.9c-1.5,1.5-2.9,3.2-3.7,5.2c-3.2,7.8,4.7,16.7,2,24.6c-1.1,3.2-3.9,5.6-6.9,7.1s-6.4,2.1-9.8,2.6 c-9.1,1.5-19,2.5-26.9-2.3c-5.9-3.6-10.4-10.2-17.3-10.6c-3.6-0.2-7,1.5-10.6,1c-3.4-0.5-6.3-2.9-8.1-5.9c-1.8-2.9-2.7-6.3-3.6-9.7"/><line x1="0" y1="0" x2="0" y2="200"/></g>',
				'dim' => 200
			),
			'c1' => array(
				'path' => '<polygon points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 306,341.411 576.521,611.397 612,575.997 341.459,306.011"/>',
				'dim' => 612
			),
			'c2' => array(
				'path' => '<polygon fill-opacity="0.35" points="449.974,34.855 415.191,0 225.007,190.184 34.839,0 0.024,34.839 190.192,224.999 0.024,415.159 34.839,449.998 225.007,259.797 415.191,449.998 449.974,415.143 259.83,224.999"/>',
				'dim' => 449.998
			),
			'del1' => array(
				'path' => '<path d="M90.561,45.957l-0.021,0.252c0,0.032,0.021,0.06,0.021,0.088c0,0.065-0.021,0.126-0.025,0.191l-2.686,54.878h-0.02 c-0.23,4.304-5.166,10.81-31.748,10.81c-26.58,0-31.509-6.506-31.746-10.81h-0.006l-2.679-54.878 c-0.009-0.06-0.028-0.126-0.028-0.191c0-0.032,0.01-0.06,0.01-0.088l-0.01-0.252h0.028c0.099-0.466,0.364-0.919,0.784-1.353 c3.439,3.477,17.191,4.051,33.646,4.051s30.221-0.574,33.642-4.051c0.426,0.434,0.711,0.887,0.784,1.353H90.561L90.561,45.957z M95.255,25.102v6.407c0,1.316-1.34,2.567-3.715,3.696c-6.267,2.936-19.777,4.975-35.459,4.975 c-15.666,0-29.189-2.039-35.442-4.975c-2.389-1.13-3.719-2.38-3.719-3.696v-6.407c0-3.374,8.681-6.286,21.359-7.724V3.929	c0-2.16,1.768-3.929,3.93-3.929h26.314c2.164,0,3.938,1.773,3.938,3.938v13.296C85.901,18.606,95.253,21.611,95.255,25.102z M65.336,11.395c0-2.348-0.32-4.27-0.715-4.27c-0.393,0-2.641,0-4.979,0h-8.546c-2.352,0-4.592,0-4.989,0 c-0.388,0-0.714,1.922-0.714,4.27v5.367l1.083-0.065c3.067-0.173,6.286-0.271,9.595-0.271c3.202,0,6.292,0.098,9.264,0.252V11.395z"/>',
				'dim' => 112.176
			),
			'ed1' => array('path' => '<polygon points="0.002,540.329 58.797,532.66 7.664,481.528"/><polygon points="16.685,412.341 10.657,458.56 81.765,529.668 127.983,523.64 442.637,208.992 331.338,97.688"/><path d="M451.248,5.606C447.502,1.861,442.57,0,437.57,0c-5.264,0-10.6,2.062-14.701,6.157L346.92,82.106l111.299,111.298 l75.949-75.949c7.992-7.986,8.236-20.698,0.557-28.378L451.248,5.606z"/>',
				'dim' => 540.329
			),
			'loc1' => array(
				'path' => '<path d="M40,0C26.191,0,15,11.194,15,25c0,23.87,25,55,25,55s25-31.13,25-55C65,11.194,53.807,0,40,0z M40,38.8c-7.457,0-13.5-6.044-13.5-13.5S32.543,11.8,40,11.8c7.455,0,13.5,6.044,13.5,13.5S47.455,38.8,40,38.8z"/>',
				'dim' => 80
			),
			'min1' => array(
				'path' => '<path fill-opacity="0.35" d="M325.16,146.175H32.846C14.733,146.175,0,160.914,0,179.009c0,18.111,14.733,32.84,32.846,32.84H325.16 c18.135,0,32.864-14.729,32.864-32.84C358.018,160.914,343.294,146.175,325.16,146.175z"/>',
				'dim' => 358.024
			),
			'max1' => array('path' => '<polygon fill-opacity="0.35" points="298.5,-1 298.5,211.5 511,211.5"/><polygon fill-opacity="0.35" points="210,509 210,299 0,299"/>'),
			'max2' => array('path' => '<polygon fill-opacity="0.35" points="392,299.9 392,97 189.1,97"/><polygon fill-opacity="0.35" points="103.7,195.8 103.7,408.3 316.2,408.3"/>'),
			'w01' => array(
				'path' => '<circle fill="#FFE168" cx="32" cy="32" r="24"/>',
				'dim' => 64
			),
			'w02' => array(
				'path' => '<path fill="#FFE168" d="M38.676,52.577c-4.471,0-8.942,0-13.413,0c-0.192,0-2.026,0.123-2.064-0.058 c-0.366-1.715-0.038-3.807,1.56-4.8c2-1.242,2.949,0.232,3.453-2.064c0.408-1.858,1.191-3.762,2.624-5.065 c2.218-2.016,5.309-1.649,7.891-0.596c1.575,0.642,1.951-0.653,3.311-1.633c4.787-3.449,9.308-1.549,11.874,3.427 C55.25,38.798,56,35.488,56,32C56,18.745,45.255,8,32,8c-7.911,0-14.926,3.829-19.298,9.733c0.679,0.118,1.351,0.315,1.985,0.573 c1.276,0.52,1.58-0.529,2.682-1.323c3.955-2.849,7.689-1.198,9.744,3.012c0.506,1.037,0.372,1.74,1.458,1.963 c0.891,0.183,1.764,0.484,2.566,0.916c2.089,1.125,3.418,3.217,3.237,5.624c-6.576,0-13.153,0-19.729,0c-2.13,0-4.259,0-6.389,0 C8.09,29.641,8,30.81,8,32c0,13.255,10.745,24,24,24c4.519,0,8.746-1.251,12.355-3.423C42.462,52.577,40.569,52.577,38.676,52.577z"/><path fill="#D9D9D9" d="M30.792,26.918c-5.202,0-10.403,0-15.605,0c-2.864,0-5.729,0-8.593,0c-0.123,0-1.298,0.072-1.323-0.034 c-0.234-1.006-0.024-2.234,0.999-2.816c1.282-0.729,1.889,0.136,2.212-1.211c0.261-1.09,0.763-2.207,1.681-2.972 c1.421-1.183,3.401-0.967,5.056-0.349c1.009,0.377,1.25-0.383,2.121-0.958c3.128-2.063,6.081-0.868,7.707,2.181 c0.4,0.751,0.294,1.26,1.154,1.422c0.705,0.132,1.396,0.351,2.03,0.663C29.884,23.659,30.934,25.175,30.792,26.918z"/><path fill="#D9D9D9" d="M60.248,50.863c-6.688,0-13.375,0-20.063,0c-3.683,0-7.365,0-11.048,0c-0.158,0-1.669,0.085-1.701-0.04 c-0.301-1.194-0.031-2.651,1.285-3.342c1.648-0.865,2.429,0.162,2.844-1.437c0.336-1.294,0.981-2.62,2.162-3.527 c1.827-1.404,4.373-1.148,6.5-0.415c1.297,0.447,1.607-0.455,2.727-1.137c4.022-2.449,7.819-1.03,9.908,2.589 c0.515,0.891,0.378,1.496,1.483,1.687c0.906,0.157,1.794,0.416,2.609,0.787C59.081,46.996,60.432,48.794,60.248,50.863z"/>',
				'dim' => 64
			),
			'w03' => array(
				'path' => '<path fill="#D9D9D9" d="M31.997,31.027c1.779-1.105,2.623,0.206,3.071-1.836c0.363-1.652,1.059-3.346,2.334-4.505 c1.972-1.793,4.722-1.466,7.019-0.53c1.401,0.571,1.735-0.581,2.945-1.452c0.558-0.402,1.112-0.719,1.658-0.963 c-0.136-0.387-0.289-0.815-0.518-1.284c-3.587-7.349-10.104-10.23-17.007-5.257c-1.924,1.386-2.455,3.217-4.681,2.309 c-3.651-1.489-8.021-2.008-11.157,0.842c-2.027,1.842-3.133,4.535-3.71,7.161c-0.713,3.246-2.054,1.162-4.882,2.918 c-2.259,1.403-2.722,4.361-2.206,6.786c0.054,0.255,2.647,0.081,2.919,0.081c6.321,0,12.642,0,18.963,0c1.289,0,2.577,0,3.866,0 c0,0-0.002-0.001-0.002-0.001C30.284,33.771,30.575,31.91,31.997,31.027z"/><path fill="#D9D9D9" d="M42.175,29.094c3.186-2.295,6.195-0.966,7.85,2.427c0.408,0.835,0.3,1.402,1.175,1.581 c0.718,0.147,1.422,0.39,2.067,0.738c0.242,0.131,0.468,0.281,0.683,0.443c2.31,0,4.619,0,6.929,0 c0.145-1.939-0.925-3.625-2.608-4.531c-0.646-0.348-1.349-0.591-2.067-0.738c-0.875-0.179-0.767-0.746-1.175-1.581 c-1.656-3.392-4.664-4.722-7.85-2.427c-0.888,0.64-1.133,1.485-2.161,1.066c-1.685-0.687-3.703-0.927-5.15,0.389 c-0.908,0.826-1.411,2.021-1.684,3.2c0.625,0.085,1.247,0.262,1.83,0.5C41.042,30.579,41.287,29.734,42.175,29.094z"/><path fill="#D9D9D9" d="M53.585,39.621c-4.598,0-9.196,0-13.794,0c-2.532,0-5.064,0-7.596,0c-0.109,0-1.147,0.069-1.169-0.033 c-0.207-0.971-0.022-2.156,0.883-2.718c1.133-0.704,1.67,0.131,1.955-1.169c0.231-1.052,0.674-2.131,1.486-2.869 c1.256-1.142,3.007-0.934,4.469-0.337c0.892,0.364,1.105-0.37,1.875-0.925c2.765-1.992,5.376-0.838,6.812,2.106 c0.354,0.725,0.26,1.217,1.02,1.372c0.623,0.128,1.234,0.339,1.794,0.64C52.782,36.475,53.711,37.938,53.585,39.621z"/><path fill="#C6C6C6" d="M9.211,50.418c-0.472,0.982-0.059,2.161,0.923,2.633l0,0c0.982,0.472,2.161,0.059,2.633-0.923l5.667-11.779 c0.472-0.982,0.059-2.161-0.923-2.633l0,0c-0.982-0.472-2.161-0.059-2.633,0.923L9.211,50.418z"/><path fill="#C6C6C6" d="M19.212,51.832c-0.472,0.982-0.059,2.161,0.923,2.633l0,0c0.982,0.472,2.161,0.059,2.633-0.923l5.667-11.779 c0.472-0.982,0.059-2.161-0.923-2.633l0,0c-0.982-0.472-2.161-0.059-2.633,0.923L19.212,51.832z"/>',
				'dim' => 64
			),
			'w04' => array(
				'path' => '<path fill="#D9D9D9" d="M3.708,34.282c3.002-1.864,4.425,0.348,5.182-3.097c0.612-2.788,1.787-5.646,3.938-7.601 c2.779-2.526,6.47-2.555,9.869-1.577c0.887-0.936,1.775-1.871,2.662-2.807c-1.57-1.73-3.925-2.191-6.107-1.472 c-0.837,0.275-1.631,0.688-2.353,1.192c-0.88,0.615-1.285,0.052-2.35-0.283c-4.326-1.361-7.973,0.162-8.607,4.838 c-0.177,1.303,0.358,2.216-0.858,2.765C3.091,27.14,1.214,28.7,1.164,31.05c-0.032,1.508,0.62,2.969,1.448,4.199 C2.926,34.886,3.276,34.55,3.708,34.282z"/><path fill="#D9D9D9" d="M3.508,41.61c0.106,0.077,0.213,0.155,0.323,0.222c0.042,0.025,0.177-0.089,0.339-0.25 C3.995,41.59,3.765,41.6,3.508,41.61z"/><path fill="#C6C6C6" d="M62.001,43.67c-5.472,0-10.944,0-16.416,0c-3.013,0-6.027,0-9.04,0c-0.13,0-1.366,0.085-1.391-0.04 c-0.246-1.183-0.026-2.626,1.051-3.31c1.348-0.857,1.987,0.16,2.327-1.424c0.275-1.281,0.803-2.595,1.769-3.494 c1.495-1.39,3.578-1.137,5.319-0.411c1.061,0.443,1.315-0.45,2.232-1.126c3.291-2.426,6.398-1.02,8.107,2.565 c0.421,0.883,0.31,1.482,1.214,1.671c0.741,0.155,1.468,0.412,2.135,0.78C61.046,39.839,62.151,41.621,62.001,43.67z"/><path fill="#D3D3D3" d="M32.916,39.075c1.888-1.173,2.784,0.219,3.26-1.949c0.385-1.754,1.124-3.552,2.477-4.782 c2.094-1.903,5.012-1.556,7.45-0.562c1.487,0.606,1.842-0.616,3.126-1.541c0.592-0.427,1.18-0.764,1.76-1.022 c-0.144-0.41-0.307-0.865-0.55-1.363c-3.807-7.8-10.725-10.858-18.052-5.58c-2.042,1.471-2.606,3.414-4.969,2.45 c-3.875-1.58-8.514-2.131-11.842,0.894c-2.151,1.955-3.326,4.813-3.938,7.601c-0.757,3.446-2.18,1.233-5.182,3.097 c-2.398,1.489-2.89,4.629-2.341,7.203c0.058,0.27,2.81,0.086,3.098,0.086c6.709,0,13.418,0,20.128,0c1.368,0,2.736,0,4.103,0 c0,0-0.002-0.001-0.002-0.001C31.098,41.987,31.408,40.012,32.916,39.075z"/><path fill="#C6C6C6" d="M46.689,52.792c-4.13,0-8.259,0-12.389,0c-2.274,0-4.548,0-6.822,0c-0.098,0-1.031,0.062-1.05-0.029 c-0.186-0.872-0.019-1.937,0.794-2.441c1.017-0.632,1.5,0.118,1.756-1.05c0.208-0.945,0.606-1.914,1.335-2.576 c1.128-1.025,2.7-0.839,4.014-0.303c0.801,0.327,0.992-0.332,1.684-0.831c2.483-1.789,4.828-0.753,6.119,1.891 c0.318,0.651,0.234,1.093,0.916,1.233c0.56,0.115,1.108,0.304,1.611,0.575C45.968,49.967,46.802,51.281,46.689,52.792z"/>',
				'dim' => 64
			),
			'w50' => array(
				'path' => '<path fill="none" stroke="#D3D3D3" stroke-width="2" stroke-miterlimit="10" d="M5.625,9.248c2.972-0.36,5.019,2.27,7.56,3.252 c4.132,1.598,6.11-2.442,9.746-2.032c2.252,0.254,3.881,2.086,6.252,2.163c2.427,0.079,4.071-1.742,5.846-3.093 c5-3.807,6.713,1.839,10.766,3.181c2.232,0.74,3.989-1.594,5.668-2.584c3.258-1.923,5.024,2.239,8.038,2.032"/><path fill="none" stroke="#D3D3D3" stroke-width="2" stroke-miterlimit="10" d="M5.625,17.845c2.972-0.36,5.019,2.27,7.56,3.252 c4.132,1.598,6.11-2.442,9.746-2.032c2.252,0.254,3.881,2.086,6.252,2.163c2.427,0.079,4.071-1.742,5.846-3.093 c5-3.807,6.713,1.839,10.766,3.181c2.232,0.74,3.989-1.594,5.668-2.584c3.258-1.923,5.024,2.239,8.038,2.032"/><path fill="none" stroke="#D3D3D3" stroke-width="2" stroke-miterlimit="10" d="M5.625,52.237c2.972-0.36,5.019,2.27,7.56,3.252 c4.132,1.598,6.11-2.442,9.746-2.032c2.252,0.254,3.881,2.086,6.252,2.163c2.427,0.079,4.071-1.742,5.846-3.093 c5-3.807,6.713,1.839,10.766,3.181c2.232,0.74,3.989-1.594,5.668-2.584c3.258-1.923,5.024,2.239,8.038,2.032"/><path fill="none" stroke="#D3D3D3" stroke-width="2" stroke-miterlimit="10" d="M5.625,26.443c2.972-0.36,5.019,2.27,7.56,3.252 c4.132,1.598,6.11-2.442,9.746-2.032c2.252,0.254,3.881,2.086,6.252,2.163c2.427,0.079,4.071-1.742,5.846-3.093 c5-3.807,6.713,1.839,10.766,3.181c2.232,0.74,3.989-1.594,5.668-2.584c3.258-1.923,5.024,2.239,8.038,2.032"/><path fill="none" stroke="#D3D3D3" stroke-width="2" stroke-miterlimit="10" d="M5.625,43.639c2.972-0.36,5.019,2.27,7.56,3.252 c4.132,1.598,6.11-2.442,9.746-2.032c2.252,0.254,3.881,2.086,6.252,2.163c2.427,0.079,4.071-1.742,5.846-3.093 c5-3.807,6.713,1.839,10.766,3.181c2.232,0.74,3.989-1.594,5.668-2.584c3.258-1.923,5.024,2.239,8.038,2.032"/><path fill="none" stroke="#D3D3D3" stroke-width="2" stroke-miterlimit="10" d="M5.625,35.041c2.972-0.36,5.019,2.27,7.56,3.252 c4.132,1.598,6.11-2.442,9.746-2.032c2.252,0.254,3.881,2.086,6.252,2.163c2.427,0.079,4.071-1.742,5.846-3.093 c5-3.807,6.713,1.839,10.766,3.181c2.232,0.74,3.989-1.594,5.668-2.584c3.258-1.923,5.024,2.239,8.038,2.032"/>',
				'dim' => 64
			),
			'w09' => array(
				'path' => '<path fill="#D9D9D9" d="M59.575,34.47c-11.375,0-22.75,0-34.125,0c-6.264,0-12.528,0-18.792,0c-0.269,0-2.839,0.172-2.892-0.081 c-0.512-2.403-0.053-5.334,2.186-6.725c2.802-1.74,4.131,0.325,4.838-2.892c0.572-2.603,1.668-5.271,3.677-7.097 c3.107-2.824,7.438-2.31,11.056-0.834c2.206,0.9,2.733-0.915,4.639-2.288c6.841-4.928,13.299-2.073,16.853,5.21 c0.875,1.793,0.644,3.01,2.523,3.395c1.541,0.316,3.052,0.837,4.438,1.584C57.59,26.689,59.887,30.307,59.575,34.47z"/><path fill="#4DBFD9" d="M36.64,41.487c0,1.281-1.039,2.32-2.32,2.32l0,0c-1.281,0-2.32-1.039-2.32-2.32l0,0 c0-1.281,1.039-2.32,2.32-2.32l0,0C35.601,39.167,36.64,40.205,36.64,41.487L36.64,41.487z"/><path fill="#4DBFD9" d="M54.473,41.487c0,1.281-1.039,2.32-2.32,2.32l0,0c-1.281,0-2.32-1.039-2.32-2.32l0,0 c0-1.281,1.039-2.32,2.32-2.32l0,0C53.435,39.167,54.473,40.205,54.473,41.487L54.473,41.487z"/><path fill="#4DBFD9" d="M48.98,51.487c0,1.281-1.039,2.32-2.32,2.32l0,0c-1.281,0-2.32-1.039-2.32-2.32l0,0 c0-1.281,1.039-2.32,2.32-2.32l0,0C47.942,49.167,48.98,50.205,48.98,51.487L48.98,51.487z"/><path fill="#4DBFD9" d="M30.28,51.487c0,1.281-1.039,2.32-2.32,2.32l0,0c-1.281,0-2.32-1.039-2.32-2.32l0,0 c0-1.281,1.039-2.32,2.32-2.32l0,0C29.241,49.167,30.28,50.205,30.28,51.487L30.28,51.487z"/><path fill="#4DBFD9" d="M12.333,51.487c0,1.281-1.039,2.32-2.32,2.32l0,0c-1.281,0-2.32-1.039-2.32-2.32l0,0 c0-1.281,1.039-2.32,2.32-2.32l0,0C11.295,49.167,12.333,50.205,12.333,51.487L12.333,51.487z"/><path fill="#4DBFD9" d="M18.14,41.487c0,1.281-1.039,2.32-2.32,2.32l0,0c-1.281,0-2.32-1.039-2.32-2.32l0,0 c0-1.281,1.039-2.32,2.32-2.32l0,0C17.101,39.167,18.14,40.205,18.14,41.487L18.14,41.487z"/>',
				'dim' => 64
			),
			'w10' => array(
				'path' => '<path fill="#D9D9D9" d="M59.575,34.47c-11.375,0-22.75,0-34.125,0c-6.264,0-12.528,0-18.792,0c-0.269,0-2.839,0.172-2.892-0.081 c-0.512-2.403-0.053-5.334,2.186-6.725c2.802-1.74,4.131,0.325,4.838-2.892c0.572-2.603,1.668-5.271,3.677-7.097 c3.107-2.824,7.438-2.31,11.056-0.834c2.206,0.9,2.733-0.915,4.639-2.288c6.841-4.928,13.299-2.073,16.853,5.21 c0.875,1.793,0.644,3.01,2.523,3.395c1.541,0.316,3.052,0.837,4.438,1.584C57.59,26.689,59.887,30.307,59.575,34.47z"/><path fill="#4DBFD9" d="M8.187,51.015c-0.459,0.954-0.058,2.098,0.896,2.557l0,0c0.954,0.459,2.098,0.058,2.557-0.896l5.503-11.439 c0.459-0.954,0.058-2.098-0.896-2.557l0,0c-0.954-0.459-2.098-0.058-2.557,0.896L8.187,51.015z"/><path fill="#4DBFD9" d="M26.359,51.015c-0.459,0.954-0.058,2.098,0.896,2.557l0,0c0.954,0.459,2.098,0.058,2.557-0.896l5.503-11.439 c0.459-0.954,0.058-2.098-0.896-2.557l0,0c-0.954-0.459-2.098-0.058-2.557,0.896L26.359,51.015z"/><path fill="#4DBFD9" d="M44.53,51.015c-0.459,0.954-0.058,2.098,0.896,2.557l0,0c0.954,0.459,2.098,0.058,2.557-0.896l5.503-11.439 c0.459-0.954,0.058-2.098-0.896-2.557l0,0c-0.954-0.459-2.098-0.058-2.557,0.896L44.53,51.015z"/>',
				'dim' => 64
			),
			'w11' => array(
				'path' => '<path fill="#4DBFD9" d="M8.187,51.015c-0.459,0.954-0.058,2.098,0.896,2.557l0,0c0.954,0.459,2.098,0.058,2.557-0.896l5.503-11.439	c0.459-0.954,0.058-2.098-0.896-2.557l0,0c-0.954-0.459-2.098-0.058-2.557,0.896L8.187,51.015z"/><path fill="#4DBFD9" d="M14.772,57.139c-0.459,0.954-0.058,2.098,0.896,2.557l0,0c0.954,0.459,2.098,0.058,2.557-0.896l5.503-11.439 c0.459-0.954,0.058-2.098-0.896-2.557l0,0c-0.954-0.459-2.098-0.058-2.557,0.896L14.772,57.139z"/><path fill="#4DBFD9" d="M25.78,51.015c-0.459,0.954-0.058,2.098,0.896,2.557l0,0c0.954,0.459,2.098,0.058,2.557-0.896l5.503-11.439 c0.459-0.954,0.058-2.098-0.896-2.557l0,0c-0.954-0.459-2.098-0.058-2.557,0.896L25.78,51.015z"/><path fill="#D9D9D9" d="M46.004,17.96c-3.69-5.908-9.603-7.901-15.842-3.406c-1.906,1.373-2.433,3.188-4.639,2.288 c-3.618-1.475-7.949-1.99-11.056,0.834c-2.008,1.826-3.105,4.494-3.677,7.097c-0.706,3.217-2.035,1.151-4.838,2.892 c-2.239,1.391-2.698,4.322-2.186,6.725c0.054,0.252,2.623,0.081,2.892,0.081c6.264,0,12.528,0,18.792,0c3.063,0,6.127,0,9.19,0 L46.004,17.96z"/><polyline fill="#FFE168" points="53,14.277 52.113,15.565 38.5,35.345 48.5,35.345 42,54.777 59.104,29.527 51.25,31.027"/>',
				'dim' => 64
			),
			'w13' => array(
				'path' => '<path fill="#D9D9D9" d="M60.389,27.151c0.156,0.445,0.277,0.777,0.654,0.978C60.845,27.791,60.624,27.467,60.389,27.151z"/><path fill="#D9D9D9" d="M38.083,30.697c1.503-0.934,2.216,0.174,2.595-1.551c0.307-1.396,0.895-2.828,1.972-3.807 c1.667-1.515,3.99-1.239,5.931-0.448c1.184,0.483,1.466-0.491,2.489-1.227c0.762-0.549,1.515-0.909,2.248-1.113 c-0.479-0.14-0.961-0.266-1.449-0.366c-1.974-0.405-1.731-1.683-2.65-3.567c-3.734-7.651-10.519-10.65-17.706-5.473 c-2.003,1.443-2.556,3.349-4.874,2.403c-3.801-1.55-8.351-2.091-11.615,0.877c-2.11,1.918-3.262,4.721-3.863,7.456 c-0.742,3.38-2.138,1.21-5.082,3.038c-2.352,1.461-2.834,4.541-2.296,7.065c0.057,0.265,2.756,0.085,3.039,0.085 c6.581,0,13.162,0,19.742,0c3.437,0,6.874,0,10.311,0C36.675,32.828,36.954,31.399,38.083,30.697z"/><path fill="#D9D9D9" d="M61.033,34.107c-4.287,0-8.574,0-12.861,0c-2.361,0-4.722,0-7.082,0c-0.101,0-1.07,0.065-1.09-0.03 c-0.193-0.906-0.02-2.01,0.824-2.534c1.056-0.656,1.557,0.123,1.823-1.09c0.215-0.981,0.629-1.987,1.386-2.675 c1.171-1.064,2.803-0.871,4.167-0.314c0.832,0.339,1.03-0.345,1.748-0.862c2.578-1.857,5.012-0.781,6.352,1.963 c0.33,0.676,0.243,1.134,0.951,1.28c0.581,0.119,1.15,0.316,1.673,0.597C60.284,31.175,61.15,32.538,61.033,34.107z"/><rect x="56.164" y="42.269" fill="#4DBFD9" width="2.42" height="12.803"/><rect x="49.294" y="38.116" fill="#4DBFD9" width="2.42" height="12.803"/><rect x="42.576" y="42.269" fill="#4DBFD9" width="2.42" height="12.803"/><rect x="36.061" y="38.116" fill="#4DBFD9" width="2.42" height="12.803"/><polyline fill="#D9D9D9" points="22.463,40.43 22.463,42.42 24.539,42.42 24.539,44.518 26.583,44.518 26.583,42.42 28.626,42.42 28.626,40.344 26.529,40.344 26.529,38.311 24.539,38.311 24.496,40.452 "/><path fill="#4DBFD9" d="M28.951,40.257"/><polyline fill="#D9D9D9" points="16.234,48.8 16.234,50.79 18.31,50.79 18.31,52.887 20.354,52.887 20.354,50.79 22.398,50.79 22.398,48.713 20.3,48.713 20.3,46.68 18.31,46.68 18.267,48.821 "/><polyline fill="#D9D9D9" points="10.071,40.43 10.071,42.42 12.147,42.42 12.147,44.518 14.19,44.518 14.19,42.42 16.234,42.42 16.234,40.344 14.136,40.344 14.136,38.311 12.147,38.311 12.103,40.452 "/><polyline fill="#D9D9D9" points="3.907,48.8 3.907,50.79 5.983,50.79 5.983,52.887 8.027,52.887 8.027,50.79 10.071,50.79 10.071,48.713 7.973,48.713 7.973,46.68 5.983,46.68 5.94,48.821 "/>',
				'dim' => 64
			),
			'unlockdown' => array('path' => '<polygon points="142.332,104.886 197.48,50 402.5,256 197.48,462 142.332,407.113 292.727,256 " transform="rotate(90 256 256)"/>'),
			'opt1' => array(
				'path' => '<path d="M0,382.5h459v-51H0V382.5z M0,255h459v-51H0V255z M0,76.5v51h459v-51H0z"/>',
				'dim' => 459
			)
		);
	}
	public function iconlist(){
		return array(
			'a01' => array('path' => '<path d="M448,64H64C28.656,64,0,92.656,0,128v256c0,35.344,28.656,64,64,64h384c35.344,0,64-28.656,64-64V128 C512,92.656,483.344,64,448,64z M342.656,234.781l135.469-116.094c0.938,3,1.875,6,1.875,9.313v256c0,2.219-0.844,4.188-1.281,6.281 L342.656,234.781z M448,96c2.125,0,4,0.813,6,1.219L256,266.938L58,97.219C60,96.813,61.875,96,64,96H448z M33.266,390.25 C32.828,388.156,32,386.219,32,384V128c0-3.313,0.953-6.313,1.891-9.313L169.313,234.75L33.266,390.25z M64,416 c-3.234,0-6.172-0.938-9.125-1.844l138.75-158.563l51.969,44.531C248.578,302.719,252.297,304,256,304s7.422-1.281,10.406-3.875 l51.969-44.531l138.75,158.563C454.188,415.063,451.25,416,448,416H64z"/>'),
			'a02' => array(
				'path' => '<path d="M0,53.007v239.765h345.779V53.007H0z M310.717,113.122l-137.828,79.281L35.063,113.122 c-7.046-4.055-9.477-13.049-5.418-20.094c4.054-7.045,13.05-9.473,20.09-5.418l123.154,70.836l123.156-70.836 c7.043-4.056,16.035-1.627,20.091,5.418C320.192,100.073,317.762,109.067,310.717,113.122z"/>',
				'dim' => 345.779
			),
			'a03' => array(
				'path' => '<g><path d="M79.538,203.658v-28.994c0-16.45,13.327-29.776,29.776-29.776h270.797c16.449,0,29.776,13.326,29.776,29.776v28.98 l38.157-38.156c1.6-1.601,2.438-3.816,2.293-6.079c-0.135-2.261-1.241-4.35-3.033-5.742L262.99,10.25 c-10.752-8.364-25.809-8.364-36.563,0L42.107,153.666c-1.793,1.393-2.898,3.481-3.034,5.742c-0.144,2.263,0.692,4.479,2.294,6.079 L79.538,203.658z"/><path d="M484.544,188.778c-2.954-1.219-6.356-0.542-8.618,1.721L273.809,392.616c-7.719,7.719-18.193,12.06-29.107,12.06 c-10.912,0-21.388-4.341-29.098-12.06L13.494,190.508c-2.263-2.263-5.664-2.94-8.618-1.713C1.928,190.014,0,192.897,0,196.092 v256.722c0,18.019,14.608,32.628,32.627,32.628h424.164c18.018,0,32.627-14.609,32.627-32.628V196.084 C489.418,192.89,487.492,190.005,484.544,188.778z"/><path d="M335.121,190.435H154.305c-9.008,0-16.314,7.304-16.314,16.314c0,9.009,7.306,16.313,16.314,16.313h180.816 c9.01,0,16.314-7.305,16.314-16.313C351.435,197.739,344.131,190.435,335.121,190.435z"/><path d="M335.121,255.691H154.305c-9.008,0-16.314,7.304-16.314,16.314c0,9.009,7.306,16.314,16.314,16.314h180.816 c9.01,0,16.314-7.305,16.314-16.314C351.435,262.995,344.131,255.691,335.121,255.691z"/></g>',
				'dim' => 489.418
			),
			'a04' => array('path' => '<path d="M512,384c0,11.219-3.156,21.625-8.219,30.781L342.125,233.906L502.031,94c6.219,9.875,9.969,21.469,9.969,34V384z M256,266.75L478.5,72.063c-9.125-5-19.406-8.063-30.5-8.063H64c-11.109,0-21.391,3.063-30.484,8.063L256,266.75z M318.031,254.969 l-51.5,45.094C263.516,302.688,259.766,304,256,304s-7.516-1.313-10.531-3.938l-51.516-45.094L30.25,438.156 C40.063,444.313,51.563,448,64,448h384c12.438,0,23.938-3.688,33.75-9.844L318.031,254.969z M9.969,94C3.75,103.875,0,115.469,0,128 v256c0,11.219,3.141,21.625,8.219,30.781l161.641-180.906L9.969,94z"/>'),
			'a05' => array('path' => '<path d="M49.106,178.729c6.472,4.567,25.981,18.131,58.528,40.685c32.548,22.554,57.482,39.92,74.803,52.099 c1.903,1.335,5.946,4.237,12.131,8.71c6.186,4.476,11.326,8.093,15.416,10.852c4.093,2.758,9.041,5.852,14.849,9.277 c5.806,3.422,11.279,5.996,16.418,7.7c5.14,1.718,9.898,2.569,14.275,2.569h0.287h0.288c4.377,0,9.137-0.852,14.277-2.569 c5.137-1.704,10.615-4.281,16.416-7.7c5.804-3.429,10.752-6.52,14.845-9.277c4.093-2.759,9.229-6.376,15.417-10.852 c6.184-4.477,10.232-7.375,12.135-8.71c17.508-12.179,62.051-43.11,133.615-92.79c13.894-9.703,25.502-21.411,34.827-35.116 c9.332-13.699,13.993-28.07,13.993-43.105c0-12.564-4.523-23.319-13.565-32.264c-9.041-8.947-19.749-13.418-32.117-13.418H45.679 c-14.655,0-25.933,4.948-33.832,14.844C3.949,79.562,0,91.934,0,106.779c0,11.991,5.236,24.985,15.703,38.974 C26.169,159.743,37.307,170.736,49.106,178.729z"/><path d="M483.072,209.275c-62.424,42.251-109.824,75.087-142.177,98.501c-10.849,7.991-19.65,14.229-26.409,18.699 c-6.759,4.473-15.748,9.041-26.98,13.702c-11.228,4.668-21.692,6.995-31.401,6.995h-0.291h-0.287 c-9.707,0-20.177-2.327-31.405-6.995c-11.228-4.661-20.223-9.229-26.98-13.702c-6.755-4.47-15.559-10.708-26.407-18.699 c-25.697-18.842-72.995-51.68-141.896-98.501C17.987,202.047,8.375,193.762,0,184.437v226.685c0,12.57,4.471,23.319,13.418,32.265 c8.945,8.949,19.701,13.422,32.264,13.422h420.266c12.56,0,23.315-4.473,32.261-13.422c8.949-8.949,13.418-19.694,13.418-32.265 V184.437C503.441,193.569,493.927,201.854,483.072,209.275z"/>'),
			'a08' => array('path' => '<path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256 C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z "/> <path d="M256,176H128v160h128h128V176H256z M256,192h89.719L256,255.75L166.281,192H256z M144,196.531l54.5,36.859L144,292.812 V196.531z M256,320h-92.406l45.562-79.422L256,272.25l46.844-31.672L348.406,320H256z M368,292.812l-54.5-59.422l54.5-36.859 V292.812z"/>'),
			'a12' => array('path' => '<path d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256S397.385,0,256,0z M128,128h256 c4.568,0,9.002,0.981,13.072,2.831L256,295.415L114.928,130.83C118.998,128.982,123.431,128,128,128z M96,352V160 c0-0.67,0.028-1.336,0.07-2l93.832,109.471L97.103,360.27C96.381,357.602,96,354.827,96,352z M384,384H128 c-2.827,0-5.601-0.381-8.27-1.104l91.059-91.061L256,344.586l45.213-52.747l91.057,91.06C389.6,383.619,386.826,384,384,384z M416,352c0,2.827-0.381,5.6-1.104,8.27l-92.801-92.799L415.93,158c0.043,0.664,0.07,1.33,0.07,2V352z"/>'),
			'a06' => array(
				'path' => '<path d="M558.3,520.6H53.7C24.1,520.6,0,496.5,0,466.9v-321.8c0-16,4.5-26.2,13.5-30.3c19.1-8.9,49.5,15.7,53.9,19.3l238.3,165.3 l211.6-147.1c2.4-1.7,5.8-1.1,7.5,1.4c1.7,2.4,1.101,5.8-1.399,7.5L308.8,310.4c-1.8,1.301-4.3,1.301-6.2,0L61,142.9 c-0.1-0.1-0.3-0.2-0.4-0.3c-11.1-9.5-32.6-22.6-42.5-18c-6,2.8-7.3,12.7-7.3,20.5v321.7c0,23.699,19.3,42.9,42.9,42.9h504.6 c23.7,0,42.9-19.301,42.9-42.9v-321.7c0-23.7-19.3-42.9-42.9-42.9H124.7c-3,0-5.4-2.4-5.4-5.4s2.4-5.4,5.4-5.4h433.6 c29.601,0,53.7,24.1,53.7,53.7v321.7C612,496.5,587.9,520.6,558.3,520.6z"/>',
				'dim' => 612
			),
			'a07' => array(
				'path' => '<path d="M483.25,93.254L272.11,264.078c-11.245,9.182-29.682,9.182-40.927,0L20.043,93.254C12.852,87.44,0,92.489,0,103.046 v298.122c0,14.457,11.857,26.314,26.316,26.314h451.58c14.458,0,26.316-11.857,26.316-26.314V103.046 C504.135,91.265,491.742,86.445,483.25,93.254z"/><path d="M53.473,93.254l178.322,144.203c11.246,9.027,29.682,9.027,40.928,0L450.968,93.254 c11.245-9.027,8.645-16.524-5.814-16.524H59.288C44.676,76.807,42.228,84.227,53.473,93.254z"/>',
				'dim' => 504.212
			),
			'a09' => array(
				'path' => '<path d="M116.318,18.313c0,0-0.303-2.92-2.208-5.849c-2.767-4.298-12.408-8.75-18.96-11.216c-3.021-1.131-8.057-1.54-11.243-1.036 C74.776,1.654,40.28,9.141,40.28,9.141c-10.181,1.983-15.047,3.845-18.453,6.381c-6.484,5.316-8.432,12.907-8.96,18.107 c-0.327,3.207-0.042,8.441,0.002,11.666l0.213,17.285c0.041,3.224,2.473,6.865,5.437,8.128c6.829,2.911,18.655,7.932,26.43,11.139 c2.979,1.229,5.405-0.427,5.398-3.647l-0.101-34.582c0,0,0.448-5.965-3.737-11.805c-5.515-7.696-16.396-13.863-27.184-3.361 c-2.396,2.153-2.619,1.75-1.678-1.035c2.708-6.29,11.121-14.138,24.188-8.84c11.544,5.752,13.917,13.333,14.989,19.527 c0.659,3.161,0.876,8.418,0.876,11.644v27.205c0,3.224,1.607,4.18,4.191,2.245c0.5-0.374,0.856-0.785,1.499-1.234 c2.64-1.854,4.756-0.606,4.747,2.616l-0.146,42.645c-0.009,1.538,0.603,3.014,1.688,4.104c1.086,1.093,2.56,1.704,4.1,1.704h4.423 c3.191,0,5.787-2.591,5.787-5.787V72.62c0-3.224,2.479-7.238,5.167-9.015c9.607-6.361,17.703-12.553,22.57-16.3 c2.558-1.964,4.592-5.884,4.592-9.107C116.316,38.198,116.318,18.313,116.318,18.313z"/>',
				'dim' => 129.03
			),
			'a10' => array(
				'path' => '<path d="M369.23,322.594h-70.348l65.885-65.885c6.279-6.279,6.279-16.461,0-22.74L167.147,36.349c-6.28-6.28-16.461-6.28-22.741,0 L19.463,161.291c-6.28,6.28-6.28,16.462,0,22.741l138.56,138.562H15c-8.284,0-15,6.716-15,14.999c0,8.284,6.716,15,15,15h354.23 c8.283,0,15-6.716,15-15C384.23,329.31,377.515,322.594,369.23,322.594z M304.209,218.891l-100.578-21.407L182.224,96.905 L304.209,218.891z M53.574,172.661l91.592-91.592l28.464,133.732c0.677,3.18,2.258,6.013,4.465,8.219 c2.207,2.207,5.039,3.788,8.219,4.465l133.73,28.464l-66.643,66.646h-49.896L53.574,172.661z"/>',
				'dim' => 384.23
			),
			'a11' => array(
				'path' => '<path id="mail" style="fill:#010002;" d="M28,5.5H4c-2.209,0-4,1.792-4,4v13c0,2.209,1.791,4,4,4h24c2.209,0,4-1.791,4-4v-13 C32,7.292,30.209,5.5,28,5.5z M2,10.75L8.999,16L2,21.25V10.75z M30,22.5c0,1.104-0.898,2-2,2H4c-1.103,0-2-0.896-2-2l7.832-5.875 l4.368,3.277c0.533,0.398,1.166,0.6,1.8,0.6c0.633,0,1.266-0.201,1.799-0.6l4.369-3.277L30,22.5L30,22.5z M30,21.25L23,16l7-5.25 V21.25z M17.199,19.102c-0.349,0.262-0.763,0.4-1.199,0.4s-0.851-0.139-1.2-0.4L10.665,16l-0.833-0.625L2,9.501V9.5 c0-1.103,0.897-2,2-2h24c1.102,0,2,0.897,2,2L17.199,19.102z"/>',
				'dim' => 32
			),
			'a12' => array(
				'path' => '<path d="M607.283,392.158L493.307,278.175c-5.086-5.105-11.073-6.318-17.953-3.574c-6.879,2.68-10.173,7.786-10.173,15.253v58.013 c-40.979,7.212-80.976,22.593-108.891,38.867c-27.43,16.019-53.845,37.143-69.404,52.971 c-15.553,15.892-28.968,33.824-33.806,41.292c-2.342,3.638-3.963,6.254-4.787,7.786c-3.963,7.403-3.223,14.614,2.993,20.358 c5.463,5.042,14.06,5.68,20.046,1.787c1.194-1.213,11.647-7.531,35.299-17.934c11.647-5.17,24.577-10.084,38.592-14.679 c14.104-4.659,31.132-8.871,50.559-12.254c19.766-3.51,39.187-5.425,58.332-5.425h11.066v56.545 c0,6.893,3.294,11.999,10.173,15.254c2.394,0.893,4.487,1.212,6.28,1.212c4.493,0,8.373-1.531,11.673-4.786l113.977-113.409 C613.583,409.198,613.563,398.413,607.283,392.158z M498.093,477.422v-32.038c0-8.68-6.586-16.146-15.259-16.466 c-6.28-0.894-15.854-1.148-28.72-1.148c-42.778,0-85.857,7.147-128.636,21.826c46.371-39.186,99.036-62.735,158.549-70.904 c8.093-1.085,14.066-7.786,14.066-16.466v-32.612l73.591,74.224L498.093,477.422z"/> <path d="M33.206,497.462V165.404l230.947,236.009c3.255,3.318,7.18,4.786,11.667,4.786h0.6c5.08,0,9.011-1.468,12.26-4.786 l230.354-236.009v87.626h32.905V115.114c0-20.295-15.56-36.761-35.898-36.761H36.192c-10.167,0-18.846,3.574-25.726,10.722 C3.587,96.287,0,104.966,0,115.114v382.349c0,9.892,3.51,18.635,10.467,25.719c6.81,6.957,15.559,10.467,25.726,10.467h175.909 v-33.187H36.192C34.099,500.461,33.206,499.568,33.206,497.462z M33.206,115.114c0-2.362,0.894-3.574,2.987-3.574h479.847 c2.094,0,2.994,1.212,2.994,3.574v2.999L276.419,366.439L33.206,118.113V115.114z"/>',
				'dim' => 612.001
			),
			'a13' => array(
				'path' => '<path style="fill:#010002;" d="M306,612c-28.152,0-55.284-3.672-81.396-11.016c-26.112-7.347-50.49-17.646-73.134-30.906 s-43.248-29.172-61.812-47.736c-18.564-18.562-34.476-39.168-47.736-61.812c-13.26-22.646-23.562-47.022-30.906-73.135 C3.672,361.284,0,334.152,0,306s3.672-55.284,11.016-81.396s17.646-50.49,30.906-73.134s29.172-43.248,47.736-61.812 s39.168-34.476,61.812-47.736s47.022-23.562,73.134-30.906S277.848,0,306,0c42.024,0,81.702,8.058,119.034,24.174 s69.768,37.944,97.308,65.484s49.368,59.976,65.484,97.308S612,263.976,612,306c0,28.152-3.672,55.284-11.016,81.396 c-7.347,26.109-17.646,50.487-30.906,73.134c-13.26,22.644-29.172,43.248-47.736,61.812 c-18.562,18.564-39.168,34.479-61.812,47.736c-22.646,13.26-47.022,23.562-73.136,30.906C361.284,608.328,334.152,612,306,612z M453.492,179.928H163.404c-2.856,0-5.304,0.918-7.344,2.754s-3.06,4.386-3.06,7.65v32.436c0,1.632,0.612,2.448,1.836,2.448 l152.388,86.904l1.227,0.612c0.813,0,1.428-0.204,1.836-0.612l147.492-86.904c0.813-0.408,1.428-0.612,1.836-0.612 c0.405,0,1.02-0.204,1.836-0.612c1.632,0,2.448-0.816,2.448-2.448v-31.212c0-3.264-1.021-5.814-3.063-7.65 S456.348,179.928,453.492,179.928z M245.412,310.284c0.408-0.408,0.612-1.021,0.612-1.836c0-1.227-0.408-1.836-1.224-1.836 l-87.516-50.185c-1.224-0.408-2.244-0.408-3.06,0c-0.816,0-1.224,0.612-1.224,1.836v131.58c0,1.227,0.612,2.04,1.836,2.448h1.224 c0.816,0,1.224-0.204,1.224-0.612L245.412,310.284z M351.9,320.076c-0.408-1.227-1.431-1.428-3.063-0.612l-33.66,19.584 c-4.08,2.448-8.361,2.448-12.852,0l-29.376-16.521c-1.224-0.816-2.244-0.816-3.06,0l-111.996,104.04 c-0.408,0.405-0.612,1.224-0.612,2.445c0,0.408,0.408,1.021,1.224,1.836c2.448,0.816,4.08,1.227,4.896,1.227H450.43 c0.816,0,1.635-0.408,2.448-1.227c0-1.632-0.204-2.649-0.612-3.06L351.9,320.076z M462.06,253.98h-2.445l-83.232,49.572 c-0.813,0-1.224,0.612-1.224,1.836c-0.408,0.408-0.204,1.02,0.609,1.833L459,397.188c0.816,0.816,1.428,1.227,1.836,1.227h1.224 c1.227-1.227,1.839-2.04,1.839-2.448V256.429C463.896,255.612,463.284,254.796,462.06,253.98z"/>',
				'dim' => 612
			),
			'a14' => array(
				'path' => '<path d="M153.188,27.208c-37.562,1.134-130,55.057-144.495,63.65l-7.981,32.664l40.236,28.809l-7.733-27.01l189.62-54.288 l26.895,93.949l58.098-41.331l-10.004-32.698C283.848,82.656,190.877,28.342,153.188,27.208z"/> <polygon points="308.728,281.52 308.728,195.199 308.728,160.289 308.728,136.255 306.809,137.621 252.882,175.988  222.101,197.888 226.557,202.27 231.942,207.581 237.326,212.886 243.833,219.288 307.02,281.52 		"/> <polygon points="0,137.415 0,150.224 0,281.52 1.479,281.52 60.832,221.766 66.667,215.892 72.127,210.391 77.588,204.891  85.158,197.271 45.731,169.042 8.147,142.135 0,136.299 		"/> <path d="M231.905,222.705l-9.692-9.545l-5.39-5.311l-5.39-5.31l-1.382-1.366l-5.489-5.4l-0.954-0.938 c-1.599-1.576-3.27-3.053-4.989-4.461c-12.777-10.457-28.655-16.158-45.399-16.158c-16.767,0-32.616,5.69-45.394,16.137 c-1.938,1.582-3.813,3.265-5.598,5.058l-0.334,0.338l-5.363,5.399l-3.452,3.48l-5.458,5.495l-5.46,5.495l-17.921,18.046 l-47.276,47.593h274.396L231.905,222.705z"/>',
				'dim' => 308.728
			),
			'a15' => array(
				'path' => '<path style="fill:#010002;" d="M122.102,164.235c-5.526-2.355-13.135-8.469-17.557-12.537L8.817,63.613 c-4.422-4.068-8.224-12.553-5.27-17.791c2.399-4.259,6.908-8.202,15.371-8.202h244.975c0,0,10.715,0.234,15.735,8.806 c3.04,5.183-1.072,13.712-5.532,17.742l-105.05,94.895C169.046,159.063,148.775,175.592,122.102,164.235z M19.499,245.12 c0,0-19.499-1.73-19.499-18.852V86.381c0-6.005,3.465-7.457,7.745-3.236l41.418,40.875c4.281,4.221,5.842,12.124,3.492,17.655 l-29.779,70.077c-2.35,5.532-1.256,6.173,2.442,1.441l41.603-53.243c3.699-4.737,10.497-5.526,15.18-1.768l18.428,14.789 c4.688,3.758,12.912,8.877,18.602,10.791c13.505,4.525,37.464,9.709,52.688-3.41l26.809-22.404 c4.612-3.851,11.286-3.095,14.914,1.697l44.018,58.133c3.628,4.792,4.716,4.172,2.431-1.387l-30.421-74.026 c-2.284-5.559-0.674-13.489,3.595-17.72l41.854-41.473c4.27-4.226,7.729-2.785,7.729,3.22v141.1c0,0-1.159,17.639-20.587,17.639 H19.499V245.12z"/>',
				'dim' => 282.75
			),
			'a16' => array(
				'path' => '<path d="M454.164,128.166H193.578c-8.242,0-16.293,6.679-17.988,14.92l-37.041,180.16c-1.691,8.24,3.619,14.92,11.854,14.92 h260.592c8.242,0,16.293-6.679,17.986-14.92l37.035-180.16C467.713,134.845,462.406,128.166,454.164,128.166z M422.99,188.459 l-115.646,55.773c-4.988,2.409-10.67,2.409-14.67,0l-92.713-55.773c-6.723-4.042-7.641-13.477-2.043-21.032 c3.748-5.062,9.65-8.21,15.398-8.21c2.539,0,4.941,0.636,6.945,1.841l86.184,51.849l107.51-51.849 c2.492-1.204,5.156-1.84,7.701-1.84c5.746,0,10.354,3.146,12.021,8.203C436.172,174.979,431.377,184.418,422.99,188.459z"/> <path d="M40.877,167.508H153.15c5.945,0,10.76-4.817,10.76-10.757c0-5.942-4.814-10.757-10.76-10.757H40.877 c-5.939,0-10.758,4.815-10.758,10.757C30.119,162.691,34.937,167.508,40.877,167.508z"/> <path d="M123.035,243.88H10.76C4.817,243.88,0,248.695,0,254.635c0,5.942,4.816,10.758,10.76,10.758h112.275 c5.938,0,10.756-4.814,10.756-10.758C133.791,248.695,128.973,243.88,123.035,243.88z"/> <path d="M148.848,205.066c0-5.941-4.813-10.755-10.752-10.755H70.992c-5.939,0-10.752,4.814-10.752,10.755 c0,5.939,4.813,10.756,10.752,10.756h67.104C144.035,215.822,148.848,211.006,148.848,205.066z"/> <path d="M107.973,292.193H72.121c-5.943,0-10.76,4.814-10.76,10.758c0,5.938,4.816,10.757,10.76,10.757h35.852 c5.945,0,10.76-4.817,10.76-10.757C118.732,297.009,113.918,292.193,107.973,292.193z"/>',
				'dim' => 466.332
			),
			'b01' => array(
				'path' => '<path d="M93.82,0.37c-0.697-0.469-1.6-0.494-2.32-0.066L3.388,52.585c-0.748,0.444-1.158,1.291-1.043,2.152 c0.113,0.86,0.732,1.571,1.568,1.805l22.389,6.233c0.68,0.188,1.409,0.036,1.956-0.41l35.768-29.219L39.075,64.993	c-0.301,0.382-0.462,0.854-0.462,1.339v28.602c0,0.966,0.636,1.814,1.563,2.083c0.201,0.06,0.405,0.087,0.607,0.087	c0.728,0,1.425-0.366,1.83-1.004l15.577-24.45l22.772,6.338c0.598,0.167,1.24,0.067,1.764-0.271 c0.521-0.339,0.873-0.885,0.967-1.499L94.753,2.493C94.878,1.665,94.515,0.838,93.82,0.37z"/>',
				'dim' => 97.104
			),
			'b02' => array(
				'path' => '<path d="M1.286,12.465c-0.685,0.263-1.171,0.879-1.268,1.606c-0.096,0.728,0.213,1.449,0.806,1.88l6.492,4.724L30.374,2.534 L9.985,22.621l8.875,6.458c0.564,0.41,1.293,0.533,1.964,0.33c0.67-0.204,1.204-0.713,1.444-1.368l9.494-25.986 c0.096-0.264,0.028-0.559-0.172-0.756c-0.199-0.197-0.494-0.259-0.758-0.158L1.286,12.465z"/><path d="M5.774,22.246l0.055,0.301l1.26,6.889c0.094,0.512,0.436,0.941,0.912,1.148c0.476,0.206,1.025,0.162,1.461-0.119 c1.755-1.132,4.047-2.634,3.985-2.722L5.774,22.246z"/>',
				'dim' => 32
			),
			'b03' => array(
				'path' => '<path d="M0,204.3c52.9,24.5,105.8,48.9,158.8,73.4c32,14.8,64.1,29.6,96.1,44.4c10.9,5.1,22,6.8,27.1,17.8	c42,90.4,84,180.9,126.1,271.3c36.1-108.1,72.2-216.1,108.4-324.2C548.2,191.6,580.1,96.2,612,0.8c-108.4,36-216.7,72-325.1,108.1 C191.3,140.7,95.6,172.5,0,204.3z M406.2,504.1c-26.4-56.8-52.8-113.5-79.1-170.3c-4.6-10-9.3-20-13.9-29.9c-1.8-4-5.2-4.5-9.2-6.3 c-30.5-14.1-60.9-28.2-91.4-42.2c-34.7-16-69.3-32-104-48c118.9-39.5,237.7-79,356.6-118.5c30-10,59.9-19.9,89.9-29.9 c-39.8,119-79.6,238-119.3,357C425.8,445.3,416,474.7,406.2,504.1z"/>',
				'dim' => 612
			),
			'b04' => array(
				'path' => '<polygon points="0,204.286 278.804,333.12 408.003,611.153 612,0.847"/>',
				'dim' => 612
			),
			'b05' => array(
				'path' => '<g><path d="M24.408,0.597L0.706,13.026c-0.975,0.511-0.935,1.26,0.088,1.665l3.026,1.196c1.021,0.404,2.569,0.185,3.437-0.494	L20.399,5.03c0.864-0.681,0.957-0.58,0.206,0.224l-10.39,11.123c-0.753,0.801-0.529,1.783,0.495,2.182l0.354,0.139 c1.024,0.396,2.698,1.062,3.717,1.478l3.356,1.366c1.02,0.415,1.854,0.759,1.854,0.765c0,0.006,0.006,0.025,0.011,0.026 c0.005,0.002,0.246-0.864,0.534-1.926L25.654,1.6C25.942,0.537,25.383,0.087,24.408,0.597z"/><path d="M10.324,19.82l-2.322-0.95c-1.018-0.417-1.506,0.072-1.084,1.089c0.001,0,2.156,5.194,2.096,5.377 c-0.062,0.182,2.068-3.082,2.068-3.082C11.684,21.332,11.342,20.237,10.324,19.82z"/></g>',
				'dim' => 25.73
			),
			'b06' => array(
				'path' => '<path d="M332.797,13.699c-1.489-1.306-3.608-1.609-5.404-0.776L2.893,163.695c-1.747,0.812-2.872,2.555-2.893,4.481 s1.067,3.693,2.797,4.542l91.833,45.068c1.684,0.827,3.692,0.64,5.196-0.484l89.287-66.734l-70.094,72.1 c-1,1.029-1.51,2.438-1.4,3.868l6.979,90.889c0.155,2.014,1.505,3.736,3.424,4.367c0.513,0.168,1.04,0.25,1.561,0.25 c1.429,0,2.819-0.613,3.786-1.733l48.742-56.482l60.255,28.79c1.308,0.625,2.822,0.651,4.151,0.073 c1.329-0.579,2.341-1.705,2.775-3.087L334.27,18.956C334.864,17.066,334.285,15.005,332.797,13.699z"/>',
				'dim' => 334.5
			),
			'b07' => array(
				'path' => '<path d="M31.984,1.005c0-0.037,0-0.072-0.004-0.107s-0.003-0.07-0.012-0.104c-0.005-0.021-0.016-0.038-0.02-0.057 c-0.012-0.037-0.023-0.073-0.038-0.108c-0.009-0.021-0.012-0.043-0.021-0.064c-0.019-0.03-0.037-0.058-0.059-0.088 c-0.018-0.029-0.037-0.057-0.058-0.083c-0.03-0.038-0.062-0.076-0.096-0.11c-0.009-0.008-0.013-0.018-0.02-0.025 c-0.016-0.014-0.035-0.017-0.051-0.029c-0.019-0.015-0.034-0.028-0.052-0.041c-0.015-0.01-0.021-0.023-0.033-0.032 c-0.004-0.003-0.009-0.003-0.015-0.005c-0.007-0.005-0.011-0.011-0.018-0.014c-0.038-0.023-0.081-0.032-0.121-0.049 c-0.032-0.014-0.062-0.028-0.096-0.038c-0.03-0.011-0.062-0.019-0.091-0.024c-0.036-0.008-0.07-0.008-0.107-0.012 C31.039,0.009,30.995,0,30.95,0c-0.013,0.002-0.024,0.007-0.036,0.008c-0.021,0.001-0.047,0.009-0.072,0.013 c-0.037,0.006-0.069,0.01-0.105,0.02c-0.041,0.012-0.08,0.024-0.119,0.042c-0.031,0.013-0.062,0.028-0.091,0.046 c-0.026,0.014-0.057,0.023-0.081,0.04c-0.007,0.005-0.017,0.007-0.021,0.011h-0.001L0.429,21.172 c-0.357,0.25-0.512,0.704-0.381,1.12c0.131,0.415,0.519,0.698,0.953,0.698h10v8c0,0.037,0.019,0.068,0.021,0.104 c0.008,0.069,0.02,0.135,0.04,0.2c0.021,0.062,0.046,0.116,0.074,0.172c0.031,0.056,0.064,0.104,0.105,0.154 c0.044,0.054,0.093,0.099,0.147,0.141c0.027,0.023,0.045,0.056,0.074,0.074c0.031,0.021,0.065,0.026,0.098,0.043 c0.031,0.017,0.062,0.029,0.095,0.043c0.113,0.041,0.227,0.069,0.344,0.069h0.003c0.119-0.002,0.234-0.028,0.347-0.07 c0.022-0.009,0.047-0.018,0.069-0.027c0.103-0.045,0.195-0.104,0.277-0.187c0.014-0.015,0.022-0.029,0.036-0.043 c0.04-0.045,0.081-0.086,0.113-0.14l3.614-5.709c0.022,0.017,0.038,0.039,0.062,0.053l11,6.001 c0.295,0.157,0.647,0.164,0.945,0.006c0.298-0.156,0.494-0.451,0.527-0.785l2.99-29.99C31.992,1.066,31.984,1.037,31.984,1.005z M11.56,20.99H4.175L24.306,6.899L11.56,20.99z M13.001,27.543v-5.166l10.902-12.051L13.001,27.543z M27.157,29.391l-9.632-5.252 L29.58,5.102L27.157,29.391z"/>',
				'dim' => 31.991
			),
			'b08' => array(
				'path' => '<path style="fill:#010002;" d="M9.407,17.099l-1.143-0.173c-0.214-0.032-0.431,0.036-0.587,0.187 c-0.156,0.151-0.233,0.365-0.208,0.58l1.196,10.535c0.016,0.15,0.142,0.262,0.291,0.262h0.005 c0.153-0.002,0.276-0.121,0.286-0.273l0.614-10.556C9.876,17.384,9.68,17.141,9.407,17.099z"/> <path style="fill:#010002;" d="M20.788,18.95l-9.49-1.445c-0.08-0.012-0.163,0.008-0.227,0.058s-0.105,0.124-0.113,0.206 l-0.944,10.732c-0.011,0.115,0.049,0.226,0.152,0.282c0.044,0.024,0.091,0.035,0.14,0.035c0.063,0,0.126-0.02,0.179-0.06 l10.436-9.288c0.092-0.073,0.133-0.192,0.104-0.304C20.996,19.052,20.903,18.969,20.788,18.95z"/> <path style="fill:#010002;" d="M36.258,7.616c-0.078-0.1-0.21-0.141-0.329-0.099l-35.691,6.71C0.102,14.25,0.002,14.369,0,14.507 c-0.003,0.138,0.092,0.262,0.227,0.291l7.667,1.369c0.38,0.068,0.77,0.044,1.139-0.067l19.056-5.757l-16.038,5.99 c-0.13,0.039-0.216,0.163-0.206,0.298c0.009,0.135,0.109,0.247,0.243,0.269l15.557,2.465c0.456,0.072,0.914-0.125,1.176-0.507 l7.446-10.899C36.338,7.854,36.334,7.716,36.258,7.616z"/>',
				'dim' => 36.318
			),
			'c01' => array(
				'path' => '<g><path d="M306.001,325.988c90.563-0.005,123.147-90.682,131.679-165.167C448.188,69.06,404.799,0,306.001,0 c-98.782,0-142.195,69.055-131.679,160.82C182.862,235.304,215.436,325.995,306.001,325.988z"/><path d="M550.981,541.908c-0.99-28.904-4.377-57.939-9.421-86.393c-6.111-34.469-13.889-85.002-43.983-107.465 c-17.404-12.988-39.941-17.249-59.865-25.081c-9.697-3.81-18.384-7.594-26.537-11.901c-27.518,30.176-63.4,45.962-105.186,45.964 c-41.774,0-77.652-15.786-105.167-45.964c-8.153,4.308-16.84,8.093-26.537,11.901c-19.924,7.832-42.461,12.092-59.863,25.081 c-30.096,22.463-37.873,72.996-43.983,107.465c-5.045,28.454-8.433,57.489-9.422,86.393	c-0.766,22.387,10.288,25.525,29.017,32.284c23.453,8.458,47.666,14.737,72.041,19.884c47.077,9.941,95.603,17.582,143.921,17.924 c48.318-0.343,96.844-7.983,143.921-17.924c24.375-5.145,48.59-11.424,72.041-19.884	C540.694,567.435,551.747,564.297,550.981,541.908z"/></g>',
				'dim' => 612
			),
			'c02' => array('path' => '<path d="M407.448,360.474c-59.036-13.617-113.989-25.541-87.375-75.717 c81.01-152.729,21.473-234.406-64.072-234.406c-87.231,0-145.303,84.812-64.072,234.406c27.412,50.482-29.608,62.393-87.375,75.717 c-59.012,13.609-54.473,44.723-54.473,101.176h411.838C461.919,405.196,466.458,374.083,407.448,360.474z"/>'),
			'c03' => array(
				'path' => '<path d="M138.46,164.287c-38.628,0-69.925-37.519-69.925-83.767C68.535,34.277,99.832,0,138.46,0 c38.634,0,69.957,34.277,69.957,80.52C208.417,126.768,177.093,164.287,138.46,164.287z M29.689,277.528 c0,0-14.832,0.979-21.365-8.023c-3.53-4.863-1.071-14.718,1.343-20.217l5.912-13.473c0,0,16.35-36.567,34.962-57.757 c11.433-12.994,25.031-10.035,33.826-5.809c5.417,2.6,11.542,10.176,16.018,14.191c6.168,5.532,17.057,11.819,34.859,12.173h10.922	c17.791-0.354,28.68-6.641,34.843-12.173c4.471-4.014,10.427-11.825,15.795-14.511c8.072-4.041,20.358-6.527,31.492,6.13 c18.618,21.191,33.363,58.421,33.363,58.421l6.059,13.212c2.507,5.461,5.075,15.267,1.643,20.195 c-6.124,8.811-19.874,7.642-19.874,7.642S29.689,277.528,29.689,277.528z"/>',
				'dim' => 277.58
			),
			'c04' => array(
				'path' => '<path d="M322.553,627.639c-36.899,0-74.1-2.601-111.399-7.7c-27.3-3.5-56.1-8.8-85.8-15.9c-2.9-0.7-4.7-3.6-4-6.5 c0.7-2.899,3.6-4.7,6.5-4c29.3,7,57.8,12.3,84.7,15.7c76.5,10.5,152.6,10.1,226.2-1.2c36.101-5.2,73.3-13.6,110.7-24.8 c4.5-1.5,9.2-2.8,14.2-4.2c13.3-3.8,27.1-7.8,38.2-14.1c2-1.2,4-3,5.6-5.101c3.5-5.5,1-14.1-1.9-21.8l-0.699-2.1 c-7.5-22-15.301-44.8-28.5-63.7c-18.2-25.5-41.2-33.1-71.801-41.1h-0.199c-23.9-6-48.601-12.101-73.4-18.2 c-1.3-0.3-2.4-0.601-3.6-0.9c-8.2-2.1-16.601-4.3-23.801-9.7c-18.8-12.8-27.199-39.6-27.199-60.399 c0-24.4,11.899-39.301,23.399-53.701c5.4-6.8,11.101-13.8,15.601-22c13.5-24.1,20.6-51.8,20.6-80.2c0-39.2-14.1-75.1-41.8-106.5 c-17.4-17.4-22.3-27.4-16.5-33.5c7.3-8.3,15.899-22.2,17.399-32.5c-22.1,10.9-43.1,21-69.199,25.6c-37.7,6.4-68.5,13.3-93.3,38.6 c-26.9,27.4-42.3,67.1-42.3,108.9c0,27.4,6.7,54.1,19.4,77.2c4.2,7.5,9.8,14.5,15.3,21.4c10.7,13.5,21.7,27.4,24.3,46.3 c3.3,23.5-5.8,56.7-26.6,71.5c-8.2,5.5-17.9,8-27.3,10.5c-23.9,6-48.5,12.101-73.8,18.3c-21.9,5.2-41.3,10.4-56.3,22.7	c-24.3,19.601-33.1,52.8-40.2,79.4c-2.1,8.2-4.7,19.2-6.6,30c-0.5,2.899-3.3,4.899-6.2,4.399s-4.9-3.3-4.4-6.199 c2-11.2,4.7-22.301,6.8-30.801c7.5-28.199,16.8-63.3,43.9-85.1c16.8-13.7,37.4-19.3,60.6-24.8c25.2-6.2,49.8-12.3,73.6-18.2 c8.9-2.399,17.3-4.6,23.9-9c17.1-12.1,24.8-41.2,22-61.2c-2.2-16-11.8-28.2-22.1-41c-5.7-7.2-11.6-14.6-16.2-22.8 c-13.6-24.8-20.8-53.2-20.8-82.4c0-44.5,16.5-87,45.4-116.4c27.1-27.7,59.5-35,99.1-41.7c24.9-4.3,44.5-14,67.2-25.1l6.2-3.1 c1.4-0.7,3-0.7,4.5-0.1c1.4,0.6,2.5,1.8,3,3.3c5.9,18.4-14.7,44-18.7,48.9c0.7,2.2,4.3,8.3,15.5,19.6c0.101,0.1,0.2,0.2,0.2,0.2	c29.6,33.5,44.6,71.8,44.6,113.8c0,30.2-7.6,59.8-22,85.4c-5,8.9-10.899,16.3-16.6,23.5c-11.3,14.1-21.1,26.3-21.1,47 c0,17.399,7.1,41,22.6,51.6c0.1,0,0.1,0.101,0.2,0.101c5.5,4.1,12.6,6,20.2,7.899c1.199,0.3,2.399,0.601,3.6,0.9 c24.8,6,49.5,12.2,73.4,18.2l0.199,0.1c31.801,8.3,57.7,16.9,78,45.3c14.101,20.2,22.101,43.7,29.9,66.4l0.7,1.899 c3.8,10.2,6.899,22,0.6,31.5c-0.1,0.101-0.1,0.2-0.2,0.2c-2.5,3.3-5.5,6.101-8.8,8.101c-12.3,7.1-26.7,11.199-40.7,15.199	c-4.899,1.4-9.6,2.7-14,4.2c-38,11.4-75.8,19.9-112.3,25.2C401.654,624.739,362.253,627.639,322.553,627.639z"/>',
				'dim' => 627.639
			),
			'c05' => array(
				'path' => '<path d="M204.583,216.671c50.664,0,91.74-48.075,91.74-107.378c0-82.237-41.074-107.377-91.74-107.377 c-50.668,0-91.74,25.14-91.74,107.377C112.844,168.596,153.916,216.671,204.583,216.671z"/><path d="M407.164,374.717L360.88,270.454c-2.117-4.771-5.836-8.728-10.465-11.138l-71.83-37.392 c-1.584-0.823-3.502-0.663-4.926,0.415c-20.316,15.366-44.203,23.488-69.076,23.488c-24.877,0-48.762-8.122-69.078-23.488 c-1.428-1.078-3.346-1.238-4.93-0.415L58.75,259.316c-4.631,2.41-8.346,6.365-10.465,11.138L2.001,374.717 c-3.191,7.188-2.537,15.412,1.75,22.005c4.285,6.592,11.537,10.526,19.4,10.526h362.861c7.863,0,15.117-3.936,19.402-10.527 C409.699,390.129,410.355,381.902,407.164,374.717z"/>',
				'dim' => 409.165
			),
			'c06' => array(
				'path' => '<g><path d="M175,171.173c38.914,0,70.463-38.318,70.463-85.586C245.463,38.318,235.105,0,175,0s-70.465,38.318-70.465,85.587 C104.535,132.855,136.084,171.173,175,171.173z"/><path d="M41.909,301.853C41.897,298.971,41.885,301.041,41.909,301.853L41.909,301.853z"/><path d="M308.085,304.104C308.123,303.315,308.098,298.63,308.085,304.104L308.085,304.104z"/><path d="M307.935,298.397c-1.305-82.342-12.059-105.805-94.352-120.657c0,0-11.584,14.761-38.584,14.761 s-38.586-14.761-38.586-14.761c-81.395,14.69-92.803,37.805-94.303,117.982c-0.123,6.547-0.18,6.891-0.202,6.131 c0.005,1.424,0.011,4.058,0.011,8.651c0,0,19.592,39.496,133.08,39.496c113.486,0,133.08-39.496,133.08-39.496 c0-2.951,0.002-5.003,0.005-6.399C308.062,304.575,308.018,303.664,307.935,298.397z"/></g>',
				'dim' => 350
			),
			'c07' => array(
				'path' => '<path d="M466.121,401.586c52.287-41.184,85.985-104.92,85.985-176.654C552.106,100.708,451.398,0,327.174,0 S102.242,100.708,102.242,224.932c0,71.733,33.699,135.47,85.985,176.654C94.471,449.373,28.484,543.764,21.184,654.348h40.958 c7.893-103.549,75.209-190.332,167.861-226.793c29.446,14.15,62.327,22.311,97.171,22.311c34.865,0,67.725-8.16,97.17-22.311 c92.652,36.461,159.968,123.244,167.861,226.793h40.958C625.884,543.764,559.876,449.373,466.121,401.586z M327.174,408.969 c-101.649,0-184.036-82.387-184.036-184.037c0-101.649,82.387-184.035,184.036-184.035s184.036,82.386,184.036,184.035 C511.209,326.582,428.823,408.969,327.174,408.969z"/>',
				'dim' => 654.348
			),
			'c08' => array(
				'path' => '<path d="M31.751,26.057l-3.572-0.894c1.507-1.339,2.736-3.181,3.559-5.2c1.152-0.255,2.209-1.214,2.383-3.327 c0.164-1.99-0.444-2.877-1.26-3.264c-0.01-0.237-0.021-0.469-0.035-0.696c1.049-5.812-3.103-7.843-3.426-7.941 c-0.541-0.822-4.207-5.821-10.858-1.763c-0.974,0.594-2.519,1.764-3.344,2.942c-0.992,1.246-1.713,3.049-2.009,5.655 c-0.205,0.022-0.409,0.054-0.611,0.1c-0.054-1.279,0.017-5.048,2.405-7.728c1.766-1.981,4.448-2.986,7.968-2.986 c3.526,0,6.263,1.013,8.135,3.009c3.075,3.28,2.797,8.175,2.794,8.224c-0.018,0.262,0.182,0.489,0.443,0.506 c0.012,0.001,0.021,0.001,0.033,0.001c0.248,0,0.457-0.193,0.475-0.445c0.015-0.217,0.312-5.345-3.045-8.933 C29.727,1.116,26.754,0,22.95,0c-3.808,0-6.73,1.114-8.686,3.312c-2.859,3.213-2.706,7.66-2.625,8.695 c-1.113,0.595-1.917,1.89-1.689,4.662c0.301,3.653,2.422,4.926,4.428,4.926c0.39,0,0.734-0.084,1.038-0.239 c1.148,0.743,2.991,1.387,5.944,1.507c0.29,0.436,0.896,0.735,1.6,0.735c0.982,0,1.779-0.586,1.779-1.309 c0-0.723-0.797-1.309-1.779-1.309c-0.801,0-1.478,0.389-1.701,0.924c-1.937-0.092-3.324-0.421-4.315-0.836 c-1.353-1.819-1.996-4.907-1.996-6.671c0-0.653,0.021-1.26,0.059-1.825c6.256,0.21,9.975-2.319,12.007-4.516 c2.617,2.608,3.548,6.138,3.858,7.825c-0.606,4.628-3.906,9.54-7.912,9.54c-1.723,0-3.316-0.909-4.62-2.313 c-1.332-0.278-2.441-0.713-3.323-1.303c0.72,1.287,1.614,2.438,2.645,3.352l-3.58,0.898c-4.889,1.225-8.28,5.598-8.28,10.637v6.033 c0,1.711,1.347,3.129,3.058,3.129h28.09c1.711,0,3.102-1.418,3.102-3.129v-6.033C40.053,31.654,36.64,27.279,31.751,26.057z M30.272,27.652l-4.65,3.183l-1.416-3.622c0.64-0.12,1.259-0.33,1.853-0.617L30.272,27.652z M19.786,26.589 c0.583,0.28,1.194,0.488,1.827,0.61l-1.422,3.637l-4.651-3.184L19.786,26.589z M18.753,43.896h-5.352v-2.533 c0-0.264-0.211-0.477-0.475-0.477c-0.263,0-0.475,0.213-0.475,0.477v2.533h-3.59c-0.66,0-1.159-0.512-1.159-1.172v-6.031 c0-4.088,2.702-7.646,6.624-8.73l5.872,4.025c0.06,0.615,0.572,1.119,1.229,1.137L18.753,43.896z M22.149,28.463l0.446-1.145 c0.121,0.006,0.542,0.008,0.631,0.004l0.445,1.141H22.149z M38.153,42.725c0,0.66-0.543,1.172-1.203,1.172h-3.605v-2.533 c0-0.264-0.211-0.477-0.475-0.477s-0.476,0.213-0.476,0.477v2.533h-5.343l-2.674-10.771c0.652-0.017,1.162-0.515,1.229-1.123 l5.9-4.039c3.922,1.083,6.645,4.642,6.645,8.729v6.031H38.153z"/>',
				'dim' => 45.854
			),
			'c09' => array(
				'path' => '<path d="M335.37,239.048l-55.617-16.857C373.739,222.191,321.072,0,230.639,0h-25.288C99.739,0,67.072,222.191,156.237,222.191 l-55.617,16.857c-39.159,11.254-62.512,180.444-62.512,180.444c-0.068,0.575-0.113,1.157-0.113,1.75 c0,8.146,6.602,14.748,14.748,14.748h330.504c8.147,0,14.748-6.602,14.748-14.748c0-0.593-0.045-1.175-0.113-1.75 C397.882,419.492,374.529,250.302,335.37,239.048z M182.362,230.367c1.503-1.063,3.467-1.214,5.115-0.393 c5.672,2.823,11.286,4.254,16.686,4.254h27.664c5.399,0,11.011-1.431,16.682-4.252c1.647-0.82,3.613-0.668,5.116,0.395 c1.502,1.063,2.299,2.866,2.074,4.692l-3.636,29.531c-0.063,0.516-0.207,1.019-0.425,1.491l-29.106,62.842 c-0.819,1.767-2.589,2.898-4.537,2.898c-1.948,0-3.718-1.13-4.537-2.898l-29.124-62.843c-0.219-0.473-0.363-0.977-0.426-1.494 l-3.621-29.533C180.062,233.231,180.86,231.429,182.362,230.367z M151.879,134.941c-1.419-0.922-2.275-2.5-2.275-4.192v-8.232 c0-2.761,2.239-5,5-5h2.043v-17.194c0-1.732,0.896-3.341,2.37-4.252c1.474-0.912,3.313-0.995,4.863-0.222 c7.685,3.835,17.945,4.278,24.994,4.278c4.759,0,9.534-0.238,13.747-0.449c1.304-0.065,2.569-0.128,3.785-0.182 c1.675-0.074,3.38-0.112,5.067-0.112c20.583,0,37.855,5.375,50.467,9.3c5.527,1.719,9.891,3.077,13.065,3.5 c2.484,0.331,4.34,2.45,4.34,4.956v0.377h2.043c2.761,0,5,2.239,5,5v8.232c0,1.692-0.856,3.27-2.275,4.192l-4.853,3.154l-0.27,2.059 c-1.58,11.956-8.287,27.444-17.942,41.438c-12.226,17.733-23.687,25.671-29.62,25.671h-26.862c-5.934,0-17.395-7.939-29.623-25.675 c-9.653-13.99-16.36-29.476-17.939-41.423l-0.271-2.071L151.879,134.941z"/>',
				'dim' => 435.99
			),
			'c10' => array(
				'path' => '<path d="M174.833,197.204c24.125,0,80.846-29.034,80.846-98.603C255.68,44.145,248.329,0,174.833,0 c-73.495,0-80.846,44.145-80.846,98.602C93.987,168.17,150.708,197.204,174.833,197.204z M106.07,82.146 c5.679-10.983,17.963-23.675,44.381-23.112c0,0,15.746,38.194,93.05,21.042c0.312,6.101,0.41,12.326,0.41,18.526 c0,34.005-15.015,55.075-27.612,66.762c-15.872,14.727-33.494,20.072-41.466,20.072c-7.972,0-25.594-5.345-41.466-20.072 c-12.597-11.687-27.612-32.757-27.612-66.762C105.756,93.101,105.836,87.581,106.07,82.146z"/> <path d="M324.926,298.327c-4.127-25.665-12.625-58.724-29.668-70.472c-11.638-8.024-52.243-29.718-69.582-38.982l-0.3-0.16 c-1.982-1.059-4.402-0.847-6.17,0.541c-9.083,7.131-19.033,11.937-29.573,14.284c-1.862,0.415-3.39,1.738-4.067,3.521 l-10.733,28.291l-10.733-28.291c-0.677-1.783-2.205-3.106-4.067-3.521c-10.54-2.347-20.49-7.153-29.573-14.284 c-1.768-1.388-4.188-1.601-6.17-0.541c-17.133,9.155-58.235,31.291-69.831,39.107c-19.619,13.217-28.198,61.052-29.718,70.507 c-0.151,0.938-0.063,1.897,0.253,2.792c0.702,1.982,18.708,48.548,149.839,48.548s149.137-46.566,149.839-48.548 C324.989,300.224,325.077,299.264,324.926,298.327z M264.5,282.666l-25.667,8l-25.667-8v-13.81H264.5V282.666z"/>',
				'dim' => 349.667
			),
			'c11' => array(
				'path' => '<path d="M224.274,240.756c-41.43-8.485-72.646-45.149-72.646-89.127c0-33.302,18.094-62.1,44.778-77.959 c8.499,18.316,25.856,37.031,49.753,50.848c31.332,18.078,64.558,22.535,86.119,13.903c0.653,4.354,1.307,8.679,1.307,13.208 c0,43.978-31.162,80.643-72.619,89.127c58.222-8.9,102.941-58.74,102.941-119.452C363.908,54.315,309.598,0,242.606,0 c-66.961,0-121.302,54.315-121.302,121.304C121.304,182.016,166.08,231.855,224.274,240.756z"/> <path d="M333.586,272.93h-15.163c0,41.878-33.943,75.817-75.816,75.817c-41.875,0-75.812-33.939-75.812-75.817h-15.166 c-50.227,0-90.978,40.726-90.978,90.976v90.98c0,16.764,13.565,30.326,30.327,30.326h303.258 c16.759,0,30.326-13.562,30.326-30.326v-90.98C424.562,313.656,383.869,272.93,333.586,272.93z"/>',
				'dim' => 485.213
			),
			'c12' => array(
				'path' => '<path d="M174.881,0C78.441,0,0,78.441,0,174.875c0,96.434,78.441,174.874,174.887,174.874c96.422,0,174.863-78.44,174.863-174.874 C349.75,78.441,271.309,0,174.881,0z M127.08,141.626l0.352-0.384c1.426-1.036,2.12-2.657,1.861-4.354 c-3.522-21.191-1.21-30.027-0.43-32.246c6.155-18.891,25.476-27.628,29.268-29.177c0.808-0.318,2.3-0.769,3.813-1.003l0.451-0.105 l3.104-0.165l0.024,0.192l0.72-0.069c0.64-0.069,1.252-0.153,2.021-0.315l0.685-0.146c0.606,0.009,8.127,0.96,19.302,4.386 l7.765,2.672c14.201,4.194,20.734,11.997,21.947,13.57c11.373,12.884,8.322,32.339,5.506,42.784 c-0.318,1.231-0.126,2.498,0.57,3.549l0.643,0.793c0.823,1.12,1.562,5.438-0.906,14.609c-0.469,2.786-1.501,5.05-3.026,6.575 c-0.564,0.619-0.961,1.408-1.104,2.3c-3.844,22.533-24.031,47.741-45.315,47.741c-18.06,0-38.671-23.19-42.379-47.723 c-0.141-0.916-0.522-1.724-1.156-2.417c-1.543-1.601-2.528-3.906-3.122-7.317C125.861,148.958,125.684,143.785,127.08,141.626z M86.539,239.346c0.783-0.991,5.149-6.107,13.979-9.476c7.764-2.385,26.956-8.762,37.446-16.363 c0.492-0.265,0.976-0.781,1.378-1.189c0.97-1.045,2.453-2.642,4.209-4.27l0.979-0.93l0.997,0.937 c9.242,8.713,19.467,13.486,28.796,13.486c9.8,0,19.903-4.239,29.241-12.273l0.732-0.625l1.981,0.961 c1.771,1.621,4.834,3.849,6.257,4.527l1.825,0.89l-0.191,0.197l0.811,0.492c1.723,1.039,3.597,2.048,5.795,3.135 c2.222,0.979,4.083,1.699,6.004,2.336c1.622,0.528,10.257,3.423,20.08,7.963l1.874,0.564c9.607,3.681,13.871,8.791,14.291,9.325 c11.403,16.897,15.774,48.429,17.402,65.999c-29.784,24.181-67.242,37.493-105.531,37.493c-38.308,0-75.771-13.312-105.541-37.506 C70.947,287.498,75.282,256.068,86.539,239.346z"/>',
				'dim' => 349.75
			),
			'c13' => array(
				'path' => '<path d="M257.938,336.072c0,17.355-14.068,31.424-31.423,31.424c-17.354,0-31.422-14.068-31.422-31.424 c0-17.354,14.068-31.423,31.422-31.423C243.87,304.65,257.938,318.719,257.938,336.072z M385.485,304.65 c-17.354,0-31.423,14.068-31.423,31.424c0,17.354,14.069,31.422,31.423,31.422c17.354,0,31.424-14.068,31.424-31.422 C416.908,318.719,402.84,304.65,385.485,304.65z M612,318.557v59.719c0,29.982-24.305,54.287-54.288,54.287h-39.394 C479.283,540.947,379.604,606.412,306,606.412s-173.283-65.465-212.318-173.85H54.288C24.305,432.562,0,408.258,0,378.275v-59.719 c0-20.631,11.511-38.573,28.46-47.758c0.569-84.785,25.28-151.002,73.553-196.779C149.895,28.613,218.526,5.588,306,5.588 c87.474,0,156.105,23.025,203.987,68.43c48.272,45.777,72.982,111.995,73.553,196.779C600.489,279.983,612,297.925,612,318.557z M497.099,336.271c0-13.969-0.715-27.094-1.771-39.812c-24.093-22.043-67.832-38.769-123.033-44.984 c7.248,8.15,13.509,18.871,17.306,32.983c-33.812-26.637-100.181-20.297-150.382-79.905c-2.878-3.329-5.367-6.51-7.519-9.417 c-0.025-0.035-0.053-0.062-0.078-0.096l0.006,0.002c-8.931-12.078-11.976-19.262-12.146-11.31 c-1.473,68.513-50.034,121.925-103.958,129.46c-0.341,7.535-0.62,15.143-0.62,23.08c0,28.959,4.729,55.352,12.769,79.137 c30.29,36.537,80.312,46.854,124.586,49.59c8.219-13.076,26.66-22.205,48.136-22.205c29.117,0,52.72,16.754,52.72,37.424 c0,20.668-23.604,37.422-52.72,37.422c-22.397,0-41.483-9.93-49.122-23.912c-30.943-1.799-64.959-7.074-95.276-21.391 C198.631,535.18,264.725,568.41,306,568.41C370.859,568.41,497.099,486.475,497.099,336.271z M550.855,264.269 C547.4,116.318,462.951,38.162,306,38.162S64.601,116.318,61.145,264.269h20.887c7.637-49.867,23.778-90.878,48.285-122.412 C169.37,91.609,228.478,66.13,306,66.13c77.522,0,136.63,25.479,175.685,75.727c24.505,31.533,40.647,72.545,48.284,122.412 H550.855L550.855,264.269z"/>',
				'dim' => 612
			),
			'c14' => array(
				'path' => '<path d="M259.107,322.451c0,16.933-13.727,30.659-30.66,30.659c-16.933,0-30.658-13.727-30.658-30.659s13.726-30.659,30.658-30.659 C245.38,291.792,259.107,305.519,259.107,322.451z M383.554,291.792c-16.932,0-30.66,13.726-30.66,30.659 s13.729,30.659,30.66,30.659c16.934,0,30.658-13.727,30.658-30.659S400.487,291.792,383.554,291.792z M514.517,416.596v-3.492 c-3.514,10.198-7.734,19.885-12.273,29.303c0.842,5.773,2.4,13.831,5.02,23.043c12.6,19.488,48.158,44.316,72.537,50.712 c-13.145,5.583-28.979,7.882-44.379,5.525c14.107,17.751,33.988,33.869,62.039,43.459 c-65.568,59.097-173.604,60.411-249.119,14.516c-14.635,4.304-28.936,6.56-42.341,6.56c-13.405,0-27.707-2.256-42.34-6.56 c-75.517,45.896-183.551,44.581-249.119-14.516c28.613-9.781,48.68-26.366,62.835-44.538c-12.52,0.479-24.944-1.8-35.589-6.321 c17.862-4.686,41.716-19.281,58.174-34.413c5.759-15.225,8.539-28.836,9.796-37.468c-4.539-9.418-8.759-19.104-12.272-29.303v3.493 H60.407c-29.254,0-52.969-23.716-52.969-52.969v-58.266c0-20.131,11.231-37.637,27.769-46.599 c0.555-82.724,24.666-147.331,71.765-191.997C153.69,22.465,220.653,0,306,0c85.348,0,152.311,22.465,199.028,66.767 c47.1,44.665,71.209,109.271,71.766,191.997c16.537,8.962,27.768,26.467,27.768,46.598v58.265 c0,29.254-23.715,52.969-52.969,52.969H514.517z M492.454,322.646c0-13.63-0.697-26.436-1.729-38.845 c-23.898-21.863-67.617-38.353-122.746-44.168c8.746,7.841,16.256,18.297,20.273,33.226 c-32.055-23.431-99.236-30.687-121.551-55.793l0.022-0.002c-35.52-23.512-44.841-57.189-45.141-43.25 c-1.438,66.848-48.818,118.961-101.431,126.313c-0.333,7.352-0.606,14.773-0.606,22.519c0,28.256,4.614,54.006,12.458,77.214 c29.553,35.648,78.359,45.714,121.558,48.385c8.019-12.76,26.012-21.666,46.966-21.666c28.409,0,51.438,16.347,51.438,36.513 c0,20.167-23.029,36.514-51.438,36.514c-21.853,0-40.475-9.688-47.929-23.332c-30.191-1.755-63.38-6.9-92.96-20.869 c41.601,61.315,106.087,93.739,146.359,93.739C369.284,549.143,492.454,469.197,492.454,322.646z M524.524,252.394h20.381 C541.534,108.039,459.136,31.782,306,31.782c-153.136,0-235.532,76.257-238.903,220.612h20.379 c7.451-48.654,23.2-88.67,47.111-119.436C172.691,83.931,230.363,59.07,306,59.07c75.637,0,133.309,24.859,171.415,73.887 C501.325,163.724,517.073,203.739,524.524,252.394z"/>',
				'dim' => 612
			),
			'c15' => array(
				'path' => '<path d="M227.535,294.249v16.117h28.822v-16.117c-4.753,0.908-9.557,1.415-14.404,1.415 C237.107,295.665,232.289,295.157,227.535,294.249z"/> <path d="M377.016,271.181l-59.18-17.648c-3.816,4.777-7.819,9.141-11.932,13.153l15.404,4.598 c-10.291,40.96-38.191,152.836-46.042,192.794c-6.304,1.526-12.716,2.745-19.3,3.393l16.657-39.332L256.609,321.04h-29.027 l-16.015,107.099l16.655,39.332c-6.71-0.656-13.215-1.915-19.611-3.478c-7.866-39.991-35.705-151.625-46.012-192.624l15.482-4.62 c-4.129-4.012-8.115-8.368-11.948-13.153l-58.96,17.586c-13.23,3.941-22.286,16.093-22.286,29.887v25.915 c0,86.822,70.377,157.207,157.208,157.207c86.83,0,157.207-70.385,157.207-157.207v-25.915 C399.303,287.275,390.248,275.123,377.016,271.181z"/> <path d="M343.555,125.97c2.908-18.317,1.611-37.976-0.93-53.339C337.198,39.797,324.17,16.69,324.17,16.69l-6.084,25.516 l-0.594,2.51c-0.047-1.025-0.203-2.159-0.313-3.261c-1.454-13.919-7.695-32.772-7.695-32.772 c-14.012,6.67-37.002,6.005-37.002,6.005c6.365-4.676,22.99-9.337,22.99-9.337C254.06-7.7,227.582,5.953,214.695,16.228 c-2.785,2.229-4.942,4.27-6.475,5.872l4.723-5.45l9.807-11.3c-19.77,1.939-34.174,15.295-42.932,26.204 c-6.318,7.867-9.789,14.498-9.789,14.498l1.689-8.688l3.643-18.673c-13.59,10.869-21.785,26.673-26.806,42.789 c-7.566,24.331-8.354,53.946-8.094,64.443c-7.877,3.256-13.807,10.607-16.397,20.385c-2.455,9.33-1.814,20.207,1.814,30.615 c5.724,16.436,17.906,28.518,31.17,31.224c16.468,35.329,46.762,71.502,84.904,71.502c38.114,0,68.408-36.118,84.876-71.424 c13.058-2.557,25.445-14.71,31.231-31.302C365.816,154.57,359.438,132.572,343.555,125.97z M342.938,171.661 c-4.77,13.669-14.466,21.042-21.347,21.042c-3.833,0.469-6.21,1.847-7.491,4.809c-13.936,31.967-40.209,66.124-72.146,66.124 c-31.934,0-58.209-34.156-72.145-66.124c-1.267-2.924-4.486-4.809-7.678-4.809c-6.693,0-16.374-7.373-21.129-21.042 c-2.55-7.335-3.082-15.084-1.454-21.262c0.798-2.979,2.8-8.218,7.46-9.837c0.501-0.172,1.486-0.273,1.969-0.32 c3.957-0.383,7.039-3.613,7.227-7.585c0.173-3.699,0.615-7.269,1.502-10.768c11.936-47.109,52.986-50.476,52.986-50.476 c-7.383,17.352-19.314,24.687-19.314,24.687c39.363-16.015,51.625-33.367,51.625-33.367c26.197,36.369,62.292,52.149,83.139,58.616 c0.609,3.738,1.377,7.421,1.564,11.308c0.188,3.972,3.269,7.202,7.227,7.585c0.482,0.047,1.469,0.148,1.984,0.32 C344.002,143.032,348.225,156.42,342.938,171.661z"/>',
				'dim' => 484.191
			),
			'c16' => array(
				'path' => '<path d="M373.75,287.335l-13.325-3.973c0,0,0-0.016-0.015-0.022c-4.99-15.89-6.35-35.401-6.382-51.682 c-0.016-13.262,0.844-24.264,1.345-29.534c0.72-1.229,3.708-7.092,5.037-10.768c2.093-5.788,3.128-11.596,3.378-17.116 c0.469-10.557-2.252-20.043-7.475-26.87c1.5-8.092,2.583-22.05,2.767-28.509c0-0.002,0-0.006,0-0.008 C359.079,53.205,305.844,0,240.19,0c-65.622,0-118.86,53.205-118.86,118.853v0.008c0,7.929,1.221,20.111,2.77,28.525 c0,0,0,0,0,0.008c-1.924,2.51-3.442,5.419-4.63,8.585c-3.753,9.931-3.926,22.544,0.547,35.376c1.346,3.833,3.065,7.397,5.021,10.714 c0.484,5.247,1.359,16.287,1.345,29.589c-0.032,16.289-1.392,35.814-6.396,51.704l-13.325,3.973 c-16.672,4.973-26.648,22.028-22.786,38.996l8.116,35.737c15.76,69.286,77.687,118.124,147.84,118.32 c0.047,0,0.093,0.006,0.155,0.006c0.064,0,0.142,0.017,0.22,0.017c0.016,0,0.03,0,0.047,0c0.11,0,0.219-0.023,0.328-0.023 c76-0.212,115.029-53.95,116.264-54.567c14.906-18.469,25.789-38.311,31.576-63.753l8.116-35.737 C400.4,309.363,390.422,292.308,373.75,287.335z M138.502,361.865c-4.27,12.847-9.822,24.358-16.015,34.39 c-0.017,0.024-0.03,0.056-0.047,0.086c-6.615-11.566-11.729-24.21-14.826-37.824l-8.132-35.743 c-1.972-8.712,3.189-17.533,11.761-20.089l33.436-9.971c0.017,0.008,0.017,0.024,0.017,0.024 C148.761,311.225,147.041,336.075,138.502,361.865z M240.205,334.222c-30.903,0-56.583-22.129-62.214-51.399c0-0.014,0-0.03,0-0.03 l14.718-4.395c0.014,0.008,0.03,0.015,0.03,0.03c9.993,8.352,21.003,14.827,33.063,17.658c4.66,1.094,9.461,1.68,14.388,1.68 c17.688,0,33.641-7.764,47.512-19.368l0.017,0.008l14.702,4.379C296.805,312.068,271.125,334.222,240.205,334.222z M315.383,212.931 c-14.512,33.272-41.897,68.82-75.193,68.82c-33.265,0-60.634-35.548-75.148-68.82c-1.267-2.918-4.473-4.801-7.662-4.801 c-7.053,0-17.25-7.727-22.255-22.061c-5.568-15.975-1.132-30.217,6.443-32.662c1.089-0.352,4.482-0.62,7.179-2.87 c17.887-14.92,46.605-78.315,46.605-78.315c47.559,64.553,100.855,75.034,141.094,80.712c0.638,0.09,1.959,0.316,2.412,0.474 c7.523,2.627,12.012,16.688,6.429,32.67c-4.973,14.325-15.171,22.053-22.427,22.053 C319.685,208.293,316.666,209.975,315.383,212.931z M380.912,322.782l-8.116,35.735c-3.097,13.614-8.211,26.258-14.826,37.824 c-6.209-10.047-11.792-21.589-16.061-34.477c-8.555-25.813-10.259-50.672-6.178-69.15l33.436,9.971 C377.739,305.241,382.899,314.063,380.912,322.782z"/>',
				'dim' => 480.411
			),
			'c17' => array(
				'path' => '<path d="M335.654,239.048l-55.617-16.857c-1.344-4.064-4.323-7.579-8.491-10.555c4.585-5.094,8.455-10.251,11.397-14.517 c6.979-10.122,12.79-21.023,16.813-31.541c1.98-4.436,3.67-8.889,5.038-13.259c5.415-4.538,8.603-11.318,8.603-18.429v-17.418 c0-5-1.572-9.888-4.464-13.941V78.01c0-43.019-34.996-78.01-78.01-78.01h-25.288c-43.014,0-78.01,34.991-78.01,78.01v24.523 c-2.892,4.053-4.463,8.944-4.463,13.939v17.418c0,7.105,3.188,13.88,8.603,18.426c1.366,4.365,3.057,8.822,5.038,13.269 c4.025,10.514,9.834,21.413,16.812,31.528c2.943,4.268,6.813,9.426,11.399,14.522c-4.168,2.976-7.148,6.492-8.492,10.555 l-55.617,16.857c-39.159,11.254-62.625,180.444-62.625,180.444h0.003c-0.118,0.752-0.197,1.517-0.197,2.302 c0,8.154,6.609,14.764,14.764,14.764h330.86c8.155,0,14.764-6.609,14.764-14.764C398.473,414.715,374.813,250.302,335.654,239.048z M204.79,252.411c0.948,1.051,1.406,2.454,1.261,3.862l-2.74,26.575c-0.211,2.045-1.652,3.752-3.632,4.304 c-0.444,0.124-0.895,0.184-1.341,0.184c-1.544,0-3.032-0.717-3.993-1.99l-14.05-18.636c-0.654-0.868-1.008-1.926-1.007-3.013 l0.018-29.881c0.001-1.752,0.919-3.376,2.421-4.281c1.502-0.904,3.367-0.956,4.916-0.137c4.09,2.162,8.174,3.615,12.139,4.319 c2.387,0.423,4.126,2.499,4.126,4.923v12.467C203.619,251.386,204.266,251.83,204.79,252.411z M230.506,256.272 c-0.145-1.408,0.313-2.811,1.261-3.862c0.524-0.581,1.171-1.024,1.883-1.304V238.64c0-2.424,1.739-4.499,4.126-4.923 c3.963-0.704,8.046-2.156,12.135-4.317c1.55-0.818,3.415-0.766,4.917,0.138c1.502,0.905,2.419,2.529,2.419,4.282l0.003,29.88 c0,1.086-0.353,2.142-1.007,3.009l-14.031,18.623c-0.96,1.274-2.449,1.992-3.993,1.992c-0.446,0-0.897-0.06-1.341-0.184 c-1.98-0.551-3.422-2.259-3.633-4.304L230.506,256.272z M157.286,140.165l-0.271-2.071l-4.852-3.153 c-1.419-0.922-2.275-2.5-2.275-4.192v-8.232c0-2.761,2.239-5,5-5h2.043v-8.916c0-1.895,1.071-3.627,2.767-4.474 c6.884-3.437,20.544-9.202,34.688-9.202c11.285,0,20.642,3.754,27.812,11.157c8.933,9.233,19.229,13.914,30.604,13.914 c6.439,0,13.094-1.52,19.782-4.516c1.546-0.693,3.339-0.555,4.763,0.366c0.665,0.431,1.208,1.007,1.597,1.67h2.728 c2.761,0,5,2.239,5,5v8.232c0,1.692-0.856,3.27-2.275,4.192l-4.852,3.154l-0.27,2.059c-1.58,11.956-8.287,27.444-17.942,41.438 c-12.226,17.733-23.687,25.671-29.62,25.671h-26.862c-5.934,0-17.395-7.939-29.622-25.675 C165.572,167.599,158.865,152.113,157.286,140.165z"/>',
				'dim' => 436.558
			),
			'c18' => array(
				'path' => '<path d="M398.781,400.842c-0.585-3.45-1.193-6.896-1.823-10.347c-7.226-39.39-19.038-102.017-64.124-135.877 c3.326-22.054,5.029-56.337,5.029-107.331C337.863,65.882,285.074,0,220,0c-44.375,0-72.592,31.445-72.592,31.445 c-27.487,27.001-45.271,68.793-45.271,116.003c0,50.848,1.779,85.142,5.019,107.114c-45.29,33.524-56.883,96.658-64.115,136.072 c-0.628,3.442-1.236,6.89-1.821,10.334c-3.093,18.202,9.156,35.461,27.355,38.554c1.896,0.322,3.777,0.478,5.638,0.478 l116.984-0.03l0.003-0.023l174.585-0.078c1.859,0,3.743-0.153,5.636-0.479C389.622,436.3,401.872,419.044,398.781,400.842z M220.034,324.404l-62.152-31.666l32.238-50.824c8.74,4.458,20.255,6.986,29.88,6.986c9.664,0,20.979-2.578,29.75-7.073 l32.157,50.924L220.034,324.404z M220,226.9c-59.158,0-84.628-80.045-79.546-105.039c65.035-56.563,122.614-52.656,122.614-52.656 s10.323,32.059,36.873,70.74C295.275,178.071,256.647,226.9,220,226.9z"/>',
				'dim' => 440
			),
			'c19' => array(
				'path' => '<path d="M48.355,17.922c3.705,2.323,6.303,6.254,6.776,10.817c1.511,0.706,3.188,1.112,4.966,1.112 c6.491,0,11.752-5.261,11.752-11.751c0-6.491-5.261-11.752-11.752-11.752C53.668,6.35,48.453,11.517,48.355,17.922z M40.656,41.984 c6.491,0,11.752-5.262,11.752-11.752s-5.262-11.751-11.752-11.751c-6.49,0-11.754,5.262-11.754,11.752S34.166,41.984,40.656,41.984 z M45.641,42.785h-9.972c-8.297,0-15.047,6.751-15.047,15.048v12.195l0.031,0.191l0.84,0.263 c7.918,2.474,14.797,3.299,20.459,3.299c11.059,0,17.469-3.153,17.864-3.354l0.785-0.397h0.084V57.833 C60.688,49.536,53.938,42.785,45.641,42.785z M65.084,30.653h-9.895c-0.107,3.959-1.797,7.524-4.47,10.088 c7.375,2.193,12.771,9.032,12.771,17.11v3.758c9.77-0.358,15.4-3.127,15.771-3.313l0.785-0.398h0.084V45.699 C80.13,37.403,73.38,30.653,65.084,30.653z M20.035,29.853c2.299,0,4.438-0.671,6.25-1.814c0.576-3.757,2.59-7.04,5.467-9.276 c0.012-0.22,0.033-0.438,0.033-0.66c0-6.491-5.262-11.752-11.75-11.752c-6.492,0-11.752,5.261-11.752,11.752 C8.283,24.591,13.543,29.853,20.035,29.853z M30.589,40.741c-2.66-2.551-4.344-6.097-4.467-10.032 c-0.367-0.027-0.73-0.056-1.104-0.056h-9.971C6.75,30.653,0,37.403,0,45.699v12.197l0.031,0.188l0.84,0.265 c6.352,1.983,12.021,2.897,16.945,3.185v-3.683C17.818,49.773,23.212,42.936,30.589,40.741z"/>',
				'dim' => 80.13
			),
			'c20' => array(
				'path' => '<path style="fill-rule:evenodd;clip-rule:evenodd;" d="M143.193,143.313c25.104,0,44.629-26.037,44.629-52.99v-8.444 c0-26.952-19.525-46.076-44.629-46.076c-25.105,0-44.63,19.123-44.63,46.076v8.444C98.563,117.276,118.088,143.313,143.193,143.313 z M53.779,152.03c7.178,0,26.821-9.313,26.821-28.637v-14.319c0-19.325-14.17-28.638-26.821-28.638 c-12.231,0-26.82,9.313-26.82,28.638v14.319C26.959,142.717,46.983,152.03,53.779,152.03z M214.479,187.834 c-0.014-0.14-0.056-0.273-0.07-0.412c-0.21-1.686-0.532-3.335-0.979-4.95c0-0.015,0-0.028-0.014-0.042 c-0.937-3.433-2.518-6.74-4.88-9.998v-0.014c-3.874-5.362-9.718-10.831-19.213-16.164c-5.02-2.819-7.23-4.111-10.333-4.111 c-4.936,0-9.243,3.838-16.499,10.501h-0.015l-6.6,6.068c-0.238,0.225-7.354,10.278-12.682,10.278s-12.445-10.054-12.683-10.278 l-6.6-6.068h-0.014c-7.256-6.663-11.563-10.501-16.499-10.501c-3.104,0-5.874,1.292-10.333,4.111 c-9.206,5.811-15.341,10.795-19.199,16.149l-0.015,0.007c-0.014,0.014-0.014,0.036-0.027,0.048 c-2.336,3.231-3.902,6.517-4.838,9.929c-0.013,0.028-0.029,0.063-0.04,0.097c-0.435,1.603-0.757,3.23-0.966,4.901 c-0.014,0.155-0.056,0.301-0.071,0.455c-0.196,1.776-0.307,3.587-0.307,5.467c0,0.209-0.004,39.195,0,39.377 c0,12.724,4.796,17.898,17.898,17.898h107.39c13.215,0,17.898-4.895,17.898-17.898c0.004-0.182-0.001-39.168-0.001-39.377 C214.786,191.428,214.674,189.617,214.479,187.834z M232.764,152.03c7.177,0,26.822-9.313,26.822-28.637v-14.319 c0-19.325-14.17-28.638-26.822-28.638c-12.232,0-26.821,9.313-26.821,28.638v14.319C205.943,142.717,225.967,152.03,232.764,152.03 z M20.366,171.411c-16.655,9.481-20.36,24.597-20.36,34.427c0,0.153-0.014,17.759,0,17.898c0,12.99,4.363,17.899,17.898,17.899 h35.797c0,0,0-38.034,0-53.696l-8.949-8.949C35.284,170.642,27.302,167.468,20.366,171.411z M53.701,187.939 C53.898,188.109,53.701,183.689,53.701,187.939L53.701,187.939z M286.381,205.838c0-9.831-3.706-24.947-20.36-34.427 c-6.936-3.943-14.918-0.769-24.386,7.58l-8.949,8.949c0,15.661,0,53.696,0,53.696h35.797c13.535,0,17.898-4.909,17.898-17.899 C286.395,223.597,286.381,205.992,286.381,205.838z M232.685,187.939C232.685,183.689,232.489,188.109,232.685,187.939 L232.685,187.939z"/>',
				'dim' => 286.387
			),
			'd01' => array(
				'path' => '<path d="M201.977,297.183c-2.786,0-9.259-1.261-9.259-13v-53.882H14.388c-0.493,0.078-1.156,0.15-1.937,0.15 c-3.173,0-6.101-1.201-8.245-3.404C1.415,224.195,0,219.835,0,214.094v-82.82c0-11.458,8.122-14.48,12.421-14.48h176.538V67.41 c0-13.805,6.569-15.865,10.496-15.865c6.281,0,12.538,5.972,13.727,7.176c4.294,3.167,117.851,88.778,130.328,101.244 c4.528,4.537,5.333,9.101,5.206,12.124c-0.3,7.274-5.908,12.223-6.539,12.775l-126.305,104.52 C214.486,290.884,208.073,297.183,201.977,297.183z"/>',
				'dim' => 348.728
			),
			'd02' => array(
				'path' => '<path style="fill:#030104;" d="M0.278,9.439l7.326-6.061c0,0,0.868-0.919,0.868,0.078c0,0.999,0,3.416,0,3.416s0.589,0,1.489,0 c2.579,0,7.265,0,9.173,0c0,0,0.519-0.137,0.519,0.65c0,0.789,0,4.244,0,4.807s-0.434,0.55-0.434,0.55c-1.855,0-6.703,0-9.195,0 c-0.807,0-1.333,0-1.333,0s0,1.936,0,3.154c0,1.214-0.912,0.298-0.912,0.298s-6.843-5.155-7.562-5.874 C-0.305,9.936,0.278,9.439,0.278,9.439z"/>',
				'dim' => 19.653
			),
			'd03' => array(
				'path' => '<path style="fill:#010002;" d="M238.369,0C106.726,0,0,106.726,0,238.369c0,131.675,106.726,238.369,238.369,238.369 c131.675,0,238.369-106.694,238.369-238.369C476.737,106.726,370.043,0,238.369,0z M381.39,238.432l-1.208,6.007l-3.432,5.149 l-95.347,95.347c-6.134,6.134-16.273,6.134-22.47,0c-6.134-6.198-6.134-16.336,0-22.47l68.205-68.205H79.456 c-8.772,0-15.891-7.151-15.891-15.891c0-8.772,7.119-15.891,15.891-15.891h247.681l-68.205-68.205 c-6.198-6.198-6.198-16.273,0-22.47c6.134-6.198,16.273-6.198,22.47,0l95.347,95.347l3.369,5.149l1.271,6.07V238.432z"/>',
				'dim' => 476.737
			),
			'd04' => array(
				'path' => '<path style="fill:#010002;" d="M238.369,0C106.726,0,0,106.726,0,238.369c0,131.675,106.726,238.369,238.369,238.369 c131.675,0,238.369-106.694,238.369-238.369C476.737,106.726,370.043,0,238.369,0z M397.281,254.26H149.6l68.205,68.205 c6.198,6.166,6.198,16.273,0,22.47c-6.198,6.166-16.273,6.166-22.47,0l-95.347-95.347l-0.095-0.159l-3.305-4.99l-1.24-6.007 v-0.064l1.24-6.07l3.305-4.99l0.127-0.191l95.347-95.347c6.198-6.198,16.273-6.198,22.47,0c6.198,6.198,6.198,16.273,0,22.47 L149.6,222.477h247.681c8.74,0,15.891,7.119,15.891,15.891C413.172,247.109,406.021,254.26,397.281,254.26z"/>',
				'dim' => 476.737
			),
			'd05' => array(
				'path' => '<path style="fill:#010002;" d="M227.996,0C102.081,0,0,102.081,0,227.996c0,125.945,102.081,227.996,227.996,227.996 c125.945,0,227.996-102.051,227.996-227.996C455.992,102.081,353.941,0,227.996,0z M299.435,238.788l-98.585,98.585 c-5.928,5.897-15.565,5.897-21.492,0c-5.928-5.928-5.928-15.595,0-21.492l87.885-87.885l-87.885-87.885 c-5.928-5.928-5.928-15.565,0-21.492s15.565-5.928,21.492,0l98.585,98.585c3.04,2.979,4.469,6.901,4.438,10.792 C303.873,231.918,302.414,235.809,299.435,238.788z"/>',
				'dim' => 455.992
			),
			'd06' => array(
				'path' => '<path style="fill:#010002;" d="M238.369,0C106.726,0,0,106.726,0,238.369c0,131.675,106.726,238.369,238.369,238.369 c131.675,0,238.369-106.694,238.369-238.369C476.737,106.726,370.043,0,238.369,0z M289.221,330.252 c6.198,6.198,6.198,16.273,0,22.47s-16.273,6.198-22.47,0L163.68,249.651c-3.115-3.115-4.64-7.183-4.64-11.283 s1.526-8.168,4.64-11.283L266.75,124.015c6.198-6.198,16.273-6.198,22.47,0c6.198,6.198,6.198,16.273,0,22.47l-91.883,91.883 L289.221,330.252z"/>',
				'dim' => 476.737
			),
			'd07' => array(
				'path' => '<path style="fill:#010002;" d="M238.369,0C106.726,0,0,106.726,0,238.369c0,131.675,106.726,238.369,238.369,238.369 c131.675,0,238.369-106.694,238.369-238.369C476.737,106.726,370.043,0,238.369,0z M344.427,247.903l-123.221,97.318 c-6.897,5.435-18.084,5.435-24.981,0l0.064-0.064c-3.401-2.479-5.594-6.007-5.594-9.98V140.987c0-3.909,2.066-7.405,5.371-9.916 l0.159-0.159c6.897-5.403,18.084-5.403,24.981,0l122.553,97.095l0.667,0.35C351.355,233.728,351.355,242.5,344.427,247.903z"/>',
				'dim' => 476.737
			),
			'd08' => array(
				'path' => '<path style="fill:#010002;" d="M7.5,0C3.358,0,0,3.358,0,7.5C0,11.643,3.358,15,7.5,15c4.143,0,7.5-3.357,7.5-7.5 C15,3.358,11.643,0,7.5,0z M9,10.545c0,0.123-0.064,0.232-0.169,0.313l-0.004,0.004c-0.218,0.171-0.569,0.171-0.786,0L4.183,7.81 l-0.02-0.012c-0.217-0.17-0.217-0.447,0-0.617L8.04,4.119c0.217-0.17,0.569-0.17,0.786,0L8.824,4.121C8.931,4.2,9,4.311,9,4.436 V10.545z"/>',
				'dim' => 15
			),
			'd09' => array(
				'path' => '<path d="M22.118,44.236C9.922,44.236,0,34.314,0,22.118S9.922,0,22.118,0s22.118,9.922,22.118,22.118S34.314,44.236,22.118,44.236 z M22.118,1.5C10.75,1.5,1.5,10.749,1.5,22.118c0,11.368,9.25,20.618,20.618,20.618c11.37,0,20.618-9.25,20.618-20.618 C42.736,10.749,33.488,1.5,22.118,1.5z"/> <path d="M19.341,29.884c-0.192,0-0.384-0.073-0.53-0.22c-0.293-0.292-0.293-0.768,0-1.061l6.796-6.804l-6.796-6.803 c-0.292-0.293-0.292-0.769,0-1.061c0.293-0.293,0.768-0.293,1.061,0l7.325,7.333c0.293,0.293,0.293,0.768,0,1.061l-7.325,7.333 C19.725,29.811,19.533,29.884,19.341,29.884z"/>',
				'dim' => 44.236
			),
			'd10' => array(
				'path' => '<path d="M22.119,44.237C9.922,44.237,0,34.315,0,22.119S9.922,0.001,22.119,0.001s22.119,9.922,22.119,22.118 S34.314,44.237,22.119,44.237z M22.119,1.501C10.75,1.501,1.5,10.75,1.5,22.119c0,11.368,9.25,20.618,20.619,20.618 s20.619-9.25,20.619-20.618C42.738,10.75,33.488,1.501,22.119,1.501z"/> <path d="M24.667,29.884c-0.192,0-0.384-0.072-0.53-0.22l-7.328-7.334c-0.292-0.293-0.292-0.768,0-1.061l7.328-7.333 c0.293-0.293,0.768-0.293,1.061,0s0.293,0.768,0,1.061L18.4,21.8l6.798,6.805c0.292,0.293,0.292,0.769,0,1.061 C25.051,29.812,24.859,29.884,24.667,29.884z"/>',
				'dim' => 44.238
			),
			'd11' => array(
				'path' => '<path style="fill:#090509;" d="M200.732,116.268l-0.667-0.381L79.101,4.648c-6.801-6.198-17.862-6.198-24.663,0l-0.095,0.222 c-3.242,2.86-5.308,6.865-5.308,11.346v222.477c0,4.545,2.161,8.581,5.498,11.442l-0.064,0.064 c6.833,6.198,17.862,6.198,24.663,0l121.632-111.493C207.502,132.573,207.502,122.498,200.732,116.268z"/>',
				'dim' => 254.848
			),
			'd12' => array(
				'path' => '<path style="fill:#010002;" d="M200.994,4.716l0.064-0.064c-6.929-6.198-18.084-6.198-24.981-0.032L52.856,115.859 c-6.929,6.198-6.929,16.241,0,22.407l0.636,0.381L176.077,249.6c6.897,6.198,18.052,6.198,24.981,0l0.127-0.191 c3.305-2.86,5.403-6.865,5.403-11.283V16.157C206.588,11.613,204.427,7.576,200.994,4.716z"/>',
				'dim' => 254.248
			),
			'd13' => array(
				'path' => '<polygon points="94.35,0 58.65,35.7 175.95,153 58.65,270.3 94.35,306 247.35,153"/>',
				'dim' => 306
			),
			'd14' => array(
				'path' => '<polygon points="247.35,270.3 130.05,153 247.35,35.7 211.65,0 58.65,153 211.65,306"/>',
				'dim' => 306
			),
			'd13' => array(
				'path' => '<path d="M459,216.75L280.5,38.25v102c-178.5,25.5-255,153-280.5,280.5C63.75,331.5,153,290.7,280.5,290.7v104.55L459,216.75z"/>',
				'dim' => 459
			),
			'd14' => array(
				'path' => '<path d="M178.5,140.25v-102L0,216.75l178.5,178.5V290.7c127.5,0,216.75,40.8,280.5,130.05C433.5,293.25,357,165.75,178.5,140.25z"/>',
				'dim' => 459
			),
			'e01' => array(
				'path' => '<path d="M557.75,792c0,0,71.889,0,71.889-71.997V71.997C629.639,0,557.75,0,557.75,0h-323.5c0,0-71.889,0-71.889,71.997v648.006 C162.361,792,234.25,792,234.25,792H557.75z M396,762.022c-19.841,0-35.944-16.104-35.944-35.944 c0-19.842,16.103-35.944,35.944-35.944s35.945,16.103,35.945,35.944C431.945,745.919,415.842,762.022,396,762.022z M306.139,43.888 c0-4.457,3.559-7.944,7.944-7.944h163.8c4.385,0,7.979,3.559,7.979,7.944v2.121c0,4.493-3.559,7.944-7.943,7.944H314.083 c-4.349,0-7.944-3.559-7.944-7.944V43.888z M198.306,89.861h395.389v575.111H198.306V89.861z"/>',
				'dim' => 792
			),
			'e02' => array(
				'path' => '<path style="fill:#010002;" d="M25.989,12.274c8.663,0.085,14.09-0.454,14.823,9.148h10.564c0-14.875-12.973-16.88-25.662-16.88 c-12.69,0-25.662,2.005-25.662,16.88h10.482C11.345,11.637,17.398,12.19,25.989,12.274z"/> <path style="fill:#010002;" d="M5.291,26.204c2.573,0,4.714,0.154,5.19-2.377c0.064-0.344,0.101-0.734,0.101-1.185H10.46H0 C0,26.407,2.369,26.204,5.291,26.204z"/> <path style="fill:#010002;" d="M40.88,22.642h-0.099c0,0.454,0.039,0.845,0.112,1.185c0.502,2.334,2.64,2.189,5.204,2.189 c2.936,0,5.316,0.193,5.316-3.374H40.88z"/> <path style="fill:#010002;" d="M35.719,20.078v-1.496c0-0.669-0.771-0.711-1.723-0.711h-1.555c-0.951,0-1.722,0.042-1.722,0.711 v1.289v1h-11v-1v-1.289c0-0.669-0.771-0.711-1.722-0.711h-1.556c-0.951,0-1.722,0.042-1.722,0.711v1.496v1.306 C12.213,23.988,4.013,35.073,3.715,36.415l0.004,8.955c0,0.827,0.673,1.5,1.5,1.5h40c0.827,0,1.5-0.673,1.5-1.5v-9 c-0.295-1.303-8.493-12.383-11-14.987V20.078z M19.177,37.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458 s1.458,0.652,1.458,1.458S19.982,37.62,19.177,37.62z M19.177,32.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458 s1.458,0.652,1.458,1.458S19.982,32.62,19.177,32.62z M19.177,27.621c-0.805,0-1.458-0.652-1.458-1.458 c0-0.805,0.653-1.458,1.458-1.458s1.458,0.653,1.458,1.458C20.635,26.969,19.982,27.621,19.177,27.621z M25.177,37.62 c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458c0.806,0,1.458,0.652,1.458,1.458S25.983,37.62,25.177,37.62z M25.177,32.62c-0.805,0-1.458-0.652-1.458-1.458s0.653-1.458,1.458-1.458c0.806,0,1.458,0.652,1.458,1.458 S25.983,32.62,25.177,32.62z M25.177,27.621c-0.805,0-1.458-0.652-1.458-1.458c0-0.805,0.653-1.458,1.458-1.458 c0.806,0,1.458,0.653,1.458,1.458C26.635,26.969,25.983,27.621,25.177,27.621z M31.177,37.62c-0.806,0-1.458-0.652-1.458-1.458 s0.652-1.458,1.458-1.458s1.458,0.652,1.458,1.458S31.983,37.62,31.177,37.62z M31.177,32.62c-0.806,0-1.458-0.652-1.458-1.458 s0.652-1.458,1.458-1.458s1.458,0.652,1.458,1.458S31.983,32.62,31.177,32.62z M31.177,27.621c-0.806,0-1.458-0.652-1.458-1.458 c0-0.805,0.652-1.458,1.458-1.458s1.458,0.653,1.458,1.458C32.635,26.969,31.983,27.621,31.177,27.621z"/>',
				'dim' => 51.413
			),
			'e03' => array(
				'path' => '<path d="M15.825,40.675c-3.931,0.001-7.077-1.764-7.918-5.563c-0.964-4.353-1.43-8.932,0.731-13.221 c0.77-1.529,2.103-2.543,3.523-3.391c1.511-0.903,2.47-1.979,2.131-3.891c-0.117-0.664,0.148-1.391,0.055-2.063 c-0.046-0.334-0.508-0.611-0.782-0.914c-0.222,0.315-0.665,0.654-0.633,0.94c0.32,2.874-1.403,4.319-3.697,5.303 c-1.293,0.555-2.651,1.006-4.022,1.32c-1.299,0.298-2.582-0.025-3.645-0.858c-2.212-1.733-2.093-5.033,0.414-6.636 c1.701-1.088,3.626-1.871,5.528-2.588c4.9-1.849,10.055-2.504,15.236-2.616c3.143-0.068,6.305,0.407,9.448,0.748 c4.142,0.45,8.044,1.789,11.747,3.641c1.011,0.505,2.04,1.345,2.605,2.301c1.754,2.965-0.361,6.261-3.936,6.052 c-2.667-0.156-5.136-1.144-7.145-3.02c-0.919-0.858-1.383-1.911-1.222-3.199c0.032-0.257,0.078-0.586-0.046-0.773 c-0.174-0.263-0.482-0.531-0.772-0.585c-0.147-0.027-0.471,0.38-0.553,0.641c-0.094,0.297-0.018,0.652,0.003,0.98 c0.033,0.526,0.218,1.085,0.101,1.572c-0.438,1.797,0.549,2.706,1.913,3.535c1.948,1.183,3.575,2.687,4.411,4.909 c0.696,1.847,0.775,10.117,0.058,11.927c-1.278,3.224-3.895,5.582-7.994,5.455C30.045,40.639,18.365,40.674,15.825,40.675z M23.548,31.779c3.002-0.142,5.661-0.972,7.733-3.155c2.082-2.195,2.246-4.697,0.59-7.208c-0.97-1.469-2.366-2.338-3.952-2.993 c-4.039-1.67-8.918-0.841-11.784,2.03c-2.522,2.527-2.581,5.808-0.058,8.338C18.14,30.859,20.765,31.63,23.548,31.779z M23.648,10.794c0,0.002,0,0.004,0,0.006c-1.349,0-2.698,0.025-4.046-0.009c-0.848-0.021-1.215,0.355-1.195,1.176 c0.006,0.23-0.046,0.466-0.009,0.689c0.054,0.334,0.163,0.659,0.249,0.988c0.321-0.121,0.679-0.184,0.956-0.371 c2.05-1.382,5.967-1.365,8,0.034c0.273,0.189,0.633,0.255,0.952,0.378c0.086-0.36,0.195-0.717,0.247-1.082 c0.032-0.223-0.032-0.458-0.04-0.688c-0.026-0.823-0.443-1.155-1.266-1.131C26.215,10.821,24.933,10.794,23.648,10.794z"/> <path d="M24.112,27.844c-1.897-0.097-3.226-0.41-4.329-1.356c-1.805-1.55-1.791-3.724,0.022-5.274 c1.961-1.678,5.471-1.732,7.438-0.115c2.166,1.781,1.969,4.526-0.507,5.856C25.804,27.455,24.708,27.649,24.112,27.844z"/>',
				'dim' => 47.175
			),
			'e04' => array(
				'path' => '<path style="fill:#010002;" d="M577.83,456.128c1.225,9.385-1.635,17.545-8.568,24.48l-81.396,80.781 c-3.672,4.08-8.465,7.551-14.381,10.404c-5.916,2.857-11.729,4.693-17.439,5.508c-0.408,0-1.635,0.105-3.676,0.309 c-2.037,0.203-4.689,0.307-7.953,0.307c-7.754,0-20.301-1.326-37.641-3.979s-38.555-9.182-63.645-19.584 c-25.096-10.404-53.553-26.012-85.376-46.818c-31.823-20.805-65.688-49.367-101.592-85.68 c-28.56-28.152-52.224-55.08-70.992-80.783c-18.768-25.705-33.864-49.471-45.288-71.299 c-11.425-21.828-19.993-41.616-25.705-59.364S4.59,177.362,2.55,164.51s-2.856-22.95-2.448-30.294 c0.408-7.344,0.612-11.424,0.612-12.24c0.816-5.712,2.652-11.526,5.508-17.442s6.324-10.71,10.404-14.382L98.022,8.756 c5.712-5.712,12.24-8.568,19.584-8.568c5.304,0,9.996,1.53,14.076,4.59s7.548,6.834,10.404,11.322l65.484,124.236 c3.672,6.528,4.692,13.668,3.06,21.42c-1.632,7.752-5.1,14.28-10.404,19.584l-29.988,29.988c-0.816,0.816-1.53,2.142-2.142,3.978 s-0.918,3.366-0.918,4.59c1.632,8.568,5.304,18.36,11.016,29.376c4.896,9.792,12.444,21.726,22.644,35.802 s24.684,30.293,43.452,48.653c18.36,18.77,34.68,33.354,48.96,43.76c14.277,10.4,26.215,18.053,35.803,22.949 c9.588,4.896,16.932,7.854,22.031,8.871l7.648,1.531c0.816,0,2.145-0.307,3.979-0.918c1.836-0.613,3.162-1.326,3.979-2.143 l34.883-35.496c7.348-6.527,15.912-9.791,25.705-9.791c6.938,0,12.443,1.223,16.523,3.672h0.611l118.115,69.768 C571.098,441.238,576.197,447.968,577.83,456.128z"/>',
				'dim' => 578.106
			),
			'e05' => array(
				'path' => '<g> <path d="M233.695,248.694c-3.507-3.488-8.365-5.404-13.709-5.404c-5.627,0-11.049,2.192-14.88,6.023l-24.229,24.235l-6.548-3.633 c-14.403-7.986-34.141-18.939-54.977-39.806c-20.921-20.896-31.882-40.677-39.896-55.14l-3.579-6.365l24.271-24.268 c8.028-8.056,8.308-20.876,0.606-28.589L55.911,70.911c-3.485-3.486-8.35-5.41-13.685-5.41c-5.621,0-11.04,2.203-14.883,6.038 L16.331,82.614l-1.021,1.702c-4.102,5.258-7.458,11.166-9.965,17.606c-2.333,6.134-3.783,11.964-4.458,17.813 c-5.779,48.053,16.375,92.167,76.492,152.27c71.247,71.234,130.785,76.777,147.339,76.777c2.841,0,4.552-0.156,5.026-0.204 c6.119-0.745,11.968-2.216,17.87-4.498c6.371-2.48,12.268-5.812,17.517-9.914l2.498-1.976l10.31-10.112 c8.017-8.021,8.274-20.824,0.576-28.528L233.695,248.694z"/> </g> <g> <g> <path d="M186.228,165.766c-9.758-9.752-22.014-16.769-35.407-20.272l-6.161-1.63l-1.766,6.083 c-0.663,2.255-1.444,4.39-2.33,6.308l-3.339,7.113l7.65,1.976c10.121,2.558,19.344,7.77,26.667,15.108 c6.999,6.984,12.115,15.745,14.793,25.316l1.291,4.611l9.631,0.547c0.973,0.114,1.946,0.223,2.877,0.307l9.055,0.853 l-2.102-8.852C203.713,188.995,196.508,176.04,186.228,165.766z"/> </g> <g> <path d="M217.698,134.282c-18.116-18.119-41.268-29.942-66.92-34.182l-8.923-1.499l1.402,8.92 c0.412,2.645,0.775,5.278,1.078,7.938l0.57,4.693l4.723,0.934c20.446,3.777,38.905,13.43,53.377,27.893 c16.615,16.621,26.77,37.824,29.339,61.351l0.547,4.979l7.548,1.087c1.213,0.096,2.444,0.084,4.18,0.096l9.091,0.312 l-0.721-7.422C250.16,180.505,237.946,154.543,217.698,134.282z"/> </g> <g> <path d="M251.884,100.101c-29.724-29.718-69.316-47.42-111.485-49.831l-8.191-0.511l1.366,8.067 c0.417,2.627,0.928,5.314,1.468,8.113l0.997,4.894l4.951,0.306c36.389,2.492,70.554,17.994,96.212,43.646 c25.244,25.247,40.671,59.024,43.433,95.064l0.475,6.413l6.407-0.378c1.519-0.078,3.014-0.21,5.2-0.402l9.169-0.721 l-0.505-6.497C298.247,167.297,280.671,128.884,251.884,100.101z"/> </g> <g> <path d="M349.702,203.665c-4.191-52.005-26.775-100.943-63.603-137.777C246.804,26.59,194.496,3.805,138.85,1.712l-6.308-0.265 l-0.48,6.341c-0.111,1.771-0.186,3.522-0.252,5.281l-0.387,9.206l6.542,0.234c50.461,1.868,97.851,22.497,133.436,58.082 c33.333,33.333,53.785,77.654,57.604,124.779l0.534,6.617l6.659-0.648c2.258-0.24,4.546-0.414,6.852-0.594l7.182-0.553 L349.702,203.665z"/> </g> </g>',
				'dim' => 350.23
			),
			'e06' => array(
				'path' => '<path d="M424.055,1.842c-103.799,0-187.944,66.595-187.944,148.745c0,48.941,29.999,92.226,76.091,119.333 c-4.508,24.715-18.863,53.832-38.936,73.906c49.008-3.658,92.142-17.711,120.385-46.613c9.921,1.28,20.028,2.119,30.405,2.119 c103.8,0,187.945-66.595,187.945-148.745C612,68.438,527.854,1.842,424.055,1.842z M335.953,179.954 c-16.219,0-29.367-13.148-29.367-29.368c0-16.219,13.148-29.368,29.367-29.368s29.367,13.149,29.367,29.368 C365.32,166.807,352.172,179.954,335.953,179.954z M424.055,179.954c-16.219,0-29.367-13.148-29.367-29.368 c0-16.219,13.148-29.368,29.367-29.368c16.22,0,29.367,13.149,29.367,29.368C453.422,166.807,440.274,179.954,424.055,179.954z M512.157,179.954c-16.22,0-29.367-13.148-29.367-29.368c0-16.219,13.148-29.368,29.367-29.368 c16.22,0,29.368,13.149,29.368,29.368C541.525,166.807,528.377,179.954,512.157,179.954z M387.577,492.87 c-59.589-47.889-76.252-24.348-103.29,2.686c-18.875,18.883-66.644-20.549-107.889-61.797 c-41.248-41.252-80.671-89.012-61.797-107.891c27.039-27.035,50.573-43.708,2.67-103.279c-47.887-59.595-79.809-13.842-106,12.351 c-30.237,30.227-1.593,142.87,109.735,254.218c111.344,111.33,223.987,139.955,254.207,109.74 C401.4,572.702,447.167,540.784,387.577,492.87z M74.38,254.898c-0.804,0.329-1.984,0.812-3.485,1.426 c-2.841,1.088-6.238,2.32-10.019,3.965c-1.764,0.85-3.742,1.77-5.546,2.904c-1.871,1.117-3.73,2.384-5.406,3.951 c-1.831,1.482-3.254,3.376-4.901,5.361c-1.224,2.189-2.804,4.426-3.657,7.114c-1.239,2.544-1.683,5.475-2.423,8.358 c-0.57,2.925-0.669,5.965-1.032,8.935c-0.037,6.001,0.196,11.765,0.969,16.677c0.404,4.994,1.672,9.213,2.172,12.137 c0.613,2.934,0.962,4.609,0.962,4.609s-0.901-1.457-2.478-4.008c-1.495-2.629-4.033-6.006-6.261-10.807 c-2.568-4.668-4.963-10.412-7.242-16.874c-0.811-3.334-1.911-6.792-2.52-10.499c-0.429-3.746-1.138-7.61-0.853-11.679 c-0.123-4.062,0.708-8.167,1.463-12.315c1.201-4.019,2.48-8.092,4.44-11.716c1.79-3.704,4.044-7.057,6.296-9.98 c2.266-3.013,4.604-5.479,6.808-7.773c4.397-4.326,8.215-7.487,10.439-9.427c1.273-1.066,1.794-1.643,2.362-2.149 c0.502-0.47,0.77-0.721,0.77-0.721l20.435,31.961C75.676,254.348,75.225,254.539,74.38,254.898z M381.067,558.52 c-2.005,2.496-5.149,6.357-9.413,10.732c-2.272,2.154-4.616,4.488-7.534,6.693c-2.732,2.283-6.055,4.373-9.438,6.334 c-3.488,1.918-7.199,3.562-11.118,4.785c-3.879,1.182-7.905,2.135-11.858,2.457l-5.88,0.42l-5.704-0.307 c-3.753-0.049-7.249-1.049-10.616-1.609c-3.358-0.623-6.403-1.871-9.319-2.707c-2.916-0.787-5.531-2.225-7.95-3.182 c-4.9-1.945-8.41-4.193-11.057-5.584c-2.6-1.434-4.084-2.252-4.084-2.252s1.675,0.258,4.607,0.707 c2.913,0.391,7.166,1.311,12.091,1.41c2.48,0.051,5.024,0.484,7.843,0.223c2.782-0.217,5.684-0.076,8.588-0.596 c2.884-0.578,5.877-0.742,8.654-1.791l4.172-1.279l3.87-1.809c10.218-4.949,15.777-13.668,18.999-20.947 c1.594-3.754,2.735-7.068,3.597-9.662c0.938-2.73,1.473-4.289,1.473-4.289l33.1,18.535 C384.088,554.803,382.989,556.157,381.067,558.52z"/>',
				'dim' => 612.001
			),
			'f01' => array(
				'path' => '<polygon style="fill:#010002;" points="83.155,234.108 102.504,306.111 130.978,306.111 166.979,194.202 137.708,194.202  116.353,267.542 97.629,194.202 69.048,194.202 49.742,267.542 28.775,194.202 0,194.202 35.419,306.111 64.238,306.111"/> <polygon style="fill:#010002;" points="265.472,194.202 236.912,194.202 217.584,267.542 196.531,194.202 167.756,194.202  203.24,306.111 232.08,306.111 251.019,234.108 270.411,306.111 298.842,306.111 334.843,194.202 305.636,194.202  284.173,267.542"/> <polygon style="fill:#010002;" points="473.392,194.202 451.973,267.542 433.292,194.202 404.668,194.202 385.34,267.542  364.395,194.202 335.577,194.202 371.082,306.111 399.879,306.111 418.818,234.108 438.146,306.111 466.662,306.111  502.664,194.202"/> <path style="fill:#010002;" d="M251.321,35.764c-86.564,0-161.026,51.166-195.28,124.765h390.582 C412.326,86.93,337.885,35.764,251.321,35.764z"/> <path style="fill:#010002;" d="M251.321,466.9c86.585,0,160.961-51.144,195.28-124.765H56.084 C90.338,415.734,164.758,466.9,251.321,466.9z"/>',
				'dim' => 502.664
			),
			'f01' => array(
				'path' => '<polygon style="fill:#010002;" points="83.155,234.108 102.504,306.111 130.978,306.111 166.979,194.202 137.708,194.202  116.353,267.542 97.629,194.202 69.048,194.202 49.742,267.542 28.775,194.202 0,194.202 35.419,306.111 64.238,306.111"/> <polygon style="fill:#010002;" points="265.472,194.202 236.912,194.202 217.584,267.542 196.531,194.202 167.756,194.202  203.24,306.111 232.08,306.111 251.019,234.108 270.411,306.111 298.842,306.111 334.843,194.202 305.636,194.202  284.173,267.542"/> <polygon style="fill:#010002;" points="473.392,194.202 451.973,267.542 433.292,194.202 404.668,194.202 385.34,267.542  364.395,194.202 335.577,194.202 371.082,306.111 399.879,306.111 418.818,234.108 438.146,306.111 466.662,306.111  502.664,194.202"/> <path style="fill:#010002;" d="M251.321,35.764c-86.564,0-161.026,51.166-195.28,124.765h390.582 C412.326,86.93,337.885,35.764,251.321,35.764z"/> <path style="fill:#010002;" d="M251.321,466.9c86.585,0,160.961-51.144,195.28-124.765H56.084 C90.338,415.734,164.758,466.9,251.321,466.9z"/>',
				'dim' => 502.664
			),
			'f02' => array(
				'path' => '<path d="M16.822,284.968h39.667v158.667c0,9.35,7.65,17,17,17h116.167c9.35,0,17-7.65,17-17V327.468h70.833v116.167 c0,9.35,7.65,17,17,17h110.5c9.35,0,17-7.65,17-17V284.968h48.167c6.8,0,13.033-4.25,15.583-10.483 c2.55-6.233,1.133-13.6-3.683-18.417L260.489,31.385c-6.517-6.517-17.283-6.8-23.8-0.283L5.206,255.785 c-5.1,4.817-6.517,12.183-3.967,18.7C3.789,281.001,10.022,284.968,16.822,284.968z M248.022,67.368l181.333,183.6h-24.367 c-9.35,0-17,7.65-17,17v158.667h-76.5V310.468c0-9.35-7.65-17-17-17H189.656c-9.35,0-17,7.65-17,17v116.167H90.489V267.968 c0-9.35-7.65-17-17-17H58.756L248.022,67.368z"/>',
				'dim' => 486.988
			),
			'f03' => array(
				'path' => '<path d="M200.001,383.488c-19.923,0-40.143-17.589-55.478-48.257c-5.703-11.407-10.538-24.114-14.447-37.802 c22.055,3.776,45.672,5.753,69.925,5.753c1.423,0,2.837-0.029,4.255-0.043c-1.801-5.453-1.874-11.426-0.025-17.146 c0.86-2.654,2.095-5.102,3.623-7.306c-2.608,0.049-5.225,0.08-7.853,0.08c-26.743,0-52.54-2.521-76-7.294 c-3.735-20.017-5.69-41.472-5.69-63.574c0-22.103,1.955-43.56,5.69-63.574c23.46-4.773,49.257-7.294,76-7.294 c26.741,0,52.54,2.521,75.999,7.294c3.736,20.015,5.691,41.471,5.691,63.574c0,14.522-0.861,28.756-2.5,42.495l16.526-33.487 c2.373-4.818,5.99-8.708,10.363-11.375c-0.113-19.067-1.564-37.419-4.209-54.731c9.229,2.782,17.93,5.958,25.979,9.52 c30.337,13.419,47.734,30.762,47.734,47.579c0,10.54-6.836,21.286-19.406,31.144l10.451,21.181l25.377,3.685 c5.194-17.78,7.993-36.571,7.993-56.007c0-110.28-89.721-200-200-200c-110.28,0-200,89.72-200,200c0,110.28,89.72,200,200,200 c12.848,0,25.412-1.231,37.592-3.559c-0.436-2.862-0.438-5.809,0.062-8.729l7.274-42.42 C231.438,372.663,215.628,383.488,200.001,383.488z M367.312,154.612c-8.364-6.032-18.258-11.606-29.584-16.615 c-12.448-5.508-26.254-10.18-41.062-13.957c-7.844-32.805-20.213-60.62-35.693-80.803 C311.355,61.954,350.889,103.168,367.312,154.612z M200.001,32.314c19.923,0,40.144,17.589,55.478,48.257 c5.703,11.407,10.539,24.114,14.445,37.801c-22.053-3.777-45.67-5.752-69.923-5.752s-47.87,1.975-69.925,5.752 c3.909-13.687,8.744-26.394,14.447-37.801C159.858,49.903,180.078,32.314,200.001,32.314z M139.029,43.237 c-15.483,20.183-27.853,47.998-35.695,80.803c-14.808,3.777-28.612,8.449-41.062,13.957 c-11.326,5.009-21.218,10.583-29.583,16.615C49.113,103.168,88.645,61.954,139.029,43.237z M72.149,160.322 c8.05-3.562,16.75-6.737,25.978-9.52c-2.753,18.03-4.229,37.179-4.229,57.099s1.477,39.067,4.229,57.099 c-9.228-2.78-17.928-5.957-25.978-9.52c-30.335-13.419-47.735-30.762-47.735-47.579 C24.414,191.084,41.814,173.741,72.149,160.322z M32.689,261.19c8.365,6.032,18.257,11.605,29.583,16.614 c12.449,5.509,26.254,10.181,41.062,13.957c7.843,32.806,20.212,60.621,35.695,80.804 C88.645,353.848,49.113,312.634,32.689,261.19z"/> <path d="M415.432,292.146c-0.895-2.755-3.278-4.771-6.151-5.189l-58.211-8.451L325.04,225.76 c-1.279-2.603-3.932-4.248-6.834-4.248c-2.9,0-5.553,1.646-6.834,4.248l-26.027,52.745l-58.212,8.451 c-2.873,0.42-5.259,2.437-6.15,5.189c-0.896,2.765-0.146,5.79,1.928,7.82l42.121,41.05l-9.943,57.976 c-0.489,2.856,0.682,5.752,3.029,7.453c2.348,1.702,5.459,1.929,8.026,0.579l52.063-27.365l52.063,27.365 c1.115,0.59,2.337,0.877,3.546,0.877c1.577,0,3.157-0.491,4.481-1.456c2.351-1.701,3.521-4.597,3.029-7.453l-9.941-57.976 l42.117-41.05C415.578,297.936,416.326,294.911,415.432,292.146z"/>',
				'dim' => 415.804
			),
			'f04' => array(
				'path' => '<path d="M18.25,106.7c5.6,5.399,12.3,9.8,20.1,12.8c7.8,3,16.5,4.6,25.9,4.6c10.5,0,20.2-1.6,28.9-4.899 c7.9-2.9,1.1-17.601-4.7-15.2c-6.399,2.7-14.2,4.1-23.101,4.1c-7,0-13.399-1.1-19-3.199c-5.6-2.101-10.5-5.101-14.5-9 c-4-3.9-7.2-8.7-9.4-14.2c-2.3-5.601-3.4-12-3.4-19c0-6.6,1.1-12.9,3.3-18.5c2.2-5.6,5.2-10.6,9.2-14.6c3.9-4.1,8.7-7.4,14.2-9.7 c5.5-2.3,11.7-3.5,18.5-3.5c6.301,0,12.1,0.9,17.301,2.5c5.1,1.6,9.5,4.1,13.199,7.4c3.7,3.3,6.6,7.3,8.7,12.1 c2.101,4.8,3.101,10.4,3.101,16.8c0,3.7-0.4,7.2-1.201,10.5c-0.799,3.1-1.799,5.899-3.199,8.1c-1.301,2.101-2.801,3.8-4.6,5 c-2.101,1.4-5.201,2.2-7.601,1.4c-3-1-2.399-5.2-2.2-7.7c0.301-3.4,1.2-6.6,1.9-9.9c1.1-5.4,2.3-10.7,3.4-16 c0.6-2.9,1.299-5.9,1.899-8.8c0.8-3.7-2-7.3-5.899-7.3h-4.4c-2.7,0-5.1,1.8-5.801,4.4c-0.299,1.2-0.6,2.2-0.6,2.2 c-2.199-6.8-10.3-8.7-16.7-8.6c-8.4,0.1-16.1,4.4-21.7,10.5c-0.5,0.6-1.1,1.2-1.6,1.8c-2.9,3.5-5.1,7.6-6.6,11.9 c-1.6,4.6-2.4,9.3-2.4,14.1c0,4.101,0.6,8,1.7,11.5c1.2,3.601,2.9,6.7,5.1,9.3c2.2,2.601,5,4.7,8.3,6.2c3.3,1.5,7,2.3,11,2.3 c3,0,5.8-0.5,8.3-1.399c2.4-0.9,4.6-2,6.5-3.3c1.5-1,2.9-2.2,4-3.301c0.699,1.301,1.5,2.4,2.6,3.5c2.801,3,7.1,4.5,12.801,4.5 c4.5,0,8.899-0.899,13-2.699c4.1-1.801,7.799-4.601,10.899-8.2c3-3.601,5.5-8,7.3-13.2c1.801-5.2,2.7-11.2,2.7-17.8 c0-9-1.7-17-5-23.7s-7.8-12.4-13.399-16.9c-5.5-4.5-11.9-7.8-19-10.1C79.05,1.1,71.75,0,64.25,0c-8.7,0-17,1.6-24.7,4.7 c-7.7,3.2-14.5,7.6-20.2,13.1c-5.8,5.5-10.4,12.2-13.7,19.7c-3.3,7.5-5,15.9-5,24.7c0,8.899,1.5,17.3,4.6,24.8 C8.25,94.6,12.65,101.2,18.25,106.7z M72.349,64.7c-0.699,2.7-1.699,5.3-3.1,7.7c-1.4,2.3-3.1,4.199-5.3,5.699 c-2,1.4-4.4,2.101-7.4,2.101c-1.9,0-3.4-0.4-4.5-1.101c-1.2-0.8-2.2-1.8-2.9-3.1c-0.8-1.4-1.3-2.9-1.6-4.4 c-0.3-1.6-0.5-3.1-0.5-4.399c0-2.8,0.4-5.6,1.2-8.5c0.8-2.8,1.9-5.4,3.4-7.6c1.5-2.2,3.2-4,5.3-5.4c1.9-1.3,4-1.9,6.5-1.9 c2,0,3.601,0.3,4.8,1c1.2,0.7,2.2,1.6,2.9,2.7c0.8,1.2,1.3,2.6,1.699,4.1c0.4,1.7,0.601,3.5,0.601,5.2 C73.349,59.3,73.05,61.9,72.349,64.7z"/>',
				'dim' => 124.099
			),
			'g01' => array(
				'path' => '<path d="M172.708,156.999L172.708,156.999c-8.681,0-15.701,7.029-15.701,15.709c0,8.664,7.037,15.701,15.701,15.701l0,0 c8.664,0,15.701-7.037,15.701-15.701C188.41,164.028,181.388,156.999,172.708,156.999z M125.605,141.306 c8.668,0,15.701-7.033,15.701-15.701c0-8.674-7.033-15.699-15.701-15.699c-8.666,0-15.699,7.025-15.699,15.699 C109.906,134.273,116.939,141.306,125.605,141.306z M172.708,109.906L172.708,109.906c-8.681,0-15.701,7.025-15.701,15.699 c0,8.668,7.021,15.701,15.701,15.701l0,0c8.664,0,15.701-7.033,15.701-15.701C188.41,116.931,181.388,109.906,172.708,109.906z M188.41,31.4h-78.504v31.402h78.504V31.4z M219.812,141.306c8.66,0,15.701-7.033,15.701-15.701 c0-8.674-7.025-15.699-15.701-15.699c-8.681,0-15.701,7.025-15.701,15.699C204.111,134.273,211.148,141.306,219.812,141.306z M219.812,188.409c8.66,0,15.701-7.037,15.701-15.701c0-8.68-7.025-15.701-15.701-15.701c-8.681,0-15.701,7.021-15.701,15.701 C204.111,181.372,211.148,188.409,219.812,188.409z M125.605,188.409c8.668,0,15.701-7.037,15.701-15.701 c0-8.68-7.025-15.709-15.701-15.709c-8.674,0-15.699,7.029-15.699,15.709C109.906,181.372,116.939,188.409,125.605,188.409z M78.504,235.513c8.666,0,15.701-7.041,15.701-15.701c0-8.68-7.035-15.701-15.701-15.701c-8.674,0-15.701,7.021-15.701,15.701 C62.803,228.472,69.837,235.513,78.504,235.513z M266.911,31.4h-15.696v31.402h15.696v204.108H31.402V62.803h15.699V31.4H31.402 C14.06,31.4,0,45.455,0,62.803v204.101c0,17.352,14.06,31.41,31.402,31.41h235.508c17.345,0,31.402-14.059,31.402-31.41V62.803 C298.313,45.455,284.255,31.4,266.911,31.4z M78.504,188.409c8.666,0,15.701-7.037,15.701-15.701 c0-8.68-7.035-15.709-15.701-15.709c-8.674,0-15.701,7.029-15.701,15.709C62.803,181.372,69.837,188.409,78.504,188.409z M78.504,141.306c8.666,0,15.701-7.033,15.701-15.701c0-8.674-7.035-15.699-15.701-15.699c-8.674,0-15.701,7.025-15.701,15.699 C62.803,134.273,69.837,141.306,78.504,141.306z M125.605,235.513c8.668,0,15.701-7.041,15.701-15.701 c0-8.68-7.033-15.701-15.701-15.701c-8.666,0-15.699,7.021-15.699,15.701C109.906,228.472,116.939,235.513,125.605,235.513z M78.504,62.803c8.666,0,15.701-7.033,15.701-15.701v-31.4C94.205,7.025,87.178,0,78.504,0c-8.667,0-15.701,7.025-15.701,15.701 v31.4C62.803,55.77,69.837,62.803,78.504,62.803z M219.812,62.803c8.66,0,15.701-7.033,15.701-15.701v-31.4 C235.513,7.025,228.472,0,219.812,0c-8.681,0-15.701,7.025-15.701,15.701v31.4C204.111,55.77,211.148,62.803,219.812,62.803z"/>',
				'dim' => 298.314
			),
			'g02' => array(
				'path' => '<path style="fill:#010002;" d="M7.685,24.819H8.28v-2.131h3.688v2.131h0.596v-2.131h3.862v2.131h0.597v-2.131h4.109v2.131h0.595 v-2.131h3.417v-0.594h-3.417v-3.861h3.417v-0.596h-3.417v-3.519h3.417v-0.594h-3.417v-2.377h-0.595v2.377h-4.109v-2.377h-0.597 v2.377h-3.862v-2.377h-0.596v2.377H8.279v-2.377H7.685v2.377H3.747v0.594h3.938v3.519H3.747v0.596h3.938v3.861H3.747v0.594h3.938 V24.819z M12.563,22.094v-3.861h3.862v3.861H12.563z M21.132,22.094h-4.109v-3.861h4.109V22.094z M21.132,14.118v3.519h-4.109 v-3.519C17.023,14.119,21.132,14.119,21.132,14.118z M16.426,14.118v3.519h-3.862v-3.519 C12.564,14.119,16.426,14.119,16.426,14.118z M8.279,14.118h3.688v3.519H8.279V14.118z M8.279,18.233h3.688v3.861H8.279V18.233z" /> <path style="fill:#010002;" d="M29.207,2.504l-4.129,0.004L24.475,2.51v2.448c0,0.653-0.534,1.187-1.188,1.187h-1.388 c-0.656,0-1.188-0.533-1.188-1.187V2.514l-1.583,0.002v2.442c0,0.653-0.535,1.187-1.191,1.187h-1.388 c-0.655,0-1.188-0.533-1.188-1.187V2.517l-1.682,0.004v2.438c0,0.653-0.534,1.187-1.189,1.187h-1.389 c-0.653,0-1.188-0.533-1.188-1.187V2.525H8.181v2.434c0,0.653-0.533,1.187-1.188,1.187H5.605c-0.656,0-1.189-0.533-1.189-1.187 V2.53L0,2.534v26.153h2.09h25.06l2.087-0.006L29.207,2.504z M27.15,26.606H2.09V9.897h25.06V26.606z"/> <path style="fill:#010002;" d="M5.605,5.303h1.388c0.163,0,0.296-0.133,0.296-0.297v-4.16c0-0.165-0.133-0.297-0.296-0.297H5.605 c-0.165,0-0.298,0.132-0.298,0.297v4.16C5.307,5.17,5.44,5.303,5.605,5.303z"/> <path style="fill:#010002;" d="M11.101,5.303h1.389c0.164,0,0.297-0.133,0.297-0.297v-4.16c-0.001-0.165-0.134-0.297-0.298-0.297 H11.1c-0.163,0-0.296,0.132-0.296,0.297v4.16C10.805,5.17,10.938,5.303,11.101,5.303z"/> <path style="fill:#010002;" d="M16.549,5.303h1.388c0.166,0,0.299-0.133,0.299-0.297v-4.16c-0.001-0.165-0.133-0.297-0.299-0.297 h-1.388c-0.164,0-0.297,0.132-0.297,0.297v4.16C16.252,5.17,16.385,5.303,16.549,5.303z"/> <path style="fill:#010002;" d="M21.899,5.303h1.388c0.164,0,0.296-0.133,0.296-0.297v-4.16c0-0.165-0.132-0.297-0.296-0.297 h-1.388c-0.164,0-0.297,0.132-0.297,0.297v4.16C21.603,5.17,21.735,5.303,21.899,5.303z"/>',
				'dim' => 29.237
			),
			'g03' => array(
				'path' => '<path d="M168.98,181.89c-1.362,1.871-2.376,3.995-3.049,6.384c-0.689,2.393-1.026,5.658-1.026,9.813 c0,4.148,0.966,8.144,2.909,11.982c1.939,3.852,4.665,7.069,8.159,9.662c7.005,5.298,16.366,7.942,28.128,7.942 c12.143,0,21.665-2.645,28.573-7.942c3.387-2.593,6.039-5.811,7.943-9.662c1.883-3.839,2.837-8.563,2.837-14.174 c0-5.498-1.567-10.536-4.669-15.12c-1.852-2.581-5.201-5.486-10.051-8.708v-0.613c1.547-1.347,3.002-2.705,4.368-4.056 c4.669-4.46,7.001-10.59,7.001-18.378c0-9.756-3.49-17.5-10.495-23.215c-6.608-5.4-15.104-8.091-25.499-8.091 s-18.843,2.697-25.363,8.091c-3.202,2.599-5.738,5.843-7.65,9.736c-1.884,3.891-2.837,8.494-2.837,13.784 c0,5.297,1.214,10.026,3.65,14.178c1.351,2.188,3.928,4.825,7.715,7.951v0.621C174.779,175.297,171.221,178.563,168.98,181.89z M193.907,148.87c0-3.014,0.994-5.588,2.989-7.708c1.992-2.128,4.437-3.194,7.366-3.194c2.805,0,5.214,1.066,7.205,3.194 c1.995,2.128,2.989,4.703,2.989,7.708v3.581c0,3.012-0.994,5.579-2.989,7.703c-1.991,2.132-4.4,3.189-7.205,3.189 c-2.914,0-5.374-1.065-7.366-3.189c-1.995-2.124-2.989-4.697-2.989-7.703V148.87z M193.907,191.082 c0-3.014,0.994-5.582,2.989-7.714c1.992-2.124,4.437-3.19,7.366-3.19c2.805,0,5.214,1.066,7.205,3.19 c1.995,2.132,2.989,4.709,2.989,7.714v5.134c0,3.014-0.994,5.582-2.989,7.714c-1.991,2.124-4.4,3.183-7.205,3.183 c-2.914,0-5.374-1.066-7.366-3.183c-1.995-2.132-2.989-4.708-2.989-7.714V191.082z M235.513,70.657 c8.659,0,15.7-7.033,15.7-15.701v-31.4c0-8.676-7.041-15.701-15.7-15.701c-8.664,0-15.701,7.025-15.701,15.701v31.4 C219.812,63.624,226.849,70.657,235.513,70.657z M204.11,39.255h-94.205v31.402h94.205V39.255z M71.08,154.811v2.998h25.808 V153.4c0-3.154,1-5.789,3.01-7.896c2-2.104,4.412-3.158,7.251-3.158h1.91c2.833,0,5.251,1.084,7.259,3.236 c2.002,2.156,3.01,4.763,3.01,7.818c0,6.524-2.649,12.051-7.923,16.566l-29.03,24.643c-4.396,3.687-7.46,7.666-9.161,11.926 c-1.713,4.264-2.569,9.385-2.569,15.38v5.695h78.443v-26.525h-38.562l15.984-11.998c9.966-7.474,16.563-14.84,19.791-22.093 c1.755-4.012,2.637-8.732,2.637-14.215c0-10.315-3.272-18.737-9.82-25.261c-6.658-6.524-15.349-9.79-26.104-9.79h-4.546 c-11.529,0-20.772,3.572-27.701,10.729C74.302,135.289,71.08,144.083,71.08,154.811z M282.611,39.255H266.91v31.402h15.701 v204.108H31.402V70.657h15.699V39.255H31.402C14.06,39.255,0,53.309,0,70.657v204.101c0,17.352,14.06,31.401,31.402,31.401 h251.209c17.345,0,31.402-14.05,31.402-31.401V70.657C314.014,53.309,299.956,39.255,282.611,39.255z M78.503,70.657 c8.666,0,15.701-7.033,15.701-15.701v-31.4c0-8.676-7.035-15.701-15.701-15.701S62.802,14.88,62.802,23.556v31.4 C62.802,63.624,69.837,70.657,78.503,70.657z"/>',
				'dim' => 314.014
			),
			'g04' => array(
				'path' => '<path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823 c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/> <path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832 c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/>',
				'dim' => 97.16
			),
			'g05' => array(
				'path' => '<path d="M46.907,20.12c-0.163-0.347-0.511-0.569-0.896-0.569h-2.927C41.223,9.452,32.355,1.775,21.726,1.775 C9.747,1.775,0,11.522,0,23.501C0,35.48,9.746,45.226,21.726,45.226c7.731,0,14.941-4.161,18.816-10.857 c0.546-0.945,0.224-2.152-0.722-2.699c-0.944-0.547-2.152-0.225-2.697,0.72c-3.172,5.481-9.072,8.887-15.397,8.887 c-9.801,0-17.776-7.974-17.776-17.774c0-9.802,7.975-17.776,17.776-17.776c8.442,0,15.515,5.921,17.317,13.825h-2.904 c-0.385,0-0.732,0.222-0.896,0.569c-0.163,0.347-0.11,0.756,0.136,1.051l4.938,5.925c0.188,0.225,0.465,0.355,0.759,0.355 c0.293,0,0.571-0.131,0.758-0.355l4.938-5.925C47.018,20.876,47.07,20.467,46.907,20.12z"/> <path d="M21.726,6.713c-1.091,0-1.975,0.884-1.975,1.975v11.984c-0.893,0.626-1.481,1.658-1.481,2.83 c0,1.906,1.551,3.457,3.457,3.457c0.522,0,1.014-0.125,1.458-0.334l6.87,3.965c0.312,0.181,0.65,0.266,0.986,0.266 c0.682,0,1.346-0.354,1.712-0.988c0.545-0.943,0.222-2.152-0.724-2.697l-6.877-3.971c-0.092-1.044-0.635-1.956-1.449-2.526V8.688 C23.701,7.598,22.816,6.713,21.726,6.713z M21.726,24.982c-0.817,0-1.481-0.665-1.481-1.48c0-0.816,0.665-1.481,1.481-1.481 s1.481,0.665,1.481,1.481C23.207,24.317,22.542,24.982,21.726,24.982z"/>',
				'dim' => 47.001
			),
			'g06' => array(
				'path' => '<path d="M369.822,42.794h17.744V0H66.305v42.794h17.746v11.105c0,69.716,23.859,133.656,63.155,171.591 c-39.296,37.942-63.155,101.877-63.155,171.596v13.992H66.305v42.793h321.261v-42.793h-17.744v-13.992 c0-69.719-23.863-133.653-63.154-171.596c39.291-37.935,63.154-101.864,63.154-171.591V42.794z M276.738,214.327l-14.735,11.163 l14.735,11.163c36.771,27.885,61.451,84.345,64.71,146.425H112.431c3.257-62.074,27.926-118.534,64.708-146.425l14.727-11.163 l-14.727-11.163c-36.776-27.888-61.451-84.34-64.708-146.42h229.008C338.189,129.987,313.508,186.439,276.738,214.327z M141.955,90.167h169.96c-2.457,47.136-21.202,90.009-49.143,111.183c0,0-4.784,2.066-11.173,8.47 c-13.218,18.876-13.923,87.873-13.945,90.915c9.49,1.013,19.743,5.018,29.904,14.299c35.85,32.755,46.252,36.618,47.503,60.396 H146.965c1.25-23.772,21.646-40.785,47.5-60.396c0,0,12.3-10.795,29.552-13.79c-0.314-0.542-0.498-0.908-0.498-0.908 c0-64.99-21.248-92.857-21.248-92.857l-15.103-8.47C159.236,177.821,144.42,137.304,141.955,90.167z"/>',
				'dim' => 453.872
			),
			'h01' => array(
				'path' => '<path style="fill:#030104;" d="M50,40c-8.285,0-15,6.718-15,15c0,8.285,6.715,15,15,15c8.283,0,15-6.715,15-15 C65,46.718,58.283,40,50,40z M90,25H78c-1.65,0-3.428-1.28-3.949-2.846l-3.102-9.309C70.426,11.28,68.65,10,67,10H33 c-1.65,0-3.428,1.28-3.949,2.846l-3.102,9.309C25.426,23.72,23.65,25,22,25H10C4.5,25,0,29.5,0,35v45c0,5.5,4.5,10,10,10h80 c5.5,0,10-4.5,10-10V35C100,29.5,95.5,25,90,25z M50,80c-13.807,0-25-11.193-25-25c0-13.806,11.193-25,25-25 c13.805,0,25,11.194,25,25C75,68.807,63.805,80,50,80z M86.5,41.993c-1.932,0-3.5-1.566-3.5-3.5c0-1.932,1.568-3.5,3.5-3.5 c1.934,0,3.5,1.568,3.5,3.5C90,40.427,88.433,41.993,86.5,41.993z"/>',
				'dim' => 100
			),
			'h02' => array('path' => '<path d="M352,128v352H32V128H352 M384,96H0v416h384V96L384,96z M320,160H64v256h256V160z M416,114.75V242.5l21.844-123.906 L416,114.75z M133.813,0l-11.281,64h32.5l4.75-26.938L312.5,64H416v18.25l58.906,10.375L416,426.844v45.344l23.75,4.188L512,66.688 L133.813,0z"/>'),
			'h03' => array(
				'path' => '<path d="M310.58,33.331H5c-2.761,0-5,2.238-5,5v238.918c0,2.762,2.239,5,5,5h305.58c2.763,0,5-2.238,5-5V38.331 C315.58,35.569,313.343,33.331,310.58,33.331z M285.58,242.386l-68.766-71.214c-0.76-0.785-2.003-0.836-2.823-0.114l-47.695,41.979 l-60.962-75.061c-0.396-0.49-0.975-0.77-1.63-0.756c-0.631,0.013-1.22,0.316-1.597,0.822L30,234.797V63.331h255.58V242.386z"/> <path d="M210.059,135.555c13.538,0,24.529-10.982,24.529-24.531c0-13.545-10.991-24.533-24.529-24.533 c-13.549,0-24.528,10.988-24.528,24.533C185.531,124.572,196.511,135.555,210.059,135.555z"/>',
				'dim' => 315.58
			),
			'h04' => array(
				'path' => '<path d="M177.5,161.55c0-23.2-18.8-42.1-42.1-42.1H91.5c-23.2,0-42.1,18.8-42.1,42.1v15.9h128v-15.9H177.5z"/> <path d="M46.8,211.25c-25.9,0-46.8,21.4-46.8,47.8v451.399c0,26.4,21,47.801,46.8,47.801h738.9c25.9,0,46.8-21.4,46.8-47.801 V259.15c0-26.4-21-47.8-46.8-47.8H630.3l-19.3-98.7c-4.399-22.3-23.6-38.4-45.899-38.4H421.2H278.5c-22.3,0-41.5,16.1-45.899,38.4 l-19.3,98.7h-35.8h-128h-2.7V211.25z M416.2,284.75c104.1,0,188.5,86.2,188.5,192.6c0,106.4-84.4,192.6-188.5,192.6 s-188.5-86.199-188.5-192.6C227.7,370.95,312.101,284.75,416.2,284.75z"/>',
				'dim' => 832.5
			),
			'j01' => array(
				'path' => '<path style="fill:#010002;" d="M242.816,0C148.699,0,72.396,76.303,72.396,170.419c0,7.205,0.578,14.227,1.459,21.188 C88.417,324.727,231.75,478.153,231.75,478.153c2.554,2.858,5.016,4.621,7.387,5.897l0.122,0.061l4.773,1.52l4.773-1.52 l0.122-0.061c2.371-1.277,4.834-3.131,7.387-5.897c0,0,141.266-153.7,155.493-286.849c0.851-6.87,1.429-13.832,1.429-20.915 C413.205,76.303,336.933,0,242.816,0z M242.816,280.04c-60.434,0-109.62-49.186-109.62-109.62s49.186-109.62,109.62-109.62 s109.59,49.186,109.59,109.62S303.25,280.04,242.816,280.04z"/>',
				'dim' => 485.632
			),
			'j02' => array(
				'path' => '<path d="M35.5,248.4v531.401c0,12.898,8.2,24.299,20.4,28.398l228.3,76.9V290.4L75,220C55.6,213.4,35.5,227.9,35.5,248.4z"/> <path d="M632.4,492.699c-8.601,9.102-19.601,15.5-31.5,18.5V801.4l209.1,70.4c19.4,6.5,39.6-7.9,39.6-28.4V312 c0-12.9-8.199-24.3-20.399-28.4L786,269c-9.5,26.5-24.8,56.1-45.8,88.6C712.5,400.5,675.2,447.301,632.4,492.699z"/> <path d="M537.6,492.6C496,448.199,459.2,401.9,431,358.7c-21.8-33.5-37.6-63.7-47.2-90.4l-65.6,22.1v594.7l248.7-83.799V510.6 C555.8,507.301,545.6,501.199,537.6,492.6z"/> <path d="M585.5,0c-0.2,0-0.4,0-0.5,0C484.7,0,401.9,80.4,399.1,180.7c-0.5,17.4,1.4,34.3,5.4,50.4c1.6,8.6,4.2,17.8,7.8,27.6 c17.2,47.3,44.5,90.3,75.2,130c19.9,25.8,61,94.4,97.5,94.4c38.8,0,83.3-76.299,103.5-103.6c27.3-36.899,53.5-76.7,69.1-120.1 c3.601-10,6.301-19.5,7.9-28.3c3.6-14.4,5.5-29.5,5.5-45.1C771,83.5,688,0.3,585.5,0z M600.9,278.7c-5.2,0.8-10.5,1.3-15.9,1.3 c-6.2,0-12.2-0.6-18.1-1.7c-29.101-5.4-53.7-23.8-67.601-48.9c-7.8-14.1-12.2-30.2-12.2-47.4c0-54.1,43.9-98,98-98 c54.101,0,98,43.9,98,98c0,17.5-4.6,33.9-12.6,48.1C656.1,255.4,630.7,273.8,600.9,278.7z"/>',
				'dim' => 885.1
			),
			'j03' => array(
				'path' => '<path d="M457.021,309.299l20.238-159.582L332.072,94.625l-45.974,21.953c-1.419,7.021-3.57,13.854-6.384,20.428l34.803-16.618 l-14.369,154.664l0.804,8.286L194.91,299.333l-8.703,17.165l116.276-17.531l13.405,137.177l15.604-1.537l-13.488-137.969 l1.359-0.213l121.573,15.403l0.295-2.376l18.371,154.282l-126.609-29.223l-164.753,31.387l-1.372-0.26l14.81-140.725l-0.098-0.856 l-0.606-5.272l-20.3-40.075l2.864,25.352l-3.621,0.544L42.475,286.412l0.697-5.781L25.177,138.755l82.171,34.693l-6.859-13.521 c-2.219-2.876-4.229-5.891-6.135-8.958L6.188,113.735L27.373,280.69l-0.399,3.321l-0.295-0.047l-2.409,15.486l0.866,0.118 L7.037,451.605l161.225,30.229l164.438-31.315l145.121,33.49L457.021,309.299z M319.188,280.596l-2.707,0.396l-0.592-5.894 l15.108-162.587l1.785-0.854l127.365,48.326l-17.295,136.264L319.188,280.596z M151.41,462.742L24.329,438.91l16.314-136.918 l119.252,18.478l5.417-0.815l0.606,5.319L151.41,462.742z M183.018,322.799l-2.033-4.008l-0.165-1.478l5.394-0.815L183.018,322.799 z M112.68,146.528l69.248,136.657l68.494-135.194c13.453-15.687,21.634-36.017,21.634-58.268C272.055,40.249,231.802,0,182.326,0 c-49.473,0-89.71,40.249-89.71,89.723c0,21.542,7.637,41.316,20.33,56.805H112.68z M182.332,34.578 c30.402,0,55.147,24.742,55.147,55.145c0,30.401-24.745,55.147-55.147,55.147c-30.402,0-55.145-24.746-55.145-55.147 C127.188,59.32,151.924,34.578,182.332,34.578z"/>',
				'dim' => 484.009
			),
			'j04' => array(
				'path' => '<path d="M87.247,0C39.139,0,0,39.139,0,87.247s39.139,87.247,87.247,87.247s87.247-39.139,87.247-87.247S135.354,0,87.247,0z M74.008,16.237c0.815,0.267,1.618,0.556,2.419,0.849c-7,4.743-13.317,10.52-18.655,17.176 c-4.972,6.199-9.002,13.068-12.035,20.347H22.825C32.845,34.911,51.624,20.401,74.008,16.237z M15,87.247 c0-7.906,1.295-15.512,3.653-22.638h23.629c-2.036,7.337-3.111,14.953-3.111,22.638s1.074,15.301,3.111,22.638H18.653 C16.295,102.759,15,95.153,15,87.247z M74.007,158.256c-22.384-4.165-41.163-18.674-51.183-38.371h22.913 c3.034,7.279,7.064,14.148,12.036,20.348c5.338,6.655,11.654,12.433,18.653,17.175C75.626,157.7,74.823,157.989,74.007,158.256z M82.247,149.381c-11.061-7.386-19.899-17.581-25.645-29.496h25.645V149.381z M82.247,109.885H52.639 c-2.254-7.166-3.468-14.774-3.468-22.638s1.214-15.472,3.468-22.638h29.608V109.885z M82.247,54.608H56.601 c5.746-11.915,14.584-22.109,25.645-29.496V54.608z M100.485,16.237c22.384,4.164,41.163,18.674,51.183,38.371h-22.913 c-3.034-7.279-7.064-14.148-12.036-20.348c-5.338-6.655-11.655-12.433-18.654-17.175C98.867,16.793,99.67,16.504,100.485,16.237z M92.247,25.113c11.061,7.386,19.899,17.581,25.645,29.496H92.247V25.113z M92.247,64.608h29.608 c2.254,7.166,3.468,14.774,3.468,22.638s-1.214,15.472-3.468,22.638H92.247V64.608z M92.247,119.885h25.645 c-5.746,11.914-14.584,22.109-25.645,29.495V119.885z M100.485,158.256c-0.815-0.267-1.619-0.556-2.42-0.849 c7-4.743,13.317-10.52,18.655-17.177c4.972-6.199,9.002-13.068,12.035-20.346h22.913 C141.648,139.583,122.869,154.092,100.485,158.256z M132.212,109.885c2.036-7.337,3.111-14.953,3.111-22.638 c0-7.685-1.074-15.301-3.111-22.638h23.629c2.358,7.126,3.653,14.732,3.653,22.638s-1.295,15.512-3.653,22.638H132.212z"/>',
				'dim' => 174.493
			),
			'j05' => array(
				'path' => '<path d="M7.703,15.973c0,0,5.651-5.625,5.651-10.321C13.354,2.53,10.824,0,7.703,0S2.052,2.53,2.052,5.652 C2.052,10.614,7.703,15.973,7.703,15.973z M4.758,5.652c0-1.628,1.319-2.946,2.945-2.946s2.945,1.318,2.945,2.946 c0,1.626-1.319,2.944-2.945,2.944S4.758,7.278,4.758,5.652z"/> <path d="M28.59,7.643l-0.459,0.146l-2.455,0.219l-0.692,1.106l-0.501-0.16l-1.953-1.76l-0.285-0.915l-0.377-0.977L20.639,4.2 l-1.446-0.283L19.159,4.58l1.418,1.384l0.694,0.817l-0.782,0.408l-0.636-0.188l-0.951-0.396l0.033-0.769l-1.25-0.514L17.27,7.126 l-1.258,0.286l0.125,1.007l1.638,0.316l0.284-1.609l1.353,0.201l0.629,0.368h1.011l0.69,1.384l1.833,1.859l-0.134,0.723 l-1.478-0.189l-2.553,1.289l-1.838,2.205l-0.239,0.976h-0.661l-1.229-0.566l-1.194,0.566l0.297,1.261l0.52-0.602l0.913-0.027 l-0.064,1.132l0.757,0.22l0.756,0.85l1.234-0.347l1.41,0.222l1.636,0.441l0.819,0.095l1.384,1.573l2.675,1.574l-1.729,3.306 l-1.826,0.849l-0.693,1.889l-2.643,1.765l-0.282,1.019c6.753-1.627,11.779-7.693,11.779-14.95 C31.194,13.038,30.234,10.09,28.59,7.643z"/> <path d="M17.573,24.253l-1.12-2.078l1.028-2.146l-1.028-0.311l-1.156-1.159l-2.56-0.573l-0.85-1.779v1.057h-0.375l-1.625-2.203 c-0.793,0.949-1.395,1.555-1.47,1.629L7.72,17.384l-0.713-0.677c-0.183-0.176-3.458-3.315-5.077-7.13 c-0.966,2.009-1.52,4.252-1.52,6.63c0,8.502,6.891,15.396,15.393,15.396c0.654,0,1.296-0.057,1.931-0.135l-0.161-1.864 c0,0,0.707-2.77,0.707-2.863C18.28,26.646,17.573,24.253,17.573,24.253z"/> <path d="M14.586,3.768l1.133,0.187l2.75-0.258l0.756-0.834l1.068-0.714l1.512,0.228l0.551-0.083 c-1.991-0.937-4.207-1.479-6.553-1.479c-1.096,0-2.16,0.128-3.191,0.345c0.801,0.875,1.377,1.958,1.622,3.163L14.586,3.768z M16.453,2.343l1.573-0.865l1.009,0.582l-1.462,1.113l-1.394,0.141L15.55,2.907L16.453,2.343z"/>',
				'dim' => 31.603
			),
			'j01' => array(
				'path' => '<path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803 c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654 c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246 c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z"/>',
				'dim' => 96.124
			),
			'j02' => array(
				'path' => '<path d="M62.617,0H39.525c-10.29,0-17.413,2.256-23.824,7.552c-5.042,4.35-8.051,10.672-8.051,16.912 c0,9.614,7.33,19.831,20.913,19.831c1.306,0,2.752-0.134,4.028-0.253l-0.188,0.457c-0.546,1.308-1.063,2.542-1.063,4.468 c0,3.75,1.809,6.063,3.558,8.298l0.22,0.283l-0.391,0.027c-5.609,0.384-16.049,1.1-23.675,5.787 c-9.007,5.355-9.707,13.145-9.707,15.404c0,8.988,8.376,18.06,27.09,18.06c21.76,0,33.146-12.005,33.146-23.863 c0.002-8.771-5.141-13.101-10.6-17.698l-4.605-3.582c-1.423-1.179-3.195-2.646-3.195-5.364c0-2.672,1.772-4.436,3.336-5.992 l0.163-0.165c4.973-3.917,10.609-8.358,10.609-17.964c0-9.658-6.035-14.649-8.937-17.048h7.663c0.094,0,0.188-0.026,0.266-0.077 l6.601-4.15c0.188-0.119,0.276-0.348,0.214-0.562C63.037,0.147,62.839,0,62.617,0z M34.614,91.535 c-13.264,0-22.176-6.195-22.176-15.416c0-6.021,3.645-10.396,10.824-12.997c5.749-1.935,13.17-2.031,13.244-2.031 c1.257,0,1.889,0,2.893,0.126c9.281,6.605,13.743,10.073,13.743,16.678C53.141,86.309,46.041,91.535,34.614,91.535z M34.489,40.756c-11.132,0-15.752-14.633-15.752-22.468c0-3.984,0.906-7.042,2.77-9.351c2.023-2.531,5.487-4.166,8.825-4.166 c10.221,0,15.873,13.738,15.873,23.233c0,1.498,0,6.055-3.148,9.22C40.94,39.337,37.497,40.756,34.489,40.756z"/> <path d="M94.982,45.223H82.814V33.098c0-0.276-0.225-0.5-0.5-0.5H77.08c-0.276,0-0.5,0.224-0.5,0.5v12.125H64.473 c-0.276,0-0.5,0.224-0.5,0.5v5.304c0,0.275,0.224,0.5,0.5,0.5H76.58V63.73c0,0.275,0.224,0.5,0.5,0.5h5.234 c0.275,0,0.5-0.225,0.5-0.5V51.525h12.168c0.276,0,0.5-0.223,0.5-0.5v-5.302C95.482,45.446,95.259,45.223,94.982,45.223z"/>',
				'dim' => 96.828
			),
			'j03' => array(
				'path' => '<path style="fill:#010002;" d="M612,116.258c-22.525,9.981-46.694,16.75-72.088,19.772c25.929-15.527,45.777-40.155,55.184-69.411 c-24.322,14.379-51.169,24.82-79.775,30.48c-22.907-24.437-55.49-39.658-91.63-39.658c-69.334,0-125.551,56.217-125.551,125.513 c0,9.828,1.109,19.427,3.251,28.606C197.065,206.32,104.556,156.337,42.641,80.386c-10.823,18.51-16.98,40.078-16.98,63.101 c0,43.559,22.181,81.993,55.835,104.479c-20.575-0.688-39.926-6.348-56.867-15.756v1.568c0,60.806,43.291,111.554,100.693,123.104 c-10.517,2.83-21.607,4.398-33.08,4.398c-8.107,0-15.947-0.803-23.634-2.333c15.985,49.907,62.336,86.199,117.253,87.194 c-42.947,33.654-97.099,53.655-155.916,53.655c-10.134,0-20.116-0.612-29.944-1.721c55.567,35.681,121.536,56.485,192.438,56.485 c230.948,0,357.188-191.291,357.188-357.188l-0.421-16.253C573.872,163.526,595.211,141.422,612,116.258z"/>',
				'dim' => 612
			),
			'j04' => array(
				'path' => '<path d="M30.667,14.939c0,8.25-6.74,14.938-15.056,14.938c-2.639,0-5.118-0.675-7.276-1.857L0,30.667l2.717-8.017 c-1.37-2.25-2.159-4.892-2.159-7.712C0.559,6.688,7.297,0,15.613,0C23.928,0.002,30.667,6.689,30.667,14.939z M15.61,2.382 c-6.979,0-12.656,5.634-12.656,12.56c0,2.748,0.896,5.292,2.411,7.362l-1.58,4.663l4.862-1.545c2,1.312,4.393,2.076,6.963,2.076 c6.979,0,12.658-5.633,12.658-12.559C28.27,8.016,22.59,2.382,15.61,2.382z M23.214,18.38c-0.094-0.151-0.34-0.243-0.708-0.427 c-0.367-0.184-2.184-1.069-2.521-1.189c-0.34-0.123-0.586-0.185-0.832,0.182c-0.243,0.367-0.951,1.191-1.168,1.437 c-0.215,0.245-0.43,0.276-0.799,0.095c-0.369-0.186-1.559-0.57-2.969-1.817c-1.097-0.972-1.838-2.169-2.052-2.536 c-0.217-0.366-0.022-0.564,0.161-0.746c0.165-0.165,0.369-0.428,0.554-0.643c0.185-0.213,0.246-0.364,0.369-0.609 c0.121-0.245,0.06-0.458-0.031-0.643c-0.092-0.184-0.829-1.984-1.138-2.717c-0.307-0.732-0.614-0.611-0.83-0.611 c-0.215,0-0.461-0.03-0.707-0.03S9.897,8.215,9.56,8.582s-1.291,1.252-1.291,3.054c0,1.804,1.321,3.543,1.506,3.787 c0.186,0.243,2.554,4.062,6.305,5.528c3.753,1.465,3.753,0.976,4.429,0.914c0.678-0.062,2.184-0.885,2.49-1.739 C23.307,19.268,23.307,18.533,23.214,18.38z"/>',
				'dim' => 30.667
			),
			'j05' => array(
				'path' => '<path d="M309.644,192.877c1.732-9.032,2.648-18.352,2.648-27.888c0-81.353-65.954-147.302-147.304-147.302 c-9.537,0-18.858,0.917-27.891,2.649c-32.52-28.348-81.894-27.063-112.86,3.902c-30.967,30.964-32.253,80.341-3.902,112.863 c-1.731,9.031-2.648,18.352-2.648,27.888c0,81.354,65.953,147.303,147.302,147.303c9.538,0,18.86-0.917,27.894-2.649 c32.518,28.348,81.893,27.063,112.859-3.902C336.705,274.776,337.993,225.399,309.644,192.877z M167.795,255.715 c-43.627,0-79.982-19.5-79.982-43.298c0-10.575,5.946-20.163,19.495-20.163c20.826,0,22.811,29.746,58.511,29.746 c17.182,0,28.091-7.602,28.091-17.515c0-12.231-10.576-14.213-27.762-18.509l-28.424-6.939 c-28.099-6.943-49.911-18.51-49.911-50.902c0-39.332,38.998-53.873,72.381-53.873c36.691,0,73.708,14.541,73.708,36.684 c0,11.236-7.608,21.158-20.163,21.158c-18.841,0-19.507-22.146-49.907-22.146c-16.855,0-27.762,4.626-27.762,14.874 c0,11.236,10.907,13.877,25.784,17.185l20.156,4.629c27.428,6.275,60.156,17.845,60.156,51.564 C242.166,237.535,204.15,255.715,167.795,255.715z"/>',
				'dim' => 329.978
			),
			'j06' => array(
				'path' => '<path d="M266.667,0C119.391,0,0,119.391,0,266.667c0,147.275,119.388,266.666,266.667,266.666 c147.275,0,266.667-119.391,266.667-266.666C533.333,119.391,413.942,0,266.667,0z M292.523,356.311 c-24.229-1.882-34.397-13.883-53.388-25.421c-10.448,54.781-23.21,107.302-61.01,134.734 c-11.669-82.795,17.132-144.981,30.505-210.997c-22.804-38.389,2.744-115.643,50.844-96.601 c59.18,23.41-51.25,142.712,22.881,157.613c77.406,15.556,109.004-134.302,61.011-183.035 c-69.354-70.367-201.874-1.604-185.578,99.144c3.966,24.631,29.412,32.103,10.168,66.095c-44.385-9.839-57.63-44.845-55.925-91.517 c2.744-76.393,68.638-129.877,134.733-137.274c83.584-9.356,162.035,30.681,172.867,109.311 C431.826,267.107,381.899,363.223,292.523,356.311z"/>',
				'dim' => 533.333
			),
			'j07' => array(
				'path' => '<path d="M5.583,13c-0.553,0-1-0.447-1-1V3c0-0.553,0.447-1,1-1s1,0.447,1,1v9C6.583,12.553,6.136,13,5.583,13z"/> <path d="M8.958,13c-0.553,0-1-0.447-1-1V2.25c0-0.553,0.447-1,1-1s1,0.447,1,1V12C9.958,12.553,9.511,13,8.958,13z"/> <path d="M12.333,13c-0.553,0-1-0.447-1-1V2.25c0-0.553,0.447-1,1-1s1,0.447,1,1V12C13.333,12.553,12.886,13,12.333,13z"/> <path d="M37.292,48H11.917C4.344,48,0,44.014,0,37.062V12.125C0,4.873,4.27,0,10.625,0h27.584C42.918,0,48,4.524,48,11.834v25.083 C48,43.132,43.297,48,37.292,48z M10.625,2C4.259,2,2,7.454,2,12.125v24.938C2,44.449,7.393,46,11.917,46h25.375 C42.257,46,46,42.095,46,36.917V11.834C46,5.76,41.956,2,38.209,2H10.625z"/> <path d="M23.999,15.25c-4.234,0-7.667,3.434-7.667,7.668c0,4.234,3.433,7.666,7.667,7.666c4.233,0,7.667-3.432,7.667-7.666 C31.666,18.684,28.232,15.25,23.999,15.25z M23.999,26.75c-2.117,0-3.834-1.716-3.834-3.833s1.717-3.834,3.834-3.834 s3.834,1.717,3.834,3.834S26.116,26.75,23.999,26.75z"/> <path d="M23.999,35.084c-6.709,0-12.167-5.458-12.167-12.167S17.29,10.75,23.999,10.75s12.167,5.458,12.167,12.167 S30.708,35.084,23.999,35.084z M23.999,12.75c-5.606,0-10.167,4.561-10.167,10.167c0,5.606,4.561,10.167,10.167,10.167 c5.606,0,10.167-4.561,10.167-10.167C34.166,17.311,29.605,12.75,23.999,12.75z"/> <rect x="32.999" y="14.92" width="14" height="2.16"/> <rect x="1.499" y="14.949" width="13.25" height="2.102"/> <path d="M41.333,10.133c0,1.215-0.985,2.201-2.202,2.201h-3.264c-1.217,0-2.202-0.986-2.202-2.201V6.867 c0-1.215,0.985-2.201,2.202-2.201h3.264c1.217,0,2.202,0.986,2.202,2.201V10.133z"/>',
				'dim' => 48
			),
			'j08' => array(
				'path' => '<path d="M0.176,224L0.001,67.963l192-26.072V224H0.176z M224.001,37.241L479.937,0v224H224.001V37.241z M479.999,256l-0.062,224 l-255.936-36.008V256H479.999z M192.001,439.918L0.157,413.621L0.147,256h191.854V439.918z"/>',
				'dim' => 480
			),
			'j09' => array(
				'path' => '<path id="LinkedIn__x28_alt_x29_" d="M398.355,0H31.782C14.229,0,0.002,13.793,0.002,30.817v368.471 c0,17.025,14.232,30.83,31.78,30.83h366.573c17.549,0,31.76-13.814,31.76-30.83V30.817C430.115,13.798,415.904,0,398.355,0z M130.4,360.038H65.413V165.845H130.4V360.038z M97.913,139.315h-0.437c-21.793,0-35.92-14.904-35.92-33.563 c0-19.035,14.542-33.535,36.767-33.535c22.227,0,35.899,14.496,36.331,33.535C134.654,124.415,120.555,139.315,97.913,139.315z M364.659,360.038h-64.966V256.138c0-26.107-9.413-43.921-32.907-43.921c-17.973,0-28.642,12.018-33.327,23.621 c-1.736,4.144-2.166,9.94-2.166,15.728v108.468h-64.954c0,0,0.85-175.979,0-194.192h64.964v27.531 c8.624-13.229,24.035-32.1,58.534-32.1c42.76,0,74.822,27.739,74.822,87.414V360.038z M230.883,193.99 c0.111-0.182,0.266-0.401,0.42-0.614v0.614H230.883z"/>',
				'dim' => 430.117
			),
			'j10' => array(
				'path' => '<path id="YouTube__x28_alt_x29_" d="M90,26.958C90,19.525,83.979,13.5,76.55,13.5h-63.1C6.021,13.5,0,19.525,0,26.958v36.084 C0,70.475,6.021,76.5,13.45,76.5h63.1C83.979,76.5,90,70.475,90,63.042V26.958z M36,60.225V26.33l25.702,16.947L36,60.225z"/>',
				'dim' => 90
			),
			'k01' => array(
				'path' => '<path d="M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255s255-114.75,255-255S395.25,0,255,0z M204,382.5L76.5,255l35.7-35.7 l91.8,91.8l193.8-193.8l35.7,35.7L204,382.5z"/>',
				'dim' => 510
			),
			'k02' => array(
				'path' => '<path d="M459,0H102C73.95,0,51,22.95,51,51v328.95c0,17.85,7.65,33.149,22.95,43.35L280.5,561l206.55-137.7 C499.8,413.1,510,397.8,510,379.95V51C510,22.95,487.05,0,459,0z M229.5,382.5L102,255l35.7-35.7l91.8,91.8l193.8-193.8L459,153 L229.5,382.5z"/>',
				'dim' => 561
			),
			'k03' => array(
				'path' => '<path d="M22.118,44.236C9.922,44.236,0,34.314,0,22.119C0,9.923,9.922,0,22.118,0s22.118,9.922,22.118,22.119 S34.314,44.236,22.118,44.236z M22.118,1.5C10.75,1.5,1.5,10.75,1.5,22.119s9.25,20.619,20.618,20.619s20.618-9.25,20.618-20.619 S33.486,1.5,22.118,1.5z"/> <path d="M18.674,27.842c-0.192,0-0.384-0.072-0.53-0.219l-4.333-4.327c-0.293-0.293-0.293-0.768-0.001-1.061 c0.293-0.294,0.769-0.293,1.061-0.001l3.803,3.798l10.693-10.693c0.293-0.293,0.768-0.293,1.061,0s0.293,0.768,0,1.061 L19.204,27.623C19.058,27.77,18.866,27.842,18.674,27.842z"/>',
				'dim' => 44.236
			),
			'k03' => array(
				'path' => '<path d="M327.081,0H90.234C74.331,0,61.381,12.959,61.381,28.859v412.863c0,15.924,12.95,28.863,28.853,28.863H380.35 c15.917,0,28.855-12.939,28.855-28.863V89.234L327.081,0z M333.891,43.184l35.996,39.121h-35.996V43.184z M384.972,441.723 c0,2.542-2.081,4.629-4.635,4.629H90.234c-2.55,0-4.619-2.087-4.619-4.629V28.859c0-2.548,2.069-4.613,4.619-4.613h219.411v70.181 c0,6.682,5.443,12.099,12.129,12.099h63.198V441.723z M128.364,128.89H334.15c5.013,0,9.079,4.066,9.079,9.079 c0,5.013-4.066,9.079-9.079,9.079H128.364c-5.012,0-9.079-4.066-9.079-9.079C119.285,132.957,123.352,128.89,128.364,128.89z M343.229,198.98c0,5.012-4.066,9.079-9.079,9.079H128.364c-5.012,0-9.079-4.066-9.079-9.079s4.067-9.079,9.079-9.079H334.15 C339.163,189.901,343.229,193.968,343.229,198.98z M343.229,257.993c0,5.013-4.066,9.079-9.079,9.079H128.364 c-5.012,0-9.079-4.066-9.079-9.079s4.067-9.079,9.079-9.079H334.15C339.163,248.914,343.229,252.98,343.229,257.993z M343.229,318.011c0,5.013-4.066,9.079-9.079,9.079H128.364c-5.012,0-9.079-4.066-9.079-9.079s4.067-9.079,9.079-9.079H334.15 C339.163,308.932,343.229,312.998,343.229,318.011z"/>',
				'dim' => 470.586
			),
			'k04' => array(
				'path' => '<path d="M0,51v102h51V51h102V0H51C22.95,0,0,22.95,0,51z M51,306H0v102c0,28.05,22.95,51,51,51h102v-51H51V306z M408,408H306v51 h102c28.05,0,51-22.95,51-51V306h-51V408z M408,0H306v51h102v102h51V51C459,22.95,436.05,0,408,0z"/>',
				'dim' => 459
			),
			'k05' => array(
				'path' => '<path d="M316.33,64.556c-34.982-27.607-81.424-42.811-130.772-42.811c-49.348,0-95.79,15.204-130.771,42.811 C19.457,92.438,0,129.615,0,169.238c0,23.835,7.308,47.508,21.133,68.46c12.759,19.335,31.07,36.42,53.088,49.564 c-1.016,7.116-6.487,27.941-35.888,52.759c-1.513,1.278-2.13,3.328-1.572,5.229c0.558,1.9,2.185,3.292,4.148,3.55 c0.178,0.023,4.454,0.572,12.052,0.572c21.665,0,65.939-4.302,120.063-32.973c4.177,0.221,8.387,0.333,12.534,0.333 c49.348,0,95.789-15.204,130.772-42.811c35.33-27.882,54.787-65.059,54.787-104.683C371.117,129.615,351.66,92.438,316.33,64.556z" />',
				'dim' => 371.117
			),
			'k06' => array(
				'path' => '<path style="fill:#010002;" d="M150.669,84.068c7.858-7.823,5.43-23.647-8.181-23.647l-35.813,0.024 c1.36-7.584,3.33-20.156,3.252-21.343c-0.752-11.242-7.918-24.924-8.228-25.484c-1.307-2.434-7.906-5.734-14.547-4.32 c-8.586,1.838-9.463,7.315-9.428,8.825c0,0,0.37,14.983,0.406,18.981c-4.105,9.016-18.259,32.71-22.549,34.536 c-1.026-0.621-2.19-0.955-3.401-0.955H6.934C3.091,70.685,0,73.793,0,77.618l0.006,62.533c0.269,3.371,3.133,6.015,6.516,6.015 h40.64c3.604,0,6.534-2.93,6.534-6.534v-2.076c0,0,1.51-0.113,2.196,0.328c2.613,1.659,5.842,3.747,10.054,3.747h60.647 c22.674,0,20.24-20.126,18.169-22.871c3.831-4.171,6.2-11.528,2.966-17.34C150.21,98.789,154.578,91.557,150.669,84.068z M45.766,139.62H6.51V77.212h39.256V139.62z M140.09,83.531l-0.37,1.545c10.448,2.971,4.887,15.013-2.608,15.794l-0.37,1.545 c10.018,2.548,5.239,14.947-2.608,15.794l-0.37,1.539c8.181,1.343,6.2,15.305-6.194,15.305l-61.686,0.024 c-4.356,0-8.324-4.964-11.528-4.964H51.56V82.075c3.485-2.16,7.769-4.964,10.15-6.987c4.499-3.837,22.913-33.593,22.913-37.317 s-0.406-19.834-0.406-19.834s3.61-4.654,11.671-1.259c0,0,6.784,12.721,7.476,22.859c0,0-3.055,20.884-4.696,27.436h42.765 C151.94,66.985,149.935,81.986,140.09,83.531z"/>',
				'dim' => 155.123
			),
			'k06' => array(
				'path' => '<path id="ShareThis" d="M151.804,215.059c0,1.475-0.336,2.856-0.423,4.326l154.111,77.03 c13.194-11.173,30.075-18.146,48.725-18.146c41.925,0.009,75.9,33.985,75.9,75.905c0,41.967-33.976,75.942-75.9,75.942 c-41.961,0-75.9-33.976-75.9-75.942c0-1.512,0.336-2.861,0.42-4.326l-154.111-77.035c-13.234,11.131-30.075,18.104-48.725,18.104 c-41.922,0-75.9-33.938-75.9-75.858c0-41.962,33.979-75.945,75.9-75.945c18.649,0,35.496,7.017,48.725,18.148l154.111-77.035 c-0.084-1.473-0.42-2.858-0.42-4.368c0-41.88,33.939-75.859,75.9-75.859c41.925,0,75.9,33.979,75.9,75.859 c0,41.959-33.976,75.945-75.9,75.945c-18.691,0-35.539-7.017-48.725-18.19l-154.111,77.077 C151.463,212.163,151.804,213.549,151.804,215.059z"/>',
				'dim' => 430.117
			),
			'k07' => array(
				'path' => '<path d="M24.82,48.678c5.422,0,9.832-6.644,9.832-14.811c0-8.165-4.41-14.809-9.832-14.809s-9.833,6.644-9.833,14.809 C14.987,42.034,19.399,48.678,24.82,48.678z"/> <path d="M71.606,48.678c5.422,0,9.833-6.644,9.833-14.811c0-8.165-4.411-14.809-9.833-14.809c-5.421,0-9.831,6.644-9.831,14.809 C61.775,42.034,66.186,48.678,71.606,48.678z"/> <path d="M95.855,55.806c-0.6-0.605-1.516-0.77-2.285-0.4C81.232,61.29,65.125,64.53,48.214,64.53 c-16.907,0-33.015-3.24-45.354-9.123c-0.77-0.367-1.688-0.205-2.284,0.4c-0.599,0.606-0.747,1.526-0.369,2.29 c5.606,11.351,25.349,19.277,48.008,19.277c22.668,0,42.412-7.929,48.012-19.279C96.603,57.332,96.453,56.411,95.855,55.806z"/>',
				'dim' => 96.433
			)
		);
	}

public function wpmchimpa_commentfield( $comment_field ) {
	if(isset($this->wpmchimpa['usyn_com']) && isset($this->wpmchimpa['usyn_comp']) && $this->wpmchimpa['usyn_comp']=='1')
    	return $comment_field.'<label><input type="checkbox" name="wpmchimpa" value="1">'.(isset($this->wpmchimpa['usyn_compt'])?$this->wpmchimpa['usyn_compt']:'Subscribe to Newsletters').'</label>';
    return $comment_field;
}
public function wpmchimpa_commentpost($comment_ID){
	if(isset($this->wpmchimpa['usyn_com']) && isset($this->wpmchimpa['usyn_comp'])){
		if(($this->wpmchimpa['usyn_comp']=='1' && isset ( $_POST['wpmchimpa'] )) || ($this->wpmchimpa['usyn_comp']=='0')){
			if(is_user_logged_in()){
				global $current_user;
	  			get_currentuserinfo();
	  			$_POST['email']=$current_user->user_email;
	  			$_POST['name']=$current_user->user_firstname .' '. $current_user->user_lastname;
			}
			else
				$_POST['name']=$_POST['author'];
			$this->wpmchimpa_add_email(1);
		}
	}
}
public function wpmchimpa_regfield(){
	if(isset($this->wpmchimpa['usyn_reg']) && isset($this->wpmchimpa['usyn_regp']) && $this->wpmchimpa['usyn_regp']=='1')
    	echo '<label><input type="checkbox" name="wpmchimpa" value="1">'.(isset($this->wpmchimpa['usyn_regpt'])?$this->wpmchimpa['usyn_regpt']:'Subscribe to Newsletters').'</label>';
}
public function wpmchimpa_regpost(){
	if(isset($this->wpmchimpa['usyn_reg']) && isset($this->wpmchimpa['usyn_regp'])){
		$current_user = wp_get_current_user();
		$roles = $current_user->roles;
		if(($this->wpmchimpa['usyn_regp']=='1' && isset ( $_POST['wpmchimpa'] )) || ($this->wpmchimpa['usyn_regp']=='0' && in_array($roles[0], $this->wpmchimpa['usync_role']))){
			$_POST['email']=$_POST['user_email'];
			$this->wpmchimpa_add_email(1);
		}
	}
}
public function chshade($i){
if($i == '1')
	return 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAtklEQVQ4y2P4//8/A7Ux1Q0cxoaCADIbCUgCMTvVXAoE5kA8CYidyXYpGrAH4iVAHIXiCwoMDQTimUBcBsRMlBrKCsTpUANzkC0j11BuIK6EGlgKsoAkQ4FgChD7AzELVI8YEDdDDawDYk6YQaQY6gg1oAqILYC4D8oHGcyLbBAphoJAKtQgGO4EYiHk2CLHUJAXm6AG9gCxNHoSIMdQEJCFGqiALaGSayjMxQwUGzq0S6nhZygA2ojsbh6J67kAAAAASUVORK5CYII=)';
else if($i == '2')
	return 'url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAMAAACeyVWkAAAAdVBMVEX////9/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f39/f1HkPUuAAAAJ3RSTlMAAgQFBwkLDRIWGRsdIDc4P0FDT1FaZWdsdXZ5en6Cg4mMjpKUmaT+07zWAAAAUklEQVR42sXINQKAMAADwCDF3d3D/5/ICi0z3Hj4jGdCFe2ZmslZqlmw0+QzajaQWT1b4x5HrsOdOQrcpRzijbONp4rk4kAiJq4+FMEa4oXAXy4RfwSA5WQdGAAAAABJRU5ErkJggg==)';  
}
public function fieldset($f){
	switch ($f['type']) {
		case 'email':
			return '<input type="text" name="email" wpmctype="email" wpmcfield="email" wpmcreq="true" required/>'
			  .'<span class="inputlabel">'.$f['label'].'</span>'
			  .'<span class="inputicon"></span>';

		break;
		case 'text':
		case 'number':
		case 'date':
		case 'birthday':
		case 'zip':
		case 'phone':
		case 'url':
		case 'imageurl':
			return '<input type="text"'
				.' name="merge_fields['.$f['tag'].']"'
				.' wpmctype="'.$f['type'].'"'
				.' wpmcfield="'.$f['tag'].'"'
				.' wpmcreq="'.(((isset($f['req']) && $f['req']) || (isset($f['foreq']) && $f['foreq']))?'true':'false').'" required'
				.(($f['type'] == 'date')? ' wpmcmask="99/99/9999" wpmcmph="'.strtolower($f['opt']['date_format']).'"': '')
				.(($f['type'] == 'birthday')? ' wpmcmask="99/99" wpmcmph="'.strtolower($f['opt']['date_format']).'"': '')
				.(($f['type'] == 'zip')? ' wpmcmask="99999" wpmcmph="_"': '')
				.(($f['type'] == 'phone' && $f['opt']['phone_format'] == 'US')? ' wpmcmask="999-999-9999" wpmcmph="_"': '')
				.'/>'
				.'<span class="inputlabel">'.$f['label'].'</span>'
				.'<span class="inputicon"></span>';
		break;

		case 'checkboxes':
			$t = '';
			foreach ($f['groups'] as $v) {
				$t.= '<label class="wpmchimpa-item">'
					.'<input type="checkbox"'
					.' name="group['.$v['id'].']"'
					.' wpmcfield="'.$f['id'].'"'
					.' value="'.$v['id'].'" wpmctype="'.$f['type'].'"'
					.' wpmcreq="'.(((isset($f['req']) && $f['req']) || (isset($f['foreq']) && $f['foreq']))?'true':'false').'"'
					.'>'
					.'<span>'.$v['gname'].'</span>'
			    .'</label>';
			}
			return '<div class="wpmchimpa-itemh">'.$f['label'].'</div>'
				.'<div class="wpmchimpa-itemb">'
				.$t
				.'</div>';
		break;

		case 'radio':
			$t = '';
			if($f['cat'] == 'group'){
				foreach ($f['groups'] as $v) {
					$t.= '<label class="wpmchimpa-item">'
						.'<input type="radio"'
						.' name="group['.$f['id'].']"'
						.' value="'.$v['id'].'"'
						.' wpmctype="'.$f['type'].'"'
						.' wpmcfield="'.$f['id'].'"'
						.' wpmcreq="'.(((isset($f['req']) && $f['req']) || (isset($f['foreq']) && $f['foreq']))?'true':'false').'"'
						.'>'
						.'<span>'.$v['gname'].'</span>'
				    .'</label>';
				}
			}
			else if($f['cat'] == 'field'){
				foreach ($f['opt']['choices'] as $v) {
					$t.= '<label class="wpmchimpa-item">'
					.'<input type="radio"'
					.' name="merge_fields['.$f['tag'].']"'
					.' value="'.$v.'"'
					.' wpmctype="'.$f['type'].'"'
					.' wpmcfield="'.$f['tag'].'"'
					.' wpmcreq="'.(((isset($f['req']) && $f['req']) || (isset($f['foreq']) && $f['foreq']))?'true':'false').'"'
					.'>'
					.'<span>'.$v.'</span>'
				    .'</label>';
				}
			}

			return '<div class="wpmchimpa-itemh">'.$f['label'].'</div>'
				.'<div class="wpmchimpa-itemb">'
				.$t
				.'</div>';
		break;

		case 'dropdown':
			$t = '<option value="">'.$f['label'].'</option>';
			if($f['cat'] == 'group'){
				foreach ($f['groups'] as $v) {
					$t.= '<option value="'.$v['id'].'">'.$v['gname'].'</option>';
				}
			}
			else if($f['cat'] == 'field'){
				foreach ($f['opt']['choices'] as $v) {
					$t.= '<option value="'.$v.'">'.$v.'</option>';
				}
			}

			return '<select'
				.' name="'.(($f['cat'] == 'group')? 'group['.$f['id'].']' : 'merge_fields['.$f['tag'].']').'"'
				.' wpmctype="'.$f['type'].'"'
				.' wpmcfield="'.(isset($f['tag'])?$f['tag']:$f['id']).'"'
				.' wpmcreq="'.(((isset($f['req']) && $f['req']) || (isset($f['foreq']) && $f['foreq']))?'true':'false').'"'
				.'>'
				.$t
				.'</select>';
		break;

	}

}
public function stfield($fields,$set){
	if(!$fields)return false;
	foreach ($fields as $f) {
		switch ($f['type']) {
			case 'email':
				if($set['type']==1)
					echo '<div class="wpmchimpa-field wpmchimpa-text'.(($f['icon']!='inone' && ($set['icon'] || (!$set['icon'] && $f['icon']!='idef')))?' wpmc-ficon':'').'">'
					  .$this->fieldset($f)
					  .'<div class="wpmcinfierr" wpmcerr="email"></div>'
					.'</div>';
				else if ($set['type']==2){
					echo'<div class="formbox wpmchimpa-field'.(($f['icon']!='inone' && ($set['icon'] || (!$set['icon'] && $f['icon']!='idef')))?' wpmc-ficon':'').'">'
						.'<div class="wpmchimpa-text">'
							.$this->fieldset($f)
							.'<div class="wpmcinfierr" wpmcerr="email"></div>'
						.'</div>'
						.'<div><div class="wpmchimpa-subs-button'.($set['bui'] ? ' subsicon':'').'"></div><div class="wpmchimpa-signal"><div class="sp8"><div class="sp81"></div><div class="sp82"></div><div class="sp83"></div><div class="sp84"></div><div class="sp85"></div></div></div>'
						.'</div><div style="clear:both"></div></div>';
				}
				break;
			
			case 'text':
			case 'number':
			case 'date':
			case 'birthday':
			case 'zip':
			case 'phone':
			case 'url':
			case 'imageurl':
				echo '<div class="wpmchimpa-field wpmchimpa-text'.((($f['icon']!='idef' & $f['icon']!='inone') || ($set['icon'] && $f['icon']=='idef' && ($f['tag']=='FNAME' || $f['tag']=='LNAME')))?' wpmc-ficon':'').'">'
				  .$this->fieldset($f)
				  .'<div class="wpmcinfierr" wpmcerr="'.$f['tag'].'"></div>'
				.'</div>';
				break;
			case 'checkboxes':
				echo '<div class="wpmchimpa-field wpmchimpa-check">'
					.$this->fieldset($f)
				  .'<div class="wpmcinfierr" wpmcerr="'.(isset($f['tag'])?$f['tag']:$f['id']).'"></div>'
				.'</div>';

				break;
			case 'radio':
				echo '<div class="wpmchimpa-field wpmchimpa-radio">'
					.$this->fieldset($f)
				  .'<div class="wpmcinfierr" wpmcerr="'.(isset($f['tag'])?$f['tag']:$f['id']).'"></div>'
				.'</div>';
				break;
			case 'dropdown':
				echo '<div class="wpmchimpa-field wpmchimpa-drop">'
					.$this->fieldset($f)
				  .'<div class="wpmcinfierr" wpmcerr="'.(isset($f['tag'])?$f['tag']:$f['id']).'"></div>'
				.'</div>';
				break;
		}
	};
}
public function getformbyid($id){
	if(!isset($this->wpmchimpa['cforms']) || empty($this->wpmchimpa['cforms']))return null;
	foreach ($this->wpmchimpa['cforms'] as $k => $v) {
		if($v['id'] == $id)
			return $v;
	}
	return $this->wpmchimpa['cforms'][0];
}

}

