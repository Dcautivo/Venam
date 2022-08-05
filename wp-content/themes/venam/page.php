<?php

/**
* default page template
*/
    // on-off header function
    venam_page_header_footer_manager();

    get_header();

    if ( venam_check_is_elementor() ) {

        while ( have_posts() )
        {

            the_post();

            the_content();

        }

    } else {

        get_template_part( 'page', 'content' );

    }

    get_footer();
