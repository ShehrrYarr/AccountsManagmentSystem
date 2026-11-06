/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-bubble.init.js
*/

// Basic Bubble Chart
function generateData(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1; // Random x between 1 and 750
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min; // Random y within yrange
        var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15; // Random z between 15 and 75 for bubble size

        // Pushing the generated data point [x, y, z] into the series array
        series.push([x, y, z]);
        baseval += 86400000; // Incrementing baseval by 1 day (86400000 milliseconds)
        i++;
    }
    return series;
}

const basicBubblebarChartEl = document.querySelector('#basic_bubble_chart'),
    basicBubblebarChartOptions = {
        series: [{
            name: 'Bubble1',
            data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                min: 10,
                max: 60
            })
        },
        {
            name: 'Bubble2',
            data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                min: 10,
                max: 60
            })
        },
        {
            name: 'Bubble3',
            data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                min: 10,
                max: 60
            })
        },
        {
            name: 'Bubble4',
            data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                min: 10,
                max: 60
            })
        }],
        chart: {
            height: 350,
            type: 'bubble',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning'],
        dataLabels: {
            enabled: false
        },
        fill: {
            opacity: 0.8
        },
        xaxis: {
            tickAmount: 12,
            type: 'category',
        },
        yaxis: {
            max: 70
        }
    };
allCharts.push([{ 'id': 'basic_bubble_chart', 'data': basicBubblebarChartOptions }]);

// 3D Bubble Chart
const d3BubblebarChartEl = document.querySelector('#d3_bubble_chart'),
    d3BubblebarChartOptions = {
        series: [{
            name: 'Product1',
            data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                min: 10,
                max: 60
            })
        },
        {
            name: 'Product2',
            data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                min: 10,
                max: 60
            })
        },
        {
            name: 'Product3',
            data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                min: 10,
                max: 60
            })
        },
        {
            name: 'Product4',
            data: generateData(new Date('11 Feb 2017 GMT').getTime(), 20, {
                min: 10,
                max: 60
            })
        }],
        chart: {
            height: 350,
            type: 'bubble',
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
        fill: {
            type: 'gradient',
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning'],
        xaxis: {
            tickAmount: 12,
            type: 'datetime',
            labels: {
                rotate: 0,
            }
        },
        yaxis: {
            max: 70
        },
        xaxis: {
            tickAmount: 12,
            type: 'category',
        },
        theme: {
            palette: 'palette2'
        }
    };
allCharts.push([{ 'id': 'd3_bubble_chart', 'data': d3BubblebarChartOptions }]);
