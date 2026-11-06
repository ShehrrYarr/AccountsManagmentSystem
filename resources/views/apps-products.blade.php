@extends('partials.layouts.master2')

@section('title',
    'Products List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Products')
@section('pagetitle', 'Ecommerce')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
@endsection
@section('content')

    <div class="row g-4">
        <div class="col-12 col-lg-3 col-xxl-2 product-sidebar">
            <div class="card mb-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Filters</h5>
                    </div>
                </div>
                <div class="card-body px-0 py-3">
                    @include('partials.product-filter')

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9 col-xxl-10">
            @include('partials.product-card-list')


        </div>
    </div>

@endsection

@section('js')

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
