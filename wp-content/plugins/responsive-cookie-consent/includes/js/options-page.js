jQuery( document ).ready(function(){

    "use strict";
    // This if statement checks if the color picker widget exists within jQuery UI
    // If it does exist then we initialize the WordPress color picker on our text input field

	jQuery('.color-picker').each(function(){
		
		if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){
			 jQuery(this).children('.color').wpColorPicker();
		}
		else {
			// We use farbtastic if the WordPress color picker doesn't exist
			jQuery(this).children( '#colorpicker' ).farbtastic( '.color' );
		}
		
	});
	
});