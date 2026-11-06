@extends('partials.layouts.master2')

    @section('title', 'UI Paginations | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Pagination' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
    @section('content')

    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Pagination</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <code>pagination-*</code> class to ul element to indicate a series of related content exists across multiple pages.</p>

                    <div class="d-flex flex-column gap-2">
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-primary mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-success mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-light mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Disabled Pagination</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <code>disabled</code> class to ul element to indicate a series of related content exists across multiple pages.</p>

                    <div class="d-flex flex-column gap-2">
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-primary mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item disabled"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Subtle Pagination</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <code>pagination-*-light</code> class to ul element to indicate a series of related content exists across multiple pages.</p>

                    <div class="d-flex flex-column gap-2">
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-primary-light mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-success-light mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-light-light mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Rounded Pagination</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <code>.pagination-rounded</code> class to ul element to indicate a series of related content exists across multiple pages.</p>

                    <div class="d-flex flex-column gap-2">
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-rounded pagination-primary mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-rounded pagination-success mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-rounded pagination-light mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Rounded Pagination light</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <code>.pagination-rounded</code> class to ul element to indicate a series of related content exists across multiple pages.</p>

                    <div class="d-flex flex-column gap-2">
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-rounded pagination-primary-light mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-rounded pagination-success-light mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-rounded pagination-light-light mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Pagination Sizes</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <code>.pagination-sm</code> class to ul element to indicate a series of related content exists across multiple pages.</p>

                    <div class="d-flex flex-column align-items-center gap-2">
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-md mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg mb-0">
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-left-s-line fw-semibold"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">4</a></li>
                                <li class="page-item"><a class="page-link" href="#!">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#!">
                                        <i class="ri-arrow-right-s-line fw-semibold"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

    </div>

@endsection

@section('js')
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
 @endsection
