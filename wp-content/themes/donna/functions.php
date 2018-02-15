<?php
/**
 * Donna functions and definitions
 *
 * @package Donna
*/

// Use a child theme instead of placing custom functions here
// http://codex.wordpress.org/Child_Themes

/* ------------------------------------------------------------------------- *
 *  Load theme files
/* ------------------------------------------------------------------------- */	
require_once trailingslashit(get_template_directory()) .'functions/donna-functions.php'; 			// Theme Custom Functions
require_once trailingslashit(get_template_directory()) .'functions/donna-customizer.php';			// Load Customizer
require_once trailingslashit(get_template_directory()) .'functions/wp_bootstrap_navwalker.php';