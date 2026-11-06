@extends('partials.layouts.master2')

    @section('title', 'UI Carousel | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Carousel' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  
@section('css')
<link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection

    @section('content')


    <div class="row g-4">

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Carousel Only</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a default carousel using Bootstrap's <code>.carousel</code> class. Use <code>&lt;div class="carousel slide"&gt;</code> to set up the carousel, and include <code>&lt;div class="carousel-inner"&gt;</code> with <code>&lt;div class="carousel-item"&gt;</code> elements for each slide.</p>
                    <div id="carousel_only" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="d-block w-100" alt="Product 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-3.jpg') }}" class="d-block w-100" alt="Product 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-1.jpg') }}" class="d-block w-100" alt="Product 3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">With Controls</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Add navigation controls to a Bootstrap carousel by including <code>&lt;button class="carousel-control-prev"&gt;</code> and <code>&lt;button class="carousel-control-next"&gt;</code> elements. These controls allow users to move between slides in the carousel.</p>
                    <div id="with_controls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/small/img-4.jpg') }}" class="d-block w-100" alt="Product 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-5.jpg') }}" class="d-block w-100" alt="Product 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-6.jpg') }}" class="d-block w-100" alt="Product 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#with_controls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#with_controls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">With default Indicators</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Add default indicators to a Bootstrap carousel by including <code>&lt;ol class="carousel-indicators"&gt;</code> with <code>&lt;li data-bs-target="#carouselExample" data-bs-slide-to="0"&gt;</code> elements for each slide. These indicators provide visual navigation for users.</p>

                    <div class="carousel slide" id="carouselExampleIndicators" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/small/img-7.jpg') }}" class="d-block w-100" alt="Product 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-8.jpg') }}" class="d-block w-100" alt="Product 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-9.jpg') }}" class="d-block w-100" alt="Product 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Crossfade Animation</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Enable crossfade animation in a Bootstrap carousel by adding the <code>.carousel-fade</code> class to the <code>&lt;div class="carousel slide"&gt;</code>. This creates a smooth fade transition between slides.</p>

                    <div class="carousel slide carousel-fade" id="carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel-fade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carousel-fade" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carousel-fade" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/small/img-10.jpg') }}" class="d-block w-100" alt="Product 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-11.jpg') }}" class="d-block w-100" alt="Product 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-12.jpg') }}" class="d-block w-100" alt="Product 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-fade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-fade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xl-4">
            <div id="productCarousel" class="card h-100 mb-0 carousel-custom carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <!--start::card-->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Dots Indicators</h5>
                    <div class="carousel-indicators carousel-indicators-danger carousel-indicators-dots">
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> Use custom dots for carousel indicators by adding <code>&lt;div class="carousel-indicators-dots"&gt;</code> with your desired dot styles. Replace the default <code>&lt;ol class="carousel-indicators"&gt;</code> with your custom dots to style carousel navigation.</p>
                    <div id="carouselExample" class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/images/small/img-13.jpg') }}" class="d-block w-100" alt="Product 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/small/img-14.jpg') }}" class="d-block w-100" alt="Product 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/small/img-1.jpg') }}" class="d-block w-100" alt="Product 3">
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xl-4">
            <div id="bullet_indicators" class="card h-100 mb-0 carousel-custom carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <!--start::card-->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Bullet Indicators</h5>
                    <div class="carousel-indicators carousel-indicators-bullet carousel-indicators-danger">
                        <button type="button" data-bs-target="#bullet_indicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#bullet_indicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#bullet_indicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Customize carousel indicators with bullet styles by using <code>&lt;ul class="carousel-indicators-bullet"&gt;</code> instead of the default <code>&lt;ol class="carousel-indicators"&gt;</code>. Style each <code>&lt;li&gt;</code> to create unique bullet indicators for your carousel.</p>
                    <div id="carouselExample" class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/images/small/img-1.jpg') }}" class="d-block w-100" alt="Product 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/small/img-3.jpg') }}" class="d-block w-100" alt="Product 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/small/img-4.jpg') }}" class="d-block w-100" alt="Product 3">
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">With Captions</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Add captions to Bootstrap carousel slides by including <code>&lt;div class="carousel-caption"&gt;</code> inside each <code>&lt;div class="carousel-item"&gt;</code>. Place your caption text within this container to provide additional information on each slide.</p>

                    <div class="carousel slide" id="carouselExampleCaptions">
                        <div class="carousel-indicators carousel-indicators-bullet carousel-indicators-warning">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/small/img-5.jpg') }}" class="d-block w-100" alt="Product 1">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="text-white">First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-6.jpg') }}" class="d-block w-100" alt="Product 2">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="text-white">Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-7.jpg') }}" class="d-block w-100" alt="Product 3">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="text-white">Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Dark variant carousel</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a dark variant of a Bootstrap carousel by adding the <code>.carousel-dark</code> class to the <code>&lt;div class="carousel slide"&gt;</code>. This adjusts the carousel's text and controls for better visibility on dark backgrounds.</p>

                    <div class="carousel slide carousel-dark" id="dark_variant">
                        <div class="carousel-indicators carousel-indicators-bullet carousel-indicators-warning">
                            <button type="button" data-bs-target="#dark_variant" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#dark_variant" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#dark_variant" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/small/img-8.jpg') }}" class="d-block w-100" alt="Product 1">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-9.jpg') }}" class="d-block w-100" alt="Product 2">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/images/small/img-10.jpg') }}" class="d-block w-100" alt="Product 3">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#dark_variant" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#dark_variant" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

    </div>
@endsection

@section('js')
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @endsection