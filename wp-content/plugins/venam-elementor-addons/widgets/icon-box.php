<?php

namespace Elementor;
use Elementor\Core\Schemes\Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Icon_Box extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-icon-box';
    }
    public function get_title() {
        return 'Icon Box (N)';
    }
    public function get_icon() {
        return 'eicon-icon-box';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   Button Options   ******/
        $this->start_controls_section('general_settings',
            [
                'label' => esc_html__( 'Icon Box', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'icon',
            [
                'label' => esc_html__( 'Icon', 'venam' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-home',
                    'library' => 'solid'
                ]
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Button Text'
            ]
        );
        $this->add_control( 'text',
            [
                'label' => esc_html__( 'Text', 'venam' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => 'We are always happy to talk with you.'
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Box Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => ''
                ],
                'show_external' => true
            ]
        );
        $this->end_controls_section();
        /*****   End Button Options   ******/
    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $settingsid = $this->get_id();

        echo '<div class="contact-info-box text-center">';
            if ( !empty( $settings['icon']['value'] ) ) {
                echo '<div class="contact-box-icon">';
                    Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                echo '</div>';
            }
            echo '<div class="contact-info-content">';
                if ( $settings['title'] ) {
                    echo '<h5>'.$settings['title'].'</h5>';
                }
                if ( $settings['text'] ) {
                    echo '<p>'.$settings['text'].'</p>';
                }
            echo '</div>';
        echo '</div>';
    }
}
