/**
 * Theme functions file
 */
(function ($) {
    'use strict';

    var $document = $(document);
    var $window = $(window);


    /**
     * Document ready (jQuery)
     */
    $(function () {
        /**
         * Header style.
         */
        if ($('.slides > li, .single .has-post-cover, .page .has-post-cover').length) {
            $('.navbar').addClass('page-with-cover');
        } else {
            $('.navbar').removeClass('page-with-cover');
        }

        /**
         * Activate superfish menu.
         */
        $('.sf-menu').superfish({
            'speed': 'fast',

            'animation': {
                'height': 'show'
            },
            'animationOut': {
                'height': 'hide'
            }
        });

        /**
         * Activate main slider.
         */
        $('#slider').sllider();

        /**
         *
         */
        $.fn.fullWidthContent();
        $.fn.responsiveSliderImages();
        $.fn.paralised();
        $.fn.sideNav();
        $.fn.singlePageWidgetBackground();

        /**
         * Portfolio items popover.
         */
        $('.portfolio-archive .portfolio_item').thumbnailPopover();
        $('.portfolio-showcase .portfolio_item').thumbnailPopover();
        $('.portfolio-scroller .portfolio_item').thumbnailPopover();

        /**
         * Isotope filter for Portfolio Isotope template.
         */
        $('.portfolio-taxonomies-filter-by').portfolioIsotopeFilter();

        /**
         * Clickable divs.
         */
        $('.clickable').on('click', function () {
            window.location.href = $(this).data('href');
        });

        /**
         * Portfolio infinite loading support.
         */
        var $folioitems = $('.portfolio-grid');
        if (typeof wpz_currPage != 'undefined' && wpz_currPage < wpz_maxPages) {
            $('.navigation').empty().append('<a class="btn btn-primary" id="load-more" href="#">Load More&hellip;</a>');

            $('#load-more').on('click', function () {
                if (wpz_currPage < wpz_maxPages) {
                    $(this).text('Loading...');
                    wpz_currPage++;

                    $.get(wpz_pagingURL + wpz_currPage + '/', function (data) {
                        var $newItems = $('.portfolio-grid article', data).addClass('hidden').hide();

                        $folioitems.append($newItems);
                        $folioitems.find('article.hidden').fadeIn().removeClass('hidden');

                        if ((wpz_currPage + 1) <= wpz_maxPages) {
                            $('#load-more').text('Load More\u2026');
                        } else {
                            $('#load-more').animate({height: 'hide', opacity: 'hide'}, 'slow', function () {
                                $(this).remove();
                            });
                        }
                    });
                }
                return false;
            });
        }
    });

    $.fn.thumbnailPopover = function () {
        return this.on('mousemove', function (event) {
            var $this = $(this);
            var $popoverContent = $this.find('.entry-thumbnail-popover-content');

            var itemHeight = $this.outerHeight();
            var contentHeight = $popoverContent.outerHeight();
            var y = event.pageY - $this.offset().top;

            if (contentHeight <= itemHeight) {
                $popoverContent.addClass('popover-content--animated');
                $popoverContent.css('bottom', '');
                return;
            }

            $popoverContent.removeClass('popover-content--animated');

            $popoverContent.css({
                'bottom': (1 - y / itemHeight) * (itemHeight - contentHeight)
            });
        });
    };

    $.fn.sllider = function () {
        return this.each(function () {
            var $this = $(this);
            var userAgent = navigator.userAgent || navigator.vendor || window.opera;
            var handHeldDevice = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(userAgent));

            $this.flexslider({
                controlNav: false,
                directionNav: true,
                animationLoop: true,
                useCSS: true,
                smoothHeight: false,
                touch: true,
                pauseOnAction: true,
                slideshow: zoomOptions.slideshow_auto,
                animation: zoomOptions.slideshow_effect.toLowerCase(),
                slideshowSpeed: parseInt(zoomOptions.slideshow_speed, 10),
                start: videoBackground,
                before: videoBackground,
                after: videoBackgroundCleanup
            });

            $window.on('resize focus', dynamicHeight);
            dynamicHeight();

            $window.on('resize', resizeVideo);
            resizeVideo();

            $('#scroll-to-content').on('click', function () {
                $('html, body').animate({
                    scrollTop: $('#slider').offset().top + $('#slider').outerHeight()
                }, 600);
            });

            function dynamicHeight() {
                var height = $(window).height() - $('#slider').offset().top - parseInt($('#slider').css('padding-top'), 10);

                /* use different min-height for different borwser widths */
                if (height < 300) {
                    height = 300;
                } else if (height < 500 && $window.width() > 768) {
                    height = 500;
                }

                $this.find('.slides, .slides > li').height(height);
            }

            function videoBackground(slider) {
                /* Insert new video */
                var index = slider.animatingTo;
                var slide = slider.slides.get(index);

                if (handHeldDevice) {
                    $(slide).find('.li-wrap').fadeIn();
                }

                var mp4 = $(slide).find('.video-background').data('mp4');
                var webm = $(slide).find('.video-background').data('webm');

                if (mp4 || webm) {
                    var $video = $('<video autoplay loop muted>');

                    if (mp4) {
                        var $mp4Src = $('<source>').attr('src', mp4).attr('type', 'video/mp4');
                        $video.append($mp4Src);
                    }

                    if (webm) {
                        var $webmSrc = $('<source>').attr('src', webm).attr('type', 'video/webm');
                        $video.append($webmSrc);
                    }

                    if (/iPad/i.test(userAgent)) {
                        $video.attr('controls', 'controls');
                    }

                    $video.appendTo($(slide).find('.video-background'));

                    $video.on('loadedmetadata', function () {
                        $video.data('loadedmetadata', true);

                        if (handHeldDevice) {
                            $(slide).find('.slide-background-overlay').remove();
                            $(slide).find('.li-wrap').fadeOut();
                        }

                        resizeVideo();
                    });

                    $video.on('canplay', function() {
                        $video.css('opacity', 1);
                    });
                }
            }

            function videoBackgroundCleanup(slider) {
                slider.find('.video-background').not($(slider.slides.get(slider.currentSlide)).find('.video-background')).empty();
            }

            function resizeVideo() {
                $this.find('.video-background video').each(function (index, video) {
                    // not ready yet
                    if (!$(video).data('loadedmetadata')) {
                        return;
                    }

                    var videoRatio = video.videoWidth / video.videoHeight;
                    var windowRatio = window.innerWidth / window.innerHeight;

                    if (windowRatio > videoRatio) {
                        video.style.height = 'auto';
                        video.style.width = window.innerWidth + 'px';
                    }
                    else {
                        video.style.width = 'auto';
                        video.style.height = window.innerHeight + 'px';
                    }
                });
            }
        });
    };

    /**
     * Simple Parallax plugin.
     */
    $.fn.paralised = function () {
        var features = {
            bind: !!(function () {
            }.bind),
            rAF: !!(window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame)
        };

        if (typeof features === 'undefined' || !features.rAF || !features.bind) return;

        /**
         * Handles debouncing of events via requestAnimationFrame
         * @see http://www.html5rocks.com/en/tutorials/speed/animations/
         * @param {Function} callback The callback to handle whichever event
         */
        function Debouncer(e) {
            this.callback = e;
            this.ticking = false
        }

        Debouncer.prototype = {
            constructor: Debouncer, update: function () {
                this.callback && this.callback();
                this.ticking = false
            }, requestTick: function () {
                if (!this.ticking) {
                    requestAnimationFrame(this.rafCallback || (this.rafCallback = this.update.bind(this)));
                    this.ticking = true
                }
            }, handleEvent: function () {
                this.requestTick()
            }
        }

        var debouncer = new Debouncer(update.bind(this));

        $(window).on('scroll', debouncer.handleEvent.bind(debouncer));
        debouncer.handleEvent();

        function update() {
            var scrollPos = $(document).scrollTop();

            var $postCover = $('.has-post-cover .entry-cover');
            var $singlePage = $('.featured_page_wrap--with-background');

            if ($postCover.length) {
                var $postCover = $('.entry-cover');
                var postCoverBottom = $postCover.position().top + $postCover.outerHeight();

                if (scrollPos < postCoverBottom) {
                    var x = easeOutSine(scrollPos, 0, 1, postCoverBottom);

                    $postCover.find('.entry-header').css({
                        'bottom': 30 * (1 - x),
                        'opacity': 1 - easeInQuad(scrollPos, 0, 1, postCoverBottom)
                    });
                }
            }

            $singlePage.each(function (i) {
                var $this = $(this);
                var bottom = $this.position().top + $this.outerHeight();

                var inViewport = (scrollPos + $window.height()) > $this.position().top && scrollPos < bottom;

                if (!inViewport) return;

                var x = easeOutSine(scrollPos + $window.height() - $this.position().top, -1, 2, bottom);

                $this.find('.wpzoom-singlepage').css({
                    '-webkit-transform': 'translateY(' + (-x * 80) + 'px)',
                        'moz-transform': 'translateY(' + (-x * 80) + 'px)',
                            'transform': 'translateY(' + (-x * 80) + 'px)'
                });
            });
        }

        function easeOutSine(t, b, c, d) {
            return c * Math.sin(t / d * (Math.PI / 2)) + b;
        }

        function easeInQuad(t, b, c, d) {
            return c * (t /= d) * t + b;
        }
    };

    $.fn.portfolioIsotopeFilter = function () {
        return this.each(function () {
            var $this = $(this);
            var $taxs = $this.find('li');
            var $portfolio = $('.portfolio-grid');

            $(window).load(function () {
                $portfolio.fadeIn().isotope({
                    layoutMode: 'fitRows',
                    itemSelector: 'article'
                }).isotope('layout');
            });

            var tax_filter_regex = /cat-item-([0-9]+)/gi;

            $taxs.on('click', function (event) {
                event.preventDefault();

                $this = $(this);

                $taxs.removeClass('current-cat');
                $this.addClass('current-cat');

                var catID = tax_filter_regex.exec($this.attr('class'));
                tax_filter_regex.lastIndex = 0;

                var filter;
                if (catID === null) {
                    filter = '.type-portfolio_item';
                } else {
                    filter = '.portfolio_' + catID[1] + '_item';
                }

                $portfolio.isotope({
                    'filter': filter
                });
            });
        });
    };

    $.fn.fullWidthContent = function () {
        $(window).on('resize', update);

        function update() {
            var windowWidth = $(window).width();
            var containerWidth = $('.entry-content').width();
            var marginLeft = (windowWidth - containerWidth) / 2;

            $('.fullimg').css({
                'width': windowWidth,
                'margin-left': -marginLeft
            });

            $('.fullimg .wp-caption').css({
                'width': windowWidth
            });
        }

        update();
    };

    $.fn.responsiveSliderImages = function () {
        $(window).on('resize orientationchange', update);

        function update() {
            var windowWidth = $(window).width();

            if (windowWidth <= 680) {
                $('#slider .slides li').each(function () {
                    var bgurl = $(this).css('background-image').match(/^url\(['"]?(.+)["']?\)$/);
                    var smallimg = $(this).data('smallimg');

                    if (bgurl) {
                        bgurl = bgurl[1];
                    }

                    if (bgurl == smallimg) return;

                    $(this).css('background-image', 'url("' + smallimg + '")');
                });
            }

            if (windowWidth > 680) {
                $('#slider .slides li').each(function () {
                    var bgurl = $(this).css('background-image').match(/^url\(['"]?(.+)["']?\)$/);
                    var bigimg = $(this).data('bigimg');

                    if (bgurl) {
                        bgurl = bgurl[1];
                    }

                    if (bgurl == bigimg) return;

                    $(this).css('background-image', 'url("' + bigimg + '")');
                });
            }
        }

        update();
    };

    $.fn.sideNav = function() {
        var wasPlaying = false;

        function toggleNav() {
            $('body').toggleClass('side-nav-open').addClass('side-nav-transitioning');

            var flex = $('#slider').data('flexslider');
            if (flex) {
                if ($('body').hasClass('side-nav-open')) {
                    wasPlaying = flex.playing;
                    if (flex.playing)  {
                        flex.pause();
                    }
                } else {
                    if (wasPlaying) {
                        flex.play();
                    }
                }
            }

            var called = false;
            $('.site').one('transitionend', function () {
                $('body').removeClass('side-nav-transitioning');
                called = true;
            });

            setTimeout(function() {
                if (!called) {
                    $('body').removeClass('side-nav-transitioning');
                }

                $window.trigger('resize');
            }, 230);
        }

        /* touchstart: do not allow scrolling main section then overlay is enabled (this is done via css) */
        $('.navbar-toggle, .side-nav-overlay').on('click touchend', function (event) {
            if ($(document.body).hasClass('side-nav-transitioning')) {
                return;
            }

            toggleNav();
        });

        /* allow closing sidenav with escape key */
        $document.keyup(function (event) {
            if (event.keyCode == 27 && $('body').hasClass('side-nav-open')) {
                toggleNav();
            }
        });

        /**
         * ScrollFix
         *
         * https://github.com/joelambert/ScrollFix
         */
        $('.side-nav__scrollable-container').on('touchstart', function (event) {
            var startTopScroll = this.scrollTop;

            if (startTopScroll <= 0) {
                this.scrollTop = 1;
            }

            if (startTopScroll + this.offsetHeight >= this.scrollHeight) {
                this.scrollTop = this.scrollHeight - this.offsetHeight - 1;
            }
        });
    };

    $.fn.singlePageWidgetBackground = function() {
        $('.featured_page_wrap[data-background]').each(function () {
            var $this = $(this);
            $this.css('background-image', 'url(' + $this.data('background') + ')');
            $this.addClass('featured_page_wrap--with-background');
        });
    };

})(jQuery);
