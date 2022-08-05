<?php


add_action( 'venam_single_post', 'venam_single_post_thumbnail', 5 );
add_action( 'venam_single_post', 'venam_single_post_meta_date', 10 );
add_action( 'venam_single_post', 'venam_single_post_content', 15 );
add_action( 'venam_single_post', 'venam_post_category', 20 );
add_action( 'venam_single_post', 'venam_single_bottom_meta', 30 );

add_action( 'venam_after_single_post', 'venam_single_navigation', 5 );
add_action( 'venam_after_single_post', 'venam_single_post_author_box', 10 );

add_action( 'venam_single_post_comment', 'venam_single_post_comment_template' );
add_action( 'venam_single_related', 'venam_single_post_related' );

add_action( 'venam_single', 'venam_single_layout' );

if ( ! function_exists( 'venam_single_layout' ) ) {

    function venam_single_layout()
    {
        $venam_layout  = venam_settings( 'single_layout', 'full-width' );
        $venam_sidebar = venam_sidebar( 'venam-single-sidebar', 'sidebar-1' );
        $venam_column  = ! empty( venam_settings( 'blog_sidebar_templates', null ) ) || $venam_sidebar ? 'col-lg-8' : 'col-lg-10';
        $row_reverse   = ( ! empty( venam_settings( 'blog_sidebar_templates', null ) ) || $venam_sidebar ) && 'left-sidebar' == $venam_layout ? ' flex-lg-row-reverse' : '';

        ?>
        <!-- Single page general div -->
        <div id="nt-single" class="nt-single">

            <?php
            if ( class_exists( '\Elementor\Frontend' ) && !empty( venam_settings( 'single_hero_elementor_templates', null ) ) ) {

                $template_id = apply_filters( 'venam_translated_template_id', intval( venam_settings( 'single_hero_elementor_templates' ) ) );
                printf( '<div class="custom-single-hero single-template-'.$template_id.'">%1$s</div>', $frontend->get_builder_content( $template_id, false ) );

            } else {

                venam_hero_section();

            }
            ?>

            <div class="blog-details-area section-padding">
                <div class="container">

                    <div class="row justify-content-center<?php echo esc_attr( $row_reverse ); ?>">

                        <div class="<?php echo esc_attr( $venam_column ); ?>">
                            <div <?php echo post_class( 'blog-post-item s-blog-post-item blog-details-wrap', get_the_ID() ); ?>>
                                <div class="nt-theme-content">
                                    <?php

                                    while ( have_posts() ) : the_post();
                                    /**
                                    * Hook: venam_single_post.
                                    *
                                    * @hooked venam_single_post_thumbnail', 5 );
                                    * @hooked venam_single_post_meta_date', 10 );
                                    * @hooked venam_single_post_content', 15 );
                                    * @hooked venam_single_post_category', 20 );
                                    * @hooked venam_single_bottom_meta', 25 );
                                    */
                                    do_action( 'venam_single_post' );

                                    endwhile;
                                    /**
                                    * Hook: venam_after_single_post.
                                    *
                                    * @hooked venam_single_post_author_box', 5 );
                                    * @hooked venam_single_navigation', 10 );
                                    */
                                    do_action( 'venam_after_single_post' );

                                    ?>
                                </div>
                                <?php do_action( 'venam_single_post_comment' ); ?>
                            </div>

                        </div>

                        <?php
                        if ( 'full-width' != $venam_layout ) {
                            if ( ! empty( venam_settings( 'blog_sidebar_templates', null ) ) ) {

                                get_sidebar();

                            } elseif ( $venam_sidebar ) {
                                ?>
                                <div id="nt-sidebar" class="col-lg-4 col-md-8">
                                    <div class="blog-sidebar nt-sidebar-inner">

                                        <?php dynamic_sidebar( $venam_sidebar ); ?>

                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

        <?php
        do_action( 'venam_single_related' );
    }
}

if ( ! function_exists( 'venam_single_post_content' ) ) {

    function venam_single_post_content()
    {
        $content = get_the_content();
        if ( '' != $content ) {

            the_content();
            venam_wp_link_pages();
        }
    }
}

if ( ! function_exists( 'venam_single_bottom_meta' ) ) {

    function venam_single_bottom_meta()
    {
        if ( has_tag() || has_action('venam_post_share') ) {
        ?>
        <div class="s-blog-post-bottom">
            <div class="blog-bottom-meta">
                <ul>
                    <?php venam_single_post_tags(); ?>
                </ul>
            </div>
            <div class="classic-blog-share">
                <?php do_action( 'venam_post_share' ); ?>
            </div>
        </div>
        <?php
        }
    }
}

if ( ! function_exists( 'venam_single_post_comment_template' ) ) {

    function venam_single_post_comment_template()
    {
        if ( comments_open() || '0' != get_comments_number() ) {
            ?>
            <div class="blog-comments">
                <?php echo comments_template(); ?>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'venam_single_post_tags' ) ) {

    function venam_single_post_tags()
    {
        if ( '0' != venam_settings('single_postmeta_tags_visibility', '1' ) && has_tag() ) {
            ?>
            <li>
                <i class="fas fa-tag"></i>
                <?php the_tags( '', ', ', '' ); ?>
            </li>
            <?php
        }
    }
}


if ( ! function_exists( 'venam_single_post_meta_date' ) ) {

    function venam_single_post_meta_date()
    {
        if ( get_the_date() && '0' != venam_settings( 'single_postmeta_date_visibility', '1' ) ) {
            $archive_year = get_the_time( 'Y' );
            $archive_month = get_the_time( 'm' );
            $archive_day = get_the_time( 'd' );
            ?>
            <div class="blog-post-meta">
                <div><i class="far fa-calendar-alt"></i> <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></div>
            </div>

            <?php
        }
    }
}

if ( ! function_exists( 'venam_post_meta_author' ) ) {

    function venam_single_post_meta_author()
    {
        global $post;
        $author_id = $post->post_author;
        $author_link = get_author_posts_url( $author_id );
        if ( '0' != venam_settings( 'single_postmeta_author_visibility', '1' ) ) {
        ?>
        <a href="<?php echo esc_url( $author_link ); ?>"><i class="far fa-user-circle"></i> <?php the_author_meta( 'display_name', $post->post_author ); ?></a>
        <?php
        }
    }
}

if ( ! function_exists( 'venam_single_post_meta_comment_number' ) ) {

    function venam_single_post_meta_comment_number()
    {
        if ( comments_open() && '0' != get_comments_number() && '0' != venam_settings( 'single_postmeta_comments_visibility', '1' ) ) {

            ?>
            <li><i class="far fa-comments"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'venam' ), number_format_i18n( get_comments_number() ) ); ?></a></li>
            <?php
        }
    }
}

/*************************************************
##  POST FORMAT
*************************************************/

if ( ! function_exists( 'venam_single_post_thumbnail' ) ) {

    function venam_single_post_thumbnail()
    {
        if ( has_post_thumbnail() ) {
            ?>
            <div class="blog-thumb mb-25">
                <?php the_post_thumbnail( 'venam-single', array( 'class'=>'img-fluid' ) ); ?>
            </div>
            <?php
        }
    }
}

/*************************************************
## SINGLE POST AUTHOR BOX FUNCTION
*************************************************/

if (! function_exists('venam_single_post_author_box')) {

    function venam_single_post_author_box()
    {
        global $post;
        if ('0' != venam_settings('single_post_author_box_visibility', '1')) {
            // Get author's display name
            $display_name = get_the_author_meta('display_name', $post->post_author);
            // If display name is not available then use nickname as display name
            $display_name = empty($display_name) ? get_the_author_meta('nickname', $post->post_author) : $display_name ;
            // Get author's biographical information or description
            $user_description = get_the_author_meta('user_description', $post->post_author);
            // Get author's website URL
            $user_website = get_the_author_meta('url', $post->post_author);
            // Get link to the author archive page
            $user_posts = get_author_posts_url(get_the_author_meta('ID', $post->post_author));
            // Get the rest of the author links. These are stored in the
            // wp_usermeta table by the key assigned in wpse_user_contactmethods()
            $author_facebook  = get_the_author_meta('facebook', $post->post_author);
            $author_twitter   = get_the_author_meta('twitter', $post->post_author);
            $author_instagram = get_the_author_meta('instagram', $post->post_author);
            $author_linkedin  = get_the_author_meta('linkedin', $post->post_author);
            $author_youtube   = get_the_author_meta('youtube', $post->post_author);

            if ('' != $user_description) {
                ?>
                <div class="avatar-post mt-50 mb-50">

                    <div class="post-avatar-img">
                        <?php
                        if ( function_exists( 'get_avatar' ) ) {
                            echo get_avatar( get_the_author_meta( 'email' ), '150');
                        }
                        ?>
                    </div>

                    <div class="post-avatar-content">

                        <h5><?php echo esc_html( $display_name ); ?></h5>
                        <p class="mb-0"><?php echo esc_html($user_description); ?></p>

                        <div class="post-avatar-social mt-20">
                            <ul>
                                <?php if ('' != $author_facebook) { ?>
                                    <li><a href="<?php echo esc_url($author_facebook); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <?php } ?>
                                <?php if ('' != $author_twitter) { ?>
                                    <li><a href="<?php echo esc_url($author_twitter); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <?php } ?>
                                <?php if ('' != $author_instagram) { ?>
                                    <li><a href="<?php echo esc_url($author_instagram); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <?php } ?>
                                <?php if ('' != $author_linkedin) { ?>
                                    <li><a href="<?php echo esc_url($author_linkedin); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                <?php } ?>
                                <?php if ('' != $author_youtube) { ?>
                                    <li><a href="<?php echo esc_url($author_youtube); ?>" target="_blank"><i class="ifab fa-youtube"></i></a></li>
                                <?php } ?>

                            </ul>
                        </div>

                    </div>

                </div>
                <?php
            }
        }
    }
}

/*************************************************
## SINGLE POST RELATED POSTS
*************************************************/

if ( ! function_exists( 'venam_single_post_related' ) ) {

    function venam_single_post_related()
    {
        global $post;
        $venam_post_type = get_post_type( $post->ID );

        if ( '0' != venam_settings( 'single_related_visibility', '0' ) ) {
            $sattr = array();
            $speed = venam_settings( 'related_speed', 1000 );
            $perview = venam_settings( 'related_perview', 4 );
            $mdperview = venam_settings( 'related_mdperview', 3 );
            $smperview = venam_settings( 'related_smperview', 2 );
            $xsperview = venam_settings( 'related_xsperview', 1 );
            $gap = venam_settings( 'related_gap', 30 );
            $centered = '1' == venam_settings( 'related_centered', 1 ) ? 'true' : 'false';
            $loop = '1' == venam_settings( 'related_loop', 0 ) ? 'true' : 'false';
            $autoplay = '1' == venam_settings( 'related_autoplay', 1 ) ? 'true' : 'false';
            $mousewheel = '1' == venam_settings( 'related_mousewheel', 0 ) ? 'true' : 'false';

            $imgsize = venam_settings( 'related_imgsize', 'venam-square' );
            $imgsize2 = venam_settings( 'related_custom_imgsize' );
            $imgsize = '' == $imgsize && !empty( $imgsize2 ) ? array($imgsize2['width'],$imgsize2['height'] ) : $imgsize;
            $ttag = venam_settings( 'related_title_tag', 'h3' );
            $subtag = venam_settings( 'related_subtitle_tag', 'p' );

            $cats = get_the_category( $post->ID );
            $args = array(
                'post__not_in' => array( $post->ID ),
                'posts_per_page' => venam_settings( 'related_perpage', 6 )
            );

            $related_query = new WP_Query( $args );

            if ( $related_query->have_posts() ) {
                wp_enqueue_style( 'swiper' );
                wp_enqueue_script( 'swiper' );
                ?>

                <div class="nt-related-post projects-one theme-bg section-padding">
                    <?php if ( '' != venam_settings( 'related_subtitle' ) || '' != venam_settings( 'related_title' ) ) { ?>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="section-title text-center mb-70">
                                        <?php if ( '' != venam_settings( 'related_subtitle' ) ) { ?>
                                            <<?php echo esc_attr( $subtag ); ?> class="sub-title"><?php echo esc_html( venam_settings( 'related_subtitle' ) ); ?></<?php echo esc_attr( $subtag ); ?>>
                                        <?php } ?>
                                        <?php if ( '' != venam_settings( 'related_title' ) ) { ?>
                                            <<?php echo esc_attr( $ttag ); ?> class="title"><?php echo esc_html( venam_settings( 'related_title' ) ); ?></<?php echo esc_attr( $ttag ); ?>>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="related-slider ptb-0">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="swiper-container thm-swiper__slider" data-swiper-options=<?php echo '\'{"speed": '.$speed.',"centered": '.$centered.',"loop": '.$loop.',"autoplay": '.$autoplay.',"mousewheel": '.$mousewheel.',"slidesPerView": '.$perview.',"spaceBetween": '.$gap.',"breakpoints": {"320": {"slidesPerView": '.$xsperview.'},"768": {"slidesPerView": '.$smperview.'},"1024": {"slidesPerView": '.$mdperview.'},"1200": {"slidesPerView": '.$perview.'}}}\''; ?>>
                                        <div class="swiper-wrapper">
                                            <?php
                                            while ( $related_query->have_posts() ) {
                                                $related_query->the_post();
                                                ?>
                                                <div class="swiper-slide">
                                                    <?php venam_post_style_one(); ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
            }
        }
    }
}
