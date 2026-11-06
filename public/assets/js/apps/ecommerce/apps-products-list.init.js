// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: product list init js
// */

'use strict';

document.addEventListener("DOMContentLoaded", function () {

    const dtEmailList = document.querySelector('#productListTabContent');

    // Invoice datatable initialization
    if (dtEmailList) {

        let allData = [];
        let publicData = [];
        let draftData = [];

        // Fetch the data from the JSON file
        fetch('assets/json/products-list.json')
            .then(response => response.json())
            .then(data => {
                // Separate the data for all, public, and draft products
                allData = data.all || [];

                // Filter out the products for public (published = true) and draft (published = false)
                publicData = allData.filter(product => product.published === true);
                draftData = allData.filter(product => product.published === false);

                // Initialize DataTable for All, Public, and Draft Products
                const allDataTable = initDataTable("allProductsTable", allData);
                const publicDataTable = initDataTable("publicProductsTable", publicData);
                const draftDataTable = initDataTable("draftProductsTable", draftData);

                // Listen for tab switching to show the appropriate tables
                const tabs = document.querySelectorAll('.nav-link');
                tabs.forEach(tab => {
                    tab.addEventListener('click', function () {
                        const targetId = tab.getAttribute('aria-controls');
                        if (targetId === 'pills-all-products') {
                            allDataTable.clear().rows.add(allData).draw();
                        } else if (targetId === 'pills-public-products') {
                            publicDataTable.clear().rows.add(publicData).draw();
                        } else if (targetId === 'pills-draft-products') {
                            draftDataTable.clear().rows.add(draftData).draw();
                        }
                    });
                });

                // Handle delete item click event for each DataTable
                handleDeleteRecord(allDataTable);
                handleDeleteRecord(publicDataTable);
                handleDeleteRecord(draftDataTable);
            })
            .catch(error => {
                console.error("Error loading JSON data:", error);
            });

        // Function to initialize DataTable with provided data
        const initDataTable = (tableId, data) => {
            return new DataTable(`#${tableId}`, {
                data: data,
                columns: [
                    { data: 'id' },
                    { data: 'image' },
                    { data: 'sku' },
                    { data: 'price' },
                    { data: 'category' },
                    { data: 'tags' },
                    { data: 'qty' },
                    { data: 'rating' },
                    { data: 'vendor' },
                    { data: 'published' },
                    { data: 'Actions' },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        searchable: false,
                        checkboxes: {
                            selectRow: true,
                            selectAllRender: '<input type="checkbox" class="form-check-input">'
                        },
                        render: function () {
                            return `<input type="checkbox" class="dt-checkboxes form-check-input">`;
                        },
                    },
                    {
                        targets: 1,
                        render: function (data, type, row) {
                            return `
                                <div class="d-flex align-items-center">
                                    <div class="avatar-item avatar overflow-hidden me-2">
                                        <img src="${data}" alt="Product Image" class="img-fluid">
                                    </div>
                                    <a href="apps-product-details" class="text-body fw-medium">${row.name}</a>
                                </div>`;
                        },
                    },
                    {
                        targets: 2,
                        render: function (data) {
                            return data;
                        },
                    },
                    {
                        targets: 3,
                        render: function (data) {
                            return `$${data.toFixed(2)}`;
                        },
                    },
                    {
                        targets: 4,
                        render: function (data) {
                            return data;
                        },
                    },
                    {
                        targets: 5,
                        render: function (data) {
                            return `<div class="d-flex gap-1 max-w-320px">${data.map(tag =>
                                `<span class="badge bg-light text-muted">${tag}</span>`
                            ).join(' ')}</div>`;
                        },
                    },
                    {
                        targets: 6,
                        render: function (data) {
                            return data;
                        },
                    },
                    {
                        targets: 7,
                        render: function (data) {
                            return `<span class="badge bg-warning-subtle text-warning fs-12 fw-medium hstack gap-1 w-max"><i class="ri-star-fill text-warning"></i>${data}</span>`;
                        },
                    },
                    {
                        targets: 8,
                        render: function (data) {
                            return data;
                        },
                    },
                    {
                        targets: 9,
                        render: function (data) {
                            return data ? '<span class="badge bg-success">Published</span>' : '<span class="badge bg-danger">Unpublished</span>';
                        },
                    },
                    {
                        targets: 10,
                        searchable: false,
                        orderable: false,
                        render: function () {
                            return `
                            <div class="hstack gap-2 fs-15">
                                <a href="apps-product-details" class="btn icon-btn-sm btn-light-primary">
                                    <i class="ri-eye-line"></i>
                                </a>
                                <a href="#!" class="btn icon-btn-sm btn-light-danger delete-item">
                                    <i class="ri-delete-bin-line"></i>
                                </a>
                            </div>
                        `;
                        }
                    }
                ],
                order: [[3, 'asc']], // Default order by Product Price
                paging: true,
                language: {
                    sLengthMenu: 'Show _MENU_',
                    search: '',
                    searchPlaceholder: 'Search Products',
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>',
                        previous: '<i class="ri-arrow-left-s-line"></i>'
                    }
                },
                tableLayout: 'fixed',
                lengthMenu: [10, 20, 50],
                dom: '<"table-responsive"t>' +
                    '<"p-4 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                    '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                    '>',
            });
        };

        // Function to handle delete action for each DataTable
        function handleDeleteRecord(dataTable) {
            // Delete Record
            dataTable.table().node().addEventListener('click', function (event) {
                if (event.target.classList.contains('delete-item')) {
                    const row = event.target.closest('tr');
                    // Show SweetAlert confirmation
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action will delete the record permanently.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Proceed with deletion if confirmed
                            dataTable.row(row).remove().draw();
                        }
                    });
                }
            });
        }

    }

});
