// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Course Overview init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    // Product review management chart
    const chartOptions = {
        chart: {
            height: 85,
            width: 85,
            type: 'radialBar'
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '56%'
                },
                dataLabels: {
                    show: true,
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: 5,
                        formatter: function () {
                            return '4.8';
                        }
                    }
                },
                track: {
                    background: "#e0e0e0",
                }
            }
        },
        stroke: {
            lineCap: 'round'
        },
        grid: {
            padding: {
                top: -12,
                bottom: -17,
                left: -17,
                right: -15
            }
        },
        series: [92],
        color: '--bs-primary',
    };
    allCharts.push([{ 'id': 'review-chart', 'data': chartOptions }]);

    new StarRating('.yourRating', {
        classNames: {
            active: 'gl-active',
            base: 'gl-star-rating',
            selected: 'gl-selected',
        },
        clearable: true,
        prebuilt: false,
        tooltip: false,
        maxStars: 5,
    });
});
