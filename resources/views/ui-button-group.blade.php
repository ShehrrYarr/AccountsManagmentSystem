@extends('partials.layouts.master2')

    @section('title', 'Button Group | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Button Group' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="row g-4">

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Basic Button Group</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">A simple button group can be created by adding the <code>.btn-group</code> class around several buttons. This keeps the buttons aligned together in a group.</p>
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary">Left</button>
            <button type="button" class="btn btn-primary">Middle</button>
            <button type="button" class="btn btn-primary">Right</button>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Active Link</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Use the <code>.active</code> class to highlight a button link that is currently active. It visually indicates which link/button the user is interacting with.</p>
          <div class="btn-group">
            <a href="#!" class="btn btn-primary active" aria-current="page">Active link</a>
            <a href="#!" class="btn btn-primary">Link</a>
            <a href="#!" class="btn btn-primary">Link</a>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Mixed Styles</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">You can create button groups with different button styles by mixing classes like <code>.btn-danger</code>, <code>.btn-warning</code>, and <code>.btn-success</code>. This allows you to create button groups with different colors.</p>
          <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-danger">Left</button>
            <button type="button" class="btn btn-warning">Middle</button>
            <button type="button" class="btn btn-success">Right</button>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Outlined styles</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Use the <code>.btn-outline</code> class along with other button classes (like <code>.btn-outline-primary</code>) to create buttons with borders but no solid background color.</p>

          <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button type="button" class="btn btn-outline-primary">Left</button>
            <button type="button" class="btn btn-outline-primary">Middle</button>
            <button type="button" class="btn btn-outline-primary">Right</button>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Checkbox button groups</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Checkbox-style buttons can be created by using <code>.btn-check</code> for the input and <code>.btn</code> for the label. These buttons toggle between checked and unchecked states.</p>
          <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
            <label class="btn btn-outline-primary" for="btncheck1">Checkbox 1</label>

            <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btncheck2">Checkbox 2</label>

            <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btncheck3">Checkbox 3</label>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Radio button groups</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Radio-style buttons are created in a similar way to checkboxes, but the radio buttons allow only one selection at a time. Use the <code>.btn-check</code> class for the radio inputs and <code>.btn</code> for the labels.</p>
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Button toolbar</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">A button toolbar allows you to group multiple button groups together, giving you more flexibility in arranging buttons on your page. Use the <code>.btn-toolbar</code> class to organize button groups.</p>
          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2" role="group" aria-label="First group">
              <button type="button" class="btn btn-primary">1</button>
              <button type="button" class="btn btn-primary">2</button>
              <button type="button" class="btn btn-primary">3</button>
            </div>
            <div class="btn-group me-2" role="group" aria-label="Second group">
              <button type="button" class="btn btn-light">4</button>
              <button type="button" class="btn btn-light">5</button>
            </div>
            <div class="btn-group" role="group" aria-label="Third group">
              <button type="button" class="btn btn-info">6</button>
            </div>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Button Nesting</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">You can nest dropdowns inside button groups. This allows you to add more interactive components to your buttons, such as a dropdown menu.</p>
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-primary">Button 1</button>
            <button type="button" class="btn btn-primary">Button 2</button>

            <div class="btn-group" role="group">
              <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#!">Dropdown link</a></li>
                <li><a class="dropdown-item" href="#!">Another link</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Button Sizing</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">You can adjust the size of your buttons using classes like <code>.btn-group-lg</code> for large buttons, <code>.btn-group</code> for default size, and <code>.btn-group-sm</code> for small buttons.</p>

          <div class="vstack gap-3">
            <!-- Large Buttons -->
            <div class="btn-group btn-group-lg" role="group" aria-label="Large button group">
              <button type="button" class="btn btn-outline-primary">Left</button>
              <button type="button" class="btn btn-outline-primary">Middle</button>
              <button type="button" class="btn btn-outline-primary">Right</button>
            </div>

            <!-- Default Buttons -->
            <div class="btn-group" role="group" aria-label="Default button group">
              <button type="button" class="btn btn-outline-primary">Left</button>
              <button type="button" class="btn btn-outline-primary">Middle</button>
              <button type="button" class="btn btn-outline-primary">Right</button>
            </div>

            <!-- Small Buttons -->
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
              <button type="button" class="btn btn-outline-primary">Left</button>
              <button type="button" class="btn btn-outline-primary">Middle</button>
              <button type="button" class="btn btn-outline-primary">Right</button>
            </div>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-lg-6">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Vertical variation</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">A vertical button group stacks buttons on top of each other. Use the <code>.btn-group-vertical</code> class to create this layout.</p>
          <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
            <button type="button" class="btn btn-primary">Button 1</button>
            <button type="button" class="btn btn-primary">Button 2</button>
            <button type="button" class="btn btn-primary">Button 3</button>
            <button type="button" class="btn btn-primary">Button 4</button>
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
