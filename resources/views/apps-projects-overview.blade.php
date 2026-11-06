@extends('partials.layouts.master2')
@section('title', 'Blog Details | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Project List')
@section('pagetitle', 'Project')
@section('buttonTitle', 'Add Project')
@section('link', 'apps-projects-create')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection
@section('content')

    <div class="row g-4">
        <div class="col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="avatar-lg avatar-item border-0 flex-shrink-0"><i
                                class="ri-stack-line fs-20 lh-1"></i></span>
                        <div class="hstack justify-content-between gap-2 flex-grow-1">
                            <div class="flex-grow-1">
                                <h5 class="fw-semibold mb-0 lh-base text-truncate-2">Customer Feedback Dashboard Development
                                </h5>
                                <span class="badge bg-success">In progress</span>
                                <div class="text-muted fs-12 d-inline-block"><span
                                        class="bullet bg-success mx-2"></span>Last Updated 1 Day Ago</div>
                            </div>
                            <div class="dropdown flex-shrink-0">
                                <a aria-label="anchor" href="#!" class="btn btn-light-primary rounded-pill icon-btn-sm"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-line"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="apps-projects-create"><i
                                                class="ri-edit-line align-middle me-1 d-inline-block"></i>Edit</a></li>
                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#shareModal"><i
                                                class="ri-share-line align-middle me-1 d-inline-block"></i>Share</a></li>
                                    <li><a class="dropdown-item delete-item" href="#!"><i
                                                class="ri-delete-bin-line me-1 align-middle d-inline-block"></i>Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6>Project Description</h6>
                        <p class="text-muted mb-0 fs-13">An admin panel is an essential tool that provides administrators
                            with control over various aspects of a website or application. It serves as a centralized
                            platform where users can manage content, user permissions, and monitor key performance metrics.
                            The effectiveness of an admin panel depends on its usability and the ability to present complex
                            data in an easily digestible format for better decision-making.</p>
                    </div>
                    <div class="mb-3">
                        <h6>Task Information</h6>
                        <p class="text-muted mb-0 fs-13">
                            Project success hinges on clear goals, efficient resource allocation, and effective team
                            collaboration. Tasks should be broken down into smaller, achievable milestones with clearly
                            defined deadlines. Monitoring progress regularly and making adjustments as necessary ensures the
                            project stays aligned with its objectives, within scope, and on schedule.
                        </p>
                    </div>
                    <div>
                        <h6>Background Information</h6>
                        <p class="text-muted mb-0 fs-13">A project is a set of activities that are planned and executed to
                            achieve a defined objective within a specific time frame. Whether it’s launching a new product,
                            upgrading a system, or improving processes, projects require careful planning, team
                            coordination, and consistent tracking of performance to deliver successful results. Projects can
                            vary in complexity, but they all require attention to detail and structured management.</p>
                        <p class="text-muted">Successful project management demands not only technical expertise but also
                            the ability to foresee potential challenges and develop strategies to overcome them. With the
                            right planning and execution, teams can drive the project to completion while maintaining high
                            standards and delivering the desired results.</p>
                    </div>

                    <ul class="list-group list-group-sm mb-4">
                        <li class="list-group-item bg-transparent text-muted border-0 px-0">
                            <i class="ri-checkbox-circle-line text-success"></i> Define the project’s overall vision and
                            scope clearly to ensure alignment among all stakeholders.
                        </li>
                        <li class="list-group-item bg-transparent text-muted border-0 px-0">
                            <i class="ri-checkbox-circle-line text-success"></i> Assign roles and responsibilities to each
                            team member based on their expertise and the project’s requirements.
                        </li>
                        <li class="list-group-item bg-transparent text-muted border-0 px-0">
                            <i class="ri-checkbox-circle-line text-success"></i> Choose appropriate tools and technologies
                            that are best suited to the project’s specific needs and goals.
                        </li>
                        <li class="list-group-item bg-transparent text-muted border-0 px-0">
                            <i class="ri-checkbox-circle-line text-success"></i> Break down the project into smaller tasks
                            or phases to make it easier to manage and track progress.
                        </li>
                        <li class="list-group-item bg-transparent text-muted border-0 px-0 mb-0">
                            <i class="ri-checkbox-circle-line text-success"></i> Plan the design and prototyping phase to
                            ensure the end product is functional and meets user expectations.
                        </li>
                    </ul>

                    <div class="py-3 border-top border-bottom mb-5 border-top-dashed border-bottom-dashed">
                        <div class="d-flex gap-4 flex-wrap">
                            <div class="d-flex align-items-center gap-2 me-3">
                                <span class="avatar avatar-item bg-light text-muted rounded-circle p-2">
                                    <i class="ri-calendar-event-line fs-18 lh-1 align-middle"></i>
                                </span>
                                <div>
                                    <div class="fw-medium mb-0"> Start Date </div>
                                    <span class="fs-12 text-muted">28 August, 2024</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 me-3">
                                <span class="avatar avatar-item bg-light text-muted rounded-circle p-2">
                                    <i class="ri-time-line fs-18 lh-1 align-middle"></i>
                                </span>
                                <div>
                                    <div class="fw-medium mb-0"> End Date </div>
                                    <span class="fs-12 text-muted">30 Oct, 2024</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="avatar avatar-item overflow-hidden me-1">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                        alt="user Image">
                                </span>
                                <div>
                                    <span class="d-block fs-14 fw-medium">Amith Catzem</span>
                                    <span class="fs-12 text-muted">Project Manager</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="fw-semibold">Tags</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <div class="badge fw-medium bg-light text-muted">UI/UX</div>
                            <div class="badge fw-medium bg-light text-muted">Figma</div>
                            <div class="badge fw-medium bg-light text-muted">HTML</div>
                            <div class="badge fw-medium bg-light text-muted">CSS</div>
                            <div class="badge fw-medium bg-light text-muted">Javascript</div>
                            <div class="badge fw-medium bg-light text-muted">Reactjs</div>
                            <div class="badge fw-medium bg-light text-muted">Nodejs</div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <h6 class="card-title mb-0"> Comments </h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush max-h-384px" data-simplebar>
                        <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image"
                                    class="avatar rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="hstack justify-content-between gap-2">
                                    <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">John Smith <small
                                            class="text-muted">28 Nov 2024 - 10:15AM</small></h5>
                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-on">
                                                <i class="ri-thumb-up-fill"></i>
                                            </span>
                                            <span class="icon-off">
                                                <i class="ri-thumb-up-line"></i>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-on">
                                                <i class="ri-thumb-down-fill"></i>
                                            </span>
                                            <span class="icon-off">
                                                <i class="ri-thumb-down-line"></i>
                                            </span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#shareModal">Share</a></li>
                                                <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                <li><a class="dropdown-item delete-item delete-btn"
                                                        href="#!">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mb-2">Hi! I noticed the website is a bit slow on mobile devices. Could
                                    you look into optimizing it?</p>
                                <a href="#!" class="badge bg-light text-muted">Reply <i
                                        class="ri-reply-line ms-1"></i></a>
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="user Image"
                                            class="avatar rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-13">Sarah Lee <small class="text-muted ms-2">28 Nov 2024 -
                                                11:00AM</small></h5>
                                        <p class="text-muted mb-2">Sure! I’ll check the mobile version and improve the
                                            loading times. It should be faster soon.</p>
                                        <a href="#!" class="badge bg-light text-muted">Reply <i
                                                class="ri-reply-line ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image"
                                    class="avatar rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="hstack justify-content-between gap-2">
                                    <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">John Smith <small
                                            class="text-muted">28 Nov 2024 - 01:30PM</small></h5>
                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-on">
                                                <i class="ri-thumb-up-fill"></i>
                                            </span>
                                            <span class="icon-off">
                                                <i class="ri-thumb-up-line"></i>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-on">
                                                <i class="ri-thumb-down-fill"></i>
                                            </span>
                                            <span class="icon-off">
                                                <i class="ri-thumb-down-line"></i>
                                            </span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#shareModal">Share</a></li>
                                                <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                <li><a class="dropdown-item delete-item delete-btn"
                                                        href="#!">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mb-2">I also noticed the form validation on the contact page is not
                                    working properly. It allows the form to be submitted with empty fields. Can we fix that
                                    too?</p>
                                <a href="#!" class="badge bg-light text-muted">Reply <i
                                        class="ri-reply-line ms-1"></i></a>
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="user Image"
                                            class="avatar rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-13">Sarah Lee <small class="text-muted ms-2">28 Nov 2024 -
                                                02:00PM</small></h5>
                                        <p class="text-muted mb-2">Yes, I see that. I'll adjust the validation script so
                                            that users can't submit the form without filling out all fields. I’ll have that
                                            ready shortly.</p>
                                        <a href="#!" class="badge bg-light text-muted">Reply <i
                                                class="ri-reply-line ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image"
                                    class="avatar rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="hstack justify-content-between gap-2">
                                    <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">John Smith <small
                                            class="text-muted">28 Nov 2024 - 04:00PM</small></h5>
                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-on">
                                                <i class="ri-thumb-up-fill"></i>
                                            </span>
                                            <span class="icon-off">
                                                <i class="ri-thumb-up-line"></i>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-on">
                                                <i class="ri-thumb-down-fill"></i>
                                            </span>
                                            <span class="icon-off">
                                                <i class="ri-thumb-down-line"></i>
                                            </span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#shareModal">Share</a></li>
                                                <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                <li><a class="dropdown-item delete-item delete-btn"
                                                        href="#!">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mb-2">Great! One more thing: Can we update the header section of the
                                    homepage? The logo looks too small on high-resolution screens. It would look better if
                                    it was a bit larger.</p>
                                <a href="#!" class="badge bg-light text-muted">Reply <i
                                        class="ri-reply-line ms-1"></i></a>
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="user Image"
                                            class="avatar rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-13">Sarah Lee <small class="text-muted ms-2">28 Nov 2024 -
                                                04:30PM</small></h5>
                                        <p class="text-muted mb-2">Definitely! I will increase the size of the logo and
                                            adjust the layout to make sure it looks good on all screen sizes. I'll make this
                                            update later today.</p>
                                        <a href="#!" class="badge bg-light text-muted">Reply <i
                                                class="ri-reply-line ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image"
                                    class="avatar rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="hstack justify-content-between gap-2">
                                    <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">John Smith <small
                                            class="text-muted">29 Nov 2024 - 09:00AM</small></h5>
                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-on">
                                                <i class="ri-thumb-up-fill"></i>
                                            </span>
                                            <span class="icon-off">
                                                <i class="ri-thumb-up-line"></i>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                            aria-pressed="false">
                                            <span class="icon-on">
                                                <i class="ri-thumb-down-fill"></i>
                                            </span>
                                            <span class="icon-off">
                                                <i class="ri-thumb-down-line"></i>
                                            </span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#shareModal">Share</a></li>
                                                <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                <li><a class="dropdown-item delete-item delete-btn"
                                                        href="#!">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mb-2">I saw the changes, and everything looks great! Thanks for the
                                    updates!</p>
                                <a href="#!" class="badge bg-light text-muted">Reply <i
                                        class="ri-reply-line ms-1"></i></a>
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="user Image"
                                            class="avatar rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-13">Sarah Lee <small class="text-muted ms-2">29 Nov 2024 -
                                                09:30AM</small></h5>
                                        <p class="text-muted mb-2">You're welcome! I'm glad it all works for you. Let me
                                            know if there's anything else I can assist with.</p>
                                        <a href="#!" class="badge bg-light text-muted">Reply <i
                                                class="ri-reply-line ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <label for="blog-comment" class="form-label">Write Comment</label>
                    <textarea class="form-control" id="blog-comment" rows="4" placeholder="Write Here......."></textarea>
                    <div class="text-end mt-4">
                        <button class="btn btn-primary">Post Comment</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">About Clients</h6>
                </div>
                <div class="card-body text-center">
                    <div class="avatar-xl overflow-hidden mx-auto mb-3">
                        <img src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" class="img-fluid" alt="user Image">
                    </div>
                    <div>
                        <h5 class="mb-0"><strong>Jessica</strong> Doe</h5>
                        <span class="text-muted fs-13">Washington, d.c.</span>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-sm btn-primary me-2">Profile</button>
                        <button class="btn btn-sm btn-outline-primary">Message</button>
                    </div>
                </div>
            </div>
            <div class="card card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-medium text-body">Progress</span>
                    <span class="fw-medium text-body">65%</span>
                </div>
                <div class="progress progress-xs mb-5" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated w-50"></div>
                </div>
                <div class="card bg-light bg-opacity-30 border border-dashed shadow-none mb-0">
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between mb-3">Budget:<span
                                    class="badge bg-primary-subtle text-primary">$16,785</span></li>
                            <li class="d-flex justify-content-between mb-3">Duration:<span
                                    class="badge bg-info-subtle text-info">360 hrs</span></li>
                            <li class="d-flex justify-content-between mb-3">Priority:<span
                                    class="badge bg-danger-subtle text-danger">High</span></li>
                            <li class="d-flex justify-content-between">Status<span
                                    class="badge bg-info-subtle text-info">Working</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card overflow-hidden">
                <div class="card-header gap-2 d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Project Documents</h6>
                    <div class="dropdown">
                        <button class="btn btn-light-primary btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                            View All <i class="ri-arrow-down-s-line ms-1"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="#!">Download</a></li>
                            <li><a class="dropdown-item" href="#!">Import</a></li>
                            <li><a class="dropdown-item" href="#!">Export</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center gap-2 py-3 delete-element">
                            <span class="avatar-lg border-0 avatar-item bg-light flex-shrink-0">
                                <i class="ri-file-pdf-line ri-2x text-danger"></i>
                            </span>
                            <div class="flex-fill flex-grow-1 overflow-hidden">
                                <a href="#!">
                                    <span class="d-block fw-semibold text-truncate">Project Proposal.pdf</span>
                                </a>
                                <span class="d-block text-muted fs-12">1.2MB</span>
                            </div>
                            <div class="hstack gap-1 flex-shrink-0">
                                <button class="btn icon-btn-sm btn-light-primary"><i class="ri-pencil-line"></i></button>
                                <button class="btn icon-btn-sm btn-light-danger delete-btn"><i
                                        class="ri-delete-bin-line"></i></button>
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center gap-2 py-3 delete-element">
                            <span class="avatar-lg border-0 avatar-item bg-light flex-shrink-0">
                                <i class="ri-file-word-line ri-2x text-primary"></i>
                            </span>
                            <div class="flex-fill flex-grow-1 overflow-hidden">
                                <a href="#!">
                                    <span class="d-block fw-semibold text-truncate">Contracts.docx</span>
                                </a>
                                <span class="d-block text-muted fs-12">1.5MB</span>
                            </div>
                            <div class="hstack gap-1 flex-shrink-0">
                                <button class="btn icon-btn-sm btn-light-primary"><i class="ri-pencil-line"></i></button>
                                <button class="btn icon-btn-sm btn-light-danger delete-btn"><i
                                        class="ri-delete-bin-line"></i></button>
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center gap-2 py-3 delete-element">
                            <span class="avatar-lg border-0 avatar-item bg-light flex-shrink-0">
                                <i class="ri-file-text-line ri-2x text-muted"></i>
                            </span>
                            <div class="flex-fill flex-grow-1 overflow-hidden">
                                <a href="#!">
                                    <span class="d-block fw-semibold text-truncate">Meeting Notes.txt</span>
                                </a>
                                <span class="d-block text-muted fs-12">256KB</span>
                            </div>
                            <div class="hstack gap-1 flex-shrink-0">
                                <button class="btn icon-btn-sm btn-light-primary"><i class="ri-pencil-line"></i></button>
                                <button class="btn icon-btn-sm btn-light-danger delete-btn"><i
                                        class="ri-delete-bin-line"></i></button>
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center gap-2 py-3 delete-element">
                            <span class="avatar-lg border-0 avatar-item bg-light flex-shrink-0">
                                <i class="ri-file-pdf-line ri-2x text-danger"></i>
                            </span>
                            <div class="flex-fill flex-grow-1 overflow-hidden">
                                <a href="#!">
                                    <span class="d-block fw-semibold text-truncate">User Manual.pdf</span>
                                </a>
                                <span class="d-block text-muted fs-12">1.8MB</span>
                            </div>
                            <div class="hstack gap-1 flex-shrink-0">
                                <button class="btn icon-btn-sm btn-light-primary"><i class="ri-pencil-line"></i></button>
                                <button class="btn icon-btn-sm btn-light-danger delete-btn"><i
                                        class="ri-delete-bin-line"></i></button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header">
                    <h6 class="card-title mb-0">Assigned Team</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group fs-13 fw-medium list-group-flush">
                        <li class="list-group-item d-flex hstack rounded px-0 pt-0">
                            <div class="avatar-item border-0 avatar avatar-title text-white bg-danger me-3 flex-shrink-0">
                                JD
                            </div>
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">John Doe</a>
                                    <span class="text-muted fw-medium text-truncate d-block fs-12">Web Designer</span>
                                </div>
                                <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex hstack rounded px-0">
                            <div class="avatar-item border-0 avatar avatar-title text-white bg-success me-3 flex-shrink-0">
                                EJ
                            </div>
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Emily Johnson</a>
                                    <span class="text-muted fw-medium text-truncate d-block fs-12">JavaScript
                                        Developer</span>
                                </div>
                                <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex hstack rounded px-0">
                            <div class="avatar-item border-0 avatar avatar-title text-white bg-info me-3 flex-shrink-0">
                                AS
                            </div>
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Alice Smith</a>
                                    <span class="text-muted fw-medium text-truncate d-block fs-12">UI/UX Designer</span>
                                </div>
                                <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex hstack rounded px-0">
                            <div class="avatar-item border-0 avatar avatar-title text-white bg-warning me-3 flex-shrink-0">
                                MJ
                            </div>
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Michael Jackson</a>
                                    <span class="text-muted fw-medium text-truncate d-block fs-12">Marketing
                                        Specialist</span>
                                </div>
                                <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex hstack rounded px-0">
                            <div class="avatar-item border-0 avatar avatar-title text-white bg-primary me-3 flex-shrink-0">
                                RG
                            </div>
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Rachel Green</a>
                                    <span class="text-muted fw-medium text-truncate d-block fs-12">Product Manager</span>
                                </div>
                                <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item d-flex hstack rounded px-0 pb-0">
                            <div
                                class="avatar-item border-0 avatar avatar-title text-white bg-secondary me-3 flex-shrink-0">
                                LP
                            </div>
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Liam Peters</a>
                                    <span class="text-muted fw-medium text-truncate d-block fs-12">Back-End
                                        Developer</span>
                                </div>
                                <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')

    <!-- Project Overview init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-projects-create.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
