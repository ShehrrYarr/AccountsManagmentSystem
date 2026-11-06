@extends('partials.layouts.master')

@section('title', 'Teachers List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Teachers List')
@section('pagetitle', 'Dashboard')
@section('buttonTitle', 'Add Product')
@section('link', '#!')


@section('content')


    <div class="card mb-0">
        <div class="card-body">
            <div class="hstack justify-content-between gap-3">
                <h5 class="card-title mb-0">Teachers List</h5>
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn icon-btn-sm active" data-bs-toggle="tab" href="#demo-tab-5_home" role="tab"
                            aria-selected="true" tabindex="-1">
                            <i class="ri-list-check"></i>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link btn icon-btn-sm" data-bs-toggle="tab" href="#demo-tab-5_profile" role="tab"
                            aria-selected="false">
                            <i class="ri-layout-grid-line"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane active show" id="demo-tab-5_home" role="tabpanel">
            <div class="card mt-4 mb-0">
                <table class="dt-teacher-list table-nowrap align-middle table w-100 mb-0">
                    <thead class="bg-light bg-opacity-30">
                        <tr>
                            <th class="px-5"></th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th class="text-truncate">Date of Join</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th class="w-75px">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="demo-tab-5_profile" role="tabpanel">
            <div class="row pt-4 g-4">
                <!-- Card 1 -->
                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card shadow-sm mb-0 h-100">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-teacher-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center mb-4">
                                <div class="position-relative w-max mx-auto">
                                    <div class="avatar-item avatar-xl overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <span
                                        class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"></span>
                                </div>
                            </div>

                            <div class="text-center mb-2">
                                <a href="apps-course-teacher-details" class="text-decoration-none">
                                    <h5 class="mb-0">Roxy Floodgate</h5>
                                </a>
                                <p class="text-muted">Physics Teacher</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-half-fill text-warning me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <span class="text-muted">4.5/5 (50 Reviews)</span>
                            </div>

                            <div class="d-flex flex-column align-items-center gap-1 mb-3">
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Email: </p>
                                    <span class="text-muted text-truncate ms-1">roxy724@gmail.com</span>
                                </div>
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Phone: </p>
                                    <span class="text-muted text-truncate ms-1">+91 82392 37359</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mb-5">
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-twitter-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-linkedin-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-github-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-dribbble-fill fs-18"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="#!" class="btn btn-sm btn-light-primary">View Profile</a>
                                <a href="#!" class="btn btn-sm btn-light">Message</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card shadow-sm mb-0 h-100">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-teacher-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center mb-4">
                                <div class="position-relative w-max mx-auto">
                                    <div class="avatar-item avatar-xl overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <span
                                        class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0 m-1"></span>
                                </div>
                            </div>

                            <div class="text-center mb-2">
                                <a href="apps-course-teacher-details" class="text-decoration-none">
                                    <h5 class="mb-0">Roy Southerell</h5>
                                </a>
                                <p class="text-muted">Computer Teacher</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <span class="text-muted">2.5/5 (15 Reviews)</span>
                            </div>

                            <div class="d-flex flex-column align-items-center gap-1 mb-3">
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Email: </p>
                                    <span class="text-muted text-truncate ms-1">roy20@gmail.com</span>
                                </div>
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Phone: </p>
                                    <span class="text-muted text-truncate ms-1">+91 82392 37359</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mb-5">
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-twitter-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-linkedin-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-github-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-dribbble-fill fs-18"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="#!" class="btn btn-sm btn-light-primary">View Profile</a>
                                <a href="#!" class="btn btn-sm btn-light">Message</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card shadow-sm mb-0 h-100">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-teacher-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center mb-4">
                                <div class="position-relative w-max mx-auto">
                                    <div class="avatar-item avatar-xl overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <span
                                        class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-warning end-0 bottom-0 m-1"></span>
                                </div>
                            </div>

                            <div class="text-center mb-2">
                                <a href="apps-course-teacher-details" class="text-decoration-none">
                                    <h5 class="mb-0">Dr. Sarah Kruger</h5>
                                </a>
                                <p class="text-muted">Mathematics Teacher</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-half-fill text-warning me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <span class="text-muted">4.5/5 (30 Reviews)</span>
                            </div>

                            <div class="d-flex flex-column align-items-center gap-1 mb-3">
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Email: </p>
                                    <span class="text-muted text-truncate ms-1">sarah.kruger@example.com</span>
                                </div>
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Phone: </p>
                                    <span class="text-muted text-truncate ms-1">+91 91192 39359</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mb-5">
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-twitter-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-linkedin-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-github-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-dribbble-fill fs-18"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="#!" class="btn btn-sm btn-light-primary">View Profile</a>
                                <a href="#!" class="btn btn-sm btn-light">Message</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card shadow-sm mb-0 h-100">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-teacher-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center mb-4">
                                <div class="position-relative w-max mx-auto">
                                    <div class="avatar-item avatar-xl overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <span
                                        class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-info end-0 bottom-0 m-1"></span>
                                </div>
                            </div>

                            <div class="text-center mb-2">
                                <a href="apps-course-teacher-details" class="text-decoration-none">
                                    <h5 class="mb-0">Sarah Jonson</h5>
                                </a>
                                <p class="text-muted">Biology Teacher</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-half-fill text-warning me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <span class="text-muted">4.5/5 (50 Reviews)</span>
                            </div>

                            <div class="d-flex flex-column align-items-center gap-1 mb-3">
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Email: </p>
                                    <span class="text-muted text-truncate ms-1">sarah.jonson@gmail.com</span>
                                </div>
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Phone: </p>
                                    <span class="text-muted text-truncate ms-1">+91 82932 37359</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mb-5">
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-twitter-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-linkedin-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-github-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-dribbble-fill fs-18"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="#!" class="btn btn-sm btn-light-primary">View Profile</a>
                                <a href="#!" class="btn btn-sm btn-light">Message</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card shadow-sm mb-0 h-100">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-teacher-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center mb-4">
                                <div class="position-relative w-max mx-auto">
                                    <div class="avatar-item avatar-xl overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <span
                                        class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"></span>
                                </div>
                            </div>

                            <div class="text-center mb-2">
                                <a href="apps-course-teacher-details" class="text-decoration-none">
                                    <h5 class="mb-0">Chris Donnelly</h5>
                                </a>
                                <p class="text-muted">History Teacher</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-half-fill text-warning me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <span class="text-muted">4.5/5 (50 Reviews)</span>
                            </div>

                            <div class="d-flex flex-column align-items-center gap-1 mb-3">
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Email: </p>
                                    <span class="text-muted text-truncate ms-1">chris.don@gmail.com</span>
                                </div>
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Phone: </p>
                                    <span class="text-muted text-truncate ms-1">+91 82392 37359</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mb-5">
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-twitter-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-linkedin-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-github-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-dribbble-fill fs-18"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="#!" class="btn btn-sm btn-light-primary">View Profile</a>
                                <a href="#!" class="btn btn-sm btn-light">Message</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card shadow-sm mb-0 h-100">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-teacher-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center mb-4">
                                <div class="position-relative w-max mx-auto">
                                    <div class="avatar-item avatar-xl overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <span
                                        class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0 m-1"></span>
                                </div>
                            </div>

                            <div class="text-center mb-2">
                                <a href="apps-course-teacher-details" class="text-decoration-none">
                                    <h5 class="mb-0">Claire McShane</h5>
                                </a>
                                <p class="text-muted">Chemistry Teacher</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-half-fill text-warning me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <span class="text-muted">4.5/5 (50 Reviews)</span>
                            </div>

                            <div class="d-flex flex-column align-items-center gap-1 mb-3">
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Email: </p>
                                    <span class="text-muted text-truncate ms-1">claire.mcs@example.com</span>
                                </div>
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Phone: </p>
                                    <span class="text-muted text-truncate ms-1">+91 93001 37359</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mb-5">
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-twitter-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-linkedin-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-github-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-dribbble-fill fs-18"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="#!" class="btn btn-sm btn-light-primary">View Profile</a>
                                <a href="#!" class="btn btn-sm btn-light">Message</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="col-12 col-md-6 col-lg-4 detete-element">
                    <div class="card shadow-sm mb-0 h-100">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-teacher-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center mb-4">
                                <div class="position-relative w-max mx-auto">
                                    <div class="avatar-item avatar-xl overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <span
                                        class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"></span>
                                </div>
                            </div>

                            <div class="text-center mb-2">
                                <a href="apps-course-teacher-details" class="text-decoration-none">
                                    <h5 class="mb-0">Emma Greenwald</h5>
                                </a>
                                <p class="text-muted">Geography Teacher</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <span class="text-muted">2.5/5 (20 Reviews)</span>
                            </div>

                            <div class="d-flex flex-column align-items-center gap-1 mb-3">
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Email: </p>
                                    <span class="text-muted text-truncate ms-1">emma.green@example.com</span>
                                </div>
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Phone: </p>
                                    <span class="text-muted text-truncate ms-1">+91 91392 37359</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mb-5">
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-twitter-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-linkedin-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-github-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-dribbble-fill fs-18"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="#!" class="btn btn-sm btn-light-primary">View Profile</a>
                                <a href="#!" class="btn btn-sm btn-light">Message</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="col-12 col-md-6 col-lg-4 detete-element">
                    <div class="card shadow-sm mb-0 h-100">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-teacher-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-teacher-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center mb-4">
                                <div class="position-relative w-max mx-auto">
                                    <div class="avatar-item avatar-xl overflow-hidden">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <span
                                        class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-secondary end-0 bottom-0 m-1"></span>
                                </div>
                            </div>

                            <div class="text-center mb-2">
                                <a href="apps-course-teacher-details" class="text-decoration-none">
                                    <h5 class="mb-0">David Shephard</h5>
                                </a>
                                <p class="text-muted">English Teacher</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-fill text-warning me-1"></i>
                                <i class="ri ri-star-half-fill text-warning me-1"></i>
                                <i class="ri ri-star-line text-muted me-1"></i>
                                <span class="text-muted">4.5/5 (40 Reviews)</span>
                            </div>

                            <div class="d-flex flex-column align-items-center gap-1 mb-3">
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Email: </p>
                                    <span class="text-muted text-truncate ms-1">david.shephard@example.com</span>
                                </div>
                                <div class="hstack justify-content-center">
                                    <p class="mb-0 fw-medium">Phone: </p>
                                    <span class="text-muted text-truncate ms-1">+91 92432 37359</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3 mb-5">
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-twitter-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-linkedin-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-github-fill fs-18"></i>
                                </a>
                                <a href="#!" class="text-decoration-none text-muted">
                                    <i class="ri ri-dribbble-fill fs-18"></i>
                                </a>
                            </div>

                            <div class="d-flex justify-content-center gap-2">
                                <a href="#!" class="btn btn-sm btn-light-primary">View Profile</a>
                                <a href="#!" class="btn btn-sm btn-light">Message</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-teacher-profile" tabindex="-1" role="dialog"
        aria-labelledby="edit-teacher-profile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Teacher Profile</h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                        <div class="avatar-item avatar-xl overflow-hidden">
                            <img class="img-fluid" alt="avatar image"
                                src="{{ asset('assets/images/avatar/avatar-1.jpg') }}">
                        </div>
                        <div>
                            <div class="hstack gap-3 mb-3">
                                <button class="btn btn-sm btn-light-primary">Upload</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </div>
                            <p class="mb-0 text-muted fs-13">Upload image size 4MB, Format JPG, PNG, SVG</p>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <label class="form-label" for="teacher-name">Name</label>
                            <input type="text" class="form-control" id="teacher-name" placeholder="Enter your name">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="teacher-designation">Designation</label>
                            <input type="text" class="form-control" id="teacher-designation"
                                placeholder="Enter your designation">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="teacher-email">Email</label>
                            <input type="email" class="form-control" id="teacher-email"
                                placeholder="Enter your email">
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="teacher-phone">Phone Number</label>
                            <input type="number" class="form-control" id="teacher-phone"
                                placeholder="Enter your phone number">
                        </div>

                    </div>
                    <div class="row g-4 mt-3">

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="d-block flex-shrink-0 me-3">
                                    <div class="avatar-item border-0 avatar avatar-title text-primary bg-primary-subtle">
                                        <i class="ri-twitter-fill fs-20"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="twitter-username"
                                    placeholder="www.example.com" value="www.example.com">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="d-block flex-shrink-0 me-3">
                                    <div
                                        class="avatar-item border-0 avatar avatar-title text-body-emphasis bg-dark-subtle">
                                        <i class="ri-github-fill fs-20"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="github-username" placeholder="Username"
                                    value="@daveadame">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="d-block flex-shrink-0 me-3">
                                    <div class="avatar-item border-0 avatar avatar-title text-info bg-info-subtle">
                                        <i class="ri-linkedin-fill fs-20"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="linkedin-username" placeholder="Username"
                                    value="@dave_adame">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="d-block flex-shrink-0 me-3">
                                    <div class="avatar-item border-0 avatar avatar-title text-danger bg-danger-subtle">
                                        <i class="ri-dribbble-fill fs-20"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="dribbble-username" placeholder="Username"
                                    value="@dave_adame">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Teacher List init -->
    <script src="{{ asset('assets/js/apps/course/apps-teacher-list.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
