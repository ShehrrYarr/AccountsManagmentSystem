@extends('partials.layouts.master2')

    @section('title', 'UI Counter | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'File Upload' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')  
<link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
@endsection

    @section('content')

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic File Upload</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Basic File Upload</strong> allows users to select and upload files easily.
                        Use the <code>.form-control</code> class with <code>type="file"</code> for a simple file input.
                    </p>

                    <div>
                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">File Upload with Button</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">File Upload with Button & Icons</strong> enhances the file input with a button and an icon for better user experience.
                        Use <code>.btn</code> with an <code>input type="file"</code> and add icons for a stylish look.
                    </p>

                    <div class="d-flex flex-wrap gap-3 align-items-center mb-5">
                        <div class="file-upload">
                            <button type="button" class="btn btn-primary">
                                <i class="ri-upload-2-line me-2"></i>
                                Choose File
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-1">
                        </div>
                        <div class="file-upload">
                            <button type="button" class="btn btn-success">
                                Choose File
                                <i class="ri-upload-2-line ms-2"></i>
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-2">
                        </div>
                        <div class="file-upload">
                            <button type="button" class="btn btn-outline-primary">
                                Choose File
                                <i class="ri-upload-2-line ms-2"></i>
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-3">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3 align-items-center mb-5">
                        <div class="file-upload">
                            <button type="button" class="btn btn-light-primary rounded-pill icon-btn">
                                <i class="ri-upload-2-line"></i>
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-4">
                        </div>
                        <div class="file-upload">
                            <button type="button" class="btn btn-outline-danger rounded-pill icon-btn">
                                <i class="ri-upload-2-line"></i>
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-5">
                        </div>
                        <div class="file-upload">
                            <button type="button" class="btn btn-primary rounded-pill icon-btn">
                                <i class="ri-upload-2-line"></i>
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-6">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <div class="file-upload">
                            <button type="button" class="btn btn-outline-primary rounded-pill icon-btn-lg">
                                <i class="ri-upload-2-line"></i>
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-7">
                        </div>
                        <div class="file-upload">
                            <button type="button" class="btn btn-outline-primary rounded-pill icon-btn">
                                <i class="ri-upload-2-line"></i>
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-8">
                        </div>
                        <div class="file-upload">
                            <button type="button" class="btn btn-outline-primary rounded-pill icon-btn-sm">
                                <i class="ri-upload-2-line"></i>
                            </button>
                            <input class="file-upload-item" type="file" name="file-upload" id="file-upload-9">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Avatar uploader 1</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Basic Upload Image</strong> allows users to select and upload an image easily.
                        Use <code>input type="file"</code> to enable image selection.
                    </p>

                    <div class="d-flex align-items-center flex-wrap gap-3" data-uploader>
                        <div class="avatar-item avatar-xl">
                            <img class="img-fluid avatar-xl" alt="avatar image" data-default-src="{{ asset('assets/images/avatar/dummy-avatar-2.jpg') }}" data-action="avatar-image">
                        </div>

                        <div class="file-upload">
                            <button type="button" class="btn btn-primary" data-action="choose-file">
                                Choose File
                            </button>
                            <input class="file-upload-item" type="file" accept="image/*" data-action="file-input">
                        </div>

                        <button class="btn btn-outline-primary" data-action="delete-image">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Avatar uploader 2</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Basic Upload Image</strong> uses Dropzone to provide a drag-and-drop interface for image uploads.
                        Simply drag an image or click to select a file.
                    </p>

                    <!-- Demo Editor Dropzone -->
                    <div id="demo-editor" class="dropzone">
                        <div class="fallback">
                            <input name="file" type="file" multiple="multiple">
                        </div>
                        <div class="dz-message needsclick text-center">
                            <div class="mb-3">
                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                            </div>
                            <h5>Drop files here or click to upload.</h5>
                        </div>
                    </div>

                    <!-- File Previews -->
                    <ul class="list-unstyled mb-0 mt-3" id="dropzone-preview">
                        <li class="mt-2" id="dropzone-preview-list" style="display: none;">
                            <div class="col-12 mb-4">
                                <div class="dz-preview dz-file-preview border p-2 rounded d-flex flex-column gap-2">
                                    <div class="dz-details d-flex gap-2">
                                        <div class="dz-img flex-shrink-0"><img class="img-fluid border object-fit-cover dz-img-inner avatar-lg rounded" data-dz-thumbnail alt="Product-Image"></div>
                                        <div class="dz-file-wrapper flex-grow-1 d-flex flex-column justify-content-center">
                                            <h5 class="fs-13 mb-1" data-dz-name></h5>
                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                        </div>
                                        <div class="dz-img flex-shrink-0">
                                            <button type="button" class="btn btn-text-danger icon-btn-sm" data-dz-remove><i class="ri-close-line fs-16 fw-semibold"></i></button>
                                        </div>
                                    </div>
                                    <div class="dz-progress progress progress-xs">
                                        <div class="dz-upload progress-bar bg-success h-100" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                                    </div>
                                    <div class="align-items-center dz-error-container">
                                        <div class="dz-error-message"><small class="text-danger" data-dz-errormessage></small></div>
                                    </div>
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

    <!-- Dropzone js -->
    <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

    <!-- File-upload init -->
    <script src="{{ asset('assets/js/form/file-upload.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
