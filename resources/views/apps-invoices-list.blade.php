@extends('partials.layouts.master')

@section('title', 'Invoice List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Invoice List')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'Add new')
@section('link', 'apps-create-invoices')

@section('content')

    <div class="row">
        <div class="col-lg-7">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Invoice</h5>
                </div>
                <div class="card-body px-2 py-4">
                    <div id="invoice-list"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="row h-100">
                <div class="col-lg-6">
                    <div class="card card-h-100 overflow-hidden">
                        <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                            <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="mb-2 fs-12">Total Amount</h6>
                                    <h4 class="fw-medium mb-1">
                                        <span data-target="386" data-duration="5" data-prefix="$" data-suffix="k">386</span>
                                    </h4>
                                    <span class="badge bg-warning">12,895</span>
                                </div>
                                <div class="text-muted fs-13 mt-2">Increased By
                                    <span class="text-success">2.13%<i class="ri-arrow-up-line fs-16"></i></span>
                                </div>
                            </div>
                            <div class="bg-warning-subtle text-warning avatar avatar-item border-2 border border-warning">
                                <i class="ri-money-dollar-circle-line fs-16 fw-medium"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-h-100 overflow-hidden">
                        <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                            <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="mb-2 fs-12">Total Paid</h6>
                                    <h4 class="fw-medium mb-1">
                                        <span data-target="127" data-duration="5" data-prefix="$" data-suffix="k">127</span>
                                    </h4>
                                    <span class="badge bg-secondary-subtle text-body-emphasis">3,457</span>
                                </div>
                                <div class="text-muted fs-13 mt-2">Decreased By
                                    <span class="text-danger">1.05%<i class="ri-arrow-down-line fs-16"></i></span>
                                </div>
                            </div>
                            <div
                                class="bg-secondary-subtle text-secondary avatar avatar-item border-2 border border-secondary">
                                <i class="ri-wallet-line fs-16 fw-medium"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-h-100 overflow-hidden">
                        <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                            <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="mb-2 fs-12">Pending Invoices</h6>
                                    <h4 class="fw-medium mb-1">
                                        <span data-target="57" data-duration="5">57</span>
                                    </h4>
                                    <span class="badge bg-success">5,447</span>
                                </div>
                                <div class="text-muted fs-13 mt-2">Decreased By
                                    <span class="text-danger">2.06%<i class="ri-arrow-down-line fs-16"></i></span>
                                </div>
                            </div>
                            <div class="bg-success-subtle text-success avatar avatar-item border-2 border border-success">
                                <i class="ri-file-pdf-line fs-16 fw-medium"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-h-100 overflow-hidden">
                        <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                            <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="mb-2 fs-12">Overdue Invoices</h6>
                                    <h4 class="fw-medium mb-1">
                                        <span data-target="45" data-duration="5" data-suffix="k">45</span>
                                    </h4>
                                    <span class="badge bg-danger text-white">2,145</span>
                                </div>
                                <div class="text-muted fs-13 mt-2">Increased By
                                    <span class="text-success">1.3%<i class="ri-arrow-up-line fs-16"></i></span>
                                </div>
                            </div>
                            <div class="bg-danger-subtle text-danger avatar avatar-item border-2 border border-danger">
                                <i class="ri-time-line fs-16 fw-medium"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="card mb-0">
        <table class="dt-invoice-list table-nowrap align-middle table w-100">
            <thead class="bg-light bg-opacity-30">
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th class="text-truncate">Issued Date</th>
                    <th>Email</th>
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

    <!-- Calendar init -->
    <script src="{{ asset('assets/js/apps/invoices/apps-invoice-manager.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
