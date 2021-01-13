(function($) {
    "use strict";

    var searchCoversHeader = {};
    mkdf.modules.searchCoversHeader = searchCoversHeader;

    searchCoversHeader.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfSearchCoversHeader();
    }
	
	/**
	 * Init Search Types
	 */
	function mkdfSearchCoversHeader() {
        if ( mkdf.body.hasClass( 'mkdf-search-covers-header' ) ) {

            var searchOpener = $('a.mkdf-search-opener');

            if (searchOpener.length > 0) {
                searchOpener.each(function() {
                   var thisOpener = $(this);
                    thisOpener.on('click', function (e) {
                        e.preventDefault();

                        var thisSearchOpener = $(this),
                            searchFormHeight,
                            searchFormHeaderHolder = $('.mkdf-page-header'),
                            searchFormTopHeaderHolder = $('.mkdf-top-bar'),
                            searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.mkdf-fixed-wrapper.fixed'),
                            searchFormMobileHeaderHolder = $('.mkdf-mobile-header'),
                            searchForm = $('.mkdf-search-cover'),
                            searchFormIsInTopHeader = !!thisSearchOpener.parents('.mkdf-top-bar').length,
                            searchFormIsInFixedHeader = !!thisSearchOpener.parents('.mkdf-fixed-wrapper.fixed').length,
                            searchFormIsInStickyHeader = !!thisSearchOpener.parents('.mkdf-sticky-header').length,
                            searchFormIsInMobileHeader = !!thisSearchOpener.parents('.mkdf-mobile-header').length;

                        searchForm.removeClass('mkdf-is-active');

                        //Find search form position in header and height
                        if (searchFormIsInTopHeader) {
                            searchFormHeight = mkdfGlobalVars.vars.mkdfTopBarHeight;
                            searchFormTopHeaderHolder.find('.mkdf-search-cover').addClass('mkdf-is-active');

                        } else if (searchFormIsInFixedHeader) {
                            searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');

                        } else if (searchFormIsInStickyHeader) {
                            searchFormHeight = searchFormHeaderHolder.find('.mkdf-sticky-header').outerHeight();
                            searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');

                        } else if (searchFormIsInMobileHeader) {
                            if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                                searchFormHeight = searchFormMobileHeaderHolder.children('.mkdf-mobile-header-inner').outerHeight();
                            } else {
                                searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
                            }

                            searchFormMobileHeaderHolder.find('.mkdf-search-cover').addClass('mkdf-is-active');

                        } else {
                            searchFormHeight = searchFormHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.mkdf-search-cover').addClass('mkdf-is-active');
                        }

                        if (searchForm.hasClass('mkdf-is-active')) {
                            searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
                        }

                        searchForm.find('.mkdf-search-close').on('click', function (e) {
                            e.preventDefault();
                            searchForm.stop(true).fadeOut(450);
                        });

                        searchForm.blur(function () {
                            searchForm.stop(true).fadeOut(450);
                        });

                        $(window).scroll(function () {
                            searchForm.stop(true).fadeOut(450);
                        });
                    });
                });
            }
        }
	}

})(jQuery);
