@extends('partials.layouts.master3')

@section('title', 'Create Invoice | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Add Invoice')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'View All')
@section('link', 'apps-invoices-list')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
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
                        <div>
                            <h5 class="mb-6 d-flex align-items-center justify-content-end text-nowrap gap-2">INVOICE #
                                <input type="text" id="editInvoice" value="123456" placeholder="Enter Invoice Input"
                                    class="form-control form-control-sm bg-light w-150px border-0">
                            </h5>
                            <div class="mb-1 d-flex align-items-center justify-content-end text-nowrap gap-2">
                                <span class="fw-semibold text-body">Date Issued:</span>
                                <input type="text" value="11.02.2025" id="issuedDate"
                                    class="form-control form-control-sm bg-light fs-13 w-150px">
                            </div>
                            <div class="mb-1 d-flex align-items-center justify-content-end text-nowrap gap-2">
                                <span class="fw-semibold text-body">Due Date:</span>
                                <input type="text" value="11.02.2025" id="dueDate"
                                    class="form-control form-control-sm bg-light fs-13 w-150px">
                            </div>
                            <div class="mb-1 d-flex align-items-center justify-content-end text-nowrap gap-2">
                                <span class="fw-semibold text-body">Payment Method:</span>

                                <select class="form-select form-select-sm fs-13" id="paymentMethod">
                                    <option value="Credit Card" selected>Credit Card</option>
                                    <option value="PayPal">PayPal</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>
                            </div>
                            <div class="mb-1 d-flex align-items-center justify-content-end text-nowrap gap-2">
                                <span class="fw-semibold text-body">Payment Status:</span>
                                <select class="form-select form-select-sm fs-13" id="paymentStatus">
                                    <option value="Paid" selected>Paid</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-6">

                    <!-- Customer and Shipping Details -->
                    <div class="row d-flex justify-content-between mb-6 gy-4">
                        <div class="col-lg-4">
                            <h6 class="fw-semibold">Bill To:</h6>
                            <textarea id="billEdit" class="form-control bg-light mb-2" rows="3">
John Doe
456 Customer Rd.
Los Angeles</textarea>
                            <input type="text" class="mb-2 form-control bg-light border-0" value="CA 90001"
                                placeholder="Enter Postal Code" required>
                            <input type="email" class="mb-2 form-control bg-light" value="johndoe@example.com"
                                placeholder="Enter Your Email">
                            <input type="text" class="mb-2 form-control bg-light" id="billNumber" name="bill-number"
                                value="19876543210" placeholder="Enter Your Number">
                        </div>
                        <div class="col-lg-4 ms-auto">
                            <h6 class="fw-semibold">Ship To:</h6>
                            <textarea id="shipEdit" class="form-control bg-light mb-2" rows="3">
John Doe
456 Customer Rd.
Los Angeles</textarea>
                            <input type="text" class="mb-2 form-control bg-light border-0" value="CA 90001"
                                placeholder="Enter Postal Code" required>
                            <input type="email" class="mb-2 form-control bg-light" value="johndoe@example.com"
                                placeholder="Enter Your Email">
                            <input type="text" class="mb-2 form-control bg-light" id="shipNumber" name="ship-number"
                                value="19876543210" placeholder="Enter Your Number">

                        </div>
                    </div>

                    <!-- Order Summary Table -->
                    <div class="table-responsive border border-bottom-0 rounded text-nowrap">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="min-w-144px">
                                        <input type="text" class="form-control form-control-sm bg-light mb-3"
                                            placeholder="Item name" aria-label="Item name">
                                        <input type="text" class="form-control form-control-sm bg-light"
                                            placeholder="Description" aria-label="Description">
                                    </td>
                                    <td><input type="number" value="99.99"
                                            class="form-control form-control-sm bg-light border-0 w-100px text-center"></td>
                                    <td>
                                        <div class="qty-input qty-input-sm">
                                            <button type="button" data-action="minus">
                                                <i class="ri-subtract-line"></i>
                                            </button>
                                            <input type="number" value="2" min="0" max="100">
                                            <button type="button" data-action="plus">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td><input type="number" value="199.98"
                                            class="form-control form-control-sm bg-light border-0 w-100px text-center"
                                            readonly></td>
                                    <td>
                                        <button class="btn icon-btn-sm btn-light-danger">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <button class="btn btn-sm btn-light-primary">
                                            <i class="ri-add-line fs-14"></i> Add Product
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Financial Summary -->
                    <div class="table-responsive py-12">
                        <table class="table table-sm table-borderless table-nowrap align-middle mb-0 ms-auto max-w-256px">
                            <tbody>
                                <tr>
                                    <td class="px-0 fw-bold">Subtotal:</td>
                                    <td class="px-0 w-100px"><input type="number" value="244.98"
                                            class="form-control bg-light border-0 text-end"></td>
                                </tr>
                                <tr>
                                    <td class="px-0 fw-bold">Discount (10%):</td>
                                    <td class="px-0 w-100px"><input type="number" value="-24.50"
                                            class="form-control bg-light border-0 text-end"></td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="px-0 fw-bold">Sales Tax (8%):</td>
                                    <td class="px-0 w-100px"><input type="number" value="17.77"
                                            class="form-control bg-light border-0 text-end"></td>
                                </tr>
                                <tr>
                                    <td class="px-0 fw-bold">Shipping:</td>
                                    <td class="px-0 w-100px"><input type="number" value="10.00"
                                            class="form-control bg-light border-0 text-end"></td>
                                </tr>
                                <tr>
                                    <td class="px-0 fw-bold fs-5">Total:</td>
                                    <td class="px-0 w-100px fs-5 text-success fw-bold"><input type="number"
                                            value="248.25"
                                            class="form-control bg-light border-0 text-end fs-5 text-success fw-bold"
                                            readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="mt-0 mb-6">

                    <!-- Additional Notes Section -->
                    <div class="row mb-2">
                        <div class="col-12">
                            <span class="fw-semibold">Note:</span>
                            <textarea class="form-control bg-light bg-opacity-40 mt-2" rows="4">Thank you for shopping with us! We appreciate your business and hope you're satisfied with your purchase. If you have any questions or need assistance with your order, feel free to contact our customer service team at sup.srbthemes@gmail.com. We’re here to help!</textarea>
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
                    <button class="btn btn-light">Print
                        <i class="ri-printer-line ms-1 align-middle d-inline-block"></i>
                    </button>
                    <button class="btn btn-primary">Download
                        <i class="ri-download-2-line align-bottom me-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <!-- Cleave js -->
    <script src="{{ asset('assets/libs/cleave.js/cleave.min.js') }}"></script>

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- Invoice init -->
    <script src="{{ asset('assets/js/apps/invoices/apps-invoice-create.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
