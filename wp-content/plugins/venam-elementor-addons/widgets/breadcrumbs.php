<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Breadcrumbs extends Widget_Base {
    public function get_name() {
        return 'venam-breadcrumbs';
    }
    public function get_title() {
        return 'Breadcrumbs (N)';
    }
    public function get_icon() {
        return 'eicon-columns';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Style', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'bread_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumb-content .breadcrumb' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .breadcrumb-content .breadcrumb li, {{WRAPPER}} .breadcrumb-content .breadcrumb li a'
            ]
        );
        $this->add_control( 'bread_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumb-content .breadcrumb li, {{WRAPPER}} .breadcrumb-content .breadcrumb li a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'bread_hvrcolor',
            [
                'label' => esc_html__( 'Hover Link Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-breadcrumb li:not(.active) a:hover' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'bread_actcolor',
            [
                'label' => esc_html__( 'Current Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumb-content .breadcrumb li.active' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'bread_sepcolor',
            [
                'label' => esc_html__( 'Separator Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumb-item+.breadcrumb-item::before' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $id = $this->get_id();

        echo '<div class="breadcrumb-content text-center">';
            echo venam_breadcrumbs();
        echo '</div>';
    }
}
