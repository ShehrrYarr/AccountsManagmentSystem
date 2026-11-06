/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Search init js
*/

let choicesMultiple = document.getElementById('choices-multiple-close-icon');
if (choicesMultiple) {
    new Choices(choicesMultiple, {
        removeItemButton: true,
        searchEnabled: false,
        placeholderValue: 'Select Time',
        placeholder: true,
        itemSelectText: false,
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

const player = new Plyr('#video_player-1');
const player2 = new Plyr('#video_player-2');
const player3 = new Plyr('#video_player-3');
const player4 = new Plyr('#video_player-4');
const player5 = new Plyr('#video_player-5');
const player6 = new Plyr('#video_player-6');
const player7 = new Plyr('#video_player-7');
const player8 = new Plyr('#video_player-8');
