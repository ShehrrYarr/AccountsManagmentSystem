@extends('partials.layouts.master2')

    @section('title', 'Tour | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Tour' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/shepherd.js/css/shepherd.css') }}">
    @endsection

    @section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Shepherdjs Admin Dashboard</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted mb-4">Use this tour to guide users through the dashboard and its features.</p>
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="text-center mt-4 mb-5">
                                    <div class="py-3 px-2 d-inline-block" id="logo-tour">
                                        <img src="{{ asset('assets/images/light-logo.png') }}">" class="card-logo card-logo-dark" alt="logo" height="17">
                                    </div>
                                    <h5 class="fs-16">Responsive Admin Dashboard Template</h5>
                                    <p class="text-muted">Vestibulum auctor tincidunt semper. Phasellus ut vulputate lacus. Suspendisse ultricies mi eros, sit amet tempor nulla varius sed dapibus in tellus.</p>
                                    <div class="hstack gap-2 justify-content-center">
                                        <button type="button" class="btn btn-primary btn-sm">View more</button>
                                        <button type="button" class="btn btn-success btn-sm">Email us</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-xxl-9 col-lg-10 col-sm-8">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card border shadow-none">
                                            <div class="card-body text-center">
                                                <div class="avatar mx-auto avatar-item bg-light rounded-circle text-primary fs-24 mb-4" id="register-tour">
                                                    <i class="ri-edit-box-line"></i>
                                                </div>
                                                <h5>Free Register</h5>
                                                <p class="text-muted mb-0">Get your Free Herozi account now.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card border shadow-none">
                                            <div class="card-body text-center">
                                                <div class="avatar mx-auto avatar-item bg-light rounded-circle text-primary fs-24 mb-4" id="login-tour">
                                                    <i class="ri-user-shared-line"></i>
                                                </div>
                                                <h5>Log in Account</h5>
                                                <p class="text-muted mb-0">Sign in to continue to Herozi.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card border shadow-none">
                                            <div class="card-body text-center">
                                                <div class="avatar mx-auto avatar-item bg-light rounded-circle text-primary fs-24 mb-4" id="getproduct-tour">
                                                    <i class="ri-file-download-line"></i>
                                                </div>
                                                <h5>Get Product</h5>
                                                <p class="text-muted mb-0">Get the product after signing in.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center my-4">
                            <button class="btn btn-success" id="thankyou-tour">Thank you!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- shepherd js -->
    <script type="module" src="{{ asset('assets/libs/shepherd.js/esm/shepherd.mjs') }}"></script>

    <!-- Tour init -->
    <script type="module" src="{{ asset('assets/js/plugins/tour.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
