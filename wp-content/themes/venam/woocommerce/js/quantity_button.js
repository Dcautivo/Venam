jQuery(document).ready(function($) {

    "use strict";

    $('.product-in-cart .add_to_cart_button').each(function() {
        $(this).addClass('added');
    });

    $('body').on('venamShopNotices',function() {
        if ( !$('.venam-popup-notices .ninetheme-cart-update-message').length ) {
            $('.venam-popup-notices').removeClass('slide-in');
        }
    });

    $('body').off('click.qtyBtn').on('click.qtyBtn','.plus, .minus', function() {

        var $this = $(this);

        if ( $this.parents('form.cart').length ){
            var $qty    = $( this ).closest( '.quantity' ).find( '.qty' ),
                qty_val = parseFloat( $qty.val() ),
                max     = parseFloat( $qty.attr( 'max' ) ),
                min     = parseFloat( $qty.attr( 'min' ) ),
                step    = $qty.attr( 'step' ),
                new_val = 0;

            if ( ! qty_val || qty_val === '' || qty_val === 'NaN' ) {
                qty_val = 0;
            }
            if ( max === '' || max === 'NaN' ) {
                max = '';
            }
            if ( min === '' || min === 'NaN' ) {
                min = 0;
            }
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
                step = 1;
            } else {
                step = parseFloat(step);
            }

            // Update values
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( max === qty_val || qty_val > max ) ) {
                    $qty.val( max );
                    $( this ).addClass('disabled');
                } else {
                    new_val = qty_val + parseFloat( step );
                    $qty.val( new_val );
                    if ( max && ( max === new_val || new_val > max ) ) {
                        $( this ).addClass('disabled');
                    }
                    $qty.trigger('change');
                }
            } else {
                if ( min && ( min === qty_val || qty_val < min ) ) {
                    $qty.val( min );
                    $( this ).addClass('disabled');
                } else if ( qty_val > 0 ) {
                    new_val = qty_val - parseFloat( step );
                    $qty.val( new_val );
                    if ( min && ( min === new_val || new_val < min ) ) {
                        $( this ).addClass('disabled');
                    }
                    $qty.trigger('change');
                }
            }

        } else {

            var wrapper   = $this.parents( '.cart-with-quantity' ).length ? $this.parents( '.cart-with-quantity' ) : $this.parents( '.product-quantity' ),
                qty_input = wrapper.find( '.qty' );

            if ( $(qty_input).prop('disabled') ) return;

            var qty_step   = parseFloat($(qty_input).attr('step')),
                qty_min    = parseFloat($(qty_input).attr('min')),
                qty_max    = parseFloat($(qty_input).attr('max')),
                product_id = wrapper.data('product_id'),
                loop_id    = '.cart-with-quantity[data-product_id="'+product_id+'"]',
                vl         = parseFloat($(qty_input).val()),
                vll        = $this.is('.minus') ? ( (vl - qty_step) < qty_min ) ? qty_min : (vl - qty_step) : ( (vl + qty_step) >= qty_max ) ? qty_max : (vl + qty_step);

            if ( $this.is('.minus') ){
                if ( vll < 0 ){
                    qty_input.val(qty_min).trigger('change');
                }
                qty_input.val(vll);
                $(loop_id + ' .plus' ).removeClass('disabled');
                $(loop_id).removeClass('has-max-quntity');

                if ( ! $this.parents( '.cart-with-quantity' ).length ) {
                    $(loop_id).removeClass('has-max-quntity quntity-open product-in-cart');
                    $(loop_id + ' .qty').val(vll).trigger('change');
                    $(loop_id + ' .added').removeClass('added');
                    $(loop_id + ' a.added_to_cart').remove();
                }

            } else {
                if ( qty_max && ( qty_max === vll || vll > qty_max ) ) {
                    qty_input.val(qty_max);
                    $this.addClass('disabled');
                    wrapper.addClass('has-max-quntity');
                } else {
                    qty_input.val(vll);
                }

                if ( ! $this.parents( '.cart-with-quantity' ).length ) {
                    $(loop_id).removeClass('has-max-quntity quntity-open product-in-cart');
                    $(loop_id + ' .qty').val(vll).trigger('change');
                    $(loop_id + ' .added').removeClass('added');
                    $(loop_id + ' a.added_to_cart').remove();
                }
            }

            if ( qty_input.val() === '0' ) {
                $(loop_id).removeClass('has-max-quntity quntity-open product-in-cart');
                $(loop_id + ' .added').removeClass('added');
                $(loop_id + ' a.added_to_cart').remove();
            }

            qty_input.trigger( 'change' );
        }
    });
    var click_count = 0;
    $(document).on('click', '.plus, .minus', function() {
        event.preventDefault();
        if ( $('body').hasClass('woocommerce-cart') ) {
            return;
        }
        if ( $(this).parents('form.cart').length ){
            return;
        }
        click_count += 1;
        var $this = $(this);
        var qty = $this.parent().find('.qty');
        var pid = $this.closest('.cart-with-quantity').attr('data-product_id');

        var data = {
            type: 'POST',
            timeout: 3000,
            cache: false,
            action: 'quantity_button',
            beforeSend: function () {
                $this.parent().addClass('svg-loading');
            },
            id: pid,
            quantity : qty.val(),
        };

        $.post(wc_add_to_cart_params.ajax_url, data, function(response) {

            if ( response ) {
                $this.parent().removeClass('svg-loading');

                $(response).prependTo('.venam-popup-notices');
                $('.venam-popup-notices').addClass('slide-in');
            }

            var count_items = $('.venam-popup-notices .ninetheme-cart-update-message:not(:last-child)').length;

            $($(".venam-popup-notices .ninetheme-cart-update-message:not(:last-child)").get().reverse()).each(function(i,e) {
                var delay = $(e).data('delay') + 200*i;
                $(e).attr('data-delay', delay );
                $(e).delay( parseFloat( delay ) ).fadeOut( "slow", function() {
                    $(e).remove();
                    $('body').trigger('venamShopNotices');
                });
            });

            $(document.body).trigger('wc_fragment_refresh').trigger('updated_cart_totals');
            $(document.body).trigger("update_checkout");
            $this.parent().removeClass('svg-loading');

        });
    });

});
