@extends('partials.layouts.master2')

    @section('title', 'UI Progress | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Progress' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
    @section('content')

    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Basic Progress </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Create a <strong class="text-body fw-medium">progress bar</strong> with Bootstrap using <code>.progress</code>and <code>.progress-bar</code> classes. Set the width of the progress bar with inline styles or utility classes to show progress.</p>

                    <div class="d-flex flex-column gap-3">
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-0"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-25"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-50"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-75"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-100"></div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Colored Progress </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <strong class="text-body fw-medium">colored progress bars</strong> in Bootstrap by applying classes like <code>.bg-success</code> or <code>.bg-danger</code> to the <code>.progress-bar</code> for different colors.</p>

                    <div class="d-flex flex-column gap-3">
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-0"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger w-25"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success w-50"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-warning w-75"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-info w-100"></div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Progress With Labels </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Display <strong class="text-body fw-medium">labels</strong> on Bootstrap progress bars by adding text inside the <code>&lt;div class="progress-bar"&gt;</code>. Use classes like <code>.text-white</code> for text color.</p>

                    <div class="d-flex flex-column gap-3">
                        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-primary w-20">20%</div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success w-25">25%</div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Info example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-info w-50">50%</div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-warning w-75">75%</div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger w-100">100%</div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Progress size </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Easily adjust the size of progress bars using custom classes. The <code>.progress-xs</code> class represents an extra small progress bar, perfect for compact layouts.</p>

                    <div class="d-flex flex-column gap-3">
                        <div class="progress progress-xs" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-20"></div>
                        </div>
                        <div class="progress progress-sm" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-25"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-50"></div>
                        </div>
                        <div class="progress progress-lg" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-75"></div>
                        </div>
                        <div class="progress progress-xl" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar w-100"></div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Striped Progress </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Create <strong class="text-body fw-medium">striped progress bars</strong> in Bootstrap by adding the <code>.progress-bar-striped</code> class to your <code>&lt;div class="progress-bar"&gt;</code>. This adds a striped pattern to the progress bar for a dynamic look.</p>

                    <div class="d-flex flex-column gap-3">
                        <div class="progress" role="progressbar" aria-label="Default striped example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped" style="width: 10%"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Success striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped bg-success w-25"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Info striped example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped bg-info w-50"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Warning striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped bg-warning w-75"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Danger striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped bg-danger w-100"></div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Animated Striped Progress </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Add <strong class="text-body fw-medium">animation</strong> to striped progress bars in Bootstrap by using <code>.progress-bar-animated</code> with <code>.progress-bar-striped</code>. This makes the stripes move, creating a dynamic effect.</p>

                    <div class="d-flex flex-column gap-3">
                        <div class="progress" role="progressbar" aria-label="Default striped example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 10%"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Success striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success w-25"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Info striped example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info w-50"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Warning striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning w-75"></div>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Danger striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger w-100"></div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Default Circle Progress Bar </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use the <strong class="text-body fw-medium">custom circle progress bar</strong> by adding a <code>.circular-progress</code> class. Inside, use an <code>&lt;svg&gt;</code> element with <code>&lt;circle&gt;</code> elements for the background and foreground to visually display progress.</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">

                        <div class="circular-progress">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                        </div>

                        <div class="circular-progress" style="--progress: 70;">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">70%</div>
                        </div>

                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Circle Size Progress </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <strong class="text-body fw-medium">size classes</strong> like <code>.circular-*</code> to adjust the circle progress bar size in Bootstrap. Apply it to <code>.circular-progress</code> for a larger display.</p>

                    <div class="d-flex flex-wrap align-items-center gap-3">

                        <div class="circular-progress circular-xxl">
                            <svg class="circular-inner" viewBox="0 0 130 130">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">40%</div>
                        </div>

                        <div class="circular-progress circular-xl">
                            <svg class="circular-inner" viewBox="0 0 110 110">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">40%</div>
                        </div>

                        <div class="circular-progress">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">40%</div>
                        </div>

                        <div class="circular-progress circular-md">
                            <svg class="circular-inner" viewBox="0 0 76 76">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">40%</div>
                        </div>

                        <div class="circular-progress circular-sm">
                            <svg class="circular-inner" viewBox="0 0 56 56">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">40%</div>
                        </div>

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
                    <h5 class="card-title mb-0"> Circle Color Progress </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Change the <strong class="text-body fw-medium">color</strong> of your circle progress bar using the <code>.circular-progress-*</code> class. Apply this class to <code>.circular-progress</code> for a color scheme.</p>

                    <div class="d-flex align-items-center gap-3 flex-wrap">

                        <div class="circular-progress circular-progress-primary" style="--progress: 10;">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">10%</div>
                        </div>
                        <div class="circular-progress circular-progress-secondary" style="--progress: 70;">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">70%</div>
                        </div>
                        <div class="circular-progress circular-progress-success" style="--progress: 40;">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">40%</div>
                        </div>
                        <div class="circular-progress circular-progress-info" style="--progress: 22;">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">22%</div>
                        </div>
                        <div class="circular-progress circular-progress-warning" style="--progress: 90;">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">90%</div>
                        </div>
                        <div class="circular-progress circular-progress-danger" style="--progress: 40;">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">40%</div>
                        </div>
                        <div class="circular-progress circular-progress-dark" style="--progress: 50;">
                            <svg class="circular-inner" viewBox="0 0 90 90">
                                <circle class="bg-circular-progress"></circle>
                                <circle class="fg-circular-progress"></circle>
                            </svg>
                            <div class="circular-text">50%</div>
                        </div>

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