/* Function which change style of ordinary select */
function reselect( select, addclass ) {
	(function ( $ ) {
		addclass       = typeof( addclass ) != 'undefined' ? addclass : '';
		$( select ).css( "display", "none" );
		$( select ).wrap( '<div class="select_wrap"' + addclass + '"/>' );
		var sel_option = '';
		$( select ).each( function () {
			if ( ( $( this ).children( 'optgroup' ).attr( 'label' ) ) != undefined ) {
				/* For select which contains option group */
				var sel_list = '';
				$( this ).children( 'optgroup' ).each( function () {
					var optgroup = '';
					$( this ).children( 'option' ).each( function () {
						optgroup = optgroup + '<div class="option" id="' + $( this ).attr( 'value' ) + '">' + $( this ).html() + '</div>';
					} );
					sel_list     = sel_list + '<div class="optgroup"><span>' + $( this ).attr( 'label' ) + '</span>' + optgroup + '</div>';
				} );
				sel_option   = $( this ).children( 'optgroup' ).children( 'option:selected' ).text();
			}
			else {
				/* For select without option group */
				var sel_list = '';
				$( this ).children( 'option' ).each( function () {
					if ( $( this ).parent( 'select' ).attr( 'id' ) == 'cat' ) {
						/* Selects for category dropdown menu */
						sel_list = sel_list + '<a href="' + $( '#smplclssc_site-title' ).children( 'a' ).attr( 'href' ) + '/?cat=' + $( this ).attr( 'value' ) + '"><div class="option" id="' + $( this ).attr( 'value' ) + '">' + $( this ).html() + '</div></a>';
					} else {
						if ( ( $( this ).parent( 'select' ) ).attr( 'name' ) == 'archive-dropdown' ) {
							/* Selects for archive dropdown menu */
							sel_list = sel_list + '<a href="' + $( this ).attr( 'value' ) + '"><div class="option" id="' + $( this ).attr( 'value' ) + '">' + $( this ).html() + '</div></a>';
						} else if ( ( $( this ).parent( 'select' ) ).attr( 'name' ) == 'mltlngg_change_display_lang' ) {
							/* Selects for multilanguage switcher dropdown menu */
							sel_list = sel_list + '<a href="' + $( this ).attr( 'value' ) + '"><div class="option" id="' + $( this ).attr( 'value' ) + '">' + $( this ).html() + '</div></a>';
						} else {
							/* Ordinary selects */
							sel_list = sel_list + '<div class="option" id="' + $( this ).attr( 'value' ) + '">' + $( this ).html() + '</div>';
						}
					}
				} );
				sel_option   = $( this ).children( 'option:selected' ).text();
			}
			var sel = '<div class="select" id="' + $( select ).attr( 'id' ) + '">' +
					'<div class="select_head">' +
					'<div class="selected_option">' + sel_option + '</div>' +
					'</div>' +
					'<div class="sel_list">' + sel_list + '</div>' +
					'</div>';
			$( this ).before( sel );
		} );
	})( jQuery );
}
/* End of reselect */

/* Function style for input [type="file"] */
function styleforinputfile( input ) {
	(function ( $ ) {
		$( ':file' ).wrap( '<div class="wrapfile" />' );
		$( '.wrapfile' ).wrap( '<div id="file-upload" />' );
		if ( !(($.browser.msie) && ($.browser.version <= '9.0')) ) {
			$( '.wrapfile input[type="file"]' ).css( {
				"opacity":   "0",
				"font-size": "34px",
				"float":     "left",
				"padding":   "0px",
				"border":    "none",
				"cursor":    "pointer",
				"width":     "440px"
			} );
		}
		else {
			$( '.wrapfile input[type="file"]' ).css( {
				"opacity":   "0",
				"font-size": "34px",
				"float":     "left",
				"padding":   "0px",
				"border":    "none",
				"cursor":    "pointer",
				"width":     "225px"
			} );
		}
		$( ':file' ).before( '<label id="choose_file">' + stringJs.chooseFile + '</label>\
							<label id="file_statys">' + stringJs.fileNotSel + '</label>' );
	})( jQuery );
}

/* Function which change ordinary radiobuttons and checkboxes */
function radiocheckchange( input ) {
	(function ( $ ) {
		if ( !(($.browser.msie) && ($.browser.version < '9.0')) ) {
			$( ':radio' ).wrap( '<label class="switch" />' );
			$( ':radio' ).after( '<span class="switch" />' );
			$( ':radio' ).css( { "display": "none" } );
			$( ':checkbox' ).wrap( '<label class="switch" />' );
			$( ':checkbox' ).after( '<span class="switch" />' );
			$( ':checkbox' ).css( { "display": "none" } );
		}
	})( jQuery );
}
(function ( $ ) {
	$( document ).ready( function () {
		/* Event handler for reselect - event click select */
		$( '.select' ).live( 'click', function () {

			$( '.select' ).removeClass( 'act' );
			$( this ).addClass( 'act' );
			if ( $( this ).children( '.sel_list' ).is( ':visible' ) ) {
				$( '.sel_list' ).hide();
			}
			else {

				$( '.sel_list' ).hide();
				$( this ).children( '.sel_list' ).show();
			}
		} );
		/* Event handler for reselect - event click option */
		$( '.option' ).live( 'click', function () {
			/* For select which contains option group */
			if ( $( this ).parent( '.optgroup' ).attr( 'class' ) !== undefined ) {
				/* Change id to selected */
				var selectOptionText = $( this ).html();
				$( this ).parent( '.optgroup' ).parent( '.sel_list' ).parent( '.select' ).children( '.select_head' ).children( '.selected_option' ).html( selectOptionText );
				/* Activate current */
				$( this ).parent( '.sel_list' ).children( '.optgroup' ).children( '.option' ).removeClass( 'sel_ed' );
				$( this ).addClass( 'sel_ed' );
				/* Set the id for select */
				var selectId = $( this ).attr( 'id' );
				selectId     = typeof( selectId ) != 'undefined' ? selectId : selectOptionText;
				$( this ).parent( '.optgroup' ).parent( '.sel_list' ).parent( '.select' ).parent( '.select_wrap' ).children( 'select' ).children( 'optgroup' ).children( 'option' ).removeAttr( 'selected' ).each( function () {
					if ( $( this ).val() == selectId ) {
						$( this ).attr( 'selected', 'select' );
					}
				} );
			}
			else { /* For select without option group*/
				/* Change id to selected */
				var selectOptionText = $( this ).html();
				$( this ).parent( '.sel_list' ).parent( '.select' ).children( '.select_head' ).children( '.selected_option' ).html( selectOptionText );
				/* Activate current*/
				$( this ).parent( '.sel_list' ).children( '.option' ).removeClass( 'sel_ed' );
				$( this ).addClass( 'sel_ed' );
				/* Set the id for select */
				var selectId = $( this ).attr( 'id' );
				selectId     = typeof( selectId ) != 'undefined' ? selectId : selectOptionText;
				$( this ).parent( '.sel_list' ).parent( '.select' ).parent( '.select_wrap' ).children( 'select' ).children( 'option' ).removeAttr( 'selected' ).each( function () {
					if ( $( this ).val() == selectId ) {
						$( this ).attr( 'selected', 'select' );
					}
				} );
			}
		} );
		/* Event handler for mouse events */
		var selectMouseAction = false;
		$( '.select' ).live( 'mouseenter', function () {
			selectMouseAction = true;
		} );
		$( '.select' ).live( 'mouseleave', function () {
			selectMouseAction = false;
		} );
		$( document ).click( function () {
			if ( !selectMouseAction ) {
				$( '.sel_list' ).hide();
				$( '.select' ).removeClass( 'act' );
			}
		} );
		/* Event handler for styleforinputfile - event change option */
		$( ':file' ).live( 'change', function () {
			$( '#choose_file' ).text( $( ':file' ).val() );
			$( '#file_statys' ).text( '' );
		} );
		reselect( "select" );
		radiocheckchange();
		styleforinputfile( ':file' );
	} );
})( jQuery );
