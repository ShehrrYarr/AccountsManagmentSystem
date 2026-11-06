@extends('partials.layouts.master2')

    @section('title', 'UI Links | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Links' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    
    @section('content')
  
    <div class="row g-4">

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Link Opacity</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Change the alpha opacity of the link <code>rgba()</code> color value with utilities. Please be aware that changes to a color’s opacity can lead to links with <a href="https://getbootstrap.com/docs/5.3/getting-started/accessibility/#color-contrast" target="_blank"><em>insufficient</em> contrast</a>.</p>

                    <div class="d-flex flex-column flex-wrap">
                        <p><a class="link-opacity-10" href="#!">Link opacity 10</a></p>
                        <p><a class="link-opacity-25" href="#!">Link opacity 25</a></p>
                        <p><a class="link-opacity-50" href="#!">Link opacity 50</a></p>
                        <p><a class="link-opacity-75" href="#!">Link opacity 75</a></p>
                        <p><a class="link-opacity-100" href="#!">Link opacity 100</a></p>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Link Hover Opacity</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4"> Use <code>.link-opacity-*-hover</code> to adjust <strong>link hover opacity</strong> in Bootstrap, making links more transparent on hover.</p>

                    <div class="d-flex flex-column flex-wrap">
                        <p><a class="link-opacity-10-hover" href="#!">Link hover opacity 10</a></p>
                        <p><a class="link-opacity-25-hover" href="#!">Link hover opacity 25</a></p>
                        <p><a class="link-opacity-50-hover" href="#!">Link hover opacity 50</a></p>
                        <p><a class="link-opacity-75-hover" href="#!">Link hover opacity 75</a></p>
                        <p><a class="link-opacity-100-hover" href="#!">Link hover opacity 100</a></p>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Link hover variants</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Just like the <code>.link-opacity-*-hover</code> utilities, <code>.link-offset</code> and <code>.link-underline-opacity</code> utilities include <code>:hover</code> variants by default. Mix and match to create unique link styles.</p>

                    <div class="d-flex flex-column flex-wrap">
                        <a class="text-decoration-underline link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="#!">
                            Underline opacity 0
                        </a>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Underline opacity</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted">Change the underline’s opacity. Requires adding <code>.link-underline</code> to first set an <code>rgba()</code> color we use to then modify the alpha opacity.</p>

                    <div class="d-flex flex-column flex-wrap">
                        <p><a href="#!" class="link-offset-2 text-decoration-underline link-underline link-underline-opacity-0">Underline opacity 0</a></p>
                        <p><a href="#!" class="link-offset-2 text-decoration-underline link-underline link-underline-opacity-10">Underline opacity 10</a></p>
                        <p><a href="#!" class="link-offset-2 text-decoration-underline link-underline link-underline-opacity-25">Underline opacity 25</a></p>
                        <p><a href="#!" class="link-offset-2 text-decoration-underline link-underline link-underline-opacity-50">Underline opacity 50</a></p>
                        <p><a href="#!" class="link-offset-2 text-decoration-underline link-underline link-underline-opacity-75">Underline opacity 75</a></p>
                        <p><a href="#!" class="link-offset-2 text-decoration-underline link-underline link-underline-opacity-100">Underline opacity 100</a></p>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Underline offset</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted">Change the underline’s distance from your text. Offset is set in <code>em</code> units to automatically scale with the element’s current <code>font-size</code>.</p>

                    <div class="d-flex flex-column flex-wrap">
                        <p><a href="#!">Default link</a></p>
                        <p><a class="text-decoration-underline link-offset-1" href="#!">Offset 1 link</a></p>
                        <p><a class="text-decoration-underline link-offset-1" href="#!">Offset 2 link</a></p>
                        <p><a class="text-decoration-underline link-offset-1" href="#!">Offset 3 link</a></p>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Pointer Event</h5>
                </div>
                <div class="card-body">

                    <div class="d-flex flex-column flex-wrap">
                        <p><a href="javascript:void(0)" class="pe-none text-primary fw-medium text-decoration-underline" tabindex="-1">This link</a> can not be clicked.</p>
                        <p><a href="javascript:void(0)" class="pe-auto text-primary fw-medium text-decoration-underline">This link</a> can be clicked (this is default behavior).</p>
                        <p class="pe-none mb-0"><a href="javascript:void(0)" tabindex="-1" class="text-primary fw-medium text-decoration-underline">This link</a> can not be clicked because the <code>pointer-events</code> property is inherited from its parent. However, <a href="javascript:void(0)" class="pe-auto">this link</a> has a <code>pe-auto</code> class and can be clicked.</p>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Underline color</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted">Change the underline’s color independent of the link text color.</p>

                    <div class="d-flex flex-column flex-wrap">
                        <p><a href="#!" class="text-decoration-underline link-underline-primary">Primary underline</a></p>
                        <p><a href="#!" class="text-decoration-underline link-underline-secondary">Secondary underline</a></p>
                        <p><a href="#!" class="text-decoration-underline link-underline-success">Success underline</a></p>
                        <p><a href="#!" class="text-decoration-underline link-underline-danger">Danger underline</a></p>
                        <p><a href="#!" class="text-decoration-underline link-underline-warning">Warning underline</a></p>
                        <p><a href="#!" class="text-decoration-underline link-underline-info">Info underline</a></p>
                        <p><a href="#!" class="text-decoration-underline link-underline-light">Light underline</a></p>
                        <p><a href="#!" class="text-decoration-underline link-underline-dark">Dark underline</a></p>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Link colors</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted">Use the <code>.link-*</code> classes to style links with color, including <code>:hover</code> and <code>:focus</code> states. Some colors are lighter and work best on dark backgrounds for better contrast.</p>

                    <div class="d-flex flex-column flex-wrap">
                        <p><a href="#!" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Primary link</a></p>
                        <p><a href="#!" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Secondary link</a></p>
                        <p><a href="#!" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Success link</a></p>
                        <p><a href="#!" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Danger link</a></p>
                        <p><a href="#!" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Warning link</a></p>
                        <p><a href="#!" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Info link</a></p>
                        <p><a href="#!" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Light link</a></p>
                        <p><a href="#!" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Dark link</a></p>
                        <p><a href="#!" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Emphasis link</a></p>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xxl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Link utilities</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted">Link styling has been enhanced with new utilities. You can now adjust link opacity, underline opacity, and underline offset using these updated helpers.</p>

                    <div class="d-flex flex-column flex-wrap">
                        <p><a href="#!" class="link-primary link-offset-2 text-decoration-underline link-underline-opacity-25-hover">Primary link</a></p>
                        <p><a href="#!" class="link-secondary link-offset-2 text-decoration-underline link-underline-opacity-100-hover">Secondary link</a></p>
                        <p><a href="#!" class="link-success link-offset-2 text-decoration-underline link-underline-opacity-75-hover">Success link</a></p>
                        <p><a href="#!" class="link-danger link-offset-2 text-decoration-underline link-underline-opacity-50-hover">Danger link</a></p>
                        <p><a href="#!" class="link-warning link-offset-2 text-decoration-underline link-underline-opacity-100-hover">Warning link</a></p>
                        <p><a href="#!" class="link-info link-offset-2 text-decoration-underline link-underline-opacity-100-hover">Info link</a></p>
                        <p><a href="#!" class="link-light link-offset-2 text-decoration-underline link-underline-opacity-75-hover">Light link</a></p>
                        <p><a href="#!" class="link-dark link-offset-2 text-decoration-underline link-underline-opacity-100-hover">Dark link</a></p>
                        <p><a href="#!" class="link-body-emphasis link-offset-2 text-decoration-underline link-underline-opacity-25-hover">Emphasis link</a></p>
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
