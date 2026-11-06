/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: social feeds init js
*/

let glightboxElement = document.querySelector('.lightbox');
if (glightboxElement) {
    var lightbox = GLightbox({
        selector: '.lightbox',
        title: false,
    });
}

document.addEventListener('DOMContentLoaded', () => {
    let socialSidebar = document.getElementsByClassName('social-sidebar')[0];
    if (socialSidebar) {
        const navLinks = socialSidebar.querySelectorAll('.nav-link');
        const currentUrl = window.location.href;

        navLinks.forEach(link => {
            if (currentUrl.includes(link.getAttribute('href'))) {
                navLinks.forEach(nav => {
                    nav.classList.remove('active');
                });

                link.classList.add('active');
            }
        });
    }

    let productDescEditor = document.getElementById('post-description');
    if (productDescEditor) {
        // Initialize Quill editor
        new Quill(productDescEditor, {
            theme: 'snow', // Using snow theme
            modules: {
                toolbar: true,
            },
            placeholder: 'Type your text here...',
        });
    }

    const publishingDate = document.getElementById('post-scheduled-time');
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

    const productStatus = document.getElementById('post-visibility');
    if (productStatus) {
        new Choices(productStatus, {
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

    const postHashTagsInputs = document.getElementById('post-hashtags');
    if (postHashTagsInputs) {
        new Tagify(postHashTagsInputs, {
            placeholder: 'Add items...',
            enforceWhitelist: false,  // Allow any tag (disable whitelist)
            delimiters: ",",         // Separate tags by commas
            maxTags: 10,             // Limit the number of tags (optional)
            removeTags: true,        // Allow removal of tags by clicking the "x"
        });
    }
});
