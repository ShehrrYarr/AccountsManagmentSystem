/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Product Details init js
*/

document.addEventListener('DOMContentLoaded', function () {
    var thumbsSwiper = new Swiper(".thumbs-swiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    var thumbViewSwiper = new Swiper(".thumb-view-swiper", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: thumbsSwiper,
        },
    });

    new StarRating('.star-rating-prebuilt', {
        classNames: {
            active: 'gl-active',
            base: 'gl-star-rating',
            selected: 'gl-selected',
        },
        clearable: true,
        prebuilt: false,
        tooltip: false,
        maxStars: 5,
    });

    // Product review management chart
    const chartOptions = {
        chart: {
            height: 85,
            width: 85,
            type: 'radialBar'
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '56%'
                },
                dataLabels: {
                    show: true,
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: 5,
                        formatter: function () {
                            return '4.8';
                        }
                    }
                },
                track: {
                    background: "#e0e0e0",
                }
            }
        },
        stroke: {
            lineCap: 'round'
        },
        grid: {
            padding: {
                top: -12,
                bottom: -17,
                left: -17,
                right: -15
            }
        },
        series: [92],
        colors: ['--bs-primary'],
    };
    allCharts.push([{ 'id': 'review-chart', 'data': chartOptions }]);

});
