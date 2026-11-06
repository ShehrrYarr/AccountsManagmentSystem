@extends('partials.layouts.master2')

    @section('title', 'Apex Radialbar Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Radialbar Chart' )
    @section('pagetitle', 'ApexChat')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="row g-4">

    <!-- Basic Radialbar Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Radialbar Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="basic_radialbar_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Multiple Radialbar Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Multiple Radialbar Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="multiple_radialbar_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Custom Angle Circle Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Custom Angle Circle Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="custom_angle_circle_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Gradient Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Gradient Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="gradient_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Radialbars with Image Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Radialbars with Image</h6>
        </div>
        <div class="card-body px-0">
          <div id="radialbars_with_image_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Stroked Gauge Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Stroked Gauge Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="stroked_gauge_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Semi Circle Gauge Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Semi Circle Gauge Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="semi_circle_gauge_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('js')

  <!-- ApexChat js -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- ApexChat Radialbar init -->
  <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
  <script src="{{ asset('assets/js/charts/apexcharts-radialbar.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection
