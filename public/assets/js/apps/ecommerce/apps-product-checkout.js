/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Product checkout init js
*/

document.addEventListener('DOMContentLoaded', function () {

    var contactNumber = document.getElementById('contact-number');
    if (contactNumber) {
        new Cleave(contactNumber, {
            delimiters: [' ', '-'],
            blocks: [3, 3, 3, 4], // Format: +xx xxx xxx xxxx
            prefix: '+91',
            numericOnly: true // Ensures only numeric characters can be entered
        });
    }

    var productCountry = document.getElementById('product-country');
    if (productCountry) {
        new Choices(productCountry, {
            placeholder: false, // Ensure no placeholder is shown
            itemSelectText: false,
            searchPlaceholderValue: 'Search results here',
        });
    }

    var newAddressCountry = document.getElementById('modalAddressCountry');
    if (newAddressCountry) {
        new Choices(newAddressCountry, {
            placeholder: false, // Ensure no placeholder is shown
            itemSelectText: false,
            searchPlaceholderValue: 'Search results here',
        });
    }

    var newCardMonth = document.getElementById('new-card-month');
    if (newCardMonth) {
        new Choices(newCardMonth, {
            searchEnabled: false,
            placeholder: true,
            placeholderValue: 'Month',
            itemSelectText: false,
        });
    }

    var newCardYear = document.getElementById('new-card-year');
    if (newCardYear) {
        new Choices(newCardYear, {
            searchEnabled: false,
            placeholder: true,
            placeholderValue: 'Year',
            itemSelectText: false,
        });
    }

    var newCardMonth = document.getElementById('edit-card-month');
    if (newCardMonth) {
        new Choices(newCardMonth, {
            searchEnabled: false,
            placeholder: true,
            placeholderValue: 'Month',
            itemSelectText: false,
        });
    }

    var newCardYear = document.getElementById('edit-card-year');
    if (newCardYear) {
        new Choices(newCardYear, {
            searchEnabled: false,
            placeholder: true,
            placeholderValue: 'Year',
            itemSelectText: false,
        });
    }
});
