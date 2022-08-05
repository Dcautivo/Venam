<?php

/**
 * Custom template parts for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package venam
*/


/*************************************************
##  LOGO
*************************************************/

if ( ! function_exists( 'venam_logo' ) ) {
    function venam_logo( $mobile )
    {

        $logo = venam_settings( 'logo_type', 'sitename' );
        $stickylogo = '' != venam_settings( 'sticky_logo' ) ? venam_settings( 'sticky_logo' )[ 'url' ] : '';
        $mobilelogo = '' != venam_settings( 'mobile_logo' ) ? venam_settings( 'mobile_logo' )[ 'url' ] : '';
        $hasstickylogo = '' != $stickylogo ? ' has-sticky-logo': '';
        $type = true == $mobile ? 'nav-logo logo-type-'.$logo : 'logo logo-type-'.$logo;

        if ( '0' != venam_settings( 'logo_visibility', '1' ) ) {
            ?>
            <div class="<?php echo esc_attr( $type ); ?>">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"  aria-label="logo image" class="nt-logo header-logo logo-type-<?php echo esc_attr( $logo.$hasstickylogo ); ?>">

                    <?php if ( 'img' == $logo && '' != venam_settings( 'img_logo' ) ) { ?>

                        <?php if ( true == $mobile && $mobilelogo ) { ?>

                            <img class="mobile-menu-logo" src="<?php echo esc_url( $mobilelogo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />

                        <?php } else { ?>

                            <?php if ( '' != venam_settings( 'img_logo' ) ) { ?>

                                <img class="main-logo" src="<?php echo esc_url( venam_settings( 'img_logo' )[ 'url' ] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />

                                <?php if ( '' != $stickylogo ) { ?>
                                    <img class="main-logo sticky-logo" src="<?php echo esc_url( $stickylogo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>

                    <?php } elseif ( 'sitename' == $logo ) { ?>

                        <span class="header-text-logo"><?php bloginfo( 'name' ); ?></span>

                    <?php } elseif ( 'customtext' == $logo ) { ?>

                        <span class="header-text-logo"><?php echo venam_settings( 'text_logo' ); ?></span>

                    <?php } else { ?>

                        <span class="header-text-logo"> <?php bloginfo( 'name' ); ?> </span>

                    <?php } ?>
                </a>
            </div>
            <?php
        }
    }
}


/*************************************************
##  HEADER NAVIGATION
*************************************************/

if ( ! function_exists( 'venam_main_header' ) ) {
    add_action( 'venam_header_action', 'venam_main_header', 10 );
    function venam_main_header()
    {
        $pageheader_id = false;

        if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {

            $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
            $pageheader_id = $page_settings->get_settings( 'venam_page_header_template' );
            $pageheader_id = isset( $pageheader_id ) !== '' ? $page_settings->get_settings( 'venam_page_header_template' ) : $pageheader_id;
        }

        if ( '0' != venam_settings( 'header_visibility', '1' ) ) {

            if ( 'elementor' == venam_settings( 'header_template', 'default' ) ) {

                if ( $pageheader_id ) {

                    $frontend = new \Elementor\Frontend;
                    printf( '<div class="venam-elementor-header header-'.$pageheader_id.'">%1$s</div>', $frontend->get_builder_content_for_display( $pageheader_id, false ) );

                } else {

                    echo venam_print_elementor_templates( 'header_elementor_templates', 'venam-elementor-header' );

                }

            } else {
                $headerwidth = venam_settings( 'header_width', 'container' );
                ?>
                <!-- header-area -->
                <header class="header-style-two thm-default__header thm--header">

                    <?php do_action( 'venam_before_header' ); ?>

                    <!-- menu-area -->
                    <div<?php if ( '0' != venam_settings( 'header_sticky_visibility', '1' ) ) { ?> id="sticky-header"<?php } ?> class="main-header menu-area">
                        <div class="<?php echo esc_attr( venam_settings( 'header_width', 'container' ) ); ?>">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                                    <div class="menu-wrap">
                                        <nav class="menu-nav show">

                                            <!-- Header Logo -->
                                            <?php venam_logo( false ); ?>
                                            <!-- End Header Logo -->

                                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                                <ul class="navigation">
                                                    <?php
                                                    echo wp_nav_menu(
                                                        array(
                                                            'menu' => '',
                                                            'theme_location' => 'header_menu',
                                                            'container' => '',
                                                            'container_class' => '',
                                                            'container_id' => '',
                                                            'menu_class' => '',
                                                            'menu_id' => '',
                                                            'items_wrap' => '%3$s',
                                                            'before' => '',
                                                            'after' => '',
                                                            'link_before' => '',
                                                            'link_after' => '',
                                                            'depth' => 3,
                                                            'echo' => true,
                                                            'fallback_cb' => 'Venam_Wp_Bootstrap_Navwalker::fallback',
                                                            'walker' => new Venam_Wp_Bootstrap_Navwalker()
                                                        )
                                                    );
                                                    ?>
                                                </ul>
                                            </div>

                                            <!-- Header Buttons -->
                                            <?php do_action( 'venam_header_buttons' ); ?>
                                            <!-- End Header Buttons -->

                                        </nav>
                                    </div>

                                    <!-- Mobile Menu  -->
                                    <?php do_action( 'venam_header_mobile' ); ?>
                                    <!-- End Mobile Menu -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- menu-area-end -->

                    <?php do_action( 'venam_after_header' ); ?>

                </header>
                <!-- header-area-end -->
                <?php
            }
        }
    }
}

if ( !function_exists( 'venam_header_mobile' ) ) {
    add_action( 'venam_header_mobile', 'venam_header_mobile' );
    function venam_header_mobile()
    {
        ?>
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>

            <?php
            venam_logo( true );

            if ( class_exists( 'WooCommerce' ) && '1' == venam_settings( 'mobile_menu_ajax_search_visibility', '0' ) && shortcode_exists( 'venam_wc_ajax_search' ) ) {
                echo do_shortcode('[venam_wc_ajax_search]');
            }
            ?>

            <div class="menu-inner-buttons">
                <div class="menu-inner-button active" data-menu-name="menu"><?php esc_html_e( 'MENU', 'venam' ); ?></div>
                <?php if ( has_nav_menu('category_menu') ) { ?>
                    <div class="menu-inner-button" data-menu-name="cats"><?php esc_html_e( 'CATEGORIES', 'venam' ); ?></div>
                <?php } ?>

                <?php if ( class_exists( 'WooCommerce' ) && '0' != venam_settings( 'header_myaccount_visibility', '1' ) ) {
                    $myaccount_url = '' != venam_settings( 'header_account_url', '' ) ? venam_settings( 'header_account_url', '' ) : '#0';
                    ?>
                    <div class="menu-inner-button" data-menu-name="actions">
                        <a href="<?php echo esc_url( $myaccount_url ); ?>" class="user">
                            <i aria-hidden="true" class="icons far fa-user"></i>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <nav class="menu-box active" data-menu-name="menu">
                <div class="menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                </div>
            </nav>

            <nav class="menu-cats" data-menu-name="cats">
                <div class="menu-cats-outer">
                    <ul class="navigation">
                        <?php
                        echo wp_nav_menu(
                            array(
                                'menu' => '',
                                'theme_location' => 'category_menu',
                                'container' => '',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => '',
                                'menu_id' => '',
                                'items_wrap' => '%3$s',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'depth' => 3,
                                'echo' => true,
                                'fallback_cb' => 'Venam_Wp_Bootstrap_Navwalker::fallback',
                                'walker' => new Venam_Wp_Bootstrap_Navwalker()
                            )
                        );
                        ?>
                    </ul>
                </div>
            </nav>

            <?php
            if ( class_exists( 'WooCommerce' ) && '0' != venam_settings( 'header_myaccount_visibility', '1' ) ) {
                if ( is_user_logged_in() ) {
                    ?>
                    <nav class="menu-form menu_logged_in" data-menu-name="actions">
                        <div class="account-dropdown">
                            <ul class="navigation">
                            <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) { ?>
                                <li class="menu-item <?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
                                    <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                                </li>
                            <?php } ?>
                            </ul>
                        </div>
                    </nav>
                    <?php

                } else {

                    $url = wc_get_page_permalink( 'myaccount' );
                    $actionturl = venam_settings( 'header_account_url', '' );
                    $redirecturl = '' != $actionturl ? array( 'redirect' => $actionturl ) : '';
                    ?>
                    <nav class="menu-form" data-menu-name="actions">
                        <div class="account-dropdown">
                            <div class="account-wrap">
                                <div class="login-form-head">
                                    <span class="login-form-title"><?php esc_html_e( 'Sign in', 'venam' ); ?></span>
                                    <span class="register-form-title">
                                    <a class="register-link" href="<?php echo esc_url( $url ); ?>" title="Register"><?php esc_html_e( 'Create an Account', 'venam' ); ?></a>
                                    </span>
                                </div>
                                <?php woocommerce_login_form( $redirecturl ); ?>
                            </div>
                        </div>
                    </nav>
                    <?php
                }
            }
            ?>
            <?php echo venam_print_elementor_templates( 'mobile_header_footer_template', 'venam-elementor-mobile-menu-footer' ); ?>
        </div>
        <?php
    }
}

if ( !function_exists( 'venam_header_top' ) ) {
    add_action( 'venam_before_header', 'venam_header_top' );
    function venam_header_top()
    {
        echo venam_print_elementor_templates( 'before_header_template', 'header-top-area venam-elementor-before-header' );
    }
}

if ( !function_exists( 'venam_header_bottom' ) ) {
    add_action( 'venam_after_header', 'venam_header_bottom' );
    function venam_header_bottom()
    {
        echo venam_print_elementor_templates( 'after_header_template', 'header-search-area venam-elementor-after-header' );
    }
}

if ( !function_exists( 'venam_header_buttons' ) ) {
    add_action( 'venam_header_buttons', 'venam_header_buttons' );
    function venam_header_buttons()
    {
        if ( class_exists( 'WooCommerce' ) && ( '0' != venam_settings( 'header_myaccount_visibility', '1' ) || '0' != venam_settings( 'header_myaccount_visibility', '1' ) ) ) {
            $compare = esc_html__( 'Compare', 'venam' );
            $wishlist = esc_html__( 'Wishlist', 'venam' );
            $cart = esc_html__( 'Cart', 'venam' );
            $myaccount = esc_html__( 'My Account', 'venam' );
            $count = WC()->cart ? WC()->cart->cart_contents_count : '0';
            ?>

            <div class="header-action">
                <ul>
                    <?php if ( '0' != venam_settings( 'header_myaccount_visibility', '1' ) ) {

                        $url = wc_get_page_permalink( 'myaccount' );
                        $actionturl = venam_settings( 'header_account_url', '' );
                        $myaccount_url = $actionturl ? $actionturl : '#0';
                        $redirecturl = '' != $actionturl ? array( 'redirect' => $actionturl ) : '';
                        ?>
                        <li class="header-shop-account">

                            <?php if ( is_user_logged_in() ) { ?>
                                <a href="<?php echo esc_url( $url ); ?>" class="user hint--top" data-label="<?php echo esc_attr( $myaccount ); ?>">
                                    <?php echo venam_svg_lists( 'user-1' ); ?>
                                </a>
                            <?php } else { ?>
                                <a href="#venam_myaccount" class="venam_header_account venam-open-popup user hint--top" data-label="<?php echo esc_attr( $myaccount ); ?>">
                                    <?php echo venam_svg_lists( 'user-1' ); ?>
                                </a>
                            <?php } ?>

                            <?php if ( !is_admin() && !is_user_logged_in() ) { ?>
                                <div class="venam_mini_account_form zoom-anim-dialog mfp-hide" id="venam_myaccount">
                                    <div class="account-dropdown">
                                        <div class="account-wrap">
                                            <?php woocommerce_output_all_notices(); ?>
                                            <div class="login-form-head">
                                                <span class="login-form-title"><?php esc_html_e( 'Sign in', 'venam' ); ?></span>
                                                <span class="register-form-title">
                                                <a class="register-link" href="<?php echo esc_url( $url ); ?>" title="Register"><?php esc_html_e( 'Create an Account', 'venam' ); ?></a>
                                                </span>
                                            </div>
                                            <?php woocommerce_login_form( $redirecturl ); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?>

                    <?php if ( shortcode_exists( 'woosc' ) ) { ?>
                        <li class="header-shop-compare woosc-menu-item">
                            <?php echo venam_svg_lists( 'compare' ); ?>
                            <a href="#" class="open-compare-btn hint--top" data-label="<?php echo esc_attr( $compare ); ?>"></a>
                        </li>
                    <?php } ?>

                    <?php if ( class_exists('WPCleverWoosw') ) {
                        $url = WPcleverWoosw::get_url();
                        $count = WPcleverWoosw::get_count();
                        ?>
                        <li class="header-shop-wishlist menu-item woosw-menu-item menu-item-type-woosw">
                            <?php echo venam_svg_lists( 'love' ); ?>
                            <a class="venam-wishlist-link hint--top" href="<?php echo esc_url( $url ); ?>" data-label="<?php echo esc_attr( $wishlist ); ?>">
                                <span class="woosw-menu-item-inner" data-count="<?php echo esc_attr( $count ); ?>"></span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( '0' != venam_settings( 'header_cart_visibility', '1' ) ) { ?>
                        <li class="header-shop-cart">
                            <a class="venam-cart-btn hint--top" href="#0" data-label="<?php echo esc_attr( $cart ); ?>">
                                <?php echo venam_svg_lists( 'bag' ); ?>
                                <span class="venam-cart-count cart-count"><?php echo esc_html( $count ); ?></span>
                            </a>
                            <?php if ( WC()->cart->cart_contents_count > 0 ) { ?>
                                <span class="venam-cart-total-price cart-total-price"><?php echo wc_price( WC()->cart->cart_contents_total ); ?></span>
                            <?php } ?>
                            <?php get_template_part( 'woocommerce/minicart/header', 'minicart' ); ?>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <?php
        }
    }
}

if ( !function_exists( 'venam_category_search_form' ) ) {
    function venam_category_search_form() {

        $terms = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false, 'parent' => 0 ) );
        ?>
        <div class="header-search-wrap">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
                <input  type="text" name="s"
                value="<?php get_search_query() ?>"
                placeholder="<?php echo esc_attr_e( 'Search for your item\'s type.....', 'venam' ) ?>">
                <input type="hidden" name="post_type" value="product" />
                <select class="custom-select" name="product_cat">
                    <option value="" selected><?php echo esc_html_e( 'All Category', 'venam' ) ?></option>
                    <?php
                    foreach ( $terms as $term ) {
                        if ( $term->count >= 1 ) {
                            ?>
                            <option value="<?php echo esc_attr( $term->slug ) ?>"><?php echo esc_html( $term->name ) ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <button class="btn-submit" type="submit"><?php echo venam_svg_lists( 'search' ); ?></button>
                <?php do_action( 'wpml_add_language_form_field' ); ?>
            </form>
        </div>
        <?php
    }
}

if ( !function_exists( 'venam_bottom_mobile_menu' ) ) {
    add_action( 'venam_after_main_footer', 'venam_bottom_mobile_menu' );
    function venam_bottom_mobile_menu() {
        if ( '0' == venam_settings( 'bottom_mobile_nav_visibility', '1' ) ) {
            return;
        }
        ?>
        <nav class="venam-bottom-mobile-nav">
            <div class="mobile-nav-wrapper">
                <ul>

                    <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                        <li class="menu-item">
                            <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>" class="store">
                                <?php echo venam_svg_lists( 'store' ); ?>
                                <span><?php echo esc_html_e( 'Store', 'venam' ) ?></span>
                            </a>
                        </li>
                    <?php } ?>

                    <li class="menu-item">
                        <a href="#bottom-search" class="search venam-open-popup">
                            <?php echo venam_svg_lists( 'search' ); ?>
                            <span><?php echo esc_html_e( 'Search', 'venam' ); ?></span>
                        </a>
                    </li>

                    <?php if ( class_exists('WPCleverWoosw') ) {
                        $url = WPcleverWoosw::get_url();
                        ?>
                        <li class="menu-item woosw-menu-item menu-item-type-woosw">
                            <a class="wishlist" href="<?php echo esc_url( apply_filters('venam_bottom_menu_wishlist_url', $url ) ); ?>">
                                <?php echo venam_svg_lists( 'love' ); ?>
                                <span class="woosw-menu-item-inner" data-count="0"></span>
                                <span><?php echo esc_html_e( 'Wishlist', 'venam' ); ?></span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                        <li class="menu-item">
                            <a class="cart" href="<?php echo esc_url( apply_filters('venam_bottom_menu_cart_url', wc_get_page_permalink( 'cart' ) ) ); ?>">
                                <?php echo venam_svg_lists( 'bag' ); ?>
                                <span class="venam-cart-count cart-count"></span>
                                <span><?php echo esc_html_e( 'Cart', 'venam' ); ?></span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                        <li class="menu-item">
                            <a href="<?php echo esc_url( apply_filters('venam_bottom_menu_account_url', wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="user">
                                <?php echo venam_svg_lists( 'user-1' ); ?>
                                <span><?php echo esc_html_e( 'Account', 'venam' ); ?></span>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </nav>
        <?php
        $search_type = venam_settings( 'bottom_mobile_search_type', 'category' );
        if ( 'custom' == $search_type && venam_settings( 'search_form_shortcode' ) ) { ?>
            <div id="bottom-search" class="bottom-fixed-search bottom-search-custom zoom-anim-dialog mfp-hide"><?php echo do_shortcode(venam_settings( 'search_form_shortcode' )); ?></div>
        <?php } elseif ( 'ajax' == $search_type && class_exists( 'WooCommerce' ) && '1' && shortcode_exists( 'venam_wc_ajax_search' ) ) { ?>
            <div id="bottom-search" class="bottom-fixed-search bottom-search-ajax zoom-anim-dialog mfp-hide"><?php echo do_shortcode('[venam_wc_ajax_search]'); ?></div>
        <?php } else { ?>
            <div id="bottom-search" class="bottom-fixed-search zoom-anim-dialog mfp-hide"><?php venam_category_search_form(); ?></div>
        <?php } ?>
        <?php
    }
}
