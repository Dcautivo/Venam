<?php

/*************************************************
## THEME DEFAULT HERO TEMPLATE
*************************************************/
if ( ! function_exists( 'venam_hero_section' ) ) {

    function venam_hero_section()
    {
        $h_t = get_the_title();
        $page_id = '';

        if ( is_404() ) {

            $name = 'error';
            $h_t = esc_html__( 'Page Not Found', 'venam' );

        } elseif ( is_archive() ) {

            $name = 'archive';
            $h_t = get_the_archive_title();

        } elseif ( is_search() ) {

            $name = 'search';
            $h_t = esc_html__( 'Search results for :', 'venam' );

        } elseif ( is_home() || is_front_page() ) {

            $name = 'blog';
            $h_t = esc_html__( 'Blog', 'venam' );

        } elseif ( is_single() ) {

            $name = 'single';
            $h_t = get_the_title();

        } elseif ( is_page() ) {

            $name = 'page';
            $h_t = get_the_title();
            $page_id = 'page-'.get_the_ID();

        }

        do_action( 'venam_before_page_hero' );

        if ( '0' != venam_settings( $name.'_hero_visibility', '1' ) ) {
            ?>
            <div class="breadcrumb-area breadcrumb-bg <?php echo esc_attr( $page_id ); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-content text-center">
                                <?php

                                do_action( 'venam_before_page_title' );

                                if ( $h_t ) {

                                    printf( '<h1 class="nt-hero-title page-title mb-30">%s %s</h1>',
                                        wp_kses( $h_t, venam_allowed_html() ),
                                        strlen( get_search_query() ) > 16 ? substr( get_search_query(), 0, 16 ).'...' : get_search_query()
                                    );

                                } else {

                                    the_title('<h2 class="nt-hero-title page-title mb-10">', '</h2>');
                                }

                                do_action( 'venam_after_page_title' );

                                echo venam_breadcrumbs();

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        do_action( 'venam_after_page_hero' );
    }
}
