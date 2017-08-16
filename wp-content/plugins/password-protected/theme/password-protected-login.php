<?php

/**
 * Based roughly on wp-login.php @revision 19414
 * http://core.trac.wordpress.org/browser/trunk/wp-login.php?rev=19414
 */

global $wp_version, $Password_Protected, $error, $is_iphone;

/**
 * WP Shake JS
 */
if ( ! function_exists( 'wp_shake_js' ) ) {
	function wp_shake_js() {
		global $is_iphone;
		if ( $is_iphone ) {
			return;
		}
		?>
		<script type="text/javascript">
		addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
		function s(id,pos){g(id).left=pos+'px';}
		function g(id){return document.getElementById(id).style;}
		function shake(id,a,d){c=a.shift();s(id,c);if(a.length>0){setTimeout(function(){shake(id,a,d);},d);}else{try{g(id).position='static';wp_attempt_focus();}catch(e){}}}
		addLoadEvent(function(){ var p=new Array(15,30,15,0,-15,-30,-15,0);p=p.concat(p.concat(p));var i=document.forms[0].id;g(i).position='relative';shake(i,p,20);});
		</script>

		<?php
	}
}

nocache_headers();
header( 'Content-Type: ' . get_bloginfo( 'html_type' ) . '; charset=' . get_bloginfo( 'charset' ) );

// Set a cookie now to see if they are supported by the browser.
setcookie( TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN );
if ( SITECOOKIEPATH != COOKIEPATH ) {
	setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN );
}

// If cookies are disabled we can't log in even with a valid password.
if ( isset( $_POST['testcookie'] ) && empty( $_COOKIE[ TEST_COOKIE ] ) ) {
	$Password_Protected->errors->add( 'test_cookie', __( "<strong>ERROR</strong>: Cookies are blocked or not supported by your browser. You must <a href='http://www.google.com/cookies.html'>enable cookies</a> to use WordPress.", 'password-protected' ) );
}

// Shake it!
$shake_error_codes = array( 'empty_password', 'incorrect_password' );
if ( $Password_Protected->errors->get_error_code() && in_array( $Password_Protected->errors->get_error_code(), $shake_error_codes ) ) {
	add_action( 'password_protected_login_head', 'wp_shake_js', 12 );
}

// Obey privacy setting
add_action( 'password_protected_login_head', 'noindex' );

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php echo apply_filters( 'password_protected_wp_title', get_bloginfo( 'name' ) ); ?></title>

<?php

if ( version_compare( $wp_version, '3.9-dev', '>=' ) ) {
	wp_admin_css( 'login', true );
} else {
	wp_admin_css( 'wp-admin', true );
	wp_admin_css( 'colors-fresh', true );
}

?>

<style type="text/css" media="screen">
#login_error, .login .message, #loginform { margin-bottom: 20px; }
</style>

<?php

if ( $is_iphone ) {
	?>
	<meta name="viewport" content="width=320; initial-scale=0.9; maximum-scale=1.0; user-scalable=0;" />
	<style type="text/css" media="screen">
	.login form, .login .message, #login_error { margin-left: 0px; }
	.login #nav, .login #backtoblog { margin-left: 8px; }
	.login h1 a { width: auto; }
	#login { padding: 20px 0; }
	</style>
	<?php
}

do_action( 'login_enqueue_scripts' );
do_action( 'password_protected_login_head' );

?>

</head>
<body class="login login-password-protected login-action-password-protected-login wp-core-ui">

<div id="login" style = "width: 500px">
	<h1><a href="<?php echo esc_url( apply_filters( 'password_protected_login_headerurl', home_url( '/' ) ) ); ?>" title="<?php echo esc_attr( apply_filters( 'password_protected_login_headertitle', get_bloginfo( 'name' ) ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

	<?php do_action( 'password_protected_login_messages' ); ?>
	<?php do_action( 'password_protected_before_login_form' ); ?>

	<form name="loginform" id="loginform" action="<?php echo esc_url( $Password_Protected->login_url() ); ?>" method="post">
    <h1>This will only take a moment…</h1>
    <br>
    <p style = "font-size: 16px; margin-top: 8px;">Due to administrative concerns about student safety and viewer accountability, you will now need to enter your email and a password to view <I>The Exonian Online</I>. We sincerely apologize for this inconvenience. However, we are allowed to share the password with you:</p>
    <p style = "font-size: 16px; margin-bottom: 12px; margin-top: 14px; text-align: center; ">It is currently "<a onclick = "autoFill()">FreePress</a>"</p>

<div align="center">—————————</div>
<br>
<p>By submitting your credentials, you agree to the terms of our Media & Content Use Policy, summarized here:</p>
<Dl><br>&#8226; Any use of media/content from <I>The Exonian</I>, outside of personal consumption, requires permission from the publication.
<br>&#8226; The intent of this policy is to limit misrepresentation or undue scrutiny of the staff and subjects of our high school newspaper.
<br>&#8226; Permission is requested via the <a href="http://content.theexonian.com">Media & Content Use Request Form</a>.
<br>&#8226; The views and opinions expressed in <I>The Exonian</I> are solely those of the original authors, and do not necessarily represent those of PEA, its administrators, or Trustees.</Dl>
<br><p>These additions are not intended to stifle expression; <I>The Exonian</I> still seeks to maintain its status as the uncensored, free and open student press, and we are working together with the school administration in these goals. The full <a href="https://theexonian.com/about/privacy-policy/">Media & Content Use Policy</a> is available online.</p>
<br>
    <p>
      <label for="email-logger">Email</label><br />
			<input type="email"  id="email-logger" class="input" value="bob@exeter.edu" size="20" tabindex="20" required/></label>

      <label for="password_protected_pass"><?php _e( 'Password', 'password-protected' ) ?> <span style = "float: right; "><small>Hint: "<a onclick = "autoFill()">FreePress</a>"</small></span>
			<input type="password" name="password_protected_pwd" id="password_protected_pass" class="input" value="FreePress" size="20" tabindex="20" /></label>
		</p>
		<!--
		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90"<?php checked( ! empty( $_POST['rememberme'] ) ); ?> /> <?php esc_attr_e( 'Remember Me', 'password-protected' ); ?></label></p>
		-->
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Log in', 'password-protected' ); ?>" tabindex="100" />
			<input type="hidden" name="testcookie" value="1" />
			<input type="hidden" name="password-protected" value="login" />
			<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $_REQUEST['redirect_to'] ); ?>" />
		</p>


	
	</form>
	

	<?php do_action( 'password_protected_after_login_form' ); ?>

</div>
<script src="https://cdn.firebase.com/js/client/2.4.2/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>

<script type="text/javascript">
try{document.getElementById('email-logger').focus();}catch(e){}
if(typeof wpOnload=='function')wpOnload();
</script>
<script>
  function autoFill(){
    $("#password_protected_pass").val("FreePress");
  }

  var ref = new Firebase("https://theexonian.firebaseio.com/");

  $("#loginform").submit(function(){
		if($("#loginform").valid()){
			if(  $("#password_protected_pass").val() == "FreePress"){
	        ref.push({
	          	password:   $("#password_protected_pass").val(),
	          	email:  $("#email-logger").val()
	          }
	        );
		return true;
	    }else{	
			<small>Wrong Password</small></span>
			return false;
			}
		}
		else{
			return false;
		}


  })
</script>

<?php do_action( 'login_footer' ); ?>

<div class="clear"></div>

</body>
</html>
