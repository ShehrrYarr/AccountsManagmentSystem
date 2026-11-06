@extends('partials.layouts.master-auth')

@section('title', 'Create Password | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
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

                <div class="col-lg-6 auth-banners">
                    <div class="bg-login card card-body m-0 h-100 border-0">
                        <img src="{{ asset('assets/images/auth/bg-img-2.png') }}" class="img-fluid auth-banner"
                            alt="auth-banner">
                        <div class="auth-contain">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="text-center text-white my-4 p-4">
                                            <h3 class="text-white">Learn and Practice</h3>
                                            <p class="mt-3">Manage your application seamlessly. Log in to access your
                                                dashboard and configure settings.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="text-center text-white my-4 p-4">
                                            <h3 class="text-white">Secure Your Data</h3>
                                            <p class="mt-3">Ensure your application remains secure. Utilize our tools to
                                                monitor and protect your data effectively.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="text-center text-white my-4 p-4">
                                            <h3 class="text-white">User Management</h3>
                                            <p class="mt-3">Easily manage users, roles, and permissions. Streamline your
                                                admin tasks with our intuitive interface.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="auth-box card card-body m-0 h-100 border-0 justify-content-center">
                        <div class="mb-5 text-center">
                            <h4 class="fw-medium">Create New Password</h4>
                            <p class="text-muted mb-0">Secure Your Account with a Strong Password</p>
                        </div>
                        <form class="form-custom mt-10">

                            <div class="mb-5">
                                <label class="form-label" for="LoginPassword">Password<span
                                        class="text-danger ms-1">*</span></label>
                                <div class="input-group">
                                    <input type="password" id="LoginPassword" class="form-control" name="password"
                                        placeholder="Enter your password" data-visible="false">
                                    <a class="input-group-text bg-transparent toggle-password" href="javascript:;"
                                        data-target="password">
                                        <i class="ri-eye-off-line text-muted toggle-icon"></i>
                                    </a>
                                </div>
                                <div class="d-flex align-items-center mb-3 mt-2">
                                    <div class="flex-grow-1 bg-light rounded h-4px me-2"></div>
                                    <div class="flex-grow-1 bg-light rounded h-4px me-2"></div>
                                    <div class="flex-grow-1 bg-light rounded h-4px me-2"></div>
                                    <div class="flex-grow-1 bg-light rounded h-4px"></div>
                                </div>
                                <span class="form-text">Use 8 or more characters with a mix of letters, numbers &
                                    symbols.</span>
                            </div>

                            <div class="mb-5">
                                <label class="form-label" for="confirmPassword">Confirm Password<span
                                        class="text-danger ms-1">*</span></label>
                                <div class="input-group">
                                    <input type="password" id="confirmPassword" class="form-control" name="password"
                                        placeholder="Confirm your password" data-visible="false">
                                    <a class="input-group-text bg-transparent toggle-password" href="javascript:;"
                                        data-target="password">
                                        <i class="ri-eye-off-line text-muted toggle-icon"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="form-check form-check-sm d-flex align-items-center gap-2 mb-5">
                                <input class="form-check-input" type="checkbox" value="remember-me" id="remember-me">
                                <label class="form-check-label" for="remember-me">
                                    Remember me
                                </label>
                            </div>

                            <a href="auth-signin">
                                <button type="button" class="btn btn-primary rounded-2 w-100 btn-loader">
                                    <span class="indicator-label">
                                        Reset Password
                                    </span>
                                    <span class="indicator-progress flex gap-2 justify-content-center w-100">
                                        <span>Please Wait...</span>
                                        <i class="ri-loader-2-fill"></i>
                                    </span>
                                </button>
                            </a>

                            <p class="mb-0 mt-10 text-muted text-center">
                                I Remember!, Let me try once...
                                <a href="auth-signin" class="text-primary fw-medium text-decoraton-underline ms-1">
                                    Sign In
                                </a>
                            </p>
                        </form>
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
