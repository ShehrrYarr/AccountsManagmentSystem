// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Social Media Dashboard init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    // instagram chart
    const instagramChartOptions = {
        series: [{
            data: [22000, 13000, 48000, 27000, 9000, 42000, 18000, 35000, 15000],
        }],
        chart: {
            type: 'bar',
            height: 231,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                columnWidth: '35%',
                borderRadius: 8,
                distributed: true,
                dataLabels: { position: 'top' }
            }
        },
        grid: {
            show: false,
            padding: {
                top: -10,
                bottom: -10,
                left: -10,
                right: -10
            }
        },
        colors: ['--bs-light', '--bs-light', '--bs-primary', '--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-light'],
        dataLabels: {
            enabled: false,
        },
        legend: { show: false },
        tooltip: { enabled: true },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            axisTicks: { show: false },
        },
        grid: {
            strokeDashArray: 1,
        },
        yaxis: {
            labels: {
                offsetX: -15,
                formatter: function (val) {
                    return parseInt(val / 1000) + 'k';
                },
            }
        },
    };
    allCharts.push([{ 'id': 'instagram-chart', 'data': instagramChartOptions }]);

    // youtube chart
    const youtubeChartOptions = {
        series: [{
            data: [30000, 20000, 50000, 40000, 15000, 25000, 30000, 45000, 35000],
        }],
        chart: {
            type: 'bar',
            height: 231,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                columnWidth: '35%',
                borderRadius: 8,
                distributed: true,
                dataLabels: { position: 'top' }
            }
        },
        grid: {
            show: false,
            padding: {
                top: -10,
                bottom: -10,
                left: -10,
                right: -10
            }
        },
        colors: ['--bs-primary', '--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-light'],
        dataLabels: {
            enabled: false,
        },
        legend: { show: false },
        tooltip: { enabled: true },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            axisTicks: { show: false },
        },
        grid: {
            strokeDashArray: 1,
        },
        yaxis: {
            labels: {
                offsetX: -15,
                formatter: function (val) {
                    return parseInt(val / 1000) + 'k';
                },
            }
        },
    };
    allCharts.push([{ 'id': 'youtube-chart', 'data': youtubeChartOptions }]);

    // youtube chart
    const twitterChartOptions = {
        series: [{
            data: [15000, 25000, 35000, 20000, 30000, 40000, 50000, 60000, 70000],
        }],
        chart: {
            type: 'bar',
            height: 231,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: {
                columnWidth: '35%',
                borderRadius: 8,
                distributed: true,
                dataLabels: { position: 'top' }
            }
        },
        grid: {
            show: false,
            padding: {
                top: -10,
                bottom: -10,
                left: -10,
                right: -10
            }
        },
        colors: ['--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-primary', '--bs-light', '--bs-light', '--bs-light', '--bs-light'],
        dataLabels: {
            enabled: false,
        },
        legend: { show: false },
        tooltip: { enabled: true },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            axisTicks: { show: false },
        },
        grid: {
            strokeDashArray: 1,
        },
        yaxis: {
            labels: {
                offsetX: -15,
                formatter: function (val) {
                    return parseInt(val / 1000) + 'k';
                },
            }
        },
    };
    allCharts.push([{ 'id': 'twitter-chart', 'data': twitterChartOptions }]);

    // Most active time chart
    var activeTimeContainer = document.querySelector('#active-time-chart');
    if (activeTimeContainer) {
        function generateData(count, yrange) {
            var series = [];
            for (var i = 0; i < count; i++) {
                var x = (i + 1).toString(); // Time slots (1 to 10)
                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min; // Random activity level
                series.push({ x: x, y: y });
            }
            return series;
        }

        var activeTimeOptions = {
            series: [{
                name: 'Sat',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            },
            {
                name: 'Fri',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            },
            {
                name: 'Thu',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            },
            {
                name: 'Wed',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            },
            {
                name: 'Tue',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            },
            {
                name: 'Mon',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            },
            {
                name: 'Sun',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }
            ],
            chart: {
                height: 235,
                type: 'heatmap',
                toolbar: {
                    show: false // Disable the toolbar to remove export/download features
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ['--bs-primary'],
            xaxis: {
                labels: {
                    show: false // Hide x-axis labels
                },
                axisBorder: {
                    show: false // Hide x-axis border
                },
                axisTicks: {
                    show: false // Hide x-axis ticks
                }
            },
            yaxis: {
                labels: {
                    show: false // Hide y-axis labels
                },
                axisBorder: {
                    show: false // Hide y-axis border
                },
                axisTicks: {
                    show: false // Hide y-axis ticks
                }
            },
            grid: {
                padding: {
                    top: -25,
                    bottom: -10,
                    left: -10,
                }
            },
            plotOptions: {
                heatmap: {
                    distributed: true, // Distribute colors across the heatmap
                    shade: true, // Enable shading
                    stroke: {
                        width: 5, // Width of the border around each rectangle
                        colors: ['#000'] // Color of the border (white in this case)
                    },
                }
            }
        };
        allCharts.push([{ 'id': 'active-time-chart', 'data': activeTimeOptions }]);

    }

    // Global Reach chart
    var globalReachMapContainer = document.querySelector('#global-reach-map');
    if (globalReachMapContainer) {
        new jsVectorMap({
            selector: globalReachMapContainer, // Use the correct selector
            map: 'world',
            zoomOnScroll: false,
            selectedMarkers: [0, 2], // Select specific markers (index-based)
            regionStyle: {
                initial: {
                    stroke: "#9599ad",
                    strokeWidth: 0.25,
                    fillOpacity: 1,
                },
            },
            markersSelectable: true,
            markers: [
                { name: "Palestine", coords: [31.9474, 35.2272] },
                { name: "Russia", coords: [61.524, 105.3188] },
                { name: "Canada", coords: [56.1304, -106.3468] },
                { name: "Greenland", coords: [71.7069, -42.6043] },
            ],
            markerStyle: {
                initial: {
                    fill: "#adb5bd" // Default marker color
                },
                selected: { fill: "var(--bs-primary)" },
                hover: { fill: "var(--bs-primary)" },
            },
            labels: {
                markers: {
                    render: function (marker) {
                        return marker.name; // Render the marker name
                    }
                }
            }
        });
    }
});
