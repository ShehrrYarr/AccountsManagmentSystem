@extends('partials.layouts.master2')

@section('title', 'Apex Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Line Charts')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')

    <div class="row g-4">

        <!-- Basic Line Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Basic Line Chart</h6>
                </div>
                <div class="card-body">
                    <div id="basic_line_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Line Chart With Data Labels -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Line Chart With Data Labels</h6>
                </div>
                <div class="card-body">
                    <div id="line_chart_with_data_labels" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Zoomable Time Series -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Zoomable Time Series</h6>
                </div>
                <div class="card-body">
                    <div id="zoomable_time_series" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Dashed Line Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Dashed Line</h6>
                </div>
                <div class="card-body">
                    <div id="dash-line-chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Line with Annotations Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Line with Annotations</h6>
                </div>
                <div class="card-body">
                    <div id="line-with-annotations-chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Brush Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Brush Chart</h6>
                </div>
                <div class="card-body">
                    <div id="chart-line2" class="apexcharts-container"></div>
                    <div id="chart-line" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Stepline Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Stepline Charts</h6>
                </div>
                <div class="card-body">
                    <div id="stepline-chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Gradient Line Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Gradient Line Chart</h6>
                </div>
                <div class="card-body">
                    <div id="gradient-line-chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Line init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-line.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
