(function(jQuery) {
    'use strict';
    jQuery(document).ready(function($) {

   
	/* ============== masonry Grid ============= */
	if( $(".masonry_grid").length){
		$('.masonry_grid').masonry({
		  // set itemSelector so .grid-sizer is not used in layout
		  itemSelector: '.grid-item',
		  // use element for option
		  columnWidth: '.grid-sizer',
		  percentPosition: true
		});
	}
	if( $("#popup-search").length){
		$('#popup-search').on('click', function(e) {
			e.preventDefault();
			$('.popup-search').fadeIn();
		});
	}
	if( $(".close-popup").length){
		$('.close-popup').on('click', function(e) {
			e.preventDefault();
			$('.popup-search').hide();
		});
	}
	
	
	
	if( $("#nav-expander").length){
		$('#nav-expander').on('click', function(e) {
			e.preventDefault();
			$('body').toggleClass('nav-expanded');
		});
	}
	if( $("#nav-close").length){
		$('#nav-close').on('click', function(e) {
			e.preventDefault();
			$('body').removeClass('nav-expanded');
		});
	}
	if( $('.newsbd24_news_ticker_js_action').length ){
		$('.newsbd24_news_ticker_js_action').newsTicker({
			row_height: 30,
			max_rows: 1,
			speed: 600,
			direction: 'up',
			duration: 4000,
			autostart: 1,
			pauseOnHover: 1
		});
	}
	if( $('.image-popup').length ){
	 $('.image-popup').magnificPopup({
        closeBtnInside : true,
        type           : 'image',
        mainClass      : 'mfp-with-zoom'
    });
	}

	if( $('#back-to-top').length ){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
      } 
     
		
		
	$(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

 


 });
})(jQuery);