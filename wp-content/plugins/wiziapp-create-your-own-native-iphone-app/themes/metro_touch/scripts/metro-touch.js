(function($, w, d, undef) {
	$(d).bind("pageshow", function(e) {
		$(".wiziapp-metro-touch-menu > ul, ul.wiziapp-content-archive-list", e.target).each(function() {
			var $this = $(this), $parent = $this.parent(), pw = $parent.width(), cw = ((pw/3-10) << 0), uw = cw*3+30;
			$this.css("width", uw+"px");
			if ($parent.is(".wiziapp-metro-touch-menu")) {
				$this.css("height", uw+"px");
			}
			$this.find("li").css("width", cw+"px").css("height", cw+"px");
		});
	});
})(jQuery, window, document);
