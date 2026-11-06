// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Project list init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const dtProjectList = document.querySelector('.dt-project-list');

    // Invoice datatable initialization
    if (dtProjectList) {
        const dtInvoice = new DataTable(dtProjectList, {
            ajax: 'assets/json/project-list.json', // JSON source for data
            columns: [
                { data: 'projectName' },         // Task Name
                { data: 'projectName' },         // Task Name
                { data: 'leader' },     // Avatar Images
                { data: 'team' },     // Avatar Images
                { data: 'dueDate' },          // Due Date
                { data: 'priority' },          // Due Date
                { data: 'updated' },         // updated
                { data: 'status' },           // Task Status
                { data: 'action' }            // Actions Column
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    checkboxes: {
                        selectAllRender: '<input type="checkbox" class="form-check-input">'
                    },
                    render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                    searchable: false
                },
                {
                    targets: 1,
                    render: function (data, type, full) {
                        return `
                            <div class="d-flex flex-column">
                                <a href="apps-projects-overview">
                                    <p class="mb-0 fw-medium text-truncate overflow-hidden max-w-384px">${full.projectName}</p>
                                </a>
                                <small class="text-truncate">${full.updated}</small>
                            </div>
                        `;
                    }
                },
                {
                    targets: 2,
                    orderable: false,
                    render: function (data, type, full) {
                        return `
                            <img src="${full.leader[0].image}" alt="Avatar" class="img-fuild avatar-sm">
                        `;
                    }
                },
                {
                    targets: 3,
                    orderable: false,
                    render: function (data, type, full) {
                        // Check if avatarImages is an array or a single string and render accordingly
                        const teamGroup = Array.isArray(full.team) ? full.team : [full.team];

                        return `
                            <div class="avatar-group">
                                ${teamGroup.map((team) => `
                                    <img src="${team.image}" alt="Avatar" class="img-fluid avatar-sm avatar-item cursor-pointer" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="${team.userName}">
                                `).join('')}
                            </div>
                        `;
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, full) {
                        const priorityBadges = {
                            High: `<span class="badge bg-danger text-uppercase">${full.priority}</span>`,
                            Medium: `<span class="badge bg-warning text-uppercase">${full.priority}</span>`,
                            Low: `<span class="badge bg-info text-uppercase">${full.priority}</span>`,
                        };

                        return priorityBadges[full.priority] || `<span class="badge bg-light">${full.priority}</span>`;
                    }
                },
                {
                    targets: 6,
                    render: function (data, type, full) {
                        const statusBadges = {
                            Todo: `<span class="badge bg-info-subtle text-info">${full.status}</span>`,
                            'In Progress': `<span class="badge bg-primary-subtle text-primary">${full.status}</span>`,
                            Completed: `<span class="badge bg-success-subtle text-success">${full.status}</span>`,
                        };

                        return statusBadges[full.status] || `<span class="badge bg-light">${full.status}</span>`;
                    }
                },
                {
                    targets: 7,
                    render: function (data, type, full) {
                        return `
                            <div class="hstack gap-2">
                                <span class="fs-12 ${full.completion === 100 ? 'text-success fw-medium' : ''}">${full.completion}%</span>
                                <div class="progress progress-xs min-w-100px">
                                    <div class="progress-bar ${full.completion === 100 ? 'bg-success' : 'bg-primary'}" role="progressbar" style="width: ${full.completion}%" aria-valuenow="${full.completion}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        `;
                    }
                },
                {
                    targets: 8,
                    searchable: false,
                    orderable: false,
                    render: function () {
                        return `
                        <div class="hstack gap-2 fs-15">
                            <a href="apps-projects-create" class="btn icon-btn-sm btn-light-primary">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <a href="#!" class="btn icon-btn-sm btn-light-danger delete-item">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </div>
                    `;
                    }
                }
            ],
            order: [[1, 'desc']],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"head-label">' +
                '<"d-flex flex-column flex-sm-row align-items-sm-center justify-content-end gap-3 w-100"f<"task_filter"><"export_button">>' +
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
                searchPlaceholder: 'Search Project',
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                },
                info: 'Showing _START_ - _END_ of _TOTAL_ Results', // Custom message format
                infoEmpty: 'No tasks available', // Message when no data is available
                infoFiltered: '(filtered from _MAX_ total tasks)' // Additional message for filtered results
            },
            lengthMenu: [10, 20, 50],
            pageLength: 10,
            initComplete: function () {
                // Dynamically create the dropdown and append it to the DOM
                const exportButtonContainer = document.querySelector('.export_button');
                exportButtonContainer.innerHTML = `
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle w-100 w-sm-max" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">Export</button>
                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                            <!-- Export buttons will be appended here -->
                        </ul>
                    </div>
                `;

                // Add the DataTables export buttons inside the dropdown menu
                const exportDropdown = exportButtonContainer.querySelector('.dropdown-menu');
                this.api().buttons().container().appendTo(exportDropdown);

                // Update Invoice status
                const invoiceStatus = document.querySelector('.task_filter');
                invoiceStatus.innerHTML = `
                    <div class="dropdown">
                        <button type="button" class="btn btn-light w-100 w-sm-max text-nowrap" id="usersFilterDropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <i class="bi-filter me-1"></i>Filter
                        </button>

                        <div class="dropdown-menu p-0 min-w-300px max-w-384px" aria-labelledby="usersFilterDropdown">
                            <div class="card border-0 mb-0">
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label" for="member-positions0">Role</label>
                                            <div class="d-flex">
                                                <div class="form-check w-50">
                                                    <input class="form-check-input" type="checkbox" id="usersFilterCheckAll" checked>
                                                    <label class="form-check-label" for="usersFilterCheckAll">All</label>
                                                </div>
                                                <div class="form-check w-50">
                                                    <input class="form-check-input" type="checkbox" id="usersFilterCheckEmployee">
                                                    <label class="form-check-label" for="usersFilterCheckEmployee">Employee</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="member-positions">Priority</label>
                                            <select class="form-select form-select-sm" id="member-positions">
                                                <option value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="form-label" for="project-status">Status</label>
                                            <select class="form-select form-select-sm" id="project-status">
                                                <option value="Any status">Any status</option>
                                                <option value="To do">To do</option>
                                                <option value="In progress">In progress</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-end d-flex align-items-center gap-3 flex-wrap">
                                    <button class="btn btn-primary">Apply</button>
                                    <button class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Project List</h5>';

                new Choices('#member-positions', {
                    searchEnabled: false,
                    placeholder: false, // Ensure no placeholder is shown
                    itemSelectText: false,
                });

                new Choices('#project-status', {
                    searchEnabled: false,
                    placeholder: false, // Ensure no placeholder is shown
                    itemSelectText: false,
                });

                // Initialize tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Reinitialize tooltips when the table is redrawn
                dtInvoice.on('draw', function () {
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                });
            }
        });

        // Delete Record
        dtProjectList.querySelector('tbody').addEventListener('click', function (event) {
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

            if (inputElement) {
                inputElement.classList.remove('form-control-sm');
            }
        }, 300);

    }
});
