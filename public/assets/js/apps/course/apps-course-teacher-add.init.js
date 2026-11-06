/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Teacher Create init js
*/

let selectClient = document.getElementById('select-gender');
if (selectClient) {
    new Choices(selectClient, {
        removeItemButton: true,
        placeholderValue: 'Select Gender',
        searchEnabled: false,
        itemSelectText: false,
    });
}

let selectStatus = document.getElementById('selectStatus');
if (selectStatus) {
    new Choices(selectStatus, {
        removeItemButton: true,
        placeholderValue: 'Select Status',
        searchEnabled: false,
        itemSelectText: false,
    });
}

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

let joiningDate = document.getElementById('joining-date');
if (joiningDate) {
    new AirDatepicker(joiningDate, {
        locale: localeEn
    });
}
let dateOfBirth = document.getElementById('date-of-birth');
if (dateOfBirth) {
    new AirDatepicker(dateOfBirth, {
        locale: localeEn
    });
}
