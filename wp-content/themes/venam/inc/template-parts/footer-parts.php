<?php

/**
* Custom template parts for this theme.
*
* Eventually, some of the functionality here could be replaced by core features.
*
* @package venam
*/


add_action( 'venam_footer_action', 'venam_footer', 10 );

if ( ! function_exists( 'venam_footer' ) ) {
    function venam_footer()
    {

        $footer_id = false;

        if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {

            $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
            $page_footer_id = $page_settings->get_settings( 'venam_page_footer_template' );
            $footer_id = isset( $page_footer_id ) !== '' ? $page_footer_id : $footer_id;
        }

        if ( '0' != venam_settings( 'footer_visibility', '1' ) ) {

            if ( class_exists( '\Elementor\Frontend' ) && 'elementor' == venam_settings( 'footer_template', 'default' ) ) {

                if ( $footer_id ) {
                    $frontend = new \Elementor\Frontend;
                    printf( '<footer class="venam-elementor-footer footer-'.$footer_id.'">%1$s</footer>', $frontend->get_builder_content( $footer_id, false ) );

                } else {

                    echo venam_print_elementor_templates( 'footer_elementor_templates', 'venam-elementor-footer' );
                }

            } else {

                venam_copyright();

            }
        }
    }
}

/*************************************************
##  FOOTER COPYRIGHT
*************************************************/

if ( ! function_exists( 'venam_copyright' ) ) {
    function venam_copyright()
    {
        ?>
        <footer id="nt-footer" class="footer-area footer-style-two thm-default__copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="copyright-text">
                            <?php
                            if ( '' != venam_settings( 'footer_copyright' ) ) {

                                echo wp_kses( venam_settings( 'footer_copyright' ), venam_allowed_html() );

                            } else {
                                echo sprintf( '<p class="text-center">Copyright &copy; %1$s, <a class="theme" href="%2$s">%3$s</a> Theme. %4$s <a class="dev" href="https://ninetheme.com/contact/"> %5$s</a></p>',
                                    date_i18n( _x( 'Y', 'copyright date format', 'venam' ) ),
                                    esc_url( home_url( '/' ) ),
                                    get_bloginfo( 'name' ),
                                    esc_html__( 'Made with passion by', 'venam' ),
                                    esc_html__( 'Ninetheme.', 'venam' )
                                );
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }
}
