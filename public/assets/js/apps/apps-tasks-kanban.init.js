/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Apps tasks kanban init js
*/

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    // Initialize Sortable.js for the card container
    const sortable = new Sortable(document.getElementById('sortable-container'), {
        animation: 150,
        ghostClass: 'sortable-ghost',  // Class for the placeholder while dragging
        chosenClass: 'sortable-chosen', // Class for the dragged item
        handle: '.card-move',         // Drag handle, only card headers are draggable
    });

    const containers = [
        'multiple-containers01',
        'multiple-containers02',
        'multiple-containers03',
        'multiple-containers04',
        'multiple-containers05',
        'multiple-containers06',
        'multiple-containers07',
        'multiple-containers08',
        'multiple-containers09',
        'multiple-containers10',
        'multiple-containers11'
    ];

    containers.forEach(containerId => {
        new Sortable(document.getElementById(containerId), {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            // handle: '.card-move',
            group: 'shared',
        });
    });

    let glightboxElement = document.getElementsByClassName('.lightbox');
    if (glightboxElement) {
        var lightbox = GLightbox({
            selector: '.lightbox',
            title: false,
        });
    }

    // Get all checkbox elements
    const checkboxes = document.querySelectorAll('li .form-check-input');

    // Loop through each checkbox and add event listener
    checkboxes.forEach(checkbox => {
        const label = checkbox.nextElementSibling;
        checkbox.addEventListener('change', function () {
            if (label) {
                label.style.textDecoration = this.checked ? 'line-through' : 'none';
            }
        });
        if (label) {
            label.style.textDecoration = checkbox.checked ? 'line-through' : 'none';
        }
    });

});
