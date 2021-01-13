(function ($) {
	"use strict";
	
	var common = {};
	mkdf.modules.common = common;
	
	common.mkdfFluidVideo = mkdfFluidVideo;
	common.mkdfEnableScroll = mkdfEnableScroll;
	common.mkdfDisableScroll = mkdfDisableScroll;
	common.mkdfOwlSlider = mkdfOwlSlider;
	common.mkdfInitParallax = mkdfInitParallax;
	common.mkdfInitSelfHostedVideoPlayer = mkdfInitSelfHostedVideoPlayer;
	common.mkdfSelfHostedVideoSize = mkdfSelfHostedVideoSize;
	common.mkdfPrettyPhoto = mkdfPrettyPhoto;
	common.mkdfStickySidebarWidget = mkdfStickySidebarWidget;
	common.getLoadMoreData = getLoadMoreData;
	common.setLoadMoreAjaxData = setLoadMoreAjaxData;
	common.setFixedImageProportionSize = setFixedImageProportionSize;
	common.mkdfInitPerfectScrollbar = mkdfInitPerfectScrollbar;
	common.mkdfInitParallaxElements = mkdfInitParallaxElements;
	
	common.mkdfOnDocumentReady = mkdfOnDocumentReady;
	common.mkdfOnWindowLoad = mkdfOnWindowLoad;
	common.mkdfOnWindowResize = mkdfOnWindowResize;
	
	$(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	$(window).resize(mkdfOnWindowResize);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function mkdfOnDocumentReady() {
		mkdfIconWithHover().init();
		mkdfDisableSmoothScrollForMac();
		mkdfInitAnchor().init();
		mkdfInitBackToTop();
		mkdfBackButtonShowHide();
		mkdfInitSelfHostedVideoPlayer();
		mkdfSelfHostedVideoSize();
		mkdfFluidVideo();
		mkdfOwlSlider();
		mkdfPreloadBackgrounds();
		mkdfPrettyPhoto();
		mkdfSearchPostTypeWidget();
		mkdfDashboardForm();
		mkdfInitGridMasonryListLayout();
		mkdfDynamicBackgroundColor();
		mkdfSmoothTransition();
	}
	
	/*
		All functions to be called on $(window).load() should be in this function
	*/
	function mkdfOnWindowLoad() {
		mkdfInitParallax();
		mkdfStickySidebarWidget().init();
		mkdfInitParallaxElements();
		mkdfElementorClientsCarousel();
		mkdfElementorFloatingImagesCalcs();
		mkdfElementorInitGridMasonryListLayout();
		mkdfElementorTeamCarousel();
		mkdfElementorBlogSlider();
		mkdfElementorProductList();
		mkdfElementorProductCarousel();
		mkdfElementorTestimonials();
		mkdfElementorPortfolioList();
		mkdfElementorPortfolioSlider();
		mkdfElementorGlobal();
	}
	
	/*
		All functions to be called on $(window).resize() should be in this function
	*/
	function mkdfOnWindowResize() {
		mkdfInitGridMasonryListLayout();
		mkdfSelfHostedVideoSize();
	}
	
	/**
	 * Elementor Global
	 */
	function mkdfElementorGlobal() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/global', function () {
				mkdfInitParallax();
				mkdfDynamicBackgroundColor();
			});
		});
	}
	
	/**p
	 * Elementor Clients Carousel
	 */
	function mkdfElementorClientsCarousel() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_clients_carousel.default', function () {
				mkdfOwlSlider();
			});
		});
	}
	
	/**
	 * Elementor Floating Images
	 //  */
	function mkdfElementorFloatingImagesCalcs() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_floating_images.default', function () {
				mkdfInitParallaxElements();
			});
		});
	}
	
	/**
	 * Elementor Floating Images
	 //  */
	function mkdfElementorInitGridMasonryListLayout() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_image_gallery.default', function () {
				mkdfInitGridMasonryListLayout();
				mkdfOwlSlider();
			});
		});
	}
	
	/**
	 * Elementor Team Carousel
	 */
	function mkdfElementorTeamCarousel() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_team_carousel.default', function () {
				mkdfOwlSlider();
			});
		});
	}
	
	/**
	 * Elementor Blog Slider
	 */
	function mkdfElementorBlogSlider() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_blog_slider.default', function () {
				mkdfOwlSlider();
			});
		});
	}
	
	/**
	 * Elementor Product List
	 */
	function mkdfElementorProductList() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_product_list.default', function () {
				mkdfInitGridMasonryListLayout();
			});
		});
	}
	
	/**
	 * Elementor Product Carousel
	 */
	function mkdfElementorProductCarousel() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_product_list_carousel.default', function () {
				mkdfOwlSlider();
			});
		});
	}
	
	/**
	 * Elementor Testimonials
	 */
	function mkdfElementorTestimonials() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_testimonials.default', function () {
				mkdfOwlSlider();
			});
		});
	}
	
	/**
	 * Elementor Portfolio List
	 */
	function mkdfElementorPortfolioList() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_portfolio_list.default', function () {
				mkdfInitGridMasonryListLayout();
			});
		});
	}
	
	/**
	 * Elementor Portfolio Slider
	 */
	function mkdfElementorPortfolioSlider() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/mkdf_elementor_portfolio_slider.default', function () {
				mkdfOwlSlider();
			});
		});
	}
	
	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function mkdfDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();
		
		if (os.indexOf('mac') > -1 && mkdf.body.hasClass('mkdf-smooth-scroll')) {
			mkdf.body.removeClass('mkdf-smooth-scroll');
		}
	}
	
	function mkdfDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('wheel', mkdfWheel, {passive: false});
		}
		
		//window.onmousewheel = document.onmousewheel = mkdfWheel;
		document.onkeydown = mkdfKeydown;
	}
	
	function mkdfEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('wheel', mkdfWheel, {passive: false});
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function mkdfWheel(e) {
		mkdfPreventDefaultValue(e);
	}
	
	function mkdfKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				mkdfPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function mkdfPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	function mkdfParallaxItems() {
		if (!mkdf.htmlEl.hasClass('touch')) {
			setTimeout(function () {
				ParallaxScroll.init();
			}, 100); //wait for calcs
		}
	}
	
	/*
	 **	Anchor functionality
	 */
	var mkdfInitAnchor = function () {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function (anchor) {
			var headers = $('.mkdf-main-menu, .mkdf-mobile-nav, .mkdf-fullscreen-menu');
			
			headers.each(function () {
				var currentHeader = $(this);
				
				if (anchor.parents(currentHeader).length) {
					currentHeader.find('.mkdf-active-item').removeClass('mkdf-active-item');
					anchor.parent().addClass('mkdf-active-item');
					
					currentHeader.find('a').removeClass('current');
					anchor.addClass('current');
				}
			});
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function () {
			var anchorData = $('[data-mkdf-anchor]'),
				anchorElement,
				siteURL = window.location.href.split('#')[0];
			
			if (siteURL.substr(-1) !== '/') {
				siteURL += '/';
			}
			
			anchorData.waypoint(function (direction) {
				if (direction === 'down') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("mkdf-anchor");
					} else {
						anchorElement = $(this).data("mkdf-anchor");
					}
					
					setActiveState($("a[href='" + siteURL + "#" + anchorElement + "']"));
				}
			}, {offset: '50%'});
			
			anchorData.waypoint(function (direction) {
				if (direction === 'up') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("mkdf-anchor");
					} else {
						anchorElement = $(this).data("mkdf-anchor");
					}
					
					setActiveState($("a[href='" + siteURL + "#" + anchorElement + "']"));
				}
			}, {
				offset: function () {
					return -($(this.element).outerHeight() - 150);
				}
			});
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function () {
			var hash = window.location.hash.split('#')[1];
			
			if (hash !== "" && $('[data-mkdf-anchor="' + hash + '"]').length > 0) {
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function ($this) {
			var scrollAmount,
				anchor = $('.mkdf-main-menu a, .mkdf-mobile-nav a, .mkdf-fullscreen-menu a'),
				hash = $this,
				anchorData = hash !== '' ? $('[data-mkdf-anchor="' + hash + '"]') : '';
			
			if (hash !== '' && anchorData.length > 0) {
				var anchoredElementOffset = anchorData.offset().top;
				scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - mkdfGlobalVars.vars.mkdfAddForAdminBar;
				
				if (anchor.length) {
					anchor.each(function () {
						var thisAnchor = $(this);
						
						if (thisAnchor.attr('href').indexOf(hash) > -1) {
							setActiveState(thisAnchor);
						}
					});
				}
				
				mkdf.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function () {
					//change hash tag in url
					if (history.pushState) {
						history.pushState(null, '', '#' + hash);
					}
				});
				
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offset
		 */
		var headerHeightToSubtract = function (anchoredElementOffset) {
			
			if (mkdf.modules.stickyHeader.behaviour === 'mkdf-sticky-header-on-scroll-down-up') {
				mkdf.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > mkdf.modules.header.stickyAppearAmount);
			}
			
			if (mkdf.modules.stickyHeader.behaviour === 'mkdf-sticky-header-on-scroll-up') {
				if ((anchoredElementOffset > mkdf.scroll)) {
					mkdf.modules.stickyHeader.isStickyVisible = false;
				}
			}
			
			var headerHeight = mkdf.modules.stickyHeader.isStickyVisible ? mkdfGlobalVars.vars.mkdfStickyHeaderTransparencyHeight : mkdfPerPageVars.vars.mkdfHeaderTransparencyHeight;
			
			if (mkdf.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function () {
			mkdf.document.on("click", ".mkdf-main-menu a, .mkdf-fullscreen-menu a, .mkdf-btn, .mkdf-anchor, .mkdf-mobile-nav a", function () {
				var scrollAmount,
					anchor = $(this),
					hash = anchor.prop("hash").split('#')[1],
					anchorData = hash !== '' ? $('[data-mkdf-anchor="' + hash + '"]') : '';
				
				if (hash !== '' && anchorData.length > 0) {
					var anchoredElementOffset = anchorData.offset().top;
					scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - mkdfGlobalVars.vars.mkdfAddForAdminBar;
					
					setActiveState(anchor);
					
					mkdf.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function () {
						//change hash tag in url
						if (history.pushState) {
							history.pushState(null, '', '#' + hash);
						}
					});
					
					return false;
				}
			});
		};
		
		return {
			init: function () {
				if ($('[data-mkdf-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					
					$(window).load(function () {
						checkActiveStateOnLoad();
					});
				}
			}
		};
	};
	
	function mkdfInitBackToTop() {
		var backToTopButton = $('#mkdf-back-to-top');
		backToTopButton.on('click', function (e) {
			e.preventDefault();
			mkdf.html.animate({scrollTop: 0}, mkdf.window.scrollTop() / 3, 'easeInOutCirc');
		});
	}
	
	function mkdfBackButtonShowHide() {
		mkdf.window.scroll(function () {
			var b = $(this).scrollTop(),
				c = $(this).height(),
				d;
			
			if (b > 0) {
				d = b + c / 2;
			} else {
				d = 1;
			}
			
			if (d < 1e3) {
				mkdfToTopButton('off');
			} else {
				mkdfToTopButton('on');
			}
		});
	}
	
	function mkdfToTopButton(a) {
		var b = $("#mkdf-back-to-top");
		b.removeClass('off on');
		if (a === 'on') {
			b.addClass('on');
		} else {
			b.addClass('off');
		}
	}
	
	function mkdfInitSelfHostedVideoPlayer() {
		var players = $('.mkdf-self-hosted-video');
		
		if (players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function mkdfSelfHostedVideoSize() {
		var selfVideoHolder = $('.mkdf-self-hosted-video-holder .mkdf-video-wrap');
		
		if (selfVideoHolder.length) {
			selfVideoHolder.each(function () {
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.mkdf-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / mkdf.videoRatio;
				
				if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function mkdfFluidVideo() {
		fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}
	
	function mkdfSmoothTransition() {
		
		if (mkdf.body.hasClass('mkdf-smooth-page-transitions')) {
			
			//check for preload animation
			if (mkdf.body.hasClass('mkdf-smooth-page-transitions-preloader')) {
				var loader = $('body > .mkdf-smooth-transition-loader.mkdf-mimic-ajax'),
					logoLoader = $('.mkdf-logo-letter-holder'),
					revSlider = $('#mkdf-main-rev-holder .rev_slider');
				
				var loaderCallback = function () {
					if ($('.mkdf-homes-holder').length) {
						mkdf.body.addClass('mkdf-show-homes');
					}
				}
				
				var removeLoader = function (delay, duration) {
					loader.delay(delay).fadeOut(duration, 'easeOutCirc', loaderCallback);
					
					$(window).on('bind', 'pageshow', function (event) {
						if (event.originalEvent.persisted) {
							loader.delay(delay).fadeOut(duration, 'easeOutCirc', loaderCallback);
						}
					});
				}
				
				var removeLogoLetter = function () {
					logoLoader.one('animationiteration webkitAnimationIteration', function () {
						logoLoader.addClass('mkdf-loaded');
						logoLoader.find('.mkdf-logo-dot').one(mkdf.transitionEnd, function () {
							logoLoader.addClass('mkdf-remove');
							removeLoader(300, 400);
						})
					});
				}
				
				if (logoLoader.length) {
					if (revSlider.length) {
						revSlider.on('revolution.slide.onchange', function () {
							removeLogoLetter();
						});
					} else {
						$(window).on('load', function () {
							removeLogoLetter();
						});
					}
				} else {
					$(window).load(function () {
						removeLoader(0, 500);
					});
				}
			}
			
			// if back button is pressed, than show content to avoid state where content is on display:none
			window.addEventListener("pageshow", function (event) {
				var historyPath = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
				if (historyPath) {
					$('.mkdf-wrapper-inner').show();
				}
			});
			
			//check for fade out animation
			if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');
				
				linkItem.on('click', function (e) {
					var a = $(this);
					
					if ((a.parents('.mkdf-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
						return;
					}
					
					if (
						e.which === 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
						(!a.hasClass('lightbox-active')) && //Not lightbox plugin active
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						$('.mkdf-wrapper-inner').fadeOut(800, 'easeInOutCirc', function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}
	
	/*
	 *	Preload background images for elements that have 'mkdf-preload-background' class
	 */
	function mkdfPreloadBackgrounds() {
		var preloadBackHolder = $('.mkdf-preload-background');
		
		if (preloadBackHolder.length) {
			preloadBackHolder.each(function () {
				var preloadBackground = $(this);
				
				if (preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function () {
							preloadBackground.removeClass('mkdf-preload-background');
						});
					}
				} else {
					$(window).load(function () {
						preloadBackground.removeClass('mkdf-preload-background');
					}); //make sure that mkdf-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function mkdfPrettyPhoto() {
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}
	
	function mkdfSearchPostTypeWidget() {
		var searchPostTypeHolder = $('.mkdf-search-post-type');
		
		if (searchPostTypeHolder.length) {
			searchPostTypeHolder.each(function () {
				var thisSearch = $(this),
					searchField = thisSearch.find('.mkdf-post-type-search-field'),
					resultsHolder = thisSearch.siblings('.mkdf-post-type-search-results'),
					searchLoading = thisSearch.find('.mkdf-search-loading'),
					searchIcon = thisSearch.find('.mkdf-search-icon');
				
				searchLoading.addClass('mkdf-hidden');
				
				var postType = thisSearch.data('post-type'),
					keyPressTimeout;
				
				searchField.on('keyup paste', function () {
					var field = $(this);
					field.attr('autocomplete', 'off');
					searchLoading.removeClass('mkdf-hidden');
					searchIcon.addClass('mkdf-hidden');
					clearTimeout(keyPressTimeout);
					
					keyPressTimeout = setTimeout(function () {
						var searchTerm = field.val();
						
						if (searchTerm.length < 3) {
							resultsHolder.html('');
							resultsHolder.fadeOut();
							searchLoading.addClass('mkdf-hidden');
							searchIcon.removeClass('mkdf-hidden');
						} else {
							var ajaxData = {
								action: 'foton_mikado_search_post_types',
								term: searchTerm,
								postType: postType
							};
							
							$.ajax({
								type: 'POST',
								data: ajaxData,
								url: mkdfGlobalVars.vars.mkdfAjaxUrl,
								success: function (data) {
									var response = JSON.parse(data);
									if (response.status === 'success') {
										searchLoading.addClass('mkdf-hidden');
										searchIcon.removeClass('mkdf-hidden');
										resultsHolder.html(response.data.html);
										resultsHolder.fadeIn();
									}
								},
								error: function (XMLHttpRequest, textStatus, errorThrown) {
									console.log("Status: " + textStatus);
									console.log("Error: " + errorThrown);
									searchLoading.addClass('mkdf-hidden');
									searchIcon.removeClass('mkdf-hidden');
									resultsHolder.fadeOut();
								}
							});
						}
					}, 500);
				});
				
				searchField.on('focusout', function () {
					searchLoading.addClass('mkdf-hidden');
					searchIcon.removeClass('mkdf-hidden');
					resultsHolder.fadeOut();
				});
			});
		}
	}
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container) {
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * @param action with defined action name
	 * return array
	 */
	function setLoadMoreAjaxData(container, action) {
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/*
	 ** Init Masonry List Layout
	 */
	function mkdfInitGridMasonryListLayout() {
		var holder = $('.mkdf-grid-masonry-list');
		
		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					masonry = thisHolder.find('.mkdf-masonry-list-wrapper'),
					size = thisHolder.find('.mkdf-masonry-grid-sizer').width();
				
				masonry.waitForImages(function () {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.mkdf-item-space',
						percentPosition: true,
						masonry: {
							columnWidth: '.mkdf-masonry-grid-sizer',
							gutter: '.mkdf-masonry-grid-gutter'
						}
					});
					
					if (thisHolder.find('.mkdf-fixed-masonry-item').length || thisHolder.hasClass('mkdf-fixed-masonry-items')) {
						setFixedImageProportionSize(masonry, masonry.find('.mkdf-item-space'), size, true);
					}
					
					setTimeout(function () {
						mkdfInitParallax();
					}, 600);
					
					masonry.isotope('layout').css('opacity', 1);
				});
			});
		}
	}
	
	/**
	 * Initializes size for fixed image proportion - masonry layout
	 */
	function setFixedImageProportionSize(container, item, size, isFixedEnabled) {
		if (container.hasClass('mkdf-masonry-images-fixed') || isFixedEnabled === true) {
			var padding = parseInt(item.css('paddingLeft'), 10),
				newSize = size - 2 * padding,
				defaultMasonryItem = container.find('.mkdf-masonry-size-small'),
				largeWidthMasonryItem = container.find('.mkdf-masonry-size-large-width'),
				largeHeightMasonryItem = container.find('.mkdf-masonry-size-large-height'),
				largeWidthHeightMasonryItem = container.find('.mkdf-masonry-size-large-width-height');
			
			defaultMasonryItem.css('height', newSize);
			largeHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));
			
			if (mkdf.windowWidth > 680) {
				largeWidthMasonryItem.css('height', newSize);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));
			} else {
				largeWidthMasonryItem.css('height', Math.round(newSize / 2));
				largeWidthHeightMasonryItem.css('height', newSize);
			}
		}
	}
	
	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdfIconWithHover = function () {
		//get all icons on page
		var icons = $('.mkdf-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function (icon) {
			if (typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function (event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if (hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function () {
				if (icons.length) {
					icons.each(function () {
						iconHoverColor($(this));
					});
				}
			}
		};
	};
	
	/*
	 ** Init parallax
	 */
	function mkdfInitParallax() {
		var parallaxHolder = $('.mkdf-parallax-row-holder');
		
		if (parallaxHolder.length) {
			parallaxHolder.each(function () {
				
				var parallaxElement = $(this);
				var helperHolder = parallaxElement.find('.mikado-parallax-helper-holder');
				
				if (helperHolder.length) {
					var image = helperHolder.data('parallax-bg-image');
					var speed = helperHolder.data('parallax-bg-speed') * 0.4;
					var height = 0;
				} else {
					var image = parallaxElement.data('parallax-bg-image');
					var speed = parallaxElement.data('parallax-bg-speed') * 0.4;
					var height = 0;
				}
				
				if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
					height = parseInt(parallaxElement.data('parallax-bg-height'));
				}
				
				parallaxElement.css({'background-image': 'url(' + image + ')'});
				
				if (height > 0) {
					parallaxElement.css({'min-height': height + 'px', 'height': height + 'px'});
				}
				
				parallaxElement.parallax('50%', speed);
			});
		}
	}
	
	/*
	 **  Init sticky sidebar widget
	 */
	function mkdfStickySidebarWidget() {
		var sswHolder = $('.mkdf-widget-sticky-sidebar'),
			headerHolder = $('.mkdf-page-header'),
			headerHeight = headerHolder.length ? headerHolder.outerHeight() : 0,
			widgetTopOffset = 0,
			widgetTopPosition = 0,
			sidebarHeight = 0,
			sidebarWidth = 0,
			objectsCollection = [];
		
		function addObjectItems() {
			if (sswHolder.length) {
				sswHolder.each(function () {
					var thisSswHolder = $(this),
						mainSidebarHolder = thisSswHolder.parents('aside.mkdf-sidebar'),
						widgetiseSidebarHolder = thisSswHolder.parents('.wpb_widgetised_column'),
						sidebarHolder = '',
						sidebarHolderHeight = 0;
					
					widgetTopOffset = thisSswHolder.offset().top;
					widgetTopPosition = thisSswHolder.position().top;
					sidebarHeight = 0;
					sidebarWidth = 0;
					
					if (mainSidebarHolder.length) {
						sidebarHeight = mainSidebarHolder.outerHeight();
						sidebarWidth = mainSidebarHolder.outerWidth();
						sidebarHolder = mainSidebarHolder;
						sidebarHolderHeight = mainSidebarHolder.parent().parent().outerHeight();
						
						var blogHolder = mainSidebarHolder.parent().parent().find('.mkdf-blog-holder');
						if (blogHolder.length) {
							sidebarHolderHeight -= parseInt(blogHolder.css('marginBottom'));
						}
					} else if (widgetiseSidebarHolder.length) {
						sidebarHeight = widgetiseSidebarHolder.outerHeight();
						sidebarWidth = widgetiseSidebarHolder.outerWidth();
						sidebarHolder = widgetiseSidebarHolder;
						sidebarHolderHeight = widgetiseSidebarHolder.parents('.vc_row').outerHeight();
					}
					
					objectsCollection.push({
						'object': thisSswHolder,
						'offset': widgetTopOffset,
						'position': widgetTopPosition,
						'height': sidebarHeight,
						'width': sidebarWidth,
						'sidebarHolder': sidebarHolder,
						'sidebarHolderHeight': sidebarHolderHeight
					});
				});
			}
		}
		
		function initStickySidebarWidget() {
			
			if (objectsCollection.length) {
				$.each(objectsCollection, function (i) {
					var thisSswHolder = objectsCollection[i].object,
						thisWidgetTopOffset = objectsCollection[i].offset,
						thisWidgetTopPosition = objectsCollection[i].position,
						thisSidebarHeight = objectsCollection[i].height,
						thisSidebarWidth = objectsCollection[i].width,
						thisSidebarHolder = objectsCollection[i].sidebarHolder,
						thisSidebarHolderHeight = objectsCollection[i].sidebarHolderHeight;
					
					if (mkdf.body.hasClass('mkdf-fixed-on-scroll')) {
						var fixedHeader = $('.mkdf-fixed-wrapper.fixed');
						
						if (fixedHeader.length) {
							headerHeight = fixedHeader.outerHeight() + mkdfGlobalVars.vars.mkdfAddForAdminBar;
						}
					} else if (mkdf.body.hasClass('mkdf-no-behavior')) {
						headerHeight = mkdfGlobalVars.vars.mkdfAddForAdminBar;
					}
					
					if (mkdf.windowWidth > 1024 && thisSidebarHolder.length) {
						var sidebarPosition = -(thisWidgetTopPosition - headerHeight),
							sidebarHeight = thisSidebarHeight - thisWidgetTopPosition - 40; // 40 is bottom margin of widget holder
						
						//move sidebar up when hits the end of section row
						var rowSectionEndInViewport = thisSidebarHolderHeight + thisWidgetTopOffset - headerHeight - thisWidgetTopPosition - mkdfGlobalVars.vars.mkdfTopBarHeight;
						
						if ((mkdf.scroll >= thisWidgetTopOffset - headerHeight) && thisSidebarHeight < thisSidebarHolderHeight) {
							if (thisSidebarHolder.hasClass('mkdf-sticky-sidebar-appeared')) {
								thisSidebarHolder.css({'top': sidebarPosition + 'px'});
							} else {
								thisSidebarHolder.addClass('mkdf-sticky-sidebar-appeared').css({
									'position': 'fixed',
									'top': sidebarPosition + 'px',
									'width': thisSidebarWidth,
									'margin-top': '-10px'
								}).animate({'margin-top': '0'}, 200);
							}
							
							if (mkdf.scroll + sidebarHeight >= rowSectionEndInViewport) {
								var absBottomPosition = thisSidebarHolderHeight - sidebarHeight + sidebarPosition - headerHeight;
								
								thisSidebarHolder.css({
									'position': 'absolute',
									'top': absBottomPosition + 'px'
								});
							} else {
								if (thisSidebarHolder.hasClass('mkdf-sticky-sidebar-appeared')) {
									thisSidebarHolder.css({
										'position': 'fixed',
										'top': sidebarPosition + 'px'
									});
								}
							}
						} else {
							thisSidebarHolder.removeClass('mkdf-sticky-sidebar-appeared').css({
								'position': 'relative',
								'top': '0',
								'width': 'auto'
							});
						}
					} else {
						thisSidebarHolder.removeClass('mkdf-sticky-sidebar-appeared').css({
							'position': 'relative',
							'top': '0',
							'width': 'auto'
						});
					}
				});
			}
		}
		
		return {
			init: function () {
				addObjectItems();
				initStickySidebarWidget();
				
				$(window).scroll(function () {
					initStickySidebarWidget();
				});
			},
			reInit: initStickySidebarWidget
		};
	}
	
	/**
	 * Init Owl Carousel
	 */
	function mkdfOwlSlider() {
		var sliders = $('.mkdf-owl-slider');
		
		if (sliders.length) {
			sliders.each(function () {
				var slider = $(this),
					owlSlider = $(this),
					slideItemsNumber = slider.children().length,
					numberOfItems = 1,
					loop = true,
					autoplay = true,
					autoplayHoverPause = true,
					sliderSpeed = 5000,
					sliderSpeedAnimation = 600,
					margin = 0,
					responsiveMargin = 0,
					responsiveMargin1 = 0,
					stagePadding = 0,
					stagePaddingEnabled = false,
					center = false,
					autoWidth = false,
					animateInClass = false, // keyframe css animation
					animateOutClass = false, // keyframe css animation
					navigation = true,
					pagination = false,
					thumbnail = false,
					thumbnailSlider,
					sliderIsCPTList = !!slider.hasClass('mkdf-list-is-slider'),
					sliderDataHolder = sliderIsCPTList ? slider.parent() : slider;  // this is condition for cpt to set list to be slider
				
				if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && !sliderIsCPTList) {
					numberOfItems = slider.data('number-of-items');
				}
				if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsCPTList) {
					switch (sliderDataHolder.data('number-of-columns')) {
						case 'one':
							numberOfItems = 1;
							break;
						case 'two':
							numberOfItems = 2;
							break;
						case 'three':
							numberOfItems = 3;
							break;
						case 'four':
							numberOfItems = 4;
							break;
						case 'five':
							numberOfItems = 5;
							break;
						case 'six':
							numberOfItems = 6;
							break;
						default :
							numberOfItems = 4;
							break;
					}
				}
				if (sliderDataHolder.data('enable-loop') === 'no') {
					loop = false;
				}
				if (sliderDataHolder.data('enable-autoplay') === 'no') {
					autoplay = false;
				}
				if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'no') {
					autoplayHoverPause = false;
				}
				if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
					sliderSpeed = sliderDataHolder.data('slider-speed');
				}
				if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
					sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
				}
				if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
					if (sliderDataHolder.data('slider-margin') === 'no') {
						margin = 0;
					} else {
						margin = sliderDataHolder.data('slider-margin');
					}
				} else {
					if (slider.parent().hasClass('mkdf-huge-space')) {
						margin = 60;
					} else if (slider.parent().hasClass('mkdf-large-space')) {
						margin = 50;
					} else if (slider.parent().hasClass('mkdf-medium-space')) {
						margin = 40;
					} else if (slider.parent().hasClass('mkdf-normal-space')) {
						margin = 30;
					} else if (slider.parent().hasClass('mkdf-small-space')) {
						margin = 20;
					} else if (slider.parent().hasClass('mkdf-tiny-space')) {
						margin = 10;
					}
				}
				if (sliderDataHolder.data('slider-padding') === 'yes') {
					stagePaddingEnabled = true;
					stagePadding = parseInt(slider.outerWidth() * 0.28);
					margin = 50;
				}
				if (sliderDataHolder.data('enable-center') === 'yes') {
					center = true;
				}
				if (sliderDataHolder.data('enable-auto-width') === 'yes') {
					autoWidth = true;
				}
				if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
					animateInClass = sliderDataHolder.data('slider-animate-in');
				}
				if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
					animateOutClass = sliderDataHolder.data('slider-animate-out');
				}
				if (sliderDataHolder.data('enable-navigation') === 'no') {
					navigation = false;
				}
				if (sliderDataHolder.data('enable-pagination') === 'yes') {
					pagination = true;
				}
				
				if (sliderDataHolder.data('enable-thumbnail') === 'yes') {
					thumbnail = true;
				}
				
				if (thumbnail && !pagination) {
					/* page.index works only when pagination is enabled, so we add through html, but hide via css */
					pagination = true;
					owlSlider.addClass('mkdf-slider-hide-pagination');
				}
				
				if (navigation && pagination) {
					slider.addClass('mkdf-slider-has-both-nav');
				}
				
				if (slideItemsNumber <= 1) {
					loop = false;
					autoplay = false;
					navigation = false;
					pagination = false;
				}
				
				var responsiveNumberOfItems1 = 1,
					responsiveNumberOfItems2 = 2,
					responsiveNumberOfItems3 = 3,
					responsiveNumberOfItems4 = numberOfItems,
					responsiveNumberOfItems5 = numberOfItems;
				
				if (numberOfItems < 3) {
					responsiveNumberOfItems2 = numberOfItems;
					responsiveNumberOfItems3 = numberOfItems;
				}
				
				if (numberOfItems > 4) {
					responsiveNumberOfItems4 = 4;
				}
				
				if (numberOfItems > 5) {
					responsiveNumberOfItems5 = 5;
				}
				
				if (stagePaddingEnabled || margin > 30) {
					responsiveMargin = 20;
					responsiveMargin1 = 30;
				}
				
				if (margin > 0 && margin <= 30) {
					responsiveMargin = margin;
					responsiveMargin1 = margin;
				}
				
				slider.waitForImages(function () {
					owlSlider = slider.owlCarousel({
						items: numberOfItems,
						loop: loop,
						autoplay: autoplay,
						autoplayHoverPause: autoplayHoverPause,
						autoplayTimeout: sliderSpeed,
						smartSpeed: sliderSpeedAnimation,
						margin: margin,
						stagePadding: stagePadding,
						center: center,
						autoWidth: autoWidth,
						animateIn: animateInClass,
						animateOut: animateOutClass,
						dots: pagination,
						nav: navigation,
						navText: [
							'<span class="mkdf-prev-icon mkdf-icon-dripicons dripicon dripicons-chevron-left mkdf-icon-element"></span>',
							'<span class="mkdf-next-icon mkdf-icon-dripicons dripicon dripicons-chevron-right mkdf-icon-element"></span>'
						],
						responsive: {
							0: {
								items: responsiveNumberOfItems1,
								margin: responsiveMargin,
								stagePadding: 0,
								center: false,
								autoWidth: false
							},
							681: {
								items: responsiveNumberOfItems2,
								margin: responsiveMargin1
							},
							769: {
								items: responsiveNumberOfItems3,
								margin: responsiveMargin1
							},
							1025: {
								items: responsiveNumberOfItems4
							},
							1281: {
								items: responsiveNumberOfItems5
							},
							1367: {
								items: numberOfItems
							}
						},
						onInitialize: function () {
							slider.css('visibility', 'visible');
							mkdfInitParallax();
							if (thumbnail) {
								thumbnailSlider.find('.mkdf-slider-thumbnail-item:first-child').addClass('active');
							}
						},
						onTranslate: function (e) {
							if (thumbnail) {
								var index = e.page.index + 1;
								thumbnailSlider.find('.mkdf-slider-thumbnail-item.active').removeClass('active');
								thumbnailSlider.find('.mkdf-slider-thumbnail-item:nth-child(' + index + ')').addClass('active');
							}
						},
						onDrag: function (e) {
							if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
								var sliderIsMoving = e.isTrigger > 0;
								
								if (sliderIsMoving) {
									slider.addClass('mkdf-slider-is-moving');
								}
							}
						},
						onDragged: function () {
							if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout') && slider.hasClass('mkdf-slider-is-moving')) {
								
								setTimeout(function () {
									slider.removeClass('mkdf-slider-is-moving');
								}, 500);
							}
						}
					});
				});
				
				if (thumbnail) {
					thumbnailSlider = slider.parent().find('.mkdf-slider-thumbnail');
					
					var numberOfThumbnails = parseInt(thumbnailSlider.data('thumbnail-count'));
					var numberOfThumbnailsClass = '';
					
					switch (numberOfThumbnails % 6) {
						case 2 :
							numberOfThumbnailsClass = 'two';
							break;
						case 3 :
							numberOfThumbnailsClass = 'three';
							break;
						case 4 :
							numberOfThumbnailsClass = 'four';
							break;
						case 5 :
							numberOfThumbnailsClass = 'five';
							break;
						case 0 :
							numberOfThumbnailsClass = 'six';
							break;
						default :
							numberOfThumbnailsClass = 'six';
							break;
					}
					
					if (numberOfThumbnailsClass !== '') {
						thumbnailSlider.addClass('mkdf-slider-columns-' + numberOfThumbnailsClass);
					}
					
					thumbnailSlider.find('.mkdf-slider-thumbnail-item').on('click', function () {
						$(this).siblings('.active').removeClass('active');
						$(this).addClass('active');
						owlSlider.trigger('to.owl.carousel', [$(this).index(), sliderSpeedAnimation]);
					});
				}
			});
		}
	}
	
	function mkdfDashboardForm() {
		var forms = $('.mkdf-dashboard-form');
		
		if (forms.length) {
			forms.each(function () {
				var thisForm = $(this),
					btnText = thisForm.find('button'),
					updatingBtnText = btnText.data('updating-text'),
					updatedBtnText = btnText.data('updated-text'),
					actionName = thisForm.data('action');
				
				thisForm.on('submit', function (e) {
					e.preventDefault();
					var prevBtnText = btnText.html(),
						gallery = $(this).find('.mkdf-dashboard-gallery-upload-hidden'),
						namesArray = [];
					
					btnText.html(updatingBtnText);
					
					//get data
					var formData = new FormData();
					
					//get files
					gallery.each(function () {
						var thisGallery = $(this),
							thisName = thisGallery.attr('name'),
							thisRepeaterID = thisGallery.attr('id'),
							thisFiles = thisGallery[0].files,
							newName;
						
						//this part is needed for repeater with image uploads
						//adding specific names so they can be sorted in regular files and files in repeater
						if (thisName.indexOf("[") !== '-1') {
							newName = thisName.substring(0, thisName.indexOf("[")) + '_mkdf_regarray_';
							
							var firstIndex = thisRepeaterID.indexOf('['),
								lastIndex = thisRepeaterID.indexOf(']'),
								index = thisRepeaterID.substring(firstIndex + 1, lastIndex);
							
							namesArray.push(newName);
							newName = newName + index + '_';
						} else {
							newName = thisName + '_mkdf_reg_';
						}
						
						//if file not sent, send dummy file - so repeater fields are sent
						if (thisFiles.length === 0) {
							formData.append(newName, new File([""], "mkdf-dummy-file.txt", {
								type: "text/plain"
							}));
						}
						
						for (var i = 0; i < thisFiles.length; i++) {
							var allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'application/pdf'];
							//security purposed - check if there is more than one dot in file name, also check whether the file type is in allowed types
							if (thisFiles[i].name.match(/\./g).length === 1 && $.inArray(thisFiles[i].type, allowedTypes) !== -1) {
								formData.append(newName + i, thisFiles[i]);
							}
						}
					});
					
					formData.append('action', actionName);
					
					//get data from form
					var otherData = $(this).serialize();
					formData.append('data', otherData);
					
					$.ajax({
						type: 'POST',
						data: formData,
						contentType: false,
						processData: false,
						url: mkdfGlobalVars.vars.mkdfAjaxUrl,
						success: function (data) {
							var response;
							response = JSON.parse(data);
							
							// append ajax response html
							mkdf.modules.socialLogin.mkdfRenderAjaxResponseMessage(response);
							if (response.status === 'success') {
								btnText.html(updatedBtnText);
								window.location = response.redirect;
							} else {
								btnText.html(prevBtnText);
							}
						}
					});
					
					return false;
				});
			});
		}
	}
	
	/**
	 * Init Perfect Scrollbar
	 */
	function mkdfInitPerfectScrollbar() {
		var defaultParams = {
			wheelSpeed: 0.6,
			suppressScrollX: true
		};
		
		var mkdfInitScroll = function (holder) {
			var ps = new PerfectScrollbar(holder.selector, defaultParams);
			$(window).resize(function () {
				ps.update();
			});
		};
		
		return {
			init: function (holder) {
				mkdfInitScroll(holder);
			}
		};
	}
	
	/**
	 * Init Parallax Items
	 */
	function mkdfInitParallaxElements() {
		var parallaxIntances = $("[data-parallax]");
		
		if (parallaxIntances.length && !mkdf.htmlEl.hasClass('touch')) {
			ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
		}
	}
	
	/*
    * Init Element in View
    */
	function mkdfElementInView(element) {
		$(window).scroll(function () {
			if (mkdf.scroll > element.offset().top - mkdf.windowHeight && mkdf.scroll < element.offset().top + element.height()) {
				if (!element.hasClass('mkdf-in-view')) {
					element.addClass('mkdf-in-view');
				}
			} else {
				if (element.hasClass('mkdf-in-view')) {
					element.removeClass('mkdf-in-view');
				}
			}
		});
	}
	
	/**
	 * Dynamic Background Color
	 */
	function mkdfDynamicBackgroundColor() {
		
		//elementor addon
		var elementorInput = $('.mikado-dynamic-background-helper-holder');
		
		elementorInput.each(function () {
			var currentColor = $(this).data('dynamic-bgrnd');
			$(this).parent().attr('data-dynamic-bgrnd', currentColor);
		});
		
		var bgrndIntances = $("[data-dynamic-bgrnd]");
		
		if (bgrndIntances.length) {
			
			if ( $('#mkdf-dynamic-bgrnds').length ) {
				// nothing
			} else {
				$('.mkdf-content-inner').append('<div id="mkdf-dynamic-bgrnds"></div>');
			}
			
			var holder = $('#mkdf-dynamic-bgrnds'),
				scrollBuffer = mkdf.scroll,
				scrollingDown = true,
				currentScroll, instancesInView, activeEl;
			
			//add bgrnd divs
			bgrndIntances.each(function () {
				mkdfElementInView($(this));
			});
			
			//calculate scroll direction
			var scrollDirection = function () {
				currentScroll = mkdf.scroll;
				
				if (currentScroll > scrollBuffer) {
					scrollingDown = true;
				} else {
					scrollingDown = false;
				}
				scrollBuffer = currentScroll;
			};
			
			holder.css('background-color', bgrndIntances.first().attr('data-dynamic-bgrnd'));
			
			//colors change logic
			$(window).on('scroll', function () {
				scrollDirection();
				instancesInView = bgrndIntances.filter('.mkdf-in-view');
				
				if (instancesInView.length) {
					if (scrollingDown) {
						activeEl = instancesInView.last();
					} else {
						activeEl = instancesInView.first();
					}
					
					holder.css('background-color') !== activeEl.attr('data-dynamic-bgrnd') &&
					holder.css('background-color', activeEl.attr('data-dynamic-bgrnd'));
				}
			});
		}
	}
	
})(jQuery);