<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Venam_Posts_Base extends Widget_Base {
    use Venam_Helper;
    public function get_name() {
        return 'venam-posts-base';
    }
    public function get_title() {
        return 'Posts Base (N)';
    }
    public function get_icon() {
        return 'eicon-shortcode';
    }
    public function get_categories() {
        return [ 'venam' ];
    }
    protected function register_controls() {
        $this->start_controls_section( 'section_query',
            [
                'label' => __( 'Query', 'venam' ),
            ]
        );

        $this->venam_query_controls('post');

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_options',
            [
                'label' => esc_html__( 'Post Options', 'venam' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'collg',
            [
                'label' => esc_html__( 'Column for Large Device', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '3' => esc_html__( '4 Column', 'venam' ),
                    '4' => esc_html__( '3 Column', 'venam' ),
                    '6' => esc_html__( '2 Column', 'venam' ),
                    '12' => esc_html__( '1 Column', 'venam' ),
                ],
                'default' => '4'
            ]
        );
        $this->add_control( 'colmd',
            [
                'label' => esc_html__( 'Column for Medium Device', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '4' => esc_html__( '3 Column', 'venam' ),
                    '6' => esc_html__( '2 Column', 'venam' ),
                    '12' => esc_html__( '1 Column', 'venam' ),
                ],
                'default' => '6'
            ]
        );
        $this->add_control( 'colsm',
            [
                'label' => esc_html__( 'Column for Small Device', 'venam' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__( '2 Column', 'venam' ),
                    '12' => esc_html__( '1 Column', 'venam' ),
                ],
                'default' => '12',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'venam-square',
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
        $this->add_control( 'hidecomments',
            [
                'label' => esc_html__( 'Hide Comments', 'venam' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'venam' ),
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

        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<div class="blog-post-items">';
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    echo '<div class="blog-post-item mb-60">';
                        if ( has_post_thumbnail() ) {
                            echo '<div class="blog-thumb mb-25">';
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
                                        printf( '<li><i class="far fa-user"></i><a href="%1$s" title="%2$s"><i class="far fa-user-circle"></i> %2$s</a></li>',
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
