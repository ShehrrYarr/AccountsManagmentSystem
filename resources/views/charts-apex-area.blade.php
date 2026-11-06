@extends('partials.layouts.master2')

@section('title', 'Area Charts | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Area Charts')
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
                    <div id="area_chart_basic" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Spline Area Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Spline Area Chart</h6>
                </div>
                <div class="card-body">
                    <div id="spline_area_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Datetime X-Axis Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Datetime X-Axis</h6>
                </div>
                <div class="card-body">
                    <div>
                        <div class="toolbar d-flex align-items-start justify-content-center flex-wrap gap-2">
                            <button type="button" class="btn btn-light-primary btn-sm" id="one_month">
                                1M
                            </button>
                            <button type="button" class="btn btn-light-primary btn-sm" id="six_months">
                                6M
                            </button>
                            <button type="button" class="btn btn-light-primary btn-sm active" id="one_year">
                                1Y
                            </button>
                            <button type="button" class="btn btn-light-primary btn-sm" id="ytd">
                                YTD
                            </button>
                            <button type="button" class="btn btn-light-primary btn-sm" id="all">
                                ALL
                            </button>
                        </div>
                        <div id="datetime_x_axis_chart" class="apexcharts-container apexcharts-white"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area with Negative Values -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Area with Negative Values Chart</h6>
                </div>
                <div class="card-body">
                    <div id="area_with_negative_values" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Github Style -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Github Style</h6>
                </div>
                <div class="card-body">
                    <!-- GitHub Style Chart -->
                    <div id="github_style" class="apexcharts-container bg-light bg-opacity-30"></div>
                    <div class="github-style d-flex align-items-center my-2">
                        <div class="flex-shrink-0 me-2">
                            <img class="avatar rounded" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}">
                        </div>
                        <div class="flex-grow-1">
                            <a class="text-primary fw-medium">Coder</a>
                            <div class="cmeta text-muted fs-12">
                                <span class="commits text-body-emphasis fw-medium fs-14">95</span> commits
                            </div>
                        </div>
                    </div>
                    <!-- Chart for Yearly Range -->
                    <div id="github_chart_years" class="apexcharts-container bg-light bg-opacity-30"></div>
                </div>
            </div>
        </div>

        <!-- Stacked Area Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Stacked Area Chart</h6>
                </div>
                <div class="card-body">
                    <div id="stacked_area_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Irregular Timeseries Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Irregular Timeseries Chart</h6>
                </div>
                <div class="card-body">
                    <div id="irregular_timeseries_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Missing / Null values Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Missing / Null values Chart</h6>
                </div>
                <div class="card-body">
                    <div id="missing_null_values_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <script src="https://apexcharts.com/samples/assets/github-data.js"></script>
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Area init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-area.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
