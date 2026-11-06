@extends('partials.layouts.master2')

    @section('title', 'UI Spinner | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Spinner' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Colors Spinner</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">The border spinner uses <code>currentColor</code> for its <code>border-color</code>, meaning you can customize the color with <a href="https://getbootstrap.com/docs/5.3/utilities/colors/">text color utilities</a>. You can use any of our text color utilities on the standard spinner.</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-border text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-border text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-border text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-border text-body-emphasis" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Growing spinner </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">If you don’t fancy a border spinner, switch to the grow spinner. While it doesn’t technically spin, it does repeatedly grow!</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-body-emphasis" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Button spinner </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use spinners within buttons to indicate an action is currently processing or taking place. </p>

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-primary icon-btn" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span class="visually-hidden" role="status">Loading...</span>
                            </button>
                            <button class="btn btn-primary text-primary bg-primary-subtle" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span class="ms-1" role="status">Loading...</span>
                            </button>
                        </div>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-danger icon-btn" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span class="visually-hidden" role="status">Loading...</span>
                            </button>
                            <button class="btn btn-danger text-danger bg-danger-subtle" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span class="ms-1" role="status">Loading...</span>
                            </button>
                        </div>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <button class="btn btn-success icon-btn" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span class="visually-hidden" role="status">Loading...</span>
                            </button>
                            <button class="btn btn-success text-success bg-success-subtle" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span class="ms-1" role="status">Loading...</span>
                            </button>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Spinner Sizes </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use spinners within buttons to indicate an action is currently processing or taking place. </p>

                    <div class="d-flex flex-wrap align-items-center gap-5">
                        <div class="d-flex flex-wrap align-items-center gap-5">
                            <div class="spinner-border h-48px w-48px" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-grow h-48px w-48px" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center gap-5 ps-5">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-grow spinner-grow-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

    </div>

@endsection
@section('js')

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
