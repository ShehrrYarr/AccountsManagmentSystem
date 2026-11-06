/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Swiper init js
*/

var defaultSwiper = new Swiper(".default-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    slidesPerView: 1,
});

var navigationSwiper = new Swiper(".navigation-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    pagination: { clickable: true, el: ".swiper-pagination" },
});

var paginationDynamicSwiper = new Swiper(".pagination-dynamic-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    pagination: { clickable: true, el: ".swiper-pagination", dynamicBullets: true },
});

var paginationFractionSwiper = new Swiper(".pagination-fraction-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    pagination: { clickable: true, el: ".swiper-pagination", type: "fraction" },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
});

var paginationProgressSwiper = new Swiper(".pagination-progress-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    pagination: { el: ".swiper-pagination", type: "progressbar" },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
});

var paginationScrollbarSwiper = new Swiper(".pagination-scrollbar-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    scrollbar: { el: ".swiper-scrollbar", hide: true },
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
});

var verticalSwiper = new Swiper(".vertical-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    direction: "vertical",
    pagination: { el: ".swiper-pagination", clickable: true },
});

var mousewheelControlSwiper = new Swiper(".mousewheel-control-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    direction: "vertical",
    mousewheel: true,
    pagination: { el: ".swiper-pagination", clickable: true },
});

var effectFadeSwiper = new Swiper(".effect-fade-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    effect: "fade",
    pagination: { el: ".swiper-pagination", clickable: true },
});

var effectCreativeSwiper = new Swiper(".effect-creative-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    grabCursor: true,
    effect: "creative",
    creativeEffect: {
        prev: { shadow: true, translate: [0, 0, -400] },
        next: { translate: ["100%", 0, 0] },
    },
    pagination: { el: ".swiper-pagination", clickable: true },
});

var effectFlipSwiper = new Swiper(".effect-flip-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    effect: "flip",
    grabCursor: true,
    pagination: { el: ".swiper-pagination", clickable: true },
});

var zoomEffectSwiper = new Swiper(".zoom-effect-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    zoom: true,
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
    pagination: { el: ".swiper-pagination", clickable: true },
});

var parallaxSwiper = new Swiper(".parallax-swiper", {
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    parallax: true,
    effect: 'fade',
    navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
});

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
