@extends('partials.layouts.master3')

@section('title', 'Products checkout | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Checkout')
@section('pagetitle', 'Ecommerce')
@section('buttonTitle', 'Back to Shopping')
@section('link', 'apps-products')

@section('content')


    <div class="row g-4">
        <div class="col-lg-8 col-xl-9">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-1">Billing Information</h5>
                    <p class="card-text mb-0">Please fill all information below</p>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <label for="fname" class="form-label">First name<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" class="form-control" name="firstNameDeliveryAddress" id="fname"
                                placeholder="Clarice" aria-label="Clarice" required>
                            <div class="form-text fs-12 text-muted">Enter your first name as it appears on your ID or
                                billing information.</div>
                        </div>

                        <div class="col-lg-6">
                            <label for="lname" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="lastNameDeliveryAddress" id="lname"
                                placeholder="Boone" aria-label="Boone">
                            <div class="form-text fs-12 text-muted">Enter your last name.</div>
                        </div>

                        <div class="col-lg-6">
                            <label for="email" class="form-label">Email<span
                                    class="text-muted ms-1">(Optional)</span></label>
                            <input type="email" class="form-control" name="emailDeliveryAddress" id="email"
                                placeholder="clarice@gmail.com" aria-label="clarice@gmail.com">
                            <div class="form-text fs-12 text-muted">We'll send your order confirmation and shipping updates
                                to this email address.</div>
                        </div>

                        <div class="col-lg-6">
                            <label for="contact-number" class="form-label">Phone<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" class="form-control" name="phoneDeliveryAddress" id="contact-number"
                                placeholder="+xx xxx xxx xxxx" aria-label="+xx xxx xxx xxxx" required>
                            <div class="form-text fs-12 text-muted">Enter a phone number where you can be reached in case of
                                delivery issues.</div>
                        </div>

                        <div class="col-lg-6">
                            <label for="street-address" class="form-label">Street address<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" class="form-control" name="streetAddress" id="street-address"
                                placeholder="470, Lucy Forks Street" aria-label="470, Lucy Forks Street" required>
                            <div class="form-text fs-12 text-muted">Include your street, apartment, or suite number if
                                applicable.</div>
                        </div>

                        <div class="col-lg-6">
                            <label for="city" class="form-label">City<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" class="form-control" name="cityDeliveryAddress" id="city"
                                placeholder="London" aria-label="London" required>
                            <div class="form-text fs-12 text-muted">Enter the city where your order will be delivered.</div>
                        </div>

                        <div class="col-lg-6">
                            <label for="product-country" class="form-label">Country</label>
                            <select class="form-select" id="product-country">
                                <option selected>United States</option>
                                <option value="Canada">Canada</option>
                                <option value="Mexico">Mexico</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                                <option value="Australia">Australia</option>
                                <option value="India">India</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Japan">Japan</option>
                                <option value="South Korea">South Korea</option>
                                <option value="China">China</option>
                                <option value="Italy">Italy</option>
                                <option value="Spain">Spain</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Russia">Russia</option>
                                <option value="South Africa">South Africa</option>
                            </select>
                            <div class="form-text fs-12 text-muted">Select the country where your order will be shipped to.
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label for="product-zip-code" class="form-label">Zip code<i
                                    class="bi-question-circle text-body ms-1 fs-12" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                    data-bs-title="You can find your code in a postal address."></i></label>
                            <input type="text" class="form-control" name="zipCodeDeliveryAddress"
                                id="product-zip-code" placeholder="SE7 5QY" aria-label="SE7 5QY" required>
                            <div class="form-text fs-12 text-muted">Enter your postal code to ensure correct shipping
                                charges and delivery.</div>
                        </div>

                        <div class="col-12">
                            <div class="form-check mb-0">
                                <input type="checkbox" class="form-check-input" id="exclusiveOffersCardCheckbox1">
                                <label class="text-muted fw-normal fs-12 m-0" for="exclusiveOffersCardCheckbox1">Please
                                    send me emails with exclusive offers</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header hstack align-items-center gap-3">
                    <div class="d-flex flex-column flex-grow-1">
                        <h5 class="card-title mb-1">Shipping Information</h5>
                        <p class="card-text mb-0">Please fill all information below</p>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary flex-shrink-0" data-bs-toggle="modal"
                        data-bs-target="#addNewAddress">Add Address</button>
                </div>
                <div class="card-body">
                    <h5 class="fs-14 fw-medium mb-4">Saved Address</h5>
                    <div class="row g-4 mb-8">
                        <div class="col-lg-6">
                            <div class="rounded border">
                                <div class="card-header p-3">
                                    <div class="d-flex align-items-center gap-1 justify-content-between">
                                        <span class="d-flex gap-2 align-items-baseline">
                                            <span class="h6 mb-0">Home</span>
                                            <span class="badge bg-primary-subtle text-primary">Default Address</span>
                                        </span>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-text-primary icon-btn-sm rounded-circle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Make Default</a>
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#addNewAddress"><i class="bi-pencil"></i> Edit
                                                    Address</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item" href="#!"><i
                                                        class="bi-trash"></i> Delete File</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-flex flex-column gap-1">
                                        <span class="fs-14 mb-3 d-block">Marcus Alfaro</span>
                                        <div class="d-flex align-items-center align-middle gap-1">
                                            <span class="fw-semibold">Address:</span><span
                                                class="text-muted align-middle fs-12 fw-normal">2211 Fruitville Rd,
                                                Sarasota, Florida, US</span>
                                        </div>
                                        <div class="d-flex align-items-center align-middle gap-1">
                                            <span class="fw-semibold">Pincode:</span><span
                                                class="text-muted align-middle fs-12 fw-normal">34237</span>
                                        </div>
                                        <div class="d-flex align-items-center align-middle gap-1">
                                            <span class="fw-semibold">Contact:</span><span
                                                class="text-muted align-middle fs-12 fw-normal">012-345-6789</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="rounded border">
                                <div class="card-header p-3">
                                    <div class="d-flex align-items-center gap-1 justify-content-between">
                                        <span class="d-flex gap-2 align-items-baseline">
                                            <span class="h6 mb-0">Office</span>
                                        </span>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-text-primary icon-btn-sm rounded-circle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Make Default</a>
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#addNewAddress"><i class="bi-pencil"></i> Edit
                                                    Address</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item" href="#!"><i
                                                        class="bi-trash"></i> Delete File</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-flex flex-column gap-1">
                                        <span class="fs-14 mb-3 d-block">Lia Dyer</span>
                                        <div class="d-flex align-items-center align-middle gap-1">
                                            <span class="fw-semibold">Address:</span><span
                                                class="text-muted align-middle fs-12 fw-normal">2211 Fruitville Rd,
                                                Sarasota, Florida, US</span>
                                        </div>
                                        <div class="d-flex align-items-center align-middle gap-1">
                                            <span class="fw-semibold">Pincode:</span><span
                                                class="text-muted align-middle fs-12 fw-normal">34237</span>
                                        </div>
                                        <div class="d-flex align-items-center align-middle gap-1">
                                            <span class="fw-semibold">Contact:</span><span
                                                class="text-muted align-middle fs-12 fw-normal">012-345-6789</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="fs-14 fw-medium mb-4">Shipping Method</h5>
                    <div class="main-img-checkbox">
                        <div class="row g-4">
                            <div class="col-xxl-4 col-sm-6">
                                <div class="img-checkbox">
                                    <input class="main-img-cover form-check-input d-none" id="img-check-1"
                                        name="shipping-method" type="radio" checked>
                                    <label class="form-check-label mb-0" for="img-check-1">
                                        <span class="d-flex align-items-center gap-2 rounded p-3 w-100">
                                            <span class="flex-grow-1">
                                                <span class="fw-medium mb-0 text-wrap d-block">Standard Delivery</span>
                                                <span class="fs-12 text-muted fw-normal text-wrap">Estimated 5-7 days
                                                    shipping</span>
                                            </span>
                                            <span class="flex-shrink-0 fs-20 text-wrap">Free</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-sm-6">
                                <div class="img-checkbox">
                                    <input class="main-img-cover form-check-input d-none" id="img-check-2"
                                        name="shipping-method" type="radio">
                                    <label class="form-check-label mb-0" for="img-check-2">
                                        <span class="d-flex align-items-center gap-2 rounded p-3 w-100">
                                            <span class="flex-grow-1">
                                                <span class="fw-medium mb-0 text-wrap d-block">Express Delivery</span>
                                                <span class="fs-12 text-muted fw-normal text-wrap">Estimated Delivery
                                                    within 24hrs</span>
                                            </span>
                                            <span class="flex-shrink-0 fs-20 text-wrap">$30</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-1">Payment Selection</h5>
                    <p class="card-text mb-0">Please select and enter your billing information</p>
                </div>
                <div class="card-body border-0 border-bottom border-dashed">
                    <h5 class="fs-14 fw-medium mb-4">Saved Cards</h5>
                    <div class="d-flex flex-column gap-4">
                        <div class="border rounded border-dashed p-4">
                            <div class="d-flex gap-3 justify-content-between align-items-center cursor-pointer">
                                <div class="d-flex align-items-center gap-3 flex-grow-1" role="button"
                                    data-bs-toggle="collapse" data-bs-target="#paymentOptionOneDetails"
                                    aria-expanded="false" aria-controls="paymentOptionOneDetails">
                                    <img class="w-40px" src="{{ asset('assets/images/payment-method/mastercard.svg') }}"
                                        alt="mastercard">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <h6 class="mb-0">Mastercard</h6>
                                            <span class="badge bg-primary-subtle text-primary">Default</span>
                                        </div>
                                        <span class="fs-13 text-muted">Expires Nov 2027</span>
                                    </div>
                                </div>
                                <div class="dropdown flex-shrink-0">
                                    <button type="button" class="btn btn-text-primary icon-btn-sm rounded-circle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                        <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Make
                                            Default</a>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#EditNewPaymentModal"><i class="bi-pencil"></i> Edit
                                            Payment</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-item" href="#!"><i class="bi-trash"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div id="paymentOptionOneDetails" class="collapse">
                                <div class="row pt-4">
                                    <div class="col-md-6">
                                        <table class="table table-borderless text-nowrap mb-0">
                                            <tr>
                                                <td class="p-2 fw-medium w-50">Cardholder</td>
                                                <td class="p-2 fs-13 text-muted">Aiden Brooks</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Card Number</td>
                                                <td class="p-2 fs-13 text-muted">**** 5399</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Expiration</td>
                                                <td class="p-2 fs-13 text-muted">11/2027</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Card Type</td>
                                                <td class="p-2 fs-13 text-muted">Mastercard</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Issuer</td>
                                                <td class="p-2 fs-13 text-muted">GLOBANK</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Card ID</td>
                                                <td class="p-2 fs-13 text-muted">id_j8kd90we4l8</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless text-nowrap mb-0">
                                            <tr>
                                                <td class="p-2 fw-medium w-50">Billing Country</td>
                                                <td class="p-2 fs-13 text-muted">Canada</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Phone</td>
                                                <td class="p-2 fs-13 text-muted">+1 905 555 1234</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Email</td>
                                                <td class="p-2 fs-13 text-muted">aiden.brooks@bankmail.com</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Location</td>
                                                <td class="p-2 fs-13 text-muted d-flex align-items-center gap-2">Canada
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">CVC Verification</td>
                                                <td class="p-2 fs-13 text-muted d-flex align-items-center gap-1">
                                                    Verified<span
                                                        class="hstack justify-content-center mt-1 h-12px w-12px text-bg-success rounded-pill"><i
                                                            class="ri-check-fill ri-xs"></i></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border rounded border-dashed p-4">
                            <div class="d-flex gap-3 justify-content-between align-items-center cursor-pointer">
                                <div class="d-flex align-items-center gap-3 flex-grow-1" role="button"
                                    data-bs-toggle="collapse" data-bs-target="#paymentOptionTwoDetails"
                                    aria-expanded="false" aria-controls="paymentOptionTwoDetails">
                                    <img class="w-40px" src="{{ asset('assets/images/payment-method/visa.svg') }}"
                                        alt="visa">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-0">Visa</h6>
                                        <span class="fs-13 text-muted">Expires Dec 2028</span>
                                    </div>
                                </div>
                                <div class="dropdown flex-shrink-0">
                                    <button type="button" class="btn btn-text-primary icon-btn-sm rounded-circle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                        <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Make
                                            Default</a>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#EditNewPaymentModal"><i class="bi-pencil"></i> Edit
                                            Payment</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-item" href="#!"><i class="bi-trash"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div id="paymentOptionTwoDetails" class="collapse">
                                <div class="row pt-4">
                                    <div class="col-md-6">
                                        <table class="table table-borderless text-nowrap mb-0">
                                            <tr>
                                                <td class="p-2 fw-medium w-50">Cardholder</td>
                                                <td class="p-2 fs-13 text-muted">Samantha Green</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Card Number</td>
                                                <td class="p-2 fs-13 text-muted">**** 1234</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Expiration</td>
                                                <td class="p-2 fs-13 text-muted">12/2028</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Card Type</td>
                                                <td class="p-2 fs-13 text-muted">Visa</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Issuer</td>
                                                <td class="p-2 fs-13 text-muted">GLOBALBANK</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Card ID</td>
                                                <td class="p-2 fs-13 text-muted">id_abc123xyz</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless text-nowrap mb-0">
                                            <tr>
                                                <td class="p-2 fw-medium w-50">Billing Country</td>
                                                <td class="p-2 fs-13 text-muted">United States</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Phone</td>
                                                <td class="p-2 fs-13 text-muted">+1 212 555 6789</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Email</td>
                                                <td class="p-2 fs-13 text-muted">samantha.green@bankmail.com</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">Location</td>
                                                <td class="p-2 fs-13 text-muted d-flex align-items-center gap-2">New York,
                                                    USA</td>
                                            </tr>
                                            <tr>
                                                <td class="p-2 fw-medium">CVC Verification</td>
                                                <td class="p-2 fs-13 text-muted d-flex align-items-center gap-1">
                                                    Verified<span
                                                        class="hstack justify-content-center mt-1 h-12px w-12px text-bg-success rounded-pill"><i
                                                            class="ri-check-fill ri-xs"></i></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header border-0 border-bottom border-dashed">
                    <h5 class="fs-14 fw-medium mb-0">Add New Card</h5>
                </div>
                <div class="card-body">
                    <form id="addNewCCForm" class="row g-5">
                        <div class="col-12 col-lg-6">
                            <label class="form-label" for="modalAddCard">Card Number<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" id="modalAddCard" name="modalAddCard" class="form-control"
                                placeholder="Enter card number">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label" for="modalAddCardName">Name<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" id="modalAddCardName" class="form-control" placeholder="John Doe">
                        </div>
                        <div class="col-12 col-lg-8">
                            <label class="form-label" for="new-card-month">Exp. Date<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select id="new-card-month" name="new-card-month" class="form-select">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mt-3 mt-sm-0">
                                    <select id="new-card-year" name="new-card-year" class="form-select">
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label class="form-label" for="modalAddCardCvv">CVV Code<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" id="modalAddCardCvv" class="form-control form-control-solid"
                                minlength="3" maxlength="4" placeholder="CVV" name="card_cvv">
                        </div>
                        <div class="col-12 d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-4 col-xl-3">
            <div class="card mb-0">
                <div class="card-body">
                    <h6 class="mb-4 fs-6">Orders Summary</h6>
                    <div class="px-4 py-3 mb-4 text-sm text-danger border border-0 rounded-3 bg-danger-subtle">
                        These products are limited, checkout within <span class="fw-bold">03m 21s</span>
                    </div>
                    <div class="overflow-auto">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="border-bottom border-dashed">
                                    <td class="py-3 px-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <div
                                                class="d-flex align-items-center justify-content-center rounded-3 bg-light shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="product image" class="avatar-lg rounded">
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="#!">
                                                    <h6 class="mb-1 text-truncate-2">Roar Twill Blue Baseball Cap</h6>
                                                </a>
                                                <p class="mb-0 text-muted fs-12">Quantity : 2 <span
                                                        class="badge bg-success-subtle text-success ms-2">30% Off</span>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end py-3 px-0">
                                        <div><i class="ri-close-line fs-16 text-muted cursor-pointer"></i></div><span
                                            class="text-muted fs-12">$299.98</span>
                                    </td>
                                </tr>
                                <tr class="border-bottom border-dashed">
                                    <td class="py-3 px-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <div
                                                class="d-flex align-items-center justify-content-center rounded-3 bg-light shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="product image" class="avatar-lg rounded">
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="#!">
                                                    <h6 class="mb-1 text-truncate-2">Roar Twill Blue Baseball Cap</h6>
                                                </a>
                                                <p class="mb-0 text-muted fs-12">Quantity : 2 <span
                                                        class="badge bg-success-subtle text-success ms-2">30% Off</span>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end py-3 px-0">
                                        <div><i class="ri-close-line fs-16 text-muted cursor-pointer"></i></div><span
                                            class="text-muted fs-12">$299.98</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-0 border-bottom border-dashed">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="text-muted">Sub Total</div>
                            <div class="fw-semibold fs-14">$932.16</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="text-muted">Estimated Tax (18%)</div>
                            <div class="fw-semibold fs-14">$167.79</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="text-muted">Item Discounts (12%)</div>
                            <div class="fw-semibold fs-14 text-success">-$111.86</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="text-muted">Shipping Charge</div>
                            <div class="fw-semibold fs-14 text-danger">$0</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="fw-semibold text-muted">Total Amount (USD)</div>
                            <div class="fw-semibold fs-14">$988.09</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button"
                            class="w-100 btn btn-primary d-flex align-items-center gap-2 justify-content-center">
                            <span class="align-middle">Place Order</span><i class="ri-arrow-right-line align-middle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Credit Card Modal -->
    <div class="modal fade" id="EditNewPaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Edit Card</h5>
                        <div class="modal-subtitle text-muted fs-13">Edit card to complete payment</div>
                    </div>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addNewCCForm0" class="row g-5">
                        <div class="col-12">
                            <label class="form-label" for="modalAddCardNumber">Card Number<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" id="modalAddCardNumber" name="modalAddCardNumber" class="form-control"
                                placeholder="Enter card number">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalAddCardName2">Name<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" id="modalAddCardName2" class="form-control" placeholder="John Doe">
                        </div>
                        <div class="col-8">
                            <label class="form-label" for="edit-card-month">Exp. Date<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <select id="edit-card-month" name="edit-card-month" class="form-select">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select id="edit-card-year" name="edit-card-year" class="form-select">
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="modalAddCardCvv2">CVV Code<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <input type="text" id="modalAddCardCvv2" class="form-control form-control-solid"
                                minlength="3" maxlength="4" placeholder="CVV" name="card_cvv">
                        </div>
                        <div class="col-12">
                            <div class="form-check form-check-sm form-switch form-switch-primary mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck01"
                                    checked>
                                <label class="form-check-label text-muted fw-normal ms-1 mb-0" for="SwitchCheck01">Save
                                    card for future billing?</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex align-items-center justify-content-center gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Edit Credit Card Modal -->
    @include('partials.add-address-modal')

@endsection

@section('js')
    <!-- Cleave js -->
    <script src="{{ asset('assets/libs/cleave.js/cleave.min.js') }}"></script>

    <!-- Product create init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-product-checkout.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
