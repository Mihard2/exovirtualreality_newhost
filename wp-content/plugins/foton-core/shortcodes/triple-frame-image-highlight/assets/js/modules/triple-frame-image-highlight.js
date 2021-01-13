(function($) {
    'use strict';

    var tripleFrameImageHighlight = {};
    mkdf.modules.tripleFrameImageHighlight = tripleFrameImageHighlight;

    tripleFrameImageHighlight.mkdfOnDocumentReady = mkdfOnDocumentReady;
    tripleFrameImageHighlight.mkdfTripleFrameImageHighlight = mkdfTripleFrameImageHighlight;

    $(document).ready(mkdfOnDocumentReady);
	$(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
    function mkdfOnDocumentReady() {
        mkdfTripleFrameImageHighlight();
    }
	
	/*
	All functions to be called on $(window).load() should be in this function
	*/
	function mkdfOnWindowLoad() {
		mkdfElementorTripleFrameImageHighlight();
	}
	
	/**
	 * Elementor
	 */
	function mkdfElementorTripleFrameImageHighlight(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_elementor_triple_frame_image_highlight.default', function() {
				mkdfTripleFrameImageHighlight();
			} );
		});
	}

    /**
     * Triple Frame Image Highlight
     */
    function mkdfTripleFrameImageHighlight() {
        var tfihShortcodes = $('.mkdf-triple-frame-image-highlight');

        if (tfihShortcodes.length) {
            var initClasses = function(c, l, r) {
                c.addClass('mkdf-c');
                l.addClass('mkdf-l');
                r.addClass('mkdf-r');
            }

            var resetIndexes = function(c, l, r) {
                c.css('z-index', 30);
                l.css('z-index', 20);
                r.css('z-index', 20);
            }

            var setTriggerSize = function(holder,inner) {
                holder.find('div[class*="trigger"]').width(Math.round(inner.position().left));
            }

            var setPositioning = function(holder, inner) {
                var left = holder.find('.mkdf-l'),
                    right = holder.find('.mkdf-r'),
                    centered = holder.find('.mkdf-c');

                var xOffset = inner.position().left;

                left.css({
                    'visibility': 'visible',
                    'transform-origin': '0% 50%',
                    'transform': 'matrix(.68,0,0,.68,-'+xOffset+',0)'
                });
                right.css({
                    'visibility': 'visible',
                    'transform-origin': '100% 50%',
                    'transform': 'matrix(.68,0,0,.68,'+xOffset+',0)'
                });
                centered.css({
                    'transform': 'matrix(1, 0, 0, 1, 0, 0)'
                });
            }

            var rotateAnimation = function(holder, inner, direction) {
                holder.data('animating', true);

                if (direction == 'left') {
                    var toFront = holder.find('.mkdf-l'),
                        toBack = holder.find('.mkdf-c'),
                        toPrep = holder.find('.mkdf-r');

                    toPrep.removeClass('mkdf-r').addClass('mkdf-l');
                    toBack.removeClass('mkdf-c').addClass('mkdf-r');
                    toFront.removeClass('mkdf-l').addClass('mkdf-c');
                } else {
                    var toFront = holder.find('.mkdf-r'),
                        toBack = holder.find('.mkdf-c'),
                        toPrep = holder.find('.mkdf-l');

                    toPrep.removeClass('mkdf-l').addClass('mkdf-r');
                    toBack.removeClass('mkdf-c').addClass('mkdf-l');
                    toFront.removeClass('mkdf-r').addClass('mkdf-c');
                }

                toPrep.css({
                    'z-index': 15,
                    'transform-origin': '0% 50%',
                    'transition': 'transform .5s, transform-origin .5s'
                });
                toBack.css({
                    'z-index': 25,
                    'transform-origin': '100% 50%',
                    'transition': 'transform 1s cubic-bezier(0.19, 1, 0.22, 1) .2s, \
                                    transform-origin 1s cubic-bezier(0.19, 1, 0.22, 1) .2s'
                });
                toFront.css({
                    'z-index': 20,
                    'transform-origin': '50% 50%',
                    'transition': 'transform .75s cubic-bezier(0.86, 0, 0.07, 1) .5s, \
                                    transform-origin .75s cubic-bezier(0.86, 0, 0.07, 1) .5s'
                });

                holder.find('a').css('pointer-events', 'none');
                setTimeout(function() {
                    holder.find('a').css('pointer-events', 'auto');
                    resetIndexes(toFront, toPrep, toBack);
                }, 500);

                toFront.one(mkdf.transitionEnd, function() {
                    holder.data('animating', false);
                    clearInterval(holder.data('autoplay'));
                    holder.data('autoplay', setInterval(function() {
                        navigate(holder, inner);
                    }, 3000));
                })
            }

            var navigate = function(holder, inner, event) {
                var direction,
                    linkActive = false;

                if (typeof event !== 'undefined') {
                    switch(event.target.className) {
                        case 'mkdf-tfih-left-trigger':
                            direction = 'left';
                            break;
                        case 'mkdf-tfih-right-trigger':
                            direction = 'right';
                            break;
                        case 'mkdf-tfih-link':
                            linkActive = true;
                            holder.data('animating', false);
                            clearInterval(holder.data('autoplay'));
                            break;
                    }
                } else {
                    direction = 'right';
                }

                if (!linkActive) {
                    rotateAnimation(holder, inner, direction)
                    setPositioning(holder, inner);
                }
            }

            tfihShortcodes.each(function() {
                var holder = $(this),
                    inner = holder.find('.mkdf-tfih-inner'),
                    centeredH = holder.find('.mkdf-tfih-centered-image-holder'),
                    leftH = holder.find('.mkdf-tfih-left-image-holder'),
                    rightH = holder.find('.mkdf-tfih-right-image-holder');

                //state
                holder
                    .data('animating', false)
                    .data('autoplay', false);

                initClasses(centeredH, leftH, rightH);
                resetIndexes(centeredH, leftH, rightH);
                setTriggerSize(holder, inner);

                holder.waitForImages(function() {
                    holder.appear(function() {
                        holder.css('visibility', 'visible');
                        setPositioning(holder, inner);
                        holder.data('autoplay', setInterval(function() {
                            navigate(holder, inner);
                        }, 3000));
                    }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
                });

                holder.on('click', function(event) {
                    if (!holder.data('animating')) {
                        clearInterval(holder.data('autoplay'));
                        navigate(holder, inner, event);
                    }
                });

                if (holder.parent().hasClass('mkdf-tfih-with-nav')) {
                    var left = holder.parent().find('.mkdf-tfih-left'),
                        right = holder.parent().find('.mkdf-tfih-right');

                    left.on('click', function() {
                        if (!holder.data('animating')) {
                            rotateAnimation(holder, inner, 'left')
                            setPositioning(holder, inner);
                        }
                    });

                    right.on('click', function() {
                        if (!holder.data('animating')) {
                            rotateAnimation(holder, inner, 'right')
                            setPositioning(holder, inner);
                        }
                    });
                }

                $(window).on('resize', function() {
                    setPositioning(holder, inner);
                    setTriggerSize(holder, inner);
                    inner.find('>div').css('transition', 'none');
                })
            });
        }
    }
})(jQuery);
