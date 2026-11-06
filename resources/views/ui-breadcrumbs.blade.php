@extends('partials.layouts.master2')

    @section('title', 'Breadcrumbs | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Badges' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')


  <!-- START ROW -->
  <div class="row">

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Default Badges</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create navigational links with Bootstrap's <code>.breadcrumb</code> component. Use <code>&lt;nav&gt;</code> and <code>&lt;ol class="breadcrumb"&gt;</code> to display a breadcrumb trail, indicating the current page's location.</p>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Breadcrumb with line icon</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Use the custom <code>.breadcrumb-line</code> class to display breadcrumbs with custom Remix Icons. Apply it to the <code>&lt;ol class="breadcrumb"&gt;</code> to enhance the breadcrumb trail with icons.</p>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-line">
              <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-line">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-line mb-0">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Breadcrumb with arrow icon</h5>
        </div>
        <div class="card-body">
          <p class="text-muted"> Use the custom <code>.breadcrumb-arrow</code> class to create breadcrumb trails with arrow-shaped separators using Remix Icons. Apply it to the <code>&lt;ol class="breadcrumb"&gt;</code> for a stylish, icon-based navigation.</p>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-arrow">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-arrow mb-0">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card card-h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Breadcrumb with double arrow icon</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Use the custom <code>.breadcrumb-double-arrow</code> class to create breadcrumb trails with double arrow separators using Remix Icons. Apply it to the <code>&lt;ol class="breadcrumb"&gt;</code> for a unique and visually distinct navigation style.</p>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-double-arrow">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-double-arrow mb-0">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card mb-0">
        <div class="card-header">
          <h5 class="card-title mb-0">Colored Breadcrumb</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create colorful breadcrumb trails by applying Bootstrap utility classes like <code>.bg-primary</code> or <code>.text-light</code> to the <code>&lt;nav&gt;</code> or <code>&lt;ol class="breadcrumb"&gt;</code>. This adds vibrant backgrounds or text colors to your breadcrumb.</p>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb colored-breadcrumb breadcrumb-double-arrow bg-primary mb-3">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb colored-breadcrumb breadcrumb-double-arrow bg-secondary mb-3">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb colored-breadcrumb breadcrumb-double-arrow bg-success mb-3">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb colored-breadcrumb breadcrumb-double-arrow bg-info mb-3">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb colored-breadcrumb breadcrumb-double-arrow bg-warning mb-3">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb colored-breadcrumb breadcrumb-double-arrow bg-danger mb-0">
              <li class="breadcrumb-item"><a href="#!">Home</a></li>
              <li class="breadcrumb-item"><a href="#!">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
        </div>
      </div>
    </div><!-- END COL -->

  </div>

@endsection

@section('js')

  <!-- ========== MAIN JS ========== -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection