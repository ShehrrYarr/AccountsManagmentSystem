@extends('partials.layouts.master')

@section('title', 'Order List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Order List')
@section('pagetitle', 'Ecommerce')
@section('buttonTitle', 'Product list')
@section('link', 'apps-products')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Earning Reports</h5>
                </div>
                <div class="card-body">
                    <div id="earningReports"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

            <div class="row h-100">

                <div class="col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <h6 class="mb-2 fs-12">Payment Refund</h6>
                                <h4 class="fw-medium mb-1">
                                    <span data-target="490" data-duration="5" data-prefix="$" data-suffix="k">$490k</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-3 avatar avatar-item">
                                <i class="bi bi-currency-dollar fs-22"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <h6 class="mb-2 fs-12">Order Cancel</h6>
                                <h4 class="fw-medium mb-1">
                                    <span data-target="241" data-duration="5" data-prefix="" data-suffix="">241</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-3 avatar avatar-item">
                                <i class="bi bi-cart-x fs-22"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <h6 class="mb-2 fs-12">Order Shipped</h6>
                                <h4 class="fw-medium mb-1">
                                    <span data-target="630" data-duration="5" data-prefix="" data-suffix="">630</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-3 avatar avatar-item">
                                <i class="bi bi-box fs-22"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <h6 class="mb-2 fs-12">Order Delivering</h6>
                                <h4 class="fw-medium mb-1">
                                    <span data-target="170" data-duration="5" data-prefix="" data-suffix="">170</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-3 avatar avatar-item">
                                <i class="bi bi-truck fs-22"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <h6 class="mb-2 fs-12">Pending Review</h6>
                                <h4 class="fw-medium mb-1">
                                    <span data-target="210" data-duration="5" data-prefix="" data-suffix="">210</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-3 avatar avatar-item">
                                <i class="bi bi-file-earmark-check fs-22"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <h6 class="mb-2 fs-12">Pending Payment</h6>
                                <h4 class="fw-medium mb-1">
                                    <span data-target="80" data-duration="5" data-prefix="$" data-suffix="k">$80k</span>
                                </h4>
                            </div>
                            <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-3 avatar avatar-item">
                                <i class="bi bi-clock fs-22"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="card mb-0">
        <table class="dt-invoice-list table align-middle w-100 table-nowrap">
            <thead class="bg-light bg-opacity-30">
                <tr>
                    <th class="px-5"></th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th class="text-truncate">Order Date</th>
                    <th class="text-truncate">Delivery Date</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

@endsection

@section('js')

    <!-- Countup init -->
    <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>

    <!-- app product order list init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-product-order-list.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
