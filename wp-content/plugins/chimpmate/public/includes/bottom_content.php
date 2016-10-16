<?php 
$wpmchimpa = $this->wpmchimpa;
$form = $this->getformbyid($wpmchimpa['addon_form']);
include( 'addon'.$wpmchimpa['addon_theme'].'.php' );
?>