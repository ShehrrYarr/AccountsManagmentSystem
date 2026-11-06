/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: apexcharts-funnel.init.js
*/

// Basic Range Area Chart
const recruitmentFunnelChartEl = document.querySelector('#recruitment_funnel_chart'),
    recruitmentFunnelChartOptions = {
        series: [
            {
                name: "Funnel Series",
                data: [1380, 1100, 990, 880, 740, 548, 330, 200],
            },
        ],
        chart: {
            type: 'bar',
            height: 350,
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -30,
                bottom: -20,
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 0,
                horizontal: true,
                barHeight: '80%',
                isFunnel: true,
            },
        },
        colors: ['--bs-primary'],
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex] + ':  ' + val
            },
        },
        xaxis: {
            categories: [
                'Sourced',
                'Screened',
                'Assessed',
                'HR Interview',
                'Technical',
                'Verify',
                'Offered',
                'Hired',
            ],
        },
        legend: {
            show: false,
        },
    };
allCharts.push([{ 'id': 'recruitment_funnel_chart', 'data': recruitmentFunnelChartOptions }]);

// Pyramid Funnel Chart
const PyramidFunnelChartEl = document.querySelector('#pyramid_funnel_chart'),
    PyramidFunnelChartOptions = {
        series: [
            {
                name: "",
                data: [200, 330, 548, 740, 880, 990, 1100, 1380],
            },
        ],
        chart: {
            type: 'bar',
            height: 350,
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false
            }
        },
        grid: {
            padding: {
                top: -30,
                bottom: -20,
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 0,
                horizontal: true,
                distributed: true,
                barHeight: '80%',
                isFunnel: true,
            },
        },
        colors: [
            '#F44F5E',
            '#E55A89',
            '#D863B1',
            '#CA6CD8',
            '#B57BED',
            '#8D95EB',
            '#62ACEA',
            '#4BC3E6',
        ],
        dataLabels: {
            enabled: true,
            formatter: function (val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex]
            },
            dropShadow: {
                enabled: true,
            },
        },
        xaxis: {
            categories: ['Sweets', 'Processed Foods', 'Healthy Fats', 'Meat', 'Beans & Legumes', 'Dairy', 'Fruits & Vegetables', 'Grains'],
        },
        legend: {
            show: false,
        },
    };
allCharts.push([{ 'id': 'pyramid_funnel_chart', 'data': PyramidFunnelChartOptions }]);
