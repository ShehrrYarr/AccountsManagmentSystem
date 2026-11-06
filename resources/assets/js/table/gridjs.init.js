/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Gridjs init js
*/

const basicTable = document.getElementById("gridjs_basic-table");
if (basicTable) {
    fetch('assets/json/table/gridjs-basic-table.json')
        .then(response => response.json())
        .then(jsonData => {
            // Create the table with fetched data
            new gridjs.Grid({
                columns: ['Product Name', 'Category', 'Price', 'In Stock', 'Supplier'],
                data: jsonData.map(item => [
                    item['Product Name'],
                    item['Category'],
                    item['Price'],
                    item['In Stock'],
                    item['Supplier']
                ])
            }).render(basicTable);
        })
        .catch(error => console.error("Error loading JSON data: ", error));
}

const sortTable = document.getElementById("gridjs_sort-table");
if (sortTable) {
    fetch('assets/json/table/gridjs-sort-table.json')
        .then(response => response.json())
        .then(jsonData => {
            // Map the JSON data to an array of arrays that Grid.js expects
            const mappedData = jsonData.map(item => [
                item['Service Name'],
                item['Category'],
                item['Price'],
                item['Availability'],
                item['Provider']
            ]);

            // Create the table with fetched and mapped data
            new gridjs.Grid({
                columns: [
                    { name: 'Service Name', formatter: (cell) => gridjs.html(`<span class="fw-semibold">${cell}</span>`) },
                    { name: 'Category' },
                    { name: 'Price' },
                    { name: 'Availability' },
                    { name: 'Provider' }
                ],
                sort: true,
                data: mappedData // Pass the mapped data to Grid.js
            }).render(sortTable);
        })
        .catch(error => console.error("Error loading JSON data:", error));
}

const paginationTable = document.getElementById("gridjs_pagination-table");
if (paginationTable) {
    fetch('assets/json/table/gridjs-pagination-table.json')
        .then(response => response.json())
        .then(jsonData => {
            new gridjs.Grid({
                columns: [
                    {
                        name: 'Product Name',
                        formatter: (cell) => gridjs.html(`<a href="#!" class="link-primary">${cell}</a>`) // Wrap product name in a link
                    },
                    'Category',
                    'Price',
                    {
                        name: 'In Stock',
                        formatter: (cell) => {
                            // Apply badge based on stock status
                            const badgeClass = cell === 'Yes' ? 'badge text-success bg-success-subtle' : 'badge text-danger bg-danger-subtle';
                            return gridjs.html(`<div class="badge ${badgeClass}">${cell}</div>`);
                        }
                    },
                    'Supplier'
                ],
                sort: true, // Enable column sorting
                pagination: {
                    enabled: true,
                    limit: 5, // Set the number of rows per page
                },
                language: {
                    'search': {
                        'placeholder': 'Search for products...'
                    },
                    'pagination': {
                        'previous': () => gridjs.html('<i class="ri-arrow-left-line"></i>'),
                        'next': () => gridjs.html('<i class="ri-arrow-right-line"></i>'),
                        'showing': 'Showing',
                        'results': () => 'records'
                    }
                },
                data: jsonData.map(item => [
                    item['Product Name'],
                    item['Category'],
                    item['Price'],
                    item['In Stock'],
                    item['Supplier']
                ])
            }).render(paginationTable);
        })
        .catch(error => console.error("Error loading JSON data: ", error));
}

const searchTable = document.getElementById("gridjs_search-table");
if (searchTable) {
    fetch('assets/json/table/gridjs-search-table.json')
        .then(response => response.json())
        .then(jsonData => {
            new gridjs.Grid({
                columns: [
                    'User Name',
                    'Email',
                    'Phone',
                    {
                        name: 'Status',
                        formatter: (cell) => {
                            const badgeClass = cell === 'Active' ? 'badge text-success bg-success-subtle' : 'badge text-danger bg-danger-subtle';
                            return gridjs.html(`<div class="badge ${badgeClass}">${cell}</div>`);
                        },
                    },
                    'Role'
                ],
                search: true,
                sort: true, // Enable column sorting
                language: {
                    'search': {
                        'placeholder': 'Search users...'
                    },
                    'pagination': {
                        'previous': () => gridjs.html('<i class="ri-arrow-left-line"></i>'),
                        'next': () => gridjs.html('<i class="ri-arrow-right-line"></i>'),
                        'showing': 'Showing',
                        'results': () => 'records'
                    }
                },
                data: jsonData.map(item => [
                    item['User Name'],
                    item['Email'],
                    item['Phone'],
                    item['Status'],
                    item['Role']
                ])
            }).render(searchTable);
        })
        .catch(error => console.error("Error loading JSON data: ", error));
}

const loadingTable = document.getElementById("gridjs_loading-table");
if (loadingTable) {
    fetch('assets/json/table/gridjs-loading-table.json')
        .then(response => response.json())
        .then(jsonData => {
            new gridjs.Grid({
                columns: [
                    'Full Name',
                    'Contact Email',
                    'Phone Number',
                    {
                        name: 'Account Status',
                        formatter: (cell) => {
                            const badgeClass = cell === 'Active' ? 'badge text-success bg-success-subtle' : 'badge text-danger bg-danger-subtle';
                            return gridjs.html(`<div class="badge ${badgeClass}">${cell}</div>`);
                        },
                    },
                    'User Type'
                ],
                search: true,
                sort: true, // Enable column sorting
                language: {
                    'search': {
                        'placeholder': 'Search users...'
                    },
                    'pagination': {
                        'previous': () => gridjs.html('<i class="ri-arrow-left-line"></i>'),
                        'next': () => gridjs.html('<i class="ri-arrow-right-line"></i>'),
                        'showing': 'Showing',
                        'results': () => 'records'
                    }
                },
                data: jsonData.map(item => [
                    item['Full Name'],
                    item['Contact Email'],
                    item['Phone Number'],
                    item['Account Status'],
                    item['User Type']
                ])
            }).render(loadingTable);
        })
        .catch(error => console.error("Error loading JSON data: ", error));
}

const fixedHeaderTable = document.getElementById("gridjs_fixed-header-table");
if (fixedHeaderTable) {
    fetch('assets/json/table/gridjs-fix-header-table.json')
        .then(response => response.json())
        .then(jsonData => {
            new gridjs.Grid({
                columns: ['Item', 'Type', 'Cost', 'Available', 'Vendor'],
                search: true,
                sort: true, // Enable column sorting
                fixedHeader: true,
                height: '250px',
                language: {
                    'search': {
                        'placeholder': 'Search users...'
                    },
                    'pagination': {
                        'previous': () => gridjs.html('<i class="ri-arrow-left-line"></i>'),
                        'next': () => gridjs.html('<i class="ri-arrow-right-line"></i>'),
                        'showing': 'Showing',
                        'results': () => 'records'
                    }
                },
                data: jsonData.map(item => [
                    item['Item'],
                    item['Type'],
                    item['Cost'],
                    item['Available'],
                    item['Vendor']
                ])
            }).render(fixedHeaderTable);
        })
        .catch(error => console.error("Error loading JSON data: ", error));
}
