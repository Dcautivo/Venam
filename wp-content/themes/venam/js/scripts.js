/*-----------------------------------------------------------------------------------

    Theme Name: Venam
    Description: WordPress Theme
    Author: Ninetheme
    Author URI: https://ninetheme.com/
    Version: 1.0

-----------------------------------------------------------------------------------*/


(function(window, document, $) {

    "use strict";

    var doc = $(document),
        win = $(window),
        body = $('body'),
        winw = $(window).width(),
        container = '.container-wrapper',
        magasubmenu = $('header.thm--header .main-header .menu-nav li.menu-item-mega-parent > ul.submenu');

        if ( $('.header-style-two').length ) {

            container = '.menu-wrap';
        }

    function thmHeader(){
        magasubmenu.each( function(){
            var cont = $( this ),
                wrap = cont.closest(container),
                wrapoff = wrap.offset(),
                wrapleft = wrapoff.left,
                parentw = wrap.outerWidth(),
                parent = cont.parent('li'),
                parentpos = parent.position(),
                parentoff = parent.offset(),
                parentleft = parentoff.left;

            if ( winw > 1024 ){
                if ( $('body').hasClass('rtl') ) {
                    parentleft = $(window).width() - (parentoff.left + parent.outerWidth());
                    wrapleft = $(window).width() - (wrapoff.left + wrap.outerWidth());
                    cont.css({
                        'right':'-'+ ( parentleft - wrapleft ) +'px',
                        'width': parentw+'px',
                    });
                } else {
                    cont.css({
                        'left':'-'+ ( parentleft - wrapleft ) +'px',
                        'width': parentw+'px',
                    });
                }
            } else {
                cont.removeAttr('style');
            }
        });
    }

    $(window).resize(function(){
        var winw = $(window).width();

        if ( winw <= 1024 ){

            magasubmenu.each( function(){
                var cont = $( this );
                cont.removeAttr('style');
            });

        } else  {

            magasubmenu.each( function(){
                var cont = $( this ),
                    wrap = cont.closest(container),
                    wrapoff = wrap.offset(),
                    wrapleft = wrapoff.left,
                    parentw = wrap.outerWidth(),
                    parent = cont.parent('li'),
                    parentpos = parent.position(),
                    parentoff = parent.offset(),
                    parentleft = parentoff.left;

                if ( $('body').hasClass('rtl') ) {
                    parentleft = $(window).width() - (parentoff.left + parent.outerWidth());
                    wrapleft = $(window).width() - (wrapoff.left + wrap.outerWidth());
                    cont.css({
                        'right':'-'+ ( parentleft - wrapleft ) +'px',
                        'width': parentw+'px',
                    });
                } else {
                    cont.css({
                        'left':'-'+ ( parentleft - wrapleft ) +'px',
                        'width': parentw+'px',
                    });
                }
            });
        }
    });


    /*=============================================
    Mobile Menu
    =============================================*/
    //SubMenu Dropdown Toggle
    if ( $('.header-widget').length ) {
        $('.header-widget.header-style-two').parents('.elementor-top-section').addClass('big-index has-header-style-two');
    }
    //SubMenu Dropdown Toggle
    if ( $('.menu-area li.dropdown ul').length ) {
        $('.menu-area .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>');
    }

    //Mobile Nav Hide Show
    if ( $('.mobile-menu').length ) {

        var mobileMenuContent = $('.menu-area .main-menu').html();
        $('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);

        //Dropdown Button
        $('.mobile-menu li.dropdown .dropdown-btn').on('click', function () {
            $(this).toggleClass('open');
            $(this).prev('ul').slideToggle(500);
            $(this).parent('.menu-item').siblings().find('ul.submenu').slideUp(500);
            $(this).parent('.menu-item').siblings().find('.dropdown-btn').removeClass('open');
        });
        //Menu Toggle Btn
        $('.mobile-nav-toggler').on('click', function () {
            $('body').addClass('mobile-menu-visible');
            $(this).closest('.elementor-section.elementor-top-section').addClass('mobile-menu-visible');
            if ( $('#nt-sidebar').hasClass('active') ) {
                $('.close-sidebar').trigger('click');
            }
            setTimeout(function () {
                $('body').addClass('mobile-trans-end');
            }, 2000);
        });

        //Menu Toggle Btn
        $('.mobile-menu .menu-backdrop,.mobile-menu .close-btn').on('click', function () {
            $('body').removeClass('mobile-menu-visible');
            $(this).closest('.elementor-section.elementor-top-section').removeClass('mobile-menu-visible');
            $('body').removeClass('mobile-trans-end');

            $('.menu-inner-button:not([data-menu-name="menu"])').removeClass('active');
            $('.mobile-menu nav:not([data-menu-name="menu"])').removeClass('active').slideUp();
            $('.menu-inner-button[data-menu-name="menu"]').addClass('active');
            $('.mobile-menu nav[data-menu-name="menu"]').addClass('active').slideDown();

        });
    }

    if ( $('.mobile-menu nav[data-menu-name="menu"]').length ) {
        $('.mobile-menu nav[data-menu-name="menu"]').addClass('active');
        $('.mobile-menu nav:not([data-menu-name="menu"])').slideUp();
    }

    //Header mobile menu buttons
    $('.menu-inner-button').on('click', function () {
        var $this = $( this ),
            dataval = $this.data('menu-name');

        $('.mobile-menu .submenu').slideUp(500);
        $('.mobile-menu .dropdown-btn').removeClass('open');
        $this.addClass('active').siblings().removeClass('active');
        $('.mobile-menu nav[data-menu-name="'+dataval+'"]').addClass('active').slideDown();
        $('.mobile-menu nav:not([data-menu-name="'+dataval+'"])').removeClass('active').slideUp();
    });

    //Header account form Toggle
    $('.venam_mini_account_form .user').on('click', function () {
        $( this ).parent().toggleClass('active');
    });

    /*=============================================
    Menu sticky & Scroll to top
    =============================================*/
    $( window ).on( 'scroll', function () {
        var scroll = $(window).scrollTop();
        var headerh = $("#sticky-header").outerHeight();
        if ( scroll > ( headerh + 500 ) ) {
            $("#sticky-header").addClass("sticky-menu");
            $('.scroll-to-target').addClass('open');
        } else {
            $("#sticky-header").removeClass("sticky-menu");
            $('.scroll-to-target').removeClass('open');
        }
    });


    /*=============================================
    Scroll Up
    =============================================*/
    if ( $('.scroll-to-target').length ) {
        $(".scroll-to-target").on('click', function () {
            var target = $(this).attr('data-target');
            // animate
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);

        });
    }

    /*=============================================
    Data Background
    =============================================*/
    $("[data-background]").each(function () {
        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
    });

    /* venamSwiperSlider */
    function venamSwiperSlider() {
        $('.thm-swiper__slider').each(function () {
            const options = JSON.parse(this.dataset.swiperOptions);
            const mySlider = new Swiper(this, options);

            $(this).hover(function() {
                mySlider.autoplay.stop();
            }, function() {
                mySlider.autoplay.start();
            });
        });
    }
    /* venamSlickSlider */
    function venamSlickSlider() {
        $('.thm-slick__slider').each(function () {
            $(this).not('.slick-initialized').slick();
        });
    }

    /* venamSimpleParallax */
    function venamSimpleParallax() {
        $('.thumparallax').each(function () {
            // html attr output =====> data-parallax-options='{"orientation": "down","delay": 1..... }'
            const options = JSON.parse(this.dataset.parallaxOptions);
            let mySlider = new simpleParallax($(this), options);
        });
    }
    /* venamUiTooltip */
    function venamUiTooltip() {
        $('[data-tooltip-options]').each(function () {
            // html attr output =====> data-tooltip-options='{"position": "top", "content": "Awesome title!" }'
            const options = JSON.parse(this.dataset.tooltipOptions);
            $(this).tooltip(options);
        });
    }
    // agrikonVegasSlider Preview function
    function agrikonVegasSlider() {

        $(".home-slider-vegas-wrapper").each(function (i, el) {
            var myEl         = jQuery(el),
                myVegasId    = myEl.find('.nt-home-slider-vegas').attr('id'),
                myVegas      = $( '#' + myVegasId ),
                myPrev       = myEl.find('.vegas-control-prev'),
                myNext       = myEl.find('.vegas-control-next'),
                mySettings   = myEl.find('.nt-home-slider-vegas').data('slider-settings'),
                myContent    = myEl.find('.nt-vegas-slide-content'),
                myCounter    = myEl.find('.nt-vegas-slide-counter'),
                myTitle    = myEl.find('.slider_title'),
                myDesc     = myEl.find('.slider_desc'),
                myBtn      = myEl.find('.btn'),
                myCounter  = myEl.find('.nt-vegas-slide-counter');

            myEl.parents('.elementor-widget-agrikon-vegas-slider').removeClass('elementor-invisible');

            if( mySettings.slides.length ) {
                var slides = mySettings.slides,
                    anim   = mySettings.animation ? mySettings.animation : 'kenburns',
                    trans  = mySettings.transition ? mySettings.transition : 'slideLeft',
                    delay  = mySettings.delay ? mySettings.delay : 7000,
                    dur    = mySettings.duration ? mySettings.duration : 2000,
                    autoply= mySettings.autoplay,
                    shuf   = 'yes' == mySettings.shuffle ? true : false,
                    timer  = 'yes' == mySettings.timer ? true : false,
                    over   = 'none' != mySettings.overlay ? true : false;

                myVegas.vegas({
                    autoplay: autoply,
                    delay: delay,
                    timer: timer,
                    shuffle: shuf,
                    animation: anim,
                    transition: trans,
                    transitionDuration: dur,
                    overlay: over,
                    slides: mySettings.slides,
                    init: function (globalSettings) {
                        myContent.eq(0).addClass('active');
                        myTitle.eq(0).addClass('fadeInLeft');
                        myDesc.eq(0).addClass('fadeInLeft');
                        myBtn.eq(0).addClass('fadeInLeft');
                        var total = myContent.size();
                        myCounter.find('.total').html(total);
                    },
                    walk: function (index, slideSettings) {
                        myContent.removeClass('active').eq(index).addClass('active');
                        myTitle.removeClass('fadeInLeft').addClass('fadeOutLeft').eq(index).addClass('fadeInLeft').removeClass('fadeOutLeft');
                        myDesc.removeClass('fadeInLeft').addClass('fadeOutLeft').eq(index).addClass('fadeInLeft').removeClass('fadeOutLeft');
                        myBtn.removeClass('fadeInLeft').addClass('fadeOutLeft').eq(index).addClass('fadeInLeft').removeClass('fadeOutLeft');
                        var current = index +1;
                        myCounter.find('.current').html(current);
                    },
                    end: function (index, slideSettings) {
                    }
                });

                myPrev.on('click', function () {
                    myVegas.vegas('previous');
                });

                myNext.on('click', function () {
                    myVegas.vegas('next');
                });

            }
        });
        // add video support on mobile device for vegas slider
        if( $(".home-slider-vegas-wrapper").length ) {
            $.vegas.isVideoCompatible = function () {
                return true;
            }
        }
    }

    // venamVegasTemplate Preview function
    function venamVegasTemplate() {
        $(".vegas-template-slider").each(function () {
            var myEl        = $(this),
                myContent   = myEl.find('.vegas-content-wrapper .elementor-top-section'),
                myBgContent = myEl.find('.vegas-bg-content'),
                mySettings  = myBgContent.data('slider-settings'),
                myVegasId   = myBgContent.attr('id'),
                myVegas     = $( '#' + myVegasId ),
                myPrev      = myEl.find('.vegas-control-prev'),
                myNext      = myEl.find('.vegas-control-next'),
                myCounter   = myEl.find('.nt-vegas-slide-counter');

            myEl.parents('.elementor-widget-venam-vegas-template').removeClass('elementor-invisible');

            var mySlides = [];
            myContent.each( function(){
                var mySlide = $(this),
                    bgImage = mySlide.css('background-image');
                    bgImage = bgImage.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, ''),
                    bgImage = {"src": bgImage};

                mySlides.push( bgImage );
                mySlide.addClass('vegas-slide-template-section').css({
                    'background-image' : 'none',
                    'background-color' : 'transparent',
                });
            });

            if( mySlides.length ) {
                var anim  = mySettings.animation ? mySettings.animation : 'kenburns',
                    trans = mySettings.transition ? mySettings.transition : 'slideLeft',
                    delay = mySettings.delay ? mySettings.delay : 7000,
                    dur   = mySettings.duration ? mySettings.duration : 2000,
                    aply  = mySettings.autoplay,
                    shuf  = 'yes' == mySettings.shuffle ? true : false,
                    timer = 'yes' == mySettings.timer ? true : false,
                    over  = 'none' != mySettings.overlay ? true : false;

                myVegas.vegas({
                    autoplay: aply,
                    delay: delay,
                    timer: timer,
                    shuffle: shuf,
                    animation: anim,
                    transition: trans,
                    transitionDuration: dur,
                    overlay: over,
                    slides: mySlides,
                    init: function (globalSettings) {
                        myContent.eq(0).addClass('active');
                        var total = myContent.size();
                        myCounter.find('.total').html(total);
                        myContent.each( function(){
                            var myElAnim = $(this).find( '.elementor-element[data-settings]' ),
                                myData = myElAnim.data('settings'),
                                myAnim = myData && myData._animation ? myData._animation : '',
                                myDelay = myData && myData._animation_delay ? myData._animation_delay / 1000 : '';

                            if (myData && myAnim ) {
                                myElAnim.removeClass( 'animated' );
                                $(this).find(myElAnim).css({
                                    'animation-delay' : myDelay+'s',
                                });
                            }
                        });
                    },
                    walk: function (index, slideSettings) {

                        myContent.removeClass('active').eq(index).addClass('active');

                        myContent.each( function(){
                            var myElAnim = $(this).find( '.elementor-element[data-settings]' ),
                                myData = myElAnim.data('settings'),
                                myAnim = myData && myData._animation ? myData._animation : '',
                                myDelay = myData && myData._animation_delay ? myData._animation_delay / 1000 : '';

                            if (myData && myAnim ) {
                                myElAnim.removeClass( 'animated ' + myAnim );
                                myContent.eq(index).find(myElAnim).addClass('animated ' + myAnim);
                            }
                        });
                        var current = index +1;
                        myCounter.find('.current').html(current);
                    },
                    end: function (index, slideSettings) {
                    }
                });

                myPrev.on('click', function () {
                    myVegas.vegas('previous');
                });

                myNext.on('click', function () {
                    myVegas.vegas('next');
                });

            }
        });
    }

   // venamFixedSection
    function venamFixedSection() {
        var myFixedSection = $( '.venam-section-fixed-yes' );
        if ( myFixedSection.length ) {
            myFixedSection.parents( '[data-elementor-type="section"]' ).addClass( 'venam-section-fixed venam-custom-header' );
            win.on( "scroll", function () {
                var bodyScroll = win.scrollTop();
                if ( bodyScroll > 100 ) {
                    myFixedSection.parents( '[data-elementor-type="section"]' ).addClass( 'section-fixed-active' );
                } else {
                   myFixedSection.parents( '[data-elementor-type="section"]' ).removeClass( 'section-fixed-active' );
                }
            });
        }
    }

    function scrollToTopBtnClick() {
        if ( $(".scroll-to-target").length ) {
            $( ".scroll-to-target" ).on("click", function () {
                var target = $(this).attr("data-target");
                // animate
                $("html, body").animate({scrollTop: $(target).offset().top},1000);
                return false;
            });
        }
    }
    function scrollToTopBtnHide() {
        var strickyScrollPos = 100;
        if ( $(".scroll-to-target").length ) {
            if ( $(window).scrollTop() > strickyScrollPos ) {
                $(".scroll-to-top").fadeIn(500);
            } else if ( $(".scroll-to-top").scrollTop() <= strickyScrollPos ) {
                $(".scroll-to-top").fadeOut(500);
            }
        }
    }

    doc.ready( function() {

        if ( win.width() <= 1024 ) {
            body.removeClass('nt-desktop').addClass('nt-mobile');
        } else {
            body.removeClass('nt-mobile').addClass('nt-desktop');
        }

        win.on('resize', function () {
            if ( win.width() <= 1024 ) {
                body.removeClass('nt-desktop').addClass('nt-mobile');
            }else {
                body.removeClass('nt-mobile').addClass('nt-desktop');
            }
        });
        scrollToTopBtnClick();
        thmHeader();
        venamSwiperSlider();
        venamSlickSlider();
        agrikonVegasSlider();
        venamVegasTemplate();
        venamFixedSection();

    });

    // === window When scroll === //
    win.on("scroll", function () {
        var bodyScroll = win.scrollTop();

        if ( bodyScroll > 100 ) {
            body.addClass("scroll-start");
        } else {
            body.removeClass("scroll-start");
        }
        scrollToTopBtnHide();
    });

    // === window When Loading === //
    win.on("load", function () {
        if ( $(".preloader").length ) {
          $( ".preloader" ).fadeOut();
        }

        venamSimpleParallax();
    });

})(window, document, jQuery);
