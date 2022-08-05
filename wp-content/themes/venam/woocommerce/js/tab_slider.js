jQuery(document).ready(function($) {
    "use strict";

    $(document).on('click', '.wc-tab-slider .tab_nav_item:not(.loaded)', function(event){

        var $this = $(this),
        cat_id = $this.data('cat-id'),
        parents = $this.parents('.wc-tab-slider'),
        per_page = $this.parents('.wc-tab-slider').data('per-page'),
        height = $this.parents('.wc-tab-slider').outerHeight(),
        data = {
            action: 'venam_ajax_tab_slider',
            cat_id: cat_id,
            per_page: per_page,
            beforeSend: function() {
                parents.addClass('loading');
            },
        };
        console.log(height);

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(myAjax.ajaxurl, data, function(response) {

            console.log(cat_id);

            $('.tab_slider[data-cat-id="'+cat_id+'"] .swiper-wrapper').append(response);

            $this.addClass('loaded');

            $('.tab_slider[data-cat-id="'+cat_id+'"] .thm-tab-slider').each(function () {
                const options = JSON.parse(this.dataset.swiperOptions);
                var mySwiper = new Swiper( $(this), options );
            });
            $('.tab_slider[data-cat-id="'+cat_id+'"] .variations_form').each(function () {
                $(this).wc_variation_form();
            });

            parents.removeClass('loading');
        });
    });

});
