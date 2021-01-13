(function($) {
    'use strict';

    var verticalShowcase = {};
    mkdf.modules.verticalShowcase = verticalShowcase;
    
    verticalShowcase.mkdfInitVerticalShowcase = mkdfInitVerticalShowcase;
    verticalShowcase.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitVerticalShowcase();
    }
	
	/*
    All functions to be called on $(window).load() should be in this function
    */
	function mkdfOnWindowLoad() {
		mkdfElementorInitVerticalShowcase();
	}
	
	/**
	 * Elementor
	 */
	function mkdfElementorInitVerticalShowcase(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_elementor_vertical_showcase.default', function() {
				mkdfInitVerticalShowcase();
			} );
		});
	}

    /**
     * Init vertical showcase shortcode
     */
    function mkdfInitVerticalShowcase() {
        var verticalShowcase = $('.mkdf-vertical-showcase');
    
        if (verticalShowcase.length) {
            verticalShowcase.each(function () {
                var holder = $(this),
                    pasepartuWrapper = $('.mkdf-wrapper'),
                    item = holder.find('.mkdf-vs-item'),
                    stripe = holder.find('.mkdf-vs-stripe'),
                    frameImage = holder.find('.mkdf-vs-inner-frame'),
                    frameInfo = holder.find('.mkdf-vs-frame-info'),
                    frameSlideText = frameInfo.find('.mkdf-vs-frame-slide-text'),
                    frameSlideNumber= frameInfo.find('.mkdf-vs-frame-slide-number'),
                    frameTitleImage = frameInfo.find('.mkdf-vs-frame-title-image'),
                    frameTitle = frameInfo.find('.mkdf-vs-frame-title'),
                    frameSubtitle = frameInfo.find('.mkdf-vs-frame-subtitle'),
                    swiperInstance = holder.find('.swiper-container'),
                    swiperSlide = swiperInstance.find('.swiper-slide'),
                    lastSlide = swiperSlide.length,
                    secondLastSlide = lastSlide - 1,
                    indexCounter = 1,
                    currentActiveIndex,
                    currentActiveSlideText,
                    currentActiveTitleImage,
                    currentActiveTitle,
                    currentActiveSubtitle,
                    onLastSlide = false,
                    frameBgText = frameInfo.find('.mkdf-vs-frame-bg-text .mkdf-vs-frame-bg-text-content'),
                    logoWrapper = $('.mkdf-logo-wrapper');

                var swiperSlider = new Swiper (swiperInstance, {
                    loop: false,
                    direction: 'vertical',
                    slidesPerView: 1,
                    mousewheel: {
                        invert: false,
                        eventsTarged: holder
                    },
                    touchStartForcePreventDefault: true,
                    speed: 1000,
                    simulateTouch: false,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        renderBullet: function (index, className) {
                            return '<span class="' + className + '"></span>';
                        },
                    },
                    init: false
                });
                
                // Recalculate slider height if paspartu enabled 
                if (mkdf.body.hasClass('mkdf-paspartu-enabled')) {
                    var paspartuPadding = parseInt(pasepartuWrapper.css('padding'));
                    holder.css("height", "calc(100vh - " + paspartuPadding*2 + "px)");
                    swiperInstance.css("height", "calc(100vh - " + paspartuPadding*2 + "px)");
                }

                if (mkdf.windowWidth < 1025) {
                    var headerHeight = $('.mkdf-mobile-header-inner').css('height');
                    holder.css("height", "calc(100vh - " + headerHeight + ")");
                    swiperInstance.css("height", "calc(100vh - " + headerHeight + ")");
                    pasepartuWrapper.css('padding', 0);
                }

                logoWrapper.addClass('mkdf-logo-wrapper-vertical-showcase mkdf-vs-frame-even');

                holder.waitForImages(function() {
                    swiperSlider.init();
                    var rotateDegrees = 0;
                    var swiperPagination = holder.find('.swiper-pagination');
                    var swiperPaginationBullet = swiperPagination.find('.swiper-pagination-bullet');

                    swiperSlide.each(function() {
                        $(this).attr('slide-index', indexCounter);
                        $(this).data('slide-index', indexCounter);
                        var imgSrc = $(this).find('.mkdf-vs-item>img').attr('src'),
                            imgAlt = $(this).find('.mkdf-vs-item>img').attr('alt');
                        if (imgSrc !== undefined) {
                            frameImage.append('<div><img src="'+ imgSrc +'" alt="'+ imgAlt +'"></div>')
                        }
                        indexCounter++;
                    });

                    frameImage.find('div:first-child').addClass('active');

                    function enableAdjacentPagination() {
                        var activeBullet = swiperPagination.find('.swiper-pagination-bullet-active');
                        swiperPaginationBullet.removeClass('bullet-clickable');
                        activeBullet.addClass('bullet-clickable');
                        activeBullet.next().addClass('bullet-clickable');
                        activeBullet.prev().addClass('bullet-clickable');
                    }

                    // function find active item
                    function findActiveItem() {
                        currentActiveIndex = swiperInstance.find('.swiper-slide-active').data('slide-index');
                        currentActiveSlideText = swiperInstance.find('.swiper-slide-active .mkdf-vs-item-slide-text').text();
                        currentActiveTitleImage = swiperInstance.find('.swiper-slide-active .mkdf-vs-item-title-image').html();
                        currentActiveTitle = swiperInstance.find('.swiper-slide-active .mkdf-vs-item-title').text();
                        currentActiveSubtitle = swiperInstance.find('.swiper-slide-active .mkdf-vs-item-subtitle').text();
                    }

                    function initBgText() {
                        if (frameBgText.length) {
                            var frameBgTextText = frameBgText.text(),
                                frameBgTextTextArray = frameBgTextText.split("");

                            frameBgText.empty();
        
                            frameBgTextTextArray.forEach(function(i) {
                                frameBgText.append(
                                    '<span class="mkdf-vs-frame-bg-text-char">' + i + "</span>"
                                );
                            });

                            setTimeout(function() {
                                frameBgText.css('opacity', 1);
                            }, 100);
                        }
                    }

                    function animateBgTextIn() {
                        if (frameBgText.length) {
                            frameBgText.find("span").each(function(i) {
                                var thisChar = $(this);
                                setTimeout(function() {
                                    thisChar.addClass('mkdf-show');
                                }, i * 50)
                            });
                        }
                    }

                    function animateBgTextOut() {
                        if (frameBgText.length) {
                            frameBgText.find("span").each(function(i) {
                                var thisChar = $(this);
                                setTimeout(function() {
                                    thisChar.removeClass('mkdf-show');
                                }, i * 0)
                            });
                        }
                    }

                    function animateFrameImages() {
                        frameImage.find('div').removeClass('prev-active')
                        frameImage.find('div.active').removeClass('active').addClass('prev-active');
                        frameImage.find('div:nth-child('+ currentActiveIndex +')').addClass('active');
                    }

                    function updateFrameInfo() {
                        frameSlideText.text(currentActiveSlideText);
                        frameSlideNumber.text('0' + currentActiveIndex);
	                    frameTitleImage.html(currentActiveTitleImage);
	                    frameTitle.text(currentActiveTitle);
                        frameSubtitle.text(currentActiveSubtitle);
                    }

                    function readyAnimation() {
                        setTimeout(function() {
                            frameInfo.removeClass("mkdf-vs-frame-animate-out");
                        }, 700);
                        holder.removeClass("mkdf-vs-ready-animation");
                    }

                    // Initialize frame info when slider is ready
                    findActiveItem();
                    updateFrameInfo();
                    enableAdjacentPagination();
                    initBgText();

                    setTimeout(function() {
                        readyAnimation();
                    }, 500); 

                    setTimeout(function() {
                        animateBgTextIn();
                        logoWrapper.removeClass('mkdf-vs-frame-even');
                        logoWrapper.css('opacity', 1);
                    }, 1000);

                    swiperSlider.on('slideNextTransitionStart', function() {
                        if ( currentActiveIndex !== lastSlide ) {
                            rotateDegrees+=180;
                            stripe.css('transform', 'rotate('+ rotateDegrees +'deg)');
                        }
                    });

                    swiperSlider.on('slidePrevTransitionStart', function() {
	                    if ( currentActiveIndex !== lastSlide - 1 ) {
		                    rotateDegrees-=180;
                            stripe.css('transform', 'rotate('+ rotateDegrees +'deg)');
	                    }
                    });
	
	                // swiperSlider.on('slideNextTransitionStart', function() {
		             //    if (!onLastSlide) {
			         //        rotateDegrees+=180;
			         //        stripe.css('transform', 'rotate('+ rotateDegrees +'deg)');
		             //    }
	                // });
	                //
	                // swiperSlider.on('slidePrevTransitionStart', function() {
		             //    if (currentActiveIndex !== secondLastSlide) {
			         //        rotateDegrees-=180;
			         //        stripe.css('transform', 'rotate('+ rotateDegrees +'deg)');
		             //    }
	                // });

                    swiperSlider.on('slideChangeTransitionStart', function() {
                        findActiveItem();
                        enableAdjacentPagination();
                        animateFrameImages();

                        if (currentActiveIndex == lastSlide) {
                            onLastSlide = true;
                            holder.addClass("mkdf-vs-last-slide");
                            logoWrapper.addClass("mkdf-vs-last-slide");
                            animateBgTextOut();
                        } else {
                            onLastSlide = false;
                            holder.removeClass("mkdf-vs-last-slide");
                            logoWrapper.removeClass("mkdf-vs-last-slide");
                        }

                        if (!onLastSlide) {
                            animateBgTextOut();
                            frameInfo.addClass("mkdf-vs-frame-animate-out");

                            setTimeout(function() {
                                if (currentActiveIndex % 2 == 0) {
                                    logoWrapper.addClass("mkdf-vs-frame-even");
                                } else {
                                    logoWrapper.removeClass("mkdf-vs-frame-even");
                                }
                            }, 400);
                        
                            setTimeout(function() {
                                // if even slide move the frame info down
                                if (currentActiveIndex % 2 == 0) {
                                    frameInfo.addClass("mkdf-vs-frame-even");
                                } else {
                                    frameInfo.removeClass("mkdf-vs-frame-even");
                                }
                                updateFrameInfo();
                                setTimeout(function() {
                                    animateBgTextIn();
                                }, 100);
                                frameInfo.removeClass("mkdf-vs-frame-animate-out");
                            }, 700);
                        }
                    });
                });
            });
        }
    }

    
})(jQuery);