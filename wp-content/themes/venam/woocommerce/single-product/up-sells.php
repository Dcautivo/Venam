<?php
/**
* Single Product Up-Sells
*
* This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see         https://docs.woocommerce.com/document/template-structure/
* @package     WooCommerce\Templates
* @version     3.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$heading = venam_settings( 'single_shop_upsells_title', '' );
$heading = $heading ? esc_html( $heading ) : apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like', 'venam' ) );

if ( $upsells ) : ?>

    <div class="up-sells upsells products pb-50">
        <?php if ( $heading ) : ?>
            <div class="deal-day-top">
                <div class="deal-day-title">
                    <h4 class="title"><?php echo esc_html( $heading ); ?></h4>
                </div>
            </div>
        <?php endif; ?>

        <?php
        woocommerce_product_loop_start();

        foreach ( $upsells as $upsell ) :

            $post_object = get_post( $upsell->get_id() );

            setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

            wc_get_template_part( 'content', 'product' );

        endforeach;

        woocommerce_product_loop_end();
        ?>

    </div>

    <?php
endif;

wp_reset_postdata();
