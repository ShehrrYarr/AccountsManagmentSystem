@extends('partials.layouts.master2')

    @section('title', 'UI Alerts | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Badges' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <!-- START ROW -->
  <div class="row">

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Default Badges</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Use <strong class="text-body fw-medium">default badges</strong> in Bootstrap with the <code>.badge</code> class. Add color classes like <code>.badge-primary</code>, <code>.badge-secondary</code>, etc., to style the badge.</p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-primary">Primary</span>
            <span class="badge bg-secondary">Secondary</span>
            <span class="badge bg-success">Success</span>
            <span class="badge bg-info">Info</span>
            <span class="badge bg-warning">Warning</span>
            <span class="badge bg-danger">Danger</span>
            <span class="badge bg-dark">Dark</span>
            <span class="badge bg-light text-body">Light</span>
          </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Create a <strong class="text-body fw-medium">badge</strong> with a primary background and rounded pill shape using <code>.badge</code>, <code>.bg-primary</code>, and <code>.rounded-pill</code> classes.</p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-primary rounded-pill">Primary</span>
            <span class="badge bg-secondary rounded-pill">Secondary</span>
            <span class="badge bg-success rounded-pill">Success</span>
            <span class="badge bg-info rounded-pill">Info</span>
            <span class="badge bg-warning rounded-pill">Warning</span>
            <span class="badge bg-danger rounded-pill">Danger</span>
            <span class="badge bg-dark rounded-pill">Dark</span>
            <span class="badge bg-light rounded-pill text-body">Light</span>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Light Badges</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Use <strong class="text-body fw-medium">default badges</strong> in Bootstrap with the <code>.badge</code> class. Add color classes like <code>.bg-primary-subtle</code>, <code>.badge-secondary-subtle</code>, etc., to style the badge.</p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-primary-subtle text-primary">Primary</span>
            <span class="badge bg-secondary-subtle text-secondary">Secondary</span>
            <span class="badge bg-success-subtle text-success">Success</span>
            <span class="badge bg-info-subtle text-info">Info</span>
            <span class="badge bg-warning-subtle text-warning">Warning</span>
            <span class="badge bg-danger-subtle text-danger">Danger</span>
            <span class="badge bg-dark-subtle text-body">Dark</span>
            <span class="badge bg-light-subtle text-body text-body">Light</span>
          </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Create a <strong class="text-body fw-medium">badge</strong> with a primary background and rounded pill shape using <code>.badge</code>, <code>.bg-primary-subtle</code>, and <code>.rounded-pill</code> classes.</p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge rounded-pill bg-primary-subtle text-primary">Primary</span>
            <span class="badge rounded-pill bg-secondary-subtle text-secondary">Secondary</span>
            <span class="badge rounded-pill bg-success-subtle text-success">Success</span>
            <span class="badge rounded-pill bg-info-subtle text-info">Info</span>
            <span class="badge rounded-pill bg-warning-subtle text-warning">Warning</span>
            <span class="badge rounded-pill bg-danger-subtle text-danger">Danger</span>
            <span class="badge rounded-pill bg-dark-subtle text-body">Dark</span>
            <span class="badge rounded-pill bg-light-subtle text-body text-body">Light</span>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Outline Badges</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Use <strong class="text-body fw-medium">default badges</strong> in Bootstrap with the <code>.badge</code> class. Add color classes like <code>.border</code>, <code>.border-*</code>, etc., to style the badge.</p>
          <div class="d-flex flex-wrap gap-2">
            <a href="#!" class="badge border border-primary text-primary">Primary</a>
            <span class="badge border border-secondary text-secondary">Secondary</span>
            <span class="badge border border-success text-success">Success</span>
            <span class="badge border border-info text-info">Info</span>
            <span class="badge border border-warning text-warning">Warning</span>
            <span class="badge border border-danger text-danger">Danger</span>
            <span class="badge border border-dark text-body">Dark</span>
            <span class="badge border border-light text-body">Light</span>
          </div>

        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Create a <strong class="text-body fw-medium">badge</strong> with a primary background and rounded pill shape using <code>.badge</code>, <code>.border</code>, <code>.border-*</code> and <code>.rounded-pill</code> classes.</p>
          <div class="d-flex flex-wrap gap-2">
            <a href="#!" class="badge rounded-pill border border-primary text-primary">Primary</a>
            <span class="badge rounded-pill border border-secondary text-success">Secondary</span>
            <span class="badge rounded-pill border border-success text-success">Success</span>
            <span class="badge rounded-pill border border-info text-info">Info</span>
            <span class="badge rounded-pill border border-warning text-warning">Warning</span>
            <span class="badge rounded-pill border border-danger text-danger">Danger</span>
            <span class="badge rounded-pill border border-dark text-body">Dark</span>
            <span class="badge rounded-pill border border-light text-body">Light</span>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Button Badges</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Add a badge to a Bootstrap button by placing a <code>&lt;span class="badge"&gt;</code> inside the button. This is great for showing counts or notifications on the button.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-primary">
              Notifications <span class="badge bg-success ms-1">4</span>
            </button>
            <button type="button" class="btn btn-success">
              Messages <span class="badge bg-danger ms-1">2</span>
            </button>
            <button type="button" class="btn btn-outline-secondary">
              Draft <span class="badge bg-success ms-1">2</span>
            </button>
          </div>

        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Button Position Badges</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Position badges on Bootstrap buttons by placing a <code>&lt;span class="badge position-absolute"&gt;</code> inside the button. Use utility classes like <code>.top-0</code> and <code>.end-0</code> to adjust the badge position.</p>
          <div class="d-flex flex-wrap gap-4">
            <button type="button" class="btn btn-primary position-relative">
              Mails <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">+9
                <span class="visually-hidden">unread messages</span></span>
            </button>
            <button type="button" class="btn btn-light position-relative">
              Alerts <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">unread messages</span></span>
            </button>
            <button type="button" class="btn btn-primary position-relative p-0 icon-btn rounded">
              <i class="ri-mail-fill"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">unread messages</span></span>
            </button>
            <button type="button" class="btn btn-light position-relative p-0 icon-btn rounded-circle">
              <i class="ri-notification-4-fill"></i>
            </button>
            <button type="button" class="btn btn-light position-relative p-0 icon-btn rounded-circle">
              <i class="ri-menu-line"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-success p-1"><span class="visually-hidden">unread messages</span></span>
            </button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Badges with Heading</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Add badges to headings by placing a <code>&lt;span class="badge"&gt;</code> next to the heading text. This is useful for highlighting important information or counts.</p>
          <div>
            <h1>Example heading <span class="badge bg-primary">New</span></h1>
            <h2>Example heading <span class="badge bg-primary">New</span></h2>
            <h3>Example heading <span class="badge bg-primary">New</span></h3>
            <h4>Example heading <span class="badge bg-primary">New</span></h4>
            <h5>Example heading <span class="badge bg-primary">New</span></h5>
            <h6 class="mb-0">Example heading <span class="badge bg-primary">New</span></h6>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card mb-0">
        <div class="card-header">
          <h5 class="card-title mb-0">Default Badges</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Theme color Archive just adding class<code> .badge </code></p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge border bg-primary">5</span>
            <span class="badge border bg-secondary">5</span>
            <span class="badge border bg-success">5</span>
            <span class="badge border bg-info">5</span>
            <span class="badge border bg-warning">5</span>
            <span class="badge border bg-danger">5</span>
            <span class="badge border bg-dark">5</span>
            <span class="badge border bg-light text-muted">5</span>
          </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Theme color Archive just adding class<code> .badge </code></p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge border text-primary bg-primary-subtle">5</span>
            <span class="badge border text-secondary bg-secondary-subtle">5</span>
            <span class="badge border text-success bg-success-subtle">5</span>
            <span class="badge border text-info bg-info-subtle">5</span>
            <span class="badge border text-warning bg-warning-subtle">5</span>
            <span class="badge border text-danger bg-danger-subtle">5</span>
            <span class="badge border text-body-emphasis bg-dark-subtle">5</span>
            <span class="badge border text-body-emphasis bg-light-subtle">5</span>
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