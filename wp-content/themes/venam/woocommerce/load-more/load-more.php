<?php

/*************************************************
## Load More Button
*************************************************/
function venam_load_more_button(){
    echo '<div class="row row-more venam-more mt-30">
    <div class="col-12 nt-pagination -align-center">
    <div class="button venam-load-more" data-title="'.esc_html__('Loading...','venam').'">'.esc_html__('Load More','venam').'</div>
    </div>
    </div>';
}


/*************************************************
## Infinite Pagination
*************************************************/
function venam_infinite_scroll(){
    echo '<div class="row row-infinite venam-more mt-30">
    <div class="col-12 nt-pagination -align-center">
    <div class="venam-load-more" data-title="'.esc_html__('Loading...','venam').'">'.esc_html__('Loading...','venam').'</div>
    </div>
    </div>';
}


/*************************************************
## Load More CallBack
*************************************************/
add_action( 'wp_ajax_nopriv_load_more', 'venam_load_more_callback' );
add_action( 'wp_ajax_load_more', 'venam_load_more_callback' );
function venam_load_more_callback() {

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $_POST['per_page'],
        'paged' => $_POST['current_page'] + 1
    );

    // Price Slider
    if ( $_POST['min_price'] != null || $_POST['max_price'] != null ) {
        $args['meta_query'][] = wc_get_min_max_price_meta_query( array(
          'min_price' => $_POST['min_price'],
          'max_price' => $_POST['max_price']
        ));
    }

    // On Sale Products
    if ( isset( $_POST['on_sale'] ) ) {
        $args['post__in'] = $_POST['on_sale'];
    }

    // Orderby
    if ( isset( $_POST['orderby'] ) ) {
        if ( $_POST['orderby'] == 'rating' ) {
            $args['meta_key'] = '_wc_average_rating'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
            $args['order']    = 'DESC';
            $args['orderby']  = 'meta_value_num';
            add_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
        }

        if ( $_POST['orderby'] == 'popularity' ) {
            $args['meta_key'] = 'total_sales';
            add_filter( 'posts_clauses', array( WC()->query, 'order_by_popularity_post_clauses' ) );
        }

        if ( $_POST['orderby'] == 'price' ) {
            add_filter( 'posts_clauses', array( WC()->query, 'order_by_price_asc_post_clauses' ) );
        }

        if ( $_POST['orderby'] == 'price-desc' ) {
            add_filter( 'posts_clauses', array( WC()->query, 'order_by_price_desc_post_clauses' ) );
        }
    }

    // Product Category Filter Widget on shop page
    if ( $_POST['filter_cat'] != null ) {
        if ( !empty( $_POST['filter_cat'] ) ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'id',
                'terms'    => explode( ',', $_POST['filter_cat'] )
            );
        }
    }

    // Product Category Page
    if ( $_POST['cat_id'] != null ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'id',
            'terms'    => $_POST['cat_id']
        );
    }

    // Product Filter By widget
    if ( isset( $_POST['layered_nav'] ) ) {
        $choosen_attributes = $_POST['layered_nav'];

        foreach ( $choosen_attributes as $taxonomy => $data ) {
            $args['tax_query'][] = array(
                'taxonomy'         => $taxonomy,
                'field'            => 'slug',
                'terms'            => $data['terms'],
                'operator'         => 'and' === $data['query_type'] ? 'AND' : 'IN',
                'include_children' => false
            );
        }
    }

    $type = 1;

    if ( isset( $_POST['product_type'] ) && $_POST['product_type'] ) {
        $type = $_POST['product_type'];
    }

    //Loop
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) {
            $loop->the_post();
            global $product;

            // Ensure visibility.
            if ( empty( $product ) || ! $product->is_visible() ) {
                return;
            }
            $sw_color = defined( 'WPCVS_VERSION' ) && $product->is_type('variable') ? ' woosv_color' : '';
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

            ?>
            <div <?php wc_product_class( 'col product-type--'.$type.$sw_color, $product ); ?>>
                <?php wc_get_template_part( 'product/type', $type );?>
            </div>
            <?php
            add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        }
    }
    wp_reset_postdata();

    wp_die();

}
