@extends('partials.layouts.master2')

    @section('title', 'Grid JS Tables | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Table Grid Js' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
    @endsection
    @section('content')

    <div class="row g-4">

        <div class="col-12">
            <!--start::card-->
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Basic Table </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Basic Table</strong> example using Grid.js provides a simple and interactive table with sorting, searching, and pagination features. It can be easily customized with additional options.
                    </p>
                    <div id="gridjs_basic-table"></div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <!--start::card-->
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Table With Sorting </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Table With Sorting</strong> example using Grid.js allows users to sort table columns by clicking on the headers, making data organization easier and more efficient.
                        You can enable sorting using the config option: <code>sort: true</code>.
                    </p>
                    <div id="gridjs_sort-table"></div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <!--start::card-->
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Table With Pagination </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Table With Pagination</strong> example using Grid.js helps manage large datasets by displaying a limited number of rows per page.
                        You can enable pagination using the config option: <code>pagination: { limit: 10 }</code>.
                    </p>
                    <div id="gridjs_pagination-table"></div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <!--start::card-->
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Table With Search </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Table With Search</strong> example using Grid.js allows users to quickly find data by entering keywords.
                        Enable search using the config option: <code>search: true</code>.
                    </p>
                    <div id="gridjs_search-table"></div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <!--start::card-->
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Table Loading </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Table Loading</strong> example in Grid.js displays a loading state while fetching data.
                        Use the config option: <code>loading: true</code> to enable it.
                    </p>
                    <div id="gridjs_loading-table"></div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <!--start::card-->
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Fixed Header </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Fixed Header</strong> example in Grid.js keeps the table header visible while scrolling.
                        Use the config option: <code>fixedHeader: true</code> to enable it.
                    </p>
                    <div id="gridjs_fixed-header-table"></div>
                </div>
            </div>
            <!--end::card-->
        </div>

    </div>
@endsection

@section('js')

    <!-- Gridjs js -->
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}" type="text/javascript"></script>

    <!-- Gridjs init -->
    <script src="{{ asset('assets/js/table/gridjs.init.js') }}" type="text/javascript"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
