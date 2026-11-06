@extends('partials.layouts.master2')

    @section('title', 'Apex Slope Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Slope Chart' )
    @section('pagetitle', 'ApexChat')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="row g-4">

    <!-- Basic Slope Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Slope Chart</h6>
        </div>
        <div class="card-body">
          <div id="basic_slope_chart" class="apexcharts-container apexcharts-white"></div>
        </div>
      </div>
    </div>

    <!-- Multi group Slope Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Multi group Slope Chart</h6>
        </div>
        <div class="card-body">
          <div id="multi_group_slope_chart" class="apexcharts-container apexcharts-white"></div>
        </div>
      </div>
    </div>

  </div>

@endsection

@section('js')

  <!-- ApexChat js -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- ApexChat Slope init -->
  <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
  <script src="{{ asset('assets/js/charts/apexcharts-slope.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
