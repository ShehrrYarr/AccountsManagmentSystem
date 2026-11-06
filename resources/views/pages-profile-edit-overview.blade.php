@extends('partials.layouts.master2')

    @section('title', 'Profile Overview | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Profile Overview' )
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
          <a class="nav-link active" href="pages-profile-edit-overview">Basic Information</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-edit-security">Security</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-edit-billing-plans">Billing & Plans</a>
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
  <div class="row g-4 justify-content-center">
    <div class="col-md-4">
      <div class="card mb-0">
        <div class="card-header">
          <h5 class="card-title mb-0">Portfolio</h5>
        </div>
        <div class="card-body">
          <div class="mb-3 d-flex">
            <div class="d-block flex-shrink-0 me-3">
              <div class="avatar-item border-0 avatar avatar-title text-secondary bg-secondary-subtle">
                <i class="ri-github-fill fs-20"></i>
              </div>
            </div>
            <input type="email" class="form-control" id="gitUsername" placeholder="Username" value="@daveadame">
          </div>
          <div class="mb-3 d-flex">
            <div class="d-block flex-shrink-0 me-3">
              <div class="avatar-item border-0 avatar avatar-title text-primary bg-primary-subtle">
                <i class="ri-global-fill fs-20"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="websiteInput" placeholder="www.example.com" value="www.111.com">
          </div>
          <div class="mb-3 d-flex">
            <div class="d-block flex-shrink-0 me-3">
              <div class="avatar-item border-0 avatar avatar-title text-success bg-success-subtle">
                <i class="ri-dribbble-fill fs-20"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="dribbleName" placeholder="Username" value="@dave_adame">
          </div>
          <div class="d-flex">
            <div class="d-block flex-shrink-0 me-3">
              <div class="avatar-item border-0 avatar avatar-title text-danger bg-danger-subtle">
                <i class="ri-pinterest-fill fs-20"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="pinterestName" placeholder="Username" value="Advance Dave">
          </div>
        </div>
      </div>
      <!--end card-->
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center flex-wrap gap-3">
            <img class="img-fluid rounded-2 w-100px h-100px" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
            <div>
              <span class="fw-medium d-block mb-2">Profile Picture</span>
              <div class="btn-list mb-1">
                <button class="btn btn-sm btn-primary">
                  <i class="ri-upload-2-line me-1"></i>
                  Change Image
                </button>
                <button class="btn btn-sm btn-light-primary">
                  <i class="ri-delete-bin-line me-1"></i>
                  Remove
                </button>
              </div>
              <span class="d-block fs-12 text-muted">Use JPEG, PNG, or GIF. Best size: 200x200 pixels. Keep it under 5MB</span>
            </div>
          </div>
          <div class="row gy-3 mt-5">
            <div class="col-xl-6">
              <label for="profile-user-fname" class="form-label">First Name :</label>
              <input type="text" class="form-control" id="profile-user-fname" value="Pixy" placeholder="Enter Name">
            </div>
            <div class="col-xl-6">
              <label for="profile-user-lname" class="form-label">Last Name :</label>
              <input type="text" class="form-control" id="profile-user-lname" value="Krovasky" placeholder="Enter Name">
            </div>
            <div class="col-xl-6">
              <label for="profile-email" class="form-label">Email :</label>
              <input type="email" class="form-control" id="profile-email" value="sup.srbthemes@gmail.com" placeholder="Enter Email">
            </div>
            <div class="col-xl-6">
              <label for="profile-phn-no" class="form-label">Phone No :</label>
              <input type="text" class="form-control" id="profile-phn-no" value="4433222211" placeholder="Enter Number">
            </div>
            <div class="col-xl-6">
              <label for="profile-organization" class="form-label">Organization :</label>
              <input type="text" class="form-control" id="profile-organization" value="SRBThemes" placeholder="Enter Organization">
            </div>
            <div class="col-xl-6">
              <label for="profile-designation" class="form-label">Designation :</label>
              <input type="text" class="form-control" id="profile-designation" value="Developer" placeholder="Enter Designation">
            </div>
            <div class="col-xl-6">
              <label for="profile-language" class="form-label">Country :</label>
              <select id="language">
                <option value="united_states">United States</option>
                <option value="united_kingdom">United Kingdom</option>
                <option value="united_arab">United Arab</option>
              </select>
            </div>
            <div class="col-xl-6">
              <label for="profile-state" class="form-label">State :</label>
              <input type="text" class="form-control" id="profile-state" value="New York" placeholder="Enter State">
            </div>
            <div class="col-xl-6">
              <label for="profile-zip-code" class="form-label">Zip Code:</label>
              <input type="text" class="form-control" id="profile-zip-code" value="43367" placeholder="Enter Zip Code">
            </div>
            <div class="col-xl-6">
              <label for="website" class="form-label">Website :</label>
              <input type="text" class="form-control" id="website" placeholder="https://google.com" value="https://google.com">
            </div>
            <div class="col-xl-12">
              <label for="profile-address" class="form-label">Address :</label>
              <textarea class="form-control" id="profile-address" rows="3" placeholder="Address">Corverview, Michigan</textarea>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary float-end">Save Changes</button>
        </div>
      </div>

      <div class="card mb-0">
        <div class="card-header">
          <h5 class="card-title mb-0">Delete your account</h5>
        </div>

        <!-- Body -->
        <div class="card-body">
          <p class="card-text">When you delete your account, you lose access to Front account services, and we permanently delete your personal data. You can cancel the deletion for 14 days.</p>

          <div class="mb-4">
            <!-- Form Check -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="deleteAccountCheckbox" id="deleteAccountCheckbox">
              <label class="form-check-label" for="deleteAccountCheckbox">
                Confirm that I want to delete my account.
              </label>
            </div>
            <!-- End Form Check -->
          </div>

          <div class="d-flex justify-content-end gap-3">
            <a class="btn btn-white" href="#!">Learn more</a>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </div>
        <!-- End Body -->
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
