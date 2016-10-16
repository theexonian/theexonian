<?php
// add_submenu_page('parent slug', 'page title', 'menu title', 'capabilty', 'slug url', 'output funtion');
function rcc_add_options_menu() {
	add_submenu_page('options-general.php', __('RCC Settings', 'responsive-cookie-consent'), 'RCC', 'manage_options', 'rcc-settings', 'rcc_options_page');
}
add_action('admin_menu', 'rcc_add_options_menu');
?>