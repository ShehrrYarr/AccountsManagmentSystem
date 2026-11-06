@extends('partials.layouts.master')

@section('title', 'Products List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Products List')
@section('pagetitle', 'Ecommerce')
@section('buttonTitle', 'Share')
@section('link', '#!')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

@section('content')

    <div class="card mb-0">
        <div class="card-body">
            <div class="hstack justify-content-between gap-3">
                <h5 class="card-title mb-0">Products List</h5>
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn icon-btn-sm active" data-bs-toggle="tab" href="#demo-tab-5_home"
                            role="tab" aria-selected="true" tabindex="-1">
                            <i class="ri-list-check"></i>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn icon-btn-sm" data-bs-toggle="tab" href="#demo-tab-5_profile" role="tab"
                            aria-selected="false">
                            <i class="ri-layout-grid-line"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-content mt-4">
        <div class="tab-pane active show" id="demo-tab-5_home" role="tabpanel">
            <div class="card mb-0">
                <div class="hstack column-gap-3 justify-content-between flex-wrap border-bottom border-light">
                    <ul class="nav column-gap-3 nav-tabs-bordered border-bottom-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2 py-4 active" id="pills-all-products-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-all-products" type="button" role="tab"
                                aria-controls="pills-all-products" aria-selected="true">
                                <i class="ri-inbox-fill"></i> All Products
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2 py-4" id="pills-public-products-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-public-products" type="button" role="tab"
                                aria-controls="pills-public-products" aria-selected="false">
                                <i class="ri-price-tag-3-fill"></i> Public Products
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center gap-2 py-4" id="pills-draft-products-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-draft-products" type="button" role="tab"
                                aria-controls="pills-draft-products" aria-selected="false">
                                <i class="ri-price-tag-3-fill"></i> Draft Products
                            </button>
                        </li>
                    </ul>
                    <div class="pe-4">
                        <input type="search" class="form-control form-control-sm" placeholder="Search Products"
                            id="searchProducts">
                    </div>
                </div>

                <div class="tab-content" id="productListTabContent">
                    <!-- All Products Table -->
                    <div class="tab-pane fade show active" id="pills-all-products" role="tabpanel"
                        aria-labelledby="pills-all-products-tab" tabindex="0">
                        <table class="table table-hover align-middle table-nowrap w-100" id="allProductsTable">
                            <thead class="bg-light bg-opacity-30">
                                <tr>
                                    <th class="px-5"></th>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>QTY</th>
                                    <th>Rating</th>
                                    <th>Vendor</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- Public Products Table -->
                    <div class="tab-pane fade" id="pills-public-products" role="tabpanel"
                        aria-labelledby="pills-public-products-tab" tabindex="0">
                        <table class="table table-hover align-middle table-nowrap w-100" id="publicProductsTable">
                            <thead class="bg-light bg-opacity-30">
                                <tr>
                                    <th class="px-5"></th>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>QTY</th>
                                    <th>Rating</th>
                                    <th>Vendor</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- Draft Products Table -->
                    <div class="tab-pane fade" id="pills-draft-products" role="tabpanel"
                        aria-labelledby="pills-draft-products-tab" tabindex="0">
                        <table class="table table-hover align-middle table-nowrap w-100" id="draftProductsTable">
                            <thead class="bg-light bg-opacity-30">
                                <tr>
                                    <th class="px-5"></th>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>QTY</th>
                                    <th>Rating</th>
                                    <th>Vendor</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane" id="demo-tab-5_profile" role="tabpanel">
            @include('partials.product-card-list')

            <!-- Pagination -->
            <nav class="hstack justify-content-center my-5" aria-label="Page navigation example">
                <ul class="pagination pagination-primary mb-0">
                    <li class="page-item">
                        <a class="page-link" href="#!">
                            <i class="ri-arrow-left-s-line fw-semibold"></i>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#!">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                    <li class="page-item"><a class="page-link" href="#!">3</a></li>
                    <li class="page-item"><a class="page-link" href="#!">4</a></li>
                    <li class="page-item"><a class="page-link" href="#!">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#!">
                            <i class="ri-arrow-right-s-line fw-semibold"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="modal fade" id="edit-teacher-profile" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Teacher Profile</h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                        <div class="avatar-item avatar-xl overflow-hidden">
                            <img class="img-fluid" alt="avatar image"
                                src="{{ asset('assets/images/avatar/avatar-1.jpg') }}">
                        </div>
                        <div>
                            <div class="hstack gap-3 mb-3">
                                <button class="btn btn-sm btn-light-primary">Upload</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </div>
                            <p class="mb-0 text-muted fs-13">Upload image size 4MB, Format JPG, PNG, SVG</p>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <label class="form-label" for="teacher-name">Name</label>
                            <input type="text" class="form-control" id="teacher-name" placeholder="Enter your name">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="teacher-designation">Designation</label>
                            <input type="text" class="form-control" id="teacher-designation"
                                placeholder="Enter your designation">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="teacher-email">Email</label>
                            <input type="email" class="form-control" id="teacher-email"
                                placeholder="Enter your email">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="teacher-phone">Phone Number</label>
                            <input type="number" class="form-control" id="teacher-phone"
                                placeholder="Enter your phone number">
                        </div>

                    </div>
                    <div class="row g-4 mt-3">

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="d-block flex-shrink-0 me-3">
                                    <div class="avatar-item border-0 avatar avatar-title text-primary bg-primary-subtle">
                                        <i class="ri-twitter-fill fs-20"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="twitter-username"
                                    placeholder="www.example.com" value="www.example.com">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="d-block flex-shrink-0 me-3">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-body-emphasis bg-dark-subtle">
                                        <i class="ri-github-fill fs-20"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="github-username" placeholder="Username"
                                    value="@daveadame">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="d-block flex-shrink-0 me-3">
                                    <div class="avatar-item border-0 avatar avatar-title text-info bg-info-subtle">
                                        <i class="ri-linkedin-fill fs-20"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="linkedin-username" placeholder="Username"
                                    value="@dave_adame">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="d-block flex-shrink-0 me-3">
                                    <div class="avatar-item border-0 avatar avatar-title text-danger bg-danger-subtle">
                                        <i class="ri-dribbble-fill fs-20"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="dribbble-username" placeholder="Username"
                                    value="@dave_adame">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- Product list init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-products-list.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
