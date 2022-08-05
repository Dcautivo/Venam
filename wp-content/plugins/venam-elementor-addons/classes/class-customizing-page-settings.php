<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use Elementor\Core\Base\Module as BaseModule;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Core\DocumentTypes\PageBase as PageBase;
use Elementor\Modules\Library\Documents\Page as LibraryPageDocument;

if( !defined( 'ABSPATH' ) ) exit;

class Venam_Customizing_Page_Settings {
    use Venam_Helper;
    private static $instance = null;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new Venam_Customizing_Page_Settings();
        }
        return self::$instance;
    }

    public function __construct(){
        // custom option for elementor heading widget font size
        add_action( 'elementor/element/wp-page/document_settings/before_section_end',[ $this,'venam_page_settings'], 10);
        add_action( 'elementor/element/wp-post/document_settings/before_section_end',[ $this,'venam_page_settings'], 10);
    }

    public function venam_page_settings( $page )
    {

        if ( isset( $page ) && $page->get_id() > "" ){

            $template = basename( get_page_template() );
            $venam_post_type = false;
            $venam_post_type = get_post_type( $page->get_id() );

            $page->add_control( 'venam_page_header_settings_heading',
                [
                    'label' => esc_html__( 'VENAM HEADER', 'venam' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $page->add_control( 'venam_hide_page_header',
                [
                    'label' => esc_html__( 'Hide Page Header', 'venam' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $page->add_control( 'venam_header_template',
                [
                    'label' => esc_html__( 'Select Header Template', 'venam' ),
                    'type' => Controls_Manager::SELECT2,
                    'default' => '',
                    'multiple' => false,
                    'options' => $this->venam_get_elementor_templates(),
                    'condition' => [ 'venam_hide_page_header!' => 'yes' ]
                ]
            );
            $page->add_control( 'venam_page_footer_settings_heading',
                [
                    'label' => esc_html__( 'VENAM FOOTER', 'venam' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $page->add_control( 'venam_hide_page_footer',
                [
                    'label' => esc_html__( 'Hide Footer', 'venam' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            $page->add_control( 'venam_footer_template',
                [
                    'label' => esc_html__( 'Select Footer Template', 'venam' ),
                    'type' => Controls_Manager::SELECT2,
                    'default' => '',
                    'multiple' => false,
                    'options' => $this->venam_get_elementor_templates(),
                    'condition' => [ 'venam_hide_page_footer!' => 'yes' ]
                ]
            );
        }
    }

    public function venam_add_custom_css_to_page_settings( $page )
    {

        if( isset($page) && $page->get_id() > "" ){

            $nt_post_type = false;
            $nt_post_type = get_post_type($page->get_id());

            if ( $nt_post_type == 'page' || $nt_post_type == 'revision' ) {

                $page->start_controls_section( 'header_custom_css_controls_section',
                    [
                        'label' => esc_html__( 'VENAM Page Custom CSS', 'venam' ),
                        'tab' => Controls_Manager::TAB_SETTINGS,
                    ]
                );
                $page->add_control( 'venam_page_custom_css',
                    [
                        'label' => esc_html__( 'Custom CSS', 'venam' ),
                        'type' => Controls_Manager::CODE,
                        'language' => 'css',
                        'rows' => 20,
                    ]
                );
                $page->end_controls_section();
            }
        }
    }

    public function venam_page_registered_nav_menus()
    {
        $menus = wp_get_nav_menus();
        $options = array();
        if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
            foreach ( $menus as $menu ) {
                $options[ $menu->slug ] = $menu->name;
            }
        }
        return $options;
    }
}
Venam_Customizing_Page_Settings::get_instance();
