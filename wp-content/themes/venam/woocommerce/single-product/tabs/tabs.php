<?php
/**
* Single Product tabs
*
* This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see     https://docs.woocommerce.com/document/template-structure/
* @package WooCommerce\Templates
* @version 3.8.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Filter tabs and allow third parties to add their own.
*
* Each tab is an array containing title, callback and priority.
*
* @see woocommerce_default_product_tabs()
*/

$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
wp_enqueue_script( 'bootstrap' );
if ( ! empty( $product_tabs ) ) :
    $count = $count2 = 0;
?>

<div class="product-desc-wrap pb-100">
    <ul class="nav nav-tabs mb-50" role="tablist">
        <?php foreach ( $product_tabs as $key => $product_tab ) :
            $active = $count == 0 ? 'true' : 'false';
            $activec = $count == 0 ? ' active' : '';
            $count++;
            ?>
            <?php if ( !empty( $product_tab['title'] ) ) : ?>
                <li class="nav-item <?php echo esc_attr( $key ); ?>_tab">
                    <a class="nav-link<?php echo esc_attr( $activec ); ?>" id="tab-title-<?php echo esc_attr( $key ); ?>" data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>" aria-selected="<?php echo esc_attr( $active ); ?>"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php do_action( 'venam_product_extra_tabs_title' ); ?>
    </ul>
    <div class="tab-content" id="myTabContent">
        <?php foreach ( $product_tabs as $key => $product_tab ) :
            $active = $count2 == 0 ? ' show active' : '';
            $count2++;
            ?>
            <div class="tab-pane fade<?php echo esc_attr( $active ); ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                <div class="product-desc-content">
                    <?php
                    if ( isset( $product_tab['callback'] ) ) {
                        call_user_func( $product_tab['callback'], $key, $product_tab );
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>

        <?php do_action( 'venam_product_extra_tabs_content' ); ?>
        <?php do_action( 'woocommerce_product_after_tabs' ); ?>
    </div>
</div>

<?php endif; ?>
