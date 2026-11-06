/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-bar.init.js
*/

// Basic Area Chart
const basicBarChartEl = document.querySelector('#basic_bar_chart'),
    basicBarChartOptions = {
        series: [{
            data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
                bottom: -10,
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                borderRadiusApplication: 'end',
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        colors: ['--bs-primary'],
        xaxis: {
            categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
                'United States', 'China', 'Germany'
            ],
        }
    };
allCharts.push([{ 'id': 'basic_bar_chart', 'data': basicBarChartOptions }]);

// Grouped Bar Charts
const groupedBarChartEl = document.querySelector('#grouped_bar_chart'),
    groupedBarChartOptions = {
        series: [{
            data: [44, 55, 41, 64, 22, 43, 21]
        }, {
            data: [53, 32, 33, 52, 13, 44, 32]
        }],
        chart: {
            type: 'bar',
            height: 430,
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                dataLabels: {
                    position: 'top',
                },
            }
        },
        dataLabels: {
            enabled: true,
            offsetX: -6,
            style: {
                fontSize: '12px',
                colors: ['#fff']
            }
        },
        stroke: {
            show: true,
            width: 1,
            colors: ['#fff']
        },
        tooltip: {
            shared: true,
            intersect: false
        },
        colors: ['--bs-primary', '--bs-success'],
        xaxis: {
            categories: [2001, 2002, 2003, 2004, 2005, 2006, 2007],
        },
    };
allCharts.push([{ 'id': 'grouped_bar_chart', 'data': groupedBarChartOptions }]);

// Stacked Bar Chart
const stackedBarChartEl = document.querySelector('#stacked_bar_chart'),
    stackedBarChartOptions = {
        series: [{
            name: 'Marine Sprite',
            data: [44, 55, 41, 37, 22, 43, 21]
        }, {
            name: 'Striking Calf',
            data: [53, 32, 33, 52, 13, 43, 32]
        }, {
            name: 'Tank Picture',
            data: [12, 17, 11, 9, 15, 11, 20]
        }, {
            name: 'Bucket Slope',
            data: [9, 7, 5, 8, 6, 9, 4]
        }, {
            name: 'Reborn Kid',
            data: [25, 12, 19, 32, 25, 24, 10]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
                right: -10
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                dataLabels: {
                    total: {
                        enabled: true,
                        offsetX: 0,
                    }
                }
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        xaxis: {
            categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
            labels: {
                formatter: function (val) {
                    return val + "K"
                }
            }
        },
        yaxis: {
            title: {
                text: undefined
            },
        },
        colors: ['--bs-primary', '--bs-success', '--bs-warning', '--bs-danger', '--bs-info'],
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "K"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            offsetY: 10
        }
    };
allCharts.push([{ 'id': 'stacked_bar_chart', 'data': stackedBarChartOptions }]);

// Stacked Bars 100 Charts
const stackedBars100ChartEl = document.querySelector('#stacked_bar_100_chart'),
    stackedBars100ChartOptions = {
        series: [{
            name: 'Marine Sprite',
            data: [44, 55, 41, 37, 22, 43, 21]
        }, {
            name: 'Striking Calf',
            data: [53, 32, 33, 52, 13, 43, 32]
        }, {
            name: 'Tank Picture',
            data: [12, 17, 11, 9, 15, 11, 20]
        }, {
            name: 'Bucket Slope',
            data: [9, 7, 5, 8, 6, 9, 4]
        }, {
            name: 'Reborn Kid',
            data: [25, 12, 19, 32, 25, 24, 10]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            stackType: '100%',
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
                right: -10
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        xaxis: {
            categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "K"
                }
            }
        },
        fill: {
            opacity: 1

        },
        colors: ['--bs-primary', '--bs-success', '--bs-warning', '--bs-danger', '--bs-info'],
        legend: {
            position: 'bottom',
            horizontalAlign: 'center'
        }
    };
allCharts.push([{ 'id': 'stacked_bar_100_chart', 'data': stackedBars100ChartOptions }]);

// Grouped Stacked Bars Charts
const groupedStackedBarsChartEl = document.querySelector('#grouped_stacked_bar_chart'),
    groupedStackedBarsChartOptions = {
        series: [
            {
                name: 'Q1 Budget',
                group: 'budget',
                data: [44000, 55000, 41000, 67000, 22000]
            },
            {
                name: 'Q1 Actual',
                group: 'actual',
                data: [48000, 50000, 40000, 65000, 25000]
            },
            {
                name: 'Q2 Budget',
                group: 'budget',
                data: [13000, 36000, 20000, 8000, 13000]
            },
            {
                name: 'Q2 Actual',
                group: 'actual',
                data: [20000, 40000, 25000, 10000, 12000]
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
        grid: {
            padding: {
                top: -20,
            }
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        dataLabels: {
            formatter: (val) => {
                return val / 1000 + 'K'
            }
        },
        plotOptions: {
            bar: {
                horizontal: true
            }
        },
        xaxis: {
            categories: [
                'Online advertising',
                'Sales Training',
                'Print advertising',
                'Catalogs',
                'Meetings'
            ],
            labels: {
                formatter: (val) => {
                    return val / 1000 + 'K'
                }
            }
        },
        fill: {
            opacity: 1,
        },
        colors: ['--bs-primary', '--bs-success', '--bs-warning', '--bs-info'],
        legend: {
            position: 'bottom',
            horizontalAlign: 'center'
        }
    };
allCharts.push([{ 'id': 'grouped_stacked_bar_chart', 'data': groupedStackedBarsChartOptions }]);

// Bar with Negative Values Charts
const barWithNegativeValuesChartEl = document.querySelector('#bar_with_negative_values_chart'),
    barWithNegativeValuesChartOptions = {
        series: [{
            name: 'Males',
            data: [0.4, 0.65, 0.76, 0.88, 1.5, 2.1, 2.9, 3.8, 3.9, 4.2, 4, 4.3, 4.1, 4.2, 4.5,
                3.9, 3.5, 3
            ]
        },
        {
            name: 'Females',
            data: [-0.8, -1.05, -1.06, -1.18, -1.4, -2.2, -2.85, -3.7, -3.96, -4.22, -4.3, -4.4,
            -4.1, -4, -4.1, -3.4, -3.1, -2.8
            ]
        }
        ],
        chart: {
            type: 'bar',
            height: 440,
            stacked: true,
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        colors: ['--bs-danger', '--bs-primary'],
        plotOptions: {
            bar: {
                borderRadius: 5,
                borderRadiusApplication: 'end', // 'around', 'end'
                borderRadiusWhenStacked: 'all', // 'all', 'last'
                horizontal: true,
                barHeight: '80%',
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 1,
            colors: ["#fff"]
        },

        grid: {
            xaxis: {
                lines: {
                    show: false
                }
            }
        },
        yaxis: {
            stepSize: 1
        },
        tooltip: {
            shared: false,
            x: {
                formatter: function (val) {
                    return val
                }
            },
            y: {
                formatter: function (val) {
                    return Math.abs(val) + "%"
                }
            }
        },
        xaxis: {
            categories: ['85+', '80-84', '75-79', '70-74', '65-69', '60-64', '55-59', '50-54',
                '45-49', '40-44', '35-39', '30-34', '25-29', '20-24', '15-19', '10-14', '5-9',
                '0-4'
            ],
            title: {
                text: 'Percent'
            },
            labels: {
                formatter: function (val) {
                    return Math.abs(Math.round(val)) + "%"
                }
            }
        },
    };
allCharts.push([{ 'id': 'bar_with_negative_values_chart', 'data': barWithNegativeValuesChartOptions }]);

// Bar with Markers Charts
const barWithMarkersChartEl = document.querySelector('#bar_with_markers_chart'),
    barWithMarkersChartOptions = {
        series: [{
            name: 'Actual',
            data: [{
                x: '2011',
                y: 12,
                goals: [{
                    name: 'Expected',
                    value: 14,
                    strokeWidth: 5,
                    strokeColor: '#564ab1'
                }]
            },
            {
                x: '2012',
                y: 44,
                goals: [{
                    name: 'Expected',
                    value: 54,
                    strokeWidth: 5,
                    strokeColor: '#564ab1'
                }]
            },
            {
                x: '2013',
                y: 54,
                goals: [{
                    name: 'Expected',
                    value: 52,
                    strokeWidth: 5,
                    strokeColor: '#564ab1'
                }]
            },
            {
                x: '2014',
                y: 66,
                goals: [{
                    name: 'Expected',
                    value: 65,
                    strokeWidth: 5,
                    strokeColor: '#564ab1'
                }]
            },
            {
                x: '2015',
                y: 81,
                goals: [{
                    name: 'Expected',
                    value: 66,
                    strokeWidth: 5,
                    strokeColor: '#564ab1'
                }]
            },
            {
                x: '2016',
                y: 67,
                goals: [{
                    name: 'Expected',
                    value: 70,
                    strokeWidth: 5,
                    strokeColor: '#564ab1'
                }]
            }
            ]
        }],
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        colors: ['#00E396'],
        colors: ['--bs-primary'],
        dataLabels: {
            formatter: function (val, opt) {
                const goals =
                    opt.w.config.series[opt.seriesIndex].data[opt.dataPointIndex]
                        .goals

                if (goals && goals.length) {
                    return `${val} / ${goals[0].value}`
                }
                return val
            }
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            customLegendItems: ['Actual', 'Expected'],
            markers: {
                fillColors: ['#00E396', '#775DD0']
            }
        }
    };
allCharts.push([{ 'id': 'bar_with_markers_chart', 'data': barWithMarkersChartOptions }]);

// Reversed Bar Chart
const reversedBarChartEl = document.querySelector('#reversed_bar_chart'),
    reversedBarChartOptions = {
        series: [{
            data: [400, 430, 448, 470, 540, 580, 690]
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false
            }
        },
        annotations: {
            xaxis: [{
                x: 500,
                borderColor: '#28a745',
                label: {
                    borderColor: '#28a745',
                    style: {
                        background: '#28a745',
                    },
                    text: 'X annotation',
                }
            }],
            yaxis: [{
                y: 'July',
                y2: 'September',
                label: {
                    text: 'Y annotation',
                    style: {
                        background: '#5b71b9',
                    }
                }
            }]
        },
        plotOptions: {
            bar: {
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: true
        },
        xaxis: {
            categories: ['June', 'July', 'August', 'September', 'October', 'November', 'December'],
        },
        colors: ['--bs-success'],
        grid: {
            xaxis: {
                lines: {
                    show: true
                }
            },
            padding: {
                top: -20,
            }
        },
        yaxis: {
            reversed: true,
            axisTicks: {
                show: true
            }
        }
    };
allCharts.push([{ 'id': 'reversed_bar_chart', 'data': reversedBarChartOptions }]);

// Custom DataLabels Bar Chart
const customDataLabelsBarChartEl = document.querySelector('#custom_dataLabels_bar_chart'),
    customDataLabelsBarChartOptions = {
        series: [{
            data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
        }],
        chart: {
            type: 'bar',
            height: 380,
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -20,
            },
        },
        plotOptions: {
            bar: {
                barHeight: '100%',
                distributed: true,
                horizontal: true,
                dataLabels: {
                    position: 'bottom'
                },
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning', '--bs-info', '--bs-purple', '--bs-pink', '--bs-orange', '--bs-teal', '--bs-warning'],
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
            },
            offsetX: 0,
            dropShadow: {
                enabled: true
            }
        },
        stroke: {
            width: 1,
        },
        xaxis: {
            categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
                'United States', 'China', 'India'
            ],
        },
        yaxis: {
            labels: {
                show: false
            }
        },
        tooltip: {
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function () {
                        return ''
                    }
                }
            }
        }
    };
allCharts.push([{ 'id': 'custom_dataLabels_bar_chart', 'data': customDataLabelsBarChartOptions }]);

// Patterned Bar Chart
const patternedBarChartEl = document.querySelector('#patterned_bar_chart'),
    patternedBarChartOptions = {
        series: [{
            name: 'Marine Sprite',
            data: [44, 55, 41, 37, 22, 43, 21]
        }, {
            name: 'Striking Calf',
            data: [53, 32, 33, 52, 13, 43, 32]
        }, {
            name: 'Tank Picture',
            data: [12, 17, 11, 9, 15, 11, 20]
        }, {
            name: 'Bucket Slope',
            data: [9, 7, 5, 8, 6, 9, 4]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: false
            },
            dropShadow: {
                enabled: true,
                blur: 1,
                opacity: 0.1
            }
        },
        grid: {
            padding: {
                top: -20,
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '60%',
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 2,
        },
        xaxis: {
            categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
        },
        yaxis: {
            title: {
                text: undefined
            },
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function (val) {
                    return val + "K"
                }
            }
        },
        fill: {
            type: 'pattern',
            opacity: 1,
            pattern: {
                style: ['circles', 'slantedLines', 'verticalLines', 'horizontalLines'], // string or array of strings

            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger', '--bs-warning'],
        states: {
            hover: {
                filter: 'none'
            }
        },
        legend: {
            position: 'bottom',
        }
    };
allCharts.push([{ 'id': 'patterned_bar_chart', 'data': patternedBarChartOptions }]);

// Bar with Images Chart
const ImagesBarChartEl = document.querySelector('#images_bar_chart'),
    ImagesBarChartOptions = {
        series: [{
            name: 'Coins Collected',
            data: [2, 4, 3, 4, 3, 5, 5, 6.5, 6, 5, 4, 5, 8, 7, 7, 8, 8, 10, 9, 9, 12, 12, 11, 12, 13, 14, 16, 14, 15, 17, 19, 21]
        }],
        chart: {
            type: 'bar',
            height: 410,
            animations: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '100%',
            },
        },
        stroke: {
            width: 1,
            colors: ['#000'],
        },
        labels: [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March',
            'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September'
        ],
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                show: false
            },
        },
        grid: {
            position: 'back',
            padding: {
                top: -20,
                left: -10
            }
        },
        fill: {
            type: 'image',
            opacity: 0.57,
            image: {
                src: 'assets/images/small/img-7.jpg', // Background image URL
                height: 600,
            },
        },
    };
allCharts.push([{ 'id': 'images_bar_chart', 'data': ImagesBarChartOptions }]);
