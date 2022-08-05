<?php
/**
* The template for displaying archive pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package WordPress
* @subpackage Venam
* @since 1.0.0
*/

    get_header();


// Elementor `archive` location
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {

    // you can use this action for add any content before container element
    do_action( 'venam_before_archive' );
    $grid_column = venam_settings( 'grid_column', '1' );
    $grid_column = have_posts() ? 'row-cols-lg-'.esc_attr( $grid_column ).' row-cols-sm-1' : 'justify-content-center';
    $archive_layout = venam_settings( 'archive_layout', 'full-width' );
    $archive_sidebar = is_active_sidebar( 'venam-archive-sidebar' );

    ?>

    <!-- archive page general div -->
    <div id="nt-archive" class="nt-archive" >

        <?php venam_hero_section(); ?>

        <div class="nt-theme-inner-container section-padding">
            <div class="container">
                <div class="row justify-content-center">

                    <!-- Left sidebar -->
                    <?php if ( $archive_sidebar && 'left-sidebar' == $archive_layout ) { ?>
                        <div id="nt-sidebar" class="nt-sidebar col-12 col-xl-4">
                            <div class="blog-sidebar nt-sidebar-inner">
                                <?php dynamic_sidebar( 'venam-archive-sidebar' ); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Content Column-->
                    <div class="col-12 col-xl-8">
                        <div class="row <?php echo esc_attr( $grid_column ); ?>">

                            <?php
                            if ( have_posts() ) {
                                while ( have_posts() ) : the_post();

                                    venam_post_style_one();

                                endwhile;

                                // this function working with wp reading settins + posts
                                venam_index_loop_pagination();

                            } else {
                                // if there are no posts, read content none function
                                venam_content_none();
                            }
                            ?>
                        </div>
                    </div>
                    <!-- End content -->

                    <!-- Right sidebar -->
                    <?php if ( $archive_sidebar && 'right-sidebar' == $archive_layout ) { ?>
                        <div id="nt-sidebar" class="nt-sidebar col-12 col-xl-4">
                            <div class="blog-sidebar nt-sidebar-inner">
                                <?php dynamic_sidebar( 'venam-archive-sidebar' ); ?>
                            </div>
                        </div>
                    <?php } ?>

                </div><!-- End row -->
            </div><!-- End container -->
        </div><!-- End #blog-post -->
    </div>
    <!-- End archive page general div-->
    <?php

    do_action( 'venam_after_archive' );

}

get_footer();
?>
