/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Tour init js
*/

import Shepherd from '../../libs/shepherd.js/esm/shepherd.mjs';

document.addEventListener('DOMContentLoaded', function () {
    const tour = new Shepherd.Tour({
        useModalOverlay: true,
        defaultStepOptions: {
            cancelIcon: { enabled: true },
            classes: 'shepherd-theme-arrows',
            scrollTo: true,
            classPrefix: 'my-tour-'
        }
    });

    // Step 1 - Welcome
    tour.addStep({
        id: 'welcome',
        text: 'Welcome to Herozi! This template offers advanced features for your admin dashboard.',
        attachTo: { element: 'h4.card-title', on: 'bottom' },
        buttons: [{ text: 'Next', action: tour.next }]
    });

    // Step 2 - Register Section
    tour.addStep({
        id: 'register-tour',
        text: 'Get your Free Herozi account now.',
        attachTo: { element: '#register-tour', on: 'top' },
        buttons: [
            { text: 'Back', action: tour.back },
            { text: 'Next', action: tour.next }
        ]
    });

    // Step 3 - Login Section
    tour.addStep({
        id: 'login-tour',
        text: 'Sign in to continue to Herozi.',
        attachTo: { element: '#login-tour', on: 'top' },
        buttons: [
            { text: 'Back', action: tour.back },
            { text: 'Next', action: tour.next }
        ]
    });

    // Step 4 - Get Product Section
    tour.addStep({
        id: 'getproduct-tour',
        text: 'Get the product after signing in.',
        attachTo: { element: '#getproduct-tour', on: 'top' },
        buttons: [
            { text: 'Back', action: tour.back },
            { text: 'Next', action: tour.next }
        ]
    });

    // Step 5 - Thank you message
    tour.addStep({
        id: 'thankyou-tour',
        text: 'Thank you for checking out Herozi! You are ready to explore the features.',
        attachTo: { element: '#thankyou-tour', on: 'top' },
        buttons: [{ text: 'Finish', action: tour.complete }]
    });

    // Start the tour
    tour.start();
});
