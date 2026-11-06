// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: Product order list init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const dtInvoiceList = document.querySelector('.dt-invoice-list');

    // Invoice datatable initialization
    if (dtInvoiceList) {
        const dtInvoice = new DataTable(dtInvoiceList, {
            ajax: 'assets/json/order-list.json', // JSON source for data
            columns: [
                { data: 'id' },               // #ID Column
                { data: 'id' },               // #ID Column
                { data: 'fullName' },         // Client Name
                { data: 'orderDate' },       // Issued Date
                { data: 'deliveryDate' },       // Issued Date
                { data: 'contactEmail' },     // email
                { data: 'status' },           // Invoice Status
                { data: 'action' }            // Actions Column
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
                    render: function (data, type, full) {
                        return `<a href="apps-product-order-details">#${full.id}</a>`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full) {
                        return `
                        <div class="d-flex gap-2 justify-content-start align-items-center">
                            <div class="avatar avatar-sm rounded-circle overflow-hidden">
                                <img src="${full.avatarImage}" alt="Avatar" class="img-fluid">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="apps-product-order-details" class="text-truncate text-body">
                                    <p class="mb-0 fw-medium">${full.fullName}</p>
                                </a>
                                <span class="text-truncate text-muted fs-12">${full.contactEmail}</span>
                            </div>
                        </div>
                    `;
                    }
                },
                {
                    targets: 6,
                    orderable: false,
                    render: function (data, type, full) {
                        // Format the amount to 2 decimal places and return it as currency
                        let amount = parseFloat(full.amount).toFixed(2);
                        return `$${amount}`; // Formats as currency with 2 decimals
                    }
                },
                {
                    targets: 7,
                    render: function (data, type, full) {
                        const statusBadges = {
                            Sent: `<span class="badge bg-success-subtle text-success text-uppercase">${full.status}</span>`,
                            Draft: `<span class="badge bg-primary-subtle text-primary text-uppercase">${full.status}</span>`,
                            Returns: `<span class="badge bg-light text-muted text-uppercase">${full.status}</span>`,
                            Delivered: `<span class="badge bg-success-subtle text-success text-uppercase">${full.status}</span>`,
                            Cancelled: `<span class="badge bg-danger-subtle text-danger text-uppercase">${full.status}</span>`,
                            Inprogress: `<span class="badge bg-primary-subtle text-primary text-uppercase">${full.status}</span>`,
                            Pending: `<span class="badge bg-warning-subtle text-warning text-uppercase">${full.status}</span>`,
                            Pickups: `<span class="badge bg-info-subtle text-info text-uppercase">${full.status}</span>`
                        };

                        return statusBadges[full.status] || `<span class="badge bg-light">${full.status}</span>`;
                    }
                },
                {
                    targets: 8,
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
                                <a href="apps-product-order-details" class="dropdown-item">View</a>
                                <a href="#!" class="dropdown-item">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a href="#!" class="dropdown-item delete-item">Delete</a>
                            </div>
                        </div>
                    `;
                    }
                }
            ],
            order: [[2, 'desc']],
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"head-label">' +
                '<"d-flex flex-column flex-sm-row align-items-sm-center justify-content-end gap-3 w-100"f<"order_list_status">>' +
                '>' +
                '<"table-responsive"t>' +
                '<"card-footer d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2"i' +
                '<"d-flex align-items-sm-center justify-content-end gap-4">p' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: '',
                searchPlaceholder: 'Search Orders',
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            lengthMenu: [10, 20, 50],
            pageLength: 10,
            initComplete: function () {
                const headLabel = document.querySelector('.head-label');
                if (headLabel) {
                    headLabel.innerHTML = '<h5 class="card-title text-nowrap mb-0">Order List</h5>';
                }

                const inputElement = document.querySelector('.dataTables_filter .form-control');
                if (inputElement) {
                    inputElement.classList.remove('form-control-sm');
                }

                // Update Invoice status
                const invoiceStatus = document.querySelector('.order_list_status');
                if (invoiceStatus) {
                    invoiceStatus.innerHTML = `
                        <select id="order_list_status-select" class="form-select">
                            <option value="all" selected>All</option>
                            <option value="Pending">Pending</option>
                            <option value="Inprogress">Inprogress</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Pickups">Pickups</option>
                            <option value="Returns">Returns</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    `;

                }
                const orderListStatus = document.querySelector('#order_list_status-select');
                new Choices(orderListStatus, {
                    searchEnabled: false,
                    placeholder: false,
                    itemSelectText: false,
                });

                orderListStatus.addEventListener('change', function () {
                    const value = this.value;
                    dtInvoice.column(4).search(value === 'all' ? '' : value).draw();
                });
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

    }

    // Earning Reports chart
    const earningReportContainer = document.querySelector('#earningReports');
    if (earningReportContainer) {
        const chartOptions = {
            series: [{
                data: [22000, 13000, 48000, 27000, 9000, 42000, 18000, 35000, 15000]
            }],
            chart: {
                type: 'bar',
                height: 231,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    columnWidth: '35%',
                    borderRadius: 8,
                    distributed: true,
                    dataLabels: { position: 'top' }
                }
            },
            grid: {
                show: false,
                padding: {
                    top: 0,
                    bottom: 0,
                    left: -10,
                    right: -10
                }
            },
            colors: ['--bs-light', '--bs-light', '--bs-primary', '--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-light', '--bs-light'],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return parseInt(val / 1000) + 'k';
                },
                offsetY: -20,
                style: {
                    fontSize: '14px',
                    colors: ['#6f6b7d'],
                    fontWeight: '500',
                },
            },
            legend: { show: false },
            tooltip: { enabled: false },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                axisTicks: { show: false },
            },
            yaxis: {
                labels: {
                    offsetX: -15,
                    formatter: function (val) {
                        return parseInt(val / 1000) + 'k';
                    },
                }
            },
        };
        allCharts.push([{ 'id': 'earningReports', 'data': chartOptions }]);
    }
});
