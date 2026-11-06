@extends('partials.layouts.master2')

    @section('title', 'UI Floating Labels | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Floating Input' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')  
<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
@endsection

    @section('content')


    <div class="row g-4">
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Floating Label</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Basic Floating Label</strong> uses the <code>.form-floating</code> class
                        to create a smooth floating effect for input labels, keeping the form clean and user-friendly.
                    </p>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Floating Label With Values</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Floating Label With Values</strong> keeps labels visible inside the input field,
                        even when users enter text, ensuring a clear and consistent form experience.
                    </p>

                    <form>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" value="test@example.com">
                            <label for="floatingInputValue">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingInputValue2" placeholder="Password" value="123456">
                            <label for="floatingInputValue2">Password</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Invalid Floating Label</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Invalid Floating Label</strong> highlights an input field with an error state using
                        the <code>.is-invalid</code> class, ensuring users can easily identify and correct mistakes.
                    </p>

                    <form>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control is-invalid" id="floatingInputInvalid" placeholder="name@example.com" value="test@example.com">
                            <label for="floatingInputInvalid">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control is-invalid" id="floatingInputInvalid2" placeholder="Password" value="123456">
                            <label for="floatingInputInvalid2">Password</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Readonly plaintext</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Readonly Plaintext</strong> displays input as plain text using
                        the <code>.form-control-plaintext</code> class, making it uneditable while keeping the default styling.
                    </p>

                    <div class="form-floating mb-3">
                        <input type="email" readonly class="form-control-plaintext" id="floatingEmptyPlaintextInput" placeholder="name@example.com">
                        <label for="floatingEmptyPlaintextInput">Empty input</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" readonly class="form-control-plaintext" id="floatingPlaintextInput" placeholder="name@example.com" value="name@example.com">
                        <label for="floatingPlaintextInput">Input with value</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Floating Textarea</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Floating Textarea</strong> uses the
                        <code>.form-floating</code> class to add a floating label to a textarea,
                        providing a clean and modern input field design.
                    </p>

                    <div class="form-floating">
                        <textarea class="form-control h-100px" placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Floating Select</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Floating Select</strong> example uses the
                        <code>.form-floating</code> class to create a floating label effect for a select dropdown,
                        offering a sleek and modern form design.
                    </p>

                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="floatingSelect">Works with selects</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Floating Input groups</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Floating Input Groups</strong> example shows how to use
                        <code>.form-floating</code> with input groups to create a modern floating label effect for form fields.
                    </p>

                    <div class="input-group mb-3">
                        <span class="input-group-text">@</span>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Username">
                            <label for="floatingInputGroup1">Username</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Floating Input groups sizing</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Floating Input Groups Sizing</strong> example demonstrates how to apply different sizes to floating input groups using the <code>.form-control-sm</code> and <code>.form-control-lg</code> classes for smaller and larger input fields.
                    </p>

                    <div class="floating-input mb-3">
                        <input type="email" class="form-control form-control-sm" id="floating-input-sm" placeholder="name@example.com">
                        <label for="floating-input-sm">Email address</label>
                    </div>
                    <div class="floating-input mb-3">
                        <input type="email" class="form-control" id="floating-input" placeholder="name@example.com">
                        <label for="floating-input">Email address</label>
                    </div>
                    <div class="floating-input mb-3">
                        <input type="email" class="form-control form-control-lg" id="floating-input-lg" placeholder="name@example.com">
                        <label for="floating-input-lg">Email address</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    
@endsection
