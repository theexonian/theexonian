<?php

$menuArguments = array(
	'theme_location' => 'header',
	'items_wrap' => '%3$s',
	'container' => false,
	'menu_class' => 'nav',
	'depth' => 0,
	'walker' => new BootstrapNavMenuWalker()
);

$currentTime = strtotime(current_time('mysql'));

$pbjColorizeDark = (ot_get_option('colorize_dark','')) ? ot_get_option('colorize_dark','') : "#874389";
$pbjColorizeLight = (ot_get_option('colorize_light','')) ? ot_get_option('colorize_light','') : "#DB70CE";

?>
<!DOCTYPE html>
<html lang="en">

<!--
 _______  ______       _____
|_   __ \|_   _ \     |_   _|    Project for Better Journalism, Inc.
  | |__) | | |_) |      | |      http://betterjournalism.org
  |  ___/  |  __'.  _   | |
 _| |_    _| |__) || |__' |      This is STALLION.
|_____|  |_______/ `.____.'

-->

<head prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article#">
<meta charset="utf-8">

<?php if (is_front_page()) : ?>
<title><?php echo bloginfo("name"); ?></title>
<?php else : ?>
<title><?php echo wp_title(""); ?> &raquo; <?php echo bloginfo("name"); ?></title>
<?php endif; ?>

<!-- Prerequisites: Bootstrap and jQuery -->
<link href="<?php bloginfo('stylesheet_directory'); ?>/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/resources/bootstrap/js/bootstrap.min.js"></script>

<!-- Stallion -->
<link href="<?php bloginfo('stylesheet_directory'); ?>/resources/styling.css?stallion-4.2.1" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/resources/scripts.js?stallion-4.2.1"></script>

<!-- Stallion custom colors -->
<style>
.pbj-banner,
.header-nav-ul,
.lowerexpo-nophoto .lowerexpo-link,
.exposition-vertical-mainelement h2,
.exposition-mainelement-nophoto h2 a span
{ background-color: <?php echo $pbjColorizeDark; ?>; }

body,
.archives-header
{ border-top-color: <?php echo $pbjColorizeDark; ?>; }

.category-ticker h3 a,
.schooldesc-about h3,
.article-text h3
{ color: <?php echo $pbjColorizeDark; ?>; }

.archives-header,
.article-archive-pagination-inner a.btn:hover,
.footer-box
{ background-color: <?php echo $pbjColorizeLight; ?>; }

.article-sidebar-highlights h3
{ color: <?php echo $pbjColorizeLight; ?>; }
</style>

<!-- WordPress -->
<?php wp_head(); ?>

<!-- Social/search tags: ---->
<?php include(TEMPLATEPATH . "/socialsearch-tags.php"); ?>

</head>

<body <?php echo (ot_get_option('bg_file','')) ? 'style="background-image:url(' . ot_get_option('bg_file','') . ')"' : ""; ?> <?php body_class(); ?>>
	<div class="header-bar">
		<div class="container"><div class="row">
			<div class="span7">
				<div class="header-logo" <?php echo (ot_get_option('logo_file','')) ? 'style="background-image:url(' . ot_get_option('logo_file','') . ')"' : ""; ?>><a href="<?php echo home_url('/'); ?>"><?php echo bloginfo("name"); ?></a></div>
			</div>
			<div class="span5">
<?php if (ot_get_option('pbj_disable_full','') != "disable" && ot_get_option('pbj_link','')) : ?>
				<div class="pbj-banner"><a href="<?php echo ot_get_option('pbj_link',''); ?>"></a></div>
<?php endif; ?>
<?php if (is_front_page() && ot_get_option('bg_file','')) : ?>
				<div class="header-explainer">
					<p><b>Background</b> <?php echo ot_get_option('bg_desc',''); ?> <?php if(ot_get_option('bg_link','')) { ?><a href="<?php echo ot_get_option('bg_link',''); ?>">More &raquo;</a><?php } ?></p>
				</div>
<?php endif; ?>
			</div>
		</div></div>
	</div>
	<div class="header-nav">
		<div class="container"><div class="row">
			<div class="span12">
				<ul class="header-nav-ul nav">
					<?php wp_nav_menu($menuArguments); ?>
					<li class="header-nav-searchform">
						<form role="search" method="get" class="header-nav-searchform-form" action="<?php echo home_url('/'); ?>">
        					<input type="text" value="<?php the_search_query(); ?>" name="s" placeholder="Search&hellip;" />
        				</form>
					</li>
					<!-- <li class="timekeeper"><?php echo date('g:ia',$currentTime); ?></li> -->
				</ul>
			</div>
		</div></div>
	</div>

<?php if( ot_get_option('breaking_activate',false) == 'true' ) { ?>
	<div class="expo-breaking-box">
		<div class="container"><div class="row"><div class="span12">
			<div class="expo-breaking">
				<b></b> <?php echo ot_get_option('breaking_text',''); ?>
<?php if( ot_get_option('breaking_link_enable',false) == 'true' ) { ?>
				<a href="<?php echo ot_get_option('breaking_link_href',''); ?>">
					<?php echo ot_get_option('breaking_link',''); ?> &raquo;
				</a>
<?php } ?>
			</div>
		</div></div></div>
	</div>
<?php }

if (defined('WP_INSTALLING') && WP_INSTALLING) :
?>
<div class="article">
	<div class="container">
		<div class="row"><div class="span12">
			<div class="article-whitebg" style="padding:80px 0">
				<div class="row"><div class="span10 offset1">
<?php
endif;
