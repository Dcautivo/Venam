<?php

namespace Elementor;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Limited_Offer_Banner extends Widget_Base {
    public function get_name() {
        return 'venam-limited-offer-banner';
    }
    public function get_title() {
        return 'Limited Offer Banner (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'general_settings',
            [
                'label' => esc_html__('Limited Banner', 'venam'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'general_divider',
            [
                'label' => esc_html__( 'GENERAL', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .limited-offer-area',
            ]
        );
        $this->add_control( 'bigtext',
            [
                'label' => esc_html__( 'Bottom Big Text', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Vanam Top Sale 35<span>%</span>',
                'label_block' => true,
            ]
        );
        $this->add_control( 'bigtag',
            [
                'label' => esc_html__( 'Big Text Tag', 'venam' ),
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
        $this->add_control( 'left_divider',
            [
                'label' => esc_html__( 'LEFT SECTION', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'exclusive offer',
                'label_block' => true,
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Smart Watch Bracelet',
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
        $this->add_control( 'image1',
            [
                'label' => esc_html__( 'Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            ]
        );
        $this->add_control( 'right_divider',
            [
                'label' => esc_html__( 'RIGHT SECTION', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'btntitle',
            [
                'label' => esc_html__( 'Button Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true,
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Button Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
            ]
        );
        $this->add_control( 'uptotitle',
            [
                'label' => esc_html__( 'Upto Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
            ]
        );
        $this->add_control( 'amounttitle',
            [
                'label' => esc_html__( 'Amount Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
            ]
        );
        $this->add_control( 'offtitle',
            [
                'label' => esc_html__( 'Off Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
            ]
        );
        $this->add_control( 'image2',
            [
                'label' => esc_html__( 'Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail2',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('style_section',
            [
                'label'=> esc_html__( 'STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'box_sdivider',
            [
                'label' => esc_html__( 'BOX', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'box_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special-offer-item-box' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'box_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .special-offer-item-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .special-offer-item-box'
            ]
        );
        $this->add_responsive_control( 'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .special-offer-item-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_bxshodow',
                'label' => esc_html__( 'Box Shadow', 'venam' ),
                'selector' => '{{WRAPPER}} .special-offer-item-box'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $size2 = $settings['thumbnail2_size'] ? $settings['thumbnail2_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew2 = $settings['thumbnail2_custom_dimension']['width'];
            $sizeh2 = $settings['thumbnail2_custom_dimension']['height'];
            $size2 = [ $sizew2, $sizeh2 ];
        }
        echo '<div class="limited-offer-area">';
            echo '<div class="container">';
                echo '<div class="row align-items-center justify-content-between">';
                    echo '<div class="col-xl-5 col-lg-6 col-md-7">';
                        echo '<div class="limited-offer-left">';
                            echo '<div class="limited-offer-title">';
                                if ( $settings['subtitle'] ) {
                                    echo '<span class="sub-title">'.$settings['subtitle'].'</span>';
                                }
                                if ( $settings['title'] ) {
                                    echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
                                }
                            echo '</div>';
                            if ( $settings['image1']['id'] ) {
                                echo '<div class="limited-offer-disc">';
                                    echo wp_get_attachment_image( $settings['image1']['id'], $size, false, ['class'=>'limited--img'] );
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="col-xl-3 col-lg-4 col-md-5">';
                        echo '<div class="limited-offer-action">';
                            if ( $settings['btntitle'] ) {
                                $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                                $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                                echo '<a class="btn" href="'.$settings['link']['url'].'"'.$target.$rel.'>'.$settings['btntitle'].'</a>';
                            }
                            echo '<div class="amount-info">';
                                if ( $settings['uptotitle'] ) {
                                    echo '<span class="upto">'.$settings['uptotitle'].'</span>';
                                }
                                if ( $settings['amounttitle'] ) {
                                    echo '<span class="amount">'.$settings['amounttitle'].'</span>';
                                }
                                if ( $settings['offtitle'] ) {
                                    echo '<span class="off">'.$settings['offtitle'].'</span>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            if ( $settings['bigtext'] ) {
                echo '<'.$settings['bigtag'].' class="limited-overlay-title">'.$settings['bigtext'].'</'.$settings['bigtag'].'>';
            }
            if ( $settings['image2']['id'] ) {
                echo '<div class="limited-overlay-img">';
                    echo wp_get_attachment_image( $settings['image2']['id'], $size2, false, ['class'=>'overlay--img'] );
                echo '</div>';
            }
        echo '</div>';

    }
}
