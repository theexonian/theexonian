<?php
// If uninstall not called from WordPress then exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit();
}
// Otherwise delete options from table
$option_name = 'rcc_settings';
delete_option( $option_name );
?>