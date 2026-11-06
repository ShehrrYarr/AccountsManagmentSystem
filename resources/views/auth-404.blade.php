@extends('partials.layouts.master-auth')

@section('title', 'Auth 404 | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')


@section('css')
    @include('partials.head-css', ['auth' => 'layout-auth'])
@endsection

@section('content')

    <!-- START -->
    <div class="account-pages">
        <img src="{{ asset('assets/images/auth/auth_bg.jpeg') }}" alt="auth_bg" class="auth-bg light">
        <img src="{{ asset('assets/images/auth/auth_bg_dark.jpg') }}" alt="auth_bg_dark" class="auth-bg dark">
        <div class="container">
            <div class="justify-content-center row gy-0">

                <div class="col-lg-8">
                    <div class="auth-box card card-body m-0 h-100 border-0 justify-content-center text-center">
                        <img class="max-h-320px mx-auto" src="{{ asset('assets/images/vector/coming-soon.svg') }}"
                            alt="coming-soon">
                        <div class="mt-10">
                            <h4
                                class="text-uppercase fw-semibold pt-5 mb-1 d-flex align-items-center justify-content-center gap-2">
                                Page Not Found <span class="fs-14">🚫</span></h4>
                            <p class="text-muted mb-8">Unfortunately, the page you're seeking is missing!</p>
                            <a href="index" class="btn btn-primary rounded-pill w-max mx-auto">
                                <i class="ri-home-2-line me-1"></i>
                                Go Back Home
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
