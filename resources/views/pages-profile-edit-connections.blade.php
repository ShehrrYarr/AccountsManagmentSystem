@extends('partials.layouts.master2')

    @section('title', 'Profile Connections | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Profile Connections' )
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
          <a class="nav-link" href="pages-profile-edit-notifications">Notifications</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="pages-profile-edit-connections">Connections</a>
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

  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">Connected accounts</h5>
    </div>

    <form>
      <div class="list-group list-group-flush">
        <div class="list-group-item">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img class="avatar" src="{{ asset('assets/images/profile/google-icon.svg') }}" alt="Google">
            </div>
            <div class="flex-grow-1 ms-3">
              <div class="row g-3 align-items-center">
                <div class="col">
                  <h5 class="mb-0">Google</h5>
                  <p class="text-muted mb-0">Calendar and contacts</p>
                </div>
                <div class="col-auto">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="connectedAccountsGoogle">
                    <label class="form-check-label" for="connectedAccountsGoogle"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img class="avatar" src="{{ asset('assets/images/profile/spec-icon.svg') }}" alt="Spec">
            </div>
            <div class="flex-grow-1 ms-3">
              <div class="row g-3 align-items-center">
                <div class="col">
                  <h5 class="mb-0">Spec</h5>
                  <p class="text-muted mb-0">Project management</p>
                </div>
                <div class="col-auto">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="connectedAccountsSpec">
                    <label class="form-check-label" for="connectedAccountsSpec"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img class="avatar" src="{{ asset('assets/images/profile/slack-icon.svg') }}" alt="Slack">
            </div>
            <div class="flex-grow-1 ms-3">
              <div class="row g-3 align-items-center">
                <div class="col">
                  <h5 class="mb-0">Slack</h5>
                  <p class="text-muted mb-0">Communication <a class="link" href="#!">Learn more</a></p>
                </div>
                <div class="col-auto">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="connectedAccountsSlack" checked>
                    <label class="form-check-label" for="connectedAccountsSlack"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img class="avatar" src="{{ asset('assets/images/profile/mailchimp-icon.svg') }}" alt="Mailchimp">
            </div>
            <div class="flex-grow-1 ms-3">
              <div class="row g-3 align-items-center">
                <div class="col">
                  <h5 class="mb-0">Mailchimp</h5>
                  <p class="text-muted mb-0">Email marketing service</p>
                </div>
                <div class="col-auto">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="connectedAccountsMailchimp" checked>
                    <label class="form-check-label" for="connectedAccountsMailchimp"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
              <img class="avatar" src="{{ asset('assets/images/profile/google-webdev-icon.svg') }}" alt="Google Webdev">
            </div>
            <div class="flex-grow-1 ms-3">
              <div class="row g-3 align-items-center">
                <div class="col">
                  <h5 class="mb-0">Google Webdev</h5>
                  <p class="text-muted mb-0">Tools for Web Developers <a class="link" href="#!">Learn more</a></p>
                </div>
                <div class="col-auto">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="connectedAccountsWebdev">
                    <label class="form-check-label" for="connectedAccountsWebdev"></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="card mb-0">
    <div class="card-header">
      <h5 class="card-title mb-0">Social accounts</h5>
    </div>

    <form>
      <div class="list-group list-group-flush">
        <div class="list-group-item">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">Twitter</h5>
              <a href="#!" class="mb-0">www.twitter.com/srbthemes</a>
            </div>
            <div class="col-sm-auto">
              <button type="button" class="btn btn-sm btn-light-primary custom-toggle active" aria-pressed="true">
                <span class="icon-on">Connect</span>
                <span class="icon-off">Disconnect</span>
              </button>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">Facebook</h5>
              <a href="#!" class="mb-0">www.facebook.com/srbthemes</a>
            </div>
            <div class="col-sm-auto">
              <button type="button" class="btn btn-sm btn-light-primary custom-toggle active" aria-pressed="true">
                <span class="icon-on">Connect</span>
                <span class="icon-off">Disconnect</span>
              </button>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">Slack</h5>
              <p class="text-muted mb-0">Not connected</p>
            </div>
            <div class="col-sm-auto">
              <button type="button" class="btn btn-sm btn-light-primary custom-toggle" aria-pressed="false">
                <span class="icon-on">Connect</span>
                <span class="icon-off">Disconnect</span>
              </button>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">Linkedin</h5>
              <a href="#!" class="mb-0">www.linkedin.com/srbthemes</a>
            </div>
            <div class="col-sm-auto">
              <button type="button" class="btn btn-sm btn-light-primary custom-toggle" aria-pressed="false">
                <span class="icon-on">Connect</span>
                <span class="icon-off">Disconnect</span>
              </button>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="row g-3 align-items-center">
            <div class="col">
              <h5 class="mb-0">Google</h5>
              <p class="text-muted mb-0">Not connected</p>
            </div>
            <div class="col-sm-auto">
              <button type="button" class="btn btn-sm btn-light-primary custom-toggle active" aria-pressed="true">
                <span class="icon-on">Connect</span>
                <span class="icon-off">Disconnect</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
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

