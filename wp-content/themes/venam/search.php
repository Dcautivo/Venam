<?php
/**
* The template for displaying search results pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
*
* @package WordPress
* @subpackage Venam
* @since 1.0.0
*/

    get_header();

    // you can use this action for add any content before container element
    do_action( 'venam_before_search' );
    $grid_column = apply_filters('venam_blog_grid_column', venam_settings( 'grid_column', '1' ) );
    $grid_column = have_posts() ? 'row-cols-lg-'.esc_attr( $grid_column ).' row-cols-sm-1 nmb-30' : 'justify-content-center';
    $search_layout = venam_settings( 'search_layout', 'full-width' );
    $search_sidebar = is_active_sidebar( 'venam-search-sidebar' );

    ?>
    <!-- search page general div -->
    <div id="nt-search" class="nt-search">

        <?php venam_hero_section(); ?>

        <div class="nt-theme-inner-container section-padding">
            <div class="container">
                <div class="row justify-content-center">

                    <!-- Left sidebar -->
                    <?php if ( $search_sidebar && 'left-sidebar' == $search_layout ) { ?>
                        <div id="nt-sidebar" class="nt-sidebar col-12 col-xl-4">
                            <div class="blog-sidebar nt-sidebar-inner">
                                <?php dynamic_sidebar( 'venam-search-sidebar' ); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Content Column-->
                    <div class="col-12 col-xl-10">
                        <div class="row row-cols-lg-<?php echo esc_attr( $grid_column ); ?>">
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
                    <?php if ( $search_sidebar && 'right-sidebar' == $search_layout ) { ?>
                        <div id="nt-sidebar" class="nt-sidebar col-12 col-xl-4">
                            <div class="blog-sidebar nt-sidebar-inner">
                                <?php dynamic_sidebar( 'venam-search-sidebar' ); ?>
                            </div>
                        </div>
                    <?php } ?>

                </div><!-- End row -->
            </div><!-- End container -->
        </div><!-- End #blog-post -->
    </div>
    <!--End search page general div -->

<?php
    // you can use this action to add any content after search page
    do_action( 'venam_after_search' );

    get_footer();
?>
