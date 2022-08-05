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

    remove_action( 'venam_header_action', 'venam_main_header', 10 );
    remove_action( 'venam_footer_action', 'venam_footer', 10 );

    get_header();

    while ( have_posts() ) : the_post();
        the_content();
    endwhile;

    get_footer();
?>
