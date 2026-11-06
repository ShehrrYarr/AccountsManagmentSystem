@extends('partials.layouts.master2')

@section('title', 'Apex Mixed Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Mixed Charts')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')


    <div class="row g-4">

        <!-- Line Column Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Line Column Chart</h6>
                </div>
                <div class="card-body">
                    <div id="line_column_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Multiple Y-Axis Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Multiple Y-Axis Chart</h6>
                </div>
                <div class="card-body">
                    <div id="multiple_y_axis_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Line & Area Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Line & Area Chart</h6>
                </div>
                <div class="card-body">
                    <div id="line_axis_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Line Column Area Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Line Column Area Chart</h6>
                </div>
                <div class="card-body">
                    <div id="line_column_area_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Line Scatter Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Line Scatter Chart</h6>
                </div>
                <div class="card-body">
                    <div id="line_scatter_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Mixed init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-mixed.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
