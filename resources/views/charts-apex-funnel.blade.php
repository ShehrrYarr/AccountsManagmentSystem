@extends('partials.layouts.master2')

@section('title', 'Apex Funnel Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Funnel Charts')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')

    <div class="row g-4">

        <!-- Recruitment Funnel Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Recruitment Funnel Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="recruitment_funnel_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

        <!-- Pyramid Funnel Chart -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Pyramid Funnel Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="pyramid_funnel_chart" class="apexcharts-container apexcharts-white"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Funnel init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-funnel.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
