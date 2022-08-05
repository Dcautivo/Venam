<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Woo_Tab_Slider extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-woo-tab-slider';
    }
    public function get_title() {
        return 'WC Tab Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'venam-woo' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper' ];
    }

    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_query_section',
            [
                'label' => esc_html__( 'Query', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 10
            ]
        );
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'Category Filter', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude'
            ]
        );
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
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
                'default' => 'DESC'
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
                'default' => 'id'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_settings_section',
            [
                'label' => esc_html__( 'Slider Options', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'perview',
            [
                'label' => esc_html__( 'Per View ( Desktop )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 6,
                'step' => 1,
                'default' => 3
            ]
        );
        $this->add_control( 'mdperview',
            [
                'label' => esc_html__( 'Per View ( Tablet )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2
            ]
        );
        $this->add_control( 'smperview',
            [
                'label' => esc_html__( 'Per View  ( Mobile )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 1000,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'navs',
            [
                'label' => esc_html__( 'Nav', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'space',
            [
                'label' => esc_html__( 'Space Between Items', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => ''
            ]
        );
        $this->add_control( 'mobile_options_heading',
            [
                'label' => esc_html__( 'MOBILE OPTIONS', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'mobspace',
            [
                'label' => esc_html__( 'Space Between Items', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => ''
            ]
        );
        $this->add_control( 'mobnavs',
            [
                'label' => esc_html__( 'Nav', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'mobdots',
            [
                'label' => esc_html__( 'Dots', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'mobautoplay',
            [
                'label' => esc_html__( 'Autoplay', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('tab_style_section',
            [
                'label'=> esc_html__( 'Tab Style', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'tab_clr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .tab_nav_item' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'tab_hvrclr',
           [
               'label' => esc_html__( 'Hover/Active Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .tab_nav_item:hover,{{WRAPPER}} .tab_nav_item.is-active ' => 'color: {{VALUE}};',
                   '{{WRAPPER}} .tab_nav_item:after' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'tab_spacing',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .tab_nav_item:not(:last-child)' => 'margin-right: {{SIZE}}px;']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .tab_nav_item'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('post_style_section',
            [
                'label' => esc_html__( 'Post Style', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'post_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce.exclusive-item.exclusive-item-three' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .woocommerce.exclusive-item.exclusive-item-three'
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .exclusive-item-three .exclusive-item-content h5 a'
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive-item-three .exclusive-item-content h5 a' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive-item-three .exclusive-item-content h5 a:hover' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'price_heading',
            [
                'label' => esc_html__( 'PRICE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'price_hvrcolor',
            [
                'label' => esc_html__( 'Price Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .div.product p.price del, {{WRAPPER}} .woocommerce div.product span.price del' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'price_hvrcolor2',
            [
                'label' => esc_html__( 'Price Color 2', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce div.product span.price' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .woocommerce div.product span.price'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'navs' => 'yes' ]
            ]
        );
        $this->add_control( 'nav_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-next,{{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-prev' => 'width: {{SIZE}}px;height: {{SIZE}}px;']
            ]
        );
        $this->add_control( 'nav_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-next,{{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-prev' => 'font-size: {{SIZE}}px;']
            ]
        );
        $this->start_controls_tabs( 'nav_tabs');
        $this->start_controls_tab( 'nav_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'nav_bgclr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next,{{WRAPPER}} .slide-controls .swiper-button-prev' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_clr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next,{{WRAPPER}} .slide-controls .swiper-button-prev' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .slide-controls .swiper-button-next,{{WRAPPER}} .slide-controls .swiper-button-prev',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'nav_hvrbgclr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next:hover,{{WRAPPER}} .slide-controls .swiper-button-prev:hover' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_hvrclr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next:hover,{{WRAPPER}} .slide-controls .swiper-button-prev:hover' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvr_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .slide-controls .swiper-button-next:hover,{{WRAPPER}} .slide-controls .swiper-button-prev:hover',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'prev_heading',
            [
                'label' => esc_html__( 'PREV POSITION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'next_heading',
            [
                'label' => esc_html__( 'NEXT POSITION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'next_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();

        $speed       = $settings['speed'] ? $settings['speed'] : 1000;
        $perview     = $settings['perview'] ? $settings['perview'] : 3;
        $mdperview   = $settings['mdperview'] ? $settings['mdperview'] : 3;
        $smperview   = $settings['smperview'] ? $settings['smperview'] : 2;
        $space       = $settings['space'] ? $settings['space'] : 15;
        $autoplay    = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $mobnavs     = 'yes' == $settings['mobnavs'] ? 'true' : 'false';
        $mobdots     = 'yes' == $settings['mobdots'] ? 'true' : 'false';
        $mobautoplay = 'yes' == $settings['mobautoplay'] ? 'true' : 'false';
        $mobspace    = $settings['mobspace'] ? $settings['mobspace'] : 5;

        $tabs = get_terms(
            array(
                'taxonomy' => 'product_cat',
                'order' => $settings['order'],
                'orderby' => $settings['orderby'],
                'exclude' => $settings['category_exclude']
            )
        );

        $count = 1;
        $counttwo = 1;

        echo '<div class="wc-tab-slider show-items-'.$perview.'" data-per-page="'.$settings['post_per_page'].'">';
            echo '<div class="tab">';
                if ( $tabs ) {

                    echo '<div class="tab_nav">';
                        foreach ( $tabs as $tab ) {
                            $is_active = 1 == $count ? ' is-active loaded' : '';
                            if ( $tab->name ) {
                            	echo '<a class="tab_nav_item'.$is_active.'" href="#" data-cat-id="'.$tab->term_id.'" data-scope-id="thm-tab-'.$elementid.'">'.$tab->name.'</a>';
                            }
                            $count++;
                        }
                    echo '</div>';
                }

                foreach ( $tabs as $tab ) {
                    $is_active = 1 == $counttwo ? ' is-active' : '';
                    echo '<div class="tab_slider tab_page'.$is_active.'" data-cat-id="'.$tab->term_id.'">';
                        echo '<div class="thm-tab-slider swiper-container thm-tab-'.$elementid.'" data-scope-id="thm-tab-'.$elementid.'" data-swiper-options=\'{"slidesPerView": 1,"spaceBetween": '.$space.',"speed": '.$speed.',"loop": false,"autoplay": '.$autoplay.',"pagination": {"el": ".thm-tab-'.$elementid.' .swiper-pagination-'.$tab->term_id.'","type": "bullets","clickable": true},"navigation": {"nextEl": ".thm-tab-'.$elementid.' .slide-next-'.$tab->term_id.'","prevEl": ".thm-tab-'.$elementid.' .slide-prev-'.$tab->term_id.'"},"breakpoints": {"0": {"slidesPerView": '.$smperview.'},"768": {"slidesPerView": '.$mdperview.',"spaceBetween": '.$mobspace.',"navigation":'.$mobnavs.',"pagination":'.$mobdots.'},"1025": {"slidesPerView": '.$perview.',"spaceBetween": '.$space.',"pagination":false}}}\'>';
                            echo '<div class="swiper-wrapper">';
                                $args = array(
                                    'post_type'      => 'product',
                                    'posts_per_page' => $settings['post_per_page'],
                                    'order'          => $settings['order'],
                                    'orderby'        => $settings['orderby'],
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'id',
                                            'terms' => $tab->term_id
                                        )
                                    )
                                );
                                $the_query = new \WP_Query( $args );
                                if ( $the_query->have_posts() && 1 == $counttwo ) {
                                    while ( $the_query->have_posts() ) {
                                        $the_query->the_post();
                                        $product = new \WC_Product(get_the_ID());

                                        echo '<div class="swiper-slide product_item">';
                                            wc_get_template_part( 'content', 'product' );
                                        echo '</div>';
                                    }
                                }
                                wp_reset_postdata();
                            echo '</div>';
                            if ( 'yes' == $settings['mobdots'] ) {
                                echo '<div class="swiper-pagination swiper-pagination-'.$tab->term_id.'"></div>';
                            }
                            if ( 'yes' == $settings['navs'] ) {
                                echo '<div class="swiper-button-prev slide-prev-'.$tab->term_id.'"><i class="fas fa-angle-left"></i></div>';
                                echo '<div class="swiper-button-next slide-next-'.$tab->term_id.'"><i class="fas fa-angle-right"></i></div>';
                            }
                        echo '</div>';
                    echo '</div>';
                    $counttwo++;
                }
            echo '<svg class="loader-svg-image" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>';
            echo '</div>';
        echo '</div>';
    }
}
