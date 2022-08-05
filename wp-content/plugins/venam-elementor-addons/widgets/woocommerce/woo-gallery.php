<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Woo_Gallery extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-woo-gallery';
    }
    public function get_title() {
        return 'WC Gallery (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'venam-woo' ];
    }
    public function get_script_depends() {
        return [ 'imagesloaded','isotope' ];
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
        $this->add_control( 'scenario',
            [
                'label' => esc_html__( 'Select Scenario', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'featured' => esc_html__( 'Featured', 'venam' ),
                    'on-sale' => esc_html__( 'On Sale', 'venam' ),
                    'best' => esc_html__( 'Best Selling', 'venam' ),
                    'custom' => esc_html__( 'Specific Categories', 'venam' ),
                ],
                'default' => 'custom'
            ]
        );
        $this->add_control( 'layoutmode',
            [
                'label' => esc_html__( 'Layout Mode', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fitRows' => esc_html__( 'fitRows', 'venam' ),
                    'masonry' => esc_html__( 'masonry', 'venam' ),
                ],
                'default' => 'masonry'
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 20
            ]
        );
        $this->add_responsive_control( 'column',
            [
                'label' => esc_html__( 'Column Width', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 3,
                'selectors' => [ '{{WRAPPER}} .grid-item' => '-ms-flex: 0 0 calc(100% / {{VALUE}} );flex: 0 0 calc(100% / {{VALUE}} );max-width: calc(100% / {{VALUE}} );' ]
            ]
        );
        $this->add_control( 'hide_filters',
            [
                'label' => esc_html__( 'Hide Filters', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes'
            ]
        );
        $this->add_responsive_control( 'col_filter',
            [
                'label' => esc_html__( 'Filter Container Width ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 50,
                'max' => 100,
                'default' => 75,
                'selectors' => ['{{WRAPPER}} .col-filter' => '-ms-flex: 0 0 {{VALUE}}%;flex: 0 0 {{VALUE}}%;max-width: {{VALUE}}%;'],
                'condition' => [ 'hide_filters!' => 'yes' ]
            ]
        );
        $this->add_control( 'all_text',
            [
                'label' => esc_html__( 'All Text', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'All Products',
                'label_block' => true,
                'condition' => [ 'hide_filters!' => 'yes' ]
            ]
        );
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'CATEGORY', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'category_include',
            [
                'label' => esc_html__( 'Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'POST', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'post_exclude',
            [
                'label' => esc_html__( 'Exclude Post', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Post(s) to Exclude',
            ]
        );
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'OTHER FILTER', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
                'default' => 'id',
            ]
        );
        $this->add_control( 'bannerimg_heading',
            [
                'label' => esc_html__( 'BANNER IMAGE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Banner Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail2',
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Banner Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
            ]
        );
        $this->add_control( 'hidesale',
            [
                'label' => esc_html__( 'Hide Sale Flash', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hideattr',
            [
                'label' => esc_html__( 'Hide Attribute', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hidesave',
            [
                'label' => esc_html__( 'Hide Save Price', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hiderating',
            [
                'label' => esc_html__( 'Hide Rating', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hidebrand',
            [
                'label' => esc_html__( 'Hide Brand', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hidetimer',
            [
                'label' => esc_html__( 'Hide Timer', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('style_section',
            [
                'label' => esc_html__( 'STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'filter_heading',
            [
                'label' => esc_html__( 'FILTER', 'venam' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'filter_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .product-menu' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filter_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .product-menu button',
            ]
        );
        $this->add_control( 'filter_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .product-menu button' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'filter_hvrcolor',
            [
                'label' => esc_html__( 'Active Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .product-menu button:hover, {{WRAPPER}} .product-menu button.active' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'box_heading',
            [
                'label' => esc_html__( 'POST BOX', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'post_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive-item' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control( 'box_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .exclusive-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .exclusive-item',
            ]
        );
        $this->add_responsive_control( 'post_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .exclusive-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'post_hvrbordercolor',
            [
                'label' => esc_html__( 'Hover Border Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive-item:hover' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .exclusive--content--bottom .title a',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive--content--bottom .title a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive--content--bottom .title:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'stars_heading',
            [
                'label' => esc_html__( 'STARS', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'stars_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive--content--top .rating i' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'price_heading',
            [
                'label' => esc_html__( 'PRICE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'price_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive--content--top .old-price' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'sale_price_color',
            [
                'label' => esc_html__( 'Sale Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .exclusive--content--bottom span' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    public function thumb_size() {
        $settings = $this->get_settings_for_display();
        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        return $size;
    }
    protected function render() {
        //global $wp_query;
        $settings = $this->get_settings_for_display();
        $elementid = $this->get_id();

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $settings['post_per_page'],
            'post__not_in' => $settings['post_exclude'],
            'order' => $settings['order']
        );

        if ( 'featured' == $settings['scenario'] ) {
           $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                )
            );

        } elseif( 'on-sale' == $settings['scenario'] ) {

            $args['meta_query'] = array(
                'relation' => 'OR',
                array( // Simple products type
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                ),
                array( // Variable products type
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                )
            );

        } elseif( 'best' == $settings['scenario'] ) {

            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';

        } else {

            $args['orderby'] = $settings['orderby'];

        }

        if ( $settings['category_include'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $settings['category_include'],
                    'operator' => 'IN'
                )
            );
        }

        $product_cat_args = array (
            'taxonomy' => 'product_cat',
            'order' => $settings['order'],
            'orderby' => $settings['orderby'],
            'hide_empty' => true,
            'parent' => 0,
            'include' => $settings['category_include'],
        );
        $isedit = \Elementor\Plugin::$instance->editor->is_edit_mode() ? ' gallery_editor_'.$elementid : ' gallery_front';
        echo '<div class="gallery-products__wrapper'.$isedit.'" data-isotope-options=\'{"itemSelector": ".grid-item","percentPosition": true,"layoutMode": "'.$settings['layoutmode'].'","masonry": {"columnWidth": ".grid-sizer"}}\'>';

            $cats = get_terms( $product_cat_args );
            if ( 'yes' != $settings['hide_filters'] && 'custom' == $settings['scenario'] && $cats > 1 ) {

                echo '<div class="row justify-content-center">';
                    echo '<div class="col-xl-6 col-lg-8 col-filter">';
                        echo '<div class="product-menu mb-60">';
                            if ( $settings['all_text'] ) {
                                echo '<button class="active" data-filter="*">'.$settings['all_text'].'</button>';
                            }
                            foreach ($cats as $cat) {
                                $filter_item = strtolower( str_replace(' ', '-', $cat->name) );
                                echo '<button class="" data-filter=".'.$filter_item.'">'.$cat->name.'</button>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            }

            $size2 = $settings['thumbnail2_size'] ? $settings['thumbnail2_size'] : 'full';
            if ( 'custom' == $size2 ) {
                $sizew = $settings['thumbnail2_custom_dimension']['width'];
                $sizeh = $settings['thumbnail2_custom_dimension']['height'];
                $size2 = [ $sizew, $sizeh ];
            }

            $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
            $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';

            $colgallery = $settings['image']['id'] ? '9' : '12';

            add_filter( 'venam_product_thumb_size', [ $this, 'thumb_size' ] );

            $the_query = new \WP_Query( $args );
            if( $the_query->have_posts() ) {

                echo '<div class="row justify-content-center nmb-40">';
                    if ( $settings['image']['id'] ) {
                        echo '<div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-0">';
                            echo '<div class="special-offer-banner exclusive-banner mb-40">';
                            echo '<a href="'.$settings['link']['url'].'"'.$target.$rel.'>';
                                echo wp_get_attachment_image( $settings['image']['id'], $size2, false, ['class'=>'banner--img'] );
                            echo '</a>';
                            echo '</div>';
                        echo '</div>';
                    }

                    echo '<div class="col-lg-'.$colgallery.'">';
                        echo '<div class="row exclusive-active">';
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            global $product;
                            $terms = $product->get_category_ids();
                            $termname = array();
                            foreach ( $terms as $term ) {
                                $term = get_term_by( 'id', $term, 'product_cat' );
                                array_push( $termname, strtolower( str_replace(' ', '-', $term->name) ) );
                            }

                            echo '<div class="grid-item grid-sizer '.implode(' ', $termname).'">';

                                echo '<div class="woocommerce exclusive-item exclusive-item-two mb-40">';
                                    echo '<div class="exclusive-item-thumb">';
                                            do_action( 'venam_loop_product_thumb' );
                                            venam_product_discount();
                                            venam_product_badge();
                                            do_action( 'venam_loop_product_buttons' );
                                    echo '</div>';
                                    echo '<div class="exclusive-item-content">';
                                        echo '<div class="exclusive--content--top">';

                                            if ( has_tag() && '2' == $settings['type'] ) {
                                                echo '<div class="tag">';
                                                    echo venam_product_tags();
                                                echo '</div>';
                                            } else {
                                                if ( wc_review_ratings_enabled() && $product->get_average_rating() ) {
                                                    echo '<div class="rating">';
                                                        woocommerce_template_loop_rating();
                                                    echo '</div>';
                                                } else {
                                                    echo '<div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>';
                                                }
                                            }

                                            if ( $product->is_on_sale() && $product->get_regular_price() ) {
                                                echo '<del class="old-price">'.wc_price( $product->get_regular_price() ).'</del>';
                                            }
                                        echo '</div>';
                                        echo '<div class="exclusive--content--bottom">';
                                            echo '<h5 class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
                                            if ( $product->is_on_sale() && $product->get_sale_price() ) {
                                                echo '<span>'.wc_price( $product->get_price() ).'</span>';
                                            } else {
                                                if ( $product->get_regular_price() ) {
                                                    echo '<span>'.wc_price( $product->get_regular_price() ).'</span>';
                                                }
                                            }
                                        echo '</div>';
                                        echo do_action( 'venam_loop_after_product_content' );
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        echo '</div>';
        wp_reset_postdata();
        remove_filter( 'venam_product_thumb_size', [ $this, 'thumb_size' ] );


        // Not in edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
            <script>

            jQuery(document).ready(function ($) {
                function venamIsotopee() {
                    const $this = $('.gallery_editor_<?php echo $elementid; ?>');
                    const gallery = $this.find('.exclusive-active');
                    const filter = $this.find('.product-menu');
                    const filterbtn = $this.find('.product-menu button');
                    gallery.imagesLoaded(function () {
                        // init Isotope
                        var $grid = gallery.isotope({
                            itemSelector: '.grid-item',
                            percentPosition: true,
                            layoutMode: '<?php echo $settings['layoutmode']; ?>',
                            masonry: {
                                columnWidth: '.grid-sizer',
                            }
                        });
                        // filter items on button click
                        filter.on('click', 'button', function () {
                            var filterValue = $(this).attr('data-filter');
                            $grid.isotope({ filter: filterValue });
                        });
                    });
                    //for menu active class
                    filterbtn.on('click', function (event) {
                        $(this).siblings('.active').removeClass('active');
                        $(this).addClass('active');
                        event.preventDefault();
                    });
                }
                venamIsotopee();
            });

            </script>
            <?php
        }
    }
}
