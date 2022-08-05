<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the #content div and all content after
*
* @package venam
*/
?>

        </main>

        <?php
        do_action( 'venam_before_main_footer' );

        // Elementor `footer` location
        if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
            /**
            * Hook: venam_footer_action.
            *
            * @hooked venam_copyright
            */
            do_action( 'venam_footer_action' );
        }

        do_action( 'venam_after_main_footer' );

        do_action( 'venam_before_wp_footer' );

        wp_footer();

        ?>
    </body>
</html>
