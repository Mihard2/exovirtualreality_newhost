(function ($) {
	"use strict";
	
	var subscribePopup = {};
	mkdf.modules.subscribePopup = subscribePopup;
	
	subscribePopup.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfSubscribePopup();
	}
	
	function mkdfSubscribePopup() {
		var popupOpener = $('.mkdf-subscribe-popup-holder'),
			popupClose = $('.mkdf-sp-close');
		
		if (popupOpener.length) {
			var popupPreventHolder = popupOpener.find('.mkdf-sp-prevent'),
				disabledPopup = 'no';
			
			if (popupPreventHolder.length) {
				var isLocalStorage = popupOpener.hasClass('mkdf-sp-prevent-cookies'),
					popupPreventInput = popupPreventHolder.find('.mkdf-sp-prevent-input'),
					preventValue = popupPreventInput.data('value');
				
				if (isLocalStorage) {
					disabledPopup = localStorage.getItem('disabledPopup');
					sessionStorage.removeItem('disabledPopup');
				} else {
					disabledPopup = sessionStorage.getItem('disabledPopup');
					localStorage.removeItem('disabledPopup');
				}
				
				popupPreventHolder.children().on('click', function (e) {
					if ( preventValue !== 'yes' ) {
						preventValue = 'yes';
						popupPreventInput.addClass('mkdf-sp-prevent-clicked').data('value', 'yes');
					} else {
						preventValue = 'no';
						popupPreventInput.removeClass('mkdf-sp-prevent-clicked').data('value', 'no');
					}
					
					if (preventValue === 'yes') {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'yes');
						} else {
							sessionStorage.setItem('disabledPopup', 'yes');
						}
					} else {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'no');
						} else {
							sessionStorage.setItem('disabledPopup', 'no');
						}
					}
				});
			}
			
			if (disabledPopup !== 'yes') {
				if (mkdf.body.hasClass('mkdf-sp-opened')) {
					mkdf.body.removeClass('mkdf-sp-opened');
					mkdf.modules.common.mkdfEnableScroll();
				} else {
					mkdf.body.addClass('mkdf-sp-opened');
					mkdf.modules.common.mkdfDisableScroll();
				}
				
				popupClose.on('click', function (e) {
					e.preventDefault();
					
					mkdf.body.removeClass('mkdf-sp-opened');
					mkdf.modules.common.mkdfEnableScroll();
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode === 27) { //KeyCode for ESC button is 27
						mkdf.body.removeClass('mkdf-sp-opened');
						mkdf.modules.common.mkdfEnableScroll();
					}
				});
			}
		}
	}
	
})(jQuery);