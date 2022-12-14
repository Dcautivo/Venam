(function(window, document, $) {

  "use strict";

	jQuery(document).ready(function( $ ) {

        // masonry
        var masonry = $('.nt-masonry-container');
        if ( masonry.length ) {
            //set the container that Masonry will be inside of in a var
            var container = document.querySelector('.nt-masonry-container');
            //create empty var msnry
            var msnry;
            // initialize Masonry after all images have loaded
            imagesLoaded( container, function() {
               msnry = new Masonry( container, {
                   itemSelector: '.nt-masonry-container>div'
               });
            });
        }

        var block_check = $('.nt-single-has-block');
        if ( block_check.length ) {
            $( ".nt-theme-content ul" ).addClass( "nt-theme-content-list" );
            $( ".nt-theme-content ol" ).addClass( "nt-theme-content-number-list" );
        }

        // add class for wishlist empty table
        var wishlistTable = $( "#yith-wcwl-form .shop_table" );
        var emptyTable = $( "#yith-wcwl-form .shop_table .wishlist-empty" );
        if ( emptyTable.length ) {
            wishlistTable.addClass('empty_table');
        } else {
            wishlistTable.removeClass('empty_table');
        }

        // add class for bootstrap table
        $( ".menu-item-has-shortcode" ).parent().parent().addClass( "menu-item-has-shortcode-parent" );
        $( ".nt-theme-content table, #wp-calendar" ).addClass( "table table-striped" );
        $( ".woocommerce-order-received .nt-theme-content table" ).removeClass( "table table-striped" );
        // CF7 remove error message
        $('.wpcf7-response-output').ajaxComplete(function(){
            window.setTimeout(function(){
                $('.wpcf7-response-output').addClass('display-none');
            }, 4000); //<-- Delay in milliseconds
            window.setTimeout(function(){
                $('.wpcf7-response-output').removeClass('wpcf7-validation-errors display-none');
                $('.wpcf7-response-output').removeAttr('style');
            }, 4500); //<-- Delay in milliseconds
        });

        $('.catalog--ordering form.woocommerce-ordering select').niceSelect();

    }); // end ready

    // preloader
    $(window).load(function () {
        // Animate loader off screen
       $('#nt-preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

})(window, document, jQuery);
