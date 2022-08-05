<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Testimonials extends Widget_Base {
    public function get_name() {
        return 'venam-testimonials';
    }
    public function get_title() {
        return 'Testimonials Carousel (N)';
    }
    public function get_icon() {
        return 'eicon-testimonial';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    public function get_style_depends() {
        return [ 'slick' ];
    }
    public function get_script_depends() {
        return [ 'slick' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'items_settings',
            [
                'label' => esc_html__('Testimonials Items', 'venam'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'name',
            [
                'label' => esc_html__( 'Name', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sam Peters',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'pos',
            [
                'label' => esc_html__( 'Position', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'CEO Solar Systems LLC',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'text',
            [
                'label' => esc_html__( 'Quote', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Avatar', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control( 'items',
            [
                'label' => esc_html__( 'Items', 'venam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{name}}',
                'default' => [
                    [
                        'name' => 'Jessica Brown',
                        'pos' => 'Customer',
                        'text' => '“ This is due to their excellent service, competitive pricing and customer support. It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum is simply free text irure dolor in reprehenderit in esse nulla pariatur ”'
                    ],
                    [
                        'name' => 'Caleb Hoffman',
                        'pos' => 'Customer',
                        'text' => '“ This is due to their excellent service, competitive pricing and customer support. It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum is simply free text irure dolor in reprehenderit in esse nulla pariatur ”'
                    ],
                    [
                        'name' => 'Bradley Kim',
                        'pos' => 'Customer',
                        'text' => '“ This is due to their excellent service, competitive pricing and customer support. It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum is simply free text irure dolor in reprehenderit in esse nulla pariatur ”'
                    ]
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            ]
        );
        $this->add_control( 'ntag',
            [
                'label' => esc_html__( 'Name Tag', 'venam' ),
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
            ]
        );
        $this->add_control( 'stars',
            [
                'label' => esc_html__( 'Stars', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .testimonial-item::after',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'slider_options_divider',
            [
                'label' => esc_html__( 'SLIDER OPTIONS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
        $this->add_control( 'centermode',
            [
                'label' => esc_html__( 'Center Mode', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'dots',
            [
                'label' => esc_html__( 'Dots', 'venam' ),
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
                'default' => 1000,
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
                'label' => esc_html__( 'ITEM BOX', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'box_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonial-item' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'box_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .testimonial-item'
            ]
        );
        $this->add_responsive_control( 'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'name_sdivider',
            [
                'label' => esc_html__( 'NAME', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'name_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testi-avatar-info .name' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .testi-avatar-info .name'
            ]
        );
        $this->add_control( 'pos_sdivider',
            [
                'label' => esc_html__( 'POSITION / JOB', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'pos_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testi-avatar-info span' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pos_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .testi-avatar-info span'
            ]
        );
        $this->add_control( 'stars_sdivider',
            [
                'label' => esc_html__( 'STARS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'stars_color',
            [
                'label' => esc_html__( 'Stars Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testi-avatar-info .rating' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'starsize',
            [
                'label' => esc_html__( 'Stars Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testi-avatar-info .rating' => 'font-size:{{SIZE}};' ]
            ]
        );
        $this->add_control( 'text_sdivider',
            [
                'label' => esc_html__( 'TEXT', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'text_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testi-content p' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .testi-content p'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('dots_style_section',
            [
                'label'=> esc_html__( 'SLIDER DOTS STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['dots' => 'yes']
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
                'selectors' => [ '{{WRAPPER}} .testimonial-active .slick-dots li button' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'dots_space',
            [
                'label' => esc_html__( 'Space', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonial-active .slick-dots li' => 'margin-left:{{SIZE}}px;margin-right:{{SIZE}}px;' ],
            ]
        );
        $this->start_controls_tabs( 'dots_nav_tabs');
        $this->start_controls_tab( 'dots_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'dots_bgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testimonial-active .slick-dots li button' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dots_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .testimonial-active .slick-dots li button',
            ]
        );
        $this->add_responsive_control( 'dots_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .testimonial-active .slick-dots li button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'dots_hover_tab',
            [ 'label' => esc_html__( 'Active', 'venam' ) ]
        );
        $this->add_control( 'dots_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonial-active .slick-dots li.slick-active button' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dots_hvrborder',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .testimonial-active .slick-dots li.slick-active button',
            ]
        );
        $this->add_responsive_control( 'dots_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-active .slick-dots li.slick-active button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $rtl = is_rtl() ? 'true' : 'false';
        $loop = 'yes' == $settings['loop'] ? 'true': 'false';
        $dots = 'yes' == $settings['dots'] ? 'true': 'false';
        $autoplay = 'yes' == $settings['autoplay'] ? 'true': 'false';
        $centermode = 'yes' == $settings['centermode'] ? 'true': 'false';

        echo '<div class="row testimonial-active thm-slick__slider" data-slick=\'{"rtl":'.$rtl.',"autoplay":'.$autoplay.',"dots": '.$dots.',"arrows": false,"centerMode":'.$centermode.',"infinite": '.$loop.',"speed": '.$settings['speed'].',"slidesToShow": '.$settings['mditems'].',"slidesToScroll": 1,"adaptiveHeight": true,"responsive": [{"breakpoint": 1025,"settings": {"slidesToShow": '.$settings['mditems'].',"slidesToScroll": 1}},{"breakpoint": 790,"settings": {"slidesToShow": '.$settings['smitems'].',"slidesToScroll": 1}},{"breakpoint": 576,"settings": {"slidesToShow": '.$settings['xsitems'].',"slidesToScroll": 1}}]}\'>';
            foreach ( $settings['items'] as $item ) {
                echo '<div class="col-xl-4">';
                    echo '<div class="testimonial-item text-center">';
                        if ( !empty( $item['image']['id'] ) ) {
                            echo '<div class="testi-avatar-img mb-20">';
                                echo wp_get_attachment_image( $item['image']['id'], $size, false, ['class'=>'t-img'] );
                            echo '</div>';
                        }
                        echo '<div class="testi-avatar-info">';
                            if ( !empty( $item['name'] ) ) {
                                echo '<'.$settings['ntag'].' class="name">'.$item['name'].'</'.$settings['ntag'].'>';
                            }
                            if ( !empty( $item['pos'] ) ) {
                                echo '<span class="position">'.$item['pos'].'</span>';
                            }
                            if ( 'yes' == $settings['stars'] ) {
                                echo '<div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>';
                            }
                        echo '</div>';
                        if ( !empty( $item['text'] ) ) {
                            echo '<div class="testi-content">';
                                echo '<p class="text">'.$item['text'].'</p>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            }
        echo '</div>';

    }
}
