@extends('partials.layouts.master2')

    @section('title', 'Apex Range Area Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Range Area Charts' )
    @section('pagetitle', 'ApexChat')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="row g-4">

    <!-- Basic Range Area Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic Range Area Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="basic_range_area_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Scatter - Datetime Chart -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Range Area with Forecast Line (Combo)</h6>
        </div>
        <div class="card-body px-0">
          <div id="scatter_datetime_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('js')

  <!-- ApexChat js -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- ApexChat Range Area init -->
  <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
  <script src="{{ asset('assets/js/charts/apexcharts-range-area.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
