// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Course Overview init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const dtStudentList = document.querySelector('.dt-student-list');

    // Invoice datatable initialization
    if (dtStudentList) {
        const dtStudent = new DataTable(dtStudentList, {
            ajax: 'assets/json/student-list.json', // JSON source for data
            columns: [
                { data: 'id' },               // #ID Column
                { data: 'id' },               // Roll Number Column
                { data: 'avatarImage' },      // Client Name
                { data: 'courseName' },       // Course Name Column
                { data: 'phoneNumber' },      // Phone Number Column
                { data: 'gender' },           // Gender Column
                { data: 'dateOfJoin' },       // Issued Date Column
                { data: 'contactEmail' },     // email Column
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
                    targets: 2,
                    render: function (data, type, full) {
                        return `
                        <div class="d-flex gap-2 justify-content-start align-items-center">
                            <img src="${full.avatarImage}" alt="Avatar" class="img-fluid avatar border-0 overflow-hidden">
                            <a href="apps-course-student-details" class="text-truncate text-body fw-medium">${full.fullName}</a>
                        </div>
                    `;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full) {
                        return `
                        <a href="apps-course-details">
                            <p class="mb-0 fw-medium text-truncate overflow-hidden max-w-384px">${full.courseName}</p>
                        </a>
                    `;
                    }
                },
                {
                    targets: 8,
                    render: function (data, type, full) {
                        const statusBadges = {
                            'Active': `<span class="badge bg-success-subtle text-success text-uppercase">${full.status}</span>`,
                            'In Active': `<span class="badge bg-danger-subtle text-danger text-uppercase">${full.status}</span>`,
                        };

                        return statusBadges[full.status] || `<span class="badge bg-secondary">${full.status}</span>`;
                    }
                },
                {
                    targets: 9,
                    searchable: false,
                    orderable: false,
                    render: function () {
                        return `
                        <div class="dropdown">
                            <a href="#!" class="btn btn-text-primary rounded-pill icon-btn-sm" data-bs-toggle="dropdown">
                                <i class="ri-more-2-line fs-16"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#!" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-student-profile">Edit</a>
                                <a href="apps-course-student-details" class="dropdown-item">View</a>
                                <div class="dropdown-divider"></div>
                                <a href="#!" class="dropdown-item delete-item">Delete</a>
                            </div>
                        </div>
                    `;
                    }
                }
            ],
            dom: '<"card-header dt-head d-flex flex-column flex-md-row justify-content-between align-items-center gap-3"' +
                '<"dataTables_length"l>' +
                '<"d-flex flex-column flex-md-row align-items-md-center justify-content-end gap-3 w-100 max-w-384px"f<"invoice_status">>' +
                '>' +
                '<"table-responsive"t>' +
                '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                '>',
            language: {
                sLengthMenu: "Row Per Page _MENU_ Entries",
                search: '',
                searchPlaceholder: 'Search Student',
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
                    dtStudent.column(8).search(value === 'all' ? '' : value).draw();
                });

            }
        });

        // Delete Record
        dtStudentList.querySelector('tbody').addEventListener('click', function (event) {
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
                        dtStudent.row(row).remove().draw();
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

    const totalVisitedViewsChart = {
        series: [{
            name: 'Total Visits',
            data: [1200, 1350, 1400, 1550, 1600, 1700, 1800] // Example data for total visits
        }],
        chart: {
            height: 340,
            type: 'area',
            toolbar: {
                show: false  // Disable the toolbar (no export button)
            }
        },
        colors: ['--bs-primary'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            show: false  // Hide title
        },
        xaxis: {
            type: 'datetime',
            categories: [
                "2024-12-01T00:00:00.000Z", // Example dates (adjust to your data)
                "2024-12-02T00:00:00.000Z",
                "2024-12-03T00:00:00.000Z",
                "2024-12-04T00:00:00.000Z",
                "2024-12-05T00:00:00.000Z",
                "2024-12-06T00:00:00.000Z",
                "2024-12-07T00:00:00.000Z"
            ]
        },
    };
    allCharts.push([{ 'id': 'totalVisitedViewsChart', 'data': totalVisitedViewsChart }]);

});
