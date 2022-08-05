<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
class Venam_Contact_Form_7 extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-contact-form-7';
    }
    public function get_title() {
        return 'Contact Form 7 (N)';
    }
    public function get_icon() {
        return 'eicon-form-horizontal';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section( 'general_sections',
            [
                'label'=> esc_html__( 'Form Data', 'venam' ),
                'tab'=> Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control('id_control',
            [
                'label'=> esc_html__( 'Select Form', 'venam' ),
                'type'=> Controls_Manager::SELECT,
                'multiple'=> false,
                'options'=> $this->venam_get_cf7(),
                'description'=> esc_html__( 'Select Form to Embed', 'venam' ),
            ]
        );
        $this->end_controls_section();
        /*****   START CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();
        $formid = $settings['id_control'];

        if ( !empty( $formid ) ) {
            echo '<div class="nt-cf7-form-wrapper form_'.$elementid.'">';
                echo do_shortcode( '[contact-form-7 id="'.$formid.'"]' );
            echo '</div>';
        } else {
            echo "Please Select a Form";
        }

    }
}
