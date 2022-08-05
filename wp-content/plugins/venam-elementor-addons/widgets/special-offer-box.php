<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Special_Offer extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-special-offer';
    }
    public function get_title() {
        return 'Special Offer (N)';
    }
    public function get_icon() {
        return 'eicon-products';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'items_settings',
            [
                'label' => esc_html__('Special Box List', 'venam'),
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
        $this->add_control( 'category',
            [
                'label' => esc_html__( 'Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'condition' => [ 'source' => 'wc' ]
            ]
        );
        $this->add_control( 'number',
            [
                'label' => esc_html__( 'Limit', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'condition' => [ 'source' => 'wc' ]
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'venam' ),
                    'DESC' => esc_html__( 'Descending', 'venam' )
                ],
                'default' => 'ASC',
                'condition' => [ 'source' => 'wc' ]
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'venam' ),
                    'menu_order' => esc_html__( 'Menu Order', 'venam' ),
                    'rand' => esc_html__( 'Random', 'venam' ),
                    'date' => esc_html__( 'Date', 'venam' ),
                    'title' => esc_html__( 'Title', 'venam' ),
                ],
                'default' => 'id',
                'condition' => [ 'source' => 'wc' ]
            ]
        );
        $this->add_control( 'box_title',
            [
                'label' => esc_html__( 'Box Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Clothing Shop',
                'label_block' => true,
                'separator' => 'before',
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
        $this->add_responsive_control( 'column',
            [
                'label' => esc_html__( 'Column Width', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 2,
                'selectors' => [ '{{WRAPPER}} .special--cat--list .special--cat--item' => '-ms-flex: 0 0 calc(100% / {{VALUE}} );flex: 0 0 calc(100% / {{VALUE}} );max-width: calc(100% / {{VALUE}} );' ]
            ]
        );
        $this->add_control( 'btn_link',
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
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Shop Now',
                'label_block' => true,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'Item Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Man Fashion',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'tag_title',
            [
                'label' => esc_html__( 'Tag', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'New!',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'link',
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
        $this->add_control( 'items',
            [
                'label' => esc_html__( 'Items', 'venam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'condition' => [ 'source' => 'custom' ],
                'default' => [
                    [ 'title' => 'Woman Fashion' ],
                    [ 'title' => 'Man Fashion' ],
                    [ 'title' => 'Cloth Toys' ],
                    [ 'title' => 'Baby Clothing' ],
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tagbg',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tag',
                'separator' => 'before'
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
                'selectors' => [ '{{WRAPPER}} .special-offer-item-box' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'box_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .special--cat--item--wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
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
        $this->add_control( 'boxtitle_sdivider',
            [
                'label' => esc_html__( 'BOX TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'boxtitle_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special-offer-title .title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .special-offer-title .title'
            ]
        );
        $this->add_control( 'title_sdivider',
            [
                'label' => esc_html__( 'ITEM TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special--cat--item .special--cat--name' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .special--cat--item .special--cat--name'
            ]
        );
        $this->add_control( 'tags_sdivider',
            [
                'label' => esc_html__( 'TAGS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'tags_color',
            [
                'label' => esc_html__( 'Tag Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special--cat--list .special--cat--item span' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'arrow_sdivider',
            [
                'label' => esc_html__( 'TOP BUTTON', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'arrow_width',
            [
                'label' => esc_html__( 'Width', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special-offer-title .view-more a i' => 'width:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'arrow_height',
            [
                'label' => esc_html__( 'Height', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .special-offer-title .view-more a i' => 'height:{{SIZE}}px;' ],
            ]
        );
        $this->start_controls_tabs( 'arrow_tabs');
        $this->start_controls_tab( 'arrow_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'arrow_bgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .special-offer-title .view-more a i' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .special-offer-title .view-more a i',
            ]
        );
        $this->add_responsive_control( 'arrow_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .special-offer-title .view-more a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'arrow_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'arrow_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .view-more a:hover i' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'arrow_hvrborder',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .view-more a:hover i',
            ]
        );
        $this->add_responsive_control( 'arrow_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .view-more a:hover i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'botbtn_sdivider',
            [
                'label' => esc_html__( 'BOTTOM BUTTON', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'botbtn_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .special--cat--item--wrap .shop-now'
            ]
        );
        $this->add_control( 'botbtn_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .special--cat--item--wrap .shop-now' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'botbtn_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .special--cat--item--wrap .shop-now:hover' => 'color:{{VALUE}};' ],
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
        $target = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
        $rel = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';

        if ( 'custom' == $settings['source'] ) {

            echo '<div class="special-offer-item-box">';
                echo '<div class="special--cat--item--wrap">';
                    if ( $settings['box_title'] || $settings['btn_link']['url'] ) {
                        echo '<div class="special-offer-title mb-35">';
                            if ( $settings['box_title'] ) {
                                echo '<'.$settings['tag'].' class="title">'.$settings['box_title'].'</'.$settings['tag'].'>';
                            }
                            if ( $settings['btn_link']['url'] ) {
                                echo '<div class="view-more">';
                                    echo '<a  href="'.$settings['btn_link']['url'].'"'.$target.$rel.'><i class="fas fa-angle-right"></i></a>';
                                echo '</div>';
                            }
                        echo '</div>';
                    }
                    echo '<ul class="special--cat--list">';
                        foreach ( $settings['items'] as $item ) {
                            $target2 = !empty( $item['link']['is_external'] ) ? ' target="_blank"' : '';
                            $rel2 = !empty( $item['link']['nofollow'] ) ? ' rel="nofollow"' : '';
                            $link = !empty( $item['link']['url'] ) ? $item['link']['url'] : '#0';
                            echo '<li class="special--cat--item">';
                                echo '<a href="'.$link.'"'.$target2.$rel2.'>';
                                    if ( !empty( $item['image']['id'] ) ) {
                                        echo wp_get_attachment_image( $item['image']['id'], $size, false, ['class'=>'cat--img'] );
                                    }
                                    if ( !empty( $item['tag_title'] ) ) {
                                        echo '<span class="tag">'.$item['tag_title'].'</span>';
                                    }
                                    if ( !empty( $item['title'] ) ) {
                                        echo '<span class="special--cat--name">'.$item['title'].'</span>';
                                    }
                                echo '</a>';
                            echo '</li>';
                        }
                    echo '</ul>';
                    if ( $settings['btn_title'] ) {
                        echo '<a  href="'.$settings['btn_link']['url'].'"'.$target.$rel.' class="shop-now">'.$settings['btn_title'].'</a>';
                    }
                echo '</div>';
            echo '</div>';

        } else {

            if ( class_exists( 'WooCommerce' ) ) {
                $cats = get_terms(
                    array(
                        'taxonomy' => 'product_cat',
                        'number' => $settings['number'],
                        'order' => $settings['order'],
                        'orderby' => $settings['orderby'],
                        'include' => $settings['category'],
                    )
                );
                echo '<div class="special-offer-item-box">';
                    echo '<div class="special--cat--item--wrap">';
                        if ( $settings['box_title'] || $settings['btn_link']['url'] ) {
                            echo '<div class="special-offer-title mb-35">';
                                if ( $settings['box_title'] ) {
                                    echo '<'.$settings['tag'].' class="title">'.$settings['box_title'].'</'.$settings['tag'].'>';
                                }
                                if ( $settings['btn_link']['url'] ) {
                                    echo '<div class="view-more">';
                                        echo '<a  href="'.$settings['btn_link']['url'].'"'.$target.$rel.'><i class="fas fa-angle-right"></i></a>';
                                    echo '</div>';
                                }
                            echo '</div>';
                        }
                        echo '<ul class="special--cat--list">';
                            foreach ( $cats as $cat ) {
                                $imgid = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                                $img = $imgid ? wp_get_attachment_image( $imgid, $size, false, ['class'=>'cat--img'] ) : wc_placeholder_img($size);
                                echo '<li class="special--cat--item">';
                                    echo '<a href="'.esc_url( get_term_link( $cat ) ).'">';
                                        if ( $img ) {
                                            echo $img;
                                        }
                                        if ( !empty( $item['tag_title'] ) ) {
                                            echo '<span class="tag">'.$item['tag_title'].'</span>';
                                        }
                                        echo '<span class="special--cat--name">'.$cat->name.'</span>';
                                    echo '</a>';
                                echo '</li>';
                            }
                        echo '</ul>';
                        if ( $settings['btn_title'] ) {
                            echo '<a  href="'.$settings['btn_link']['url'].'"'.$target.$rel.' class="shop-now">'.$settings['btn_title'].'</a>';
                        }
                    echo '</div>';
                echo '</div>';
            }
        }

    }
}
