// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Student Details init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    // Initialize swiper.js with resposive design
    new Swiper(".recent-swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            700: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1250: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1600: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        }
    });

    // Initialize choice.js without search
    new Choices('#all-courses-select', {
        searchEnabled: false,
        placeholder: false,
        itemSelectText: false,
    });

    // Initialize Apexcharts
    const learningAnalyticsOptions = {
        series: [
            {
                name: 'Task 1', // Name of the task/course
                data: [2, 3, 4, 1, 2, 5, 3], // Example data for each day or task
            },
        ],
        chart: {
            type: "bar",
            stacked: false,
            height: 340,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                columnWidth: '50%',
                borderRadius: 4,
            }
        },
        grid: {
            show: false,
            padding: {
                top: -10,
                bottom: -10,
                right: -10
            }
        },
        dataLabels: {
            enabled: true,
        },
        xaxis: {
            categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sun"], // Days of the week (or any timeframe)
            axisBorder: {
                show: true,
            },
            axisTicks: {
                show: false
            },
        },
        yaxis: {
            tickAmount: 6,
            min: 0,
            max: 6,
            labels: {
                formatter: function (value) {
                    return value + ' hr'; // Display hours
                },
            },
        },
        colors: ['--bs-primary'],
        legend: {
            position: 'top',
        },
        tooltip: {
            enabled: true, // Enable the tooltip
            custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                const timeSpentInHours = series[seriesIndex][dataPointIndex];
                const hours = Math.floor(timeSpentInHours); // Get hours part
                const minutes = Math.round((timeSpentInHours - hours) * 60); // Convert decimal part to minutes

                return `
                <div class="popover border-0 shadow-none show" role="tooltip">
                    <div class="popover-body rounded py-2 px-3 text-center">
                        <h5 class="mb-0">${hours}h ${minutes}m</h5>
                        <span class="text-muted fs-10">Time Spent</span>
                    </div>
                </div>
            `;
            },
        },
    };
    allCharts.push([{ 'id': 'learningAnalyticsDashboard', 'data': learningAnalyticsOptions }]);

    // Initialize choice.js without search
    const mostActiveSelect = document.querySelector('#time-frame-select');
    if (mostActiveSelect) {
        new Choices(mostActiveSelect, {
            searchEnabled: false,
            placeholder: false,
            itemSelectText: false,
        });
    }

    // Team Activities
    const graphicDesignProgress = document.getElementById('graphic-design-progress');
    if (graphicDesignProgress) {
        var graphicDesignProgressEL = {
            series: [58],
            chart: {
                height: 60,
                width: 60,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            offsetY: 5,
                        }
                    }
                }
            },
            grid: {
                show: false,
                padding: {
                    top: -17,
                    bottom: -17,
                    left: -17,
                    right: -17
                }
            },
            fill: {
                colors: ['--bs-primary'],
            },
            stroke: {
                lineCap: 'round'
            },
        };
        allCharts.push([{ 'id': 'graphic-design-progress', 'data': graphicDesignProgressEL }]);
    }

    const webDevelopmentProgress = document.getElementById('web-development-progress');
    if (webDevelopmentProgress) {
        var webDevelopmentProgressEL = {
            series: [80],
            chart: {
                height: 60,
                width: 60,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            offsetY: 5,
                        }
                    }
                }
            },
            grid: {
                show: false,
                padding: {
                    top: -17,
                    bottom: -17,
                    left: -17,
                    right: -17
                }
            },
            fill: {
                colors: ['--bs-success'],
            },
            stroke: {
                lineCap: 'round'
            },
        };
        allCharts.push([{ 'id': 'web-development-progress', 'data': webDevelopmentProgressEL }]);
    }

    const mobileAppProgress = document.getElementById('mobile-app-progress');
    if (mobileAppProgress) {
        var mobileAppProgressEL = {
            series: [45],
            chart: {
                height: 60,
                width: 60,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            show: false,
                            color: '#fff'
                        },
                        value: {
                            show: true,
                            offsetY: 5,
                        }
                    }
                }
            },
            grid: {
                show: false,
                padding: {
                    top: -17,
                    bottom: -17,
                    left: -17,
                    right: -17
                }
            },
            fill: {
                colors: ['--bs-info'],
            },
            stroke: {
                lineCap: 'round'
            },
        };
        allCharts.push([{ 'id': 'mobile-app-progress', 'data': mobileAppProgressEL }]);
    }

    document.querySelectorAll(".form-check-input").forEach(checkbox => {
        const listItem = checkbox.closest('li');

        // Check if listItem and the necessary child elements exist
        if (!listItem) return; // If no closest 'li' found, skip this checkbox

        const label = listItem.querySelector('label');
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

});
