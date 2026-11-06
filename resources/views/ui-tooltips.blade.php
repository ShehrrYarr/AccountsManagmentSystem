@extends('partials.layouts.master2')

    @section('title', 'UI Tooltip | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Tooltip' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')


    <div class="row g-4">

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Tooltip Directions </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Tooltip example are available with follwing options, Directions are mirrored when using Bootstrap in RTL.</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Tooltip on top
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="right" data-bs-title="Tooltip on right">
                            Tooltip on right
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="bottom" data-bs-title="Tooltip on bottom">
                            Tooltip on bottom
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="left" data-bs-title="Tooltip on left">
                            Tooltip on left
                        </button>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Tooltip with HTML</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">When you hover over the button labeled "Tooltip with HTML," a tooltip will appear displaying formatted text. The tooltip's content includes HTML elements such as <code><em>italic</em>, <u>underlined</u>, and <b>bold</b></code> text. The <code>`data-bs-html="true"`</code> attribute allows the tooltip to render HTML tags correctly.</p>

                    <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-html="true" title="<em>Tooltip</em> <u>with</u> <b>HTML</b>">
                        Tooltip with HTML
                    </button>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Tooltips on links </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-0">This is sample text intended to showcase some
                        <a href="#!" data-bs-toggle="tooltip" data-bs-title="Tooltip for inline links">inline links</a>
                        with tooltips. Currently, it serves as placeholder content—essentially filler—meant to illustrate how
                        <a href="#!" data-bs-toggle="tooltip" data-bs-title="Tooltip for real text">real text</a>
                        might be represented. By viewing this example, you should get a clear idea of how
                        <a href="#!" data-bs-toggle="tooltip" data-bs-title="Tooltip for tooltips on links">tooltips on links</a>
                        function in practice. This will help you understand how they can be effectively used on
                        <a href="#!" data-bs-toggle="tooltip" data-bs-title="Tooltip for your own site">your own</a>
                        site or project.
                    </p>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Colored Tooltips </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use the <code> data-bs-custom-class="tooltip-*" </code> attribute to apply a custom tooltip style with a primary color theme. This allows you to customize the appearance of the tooltip, giving it a distinct look that matches the primary color scheme of your application.</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" class="btn btn-primary" data-bs-custom-class="tooltip-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Primary Tooltip
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-custom-class="tooltip-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Secondary Tooltip
                        </button>
                        <button type="button" class="btn btn-success" data-bs-custom-class="tooltip-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Success Tooltip
                        </button>
                        <button type="button" class="btn btn-info" data-bs-custom-class="tooltip-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Info Tooltip
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-custom-class="tooltip-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Warning Tooltip
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-custom-class="tooltip-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Danger Tooltip
                        </button>
                        <button type="button" class="btn btn-light" data-bs-custom-class="tooltip-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Light Tooltip
                        </button>
                        <button type="button" class="btn btn-dark" data-bs-custom-class="tooltip-dark" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            Dark Tooltip
                        </button>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

    </div>

@endsection

@section('js')

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection