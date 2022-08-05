<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_WC_Archive_Description extends Widget_Base {

	public function get_name() {
		return 'venam-wc-archive-description';
	}

	public function get_title() {
		return __( 'Archive Description', 'venam' );
	}

	public function get_icon() {
		return 'eicon-product-description';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'text', 'description', 'category', 'product', 'archive' ];
	}

    public function get_categories() {
		return [ 'venam-woo' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_product_description_style',
			[
				'label' => __( 'Style', 'venam' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'venam' ),
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
					'justify' => [
						'title' => __( 'Justified', 'venam' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => ['.woocommerce {{WRAPPER}} .term-description' => 'text-align: {{VALUE}}']
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'venam' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ '.woocommerce {{WRAPPER}} .term-description' => 'color: {{VALUE}}' ]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'Typography', 'venam' ),
				'selector' => '.woocommerce {{WRAPPER}} .term-description'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		do_action( 'woocommerce_archive_description' );
	}

}
