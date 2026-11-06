@extends('partials.layouts.master2')

    @section('title', 'UI Alerts | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Alerts' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')


  <!-- START ROW -->
  <div class="row">

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Light Alerts</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Display <strong class="text-body fw-medium">default alerts</strong> in Bootstrap using the <code>.alert</code> class. Add contextual classes like <code>.alert-primary</code>, <code>.alert-success</code>, or <code>.alert-danger</code> for different alert styles.</p>
          <div class="alert alert-primary" role="alert">
            A simple primary alert—check it out!
          </div>
          <div class="alert alert-secondary" role="alert">
            A simple secondary alert—check it out!
          </div>
          <div class="alert alert-success" role="alert">
            A simple success alert—check it out!
          </div>
          <div class="alert alert-danger" role="alert">
            A simple danger alert—check it out!
          </div>
          <div class="alert alert-warning" role="alert">
            A simple warning alert—check it out!
          </div>
          <div class="alert alert-info" role="alert">
            A simple info alert—check it out!
          </div>
          <div class="alert alert-light mb-0" role="alert">
            A simple light alert—check it out!
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Outline Alerts</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create <strong class="text-body fw-medium">outline alerts</strong> with Bootstrap using the <code>.alert-outline-*</code> classes. Replace <code>*</code> with a color variant like <code>primary</code>, <code>success</code>, or <code>danger</code> for different outline styles.</p>
          <div class="alert alert-outline-primary" role="alert">
            A Outline primary alert—check it out!
          </div>
          <div class="alert alert-outline-secondary" role="alert">
            A Outline secondary alert—check it out!
          </div>
          <div class="alert alert-outline-success" role="alert">
            A Outline success alert—check it out!
          </div>
          <div class="alert alert-outline-danger" role="alert">
            A Outline danger alert—check it out!
          </div>
          <div class="alert alert-outline-warning" role="alert">
            A Outline warning alert—check it out!
          </div>
          <div class="alert alert-outline-info" role="alert">
            A Outline info alert—check it out!
          </div>
          <div class="alert alert-outline-light mb-0" role="alert">
            A Outline light alert—check it out!
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Link Alerts</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create <strong class="text-body fw-medium">outline alerts</strong> with Bootstrap using the <code>.alert-outline-*</code> classes. Replace <code>*</code> with a color variant like <code>primary</code>, <code>success</code>, or <code>danger</code> for different outline styles.</p>
          <div class="alert alert-primary" role="alert">
            A simple primary alert with <a href="#!" class="alert-link">an example link</a>. Give it a click if you like.
          </div>
          <div class="alert alert-secondary" role="alert">
            A simple secondary alert with <a href="#!" class="alert-link">an example link</a>. Give it a click if you like.
          </div>
          <div class="alert alert-success" role="alert">
            A simple success alert with <a href="#!" class="alert-link">an example link</a>. Give it a click if you like.
          </div>
          <div class="alert alert-danger" role="alert">
            A simple danger alert with <a href="#!" class="alert-link">an example link</a>. Give it a click if you like.
          </div>
          <div class="alert alert-warning" role="alert">
            A simple warning alert with <a href="#!" class="alert-link">an example link</a>. Give it a click if you like.
          </div>
          <div class="alert alert-info" role="alert">
            A simple info alert with <a href="#!" class="alert-link">an example link</a>. Give it a click if you like.
          </div>
          <div class="alert alert-light mb-0" role="alert">
            A simple light alert with <a href="#!" class="alert-link">an example link</a>. Give it a click if you like.
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Dismissing Alerts</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Theme color Archive just adding class<code> .alert-outline-* </code></p>
          <div class="alert alert-dismissible alert-outline-primary" role="alert">
            A Outline primary alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="alert alert-dismissible alert-outline-secondary" role="alert">
            A Outline secondary alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="alert alert-dismissible alert-outline-success" role="alert">
            A Outline success alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="alert alert-dismissible alert-outline-danger" role="alert">
            A Outline danger alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="alert alert-dismissible alert-outline-warning" role="alert">
            A Outline warning alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="alert alert-dismissible alert-outline-info" role="alert">
            A Outline info alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="alert alert-dismissible alert-outline-light mb-0" role="alert">
            A Outline light alert—check it out!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Icon Alerts</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create <strong class="text-body fw-medium">outline alerts</strong> with Bootstrap using the <code>.alert-light-*</code> classes. Replace <code>*</code> with a color variant like <code>primary</code>, <code>success</code>, or <code>danger</code> for different outline styles.</p>

          <div class="alert alert-primary hstack align-middle" role="alert">
            <i class="ri-check-line ri-lg me-2"></i>
            A simple primary alert—check it out!
          </div>
          <div class="alert alert-secondary hstack align-middle" role="alert">
            <i class="ri-flashlight-line ri-lg me-2"></i>
            A simple secondary alert—check it out!
          </div>
          <div class="alert alert-success hstack align-middle" role="alert">
            <i class="ri-checkbox-circle-line ri-lg me-2"></i>
            A simple success alert—check it out!
          </div>
          <div class="alert alert-danger hstack align-middle" role="alert">
            <i class="ri-error-warning-line ri-lg me-2"></i>
            A simple danger alert—check it out!
          </div>
          <div class="alert alert-warning hstack align-middle" role="alert">
            <i class="ri-error-warning-line ri-lg me-2"></i>
            A simple warning alert—check it out!
          </div>
          <div class="alert alert-info hstack align-middle" role="alert">
            <i class="ri-information-line ri-lg me-2"></i>
            A simple info alert—check it out!
          </div>
          <div class="alert alert-light hstack align-middle mb-0" role="alert">
            <i class="ri-sun-line ri-lg me-2"></i>
            A simple light alert—check it out!
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Left Border Alerts</h5>
        </div>
        <div class="card-body">
          <p class="text-muted"> Add a <strong class="text-body fw-medium">left border</strong> to alerts in Bootstrap using the <code>.alert-border-*</code> class. This class applies a primary color border to the left side of the alert box.</p>
          <div class="alert alert-border-primary" role="alert">
            A simple primary alert—check it out!
          </div>
          <div class="alert alert-border-secondary" role="alert">
            A simple secondary alert—check it out!
          </div>
          <div class="alert alert-border-success" role="alert">
            A simple success alert—check it out!
          </div>
          <div class="alert alert-border-danger" role="alert">
            A simple danger alert—check it out!
          </div>
          <div class="alert alert-border-warning" role="alert">
            A simple warning alert—check it out!
          </div>
          <div class="alert alert-border-info" role="alert">
            A simple info alert—check it out!
          </div>
          <div class="alert alert-border-light mb-0" role="alert">
            A simple light alert—check it out!
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-12">
      <div class="card mb-0">
        <div class="card-header">
          <h5 class="card-title mb-0">Additional content </h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Alerts can also contain additional HTML elements like headings, paragraphs and dividers.</p>
          <div class="alert alert-success mb-0" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

  </div><!-- END ROW -->
@endsection

@section('js')

  <!-- ========== MAIN JS ========== -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection
