@extends('partials.layouts.master2')

    @section('title', 'Google Maps | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Google Maps' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  
    @section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jsvectormap/jsvectormap.min.css') }}">
    @endsection
    
    @section('content')

    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Map</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="basic_gmap"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Map With Marker</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="gmap_with_marker"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Map With Overlays</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="gmap_with_overlays"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Map Type</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="gmap_map_type"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <!-- google maps api -->
    <script src="http://maps.google.com/maps/api/js"></script>

    <!-- Google Map js -->
    <script src="{{ asset('assets/libs/gmaps/gmaps.min.js') }}"></script>

    <!-- Google Map init -->
    <script src="{{ asset('assets/js/maps/google-map.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

    @endsection
