@extends('partials.layouts.master2')

    @section('title', 'Apex Timeline Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Timeline Charts' )
    @section('pagetitle', 'ApexChat')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="row g-4">
    <!-- Basic TimeLine Charts -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Basic TimeLine Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="basic_timeLine_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Basic TimeLine Charts -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Distributed Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="distributed_chart" class="apexcharts-container apexcharts-white"></div>
        </div>
      </div>
    </div>

    <!-- Multi Series Charts -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Multi Series Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="multi_series_chart" class="apexcharts-container apexcharts-white"></div>
        </div>
      </div>
    </div>

    <!-- Advanced Timeline (Multiple Range) Charts -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Advanced Timeline (Multiple Range) Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="advanced_timeline_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Multiple series – Group rows Charts -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Multiple series - Group rows Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="multiple_series_group_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

    <!-- Dumbbell Chart (Horizontal) Charts -->
    <div class="col-12 col-lg-6">
      <div class="card h-100 mb-0">
        <div class="card-header">
          <h6 class="card-title mb-0 fw-semibold">Dumbbell Horizontal Chart</h6>
        </div>
        <div class="card-body px-0">
          <div id="dumbbell_horizontal_chart" class="apexcharts-container"></div>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('js')

  <!-- Moment js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

  <!-- ApexChat js -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- ApexChat Timeline init -->
  <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
  <script src="{{ asset('assets/js/charts/apexcharts-timeline.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection
