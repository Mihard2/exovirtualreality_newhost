(function($) {
    "use strict";

    var searchFullscreenWithSidebar = {};
    mkdf.modules.searchFullscreenWithSidebar = searchFullscreenWithSidebar;

    searchFullscreenWithSidebar.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
        mkdfSearchFullscreenWithSidebar();
    }
    
	/**
	 * Init Search Types
	 */
	function mkdfSearchFullscreenWithSidebar() {
        if ( mkdf.body.hasClass( 'mkdf-fullscreen-search-with-sidebar' ) ) {
            var searchOpener = $('a.mkdf-search-opener');

            if (searchOpener.length > 0) {
                var searchHolder = $('.mkdf-fullscreen-with-sidebar-search-holder'),
                    searchClose = $('.mkdf-search-close');

                mkdf.modules.common.mkdfInitPerfectScrollbar().init(searchHolder);

                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('mkdf-animate')) {
                        mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-out');
                        mkdf.body.removeClass('mkdf-search-fade-in');
                        searchHolder.removeClass('mkdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.mkdf-search-field').val('');
                            searchHolder.find('.mkdf-search-field').blur();
                        }, 300);

                        mkdf.modules.common.mkdfEnableScroll();
                    } else {
                        mkdf.body.addClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
                        mkdf.body.removeClass('mkdf-search-fade-out');
                        searchHolder.addClass('mkdf-animate');

                        setTimeout(function () {
                           searchHolder.find('.mkdf-search-field').focus();
                        }, 900);

                        mkdf.modules.common.mkdfDisableScroll();
                    }
                    
                    searchClose.on('click', function (e) {
                        e.preventDefault();
                        mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
                        mkdf.body.addClass('mkdf-search-fade-out');
                        searchHolder.removeClass('mkdf-animate');

                        setTimeout(function () {
                            searchHolder.find('.mkdf-search-field').val('');
                            searchHolder.find('.mkdf-search-field').blur();
                        }, 300);

                        mkdf.modules.common.mkdfEnableScroll();
                    });
                    
                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            mkdf.body.removeClass('mkdf-fullscreen-search-opened mkdf-search-fade-in');
                            mkdf.body.addClass('mkdf-search-fade-out');
                            searchHolder.removeClass('mkdf-animate');

                            setTimeout(function () {
                                searchHolder.find('.mkdf-search-field').val('');
                                searchHolder.find('.mkdf-search-field').blur();
                            }, 300);

                            mkdf.modules.common.mkdfEnableScroll();
                        }
                    });
                });
            }
        }
	}

})(jQuery);
