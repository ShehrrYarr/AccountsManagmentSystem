/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Blog init js
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

var myDropzoneMain = document.getElementById('my-dropzone');
if (myDropzoneMain) {
    // Disable auto discover for all elements
    Dropzone.autoDiscover = false;

    // Create a new Dropzone
    const myDropzone = new Dropzone("#my-dropzone", {
        url: "/file-upload", // Change this to your server endpoint
        maxFilesize: 2, // MB
        acceptedFiles: ".jpg,.jpeg,.png,.gif",
        init: function () {
            this.on("success", function (file, response) {
                console.log("File uploaded successfully:", response);
            });

            this.on("error", function (file, errorMessage) {
                console.error("File upload error:", errorMessage);
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    let blogChoice = document.getElementById('blog-choice');
    if (blogChoice) {
        const choices = new Choices('#blog-choice', {
            placeholderValue: 'Select options',
            searchPlaceholderValue: 'Search...',
            removeItemButton: true,
            itemSelectText: 'Press to select',
        });
    }
});

let choicesMultiple = document.getElementById('choices-multiple-close-icon');
if (choicesMultiple) {
    const choicesMultiple = new Choices('#choices-multiple-close-icon', {
        placeholderValue: 'Select an option',
        searchPlaceholderValue: 'Search...',
        removeItemButton: true,
        placeholderValue: 'Add items...',
    });
}

let basicTimePicker = document.getElementById('basic-time-picker');
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
if (basicTimePicker) {
    new AirDatepicker(basicTimePicker, {
        locale: localeEn
    });
}

var myDropzoneMain = document.getElementById('product-editor');
if (myDropzoneMain) {
    new Dropzone(myDropzoneMain, {
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

let glightboxElement = document.getElementsByClassName('.lightbox')[0];
if (glightboxElement) {
    var lightbox = GLightbox({
        selector: '.lightbox',
        title: false,
    });
}
