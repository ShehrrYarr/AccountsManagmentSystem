@extends('partials.layouts.master2')

    @section('title', 'Avatars | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Avatars' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')


  <div class="row g-4">

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Avatars Letter</h5>
        </div>
        <!--end::card-->
        <div class="card-body">

          <p class="text-muted"><code> .avatar </code> component to wrap the other avatar component in it.</p>
          <div class="d-flex align-items-center flex-wrap gap-2">
            <div class="avatar-item avatar avatar-title border-0 text-white bg-primary">PR</div>
            <div class="avatar-item avatar avatar-title border-0 text-body-emphasis bg-light">LI</div>
            <div class="avatar-item avatar avatar-title border-0 text-white bg-success">SH</div>
            <div class="avatar-item avatar avatar-title border-0 text-white bg-info">SU</div>
            <div class="avatar-item avatar avatar-title border-0 text-white bg-warning">PR</div>
            <div class="avatar-item avatar avatar-title border-0 text-white bg-danger">SR</div>
          </div>

        </div>
        <!-- end card-body -->
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Avatars Group Letter</h5>
        </div>
        <!--end::card-->
        <div class="card-body">

          <p class="text-muted"><code> .avatar </code> component to wrap the other avatar component in it.</p>
          <div class="avatar-group">
            <div class="avatar-item avatar avatar-title text-white bg-primary">PR</div>
            <div class="avatar-item avatar avatar-title text-body-emphasis bg-light">LI</div>
            <div class="avatar-item avatar avatar-title text-white bg-success">SH</div>
            <div class="avatar-item avatar avatar-title text-white bg-info">SU</div>
            <div class="avatar-item avatar avatar-title text-white bg-warning">PR</div>
            <div class="avatar-item avatar avatar-title text-white bg-danger">SR</div>
          </div>

        </div>
        <!-- end card-body -->
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Light Avatars Group Letter</h5>
        </div>
        <!--end::card-->
        <div class="card-body">

          <p class="text-muted"><code> .avatar </code> component to wrap the other avatar component in it.</p>
          <div class="avatar-group">
            <div class="avatar-item avatar avatar-title text-primary bg-primary-subtle">PR</div>
            <div class="avatar-item avatar avatar-title text-secondary bg-secondary-subtle">LI</div>
            <div class="avatar-item avatar avatar-title text-success bg-success-subtle">SH</div>
            <div class="avatar-item avatar avatar-title text-info bg-info-subtle">SU</div>
            <div class="avatar-item avatar avatar-title text-warning bg-warning-subtle">PR</div>
            <div class="avatar-item avatar avatar-title text-danger bg-danger-subtle">SR</div>
          </div>

        </div>
        <!-- end card-body -->
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Avatars Group Image</h5>
        </div>
        <!--end::card-->
        <div class="card-body">

          <p class="text-muted"><code> .avatar </code> component to wrap the other avatar component in it.</p>
          <div class="avatar-group">
            <div class="avatar-item bg-transparent">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item bg-transparent">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item bg-transparent">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item bg-transparent">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item bg-transparent">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item bg-transparent">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
            </div>
          </div>

        </div>
        <!-- end card-body -->
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Indicator Position And Icon</h5>
        </div>
        <!--end::card-->
        <div class="card-body">

          <p class="text-muted"><code> .avatar </code> component to wrap the other avatar component in it.</p>

          <div class="d-flex align-items-center flex-wrap gap-3">
            <div class="position-relative">
              <div class="avatar-item avatar avatar-title text-primary bg-primary-subtle">
                <i class="ri-user-fill"></i>
              </div>
              <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-primary end-0 bottom-0"></span>
            </div>
            <div class="position-relative">
              <div class="avatar-item avatar avatar-title text-danger bg-danger-subtle">
                <i class="ri-user-fill"></i>
              </div>
              <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-danger end-0 top-0"></span>
            </div>
            <div class="position-relative">
              <div class="avatar-item">
                <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
              </div>
              <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
            </div>
            <div class="position-relative">
              <div class="avatar-item">
                <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="avatar image">
              </div>
              <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 top-0"></span>
            </div>
          </div>

        </div>
        <!-- end card-body -->
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Radious</h5>
        </div>
        <!--end::card-->
        <div class="card-body">

          <p class="text-muted"><code> .avatar </code> component to wrap the other avatar component in it.</p>

          <div class="d-flex align-items-center flex-wrap gap-3">
            <div class="avatar-item avatar-lg rounded-0 avatar-title text-primary bg-primary-subtle">
              <i class="ri-user-fill"></i>
            </div>
            <div class="avatar-item avatar-lg rounded-2 avatar-title text-primary bg-primary-subtle">
              <i class="ri-user-fill"></i>
            </div>
            <div class="avatar-item avatar-lg avatar-title text-primary bg-primary-subtle">
              <i class="ri-user-fill"></i>
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-lg rounded-0" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-lg rounded-2" src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-lg" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
            </div>
          </div>

        </div>
        <!-- end card-body -->
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Avatars Size</h5>
        </div>
        <!--end::card-->
        <div class="card-body">

          <p class="text-muted"><code> .avatar </code> component to wrap the other avatar component in it.</p>
          <div class="d-flex align-items-center flex-wrap gap-3">
            <div class="avatar-item">
              <img class="img-fluid avatar-xl" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-lg" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-xs" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
            </div>
          </div>

        </div>
        <!-- end card-body -->
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Avatars Group Size</h5>
        </div>
        <!--end::card-->
        <div class="card-body">

          <p class="text-muted"><code> .avatar </code> component to wrap the other avatar component in it.</p>

          <div class="avatar-group">
            <div class="avatar-item">
              <img class="img-fluid avatar-lg" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-lg" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-lg" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-lg" src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-lg" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item avatar-lg fw-semibold avatar-title text-bg-primary">5+</div>
          </div>

          <div class="avatar-group">
            <div class="avatar-item">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item avatar fw-semibold avatar-title text-bg-primary">5+</div>
          </div>

          <div class="avatar-group">
            <div class="avatar-item">
              <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item">
              <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
            </div>
            <div class="avatar-item avatar-sm fw-semibold avatar-title text-bg-primary">5+</div>
          </div>
        </div>
        <!-- end card-body -->
      </div>
    </div>

  </div>
@endsection

@section('ja')

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection