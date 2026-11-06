@extends('partials.layouts.master2')

    @section('title', 'UI Placeholders | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Placeholder' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
    @section('content')


    <div class="row g-4">

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Placeholder Cards </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create placeholder content for cards in Bootstrap by using the <code>.placeholder</code> class. This provides a loading animation or filler content until the actual data is loaded.</p>
                    <!-- start:: Default Placeholder -->
                    <div class="row gy-4">
                        <div class="col-sm-4 col-xl-3">
                            <div class="card bg-light bg-opacity-30 border border-dashed shadow-none overflow-hidden mb-0 h-100" aria-hidden="true">
                                <img class="card-img-top h-200px img-fluid" src="{{ asset('assets/images/small/img-2.jpg') }}" alt="#">
                                <div class="card-body" id="cardContent">
                                    <h6 class="card-title">Card Title</h6>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a class="btn btn-primary" href="#!">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xl-3">
                            <div class="card bg-light bg-opacity-30 border border-dashed shadow-none overflow-hidden text-secondary mb-0 h-100" aria-hidden="true"><img class="card-img-top h-200px img-fluid" src="{{ asset('assets/images/placeholder-3.jpg') }}" alt="#">
                                <div class="card-body">
                                    <h6 class="card-title text-secondary"><span class="placeholder col-6 placeholder-light"></span></h6>
                                    <div class="card-text mb-3">
                                        <div class="placeholder col-7 placeholder-light"></div>
                                        <div class="placeholder col-4 placeholder-light"></div>
                                        <div class="placeholder col-4 placeholder-light"></div>
                                        <div class="placeholder col-6 placeholder-light"></div>
                                    </div><a class="btn btn-primary disabled placeholder col-6" href="#!"></a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end:: Default Placeholder -->
                </div>
            </div><!--end::card-->
        </div>

        <div class="col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Placeholder Width </h5>
                </div>
                <div class="card-body">
                    <!-- start:: Default Placeholder -->
                    <p class="text-muted mb-4">You can change the width through grid column classes, width utilities, or inline styles.<code> (like: w-25 , w-50 , w-75 , w-100 ) </code></p>
                    <div class="card-body p-0">
                        <span class="placeholder w-50 placeholder-light"></span>
                        <span class="placeholder w-75 placeholder-light"></span>
                        <span class="placeholder w-100 placeholder-light"></span>
                        <span class="placeholder w-25 placeholder-light"></span>
                    </div><!-- end:: Default Placeholder -->
                </div>
            </div><!--end::card-->
        </div>

        <div class="col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Placeholder Sizing </h5>
                </div>
                <!-- start:: Default Placeholder -->
                <div class="card-body border rounded-3 h-100">
                    <p class="text-muted mb-4">The size of <code>placeholder</code> are based on the typographic style of the parent element. Customize them with sizing modifiers: <code>placeholder-lg, placeholder-sm, or placeholder-xs</code>.</p>
                    <div class="card-body p-0"><span class="placeholder col-12 placeholder-lg placeholder-light"></span><span class="placeholder col-12 placeholder-light"></span><span class="placeholder col-12 placeholder-sm placeholder-light"></span><span class="placeholder col-12 placeholder-xs placeholder-light"></span></div>
                </div><!-- end:: Default Placeholder -->
            </div><!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Placeholder Animations </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Add animations to Bootstrap placeholders using the <code>.placeholder-glow</code> or <code>.placeholder-wave</code> classes for a smooth loading effect while content is being loaded.</p>
                    <!-- start:: Default Placeholder -->
                    <div>
                        <p class="placeholder-glow mb-0"><span class="placeholder col-12 placeholder-light"></span></p>
                        <p class="placeholder-wave mb-0"><span class="placeholder col-12 placeholder-light"></span></p>
                    </div><!-- end:: Default Placeholder -->
                </div>
            </div><!--end::card-->
        </div>

        <div class="col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Colors Placeholder </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">By default, the <code>placeholder </code>uses <code>currentcolor</code>. This can be overridden with a custom color or utility class.</p>
                    <!-- start:: Default Placeholder -->
                    <div class="placeholder-glow">
                        <span class="placeholder col-12"></span>
                        <span class="placeholder col-12 bg-primary"></span>
                        <span class="placeholder col-12 bg-secondary"></span>
                        <span class="placeholder col-12 bg-success"></span>
                        <span class="placeholder col-12 bg-danger"></span>
                        <span class="placeholder col-12 bg-warning"></span>
                        <span class="placeholder col-12 bg-info"></span>
                        <span class="placeholder col-12 bg-light"></span>
                        <span class="placeholder col-12 bg-dark"></span>
                    </div> <!-- end:: Default Placeholder -->
                </div>
            </div><!--end::card-->
        </div>

        <div class="col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Custom Animation Placeholder </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">With the <code>wave-left-lines</code> custom animation, placeholders may be used into your unique design.</p>
                    <!-- start:: Default Placeholder -->
                    <div class="d-flex flex-column gap-5">
                        <div class="placeholder-body">
                            <div class="placeholder-start square"></div>
                            <div class="placeholder-end">
                                <div class="placeholder-line placeholder w-25"></div>
                                <div class="placeholder-line placeholder placeholder-xs w-100"></div>
                                <div class="placeholder-line placeholder placeholder-xs w-100"></div>
                                <div class="placeholder-line placeholder placeholder-xs w-50"></div>
                            </div>
                        </div>
                        <div class="placeholder-body">
                            <div class="placeholder-start circle"></div>
                            <div class="placeholder-end">
                                <div class="placeholder-line placeholder-lg w-25"></div>
                                <div class="placeholder-line placeholder placeholder-xs w-100"></div>
                                <div class="placeholder-line placeholder placeholder-xs w-100"></div>
                                <div class="placeholder-line placeholder placeholder-xs w-25"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Default Placeholder -->
                </div>
            </div><!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Placeholder </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create interactive placeholders in Bootstrap by using buttons or links. When clicked, the placeholder content is replaced with the actual content, simulating a loading effect.</p>

                    <!-- start:: Default Placeholder -->
                    <div class="row g-5" id="cardRow">
                        <!-- Cards will be injected here -->
                    </div>
                    <button class="btn btn-secondary mt-5 mx-auto d-flex justify-content-center" id="reloadButton">Show Content</button>
                    <!-- end:: Default Placeholder -->
                </div>
            </div><!--end::card-->
        </div>

    </div>

@endsection

@section('js')

    <!-- Placeholder init -->
    <script src="{{ asset('assets/js/pages/placeholder.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
