<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Vegas_Template extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-vegas-template';
    }
    public function get_title() {
        return 'Vegas Slider Template (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    public function get_style_depends() {
        return [ 'vegas' ];
    }
    public function get_script_depends() {
        return [ 'vegas' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_content_section',
            [
                'label' => esc_html__( 'Content', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'header',
            [
                'label' => esc_html__( 'Show Header', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'header_type',
            [
                'label' => esc_html__( 'Header Template', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default Header', 'venam' ),
                    'template' => esc_html__( 'Elementor Template', 'venam' )
                ],
                'condition' => [ 'header' => 'yes' ]
            ]
        );
        $this->add_control( 'header_template',
            [
                'label' => esc_html__( 'Select Header Template', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->venam_get_elementor_templates('section'),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'header',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'header_type',
                            'operator' => '==',
                            'value' => 'template'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'header_position',
            [
                'label' => esc_html__( 'Header Position', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'absolute',
                'options' => [
                    'absolute' => esc_html__( 'absolute', 'venam' ),
                    'relative' => esc_html__( 'relative', 'venam' )
                ],
                'selectors' => ['{{WRAPPER}} .vegas-template-slider .vegas-header-wrapper' => 'position: {{VALUE}};'],
                'condition' => [ 'header' => 'yes' ]
            ]
        );
        $this->add_control( 'content_template',
            [
                'label' => esc_html__( 'Content Template', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->venam_get_elementor_templates('section'),
            ]
        );
        $this->add_control( 'content_template_notice',
            [
                'label' => '!IMPORTANT : The type of templates you will use in this area should be section, if you cannot see your template in the list, you should create a new one here.<a href="'.esc_url(admin_url( 'edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' )).'">Add New Template</a>',
                'type' => Controls_Manager::RAW_HTML,
            ]
        );
        $this->add_responsive_control( 'minheight',
            [
                'label' => esc_html__( 'Min Height ( vh )', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 4000,
                        'step' => 5
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .vegas-template-slider' => 'height: {{SIZE}}vh;min-height: {{SIZE}}vh;',
                    '{{WRAPPER}} .vegas-template-slider .vegas-content-wrapper .elementor-top-section .elementor-container' => 'height: {{SIZE}}vh;min-height: {{SIZE}}vh;',
                ],
                'separator' => 'before'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_options_section',
            [
                'label' => esc_html__( 'Slider Options', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'animation',
            [
                'label' => esc_html__( 'Animation Type', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['kenburns'],
                'options' => [
                    'kenburns' => esc_html__( 'kenburns', 'venam' ),
                    'kenburnsUp' => esc_html__( 'kenburnsUp', 'venam' ),
                    'kenburnsDown' => esc_html__( 'kenburnsDown', 'venam' ),
                    'kenburnsLeft' => esc_html__( 'kenburnsLeft', 'venam' ),
                    'kenburnsRight' => esc_html__( 'kenburnsRight', 'venam' ),
                    'kenburnsUpLeft' => esc_html__( 'kenburnsUpLeft', 'venam' ),
                    'kenburnsUpRight' => esc_html__( 'kenburnsUpRight', 'venam' ),
                    'kenburnsDownLeft' => esc_html__( 'kenburnsDownLeft', 'venam' ),
                    'kenburnsDownRight' => esc_html__( 'kenburnsDownRight', 'venam' ),
                ]
            ]
        );
        $this->add_control( 'transition',
            [
                'label' => esc_html__( 'Transition Type', 'venam' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['zoomIn','slideLeft','slideRight'],
                'options' => [
                    'fade' => esc_html__( 'fade', 'venam' ),
                    'fade2' => esc_html__( 'fade2', 'venam' ),
                    'slideLeft' => esc_html__( 'slideLeft', 'venam' ),
                    'slideLeft2' => esc_html__( 'slideLeft2', 'venam' ),
                    'slideRight' => esc_html__( 'slideRight', 'venam' ),
                    'slideRight2' => esc_html__( 'slideRight2', 'venam' ),
                    'slideUp' => esc_html__( 'slideUp', 'venam' ),
                    'slideUp2' => esc_html__( 'slideUp2', 'venam' ),
                    'slideDown' => esc_html__( 'slideDown', 'venam' ),
                    'slideDown2' => esc_html__( 'slideDown2', 'venam' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'venam' ),
                    'zoomIn2' => esc_html__( 'zoomIn2', 'venam' ),
                    'zoomOut' => esc_html__( 'zoomOut', 'venam' ),
                    'zoomOut2' => esc_html__( 'zoomOut2', 'venam' ),
                    'swirlLeft' => esc_html__( 'swirlLeft', 'venam' ),
                    'swirlLeft2' => esc_html__( 'swirlLeft2', 'venam' ),
                    'swirlRight' => esc_html__( 'swirlRight', 'venam' ),
                    'swirlRight2' => esc_html__( 'swirlRight2', 'venam' ),
                    'burn' => esc_html__( 'burn', 'venam' ),
                    'burn2' => esc_html__( 'burn2', 'venam' ),
                    'blur' => esc_html__( 'blur', 'venam' ),
                    'blur2' => esc_html__( 'blur2', 'venam' ),
                    'flash' => esc_html__( 'flash', 'venam' ),
                    'flash2' => esc_html__( 'flash2', 'venam' ),
                ]
            ]
        );
        $this->add_control( 'overlay',
            [
                'label' => esc_html__( 'Overlay Image Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'none' => esc_html__( 'None', 'venam' ),
                    '01' => esc_html__( 'Overlay 1', 'venam' ),
                    '02' => esc_html__( 'Overlay 2', 'venam' ),
                    '03' => esc_html__( 'Overlay 3', 'venam' ),
                    '04' => esc_html__( 'Overlay 4', 'venam' ),
                    '05' => esc_html__( 'Overlay 5', 'venam' ),
                    '06' => esc_html__( 'Overlay 6', 'venam' ),
                    '07' => esc_html__( 'Overlay 7', 'venam' ),
                    '08' => esc_html__( 'Overlay 8', 'venam' ),
                    '09' => esc_html__( 'Overlay 9', 'venam' ),
                ]
            ]
        );
        $this->add_control( 'delay',
            [
                'label' => esc_html__( 'Delay ( ms )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 7000,
            ]
        );
        $this->add_control( 'duration',
            [
                'label' => esc_html__( 'Transition Duration ( ms )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'shuffle',
            [
                'label' => esc_html__( 'Shuffle', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'arrows',
            [
                'label' => esc_html__( 'Arrows', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'counter',
            [
                'label' => esc_html__( 'Counter', 'venam' ),
                'type' => Controls_Manager::SWITCHER
            ]
        );
        $this->add_control( 'timer',
            [
                'label' => esc_html__( 'Timer', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'display:block!important;'],
            ]
        );
        $this->add_control( 'timer_size',
            [
                'label' => esc_html__( 'Timer Height', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'height:{{VALUE}}px;'],
                'condition'  => ['timer' => 'yes'],
            ]
        );
        $this->add_control( 'timer_color',
            [
                'label' => esc_html__( 'Timer Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors'  => ['{{WRAPPER}} .vegas-timer-progress' => 'background-color:{{VALUE}};'],
                'condition'  => ['timer' => 'yes'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_nav_style_section',
            [
                'label'=> esc_html__( 'ARROWS STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'arrows' => 'yes' ]
            ]
        );
        $this->add_control( 'container',
            [
                'label' => esc_html__( 'Wrap Container', 'venam' ),
                'type' => Controls_Manager::SWITCHER
            ]
        );
        $this->add_responsive_control( 'slider_nav_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .vegas-control .vegas-control-btn' => 'width: {{SIZE}}px;height: {{SIZE}}px;' ]
            ]
        );
        $this->add_responsive_control( 'slider_nav_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .vegas-control .vegas-control-btn' => 'font-size: {{SIZE}}px;' ]
            ]
        );
        $this->start_controls_tabs( 'slider_nav_tabs');
        $this->start_controls_tab( 'slider_nav_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'nav_bgclr',
           [
               'label' => esc_html__( 'Background Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .vegas-control .vegas-control-btn' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_clr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .vegas-control .vegas-control-btn' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .vegas-control .vegas-control-btn',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'nav_hvrbgclr',
           [
               'label' => esc_html__( 'Background Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .vegas-control .vegas-control-btn:hover' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_hvrclr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .vegas-control .vegas-control-btn:hover i' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvr_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .vegas-control .vegas-control-btn:hover',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'prev_heading',
            [
                'label' => esc_html__( 'PREV POSITION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'prev_horz_align',
            [
                'label' => esc_html__( 'Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'horz-left' => [
                        'title' => esc_html__( 'Left', 'venam' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'horz-right' => [
                        'title' => esc_html__( 'Right', 'venam' ),
                        'icon' => 'eicon-h-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->add_responsive_control( 'prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 4000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .vegas-control .vegas-control-prev.horz-left' => 'left:{{SIZE}}{{UNIT}};right:auto;',
                    '{{WRAPPER}} .vegas-control .vegas-control-prev.horz-right' => 'right:{{SIZE}}{{UNIT}};left:auto;'
                ]
            ]
        );
        $this->add_control( 'prev_ver_align',
            [
                'label' => esc_html__( 'Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'vert-top' => [
                        'title' => esc_html__( 'Top', 'venam' ),
                        'icon' => 'eicon-v-align-top'
                    ],
                    'vert-bottom' => [
                        'title' => esc_html__( 'Bottom', 'venam' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->add_responsive_control( 'prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 2000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .vegas-control .vegas-control-prev.vert-top' => 'top:{{SIZE}}{{UNIT}};bottom:auto;',
                    '{{WRAPPER}} .vegas-control .vegas-control-prev.vert-bottom' => 'bottom:{{SIZE}}{{UNIT}};top:auto;',
                ],
            ]
        );
        $this->add_control( 'next_heading',
            [
                'label' => esc_html__( 'NEXT POSITION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'next_horz_align',
            [
                'label' => esc_html__( 'Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'horz-left' => [
                        'title' => esc_html__( 'Left', 'venam' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'horz-right' => [
                        'title' => esc_html__( 'Right', 'venam' ),
                        'icon' => 'eicon-h-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'horz-right'
            ]
        );
        $this->add_responsive_control( 'next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 4000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .vegas-control .vegas-control-next.horz-left' => 'left:{{SIZE}}{{UNIT}};right:auto;',
                    '{{WRAPPER}} .vegas-control .vegas-control-next.horz-right' => 'right:{{SIZE}}{{UNIT}};left:auto;'
                ]
            ]
        );
        $this->add_control( 'next_ver_align',
            [
                'label' => esc_html__( 'Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'vert-top' => [
                        'title' => esc_html__( 'Top', 'venam' ),
                        'icon' => 'eicon-v-align-top'
                    ],
                    'vert-bottom' => [
                        'title' => esc_html__( 'Bottom', 'venam' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'toggle' => true,
                'default' => 'vert-bottom'
            ]
        );
        $this->add_responsive_control( 'next_vertical',
            [
                'label' => esc_html__( 'Vertical Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 2000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .vegas-control .vegas-control-next.vert-top' => 'top:{{SIZE}}{{UNIT}};bottom:auto;',
                    '{{WRAPPER}} .vegas-control .vegas-control-next.vert-bottom' => 'bottom:{{SIZE}}{{UNIT}};top:auto;'
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_counter_style_section',
            [
                'label'=> esc_html__( 'COUNTER STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'counter' => 'yes' ]
            ]
        );
        $this->add_control( 'counter_clr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .nt-vegas-slide-counter' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .nt-vegas-slide-counter'
            ]
        );
        $this->add_control( 'counter_horz_align',
            [
                'label' => esc_html__( 'Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'horz-left' => [
                        'title' => esc_html__( 'Left', 'venam' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'horz-right' => [
                        'title' => esc_html__( 'Right', 'venam' ),
                        'icon' => 'eicon-h-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'horz-right'
            ]
        );
        $this->add_responsive_control( 'counter_horizontal',
            [
                'size_units' => [ 'px', '%' ],
                'label' => esc_html__( 'Horizontal Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 1000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .nt-vegas-slide-counter.horz-left' => 'left:{{SIZE}}{{UNIT}};right:auto;',
                    '{{WRAPPER}} .nt-vegas-slide-counter.horz-right' => 'right:{{SIZE}}{{UNIT}};left:auto;'
                ]
            ]
        );
        $this->add_control( 'counter_ver_align',
            [
                'label' => esc_html__( 'Alignment', 'venam' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'vert-top' => [
                        'title' => esc_html__( 'Top', 'venam' ),
                        'icon' => 'eicon-v-align-top'
                    ],
                    'vert-bottom' => [
                        'title' => esc_html__( 'Bottom', 'venam' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'toggle' => true,
                'default' => 'vert-bottom'
            ]
        );
        $this->add_responsive_control( 'counter_vertical',
            [
                'label' => esc_html__( 'Vertical Position', 'venam' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                    'min' => 0,
                        'max' => 1000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .nt-vegas-slide-counter.vert-top' => 'top:{{SIZE}}{{UNIT}};bottom:auto;',
                    '{{WRAPPER}} .nt-vegas-slide-counter.vert-bottom' => 'bottom:{{SIZE}}{{UNIT}};top:auto;'
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();
        $sliderattr = '';

        $autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $shuffle = 'yes' == $settings['shuffle'] ? 'true' : 'false';
        $timer = 'yes' == $settings['timer'] ? 'true' : 'false';
        $overlay = 'none' == $settings['overlay'] ? 'false' : 'true';

        $animation = array();
        foreach ( $settings['animation'] as $anim ) {
            $animation[] .=  '"'.$anim.'"';
        }

        $transition = array();
        foreach ( $settings['transition'] as $trans ) {
            $transition[] .=  '"'.$trans.'"';
        }

        $sliderattr .= '"animation":['.implode(',', $animation).'],';
        $sliderattr .= '"transition":['.implode(',', $transition).'],';
        $sliderattr .= '"delay":'.$settings['delay'].',';
        $sliderattr .= '"duration":'.$settings['duration'].',';
        $sliderattr .= '"timer":"'.$settings['timer'].'",';
        $sliderattr .= '"shuffle":"'.$settings['shuffle'].'",';
        $sliderattr .= '"overlay":"'.$settings['overlay'].'",';
        $sliderattr .= '"autoplay":'.$autoplay;

        $wrapper = \Elementor\Plugin::$instance->editor->is_edit_mode() ? 'front-'.$settingsid : 'wrapper';

        echo '<div class="vegas-template-slider venam-vegas-template-'.$wrapper.'">';
                if ( 'yes' == $settings['header'] ) {
                    echo '<div class="vegas-header-wrapper">';
                        if ( 'template' == $settings['header_type'] && !empty( $settings['header_template'] ) ) {
                            $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                            $template_id = $settings['header_template'];
                            $header_content = new Frontend;
                            echo $header_content->get_builder_content_for_display($template_id, $style );
                        } else {
                            do_action('venam_header_action');
                        }
                    echo '</div>';
                }
                echo '<div id="slider-'.$settingsid.'" class="vegas-bg-content" data-slider-settings=\'{'.$sliderattr.'}\'></div>';
                echo '<div class="vegas-content-wrapper">';
                    if ( !empty( $settings['content_template'] ) ) {
                        $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                        $content_template_id = $settings['content_template'];
                        $content_template = new Frontend;
                        echo $content_template->get_builder_content_for_display($content_template_id, $style );
                    }
                echo '</div>';
                if ( 'yes' == $settings['counter'] ) {
                    echo '<div class="nt-vegas-slide-counter">';
                        echo '<span class="current">0</span>';
                        echo '<span class="separator"> / </span>';
                        echo '<span class="total">4</span>';
                    echo '</div>';
                }
                if ( 'yes' == $settings['arrows'] ) {
                    echo '<div class="vegas-control">';
                        echo '<span id="vegas-control-prev" class="vegas-control-prev vegas-control-btn"><i class="fas fa-caret-left"></i></span>';
                        echo '<span id="vegas-control-next" class="vegas-control-next vegas-control-btn"><i class="fas fa-caret-right"></i></span>';
                    echo '</div>';
                }

        echo '</div>';

        // Not in edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
        ?>
            <script>
            jQuery(document).ready(function ($) {

                var myEl        = $('.venam-vegas-template-front-<?php echo $settingsid; ?>'),
                    myContent   = myEl.find( '.vegas-content-wrapper .elementor-top-section' ),
                    myBgContent = myEl.find('.vegas-bg-content'),
                    myVegasId   = myBgContent.attr('id'),
                    myVegas     = $( '#' + myVegasId ),
                    myPrev      = myEl.find( '.vegas-control-prev' ),
                    myNext      = myEl.find( '.vegas-control-next' ),
                    myCounter   = myEl.find( '.nt-vegas-slide-counter' );

                myEl.parents('.elementor-widget-venam-vegas-template').removeClass('elementor-invisible');

                var mySlides = [];
                myContent.each( function(){
                    var mySlide = $(this),
                        bgImage = mySlide.css('background-image');
                        bgImage = bgImage.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, ''),
                        bgImage = {"src": bgImage};

                    mySlides.push( bgImage );
                    mySlide.addClass('vegas-slide-template-section').css({
                        'background-image' : 'none',
                        'background-color' : 'transparent',
                    });
                });

                if( mySlides.length ) {

                    myVegas.vegas({
                        autoplay: <?php echo $autoplay; ?>,
                        delay: <?php echo $settings['delay']; ?>,
                        timer: <?php echo $timer; ?>,
                        shuffle: <?php echo $shuffle; ?>,
                        animation: [<?php echo implode(',', $animation); ?>],
                        transition: [<?php echo implode(',', $transition); ?>],
                        transitionDuration: <?php echo $settings['duration']; ?>,
                        overlay: <?php echo $overlay; ?>,
                        slides: mySlides,
                        init: function (globalSettings) {
                            myContent.eq(0).addClass('active');
                            var total = myContent.size();
                            myCounter.find('.total').html(total);

                        },
                        walk: function (index, slideSettings) {
                            myContent.removeClass('active').eq(index).addClass('active');
                            myContent.each( function(){
                                var myElAnim = $(this).find( '.elementor-element[data-settings]' ),
                                    myData = myElAnim.data('settings'),
                                    myAnim = myData && myData._animation ? myData._animation : '',
                                    myDelay = myData && myData._animation_delay ? myData._animation_delay / 1000 : '';

                                if (myData && myAnim ) {
                                    myElAnim.removeClass('animated '+ myAnim );
                                    $(this).eq(index).find(myElAnim).addClass('animated '+ myAnim ).css({
                                        'animation-delay' : myDelay+'s',
                                    });
                                }
                            });
                            var current = index +1;
                            myCounter.find('.current').html(current);
                        }
                    });
                    myPrev.on('click', function () {
                        myVegas.vegas('previous');
                    });

                    myNext.on('click', function () {
                        myVegas.vegas('next');
                    });
                }
            });
            </script>
            <?php
        }
    }
}
