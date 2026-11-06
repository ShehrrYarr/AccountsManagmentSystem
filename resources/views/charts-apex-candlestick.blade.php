@extends('partials.layouts.master2')

@section('title', 'Apex Candlestick Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Candlestick Chart')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')
    <div class="row g-4">
        <!-- Basic Candlestick Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Basic Candlestick Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="basic_candlestick_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- Candlestick Synced with Brush Chart (Combo) -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Candlestick Synced with Brush Chart (Combo)</h6>
                </div>
                <div class="card-body px-0">
                    <div id="candlestick_with_brush_chart" class="apexcharts-container"></div>
                    <div id="combo_candlestick_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- CandleStick Chart - Category X-axis -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">CandleStick Chart - Category X-axis</h6>
                </div>
                <div class="card-body px-0">
                    <div id="candleStick_category_X_axis_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Candlestick with line -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Candlestick with line</h6>
                </div>
                <div class="card-body px-0">
                    <div id="candlestick_with_line_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>

    <!-- Day js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.13/dayjs.min.js"></script>

    <!-- ApexChat Candlestick init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-candlestick.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
