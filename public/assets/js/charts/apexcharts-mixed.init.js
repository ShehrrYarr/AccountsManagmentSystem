/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-mixed.init.js
*/

// Line Column Chart
const lineColumnChartEl = document.querySelector('#line_column_chart'),
    lineColumnChartOptions = {
        series: [
            {
                name: 'Website Blog',
                type: 'column',
                data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
            },
            {
                name: 'Social Media',
                type: 'line',
                data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
                bottom: -20,
            }
        },
        stroke: {
            width: [0, 4],
        },
        colors: ['--bs-primary', '--bs-info'],
        dataLabels: {
            enabled: true,
            enabledOnSeries: [1],
            formatter: function (val) {
                return `${val} likes`;
            }
        },
        labels: [
            '01 Jan 2024', '02 Jan 2024', '03 Jan 2024', '04 Jan 2024', '05 Jan 2024',
            '06 Jan 2024', '07 Jan 2024', '08 Jan 2024', '09 Jan 2024', '10 Jan 2024',
            '11 Jan 2024', '12 Jan 2001'
        ],
        yaxis: [
            {
                min: 0,
            },
            {
                opposite: true,
            }
        ],
        fill: {
            opacity: 0.9,
        },
        tooltip: {
            shared: true,  // Tooltips will show for both series on hover
            intersect: false, // Tooltips appear for both series even when not hovering over the same data point
        },
    };
allCharts.push([{ 'id': 'line_column_chart', 'data': lineColumnChartOptions }]);

// Multiple Y-Axis Chart
const multipleYAxisChartEl = document.querySelector('#multiple_y_axis_chart'),
    multipleYAxisChartOptions = {
        series: [{
            name: 'Income',
            type: 'column',
            data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
        }, {
            name: 'Cashflow',
            type: 'column',
            data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
        }, {
            name: 'Revenue',
            type: 'line',
            data: [20, 29, 37, 36, 44, 45, 50, 58]
        }],
        chart: {
            height: 350,
            type: 'line',
            stacked: false,
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
        stroke: {
            width: [1, 1, 4]
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger'],
        xaxis: {
            categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016],
        },
        yaxis: [
            {
                seriesName: 'Income',
                axisTicks: {
                    show: true,
                },
                axisBorder: {
                    show: true,
                    color: '#008FFB'
                },
                labels: {
                    style: {
                        colors: '#008FFB',
                    }
                },
                title: {
                    text: "Income (thousand crores)",
                    style: {
                        color: '#008FFB',
                    }
                },
                tooltip: {
                    enabled: true
                }
            },
            {
                seriesName: 'Cashflow',
                opposite: true,
                axisTicks: {
                    show: true,
                },
                axisBorder: {
                    show: true,
                    color: '#00E396'
                },
                labels: {
                    style: {
                        colors: '#00E396',
                    }
                },
                title: {
                    text: "Operating Cashflow (thousand crores)",
                    style: {
                        color: '#00E396',
                    }
                },
            },
            {
                seriesName: 'Revenue',
                opposite: true,
                axisTicks: {
                    show: true,
                },
                axisBorder: {
                    show: true,
                    color: '#FEB019'
                },
                labels: {
                    style: {
                        colors: '#FEB019',
                    },
                },
                title: {
                    text: "Revenue (thousand crores)",
                    style: {
                        color: '#FEB019',
                    }
                }
            },
        ],
        tooltip: {
            fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
            },
        },
        legend: {
            horizontalAlign: 'center',
        }
    };
allCharts.push([{ 'id': 'multiple_y_axis_chart', 'data': multipleYAxisChartOptions }]);

// Line & Area Chart
const lineAreaChartEl = document.querySelector('#line_axis_chart'),
    lineAreaChartOptions = {
        series: [{
            name: 'TEAM A',
            type: 'area',
            data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33]
        }, {
            name: 'TEAM B',
            type: 'line',
            data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43]
        }],
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        stroke: {
            curve: 'smooth'
        },
        fill: {
            type: 'solid',
            opacity: [0.35, 1],
        },
        colors: ['--bs-primary', '--bs-warning'],
        labels: ['Dec 01', 'Dec 02', 'Dec 03', 'Dec 04', 'Dec 05', 'Dec 06', 'Dec 07', 'Dec 08', 'Dec 09 ', 'Dec 10', 'Dec 11'],
        markers: {
            size: 0
        },
        yaxis: [
            {},
            {
                opposite: true,
            },
        ],
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " points";
                    }
                    return y;
                }
            }
        }
    };
allCharts.push([{ 'id': 'line_axis_chart', 'data': lineAreaChartOptions }]);

// Line Column Area Chart
const lineColumnAreaChartEl = document.querySelector('#line_column_area_chart'),
    lineColumnAreaChartOptions = {
        series: [{
            name: 'TEAM A',
            type: 'column',
            data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
        }, {
            name: 'TEAM B',
            type: 'area',
            data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
        }, {
            name: 'TEAM C',
            type: 'line',
            data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
        }],
        chart: {
            height: 350,
            type: 'line',
            stacked: false,
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        stroke: {
            width: [0, 2, 5],
            curve: 'smooth'
        },
        plotOptions: {
            bar: {
                columnWidth: '50%'
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger'],
        fill: {
            opacity: [0.85, 0.25, 1],
            gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
        },
        labels: ['01/01/2003', '02/01/2003', '03/01/2003', '04/01/2003', '05/01/2003', '06/01/2003', '07/01/2003',
            '08/01/2003', '09/01/2003', '10/01/2003', '11/01/2003'
        ],
        markers: {
            size: 0
        },
        xaxis: {
            type: 'datetime'
        },
        yaxis: {
            title: {
                text: 'Points',
            }
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " points";
                    }
                    return y;

                }
            }
        }
    };
allCharts.push([{ 'id': 'line_column_area_chart', 'data': lineColumnAreaChartOptions }]);

// Line Scatter Chart
const lineScatterChartEl = document.querySelector('#line_scatter_chart'),
    lineScatterChartOptions = {
        series: [{
            name: 'Points',
            type: 'scatter',
            data: [{
                x: 1,
                y: 2.14
            }, {
                x: 1.2,
                y: 2.19
            }, {
                x: 1.8,
                y: 2.43
            }, {
                x: 2.3,
                y: 3.8
            }, {
                x: 2.6,
                y: 4.14
            }, {
                x: 2.9,
                y: 5.4
            }, {
                x: 3.2,
                y: 5.8
            }, {
                x: 3.8,
                y: 6.04
            }, {
                x: 4.55,
                y: 6.77
            }, {
                x: 4.9,
                y: 8.1
            }, {
                x: 5.1,
                y: 9.4
            }, {
                x: 7.1,
                y: 7.14
            }, {
                x: 9.18,
                y: 8.4
            }]
        }, {
            name: 'Line',
            type: 'line',
            data: [{
                x: 1,
                y: 2
            }, {
                x: 2,
                y: 3
            }, {
                x: 3,
                y: 4
            }, {
                x: 4,
                y: 5
            }, {
                x: 5,
                y: 6
            }, {
                x: 6,
                y: 7
            }, {
                x: 7,
                y: 8
            }, {
                x: 8,
                y: 9
            }, {
                x: 9,
                y: 10
            }, {
                x: 10,
                y: 11
            }]
        }],
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        fill: {
            type: 'solid',
        },
        colors: ['--bs-success'],
        markers: {
            size: [6, 0],
            colors: ['--bs-primary'],
        },
        tooltip: {
            shared: false,
            intersect: true,
        },
        legend: {
            show: false
        },
        xaxis: {
            type: 'numeric',
            min: 0,
            max: 12,
            tickAmount: 12
        }
    };
allCharts.push([{ 'id': 'line_scatter_chart', 'data': lineScatterChartOptions }]);
