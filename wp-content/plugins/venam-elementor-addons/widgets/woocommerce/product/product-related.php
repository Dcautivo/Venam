<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_WC_Product_Related extends Widget_Base {

	public function get_name() {
		return 'venam-wc-product-related';
	}

	public function get_title() {
		return __( 'Product Related', 'venam' );
	}

	public function get_icon() {
		return 'eicon-product-related';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'related', 'similar', 'product' ];
	}
    public function get_categories() {
		return [ 'venam-woo-product' ];
	}
	protected function register_controls() {
		$this->start_controls_section(
			'section_related_products_content',
			[
				'label' => __( 'Related Products', 'venam' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Products Per Page', 'venam' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
				'range' => [
					'px' => [
						'max' => 20,
					],
				],
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => __( 'Columns', 'venam' ),
				'type' => Controls_Manager::NUMBER,
				'prefix_class' => 'venamducts-columns%s-',
				'default' => 4,
				'min' => 1,
				'max' => 12,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'venam' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'Date', 'venam' ),
					'title' => __( 'Title', 'venam' ),
					'price' => __( 'Price', 'venam' ),
					'popularity' => __( 'Popularity', 'venam' ),
					'rating' => __( 'Rating', 'venam' ),
					'rand' => __( 'Random', 'venam' ),
					'menu_order' => __( 'Menu Order', 'venam' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'venam' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'venam' ),
					'desc' => __( 'DESC', 'venam' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => __( 'Heading', 'venam' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'show_heading',
			[
				'label' => __( 'Heading', 'venam' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'Hide', 'venam' ),
				'label_on' => __( 'Show', 'venam' ),
				'default' => 'yes',
				'return_value' => 'yes',
				'prefix_class' => 'show-heading-',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Color', 'venam' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-wc-products .products > h2' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_heading!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}}.elementor-wc-products .products > h2',
				'condition' => [
					'show_heading!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'heading_text_align',
			[
				'label' => __( 'Text Align', 'venam' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'venam' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'venam' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'venam' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-wc-products .products > h2' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'show_heading!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'heading_spacing',
			[
				'label' => __( 'Spacing', 'venam' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}}.elementor-wc-products .products > h2' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'show_heading!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
        global $product;

		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		$args = [
			'posts_per_page' => 4,
			'columns' => 4,
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
		];

		if ( ! empty( $settings['posts_per_page'] ) ) {
			$args['posts_per_page'] = $settings['posts_per_page'];
		}

		if ( ! empty( $settings['columns'] ) ) {
			$args['columns'] = $settings['columns'];
		}

		// Get visible related products then sort them at random.
		$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

		// Handle orderby.
		$args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

		wc_get_template( 'single-product/related.php', $args );

	}

	public function render_plain_content() {}
}
