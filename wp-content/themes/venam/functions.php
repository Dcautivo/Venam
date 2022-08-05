<?php

/**
 *
 * @package WordPress
 * @subpackage venam
 * @since Venam 1.0
 *
**/

/*************************************************
## GOOGLE FONTS
*************************************************/

if ( ! function_exists( 'venam_fonts_url' ) ) {
    function venam_fonts_url()
    {
        $fonts_url = '';
        $jost = _x( 'on', 'Jost font: on or off', 'venam' );

        if (  'off' !== $jost ) {

            $font_families = array();

            if ( 'off' !== $jost ) {
                $font_families[] = 'Jost:300,400,500,600,700';
            }

            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
                'display' => urlencode( 'swap' ),
            );

            $fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
        }

        return esc_url_raw( $fonts_url );
    }
}

/*************************************************
## STYLES AND SCRIPTS
*************************************************/

function venam_theme_scripts()
{
    $rtl = is_rtl() ? '-rtl' : '';
    // theme inner pages files
    // bootstrap
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/js/bootstrap/bootstrap'.$rtl.'.min.css', false, '1.0' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap/bootstrap.min.js', array( 'jquery' ), '1.0', true );

    // plugins
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css', false, '1.0' );
    wp_enqueue_style( 'fontawesome-all', get_template_directory_uri() . '/css/fontawesome/fontawesome-all.min.css', false, '1.0' );
    wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/css/flaticon/flaticon.css', false, '1.0' );

    // slick slider
    wp_enqueue_style( 'slick', get_template_directory_uri(). '/js/slick/slick'.$rtl.'.css', false, '1.0' );
    wp_enqueue_script( 'slick', get_template_directory_uri(). '/js/slick/slick.min.js', array( 'jquery' ), false, '1.0');

    // slick slider
    wp_enqueue_style( 'magnific', get_template_directory_uri(). '/js/magnific/magnific-popup.css', false, '1.0' );
    wp_enqueue_script( 'magnific', get_template_directory_uri(). '/js/magnific/magnific-popup.min.js', array( 'jquery' ), false, '1.0');

    // swiper
    wp_register_style( 'swiper', get_template_directory_uri() . '/js/swiper/swiper.min.css', false, '1.0' );
    wp_register_script( 'swiper', get_template_directory_uri() . '/js/swiper/swiper.min.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery/jquery-cookie.min.js', array( 'jquery' ), '1.0', true );

    // nice-select
    wp_enqueue_style( 'nice-select', get_template_directory_uri() . '/js/nice-select/nice-select'.$rtl.'.css', false, '1.0' );
    wp_enqueue_script( 'jquery-nice-select', get_template_directory_uri() . '/js/nice-select/jquery-nice-select.min.js', array( 'jquery' ), '1.0', false );

    // jquery-countdown
    wp_register_script( 'jquery-countdown', get_template_directory_uri(). '/js/countdown/jquery.countdown.min.js', array( 'jquery' ), false, '1.0' );
    wp_register_script( 'venam-countdown', get_template_directory_uri(). '/js/countdown/script.js', array( 'jquery' ), false, '1.0' );


    // venam-main-style
    wp_enqueue_style( 'venam-default', get_template_directory_uri() . '/css/default'.$rtl.'.css', false, '1.0' );
    wp_enqueue_style( 'venam-style', get_template_directory_uri() . '/css/style'.$rtl.'.css', false, '1.0' );
    wp_enqueue_style( 'venam-responsive', get_template_directory_uri() . '/css/responsive'.$rtl.'.css', false, '1.0' );
    // venam-framework-style
    wp_enqueue_style( 'venam-framework-style', get_template_directory_uri() . '/css/framework-style'.$rtl.'.css', false, '1.0' );
    // venam-update-style
    wp_enqueue_style( 'venam-update', get_template_directory_uri() . '/css/update'.$rtl.'.css', false, '1.0' );


    // upload Google Webfonts
    wp_enqueue_style( 'venam-fonts', venam_fonts_url(), array(), null );

    wp_enqueue_script( 'venam-main', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'framework-settings', get_template_directory_uri() . '/js/framework-settings.js', array( 'jquery' ), '1.0', true );

    if ( 'masonry' == venam_settings( 'index_type', 'default' ) || 'masonry' == venam_get_option() ) {
        wp_enqueue_script( 'masonry' );
    }

    // browser hacks
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array( 'jquery' ), '1,0', false );
    wp_script_add_data( 'modernizr', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array( 'jquery' ), '1.0', false );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array( 'jquery' ), '1.0', false );
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    // comment form reply
    if ( is_singular() ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'venam_theme_scripts' );

// preconnect theme fonts
function venam_resource_hints( $urls, $relation_type )
{
    if ( wp_style_is( 'venam-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin'
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'venam_resource_hints', 10, 2 );


/*************************************************
## ADMIN STYLE AND SCRIPTS
*************************************************/

function venam_admin_scripts()
{
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'venam-framework-admin', get_template_directory_uri() . '/js/framework-admin.js', array('jquery', 'wp-color-picker' ) );
}
add_action('admin_enqueue_scripts', 'venam_admin_scripts');


// admin_bar_bump
add_action( 'get_header', 'venam_remove_admin_login_header' );
function venam_remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}

// Theme admin menu
require_once get_parent_theme_file_path( '/inc/core/merlin/admin-menu.php' );

// Template-functions
include get_template_directory() . '/inc/template-functions.php';

// Theme parts
include get_template_directory() . '/inc/template-parts/menu.php';
include get_template_directory() . '/inc/template-parts/post-formats.php';
include get_template_directory() . '/inc/template-parts/single-post-formats.php';
include get_template_directory() . '/inc/template-parts/paginations.php';
include get_template_directory() . '/inc/template-parts/comment-parts.php';
include get_template_directory() . '/inc/template-parts/small-parts.php';
include get_template_directory() . '/inc/template-parts/header-parts.php';
include get_template_directory() . '/inc/template-parts/footer-parts.php';
include get_template_directory() . '/inc/template-parts/page-hero.php';
include get_template_directory() . '/inc/template-parts/breadcrumbs.php';
include get_template_directory() . '/inc/template-parts/custom-style.php';

// TGM plugin activation
include get_template_directory() . '/inc/core/class-tgm-plugin-activation.php';

// Redux theme options panel
include get_template_directory() . '/inc/core/theme-options/options.php';

// WooCommerce init
if ( class_exists( 'WooCommerce' ) ) {
    include get_template_directory() . '/woocommerce/init.php';
}

/*************************************************
## THEME SETUP
*************************************************/

if ( ! isset( $content_width ) ) {
    $content_width = 960;
}

function venam_theme_setup()
{

    /*
    * This theme styles the visual editor to resemble the theme style,
    * specifically font, colors, icons, and column width.
    */
    add_editor_style( 'custom-editor-style.css' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    add_image_size( 'venam-square', 500, 500, true );
    add_image_size( 'venam-grid', 750, 750, true );
    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    */
    add_theme_support( 'post-thumbnails' );

    // theme supports
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'html5', array( 'search-form' ) );
    add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
    remove_theme_support( 'widgets-block-editor' );

    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
    load_theme_textdomain( 'venam', get_template_directory() . '/languages' );

    register_nav_menus(array(
        'header_menu' => esc_html__( 'Header Menu', 'venam' ),
        'category_menu' => esc_html__( 'Mobile Category Menu', 'venam' )
    ) );
}
add_action( 'after_setup_theme', 'venam_theme_setup' );


/*************************************************
## WIDGET COLUMNS
*************************************************/

function venam_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__( 'Blog Sidebar', 'venam' ),
        'id' => 'sidebar-1',
        'description' => esc_html__( 'These widgets for the Blog page.', 'venam' ),
        'before_widget' => '<div class="nt-sidebar-inner-widget widget blog-sidebar-widget mb-40 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="nt-sidebar-inner-widget-title blog-sidebar-title mb-25"><h5>',
        'after_title' => '</h5></div>'
    ) );
    if ( class_exists( 'Redux' ) ) {
        if ( 'full-width' != venam_settings( 'venam_page_layout' ) ) {
            register_sidebar(array(
                'name' => esc_html__( 'Default Page Sidebar', 'venam' ),
                'id' => 'venam-page-sidebar',
                'description' => esc_html__( 'These widgets for the Default Page pages.', 'venam' ),
                'before_widget' => '<div class="nt-sidebar-inner-widget widget blog-sidebar-widget mb-40 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="nt-sidebar-inner-widget-title blog-sidebar-title mb-25">',
                'after_title' => '</h5>'
            ) );
        }
        if ( 'full-width' != venam_settings( 'archive_layout', 'full-width' ) ) {
            register_sidebar(array(
                'name' => esc_html__( 'Archive Sidebar', 'venam' ),
                'id' => 'venam-archive-sidebar',
                'description' => esc_html__( 'These widgets for the Archive pages.', 'venam' ),
                'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="nt-sidebar-inner-widget-title widget-title">',
                'after_title' => '</h3>'
            ) );
        }
        if ( 'full-width' != venam_settings( 'search_layout', 'full-width' ) ) {
            register_sidebar(array(
                'name' => esc_html__( 'Search Sidebar', 'venam' ),
                'id' => 'venam-search-sidebar',
                'description' => esc_html__( 'These widgets for the Search pages.', 'venam' ),
                'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="nt-sidebar-inner-widget-title widget-title">',
                'after_title' => '</h3>'
            ) );
        }
        if ( 'full-width' != venam_settings( 'single_layout', 'full-width' ) ) {
            register_sidebar(array(
                'name' => esc_html__( 'Blog Single Sidebar', 'venam' ),
                'id' => 'venam-single-sidebar',
                'description' => esc_html__( 'These widgets for the Blog single page.', 'venam' ),
                'before_widget' => '<div class="nt-sidebar-inner-widget widget blog-sidebar-widget mb-40 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="nt-sidebar-inner-widget-title blog-sidebar-title mb-25"><h5>',
                'after_title' => '</h5></div>'
            ) );
        }
    } // end if redux exists
} // end venam_widgets_init
add_action( 'widgets_init', 'venam_widgets_init' );


/*************************************************
## INCLUDE THE TGM_PLUGIN_ACTIVATION CLASS.
*************************************************/

function venam_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => esc_html__( 'Contact Form 7', 'venam' ),
            'slug' => 'contact-form-7'
        ),
        array(
            'name' => esc_html__( 'Theme Options Panel', 'venam' ),
            'slug' => 'redux-framework',
            'required' => true
        ),
        array(
            'name' => esc_html__( 'Elementor', 'venam' ),
            'slug' => 'elementor',
            'required' => true
        ),
        array(
            'name' => esc_html__( 'WooCommerce', 'venam' ),
            'slug' => 'woocommerce',
            'required' => true
        ),
        array(
            'name' => esc_html__( 'WPC Smart Compare', 'venam' ),
            'slug' => 'woo-smart-compare',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'WPC Smart Wishlist', 'venam' ),
            'slug' => 'woo-smart-wishlist',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'WPC Smart Quick View', 'venam' ),
            'slug' => 'woo-smart-quick-view',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'WPC Variation Swatches', 'venam' ),
            'slug' => 'wpc-variation-swatches',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Envato Auto Update Theme', 'venam' ),
            'slug' => 'envato-market',
            'source' => 'https://ninetheme.com/documentation/plugins/envato-market.zip',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Revolution Slider', 'venam' ),
            'slug' => 'revslider',
            'source' => 'https://ninetheme.com/documentation/plugins/revslider.zip',
            'required' => false
        ),
        array(
            'name' => esc_html__( 'Venam Elementor Addons', 'venam' ),
            'slug' => 'venam-elementor-addons',
            'source' => get_template_directory() . '/plugins/venam-elementor-addons.zip',
            'required' => true,
            'version' => '1.1.5'
        )
        // end plugins list
    );

    $config = array(
        'id' => 'tgmpa',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'parent_slug' => apply_filters( 'ninetheme_parent_slug', 'themes.php' ),
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => true,
        'message' => ''
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'venam_register_required_plugins' );



/*************************************************
## ONE CLICK DEMO IMPORT
*************************************************/


/*************************************************
## THEME SETUP WIZARD
    https://github.com/richtabor/MerlinWP
*************************************************/

require_once get_parent_theme_file_path( '/inc/core/merlin/class-merlin.php' );
require_once get_parent_theme_file_path( '/inc/core/demo-wizard-config.php' );

function venam_merlin_local_import_files() {
    $rtl = is_rtl() ? '-rtl' : '';
    return array(
        array(
            'landing_page' => 'https://landing.ninetheme.com/venam/',
        ),
        array(
            'import_file_name' => esc_html__( 'Home - Advanced','venam' ),
            'import_preview_url' => 'https://ninetheme.com/themes/venam/v1/',
            // XML data
            'local_import_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/demo4/data.xml' ),
            // Widget data
            'local_import_widget_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/demo4/widgets.wie' ),
            // Theme options
            'local_import_redux' => array(
                array(
                    'file_path' => trailingslashit( get_template_directory() ). 'inc/core/merlin/demodata/demo4/redux.json',
                    'option_name' => 'venam'
                )
            )
        ),
        array(
            'import_file_name' => esc_html__( 'Home - Electronic','venam' ),
            'import_preview_url' => 'https://ninetheme.com/themes/venam/v1/home/',
            // XML data
            'local_import_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/demo1/data'.$rtl.'.xml' ),
            // Widget data
            'local_import_widget_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/demo1/widgets.wie' ),
            // Theme options
            'local_import_redux' => array(
                array(
                    'file_path' => trailingslashit( get_template_directory() ). 'inc/core/merlin/demodata/demo1/redux.json',
                    'option_name' => 'venam'
                )
            )
        ),
        array(
            'import_file_name' => esc_html__( 'Home - Fashion','venam' ),
            'import_preview_url' => 'https://ninetheme.com/themes/venam/v2/',
            // XML data
            'local_import_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/demo2/data.xml' ),
            // Widget data
            'local_import_widget_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/demo2/widgets.wie' ),
            // Theme options
            'local_import_redux' => array(
                array(
                    'file_path' => trailingslashit( get_template_directory() ). 'inc/core/merlin/demodata/demo2/redux.json',
                    'option_name' => 'venam'
                )
            )
        ),
        array(
            'import_file_name' => esc_html__( 'Home - Decor','venam' ),
            'import_preview_url' => 'https://ninetheme.com/themes/venam/v3/',
            // XML data
            'local_import_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/demo3/data.xml' ),
            // Widget data
            'local_import_widget_file' => get_parent_theme_file_path( 'inc/core/merlin/demodata/demo3/widgets.wie' ),
            // Theme options
            'local_import_redux' => array(
                array(
                    'file_path' => trailingslashit( get_template_directory() ). 'inc/core/merlin/demodata/demo3/redux.json',
                    'option_name' => 'venam'
                )
            )
        )
    );
}
add_filter( 'merlin_import_files', 'venam_merlin_local_import_files' );


function venam_disable_size_images_during_import() {
    add_filter( 'intermediate_image_sizes_advanced', function( $sizes ){
        unset( $sizes['thumbnail'] );
        unset( $sizes['medium'] );
        unset( $sizes['medium_large'] );
        unset( $sizes['large'] );
        unset( $sizes['1536x1536'] );
        unset( $sizes['2048x2048'] );
        unset( $sizes['venam-single'] );
        unset( $sizes['venam-square'] );
        unset( $sizes['venam-grid'] );
        unset( $sizes['woosq'] );
        unset( $sizes['wooscp-small'] );
        unset( $sizes['shop_catalog'] );
        unset( $sizes['shop_single'] );
        unset( $sizes['woocommerce_single'] );
        unset( $sizes['woosc-large'] );
        unset( $sizes['woosc-small'] );
        unset( $sizes['woocommerce_thumbnail'] );
        unset( $sizes['shop_thumbnail'] );
        unset( $sizes['woocommerce_gallery_thumbnail'] );
        return $sizes;
    } );
}
add_action( 'import_start', 'venam_disable_size_images_during_import');


/**
 * Execute custom code after the whole import has finished.
 */
function venam_merlin_after_import_setup() {
    // Assign menus to their locations.
    $primary = get_term_by( 'name', 'Menu 1', 'nav_menu' );
    $catsmenu = get_term_by( 'name', 'Mobile Woo Category Menu', 'nav_menu' );

    set_theme_mod(
        'nav_menu_locations', array(
            'header_menu' => $primary->term_id
        )
    );
    set_theme_mod(
        'nav_menu_locations', array(
            'category_menu' => $catsmenu->term_id
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    if ( did_action( 'elementor/loaded' ) ) {
        // update some default elementor global settings after setup theme
        $kit = get_page_by_title( 'Default Kit', OBJECT, 'elementor_library' );
        update_option( 'elementor_active_kit', $kit->ID );
        // update some default elementor global settings after setup theme
        //update_option( 'elementor_active_kit', '2878' );
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_global_image_lightbox', 'yes' );
    }

    if ( class_exists( 'FlrtFilter' ) ) {
        $venam_wpc_options = get_option('wpc_filter_setting');
        $venam_wpc_options['posts_container'] = '.products-wrapper';
        $venam_wpc_options['enable_ajax'] = 'on';
        $venam_wpc_options['show_bottom_widget'] = 'on';
        $venam_wpc_options['show_terms_in_content'] = 'on';
        update_option( 'wpc_filter_settings', $venam_wpc_options );
    }
    add_action( 'init', function () {
        $query_posts = new WP_Query( array('post_type' => 'product'));
        while ( $query_posts->have_posts() ) {
            $query_posts->the_post();
            wp_update_post( $post );
        }
        wp_reset_postdata();
    });

}
add_action( 'merlin_after_all_import', 'venam_merlin_after_import_setup' );

add_action('init', 'do_output_buffer'); function do_output_buffer() { ob_start(); }

add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );

add_action( 'admin_init', function() {
    if ( did_action( 'elementor/loaded' ) ) {
        remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
    }
}, 1 );

function venam_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_location( 'header' );
    $elementor_theme_manager->register_location( 'footer' );
    $elementor_theme_manager->register_location( 'single' );
    $elementor_theme_manager->register_location( 'archive' );

}
add_action( 'elementor/theme/register_locations', 'venam_register_elementor_locations' );
