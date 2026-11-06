/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Project Create init js
*/

let createBlogEditor = document.getElementById('createBlogEditor');
if (createBlogEditor) {
    // Initialize Quill editor
    const snowEditor = new Quill('#createBlogEditor', {
        theme: 'snow', // Using snow theme
        modules: {
            toolbar: true,
        },
        placeholder: 'Compose your content here...',
    });
}

let choicesMultiple = document.getElementById('project-team-leader');
if (choicesMultiple) {
    new Choices(choicesMultiple, {
        removeItemButton: true,
        placeholderValue: 'Select Team Leader',
        searchEnabled: false,
        itemSelectText: false,
    });
}
let projectTerms = document.getElementById('project-terms');
if (projectTerms) {
    new Choices(projectTerms, {
        removeItemButton: true,
        placeholderValue: 'Select Terms',
        searchEnabled: false,
        itemSelectText: false,
    });
}

let projectMilestone = document.getElementById('project-milestone');
if (projectMilestone) {
    new Choices(projectMilestone, {
        removeItemButton: true,
        placeholderValue: 'Select Milestone',
        searchEnabled: false,
        itemSelectText: false,
    });
}

let selectClient = document.getElementById('select-client');
if (selectClient) {
    new Choices(selectClient, {
        removeItemButton: true,
        placeholderValue: 'Select Client',
        searchEnabled: false,
        itemSelectText: false,
    });
}

let projectPriority = document.getElementById('project-priority');
if (projectPriority) {
    new Choices(projectPriority, {
        removeItemButton: true,
        placeholderValue: 'Select Priority',
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

let projectStartDate = document.getElementById('project-start-date');
if (projectStartDate) {
    new AirDatepicker(projectStartDate, {
        locale: localeEn
    });
}

let projectEndDate = document.getElementById('project-end-date');
if (projectEndDate) {
    new AirDatepicker(projectEndDate, {
        locale: localeEn
    });
}
