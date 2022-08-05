<?php

if ( ! function_exists( 'venam_wc_quick_view' ) ) {
    //add_action('woocommerce_after_shop_loop_item', 'venam_wc_quick_view');
    function venam_wc_quick_view()
    {
        global $product;
        wp_enqueue_script( 'wc-add-to-cart-variation' );
        if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {
            if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
                wp_enqueue_script( 'zoom' );
            }
            if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
                wp_enqueue_script( 'photoswipe-ui-default' );
                wp_enqueue_style( 'photoswipe-default-skin' );
                if ( has_action( 'wp_footer', 'woocommerce_photoswipe' ) === false ) {
                    add_action( 'wp_footer', 'woocommerce_photoswipe', 15 );
                }
            }
            wp_enqueue_script( 'wc-single-product' );
        }

        printf( '<a href="%1$s" class="button venam-btn-quick-view">%2$s</a>',
        $product->get_id(),
        apply_filters('venam_quick_view_title', esc_html__('Quick View', 'venam') )
        );
    }
}

/*************************************************
## Quick View Scripts
*************************************************/

function venam_quick_view_scripts() {
    wp_enqueue_style( 'magnific');
    wp_enqueue_script( 'magnific');
    wp_enqueue_script( 'flexslider');
    wp_enqueue_script( 'venam-quick-ajax', get_template_directory_uri() . '/woocommerce/quick-view/quick_ajax.js', array('jquery'), '1.0.0', true );
    wp_localize_script( 'venam-quick-ajax', 'MyAjax', array(
        'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
        'security' => wp_create_nonce( 'venam-special-string' ),
    ));
}
//add_action( 'wp_enqueue_scripts', 'venam_quick_view_scripts' );

/*************************************************
## Quick View CallBack
*************************************************/

//add_action( 'wp_ajax_nopriv_quick_view', 'venam_quick_view_callback' );
//add_action( 'wp_ajax_quick_view', 'venam_quick_view_callback' );

function venam_quick_view_callback() {

    check_ajax_referer( 'venam-special-string', 'security' );

    global $wpdb,$post; // this is how you get access to the database
    $id = intval( $_POST['id'] );
    $loop = new WP_Query(
        array(
            'post_type' => 'product',
            'p' => $id,
        )
    );

    while ( $loop->have_posts() ) {
         $loop->the_post();
         $product = new WC_Product( get_the_ID() );
    ?>
    <div class="single woocommerce">
        <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'ajax_quick_view', $product ); ?>>
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                        <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="entry-summary">
                            <?php do_action( 'woocommerce_single_product_summary' ); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
}
wp_reset_postdata();

wp_die();

}
