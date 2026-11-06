@extends('partials.layouts.master2')

    @section('title', 'Apex Scatter Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Scatter Chart' )
    @section('pagetitle', 'ApexChat')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="row g-4">

    <!-- Basic Scatter Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Scatter Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="basic_scatter_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Scatter – Datetime Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Scatter - Datetime Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="scatter_datetime_chart" class="apexcharts-scatter apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Scatter – Images Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Scatter - Images Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="scatter_images_chart" class="apexcharts-scatter apexcharts-container"></div>
        </div>
      </div>
    </div>

  </div>

@endsection

@section('js')

  <!-- ApexChat js -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- ApexChat Scatter init -->
  <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
  <script src="{{ asset('assets/js/charts/apexcharts-scatter.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
