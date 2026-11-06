/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Product Create init js
*/

document.addEventListener('DOMContentLoaded', function () {

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

    let productDescEditor = document.getElementById('product-desc');
    if (productDescEditor) {
        // Initialize Quill editor
        const snowEditor = new Quill(productDescEditor, {
            theme: 'snow', // Using snow theme
            modules: {
                toolbar: true,
            },
            placeholder: 'Type your text here...',
        });
    }

    let choicesMultiple = document.getElementById('product-tax');
    if (choicesMultiple) {
        new Choices(choicesMultiple, {
            // removeItemButton: true,
            placeholderValue: 'Select Tax',
            searchEnabled: false,
            itemSelectText: false,
        });
    }

    let productVariations = document.getElementById('product-variations');
    if (productVariations) {
        new Choices(productVariations, {
            // removeItemButton: true,
            placeholderValue: 'Select Tax',
            searchEnabled: false,
            itemSelectText: false,
        });
    }

    let metaKeyword = document.getElementById('product-meta-keyword');
    if (metaKeyword) {
        new Tagify(metaKeyword, {
            maxTags: 10,
            dropdown: {
                maxItems: 5,
                enabled: 0,
                closeOnSelect: false
            }
        });
    }

    const publishingDate = document.getElementById('publishing-date');
    if (publishingDate) {
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
        new AirDatepicker(publishingDate, {
            locale: localeEn
        });
    }

    const productStatus = document.getElementById('product-status');
    if (productStatus) {
        new Choices(productStatus, {
            // removeItemButton: true,
            placeholderValue: 'Select Tax',
            searchEnabled: false,
            itemSelectText: false,
        });
        // Toggle publishing date visibility
        function togglePublishingDate() {
            publishingDate.closest('.scheduled-input').style.display = (productStatus.value === "scheduled") ? 'block' : 'none';
        }

        // Initial visibility check and change event
        productStatus.addEventListener('change', togglePublishingDate);
        togglePublishingDate();
    }

    let productCategories = document.getElementById('product-categories');
    if (productCategories) {
        new Choices(productCategories, {
            // removeItemButton: true,
            placeholderValue: 'Select Categories',
            searchEnabled: false,
            itemSelectText: false,
        });
    }

    let productTags = document.getElementById('product-tags');
    if (productTags) {
        new Tagify(productTags, {
            maxTags: 10,
            dropdown: {
                maxItems: 5,
                enabled: 0,
                closeOnSelect: false
            }
        });
    }
});
