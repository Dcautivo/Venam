jQuery(document).ready(function(o){
    "use strict";

    var t,a,
    headerid = o('#header_elementor_templates-select'),
    headertemp = o('#info-edit_header_elementor_template .redux-info-desc'),
    sidebarid = o('#blog_sidebar_templates-select'),
    sidebartemp = o('#info-edit_sidebar_elementor_template .redux-info-desc'),
    blog_heroid = o('#blog_hero_templates-select'),
    blog_herotemp = o('#info-edit_blog_hero_elementor_template .redux-info-desc'),
    single_heroid = o('#single_hero_elementor_templates-select'),
    single_herotemp = o('#info-edit_single_hero_template .redux-info-desc'),
    error_pageid = o('#error_page_elementor_templates-select'),
    error_pagetemp = o('#info-edit_error_page_template .redux-info-desc'),
    footerid = o('#footer_elementor_templates-select'),
    footertemp = o('#info-edit_footer_template .redux-info-desc'),

    href = window.location.href,
    index = href.indexOf('/wp-admin'),
    homeUrl = href.substring(0, index);

    if( headerid.val() !== '' ) {
        headertemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+headerid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
    }
    headerid.on('change', function(){
        if ( headerid.val() !== '' ) {
            headertemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+headerid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
        }
    });
    if( sidebarid.val() !== '' ) {
        sidebartemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+sidebarid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
    }
    sidebarid.on('change', function(){
        if ( sidebarid.val() !== '' ) {
            sidebartemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+sidebarid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
        }
    });
    if( blog_heroid.val() !== '' ) {
        blog_herotemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+blog_heroid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
    }
    blog_heroid.on('change', function(){
        if ( blog_heroid.val() !== '' ) {
            blog_herotemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+blog_heroid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
        }
    });
    if( single_heroid.val() !== '' ) {
        single_herotemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+single_heroid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
    }
    single_heroid.on('change', function(){
        if ( single_heroid.val() !== '' ) {
            single_herotemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+single_heroid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
        }
    });
    if( error_pageid.val() !== '' ) {
        error_pagetemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+error_pageid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
    }
    error_pageid.on('change', function(){
        if ( error_pageid.val() !== '' ) {
            error_pagetemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+error_pageid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
        }
    });
    if( footerid.val() !== '' ) {
        footertemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+footerid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
    }
    footerid.on('change', function(){
        if ( footerid.val() !== '' ) {
            footertemp.html( '<a class="thm-btn" href="'+homeUrl+'/wp-admin/post.php?post='+footerid.val()+'&action=elementor" target="_blank">Edit Template <i class="el el-arrow-right"></i></a>' );
        }
    });

    o(".venam-color-field").wpColorPicker(),
    o("#menu-to-edit").on("click",".item-edit",function(e){
        var t=o(this).closest(".menu-item").find(".venam-color-field");
        t.hasClass("wp-color-field")||t.wpColorPicker()
    }),

    o("body").hasClass("nav-menus-php")&&(window.onbeforeunload=null),
    o("#menu-to-edit").on("click",".upload_image_button",function(e){
        var a=o(this);
        e.preventDefault();
        var r=wp.media({multiple:!1}).open().on("select",function(e){
            var t=r.state().get("selection").first().toJSON();
            if ( a.parent().find(".image-preview-wrapper .image-preview") ){
                a.parent().find(".image-preview").remove();
                a.parent().find(".image-preview-wrapper").append('<img class="image-preview" src="'+t.url+'" />');
            } else {
                a.parent().find(".image-preview-wrapper").append('<img class="image-preview" src="'+t.url+'" />');
            }
            a.parent().find(".image_attachment_id").val(t.id),
            a.parent().find(".remove_image_button").show()
        })
    }),

    o("#menu-to-edit").on("click",".remove_image_button",function(e){
        o(this).parent().find(".image-preview").remove(),
        o(this).parent().find(".image_attachment_id").val(""),
        o(this).hide()
    }),
    o(".remove_image_button").each(function(){
        ""!=o(this).parent().find(".image_attachment_id").val()&&o(this).show()
    });

});
