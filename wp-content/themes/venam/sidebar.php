<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Venam
 * @since Venam 1.0
 */

if ( class_exists('\Elementor\Frontend' ) && ! empty( venam_settings( 'blog_sidebar_templates' ) ) ) {

    $template_id = apply_filters( 'venam_translated_template_id', intval( venam_settings( 'blog_sidebar_templates' ) ) );
    $frontend = new \Elementor\Frontend;
    printf('<div class="col-lg-4 col-md-8"><div class="blog-sidebar nt-sidebar-elementor">%1$s</div></div>', $frontend->get_builder_content( $template_id, false ) );

} else {

    if ( is_active_sidebar( 'sidebar-1' ) ) {
        ?>
        <div id="nt-sidebar" class="nt-sidebar col-lg-3 col-md-8">
            <div class="blog-sidebar nt-sidebar-inner">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div>
        </div>
        <?php
    }
}
?>
