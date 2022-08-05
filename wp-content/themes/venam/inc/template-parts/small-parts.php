<?php


/**
 * Custom template parts for this theme.
 *
 * preloader, backtotop, conten-none
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package venam
*/


/*************************************************
## START PRELOADER
*************************************************/

if ( ! function_exists( 'venam_preloader' ) ) {
    function venam_preloader()
    {
        $type = venam_settings('pre_type', 'default');

        if ( '0' != venam_settings('preloader_visibility', '1') ) {

            if ( 'default' == $type && '' != venam_settings( 'pre_img', '' ) ) {
                ?>
                <div class="preloader">
                    <img class="preloader__image" width="55" src="<?php echo esc_url( venam_settings( 'pre_img' )[ 'url' ] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                </div>
                <?php
            } else {
                ?>
                <div id="nt-preloader" class="preloader">
                    <div class="loader<?php echo esc_attr( $type );?>"></div>
                </div>
                <?php
            }
        }
    }
}
add_action( 'venam_after_body_open', 'venam_preloader', 10 );
add_action( 'elementor/page_templates/canvas/before_content', 'venam_preloader', 10 );

/*************************************************
##  BACKTOP
*************************************************/

if ( ! function_exists( 'venam_backtop' ) ) {
    add_action( 'venam_after_main_footer', 'venam_backtop', 10 );
    function venam_backtop() {
        if ( '1' == venam_settings('backtotop_visibility', '1') ) { ?>
            <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>
            <?php
        }
    }
}


/*************************************************
##  CONTENT NONE
*************************************************/

if ( ! function_exists( 'venam_content_none' ) ) {
    function venam_content_none() {
        $venam_centered = is_search() && 'full-width' == venam_settings( 'search_layout') ? ' text-center' : '';
        ?>

        <div class="col-12">
            <div class="content-none-container text-center">
                <h3 class="__title mb-20"><?php esc_html_e( 'Nothing Found', 'venam' ); ?></h3>
                <?php
                if ( is_home() && current_user_can( 'publish_posts' ) ) :

                    printf( '<p>%s</p> <a class="venam-btn thm-btn" href="%s">%s</a>',
                    esc_html__( 'Ready to publish your first post?', 'venam' ),
                    esc_url( admin_url( 'post-new.php' ) ),
                    esc_html__( 'Get started here', 'venam' )
                );
                elseif ( is_search() ) :
                    ?>
                    <p class="__nothing"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'venam' ); ?></p>
                    <?php
                    printf( '<a href="%1$s" class="btn btn-fill-out theme-primary-background mt-30"><span>%2$s</span></a>',
                        esc_url( home_url('/') ),
                        esc_html__( 'Go to home page', 'venam' )
                    );
                    ?>
                <?php else : ?>
                    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'venam' ); ?></p>
                <?php
                printf( '<a href="%1$s" class="btn btn-fill-out theme-primary-background"><span>%2$s</span></a>',
                    esc_url( home_url('/') ),
                    esc_html__( 'Go to home page', 'venam' )
                );
                ?>

                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
