jQuery(document).ready(function($) {

    /*-- Strict mode enabled --*/
    'use strict';

    $(document).on( 'ready', function(){
        var pag = $('.products-wrapper').attr('data-pagination');
        var attr = $('.wpc-filter-chips-list');
        if ( ( pag == 'pagination-load-more' || pag == 'pagination-infite' ) && attr.length > 0 ) {
            $('.products-wrapper').removeClass('pagination-load-more');
            $('.products-wrapper').removeClass('pagination-infite');
            $('.products-wrapper').addClass('pagination-default');
        } else {
            $('.products-wrapper').removeClass('pagination-default').addClass(pag);
        }
    });

    $(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');

    $(".qtybutton").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    if ( $(".venam-open-popup").length ) {
        $(".venam-open-popup").magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: false,
            preloader: false,
            midClick: true,
            removalDelay: 0,
            mainClass: 'venam-mfp-slide-bottom',
            callbacks: {
                open: function() {
                    $("html").css('overflow', 'hidden');
                },
                close: function() {
                    $("html").removeAttr('style');
                }
            }
        });
    }

    if ( $(window).width() <= 1024 && $('#nt-sidebar').length ) {
        $('body').addClass('shop-sidebar-fixed');
    }

    if ( !$('body').hasClass('venam-ajax-shop') ){

        $('.open-sidebar, .close-sidebar').on('click', function () {
            $('.shop-sidebar-fixed #nt-sidebar').toggleClass('active');
        });
    }

    $(window).on('resize', function(){
        if ( $('.full-fixed-sidebar').length || !$('#nt-sidebar').length ) {
            return;
        }
        if ( $('body').hasClass('shop-sidebar-default') ){
            if ( $(window).width() <= 1024 ){
                $('body').addClass('shop-sidebar-fixed');
                $('.shop-sidebar-toggle,#nt-sidebar .close-sidebar').removeClass('hide-toggle-btn');
            } else {
                $('body').removeClass('shop-sidebar-fixed');
                $('.shop-sidebar-toggle,#nt-sidebar .close-sidebar').addClass('hide-toggle-btn');
            }
        }
    });

    if ( $(window).width() < 992 && $(".venam-bottom-mobile-nav").length ) {
        $("body").addClass('has-bottom-fixed-menu');
    }

    if ( $(".venam-product-video-button").length ) {
        $(".venam-product-video-button").magnificPopup({
            type: 'iframe'
        });
    }

    if ( $(".venam-product-stock-progressbar").length ) {
        var percent = $(".venam-product-stock-progressbar").data('stock-percent');
        $(".venam-product-stock-progressbar").css('width',percent);
    }

    $(document).on('ready', function(e){
        if (typeof wpcvs.Swatches !== 'undefined') {
            $('.products-wrapper .variations_form').each(function () {
                $(this).wc_variation_form();
            });
        }
    });

    $('.product:not(.product-type-external) form.cart').on('submit', function(e) {
            e.preventDefault();

            var form  = $(this),
                btn   = form.find('.theme-button'),
                title = btn.text(),
                added = btn.data('added-title');

            btn.addClass('loading');

            //form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

        var formData = new FormData(form[0]);
        formData.append('add-to-cart', form.find('[name=add-to-cart]').val() );

        // Ajax action.
        $.ajax({
            url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'venam_add_to_cart' ),
            data: formData,
            type: 'POST',
            processData: false,
            contentType: false,
            complete: function( response ) {
                response = response.responseJSON;

                // Redirect to cart option
                if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                    window.location = wc_add_to_cart_params.cart_url;
                    return;
                }
                if ( ! response ) {
                    return;
                }
                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return;
                }

                var $thisbutton = form.find('.single_add_to_cart_button'); //
                var $thisbutton = null; // uncomment this if you don't want the 'View cart' button

                // Trigger event so themes can refresh other areas.
                $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );

                btn.removeClass('loading');
                btn.html(added);
                btn.addClass('added');

                setTimeout(function(){
                    btn.html(title);
                    btn.removeClass('added');
                }, 3000 );

                var $notices = response.fragments.notices_html;

                $('.venam-popup-notices .venam-popup-notices-header').html($notices);

                if ( $notices.indexOf('woocommerce-message') > -1 )
                {
                    $('.venam-popup-notices').addClass('slide-in woocommerce-message');
                }

                if ( $notices.indexOf('woocommerce-error') > -1 )
                {
                    $('.venam-popup-notices').addClass('slide-in woocommerce-error');
                }

                setTimeout(function() {
                    $('.venam-popup-notices').removeClass('slide-in');
                    setTimeout(function() {
                        $('.venam-popup-notices').removeClass('woocommerce-error woocommerce-message');
                    }, 1000);
                }, 4000);

                // Remove existing notices
                //$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();

                // Add new notices
                //form.closest('.product').before(response.fragments.notices_html)

                //form.unblock();
            }
        });
    });

    $('body').on('venamShopNoticesUpdtae',function() {

        $('.venam-popup-notices:not(.slide-in) > .woocommerce-message,.venam-popup-notices:not(.slide-in) > .woocommerce-error').each(function(i,e){
            $(e).remove();
        });
    });

    $('.venam-popup-notices .woocommerce-notices-wrapper').remove();

    // AJax single add to cart
    $(document).on('click', 'a.ajax_add_to_cart', function(e){
        e.preventDefault();

        var $thisbutton = $(this);
        var $qty        = $thisbutton.closest( '.cart-with-quantity' ).find( '.qty' );
        var $min        = parseFloat( $qty.attr( 'min' ) );
        var $max        = parseFloat( $qty.attr( 'max' ) );
        var $qty_val    = parseFloat( $qty.val() );
        var new_val;

        if ( $qty_val === 0 ) {
            new_val = 1;
        } else if ( $qty_val === 1 ) {
            new_val = 2;
        } else {
            new_val = $qty_val + parseFloat( $thisbutton.data('quantity') )
        }

        if ( $qty_val >= 0 ) {
            if ( $max && ( $max === $qty_val || $qty_val > $max || $max === new_val ) ) {
                $qty.val( $max ).trigger('change');
                $thisbutton.parents('.cart-with-quantity').addClass('has-max-quntity');
                $thisbutton.parents('.cart-with-quantity').find('.plus').addClass('disabled');
            } else {
                $qty.val( new_val ).trigger('change');
            }
        }

        var formData = new FormData();
        formData.append('add-to-cart', $thisbutton.attr( 'data-product_id' ));

        // Trigger event.
        $( document.body ).trigger( 'adding_to_cart', [ $thisbutton, formData ] );

        // Ajax action.
        $.ajax({
            url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'venam_add_to_cart' ),
            data: formData,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function( response ) {
                if ( ! response ) {
                    return;
                }

                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return;
                }

                // Redirect to cart option
                if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                    window.location = wc_add_to_cart_params.cart_url;
                    return;
                }

                var $notices = response.fragments.notices_html;

                $thisbutton.removeClass('loading').addClass('added');

                $thisbutton.parents('.cart-with-quantity').removeClass('svg-loading').addClass('quntity-open');

                $($notices).prependTo('.venam-popup-notices');

                var message_id = $thisbutton.attr( 'data-product_id' );

                if ( $notices.indexOf('woocommerce-message') > -1 || $notices.indexOf('woocommerce-error') > -1 ) {
                    $('.venam-popup-notices').addClass('slide-in');
                }
                setTimeout(function() {
                    $('.venam-popup-notices').removeClass('slide-in');
                    setTimeout(function() {
                        $('body').trigger('venamShopNoticesUpdtae');
                    }, 500);
                }, 4000);

                if ( $notices.indexOf('woocommerce-error') > -1 ) {
                    window.stop();
                }
            },
            dataType: 'json'
        });
    });

    // AJax single add to cart
    $(document).on('click', 'a.remove_from_cart_button', function(e){
        var product_id = $(this).data('product_id');
        var min_qty = $('.cart-with-quantity[data-product_id="'+product_id+'"] .qty').attr('min');
        $(this).parents('.woocommerce-mini-cart-item').addClass('loading');
        $('.cart-with-quantity[data-product_id="'+product_id+'"]').removeClass('has-max-quntity quntity-open product-in-cart');
        $('.cart-with-quantity[data-product_id="'+product_id+'"] .plus' ).removeClass('disabled');
        $('.cart-with-quantity[data-product_id="'+product_id+'"] .added').removeClass('added');
        $('.cart-with-quantity[data-product_id="'+product_id+'"] a.added_to_cart').remove();
        $('.cart-with-quantity[data-product_id="'+product_id+'"] .qty').val(min_qty).trigger('change');
        $('.action-cart > a.ajax_add_to_cart[data-product_id="'+product_id+'"]').removeClass('added');
        $('.action-cart > a.ajax_add_to_cart[data-product_id="'+product_id+'"] + a.added_to_cart').remove();
    });

    shopCatsSlider();
    $(document).on('venamShopInit', function() {
        shopCatsSlider();
    });
    function shopCatsSlider() {
        if ( $('.slick-slider.slick-initialized').length ) {
            return;
        }
        var product_cats = $('.shop-area .slick-slide.product-category');

        if ( product_cats.length ) {
            product_cats.each(function (i, el) {
                $(this).appendTo('.shop-slider-categories .slick-slider');
            });
            var myContainer = $('.shop-slider-categories');
            var mySlick = $('.slick-slider', myContainer);
            mySlick.not('.slick-initialized').slick({
                autoplay: false,
                slidesToShow: 6,
                speed: 500,
                focusOnSelect: true,
                infinite: false,
                prevArrow: '.slide-prev-cats',
                nextArrow: '.slide-next-cats',
                responsive: [
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 5
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 6
                        }
                    }
                ]
            });
        }
    }


    $(".flex-control-thumbs").addClass("product-thumbnails");
    var vertical = false;
    if ( $(".woocommerce-product-gallery").hasClass("images_vertical") && $(window).width() > 992 ) {
        vertical = true;
    }

    function is_mobile(){
        $(window).resize( function(){
            vertical = ( $(window).width() <= 992 ) ? false : true;
            return vertical;
        });
        return vertical;
    }
    if ( $('.woocommerce-product-gallery').length ) {
        $('.product-thumbnails').slick({
            dots: false,
            arrows: true,
            prevArrow: '<div class="prev"><i class="fas fa-angle-left"></i></div>',
            nextArrow: '<div class="next"><i class="fas fa-angle-right"></i></div>',
            autoplay: false,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 1,
            rows: 1,
            focusOnSelect: true,
            infinite: false,
            vertical: vertical,
            useTransform: true,
            cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
            adaptiveHeight: false,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 6
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 5
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 4
                    }
                }
            ]
        });
        if ($(".slick-arrow" ).length) {
            $(".flex-control-nav" ).addClass( "has-navigation" );
        }

        $(".flex-viewport, .flex-control-nav" ).wrapAll( "<div class='slider-wrapper'></div>" );
    }


    var viewingItem = $('.venam-product-view'),
        data        = viewingItem.data('product-view'),
        countView   = viewingItem.find('.venam-view-count'),
        current     = 0,
        change_counter;

    function singleProductFakeView() {

        if ( viewingItem.length ) {
            var min    = data.min,
                max    = data.max,
                delay  = data.delay,
                change = data.change,
                id     = data.id;

            if ( !viewingItem.hasClass( 'inited' ) ) {
                if ( typeof change !== 'undefined' && change ) {
                    clearInterval( change );
                }

                current = $.cookie( 'venam_cpv_' + id );

                if ( typeof current === 'undefined' || !current ) {
                    current = Math.floor(Math.random() * max) + min;
                }

                viewingItem.addClass('inited');

                $.cookie('venam_cpv_' + id, current, { expires: 1 / 24, path: '/'} );

                countView.html( current );

            }

            change_counter = setInterval( function() {
                current = parseInt( countView.text() );

                if ( !current ) {
                    current = min;
                }

                var pm = Math.floor( Math.random() * 2 );
                var others = Math.floor( Math.random() * change + 1 );
                current = ( pm < 1 && current > others ) ? current - others : current + others;
                $.cookie('venam_cpv_' + id, current, { expires: 1 / 24, path: '/'} );

                countView.html( current );

            }, delay);
        }
    }

    singleProductFakeView();
});
