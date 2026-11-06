@extends('partials.layouts.master3')

@section('title', 'Products Detail | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Create Product')
@section('pagetitle', 'Ecommerce')
@section('buttonTitle', 'View all')
@section('link', 'apps-products')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection
@section('content')

    <div class="row g-4">
        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Product information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-5">
                        <label class="form-label" for="product-title">Product Name<span
                                class="text-danger fw-semibold ps-1">*</span></label>
                        <input type="text" class="form-control" id="product-title" name="product-title"
                            placeholder="Product name">
                        <div class="form-text fs-12">A product name is required and recommended to be unique.</div>
                    </div>
                    <div>
                        <label class="form-label">Description</label>
                        <div id="product-desc" class="min-h-200px"></div>
                        <div class="form-text fs-12">Set a description to the product for better visibility.</div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Media</h5>
                </div>
                <div class="card-body">
                    <!-- Product Editor Dropzone -->
                    <div id="product-editor" class="dropzone">
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
                    <div class="row g-3 mt-0" id="dropzone-preview">
                        <div id="dropzone-preview-list" style="display: none;">
                            <div class="col">
                                <div class="border p-2 rounded d-flex flex-column gap-2">
                                    <div class="dz-details d-flex gap-2">
                                        <div class="dz-img flex-shrink-0"><img
                                                class="img-fluid border object-fit-cover dz-img-inner avatar-lg rounded"
                                                data-dz-thumbnail alt="Product-Image"></div>
                                        <div class="dz-file-wrapper flex-grow-1 d-flex flex-column justify-content-center">
                                            <h5 class="fs-13 mb-1" data-dz-name></h5>
                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                        </div>
                                        <div class="dz-img flex-shrink-0">
                                            <button type="button" class="btn btn-text-danger icon-btn-sm" data-dz-remove><i
                                                    class="ri-close-line fs-16 fw-semibold"></i></button>
                                        </div>
                                    </div>
                                    <div class="dz-progress progress progress-xs">
                                        <div class="dz-upload progress-bar bg-success h-100" role="progressbar"
                                            style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                            data-dz-uploadprogress></div>
                                    </div>
                                    <div class="align-items-center dz-error-container">
                                        <div class="dz-error-message"><small class="text-danger"
                                                data-dz-errormessage></small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-text fs-12">Set the product media gallery.</div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Pricing</h5>
                </div>
                <div class="card-body">
                    <div class="mb-5">
                        <label class="form-label" for="product-price">Base Price<span
                                class="text-danger fw-semibold ps-1">*</span></label>
                        <input type="text" class="form-control" id="product-price" name="product-price"
                            placeholder="Product price">
                        <div class="form-text fs-12">Set the product price.</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-label" for="product-discount">Discount</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="product-discount" name="product-discount"
                                    placeholder="Add your descount in percentage">
                                <span class="input-group-text" id="basic-addon1">%</span>
                            </div>
                            <div class="form-text fs-12">Set a percentage discount to be applied on this product.</div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" for="product-tax">Tax Class<span
                                    class="text-danger fw-semibold ps-1">*</span></label>
                            <select id="product-tax">
                                <option value="tax_free" selected>Tax Free</option>
                                <option value="taxable_goods">Taxable Goods</option>
                                <option value="downloadable_product">Downloadable Product</option>
                            </select>
                            <div class="form-text fs-12">Set the product tax class.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Variations</h5>
                </div>
                <div class="card-body">
                    <label class="form-label" for="product-variant">Add Product Variations</label>
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3 mb-3">
                        <select id="product-variations">
                            <option value="color" selected>Color</option>
                            <option value="size">Size</option>
                            <option value="material">Material</option>
                            <option value="style">Style</option>
                        </select>
                        <input type="text" class="form-control" id="product-variant" name="product-variant"
                            placeholder="Product price">
                        <button type="button" class="btn btn-danger ms-auto">
                            <i class="ri-close-large-line fw-semibold"></i>
                        </button>
                    </div>
                    <button type="button" class="btn btn-sm btn-light-primary float-end">
                        <i class="ri-add-line fw-semibold"></i>
                        Add another variation
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Shipping</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="product-weight">Weight</label>
                        <input type="text" class="form-control" id="product-weight" name="product-weight"
                            placeholder="Product Weight">
                    </div>
                    <div>
                        <label class="form-label" for="product-dimension-width">Dimension</label>
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" id="product-dimension-width"
                                    name="product-dimension-width" placeholder="Width (w)">
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="product-dimension-height"
                                    name="product-dimension-height" placeholder="Height (h)">
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="product-dimension-length"
                                    name="product-dimension-length" placeholder="Length (l)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header">
                    <h5 class="mb-0">Meta Options</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="product-meta-title">Meta Tag Title</label>
                        <input type="text" class="form-control" id="product-meta-title" name="product-meta-title"
                            placeholder="Meta tag name">
                        <div class="form-text fs-12">Set a meta tag title. Recommended to be simple and precise keywords.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="product-meta-desc">Meta Tag Description</label>
                        <textarea class="form-control" id="product-meta-desc" name="product-meta-desc" placeholder="Meta tag name"
                            rows="3"></textarea>
                        <div class="form-text fs-12">Set a meta tag description to the product for increased SEO ranking.
                        </div>
                    </div>
                    <div>
                        <label class="form-label" for="product-meta-keyword">Meta Tag Keywords</label>
                        <input id="product-meta-keyword" class='form-control' placeholder='Add Meta Keyword'>
                        <div class="form-text fs-12">Set a list of keywords that the product is related to. Separate the
                            keywords by adding a comma <code>,</code> between each keyword.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thumbnail Image</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <img class="img-fluid" src="{{ asset('assets/images/small/img-2.jpg') }}"
                            alt="Product Feature Image">
                    </div>
                    <div
                        class="cursor-pointer fs-13 position-relative fw-medium text-body text-decoration-underline link-offset-2">
                        Set product image
                        <input type="file"
                            class="form-control h-100 opacity-0 p-0 w-100 position-absolute top-0 start-0"
                            id="product-image" name="product-image">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Status</h5>
                </div>
                <div class="card-body">
                    <div>
                        <label class="form-label" for="product-status">Status<span
                                class="text-danger fw-semibold ps-1">*</span></label>
                        <select id="product-status">
                            <option value="draft" selected>Draft</option>
                            <option value="published">Published</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mt-5 scheduled-input">
                        <label class="form-label" for="publishing-date">Select publishing date and time</label>
                        <input type="text" class="form-control" id="publishing-date" placeholder="Pick date & time">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Product Categories</h5>
                    <button class="btn btn-sm btn-light-primary flex-shrink-0">Add New</button>
                </div>
                <div class="card-body">
                    <label class="form-label" for="product-categories">Categories<span
                            class="text-danger fw-semibold ps-1">*</span></label>
                    <select id="product-categories">
                        <option value="clothing" selected>Clothing</option>
                        <option value="shoes">Shoes</option>
                        <option value="electronics">Electronics</option>
                        <option value="others">Others</option>
                    </select>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Product Tags</h5>
                    <button class="btn btn-sm btn-light-primary flex-shrink-0">Add New</button>
                </div>
                <div class="card-body">
                    <label class="form-label" for="product-tags">Tags<span
                            class="text-danger fw-semibold ps-1">*</span></label>
                    <input id="product-tags" class='form-control' placeholder='Enter tags here' value="Clothing">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <!-- Tagify js -->
    <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

    <!-- Dropzone js -->
    <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

    <!-- Editor js -->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- Product create init -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-product-create.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
