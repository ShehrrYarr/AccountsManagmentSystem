@extends('partials.layouts.master')

@section('title', 'File Manager | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'File Manager')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'Add File')
@section('modalTarget', 'uploadModal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
@endsection

@section('content')


    <div class="row g-5 file-manager">

        <div class="col-lg-4 col-xl-3">
            <div class="file-manager-sidebar">
                <div class="card mb-0">
                    <div class="card-header p-3">
                        <h5 class="card-title mb-0">
                            File Manager
                        </h5>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3 border-bottom border-block-end-dashed">
                        <div class="position-relative">
                            <div class="avatar-item">
                                <img class="img-fluid avatar-lg rounded-2"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                            </div>
                            <span
                                class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Daniel David </h6>
                            <p class="mb-0 fs-12 text-muted">danieldavid@mail.com </p>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group list-borderless">
                            <li class="list-group-item p-3 rounded-3 px-0 pt-0">
                                <span class="fs-12 text-muted">My Files</span>
                            </li>
                            <li class="list-group-item px-3 py-2 rounded-3 active">
                                <a href="#!">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ri-folder-2-line fs-16"></i>
                                        </div>
                                        <span class="flex-fill text-nowrap"> All Files </span>
                                        <span class="badge bg-primary">412</span>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-3 py-2 rounded-3">
                                <a href="#!">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ri-history-fill fs-16"></i>
                                        </div>
                                        <span class="flex-fill text-nowrap"> Recent Files </span>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-3 py-2 rounded-3">
                                <a href="#!">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ri-share-forward-line fs-16"></i>
                                        </div>
                                        <span class="flex-fill text-nowrap"> Shared Files </span>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-3 py-2 rounded-3">
                                <a href="#!">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ri-star-s-line fs-16"></i>
                                        </div>
                                        <span class="flex-fill text-nowrap"> favourites </span>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-3 py-2 rounded-3">
                                <a href="#!">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ri-delete-bin-line fs-16"></i>
                                        </div>
                                        <span class="flex-fill text-nowrap"> Trash </span>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-3 py-2 rounded-3">
                                <a href="#!">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ri-settings-3-line fs-16"></i>
                                        </div>
                                        <span class="flex-fill text-nowrap"> Settings </span>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-3 py-2 rounded-3">
                                <a href="#!">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ri-questionnaire-line fs-16"></i>
                                        </div>
                                        <span class="flex-fill text-nowrap"> Help Center </span>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item px-3 py-2 rounded-3">
                                <a href="#!">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="ri-logout-box-line fs-16"></i>
                                        </div>
                                        <span class="flex-fill text-nowrap"> Sign Out </span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-auto card-footer">
                        <h6 class="fs-11 text-muted text-uppercase mb-3">Storage Status</h6>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="ri-database-2-line fs-17"></i>
                            </div>
                            <div class="flex-grow-1 ms-3 overflow-hidden">
                                <div class="progress mb-2 progress-sm">
                                    <div class="progress-bar bg-success w-50" role="progressbar" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="text-muted fs-12 d-block text-truncate"><b>59.5</b>GB used of
                                    <b>119</b>GB</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-9">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header flex-wrap hstack justify-content-between gap-2">
                    <h5 class="card-title mb-0">My Drive</h5>
                    <div class="d-flex align-items-center gap-2">
                        <div class="btn-group" role="group">
                            <!-- Upload Button -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#uploadModal">
                                <i class="bi-cloud-arrow-up-fill me-1"></i> Upload
                            </button>
                            <!-- Dropdown Menu for File Creation and Upload -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" id="uploadGroupDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false" aria-label="File options"></button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="uploadGroupDropdown">
                                    <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#create-file">
                                        <i class="bi-file-plus"></i> New file
                                    </a>
                                    <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#create-folder">
                                        <i class="bi-folder-plus"></i> New folder
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                        data-bs-target="#uploadModal">
                                        <i class="bi-upload"></i> Upload folder
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Recent Files Section -->
                    <div class="my-4">
                        <h6 class="fw-semibold">Files</h6>
                    </div>
                    <div class="row">
                        <!-- File 1: JPG Image -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-20 border border-light shadow-none card-h-100">
                                <!-- Add Favorite -->
                                <div class="position-absolute start-0 p-3">
                                    <div class="custom-toggle text-warning fs-12 d-flex align-items-center cursor-pointer"
                                        role="button" aria-label="Toggle Favorite">
                                        <span class="icon-on" aria-hidden="true"><i class="bi bi-star-fill"></i></span>
                                        <span class="icon-off" aria-hidden="true"><i class="bi bi-star"></i></span>
                                    </div>
                                </div>
                                <div class="position-absolute end-0 p-2">
                                    <!-- File Action Dropdown -->
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="More options">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareFileModal"><i class="bi-share"></i> Share File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Move
                                                to Folder</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-download"></i> Download
                                                File</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                    class="bi-trash"></i> Delete File</a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card-body d-flex justify-content-center align-items-center p-0 overflow-hidden min-h-112px">
                                    <i class="bi bi-image ms-2 fs-32" style="color: #f96767;"></i>
                                </div>
                                <hr class="m-0 mx-3">
                                <div class="card-footer bg-transparent border-0 p-3 text-center">
                                    <h6 class="mb-0 fw-semibold text-truncate">Vacation Photo - JPG</h6>
                                    <p class="text-muted mb-0 fs-12">Uploaded 2 days ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- File 2: PNG Image -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-20 border border-light shadow-none card-h-100">
                                <!-- Add Favorite -->
                                <div class="position-absolute start-0 p-3">
                                    <div class="custom-toggle text-warning fs-12 d-flex align-items-center cursor-pointer"
                                        role="button" aria-label="Toggle Favorite">
                                        <span class="icon-on" aria-hidden="true"><i class="bi bi-star-fill"></i></span>
                                        <span class="icon-off" aria-hidden="true"><i class="bi bi-star"></i></span>
                                    </div>
                                </div>
                                <div class="position-absolute end-0 p-2">
                                    <!-- File Action Dropdown -->
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="More options">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareFileModal"><i class="bi-share"></i> Share File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Move
                                                to Folder</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-download"></i> Download
                                                File</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                    class="bi-trash"></i> Delete File</a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card-body d-flex justify-content-center align-items-center p-0 overflow-hidden min-h-112px">
                                    <i class="bi bi-image ms-2 fs-32 text-primary"></i>
                                </div>
                                <hr class="m-0 mx-3">
                                <div class="card-footer bg-transparent border-0 p-3 text-center">
                                    <h6 class="mb-0 fw-semibold text-truncate">Company Logo - PNG</h6>
                                    <p class="text-muted mb-0 fs-12">Uploaded 1 day ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- File 3: PDF Document -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-20 border border-light shadow-none card-h-100">
                                <!-- Add Favorite -->
                                <div class="position-absolute start-0 p-3">
                                    <div class="custom-toggle text-warning fs-12 d-flex align-items-center cursor-pointer active"
                                        role="button" aria-label="Toggle Favorite" aria-pressed="true">
                                        <span class="icon-on" aria-hidden="true"><i class="bi bi-star-fill"></i></span>
                                        <span class="icon-off" aria-hidden="true"><i class="bi bi-star"></i></span>
                                    </div>
                                </div>
                                <div class="position-absolute end-0 p-2">
                                    <!-- File Action Dropdown -->
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="More options">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareFileModal"><i class="bi-share"></i> Share File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Move
                                                to Folder</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-download"></i> Download
                                                File</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                    class="bi-trash"></i> Delete File</a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card-body d-flex justify-content-center align-items-center p-0 overflow-hidden min-h-112px">
                                    <i class="bi bi-file-earmark-pdf ms-2 fs-32 text-danger"></i>
                                </div>
                                <hr class="m-0 mx-3">
                                <div class="card-footer bg-transparent border-0 p-3 text-center">
                                    <h6 class="mb-0 fw-semibold text-truncate">Business Proposal - PDF</h6>
                                    <p class="text-muted mb-0 fs-12">Uploaded 4 days ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- File 4: Word Document -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-20 border border-light shadow-none card-h-100">
                                <!-- Add Favorite -->
                                <div class="position-absolute start-0 p-3">
                                    <div class="custom-toggle text-warning fs-12 d-flex align-items-center cursor-pointer"
                                        role="button" aria-label="Toggle Favorite">
                                        <span class="icon-on" aria-hidden="true"><i class="bi bi-star-fill"></i></span>
                                        <span class="icon-off" aria-hidden="true"><i class="bi bi-star"></i></span>
                                    </div>
                                </div>
                                <div class="position-absolute end-0 p-2">
                                    <!-- File Action Dropdown -->
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="More options">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareFileModal"><i class="bi-share"></i> Share File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Move
                                                to Folder</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-download"></i> Download
                                                File</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                    class="bi-trash"></i> Delete File</a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card-body d-flex justify-content-center align-items-center p-0 overflow-hidden min-h-112px">
                                    <i class="bi bi-file-earmark-word ms-2 fs-32 text-info"></i>
                                </div>
                                <hr class="m-0 mx-3">
                                <div class="card-footer bg-transparent border-0 p-3 text-center">
                                    <h6 class="mb-0 fw-semibold text-truncate">Annual Report - DOCX</h6>
                                    <p class="text-muted mb-0 fs-12">Uploaded 5 days ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- File 5: Excel Spreadsheet -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-20 border border-light shadow-none card-h-100">
                                <!-- Add Favorite -->
                                <div class="position-absolute start-0 p-3">
                                    <div class="custom-toggle text-warning fs-12 d-flex align-items-center cursor-pointer"
                                        role="button" aria-label="Toggle Favorite">
                                        <span class="icon-on" aria-hidden="true"><i class="bi bi-star-fill"></i></span>
                                        <span class="icon-off" aria-hidden="true"><i class="bi bi-star"></i></span>
                                    </div>
                                </div>
                                <div class="position-absolute end-0 p-2">
                                    <!-- File Action Dropdown -->
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="More options">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareFileModal"><i class="bi-share"></i> Share File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Move
                                                to Folder</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-download"></i> Download
                                                File</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                    class="bi-trash"></i> Delete File</a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card-body d-flex justify-content-center align-items-center p-0 overflow-hidden min-h-112px">
                                    <i class="bi bi-file-earmark-excel ms-2 fs-32 text-success"></i>
                                </div>
                                <hr class="m-0 mx-3">
                                <div class="card-footer bg-transparent border-0 p-3 text-center">
                                    <h6 class="mb-0 fw-semibold text-truncate">Financial Data - XLSX</h6>
                                    <p class="text-muted mb-0 fs-12">Uploaded 3 days ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- File 6: PowerPoint Presentation -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-20 border border-light shadow-none card-h-100">
                                <!-- Add Favorite -->
                                <div class="position-absolute start-0 p-3">
                                    <div class="custom-toggle text-warning fs-12 d-flex align-items-center cursor-pointer active"
                                        role="button" aria-label="Toggle Favorite" aria-pressed="true">
                                        <span class="icon-on" aria-hidden="true"><i class="bi bi-star-fill"></i></span>
                                        <span class="icon-off" aria-hidden="true"><i class="bi bi-star"></i></span>
                                    </div>
                                </div>
                                <div class="position-absolute end-0 p-2">
                                    <!-- File Action Dropdown -->
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="More options">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareFileModal"><i class="bi-share"></i> Share File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Move
                                                to Folder</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-download"></i> Download
                                                File</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                    class="bi-trash"></i> Delete File</a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card-body d-flex justify-content-center align-items-center p-0 overflow-hidden min-h-112px">
                                    <i class="bi bi-file-earmark-ppt ms-2 fs-32 text-danger-emphasis"></i>
                                </div>
                                <hr class="m-0 mx-3">
                                <div class="card-footer bg-transparent border-0 p-3 text-center">
                                    <h6 class="mb-0 fw-semibold text-truncate">Sales Pitch - PPTX</h6>
                                    <p class="text-muted mb-0 fs-12">Uploaded 7 days ago</p>
                                </div>
                            </div>
                        </div>

                        <!-- File 7: Text Document -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-20 border border-light shadow-none card-h-100">
                                <!-- Add Favorite -->
                                <div class="position-absolute start-0 p-3">
                                    <div class="custom-toggle text-warning fs-12 d-flex align-items-center cursor-pointer"
                                        role="button" aria-label="Toggle Favorite">
                                        <span class="icon-on" aria-hidden="true"><i class="bi bi-star-fill"></i></span>
                                        <span class="icon-off" aria-hidden="true"><i class="bi bi-star"></i></span>
                                    </div>
                                </div>
                                <div class="position-absolute end-0 p-2">
                                    <!-- File Action Dropdown -->
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="More options">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                            <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                data-bs-target="#shareFileModal"><i class="bi-share"></i> Share File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i> Move
                                                to Folder</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                File</a>
                                            <a class="dropdown-item" href="#!"><i class="bi-download"></i> Download
                                                File</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                    class="bi-trash"></i> Delete File</a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="card-body d-flex justify-content-center align-items-center p-0 overflow-hidden min-h-112px">
                                    <i class="bi bi-file-earmark-text ms-2 fs-32 text-primary-emphasis"></i>
                                </div>
                                <hr class="m-0 mx-3">
                                <div class="card-footer bg-transparent border-0 p-3 text-center">
                                    <h6 class="mb-0 fw-semibold text-truncate">Meeting Notes - TXT</h6>
                                    <p class="text-muted mb-0 fs-12">Uploaded 6 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Folders Section -->
                    <div class="my-4">
                        <h6 class="fw-semibold">Folders</h6>
                    </div>

                    <div class="row g-4">
                        <!-- Folder 1: Design Assets -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-40 border border-light shadow-none h-100 mb-0">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi-folder fs-4 text-body"></i>
                                        <div class="overflow-hidden">
                                            <h6 class="text-truncate mb-0">Design Assets</h6>
                                            <p class="text-muted fs-12 text-truncate mb-0">45 files</p>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <button type="button"
                                                class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                aria-label="More options">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#shareFileModal"><i class="bi-share"></i> Share
                                                    Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Move Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-star"></i> Add to
                                                    Favorites</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                    Folder</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                        class="bi-trash"></i> Delete Folder</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Folder 2: Marketing Campaign -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-40 border border-light shadow-none h-100 mb-0">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi-folder fs-4 text-body"></i>
                                        <div class="overflow-hidden">
                                            <h6 class="text-truncate mb-0">Marketing Campaign</h6>
                                            <p class="text-muted fs-12 text-truncate mb-0">28 files</p>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <button type="button"
                                                class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                aria-label="More options">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#shareFileModal"><i class="bi-share"></i> Share
                                                    Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Move Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-star"></i> Add to
                                                    Favorites</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                    Folder</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                        class="bi-trash"></i> Delete Folder</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Folder 3: Documents -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-40 border border-light shadow-none h-100 mb-0">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi-folder fs-4 text-body"></i>
                                        <div class="overflow-hidden">
                                            <h6 class="text-truncate mb-0">Documents</h6>
                                            <p class="text-muted fs-12 text-truncate mb-0">120 files</p>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <button type="button"
                                                class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                aria-label="More options">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#shareFileModal"><i class="bi-share"></i> Share
                                                    Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Move Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-star"></i> Add to
                                                    Favorites</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                    Folder</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                        class="bi-trash"></i> Delete Folder</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Folder 4: Images -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-40 border border-light shadow-none h-100 mb-0">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi-folder fs-4 text-body"></i>
                                        <div class="overflow-hidden">
                                            <h6 class="text-truncate mb-0">Images</h6>
                                            <p class="text-muted fs-12 text-truncate mb-0">92 files</p>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <button type="button"
                                                class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                aria-label="More options">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#shareFileModal"><i class="bi-share"></i> Share
                                                    Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Move Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-star"></i> Add to
                                                    Favorites</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                    Folder</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                        class="bi-trash"></i> Delete Folder</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Folder 5: Videos -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-40 border border-light shadow-none h-100 mb-0">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi-folder fs-4 text-body"></i>
                                        <div class="overflow-hidden">
                                            <h6 class="text-truncate mb-0">Videos</h6>
                                            <p class="text-muted fs-12 text-truncate mb-0">30 files</p>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <button type="button"
                                                class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                aria-label="More options">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#shareFileModal"><i class="bi-share"></i> Share
                                                    Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Move Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-star"></i> Add to
                                                    Favorites</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                    Folder</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                        class="bi-trash"></i> Delete Folder</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Folder 6: Archive -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-40 border border-light shadow-none h-100 mb-0">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi-folder fs-4 text-body"></i>
                                        <div class="overflow-hidden">
                                            <h6 class="text-truncate mb-0">Archive</h6>
                                            <p class="text-muted fs-12 text-truncate mb-0">15 files</p>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <button type="button"
                                                class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                aria-label="More options">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#shareFileModal"><i class="bi-share"></i> Share
                                                    Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Move Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-star"></i> Add to
                                                    Favorites</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                    Folder</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                        class="bi-trash"></i> Delete Folder</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Folder 7: Templates -->
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 delete-element">
                            <div class="card bg-light bg-opacity-40 border border-light shadow-none h-100 mb-0">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi-folder fs-4 text-body"></i>
                                        <div class="overflow-hidden">
                                            <h6 class="text-truncate mb-0">Templates</h6>
                                            <p class="text-muted fs-12 text-truncate mb-0">58 files</p>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <button type="button"
                                                class="btn btn-text-light icon-btn-sm rounded-circle text-muted"
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                aria-label="More options">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end min-w-176px">
                                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#shareFileModal"><i class="bi-share"></i> Share
                                                    Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-folder-plus"></i>
                                                    Move Folder</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-star"></i> Add to
                                                    Favorites</a>
                                                <a class="dropdown-item" href="#!"><i class="bi-pencil"></i> Rename
                                                    Folder</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-item delete-btn" href="#!"><i
                                                        class="bi-trash"></i> Delete Folder</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-0">
                <table class="dt-invoice-list table align-middle w-100 table-nowrap">
                    <thead class="bg-light bg-opacity-30">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>File Type</th>
                            <th>File Size</th>
                            <th class="text-truncate">Last Modified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal for File Upload -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Add Files</h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="card bg-light position-relative">
                            <div
                                class="card-body p-12 border border-light rounded d-flex flex-column align-items-center gap-2 text-center z-1">
                                <img class="mx-auto img-fluid w-200px"
                                    src="{{ asset('assets/images/upload-file.png') }}">" alt="File Upload">
                                <h6 class="fw-semibold mb-0 mt-2">Drag and drop your file here</h6>
                                <p class="text-muted fs-sm mb-0">or</p>
                                <span
                                    class="btn btn-white btn-light-primary btn-sm fw-medium d-flex align-items-center gap-2">
                                    <i class="ri-upload-2-line fs-14"></i>
                                    Browse files
                                </span>
                            </div>
                            <input class="form-control h-100 w-100 position-absolute z-2 opacity-0" type="file"
                                id="fileInput0">
                        </div>
                    </form>
                </div>
                <div class="modal-footer footer-btn">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="uploadFilesButton">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Share Folder Modal -->
    <div class="modal fade" id="shareFileModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shareModalLabel">Share Folder</h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Share this folder with others and assign roles.</p>

                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email addresses</label>
                        <select id="emailInput" class="form-control" multiple>
                            <option value="john.doe@example.com">john.doe@example.com</option>
                            <option value="mary.jane@example.com">mary.jane@example.com</option>
                            <option value="alice.smith@example.com">alice.smith@example.com</option>
                            <option value="bob.jones@example.com">bob.jones@example.com</option>
                            <option value="lucy.lee@example.com">lucy.lee@example.com</option>
                        </select>
                        <div class="form-text">Select users from the dropdown or add new emails.</div>
                    </div>

                    <div class="mb-3">
                        <label for="roleSelect" class="form-label">Select Access Role</label>
                        <select class="form-select" id="roleSelect">
                            <option value="view">View Only</option>
                            <option value="edit">Edit</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <h6>Sharing Settings</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="allowEditing">
                            <label class="form-check-label" for="allowEditing">
                                Allow editing
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="allowComments">
                            <label class="form-check-label" for="allowComments">
                                Allow comments
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="shareLink" class="form-label">Shareable Link</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="https://example.com/folder/my-documents"
                                id="shareLink" readonly>
                            <button class="btn btn-outline-secondary" type="button">Copy Link</button>
                        </div>
                        <p class="mt-2 text-muted">You can also share this link with others.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Share</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Folder Modal -->
    <div class="modal fade" id="create-folder" tabindex="-1" aria-labelledby="CreateFolderLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateFolderLabel">
                        Create Folder
                    </h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="form-label" for="folder_name">Folder Name</label>
                    <input type="text" id="folder_name" placeholder="Folder Name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create File Modal -->
    <div class="modal fade" id="create-file" tabindex="-1" aria-labelledby="CreateFileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateFileLabel">
                        Create File
                    </h5>
                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="form-label" for="file_name">File Name</label>
                    <input type="text" id="file_name" placeholder="File Name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Dropzone js -->
    <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

    <!-- File Manager init -->
    <script src="{{ asset('assets/js/apps/file-manager/apps-file-manager.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
