<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Special_Offer_Single extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-special-single';
    }
    public function get_title() {
        return 'Special Offer Single (N)';
    }
    public function get_icon() {
        return 'eicon-image-box';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'items_settings',
            [
                'label' => esc_html__('Special Box Single', 'venam'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'source',
            [
                'label' => esc_html__( 'Data Source', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom' => esc_html__( 'Custom', 'venam' ),
                    'wc' => esc_html__( 'WC Product', 'venam' ),
                ]
            ]
        );
        $this->add_control( 'product',
            [
                'label' => esc_html__( 'Select Product', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => $this->get_all_posts_by_type('product'),
                'condition' => ['source' => 'wc']
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => ['source' => 'custom']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Clothing Shop',
                'label_block' => true,
                'condition' => ['source' => 'custom']
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
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
        $this->add_control( 'details',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'US $ 17.99<span>{ 50% off }</span>',
                'label_block' => true,
                'condition' => ['source' => 'custom']
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
                'condition' => ['source' => 'custom']
            ]
        );
        $this->add_control( 'saveprice',
            [
                'label' => esc_html__( 'Save Price', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['source' => 'wc']
            ]
        );
        $this->add_control( 'price_before',
            [
                'label' => esc_html__( 'Price Before', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'US',
                'condition' => ['source' => 'wc']
            ]
        );
        $this->add_control( 'save_after',
            [
                'label' => esc_html__( 'Save Price After', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'off',
                'condition' => ['source' => 'wc']
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'color',
            [
                'label' => esc_html__( 'Colors', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} {{CURRENT_ITEM}}.color' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'colors',
            [
                'label' => esc_html__( 'Colors', 'venam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<div background-color:{{color}};width: 20px;height: 20px;border-radius: 30px;"></div>',
                'default' => []
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
                'selectors' => ['{{WRAPPER}} .special-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
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
        $this->add_control( 'title_sdivider',
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
                'selectors' => [ '{{WRAPPER}} .special-single-item-content .title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special-single-item-content .title a:hover' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .special-single-item-content .title'
            ]
        );
        $this->add_control( 'details_sdivider',
            [
                'label' => esc_html__( 'DETAILS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'details_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .special-single-item-content p'
            ]
        );
        $this->add_control( 'details_color',
            [
                'label' => esc_html__( 'Currency Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special-single-item-content p' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'details_color2',
            [
                'label' => esc_html__( 'Save Price Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special-single-item-content p span' => 'color:{{VALUE}};' ]
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

        if ( 'custom' == $settings['source'] ) {
            $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
            $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
            echo '<div class="special-offer-item-box">';
                echo '<div class="special-single-item">';
                    if ( !empty( $settings['image']['id'] ) ) {
                        echo '<div class="special-single-item-thumb">';
                            echo '<a  href="'.$settings['link']['url'].'"'.$target.$rel.'>';
                                echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'cat--img'] );
                            echo '</a>';
                        echo '</div>';
                    }

                    echo '<div class="special-single-item-content">';
                        if ( !empty( $settings['title'] ) ) {
                            echo '<h5><a  href="'.$settings['link']['url'].'"'.$target.$rel.'>'.$settings['title'].'</a></h5>';
                        }
                        if ( !empty( $settings['title'] ) ) {
                            echo '<p>'.$settings['details'].'</p>';
                        }
                        if ( !empty( $settings['colors'] ) ) {
                            echo '<div class="product-color">';
                                foreach ( $settings['colors'] as $item ) {
                                    echo '<span class="elementor-repeater-item-' . $item['_id'] . ' color"></span>';
                                }
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        } else {

            if ( class_exists( 'WooCommerce' ) ) {
                global $product;
                $id = (int)$settings['product'];
                $product = wc_get_product( $id );
                if ( empty( $product ) ) {
                    return;
                }
                //var_dump( $product );
                echo '<div class="special-offer-item-box">';
                    echo '<div class="special-single-item">';

                        echo '<div class="special-single-item-thumb">';
                            echo '<a  href="'.get_permalink( $id ).'">';
                                //echo wp_get_attachment_image( $product->image_id, $size, false, ['class'=>'product--img'] );
                                echo get_the_post_thumbnail( $product->get_id(), $size );
                            echo '</a>';
                        echo '</div>';

                        echo '<div class="special-single-item-content">';
                            echo '<h5><a href="'.get_permalink( $id ).'">'.get_the_title($id).'</a></h5>';

                            $saving = '';
                            if ( 'yes' == $settings['saveprice'] && $product->is_on_sale() && ! $product->is_type('variable') ) {
                                $regular = (float) $product->get_regular_price();
                                $sale = (float) $product->get_price();
                                $saving = round( 100 - ( $sale / $regular * 100 ), 1 ) . '%';
                                $saving = '<span class="save--price">{ '.$saving.' '.$settings['save_after'].' }</span>';
                            }
                            $price_before = $settings['price_before'] ? $settings['price_before'].' ' : '';
                            echo '<p>'.$price_before.wc_price($product->get_price()).$saving.'</p>';

                            if ( !empty( $settings['colors'] ) ) {
                                echo '<div class="product-color">';
                                    foreach ( $settings['colors'] as $item ) {
                                        echo '<span class="elementor-repeater-item-' . $item['_id'] . ' color"></span>';
                                    }
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        }
    }
}
