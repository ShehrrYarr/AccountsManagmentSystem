// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Create Task init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

  // Default Datepicker
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
  new AirDatepicker('#basic-date-picker', {
    locale: localeEn
  });

  new Choices('#creat-task-projects', {
    searchEnabled: true,
    placeholderValue: 'Select Project',
    searchPlaceholderValue: 'Search Projects...',
    placeholder: true,
    itemSelectText: false,
  });

  new Choices('#creat-task-status-select', {
    searchEnabled: false,
    placeholderValue: 'Select Status',
    placeholder: true,
    itemSelectText: false,
  });

  new Choices('#creat-task-priority-select', {
    searchEnabled: false,
    placeholderValue: 'Select Priority',
    placeholder: true,
    itemSelectText: false,
  });

});
