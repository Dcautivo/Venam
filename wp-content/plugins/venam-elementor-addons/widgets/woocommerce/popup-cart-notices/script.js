'use strict';

(function($) {

  $(document.body).on('added_to_cart updated_cart_totals', function(e) {

        //jQuery('.venam-popup-notices').removeClass('slide-in');
        if ( jQuery('.venam-popup-notices').length ) {
            setTimeout(function() {
                //jQuery('.venam-popup-notices').removeClass('slide-in');
            }, 4000);
        }
  });

})(jQuery);
