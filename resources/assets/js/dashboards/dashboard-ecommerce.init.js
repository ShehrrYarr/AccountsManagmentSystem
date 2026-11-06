// /*
// Template Name: Herozi - Admin & Dashboard Template
// Author: SRBThemes
// Contact: sup.srbthemes@gmail.com
// File: E-Commerce Dashboard init js
// */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const recentOrderTable = document.querySelector('#recent-order-table');
    // Recent Order datatable initialization
    if (recentOrderTable) {
        const recentOrderTableEl = new DataTable(recentOrderTable, {
            ajax: 'assets/json/recent-order.json', // JSON source for data
            columns: [
                { data: 'order_id' },
                { data: 'order_id' },               // Order ID Column
                { data: 'customer_name' },          // Customer Name Column
                { data: 'order_date' },             // Order Date Column
                { data: 'order_status' },           // Order Status Column
                { data: 'total_amount' },           // Total Amount Column
                { data: 'payment_method' },         // Payment Method Column
                { data: 'actions' }                 // Actions Column
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
                        return `<span class="order-id-click cursor-pointer">#${full.order_id}</span>`;
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, full) {
                        return `<a href="#!"><span>${full.customer_name}</span></a>`;
                    }
                },
                {
                    targets: 3,
                    render: function (data, type, full) {
                        return `<span>${new Date(full.order_date).toLocaleString()}</span>`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, full) {
                        return `$${full.total_amount.toFixed(2)}`;
                    }
                },
                {
                    targets: 5,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full) {
                        return `<span>${full.payment_method}</span>`;
                    }
                },
                {
                    targets: 6,
                    orderable: false,
                    render: function (data, type, full) {
                        const statusBadges = {
                            Pending: `<span class="badge bg-info-subtle text-info">${full.order_status}</span>`,
                            warning: `<span class="badge bg-primary-subtle text-primary">${full.order_status}</span>`,
                            Shipped: `<span class="badge bg-warning-subtle text-warning">${full.order_status}</span>`,
                            Delivered: `<span class="badge bg-success-subtle text-success">${full.order_status}</span>`,
                        };

                        return statusBadges[full.order_status] || `<span class="badge bg-secondary">${full.order_status}</span>`;
                    }
                },
                {
                    targets: 7,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full) {
                        return `<div class="dropdown">
                                <a href="#!" class="btn btn-text-primary rounded-pill icon-btn-sm" data-bs-toggle="dropdown">
                                    <i class="ri-more-2-line fs-16"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="apps-product-order-details" class="dropdown-item">View</a>
                                    <a href="apps-product-order-list" class="dropdown-item">Edit</a>
                                    <a href="#!" class="dropdown-item delete-item">Delete</a>
                                </div>
                            </div>`;
                    }
                }
            ],
            order: [[2, 'desc']], // Sorting by Order Date (2nd column)
            dom: '<"card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3"' +
                '<"head-label">' +
                '<"d-flex flex-column flex-sm-row align-items-sm-center justify-content-end gap-3 w-100"f<"order_status">>' +
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
            pageLength: 7,
            initComplete: function () {
                const orderStatus = document.querySelector('.order_status');
                orderStatus.innerHTML = `
                <select id="order-status-select" class="form-select">
                    <option value="all">All</option>
                    <option value="Pending">Pending</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Delivered">Delivered</option>
                </select>`;

                // Filter Invoice Status
                const select = document.querySelector('#order-status-select');
                new Choices('#order-status-select', {
                    searchEnabled: false,
                    placeholder: false,
                    itemSelectText: false,
                });

                // Event listener to filter orders based on selected status
                select.addEventListener('change', function () {
                    const value = this.value;
                    recentOrderTableEl.column(6).search(value === 'all' ? '' : value).draw();
                });

                document.querySelector('div.head-label').innerHTML = '<h5 class="card-title text-nowrap mb-0">Recent Orders</h5>';
            }
        });

        // Handle Order ID click to show nested table
        recentOrderTable.querySelector('tbody').addEventListener('click', function (event) {
            if (event.target.classList.contains('order-id-click')) {
                const row = event.target.closest('tr');
                const rowData = recentOrderTableEl.row(row).data();
                const orderDetails = rowData.items_ordered;

                // Check if this row already has the nested table
                if (recentOrderTableEl.row(row).child.isShown()) {
                    recentOrderTableEl.row(row).child.hide();  // Hide nested table
                } else {
                    // Create nested table structure
                    let nestedTable = `
                    <table class="table align-middle mb-0">
                        <tbody>
                            ${orderDetails.map(item => `
                                <tr>
                                    <td colspan="2">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src=${item.order_image} class="avatar-item img-fuild border-0 avatar rounded-2" alt=${item.item_name} />
                                            <div class="d-flex flex-column text-muted">
                                                <a href="#!" class="text-body fw-semibold">${item.item_name}</a>
                                                <div class="fs-12 text-muted">${item.item_description}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">Cost</div>
                                        <div class="fs-12 text-muted">${item.item_price}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">Qty</div>
                                        <div class="fs-12 text-muted">${item.item_quantity}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">Total</div>
                                        <div class="fs-12 text-muted">${item.item_total}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">Total</div>
                                        <div class="fs-12 text-muted">${item.item_total}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">On hand</div>
                                        <div class="fs-12 text-muted">${item.order_status}</div>
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>`;

                    // Show the nested table
                    recentOrderTableEl.row(row).child(nestedTable).show();
                }
            }
        });

        // Delete Record
        recentOrderTable.querySelector('tbody').addEventListener('click', function (event) {
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
                        recentOrderTableEl.row(row).remove().draw();
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

    // total sales chart
    const totalSalesDashboradOption = {
        chart: {
            height: 70,
            type: 'area',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            }
        },
        colors: ['--bs-warning'],
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                shadeIntensity: 0.8,
                opacityFrom: 0.6,
                opacityTo: 0.5
            }
        },
        series: [
            {
                data: [387, 386, 387, 385, 386, 384, 384, 384, 386, 389, 387, 387, 386, 386, 385, 386, 387, 385, 384, 385]
            }
        ],
        tooltip: {
            enabled: false
        }
    };
    allCharts.push([{ 'id': 'totalSalesDashborad', 'data': totalSalesDashboradOption }]);

    const totalOrdersDashboradOption = {
        chart: {
            height: 70,
            type: 'area',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            }
        },
        colors: ['--bs-danger'],
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                shadeIntensity: 0.8,
                opacityFrom: 0.6,
                opacityTo: 0.5
            }
        },
        series: [
            {
                data: [387, 386, 387, 385, 386, 384, 384, 384, 386, 389, 387, 387, 386, 386, 385, 386, 387, 385, 384, 385]
            }
        ],
        tooltip: {
            enabled: false
        }
    };
    allCharts.push([{ 'id': 'totalOrdersDashborad', 'data': totalOrdersDashboradOption }]);

    const totalEarningsDashboradOption = {
        chart: {
            height: 70,
            type: 'area',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            }
        },
        colors: ['--bs-success'],
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                shadeIntensity: 0.8,
                opacityFrom: 0.6,
                opacityTo: 0.5
            }
        },
        series: [
            {
                data: [387, 386, 387, 385, 386, 384, 384, 384, 386, 389, 387, 387, 386, 386, 385, 386, 387, 385, 384, 385]
            }
        ],
        tooltip: {
            enabled: false
        }
    };
    allCharts.push([{ 'id': 'totalEarningsDashborad', 'data': totalEarningsDashboradOption }]);

    // total shipments chart
    const totalShipmentsDashboardOption = {
        chart: {
            height: 70,
            type: 'area',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            }
        },
        colors: ['--bs-info'],
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                shadeIntensity: 0.8,
                opacityFrom: 0.6,
                opacityTo: 0.5
            }
        },
        series: [
            {
                data: [302, 310, 308, 312, 315, 314, 318, 320, 323, 325, 324, 322, 324, 323, 322, 321, 325, 328, 330, 332]
            }
        ],
        tooltip: {
            enabled: false
        }
    };
    allCharts.push([{ 'id': 'totalShipmentsDashboard', 'data': totalShipmentsDashboardOption }]);

    // Order analytics chart with two series: Online Orders and Offline Orders
    const orderAnalyticsDashboardOption = {
        series: [
            {
                name: 'Online Orders',
                data: [30, 50, 70, 40, 60, 80, 90, 100, 80, 70, 60, 50],
            },
            {
                name: 'Offline Orders',
                data: [20, 30, 40, 20, 30, 50, 60, 70, 50, 40, 30, 20],
            },
        ],
        chart: {
            type: "bar",
            stacked: false, // Set to false for grouped bars
            zoom: {
                enabled: false,
            },
            toolbar: {
                show: false, // Hides the toolbar
            },
            height: 255,
        },
        plotOptions: {
            bar: {
                columnWidth: '30%', // Adjust width to fit multiple series
                distributed: false, // Set to false for grouped bars
                borderRadius: 4,
                borderRadiusApplication: 'end',
            }
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
        labels: [
            "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
        ],
        xaxis: {
            categories: [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
            ],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            crosshairs: {
                show: true,
            },
        },
        yaxis: {
            tickAmount: 5,
            min: 0,
            max: 100,
            labels: {
                formatter: function (value) {
                    return value;
                },
                offsetX: -10,
                offsetY: 0,
            },
            opposite: false,
        },
        grid: {
            strokeDashArray: 3,
        },
        colors: ['--bs-primary', '--bs-light'],
        tooltip: {
            marker: {
                show: false,
            },
            y: {
                formatter: function (value) {
                    return value; // Display the order count directly
                },
            },
        },
    };
    allCharts.push([{ 'id': 'orderAnalyticsDashboard', 'data': orderAnalyticsDashboardOption }]);

    const topProductSelect = document.querySelector('#top-product-select');
    if (topProductSelect) {
        new Choices(topProductSelect, {
            searchEnabled: false,
            placeholder: false,
            itemSelectText: false,
        });
    }

});
