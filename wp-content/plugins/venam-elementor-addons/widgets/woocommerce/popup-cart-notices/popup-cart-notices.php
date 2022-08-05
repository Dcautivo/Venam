<?php

if ( ! class_exists( 'VenamWooCartNotice' ) && class_exists( 'WC_Product' ) ) {
    class VenamWooCartNotice {
        function __construct() {
            // frontend scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'venamcn_enqueue_scripts' ) );
            // add the time
            add_action( 'woocommerce_add_to_cart', array( $this, 'venamcn_add_to_cart' ), 10 );
            // fragments
            add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'venamcn_cart_fragment' ) );
            // footer
            //add_action( 'wp_footer', array( $this, 'venamcn_footer' ) );
        }
        function venamcn_enqueue_scripts() {

            wp_enqueue_script( 'venamcn-frontend', VENAM_PLUGIN_URL . 'widgets/woocommerce/popup-cart-notices/script.js', array( 'jquery' ), VENAM_PLUGIN_VERSION, true );
        }

        function venamcn_get_product() {
            $items = WC()->cart->get_cart();
            $html  = '<div class="venam-popup-notices-footer">';

            if ( count( $items ) > 0 ) {
                foreach ( $items as $key => $item ) {
                    if ( ! isset( $item['venam_popup_notices_time'] ) ) {
                        $items[ $key ]['venam_popup_notices_time'] = time() - 1000;
                    }
                }

                array_multisort( array_column( $items, 'venam_popup_notices_time' ), SORT_ASC, $items );
                $venam_product = end( $items )['data'];

                if ( $venam_product && ( $venam_product_id = $venam_product->get_id() ) ) {
                    if ( ! in_array( $venam_product_id, apply_filters( 'venam_exclude_ids', array( 0 ) ), true ) ) {
                        $cart_content_data = '<span class="venam-popup-cart-content-total">' . wp_kses_post( WC()->cart->get_cart_subtotal() ) . '</span> <span class="venam-cart-content-count">' . wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'venam' ), WC()->cart->get_cart_contents_count() ) ) . '</span>';
                        $cart_content = sprintf( esc_html__( 'Your cart: %s', 'venam' ), $cart_content_data );
                        $html .= '<div class="venam-cart-content">' . $cart_content . '</div>';
                    }
                }
            }

            $html .= '</div>';

            return $html;
        }

        function venamcn_add_to_cart( $cart_item_key ) {

            WC()->cart->cart_contents[ $cart_item_key ]['venam_popup_notices_time'] = time();

        }

        function venamcn_cart_fragment( $fragments ) {
            $fragments['.venam-popup-notices-footer'] = $this->venamcn_get_product();

            return $fragments;
        }

        function venamcn_footer() {
            echo '<div class="venam-popup-notices"></div>';
        }
    }
    new VenamWooCartNotice();
}
