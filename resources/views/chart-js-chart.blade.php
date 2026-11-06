@extends('partials.layouts.master2')

@section('title', 'Apex Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Chart Js')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')

    <div class="row">

        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Basic line Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="eCommerceChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Bar Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="barChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">horizontal Bar Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="horizontalBarChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Polar Area Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="polarChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Pie Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="myPieChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Stacked Bar & Line Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="stackedLineChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Radar Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="radarChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Line Area Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="lineAreaChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <!--start::card-->
            <div class="card card-h-100">

                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Doughnut Chart</h6>
                </div>
                <div class="card-body">

                    <canvas class="chartjs" id="doughnutChart"></canvas>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

    </div>

@endsection

@section('js')

    <!-- Chart js -->
    <script src="{{ asset('assets/libs/chart.js/chart.umd.js') }}"></script>

    <!-- Chart init -->
    <script src="{{ asset('assets/js/charts/chartjs.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
