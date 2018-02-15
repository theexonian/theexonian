/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {
	var style = $( '#almia-color-scheme-css' ),
		api = wp.customize;

	if ( ! style.length ) {
		style = $( 'head' ).append( '<style type="text/css" id="almia-color-scheme-css" />' )
		                    .find( '#almia-color-scheme-css' );
	}

	// Site title.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site tagline.
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Display site title
	/*api( 'display_header_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).toggleClass( 'screen-reader-text', ! to );
		} );
	} );*/

	// Display site description
	/*api( 'display_header_description', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).toggleClass( 'screen-reader-text', ! to );
		} );
	} );*/

	// Footer credit.
	api( 'footer_credit', function( value ) {
		value.bind( function( to ) {
			$( '.site-info' ).text( to );
		} );
	} );

	// Add custom-background-image body class when background image is added.
	api( 'background_image', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).toggleClass( 'custom-background-image', '' !== to );
		} );
	} );

	// Color Scheme CSS.
	api.bind( 'preview-ready', function() {
		api.preview.bind( 'update-color-scheme-css', function( css ) {
			style.html( css );
		} );
	} );
} )( jQuery );
