/**
 * frontend.js
 *
 * @author Your Inspiration Themes
 * @package venam WooCommerce Ajax Search
 * @version 1.1.1
 */

jQuery(function ($) {
    "use strict";

    var el = $('.venam-as'),
        def_loader = ( typeof woocommerce_params != 'undefined' && typeof woocommerce_params.ajax_loader_url != 'undefined' ) ? woocommerce_params.ajax_loader_url : venam_as_params.loading,
        loader_icon = def_loader,
        search_btn = $('#venam-searchsubmit'),
        min_chrs = el.data('min-chars'),
        ajaxurl = venam_as_params.ajax_url;

    if ( ajaxurl.indexOf('?') == -1 ) {
        ajaxurl += '?';
    }

    search_btn.on('click', function () {
        var form = $(this).closest('form');
        if ( form.find('.venam-as').val() == '' ) {
            return false;
        }
        return true;
    });

    if ( el.length == 0 ) el = $('#venam-as');

    el.each(function () {
        var $t = $(this),
            loader = $('.search-icon'),
            append_to = (typeof  $t.data('append-to') == 'undefined') ? $t.closest('.venam-asform-container') : $t.closest($t.data('append-to'));
        var escapeRegExChars = function (value) {
            return value.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
        };
        $t.venamautocomplete({
            minChars: min_chrs,
            appendTo: append_to,
            maxHeight: 400,
            triggerSelectOnValidInput: false,
            serviceUrl: ajaxurl + 'action=venam_as_products',
            onSearchStart: function () {
                loader.addClass('loading');
            },
            onSelect: function (suggestion) {
                if (suggestion.id != -1) {
                    window.location.href = suggestion.url;
                }
            },
            onSearchComplete: function ( suggestion ) {
                loader.removeClass('loading');
            },
            formatResult : function (suggestion, currentValue) {
                if ( 'No results' == suggestion.value ) {
                    return '<strong>'+ suggestion.value +'</strong>';
                } else {
                    var pattern = '(' + escapeRegExChars(currentValue) + ')';
                    var val =  suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
                    var html = '<img width="50" height="50" src="' + suggestion.img + '"/>';
                        html += '<span class="value">'+ val +'</span>';
                        html += '<span>'+ suggestion.prc +'</span>';
                    return html;
                }
            }
        });
    });
});
