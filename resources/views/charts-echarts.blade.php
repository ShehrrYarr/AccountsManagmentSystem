@extends('partials.layouts.master2')

    @section('title', 'Echart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Echart' )
    @section('pagetitle', 'Chart')
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
          <div id="basicLineChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Stacked Line Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Stacked Line Chart</h6>
        </div>
        <div class="card-body">
          <div id="stackedLineChart" class="echart-wrapper"></div>
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
          <div id="stackedAreaChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Line Style and Item Style -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Line Style and Item Style</h6>
        </div>
        <div class="card-body">
          <div id="LineAndItemStyleChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Step Line Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Step Line Chart</h6>
        </div>
        <div class="card-body">
          <div id="stepLineChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Basic Bar Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Bar Chart</h6>
        </div>
        <div class="card-body">
          <div id="basicBarChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Bar Chart with Negative Value -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Bar Chart with Negative Value</h6>
        </div>
        <div class="card-body">
          <div id="barChartNegativeValue" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Horizontal Bar -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Horizontal Bar</h6>
        </div>
        <div class="card-body">
          <div id="horizontalBarChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Pie Charts -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Pie Charts</h6>
        </div>
        <div class="card-body">
          <div id="pieCharts" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Half Doughnut Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Half Doughnut Chart</h6>
        </div>
        <div class="card-body">
          <div id="halfDoughnutChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Basic Scatter Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Scatter Chart</h6>
        </div>
        <div class="card-body">
          <div id="basicScatterChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Candlestick Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Candlestick Chart</h6>
        </div>
        <div class="card-body">
          <div id="candlestickChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Radar Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Radar Chart</h6>
        </div>
        <div class="card-body">
          <div id="radarChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Basic Treemap -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Treemap</h6>
        </div>
        <div class="card-body">
          <div id="basicTreemapChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Basic Parallel -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Parallel</h6>
        </div>
        <div class="card-body">
          <div id="basicParallelChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Basic Sankey -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Sankey</h6>
        </div>
        <div class="card-body">
          <div id="basicSankeyChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Funnel Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Funnel Chart</h6>
        </div>
        <div class="card-body">
          <div id="funnelChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

    <!-- Simple Gauge -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Simple Gauge</h6>
        </div>
        <div class="card-body">
          <div id="simpleGaugeChart" class="echart-wrapper"></div>
        </div>
      </div>
    </div>

  </div>

@endsection

@section('js')

  <!-- Echart js -->
  <script src="{{ asset('assets/libs/echarts/echarts.min.js') }}"></script>

  <!-- Echart init -->
  <script src="{{ asset('assets/js/charts/echart-config.init.js') }}"></script>
  <script src="{{ asset('assets/js/charts/echart.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection
