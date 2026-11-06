/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-scatter.init.js
*/

// Basic Scatter Chart
const basicScatterChartEl = document.querySelector('#basic_scatter_chart'),
    basicScatterChartOptions = {
        series: [{
            name: "SAMPLE A",
            data: [
                [16.4, 5.4], [21.7, 2], [25.4, 3], [19, 2], [10.9, 1], [13.6, 3.2], [10.9, 7.4], [10.9, 0], [10.9, 8.2], [16.4, 0], [16.4, 1.8], [13.6, 0.3], [13.6, 0], [29.9, 0], [27.1, 2.3], [16.4, 0], [13.6, 3.7], [10.9, 5.2], [16.4, 6.5], [10.9, 0], [24.5, 7.1], [10.9, 0], [8.1, 4.7], [19, 0], [21.7, 1.8], [27.1, 0], [24.5, 0], [27.1, 0], [29.9, 1.5], [27.1, 0.8], [22.1, 2]]
        }, {
            name: "SAMPLE B",
            data: [
                [36.4, 13.4], [1.7, 11], [5.4, 8], [9, 17], [1.9, 4], [3.6, 12.2], [1.9, 14.4], [1.9, 9], [1.9, 13.2], [1.4, 7], [6.4, 8.8], [3.6, 4.3], [1.6, 10], [9.9, 2], [7.1, 15], [1.4, 0], [3.6, 13.7], [1.9, 15.2], [6.4, 16.5], [0.9, 10], [4.5, 17.1], [10.9, 10], [0.1, 14.7], [9, 10], [12.7, 11.8], [2.1, 10], [2.5, 10], [27.1, 10], [2.9, 11.5], [7.1, 10.8], [2.1, 12]]
        }, {
            name: "SAMPLE C",
            data: [
                [21.7, 3], [23.6, 3.5], [24.6, 3], [29.9, 3], [21.7, 20], [23, 2], [10.9, 3], [28, 4], [27.1, 0.3], [16.4, 4], [13.6, 0], [19, 5], [22.4, 3], [24.5, 3], [32.6, 3], [27.1, 4], [29.6, 6], [31.6, 8], [21.6, 5], [20.9, 4], [22.4, 0], [32.6, 10.3], [29.7, 20.8], [24.5, 0.8], [21.4, 0], [21.7, 6.9], [28.6, 7.7], [15.4, 0], [18.1, 0], [33.4, 0], [16.4, 0]]
        }],
        chart: {
            height: 350,
            type: 'scatter',
            zoom: {
                enabled: true,
                type: 'xy'
            },
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
                right: 30,
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-warning'],
        xaxis: {
            tickAmount: 10,
            labels: {
                formatter: function (val) {
                    return parseFloat(val).toFixed(1)
                }
            }
        },
        yaxis: {
            tickAmount: 7
        }
    };
allCharts.push([{ 'id': 'basic_scatter_chart', 'data': basicScatterChartOptions }]);

// Scatter - Datetime Chart
function generateDayWiseTimeSeries(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = baseval + (i * 86400000);
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push([x, y]);
        i++;
    }
    return series;
}

const scatterDatetimeChartEl = document.querySelector('#scatter_datetime_chart'),
    scatterDatetimeChartOptions = {
        series: [
            {
                name: 'DIAMOND',
                data: generateDayWiseTimeSeries(
                    new Date('01 Feb 2017 GMT').getTime(),
                    10,
                    {
                        min: 5,
                        max: 60,
                    }
                ),
            },
            {
                name: 'TRIANGLE',
                data: generateDayWiseTimeSeries(
                    new Date('11 Feb 2017 GMT').getTime(),
                    10,
                    {
                        min: 54,
                        max: 90,
                    }
                ),
            },
            {
                name: 'CROSS',
                data: generateDayWiseTimeSeries(
                    new Date('20 Feb 2017 GMT').getTime(),
                    8,
                    {
                        min: 10,
                        max: 50,
                    }
                ),
            },
            {
                name: 'PLUS',
                data: generateDayWiseTimeSeries(
                    new Date('28 Feb 2017 GMT').getTime(),
                    16,
                    {
                        min: 30,
                        max: 99,
                    }
                ),
            },

            {
                name: 'SQUARE',
                data: generateDayWiseTimeSeries(
                    new Date('20 Mar 2017 GMT').getTime(),
                    10,
                    {
                        min: 0,
                        max: 59,
                    }
                ),
            },
            {
                name: 'LINE',
                data: generateDayWiseTimeSeries(
                    new Date('29 Mar 2017 GMT').getTime(),
                    10,
                    {
                        min: 0,
                        max: 90,
                    }
                ),
            },
            {
                name: 'CIRCLE',
                data: generateDayWiseTimeSeries(
                    new Date('10 Apr 2017 GMT').getTime(),
                    10,
                    {
                        min: 5,
                        max: 35,
                    }
                ),
            },

            {
                name: 'STAR',
                data: generateDayWiseTimeSeries(
                    new Date('20 Apr 2017 GMT').getTime(),
                    10,
                    {
                        min: 15,
                        max: 60,
                    }
                ),
            },
            {
                name: 'SPARKLE',
                data: generateDayWiseTimeSeries(
                    new Date('29 Apr 2017 GMT').getTime(),
                    10,
                    {
                        min: 45,
                        max: 99,
                    }
                ),
            },
        ],
        chart: {
            height: 350,
            type: 'scatter',
            zoom: {
                type: 'xy',
            },
            toolbar: {
                show: false
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-warning', '--bs-danger', '--bs-info', '--bs-pink', '--bs-purple', '--bs-orange', '--bs-teal'],
        dataLabels: {
            enabled: false,
        },
        grid: {
            xaxis: {
                lines: {
                    show: true,
                },
            },
            yaxis: {
                lines: {
                    show: true,
                },
            },
            padding: {
                top: -20,
                left: 20,
                right: 20,
                bottom: 10,
            }
        },
        xaxis: {
            type: 'datetime',
            labels: {
                formatter: function (value) {
                    return new Date(value).toLocaleDateString(); // Format as Date (e.g., MM/DD/YYYY)
                }
            }
        },
        yaxis: {},
        legend: {
            markers: {
                strokeWidth: [1, 1, 3, 3, 1, 4, 1, 1, 1],
            },
        },
        markers: {
            shape: [
                'diamond',
                'triangle',
                'cross',
                'plus',
                'square',
                'line',
                'circle',
                'star',
                'sparkle',
            ],
            size: 10,
            fillOpacity: 0.8,
            strokeColors: '#333',
            strokeWidth: [1, 1, 3, 3, 1, 4, 1, 1, 1],
        },
    };
allCharts.push([{ 'id': 'scatter_datetime_chart', 'data': scatterDatetimeChartOptions }]);

//
const scatterImagesChartEl = document.querySelector('#scatter_images_chart'),
    scatterImagesChartOptions = {
        series: [{
            name: 'Messenger',
            data: [
                [16.4, 5.4],
                [21.7, 4],
                [25.4, 3],
                [19, 2],
                [10.9, 1],
                [13.6, 3.2],
                [10.9, 7],
                [10.9, 8.2],
                [16.4, 4],
                [13.6, 4.3],
                [13.6, 12],
                [29.9, 3],
                [10.9, 5.2],
                [16.4, 6.5],
                [10.9, 8],
                [24.5, 7.1],
                [10.9, 7],
                [8.1, 4.7],
                [19, 10],
                [27.1, 10],
                [24.5, 8],
                [27.1, 3],
                [29.9, 11.5],
                [27.1, 0.8],
                [22.1, 2]
            ]
        }, {
            name: 'Instagram',
            data: [
                [6.4, 5.4],
                [11.7, 4],
                [15.4, 3],
                [9, 2],
                [10.9, 11],
                [20.9, 7],
                [12.9, 8.2],
                [6.4, 14],
                [11.6, 12]
            ]
        }],
        chart: {
            height: 350,
            type: 'scatter',
            animations: {
                enabled: false,
            },
            zoom: {
                enabled: false,
            },
            toolbar: {
                show: false
            }
        },
        colors: ['--bs-primary', '--bs-success'],
        xaxis: {
            tickAmount: 10,
            min: 0,
            max: 40
        },
        yaxis: {
            tickAmount: 7
        },
        markers: {
            size: 20
        },
        grid: {
            padding: {
                right: 30,
            }
        },
        fill: {
            type: 'image',
            opacity: 1,
            image: {
                src: ['assets/images/social-media/instagram.svg', 'assets/images/social-media/facebook.svg'],
                width: 40,
                height: 40
            }
        },
        legend: {
            labels: {
                useSeriesColors: true
            },
            markers: {
                customHTML: [
                    function () {
                        return '<span><i class="ri-facebook-box-fill"></i></span>'
                    }, function () {
                        return '<span><i class="ri-instagram-fill"></i></span>'
                    }
                ]
            }
        }
    };
allCharts.push([{ 'id': 'scatter_images_chart', 'data': scatterImagesChartOptions }]);
