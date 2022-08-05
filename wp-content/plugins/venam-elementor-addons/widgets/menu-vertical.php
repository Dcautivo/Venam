<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Vertical_Menu extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-menu-vertical';
    }
    public function get_title() {
        return 'Menu Vertical (N)';
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
        $repeater->add_control( 'mega',
            [
                'label' => esc_html__( 'Mega Menu', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $repeater->add_control( 'template',
            [
                'label' => esc_html__( 'Mega Menu Content', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
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
        $repeater->add_control( 'mega2',
            [
                'label' => esc_html__( 'Mega Menu', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
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
                'title_field' => '{{title2}}',
                'default' => [],
                'condition' => ['more' => 'yes'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Menu Style', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'menu_heading',
            [
                'label' => esc_html__( 'MENU', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'display',
            [
                'label' => esc_html__( 'Display', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'block',
                'options' => [
                    'block' => esc_html__( 'Block', 'venam' ),
                    'inline-block' => esc_html__( 'Inline Block', 'venam' ),
                ],
                'selectors' => [ '{{WRAPPER}} .header-category' => 'display:{{VALUE}};' ],
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
        $this->add_control( 'bgcolor',
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
                'name' => 'box_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .header-category > a'
            ]
        );
        $this->add_responsive_control( 'box_border_radius',
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
                'name' => 'menu_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .header-category > a'
            ]
        );
        $this->add_responsive_control( 'menu_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .header-category > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_responsive_control( 'height',
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
        $this->add_responsive_control( 'width',
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
        $this->add_control( 'dropdown_heading',
            [
                'label' => esc_html__( 'DROPDOWN', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'active',
            [
                'label' => esc_html__( 'Active', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'dropdown_bgcolor',
            [
                'label' => esc_html__( 'Dropdown Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .category-menu' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'dropdown_margintop',
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
        $this->add_responsive_control( 'dropdown_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .header-category > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
            ]
        );
        $this->add_control( 'menu_image_heading',
            [
                'label' => esc_html__( 'MENU IMAGE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'thumbnail'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_brd',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .header-style-two .cat-menu-img'
            ]
        );
        $this->add_control( 'menu_items_heading',
            [
                'label' => esc_html__( 'MENU ITEMS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_items_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .header-category > a'
            ]
        );
        $this->start_controls_tabs( 'menu_tabs');
        $this->start_controls_tab( 'menu_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .category-menu > li > a, {{WRAPPER}} .more_slide_open > li > a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'item_bgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} {{WRAPPER}} .category-menu > li > a, {{WRAPPER}} .more_slide_open > li > a' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'menu_brd',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .category-menu > li > a, {{WRAPPER}} .more_slide_open > li > a'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'menu_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'hvrcolor',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .category-menu > li > a:hover, {{WRAPPER}} .more_slide_open > li > a:hover' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} {{WRAPPER}} .category-menu > li > a:hover, {{WRAPPER}} .more_slide_open > li > a:hover' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'menu_hvrbrd',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .category-menu > li > a:hover, {{WRAPPER}} .more_slide_open > li > a:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
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
        $active = '';
        if ( 'yes' == $settings['active'] && ( is_front_page() ) ) {
            $active = 'yes' == $settings['active'] ? ' drop-active' : '';
        }
        echo '<div class="header-style-two">';
            echo '<div class="header-category'.$hidemobile.'" id="header-category">';
                echo '<a href="#" class="cat-toggle"><i class="flaticon-menu"></i>'.$settings['menu_title'].'</a>';
                echo '<div class="category-menu'.$active.'">';
                    foreach ( $settings['menu'] as $m ) {
                        $target = !empty( $m['link']['is_external'] ) ? ' target="_blank"' : '';
                        $rel = !empty( $m['link']['nofollow'] ) ? ' rel="nofollow"' : '';
                        $href = !empty( $m['link']['url'] ) ? ' href="'.$m['link']['url'].'"' : '';
                        $hasmega = 'yes' == $m['mega'] ? ' class="has-dropdown category-menu-item"' : ' class="category-menu-item"';
                        echo '<div'.$hasmega.'>';
                            echo '<a'.$href.$target.$rel.' title="'.$m['title'].'">';
                                if ( $m['image']['url'] ) {
                                    $image = wp_get_attachment_image( $m['image']['id'], $size, false );
                                    echo '<div class="cat-menu-img">'.$image.'</div>'.$m['title'];
                                }
                            echo '</a>';
                            if ( 'yes' == $m['mega'] && !empty( $m['template'] ) ) {
                                echo '<div class="mega-menu">';
                                $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                                $template_id = $m['template'];
                                $header_content = new Frontend;
                                echo $header_content->get_builder_content_for_display( $template_id, $style );
                                echo '</div>';
                            }
                        echo '</div>';
                    }
                    if ( 'yes' == $settings['more'] && !empty( $settings['menu2'] ) ) {
                        echo '<div class="category-menu-item">';
                            echo '<div class="more_slide_open">';
                                foreach ( $settings['menu2'] as $m ) {
                                    $target2 = !empty( $m['link2']['is_external'] ) ? ' target="_blank"' : '';
                                    $rel2 = !empty( $m['link2']['nofollow'] ) ? ' rel="nofollow"' : '';
                                    $href2 = !empty( $m['link2']['url'] ) ? ' href="'.$m['link2']['url'].'"' : '';
                                    $hasmega2 = 'yes' == $m['mega2'] ? ' class="has-dropdown category-menu-item"' : ' class="category-menu-item"';
                                    echo '<div'.$hasmega2.'>';
                                        echo '<a'.$href2.$target2.$rel2.' title="'.$m['title2'].'">';
                                            if ( $m['image2']['url'] ) {
                                                $image = wp_get_attachment_image( $m['image2']['id'], $size, false );
                                                echo '<div class="cat-menu-img">'.$image.'</div>'.$m['title2'];
                                            }
                                        echo '</a>';
                                        if ( 'yes' == $m['mega2'] && !empty( $m['template2'] ) ) {
                                            echo '<div class="mega-menu">';
                                            $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                                            $template_id = $m['template2'];
                                            $header_content = new Frontend;
                                            echo $header_content->get_builder_content_for_display( $template_id, $style );
                                            echo '</div>';
                                        }
                                    echo '</div>';
                                }
                            echo '</div>';
                        echo '</div>';
                        if ( $settings['more_title'] ) {
                            echo '<div class="more_categories category-menu-item">'.$settings['more_title'].'<i class="fas fa-angle-down"></i></div>';
                        }
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
