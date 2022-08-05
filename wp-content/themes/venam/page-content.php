<?php

$page_sidebar = venam_sidebar( 'venam-page-sidebar' );
$page_layout  = venam_settings( 'page_layout', 'full-width' );
$page_column  = $page_sidebar ? 'col-lg-8' : 'col-lg-10';
$page_column  = class_exists( 'WooCommerce' ) && ( is_shop() || is_checkout() || is_cart() ) ? 'col-lg-12' : $page_column;

?>
<div id="nt-page-container" class="nt-page-layout">
    
    <?php venam_hero_section(); ?>

    <div id="nt-page" class="nt-theme-inner-container section-padding">
        <div class="container">
            <div class="row justify-content-center">

                <?php if ( $page_sidebar && 'left-sidebar' == $page_layout ) { ?>
                    <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4">
                        <div class="blog-sidebar nt-sidebar-inner">
                            <?php dynamic_sidebar( $page_sidebar ); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="<?php echo esc_attr( $page_column ); ?>">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="nt-theme-content nt-clearfix content-container">
                                <?php

                                /* translators: %s: Name of current post */
                                the_content( sprintf(
                                    esc_html__( 'Continue reading %s', 'venam' ),
                                    the_title( '<span class="screen-reader-text">', '</span>', false )
                                ) );

                                /* theme page link pagination */
                                venam_wp_link_pages();

                                ?>
                            </div>
                        </div>
                        <?php

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }

                    // End the loop.
                    endwhile;
                    ?>
                </div>

                <?php if ( $page_sidebar && 'right-sidebar' == $page_layout ) { ?>
                    <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4">
                        <div class="blog-sidebar nt-sidebar-inner">
                            <?php dynamic_sidebar( $page_sidebar ); ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
