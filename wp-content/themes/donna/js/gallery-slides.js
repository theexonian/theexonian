var gallery=jQuery.noConflict();
gallery(document).ready(function() {
	gallery("#owl-wrap").owlCarousel({
		autoHeight:true,
        singleItem: true,
        loop:true,
		nav: true,
        dots: false,
        items: 1,
		margin:30,
		autoplay: true,
		autoplayTimeout:5000,
		autoplayHoverPause:true,
		navText: ["<i class='ion-ios-arrow-left'></i>", "<i class='ion-ios-arrow-right'></i>"],
		itemsScaleUp: true,
	});
});