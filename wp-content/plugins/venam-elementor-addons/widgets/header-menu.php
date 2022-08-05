<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Header_Menu extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-menu';
    }
    public function get_title() {
        return 'Header Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('menu_general_settings',
            [
                'label' => esc_html__( 'General', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'main-header__one',
                'options' => [
                    '1' => esc_html__( 'Type 1', 'venam' ),
                    '2' => esc_html__( 'Type 2', 'venam' )
                ]
            ]
        );
        $this->add_control( 'register_menus',
            [
                'label' => esc_html__( 'Select Menu', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->registered_nav_menus(),
            ]
        );
        $this->add_control( 'sticky',
            [
                'label' => esc_html__( 'Sticky?', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control( 'sticky_max_width',
            [
                'label' => esc_html__( 'Sticky Header Max Width', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 4000,
                        'step' => 1
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [ '{{WRAPPER}} .menu-area.sticky-menu .menu-wrap' => 'max-width:{{SIZE}}{{UNIT}};']
            ]
        );
        $this->add_control( 'hide_catmenu',
            [
                'label' => esc_html__( 'Hide Vertical Menu?', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'hide_btn_action',
            [
                'label' => esc_html__( 'Hide Button Actions?', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'hide_btn_action_mobile',
            [
                'label' => esc_html__( 'Hide Button Actions on Mobile?', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'mobmenu_divider',
            [
                'label' => esc_html__( 'MOBILE MENU', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'mob_ajax_search_form',
            [
                'label' => esc_html__( 'Ajax Search Form?', 'venam' ),
                'type' => Controls_Manager::SWITCHER
            ]
        );
        $this->add_control( 'cats_menus',
            [
                'label' => esc_html__( 'Categories Menu', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->registered_nav_menus(),
            ]
        );
        $this->add_control( 'myaccount_btn',
            [
                'label' => esc_html__( 'Myaccount Button?', 'venam' ),
                'type' => Controls_Manager::SWITCHER
            ]
        );
        $this->add_control( 'myaccount_url',
            [
                'label' => esc_html__( 'Custom Myaccount Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
                'condition' => ['myaccount_btn' => 'yes']
            ]
        );
        $this->add_control( 'mob_socials',
            [
                'label' => esc_html__( 'Mobile Menu Socials', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => ''
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'logos_general_settings',
            [
                'label' => esc_html__( 'Logo', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'mobheaderlogo',
            [
                'label' => esc_html__( 'Mobile Header Logo', 'venam' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
            ]
        );
        $this->add_control( 'mobmenulogo',
            [
                'label' => esc_html__( 'Mobile Menu Logo', 'venam' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => '']
            ]
        );
        $this->add_control( 'mainlogo',
            [
                'label' => esc_html__( 'Main Logo', 'venam' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
            ]
        );
        $this->add_control( 'stickylogo',
            [
                'label' => esc_html__( 'Sticky Logo', 'venam' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => '']
            ]
        );
        $this->add_control( 'logolink',
            [
                'label' => esc_html__( 'Logo Custom Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('catmenu_general_settings',
            [
                'label' => esc_html__( 'Vertical Menu', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'vertical_menu_type',
            [
                'label' => esc_html__( 'Menu Content Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'wp' => esc_html__( 'Wp Menu', 'venam' ),
                    'custom' => esc_html__( 'Custom', 'venam' ),
                    'wc' => esc_html__( 'Product Categories', 'venam' ),
                ]
            ]
        );
        $this->add_control( 'hide_empty',
            [
                'label' => esc_html__( 'Hide Empty Categories', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['vertical_menu_type' => 'wc']
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude',
                'condition' => ['vertical_menu_type' => 'wc']
            ]
        );
        $this->add_control( 'register_vertical_menus',
            [
                'label' => esc_html__( 'Vertical Menu', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->registered_nav_menus(),
                'condition' => ['vertical_menu_type' => 'wp']
            ]
        );
        $this->add_control( 'menu_title',
            [
                'label' => esc_html__( 'Menu Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'All Categories',
                'label_block' => true,
            ]
        );
        $this->add_control( 'hidemobile',
            [
                'label' => esc_html__( 'Hide on Mobile?', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'mega',
            [
                'label' => esc_html__( 'Mega Menu', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Menu Title',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'venam' ),
                'condition' => ['mega!' => 'yes'],
            ]
        );
        $repeater->add_control( 'template',
            [
                'label' => esc_html__( 'Mega Menu Content Template', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'label_block' => true,
                'options' => $this->venam_get_elementor_templates('section'),
                'condition' => ['mega' => 'yes'],
            ]
        );
        $this->add_control( 'menu',
            [
                'label' => esc_html__( 'Items', 'venam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'condition' => ['vertical_menu_type' => 'custom'],
                'default' => [
                    [ 'title' => 'Menu Title' ],
                    [ 'title' => 'Menu Title' ],
                    [ 'title' => 'Menu Title' ],
                ]
            ]
        );
        $this->add_control( 'more',
            [
                'label' => esc_html__( 'More Items?', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
                'condition' => ['vertical_menu_type' => 'custom'],
            ]
        );
        $this->add_control( 'more_title',
            [
                'label' => esc_html__( 'More Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'More Categories',
                'label_block' => true,
                'condition' => ['more' => 'yes'],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'mega2',
            [
                'label' => esc_html__( 'Mega Menu', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $repeater->add_control( 'title2',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Menu Title',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'image2',
            [
                'label' => esc_html__( 'Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control( 'link2',
            [
                'label' => esc_html__( 'Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'venam' ),
                'condition' => ['mega!' => 'yes'],
            ]
        );
        $repeater->add_control( 'template2',
            [
                'label' => esc_html__( 'Mega Menu Content Template', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->venam_get_elementor_templates('section'),
                'condition' => ['mega2' => 'yes'],
            ]
        );
        $this->add_control( 'menu2',
            [
                'label' => esc_html__( 'More Items', 'venam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'condition' => ['vertical_menu_type!' => 'wp'],
                'default' => [],
                'condition' => ['more' => 'yes'],
            ]
        );
        $this->add_control( 'vertical_menu_heading',
            [
                'label' => esc_html__( 'BOX STYLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'textcolor',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-category > a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'vertical_menu_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-category > a' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'vertical_menu_box_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .header-category > a'
            ]
        );
        $this->add_responsive_control( 'vertical_menu_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .header-category > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'vertical_menu_menu_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .header-category > a'
            ]
        );
        $this->add_responsive_control( 'vertical_menu_menu_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .header-category > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_responsive_control( 'vertical_menu_height',
            [
                'label' => esc_html__( 'Height', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 300,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-category > a' => 'height:{{SIZE}}px;' ]
            ]
        );
        $this->add_responsive_control( 'vertical_menu_width',
            [
                'label' => esc_html__( 'Width', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 100,
                        'max' => 4000,
                        'step' => 1
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [ '{{WRAPPER}} .header-category' => 'width:{{SIZE}}{{UNIT}};max-width:{{SIZE}}{{UNIT}};' ]
            ]
        );
        $this->add_control( 'vertical_menu_verticaldropdown_heading',
            [
                'label' => esc_html__( 'DROPDOWN', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'vertical_menu_dropdown_bgcolor',
            [
                'label' => esc_html__( 'Dropdown Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .category-menu' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'vertical_menu_verticaldropdown_margintop',
            [
                'label' => esc_html__( 'Dropdown Margin Top', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .category-menu' => 'margin-top:{{SIZE}}px;' ]
            ]
        );
        $this->add_responsive_control( 'vertical_menu_dropdown_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .header-category > a, {{WRAPPER}} .category-menu .navigation li.menu-item > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
            ]
        );
        $this->add_control( 'vertical_menu_items_heading',
            [
                'label' => esc_html__( 'MENU ITEMS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'vertical_menu_items_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .header-category > a, {{WRAPPER}} .category-menu .navigation li.menu-item > a'
            ]
        );
        $this->start_controls_tabs( 'menu_tabs');
        $this->start_controls_tab( 'menu_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'vertical_menu_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .category-menu > li > a, {{WRAPPER}} .more_slide_open > li > a, {{WRAPPER}} .category-menu .navigation li.menu-item > a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'vertical_menu_item_bgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} {{WRAPPER}} .category-menu > li > a, {{WRAPPER}} .more_slide_open > li > a, {{WRAPPER}} .category-menu .navigation li.menu-item > a' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'vertical_menu_menu_brd',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .category-menu > li > a, {{WRAPPER}} .more_slide_open > li > a, {{WRAPPER}} .category-menu .navigation li.menu-item > a'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'menu_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'vertical_menu_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .category-menu > li > a:hover, {{WRAPPER}} .more_slide_open > li > a:hover, {{WRAPPER}} .category-menu .navigation li.menu-item > a:hover' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'vertical_menu_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} {{WRAPPER}} .category-menu > li > a:hover, {{WRAPPER}} .more_slide_open > li > a:hover, {{WRAPPER}} .category-menu .navigation li.menu-item > a:hover' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'vertical_menu_menu_hvrbrd',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .category-menu > li > a:hover, {{WRAPPER}} .more_slide_open > li > a:hover, {{WRAPPER}} .category-menu .navigation li.menu-item > a:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Menu Style', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'container_heading',
            [
                'label' => esc_html__( 'HEADER', 'venam' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_responsive_control( 'container_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .header-style-one .main-header,{{WRAPPER}} .header-style-two .main-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
            ]
        );
        $this->add_control( 'header_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-header,{{WRAPPER}} .header-style-two' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'sticky_bgcolor',
            [
                'label' => esc_html__( 'Sticky Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .sticky-menu,{{WRAPPER}} .header-style-two.sticky-menu' => 'background-color:{{VALUE}};' ],
                'condition' => ['sticky' => 'yes']
            ]
        );
        $this->add_control( 'typetrans_brdcolor',
            [
                'label' => esc_html__( 'Border Bottom Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-style-two' => 'border-bottom-color:{{VALUE}};' ],
                'condition' => ['type' => 'header-style-two']
            ]
        );
        $this->add_control( 'menu_heading',
            [
                'label' => esc_html__( 'MAIN MENU', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'margin-left:0' => [
                        'title' => esc_html__( 'Left', 'venam' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'margin:auto' => [
                        'title' => esc_html__( 'Center', 'venam' ),
                        'icon' => 'eicon-h-align-center'
                    ],
                    'margin-right:0' => [
                        'title' => esc_html__( 'Right', 'venam' ),
                        'icon' => 'eicon-h-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .navbar-wrap ul.navigation, {{WRAPPER}} .sticky-menu .navbar-wrap ul.navigation' => '{{VALUE}};']
            ]
        );
        $this->add_responsive_control( 'menu_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .navbar-wrap>ul.navigation>li.menu-item>a,
                    {{WRAPPER}} .header-style-two .navbar-wrap>ul.navigation>li>a,
                    {{WRAPPER}} .sticky-menu .navbar-wrap>ul.navigation>li.menu-item>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .navbar-wrap ul.navigation>li.menu-item>a, {{WRAPPER}} .sticky-menu .navbar-wrap  ul.navigation>li.menu-item>a'
            ]
        );
        $this->add_control( 'menu_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .navbar-wrap ul li.menu-item>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .navbar-wrap ul li.menu-item>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .main-menu .navigation li.dropdown .dropdown-btn' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .navbar-wrap>ul>li.menu-item>a:before' => 'background-color:{{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'menu_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .navbar-wrap>ul>li.menu-item.active>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .navbar-wrap>ul>li.menu-item:hover>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .navbar-wrap>ul>li.menu-item.active>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .navbar-wrap>ul>li.menu-item:hover>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .main-menu .navigation li.dropdown:hover>.dropdown-btn' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .main-menu .navigation li.dropdown.active>.dropdown-btn' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .navbar-wrap>ul>li.menu-item>a:before' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .header-style-two .navbar-wrap>ul>li>a:before' => 'background-color:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'menu_arrow_color',
            [
                'label' => esc_html__( 'Arrow Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .navigation li.dropdown .dropdown-btn' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'menu_arrow_spacing',
            [
                'label' => esc_html__( 'Arrow Spacing', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -50,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .navigation li.dropdown .dropdown-btn' => 'right:{{SIZE}}px;']
            ]
        );
        $this->add_control( 'bottom_line_color',
            [
                'label' => esc_html__( 'Bottom Line Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .navbar-wrap>ul>li.menu-item>a:before' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .header-style-two .navbar-wrap>ul>li>a:before' => 'background-color:{{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control( 'bottom_line_position',
            [
                'label' => esc_html__( 'Bottom Line Position', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 300,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .navbar-wrap>ul>li.menu-item>a:before' => 'bottom:{{SIZE}}px;',
                    '{{WRAPPER}} .header-style-two .navbar-wrap>ul>li>a:before' => 'bottom:{{SIZE}}px;top:auto;'
                ]
            ]
        );
        $this->add_control( 'sticky_menu_color',
            [
                'label' => esc_html__( 'Sticky Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sticky-menu .navbar-wrap ul li.menu-item>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .navbar-wrap ul li.menu-item>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .main-menu .navigation li.dropdown .dropdown-btn' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .navbar-wrap>ul>li.menu-item>a:before' => 'background-color:{{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'sticky_menu_hvrcolor',
            [
                'label' => esc_html__( 'Sticky Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sticky-menu .navbar-wrap>ul>li.menu-item.active>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .navbar-wrap>ul>li.menu-item:hover>a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .main-menu .navigation li.dropdown .dropdown-btn' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .sticky-menu .navbar-wrap>ul>li.menu-item>a:before' => 'background-color:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'sticky_bottom_line_color',
            [
                'label' => esc_html__( 'Sticky Bottom Line Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sticky-menu .navbar-wrap>ul>li.menu-item>a:before' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .header-style-two .sticky-menu .navbar-wrap>ul>li>a:before' => 'background-color:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'submenu_heading',
            [
                'label' => esc_html__( 'SUBMENU', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'submenu_boxbgcolor',
            [
                'label' => esc_html__( 'Bacground Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .navbar-wrap ul li:not(.menu-item-has-shortcode-parent) .submenu' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'submenu_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .navbar-wrap ul li .submenu>li.menu-item>a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'submenu_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .navbar-wrap ul li.menu-item .submenu li.menu-item:hover>a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'submenu_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .navbar-wrap ul li.menu-item .submenu li.menu-item>a' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'submenu_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .navbar-wrap ul li.menu-item .submenu li.menu-item:hover>a' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'mobmenu_heading',
            [
                'label' => esc_html__( 'MOBILE MENU', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'mobmenu_togglecolor',
            [
                'label' => esc_html__( 'Toggle Button Bar Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-header .mobile-nav-toggler' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'mobmenu_hvrtogglecolor',
            [
                'label' => esc_html__( 'Hover Button Bar Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-header .mobile-nav-toggler:hover' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'mobmenu_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-style-one .main-header' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'mobmenu_overlay',
            [
                'label' => esc_html__( 'Overlay Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-menu-visible .mobile-menu .menu-backdrop' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'mobmenu_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .mobile-menu .navigation li.menu-item>a'
            ]
        );
        $this->start_controls_tabs( 'mobmenu_tabs');
        $this->start_controls_tab( 'mobmenu_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'mobmenu_color',
            [
                'label' => esc_html__( 'Menu Item', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-menu .navigation li.menu-item>a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'mobmenu_down_bgcolor',
            [
                'label' => esc_html__( 'Dropdown Button Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-menu .navigation li.dropdown .dropdown-btn' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'mobmenu__brd',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .mobile-menu .navigation li.menu-item'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'mobmenu_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'mobmenu_hvrcolor',
            [
                'label' => esc_html__( 'Menu Item', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-menu .navigation li.menu-item:hover>a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'mobmenu_down_hvrbgcolor',
            [
                'label' => esc_html__( 'Dropdown Button Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-menu .navigation li.dropdown .dropdown-btn:hover' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'mobmenu_hvrbrd',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .mobile-menu .navigation li.menu-item:hover'
            ]
        );
        $this->add_control( 'cart_heading',
            [
                'label' => esc_html__( 'CART', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'cart_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .header-action>ul>li i' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .header-action>ul>li svg' => 'fill:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'cart_icon_hvrcolor',
            [
                'label' => esc_html__( 'Hover Icon Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .header-action>ul>li:hover i' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .header-action>ul>li:hover svg' => 'fill:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'cart_totals_color',
            [
                'label' => esc_html__( 'Cart Total Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-shop-cart .cart-total-price' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'cart_count_bgcolor',
            [
                'label' => esc_html__( 'Count Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .header-shop-compare.woosc-menu-item .woosc-menu-item-inner:after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .header-shop-wishlist.woosw-menu-item .woosw-menu-item-inner:after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .header-shop-cart a span.cart-count' => 'background-color:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'cart_count_color',
            [
                'label' => esc_html__( 'Count Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .header-shop-compare.woosc-menu-item .woosc-menu-item-inner:after' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .header-shop-wishlist.woosw-menu-item .woosw-menu-item-inner:after' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .header-shop-cart a span.cart-count' => 'color:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'cart_tooltip_bgcolor',
            [
                'label' => esc_html__( 'Tooltip Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .hint--top:after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .hint--top:before' => 'border-top-color:{{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'cart_tooltip_color',
            [
                'label' => esc_html__( 'Tooltip Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .hint--top:after, {{WRAPPER}} .hint--top:before' => 'color:{{VALUE}};' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    public function header_action()
    {
        if ( class_exists( 'WooCommerce' ) ) {
            $settings = $this->get_settings_for_display();
            $count = WC()->cart? WC()->cart->cart_contents_count : '';
            $total = WC()->cart ? WC()->cart->subtotal : '';

            $hidemobile = 'yes' == $settings['hide_btn_action_mobile'] ? ' d-none d-md-block' : '';
            echo'<div class="header-action'.$hidemobile.'">';
                echo'<ul>';

                if ( 'yes' == $settings['myaccount_btn'] ) {
                    $myaccount_url_desk = $settings['myaccount_url']['url'] ? esc_url( $settings['myaccount_url']['url'] ) : wc_get_page_permalink( 'myaccount' );
                    echo'<li class="header-shop-account">';
                        echo'<a href="'.$myaccount_url_desk.'">'.venam_svg_lists( 'user-1' ).'</a>';
                    echo'</li>';
                }
                    if ( shortcode_exists( 'woosc' ) ) {
                        $clabel = esc_html__('Compare', 'venam');
                        echo'<li class="header-shop-compare woosc-menu-item">';
                            echo venam_svg_lists( 'compare' );
                            echo'<a href="#" class="open-compare-btn hint--top" data-label="'.$clabel.'"></a>';
                        echo'</li>';
                    }

                    if ( class_exists('WPCleverWoosw') ) {
                        $url = \WPcleverWoosw::get_url();
                        $count = \WPcleverWoosw::get_count();
                        $wlabel = esc_html__('Wishlist', 'venam');
                        echo'<li class="header-shop-wishlist menu-item woosw-menu-item menu-item-type-woosw">';
                            echo venam_svg_lists( 'love' );
                            echo'<a class="venam-wishlist-link hint--top" href="' . $url . '" data-label="'.$wlabel.'"><span class="woosw-menu-item-inner" data-count="' . $count . '"></span></a>';
                        echo'</li>';
                    }
                    $cartlabel = esc_html__('Cart', 'venam');
                    echo'<li class="header-shop-cart">';
                        echo'<a class="venam-cart-btn hint--top" href="'.wc_get_cart_url().'" data-label="'.$cartlabel.'">';
                                echo venam_svg_lists( 'bag' );
                                echo'<span class="venam-cart-count cart-count">'.esc_html( $count ).'</span>';
                        echo'</a>';
                            echo'<span class="venam-cart-total-price cart-total-price">'.wc_price( $total ).'</span>';
                        echo get_template_part( 'woocommerce/minicart/header', 'minicart' );
                    echo'</li>';
                echo'</ul>';
            echo'</div>';
        }
    }

    public function category_menu()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $hidemobile = $settings['hidemobile'] ? ' d-none d-lg-block' : '';
        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        echo '<div class="header-category header-category d-none d-lg-block" id="header-category-'.$id.'">';
            echo '<a href="#" class="cat-toggle"><i class="fas fa-bars"></i>'.$settings['menu_title'].'<i class="fas fa-angle-down"></i></a>';
            echo '<div class="category-menu">';
                if ( 'wp' == $settings['vertical_menu_type'] ) {
                    echo '<ul class="navigation primary-menu">';
                    echo wp_nav_menu(
                        array(
                            'menu' => $settings['register_vertical_menus'],
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
                            'depth' => 4,
                            'echo' => true,
                            'fallback_cb' => 'Venam_Wp_Bootstrap_Navwalker::fallback',
                            'walker' => new \Venam_Wp_Bootstrap_Navwalker()
                        )
                    );
                    echo '</ul>';

                } elseif ( 'wc' == $settings['vertical_menu_type'] ) {

                    echo '<ul class="navigation primary-menu">';
                        echo wp_list_categories(array(
                            'echo'       => true,
                            'taxonomy'   => 'product_cat',
                            'depth'      => 5,
                            'hide_empty' => 'yes' == $settings['hide_empty'] ? 1 : 0,
                            'title_li'   => '',
                            'exclude'    => !empty( $settings['category_exclude'] ) ? $settings['category_exclude'] : '',
                            'walker'     => new \Venam_Wc_Categories_Walker()
                        ));
                    echo '</ul>';

                } else {

                    foreach ( $settings['menu'] as $m ) {
                        if ( 'yes' == $m['mega'] && !empty( $m['template'] ) ) {
                            echo '<div class="has-dropdown category-menu-item">';
                                echo '<a href="#">';
                                    if ( $m['image']['url'] ) {
                                        $image = wp_get_attachment_image( $m['image']['id'], $size, false );
                                        echo '<div class="cat-menu-img">'.$image.'</div>';
                                    }
                                    echo $m['title'];
                                echo '</a>';
                                echo '<div class="mega-menu">';
                                    $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                                    $template_id = $m['template'];
                                    $header_content = new Frontend;
                                    echo $header_content->get_builder_content_for_display( $template_id, $style );
                                echo '</div>';
                            echo '</div>';
                        }
                        if ( 'yes' != $m['mega'] ) {
                            echo '<div class="category-menu-item"><a href="'.$m['link']['url'].'" title="'.$m['title'].'">'.$m['title'].'</a></div>';
                        }
                    }
                    if ( 'yes' == $settings['more'] && !empty( $settings['menu2'] ) ) {
                        echo '<div class="category-menu-item">';
                            echo '<div class="more_slide_open">';
                                foreach ( $settings['menu2'] as $m ) {
                                    if ( 'yes' == $m['mega2'] && !empty( $m['template2'] ) ) {
                                        echo '<div class="has-dropdown category-menu-item">';
                                            echo '<a href="#">';
                                                if ( $m['image2']['url'] ) {
                                                    $image = wp_get_attachment_image( $m['image2']['id'], $size, false );
                                                    echo '<div class="cat-menu-img">'.$image.'</div>';
                                                }
                                                echo $m['title2'];
                                            echo '</a>';
                                            echo '<div class="mega-menu">';
                                                $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                                                $template_id = $m['template2'];
                                                $header_content = new Frontend;
                                                echo $header_content->get_builder_content_for_display( $template_id, $style );
                                            echo '</div>';
                                        echo '</div>';
                                    }
                                    if ( 'yes' != $m['mega2'] ) {
                                        echo '<div class="category-menu-item"><a href="'.$m['link']['url'].'" title="'.$m['title'].'">'.$m['title'].'</a></div>';
                                    }
                                }
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="more_categories category-menu-item">'.$settings['more_title'].'<i class="fas fa-angle-down"></i></div>';
                    }
                }
            echo '</div>';
        echo '</div>';
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $hasmoblogo = !empty( $settings['moblogo']['url'] ) ? ' has-mobile-logo' : '';
        $sticky = 'yes' == $settings['sticky'] ? '  id="sticky-header"' : '';
        $bgcolor = '1' == $settings['type'] ? ' blue-bg' : '';
        $type = '1' == $settings['type'] ? 'header-style-one' : 'header-style-two';
        $logotype = '1' == $settings['type'] ? ' d-block d-lg-none' : '';
        $logolink = $settings['logolink']['url'] ? $settings['logolink']['url'] : esc_url( home_url( '/' ) );

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }

        echo '<header class="header-widget '.$type.'">';
            echo '<div'.$sticky.' class="main-header menu-area'.$bgcolor.'">';
            if ( '1' == $settings['type'] ) {
            echo '<div class="container-wrapper">';
            echo '<div class="row">';
            echo '<div class="col-12 pl-sm-0 pr-sm-0">';
            }
                echo '<div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>';
                echo '<div class="menu-wrap">';
                    echo '<nav class="menu-nav show">';

                        if ( $settings['mobheaderlogo']['url'] || $settings['stickylogo']['url'] ) {
                            echo '<div class="logo'.$logotype.'">';
                                echo '<a href="'.$logolink.'">';
                                    if ( $settings['mobheaderlogo']['url'] ) {
                                        echo wp_get_attachment_image( $settings['mobheaderlogo']['id'], $size, false, ['class' => 'sticky-none' ] );
                                    }
                                    if ( $settings['stickylogo']['url'] ) {
                                        echo wp_get_attachment_image( $settings['stickylogo']['id'], $size, false, ['class' => 'sticky-block' ] );
                                    }
                                echo '</a>';
                            echo '</div>';
                        }

                        if ( '1' == $settings['type'] && 'yes' != $settings['hide_catmenu'] ) {
                            $this->category_menu();
                        }
                        echo '<div class="navbar-wrap main-menu d-none d-lg-flex">';
                            echo '<ul class="navigation">';
                                echo wp_nav_menu(
                                    array(
                                        'menu' => $settings['register_menus'],
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
                                        'depth' => 4,
                                        'echo' => true,
                                        'fallback_cb' => 'Venam_Wp_Bootstrap_Navwalker::fallback',
                                        'walker' => new \Venam_Wp_Bootstrap_Navwalker()
                                    )
                                );
                            echo '</ul>';
                        echo '</div>';
                        if ( '1' != $settings['type'] && 'yes' != $settings['hide_btn_action'] ) {
                            $this->header_action();
                        }
                    echo '</nav>';
                echo '</div>';

                $moblogonone = empty($settings['mobmenulogo']['url']) ? ' mob-logo-none' : '';
                echo '<div class="mobile-menu'.$moblogonone.'">';
                    echo '<div class="menu-backdrop"></div>';
                    echo '<div class="close-btn"><i class="fas fa-times"></i></div>';

                    if ( $settings['mobmenulogo']['url'] ) {
                        $logo = wp_get_attachment_image( $settings['mobmenulogo']['id'], $size, false, ['class' => 'mobile-menu-logo' ] );
                        echo '<div class="nav-logo">';
                            echo '<a href="'.$logolink.'">'.$logo.'</a>';
                        echo '</div>';
                    }
                    if ( class_exists( 'WooCommerce' ) && shortcode_exists( 'venam_wc_ajax_search' ) && 'yes' == $settings['mob_ajax_search_form'] ) {
                        echo do_shortcode('[venam_wc_ajax_search]');
                    }
                    if ( !empty( $settings['cats_menus'] ) || 'yes' == $settings['myaccount_btn'] ) {
                        echo '<div class="menu-inner-buttons">';
                            echo '<div class="menu-inner-button active" data-menu-name="menu">'.esc_html__( 'MENU', 'venam' ).'</div>';
                            if ( !empty( $settings['cats_menus'] ) ) {
                                echo '<div class="menu-inner-button" data-menu-name="cats">'.esc_html__( 'CATEGORIES', 'venam' ).'</div>';
                            }

                            if ( class_exists( 'WooCommerce' ) && 'yes' == $settings['myaccount_btn'] ) {
                                $myaccount_url = $settings['myaccount_url']['url'] ? esc_url( $settings['myaccount_url']['url'] ) : '#0';
                                echo '<div class="menu-inner-button" data-menu-name="actions">';
                                    echo '<a href="'.$myaccount_url.'" class="user">';
                                        echo venam_svg_lists( 'user-1' );
                                    echo '</a>';
                                echo '</div>';
                            }
                        echo '</div>';
                    }

                    echo '<div class="navs-wrapper">';

                        echo '<nav class="menu-box" data-menu-name="menu">';
                            echo '<div class="menu-outer"></div>';
                        echo '</nav>';

                        if ( !empty( $settings['cats_menus'] ) ) {
                            echo '<nav class="menu-cats" data-menu-name="cats">';
                                echo '<div class="menu-cats-outer">';
                                    echo '<ul class="navigation">';
                                        echo wp_nav_menu(
                                            array(
                                                'menu' => $settings['cats_menus'],
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
                                                'depth' => 4,
                                                'echo' => true,
                                                'fallback_cb' => 'Venam_Wp_Bootstrap_Navwalker::fallback',
                                                'walker' => new \Venam_Wp_Bootstrap_Navwalker()
                                            )
                                        );
                                    echo '</ul>';
                                echo '</div>';
                            echo '</nav>';
                        }

                        if ( class_exists( 'WooCommerce' ) ) {
                            if ( is_user_logged_in() ) {
                                echo '<nav class="menu-form menu_logged_in" data-menu-name="actions">';
                                    echo '<div class="account-dropdown">';
                                        echo '<ul class="navigation">';
                                        foreach ( wc_get_account_menu_items() as $endpoint => $label ) {
                                            echo '<li class="menu-item '.wc_get_account_menu_item_classes( $endpoint ).'">';
                                                echo '<a href="'.esc_url( wc_get_account_endpoint_url( $endpoint ) ).'">'.esc_html( $label ).'</a>';
                                            echo '</li>';
                                        }
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</nav>';
                            } else {
                                $url = $settings['myaccount_url']['url'] ? $settings['myaccount_url']['url'] : wc_get_page_permalink( 'myaccount' );
                                $redirecturl = $settings['myaccount_url'] ? array( 'redirect' => $settings['myaccount_url'] ) : '';
                                $myaccount_url = $settings['myaccount_url']['url'] ? $settings['myaccount_url']['url'] : wc_get_page_permalink( 'myaccount' );

                                echo '<nav class="menu-form" data-menu-name="actions">';
                                    echo '<div class="account-dropdown">';
                                        echo '<div class="account-wrap">';
                                            echo '<div class="login-form-head">';
                                                echo '<span class="login-form-title">'.esc_html__( 'Sign in', 'venam' ).'</span>';
                                                echo '<span class="register-form-title">';
                                                echo '<a class="register-link" href="'.esc_url( $myaccount_url ).'" title="'.esc_html__( 'Register', 'venam' ).'">'.esc_html__( 'Create an Account', 'venam' ).'</a>';
                                                echo '</span>';
                                            echo '</div>';
                                            woocommerce_login_form( $redirecturl );
                                        echo '</div>';
                                    echo '</div>';
                                echo '</nav>';
                            }
                        }
                    echo '</div>';

                    if ( !empty( $settings['mob_socials'] ) ) {
                        echo '<div class="social-links">'.$settings['mob_socials'].'</div>';
                    }

                echo '</div>';
                if ( '1' == $settings['type'] ) {
            echo '</div>';
            echo '</div>';
            echo '</div>';
            }
            echo '</div>';
        echo '</header>';
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
            <script>
            jQuery(document).ready( function($) {
                if ( $('.menu-area li.dropdown ul').length ) {
                    $('.menu-area .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>');
                }
                //Mobile Nav Hide Show
                if ( $('.mobile-menu').length ) {

                    var mobileMenuContent = $('.menu-area .main-menu').html();
                    $('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);

                    //Dropdown Button
                    $('.mobile-menu li.dropdown .dropdown-btn').on('click', function () {
                        $(this).toggleClass('open');
                        $(this).prev('ul').slideToggle(500);
                        $(this).parent('.menu-item').siblings().find('ul.submenu').slideUp(500);
                        $(this).parent('.menu-item').siblings().find('.dropdown-btn').removeClass('open');
                    });
                    //Menu Toggle Btn
                    $('.mobile-nav-toggler').on('click', function () {
                        $('body').addClass('mobile-menu-visible');
                        $(this).closest('.elementor-section.elementor-top-section').addClass('mobile-menu-visible');
                        if ( $('#nt-sidebar').hasClass('active') ) {
                            $('.close-sidebar').trigger('click');
                        }
                        setTimeout(function () {
                            $('body').addClass('mobile-trans-end');
                        }, 2000);
                    });

                    //Menu Toggle Btn
                    $('.mobile-menu .menu-backdrop,.mobile-menu .close-btn').on('click', function () {
                        $('body').removeClass('mobile-menu-visible');
                        $(this).closest('.elementor-section.elementor-top-section').removeClass('mobile-menu-visible');
                        $('body').removeClass('mobile-trans-end');

                        $('.menu-inner-button:not([data-menu-name="menu"])').removeClass('active');
                        $('.mobile-menu nav:not([data-menu-name="menu"])').removeClass('active').slideUp();
                        $('.menu-inner-button[data-menu-name="menu"]').addClass('active');
                        $('.mobile-menu nav[data-menu-name="menu"]').addClass('active').slideDown();

                    });
                }
                if ( $('.mobile-menu nav[data-menu-name="menu"]').length ) {
                    $('.mobile-menu nav[data-menu-name="menu"]').addClass('active');
                    $('.mobile-menu nav:not([data-menu-name="menu"])').slideUp();
                }

                //Header mobile menu buttons
                $('.menu-inner-button').on('click', function () {
                    var $this = $( this ),
                        dataval = $this.data('menu-name');

                    $('.mobile-menu .submenu').slideUp(500);
                    $('.mobile-menu .dropdown-btn').removeClass('open');
                    $this.addClass('active').siblings().removeClass('active');
                    $('.mobile-menu nav[data-menu-name="'+dataval+'"]').addClass('active').slideDown();
                    $('.mobile-menu nav:not([data-menu-name="'+dataval+'"])').removeClass('active').slideUp();
                });

                //Header account form Toggle
                $('.venam_mini_account_form .user').on('click', function () {
                    $( this ).parent().toggleClass('active');
                });
            });
            </script>
            <?php
        }
    }
}
