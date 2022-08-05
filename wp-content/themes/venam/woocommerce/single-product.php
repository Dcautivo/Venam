<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

get_header();

do_action( "venam_before_wc_single" );

// Elementor `single` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

    if ( venam_check_is_elementor() ) {

        while ( have_posts() ) {

            the_post();
            $product = wc_get_product();
            ?>
            <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
                <?php the_content(); ?>
            </div>
            <?php
        }

    } else {
        $product_layout = venam_settings( 'single_shop_layout', 'full-width' );
        $column = 'full-width' != $product_layout && is_active_sidebar( 'shop-single-sidebar' ) ? 'col-lg-8 shop-has-sidebar' : 'col-lg-12';
        ?>
        <!-- WooCommerce product page container -->
        <div id="nt-woo-single" class="nt-woo-single ">

            <!-- Hero section - this function using on all inner pages -->
            <?php venam_wc_hero_section(); ?>

            <div class="nt-theme-inner-container shop-details-area pt-100 pb-100">
                <div class="container">
                    <div class="row">

                        <!-- Left sidebar -->
                        <?php
                        if ( 'left-sidebar' == $product_layout && is_active_sidebar( 'shop-single-sidebar' ) ) {
                            echo '<div id="nt-sidebar" class="col-lg-4">';
                                echo '<div class="blog-sidebar nt-sidebar-inner">';
                                    dynamic_sidebar( 'shop-single-sidebar' );
                                echo '</div>';
                            echo '</div>';
                        }
                        ?>

                        <div class="<?php echo esc_attr( $column ); ?>">
                            <div class="content-container">

                                <?php while ( have_posts() ) : ?>
                                    <?php the_post(); ?>

                                    <?php wc_get_template_part( 'content', 'single-product' ); ?>

                                <?php endwhile; // end of the loop. ?>

                            </div>
                        </div>
                        <!-- End sidebar + content -->

                        <!-- Right sidebar -->
                        <?php
                        if ( 'right-sidebar' == $product_layout && is_active_sidebar( 'shop-single-sidebar' ) ) {
                            echo '<div id="nt-sidebar" class="col-lg-4">';
                                echo '<div class="blog-sidebar nt-sidebar-inner">';
                                    dynamic_sidebar( 'shop-single-sidebar' );
                                echo '</div>';
                            echo '</div>';
                        }
                        ?>

                    </div><!-- End row -->
                </div><!-- End #container -->
            </div><!-- End #blog -->
        </div><!-- End woo shop page general div -->
        <?php
    }
}
do_action( "venam_after_wc_single" );

get_footer();

?>
