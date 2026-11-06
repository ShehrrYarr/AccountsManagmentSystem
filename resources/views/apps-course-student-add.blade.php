@extends('partials.layouts.master3')

@section('title', 'Add Course Teacher | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Add Student')
@section('pagetitle', 'Dashboard')
@section('buttonTitle', 'All Student')
@section('link', 'apps-course-student-list')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add Student</h5>
        </div>
        <div class="card-body">
            <form class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
                        <div class="avatar-item avatar-xl overflow-hidden">
                            <img class="img-fluid" alt="avatar image"
                                src="{{ asset('assets/images/avatar/avatar-1.jpg') }}">
                        </div>
                        <div>
                            <div class="hstack gap-3 mb-2">
                                <button class="btn btn-sm btn-light-primary">Upload</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </div>
                            <p class="mb-0 text-muted fs-12">Upload image size 4MB, Format JPG, PNG, SVG</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="fname">First Name:</label>
                        <input class="form-control" name="first name" id="fname" type="text"
                            placeholder="Enter your first name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="lname">Last Name:</label>
                        <input class="form-control" name="last name" id="lname" type="text"
                            placeholder="Enter your last name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="email">Email:</label>
                        <input class="form-control" name="email" id="email" type="email"
                            placeholder="Enter your email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="phone-number">Phone Number:</label>
                        <input type="number" class="form-control" id="phone-number" placeholder="Enter your number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="joining-date">Joining Date:</label>
                        <input type="text" class="form-control" id="joining-date" placeholder="Joining Date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="date-of-birth">Date of Birth:</label>
                        <input type="text" class="form-control" id="date-of-birth"
                            placeholder="Enter your date of birth">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="select-gender">Gender:</label>
                        <select id="select-gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="selectStatus">Status:</label>
                        <select id="selectStatus">
                            <option value="Active">Active</option>
                            <option value="In Active">In Active</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Password</h5>
        </div>
        <div class="card-body">
            <form class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="password">Password<span class="text-danger ms-1">*</span></label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" value="123456" name="password"
                                placeholder="Enter your password" data-visible="false">
                            <a class="input-group-text bg-transparent toggle-password" href="#!"
                                data-target="password">
                                <i class="text-muted toggle-icon ri-eye-off-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="confirm-password">Confirm Password<span
                                class="text-danger ms-1">*</span></label>
                        <div class="input-group">
                            <input type="password" id="confirm-password" class="form-control" value="123456"
                                name="password" placeholder="Enter your confirm password" data-visible="false">
                            <a class="input-group-text bg-transparent toggle-password" href="#!"
                                data-target="password">
                                <i class="text-muted toggle-icon ri-eye-off-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Social Media Links</h5>
        </div>
        <div class="card-body">
            <form class="row">
                <div class="row rows-cols-xxl-5">
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Twitter URL</label>
                            <input type="text" name="social links" class="form-control"
                                placeholder="Link your twitter">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Github</label>
                            <input type="text" name="social links" class="form-control"
                                placeholder="Link your github">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Linked In</label>
                            <input type="text" name="social links" class="form-control"
                                placeholder="Link your linked in">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Dribbble</label>
                            <input type="text" name="social links" class="form-control"
                                placeholder="Link your dribbble">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <button class="btn btn-primary" type="button">Add Student</button>
        <input class="btn btn-light" type="button" value="Cancel">
    </div>
@endsection

@section('js')

    <!-- Tagify js -->
    <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- Dropzone js -->
    <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

    <!-- Editor js -->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Blog js -->
    <script src="{{ asset('assets/js/apps/course/apps-course-student-add.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
