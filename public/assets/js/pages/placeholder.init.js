/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Placeholder init js
*/

// Sample data array including image URLs
const cardData = [
    {
        title: "Card Title 1",
        text: "This is some example text for card 1.",
        imageUrl: "assets/images/small/img-4.jpg"
    },
    {
        title: "Card Title 2",
        text: "This is some example text for card 2.",
        imageUrl: "assets/images/small/img-5.jpg"
    },
    {
        title: "Card Title 3",
        text: "This is some example text for card 3.",
        imageUrl: "assets/images/small/img-6.jpg"
    }
];

function loadPlaceholders() {
    const cardRow = document.getElementById('cardRow');
    cardRow.innerHTML = ''; // Clear previous content

    for (let i = 0; i < 3; i++) {
        cardRow.innerHTML += `
            <div class="col-md-4 col-xl-3">
                <div class="card mb-0">
                    <img class="card-img-top h-200px" src="assets/images/placeholder-3.jpg" alt="Placeholder">
                    <div class="card-body">
                        <h6 class="card-title placeholder col-6"></h6>
                        <p class="card-text placeholder col-12"></p>
                        <a class="btn btn-primary disabled text-white">Go somewhere</a>
                    </div>
                </div>
            </div>
        `;
    }
}

function loadCards() {
    const cardRow = document.getElementById('cardRow');
    cardRow.innerHTML = ''; // Clear previous content

    cardData.forEach(data => {
        cardRow.innerHTML += `
            <div class="col-md-4 col-xl-3">
                <div class="card mb-0">
                    <img class="card-img-top h-200px" src="${data.imageUrl}" alt="${data.title}">
                    <div class="card-body">
                        <h6 class="card-title">${data.title}</h6>
                        <p class="card-text">${data.text}</p>
                        <a class="btn btn-primary" href="#!">Go somewhere</a>
                    </div>
                </div>
            </div>
        `;
    });

}

document.getElementById('reloadButton').addEventListener('click', () => {
    // Simulate loading new content after 500ms
    setTimeout(loadCards, 500);
});

// Load placeholders initially on window load and then load cards immediately
window.onload = () => {
    loadPlaceholders();
};
