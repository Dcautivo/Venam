<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Woo_Mini_Slider extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-woo-mini-slider';
    }
    public function get_title() {
        return 'WC Mini Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'venam-woo' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_query_section',
            [
                'label' => esc_html__( 'Query', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'scenario',
            [
                'label' => esc_html__( 'Select Scenario', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'newest' => esc_html__( 'Newest', 'venam' ),
                    'featured' => esc_html__( 'Featured', 'venam' ),
                    'on-sale' => esc_html__( 'On Sale', 'venam' ),
                    'best' => esc_html__( 'Best Selling', 'venam' ),
                    'custom' => esc_html__( 'Specific Categories', 'venam' ),
                ],
                'default' => 'newest'
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 20
            ]
        );
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'CATEGORY FILTER', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'category_filter_type',
            [
                'label' => esc_html__( 'Category Filter Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'IN' => esc_html__( 'Include', 'venam' ),
                    'NOT IN' => esc_html__( 'Exclude', 'venam' ),
                ],
                'default' => 'IN',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'category_filter',
            [
                'label' => esc_html__( 'Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'POST FILTER', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_filter_type',
            [
                'label' => esc_html__( 'Post Filter Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'post__in' => esc_html__( 'Include', 'venam' ),
                    'post__not_in' => esc_html__( 'Exclude', 'venam' ),
                ],
                'default' => 'post__in',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_filter',
            [
                'label' => esc_html__( 'Specific Post(s)', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Specific Post(s)',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'OTHER FILTER', 'venam' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'venam' ),
                    'DESC' => esc_html__( 'Descending', 'venam' )
                ],
                'default' => 'DESC'
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'venam' ),
                    'menu_order' => esc_html__( 'Menu Order', 'venam' ),
                    'rand' => esc_html__( 'Random', 'venam' ),
                    'date' => esc_html__( 'Date', 'venam' ),
                    'title' => esc_html__( 'Title', 'venam' ),
                ],
                'default' => 'id',
            ]
        );
        $this->add_control( 'hidesale',
            [
                'label' => esc_html__( 'Hide Sale Flash', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_settings_section',
            [
                'label' => esc_html__( 'Slider Options', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'percolumn',
            [
                'label' => esc_html__( 'Per Column', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'venam' ),
                    '1' => esc_html__( '1 Item', 'venam' ),
                    '2' => esc_html__( '2 Items', 'venam' ),
                    '3' => esc_html__( '3 Items', 'venam' ),
                    '4' => esc_html__( '4 Items', 'venam' ),
                ],
                'default' => ''
            ]
        );
        $this->add_control( 'perview',
            [
                'label' => esc_html__( 'Per View ( Desktop )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 4,
                'step' => 1,
                'default' => 1,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'mdperview',
            [
                'label' => esc_html__( 'Per View ( Tablet )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 4,
                'step' => 1,
                'default' => 1
            ]
        );
        $this->add_control( 'smperview',
            [
                'label' => esc_html__( 'Per View  ( Mobile )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 4,
                'step' => 1,
                'default' => 1
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 1000,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [ 'percolumn' => '' ]
            ]
        );
        $this->add_control( 'navs',
            [
                'label' => esc_html__( 'Nav', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'space',
            [
                'label' => esc_html__( 'Space Between Items', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('product_post_style_section',
            [
                'label' => esc_html__( 'Post Style', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'valignment',
            [
                'label' => esc_html__( 'Content Vertical Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .row' => 'align-items:{{VALUE}};'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'venam' ),
                        'icon' => 'eicon-v-align-top'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'venam' ),
                        'icon' => 'eicon-v-align-middle'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'venam' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'default' => 'flex-start',
                'toggle' => true
            ]
        );
        $this->add_control( 'post_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid',
            ]
        );
        $this->add_responsive_control( 'post_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'post_hvrbordercolor',
            [
                'label' => esc_html__( 'Hover Border Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid:hover' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_title a',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_title a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_title a:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'stars_heading',
            [
                'label' => esc_html__( 'STARS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'stars_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .star-rating' => 'font-size: {{SIZE}}px;height: {{SIZE}}px;',
                    '{{WRAPPER}} .woocommerce .shop-product_grid .star-rating span' => 'padding-top: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_control( 'price_heading',
            [
                'label' => esc_html__( 'PRICE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_price span.price',
            ]
        );
        $this->add_control( 'price_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_price span.price' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'sale_price_color',
            [
                'label' => esc_html__( 'Sale Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce div.product span.price ins' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'attr_heading',
            [
                'label' => esc_html__( 'ATTRIBUTE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'attr_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid .product-attr_label,{{WRAPPER}} .woocommerce .shop-product_grid .product-save_label',
            ]
        );
        $this->add_control( 'attr_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .product-attr_label,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product-save_label' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'attr_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .product-attr_label,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product-save_label' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control( 'attr_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .product-attr_label,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product-save_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_control( 'flash_heading',
            [
                'label' => esc_html__( 'FLASH SALE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flash_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale, {{WRAPPER}} .woocommerce .shop-product_badge',
            ]
        );
        $this->add_control( 'flash_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale,
                    {{WRAPPER}} .woocommerce .shop-product_badge' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'flash_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_badge' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_badge::after' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'flash_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid:hover .shop-product_badge::after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid:hover .shop-product_badge' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control( 'flash_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale,
                    {{WRAPPER}} .woocommerce .shop-product_grid .shop-product_badge::after,
                    {{WRAPPER}} .woocommerce .shop-product_badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('buttons_style_section',
            [
                'label' => esc_html__( 'Button Style', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'btn_tabs');
        $this->start_controls_tab( 'btn_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button),
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist,
                    {{WRAPPER}} .woocommerce .shop-product_grid .venam-btn-quick-view,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'btn_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button),
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist,
                    {{WRAPPER}} .woocommerce .shop-product_grid .venam-btn-quick-view,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button),
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist,
                    {{WRAPPER}} .woocommerce .shop-product_grid .venam-btn-quick-view,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button'
                ]
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button),
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist,
                    {{WRAPPER}} .woocommerce .shop-product_grid .venam-btn-quick-view,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'btn_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button):hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .venam-btn-quick-view:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'btn_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button):hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .venam-btn-quick-view:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvrborder',
                'label' => esc_html__( 'Border', 'venam' ),
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button):hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .venam-btn-quick-view:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover'
                ]
            ]
        );
        $this->add_responsive_control( 'btn_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button):hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .venam-btn-quick-view:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'navs' => 'yes' ]
            ]
        );
        $this->add_control( 'slider_nav_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-next,
                    {{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-prev' => 'width: {{SIZE}}px;height: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_control( 'slider_nav_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-next,
                    {{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-prev' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );
        $this->start_controls_tabs( 'slider_nav_tabs');
        $this->start_controls_tab( 'slider_nav_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'nav_bgclr',
           [
               'label' => esc_html__( 'Background Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .swiper-button-next,
               {{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_clr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .swiper-button-next,
               {{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .swiper-button-next,{{WRAPPER}} .swiper-button-prev',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'nav_hvrbgclr',
           [
               'label' => esc_html__( 'Background Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .swiper-button-next:hover,
               {{WRAPPER}} .swiper-button-prev:hover' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_hvrclr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .swiper-button-next:hover,
               {{WRAPPER}} .swiper-button-prev:hover' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvr_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'prev_heading',
            [
                'label' => esc_html__( 'PREV POSITION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .swiper-button-prev' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .swiper-button-prev' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'next_heading',
            [
                'label' => esc_html__( 'NEXT POSITION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .swiper-button-next' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'next_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .swiper-button-next' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    public function product_type() {
        $settings = $this->get_settings_for_display();
        return 3;
    }
    protected function render() {
        //global $wp_query;
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $speed     = $settings['speed'] ? $settings['speed'] : 1000;
        $percolumn = $settings['percolumn'] ? $settings['percolumn'] : 1;
        $perview   = $settings['perview'] ? $settings['perview'] : 3;
        $mdperview = $settings['mdperview'] ? $settings['mdperview'] : 3;
        $smperview = $settings['smperview'] ? $settings['smperview'] : 2;
        $space     = $settings['space'] ? $settings['space'] : 15;
        $autoplay  = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $loop      = '' == $settings['percolumn'] && 'yes' == $settings['loop'] ? 'true' : 'false';

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $settings['post_per_page'],
            'order' => $settings['order']
        );
        if ( 'custom' == $settings['scenario'] ) {
            $args[ $settings['post_filter_type'] ] = $settings['post_filter'];
        }

        if ( 'featured' == $settings['scenario'] ) {
           $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                )
            );

        } elseif ( 'on-sale' == $settings['scenario'] ) {

            $args['meta_query'] = array(
                'relation' => 'OR',
                array( // Simple products type
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                ),
                array( // Variable products type
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                )
            );

        } elseif ( 'best' == $settings['scenario'] ) {

            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';

        } else {

            $args['orderby'] = $settings['orderby'];

        }
        if ( $settings['category_filter'] && 'custom' == $settings['scenario'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $settings['category_filter'],
                    'operator' => $settings['category_filter_type']
                )
            );
        }

        add_filter( 'venam_product_type', [ $this, 'product_type' ] );
        add_filter( 'venam_hide_column', '__return_false' );
        remove_action('woocommerce_before_shop_loop_item_title', 'venam_wc_product_countdown');
        if ( 'yes' == $settings['hidesale'] ) {
            remove_action( 'woocommerce_before_shop_loop_item_title', 'venam_product_badge', 10 );
        }

        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<div class="thm-wc-slider__wrapper woocommerce wc_mini--slider">';
                echo '<div class="thm-swiper__slider swiper-container" data-swiper-options=\'{"slidesPerView": 1,"slidesPerGroup":'.$perview.',"slidesPerColumnFill":"row","slidesPerColumn": '.$percolumn.',"spaceBetween": '.$space.',"speed": '.$speed.',"loop": '.$loop.',"autoplay": '.$autoplay.',"navigation": {"nextEl": ".slide-prev-'.$id.'","prevEl": ".slide-next-'.$id.'"},"breakpoints": {"0": {"spaceBetween": 0,"slidesPerView": '.$smperview.'},"768": {"slidesPerView": '.$mdperview.'},"1024": {"slidesPerView": '.$perview.'}}}\'>';
                    echo '<div class="swiper-wrapper">';
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            echo '<div class="swiper-slide">';
                                wc_get_template_part( 'content', 'product' );
                            echo '</div>';
                        }
                    echo '</div>';

                if ( 'yes' == $settings['navs'] ) {
                    echo '<div class="swiper-button-prev slide-prev-'.$id.'"><i class="venam-icon-left-arrow"></i></div>';
                    echo '<div class="swiper-button-next slide-next-'.$id.'"><i class="venam-icon-right-arrow"></i></div>';
                }

                echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();

        remove_filter( 'venam_product_type', [ $this, 'product_type' ] );
        remove_filter( 'venam_hide_column', '__return_false' );
        add_action('woocommerce_before_shop_loop_item_title', 'venam_wc_product_countdown');

        if ( 'yes' == $settings['hidesale'] ) {
            add_action( 'woocommerce_before_shop_loop_item_title', 'venam_product_badge', 10 );
        }
    }
}
