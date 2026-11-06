<!-- start:: New Chat Modal -->
<div class="modal fade chat-new-contact" id="share-contact" tabindex="-1" aria-labelledby="shareContactLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close btn btn-text-primary icon-btn-sm ms-auto" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-large-line fw-semibold"></i>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="mb-5 pb-5 text-center">
                    <h5 class="modal-title d-flex justify-content-center w-100" id="shareContactLabel">Search Users</h5>
                    <div class="text-muted fw-semibold fs-6">
                        Invite Collaborators To Your Project
                    </div>
                </div>
                <div>
                    <div class="form-icon mb-5">
                        <input type="text" class="form-control form-control-icon" id="add-new-contact" placeholder="Search users" required>
                        <i class="ri-search-2-line text-muted"></i>
                    </div>
                    <ul class="list-group fs-13 fw-medium list-group-flush">
                        <li class="list-group-item active list-group-item-action rounded-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="position-relative flex-shrink-0">
                                    <div class="avatar-item avatar">
                                        <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                    </div>
                                    <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                        <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base">
                                            Waldemar Mannering
                                            <i class="ri-checkbox-circle-fill text-primary fs-14"></i>
                                        </h6>
                                        <small class="text-muted user-chat-time">5 Minutes</small>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">Online</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action rounded-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="position-relative flex-shrink-0">
                                    <div class="avatar-item avatar">
                                        <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                                    </div>
                                    <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                        <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base">
                                            Felecia Rower
                                            <i class="ri-checkbox-circle-fill text-primary fs-14"></i>
                                        </h6>
                                        <small class="text-muted user-chat-time">30 Minutes</small>
                                    </div>
                                    <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">Online</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item list-group-item-action rounded-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="position-relative flex-shrink-0">
                                    <div class="avatar-item avatar avatar-title border-0 bg-success-subtle text-success">
                                        CM
                                    </div>
                                    <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0"></span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                        <h6 class="fw-medium user-name fs-14 mb-0 text-truncate lh-base">
                                            Calvin Moore
                                        </h6>
                                        <small class="text-muted user-chat-time">30 Minutes</small>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <p class="fs-12 m-0 text-muted lh-1 user-desc text-truncate">Offline</p>
                                        <i class="ri-volume-mute-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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
<!-- End:: New Chat Modal -->