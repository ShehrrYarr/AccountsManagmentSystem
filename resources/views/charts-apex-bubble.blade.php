@extends('partials.layouts.master2')
@section('title', 'Apex Bubble Chart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Bubble Chart')
@section('pagetitle', 'ApexChat')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('content')


    <div class="row g-4">

        <!-- Basic Bubble Chart -->
        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">Basic Bubble Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="basic_bubble_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

        <!-- 3D Bubble Chart -->
        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0 fw-semibold">3D Bubble Chart</h6>
                </div>
                <div class="card-body px-0">
                    <div id="d3_bubble_chart" class="apexcharts-container"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- ApexChat Bubble init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-bubble.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
