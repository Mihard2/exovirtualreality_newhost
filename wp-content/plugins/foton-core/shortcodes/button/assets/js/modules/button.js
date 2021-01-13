(function ($) {
	'use strict';

	var button = {};
	mkdf.modules.button = button;

	button.mkdfButton = mkdfButton;
	button.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfButton().init();
	}
	
	/*
	All functions to be called on $(window).load() should be in this function
    */
	function mkdfOnWindowLoad() {
		mkdfElementorButton();
	}
	
	/**
	 * Elementor
	 */
	function mkdfElementorButton(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_elementor_button.default', function() {
				mkdfButton().init();
			} );
		});
	}

	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var mkdfButton = function () {
		//all buttons on the page
		var buttons = $('.mkdf-btn');

		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function (button) {
			if (typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function (event) {
					event.data.button.css('color', event.data.color);
				};

				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');

				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};

		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function (button) {
			if (typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function (event) {
					event.data.button.css('background-color', event.data.color);
				};

				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');

				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};

		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function (button) {
			if (typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function (event) {
					event.data.button.css('border-color', event.data.color);
				};

				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');

				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};

        /**
         * Initializes button hover box-shadow
         * @param button current button
         */
        var buttonHoverShadow = function (button) {
            var setButtonShadow = function (event) {
                event.data.button.css('box-shadow', '0px 10px 25px 0px rgba(' + event.data.color + ')');
            }

            var resetButtonShadow = function (event) {
                event.data.button.css('box-shadow', 'none');
            }

            var rgba = button.css('background-color').match(/[.?\d]+/g);

            rgba.length == 3 && rgba.push('0.5');

            button
                .on('mouseenter', { button: button, color: rgba.toString() }, setButtonShadow)
                .on('mouseleave', { button: button }, resetButtonShadow);
        };

		return {
			init: function () {
				if (buttons.length) {
					buttons.not('.mkdf-btn-solid').each(function () {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
					buttons.filter('.mkdf-btn-solid').each(function () {
						buttonHoverShadow($(this));
					});
				}
			}
		};
	};

})(jQuery);