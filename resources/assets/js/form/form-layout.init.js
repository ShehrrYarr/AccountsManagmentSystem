/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Form Layout Js File
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

new AirDatepicker('#formLayout1-dob', {
    locale: localeEn
});

// Initialize Choice.js
const stateSelect = new Choices('#stateSelectLayout1', {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: 'Select State',
});

new AirDatepicker('#formLayout2-dob');

// Initialize Choice.js
const stateSelect2 = new Choices('#stateSelectLayout2', {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: 'Select State',
});

new AirDatepicker('#dateOfBirthLayout3', {
    locale: localeEn
});

new AirDatepicker('#dateOfBirthLayout4', {
    locale: localeEn
});

// Initialize Choice.js
const stateSelect3 = new Choices('#stateSelect2Layout3', {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: 'Select State',
});
// Initialize Choice.js
const stateSelect2Layout4 = new Choices('#stateSelect2Layout4', {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: 'Select State',
});
// Initialize Choice.js
const stateSelect2Layout5 = new Choices('#stateSelect2Layout5', {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: 'Select State',
});
// Initialize Choice.js
const stateSelect2Layout6 = new Choices('#stateSelect2Layout6', {
    searchEnabled: false,
    placeholder: true,
    placeholderValue: 'Select State',
});
