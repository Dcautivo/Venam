!(function ($) {
    "use strict";
    jQuery(document).ready(function($) {

        $(document).on('click', '.wc-tab-slider .tab_nav_item:not(.loaded)', function(event){

            var $this    = $(this),
                cat_id   = $this.data('cat-id'),
                scope_id   = $this.data('scope-id'),
                parents  = $this.parents('.wc-tab-slider'),
                per_page = parents.data('per-page'),
                height   = $this.parents('.wc-tab-slider').outerHeight(),
                data     = {
                    action     : 'venam_ajax_tab_slider',
                    cat_id     : cat_id,
                    per_page   : per_page,
                    beforeSend : function() {
                        parents.addClass('loading');
                    }
                };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            $.post(tabAjax.ajaxurl, data, function(response) {

                $('.tab_slider[data-cat-id="'+cat_id+'"] div[data-scope-id="'+scope_id+'"] .swiper-wrapper').append(response);

                $this.addClass('loaded');

                $('.tab_slider[data-cat-id="'+cat_id+'"] .thm-tab-slider[data-scope-id="'+scope_id+'"]').each(function (e,i) {
                    const options = $(i).data('swiper-options');
                    var mySwiper = new Swiper( this, options );
                    mySwiper.update();
                });

                $('.tab_slider[data-cat-id="'+cat_id+'"][data-scope-id="'+scope_id+'"] .variations_form').each(function () {
                    $(this).wc_variation_form();
                });

                parents.removeClass('loading');
            });
        });
    });

    function venamWcTabbedSlider($scope, $) {

        $scope.find('.wc-tab-slider').each(function () {
            var myWrapper = $( this );
            var myTabs = myWrapper.find('.tab');
            if (myTabs.length) {
                myTabs.each(function (i, el) {
                    var myTab = $(el);
                    var myTabItems = $('.tab_nav .tab_nav_item', myTab);
                    var myTabPages = $('.tab_page', myTab);
                    var myTabToggle = $('.tab_nav_toggle_button', myTab);
                    var myNav = $('.tab_nav', myTab);
                    var myActiveTab = myTabItems.first();
                    if (myTabItems.filter('.is-active').length) {
                        myActiveTab = myTabItems.filter('.is-active').first();
                    }
                    var myActiveTabId = myActiveTab.data('cat-id');
                    myTabItems.filter('[data-cat-id="'+ myActiveTabId +'"]').addClass('is-active');
                    myTabPages.filter('[data-cat-id="'+ myActiveTabId +'"]').addClass('is-active');
                    myTabItems.on('click', function (e) {
                        e.preventDefault();
                        var self = $(this);
                        var selfId = self.data('cat-id');
                        myTabItems.removeClass('is-active');
                        myTabPages.removeClass('is-active');
                        self.addClass('is-active');
                        myTabPages.filter('[data-cat-id="'+ selfId +'"]').addClass('is-active');
                        if(myNav.hasClass('is-active')){
                            myNav.removeClass('is-active');
                        }
                    });

                    myTabToggle.on('click', function (e) {
                        if(myNav.hasClass('is-active')){
                            myNav.removeClass('is-active');
                        } else {
                            myNav.addClass('is-active');
                        }
                    });
                });
            }
        });

        $scope.find('.tab_slider.is-active .thm-tab-slider').each(function (el,i) {
            const options = $(i).data('swiper-options');
            let mySwiper = new Swiper(i, options);
        });

        var height = $scope.find('.wc-tab-slider').outerHeight();
        $scope.find('.wc-tab-slider').css('min-height',height);

    }
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/venam-woo-tab-slider.default', venamWcTabbedSlider);
    });
})(jQuery);
