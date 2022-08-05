<?php

/*
** Product type 1
*/

defined( 'ABSPATH' ) || exit;
global $product;
$regular = $product->get_regular_price();
$sale = $product->get_sale_price();
$regularattr = !$product->is_on_sale() && !$sale ? 'new-price' : 'old-price';
remove_action( 'venam_loop_product_thumb', 'venam_product_badge', 5 );
add_action( 'venam_loop_product_details', 'venam_product_badge', 5 );
?>

<div class="woocommerce exclusive-item exclusive-item-three">
    <div class="row align-items-center">
        <div class="exclusive-item-labels">
            <?php do_action( 'venam_loop_product_details' ); ?>
        </div>
        <div class="col-sm-4">
            <div class="exclusive-item-thumb">
                <?php do_action( 'venam_loop_product_thumb' ); ?>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="exclusive-item-content pl-sm-4 bl-sm-solid">
                <h5><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
                <?php if ( $regular || $sale ) { ?>
                    <div class="exclusive--item--price">
                        <?php if ( $regular ) { ?>
                            <?php if ( !$product->is_on_sale() && !$sale ) { ?>
                                <span class="new-price"><?php echo wc_price( $regular ); ?></span>
                            <?php } else { ?>
                                <del class="old-price"><?php echo wc_price( $regular ); ?></del>
                            <?php } ?>
                        <?php } ?>
                        <?php if ( $product->is_on_sale() && $sale ) { ?>
                            <span class="new-price"><?php echo wc_price( $sale ); ?></span>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if ( wc_review_ratings_enabled() && $product->get_average_rating() ) { ?>
                    <div class="rating">
                        <?php woocommerce_template_loop_rating(); ?>
                    </div>
                <?php } ?>
                <?php the_excerpt(); ?>
                <?php woocommerce_template_single_meta(); ?>
                <?php do_action( 'venam_loop_product_buttons' ); ?>
                <?php do_action( 'venam_loop_after_product_content' ); ?>
            </div>
        </div>
    </div>
</div>
