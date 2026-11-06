/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Modal init js
*/

document.addEventListener('DOMContentLoaded', () => {
    // Select all modals with the data-draggable attribute
    const modals = document.querySelectorAll('[data-draggable="true"]');

    modals.forEach(modalElement => {
        const modalContent = modalElement.querySelector('.modal-content');
        dragElement(modalContent);
    });

    function dragElement(el) {
        let pos = { top: 0, left: 0, x: 0, y: 0 };

        el.addEventListener('mousedown', (e) => {
            pos = {
                left: el.offsetLeft,
                top: el.offsetTop,
                x: e.clientX,
                y: e.clientY
            };
            document.addEventListener('mousemove', mouseMove);
            document.addEventListener('mouseup', mouseUp);
        });

        const mouseMove = (e) => {
            const dx = e.clientX - pos.x;
            const dy = e.clientY - pos.y;
            el.style.left = `${pos.left + dx}px`;
            el.style.top = `${pos.top + dy}px`;
        };

        const mouseUp = () => {
            document.removeEventListener('mousemove', mouseMove);
            document.removeEventListener('mouseup', mouseUp);
        };
    }

});

// Change modal show animation selecting the input values
const animationSelector = document.getElementById('animationSelector');
const modal = document.getElementById('anime1');

// Event listener for modal show event
modal.addEventListener('show.bs.modal', function () {
    // Remove existing animation classes dynamically
    const options = animationSelector.options;
    for (let i = 0; i < options.length; i++) {
        const className = options[i].value;
        modal.classList.remove(className);
    }

    // Add the selected animation class
    const selectedAnimation = animationSelector.value;
    modal.classList.add(selectedAnimation);
});
