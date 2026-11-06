// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Apps todo init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const dtTaskList = document.querySelector('.dt-task-list');

    // Invoice datatable initialization
    if (dtTaskList) {
        const dtInvoice = new DataTable(dtTaskList, {
            ajax: 'assets/json/task-list.json', // JSON source for data
            columns: [
                { data: 'taskName' },         // Task Name
                { data: 'taskName' },         // Task Name
                { data: 'avatarImages' },     // Avatar Images
                { data: 'dueDate' },          // Due Date
                { data: 'priority' },         // Priority
                { data: 'status' },           // Task Status
                { data: 'action' }            // Actions Column
            ],
            columnDefs: [
                {
                    targets: 0,
                    searchable: false,
                    orderable: false,
                    render: function (data) {
                        return `<div class="bg-light w-20px h-20px mx-auto d-flex align-items-center justify-content-center rounded cursor-move"><i class="bi bi-list"></i></div>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, full) {
                        const checkboxId = `todo${full.id}`;

                        return `<div class="form-check mb-0">
                                    <input class="form-check-input mb-0" type="checkbox" value="${full.id}" id="${checkboxId}">
                                    <label class="form-check-label mb-0" for="${checkboxId}">${full.taskName}</label>
                                </div>`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full) {
                        // Check if avatarImages is an array or a single string and render accordingly
                        const avatarImages = Array.isArray(full.avatarImages) ? full.avatarImages : [full.avatarImages];

                        return `
                        <div class="avatar-group">
                            ${avatarImages.map((image) => `
                                <div class="avatar-item">
                                    <img src="${image}" alt="Avatar" class="img-fluid avatar-sm rounded-circle">
                                </div>
                            `).join('')}
                        </div>
                    `;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full) {
                        return `<span>${full.dueDate}</span>`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full) {
                        const statusBadges = {
                            Todo: `<span class="badge bg-info-subtle text-info text-uppercase">${full.status}</span>`,
                            InProgress: `<span class="badge bg-primary-subtle text-primary text-uppercase">${full.status}</span>`,
                            OnHold: `<span class="badge bg-danger-subtle text-danger text-uppercase">${full.status}</span>`,
                            Done: `<span class="badge bg-success-subtle text-success text-uppercase">${full.status}</span>`,
                            Bug: `<span class="badge bg-secondary-subtle text-secondary text-uppercase">${full.status}</span>`,
                        };

                        return statusBadges[full.status] || `<span class="badge bg-secondary">${full.status}</span>`;
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

                        return priorityBadges[full.priority] || `<span class="badge bg-secondary">${full.priority}</span>`;
                    }
                },
                {
                    targets: 6,
                    searchable: false,
                    orderable: false,
                    render: function () {
                        return `
                        <div class="hstack gap-2 fs-15">
                            <a href="apps-tasks-kanban" class="btn icon-btn-sm btn-light-primary">
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
                '<"d-flex flex-column flex-sm-row align-items-sm-center justify-content-end gap-3 w-100"f<"task_status">>' +
                '>' +
                '<"table-responsive"t>' +
                '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: '',
                searchPlaceholder: 'Search Task',
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            lengthMenu: [10, 20, 50],
            pageLength: 10,
            initComplete: function () {
                // Update Invoice status
                const invoiceStatus = document.querySelector('.task_status');
                invoiceStatus.innerHTML = `
                <select id="task-status-select" class="form-select">
                    <option value="all">All</option>
                    <option value="Todo">Todo</option>
                    <option value="InProgress">In Progress</option>
                    <option value="Done">Done</option>
                    <option value="Bug">Bug</option>
                    <option value="OnHold">On Hold</option>
                </select>
            `;

                // Filter Invoice Status
                const select = document.querySelector('#task-status-select');

                new Choices('#task-status-select', {
                    searchEnabled: false,
                    placeholder: false, // Ensure no placeholder is shown
                    itemSelectText: false,
                });

                select.addEventListener('change', function () {
                    const value = this.value;
                    dtInvoice.column(4).search(value === 'all' ? '' : value).draw();
                });

                document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Task List</h5>';

                // Listen for checkbox changes and update label and task status
                const checkboxes = document.querySelectorAll('td .form-check-input');
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function () {
                        const label = this.nextElementSibling;
                        const row = this.closest('tr');
                        const taskStatusCell = row.querySelector('td:nth-child(5)'); // Status column
                        if (this.checked) {
                            label.style.textDecoration = 'line-through'; // Add line-through to label
                            taskStatusCell.innerHTML = '<span class="badge bg-success-subtle text-success text-uppercase">Completed</span>'; // Update status to completed
                        } else {
                            label.style.textDecoration = 'none'; // Remove line-through
                            taskStatusCell.innerHTML = `<span class="badge bg-info-subtle text-info text-uppercase">Todo</span>`; // Restore to Todo
                        }
                    });
                });
            }
        });

        // Delete Record
        dtTaskList.querySelector('tbody').addEventListener('click', function (event) {
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

    // invoice-list chart
    const taskOverviewOptions = {
        chart: {
            height: 220,
            parentHeightOffset: 0,
            type: 'donut'
        },
        labels: ['In Progress', 'Todo', 'On Hold', 'Bug', 'Done'],
        series: [13, 25, 22, 4, 40],
        colors: ['--bs-info', '--bs-primary', '--bs-danger', '--bs-secondary', '--bs-success'],
        stroke: {
            width: 0
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '75%',
                    labels: {
                        show: true,
                        value: {
                            offsetY: -20,
                        },
                        name: {
                            offsetY: 20,
                        },
                        total: {
                            show: true,
                            label: 'Total Tasks'
                        }
                    }
                }
            }
        },
        responsive: [
            {
                breakpoint: 550,
                options: {
                    chart: {
                        height: 180
                    }
                }
            }
        ]
    };
    allCharts.push([{ 'id': 'task-overview', 'data': taskOverviewOptions }]);

});
