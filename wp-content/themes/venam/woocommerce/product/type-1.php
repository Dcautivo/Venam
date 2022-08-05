<?php

/*
** Product type 1
*/

defined( 'ABSPATH' ) || exit;
global $product;
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
?>
<div class="woocommerce exclusive-item exclusive-item-three text-center mb-50">
    <div class="exclusive-item-thumb">
        <?php do_action( 'venam_loop_product_details' ); ?>
        <?php do_action( 'venam_loop_product_thumb' ); ?>
        <?php do_action( 'venam_loop_product_buttons' ); ?>
    </div>
    <div class="exclusive-item-content">
        <h5><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
        <?php woocommerce_template_loop_price(); ?>
        <?php if ( wc_review_ratings_enabled() && $product->get_average_rating() ) { ?>
            <div class="rating">
                <?php woocommerce_template_loop_rating(); ?>
            </div>
        <?php } ?>
        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        <?php do_action( 'venam_loop_after_product_content' ); ?>
    </div>
</div>
