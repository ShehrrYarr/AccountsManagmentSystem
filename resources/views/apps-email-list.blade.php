@extends('partials.layouts.master')

@section('title', 'Email List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Email List')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'Compose Message')
@section('modalTarget', 'centered')


@section('css')
    <!--Quill Editor css-->
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

@section('content')

    <div class="email-wrapper">
        <div class="email-left">
            @include('partials.apps-email-sidebar')
        </div>
        <div class="email-right">
            <div
                class="card-header dt-head d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 p-4 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-light-primary icon-btn-sm p-1 fs-13 rounded-pill custom-toggle"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="bottom"
                        data-bs-title="Starred">
                        <span class="icon-on">
                            <i class="ri-star-fill"></i>
                        </span>
                        <span class="icon-off">
                            <i class="ri-star-line"></i>
                        </span>
                    </button>
                    <button type="button" class="btn btn-light-primary icon-btn-sm p-1 fs-13 rounded-pill"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="bottom"
                        data-bs-title="Archive">
                        <i class="ri-inbox-archive-line"></i>
                    </button>
                    <button type="button" class="btn btn-light-primary icon-btn-sm p-1 fs-13 rounded-pill"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="bottom"
                        data-bs-title="Report spam">
                        <i class="ri-spam-2-line"></i>
                    </button>
                    <button type="button" class="btn btn-light-primary icon-btn-sm p-1 fs-13 rounded-pill delete-item"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="bottom"
                        data-bs-title="Delete">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                    <button type="button" class="btn btn-light-primary icon-btn-sm p-1 fs-13 rounded-pill"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="bottom"
                        data-bs-title="Reply">
                        <i class="ri-reply-line"></i>
                    </button>
                </div>
                <div class="head-main d-flex align-items-center gap-2">
                    <input type="search" class="form-control" placeholder="Search Email">
                </div>
            </div>

            <ul class="nav gap-5 nav-tabs-bordered" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center gap-2 py-4 active" id="pills-primary-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-primary" type="button" role="tab"
                        aria-controls="pills-primary" aria-selected="true">
                        <i class="ri-inbox-fill"></i>Primary
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center gap-2 py-4" id="pills-promotions-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-promotions" type="button" role="tab"
                        aria-controls="pills-promotions" aria-selected="false">
                        <i class="ri-price-tag-3-fill"></i>Promotions
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- Primary Table -->
                <div class="tab-pane fade show active" id="pills-primary" role="tabpanel"
                    aria-labelledby="pills-primary-tab" tabindex="0">
                    <table class="table table-hover align-middle table-nowrap w-100" id="primaryTable">
                        <thead class="bg-light bg-opacity-20">
                            <tr>
                                <th class="px-5"></th>
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- Promotions Table -->
                <div class="tab-pane fade" id="pills-promotions" role="tabpanel" aria-labelledby="pills-promotions-tab"
                    tabindex="0">
                    <table class="table table-hover align-middle table-nowrap w-100" id="promotionsTable">
                        <thead class="bg-light bg-opacity-20">
                            <tr>
                                <th class="px-5"></th>
                                <th></th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!-- start:: Centered Modal -->
        <div class="modal fade modal-lg" id="centered" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="centeredLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="centeredLabel">Compose Message</h5>
                        <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ri-close-large-line fw-semibold"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row mb-lg-3 mb-2">
                                <label class="col-lg-2 col-form-label" for="composeTo">To :</label>
                                <div class="col-lg-10">
                                    <div class="position-relative composeTo">
                                        <input class="form-control" id="composeTo" type="email">
                                        <div class="position-absolute d-flex gap-2 composeToBtn">
                                            <button class="btn btn-sm btn-light-primary" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseCc"
                                                aria-expanded="true" aria-controls="collapseCc">Cc </button>
                                            <button class="btn btn-sm btn-light-primary" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseBcc"
                                                aria-expanded="false" aria-controls="collapseBcc">Bcc</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-lg-3 mb-2 collapse show" id="collapseCc">
                                <label class="col-lg-2 col-form-label" for="composeCc">Cc:</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="composeCc" type="email"
                                        placeholder="elanarob@gmail.com">
                                </div>
                            </div>

                            <div class="row mb-lg-3 mb-2 collapse" id="collapseBcc">
                                <label class="col-lg-2 col-form-label" for="composeBcc">Bcc:</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="composeBcc" type="email"
                                        placeholder="stiphen@yahoo.com">
                                </div>
                            </div>

                            <div class="row mb-lg-3 mb-2">
                                <label class="col-lg-2 col-form-label" for="composeSubject">Subject :</label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="composeSubject" type="email">
                                </div>
                            </div>
                        </form>
                        <div data-editor="replay-email">
                            <p>Hello World!</p>
                            <p>Some initial <strong>bold</strong> text</p>
                            <p><br></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">Save as
                            Draft</button>
                        <button type="button" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')

    <!--Quill Editor js-->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Email init -->
    <script src="{{ asset('assets/js/apps/email/apps-email.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
