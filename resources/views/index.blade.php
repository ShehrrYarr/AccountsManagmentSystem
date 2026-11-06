
@extends('partials.layouts.master')

    @section('title', 'E-Commerce | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'E-Commerce ' )
    @section('pagetitle', 'Dashboard')
    @section('buttonTitle', 'Add Product')
    @section('link', 'apps-product-create')
  

    @section('content')
    <div class="e-commerce-dashboard">
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="hstack flex-wrap justify-content-between gap-3 align-items-end">
                            <div class="flex-grow-1">
                                <div class="hstack gap-3 mb-3">
                                    <div class="bg-warning-subtle text-warning avatar avatar-item rounded-2">
                                        <!-- <i class="ri-money-dollar-circle-line fs-16 fw-medium"></i> -->
                                        <i class="bi bi-house-heart-fill fs-16 fw-medium"></i>
                                    </div>
                                    <h6 class="mb-0 fs-13">Total Sales</h6>
                                </div>
                                <h4 class="fw-semibold fs-5 mb-0">
                                    <span data-target="84573" data-duration="5" data-prefix="$">$84573</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="d-flex align-items-end justify-content-end gap-3">
                                    <span class="text-success"><i class="ri-arrow-right-up-line fs-12"></i>10.18%</span>
                                </div>
                                <div class="text-muted fs-12">+1.01% this week</div>
                            </div>
                        </div>
                    </div>
                    <div id="totalSalesDashborad"></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="hstack flex-wrap justify-content-between gap-3 align-items-end">
                            <div class="flex-grow-1">
                                <div class="hstack gap-3 mb-3">
                                    <div class="bg-danger-subtle text-danger avatar avatar-item rounded-2">
                                        <i class="ri-money-dollar-circle-line fs-16 fw-medium"></i>
                                    </div>
                                    <h6 class="mb-0 fs-13">Total Orders</h6>
                                </div>
                                <h4 class="fw-semibold fs-5 mb-0">
                                    <span data-target="202557" data-duration="5" data-prefix="$">$202557</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="d-flex align-items-end justify-content-end gap-3">
                                    <span class="text-danger"><i class="ri-arrow-right-down-line fs-12"></i>1.01%</span>
                                </div>
                                <div class="text-muted fs-12">-0.31% this week</div>
                            </div>
                        </div>
                    </div>
                    <div id="totalOrdersDashborad"></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="hstack flex-wrap justify-content-between gap-3 align-items-end">
                            <div class="flex-grow-1">
                                <div class="hstack gap-3 mb-3">
                                    <div class="bg-success-subtle text-success avatar avatar-item rounded-2">
                                        <i class="ri-money-dollar-circle-line fs-16 fw-medium"></i>
                                    </div>
                                    <h6 class="mb-0 fs-13">Total Earnings</h6>
                                </div>
                                <h4 class="fw-semibold fs-5 mb-0">
                                    <span data-target="202557" data-duration="5" data-prefix="$">$202557</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="d-flex align-items-end justify-content-end gap-3">
                                    <span class="text-success"><i class="ri-arrow-right-up-line fs-12"></i>10.10</span>
                                </div>
                                <div class="text-muted fs-12">+1.99% this week</div>
                            </div>
                        </div>
                    </div>
                    <div id="totalEarningsDashborad"></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="hstack flex-wrap justify-content-between gap-3 align-items-end">
                            <div class="flex-grow-1">
                                <div class="hstack gap-3 mb-3">
                                    <div class="bg-info-subtle text-info avatar avatar-item rounded-2">
                                        <i class="ri-truck-line fs-16 fw-medium"></i>
                                    </div>
                                    <h6 class="mb-0 fs-13">Total Shipments</h6>
                                </div>
                                <h4 class="fw-semibold fs-5 mb-0">
                                    <span data-target="17892" data-duration="5" data-prefix="$">$17,892</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <div class="d-flex align-items-end justify-content-end gap-3">
                                    <span class="text-success"><i class="ri-arrow-right-up-line fs-12"></i>5.50%</span>
                                </div>
                                <div class="text-muted fs-12">+2.15% this week</div>
                            </div>
                        </div>
                    </div>
                    <div id="totalShipmentsDashboard"></div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-6 h-100">
                <div class="card mb-0">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="flex-grow-1">
                            <h5 class="mb-1">Order Analytics</h5>
                            <p class="mb-0 card-subtitle">Total 248.5k Visits</p>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-outline-primary btn-sm active">1W</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">1M</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">6M</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">1Y</button>
                        </div>
                    </div>
                    <div class="card-body p-2 pb-0">
                        <div id="orderAnalyticsDashboard" class="apexcharts-container apexcharts-white"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 h-100">
                <div class="card mb-0">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Customer Review Insights</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center justify-content-center p-4 rounded bg-light bg-opacity-30 mb-4">
                            <div class="d-inline-flex position-relative cursor-pointer text-warning fs-3">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-line"></i>
                            </div>
                            <h6 class="py-2 fs-6 fw-semibold text-primary">4.5/5</h6>
                            <p class="text-muted mb-0">Based on 650 customer reviews</p>
                        </div>
                        <div class="text-nowrap d-flex flex-column justify-content-between gap-1">
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-flex gap-1 align-items-center text-muted fs-13 flex-shrink-0">5 Star</span>
                                <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success w-100"></div>
                                </div>
                                <span class="w-30px text-end fw-semibold flex-shrink-0 ms-4">100%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-flex gap-1 align-items-center text-muted fs-13 flex-shrink-0">4 Star</span>
                                <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-info" style="width: 80%;"></div>
                                </div>
                                <span class="w-30px text-end fw-semibold flex-shrink-0 ms-4">80%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-flex gap-1 align-items-center text-muted fs-13 flex-shrink-0">3 Star</span>
                                <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-warning w-75"></div>
                                </div>
                                <span class="w-30px text-end fw-semibold flex-shrink-0 ms-4">75%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-flex gap-1 align-items-center text-muted fs-13 flex-shrink-0">2 Star</span>
                                <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-danger w-50"></div>
                                </div>
                                <span class="w-30px text-end fw-semibold flex-shrink-0 ms-4">50%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="d-flex gap-1 align-items-center text-muted fs-13 flex-shrink-0">1 Star</span>
                                <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-secondary w-25"></div>
                                </div>
                                <span class="w-30px text-end fw-semibold flex-shrink-0 ms-4">25%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 h-100">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <h5 class="card-title mb-0">Revenue</h5>
                        <div class="dropdown flex-shrink-0">
                            <a class="text-reset dropdown-toggle" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Last Month</span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#!">Today</a>
                                <a class="dropdown-item" href="#!">Last Week</a>
                                <a class="dropdown-item" href="#!">Last Month</a>
                                <a class="dropdown-item" href="#!">Current Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="fw-semibold d-flex align-items-center gap-3 mb-4">
                            <span>$16520</span>
                            <span class="badge text-danger bg-danger-subtle p-1"><i class="ri-arrow-right-down-line fs-12"></i>1.5%</span>
                        </h4>
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
                            <span class="fs-12 fw-normal text-muted"><strong class="me-1 text-body">$6,500</strong>More to reach Goal</span>
                            <span class="fw-semibold">75%</span>
                        </div>
                        <div class="progress progress-xs w-100" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-primary w-75"></div>
                        </div>
                    </div>
                </div>
                <div class="card mb-0">
                    <div class="card-header">
                        <h5 class="mb-0">New Customer Joined</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="fw-semibold d-flex align-items-center gap-3 mb-4">
                            <span class="text-warning">4.5K</span>
                            <span class="badge text-success bg-success-subtle p-1"><i class="ri-arrow-right-up-line fs-12"></i>4.3%</span>
                        </h4>
                        <div>
                            <div class="avatar-group">
                                <div class="position-relative" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Tooltip on top">
                                    <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                </div>
                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="avatar image">
                                <div class="avatar-item avatar fw-semibold avatar-title bg-text-primary">5+</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-8 col-xl-9">
                <div class="card mb-0">
                    <table id="recent-order-table" class="table align-middle w-100 table-nowrap">
                        <thead class="bg-light bg-opacity-30">
                            <tr>
                                <th class="px-5"></th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="card mb-0">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <h5 class="card-title mb-0 flex-grow-1">Top Products</h5>
                        <select id="top-product-select" class="form-select flex-shrink-0">
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Annualy">Annualy</option>
                        </select>
                    </div>
                    <div class="card-body top-product-scroll" data-simplebar>
                        <ul class="list-group fs-13 fw-medium list-group-flush">
                            <li class="list-group-item hstack gap-2 px-0 pt-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-1.jpg') }}" alt="Nike Shoes">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">Nike Shoes</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 1947</span>
                                    </div>
                                    <div class="badge text-success bg-success-subtle p-1">+18.4%</div>
                                </div>
                            </li>
                            <li class="list-group-item hstack gap-2 px-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-2.jpg') }}" alt="Gabrielloe Perfume">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">Gabrielloe Perfume</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 1498</span>
                                    </div>
                                    <span class="badge text-danger bg-danger-subtle p-1">-5.2%</span>
                                </div>
                            </li>
                            <li class="list-group-item hstack gap-2 px-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-3.jpg') }}" alt="Headphone">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">Headphone</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 1176</span>
                                    </div>
                                    <div class="badge text-success bg-success-subtle p-1">+9.7%</div>
                                </div>
                            </li>
                            <li class="list-group-item hstack gap-2 px-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-4.jpg') }}" alt="Cocooil Body Oil">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">Cocooil Body Oil</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 723</span>
                                    </div>
                                    <span class="badge text-danger bg-danger-subtle p-1">-3.4%</span>
                                </div>
                            </li>
                            <li class="list-group-item hstack gap-2 px-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-5.jpg') }}" alt="Earbuds">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">Earbuds</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 554</span>
                                    </div>
                                    <div class="badge text-success bg-success-subtle p-1">+12.6%</div>
                                </div>
                            </li>
                            <li class="list-group-item hstack gap-2 px-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-7.jpg') }}" alt="T-shirt">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">T-shirt</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 347</span>
                                    </div>
                                    <div class="badge text-success bg-success-subtle p-1">+7.8%</div>
                                </div>
                            </li>
                            <li class="list-group-item hstack gap-2 px-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-8.jpg') }}" alt="T-shirt">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">Specker</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 300</span>
                                    </div>
                                    <div class="badge text-success bg-success-subtle p-1">+7.8%</div>
                                </div>
                            </li>
                            <li class="list-group-item hstack gap-2 px-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-1.jpg') }}" alt="Nike Shoes">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">Nike Shoes</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 1947</span>
                                    </div>
                                    <div class="badge text-success bg-success-subtle p-1">+18.4%</div>
                                </div>
                            </li>
                            <li class="list-group-item hstack gap-2 px-0 pb-0">
                                <img class="avatar avatar-item overflow-hidden border-0 rounded flex-shrink-0" src="{{ asset('assets/images/product/product-2.jpg') }}" alt="Gabrielloe Perfume">
                                <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                    <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-bold text-truncate text-body">Gabrielloe Perfume</a>
                                        <span class="text-muted fw-normal text-truncate fs-12">Sold: 1498</span>
                                    </div>
                                    <span class="badge text-danger bg-danger-subtle p-1">-5.2%</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Countup init -->
    <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Ecommerce dashboard init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @endsection