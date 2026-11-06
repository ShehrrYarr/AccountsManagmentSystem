/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-polar.init.js
*/

// Basic Polararea Chart
const basicPolarareaChartEl = document.querySelector('#basic_polararea_chart'),
    basicPolarareaChartOptions = {
        series: [14, 23, 21, 17, 15, 10, 12, 17, 21],
        chart: {
            type: 'polarArea',
            height: 350,
        },
        stroke: {
            colors: ['#fff']
        },
        fill: {
            opacity: 0.8
        },
        legend: {
            position: 'bottom'
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info', '--bs-pink', '--bs-secondary', '--bs-light', '--bs-dark'],
    };
allCharts.push([{ 'id': 'basic_polararea_chart', 'data': basicPolarareaChartOptions }]);

// Monochrome Chart
const monochromeChartEl = document.querySelector('#monochrome_chart'),
    monochromeChartOptions = {
        series: [42, 47, 52, 58, 65],
        chart: {
            width: 380,
            type: 'polarArea'
        },
        labels: ['Rose A', 'Rose B', 'Rose C', 'Rose D', 'Rose E'],
        fill: {
            opacity: 1
        },
        stroke: {
            width: 1,
            colors: undefined
        },
        yaxis: {
            show: false
        },
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            polarArea: {
                rings: {
                    strokeWidth: 0
                },
                spokes: {
                    strokeWidth: 0
                },
            }
        },
        theme: {
            monochrome: {
                enabled: true,
                shadeTo: 'light',
                color: '--bs-primary',
                shadeIntensity: 0.6
            }
        }
    };
allCharts.push([{ 'id': 'monochrome_chart', 'data': monochromeChartOptions }]);
