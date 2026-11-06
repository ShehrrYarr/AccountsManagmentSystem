@extends('partials.layouts.master2')

    @section('title', 'UI List Group | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'List' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')

  <div class="row g-4">

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Default List</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>list-group</code> class in an unordered list and <code>list-group-item</code> class to create a default list group.</p>

          <ul class="list-group">
            <li class="list-group-item">John Doe</li>
            <li class="list-group-item">Jane Smith</li>
            <li class="list-group-item">Emily Johnson</li>
            <li class="list-group-item">Michael Brown</li>
            <li class="list-group-item">Sarah Davis</li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Active Item List</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>active</code> class to <code>list-group-item</code> to indicate the current active selection.</p>

          <ul class="list-group">
            <li class="list-group-item hstack">
              <i class="ri-home-2-line me-2"></i>
              <span>Home</span>
            </li>
            <li class="list-group-item hstack active" aria-current="true">
              <i class="ri-notification-3-line me-2"></i>
              <span>Notifications</span>
            </li>
            <li class="list-group-item hstack">
              <i class="ri-chat-1-line me-2"></i>
              <span>Sent Messages</span>
            </li>
            <li class="list-group-item hstack">
              <i class="ri-user-add-line me-2"></i>
              <span>New Requests</span>
            </li>
            <li class="list-group-item hstack">
              <i class="ri-delete-bin-line me-2"></i>
              <span>Deleted Messages</span>
            </li>
          </ul>


        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Disabled Items List</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>disabled</code> class to <code>list-group-item</code> to make it appear disabled.</p>

          <ul class="list-group">
            <li class="list-group-item disabled" aria-disabled="true">A disabled item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">List with Link</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>&lt;a&gt;</code> tag to create actionable list group items with hover, disabled, and active states by adding list-group-item-action.</p>

          <div class="list-group">
            <a href="#!" class="list-group-item list-group-item-action active" aria-current="true">
              The current link item
            </a>
            <a href="#!" class="list-group-item list-group-item-action">A second link item</a>
            <a href="#!" class="list-group-item list-group-item-action">A third link item</a>
            <a href="#!" class="list-group-item list-group-item-action">A fourth link item</a>
            <a class="list-group-item list-group-item-action disabled" aria-disabled="true">A disabled link item</a>
          </div>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">List with Button</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>&lt;button&gt;</code> tag to create actionable list group items with hover, disabled, and active states by adding list-group-item-action.</p>

          <div class="list-group">
            <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
              Simply dummy text of the printing
              <span class="badge float-end bg-primary">243</span>
            </button>
            <button type="button" class="list-group-item list-group-item-action">
              There are many variations of passages
              <span class="badge float-end bg-secondary-subtle text-secondary">35</span>
            </button>
            <button type="button" class="list-group-item list-group-item-action">
              All the Lorem Ipsum generators
              <span class="badge float-end bg-info-subtle text-info">132</span>
            </button>
            <button type="button" class="list-group-item list-group-item-action">
              All the Lorem Ipsum generators
              <span class="badge float-end bg-success-subtle text-success">2525</span>
            </button>
            <button type="button" class="list-group-item list-group-item-action" disabled>
              A disabled item meant to be disabled
              <span class="badge float-end bg-danger-subtle text-danger">21</span>
            </button>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Borderless List</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>list-borderless</code> class to <code>list-group-item</code> to remove border and create a normal list.</p>

          <ul class="list-group list-borderless">
            <li class="list-group-item"> <span class="bullet me-4"></span>An item</li>
            <li class="list-group-item"> <span class="bullet me-4"></span>A second item</li>
            <li class="list-group-item"> <span class="bullet me-4"></span>A third item</li>
            <li class="list-group-item"> <span class="bullet me-4"></span>A fourth item</li>
            <li class="list-group-item"> <span class="bullet me-4"></span>And a fifth one</li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Small Size List</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>list-group-sm</code> class to <code>list-group-item</code> to create a small size list.</p>

          <ul class="list-group list-group-sm list-borderless">
            <li class="list-group-item"> <span class="bullet me-4"></span>An item</li>
            <li class="list-group-item"> <span class="bullet me-4"></span>A second item</li>
            <li class="list-group-item"> <span class="bullet me-4"></span>A third item</li>
            <li class="list-group-item"> <span class="bullet me-4"></span>A fourth item</li>
            <li class="list-group-item"> <span class="bullet me-4"></span>And a fifth one</li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Flush List</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>list-group-flush</code> class to remove some borders and rounded corners to render list group items.</p>

          <ul class="list-group fs-13 fw-medium list-group-flush">
            <li class="list-group-item list-group-item-action">
              <div class="d-flex align-items-center gap-2">
                <div class="avatar-item avatar avatar-title text-primary bg-primary-subtle">
                  JD
                </div>
                John Doe
              </div>
            </li>
            <li class="list-group-item list-group-item-action">
              <div class="d-flex align-items-center gap-2">
                <div class="avatar-item avatar avatar-title text-secondary bg-secondary-subtle">
                  JS
                </div>
                Jane Smith
              </div>
            </li>
            <li class="list-group-item list-group-item-action">
              <div class="d-flex align-items-center gap-2">
                <div class="avatar-item avatar avatar-title text-info bg-info-subtle">
                  EJ
                </div>
                Emily Johnson
              </div>
            </li>
            <li class="list-group-item list-group-item-action">
              <div class="d-flex align-items-center gap-2">
                <div class="avatar-item avatar avatar-title text-danger bg-danger-subtle">
                  MB
                </div>
                Michael Brown
              </div>
            </li>
            <li class="list-group-item list-group-item-action">
              <div class="d-flex align-items-center gap-2">
                <div class="avatar-item avatar avatar-title text-warning bg-warning-subtle">
                  SD
                </div>
                Sarah Davis
              </div>
            </li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">List with Numbered</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>list-group-numbered</code> class (optionally use an <code>&lt;ol&gt;</code> element) to show numbered list group items. </p>

          <ol class="list-group list-group-numbered">
            <li class="list-group-item">A list item</li>
            <li class="list-group-item">A list item</li>
            <li class="list-group-item">A list item</li>
            <li class="list-group-item">A list item</li>
            <li class="list-group-item">A list item</li>
          </ol>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">List with Badges</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use badges to any list group item to show unread counts, activity, and more with the help of some <a href="https://getbootstrap.com/docs/5.1/utilities/">utilities</a>.</p>

          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Best Rated Headsets of 2022
              <span class="badge bg-success-subtle text-success">Sent</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              New Model BS 2000 X
              <span class="badge bg-primary-subtle text-primary">In Draft</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              2022 Spring Conference by Beats
              <span class="badge bg-success-subtle text-success">Sent</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Best Headsets Giveaway
              <span class="badge bg-warning-subtle text-warning">In Queue</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              New Model BS 2000 XI
              <span class="badge bg-primary-subtle text-primary">In Draft</span>
            </li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">List with Checkboxs</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use Bootstrap’s checkboxes within list group items and customize as needed.</p>

          <ul class="list-group">
            <li class="list-group-item">
              <input class="form-check-input me-1" type="checkbox" id="firstCheckbox">
              <label class="form-check-label mb-0" for="firstCheckbox">UI kits</label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="checkbox" id="secondCheckbox">
              <label class="form-check-label mb-0" for="secondCheckbox">Wow animations</label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="checkbox" id="thirdCheckbox">
              <label class="form-check-label mb-0" for="thirdCheckbox">Apex charts</label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="checkbox" id="forthCheckbox">
              <label class="form-check-label mb-0" for="forthCheckbox">Starter kits</label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="checkbox" id="fifthCheckbox">
              <label class="form-check-label mb-0" for="fifthCheckbox">Advanced UI</label>
            </li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">List with Radios</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use Bootstrap’s radios within list group items and customize as needed.</p>

          <ul class="list-group">
            <li class="list-group-item">
              <input class="form-check-input me-1" type="radio" name="listGroupRadio" id="firstRadio" checked>
              <label class="form-check-label mb-0" for="firstRadio"> Groceries </label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="radio" name="listGroupRadio" id="secondRadio">
              <label class="form-check-label mb-0" for="secondRadio"> Furniture </label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="radio" name="listGroupRadio" id="thirdRadio">
              <label class="form-check-label mb-0" for="thirdRadio"> Beauty </label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="radio" name="listGroupRadio" id="forthRadio">
              <label class="form-check-label mb-0" for="fourthRadio"> Books </label>
            </li>
            <li class="list-group-item">
              <input class="form-check-input me-1" type="radio" name="listGroupRadio" id="fifthRadio">
              <label class="form-check-label mb-0" for="fifthRadio"> Electronic Gadgets </label>
            </li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Contextual Classes</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use contextual classes to style list items with a stateful background and color.</p>

          <ul class="list-group">
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item list-group-item-primary">A simple primary list group item</li>
            <li class="list-group-item list-group-item-secondary">A simple secondary list group item</li>
            <li class="list-group-item list-group-item-success">A simple success list group item</li>
            <li class="list-group-item list-group-item-danger">A simple danger list group item</li>
            <li class="list-group-item list-group-item-warning">A simple warning list group item</li>
            <li class="list-group-item list-group-item-info">A simple info list group item</li>
            <li class="list-group-item list-group-item-light">A simple light list group item</li>
            <li class="list-group-item list-group-item-dark">A simple dark list group item</li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0"> Sub headings </h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use contextual classes to style list items with a stateful background and color.</p>

          <ol class="list-group list-group-numbered">
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto text-muted">
                <div class="fw-semibold fs-14 text-body">Electric Vehicles Surge</div>
                Tesla Model Y tops sales charts in 2023.
              </div>
              <span class="badge bg-primary-subtle text-primary">154 Views</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto text-muted">
                <div class="fw-semibold fs-14 text-body">mRNA Vaccine Advances</div>
                mRNA tech now targets cancer treatments.
              </div>
              <span class="badge bg-secondary-subtle text-secondary">200 Views</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto text-muted">
                <div class="fw-semibold fs-14 text-body">Climate Change Effects</div>
                Extreme weather and rising sea levels are accelerating.
              </div>
              <span class="badge bg-success-subtle text-success">450 Views</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto text-muted">
                <div class="fw-semibold fs-14 text-body">AI Art Innovations</div>
                AI tools like DALL-E create stunning visuals.
              </div>
              <span class="badge bg-danger-subtle text-danger">92 Views</span>
            </li>
          </ol>
        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12">
      <div class="card h-100 mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Horizontal List</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Use <code>list-group-horizontal</code> class to change the layout of list group items from vertical to horizontal across all breakpoints.</p>

          <ul class="list-group list-group-horizontal-md mb-3">
            <li class="list-group-item">Inbox</li>
            <li class="list-group-item">Work</li>
            <li class="list-group-item">Shopping</li>
          </ul>
          <ul class="list-group list-group-horizontal-md justify-content-center mb-3">
            <li class="list-group-item">Inbox</li>
            <li class="list-group-item">Work</li>
            <li class="list-group-item">Shopping</li>
          </ul>
          <ul class="list-group list-group-horizontal-md justify-content-end">
            <li class="list-group-item">Inbox</li>
            <li class="list-group-item">Work</li>
            <li class="list-group-item">Shopping</li>
          </ul>

        </div>
        <!-- end card-body -->
      </div>
      <!--end::card-->
    </div>

    <div class="col-12">
      <div class="card mb-0">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Custom Content</h5>
        </div>
        <div class="card-body">

          <p class="text-muted mb-4">Add nearly any HTML within, even for linked list groups like the one below, with the help of <a href="https://getbootstrap.com/docs/5.1/utilities/flex/">flexbox utilities</a>.</p>

          <div class="row g-4">
            <div class="col-md-6">
              <!-- List Group Item 1 -->
              <ul class="list-group">
                <li class="list-group-item border-dashed list-group-header d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="mb-0">Charlie Pritchard</h5>
                    <p class="mb-0 text-muted">12 minutes ago</p>
                  </div>
                  <span class="badge bg-primary rounded-pill status-badge">Pending</span>
                </li>
                <li class="list-group-item border-dashed list-group-item-content">
                  <div class="d-flex gap-3 flex-column flex-sm-row align-items-sm-center">
                    <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image" class="avatar-lg rounded-circle me-3">
                    <div>
                      <p class="mb-0">Charlie has just started a new project and is currently collecting feedback from the team. The initial responses have been positive, but some adjustments are still needed before the final review.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>

            <div class="col-md-6">
              <!-- List Group Item 2 -->
              <ul class="list-group">
                <li class="list-group-item border-dashed list-group-header d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="mb-0">Dominic Charlton</h5>
                    <p class="mb-0 text-muted">15 minutes ago</p>
                  </div>
                  <span class="badge bg-primary rounded-pill status-badge">Pending</span>
                </li>
                <li class="list-group-item border-dashed list-group-item-content">
                  <div class="d-flex gap-3 flex-column flex-sm-row align-items-sm-center">
                    <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="user Image" class="avatar-lg rounded-circle me-3">
                    <div>
                      <p class="mb-0">Dominic is finalizing the details of his proposal and needs to address a few client concerns before submission. He’s been working late to ensure everything is perfect.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <div class="row g-4 mt-0">
            <div class="col-md-6">
              <!-- List Group Item 3 -->
              <ul class="list-group">
                <li class="list-group-item border-dashed list-group-header d-flex justify-content-between align-items-center bg-light bg-opacity-30">
                  <div>
                    <h5 class="mb-0">Declan Long</h5>
                    <p class="mb-0 text-muted">1 hour ago</p>
                  </div>
                  <span class="badge bg-danger rounded-pill status-badge">Rejected</span>
                </li>
                <li class="list-group-item border-dashed list-group-item-content">
                  <div class="d-flex gap-3 flex-column flex-sm-row align-items-sm-center">
                    <img src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="user Image" class="avatar-lg rounded-circle me-3">
                    <div>
                      <p class="mb-0">Declan's proposal was unfortunately rejected due to missing key details. He’s currently reviewing the feedback to improve and resubmit his proposal for reconsideration.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>

            <div class="col-md-6">
              <!-- List Group Item 4 -->
              <ul class="list-group">
                <li class="list-group-item border-dashed list-group-header d-flex justify-content-between align-items-center bg-light bg-opacity-30">
                  <div>
                    <h5 class="mb-0">Angela Bernier</h5>
                    <p class="mb-0 text-muted">5 days ago</p>
                  </div>
                  <span class="badge bg-success rounded-pill status-badge">Successful</span>
                </li>
                <li class="list-group-item border-dashed list-group-item-content">
                  <div class="d-flex gap-3 flex-column flex-sm-row align-items-sm-center">
                    <img src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="user Image" class="avatar-lg rounded-circle me-3">
                    <div>
                      <p class="mb-0">Angela’s project has been a resounding success. Her innovative approach and attention to detail impressed the client, leading to a contract extension and positive feedback.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
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