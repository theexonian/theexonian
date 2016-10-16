<?php
// This registers the ability to have options for your plugin. 
// The options will be stored in rg_settings.
// You can also get these options using... $rcc_options = get_option('rcc_settings');
function rcc_register_settings() {
	register_setting('rcc_settings_group', 'rcc_settings', 'rcc_validation');
}
add_action('admin_init', 'rcc_register_settings');

function rcc_validation( $input ) {

    // Create our array for storing the validated options
    $output = array();
	global $defaults;

    foreach( $input as $key => $value ) {

      // Check to see if the current option has a value. If so, process it.
      if ( isset( $input[$key] ) ) {
		
		if ( $input[$key] === "" || empty($input[$key]) ) {
			$output[$key] = $defaults[$key];
		} else {
			$output[$key] = $input[$key];
		}

      } // end if
    } // end foreach
  
  // Return the array processing any additional functions filtered by this action
  return apply_filters( 'rcc_validation', $output, $input );
}
?>