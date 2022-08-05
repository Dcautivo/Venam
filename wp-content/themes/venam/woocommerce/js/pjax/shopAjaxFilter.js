(function($) {

    var $doc  = $(document),
        $win  = $(window),
        $body = $('body'),
        links = '.woocommerce .widget_rating_filter ul li a, .widget_product_categories a, .woocommerce-widget-layered-nav a, body.post-type-archive-product:not(.woocommerce-account) .woocommerce-pagination a, body.tax-product_cat:not(.woocommerce-account) .woocommerce-pagination a, .woocommerce-widget-layered-nav-list a, .top-action a, .venam-choosen-filters a, .widget_product_tag_cloud a, .venam-wc-per-page a, .venam-woo-breadcrumb .breadcrumb li a, .shop-slider-categories .slick-slide a, .venam-remove-filter a, .venam-product-status a, .venam-widget-product-categories a',
        sidebar_links = '.nt-sidebar-inner .widget_rating_filter ul li a, .nt-sidebar-inner .widget_product_categories a, .nt-sidebar-inner .woocommerce-widget-layered-nav a, .nt-sidebar-inner .woocommerce-widget-layered-nav-list a, .nt-sidebar-inner .venam-choosen-filters a, .nt-sidebar-inner .widget_product_tag_cloud a, .nt-sidebar-inner .venam-remove-filter a, .nt-sidebar-inner .venam-product-status a, .nt-sidebar-inner .venam-widget-product-categories a';

        function sortOrder() {
            var $order = $('.woocommerce-ordering');
            $order.on('change', 'select.orderby', function() {
                var $form = $(this).closest('form');
                $form.find('[name="_pjax"]').remove();

                $.pjax({
                    container: '.page-wrapper',
                    timeout  : 5000,
                    url      : '?' + $form.serialize(),
                    scrollTo : false,
                    renderCallback: function(context, html, afterRender) {
                        context.html(html);
                        afterRender();
                        $doc.trigger('venamShopInit');
                        if ( $('body').hasClass('shop-sidebar-fixed') ){
                            $('body').off('click', '.open-sidebar').on('click', '.open-sidebar', function () {
                                $('.shop-sidebar-fixed #nt-sidebar').addClass('active');
                                $('body.shop-sidebar-fixed').removeClass('sidebar-open');
                            });
                            $('body').off('click', '.close-sidebar').on('click', '.close-sidebar', function () {
                                $('.shop-sidebar-fixed #nt-sidebar').removeClass('active');
                                $('body.shop-sidebar-fixed').removeClass('sidebar-open');
                            });
                        }
                    }
                });
            });

        $order.on('submit', function(e) {
            return false;
        });
    }

    function perPage() {
        var $perPage = $('.products-per-page');
        $perPage.on('change', 'select.perpage', function() {
            var $form = $(this).closest('form');
            $form.find('[name="_pjax"]').remove();

            $.pjax({
                container: '.page-wrapper',
                timeout  : 5000,
                url      : '?' + $form.serialize(),
                scrollTo : false,
                renderCallback: function(context, html, afterRender) {
                    context.html(html);
                    afterRender();
                    $doc.trigger('venamShopInit');
                }
            });
        });

        $perPage.on('submit', function(e) {
            e.preventDefault(e);
        });
    }

    function priceSlider() {

        $( document.body ).on( 'price_slider_create price_slider_slide', function( event, min, max ) {

            $( '.price_slider_amount span.from' ).html( accounting.formatMoney( min, {
                symbol:    woocommerce_price_slider_params.currency_format_symbol,
                decimal:   woocommerce_price_slider_params.currency_format_decimal_sep,
                thousand:  woocommerce_price_slider_params.currency_format_thousand_sep,
                precision: woocommerce_price_slider_params.currency_format_num_decimals,
                format:    woocommerce_price_slider_params.currency_format
            } ) );

            $( '.price_slider_amount span.to' ).html( accounting.formatMoney( max, {
                symbol:    woocommerce_price_slider_params.currency_format_symbol,
                decimal:   woocommerce_price_slider_params.currency_format_decimal_sep,
                thousand:  woocommerce_price_slider_params.currency_format_thousand_sep,
                precision: woocommerce_price_slider_params.currency_format_num_decimals,
                format:    woocommerce_price_slider_params.currency_format
            } ) );

            $( document.body ).trigger( 'price_slider_updated', [ min, max ] );
        });

        function initPriceFilter() {
            $( 'input#min_price, input#max_price' ).hide();
            $( '.price_slider, .price_label' ).show();

            var min_price         = $( '.price_slider_amount #min_price' ).data( 'min' ),
                max_price         = $( '.price_slider_amount #max_price' ).data( 'max' ),
                step              = $( '.price_slider_amount' ).data( 'step' ) || 1,
                current_min_price = $( '.price_slider_amount #min_price' ).val(),
                current_max_price = $( '.price_slider_amount #max_price' ).val();

            $( '.price_slider:not(.ui-slider)' ).slider({
                range  : true,
                animate: true,
                min    : min_price,
                max    : max_price,
                step   : step,
                values : [ current_min_price, current_max_price ],
                create : function() {

                    $( '.price_slider_amount #min_price' ).val( current_min_price );
                    $( '.price_slider_amount #max_price' ).val( current_max_price );

                    $( document.body ).trigger( 'price_slider_create', [ current_min_price, current_max_price ] );
                },
                slide: function( event, ui ) {

                    $( 'input#min_price' ).val( ui.values[0] );
                    $( 'input#max_price' ).val( ui.values[1] );

                    $( document.body ).trigger( 'price_slider_slide', [ ui.values[0], ui.values[1] ] );
                },
                change: function( event, ui ) {

                    $( document.body ).trigger( 'price_slider_change', [ ui.values[0], ui.values[1] ] );
                }
            });
        }

        initPriceFilter();
        $( document.body ).on( 'init_price_filter', initPriceFilter );

        var hasSelectiveRefresh = (
            'undefined' !== typeof wp &&
            wp.customize &&
            wp.customize.selectiveRefresh &&
            wp.customize.widgetsPreview &&
            wp.customize.widgetsPreview.WidgetPartial
        );
        if ( hasSelectiveRefresh ) {
            wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function() {
                initPriceFilter();
            } );
        }

        var $min_price = $('.price_slider_amount #min_price');
        var $max_price = $('.price_slider_amount #max_price');
        var $products  = $('.products');

        if (typeof woocommerce_price_slider_params === 'undefined' || $min_price.length < 1 || !$.fn.slider) {
            return false;
        }

        var $slider = $('.price_slider');

        if ($slider.slider('instance') !== undefined) {
            return;
        }

        $('input#min_price, input#max_price').hide();
        $('.price_slider, .price_label').show();

        var min_price         = $min_price.data('min'),
            max_price         = $max_price.data('max'),
            current_min_price = parseInt(min_price, 10),
            current_max_price = parseInt(max_price, 10);

        if ($products.attr('data-min_price') && $products.attr('data-min_price').length > 0) {
            current_min_price = parseInt($products.attr('data-min_price'), 10);
        }

        if ($products.attr('data-max_price') && $products.attr('data-max_price').length > 0) {
            current_max_price = parseInt($products.attr('data-max_price'), 10);
        }

        $slider.slider({
            range  : true,
            animate: true,
            min    : min_price,
            max    : max_price,
            values : [
                current_min_price,
                current_max_price
            ],
            create : function() {
                $min_price.val(current_min_price);
                $max_price.val(current_max_price);

                $body.trigger('price_slider_create', [
                    current_min_price,
                    current_max_price
                ]);
            },
            slide  : function(event, ui) {
                $('input#min_price').val(ui.values[0]);
                $('input#max_price').val(ui.values[1]);

                $body.trigger('price_slider_slide', [
                    ui.values[0],
                    ui.values[1]
                ]);
            },
            change : function(event, ui) {
                $body.trigger('price_slider_change', [
                    ui.values[0],
                    ui.values[1]
                ]);
            }
        });

        setTimeout(function() {
            $body.trigger('price_slider_create', [
                current_min_price,
                current_max_price
            ]);

            if ($slider.find('.ui-slider-range').length > 1) {
                $slider.find('.ui-slider-range').first().remove();
            }
        }, 10);
    }

    function ajaxHandler() {

        $doc.pjax(links, '.page-wrapper', {
            timeout       : 5000,
            scrollTo      : false,
            renderCallback: function(context, html, afterRender) {
                context.html(html);
                afterRender();
            }
        });

        $doc.on('submit', '.widget_price_filter form', function(event) {
            $.pjax.submit(event, '.page-wrapper');
        });

        $doc.on('pjax:error', function(xhr, textStatus, error) {
            console.log('pjax error ' + error);
        });

        $doc.on('pjax:start', function() {
            scrollToTop();
            var $shopContent = $('.products-wrapper');
            $shopContent.addClass('ajax-loading');
            $shopContent.append('<svg class="loader-svg-image preloader" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg></div>');
            $(".products, .venam-more, nav.woocommerce-pagination").hide();
        });

        $doc.on('pjax:complete', function() {

            var $filters = $('.products-wrapper').data('shop-filters');
            if ( $filters.max_page == 1 ) {
                $(".row-more").hide();
            }

            $doc.trigger('venamShopInit');
        });

        $doc.on('pjax:end', function() {

            $('.products-wrapper').addClass('ajax-loaded');
            //$('body').removeClass('sidebar-open');

        });

        var scrollToTop = function() {
            var height = 15;
            if( $('#sticky-header').length ) {
                if( !$('#sticky-header').hasClass('sticky-menu') ) {
                    height = 200;
                } else {
                    height = 100;
                }
            }
            $('html, body').stop().animate({
                scrollTop: $('.venam-ajax-scroll-target').offset().top - height
            }, 400);
        };
    }

    function buttonsActions() {
        //Header cart Toggle
        $('.open-sidebar, .close-sidebar').on('click', function () {
            $('.shop-sidebar-fixed #nt-sidebar').toggleClass('active');
            $('body.shop-sidebar-fixed').removeClass('sidebar-open');
        });
        //Header cart Toggle
        $('.venam-cart-btn').on('click', function () {
            $('.venam-header-cart-details.minicart').toggleClass('active');
        });
    }

    function venamDealsCountDown() {
        $('[data-countdown]').each(function () {
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

    function venamMobileSidebarLinks() {
        $(sidebar_links).on('click', function() {
            $(this).addClass('ajax-loading');
            $('body').addClass('sidebar-open');
        });
    }
    function venamMobileSidebarTrigger() {
        if ( $('body').hasClass('sidebar-open') ) {
            $('.venam-mobile-sidebar-toggle .open-sidebar').trigger('click');
        }
    }
    function venamMobileSidebarScroll() {
        $(".shop-sidebar-fixed .nt-sidebar-inner").scroll(function(){
            var filtersH = $('.venam-choosen-filters').innerHeight();
            if ( $(this).scrollTop() > 100 ) {
                $(this).addClass( 'scroll-start' );
            } else {
                $(this).removeClass( 'scroll-start' );
            }
        });
        $(".shop-sidebar-fixed .nt-sidebar-inner").removeClass( 'scroll-start' );
    }

    $doc.on('venamShopInit', function() {

        sortOrder();
        perPage();
        priceSlider();
        buttonsActions();
        venamDealsCountDown();
        venamMobileSidebarLinks();
        venamMobileSidebarTrigger();
        venamMobileSidebarScroll();

        $('.woocommerce-ordering select').niceSelect();
        if (typeof wpcvs.Swatches !== 'undefined') {
            $('.products-wrapper .variations_form').each(function () {
                $(this).wc_variation_form();
            });
        }
    });

    $doc.ready(function() {
            sortOrder();
            perPage();
            buttonsActions();
            venamMobileSidebarScroll();
            venamMobileSidebarLinks();
            ajaxHandler();
            if ( $('body').hasClass('shop-sidebar-fixed') ){
                $('body').off('click', '.open-sidebar').on('click', '.open-sidebar', function () {
                    $('.shop-sidebar-fixed #nt-sidebar').addClass('active');
                    $('body.shop-sidebar-fixed').removeClass('sidebar-open');
                });
                $('body').off('click', '.close-sidebar').on('click', '.close-sidebar', function () {
                    $('.shop-sidebar-fixed #nt-sidebar').removeClass('active');
                    $('body.shop-sidebar-fixed').removeClass('sidebar-open');
                });
            }
        });

})(jQuery);
