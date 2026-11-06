@extends('partials.layouts.master-auth')

@section('title', 'Auth 401 | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')

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
                    <div class="auth-box card card-body m-0 h-100 border-0 justify-content-center">
                        <div class="mb-5 text-center">
                            <h4 class="fw-normal">Welcome to <span class="fw-bold text-primary">Herozi</span></h4>
                            <p class="text-muted mb-0">You need to log in to access this page. Please sign in and try again.
                            </p>
                        </div>
                        <img class="max-h-320px mx-auto" src="{{ asset('assets/images/vector/401.svg') }}" alt="401">
                        <div class="mt-4 mt-md-16 text-center">
                            <h1 class="fw-semibold fs-45"><span class="fw-bold text-primary">Oops, </span>you're not
                                authorized!</h1>
                            <p class="text-muted fs-16 mb-8">It seems like you don't have permission to view this page.
                                Please log in to continue.</p>
                            <a href="auth-signin" class="btn btn-primary rounded-pill w-max mx-auto">
                                <i class="ri-login-box-line me-1"></i>
                                Login Now
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- coming-soon init -->
    <script src="{{ asset('assets/js/pages/coming-soon.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
