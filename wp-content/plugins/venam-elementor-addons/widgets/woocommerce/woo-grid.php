<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Woo_Grid extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-woo-grid';
    }
    public function get_title() {
        return 'WC Products Grid (N)';
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
        $this->start_controls_section( 'post_query_scenario_section',
            [
                'label' => esc_html__( 'Query', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'col',
            [
                'label' => esc_html__( 'Column', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'default' => 4,
                'selectors' => ['{{WRAPPER}} .products.wc--row .col' => '-ms-flex: 0 0 calc(100% / {{VALUE}} );flex: 0 0 calc(100% / {{VALUE}} );max-width: calc(100% / {{VALUE}} );']
            ]
        );
		$this->add_control('column_gap',
			[
				'label' => __( 'Columns Gap', 'venam' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors' => [ 
				    '{{WRAPPER}} .products.wc--row .col' => 'padding: 0 {{SIZE}}px;margin-bottom: {{SIZE}}px;',
				    '{{WRAPPER}} .products.wc--row' => 'margin: 0 -{{SIZE}}px -{{SIZE}}px -{{SIZE}}px;'
				]
			]
		);
        $this->add_control( 'limit',
            [
                'label' => esc_html__( 'Posts Per Page', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count( get_posts( array('post_type' => 'product', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default' => 12
            ]
        );
        $this->add_control( 'scenario',
            [
                'label' => esc_html__( 'Select Scenerio', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'newest' => esc_html__( 'Newest', 'venam' ),
                    'featured' => esc_html__( 'Featured', 'venam' ),
                    'popularity' => esc_html__( 'Popularity', 'venam' ),
                    'best' => esc_html__( 'Best Selling', 'venam' ),
                    'attr' => esc_html__( 'Attribute Display', 'venam' ),
                    'custom_cat' => esc_html__( 'Specific Categories', 'venam' ),
                ],
                'default' => 'newest'
            ]
        );
        $this->add_control( 'paginate',
            [
                'label' => esc_html__( 'Pagination', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hr0',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [ 'scenario' => 'attr' ]
            ]
        );
        $this->add_control( 'attribute',
            [
                'label' => esc_html__( 'Select Attribute', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_woo_attributes(),
                'description' => 'Select Attribute(s)',
                'condition' => [ 'scenario' => 'attr' ]
            ]
        );
        $this->add_control( 'attr_terms',
            [
                'label' => esc_html__( 'Select Attribute Terms', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_woo_attributes_taxonomies(),
                'description' => 'Select Attribute(s)',
                'condition' => [ 'scenario' => 'attr' ]
            ]
        );
        $this->add_control( 'hr1',['type' => Controls_Manager::DIVIDER]);

        $this->add_control( 'cat_filter',
            [
                'label' => esc_html__( 'Filter Category', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
            ]
        );
        $this->add_control( 'cat_operator',
            [
                'label' => esc_html__( 'Category Operator', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'AND' => esc_html__( 'display all of the chosen categories', 'venam' ),
                    'IN' => esc_html__( 'display products within the chosen category', 'venam' ),
                    'NOT IN' => esc_html__( 'display products that are not in the chosen category.', 'venam' ),
                ],
                'default' => 'AND',
                'condition' => [ 'scenario' => 'custom_cat' ]
            ]
        );

        $this->add_control( 'hr2',['type' => Controls_Manager::DIVIDER]);

        $this->add_control( 'tag_filter',
            [
                'label' => esc_html__( 'Filter Tag(s)', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->venam_cpt_taxonomies('product_tag','name'),
                'description' => 'Select Tag(s)',
            ]
        );
        $this->add_control( 'tag_operator',
            [
                'label' => esc_html__( 'Tags Operator', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'AND' => esc_html__( 'display all of the chosen tags', 'venam' ),
                    'IN' => esc_html__( 'display products within the chosen tags', 'venam' ),
                    'NOT IN' => esc_html__( 'display products that are not in the chosen tags.', 'venam' ),
                ],
                'default' => 'AND',
            ]
        );

        $this->add_control( 'hr3',['type' => Controls_Manager::DIVIDER]);

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
                    'popularity' => esc_html__( 'Popularity', 'venam' ),
                    'rand' => esc_html__( 'Random', 'venam' ),
                    'rating' => esc_html__( 'Rating', 'venam' ),
                    'date' => esc_html__( 'Date', 'venam' ),
                    'title' => esc_html__( 'Title', 'venam' ),
                ],
                'default' => 'id',
                'condition' => [ 'scenario!' => 'custom_cat' ]
            ]
        );
        $this->add_control( 'cat_orderby',
            [
                'label' => esc_html__( 'Order By', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'venam' ),
                    'menu_order' => esc_html__( 'Menu Order', 'venam' ),
                    'name' => esc_html__( 'Name', 'venam' ),
                    'slug' => esc_html__( 'Slug', 'venam' ),
                ],
                'default' => 'id',
                'condition' => [ 'scenario' => 'custom_cat' ]
            ]
        );
        $this->add_control( 'show_cat_empty',
            [
                'label' => esc_html__( 'Show Empty Categories', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'venam' ),
                'label_off' => esc_html__( 'No', 'venam' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [ 'scenario' => 'custom_cat' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('post_style_section',
            [
                'label' => esc_html__( 'Post Style', 'venam' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'post_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce.exclusive-item.exclusive-item-three' => 'background-color: {{VALUE}};',
                ]
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
                'separator' => 'before',
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
        $this->add_control( 'title_heading',
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
        $this->add_control( 'price_hvrcolor',
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

    }

    public function set_column() {
        $settings = $this->get_settings_for_display();

        $col[] = 'row-cols-1';
        $col[] = $settings['colsm'] ? 'row-cols-sm-' . $settings['colsm'] : 'row-cols-sm-2';
        $col[] = $settings['collg'] ? 'row-cols-lg-' . $settings['collg'] : 'row-cols-lg-3';
        $col[] = $settings['collg'] ? 'row-cols-xl-' . $settings['colxl'] : 'row-cols-xl-4';

        return implode( ' ', $col );
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();
        add_filter('venam_products_column', array( $this, 'set_column' ) );

        $limit = 'limit="'.$settings['limit'].'"';
        $order = ' order="'.$settings['order'].'"';
        $orderby = ' orderby="'.$settings['orderby'].'"';
        $paginate = 'yes'== $settings['paginate'] ? ' paginate="true"' : '';
        $hide_empty = 'yes'== $settings['show_cat_empty'] ? ' hide_empty="0"' : '';
        $operator = ' cat_operator="'.$settings['cat_operator'].'"';
        $tag_operator = ' tag_operator="'.$settings['tag_operator'].'"';
        $cat_orderby = ' orderby="'.$settings['cat_orderby'].'"';
        $cat_filter = is_array($settings['cat_filter']) ? ' category="'.implode(', ',$settings['cat_filter']).'"' : '';
        $hide_empty_cat = 'yes'== $settings['show_cat_empty'] ? ' hide_empty="0"' : '';
        $tag_filter = is_array($settings['tag_filter']) ? ' tag="'.implode(', ',$settings['tag_filter']).'"' : '';
        $attr_filter = is_array($settings['attribute']) ? ' attribute="'.implode(', ',$settings['attribute']).'"' : '';
        $attr_terms = is_array($settings['attr_terms']) ? ' terms="'.implode(', ',$settings['attr_terms']).'"' : '';
        echo '<div class="section-custom-categories">';
            if ( 'newest' == $settings['scenario'] ) {
                echo do_shortcode('[products '.$limit.$orderby.$order.$tag_filter.$paginate.' visibility="visible"]');
            } elseif ( 'featured' == $settings['scenario'] ) {
                echo do_shortcode('[products '.$limit.$orderby.$order.$tag_filter.$paginate.' visibility="featured"]');
            } elseif ( 'popularity' == $settings['scenario'] ) {
                echo do_shortcode('[products '.$limit.$order.$tag_filter.$paginate.' orderby="popularity" on_sale="true"]');
            } elseif ( 'best' == $settings['scenario'] ) {
                echo do_shortcode('[products '.$limit.$orderby.$order.$cat_filter.$operator.$hide_empty_cat.$tag_filter.$paginate.' best_selling="true"]');
            } elseif ( 'custom_cat' == $settings['scenario'] ) {
                echo do_shortcode('[products '.$limit.$cat_orderby.$order.$cat_filter.$operator.$hide_empty_cat.$tag_filter.$paginate.']');
            } elseif ( 'attr' == $settings['scenario'] ) {
                echo do_shortcode('[products '.$limit.$attr_filter.$attr_terms.$limit.$orderby.$order.$paginate.']');
            } else {
                echo do_shortcode('[products '.$limit.$orderby.$order.$tag_filter.$operator.$paginate.' visibility="visible"]');
            }
        echo '</div>';
        remove_filter('venam_products_column', array( $this, 'set_column' ) );
    }
}
