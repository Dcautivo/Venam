<?php
/**
* Venam Admin Page Template
*/


?>

    <div class="venam-admin-wrapper">
        <div class="container">
            <div class="page-heading">
                <h1 class="page-title"><?php _e( 'Venam Addons', 'venam' ); ?></h1>
                <p class="page-description">
                    <?php _e( 'Premium & Advanced Essential Elements for Elementor', 'venam' ); ?>
                </p>
            </div>
            <form class="venam-form" method="post">

                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-widget-tab" data-toggle="tab" href="#nav-widget" role="tab" aria-controls="nav-widget" aria-selected="false"><?php _e( 'Widgets', 'venam' ); ?></a>
                        <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true"><?php _e( 'Extra', 'venam' ); ?></a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-widget" role="tabpanel" aria-labelledby="nav-widget-tab">
                        <div class="row widget-row">
                            <?php

                            $list = array(
                                'header-menu',
                                'button',
                                'menu-vertical',
                                'header-top-menu',
                                'posts-base',
                                'blog-posts',
                                'section-heading',
                                'breadcrumbs',
                                'home-slider',
                                'fetatures-item',
                                'special-offer-box',
                                'special-offer-banner',
                                'limited-offer-banner',
                                'special-offer-single',
                                'contact-form-7',
                                'testimonials-slider',
                                'icon-box',
                                'sidebar-widgets',
                                
                                // blog post widgets
                                'blog-grid',
                                'blog-masonry',
                                'blog-slider',
                                
                                // wocommerce widgets
                                'woo-super-deals',
                                'woo-category-grid',
                                'woo-list',
                                'woo-slider',
                                'woo-gallery',
                                'woo-mini-cart',
                                'woo-header-actions',
                                'woo-ajax-search'
                            );

                            foreach ( $list as $widget ) {

                                $option = 'disable_'.str_replace( '-', '_', $widget );
                                $name = mb_strtoupper( str_replace( '-', ' ', $widget ) );

                                add_option( $option, 0 );
                                if ( isset( $_POST[ $option ] ) ) {
                                    update_option( $option, $_POST[ $option ] );
                                }

                                 ?>

                                <div class="col-md-4">
                                    <div class="widget-toggle">
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="<?php echo esc_attr( $option ); ?>" value="1">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo esc_attr( $option ); ?>" name="<?php echo esc_attr( $option ); ?>" value="0" <?php checked( 0, get_option( $option ), true ); ?>>
                                            <label class="custom-control-label" for="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $name ); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                        <div class="row widget-row">
                            <div class="col-md-4">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'disable_venam_list_shortcodes', 0 );
                                    if ( isset( $_POST['disable_venam_list_shortcodes'] ) ) {
                                        update_option( 'disable_venam_list_shortcodes', $_POST['disable_venam_list_shortcodes'] );
                                    }
                                    ?>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="disable_venam_list_shortcodes" value="1">
                                        <input type="checkbox" class="custom-control-input" id="disable_venam_list_shortcodes" name="disable_venam_list_shortcodes" value="0" <?php checked( 0, get_option( 'disable_venam_list_shortcodes' ), true ); ?>>
                                        <label class="custom-control-label" for="disable_venam_list_shortcodes"><?php _e( 'Shortcode Creator', 'venam' ); ?></label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'disable_venam_wc_brands', 0 );
                                    if ( isset( $_POST['disable_venam_wc_brands'] ) ) {
                                        update_option( 'disable_venam_wc_brands', $_POST['disable_venam_wc_brands'] );
                                    }
                                    ?>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="disable_venam_wc_brands" value="1">
                                        <input type="checkbox" class="custom-control-input" id="disable_venam_wc_brands" name="disable_venam_wc_brands" value="0" <?php checked( 0, get_option( 'disable_venam_wc_brands' ), true ); ?>>
                                        <label class="custom-control-label" for="disable_venam_wc_brands"><?php _e( 'Venam Brands', 'venam' ); ?></label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'disable_venam_wc_ajax_search', 0 );
                                    if ( isset( $_POST['disable_venam_wc_ajax_search'] ) ) {
                                        update_option( 'disable_venam_wc_ajax_search', $_POST['disable_venam_wc_ajax_search'] );
                                    }
                                    ?>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="disable_venam_wc_ajax_search" value="1">
                                        <input type="checkbox" class="custom-control-input" id="disable_venam_wc_ajax_search" name="disable_venam_wc_ajax_search" value="0" <?php checked( 0, get_option( 'disable_venam_wc_ajax_search' ), true ); ?>>
                                        <label class="custom-control-label" for="disable_venam_wc_ajax_search"><?php _e( 'Venam WC Ajax Search', 'venam' ); ?></label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'disable_venam_wc_popup_cart_notices', 0 );
                                    if ( isset( $_POST['disable_venam_wc_popup_cart_notices'] ) ) {
                                        update_option( 'disable_venam_wc_popup_cart_notices', $_POST['disable_venam_wc_popup_cart_notices'] );
                                    }
                                    ?>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="disable_venam_wc_popup_cart_notices" value="1">
                                        <input type="checkbox" class="custom-control-input" id="disable_venam_wc_popup_cart_notices" name="disable_venam_wc_popup_cart_notices" value="0" <?php checked( 0, get_option( 'disable_venam_wc_popup_cart_notices' ), true ); ?>>
                                        <label class="custom-control-label" for="disable_venam_wc_popup_cart_notices"><?php _e( 'Venam WC Popup Cart Notices', 'venam' ); ?></label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>

                <div class="page-actions">
                    <div class="row">
                        <div class="col-sm-12 submit-container">
                            <?php wp_nonce_field( 'venam_admin_nonce_field' ); ?>
                            <button type="submit" class="btn btn-primary"><?php _e( 'Save Settings', 'venam' ); ?></button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
