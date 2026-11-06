// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Create Invoice init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    new AirDatepicker('#issuedDate');
    new AirDatepicker('#dueDate');

    const paymentMethodSelect = new Choices('#paymentMethod', {
        searchEnabled: false,
        itemSelectText: false,
    });

    const paymentStatus = new Choices('#paymentStatus', {
        searchEnabled: false,
        itemSelectText: false,
    });

    if (paymentStatus && paymentMethodSelect) {
        const paymentMethodInputs = document.querySelectorAll('.choices .choices__inner');
        paymentMethodInputs.forEach(input => {
            input.classList.add('form-select-sm', 'fs-13', 'bg-light', 'w-150px');
        });
    }

    new Cleave('#billNumber', {
        delimiters: ['+', ' (', ') ', '-', '-'],
        blocks: [0, 1, 3, 3, 4],
    });

    new Cleave('#shipNumber', {
        delimiters: ['+', ' (', ') ', '-', '-'],
        blocks: [0, 1, 3, 3, 4],
    });

});
