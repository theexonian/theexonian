<?php 
$wpmchimpa = $this->wpmchimpa;
$form = $this->getformbyid($wpmchimpa['topbar_form']);
$fields = array();
foreach ($form['fields'] as $v) {
  if((isset($wpmchimpa['topbar_field']) && $wpmchimpa['topbar_field'] == $v['uid']) || ($v['tag']=='email'))
    array_push($fields, $v);
}
include( 'topbar'.$wpmchimpa['addon_theme'].'.php' );
?>