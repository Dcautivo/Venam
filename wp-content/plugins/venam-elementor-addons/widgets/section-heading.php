<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Section_Heading extends Widget_Base {
    public function get_name() {
        return 'venam-section-heading';
    }
    public function get_title() {
        return 'Section Heading (N)';
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

        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Subtitle',
                'label_block' => true,
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Title',
                'label_block' => true,
            ]
        );
        $this->add_control( 'tag',
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
            ]
        );
        $this->add_control( 'separator',
            [
                'label' => esc_html__( 'Bottom Separator Image', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'seperator',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .section-title::after',
                'condition' => ['separator' => 'yes']
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
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .section-title' => 'text-align: {{VALUE}};'],
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'venam' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'venam' ),
                        'icon' => 'eicon-h-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'venam' ),
                        'icon' => 'eicon-h-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'center'
            ]
        );
        $this->add_responsive_control( 'box_margin',
            [
                'label' => esc_html__( 'Margin', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'subtitle_divider',
            [
                'label' => esc_html__( 'SUBTITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-header .sub-title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .section-title .sub-title'
            ]
        );
        $this->add_responsive_control( 'subtitle_margin',
            [
                'label' => esc_html__( 'Margin', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .section-title .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
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
                'selectors' => [ '{{WRAPPER}} .page-header .title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .section-title .title'
            ]
        );
        $this->add_responsive_control( 'title_margin',
            [
                'label' => esc_html__( 'Margin', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .section-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $separator = 'yes' != $settings['separator'] ? ' hide-separator' : '';
        echo '<div class="section-title'.$separator.'">';
            if ( $settings['subtitle'] ) {
                echo '<span class="sub-title">'.$settings['subtitle'].'</span>';
            }
            if ( $settings['title'] ) {
                echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
            }
        echo '</div>';

    }
}
