/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Profile init js
*/

document.addEventListener('DOMContentLoaded', function () {
    // Initialize Choices.js without search

    const defaultChoiceEl = document.getElementById('default-choice');
    if (defaultChoiceEl) {
        new Choices(defaultChoiceEl, {
            searchEnabled: false,
            placeholder: false, // Ensure no placeholder is shown
            itemSelectText: false,
        });
    }

    const myConnectionsEl = document.getElementById('my_connections');
    if (myConnectionsEl) {
        new Choices(myConnectionsEl, {
            searchEnabled: false,
            placeholder: false, // Ensure no placeholder is shown
            itemSelectText: false,
        });
    }

    const languageEl = document.getElementById('language');
    if (languageEl) {
        new Choices(languageEl, {
            searchEnabled: false,
            placeholder: false, // Ensure no placeholder is shown
            itemSelectText: false,
        });
    }

});

document.addEventListener("DOMContentLoaded", function () {
    const uploaders = document.querySelectorAll('[data-uploader]');

    uploaders.forEach(uploader => {
        const img = uploader.querySelector('[data-action="avatar-image"]');
        const fileInput = uploader.querySelector('[data-action="file-input"]');
        const chooseFileBtn = uploader.querySelector('[data-action="choose-file"]');

        // Set the default image on load
        img.src = img.dataset.defaultSrc;

        // Event listener for choosing a file
        chooseFileBtn.addEventListener('click', function () {
            fileInput.click();
        });

        // Event listener for file input change
        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    img.src = e.target.result; // Update the image source to the uploaded file
                };
                reader.readAsDataURL(file); // Convert the file to a Data URL
            }
        });
    });
});
