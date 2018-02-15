jQuery(document).ready(function($) { 
    'use strict';

    var $document = $(document);
    var $window = $(window);


    /**
    * Document ready (jQuery)
    */
    $(function () {

        /**
         * Activate superfish menu.
         */
        $('.sf-menu').superfish({
            'speed': 'fast',
            'delay' : 0,
            'animation': {
                'height': 'show'
            }
        });

    });

        /**
         * SlickNav
         */

	$('#menu-main-slick').slicknav({
		prependTo:'.navbar-header',
		label: oncanvasStrings.slicknav_menu_home,
		allowParentLinks: true
	});

    function oncanvas_mobileadjust() {
        
        var windowWidth = $(window).width();

        if( typeof window.orientation === 'undefined' ) {
            $('#menu-main-menu').removeAttr('style');
         }

        if( windowWidth < 769 ) {
            $('#menu-main-menu').addClass('mobile-menu');
         }
 
    }
    
    oncanvas_mobileadjust();

    $(window).resize(function() {
        oncanvas_mobileadjust();
    });

});