var scrollup=jQuery.noConflict();
scrollup(document).ready(function() {
	scrollup(document).ready(function(){ 
			
		scrollup(window).scroll(function(){
			
			if (scrollup(this).scrollTop() > 100) {
				scrollup('.back-to-top').fadeIn();
				scrollup('.back-to-top').css({
					"display": "flex"
				});
			} else {
				scrollup('.back-to-top').fadeOut();
			}
		}); 
			
		scrollup('.back-to-top').click(function(){
			scrollup("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		});
 
	});
});