/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-radialbar.init.js
*/

// Basic Polararea Chart
const basicRadialbarChartEl = document.querySelector('#basic_radialbar_chart'),
    basicRadialbarChartOptions = {
        series: [70],
        chart: {
            height: 350,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                }
            },
        },
        labels: ['Cricket'],
        colors: ['--bs-primary'],
    };
allCharts.push([{ 'id': 'basic_radialbar_chart', 'data': basicRadialbarChartOptions }]);

// Multiple Radialbar Chart
const multipleRadialbarChartEl = document.querySelector('#multiple_radialbar_chart'),
    multipleRadialbarChartOptions = {
        series: [44, 55, 67, 83],
        chart: {
            height: 350,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total',
                        formatter: function (w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return 249
                        }
                    }
                }
            }
        },
        labels: ['Apples', 'Oranges', 'Bananas', 'Berries'],
        colors: ['--bs-primary', '--bs-success', '--bs-warning', '--bs-danger'],
    };
allCharts.push([{ 'id': 'multiple_radialbar_chart', 'data': multipleRadialbarChartOptions }]);

// Custom Angle Circle Chart
const customAngleCircleChartEl = document.querySelector('#custom_angle_circle_chart'),
    customAngleCircleChartOptions = {
        series: [76, 67, 61, 90],
        chart: {
            height: 390,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                offsetY: 0,
                startAngle: 0,
                endAngle: 270,
                hollow: {
                    margin: 5,
                    size: '30%',
                    background: 'transparent',
                    image: undefined,
                },
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        show: false,
                    }
                },
                barLabels: {
                    enabled: true,
                    useSeriesColors: true,
                    offsetX: -8,
                    formatter: function (seriesName, opts) {
                        return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                    },
                },
            }
        },
        labels: ['Vimeo', 'Messenger', 'Facebook', 'LinkedIn'],
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    show: false
                }
            }
        }],
        colors: ['--bs-primary', '--bs-success', '--bs-warning', '--bs-danger'],
    };
allCharts.push([{ 'id': 'custom_angle_circle_chart', 'data': customAngleCircleChartOptions }]);

// Gradient Chart
const gradientChartEl = document.querySelector('#gradient_chart'),
    gradientChartOptions = {
        series: [75],
        chart: {
            height: 350,
            type: 'radialBar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: '70%',
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: 'front',
                },
                track: {
                    strokeWidth: '67%',
                    margin: 0,

                },
                dataLabels: {
                    show: true,
                    name: {
                        offsetY: -10,
                        show: true,
                        color: '#888',
                        fontSize: '17px'
                    },
                    value: {
                        formatter: function (val) {
                            return parseInt(val);
                        },
                        color: '#111',
                        fontSize: '36px',
                        show: true,
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: ['--bs-primary'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke: {
            lineCap: 'round'
        },
        labels: ['Percent'],
    };
allCharts.push([{ 'id': 'gradient_chart', 'data': gradientChartOptions }]);

// Radialbars with Image Chart
const radialbarsWithImageEl = document.querySelector('#radialbars_with_image_chart'),
    radialbarsWithImageOptions = {
        series: [67],
        chart: {
            height: 350,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    margin: 15,
                    size: '70%',
                },
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        show: true,
                    }
                }
            }
        },
        fill: {
            type: 'image',
            image: {
                src: ['assets/images/small/img-5.jpg'],
            }
        },
        stroke: {
            lineCap: 'round'
        },
        labels: ['Volatility'],
    };
allCharts.push([{ 'id': 'radialbars_with_image_chart', 'data': radialbarsWithImageOptions }]);

// Stroked Gauge Chart
const strokedGaugeChartEl = document.querySelector('#stroked_gauge_chart'),
    strokedGaugeChartOptions = {
        series: [67],
        chart: {
            height: 350,
            type: 'radialBar',
            offsetY: -10
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                dataLabels: {
                    name: {
                        offsetY: 120
                    },
                    value: {
                        offsetY: 76,
                        formatter: function (val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        labels: ['Median Ratio'],
        colors: ['--bs-primary']
    };
allCharts.push([{ 'id': 'stroked_gauge_chart', 'data': strokedGaugeChartOptions }]);

// Semi Circle Gauge Chart
const semiCircleGaugeChartEl = document.querySelector('#semi_circle_gauge_chart'),
    semiCircleGaugeChartOptions = {
        series: [76],
        chart: {
            type: 'radialBar',
            offsetY: -20,
            sparkline: {
                enabled: true
            }
        },
        plotOptions: {
            radialBar: {
                startAngle: -90,
                endAngle: 90,
                track: {
                    strokeWidth: '97%',
                    margin: 5, // margin is in pixels
                    dropShadow: {
                        enabled: false,
                    }
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: -2,
                    }
                }
            }
        },
        grid: {
            padding: {
                top: -10
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                shadeIntensity: 0.4,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 53, 91]
            },
        },
        labels: ['Average Results'],
        colors: ['--bs-primary']
    };
allCharts.push([{ 'id': 'semi_circle_gauge_chart', 'data': semiCircleGaugeChartOptions }]);
