<?php

/**
* The template for displaying 404 pages (not found)
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package WordPress
* @subpackage Venam
* @since 1.0.0
*/

    if ( '0' == venam_settings( 'error_header_visibility', '1' ) ) {
        remove_action( 'venam_header_action', 'venam_main_header', 10 );
    }
    if ( '0' == venam_settings( 'error_footer_visibility', '1' ) ) {
        remove_action( 'venam_footer_action', 'venam_footer', 10 );
    }

    get_header();

    // you can use this action for add any content before container element
    do_action( 'venam_before_404' );

    if ( 'elementor' == venam_settings( 'error_page_type', 'default' ) && !empty( venam_settings( 'error_page_elementor_templates' ) ) ) {

        echo venam_print_elementor_templates( 'error_page_elementor_templates', false );

    } else {
        ?>
        <div id="nt-404" class="nt-404 error">

            <?php venam_hero_section(); ?>

            <div class="nt-theme-inner-container error-area pt-80 pb-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-10">
                            <div class="error-content text-center">

                                <div class="error_txt"><?php esc_html_e( '404','venam' ); ?></div>

                                <h5><?php echo apply_filters('venam_error_page_description', esc_html__( 'Oops! The page you requested was not found!', 'venam' ) ); ?></h5>

                                <?php
                                if ( '0' != venam_settings('error_content_desc_visibility', '1' ) ) {
                                    if ( '' != venam_settings( 'error_content_desc' ) ) {
                                        printf( '<p class="content-text">%1$s</p>',
                                            wp_kses( venam_settings( 'error_content_desc' ), venam_allowed_html() )
                                        );
                                    } else {
                                        printf( '<p class="content-text">%1$s</p>',
                                            esc_html__( 'Sorry, but the page you are looking for does not exist or has been removed', 'venam' )
                                        );
                                    }
                                }

                                if ( '0' != venam_settings( 'error_content_form_visibility', '0' ) ) {
                                    echo venam_search_form();
                                }

                                if ( '0' != venam_settings('error_content_btn_visibility', '1' ) ) {
                                    if ( '' != venam_settings( 'error_content_btn_title' ) ) {
                                        printf( '<a href="%1$s" class="btn btn-fill-out mt-30"><span>%2$s</span></a>',
                                            esc_url( home_url('/') ),
                                            esc_html( venam_settings( 'error_content_btn_title' ) )
                                        );
                                    } else {
                                        printf( '<a href="%1$s" class="btn btn-fill-out mt-30"><span>%2$s</span></a>',
                                            esc_url( home_url('/') ),
                                            esc_html__( 'Go to home page', 'venam' )
                                        );
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // use this action to add any content after 404 page container element
    do_action( 'venam_after_404' );

    get_footer();

?>
