<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <!-- Meta UTF8 charset -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />
    <meta name="theme-color" content="#056EB9" />
    <meta name="msapplication-navbutton-color" content="#056EB9" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#056EB9" />
    <?php wp_head(); ?>

</head>

<!-- BODY START -->
<body <?php body_class(); ?>>

    <?php

    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }
    /**
    * Hook: venam_after_body_open
    *
    * @hooked venam_preloader - 10
    */
    do_action( 'venam_after_body_open' );


    // Elementor `header` location
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {

        /**
        * Hook: venam_header_action
        *
        * @hooked venam_preloader - 10
        */
        do_action( 'venam_header_action' );

    }
    ?>
    <main class="page-wrapper">
