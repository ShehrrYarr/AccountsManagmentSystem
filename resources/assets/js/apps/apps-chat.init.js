/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Chat init js
*/

document.addEventListener('DOMContentLoaded', function () {
    // Initialize Choices.js without search
    const choices = new Choices('#default-choice', {
        searchEnabled: false,
        placeholder: false, // Ensure no placeholder is shown
        itemSelectText: false,
    });

    let glightboxElement = document.getElementsByClassName('.lightbox');
    if (glightboxElement) {
        GLightbox({
            selector: '.lightbox',
            title: false,
        });
    }
});
