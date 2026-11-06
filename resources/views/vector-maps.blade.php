@extends('partials.layouts.master2')

    @section('title', 'Vector Maps | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Vector Maps' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jsvectormap/jsvectormap.min.css') }}">
    @endsection

    @section('content')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">World Map Markers</h5>
                </div>
                <div class="card-body">
                    <div id="world-map" class="min-h-320px"></div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">World Map With Marker Lines</h5>
                </div>
                <div class="card-body">
                    <div id="world-map-markers-line" class="min-h-320px"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Vector map-->
    <script src="{{ asset('assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world.js') }}"></script>
    <!-- vector-maps init -->
    <script src="{{ asset('assets/js/maps/vector-maps.init.js') }}"></script>
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
