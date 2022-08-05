'use strict';

(function($) {
  $(function() {
    woosq_view_type();

    $('.woosq-summary').sortable({
      handle: '.label',
    });
  });

  $(document).on('change', 'select[name="woosq_view"]', function() {
    woosq_view_type();
  });

  function woosq_view_type() {
    var type = $('select[name="woosq_view"]').val();

    $('.woosq_view_type').hide();
    $('.woosq_view_type_' + type).show();
  }
})(jQuery);