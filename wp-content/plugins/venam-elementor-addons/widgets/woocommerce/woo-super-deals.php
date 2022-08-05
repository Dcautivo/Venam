<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Woo_Super_Deals extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-woo-super-deals';
    }
    public function get_title() {
        return 'WC Super Deals (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'venam-woo' ];
    }
    public function get_script_depends() {
        return [ 'jquery-countdown' ];
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
                    '' => esc_html__( 'Select a scenario', 'venam' ),
                    'featured' => esc_html__( 'Featured', 'venam' ),
                    'on-sale' => esc_html__( 'On Sale', 'venam' ),
                    'best' => esc_html__( 'Best Selling', 'venam' ),
                    'custom' => esc_html__( 'Specific Categories', 'venam' ),
                ],
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hide_outofstock',
            [
                'label' => esc_html__( 'Hide Product Out of Stock', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before'
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
        $this->add_responsive_control( 'column',
            [
                'label' => esc_html__( 'Column Width', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 4,
                'selectors' => [ '{{WRAPPER}} .super-deal-area .col' => '-ms-flex: 0 0 calc(100% / {{VALUE}} );flex: 0 0 calc(100% / {{VALUE}} );max-width: calc(100% / {{VALUE}} );' ],
            ]
        );
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'Category Filter', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'scenario' => 'custom' ]
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
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'Post Filter', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_include',
            [
                'label' => esc_html__( 'Specific Post(s)', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Specific Post(s)',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_exclude',
            [
                'label' => esc_html__( 'Exclude Post', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Post(s) to Exclude',
                'separator' => 'after',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'venam' ),
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
        $this->add_control( 'rating',
            [
                'label' => esc_html__( 'Product Rating', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
				'separator' => 'before',
            ]
        );
        $this->add_control( 'hidesale',
            [
                'label' => esc_html__( 'Hide Sale Flash', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'price_before',
            [
                'label' => esc_html__( 'Price Before', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'US',
            ]
        );
        $this->add_control( 'hidesave',
            [
                'label' => esc_html__( 'Hide Save Price', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'save_after',
            [
                'label' => esc_html__( 'Save Price After', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'off',
                'condition' => [ 'hidesave!' => 'yes' ]
            ]
        );
        $this->add_control( 'hidetimer',
            [
                'label' => esc_html__( 'Hide Timer', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'venam-square',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('countdown_settings',
            [
                'label' => esc_html__( 'Countdown Settings', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'hidetimer!' => 'yes' ]
            ]
        );
        $this->add_control( 'ctitle',
            [
                'label' => esc_html__( 'Time Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Super Deals <span>End in</span>',
            ]
        );
        $this->add_control( 'date',
            [
                'label' => esc_html__( 'Time', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Usage : 2030/01/01', 'venam' ),
                'default' => '2030/01/01',
            ]
        );
        $this->add_control( 'hr',
            [
                'label' => esc_html__( 'Hour', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Hr'
            ]
        );
        $this->add_control( 'min',
            [
                'label' => esc_html__( 'Minute', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Min'
            ]
        );
        $this->add_control( 'sec',
            [
                'label' => esc_html__( 'Second', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sec'
            ]
        );
        $this->add_control( 'link_title',
            [
                'label' => esc_html__( 'Button Text', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'View More'
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
    }
    public function venam_product_loop( $args= null ) {
        $s = $this->get_settings_for_display();
        $id = $this->get_id();

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $s['post_per_page'],
            'post__in' => $s['post_include'],
            'post__not_in' => $s['post_exclude'],
            'order' => $s['order']
        );

        if ( 'featured' == $s['scenario'] ) {
           $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                )
            );
            $args['orderby'] = $s['orderby'];

        } elseif ( 'on-sale' == $s['scenario'] ) {

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

        } elseif ( 'best' == $s['scenario'] ) {

            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';

        } else {

            $args['orderby'] = $s['orderby'];

        }
        if ( $s['category_include'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $s['category_include'],
                    'operator' => 'IN'
                )
            );
        }
        if ( $s['category_exclude'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $s['category_exclude'],
                    'operator' => 'NOT IN'
                )
            );
        }
        $size = $s['thumbnail_size'] ? $s['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $s['thumbnail_custom_dimension']['width'];
            $sizeh = $s['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $html = '';
        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $product = new \WC_Product( get_the_ID() );

                $saving = '';
                if ( 'yes' != $s['hidesave'] && $product->is_on_sale() && ! $product->is_type('variable') ) {
                    $regular = (float) $product->get_regular_price();
                    $sale = (float) $product->get_sale_price();
                    $saving = $regular && $sale ? round( 100 - ( $sale / $regular * 100 ), 0 ) . '%' : '';
                    $saving = $saving ? '<span class="save--price">{ '.$saving.' '.$s['save_after'].' }</span>' : '';
                }
                $price_before = $s['price_before'] ? $s['price_before'].' ' : '';
                $hide_product = 'yes' == $s['hide_outofstock']  ? ' venam-hidden-product' : '';
                ob_start();
                ?>
                <div <?php wc_product_class( 'col item-column'.$hide_product, $product ); ?>>
                <?php
                echo ob_get_clean();
                    echo '<div class="super-deals-item text-center mb-55">';
                        echo '<div class="super-deal-thumb mb-25">';
                            if ( 'yes' != $s['hidesale'] ) {
                                venam_product_badge();
                            }
                            echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail( get_the_ID(), $size ).'</a>';
                            //ob_start();
                            do_action( 'venam_loop_product_buttons' );
                            //echo ob_get_clean();
                        echo '</div>';
                        echo '<div class="super-deal-content">';
                            if ( 'yes' == $s['rating'] ) {
                                if ( wc_review_ratings_enabled() && $product->get_average_rating() ) {
                                    echo '<div class="rating rating-empty">';
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
                            echo '<h6><a href="'.get_permalink().'">'.get_the_title().'</a></h6>';
                            $price_html = '<p>'.$price_before.wc_price($product->get_price()).$saving.'</p>';
                            echo apply_filters('venam_widget_product_price', $price_html);
                        echo '</div>';
                        echo do_action( 'venam_loop_after_product_content' );
                    echo '</div>';
                echo '</div>';
            }
        }
        wp_reset_postdata();

    }

    protected function render() {
        $s  = $this->get_settings_for_display();
        $id = $this->get_id();

        echo '<div class="super-deal-area pb-40">';
            if ( $s['date'] || $s['ctitle'] ) {
                $cdata = 'data-countdown=\'{"date":"'.$s['date'].'","hr":"'.$s['hr'].'","min":"'.$s['min'].'","sec":"'.$s['sec'].'"}\'';
                echo '<div class="super-deal-top">';
                    echo '<div class="row align-items-center justify-content-end">';
                        $column = $s['link_title'] ? 'col-xl-10 col-lg-10' : 'col-12';
                        echo '<div class="'.$column.'">';
                            echo '<div class="super-deal-title">';
                                if ( $s['ctitle'] ) {
                                    echo '<h3 class="c-title">'.$s['ctitle'].'</h3>';
                                    echo '<span class="super-deal-title-left-shape"></span>';
                                    echo '<span class="super-deal-title-right-shape"></span>';
                                }
                                if ( $s['date'] ) {
                                    echo '<div class="coming-time" '.$cdata.'></div>';
                                }
                            echo '</div>';
                        echo '</div>';

                        if ( $s['link_title'] ) {
                            echo '<div class="col-lg-2 d-none d-lg-block">';
                                echo '<div class="view-more text-right pr-20">';
                                    echo '<a href="'.$s['link']['url'].'"><span>'.$s['link_title'].'</span><i class="fas fa-angle-right"></i></a>';
                                echo '</div>';
                            echo '</div>';
                        }

                    echo '</div>';
                echo '</div>';
            }

            echo '<div class="row justify-content-center">';
                echo $this->venam_product_loop( $args = null );
            echo '</div>';
        echo '</div>';

    }
}
