/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: echart-config.init.js
*/

// Array to store all chart instances
var allCharts = [];

// get color code from the root variable
function getColor(color) {
    const value = getComputedStyle(document.documentElement).getPropertyValue(color).trim();
    // If the value is in RGB format (e.g., "23, 162, 184"), wrap it in `rgb()`
    if (/^\d{1,3},\s*\d{1,3},\s*\d{1,3}$/.test(value)) {
        return `rgb(${value})`;
    }
    return value;
}

// replace the CSS variables with their computed values and return the updated object
const replaceCSSVariables = (obj) => {
    const updatedObj = JSON.parse(JSON.stringify(obj)); // Deep clone the object

    const traverseAndReplace = (node) => {
        for (const key in node) {
            if (typeof node[key] === 'string' && node[key].startsWith('--bs-')) {
                // Replace the CSS variable with its computed value
                node[key] = getColor(node[key]);
            } else if (typeof node[key] === 'object' && node[key] !== null) {
                // Recursively traverse nested objects/arrays
                traverseAndReplace(node[key]);
            }
        }
    };

    traverseAndReplace(updatedObj);
    return updatedObj;
};

// render all charts with updated data
function updateAllCharts(theme = "") {
    theme ? document.documentElement.setAttribute('data-bs-theme', theme) : '';
    allCharts.forEach(chart => {
        const jsonData = JSON.parse(JSON.stringify(chart[0].data));
        const data = replaceCSSVariables(structuredClone(jsonData));
        if (chart[0].chart)
            chart[0].chart.dispose();

        var chartInstance = echarts.init(document.getElementById(chart[0].id));
        chartInstance.setOption(data);
        chart[0].chart = chartInstance;
    });
}

// recreate charts on theme color change
document.querySelectorAll('input[name="data-theme-color"]').forEach(radio => {
    radio.addEventListener('change', function () {
        setTimeout(() => {
            updateAllCharts(this.value);
        }, 0);
    });
});

// recreate charts on reset settings
document.getElementById('resetSettings')?.addEventListener('click', function () {
    setTimeout(() => {
        updateAllCharts(this.value);
    }, 0);
});

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        updateAllCharts();
    }, 0);
});

// Resize all charts on window resize
window.addEventListener('resize', function () {
    updateAllCharts();
});
