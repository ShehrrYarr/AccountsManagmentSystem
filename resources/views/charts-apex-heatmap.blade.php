@extends('partials.layouts.master2')

@section('title', 'Apex Heatmap Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Heatmap Chart')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')


    <div class="row g-4">

        <!-- Basic Heatmap Chart -->
        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Basic Heatmap Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="basic_heatmap_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Multiple Colors Chart -->
        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Multiple Colors Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="multiple_colors_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Multiple Colors Flipped Chart -->
        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Multiple Colors Flipped Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="multiple_colors_flipped_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Color Range Chart -->
        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Color Range Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="color_range_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!--  Range Without Shades Chart -->
        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Range Without Shades Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="range_without_shades_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Heatmap init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-heatmap.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
