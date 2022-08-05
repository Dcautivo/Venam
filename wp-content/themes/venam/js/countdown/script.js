jQuery(document).ready(function($) {

    /*-- Strict mode enabled --*/
    'use strict';
    // countdown
    $('[data-countdown]').each(function () {
        var $this = $(this),
            data = $this.data('countdown'),
            finalDate = data.date,
            hr = data.hr,
            min = data.min,
            sec = data.sec;
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('<div class="time-count day"><span>%D</span>Day</div><div class="time-count hour"><span>%H</span>'+hr+'</div><div class="time-count min"><span>%M</span>'+min+'</div><div class="time-count sec"><span>%S</span>'+sec+'</div>'));
        });
    });
});
