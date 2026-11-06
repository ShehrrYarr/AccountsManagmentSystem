/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: air-datepicker js
*/

const localeEn = {
    days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    today: 'Today',
    clear: 'Clear',
    dateFormat: 'mm/dd/yyyy',
    timeFormat: 'hh:ii aa',
    firstDay: 0
}

// modal picker
new AirDatepicker('#modal-date-picker', {
    locale: localeEn
});

// Default Datepicker
new AirDatepicker('#basic-date-picker', {
    locale: localeEn
});

// Inline Datepicker
new AirDatepicker('#inline-date-picker', {
    inline: true,
    locale: localeEn
})

// Selected Date
new AirDatepicker('#select-date-picker', {
    selectedDates: [new Date()],
    locale: localeEn
})

// Month Selection
new AirDatepicker('#month-picker', {
    view: 'months',
    minView: 'months',
    dateFormat: 'MMMM yyyy',
    autoClose: false,
    locale: localeEn
})

// Multiple Date Selection
new AirDatepicker('#mobile-auto-close-picker', {
    isMobile: true,
    autoClose: true,
    locale: localeEn
})

// Positioning
new AirDatepicker('#position-picker', {
    position: 'right center',
    locale: localeEn
})

// Positioning
new AirDatepicker('#range-picker', {
    range: true,
    multipleDatesSeparator: ' - ',
    locale: localeEn
})

// Time Picker
new AirDatepicker('#timepicker-picker', {
    timepicker: true,
    locale: localeEn
})

// Time format
new AirDatepicker('#time-format', {
    timepicker: true,
    timeFormat: 'hh:mm AA',
    locale: localeEn
})
