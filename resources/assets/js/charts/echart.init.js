/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: echart.init.js
*/

(function () {
    "use strict";

    // Basic Line Chart
    var basicLineChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        },
        yAxis: {
            type: 'value',
        },
        series: [{
            data: [150, 230, 224, 218, 135, 147, 260],
            type: 'line'
        }],
        color: ['--bs-primary']
    };
    allCharts.push([{ 'id': 'basicLineChart', 'data': basicLineChartOption }]);

    // Stacked Line Chart
    var stackedLineChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['Email', 'Union Ads', 'Video Ads', 'Direct', 'Search Engine']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name: 'Email',
                type: 'line',
                stack: 'Total',
                data: [120, 132, 101, 134, 90, 230, 210]
            },
            {
                name: 'Union Ads',
                type: 'line',
                stack: 'Total',
                data: [220, 182, 191, 234, 290, 330, 310]
            },
            {
                name: 'Video Ads',
                type: 'line',
                stack: 'Total',
                data: [150, 232, 201, 154, 190, 330, 410]
            },
            {
                name: 'Direct',
                type: 'line',
                stack: 'Total',
                data: [320, 332, 301, 334, 390, 330, 320]
            },
            {
                name: 'Search Engine',
                type: 'line',
                stack: 'Total',
                data: [820, 932, 901, 934, 1290, 1330, 1320]
            }
        ],
        color: ['--bs-info', '--bs-success', '--bs-danger', '--bs-warning', '--bs-primary']
    };
    allCharts.push([{ 'id': 'stackedLineChart', 'data': stackedLineChartOption }]);

    // Stacked Area Chart
    var stackedAreaChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
            }
        },
        legend: {
            data: ['Email', 'Union Ads', 'Video Ads', 'Direct', 'Search Engine']
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',
                boundaryGap: false,
                data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: 'Email',
                type: 'line',
                stack: 'Total',
                areaStyle: {},
                emphasis: {
                    focus: 'series'
                },
                data: [120, 132, 101, 134, 90, 230, 210]
            },
            {
                name: 'Union Ads',
                type: 'line',
                stack: 'Total',
                areaStyle: {},
                emphasis: {
                    focus: 'series'
                },
                data: [220, 182, 191, 234, 290, 330, 310]
            },
            {
                name: 'Video Ads',
                type: 'line',
                stack: 'Total',
                areaStyle: {},
                emphasis: {
                    focus: 'series'
                },
                data: [150, 232, 201, 154, 190, 330, 410]
            },
            {
                name: 'Direct',
                type: 'line',
                stack: 'Total',
                areaStyle: {},
                emphasis: {
                    focus: 'series'
                },
                data: [320, 332, 301, 334, 390, 330, 320]
            },
            {
                name: 'Search Engine',
                type: 'line',
                stack: 'Total',
                label: {
                    show: true,
                    position: 'top'
                },
                areaStyle: {},
                emphasis: {
                    focus: 'series'
                },
                data: [820, 932, 901, 934, 1290, 1330, 1320]
            }
        ],
        color: ['--bs-info', '--bs-success', '--bs-danger', '--bs-warning', '--bs-primary']
    };
    allCharts.push([{ 'id': 'stackedAreaChart', 'data': stackedAreaChartOption }]);

    // Line Style and Item Style Chart
    var lineAndItemStyleChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                data: [120, 200, 150, 80, 70, 110, 130],
                type: 'line',
                symbol: 'triangle',
                symbolSize: 20,
                lineStyle: {
                    color: '--bs-primary',
                    width: 2,
                    type: 'dashed'
                },
                itemStyle: {
                    borderWidth: 1,
                    borderColor: '--bs-border-color',
                    color: '--bs-primary'
                }
            }
        ],
    };
    allCharts.push([{ 'id': 'LineAndItemStyleChart', 'data': lineAndItemStyleChartOption }]);

    // Step Line Chart
    var stepLineChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['Step Start', 'Step Middle', 'Step End']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name: 'Step Start',
                type: 'line',
                step: 'start',
                data: [120, 132, 101, 134, 90, 230, 210]
            },
            {
                name: 'Step Middle',
                type: 'line',
                step: 'middle',
                data: [220, 282, 201, 234, 290, 430, 410]
            },
            {
                name: 'Step End',
                type: 'line',
                step: 'end',
                data: [450, 432, 401, 454, 590, 530, 510]
            }
        ],
        color: ['--bs-success', '--bs-danger', '--bs-primary']
    };
    allCharts.push([{ 'id': 'stepLineChart', 'data': stepLineChartOption }]);

    // Basic Bar Chart
    var basicBarChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                data: [120, 200, 150, 80, 70, 110, 130],
                type: 'bar'
            }
        ],
        color: ['--bs-primary']
    };
    allCharts.push([{ 'id': 'basicBarChart', 'data': basicBarChartOption }]);

    // Bar Chart with Negative Value
    const labelRight = {
        position: 'right'
    };
    var barChartNegativeValueOption = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        grid: {
            top: 80,
            bottom: 30
        },
        grid: {
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            position: 'top',
            splitLine: {
                lineStyle: {
                    type: 'dashed'
                }
            }
        },
        yAxis: {
            type: 'category',
            axisLine: { show: false },
            axisLabel: { show: false },
            axisTick: { show: false },
            splitLine: { show: false },
            data: [
                'ten',
                'nine',
                'eight',
                'seven',
                'six',
                'five',
                'four',
                'three',
                'two',
                'one'
            ]
        },
        series: [
            {
                name: 'Cost',
                type: 'bar',
                stack: 'Total',
                label: {
                    show: true,
                    formatter: '{b}'
                },
                data: [
                    { value: -0.07, label: labelRight },
                    { value: -0.09, label: labelRight },
                    0.2,
                    0.44,
                    { value: -0.23, label: labelRight },
                    0.08,
                    { value: -0.17, label: labelRight },
                    0.47,
                    { value: -0.36, label: labelRight },
                    0.18
                ]
            }
        ],
        color: ['--bs-primary']
    };
    allCharts.push([{ 'id': 'barChartNegativeValue', 'data': barChartNegativeValueOption }]);

    // Horizontal Bar
    var horizontalBarChartOption = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {},
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '10%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        yAxis: {
            type: 'category',
            data: ['Brazil', 'Indonesia', 'USA', 'India', 'China', 'World']
        },
        series: [
            {
                name: '2011',
                type: 'bar',
                data: [18203, 23489, 29034, 104970, 131744, 630230]
            },
            {
                name: '2012',
                type: 'bar',
                data: [19325, 23438, 31000, 121594, 134141, 681807]
            }
        ],
        color: ['--bs-primary', '--bs-success']
    };
    allCharts.push([{ 'id': 'horizontalBarChart', 'data': horizontalBarChartOption }]);

    // Pie Charts
    var pieChartsOption = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            left: 'left'
        },
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        series: [
            {
                name: 'Access From',
                type: 'pie',
                radius: '50%',
                data: [
                    { value: 1048, name: 'Search Engine' },
                    { value: 735, name: 'Direct' },
                    { value: 580, name: 'Email' },
                    { value: 484, name: 'Union Ads' },
                    { value: 300, name: 'Video Ads' }
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ],
        color: ['--bs-primary', '--bs-success', '--bs-info', '--bs-warning', '--bs-danger']
    };
    allCharts.push([{ 'id': 'pieCharts', 'data': pieChartsOption }]);

    // Half Doughnut Chart
    var halfDoughnutChartOption = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [
            {
                name: 'Access From',
                type: 'pie',
                radius: ['40%', '70%'],
                center: ['50%', '70%'],
                // adjust the start and end angle
                startAngle: 180,
                endAngle: 360,
                data: [
                    { value: 1048, name: 'Search Engine' },
                    { value: 735, name: 'Direct' },
                    { value: 580, name: 'Email' },
                    { value: 484, name: 'Union Ads' },
                    { value: 300, name: 'Video Ads' }
                ]
            }
        ],
        color: ['--bs-primary', '--bs-success', '--bs-info', '--bs-warning', '--bs-danger']
    };
    allCharts.push([{ 'id': 'halfDoughnutChart', 'data': halfDoughnutChartOption }]);

    // Basic Scatter Chart
    var basicScatterChartOption = {
        xAxis: {},
        yAxis: {},
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        series: [
            {
                symbolSize: 20,
                data: [
                    [10.0, 8.04],
                    [8.07, 6.95],
                    [13.0, 7.58],
                    [9.05, 8.81],
                    [11.0, 8.33],
                    [14.0, 7.66],
                    [13.4, 6.81],
                    [10.0, 6.33],
                    [14.0, 8.96],
                    [12.5, 6.82],
                    [9.15, 7.2],
                    [11.5, 7.2],
                    [3.03, 4.23],
                    [12.2, 7.83],
                    [2.02, 4.47],
                    [1.05, 3.33],
                    [4.05, 4.96],
                    [6.03, 7.24],
                    [12.0, 6.26],
                    [12.0, 8.84],
                    [7.08, 5.82],
                    [5.02, 5.68]
                ],
                type: 'scatter'
            }
        ],
        color: ['--bs-primary']
    };
    allCharts.push([{ 'id': 'basicScatterChart', 'data': basicScatterChartOption }]);

    // Candlestick Chart
    var candlestickChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        xAxis: {
            data: ['2017-10-24', '2017-10-25', '2017-10-26', '2017-10-27']
        },
        yAxis: {},
        series: [
            {
                type: 'candlestick',
                data: [
                    [20, 34, 10, 38],
                    [40, 35, 30, 50],
                    [31, 38, 33, 44],
                    [38, 15, 5, 42]
                ]
            }
        ],
        color: ['--bs-danger', '--bs-success']
    };
    allCharts.push([{ 'id': 'candlestickChart', 'data': candlestickChartOption }]);

    // Radar Chart
    var radarChartOption = {
        legend: {
            bottom: '-2%',
            data: ['Allocated Budget', 'Actual Spending']
        },
        radar: {
            // shape: 'circle',
            indicator: [
                { name: 'Sales', max: 6500 },
                { name: 'Administration', max: 16000 },
                { name: 'Information Technology', max: 30000 },
                { name: 'Customer Support', max: 38000 },
                { name: 'Development', max: 52000 },
                { name: 'Marketing', max: 25000 }
            ]
        },
        series: [
            {
                name: 'Budget vs spending',
                type: 'radar',
                data: [
                    {
                        value: [4200, 3000, 20000, 35000, 50000, 18000],
                        name: 'Allocated Budget'
                    },
                    {
                        value: [5000, 14000, 28000, 26000, 42000, 21000],
                        name: 'Actual Spending'
                    }
                ]
            }
        ],
        color: ['--bs-primary', '--bs-success']
    };
    allCharts.push([{ 'id': 'radarChart', 'data': radarChartOption }]);

    // Basic Treemap
    var basicTreemapChartOption = {
        series: [
            {
                type: 'treemap',
                data: [
                    {
                        name: 'nodeA',
                        value: 10,
                        children: [
                            {
                                name: 'nodeAa',
                                value: 4
                            },
                            {
                                name: 'nodeAb',
                                value: 6
                            }
                        ]
                    },
                    {
                        name: 'nodeB',
                        value: 20,
                        children: [
                            {
                                name: 'nodeBa',
                                value: 20,
                                children: [
                                    {
                                        name: 'nodeBa1',
                                        value: 20
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ],
        color: ['--bs-primary', '--bs-success']
    };
    allCharts.push([{ 'id': 'basicTreemapChart', 'data': basicTreemapChartOption }]);

    // Basic Parallel
    var basicParallelChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        parallelAxis: [
            { dim: 0, name: 'Price' },
            { dim: 1, name: 'Net Weight' },
            { dim: 2, name: 'Amount' },
            {
                dim: 3,
                name: 'Score',
                type: 'category',
                data: ['Excellent', 'Good', 'OK', 'Bad']
            }
        ],
        series: {
            type: 'parallel',
            lineStyle: {
                width: 4
            },
            data: [
                [12.99, 100, 82, 'Good'],
                [9.99, 80, 77, 'OK'],
                [20, 120, 60, 'Excellent']
            ]
        },
        color: ['--bs-primary']
    };
    allCharts.push([{ 'id': 'basicParallelChart', 'data': basicParallelChartOption }]);

    // Basic Sankey
    var basicSankeyChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        series: {
            type: 'sankey',
            layout: 'none',
            emphasis: {
                focus: 'adjacency'
            },
            data: [
                {
                    name: 'a'
                },
                {
                    name: 'b'
                },
                {
                    name: 'a1'
                },
                {
                    name: 'a2'
                },
                {
                    name: 'b1'
                },
                {
                    name: 'c'
                }
            ],
            links: [
                {
                    source: 'a',
                    target: 'a1',
                    value: 5
                },
                {
                    source: 'a',
                    target: 'a2',
                    value: 3
                },
                {
                    source: 'b',
                    target: 'b1',
                    value: 8
                },
                {
                    source: 'a',
                    target: 'b1',
                    value: 3
                },
                {
                    source: 'b1',
                    target: 'a1',
                    value: 1
                },
                {
                    source: 'b1',
                    target: 'c',
                    value: 2
                }
            ]
        },
        color: ['--bs-primary', '--bs-success', '--bs-info', '--bs-warning', '--bs-danger']
    };
    allCharts.push([{ 'id': 'basicSankeyChart', 'data': basicSankeyChartOption }]);

    // Funnel Chart
    var funnelChartOption = {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c}%'
        },
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        toolbox: {
            feature: {
                dataView: { readOnly: false },
                restore: {},
                saveAsImage: {}
            }
        },
        legend: {
            data: ['Show', 'Click', 'Visit', 'Inquiry', 'Order']
        },
        series: [
            {
                name: 'Funnel',
                type: 'funnel',
                left: '10%',
                top: 60,
                bottom: 60,
                width: '80%',
                min: 0,
                max: 100,
                minSize: '0%',
                maxSize: '100%',
                sort: 'descending',
                gap: 2,
                label: {
                    show: true,
                    position: 'inside'
                },
                labelLine: {
                    length: 10,
                    lineStyle: {
                        width: 1,
                        type: 'solid'
                    }
                },
                itemStyle: {
                    borderColor: '#fff',
                    borderWidth: 1
                },
                emphasis: {
                    label: {
                        fontSize: 20
                    }
                },
                data: [
                    { value: 60, name: 'Visit' },
                    { value: 40, name: 'Inquiry' },
                    { value: 20, name: 'Order' },
                    { value: 80, name: 'Click' },
                    { value: 100, name: 'Show' }
                ]
            }
        ],
        color: ['--bs-primary', '--bs-success', '--bs-info', '--bs-warning', '--bs-danger']
    };
    allCharts.push([{ 'id': 'funnelChart', 'data': funnelChartOption }]);

    // Simple Gauge
    var simpleGaugeChartOption = {
        grid: {
            left: '0%',
            right: '0%',
            bottom: '0%',
            top: '4%',
            containLabel: true
        },
        tooltip: {
            formatter: '{a} <br/>{b} : {c}%'
        },
        series: [
            {
                name: 'Pressure',
                type: 'gauge',
                progress: {
                    show: true
                },
                detail: {
                    valueAnimation: true,
                    formatter: '{value}'
                },
                data: [
                    {
                        value: 50,
                        name: 'SCORE'
                    }
                ]
            }
        ],
        color: ['--bs-primary']
    };
    allCharts.push([{ 'id': 'simpleGaugeChart', 'data': simpleGaugeChartOption }]);

})();
