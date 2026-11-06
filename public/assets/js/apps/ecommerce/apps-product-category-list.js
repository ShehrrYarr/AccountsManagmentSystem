/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Product category list init js
*/

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const dtCategoryList = document.querySelector('.dt-category-list');
    if (dtCategoryList) {
        const dtInvoice = new DataTable(dtCategoryList, {
            ajax: 'assets/json/category-list.json',
            columns: [
                { data: 'categoryName' },
                { data: 'categoryName' },
                { data: 'totalProduct' },
                { data: 'status' },
                { data: 'action' }
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    checkboxes: { selectAllRender: '<input type="checkbox" class="form-check-input">' },
                    render: () => '<input type="checkbox" class="dt-checkboxes form-check-input">',
                    searchable: false
                },
                {
                    targets: 1,
                    render: (data, type, full) => `
                        <div class="d-flex gap-2 align-items-center">
                            <img src="${full.categoryImage}" alt="Avatar" class="avatar rounded-2">
                            <div class="d-flex flex-column">
                                <a href="#!" class="text-body">
                                    <p class="mb-0 fw-medium text-truncate">${full.categoryName}</p>
                                </a>
                                <p class="text-muted fs-13 mb-0">${full.categoryDesc}</p>
                            </div>
                        </div>
                    `
                },
                {
                    targets: 3,
                    render: (data, type, full) => full.status
                        ? `<span class="badge text-success bg-success-subtle">Success</span>`
                        : `<span class="badge text-danger bg-danger-subtle">Deactive</span>`
                },
                {
                    targets: 4,
                    orderable: false,
                    render: () => `
                        <div class="hstack gap-2">
                            <a href="#!" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <a href="#!" class="btn btn-sm btn-light-danger delete-item">
                                <i class="ri-delete-bin-line"></i>
                            </a>
                        </div>
                    `
                }
            ],
            order: [[1, 'desc']],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"head-label">' +
                '<"d-flex flex-column flex-sm-row align-items-sm-center justify-content-end gap-3 w-100"f<"export_button">>' +
                '>' +
                '<"table-responsive"t>' +
                '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                '>',
            buttons: [
                { extend: 'copy', text: 'Copy', className: 'dropdown-item' },
                { extend: 'csv', text: 'CSV', className: 'dropdown-item' },
                { extend: 'excel', text: 'Excel', className: 'dropdown-item' },
                { extend: 'print', text: 'Print', className: 'dropdown-item' }
            ],
            language: {
                sLengthMenu: 'Show _MENU_',
                search: '',
                searchPlaceholder: 'Search Category',
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
                const headLabel = document.querySelector('.head-label');
                if (headLabel) {
                    headLabel.innerHTML = '<h5 class="card-title text-nowrap mb-0">Category List</h5>';
                }

                const inputElement = document.querySelector('.dataTables_filter .form-control');
                if (inputElement) {
                    inputElement.classList.remove('form-control-sm');
                }

                const exportButtonContainer = document.querySelector('.export_button');
                if (exportButtonContainer) {
                    exportButtonContainer.innerHTML = `
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Export
                            </button>
                            <ul class="dropdown-menu"></ul>
                        </div>
                    `;
                    this.api().buttons().container().appendTo(exportButtonContainer.querySelector('.dropdown-menu'));
                }
            }
        });

        // Delete Record
        dtCategoryList.querySelector('tbody').addEventListener('click', function (event) {
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
    }

    let productDescEditor = document.getElementById('category-desc');
    if (productDescEditor) {
        // Initialize Quill editor
        const snowEditor = new Quill(productDescEditor, {
            theme: 'snow', // Using snow theme
            modules: {
                toolbar: true,
            },
            placeholder: 'Type your text here...',
        });
    }

    const publishingDate = document.getElementById('publishing-date');
    if (publishingDate) {
        const localeEn = {
            days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            today: 'Today',
            clear: 'Clear',
            dateFormat: 'mm/dd/yyyy',
            timeFormat: 'hh:ii aa',
            firstDay: 0
        }
        new AirDatepicker(publishingDate, {
            locale: localeEn
        });
    }

    const productStatus = document.getElementById('category-status');
    if (productStatus) {
        new Choices(productStatus, {
            // removeItemButton: true,
            placeholderValue: 'Select Tax',
            searchEnabled: false,
            itemSelectText: false,
        });
        // Toggle publishing date visibility
        function togglePublishingDate() {
            publishingDate.closest('.scheduled-input').style.display = (productStatus.value === "scheduled") ? 'block' : 'none';
        }

        // Initial visibility check and change event
        productStatus.addEventListener('change', togglePublishingDate);
        togglePublishingDate();
    }
});
