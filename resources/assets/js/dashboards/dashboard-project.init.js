// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Project Dashboard init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {
    // Inline Datepicker
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
    new AirDatepicker('#inline-date-picker', {
        inline: true,
        locale: localeEn
    })

    const projectProgressOptions = {
        chart: {
            type: "area",
            stacked: false,
            height: 305,
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        grid: {
            strokeDashArray: 3,
        },
        series: [
            {
                data: [
                    8000, 4000, 5000, 17000, 18000, 40000, 18000, 10000, 6000, 20000,
                ],
            },
        ],
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jan", "Jul", "Aug", "Sep", "Oct"],
        colors: ['--bs-primary'],
        xaxis: {
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            crosshairs: {
                show: true,
            },
            labels: {
                offsetX: 0,
                offsetY: 5,
            },
            tooltip: {
                enabled: false
            },
        },
        yaxis: {
            min: 0,    // Set your minimum value here
            max: 50000,   // Set your maximum value here
            tickAmount: 5,
            labels: {
                offsetX: -15,
                formatter: function (value) {
                    if (value >= 1000) {
                        return value / 1000 + "K"; // Convert to K format
                    }
                    return value.toLocaleString(); // Format numbers less than 1000 normally
                },
            },
            opposite: false,
        },
        legend: {
            show: false,
        },
        tooltip: {
            marker: {
                show: false,
            },
            y: {
                formatter: function (value) {
                    // Format y-axis value
                    if (value >= 1000) {
                        return value / 1000 + "K"; // Convert to K format
                    }
                    return value.toLocaleString(); // Format numbers less than 1000 normally
                },
            },
        },
    };
    allCharts.push([{ 'id': 'project-progress', 'data': projectProgressOptions }]);

    const projectOverviewOptions = {
        series: [1026, 22889, 10589],  // Raw data series
        labels: ["Active Projects", "Revenue", "Working Hours"], // Static labels
        colors: ['--bs-info', '--bs-success', '--bs-primary'],
        chart: {
            height: 250,
            type: "donut",
            background: 'transparent',
            toolbar: {
                show: false // Hides toolbar to keep the UI clean
            },
        },
        dataLabels: {
            enabled: false, // Disable individual data labels
        },
        plotOptions: {
            pie: {
                expandOnClick: false,
                donut: {
                    size: '75%', // Adjust size of donut
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total Projects',
                            formatter: function (w) {
                                return '10,000'; // Static total value
                            },
                        }
                    }
                }
            }
        },
        stroke: {
            width: 3,
            colors: ['#fff'], // White stroke to enhance separation of the donut segments
        },
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            labels: {
                useSeriesColors: true, // Ensure colors match donut chart
                formatter: function (seriesName, opts) {
                    const value = opts.w.globals.series[opts.seriesIndex];
                    if (seriesName === "Revenue") {
                        return `$${(value / 1000).toFixed(2)}k`; // Format Revenue with "k"
                    } else if (seriesName === "Working Hours") {
                        return `${value.toLocaleString()}h`; // Format Working Hours with "h"
                    }
                    return value; // Return raw value for Active Projects
                }
            },
        },
        tooltip: {
            enabled: true,
            shared: true,
            intersect: false,
            y: {
                formatter: function (val, opts) {
                    const seriesName = opts.seriesName;
                    if (seriesName === "Revenue") {
                        return `$${(val / 1000).toFixed(2)}k`; // Format Revenue in tooltip with "k"
                    } else if (seriesName === "Working Hours") {
                        return `${val.toLocaleString()}h`; // Format Working Hours in tooltip with "h"
                    }
                    return val.toLocaleString(); // Default number format for other series
                }
            }
        },
        states: {
            active: {
                filter: {
                    type: 'none'
                }
            },
            hover: {
                filter: {
                    type: 'none'
                }
            },
        },
        grid: {
            padding: {
                top: 10,
                right: 10,
                bottom: 10,
                left: 10,
            }
        }
    }
    allCharts.push([{ 'id': 'project-overview', 'data': projectOverviewOptions }]);

});
