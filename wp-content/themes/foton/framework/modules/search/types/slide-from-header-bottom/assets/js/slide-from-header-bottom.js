(function($) {
    "use strict";

    var searchSlideFromHB = {};
    mkdf.modules.searchSlideFromHB = searchSlideFromHB;

    searchSlideFromHB.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfSearchSlideFromHB();
    }
	
	/**
	 * Init Search Types
	 */
	function mkdfSearchSlideFromHB() {
        if ( mkdf.body.hasClass( 'mkdf-slide-from-header-bottom' ) ) {

            var searchOpener = $('a.mkdf-search-opener');

            if (searchOpener.length > 0) {
                //Check for type of search
                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchIconPosition = parseInt(mkdf.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());

                    if (mkdf.body.hasClass('mkdf-boxed') && mkdf.windowWidth > 1024) {
                        searchIconPosition -= parseInt((mkdf.windowWidth - $('.mkdf-boxed .mkdf-wrapper .mkdf-wrapper-inner').outerWidth()) / 2);
                    }

                    var searchFormHeaderHolder = $('.mkdf-page-header'),
                        searchFormTopOffset = '100%',
                        searchFormTopHeaderHolder = $('.mkdf-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.mkdf-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.mkdf-mobile-header'),
                        searchForm = $('.mkdf-slide-from-header-bottom-holder'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.mkdf-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.mkdf-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.mkdf-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.mkdf-mobile-header').length;

                    searchForm.removeClass('mkdf-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormTopHeaderHolder.find('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + mkdfGlobalVars.vars.mkdfAddForAdminBar;
                        searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        searchFormTopOffset = mkdfGlobalVars.vars.mkdfStickyHeaderHeight + mkdfGlobalVars.vars.mkdfAddForAdminBar;
                        searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormTopOffset = searchFormMobileHeaderHolder.children('.mkdf-mobile-header-inner').outerHeight() + mkdfGlobalVars.vars.mkdfAddForAdminBar;
                        }
                        searchFormMobileHeaderHolder.find('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');

                    } else {
                        searchFormHeaderHolder.children('.mkdf-slide-from-header-bottom-holder').addClass('mkdf-is-active');
                    }

                    if (searchForm.hasClass('mkdf-is-active')) {
                        searchForm.css({
                            'right': searchIconPosition,
                            'top': searchFormTopOffset
                        }).stop(true).slideToggle(300, 'easeOutBack');
                    }

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            searchForm.stop(true).fadeOut(0);
                        }
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(0);
                    });
                });
            }
        }
	}

})(jQuery);
