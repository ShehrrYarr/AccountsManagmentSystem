@extends('partials.layouts.master2')

    @section('title', 'Profile Notifications | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Profile Notifications' )
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
          <a class="nav-link" href="pages-profile-edit-billing-plans">Billing & Plans</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="pages-profile-edit-notifications">Notifications</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-edit-connections">Connections</a>
        </li>
      </ul>

    </div>
  </div>

  <!-- Tab panes -->
  <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap mb-4">
    <h5 class="fw-semibold m-0 hstack flex-wrap">My Connections<span class="text-muted fs-14 fw-lighter ms-3">(33)</span></h5>
    <select id="my_connections">
      <option value="active">Active</option>
      <option value="deactive">Deactive</option>
    </select>
  </div>
  <div class="card mb-0">
    <div class="card-header">
      <h5 class="card-title mb-0">Notifications</h5>
    </div>

    <div class="table-responsive">
      <table class="table table-thead-bordered table-nowrap table-align-middle mb-0">
        <thead class="bg-light bg-opacity-30">
          <tr>
            <th>Notification Type</th>
            <th class="text-center">Email</th>
            <th class="text-center">Browser</th>
            <th class="text-center">App</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>New Recommendations</td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifEmailNewRecommendations" id="notifEmailNewRecommendations">
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifBrowserNewRecommendations" id="notifBrowserNewRecommendations">
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifAppNewRecommendations" id="notifAppNewRecommendations">
            </td>
          </tr>
          <tr>
            <td>Account Activity</td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifEmailAccountActivity" id="notifEmailAccountActivity">
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifBrowserAccountActivity" id="notifBrowserAccountActivity" checked>
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifAppAccountActivity" id="notifAppAccountActivity" checked>
            </td>
          </tr>
          <tr>
            <td>New Browser Used for Sign-In</td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifEmailNewBrowser" id="notifEmailNewBrowser" checked>
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifBrowserNewBrowser" id="notifBrowserNewBrowser" checked>
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifAppNewBrowser" id="notifAppNewBrowser" checked>
            </td>
          </tr>
          <tr>
            <td>New Device Linked</td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifEmailNewDevice" id="notifEmailNewDevice">
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifBrowserNewDevice" id="notifBrowserNewDevice" checked>
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifAppNewDevice" id="notifAppNewDevice">
            </td>
          </tr>
          <tr>
            <td>New Device Connected</td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifEmailDeviceConnected" id="notifEmailDeviceConnected">
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifBrowserDeviceConnected" id="notifBrowserDeviceConnected" checked>
            </td>
            <td class="text-center">
              <input class="form-check-input" type="checkbox" value="notifAppDeviceConnected" id="notifAppDeviceConnected" checked>
            </td>
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
