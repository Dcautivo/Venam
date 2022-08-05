<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Cta_One extends Widget_Base {
    public function get_name() {
        return 'venam-cta-one';
    }
    public function get_title() {
        return 'CTA One (N)';
    }
    public function get_icon() {
        return 'eicon-columns';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    public function get_script_depends() {
        return [ 'jarallax' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'cta_one_settings',
            [
                'label' => esc_html__('CTA Settings', 'venam')
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Teype', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Type 1', 'venam' ),
                    '2' => esc_html__( 'Type 2', 'venam' ),
                ],
            ]
        );
        $this->add_control( 'bgimage',
            [
                'label' => esc_html__( 'Background Parallax Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail3',
                'default' => 'full',
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
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => ['type' => '2']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'image2',
            [
                'label' => esc_html__( 'Image 2', 'venam' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => ['type' => '2']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'large',
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Providing High Quality Products',
                'label_block' => true
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
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
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Text', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Button Text', 'venam' )
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Button Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
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
                'label' => esc_html__( 'Style', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'overlay_color',
            [
                'label' => esc_html__( 'Overlay Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .call-to-action__three' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'icon_heading',
            [
                'label' => esc_html__( 'ICON', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'icon_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .feature-two__box i' => 'font-size: {{SIZE}}px;' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'icon_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .feature-two__box i' => 'color:{{VALUE}};' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'HEADING', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Title Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .title' => 'color:{{VALUE}};' ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .title'
            ]
        );
        $this->add_control( 'btn_heading',
            [
                'label' => esc_html__( 'BUTTON', 'venam' ),
                'type' => Controls_Manager::HEADING,
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
                'selectors' => ['{{WRAPPER}} .venam-btn' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .venam-btn'
            ]
        );
        $this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .venam-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .venam-btn',
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .venam-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .venam-btn',
                'separator' => 'before'
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
                'selectors' => ['{{WRAPPER}} .venam-btn:hover' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvrborder',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .venam-btn:hover',
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_hvr_background',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .venam-btn:hover',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $size2 = $settings['thumbnail2_size'] ? $settings['thumbnail2_size'] : 'full';
        if ( 'custom' == $size2 ) {
            $sizew2 = $settings['thumbnail2_custom_dimension']['width'];
            $sizeh2 = $settings['thumbnail2_custom_dimension']['height'];
            $size2 = [ $sizew2, $sizeh2 ];
        }
        $size3 = $settings['thumbnail3_size'] ? $settings['thumbnail3_size'] : 'full';
        if ( 'custom' == $size3 ) {
            $sizew3 = $settings['thumbnail3_custom_dimension']['width'];
            $sizeh3 = $settings['thumbnail3_custom_dimension']['height'];
            $size3 = [ $sizew3, $sizeh3 ];
        }

        if ( '1' == $settings['type'] ) {

            echo '<div class="call-to-action jarallax" data-jarallax data-speed="0.3" data-imgPosition="-80% 50%">';
                if ( $settings['bgimage']['url'] ) {
                    echo wp_get_attachment_image( $settings['bgimage']['id'], $size3, false, ['class'=>'call-to-action__bg jarallax-img'] );
                }
                echo '<div class="container">';
                    echo '<div class="call-to-action__content">';
                        if ( !empty( $settings['icon']['value'] ) ) {
                            echo '<div class="call-to-action__icon">';
                                Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                            echo '</div>';
                        }
                        if ( $settings['title'] ) {
                            echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
                        }
                    echo '</div>';
                    if ( $settings['btn_title'] ) {
                        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                        $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                        echo '<div class="call-to-action__button">';
                            echo '<a  class="venam-btn thm-btn" href="'.esc_url( $settings['link']['url'] ).'"'.$target.$rel.'>'.$settings['btn_title'].'</a>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

        } else {

            echo '<div class="call-to-action__three jarallax venam-parallax" data-jarallax data-speed="0.3" data-imgPosition="50% 50%">';
                if ( $settings['bgimage']['url'] ) {
                    echo wp_get_attachment_image( $settings['bgimage']['id'], 'full', false, ['class'=>'call-to-action__three__bg jarallax-img'] );
                }
                echo '<div class="container">';
                    echo '<div class="row">';
                        if ( $settings['image']['url'] || $settings['image2']['url'] ) {
                            echo '<div class="col-lg-5 wow fadeInLeft" data-wow-duration="1500ms">';
                                echo '<div class="call-to-action__three-image">';
                                    if ( $settings['image']['url'] ) {
                                        echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'c-img'] );
                                    }
                                    if ( $settings['image2']['url'] ) {
                                        echo wp_get_attachment_image( $settings['image2']['id'], $size2, false, ['class'=>'c-img'] );
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                        $column = $settings['image']['url'] || $settings['image2']['url'] ? 'col-lg-7' : 'col-lg-12';
                        echo '<div class="'.$column.'">';
                            echo '<div class="call-to-action__three-content">';
                                if ( $settings['title'] ) {
                                    echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
                                }
                                if ( $settings['btn_title'] ) {
                                    $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                                    $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                                    echo '<a  class="venam-btn thm-btn" href="'.esc_url( $settings['link']['url'] ).'"'.$target.$rel.'>'.$settings['btn_title'].'</a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }
}
