@extends('partials.layouts.master2')

    @section('title', 'UI Separator | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Separator' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

    <div class="row g-4">

        <div class="col-12 col-md-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Basic Horizontal Row </h5>
                </div>
                <div class="card-body">
                    <div class="py-5">
                        Some text goes here
                        <hr class="my-10">
                        Other text goes here
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Horizontal Row Styles </h5>
                </div>
                <div class="card-body">
                    <hr class="mb-10 border-danger border-dashed">
                    <hr class="mt-10 border-primary border-dashed">
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Horizontal Row Colors </h5>
                </div>
                <div class="card-body">
                    <hr class="mb-10">
                    <hr class="my-10 border-primary">
                    <hr class="my-10 border-secondary">
                    <hr class="my-10 border-success">
                    <hr class="mt-10 border-info">
                    <hr class="mt-10 border-warning">
                    <hr class="mt-10 border-danger">
                    <hr class="mt-10 border-dark">
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Horizontal Row Sizes </h5>
                </div>
                <div class="card-body">
                    <hr class="mb-10">
                    <hr class="my-10 border-2">
                    <hr class="my-10 border-3">
                    <hr class="my-10 border-4">
                    <hr class="mt-10 border-5">
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Horizontal Row Content </h5>
                </div>
                <div class="card-body">
                    <div class="center-hr my-10">Herozi</div>
                    <div class="center-hr mb-10"><span class="h1 m-0">Herozi</span></div>
                    <div class="center-hr mb-10 border-primary border-dashed"><span class="min-w-256px fw-bold">Long separator title label</span></div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Basic Vertical Row </h5>
                </div>
                <div class="card-body">

                    <div class="d-flex align-items-center gap-5">
                        <div class="d-flex align-items-center">
                            <span class="mx-3">Left Content</span>
                            <div class="vr border-solid"></div>
                            <span class="mx-3">Right Content</span>
                        </div>

                        <div class="ms-auto d-flex align-items-center">
                            <div class="vr border-solid"></div>
                            <span class="mx-3">Right Content</span>
                        </div>
                    </div>


                </div>
            </div>
            <!--end::card-->
        </div>


    </div>

@endsection

@section('js')

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
