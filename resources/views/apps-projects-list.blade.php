@extends('partials.layouts.master')

@section('title', 'Project List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')

@section('sub-title', 'Project List')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'Add Project')
@section('link', 'apps-projects-create')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
@endsection

@section('content')

    <div class="card mb-0">
        <table class="dt-project-list table-nowrap align-middle table w-100">
            <thead class="bg-light bg-opacity-30">
                <tr>
                    <th></th>
                    <th>Project Name</th>
                    <th>Leader</th>
                    <th>Team</th>
                    <th class="text-truncate">Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Completion</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('js')

    <!-- Datatable js -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- Product List init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-projects-list.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
