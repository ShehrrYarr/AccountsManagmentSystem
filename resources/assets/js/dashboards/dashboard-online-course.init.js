// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Online Course Dashboard init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const inlinePickerEl = document.querySelector('#inline-date-picker')
    if (inlinePickerEl) {
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
        new AirDatepicker(inlinePickerEl, {
            inline: true,
            locale: localeEn
        })
    }

    const leaveApplicationSwiper = document.querySelector('.leave-application-swiper');
    if (leaveApplicationSwiper) {
        new Swiper(leaveApplicationSwiper, {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            }
        });
    }

    document.querySelectorAll(".form-check-input").forEach(checkbox => {
        const listItem = checkbox.closest('li');

        // Check if listItem and the necessary child elements exist
        if (!listItem) return; // If no closest 'li' found, skip this checkbox

        const label = listItem.querySelector('li label');
        const badge = listItem.querySelector('.badge');

        // If label or badge is missing, skip this checkbox
        if (!label || !badge) return;

        const badgeContent = badge.textContent;

        // Helper function to update badge and label
        const updateBadgeAndLabel = (isChecked) => {
            label.style.textDecoration = isChecked ? 'line-through' : 'none';
            // Set the badge text based on whether the checkbox is checked and current state
            if (isChecked) {
                badge.textContent = 'Completed';
            } else {
                badge.textContent = badgeContent === 'In Progress' ? 'In Progress' : 'Pending';
            }
            // Toggle badge classes based on whether the checkbox is checked
            badge.classList.toggle('bg-success-subtle', isChecked);
            badge.classList.toggle('text-success', isChecked);
            badge.classList.toggle('bg-warning-subtle', !isChecked && badgeContent === 'In Progress');
            badge.classList.toggle('text-warning', !isChecked && badgeContent === 'In Progress');
            badge.classList.toggle('bg-secondary-subtle', !isChecked && badgeContent !== 'In Progress');
            badge.classList.toggle('text-secondary', !isChecked && badgeContent !== 'In Progress');
        };

        // Apply initial state
        updateBadgeAndLabel(checkbox.checked);

        // Listen for changes
        checkbox.addEventListener('change', (e) => updateBadgeAndLabel(e.target.checked));
    });

    const orderAnalyticsDashboardOption = {
        series: [
            {
                name: 'Activity', // Single bar name
                data: [3, 4, 2, 5, 3, 4, 2] // Example hours data for each day
            },
        ],
        chart: {
            type: "bar",
            stacked: false, // No stacking, only one bar per category
            zoom: {
                enabled: false,
            },
            toolbar: {
                show: false, // Hides the toolbar
            },
            height: 310,
        },
        plotOptions: {
            bar: {
                columnWidth: '50%', // Adjust width for the single bar
                distributed: false, // Not grouped as there's only one bar
                borderRadius: 4,
                borderRadiusApplication: 'end',
            }
        },
        dataLabels: {
            enabled: true, // To display values on top of bars
        },
        legend: {
            show: true, // Show legend for "Activity"
        },
        xaxis: {
            categories: [
                "S", "M", "T", "W", "T", "F", "S"
            ],
            axisBorder: {
                show: true,
            },
            axisTicks: {
                show: true,
            },
            crosshairs: {
                show: true,
            },
        },
        yaxis: {
            tickAmount: 6, // Show 7 ticks (0 to 6 hours)
            min: 0,
            max: 6,
            labels: {
                formatter: function (value) {
                    return value + ' Hr'; // Display "hrs" for better understanding
                },
                offsetX: -10,
                offsetY: 0,
            },
        },
        grid: {
            strokeDashArray: 3,
            right: 20,
        },
        colors: ['--bs-primary'],
    };
    allCharts.push([{ 'id': 'orderAnalyticsDashboard', 'data': orderAnalyticsDashboardOption }]);
});
