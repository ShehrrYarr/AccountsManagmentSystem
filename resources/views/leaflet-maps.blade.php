@extends('partials.layouts.master2')

    @section('title', 'Leaflet Maps | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Leaflet Maps' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  
    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/leaflet/leaflet.css') }}">
    @endsection

    @section('content')
 
    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Leaflet Map</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="leaflet_map"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Map With Markers,circles and Polygons</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="leaflet_map_markers"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Map With Popup</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="leaflet_map_popup"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Map With Custom Icons</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="leaflet_map_custom_icon"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card mb-0 h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Map With Custom pane</h5>
                </div>
                <div class="card-body">
                    <div class="w-100 min-h-320px" id="leaflet_map_custom_pane"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <!-- leaflet-map js -->
    <script src="{{ asset('assets/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('assets/libs/leaflet/leaflet.js.map') }}"></script>

    <!-- leaflet-map init -->
    <script src="{{ asset('assets/js/maps/leaflet-map.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

    @endsection
