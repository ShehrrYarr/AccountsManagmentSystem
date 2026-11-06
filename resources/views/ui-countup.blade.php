@extends('partials.layouts.master2')

    @section('title', 'UI Counter | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Counter' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  


    @section('content')

    <div class="row g-4">
        <div class="col-12">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic example</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Use the fields below to enter a date. Please follow the specified format for each field:</p>

                    <div class="row g-5">
                        <div class="col-12 col-md-6 col-xl-3 text-center">
                            <h3 class="fw-bold mb-0" data-target="52147" data-duration="5" data-separator=",">52147</h3>
                            <p class="mb-0 fs-6">Code Lines</p>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3 text-center">
                            <h3 class="fw-bold mb-0" data-target="24583" data-duration="5" data-separator=",">24583</h3>
                            <p class="mb-0 fs-6">Projects</p>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3 text-center">
                            <h3 class="fw-bold mb-0" data-target="7348" data-duration="5" data-separator=",">7348</h3>
                            <p class="mb-0 fs-6">Working Hours</p>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3 text-center">
                            <h3 class="fw-bold mb-0" data-target="87904" data-duration="5" data-separator=",">87904</h3>
                            <p class="mb-0 fs-6">Job Offers</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Nagative Values</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Use the fields below to enter a date. Please follow the specified format for each field:</p>

                    <div class="row g-5">
                        <div class="col-12 col-md-6 col-xl-3 text-center">
                            <h3 class="fw-bold mb-0" data-target="1500" data-separator="," data-duration="5">1500</h3>
                            <p class="mb-0 fs-6">Trades Made</p>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3 text-center">
                            <h3 class="fw-bold mb-0" id="lossCounter">$30000</h3>
                            <p class="mb-0 fs-6">Loss</p>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3 text-center">
                            <h3 class="fw-bold mb-0" data-target="75" data-duration="5" data-suffix="%">75%</h3>
                            <p class="mb-0 fs-6">Win Rate</p>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3 text-center">
                            <h3 class="fw-bold mb-0" data-target="150000" data-duration="5" data-separator="," data-prefix="$">$150000</h3>
                            <p class="mb-0 fs-6">Total Capital</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Decimal Values</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Use the fields below to enter a date. Please follow the specified format for each field:</p>

                    <div class="row g-5">
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="card card-body mb-0 bg-light bg-opacity-30 shadow-none border border-dashed">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="mb-1 fs-6">Total Sales</p>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <h3 class="fw-bold mb-0" data-target="60" data-duration="5" data-prefix="$" data-suffix="M" data-separator=",">$60.5</h3>
                                        </div>
                                    </div>
                                    <div class="h-48px w-48px bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-money-dollar-circle-line fs-24 fw-medium text-light-emphasis"></i>
                                    </div>
                                </div>
                            </div> <!-- end card -->
                        </div>

                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="card card-body mb-0 bg-light bg-opacity-30 shadow-none border border-dashed">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="mb-1 fs-6">Total Orders</p>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <h3 class="fw-bold mb-0" data-target="5340" data-duration="5">5,340</h3>
                                        </div>
                                    </div>
                                    <div class="h-48px w-48px bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-shopping-cart-line fs-24 fw-medium text-light-emphasis"></i>
                                    </div>
                                </div>
                            </div> <!-- end card -->
                        </div>

                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="card card-body mb-0 bg-light bg-opacity-30 shadow-none border border-dashed">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="mb-1 fs-6">New Customers</p>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <h3 class="fw-bold mb-0" data-target="1230" data-duration="5">1,230</h3>
                                        </div>
                                    </div>
                                    <div class="h-48px w-48px bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-user-add-line fs-24 fw-medium text-light-emphasis"></i>
                                    </div>
                                </div>
                            </div> <!-- end card -->
                        </div>

                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="card card-body mb-0 bg-light bg-opacity-30 shadow-none border border-dashed">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="mb-1 fs-6">Refunds Processed</p>
                                        <div class="d-flex align-items-center gap-1 mt-2">
                                            <h3 class="fw-bold mb-0" data-target="10.2" data-duration="5" data-decimal-places="2">$10.2</h3>
                                        </div>
                                    </div>
                                    <div class="h-48px w-48px bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-money-dollar-circle-line fs-24 fw-medium text-light-emphasis"></i>
                                    </div>
                                </div>
                            </div> <!-- end card -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- Countup init -->
    <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection