@extends('partials.layouts.master2')

    @section('title', 'UI Range Slider | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Form Range' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/nouislider/nouislider.min.css') }}">
    @endsection
    
    @section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Example range</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Example Range</strong> uses <code>type="range"</code> to create a slider input,
                        allowing users to select a value within a specified range easily.
                    </p>

                    <input type="range" class="form-range" id="customRange1">

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Disabled</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Disabled Range</strong> example uses <code>type="range"</code> with the
                        <code>disabled</code> attribute to prevent user interaction.
                    </p>

                    <input type="range" class="form-range" id="disabledRange" disabled>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Min and max</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Min and Max Range</strong> example uses <code>type="range"</code> with
                        <code>min</code> and <code>max</code> attributes to set the allowed value range.
                    </p>

                    <input type="range" class="form-range" min="0" max="5" id="customRange2">

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Steps</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Range with Steps</strong> example uses <code>type="range"</code> with the
                        <code>step</code> attribute to define value increments.
                    </p>

                    <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Default Slider</strong> example demonstrates a basic noUiSlider implementation for smooth and interactive value selection.
                    </p>

                    <div id="defaultSlider"></div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Disabled Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Disabled Slider</strong> example shows a noUiSlider that is non-interactive, preventing users from changing the value.
                    </p>

                    <div id="disabledSlider"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Vertical Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Vertical Slider</strong> example demonstrates a noUiSlider with a vertical orientation.
                        You can configure it using <code>orientation: 'vertical'</code>.
                    </p>

                    <div id="verticalSlider" class="min-h-176px mx-auto"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Two Handle Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Two Handle Slider</strong> example shows a noUiSlider with two handles, allowing users to select a range of values.
                        You can configure it using <code>start: [min, max]</code>.
                    </p>

                    <div id="rangeSlider"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Margin Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Margin Slider</strong> example demonstrates a noUiSlider with a minimum gap between handles.
                        You can configure it using <code>margin: 30</code>.
                    </p>

                    <div id="marginSlider"></div>

                    <div class="d-flex align-items-center justify-content-between gap-1 flex-wrap mt-5">
                        <p class="m-0 fw-semibold">Min Val: <span class="fs-12 fw-medium text-muted" id="slider-margin-value-min"></span></p>
                        <p class="m-0 fw-semibold">Max Val: <span class="fs-12 fw-medium text-muted" id="slider-margin-value-max"></span></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Step Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Step Slider</strong> example shows how to create a noUiSlider with fixed step increments.
                        Configure it using <code>step: 10</code>.
                    </p>

                    <div id="stepsSlider"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">RTL Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">RTL Slider</strong> example demonstrates a right-to-left noUiSlider.
                        Configure it using <code>direction: 'rtl'</code>.
                    </p>

                    <div id="rtlSlider"></div>

                    <p class="mt-5 mb-0 fw-semibold">Max Val: <span class="fs-12 fw-medium text-muted" id="field"></span></p>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tooltips Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Tooltips Slider</strong> example shows a noUiSlider with tooltips displaying the current value.
                        Enable it using <code>tooltips: true</code>.
                    </p>

                    <div class="mt-5 pt-5">
                        <div id="tooltipsSlider"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Multiple Tyle Range Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Multiple Type Range Slider</strong> example demonstrates a noUiSlider with multiple range handles.
                        Configure different ranges using <code>start: [min, max]</code>.
                    </p>

                    <div id="multipleTyleRangeSlider"></div>

                    <p class="mt-5 mb-0 fw-semibold">Max Val: <span class="fs-12 fw-medium text-muted" id="multipleTyleRangeSlider-step-value">20.00</span></p>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Slider Fit Style</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Slider Fit Style</strong> example showcases a noUiSlider with a compact and well-aligned design.
                        Adjust styling using custom CSS for a seamless fit in your layout.
                    </p>

                    <div class="mt-5 slider-fit" id="slider-fit"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Rounded Slider</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Rounded Slider</strong> example shows a noUiSlider with smooth, rounded handles for a modern look.
                    </p>

                    <div class="mt-5 no-handle-slider no-handle-rounded" id="slider-round"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Square Slider</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Square Slider</strong> example displays a noUiSlider with square handles for a sharp and clean design.
                    </p>

                    <div class="mt-5 no-handle-slider no-handle-square" id="slider-square"></div>

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Slider Sizes</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Slider Sizes</strong> example shows how to adjust the noUiSlider size using classes like <code>.large-slider</code> for a bigger slider.
                    </p>

                    <div class="mt-5">
                        <div id="large-slider" class="large-slider"></div>
                    </div>
                    <div class="pt-5 mt-5">
                        <div id="default-slider"></div>
                    </div>
                    <div class="pt-5 mt-5">
                        <div id="small-slider" class="small-slider"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Soft Limit Slider</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Soft Limit Slider</strong> example demonstrates a slider with a soft limit, allowing values to go slightly beyond the set range for flexibility.
                        Configure it using <code>limit: [min, max]</code> in the settings.
                    </p>

                    <div class="min-h-40px mt-5">
                        <div id="arbitrary-values-slider"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Secoundry Slider</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Secondary Slider</strong> example showcases a styled slider using the <code>.noUi-target-secondary</code> class for a distinct appearance.
                    </p>

                    <div class="noUi-target-secondary" id="noUi-target-secoundry"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Success Slider</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Success Slider</strong> example showcases a styled slider using the <code>.noUi-target-success</code> class for a distinct appearance.
                    </p>

                    <div class="noUi-target-success" id="noUi-target-success"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Info Slider</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Info Slider</strong> example showcases a styled slider using the <code>.noUi-target-info</code> class for a distinct appearance.
                    </p>

                    <div class="noUi-target-info" id="noUi-target-info"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Warning Slider</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Warning Slider</strong> example showcases a styled slider using the <code>.noUi-target-warning</code> class for a distinct appearance.
                    </p>

                    <div class="noUi-target-warning" id="noUi-target-warning"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Danger Slider</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Danger Slider</strong> example showcases a styled slider using the <code>.noUi-target-danger</code> class for a distinct appearance.
                    </p>

                    <div class="noUi-target-danger" id="noUi-target-danger"></div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dark Slider</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Dark Slider</strong> example showcases a styled slider using the <code>.noUi-target-danrk</code> class for a distinct appearance.
                    </p>

                    <div class="noUi-target-dark" id="noUi-target-dark"></div>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <!-- wNumb js -->
    <script src="{{ asset('assets/libs/wNumb/wNumb.min.js') }}"></script>

    <!-- nouislider js -->
    <script src="{{ asset('assets/libs/nouislider/nouislider.min.js') }}"></script>

    <!-- nouislider init -->
    <script src="{{ asset('assets/js/plugins/nouislider.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
