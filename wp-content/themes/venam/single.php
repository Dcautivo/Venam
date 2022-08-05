<?php

/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package WordPress
* @subpackage Venam
* @since 1.0.0
*/

if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
    
    $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
    $hide_header = $page_settings->get_settings( 'venam_elementor_hide_page_header' );
    $hide_footer = $page_settings->get_settings( 'venam_elementor_hide_page_footer' );
    
    if ( 'yes' == $hide_header ) {
        remove_action( 'venam_header_action', 'venam_main_header', 10 );
    }
    if ( 'yes' == $hide_footer ) {
        remove_action( 'venam_footer_action', 'venam_footer', 10 );
    }
}

get_header();

// Elementor `single` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

    // you can use this action to add any content before single page
    do_action( 'venam_before_post_single' );

    if ( venam_check_is_elementor() ) {

        while ( have_posts() ) {

            the_post();

            the_content();

        }

    } else {
        
        /**
        * Hook: venam_single.
        *
        * @hooked venam_single_layout
        */
        do_action( 'venam_single' );
    }

    // you can use this action to add any content after single page
    do_action( 'venam_after_post_single' );
}

get_footer();
?>
