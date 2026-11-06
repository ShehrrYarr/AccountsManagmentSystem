@extends('partials.layouts.master2')

    @section('title', 'UI Popovers | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Popover' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
    @section('content')


    <div class="row g-4">

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Popover</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use a <strong class="text-body fw-medium">default popover</strong> in Bootstrap by adding the <code>data-bs-toggle="popover"</code> attribute to an element. Set the popover content with the <code>data-bs-content</code> attribute.</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" class="btn btn-primary" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Default Popover
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-custom-class="popover-no-arrow" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="This is a very beautiful popover, show some love.">
                            No Arrow Popover
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
                    <h5 class="card-title mb-0">Popover Directions</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Set <strong class="text-body fw-medium">popover directions</strong> in Bootstrap with classes like <code>data-bs-placement="top"</code> or <code>data-bs-placement="bottom"</code>. These classes control where the popover appears relative to the element.</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" class="btn btn-primary" data-bs-custom-class="popover-primary" data-bs-placement="top" data-bs-toggle="popover" title="Top Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Popover on top
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-custom-class="popover-primary" data-bs-placement="right" data-bs-toggle="popover" title="Right Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Popover on right
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-custom-class="popover-primary" data-bs-placement="bottom" data-bs-toggle="popover" title="Bottom Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Popover on bottom
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-custom-class="popover-primary" data-bs-placement="left" data-bs-toggle="popover" title="Left Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Popover on left
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
                    <h5 class="card-title mb-0">Colored Popover</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Apply a <strong class="text-body fw-medium">custom color</strong> to your Bootstrap popover using the <code>data-bs-custom-class="popover-*"</code> attribute. This class sets a custom background color for the popover.</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" class="btn btn-primary" data-bs-custom-class="popover-primary" data-bs-placement="top" data-bs-toggle="popover" title="Primary Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Primary
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-custom-class="popover-secondary" data-bs-placement="top" data-bs-toggle="popover" title="Secondary Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Secondary
                        </button>
                        <button type="button" class="btn btn-success" data-bs-custom-class="popover-success" data-bs-placement="bottom" data-bs-toggle="popover" title="Success Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Success
                        </button>
                        <button type="button" class="btn btn-info" data-bs-custom-class="popover-info" data-bs-placement="bottom" data-bs-toggle="popover" title="Info Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Info
                        </button>
                        <button type="button" class="btn btn-warning" data-bs-custom-class="popover-warning" data-bs-placement="right" data-bs-toggle="popover" title="Warning Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Warning
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-custom-class="popover-danger" data-bs-placement="right" data-bs-toggle="popover" title="Danger Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Danger
                        </button>
                        <button type="button" class="btn btn-light" data-bs-custom-class="popover-light" data-bs-placement="left" data-bs-toggle="popover" title="Light Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Light
                        </button>
                        <button type="button" class="btn btn-dark" data-bs-custom-class="popover-dark" data-bs-placement="left" data-bs-toggle="popover" title="Dark Popover" data-bs-content="This is a very beautiful popover, show some love.">
                            Dark
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