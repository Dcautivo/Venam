<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Sidebar_Widgets extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-sidebar-widgets';
    }
    public function get_title() {
        return 'Sidebar Widgets (N)';
    }
    public function get_icon() {
        return 'eicon-shortcode';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    public function get_style_depends() {
        return [ 'swiper-bundle' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'sidebar_widgets_settings',
            [
                'label' => esc_html__('Sidebar Widgets', 'venam'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'data',
            [
                'label' => esc_html__( 'Data Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'search' => esc_html__( 'Search', 'venam' ),
                    'form' => esc_html__( 'CF7 Form', 'venam' ),
                    'recent' => esc_html__( 'Recent Post', 'venam' ),
                    'cats' => esc_html__( 'Categories', 'venam' ),
                    'tags' => esc_html__( 'Tags', 'venam' ),
                    'archives' => esc_html__( 'Archives', 'venam' ),
                    'socials' => esc_html__( 'Social Icons', 'venam' ),
                    'banner' => esc_html__( 'Banner Image', 'venam' ),
                ],
                'default' => 'cats'
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Widget Heading',
                'label_block' => true,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => esc_html__( 'h1', 'venam' ),
                    'h2' => esc_html__( 'h2', 'venam' ),
                    'h3' => esc_html__( 'h3', 'venam' ),
                    'h4' => esc_html__( 'h4', 'venam' ),
                    'h5' => esc_html__( 'h5', 'venam' ),
                    'h6' => esc_html__( 'h6', 'venam' ),
                    'div' => esc_html__( 'div', 'venam' ),
                    'p' => esc_html__( 'p', 'venam' ),
                    'span' => esc_html__( 'span', 'venam' )
                ]
            ]
        );
        $this->add_control('cf7_id',
            [
                'label'=> esc_html__( 'Select Form', 'venam' ),
                'type'=> Controls_Manager::SELECT,
                'multiple'=> false,
                'options'=> $this->venam_get_cf7(),
                'description'=> esc_html__( 'Select Form to Embed', 'venam' ),
                'condition' => ['data' => 'form']
            ]
        );
        $this->add_control( 'from_text',
            [
                'label' => esc_html__( 'Short Description', 'venam' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'facebook',
                'label_block' => true,
                'separator' => 'before',
                'condition' => ['data' => 'form']
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Banner Image', 'venam' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
                'condition' => ['data' => 'banner'],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'thumbnail',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                        ['name' => 'data','operator' => '==','value' => 'banner'],
                    ]
                ]
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Banner Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
                'condition' => ['data' => 'banner'],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'icon',
            [
                'label' => esc_html__( 'Icon', 'venam' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'fa-brands'
                ]
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'venam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'venam' )
            ]
        );
        $repeater->add_control( 'name',
            [
                'label' => esc_html__( 'Social Name', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'facebook',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'socials',
            [
                'label' => esc_html__( 'Socials', 'venam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<i class="{{icon.value}}"></i>',
                'condition' => ['data' => 'socials'],
                'default' => [
                    [
                        'icon' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands'
                        ]
                    ],
                    [
                        'icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands'
                        ]
                    ],
                    [
                        'icon' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-brands'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'limit',
            [
                'label' => esc_html__( 'Post Limit', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'archives'],
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                    ]
                ]
            ]
        );
        $this->add_control( 'post_type',
            [
                'label' => esc_html__( 'Post Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'multiple' => true,
                'options' => $this->venam_get_post_types(),
                'condition' => ['data' => 'recent']
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'monthly',
                'options' => [
                    'daily' => esc_html__( 'daily', 'venam' ),
                    'weekly' => esc_html__( 'weekly', 'venam' ),
                    'monthly' => esc_html__( 'monthly', 'venam' ),
                    'yearly' => esc_html__( 'yearly', 'venam' ),
                ],
                'condition' => ['data' => 'archives']
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'venam' ),
                    'DESC' => esc_html__( 'Descending', 'venam' )
                ],
                'default' => 'DESC',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'archives'],
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                    ]
                ]
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'venam' ),
                    'menu_order' => esc_html__( 'Menu Order', 'venam' ),
                    'rand' => esc_html__( 'Random', 'venam' ),
                    'date' => esc_html__( 'Date', 'venam' ),
                    'title' => esc_html__( 'Title', 'venam' ),
                ],
                'default' => 'id',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'archives'],
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'sidebar_widgets_style',
            [
                'label' => esc_html__('STYLE', 'venam'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'widget_heading',
            [
                'label' => esc_html__( 'WIDGET STYLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'widget_marginbottom',
            [
                'label' => esc_html__( 'Bottom Spacing', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .sidebar--widgets' => 'margin-bottom: {{SIZE}}px;',
                ]
            ]
        );
        $this->add_responsive_control( 'widget_padding',
            [
                'label' => esc_html__( 'Widget Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .sidebar--widgets' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
            ]
        );
        $this->add_control( 'widget_bgcolor',
            [
                'label' => esc_html__( 'Widget Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .sidebar--widgets' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'widget_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .sidebar--widgets'
            ]
        );
        $this->add_responsive_control( 'widget_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .sidebar--widgets' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE STYLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Title Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .widget-title'
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Title Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .widget-title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE STYLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data' => 'banner']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .ads-widget img',
                'condition' => ['data' => 'banner']
            ]
        );
        $this->add_responsive_control( 'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .ads-widget img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'condition' => ['data' => 'banner']
            ]
        );
        $this->add_control( 'link_heading',
            [
                'label' => esc_html__( 'LINK STYLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} .sidebar--widgets .widget-wrap a',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'link_color',
            [
                'label' => esc_html__( 'Link Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .sidebar--widgets .widget-wrap a' => 'color:{{VALUE}};' ],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'link_hvrcolor',
            [
                'label' => esc_html__( 'Hover Link Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .sidebar--widgets .widget-wrap a:hover' => 'color:{{VALUE}};' ],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'search_heading',
            [
                'label' => esc_html__( 'SEARCH STYLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} form.sidebar_search input' => 'background-color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_color',
            [
                'label' => esc_html__( 'Text Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} form.sidebar_search input' => 'color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_responsive_control( 'form_padding',
            [
                'label' => esc_html__( 'Input Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} form.sidebar_search input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_border',
                'label' => esc_html__( 'Input Border', 'venam' ),
                'selector' => '{{WRAPPER}} form.sidebar_search input',
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_responsive_control( 'form_border_radius',
            [
                'label' => esc_html__( 'Input Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} form.sidebar_search input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_btncolor',
            [
                'label' => esc_html__( 'Submit Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} form.sidebar_search button[type="submit"].btn-secondary' => 'color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_hvrbtncolor',
            [
                'label' => esc_html__( 'Hover Submit Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} form.sidebar_search button[type="submit"].btn-secondary:hover' => 'color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_btnbgcolor',
            [
                'label' => esc_html__( 'Submit Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} form.sidebar_search button[type="submit"].btn-secondary' => 'background-color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_hvrbtnbgcolor',
            [
                'label' => esc_html__( 'Hover Submit Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} form.sidebar_search button[type="submit"].btn-secondary:hover' => 'background-color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $tag = $settings['tag'];

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }

        if ( 'search' == $settings['data'] ) {

            echo'<div class="sidebar--widgets widget blog-sidebar-widget blog-sidebar__search">';
                if ( $settings['title'] ) {
                    echo '<div class="blog-sidebar-title mb-25">';
                        echo '<'.$tag.' class="widget-heading">'.$settings['title'].'</'.$tag.'>';
                    echo '</div>';
                }
                echo'<div class="widget-wrap nt-sidebar-elementor">';
                    echo venam_search_form();
                echo'</div>';
            echo'</div>';

        }

        if ( 'form' == $settings['data'] ) {
            echo'<div class="sidebar--widgets widget blog-sidebar-widget sidebar--widget_forms">';
                if ( $settings['title'] ) {
                    echo '<div class="blog-sidebar-title mb-25">';
                        echo '<'.$tag.' class="widget-heading">'.$settings['title'].'</'.$tag.'>';
                    echo '</div>';
                }
                echo'<div class="sidebar-newsletter">';
                    echo do_shortcode( '[contact-form-7 id="'.$settings['cf7_id'].'"]' );
                echo'</div>';
            echo'</div>';
        }

        if ( 'banner' == $settings['data'] ) {
            echo'<div class="sidebar--widgets widget blog-sidebar-widget sidebar--widget_forms">';
                if ( $settings['title'] ) {
                    echo '<div class="blog-sidebar-title mb-25">';
                        echo '<'.$tag.' class="widget-heading">'.$settings['title'].'</'.$tag.'>';
                    echo '</div>';
                }
                echo'<div class="blog-sidebar-banner special-offer-banner">';
                    $target = !empty( $settings['link']['is_external'] ) ? ' target="_blank"' : '';
                    $rel = !empty( $settings['link']['nofollow'] ) ? ' rel="nofollow"' : '';
                    echo'<a href="'.$settings['link']['url'].'"'.$target.$rel.'>';
                        echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'sb-img'] );
                    echo'</a>';
                    echo'</div>';
                echo'</div>';
            echo'</div>';
        }

        if ( 'socials' == $settings['data'] ) {
            echo'<div class="sidebar--widgets widget blog-sidebar-widget sidebar--widget_socials">';
                if ( $settings['title'] ) {
                    echo '<div class="blog-sidebar-title mb-25">';
                        echo '<'.$tag.' class="widget-heading">'.$settings['title'].'</'.$tag.'>';
                    echo '</div>';
                }
                echo'<div class="widget-wrap">';
                    echo'<div class="social-widget">';
                        foreach ( $settings['socials'] as $icon ) {
                            if ( !empty( $icon['icon']['value'] ) ) {
                                echo'<div class="social_link '.$icon['name'].'"><a href="'.$icon['link']['url'].'" title="'.$icon['name'].'">';
                                    Icons_Manager::render_icon( $icon['icon'], [ 'aria-hidden' => 'true' ] );
                                echo '</div></a>';
                            }
                        }
                    echo'</div>';
                echo'</div>';
            echo'</div>';
        }

        if ( 'cats' == $settings['data'] ) {
            echo'<div class="sidebar--widgets widget blog-sidebar-widget sidebar--widget_cats">';
                if ( $settings['title'] ) {
                    echo '<div class="blog-sidebar-title mb-25">';
                        echo '<'.$tag.' class="widget-heading">'.$settings['title'].'</'.$tag.'>';
                    echo '</div>';
                }
                echo'<div class="blog-cat-list">';
                    echo '<ul>';
                    echo wp_list_categories(array(
                        'depth' => 0,
                        'echo' => 1,
                        'class' => 'cat-item',
                        'hierarchical' => true,
                        'order' => $settings['order'],
                        'separator' => '',
                        'style' => 'list',
                        'title_li' => '',
                        'show_count' => 0,
                    ));
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        }

        if ( 'tags' == $settings['data'] ) {
            echo '<div class="sidebar--widgets widget blog-sidebar-widget blog-sidebar__tags">';
                if ( $settings['title'] ) {
                    echo '<div class="blog-sidebar-title mb-25">';
                        echo '<'.$tag.' class="widget-heading">'.$settings['title'].'</'.$tag.'>';
                    echo '</div>';
                }
                echo '<div class="blog-sidebar-tag">';
                    echo '<ul>';
                        $tags = get_tags(array(
                          'taxonomy' => 'post_tag',
                          'orderby' => 'name',
                          'hide_empty' => true // for development
                        ));
                        if ( !empty( $tags ) ) {
                            foreach ( $tags as $tag ) {
                                echo '<li><a href="'. get_term_link($tag).'" title="'.$tag->name.'">'.$tag->name.'</a></li>';
                            }
                        }
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        }

        if ( 'archives' == $settings['data'] ) {
            echo '<div class="sidebar--widgets widget blog-sidebar-widget sidebar--widget_archives">';
                if ( $settings['title'] ) {
                    echo '<div class="blog-sidebar-title mb-25">';
                        echo '<'.$tag.' class="widget-heading">'.$settings['title'].'</'.$tag.'>';
                    echo '</div>';
                }
                $args = array(
                    'type'            => $settings['type'],
                    'limit'           => $settings['limit'],
                    'format'          => 'html',
                    'before'          => '',
                    'after'           => '',
                    'show_post_count' => true,
                    'echo'            => 1,
                    'order'           => $settings['order']
                );
                echo '<div class="blog-cat-list">';
                    echo '<ul>';
                        wp_get_archives( $args );
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        }

        if ( 'recent' == $settings['data'] ) {

            $args = array(
                'numberposts' => $settings['limit'],
                'post_type'   => $settings['post_type'],
                'post_status' => 'publish',
                'order'       => $settings['order']
            );
            $recents = wp_get_recent_posts( $args );
            echo '<div class="sidebar--widgets widget blog-sidebar-widget blog-sidebar__recentpost">';
                if ( $settings['title'] ) {
                    echo '<div class="blog-sidebar-title mb-25">';
                        echo '<'.$tag.' class="widget-heading">'.$settings['title'].'</'.$tag.'>';
                    echo '</div>';
                }
                echo '<div class="blog-rc-post">';
                    echo '<ul>';
                    foreach( $recents as $recent ) {
                        $title = apply_filters( 'the_title', $recent['post_title'], $recent['ID'] );
                        echo '<li>';
                            echo '<div class="rc-post-thumb">';
                                echo '<a href="'.esc_url( get_permalink( $recent['ID'] ) ).'" class="thumb hover-effect">';
                                    echo get_the_post_thumbnail( $recent['ID'], $size, ['class'=>'post--img'] );
                                echo '</a>';
                            echo '</div>';
                            echo '<div class="rc-post-content">';
                                echo '<h5><a href="'.esc_url( get_permalink( $recent['ID'] ) ).'">'.$recent['post_title'].'</a></h5>';
                                echo '<span>'.get_the_date().'</span>';
                            echo '</div>';
                        echo '</li>';
                    }
                echo '</ul>';
            echo '</div>';
        }

    }
}
