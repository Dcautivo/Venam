<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Home_Slider extends Widget_Base {

    public function get_name() {
        return 'venam-home-slider';
    }
    public function get_title() {
        return 'Home Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    public function get_style_depends() {
        return [ 'slick', 'slick-theme' ];
    }
    public function get_script_depends() {
        return [ 'slick' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_content_section',
            [
                'label' => esc_html__( 'Content', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'slider_style',
            [
                'label' => esc_html__( 'Slider Style', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slider-area',
                'options' => [
                    'slider-area' => esc_html__( 'Home 1', 'venam' ),
                    'second-slider-area' => esc_html__( 'Home 2', 'venam' ),
                    'third-slider-area' => esc_html__( 'Home 2', 'venam' ),
                ]
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'bg1_heading',
            [
                'label' => esc_html__( 'BACKGROUND', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slider-bg',
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'image1_heading',
            [
                'label' => esc_html__( 'IMAGE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'venam-square'
            ]
        );
        $repeater->add_control( 'img_anim',
            [
                'label' => esc_html__( 'Animation', 'plugin-domain' ),
                'type' => Controls_Manager::ANIMATION,
            ]
        );
        $repeater->add_control( 'img_delay',
            [
                'label' => esc_html__( 'Animation Delay ( s )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 0.1,
                'default' => 1
            ]
        );
        $repeater->add_control( 'subtitle1_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter subtitle here', 'venam' )
            ]
        );
        $repeater->add_control( 'stag',
            [
                'label' => esc_html__( 'Subtitle Tag', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h5',
                'options' => [
                    'h1' => esc_html__( 'H1', 'venam' ),
                    'h2' => esc_html__( 'H2', 'venam' ),
                    'h3' => esc_html__( 'H3', 'venam' ),
                    'h4' => esc_html__( 'H4', 'venam' ),
                    'h5' => esc_html__( 'H5', 'venam' ),
                    'h6' => esc_html__( 'H6', 'venam' ),
                    'div' => esc_html__( 'div', 'venam' ),
                    'p' => esc_html__( 'p', 'venam' ),
                ],
                'condition' => ['title!' => '']
            ]
        );
        $repeater->add_control( 'st_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-slick__slider {{CURRENT_ITEM}} .slider-content .tagline' => 'color:{{VALUE}};' ],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'st_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .thm-slick__slider {{CURRENT_ITEM}} .slider-content .tagline'
            ]
        );
        $repeater->add_control( 'st_anim',
            [
                'label' => esc_html__( 'Animation', 'plugin-domain' ),
                'type' => Controls_Manager::ANIMATION,
            ]
        );
        $repeater->add_control( 'st_delay',
            [
                'label' => esc_html__( 'Animation Delay ( s )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 0.1,
                'default' => 1
            ]
        );
        $repeater->add_control( 'title1_heading',
            [
                'label' => esc_html__( 'TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Slider Title',
                'pleaceholder' => esc_html__( 'Enter title here', 'venam' )
            ]
        );
        $repeater->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'H1', 'venam' ),
                    'h2' => esc_html__( 'H2', 'venam' ),
                    'h3' => esc_html__( 'H3', 'venam' ),
                    'h4' => esc_html__( 'H4', 'venam' ),
                    'h5' => esc_html__( 'H5', 'venam' ),
                    'h6' => esc_html__( 'H6', 'venam' ),
                    'div' => esc_html__( 'div', 'venam' ),
                    'p' => esc_html__( 'p', 'venam' ),
                ],
                'condition' => ['title!' => '']
            ]
        );
        $repeater->add_control( 't_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-slick__slider {{CURRENT_ITEM}} .slider-content .title' => 'color:{{VALUE}};' ],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 't_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .thm-slick__slider {{CURRENT_ITEM}} .slider-content .title'
            ]
        );
        $repeater->add_control( 't_anim',
            [
                'label' => esc_html__( 'Animation', 'plugin-domain' ),
                'type' => Controls_Manager::ANIMATION,
            ]
        );
        $repeater->add_control( 't_delay',
            [
                'label' => esc_html__( 'Animation Delay ( s )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 0.1,
                'default' => 1
            ]
        );
        $repeater->add_control( 'desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter description here', 'venam' )
            ]
        );
        $repeater->add_control( 'desc_anim',
            [
                'label' => esc_html__( 'Animation', 'plugin-domain' ),
                'type' => Controls_Manager::ANIMATION,
            ]
        );
        $repeater->add_control( 'desc_delay',
            [
                'label' => esc_html__( '.slider-content', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 0.1,
                'default' => 1,
            ]
        );
        $repeater->add_control( 'btn1_heading',
            [
                'label' => esc_html__( 'BUTTON', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'venam' )
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Button Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'venam' )
            ]
        );
        $repeater->add_control( 'use_icon',
            [
                'label' => esc_html__( 'Use Icon', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'icon',
            [
                'label' => esc_html__( 'Button Icon', 'venam' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid'
                ],
                'condition' => ['use_icon' => 'yes']
            ]
        );
        $repeater->add_control( 'icon_pos',
            [
                'label' => esc_html__( 'Icon Position', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'btn-icon-right',
                'options' => [
                    'left' => esc_html__( 'Before', 'venam' ),
                    'right' => esc_html__( 'After', 'venam' )
                ],
                'condition' => ['use_icon' => 'yes']
            ]
        );
        $repeater->add_control( 'btn_anim',
            [
                'label' => esc_html__( 'Animation', 'plugin-domain' ),
                'type' => Controls_Manager::ANIMATION,
            ]
        );
        $repeater->add_control( 'btn_delay',
            [
                'label' => esc_html__( 'Animation Delay ( s )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 0.1,
                'default' => 1,
            ]
        );
        $this->add_control( 'slider_items',
            [
                'label' => esc_html__( 'Slide Items', 'venam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'subtitle' => 'best deal !',
                        'title' => 'Smart Watch Bracelet',
                        'desc' => 'Get up to <span>50%</span> off Today Only',
                        'btn_title' => 'Shop Now',
                        'link' => '#0'
                    ],
                    [
                        'subtitle' => 'best deal !',
                        'title' => 'Smart Watch Bracelet',
                        'desc' => 'Get up to <span>50%</span> off Today Only',
                        'btn_title' => 'Shop Now',
                        'link' => '#0'
                    ],
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_options_section',
            [
                'label' => esc_html__( 'Slider Options', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500000,
                'step' => 100,
                'default' => 5000,
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
                'default' => 'no',
            ]
        );
        $this->add_control( 'arrows',
            [
                'label' => esc_html__( 'Nav', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'fade',
            [
                'label' => esc_html__( 'Fade', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'text_style_section',
            [
                'label' => esc_html__( 'STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'container_heading',
            [
                'label' => esc_html__( 'SLIDE CONTAINER', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'minh',
            [
                'label' => esc_html__( 'Min Height ( px )', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 5
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 600
                ],
                'selectors' => [ '{{WRAPPER}} .slider-bg' => 'min-height: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_control( 'subtitle_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-slick__slider .slider-content .tagline' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .thm-slick__slider .slider-content .tagline'
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-slick__slider .slider-content .title' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .thm-slick__slider .slider-content .title'
            ]
        );
        $this->add_control( 'desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'desc_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-slick__slider .slider-content .desc' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .thm-slick__slider .slider-content .desc'
            ]
        );
        $this->add_control( 'btn_heading',
            [
                'label' => esc_html__( 'BUTTON', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn'
            ]
        );
        $this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'separator' => 'before'
            ]
        );
        $this->start_controls_tabs('btn_tabs');
        $this->start_controls_tab( 'btn_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn',
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
         $this->add_control( 'btn_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn:hover' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvrborder',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_hvrbackground',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .thm-slick__slider .slider-content .thm-btn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('nav_style_section',
            [
                'label'=> esc_html__( 'SLIDER ARROWS STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['arrows' => 'yes']
            ]
        );
        $this->add_responsive_control( 'nav_alignment',
            [
                'label' => esc_html__( 'Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .slick-custom-arrows' => 'justify-content: {{VALUE}};'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'venam' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'venam' ),
                        'icon' => 'eicon-h-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'venam' ),
                        'icon' => 'eicon-h-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'center'
            ]
        );
        $this->add_responsive_control( 'nav_bottom_position',
            [
                'label' => esc_html__( 'Bottom Offset', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slick-custom-arrows' => 'bottom:{{SIZE}}px;' ],
            ]
        );
        $this->add_responsive_control( 'nav_left_position',
            [
                'label' => esc_html__( 'Left Offset', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slick-custom-arrows' => 'left:{{SIZE}}px;right:auto;' ],
                'condition' => ['nav_alignment' => 'flex-start']
            ]
        );
        $this->add_responsive_control( 'nav_right_position',
            [
                'label' => esc_html__( 'Right Offset', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slick-custom-arrows' => 'right:{{SIZE}}px;left:auto;' ],
                'condition' => ['nav_alignment' => 'flex-end']
            ]
        );
        $this->add_responsive_control( 'nav_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slick-custom-arrows .slick-arrow' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
            ]
        );
        $this->add_responsive_control( 'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slick-custom-arrows .slick-arrow' => 'font-sixe:{{SIZE}}px;' ],
            ]
        );
        $this->add_responsive_control( 'nav_space',
            [
                'label' => esc_html__( 'Space', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slick-custom-arrows .slick-arrow' => 'margin-left:{{SIZE}}px;margin-right:{{SIZE}}px;' ],
            ]
        );
        $this->start_controls_tabs( 'nav_nav_tabs');
        $this->start_controls_tab( 'nav_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'nav_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slick-custom-arrows .slick-arrow' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'nav_bgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slick-custom-arrows .slick-arrow' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .slick-custom-arrows .slick-arrow',
            ]
        );
        $this->add_responsive_control( 'nav_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .slick-custom-arrows .slick-arrow:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'nav_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slick-custom-arrows .slick-arrow:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'nav_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slick-custom-arrows .slick-arrow:hover' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvrborder',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .slick-custom-arrows .slick-arrow:hover',
            ]
        );
        $this->add_responsive_control( 'nav_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-custom-arrows .slick-arrow:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $data[] = is_rtl() ? '"rtl":true' : '"rtl":false';
        $data[] = 'yes' == $settings['autoplay'] ? '"autoplay": true' : '"autoplay": false';
        $data[] = 'yes' == $settings['loop'] ? '"infinite": true' : '"infinite": false';
        $data[] = 'yes' == $settings['fade'] ? '"fade": true' : '"fade": false';
        $data[] = $settings['speed'] ? '"autoplaySpeed":'.$settings['speed'] : '"autoplaySpeed": 50000';
        $data[] = 'yes' == $settings['arrows'] ? '"arrows": true,"appendArrows": ".slick-navi-'.$id.'","prevArrow":".slick-prev-'.$id.'","nextArrow":".slick-next-'.$id.'"' : '"arrows": false';

        $html = '';
        if ( 'second-slider-area' == $settings['slider_style'] ) {

        }
        $html .= '<div class="slider-active thm-slick__slider" data-slick=\'{'. implode( ',', $data ) .'}\'>';


            foreach ( $settings['slider_items'] as $item ) {

                $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                $rel = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
                $href = $item['link']['url'];

                $size = $item['thumbnail_size'] ? $item['thumbnail_size'] : 'large';
                if ( 'custom' == $size ) {
                    $sizew = $item['thumbnail_custom_dimension']['width'];
                    $sizeh = $item['thumbnail_custom_dimension']['height'];
                    $size = [ $sizew, $sizeh ];
                }

                $html .= '<div class="single-slider slider-bg elementor-repeater-item-' . $item['_id'] . '">';

                    if ( 'second-slider-area' != $settings['slider_style'] ) {
                        $html .= '<div class="container">';
                            $html .= '<div class="row align-items-center">';
                                $html .= '<div class="col-xl-5 col-lg-6 order-0 order-lg-2">';
                                    $html .= '<div class="slider-img" data-animation="'.$item['img_anim'].'" data-delay="'.$item['img_delay'].'s">';
                                        $html .= wp_get_attachment_image( $item['image']['id'], $size, false, ['class'=>'s-img'] );
                                    $html .= '</div>';
                                $html .= '</div>';
                                $html .= '<div class="col-xl-7 col-lg-6">';
                    }


                                $html .= '<div class="slider-content">';
                                    if ( $item['subtitle'] ) {
                                        $html .= '<'.$item['stag'].' class="tagline" data-animation="'.$item['st_anim'].'" data-delay="'.$item['st_delay'].'s">'.$item['subtitle'].'</'.$item['stag'].'>';
                                    }
                                    if ( $item['title'] ) {
                                        $html .= '<'.$item['tag'].' class="title" data-animation="'.$item['t_anim'].'" data-delay="'.$item['t_delay'].'s">'.$item['title'].'</'.$item['tag'].'>';
                                    }
                                    if ( $item['desc'] ) {
                                        $html .= '<p class="desc" data-animation="'.$item['desc_anim'].'" data-delay="'.$item['desc_delay'].'s">'.$item['desc'].'</p>';
                                    }
                                    if ( $item['btn_title'] ) {
                                        if ( $item['icon_pos'] == 'left' ) {
                                            $html .= '<a href="'.$href.'" '.$target.$rel.' class="thm-btn btn btn-icon-left" data-animation="'.$item['btn_anim'].'" data-delay="'.$item['btn_delay'].'s">';
                                            if ( !empty( $settings['icon']['value'] ) ) {
                                                ob_start();
                                                Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
                                                $html .= ob_get_clean();
                                            }
                                            $html .= ' '.$item['btn_title'].'</a>';
                                        } else {
                                            $html .= '<a href="'.$href.'" '.$target.$rel.' class="thm-btn btn btn-icon-right" data-animation="'.$item['btn_anim'].'" data-delay="'.$item['btn_delay'].'s">'.$item['btn_title'].' ';
                                            if ( !empty( $settings['icon']['value'] ) ) {
                                                ob_start();
                                                Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
                                                $html .= ob_get_clean();
                                            }
                                            $html .= '</a>';
                                        }
                                    }
                                $html .= '</div>';
                        if ( 'second-slider-area' != $settings['slider_style'] ) {
                            $html .= '</div>';
                        $html .= '</div>';
                    $html .= '</div>';
                    }
                $html .= '</div>';
            }
        $html .= '</div>';

        if ( 'second-slider-area' != $settings['slider_style'] ) {

    }
        if ( 'yes' == $settings['arrows'] ) {
            $html .= '<div class="slick-custom-arrows slick-navi-'.$id.'">';
                $html .= '<div class="slick-arrow slick-c-prev slick-prev-'.$id.'"><i class="fas fa-angle-left"></i></div>';
                $html .= '<div class="slick-arrow slick-c-next slick-next-'.$id.'"><i class="fas fa-angle-right"></i></div>';
            $html .= '</div>';
        }

        // print
        echo '<div class="'.$settings['slider_style'].'">'.$html.'</div>';
    }
}
