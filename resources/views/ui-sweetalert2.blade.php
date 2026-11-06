@extends('partials.layouts.master2')

    @section('title', 'UI Sweetalert | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Sweetalert' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

    <div class="row">

        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle table-hover table-borderless mb-0">
                            <thead class="bg-light bg-opacity-30">
                                <tr>
                                    <th class="p-4">Examples</th>
                                    <th class="p-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-4">Show a basic message</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="basicMessage">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Display a title with a description</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="titleText">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Show an error message with a title and footer</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="errorType">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Use custom HTML with descriptive buttons</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="customHtml">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Display a dialog with three options</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="threeButtons">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Show a dialog in a custom position</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="customPosition">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Confirm action with a warning message</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="warningConfirm">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Execute different actions based on cancellation</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="handleDismiss">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Display a message with a custom image</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="customImage">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Show a message with custom dimensions and styling</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="customWidth">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Auto-close message after a few seconds</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="timer">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Support for right-to-left languages</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="rtl">Click Me</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4">Example of an AJAX request</td>
                                    <td class="p-4 w-200px text-center">
                                        <button class="btn btn-primary btn-sm" data-alert="ajaxRequest">Click Me</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Trigger Toast </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center gap-4 justify-content-center">
                        <button class="btn btn-success" data-alert="showSuccessToast">Show Success Toast</button>
                        <button class="btn btn-danger" data-alert="showErrorToast">Show Error Toast</button>
                        <button class="btn btn-warning" data-alert="showWarningToast">Show Warning Toast</button>
                        <button class="btn btn-info" data-alert="showInfoToast">Show Info Toast</button>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

    </div>

@endsection

@section('js')

    <!-- Sweet alert init-->
    <script src="{{ asset('assets/js/plugins/sweetalert.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
