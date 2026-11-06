/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Email List init js
*/

document.addEventListener("DOMContentLoaded", function () {

    const dtEmailList = document.querySelector('#myTabContent');

    // Invoice datatable initialization
    if (dtEmailList) {

        let primaryData = [];
        let promotionsData = [];

        // Fetch the data from the JSON file
        fetch('assets/json/email-list.json')
            .then(response => response.json())
            .then(data => {
                // Separate primary and promotions data
                primaryData = data.primary || [];
                promotionsData = data.promotions || [];

                // Initialize DataTable for Primary and Promotions with passed data
                const primaryDataTable = initDataTable("primaryTable", primaryData);
                const promotionsDataTable = initDataTable("promotionsTable", promotionsData);

                // Listen for tab switching to show appropriate tables
                const tabs = document.querySelectorAll('.nav-link');
                tabs.forEach(tab => {
                    tab.addEventListener('click', function () {
                        const targetId = tab.getAttribute('aria-controls');
                        if (targetId === 'pills-primary') {
                            // Show Primary DataTable when Primary tab is active
                            primaryDataTable.clear().rows.add(primaryData).draw(); // Refresh Primary DataTable data
                        } else if (targetId === 'pills-promotions') {
                            // Show Promotions DataTable when Promotions tab is active
                            promotionsDataTable.clear().rows.add(promotionsData).draw(); // Refresh Promotions DataTable data
                        }
                    });
                });

                // Handle delete item click event for both DataTables
                handleDeleteRecord(primaryDataTable);
                handleDeleteRecord(promotionsDataTable);
            })
            .catch(error => {
                console.error("Error loading JSON data:", error);
            });

        // Function to initialize DataTable with provided data
        const initDataTable = (tableId, data) => {
            return new DataTable(`#${tableId}`, {
                data: data, // Directly pass the data here
                columns: [
                    { data: 'id' },
                    { data: 'id' },
                    { data: 'fullName' },
                    { data: 'serviceType' },
                    { data: 'mailTime' },
                    { data: 'Actions' },
                ],
                columnDefs: [
                    {
                        // For Checkboxes
                        targets: 0,
                        orderable: false,
                        searchable: false,
                        checkboxes: {
                            selectAllRender: '<input type="checkbox" class="form-check-input">'
                        },
                        render: function () {
                            return `<input type="checkbox" class="dt-checkboxes form-check-input">`;
                        },
                    },
                    {
                        // For Checkboxes
                        targets: 1,
                        orderable: false,
                        searchable: false,
                        render: function () {
                            return `<button type="button" class="btn btn-light icon-btn-sm p-1 fs-13 rounded-pill custom-toggle">
                                    <span class="icon-on">
                                        <i class="ri-star-fill text-muted"></i>
                                    </span>
                                    <span class="icon-off">
                                        <i class="ri-star-line text-muted"></i>
                                    </span>
                                </button>`;
                        },
                    },
                    {
                        targets: 2,
                        render: function (data, type, full) {
                            return `<a href="apps-email-view" class="text-truncate">
                                    <p class="mb-0 fw-medium">${full.fullName}</p>
                                </a>`;
                        }
                    },
                    {
                        targets: 3,
                        render: function (data, type, full) {
                            return `<div class="d-flex align-items-center gap-2 max-w-620px">
                                    <p class="mb-0 fw-medium flex-shrink-0">${full.mailTitle}</p>
                                    <span class="flex-shrink-0">-</span>
                                    <p class="mb-0 fw-normal text-muted text-truncate flex-grow-1">${full.mailDescription}</p>
                                </div>
                            `;
                        }
                    },
                    {
                        targets: 5,
                        searchable: false,
                        orderable: false,
                        render: function () {
                            return `
                            <div class="hstack gap-2 fs-15">
                                <a href="apps-email-view" class="btn icon-btn-sm btn-light-primary">
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
                order: [[4, 'asc']],
                paging: true,
                language: {
                    sLengthMenu: 'Show _MENU_',
                    search: '',
                    searchPlaceholder: 'Search Files',
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

    }

    const lightboxEl = document.querySelector('.lightbox');
    if(lightboxEl) {
        GLightbox({
            selector: '.lightbox',
            title: false,
        });
    }

});

const editors = document.querySelectorAll('[data-editor="replay-email"]');
editors.forEach((editor) => {
    new Quill(editor, {
        theme: 'snow', // Using snow theme
        modules: {
            toolbar: true,
        },
        placeholder: 'Compose your content here...',
    });
});
