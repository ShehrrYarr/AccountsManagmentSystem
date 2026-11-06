@extends('partials.layouts.master2')

    @section('title', 'UI Off-Canvas | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Off-Canvas' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
    @section('content')

    <div class="row">

        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Offcanvas Placements</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Use Bootstrap's offcanvas component to display content from different directions. Add the <code>offcanvas-start</code>, <code>offcanvas-end</code>, <code>offcanvas-top</code>, or <code>offcanvas-bottom</code> classes to control the placement.</p>

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStart" aria-controls="offcanvasStart">
                            Toggle Start
                        </button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                            Toggle Top
                        </button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
                            Toggle End
                        </button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                            Toggle Bottom
                        </button>
                    </div>

                    <!-- start:: Start Offcanvas -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasStart" aria-labelledby="offcanvasStartLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasStartLabel">Explore Our Offerings</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-1.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 1">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                    <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                    <p class="card-text text-muted">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                    <a href="#!" class="btn btn-primary mt-3">Learn More</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 2">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                    <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                    <p class="card-text text-muted">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                    <a href="#!" class="btn btn-danger mt-3">Shop Now</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-3.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 3">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                    <h5 class="card-title"><strong>New Arrivals:</strong> Latest Fashion Trends</h5>
                                    <p class="card-text text-muted">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                    <a href="#!" class="btn btn-success mt-3">Explore Collection</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-4.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 4">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                    <h5 class="card-title"><strong>Tech Update:</strong> Explore New Gadgets</h5>
                                    <p class="card-text text-muted">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                    <a href="#!" class="btn btn-info mt-3">See Gadgets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Start Offcanvas -->

                    <!-- start:: Top Offcanvas -->
                    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel" style="min-height:481px;">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasStartLabel">Explore Our Offerings</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="row g-5">
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card mb-0">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid object-fit-cover rounded-top h-224px" alt="Recent Activity 1">
                                        <div class="card-body p-4 text-center">
                                            <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                            <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                            <p class="card-text text-muted text-truncate-2">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card mb-0">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid object-fit-cover rounded-top h-224px" alt="Recent Activity 2">
                                        <div class="card-body p-4 text-center">
                                            <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                            <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                            <p class="card-text text-muted text-truncate-2">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card mb-0">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid object-fit-cover rounded-top h-224px" alt="Recent Activity 3">
                                        <div class="card-body p-4 text-center">
                                            <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                            <h5 class="card-title"><strong>New Arrivals:</strong> Fashion Trends</h5>
                                            <p class="card-text text-muted text-truncate-2">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card mb-0">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid object-fit-cover rounded-top h-224px" alt="Recent Activity 4">
                                        <div class="card-body p-4 text-center">
                                            <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                            <h5 class="card-title"><strong>Tech Update:</strong> Explore Gadgets</h5>
                                            <p class="card-text text-muted text-truncate-2">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end:: Top Offcanvas -->

                    <!-- start:: End Offcanvas -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasStartLabel">Explore Our Offerings</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-6.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 1">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                    <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                    <p class="card-text text-muted">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                    <a href="#!" class="btn btn-primary mt-3">Learn More</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-7.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 2">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                    <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                    <p class="card-text text-muted">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                    <a href="#!" class="btn btn-danger mt-3">Shop Now</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-8.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 3">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                    <h5 class="card-title"><strong>New Arrivals:</strong> Latest Fashion Trends</h5>
                                    <p class="card-text text-muted">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                    <a href="#!" class="btn btn-success mt-3">Explore Collection</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-9.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 4">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                    <h5 class="card-title"><strong>Tech Update:</strong> Explore New Gadgets</h5>
                                    <p class="card-text text-muted">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                    <a href="#!" class="btn btn-info mt-3">See Gadgets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: End Offcanvas -->

                    <!-- start:: Bottom Offcanvas -->
                    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="min-height:481px;">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasStartLabel">Explore Our Offerings</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="row g-5">
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card mb-0">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid object-fit-cover rounded-top h-224px" alt="Recent Activity 1">
                                        <div class="card-body p-4 text-center">
                                            <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                            <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                            <p class="card-text text-muted text-truncate-2">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card mb-0">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid object-fit-cover rounded-top h-224px" alt="Recent Activity 2">
                                        <div class="card-body p-4 text-center">
                                            <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                            <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                            <p class="card-text text-muted text-truncate-2">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card mb-0">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid object-fit-cover rounded-top h-224px" alt="Recent Activity 3">
                                        <div class="card-body p-4 text-center">
                                            <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                            <h5 class="card-title"><strong>New Arrivals:</strong> Fashion Trends</h5>
                                            <p class="card-text text-muted text-truncate-2">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card mb-0">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid object-fit-cover rounded-top h-224px" alt="Recent Activity 4">
                                        <div class="card-body p-4 text-center">
                                            <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                            <h5 class="card-title"><strong>Tech Update:</strong> Explore Gadgets</h5>
                                            <p class="card-text text-muted text-truncate-2">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end:: Bottom Offcanvas -->
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Offcanvas Backdrop</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Control scrolling and backdrop in Bootstrap offcanvas. Enable body scrolling with <code>data-bs-scroll="true"</code>, enable a backdrop with <code>data-bs-backdrop="true"</code>, or activate both for a custom experience.</p>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBodyScroll" aria-controls="offcanvasBodyScroll">
                            Enable Body Scrolling
                        </button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">
                            Enable backdrop
                        </button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="#offcanvasBoth">
                            Enable both scrolling & backdrop
                        </button>
                    </div>

                    <!-- start:: Enable Body Scrolling Offcanvas -->
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasBodyScroll" aria-labelledby="offcanvasBodyScrollLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasBodyScrollLabel">Explore Our Offerings</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-10.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 1">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                    <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                    <p class="card-text text-muted">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                    <a href="#!" class="btn btn-primary mt-3">Learn More</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-11.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 2">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                    <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                    <p class="card-text text-muted">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                    <a href="#!" class="btn btn-danger mt-3">Shop Now</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-12.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 3">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                    <h5 class="card-title"><strong>New Arrivals:</strong> Latest Fashion Trends</h5>
                                    <p class="card-text text-muted">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                    <a href="#!" class="btn btn-success mt-3">Explore Collection</a>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <img src="{{ asset('assets/images/small/img-13.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 4">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                    <h5 class="card-title"><strong>Tech Update:</strong> Explore New Gadgets</h5>
                                    <p class="card-text text-muted">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                    <a href="#!" class="btn btn-info mt-3">See Gadgets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Enable Body Scrolling Offcanvas -->
                    <!-- start:: Enable Backdrop Offcanvas -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasBackdropLabel">Explore Our Offerings</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-14.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 1">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                    <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                    <p class="card-text text-muted">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                    <a href="#!" class="btn btn-primary mt-3">Learn More</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-1.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 2">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                    <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                    <p class="card-text text-muted">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                    <a href="#!" class="btn btn-danger mt-3">Shop Now</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 3">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                    <h5 class="card-title"><strong>New Arrivals:</strong> Latest Fashion Trends</h5>
                                    <p class="card-text text-muted">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                    <a href="#!" class="btn btn-success mt-3">Explore Collection</a>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <img src="{{ asset('assets/images/small/img-3.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 4">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                    <h5 class="card-title"><strong>Tech Update:</strong> Explore New Gadgets</h5>
                                    <p class="card-text text-muted">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                    <a href="#!" class="btn btn-info mt-3">See Gadgets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Enable Backdrop Offcanvas -->
                    <!-- start:: Scrolling & Backdrop Offcanvas -->
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasBothLabel">Explore Our Offerings</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-4.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 1">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                    <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                    <p class="card-text text-muted">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                    <a href="#!" class="btn btn-primary mt-3">Learn More</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-5.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 2">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                    <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                    <p class="card-text text-muted">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                    <a href="#!" class="btn btn-danger mt-3">Shop Now</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-6.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 3">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                    <h5 class="card-title"><strong>New Arrivals:</strong> Latest Fashion Trends</h5>
                                    <p class="card-text text-muted">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                    <a href="#!" class="btn btn-success mt-3">Explore Collection</a>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <img src="{{ asset('assets/images/small/img-7.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 4">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                    <h5 class="card-title"><strong>Tech Update:</strong> Explore New Gadgets</h5>
                                    <p class="card-text text-muted">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                    <a href="#!" class="btn btn-info mt-3">See Gadgets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Scrolling & Backdrop Offcanvas -->
                </div><!--end::card-->
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Dark Offcanvas</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a dark-themed offcanvas in Bootstrap by adding the <code>.text-bg-dark</code> class to the <code>&lt;div class="offcanvas"&gt;</code>. This adjusts the background and text for a dark appearance.</p>

                    <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDark" aria-controls="offcanvasDark">
                        Dark Off-Canvas
                    </button>
                    <!-- start:: Start Offcanvas -->
                    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDark" aria-labelledby="offcanvasDarkLabel" data-bs-theme="dark">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasDarkLabel">Dark Offcanvas</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-8.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 1">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                    <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                    <p class="card-text text-muted">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                    <a href="#!" class="btn btn-primary mt-3">Learn More</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-9.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 2">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                    <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                    <p class="card-text text-muted">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                    <a href="#!" class="btn btn-danger mt-3">Shop Now</a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('assets/images/small/img-10.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 3">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                    <h5 class="card-title"><strong>New Arrivals:</strong> Latest Fashion Trends</h5>
                                    <p class="card-text text-muted">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                    <a href="#!" class="btn btn-success mt-3">Explore Collection</a>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <img src="{{ asset('assets/images/small/img-11.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 4">
                                <div class="card-body p-4 text-center">
                                    <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                    <h5 class="card-title"><strong>Tech Update:</strong> Explore New Gadgets</h5>
                                    <p class="card-text text-muted">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                    <a href="#!" class="btn btn-info mt-3">See Gadgets</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Start Offcanvas -->
                </div>
            </div><!--End::card-->
        </div>

        <div class="col-12">
            <div class="card mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Responsive Offcanvas</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Use the <code>.offcanvas-lg</code> class in Bootstrap to show the offcanvas only on large screens and above. It remains hidden on smaller devices for a responsive layout.</p>

                    <button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasresponsiveLG" aria-controls="offcanvasresponsiveLG">
                        Responsive Off-Canvas
                    </button>
                    <!-- start:: Start Offcanvas -->
                    <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="offcanvasresponsiveLG" aria-labelledby="offcanvasresponsiveLGLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title" id="offcanvasresponsiveLGLabel">Responsive Offcanvas</h5>
                            <button type="button" class="close ms-auto btn btn-text-primary icon-btn-sm" data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="ri-close-large-line fw-semibold"></i>
                            </button>
                        </div>

                        <div class="offcanvas-body">

                            <div class="row g-4">
                                <div class="col-12 col-lg-4 col-xl-3">
                                    <div class="card h-100 mb-0 bg-light bg-opacity-30 border border-dashed shadow-none">
                                        <img src="{{ asset('assets/images/small/img-12.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 1">
                                        <div class="card-body p-4 text-center d-flex flex-column justify-content-between align-items-center">
                                            <div>
                                                <i class="ri-rocket-line ri-2x mb-3 text-primary"></i>
                                                <h5 class="card-title"><strong>New Launch:</strong> Smartwatch XYZ</h5>
                                                <p class="card-text text-muted">Experience cutting-edge technology with heart rate monitoring, GPS tracking, and customizable watch faces.</p>
                                            </div>
                                            <a href="#!" class="btn btn-primary mt-3">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 col-xl-3">
                                    <div class="card h-100 mb-0 bg-light bg-opacity-30 border border-dashed shadow-none">
                                        <img src="{{ asset('assets/images/small/img-13.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 2">
                                        <div class="card-body p-4 text-center d-flex flex-column justify-content-between align-items-center">
                                            <div>
                                                <i class="ri-store-line ri-2x mb-3 text-danger"></i>
                                                <h5 class="card-title"><strong>Flash Sale:</strong> Up to 50% off!</h5>
                                                <p class="card-text text-muted">Hurry! Limited-time offers on selected items. Don't miss out on great deals!</p>
                                            </div>
                                            <a href="#!" class="btn btn-danger mt-3">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 col-xl-3">
                                    <div class="card h-100 mb-0 bg-light bg-opacity-30 border border-dashed shadow-none">
                                        <img src="{{ asset('assets/images/small/img-14.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 3">
                                        <div class="card-body p-4 text-center d-flex flex-column justify-content-between align-items-center">
                                            <div>
                                                <i class="ri-t-shirt-line ri-2x mb-3 text-success"></i>
                                                <h5 class="card-title"><strong>New Arrivals:</strong> Latest Fashion Trends</h5>
                                                <p class="card-text text-muted">Update your wardrobe with our stylish new arrivals. Stand out from the crowd!</p>
                                            </div>
                                            <a href="#!" class="btn btn-success mt-3">Explore Collection</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 col-xl-3">
                                    <div class="card h-100 mb-0 bg-light bg-opacity-30 border border-dashed shadow-none">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid rounded-top max-h-240px object-fit-cover" alt="Recent Activity 4">
                                        <div class="card-body p-4 text-center d-flex flex-column justify-content-between align-items-center">
                                            <div>
                                                <i class="ri-smartphone-line ri-2x mb-3 text-info"></i>
                                                <h5 class="card-title"><strong>Tech Update:</strong> Explore New Gadgets</h5>
                                                <p class="card-text text-muted">Discover the latest tech innovations that simplify your life and enhance productivity.</p>
                                            </div>
                                            <a href="#!" class="btn btn-info mt-3">See Gadgets</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: Start Offcanvas -->
                </div>
            </div><!--End::card-->
        </div>
    </div>

@endsection

@section('js')

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
