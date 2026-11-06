@extends('partials.layouts.master2')

@section('title',
    'Products Detail | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Ecommerce')
@section('pagetitle', 'Online Course')
@section('buttonTitle', 'Share')
@section('modalTarget', 'shareModal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/star-rating.js/star-rating.min.css') }}">
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection
@section('content')

    <div class="card mb-0">
        <div class="card-body">
            <div class="row g-5 mb-10">
                <div class="col-lg-6">
                    <!-- Thumb View Swiper -->
                    <div class="swiper thumb-view-swiper rounded">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-7.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-100 w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-8.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-100 w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-9.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-100 w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-10.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-100 w-100">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-11.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-100 w-100">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <!-- Thumbs Swiper -->
                    <div class="swiper thumbs-swiper rounded mt-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-7.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-10">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-8.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-10">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-9.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-10">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-10.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-10">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/images/small/img-11.jpg') }}" alt="product Image"
                                    class="img-fluid object-fit-cover h-10">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <span class="badge bg-success rounded-pill me-2 fw-semibold mb-3">#1 Best seller</span>
                    <h3 class="mb-3 lh-sm text-truncate-2">24" iMac® with Retina 4.5K display - Apple M1 8GB Memory -
                        256GB SSD - w/Touch ID (Latest Model) - Blue</h3>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <div class="d-flex flex-wrap">
                            <div class="min-w-fit-content me-2">
                                <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                                <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                                <span class="text-warning"><i class="bi bi-star-fill"></i></span>
                                <span class="text-warning"><i class="bi bi-star-half"></i></span>
                            </div>
                            <p class="fw-semibold mb-0">(6548)</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <p class="m-0 text-success fw-semibold">623 reviews</p>
                            <p class="m-0 fw-medium fs-13 text-muted">1,919 Sold</p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center">
                        <h1 class="me-3">$1,349.99</h1>
                        <p class="text-body text-decoration-line-through fs-6 mb-0 me-3">$1,499.99</p>
                        <p class="text-warning fw-bolder fs-6 mb-0">10% off</p>
                    </div>
                    <p class="text-danger fw-bold mb-5">Special offer ends in 23:00:45 hours</p>

                    <p class="text-capitalize fw-semibold mb-2">Select Color</p>
                    <div class="d-flex flex-wrap gap-2 custom-checkbox">
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="Out of Stock">
                            <input type="checkbox" class="btn-check" id="btn-check-black">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-black">Black</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="Out of Stock">
                            <input type="checkbox" class="btn-check" id="btn-check-cream">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-cream">Cream</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="04 Item Left">
                            <input type="checkbox" class="btn-check" id="btn-check-green" checked>
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-green">Green</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="3 Item Left">
                            <input type="checkbox" class="btn-check" id="btn-check-blue">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-blue">Blue</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="08 Item Left">
                            <input type="checkbox" class="btn-check" id="btn-check-red">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-red">Red</label>
                        </div>
                    </div>

                    <p class="text-capitalize fw-semibold mb-2 mt-5">Select Size <span
                            class="text-danger fs-12 fw-normal"><i
                                class="bi bi-patch-check-fill fs-12 mx-1 cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                data-bs-title="Next stock will be available in 20 days"></i>Only 5 Stocks Left!</span>
                    </p>
                    <div class="d-flex flex-wrap gap-2 custom-checkbox mb-5">
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="Out of Stock">
                            <input type="checkbox" class="btn-check" id="btn-check-xs">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-xs">XS</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="05 Item Left">
                            <input type="checkbox" class="btn-check" id="btn-check-s">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-s">S</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="07 Item Left">
                            <input type="checkbox" class="btn-check" id="btn-check-m">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-m">M</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="Out of Stock">
                            <input type="checkbox" class="btn-check" id="btn-check-l">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-l">L</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="Out of Stock">
                            <input type="checkbox" class="btn-check" id="btn-check-xl">
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-xl">XL</label>
                        </div>
                        <div data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                            data-bs-title="09 Item Left">
                            <input type="checkbox" class="btn-check" id="btn-check-xxl" checked>
                            <label class="btn btn-sm rounded-2 fs-14 lh-base mb-0" for="btn-check-xxl">XXL</label>
                        </div>
                    </div>

                    <label class="form-label fw-medium" for="qty-touchspin">Qty</label>
                    <div class="qty-input mb-5">
                        <button type="button" data-action="minus">
                            <i class="ri-subtract-line"></i>
                        </button>
                        <input id="qty-touchspin" type="number" value="2" min="0" max="100">
                        <button type="button" data-action="plus">
                            <i class="ri-add-line"></i>
                        </button>
                    </div>

                    <a href="apps-product-cart" class="btn btn-primary w-100 mb-4">
                        <i class="ri-shopping-bag-line fs-5 me-2"></i>Add to Cart
                    </a>

                    <div class="row g-4">
                        <div class="col-6"><button type="button"
                                class="btn btn-outline-primary w-100 hstack justify-content-center gap-2"><i
                                    class="ri-heart-line fs-5"></i>Wishlist</button></div>
                        <div class="col-6"><button type="button"
                                class="btn btn-outline-primary w-100 hstack justify-content-center gap-2"
                                data-bs-toggle="modal" data-bs-target="#shareModal"><i
                                    class="ri-share-line fs-5"></i>Share</button></div>
                    </div>

                    <div class="p-4 border border-dashed rounded mt-5 bg-light bg-opacity-30">
                        <div
                            class="d-flex flex-wrap align-items-center justify-content-between row-gap-2 column-gap-4 border-bottom pb-4 mb-4">
                            <div class="d-flex align-items-center text-nowrap">
                                <i class="ri-store-2-line me-1 align-middle"></i>
                                <p class="mb-0">SRBThemes</p>
                                <i class="bi bi-patch-check-fill text-primary ms-1"></i>
                            </div>
                            <div class="d-flex flex-wrap gap-2 text-nowrap">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <p class="fw-semibold mb-0">(4.8)</p>
                                    <p class="m-0 text-success fw-semibold">17.5k reviews</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-1 text-nowrap">
                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                <p class="mb-0 fw-medium">New york, USA</p>
                            </div>
                            <button class="btn btn-sm btn-light-primary text-uppercase text-nowrap" type="button">Visit
                                Store</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Descriptions -->
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs-bordered mb-5" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#product-desc" role="tab"
                            aria-selected="true" tabindex="-1">
                            <span>Description</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#product-specification" role="tab"
                            aria-selected="false">
                            <span>Specification</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#product-reting" role="tab"
                            aria-selected="false">
                            <span>Review Rating</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active show" id="product-desc" role="tabpanel">
                        <h6>Discription</h6>
                        <p class="fs-13 text-muted">Tommy Hilfiger men striped pink sweatshirt. Crafted with cotton.
                            Material composition is 100% organic cotton. This is one of the world’s leading designer
                            lifestyle brands and is internationally recognized for celebrating the essence of classic
                            American cool style, featuring preppy with a twist designs.</p>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <h6>Features :</h6>
                                    <ul class="list-unstyled mb-0 fs-13 vstack gap-1">
                                        <li class="text-muted"><i
                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>Full
                                            Sleeve</li>
                                        <li class="text-muted"><i
                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>Cotton
                                        </li>
                                        <li class="text-muted"><i
                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>All
                                            Sizes available</li>
                                        <li class="text-muted"><i
                                                class="mdi mdi-circle-medium me-1 text-muted align-middle"></i>4
                                            Different Color</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mt-3">
                                    <h6>Services :</h6>
                                    <ul class="list-unstyled mb-0 fs-13 vstack gap-1">
                                        <li class="text-muted">10 Days Replacement</li>
                                        <li class="text-muted">Cash on Delivery available</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="product-specification" role="tabpanel">
                        <p class="card-text fs-13">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis ut risus.
                            Sedcus faucibus an sullamcorper mattis drostique des commodo pharetras loremos.Donec pretium
                            egestas sapien et mollis. Pellentesque diam dolor cosmopolis etos lobortis.</p>
                        <div class="table-responsive w-max">
                            <table class="table table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="min-w-128px">Category</th>
                                        <td>T-Shirt</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Brand</th>
                                        <td>Tommy Hilfiger</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Color</th>
                                        <td>Blue</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Material</th>
                                        <td>Cotton</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Weight</th>
                                        <td>140 Gram</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="product-reting" role="tabpanel">
                        <div class="hstack align-items-center mb-3">
                            <h5 class="mb-0 flex-grow-1">Reviews</h5>
                            <button class="btn btn-sm btn-primary flex-shrink-0" data-bs-toggle="modal"
                                data-bs-target="#editModal">Add Review</button>
                        </div>
                        <div class="border border-dashed rounded mb-10 p-4">
                            <div class="row g-3 g-md-0">
                                <div
                                    class="col-md-5 border-end-md d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3">
                                    <div id="review-chart"></div>
                                    <div>
                                        <div
                                            class="text-muted fs-20 mb-2 d-flex align-items-center justify-content-center justify-content-sm-start gap-1">
                                            <i class="ri-star-fill text-warning"></i>
                                            <i class="ri-star-fill text-warning"></i>
                                            <i class="ri-star-fill text-warning"></i>
                                            <i class="ri-star-fill text-warning"></i>
                                            <i class="ri-star-line text-muted"></i>
                                        </div>
                                        <h5 class="mb-1 fw-semibold text-center text-sm-start">95% of buyers are
                                            satisfied</h5>
                                        <div
                                            class="d-flex align-items-center gap-2 justify-content-center justify-content-sm-start">
                                            <p class="mb-0 text-muted fs-13">96 Rating</p>
                                            <span
                                                class="bg-secondary-subtle h-6px w-6px rounded-circle inline-block"></span>
                                            <p class="mb-0 text-muted fs-13">125 Reviews</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7 text-nowrap d-flex flex-column justify-content-between px-sm-6">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">5<i
                                                class="ri-star-fill text-warning"></i></span>
                                        <div class="progress progress-sm flex-grow-1" role="progressbar"
                                            aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar w-75"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0">128</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">4<i
                                                class="ri-star-fill text-warning"></i></span>
                                        <div class="progress progress-sm flex-grow-1" role="progressbar"
                                            aria-valuenow="24" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar w-25"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0">40</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">3<i
                                                class="ri-star-fill text-warning"></i></span>
                                        <div class="progress progress-sm flex-grow-1" role="progressbar"
                                            aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: 12%"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0">12</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">2<i
                                                class="ri-star-fill text-warning"></i></span>
                                        <div class="progress progress-sm flex-grow-1" role="progressbar"
                                            aria-valuenow="7" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: 7%"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0">7</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">1<i
                                                class="ri-star-fill text-warning"></i></span>
                                        <div class="progress progress-sm flex-grow-1" role="progressbar"
                                            aria-valuenow="2" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar" style="width: 2%"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0">2</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush bg-transparent">
                            <li
                                class="list-group-item px-0 pt-0 pb-5 mb-5 border-0 border-bottom d-flex delete-element bg-transparent">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user image"
                                        class="avatar rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="hstack justify-content-between gap-2 mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1">John Smith <small class="text-muted">on 14 Jan,
                                                    2024</small></h5>
                                            <div class="text-muted">
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-line text-muted"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown flex-shrink-0">
                                            <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#shareModal">Share</a></li>
                                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#editModal">Edit</a></li>
                                                <li><a class="dropdown-item delete-item delete-btn"
                                                        href="#!">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate-2">Since the spring loaded event, I've been
                                        wanting an iMac, and it's exceeded my expectations. The screen is clear, the
                                        colors are vibrant (I got the blue one! ), and the performance is more than
                                        adequate for my needs as a college student. That's how good it is.</p>
                                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                        aria-pressed="false">
                                        <span class="icon-on">
                                            <i class="ri-thumb-up-fill"></i>
                                        </span>
                                        <span class="icon-off">
                                            <i class="ri-thumb-up-line"></i>
                                        </span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                        aria-pressed="false">
                                        <span class="icon-on">
                                            <i class="ri-thumb-down-fill"></i>
                                        </span>
                                        <span class="icon-off">
                                            <i class="ri-thumb-down-line"></i>
                                        </span>
                                    </button>
                                </div>
                            </li>
                            <li class="list-group-item p-0 d-flex delete-element bg-transparent">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user image"
                                        class="avatar rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="hstack justify-content-between gap-2 mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="fs-13 mb-1">John Smith <small class="text-muted">on 14 Jan,
                                                    2024</small></h5>
                                            <div class="text-muted">
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-fill text-warning"></i>
                                                <i class="ri-star-line text-muted"></i>
                                            </div>
                                        </div>
                                        <div class="dropdown flex-shrink-0">
                                            <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#shareModal">Share</a></li>
                                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#editModal">Edit</a></li>
                                                <li><a class="dropdown-item delete-item delete-btn"
                                                        href="#!">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate-2">Since the spring loaded event, I've been
                                        wanting an iMac, and it's exceeded my expectations. The screen is clear, the
                                        colors are vibrant (I got the blue one! ), and the performance is more than
                                        adequate for my needs as a college student. That's how good it is.</p>
                                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                        aria-pressed="false">
                                        <span class="icon-on">
                                            <i class="ri-thumb-up-fill"></i>
                                        </span>
                                        <span class="icon-off">
                                            <i class="ri-thumb-up-line"></i>
                                        </span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                        aria-pressed="false">
                                        <span class="icon-on">
                                            <i class="ri-thumb-down-fill"></i>
                                        </span>
                                        <span class="icon-off">
                                            <i class="ri-thumb-down-line"></i>
                                        </span>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Add Review</h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close"><i class="ri-close-large-line fw-semibold"></i></button>
                </div>
                <div class="modal-body">

                    <h5>Write your review</h5>
                    <p class="text-muted">Your email address will not be published. Required fields are marked*</p>

                    <form class="mt-6">
                        <div class="mb-3 d-flex gap-3 align-items-center">
                            <label for="yourRating" class="form-label">Your Rating*</label>
                            <select id="yourRating" class="star-rating-prebuilt">
                                <option value="Select a rating">Select a rating</option>
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2" selected>2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="reviewName" class="form-label">Name *</label>
                            <input type="text" class="form-control" id="reviewName">
                        </div>
                        <div class="mb-3">
                            <label for="reviewMessage" class="form-label">Message *</label>
                            <textarea class="form-control" id="reviewMessage" rows="3" placeholder="Write your message"></textarea>
                        </div>
                        <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary"
                                data-bs-dismiss="modal" aria-label="Close">Submit</button></div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>

    <!-- Star Rating js -->
    <script src="{{ asset('assets/libs/star-rating.js/star-rating.min.js') }}"></script>

    <!-- Swiper init -->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Product Details init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-product-details.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
