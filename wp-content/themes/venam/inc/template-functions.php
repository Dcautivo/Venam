<?php
/**
 * Functions which enhance the theme by hooking into WordPress
*/


/*************************************************
## ADMIN NOTICES
*************************************************/

function venam_theme_activation_notice()
{
    global $current_user;

    $user_id = $current_user->ID;

    if (!get_user_meta($user_id, 'venam_theme_activation_notice')) {
        ?>
        <div class="updated notice">
            <p>
                <?php
                    echo sprintf(
                    esc_html__( 'If you need help about demodata installation, please read docs and %s', 'venam' ),
                    '<a target="_blank" href="' . esc_url( 'https://ninetheme.com/contact/' ) . '">' . esc_html__( 'Open a ticket', 'venam' ) . '</a>
                    ' . esc_html__('or', 'venam') . ' <a href="' . esc_url( wp_nonce_url( add_query_arg( 'venam-ignore-notice', 'dismiss_admin_notices' ), 'venam-dismiss-' . get_current_user_id() ) ) . '">' . esc_html__( 'Dismiss this notice', 'venam' ) . '</a>');
                ?>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'venam_theme_activation_notice' );

function venam_theme_activation_notice_ignore()
{
    global $current_user;

    $user_id = $current_user->ID;

    if ( isset($_GET[ 'venam-ignore-notice' ] ) ) {
        add_user_meta($user_id, 'venam_theme_activation_notice', 'true', true);
    }
}
add_action( 'admin_init', 'venam_theme_activation_notice_ignore' );


/*************************************************
## DATA CONTROL FROM THEME-OPTIONS PANEL
*************************************************/
if ( ! function_exists( 'venam_settings' ) ) {
    function venam_settings( $opt_id, $def_value='' )
    {
        if ( !class_exists( 'Redux' ) ) {
            return $def_value;
        }

        global $venam;

        $defval = '' != $def_value ? $def_value : false;
        $opt_id = trim( $opt_id );
        $opt    = isset( $venam[ $opt_id ] ) ? $venam[ $opt_id ] : $defval;

        return $opt;
    }
}


/*************************************************
## Sidebar function
*************************************************/
if ( ! function_exists( 'venam_sidebar' ) ) {
    function venam_sidebar( $sidebar='', $default='' )
    {
        $sidebar = trim( $sidebar );
        $default = is_active_sidebar( $default ) ? $default : false;
        $sidebar = is_active_sidebar( $sidebar ) ? $sidebar : $default;
        if ( $sidebar ) {
            return $sidebar;
        }
        return false;
    }
}

/*************************************************
## Get options
*************************************************/
if ( ! function_exists( 'venam_get_option' ) ) {
    function venam_get_option() {
        $getopt = isset( $_GET['opt'] ) ? $_GET['opt'] : '';
        return esc_html($getopt);
    }
}

/*************************************************
## GET ALL ELEMENTOR PAGE TEMPLATES
# @return array
*************************************************/
if ( ! function_exists( 'venam_get_elementorTemplates' ) ) {
    function venam_get_elementorTemplates( $type = null )
    {
        if ( class_exists( '\Elementor\Plugin' ) ) {

            $args = [
                'post_type' => 'elementor_library',
                'posts_per_page' => -1,
            ];

            $templates = get_posts( $args );
            $options = array();

            if ( !empty( $templates ) && !is_wp_error( $templates ) ) {
                foreach ( $templates as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            } else {
                $options = array(
                    '' => esc_html__( 'No template exist.', 'venam' )
                );
            }

            return $options;
        }
    }
}


/*************************************************
## GET ALL ELEMENTOR PAGE TEMPLATES
# @return array
*************************************************/
if ( ! function_exists( 'venam_get_elementorCategories' ) ) {
    function venam_get_elementorCategories()
    {
        if ( class_exists( '\Elementor\Plugin' ) ) {

            $terms = get_terms('elementor_library_category');

            $options = array(
                '' => esc_html__('None','venam')
            );

            if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $options[ $term->term_id ] = $term->name;
                }
            }

            return $options;
        }
    }
}

/**
 * Enqueue styles and scripts.
 */
if ( ! function_exists( 'venam_elementor_enqueue_scripts' ) ) {
    add_action( 'wp_enqueue_scripts', 'venam_elementor_enqueue_scripts' );
    function venam_elementor_enqueue_scripts() {

        if ( class_exists( '\Elementor\Plugin' ) ) {
            $elementor = \Elementor\Plugin::instance();
            $elementor->frontend->enqueue_styles();
        }

        if ( class_exists( '\ElementorPro\Plugin' ) ) {
            $elementor_pro = \ElementorPro\Plugin::instance();
            $elementor_pro->enqueue_styles();
        }

        if ( 'elementor' == venam_settings('header_template') ) {
            if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                $css_file = new \Elementor\Core\Files\CSS\Post( venam_settings('header_elementor_templates') );
            } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                $css_file = new \Elementor\Post_CSS_File( venam_settings('header_elementor_templates') );
            }
            $css_file->enqueue();
        }

        if ( 'elementor' == venam_settings('footer_template') ) {
            if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                $css_file = new \Elementor\Core\Files\CSS\Post( venam_settings('footer_elementor_templates') );
            } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                $css_file = new \Elementor\Post_CSS_File( venam_settings('footer_elementor_templates') );
            }
            $css_file->enqueue();
        }
    }
}

 /*************************************************
 ## WPML && POLYLANG Compatibility for Elementor Templates.
 *************************************************/
if ( ! function_exists( 'venam_get_wpml_object' ) ) {
    add_filter( 'venam_translated_template_id', 'venam_get_wpml_object' );
    function venam_get_wpml_object( $id ) {
        $translated_id = apply_filters( 'wpml_object_id', $id );

        if ( defined( 'POLYLANG_BASENAME' ) ) {

            if ( null === $translated_id ) {

                // The current language is not defined yet or translation is not available.
                return $id;
            } else {

                // Return translated post ID.
                return pll_get_post( $translated_id );
            }
        }

        if ( null === $translated_id ) {
            $translated_id = '';
        }

        return $translated_id;
    }
}
/*************************************************
## GET ELEMENTOR DEFAULT STYLE KIT ID
*************************************************/
if ( ! function_exists( 'venam_get_elementor_activeKit' ) ) {
    function venam_get_elementor_activeKit()
    {
        return get_option( 'elementor_active_kit' );
    }
}


/*************************************************
## CHECK IS ELEMENTOR
*************************************************/
if ( ! function_exists( 'venam_check_is_elementor' ) ) {
    function venam_check_is_elementor()
    {
        global $post;
        if ( class_exists( '\Elementor\Plugin' ) ) {
            return \Elementor\Plugin::$instance->db->is_built_with_elementor( $post->ID );
        }
        return false;
    }
}

/*************************************************
## PRINT ELEMENTOR CURRENT TEMPLATE
*************************************************/
if ( ! function_exists( 'venam_print_elementor_templates' ) ) {
    function venam_print_elementor_templates( $option_id, $wrapper_class='', $css=false )
    {
        if ( !class_exists( '\Elementor\Frontend' ) ) {
            return;
        }
        $css = $css ? true : false;
        $id = $option_id ? venam_settings( $option_id, null ) : '';

        if ( $id ) {

            $template_id = apply_filters( 'venam_translated_template_id', intval( $id ) );
            $frontend = new \Elementor\Frontend;
            if ( $wrapper_class ) {
                return sprintf( '<div class="'.$wrapper_class.'">%1$s</div>', $frontend->get_builder_content( $template_id, $css ) );
            } else {
                return sprintf( '%1$s', $frontend->get_builder_content( $template_id, $css ) );
            }
        }
    }
}
/*************************************************
## PRINT ELEMENTOR TEMPLATE BY CATEGORY
*************************************************/
if ( ! function_exists( 'venam_print_elTemplates_by_category' ) ) {
    function venam_print_elTemplates_by_category( $cat_id, $wrapper_class,$css=false )
    {
        if ( !$cat_id || !class_exists( '\Elementor\Frontend' ) ) {
            return;
        }

        $args = array(
            'post_type' => 'elementor_library',
            'post_status' => 'publish',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'elementor_library_category',
                    'field'    => 'id',
                    'terms'    => $cat_id
                ),
                array(
                    'taxonomy' => 'elementor_library_type',
                    'field'    => 'slug',
                    'terms'    => 'section'
                )
            )
        );

        $posts = get_posts( $args );

        foreach ( $posts as $post ) {
            $template_id = apply_filters( 'venam_translated_template_id', intval( $post->ID ) );
            $frontend = new \Elementor\Frontend;
            if ( $wrapper_class ) {
                printf( '<div class="'.$wrapper_class.'">%1$s</div>', $frontend->get_builder_content( $template_id, $css ) );
            } else {
                printf( '%1$s', $frontend->get_builder_content( $template_id, $css ) );
            }
        }
    }
}

/*************************************************
## PAGE HEADER-FOOTER ON-OFF
*************************************************/
if ( ! function_exists( 'venam_page_header_footer_manager' ) ) {
    function venam_page_header_footer_manager()
    {
        if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {

            $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
            $hide_header = $page_settings->get_settings( 'venam_hide_page_header' );
            $hide_footer = $page_settings->get_settings( 'venam_hide_page_footer' );

            if ( 'yes' == $hide_header ) {
                remove_action( 'venam_header_action', 'venam_main_header', 10 );
            }
            if ( 'yes' == $hide_footer ) {
                remove_action( 'venam_footer_action', 'venam_footer', 10 );
            }
        }
    }
}

/*************************************************
## CHECK IF PAGE HERO
*************************************************/

if ( !function_exists( 'venam_check_page_hero' ) ) {
    function venam_check_page_hero()
    {
        if ( is_404() ) {

            $name = 'error';

        } elseif ( is_archive() ) {

            $name = 'archive';

        } elseif ( is_search() ) {

            $name = 'search';

        } elseif ( is_home() || is_front_page() ) {

            $name = 'blog';

        } elseif ( is_single() ) {

            $name = 'single';

        } elseif ( is_page() ) {

            $name = 'page';

        }
        $h_v = venam_settings( $name.'_hero_visibility', '1' );
        $h_v = '0' == $h_v ? 'page-hero-off' : '';
        return $h_v;
    }
}

/**
* ------------------------------------------------------------------------------------------------
* is ajax request
* ------------------------------------------------------------------------------------------------
*/

if( ! function_exists( 'venam_is_pjax' ) ) {
    function venam_is_pjax(){
        $request_headers = function_exists( 'getallheaders') ? getallheaders() : array();

        $is_pjax = isset( $_REQUEST['_pjax'] ) && ( ( isset( $request_headers['X-Requested-With'] ) && 'xmlhttprequest' === strtolower( $request_headers['X-Requested-With'] ) ) || ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && 'xmlhttprequest' === strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ) );

        return $is_pjax ? true : false;
    }
}

/*************************************************
## CUSTOM BODY CLASSES
*************************************************/
if ( !function_exists( 'venam_body_theme_classes' ) ) {
    function venam_body_theme_classes( $classes )
    {
        global $post,$is_IE, $is_safari, $is_chrome, $is_iphone;

        $classes[] = class_exists( 'WooCommerce' ) && ! is_cart() && ! is_account_page() ? 'nt-page-default' : '';
        $classes[] = class_exists( 'WooCommerce' ) && is_shop() && !woocommerce_product_loop()? 'not-found' : '';
        $classes[] = '1' == venam_settings('shop_ajax_filter', '0' ) ? 'venam-ajax-shop' : '';
        $classes[] =  'fixed' == venam_settings('shop_sidebar_position', 'default' ) || 'fixed-sidebar' == venam_get_option() ? 'shop-sidebar-fixed' : 'shop-sidebar-default';
        $classes[] = wp_get_theme();
        $classes[] = wp_get_theme() . '-v' . wp_get_theme()->get( 'Version' );
        $classes[] = is_admin_bar_showing() ? 'adminbar--active' : '';
        $classes[] = '0' == venam_settings( 'preloader_visibility', '1' ) ? 'preloader-off' : 'preloader-on';
        $classes[] = '0' == venam_settings( 'header_visibility', '1' ) ? 'header-off' : '';
        $classes[] = 'elementor' == venam_settings( 'header_template', 'default' ) && '' != venam_settings( 'header_elementor_templates', '' ) ? 'has-elementor-header-template' : '';
        $classes[] = 'elementor' == venam_settings( 'footer_template', 'default' ) && '' != venam_settings( 'footer_elementor_templates', '' ) ? 'has-elementor-footer-template' : '';
        $classes[] = venam_check_page_hero();
        $classes[] = is_singular( 'post' ) && has_blocks() ? 'nt-single-has-block' : '';
        $classes[] = is_page() && comments_open() ? 'page-has-comment' : '';
        $classes[] = is_singular( 'post' ) && !has_post_thumbnail() ? 'nt-single-thumb-none' : '';
        $classes[] = $is_IE ? 'nt-msie' : '';
        $classes[] = $is_chrome ? 'nt-chrome' : '';
        $classes[] = $is_iphone ? 'nt-iphone' : '';
        $classes[] = function_exists('wp_is_mobile') && wp_is_mobile() ? 'nt-mobile' : 'nt-desktop';

        return $classes;

    }
    add_filter( 'body_class', 'venam_body_theme_classes' );
}


/*************************************************
## CUSTOM POST CLASS
*************************************************/
if ( !function_exists( 'venam_post_theme_class' ) ) {
    function venam_post_theme_class( $classes )
    {
        if ( ! is_single() AND ! is_page() ) {
            $classes[] = 'nt-post-class';
            $classes[] = is_sticky() ? '-has-sticky ' : '';
            $classes[] = !has_post_thumbnail() ? 'thumb-none' : '';
            $classes[] = !get_the_title() ? 'title-none' : '';
            $classes[] = !has_excerpt() ? 'excerpt-none' : '';
            $classes[] = venam_settings( 'format_box_type', '' );
            $classes[] = wp_link_pages('echo=0') ? 'nt-is-wp-link-pages' : '';
        }

        return $classes;
    }
    add_filter( 'post_class', 'venam_post_theme_class' );
}


/*************************************************
## THEME SIDEBARS SEARCH FORM
*************************************************/
if ( !function_exists( 'venam_search_form' ) ) {
    function venam_search_form()
    {
        $form = '<form class="sidebar-search-form" role="search" method="get" id="widget-searchform" action="' . esc_url( home_url( '/' ) ) . '" >
        <input class="sidebar_search_input" type="text" value="' . get_search_query() . '" placeholder="'. esc_attr__( 'Search', 'venam' ) .'" name="s" id="ws">
        <button class="sidebar_search_button" id="searchsubmit" type="submit"><i class="fas fa-search"></i></button>
        </form>';
        return $form;
    }
    add_filter( 'get_search_form', 'venam_search_form' );

}
if ( !function_exists( 'venam_error_page_form' ) ) {
    function venam_error_page_form()
    {
        $form = '<div class="search_form"><form class="sidebar-search-form" role="search" method="get" id="widget-searchform" action="' . esc_url( home_url( '/' ) ) . '" >
        <input class="form-control" type="text" value="' . get_search_query() . '" placeholder="'. esc_attr__( 'Search', 'venam' ) .'" name="s" id="ws">
        <button type="submit" class="icon_search"><i class="flaticon-loupe"></i></button></form></div>';
        return $form;
    }
    add_filter( 'get_search_form', 'venam_error_page_form' );
}

/*************************************************
## THEME PASSWORD FORM
*************************************************/
if ( !function_exists( 'venam_custom_password_form' ) ) {
    function venam_custom_password_form()
    {
        global $post;
        $form = '<form class="form_password" role="password" method="get" id="widget-searchform" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass"><input class="form_password_input" type="password" placeholder="'. esc_attr__( 'Enter Password', 'venam' ) .'" name="post_password" id="ws"><button class="btn btn-fill-out" id="submit" type="submit"><span class="fa fa-arrow-right"></span></button></form>';

        return $form;
    }
    add_filter( 'the_password_form', 'venam_custom_password_form' );
}


/*************************************************
## EXCERPT FILTER
*************************************************/
if ( !function_exists( 'venam_custom_excerpt_more' ) ) {
    function venam_custom_excerpt_more( $more )
    {
        return '...';
    }
    add_filter( 'excerpt_more', 'venam_custom_excerpt_more' );
}

/*************************************************
## EXCERPT LIMIT
*************************************************/
if ( !function_exists( 'venam_excerpt_limit' ) ) {
    function venam_excerpt_limit( $limit )
    {
        $excerpt = explode( ' ', get_the_excerpt(), $limit );
        if ( count( $excerpt ) >= $limit ) {
            array_pop( $excerpt );
            $excerpt = implode( " ", $excerpt ) . '...';
        } else {
            $excerpt = implode( " ", $excerpt );
        }
        $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
        return $excerpt;
    }
}

/*************************************************
## DEFAULT CATEGORIES WIDGET
*************************************************/
if ( !function_exists( 'venam_add_span_cat_count' ) ) {
    function venam_add_span_cat_count( $links )
    {

        $links = str_replace( '</a> (', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( '</a> <span class="count">(', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( ')', '</span>', $links );

        return $links;

    }
    add_filter( 'wp_list_categories', 'venam_add_span_cat_count' );
}

/*************************************************
## woocommerce_layered_nav_term_html WIDGET
*************************************************/
if ( !function_exists( 'venam_add_span_woocommerce_layered_nav_term_html' ) ) {
    function venam_add_span_woocommerce_layered_nav_term_html( $links )
    {

        $links = str_replace( '</a> (', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( '</a> <span class="count">(', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( ')', '</span>', $links );

        return $links;

    }
    add_filter( 'woocommerce_layered_nav_term_html', 'venam_add_span_woocommerce_layered_nav_term_html' );
}


/*************************************************
## DEFAULT ARCHIVES WIDGET
*************************************************/
if ( !function_exists( 'venam_add_span_arc_count' ) ) {
    function venam_add_span_arc_count( $links )
    {
        $links = str_replace( '</a>&nbsp;(', '</a> <span class="widget-list-span">', $links );

        $links = str_replace( ')', '</span>', $links );

        // dropdown selectbox
        $links = str_replace( '&nbsp;(', ' - ', $links );

        return $links;

    }
    add_filter( 'get_archives_link', 'venam_add_span_arc_count' );
}

/*************************************************
## PAGINATION CUSTOMIZATION
*************************************************/
if ( !function_exists( 'venam_sanitize_pagination' ) ) {
    function venam_sanitize_pagination( $content )
    {
        // remove role attribute
        $content = str_replace( 'role="navigation"', '', $content );

        // remove h2 tag
        $content = preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $content );

        return $content;

    }
    add_action( 'navigation_markup_template', 'venam_sanitize_pagination' );
}

/*************************************************
## CUSTOM ARCHIVE TITLES
*************************************************/
if ( !function_exists( 'venam_archive_title' ) ) {
    function venam_archive_title()
    {
        $title = '';
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag()) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = get_the_author();
        } elseif ( is_year() ) {
            $title = get_the_date( _x( 'Y', 'yearly archives date format', 'venam' ) );
        } elseif ( is_month() ) {
            $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'venam' ) );
        } elseif ( is_day() ) {
            $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'venam' ) );
        } elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            $title = single_term_title( '', false );
        } else {
            $title = get_the_archive_title();
        }

        return $title;
    }
    add_filter( 'get_the_archive_title', 'venam_archive_title' );
}


/*************************************************
## CHECKS TO SEE IF CPT EXISTS.
*************************************************/
/*
* By setting '_builtin' to false,
* we exclude the WordPress built-in public post types
* (post, page, attachment, revision, and nav_menu_item)
* and retrieve only registered custom public post types.
* return boolean
*/
if ( !function_exists( 'venam_cpt_exists' ) ) {
    function venam_cpt_exists()
    {

        $args = array(
           'public' => true,
           '_builtin' => false
        );

        $output = 'names'; // 'names' or 'objects' (default: 'names')
        $operator = 'and'; // 'and' or 'or' (default: 'and')

        $post_types = get_post_types( $args, $output, $operator ); // get simple cpt if exists
        $classes = get_body_class();
        $cpt_exsits = array();

        if ( $post_types ) {
            foreach ( $post_types as $cpt ) {
                if ( is_single() ) {
                    array_push( $cpt_exsits, 'single-'.$cpt );
                }
                if ( is_archive() ) {
                    array_push( $cpt_exsits, 'post-type-archive-'.$cpt );
                }
            }
        }

        $sameclass = array_intersect( $cpt_exsits, $classes );

        if ( $sameclass ) {
            return true;
        }
        return false;
    }
}


/*************************************************
## CONVERT HEX TO RGB
*************************************************/

 if ( !function_exists( 'venam_hex2rgb' ) ) {
     function venam_hex2rgb( $hex )
     {
         $hex = str_replace( "#", "", $hex );

         if ( strlen( $hex ) == 3 ) {
             $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
             $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
             $b = hexdec(substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
         } else {
             $r = hexdec( substr( $hex, 0, 2 ) );
             $g = hexdec( substr( $hex, 2, 2 ) );
             $b = hexdec( substr( $hex, 4, 2 ) );
         }
         $rgb = array( $r, $g, $b );
         return implode(", ", $rgb); // returns with the rgb values
     }
 }

/**********************************
## THEME ALLOWED HTML TAG
/**********************************/

if ( !function_exists( 'venam_allowed_html' ) ) {
    function venam_allowed_html()
    {
        $allowed_tags = array(
            'a' => array(
                'class' => array(),
                'href' => array(),
                'rel' => array(),
                'title' => array(),
                'target' => array()
            ),
            'abbr' => array(
                'title' => array()
            ),
            'address' => array(),
            'iframe' => array(
                'src' => array(),
                'frameborder' => array(),
                'allowfullscreen' => array(),
                'allow' => array(),
                'width' => array(),
                'height' => array(),
            ),
            'b' => array(),
            'br' => array(),
            'blockquote' => array(
                'cite' => array()
            ),
            'cite' => array(
                'title' => array()
            ),
            'code' => array(),
            'del' => array(
                'datetime' => array(),
                'title' => array()
            ),
            'dd' => array(),
            'div' => array(
                'class' => array(),
                'id' => array(),
                'title' => array(),
                'style' => array()
            ),
            'dl' => array(),
            'dt' => array(),
            'em' => array(),
            'h1' => array(
                'class' => array()
            ),
            'h2' => array(
                'class' => array()
            ),
            'h3' => array(
                'class' => array()
            ),
            'h4' => array(
                'class' => array()
            ),
            'h5' => array(
                'class' => array()
            ),
            'h6' => array(
                'class' => array()
            ),
            'i' => array(
                'class' => array()
            ),
            'img' => array(
                'alt' => array(),
                'class' => array(),
                'width' => array(),
                'height' => array(),
                'src' => array(),
                'srcset' => array(),
                'sizes' => array()
            ),
            'nav' => array(
                'aria-label' => array(),
                'class' => array(),
            ),
            'li' => array(
                'aria-current' => array(),
                'class' => array()
            ),
            'ol' => array(
                'class' => array()
            ),
            'p' => array(
                'class' => array()
            ),
            'q' => array(
                'cite' => array(),
                'title' => array()
            ),
            'span' => array(
                'class' => array(),
                'title' => array(),
                'style' => array()
            ),
            'strike' => array(),
            'strong' => array(),
            'ul' => array(
                'class' => array()
            )
        );
        return $allowed_tags;
    }
}

if ( ! function_exists( 'venam_combine_arr' ) ) {
    function venam_combine_arr($a, $b)
    {
        $acount = count($a);
        $bcount = count($b);
        $size = ($acount > $bcount) ? $bcount : $acount;
        $a = array_slice($a, 0, $size);
        $b = array_slice($b, 0, $size);
        return array_combine($a, $b);
    }
}

if ( ! function_exists( 'venam_navmenu_choices' ) ) {
    function venam_navmenu_choices()
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
/**
* Get WooCommerce Product Skus
* @return array
*/
if ( ! function_exists( 'venam_woo_get_products' ) ) {
    function venam_woo_get_products()
    {
        $options = array();
        if ( class_exists( 'WooCommerce' ) ) {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1
            );
            $wcProductsArray = get_posts($args);
            if (count($wcProductsArray)) {
                foreach ($wcProductsArray as $productPost) {
                    $options[$productPost->ID] = $productPost->post_title;
                }
            }
        }
        return $options;
    }
}


/**
* Add custom fields to menu item
*
* This will allow us to play nicely with any other plugin that is adding the same hook
*
* @param  int $item_id
* @params obj $item - the menu item
* @params array $args
*/

function venam_custom_fields( $item_id, $item) {

    $menu_item_megamenu = get_post_meta( $item_id, '_menu_item_megamenu', true );
    $menu_item_megamenu_columns = get_post_meta( $item_id, '_menu_item_megamenu_columns', true );
    $menu_item_menushortcode = get_post_meta( $item_id, '_menu_item_menushortcode', true );
    $menu_item_menuhidetitle = get_post_meta( $item_id, '_menu_item_menuhidetitle', true );
    $menu_item_menulabel = get_post_meta( $item_id, '_menu_item_menulabel', true );
    $menu_item_menulabelcolor = get_post_meta( $item_id, '_menu_item_menulabelcolor', true );
    $menu_item_menuimage = get_post_meta( $item_id, '_menu_item_menuimage', true );

    ?>
    <div class="et_menu_options">
        <div class="venam-field-link-mega description description-thin">
            <label for="menu_item_megamenu-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e( 'Show as Mega Menu', 'venam'  ); ?><br />
                <?php
                $value = $menu_item_megamenu;
                if($value != "") $value = "checked='checked'";
                ?>
                <input type="checkbox" value="enabled" id="menu_item_megamenu-<?php echo esc_attr($item_id); ?>" name="menu_item_megamenu[<?php echo esc_attr($item_id); ?>]" <?php echo esc_attr( $value ); ?> />
                <?php esc_html_e( 'Enable', 'venam'  ); ?>
            </label>
        </div>
        <div class="venam-field-link-mega-columns description description-thin">
            <label for="menu_item_megamenu-columns-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e( 'Main menu columns', 'venam'  ); ?><br />
                <select class="widefat code edit-menu-item-custom" id="menu_item_megamenu_columns-<?php echo esc_attr($item_id); ?>" name="menu_item_megamenu_columns[<?php echo esc_attr($item_id); ?>]">
                    <?php $value = $menu_item_megamenu_columns;
                    if (!$value) {
                        $value = 5;
                    }
                    for ($i = 1; $i <= 12; $i++) { ?>
                        <option value="<?php echo esc_attr( $i ) ?>" <?php echo htmlspecialchars( $value == $i ) ? "selected='selected'" : ''; ?>><?php echo esc_html( $i ); ?></option>
                    <?php } ?>
                </select>
            </label>
        </div>
        <div class="venam-field-link-shortcode description description-wide">
            <label for="menu_item_menushortcode-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e( 'Shortcode', 'venam'  ); ?><br />
                <input type="text" class="widefat code edit-menu-item-custom" id="menu_item_menushortcode-<?php echo esc_attr($item_id); ?>" name="menu_item_menushortcode[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $menu_item_menushortcode ); ?>"/>
            </label>
        </div>
        <div class="venam-field-link-hidetitle description description-thin">
            <label for="menu_item_megamenu-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e( 'Hide Title for Shortcode', 'venam'  ); ?><br />
                <?php
                $value = $menu_item_menuhidetitle;
                if($value != "") $value = "checked='checked'";
                ?>
                <input type="checkbox" value="yes" id="menu_item_menuhidetitle-<?php echo esc_attr($item_id); ?>" name="menu_item_menuhidetitle[<?php echo esc_attr($item_id); ?>]" <?php echo esc_attr( $value ); ?> />
                <?php esc_html_e( 'Yes', 'venam'  ); ?>
            </label>
        </div>
        <div class="venam-field-link-label description description-wide">
            <label for="menu_item_menulabel-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e( 'Highlight Label', 'venam'  ); ?> <span class="small-tag"><?php esc_html_e( 'label', 'venam'  ); ?></span><br />
                <input type="text" class="widefat code edit-menu-item-custom" id="menu_item_menulabel-<?php echo esc_attr($item_id); ?>" name="menu_item_menulabel[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $menu_item_menulabel ); ?>"/>
            </label>
        </div>
        <div class="venam-field-link-labelcolor description description-wide">
            <label for="menu_item_menulabelcolor-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e( 'Highlight Label Color', 'venam'  ); ?>
                <input type="text" class="widefat code edit-menu-item-custom et-color-field" id="menu_item_menulabelcolor-<?php echo esc_attr($item_id); ?>" name="menu_item_menulabelcolor[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $menu_item_menulabelcolor ); ?>"/>
            </label>
        </div>
        <div class="venam-field-link-image description description-wide">

            <?php wp_enqueue_media(); ?>

            <label for="menu_item_menuimage-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e( 'Menu Image', 'venam'  ); ?>
            </label>

            <div class='image-preview-wrapper'>
                <?php $image_attributes = wp_get_attachment_image_src( $menu_item_menuimage, 'thumbnail' );
                if ($image_attributes != '' ) { ?>
                    <img id='image-preview-<?php echo esc_attr($item_id); ?>' class="image-preview" src="<?php echo esc_attr( $image_attributes[0]); ?>" />
                <?php } ?>
            </div>
            <input id="remove_image_button-<?php echo esc_attr($item_id); ?>"
            type="button" class="remove_image_button button"
            value="<?php esc_attr_e( 'Remove', 'venam' ); ?>" />
            <input id="upload_image_button-<?php echo esc_attr($item_id); ?>" type="button" class="upload_image_button button" value="<?php esc_attr_e( 'Select image', 'venam' ); ?>" />

            <input type="hidden" class="widefat code edit-menu-item-custom image_attachment_id" id="menu_item_menuimage-<?php echo esc_attr($item_id); ?>" name="menu_item_menuimage[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $menu_item_menuimage ); ?>"/>

        </div>

    </div>

    <?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'venam_custom_fields', 10, 2 );

/**
* Save the menu item meta
*
* @param int $menu_id
* @param int $menu_item_db_id
*/
function venam_nav_update( $menu_id, $menu_item_db_id ) {

    if (!isset($_REQUEST['menu_item_megamenu'][$menu_item_db_id])) {
        $_REQUEST['menu_item_megamenu'][$menu_item_db_id] = '';
    }

    $menumega_enabled_value = $_REQUEST['menu_item_megamenu'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menumega_enabled_value );

    if (isset($menumega_enabled_value) && !empty($_REQUEST['menu_item_megamenu_columns'])) {
        $menumega_columns_enabled_value = $_REQUEST['menu_item_megamenu_columns'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_megamenu_columns', $menumega_columns_enabled_value );
    }

    if (!isset($_REQUEST['menu_item_menuhidetitle'][$menu_item_db_id])) {
        $_REQUEST['menu_item_menuhidetitle'][$menu_item_db_id] = '';
    }

    $menutitle_enabled_value = $_REQUEST['menu_item_menuhidetitle'][$menu_item_db_id];
    update_post_meta( $menu_item_db_id, '_menu_item_menuhidetitle', $menutitle_enabled_value );

    if (!empty($_REQUEST['menu_item_menulabel'])) {
        $menulabel_enabled_value = $_REQUEST['menu_item_menulabel'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_menulabel', $menulabel_enabled_value );
    }

    if (!empty($_REQUEST['menu_item_menushortcode'])) {
        $menushortcode_enabled_value = $_REQUEST['menu_item_menushortcode'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_menushortcode', $menushortcode_enabled_value );
    }

    if (!empty($_REQUEST['menu_item_menulabelcolor'])) {
        $menulabelcolor_enabled_value = $_REQUEST['menu_item_menulabelcolor'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_menulabelcolor', $menulabelcolor_enabled_value );
    }

    if (!empty($_REQUEST['menu_item_menuimage'])) {
        $menuimage_enabled_value = $_REQUEST['menu_item_menuimage'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_menuimage', $menuimage_enabled_value );
    }
}

add_action( 'wp_update_nav_menu_item', 'venam_nav_update', 10, 2 );

/**
* Filters the CSS classes applied to a menu item's list item element.
*
* @param string[] $classes Array of the CSS classes that are applied to the menu item's `<li>` element.
* @param WP_Post  $item    The current menu item.
* @param stdClass $args    An object of wp_nav_menu() arguments.
* @param int      $depth   Depth of menu item. Used for padding.
*/
function venam_custom_nav_menu_css_class( $classes, $item, $args, $depth ) {

    $item->active_megamenu = get_post_meta( $item->ID, '_menu_item_megamenu', true );
    $item->hasshortcode = get_post_meta( $item->ID, '_menu_item_menushortcode', true );

    if ( $depth === 0 ) {
        $mega_columns = get_post_meta( $item->ID, '_menu_item_megamenu_columns', true );
        if ( $item->active_megamenu ) {
            $classes[] = 'menu-item-mega-parent';
            $classes[] = 'menu-item-mega-column-' . $mega_columns;
        }
        if ( $item->hasshortcode ) {
            $classes[] = 'menu-item-has-shortcode-parent';
        }
    }

    if ( $depth === 1 && $item->active_megamenu )  {
        $classes[] = 'mega-menu-title';
    }
    if ( $item->hasshortcode ) {
        $classes[] = 'menu-item-has-shortcode';
    }
    return $classes;
}

add_filter( 'nav_menu_css_class', 'venam_custom_nav_menu_css_class', 10, 4 );

/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string
*/
function venam_custom_nav_menu_item_title( $title, $item, $args, $depth ) {

    if ( is_object( $item ) && isset( $item->ID ) ) {

        $item->menuimage = get_post_meta( $item->ID, '_menu_item_menuimage', true);
        $item->menulabel = get_post_meta( $item->ID, '_menu_item_menulabel', true);
        $item->menu_label_color = get_post_meta( $item->ID, '_menu_item_menulabelcolor', true);

        $menu_label_color = ($item->menu_label_color != '') ? ''. $item->menu_label_color .'' : '';
        $menu_image = wp_get_attachment_image( $item->menuimage, 'medium_large', '', array( 'class' => 'skip-webp' ) );

        $title = $title;
        $title .= ( $item->menuimage != '' ) ? '<span class="item-thumb">' . $menu_image . '</span>' : '';
        $title .= ( $item->menulabel != '' ) ? '<span class="menu-label" data-label-color="'. $menu_label_color .'">'. $item->menulabel .'</span>' : '';
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'venam_custom_nav_menu_item_title', 10, 4 );


/**
* Displays svg file
*/
if ( ! function_exists( 'venam_svg_lists' ) ) {
    function venam_svg_lists( $name )
    {
        if ( !$name ) {
            return;
        }
        $svg = array(
            // three-bar
            'column-1' => '<svg class="svgList" height="512" width="512" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xmlns="http://www.w3.org/2000/svg"><path id="List" d="m32 40h-16c-4.412 0-8-3.59-8-8v-16c0-4.41 3.588-8 8-8h16c4.412 0 8 3.59 8 8v16c0 4.41-3.588 8-8 8zm-16-24v16h16.006l-.006-16zm104 8c0-2.211-1.791-4-4-4h-64c-2.209 0-4 1.789-4 4s1.791 4 4 4h64c2.209 0 4-1.789 4-4zm-88 56h-16c-4.412 0-8-3.59-8-8v-16c0-4.41 3.588-8 8-8h16c4.412 0 8 3.59 8 8v16c0 4.41-3.588 8-8 8zm-16-24v16h16.006l-.006-16zm104 8c0-2.211-1.791-4-4-4h-64c-2.209 0-4 1.789-4 4s1.791 4 4 4h64c2.209 0 4-1.789 4-4zm-88 56h-16c-4.412 0-8-3.59-8-8v-16c0-4.41 3.588-8 8-8h16c4.412 0 8 3.59 8 8v16c0 4.41-3.588 8-8 8zm-16-24v16h16.006l-.006-16zm104 8c0-2.211-1.791-4-4-4h-64c-2.209 0-4 1.789-4 4s1.791 4 4 4h64c2.209 0 4-1.789 4-4z"/></svg>',
            // two-column
            'column-2' => '<svg class="svgTwoColumn" height="512" width="512" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><rect height="12" rx="1" width="12" x="2" y="17"></rect><rect height="12" rx="1" width="12" x="18" y="17"></rect><rect height="12" rx="1" width="12" x="2" y="2"></rect><rect height="12" rx="1" width="12" x="18" y="2"></rect></svg>',
            // two-column
            'column-3' => '<svg class="svgThreeColumn" width="16px" height="16px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" xml:space="preserve"><rect width="5" height="5"></rect><rect x="7" width="5" height="5"></rect><rect x="14" width="5" height="5"></rect><rect y="7" width="5" height="5"></rect><rect x="7" y="7" width="5" height="5"></rect><rect x="14" y="7" width="5" height="5"></rect><rect y="14" width="5" height="5"></rect><rect x="7" y="14" width="5" height="5"></rect><rect x="14" y="14" width="5" height="5"></rect></svg>',
            // four-column
            'column-4' => '<svg class="svgFourColumn" width="16px" height="16px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" xml:space="preserve"><rect width="4" height="4"></rect><rect x="5" width="4" height="4"></rect><rect x="10" width="4" height="4"></rect><rect x="15" width="4" height="4"></rect><rect y="5" width="4" height="4"></rect><rect x="5" y="5" width="4" height="4"></rect><rect x="10" y="5" width="4" height="4"></rect><rect x="15" y="5" width="4" height="4"></rect><rect y="15" width="4" height="4"></rect><rect x="5" y="15" width="4" height="4"></rect><rect x="10" y="15" width="4" height="4"></rect><rect x="15" y="15" width="4" height="4"></rect><rect y="10" width="4" height="4"></rect><rect x="5" y="10" width="4" height="4"></rect><rect x="10" y="10" width="4" height="4"></rect><rect x="15" y="10" width="4" height="4"></rect></svg>',
            // cancel
            'cancel' => '<svg class="svgCancel" height="512" viewBox="0 0 16 16" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m8 16a8 8 0 1 1 8-8 8 8 0 0 1 -8 8zm0-15a7 7 0 1 0 7 7 7 7 0 0 0 -7-7z"/><path d="m8.71 8 3.14-3.15a.49.49 0 0 0 -.7-.7l-3.15 3.14-3.15-3.14a.49.49 0 0 0 -.7.7l3.14 3.15-3.14 3.15a.48.48 0 0 0 0 .7.48.48 0 0 0 .7 0l3.15-3.14 3.15 3.14a.48.48 0 0 0 .7 0 .48.48 0 0 0 0-.7z"/></svg>',
            // search
            'search' => '<svg class="svgSearch" width="512" height="512" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg"><g id="_x32_-Magnifying_Glass"><path d="m40.2850342 37.4604492-6.4862061-6.4862061c1.9657593-2.5733643 3.0438843-5.6947021 3.0443115-8.9884033 0-3.9692383-1.5458984-7.7011719-4.3530273-10.5078125-2.8066406-2.8066406-6.5380859-4.3525391-10.5078125-4.3525391-3.9692383 0-7.7011719 1.5458984-10.5078125 4.3525391-5.7939453 5.7944336-5.7939453 15.222168 0 21.015625 2.8066406 2.8071289 6.5385742 4.3530273 10.5078125 4.3530273 3.2937012-.0004272 6.4150391-1.0785522 8.9884033-3.0443115l6.4862061 6.4862061c.3901367.390625.9023438.5859375 1.4140625.5859375s1.0239258-.1953125 1.4140625-.5859375c.78125-.7807617.78125-2.0473633 0-2.828125zm-25.9824219-7.7949219c-4.234375-4.234375-4.2338867-11.1245117 0-15.359375 2.0512695-2.0507813 4.7788086-3.1806641 7.6796875-3.1806641 2.9013672 0 5.628418 1.1298828 7.6796875 3.1806641 2.0512695 2.0512695 3.1811523 4.7788086 3.1811523 7.6796875 0 2.9013672-1.1298828 5.628418-3.1811523 7.6796875s-4.7783203 3.1811523-7.6796875 3.1811523c-2.9008789.0000001-5.628418-1.1298827-7.6796875-3.1811523z"/></g></svg>',
            // filter
            'filter' => '<svg class="svgFilter" width="20" height="20" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m140.7 123h-80.8c-7.6 0-13.8-6.2-13.8-13.8s6.2-13.8 13.8-13.8h80.8c7.6 0 13.8 6.2 13.8 13.8s-6.1 13.8-13.8 13.8z"/></g><g><path d="m452.1 123h-235.3c-7.6 0-13.8-6.2-13.8-13.8s6.2-13.8 13.8-13.8h235.3c7.6 0 13.8 6.2 13.8 13.8s-6.1 13.8-13.8 13.8z"/></g><g><path d="m178.8 161c-28.6 0-51.9-23.3-51.9-51.9s23.3-51.9 51.9-51.9 51.9 23.3 51.9 51.9-23.3 51.9-51.9 51.9zm0-76.1c-13.4 0-24.2 10.9-24.2 24.2s10.9 24.2 24.2 24.2c13.4 0 24.2-10.9 24.2-24.2s-10.9-24.2-24.2-24.2z"/></g><g><path d="m140.7 416.7h-80.8c-7.6 0-13.8-6.2-13.8-13.8s6.2-13.8 13.8-13.8h80.8c7.6 0 13.8 6.2 13.8 13.8.1 7.6-6.1 13.8-13.8 13.8z"/></g><g><path d="m452.1 416.7h-235.3c-7.6 0-13.8-6.2-13.8-13.8s6.2-13.8 13.8-13.8h235.3c7.6 0 13.8 6.2 13.8 13.8.1 7.6-6.1 13.8-13.8 13.8z"/></g><g><path d="m178.8 454.8c-28.6 0-51.9-23.3-51.9-51.9s23.3-51.9 51.9-51.9 51.9 23.3 51.9 51.9-23.3 51.9-51.9 51.9zm0-76.1c-13.4 0-24.2 10.9-24.2 24.2s10.9 24.2 24.2 24.2c13.4 0 24.2-10.9 24.2-24.2s-10.9-24.2-24.2-24.2z"/></g><g><path d="m452.1 269.8h-80.8c-7.6 0-13.8-6.2-13.8-13.8s6.2-13.8 13.8-13.8h80.8c7.6 0 13.8 6.2 13.8 13.8s-6.1 13.8-13.8 13.8z"/></g><g><path d="m295.2 269.8h-235.3c-7.6 0-13.8-6.2-13.8-13.8s6.2-13.8 13.8-13.8h235.3c7.6 0 13.8 6.2 13.8 13.8s-6.2 13.8-13.8 13.8z"/></g><g><path d="m333.2 307.9c-28.6 0-51.9-23.3-51.9-51.9s23.3-51.9 51.9-51.9 51.9 23.3 51.9 51.9-23.2 51.9-51.9 51.9zm0-76.1c-13.4 0-24.2 10.9-24.2 24.2s10.9 24.2 24.2 24.2c13.4 0 24.2-10.9 24.2-24.2s-10.8-24.2-24.2-24.2z"/></g></g></svg>',
            // user 1
            'love' => '<svg class="svgLove" width="512" height="512" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="m29.55 6.509c-1.73-2.302-3.759-3.483-6.031-3.509h-.076c-3.29 0-6.124 2.469-7.443 3.84-1.32-1.371-4.153-3.84-7.444-3.84h-.075c-2.273.026-4.3 1.207-6.059 3.549a8.265 8.265 0 0 0 1.057 10.522l11.821 11.641a1 1 0 0 0 1.4 0l11.82-11.641a8.278 8.278 0 0 0 1.03-10.562zm-2.432 9.137-11.118 10.954-11.118-10.954a6.254 6.254 0 0 1 -.832-7.936c1.335-1.777 2.831-2.689 4.45-2.71h.058c3.48 0 6.627 3.924 6.658 3.964a1.037 1.037 0 0 0 1.57 0c.032-.04 3.2-4.052 6.716-3.964a5.723 5.723 0 0 1 4.421 2.67 6.265 6.265 0 0 1 -.805 7.976z"/></svg>',
            // bag
            'bag' => '<svg class="shopBag" width="512" height="512" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="m26 8.9a1 1 0 0 0 -1-.9h-3a6 6 0 0 0 -12 0h-3a1 1 0 0 0 -1 .9l-1.78 17.8a3 3 0 0 0 .78 2.3 3 3 0 0 0 2.22 1h17.57a3 3 0 0 0 2.21-1 3 3 0 0 0 .77-2.31zm-10-4.9a4 4 0 0 1 4 4h-8a4 4 0 0 1 4-4zm9.53 23.67a1 1 0 0 1 -.74.33h-17.58a1 1 0 0 1 -.74-.33 1 1 0 0 1 -.26-.77l1.7-16.9h2.09v3a1 1 0 0 0 2 0v-3h8v3a1 1 0 0 0 2 0v-3h2.09l1.7 16.9a1 1 0 0 1 -.26.77z"/></svg>',
            // user 1
            'user-1' => '<svg class="svgUser1" width="20" height="20" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="m16 16a7 7 0 1 0 -7-7 7 7 0 0 0 7 7zm0-12a5 5 0 1 1 -5 5 5 5 0 0 1 5-5z"/><path d="m20 18h-8a9 9 0 0 0 -9 9 3 3 0 0 0 3 3h20a3 3 0 0 0 3-3 9 9 0 0 0 -9-9zm6 10h-20a1 1 0 0 1 -1-1 7 7 0 0 1 7-7h8a7 7 0 0 1 7 7 1 1 0 0 1 -1 1z"/></svg>',
            // user 2
            'user-2' => '<svg class="svgUser2" width="512" height="512" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m256 253.7c-62 0-112.4-50.4-112.4-112.4s50.4-112.4 112.4-112.4 112.4 50.4 112.4 112.4-50.4 112.4-112.4 112.4zm0-195.8c-46 0-83.4 37.4-83.4 83.4s37.4 83.4 83.4 83.4 83.4-37.4 83.4-83.4-37.4-83.4-83.4-83.4z"/></g><g><path d="m452.1 483.2h-392.2c-8 0-14.5-6.5-14.5-14.5 0-106.9 94.5-193.9 210.6-193.9s210.6 87 210.6 193.9c0 8-6.5 14.5-14.5 14.5zm-377-29.1h361.7c-8.1-84.1-86.1-150.3-180.8-150.3s-172.7 66.2-180.9 150.3z"/></g></g></svg>',
            // user 3
            'user-3' => '<svg class="svgUser3" width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m8 8a4 4 0 1 1 4-4 4 4 0 0 1 -4 4zm0-7a3 3 0 1 0 3 3 3 3 0 0 0 -3-3z"/><path d="m13.5 16h-11a.5.5 0 0 1 -.5-.5v-4a5.92 5.92 0 0 1 1.62-4.09.5.5 0 0 1 .72.68 5 5 0 0 0 -1.34 3.41v3.5h10v-3.5a5 5 0 0 0 -1.34-3.41.5.5 0 1 1 .72-.68 5.92 5.92 0 0 1 1.62 4.09v4a.5.5 0 0 1 -.5.5z"/></svg>',
            // compare
            'compare' => '<svg class="svgCompare" width="512" height="512" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path d="m26 9a1 1 0 0 0 0-2h-4a1 1 0 0 0 -1 1v4a1 1 0 0 0 2 0v-1.66a9 9 0 0 1 -7 14.66c-.3 0-.6 0-.9 0a1 1 0 1 0 -.2 2c.36 0 .73.05 1.1.05a11 11 0 0 0 8.48-18.05z"/><path d="m10 19a1 1 0 0 0 -1 1v1.66a9 9 0 0 1 8.8-14.48 1 1 0 0 0 .4-2 10.8 10.8 0 0 0 -2.2-.18 11 11 0 0 0 -8.48 18h-1.52a1 1 0 0 0 0 2h4a1 1 0 0 0 1-1v-4a1 1 0 0 0 -1-1z"/></svg>',
            // eye
            'eye' => '<svg class="svgEye" height="512" width="512" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="m29.91 15.59c-.17-.39-4.37-9.59-13.91-9.59s-13.74 9.2-13.91 9.59a1 1 0 0 0 0 .82c.17.39 4.37 9.59 13.91 9.59s13.74-9.2 13.91-9.59a1 1 0 0 0 0-.82zm-13.91 8.41c-7.17 0-11-6.32-11.88-8 .88-1.68 4.71-8 11.88-8s11 6.32 11.88 8c-.88 1.68-4.71 8-11.88 8z"/><path d="m16 10a6 6 0 1 0 6 6 6 6 0 0 0 -6-6zm0 10a4 4 0 1 1 4-4 4 4 0 0 1 -4 4z"/></svg>',
            // store
            'store' => '<svg class="svgStore" width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M511.989,148.555c0-.107.007-.214.008-.322,0-.042,0-.083,0-.125h-.007a15.921,15.921,0,0,0-1.805-7.4L441.3,8.6A16,16,0,0,0,427.115,0H84.885A16,16,0,0,0,70.7,8.6L1.813,140.711a15.91,15.91,0,0,0-1.806,7.4H0c0,.042,0,.083,0,.125,0,.108.005.215.008.322a75.953,75.953,0,0,0,32.6,61.9V466a46.053,46.053,0,0,0,46,46H433.386a46.058,46.058,0,0,0,46-46V210.455A75.953,75.953,0,0,0,511.989,148.555Zm-32.15,3.167A43.994,43.994,0,0,1,392,148.108h-.016a16,16,0,0,0-.512-4.077L361.946,32h55.468ZM183.146,32H240V148.108A44,44,0,0,1,152.048,150ZM272,32h56.854l31.1,118A44,44,0,0,1,272,148.108ZM94.586,32h55.468L120.528,144.031a16,16,0,0,0-.512,4.077H120a43.994,43.994,0,0,1-87.839,3.614ZM380.331,480H298.96V306.347h81.371Zm67.054-14a14.058,14.058,0,0,1-14,14H412.331V290.347a16,16,0,0,0-16-16H282.96a16,16,0,0,0-16,16V480H78.615a14.016,14.016,0,0,1-14-14V223.253A75.917,75.917,0,0,0,136,194.673a75.869,75.869,0,0,0,120,0,75.869,75.869,0,0,0,120,0,75.917,75.917,0,0,0,71.385,28.58ZM215.215,274.347H115.67a16,16,0,0,0-16,16v99.545a16,16,0,0,0,16,16h99.545a16,16,0,0,0,16-16V290.347A16,16,0,0,0,215.215,274.347Zm-16,99.545H131.67V306.347h67.545Z"/></svg>',
            // arrow-left
            'arrow-left' => '<svg class="svgLeft" width="512" height="512" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xmlns="http://www.w3.org/2000/svg"><path id="Left" d="m64 0c-35.289 0-64 28.711-64 64s28.711 64 64 64 64-28.711 64-64-28.711-64-64-64zm0 120c-30.879 0-56-25.121-56-56s25.121-56 56-56 56 25.121 56 56-25.121 56-56 56zm28-56c0 2.211-1.791 4-4 4h-38.344l13.172 13.172c1.563 1.563 1.563 4.094 0 5.656-.781.781-1.805 1.172-2.828 1.172s-2.047-.391-2.828-1.172l-20-20c-1.563-1.563-1.563-4.094 0-5.656l20-20c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-13.172 13.172h38.344c2.209 0 4 1.789 4 4z"/></svg>',
            // arrow-right
            'arrow-right' => '<svg class="svgRight" width="512" height="512" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xmlns="http://www.w3.org/2000/svg"><path id="Right" d="m64 0c-35.289 0-64 28.711-64 64s28.711 64 64 64 64-28.711 64-64-28.711-64-64-64zm0 120c-30.879 0-56-25.121-56-56s25.121-56 56-56 56 25.121 56 56-25.121 56-56 56zm26.828-58.828c1.563 1.563 1.563 4.094 0 5.656l-20 20c-.781.781-1.805 1.172-2.828 1.172s-2.047-.391-2.828-1.172c-1.563-1.563-1.563-4.094 0-5.656l13.172-13.172h-38.344c-2.209 0-4-1.789-4-4s1.791-4 4-4h38.344l-13.172-13.172c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0z"/></svg>',
            // ruler
            'ruler' => '<svg class="svgRuler" width="466.85" height="466.85" viewBox="0 0 466.85 466.85" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M463.925,122.425l-119.5-119.5c-3.9-3.9-10.2-3.9-14.1,0l-327.4,327.4c-3.9,3.9-3.9,10.2,0,14.1l119.5,119.5 c3.9,3.9,10.2,3.9,14.1,0l327.4-327.4C467.825,132.625,467.825,126.325,463.925,122.425z M129.425,442.725l-105.3-105.3l79.1-79.1 l35.9,35.9c3.8,4,10.2,4.1,14.1,0.2c4-3.8,4.1-10.2,0.2-14.1c-0.1-0.1-0.1-0.1-0.2-0.2l-35.9-35.8l26.1-26.1l56,56 c3.9,3.9,10.3,3.9,14.1-0.1c3.9-3.9,3.9-10.2,0-14.1l-56-56l26.1-26.1l35.9,35.8c3.9,3.9,10.2,3.9,14.1,0c3.9-3.9,3.9-10.2,0-14.1 l-35.9-35.8l26.1-26.1l56,56c3.9,3.9,10.2,3.9,14.1,0c3.9-3.9,3.9-10.2,0-14.1l-56-56l26.1-26.1l35.9,35.9 c3.9,3.9,10.2,4,14.1,0.1c3.9-3.9,4-10.2,0.1-14.1c0,0,0,0-0.1-0.1l-35.6-36.2l26.1-26.1l56,56c3.9,3.9,10.2,3.9,14.1,0 c3.9-3.9,3.9-10.2,0-14.1l-56-56l18.8-18.8l105.3,105.3L129.425,442.725z"/><path d="M137.325,331.325c-12.6-12.5-32.9-12.5-45.4,0c-12.5,12.6-12.5,32.9,0,45.4s32.9,12.5,45.4,0 S149.825,343.925,137.325,331.325z M124.225,362.325c-0.2,0.2-0.5,0.5-1.1,0.4c-4.7,4.7-12.4,4.7-17.2,0c-4.7-4.7-4.7-12.4,0-17.2 c4.7-4.7,12.4-4.7,17.2,0C128.025,350.025,128.725,357.425,124.225,362.325z"/></svg>',
            // question
            'question' => '<svg class="svgQuestion" width="40.124px" height="40.124px" viewBox="0 0 40.124 40.124"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M19.938,12.141c1.856,0,2.971,0.99,2.971,2.66c0,3.033-5.414,3.869-5.414,7.55c0,0.99,0.648,2.072,1.979,2.072 c2.042,0,1.795-1.516,2.538-2.6c0.989-1.453,5.6-3,5.6-7.023c0-4.361-3.897-6.188-7.858-6.188c-3.773,0-7.24,2.692-7.24,5.725 c0,1.237,0.929,1.887,2.012,1.887C17.525,16.225,15.979,12.141,19.938,12.141z"/><path d="M22.135,28.973c0-1.393-1.145-2.537-2.537-2.537s-2.537,1.146-2.537,2.537c0,1.393,1.145,2.537,2.537,2.537 S22.135,30.366,22.135,28.973z"/><path d="M40.124,20.062C40.124,9,31.124,0,20.062,0S0,9,0,20.062s9,20.062,20.062,20.062S40.124,31.125,40.124,20.062z M2,20.062 C2,10.103,10.103,2,20.062,2c9.959,0,18.062,8.103,18.062,18.062c0,9.959-8.103,18.062-18.062,18.062 C10.103,38.124,2,30.021,2,20.062z"/></svg>',
            // delivery-return
            'delivery-return' => '<svg class="svgDeliveryReturn" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m498.667 366.464c-9.551-14.036-25.752-17.463-43.352-9.181l-9.328 4.107c14.708-31.35 16.533-66.297 9.211-99.307-8.409-37.913-28.72-74.641-60.368-109.164-2.798-3.053-7.541-3.259-10.595-.46-3.053 2.798-3.259 7.541-.46 10.595 29.846 32.556 48.95 66.967 56.782 102.276 8.249 37.193 3.45 75.549-17.601 106.2l-93.342 41.099.077-10.542c.002-.266-.01-.532-.037-.797-2.155-21.667-18.717-38.93-40.276-41.98-.064-.01-.128-.018-.193-.025l-82.961-9.552c-31.901-4.541-40.117-23.658-83.321-34.559-2.985-25.33.994-52.299 11.9-79.336 16.425-40.718 48.558-80.278 93.104-114.711 16.603 11.772 90.676 13.237 107.252-1.949 8.492 6.449 16.597 13.095 24.147 19.822 1.429 1.274 3.211 1.9 4.986 1.9 2.064 0 4.12-.847 5.601-2.51 2.755-3.092 2.481-7.832-.611-10.587-8.276-7.373-17.178-14.648-26.515-21.679 2.188-9.278-.874-20.137-8.954-26.601 23.479-35.612 30.308-58.921 20.875-71.133-6.479-8.389-14.539-4.452-17.981-2.77-5.834 2.848-9.015 2.998-14.383-.514-10.241-6.701-21.005-6.917-31.576 0-5.436 3.557-9.717 3.557-15.151 0-10.242-6.701-21.002-6.917-31.575 0-5.43 3.554-8.623 3.334-14.365.48-3.438-1.709-11.489-5.711-18.009 2.679-9.221 11.868-3.052 34.442 18.843 68.843-1.341.725-2.619 1.576-3.812 2.548-8.708-9.196-22.975-18.787-43.607-16.483-17.113 1.915-29.732-3.74-37.306-8.82-3.44-2.304-8.098-1.386-10.404 2.052-2.306 3.44-1.387 8.098 2.052 10.404 9.655 6.473 25.701 13.679 47.322 11.268 15.94-1.788 26.756 6.358 33.489 14.648-.092.32-.177.642-.256.964-5.743.09-14.326.626-23.778 2.592-22.732 4.729-39.606 15.532-48.799 31.244-2.091 3.574-.889 8.168 2.685 10.26 3.575 2.091 8.168.888 10.259-2.686 13.674-23.369 47.051-26.227 60.308-26.406.057.165.124.328.184.492-47.308 36.493-80.244 77.19-97.932 121.04-11.18 27.717-15.646 55.485-13.379 81.874-7.191-1.064-14.465-1.635-21.774-1.685v-4.535c0-11.999-9.762-21.76-21.761-21.76h-34.424c-11.999 0-21.761 9.762-21.761 21.76v174.644c0 12 9.762 21.761 21.761 21.761h34.423c11.999 0 21.761-9.762 21.761-21.761v-2.136l75.091 27.949c10.091 3.755 20.667 5.66 31.434 5.66h111.886c17.106 0 33.785-4.84 48.233-13.995 149.259-94.62 140.195-88.733 141.057-89.497 12.023-10.672 14.269-28.746 5.224-42.04zm-177.58-256.172c-27.422 6.924-54.084 6.924-81.512 0-11.769-2.975-8.359-23.965 4.289-20.793 24.538 6.16 48.394 6.16 72.934 0 12.428-3.12 16.247 17.771 4.289 20.793zm-98.279-91.361c.059.029.118.059.174.087 10.149 5.044 19.042 5.318 29.251-1.361 12.776-8.363 14.163 5.046 30.938 5.046 8.076 0 12.533-2.916 15.787-5.046 5.437-3.558 9.719-3.556 15.155 0 10.254 6.71 18.932 6.379 29.376 1.342 1.543 5.562-1.949 22.143-24.185 55.249-11.042-.188-27.066 10.657-72.428.562-22.188-33.534-25.619-50.276-24.068-55.879zm261.085 377.99-139.534 88.417c-12.043 7.631-25.946 11.666-40.205 11.666h-111.886c-8.975 0-17.791-1.588-26.203-4.719l-80.323-29.897v-80.755c0-4.142-3.357-7.499-7.498-7.499s-7.498 3.357-7.498 7.499v98.894c0 3.73-3.035 6.764-6.764 6.764h-34.424c-3.73 0-6.764-3.035-6.764-6.764v-174.644c0-3.73 3.034-6.763 6.764-6.763h34.423c3.73 0 6.764 3.034 6.764 6.763v40.694c0 4.142 3.357 7.499 7.498 7.499s7.498-3.357 7.498-7.499v-21.162c62.031.475 75.978 33.17 118.476 39.181.064.01.128.018.192.025l82.957 9.551c14.526 2.097 25.705 13.664 27.323 28.227l-.104 14.264h-77.365c-4.141 0-7.499 3.357-7.499 7.499s3.357 7.499 7.499 7.499h84.809c.947 0 2.041-.21 2.993-.625.153-.068 136.263-59.995 136.422-60.065 9.811-4.36 18.756-4.983 24.822 3.931 4.716 6.927 3.672 16.292-2.373 22.019z"/><path d="m282.307 340.22c4.141 0 7.499-3.357 7.499-7.499v-12.43c21.051-3.416 33.334-20.455 36.006-36.351 3.338-19.857-7.063-37.126-26.497-43.995-3.434-1.214-6.594-2.375-9.51-3.496v-47.812c8.871 1.471 14.197 6.062 14.585 6.405 3.046 2.77 7.76 2.565 10.555-.465 2.808-3.044 2.616-7.788-.428-10.596-.529-.488-9.713-8.757-24.712-10.486v-10.664c0-4.142-3.357-7.499-7.499-7.499-4.141 0-7.498 3.357-7.498 7.499v11.27c-1.808.346-3.66.786-5.563 1.359-12.72 3.831-22.228 14.738-24.815 28.463-2.347 12.455 1.602 24.433 10.305 31.259 4.997 3.919 11.287 7.507 20.073 11.343v59.301c-8.672-.367-14.01-1.995-23.322-8.087-3.465-2.266-8.113-1.297-10.38 2.17-2.267 3.465-1.296 8.113 2.17 10.38 12.241 8.008 20.424 10.097 31.532 10.529v11.903c0 4.142 3.357 7.499 7.499 7.499zm-18.316-116.838c-4.281-3.358-6.13-9.75-4.823-16.681 1.212-6.428 5.631-14.238 14.403-16.88.417-.126.827-.234 1.237-.344v40.505c-4.49-2.242-8.011-4.399-10.817-6.6zm30.326 30.703c18.66 6.595 17.504 22.617 16.705 27.37-1.654 9.841-8.878 20.347-21.217 23.509v-52.504c1.46.534 2.951 1.073 4.512 1.625z"/></g></g></svg>',
            'plus' => '<svg class="svgPlus" width="426.66667pt" height="426.66667pt" viewBox="0 0 426.66667 426.66667" xmlns="http://www.w3.org/2000/svg"><path class="horizontal" d="m410.667969 229.332031h-394.667969c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h394.667969c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path class="vertical" d="m213.332031 426.667969c-8.832031 0-16-7.167969-16-16v-394.667969c0-8.832031 7.167969-16 16-16s16 7.167969 16 16v394.667969c0 8.832031-7.167969 16-16 16zm0 0"/></svg>',
            'smile' => '<svg class="svgSmile" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><path d="M437.02,74.98C388.667,26.629,324.38,0,256,0S123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256 s26.629,132.668,74.98,181.02C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.98 C485.371,388.668,512,324.38,512,256S485.371,123.333,437.02,74.98z M256,472c-119.103,0-216-96.897-216-216S136.897,40,256,40 s216,96.897,216,216S375.103,472,256,472z"/><path d="M368.993,285.776c-0.072,0.214-7.298,21.626-25.02,42.393C321.419,354.599,292.628,368,258.4,368 c-34.475,0-64.195-13.561-88.333-40.303c-18.92-20.962-27.272-42.54-27.33-42.691l-37.475,13.99 c0.42,1.122,10.533,27.792,34.013,54.273C171.022,389.074,212.215,408,258.4,408c46.412,0,86.904-19.076,117.099-55.166 c22.318-26.675,31.165-53.55,31.531-54.681L368.993,285.776z"/><circle cx="168" cy="180.12" r="32"/><circle cx="344" cy="180.12" r="32"/></svg>',
            'shipping' => '<svg class="svgShipping" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512;" xml:space="preserve"><path d="M476.158,231.363l-13.259-53.035c3.625-0.77,6.345-3.986,6.345-7.839v-8.551c0-18.566-15.105-33.67-33.67-33.67h-60.392 V110.63c0-9.136-7.432-16.568-16.568-16.568H50.772c-9.136,0-16.568,7.432-16.568,16.568V256c0,4.427,3.589,8.017,8.017,8.017 c4.427,0,8.017-3.589,8.017-8.017V110.63c0-0.295,0.239-0.534,0.534-0.534h307.841c0.295,0,0.534,0.239,0.534,0.534v145.372 c0,4.427,3.589,8.017,8.017,8.017c4.427,0,8.017-3.589,8.017-8.017v-9.088h94.569c0.008,0,0.014,0.002,0.021,0.002 c0.008,0,0.015-0.001,0.022-0.001c11.637,0.008,21.518,7.646,24.912,18.171h-24.928c-4.427,0-8.017,3.589-8.017,8.017v17.102 c0,13.851,11.268,25.119,25.119,25.119h9.086v35.273h-20.962c-6.886-19.883-25.787-34.205-47.982-34.205 s-41.097,14.322-47.982,34.205h-3.86v-60.393c0-4.427-3.589-8.017-8.017-8.017c-4.427,0-8.017,3.589-8.017,8.017v60.391H192.817 c-6.886-19.883-25.787-34.205-47.982-34.205s-41.097,14.322-47.982,34.205H50.772c-0.295,0-0.534-0.239-0.534-0.534v-17.637 h34.739c4.427,0,8.017-3.589,8.017-8.017s-3.589-8.017-8.017-8.017H8.017c-4.427,0-8.017,3.589-8.017,8.017 s3.589,8.017,8.017,8.017h26.188v17.637c0,9.136,7.432,16.568,16.568,16.568h43.304c-0.002,0.178-0.014,0.355-0.014,0.534 c0,27.996,22.777,50.772,50.772,50.772s50.772-22.776,50.772-50.772c0-0.18-0.012-0.356-0.014-0.534h180.67 c-0.002,0.178-0.014,0.355-0.014,0.534c0,27.996,22.777,50.772,50.772,50.772c27.995,0,50.772-22.776,50.772-50.772 c0-0.18-0.012-0.356-0.014-0.534h26.203c4.427,0,8.017-3.589,8.017-8.017v-85.511C512,251.989,496.423,234.448,476.158,231.363z M375.182,144.301h60.392c9.725,0,17.637,7.912,17.637,17.637v0.534h-78.029V144.301z M375.182,230.881v-52.376h71.235 l13.094,52.376H375.182z M144.835,401.904c-19.155,0-34.739-15.583-34.739-34.739s15.584-34.739,34.739-34.739 c19.155,0,34.739,15.583,34.739,34.739S163.99,401.904,144.835,401.904z M427.023,401.904c-19.155,0-34.739-15.583-34.739-34.739 s15.584-34.739,34.739-34.739c19.155,0,34.739,15.583,34.739,34.739S446.178,401.904,427.023,401.904z M495.967,299.29h-9.086 c-5.01,0-9.086-4.076-9.086-9.086v-9.086h18.171V299.29z"/><path d="M144.835,350.597c-9.136,0-16.568,7.432-16.568,16.568c0,9.136,7.432,16.568,16.568,16.568 c9.136,0,16.568-7.432,16.568-16.568C161.403,358.029,153.971,350.597,144.835,350.597z"/><path d="M427.023,350.597c-9.136,0-16.568,7.432-16.568,16.568c0,9.136,7.432,16.568,16.568,16.568 c9.136,0,16.568-7.432,16.568-16.568C443.591,358.029,436.159,350.597,427.023,350.597z"/><path d="M332.96,316.393H213.244c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017H332.96 c4.427,0,8.017-3.589,8.017-8.017S337.388,316.393,332.96,316.393z"/><path d="M127.733,282.188H25.119c-4.427,0-8.017,3.589-8.017,8.017s3.589,8.017,8.017,8.017h102.614 c4.427,0,8.017-3.589,8.017-8.017S132.16,282.188,127.733,282.188z"/><path d="M278.771,173.37c-3.13-3.13-8.207-3.13-11.337,0.001l-71.292,71.291l-37.087-37.087c-3.131-3.131-8.207-3.131-11.337,0 c-3.131,3.131-3.131,8.206,0,11.337l42.756,42.756c1.565,1.566,3.617,2.348,5.668,2.348s4.104-0.782,5.668-2.348l76.96-76.96 C281.901,181.576,281.901,176.501,278.771,173.37z"/></svg>',
        );

        $svg = apply_filters( 'venam_svg_lists', $svg );

        return $svg[$name];
    }
}

add_action('admin_notices', 'venam_notice_for_activation');
if ( !function_exists('venam_notice_for_activation') ) {
    function venam_notice_for_activation() {
        global $pagenow;

        if ( !get_option('envato_purchase_code_33546846') ) {

            echo '<div class="notice notice-warning">
                <p>' . sprintf(
                esc_html__( 'Enter your Envato Purchase Code to receive venam Theme and plugin updates  %s', 'venam' ),
                '<a href="' . admin_url('admin.php?page=merlin&step=license') . '">' . esc_html__( 'Enter Purchase Code', 'venam' ) . '</a>') . '</p>
            </div>';
        }

    }
}

if ( !get_option('envato_purchase_code_33546846') ) {
    add_filter('auto_update_theme', '__return_false');
}

add_action('upgrader_process_complete', 'venam_upgrade_function', 10, 2);
if ( !function_exists('venam_upgrade_function') ) {
    function venam_upgrade_function($upgrader_object, $options) {
        $purchase_code =  get_option('envato_purchase_code_33546846');

        if (($options['action'] == 'update' && $options['type'] == 'theme') && !$purchase_code) {
            wp_redirect(admin_url('admin.php?page=merlin&step=license'));
        }
    }
}

if ( !function_exists( 'venam_is_theme_registered') ) {
    function venam_is_theme_registered() {
        $purchase_code =  get_option('envato_purchase_code_33546846');
        $registered_by_purchase_code =  !empty($purchase_code);

        // Purchase code entered correctly.
        if ($registered_by_purchase_code) {
            return true;
        }
    }
}

function venam_deactivate_envato_plugin() {
    if (  function_exists( 'envato_market' ) && !get_option('envato_purchase_code_33546846') ) {
        deactivate_plugins('envato-market/envato-market.php');
    }
}
add_action( 'admin_init', 'venam_deactivate_envato_plugin' );
