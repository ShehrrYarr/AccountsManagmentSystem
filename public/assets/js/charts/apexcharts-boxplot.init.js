/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-boxplot.init.js
*/

// Basic Box Chart
const basicBoxChartEl = document.querySelector('#basic_box_chart'),
    basicBoxChartOptions = {
        series: [
            {
                type: 'boxPlot',
                data: [
                    {
                        x: 'Jan 2015',
                        y: [54, 66, 69, 75, 88]
                    },
                    {
                        x: 'Jan 2016',
                        y: [43, 65, 69, 76, 81]
                    },
                    {
                        x: 'Jan 2017',
                        y: [31, 39, 45, 51, 59]
                    },
                    {
                        x: 'Jan 2018',
                        y: [39, 46, 55, 65, 71]
                    },
                    {
                        x: 'Jan 2019',
                        y: [29, 31, 35, 39, 44]
                    },
                    {
                        x: 'Jan 2020',
                        y: [41, 49, 58, 61, 67]
                    },
                    {
                        x: 'Jan 2021',
                        y: [54, 59, 66, 71, 88]
                    }
                ]
            }
        ],
        chart: {
            type: 'boxPlot',
            height: 350,
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
                right: -8
            }
        },
        plotOptions: {
            boxPlot: {
                colors: {
                    upper: '--bs-primary',
                    lower: '--bs-success'
                }
            }
        }
    };
allCharts.push([{ 'id': 'basic_box_chart', 'data': basicBoxChartOptions }]);

// BoxPlot chart with outliers
const boxPlotWithOutliersEl = document.querySelector('#boxPlot_with_outliers_chart'),
    boxPlotWithOutliersOptions = {
        series: [
            {
                name: 'box',
                type: 'boxPlot',
                data: [
                    {
                        x: new Date('2017-01-01').getTime(),
                        y: [54, 66, 69, 75, 88]
                    },
                    {
                        x: new Date('2018-01-01').getTime(),
                        y: [43, 65, 69, 76, 81]
                    },
                    {
                        x: new Date('2019-01-01').getTime(),
                        y: [31, 39, 45, 51, 59]
                    },
                    {
                        x: new Date('2020-01-01').getTime(),
                        y: [39, 46, 55, 65, 71]
                    },
                    {
                        x: new Date('2021-01-01').getTime(),
                        y: [29, 31, 35, 39, 44]
                    }
                ]
            },
            {
                name: 'outliers',
                type: 'scatter',
                data: [
                    {
                        x: new Date('2017-01-01').getTime(),
                        y: 32
                    },
                    {
                        x: new Date('2018-01-01').getTime(),
                        y: 25
                    },
                    {
                        x: new Date('2019-01-01').getTime(),
                        y: 64
                    },
                    {
                        x: new Date('2020-01-01').getTime(),
                        y: 27
                    },
                    {
                        x: new Date('2020-01-01').getTime(),
                        y: 78
                    },
                    {
                        x: new Date('2021-01-01').getTime(),
                        y: 15
                    }
                ]
            }
        ],
        chart: {
            type: 'boxPlot',
            height: 350,
            toolbar: {
                show: false
            }
        },
        legend: {
            show: false
        },
        grid: {
            padding: {
                top: -20,
            },
        },
        plotOptions: {
            boxPlot: {
                colors: {
                    upper: '--bs-primary',
                    lower: '--bs-danger'
                }
            }
        },
        xaxis: {
            type: 'datetime',
            tooltip: {
                formatter: function (val) {
                    return new Date(val).getFullYear()
                }
            },
            labels: {
                show: true,
            }
        },
        yaxis: {
            labels: {
                show: true,
            }
        },
        tooltip: {
            shared: false,
            intersect: true
        }
    };
allCharts.push([{ 'id': 'boxPlot_with_outliers_chart', 'data': boxPlotWithOutliersOptions }]);

// Horizontal BoxPlot with Outliers
const HorizontalBoxPlotWithOutliersChartEl = document.querySelector('#horizontal_with_outliers_chart'),
    HorizontalBoxPlotWithOutliersChartOptions = {
        series: [
            {
                name: 'box',
                type: 'boxPlot',
                data: [
                    {
                        x: 'Category A',
                        y: [54, 66, 69, 75, 88],
                    },
                    {
                        x: 'Category B',
                        y: [43, 65, 69, 76, 81],
                    },
                    {
                        x: 'Category C',
                        y: [31, 39, 45, 51, 59],
                    },
                    {
                        x: 'Category D',
                        y: [39, 46, 55, 65, 71],
                    },
                    {
                        x: 'Category E',
                        y: [41, 49, 58, 61, 67],
                    },

                ],
            },
            {
                name: 'outliers',
                type: 'scatter',
                data: [
                    {
                        x: 'Category A',
                        y: 54,
                    },
                    {
                        x: 'Category B',
                        y: 43,
                    },
                    {
                        x: 'Category C',
                        y: 31,
                    },
                    {
                        x: 'Category D',
                        y: 71,
                    },
                    {
                        x: 'Category E',
                        y: 67,
                    },
                ],
            },
        ],
        chart: {
            type: 'boxPlot',
            height: 350,
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
                right: 25,
                left: 25
            }
        },
        legend: {
            show: false
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '40%'
            },
            boxPlot: {
                colors: {
                    upper: '--bs-primary',
                    lower: '--bs-danger'
                }
            }
        },
    };
allCharts.push([{ 'id': 'horizontal_with_outliers_chart', 'data': HorizontalBoxPlotWithOutliersChartOptions }]);
