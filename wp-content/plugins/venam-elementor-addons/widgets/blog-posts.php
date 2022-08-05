<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Venam_Blog_Posts extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-blog-posts';
    }
    public function get_title() {
        return 'Blog Posts (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    public function get_script_depends() {
        return [ 'slick' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_query',
            [
                'label' => esc_html__( 'Query', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->venam_query_controls( 'post' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_options',
            [
                'label' => esc_html__( 'Post Options', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'grid' => esc_html__( 'Grid', 'venam' ),
                    'slider' => esc_html__( 'Slider', 'venam' ),
                ]
            ]
        );
        $this->add_responsive_control( 'column',
            [
                'label' => esc_html__( 'Column Width', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 3,
                'selectors' => [ '{{WRAPPER}} .blog-post-item' => '-ms-flex: 0 0 calc(100% / {{VALUE}} );flex: 0 0 calc(100% / {{VALUE}} );max-width: calc(100% / {{VALUE}} );' ],
                'condition' => ['type' => 'grid']
            ]
        );
        $this->add_responsive_control( 'content_alignment',
            [
                'label' => esc_html__( 'Content Alignment', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'center' => esc_html__( 'Center', 'venam' ),
                    'start' => esc_html__( 'Left', 'venam' ),
                    'end' => esc_html__( 'Right', 'venam' ),
                ],
                'condition' => ['type' => 'grid']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'venam-square',
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hidedate',
            [
                'label' => esc_html__( 'Hide Date', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hideauthor',
            [
                'label' => esc_html__( 'Hide Author', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'excerpt_limit',
            [
                'label' => esc_html__( 'Excerpt Word Limit', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 20,
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->add_control( 'hidebtn',
            [
                'label' => esc_html__( 'Hide Button', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Read More Title', 'venam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read more',
                'label_block' => true,
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->add_control( 'pagination',
            [
                'label' => esc_html__( 'Hide Button', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_options_section',
            [
                'label'=> esc_html__( 'SLIDER OPTIONS', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['type' => 'slider']
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Infinite', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'arrows',
            [
                'label' => esc_html__( 'Arrows', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 10000,
                'step' => 100,
                'default' => 1000,
            ]
        );
        $this->add_control( 'items',
            [
                'label' => esc_html__( 'Items', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 4,
            ]
        );
        $this->add_control( 'mditems',
            [
                'label' => esc_html__( 'Items', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
            ]
        );
        $this->add_control( 'smitems',
            [
                'label' => esc_html__( 'Items Tablet', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 3,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control( 'xsitems',
            [
                'label' => esc_html__( 'Items Phone', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 2,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label'=> esc_html__( 'STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'image_sdivider',
            [
                'label' => esc_html__( 'IMAGE', 'venam' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'img_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .blog-thumb img',
            ]
        );
        $this->add_responsive_control( 'img_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .blog-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'title_sdivider',
            [
                'label' => esc_html__( 'TITLE', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h1' => esc_html__( 'H1', 'venam' ),
                    'h2' => esc_html__( 'H2', 'venam' ),
                    'h3' => esc_html__( 'H3', 'venam' ),
                    'h4' => esc_html__( 'H4', 'venam' ),
                    'h5' => esc_html__( 'H5', 'venam' ),
                    'h6' => esc_html__( 'H6', 'venam' ),
                    'div' => esc_html__( 'div', 'venam' ),
                    'p' => esc_html__( 'p', 'venam' ),
                ]
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-post-content .title a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-post-content .title a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} {{WRAPPER}} .blog-post-content .title'
            ]
        );
        $this->add_control( 'meta_sdivider',
            [
                'label' => esc_html__( 'POST META', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'meta_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-post-meta ul li a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'meta_hvrcolor',
            [
                'label' => esc_html__( 'Link Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-post-meta ul li a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'metaicon_color',
            [
                'label' => esc_html__( 'Icon Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-post-meta ul li i' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'text_sdivider',
            [
                'label' => esc_html__( 'EXCERPT', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'text_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-post-content p' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typo',
                'label' => esc_html__( 'Typography', 'venam' ),
                'selector' => '{{WRAPPER}} {{WRAPPER}} .blog-post-content p'
            ]
        );
        $this->add_control( 'btn_sdivider',
            [
                'label' => esc_html__( 'BUTTON', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-post-content .read-more' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'btn_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-post-content .read-more:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_nav_style_section',
            [
                'label'=> esc_html__( 'SLIDER ARROW STYLE', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['type' => 'slider']
            ]
        );
        $this->add_control( 'slider_nav_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-arrow' => 'width: {{SIZE}}px;height: {{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'slider_nav_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-arrow' => 'font-size: {{SIZE}}px;' ]
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
               'selectors' => ['{{WRAPPER}} .popular-active .slick-arrow' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_clr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .popular-active .slick-arrow i' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .popular-active .slick-arrow',
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
               'selectors' => ['{{WRAPPER}} .popular-active .slick-arrow:hover' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_hvrclr',
           [
               'label' => esc_html__( 'Color', 'venam' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .popular-active .slick-arrow:hover i' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvr_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .popular-active .slick-arrow:hover',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'prev_heading',
            [
                'label' => esc_html__( 'PREV POSITION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-prev' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-prev' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'next_heading',
            [
                'label' => esc_html__( 'NEXT POSITION', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-next' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'next_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popular-active .slick-next' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'pagination_style_section',
            [
                'label'=> esc_html__( 'Pagination Style', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->add_responsive_control( 'pag_padding',
            [
                'label' => esc_html__( 'Padding', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .nt-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_responsive_control( 'pag_margin',
            [
                'label' => esc_html__( 'Margin', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .nt-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'pag_sdivider',
            [
                'label' => esc_html__( 'BUTTON', 'venam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'pag_size',
            [
                'label' => esc_html__( 'Size', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-numbers' => 'width: {{SIZE}}px;height: {{SIZE}}px;' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'pag_space',
            [
                'label' => esc_html__( 'Spacing', 'venam' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-numbers:not(:last-child)' => 'margin-right: {{SIZE}}px;' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->start_controls_tabs( 'pag_tabs');
        $this->start_controls_tab( 'pag_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'venam' ) ]
        );
        $this->add_control( 'pag_color',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .page-numbers' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'pag_bgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .page-numbers' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pag_border',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .page-numbers',
            ]
        );
        $this->add_responsive_control( 'pag_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'pag_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'venam' ) ]
        );
        $this->add_control( 'pag_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .page-numbers:hover,{{WRAPPER}} .page-numbers.current' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'pag_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'venam' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .page-numbers:hover,{{WRAPPER}} .page-numbers.current' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pag_hvrborder',
                'label' => esc_html__( 'Border', 'venam' ),
                'selector' => '{{WRAPPER}} .page-numbers:hover,{{WRAPPER}} .page-numbers.current',
            ]
        );
        $this->add_responsive_control( 'pag_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'venam' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .page-numbers:hover,{{WRAPPER}} .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if ( is_home() || is_front_page() ) {
            $paged = get_query_var( 'page') ? get_query_var('page') : 1;
        } else {
            $paged = get_query_var( 'paged') ? get_query_var('paged') : 1;
        }

        $args['post_type']      = $settings['post_type'];
        $args['posts_per_page'] = $settings['posts_per_page'];
        $args['offset']         = $settings['offset'];
        $args['order']          = $settings['order'];
        $args['orderby']        = $settings['orderby'];
        $args['paged']          = $paged;
        $args[$settings['author_filter_type']] = $settings['author'];


        $post_type = $settings['post_type'];

        if ( ! empty( $settings[ $post_type . '_filter' ] ) ) {
            $args[ $settings[ $post_type . '_filter_type' ] ] = $settings[ $post_type . '_filter' ];
        }

        // Taxonomy Filter.
        $taxonomy = $this->get_post_taxonomies( $post_type );

        if ( ! empty( $taxonomy ) && ! is_wp_error( $taxonomy ) ) {

            foreach ( $taxonomy as $index => $tax ) {

                $tax_control_key = $index . '_' . $post_type;

                if ( $post_type == 'post' ) {
                    if ( $index == 'post_tag' ) {
                        $tax_control_key = 'tags';
                    } elseif ( $index == 'category' ) {
                        $tax_control_key = 'categories';
                    }
                }

                if ( ! empty( $settings[ $tax_control_key ] ) ) {

                    $operator = $settings[ $index . '_' . $post_type . '_filter_type' ];

                    $args['tax_query'][] = array(
                        'taxonomy' => $index,
                        'field' => 'term_id',
                        'terms' => $settings[ $tax_control_key ],
                        'operator' => $operator,
                    );
                }
            }
        }

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $type = 'class="blog-post-items justify-content-'.$settings['content_alignment'].'"';
        if ( 'slider' == $settings['type'] ) {
            $rtl = is_rtl() ? 'true' : 'false';
            $loop = 'yes' == $settings['loop'] ? 'true': 'false';
            $autoplay = 'yes' == $settings['autoplay'] ? 'true': 'false';
            $arrows = 'yes' == $settings['arrows'] ? '"arrows": true,"prevArrow":"<button type=\"button\" class=\"slick-prev\"><i class=\"fas fa-angle-left\"></i></button>","nextArrow":"<button type=\"button\" class=\"slick-next\"><i class=\"fas fa-angle-right\"></i></button>"' : '"arrows": false';
            $type = 'class="blog-post-items popular-active thm-slick__slider" data-slick=\'{"rtl":'.$rtl.',"autoplay":'.$autoplay.',"infinite": '.$loop.',"speed": '.$settings['speed'].',"slidesToShow": '.$settings['items'].',"slidesToScroll": 1,"adaptiveHeight": true,'.$arrows.',"responsive": [{"breakpoint": 1025,"settings": {"slidesToShow": '.$settings['mditems'].',"slidesToScroll": 1}},{"breakpoint": 790,"settings": {"slidesToShow": '.$settings['smitems'].',"slidesToScroll": 1}},{"breakpoint": 576,"settings": {"slidesToShow": '.$settings['xsitems'].',"slidesToScroll": 1}}]}\'';
        }

        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<div '.$type.'>';
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    echo '<div class="blog-post-item blog-grid-item text-center mb-60">';
                        if ( has_post_thumbnail() ) {
                            echo '<div class="blog-thumb">';
                                echo '<a href="'.get_permalink().'">';the_post_thumbnail( $size, ['class'=>'b-img'] );echo '</a>';
                            echo '</div>';
                        }
                        echo '<div class="blog-post-content">';
                            if ( 'yes' != $settings[ 'hidetitle' ] ) {
                                echo '<'.$settings['tag'].' class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></'.$settings['tag'].'>';
                            }
                            if ( 'yes' != $settings['hideauthor'] || 'yes' != $settings['hidedate'] ) {
                                echo '<div class="blog-post-meta">';
                                    echo '<ul>';
                                    if ( 'yes' != $settings['hideauthor'] ) {
                                        printf( '<li><i class="far fa-user"></i><a href="%1$s" title="%2$s"> %2$s</a></li>',
                                            get_author_posts_url( get_the_author_meta( 'ID' ) ),
                                            get_the_author()
                                        );
                                    }
                                    if ( 'yes' != $settings['hidedate'] ) {
                                        $archive_year  = get_the_time( 'Y' );
                                        $archive_month = get_the_time( 'm' );
                                        $archive_day   = get_the_time( 'd' );
                                        printf( '<li><i class="far fa-calendar-alt"></i><a href="%1$s" title="%1$s">%2$s %3$s</a></li>',
                                            esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                                            get_the_time( 'd' ),
                                            get_the_time( 'M' )
                                        );
                                    }
                                    echo '</ul>';
                                echo '</div>';
                            }
                            if ( 'yes' != $settings[ 'hideexcerpt' ] && has_excerpt() ) {
                                echo '<p class="excerpt">'.wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ).'</p>';
                            }
                            if ( $settings[ 'btn_title' ] && 'yes' != $settings[ 'hidebtn' ] ) {
                                echo '<a class="read-more" href="'.get_permalink().'">'.$settings[ 'btn_title' ].'</a>';
                            }
                        echo '</div>';
                    echo '</div>';
                }
                wp_reset_postdata();
                if ( $settings['pagination'] == 'yes' ) {
                    echo '<div class="nt-pagination d-flex justify-content-center align-items-center">';
                        if ( $the_query->max_num_pages > 1){
                            echo paginate_links(array(
                                'base' => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max(1, $paged ),
                                'total' => $the_query->max_num_pages,
                                'type' => '',
                                'prev_text' => '<i class="fa fa-angle-left"></i>',
                                'next_text' => '<i class="fa fa-angle-right"></i>',
                                'before_page_number' => '<div class="nt-pagination-item">',
                                'after_page_number' => '</div>'
                            ));
                        }
                    echo '</div>';
                }
            echo '</div>';

        } else {
            echo '<p class="text">' . esc_html__( 'No post found!', 'venam' ) . '</p>';
        }
    }
}
