<?php

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if (! class_exists('Redux' )) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $venam_pre = "venam";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $venam_theme = wp_get_theme(); // For use with some settings. Not necessary.

    $venam_options_args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name' => $venam_pre,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name' => $venam_theme->get('Name' ),
        // Name that appears at the top of your panel
        'display_version' => $venam_theme->get('Version' ),
        // Version that appears at the top of your panel
        'menu_type' => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu' => false,
        // Show the sections below the admin menu item or not
        'menu_title' => esc_html__( 'Theme Options', 'venam' ),
        'page_title' => esc_html__( 'Theme Options', 'venam' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key' => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography' => false,
        // Use a asynchronous font on the front end or font string
        'admin_bar' => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon' => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority' => 50,
        // Choose an priority for the admin bar menu
        'global_variable' => 'venam',
        // Set a different name for your global variable other than the venam_pre
        'dev_mode' => false,
        // Show the time the page took to load, etc
        'update_notice' => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer' => true,
        // Enable basic customizer support

        // OPTIONAL -> Give you extra features
        'page_priority' => 99,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent' => apply_filters( 'ninetheme_parent_slug', 'themes.php' ),
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions' => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon' => '',
        // Specify a custom URL to an icon
        'last_tab' => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon' => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug' => '',
        // Page slug used to denote the panel, will be based off page title then menu title then venam_pre if not provided
        'save_defaults' => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show' => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark' => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export' => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time' => 60 * MINUTE_IN_SECONDS,
        'output' => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database' => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn' => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'dark',
                'shadow' => true,
                'rounded' => false,
                'style' => '',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $venam_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-venam-docs',
        'href' => 'http://demo-ninetheme.com/venam/doc.html',
        'title' => esc_html__( 'venam Documentation', 'venam' ),
    );
    $venam_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-support',
        'href' => 'https://9theme.ticksy.com/',
        'title' => esc_html__( 'Support', 'venam' ),
    );
    $venam_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-portfolio',
        'href' => 'https://themeforest.net/user/ninetheme/portfolio',
        'title' => esc_html__( 'NineTheme Portfolio', 'venam' ),
    );

    // Add content after the form.
    $venam_options_args['footer_text'] = esc_html__( 'If you need help please read docs and open a ticket on our support center.', 'venam' );

    Redux::setArgs($venam_pre, $venam_options_args);

    /* END ARGUMENTS */

    /* START SECTIONS */

    $el_args = array(
        'post_type'      => 'elementor_library',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'elementor_library_type',
                'field'    => 'slug',
                'terms'    => 'section'
            )
        )
    );
    $activekit = get_option( 'elementor_active_kit' );
    /*************************************************
    ## MAIN SETTING SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Main Setting', 'venam' ),
        'id' => 'basic',
        'desc' => esc_html__( 'These are main settings for general theme!', 'venam' ),
        'icon' => 'el el-cog',
    ));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Typograhy and Color', 'venam' ),
        'id' => 'themecolorsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'id' =>'edit_typograhy_settings',
                'type' => 'info',
                'desc' => sprintf( '<b>%s</b> <a class="thm-btn" href="%s" target="_blank">%s</a>',
                    esc_html__( 'This theme uses Elementor Site Settings', 'venam' ),
                    admin_url('post.php?post='.$activekit.'&action=elementor'),
                    esc_html__( 'Site Settings', 'venam' )
                )
            ),
            array(
                'title' => esc_html__( 'Theme Base Color', 'venam' ),
                'subtitle' => esc_html__( 'Add theme root base color.', 'venam' ),
                'customizer' => true,
                'id' => 'theme_clr1',
                'type' => 'color',
                'default' => ''
            ),
            array(
                'title' => esc_html__( 'Theme Primary Color', 'venam' ),
                'subtitle' => esc_html__( 'Add theme root primary color.', 'venam' ),
                'customizer' => true,
                'id' => 'theme_clr2',
                'type' => 'color',
                'default' => ''
            ),
            array(
                'title' => esc_html__( 'Theme Black Color', 'venam' ),
                'subtitle' => esc_html__( 'Add theme root black color.', 'venam' ),
                'customizer' => true,
                'id' => 'theme_clr3',
                'type' => 'color',
                'default' => ''
            ),
            array(
                'title' => esc_html__( 'Theme Black Color 2', 'venam' ),
                'subtitle' => esc_html__( 'Add theme root black color.', 'venam' ),
                'customizer' => true,
                'id' => 'theme_clr4',
                'type' => 'color',
                'default' => ''
            ),
        )
    ));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Breadcrumbs', 'venam' ),
        'id' => 'themebreadsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Breadcrumbs', 'venam' ),
                'subtitle' => esc_html__( 'If enabled, adds breadcrumbs navigation to bottom of page title.', 'venam' ),
                'customizer' => true,
                'id' => 'breadcrumbs_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Breadcrumbs Current Color', 'venam' ),
                'customizer' => true,
                'id' => 'breadcrumbs_current',
                'type' => 'color',
                'default' => '',
                'output' => array( '.thm-breadcrumb li.breadcrumb_active' ),
                'required' => array( 'breadcrumbs_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Breadcrumbs Separator Color', 'venam' ),
                'customizer' => true,
                'id' => 'breadcrumbs_icon',
                'type' => 'color',
                'default' => '',
                'output' => array( '.thm-breadcrumb .breadcrumb_link_seperator' ),
                'required' => array( 'breadcrumbs_visibility', '=', '1' )
            )
        )
    ));
    //PRELOADER SETTINGS SUBSECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Preloader', 'venam' ),
        'id' => 'themepreloadersubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Preloader', 'venam' ),
                'subtitle' => esc_html__( 'If enabled, adds preloader.', 'venam' ),
                'customizer' => true,
                'id' => 'preloader_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Preloader Type', 'venam' ),
                'subtitle' => esc_html__( 'Select your preloader type.', 'venam' ),
                'customizer' => true,
                'id' => 'pre_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Default', 'venam' ),
                    '01' => esc_html__( 'Type 1', 'venam' ),
                    '02' => esc_html__( 'Type 2', 'venam' ),
                    '03' => esc_html__( 'Type 3', 'venam' ),
                    '04' => esc_html__( 'Type 4', 'venam' ),
                    '05' => esc_html__( 'Type 5', 'venam' ),
                    '06' => esc_html__( 'Type 6', 'venam' ),
                    '07' => esc_html__( 'Type 7', 'venam' ),
                    '08' => esc_html__( 'Type 8', 'venam' ),
                    '09' => esc_html__( 'Type 9', 'venam' ),
                    '10' => esc_html__( 'Type 10', 'venam' ),
                    '11' => esc_html__( 'Type 11', 'venam' ),
                    '12' => esc_html__( 'Type 12', 'venam' ),
                ),
                'default' => '01',
            ),
            array(
                'title' => esc_html__( 'Preloader Image', 'venam' ),
                'subtitle' => esc_html__( 'Upload your Logo. If left blank theme will use site default preloader.', 'venam' ),
                'customizer' => true,
                'id' => 'pre_img',
                'type' => 'media',
                'url' => true,
                'customizer' => true,
                'required' => array(
                    array( 'preloader_visibility', '=', '1' ),
                    array( 'pre_type', '=', 'default' ),
                )
            ),
            array(
                'title' => esc_html__( 'Background Color', 'venam' ),
                'subtitle' => esc_html__( 'Add preloader background color.', 'venam' ),
                'customizer' => true,
                'id' => 'pre_bg',
                'type' => 'color',
                'default' => '',
                'required' => array( 'preloader_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Spin Color', 'venam' ),
                'subtitle' => esc_html__( 'Add preloader spin color.', 'venam' ),
                'customizer' => true,
                'id' => 'pre_spin',
                'type' => 'color',
                'default' => '',
                'required' => array( 'preloader_visibility', '=', '1' )
            )
    )));

    //BACKTOTOP BUTTON SUBSECTION
    Redux::setSection($venam_pre, array(
    'title' => esc_html__( 'Back-to-top Button', 'venam' ),
    'id' => 'backtotop',
    'icon' => 'el el-brush',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__( 'Back-to-top', 'venam' ),
            'subtitle' => esc_html__( 'Switch On-off', 'venam' ),
            'desc' => esc_html__( 'If enabled, adds back to top.', 'venam' ),
            'customizer' => true,
            'id' => 'backtotop_visibility',
            'type' => 'switch',
            'default' => true
        ),
        array(
            'title' => esc_html__( 'Bottom Offset', 'venam' ),
            'subtitle' => esc_html__( 'Set custom bottom offset for the back-to-top button', 'venam' ),
            'customizer' => true,
            'id' => 'backtotop_top_offset',
            'type' => 'spacing',
            'output' => array('.scroll-to-top'),
            'mode' => 'absolute',
            'units' => array('px'),
            'all' => false,
            'top' => false,
            'right' => true,
            'bottom' => true,
            'left' => false,
            'default' => array(
                'right' => '30',
                'bottom' => '30',
                'units' => 'px'
            ),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Background Color', 'venam' ),
            'customizer' => true,
            'id' => 'backtotop_bg',
            'type' => 'color',
            'mode' => 'background-color',
            'validate' => 'color',
            'output' => array('.scroll-to-top'),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Hover Background Color', 'venam' ),
            'customizer' => true,
            'id' => 'backtotop_hvrbg',
            'type' => 'color',
            'mode' => 'background-color',
            'validate' => 'color',
            'output' => array('.scroll-to-top:hover'),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Arrow Color', 'venam' ),
            'customizer' => true,
            'id' => 'backtotop_icon',
            'type' => 'color',
            'default' =>  '',
            'validate' => 'color',
            'output' => array('.scroll-to-top'),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Hover Arrow Color', 'venam' ),
            'customizer' => true,
            'id' => 'backtotop_hvricon',
            'type' => 'color',
            'default' =>  '',
            'validate' => 'color',
            'output' => array('.scroll-to-top:hover'),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
    )));

    // THEME PAGINATION SUBSECTION
    Redux::setSection($venam_pre, array(
    'title' => esc_html__( 'Pagination', 'venam' ),
    'desc' => esc_html__( 'These are main settings for general theme!', 'venam' ),
    'id' => 'pagination',
    'subsection' => true,
    'icon' => 'el el-link',
    'fields' => array(
        array(
            'title' => esc_html__( 'Pagination', 'venam' ),
            'subtitle' => esc_html__( 'Switch On-off', 'venam' ),
            'desc' => esc_html__( 'If enabled, adds pagination.', 'venam' ),
            'customizer' => true,
            'id' => 'pagination_visibility',
            'type' => 'switch',
            'default' => true
        ),
        array(
            'title' => esc_html__( 'Pagination Type', 'venam' ),
            'subtitle' => esc_html__( 'Select type.', 'venam' ),
            'customizer' => true,
            'id' => 'pag_type',
            'type' => 'select',
            'options' => array(
                'default' => esc_html__( 'Default', 'venam' ),
                'outline' => esc_html__( 'Outline', 'venam' )
            ),
            'default' => 'default',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination size', 'venam' ),
            'subtitle' => esc_html__( 'Select size.', 'venam' ),
            'customizer' => true,
            'id' => 'pag_size',
            'type' => 'select',
            'options' => array(
                'small' => esc_html__( 'small', 'venam' ),
                'medium' => esc_html__( 'medium', 'venam' ),
                'large' => esc_html__( 'large', 'venam' )
            ),
            'default' => 'medium',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination group', 'venam' ),
            'subtitle' => esc_html__( 'Select group.', 'venam' ),
            'customizer' => true,
            'id' => 'pag_group',
            'type' => 'select',
            'options' => array(
                'yes' => esc_html__( 'Yes', 'venam' ),
                'no' => esc_html__( 'No', 'venam' )
            ),
            'default' => 'no',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination corner', 'venam' ),
            'subtitle' => esc_html__( 'Select corner type.', 'venam' ),
            'customizer' => true,
            'id' => 'pag_corner',
            'type' => 'select',
            'options' => array(
                'square' => esc_html__( 'square', 'venam' ),
                'rounded' => esc_html__( 'rounded', 'venam' ),
                'circle' => esc_html__( 'circle', 'venam' )
            ),
            'default' => 'square',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination align', 'venam' ),
            'subtitle' => esc_html__( 'Select align.', 'venam' ),
            'customizer' => true,
            'id' => 'pag_align',
            'type' => 'select',
            'options' => array(
                'left' => esc_html__( 'left', 'venam' ),
                'right' => esc_html__( 'right', 'venam' ),
                'center' => esc_html__( 'center', 'venam' )
            ),
            'default' => 'center',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination default/outline color', 'venam' ),
            'customizer' => true,
            'id' => 'pag_clr',
            'type' => 'color',
            'mode' => 'color',
            'validate' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Active and Hover pagination color', 'venam' ),
            'customizer' => true,
            'id' => 'pag_hvrclr',
            'type' => 'color',
            'mode' => 'color',
            'validate' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination number color', 'venam' ),
            'customizer' => true,
            'id' => 'pag_nclr',
            'type' => 'color',
            'mode' => 'color',
            'validate' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Active and Hover pagination number color', 'venam' ),
            'customizer' => true,
            'id' => 'pag_hvrnclr',
            'type' => 'color',
            'mode' => 'color',
            'validate' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        )
    )));

    /*************************************************
    ## LOGO SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Logo', 'venam' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'venam' ),
        'id' => 'logosection',
        'icon' => 'el el-star-empty',
        'fields' => array(
            array(
                'title' => esc_html__( 'Logo Switch', 'venam' ),
                'subtitle' => esc_html__( 'You can select logo on or off.', 'venam' ),
                'customizer' => true,
                'id' => 'logo_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Logo Type', 'venam' ),
                'subtitle' => esc_html__( 'Select your logo type.', 'venam' ),
                'customizer' => true,
                'id' => 'logo_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'img' => esc_html__( 'Image Logo', 'venam' ),
                    'sitename' => esc_html__( 'Site Name', 'venam' ),
                    'customtext' => esc_html__( 'Custom HTML', 'venam' )
                ),
                'default' => 'sitename',
                'required' => array( 'logo_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Custom text for logo', 'venam' ),
                'desc' => esc_html__( 'Text entered here will be used as logo', 'venam' ),
                'customizer' => true,
                'id' => 'text_logo',
                'type' => 'editor',
                'args' => array(
                    'teeny' => false,
                    'textarea_rows' => 10
                ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'customtext' )
                ),
            ),
            array(
                'title' => esc_html__( 'Hover Logo Color', 'venam' ),
                'desc' => esc_html__( 'Set your own hover color for the text logo.', 'venam' ),
                'customizer' => true,
                'id' => 'text_logo_hvr',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.nt-logo .header-text-logo:hover' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Logo Image', 'venam' ),
                'subtitle' => esc_html__( 'Upload your Logo. If left blank theme will use site default logo.', 'venam' ),
                'customizer' => true,
                'id' => 'img_logo',
                'type' => 'media',
                'url' => true,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Sticky Logo', 'venam' ),
                'subtitle' => esc_html__( 'Upload your Logo. If left blank theme will use site default logo.', 'venam' ),
                'customizer' => true,
                'id' => 'sticky_logo',
                'type' => 'media',
                'url' => true,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Mobile Menu Logo', 'venam' ),
                'subtitle' => esc_html__( 'Upload your Logo. If left blank theme will use site default logo.', 'venam' ),
                'customizer' => true,
                'id' => 'mobile_logo',
                'type' => 'media',
                'url' => true,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                )
            ),
            array(
                'title' => esc_html__( 'Logo Dimensions', 'venam' ),
                'subtitle' => esc_html__( 'Set the logo width and height of the image.', 'venam' ),
                'customizer' => true,
                'id' => 'logo_dimensions',
                'type' => 'dimensions',
                'output' => array('.nt-logo img' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Sticky Logo Dimensions', 'venam' ),
                'subtitle' => esc_html__( 'Set the logo width and height of the image.', 'venam' ),
                'customizer' => true,
                'id' => 'sticky_logo_dimensions',
                'type' => 'dimensions',
                'output' => array('.nt-logo img.sticky-logo' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Mobile Logo Dimensions', 'venam' ),
                'subtitle' => esc_html__( 'Set the logo width and height of the image.', 'venam' ),
                'customizer' => true,
                'id' => 'mobile_logo_dimensions',
                'type' => 'dimensions',
                'output' => array('.nt-logo img.mobile-logo' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Logo Padding', 'venam' ),
                'customizer' => true,
                'id' => 'text_logo_pad',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-logo' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                ),
                'required' => array( 'logo_visibility', '=', '1' )
            )
    )));

    /*************************************************
    ## HEADER & NAV SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Header', 'venam' ),
        'id' => 'headersection',
        'icon' => 'fa fa-bars',
    ));
    //HEADER MENU
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'General', 'venam' ),
        'id' => 'headernavgeneralsection',
        'subsection' => true,
        'icon' => 'fa fa-cog',
        'fields' => array(
            array(
                'title' => esc_html__( 'Header Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site navigation.', 'venam' ),
                'customizer' => true,
                'id' => 'header_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Header Template', 'venam' ),
                'subtitle' => esc_html__( 'Select your header template.', 'venam' ),
                'customizer' => true,
                'id' => 'header_template',
                'type' => 'select',
                'options' => array(
                    'default' => esc_html__( 'Deafult Site Header', 'venam' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'venam' ),
                ),
                'default' => 'default',
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'venam' ),
                'customizer' => true,
                'id' => 'header_elementor_templates',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args,
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'elementor' )
                )
            ),
            array(
                'id' =>'edit_header_elementor_template',
                'type' => 'info',
                'desc' => 'Select template',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'elementor' ),
                    array( 'header_elementor_templates', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Container Width', 'venam' ),
                'subtitle' => esc_html__( 'Select your header template.', 'venam' ),
                'customizer' => true,
                'id' => 'header_width',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'container' => esc_html__( 'Default Container', 'venam' ),
                    'custom-container-two' => esc_html__( 'Container 2', 'venam' ),
                    'custom-container-three' => esc_html__( 'Container 3', 'venam' )
                ),
                'default' => 'custom-container-two',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Sticky Header Display', 'venam' ),
                'customizer' => true,
                'id' => 'header_sticky_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Before Header Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates for before header.', 'venam' ),
                'customizer' => true,
                'id' => 'before_header_template',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args,
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'After Header Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates for after header.', 'venam' ),
                'customizer' => true,
                'id' => 'after_header_template',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args,
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Cart Icon Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site header cart icon.', 'venam' ),
                'customizer' => true,
                'id' => 'header_cart_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Header Cart Extra Text', 'venam' ),
                'subtitle' => esc_html__( 'Add your custom text to header cart before buttons.', 'venam' ),
                'customizer' => true,
                'id' => 'header_cart_before_buttons',
                'type' => 'text',
                'default' => '',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_cart_visibility', '=', '1' )
                )
            ),
            // DEFAULT HEADER OPTIONS
            array(
                'id' => 'mobilemenu_start',
                'type' => 'section',
                'title' => esc_html__('Mobile Header Options', 'venam'),
                'customizer' => true,
                'indent' => true,
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Ajax Search Form Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site mobile header search form icon.', 'venam' ),
                'customizer' => true,
                'id' => 'mobile_menu_ajax_search_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'My Account Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site mobile header myaccount icon.', 'venam' ),
                'customizer' => true,
                'id' => 'header_myaccount_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'My Account Custom URL', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site mobile header myaccount icon.', 'venam' ),
                'customizer' => true,
                'id' => 'header_account_url',
                'type' => 'text',
                'default' => class_exists( 'WooCommerce' ) ? esc_url( wc_get_page_permalink( 'myaccount' ) ) : '',
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_myaccount_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Mobile Header After Menu Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates for after mabile menu.', 'venam' ),
                'customizer' => true,
                'id' => 'mobile_header_footer_template',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args,
                'required' => array( 'header_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Mobile Bottom Menu Bar Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site mobile bottom menu bar.', 'venam' ),
                'customizer' => true,
                'id' => 'bottom_mobile_nav_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Mobile Bottom Menu Popup Search Type', 'venam' ),
                'subtitle' => esc_html__( 'Select your mobile bottom menu popup search type.', 'venam' ),
                'customizer' => true,
                'id' => 'bottom_mobile_search_type',
                'type' => 'button_set',
                'customizer' => true,
                'options' => array(
                    'category' => esc_html__( 'Category Search', 'venam' ),
                    'ajax' => esc_html__( 'Ajax Search', 'venam' ),
                    'custom' => esc_html__( 'Custom Shortcode', 'venam' )
                ),
                'default' => 'category',
                'required' => array( 'bottom_mobile_nav_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Custom Form Shortcode Area', 'venam' ),
                'subtitle' => esc_html__( 'If you want to use any search form plugin, please add your shortcode here', 'venam' ),
                'customizer' => true,
                'id' => 'search_form_shortcode',
                'type' => 'text',
                'customizer' => true,
                'required' => array(
                    array( 'bottom_mobile_nav_visibility', '=', '1' ),
                    array( 'bottom_mobile_search_type', '=', 'custom' ),
                )
            ),

            // DEFAULT HEADER OPTIONS
            array(
                'id' => 'defaultmenu_start',
                'type' => 'section',
                'title' => esc_html__('Header Customize Options', 'venam'),
                'customizer' => true,
                'indent' => true,
                'required' => array(
                    array( 'header_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Background Color', 'venam' ),
                'customizer' => true,
                'id' => 'header_bg',
                'type' => 'color_rgba',
                'mode' => 'background-color',
                'output' => array( '.header-style-two .main-header' ),
            ),
            array(
                'title' => esc_html__( 'Menu Item Color', 'venam' ),
                'desc' => esc_html__( 'Set your own hover color for the navigation menu item.', 'venam' ),
                'customizer' => true,
                'id' => 'nav_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.header-style-two .navbar-wrap > ul > li a' ),
            ),
            array(
                'title' => esc_html__( 'Menu Item Color ( Hover and Active )', 'venam' ),
                'desc' => esc_html__( 'Set your own hover color for the navigation menu item.', 'venam' ),
                'customizer' => true,
                'id' => 'nav_hvr_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.header-style-two .navbar-wrap > ul > li:hover > a,.header-style-two .navbar-wrap > ul > li.active > a' ),
            ),
            array(
                'title' => esc_html__( 'Sticky Header Background Color', 'venam' ),
                'customizer' => true,
                'id' => 'nav_top_sticky_bg',
                'type' => 'color_rgba',
                'mode' => 'background-color',
                'output' => array( '.header-style-two .main-header.sticky-menu' ),
                'required' => array( 'header_sticky_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Sticky Menu Item Color', 'venam' ),
                'desc' => esc_html__( 'Set your own hover color for the sticky navigation menu item.', 'venam' ),
                'customizer' => true,
                'id' => 'sticky_nav_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.header-style-two .main-header.sticky-menu .navbar-wrap > ul > li a' ),
            ),
            array(
                'title' => esc_html__( 'Sticky Menu Item Color ( Hover and Active )', 'venam' ),
                'desc' => esc_html__( 'Set your own hover color for the sticky navigation menu item.', 'venam' ),
                'customizer' => true,
                'id' => 'sticky_nav_hvr_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.header-style-two .main-header.sticky-menu .navbar-wrap > ul > li:hover > a,.header-style-two .main-header.sticky-menu .navbar-wrap > ul > li.active > a' ),
            ),
            array(
                'title' => esc_html__( 'Sub-menu Background Color', 'venam' ),
                'desc' => esc_html__( 'Set your own hover color for the sticky navigation menu item.', 'venam' ),
                'customizer' => true,
                'id' => 'nav_submenu_bg',
                'type' => 'background-color',
                'validate' => 'color',
                'output' => array( '.header-style-two .navbar-wrap ul li .submenu' ),
            ),
            array(
                'title' => esc_html__( 'Sub-menu Menu Item Color', 'venam' ),
                'desc' => esc_html__( 'Set your own hover color for the sticky navigation menu item.', 'venam' ),
                'customizer' => true,
                'id' => 'nav_submenu_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.header-style-two .navbar-wrap ul li .submenu>li.menu-item>a' ),
            ),
            array(
                'title' => esc_html__( 'Sub-menu Menu Item Color ( Hover and Active )', 'venam' ),
                'desc' => esc_html__( 'Set your own hover color for the sticky navigation menu item.', 'venam' ),
                'customizer' => true,
                'id' => 'nav_submenu_hvr_a',
                'type' => 'color',
                'validate' => 'color',
                'output' => array( '.header-style-two .navbar-wrap ul li .submenu>li.menu-item:hover>a,.header-style-two .navbar-wrap ul li .submenu>li.menu-item.active>a' ),
            ),
            //information on-off
            array(
                'id' =>'info_nav0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'venam' ),
                'icon' => 'el el-info-circle',
                'customizer' => true,
                'desc' => sprintf(esc_html__( '%s is disabled on the site. Please activate to view options.', 'venam' ), '<b>Header</b>' ),
                'required' => array( 'header_visibility', '=', '0' )
            )
    )));
    /*************************************************
    ## SIDEBARS SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Sidebars', 'venam' ),
        'desc' => esc_html__( 'You can change the below default layout type.', 'venam' ),
        'id' => 'sidebarssection',
        'icon' => 'fa fa-th-list',
        'fields' => array(
            array(
                'title' => esc_html__( 'Blog Sidebar Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'venam' ),
                'customizer' => true,
                'id' => 'blog_sidebar_templates',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args
            ),
            array(
                'id' =>'edit_sidebar_elementor_template',
                'type' => 'info',
                'desc' => 'Select template',
                'required' => array( 'blog_sidebar_templates', '!=', '' )
            ),
            array(
                'title' => esc_html__( 'Sidebar type', 'venam' ),
                'subtitle' => esc_html__( 'Select sidebar type.', 'venam' ),
                'customizer' => true,
                'id' => 'sidebar_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Select type', 'venam' ),
                    'default' => esc_html__( 'default', 'venam' ),
                    'bordered' => esc_html__( 'bordered', 'venam' )
                ),
                'default' => 'default',
                'required' => array( 'blog_sidebar_templates', '=', '' )
            ),
            array(
                'title' => esc_html__( 'Blog Page Layout', 'venam' ),
                'subtitle' => esc_html__( 'Choose the blog index page layout.', 'venam' ),
                'customizer' => true,
                'id' => 'index_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'right-sidebar'
            ),
            array(
                'title' => esc_html__( 'Single Page Layout', 'venam' ),
                'subtitle' => esc_html__( 'Choose the single post page layout.', 'venam' ),
                'customizer' => true,
                'id' => 'single_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            ),
            array(
                'title' => esc_html__( 'Default Page Layout', 'venam' ),
                'subtitle' => esc_html__( 'Choose the blog index page layout.', 'venam' ),
                'customizer' => true,
                'id' => 'page_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'right-sidebar'
            ),
            array(
                'title' => esc_html__( 'Search Page Layout', 'venam' ),
                'subtitle' => esc_html__( 'Choose the search page layout.', 'venam' ),
                'customizer' => true,
                'id' => 'search_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            ),
            array(
                'title' => esc_html__( 'Archive Page Layout', 'venam' ),
                'subtitle' => esc_html__( 'Choose the archive page layout.', 'venam' ),
                'customizer' => true,
                'id' => 'archive_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            )
    )));

    /*************************************************
    ## DEFAULT PAGE SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Default Page', 'venam' ),
        'id' => 'defaultpagesection',
        'icon' => 'el el-home',
    ));
    // BLOG HERO SUBSECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Default Page Hero', 'venam' ),
        'desc' => esc_html__( 'These are default page hero settings!', 'venam' ),
        'id' => 'pageherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Page Hero Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site default page hero section with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'page_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Page Hero Background', 'venam' ),
                'customizer' => true,
                'id' => 'page_hero_bg',
                'type' => 'background',
                'preview' => true,
                'preview_media' => true,
                'output' => array( '#nt-page-container .breadcrumb-bg' ),
                'required' => array( 'blog_hero_visibility', '=', '1' )
            )
    )));
    /*************************************************
    ## BLOG PAGE SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Blog Page', 'venam' ),
        'id' => 'blogsection',
        'icon' => 'el el-home',
    ));
    // BLOG HERO SUBSECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Blog Hero', 'venam' ),
        'desc' => esc_html__( 'These are blog index page hero text settings!', 'venam' ),
        'id' => 'blogherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Blog Hero Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page hero section with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'blog_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Blog Hero Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates instead of default template.', 'venam' ),
                'customizer' => true,
                'id' => 'blog_hero_templates',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args
            ),
            array(
                'id' =>'edit_blog_hero_elementor_template',
                'type' => 'info',
                'desc' => 'Select template',
                'required' => array(
                    array( 'blog_hero_visibility', '=', '1' ),
                    array( 'blog_hero_templates', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Blog Hero Background', 'venam' ),
                'customizer' => true,
                'id' => 'blog_hero_bg',
                'type' => 'background',
                'preview' => true,
                'preview_media' => true,
                'output' => array( '#nt-index .breadcrumb-bg' ),
                'required' => array(
                    array( 'blog_hero_visibility', '=', '1' ),
                    array( 'blog_hero_templates', '=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Blog Title', 'venam' ),
                'subtitle' => esc_html__( 'Add your blog index page title here.', 'venam' ),
                'customizer' => true,
                'id' => 'blog_title',
                'type' => 'text',
                'default' => '',
                'required' => array(
                    array( 'blog_hero_visibility', '=', '1' ),
                    array( 'blog_hero_templates', '=', '' )
                )
            ),
    )));
    // BLOG LAYOUT AND POST COLUMN STYLE
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Blog Content', 'venam' ),
        'id' => 'blogcontentsubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Container Width', 'venam' ),
                'subtitle' => esc_html__( 'Select blog page container width type.', 'venam' ),
                'customizer' => true,
                'id' => 'index_container_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Select type', 'venam' ),
                    'container' => esc_html__( 'Default Boxed', 'venam' ),
                    'container-fluid' => esc_html__( 'Fluid', 'venam' ),
                ),
                'default' => 'container'
            ),
            array(
                'title' => esc_html__( 'Layout Type', 'venam' ),
                'subtitle' => esc_html__( 'Select blog page layout type.', 'venam' ),
                'customizer' => true,
                'id' => 'index_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Select type', 'venam' ),
                    'grid' => esc_html__( 'grid', 'venam' ),
                    'masonry' => esc_html__( 'masonry', 'venam' ),
                ),
                'default' => 'grid'
            ),
            array(
                'title' => esc_html__( 'Column Width', 'venam' ),
                'subtitle' => esc_html__( 'Select a column width.', 'venam' ),
                'customizer' => true,
                'id' => 'grid_column',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Select column', 'venam' ),
                    '1' => esc_html__( '1 column', 'venam' ),
                    '2' => esc_html__( '2 column', 'venam' ),
                    '3' => esc_html__( '3 column', 'venam' )
                ),
                'default' => '1',
            ),
            array(
                'title' => esc_html__( 'Post Image Size', 'venam' ),
                'customizer' => true,
                'id' => 'post_imgsize',
                'type' => 'select',
                'data' => 'image_sizes'
            ),
            array(
                'title' => esc_html__( 'Post Title Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post title with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'post_title_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Excerpt Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post meta with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'post_excerpt_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Excerpt Size (max word count)', 'venam' ),
                'subtitle' => esc_html__( 'You can control blog post excerpt size with this option.', 'venam' ),
                'customizer' => true,
                'id' => 'excerptsz',
                'type' => 'slider',
                'default' => 30,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array( 'post_excerpt_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Button Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post read more button wityh switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'post_button_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Read More Button Title', 'venam' ),
                'subtitle' => esc_html__( 'Add your blog post read more button title here.', 'venam' ),
                'customizer' => true,
                'id' => 'post_button_title',
                'type' => 'text',
                'default' => '',
                'required' => array( 'post_button_visibility', '=', '1' )
            )
    )));

    /*************************************************
    ## SINGLE PAGE SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Single Page', 'venam' ),
        'id' => 'singlesection',
        'icon' => 'el el-home-alt',
    ));
    // SINGLE HERO SUBSECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Single Hero', 'venam' ),
        'desc' => esc_html__( 'These are single page hero section settings!', 'venam' ),
        'id' => 'singleherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Single Hero Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page hero section with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'single_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates instead of default template.', 'venam' ),
                'customizer' => true,
                'id' => 'single_hero_elementor_templates',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args,
                'required' => array( 'single_hero_visibility', '=', '1' )
            ),
            array(
                'id' =>'edit_single_hero_template',
                'type' => 'info',
                'desc' => 'Select template',
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'single_hero_elementor_templates', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Single Hero Background', 'venam' ),
                'customizer' => true,
                'id' => 'single_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-single .breadcrumb-bg' ),
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'single_hero_elementor_templates', '=', '' )
                )
            )
    )));
    // SINGLE CONTENT SUBSECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Single Content', 'venam' ),
        'id' => 'singlecontentsubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Author Name Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post date with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'single_postmeta_author_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Comments Number Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post comments number with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'single_postmeta_comments_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Date Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post date number with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'single_postmeta_date_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Tags Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post meta tags with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'single_postmeta_tags_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Authorbox Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post authorbox with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'single_post_author_box_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Post Pagination Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post next and prev pagination with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'single_navigation_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Related Post Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page related post with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'single_related_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'id' => 'related_section_heading_start',
                'type' => 'section',
                'title' => esc_html__('Related Section Heading', 'venam'),
                'customizer' => true,
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Related Section Subtitle', 'venam' ),
                'subtitle' => esc_html__( 'Add your single page related post section subtitle here.', 'venam' ),
                'customizer' => true,
                'id' => 'related_subtitle',
                'type' => 'text',
                'default' => esc_html__( 'Awesome Work', 'venam' ),
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Subtitle Tag', 'venam' ),
                'customizer' => true,
                'id' => 'related_subtitle_tag',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Select type', 'venam' ),
                    'h1' => esc_html__( 'H1', 'venam' ),
                    'h2' => esc_html__( 'H2', 'venam' ),
                    'h3' => esc_html__( 'H3', 'venam' ),
                    'h4' => esc_html__( 'H4', 'venam' ),
                    'h5' => esc_html__( 'H5', 'venam' ),
                    'h6' => esc_html__( 'H6', 'venam' ),
                    'p' => esc_html__( 'p', 'venam' ),
                    'div' => esc_html__( 'div', 'venam' ),
                    'span' => esc_html__( 'span', 'venam' ),
                ),
                'default' => 'p',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_subtitle', '!=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Related Section Title', 'venam' ),
                'subtitle' => esc_html__( 'Add your single page related post section title here.', 'venam' ),
                'customizer' => true,
                'id' => 'related_title',
                'type' => 'text',
                'default' => esc_html__( 'Related Post', 'venam' ),
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Title Tag', 'venam' ),
                'customizer' => true,
                'id' => 'related_title_tag',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Select type', 'venam' ),
                    'h1' => esc_html__( 'H1', 'venam' ),
                    'h2' => esc_html__( 'H2', 'venam' ),
                    'h3' => esc_html__( 'H3', 'venam' ),
                    'h4' => esc_html__( 'H4', 'venam' ),
                    'h5' => esc_html__( 'H5', 'venam' ),
                    'h6' => esc_html__( 'H6', 'venam' ),
                    'p' => esc_html__( 'p', 'venam' ),
                    'div' => esc_html__( 'div', 'venam' ),
                    'span' => esc_html__( 'span', 'venam' ),
                ),
                'default' => 'h3',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_title', '!=', '' )
                ),
            ),
            array(
                'id' => 'related_section_heading_end',
                'customizer' => true,
                'type' => 'section',
                'indent' => false
            ),
            array(
                'id' => 'related_section_posts_start',
                'type' => 'section',
                'title' => esc_html__('Related Post Options', 'venam'),
                'customizer' => true,
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Posts Perpage', 'venam' ),
                'subtitle' => esc_html__( 'You can control related post count with this option.', 'venam' ),
                'customizer' => true,
                'id' => 'related_perpage',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 24,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Post Image Size', 'venam' ),
                'customizer' => true,
                'id' => 'related_imgsize',
                'type' => 'select',
                'data' => 'image_sizes',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Post Excerpt Display', 'venam' ),
                'id' => 'related_excerpt_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Post Excerpt Limit', 'venam' ),
                'subtitle' => esc_html__( 'You can control related post excerpt word limit.', 'venam' ),
                'customizer' => true,
                'id' => 'related_excerpt_limit',
                'type' => 'slider',
                'default' => 30,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_excerpt_visibility', '=', '1' ),
                )
            ),
            array(
                'id' => 'related_section_posts_end',
                'customizer' => true,
                'type' => 'section',
                'indent' => false
            ),
            array(
                'id' => 'related_section_slider_start',
                'type' => 'section',
                'title' => esc_html__('Related Slider Options', 'venam'),
                'customizer' => true,
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 1200px )', 'venam' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'venam' ),
                'customizer' => true,
                'id' => 'related_perview',
                'type' => 'slider',
                'default' => 5,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Slider Perview ( Min 992px )', 'venam' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'venam' ),
                'customizer' => true,
                'id' => 'related_mdperview',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 768px )', 'venam' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'venam' ),
                'customizer' => true,
                'id' => 'related_smperview',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 480px )', 'venam' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'venam' ),
                'customizer' => true,
                'id' => 'related_xsperview',
                'type' => 'slider',
                'default' => 2,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Speed', 'venam' ),
                'subtitle' => esc_html__( 'You can control related post slider item gap.', 'venam' ),
                'customizer' => true,
                'id' => 'related_speed',
                'type' => 'slider',
                'default' => 1000,
                'min' => 100,
                'step' => 1,
                'max' => 10000,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Gap', 'venam' ),
                'subtitle' => esc_html__( 'You can control related post slider item gap.', 'venam' ),
                'customizer' => true,
                'id' => 'related_gap',
                'type' => 'slider',
                'default' => 30,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Centered', 'venam' ),
                'customizer' => true,
                'id' => 'related_centered',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Autoplay', 'venam' ),
                'customizer' => true,
                'id' => 'related_autoplay',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Loop', 'venam' ),
                'customizer' => true,
                'id' => 'related_loop',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Mousewheel', 'venam' ),
                'customizer' => true,
                'id' => 'related_mousewheel',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'id' => 'related_section_slider_end',
                'customizer' => true,
                'type' => 'section',
                'indent' => false
            )
    )));
    /*************************************************
    ## ARCHIVE PAGE SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Archive Page', 'venam' ),
        'id' => 'archivesection',
        'icon' => 'el el-folder-open',
    ));
    // ARCHIVE PAGE SECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Archive Hero', 'venam' ),
        'desc' => esc_html__( 'These are archive page hero settings!', 'venam' ),
        'id' => 'archiveherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Archive Hero Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site archive page hero section with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'archive_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Archive Hero Background', 'venam' ),
                'customizer' => true,
                'id' => 'archive_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-archive .breadcrumb-bg' ),
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Custom Archive Title', 'venam' ),
                'subtitle' => esc_html__( 'Add your custom archive page title here.', 'venam' ),
                'customizer' => true,
                'id' => 'archive_title',
                'type' => 'text',
                'default' =>'',
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
    )));
    /*************************************************
    ## 404 PAGE SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( '404 Page', 'venam' ),
        'id' => 'errorsection',
        'icon' => 'el el-error',
        'fields' => array(
            array(
                'title' => esc_html__( '404 Type', 'venam' ),
                'subtitle' => esc_html__( 'Select your 404 page type.', 'venam' ),
                'customizer' => true,
                'id' => 'error_page_type',
                'type' => 'select',
                'options' => array(
                    'default' => esc_html__( 'Deafult', 'venam' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'venam' ),
                ),
                'default' => 'default'
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'venam' ),
                'customizer' => true,
                'id' => 'error_page_elementor_templates',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args,
                'required' => array( 'error_page_type', '=', 'elementor' )
            ),
            array(
                'id' =>'edit_error_page_template',
                'type' => 'info',
                'desc' => 'Edit template',
                'required' => array(
                    array( 'error_page_type', '=', 'elementor' ),
                    array( 'error_page_elementor_templates', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( '404 Header Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page header with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'error_header_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'elementor' )
            ),
            array(
                'title' => esc_html__( '404 Footer Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page footer with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'error_footer_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'elementor' )
            ),
            array(
                'title' => esc_html__( '404 Hero Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page hero section with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'error_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( '404 Hero Background', 'venam' ),
                'customizer' => true,
                'id' => 'error_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-archive .breadcrumb-bg' ),
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_hero_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Custom 404 Title', 'venam' ),
                'subtitle' => esc_html__( 'Add your custom 404 page title here.', 'venam' ),
                'customizer' => true,
                'id' => 'error_title',
                'type' => 'text',
                'default' =>'',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_hero_visibility', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Content Description Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content description with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'error_content_desc_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Content Description', 'venam' ),
                'subtitle' => esc_html__( 'Add your 404 page content description here.', 'venam' ),
                'customizer' => true,
                'id' => 'error_content_desc',
                'type' => 'textarea',
                'default' => 'Sorry, but the page you are looking for does not exist or has been removed',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_desc_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Button Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content back to home button with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'error_content_btn_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Button Title', 'venam' ),
                'subtitle' => esc_html__( 'Add your 404 page content back to home button title here.', 'venam' ),
                'customizer' => true,
                'id' => 'error_content_btn_title',
                'type' => 'text',
                'default' => 'Go to home page',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_btn_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Search Form Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content search form with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'error_content_form_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            )
    )));
    /*************************************************
    ## SEARCH PAGE SECTION
    *************************************************/
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Search Page', 'venam' ),
        'id' => 'searchsection',
        'icon' => 'el el-search',
    ));
    //SEARCH PAGE SECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Search Hero', 'venam' ),
        'id' => 'searchherosubsection',
        'desc' => esc_html__( 'These are main settings for general theme!', 'venam' ),
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Search Hero Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site search page hero section with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'search_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Search Hero Background', 'venam' ),
                'customizer' => true,
                'id' =>'search_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-search .breadcrumb-bg' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            )
    )));
    //FOOTER SECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Footer', 'venam' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'venam' ),
        'id' => 'footersection',
        'icon' => 'el el-photo',
        'fields' => array(
            array(
                'title' => esc_html__( 'Footer Section Display', 'venam' ),
                'subtitle' => esc_html__( 'You can enable or disable the site footer copyright and footer widget area on the site with switch option.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Footer Type', 'venam' ),
                'subtitle' => esc_html__( 'Select your footer type.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_template',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult Site Footer', 'venam' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'venam' ),
                ),
                'default' => 'default',
                'required' => array( 'footer_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'venam' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_elementor_templates',
                'type' => 'select',
                'data' => 'posts',
                'args'  => $el_args,
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'elementor' )
                )
            ),
            array(
                'id' =>'edit_footer_template',
                'type' => 'info',
                'desc' => 'Edit template',
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'elementor' ),
                    array( 'footer_elementor_templates', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Text', 'venam' ),
                'subtitle' => esc_html__( 'HTML allowed (wp_kses)', 'venam' ),
                'desc' => esc_html__( 'Enter your site copyright text here.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_copyright',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => sprintf( '<p>&copy; %1$s, <a class="theme" href="%2$s">%3$s</a> Theme. %4$s <a class="dev" href="https://ninetheme.com/contact/">%5$s</a></p>',
                    date( 'Y' ),
                    esc_url( home_url( '/' ) ),
                    get_bloginfo( 'name' ),
                    esc_html__( 'Made with passion by', 'venam' ),
                    esc_html__( 'Ninetheme.', 'venam' )
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'default' )
                )
            ),
            //information on-off
            array(
                'id' =>'info_f0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'venam' ),
                'icon' => 'el el-info-circle',
                'customizer' => true,
                'desc' => sprintf(esc_html__( '%s section is disabled on the site.Please activate to view subsection options.', 'venam' ), '<b>Site Main Footer</b>' ),
                'required' => array( 'footer_visibility', '=', '0' )
            )
    )));
    //FOOTER SECTION
    Redux::setSection($venam_pre, array(
        'title' => esc_html__( 'Footer Style', 'venam' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'venam' ),
        'id' => 'footerstylesubsection',
        'icon' => 'el el-photo',
        'subsection' => true,
        'fields' => array(
            array(
                'id' =>'footer_color_customize',
                'type' => 'info',
                'icon' => 'el el-brush',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s', 'venam' ), '<h2>Footer Color Customize</h2>' ),
                'customizer' => true,
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Footer Padding', 'venam' ),
                'subtitle' => esc_html__( 'You can set the top spacing of the site main footer.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_pad',
                'type' => 'spacing',
                'output' => array('#nt-footer' ),
                'mode' => 'padding',
                'units' => array('em', 'px' ),
                'units_extended' => 'false',
                'default' => array(
                    'padding-top' => '',
                    'padding-right' => '',
                    'padding-bottom' => '',
                    'padding-left' => '',
                    'units' => 'px'
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Footer Background Color', 'venam' ),
                'desc' => esc_html__( 'Set your own colors for the footer.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_bg_clr',
                'type' => 'color',
                'validate' => 'color',
                'mode' => 'background-color',
                'output' => array( '#nt-footer' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Text Color', 'venam' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_copy_clr',
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer, #nt-footer p' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Link Color', 'venam' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_link_clr',
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer a' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Link Color ( Hover )', 'venam' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'venam' ),
                'customizer' => true,
                'id' => 'footer_link_hvr_clr',
                'type' => 'color',
                'validate' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer a:hover' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_template', '=', 'default' )
                )
            ),
            //information on-off
            array(
                'id' =>'info_fc0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'venam' ),
                'icon' => 'el el-info-circle',
                'customizer' => true,
                'desc' => sprintf(esc_html__( '%s section is disabled on the site.Please activate to view subsection options.', 'venam' ), '<b>Site Main Footer</b>' ),
                'required' => array( 'footer_visibility', '=', '0' )
            )
    )));

    Redux::setSection($venam_pre, array(
        'id' => 'inportexport_settings',
        'title' => esc_html__( 'Import / Export', 'venam' ),
        'desc' => esc_html__( 'Import and Export your Theme Options from text or URL.', 'venam' ),
        'icon' => 'fa fa-download',
        'fields' => array(
            array(
                'id' => 'opt-import-export',
                'type' => 'import_export',
                'title' => '',
                'customizer' => false,
                'subtitle' => '',
                'full_width' => true
            )
    )));
    Redux::setSection($venam_pre, array(
    'id' => 'nt_support_settings',
    'title' => esc_html__( 'Support', 'venam' ),
    'icon' => 'el el-idea',
    'fields' => array(
        array(
            'id' => 'doc',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'WE RECOMMEND YOU READ IT BEFORE YOU START', 'venam' ).'</h5>
            <h2><i class="el el-website"></i> '.esc_html__( 'DOCUMENTATION', 'venam' ).'</h2>
            <a target="_blank" class="button" href="https://ninetheme.com/docs/venam/">'.esc_html__( 'READ MORE', 'venam' ).'</a>
            </div>'
        ),
        array(
            'id' => 'support',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'DO YOU NEED HELP?', 'venam' ).'</h5>
            <h2><i class="el el-adult"></i> '.esc_html__( 'SUPPORT CENTER', 'venam' ).'</h2>
            <a target="_blank" class="button" href="https://ninetheme.com/contact/">'.esc_html__( 'GET SUPPORT', 'venam' ).'</a>
            </div>'
        ),
        array(
            'id' => 'portfolio',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'SEE MORE THE NINETHEME WORDPRESS THEMES', 'venam' ).'</h5>
            <h2><i class="el el-picture"></i> '.esc_html__( 'NINETHEME PORTFOLIO', 'venam' ).'</h2>
            <a target="_blank" class="button" href="https://ninetheme.com/themes/">'.esc_html__( 'SEE MORE', 'venam' ).'</a>
            </div>'
        ),
        array(
            'id' => 'like',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'WOULD YOU LIKE TO REWARD OUR EFFORT?', 'venam' ).'</h5>
            <h2><i class="el el-thumbs-up"></i> '.esc_html__( 'PLEASE RATE US!', 'venam' ).'</h2>
            <a target="_blank" class="button" href="https://themeforest.net/downloads/">'.esc_html__( 'GET STARS', 'venam' ).'</a>
            </div>'
        )
    )));
    /*
     * <--- END SECTIONS
     */


    /** Action hook examples **/

    function venam_remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin' )) {
            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ));
        }
    }
    //include get_template_directory() . '/inc/core/theme-options/redux-extensions/loader.php';
    function venam_newIconFont() {
        // Uncomment this to remove elusive icon from the panel completely
        // wp_deregister_style( 'redux-elusive-icon' );
        // wp_deregister_style( 'redux-elusive-icon-ie7' );
        wp_register_style(
            'redux-font-awesome',
            '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
            array(),
            time(),
            'all'
        );
        wp_enqueue_style( 'redux-font-awesome' );
    }
    add_action( 'redux/page/venam/enqueue', 'venam_newIconFont' );
