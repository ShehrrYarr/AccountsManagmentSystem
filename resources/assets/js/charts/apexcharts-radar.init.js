/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-radar.init.js
*/

// Basic Radar Chart
const basicRadarChartEl = document.querySelector('#basic_radar_chart'),
    basicRadarChartOptions = {
        series: [{
            name: 'Series 1',
            data: [80, 50, 30, 40, 100, 20],
        }],
        chart: {
            height: 350,
            type: 'radar',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -40
            }
        },
        yaxis: {
            stepSize: 20
        },
        xaxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June']
        },
        colors: ['--bs-primary'],
    };
allCharts.push([{ 'id': 'basic_radar_chart', 'data': basicRadarChartOptions }]);

// Radar – Multiple Series Chart
const radarMultipleSeriesChartEl = document.querySelector('#radar_multiple_series_chart'),
    radarMultipleSeriesChartOptions = {
        series: [{
            name: 'Series 1',
            data: [80, 50, 30, 40, 100, 20],
        }, {
            name: 'Series 2',
            data: [20, 30, 40, 80, 20, 80],
        }, {
            name: 'Series 3',
            data: [44, 76, 78, 13, 43, 10],
        }],
        chart: {
            height: 350,
            type: 'radar',
            toolbar: {
                show: false
            },
            dropShadow: {
                enabled: true,
                blur: 1,
                left: 1,
                top: 1
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        stroke: {
            width: 2
        },
        fill: {
            opacity: 0.1
        },
        markers: {
            size: 0
        },
        yaxis: {
            stepSize: 20
        },
        xaxis: {
            categories: ['2011', '2012', '2013', '2014', '2015', '2016']
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger'],
    };
allCharts.push([{ 'id': 'radar_multiple_series_chart', 'data': radarMultipleSeriesChartOptions }]);

// Radar with Polygon-fill Chart
const radarWithPolygonFillChartEl = document.querySelector('#radar_with_polygon_fill_chart'),
    radarWithPolygonFillChartOptions = {
        series: [{
            name: 'Series 1',
            data: [20, 100, 40, 30, 50, 80, 33],
        }],
        chart: {
            height: 350,
            type: 'radar',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -40,
                bottom: -40,
            }
        },
        dataLabels: {
            enabled: true
        },
        plotOptions: {
            radar: {
                size: 140,
            }
        },
        colors: ['--bs-danger'],
        markers: {
            size: 4,
            colors: ['#fff'],
            strokeColor: '#FF4560',
            strokeWidth: 2,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val
                }
            }
        },
        xaxis: {
            categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
        },
        yaxis: {
            labels: {
                formatter: function (val, i) {
                    if (i % 2 === 0) {
                        return val
                    } else {
                        return ''
                    }
                }
            }
        },
        colors: ['#dc3545'],
    };
allCharts.push([{ 'id': 'radar_with_polygon_fill_chart', 'data': radarWithPolygonFillChartOptions }]);
