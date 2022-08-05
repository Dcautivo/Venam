<?php


if ( ! function_exists( 'venam_post_style_one' ) ) {

    function venam_post_style_one()
    {
        ?>
        <div id="post-<?php echo get_the_ID(); ?>" <?php echo post_class( 'blog-post-item col' ); ?>>
            <div class="s-blog-post-item">
                <?php venam_post_thumbnail(); ?>
                <?php venam_sticky_post(); ?>
                <div class="blog-post-content">
                    <?php venam_post_title(); ?>
                    <?php venam_post_content(); ?>
                    <?php venam_post_button(); ?>
                </div>
            </div>
        </div>
        <?php
    }
}


if ( ! function_exists( 'venam_post_style_two' ) ) {

    function venam_post_style_two()
    {
        ?>
        <div id="post-<?php echo get_the_ID(); ?>" <?php echo post_class( 'blog-post-item s-blog-post-item classic-blog-post' ); ?>>
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="blog-thumb">
                    <?php venam_sticky_post(); ?>
                    <?php venam_post_thumbnail(); ?>
                </div>
            <?php } ?>
            <div class="blog-post-content">
                <?php venam_post_category(); ?>
                <?php venam_post_title(); ?>
                <?php venam_post_meta(true,false,true); ?>
                <?php venam_post_content(); ?>
                <div class="s-blog-post-bottom">
                    <?php venam_post_button('<i class="fas fa-plus"></i>'); ?>
                    <?php do_action( 'venam_post_share' ); ?>
                </div>
            </div>
        </div>
        <?php
    }
}


if ( ! function_exists('venam_post_thumbnail')) {

    function venam_post_thumbnail()
    {
        if ( has_post_thumbnail() ) {
            $size = is_single() && venam_settings( 'related_imgsize', '' ) ? venam_settings( 'related_imgsize', '' ) : venam_settings( 'post_imgsize', 'venam-grid' );
            printf( '<a class="blog-thumb" href="%s" title="%s">%s</a>',
                esc_url( get_permalink() ),
                the_title_attribute( 'echo=0' ),
                get_the_post_thumbnail( get_the_ID(), $size )
            );
        }
    }
}


if ( ! function_exists( 'venam_post_title' ) ) {

    function venam_post_title()
    {
        if ( '0' != venam_settings( 'post_title_visibility', '1' ) ) {

            the_title( sprintf( '<h4 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

        }
    }
}


if ( ! function_exists( 'venam_post_date' ) ) {

    function venam_post_date( $icon )
    {
        if ( '0' != venam_settings( 'post_date_visibility', '1' ) ) {

            $archive_year  = get_the_time( 'Y' );
            $archive_month = get_the_time( 'm' );
            $archive_day   = get_the_time( 'd' );

            printf( '<a class="post--date" href="%1$s" title="%1$s">%3$s %2$s</a></li>',
                esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                get_the_date(),
                $icon ? $icon : ''
            );
        }
    }
}


if ( ! function_exists( 'venam_post_category' ) ) {

    function venam_post_category()
    {
        if ( has_category() && '0' != venam_settings( 'post_category_visibility', '1' ) ) {
            ?>
            <div class="clearfix"></div>
            <div class="blog-overlay-tag">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    foreach( $categories as $category ) {
                        printf( '<a href="%1$s" alt="%2$s">%3$s</a>',
                        esc_url( get_category_link( $category->term_id ) ),
                        esc_attr( sprintf( esc_html__( 'View all posts in %s', 'venam' ), $category->name ) ),
                        esc_html( $category->name ) );
                    }
                }
                ?>
            </div>
            <?php
        }
    }
}


if ( ! function_exists( 'venam_post_tags' ) ) {

    function venam_post_tags()
    {
        if ( has_tag() && '0' != venam_settings( 'post_tags_visibility', '1' ) ) {

            the_tags('<div class="tags">','','</div>');

        }
    }
}


if ( ! function_exists( 'venam_post_content' ) ) {

    function venam_post_content()
    {
        $limit = is_single() ? venam_settings( 'related_excerpt_limit', '9' ) : venam_settings( 'excerptsz', '30' );
        $excerpt = is_single() ? venam_settings( 'related_excerpt_visibility', '1' ) : venam_settings( 'post_excerpt_visibility', '1' );

        if ( '0' != $excerpt ) {

            if ( has_excerpt() ) {
                if ( $limit ) {
                    echo wpautop( wp_trim_words( strip_tags( trim( get_the_excerpt() ) ), $limit ) );
                } else {
                    echo wpautop( get_the_excerpt() );
                }

            } else {

                echo wpautop( wp_trim_words( strip_tags( trim( get_the_content() ) ), $limit ) );

            }
        }

        venam_wp_link_pages();
    }
}


if ( ! function_exists( 'venam_post_meta' ) ) {

    function venam_post_meta( $author=true, $date=true, $comments=true )
    {
        $author   = false == $author ? '0' : venam_settings( 'post_author_visibility', '1' );
        $date     = false == $date ? '0' : venam_settings( 'post_date_visibility', '1' );
        $comments = false == $comments ? '0' : venam_settings( 'post_comments_visibility', '1' );

        if ( '0' != $author || '0' != $date || '0' != $comments ) {
            ?>
            <div class="blog-post-meta">
                <ul>
                    <?php
                    if ( '0' != $author ) {
                        printf( '<li><i class="far fa-user"></i>%1$s<a href="%2$s" title="%3$s"> %3$s</a></li>',
                            esc_html__( 'By', 'venam' ),
                            get_author_posts_url( get_the_author_meta( 'ID' ) ),
                            get_the_author()
                        );
                    }
                    if ( '0' != $date ) {
                        $archive_year  = get_the_time( 'Y' );
                        $archive_month = get_the_time( 'm' );
                        $archive_day   = get_the_time( 'd' );
                        printf( '<li><i class="far fa-calendar-alt"></i><a href="%1$s" title="%1$s"> %2$s</a></li>',
                            esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                            get_the_date()
                        );
                    }
                    if ( comments_open() && '0' != get_comments_number() && '0' != $comments ) {
                        printf( '<li><i class="far fa-comments"></i><a href="%s" title="%s"> %s</a></li>',
                            get_comments_link( get_the_ID() ),
                            get_the_title(),
                            _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'venam' ),
                            number_format_i18n( get_comments_number() )
                        );
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
    }
}


if ( ! function_exists( 'venam_post_button' ) ) {

    function venam_post_button( $icon='' )
    {
        if ( '0' != venam_settings( 'post_button_visibility', '1' ) ) {

            $button_title = venam_settings( 'post_button_title' ) ? esc_html( venam_settings( 'post_button_title' ) ) : esc_html__( 'Read More', 'venam' );
            printf( '<a class="read-more" href="%s" title="%s">%s %s</a>',
                get_permalink(),
                the_title_attribute( 'echo=0' ),
                $button_title,
                $icon ? $icon : ''
            );

        }
    }
}


if ( ! function_exists('venam_sticky_post') ) {

    function venam_sticky_post()
    {
        if ( is_sticky() ) {
            ?>
            <div class="nt-sticky-label"><i class="fa fa-thumb-tack" aria-hidden="true"></i>Sticky</div>
            <?php
        }
    }
}
