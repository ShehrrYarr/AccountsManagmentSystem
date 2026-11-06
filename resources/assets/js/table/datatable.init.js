/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: DataTable init js
*/
"use strict";

document.addEventListener('DOMContentLoaded', function () {

    const dataTableBasic = document.querySelector('.data-table-basic');
    const dataTableSelect = document.querySelector('.data-table-select');
    const dataTableAdded = document.querySelector('.data-table-added');
    const dataTableResponsive = document.querySelector('.data-table-responsive');

    // dataTableBasic datatable initialization
    if (dataTableBasic) {
        const dataTableBasicType = new DataTable(dataTableBasic, {
            ajax: 'assets/json/table/ui-data-table-basic.json', // JSON source for data
            columns: [
                { data: 'full_name' },
                { data: 'email' },
                { data: 'start_date' },
                { data: 'salary' },
                { data: 'age' },
                { data: '' }
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full) {
                        return `
                        <div class="d-flex gap-3 justify-content-start align-items-center">
                            <div class="avatar avatar-sm">
                                <img src="${full.avatar_image}" alt="Avatar" class="avatar-item avatar rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#!" class="text-truncate text-heading">
                                    <p class="mb-0 fw-medium">${full.full_name}</p>
                                </a>
                                <small class="text-truncate">${full.designation}</small>
                            </div>
                        </div>
                    `
                    }
                },
                {
                    // Actions
                    targets: 5,
                    orderable: false,
                    searchable: false,
                    render: function () {
                        return `
                        <div class="hstack gap-2 fs-15">
                            <a href="#!" class="btn icon-btn-sm btn-light-primary">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <a href="#!" class="btn icon-btn-sm btn-light-danger delete-item">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </div>`;
                    }
                }
            ],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"head-label">' +
                '<"d-flex flex-column flex-sm-row align-items-center justify-content-sm-end gap-3 w-100"f>' +
                '>' +
                '<"table-responsive"t>' +
                '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: '',
                searchPlaceholder: 'Search Files',
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            lengthMenu: [10, 20, 50],
            pageLength: 10,
        });

        document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Basic Data-Table</h5>';

        // Delete Record
        dataTableBasic.querySelector('tbody').addEventListener('click', function (event) {
            if (event.target.classList.contains('delete-item')) {
                const row = event.target.closest('tr');
                dataTableBasicType.row(row).remove().draw();
            }
        });

        // Add selected class to row when checkbox is selected
        document.addEventListener('change', function (event) {
            if (event.target && event.target.classList.contains('dt-checkboxes')) {
                const row = event.target.closest('tr');
                if (event.target.checked) {
                    row.classList.add('selected'); // Add 'selected' class when checked
                } else {
                    row.classList.remove('selected'); // Remove 'selected' class when unchecked
                }
            }
        });

        // Set default size for form select
        setTimeout(function () {
            const inputElement = document.querySelector('.dataTables_filter .form-control');
            const selectElement = document.querySelector('.dataTables_length .form-select');

            if (inputElement) {
                inputElement.classList.remove('form-control-sm');
            }
            if (selectElement) {
                selectElement.classList.remove('form-select-sm');
            }
        }, 300);

    }

    // dataTableSelect datatable initialization
    if (dataTableAdded) {
        const dataTableAddedType = new DataTable(dataTableAdded, {
            ajax: 'assets/json/table/ui-data-table-basic.json', // JSON source for data
            columns: [
                { data: 'full_name' },
                { data: 'email' },
                { data: 'start_date' },
                { data: 'salary' },
                { data: 'age' },
                { data: '' }
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full) {
                        return `
                        <div class="d-flex gap-3 justify-content-start align-items-center">
                            <div class="avatar avatar-sm">
                                <img src="${full.avatar_image}" alt="Avatar" class="avatar-item avatar rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#!" class="text-truncate text-heading">
                                    <p class="mb-0 fw-medium">${full.full_name}</p>
                                </a>
                                <small class="text-truncate">${full.designation}</small>
                            </div>
                        </div>
                    `
                    }
                },
                {
                    // Actions
                    targets: 5,
                    orderable: false,
                    searchable: false,
                    render: function () {
                        return `
                        <div class="hstack gap-2 fs-15">
                            <a href="#!" class="btn icon-btn-sm btn-light-primary">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <a href="#!" class="btn icon-btn-sm btn-light-danger delete-item">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </div>`;
                    }
                }
            ],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"head-label">' +
                '<"d-flex flex-column flex-sm-row align-items-center justify-content-sm-end gap-3 w-100"f<"add_button">>' +
                '>' +
                '<"table-responsive"t>' +
                '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: '',
                searchPlaceholder: 'Search Files',
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            lengthMenu: [10, 20, 50],
            pageLength: 10,
            initComplete: function () {
                const add_button = document.querySelector('.add_button');
                add_button.innerHTML = `
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">Add Data</button>`;
            }
        });

        document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Select Option</h5>';

        // Delete Record
        dataTableAdded.querySelector('tbody').addEventListener('click', function (event) {
            if (event.target.classList.contains('delete-item')) {
                const row = event.target.closest('tr');
                dataTableAddedType.row(row).remove().draw();
            }
        });

        // Add selected class to row when checkbox is selected
        document.addEventListener('change', function (event) {
            if (event.target && event.target.classList.contains('dt-checkboxes')) {
                const row = event.target.closest('tr');
                if (event.target.checked) {
                    row.classList.add('selected'); // Add 'selected' class when checked
                } else {
                    row.classList.remove('selected'); // Remove 'selected' class when unchecked
                }
            }
        });

        // Set default size for form select
        setTimeout(function () {
            const inputElementTable2 = document.querySelector('.dataTables_filter .form-control');

            if (inputElementTable2) {
                inputElementTable2.classList.remove('form-control-sm');
            }
        }, 300);

        // Function to get a random avatar image from 1 to 10
        function getRandomAvatarImage() {
            const randomIndex = Math.floor(Math.random() * 10) + 1;  // Random number between 1 and 10
            return `assets/images/avatar/avatar-${randomIndex}.jpg`;  // Return corresponding avatar image path
        }

        // Handle form submission and validation
        document.getElementById('addDataForm').addEventListener('submit', function (event) {
            event.preventDefault();

            // Get form data
            const formData = new FormData(this);
            const newData = {
                full_name: formData.get('fullName'),
                email: formData.get('email'),
                start_date: formData.get('startDate'),
                salary: formData.get('salary'),
                age: formData.get('age'),
                avatar_image: getRandomAvatarImage(), // You can change this to dynamically handle avatar images
                designation: formData.get('designation') // You can dynamically set this too
            };

            // Validate fields before adding to the table
            if (this.checkValidity()) {
                // You can push data into the DataTable or make an Ajax call to save it.
                dataTableAddedType.row.add(newData).draw(); // Add new row to table
                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addDataModal'));
                modal.hide();
                // Reset the form
                this.reset();
            } else {
                // Trigger Bootstrap form validation
                this.classList.add('was-validated');
            }
        });

    }

    // dataTableAdded datatable initialization
    if (dataTableSelect) {
        const dataTableSelectType = new DataTable(dataTableSelect, {
            ajax: 'assets/json/table/ui-data-table-basic.json', // JSON source for data
            columns: [
                { data: 'id' },
                { data: 'full_name' },
                { data: 'email' },
                { data: 'start_date' },
                { data: 'salary' },
                { data: 'age' },
                { data: '' }
            ],
            columnDefs: [
                {
                    // For Checkboxes
                    targets: 0,
                    orderable: false,
                    checkboxes: true,
                    render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                    checkboxes: {
                        selectAllRender: '<input type="checkbox" class="form-check-input">'
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, full) {
                        return `
                        <div class="d-flex gap-3 justify-content-start align-items-center">
                            <div class="avatar avatar-sm">
                                <img src="${full.avatar_image}" alt="Avatar" class="avatar-item avatar rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#!" class="text-truncate text-heading">
                                    <p class="mb-0 fw-medium">${full.full_name}</p>
                                </a>
                                <small class="text-truncate">${full.designation}</small>
                            </div>
                        </div>
                    `
                    }
                },
                {
                    // Actions
                    targets: 6,
                    orderable: false,
                    searchable: false,
                    render: function () {
                        return `
                        <div class="hstack gap-2 fs-15">
                            <a href="#!" class="btn icon-btn-sm btn-light-primary">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <a href="#!" class="btn icon-btn-sm btn-light-danger delete-item">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </div>`;
                    }
                }
            ],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"head-label">' +
                '<"d-flex flex-column flex-sm-row align-items-center justify-content-sm-end gap-3 w-100"f<"add_button">>' +
                '>' +
                '<"table-responsive"t>' +
                '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: '',
                searchPlaceholder: 'Search Files',
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            lengthMenu: [10, 20, 50],
            pageLength: 10,
        });

        document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Select Option</h5>';

        // Delete Record
        dataTableSelect.querySelector('tbody').addEventListener('click', function (event) {
            if (event.target.classList.contains('delete-item')) {
                const row = event.target.closest('tr');
                dataTableSelectType.row(row).remove().draw();
            }
        });

        // Add selected class to row when checkbox is selected
        document.addEventListener('change', function (event) {
            if (event.target && event.target.classList.contains('dt-checkboxes')) {
                const row = event.target.closest('tr');
                if (event.target.checked) {
                    row.classList.add('selected'); // Add 'selected' class when checked
                } else {
                    row.classList.remove('selected'); // Remove 'selected' class when unchecked
                }
            }
        });

        // Set default size for form select
        setTimeout(function () {
            const inputElementTable2 = document.querySelector('.dataTables_filter .form-control');

            if (inputElementTable2) {
                inputElementTable2.classList.remove('form-control-sm');
            }
        }, 300);

    }

    // dataTableAdded datatable initialization
    if (dataTableResponsive) {
        const dataTableResponsiveType = new DataTable(dataTableResponsive, {
            ajax: 'assets/json/table/ui-data-table-basic.json', // JSON source for data
            columns: [
                { data: 'id' },
                { data: 'full_name' },
                { data: 'email' },
                { data: 'start_date' },
                { data: 'salary' },
                { data: 'age' },
                { data: '' }
            ],
            columnDefs: [
                {
                    // For Checkboxes
                    targets: 0,
                    orderable: false,
                    checkboxes: true,
                    render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                    checkboxes: {
                        selectAllRender: '<input type="checkbox" class="form-check-input">'
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, full) {
                        return `
                        <div class="d-flex gap-3 justify-content-start align-items-center">
                            <div class="avatar avatar-sm">
                                <img src="${full.avatar_image}" alt="Avatar" class="avatar-item avatar rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#!" class="text-truncate text-heading">
                                    <p class="mb-0 fw-medium">${full.full_name}</p>
                                </a>
                                <small class="text-truncate">${full.designation}</small>
                            </div>
                        </div>
                    `
                    }
                },
                {
                    // Actions
                    targets: 6,
                    orderable: false,
                    searchable: false,
                    render: function () {
                        return `
                        <div class="hstack gap-2 fs-15">
                            <a href="#!" class="btn icon-btn-sm btn-light-primary">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <a href="#!" class="btn icon-btn-sm btn-light-danger delete-item">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </div>`;
                    }
                }
            ],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
            '<"head-label">' +
            '<"d-flex flex-column flex-sm-row align-items-center justify-content-sm-end gap-3 w-100"f<"export_button">>' +
            '>' +
            '<"table-responsive"t>' +
            '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
            '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
            '>',
        buttons: [
            {
                extend: 'copy',
                text: 'Copy',
                className: 'dropdown-item'
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'dropdown-item'
            },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'dropdown-item'
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'dropdown-item'
            }
        ],
        language: {
            sLengthMenu: 'Show _MENU_',
            search: '',
            searchPlaceholder: 'Search Files',
            paginate: {
                next: '<i class="ri-arrow-right-s-line"></i>',
                previous: '<i class="ri-arrow-left-s-line"></i>'
            }
        },
        lengthMenu: [10, 20, 50],
        pageLength: 10,
        initComplete: function () {
            // Dynamically create the dropdown and append it to the DOM
            const exportButtonContainer = document.querySelector('.export_button');
            exportButtonContainer.innerHTML = `
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Export
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                        <!-- Export buttons will be appended here -->
                    </ul>
                </div>
            `;

            // Add the DataTables export buttons inside the dropdown menu
            const exportDropdown = exportButtonContainer.querySelector('.dropdown-menu');
            this.api().buttons().container().appendTo(exportDropdown);

            // Ensure the dropdown buttons work properly (sometimes due to DOM manipulation, the buttons may not be fully functional)
            const dropdownButtons = exportDropdown.querySelectorAll('button');
            dropdownButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Trigger the export action
                    const index = Array.from(dropdownButtons).indexOf(button);
                    this.DataTable().button(index).trigger();
                });
            });
        }
    });

        document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Select Option</h5>';

        // Delete Record
        dataTableResponsive.querySelector('tbody').addEventListener('click', function (event) {
            if (event.target.classList.contains('delete-item')) {
                const row = event.target.closest('tr');
                dataTableResponsiveType.row(row).remove().draw();
            }
        });

        // Add selected class to row when checkbox is selected
        document.addEventListener('change', function (event) {
            if (event.target && event.target.classList.contains('dt-checkboxes')) {
                const row = event.target.closest('tr');
                if (event.target.checked) {
                    row.classList.add('selected'); // Add 'selected' class when checked
                } else {
                    row.classList.remove('selected'); // Remove 'selected' class when unchecked
                }
            }
        });

        // Set default size for form select
        setTimeout(function () {
            const inputElementTable2 = document.querySelector('.dataTables_filter .form-control');

            if (inputElementTable2) {
                inputElementTable2.classList.remove('form-control-sm');
            }
        }, 300);

    }

});
