@extends('partials.layouts.master2')

    @section('title', 'List JS Tables | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Table List Js' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')


    @section('content')


    <div class="row g-4">

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Data Attributes + Custom </h5>
                </div>
                <div class="card-body">
                    <div id="users">
                        <div class="input-group">
                            <input class="search form-control" placeholder="Search">
                            <button class="sort btn btn-light-secondary" data-sort="name">
                                <i class="ri-search-2-line"></i>
                            </button>
                        </div>
                        <ul class="list-group list fs-13 fw-medium mt-3">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="border-0 avatar-item avatar" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                    <div>
                                        <p class="m-0 name fw-semibold" data-name="Jonny Stromberg">Jonny Stromberg</p>
                                        <p class="m-0 email text-muted" data-email="jonny@example.com">jonny@example.com</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="border-0 avatar-item avatar" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
                                    <div>
                                        <p class="m-0 name fw-semibold" data-name="Jonas Arnklint">Jonas Arnklint</p>
                                        <p class="m-0 email text-muted" data-email="jonas@example.com">jonas@example.com</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="border-0 avatar-item avatar" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
                                    <div>
                                        <p class="m-0 name fw-semibold" data-name="Martina Elm">Martina Elm</p>
                                        <p class="m-0 email text-muted" data-email="martina@example.com">martina@example.com</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-2">
                                    <img class="border-0 avatar-item avatar" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="avatar image">
                                    <div>
                                        <p class="m-0 name fw-semibold" data-name="Gustaf Lindqvist">Gustaf Lindqvist</p>
                                        <p class="m-0 email text-muted" data-email="gustaf@example.com">gustaf@example.com</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-group list no-results" style="display: none;">
                            <li class="list-group-item text-muted">No data found</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Search by Class Name </h5>
                </div>
                <div class="card-body">
                    <div id="pagination-list">
                        <div class="input-group">
                            <input class="search form-control" placeholder="Search">
                            <button class="sort btn btn-light-secondary" data-sort="name">
                                <i class="ri-search-2-line"></i>
                            </button>
                        </div>
                        <ul class="list-group list fs-13 fw-medium mt-3">
                            <li class="list-group-item">
                                <p class="name mb-0">Guybrush Threepwood</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Elaine Marley</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">LeChuck</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Stan</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Voodoo Lady</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Herman Toothrot</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Meathook</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Carla</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Otis</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Rapp Scallion</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Rum Rogers Sr.</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Men of Low Moral Fiber</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Murray</p>
                            </li>
                            <li class="list-group-item">
                                <p class="name mb-0">Cannibals</p>
                            </li>
                        </ul>
                        <ul class="pagination listjs-pagination"></ul>
                        <ul class="list-group list no-results" style="display: none;">
                            <li class="list-group-item text-muted">No data found</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Sort by Name </h5>
                </div>
                <div class="card-body">
                    <div id="nodataList">
                        <div class="input-group">
                            <input class="search form-control" placeholder="Search">
                            <button class="sort btn btn-primary" data-sort="name">
                                Sort by name
                            </button>
                        </div>
                        <ul class="list-group list fs-13 fw-medium mt-3"></ul>
                        <ul class="list-group list no-results" style="display: none;">
                            <li class="list-group-item text-muted">No data found</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-0" id="contacts">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-between gap-3 flex-wrap">
                        <h5 class="card-title mb-0">List JS Table</h5>
                        <!-- Search Input -->
                        <input type="text" class="form-control max-w-300px" placeholder="Search contact" id="search-input">
                        <button class="btn btn-primary" id="add-btn">Add Contact</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th class="sort">id</th>
                                <th class="sort" data-sort="name">Name</th>
                                <th class="sort" data-sort="age">Age</th>
                                <th class="sort" data-sort="city">City</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <!-- Example contact rows -->
                            <tr>
                                <td class="id">1</td>
                                <td class="name">Jonny</td>
                                <td class="age">27</td>
                                <td class="city">Stockholm</td>
                                <td class="w-200px">
                                    <div class="hstack justify-content-center">
                                        <button class="btn btn-warning btn-sm edit-item-btn">Edit</button>
                                        <button class="btn btn-danger btn-sm ms-2 remove-item-btn">Remove</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="id">2</td>
                                <td class="name">Jonas</td>
                                <td class="age">-132</td>
                                <td class="city">Berlin</td>
                                <td class="w-200px">
                                    <div class="hstack justify-content-center">
                                        <button class="btn btn-warning btn-sm edit-item-btn">Edit</button>
                                        <button class="btn btn-danger btn-sm ms-2 remove-item-btn">Remove</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="id">3</td>
                                <td class="name">Gustaf</td>
                                <td class="age">-23</td>
                                <td class="city">Sundsvall</td>
                                <td class="w-200px">
                                    <div class="hstack justify-content-center">
                                        <button class="btn btn-warning btn-sm edit-item-btn">Edit</button>
                                        <button class="btn btn-danger btn-sm ms-2 remove-item-btn">Remove</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="id">4</td>
                                <td class="name">Fredrik</td>
                                <td class="age">26</td>
                                <td class="city">Goteborg</td>
                                <td class="w-200px">
                                    <div class="hstack justify-content-center">
                                        <button class="btn btn-warning btn-sm edit-item-btn">Edit</button>
                                        <button class="btn btn-danger btn-sm ms-2 remove-item-btn">Remove</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Add/Edit Modal -->
                <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="contactModalLabel">Add Contact</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="contact-form" novalidate>
                                    <div class="mb-3">
                                        <input type="hidden" id="id-field">
                                        <label for="name-field" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name-field" placeholder="Name" required>
                                        <div class="invalid-feedback">Please provide a name.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="age-field" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="age-field" placeholder="Age" required>
                                        <div class="invalid-feedback">Please provide an age.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="city-field" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city-field" placeholder="City" required>
                                        <div class="invalid-feedback">Please provide a city.</div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save-btn">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')

    <!-- List js -->
    <script src="{{ asset('assets/libs/list.js/list.min.js') }}"></script>

    <!-- Listjs init -->
    <script src="{{ asset('assets/js/plugins/listjs.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
