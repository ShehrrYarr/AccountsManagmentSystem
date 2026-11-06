@extends('partials.layouts.master3')

    @section('title', 'Timeline Page | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Timeline' )
    @section('pagetitle', 'Pages')
    @section('buttonTitle', 'Share')
    @section('link', '#!')


    @section('content')


    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Timeline -->
                    <ul class="timeline-box mb-0">
                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 text-bg-primary avatar-item avatar">AG</div>
                            </div>
                            <div class="timeline-content p-0">
                                <div class="d-flex flex-column gap-1">
                                    <p class="mb-0 text-muted fs-12">15:36, Monday</p>
                                </div>
                                <div class="card card-body shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mt-3 mb-0">
                                    <p class="mb-2">
                                        <b>You</b> tagged <b>Emma Thompson</b> in a photo.
                                    </p>
                                    <p class="text-muted fs-13">
                                        "Sharing a joyful moment by tagging Emma in a photo from last weekend's picnic, celebrating our friendship and the beautiful memories we've created together."
                                    </p>
                                    <p class="profile-activity-media mb-0 hstack gap-3 flex-wrap">
                                        <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt="User Image" class="mb-0 w-64px h-40px img-fluid rounded overflow-hidden">
                                        <img src="{{ asset('assets/images/small/img-2.jpg') }}" alt="User Image" class="mb-0 w-64px h-40px img-fluid rounded overflow-hidden">
                                    </p>
                                </div>
                            </div>
                        </li>

                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" class="border-0 avatar-item avatar" alt="User Image">
                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                            </div>
                            <div class="timeline-content p-0">
                                <div class="d-flex flex-column gap-1">
                                    <h5 class="mb-0 fw-medium">Max Alexander</h5>
                                    <p class="mb-0 text-muted fs-12">08:15 AM</p>
                                </div>
                                <div class="mt-1 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                                    <span>commented on the task</span>
                                    <span class="fw-semibold text-body">TASK-1125</span>
                                </div>
                                <div class="card card-body shadow-none border border-dashed text-muted fs-13 bg-light bg-opacity-30 mt-3 mb-0">Looks like the latest feature implementation has a few issues with the integration. Let's focus on fixing that bug before deployment.</div>
                            </div>
                        </li>

                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" class="border-0 avatar-item avatar" alt="User Image">
                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                            </div>
                            <div class="timeline-content p-0">
                                <div class="d-flex flex-column gap-1">
                                    <h5 class="mb-0 fw-medium">Max Alexander</h5>
                                    <p class="mb-0 text-muted fs-12">08:15 AM</p>
                                </div>
                                <div class="card card-body shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mt-3 mb-0">
                                    <div class="d-flex flex-column flex-sm-row gap-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/product/product-5.jpg') }}" alt="product image" class="avatar-lg rounded">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-15">@Erica245 <small class="text-muted fs-13 fw-normal">- 10 min ago</small></h5>
                                            <p class="text-muted mb-2">"Wishing you all the best in your new job! Don't forget to celebrate this exciting new chapter in your life with some fun and relaxation. A thoughtful card and a bouquet of flowers can make this moment even more special!"</p>
                                            <div class="hstack flex-wrap gap-3">
                                                <div class="badge bg-light text-body">
                                                    <span class="me-1">&#128293;</span> 19 Likes
                                                </div>
                                                <div class="badge bg-light text-body">
                                                    <span class="me-1">&#129321;</span> 22 Comments
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 text-bg-light avatar-item avatar"><i class="ri-price-tag-3-line"></i></div>
                            </div>
                            <div class="timeline-content p-0">
                                <div class="d-flex flex-column gap-1">
                                    <h5 class="mb-0 fw-medium">Eugene Stewart</h5>
                                    <p class="mb-0 text-muted fs-12">07:45 AM</p>
                                </div>
                                <div class="mt-1 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                                    <span>added labels to</span>
                                    <span class="fw-semibold text-body">TASK-1156</span>
                                    <span>including</span>
                                    <span class="d-inline-flex align-items-center gap-2">
                                        <span class="badge bg-light d-flex align-items-center gap-1">
                                            <span class="bullet d-flex align-items-center bg-danger flex-shrink-0"></span>
                                            <span class="fw-semibold text-body">Critical</span>
                                        </span>
                                        <span class="badge bg-light d-flex align-items-center gap-1">
                                            <span class="bullet d-flex align-items-center bg-primary flex-shrink-0"></span>
                                            <span class="fw-semibold text-body">Frontend</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </li>

                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <div class="border-0 text-bg-light avatar-item avatar"><i class="ri-file-upload-line"></i></div>
                            </div>
                            <div class="timeline-content p-0">
                                <div class="d-flex flex-column gap-1">
                                    <h5 class="mb-0 fw-medium">Creating a New Event with Attachments</h5>
                                    <p class="text-muted fs-12">Organizing events effectively is crucial. Proper spacing and layout enhance readability and engagement. Below are the attachments related to the upcoming marketing workshop.</p>
                                </div>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="card card-body mb-0 flex-row gap-3 flex-wrap border border-dashed position-relative bg-light bg-opacity-30">
                                            <div class="avatar-item avatar border-0 bg-light text-primary flex-shrink-0">
                                                <i class="ri-image-2-line fs-20"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">
                                                    <a href="#!" class="text-decoration-none text-body-emphasis">Marketing Workshop Agenda - PDF</a>
                                                </h6>
                                                <small class="text-muted">File Size: 1.2 MB</small>
                                            </div>
                                            <div class="align-self-center ms-2">
                                                <button class="btn btn-outline-primary btn-sm">Download</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-body mb-0 flex-row gap-3 flex-wrap border border-dashed position-relative bg-light bg-opacity-30">
                                            <div class="avatar-item avatar border-0 bg-light text-info flex-shrink-0">
                                                <i class="ri-file-zip-line fs-20"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">
                                                    <a href="#!" class="text-decoration-none text-body-emphasis">Workshop Presentation Slides - ZIP</a>
                                                </h6>
                                                <small class="text-muted">File Size: 3.5 MB</small>
                                            </div>
                                            <div class="align-self-center ms-2">
                                                <button class="btn btn-outline-info btn-sm">Download</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="timeline-section">
                            <div class="position-relative timeline-icon h-max">
                                <img src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" class="border-0 avatar-item avatar" alt="User Image">
                            </div>
                            <div class="timeline-content p-0">
                                <div class="d-flex flex-column gap-1">
                                    <h5 class="mb-0 fw-medium">Initiating a New Project for Product Development</h5>
                                    <p class="mb-0 text-muted fs-12">Every team project benefits from a structured approach. Use this platform to share vital information, track progress, and collaborate effectively with your team members.</p>
                                </div>
                                <div class="mt-1 mb-3 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                                    <span>mentioned you in a comment on</span>
                                    <span class="fw-semibold text-body">TASK-1109</span>
                                </div>
                                <div class="avatar-group">

                                    <div class="avatar-item avatar-sm overflow-hidden" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Christi">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
                                    </div>

                                    <div class="avatar-item avatar-sm overflow-hidden" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Alex">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                                    </div>

                                    <div class="avatar-item avatar-sm overflow-hidden" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Jordan">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
                                    </div>

                                    <div class="avatar-item avatar-sm avatar-title text-danger bg-danger-subtle">SR</div>

                                </div>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card mb-0">
                <div class="card-body">

                    <ul class="timeline-box multi-timeline-box">

                        <!-- Kick-off Meeting & Initial Planning -->
                        <li class="timeline-block">
                            <div class="side-timeline-section left-side">
                                <div class="timeline-content card shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mb-0">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3">
                                            <h5 class="m-0 fw-semibold text-primary">Kick-off Meeting & Initial Planning</h5>
                                            <div class="d-flex gap-2">
                                                <span class="badge bg-primary text-white">Planning</span>
                                                <span class="badge bg-info text-white">Strategy</span>
                                            </div>
                                        </div>

                                        <p class="mb-4 text-muted fs-13">
                                            The project officially begins with a kick-off meeting where the goals, project scope, target audience, and key deliverables are discussed.
                                        </p>

                                        <h6 class="mb-2">Participants</h6>
                                        <div class="avatar-group mb-4">
                                            <div class="avatar-item border-0">
                                                <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                                            </div>
                                            <div class="avatar-item border-0">
                                                <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
                                            </div>
                                        </div>

                                        <div class="hstack justify-content-between flex-wrap gap-3">
                                            <small class="text-muted">Project Kick-off</small>
                                            <button class="btn btn-outline-primary btn-sm">View Meeting Notes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="side-timeline-icon bg-primary text-white avatar-item avatar avatar-title">
                                <i class="ri-calendar-event-fill fs-18"></i>
                            </div>
                            <div class="side-timeline-section right-side">
                                <div class="timeline-content">
                                    <p class="text-muted fs-12 m-0">1st October</p>
                                </div>
                            </div>
                        </li>

                        <!-- Design Phase -->
                        <li class="timeline-block">
                            <div class="side-timeline-section left-side">
                                <div class="timeline-content text-md-end">
                                    <p class="text-muted fs-12 m-0">5th October</p>
                                </div>
                            </div>
                            <div class="side-timeline-icon bg-warning text-white avatar-item avatar avatar-title">
                                <i class="ri-paint-fill fs-18"></i>
                            </div>
                            <div class="side-timeline-section right-side">
                                <div class="timeline-content card shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mb-0">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3">
                                            <h5 class="m-0 fw-semibold text-warning">Design Phase</h5>
                                            <span class="badge bg-warning text-white">Design</span>
                                        </div>

                                        <p class="mb-4 text-muted fs-13">
                                            In this phase, the design team creates wireframes, user flow diagrams, and mockups for both the redesigned website and e-commerce platform.
                                        </p>

                                        <h6 class="mb-2">Progress</h6>
                                        <div class="progress mb-4 h-6px">
                                            <div class="progress-bar bg-warning w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Development Phase -->
                        <li class="timeline-block">
                            <div class="side-timeline-section left-side">
                                <div class="timeline-content card shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mb-0">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3">
                                            <h5 class="m-0 fw-semibold text-success">Development Phase</h5>
                                            <span class="badge bg-success text-white">Development</span>
                                        </div>

                                        <p class="mb-4 text-muted fs-13">
                                            The development team starts working on both the website's CMS (content management system) improvements and the backend architecture of the e-commerce platform.
                                        </p>

                                        <h6 class="mb-2">Participants</h6>
                                        <div class="avatar-group">
                                            <div class="avatar-item border-0">
                                                <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="avatar image">
                                            </div>
                                            <div class="avatar-item border-0">
                                                <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="avatar image">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="side-timeline-icon bg-success text-white avatar-item avatar avatar-title">
                                <i class="ri-code-s-slash-fill fs-18"></i>
                            </div>
                            <div class="side-timeline-section right-side">
                                <div class="timeline-content">
                                    <p class="text-muted fs-12 m-0">10th October</p>
                                </div>
                            </div>
                        </li>

                        <!-- Testing & QA -->
                        <li class="timeline-block">
                            <div class="side-timeline-section left-side">
                                <div class="timeline-content text-md-end">
                                    <p class="text-muted fs-12 m-0">15th October</p>
                                </div>
                            </div>
                            <div class="side-timeline-icon bg-danger text-white avatar-item avatar avatar-title">
                                <i class="ri-code-fill fs-18"></i>
                            </div>
                            <div class="side-timeline-section right-side">
                                <div class="timeline-content card shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mb-0">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3">
                                            <h5 class="m-0 fw-semibold text-danger">Testing & QA</h5>
                                            <span class="badge bg-danger text-white">Testing</span>
                                        </div>

                                        <p class="mb-4 text-muted fs-13">
                                            The quality assurance (QA) team begins testing for both the website and e-commerce platform. Key tasks include functional testing, security checks, and performance tests.
                                        </p>

                                        <button class="btn btn-outline-danger btn-sm">View Test Reports</button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Go Live & Launch -->
                        <li class="timeline-block">
                            <div class="side-timeline-section left-side">
                                <div class="timeline-content card shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mb-0">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3">
                                            <h5 class="m-0 fw-semibold text-success">Go Live & Launch</h5>
                                        </div>

                                        <p class="mb-4 text-muted fs-13">
                                            The platforms are now live and being monitored for any post-launch issues. The team ensures a smooth transition for users and performance tracking.
                                        </p>

                                        <h6 class="mb-2">Progress</h6>
                                        <div class="progress mb-4 h-6px">
                                            <div class="progress-bar bg-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <button class="btn btn-outline-success btn-sm">Visit Live Website</button>
                                    </div>
                                </div>
                            </div>
                            <div class="side-timeline-icon bg-success text-white avatar-item avatar avatar-title">
                                <i class="ri-globe-line fs-18"></i>
                            </div>
                            <div class="side-timeline-section right-side">
                                <div class="timeline-content">
                                    <p class="text-muted fs-12 m-0">20th October</p>
                                </div>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @endsection