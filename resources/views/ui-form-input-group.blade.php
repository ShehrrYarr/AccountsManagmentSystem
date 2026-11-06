@extends('partials.layouts.master2')

    @section('title', 'UI Columns | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Input Group' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')


    <div class="row g-4">

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Input Groups </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Input Groups</strong> example demonstrates how to use the <code>.input-group</code> class to combine text inputs with icons, buttons, or other elements for a seamless user experience.
                    </p>

                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <select class="form-select" id="inputGroupSelect02">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label class="input-group-text" for="inputGroupSelect02">Options</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <button class="btn btn-primary" type="button">Button</button>
                                <select class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <button class="btn btn-primary" type="button">Button</button>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="text" id="basic-addon1" name="basic-addon1" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="basic-addon2" name="basic-addon2" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">@example.com</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" id="basic-addon3" name="basic-addon3" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="basic-addon4" name="basic-addon4" placeholder="Username" aria-label="Username">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="basic-addon5" name="basic-addon5" placeholder="Server" aria-label="Server">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text">With textarea</span>
                                <textarea class="form-control" id="basic-addon6" name="basic-addon6" aria-label="With textarea" spellcheck="false"></textarea>
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
                    <h5 class="card-title mb-0"> Buttons, Checkboxs and Radios Group </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Input Groups</strong> example demonstrates how to use the <code>.input-group</code> class to combine buttons, checkboxes, and radio inputs with form controls for a seamless user experience.
                    </p>

                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="checkbox" id="form-input11" name="form-input11" value="form-input11" aria-label="Checkbox for following text input">
                                </div>
                                <input type="text" class="form-control" id="form-input01" name="form-input01" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" value="form-input12" id="form-input12" name="form-input12" aria-label="Radio button for following text input">
                                </div>
                                <input type="text" class="form-control" id="form-input02" name="form-input02" aria-label="Text input with radio button">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <button class="btn btn-light" type="button" id="button-addon1">Button</button>
                                <input type="text" class="form-control" id="form-input03" name="form-input03" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Recipient's username" id="form-input13" name="form-input13" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-light" type="button" id="button-addon2" name="button-addon2">Button</button>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <button class="btn btn-primary" type="button">Button</button>
                                <button class="btn btn-light" type="button">Button</button>
                                <input type="text" class="form-control" id="form-input04" name="form-input04" placeholder="" aria-label="Example text with two button addons">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="form-input05" name="form-input05" placeholder="Recipient's username" aria-label="Recipient's username with two button addons">
                                <button class="btn btn-primary" type="button">Button</button>
                                <button class="btn btn-light" type="button">Button</button>
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
                    <h5 class="card-title mb-0"> Buttons with dropdowns </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Buttons with Dropdowns</strong> example shows how to use the <code>.dropdown-toggle</code> class to create a button that toggles a dropdown menu for quick actions.
                    </p>

                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#!">Action</a></li>
                                    <li><a class="dropdown-item" href="#!">Another action</a></li>
                                    <li><a class="dropdown-item" href="#!">Something else here</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#!">Separated link</a></li>
                                </ul>
                                <input type="text" class="form-control" id="form-input15" name="form-input15" aria-label="Text input with dropdown button">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="form-input17" name="form-input17" aria-label="Text input with dropdown button">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#!">Action</a></li>
                                    <li><a class="dropdown-item" href="#!">Another action</a></li>
                                    <li><a class="dropdown-item" href="#!">Something else here</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#!">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#!">Action before</a></li>
                                    <li><a class="dropdown-item" href="#!">Another action before</a></li>
                                    <li><a class="dropdown-item" href="#!">Something else here</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#!">Separated link</a></li>
                                </ul>
                                <input type="text" class="form-control" id="form-input16" name="form-input16" aria-label="Text input with 2 dropdown buttons">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#!">Action</a></li>
                                    <li><a class="dropdown-item" href="#!">Another action</a></li>
                                    <li><a class="dropdown-item" href="#!">Something else here</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#!">Separated link</a></li>
                                </ul>
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
                    <h5 class="card-title mb-0"> Custom select </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Custom Select</strong> example demonstrates how to use the <code>.input-group</code> class to combine a button with a custom select dropdown for seamless user interaction.
                    </p>

                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect05">Options</label>
                                <select class="form-select" id="inputGroupSelect05">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <select class="form-select" id="inputGroupSelect06">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label class="input-group-text" for="inputGroupSelect06">Options</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <button class="btn btn-outline-primary" type="button">Button</button>
                                <select class="form-select" id="inputGroupSelect07" aria-label="Example select with button addon">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <select class="form-select" id="inputGroupSelect08" aria-label="Example select with button addon">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <button class="btn btn-outline-primary" type="button">Button</button>
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
                    <h5 class="card-title mb-0"> Custom file input </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Custom File Input</strong> example showcases how to use the <code>.form-control</code> class to create a styled file upload input with a clean and user-friendly design.
                    </p>

                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                <input type="file" class="form-control" id="inputGroupFile01">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <input type="file" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon03">Button</button>
                                <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                <button class="btn btn-outline-primary" type="button" id="inputGroupFileAddon04">Button</button>
                            </div>
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
