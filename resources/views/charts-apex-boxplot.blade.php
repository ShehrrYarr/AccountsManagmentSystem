@extends('partials.layouts.master2')

@section('title', 'Apex Boxplot Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Boxplot Chart')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')


    <div class="row g-4">

        <!-- Basic Box Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Basic Box Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="basic_box_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- BoxPlot chart with outliers  -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">BoxPlot chart with outliers</h6>
                </div>
                <div class="card-body px-0">
                    <div id="boxPlot_with_outliers_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Horizontal BoxPlot with Outliers  -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Horizontal BoxPlot with Outliers</h6>
                </div>
                <div class="card-body px-0">
                    <div id="horizontal_with_outliers_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Boxplot init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-boxplot.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
