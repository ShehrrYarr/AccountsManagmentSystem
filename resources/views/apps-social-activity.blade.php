@extends('partials.layouts.master2')

@section('title', 'Social Activity | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Activity')
@section('pagetitle', 'Social')
@section('buttonTitle', 'Message')
@section('link', 'apps-chat')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
@endsection
@section('content')

    @include('partials.social-user-profile')

    <div class="row">

        <div class="col-12 col-lg-4 col-xl-3 col-xxl-2">
            @include('partials.social-sidebar')

        </div>
        <div class="col-12 col-lg-8 col-xl-9 col-xxl-10">
            <div class="row g-4">
                <div class="col-12 col-xl-8">
                    <div class="card mb-0">
                        <div class="card-body">

                            <ul class="timeline-box mb-0">

                                <!-- New Post Created -->
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                            <i class="ri ri-pen-nib-line text-primary fs-18 lh-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div
                                            class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-medium">Posted a new status update</h5>
                                                <p class="text-muted fs-13 mb-0">"Excited for the weekend! Who else is
                                                    planning something fun?"</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted fs-13">Today, 9:00 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Post Liked -->
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 p-1 bg-danger-subtle avatar-item avatar">
                                            <i class="ri ri-heart-line text-danger fs-18 lh-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div
                                            class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-medium">Your post got a like</h5>
                                                <p class="mb-0 text-muted fs-12">Liked by <a href="#!"
                                                        class="fw-medium text-body-emphasis">John Doe</a>, <a href="#!"
                                                        class="fw-medium text-body-emphasis">Jane Smith</a>, and 20 others.
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted fs-13">1 days ago, 4:07 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Comment on Post -->
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 p-1 bg-info-subtle avatar-item avatar">
                                            <i class="ri ri-message-3-line text-info fs-18 lh-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div
                                            class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-medium">New comment on your post</h5>
                                                <p class="mb-0 text-muted fs-12">Comment from <a href="#!"
                                                        class="fw-medium text-body-emphasis">Michael Brown</a>: "I’m going
                                                    hiking this weekend! Sounds like fun!"</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted fs-13">2 days ago, 11:45 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Shared Post -->
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 p-1 bg-success-subtle avatar-item avatar">
                                            <i class="ri ri-share-forward-line text-success fs-18 lh-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div
                                            class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-medium">Your post was shared</h5>
                                                <p class="mb-0 text-muted fs-12">Shared by <a href="#!"
                                                        class="fw-medium text-body-emphasis">Emily White</a> with the
                                                    caption: "Weekend plans sorted!"</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted fs-13">3 days ago, 10:00 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Updated Profile Picture -->
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 p-1 bg-warning-subtle avatar-item avatar">
                                            <i class="ri ri-user-settings-line text-warning fs-18 lh-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <h5 class="mb-1 fw-medium">Updated your profile picture</h5>
                                        <p class="mb-0 text-muted fs-12">Your profile picture has been successfully updated.
                                        </p>
                                    </div>
                                </li>

                                <!-- Friend Request Sent -->
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 p-1 bg-primary-subtle avatar-item avatar">
                                            <i class="ri ri-user-add-line text-primary fs-18 lh-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div
                                            class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-medium">Friend request sent</h5>
                                                <p class="mb-0 text-muted fs-12">You sent a friend request to <a
                                                        href="#!" class="fw-medium text-body-emphasis">Sarah Lee</a>.
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted fs-13">3 days ago, 11:30 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Friend Request Accepted -->
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 p-1 bg-success-subtle avatar-item avatar">
                                            <i class="ri ri-user-add-line text-success fs-18 lh-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div
                                            class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-medium">Your friend request was accepted</h5>
                                                <p class="mb-0 text-muted fs-12">You are now friends with <a href="#!"
                                                        class="fw-medium text-body-emphasis">Sarah Lee</a>.</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted fs-13">3 days ago, 5:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Updated Status -->
                                <li class="timeline-section pb-0">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 p-1 bg-success-subtle avatar-item avatar">
                                            <i class="ri ri-sticky-note-line text-success fs-18 lh-1"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div
                                            class="d-flex flex-wrap column-gap-2 row-gap-5 align-items-center justify-content-between">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1 fw-medium">Updated your status</h5>
                                                <p class="mb-1 text-muted fs-12">Status: "Feeling awesome after a long
                                                    workout!"</p>
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="mb-0 fs-12 fw-medium">Status :</p>
                                                    <span class="badge bg-success-subtle text-success">Active</span>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <p class="mb-0 text-muted fs-13">3 days ago, 8:36 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="d-flex gap-3 justify-content-between align-items-center">
                                <h5 class="card-title mb-0">New Message</h5>
                                <i class="ri-edit-box-line"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-icon flex-grow-1">
                                <i class="ri-search-line cursor-pointer text-muted"></i>
                                <input type="text" name="new-search" id="new-search"
                                    class="form-control form-control-icon" placeholder="Search" aria-label="search">
                            </div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs-bordered gap-4 my-4" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link px-0 py-1 active" data-bs-toggle="tab" href="#primary_chat"
                                        role="tab" aria-selected="true">
                                        Primary
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link px-0 py-1" data-bs-toggle="tab" href="#general_chat"
                                        role="tab" aria-selected="false" tabindex="-1">
                                        General
                                    </a>
                                </li>
                                <li class="nav-item ms-auto">
                                    <a class="nav-link fs-12 lh-base link-primary pb-1 px-0" href="#!">
                                        Requests(4)
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active show" id="primary_chat" role="tabpanel">
                                    <ul class="list-group fs-13 fw-medium list-group-flush">
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">John Doe</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Emily Johnson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Alice Smith</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-10.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Michael Jackson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Rachel Green</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Liam Peters</a>
                                        </li>

                                    </ul>
                                    <a href="#!" class="fs-6 fw-semibold text-muted">View All</a>

                                </div>
                                <div class="tab-pane" id="general_chat" role="tabpanel">
                                    <ul class="list-group fs-13 fw-medium list-group-flush">
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">John Doe</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Alice Smith</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Emily Johnson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-10.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Michael Jackson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Liam Peters</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Rachel Green</a>
                                        </li>

                                    </ul>
                                    <a href="#!" class="fs-6 fw-semibold text-muted">View All</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <!-- social feeds init -->
    <script src="{{ asset('assets/js/apps/social/apps-social-feeds.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
