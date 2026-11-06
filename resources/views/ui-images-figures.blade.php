@extends('partials.layouts.master2')

    @section('title', 'UI Images Figures | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Images & Figures' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    
    @section('content')


    <div class="row g-4">

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">1:1 Aspect Ratio</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4"> Ensure <strong class="text-body fw-medium">1:1 aspect ratio</strong> for images by applying <code>.image-wrapper</code> and <code>.image-1x1</code> classes. This maintains a square shape for consistent image display.</p>

                    <div class="image-wrapper image-1x1">
                        <img src="{{ asset('assets/images/small/img-10.jpg') }}" alt="1x1 Image" class="img-fluid">
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">4:3 Aspect Ratio</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <strong class="text-body fw-medium">4:3 aspect ratio</strong> for images with the <code>.image-wrapper .image-4x3</code> class. Apply this class to maintain a 4:3 ratio for your images and elements.</p>

                    <div class="image-wrapper image-4x3">
                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" alt="4x3 Image" class="img-fluid">
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">3:2 Aspect Ratio</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use the <strong class="text-body fw-medium">3:2 aspect ratio</strong> by applying the <code>.image-wrapper .image-3x2</code> class to your elements. This ensures your images and content maintain a 3:2 ratio.</p>

                    <div class="image-wrapper image-3x2">
                        <img src="{{ asset('assets/images/small/img-3.jpg') }}" alt="3x2 Image" class="img-fluid">
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">16:9 Aspect Ratio</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4"> Maintain a <strong class="text-body fw-medium">16:9 aspect ratio</strong> by using the <code>.image-wrapper .image-16x9</code> class. Apply this class to ensure your images and elements keep a 16:9 ratio.</p>

                    <div class="image-wrapper image-16x9">
                        <img src="{{ asset('assets/images/small/img-7.jpg') }}" alt="16x9 Image" class="img-fluid">
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Figures</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use Bootstrap's <code>&lt;figure&gt;</code> component to display images with captions. Wrap the image in a <code>&lt;figure&gt;</code> tag and use <code>&lt;figcaption&gt;</code> for the caption below the image.</p>

                    <figure class="figure mb-0">
                        <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" class="figure-img img-fluid rounded" alt="...">
                        <figcaption class="figure-caption">A caption for the above image.</figcaption>
                    </figure>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Image Center Align</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Center an <strong class="text-body fw-medium">image</strong> with <code>.mx-auto</code> and <code>.d-block</code> on the <code>&lt;img&gt;</code> tag.</p>

                    <img class="rounded mx-auto d-block" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="...">

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Image Right Align</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Right-align an <strong class="text-body fw-medium">image</strong> with the <code>.float-end</code> class on the <code>&lt;img&gt;</code> tag.</p>

                    <img class="rounded float-end" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="...">

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Image Left Align</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Left-align an <strong class="text-body fw-medium">image</strong> with the <code>.float-start</code> class on the <code>&lt;img&gt;</code> tag.</p>

                    <img class="rounded float-start" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="...">

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Image With Radius </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Add a border radius to an <strong class="text-body fw-medium">image</strong> with the <code>.rounded-*</code> class. Use this class on the <code>&lt;img&gt;</code> tag for a rounded effect.</p>

                    <div class="text-center">
                        <img class="img-fluid rounded-5" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="...">
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Rounded Image </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Create a <strong class="text-body fw-medium">rounded image</strong> with the <code>.rounded-pill</code> class. Apply this class to the <code>&lt;img&gt;</code> tag for a pill-shaped rounded effect.</p>

                    <div class="text-center">
                        <img class="img-fluid rounded-pill" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="...">
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Image Thumbnail </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Style an <strong class="text-body fw-medium">image</strong> as a thumbnail with the <code>.img-thumbnail</code> class. Apply this class to the <code>&lt;img&gt;</code> tag for a bordered, rounded image.</p>

                    <div class="text-center">
                        <img class="img-thumbnail" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="...">
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Rounded Thumbnail </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <strong class="text-body fw-medium">rounded thumbnails</strong> with <code>.img-thumbnail</code> and <code>.rounded-pill</code> on the <code>&lt;img&gt;</code> tag.</p>

                    <div class="text-center">
                        <img class="img-thumbnail rounded-pill" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="...">
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