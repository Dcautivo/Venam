<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_WC_Product_Upsell extends Widget_Base {

	public function get_name() {
		return 'venam-wc-product-upsell';
	}

	public function get_title() {
		return __( 'Upsells', 'venam' );
	}

	public function get_icon() {
		return 'eicon-product-upsell';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'upsell', 'product' ];
	}
    public function get_categories() {
		return [ 'venam-woo-product' ];
	}
	protected function register_controls() {

		$this->start_controls_section(
			'section_upsell_content',
			[
				'label' => __( 'Upsells', 'venam' ),
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
		$settings = $this->get_settings_for_display();
		$limit = '-1';
		$columns = 4;
		$orderby = 'rand';
		$order = 'desc';

		if ( ! empty( $settings['columns'] ) ) {
			$columns = $settings['columns'];
		}

		if ( ! empty( $settings['orderby'] ) ) {
			$orderby = $settings['orderby'];
		}

		if ( ! empty( $settings['order'] ) ) {
			$order = $settings['order'];
		}

		woocommerce_upsell_display( $limit, $columns, $orderby, $order );
	}

	public function render_plain_content() {}
}
