<?php

if ( ! function_exists( 'venam_header_add_to_cart_fragment' ) ) {
    add_filter( 'woocommerce_add_to_cart_fragments', 'venam_header_add_to_cart_fragment' );
    function venam_header_add_to_cart_fragment( $fragments )
    {
        global $woocommerce;
        ob_start();
        echo'<span class="venam-cart-count cart-count">';
        //if ( $woocommerce->cart->cart_contents_count != 0  ) {
            echo esc_html( $woocommerce->cart->cart_contents_count );
        //}
        echo'</span>';

        $fragments['span.venam-cart-count'] = ob_get_clean();
        return $fragments;
    }
}

if ( ! function_exists( 'venam_header_cart_totals_fragment' ) ) {
    add_filter('woocommerce_add_to_cart_fragments', 'venam_header_cart_totals_fragment');
    function venam_header_cart_totals_fragment( $fragments )
    {
        global $woocommerce;
        ob_start();
        echo'<span class="venam-cart-total-price cart-total-price">';
        if ( $woocommerce->cart->cart_contents_count != 0  ) {
            echo wc_price( WC()->cart->cart_contents_total );
        }
        echo'</span>';

        $fragments['span.venam-cart-total-price'] = ob_get_clean();
        return $fragments;
    }
}

if ( ! function_exists( 'venam_header_add_to_cart_content' ) ) {
    add_filter( 'woocommerce_add_to_cart_fragments', 'venam_header_add_to_cart_content' );
    function venam_header_add_to_cart_content( $fragments )
    {
        ob_start();
        get_template_part('woocommerce/minicart/header', 'minicart');
        $fragments['div.venam-header-cart-details'] = ob_get_clean();
        return $fragments;
    }
}
