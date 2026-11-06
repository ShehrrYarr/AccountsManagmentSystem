@extends('partials.layouts.master2')

    @section('title', 'Apex Treemap Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Treemap Chart' )
    @section('pagetitle', 'ApexChat')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="row g-4">

    <!-- Basic Heatmap Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Treemap Chart</h6>
        </div>
        <div class="card-body">
          <div id="basic_treemap_chart" class="apexcharts-container apexcharts-white"></div>
        </div>
      </div>
    </div>

    <!-- Treemap Multiple Series Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Treemap Multiple Series Chart</h6>
        </div>
        <div class="card-body">
          <div id="treemap_Multiple_Series_chart" class="apexcharts-container apexcharts-white"></div>
        </div>
      </div>
    </div>

    <!-- Treemap with Color scale Chart -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Treemap with Color scale Chart</h6>
        </div>
        <div class="card-body">
          <div id="treemap_with_color_scale_chart" class="apexcharts-container apexcharts-white"></div>
        </div>
      </div>
    </div>

    <!-- Distibuted Treemap (different color for each cell) -->
    <div class="col-12 col-lg-6 col-xxl-4">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Distibuted Treemap (different color for each cell)</h6>
        </div>
        <div class="card-body">
          <div id="distibuted_treemap_chart" class="apexcharts-container apexcharts-white"></div>
        </div>
      </div>
    </div>

  </div>

@endsection

@section('js')
  <!-- ApexChat js -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- ApexChat Treemap init -->
  <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
  <script src="{{ asset('assets/js/charts/apexcharts-treemap.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection

