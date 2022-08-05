<?php
/**
* Main class
*
* @author Venam
* @package Venam WooCommerce Ajax Search
* @version 1.0.0
*/
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
if ( ! class_exists( 'Venam_Wc_As' ) ) {
    /**
    * Venam WooCommerce Ajax Search
    *
    * @since 1.0.0
    */
    class Venam_Wc_As {

        private static $instance = null;

        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self;
            }
            return self::$instance;
        }
        /**
        * Constructor
        *
        * @return Venam_Wc_As
        * @since 1.0.0
        */
        public function __construct() {

            if ( ! isset( $_REQUEST['action'] ) || 'venam_as_products' !== $_REQUEST['action']  ) {

                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_scripts' ) );
            }

            add_action( 'wp_ajax_venam_as_products', array( $this, 'ajax_search_products' ) );
            add_action( 'wp_ajax_nopriv_venam_as_products', array( $this, 'ajax_search_products' ) );

            // register shortcode.
            add_shortcode( 'venam_wc_ajax_search', array( $this, 'add_wc_ajax_search_shortcode' ) );

        }

        /**
        * Enqueue styles and scripts
        *
        * @access public
        * @return void
        * @since 1.0.0
        */
        public function enqueue_styles_scripts() {
            wp_register_script( 'venam-autocomplete', VENAM_PLUGIN_URL. 'widgets/woocommerce/ajax-search/css-js/venam-autocomplete.min.js','', VENAM_PLUGIN_VERSION, true );
            wp_register_script( 'venam-ajax-search', VENAM_PLUGIN_URL . 'widgets/woocommerce/ajax-search/css-js/script.js', array( 'jquery' ), VENAM_PLUGIN_VERSION, true );
            wp_localize_script( 'venam-ajax-search', 'venam_as_params', array(
                'loading' => VENAM_PLUGIN_URL . 'assets/front/img/ajax-loader.gif',
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            ));
            wp_enqueue_script( 'venam-autocomplete' );
        }

        public function add_wc_ajax_search_shortcode() {
            wp_enqueue_script( 'venam-autocomplete' );
            wp_enqueue_script( 'venam-ajax-search' );
            ob_start();
            ?>
            <div class="header-search-wrap">
                <div class="venam-asform-container">
                    <form role="search" method="get" id="venam-asform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <label class="screen-reader-text" for="venam-as"><?php esc_html_e( 'Search for:', 'venam' ); ?></label>
                        <input type="search"
                        value="<?php echo esc_attr( get_search_query() ); ?>"
                        name="s" id="venam-as"
                        class="venam-as"
                        placeholder="<?php echo esc_attr( apply_filters( 'venam_as_input_label', 'Search for...' ) ); ?>"
                        data-loader-icon="<?php echo esc_attr( str_replace( '"', '', apply_filters( 'venam_as_ajax_search_icon', '' ) ) ); ?>"
                        data-min-chars="<?php echo esc_attr( apply_filters( 'venam_as_min_chars', 1 ) ); ?>" />
                        <input type="hidden" name="post_type" value="product" />
                        <div class="search-icon"></div>
                        <?php do_action( 'wpml_add_language_form_field' ); ?>
                    </form>
                </div>
            </div>
            <?php
            return ob_get_clean();
        }

        /**
        * Get microtime.
        *
        * @return float
        */
        public function getmicrotime() {
            list( $usec, $sec ) = explode( ' ', microtime() );

            return ( (float) $usec + (float) $sec );
        }

        /**
        * Perform ajax search products
        */
        public function ajax_search_products() {
            global $woocommerce;

            $time_start         = $this->getmicrotime();
            $transient_enabled  = apply_filters( 'venam_as_enable_transient', 'no' );
            $transient_duration = apply_filters( 'venam_as_transient_duration', 12 );

            $search_keyword = sanitize_text_field( wp_unslash( $_REQUEST['query'] ) );

            $ordering_args = $woocommerce->query->get_catalog_ordering_args( 'title', 'asc' );
            $suggestions   = array();

            $transient_name = 'venamas_' . $search_keyword;
            $suggestions = get_transient( $transient_name );
            if ( 'no' === $transient_enabled || false === $suggestions ) {
                $args = array(
                    's' => apply_filters( 'venam_as_search_query', $search_keyword ),
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1,
                    'orderby' => $ordering_args['orderby'],
                    'order' => $ordering_args['order'],
                    'posts_per_page' => apply_filters( 'venam_as_posts_per_page', apply_filters( 'venam_as_posts_per_page', -1 ) ),
                    'suppress_filters' => false,
                );

                $data       = array();
                $taxonomies = array();
                $taxonomies = get_object_taxonomies( 'product', 'objects' );
                foreach ( $taxonomies as $tax_slug => $tax ) {
                    if ( ! $tax->public || ! $tax->show_ui ) {
                        continue;
                    }
                    $data[ $tax_slug ] = $tax;
                }

                if ( isset( $_REQUEST['product_cat'] ) ) {
                    $args['tax_query'] = array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => $data,
                        ),
                    );
                }

                if ( version_compare( WC()->version, '2.7.0', '<' ) ) {
                    $args['meta_query'] = array(
                        array(
                            'key' => '_visibility',
                            'value' => array( 'search', 'visible' ),
                            'compare' => 'IN',
                        ),
                    );
                } else {
                    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                    $args['tax_query'][] = array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'term_taxonomy_id',
                        'terms' => $product_visibility_term_ids['exclude-from-search'],
                        'operator' => 'NOT IN',
                    );
                }

                $products = get_posts( $args );

                if ( ! empty( $products ) ) {
                    foreach ( $products as $post ) {
                        $product = wc_get_product( $post );

                        $suggestions[] = apply_filters( 'venam_as_suggestion',
                            array(
                                'id' => $product->get_id(),
                                'value' => wp_strip_all_tags( $product->get_title() ),
                                'url' => $product->get_permalink(),
                                'img' => get_the_post_thumbnail_url( $product->get_id(), array( 50, 50 ) ),
                                'prc' => $product->get_price_html()
                            ),
                            $product
                        );
                    }
                } else {
                    $suggestions[] = array(
                        'id' => - 1,
                        'value' => __( 'No results', 'venam' ),
                        'url' => '',
                    );
                }
                wp_reset_postdata();

                if ( 'yes' === $transient_enabled ) {
                    set_transient( $transient_name, $suggestions, $transient_duration * HOUR_IN_SECONDS );
                }
            }

            $time_end    = $this->getmicrotime();
            $time        = $time_end - $time_start;
            $suggestions = array(
                'suggestions' => $suggestions,
                'time' => $time,
            );
            echo wp_json_encode( $suggestions );
            die();

        }
    }
    Venam_Wc_As::get_instance();
}
