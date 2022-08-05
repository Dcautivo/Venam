jQuery(document).ready(function ($) {

    $(document).on( 'ready', function(){
        var obj = $('.products-wrapper').data('shop-filters');
        if ( $('.wpc-filter-chips-list').length ) {
            $('.row-infinite').slideUp('slow');
            obj.per_page = -1;
        } else {
            $(window).scrollTop(0);
            obj.current_page = 1;
        }
    });

    $(document).on('venamShopInit', function () {
        infinitescroll();
    });

    function infinitescroll() {

        $(window).data('ajaxready', true).scroll(function(e) {
            
            if ($(window).data('ajaxready') == false) return;

            if( $(window).scrollTop() >= $('div.products').offset().top + $('div.products.wc--row').outerHeight() - window.innerHeight ) {

                $(window).data('ajaxready', false);

                venam_infinite_pagination();

            }
        });
    }

    infinitescroll();

    function venam_infinite_pagination() {
        var object = $('.products-wrapper').data('shop-filters');
        var data = {
            cache      : false,
            action     : 'load_more',
            beforeSend : function() {
                if ( object.current_page == object.max_page ) {
                    $('.venam-load-more').addClass('no-more').text(object.no_more);
                    setTimeout(function(){
                        $('.row-infinite').slideUp('slow');
                    }, 3000);
                } else {
                    $('.venam-load-more').addClass('loading');
                }
            },
            'ajaxurl'      : object.ajaxurl,
            'current_page' : object.current_page,
            'per_page'     : object.per_page,
            'max_page'     : object.max_page,
            'cat_id'       : object.cat_id,
            'filter_cat'   : object.filter_cat,
            'layered_nav'  : object.layered_nav,
            'on_sale'      : object.on_sale,
            'orderby'      : object.orderby,
            'min_price'    : object.min_price,
            'max_price'    : object.max_price,
            'product_type' : object.product_type,
            'no_more'      : object.no_more
        };

        $.post(object.ajaxurl, data, function(response) {

            if ( $('.wpc-filter-chips-list').length ) {
                $('.row-infinite').slideUp('slow');
                return;
            }

            $('div.products.wc--row').append(response);

            if ( object.current_page == object.max_page ) {
                $('.venam-load-more').addClass('no-more').text(object.no_more);
                setTimeout(function(){
                    $('.row-infinite').slideUp('slow');
                }, 3000);
                return false;
            }

            object.current_page++;

            if ( object.current_page == object.max_page ) {
                $('.venam-load-more').addClass('no-more').text(object.no_more);
                setTimeout(function(){
                    $('.row-infinite').slideUp('slow');
                }, 3000);
                return false;
            }

            $(window).data('ajaxready', true);
        });

        return false;
    }
});
