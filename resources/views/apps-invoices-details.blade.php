@extends('partials.layouts.master3')

@section('title', 'Invoice Details | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Invoice Details')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'View All')
@section('link', 'apps-invoices-list')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
    <!--Quill Editor css-->
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-xxl-9">
            <div class="card mb-0">
                <div class="card-body">
                    <!-- Store and Invoice Details -->
                    <div class="d-flex justify-content-between flex-column flex-sm-row">
                        <div>
                            <h5 class="fw-bold mb-5">SRBThemes</h5>
                            <address class="mt-6">
                                123 Online Shop Lane<br>
                                New York, NY 10001<br>
                                Email: <a href="mailto:sup.srbthemes@gmail.com"
                                    class="text-body">sup.srbthemes@gmail.com</a><br>
                                Phone: +1 (123) 456-7890
                            </address>
                        </div>
                        <div class="text-sm-end">
                            <h5 class="mb-6">INVOICE #123456</h5>
                            <div class="mb-1">
                                <span class="fw-semibold text-body">Date Issued:</span>
                                <span class="fs-13 text-muted">November 20, 2024</span>
                            </div>
                            <div class="mb-1">
                                <span class="fw-semibold text-body">Due Date:</span>
                                <span class="fs-13 text-muted">December 20, 2024</span>
                            </div>
                            <div class="mb-1">
                                <span class="fw-semibold text-body">Payment Method:</span>
                                <span class="fs-13 text-muted">Credit Card</span>
                            </div>
                            <div>
                                <span class="fw-semibold text-body">Payment Status:</span>
                                <span class="fs-13 text-success fw-medium">Paid</span>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-6">

                    <!-- Customer and Shipping Details -->
                    <div class="row d-flex justify-content-between mb-6 gy-4">
                        <div class="col-lg-4">
                            <h6 class="fw-semibold">Bill To:</h6>
                            <address class="mb-0">
                                John Doe<br>
                                456 Customer Rd.<br>
                                Los Angeles, CA 90001<br>
                                Email: <a href="mailto:johndoe@example.com" class="text-body">johndoe@example.com</a><br>
                                Phone: +1 (987) 654-3210
                            </address>
                        </div>
                        <div class="col-lg-4 ms-auto">
                            <h6 class="fw-semibold">Ship To:</h6>
                            <address class="mb-0">
                                John Doe<br>
                                456 Customer Rd.<br>
                                Los Angeles, CA 90001<br>
                                Email: <a href="mailto:johndoe@example.com" class="text-body">johndoe@example.com</a><br>
                                Phone: +1 (987) 654-3210
                            </address>
                        </div>
                    </div>

                    <!-- Order Summary Table -->
                    <div class="table-responsive border border-bottom-0 rounded text-nowrap">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Wireless Headphones</td>
                                    <td>Over-ear Bluetooth headphones with noise cancellation</td>
                                    <td>$99.99</td>
                                    <td>2</td>
                                    <td>$199.98</td>
                                </tr>
                                <tr>
                                    <td>Smartphone Case</td>
                                    <td>Durable case for iPhone 13</td>
                                    <td>$15.00</td>
                                    <td>1</td>
                                    <td>$15.00</td>
                                </tr>
                                <tr>
                                    <td>Portable Charger</td>
                                    <td>Fast-charging portable power bank</td>
                                    <td>$30.00</td>
                                    <td>1</td>
                                    <td>$30.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Financial Summary -->
                    <div class="table-responsive py-12">
                        <table class="table table-sm table-borderless table-nowrap align-middle mb-0 ms-auto max-w-256px">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">Subtotal:</td>
                                    <td class="text-end">$244.98</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Discount (10%):</td>
                                    <td class="text-end">- $24.50</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold">Sales Tax (8%):</td>
                                    <td class="text-end">$17.77</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Shipping:</td>
                                    <td class="text-end">$10.00</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold fs-5">Total:</td>
                                    <td class="text-end fs-5 text-success fw-bold">$248.25</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="mt-0 mb-6">

                    <!-- Additional Notes Section -->
                    <div class="row mb-2">
                        <div class="col-12">
                            <span class="fw-semibold">Note:</span>
                            <span>Thank you for shopping with us! We appreciate your business and hope you're satisfied with
                                your purchase. If you have any questions or need assistance with your order, feel free to
                                contact our customer service team at <a href="mailto:sup.srbthemes@gmail.com"
                                    class="text-body">sup.srbthemes@gmail.com</a>. We’re here to help!</span>
                        </div>
                    </div>
                </div>

                <!-- Footer Section -->
                <div class="card-footer bg-light bg-opacity-40 text-center">
                    <p class="mb-0">SRBThemes, 123 Online Shop Lane, New York, NY 10001</p>
                    <p class="text-muted small mb-0">Thank you for your purchase! Please visit again soon.</p>
                </div>

                <!-- Action Buttons -->
                <div class="card-footer border-0 d-flex justify-content-end align-items-center gap-2">
                    <a href="apps-invoices-print" target="_blank" class="btn btn-light">Print
                        <i class="ri-printer-line ms-1 align-middle d-inline-block"></i>
                    </a>
                    <button class="btn btn-primary">Download
                        <i class="ri-download-2-line align-bottom me-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <!-- Invoice init -->
    <script src="{{ asset('assets/js/apps/invoices/apps-invoice-manager.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
