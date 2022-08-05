<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
if ( '1' == venam_get_shop_column() ) {
    $type = 2;
} elseif ( intval(venam_get_shop_column()) > 1 && '2' == venam_settings( 'shop_product_type', '1' ) ) {
    $type = 3;
} else {
    $type = apply_filters( 'venam_product_type', venam_settings( 'shop_product_type', '1' ) );
}

$sw_color = defined( 'WPCVS_VERSION' ) && $product->is_type('variable') ? ' woosv_color' : '';

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

?>

<div <?php wc_product_class( 'col product-type--'.$type.$sw_color, $product ); ?>>

    <?php wc_get_template_part( 'product/type', $type );?>

</div>
<?php
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
