<?php
/**
 * The Header of the theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Donna
 */
$donna_theme_options = donna_get_options( 'donna_theme_options' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="grid-container">
	<div id="grid-container-inner">
		<div class="clear"></div>
		<header id="header" class="full-header">
			<div id="header-wrap">
				<div class="container clearfix">
					<div id="logo">
						<?php if (function_exists( 'has_custom_logo' ) && has_custom_logo()) {
							donna_the_custom_logo();
						} else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ) ?>"><?php bloginfo( 'name' ); ?></a>
				<?php	} ?>
						<?php if ($donna_theme_options['enable_logo_tagline'] == true ) { ?> 
							<h5 class="site-description"><?php bloginfo('description'); ?></h5>
						<?php } ?>
					</div><!-- logo -->
					<nav id="primary-menu" class="navbar navbar-default">
	        			<div class="navbar-header">
	            			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	              			<span class="sr-only"><?php esc_html_e('Toggle navigation','donna');?></span>
	              			<span class="icon-bar"></span>
	              			<span class="icon-bar"></span>
	              			<span class="icon-bar"></span>
	            			</button>
	          			</div><!--navbar-header-->
	          			<div id="navbar" class="navbar-collapse collapse">
						<?php if (has_nav_menu('main_navigation')) {
							
							$donna_default_menu = array(
	    						'theme_location'  => 'main_navigation',
								'menu'       => 'main_navigation',
	    						'depth'      => 0,
	    						'container'  => false,
	    						'menu_class' => 'nav navbar-nav',
	                			'fallback_cb'       => 'wp_page_menu',
	    						'walker'     => new wp_bootstrap_navwalker(),
							);
						
						} else {
							
							$donna_default_menu = array(
	    						'theme_location'  => 'main_navigation',
								'menu'       => 'main_navigation',
	    						'depth'      => 0,
	    						'container'  => false,
	    						'menu_class' => 'nav-bar',
	                			'fallback_cb'       => 'wp_page_menu',
							);
							
						} 
						
						wp_nav_menu( $donna_default_menu );
						
						?>
	          			</div><!-- #navbar -->
					</nav><!-- #primary-menu -->
				</div>
			</div>
		</header><!-- #header end -->
	