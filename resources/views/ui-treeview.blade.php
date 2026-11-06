@extends('partials.layouts.master2')

    @section('title', 'Tree View | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Tree View' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/shepherd.js/css/shepherd.css') }}">
    @endsection

    @section('content')


    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Example</h5>
                </div>
                <div class="card-body">
                    <div id="tree-container-2" class="tree"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Close</h5>
                </div>
                <div class="card-body">
                    <div id="tree-container-3" class="tree"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Custom Icons and Colors</h5>
                </div>
                <div class="card-body">
                    <div id="tree-container-1" class="tree"></div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <!-- JsTree init -->
    <script src="{{ asset('assets/js/plugins/jstree.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection