@extends('partials.layouts.master2')

    @section('title', 'Profile Billing & Plans | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Profile Billing' )
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
          <a class="nav-link" href="pages-profile-edit-overview">Basic Information</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-edit-security">Security</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="pages-profile-edit-billing-plans">Billing & Plans</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-edit-notifications">Notifications</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-edit-connections">Connections</a>
        </li>
      </ul>

    </div>
  </div>

  <!-- Tab panes -->
  <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap mb-4">
    <h5 class="fw-semibold m-0">Billing Information</h5>
    <div class="form-icon">
      <input type="text" class="form-control form-control-icon" id="firstNameLayout4" placeholder="Search" required>
      <i class="ri-search-2-line text-muted"></i>
    </div>
  </div>

  <div class="card mb-0">

    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
      <h5 class="card-title mb-0">Overview</h5>

      <button class="btn btn-light-secondary btn-sm">Download .CSV</button>
    </div>

    <div class="card-body">
      <div class="card mb-0 card-body border border-dashed bg-primary bg-opacity-10 border-primary">
        <div class="hstack flex-wrap justify-content-between gap-3">
          <div class="hstack gap-3">
            <i class="ri-information-line text-primary fs-4"></i>
            <div>
              <p class="fw-medium fs-5 mb-0">We Need Your Attention</p>
              <p class="text-muted fs-13 mb-0">Your payment was declined. To start using tools, please add Payment Method</p>
            </div>
          </div>
          <button class="btn btn-primary">Add Payment Method</button>
        </div>
      </div>

      <div class="card-body px-0">
        <div class="row align-items-end">
          <div class="col-md mb-4 mb-md-0">
            <div class="mb-10 pb-2">
              <p class="text-muted fs-13 mb-0">Your plan (billed yearly):</p>
              <h5>Starter - April 2020</h5>
            </div>

            <div>
              <p class="text-body mb-2 fs-15">Total per year</p>
              <h2 class="text-primary mb-1 lh-1">$264 USD</h2>
              <p class="text-muted mb-0 fs-13">Billed annually, for a total of $264 USD every 12 months.</p>
            </div>

          </div>

          <div class="col-md-auto">
            <div class="d-flex flex-wrap gap-3">
              <a class="btn btn-light-danger" href="#!">Cancel subscription</a>
              <button type="button" class="btn btn-primary w-sm-auto">Update plan</button>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-3">

      <div class="card-body px-0 pb-0">
        <div class="row align-items-center flex-grow-1 mb-2">
          <div class="col">
            <h5 class="card-title mb-0">Storage usage</h5>
          </div>
          <div class="col-auto fs-13 text-muted">
            <span class="text-body-emphasis fw-semibold">4.27 GB</span> used of 6 GB
          </div>
        </div>

        <div class="progress progress-sm rounded-pill mb-3">
          <div class="progress-bar w-20" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          <div class="progress-bar w-25 opacity-60" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <ul class="list-inline d-flex align-items-center gap-2 flex-wrap mb-0">
          <li class="list-inline-item d-flex align-items-center gap-2 text-muted fs-13">
            <span class="d-inline-block h-8px w-8px rounded-circle bg-primary"></span> Personal usage space
          </li>
          <li class="list-inline-item d-flex align-items-center gap-2 text-muted fs-13">
            <span class="d-inline-block h-8px w-8px rounded-circle bg-primary"></span> Shared space
          </li>
          <li class="list-inline-item d-flex align-items-center gap-2 text-muted fs-13">
            <span class="d-inline-block h-8px w-8px rounded-circle bg-secondary"></span> Unused space
          </li>
        </ul>
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