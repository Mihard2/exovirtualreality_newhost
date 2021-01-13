(function($) {
	'use strict';
	
	var itemShowcase = {};
	mkdf.modules.itemShowcase = itemShowcase;
	
	itemShowcase.mkdfInitItemShowcase = mkdfInitItemShowcase;
	itemShowcase.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitItemShowcase();
	}
	
	/*
	All functions to be called on $(window).load() should be in this function
    */
	function mkdfOnWindowLoad() {
		mkdfElementorInitItemShowcase();
	}
	
	/**
	 * Elementor
	 */
	function mkdfElementorInitItemShowcase(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_elementor_item_showcase.default', function() {
				mkdfInitItemShowcase();
			} );
		});
	}
	
	/**
	 * Init item showcase shortcode
	 */
	function mkdfInitItemShowcase() {
		var itemShowcase = $('.mkdf-item-showcase-holder');
		
		if (itemShowcase.length) {
			itemShowcase.each(function(){
				var thisItemShowcase = $(this),
					leftItems = thisItemShowcase.find('.mkdf-is-left'),
					rightItems = thisItemShowcase.find('.mkdf-is-right'),
					itemImage = thisItemShowcase.find('.mkdf-is-image');
				
				//logic
				leftItems.wrapAll( "<div class='mkdf-is-item-holder mkdf-is-left-holder' />");
				rightItems.wrapAll( "<div class='mkdf-is-item-holder mkdf-is-right-holder' />");
				thisItemShowcase.animate({opacity:1},200);
				
				setTimeout(function(){
					thisItemShowcase.appear(function(){
						itemImage.addClass('mkdf-appeared');
						thisItemShowcase.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
							function(e) {
								if(mkdf.windowWidth > 1200) {
									itemAppear('.mkdf-is-left-holder .mkdf-is-item');
									itemAppear('.mkdf-is-right-holder .mkdf-is-item');
								} else {
									itemAppear('.mkdf-is-item');
								}
							});
					},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
				},100);
				
				//appear animation trigger
				function itemAppear(itemCSSClass) {
					thisItemShowcase.find(itemCSSClass).each(function(i){
						var thisListItem = $(this);
						setTimeout(function(){
							thisListItem.addClass('mkdf-appeared');
						}, i*150);
					});
				}
			});
		}
	}
	
})(jQuery);