<?php
/**
* Plugin Name: Venam Elementor Addons
* Description: Premium & Advanced Essential Elements for Elementor
* Plugin URI:  http://themeforest.net/user/Ninetheme
* Version:     1.1.5
* Author:      Ninetheme
* Text Domain: venam
* Domain Path: /languages/
* Author URI:  https://ninetheme.com/
* Elementor tested up to: 3.6.7
*/

/*
* Exit if accessed directly.
*/

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'VENAM_PLUGIN_VERSION', '1.1.5' );
define( 'VENAM_PLUGIN_FILE', __FILE__ );
define( 'VENAM_PLUGIN_BASENAME', plugin_basename(__FILE__) );
define( 'VENAM_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'VENAM_PLUGIN_URL', plugins_url('/', __FILE__) );

final class Venam_Elementor_Addons
{
    /**
    * Plugin Version
    *
    * @since 1.0
    *
    * @var string The plugin version.
    */
    const VERSION = '1.1.5';

    /**
    * Minimum Elementor Version
    *
    * @since 1.0
    *
    * @var string Minimum Elementor version required to run the plugin.
    */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
    * Minimum PHP Version
    *
    * @since 1.0
    *
    * @var string Minimum PHP version required to run the plugin.
    */
    const MINIMUM_PHP_VERSION = '5.6';

    /**
    * Instance
    *
    * @since 1.0
    *
    * @access private
    * @static
    *
    * @var Venam_Elementor_Addons The single instance of the class.
    */
    private static $_instance = null;

    /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.0
    *
    * @access public
    * @static
    *
    * @return Venam_Elementor_Addons An instance of the class.
    */
    public static function instance()
    {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
    * Constructor
    *
    * @since 1.0
    *
    * @access public
    */
    public function __construct()
    {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
    * Load Textdomain
    *
    * Load plugin localization files.
    *
    * Fired by `init` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function i18n()
    {
        load_plugin_textdomain( 'venam', false, basename( __DIR__ ) . '/languages/' );
    }

    /**
    * Initialize the plugin
    *
    * Load the plugin only after Elementor (and other plugins) are loaded.
    * Checks for basic plugin requirements, if one check fail don't continue,
    * if all check have passed load the files required to run the plugin.
    *
    * Fired by `plugins_loaded` action hook.
    *
    * @since 1.0
    *
    * @access public
    */
    public function init()
    {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'venam_admin_notice_missing_main_plugin' ] );
            return;
        }
        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'venam_admin_notice_minimum_elementor_version' ] );
            return;
        }
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'venam_admin_notice_minimum_php_version' ] );
            return;
        }
        // register template name for the elementor saved templates
        add_filter( 'elementor/editor/localize_settings', [ $this,'venam_register_template'],10,2 );
        add_filter( 'elementor/icons_manager/additional_tabs', [ $this,'venam_add_custom_icons_tab'],10,2 );

        /* Custom plugin helper functions */
        require_once( VENAM_PLUGIN_PATH . '/classes/class-helpers-functions.php' );
        /* Elementor section parallax */
        require_once( VENAM_PLUGIN_PATH . '/classes/class-custom-elementor-section.php' );
        /* Add custom controls to default widgets */
        require_once( VENAM_PLUGIN_PATH . '/classes/class-customizing-default-widgets.php' );
        /* Add custom controls to page settings */
        require_once( VENAM_PLUGIN_PATH . '/classes/class-customizing-page-settings.php' );
        if ( class_exists( 'WooCommerce' ) ) {
            /* Add custom wp woocommerce widgets */
            require_once( VENAM_PLUGIN_PATH . '/widgets/woocommerce/wp-widgets/widget-product-status.php' );
            require_once( VENAM_PLUGIN_PATH . '/widgets/woocommerce/wp-widgets/widget-product-categories.php' );
        }

        if ( is_user_logged_in() ) {
            include_once( VENAM_PLUGIN_PATH . '/templates/template-library/library-manager.php' );
            include_once( VENAM_PLUGIN_PATH . '/templates/template-library/library-source.php' );
        }

        /* includes/shortcodes/elementor */
        if ( ! get_option( 'disable_venam_list_shortcodes' ) == 1 ) {
            require_once( VENAM_PLUGIN_PATH . '/classes/class-list-shortcodes.php' );
        }
        if ( ! get_option( 'disable_venam_wc_brands' ) == 1 ) {
            require_once( VENAM_PLUGIN_PATH . '/widgets/woocommerce/brands/brands.php' );
        }
        if ( ! get_option( 'disable_venam_wc_ajax_search' ) == 1 ) {
            require_once( VENAM_PLUGIN_PATH . '/widgets/woocommerce/ajax-search/class-ajax-search.php' );
        }
        if ( ! get_option( 'disable_venam_wc_popup_cart_notices' ) == 1 ) {
            require_once( VENAM_PLUGIN_PATH . '/widgets/woocommerce/popup-cart-notices/popup-cart-notices.php' );
        }
        /* Admin template */
        require_once( VENAM_PLUGIN_PATH . '/templates/admin/admin.php' );
        // Categories registered
        add_action( 'elementor/elements/categories_registered', [ $this, 'venam_add_widget_category' ] );
        // Widgets registered
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_single_widgets' ] );
        // Register Widget Styles
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_front_scripts' ] );
        // Register Widget Scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'widget_scripts' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'widget_scripts' ] );

        add_action('elementor/editor/after_enqueue_styles', [ $this, 'admin_custom_scripts' ]);
        // Register Widget Scripts
        add_action( 'wp_print_styles', [ $this, 'dequeue_style' ], 100 );
        add_action( 'wp_print_scripts', [ $this, 'dequeue_scripts' ], 100 );

        add_action( 'wp_ajax_venam_ajax_tab_slider', [ $this, 'venam_ajax_tab_slider_handler' ] );
        add_action( 'wp_ajax_nopriv_venam_ajax_tab_slider', [ $this, 'venam_ajax_tab_slider_handler' ] );

        add_action( 'woocommerce_single_product_summary', [ $this, 'venam_product_share_buttons' ], 41 );

        //add_action( 'elementor/ajax/register_actions', [ $this, 'register_actions' ] );

    }


    public function widget_front_scripts() {
        // swiper
        wp_register_style( 'swiper', get_template_directory_uri() . '/js/swiper/swiper.min.css', false, '1.0' );
        wp_register_script( 'swiper', get_template_directory_uri() . '/js/swiper/swiper.min.js', array( 'jquery' ), '1.0', true );

        // widget-tab-slider
        wp_enqueue_script( 'widget-tab-slider', VENAM_PLUGIN_URL . 'assets/front/js/ajax-tab-slider/script.js', array('jquery'), '1.0.0', true );
        wp_localize_script( 'widget-tab-slider', 'tabAjax', array(
            'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' ))
        ));
    }

    public function dequeue_style() {
        if ( is_page() && !is_page_template() ) {
            wp_dequeue_style( 'venam-framework-style' );
        }
    }

    public function dequeue_scripts() {
        if( is_page_template( 'default' ) ){
            //wp_dequeue_script( 'swiper' );
        }
    }

    public function venam_register_template( $localized_settings, $config )
    {
        $localized_settings = [
            'i18n' => [
                'my_templates' => esc_html__( 'Venam Templates', 'venam' )
            ]
        ];
        return $localized_settings;
    }


    public function admin_custom_scripts()
    {
        // Elementor Editor custom css
        wp_enqueue_style( 'venam-custom-editor', VENAM_PLUGIN_URL. 'assets/front/css/plugin-editor.css' );
    }

    public function widget_styles()
    {
        // Plugin custom css
        $rtl = is_rtl() ? '-rtl' : '';
        wp_enqueue_style( 'venam-custom', VENAM_PLUGIN_URL. 'assets/front/css/custom'.$rtl.'.css' );
    }

    public function widget_scripts()
    {
        wp_register_style( 'hamburgers', get_template_directory_uri() . '/css/hamburgers.css', false, '1.0' );
        // gsap
        wp_register_script( 'tween-max', VENAM_PLUGIN_URL. 'assets/front/js/gsap/TweenMax.min.js', array( 'jquery' ), '1.0', true );
        wp_register_script( 'gsap', VENAM_PLUGIN_URL. 'assets/front/js/gsap/gsap.min.js', array( 'jquery' ), '1.0', true );
        wp_register_script( 'scrollmagic', VENAM_PLUGIN_URL. 'assets/front/js/gsap/scrollmagic.min.js', array('jquery'), '1.0', true );

        // vegas slider
        wp_register_style( 'vegas', VENAM_PLUGIN_URL. 'assets/front/js/vegas/vegas.css', '1.0', true );
        wp_register_script( 'vegas', VENAM_PLUGIN_URL. 'assets/front/js/vegas/vegas.min.js', array( 'jquery' ), '1.0', true );

        // magnific-popup-lightbox
        wp_register_style( 'magnific', VENAM_PLUGIN_URL. 'assets/front/js/magnific/magnific-popup.css', false, '1.0' );
        wp_register_script( 'magnific', VENAM_PLUGIN_URL. 'assets/front/js/magnific/magnific-popup.min.js', array( 'jquery' ), false, '1.0' );

        // isotope
        wp_register_script( 'isotope', VENAM_PLUGIN_URL. 'assets/front/js/isotope/isotope.min.js', array( 'jquery' ), false, '1.0' );
        wp_register_script( 'imagesloaded', VENAM_PLUGIN_URL. 'assets/front/js/isotope/imagesloaded.pkgd.min.js', array( 'jquery' ), false, '1.0' );
        // isotope
        wp_register_style( 'cbp', VENAM_PLUGIN_URL . 'assets/front/js/cbp/cubeportfolio.min.css', false, '1.0' );
        wp_register_style( 'cbp-custom', VENAM_PLUGIN_URL . 'assets/front/js/cbp/cubeportfolio-custom.css', false, '1.0' );
        wp_register_script( 'cbp', VENAM_PLUGIN_URL. 'assets/front/js/cbp/cubeportfolio.min.js', array( 'jquery' ), false, '1.0' );

        // odometer
        wp_register_style( 'odometer', VENAM_PLUGIN_URL. 'assets/front/js/odometer/odometer.css', false, '1.0' );
        wp_register_script( 'odometer', VENAM_PLUGIN_URL. 'assets/front/js/odometer/odometer.min.js', array( 'jquery' ), false, '1.0' );

        // jarallax
        wp_register_script( 'jarallax', VENAM_PLUGIN_URL. 'assets/front/js/jarallax/jarallax.min.js', array( 'jquery' ), false, '1.0' );
        wp_register_script( 'particles', VENAM_PLUGIN_URL. 'assets/front/js/particles/particles.min.js', array( 'jquery' ), false, '1.0' );
        wp_register_script( 'tilt', VENAM_PLUGIN_URL. 'assets/front/js/tilt/tilt.jquery.min.js', array( 'jquery' ), false, '1.0' );

        // jquery-ui
        wp_enqueue_style( 'jquery-ui', VENAM_PLUGIN_URL. 'assets/front/js/jquery-ui/jquery-ui.min.css', false, '1.0' );
        wp_enqueue_script( 'jquery-ui', VENAM_PLUGIN_URL. 'assets/front/js/jquery-ui/jquery-ui.min.js', array( 'jquery' ), false, '1.0' );

        wp_enqueue_script( 'jarallax');
        wp_enqueue_script( 'particles');
        wp_enqueue_style( 'vegas');
        wp_enqueue_script( 'vegas');
        // custom-scripts
        wp_enqueue_script( 'venam-addons-custom-scripts', VENAM_PLUGIN_URL. 'assets/front/js/custom-scripts.js', [ 'jquery' ], VENAM_PLUGIN_VERSION, true );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have Elementor installed or activated.
    *
    * @since 1.0
    *
    * @access public
    */
    public function venam_admin_notice_missing_main_plugin()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '%1$s requires %2$s to be installed and activated.', 'venam' ),
            '<strong>' . esc_html__( 'Venam Elementor Addons', 'venam' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'venam' ) . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required Elementor version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function venam_admin_notice_minimum_elementor_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'venam' ),
            '<strong>' . esc_html__( 'Venam Elementor Addons', 'venam' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'venam' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Admin notice
    *
    * Warning when the site doesn't have a minimum required PHP version.
    *
    * @since 1.0
    *
    * @access public
    */
    public function venam_admin_notice_minimum_php_version()
    {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '%1$s requires %2$s version %3$s or greater.', 'venam' ),
            '<strong>' . esc_html__( 'Venam Elementor Addons', 'venam' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'venam' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    /**
    * Register Widgets Category
    *
    */
    public function venam_add_widget_category( $elements_manager )
    {
        $elements_manager->add_category( 'venam', [ 'title' => esc_html__( 'Venam Addons', 'venam' ),'icon' => 'fa fa-smile-o', ] );
        $elements_manager->add_category( 'venam-post', [ 'title' => esc_html__( 'Venam Post', 'venam' ) ] );
        $elements_manager->add_category( 'venam-woo', [ 'title' => esc_html__( 'Venam WooCommerce', 'venam' ) ] );
        $elements_manager->add_category( 'venam-woo-product', [ 'title' => esc_html__( 'Venam WooCommerce Product', 'venam' ) ] );
    }

    public function venam_widgets_list()
    {
        $list = array(
            array( 'name' => 'header-menu', 'class' => 'Venam_Header_Menu' ),
            array( 'name' => 'button', 'class' => 'Venam_Button' ),
            array( 'name' => 'menu-vertical', 'class' => 'Venam_Vertical_Menu' ),
            array( 'name' => 'header-top-menu', 'class' => 'Venam_Headertop_Menu' ),
            array( 'name' => 'posts-base', 'class' => 'Venam_Posts_Base' ),
            array( 'name' => 'blog-posts', 'class' => 'Venam_Blog_Posts' ),
            array( 'name' => 'section-heading', 'class' => 'Venam_Section_Heading' ),
            array( 'name' => 'breadcrumbs', 'class' => 'Venam_Breadcrumbs' ),
            array( 'name' => 'home-slider', 'class' => 'Venam_Home_Slider' ),
            array( 'name' => 'fetatures-item', 'class' => 'Venam_Features_Item' ),
            array( 'name' => 'timer', 'class' => 'Venam_Timer' ),
            array( 'name' => 'special-offer-box', 'class' => 'Venam_Special_Offer' ),
            array( 'name' => 'special-offer-banner', 'class' => 'Venam_Special_Offer_Banner' ),
            array( 'name' => 'limited-offer-banner', 'class' => 'Venam_Limited_Offer_Banner' ),
            array( 'name' => 'special-offer-single', 'class' => 'Venam_Special_Offer_Single' ),
            array( 'name' => 'contact-form-7', 'class' => 'Venam_Contact_Form_7' ),
            array( 'name' => 'testimonials-slider', 'class' => 'Venam_Testimonials' ),
            array( 'name' => 'icon-box', 'class' => 'Venam_Icon_Box' ),
            array( 'name' => 'sidebar-widgets', 'class' => 'Venam_Sidebar_Widgets' ),
            array( 'name' => 'vegas-slider', 'class' => 'Venam_Vegas_Slider' ),
            array( 'name' => 'vegas-template', 'class' => 'Venam_Vegas_Template' ),
            array( 'name' => 'gallery', 'class' => 'Venam_Portfolio' ),

            // blog post widgets
            array( 'name' => 'blog-grid', 'subfolder' => 'blog', 'class' => 'Venam_Blog_Grid' ),
            array( 'name' => 'blog-masonry', 'subfolder' => 'blog', 'class' => 'Venam_Blog_Masonry' ),
            array( 'name' => 'blog-slider', 'subfolder' => 'blog', 'class' => 'Venam_Blog_Slider' ),

            // wocommerce widgets
            array( 'name' => 'woo-super-deals', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Super_Deals' ),
            array( 'name' => 'woo-tab-slider', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Tab_Slider' ),
            array( 'name' => 'woo-grid', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Grid' ),
            array( 'name' => 'woo-category-grid', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Category_Grid' ),
            array( 'name' => 'woo-list', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Products_List' ),
            array( 'name' => 'woo-slider', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Slider' ),
            array( 'name' => 'woo-gallery', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Gallery' ),
            array( 'name' => 'woo-mini-cart', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Minicart' ),
            array( 'name' => 'woo-header-actions', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Header_Actions' ),
            array( 'name' => 'woo-ajax-search', 'subfolder' => 'woocommerce', 'class' => 'Venam_Woo_Ajax_Search' ),
            array( 'name' => 'woo-archive-description', 'subfolder' => 'woocommerce', 'class' => 'Venam_WC_Archive_Description' ),
            array( 'name' => 'woo-categories', 'subfolder' => 'woocommerce', 'class' => 'Venam_WC_Categories' ),
        );
        return $list;
    }

    /**
    * Init Widgets
    */
    public function init_widgets()
    {
        $widgets = $this->venam_widgets_list();

        if ( ! empty( $widgets ) ) {

            foreach ( $widgets as $widget ) {

                $option = 'disable_'.str_replace( '-', '_', $widget['name'] );
                $path = VENAM_PLUGIN_PATH . '/widgets/';
                $file = $widget['name'] . '.php';
                $file = isset( $widget['subfolder'] ) != '' ? $path.$widget['subfolder'] . '/' . $widget['name']. '.php' : $path.$file;
                $class = 'Elementor\\'.$widget['class'];

                if ( ! get_option( $option ) == 1 ) {

                    if ( file_exists( $file ) ) {
                        require_once( $file );
                        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                    }
                }
            }
        }
    }


    /**
    * Register Single Post Widgets
    */
    public function venam_single_widgets_list()
    {
        $list = array(
            array( 'post-type' => 'post', 'name' => 'post-data', 'class' => 'Venam_Post_Data' ),
            // wocommerce widgets
            array( 'post-type' => 'product','name' => 'add-to-cart', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Add_To_Cart' ),

            array( 'post-type' => 'product','name' => 'breadcrumb', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Breadcrumb' ),
            array( 'post-type' => 'product','name' => 'product-add-to-cart', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Add_To_Cart' ),
            array( 'post-type' => 'product','name' => 'product-additional-information', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Additional_Information' ),
            array( 'post-type' => 'product','name' => 'product-data-tabs', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Data_Tabs' ),
            array( 'post-type' => 'product','name' => 'product-images', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Images' ),
            array( 'post-type' => 'product','name' => 'product-meta', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Meta' ),
            array( 'post-type' => 'product','name' => 'product-price', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Price' ),
            array( 'post-type' => 'product','name' => 'product-rating', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Rating' ),
            array( 'post-type' => 'product','name' => 'product-related', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Related' ),
            array( 'post-type' => 'product','name' => 'product-short-description', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Short_Description' ),
            array( 'post-type' => 'product','name' => 'product-stock', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Stock' ),
            array( 'post-type' => 'product','name' => 'product-title', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Title' ),
            array( 'post-type' => 'product','name' => 'product-upsell', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Product_Upsell' ),
            array( 'post-type' => 'product','name' => 'single-elements', 'subfolder' => 'woocommerce/product', 'class' => 'Venam_WC_Single_Elements' )
        );
        return $list;
    }

    /**
    * Init Single Post Widgets
    */
    public function init_single_widgets()
    {
        $widgets = $this->venam_single_widgets_list();
        global $post;
        $venam_post_type = false;

        if ( ! empty( $widgets ) && !is_404() && !is_archive() ) {

            $venam_post_type = get_post_type( $post->ID );

            $count = 0;

            foreach ( $widgets as $widget ) {

                if ( $venam_post_type == $widgets[$count]['post-type'] ) {

                    $option = 'disable_'.str_replace( '-', '_', $widget['name'] );
                    $path = VENAM_PLUGIN_PATH . '/widgets/';
                    $file = $widget['name'] . '.php';
                    $file = isset( $widget['subfolder'] ) != '' ? $path.$widget['subfolder'] . '/' . $widget['name']. '.php' : $path.$file;
                    $class = 'Elementor\\'.$widget['class'];

                    if ( ! get_option( $option ) == 1 ) {

                        if ( file_exists( $file ) ) {

                            require_once( $file );
                            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class() );
                        }
                    }
                }
                $count++;
            }
        }
    }

    /*
    * List Icons
    */

    public function venam_add_custom_icons_tab( $tabs = array() )
    {
        $new_icons = array(
            'shopping-bags',
            'magnifying-glass',
            'menu',
            'heart',
            'two-arrows',
            'shopping-bag',
            'user',
            'menu-1',
            'justification',
            'scroll',
            'shuffle',
            'shuffle-1',
            'supermarket',
            'witness',
            'quote-left',
            'list',
            'menu-2',
            'grid',
            'project',
            'revenue',
            'quality',
            'shuttle',
            'invoice',
            'secure-payment',
            '24-hours-support',
            'placeholder',
            'telephone',
            'mail',
            'zoom-in',
            'right-arrow',
            'left-arrow',
            'cancel',
            'cancel-1',
            'done',
            'check',
            'select',
            'cancel-2',
            'password',
            'scroll-1',
            'calendar',
            'exit',
            'plus',
            'crosshair',
            'loupe',
            'magnifying-glass-1',
            'right-quote',
            'plus-1',
            'lock',
            'copyright',
            'list-1'
        );

        $tabs['venam-custom-icons'] = array(
            'name' => 'venam-custom-icons',
            'label' => esc_html__( 'Venam Icons', 'venam' ),
            'labelIcon' => 'flaticon-heart',
            'prefix' => 'flaticon-',
            'displayPrefix' => 'venam-icons',
            'url' => get_template_directory_uri() . '/css/flaticon/flaticon.css',
            'icons' => $new_icons,
            'ver' => '1.0.0',
        );

        return $tabs;
    }

    public function venam_ajax_tab_slider_handler() {
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => $_POST['per_page']
        );
        if ( $_POST['cat_id'] != null ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'id',
                'terms'    => $_POST['cat_id']
            );
        }
        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) {
                $loop->the_post();
                echo '<div class="swiper-slide product_item">';
                    wc_get_template_part( 'content', 'product' );
                echo '</div>';
            }
        } else {
            echo esc_html__( 'No products found','venam' );
        }
        wp_reset_postdata();

        wp_die();
    }

    /**
    * ------------------------------------------------------------------------------------------------
    * Single product share buttons
    * ------------------------------------------------------------------------------------------------
    */
    public function venam_product_share_buttons()
    {
        if ( !function_exists( 'venam_settings' ) ) {
            return;
        }
        if ( '1' == venam_settings( 'single_shop_share_visibility', '0' ) ) {

            $type = venam_settings( 'single_shop_share_type' );
            $title = 'share' === $type ? esc_html__( 'Share', 'venam' ) : esc_html__( 'Follow', 'venam' );
            ?>
            <div class="venam-product-share">
                <span class="share-title"><?php echo esc_html( $title ); ?>: </span> <?php $this->venam_shortcode_social( array( 'type' => $type ) ); ?>
            </div>
            <?php
        }
    }

    public function venam_shortcode_social($args) {

        if ( !function_exists( 'venam_settings' ) ) {
            return;
        }

        $args = array(
            'type' => 'share',
            'page_link' => false
        );

        $type = $args['type'];
        $page_link = $args['page_link'];
        $target = "_blank";

        $thumb_id = get_post_thumbnail_id();
        $thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
        $page_title = get_the_title();

        if ( ! $page_link ) {
            $page_link = get_the_permalink();
        }

        if ( class_exists( 'WooCommerce' ) && is_shop() ) {
            $page_link = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
        }
        if ( class_exists( 'WooCommerce' ) && ( is_product_category() || is_category() ) ) {
            $page_link = get_category_link( get_queried_object()->term_id );
        }
        if ( is_home() && ! is_front_page() ) {
            $page_link = get_permalink( get_option( 'page_for_posts' ) );
        }

        ?>

        <div class="venam-social-icons">
            <?php if ( '1' == venam_settings( 'share_facebook', '0' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'fb_link' )) : 'https://www.facebook.com/sharer/sharer.php?u=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-facebook" data-title="facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_twitter', '0') ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'twitter_link' )) : 'https://twitter.com/share?url=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-twitter" data-title="twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_email', '0') ) : ?>
                <a rel="noopener noreferrer nofollow" href="mailto:<?php echo '?subject=' . esc_html__('Check%20this%20', 'venam') . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-email" data-title="email">
                    <i class="far fa-envelope"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_instagram', '0') && $type == 'follow' && '' != venam_settings( 'instagram_link' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'instagram_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-instagram" data-title="instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_youtube', '0') && $type == 'follow' && '' != venam_settings( 'youtube_link' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'youtube_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-youtube" data-title="youtube">
                    <i class="fab fa-youtube"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_vimeo', '0') && $type == 'follow' && '' != venam_settings( 'vimeo_link' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url( venam_settings( 'vimeo_link' ) ) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-vimeo" data-title="vimeo">
                    <i class="fab fa-vimeo-v"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_pinterest', '0') ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'pinterest_link' )) : 'https://pinterest.com/pin/create/button/?url=' . $page_link . '&media=' . $thumb_url[0] . '&description=' . urlencode( $page_title ); ?>" target="<?php echo esc_attr( $target ); ?>" class="social-pinterest" data-title="pinterest">
                    <i class="fab fa-pinterest"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_linkedin', '0') ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'linkedin_link' )) : 'https://www.linkedin.com/shareArticle?mini=true&url=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-linkedin" data-title="linkedin">
                    <i class="fab fa-linkedin"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_tumblr', '0') && $type == 'follow' && '' != venam_settings( 'tumblr_link' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'tumblr_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-tumblr" data-title="tumblr">
                    <i class="fab fa-tumblr"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_flickr', '0') && $type == 'follow' && '' != venam_settings( 'flickr_link' ) ): ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'flickr_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-flickr" data-title="flickr">
                    <i class="fab fa-flickr"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_github', '0') && $type == 'follow' && '' != venam_settings( 'github_link' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'github_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-github" data-title="github">
                    <i class="fab fa-github"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_behance', '0') && $type == 'follow' && '' != venam_settings( 'behance_link' ) ): ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'behance_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-behance" data-title="behance">
                    <i class="fab fa-behance"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_dribbble', '0') && $type == 'follow' && '' != venam_settings( 'dribbble_link' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'dribbble_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-dribbble" data-title="dribbble">
                    <i class="fab fa-dribbble"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_soundcloud', '0') && $type == 'follow' && '' != venam_settings( 'soundcloud_link' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'soundcloud_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-soundcloud" data-title="soundcloud">
                    <i class="fab fa-soundcloud"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_spotify', '0') && $type == 'follow' && '' != venam_settings( 'spotify_link' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'spotify_link' )) : '' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-spotify" data-title="spotify">
                    <i class="fab fa-spotify"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_ok', '0') ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? esc_url(venam_settings( 'ok_link' )) : 'https://connect.ok.ru/offer?url=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-ok" data-title="ok">
                    <i class="fab fa-odnoklassniki-square"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_whatsapp', '0') ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? ( venam_settings( 'whatsapp_link' )) : 'https://api.whatsapp.com/send?text=' . urlencode( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="whatsapp-desktop social-whatsapp" data-title="whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>

                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? ( venam_settings( 'whatsapp_link' ) ) : 'whatsapp://send?text=' . urlencode( $page_link ); ?>" target="<?php echo esc_attr( $target ); ?>" class="whatsapp-mobile social-whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_telegram', '0') ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? ( venam_settings( 'tg_link' )) : 'https://telegram.me/share/url?url=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-telegram" data-title="telegram">
                    <i class="fab fa-telegram"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_viber', '0') && $type == 'share' && venam_settings( 'share_viber' ) ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'viber://forward?text=' . $page_link; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-viber" data-title="viber">
                    <i class="fab fa-viber"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_vk', '0') ) : ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo 'follow' === $type ? ( venam_settings( 'vk_link' )) : 'https://vk.com/share.php?url=' . $page_link . '&image=' . $thumb_url[0] . '&title=' . $page_title; ?>" target="<?php echo esc_attr( $target ); ?>" class="social-vk" data-title="vk">
                    <i class="fab fa-vk"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_snapchat', '0') && $type == 'follow' && '' != venam_settings( 'snapchat_link' ) ): ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo venam_settings( 'snapchat_link' ); ?>" target="<?php echo esc_attr( $target ); ?>" class="social-snapchat" data-title="snapchat">
                    <i class="fab fa-snapchat"></i>
                </a>
            <?php endif ?>

            <?php if ( '1' == venam_settings('share_tiktok', '0') && $type == 'follow' && '' != venam_settings( 'tiktok_link' ) ): ?>
                <a rel="noopener noreferrer nofollow" href="<?php echo venam_settings( 'tiktok_link' ); ?>" target="<?php echo esc_attr( $target ); ?>" class="social-tiktok" data-title="tiktok">
                    <i class="fab fa-tiktok"></i>
                </a>
            <?php endif ?>

        </div>

        <?php
    }

}
Venam_Elementor_Addons::instance();
