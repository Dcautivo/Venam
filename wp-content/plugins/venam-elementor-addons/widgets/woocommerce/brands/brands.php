<?php
/**
* Taxonomy: Venam Brands.
*/
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
if ( ! class_exists( 'Venam_Product_Brand' ) ) {
    class Venam_Product_Brand {
        private static $instance = null;
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self;
            }
            return self::$instance;
        }
        public function __construct() {
            add_action( 'init', array( $this, 'register_taxes' ) );
            // Set Brand taxonomy term when you duplicate the product
            add_action( 'woocommerce_product_duplicate', array( $this, 'woocommerce_product_duplicate' ), 10, 2 );
        }
        public function register_taxes() {
            $labels = [
                "name" => __( "Brands", "venam" ),
                "singular_name" => __( "Brand", "venam" ),
                "menu_name" => __( "Brands", "venam" ),
                "all_items" => __( "All Brands", "venam" ),
                "edit_item" => __( "Edit Brand", "venam" ),
                "view_item" => __( "View Brand", "venam" ),
                "update_item" => __( "Update Brand name", "venam" ),
                "add_new_item" => __( "Add new Brand", "venam" ),
                "new_item_name" => __( "New brand name", "venam" ),
                "parent_item" => __( "Parent Brand", "venam" ),
                "parent_item_colon" => __( "Parent Brand:", "venam" ),
                "search_items" => __( "Search Brands", "venam" ),
                "popular_items" => __( "Popular Brands", "venam" ),
                "separate_items_with_commas" => __( "Separate brand with commas", "venam" ),
                "add_or_remove_items" => __( "Add or remove brand", "venam" ),
                "choose_from_most_used" => __( "Choose from the most used brand", "venam" ),
                "not_found" => __( "No brand found", "venam" ),
                "no_terms" => __( "No brand", "venam" ),
                "items_list_navigation" => __( "Brands list navigation", "venam" ),
                "items_list" => __( "Brands list", "venam" )
            ];
            $args = [
                "label" => __( "Venam Brands", "venam" ),
                "labels" => $labels,
                "public" => true,
                "publicly_queryable" => true,
                "hierarchical" => true,
                "show_ui" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "query_var" => true,
                "rewrite" => array(
                    'slug' => 'product-brands',
                    'with_front' => true,
                    'hierarchical' => true
                ),
                "show_admin_column" => true,
                "show_in_quick_edit" => true,
                'capabilities' => array(
                    'manage_terms' => 'manage_product_terms',
                    'edit_terms' => 'edit_product_terms',
                    'delete_terms' => 'delete_product_terms',
                    'assign_terms' => 'assign_product_terms',
                )
            ];
            register_taxonomy( "venam_product_brands", "product", $args );
            register_taxonomy_for_object_type( "venam_product_brands", "product" );
        }
        /**
        * Set brands for duplicated product
        *
        * @param $duplicate
        * @param $product
        */
        public function woocommerce_product_duplicate( $duplicate, $product ) {
            $brands     = wp_get_object_terms( $product->get_id(), "venam_product_brands" );
            $brands_ids = array();
            if ( count( $brands ) > 0 ) {
                foreach ( $brands as $brand ) {
                    $brands_ids[] = $brand->term_id;
                }
                wp_set_object_terms( $duplicate->get_id(), $brands_ids, "venam_product_brands" );
            }
        }
    }
    Venam_Product_Brand::get_instance();
}
