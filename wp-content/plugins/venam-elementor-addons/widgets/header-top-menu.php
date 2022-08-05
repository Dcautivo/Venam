<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Headertop_Menu extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-menutop';
    }
    public function get_title() {
        return 'Header Top Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('menu_general_settings',
            [
                'label' => esc_html__( 'General', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'register_menus',
            [
                'label' => esc_html__( 'Select Menu', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->registered_nav_menus(),
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Quick Guide',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'btntitle',
            [
                'label' => esc_html__( 'Button Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'US/USD',
                'label_block' => true,
            ]
        );
        $this->add_control( 'menus',
            [
                'label' => esc_html__( 'Items', 'venam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{btntitle}}',
                'default' => []
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Menu Style', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .header-top-left ul li,{{WRAPPER}} .header-top-left .dropdown button'
            ]
        );
        $this->add_control( 'menu_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-top-left ul li,{{WRAPPER}} .header-top-left .dropdown button' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'menu_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-top-left ul li:hover,{{WRAPPER}} .header-top-left .dropdown button:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_heading',
            [
                'label' => esc_html__( 'SUBMENU', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'submenu_bg',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-top-left .dropdown-menu' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_brdcolor',
            [
                'label' => esc_html__( 'Border Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-top-left .dropdown-menu' => 'border-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-top-left .dropdown .dropdown-item' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-top-left .dropdown .dropdown-item:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-top-left .dropdown .dropdown-item' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .header-top-left .dropdown .dropdown-item' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    public function current_menu( $current_menu )
    {
        $array_menu = wp_get_nav_menu_items( $current_menu );
        $menu = array();
        foreach ($array_menu as $m) {
            if (empty($m->menu_item_parent)) {
                $menu[] .='<a class="dropdown-item" href="'.$m->url.'">'.$m->title.'</a>';
            }
        }
        return implode('', $menu );
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        echo '<div class="header-top-left">';
            echo '<ul>';
            $count = 0;
            foreach ( $settings['menus'] as $m ) {
                echo '<li>';
                    echo '<div class="heder-top-guide">';
                        echo '<span>'.$m['title'].'</span>';
                        echo '<div class="dropdown">';
                            echo '<button class="dropdown-toggle" type="button" id="dropdownMenuButton'.$count.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$m['btntitle'].'</button>';
                            echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton'.$count.'">';
                                echo $this->current_menu( $m['register_menus'] );
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</li>';
                $count++;
            }
            echo '</ul>';
        echo '</div>';
    }
}
