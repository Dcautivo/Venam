<?php

namespace Elementor;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Special_Offer_Banner extends Widget_Base {
    public function get_name() {
        return 'venam-special-offer-banner';
    }
    public function get_title() {
        return 'Special Offer Banner (N)';
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
                'label' => esc_html__('Banner Image', 'venam'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'image',
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
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'venam' ),
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

        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
        echo '<div class="special-offer-item-box special-offer-banner">';
            echo '<a href="'.$settings['link']['url'].'"'.$target.$rel.'>';
                echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'cat--img'] );
            echo '</a>';
        echo '</div>';
    }
}
