(function($){
	window.mkdfAdmin = {};
	mkdfAdmin.framework = {};


    $(document).ready(function() {
        //plugins init goes here


        if ($('.mkdf-page-form').length > 0) {
            mkdfFixHeaderAndTitle();
            initTopAnchorHolderSize();
            mkdfScrollToAnchorSelect();
            mkdfChangedInput();
            backButtonShowHide();
            backToTop();
        }
    });

    function mkdfFixHeaderAndTitle () {
        var pageHeader 				= $('.mkdf-page-header');
        var pageHeaderHeight		= pageHeader.height();
        var adminBarHeight			= $('#wpadminbar').height();
        var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
        var pageTitle				= $('.mkdf-page-title-holder');
        var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
        var tabsNavWrapper			= $('.mkdf-tabs-navigation-wrapper');
        var tabsNavWrapperTop		= pageHeaderHeight;
        var tabsContentWrapper	    = $('.mkdf_ajax_form');
        var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();

        $(window).on('scroll load', function() {
            if($(window).scrollTop() >= pageHeaderTopPosition) {
                pageHeader.addClass('mkdf-header-fixed');
                pageTitle.addClass('mkdf-page-title-fixed').css('top', pageTitleTopPosition);
                tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
                tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
            } else {
                pageHeader.removeClass('mkdf-header-fixed');
                pageTitle.removeClass('mkdf-page-title-fixed').css('top', 0);
                tabsNavWrapper.css('marginTop', 0);
                tabsContentWrapper.css('marginTop', 0);
            }
        });
    }

    function initTopAnchorHolderSize() {
        function initTopSize() {
            $('.mkdf-top-section-holder-inner').css({
                'width' : $('.mkdf-top-section-holder').width()
            });
            $('.mkdf-page-title-holder').css({
                'width' : $('.mkdf-page-section-title:visible').outerWidth()- 2*parseInt($('.mkdf-page-title-holder').css('marginLeft'))
            });
        };
        initTopSize();

        $(window).on('resize', function() {
            initTopSize();
        });
    }

    function mkdfScrollToAnchorSelect() {
        var selectAnchor = $('#mkdf-select-anchor');
        selectAnchor.on('change', function() {
            var selectAnchor = $('option:selected', selectAnchor);

            if(typeof selectAnchor.data('anchor') !== 'undefined') {
                mkdfScrollToPanel(selectAnchor.data('anchor'));
            }
        });
    }

    function mkdfScrollToPanel(panel) {
        var pageHeader 				= $('.mkdf-page-header');
        var pageHeaderHeight		= pageHeader.height();
        var adminBarHeight			= $('#wpadminbar').height();
        var pageTitle				= $('.mkdf-page-title-holder');
        var pageTitleHeight			= pageTitle.outerHeight();

        var panelTopPosition = $(panel).offset().top - adminBarHeight - pageHeaderHeight - pageTitleHeight;

        $('html, body').animate({
            scrollTop: panelTopPosition
        }, 1000);

        return false;
    }
    
    function mkdfChangedInput () {
        $('.mkdf-tabs-content form.mkdf_ajax_form:not(.mkdf-import-page-holder):not(.mkdf-backup-options-page-holder)').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
            $('.mkdf-input-change').addClass('yes');
        });
        $('.mkdf-tabs-content form.mkdf_ajax_form:not(.mkdf-import-page-holder):not(.mkdf-backup-options-page-holder) .field.switch label:not(.selected)').on('click', function() {
            $('.mkdf-input-change').addClass('yes');
        });
        $(window).on('beforeunload', function () {
            if ($('.mkdf-input-change.yes').length) {
                return 'You haven\'t saved your changes.';
            }
        });
        $('.mkdf-tabs-content form.mkdf_ajax_form:not(.mkdf-import-page-holder):not(.mkdf-backup-options-page-holder) #anchornav input').on('click', function() {
	        var yesInputChange = $('.mkdf-input-change.yes');
	        if (yesInputChange.length) {
		        yesInputChange.removeClass('yes');
	        }
	        var saveChanges = $('.mkdf-changes-saved');
	        if (saveChanges.length) {
		        saveChanges.addClass('yes');
		        setTimeout(function(){saveChanges.removeClass('yes');}, 3000);
	        }
        });
    }

    function totop_button(a) {
        "use strict";

        var b = $("#back_to_top");
        b.removeClass("off on");
        if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
    }

    function backButtonShowHide(){

        $(window).scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
        });
    }

    function backToTop(){

        $(document).on('click','#back_to_top',function(){
            $('html, body').animate({
                scrollTop: $('html').offset().top}, 1000);
            return false;
        });
    }
	
})(jQuery);