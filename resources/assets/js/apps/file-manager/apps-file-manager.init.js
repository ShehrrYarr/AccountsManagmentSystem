/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: File Manager init js
*/

"use strict";

document.addEventListener('DOMContentLoaded', function () {

    const dtFileTypeList = document.querySelector('.dt-invoice-list');

    // Invoice datatable initialization
    if (dtFileTypeList) {
        const dtFileType = new DataTable(dtFileTypeList, {
            ajax: 'assets/json/file-manager.json', // JSON source for data
            columns: [
                { data: 'id' },
                { data: 'fullName' },
                { data: 'fileSize' },
                { data: 'fileType' },
                { data: 'lastModified' },
                { data: 'action' }
            ],
            columnDefs: [
                {
                    // For Checkboxes
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
                        const statusBadges = {
                            '.pdf': '<i class="ri-file-pdf-fill align-bottom text-danger fs-16"></i>',  // PDF icon (red for PDF)
                            '.zip': '<i class="ri-file-zip-fill align-bottom text-primary fs-16"></i>',  // ZIP icon (blue for ZIP)
                            '.jpg': '<i class="ri-image-fill align-bottom text-info fs-16"></i>',     // JPG icon (light blue for JPG)
                            '.png': '<i class="ri-image-line align-bottom text-success fs-16"></i>',     // PNG icon (green for PNG)
                        };

                        const iconHTML = statusBadges[full.fileType] || 'ri-file-line';

                        return `
                        <div class="d-flex gap-2 justify-content-start align-items-center">
                            <div class="avatar-sm avatar-item bg-transparent border-0">
                                ${iconHTML}
                            </div>
                            <a href="#!" class="text-truncate">
                                <p class="mb-0 fw-medium">${full.fullName}</p>
                            </a>
                        </div>
                    `;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full) {
                        const fileTypeBadges = {
                            '.pdf': `<span class="badge bg-success-subtle text-success text-uppercase">${full.fileType}</span>`,
                            '.zip': `<span class="badge bg-primary-subtle text-primary text-uppercase">${full.fileType}</span>`,
                            '.png': `<span class="badge bg-warning-subtle text-warning text-uppercase">${full.fileType}</span>`,
                            '.jpg': `<span class="badge bg-info-subtle text-info text-uppercase">${full.fileType}</span>`
                        };

                        return fileTypeBadges[full.fileType] || `<span class="badge bg-secondary">${full.fileType}</span>`;
                    }
                },
                {
                    targets: 3,
                    orderable: false,
                    render: function (data, type, full) {
                        return `<span>${full.fileSize}</span>`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full) {
                        return `<span>${full.lastModified}</span>`;
                    }
                },
                {
                    targets: 5,
                    searchable: false,
                    orderable: false,
                    render: function () {
                        return `
                        <div class="hstack gap-2 fs-15">
                            <a href="#!" class="btn icon-btn-sm btn-light-primary">
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
            order: [[1, 'desc']],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"head-label">' +
                '<"d-flex flex-column flex-sm-row align-items-sm-center justify-content-end gap-3 w-100"f<"invoice_status">>' +
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
                // Update Invoice status
                const invoiceStatus = document.querySelector('.invoice_status');
                invoiceStatus.innerHTML = `
                <select id="invoice-status-select" class="form-select">
                    <option value="all">All</option>
                    <option value="jpg">JPG</option>
                    <option value="png">PNG</option>
                    <option value="zip">ZIP</option>
                    <option value="pdf">PDF</option>
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
                    dtFileType.column(2).search(value === 'all' ? '' : value).draw();
                });
            }
        });

        document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Recent Added</h5>';

        // Delete Record
        dtFileTypeList.querySelector('tbody').addEventListener('click', function (event) {
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
                        dtFileType.row(row).remove().draw();
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

    // Initialize the email input with Choice.js for multi-select
    const emailInputEl = document.querySelector('#emailInput');
    if (emailInputEl) {
        new Choices(emailInputEl, {
            removeItemButton: true,
            placeholder: true,
            placeholderValue: 'Enter Your Email',
            maxItemCount: 5,
            searchResultLimit: 10,
            renderChoiceLimit: 10,
            addItems: true,
            delimiter: ', ',
            duplicateItems: false,
            itemSelectText: false
        });
    }

    const roleSelectEl = document.querySelector('#roleSelect');
    if (roleSelectEl) {
        new Choices(roleSelectEl, {
            searchEnabled: false,
            placeholder: false,
            itemSelectText: false
        });
    }

});
