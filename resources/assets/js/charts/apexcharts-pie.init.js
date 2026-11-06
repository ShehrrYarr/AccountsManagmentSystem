/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-pie.init.js
*/

// Simple Pie Chart
const simplePieChartEl = document.querySelector('#simple_pie_chart'),
    simplePieChartOptions = {
        series: [44, 55, 13, 43, 22],
        chart: {
            height: 300,
            type: 'pie',
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        legend: {
            position: 'bottom'
        },
        colors: ['#5b71b9', '#28a745', '#17a2b8', '#ffc107', '#dc3545'],
    };
allCharts.push([{ 'id': 'simple_pie_chart', 'data': simplePieChartOptions }]);

// Simple Donut Chart
const simpleDonutChartEl = document.querySelector('#simple_donut_chart'),
    simpleDonutChartOptions = {
        series: [44, 55, 41, 17, 15],
        chart: {
            height: 300,
            type: 'donut',
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        legend: {
            position: 'bottom'
        },
        colors: ['#5b71b9', '#28a745', '#17a2b8', '#ffc107', '#dc3545'],
    };
allCharts.push([{ 'id': 'simple_donut_chart', 'data': simpleDonutChartOptions }]);

// Simple Donut Update Chart
const simpleDonutUpdateChartEl = document.querySelector('#simple_donut_update_chart'),
    simpleDonutUpdateChartOptions = {
        series: [44, 55, 13, 33],
        chart: {
            height: 300,
            type: 'donut',
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            position: 'bottom'
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D'],
        colors: ['#5b71b9', '#28a745', '#17a2b8', '#ffc107'],
    };

if (simpleDonutUpdateChartEl) {
    const simpleDonutUpdateChart = new ApexCharts(simpleDonutUpdateChartEl, simpleDonutUpdateChartOptions);
    simpleDonutUpdateChart.render();

    function appendData() {
        var arr = simpleDonutUpdateChart.w.globals.series.slice()
        arr.push(Math.floor(Math.random() * (100 - 1 + 1)) + 1)
        return arr;
    }

    function removeData() {
        var arr = simpleDonutUpdateChart.w.globals.series.slice()
        arr.pop()
        return arr;
    }

    function randomize() {
        return simpleDonutUpdateChart.w.globals.series.map(function () {
            return Math.floor(Math.random() * (100 - 1 + 1)) + 1
        })
    }

    function reset() {
        return simpleDonutUpdateChartOptions.series
    }

    document.querySelector("#randomize").addEventListener("click", function () {
        simpleDonutUpdateChart.updateSeries(randomize())
    })

    document.querySelector("#add").addEventListener("click", function () {
        simpleDonutUpdateChart.updateSeries(appendData())
    })

    document.querySelector("#remove").addEventListener("click", function () {
        simpleDonutUpdateChart.updateSeries(removeData())
    })

    document.querySelector("#reset").addEventListener("click", function () {
        simpleDonutUpdateChart.updateSeries(reset())
    })
}

// Monochrome Pie Chart
const monochromePieChartEl = document.querySelector('#monochrome_pie_chart'),
    monochromePieChartOptions = {
        series: [25, 15, 44, 55, 41, 17],
        chart: {
            width: '100%',
            height: '100%',
            type: 'pie',
        },
        labels: [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ],
        theme: {
            monochrome: {
                enabled: true,
                color: '--bs-primary',
                shadeTo: 'light',
                shadeIntensity: 0.8
            },
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    offset: -5,
                },
            },
        },
        grid: {
            padding: {
                top: 0,
                bottom: 0,
                left: 0,
                right: 0,
            },
        },
        dataLabels: {
            formatter(val, opts) {
                const name = opts.w.globals.labels[opts.seriesIndex]
                return [name, val.toFixed(1) + '%']
            },
        },
        legend: {
            show: false,
        },
    };
allCharts.push([{ 'id': 'monochrome_pie_chart', 'data': monochromePieChartOptions }]);

// Gradient Donut Chart
const gradientDonutChartEl = document.querySelector('#gradient_donut_chart'),
    gradientDonutChartOptions = {
        series: [44, 55, 41, 17, 15],
        chart: {
            height: 300,
            type: 'donut',
        },
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 270
            }
        },
        fill: {
            type: 'gradient',
        },
        legend: {
            position: 'bottom',
            formatter: function (val, opts) {
                return val + " - " + opts.w.globals.series[opts.seriesIndex]
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info'],
    };
allCharts.push([{ 'id': 'gradient_donut_chart', 'data': gradientDonutChartOptions }]);

// Semi Donut Chart
const semiDonutChartEl = document.querySelector('#semi_donut_chart'),
    semiDonutChartOptions = {
        series: [44, 55, 41, 17, 15],
        chart: {
            height: 300,
            type: 'donut',
        },
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 90,
                offsetY: 10
            }
        },
        grid: {
            padding: {
                bottom: -100
            }
        },
        legend: {
            position: 'bottom'
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info'],
    };
allCharts.push([{ 'id': 'semi_donut_chart', 'data': semiDonutChartOptions }]);

// Donut with Pattern Chart
const donutWithPatternChartEl = document.querySelector('#donut_with_pattern_chart'),
    donutWithPatternChartOptions = {
        series: [44, 55, 41, 17, 15],
        chart: {
            height: 300,
            type: 'donut',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: -1,
                left: 3,
                blur: 3,
                opacity: 0.2
            }
        },
        stroke: {
            width: 0,
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            showAlways: true,
                            show: true
                        }
                    }
                }
            }
        },
        labels: ["Comedy", "Action", "SciFi", "Drama", "Horror"],
        dataLabels: {
            dropShadow: {
                blur: 3,
                opacity: 0.8
            }
        },
        fill: {
            type: 'pattern',
            opacity: 1,
            pattern: {
                enabled: true,
                style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
            },
        },
        states: {
            hover: {
                filter: 'none'
            }
        },
        theme: {
            palette: 'palette2'
        },
        legend: {
            position: 'bottom'
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info'],
    };
allCharts.push([{ 'id': 'donut_with_pattern_chart', 'data': donutWithPatternChartOptions }]);

// Pie with Image Chart
const pieWithImageChartEl = document.querySelector('#pie_with_image_chart'),
    pieWithImageChartOptions = {
        series: [44, 33, 54, 45],
        chart: {
            height: 300,
            type: 'pie',
        },
        fill: {
            type: 'image',
            opacity: 0.85,
            image: {
                src: ['assets/images/small/img-2.jpg', 'assets/images/small/img-3.jpg', 'assets/images/small/img-4.jpg', 'assets/images/small/img-5.jpg'],
                width: 25,
                imagedHeight: 25
            },
        },
        stroke: {
            width: 4
        },
        dataLabels: {
            enabled: true,
            style: {
                colors: ['#111']
            },
            background: {
                enabled: true,
                foreColor: '#fff',
                borderWidth: 0
            }
        },
        legend: {
            position: 'bottom'
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning'],
    };
allCharts.push([{ 'id': 'pie_with_image_chart', 'data': pieWithImageChartOptions }]);
