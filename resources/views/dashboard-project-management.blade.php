@extends('partials.layouts.master')

@section('title', 'Project Management Dashboard | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')

@section('sub-title', 'Project')
@section('pagetitle', 'Dashboard')
@section('buttonTitle', 'Add Task')
@section('modalTarget', 'addTasksModal')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
@endsection

@section('content')
   
   

    <div class="project-dashboard">

        <div class="row">
            <div class="col project-stat">
                <div class="card card-hover card-h-100 overflow-hidden border-primary border-3 border-bottom">
                    <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                        <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fw-semibold mb-1">04</h3>
                                <h6 class="mb-0">Total Prject</h6>
                            </div>
                            <div class="text-muted fs-13 mt-2">
                                <span class="text-body fw-semibold me-1"><i class="ri-arrow-right-up-line fs-16 me-1"></i>6%</span>Up this month
                            </div>
                        </div>
                        <div><i class="ri-folder-2-line display-6 fw-medium text-muted opacity-50"></i></div>
                    </div>
                </div>
            </div>
            <div class="col project-stat">
                <div class="card card-hover card-h-100 overflow-hidden border-info border-3 border-bottom">
                    <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                        <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fw-semibold mb-1">35</h3>
                                <h6 class="mb-0">Total Tasks</h6>
                            </div>
                            <div class="text-muted fs-13 mt-2">
                                <span class="text-body fw-semibold me-1"><i class="ri-arrow-right-up-line fs-16 me-1"></i>13%</span>Up this month
                            </div>
                        </div>
                        <div><i class="ri-file-list-3-line display-6 fw-medium text-muted opacity-50"></i></div>
                    </div>
                </div>
            </div>
            <div class="col project-stat">
                <div class="card card-hover card-h-100 overflow-hidden border-warning border-3 border-bottom">
                    <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                        <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fw-semibold mb-1">24</h3>
                                <h6 class="mb-0">Assigned Tasks</h6>
                            </div>
                            <div class="text-muted fs-13 mt-2">
                                <span class="text-body fw-semibold me-1"><i class="ri-arrow-left-down-line fs-16 me-1"></i>23%</span>Down this month
                            </div>
                        </div>
                        <div><i class="ri-user-add-line display-6 fw-medium text-muted opacity-50"></i></div>
                    </div>
                </div>
            </div>
            <div class="col project-stat">
                <div class="card card-hover card-h-100 overflow-hidden border-danger border-3 border-bottom">
                    <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                        <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fw-semibold mb-1">05</h3>
                                <h6 class="mb-0">Overdue Tasks</h6>
                            </div>
                            <div class="text-muted fs-13 mt-2">
                                <span class="text-body fw-semibold me-1"><i class="ri-arrow-right-up-line fs-16 me-1"></i>14%</span>Up this month
                            </div>
                        </div>
                        <div><i class="ri-time-line display-6 fw-medium text-muted opacity-50"></i></div>
                    </div>
                </div>
            </div>
            <div class="col project-stat">
                <div class="card card-hover card-h-100 overflow-hidden border-success border-3 border-bottom">
                    <div class="card-body p-4 d-flex align-items-start gap-3 h-100">
                        <div class="flex-fill h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fw-semibold mb-1">06</h3>
                                <h6 class="mb-0">Completed Tasks</h6>
                            </div>
                            <div class="text-muted fs-13 mt-2">
                                <span class="text-body fw-semibold me-1"><i class="ri-arrow-left-down-line fs-16 me-1"></i>35%</span>Down this month
                            </div>
                        </div>
                        <div><i class="ri-task-line display-6 fw-medium text-muted opacity-50"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-8">
                <div class="card card-h-100">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <h5 class="card-title mb-0 flex-grow-1">Project Progress</h5>
                        <div class="dropdown flex-shrink-0">
                            <a class="text-reset dropdown-toggle" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Week</span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#!">Today</a>
                                <a class="dropdown-item" href="#!">Last Week</a>
                                <a class="dropdown-item" href="#!">Last Month</a>
                                <a class="dropdown-item" href="#!">Current Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h4 class="mb-0 fw-semibold">$18,469</h4>
                                    <p class="badge m-0 bg-danger-subtle text-danger">-2.37%</p>
                                </div>
                                <p class="text-muted fs-12 mb-0">This month</p>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h4 class="mb-0 fw-semibold">$22,356</h4>
                                    <p class="badge m-0 bg-success-subtle text-success">+4.67%</p>
                                </div>
                                <p class="text-muted fs-12 mb-0">Last month</p>
                            </div>
                        </div>
                        <div id="project-progress" class="apexcharts-container apexcharts-white"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <h5 class="card-title mb-0 flex-grow-1">Assigned Tasks</h5>
                        <a href="#!" class="btn btn-light-primary flex-shrink-0 btn-sm" data-bs-toggle="modal" data-bs-target="#share-contact"> Share </a>
                    </div>
                    <!-- Nav tabs -->
                    <div class="card-body">
                        <ul class="nav gap-2 custom-verti-nav-pills text-center px-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#demo-tab-upcoming" role="tab" aria-selected="true">Upcoming (13)</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#demo-tab-overdue" role="tab" aria-selected="false" tabindex="-1">Overdue (5)</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#demo-tab-completed" role="tab" aria-selected="false" tabindex="-1">Completed (6)</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="card-body pt-0 assigned-task" data-simplebar>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="demo-tab-upcoming" role="tabpanel">
                                <div class="vstack gap-3">
                                    <div class="card card-body border border-dashed shadow-none mb-0">
                                        <div class="d-flex gap-3 justify-content-between align-items-center pb-4">
                                            <div class="d-flex align-items-center gap-3 flex-grow-1 overflow-hidden">
                                                <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0"><i class="ri-code-fill"></i></button>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="apps-tasks-kanban">
                                                        <h5 class="mb-0 link-primary text-truncate">Website Development</h5>
                                                    </a>
                                                    <div class="fw-semibold">Client:<span class="text-muted fs-12 ms-1">Sarah Lee</span></div>
                                                </div>
                                            </div>

                                            <div class="dropdown flex-shrink-0">
                                                <a href="#!" class=" btn icon-btn-sm btn-light-primary" id="taskactions1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="taskactions1">
                                                    <li><a class="dropdown-item" href="apps-tasks-kanban"><i class="ri-pencil-line align-bottom text-muted"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-copy-line align-bottom text-muted"></i> Copy</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="ri-share-line align-bottom text-muted"></i> Share</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-line align-bottom text-muted"></i> Attach File</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item delete-item" href="#!"><i class="ri-delete-bin-5-line align-bottom text-muted"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-4">
                                            <span class="fw-bold text-body-emphasis">4/8</span>
                                            <div class="progress h-4px w-100" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-primary w-50"></div>
                                            </div>
                                            <span class="fw-bold text-body-emphasis">50%</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="avatar-group">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Avatar">
                                                <div class="avatar-item avatar-sm">5+</div>
                                            </div>
                                            <p class="ms-auto text-end text-muted m-0 fs-6 fw-semibold"><span class="text-body-emphasis">Due in</span><span class="fs-12 ms-1">10 Days</span></p>
                                        </div>
                                    </div>
                                    <div class="card card-body border border-dashed shadow-none mb-0">
                                        <div class="d-flex gap-3 justify-content-between align-items-center pb-4">
                                            <div class="d-flex align-items-center gap-3 flex-grow-1 overflow-hidden">
                                                <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0"><i class="ri-phone-fill"></i></button>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="apps-tasks-kanban">
                                                        <h5 class="mb-0 link-primary text-truncate">Mobile App Development</h5>
                                                    </a>
                                                    <div class="fw-semibold">Client:<span class="text-muted fs-12 ms-1">John Smith</span></div>
                                                </div>
                                            </div>

                                            <div class="dropdown flex-shrink-0">
                                                <a href="#!" class=" btn icon-btn-sm btn-light-primary" id="taskactions2" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="taskactions2">
                                                    <li><a class="dropdown-item" href="apps-tasks-kanban"><i class="ri-pencil-line align-bottom text-muted"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-copy-line align-bottom text-muted"></i> Copy</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="ri-share-line align-bottom text-muted"></i> Share</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-line align-bottom text-muted"></i> Attach File</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item delete-item" href="#!"><i class="ri-delete-bin-5-line align-bottom text-muted"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-4">
                                            <span class="fw-bold text-body-emphasis">4/8</span>
                                            <div class="progress h-4px w-100" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-info w-50"></div>
                                            </div>
                                            <span class="fw-bold text-body-emphasis">50%</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="avatar-group">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Avatar">
                                                <div class="avatar-item avatar-sm">2+</div>
                                            </div>
                                            <p class="ms-auto text-end text-muted m-0 fs-6 fw-semibold"><span class="text-body-emphasis">Due in</span><span class="fs-12 ms-1">12 Days</span></p>
                                        </div>
                                    </div>
                                    <div class="card card-body border border-dashed shadow-none mb-0">
                                        <div class="d-flex gap-3 justify-content-between align-items-center pb-4">
                                            <div class="d-flex align-items-center gap-3 flex-grow-1 overflow-hidden">
                                                <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0"><i class="ri-seo-line"></i></button>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="apps-tasks-kanban">
                                                        <h5 class="mb-0 link-primary text-truncate">SEO Optimization</h5>
                                                    </a>
                                                    <div class="fw-semibold">Client:<span class="text-muted fs-12 ms-1">James Arthur</span></div>
                                                </div>
                                            </div>

                                            <div class="dropdown flex-shrink-0">
                                                <a href="#!" class=" btn icon-btn-sm btn-light-primary" id="taskactions3" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="taskactions3">
                                                    <li><a class="dropdown-item" href="apps-tasks-kanban"><i class="ri-pencil-line align-bottom text-muted"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-copy-line align-bottom text-muted"></i> Copy</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="ri-share-line align-bottom text-muted"></i> Share</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-line align-bottom text-muted"></i> Attach File</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item delete-item" href="#!"><i class="ri-delete-bin-5-line align-bottom text-muted"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-4">
                                            <span class="fw-bold text-body-emphasis">2/8</span>
                                            <div class="progress h-4px w-100" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-warning w-25"></div>
                                            </div>
                                            <span class="fw-bold text-body-emphasis">25%</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="avatar-group">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Avatar">
                                                <div class="avatar-item avatar-sm">3+</div>
                                            </div>
                                            <p class="ms-auto text-end text-muted m-0 fs-6 fw-semibold"><span class="text-body-emphasis">Due in</span><span class="fs-12 ms-1">8 Days</span></p>
                                        </div>
                                    </div>
                                    <div class="card card-body border border-dashed shadow-none mb-0">
                                        <div class="d-flex gap-3 justify-content-between align-items-center pb-4">
                                            <div class="d-flex align-items-center gap-3 flex-grow-1 overflow-hidden">
                                                <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0"><i class="ri-paint-fill"></i></button>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="apps-tasks-kanban">
                                                        <h5 class="mb-0 link-primary text-truncate">Graphic Design</h5>
                                                    </a>
                                                    <div class="fw-semibold">Client:<span class="text-muted fs-12 ms-1">Emma Clarke</span></div>
                                                </div>
                                            </div>

                                            <div class="dropdown flex-shrink-0">
                                                <a href="#!" class=" btn icon-btn-sm btn-light-primary" id="taskactions4" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="taskactions4">
                                                    <li><a class="dropdown-item" href="apps-tasks-kanban"><i class="ri-pencil-line align-bottom text-muted"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-copy-line align-bottom text-muted"></i> Copy</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="ri-share-line align-bottom text-muted"></i> Share</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-line align-bottom text-muted"></i> Attach File</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item delete-item" href="#!"><i class="ri-delete-bin-5-line align-bottom text-muted"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-4">
                                            <span class="fw-bold text-body-emphasis">7/8</span>
                                            <div class="progress h-4px w-100" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success w-75"></div>
                                            </div>
                                            <span class="fw-bold text-body-emphasis">75%</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="avatar-group">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="Avatar">
                                                <div class="avatar-item avatar-sm">2+</div>
                                            </div>
                                            <p class="ms-auto text-end text-muted m-0 fs-6 fw-semibold"><span class="text-body-emphasis">Due in</span><span class="fs-12 ms-1">5 Days</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="demo-tab-overdue" role="tabpanel">
                                <div class="vstack gap-3">
                                    <div class="card card-body border border-dashed shadow-none mb-0">
                                        <div class="d-flex gap-3 justify-content-between align-items-center pb-4">
                                            <div class="d-flex align-items-center gap-3 flex-grow-1 overflow-hidden">
                                                <button type="button" class="btn btn-light-danger icon-btn flex-shrink-0"><i class="ri-error-warning-fill"></i></button>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="apps-tasks-kanban">
                                                        <h5 class="mb-0 text-truncate">E-commerce Website Redesign</h5>
                                                    </a>
                                                    <div class="fw-semibold">Client:<span class="text-muted fs-12 ms-1">Alice Johnson</span></div>
                                                </div>
                                            </div>

                                            <div class="dropdown flex-shrink-0">
                                                <a href="#!" class="btn icon-btn-sm btn-light-danger" id="taskactions5" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="taskactions5">
                                                    <li><a class="dropdown-item" href="apps-tasks-kanban"><i class="ri-pencil-line align-bottom text-muted"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-copy-line align-bottom text-muted"></i> Copy</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="ri-share-line align-bottom text-muted"></i> Share</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-line align-bottom text-muted"></i> Attach File</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item delete-item" href="#!"><i class="ri-delete-bin-5-line align-bottom text-muted"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-4">
                                            <span class="fw-bold text-body-emphasis">0/5</span>
                                            <div class="progress h-4px w-100" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-danger w-0"></div>
                                            </div>
                                            <span class="fw-bold text-body-emphasis">0%</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="avatar-group">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Avatar">
                                                <div class="avatar-item avatar-sm">2+</div>
                                            </div>
                                            <p class="ms-auto text-end text-muted m-0 fs-6 fw-semibold"><span class="text-body-emphasis">Overdue by</span><span class="fs-12 ms-1">3 Days</span></p>
                                        </div>
                                    </div>
                                    <div class="card card-body border border-dashed shadow-none mb-0">
                                        <div class="d-flex gap-3 justify-content-between align-items-center pb-4">
                                            <div class="d-flex align-items-center gap-3 flex-grow-1 overflow-hidden">
                                                <button type="button" class="btn btn-light-danger icon-btn flex-shrink-0"><i class="ri-error-warning-fill"></i></button>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="apps-tasks-kanban">
                                                        <h5 class="mb-0 text-truncate">Social Media Campaign</h5>
                                                    </a>
                                                    <div class="fw-semibold">Client:<span class="text-muted fs-12 ms-1">Mark Taylor</span></div>
                                                </div>
                                            </div>

                                            <div class="dropdown flex-shrink-0">
                                                <a href="#!" class="btn icon-btn-sm btn-light-danger" id="taskactions6" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="taskactions6">
                                                    <li><a class="dropdown-item" href="apps-tasks-kanban"><i class="ri-pencil-line align-bottom text-muted"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-copy-line align-bottom text-muted"></i> Copy</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="ri-share-line align-bottom text-muted"></i> Share</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-line align-bottom text-muted"></i> Attach File</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item delete-item" href="#!"><i class="ri-delete-bin-5-line align-bottom text-muted"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-4">
                                            <span class="fw-bold text-body-emphasis">1/5</span>
                                            <div class="progress h-4px w-100" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-danger w-20"></div>
                                            </div>
                                            <span class="fw-bold text-body-emphasis">20%</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="avatar-group">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Avatar">
                                                <div class="avatar-item avatar-sm">1+</div>
                                            </div>
                                            <p class="ms-auto text-end text-muted m-0 fs-6 fw-semibold"><span class="text-body-emphasis">Overdue by</span><span class="fs-12 ms-1">1 Day</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="demo-tab-completed" role="tabpanel">
                                <div class="vstack gap-3">
                                    <div class="card card-body border border-dashed shadow-none mb-0">
                                        <div class="d-flex gap-3 justify-content-between align-items-center pb-4">
                                            <div class="d-flex align-items-center gap-3 flex-grow-1 overflow-hidden">
                                                <button type="button" class="btn btn-light-success icon-btn flex-shrink-0"><i class="ri-check-double-fill"></i></button>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="apps-tasks-kanban">
                                                        <h5 class="mb-0 text-truncate">Blog Website Launch</h5>
                                                    </a>
                                                    <div class="fw-semibold">Client:<span class="text-muted fs-12 ms-1">Sophia Brown</span></div>
                                                </div>
                                            </div>

                                            <div class="dropdown flex-shrink-0">
                                                <a href="#!" class="btn icon-btn-sm btn-light-success" id="taskactions7" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="taskactions7">
                                                    <li><a class="dropdown-item" href="apps-tasks-kanban"><i class="ri-pencil-line align-bottom text-muted"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-copy-line align-bottom text-muted"></i> Copy</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="ri-share-line align-bottom text-muted"></i> Share</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-line align-bottom text-muted"></i> Attach File</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item delete-item" href="#!"><i class="ri-delete-bin-5-line align-bottom text-muted"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-4">
                                            <span class="fw-bold text-body-emphasis">5/5</span>
                                            <div class="progress h-4px w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success w-100"></div>
                                            </div>
                                            <span class="fw-bold text-body-emphasis">100%</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="avatar-group">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Avatar">
                                                <div class="avatar-item avatar-sm">2+</div>
                                            </div>
                                            <p class="ms-auto text-end text-muted m-0 fs-6 fw-semibold"><span class="text-body-emphasis">Completed on</span><span class="fs-12 ms-1">15 Days Ago</span></p>
                                        </div>
                                    </div>
                                    <div class="card card-body border border-dashed shadow-none mb-0">
                                        <div class="d-flex gap-3 justify-content-between align-items-center pb-4">
                                            <div class="d-flex align-items-center gap-3 flex-grow-1 overflow-hidden">
                                                <button type="button" class="btn btn-light-success icon-btn flex-shrink-0"><i class="ri-check-double-fill"></i></button>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <a href="apps-tasks-kanban">
                                                        <h5 class="mb-0 text-truncate">Corporate Identity Design</h5>
                                                    </a>
                                                    <div class="fw-semibold">Client:<span class="text-muted fs-12 ms-1">David Wilson</span></div>
                                                </div>
                                            </div>

                                            <div class="dropdown flex-shrink-0">
                                                <a href="#!" class="btn icon-btn-sm btn-light-success" id="taskactions8" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                                                <ul class="dropdown-menu" aria-labelledby="taskactions8">
                                                    <li><a class="dropdown-item" href="apps-tasks-kanban"><i class="ri-pencil-line align-bottom text-muted"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-copy-line align-bottom text-muted"></i> Copy</a></li>
                                                    <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="ri-share-line align-bottom text-muted"></i> Share</a></li>
                                                    <li><a class="dropdown-item" href="#!"><i class="ri-file-line align-bottom text-muted"></i> Attach File</a></li>
                                                    <li>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li><a class="dropdown-item delete-item" href="#!"><i class="ri-delete-bin-5-line align-bottom text-muted"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-4">
                                            <span class="fw-bold text-body-emphasis">5/5</span>
                                            <div class="progress h-4px w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success w-100"></div>
                                            </div>
                                            <span class="fw-bold text-body-emphasis">100%</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="avatar-group">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Avatar">
                                                <img class="img-fluid avatar-item avatar-sm" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Avatar">
                                                <div class="avatar-item avatar-sm">1+</div>
                                            </div>
                                            <p class="ms-auto text-end text-muted m-0 fs-6 fw-semibold"><span class="text-body-emphasis">Completed on</span><span class="fs-12 ms-1">10 Days Ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card card-h-100">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <h5 class="card-title mb-0 flex-grow-1">Scehdule today</h5>
                        <a href="#!" class="btn btn-light-primary flex-shrink-0 btn-sm" data-bs-toggle="modal" data-bs-target="#addTasksModal">Add Task</a>
                    </div>
                    <div class="card-body">
                        <div class="full-picker">
                            <input type="text" class="form-control d-none" id="inline-date-picker" placeholder="Inline date picker">
                        </div>
                    </div>
                    <h5 class="fw-semibold py-3 bg-light bg-opacity-30 px-4 mb-0">Upcoming Tasks:</h5>
                    <div class="upcoming-task-scroll" data-simplebar>
                        <div class="card-body d-flex flex-column gap-4">
                            <div class="d-flex align-items-center">
                                <span class="bullet d-flex align-items-center me-4 bg-info"></span>
                                <div class="flex-grow-1 me-5">
                                    <h5 class="fw-semibold mb-0">9:30 - 10:00<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                                    <div class="fw-medium mb-1">Design Login Page UI</div>
                                    <div class="text-muted fw-medium fs-12">Lead by
                                        <a href="#!" class="fw-semibold">Emma Clark</a>
                                    </div>
                                </div>
                                <a href="apps-todo" class="btn btn-sm btn-light-primary">View</a>
                            </div>

                            <div class="d-flex align-items-center">
                                <span class="bullet d-flex align-items-center me-4 bg-primary flex-shrink-0"></span>
                                <div class="flex-grow-1 overflow-hidden me-5">
                                    <h5 class="fw-semibold mb-0">11:30 - 12:00<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                                    <div class="fw-medium mb-1 text-truncate">Develop User Authentication System</div>
                                    <div class="text-muted fw-medium fs-12">Lead by
                                        <a href="#!" class="fw-semibold">Alice Johnson</a>
                                    </div>
                                </div>
                                <a href="apps-todo" class="btn btn-sm btn-light-primary">View</a>
                            </div>

                            <div class="d-flex align-items-center">
                                <span class="bullet d-flex align-items-center me-4 bg-success flex-shrink-0"></span>
                                <div class="flex-grow-1 overflow-hidden me-5">
                                    <h5 class="fw-semibold mb-0">12:15 - 12:45<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                                    <div class="fw-medium mb-1 text-truncate">Implement Frontend Features for Dashboard</div>
                                    <div class="text-muted fw-medium fs-12">Lead by
                                        <a href="#!" class="fw-semibold">John Doe</a>
                                    </div>
                                </div>
                                <a href="apps-todo" class="btn btn-sm btn-light-primary">View</a>
                            </div>

                            <div class="d-flex align-items-center">
                                <span class="bullet d-flex align-items-center me-4 bg-warning flex-shrink-0"></span>
                                <div class="flex-grow-1 overflow-hidden me-5">
                                    <h5 class="fw-semibold mb-0">1:00 - 1:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                                    <div class="fw-medium mb-1 text-truncate">Optimize Database Queries for Performance</div>
                                    <div class="text-muted fw-medium fs-12">Lead by
                                        <a href="#!" class="fw-semibold">Michael Green</a>
                                    </div>
                                </div>
                                <a href="apps-todo" class="btn btn-sm btn-light-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card mb-md-0">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <h5 class="card-title mb-0">Recent activity</h5>
                        <div class="dropdown flex-shrink-0">
                            <a class="text-reset dropdown-toggle" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="text-muted text-uppercase fs-12"><i class="ri-settings-4-line align-bottom me-1"></i>Options</span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#!">Sort by Date</a>
                                <a class="dropdown-item" href="#!">Sort by User</a>
                                <a class="dropdown-item" href="#!">Filter by Status</a>
                                <a class="dropdown-item delete-item" href="#!">Clear All</a>
                            </div>
                        </div>
                    </div>
                    <div class="recent-activity-scroll" data-simplebar>
                        <div class="card-body">
                            <ul class="timeline-box mb-0">
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 text-bg-primary avatar-item avatar">AG</div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">Angelina Gotelli</h5>
                                            <p class="mb-0 text-muted fs-12">09:30 AM</p>
                                        </div>
                                        <div class="mt-1 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                                            <span>updated the task </span>
                                            <span class="fw-semibold text-body">TASK-1023</span>
                                            <span>status to</span>
                                            <span class="d-inline-flex align-items-center gap-2">
                                                <span class="bullet d-flex align-items-center bg-success flex-shrink-0"></span>
                                                <span class="fw-semibold text-body">Completed</span>
                                            </span>
                                        </div>
                                    </div>
                                </li>

                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" class="border-0 avatar-item avatar" alt="user Image">
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
                                        <div class="p-4 fs-13 rounded-4 bg-light bg-opacity-30 mt-3">Looks like the latest feature implementation has a few issues with the integration. Let's focus on fixing that bug before deployment.</div>
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
                                            <h5 class="mb-0 fw-medium">Shannon Baker</h5>
                                            <p class="mb-0 text-muted fs-12">06:30 AM</p>
                                        </div>
                                        <div class="mt-1 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                                            <span>uploaded the document</span>
                                            <span class="fw-semibold text-body">update_v2.0_documentation.pdf</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <img src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" class="border-0 avatar-item avatar" alt="user Image">
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">Roberta Horton</h5>
                                            <p class="mb-0 text-muted fs-12">05:10 AM</p>
                                        </div>
                                        <div class="mt-1 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                                            <span>mentioned you in a comment on</span>
                                            <span class="fw-semibold text-body">TASK-1109</span>
                                        </div>
                                        <div class="p-4 fs-13 rounded-4 bg-light bg-opacity-30 mt-3"><strong>@Max</strong> We need to revisit the security protocols for the API before moving forward with the client release.</div>
                                    </div>
                                </li>

                                <li class="timeline-section pb-0">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 text-bg-info avatar-item avatar">LW</div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">Lee Wheeler</h5>
                                            <p class="mb-0 text-muted fs-12">03:00 AM</p>
                                        </div>
                                        <div class="mt-1 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                                            <span>assigned the task</span>
                                            <span class="fw-semibold text-body">TASK-1160</span>
                                            <span>to</span>
                                            <span class="fw-semibold text-body">Alvin Moreno</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div class="flex-grow-1">
                            <h5 class="mb-1">Project Analytics</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-outline-primary btn-sm active">1W</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">1M</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">6M</button>
                            <button type="button" class="btn btn-outline-primary btn-sm">1Y</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="project-overview"></div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-icon flex-grow-1">
                            <i class="ri-search-line cursor-pointer text-muted"></i>
                            <input type="text" name="new-search" id="new-search" class="form-control form-control-icon" placeholder="Search" aria-label="search">
                        </div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs-bordered gap-4 my-4" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link px-0 py-1 active" data-bs-toggle="tab" href="#primary_chat" role="tab" aria-selected="true">Primary</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link px-0 py-1" data-bs-toggle="tab" href="#general_chat" role="tab" aria-selected="false" tabindex="-1">General</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active show" id="primary_chat" role="tabpanel">
                                <div class="project-chat-container" data-simplebar>
                                    <ul class="list-group fs-13 fw-medium list-group-flush">
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">John Doe</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Emily Johnson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Alice Smith</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Michael Jackson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Rachel Green</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Liam Peters</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="general_chat" role="tabpanel">
                                <div class="project-chat-container" data-simplebar>
                                    <ul class="list-group fs-13 fw-medium list-group-flush">
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">John Doe</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Alice Smith</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Emily Johnson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Michael Jackson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Liam Peters</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
                                                <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="apps-chat" class="fs-6 fw-bold text-body">Rachel Green</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-0">
            <table class="dt-project-list align-middle table w-100">
                <thead class="bg-light bg-opacity-30">
                    <tr>
                        <th class="px-5"></th>
                        <th>Project Name</th>
                        <th>Leader</th>
                        <th>Team</th>
                        <th class="text-truncate">Due Date</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Completion</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
    @include('partials.social-share-modal')
    @include('partials.share-contact-modal')
    @include('partials.create-task')
  
@endsection

@section('js')

    <!-- Datatable js -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- Countup init -->
    <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

    <!-- Tagify js -->
    <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Project list init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-projects-list.init.js') }}"></script>

    <!-- Project Dashboard init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard-project.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Create Task init -->
    <script src="{{ asset('assets/js/partials/create-task.init.js') }}"></script>
    @endsection
