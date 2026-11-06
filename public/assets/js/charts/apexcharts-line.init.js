/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-line.init.js
*/

// Basic Line Chart
const basicLineChartEl = document.querySelector('#basic_line_chart'),
    basicLineChartOptions = {
        series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
        chart: {
            height: 320,
            type: 'line',
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
        },
        grid: {
            padding: {
                top: -10,
                left: -20,
                right: -5,
                bottom: -10,
            }
        },
        colors: ['--bs-primary'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight',
            width: 3,
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        },
    };
allCharts.push([{ 'id': 'basic_line_chart', 'data': basicLineChartOptions }]);

// Line Chart with Data Labels
const chartWithDataLabelsEl = document.querySelector('#line_chart_with_data_labels'),
    chartWithDataLabelsOptions = {
        series: [
            {
                name: "React",
                data: [35, 38, 42, 45, 48, 52, 55]
            },
            {
                name: "Vue",
                data: [10, 12, 16, 20, 23, 25, 30]
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            dropShadow: {
                enabled: true,
                top: 10,
                left: 5,
                blur: 8,
                opacity: 0.2
            },
            toolbar: {
                show: false,
            },
            zoom: {
                enabled: false
            },
        },
        colors: ['--bs-primary', '--bs-success'],
        dataLabels: {
            enabled: true,
        },
        stroke: {
            curve: 'smooth'
        },
        markers: {
            size: 4,
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            labels: {
                show: true,
            },
            title: {
                text: 'Months of 2025',
            },
        },
        yaxis: {
            title: {
                text: 'Active Users (K)',
            },
            labels: {
                show: true,
            },
            min: 5,
            max: 60
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetX: -10
        }
    };
allCharts.push([{ 'id': 'line_chart_with_data_labels', 'data': chartWithDataLabelsOptions }]);

// Function to generate random data for a specified number of data points
function generateRandomData(numPoints) {
    const data = [];
    const startDate = new Date('2025-01-01').getTime(); // Start date for the time series
    const oneDay = 24 * 60 * 60 * 1000; // One day in milliseconds

    for (let i = 0; i < numPoints; i++) {
        const randomDate = startDate + i * oneDay; // Generate the next date in the series
        const randomValue = Math.floor(Math.random() * 6); // Random value between 0 and 5
        data.push({
            x: randomDate,
            y: randomValue
        });
    }
    return data;
}

// Generate random data (e.g., 50 points)
const chartData = generateRandomData(50);

// Zoomable Time Series
const zoomableTimeSeriesEl = document.querySelector('#zoomable_time_series'),
    zoomableTimeSeriesOptions = {
        series: [{
            name: 'XYZ MOTORS',
            data: chartData
        }],
        chart: {
            type: 'area',
            stacked: false,
            height: 350,
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: {
                autoSelected: 'zoom'
            }
        },
        grid: {
            padding: {
                top: 10,
            }
        },
        dataLabels: {
            enabled: false
        },
        markers: {
            size: 0,
        },
        colors: ['--bs-primary'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 90, 100]
            },
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return val.toFixed(0);  // Display the Y-axis value without scaling
                },
                offsetX: 10, // Adjust this value for horizontal positioning
            },
            title: {
                text: 'Count'
            },
            min: 0,  // Set the minimum value of Y-axis
            max: 5   // Set the maximum value of Y-axis
        },
        xaxis: {
            type: 'datetime',
            title: {
                text: 'Months of 2025',
                offsetY: 7,
            },
            labels: {
                formatter: function (value) {
                    // Format the X-axis labels to show the month and year (e.g., "Jan 2025")
                    const date = new Date(value);
                    const options = { year: 'numeric', month: 'short' };
                    return date.toLocaleDateString('en-US', options);
                }
            }
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function (val) {
                    return val.toFixed(0)  // Display the tooltip without scaling
                }
            }
        }
    };
allCharts.push([{ 'id': 'zoomable_time_series', 'data': zoomableTimeSeriesOptions }]);

// Dash line chart
const dashLineChartEl = document.querySelector('#dash-line-chart'),
    dashLineChartOptions = {
        chart: {
            height: 380,
            type: 'line',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false,
            }
        },
        colors: ['--bs-primary', '--bs-success', '--bs-danger'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: [3, 4, 3],
            curve: 'straight',
            dashArray: [0, 8, 5]
        },
        series: [{
            name: "Session Duration",
            data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
        },
        {
            name: "Page Views",
            data: [36, 42, 60, 42, 13, 18, 29, 37, 36, 51, 32, 35]
        },
        {
            name: 'Total Visits',
            data: [89, 56, 74, 98, 72, 38, 64, 46, 84, 58, 46, 49]
        }
        ],
        markers: {
            size: 0,

            hover: {
                sizeOffset: 6
            }
        },
        xaxis: {
            categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
                '10 Jan', '11 Jan', '12 Jan'
            ],
        },
        tooltip: {
            y: [{
                title: {
                    formatter: function (val) {
                        return val + " (mins)"
                    }
                }
            }, {
                title: {
                    formatter: function (val) {
                        return val + " per session"
                    }
                }
            }, {
                title: {
                    formatter: function (val) {
                        return val;
                    }
                }
            }]
        },
    };
allCharts.push([{ 'id': 'dash-line-chart', 'data': dashLineChartOptions }]);

// Line with Annotations Chart
const lineWithAnnotationsChartEL = document.querySelector('#line-with-annotations-chart'),
    lineWithAnnotationsChartOptions = {
        series: [{
            data: [8300, 8500, 8800, 8700, 8600, 8900, 9000, 9100, 9200, 8800, 8700, 8600],
        }],
        chart: {
            height: 350,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        annotations: {
            yaxis: [{
                y: 8200,
                label: {
                    style: {
                        background: '--bs-danger'
                    },
                    text: 'Support',
                }
            }, {
                y: 8600,
                y2: 9000,
                opacity: 0.2,
                label: {
                    style: {
                        background: '--bs-primary',
                    },
                    text: 'Y-axis range',
                }
            }],
            xaxis: [{
                x: new Date('03 Nov 2017').getTime(),
                strokeDashArray: 0,
                label: {
                    style: {
                        background: '--bs-success',
                    },
                    text: 'Annotation Test',
                }
            }, {
                x: new Date('07 Nov 2017').getTime(),
                x2: new Date('09 Nov 2017').getTime(),
                fillColor: '#51d28c',
                opacity: 0.4,
                label: {
                    style: {
                        background: '--bs-pink',
                    },
                    offsetY: -10,
                    text: 'X-axis range',
                }
            }],
            points: [{
                x: new Date('05 Nov 2017').getTime(),
                y: 8607.55,
                marker: {
                    size: 8,
                    fillColor: '#fff',
                    strokeColor: '--bs-pink',
                    radius: 2,
                },
                label: {
                    offsetY: 0,
                    style: {
                        background: '--bs-orange',
                    },
                    text: 'Point Annotation',
                }
            }, {
                x: new Date('11 Nov 2017').getTime(),
                y: 9340.85,
                marker: {
                    size: 0
                },
                image: {
                    path: '../../images/test.jpg',
                    width: 40,
                    height: 40
                }
            }]
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        colors: ['#FF5733'],
        grid: {
            padding: {
                right: 30,
                left: 20
            }
        },
        labels: [
            new Date('01 Nov 2017').getTime(),
            new Date('02 Nov 2017').getTime(),
            new Date('03 Nov 2017').getTime(),
            new Date('04 Nov 2017').getTime(),
            new Date('05 Nov 2017').getTime(),
            new Date('06 Nov 2017').getTime(),
            new Date('07 Nov 2017').getTime(),
            new Date('08 Nov 2017').getTime(),
            new Date('09 Nov 2017').getTime(),
            new Date('10 Nov 2017').getTime(),
            new Date('11 Nov 2017').getTime(),
            new Date('12 Nov 2017').getTime()
        ],
        xaxis: {
            type: 'datetime',
        }
    };
allCharts.push([{ 'id': 'line-with-annotations-chart', 'data': lineWithAnnotationsChartOptions }]);

// Brush Chart
function generateDayWiseTimeSeries(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = baseval;
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push([x, y]);
        baseval += 86400000;
        i++;
    }
    return series;
}
var data = generateDayWiseTimeSeries(new Date('11 Feb 2017').getTime(), 185, {
    min: 30,
    max: 90
})

const brushChartEl = document.querySelector('#chart-line2'),
    brushChartOptions = {
        series: [{
            data: data
        }],
        chart: {
            id: 'chart2',
            type: 'line',
            height: 200,
            toolbar: {
                autoSelected: 'pan',
                show: false
            }
        },
        colors: ['--bs-primary'],
        stroke: {
            width: 3
        },
        fill: {
            opacity: 1,
        },
        markers: {
            size: 0
        },
        grid: {
            borderColor: '#f2f5f7',
        },
        xaxis: {
            type: 'datetime',
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            },
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-yaxis-label',
                },
            },
        }
    };
allCharts.push([{ 'id': 'chart-line2', 'data': brushChartOptions }]);

// Brush Chart 2
const chartLineEl = document.querySelector('#chart-line'),
    chartLineOptions = {
        series: [{
            data: data
        }],
        chart: {
            id: 'chart1',
            height: 130,
            type: 'area',
            brush: {
                target: 'chart2',
                enabled: true
            },
            selection: {
                enabled: true,
                xaxis: {
                    min: new Date('19 Jun 2017').getTime(),
                    max: new Date('14 Aug 2017').getTime()
                }
            },
        },
        dataLabels: {
            enabled: false,
        },
        colors: ['--bs-danger'],
        fill: {
            type: 'gradient',
            gradient: {
                opacityFrom: 0.91,
                opacityTo: 0.1,
            }
        },
        grid: {
            borderColor: '#f2f5f7',
        },
        markers: {
            size: 0
        },
        xaxis: {
            type: 'datetime',
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            },
            tooltip: {
                enabled: false
            }
        },
        yaxis: {
            tickAmount: 2,
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-yaxis-label',
                },
            },
        }
    };
allCharts.push([{ 'id': 'chart-line', 'data': chartLineOptions }]);

// Stepline Charts
const steplineChartEl = document.querySelector('#stepline-chart'),
    steplineChartOptions = {
        series: [{
            name: 'Monthly Sales',
            data: [5000, 7000, 6000, 8000, 9000, 7500, 10000, 9500, 11000, 12000, 13000, 14000] // Sales data over 12 months
        }],
        chart: {
            type: 'line',
            height: 350,
            toolbar: {
                show: false
            },
        },
        stroke: {
            curve: 'stepline',
        },
        dataLabels: {
            enabled: false
        },
        markers: {
            hover: {
                sizeOffset: 4
            }
        },
        colors: ['--bs-primary'],
        title: {
            text: 'Company Monthly Sales Overview',
            align: 'center',
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            title: {
                text: 'Months'
            }
        },
        yaxis: {
            title: {
                text: 'Sales ($)'
            },
            min: 0,
        }
    };
allCharts.push([{ 'id': 'stepline-chart', 'data': steplineChartOptions }]);

// Gradient Line Charts
const gradientLineChartEl = document.querySelector('#gradient-line-chart'),
    gradientLineChartOptions = {
        series: [{
            name: 'Sales',
            data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
        }],
        chart: {
            height: 320,
            type: 'line',
        },
        forecastDataPoints: {
            count: 7
        },
        stroke: {
            width: 3,
            curve: 'smooth'
        },
        xaxis: {
            type: 'datetime',
            categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001', '4/11/2001', '5/11/2001', '6/11/2001'],
            tickAmount: 10,
            labels: {
                formatter: function (value, timestamp, opts) {
                    return opts.dateFormatter(new Date(timestamp), 'dd MMM')
                },
            }
        },
        title: {
            text: 'Forecast',
            align: 'left',
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                gradientToColors: ['--bs-primary'],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            },
        },
        yaxis: {
            min: -10,
            max: 40,
            labels: {
                show: true,
            }
        }
    };
allCharts.push([{ 'id': 'gradient-line-chart', 'data': gradientLineChartOptions }]);
