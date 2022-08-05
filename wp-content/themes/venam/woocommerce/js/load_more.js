jQuery(document).ready(function($) {
    "use strict";

    $(document).on( 'ready', function(){

        if ( $('.wpc-filter-chips-list').length ) {

            $('.row-more').slideUp('slow');
            $('.woocommerce-pagination').slideDown('slow');

            loadmore.current_page = 1;
        }
    });

    $(document).on('click', '.venam-load-more', function(event){

        event.preventDefault();
        var loading = $('.venam-load-more').data('title');
        var more = $('.venam-load-more').text();
        var obj = $('.products-wrapper').data('shop-filters');

        var data = {
            cache      : false,
            action     : 'load_more',
            beforeSend : function() {
                $('.venam-load-more').html(loading).addClass('loading');
            },
            'ajaxurl'      : obj.ajaxurl,
            'current_page' : obj.current_page,
            'max_page'     : obj.max_page,
            'per_page'     : obj.per_page,
            'layered_nav'  : obj.layered_nav,
            'cat_id'       : obj.cat_id,
            'filter_cat'   : obj.filter_cat,
            'on_sale'      : obj.on_sale,
            'orderby'      : obj.orderby,
            'min_price'    : obj.min_price,
            'max_price'    : obj.max_price,
            'product_type' : obj.product_type,
            'no_more'      : obj.no_more
        };
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(obj.ajaxurl, data, function(response) {

            $('div.products.wc--row').append(response);

            obj.current_page++;

            $('.venam-load-more').html(more).removeClass('loading');

            if ( obj.current_page == obj.max_page ) {
                $('.venam-more').remove();
            }

        });
    });
});
