<?php

if( !defined( 'ABSPATH' ) ) exit;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Element_Base;
use Elementor\Elementor_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Responsive\Responsive;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

class Venam_Section_Parallax {

    private static $instance = null;

    public function __construct(){
        // section register settings
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'section_parallax_controls'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'venam_add_particle_effect_to_section'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'venam_add_vegas_slider_to_section'), 10 );
        add_action('elementor/element/section/section_layout/before_section_end',array($this,'register_change_section_indent_structure'), 10 );
        add_action('elementor/element/section/section_background_overlay/before_section_end',array($this,'register_add_section_overlay_width'), 10 );
        add_action('elementor/frontend/section/before_render',array($this,'venam_custom_attr_to_section'), 10);
        add_action('elementor/frontend/column/before_render',array($this,'venam_custom_attr_to_column'), 10);

        // column register settings and before render column functions
        add_action('elementor/element/column/layout/after_section_end',array($this,'add_tilt_effect_to_column'), 10 );
    }

    /*****   START PARALLAX CONTROLS   ******/
    public function section_parallax_controls( $element ) {

        $template = basename( get_page_template() );
        if ( $template != 'locomotive-page.php' ) {

            $element->start_controls_section( 'venam_parallax_section',
                [
                    'label' => esc_html__( 'Venam Parallax', 'venam' ),
                    'tab' => Controls_Manager::TAB_LAYOUT
                ]
            );
            $element->add_control( 'venam_parallax_switcher',
                [
                    'label' => esc_html__( 'Enable Parallax', 'venam' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'venam-parallax jarallax parallax-',
                ]
            );
            $element->add_control( 'venam_parallax_update',
                [
                    'label' => '<div class="elementor-update-preview" style="background-color: #fff;display: block;"><div class="elementor-update-preview-button-wrapper" style="display:block;"><button class="elementor-update-preview-button elementor-button elementor-button-success" style="background: #d30c5c; margin: 0 auto; display:block;">Apply Changes</button></div><div class="elementor-update-preview-title" style="display:block;text-align:center;margin-top: 10px;">Update changes to pages</div></div>',
                    'type' => Controls_Manager::RAW_HTML,
                    'condition' => ['venam_parallax_switcher' => 'yes'],
                ]
            );
            $element->add_control( 'venam_parallax_type',
                [
                    'label' => esc_html__( 'Type', 'venam' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'condition' => ['venam_parallax_switcher' => 'yes'],
                    'default' => 'scroll',
                    'options' => [
                        'scroll' => esc_html__( 'Scroll', 'venam' ),
                        'scroll-opacity' => esc_html__( 'Scroll with Opacity', 'venam' ),
                        'opacity' => esc_html__( 'Fade', 'venam' ),
                        'scale' => esc_html__( 'Zoom', 'venam' ),
                        'scale-opacity' => esc_html__( 'Zoom with Fade', 'venam' )
                    ]
                ]
            );
            $element->add_control( 'venam_parallax_bg_size',
                [
                    'label' => esc_html__( 'Image Size', 'venam' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'auto',
                    'condition' => ['venam_parallax_switcher' => 'yes'],
                    'options' => [
                        'auto' => esc_html__( 'Auto', 'venam' ),
                        'cover' => esc_html__( 'Cover', 'venam' ),
                        'contain' => esc_html__( 'Contain', 'venam' )
                    ]
                ]
            );
            $element->add_control( 'venam_parallax_speed',
                [
                    'label' => esc_html__( 'Parallax Speed', 'venam' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -1,
                    'max' => 2,
                    'step' => 0.1,
                    'default' => 0.2,
                    'condition' => ['venam_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'venam_parallax_mobile_support',
                [
                    'label' => esc_html__( 'Parallax on Mobile Devices', 'venam' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'venam-mobile-parallax-',
                    'condition' => ['venam_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'venam_add_parallax_video',
                [
                    'label' => esc_html__( 'Use Background Video', 'venam' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'venam-parallax-video-',
                    'condition' => ['venam_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'venam_local_video_format',
                [
                    'label' => esc_html__( 'Video Format', 'venam' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'default' => 'external',
                    'options' => [
                        'external' => esc_html__( 'External (Youtube,Vimeo)', 'venam' ),
                        'mp4' => esc_html__( 'Local MP4', 'venam' ),
                        'webm' => esc_html__( 'Local Webm', 'venam' ),
                        'ogv' => esc_html__( 'Local Ogv', 'venam' ),
                    ],
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'venam_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'venam_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'venam_parallax_video_url',
                [
                    'label' => esc_html__( 'Video URL', 'venam' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => 'https://www.youtube.com/watch?v=AeeE6PyU-dQ',
                    'description' => esc_html__( 'YouTube/Vimeo link, or link to video file (mp4 is recommended).', 'venam' ),
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'venam_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'venam_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'venam_parallax_video_start_time',
                [
                    'label' => esc_html__( 'Start Time', 'venam' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'placeholder' => '10',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'venam_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'venam_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'venam_parallax_video_end_time',
                [
                    'label' => esc_html__( 'End Time', 'venam' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'placeholder' => '70',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'venam_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'venam_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'venam_parallax_video_volume',
                [
                    'label' => esc_html__( 'Video Volume', 'venam' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'default' => '',
                    'placeholder' => '0',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'venam_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'venam_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'venam_parallax_video_play_once',
                [
                    'label' => esc_html__( 'Play Once', 'venam' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'venam' ),
                    'label_off' => esc_html__( 'No', 'venam' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'venam_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'venam_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->end_controls_section();
        }
    }

    /*****   START COLUMN CONTROLS   ******/
    public function add_tilt_effect_to_column( $element ) {
        $element->start_controls_section( 'venam_tilt_effect_section',
            [
                'label' => esc_html__( 'Venam Tilt Effect', 'venam' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'venam_tilt_effect_switcher',
            [
                'label' => esc_html__( 'Enable Tilt Effect', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'You can use this option if you want to use tilt effect for the elementor heading and image in the column when the mouse is over the column.', 'venam' ),
            ]
        );
        $element->add_control( 'venam_tilt_effect_maxtilt',
            [
                'label' => esc_html__( 'Max Tilt', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 20,
                'condition' => ['venam_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_tilt_effect_perspective',
            [
                'label' => esc_html__( 'Perspective', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10000,
                'step' => 100,
                'default' => 1000,
                'description' => esc_html__( 'Transform perspective, the lower the more extreme the tilt gets.', 'venam' ),
                'condition' => ['venam_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_tilt_effect_easing',
            [
                'label' => esc_html__( 'Custom Easing', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'cubic-bezier(.03,.98,.52,.99)',
                'label_block' => true,
                'condition' => ['venam_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_tilt_effect_scale',
            [
                'label' => esc_html__( 'Scale', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'description' => esc_html__( '2 = 200%, 1.5 = 150%, etc..', 'venam' ),
                'condition' => ['venam_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_tilt_effect_speed',
            [
                'label' => esc_html__( 'Speed', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 10,
                'default' => 300,
                'description' => esc_html__( 'Speed of the enter/exit transition.', 'venam' ),
                'condition' => ['venam_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_tilt_effect_transition',
            [
                'label' => esc_html__( 'Transition', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Set a transition on enter/exit.', 'venam' ),
                'condition' => ['venam_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_tilt_effect_disableaxis',
            [
                'label' => esc_html__( 'Disable Axis', 'venam' ),
                'description' => esc_html__( 'What axis should be disabled. Can be X or Y.', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'venam' ),
                    'vertical' => esc_html__( 'X Axis', 'venam' ),
                    'horizontal' => esc_html__( 'Y Axis', 'venam' ),
                ],
                'condition' => [ 'venam_tilt_effect_switcher' => 'yes' ],
            ]
        );
        $element->add_control( 'venam_tilt_effect_reset',
            [
                'label' => esc_html__( 'Reset', 'venam' ),
                'description' => esc_html__( 'If the tilt effect has to be reset on exit.', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['venam_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_tilt_effect_glare',
            [
                'label' => esc_html__( 'Glare Effect', 'venam' ),
                'description' => esc_html__( 'Enables glare effect', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['venam_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_tilt_effect_maxglare',
            [
                'label' => esc_html__( 'Max Glare', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => 1,
                'description' => esc_html__( 'From 0 - 1.', 'venam' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'venam_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'venam_tilt_effect_glare',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'venam_tilt_effect_glareclr',
                'label' => esc_html__( 'Background', 'venam' ),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .js-tilt-glare-inner',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'venam_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'venam_tilt_effect_glare',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->end_controls_section();
    }
    /*****   END COLUMN CONTROLS   ******/

    /*****   START CONTROLS SECTION   ******/
    public function register_change_section_indent_structure( $element ) {
        $element->add_control( 'venam_make_fixed_section_switcher',
            [
                'label' => esc_html__( 'Make Fixed On Scroll', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'prefix_class' => 'venam-section-fixed-',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'venam_fixed_section_bgcolor',
            [
                'label' => esc_html__( 'On Scroll BG Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}}' => 'background-color:{{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'venam_fixed_section_heading_color',
            [
                'label' => esc_html__( 'On Scroll Text Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container .elementor-heading-title' => 'color:{{VALUE}};',
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container .elementor-icon' => 'color:{{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'venam_fixed_section_link_color',
            [
                'label' => esc_html__( 'On Scroll Link Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container a' => 'color: {{VALUE}} !important;',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'venam_fixed_section_link_hvrcolor',
            [
                'label' => esc_html__( 'On Scroll Link Hover', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container a:hover' => 'color: {{VALUE}} !important;',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'venam_section_indent',
            [
                'label' => esc_html__( 'Section Indent', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '',
                'prefix_class' => 'nt-section ',
                'separator' => 'before',
                'options' => [
                    '' => esc_html__( 'Default', 'venam' ),
                    'section-padding' => esc_html__( 'Indent Top and Bottom', 'venam' ),
                    'section-padding pt-0' => esc_html__( 'Indent Bottom No Top', 'venam' ),
                    'section-padding pb-0' => esc_html__( 'Indent Top No Bottom', 'venam' ),
                ]
            ]
        );
    }


    /*****   START CONTROLS SECTION   ******/
    public function register_add_section_overlay_width( $element )
    {
        $element->add_responsive_control( 'venam_section_overlay_width',
            [
                'label' => esc_html__( 'Venam Overlay Width', 'venam' ),
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
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $element->add_responsive_control( 'venam_section_overlay_height',
            [
                'label' => esc_html__( 'Venam Overlay Height', 'venam' ),
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
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );
    }

    // Registering Controls
    public function venam_add_particle_effect_to_section( $element ) {
        $element->start_controls_section('venam_particles_settings',
            [
                'label' => esc_html__( 'Venam Particles Effect', 'venam' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'venam_particles_type',
            [
                'label' => esc_html__( 'Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'venam' ),
                    'default' => esc_html__( 'default', 'venam' ),
                    'nasa' => esc_html__( 'nasa', 'venam' ),
                    'bubble' => esc_html__( 'bubble', 'venam' ),
                    'snow' => esc_html__( 'snow', 'venam' ),
                ]
            ]
        );
        $element->add_control( 'venam_particles_options_heading',
            [
                'label' => esc_html__( 'Particles Options', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['venam_particles_type!' => 'none']
            ]
        );

        $element->add_control( 'venam_particles_shape',
            [
                'label' => esc_html__( 'Shape Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'circle',
                'options' => [
                    'circle' => esc_html__( 'circle', 'venam' ),
                    'edge' => esc_html__( 'edge', 'venam' ),
                    'triangle' => esc_html__( 'triangle', 'venam' ),
                    'polygon' => esc_html__( 'polygon', 'venam' ),
                    'star' => esc_html__( 'star', 'venam' ),
                ],
                'condition' => ['venam_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'venam_particles_number',
            [
                'label' => esc_html__( 'Number', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 60,
                'condition' => ['venam_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'venam_particles_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => ['venam_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'venam_particles_opacity',
            [
                'label' => esc_html__( 'Opacity', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1,
                'step' => 0.1,
                'default' => 0.4,
                'condition' => ['venam_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'venam_particles_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 6,
                'condition' => ['venam_particles_type!' => 'none']
            ]
        );
        $element->end_controls_section();
    }

    // Registering Controls
    public function venam_add_vegas_slider_to_section( $element ) {
        $element->start_controls_section('venam_vegas_settings',
            [
                'label' => esc_html__( 'Venam Vegas Slider', 'venam' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'venam_vegas_switcher',
            [
                'label' => esc_html__( 'Enable Background Slider', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $element->add_control( 'venam_vegas_images',
            [
                'label' => __( 'Add Images', 'venam' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'condition' => ['venam_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_vegas_options_heading',
            [
                'label' => esc_html__( 'Slider Options', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['venam_vegas_images!' => '']
            ]
        );
        $element->add_control( 'venam_vegas_animation_type',
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
                ],
                'condition' => ['venam_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_vegas_transition_type',
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
                ],
                'condition' => ['venam_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_vegas_overlay_type',
            [
                'label' => esc_html__( 'Overlay Image Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'prefix_class' => 'venam-vegas-overlay vegas-overlay-',
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
                ],
                'condition' => ['venam_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_vegas_delay',
            [
                'label' => esc_html__( 'Delay', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 7000,
                'condition' => ['venam_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_vegas_duration',
            [
                'label' => esc_html__( 'Transition Duration', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
                'condition' => ['venam_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_vegas_shuffle',
            [
                'label' => esc_html__( 'Enable Shuffle', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['venam_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'venam_vegas_timer',
            [
                'label' => esc_html__( 'Enable Timer', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['venam_vegas_switcher' => 'yes'],
                'selectors' => ['{{WRAPPER}} .vegas-timer' => 'display:block!important;'],
            ]
        );
        $element->add_control( 'venam_vegas_timer_size',
            [
                'label' => esc_html__( 'Timer Height', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'selectors' => ['{{WRAPPER}} .vegas-timer' => 'height:{{VALUE}};'],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'venam_vegas_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'venam_vegas_timer',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'venam_vegas_timer_color',
            [
                'label' => esc_html__( 'Timer Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => ['{{WRAPPER}} .vegas-timer-progress' => 'background-color:{{VALUE}};'],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'venam_vegas_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'venam_vegas_timer',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->end_controls_section();
    }

    public function venam_custom_attr_to_column( $element ) {
        $data     = $element->get_data();
        $type     = $data['elType'];
        $settings = $data['settings'];
        $isInner  = $data['isInner'];// inner section

        if ( 'column' === $element->get_name() && 'yes' === $element->get_settings('venam_tilt_effect_switcher') ) {
            $transition = 'yes' === $element->get_settings('venam_tilt_effect_transition') ? 'true' : 'false';
            $reset = 'yes' === $element->get_settings('venam_tilt_effect_reset') ? 'true' : 'false';
            $glare = 'yes' === $element->get_settings('venam_tilt_effect_glare') ? 'true' : 'false';
            $element->add_render_attribute( '_wrapper', 'data-tilt', '' );
            $element->add_render_attribute( '_wrapper', 'data-tilt-max', $element->get_settings('venam_tilt_effect_maxtilt') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-perspective', $element->get_settings('venam_tilt_effect_perspective') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-easing', $element->get_settings('venam_tilt_effect_easing') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-scale', $element->get_settings('venam_tilt_effect_scale') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-speed', $element->get_settings('venam_tilt_effect_speed') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-disableaxis', $element->get_settings('venam_tilt_effect_disableaxis') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-maxglare', $element->get_settings('venam_tilt_effect_maxglare') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-transition', $transition );
            $element->add_render_attribute( '_wrapper', 'data-tilt-reset', 'true' );
            $element->add_render_attribute( '_wrapper', 'data-tilt-glare', $glare );
            wp_enqueue_script( 'tilt' );
        }
    }

    public function venam_custom_attr_to_section( $element ) {
        $data     = $element->get_data();
        $type     = $data['elType'];
        $settings = $data['settings'];
        $isInner  = $data['isInner'];// inner section

        $template = basename( get_page_template() );

        if ( 'section' === $element->get_name() ) {
            $gap = $element->get_settings('gap');
            $element->add_render_attribute( 'wrapper', 'class', $element->get_settings('venam_section_indent') );
            $element->add_render_attribute( '_wrapper', 'class', 'gap-'.$gap );


            // Particles Effect Options
            if ( 'none' !== $element->get_settings('venam_particles_type') ) {

                $color = $element->get_settings('venam_particles_color');
                $type = $element->get_settings('venam_particles_type');
                $shape = $element->get_settings('venam_particles_shape');
                $number = $element->get_settings('venam_particles_number');
                $opacity = $element->get_settings('venam_particles_opacity');
                $size = $element->get_settings('venam_particles_size');
                $size = $size ? $size : 100;

                $element->add_render_attribute( '_wrapper', 'class', 'venam-particles' );
                $element->add_render_attribute( '_wrapper', 'data-particles-settings', '{"type":"'.$type.'","color":"'.$color.'","shape":"'.$shape.'","number":'.$number.',"opacity":'.$opacity.',"size":'.$size.'}' );
                $element->add_render_attribute( '_wrapper', 'data-particles-id', $data['id'] );
            }

            // Vegas Slider Options
            if ( 'yes' === $element->get_settings('venam_vegas_switcher') ) {
                $delay = $element->get_settings('venam_vegas_delay');
                $duration = $element->get_settings('venam_vegas_duration');
                $timer = $element->get_settings('venam_vegas_timer');
                $shuffle = $element->get_settings('venam_vegas_shuffle');
                $overlay = $element->get_settings('venam_vegas_overlay_type');
                $images = $element->get_settings('venam_vegas_images');

                $transitions = $element->get_settings('venam_vegas_transition_type');
                $transition = array();
                foreach ( $transitions as $trans ) {
                    $transition[] =  '"'.$trans.'"';
                }
                $transition = implode(',', $transition);

                $animations = $element->get_settings('venam_vegas_animation_type');
                $animation = array();
                foreach ( $animations as $anim ) {
                    $animation[] =  '"'.$anim.'"';
                }
                $animation = implode(',', $animation);

                $slides = array();
                foreach ( $images as $image ) {
                    $slides[] =  '{"src":"'.$image['url'].'"}';
                }

                $element->add_render_attribute( '_wrapper', 'data-vegas-settings',  '{"slides":['.implode(',', $slides).'],"animation":['.$animation.'],"transition":['.$transition.'],"delay":'.$delay.',"duration":'.$duration.',"timer":"'.$timer.'","shuffle":"'.$shuffle.'","overlay":"'.$overlay.'"}' );

                $element->add_render_attribute( '_wrapper', 'data-vegas-id', $data['id'] );

            }

            // Parallax Effect Options
            if ( 'yes' === $element->get_settings('venam_parallax_switcher') && $template != 'locomotive-page.php' ) {

                // Parallax attr
                $type = $element->get_settings('venam_parallax_type');
                $speed = $element->get_settings('venam_parallax_speed');
                $bgsize = $element->get_settings('venam_parallax_bg_size');
                $mobile = $element->get_settings('venam_parallax_mobile_support');
                $bgimg = $element->get_settings('background_image');
                $bgimg = $bgimg['url'];

                if ( 'yes' === $element->get_settings('venam_add_parallax_video') && $element->get_settings('venam_parallax_video_url') ) {

                    if ( 'mp4' === $element->get_settings('venam_local_video_format')) {
                        $videosrc = 'mp4:'.$element->get_settings('venam_parallax_video_url');
                    } elseif ( 'webm' === $element->get_settings('venam_local_video_format')) {
                        $videosrc = 'webm:'.$element->get_settings('venam_parallax_video_url');
                    } elseif ( 'ogv' === $element->get_settings('venam_local_video_format')) {
                        $videosrc = 'ogv:'.$element->get_settings('venam_parallax_video_url');
                    } else {
                        //$settings['background_video_link'] // elementor background video link
                        $videosrc = $element->get_settings('venam_parallax_video_url');
                    }

                    $element->add_render_attribute( '_wrapper', 'data-jarallax data-video-src', $videosrc);

                    if ( $element->get_settings('venam_parallax_video_start_time') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-start-time', $element->get_settings('venam_parallax_video_start_time'));
                    }
                    if ( $element->get_settings('venam_parallax_video_end_time') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-end-time', $element->get_settings('venam_parallax_video_end_time'));
                    }
                    if ( 'yes' === $element->get_settings('venam_parallax_video_play_once') ) {
                        $element->add_render_attribute( '_wrapper', 'data-jarallax-video-loop', 'false' );
                    }
                    if ( $element->get_settings('venam_parallax_video_volume') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-volume', $element->get_settings('venam_parallax_video_volume') );
                    }

                } else {
                    $parallaxattr = '{"type":"'.$type.'","speed":"'.$speed.'","imgsize":"'.$bgsize.'","imgsrc":"'.$bgimg.'","mobile":"'.$mobile.'"}';
                    $element->add_render_attribute( '_wrapper', 'data-venam-parallax', $parallaxattr);
                }
            }

            if ( $template == 'locomotive-page.php' ) {
                if ( true == $isInner ) {
                    $lrepeat = 'yes' === $element->get_settings('venam_locomotive_entrance_animation_repeat') ? 'true' : 'false';
                    $element->add_render_attribute( '_wrapper', 'data-scroll', '' );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-speed', $element->get_settings('venam_locomotive_speed') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-delay', $element->get_settings('venam_locomotive_delay') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-direction', $element->get_settings('venam_locomotive_direction') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-class', $element->get_settings('venam_locomotive_entrance_animation') );
                    //$element->add_render_attribute( '_wrapper', 'data-scroll-sticky', $element->get_settings('venam_locomotive_sticky') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-repeat', $lrepeat );
                } else {
                    $element->add_render_attribute( '_wrapper', 'data-scroll-section', '' );
                    if ( 'yes' === $element->get_settings('venam_locomotive_fixedbg') ) {
                        $element->add_render_attribute( '_wrapper', 'data-venam-locomotive-fixedbg', 'yes' );
                    }
                }
            }
        } // end if section
    }

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
Venam_Section_Parallax::get_instance();
