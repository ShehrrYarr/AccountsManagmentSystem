@extends('partials.layouts.master2')
@section('title', 'Kanban Board | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Social')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'Add Task')
@section('modalTarget', 'addTasksModal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
@endsection

@section('content')


    <div class="row apps-kanban">

        <div class="col-12">
            <div class="card border-0 card-body hstack flex-wrap justify-content-sm-center justify-content-md-between gap-3">
                <div class="hstack gap-2">
                    <div class="avatar-lg avatar-item bg-primary-subtle p-2 rounded-4">
                        <img src="{{ asset('assets/images/profile/google-icon.svg') }}" class="rounded-circle"
                            alt="Project Logo">
                    </div>
                    <div class="vstack justify-content-center overflow-hidden">
                        <h5 class="card-title mb-0 fw-medium text-truncate">Craftboard Project</h5>
                        <div class="hstack gap-3 text-nowrap">
                            <div class="progress progress-xs w-100 min-w-150px" role="progressbar"
                                aria-label="Default striped example" aria-valuenow="10" aria-valuemin="0"
                                aria-valuemax="100">
                                <div class="progress-bar w-25"></div>
                            </div>
                            <p class="mb-0 text-muted fs-12 hstack gap-1">25% <span
                                    class="d-none d-sm-block">Complete</span></p>
                        </div>
                    </div>
                </div>
                <div class="hstack flex-wrap gap-3">
                    <div class="avatar-group">

                        <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                            data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Emily Johnson">
                            <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                alt="avatar image">
                        </div>

                        <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                            data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Michael Smith">
                            <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                alt="avatar image">
                        </div>

                        <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                            data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Sarah Lee">
                            <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                alt="avatar image">
                        </div>

                        <div class="avatar-item avatar avatar-title text-white bg-primary">
                            3+
                        </div>

                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#share-contact"><i
                            class="ri-add-line"></i> Add Member</button>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#create-board"><i
                            class="ri-add-line"></i> New Board</button>
                </div>
            </div>
            <div data-simplebar>
                <div class="d-flex gap-3" id="sortable-container">
                    <div class="kanban-list">
                        <div class="hstack mb-3">
                            <div class="flex-grow-1">
                                <h6 class="fs-14 text-uppercase fw-semibold mb-0 hstack gap-2"><span
                                        class="bullet bg-success"></span>Unassigned <span
                                        class="badge bg-success-subtle text-success">3</span></h6>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-light icon-btn-sm" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="accountNavbarDropdown">
                                        <div class="dropdown-header fs-12">Items</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-inbox-archive-line"></i>
                                            Archive All</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-6-line"></i> Delete All</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="dropdown-header fs-12">Column</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-edit-2-line"></i> Edit
                                            Details</a>
                                        <a class="dropdown-item" href="#!"> <i class="ri-eye-off-line"></i> Hide from
                                            view</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-4-line"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <button class="btn btn-sm btn-light-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#addTasksModal"><i class="ri-add-line"></i> Add More</button>
                        </div>
                        <div class="kanban-list-items w-288px" data-simplebar>
                            <div class="delete-element cursor-pointer" id="multiple-containers01">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-2 flex-wrap mb-3">
                                            <div class="badge bg-danger rounded-5">
                                                High
                                            </div>
                                            <div class="badge bg-success rounded-5">
                                                Project
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Hi-fi & Prototyping</a></h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu1" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu1">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-13 text-truncate-2 mb-3">The landing page will serve as the
                                            dynamic digital gateway, providing an immersive showcase of our design.</p>
                                        <div class="row g-2 mb-3">
                                            <div class="col-3">
                                                <a href="{{ asset('assets/images/small/img-1.jpg') }}"
                                                    class="thumbnail lightbox">
                                                    <img src="{{ asset('assets/images/small/img-1.jpg') }}"
                                                        class="img-fluid rounded-2" alt="task image">
                                                </a>
                                            </div>
                                            <div class="col-3">
                                                <a href="{{ asset('assets/images/small/img-2.jpg') }}"
                                                    class="thumbnail lightbox">
                                                    <img src="{{ asset('assets/images/small/img-2.jpg') }}"
                                                        class="img-fluid rounded-2" alt="task image">
                                                </a>
                                            </div>
                                            <div class="col-3">
                                                <a href="{{ asset('assets/images/small/img-3.jpg') }}"
                                                    class="thumbnail lightbox">
                                                    <img src="{{ asset('assets/images/small/img-3.jpg') }}"
                                                        class="img-fluid rounded-2" alt="task image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="hstack gap-2 flex-wrap mb-3">
                                            <span class="badge cursor-pointer fw-medium fs-10 bg-light text-muted">Mon, Feb
                                                12</span>
                                            <span class="badge cursor-pointer fw-medium fs-10 bg-light text-muted"><i
                                                    class="ri-time-line"></i> 4h</span>
                                        </div>
                                        <div class="hstack gap-2 flex-wrap">
                                            <div class="d-flex w-100 justify-content-between gap-1">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-muted mb-0 fs-13 fw-normal"><i
                                                            class="bi bi-list-check fs-20 align-middle me-1"></i>Progress
                                                    </h6>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <span class="text-muted fs-13">25/100</span>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs w-100 min-w-200px" role="progressbar"
                                                aria-label="Default striped example" aria-valuenow="25" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <div class="progress-bar bg-danger w-25"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Jane Smith">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="John Doe">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-attachment-2 align-bottom"></i> 02</a>
                                                </li>
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        19</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="delete-element cursor-pointer" id="multiple-containers02">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-3 mb-3">
                                            <div class="badge bg-primary rounded-5">Ongoing</div>
                                            <div class="badge bg-warning rounded-5">Development</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Website Redesign</a></h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu2" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu2">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-14 text-truncate-2 mb-3">Redesigning the website to improve
                                            user experience and functionality across all devices.</p>
                                        <div class="row g-3 mb-3">
                                            <div class="col-4">
                                                <a href="{{ asset('assets/images/small/img-4.jpg') }}"
                                                    class="thumbnail lightbox">
                                                    <img src="{{ asset('assets/images/small/img-4.jpg') }}"
                                                        class="img-fluid rounded-2" alt="task image">
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="{{ asset('assets/images/small/img-5.jpg') }}"
                                                    class="thumbnail lightbox">
                                                    <img src="{{ asset('assets/images/small/img-5.jpg') }}"
                                                        class="img-fluid rounded-2" alt="task image">
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a href="{{ asset('assets/images/small/img-6.jpg') }}"
                                                    class="thumbnail lightbox">
                                                    <img src="{{ asset('assets/images/small/img-6.jpg') }}"
                                                        class="img-fluid rounded-2" alt="task image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="hstack gap-3 flex-wrap mb-3">
                                            <span class="badge cursor-pointer fw-medium fs-10 bg-light text-muted">Thu, Jan
                                                25</span>
                                            <span class="badge cursor-pointer fw-medium fs-10 bg-light text-muted"><i
                                                    class="ri-time-line"></i> 8h</span>
                                        </div>
                                        <div class="hstack gap-2 flex-wrap">
                                            <div class="d-flex w-100 justify-content-between gap-2">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-muted mb-0 fs-13 fw-normal"><i
                                                            class="bi bi-check-circle-fill fs-20 align-middle me-1"></i>Completion
                                                    </h6>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <span class="text-muted fs-13">6/10</span>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs w-100 min-w-200px" role="progressbar"
                                                aria-label="Progress bar example" aria-valuenow="75" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <div class="progress-bar bg-primary w-75"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Michael Johnson">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="Emily Davis">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-attachment-2 align-bottom"></i> 05</a>
                                                </li>
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        32</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="delete-element cursor-pointer" id="multiple-containers03">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-2 flex-wrap mb-3">
                                            <div class="badge bg-info rounded-5">Low</div>
                                            <div class="badge bg-primary rounded-5">Meeting</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Presentation to client</a></h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu3" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu3">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-13 text-truncate-2 mb-0">The landing page will serve as the
                                            dynamic digital gateway, providing an immersive showcase of our design.</p>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Jane Smith">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-6.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="John Doe">
                                            </div>
                                            <div
                                                class="avatar-item avatar avatar-title bg-secondary-subtle text-secondary fs-12">
                                                +12
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        5</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-list">
                        <div class="hstack mb-3">
                            <div class="flex-grow-1">
                                <h6 class="fs-14 text-uppercase fw-semibold mb-0 hstack gap-2"><span
                                        class="bullet bg-success"></span>To Do <span
                                        class="badge bg-success-subtle text-success">3</span></h6>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-light icon-btn-sm" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="accountNavbarDropdown">
                                        <div class="dropdown-header fs-12">Items</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-inbox-archive-line"></i>
                                            Archive All</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-6-line"></i> Delete All</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="dropdown-header fs-12">Column</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-edit-2-line"></i> Edit
                                            Details</a>
                                        <a class="dropdown-item" href="#!"> <i class="ri-eye-off-line"></i> Hide
                                            from view</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-4-line"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <button class="btn btn-sm btn-light-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#addTasksModal"><i class="ri-add-line"></i> Add More</button>
                        </div>
                        <div class="kanban-list-items w-288px" data-simplebar>
                            <div class="delete-element cursor-pointer" id="multiple-containers04">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-2 flex-wrap mb-3">
                                            <div class="badge bg-danger rounded-5">
                                                High
                                            </div>
                                            <div class="badge bg-success rounded-5">
                                                Project
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Create Design System</a></h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu4" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu4">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-13 text-truncate-2 mb-3">We need to create a design system
                                            for our website to ensure consistency and coherence across our design elements.
                                        </p>
                                        <ul class="ps-0 list-unstyled vstack gap-2 mb-0">
                                            <li>
                                                <div class="hstack gap-2 form-check form-check-sm mb-0">
                                                    <input class="form-check-input" type="checkbox" value="task 1"
                                                        id="productDesignTask">
                                                    <label class="form-check-label text-truncate fs-12 mb-0 fw-normal"
                                                        for="productDesignTask">
                                                        Design components in Figma, prototype
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="hstack gap-2 form-check form-check-sm mb-0">
                                                    <input class="form-check-input" type="checkbox" value="task 2"
                                                        id="dashboardDesignTask" checked>
                                                    <label class="form-check-label text-truncate fs-12 mb-0 fw-normal"
                                                        for="dashboardDesignTask">
                                                        Standardize dashboards (ecommerce, analytics)
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="hstack gap-2 form-check form-check-sm mb-0">
                                                    <input class="form-check-input" type="checkbox" value="task 3"
                                                        id="calendarAppTask">
                                                    <label class="form-check-label text-truncate fs-12 mb-0 fw-normal"
                                                        for="calendarAppTask">
                                                        Create templates for calendar and chat
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="hstack gap-2 form-check form-check-sm mb-0">
                                                    <input class="form-check-input" type="checkbox" value="task 4"
                                                        id="authenticationPagesTask">
                                                    <label class="form-check-label text-truncate fs-12 mb-0 fw-normal"
                                                        for="authenticationPagesTask">
                                                        Design authentication pages
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <span class="fs-12 mb-0 fw-normal link-primary fw-medium">
                                                    +2 More
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Alice Brown">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-6.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-10.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="Bob Johnson">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-7.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="Emily Davis">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-attachment-2 align-bottom"></i> 02</a>
                                                </li>
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        19</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="delete-element cursor-pointer" id="multiple-containers05">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-3 flex-wrap mb-3">
                                            <div class="badge bg-success rounded-5">
                                                Medium
                                            </div>
                                            <div class="badge bg-warning rounded-5">
                                                Design
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Logo Redesign Meeting</a></h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu5" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu5">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-14 text-truncate-2 mb-0">Meeting to discuss the new logo
                                            redesign ideas with the client. Presenting concepts and gathering feedback.</p>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Alex Turner">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-7.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Mia Johnson">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-8.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar-item avatar avatar-title bg-info text-white fs-12">
                                                +8
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        12</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="delete-element cursor-pointer" id="multiple-containers06">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-3 flex-wrap mb-3">
                                            <div class="badge bg-danger rounded-5">
                                                High
                                            </div>
                                            <div class="badge bg-success rounded-5">
                                                Frontend
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Implement New Navbar</a></h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu6" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu6">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-14 text-truncate-2 mb-0">Design and implement a responsive
                                            navigation bar using HTML, CSS, and JavaScript.</p>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Alice Brown">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="Bob Williams">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        3</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-list">
                        <div class="hstack mb-3">
                            <div class="flex-grow-1">
                                <h6 class="fs-14 text-uppercase fw-semibold mb-0 hstack gap-2"><span
                                        class="bullet bg-success"></span>Inprogress <span
                                        class="badge bg-success-subtle text-success">3</span></h6>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-light icon-btn-sm" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="accountNavbarDropdown">
                                        <div class="dropdown-header fs-12">Items</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-inbox-archive-line"></i>
                                            Archive All</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-6-line"></i> Delete All</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="dropdown-header fs-12">Column</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-edit-2-line"></i> Edit
                                            Details</a>
                                        <a class="dropdown-item" href="#!"> <i class="ri-eye-off-line"></i> Hide
                                            from view</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-4-line"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <button class="btn btn-sm btn-light-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#addTasksModal"><i class="ri-add-line"></i> Add More</button>
                        </div>
                        <div class="kanban-list-items w-288px" data-simplebar>
                            <div class="delete-element cursor-pointer" id="multiple-containers07">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-3 flex-wrap mb-3">
                                            <div class="badge bg-info rounded-5">
                                                Low
                                            </div>
                                            <div class="badge bg-secondary-subtle text-secondary rounded-5">
                                                Testing
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Test User Registration Flow</a>
                                            </h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu7" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu7">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-14 text-truncate-2 mb-0">Test the user registration process
                                            by simulating form submission, validation, and error handling.</p>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="David Johnson">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="delete-element cursor-pointer" id="multiple-containers08">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-3 flex-wrap mb-3">
                                            <div class="badge bg-danger rounded-5">
                                                High
                                            </div>
                                            <div class="badge bg-secondary-subtle text-secondary rounded-5">
                                                Deployment
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Deploy to Production Server</a>
                                            </h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu8" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu8">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-14 text-truncate-2 mb-0">Deploy the application to the
                                            production environment. Ensure all environment variables are correctly
                                            configured.</p>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Emily White">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        8</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="delete-element cursor-pointer" id="multiple-containers09">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-2 flex-wrap mb-3">
                                            <div class="badge bg-warning rounded-5">Medium</div>
                                            <div class="badge bg-primary rounded-5">Development</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Implement New API Endpoints</a>
                                            </h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu9" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu9">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add To</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-13 text-truncate-2 mb-3">Build and implement new API
                                            endpoints for user management, including registration, login, and profile update
                                            features.</p>
                                        <ul class="ps-0 list-unstyled vstack gap-2 mb-0">
                                            <li>
                                                <div class="hstack gap-2 form-check form-check-sm mb-0">
                                                    <input class="form-check-input" type="checkbox" value="task 5"
                                                        id="createEndpointTask">
                                                    <label class="form-check-label text-truncate fs-12 mb-0 fw-normal"
                                                        for="createEndpointTask">
                                                        Create user registration endpoint
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="hstack gap-2 form-check form-check-sm mb-0">
                                                    <input class="form-check-input" type="checkbox" value="task 6"
                                                        id="userLoginTask" checked>
                                                    <label class="form-check-label text-truncate fs-12 mb-0 fw-normal"
                                                        for="userLoginTask">
                                                        Implement user login with JWT tokens
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="hstack gap-2 form-check form-check-sm mb-0">
                                                    <input class="form-check-input" type="checkbox" value="task 7"
                                                        id="profileUpdateTask">
                                                    <label class="form-check-label text-truncate fs-12 mb-0 fw-normal"
                                                        for="profileUpdateTask">
                                                        Implement user profile update feature
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="hstack gap-2 form-check form-check-sm mb-0">
                                                    <input class="form-check-input" type="checkbox" value="task 8"
                                                        id="errorHandlingTask">
                                                    <label class="form-check-label text-truncate fs-12 mb-0 fw-normal"
                                                        for="errorHandlingTask">
                                                        Add error handling and validation
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <span class="fs-12 mb-0 fw-normal link-primary fw-medium">
                                                    +3 More
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="Mark Lee">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-8.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-9.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="Sophia Green">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-attachment-2 align-bottom"></i> 03</a>
                                                </li>
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        07</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-list">
                        <div class="hstack mb-3">
                            <div class="flex-grow-1">
                                <h6 class="fs-14 text-uppercase fw-semibold mb-0 hstack gap-2"><span
                                        class="bullet bg-success"></span>In Reviews <span
                                        class="badge bg-success-subtle text-success">3</span></h6>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-light icon-btn-sm" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="accountNavbarDropdown">
                                        <div class="dropdown-header fs-12">Items</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-inbox-archive-line"></i>
                                            Archive All</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-6-line"></i> Delete All</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="dropdown-header fs-12">Column</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-edit-2-line"></i> Edit
                                            Details</a>
                                        <a class="dropdown-item" href="#!"> <i class="ri-eye-off-line"></i> Hide
                                            from view</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-4-line"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <button class="btn btn-sm btn-light-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#addTasksModal"><i class="ri-add-line"></i> Add More</button>
                        </div>
                        <div class="kanban-list-items w-288px" data-simplebar>
                            <div class="detete-element" id="multiple-containers10">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-2 flex-wrap mb-3">
                                            <div class="badge bg-warning rounded-5">
                                                In Review
                                            </div>
                                            <div class="badge bg-secondary-subtle text-secondary rounded-5">
                                                Feature
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Review API Documentation</a>
                                            </h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu10" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu10">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add
                                                            To</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn"
                                                            href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-13 text-truncate-2 mb-3">The documentation needs to be
                                            reviewed for accuracy and clarity. Ensure all API methods are correctly
                                            described.</p>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="John Smith">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="Emma Jones">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-question-answer-line align-bottom"></i>
                                                        4</a></li>
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-attachment-2 align-bottom"></i> 1</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kanban-list">
                        <div class="hstack mb-3">
                            <div class="flex-grow-1">
                                <h6 class="fs-14 text-uppercase fw-semibold mb-0 hstack gap-2"><span
                                        class="bullet bg-success"></span>Completed <span
                                        class="badge bg-success-subtle text-success">3</span></h6>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-light icon-btn-sm" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end"
                                        aria-labelledby="accountNavbarDropdown">
                                        <div class="dropdown-header fs-12">Items</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-inbox-archive-line"></i>
                                            Archive All</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-6-line"></i> Delete All</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="dropdown-header fs-12">Column</div>
                                        <a class="dropdown-item" href="#!"> <i class="ri-edit-2-line"></i> Edit
                                            Details</a>
                                        <a class="dropdown-item" href="#!"> <i class="ri-eye-off-line"></i> Hide
                                            from view</a>
                                        <a class="dropdown-item delete-item" href="#!"> <i
                                                class="ri-delete-bin-4-line"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <button class="btn btn-sm btn-light-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#addTasksModal"><i class="ri-add-line"></i> Add More</button>
                        </div>
                        <div class="kanban-list-items w-288px" data-simplebar>
                            <div class="delete-element cursor-pointer" id="multiple-containers11">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="hstack gap-2 flex-wrap mb-3">
                                            <div class="badge bg-success rounded-5">
                                                Completed
                                            </div>
                                            <div class="badge bg-info rounded-5">
                                                Task
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="mb-0 flex-grow-1 text-truncate"><a href="#!"
                                                    class="text-body d-block text-truncate">Finalize Database Schema</a>
                                            </h5>
                                            <div class="dropdown">
                                                <a href="#!" class="btn btn-text-primary icon-btn-sm"
                                                    id="tasktitlemenu11" data-bs-toggle="dropdown"
                                                    aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="tasktitlemenu11">
                                                    <li class="dropdown-item text-wrap bg-transparent hstack gap-2">
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            Link</span>
                                                        <span class="badge cursor-pointer bg-light text-muted">Copy
                                                            ID</span>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-pencil-line align-bottom text-muted"></i>
                                                            Rename</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-add-fill align-bottom text-muted"></i> Add
                                                            To</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-file-copy-line align-bottom text-muted"></i>
                                                            Dublicate</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                            data-bs-target="#shareModal"><i
                                                                class="ri-share-line align-bottom text-muted"></i>
                                                            Share</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#!"><i
                                                                class="ri-inbox-archive-line align-bottom text-muted"></i>
                                                            Archive</a></li>
                                                    <li><a class="dropdown-item delete-item delete-btn"
                                                            href="#!"><i
                                                                class="ri-delete-bin-5-line align-bottom text-muted"></i>
                                                            Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="text-muted fs-13 text-truncate-2 mb-3">The final database schema has
                                            been completed, and all tables and relationships are set up. Ready for
                                            deployment.</p>
                                    </div>
                                    <div class="card-footer p-4 hstack gap-3 justify-content-between">
                                        <div class="avatar-group">
                                            <div class="avatar avatar-item overflow-hidden" data-bs-toggle="tooltip"
                                                data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                data-bs-title="David Clark">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                                    alt="avatar image">
                                            </div>
                                            <div class="avatar avatar-item overflow-hidden">
                                                <img class="img-fluid"
                                                    src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="avatar image" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-white" data-bs-placement="top"
                                                    data-bs-title="Lily Adams">
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <ul class="link-inline mb-0 p-0">
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-check-line align-bottom"></i> 1</a></li>
                                                <li class="list-inline-item border rounded py-1 me-1 px-2 lh-sm fs-12"><a
                                                        href="#!" class="text-muted"><i
                                                            class="fs-13 lh-sm ri-attachment-2 align-bottom"></i> 3</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Create Board Modal -->
    <div class="modal fade" id="create-board" tabindex="-1" aria-labelledby="CreateFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateFileLabel">
                        Create Board
                    </h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="file_name">Board Name</label>
                    <input type="text" id="file_name" placeholder="Enter your board name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Create Board</button>
                </div>
            </div>
        </div>
    </div>
    @include('partials.share-contact-modal')

    @include('partials.create-task')

@endsection

@section('js')

    <!-- Lightbox2 js -->
    <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Tagify js -->
    <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- Sortable js -->
    <script src="{{ asset('assets/libs/sortablejs/Sortable.min.js') }}"></script>

    <!-- Create Task init -->
    <script src="{{ asset('assets/js/partials/create-task.init.js') }}"></script>

    <!-- apps tasks kanban init -->
    <script src="{{ asset('assets/js/apps/apps-tasks-kanban.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
