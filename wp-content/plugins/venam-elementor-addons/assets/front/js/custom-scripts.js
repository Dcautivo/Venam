/* NT Addons for Elementor v1.0 */

!(function ($) {


    /* Navbar Menu */
    function venamMainHeaderWidget($scope, $) {

    var doc = $(document),
        win = $(window),
        body = $('body'),
        winw = $(window).width(),
        container = '.container-wrapper';

        if ( $('.header-style-two').length ) {
            container = '.main-header';
        }
        //SubMenu Dropdown Toggle
        //$('.menu-area .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>');

        $('.header-widget .main-header li.menu-item-mega-parent > ul.submenu').each( function(){
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


        $(window).resize(function(){
            var winw = $(window).width();

            if ( winw <= 1024 ){

                $('.header-widget .main-header li.menu-item-mega-parent > ul.submenu').each( function(){
                    var cont = $( this );
                    cont.removeAttr('style');
                });

            } else  {

                $('.header-widget .main-header li.menu-item-mega-parent > ul.submenu').each( function(){
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

        if ($(".main-menu__list").length) {

            if ($(".mobile-nav__widget").length) {
                $(".mobile-nav__default").remove();
            }
            if ($(".search-popup__widget").length) {
                $(".search-popup__default").remove();
            }
            // dynamic current class
            let mainNavUL = $(".main-menu__list");
            let FileName = window.location.href.split("/").reverse()[0];

            mainNavUL.find("li").each(function () {
                let anchor = $(this).find("a");
                if ($(anchor).attr("href") == FileName) {
                    $(this).addClass("current");
                }
            });
            // if any li has .current elmnt add class
            mainNavUL.children("li").each(function () {
                if ($(this).find(".current").length) {
                    $(this).addClass("current");
                }
            });
            // if no file name return
            if ("" == FileName) {
                mainNavUL.find("li").eq(0).addClass("current");
            }
        }

        if ($(".main-menu").length && $(".mobile-nav__container").length) {
            let navContent = document.querySelector(".main-menu").innerHTML;
            let mobileNavContainer = document.querySelector(".mobile-nav__container");
            mobileNavContainer.innerHTML = navContent;
        }
        if ($(".sticky-header__content").length) {
            let navContent = document.querySelector(".main-menu").innerHTML;
            let mobileNavContainer = document.querySelector(".sticky-header__content");
            mobileNavContainer.innerHTML = navContent;
        }

        if ($(".mobile-nav__container .main-menu__list").length) {
            let dropdownAnchor = $(".mobile-nav__container .main-menu__list .dropdown > a");
            dropdownAnchor.each(function () {
                let self = $(this);
                let toggleBtn = document.createElement("BUTTON");
                toggleBtn.setAttribute("aria-label", "dropdown toggler");
                toggleBtn.innerHTML = "<i class='fa fa-angle-down'></i>";
                self.append(function () {
                    return toggleBtn;
                });
                self.find("button").on("click", function (e) {
                    e.preventDefault();
                    let self = $(this);
                    self.toggleClass("expanded");
                    self.parent().toggleClass("expanded");
                    self.parent().parent().children("ul").slideToggle();
                });
            });
        }

        $(".mobile-nav__toggler, .mobile-nav__wrapper .mobile-nav__toggler").on("click", function (e) {
            //e.preventDefault();
            $(".mobile-nav__widget").toggleClass("expanded");
        });

        $(".search-toggler").on("click", function (e) {
            //e.preventDefault();
            $(".search-popup__widget").toggleClass("active");
        });

        if ($(".stricked-menu").length) {
          var headerScrollPos = 0;
          var stricky = $scope.find(".stricked-menu");
          if ( $(window).scrollTop() > 130 ) {
            stricky.addClass("stricky-fixed");
          } else if ( $(window).scrollTop() <= 130 ) {
            stricky.removeClass("stricky-fixed");
          }
        }
    }

    function venamMainSlider( $scope, $ ) {
        var BasicSlider = $scope.find('.slider-active');
        BasicSlider.on('init', function (e, slick) {
            var $firstAnimatingElements = $('.single-slider:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('.single-slider[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });
        BasicSlider.each(function () {
            const options = JSON.parse(this.dataset.slickOptions);
            BasicSlider.slick( options );
        });

        function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function () {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                    'animation-delay': $animationDelay,
                    '-webkit-animation-delay': $animationDelay
                });
                $this.addClass($animationType).one(animationEndEvents, function () {
                    $this.removeClass($animationType);
                });
            });
        }
    }
    /* venamSwiperSlider */
    function venamSwiperSlider($scope, $) {
        $scope.find('.thm-swiper__slider').each(function () {
            const options = JSON.parse(this.dataset.swiperOptions);
            let mySlider = new Swiper( $(this), options );
        });
    }
    /* slickSliderHandler */
    function slickSliderHandler($scope, $) {
        $scope.find('.thm-slick__slider').each(function () {
            $(this).not('.slick-initialized').slick();

            $('.slider-active').on('beforeChange', function(event, slick, currentSlide, nextSlide){
                $('.slider-active .slick-slide.slick-active [data-animation]').each( function(){
                    var animation = $(this).data('animation');
                    $(this).removeClass('animated '+animation);
                });
                $('.slider-active .slick-slide:not(.slick-active) [data-animation]').each( function(){
                    var animation = $(this).data('animation');
                    var delay = $(this).data('delay');
                    if ( animation ) {
                        $(this).addClass('animated '+animation).css('animation-delay', delay);
                    }
                });
            });
        });
    }
    function venamFunfact($scope, $) {
        $scope.find('.odometer').appear(function (e) {
            $scope.find('.odometer').each(function () {
                var countNumber = $(this).attr("data-count");
                $(this).html(countNumber);
            });
        });
    }
    function venamCountdown($scope, $) {
        $scope.find('.box--timer').each(function () {
            const options = eval(JSON.parse(this.dataset.countdownOptions));
            $( this ).countdown(options);
        });
    }
    function venamDealsCountDown($scope, $) {
        $scope.find('[data-countdown]').each(function () {
            var $this = $(this),
                data = $this.data('countdown'),
                finalDate = data.date,
                hr = data.hr,
                min = data.min,
                sec = data.sec;
            $this.countdown(finalDate, function (event) {
                $this.html(event.strftime('<div class="time-count day"><span>%D</span>Day</div><div class="time-count hour"><span>%H</span>'+hr+'</div><div class="time-count min"><span>%M</span>'+min+'</div><div class="time-count sec"><span>%S</span>'+sec+'</div>'));
            });
        });
    }
    function venamProductGallery($scope, $) {
        $scope.find('.gallery-products__wrapper').each(function () {
            const $this = $(this);
            const gallery = $this.find('.exclusive-active');
            const filter = $this.find('.product-menu');
            const filterbtn = $this.find('.product-menu button');
            const options = eval(JSON.parse(this.dataset.isotopeOptions));
            gallery.imagesLoaded(function () {
                // init Isotope
                var $grid = gallery.isotope(options);
                // filter items on button click
                filter.on('click', 'button', function () {
                    var filterValue = $(this).attr('data-filter');
                    $grid.isotope({ filter: filterValue });
                });
            });
            //for menu active class
            filterbtn.on('click', function (event) {
                $(this).siblings('.active').removeClass('active');
                $(this).addClass('active');
                event.preventDefault();
            });
        });
    }

    function venamHeaderCatMenu($scope, $) {
        $scope.each(function () {
            const $this = $(this);
            const menu = $this.find('.category-menu');
            const toggle = $this.find('.cat-toggle');
            const more = $this.find('.more_slide_open');
            const morecats = $this.find('.more_categories');
            /*=============================================
            Toggle Active
            =============================================*/
            $(toggle).on('click', function () {
                $(menu).slideToggle(500);
                return false;
            });
            $(more).slideUp();
            $(morecats).on('click', function () {
                $(this).toggleClass('show');
                $(more).slideToggle();
            });
        });
    }

    function venamLightbox() {
        var myLightboxes = $('[data-venam-lightbox]');
        if (myLightboxes.length) {
            myLightboxes.each(function(i, el) {
                var myLightbox = $(el);
                var myData = myLightbox.data('venamLightbox');
                var myOptions = {};
                if (!myData || !myData.type) {
                    return true; // next iteration
                }
                if (myData.type === 'gallery') {
                    if (!myData.selector) {
                        return true; // next iteration
                    }
                    myOptions = {
                        delegate: myData.selector,
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                    };

                }
                if (myData.type === 'image') {
                    myOptions = {
                        type: 'image'
                    };
                }
                if (myData.type === 'iframe') {
                    myOptions = {
                        type: 'iframe'
                    };
                }
                if (myData.type === 'inline') {
                    myOptions = {
                        type: 'inline',
                    };
                }
                if (myData.type === 'modal') {
                    myOptions = {
                        type: 'inline',
                        modal: false
                    };
                }
                if (myData.type === 'ajax') {
                    myOptions = {
                        type: 'ajax',
                        overflowY: 'scroll'
                    };
                }
                myLightbox.magnificPopup(myOptions);
            });
        }
    }

    /* venamAnimationFix */
    function venamAnimationFix() {
        $scope.find('body:not(.elementor-page)').each(function () {

            var myTarget     = $( this ),
                myInvisible  = myTarget.find( '.elementor-invisible' );

            myInvisible.each( function () {
                var $this     = $( this ),
                    animData  = $this.data('settings'),
                    animName  = animData._animation,
                    animDelay = animData._animation_delay;
                $this.addClass( 'wow '+ animName ).removeClass( 'elementor-invisible' );
                $this.css( 'animation-delay', animDelay + 'ms');
            });
        });
    }

   // venamJarallax
    function venamJarallax() {
        var myParallaxs = $('.venam-parallax');
        myParallaxs.each(function (i, el) {

            var myParallax = $(el),
                myData     = myParallax.data('venamParallax');
            if (!myData) {
                return true; // next iteration
            }
            myParallax.jarallax({
                type            : myData.type,
                speed           : myData.speed,
                imgSize         : myData.imgsize,
                imgSrc          : myData.imgsrc,
                disableParallax : myData.mobile ? /iPad|iPhone|iPod|Android/ : null,
                keepImg         : false
            });
        });
    }

    var NtVegasHandler = function ($scope, $) {
        var target = $scope,
            sectionId = target.data("id"),
            settings = false,
            editMode = elementorFrontend.isEditMode();

        if (editMode) {
            settings = generateEditorSettings(sectionId);
        }

        if (!editMode || !settings) {
            //return false;
        }

        if(settings[1]){
            generateVegas();
        }

        function generateEditorSettings(targetId) {
            var editorElements = null,
                sectionData = {},
                sectionMultiData = {},
                settings = [];

            if (!window.elementor.hasOwnProperty("elements")) {
                return false;
            }

            editorElements = window.elementor.elements;

            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function(index, elem) {

                if (targetId == elem.id) {

                    sectionData = elem.attributes.settings.attributes;
                } else if ( elem.id == target.closest(".elementor-top-section").data("id") ) {

                    $.each(elem.attributes.elements.models, function(index, col) {
                        $.each(col.attributes.elements.models, function(index,subSec) {
                            sectionData = subSec.attributes.settings.attributes;
                        });
                    });
                }
            });

            if (!sectionData.hasOwnProperty("venam_vegas_animation_type") || "" == sectionData["venam_vegas_animation_type"]) {
                return false;
            }

            settings.push(sectionData["venam_vegas_switcher"]);  // settings[0]
            settings.push(sectionData["venam_vegas_images"]);    // settings[1]
            settings.push(sectionData["venam_vegas_animation_type"]);      // settings[2]
            settings.push(sectionData["venam_vegas_transition_type"]);     // settings[3]
            settings.push(sectionData["venam_vegas_overlay_type"]);    // settings[4]
            settings.push(sectionData["venam_vegas_delay"]);     // settings[5]
            settings.push(sectionData["venam_vegas_duration"]);   // settings[6]
            settings.push(sectionData["venam_vegas_shuffle"]);   // settings[7]
            settings.push(sectionData["venam_vegas_timer"]);   // settings[8]

            if (0 !== settings.length) {
                return settings;
            }

            return false;
        }

        function generateVegas() {

            var vegas_animation  = settings[2] ? Object.values(settings[2]) : 'kenburns';
            var vegas_transition = settings[3] ? Object.values(settings[3]) : 'slideLeft';
            var vegas_delay      = settings[5] ? settings[5] : 7000;
            var vegas_duration   = settings[6] ? settings[6] : 2000;
            var vegas_shuffle    = 'yes' == settings[7] ? true : false;
            var vegas_timer      = 'yes' == settings[8] ? true : false;
            var vegas_overlay    = 'none' != settings[4] ? true : false;

            if(settings[1].length){

                if ( settings[0] == 'yes' && !$('#vegas-js_' + sectionId ).length ) {
                    $('<div id="vegas-js_' + sectionId + '" class="venam-vegas-effect"></div>').prependTo(target);

                    var images = [];
                    for(i = 0; i<settings[1].length; i++){
                        images.push({ src: settings[1][i]['url'] });
                    }

                    setTimeout(function() {
                        $('#vegas-js_' + sectionId).vegas({
                            delay: vegas_delay,
                            timer: vegas_timer,
                            shuffle: vegas_shuffle,
                            animation: vegas_animation,
                            transition: vegas_transition,
                            transitionDuration: vegas_duration,
                            overlay: vegas_overlay,
                            slides: images
                        });
                    }, 500);

                } else {
                    if ( settings[0] != 'yes' && $('#vegas-js_' + sectionId ).length ) {
                        $('#vegas-js_' + sectionId ).remove();
                    }
                }
            }
        }
    }

    // NtVegas Preview function
    function NtVegas() {

        $(".elementor-section[data-vegas-settings]").each(function (i, el) {
            var myVegas = jQuery(el);
            var myVegasId = myVegas.data('vegas-id');
            var myElementType = myVegas.data('element_type');
            if ( myElementType == 'section' ) {

                $('<div id="vegas-js_' + myVegasId + '" class="venam-vegas-effect"></div>').prependTo(myVegas);

                var settings = myVegas.data('vegas-settings');

                if(settings.slides.length) {

                    var vegas_animation  = settings.animation ? settings.animation : 'kenburns';
                    var vegas_transition = settings.transition ? settings.transition : 'slideLeft';
                    var vegas_delay      = settings.delay ? settings.delay : 7000;
                    var vegas_duration   = settings.duration ? settings.duration : 2000;
                    var vegas_shuffle    = 'yes' == settings.shuffle ? true : false;
                    var vegas_timer      = 'yes' == settings.timer ? true : false;
                    var vegas_overlay    = 'none' != settings.overlay ? true : false;

                    $( '#vegas-js_' + myVegasId ).vegas({
                        delay: vegas_delay,
                        timer: vegas_timer,
                        shuffle: vegas_shuffle,
                        animation: vegas_animation,
                        transition: vegas_transition,
                        transitionDuration: vegas_duration,
                        overlay: vegas_overlay,
                       slides: settings.slides
                    });
                }
            }
        });
    }

    var NtParticlesHandler = function ($scope, $) {
        var target = $scope,
            sectionId = target.data("id"),
            settings = false,
            editMode = elementorFrontend.isEditMode();

        if (editMode) {
            settings = generateEditorSettings(sectionId);
        }

        if (!editMode || !settings) {
            return false;
        }

        if ( "none" != settings[1]) {
            target.addClass('venam-particles');
            $('<div id="particles-js_' + sectionId + '" class="venam-particles-effect"></div>').prependTo(target);
            generateParticles();
        }

        function generateEditorSettings(targetId) {
            var editorElements = null,
                sectionData = {},
                sectionMultiData = {},
                settings = [];

            if (!window.elementor.hasOwnProperty("elements")) {
                return false;
            }

            editorElements = window.elementor.elements;

            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function(index, elem) {

                if (targetId == elem.id) {

                    sectionData = elem.attributes.settings.attributes;
                } else if ( elem.id == target.closest(".elementor-top-section").data("id") ) {

                    $.each(elem.attributes.elements.models, function(index, col) {
                        $.each(col.attributes.elements.models, function(index,subSec) {
                            sectionData = subSec.attributes.settings.attributes;
                        });
                    });
                }
            });

            if (!sectionData.hasOwnProperty("venam_particles_type") || "none" == sectionData["venam_particles_type"]) {
                return false;
            }

            settings.push(sectionData["venam_particles_switcher"]);  // settings[0]
            settings.push(sectionData["venam_particles_type"]);      // settings[1]
            settings.push(sectionData["venam_particles_shape"]);     // settings[2]
            settings.push(sectionData["venam_particles_number"]);    // settings[3]
            settings.push(sectionData["venam_particles_color"]);     // settings[4]
            settings.push(sectionData["venam_particles_opacity"]);   // settings[5]
            settings.push(sectionData["venam_particles_size"]);      // settings[5]

            if (0 !== settings.length) {
                return settings;
            }

            return false;
        }

        function generateParticles() {

            var type     = settings[1] ? settings[1] : 'deafult';
            var shape    = settings[2] ? settings[2] : 'buble';
            var number   = settings[3] ? settings[3] : '';
            var color    = settings[4] ? settings[4] : '#fff';
            var opacity  = settings[5] ? settings[5] : '';
            var d_size   = settings[6] ? settings[6] : '';
            //var n_size   = settings[8] ? settings[8] : '';
            //var s_size   = settings[9] ? settings[9] : '';
            var snumber = number ? number : 6;
            var nbsides = shape == 'star' ? 5 : 6;
            var size    = d_size ? d_size : 100;
            setTimeout(function() {

                if ( type == 'bubble' ) {
                    snumber = number ? number : 6;
                    nbsides = shape == 'star' ? 5 : 6;
                    size    = d_size ? d_size : 100;
                    particlesJS("particles-js_" + sectionId, { "fps_limit": 0, "particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": nbsides }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": false, "anim": { "enable": true, "speed": 10, "size_min": 40, "sync": false } }, "line_linked": { "enable": false, "distance": 200, "color": "#ffffff", "opacity": 1, "width": 2 }, "move": { "enable": true, "speed": 8, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": false, "mode": "grab" }, "onclick": { "enable": false, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'nasa' ) {
                    snumber = number ? number : 160;
                    size    = d_size ? d_size : 3;
                    particlesJS("particles-js_" + sectionId, { "fps_limit": 0, "particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 4, "size_min": 0.3, "sync": false } }, "line_linked": { "enable": false, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 1, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 600 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "repulse" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 250, "size": 0, "duration": 2, "opacity": 0, "speed": 3 }, "repulse": { "distance": 400, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'snow' ) {
                    snumber = number ? number : 400;
                    size    = d_size ? parseFloat(d_size) : 10;
                    particlesJS("particles-js_" + sectionId, { "fps_limit": 0, "particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": false, "distance": 500, "color": "#ffffff", "opacity": 0.4, "width": 2 }, "move": { "enable": true, "speed": 6, "direction": "bottom", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "repulse" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 0.5 } }, "bubble": { "distance": 400, "size": 4, "duration": 0.3, "opacity": 1, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'default' ) {
                    snumber = number ? number : 80;
                    size    = d_size ? d_size : 3;
                    particlesJS("particles-js_" + sectionId, { "fps_limit": 0, "particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": false, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 6, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "repulse" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else {
                    target.find('.venam-particles-effect').remove();
                    target.removeClass('venam-particles');
                }
            }, 500);
        }
    }

    // ntrParticles Preview function
    function NtParticles() {

        $(".elementor-section[data-particles-settings]").each(function (i, el) {
            var myParticles = $(el);
            var myParticlesId = myParticles.attr('data-particles-id');
            var myElementTtype = myParticles.attr('data-element_type');
            if ( myElementTtype == 'section' ) {

                $('<div id="particles-js_' + myParticlesId + '" class="venam-particles-effect"></div>').prependTo(myParticles);

                var settings = myParticles.data('particles-settings');

                var type     = settings.type;
                var color    = settings.color ? settings.color : '#fff';
                var opacity  = settings.opacity ? settings.opacity : 0.4;
                var shape    = settings.shape ? settings.shape : 'circle';
                var snumber = settings.number ? settings.number : 6;
                var nbsides = settings.shape == 'star' ? 5 : 6;
                var size    = settings.size ? settings.size : 100;

                if ( type == 'bubble' ) {
                    snumber = settings.number ? settings.number : 6;
                    nbsides = settings.shape == 'star' ? 5 : 6;
                    size = settings.size ? settings.size : 100;
                    particlesJS("particles-js_" + myParticlesId,{ "fps_limit": 0,"particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000" }, "polygon": { "nb_sides": nbsides }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": false, "anim": { "enable": true, "speed": 10, "size_min": 40, "sync": false } }, "line_linked": { "enable": false, "distance": 200, "color": "#ffffff", "opacity": 1, "width": 2 }, "move": { "enable": true, "speed": 8, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": false, "mode": "grab" }, "onclick": { "enable": false, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'nasa' ) {
                    snumber = settings.number ? settings.number : 160;
                    size = settings.size ? settings.size : 3;
                    particlesJS("particles-js_" + myParticlesId, { "fps_limit": 0,"particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": color }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 4, "size_min": 0.3, "sync": false } }, "line_linked": { "enable": false, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 1, "direction": "none", "random": true, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 600 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "repulse" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 250, "size": 0, "duration": 2, "opacity": 0, "speed": 3 }, "repulse": { "distance": 400, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else if( type == 'snow' ) {
                    snumber = settings.number ? settings.number : 400;
                    size = settings.size ? settings.size : 10;
                    particlesJS("particles-js_" + myParticlesId, { "fps_limit": 0,"particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": "#fff" }, "shape": { "type": shape, "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": opacity, "random": true, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": size, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": false, "distance": 500, "color": "#ffffff", "opacity": 0.4, "width": 2 }, "move": { "enable": true, "speed": 6, "direction": "bottom", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" }, "onclick": { "enable": true, "mode": "repulse" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 0.5 } }, "bubble": { "distance": 400, "size": 4, "duration": 0.3, "opacity": 1, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                } else {
                    snumber = settings.number ? settings.number : 80;
                    size = settings.size ? settings.size : 3;
                    particlesJS("particles-js_" + myParticlesId, { "fps_limit": 0,"particles": { "number": { "value": snumber, "density": { "enable": true, "value_area": 800 } }, "color": { "value": "#ffffff" }, "shape": { "type": "circle", "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "img/github.svg", "width": 100, "height": 100 } }, "opacity": { "value": 0.5, "random": false, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": 3, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 6, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "repulse" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });
                }
            }
        });
    }

    var NtParallaxHandler = function ($scope, $) {
        var target = $scope,
            sectionId = target.data("id"),
            settings = false,
            editMode = elementorFrontend.isEditMode();

        if (editMode) {
            settings = generateEditorSettings(sectionId);
        }

        if (!editMode || !settings) {
            //return false;
        }

        if (settings[0] == "yes") {

            generateJarallax();
        }

        function generateEditorSettings(targetId) {
            var editorElements = null,
                sectionData = {},
                sectionMultiData = {},
                settings = [];

            if (!window.elementor.hasOwnProperty("elements")) {
                return false;
            }

            editorElements = window.elementor.elements;

            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function(index, elem) {

                if (targetId == elem.id) {

                    sectionData = elem.attributes.settings.attributes;
                } else if ( elem.id == target.closest(".elementor-top-section").data("id") ) {

                    $.each(elem.attributes.elements.models, function(index, col) {
                        $.each(col.attributes.elements.models, function(index,subSec) {
                            sectionData = subSec.attributes.settings.attributes;
                        });
                    });
                }
            });

            if (!sectionData.hasOwnProperty("venam_parallax_type") || "" == sectionData["venam_parallax_type"]) {
                return false;
            }

            settings.push(sectionData["venam_parallax_switcher"]);                          // settings[0]
            settings.push(sectionData["venam_parallax_type"]);                              // settings[1]
            settings.push(sectionData["venam_parallax_speed"]);                             // settings[2]
            settings.push(sectionData["venam_parallax_bg_size"]);                           // settings[3]
            settings.push("yes" == sectionData["venam_parallax_mobile_support"] ? 0 : 1);   // settings[4]
            settings.push("yes" == sectionData["venam_add_parallax_video"] ? 1 : 0);        // settings[5]
            settings.push(sectionData["venam_local_video_format"]);                         // settings[6]
            settings.push(sectionData["venam_parallax_video_url"]);                         // settings[7]
            settings.push(sectionData["venam_parallax_video_start_time"]);                  // settings[8]
            settings.push(sectionData["venam_parallax_video_end_time"]);                    // settings[9]
            settings.push(sectionData["venam_parallax_video_volume"]);                      // settings[10]

            if (0 !== settings.length) {
                return settings;
            }

            return false;
        }

        function responsiveParallax(android, ios) {
            switch (true || 1) {
                case android && ios:
                    return /iPad|iPhone|iPod|Android/;
                    break;
                case android && !ios:
                    return /Android/;
                    break;
                case !android && ios:
                    return /iPad|iPhone|iPod/;
                    break;
                case !android && !ios:
                    return null;
            }
        }

        function generateJarallax() {
            var $type     = settings[1] ? settings[1] : 'scroll';
            var $speed    = settings[2] ? settings[2] : '0.4';
            var $imgsize  = settings[3] ? settings[3] : 'cover';

            setTimeout(function() {
                target.jarallax({
                    type            : $type,
                    speed           : $speed,
                    imgSize         : $imgsize,
                    disableParallax : responsiveParallax(1 == settings[4])
                });
            }, 500);
        }
    }

    function updatePageSettings(newValue) {
        var settings = false,
            editMode = elementorFrontend.isEditMode();
        if ( !editMode ) {
            return false;
        }
        if ( editMode ) {

            var hide_header = elementor.settings.page.model.attributes.venam_hide_page_header;
            var hide_footer = elementor.settings.page.model.attributes.venam_hide_page_footer;
            var header_template = elementor.settings.page.model.attributes.venam_page_header_template;

            if ( hide_header && 'yes' === hide_header ) {
                $( 'body .thm-default__header' ).hide();
            } else {
                $( 'body .thm-default__header' ).show();
            }
            if ( hide_footer && 'yes' === hide_footer ) {
                $( 'body .thm-default__copyright' ).hide();
            } else {
                $( 'body .thm-default__copyright' ).show();
            }
        }
    }

    jQuery(window).on('load', function () {

    });

    if ( typeof elementorAppProConfig != "undefined" ) {
        //venamHeaderCatMenu($('body'), $);
    }

    jQuery(window).on('elementor/frontend/init', function () {

        if ( typeof elementor != "undefined" && typeof elementor.settings.page != "undefined") {
            elementor.settings.page.addChangeCallback( 'venam_hide_page_header', updatePageSettings );
            elementor.settings.page.addChangeCallback( 'venam_page_header_type', updatePageSettings );
            elementor.settings.page.addChangeCallback( 'venam_hide_page_footer', updatePageSettings );
        }

        elementorFrontend.hooks.addAction('frontend/element_ready/section', venamJarallax);
        //elementorFrontend.hooks.addAction('frontend/element_ready/image.default', venamImageJarallax);

        // venam widgets handler
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-menu.default', venamMainHeaderWidget);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-button.default', venamLightbox);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-home-slider.default', slickSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-blog-posts.default', slickSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-testimonials.default', slickSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-menu.default', venamHeaderCatMenu);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-menu-vertical.default', venamHeaderCatMenu);

        // WooCommerce
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-woo-gallery.default', venamProductGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-woo-slider.default', slickSliderHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-woo-slider.default', venamDealsCountDown);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-woo-super-deals.default', venamDealsCountDown);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-woo-flash-deals.default', venamDealsCountDown);

        elementorFrontend.hooks.addAction('frontend/element_ready/venam-woo-category-slider.default', venamSwiperSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-woo-mini-slider.default', venamSwiperSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-countdown.default', venamCountdown);


        var editMode = elementorFrontend.isEditMode();
        if ( editMode ) {
            elementorFrontend.hooks.addAction('frontend/element_ready/global', NtVegasHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/global', NtParticlesHandler);
            elementorFrontend.hooks.addAction('frontend/element_ready/global', NtParallaxHandler);
        } else {
            NtVegas();
            NtParticles();
        }

    });

    jQuery(document).ready(function ($) {
        if ( typeof elementorFrontendConfig == 'undefined' ){
            venamMainHeaderWidget($('body'), $);
            venamHeaderCatMenu($('body'), $);
            NtVegas();
            NtParticles();
            venamJarallax();
        }
    });

})(jQuery);
