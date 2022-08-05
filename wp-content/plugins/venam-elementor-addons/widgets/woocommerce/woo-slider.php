<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Woo_Slider extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-woo-slider';
    }
    public function get_title() {
        return 'WC Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'venam-woo' ];
    }
    public function get_script_depends() {
        return [ 'slick', 'jquery-countdown' ];
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
                    '' => esc_html__( 'Newest', 'venam' ),
                    'featured' => esc_html__( 'Featured', 'venam' ),
                    'on-sale' => esc_html__( 'On Sale', 'venam' ),
                    'best' => esc_html__( 'Best Selling', 'venam' ),
                    'custom' => esc_html__( 'Specific Categories', 'venam' ),
                ],
                'default' => ''
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
                'label' => esc_html__( 'Category Filter', 'venam' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'category_include',
            [
                'label' => esc_html__( 'Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude',
            ]
        );
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'Post Filter', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'post_include',
            [
                'label' => esc_html__( 'Specific Post(s)', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Specific Post(s)',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_exclude',
            [
                'label' => esc_html__( 'Exclude Post', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Post(s) to Exclude',
                'separator' => 'after',
            ]
        );
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'venam' ),
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'venam-square',
            ]
        );
        $this->add_control( 'rating',
            [
                'label' => esc_html__( 'Product Rating', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
				'separator' => 'before'
            ]
        );
        $this->add_control( 'price_before',
            [
                'label' => esc_html__( 'Price Before', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'US'
            ]
        );
        $this->add_control( 'hidesave',
            [
                'label' => esc_html__( 'Hide Save Price', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'save_after',
            [
                'label' => esc_html__( 'Save Price After', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'off',
                'condition' => [ 'hidesave!' => 'yes' ]
            ]
        );
        $this->add_control( 'hidetimer',
            [
                'label' => esc_html__( 'Hide Timer', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hide_progresbar',
            [
                'label' => esc_html__( 'Hide Progressbar', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'timer_text',
            [
                'label' => esc_html__( 'Timer Text', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Label Day', 'venam' ),
                'default' => '<span>Hurry Up</span> Limited Time Offer',
                'condition' => [ 'hidetimer!' => 'yes' ]
            ]
        );
        $this->add_control( 'day',
            [
                'label' => esc_html__( 'Day', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Day', 'venam' ),
                'default' => 'Day',
                'condition' => [ 'hidetimer!' => 'yes' ]
            ]
        );
        $this->add_control( 'hour',
            [
                'label' => esc_html__( 'Hour', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Hour', 'venam' ),
                'default' => 'Hr',
                'condition' => [ 'hidetimer!' => 'yes' ]
            ]
        );
        $this->add_control( 'minute',
            [
                'label' => esc_html__( 'Minute', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Minutes', 'venam' ),
                'default' => 'Min',
                'condition' => [ 'hidetimer!' => 'yes' ]
            ]
        );
        $this->add_control( 'second',
            [
                'label' => esc_html__( 'Second', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Second', 'venam' ),
                'default' => 'Sec',
                'condition' => [ 'hidetimer!' => 'yes' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_options_section',
            [
                'label'=> esc_html__( 'SLIDER OPTIONS', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Infinite', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'arrows',
            [
                'label' => esc_html__( 'Arrows', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 10000,
                'step' => 100,
                'default' => 1000
            ]
        );
        $this->add_control( 'items',
            [
                'label' => esc_html__( 'Items', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 4
            ]
        );
        $this->add_control( 'mditems',
            [
                'label' => esc_html__( 'Items', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
            ]
        );
        $this->add_control( 'smitems',
            [
                'label' => esc_html__( 'Items Tablet', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 3,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control( 'xsitems',
            [
                'label' => esc_html__( 'Items Phone', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 2,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control( 'mdarrows',
            [
                'label' => esc_html__( 'Arrows Desktop', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'smarrows',
            [
                'label' => esc_html__( 'Arrows Tablet', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'xsarrows',
            [
                'label' => esc_html__( 'Arrows Phone', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'mddots',
            [
                'label' => esc_html__( 'Dots Desktop', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'smdots',
            [
                'label' => esc_html__( 'Dots Tablet', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'xsdots',
            [
                'label' => esc_html__( 'Dots Phone', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('style_section',
            [
                'label' => esc_html__( 'STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'post_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .most-popular-viewed-item' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .most-popular-viewed-item',
            ]
        );
        $this->add_responsive_control( 'post_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .most-popular-viewed-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
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
                'selector' => '{{WRAPPER}} .super-deal-content .title',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .super-deal-content .title a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .super-deal-content .title a:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'price_heading',
            [
                'label' => esc_html__( 'PRICE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'price_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .super-deal-content p' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'save_color',
            [
                'label' => esc_html__( 'Save Price Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .super-deal-content p span' => 'color: {{VALUE}};',
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
        $this->add_control( 'sold_color',
            [
                'label' => esc_html__( 'Total Stock Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .viewed-item-bottom ul li' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'bar_color',
            [
                'label' => esc_html__( 'Progressbar Bg Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .viewed-item-bottom .progress' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'bar_bgcolor',
            [
                'label' => esc_html__( 'Progressbar Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .viewed-item-bottom .progress-bar' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'timer_heading',
            [
                'label' => esc_html__( 'TIMER', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'timer_typo',
                'label' => esc_html__( 'Title Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .viewed-offer-time p',
            ]
        );
        $this->add_control( 'timer_color',
            [
                'label' => esc_html__( 'Title Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .viewed-offer-time p' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'timer_color2',
            [
                'label' => esc_html__( 'Title Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .viewed-offer-time p span' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'timer_bgcolor',
            [
                'label' => esc_html__( 'Timer Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .viewed-offer-time .coming-time .time-count' => 'border-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'timer_bgcolor2',
            [
                'label' => esc_html__( 'Timer Second Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .viewed-offer-time .coming-time .time-count.sec' => 'border-color: {{VALUE}};' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_nav_style_section',
            [
                'label'=> esc_html__( 'ARROWS STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'arrows' => 'yes' ]
            ]
        );
        $this->add_control( 'slider_nav_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-arrow' => 'width: {{SIZE}}px;height: {{SIZE}}px;' ]
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
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-arrow' => 'font-size: {{SIZE}}px;' ]
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
               'selectors' => ['{{WRAPPER}} .popular-active .slick-arrow' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_clr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .popular-active .slick-arrow i' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .popular-active .slick-arrow',
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
               'selectors' => ['{{WRAPPER}} .popular-active .slick-arrow:hover' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_hvrclr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .popular-active .slick-arrow:hover i' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvr_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .popular-active .slick-arrow:hover',
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
                'label' => esc_html__( 'Horizontal Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-prev' => 'position: absolute;left:{{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_responsive_control( 'prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-prev' => 'position: absolute;top:{{SIZE}}{{UNIT}};' ],
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
                'label' => esc_html__( 'Horizontal Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-next' => 'position: absolute;right:{{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_responsive_control( 'next_vertical',
            [
                'label' => esc_html__( 'Vertical Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-next' => 'position: absolute;top:{{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_control( 'dots_heading',
            [
                'label' => esc_html__( 'DOTS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'dots_top_space',
            [
                'label' => esc_html__( 'Dots Top Offset', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-slick__slider .slick-dots' => 'margin-top: {{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'dots_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-slick__slider .slick-dots li button' => 'width: {{SIZE}}px;height: {{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'dots_clr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .thm-slick__slider .slick-dots li button' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'dots_hvrclr',
           [
               'label' => esc_html__( 'Active Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .thm-slick__slider .slick-dots li button:hover,{{WRAPPER}} .thm-slick__slider .slick-dots li.slick-active button' => 'background-color: {{VALUE}};']
           ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $settings['post_per_page'],
            'post__in' => $settings['post_include'],
            'post__not_in' => $settings['post_exclude'],
            'order' => $settings['order']
        );

        if ( 'featured' == $settings['scenario'] ) {
           $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                )
            );

        } elseif('on-sale' == $settings['scenario']) {

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

        } elseif('best' == $settings['scenario']) {

            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';

        } else {

            $args['orderby'] = $settings['orderby'];

        }

        if ( $settings['category_include'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $settings['category_include'],
                    'operator' => 'IN'
                )
            );
        }
        if ( $settings['category_exclude'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $settings['category_exclude'],
                    'operator' => 'NOT IN'
                )
            );
        }

        $day  = $settings['day'] ? $settings['day'] : esc_html__( 'Day', 'venam' );
        $hr   = $settings['hour'] ? $settings['hour'] : esc_html__( 'Hr', 'venam' );
        $min  = $settings['minute'] ? $settings['minute'] : esc_html__( 'Min', 'venam' );
        $sec  = $settings['second'] ? $settings['second'] : esc_html__( 'Sec', 'venam' );

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }

        $rtl = is_rtl() ? 'true' : 'false';
        $loop = 'yes' == $settings['loop'] ? 'true': 'false';
        $autoplay = 'yes' == $settings['autoplay'] ? 'true': 'false';
        $arrows = 'yes' == $settings['arrows'] ? '"arrows": true,"prevArrow":"<button type=\"button\" class=\"slick-prev\"><i class=\"fas fa-angle-left\"></i></button>","nextArrow":"<button type=\"button\" class=\"slick-next\"><i class=\"fas fa-angle-right\"></i></button>"' : '"arrows": false';
        $mdarrows = 'yes' == $settings['mdarrows'] ? 'true': 'false';
        $mddots = 'yes' == $settings['mddots'] ? 'true': 'false';
        $smarrows = 'yes' == $settings['smarrows'] ? 'true': 'false';
        $smdots = 'yes' == $settings['smdots'] ? 'true': 'false';
        $xsarrows = 'yes' == $settings['smarrows'] ? 'true': 'false';
        $xsdots = 'yes' == $settings['xsdots'] ? 'true': 'false';

        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<div class="row popular-active thm-slick__slider" data-slick=\'{"rtl":'.$rtl.',"autoplay":'.$autoplay.',"infinite": '.$loop.',"speed": '.$settings['speed'].',"slidesToShow": '.$settings['items'].',"slidesToScroll": 1,"adaptiveHeight": true,'.$arrows.',"responsive": [{"breakpoint": 1025,"settings": {"slidesToShow": '.$settings['mditems'].',"slidesToScroll": 1,"dots": '.$mddots.',"arrows": '.$mdarrows.'}},{"breakpoint": 790,"settings": {"slidesToShow": '.$settings['smitems'].',"slidesToScroll": 1,"dots": '.$smdots.',"arrows": '.$smarrows.'}},{"breakpoint": 576,"settings": {"slidesToShow": '.$settings['xsitems'].',"slidesToScroll": 1,"dots": '.$xsdots.',"arrows": '.$xsarrows.'}}]}\'>';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                global $product;
                $saving = '';
                if ( 'yes' != $settings['hidesave'] && $product->is_on_sale() && ! $product->is_type('variable') ) {
                    $regular = (float) $product->get_regular_price();
                    $sale = (float) $product->get_sale_price();
                    $saving = $regular && $sale ? round( 100 - ( $sale / $regular * 100 ), 1 ) . '%' : '';
                    $saving = $saving ? '<span class="save--price">{ '.$saving.' '.$settings['save_after'].' }</span>' : '';
                }

                $price_before = $settings['price_before'] ? $settings['price_before'].' ' : '';
                $sold = $product->get_total_sales() ? $product->get_total_sales() : 0;
                $stock = $product->get_stock_quantity();

                $value = $stock && $sold ? round( 100 / $stock, 3 ) : 0;
                $date = get_post_meta( get_the_ID(), 'venam_countdown_date', true );

                echo '<div class="col-xl-3">';
                    echo '<div class="most-popular-viewed-item woocommerce">';
                        echo '<div class="viewed-item-top">';
                            echo '<div class="most--popular--item--thumb mb-25">';
                                echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail( get_the_ID(), $size ).'</a>';
                                venam_product_badge();
                                do_action( 'venam_loop_product_buttons' );
                            echo '</div>';
                            echo '<div class="super-deal-content">';
                                if ( 'yes' == $settings['rating'] ) {
                                    if ( wc_review_ratings_enabled() && $product->get_average_rating() ) {
                                        echo '<div class="rating">';
                                        woocommerce_template_loop_rating();
                                        echo '</div>';
                                    } else {
                                        echo '<div class="rating rating-empty">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        </div>';
                                    }
                                }
                                echo '<h6 class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></h6>';
                                $price_html = '<p>'.$price_before.wc_price($product->get_price()).$saving.'</p>';
                                echo apply_filters('venam_widget_product_price', $price_html);
                            echo '</div>';
                            echo do_action( 'venam_loop_after_product_content' );
                        echo '</div>';
                        if ( 'yes' != $settings['hide_progresbar'] || 'yes' != $settings['hidetimer'] ) {
                            if ($sold || $stock || $value || $date ) {
                                echo '<div class="viewed-item-bottom">';
                                    if ( 'yes' != $settings['hide_progresbar'] && $stock ) {
                                        echo '<ul>';
                                            echo '<li>Total Sold : '.$sold.'</li>';
                                            if ( $stock ) {
                                                echo '<li>Stocks : '.$stock.'</li>';
                                            }
                                        echo '</ul>';
                                        echo '<div class="progress">';
                                            echo '<div class="progress-bar" role="progressbar" style="width: '.$value.'%;" aria-valuenow="'.$stock.'" aria-valuemin="0" aria-valuemax="100"></div>';
                                        echo '</div>';
                                    }
                                    if ( 'yes' != $settings['hidetimer'] && $date ) {
                                        echo '<div class="viewed-offer-time">';
                                            if ( $settings['timer_text'] ) {
                                                echo '<p>'.$settings['timer_text'].'</p>';
                                            }
                                            echo '<div class="coming-time" data-countdown=\'{"date": "'.$date.'","day":"'.$day.'","hr":"'.$hr.'","min":"'.$min.'","sec":"'.$sec.'"}\'></div>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            }
                        }
                    echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        wp_reset_postdata();
    }
}
