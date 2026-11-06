@extends('partials.layouts.master2')

@section('title', 'Apex Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Line Charts')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')

    <div class="row g-4">
        <!-- Basic Column Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Basic Column Charts</h6>
                </div>
                <div class="card-body">
                    <div id="basic_column_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Column with Data Labels Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Column with Data Labels</h6>
                </div>
                <div class="card-body">
                    <div id="column_with_data_labels" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Stacked Columns Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Stacked Columns</h6>
                </div>
                <div class="card-body">
                    <div id="stacked_columns_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Stacked Columns 100 Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Stacked Columns 100</h6>
                </div>
                <div class="card-body">
                    <div id="stacked_columns_100_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Grouped Stacked Columns Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Grouped Stacked Columns</h6>
                </div>
                <div class="card-body">
                    <div id="grouped_stacked_columns_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Dumbbell Chart Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Dumbbell Chart</h6>
                </div>
                <div class="card-body">
                    <div id="dumbbell_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Column with Markers Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Column with Markers</h6>
                </div>
                <div class="card-body">
                    <div id="column_with_markers_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Column with Group Label Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Grouped Labels on the X-axis</h6>
                </div>
                <div class="card-body">
                    <div id="column_with_group_label_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Column with Rotated Labels Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Column with Rotated Labels</h6>
                </div>
                <div class="card-body">
                    <div id="column_with_rotated_labels_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Column with Negative Values Charts -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Column with Negative Values</h6>
                </div>
                <div class="card-body">
                    <div id="column_with_negative_values_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Day js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.13/dayjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.13/plugin/quarterOfYear.min.js"></script>

    <!-- ApexChat Column init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-column.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
