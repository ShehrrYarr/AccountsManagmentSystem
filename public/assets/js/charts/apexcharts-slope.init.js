/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-slope.init.js
*/

// Basic Slope Chart
const basicSlopeChartEl = document.querySelector('#basic_slope_chart'),
    basicSlopeChartOptions = {
        series: [
            {
                name: 'Blue',
                data: [
                    {
                        x: 'Jan',
                        y: 43,
                    },
                    {
                        x: 'Feb',
                        y: 58,
                    },
                ],
            },
            {
                name: 'Green',
                data: [
                    {
                        x: 'Jan',
                        y: 33,
                    },
                    {
                        x: 'Feb',
                        y: 38,
                    },
                ],
            },
            {
                name: 'Red',
                data: [
                    {
                        x: 'Jan',
                        y: 55,
                    },
                    {
                        x: 'Feb',
                        y: 21,
                    },
                ],
            },
        ],
        chart: {
            height: 350,
            type: 'line',
        },
        plotOptions: {
            line: {
                isSlopeChart: true,
            },
        },
        grid: {
            padding: {
                top: -20,
                bottom: -20,
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger'],
    };
allCharts.push([{ 'id': 'basic_slope_chart', 'data': basicSlopeChartOptions }]);

// Multi group Heatmap Chart
const multiGroupSlopeChartEl = document.querySelector('#multi_group_slope_chart'),
    multiGroupSlopeChartOptions = {
        series: [
            {
                name: 'Blue',
                data: [
                    {
                        x: 'Category 1',
                        y: 503,
                    },
                    {
                        x: 'Category 2',
                        y: 580,
                    },
                    {
                        x: 'Category 3',
                        y: 135,
                    },
                ],
            },
            {
                name: 'Green',
                data: [
                    {
                        x: 'Category 1',
                        y: 733,
                    },
                    {
                        x: 'Category 2',
                        y: 385,
                    },
                    {
                        x: 'Category 3',
                        y: 715,
                    },
                ],
            },
            {
                name: 'Orange',
                data: [
                    {
                        x: 'Category 1',
                        y: 255,
                    },
                    {
                        x: 'Category 2',
                        y: 211,
                    },
                    {
                        x: 'Category 3',
                        y: 441,
                    },
                ],
            },
            {
                name: 'Red',
                data: [
                    {
                        x: 'Category 1',
                        y: 428,
                    },
                    {
                        x: 'Category 2',
                        y: 749,
                    },
                    {
                        x: 'Category 3',
                        y: 559,
                    },
                ],
            },
        ],
        chart: {
            height: 350,
            type: 'line',
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning'],
        plotOptions: {
            line: {
                isSlopeChart: true,
            },
        },
        tooltip: {
            followCursor: true,
            intersect: false,
            shared: true,
        },
        dataLabels: {
            background: {
                enabled: true,
            },
            formatter(val, opts) {
                const seriesName = opts.w.config.series[opts.seriesIndex].name
                return val !== null ? seriesName : ''
            },
        },
        yaxis: {
            show: true,
            labels: {
                show: true,
            },
        },
        xaxis: {
            position: 'bottom',
        },
        legend: {
            show: true,
            position: 'bottom'
        },
        stroke: {
            width: [2, 3, 4, 2],
            dashArray: [0, 0, 5, 2],
            curve: 'smooth',
        }
    };
allCharts.push([{ 'id': 'multi_group_slope_chart', 'data': multiGroupSlopeChartOptions }]);
