@extends('partials.layouts.master2')

@section('title', 'Social Feeds | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Feeds')
@section('pagetitle', 'Social')
@section('buttonTitle', 'Message')
@section('link', 'apps-chat')

@section('css')
@endsection
<link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@section('content')

    @include('partials.social-user-profile')


    <div class="row">

        <div class="col-12 col-lg-4 col-xl-3 col-xxl-2">
            @include('partials.social-sidebar')

        </div>
        <div class="col-12 col-lg-8 col-xl-9 col-xxl-10">
            <div class="row">
                <div class="col-12 col-xl-8">

                    <div class="card delete-element">
                        <div class="card-header fw-medium">
                            <div class="d-flex flex-wrap align-items-center gap-3 justify-content-between">
                                <h5 class="card-title mb-0">Create New Post</h5>
                                <div class="dropdown flex-shrink-0">
                                    <button type="button" class="btn btn-sm btn-text-secondary rounded-circle icon-btn-sm"
                                        id="feedpost1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-fill fw-semibold"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost1">
                                        <a class="dropdown-item" href="#!">Create a poll</a>
                                        <a class="dropdown-item" href="#!">Ask a question</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="#!">
                                <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3 py-4">
                                    <div class="d-flex gap-3 w-100">
                                        <div
                                            class="rounded-circle avatar-item border-0 avatar rounded-circle overflow-hidden">
                                            <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="profile image"
                                                class="img-fluid">
                                        </div>
                                        <div class="form-icon right flex-grow-1">
                                            <input type="text" name="new-message" id="new-message"
                                                class="form-control form-control-icon" placeholder="What's on your mind?"
                                                aria-label="What's on your mind?">
                                            <i class="ri-emotion-line cursor-pointer text-muted"></i>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary flex-shrink-0">Share Post</button>
                                </div>
                                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                                    <ul
                                        class="list-inline d-flex align-items-center flex-wrap column-gap-3 row-gap-1 flex-grow-1 mb-0">
                                        <li>
                                            <a class="hstack" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#addCategoryModal"><i
                                                    class="ri-video-line text-info me-1"></i><span
                                                    class="fs-13 align-middle text-muted">Image/Video</span></a>
                                        </li>
                                        <li>
                                            <a class="hstack" href="#!"><i
                                                    class="ri-calendar-event-line text-danger me-1"></i><span
                                                    class="fs-13 align-middle text-muted">Event</span></a>
                                        </li>
                                        <li>
                                            <a class="hstack" href="#!"><i
                                                    class="ri-heart-line text-warning me-1"></i><span
                                                    class="fs-13 align-middle text-muted">Feeling / Activity</span></a>
                                        </li>
                                    </ul>
                                    <div class="dropdown">
                                        <button class="btn btn-light-light btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">Public</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#!">Draft</a></li>
                                            <li><a class="dropdown-item" href="#!">Schedule</a></li>
                                            <li><a class="dropdown-item" href="#!">Private</a></li>
                                            <li><a class="dropdown-item" href="#!">Public</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card delete-element">
                        <div class="card-header">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="flex-grow-1 d-flex align-items-center gap-2">
                                    <div class="avatar-item w-max">
                                        <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                            alt="Author Avatar">
                                    </div>
                                    <div>
                                        <h6 class="card-title mb-0"><a href="pages-profile-overview" class="text-body">Dev
                                                Team</a></h6>
                                        <p class="text-muted fs-13 mb-0 hstack"><i class="ri-time-line me-1"></i>5 Jan at
                                            4:00 PM</p>
                                    </div>
                                </div>
                                <div class="dropdown flex-shrink-0">
                                    <button type="button" class="btn btn-sm btn-text-secondary rounded-circle icon-btn-sm"
                                        id="feedpost2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-fill fw-semibold"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost2">
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">Share Post</a>
                                        <a class="dropdown-item" href="#!">Report Post</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="#!" class="d-block fs-18 fw-medium text-body mb-2 text-truncate-2">New Approach
                                to Handling API Requests in Modern Web Apps</a>
                            <p class="fs-13 text-muted">
                                In our latest development update, we share a simplified method for handling API requests
                                efficiently in modern web apps using async/await and error handling techniques.
                                This approach reduces unnecessary complexity and increases application performance. Here's
                                how we can make web apps faster and more reliable.
                            </p>
                            <hr>
                            <div class="hstack flex-wrap justify-content-between align-items-center gap-3">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <button class="btn btn-sm btn-light text-muted fw-medium" data-bs-toggle="collapse"
                                        data-bs-target="#commentCollapse1" aria-expanded="false"
                                        aria-controls="commentCollapse1"><i class="ri-message-3-line me-1"></i>5
                                        Comments</button>
                                    <button type="button" class="btn btn-sm btn-light text-muted fw-medium custom-toggle"
                                        aria-pressed="false">
                                        <span class="icon-off lh-base">
                                            <i class="ri-heart-line me-1"></i>124 Likes
                                        </span>
                                        <span class="icon-on lh-base">
                                            <i class="ri-heart-fill me-1"></i>125 Likes
                                        </span>
                                    </button>
                                    <button class="btn btn-sm btn-light text-muted fw-medium" data-bs-toggle="modal"
                                        data-bs-target="#shareModal"><i class="ri-share-line me-1"></i>Share</button>
                                </div>
                                <button type="button" class="btn btn-sm btn-light text-muted fw-medium custom-toggle"
                                    aria-pressed="false">
                                    <span class="icon-off lh-base">
                                        <i class="ri-bookmark-line me-1"></i>45
                                    </span>
                                    <span class="icon-on lh-base">
                                        <i class="ri-bookmark-fill me-1"></i>46
                                    </span>
                                </button>
                            </div>
                            <div class="collapse" id="commentCollapse1">
                                <div class="pt-4">
                                    <ul class="list-group list-group-flush">
                                        <!-- Comment 1 -->
                                        <li class="list-group-item p-0 mb-3 border-0 d-flex gap-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">Sarah Lee <span
                                                            class="text-muted fs-11 fw-normal">2 hours ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">This is a great solution! Async/await
                                                    really simplifies the process. Would love to see a demo of this in
                                                    action.</p>
                                            </div>
                                        </li>

                                        <!-- Comment 2 -->
                                        <li class="list-group-item p-0 ps-5 mb-3 border-0 d-flex gap-2 bg-transparent">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">David Brown <span
                                                            class="text-muted fs-11 fw-normal">1 hour ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">I implemented this approach in my last
                                                    project, and it worked wonders. The code became much more readable.</p>
                                            </div>
                                        </li>

                                        <!-- Comment 3 -->
                                        <li class="list-group-item p-0 mb-3 border-0 d-flex gap-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">Alex Johnson <span
                                                            class="text-muted fs-11 fw-normal">30 minutes ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">How do you handle multiple simultaneous
                                                    API requests with this approach? Any suggestions?</p>
                                            </div>
                                        </li>
                                    </ul>

                                    <!-- Comment Input -->
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                alt="profile Image" class="avatar rounded-circle">
                                        </div>
                                        <div class="d-flex align-items-center gap-2 flex-grow-1">
                                            <input type="text" class="form-control flex-grow-1"
                                                placeholder="Add a comment...">
                                            <button class="btn btn-primary flex-shrink-0"><i
                                                    class="ri-send-plane-fill"></i>Send</button>
                                        </div>
                                        <button type="button"
                                            class="flex-shrink-0 btn btn-light-secondary icon-btn h-40px w-40px rounded-2"><i
                                                class="ri-emoji-sticker-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card delete-element">
                        <div class="card-header">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="flex-grow-1 d-flex align-items-center gap-2">
                                    <div class="avatar-item w-max">
                                        <img class="img-fluid avatar"
                                            src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Author Avatar">
                                    </div>
                                    <div>
                                        <h6 class="card-title mb-0"><a href="pages-profile-overview"
                                                class="text-body">Dev Team</a></h6>
                                        <p class="text-muted fs-13 mb-0 hstack"><i class="ri-time-line me-1"></i>January,
                                            6, 2025</p>
                                    </div>
                                </div>
                                <div class="dropdown flex-shrink-0">
                                    <button type="button"
                                        class="btn btn-sm btn-text-secondary rounded-circle icon-btn-sm" id="feedpost3"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-fill fw-semibold"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost3">
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">Share Post</a>
                                        <a class="dropdown-item" href="#!">Report Post</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="fs-13 text-muted">
                                There are two main approaches you can take to writing amazing blog post headlines. You can
                                either decide on your final headline before outstanding you write the most of the rest of
                                your creative post
                            </p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row g-3 h-95 my-0">
                                        <div class="col-6 mt-0">
                                            <a href="{{ asset('assets/images/small/img-1.jpg') }}"
                                                class="thumbnail lightbox">
                                                <img src="{{ asset('assets/images/small/img-1.jpg') }}"
                                                    class="rounded-2 img-fluid object-fit-cover h-100 w-100"
                                                    alt="gallery image">
                                            </a>
                                        </div>
                                        <div class="col-6 mt-0">
                                            <a href="{{ asset('assets/images/small/img-2.jpg') }}"
                                                class="thumbnail lightbox">
                                                <img src="{{ asset('assets/images/small/img-2.jpg') }}"
                                                    class="rounded-2 img-fluid object-fit-cover h-100 w-100"
                                                    alt="gallery image">
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ asset('assets/images/small/img-3.jpg') }}"
                                                class="thumbnail lightbox">
                                                <img src="{{ asset('assets/images/small/img-3.jpg') }}"
                                                    class="rounded-2 img-fluid object-fit-cover h-100 w-100"
                                                    alt="gallery image">
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ asset('assets/images/small/img-4.jpg') }}"
                                                class="thumbnail lightbox">
                                                <img src="{{ asset('assets/images/small/img-4.jpg') }}"
                                                    class="rounded-2 img-fluid object-fit-cover h-100 w-100"
                                                    alt="gallery image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3 mt-sm-0">
                                    <div class="row h-100">
                                        <div class="col-12">
                                            <div class="card text-bg-dark mb-0">
                                                <img src="{{ asset('assets/images/gallery/image-5.jpg') }}"
                                                    class="card-img rounded-2 img-fluid object-fit-cover h-98 w-95"
                                                    alt="gallery image">
                                                <div class="card-img-overlay p-0">
                                                    <a href="{{ asset('assets/images/gallery/image-5.jpg') }}"
                                                        class="overlay p-4 thumbnail lightbox card-text">
                                                        <div class="overlay-content">
                                                            <h2 class="card-text fw-medium">+15</h2>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="hstack flex-wrap justify-content-between align-items-center gap-3">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <button class="btn btn-sm btn-light text-muted fw-medium" data-bs-toggle="collapse"
                                        data-bs-target="#commentCollapse2" aria-expanded="false"
                                        aria-controls="commentCollapse2"><i class="ri-message-3-line me-1"></i>5
                                        Comments</button>
                                    <button type="button" class="btn btn-sm btn-light text-muted fw-medium custom-toggle"
                                        aria-pressed="false">
                                        <span class="icon-off lh-base">
                                            <i class="ri-heart-line me-1"></i>223 Likes
                                        </span>
                                        <span class="icon-on lh-base">
                                            <i class="ri-heart-fill me-1"></i>224 Likes
                                        </span>
                                    </button>
                                    <button class="btn btn-sm btn-light text-muted fw-medium" data-bs-toggle="modal"
                                        data-bs-target="#shareModal"><i class="ri-share-line me-1"></i>Share</button>
                                </div>
                                <button type="button" class="btn btn-sm btn-light text-muted fw-medium custom-toggle"
                                    aria-pressed="false">
                                    <span class="icon-off lh-base">
                                        <i class="ri-bookmark-line me-1"></i>45
                                    </span>
                                    <span class="icon-on lh-base">
                                        <i class="ri-bookmark-fill me-1"></i>46
                                    </span>
                                </button>
                            </div>
                            <div class="collapse" id="commentCollapse2">
                                <div class="pt-4">
                                    <ul class="list-group list-group-flush">
                                        <!-- Comment 1 -->
                                        <li class="list-group-item p-0 mb-3 border-0 d-flex gap-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">Sarah Lee <span
                                                            class="text-muted fs-11 fw-normal">2 hours ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">This is a great solution! Async/await
                                                    really simplifies the process. Would love to see a demo of this in
                                                    action.</p>
                                            </div>
                                        </li>

                                        <!-- Comment 2 -->
                                        <li class="list-group-item p-0 ps-5 mb-3 border-0 d-flex gap-2 bg-transparent">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">David Brown <span
                                                            class="text-muted fs-11 fw-normal">1 hour ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">I implemented this approach in my last
                                                    project, and it worked wonders. The code became much more readable.</p>
                                            </div>
                                        </li>

                                        <!-- Comment 3 -->
                                        <li class="list-group-item p-0 mb-3 border-0 d-flex gap-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">Alex Johnson <span
                                                            class="text-muted fs-11 fw-normal">30 minutes ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">How do you handle multiple simultaneous
                                                    API requests with this approach? Any suggestions?</p>
                                            </div>
                                        </li>
                                    </ul>

                                    <!-- Comment Input -->
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                alt="profile Image" class="avatar rounded-circle">
                                        </div>
                                        <div class="d-flex align-items-center gap-2 flex-grow-1">
                                            <input type="text" class="form-control flex-grow-1"
                                                placeholder="Add a comment...">
                                            <button class="btn btn-primary flex-shrink-0"><i
                                                    class="ri-send-plane-fill"></i>Send</button>
                                        </div>
                                        <button type="button"
                                            class="flex-shrink-0 btn btn-light-secondary icon-btn h-40px w-40px rounded-2"><i
                                                class="ri-emoji-sticker-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card delete-element mb-0">
                        <div class="card-header">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="flex-grow-1 d-flex align-items-center gap-2">
                                    <div class="avatar-item w-max">
                                        <img class="img-fluid avatar"
                                            src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Author Avatar">
                                    </div>
                                    <div>
                                        <h6 class="card-title mb-0"><a href="pages-profile-overview"
                                                class="text-body">Admin</a></h6>
                                        <p class="text-muted fs-13 mb-0 hstack"><i class="ri-time-line me-1"></i>January,
                                            12,2024</p>
                                    </div>
                                </div>
                                <div class="dropdown flex-shrink-0">
                                    <button type="button"
                                        class="btn btn-sm btn-text-secondary rounded-circle icon-btn-sm" id="feedpost4"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-fill fw-semibold"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost4">
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">Share Profile</a>
                                        <a class="dropdown-item" href="#!">Block Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Health Article"
                                    class="img-fluid w-100 max-h-384px object-fit-cover rounded">
                            </div>
                            <a href="#!" class="d-block fs-18 fw-medium text-body my-2 text-truncate-2">Understanding
                                the Impact of Nutrition on Mental Health</a>
                            <p class="fs-13 text-muted">Recent studies highlight the crucial role nutrition plays in mental
                                well-being, emphasizing the need for a balanced diet.
                                Recent studies highlight the crucial role nutrition plays in mental well-being, emphasizing
                                the need for a balanced diet.
                            </p>
                            <hr>
                            <div class="hstack flex-wrap justify-content-between align-items-center gap-3">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <button class="btn btn-sm btn-light text-muted fw-medium" data-bs-toggle="collapse"
                                        data-bs-target="#commentCollapse3" aria-expanded="false"
                                        aria-controls="commentCollapse3"><i class="ri-message-3-line me-1"></i>2
                                        Comments</button>
                                    <button class="btn btn-sm btn-light text-muted fw-medium"><i
                                            class="ri-heart-line me-1"></i>47k Likes</button>
                                    <button class="btn btn-sm btn-light text-muted fw-medium" data-bs-toggle="modal"
                                        data-bs-target="#shareModal"><i class="ri-share-line me-1"></i>Share</button>
                                </div>
                                <button type="button" class="btn btn-sm btn-light text-muted fw-medium custom-toggle"
                                    aria-pressed="false">
                                    <span class="icon-off lh-base">
                                        <i class="ri-bookmark-line me-1"></i>786
                                    </span>
                                    <span class="icon-on lh-base">
                                        <i class="ri-bookmark-fill me-1"></i>787
                                    </span>
                                </button>
                            </div>
                            <div class="collapse" id="commentCollapse3">
                                <div class="pt-4">

                                    <ul class="list-group list-group-flush">

                                        <!-- Comment 1 -->
                                        <li class="list-group-item p-0 mb-3 border-0 d-flex gap-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">Jane Doe <span
                                                            class="text-muted fs-11 fw-normal">1 hour ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">I totally agree! The iMac is fantastic. I
                                                    love the performance and design!</p>
                                            </div>
                                        </li>

                                        <!-- Comment 2 -->
                                        <li class="list-group-item p-0 ps-5 mb-3 border-0 d-flex gap-2 bg-transparent">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">Alice Green <span
                                                            class="text-muted fs-11 fw-normal">30 minutes ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">I was thinking about getting one! Do you
                                                    think it's worth the price?</p>
                                            </div>
                                        </li>

                                        <!-- Nested Reply -->
                                        <li class="list-group-item p-0 ps-5 mb-3 border-0 d-flex gap-2 bg-transparent">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">John Smith <span
                                                            class="text-muted fs-11 fw-normal">10 minutes ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">Absolutely! It's been worth every penny,
                                                    especially for what it offers in terms of performance and design.</p>
                                            </div>
                                        </li>

                                        <!-- Comment 3 -->
                                        <li class="list-group-item p-0 mb-3 border-0 d-flex gap-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="profile Image" class="avatar-sm rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center gap-3 mb-1">
                                                    <h5 class="fs-6 mb-0 flex-grow-1">Mark Johnson <span
                                                            class="text-muted fs-11 fw-normal">5 minutes ago</span></h5>
                                                    <a href="#!"
                                                        class="fs-12 flex-shrink-0 link-body-emphasis">Reply</a>
                                                </div>
                                                <p class="text-muted fs-12 mb-0">Can you share some more details on the
                                                    performance? I need something powerful for video editing.</p>
                                            </div>
                                        </li>
                                    </ul>

                                    <!-- Comment Input -->
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                alt="profile Image" class="avatar rounded-circle">
                                        </div>
                                        <div class="d-flex align-items-center gap-2 flex-grow-1">
                                            <input type="text" class="form-control flex-grow-1"
                                                placeholder="Add a comment...">
                                            <button class="btn btn-primary flex-shrink-0"><i
                                                    class="ri-send-plane-fill"></i>Send</button>
                                        </div>
                                        <button type="button"
                                            class="flex-shrink-0 btn btn-light-secondary icon-btn h-40px w-40px rounded-2 d-none d-sm-block"><i
                                                class="ri-emoji-sticker-line"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-xl-4">
                    <div class="card card-body">
                        <h5 class="card-title">About me</h5>
                        <p class="text-muted fs-13 mb-0">
                            Hello! I'm Theresa Flores, a passionate and dedicated Web Designer based in Australia. I hold a
                            PhD in Academic Studies and have over 4 years of professional experience in crafting
                            user-friendly, aesthetically pleasing websites. My goal is not only to create functional designs
                            but to produce innovative digital experiences that resonate with users and meet business goals.
                        </p>
                    </div>
                    <div class="card card-body">
                        <h5 class="card-title">Contact Info</h5>

                        <div class="mb-3">
                            <p class="text-muted fs-13 mb-0">Location</p>
                            <div class="hstack gap-1">
                                <i class="ri ri-map-pin-2-line fw-medium flex-shrink-0"></i>
                                <p class="flex-grow-1 mb-0 text-truncate-2">Melbourne, Australia</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <p class="text-muted fs-13 mb-0">Email Address</p>
                            <div class="hstack gap-1">
                                <i class="ri ri-mail-line fw-medium flex-shrink-0"></i>
                                <p class="flex-grow-1 mb-0 text-truncate-2">sup.srbthemes@gmail.com</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <p class="text-muted fs-13 mb-0">Phone Number</p>
                            <div class="hstack gap-1">
                                <i class="ri ri-phone-line fw-medium flex-shrink-0"></i>
                                <p class="flex-grow-1 mb-0 text-truncate-2">+61 400 000 000</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <p class="text-muted fs-13 mb-0">Portfolio Website</p>
                            <div class="hstack gap-1">
                                <i class="ri ri-link-line fw-medium flex-shrink-0"></i>
                                <p class="flex-grow-1 mb-0 text-truncate-2"><a href="https://www.google.com"
                                        target="_blank">google.com</a></p>
                            </div>
                        </div>

                        <div>
                            <p class="text-muted fs-13 mb-2">Follow Me</p>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <button type="button" class="btn btn-outline-twitter rounded-circle icon-btn-sm"><i
                                        class="ri-twitter-fill"></i></button>
                                <button type="button" class="btn btn-outline-github rounded-circle icon-btn-sm"><i
                                        class="ri-github-fill"></i></button>
                                <button type="button" class="btn btn-outline-linkedin rounded-circle icon-btn-sm"><i
                                        class="ri-linkedin-box-fill"></i></button>
                                <button type="button" class="btn btn-outline-dribbble rounded-circle icon-btn-sm"><i
                                        class="ri-dribbble-fill"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <h6 class="card-title mb-0 flex-grow-1">Photos</h6>
                            <a href="pages-gallery" class="btn btn-light-secondary btn-sm flex-shrink-0">View Gallery</a>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-4">
                                    <a href="{{ asset('assets/images/gallery/image-1.jpg') }}"
                                        class="thumbnail lightbox">
                                        <img src="{{ asset('assets/images/gallery/image-1.jpg') }}"
                                            class="rounded-2 img-fluid" alt="gallery image">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ asset('assets/images/gallery/image-2.jpg') }}"
                                        class="thumbnail lightbox">
                                        <img src="{{ asset('assets/images/gallery/image-2.jpg') }}"
                                            class="rounded-2 img-fluid" alt="gallery image">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ asset('assets/images/gallery/image-3.jpg') }}"
                                        class="thumbnail lightbox">
                                        <img src="{{ asset('assets/images/gallery/image-3.jpg') }}"
                                            class="rounded-2 img-fluid" alt="gallery image">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ asset('assets/images/gallery/image-4.jpg') }}"
                                        class="thumbnail lightbox">
                                        <img src="{{ asset('assets/images/gallery/image-4.jpg') }}"
                                            class="rounded-2 img-fluid" alt="gallery image">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ asset('assets/images/gallery/image-5.jpg') }}"
                                        class="thumbnail lightbox">
                                        <img src="{{ asset('assets/images/gallery/image-5.jpg') }}"
                                            class="rounded-2 img-fluid" alt="gallery image">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ asset('assets/images/gallery/image-6.jpg') }}"
                                        class="thumbnail lightbox">
                                        <img src="{{ asset('assets/images/gallery/image-6.jpg') }}"
                                            class="rounded-2 img-fluid" alt="gallery image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <h6 class="card-title mb-0 flex-grow-1">Suggested for you</h6>
                            <button class="btn btn-light-secondary btn-sm flex-shrink-0">Edit</button>
                        </div>
                        <div class="card-body">
                            <ul class="list-group fs-13 fw-medium list-group-flush">
                                <li class="list-group-item d-flex hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-white bg-danger me-3 flex-shrink-0">
                                        JD</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!" class="fs-6 fw-bold text-truncate text-body d-block">John
                                                Doe</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">Recently</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm flex-shrink-0 custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-user-add-line fs-14"></i>
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-user-minus-line fs-14"></i>
                                            </span>
                                        </button>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-white bg-success me-3 flex-shrink-0">
                                        EJ</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!" class="fs-6 fw-bold text-truncate text-body d-block">Emily
                                                Johnson</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">Recently</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm flex-shrink-0 custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-user-add-line fs-14"></i>
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-user-minus-line fs-14"></i>
                                            </span>
                                        </button>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-white bg-info me-3 flex-shrink-0">
                                        AS</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!" class="fs-6 fw-bold text-truncate text-body d-block">Alice
                                                Smith</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">Followed by Leo
                                                Dokidis</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm flex-shrink-0 custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-user-add-line fs-14"></i>
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-user-minus-line fs-14"></i>
                                            </span>
                                        </button>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-white bg-warning me-3 flex-shrink-0">
                                        MJ</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!" class="fs-6 fw-bold text-truncate text-body d-block">Michael
                                                Jackson</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">Suggested for
                                                you</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm flex-shrink-0 custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-user-add-line fs-14"></i>
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-user-minus-line fs-14"></i>
                                            </span>
                                        </button>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-white bg-primary me-3 flex-shrink-0">
                                        RG</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!" class="fs-6 fw-bold text-truncate text-body d-block">Rachel
                                                Green</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">Suggested for
                                                you</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm flex-shrink-0 custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-user-add-line fs-14"></i>
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-user-minus-line fs-14"></i>
                                            </span>
                                        </button>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-white bg-secondary me-3 flex-shrink-0">
                                        LP</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!" class="fs-6 fw-bold text-truncate text-body d-block">Liam
                                                Peters</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">Followed by john
                                                doe</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm flex-shrink-0 custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-user-add-line fs-14"></i>
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-user-minus-line fs-14"></i>
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

    </div>



    <!-- Upload Image/Video Modal -->
    <div class="modal modal-lg fade" id="addCategoryModal" tabindex="0" aria-labelledby="addCategoryModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Post Image / Video</h1>
                    <button type="button" class="btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-5">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="post-title">Post Title <span
                                        class="text-danger fw-semibold ps-1">*</span></label>
                                <input type="text" class="form-control" id="post-title" name="post-title"
                                    placeholder="Post title" required>
                                <div class="form-text fs-12">A catchy title for your post. This will be visible to others.
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="post-caption">Caption <span
                                        class="text-danger fw-semibold ps-1">*</span></label>
                                <textarea class="form-control" id="post-caption" name="post-caption" rows="2"
                                    placeholder="Write something..." required></textarea>
                                <div class="form-text fs-12">Write a caption to describe your post.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="media-upload">Upload Media (Image / Video)</label>
                                <div class="position-relative">
                                    <input class="form-control h-100 w-100 position-absolute z-2 opacity-0" type="file"
                                        id="media-upload" accept="image/*, video/*">
                                    <div
                                        class="card-body p-sm-4 border border-light rounded d-flex flex-column align-items-center gap-2 text-center z-1">
                                        <img class="mx-auto img-fluid w-200px h-100px"
                                            src="{{ asset('assets/images/upload-file.png') }}">" alt="File Upload">
                                        <span class="text-muted fs-13">Upload an image or video for your post. Accepted
                                            formats: *.png') }}">, *.jpg, *.jpeg, *.mp4, *.mov</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="post-mentions">Mentions <span
                                        class="text-muted">(optional)</span></label>
                                <input type="text" class="form-control" id="post-mentions" name="post-mentions"
                                    placeholder="Mention someone (e.g., @username)" data-name="team-members">
                                <div class="form-text fs-12">Mention users in your post using @username.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="post-hashtags">Hashtags <span
                                        class="text-muted">(optional)</span></label>
                                <input class="form-control" id='post-hashtags' value='trending, viral'
                                    placeholder="Add hashtags (e.g., #hashtag)">
                                <div class="form-text fs-12">Add hashtags to make your post discoverable.</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label" for="post-description">Post Description</label>
                                <textarea class="form-control" id="post-description" rows="4"
                                    placeholder="Write a description about your post..."></textarea>
                                <div class="form-text fs-12">A detailed description of your post.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="post-visibility">Visibility</label>
                            <select id="post-visibility" class="form-select">
                                <option value="public" selected>Public</option>
                                <option value="friends">Friends</option>
                                <option value="scheduled">Schedule</option>
                                <option value="private">Private</option>
                            </select>
                            <div class="form-text fs-12">Choose who can see your post.</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4 scheduled-input">
                                <label class="form-label" for="post-scheduled-time">Schedule Post</label>
                                <input type="text" class="form-control" id="post-scheduled-time"
                                    placeholder="Pick a date & time">
                                <div class="form-text fs-12">If you want to schedule your post, select a future date and
                                    time.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Post</button>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <!-- Tagify js -->
    <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

    <!-- Lightbox2 js -->
    <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Editor js -->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Cleave js -->
    <script src="{{ asset('assets/libs/cleave.js/cleave.min.js') }}"></script>

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- social feeds init -->
    <script src="{{ asset('assets/js/apps/social/apps-social-feeds.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
