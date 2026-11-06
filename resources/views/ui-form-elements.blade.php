@extends('partials.layouts.master2')

    @section('title', 'UI Columns | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Basic Input' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')  
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

    @section('content')


    <div class="row g-4">

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Basic Input Text </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Basic Input Text</strong> example display how to use the <code>.form-control</code> class to create a well-styled, responsive text input field for seamless user interaction.
                    </p>
                    <input type="text" placeholder="Username" class="form-control" id="inputExample01">
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Disabled Text Input </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Disabled Text Input</strong> example shows how to use the <code>disabled</code> attribute with the <code>.form-control</code> class to create a non-editable input field.
                    </p>
                    <input type="text" placeholder="Username" class="form-control" id="inputExample02" disabled>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Label Input </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Label Input</strong> example demonstrates how to associate a <code>&lt;label&gt;</code> with an input field for better accessibility and user experience.
                    </p>
                    <label for="inputExample03" class="form-label">Username</label>
                    <input type="text" placeholder="Enter Your Name" class="form-control" id="inputExample03">
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Label Input Required </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Label Input Required</strong> example shows how to use the <code>required</code> attribute with a <code>&lt;label&gt;</code> to indicate a mandatory input field for better form validation.
                    </p>
                    <label for="inputExample04" class="form-label">Name<span class="text-danger ms-1">*</span></label>
                    <input type="text" placeholder="Enter Your Name" class="form-control" id="inputExample04" required>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Read Only </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Read-Only Input</strong> example demonstrates how to use the <code>readonly</code> attribute to create an input field that cannot be edited but remains selectable.
                    </p>
                    <input type="text" placeholder="You can read only me" class="form-control" id="inputExample05" readonly>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Input With Button </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Input with Button</strong> example shows how to combine an input field with a button using Bootstrap’s input group for better functionality and styling.
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <input type="text" placeholder="Enter Your Name" class="form-control" id="inputExample06">
                        <button class="btn btn-primary">Subscribe</button>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Input With Helper Text </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Input with Helper Text</strong> example demonstrates how to add a small guiding text below an input field using Bootstrap to assist users with input requirements.  
                    </p>  
                    <input type="text" placeholder="Username" class="form-control" id="inputExample07" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">With Error Message</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">With Error Message</strong> example demonstrates the use of the <code>.is-invalid</code> class to highlight an input field with a red border and display an error message below it.  
                    </p>
                    <label for="inputExample08" class="form-label is-invalid">Username</label>
                    <input type="text" class="form-control is-invalid" id="inputExample08" placeholder="Username" required>
                    <div class="invalid-feedback">
                        Please provide a valid username.
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Input With Helper Text</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">You have the option to include <code>supportive text</code> either below or above the input field.</p>
                    <input type="text" class="form-control" id="inputExample09" placeholder="Username">
                    <div id="inputExample09" class="form-text">We’ll never share your details. Read our <a href="#!">Privacy Policy</a> </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Input Size and Radius</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Input Size and Radius</strong> example showcases how to use <code>.form-control-sm</code> and <code>.form-control-lg</code> for different input sizes, along with <code>.rounded</code> classes to adjust the border radius.  
                    </p>  
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="vstack gap-3">
                                <input type="text" class="form-control form-control-sm" id="inputExample10" placeholder="Username">
                                <input type="text" class="form-control" id="inputExample11" placeholder="Username">
                                <input type="text" class="form-control form-control-lg" id="inputExample12" placeholder="Username">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="vstack gap-3">
                                <input type="text" class="form-control rounded-0" id="inputExample13" placeholder="Username">
                                <input type="text" class="form-control rounded-1" id="inputExample14" placeholder="Username">
                                <input type="text" class="form-control rounded-4" id="inputExample15" placeholder="Username">
                                <input type="text" class="form-control rounded-5" id="inputExample16" placeholder="Username">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Colors</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Input Color Variant</strong> example shows how to style input fields using the <code>.form-control-*</code> class, allowing customization with different color themes for better visual distinction.
                    </p>
                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control" id="inputExample17" placeholder="Default">
                        </div>
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control form-control-primary" id="inputExample18" placeholder="Primary">
                        </div>
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control form-control-secondary" id="inputExample19" placeholder="Secondary">
                        </div>
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control form-control-success" id="inputExample20" placeholder="Success">
                        </div>
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control form-control-info" id="inputExample21" placeholder="Info">
                        </div>
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control form-control-warning" id="inputExample22" placeholder="Warning">
                        </div>
                        <div class="col-12 col-lg-6">
                            <input type="text" class="form-control form-control-danger" id="inputExample23" placeholder="Danger">
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Type Variant</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Type Variant</strong> example showcases different input types using the <code>.form-control</code> class, including <code>date</code>, <code>time</code>, <code>email</code>, <code>password</code>, and more. These variants help users enter specific data formats with ease. 
                    </p>
                    <div class="row gy-4">
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample26" class="form-label">Input with Icon</label>
                            <div class="form-icon">
                                <input type="email" class="form-control form-control-icon" id="inputExample26" placeholder="example@gmail.com">
                                <i class="ri-mail-unread-line"></i>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample27" class="form-label">Input with Icon Right</label>
                            <div class="form-icon right">
                                <input type="email" class="form-control form-control-icon" id="inputExample27" placeholder="example@gmail.com">
                                <i class="ri-mail-unread-line"></i>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample28" class="form-label">Input Date</label>
                            <input type="date" class="form-control" id="inputExample28">
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample29" class="form-label">Input Time</label>
                            <input type="time" class="form-control" id="inputExample29">
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample30" class="form-label">Color Picker</label>
                            <input type="color" class="form-control form-control-color w-100" value="#007bff" title="Choose your color" id="inputExample30">
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample31" class="form-label">Country Selector</label>
                            <input list="datalistOptions" class="form-control" placeholder="Search your country..." id="inputExample31">
                            <datalist id="datalistOptions">
                                <option value="United States">
                                <option value="Canada">
                                <option value="United Kingdom">
                                <option value="Australia">
                                <option value="Germany">
                                <option value="France">
                                <option value="Italy">
                                <option value="Spain">
                            </datalist>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample32" class="form-label">Textarea</label>
                            <textarea class="form-control" id="inputExample32" rows="1"></textarea>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample33" class="form-label">Plain Text</label>
                            <input type="text" readonly class="form-control-plaintext" id="inputExample33" value="email@example.com">
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <label for="inputExample34" class="form-label">Type Search</label>
                            <input type="search" class="form-control" id="inputExample34" placeholder="Search">
                        </div>

                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic File Upload</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Basic File Upload</strong> example demonstrates how to use the <code>.form-control</code> class with <code>type="file"</code> to create a simple and responsive file input field for uploading files. 
                    </p>
                    <div class="row gy-4">
                        <div class="col-12 col-lg-6">
                            <label for="inputExample35" class="form-label">Default file input example</label>
                            <input class="form-control" type="file" id="inputExample35">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="inputExample36" class="form-label">Multiple files input example</label>
                            <input class="form-control" type="file" id="inputExample36" multiple>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="inputExample37" class="form-label">Disabled file input example</label>
                            <input class="form-control" type="file" id="inputExample37" disabled>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="inputExample38" class="form-label">Small file input example</label>
                            <input class="form-control form-control-sm" id="inputExample38" type="file">
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>


    </div>
@endsection

@section('js')
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection