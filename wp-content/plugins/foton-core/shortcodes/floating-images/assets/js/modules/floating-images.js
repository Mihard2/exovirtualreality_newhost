(function($) {
    'use strict';

    var floatingImages = {};
    mkdf.modules.floatingImages = floatingImages;

    floatingImages.mkdfOnDocumentReady = mkdfOnDocumentReady;
    floatingImages.mkdfFloatingImagesCalcs = mkdfFloatingImagesCalcs;

    $(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfFloatingImagesCalcs();
    }
	
	/*
	All functions to be called on $(window).load() should be in this function
	*/
	function mkdfOnWindowLoad() {
		mkdfElementorFloatingImagesCalcs();
	}
	
	/**
	 * Elementor
	 */
	function mkdfElementorFloatingImagesCalcs(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_elementor_floating_images.default', function() {
				mkdfFloatingImagesCalcs();
			} );
		});
	}
	
	/**
     * Floating Images Calcs
     */
    function mkdfFloatingImagesCalcs() {
        var fiShortcodes = $('.mkdf-floating-images-holder');

        if (fiShortcodes.length) {
            var getProps = function(image) {
                image
                    .data('c', image.prop('naturalWidth')/image.prop('naturalHeight'))
                    .data('w', image.attr('data-width') ? parseInt(image.attr('data-width')) : 100)
                    .data('x', image.attr('data-x') ? image.attr('data-x') : 0)
                    .data('y', image.attr('data-y') ? image.attr('data-y') : 0);
            };
        
            var setSizes = function(image, holder) {
                image.css({
                    'width': image.data('w')/100*holder.width(),
                    'height': image.data('w')/100*holder.width()/image.data('c')
                });
            };
        
            var holderCalcs = function(holder, inner, mainImg, auxImg) {
                var mainW = mainImg.data('w')/100*holder.width(),
                    mainH = mainW/mainImg.data('c'),
                    auxY = parseInt(auxImg.data('y')),
                    auxX = parseInt(auxImg.data('x')),
                    auxWCorr = auxImg.width() + Math.abs(auxX)*mainImg.width()/100,
                    auxHCorr = auxImg.height() + Math.abs(auxY)*mainImg.height()/100;
        
                var widthVal =  mainW > auxWCorr ? mainW : auxWCorr,
                    heightVal = mainH > auxHCorr ? mainH : auxHCorr;

                inner.css({
                    'height': heightVal,
                    'width': widthVal
                });

                if (auxY > 0) {
                    mainImg.css({'top': 0});
                    auxImg.css({'top': auxY/100*mainH});
                } else {
                    mainImg.css({'bottom': 0});
                    auxImg.css({'bottom': Math.abs(auxY)/100*mainH});
                }
                if (auxX > 0) {
                    mainImg.css({'left': 0});
                    auxImg.css({'left': auxX/100*mainW});
                } else {
                    mainImg.css({'right': 0});
                    auxImg.css({'right': Math.abs(auxX)/100*mainW});
                }
            };
        
            fiShortcodes.each(function() {
                var holder = $(this),
                    inner = holder.find('.mkdf-fi-inner'),
                    mainImg = holder.find('.mkdf-fi-main-image'),
                    auxImg = holder.find('.mkdf-fi-aux-image');
            
                holder.waitForImages(function(){
                    getProps(mainImg);
                    getProps(auxImg);
                    setSizes(mainImg, holder);
                    setSizes(auxImg, holder);
                    holderCalcs(holder, inner, mainImg, auxImg);
                });
        
                $(window).on('resize', function() {
                    setSizes(mainImg, holder);
                    setSizes(auxImg, holder);
                    holderCalcs(holder, inner, mainImg, auxImg);
                });
            });
        }
    }
})(jQuery);
