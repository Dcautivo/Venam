<?php

/*
** Product type 3
*/

defined( 'ABSPATH' ) || exit;
global $product;

?>
<div class="woocommerce exclusive-item exclusive-item-three type-3 mb-50">
    <div class="exclusive-item-thumb">
        <div class="product-labels">
            <?php do_action( 'venam_loop_product_details' ); ?>
        </div>
        <?php do_action( 'venam_loop_product_thumb' ); ?>
        <?php do_action( 'venam_loop_product_buttons' ); ?>
    </div>
    <div class="exclusive-item-content">
        <?php if ( wc_review_ratings_enabled() && $product->get_average_rating() ) { ?>
            <div class="rating">
                <?php woocommerce_template_loop_rating(); ?>
            </div>
        <?php } ?>
        <h5><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
        <?php woocommerce_template_loop_price(); ?>
        <?php
        if ( shortcode_exists('wpcvs_archive') ) {
            echo do_shortcode( '[wpcvs_archive]' );
        }
        ?>
        <?php do_action( 'venam_loop_after_product_content' ); ?>
    </div>
</div>
