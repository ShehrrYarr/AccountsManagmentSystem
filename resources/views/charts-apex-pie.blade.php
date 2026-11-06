@extends('partials.layouts.master2')

@section('title', 'Apex Pie Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Pie Chart')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')

    <div class="row g-4">

        <!-- Simple Pie Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Simple Pie Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="simple_pie_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Simple Donut Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Simple Donut Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="simple_donut_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Simple Donut Update Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Simple Donut Update Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="simple_donut_update_chart" class="apexcharts-container apexcharts-white"></div>
                    <div class="d-flex align-items-start flex-wrap gap-2 justify-content-center mt-4">
                        <button id="add" class="btn btn-light btn-sm"> + ADD</button>
                        <button id="remove" class="btn btn-light btn-sm">- REMOVE</button>
                        <button id="randomize" class="btn btn-light btn-sm">RANDOMIZE</button>
                        <button id="reset" class="btn btn-light btn-sm">RESET</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monochrome Pie Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Monochrome Pie Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="monochrome_pie_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Gradient Donut Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Gradient Donut Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="gradient_donut_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Semi Donut Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Semi Donut Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="semi_donut_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Donut with Pattern Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Donut with Pattern Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="donut_with_pattern_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Pie with Image Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Pie with Image Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="pie_with_image_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Pie init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-pie.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
