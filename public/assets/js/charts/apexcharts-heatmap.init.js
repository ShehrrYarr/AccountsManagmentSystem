/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-heatmap.init.js
*/

// Basic Heatmap Chart
function generateData(count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = (i + 1).toString();
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push({
            x: x,
            y: y
        });
        i++;
    }
    return series;
}
const basicHeatmapChartEl = document.querySelector('#basic_heatmap_chart'),
    basicHeatmapChartOptions = {
        series: [{
            name: 'Metric1',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric2',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric3',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric4',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric5',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric6',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric7',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric8',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric9',
            data: generateData(18, {
                min: 0,
                max: 90
            })
        }
        ],
        chart: {
            height: 350,
            type: 'heatmap',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        dataLabels: {
            enabled: false
        },
        colors: ['--bs-primary'],
    };
allCharts.push([{ 'id': 'basic_heatmap_chart', 'data': basicHeatmapChartOptions }]);

// Multiple Colors Chart
var data = [{
    name: 'W1',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W2',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W3',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W4',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W5',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W6',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W7',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W8',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W9',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W10',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W11',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W12',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W13',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W14',
    data: generateData(8, {
        min: 0,
        max: 90
    })
},
{
    name: 'W15',
    data: generateData(8, {
        min: 0,
        max: 90
    })
}
]

const multipleColorsChartEl = document.querySelector('#multiple_colors_chart'),
    multipleColorsChartOptions = {
        series: data,
        chart: {
            height: 350,
            type: 'heatmap',
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info', '--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info', '--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info'],
        xaxis: {
            type: 'category',
            categories: ['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '01:00', '01:30']
        },
        grid: {
            padding: {
                right: 20,
                top: -30,
            }
        }
    };
allCharts.push([{ 'id': 'multiple_colors_chart', 'data': multipleColorsChartOptions }]);

// Multiple Colors Flipped Chart
const multipleFlippedChartEl = document.querySelector('#multiple_colors_flipped_chart'),
    multipleFlippedChartOptions = {
        series: data,
        chart: {
            height: 350,
            type: 'heatmap',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            heatmap: {
                colorScale: {
                    inverse: true
                }
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info', '--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info', '--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info'],
        xaxis: {
            type: 'category',
            categories: ['10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '01:00', '01:30']
        },
    };
allCharts.push([{ 'id': 'multiple_colors_flipped_chart', 'data': multipleFlippedChartOptions }]);

// Color Range Chart
const colorRangeChartEl = document.querySelector('#color_range_chart'),
    colorRangeChartOptions = {
        series: [{
            name: 'Jan',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        },
        {
            name: 'Feb',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        },
        {
            name: 'Mar',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        },
        {
            name: 'Apr',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        },
        {
            name: 'May',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        },
        {
            name: 'Jun',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        },
        {
            name: 'Jul',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        },
        {
            name: 'Aug',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        },
        {
            name: 'Sep',
            data: generateData(20, {
                min: -30,
                max: 55
            })
        }
        ],
        chart: {
            height: 350,
            type: 'heatmap',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        plotOptions: {
            heatmap: {
                shadeIntensity: 0.5,
                radius: 0,
                useFillColorAsStroke: true,
                colorScale: {
                    ranges: [{
                        from: -30,
                        to: 5,
                        name: 'low',
                        color: '--bs-primary'
                    },
                    {
                        from: 6,
                        to: 20,
                        name: 'medium',
                        color: '--bs-success'
                    },
                    {
                        from: 21,
                        to: 45,
                        name: 'high',
                        color: '--bs-danger'
                    },
                    {
                        from: 46,
                        to: 55,
                        name: 'extreme',
                        color: '--bs-warning'
                    }
                    ]
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            position: 'bottom'
        },
        stroke: {
            width: 1
        },
    };
allCharts.push([{ 'id': 'color_range_chart', 'data': colorRangeChartOptions }]);

// Range Without Shades Chart
const rangeWithoutShadesChartEl = document.querySelector('#range_without_shades_chart'),
    rangeWithoutShadesChartOptions = {
        series: [{
            name: 'Metric1',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric2',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric3',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric4',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric5',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric6',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric7',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric8',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        },
        {
            name: 'Metric8',
            data: generateData(20, {
                min: 0,
                max: 90
            })
        }
        ],
        chart: {
            height: 350,
            type: 'heatmap',
            toolbar: {
                show: false
            }
        },
        stroke: {
            width: 0
        },
        plotOptions: {
            heatmap: {
                radius: 30,
                enableShades: false,
                colorScale: {
                    ranges: [{
                        from: 0,
                        to: 50,
                        color: '--bs-primary'
                    },
                    {
                        from: 51,
                        to: 100,
                        color: '--bs-info'
                    },
                    ],
                },

            }
        },
        dataLabels: {
            enabled: true,
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        legend: {
            position: 'bottom'
        },
        xaxis: {
            type: 'category',
        },
    };
allCharts.push([{ 'id': 'range_without_shades_chart', 'data': rangeWithoutShadesChartOptions }]);
