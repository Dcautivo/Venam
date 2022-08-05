<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Features_Item extends Widget_Base {
    public function get_name() {
        return 'venam-features-item';
    }
    public function get_title() {
        return 'Features Item (N)';
    }
    public function get_icon() {
        return 'eicon-heading';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'general_section',
            [
                'label'=> esc_html__( 'Text', 'venam' ),
                'tab'=> Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'icon_type',
            [
                'label' => esc_html__( 'Icon Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'img',
                'options' => [
                    'img' => esc_html__( 'Image', 'venam' ),
                    'icon' => esc_html__( 'Icon', 'venam' ),
                ],
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
                'condition' => ['icon_type' => 'img']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'thumbnail',
                'condition' => ['icon_type' => 'img']
            ]
        );
        $this->add_control( 'icon',
            [
                'label' => esc_html__( 'Icon', 'venam' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid'
                ],
                'condition' => ['icon_type' => 'icon']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Free Shipping On Over $ 50',
                'label_block' => true,
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h6',
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
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Short Description', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Agricultural mean crops livestock',
                'label_block' => true,
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Add Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'left_line_color',
            [
                'label' => esc_html__( 'Left Separator Line Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .core-features-item::after' => 'border-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'icon_divider',
            [
                'label' => esc_html__( 'ICON', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'condition' => ['icon_type' => 'icon']
            ]
        );
        $this->add_responsive_control( 'icon_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .core-features-item .core-features-icon' => 'font-size:{{SIZE}}px;' ],
                'condition' => ['icon_type' => 'icon']
            ]
        );
        $this->add_responsive_control( 'icon_minh',
            [
                'label' => esc_html__( 'Icon Wrapper Min Height', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .core-features-item .core-features-icon' => 'min-height:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'icon_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .core-features-item .core-features-icon' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'icon_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .core-features-item:hover .core-features-icon' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'title_divider',
            [
                'label' => esc_html__( 'TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .core-features-content .features-title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .core-features-item:hover .core-features-content .features-title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .core-features-content .features-title'
            ]
        );
        $this->add_responsive_control( 'title_margin',
            [
                'label' => esc_html__( 'Margin', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .core-features-content .features-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'desc_divider',
            [
                'label' => esc_html__( 'DESCRIPTION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'desc_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .core-features-content .features-desc' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .core-features-content .features-desc'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();

        echo '<div class="core-features-item">';
            if ( $settings['link']['url'] ) {
                $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                echo '<a class="features-link" href="'.$settings['link']['url'].'"'.$target.$rel.'></a>';
            }
            if ( 'img' == $settings['icon_type'] ) {
                $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'thumbnail';
                if ( 'custom' == $size ) {
                    $sizew = $settings['thumbnail_custom_dimension']['width'];
                    $sizeh = $settings['thumbnail_custom_dimension']['height'];
                    $size = [ $sizew, $sizeh ];
                }
                echo '<div class="core-features-icon">';
                    echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'f-icon'] );
                echo '</div>';
            }
            if ( !empty( $settings['icon']['value'] ) && 'img' != $settings['icon_type'] ) {
                echo '<div class="core-features-icon">';Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );echo '</div>';
            }
            echo '<div class="core-features-content">';
                if ( $settings['title'] ) {
                    echo '<'.$settings['tag'].' class="features-title">'.$settings['title'].'</'.$settings['tag'].'>';
                }
                if ( $settings['desc'] ) {
                    echo '<span class="features-desc">'.$settings['desc'].'</span>';
                }
            echo '</div>';
        echo '</div>';

    }
}
