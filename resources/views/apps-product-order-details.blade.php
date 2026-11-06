@extends('partials.layouts.master3')

@section('title', 'Order Details | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Order Detials')
@section('pagetitle', 'Ecommerce')
@section('buttonTitle', 'Add Order')
@section('link', '#!')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection
@section('content')

    <div class="row g-4">
        <div class="col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Order Number #252526</h5>
                        <button type="button" class="btn btn-sm btn-light-primary">Download Invoice</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <thead class="bg-light bg-opacity-30">
                                <tr>
                                    <th>Product Name &amp; Size</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Tax</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/images/product/product-2.jpg') }}"
                                                alt="product image" class="avatar border-0 rounded flex-shrink-0">
                                            <div class="flex-grow-1 overflow-hidden max-w-500px text-truncate">
                                                <a href="apps-product-details" class="text-body fw-medium">Gabrielle Chanel
                                                    Perfume</a>
                                                <p class="text-muted mb-0 fs-12"><span>Size : </span>Small</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success-subtle fw-medium text-success">Ready</span></td>
                                    <td>1</td>
                                    <td>$80.00</td>
                                    <td>$3.00</td>
                                    <td>$83.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/images/product/product-3.jpg') }}"
                                                alt="product image" class="avatar border-0 rounded flex-shrink-0">
                                            <div class="flex-grow-1 overflow-hidden max-w-500px text-truncate">
                                                <a href="apps-product-details" class="text-body fw-medium">SoundMaster
                                                    Wireless Headphones</a>
                                                <p class="text-muted mb-0 fs-12"><span>Color : </span>Black</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge fw-medium bg-light text-body-emphasis">Packaging</span></td>
                                    <td>3</td>
                                    <td>$330.00</td>
                                    <td>$4.00</td>
                                    <td>$334.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/images/product/product-5.jpg') }}"
                                                alt="product image" class="avatar border-0 rounded flex-shrink-0">
                                            <div class="flex-grow-1 overflow-hidden max-w-500px text-truncate">
                                                <a href="apps-product-details" class="text-body fw-medium">Wireless
                                                    Earbuds</a>
                                                <p class="text-muted mb-0 fs-12"><span>Color : </span>White</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge fw-medium bg-success-subtle text-success">Ready</span></td>
                                    <td>1</td>
                                    <td>$132.00</td>
                                    <td>$5.00</td>
                                    <td>$137.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('assets/images/product/product-7.jpg') }}"
                                                alt="product image" class="avatar border-0 rounded flex-shrink-0">
                                            <div class="flex-grow-1 overflow-hidden max-w-500px text-truncate">
                                                <a href="apps-product-details" class="text-body fw-medium">Men's T-shirt</a>
                                                <p class="text-muted mb-0 fs-12"><span>Size : </span>S</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge fw-medium bg-light text-body-emphasis">Packaging</span></td>
                                    <td>2</td>
                                    <td>$220.00</td>
                                    <td>$3.00</td>
                                    <td>$223.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive p-4">
                        <table class="table table-sm table-borderless table-nowrap align-middle mb-0 ms-auto max-w-256px">
                            <tbody>
                                <tr>
                                    <td class="fw-medium pt-0">Subtotal:</td>
                                    <td class="text-end pt-0">$244.98</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Discount (10%):</td>
                                    <td class="text-end">- $24.50</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-medium pb-3">Sales Tax (8%):</td>
                                    <td class="text-end pb-3">$17.77</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold fs-5 pb-0">Total:</td>
                                    <td class="text-end fs-5 text-success fw-bold pb-0">$248.25</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">

                    <ul class="timeline-box mb-0">

                        <!-- Order Placed -->
                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                    <i class="ri ri-shopping-bag-line text-primary fs-18 lh-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content p-0">
                                <div
                                    class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-body-emphasis fw-medium">Order has been placed</h5>
                                        <p class="mb-0 text-muted fs-12">Confirmed by <a href="#!">John Doe</a></p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <p class="mb-0 text-muted fs-13">April 23, 2024, 09:40 am</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Order Payment -->
                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                    <i class="ri ri-money-dollar-circle-line text-success fs-18 lh-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content p-0">
                                <div
                                    class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-body-emphasis fw-medium">Order payment completed</h5>
                                        <p class="mb-1 text-muted fs-12">Paid via Credit Card (MasterCard)</p>
                                        <div class="d-flex align-items-center gap-2">
                                            <p class="mb-0 fs-12 fw-medium">Status :</p>
                                            <span class="badge bg-success-subtle text-success">Paid</span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <p class="mb-0 text-muted fs-13">April 23, 2024, 09:50 am</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Invoice Sent -->
                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                    <i class="ri ri-mail-send-line text-info fs-18 lh-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content p-0">
                                <div
                                    class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-body-emphasis fw-medium">Invoice has been sent to the customer
                                        </h5>
                                        <p class="mb-0 text-muted fs-12 mb-2">Invoice email was sent to <a href="#!"
                                                class="link-primary">sup.srbthemes@gmail.com</a></p>
                                        <button class="btn btn-sm btn-light-primary">Resend Invoice</button>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <p class="mb-0 text-muted fs-13">April 23, 2024, 10:30 am</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Invoice Created -->
                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                    <i class="ri ri-file-list-2-line text-primary fs-18 lh-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content p-0">
                                <div
                                    class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-body-emphasis fw-medium">Invoice has been created</h5>
                                        <p class="mb-0 text-muted fs-12 mb-3">Invoice created by Admin</p>
                                        <div
                                            class="d-flex flex-wrap gap-3 border border-dashed p-3 rounded position-relative bg-light bg-opacity-20 shadow-sm max-w-500px">
                                            <div class="avatar-item avatar bg-light text-primary">
                                                <i class="ri-file-pdf-line fs-20"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-medium">Marketing Workshop Invoice - PDF</h6>
                                                <small class="text-muted fs-12">File Size: 1.2 MB</small>
                                            </div>
                                            <div class="align-self-center">
                                                <button class="btn btn-outline-primary btn-sm">Download Invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <p class="mb-0 text-muted fs-13">April 23, 2024, 10:45 am</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Order Packed -->
                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                    <i class="bi bi-bag-check text-info fs-18 lh-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content p-0">
                                <div
                                    class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-body-emphasis fw-medium">Order has been packed</h5>
                                        <p class="mb-0 text-muted fs-12">Packing confirmed by Warehouse Team</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <p class="mb-0 text-muted fs-13">April 23, 2024, 11:30 am</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Order Shipped -->
                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                    <i class="ri ri-truck-line text-info fs-18 lh-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content p-0">
                                <div
                                    class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-body-emphasis fw-medium">Order has been shipped</h5>
                                        <p class="mb-0 text-muted fs-12 mb-2">Shipped via UPS</p>
                                        <button class="btn btn-sm btn-light-primary">Track Shipment</button>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <p class="mb-0 text-muted fs-13">April 23, 2024, 02:00 pm</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Order Delivered -->
                        <li class="timeline-section pb-0">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                    <i class="ri ri-check-double-line text-success fs-18 lh-1"></i>
                                </div>
                            </div>
                            <div class="timeline-content p-0">
                                <div
                                    class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 text-body-emphasis fw-medium">Order has been delivered</h5>
                                        <p class="mb-1 text-muted fs-12">Delivered to customer’s address</p>
                                        <div class="d-flex align-items-center gap-2">
                                            <p class="mb-0 fs-12 fw-medium">Status :</p>
                                            <span class="badge bg-success-subtle text-success">Delivered</span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <p class="mb-0 text-muted fs-13">April 24, 2024, 11:15 am</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Customer details</h6>
                </div>
                <div class="card-body text-center">
                    <div class="avatar-xl overflow-hidden mx-auto mb-3">
                        <img src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" class="img-fluid" alt="user Image">
                    </div>
                    <div class="d-flex flex-column">
                        <a href="#!" class="text-body text-nowrap">
                            <h5 class="mb-0">Shamus Tuttle</h5>
                        </a>
                        <span class="text-muted fs-13">Customer ID: #58909</span>
                    </div>
                </div>
                <div class="card-body border-top">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2 d-flex align-items-center justify-content-between gap-2">
                            <span class="fw-medium text-body">Payment Mode:</span>
                            <span class="text-muted fs-12">COD</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center justify-content-between gap-2">
                            <span class="fw-medium text-body">Phone:</span>
                            <span class="text-muted fs-12">+1 (234) 567-8901</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between gap-2">
                            <span class="fw-medium text-body">Email:</span>
                            <span class="text-muted fs-12">L4hQg@example.com</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer border-top">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <a href="pages-profile-overview" class="btn btn-sm btn-outline-primary">Profile</a>
                        <a href="apps-chat" class="btn btn-sm btn-outline-secondary">Message</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between gap-2">
                    <h6 class="card-title mb-0 flex-grow-1">Shipping address</h6>
                    <button class="btn btn-light-primary btn-sm flex-shrink-0" data-bs-toggle="modal"
                        data-bs-target="#addNewAddress">Add</button>
                </div>
                <div class="card-body">
                    <span class="text-muted align-middle fs-12 fw-normal">45 Roker Terrace <br>Latheronwheel <br>KW5
                        8NW,London <br>UK</span>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header d-flex align-items-center justify-content-between gap-2">
                    <h6 class="card-title mb-0 flex-grow-1">Billing address</h6>
                    <button class="btn btn-light-primary btn-sm flex-shrink-0" data-bs-toggle="modal"
                        data-bs-target="#addNewAddress">Add</button>
                </div>
                <div class="card-body">
                    <span class="text-muted align-middle fs-12 fw-normal">45 Roker Terrace <br>Latheronwheel <br>KW5
                        8NW,London <br>UK</span>
                    <div class="d-flex align-items-center gap-2 mt-3 border p-3 rounded">
                        <img class="w-40px flex-shrink-0"
                            src="{{ asset('assets/images/payment-method/mastercard.svg') }}" alt="mastercard">
                        <div class="d-flex flex-column flex-grow-1">
                            <h6 class="mb-0">Mastercard</h6>
                            <span class="fs-13 text-muted">Card Number: *****4291</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- Order Details init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-projects-create.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
