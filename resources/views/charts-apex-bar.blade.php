@extends('partials.layouts.master2')
@section('title', 'Apex Bar Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Bar Charts')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')


    <div class="row g-4">

        <!-- Basic Bar Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Basic Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div id="basic_bar_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Grouped Bar Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Grouped Bar Charts</h6>
                </div>
                <div class="card-body">
                    <div id="grouped_bar_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Stacked Bar Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Stacked Bar Charts</h6>
                </div>
                <div class="card-body">
                    <div id="stacked_bar_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Stacked Bars 100 Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Stacked Bars 100 Charts</h6>
                </div>
                <div class="card-body">
                    <div id="stacked_bar_100_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Grouped Stacked Bars Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Grouped Stacked Bars Charts</h6>
                </div>
                <div class="card-body">
                    <div id="grouped_stacked_bar_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Bar with Negative Values Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Bar with Negative Values Charts</h6>
                </div>
                <div class="card-body">
                    <div id="bar_with_negative_values_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Bar with Markers Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Bar with Markers Charts</h6>
                </div>
                <div class="card-body">
                    <div id="bar_with_markers_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Reversed Bar Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Reversed Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div id="reversed_bar_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Custom DataLabels Bar Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Custom DataLabels Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div id="custom_dataLabels_bar_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Patterned Bar Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Patterned Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div id="patterned_bar_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Bar with Images Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Bar with Images Chart</h6>
                </div>
                <div class="card-body">
                    <div id="images_bar_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Bar init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-bar.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
