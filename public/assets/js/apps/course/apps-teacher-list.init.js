// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: teacher list init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const dtTeacherList = document.querySelector('.dt-teacher-list');

    // Invoice datatable initialization
    if (dtTeacherList) {
        const dtInvoice = new DataTable(dtTeacherList, {
            select: {
                style: 'multi',  // Ensure multi-select is enabled, this is crucial for checkbox selection
                selector: 'tr'  // Ensures the checkbox is selectable
            },
            ajax: 'assets/json/teacher-list.json', // JSON source for data
            columns: [
                { data: 'id' },               // #ID Column
                { data: 'fullName' },         // Client Name
                { data: 'dateOfJoin' },       // Issued Date
                { data: 'contactEmail' },     // email
                { data: 'status' },           // Invoice Status
                { data: 'action' }            // Actions Column
            ],
            columnDefs: [
                {
                    // For Checkboxes
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
                    render: function (data, type, full) {
                        return `
                        <div class="d-flex gap-3 justify-content-start align-items-center">
                            <div class="avatar avatar-sm">
                                <img src="${full.avatarImage}" alt="Avatar" class="avatar-item avatar rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="apps-course-teacher-details" class="text-truncate text-heading">
                                    <p class="mb-0 fw-medium">${full.fullName}</p>
                                </a>
                                <small class="text-truncate">${full.serviceType}</small>
                            </div>
                        </div>
                    `;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full) {
                        return `<span>${full.subject}</span>`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full) {
                        return `<span>${full.dateOfJoin}</span>`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full) {
                        return `<span>${full.contactEmail}</span>`;
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, full) {
                        return `<span>${full.phoneNumber}</span>`;
                    }
                },
                {
                    targets: 6,
                    render: function (data, type, full) {
                        const statusBadges = {
                            'Active': `<span class="badge bg-success-subtle text-success">${full.status}</span>`,
                            'In Active': `<span class="badge bg-danger-subtle text-danger">${full.status}</span>`
                        };
                        return statusBadges[full.status] || `<span class="badge bg-secondary">${full.status}</span>`;
                    }
                },
                {
                    targets: 7,
                    searchable: false,
                    orderable: false,
                    render: function () {
                        return `
                        <div class="dropdown">
                            <a href="#!" class="btn btn-text-primary rounded-pill icon-btn-sm" data-bs-toggle="dropdown">
                                <i class="ri-more-2-line fs-16"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#!" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-teacher-profile">Edit</a>
                                <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                <div class="dropdown-divider"></div>
                                <a href="#!" class="dropdown-item delete-item">Delete</a>
                            </div>
                        </div>
                    `;
                    }
                }
            ],
            order: [[1, 'desc']],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"dataTables_length"l>' +
                '<"d-flex flex-column flex-sm-row align-items-sm-center justify-content-end gap-3 w-100"f<"invoice_status">>' +
                '>' +
                '<"table-responsive"t>' +
                '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                '>',
            language: {
                sLengthMenu: "Row Per Page _MENU_ Entries",
                search: '',
                searchPlaceholder: 'Search Teacher',
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            lengthMenu: [10, 20, 50],
            pageLength: 10,
            initComplete: function () {
                // Update Invoice status
                const invoiceStatus = document.querySelector('.invoice_status');
                invoiceStatus.innerHTML = `
                 <select id="invoice-status-select" class="form-select">
                    <option value="all">All</option>
                    <option value="Active">Active</option>
                    <option value="In Active">In Active</option>
                </select>
            `;

                // Filter Invoice Status
                const select = document.querySelector('#invoice-status-select');

                new Choices('#invoice-status-select', {
                    searchEnabled: false,
                    placeholder: false, // Ensure no placeholder is shown
                    itemSelectText: false,
                });

                select.addEventListener('change', function () {
                    const value = this.value;
                    dtInvoice.column(6).search(value === 'all' ? '' : value).draw();
                });

            }
        });

        // Delete Record
        dtTeacherList.querySelector('tbody').addEventListener('click', function (event) {
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
                        dtInvoice.row(row).remove().draw();
                    }
                });
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

});
