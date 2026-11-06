@extends('partials.layouts.master')

@section('title', 'Student List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Student List')
@section('pagetitle', 'Online Course')
@section('buttonTitle', 'Add Product')
@section('link', '#!')

@section('content')

    <div class="card mb-0">
        <div class="card-body">
            <div class="hstack justify-content-between gap-3">
                <h5 class="card-title mb-0">Student List</h5>
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
                <table class="dt-student-list table-nowrap align-middle table w-100">
                    <thead class="bg-light bg-opacity-30">
                        <tr>
                            <th class="px-5"></th>
                            <th class="w-64px">Roll No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Phone Number</th>
                            <th>Gender</th>
                            <th class="text-truncate">Date of Join</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="demo-tab-5_profile" role="tabpanel">
            <div class="row pt-4 g-4">
                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    Roxy Floodgate
                                </a>
                                <i class="ri-verified-badge-fill text-primary" title="Verified"></i>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">Full Stack Web Development</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-half-fill text-warning me-1" title="4.5 stars"></i>
                                <span class="text-muted">4.9/5 (200 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56789</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary" href="mailto:floodgate@gmail.com">
                                        floodgate@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">5 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details" class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    Roy Southerell
                                </a>
                                <i class="ri-verified-badge-fill text-primary" title="Verified"></i>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">UI/UX Design & Development</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-half-fill text-warning me-1" title="4.5 stars"></i>
                                <span class="text-muted">4.5/5 (50 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56788</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary hover:text-primary" href="mailto:southerell@gmail.com">
                                        southerell@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">3 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details"
                                class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    Briny Undrell
                                </a>
                                <i class="ri-verified-badge-fill text-primary" title="Verified"></i>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">Responsive Web Design</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-half-fill text-warning me-1" title="4.5 stars"></i>
                                <span class="text-muted">4.5/5 (50 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56787</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary hover:text-primary" href="mailto:undrell@gmail.com">
                                        undrell@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">7 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details"
                                class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    Kendell Longstreeth
                                </a>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">Web Development Bootcamp</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="3 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="3 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="3 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="3 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="3 stars"></i>
                                <span class="text-muted">3/5 (10 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56786</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary hover:text-primary" href="mailto:longstreeth@gmail.com">
                                        longstreeth@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">2 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details"
                                class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    Dorris Grigoriev
                                </a>
                                <i class="ri-verified-badge-fill text-primary" title="Verified"></i>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">UX/UI Design Mastery</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-half-fill text-warning me-1" title="4.7 stars"></i>
                                <span class="text-muted">4.7/5 (156 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56785</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary hover:text-primary" href="mailto:grigoriev@gmail.com">
                                        grigoriev@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">12 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details"
                                class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    Zeb Kenningham
                                </a>
                                <i class="ri-verified-badge-fill text-primary" title="Verified"></i>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">Advanced Front-End Web Development</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-half-fill text-warning me-1" title="4.7 stars"></i>
                                <span class="text-muted">4.7/5 (156 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56784</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary hover:text-primary" href="mailto:kenningham@gmail.com">
                                        kenningham@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">4 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details"
                                class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    Luke Langford
                                </a>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">JavaScript Development</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="4.0 stars"></i>
                                <span class="text-muted">4.0/5 (45 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56783</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary hover:text-primary" href="mailto:langford@gmail.com">
                                        langford@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">6 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details"
                                class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    Emma Tan
                                </a>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">React Native Development</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="4.0 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="4.0 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="4.0 stars"></i>
                                <span class="text-muted">3.0/5 (12 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56782</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary hover:text-primary" href="mailto:tanemma@gmail.com">
                                        tanemma@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">4 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details"
                                class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 delete-element">
                    <div class="card h-100 mb-0 shadow-sm border-light rounded">
                        <div class="card-body p-4">

                            <div class="dropdown float-end">
                                <a href="#!" class="btn icon-btn-sm btn-text-primary" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ri ri-more-2-fill fs-14"></i>
                                </a>
                                <ul class="dropdown-menu p-3">
                                    <li>
                                        <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                            data-bs-target="#edit-student-profile">Edit</a>
                                    </li>
                                    <li>
                                        <a href="apps-course-student-details" class="dropdown-item">View</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="position-relative w-max mx-auto mb-3">
                                <div class="avatar-item avatar-xl overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                        alt="avatar image">
                                </div>
                                <span
                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0 m-1"
                                    title="Student is online"></span>
                            </div>

                            <div class="hstack justify-content-center gap-1">
                                <a class="text-body fw-medium" href="#!">
                                    John Parker
                                </a>
                            </div>

                            <p class="text-muted fs-12 mb-2 text-center">Web Development Bootcamp</p>

                            <div class="hstack mb-3 fs-13 justify-content-center">
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-fill text-warning me-1" title="5 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="4.0 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="4.0 stars"></i>
                                <i class="ri ri-star-line text-muted me-1" title="4.0 stars"></i>
                                <span class="text-muted">3.0/5 (12 Reviews)</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-2">
                                <div class="d-flex align-items-center fs-13 text-secondary">
                                    <i class="ri-phone-line me-1 text-muted fs-13" title="Phone"></i>
                                    <span class="text-muted">+91 91234 56781</span>
                                </div>

                                <div class="d-flex align-items-center fs-13">
                                    <i class="ri-mail-line me-1 text-muted" title="Email"></i>
                                    <a class="text-secondary hover:text-primary" href="mailto:parkerjohn@gmail.com">
                                        parkerjohn@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <i class="ri-book-line me-1 text-muted fs-13" title="Email"></i>
                                <span class="text-muted fs-13">12 Courses Enrolled</span>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <a href="apps-course-student-details"
                                class="btn btn-sm btn-light-primary text-decoration-none">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-student-profile" tabindex="-1" role="dialog"
        aria-labelledby="edit-student-profile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student Profile</h5>
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

    <!-- Student List init -->
    <script src="{{ asset('assets/js/apps/course/apps-student-list.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
