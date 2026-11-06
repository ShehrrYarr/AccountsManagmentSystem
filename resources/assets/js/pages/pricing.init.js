/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Pricing init js
*/

// Toggle functionality for monthly/yearly prices
document.getElementById('toggleSwitch').addEventListener('change', function () {
    const monthlyPrices = document.querySelectorAll('.monthly-price');
    const yearlyPrices = document.querySelectorAll('.yearly-price');

    monthlyPrices.forEach(price => price.classList.toggle('d-none'));
    yearlyPrices.forEach(price => price.classList.toggle('d-none'));
});
