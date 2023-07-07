// npm package: flatpickr
// github link: https://github.com/flatpickr/flatpickr

$(function() {
  'use strict';

  // date picker
  if($('#flatpickr-date').length) {
    flatpickr("#flatpickr-date", {
      wrap: true,
      dateFormat: "Y-m-d",
      /*
        *custom edit
        */
        minDate: "today",
        "disable": [
            function(date) {
            // return true to disable
            return (date.getDay() === 0 || date.getDay() === 6);

            }
        ],
        "locale": {
            "firstDayOfWeek": 1 // start week on Monday
        },

    });
  }


  // time picker
  if($('#flatpickr-time').length) {
    flatpickr("#flatpickr-time", {
      wrap: true,
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
    });
  }

});
