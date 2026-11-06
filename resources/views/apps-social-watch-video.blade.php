@extends('partials.layouts.master2')
@section('title', 'Watch Video | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Watch Video')
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
            <div class="row">
                <div class="col-12 col-xl-8">
                    <div class="row g-4">
                        <div class="col-sm-6 col-lg-6 delete-element">
                            <div class="card mb-0">
                                <div class="card-header hstack">
                                    <div class="hstack gap-2 flex-grow-1">
                                        <img class="img-fluid avatar avatar-item"
                                            src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
                                        <div>
                                            <a href="#!" class="fs-6 fw-bold text-body">John Doe</a>
                                            <p class="text-muted fs-12 mb-0">Published: 5 January, 2025</p>
                                        </div>
                                    </div>
                                    <div class="dropdown flex-shrink-0">
                                        <button type="button"
                                            class="btn btn-sm btn-text-primary rounded-circle icon-btn-sm" id="feedpost11"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-line fw-semibold"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost11">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareModal">Share video</a>
                                            <a class="dropdown-item" href="#!">Report Video</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative text-bg-dark overflow-hidden rounded-3 overlay">
                                        <img class="card-img rounded h-208px object-fit-cover"
                                            src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Card image overlay">
                                        <div class="card-img-overlay overlay-content">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <a href="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com"
                                                    class="thumbnail lightbox text-white">
                                                    <i class="ri-play-circle-line fs-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-heart-line me-1"></i>145
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-heart-fill me-1"></i>146
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-bookmark-line me-1"></i>72
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-bookmark-fill me-1"></i>73
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <a href="#!" class="fs-13 text-muted" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <i class="ri-share-line me-1"></i>80
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-grow-1 w-100">
                                        <input type="text" class="form-control flex-grow-1"
                                            placeholder="Add a comment...">
                                        <button class="btn btn-primary flex-shrink-0"><i
                                                class="ri-send-plane-fill"></i>Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 delete-element">
                            <div class="card mb-0">
                                <div class="card-header hstack">
                                    <div class="hstack gap-2 flex-grow-1">
                                        <img class="img-fluid avatar avatar-item"
                                            src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
                                        <div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Emma Stone</a>
                                            <p class="text-muted fs-12 mb-0">Published: 8 January, 2025</p>
                                        </div>
                                    </div>
                                    <div class="dropdown flex-shrink-0">
                                        <button type="button"
                                            class="btn btn-sm btn-text-primary rounded-circle icon-btn-sm" id="feedpost22"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-line fw-semibold"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost22">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareModal">Share video</a>
                                            <a class="dropdown-item" href="#!">Report Video</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative text-bg-dark overflow-hidden rounded-3 overlay">
                                        <img class="card-img rounded h-208px object-fit-cover"
                                            src="{{ asset('assets/images/small/img-4.jpg') }}" alt="Card image overlay">
                                        <div class="card-img-overlay overlay-content">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <a href="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com"
                                                    class="thumbnail lightbox text-white">
                                                    <i class="ri-play-circle-line fs-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-heart-line me-1"></i>90
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-heart-fill me-1"></i>91
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-bookmark-line me-1"></i>30
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-bookmark-fill me-1"></i>31
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <a href="#!" class="fs-13 text-muted" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <i class="ri-share-line me-1"></i>45
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-grow-1 w-100">
                                        <input type="text" class="form-control flex-grow-1"
                                            placeholder="Add a comment...">
                                        <button class="btn btn-primary flex-shrink-0"><i
                                                class="ri-send-plane-fill"></i>Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 delete-element">
                            <div class="card mb-0">
                                <div class="card-header hstack">
                                    <div class="hstack gap-2 flex-grow-1">
                                        <img class="img-fluid avatar avatar-item"
                                            src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
                                        <div>
                                            <a href="#!" class="fs-6 fw-bold text-body">James Holden</a>
                                            <p class="text-muted fs-12 mb-0">Published: 3 January, 2025</p>
                                        </div>
                                    </div>
                                    <div class="dropdown flex-shrink-0">
                                        <button type="button"
                                            class="btn btn-sm btn-text-primary rounded-circle icon-btn-sm" id="feedpost33"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-line fw-semibold"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost33">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareModal">Share video</a>
                                            <a class="dropdown-item" href="#!">Report Video</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative text-bg-dark overflow-hidden rounded-3 overlay">
                                        <img class="card-img rounded h-208px object-fit-cover"
                                            src="{{ asset('assets/images/small/img-5.jpg') }}" alt="Card image overlay">
                                        <div class="card-img-overlay overlay-content">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <a href="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com"
                                                    class="thumbnail lightbox text-white">
                                                    <i class="ri-play-circle-line fs-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-heart-line me-1"></i>200
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-heart-fill me-1"></i>201
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-bookmark-line me-1"></i>40
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-bookmark-fill me-1"></i>41
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <a href="#!" class="fs-13 text-muted" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <i class="ri-share-line me-1"></i>50
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-grow-1 w-100">
                                        <input type="text" class="form-control flex-grow-1"
                                            placeholder="Add a comment...">
                                        <button class="btn btn-primary flex-shrink-0"><i
                                                class="ri-send-plane-fill"></i>Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 delete-element">
                            <div class="card mb-0">
                                <div class="card-header hstack">
                                    <div class="hstack gap-2 flex-grow-1">
                                        <img class="img-fluid avatar avatar-item"
                                            src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                                        <div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Sophia Lawrence</a>
                                            <p class="text-muted fs-12 mb-0">Published: 9 January, 2025</p>
                                        </div>
                                    </div>
                                    <div class="dropdown flex-shrink-0">
                                        <button type="button"
                                            class="btn btn-sm btn-text-primary rounded-circle icon-btn-sm" id="feedpost44"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-line fw-semibold"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost44">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareModal">Share video</a>
                                            <a class="dropdown-item" href="#!">Report Video</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative text-bg-dark overflow-hidden rounded-3 overlay">
                                        <img class="card-img rounded h-208px object-fit-cover"
                                            src="{{ asset('assets/images/small/img-6.jpg') }}" alt="Card image overlay">
                                        <div class="card-img-overlay overlay-content">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <a href="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com"
                                                    class="thumbnail lightbox text-white">
                                                    <i class="ri-play-circle-line fs-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-heart-line me-1"></i>300
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-heart-fill me-1"></i>301
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-bookmark-line me-1"></i>90
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-bookmark-fill me-1"></i>91
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <a href="#!" class="fs-13 text-muted" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <i class="ri-share-line me-1"></i>100
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-grow-1 w-100">
                                        <input type="text" class="form-control flex-grow-1"
                                            placeholder="Add a comment...">
                                        <button class="btn btn-primary flex-shrink-0"><i
                                                class="ri-send-plane-fill"></i>Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 delete-element">
                            <div class="card mb-0">
                                <div class="card-header hstack">
                                    <div class="hstack gap-2 flex-grow-1">
                                        <img class="img-fluid avatar avatar-item"
                                            src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
                                        <div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Liam Johnson</a>
                                            <p class="text-muted fs-12 mb-0">Published: 2 January, 2025</p>
                                        </div>
                                    </div>
                                    <div class="dropdown flex-shrink-0">
                                        <button type="button"
                                            class="btn btn-sm btn-text-primary rounded-circle icon-btn-sm" id="feedpost55"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-line fw-semibold"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost55">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareModal">Share video</a>
                                            <a class="dropdown-item" href="#!">Report Video</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative text-bg-dark overflow-hidden rounded-3 overlay">
                                        <img class="card-img rounded h-208px object-fit-cover"
                                            src="{{ asset('assets/images/small/img-7.jpg') }}" alt="Card image overlay">
                                        <div class="card-img-overlay overlay-content">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <a href="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com"
                                                    class="thumbnail lightbox text-white">
                                                    <i class="ri-play-circle-line fs-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-heart-line me-1"></i>400
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-heart-fill me-1"></i>401
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-bookmark-line me-1"></i>100
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-bookmark-fill me-1"></i>101
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <a href="#!" class="fs-13 text-muted" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <i class="ri-share-line me-1"></i>120
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-grow-1 w-100">
                                        <input type="text" class="form-control flex-grow-1"
                                            placeholder="Add a comment...">
                                        <button class="btn btn-primary flex-shrink-0"><i
                                                class="ri-send-plane-fill"></i>Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 delete-element">
                            <div class="card mb-0">
                                <div class="card-header hstack">
                                    <div class="hstack gap-2 flex-grow-1">
                                        <img class="img-fluid avatar avatar-item"
                                            src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="avatar image">
                                        <div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Olivia Davis</a>
                                            <p class="text-muted fs-12 mb-0">Published: 1 January, 2025</p>
                                        </div>
                                    </div>
                                    <div class="dropdown flex-shrink-0">
                                        <button type="button"
                                            class="btn btn-sm btn-text-primary rounded-circle icon-btn-sm" id="feedpost66"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-line fw-semibold"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost66">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareModal">Share video</a>
                                            <a class="dropdown-item" href="#!">Report Video</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative text-bg-dark overflow-hidden rounded-3 overlay">
                                        <img class="card-img rounded h-208px object-fit-cover"
                                            src="{{ asset('assets/images/small/img-8.jpg') }}" alt="Card image overlay">
                                        <div class="card-img-overlay overlay-content">
                                            <div class="h-100 d-flex align-items-center justify-content-center">
                                                <a href="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com"
                                                    class="thumbnail lightbox text-white">
                                                    <i class="ri-play-circle-line fs-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-top">
                                    <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-heart-line me-1"></i>500
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-heart-fill me-1"></i>501
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <div class="fs-13 text-muted custom-toggle cursor-pointer" role="button"
                                            aria-pressed="false">
                                            <span class="icon-off lh-base">
                                                <i class="ri-bookmark-line me-1"></i>120
                                            </span>
                                            <span class="icon-on lh-base">
                                                <i class="ri-bookmark-fill me-1"></i>121
                                            </span>
                                        </div>
                                        <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                                        <a href="#!" class="fs-13 text-muted" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <i class="ri-share-line me-1"></i>140
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 flex-grow-1 w-100">
                                        <input type="text" class="form-control flex-grow-1"
                                            placeholder="Add a comment...">
                                        <button class="btn btn-primary flex-shrink-0"><i
                                                class="ri-send-plane-fill"></i>Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex gap-3 justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Favorite Watchlist</h5>
                                <div class="dropdown flex-shrink-0">
                                    <button type="button" class="btn btn-sm btn-text-primary rounded-circle icon-btn-sm"
                                        id="feedpost666" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-line fw-semibold"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost66">
                                        <a class="dropdown-item" href="#!">
                                            <i class="ri-play-large-line fs-6 me-2"></i> Play Watchlist
                                        </a>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <i class="ri-share-line fs-6 me-2"></i> Share Watchlist
                                        </a>
                                        <a class="dropdown-item" href="#!">
                                            <i class="ri-eye-line fs-6 me-2"></i> View Details
                                        </a>
                                        <a class="dropdown-item" href="#!">
                                            <i class="ri-link-m fs-6 me-2"></i> Copy Link
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-item" href="#!">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group fs-13 fw-medium list-group-flush">

                                <li class="list-group-item hstack gap-3 rounded px-0 pt-0">
                                    <img class="avatar-item border-0 avatar avatar-title flex-shrink-0"
                                        src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="profile Image">
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!"
                                                class="fs-6 fw-semibold text-truncate text-body d-block">Carter Vaccaro</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">8 New
                                                videos</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm rounded-circle flex-shrink-0">
                                            <i class="ri-play-large-fill fs-6"></i>
                                        </button>
                                    </div>
                                </li>

                                <li class="list-group-item hstack gap-3 rounded px-0">
                                    <img class="avatar-item border-0 avatar avatar-title flex-shrink-0"
                                        src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="profile Image">
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!"
                                                class="fs-6 fw-semibold text-truncate text-body d-block">Jordan Powell</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">5 New
                                                videos</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm rounded-circle flex-shrink-0">
                                            <i class="ri-play-large-fill fs-6"></i>
                                        </button>
                                    </div>
                                </li>

                                <li class="list-group-item hstack gap-3 rounded px-0">
                                    <img class="avatar-item border-0 avatar avatar-title flex-shrink-0"
                                        src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="profile Image">
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!"
                                                class="fs-6 fw-semibold text-truncate text-body d-block">Alice
                                                Hernandez</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">3 New
                                                videos</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm rounded-circle flex-shrink-0">
                                            <i class="ri-play-large-fill fs-6"></i>
                                        </button>
                                    </div>
                                </li>

                                <li class="list-group-item hstack gap-3 rounded px-0">
                                    <img class="avatar-item border-0 avatar avatar-title flex-shrink-0"
                                        src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="profile Image">
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!"
                                                class="fs-6 fw-semibold text-truncate text-body d-block">Liam Turner</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">2 New
                                                videos</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm rounded-circle flex-shrink-0">
                                            <i class="ri-play-large-fill fs-6"></i>
                                        </button>
                                    </div>
                                </li>

                                <li class="list-group-item hstack gap-3 rounded px-0">
                                    <img class="avatar-item border-0 avatar avatar-title flex-shrink-0"
                                        src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="profile Image">
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!"
                                                class="fs-6 fw-semibold text-truncate text-body d-block">Ethan Brooks</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">4 New
                                                videos</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm rounded-circle flex-shrink-0">
                                            <i class="ri-play-large-fill fs-6"></i>
                                        </button>
                                    </div>
                                </li>

                                <li class="list-group-item hstack gap-3 rounded px-0">
                                    <img class="avatar-item border-0 avatar avatar-title flex-shrink-0"
                                        src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="profile Image">
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!" class="fs-6 fw-semibold text-truncate text-body d-block">Mia
                                                Bennett</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">6 New
                                                videos</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm rounded-circle flex-shrink-0">
                                            <i class="ri-play-large-fill fs-6"></i>
                                        </button>
                                    </div>
                                </li>

                                <li class="list-group-item hstack gap-3 rounded px-0">
                                    <img class="avatar-item border-0 avatar avatar-title flex-shrink-0"
                                        src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="profile Image">
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <div class="flex-grow-1 me-2 overflow-hidden">
                                            <a href="#!"
                                                class="fs-6 fw-semibold text-truncate text-body d-block">Lucas Walker</a>
                                            <span class="text-muted fw-medium d-block text-truncate fs-12">9 New
                                                videos</span>
                                        </div>
                                        <button type="button"
                                            class="btn btn-light-primary icon-btn-sm rounded-circle flex-shrink-0">
                                            <i class="ri-play-large-fill fs-6"></i>
                                        </button>
                                    </div>
                                </li>

                                <li class="list-group-item hstack gap-3 rounded px-0 pb-0">
                                    <a href="#!" class="text-muted">See All</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="d-flex gap-3 justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Your Subscriptions</h5>
                                <div class="dropdown flex-shrink-0">
                                    <button type="button" class="btn btn-sm btn-text-primary rounded-circle icon-btn-sm"
                                        id="feedpost77" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-line fw-semibold"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost77">
                                        <a class="dropdown-item" href="#!">
                                            <i class="ri-close-circle-line fs-6 me-2"></i> Unsubscribe
                                        </a>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#muted-notification">
                                            <i class="ri-volume-mute-line fs-6 me-2"></i>Mute Notifications
                                        </a>
                                        <a class="dropdown-item" href="#!">
                                            <i class="ri-bar-chart-line fs-6 me-2"></i> View Activity
                                        </a>
                                        <a class="dropdown-item" href="#!">
                                            <i class="ri-play-circle-line fs-6 me-2"></i> Turn on/off Autoplay
                                        </a>
                                        <a class="dropdown-item" href="#!">
                                            <i class="ri-feedback-line fs-6 me-2"></i> Send Feedback
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-item" href="#!">
                                            <i class="ri-delete-bin-line fs-6 me-2"></i>Remove
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group fs-13 fw-medium list-group-flush">

                                <li class="list-group-item hstack rounded px-0 pt-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-bg-primary me-3 flex-shrink-0">
                                        ME</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-semibold text-truncate text-body d-block">Marvel
                                            Entertainment</a>
                                    </div>
                                </li>

                                <li class="list-group-item hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-bg-warning me-3 flex-shrink-0">
                                        NG</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <a href="#!"
                                            class="fs-6 fw-semibold text-truncate text-body d-block">National
                                            Geographic</a>
                                    </div>
                                </li>

                                <li class="list-group-item hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-bg-success me-3 flex-shrink-0">
                                        GW</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-semibold text-truncate text-body d-block">Gaming
                                            World</a>
                                    </div>
                                </li>

                                <li class="list-group-item hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-bg-danger me-3 flex-shrink-0">
                                        HL</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-semibold text-truncate text-body d-block">Healthy
                                            Living</a>
                                    </div>
                                </li>

                                <li class="list-group-item hstack rounded px-0">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-bg-secondary me-3 flex-shrink-0">
                                        CC</div>
                                    <div class="d-flex align-items-center flex-grow-1 overflow-hidden">
                                        <a href="#!" class="fs-6 fw-semibold text-truncate text-body d-block">Cooking
                                            with Carla</a>
                                    </div>
                                </li>

                                <li class="list-group-item hstack gap-3 rounded px-0 pb-0">
                                    <a href="#!" class="text-muted">See All</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Mute Notification -->
    <div class="modal fade" id="muted-notification" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="mutedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex justify-content-center w-100" id="mutedLabel">Mute conversation</h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div>
                        <div class="form-check form-check-primary mb-3">
                            <input class="form-check-input" type="radio" name="chat-mute" id="chat-mute-01" checked>
                            <label class="form-check-label" for="chat-mute-01">
                                Mute message notifications
                            </label>
                        </div>
                        <div class="form-check form-check-primary mb-3">
                            <input class="form-check-input" type="radio" name="chat-mute" id="chat-mute-02">
                            <label class="form-check-label" for="chat-mute-02">
                                Mute call notifications
                            </label>
                        </div>
                        <div class="form-check form-check-primary">
                            <input class="form-check-input" type="radio" name="chat-mute" id="chat-mute-03">
                            <label class="form-check-label" for="chat-mute-03">
                                Mute message and call notifications
                            </label>
                        </div>
                    </div>

                    <p class="fs-12 text-muted mt-5 mb-0">
                        Chat windows will stay closed and you won't get push notifications on your devices.
                    </p>

                </div>
                <div class="modal-footer justify-content-center gap-3">
                    <button type="button" class="btn btn-outline-danger m-0" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary m-0" data-bs-dismiss="modal">Next</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- Lightbox2 js -->
    <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <!-- social feeds init -->
    <script src="{{ asset('assets/js/apps/social/apps-social-feeds.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
