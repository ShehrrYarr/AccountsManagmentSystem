/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: File Upload Js File
*/

// File Upload
document.addEventListener("DOMContentLoaded", function () {
    const uploaders = document.querySelectorAll('[data-uploader]');

    uploaders.forEach(uploader => {
        const img = uploader.querySelector('[data-action="avatar-image"]');
        const fileInput = uploader.querySelector('[data-action="file-input"]');
        const chooseFileBtn = uploader.querySelector('[data-action="choose-file"]');
        const deleteBtn = uploader.querySelector('[data-action="delete-image"]');

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

        // Event listener for deleting the image
        deleteBtn.addEventListener('click', function () {
            img.src = img.dataset.defaultSrc; // Reset to default image
            fileInput.value = ""; // Clear the file input
        });
    });
});

var myDropzoneMain = document.getElementById('demo-editor');
if (myDropzoneMain) {

    var dropzone = new Dropzone(myDropzoneMain, {
        url: 'https://httpbin.org/post',
        method: "post",
        previewTemplate: document.querySelector("#dropzone-preview-list").innerHTML,
        previewsContainer: "#dropzone-preview",
        paramName: "file",
        maxFilesize: 2,
        acceptedFiles: "image/*,application/pdf",
        dictDefaultMessage: "Drop files here or click to upload.",
        dictInvalidFileType: "You can't upload files of this type.",
        dictFileTooBig: "File is too big ({{filesize}}MB). Max filesize: {{maxFilesize}}MB",
        hiddenInput: true,
        init: function () {
            this.on("success", function (file, response) {
                var errorContainer = file.previewElement.querySelector(".dz-error-container");
                var progressBar = file.previewElement.querySelector(".dz-progress");

                if (errorContainer) {
                    errorContainer.style.display = "none";
                }

                if (progressBar) {
                    progressBar.style.display = "block";
                }
            });

            this.on("error", function (file, errorMessage) {
                var errorContainer = file.previewElement.querySelector(".dz-error-container");
                var progressBar = file.previewElement.querySelector(".dz-progress");

                if (errorContainer) {
                    errorContainer.style.display = "block";
                    errorContainer.querySelector("[data-dz-errormessage]").textContent = errorMessage; // Set the error message
                }

                if (progressBar) {
                    progressBar.style.display = "none";
                }
            });

            this.on("uploadprogress", function (file, progress) {
                var progressElement = file.previewElement.querySelector("[data-dz-uploadprogress]");
                if (progressElement) {
                    progressElement.style.width = progress + "%";
                    progressElement.setAttribute("aria-valuenow", progress);
                }
            });
        }
    });
}
