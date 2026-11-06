/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-treemap.init.js
*/

// Basic Treemap Chart
const basicTreemapChartEl = document.querySelector('#basic_treemap_chart'),
    basicTreemapChartOptions = {
        series: [
            {
                data: [
                    {
                        x: 'New Delhi',
                        y: 218
                    },
                    {
                        x: 'Kolkata',
                        y: 149
                    },
                    {
                        x: 'Mumbai',
                        y: 184
                    },
                    {
                        x: 'Ahmedabad',
                        y: 55
                    },
                    {
                        x: 'Bangaluru',
                        y: 84
                    },
                    {
                        x: 'Pune',
                        y: 31
                    },
                    {
                        x: 'Chennai',
                        y: 70
                    },
                    {
                        x: 'Jaipur',
                        y: 30
                    },
                    {
                        x: 'Surat',
                        y: 44
                    },
                    {
                        x: 'Hyderabad',
                        y: 68
                    },
                    {
                        x: 'Lucknow',
                        y: 28
                    },
                    {
                        x: 'Indore',
                        y: 19
                    },
                    {
                        x: 'Kanpur',
                        y: 29
                    }
                ]
            }
        ],
        legend: {
            show: false
        },
        chart: {
            height: 350,
            type: 'treemap',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        colors: ['--bs-primary'],
    };
allCharts.push([{ 'id': 'basic_treemap_chart', 'data': basicTreemapChartOptions }]);

// Treemap Multiple Series Chart
const treemapMultipleSeriesChartEl = document.querySelector('#treemap_Multiple_Series_chart'),
    treemapMultipleSeriesChartOptions = {
        series: [
            {
                name: 'Desktops',
                data: [
                    {
                        x: 'ABC',
                        y: 10
                    },
                    {
                        x: 'DEF',
                        y: 60
                    },
                    {
                        x: 'XYZ',
                        y: 41
                    }
                ]
            },
            {
                name: 'Mobile',
                data: [
                    {
                        x: 'ABCD',
                        y: 10
                    },
                    {
                        x: 'DEFG',
                        y: 20
                    },
                    {
                        x: 'WXYZ',
                        y: 51
                    },
                    {
                        x: 'PQR',
                        y: 30
                    },
                    {
                        x: 'MNO',
                        y: 20
                    },
                    {
                        x: 'CDE',
                        y: 30
                    }
                ]
            }
        ],
        legend: {
            show: false
        },
        chart: {
            height: 350,
            type: 'treemap',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        colors: ['--bs-primary', '--bs-success'],
    };
allCharts.push([{ 'id': 'treemap_Multiple_Series_chart', 'data': treemapMultipleSeriesChartOptions }]);

// Treemap with Color scale Chart
const treemapWithColorScaleChartEl = document.querySelector('#treemap_with_color_scale_chart'),
    treemapWithColorScaleChartOptions = {
        series: [
            {
                data: [
                    {
                        x: 'INTC',
                        y: 1.2
                    },
                    {
                        x: 'GS',
                        y: 0.8
                    },
                    {
                        x: 'CVX',
                        y: -1.4
                    },
                    {
                        x: 'GE',
                        y: 2.7
                    },
                    {
                        x: 'CAT',
                        y: -0.8
                    },
                    {
                        x: 'RTX',
                        y: 5.1
                    },
                    {
                        x: 'CSCO',
                        y: -2.3
                    },
                    {
                        x: 'JNJ',
                        y: 2.1
                    },
                    {
                        x: 'PG',
                        y: 0.3
                    },
                    {
                        x: 'TRV',
                        y: 1.12
                    },
                    {
                        x: 'MMM',
                        y: -2.31
                    },
                    {
                        x: 'NKE',
                        y: 3.98
                    },
                    {
                        x: 'IYT',
                        y: 1.67
                    }
                ]
            }
        ],
        legend: {
            show: false
        },
        dataLabels: {
            enabled: true,
            formatter: function (text, op) {
                return [text, op.value]
            },
            offsetY: -4
        },
        plotOptions: {
            treemap: {
                enableShades: true,
                shadeIntensity: 0.5,
                reverseNegativeShade: true,
                colorScale: {
                    ranges: [
                        {
                            from: -6,
                            to: 0,
                            color: '--bs-primary'
                        },
                        {
                            from: 0.001,
                            to: 6,
                            color: '--bs-info'
                        }
                    ]
                }
            }
        },
        chart: {
            height: 350,
            type: 'treemap',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
    };
allCharts.push([{ 'id': 'treemap_with_color_scale_chart', 'data': treemapWithColorScaleChartOptions }]);

// Distibuted Treemap (different color for each cell)
const distibutedTreemapChartEl = document.querySelector('#distibuted_treemap_chart'),
    distibutedTreemapChartOptions = {
        series: [
            {
                data: [
                    {
                        x: 'New Delhi',
                        y: 218
                    },
                    {
                        x: 'Kolkata',
                        y: 149
                    },
                    {
                        x: 'Mumbai',
                        y: 184
                    },
                    {
                        x: 'Ahmedabad',
                        y: 55
                    },
                    {
                        x: 'Bangaluru',
                        y: 84
                    },
                    {
                        x: 'Pune',
                        y: 31
                    },
                    {
                        x: 'Chennai',
                        y: 70
                    },
                    {
                        x: 'Jaipur',
                        y: 30
                    },
                    {
                        x: 'Surat',
                        y: 44
                    },
                    {
                        x: 'Hyderabad',
                        y: 68
                    },
                    {
                        x: 'Lucknow',
                        y: 28
                    },
                    {
                        x: 'Indore',
                        y: 19
                    },
                    {
                        x: 'Kanpur',
                        y: 29
                    }
                ]
            }
        ],
        legend: {
            show: false
        },
        chart: {
            height: 350,
            type: 'treemap',
            toolbar: {
                show: false
            }
        },
        colors: ['--bs-primary',  '--bs-success', '--bs-info', '--bs-warning', '--bs-danger', '--bs-primary', '--bs-success', '--bs-info', '--bs-warning', '--bs-danger', '--bs-primary', '--bs-success', '--bs-info'],
        plotOptions: {
            treemap: {
                distributed: true,
                enableShades: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
    };
allCharts.push([{ 'id': 'distibuted_treemap_chart', 'data': distibutedTreemapChartOptions }]);
