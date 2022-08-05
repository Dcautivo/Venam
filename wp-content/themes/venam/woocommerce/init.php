<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( class_exists( 'Redux' ) ) {

    if ( ! function_exists( 'venam_dynamic_section' ) ) {
        function venam_dynamic_section($sections)
        {

            global $venam_pre;

            $el_args = array(
                'post_type'      => 'elementor_library',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'elementor_library_type',
                        'field'    => 'slug',
                        'terms'    => 'section'
                    )
                )
            );

            // create sections in the theme options
            $sections[] = array(
                'title' => esc_html__('Shop Page', 'venam'),
                'id' => 'shopsection',
                'icon' => 'el el-shopping-cart-sign',
            );
            // SHOP PAGE SECTION
            $sections[] = array(
                'title' => esc_html__( 'Shop Page Layout', 'venam' ),
                'id' => 'shoplayoutsection',
                'subsection'=> true,
                'icon' => 'el el-website',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Page Layout', 'venam' ),
                        'subtitle' => esc_html__( 'Choose the shop page layout.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_layout',
                        'type' => 'image_select',
                        'options' => array(
                            'left-sidebar' => array(
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'full-width' => array(
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                            ),
                            'right-sidebar' => array(
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            )
                        ),
                        'default' => 'full-width'
                    ),
                    array(
                        'title' => esc_html__('Sidebar Position', 'venam'),
                        'subtitle' => esc_html__('Select your shop sidebar type for desktop.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_sidebar_position',
                        'type' => 'select',
                        'options' => array(
                            'default' => esc_html__('Default', 'venam'),
                            'fixed' => esc_html__('Absolute Left', 'venam'),
                        ),
                        'default' => 'default'
                    ),
                    array(
                        'title' => esc_html__('Ajax Filter', 'venam'),
                        'subtitle' => esc_html__('You can enable or disable the site shop page hero section with switch option.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_ajax_filter',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off'
                    ),
                    array(
                        'title' => esc_html__('Pagination Type', 'venam'),
                        'subtitle' => esc_html__('Select your pagination type.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_paginate_type',
                        'type' => 'select',
                        'options' => array(
                            'pagination' => esc_html__('Default Pagination', 'venam'),
                            'loadmore' => esc_html__('Load More', 'venam'),
                            'infinite' => esc_html__('Infinite Scroll', 'venam')
                        ),
                        'default' => 'pagination'
                    ),
                    array(
                        'title' => esc_html__('Column Select Filter', 'venam'),
                        'subtitle' => esc_html__('You can enable or disable the site shop page column selection with switch option.', 'venam'),
                        'customizer' => true,
                        'id' => 'column_select_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Per Page Select Filter', 'venam'),
                        'subtitle' => esc_html__('You can enable or disable the site shop page per page selection with switch option', 'venam'),
                        'customizer' => true,
                        'id' => 'per_page_select_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Per Page Select Options', 'venam'),
                        'subtitle' => esc_html__('Separate each number with a comma.For example: 12,24,36', 'venam'),
                        'customizer' => true,
                        'id' => 'per_page_select_options',
                        'type' => 'text',
                        'default' => '9,12,18,24',
                        'required' => array( 'per_page_select_visibility', '=', '1' )
                    )
                )
            );
            // SINGLE HERO SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Page Hero', 'venam'),
                'desc' => esc_html__('These are shop page hero section settings', 'venam'),
                'id' => 'shopherosubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Hero display', 'venam'),
                        'subtitle' => esc_html__('You can enable or disable the site shop page hero section with switch option.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_hero_visibility',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off'
                    ),
                    array(
                        'title' => esc_html__( 'Elementor Templates', 'venam' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates.If you want to show the theme default hero template please leave a blank.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_hero_elementor_templates',
                        'type' => 'select',
                        'customizer' => true,
                        'data' => 'posts',
                        'args' => $el_args,
                        'required' => array( 'shop_hero_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Category && Tags Pages Elementor Templates', 'venam' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates.If you want to show the theme default hero template please leave a blank.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_tax_hero_elementor_templates',
                        'type' => 'select',
                        'customizer' => true,
                        'data' => 'posts',
                        'args' => $el_args,
                        'required' => array( 'shop_hero_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Hero Background', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_hero_bg',
                        'type' => 'background',
                        'output' => array( '#nt-shop-page .breadcrumb-bg' ),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_elementor_templates', '=', '' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Page Hero Padding', 'venam'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page Hero Section', 'venam'),
                        'customizer' => true,
                        'id' =>'shop_hero_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-shop-page .breadcrumb-bg'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_elementor_templates', '=', '' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Custom Page Title', 'venam'),
                        'subtitle' => esc_html__('Add your shop page custom title here.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_title',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_elementor_templates', '=', '' )
                        )
                    )
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Page Content', 'venam'),
                'id' => 'shopcontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Page Container Width', 'venam' ),
                        'subtitle' => esc_html__( 'Choose the shop page container width.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_container_width',
                        'type' => 'select',
                        'options' => array(
                            'container' => esc_html__('Default ( Container )', 'venam'),
                            'custom-container-two' => esc_html__('Container 2', 'venam'),
                            'custom-container-three' => esc_html__('Container 3', 'venam'),
                            'container-off' => esc_html__('Full Width', 'venam')
                        ),
                        'default' => 'custom-container-two'
                    ),
                    array(
                        'title' => esc_html__('Page Content Padding', 'venam'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page content.', 'venam'),
                        'customizer' => true,
                        'id' =>'shop_content_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-shop-page .nt-theme-inner-container'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false'
                    ),
                    array(
                        'title' => esc_html__('Product Box Type', 'venam'),
                        'subtitle' => esc_html__('Select your type.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_product_type',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => array(
                            '1' => esc_html__('Type 1 ( Default )', 'venam'),
                            '2' => esc_html__('Type 2 ( List )', 'venam'),
                            '3' => esc_html__('Type 3 Swatches', 'venam')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'title' => esc_html__('Second Image ( on Hover Product ) Display', 'venam'),
                        'subtitle' => esc_html__('You can enable or disable the second image to turn it off when you hover over the product boxes.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_second_image_visibility',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off'
                    ),
                    array(
                        'title' => esc_html__('Add to Cart Type', 'venam'),
                        'subtitle' => esc_html__('Select your type.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_loop_cart_type',
                        'type' => 'select',
                        'options' => array(
                            'default' => esc_html__('Add to cart', 'venam'),
                            'quantity' => esc_html__('Add to cart + Quantity', 'venam')
                        ),
                        'default' => 'default'
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'venam'),
                        'subtitle' => esc_html__('You can control post column with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_colxl',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 6,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post 992px Column ( Responsive: Desktop, Tablet )', 'venam'),
                        'subtitle' => esc_html__('You can control post column on max-device width 992px with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_collg',
                        'type' => 'slider',
                        'default' =>2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post 768px Column ( Responsive: Tablet, Phone )', 'venam'),
                        'subtitle' => esc_html__('You can control post column on max-device-width 768px with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_colsm',
                        'type' => 'slider',
                        'default' =>2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post 480px Column ( Responsive: Phone )', 'venam'),
                        'subtitle' => esc_html__('You can control post column on max-device-width 768px with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_colxs',
                        'type' => 'slider',
                        'default' =>2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 2,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Count', 'venam'),
                        'subtitle' => esc_html__('You can control show post count with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_perpage',
                        'type' => 'slider',
                        'default' => 6,
                        'min' => 1,
                        'step' => 1,
                        'max' => 100,
                        'display_value' => 'text'
                    ),
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Elementor Template', 'venam'),
                'id' => 'shopaftercontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'After Hero Elementor Templates', 'venam' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates, If you want to show any content after hero section.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_after_hero_templates',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => $el_args
                    ),
                    array(
                        'title' => esc_html__( 'Before Loop Elementor Templates', 'venam' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates, If you want to show any content before products loop.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_before_loop_templates',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => $el_args
                    ),
                    array(
                        'title' => esc_html__( 'After Loop Elementor Templates', 'venam' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates, If you want to show any content after products loop.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_after_loop_templates',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => $el_args
                    ),
                    array(
                        'title' => esc_html__( 'Before Footer Elementor Templates', 'venam' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates, If you want to show any content after products.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_after_content_templates',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => $el_args
                    )
                )
            );
            $sections[] = array(
                'title' => esc_html__('Shop Page Post Style', 'venam'),
                'id' => 'shoppoststylesubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Background Color', 'venam'),
                        'subtitle' => esc_html__('Change post background color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_post_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce.exclusive-item')
                    ),
                    array(
                        'title' => esc_html__('Border', 'venam'),
                        'subtitle' => esc_html__('Set your custom border styles for the posts.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_post_brd',
                        'type' => 'border',
                        'all' => false,
                        'output' => array('.woocommerce.exclusive-item')
                    ),
                    array(
                        'title' => esc_html__('Padding', 'venam'),
                        'subtitle' => esc_html__('You can set the spacing of the site shop page post.', 'venam'),
                        'customizer' => true,
                        'id' =>'shop_post_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce.exclusive-item'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    // post button ( Add to cart )
                    array(
                        'title' => esc_html__('Post title', 'venam'),
                        'subtitle' => esc_html__('Change theme main color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_loop_post_title_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.exclusive-item-three .exclusive-item-content h5')
                    ),
                    array(
                        'title' => esc_html__('Price Regular', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_loop_post_price_reg_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce div.product span.price del')
                    ),
                    array(
                        'title' => esc_html__('Price Sale', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_loop_post_price_sale_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce div.product span.price')
                    ),
                    array(
                        'title' => esc_html__('Discount Background', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_loop_post_discount_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce .exclusive-item-thumb .discount')
                    ),
                    // post button ( Add to cart )
                    array(
                        'title' => esc_html__('Button Background ( Add to cart )', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_addtocartbtn_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce .action .action-cart a:not(.added_to_cart)')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Background ( Add to cart )', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_addtocartbtn_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce .action .action-cart a:not(.added_to_cart):hover')
                    ),
                    array(
                        'title' => esc_html__('Button Title ( Add to cart )', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_addtocartbtn_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce .action .action-cart a:not(.added_to_cart)')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Title ( Add to cart )', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_addtocartbtn_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce .action .action-cart a:not(.added_to_cart):hover')
                    ),
                    // post button ( view cart )
                    array(
                        'title' => esc_html__('Button Background ( View cart )', 'venam'),
                        'subtitle' => esc_html__('Change button background color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_viewcartbtn_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce .action .action-cart a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Background ( View cart )', 'venam'),
                        'subtitle' => esc_html__('Change button hover background color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_viewcartbtn_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce .action .action-cart a.added_to_cart:hover')
                    ),
                    array(
                        'title' => esc_html__('Button Title ( View cart )', 'venam'),
                        'subtitle' => esc_html__('Change button title color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_viewcartbtn_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Title ( View cart )', 'venam'),
                        'subtitle' => esc_html__('Change button hover title color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_viewcartbtn_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce .action .action-cart a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Button Border ( View cart )', 'venam'),
                        'subtitle' => esc_html__('Change hover button border style.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_viewcartbtn_brd',
                        'type' => 'border',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Border ( View cart )', 'venam'),
                        'subtitle' => esc_html__('Change hover button border style.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_viewcartbtn_hvrbrd',
                        'type' => 'border',
                        'output' => array('.woocommerce .action .action-cart a.added_to_cart:hover')
                    ),
                    array(
                        'title' => esc_html__('Pagination Background Color', 'venam'),
                        'subtitle' => esc_html__('Change shop page pagination background color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_pagination_bgcolor',
                        'type' => 'color',
                        'mode' => 'background',
                        'default' => '',
                        'output' => array('.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span')
                    ),
                    array(
                        'title' => esc_html__('Active Pagination Background Color', 'venam'),
                        'subtitle' => esc_html__('Change shop page pagination hover and active item background color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_pagination_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background',
                        'default' => '',
                        'output' => array('.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current')
                    ),
                    array(
                        'title' => esc_html__('Pagination Text Color', 'venam'),
                        'subtitle' => esc_html__('Change shop page pagination text color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_pagination_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span')
                    ),
                    array(
                        'title' => esc_html__('Active Pagination Text Color', 'venam'),
                        'subtitle' => esc_html__('Change shop page pagination hover and active item text color.', 'venam'),
                        'customizer' => true,
                        'id' => 'shop_pagination_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current')
                    )
                )
            );

            /*************************************************
            ## SINGLE PAGE SECTION
            *************************************************/
            // create sections in the theme options
            $sections[] = array(
                'title' => esc_html__('Shop Single Page', 'venam'),
                'id' => 'singleshopsection',
                'icon' => 'el el-shopping-cart-sign'
            );
            // SHOP PAGE SECTION
            $sections[] = array(
                'title' => esc_html__('General', 'venam'),
                'id' => 'singleshopgeneral',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Page Layout', 'venam' ),
                        'subtitle' => esc_html__( 'Choose the single page layout.', 'venam' ),
                        'customizer' => true,
                        'id' => 'single_shop_layout',
                        'type' => 'image_select',
                        'options' => array(
                            'left-sidebar' => array(
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'full-width' => array(
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                            ),
                            'right-sidebar' => array(
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            )
                        ),
                        'default' => 'full-width'
                    ),
                    array(
                        'id' => 'shop_related_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Related Post Options', 'venam'),
                        'customizer' => true,
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Related Title', 'venam'),
                        'subtitle' => esc_html__('Add your single shop page related section title here.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_related_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Count ( Per Page )', 'venam'),
                        'subtitle' => esc_html__('You can control show related post count with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_related_count',
                        'type' => 'slider',
                        'default' => 10,
                        'min' => 1,
                        'step' => 1,
                        'max' => 24,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_related_section_slider_start',
                        'type' => 'section',
                        'title' => esc_html__('Related Slider Options', 'venam'),
                        'customizer' => true,
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 1024px )', 'venam' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_perview',
                        'type' => 'slider',
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 768px )', 'venam' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_mdperview',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 480px )', 'venam' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_smperview',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Speed', 'venam' ),
                        'subtitle' => esc_html__( 'You can control related post slider item gap.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_speed',
                        'type' => 'slider',
                        'default' => 1000,
                        'min' => 100,
                        'step' => 1,
                        'max' => 10000,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Gap', 'venam' ),
                        'subtitle' => esc_html__( 'You can control related post slider item gap.', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_gap',
                        'type' => 'slider',
                        'default' => 30,
                        'min' => 0,
                        'step' => 1,
                        'max' => 100,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Centered', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_centered',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Autoplay', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_autoplay',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Loop', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_loop',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Mousewheel', 'venam' ),
                        'customizer' => true,
                        'id' => 'shop_related_mousewheel',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'id' => 'shop_related_section_slider_end',
                        'type' => 'section',
                        'customizer' => true,
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_related_section_end',
                        'type' => 'section',
                        'customizer' => true,
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_upsells_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Upsells Post Options', 'venam'),
                        'customizer' => true,
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Upsells Title', 'venam'),
                        'subtitle' => esc_html__('Add your single shop page upsells section title here.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_upsells_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'venam'),
                        'subtitle' => esc_html__('You can control upsells post column with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_upsells_colxl',
                        'type' => 'slider',
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 6,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Desktop/Tablet )', 'venam'),
                        'subtitle' => esc_html__('You can control upsells post column for tablet device with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_upsells_collg',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 4,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Tablet )', 'venam'),
                        'subtitle' => esc_html__('You can control upsells post column for phone device with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_upsells_colsm',
                        'type' => 'slider',
                        'default' => 1,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Phone )', 'venam'),
                        'subtitle' => esc_html__('You can control upsells post column for phone device with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_upsells_colxs',
                        'type' => 'slider',
                        'default' => 1,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_upsells_section_end',
                        'type' => 'section',
                        'customizer' => true,
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_crosssells_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Cross-Sells Post Options', 'venam'),
                        'customizer' => true,
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Cross-Sells Title', 'venam'),
                        'subtitle' => esc_html__('Add your cart page cross-sells section title here.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_crosssells_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'venam'),
                        'subtitle' => esc_html__('You can control cross-sells post column with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_crosssells_colxl',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 6,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Desktop/Tablet )', 'venam'),
                        'subtitle' => esc_html__('You can control cross-sells post column for tablet device with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_crosssells_collg',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 6,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Tablet )', 'venam'),
                        'subtitle' => esc_html__('You can control cross-sells post column for phone device with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_crosssells_colsm',
                        'type' => 'slider',
                        'default' => 1,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Phone )', 'venam'),
                        'subtitle' => esc_html__('You can control cross-sells post column for phone device with this option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_crosssells_colxs',
                        'type' => 'slider',
                        'default' => 1,
                        'min' => 1,
                        'step' => 1,
                        'max' => 2,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_crosssells_section_end',
                        'type' => 'section',
                        'customizer' => true,
                        'indent' => false
                    )
                )
            );
            // SINGLE HERO SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Single Hero', 'venam'),
                'desc' => esc_html__('These are single product page hero section settings!', 'venam'),
                'id' => 'singleshopherosubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Hero display', 'venam'),
                        'subtitle' => esc_html__('You can enable or disable the site single product page hero section with switch option.', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_hero_visibility',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off'
                    ),
                    array(
                        'title' => esc_html__( 'Elementor Templates', 'venam' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates.If you want to show the theme default hero template please leave a blank.', 'venam' ),
                        'customizer' => true,
                        'id' => 'single_shop_hero_elementor_templates',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => $el_args,
                        'required' => array( 'single_shop_hero_visibility', '=', '1' ),
                    ),
                    array(
                        'title' => esc_html__('Hero Background', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_hero_bg',
                        'type' => 'background',
                        'output' => array( '#nt-woo-single .venam-shop-hero' ),
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_elementor_templates', '=', '' )
                        )
                    )
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Single Content', 'venam'),
                'id' => 'singleshopcontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Single Content Padding', 'venam'),
                        'subtitle' => esc_html__('You can set the top spacing of the site single page content.', 'venam'),
                        'customizer' => true,
                        'id' =>'single_shop_content_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-woo-single .nt-theme-inner-container'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false'
                    )
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Show / Hide Elements', 'venam'),
                'id' => 'singleshopcontentonoffsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Products navigation', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_nav_visibility',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off'
                    ),
                    array(
                        'title' => esc_html__('Products All Labels', 'venam'),
                        'subtitle' => esc_html__('Sale, Stock, Discount', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_top_labels_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Rating', 'venam'),
                        'subtitle' => esc_html__('stars, review count', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_rating_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Excerpt', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_excerpt_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__( 'Ask a Question Form', 'venam' ),
                        'subtitle' => esc_html__( 'Select an elementor template from list', 'venam' ),
                        'customizer' => true,
                        'id' => 'single_shop_question_form_template',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => $el_args
                    ),
                    array(
                        'title' => esc_html__( 'Delivery & Return', 'venam' ),
                        'subtitle' => esc_html__( 'Select an elementor template from list', 'venam' ),
                        'customizer' => true,
                        'id' => 'single_shop_delivery_template',
                        'type' => 'select',
                        'data' => 'posts',
                        'args' => $el_args
                    ),
                    array(
                        'title' => esc_html__('Meta', 'venam'),
                        'subtitle' => esc_html__('SKU, Categories, Tags', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_meta_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Stock progress bar', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_progressbar_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Estimated Delivery', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_estimated_delivery_visibility',
                        'type' => 'switch',
                        'default' => 0
                    ),
                    array(
                        'title' => esc_html__('Estimated Delivery ( Min )', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_min_estimated_delivery',
                        'type' => 'spinner',
                        'default' => '3',
                        'min' => '1',
                        'step' => '1',
                        'max' => '31',
                        'required' => array( 'single_shop_estimated_delivery_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Estimated Delivery ( Max )', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_max_estimated_delivery',
                        'type' => 'spinner',
                        'default' => '7',
                        'min' => '1',
                        'step' => '1',
                        'max' => '31',
                        'required' => array( 'single_shop_estimated_delivery_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Fake Visitor Count', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_visit_count_visibility',
                        'type' => 'switch',
                        'default' => 0
                    ),
                    array(
                        'title' => esc_html__('Fake Visitor Count ( Min )', 'venam'),
                        'customizer' => true,
                        'id' => 'visit_count_min',
                        'type' => 'spinner',
                        'default' => '10',
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'required' => array( 'single_shop_visit_count_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Fake Visitor Count ( Max )', 'venam'),
                        'customizer' => true,
                        'id' => 'visit_count_max',
                        'type' => 'spinner',
                        'default' => '50',
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'required' => array( 'single_shop_visit_count_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Fake Visitor Count ( Delay )', 'venam'),
                        'customizer' => true,
                        'id' => 'visit_count_delay',
                        'type' => 'spinner',
                        'default' => '30000',
                        'min' => '1000',
                        'step' => '100',
                        'max' => '100000',
                        'required' => array( 'single_shop_visit_count_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Fake Visitor Count ( Change )', 'venam'),
                        'customizer' => true,
                        'id' => 'visit_count_change',
                        'type' => 'spinner',
                        'default' => '5',
                        'min' => '1',
                        'step' => '1',
                        'max' => '50',
                        'required' => array( 'single_shop_visit_count_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Countdown', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_countdown_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Tabs', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_tabs_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Upsells', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_upsells_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Related', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_ralated_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__('Reviews', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_review_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Share Buttons', 'venam'),
                'id' => 'singleshopsharesubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Products share', 'venam'),
                        'customizer' => true,
                        'id' => 'single_shop_share_visibility',
                        'type' => 'switch',
                        'default' => 1
                    ),
                    array(
                        'title' => esc_html__( 'Share type', 'venam' ),
                        'subtitle' => esc_html__( 'Select your product share type.', 'venam' ),
                        'customizer' => true,
                        'id' => 'single_shop_share_type',
                        'type' => 'select',
                        'multiple' => false,
                        'options' => array(
                            'share' => esc_html__( 'Share', 'venam' ),
                            'follow' => esc_html__( 'follow', 'venam' )
                        ),
                        'default' => 'share',
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Facebook', 'venam'),
                        'customizer' => true,
                        'id' => 'share_facebook',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Facebook link', 'venam'),
                        'customizer' => true,
                        'id' => 'facebook_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'share_facebook', '=', '1' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Twitter', 'venam'),
                        'customizer' => true,
                        'id' => 'share_twitter',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Twitter link', 'venam'),
                        'customizer' => true,
                        'id' => 'twitter_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'share_twitter', '=', '1' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Email', 'venam'),
                        'customizer' => true,
                        'id' => 'share_email',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Instagram', 'venam'),
                        'customizer' => true,
                        'id' => 'share_instagram',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Instagram link', 'venam'),
                        'customizer' => true,
                        'id' => 'instagram_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_instagram', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Youtube', 'venam'),
                        'customizer' => true,
                        'id' => 'share_youtube',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Youtube link', 'venam'),
                        'customizer' => true,
                        'id' => 'youtube_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_youtube', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Vimeo', 'venam'),
                        'customizer' => true,
                        'id' => 'share_vimeo',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Vimeo link', 'venam'),
                        'customizer' => true,
                        'id' => 'vimeo_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_vimeo', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Pinterest', 'venam'),
                        'customizer' => true,
                        'id' => 'share_pinterest',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Pinterest link', 'venam'),
                        'customizer' => true,
                        'id' => 'pinterest_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'share_pinterest', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Linkedin', 'venam'),
                        'customizer' => true,
                        'id' => 'share_linkedin',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Linkedin link', 'venam'),
                        'customizer' => true,
                        'id' => 'linkedin_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'share_linkedin', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Tumblr', 'venam'),
                        'customizer' => true,
                        'id' => 'share_tumblr',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Tumblr link', 'venam'),
                        'customizer' => true,
                        'id' => 'tumblr_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_tumblr', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Flickr', 'venam'),
                        'customizer' => true,
                        'id' => 'share_flickr',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Flickr link', 'venam'),
                        'customizer' => true,
                        'id' => 'flickr_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_flickr', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Github', 'venam'),
                        'customizer' => true,
                        'id' => 'share_github',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Github link', 'venam'),
                        'customizer' => true,
                        'id' => 'github_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_github', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Behance', 'venam'),
                        'customizer' => true,
                        'id' => 'share_behance',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Behance link', 'venam'),
                        'customizer' => true,
                        'id' => 'behance_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_behance', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Dribbble', 'venam'),
                        'customizer' => true,
                        'id' => 'share_dribbble',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Dribbble link', 'venam'),
                        'customizer' => true,
                        'id' => 'dribbble_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_dribbble', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Soundcloud', 'venam'),
                        'customizer' => true,
                        'id' => 'share_soundcloud',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Soundcloud link', 'venam'),
                        'customizer' => true,
                        'id' => 'soundcloud_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_soundcloud', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Spotify', 'venam'),
                        'customizer' => true,
                        'id' => 'share_spotify',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Spotify link', 'venam'),
                        'customizer' => true,
                        'id' => 'spotify_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_spotify', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Ok', 'venam'),
                        'customizer' => true,
                        'id' => 'share_ok',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Ok link', 'venam'),
                        'customizer' => true,
                        'id' => 'ok_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'share_ok', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Whatsapp', 'venam'),
                        'customizer' => true,
                        'id' => 'share_whatsapp',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Whatsapp link', 'venam'),
                        'customizer' => true,
                        'id' => 'whatsapp_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'share_whatsapp', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Telegram', 'venam'),
                        'customizer' => true,
                        'id' => 'share_telegram',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__('Telegram link', 'venam'),
                        'customizer' => true,
                        'id' => 'telegram_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'share_telegram', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Viber', 'venam'),
                        'customizer' => true,
                        'id' => 'share_viber',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'share' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Viber link', 'venam'),
                        'customizer' => true,
                        'id' => 'viber_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'share' ),
                            array( 'share_viber', '=', '1' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Tiktok', 'venam'),
                        'customizer' => true,
                        'id' => 'share_tiktok',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Tiktok link', 'venam'),
                        'customizer' => true,
                        'id' => 'tiktok_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_tiktok', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Snapchat', 'venam'),
                        'customizer' => true,
                        'id' => 'share_snapchat',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Snapchat link', 'venam'),
                        'customizer' => true,
                        'id' => 'snapchat_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'single_shop_share_type', '=', 'follow' ),
                            array( 'share_snapchat', '=', '1' ),
                        )
                    ),
                    array(
                        'title' => esc_html__('Vk', 'venam'),
                        'customizer' => true,
                        'id' => 'share_vk',
                        'type' => 'switch',
                        'default' => 1,
                        'required' => array( 'single_shop_share_visibility', '=', '1' ),
                    ),
                    array(
                        'title' => esc_html__('Vk link', 'venam'),
                        'customizer' => true,
                        'id' => 'vk_link',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_share_visibility', '=', '1' ),
                            array( 'share_vk', '=', '1' ),
                        )
                    ),
                )
            );
            return $sections;
        }
        add_filter('redux/options/'.$venam_pre.'/sections', 'venam_dynamic_section');
    }
}

/*************************************************
## REGISTER SIDEBAR FOR WOOCOMMERCE
*************************************************/

if ( ! function_exists( 'venam_wc_widgets_init' ) ) {
    add_action( 'widgets_init', 'venam_wc_widgets_init' );
    function venam_wc_widgets_init()
    {
        //Shop page sidebar
        register_sidebar( array(
            'name' => esc_html__( 'Shop Page Sidebar', 'venam' ),
            'id' => 'shop-page-sidebar',
            'description' => esc_html__( 'These widgets for the Shop page.','venam' ),
            'before_widget' => '<div class="nt-sidebar-inner-widget shop-widget mb-40 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="shop-widget-title"><h6 class="nt-sidebar-inner-widget-title title">',
            'after_title' => '</h6></div>'
        ) );
        //Single product sidebar
        register_sidebar( array(
            'name' => esc_html__( 'Shop Single Page Sidebar', 'venam' ),
            'id' => 'shop-single-sidebar',
            'description' => esc_html__( 'These widgets for the Shop Single page.','venam' ),
            'before_widget' => '<div class="nt-sidebar-inner-widget shop-widget mb-40 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="shop-widget-title"><h6 class="nt-sidebar-inner-widget-title title">',
            'after_title' => '</h6></div>'
        ) );
    }
}

if ( ! function_exists( 'venam_shop_page_title' ) ) {
    add_filter( 'woocommerce_page_title', 'venam_shop_page_title');
    function venam_shop_page_title( $page_title )
    {
        if ( 'Shop' == $page_title && venam_settings( 'shop_title' ) ) {
            return '<h2 class="nt-hero-title page-title mb-10">'.venam_settings( 'shop_title' ).'</h2>';
        } else {
            return '<h2 class="nt-hero-title page-title mb-10">'.$page_title.'</h2>';
        }
    }
}

/*************************************************
## WOOCOMMERCE HERO FUNCTION
*************************************************/

if ( ! function_exists( 'venam_wc_hero_section' ) ) {
    function venam_wc_hero_section()
    {
        $name = is_product() ? 'single_shop' : 'shop';

        $template_id = apply_filters( 'venam_translated_template_id', intval( venam_settings( $name.'_hero_elementor_templates' ) ) );
        $tax_template_id = apply_filters( 'venam_translated_template_id', intval( venam_settings( 'shop_tax_hero_elementor_templates' ) ) );
        $is_elementor = class_exists( '\Elementor\Frontend' ) ? true : false;
        $frontend = $is_elementor ? new \Elementor\Frontend : false;

        if ( '0' != venam_settings($name.'_hero_visibility', '1') ) {

            if ( ( is_product_category() || is_product_tag() ) && $is_elementor && $tax_template_id ) {

                printf( '<div class="venam-shop-hero-tax">%1$s</div>', $frontend->get_builder_content( $tax_template_id, false ) );

            } elseif ( ( is_shop() || is_product() ) && $is_elementor && $template_id  ) {

                printf( '<div class="venam-shop-custom-hero">%1$s</div>', $frontend->get_builder_content( $template_id, false ) );

            } else {
                ?>
                <div class="venam-shop-hero breadcrumb-area breadcrumb-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="breadcrumb-content text-center">

                                    <!---page title !-->
                                    <?php woocommerce_page_title(); ?>

                                    <!---page breadcrumbs !-->
                                    <?php echo venam_breadcrumbs(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}

if ( ! function_exists( 'venam_after_shop_page' ) ) {
    add_action( 'venam_after_wc_shop_page', 'venam_after_shop_page', 10 );
    function venam_after_shop_page()
    {
        echo venam_print_elementor_templates( 'shop_after_content_templates', '' );
    }
}

if ( ! function_exists( 'venam_after_shop_loop' ) ) {
    add_action( 'venam_after_shop_loop', 'venam_after_shop_loop', 10 );
    function venam_after_shop_loop()
    {
        echo venam_print_elementor_templates( 'shop_after_loop_templates', 'wc--row row after-shop--loop', true );
    }
}

if ( ! function_exists( 'venam_after_shop_hero' ) ) {
    add_action( 'venam_after_shop_hero', 'venam_after_shop_hero', 10 );
    function venam_after_shop_hero()
    {
        echo venam_print_elementor_templates( 'shop_after_hero_templates', '', true );
    }
}

/*************************************************
## Shop View Pagination
*************************************************/
if ( ! function_exists( 'venam_ft' ) ){
    function venam_ft()
    {
        $getft  = isset( $_GET['ft'] ) ? $_GET['ft'] : '';
        return esc_html($getft);
    }
}


/*************************************************
## Get Columns options
*************************************************/
if ( ! function_exists( 'venam_get_shop_column' ) ) {
    function venam_get_shop_column()
    {
        $column = isset( $_GET['column'] ) ? $_GET['column'] : '';
        return esc_html($column);
    }
}


/*************************************************
## THEME CUSTOM CSS AND JS FOR WOOCOMMERCE
*************************************************/

if ( ! function_exists( 'venam_wc_scripts' ) ) {
    function venam_wc_scripts()
    {
        $rtl = is_rtl() ? '-rtl' : '';
        wp_enqueue_style( 'venam-wc', get_template_directory_uri() . '/woocommerce/css/woocommerce-custom'.$rtl.'.css',false, '1.0');

        wp_enqueue_style( 'venam-wc-single', get_template_directory_uri() . '/woocommerce/css/single-page'.$rtl.'.css',false, '1.0');

        if ( is_cart() ) {
            wp_enqueue_style( 'venam-cart', get_template_directory_uri() . '/woocommerce/css/woocommerce-cart'.$rtl.'.css',false, '1.0');
        }

        if ( class_exists('WeDevs_Dokan') ) {
            wp_enqueue_style( 'venam-dokan', get_template_directory_uri() . '/woocommerce/css/dokan'.$rtl.'.css',false, '1.0');
        }

        if ( class_exists('WCFMmp') ) {
            wp_enqueue_style( 'venam-wcfm', get_template_directory_uri() . '/woocommerce/css/wcfm'.$rtl.'.css',false, '1.0');
        }

        wp_enqueue_style( 'venam-sidebar', get_template_directory_uri() . '/woocommerce/css/woocommerce-sidebar'.$rtl.'.css',false, '1.0');
        wp_enqueue_script('venam-wc', get_template_directory_uri() . '/woocommerce/js/woocommerce-custom.js', array('jquery'), '1.0', true);
        wp_register_script( 'venam-plus-minus', get_template_directory_uri() . '/woocommerce/js/plus_minus.js', array('jquery'), '1.0', true);

        if ( is_shop() || is_product_category() ) {

            if ( '1' == venam_settings('shop_ajax_filter', '0' ) ) {
                wp_enqueue_script( 'pjax', get_template_directory_uri() . '/woocommerce/js/pjax/pjax.js',array('jquery'), '1.0', false );
                wp_enqueue_script( 'shopAjaxFilter', get_template_directory_uri() . '/woocommerce/js/pjax/shopAjaxFilter.js',array('jquery', 'pjax'), '1.0', true );
            }

            if ( venam_settings('shop_paginate_type') == 'infinite' || venam_ft() == 'infinite' ) {
                wp_enqueue_script( 'venam-load-more', get_template_directory_uri(). '/woocommerce/js/infinite-scroll.js', array( 'jquery' ), false, '1.0' );
            }

            if ( venam_settings('shop_paginate_type') == 'loadmore' || venam_ft() == 'load-more' ) {
                wp_enqueue_script( 'venam-load-more', get_template_directory_uri(). '/woocommerce/js/load_more.js', array( 'jquery' ), false, '1.0' );
            }
        }

        if ( 'quantity' == venam_settings('shop_loop_cart_type', 'default') ) {
            wp_enqueue_script( 'venam-quantity_button', get_template_directory_uri() . '/woocommerce/js/quantity_button.js', array('jquery'), '1.0.0', true );
        }
    }
    add_action( 'wp_enqueue_scripts', 'venam_wc_scripts' );
}

if ( ! function_exists( 'venam_wc_filters_for_ajax' ) ) {
    function venam_wc_filters_for_ajax()
    {
        if ( '1' == venam_get_shop_column() ) {
            $type = 2;
        } elseif ( intval(venam_get_shop_column()) > 1 && '2' == venam_settings( 'shop_product_type', '1' ) ) {
            $type = 3;
        } else {
            $type = apply_filters( 'venam_product_type', venam_settings( 'shop_product_type', '1' ) );
        }
        return json_encode(
            array(
                'ajaxurl'      => esc_url( admin_url( 'admin-ajax.php' ) ),
                'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
                'max_page'     => wc_get_loop_prop( 'total_pages' ),
                'per_page'     => isset( $_GET['per_page'] ) ? $_GET['per_page'] : wc_get_loop_prop( 'per_page' ),
                'layered_nav'  => WC_Query::get_layered_nav_chosen_attributes(),
                'cat_id'       => isset( get_queried_object()->term_id ) ? get_queried_object()->term_id : '',
                'filter_cat'   => isset( $_GET['filter_cat'] ) ? $_GET['filter_cat'] : '',
                'on_sale'      => isset( $_GET['on_sale'] ) ? wc_get_product_ids_on_sale() : '',
                'orderby'      => isset( $_GET['orderby'] ) ? $_GET['orderby'] : '',
                'min_price'    => isset( $_GET['min_price'] ) ? $_GET['min_price'] : '',
                'max_price'    => isset( $_GET['max_price'] ) ? $_GET['max_price'] : '',
                'product_type' => $type,
                'no_more'      => esc_html__( 'All Product Loaded', 'venam' )
            )
        );
    }
}


if ( ! function_exists( 'venam_get_cat_url' ) ) {
    function venam_get_cat_url( $termid )
    {
        global $wp;
        if ( '' === get_option( 'permalink_structure' ) ) {
            $link = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
        } else {
            $link = preg_replace( '%\/page/[0-9]+%', '', add_query_arg( null, null ) );
        }

        if ( isset( $_GET['filter_cat'] ) ) {
            $explode_old = explode( ',', $_GET['filter_cat'] );
            $explode_termid = explode( ',', $termid );

            if ( in_array( $termid, $explode_old ) ) {
                $data = array_diff( $explode_old, $explode_termid );
                $checkbox = 'checked';
            } else {
                $data = array_merge( $explode_termid , $explode_old );
            }
        } else {
            $data = array( $termid );
        }

        $dataimplode = implode( ',', $data );

        if ( empty( $dataimplode ) ) {
            $link = remove_query_arg( 'filter_cat', $link );
        } else {
            $link = add_query_arg( 'filter_cat', implode( ',', $data ), $link );
        }

        return $link;
    }
}

/*************************************************
## ADD THEME SUPPORT FOR WOOCOMMERCE
*************************************************/
if ( ! function_exists( 'venam_wc_shop_per_page' ) ) {
    add_action( 'after_setup_theme', 'venam_wc_theme_setup' );
    function venam_wc_theme_setup()
    {
        add_theme_support( 'woocommerce' );
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 450,
            'single_image_width' => 980
        ) );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}

/*************************************************
## MINICART AND QUICK-VIEW
*************************************************/

include get_template_directory() . '/woocommerce/minicart/actions.php';
include get_template_directory() . '/woocommerce/load-more/load-more.php';


/**
* Change number of products that are displayed per page (shop page)
*/
if ( ! function_exists( 'venam_wc_shop_per_page' ) ) {
    add_filter( 'loop_shop_per_page', 'venam_wc_shop_per_page', 20 );
    add_filter( 'dokan_store_products_per_page', 'venam_wc_shop_per_page', 20 );
    function venam_wc_shop_per_page( $cols )
    {
        if ( isset( $_GET['per_page'] ) && $_GET['per_page'] ) {
            return $_GET['per_page'];
        }

        if ( '1' == venam_get_shop_column() ) {
            return 8;
        }

        $cols = 'wide' == venam_get_option() ? 15 : apply_filters( 'venam_wc_shop_per_page', venam_settings( 'shop_perpage', '8' ) );

        if ( class_exists('WeDevs_Dokan') && dokan_is_store_page() ) {
            $store_user  = dokan()->vendor->get( get_query_var( 'author' ) );
            $store_info  = dokan_get_store_info( $store_user->get_id() );
            $cols        = dokan_get_option( 'store_products_per_page', 'dokan_general', 12 );

            return $cols;
        }

        return $cols;
    }
}


/**
* Change product column
*/
if ( ! function_exists( 'venam_wc_product_column' ) ) {

    function venam_wc_product_column()
    {
        if ( '2' == venam_settings('shop_product_type', '1') ) {
            if ( 'wide' == venam_get_option() ) {
                return apply_filters( 'venam_product_column', 'row-cols-1 row-cols-xl-2' );
            }
        }
        if ( '1' == venam_get_shop_column() ) {
            return apply_filters( 'venam_product_column', 'row-cols-1 row-cols-sm-1 row-cols-lg-1' );
        }
        if ( !venam_get_shop_column() && '2' == venam_settings('shop_product_type', '1') ) {
            return apply_filters( 'venam_product_column', 'row-cols-1 row-cols-sm-1 row-cols-lg-1' );
        }
        if ( '2' == venam_get_shop_column() ) {
            return apply_filters( 'venam_product_column', 'row-cols-2 row-cols-sm-2 row-cols-lg-2' );
        }
        if ( '3' == venam_get_shop_column() ) {
            return apply_filters( 'venam_product_column', 'row-cols-2 row-cols-sm-2 row-cols-lg-3' );
        }
        if ( '4' == venam_get_shop_column() ) {
            return apply_filters( 'venam_product_column', 'row-cols-2 row-cols-sm-2 row-cols-lg-4' );
        }
        if ( '5' == venam_get_shop_column() ) {
            return apply_filters( 'venam_product_column', 'row-cols-2 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5' );
        }

        $col[] = 'row-cols-' . venam_settings('shop_colxs', '2');
        $col[] = 'row-cols-sm-' . venam_settings('shop_colsm', '2');
        $col[] = 'row-cols-lg-' . venam_settings('shop_collg', '3');
        $col[] = 'row-cols-xl-' . venam_settings('shop_colxl', '4');
        $col = implode( ' ', $col );

        return apply_filters( 'venam_product_column', $col );
    }
}


/**
* Change number of upsells products column
*/
if ( ! function_exists( 'venam_wc_sells_product_column' ) ) {

    function venam_wc_sells_product_column()
    {
        $sells = is_cart() ? 'crosssells' : 'upsells';
        $col[] = 'cart row-cols-' . venam_settings('single_shop_'.$sells.'_colsm', '2');
        $col[] = 'row-cols-sm-' . venam_settings('single_shop_'.$sells.'_colsm', '2');
        $col[] = 'row-cols-lg-' . venam_settings('single_shop_'.$sells.'_collg', '3');
        $col[] = 'row-cols-xl-' . venam_settings('single_shop_'.$sells.'_colxl', '4');
        $col   = implode( ' ', $col );
        return apply_filters( 'venam_wc_sells_column', $col );
    }
}


/**
* Change number of related products output
*/
if ( ! function_exists( 'venam_wc_related_products_limit' ) ) {

    add_filter( 'woocommerce_output_related_products_args', 'venam_wc_related_products_limit', 20 );
    function venam_wc_related_products_limit( $args )
    {
        $args['posts_per_page'] = apply_filters( 'venam_wc_related_products_limit', venam_settings('single_shop_related_count', '6') ); // 4 related products
        return $args;
    }
}


/**
* Theme custom filter and actions for woocommerce
*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

//add_filter( 'woocommerce_get_stock_html', '__return_null' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

add_action( 'venam_before_single_product_summary', 'venam_product_top_details', 5 );
add_action( 'woocommerce_single_product_summary', 'venam_wc_product_countdown', 25 );
add_action( 'woocommerce_single_product_summary', 'venam_product_stock_progress_bar', 26 );
add_action( 'woocommerce_single_product_summary', 'venam_wc_single_brand', 45 );


add_action( 'venam_loop_product_details', 'venam_product_badge', 5 );
add_action( 'venam_loop_product_details', 'venam_product_discount', 10 );
add_action( 'venam_loop_product_details', 'venam_wc_product_brand', 15 );

add_action( 'venam_loop_product_title', 'venam_product_title', 10 );
add_action( 'venam_loop_product_title', 'venam_product_price', 20 );

//add_action( 'venam_loop_product_thumb', 'venam_product_nostock', 5 );
add_action( 'venam_loop_product_thumb', 'venam_product_thumb', 10 );
add_action( 'venam_loop_product_buttons', 'venam_product_buttons', 10 );

add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'venam_minicart_before_buttons', 10 );


/**
* Clear Filters
*/
if ( ! function_exists( 'venam_clear_filters' ) ) {
    function venam_clear_filters() {

        $url = wc_get_page_permalink( 'shop' );
        $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();

        $min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '';
        $max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';

        if ( 0 < count( $_chosen_attributes ) || $min_price || $max_price ) {
            $reset_url = strtok( $url, '?' );
            if ( isset( $_GET['post_type'] ) ) {
                $reset_url = add_query_arg( 'post_type', wc_clean( wp_unslash( $_GET['post_type'] ) ), $reset_url );
            }
            ?>
            <div class="venam-clear-filters">
                <a href="<?php echo esc_url( $reset_url ); ?>"><?php echo esc_html__( 'Clear filters', 'venam' ); ?></a>
            </div>
            <?php
        }
    }
    add_action( 'venam_before_choosen_filters', 'venam_clear_filters' );
}


/**
* Product thumbnail
*/
if ( ! function_exists( 'venam_minicart_before_buttons' ) ) {
    function venam_minicart_before_buttons()
    {
        if ( venam_settings('header_cart_before_buttons', '' ) ) {
        ?>
        <div class="minicart-extra-text">
            <?php echo venam_settings('header_cart_before_buttons', '' ); ?>
        </div>
        <?php
        }
    }
}

/**
* Product thumbnail
*/
if ( ! function_exists( 'venam_product_thumb' ) ) {
    function venam_product_thumb()
    {
        wp_is_mobile();
        global $product;
        $second_image = venam_settings('shop_second_image_visibility', '1');
        $size = apply_filters( 'venam_product_thumb_size', 'woocommerce_thumbnail' );
        $gallery = $product->get_gallery_image_ids();
        $attr = !empty( $gallery ) && '0' != $second_image && !wp_is_mobile() ? array( 'class' => 'has-overlay-thumb attachment-woocommerce_thumbnail' ) : array( 'class' => 'attachment-woocommerce_thumbnail' );
        ?>
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( $product->get_id(), $size, $attr );
            } else {
                echo wc_placeholder_img( $size );
            }

            if ( !empty( $gallery ) && '0' != $second_image && !wp_is_mobile() ) {
                echo wp_get_attachment_image( $gallery[0], $size, "", array( "class" => "overlay-product-thumb" ) );
            }
            ?>
        </a>
        <?php
    }
}


/**
* Product buttons
*/
if ( ! function_exists( 'venam_product_buttons' ) ) {
    function venam_product_buttons()
    {
        global $product;
        $id = $product->get_id();
        ?>
        <div class="action">
            <div class="action-cart">
                <?php
                if ( 'quantity' == venam_settings('shop_loop_cart_type', 'default') ) {
                    venam_cart_with_quantity();
                } else {
                    woocommerce_template_loop_add_to_cart();
                }
                ?>
            </div>
            <?php if ( shortcode_exists('woosq') || shortcode_exists('woosw') || shortcode_exists('woosc') ) { ?>
                <div class="action-extra">
                <?php
                    if ( shortcode_exists('woosq') ) {
                        echo do_shortcode('[woosq id="'.$id.'" type="link"]');
                    }
                    if ( shortcode_exists('woosw') ) {
                        echo do_shortcode('[woosw type="link"]');
                    }
                    if ( shortcode_exists('woosc') ) {
                        echo do_shortcode('[woosc type="link"]');
                    }
                ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}


/**
* Product wishlist button
*/
if ( ! function_exists( 'venam_wishlist_buttons' ) ) {
    add_filter( 'woosw_button_html', 'venam_wishlist_buttons' );
    function venam_wishlist_buttons()
    {
        global $product;
        $id = $product->get_id();
        $text = get_option( 'woosw_button_text' );
        $text = empty( $text ) ? esc_html__( 'Add to Wishlist', 'venam' ) : $text;
        $icon = venam_svg_lists( 'love' );

        return '<div class="venam-woosw-btn has-svg-icon inline-text">'.$icon.'<a href="#" class="woosw-btn woosw-btn-'.esc_attr( $id ).' hint--top" data-id="'.esc_attr( $id ).'" data-label="'.$text.'" data-product_name="'.esc_html($product->get_name()).'">'.$text.'</a></div>';
    }
}


/**
* Product compare button
*/
if ( ! function_exists( 'venam_compare_button' ) ) {
    add_filter( 'woosc_button_html', 'venam_compare_button' );
    function venam_compare_button()
    {
        global $product;
        $id = $product->get_id();
        $text = get_option( 'woosc_button_text' );
        $text = empty( $text ) ? esc_html__( 'Compare', 'venam' ) : $text;
        $icon = venam_svg_lists( 'compare' );

        return '<div class="venam-woosc-btn has-svg-icon inline-text">'.$icon.'<a href="#" class="woosc-btn wooscp-btn wooscp-btn-'.esc_attr( $id ).' hint--top" data-id="'.esc_attr( $id ) . '" data-label="'.$text.'" data-product_name="'.esc_html($product->get_name()).'">'.$text.'</a></div>';
    }
}


/**
* Product quickview button
*/
if ( ! function_exists( 'venam_quickview_button' ) ) {
    add_filter( 'woosq_button_html', 'venam_quickview_button' );
    function venam_quickview_button()
    {
        global $product;
        $id = $product->get_id();
        $text = get_option( 'woosq_button_text' );
        $text = empty( $text ) ? esc_html__( 'Quick view', 'venam' ) : $text;
        $icon = venam_svg_lists( 'eye' );

        return '<div class="venam-woosq-btn"><a href="#" class="woosq-btn woosq-btn-'.esc_attr( $id ).' hint--top" data-id="'.esc_attr( $id ).'" data-label="'.$text.'"></a>'.$icon.'</div>';
    }
}


/**
* Product discount label
*/
if ( ! function_exists( 'venam_product_discount' ) ) {
    function venam_product_discount()
    {
        global $product;
        $discount = get_post_meta( $product->get_id(), 'venam_product_discount', true );
        if ( 'yes' != $discount && $product->is_on_sale() && ! $product->is_type('variable') ) {
            $regular = (float) $product->get_regular_price();
            $sale = (float) $product->get_sale_price();
            $precision = 1; // Max number of decimals
            $saving = $sale && $regular ? round( 100 - ( $sale / $regular * 100 ), 0 ) . '%' : '';
            echo !empty( $saving ) ? '<span class="discount">'.$saving.'</span>' : '';
        }
    }
}


/**
* Get all product categories
*/
if ( ! function_exists( 'venam_product_categories' ) ) {
    function venam_product_categories()
    {
        $cats = get_terms( 'product_cat' );
        $categories = array();

        if ( empty( $cats ) ) {
            return;
        }

        foreach ( $cats as $cat ) {
            $categories[] = '<a href="'.esc_url( get_term_link( $cat ) ) .'" >'. esc_html( $cat->name ) .'</a>';
        }
        return implode( ', ', $categories );
    }
}


/**
* Get all product tags
*/
if ( ! function_exists( 'venam_product_tags' ) ) {
    function venam_product_tags()
    {

        $tags = get_terms( 'product_tag' );
        $alltags = array();
        if ( empty( $tags ) ) {
            return;
        }
        foreach ( $tags as $tag ) {
            $alltags[] = '<a href="'.esc_url( get_term_link( $tag ) ) .'" >'. esc_html( $tag->name ) .'</a>';
        }
        return implode( ', ', $alltags );
    }
}


/**
* Add product attribute name
*/
if ( ! function_exists( 'venam_product_attr_label' ) ) {
    function venam_product_attr_label()
    {
        global $product;

        $attributes = $product->get_attributes();
        foreach ( $attributes as $attribute ) {
            $values = array();
            $product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
                'label' => wc_attribute_label( $attribute->get_name() ),
                'value' => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
            );
            $label = $product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ]['label'];
            $value = $product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ]['value'];
            echo !empty( $label ) ? '<span class="product-attr_label">'.$label.'</span>' : '';
        }
    }
}


if ( ! function_exists( 'venam_single_product_nav' ) ) {
    function venam_single_product_nav() {

        $in_same_term = apply_filters( 'venam_get_prev_product_same_term', false );

        $prev = get_previous_post($in_same_term);
        $next = get_next_post($in_same_term);
        $imgSize = array(100,100,true);
        $has_navs = $prev && $next ? ' has-arrows' : ' has-arrow';
        ?>
        <div class="venam-products-nav<?php echo esc_attr( $has_navs ); ?>">
            <?php if ( $prev ) :
                $prevID = $prev->ID;
                $prevPrice = wc_get_product( $prevID );
                ?>
                <div class="product-btn product-prev">
                    <a href="<?php echo esc_url( get_permalink( $prevID ) ); ?>"><?php echo venam_svg_lists( 'arrow-left' ); ?></a>
                    <div class="wrapper-nav">
                        <div class="product-nav">
                            <a href="<?php echo esc_url( get_permalink( $prevID ) ); ?>" class="product-thumb">
                                <?php echo apply_filters( 'venam_products_nav_image', get_the_post_thumbnail( $prevID, $imgSize ) ); ?>
                                <div class="product-nav-description">
                                    <span class="product-nav-title"><?php echo get_the_title( $prevID ); ?></span>
                                    <span class="price"><?php echo wp_kses_post( $prevPrice->get_price_html() ); ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <a href="<?php echo apply_filters( 'venam_single_product_back_btn_url', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="venam-shop-link">
                <?php echo venam_svg_lists( 'column-2' ); ?>
            </a>

            <?php if ( $next ) :
                $nextID = $next->ID;
                $nextPrice = wc_get_product( $nextID );
                ?>
                <div class="product-btn product-next">
                    <a href="<?php echo esc_url( get_permalink( $nextID ) ); ?>"><?php echo venam_svg_lists( 'arrow-right' ); ?></a>
                    <div class="wrapper-nav">
                        <div class="product-nav">
                            <a href="<?php echo esc_url( get_permalink( $nextID ) ); ?>" class="product-thumb">
                                <?php echo apply_filters( 'venam_products_nav_image', get_the_post_thumbnail( $nextID, $imgSize ) ); ?>
                                <div class="product-nav-description">
                                    <span class="product-nav-title"><?php echo get_the_title( $nextID ); ?></span>
                                    <span class="price"><?php echo wp_kses_post( $nextPrice->get_price_html() ); ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <?php
    }
}


/**
* Add stock progressbar
*/
if ( ! function_exists( 'venam_product_stock_progress_bar' ) ) {
    function venam_product_stock_progress_bar() {
        $product_id  = get_the_ID();
        $progressbar = venam_settings( 'single_shop_progressbar_visibility', '0' );
        $total_stock = get_post_meta( $product_id, 'venam_product_last_stock_left', true );

        if ( ! $total_stock || '0' == $progressbar ) {
            return;
        }

        $current_stock = round( get_post_meta( $product_id, '_stock', true ) );

        $total_sold = $total_stock > $current_stock ? $total_stock - $current_stock : 0;
        $percentage = $total_sold > 0 ? round( $total_sold / $total_stock * 100 ) : 0;

        if ( $current_stock > 0 ) {
            ?>
            <div class="venam-single-product-stock">
                <div class="stock-details">
                    <div class="stock-sold"><?php esc_html_e( 'Ordered:', 'venam' ); ?><span> <?php echo esc_html( $total_sold ); ?></span></div>
                    <div class="current-stock"><?php esc_html_e( 'Items available:', 'venam' ); ?><span> <?php echo esc_html( $current_stock ); ?></span></div>
                </div>
                <div class="venam-product-stock-progress">
                    <div class="venam-product-stock-progressbar" data-stock-percent="<?php echo esc_attr( $percentage ); ?>%"></div>
                </div>
            </div>
            <?php
        }
    }
}

/**
* Add size guide popup
*/
if ( ! function_exists( 'venam_product_popup_details' ) ) {
    add_action( 'woocommerce_single_product_summary', 'venam_product_popup_details', 35 );
    function venam_product_popup_details()
    {
        $product_id  = get_the_ID();

        $guide    = get_post_meta( $product_id, 'venam_product_size_guide', true );
        $question = venam_settings( 'single_shop_question_form_template', null );
        $delivery = venam_settings( 'single_shop_delivery_template', null );
        if ( $guide || $question || $delivery ) {
            ?>
            <div class="venam-product-popup-details">
                <?php venam_product_size_guide(); ?>
                <?php venam_product_delivery_return(); ?>
                <?php venam_product_question_form(); ?>
            </div>
            <?php
        }

        venam_estimated_delivery();
        venam_wc_product_views();
    }
}
/**
* Add size guide popup
*/
if ( ! function_exists( 'venam_product_size_guide' ) ) {

    function venam_product_size_guide()
    {
        $product_id  = get_the_ID();

        $guide_id = get_post_meta( $product_id, 'venam_product_size_guide', true );

        if ( '0' == venam_settings( 'single_shop_size_guide_visibility', '0' ) && '' == $guide_id ) {
            return;
        }
        ?>
        <div class="venam-size-guide-btn has-svg-icon inline-text">
            <?php echo venam_svg_lists('ruler'); ?>
            <a href="#venam_size_guide_<?php echo esc_attr( $product_id ); ?>" class="venam-open-popup"><?php esc_html_e( 'Size Guide', 'venam' ); ?></a>
        </div>
        <div class="venam-single-product-size-guide venam-popup-content-big zoom-anim-dialog mfp-hide" id="venam_size_guide_<?php echo esc_attr( $product_id ); ?>">
            <?php venam_print_elTemplates_by_category( $guide_id, '', true ); ?>
        </div>
        <?php
    }
}

/**
* Add question form popup
*/
if ( ! function_exists( 'venam_product_question_form' ) ) {
    function venam_product_question_form()
    {
        global $product;
        $template_id = venam_settings( 'single_shop_question_form_template', null );

        if ( null == $template_id || '' == $template_id ) {
            return;
        }
        ?>
        <div class="venam-product-question-btn has-svg-icon inline-text">
            <?php echo venam_svg_lists('question'); ?>
            <a href="#venam_product_question_<?php echo esc_attr( $template_id ); ?>" class="venam-open-popup"><?php esc_html_e( 'Ask a Question', 'venam' ); ?></a>
        </div>
        <div class="venam-single-product-question venam-popup-content-big zoom-anim-dialog mfp-hide" id="venam_product_question_<?php echo esc_attr( $template_id ); ?>">

                <div class="venam-product-question-top woocommerce">
                    <div class="venam-product-question-tumb">
                        <a href="<?php echo esc_url( get_permalink() ); ?>">
                            <?php echo get_the_post_thumbnail( $product->get_id(), array(100,100,true) ); ?>
                        </a>
                    </div>
                    <div class="venam-product-question-details">
                        <div class="venam-product-question-title">
                            <a href="<?php echo esc_url( get_permalink() ); ?>">
                                <?php echo get_the_title( $product->get_id() ); ?>
                            </a>
                        </div>
                        <div class="venam-product-question-price">
                            <?php woocommerce_template_loop_price(); ?>
                        </div>
                    </div>
                    <div class="venam-product-question-buttons">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>

            <?php echo venam_print_elementor_templates( 'single_shop_question_form_template', '' ); ?>
        </div>
        <?php
    }
}

/**
* Add delivery and return popup
*/
if ( ! function_exists( 'venam_product_delivery_return' ) ) {
    function venam_product_delivery_return()
    {
        $template_id = venam_settings( 'single_shop_delivery_template', null );

        if ( null == $template_id || '' == $template_id ) {
            return;
        }
        ?>
        <div class="venam-product-delivery-btn has-svg-icon inline-text">
            <?php echo venam_svg_lists('delivery-return'); ?>
            <a href="#venam_product_delivery_<?php echo esc_attr( $template_id ); ?>" class="venam-open-popup"><?php esc_html_e( 'Delivery & Return', 'venam' ); ?></a>
        </div>
        <div class="venam-single-product-delivery venam-popup-content-big zoom-anim-dialog mfp-hide" id="venam_product_delivery_<?php echo esc_attr( $template_id ); ?>">
            <?php echo venam_print_elementor_templates( 'single_shop_delivery_template', '' ); ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'venam_wc_product_views' ) ) {
    function venam_wc_product_views()
    {
        if ( '0' == venam_settings('single_shop_visit_count_visibility', '0' ) ) {
            return;
        }
        wp_enqueue_script( 'jquery-cookie');
        global $product;

        $data[] = venam_settings( 'visit_count_min' ) ? '"min":' . venam_settings( 'visit_count_min' ) : '"min":10';
        $data[] = venam_settings( 'visit_count_max' ) ? '"max":' . venam_settings( 'visit_count_max' ) : '"max":50';
        $data[] = venam_settings( 'visit_count_delay' ) ? '"delay":' . venam_settings( 'visit_count_delay' ) : '"delay":30000';
        $data[] = venam_settings( 'visit_count_change' ) ? '"change":' . venam_settings( 'visit_count_change' ) : '"change":5';
        $data[] = '"id":' . $product->get_id();
        ?>
        <div class="venam-product-view" data-product-view='{<?php echo implode(',', $data ); ?>}'>
            <?php echo venam_svg_lists( 'smile' ); ?>&nbsp;
            <span><span class="venam-view-count">&nbsp;</span> <?php esc_html_e( 'people', 'venam' ); ?></span>&nbsp;
            <?php esc_html_e( 'are viewing this right now', 'venam' ); ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'venam_estimated_delivery' ) ) {
    function venam_estimated_delivery() {

        if ( '0' == venam_settings('single_shop_estimated_delivery_visibility', '0' ) ) {
            return;
        }

        $min_ed = venam_settings('single_shop_min_estimated_delivery');
        $max_ed = venam_settings('single_shop_max_estimated_delivery');

        $min = $min_ed ? $min_ed : 3;
        $from = '+' . $min;
        $from .= ' ' . ( $min = 1 ? 'day' : 'days' );

        $max = $max_ed ? (int) $max_ed : 7;
        $to = '+' . $max;
        $to .= ' ' . ( $max = 1 ? 'day' : 'days' );

        $now = get_date_from_gmt( date('Y-m-d H:i:s'), 'Y-m-d' );
        $est_days = array();

        $format = esc_html__( 'M d', 'venam' );
        $est_days[] = date_i18n( $format, strtotime( $now . $from ), true );
        $est_days[] = date_i18n( $format, strtotime( $now . $to ), true );

        if ( !empty( $est_days ) ) {
            ?>
            <div class="venam-estimated-delivery">
                <?php echo venam_svg_lists( 'shipping' ); ?>&nbsp;
                <span><?php esc_html_e( 'Estimated Delivery:', 'venam' ); ?>&nbsp;</span>
                <?php echo implode( ' ', $est_days ); ?>
            </div>
            <?php
        }
    }
}



/**
* Add product rating
*/
if ( ! function_exists( 'venam_product_rating' ) ) {
    function venam_product_rating()
    {
        global $product;
        if ( wc_review_ratings_enabled() && $product->get_average_rating() ) {
            woocommerce_template_loop_rating();
        }
    }
}


/**
* Add product price
*/
if ( ! function_exists( 'venam_product_price' ) ) {
    function venam_product_price()
    {
        global $product;
        if ( $product->get_price_html() ) {
            ?>
            <div class="shop-product_price">
                <?php woocommerce_template_loop_price(); ?>
            </div>
            <?php
        }
    }
}


/**
* Add product excerpt
*/
if ( ! function_exists( 'venam_product_excerpt' ) ) {
    function venam_product_excerpt()
    {
        global $product;
        if ( $product->get_short_description() ) {
            ?>
            <p class="shop-product_excerpt"><?php echo wp_trim_words( $product->get_short_description(), apply_filters( 'venam_excerpt_limit', 20 ) ); ?></p>
            <?php
        }
    }
}


if ( ! function_exists( 'venam_product_stock' ) ) {
    add_filter( 'woocommerce_get_availability', 'venam_custom_get_availability', 1, 2);
    function venam_custom_get_availability( $availability, $_product ) {

        // Change In Stock Text
        if ( $_product->is_in_stock() ) {
            $availability['availability'] = esc_html( $_product->get_stock_quantity() ).' '.esc_html__('In Stock', 'venam');
        }
        // Change Out of Stock Text
        if ( ! $_product->is_in_stock() ) {
            $availability['availability'] = esc_html__('Out of stock', 'venam');
        }
        return $availability;
    }
}


/**
* Add stock to product
*/
if ( ! function_exists( 'venam_product_stock' ) ) {
    function venam_product_stock()
    {
        global $product;
        $stock = get_post_meta( $product->get_id(), 'venam_product_hide_stock', true );

        if ( 'yes' == $stock ) {
            return;
        }

        echo wc_get_stock_html( $product );

    }
}


/**
* Add stock to loop
*/
if ( ! function_exists( 'venam_product_nostock' ) ) {
    function venam_product_nostock()
    {
        global $product;
        $stock = get_post_meta( $product->get_id(), 'venam_product_hide_stock', true );

        if ( 'yes' == $stock ) {
            return;
        }

        if ( ! $product->get_manage_stock() || 0 == $product->get_stock_quantity() ) {
            echo '<span class="sd-meta out-of-stock">'.esc_html__('Out of stock', 'venam') .'</span>';
        }
    }
}


/**
* Add product excerpt
*/
if ( ! function_exists( 'venam_product_title' ) ) {
    function venam_product_title()
    {
        ?>
        <div class="shop-product_title">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_title(); ?></a>
        </div>
        <?php
    }
}


/**
* Add YITH Brand to product
*/
if ( ! function_exists( 'venam_wc_product_brand' ) ) {
    function venam_wc_product_brand()
    {
        global $product;
        $brands = '';
        $metaid = defined( 'YITH_WCBR' ) ? 'yith_product_brand' : 'venam_product_brands';
        $terms = get_the_terms( $product->get_id(), $metaid );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $brands = array();
            foreach ( $terms as $term ) {
                if ( $term->parent == 0 ) {
                    $brands[] = sprintf( '<span class="brands sd-meta"><a class="venam-brands" href="%s" itemprop="brand" title="%s">%s</a></span>',
                        get_term_link( $term ),
                        $term->slug,
                        $term->name
                    );
                }
            }
        }
        echo !empty( $brands ) ? implode( '', $brands ) : '';
    }
}

if ( ! function_exists( 'venam_wc_loop_category_title' ) ) {

	/**
	 * Show the subcategory title in the product loop.
	 *
	 * @param object $category Category object.
	 */
	function venam_wc_loop_category_title( $category ) {
		?>
		<h4 class="shop-category__title">
			<?php
			echo esc_html( $category->name );

			if ( $category->count > 0 ) {
				echo '<span class="cat-count">' . esc_html( $category->count ) . '</span>';
			}
			?>
		</h4>
		<?php
	}
}


/**
* product brand
*/
if ( ! function_exists( 'venam_wc_single_brand' ) ) {
    function venam_wc_single_brand()
    {
        global $product;
        $brands = '';
        $metaid = defined( 'YITH_WCBR' ) ? 'yith_product_brand' : 'venam_product_brands';
        $terms = get_the_terms( $product->get_id(), $metaid );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $brands = array();
            foreach ( $terms as $term ) {
                if ( $term->parent == 0 ) {
                    $brands[] = sprintf( '<a class="venam-brands" href="%s" itemprop="brand" title="%s">%s</a>',
                        get_term_link( $term ),
                        $term->slug,
                        $term->name
                    );
                }
            }
        }
        echo !empty( $brands ) ? '<span class="brands">'.esc_html__('Brands: ', 'venam' ) . implode( ', ', $brands ) .'</span>' : '';
    }
}

/**
 * product custom badge
 */

if ( ! function_exists( 'venam_product_badge' ) ) {

    function venam_product_top_details()
    {
        if ( '0' != venam_settings('single_shop_top_labels_visibility','1') || '0' != venam_settings('single_shop_nav_visibility','1') ) {
        ?>
        <div class="shop-product-top">
            <?php if ( '0' != venam_settings('single_shop_top_labels_visibility','1') ) { ?>
                <div class="shop-product-top-labels">
                    <?php
                    venam_product_badge();
                    venam_product_stock();
                    venam_product_discount();
                    ?>
                </div>
            <?php } ?>
            <?php
            if ( '0' != venam_settings('single_shop_nav_visibility','1') ) {
                venam_single_product_nav();
            }
            ?>
        </div>
        <?php
        }
    }
}
if ( ! function_exists( 'venam_product_badge' ) ) {

    function venam_product_badge()
    {
        global $product;
        $title = get_post_meta( $product->get_id(), 'venam_custom_badge', true );
        $badge_color = get_post_meta( $product->get_id(), 'venam_badge_color', true );
        $badge_color = $badge_color ? ' '.$badge_color.'' : '';

        if ( '' != $title ) {
            echo '<span class="sd-meta badge--'.esc_attr( $title ).'"'.$badge_color.'>'.esc_html( $title ).'</span>';
        } else {
            if ( $product->is_on_sale() ) {
                echo '<span class="sd-meta badge--def"'.$badge_color.'>'.esc_html__( 'Sale!', 'venam' ).'</span>';
            }
        }
    }
}


/**
*  add custom color field to for product badge
*/
if ( ! function_exists( 'venam_wc_product_badge_color' ) ) {

    function venam_wc_product_badge_color( $field )
    {
        global $thepostid, $post;

        $thepostid      = empty( $thepostid ) ? $post->ID : $thepostid;
        $field['class'] = isset( $field['class'] ) ? $field['class'] : 'venam-color-field';
        $field['value'] = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );

        echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>
        <input type="text" class="venam-color-field" name="' . esc_attr( $field['id'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" /></p>';
    }
}


/**
*  countdown for product
*/
if ( ! function_exists( 'venam_wc_product_countdown' ) ) {

    function venam_wc_product_countdown()
    {
        if ( '0' != venam_settings('single_shop_countdown_visibility','1') ) {
            global $product;
            $time = get_post_meta( $product->get_id(), 'venam_countdown_date', true);
            $text = get_post_meta( $product->get_id(), 'venam_countdown_text', true);

            if ( $time ) {
                wp_enqueue_script( 'jquery-countdown' );
                wp_enqueue_script( 'venam-countdown' );
                $data[] = '"date":"'.$time.'"';
                $data[] = '"day":"'.esc_html__('day', 'venam').'"';
                $data[] = '"hr":"'.esc_html__('hour', 'venam').'"';
                $data[] = '"min":"'.esc_html__('min', 'venam').'"';
                $data[] = '"sec":"'.esc_html__('sec', 'venam').'"';

                echo '<div class="viewed-offer-time">';
                    if ( $text ) {
                        echo '<p class="offer-time-text">'.$text.'</p>';
                    }
                    echo '<div class="coming-time" data-countdown=\'{'.implode(', ', $data ).'}\'></div>';
                echo '</div>';
            }
        }
    }
}


/**
*  custom tab title field for product page
*/
if ( ! function_exists( 'venam_wc_extra_tabs_title' ) ) {
    add_action( 'venam_product_extra_tabs_title', 'venam_wc_extra_tabs_title' );
    function venam_wc_extra_tabs_title()
    {
        global $product;

        $tab_title = get_post_meta( $product->get_id(), 'venam_tabs_title', true);
        $tab_content = get_post_meta( $product->get_id(), 'venam_tabs_content', true);
        $tabtitle = preg_split("/\\r\\n|\\r|\\n/", $tab_title );
        $tabcontent = preg_split("/\\r\\n|\\r|\\n/", $tab_content );

        $tabs = venam_combine_arr($tabtitle, $tabcontent);

        foreach( $tabs as $title => $content ) {
            if ( !empty( $content ) ) {
                $title = trim($title);
                $replaced_title = preg_replace('/\s+/', '_', strtolower($title));
                ?>
                <li class="nav-item <?php echo esc_attr( $replaced_title ); ?>_tab">
                    <a class="nav-link"
                    id="tab-title-<?php echo esc_attr( $replaced_title ); ?>"
                    data-toggle="tab"
                    href="#tab-<?php echo esc_attr( $replaced_title ); ?>"
                    role="tab"
                    aria-controls="tab-<?php echo esc_attr( $replaced_title ); ?>"
                    aria-selected=""><?php echo esc_html( $title ); ?></a>
                </li>
                <?php
            }
        }
    }
}


/**
*  custom tab content field for product page
*/
if ( ! function_exists( 'venam_wc_extra_tabs_content' ) ) {
    add_action( 'venam_product_extra_tabs_content', 'venam_wc_extra_tabs_content' );
    function venam_wc_extra_tabs_content()
    {
        global $product;

        $tab_title = get_post_meta( $product->get_id(), 'venam_tabs_title', true);
        $tab_content = get_post_meta( $product->get_id(), 'venam_tabs_content', true);
        $tabtitle = preg_split("/\\r\\n|\\r|\\n/", $tab_title );
        $tabcontent = preg_split("/\\r\\n|\\r|\\n/", $tab_content );

        $tabs = venam_combine_arr($tabtitle, $tabcontent);
        foreach( $tabs as $title => $content ) {
            if ( !empty( $content ) ) {
                $title = trim($title);
                $replaced_title = preg_replace('/\s+/', '_', strtolower($title));
                ?>
                <div class="tab-pane fade"
                id="tab-<?php echo esc_attr( $replaced_title ); ?>"
                role="tabpanel"
                aria-labelledby="tab-title-<?php echo esc_attr( $replaced_title ); ?>">
                    <div class="product-desc-content">
                        <?php echo do_shortcode( $content ); ?>
                    </div>
                </div>
                <?php
            }
        }
    }
}


/**
*  Add custom field to woovommerce advanced tab
*/
if ( ! function_exists( 'venam_add_field_to_products' ) ) {

    add_action( 'woocommerce_product_options_advanced', 'venam_add_field_to_products' );
    function venam_add_field_to_products()
    {
        woocommerce_wp_select(
            array(
                'id' => 'venam_gallery',
                'label' => esc_html__( 'Gallery Thumbnails Layout?', 'venam' ),
                'options' => array(
                    '' => 'Select a type',
                    'vertical' => esc_html__( 'Left', 'venam' ),
                    'bottom' => esc_html__( 'Bottom', 'venam' ),
                    'top' => esc_html__( 'Top', 'venam' ),
                ),
                'desc_tip' => false,
            )
        );
        woocommerce_wp_text_input(
            array(
                'id' => 'venam_custom_badge',
                'label' => esc_html__( 'Badge Label', 'venam' ),
                'desc_tip' => true,
                'description' => esc_html__( 'Add your custom badge label here', 'venam' ),
            )
        );
        venam_wc_product_badge_color(
            array(
                'id' => 'venam_badge_color',
                'label' => esc_html__( 'Badge Color', 'venam' ),
            )
        );
        woocommerce_wp_checkbox(
            array(
                'id' => 'venam_product_discount',
                'label' => esc_html__( 'Hide Product Discount?', 'venam' ),
                'wrapper_class' => 'hide_if_variable',
                'desc_tip' => false,
            )
        );
        woocommerce_wp_checkbox(
            array(
                'id' => 'venam_product_hide_stock',
                'label' => esc_html__( 'Hide Product Stock Label?', 'venam' ),
                'wrapper_class' => 'hide_if_variable',
                'desc_tip' => false,
            )
        );
        woocommerce_wp_text_input(
            array(
                'id' => 'venam_product_last_stock_left',
                'label' => esc_html__( 'Remaining number of products', 'venam' ),
                'desc_tip' => true,
                'description' => esc_html__( 'Enter your number here.default value for the last 5 items left', 'venam' )
            )
        );
        woocommerce_wp_select(
            array(
                'id' => 'venam_product_size_guide',
                'label' => esc_html__( 'Size Guide of product', 'venam' ),
                'options' => venam_get_elementorCategories(),
                'desc_tip' => true,
                'description' => sprintf('%s <a href="'.esc_url(admin_url('edit.php?post_type=elementor_library')).'"><b>%s</b></a> %s <a href="'.esc_url(admin_url('edit-tags.php?taxonomy=elementor_library_category&post_type=elementor_library')).'"><b>%s</b></a> %s',
                    esc_html__( 'Please create your size guide with', 'venam' ),
                    esc_html__( 'elementor template', 'venam' ),
                    esc_html__( 'and assign it to a', 'venam' ),
                    esc_html__( 'category', 'venam' ),
                    esc_html__( 'the categories you create will be listed here.', 'venam' )
                )
            )
        );
        woocommerce_wp_text_input(
            array(
                'id' => 'venam_countdown_date',
                'label' => esc_html__( 'Date for Countdown', 'venam' ),
                'desc_tip' => true,
                'description' => sprintf('%s <br/> %s%s',
                    esc_html__( 'Usage : month/day/year', 'venam' ),
                    esc_html__( 'Example : ', 'venam' ),
                    date('m/d/Y', strtotime('+1 month'))
                )
            )
        );
        woocommerce_wp_text_input(
            array(
                'id' => 'venam_countdown_text',
                'label' => esc_html__( 'Countdown Text', 'venam' ),
                'desc_tip' => true,
                'description' => esc_html__( 'Add your custom text here', 'venam' ),
            )
        );
        woocommerce_wp_text_input(
            array(
                'id' => 'venam_product_video',
                'label' => esc_html__( 'Product Popup Video URL', 'venam' ),
                'desc_tip' => true,
                'description' => esc_html__( 'Add your youtube,vimeo,hosted video URL here', 'venam' ),
            )
        );
        woocommerce_wp_textarea_input(
            array(
                'id' => 'venam_tabs_title',
                'label' => esc_html__( 'Extra Tabs Title', 'venam' ),
                'desc_tip' => true,
                'description' => esc_html__( '!Important note: One title per line.', 'venam' ),
                'rows' => 3,
            )
        );
        woocommerce_wp_textarea_input(
            array(
                'id' => 'venam_tabs_content',
                'label' => esc_html__( 'Extra Tabs Content', 'venam' ),
                'desc_tip' => true,
                'description' => esc_html__( '!Important note: One content per line.Iframe,shortcode,HTML content allowed.', 'venam' ),
                'rows' => 4,
            )
        );
    }
}


/**
*  Save Custom Field
*/
if ( ! function_exists( 'venam_save_product_custom_field' ) ) {

    add_action( 'save_post', 'venam_save_product_custom_field' );
    function venam_save_product_custom_field( $product_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
            return;
        }
        $options = array(
            'venam_gallery',
            'venam_badge_color',
            'venam_custom_badge',
            'venam_product_discount',
            'venam_product_last_stock_left',
            'venam_product_size_guide',
            'venam_product_hide_stock',
            'venam_countdown_date',
            'venam_countdown_text',
            'venam_product_video',
            'venam_tabs_title',
            'venam_tabs_content'
        );
        foreach ( $options as $option ) {
            if ( isset( $_POST[$option] ) ) {
                update_post_meta( $product_id, $option, $_POST[$option] );
            } else {
                delete_post_meta( $product_id, $option );
            }
        }
    }
}


/**
* Remove Reviews tab from tabs
*/
if ( ! function_exists( 'venam_wc_remove_product_tabs' ) ) {
    add_filter( 'woocommerce_product_tabs', 'venam_wc_remove_product_tabs', 98 );
    function venam_wc_remove_product_tabs( $tabs )
    {
        unset($tabs['reviews']);

        $tabs['description']['callback'] = 'venam_wc_custom_description_tab_content'; // Custom description callback

        return $tabs;
    }
}


/**
 * Move Reviews tab after product related
 */
if ( ! function_exists( 'venam_wc_move_product_reviews' ) ) {
    add_action( 'woocommerce_after_single_product_summary', 'venam_wc_move_product_reviews', 21 );
    function venam_wc_move_product_reviews()
    {
        comments_template();
    }
}


/**
 * Customize product data tabs
 */
if ( ! function_exists( 'venam_wc_custom_description_tab_content' ) ) {
    function venam_wc_custom_description_tab_content()
    {
        ?>
        <div class="product-desc-content">
            <h4 class="title"><?php echo apply_filters( 'venam_description_tab_title', esc_html__( 'Product Details', 'venam' ) ); ?></h4>
            <?php the_content(); ?>
        </div>
        <?php
    }
}


/**
 * woocommerce_layered_nav_term_html WIDGET
 */
if ( !function_exists( 'venam_add_span_wc_layered_nav_term_html' ) ) {
    function venam_add_span_wc_layered_nav_term_html( $links )
    {
        $links = str_replace( '</a> (', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( '</a> <span class="count">(', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( ')', '</span>', $links );

        return $links;
    }
    add_filter( 'woocommerce_layered_nav_term_html', 'venam_add_span_wc_layered_nav_term_html' );
}


/**
* Add to cart handler.
*/
if ( !function_exists( 'venam_ajax_add_to_cart_handler' ) ) {

    function venam_ajax_add_to_cart_handler()
    {
        WC_Form_Handler::add_to_cart_action();
        WC_AJAX::get_refreshed_fragments();
    }
    add_action( 'wc_ajax_venam_add_to_cart', 'venam_ajax_add_to_cart_handler' );
    add_action( 'wc_ajax_nopriv_venam_add_to_cart', 'venam_ajax_add_to_cart_handler' );

    // Remove WC Core add to cart handler to prevent double-add
    remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

    /**
    * Add fragments for notices.
    */
    function venam_ajax_add_to_cart_add_fragments( $fragments )
    {
        $all_notices  = WC()->session->get( 'wc_notices', array() );
        $notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );

        ob_start();
        foreach ( $notice_types as $notice_type ) {
            if ( wc_notice_count( $notice_type ) > 0 ) {
                wc_get_template( "notices/{$notice_type}.php", array(
                    'notices' => array_filter( $all_notices[ $notice_type ] ),
                ) );
            }
        }
        $fragments['notices_html'] = ob_get_clean();

        wc_clear_notices();

        return $fragments;
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'venam_ajax_add_to_cart_add_fragments' );
}


if ( !function_exists( 'venam_shop_loop_notices' ) ) {
    add_action('venam_before_wp_footer','venam_shop_loop_notices', 15 );
    function venam_shop_loop_notices()
    {
        if ( is_checkout() ) {
            return;
        }

        ?>
        <div class="venam-popup-notices">
            <?php woocommerce_output_all_notices(); ?>
            <div class="venam-popup-notices-footer"></div>
        </div>
        <?php
    }
}


/**
* Cart Button with Quantity Box
*/
if ( !function_exists( 'venam_cart_with_quantity' ) ) {
    function venam_cart_with_quantity()
    {

        global $product;

        if ( 'simple' == $product->get_type() ) {
            $id  = $product->get_id();
            $max = $product->backorders_allowed() ? '' : $product->get_stock_quantity();
            $qty = '';

            if ( isset( WC()->cart ) ) {
                foreach( WC()->cart->get_cart() as $cart_item ) {
                    if ( $cart_item['product_id'] === $id ){
                        $qty = $cart_item['quantity'];
                    }
                }
            }

            $class  = $qty ? ' product-in-cart' : '';
            $class .= $max && ( $max == $qty ) ? ' has-max-quntity quntity-open' : '';
            $qty = $qty ? $qty : 0;
            ?>
            <div class="product-button-group cart-with-quantity<?php echo esc_attr( $class ); ?>" data-product_id="<?php echo esc_attr($id ); ?>">
                <div class="quantity ajax-quantity">
                    <div class="quantity-button minus">-</div>
                    <?php if ( $max ) { ?>
                        <span class="venam-quantity-input-max"><?php echo esc_html_e( 'Max '.$max ) ?></span>
                    <?php } ?>
                    <input type="text" class="input-text qty text"
                    name="quantity" step="1"
                    min="0"
                    max="<?php echo esc_attr( $max ) ?>"
                    value="<?php echo esc_attr( $qty ); ?>"
                    title="Qty"
                    size="4"
                    inputmode="numeric">
                    <div class="quantity-button plus">+</div>
                    <svg class="loader-svg-image"
                    width="65px"
                    height="65px"
                    viewBox="0 0 66 66"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle
                    class="path"
                    fill="none"
                    stroke-width="6"
                    stroke-linecap="round"
                    cx="33"
                    cy="33"
                    r="30"></circle></svg>
                </div>
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
            <?php
        } else {
            woocommerce_template_loop_add_to_cart();
        }
    }
}


/**
* quantity callback
*/
if ( !function_exists( 'venam_quantity_button_callback' ) ) {

    add_action( 'wp_ajax_nopriv_quantity_button', 'venam_quantity_button_callback' );
    add_action( 'wp_ajax_quantity_button', 'venam_quantity_button_callback' );

    function venam_quantity_button_callback()
    {
        if ( 'quantity' == venam_settings('shop_loop_cart_type', 'default') ) {
            $id       = intval( $_POST['id'] );
            $quantity = intval( $_POST['quantity'] );
            $product  = isset( $_POST['id'] ) ? wc_get_product( absint( $_POST['id'] ) ) : false;

            $specific_ids = array($id);
            $new_qty      = $quantity; // New quantity

            foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $product_id = $cart_item['data']->get_id();
                // Check for specific product IDs and change quantity
                if( in_array( $product_id, $specific_ids ) && $cart_item['quantity'] != $new_qty ) {
                    WC()->cart->set_quantity( $cart_item_key, $new_qty ); // Change quantity
                }
            }

            if ( $product ) {
                ?>
                <div id="message-<?php echo esc_attr( $id ); ?>" class="woocommerce-message ninetheme-cart-update-message" role="alert" data-delay="3500">
                    <p><?php esc_html_e('Cart Updated','venam'); ?></p>
                    <?php echo esc_attr( $quantity ).' &times; ' . esc_html( $product->get_title() ); ?>
                </div>
                <?php
            }
            wp_die();
        }
    }
}

/**
* Add category banner if shortcode exists
*/
if ( !function_exists( 'venam_print_category_banner' ) ) {
    add_action( 'venam_before_loop_start', 'venam_print_category_banner', 10 );
    function venam_print_category_banner()
    {
        $banner = get_term_meta( get_queried_object_id(), 'venam_wc_cat_banner', true );

        if ( $banner && ( is_product_category() || is_product_tag() ) ) {
            $atts = shortcode_parse_atts( $banner );
            $shortcode = '[venam-template id="'.$atts['id'].'" css="true"]';
            $banner = do_shortcode( $shortcode );
            printf( '<div class="shop-cat-banner">%1$s</div>', $banner );
        } else {
            echo venam_print_elementor_templates( 'shop_before_loop_templates', 'wc--row row-off before-shop--loop', true );
        }
    }
}


add_action('product_cat_add_form_fields', 'venam_wc_taxonomy_add_new_meta_field', 10, 1);
//Product Cat Create page
function venam_wc_taxonomy_add_new_meta_field() {
    woocommerce_wp_textarea_input(
        array(
            'id' => 'venam_wc_cat_banner',
            'label' => esc_html__( 'Category Banner ', 'venam' ),
            'description' => esc_html__( 'If you want to show a different banner on the archive category page for this category, use this field.Iframe,shortcode,HTML content allowed.', 'venam' ),
            'rows' => 4
        )
    );
}

add_action('product_cat_edit_form_fields', 'venam_wc_taxonomy_edit_meta_field', 10, 1);
//Product Cat Edit page
function venam_wc_taxonomy_edit_meta_field($term) {

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field.
    $venam_wc_cat_banner = get_term_meta($term_id, 'venam_wc_cat_banner', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="venam_wc_cat_banner"><?php esc_html_e('Banner', 'venam'); ?></label></th>
        <td>
            <textarea name="venam_wc_cat_banner" id="venam_wc_cat_banner" rows="5" cols="50" class="large-text"><?php echo esc_html($venam_wc_cat_banner) ? $venam_wc_cat_banner : ''; ?></textarea>
            <p class="description"><?php esc_html_e('If you want to show a different banner on the archive category page for this category, use this field.Iframe,shortcode,HTML content allowed.', 'venam'); ?></p>
        </td>
    </tr>
    <?php
}

add_action('edited_product_cat', 'venam_wc_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'venam_wc_save_taxonomy_custom_meta', 10, 1);
// Save extra taxonomy fields callback function.
function venam_wc_save_taxonomy_custom_meta($term_id) {

    $venam_wc_cat_banner = filter_input(INPUT_POST, 'venam_wc_cat_banner');
    update_term_meta($term_id, 'venam_wc_cat_banner', $venam_wc_cat_banner);
}

//Displaying Additional Columns
add_filter( 'manage_edit-product_cat_columns', 'venam_wc_customFieldsListTitle' ); //Register Function

function venam_wc_customFieldsListTitle( $columns ) {
    $columns['venam_cat_banner'] = esc_html__( 'Banner', 'venam' );
    return $columns;
}

add_action( 'manage_product_cat_custom_column', 'venam_wc_customFieldsListDisplay' , 10, 3); //Populating the Columns
function venam_wc_customFieldsListDisplay( $columns, $column, $id ) {
    if ( 'venam_cat_banner' == $column ) {
        $columns = get_term_meta($id, 'venam_wc_cat_banner', true);
        $columns = $columns ? '<span class="wc-banner"></span>' : '';
    }
    return $columns;
}

if ( ! function_exists( 'venam_wc_per_page_select' ) ) {
    function venam_wc_per_page_select()
    {
        if ( ! wc_get_loop_prop( 'is_paginated' ) && '1' != venam_settings( 'per_page_select_visibility' ) ) {
            return;
        }

        $numbers = venam_settings( 'per_page_select_options' );
        $per_page_opt = ( ! empty( $numbers ) ) ? explode( ',', $numbers ) : array( 9, 12, 24, 36 );

        ?>
        <div class="venam-wc-per-page d-none d-lg-flex">
            <span class="per-page-title"><?php esc_html_e( 'Show', 'venam' ); ?></span>
            <ul class="top-action">
                <?php foreach ( $per_page_opt as $key => $value ) {

                    $link = add_query_arg( 'per_page', $value );

                    $classes = isset( $_GET['per_page'] ) && $_GET['per_page'] === $value ? 'active-number' : '';
                    $val = $value == -1 ? esc_html__( 'All', 'venam' ) : $value;
                    ?>
                    <li class="<?php echo esc_attr( $classes ); ?>">
                        <a rel="nofollow noopener" href="<?php echo esc_url( $link ); ?>"><?php esc_html( printf( '%s', $val ) ); ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php
    }
}

if ( ! function_exists( 'venam_wc_column_select' ) ) {
    function venam_wc_column_select()
    {
        if ( ! wc_get_loop_prop( 'is_paginated' ) && '1' != venam_settings( 'column_select_visibility' ) ) {
            return;
        }
        if ( !venam_get_shop_column() && '2' == venam_settings( 'shop_product_type', '1' ) ) {
            $col = 1;
        } elseif ( intval(venam_get_shop_column()) > 1 ) {
            $col = intval(venam_get_shop_column());
        } else {
            $col = isset( $_GET['column'] ) && $_GET['column'] ? intval( $_GET['column'] ) : intval( venam_settings( 'shop_colxl' ) );
        }

        $active = '';
        $cols = array( 1, 2, 3, 4 );

        ?>
        <ul class="top-action d-none d-lg-flex">
            <?php
            do_action ( 'venam_before_column_action' );
            foreach ( $cols as $key => $value ) {

                if ( ( $col < 5 ) && ( $col === $value ) ) {
                    $active = 'active';
                }
                ?>
                <li class="<?php echo esc_attr( $active.' val-'.$col ); ?>">
                    <a href="<?php echo esc_url( add_query_arg( 'column', $value ) ); ?>"><?php echo venam_svg_lists('column-'.$value);?></a>
                </li>
                <?php
                $active = '';
            }
            do_action ( 'venam_after_column_action' );
            ?>
        </ul>
        <?php
    }
}
