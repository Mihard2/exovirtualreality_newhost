(function ($) {
	"use strict";
	
	var footer = {};
    mkdf.modules.footer = footer;
	
	footer.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	 
	function mkdfOnWindowLoad() {
		uncoveringFooter();
	}
	
	function uncoveringFooter() {
		var uncoverFooter = $('body:not(.error404) .mkdf-footer-uncover');

		if (uncoverFooter.length && !mkdf.htmlEl.hasClass('touch')) {

			var footer = $('footer'),
				footerHeight = footer.outerHeight(),
				content = $('.mkdf-content');
			
			var uncoveringCalcs = function () {
				content.css('margin-bottom', footerHeight);
				footer.css('height', footerHeight);
			};


			//set
			uncoveringCalcs();
			
			$(window).resize(function () {
				//recalc
				footerHeight = footer.find('.mkdf-footer-inner').outerHeight();
				uncoveringCalcs();
			});
		}
	}
	
})(jQuery);