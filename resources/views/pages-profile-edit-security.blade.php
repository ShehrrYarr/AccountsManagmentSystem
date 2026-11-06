@extends('partials.layouts.master2')

    @section('title', 'Profile Security | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Profile Security' )
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
          <a class="nav-link active" href="pages-profile-edit-security">Security</a>
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
  <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap mb-4">
    <h5 class="fw-semibold m-0 hstack flex-wrap">My Projects<span class="text-muted fs-14 fw-lighter ms-3">Active</span></h5>
    <select id="default-choice">
      <option value="all">All</option>
      <option value="active">Active</option>
      <option value="underReview">Under Review</option>
      <option value="onHold">On Hold</option>
      <option value="delayed">Delayed</option>
      <option value="inProgress">In Progress</option>
      <option value="pending">Pending</option>
      <option value="todo">To Do</option>
      <option value="completed">Completed</option>
    </select>
  </div>

  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">Change Password</h5>
    </div>
    <div class="card-body">
      <form>
        <div class="row">
          <div class="mb-5 col-md-6">
            <label class="form-label" for="currentPassword">Current Password</label>
            <div class="input-group">
              <input type="password" id="currentPassword" class="form-control" value="123456" name="password" placeholder="8+ characters required" required minlength="8" data-visible="false">
              <a class="input-group-text toggle-password" href="javascript:;" data-target="password">
                <i class="ri-eye-off-line text-muted toggle-icon"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="row g-5 mb-6">
          <div class="col-md-6">
            <label class="form-label" for="currentPassword">New Password</label>
            <div class="input-group">
              <input type="password" id="currentPassword" class="form-control" value="123456" name="password" placeholder="8+ characters required" required minlength="8" data-visible="false">
              <a class="input-group-text toggle-password" href="javascript:;" data-target="password">
                <i class="ri-eye-off-line text-muted toggle-icon"></i>
              </a>
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="newPassword001">Conform Password</label>
            <div class="input-group">
              <input type="password" id="newPassword001" class="form-control" value="123456" name="password" placeholder="8+ characters required" required minlength="8" data-visible="false">
              <a class="input-group-text toggle-password" href="javascript:;" data-target="password">
                <i class="ri-eye-off-line text-muted toggle-icon"></i>
              </a>
            </div>
          </div>
        </div>
        <h6 class="text-body mb-4">Password Requirements:</h6>
        <ul class="ps-4 mb-0">
          <li class="mb-2">Minimum 8 characters long - the more, the better</li>
          <li class="mb-2">At least one lowercase character</li>
          <li>At least one number, symbol, or whitespace character</li>
        </ul>
        <div class="mt-6">
          <button type="submit" class="btn btn-primary me-3">Save changes</button>
          <button type="reset" class="btn btn-outline-secondary">Reset</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="d-flex align-items-center">
        <h5 class="card-title mb-0">Two-step verification</h5>
        <span class="badge bg-danger-subtle text-danger ms-2">Disabled</span>
      </div>
    </div>

    <div class="card-body">
      <p class="card-text">Start by entering your password so that we know it's you. Then we'll walk you through two more simple steps.</p>

      <form>
        <div class="row mb-4">
          <label for="accountPasswordLabel" class="col-sm-3 col-form-label form-label">Account password</label>

          <div class="col-sm-9">
            <input type="password" class="form-control" name="currentPassword" id="accountPasswordLabel" placeholder="Enter current password" aria-label="Enter current password">
            <small class="form-text">This is the password you use to log in to your Front account.</small>
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary">Set up</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card mb-0">
    <div class="card-header">
      <h5 class="card-title mb-0">Recent Devices</h5>
    </div>

    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th class="text-truncate">Browser</th>
            <th class="text-truncate">Device</th>
            <th class="text-truncate">Location</th>
            <th class="text-truncate">Recent Activities</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-truncate">
              <div class="hstack flex-wrap">
                <i class="ri-macbook-line text-warning me-3"></i>
                <span>Chrome on Windows</span>
              </div>
            </td>
            <td class="text-truncate">HP Spectre x360</td>
            <td class="text-truncate">Switzerland</td>
            <td class="text-truncate">Logged in to manage files</td>
          </tr>
          <tr>
            <td class="text-truncate">
              <div class="hstack flex-wrap">
                <i class="ri-android-line text-success me-3"></i>
                <span>Chrome on iPhone</span>
              </div>
            </td>
            <td class="text-truncate">iPhone 12 Pro</td>
            <td class="text-truncate">Australia</td>
            <td class="text-truncate">Checked emails and notifications</td>
          </tr>
          <tr>
            <td class="text-truncate">
              <div class="hstack flex-wrap">
                <i class="ri-smartphone-line text-danger me-3"></i>
                <span>Chrome on Android</span>
              </div>
            </td>
            <td class="text-truncate">OnePlus 9 Pro</td>
            <td class="text-truncate">Dubai</td>
            <td class="text-truncate">Browsed social media</td>
          </tr>
          <tr>
            <td class="text-truncate">
              <div class="hstack flex-wrap">
                <i class="ri-mac-line text-info me-3"></i>
                <span>Chrome on macOS</span>
              </div>
            </td>
            <td class="text-truncate">Apple iMac</td>
            <td class="text-truncate">India</td>
            <td class="text-truncate">Updated software and settings</td>
          </tr>
          <tr>
            <td class="text-truncate">
              <div class="hstack flex-wrap">
                <i class="ri-macbook-line text-warning me-3"></i>
                <span>Chrome on Windows</span>
              </div>
            </td>
            <td class="text-truncate">HP Spectre x360</td>
            <td class="text-truncate">Switzerland</td>
            <td class="text-truncate">Reviewed documents for a meeting</td>
          </tr>
          <tr class="border-transparent">
            <td class="text-truncate">
              <div class="hstack flex-wrap">
                <i class="ri-android-line text-success me-3"></i>
                <span>Chrome on Android</span>
              </div>
            </td>
            <td class="text-truncate">OnePlus 9 Pro</td>
            <td class="text-truncate">Dubai</td>
            <td class="text-truncate">Sent messages and made calls</td>
          </tr>
        </tbody>
      </table>
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
