(function ($) {
    "use strict";

    $(document).on('venamShopInit', function () {
        venamWcProductCats();
    });

    function venamWcProductCats() {

        $('.widget_venam_product_categories ul.children input[checked]').closest('li.cat-parent').addClass("current-cat");

        $(".subDropdown").on("click", function() {
            $(this).toggleClass("plus"),
            $(this).toggleClass("minus");
            
            $(this).parent().addClass("current-cat");
            $(this).parent().find(">ul").slideToggle();
        });
    }

    $(document).ready(function() {
        venamWcProductCats();
    });

})(jQuery);
