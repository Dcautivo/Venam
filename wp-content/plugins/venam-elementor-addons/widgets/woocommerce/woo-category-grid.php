<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Woo_Category_Grid extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-woo-category-grid';
    }
    public function get_title() {
        return 'WC Categories (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'venam-woo' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'general_settings',
            [
                'label' => esc_html__('Product Categories', 'venam'),
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Per Page', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 10,
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
                'selectors' => [ '{{WRAPPER}} .best-cat-item' => '-ms-flex: 0 0 calc(100% / {{VALUE}} );flex: 0 0 calc(100% / {{VALUE}} );max-width: calc(100% / {{VALUE}} );' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'thumbnail'
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
                'condition' => [ 'type' => 'woo' ]
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
                'condition' => [ 'type' => 'woo' ]
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude',
                'separator' => 'after',
                'condition' => [ 'type' => 'woo' ]
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'venam' ),
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

        $cats = get_terms(
            array(
                'taxonomy' => 'product_cat',
                'number' => $settings['post_per_page'],
                'order' => $settings['order'],
                'orderby' => $settings['orderby'],
                'exclude' => $settings['category_exclude']
            )
        );

        echo '<div class="best-cat-list">';
            foreach ( $cats as $cat ) {
                $imgid = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                echo '<div class="best-cat-item">';
                    if ( $imgid ) {
                        echo '<div class="best-cat-thumb">';
                            echo '<a href="'.esc_url( get_term_link( $cat ) ).'" title="'.$cat->name.'">';
                                echo wp_get_attachment_image( $imgid, $size, false, ['class'=>'grid-cate--img'] );
                            echo '</a>';
                        echo '</div>';
                    }
                    echo '<div class="best-cat-content">';
                        echo '<'.$settings['tag'].'><a href="'.esc_url( get_term_link( $cat ) ).'">'.$cat->name.'</a></'.$settings['tag'].'>';
                        if ( $cat->description ) {
                            echo '<span>'.$cat->description.'</span>';
                        }
                    echo '</div>';
                echo '</div>';
            }
        echo '</div>';
    }
}
