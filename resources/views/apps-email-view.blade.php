@extends('partials.layouts.master3')

@section('title', 'Email | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Add Invoice')
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
    <div class="email-wrapper">
        <div class="email-left">
            @include('partials.apps-email-sidebar')

        </div>
        <div class="email-right">
            <div class="hstack justify-content-between gap-2 p-4 border-bottom">
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
                    <button type="button" class="btn btn-light-primary icon-btn-sm p-1 fs-13 rounded-pill"
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
                <div class="form-icon">
                    <input type="text" class="form-control form-control-icon" id="firstNameLayout44"
                        placeholder="Search users" required>
                    <i class="ri-search-2-line text-muted"></i>
                </div>
            </div>
            <div class="hstack justify-content-between gap-4 p-4 border-bottom">
                <div class="d-flex align-items-center gap-4">
                    <div class="avatar-item avatar border-0">
                        <img class="img-fluid avatar border-0" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                            alt="avatar image">
                    </div>
                    <div>
                        <h6 class="m-0 fw-medium">Raiden stevie</h6>
                        <div class="dropdown">
                            <p class="m-0 fs-12 dropdown-toggle cursor-pointer" data-bs-toggle="dropdown"
                                aria-expanded="true" role="button" aria-label="Toggle dropdown to see email details">to: me
                            </p>
                            <ul class="dropdown-menu text-nowrap p-4">
                                <li class="list-unstyled d-flex align-items-center gap-2">
                                    <span class="w-64px text-muted">From :</span>
                                    <a class="text-body" href="mailto:arteam@gmail.com">arteam@gmail.com</a>
                                </li>
                                <li class="list-unstyled d-flex align-items-center gap-2 pt-3">
                                    <span class="w-64px text-muted">To :</span>
                                    <a class="text-body" href="mailto:bettehagenes@gmail.com">bettehagenes@gmail.com</a>
                                </li>
                                <li class="list-unstyled d-flex align-items-center gap-2 pt-3">
                                    <span class="w-64px text-muted">cc :</span>
                                    <a class="text-body" href="mailto:bettehagenes@gmail.com">bettehagenes@gmail.com</a>
                                </li>
                                <li class="list-unstyled d-flex align-items-center gap-2 pt-3">
                                    <span class="w-64px text-muted">Date :</span>
                                    <p class="mb-0">29 Sep 2024</p>
                                </li>
                                <li class="list-unstyled d-flex align-items-center gap-2 pt-3">
                                    <span class="w-64px text-muted">Subject :</span>
                                    <p class="mb-0">meeting invitation</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span class="fs-13 text-muted">26 March 2024</span>
                    <span class="badge bg-primary w-max ms-auto">Work</span>
                </div>
            </div>
            <div class="p-4">
                <h5 class="mb-0">Welcome to Your Admin Dashboard!</h5>
                <div class="pt-4">
                    <p class="fs-13 text-muted fw-medium mb-2">Hi Bob,</p>
                    <p class="fs-13 text-muted mb-1">
                        With resrpect, i must disagree with Mr.Zinsser. We all know the most part of important part of
                        any article is the title.Without a compelleing title, your reader won't even get to the first
                        sentence.After the title, however, the first few sentences of your article are certainly
                        the most important part.
                    </p>
                    <p class="fs-13 text-muted">
                        Jornalists call this critical, introductory section the "Lede," and when bridge properly executed,
                        it's the that carries your reader from an headine try at attention-grabbing to the body of your
                        blog post, if you want to get it right on of these 10 clever ways to omen your next blog posr with a
                        bang
                    </p>
                    <p class="fs-13 text-muted">
                        Jornalists call this critical, introductory section the "Lede," and when bridge properly executed,
                        it's the that carries your reader from an headine try at attention-grabbing to the body of your
                        blog post, if you want to get it right on of these 10 clever ways to omen your next blog posr with a
                        bang
                    </p>
                    <hr>
                    <h6 class="my-4">2 Attachments available</h6>
                    <div class="row g-3 max-w-320px">
                        <div class="col-4">
                            <a href="{{ asset('assets/images/small/img-1.jpg') }}" class="lightbox">
                                <img src="{{ asset('assets/images/small/img-1.jpg') }}"
                                    class="rounded-2 h-100 img-fluid object-fit-cover" alt="Email image">
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ asset('assets/images/small/img-2.jpg') }}" class="lightbox">
                                <img src="{{ asset('assets/images/small/img-2.jpg') }}"
                                    class="rounded-2 h-100 img-fluid object-fit-cover" alt="Email image">
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6 class="mb-0">Best regards,</h6>
                        <p class="mb-0 fs-13 text-muted">Jason Muller</p>
                    </div>
                </div>
            </div>
            <div class="p-4 border-top">
                <h6 class="mb-4">Reply to Ross Geller</h6>
                <div data-editor="replay-email">
                    <p>Hello World!</p>
                    <p>Some initial <strong>bold</strong> text</p>
                    <p><br></p>
                </div>
                <div class="hstack gap-2 justify-content-end pt-4">
                    <button class="btn min-w-100px fw-semibold btn-light-primary">
                        <i class="ri-reply-line me-2"></i>
                        Reply
                    </button>
                    <button class="btn min-w-100px fw-semibold btn-light-primary">
                        <i class="ri-share-forward-line me-2"></i>
                        Forword
                    </button>
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

@section('css')

    <!-- Lightbox2 js -->
    <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <!--Quill Editor js-->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Email Details init -->
    <script src="{{ asset('assets/js/apps/email/apps-email.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
