@extends('partials.layouts.master')

@section('title', 'Products Category List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Category List')
@section('pagetitle', 'Ecommerce')
@section('buttonTitle', 'Add Category')
@section('modalTarget', 'addCategoryModal')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

@section('content')
    <div class="card mb-0">
        <table class="dt-category-list align-middle table text-nowrap w-100">
            <thead class="bg-light bg-opacity-30">
                <tr>
                    <th class="px-5"></th>
                    <th>Category Name</th>
                    <th class="text-truncate">Total Product</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Add Category Modal -->
    <div class="modal modal-lg fade" id="addCategoryModal" tabindex="0" aria-labelledby="breadcrumbModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="breadcrumbModalLabel">Add Category</h1>
                    <button type="button" class="btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ri-close-large-line fw-semibold"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label" for="category-name">Category Name<span
                                        class="text-danger fw-semibold ps-1">*</span></label>
                                <input type="text" class="form-control" id="category-name" name="category-name"
                                    placeholder="Category name">
                                <div class="form-text fs-12">A category name is required and recommended to be unique.</div>
                            </div>
                            <div>
                                <label class="form-label" for="category-slug">Category Slug<span
                                        class="text-danger fw-semibold ps-1">*</span></label>
                                <input type="text" class="form-control" id="category-slug" name="category-slug"
                                    placeholder="Category slug">
                                <div class="form-text fs-12">A category slug is required and recommended to be unique.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-5 mt-md-0">
                            <label class="form-label" for="category-thumbnail">Thumbnail</label>
                            <div class="position-relative">
                                <input class="form-control h-100 w-100 position-absolute z-2 opacity-0" type="file"
                                    id="category-thumbnail">
                                <div
                                    class="card-body p-sm-4 border border-light rounded d-flex flex-column align-items-center gap-2 text-center z-1">
                                    <img class="mx-auto img-fluid w-200px h-100px"
                                        src="{{ asset('assets/images/upload-file.png') }}">" alt="File Upload">
                                    <span class="text-muted fs-13">Set the category thumbnail image. Only *.png') }}">,
                                        *.jpg and *.jpeg image files are accepted</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Description</label>
                        <div class="min-h-128px"></div>
                        <div class="form-text fs-12">Set a description to the product for better visibility.</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label" for="category-status">Status<span
                                        class="text-danger fw-semibold ps-1">*</span></label>
                                <select id="category-status">
                                    <option value="draft" selected>Draft</option>
                                    <option value="published">Published</option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 scheduled-input">
                            <label class="form-label" for="publishing-date">Select publishing date and time</label>
                            <input type="text" class="form-control" id="publishing-date" placeholder="Pick date & time">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Datatable js -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js'"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- Editor js -->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Cleave js -->
    <script src="{{ asset('assets/libs/cleave.js/cleave.min.js') }}"></script>

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- Product create init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-product-category-list.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
