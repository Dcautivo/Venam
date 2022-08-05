<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package WordPress
* @subpackage Venam
* @since 1.0.0
*/

get_header();

do_action( 'venam_before_index' );

$venam_layout    = venam_settings( 'index_layout', 'right-sidebar' );
$grid_column     = apply_filters('venam_blog_grid_column', venam_settings( 'grid_column', '1' ) );
$container_width = 'wide' == venam_get_option() ? 'container-fluid' : venam_settings( 'index_container_type', 'container' );
$masonry         = 'masonry' == venam_get_option() ? ' nt-masonry-container' : '';
$has_sidebar     = ! empty( venam_settings( 'blog_sidebar_templates', null ) ) || is_active_sidebar( 'sidebar-1' ) ? true : false;
$layout_column   = !$has_sidebar || 'full-width' == $venam_layout ? 'col-lg-10' : 'col-lg-8';
$row_reverse     = (! empty( venam_settings( 'blog_sidebar_templates', null ) ) || is_active_sidebar( 'sidebar-1' ) ) && 'left-sidebar' == $venam_layout ? ' flex-lg-row-reverse' : '';

?>
<div id="nt-index" class="nt-index">

    <?php
    // Hero section - this function using on all inner pages -->
    if ( !empty( venam_settings( 'blog_hero_templates', null ) ) ) {

        echo venam_print_elementor_templates( 'blog_hero_templates', 'custom-blog-hero' );

    } else {

        venam_hero_section();

    }
    ?>

    <div class="nt-theme-inner-container blog-area section-padding">
        <div class="<?php echo esc_attr( $container_width ); ?>">
            <div class="row justify-content-center<?php echo esc_attr( $row_reverse ); ?>">

                <!-- Sidebar column control -->
                <div class="<?php echo esc_attr( $layout_column ); ?>">
                    <div class="row row-cols-lg-<?php echo esc_attr( $grid_column.$masonry ); ?> row-cols-sm-1 nmb-30">
                        <?php
                        if ( have_posts() ) {

                            while ( have_posts() ) : the_post();

                                // if there are posts, run venam_post_style_one function
                                // contain supported post formats from theme
                                venam_post_style_one();

                            endwhile;

                        } else {

                            // if there are no posts, read content none function
                            venam_content_none();

                        }
                        ?>
                    </div>
                    <?php
                    if ( have_posts() ) {
                        echo '<div class="row">';
                            // this function working with wp reading settins + posts
                            venam_index_loop_pagination();
                        echo '</div>';
                    }
                    ?>
                </div>
                <!-- End content column -->

                <!-- right sidebar -->
                <?php
                if ( $has_sidebar && 'right-sidebar' == $venam_layout ) {
                    get_sidebar();
                }
                ?>
                <!-- End right sidebar -->

            </div><!--End row -->
        </div><!--End container -->
    </div><!--End #blog -->
</div><!--End index general div -->

<?php

// you can use this action to add any content after index page
do_action( 'venam_after_index' );

get_footer();

?>
