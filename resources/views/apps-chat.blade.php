@extends('partials.layouts.master3')

@section('title', 'Chat | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Social Media')
@section('pagetitle', 'Dashboard')
@section('buttonTitle', 'Share')
@section('link', '#!')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
@endsection

@section('content')


    <div class="chat-wrapper">

        <div class="chat-left">
            <div class="p-3">
                <div class="hstack justify-content-between gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="position-relative w-max">
                            <div class="avatar-item avatar">
                                <img class="img-fluid avatar bg-transparent"
                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                            </div>
                            <span
                                class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                        </div>
                        <div>
                            <h5 class="m-0 fw-semibold">Alon Smith</h5>
                            <p class="m-0 fs-12">Software Developer</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-light-primary icon-btn-sm rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#chat-notification">
                            <i class="ri-notification-4-line"></i>
                        </button>
                        <div class="dropdown">
                            <button type="button" class="btn btn-light-primary icon-btn-sm rounded-pill"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#share-contact">New Chat</a></li>
                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#share-contact">Create Group</a></li>
                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#share-contact">Invite Others</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 chat-filter pt-4">
                    <select id="default-choice">
                        <option value="all">All Chats</option>
                        <option value="friends">Friends</option>
                        <option value="groups">Groups</option>
                        <option value="unread">Unread</option>
                        <option value="archived">Archived</option>
                    </select>
                    <div class="form-icon">
                        <input type="text" class="form-control form-control-icon" id="search-user"
                            placeholder="Search users" required>
                        <i class="ri-search-2-line text-muted"></i>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="d-flex justify-content-between align-items-center gap-2 p-3">
                <span class="text-muted fs-12 lh-1">Pinned Message</span>
                <i class="ri-pushpin-line fs-12"></i>
            </div>
            <div class="max-h-176px px-3 mb-3" data-simplebar>
                <ul class="list-group fs-13 fw-medium list-group-flush">
                    <li class="list-group-item list-group-item-action border-0 rounded-2 mt-0">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar">
                                    <img class="img-fluid avatar bg-transparent"
                                        src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base">
                                        Waldemar Mannering
                                        <i class="ri-checkbox-circle-fill text-primary fs-14"></i>
                                    </h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">
                                        <i class="ri-pushpin-line fs-12 me-1"></i>
                                        5 Minutes
                                    </small>
                                </div>
                                <div class="d-flex align-items-center gap-2 justify-content-between">
                                    <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">Refer friends.</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-action border-0 rounded-2 mt-0">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar">
                                    <img class="img-fluid avatar bg-transparent"
                                        src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-secondary end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base">
                                        Felecia Rower
                                        <i class="ri-checkbox-circle-fill text-primary fs-14"></i>
                                    </h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">
                                        <i class="ri-pushpin-line fs-12 me-1"></i>
                                        30 Minutes
                                    </small>
                                </div>
                                <p class="fs-12 m-0 text-primary lh-1 user-desc text-truncate">Typing...</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-action border-0 rounded-2 mt-0">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar avatar-title border-0 bg-success-subtle text-success">
                                    SR
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base">
                                        Calvin Moore
                                    </h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">
                                        <i class="ri-pushpin-line fs-12 me-1"></i>
                                        21 Minutes
                                    </small>
                                </div>
                                <div class="d-flex align-items-center gap-2 justify-content-between">
                                    <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">If it takes long you can
                                        mail inbox user</p>
                                    <i class="ri-volume-mute-fill"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <hr class="m-0">
            <div class="d-flex justify-content-between align-items-center gap-2 p-3">
                <span class="text-muted fs-12 lh-1">Messages</span>
                <i class="ri-chat-smile-2-line fs-12"></i>
            </div>
            <div class="px-3 chat-list-wrapper" data-simplebar>
                <ul class="list-group fs-13 fw-medium list-group-flush">
                    <li class="list-group-item list-group-item-action border-0 rounded-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar">
                                    <img class="img-fluid avatar bg-transparent"
                                        src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-secondary end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base flex-grow-1">
                                        John Doe
                                        <i class="ri-checkbox-circle-fill text-primary fs-14"></i>
                                    </h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">15 Minutes</small>
                                </div>
                                <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">Looking forward to it! Let's
                                    catch up soon.</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-action border-0 rounded-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar">
                                    <img class="img-fluid avatar bg-transparent"
                                        src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-secondary end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base flex-grow-1">
                                        Sarah Lee
                                        <i class="ri-checkbox-circle-fill text-primary fs-14"></i>
                                    </h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">1 Hour</small>
                                </div>
                                <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">I'll definitely be there.
                                    Can't wait!</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item active list-group-item-action border-0 rounded-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar">
                                    <img class="img-fluid avatar bg-transparent"
                                        src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base flex-grow-1">
                                        Waldemar Mannering
                                        <i class="ri-checkbox-circle-fill text-primary fs-14"></i>
                                    </h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">5 Minutes</small>
                                </div>
                                <div class="d-flex align-items-center gap-2 justify-content-between">
                                    <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">Refer friends.</p>
                                    <div class="badge py-1 bg-primary-subtle text-primary">2</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-action border-0 rounded-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar">
                                    <img class="img-fluid avatar bg-transparent"
                                        src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-secondary end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base flex-grow-1">
                                        Felecia Rower
                                        <i class="ri-checkbox-circle-fill text-primary fs-14"></i>
                                    </h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">30 Minutes</small>
                                </div>
                                <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">I will purchase it for sure.
                                    👍</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-action border-0 rounded-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar avatar-title border-0 bg-success-subtle text-success">SR
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base flex-grow-1">Calvin
                                        Moore</h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">30 Minutes</small>
                                </div>
                                <div class="d-flex align-items-center gap-2 justify-content-between">
                                    <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">If it takes long you can
                                        mail inbox user</p>
                                    <i class="ri-volume-mute-fill"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item list-group-item-action border-0 rounded-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="position-relative flex-shrink-0">
                                <div class="avatar-item avatar avatar-title border-0 bg-danger-subtle text-danger">
                                    <i class="ri-group-line"></i>
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0"></span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base flex-grow-1">
                                        Lovely Family
                                    </h6>
                                    <small class="text-muted user-chat-time flex-shrink-0">30 Minutes</small>
                                </div>
                                <div class="d-flex align-items-center gap-2 justify-content-between">
                                    <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">If it takes long you can
                                        mail inbox user</p>
                                    <i class="ri-volume-mute-fill"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="chat-right">
            <div class="hstack justify-content-between gap-2 p-3 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="position-relative w-max">
                        <div class="avatar-item avatar">
                            <img class="img-fluid avatar bg-transparent"
                                src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
                        </div>
                        <span
                            class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                    </div>
                    <div>
                        <h5 class="m-0 fw-semibold">Alon Smith</h5>
                        <p class="m-0 fs-12">Software Developer</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="d-none d-sm-block btn btn-light-primary icon-btn rounded-pill"
                        data-bs-toggle="modal" data-bs-target="#chat-audio-modal">
                        <i class="ri-phone-line"></i>
                    </button>
                    <button type="button" class="d-none d-sm-block btn btn-light-primary icon-btn rounded-pill"
                        data-bs-toggle="modal" data-bs-target="#chat-video-modal">
                        <i class="ri-vidicon-line"></i>
                    </button>
                    <button type="button" class="d-none d-sm-block btn btn-light-primary icon-btn rounded-pill">
                        <i class="ri-search-2-line"></i>
                    </button>
                    <div class="dropdown">
                        <button type="button" class="btn btn-light-primary icon-btn rounded-pill"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#!" data-bs-toggle="offcanvas"
                                    data-bs-target="#chat-user-info" aria-controls="chat-user-info">
                                    <i class="ri-information-2-line"></i>View Info
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                    data-bs-target="#chat-Muted">
                                    <i class="ri-volume-mute-line"></i>Mute Notifications
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#!">
                                    <i class="ri-image-line"></i>Wallpaper
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                    data-bs-target="#shareModal">
                                    <i class="ri-share-line"></i>Share
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#!">
                                    <i class="ri-archive-2-line"></i>Archive
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item delete-item" href="#!">
                                    <i class="ri-delete-bin-5-line"></i>Delete
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#!">
                                    <i class="ri-spam-2-line"></i>Block
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chat-content p-3" data-simplebar>
                <div class="message delete-element">
                    <div class="message-wrapper">
                        <div class="message-content">Thank you for offering, Patrick. However, I will be worried and I will
                            not be able to relax if you and your brother go by yourselves while I stay home. Let me ask
                            Christine or Ian if one of them can go with both of you. Then I can stay home and relax.
                            Christine! Ian!</div>
                    </div>
                    <div class="message-options">
                        <div class="avatar-item">
                            <img class="img-fluid avatar bg-transparent" alt="user image"
                                src="{{ asset('assets/images/avatar/avatar-10.jpg') }}">
                        </div>
                        <span class="message-date">9:12am</span>
                        <div class="dropdown">
                            <i class="ri-more-fill cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"
                                role="button" aria-label="More options"></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-file-copy-line"></i>Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-reply-line"></i>Replay</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#share-contact"><i class="ri-share-forward-line"></i>Forward</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-pushpin-line"></i>Favourite</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                            class="ri-delete-bin-5-line"></i>Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="message delete-element">
                    <div class="message-wrapper">
                        <div class="message-content">
                            <h6>Gemma Mendez</h6>
                            <span>Yes, Mom. If we go by ourselves, then you can stay home and relax. You will not have to
                                get cold waiting for us.</span>
                        </div>
                    </div>
                    <div class="message-options">
                        <div class="avatar-item">
                            <img class="img-fluid avatar bg-transparent" alt="user image"
                                src="{{ asset('assets/images/avatar/avatar-10.jpg') }}">
                        </div>
                        <span class="message-date">9:12am</span>
                        <div class="dropdown">
                            <i class="ri-more-fill cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"
                                role="button" aria-label="More options"></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-file-copy-line"></i>Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-reply-line"></i>Replay</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#share-contact"><i class="ri-share-forward-line"></i>Forward</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-pushpin-line"></i>Favourite</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                            class="ri-delete-bin-5-line"></i>Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="message right delete-element">
                    <div class="message-wrapper">
                        <div class="message-content">Thank you for offering, Patrick. However, I will be worried and I will
                            not be able to relax if you and your brother go by yourselves while I stay home. Let me ask
                            Christine or Ian if one of them can go with both of you. Then I can stay home and relax.
                            Christine! Ian!</div>
                    </div>
                    <div class="message-options">
                        <div class="avatar-item">
                            <img class="img-fluid avatar bg-transparent" alt="user image"
                                src="{{ asset('assets/images/avatar/avatar-2.jpg') }}">
                        </div>
                        <span class="message-date">9:12am</span>
                        <div class="dropdown">
                            <i class="ri-more-fill cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"
                                role="button" aria-label="More options"></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-file-copy-line"></i>Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-reply-line"></i>Replay</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#share-contact"><i class="ri-share-forward-line"></i>Forward</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-pushpin-line"></i>Favourite</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                            class="ri-delete-bin-5-line"></i>Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="message right">
                    <div class="message-wrapper">
                        <div class="message-content call p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="position-relative flex-shrink-0">
                                    <div class="avatar-item mt-0 d-flex avatar-lg rounded-2 avatar-title border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zm10.761.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-2 flex-grow-1">
                                    <div class="d-flex flex-column gap-2">
                                        <h6 class="fw-medium user-name fs-14 mb-0 text-truncate">Konstantin_cv.docx</h6>
                                        <p class="fs-12 m-0 lh-1 text-truncate">24.65 MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="message-options">
                        <div class="avatar-item">
                            <img class="img-fluid avatar bg-transparent" alt="user image"
                                src="{{ asset('assets/images/avatar/avatar-2.jpg') }}">
                        </div>
                        <span class="message-date">9:12am</span>
                        <div class="dropdown">
                            <i class="ri-more-fill cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"
                                role="button" aria-label="More options"></i>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-file-copy-line"></i>Copy</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-reply-line"></i>Replay</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#share-contact"><i class="ri-share-forward-line"></i>Forward</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!"><i class="ri-pushpin-line"></i>Favourite</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                            class="ri-delete-bin-5-line"></i>Delete</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-send-message d-flex flex-column flex-sm-row gap-2 p-3">
                <div class="hstack flex-grow-1 gap-2">
                    <button type="button" class="btn btn-light-primary icon-btn rounded-2 h-40px w-40px min-w-40px"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                        data-bs-title="Send a emoji">
                        <i class="ri-emoji-sticker-line"></i>
                    </button>
                    <div class="hstack gap-2 w-100">
                        <input type="text" class="form-control flex-grow-1" placeholder="Type a message">
                        <button class="btn btn-primary flex-shrink-0">
                            <i class="ri-send-plane-fill"></i>
                            <span class="d-none d-lg-inline-block">Send</span>
                        </button>
                    </div>
                </div>
                <div class="hstack flex-shrink-0 gap-2 d-none d-sm-flex">
                    <button type="button" class="btn btn-light-primary icon-btn h-40px w-40px rounded-2"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                        data-bs-title="Send a voice clip">
                        <i class="ri-mic-line"></i>
                    </button>
                    <button type="button" class="btn btn-light-primary icon-btn h-40px w-40px rounded-2"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                        data-bs-title="Send a image">
                        <i class="ri-camera-line"></i>
                    </button>
                    <button type="button" class="btn btn-light-primary icon-btn h-40px w-40px rounded-2"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top"
                        data-bs-title="Attach a file">
                        <i class="ri-attachment-line"></i>
                    </button>
                </div>
            </div>
        </div>

        @include('partials.share-contact-modal')
        @include('partials.social-share-modal')


        <!-- start:: Notification Modal -->
        <div class="modal fade" id="chat-notification" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="centeredLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="centeredLabel">Notifications</h5>
                        <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ri-close-large-line fw-semibold"></i>
                        </button>
                    </div>
                    <div class="modal-body p-0">

                        <ul class="list-group list-group-flush  py-2">

                            <!-- List Group Item Start -->
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        class="avatar-item avatar-lg avatar-title text-primary bg-primary-subtle border-0">
                                        <i class="ri-user-fill"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>
                                            <a href="#!">Catherine richardson</a> send you a friend request
                                        </h6>

                                        <p class="text-muted mb-0">5 mins ago</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-2">
                                    <button type="button" class="btn btn-sm btn-outline-danger mx-1">Reject</button>
                                    <button type="button" class="btn btn-sm btn-primary mx-1">Accept</button>
                                </div>

                            </li>
                            <!-- List Group Item End -->

                            <!-- List Group Item Start -->
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        class="avatar-item avatar-lg avatar-title text-primary bg-primary-subtle border-0">
                                        <i class="ri-user-fill"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6>
                                            <a href="#!">Katelyn Valdez</a> accepted your friend request
                                        </h6>

                                        <p class="text-muted mb-0">25 mins ago</p>
                                    </div>
                                </div>
                            </li>
                            <!-- List Group Item End -->

                            <!-- List Group Item Start -->
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        class="avatar-item avatar-lg avatar-title text-primary bg-primary-subtle border-0">
                                        <i class="ri-user-fill"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6>
                                            <a href="#!">Eva Walker</a> updated profile picture
                                        </h6>

                                        <p class="text-muted mb-0">5 mins ago</p>
                                    </div>
                                </div>
                            </li>
                            <!-- List Group Item End -->

                            <!-- List Group Item Start -->
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        class="avatar-item avatar-lg avatar-title text-primary bg-primary-subtle border-0">
                                        <i class="ri-user-fill"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6>
                                            <a href="#!">Bonnie Torres</a> accepted your friend request
                                        </h6>

                                        <p class="text-muted mb-0">5 mins ago</p>
                                    </div>
                                </div>
                            </li>
                            <!-- List Group Item End -->

                            <!-- List Group Item Start -->
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        class="avatar-item avatar-lg avatar-title text-primary bg-primary-subtle border-0">
                                        <i class="ri-user-fill"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6>
                                            <a href="#!">Christopher Garcia</a> updated profile picture
                                        </h6>

                                        <p class="text-muted mb-0">5 mins ago</p>
                                    </div>
                                </div>
                            </li>
                            <!-- List Group Item End -->
                        </ul>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-text-primary btn-sm m-0" data-bs-dismiss="modal">Clear
                            All</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: Notification Modal -->

        <!-- start:: Chat Audio Modal -->
        <div class="modal fade chat-audio-modal" id="chat-audio-modal" data-bs-keyboard="false" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="chat-audio-modal" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content overflow-hidden border-0">
                    <img class="img-fluid h-160px" src="{{ asset('assets/images/small/img-1.jpg') }}" alt="cover image">

                    <div class="d-flex justify-content-center">
                        <div class="avatar-item border-2">
                            <img class="img-fluid avatar-xl object-fit-cover"
                                src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
                        </div>
                    </div>
                    <div class="mt-5 d-flex flex-column justify-content-center text-center">
                        <span class="text-muted fs-12 mb-1">Calling ...</span>
                        <h5 class="m-0 fw-semibold">Alon Smith</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-2 min-h-80px">
                        <button type="button" class="btn btn-light-secondary icon-btn rounded-pill">
                            <i class="ri-user-add-line"></i>
                        </button>
                        <button type="button" class="btn btn-light-secondary icon-btn rounded-pill">
                            <i class="ri-volume-mute-line"></i>
                        </button>
                        <button type="button" class="btn btn-light-danger icon-btn rounded-pill"
                            data-bs-dismiss="modal">
                            <i class="ri-phone-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: Chat Audio Modal -->

        <!-- start:: Chat Video Modal -->
        <div class="modal fade chat-video-modal" id="chat-video-modal" data-bs-keyboard="false" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="chat-video-modal" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content overflow-hidden border-0 p-5">
                    <div class="z-1 min-h-384px d-flex flex-column justify-content-between gap-5">
                        <div>
                            <div class="d-flex justify-content-center">
                                <div class="avatar-item border-2 rounded-0">
                                    <img class="img-fluid avatar-xl rounded-0"
                                        src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                </div>
                            </div>
                            <div class="mt-5 d-flex flex-column justify-content-center text-center">
                                <span class="fs-12 mb-1 text-white">Talking With ...</span>
                                <h5 class="m-0 fw-semibold text-white">Alon Smith</h5>
                                <span class="fs-12 mb-1 text-white">02:09 min</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <button type="button" class="btn btn-light-secondary icon-btn rounded-pill">
                                <i class="ri-user-add-line"></i>
                            </button>
                            <button type="button" class="btn btn-light-secondary icon-btn rounded-pill">
                                <i class="ri-volume-mute-line"></i>
                            </button>
                            <button type="button" class="btn btn-light-danger icon-btn rounded-pill"
                                data-bs-dismiss="modal">
                                <i class="ri-phone-line"></i>
                            </button>
                        </div>
                    </div>
                    <img class="img-fluid position-absolute top-0 bottom-0 start-0 end-0 object-fit-cover w-100 h-100 z-0"
                        src="{{ asset('assets/images/avatar/video-bg.jpg') }}" alt="bacground image">

                </div>
            </div>
        </div>
        <!-- End:: Chat Video Modal -->

        <!-- start:: Muted Modal -->
        <div class="modal fade" id="chat-Muted" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mutedLabel"
            aria-hidden="true">
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
                                <input class="form-check-input" type="radio" name="chat-mute" id="chat-mute-01"
                                    checked>
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
        <!-- End:: Muted Modal -->

        <!-- start:: End Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="chat-user-info" aria-labelledby="chat-user-infoLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="offcanvasStartLabel">Profile Details</h5>
                <button type="button" class="close btn btn-text-primary icon-btn-sm ms-auto" data-bs-dismiss="offcanvas"
                    aria-label="Close">
                    <i class="ri-close-large-line fw-semibold"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <div class="position-relative w-max mx-auto">
                    <div class="avatar-item">
                        <img class="img-fluid avatar-xl" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}"
                            alt="avatar image">
                    </div>
                    <span
                        class="position-absolute border-3 border border-white h-20px w-20px rounded-circle bg-success end-0 bottom-0"></span>
                </div>
                <div class="text-center p-3">
                    <h5 class="mb-1">Catherine Richardson</h5>
                    <p class="text-muted d-flex align-items-center justify-content-center gap-2">
                        <i class="ri-map-pin-line"></i>
                        <span>San Fransisco, CA</span>
                    </p>
                </div>
                <!-- Nav tabs -->
                <ul class="nav gap-3 nav-tabs-bordered text-center mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#demo-tab-6_home" role="tab"
                            aria-selected="false" tabindex="-1">
                            <i class="ri-information-line d-block fs-20 mb-1"></i>
                            <span class="d-none d-sm-block">Info</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#demo-tab-6_profile" role="tab"
                            aria-selected="true">
                            <i class="ri-image-line d-block fs-20 mb-1"></i>
                            <span class="d-none d-sm-block">Media</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#demo-tab-6_messages" role="tab"
                            aria-selected="false" tabindex="-1">
                            <i class="ri-list-settings-line d-block fs-20 mb-1"></i>
                            <span class="d-none d-sm-block">Options</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane" id="demo-tab-6_home" role="tabpanel">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 ">
                                <p class="small text-muted mb-0">Phone</p>
                                <p class="mb-0">+01-222-364522</p>
                            </li>
                            <li class="list-group-item px-0 ">
                                <p class="small text-muted mb-0">Email</p>
                                <p class="mb-0">catherine.richardson@gmail.com</p>
                            </li>
                            <li class="list-group-item px-0 ">
                                <p class="small text-muted mb-0">Address</p>
                                <p class="mb-0">1134 Ridder Park Road, San Fransisco, CA 94851</p>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane active show" id="demo-tab-6_profile" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center gap-2 my-5">
                            <h6 class="mb-0">Last Media</h6>
                            <i class="ri-image-line fs-12"></i>
                        </div>
                        <div class="row g-3">
                            <div class="col-4">
                                <a href="{{ asset('assets/images/gallery/image-1.jpg') }}" class="thumbnail lightbox">
                                    <img src="{{ asset('assets/images/gallery/image-1.jpg') }}"
                                        class="img-fluid rounded-2" alt="gallery image">
                                </a>
                            </div><!-- .col -->
                            <div class="col-4">
                                <a href="{{ asset('assets/images/gallery/image-2.jpg') }}" class="thumbnail lightbox">
                                    <img src="{{ asset('assets/images/gallery/image-2.jpg') }}"
                                        class="img-fluid rounded-2" alt="gallery image">
                                </a>
                            </div><!-- .col -->
                            <div class="col-4">
                                <a href="{{ asset('assets/images/gallery/image-3.jpg') }}" class="thumbnail lightbox">
                                    <img src="{{ asset('assets/images/gallery/image-3.jpg') }}"
                                        class="img-fluid rounded-2" alt="gallery image">
                                </a>
                            </div><!-- .col -->
                            <div class="col-4">
                                <a href="{{ asset('assets/images/gallery/image-4.jpg') }}" class="thumbnail lightbox">
                                    <img src="{{ asset('assets/images/gallery/image-4.jpg') }}"
                                        class="img-fluid rounded-2" alt="gallery image">
                                </a>
                            </div><!-- .col -->
                            <div class="col-4">
                                <a href="{{ asset('assets/images/gallery/image-5.jpg') }}" class="thumbnail lightbox">
                                    <img src="{{ asset('assets/images/gallery/image-5.jpg') }}"
                                        class="img-fluid rounded-2" alt="gallery image">
                                </a>
                            </div><!-- .col -->
                            <div class="col-4">
                                <a href="{{ asset('assets/images/gallery/image-6.jpg') }}" class="thumbnail lightbox">
                                    <img src="{{ asset('assets/images/gallery/image-6.jpg') }}"
                                        class="img-fluid rounded-2" alt="gallery image">
                                </a>
                            </div><!-- .col -->
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-2 mt-5 mb-3">
                            <h6 class="mb-0">Documents</h6>
                            <i class="ri-file-list-3-line fs-12"></i>
                        </div>
                        <ul class="list-group fs-13 fw-medium list-group-flush">
                            <li class="list-group-item d-flex align-items-center gap-3 px-0 py-4">
                                <div class="position-relative flex-shrink-0">
                                    <div
                                        class="avatar-item avatar-lg rounded-2 avatar-title border-0 bg-secondary-subtle text-secondary">
                                        <i class="ri-group-line"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-2 flex-grow-1">
                                    <div class="d-flex flex-column gap-2">
                                        <h6 class="fw-medium user-name fs-14 mb-0 text-truncate">
                                            Konstantin_cv.docx
                                        </h6>
                                        <p class="fs-12 m-0 lh-1 text-truncate">
                                            24.65 MB
                                        </p>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-text-primary icon-btn-sm rounded-pill"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#!">
                                                    <i class="ri-file-download-line"></i>
                                                    Download
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#!">
                                                    <i class="ri-share-line"></i>
                                                    Share
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-item" href="#!">
                                                    <i class="ri-delete-bin-5-line"></i>
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center gap-3 px-0 py-4">
                                <div class="position-relative flex-shrink-0">
                                    <div
                                        class="avatar-item avatar-lg rounded-2 avatar-title border-0 bg-secondary-subtle text-secondary">
                                        <i class="ri-group-line"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-2 flex-grow-1">
                                    <div class="d-flex flex-column gap-2">
                                        <h6 class="fw-medium user-name fs-14 mb-0 text-truncate">
                                            Konstantin_cv.docx
                                        </h6>
                                        <p class="fs-12 m-0 lh-1 text-truncate">
                                            24.65 MB
                                        </p>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-text-primary icon-btn-sm rounded-pill"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#!">
                                                    <i class="ri-file-download-line"></i>Download
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#!">
                                                    <i class="ri-share-line"></i>Share
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-item" href="#!">
                                                    <i class="ri-delete-bin-5-line"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="demo-tab-6_messages" role="tabpanel">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 d-flex align-items-center gap-3">
                                <div
                                    class="avatar-item avatar-lg rounded-2 avatar-title border-0 bg-secondary-subtle text-secondary">
                                    <i class="ri-user-unfollow-line"></i>
                                </div>
                                <div>
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate">Block</h6>
                                    <span class="fs-12 m-0 lh-1 text-truncate">Frank will no longer be in your
                                        contact.</span>
                                </div>
                            </li>
                            <li class="list-group-item px-0 d-flex align-items-center gap-3">
                                <div
                                    class="avatar-item avatar-lg rounded-2 avatar-title border-0 bg-secondary-subtle text-secondary">
                                    <i class="ri-alert-line"></i>
                                </div>
                                <div>
                                    <h6 class="fw-medium user-name fs-14 mb-0 text-truncate">Report</h6>
                                    <span class="fs-12 m-0 lh-1 text-truncate">Give feedback on the conversation</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- end:: End Offcanvas -->

    </div>
@endsection

@section('js')
    <!-- Lightbox2 js -->
    <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Chat init -->
    <script src="{{ asset('assets/js/apps/apps-chat.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
