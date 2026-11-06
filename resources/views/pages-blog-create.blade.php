@extends('partials.layouts.master3')

    @section('title', 'Blog Details | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Blog List' )
    @section('pagetitle', 'Pages')
    @section('buttonTitle', 'Blog List')
    @section('link', 'pages-blog-list')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
    @endsection
    
    @section('content')


<div class="card mb-0">
  <div class="card-header">
    <h5 class="mb-0">Post Edit</h5>
  </div>
  <div class="card-body add-post">
    <form class="row needs-validation" novalidate>
      <div class="col-md-6">
        <div class="mb-3">
          <label class="mb-1" for="validationCustom01">Title:</label>
          <input class="form-control" id="validationCustom01" type="text" placeholder="Post Title">
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label class="mb-1" for="basic-time-picker">Schedule Post:</label>
          <input type="text" class="form-control" id="basic-time-picker" placeholder="Select a date and time">
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label class="mb-1" for="choices-multiple-close-icon">Tags:</label>
          <select id="choices-multiple-close-icon" multiple>
            <option value="databases">Select databases</option>
            <option value="mysql">MySQL</option>
            <option value="postgresql">PostgreSQL</option>
            <option value="mongodb">MongoDB</option>
            <option value="sqlite">SQLite</option>
            <option value="oracle">Oracle</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <div>
            <label class="mb-1" for="blog-choice">Category:</label>
            <select id="blog-choice">
              <option value="AL">Lifestyle</option>
              <option value="WY">Travel</option>
              <option value="FY">Food</option>
              <option value="PY">Photography</option>
              <option value="HD">Home Decor</option>
              <option value="FS">Fitness </option>
              <option value="ED">Education</option>
              <option value="BR">Book Reviews</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="mb-3">
          <label class="mb-1" for="my-dropzone">Upload Media:</label>
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
            </div>
          </div>
          <div class="form-text fs-12">Set the product media gallery.</div>
        </div>
      </div>
      <div class="col-12">
        <div class="mb-3">
          <label class="w-100 mb-1">Content:</label>
          <div id="createBlogEditor">
            <p>Hello World!</p>
            <p>Some initial <strong>bold</strong> text</p>
            <p><br></p>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-end gap-3 mt-4">
        <button class="btn btn-primary" type="submit">Post</button>
        <input class="btn btn-light" type="reset" value="Discard">
      </div>
    </form>
  </div>
</div>
@endsection

@section('js')

<!-- Air Datepicker js -->
<script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

<!-- Dropzone js -->
<script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

<!-- Editor js -->
<script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

<!-- Blog js -->
<script src="{{ asset('assets/js/pages/blog.init.js') }}"></script>

<!-- App js -->
<script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection