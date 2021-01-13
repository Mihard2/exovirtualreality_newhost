(function($) {
    "use strict";

    var searchSlideFromWT = {};
    mkdf.modules.searchSlideFromWT = searchSlideFromWT;

    searchSlideFromWT.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfSearchSlideFromWT();
    }
	
	/**
	 * Init Search Types
	 */
	function mkdfSearchSlideFromWT() {
        if ( mkdf.body.hasClass( 'mkdf-search-slides-from-window-top' ) ) {
            var searchOpener = $('a.mkdf-search-opener');

            if ( searchOpener.length > 0 ) {
                var searchForm = $('.mkdf-search-slide-window-top'),
                    searchClose = $('.mkdf-search-close');

                searchOpener.on('click', function(e) {
                    e.preventDefault();

                    if ( searchForm.height() === 0) {
                        $('.mkdf-search-slide-window-top input[type="text"]').focus();
                        //Push header bottom
                        mkdf.body.addClass('mkdf-search-open');
                    } else {
                        mkdf.body.removeClass('mkdf-search-open');
                    }

                    $(window).scroll(function() {
                        if ( searchForm.height() !== 0 && mkdf.scroll > 50 ) {
                            mkdf.body.removeClass('mkdf-search-open');
                        }
                    });

                    searchClose.on('click', function(e){
                        e.preventDefault();
                        mkdf.body.removeClass('mkdf-search-open');
                    });
                });
            }
		}
	}

})(jQuery);
