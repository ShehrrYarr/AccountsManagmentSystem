@extends('partials.layouts.master2')

    @section('title', 'Profile Documents | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Profile Documents' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="card">
    <div class="card-body pb-0">

      @include('partials.pages-profile-user-section')

      <!-- Nav tabs -->
      <ul class="nav nav-tabs-bordered border-0 justify-content-center mt-5" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-overview">Overview</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-project">Project</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="pages-profile-documents">Documents</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-connections">Connections</a>
        </li>
      </ul>

    </div>
  </div>

  <!-- Tab panes -->
  <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap mb-4">
    <h5 class="fw-semibold m-0">My Documents</h5>
    <div class="form-icon">
      <input type="text" class="form-control form-control-icon" id="firstNameLayout4" placeholder="Search" required>
      <i class="ri-search-2-line text-muted"></i>
    </div>
  </div>

  <h5 class="fw-semibold mb-4">Folders</h5>
  <div class="row g-4">

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-primary h-56px w-56px">
              <i class="ri-folder-2-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="text-muted">Documents</a>
          </h5>
          <p class="text-muted fs-13 m-0">12 files</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-success h-56px w-56px">
              <i class="ri-folder-3-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-success">Finance</a>
          </h5>
          <p class="text-muted fs-13 m-0">7 files</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-warning h-56px w-56px">
              <i class="ri-folder-image-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-warning">Images</a>
          </h5>
          <p class="text-muted fs-13 m-0">22 files</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-info h-56px w-56px">
              <i class="ri-folder-4-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-info">Projects</a>
          </h5>
          <p class="text-muted fs-13 m-0">34 files</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-primary h-56px w-56px">
              <i class="ri-code-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-primary">Code Files</a>
          </h5>
          <p class="text-muted fs-13 m-0">42 files</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-dark h-56px w-56px">
              <i class="ri-folder-video-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-dark">Videos</a>
          </h5>
          <p class="text-muted fs-13 m-0">3 files</p>
        </div>
      </div>
    </div>

  </div>

  <h5 class="fw-semibold my-4">Files</h5>
  <div class="row g-4">

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-primary h-56px w-56px">
              <i class="ri-file-3-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="text-muted">Package.json</a>
          </h5>
          <p class="text-muted fs-13 m-0">2 kb</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-primary h-56px w-56px">
              <i class="ri-file-text-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-primary">Meeting Notes</a>
          </h5>
          <p class="text-muted fs-13 m-0">15 KB</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-danger h-56px w-56px">
              <i class="ri-file-pdf-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-danger">Annual Report</a>
          </h5>
          <p class="text-muted fs-13 m-0">340 KB</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-success h-56px w-56px">
              <i class="ri-file-excel-2-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-success">Sales Report</a>
          </h5>
          <p class="text-muted fs-13 m-0">58 KB</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-info h-56px w-56px">
              <i class="ri-file-code-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="link-info">App.js</a>
          </h5>
          <p class="text-muted fs-13 m-0">78 KB</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-secondary h-56px w-56px">
              <i class="ri-markdown-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="text-muted">README.md</a>
          </h5>
          <p class="text-muted fs-13 m-0">4 KB</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-primary h-56px w-56px">
              <i class="ri-file-word-2-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="text-muted">Project Proposal</a>
          </h5>
          <p class="text-muted fs-13 m-0">78 KB</p>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
      <div class="card m-0 h-100 overflow-hidden text-center">
        <div class="card-body p-5 p-sm-8">
          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-light-primary h-56px w-56px">
              <i class="ri-code-line fs-3"></i>
            </button>
          </div>
          <h5 class="fs-15 fw-semibold mt-5 mb-1">
            <a href="#!" class="text-muted">App.js</a>
          </h5>
          <p class="text-muted fs-13 m-0">54 KB</p>
        </div>
      </div>
    </div>

  </div>

@endsection

@section('js')

  <!-- Countup init -->
  <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

  <!-- Profile init -->
  <script src="{{ asset('assets/js/pages/pages-profile.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection
