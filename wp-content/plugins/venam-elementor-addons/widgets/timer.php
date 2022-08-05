<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Timer extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-timer';
    }
    public function get_title() {
        return 'Timer (N)';
    }
    public function get_icon() {
        return 'eicon-counter';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    public function get_script_depends() {
        return [ 'jquery-countdown' ];
    }
    // Registering Controls
    protected function register_controls() {
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
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $s  = $this->get_settings_for_display();
        $id = $this->get_id();
        
        if ( $s['date'] ) {
            echo '<div class="super-deal-title">';
                if ( $s['ctitle'] ) {
                    echo '<h3 class="c-title">'.$s['ctitle'].'</h3>';
                }
                echo '<div class="coming-time" data-countdown=\'{"date":"'.$s['date'].'","hr":"'.$s['hr'].'","min":"'.$s['min'].'","sec":"'.$s['sec'].'"}\'></div>';
            echo '</div>';
        }
    }
}
