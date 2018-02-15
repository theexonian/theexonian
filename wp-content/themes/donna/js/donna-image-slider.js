var owl=jQuery.noConflict();
owl(document).ready(function() {
	owl("#owl-wrap").owlCarousel({
		autoHeight:true,
        singleItem: true,
        loop:true,
		nav: true,
        dots: false,
        items: 1,
		margin:30,
		autoplay: true,
		autoplayTimeout:10000,
		autoplayHoverPause:true,
		navText: ["<i class='ion-ios-arrow-left'></i>", "<i class='ion-ios-arrow-right'></i>"],
		itemsScaleUp: true,
	});
});