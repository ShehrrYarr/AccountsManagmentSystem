@extends('partials.layouts.master3')

@section('title', 'Products Cart | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Shopping Cart')
@section('pagetitle', 'Ecommerce')
@section('buttonTitle', 'Back to Shopping')
@section('link', 'apps-products')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
    <!--Quill Editor css-->
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 col-xl-9">

            <div class="card card-body d-flex flex-column justify-content-center">
                <p class="fw-semibold text-center mb-4">Great! You have been <span
                        class="text-primary text-uppercase fw-medium">free shipping</span>, Only $14.25 away from getting
                    <span class="text-primary text-uppercase fw-semibold">3% extra cashback</span></p>
                <div class="d-flex gap-3 w-100 max-w-800px mx-auto">
                    <span class="flex-shrink-0 text-muted fs-12">$0</span>
                    <div class="flex-grow-1">
                        <div class="progress progress-sm w-100 mt-1" role="progressbar" aria-label="Warning striped example"
                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-primary w-50"></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-7 text-end">
                                <p class="mb-0 text-uppercase fs-12 fw-semibold mt-1">Free Shipping</p>
                            </div>
                            <div class="col-5 text-center">
                                <p class="mb-0 text-uppercase fs-12 fw-semibold mt-1">3% cashback</p>
                            </div>
                        </div>
                    </div>
                    <span class="flex-shrink-0 text-muted fs-12">$85</span>
                </div>
            </div>

            <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="fs-14 mb-0">Your Cart (03 items)</h5>
                    <a href="#!" class="text-muted fs-12">Clear Cart</a>
                </div>
                <div class="product-cart-scrollbar" data-simplebar>
                    <div class="card-body border-bottom">
                        <div class="row gy-2">
                            <div class="col-12 col-sm-auto">
                                <div class="h-100px w-80px position-relative rounded-1 overflow-hidden">
                                    <img src="{{ asset('assets/images/product/product-2.jpg') }}" alt="Product Image"
                                        class="img-fluid h-100 object-fit-cover">
                                    <div
                                        class="position-absolute end-0 top-0 bg-body-secondary rounded-circle p-1 m-1 h-20px w-20px d-flex align-items-center justify-content-center">
                                        <a href="#!"
                                            class="text-body d-flex align-items-center justify-content-center"><i
                                                class="ri-delete-bin-line fs-12"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="apps-product-details" class="fw-medium text-body h5">Gabrielle Chanel Perfume</a>
                                <div class="d-flex align-items-center gap-2 mb-1 mt-1 fs-12">
                                    <p class="mb-0 fw-medium">Color : <span class="text-muted"> Dark </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium">Size : <span class="text-muted"> M </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium text-success">In Stock</p>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="text-warning fs-12">
                                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-half-fill"></i>
                                    </div>
                                    <span class="text-muted fs-12">(150 reviews)</span>
                                </div>
                                <div class="qty-input qty-input-sm mt-2">
                                    <button type="button" data-action="minus">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input id="cart-product-item-1" type="number" value="2" min="0"
                                        max="100">
                                    <button type="button" data-action="plus">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="text-lg-end">
                                    <p class="text-muted mb-1">Items Price</p>
                                    <h6 class="text-danger">$<span>149.99</span><small
                                            class="text-muted fs-11 fw-medium text-decoration-line-through ms-1">$299.99</small>
                                    </h6>
                                </div>
                                <a href="#!" class="d-block fs-13 text-muted mt-1" aria-label="Add to wishlist">
                                    <i class="ri-heart-line text-muted align-bottom me-1"></i>Add to Wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <div class="row gy-2">
                            <div class="col-12 col-sm-auto">
                                <div class="h-100px w-80px position-relative rounded-1 overflow-hidden">
                                    <img src="{{ asset('assets/images/product/product-3.jpg') }}" alt="Product Image"
                                        class="img-fluid h-100 object-fit-cover">
                                    <div
                                        class="position-absolute end-0 top-0 bg-body-secondary rounded-circle p-1 m-1 h-20px w-20px d-flex align-items-center justify-content-center">
                                        <a href="#!"
                                            class="text-body d-flex align-items-center justify-content-center"><i
                                                class="ri-delete-bin-line fs-12"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="apps-product-details" class="fw-medium text-body h5">SoundMaster Wireless
                                    Headphones</a>
                                <div class="d-flex align-items-center gap-2 mb-1 mt-1 fs-12">
                                    <p class="mb-0 fw-medium">Color : <span class="text-muted"> Dark </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium">Size : <span class="text-muted"> M </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium text-muted">Available in 2 days</p>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="text-warning fs-12">
                                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-half-fill"></i>
                                    </div>
                                    <span class="text-muted fs-12">(150 reviews)</span>
                                </div>
                                <div class="qty-input qty-input-sm mt-2">
                                    <button type="button" data-action="minus">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input id="cart-product-item-2" type="number" value="2" min="0"
                                        max="100">
                                    <button type="button" data-action="plus">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="text-lg-end">
                                    <p class="text-muted mb-1">Items Price</p>
                                    <h6 class="text-danger">$<span>149.99</span><small
                                            class="text-muted fs-11 fw-medium text-decoration-line-through ms-1">$299.99</small>
                                    </h6>
                                </div>
                                <a href="#!" class="d-block fs-13 text-muted mt-1" aria-label="Add to wishlist">
                                    <i class="ri-heart-line text-muted align-bottom me-1"></i>Add to Wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <div class="row gy-2">
                            <div class="col-12 col-sm-auto">
                                <div class="h-100px w-80px position-relative rounded-1 overflow-hidden">
                                    <img src="{{ asset('assets/images/product/product-5.jpg') }}" alt="Product Image"
                                        class="img-fluid h-100 object-fit-cover">
                                    <div
                                        class="position-absolute end-0 top-0 bg-body-secondary rounded-circle p-1 m-1 h-20px w-20px d-flex align-items-center justify-content-center">
                                        <a href="#!"
                                            class="text-body d-flex align-items-center justify-content-center"><i
                                                class="ri-delete-bin-line fs-12"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="apps-product-details" class="fw-medium text-body h5">Wireless Earbuds</a>
                                <div class="d-flex align-items-center gap-2 mb-1 mt-1 fs-12">
                                    <p class="mb-0 fw-medium">Color : <span class="text-muted"> Dark </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium">Size : <span class="text-muted"> M </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium text-muted">Available in 2 days</p>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="text-warning fs-12">
                                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-half-fill"></i>
                                    </div>
                                    <span class="text-muted fs-12">(150 reviews)</span>
                                </div>
                                <div class="qty-input qty-input-sm mt-2">
                                    <button type="button" data-action="minus">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input id="cart-product-item-3" type="number" value="2" min="0"
                                        max="100">
                                    <button type="button" data-action="plus">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="text-lg-end">
                                    <p class="text-muted mb-1">Items Price</p>
                                    <h6 class="text-danger">$<span>149.99</span><small
                                            class="text-muted fs-11 fw-medium text-decoration-line-through ms-1">$299.99</small>
                                    </h6>
                                </div>
                                <a href="#!" class="d-block fs-13 text-muted mt-1" aria-label="Add to wishlist">
                                    <i class="ri-heart-line text-muted align-bottom me-1"></i>Add to Wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom">
                        <div class="row gy-2">
                            <div class="col-12 col-sm-auto">
                                <div class="h-100px w-80px position-relative rounded-1 overflow-hidden">
                                    <img src="{{ asset('assets/images/product/product-6.jpg') }}" alt="Product Image"
                                        class="img-fluid h-100 object-fit-cover">
                                    <div
                                        class="position-absolute end-0 top-0 bg-body-secondary rounded-circle p-1 m-1 h-20px w-20px d-flex align-items-center justify-content-center">
                                        <a href="#!"
                                            class="text-body d-flex align-items-center justify-content-center"><i
                                                class="ri-delete-bin-line fs-12"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="apps-product-details" class="fw-medium text-body h5">Luxury Sunglasses</a>
                                <div class="d-flex align-items-center gap-2 mb-1 mt-1 fs-12">
                                    <p class="mb-0 fw-medium">Color : <span class="text-muted"> Dark </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium">Size : <span class="text-muted"> M </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium text-muted">Available in 2 days</p>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="text-warning fs-12">
                                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-half-fill"></i>
                                    </div>
                                    <span class="text-muted fs-12">(150 reviews)</span>
                                </div>
                                <div class="qty-input qty-input-sm mt-2">
                                    <button type="button" data-action="minus">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input id="cart-product-item-4" type="number" value="2" min="0"
                                        max="100">
                                    <button type="button" data-action="plus">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="text-lg-end">
                                    <p class="text-muted mb-1">Items Price</p>
                                    <h6 class="text-danger">$<span>149.99</span><small
                                            class="text-muted fs-11 fw-medium text-decoration-line-through ms-1">$299.99</small>
                                    </h6>
                                </div>
                                <a href="#!" class="d-block fs-13 text-muted mt-1" aria-label="Add to wishlist">
                                    <i class="ri-heart-line text-muted align-bottom me-1"></i>Add to Wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-2">
                            <div class="col-12 col-sm-auto">
                                <div class="h-100px w-80px position-relative rounded-1 overflow-hidden">
                                    <img src="{{ asset('assets/images/product/product-4.jpg') }}" alt="Product Image"
                                        class="img-fluid h-100 object-fit-cover">
                                    <div
                                        class="position-absolute end-0 top-0 bg-body-secondary rounded-circle p-1 m-1 h-20px w-20px d-flex align-items-center justify-content-center">
                                        <a href="#!"
                                            class="text-body d-flex align-items-center justify-content-center"><i
                                                class="ri-delete-bin-line fs-12"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <a href="apps-product-details" class="fw-medium text-body h5">Cocooil Body Oil</a>
                                <div class="d-flex align-items-center gap-2 mb-1 mt-1 fs-12">
                                    <p class="mb-0 fw-medium">Color : <span class="text-muted"> Dark </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium">Size : <span class="text-muted"> M </span></p>
                                    <div class="text-muted h-12px min-h-12px my-auto vr"></div>
                                    <p class="mb-0 fw-medium text-danger">Out in stock</p>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <div class="text-warning fs-12">
                                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-fill"></i><i class="ri-star-fill"></i><i
                                            class="ri-star-half-fill"></i>
                                    </div>
                                    <span class="text-muted fs-12">(150 reviews)</span>
                                </div>
                                <div class="qty-input qty-input-sm mt-2">
                                    <button type="button" data-action="minus">
                                        <i class="ri-subtract-line"></i>
                                    </button>
                                    <input id="cart-product-item-5" type="number" value="2" min="0"
                                        max="100">
                                    <button type="button" data-action="plus">
                                        <i class="ri-add-line"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="text-lg-end">
                                    <p class="text-muted mb-1">Items Price</p>
                                    <h6 class="text-danger">$<span>149.99</span><small
                                            class="text-muted fs-11 fw-medium text-decoration-line-through ms-1">$299.99</small>
                                    </h6>
                                </div>
                                <a href="#!" class="d-block fs-13 text-muted mt-1" aria-label="Add to wishlist">
                                    <i class="ri-heart-line text-muted align-bottom me-1"></i>Add to Wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4 col-xl-3">

            <div class="card mb-0">
                <div class="card-body border-bottom border-block-end-dashed">
                    <label for="promoCode" class="fw-medium mb-0">Have a Promo Code?</label>
                    <div class="fs-11 text-muted mb-3">Apply a promo code to get an instant discount on your order!</div>
                    <div class="input-group mb-0">
                        <input type="text" class="form-control form-control-sm" id="promoCode" name="promoCode"
                            placeholder="Enter Promo Code" aria-label="Enter Promo Code"
                            aria-describedby="applyPromoBtn">
                        <button class="btn btn-primary" type="button" id="applyPromoBtn">Apply</button>
                    </div>
                </div>

                <div class="card-body pb-0">
                    <p class="mb-3 fw-semibold">Delivery Options:</p>
                    <ul class="nav nav-pills nav-justified active-success bg-light rounded" id="deliveryTabs"
                        role="tablist">
                        <li class="nav-item flex-fill me-0" role="presentation">
                            <button class="nav-link w-100 active" id="freeShippingTab" data-bs-toggle="tab"
                                data-bs-target="#freeShippingPane" type="button" role="tab"
                                aria-controls="freeShippingPane" aria-selected="true">Free</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="expressShippingTab" data-bs-toggle="tab"
                                data-bs-target="#expressShippingPane" type="button" role="tab"
                                aria-controls="expressShippingPane" aria-selected="false" tabindex="-1">Express</button>
                        </li>
                    </ul>
                </div>

                <div class="card-body tab-content">
                    <div class="tab-pane overflow-hidden p-0 border-0 active show" id="freeShippingPane" role="tabpanel"
                        aria-labelledby="freeShippingTab" tabindex="0">
                        <div class="fs-12 text-muted mb-3"><i class="ri-information-fill"></i> Delivered in 5-7 Business
                            Days</div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fs-12 text-muted">Sub Total</div>
                            <div class="fw-medium">$3,499</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fs-12 text-muted">Discount</div>
                            <div class="fw-medium text-success">20% - $699.80</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fs-12 text-muted">Delivery Charges</div>
                            <div class="fw-medium text-danger">Free</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fs-12 text-muted">Service Tax (18%)</div>
                            <div class="fw-medium">- $10.80</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between my-4 h5">
                            <div class="fs-16">Total :</div>
                            <div class="fw-semibold">$2,789.20</div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <a href="apps-product-checkout" class="btn btn-primary">Proceed to Checkout</a>
                            <a href="apps-products" class="btn btn-light-secondary">Continue Shopping</a>
                        </div>
                    </div>

                    <div class="tab-pane overflow-hidden p-0 border-0" id="expressShippingPane" role="tabpanel"
                        aria-labelledby="expressShippingTab" tabindex="0">
                        <div class="fs-12 text-muted mb-3"><i class="ri-information-fill"></i> Delivered by Tomorrow</div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fs-12 text-muted">Sub Total</div>
                            <div class="fw-medium">$3,499</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fs-12 text-muted">Discount</div>
                            <div class="fw-medium text-success">20% - $699.80</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fs-12 text-muted">Delivery Charges</div>
                            <div class="fw-medium text-danger">+ $25</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fs-12 text-muted">Service Tax (18%)</div>
                            <div class="fw-medium">- $10.80</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between my-4 h5">
                            <div class="fs-16">Total :</div>
                            <div class="fw-semibold">$2,814.20</div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <a href="#!" class="btn btn-primary">Proceed to Checkout</a>
                            <a href="#!" class="btn btn-light-secondary">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
