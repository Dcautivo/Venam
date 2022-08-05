<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

if ( ! venam_is_pjax() ) {
    get_header();
}

do_action("venam_before_wc_shop_page");
$shop_display_mode = woocommerce_get_loop_display_mode();
$shop_layout = venam_settings( 'shop_layout', 'full-width' );
$container_width = 'wide' == venam_get_option() ? 'container-fluid' : venam_settings( 'shop_container_width', 'custom-container-two' );
$column = 'full-width' != $shop_layout && is_active_sidebar( 'shop-page-sidebar' ) ? 'col-xl-9 col-lg-8 shop-has-sidebar' : 'col-lg-12';
$pagination = 'default-pagination';
$found_product = woocommerce_product_loop() ? ' found-product' : '';

if ( venam_settings('shop_paginate_type') == 'loadmore' || venam_ft() == 'load-more' ) {
    add_action( 'woocommerce_after_shop_loop', 'venam_load_more_button', 15 );
    $pagination = 'pagination-load-more';
}

if ( venam_settings('shop_paginate_type') == 'infinite' || venam_ft() == 'infinite' ) {
    add_action( 'woocommerce_after_shop_loop', 'venam_infinite_scroll', 20 );
    $pagination = 'pagination-infinite';
}

?>
<!-- Woo shop page general div -->
<div id="nt-shop-page" class="nt-shop-page">

    <!-- Hero section - this function using on all inner pages -->
    <?php venam_wc_hero_section(); ?>

    <?php do_action("venam_after_shop_hero"); ?>

    <div class="nt-theme-inner-container shop-area pt-100 pb-100">
        <div class="<?php echo esc_attr( $container_width ); ?>">

            <div class="row justify-content-center">

                <!-- Left sidebar -->
                <?php if (  'full-width' == $shop_layout && 'fixed' == venam_settings('shop_sidebar_position', '' ) && is_active_sidebar( 'shop-page-sidebar' ) ) { ?>
                    <div id="nt-sidebar" class="col-xl-3 col-lg-4 col-md-6 col-sm-8 full-fixed-sidebar">

                        <?php if ( 'fixed' != venam_settings('shop_sidebar_position', '' ) && 'fixed-sidebar' != venam_get_option() ) { ?>
                            <span class="close-sidebar mobile-sidebar-close"><?php echo venam_svg_lists( 'cancel' );?></span>
                        <?php } ?>

                        <?php if ( 'fixed' == venam_settings('shop_sidebar_position', '' ) || 'fixed-sidebar' == venam_get_option() ) { ?>
                            <span class="close-sidebar"><?php echo venam_svg_lists( 'cancel' );?></span>
                        <?php } ?>

                        <div class="blog-sidebar nt-sidebar-inner">
                            <?php dynamic_sidebar( 'shop-page-sidebar' ); ?>
                        </div>
                    </div>
                <?php } ?>

                <!-- Left sidebar -->
                <?php if ( ( 'left-sidebar' == $shop_layout || 'left-sidebar' == venam_get_option() ) && 'full-width' != $shop_layout && 'right-sidebar' != venam_get_option() && is_active_sidebar( 'shop-page-sidebar' ) ) { ?>
                    <div id="nt-sidebar" class="col-xl-3 col-lg-4 col-md-6 col-sm-8 order-2 order-lg-0 left-sidebar">

                        <?php if ( 'fixed' != venam_settings('shop_sidebar_position', '' ) && 'fixed-sidebar' != venam_get_option() ) { ?>
                            <span class="close-sidebar mobile-sidebar-close"><?php echo venam_svg_lists( 'cancel' );?></span>
                        <?php } ?>

                        <?php if ( 'fixed' == venam_settings('shop_sidebar_position', '' ) || 'fixed-sidebar' == venam_get_option() ) { ?>
                            <span class="close-sidebar"><?php echo venam_svg_lists( 'cancel' );?></span>
                        <?php } ?>
                        <div class="blog-sidebar nt-sidebar-inner<?php echo esc_attr( $found_product ); ?>">
                            <?php if ( woocommerce_product_loop() ) { ?>
                                <div class="venam-choosen-filters">
                                    <?php do_action( 'venam_choosen_filters' ); ?>
                                    <?php woocommerce_result_count(); ?>
                                    <?php if ( venam_is_pjax() ) { ?>
                                        <span class="close-sidebar btn-done"><?php esc_html_e( 'Done', 'venam' );?></span>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <div class="venam-choosen-filters">
                                    <?php do_action( 'venam_choosen_filters' ); ?>
                                    <?php wc_no_products_found(); ?>
                                </div>
                            <?php } ?>
                            <?php dynamic_sidebar( 'shop-page-sidebar' ); ?>
                        </div>
                    </div>
                <?php } ?>

                <?php do_action( 'venam_before_shop_loop' ); ?>

                <!-- Content column -->
                <div class="<?php echo esc_attr( $column ); ?>">

                     <?php
                    /**
                    * Hook: venam_after_loop_start.
                    *
                    * @hooked venam_print_category_banner - 10
                    */
                    do_action( 'venam_before_loop_start' );
                    ?>

                    <?php if ( 'subcategories' == $shop_display_mode || 'both' == $shop_display_mode ) : ?>
                        <div class="wc--row shop-categories <?php echo esc_attr( $shop_display_mode ); ?>">
                            <div class="col-12">
                                <div class="cats-all-top">
                                    <div class="cats-all-title">
                                        <h4 class="title"><?php esc_html_e( 'All Categories', 'venam' ); ?></h4>
                                    </div>
                                    <div class="cats-slider-nav">
                                        <div class="slide-prev-cats"><i class="fas fa-angle-left"></i></div>
                                        <div class="slide-next-cats"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                                <div class="shop-slider-categories">
                                    <div class="slick-slider row">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="wc--row row">
                        <div class="col-12 notices--wrapper">
                            <?php woocommerce_output_all_notices(); ?>
                        </div>
                    </div>


                        <div class="wc--row row before-shop--loop align-items-center venam-ajax-scroll-target">

                            <div class="col-12 col-lg-4 result--count text-left">
                                <div class="venam-woo-breadcrumb">
                                    <?php echo venam_breadcrumbs(); ?>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8 catalog--ordering">
                                <div class="shop-meta-right">

                                    <?php if ( 'fixed' != venam_settings('shop_sidebar_position', '' ) && 'fixed-sidebar' != venam_get_option() ) { ?>
                                        <div class="shop-sidebar-toggle venam-mobile-sidebar-toggle">
                                            <span class="open-sidebar"><span><?php echo esc_html_e( 'Filter', 'venam' );?></span> <?php echo venam_svg_lists( 'filter' );?></span>
                                        </div>
                                    <?php } ?>

                                    <?php if ( 'fixed' == venam_settings('shop_sidebar_position', '' ) || 'fixed-sidebar' == venam_get_option() ) { ?>
                                        <div class="shop-sidebar-toggle">
                                            <span class="open-sidebar"><span><?php echo esc_html_e( 'Filter', 'venam' );?></span> <?php echo venam_svg_lists( 'filter' );?></span>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    if ( woocommerce_product_loop() ) {
                                        venam_wc_per_page_select();
                                        venam_wc_column_select();
                                        woocommerce_catalog_ordering();
                                    }
                                    ?>

                                </div>
                            </div>

                        </div>

                        <div class="wc--row row venam-pjax-filters align-items-center">
                            <div class="col-12 col-lg-12 result--count text-left">
                                <div class="venam-choosen-filters">
                                    <?php do_action( 'venam_choosen_filters' ); ?>
                                </div>
                            </div>
                        </div>



                    <div class="products-wrapper <?php echo esc_attr( $pagination ); ?>" data-pagination="<?php echo esc_attr( $pagination ); ?>" data-shop-filters='<?php echo venam_wc_filters_for_ajax(); ?>'>

                        <?php

                        do_action( 'woocommerce_before_shop_loop' );

                        woocommerce_product_loop_start();

                        if ( woocommerce_product_loop() ) {

                            if ( wc_get_loop_prop( 'total' ) ) {
                                while ( have_posts() ) {
                                    the_post();

                                    /**
                                    * Hook: woocommerce_shop_loop.
                                    */
                                    do_action( 'woocommerce_shop_loop' );

                                    wc_get_template_part( 'content', 'product' );
                                }
                            }

                        } else {
                            /**
                            * Hook: woocommerce_no_products_found.
                            *
                            * @hooked wc_no_products_found - 10
                            */
                            echo '<div class="col-12 notices--wrapper">';
                                do_action( 'woocommerce_no_products_found' );
                            echo '</div>';

                        }
                        woocommerce_product_loop_end();

                        if ( woocommerce_product_loop() ) {
                            /**
                            * Hook: woocommerce_after_shop_loop.
                            *
                            * @hooked woocommerce_pagination
                            */
                            do_action( 'woocommerce_after_shop_loop' );
                        }
                        ?>
                    </div>

                    <?php
                        /**
                        * Hook: venam_after_shop_loop.
                        *
                        * @hooked venam_after_shop_loop
                        */
                        do_action( 'venam_after_shop_loop' );
                    ?>

                </div>
                <!-- End sidebar + content -->

                <!-- Right sidebar -->
                <?php if ( ( 'right-sidebar' == $shop_layout || 'right-sidebar' == venam_get_option() ) && 'full-width' != $shop_layout && is_active_sidebar( 'shop-page-sidebar' ) ) { ?>
                    <div id="nt-sidebar" class="col-lg-3 right-sidebar">
                        <?php if ( 'fixed' != venam_settings('shop_sidebar_position', '' ) && 'fixed-sidebar' != venam_get_option() ) { ?>
                            <span class="close-sidebar mobile-sidebar-close"><?php echo venam_svg_lists( 'cancel' );?></span>
                        <?php } ?>
                        <?php if ( 'fixed' == venam_settings('shop_sidebar_position', '' ) || 'fixed-sidebar' == venam_get_option() ) { ?>
                            <span class="close-sidebar"><?php echo venam_svg_lists( 'cancel' );?></span>
                        <?php } ?>
                        <div class="blog-sidebar nt-sidebar-inner">
                            <?php dynamic_sidebar( 'shop-page-sidebar' ); ?>
                        </div>
                    </div>
                <?php } ?>

            </div><!-- End row -->
        </div><!-- End container -->
    </div><!-- End #blog -->
</div><!-- End woo shop page general div -->
<?php

do_action("venam_after_wc_shop_page");

if ( ! venam_is_pjax() ) {
    get_footer();
}

?>
