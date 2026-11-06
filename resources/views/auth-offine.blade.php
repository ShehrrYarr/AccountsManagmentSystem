@extends('partials.layouts.master-auth')

@section('title', 'Auth offline | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')

@section('css')
    @include('partials.head-css', ['auth' => 'layout-auth'])
@endsection

@section('content')
    <div class="account-pages">
        <img src="{{ asset('assets/images/auth/auth_bg.jpeg') }}" alt="auth_bg" class="auth-bg light">
        <img src="{{ asset('assets/images/auth/auth_bg_dark.jpg') }}" alt="auth_bg_dark" class="auth-bg dark">
        <div class="container">
            <div class="justify-content-center row gy-0">

                <div class="col-lg-8">
                    <div class="auth-box card card-body m-0 h-100 border-0 justify-content-center">
                        <div class="mb-5 text-center">
                            <h4 class="fw-normal">We're Currently <span class="fw-bold text-primary">Offline</span></h4>
                            <p class="text-muted mb-0">Our site is temporarily unavailable while we perform some
                                maintenance. We'll be back shortly. Thank you for your patience!</p>
                        </div>
                        <img class="max-h-320px mx-auto" src="{{ asset('assets/images/vector/offline.svg') }}"
                            alt="offline">
                        <form class="form-custom mt-10">
                            <div id="countdown" class="mt-4">
                                <ul class="list-inline text-center d-flex flex-column flex-md-row gap-1">
                                    <li class="list-inline-item px-4 w-100 min-w-100px py-4 rounded-2">
                                        <h3 class="mb-1" id="days"></h3>
                                        <span>days</span>
                                    </li>
                                    <li class="list-inline-item px-4 w-100 min-w-100px py-4 rounded-2">
                                        <h3 class="mb-1" id="hours"></h3>
                                        <span>hours</span>
                                    </li>
                                    <li class="list-inline-item px-4 w-100 min-w-100px py-4 rounded-2">
                                        <h3 class="mb-1" id="minutes"></h3>
                                        <span>minutes</span>
                                    </li>
                                    <li class="list-inline-item px-4 w-100 min-w-100px py-4 rounded-2">
                                        <h3 class="mb-1" id="seconds"></h3>
                                        <span>seconds</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative subscribe-btn mt-10 max-w-500px mx-auto">
                                <input type="email"
                                    class="form-control form-control-lg fs-14 min-h-56px form-control-icon rounded-pill"
                                    id="companyNameLayout4" placeholder="Enter Your Email to Get Notified" required>
                                <button class="btn btn-primary rounded-pill position-absolute">Notify Me</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('auth')
    <!-- coming-soon init -->
    <script src="{{ asset('assets/js/pages/coming-soon.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
