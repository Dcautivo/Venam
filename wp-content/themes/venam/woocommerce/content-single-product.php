<?php
/**
* The template for displaying product content in the single-product.php template
*
* This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see     https://docs.woocommerce.com/document/template-structure/
* @package WooCommerce\Templates
* @version 3.6.0
*/

defined( 'ABSPATH' ) || exit;

global $product;

/**
* Hook: woocommerce_before_single_product.
*
* @hooked woocommerce_output_all_notices - 10
*/
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
$sw_color = '';
if ( defined( 'WPCVS_VERSION' ) && $product->is_type('variable') ) {
    $sw_color = ' woosv_color';
}
if ( '0' == venam_settings('single_shop_rating_visibility', '1' ) ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
}
if ( '0' == venam_settings('single_shop_excerpt_visibility', '1' ) ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
}
if ( '0' == venam_settings('single_shop_meta_visibility', '1' ) ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}
if ( '0' == venam_settings('single_shop_tabs_visibility', '1' ) ) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
}
if ( '0' == venam_settings('single_shop_upsells_visibility', '1' ) ) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
}
if ( '0' == venam_settings('single_shop_ralated_visibility', '1' ) ) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $sw_color, $product ); ?>>
    <div class="row row-cols-1 row-cols-lg-2 pb-100">
        <div class="col thumb--content">
            <?php
            /**
            * Hook: woocommerce_before_single_product_summary.
            *
            * @hooked woocommerce_show_product_sale_flash - 10
            * @hooked woocommerce_show_product_images - 20
            */
            do_action( 'woocommerce_before_single_product_summary' );
            ?>
        </div>

        <div class="col summary entry-summary">
            <div class="shop-details-content">
                <?php
                /**
                * Hook: venam_before_single_product_summary.
                *
                * @hooked venam_product_top_details - 5
                */
                do_action( 'venam_before_single_product_summary' );
                ?>
                <?php
                /**
                * Hook: woocommerce_single_product_summary.
                *
                * @hooked woocommerce_template_single_title - 5
                * @hooked woocommerce_template_single_rating - 10
                * @hooked woocommerce_template_single_price - 10
                * @hooked woocommerce_template_single_excerpt - 20
                * @hooked woocommerce_template_single_add_to_cart - 30
                * @hooked woocommerce_template_single_meta - 40
                * @hooked woocommerce_template_single_sharing - 50
                * @hooked WC_Structured_Data::generate_product_data() - 60
                */
                do_action( 'woocommerce_single_product_summary' );
                ?>
            </div>
        </div>
    </div>

    <div class="row row-cols-1">
        <div class="col">
        <?php
        /**
        * Hook: woocommerce_after_single_product_summary.
        *
        * @hooked woocommerce_output_product_data_tabs - 10
        * @hooked woocommerce_upsell_display - 15
        * @hooked woocommerce_output_related_products - 20
        */
        do_action( 'woocommerce_after_single_product_summary' );
        ?>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
