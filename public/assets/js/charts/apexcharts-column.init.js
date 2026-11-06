/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-column.init.js
*/

// Basic Area Chart
const basicColumnChartEl = document.querySelector('#basic_column_chart'),
    basicColumnChartOptions = {
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRadius: 5,
                borderRadiusApplication: 'end'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger'],
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    };
allCharts.push([{ 'id': 'basic_column_chart', 'data': basicColumnChartOptions }]);

// Column with Data Labels Chart
const columnWithDataLabelsChartEl = document.querySelector('#column_with_data_labels'),
    columnWithDataLabelsChartOptions = {
        series: [{
            name: 'Inflation',
            data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
        }],
        chart: {
            height: 340,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "%";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },
        colors: ['--bs-primary'],
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            position: 'bottom',
            offsetY: -10,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val + "%";
                }
            }
        },
        title: {
            text: 'Monthly Inflation in Argentina, 2002',
            floating: true,
            offsetY: 320,
            align: 'center',
        }
    };
allCharts.push([{ 'id': 'column_with_data_labels', 'data': columnWithDataLabelsChartOptions }]);

// Stacked Column Chart
const stackedColumnsChartEl = document.querySelector('#stacked_columns_chart'),
    stackedColumnsChartOptions = {
        series: [{
            name: 'PRODUCT A',
            data: [44, 55, 41, 67, 22, 43]
        }, {
            name: 'PRODUCT B',
            data: [13, 23, 20, 8, 13, 27]
        }, {
            name: 'PRODUCT C',
            data: [11, 17, 15, 15, 21, 14]
        }, {
            name: 'PRODUCT D',
            data: [21, 7, 25, 13, 22, 8]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: true
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                borderRadiusApplication: 'end', // 'around', 'end'
                borderRadiusWhenStacked: 'last', // 'all', 'last'
                dataLabels: {
                    total: {
                        enabled: true,
                        style: {
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
        },
        xaxis: {
            type: 'datetime',
            categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
                '01/05/2011 GMT', '01/06/2011 GMT'
            ],
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning'],
        legend: {
            position: 'right',
            offsetY: 40
        },
        fill: {
            opacity: 1
        }
    };
allCharts.push([{ 'id': 'stacked_columns_chart', 'data': stackedColumnsChartOptions }]);

// Stacked Column 100 Chart
const stackedColumns100ChartEl = document.querySelector('#stacked_columns_100_chart'),
    stackedColumns100ChartOptions = {
        series: [{
            name: 'PRODUCT A',
            data: [44, 55, 41, 67, 22, 43, 21, 49]
        }, {
            name: 'PRODUCT B',
            data: [13, 23, 20, 8, 13, 27, 33, 12]
        }, {
            name: 'PRODUCT C',
            data: [11, 17, 15, 15, 21, 14, 15, 13]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: false
            },
            stackType: '100%'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        xaxis: {
            categories: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2',
                '2012 Q3', '2012 Q4'
            ],
        },
        colors: ['--bs-primary', '--bs-success', '--bs-warning'],
        fill: {
            opacity: 1
        },
        legend: {
            position: 'right',
            offsetX: 0,
            offsetY: 50
        },
    };
allCharts.push([{ 'id': 'stacked_columns_100_chart', 'data': stackedColumns100ChartOptions }]);

// Grouped Stacked Columns Chart
const groupedStackedColumnsChartEl = document.querySelector('#grouped_stacked_columns_chart'),
    groupedStackedColumnsChartOptions = {
        series: [
            {
                name: 'Q1 Budget',
                group: 'budget',
                data: [50000, 70000, 60000, 80000, 35000, 45000] // Q1 budget data for different marketing categories
            },
            {
                name: 'Q1 Actual',
                group: 'actual',
                data: [55000, 75000, 58000, 85000, 38000, 46000] // Q1 actual expenses for different marketing categories
            },
            {
                name: 'Q2 Budget',
                group: 'budget',
                data: [60000, 80000, 65000, 90000, 40000, 50000] // Q2 budget data for different marketing categories
            },
            {
                name: 'Q2 Actual',
                group: 'actual',
                data: [65000, 82000, 63000, 95000, 42000, 51000] // Q2 actual expenses for different marketing categories
            }
        ],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: false
            }
        },
        stroke: {
            width: 1,
            colors: ['#fff'] // White border between bars for clarity
        },
        dataLabels: {
            formatter: (val) => {
                return val / 1000 + 'K' // Format the data labels in 'K' for thousands
            }
        },
        plotOptions: {
            bar: {
                horizontal: false // Vertical bars for better readability
            }
        },
        xaxis: {
            categories: [
                'Online Advertising', // Marketing channel categories
                'Sales Training',
                'Print Advertising',
                'Catalogs',
                'Meetings',
                'Public Relations'
            ]
        },
        fill: {
            opacity: 1 // Full opacity for the chart bars
        },
        colors: ['--bs-primary', '--bs-secondary', '--bs-teal', '--bs-pink'],
        yaxis: {
            labels: {
                formatter: (val) => {
                    return val / 1000 + 'K' // Format y-axis values in 'K' for thousands
                }
            }
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center'
        }
    };
allCharts.push([{ 'id': 'grouped_stacked_columns_chart', 'data': groupedStackedColumnsChartOptions }]);

//  Dumbbell Chart
const dumbbellChartEl = document.querySelector('#dumbbell_chart'),
    dumbbellChartChartOptions = {
        series: [
            {
                data: [
                    {
                        x: '2008',
                        y: [2800, 4500]
                    },
                    {
                        x: '2009',
                        y: [3200, 4100]
                    },
                    {
                        x: '2010',
                        y: [2950, 7800]
                    },
                    {
                        x: '2011',
                        y: [3000, 4600]
                    },
                    {
                        x: '2012',
                        y: [3500, 4100]
                    },
                    {
                        x: '2013',
                        y: [4500, 6500]
                    },
                    {
                        x: '2014',
                        y: [4100, 5600]
                    }
                ]
            }
        ],
        chart: {
            height: 350,
            type: 'rangeBar',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            }
        },
        plotOptions: {
            bar: {
                isDumbbell: true,
                columnWidth: 3,
                dumbbellColors: [['#008FFB', '#00E396']]
            }
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            position: 'bottom',
            horizontalAlign: 'center',
            customLegendItems: ['Product A', 'Product B']
        },
        fill: {
            type: 'gradient',
            gradient: {
                type: 'vertical',
                gradientToColors: ['#00E396'],
                inverseColors: true,
                stops: [0, 100]
            }
        },
        colors: ['--bs-primary', '--bs-success'],
        grid: {
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: false
                }
            }
        },
        xaxis: {
            tickPlacement: 'on'
        }
    };
allCharts.push([{ 'id': 'dumbbell_chart', 'data': dumbbellChartChartOptions }]);

//  Column with Markers Chart
const columnWithMarkersChartEl = document.querySelector('#column_with_markers_chart'),
    columnWithMarkersChartOptions = {
        series: [
            {
                name: 'Actual',
                data: [
                    {
                        x: '2011',
                        y: 1292,
                        goals: [
                            {
                                name: 'Expected',
                                value: 1400,
                                strokeHeight: 5,
                                strokeColor: '--bs-pink',
                            }
                        ]
                    },
                    {
                        x: '2012',
                        y: 4432,
                        goals: [
                            {
                                name: 'Expected',
                                value: 5400,
                                strokeHeight: 5,
                                strokeColor: '--bs-pink',
                            }
                        ]
                    },
                    {
                        x: '2013',
                        y: 5423,
                        goals: [
                            {
                                name: 'Expected',
                                value: 5200,
                                strokeHeight: 5,
                                strokeColor: '--bs-pink',
                            }
                        ]
                    },
                    {
                        x: '2014',
                        y: 6653,
                        goals: [
                            {
                                name: 'Expected',
                                value: 6500,
                                strokeHeight: 5,
                                strokeColor: '--bs-pink',
                            }
                        ]
                    },
                    {
                        x: '2015',
                        y: 8133,
                        goals: [
                            {
                                name: 'Expected',
                                value: 6600,
                                strokeHeight: 13,
                                strokeWidth: 0,
                                strokeLineCap: 'round',
                                strokeColor: '--bs-pink',
                            }
                        ]
                    },
                    {
                        x: '2016',
                        y: 7132,
                        goals: [
                            {
                                name: 'Expected',
                                value: 7500,
                                strokeHeight: 5,
                                strokeColor: '--bs-pink',
                            }
                        ]
                    },
                    {
                        x: '2017',
                        y: 7332,
                        goals: [
                            {
                                name: 'Expected',
                                value: 8700,
                                strokeHeight: 5,
                                strokeColor: '--bs-pink',
                            }
                        ]
                    },
                    {
                        x: '2018',
                        y: 6553,
                        goals: [
                            {
                                name: 'Expected',
                                value: 7300,
                                strokeHeight: 2,
                                strokeDashArray: 2,
                                strokeColor: '--bs-pink',
                            }
                        ]
                    }
                ]
            }
        ],
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                columnWidth: '60%'
            }
        },
        colors: ['--bs-primary'],
        dataLabels: {
            enabled: false
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            customLegendItems: ['Actual', 'Expected'],
            markers: {
                colors: ['--bs-primary', '--bs-success'],
            }
        }
    };
allCharts.push([{ 'id': 'column_with_markers_chart', 'data': columnWithMarkersChartOptions }]);

//  Column with Group Label Chart
dayjs.extend(dayjs_plugin_quarterOfYear);

const columnWithGroupLabelChartEl = document.querySelector('#column_with_group_label_chart'),
    columnWithGroupLabelChartOptions = {
        series: [{
            name: "sales",
            data: [{
                x: '2019/01/01',
                y: 400
            }, {
                x: '2019/04/01',
                y: 430
            }, {
                x: '2019/07/01',
                y: 448
            }, {
                x: '2019/10/01',
                y: 470
            }, {
                x: '2020/01/01',
                y: 540
            }, {
                x: '2020/04/01',
                y: 580
            }, {
                x: '2020/07/01',
                y: 690
            }, {
                x: '2020/10/01',
                y: 690
            }]
        }],
        chart: {
            type: 'bar',
            height: 380,
            toolbar: {
                show: false
            }
        },
        xaxis: {
            type: 'category',
            labels: {
                formatter: function (val) {
                    return "Q" + dayjs(val).quarter()
                }
            },
            group: {
                style: {
                    fontSize: '10px',
                    fontWeight: 700
                },
                groups: [
                    { title: '2019', cols: 4 },
                    { title: '2020', cols: 4 }
                ]
            }
        },
        tooltip: {
            x: {
                formatter: function (val) {
                    return "Q" + dayjs(val).quarter() + " " + dayjs(val).format("YYYY")
                }
            }
        },
    };
allCharts.push([{ 'id': 'column_with_group_label_chart', 'data': columnWithGroupLabelChartOptions }]);

//  Column with Rotated Labels Charts
const ColumnWithRotatedLabelsChartEl = document.querySelector('#column_with_rotated_labels_chart'),
    ColumnWithRotatedLabelsChartOptions = {
        series: [{
            name: 'Servings',
            data: [44, 55, 41, 67, 22, 43, 21, 33, 45, 31, 87, 65, 35]
        }],
        annotations: {
            points: [{
                x: 'Bananas',
                seriesIndex: 0,
                label: {
                    borderColor: '--bs-primary',
                    offsetY: 0,
                    style: {
                        color: '#fff',
                        background: '--bs-primary',
                    },
                    text: 'Bananas are good',
                }
            }]
        },
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                columnWidth: '50%',
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 0
        },
        xaxis: {
            labels: {
                rotate: -45
            },
            categories: ['Apples', 'Oranges', 'Strawberries', 'Pineapples', 'Mangoes', 'Bananas',
                'Blackberries', 'Pears', 'Watermelons', 'Cherries', 'Pomegranates', 'Tangerines', 'Papayas'
            ],
            tickPlacement: 'on'
        },
        yaxis: {
            title: {
                text: 'Servings',
            },
        },
        colors: ['--bs-primary'],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
        }
    };
allCharts.push([{ 'id': 'column_with_rotated_labels_chart', 'data': ColumnWithRotatedLabelsChartOptions }]);

//  Column with Negative Values Charts
const columnWithNegativeValuesChartEl = document.querySelector('#column_with_negative_values_chart'),
    columnWithNegativeValuesChartOptions = {
        series: [{
            name: 'Cash Flow',
            data: [1.45, 5.42, 5.9, -0.42, -12.6, -18.1, -18.2, -14.16, -11.1, -6.09, 0.34, 3.88, 13.07,
                5.8, 2, 7.37, 8.1, 13.57, 15.75, 17.1, 19.8, -27.03, -54.4, -47.2, -43.3, -18.6, -
                48.6, -41.1, -39.6, -37.6, -29.4, -21.4, -2.4
            ]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                colors: {
                    ranges: [{
                        from: -100,
                        to: -46,
                        color: '#F15B46'
                    }, {
                        from: -45,
                        to: 0,
                        color: '#FEB019'
                    }]
                },
                columnWidth: '80%',
            }
        },
        dataLabels: {
            enabled: false,
        },
        colors: ['--bs-primary', '--bs-danger'],
        yaxis: {
            title: {
                text: 'Growth',
            },
            labels: {
                formatter: function (y) {
                    return y.toFixed(0) + "%";
                }
            }
        },
        xaxis: {
            type: 'datetime',
            categories: [
                '2011-01-01', '2011-02-01', '2011-03-01', '2011-04-01', '2011-05-01', '2011-06-01',
                '2011-07-01', '2011-08-01', '2011-09-01', '2011-10-01', '2011-11-01', '2011-12-01',
                '2012-01-01', '2012-02-01', '2012-03-01', '2012-04-01', '2012-05-01', '2012-06-01',
                '2012-07-01', '2012-08-01', '2012-09-01', '2012-10-01', '2012-11-01', '2012-12-01',
                '2013-01-01', '2013-02-01', '2013-03-01', '2013-04-01', '2013-05-01', '2013-06-01',
                '2013-07-01', '2013-08-01', '2013-09-01'
            ],
            labels: {
                rotate: -90
            }
        }
    };
allCharts.push([{ 'id': 'column_with_negative_values_chart', 'data': columnWithNegativeValuesChartOptions }]);
