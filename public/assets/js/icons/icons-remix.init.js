/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Remix Icons init js
*/

const iconList = document.getElementById('iconList');
const searchInput = document.getElementById('iconSearch');
const copyAlert = document.getElementById('copyAlert');
const copiedText = document.getElementById('copiedText');

// Function to fetch icons from JSON file
async function fetchIcons() {
    try {
        const response = await fetch('assets/json/icons/remix-icons.json');
        const data = await response.json();
        return data.icons;
    } catch (error) {
        console.error('Error fetching icons:', error);
        return [];
    }
}

// Function to display icons
async function displayIcons(filter = '') {
    const icons = await fetchIcons();
    iconList.innerHTML = ''; // Clear existing icons
    const filteredIcons = icons.filter(icon => icon.toLowerCase().includes(filter.toLowerCase()));

    filteredIcons.forEach(icon => {
        const iconBox = document.createElement('div');
        iconBox.className = 'icon-box';
        iconBox.innerHTML = `<i class="${icon}"></i><strong>${icon}</strong>`;

        // Add click event to copy the icon format
        iconBox.addEventListener('click', () => {
            const iconFormat = `<i class="${icon}"></i>`;
            navigator.clipboard.writeText(iconFormat).then(() => {
                // Show simple text alert on successful copy
                copyAlert.textContent = "Copied!"; // Set simple text message
                copyAlert.style.display = 'block'; // Show the alert
                setTimeout(() => {
                    copyAlert.style.display = 'none'; // Hide after 3 seconds
                }, 500);
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        });

        iconList.appendChild(iconBox);
    });
}

// Initial display of icons
displayIcons();

// Event listener for search input
searchInput.addEventListener('input', (e) => {
    displayIcons(e.target.value);
});
