<?php

/*
** theme options panel and metabox settings
** will change some parts of theme via custom style
*/

function venam_custom_css()
{

  // stop on admin pages
    if (is_admin()) {
        return false;
    }

    // Redux global
    global $venam;

    /* CSS to output */
    $theCSS = '';

    /*************************************************
    ## PRELOADER SETTINGS
    *************************************************/

    if ( '0' != venam_settings('preloader_visibility') ) {
        $pretype = venam_settings('pre_type', 'default');
        $prebg = venam_settings('pre_bg', '#fff');
        $prebg = $prebg ? $prebg : '#f1f1f1';
        $spinclr = venam_settings('pre_spin', '#000');
        $spinclr = $spinclr ? $spinclr : '#000';
        if ( 'default' == $pretype ) {
            $theCSS .= 'body.dark .pace, body.light .pace { background-color: '. esc_attr( $spinclr ) .';}';
            $theCSS .= '#preloader:after, #preloader:before{ background-color:'. esc_attr( $prebg ) .';}';
        }

        $theCSS .= 'div#nt-preloader {background-color: '. esc_attr($prebg) .';overflow: hidden;background-repeat: no-repeat;background-position: center center;height: 100%;left: 0;position: fixed;top: 0;width: 100%;z-index: 9999999;}';
        $spin_rgb = venam_hex2rgb($spinclr);

        if ('01' == $pretype) {
            $theCSS .= '.loader01 {width: 56px;height: 56px;border: 8px solid '. $spinclr .';border-right-color: transparent;border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }.loader01::after {content: "";width: 8px;height: 8px;background: '. $spinclr .';border-radius: 50%;position: absolute;top: -1px;left: 33px; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('02' == $pretype) {
            $theCSS .= '.loader02 {width: 56px;height: 56px;border: 8px solid rgba('. $spin_rgb .', 0.25);border-top-color: '. $spinclr .';border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('03' == $pretype) {
            $theCSS .= '.loader03 {width: 56px;height: 56px;border: 8px solid transparent;border-top-color: '. $spinclr .';border-bottom-color: '. $spinclr .';border-radius: 50%;position: relative;animation: loader-rotate 1s linear infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('04' == $pretype) {
            $theCSS .= '.loader04 {width: 56px;height: 56px;border: 2px solid rgba('. $spin_rgb .', 0.5);border-radius: 50%;position: relative;animation: loader-rotate 1s ease-in-out infinite;top: 50%;margin: -28px auto 0; }.loader04::after {content: "";width: 10px;height: 10px;border-radius: 50%;background: '. $spinclr .';position: absolute;top: -6px;left: 50%;margin-left: -5px; }@keyframes loader-rotate {0% {transform: rotate(0); }100% {transform: rotate(360deg); } }';
        }
        if ('05' == $pretype) {
            $theCSS .= '.loader05 {width: 56px;height: 56px;border: 4px solid '. $spinclr .';border-radius: 50%;position: relative;animation: loader-scale 1s ease-out infinite;top: 50%;margin: -28px auto 0; }@keyframes loader-scale {0% {transform: scale(0);opacity: 0; }50% {opacity: 1; }100% {transform: scale(1);opacity: 0; } }';
        }
        if ('06' == $pretype) {
            $theCSS .= '.loader06 {width: 56px;height: 56px;border: 4px solid transparent;border-radius: 50%;position: relative;top: 50%;margin: -28px auto 0; }.loader06::before {content: "";border: 4px solid rgba('. $spin_rgb .', 0.5);border-radius: 50%;width: 67.2px;height: 67.2px;position: absolute;top: -9.6px;left: -9.6px;animation: loader-scale 1s ease-out infinite;animation-delay: 1s;opacity: 0; }.loader06::after {content: "";border: 4px solid '. $spinclr .';border-radius: 50%;width: 56px;height: 56px;position: absolute;top: -4px;left: -4px;animation: loader-scale 1s ease-out infinite;animation-delay: 0.5s; }@keyframes loader-scale {0% {transform: scale(0);opacity: 0; }50% {opacity: 1; }100% {transform: scale(1);opacity: 0; } }';
        }
        if ('07' == $pretype) {
            $theCSS .= '.loader07 {width: 16px;height: 16px;border-radius: 50%;position: relative;animation: loader-circles 1s linear infinite;top: 50%;margin: -8px auto 0; }@keyframes loader-circles {0% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.05), 19px -19px 0 0 rgba('. $spin_rgb .', 0.1), 27px 0 0 0 rgba('. $spin_rgb .', 0.2), 19px 19px 0 0 rgba('. $spin_rgb .', 0.3), 0 27px 0 0 rgba('. $spin_rgb .', 0.4), -19px 19px 0 0 rgba('. $spin_rgb .', 0.6), -27px 0 0 0 rgba('. $spin_rgb .', 0.8), -19px -19px 0 0 '. $spinclr .'; }12.5% {box-shadow: 0 -27px 0 0 '. $spinclr .', 19px -19px 0 0 rgba('. $spin_rgb .', 0.05), 27px 0 0 0 rgba('. $spin_rgb .', 0.1), 19px 19px 0 0 rgba('. $spin_rgb .', 0.2), 0 27px 0 0 rgba('. $spin_rgb .', 0.3), -19px 19px 0 0 rgba('. $spin_rgb .', 0.4), -27px 0 0 0 rgba('. $spin_rgb .', 0.6), -19px -19px 0 0 rgba('. $spin_rgb .', 0.8); }25% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.8), 19px -19px 0 0 '. $spinclr .', 27px 0 0 0 rgba('. $spin_rgb .', 0.05), 19px 19px 0 0 rgba('. $spin_rgb .', 0.1), 0 27px 0 0 rgba('. $spin_rgb .', 0.2), -19px 19px 0 0 rgba('. $spin_rgb .', 0.3), -27px 0 0 0 rgba('. $spin_rgb .', 0.4), -19px -19px 0 0 rgba('. $spin_rgb .', 0.6); }37.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.6), 19px -19px 0 0 rgba('. $spin_rgb .', 0.8), 27px 0 0 0 '. $spinclr .', 19px 19px 0 0 rgba('. $spin_rgb .', 0.05), 0 27px 0 0 rgba('. $spin_rgb .', 0.1), -19px 19px 0 0 rgba('. $spin_rgb .', 0.2), -27px 0 0 0 rgba('. $spin_rgb .', 0.3), -19px -19px 0 0 rgba('. $spin_rgb .', 0.4); }50% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.4), 19px -19px 0 0 rgba('. $spin_rgb .', 0.6), 27px 0 0 0 rgba('. $spin_rgb .', 0.8), 19px 19px 0 0 '. $spinclr .', 0 27px 0 0 rgba('. $spin_rgb .', 0.05), -19px 19px 0 0 rgba('. $spin_rgb .', 0.1), -27px 0 0 0 rgba('. $spin_rgb .', 0.2), -19px -19px 0 0 rgba('. $spin_rgb .', 0.3); }62.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.3), 19px -19px 0 0 rgba('. $spin_rgb .', 0.4), 27px 0 0 0 rgba('. $spin_rgb .', 0.6), 19px 19px 0 0 rgba('. $spin_rgb .', 0.8), 0 27px 0 0 '. $spinclr .', -19px 19px 0 0 rgba('. $spin_rgb .', 0.05), -27px 0 0 0 rgba('. $spin_rgb .', 0.1), -19px -19px 0 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.2), 19px -19px 0 0 rgba('. $spin_rgb .', 0.3), 27px 0 0 0 rgba('. $spin_rgb .', 0.4), 19px 19px 0 0 rgba('. $spin_rgb .', 0.6), 0 27px 0 0 rgba('. $spin_rgb .', 0.8), -19px 19px 0 0 '. $spinclr .', -27px 0 0 0 rgba('. $spin_rgb .', 0.05), -19px -19px 0 0 rgba('. $spin_rgb .', 0.1); }87.5% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.1), 19px -19px 0 0 rgba('. $spin_rgb .', 0.2), 27px 0 0 0 rgba('. $spin_rgb .', 0.3), 19px 19px 0 0 rgba('. $spin_rgb .', 0.4), 0 27px 0 0 rgba('. $spin_rgb .', 0.6), -19px 19px 0 0 rgba('. $spin_rgb .', 0.8), -27px 0 0 0 '. $spinclr .', -19px -19px 0 0 rgba('. $spin_rgb .', 0.05); }100% {box-shadow: 0 -27px 0 0 rgba('. $spin_rgb .', 0.05), 19px -19px 0 0 rgba('. $spin_rgb .', 0.1), 27px 0 0 0 rgba('. $spin_rgb .', 0.2), 19px 19px 0 0 rgba('. $spin_rgb .', 0.3), 0 27px 0 0 rgba('. $spin_rgb .', 0.4), -19px 19px 0 0 rgba('. $spin_rgb .', 0.6), -27px 0 0 0 rgba('. $spin_rgb .', 0.8), -19px -19px 0 0 '. $spinclr .'; } }';
        }
        if ('08' == $pretype) {
            $theCSS .= '.loader08 {width: 20px;height: 20px;position: relative;animation: loader08 1s ease infinite;top: 50%;margin: -46px auto 0; }@keyframes loader08 {0%, 100% {box-shadow: -13px 20px 0 '. $spinclr .', 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 rgba('. $spin_rgb .', 0.2); }25% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 '. $spinclr .', 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 rgba('. $spin_rgb .', 0.2); }50% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 '. $spinclr .', -13px 46px 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: -13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 20px 0 rgba('. $spin_rgb .', 0.2), 13px 46px 0 rgba('. $spin_rgb .', 0.2), -13px 46px 0 '. $spinclr .'; } }';
        }
        if ('09' == $pretype) {
            $theCSS .= '.loader09 {width: 10px;height: 48px;background: '. $spinclr .';position: relative;animation: loader09 1s ease-in-out infinite;animation-delay: 0.4s;top: 50%;margin: -28px auto 0; }.loader09::after, .loader09::before {content:  "";position: absolute;width: 10px;height: 48px;background: '. $spinclr .';animation: loader09 1s ease-in-out infinite; }.loader09::before {right: 18px;animation-delay: 0.2s; }.loader09::after {left: 18px;animation-delay: 0.6s; }@keyframes loader09 {0%, 100% {box-shadow: 0 0 0 '. $spinclr .', 0 0 0 '. $spinclr .'; }50% {box-shadow: 0 -8px 0 '. $spinclr .', 0 8px 0 '. $spinclr .'; } }';
        }
        if ('10' == $pretype) {
            $theCSS .= '.loader10 {width: 28px;height: 28px;border-radius: 50%;position: relative;animation: loader10 0.9s ease alternate infinite;animation-delay: 0.36s;top: 50%;margin: -42px auto 0; }.loader10::after, .loader10::before {content: "";position: absolute;width: 28px;height: 28px;border-radius: 50%;animation: loader10 0.9s ease alternate infinite; }.loader10::before {left: -40px;animation-delay: 0.18s; }.loader10::after {right: -40px;animation-delay: 0.54s; }@keyframes loader10 {0% {box-shadow: 0 28px 0 -28px '. $spinclr .'; }100% {box-shadow: 0 28px 0 '. $spinclr .'; } }';
        }
        if ('11' == $pretype) {
            $theCSS .= '.loader11 {width: 20px;height: 20px;border-radius: 50%;box-shadow: 0 40px 0 '. $spinclr .';position: relative;animation: loader11 0.8s ease-in-out alternate infinite;animation-delay: 0.32s;top: 50%;margin: -50px auto 0; }.loader11::after, .loader11::before {content:  "";position: absolute;width: 20px;height: 20px;border-radius: 50%;box-shadow: 0 40px 0 '. $spinclr .';animation: loader11 0.8s ease-in-out alternate infinite; }.loader11::before {left: -30px;animation-delay: 0.48s;}.loader11::after {right: -30px;animation-delay: 0.16s; }@keyframes loader11 {0% {box-shadow: 0 40px 0 '. $spinclr .'; }100% {box-shadow: 0 20px 0 '. $spinclr .'; } }';
        }
        if ('12' == $pretype) {
            $theCSS .= '.loader12 {width: 20px;height: 20px;border-radius: 50%;position: relative;animation: loader12 1s linear alternate infinite;top: 50%;margin: -50px auto 0; }@keyframes loader12 {0% {box-shadow: -60px 40px 0 2px '. $spinclr .', -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }25% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 2px '. $spinclr .', 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }50% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 2px '. $spinclr .', 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }75% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 2px '. $spinclr .', 60px 40px 0 0 rgba('. $spin_rgb .', 0.2); }100% {box-shadow: -60px 40px 0 0 rgba('. $spin_rgb .', 0.2), -30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 0 40px 0 0 rgba('. $spin_rgb .', 0.2), 30px 40px 0 0 rgba('. $spin_rgb .', 0.2), 60px 40px 0 2px '. $spinclr .'; } }';
        }
    }

    $root_clr1 = venam_settings( 'theme_clr1' );
    $root_clr2 = venam_settings( 'theme_clr2' );
    $root_clr3 = venam_settings( 'theme_clr3' );
    $root_clr4 = venam_settings( 'theme_clr4' );

    if( $root_clr1 || $root_clr2 || $root_clr3 || $root_clr4 ) {
        $theCSS .= ':root {';
            $theCSS .= $root_clr1 ? '--theme-base: '.$root_clr1.';' : '';
            $theCSS .= $root_clr1 ? '--theme-base-rgb: '.venam_hex2rgb($root_clr1).';' : '';
            $theCSS .= $root_clr2 ? '--theme-primary: '.$root_clr2.';' : '';
            $theCSS .= $root_clr2 ? '--theme-primary-rgb: '.venam_hex2rgb($root_clr2).';' : '';
            $theCSS .= $root_clr3 ? '--theme-black: '.$root_clr3.';' : '';
            $theCSS .= $root_clr3 ? '--theme-black-rgb: '.venam_hex2rgb($root_clr3).';' : '';
            $theCSS .= $root_clr4 ? '--theme-black2: '.$root_clr4.';' : '';
            $theCSS .= $root_clr4 ? '--theme-black2-rgb: '.venam_hex2rgb($root_clr4).';' : '';
        $theCSS .= '}';
    }

    // use page/post ID for page settings
    $page_id = get_the_ID();

    /*************************************************
    ## THEME PAGINATION
    *************************************************/
    // pagination color
    $pag_clr = venam_settings('pag_clr');
    // pagination active and hover color
    $pag_hvrclr = venam_settings( 'pag_hvrclr' );
    // pagination number color
    $pag_nclr = venam_settings( 'pag_nclr' );
    // pagination active and hover color
    $pag_hvrnclr = venam_settings( 'pag_hvrnclr' );

    // pagination color
    if ( $pag_clr ) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link { border-color: '. esc_attr( $pag_clr ) .'; }
        .nt-pagination.-style-default .nt-pagination-link { background-color: '. esc_attr( $pag_clr ) .';
        }';
    }
    // pagination active and hover color
    if ($pag_hvrclr) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link:hover { border-color: '. esc_attr( $pag_hvrclr ) .'; }
        .nt-pagination.-style-default .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-item .nt-pagination-link:hover { background-color: '. esc_attr( $pag_hvrclr ) .';
        }';
    }
    // pagination number color
    if ( $pag_nclr ) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-link { color: '. esc_attr( $pag_nclr ) .';
        }';
    }
    // pagination active and hover color
    if ( $pag_hvrnclr ) {
        $theCSS .= '
        .nt-pagination.-style-outline .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-outline .nt-pagination-item .nt-pagination-link:hover,
        .nt-pagination.-style-default .nt-pagination-item.active .nt-pagination-link,
        .nt-pagination.-style-default .nt-pagination-item .nt-pagination-link:hover { color: '. esc_attr( $pag_hvrnclr ) .';
        }';
    }


    /*************************************************
    ## PAGE METABOX SETTINGS
    *************************************************/

    if ( is_page() && ! venam_check_is_elementor() ) {

        $heroimg = wp_get_attachment_image_src( $page_id, 'full' );
        if ( $heroimg ) {
            $theCSS .= '.page-'.$page_id.' .breadcrumb-bg { background-image:url('.esc_url( $heroimg ).'); }';
        }
    }

    /* Add CSS to style.css */
    wp_register_style('venam-custom-style', false);
    wp_enqueue_style('venam-custom-style');
    wp_add_inline_style('venam-custom-style', $theCSS);
}

add_action('wp_enqueue_scripts', 'venam_custom_css');


// customization on admin pages
function venam_admin_custom_css()
{
    if ( ! is_admin() ) {
        return false;
    }

    /* CSS to output */
    $theCSS = '';

    $theCSS .= '
    #setting-error-tgmpa, #setting-error-venam {
        display: block !important;
    }
    .menu-item.menu-item-depth-0 .et_menu_options .venam-field-link-shortcode,
    .menu-item.menu-item-depth-0 .et_menu_options .venam-field-link-hidetitle,
    .menu-item.menu-item-depth-0 .et_menu_options .venam-field-link-title,
    .menu-item.menu-item-depth-0 .et_menu_options .venam-field-link-label,
    .menu-item.menu-item-depth-0 .et_menu_options .venam-field-link-labelcolor,
    .menu-item.menu-item-depth-0 .et_menu_options .venam-field-link-image,
    .menu-item:not(.menu-item-depth-0) .et_menu_options .venam-field-link-mega,
    .menu-item:not(.menu-item-depth-0) .et_menu_options .venam-field-link-mega-columns{
        display: none;
    }
    .et_menu_options .small-tag {
        font-size: 10px;
        font-weight: 400;
        position: relative;
        top: -2px;
        display: inline-block;
        margin-left: 4px;
        color: #fff;
        background-color: #bbb;
        line-height: 1;
        padding: 3px 6px;
        border-radius: 3px;
    }
    .redux_field_th {
        color: #191919;
        font-weight: 700;
    }
    input#venam_badge_color {
        margin: 0!important;
    }
    p.form-field.venam_wc_cat_banner_field span {
        display: block;
        max-width: 95%;
    }
    td.venam_cat_banner.column-venam_cat_banner {
        position: relative;
    }
    .venam_cat_banner span.wc-banner:before {
        font-family: Dashicons;
        font-weight: 400;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        text-indent: 0px;
        color: #2271b1;
        content: "\f155";
        font-variant: normal;
        margin: 0px;
        font-size: 18px;
    }
    span.wc-banner {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 25px;
        text-align: center;
    }
    .woocommerce_options_panel .venam_badge_color_field .wp-picker-input-wrap label{
        margin: 0;
        width: auto;
    }
    th#taxonomy-venam_product_brands,th#woosw {
        width: 11%!important;
    }
    .image-preview-wrapper {
        max-width: 100px;
    }
    .image-preview-wrapper img {
        max-width: 100%;
    }
    .redux-main .description {
        display: block;
        font-weight: normal;
    }
    li#toplevel_page_wpclever,
    #redux-connect-message {
        opacity: 0 !important;
        display: none !important;
        visibility : hidden;
    }
    .redux-main .wp-picker-container .wp-color-result-text {
        line-height: 28px;
    }
    .redux-container .redux-main .input-append .add-on,
    .redux-container .redux-main .input-prepend .add-on {
        line-height: 22px;
    }
  	#customize-controls img {
  		max-width: 75%;
  	}
    .redux-info-desc .thm-btn:hover {
        color: #000;
    }
    .redux-info-desc .thm-btn i {
        margin-left: 10px;
    }
    .redux-info-desc .thm-btn {
        -moz-user-select: none;
        border: medium none;
        border-radius: 4px;
        color: #fff;
        background-color: #2271b1;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        height: 40px;
        min-width: 160px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0;
        line-height: 1;
        margin-bottom: 0;
        text-align: center;
        text-transform: uppercase;
        touch-action: manipulation;
        transition: all 0.3s ease 0s;
        vertical-align: middle;
        white-space: nowrap;
    }';
    // end $theCSS

    /* Add CSS to style.css */
    wp_register_style('venam-admin-custom-style', false);
    wp_enqueue_style('venam-admin-custom-style');
    wp_add_inline_style('venam-admin-custom-style', $theCSS);
}
add_action('admin_enqueue_scripts', 'venam_admin_custom_css');
