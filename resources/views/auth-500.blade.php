@extends('partials.layouts.master-auth')

@section('title', 'Auth 500 | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')


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
                            <h4 class="fw-normal">Whoops! Something went wrong at <span class="fw-bold text-primary">Herozi
                                    Admin</span></h4>
                            <p class="text-muted mb-0">Our team is currently investigating the issue. Please bear with us
                                while we resolve it. We'll notify you as soon as it's fixed!</p>
                        </div>
                        <img class="max-h-320px mx-auto" src="{{ asset('assets/images/vector/500.svg') }}" alt="500">
                        <div class="mt-4 mt-md-16 text-center">
                            <h1 class="fw-semibold fs-45"><span class="fw-bold text-primary">Uh-oh, </span>looks like
                                something broke!</h1>
                            <p class="text-muted fs-16 mb-8">We encountered an unexpected error. Rest assured, our team is
                                already working on a fix. Please try again later.</p>
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
