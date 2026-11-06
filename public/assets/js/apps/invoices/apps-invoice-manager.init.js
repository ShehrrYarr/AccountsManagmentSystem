// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Invoice Manager init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const dtInvoiceList = document.querySelector('.dt-invoice-list');

    // Invoice datatable initialization
    if (dtInvoiceList) {
        const dtInvoice = new DataTable(dtInvoiceList, {
            ajax: 'assets/json/invoice-list.json', // JSON source for data
            columns: [
                { data: 'id' },               // #ID Column
                { data: 'fullName' },         // Client Name
                { data: 'dateIssued' },       // Issued Date
                { data: 'contactEmail' },     // email
                { data: 'status' },           // Invoice Status
                { data: 'action' }            // Actions Column
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full) {
                        return `<a href="#!"><span>#${full.id}</span></a>`;
                    }
                },
                {
                    targets: 1,
                    render: function (data, type, full) {
                        return `
                        <div class="d-flex gap-3 justify-content-start align-items-center">
                            <img src="${full.avatarImage}" alt="Avatar" class="avatar avatar-sm border-0 avatar-item">
                            <div class="d-flex flex-column">
                                <a href="apps-invoices-details" class="text-truncate text-heading">
                                    <p class="mb-0 fw-medium">${full.fullName}</p>
                                </a>
                                <small class="text-truncate">${full.serviceType}</small>
                            </div>
                        </div>
                    `;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full) {
                        const statusBadges = {
                            Sent: `<span class="badge bg-success-subtle text-success text-uppercase">${full.status}</span>`,
                            Draft: `<span class="badge bg-primary-subtle text-primary text-uppercase">${full.status}</span>`,
                            'Past Due': `<span class="badge bg-danger-subtle text-danger text-uppercase">${full.status}</span>`,
                            'Partial Payment': `<span class="badge bg-success-subtle text-success text-uppercase">${full.status}</span>`,
                            Paid: `<span class="badge bg-warning-subtle text-warning text-uppercase">${full.status}</span>`,
                            Pending: `<span class="badge bg-info-subtle text-info text-uppercase">${full.status}</span>`
                        };

                        return statusBadges[full.status] || `<span class="badge bg-secondary">${full.status}</span>`;
                    }
                },
                {
                    targets: 5,
                    searchable: false,
                    orderable: false,
                    render: function () {
                        return `
                        <div class="dropdown">
                            <a href="#!" class="btn btn-text-primary rounded-pill icon-btn-sm" data-bs-toggle="dropdown">
                                <i class="ri-more-2-line fs-16"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#!" class="dropdown-item">Download</a>
                                <a href="apps-invoices-details" class="dropdown-item">View</a>
                                <a href="apps-create-invoices" class="dropdown-item">Edit</a>
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
                searchPlaceholder: 'Search Invoice',
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
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Sent">Sent</option>
                    <option value="Draft">Draft</option>
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
                    dtInvoice.column(4).search(value === 'all' ? '' : value).draw();
                });

                document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Invoice List</h5>';

            }
        });

        // Delete Record
        dtInvoiceList.querySelector('tbody').addEventListener('click', function (event) {
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

    // invoice-list chart
    const chartOptions = {
        chart: {
            height: 240,
            type: 'donut'
        },
        labels: ['Draft Invoices', 'Paid Invoices', 'Pending Invoices', 'Sent Invoices'],
        series: [20, 30, 17, 33],
        colors: ['--bs-primary', '--bs-success', '--bs-warning', '--bs-danger'],
        stroke: {
            show: false,
            curve: 'straight'
        },
        dataLabels: {
            enabled: true,
            formatter: (value) => `${parseInt(value, 10)}%`,
            dropShadow: {
                enabled: false
            }
        },
        legend: {
            show: true,
            position: 'bottom',
            markers: {
                offsetX: -3,
                width: 10,
                height: 10
            },
            itemMargin: {
                vertical: 3,
                horizontal: 10
            },
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        value: {
                            formatter: (value) => `${parseInt(value, 10)}%`
                        },
                        total: {
                            show: true,
                            label: 'Draft Invoices',
                            formatter: () => '20%'
                        }
                    }
                }
            }
        },
        responsive: [
            {
                breakpoint: 992,
                options: {
                    chart: {
                        height: 250
                    },
                    legend: {
                        position: 'bottom',
                    },
                }
            },
            {
                breakpoint: 576,
                options: {
                    legend: {
                        show: false
                    }
                }
            }
        ]
    };
    allCharts.push([{ 'id': 'invoice-list', 'data': chartOptions }]);

    const printContent = document.querySelector('#printContent');
    if (printContent) {
        onload = window.print();
    }
});
