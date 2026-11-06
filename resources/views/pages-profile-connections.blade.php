@extends('partials.layouts.master2')

    @section('title', 'Profile Connections | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Profile Connections' )
    @section('pagetitle', 'Chart')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">

@endsection
    @section('content')

  <div class="card">
    <div class="card-body pb-0">
      @include('partials.pages-profile-user-section')
    
      <!-- Nav tabs -->
      <ul class="nav nav-tabs-bordered border-0 justify-content-center mt-5" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-overview">Overview</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-project">Project</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-documents">Documents</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="pages-profile-connections">Connections</a>
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
  <div class="row g-4">

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown1">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Emily Davis">
            </div>
            <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
          </div>
          <h5 class="fw-semibold mb-1 text-body-emphasis">Emily Davis</h5>
          <span class="d-block fw-medium text-muted mb-2">Lead UI/UX Designer</span>
          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>Berlin
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>Germany
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">120 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown2">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>
        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Jacob Weber">
            </div>
          </div>
          <h5 class="fw-semibold mb-1 text-body-emphasis">Jacob Weber</h5>
          <span class="d-block fw-medium text-muted mb-2">Senior Data Scientist</span>
          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>Munich
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>Germany
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">75 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown3">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>
        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg border-0 avatar-title text-info fs-20 bg-info-subtle">K</div>
            <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
          </div>
          <h5 class="fw-semibold mb-1 text-body-emphasis">Kara Matthews</h5>
          <span class="d-block fw-medium text-muted mb-2">Product Marketing Lead</span>
          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>Hamburg
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>Germany
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">50 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown4" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown4">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Olivia Harris">
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">Olivia Harris</h5>
          <span class="d-block fw-medium text-muted mb-2">Chief Marketing Officer</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>London
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>UK
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">350 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown5" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown5">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Lucas Martin">
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">Lucas Martin</h5>
          <span class="d-block fw-medium text-muted mb-2">Data Analytics Specialist</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>Paris
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>France
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">180 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown6" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown6">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Sophia Lee">
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">Sophia Lee</h5>
          <span class="d-block fw-medium text-muted mb-2">HR Manager</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>Tokyo
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>Japan
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">200 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown7" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown7">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="Daniel Kim">
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">Daniel Kim</h5>
          <span class="d-block fw-medium text-muted mb-2">Project Manager</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>Seoul
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>South Korea
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">230 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown9" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown9">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="Ava Thompson">
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">Ava Thompson</h5>
          <span class="d-block fw-medium text-muted mb-2">Software Engineer</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>San Francisco
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>USA
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">300 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown10" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown10">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="James Clark">
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">James Clark</h5>
          <span class="d-block fw-medium text-muted mb-2">Creative Director</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>Sydney
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>Australia
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">270 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown2">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg border-0 avatar-title text-primary bg-primary-subtle fs-20">
              JH
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">Jessica Hall</h5>
          <span class="d-block fw-medium text-muted mb-2">UX/UI Designer</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>New York
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>USA
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">350 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown3">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg">
              <img class="img-fluid avatar-lg rounded-circle border-none shadow" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Ryan Cooper">
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">Ryan Cooper</h5>
          <span class="d-block fw-medium text-muted mb-2">Data Scientist</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>San Francisco
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>USA
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">500 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 h-100">
        <div class="dropdown position-absolute top-0 end-0 m-3">
          <button type="button" class="btn btn-link btn-text-primary btn-icon btn-sm rounded-circle" id="connectionsDropdown4" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ri-more-2-line fw-semibold"></i>
          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="connectionsDropdown4">
            <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share Profile</a>
            <a class="dropdown-item" href="#!">Block Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item delete-item" href="#!">Remove</a>
          </div>
        </div>

        <div class="card-body text-center">
          <div class="position-relative w-max mx-auto mb-4">
            <div class="avatar-item avatar-lg border-0 avatar-title text-white bg-danger fs-20">
              DL
            </div>
          </div>

          <h5 class="fw-semibold mb-1 text-body-emphasis">Dylan Lee</h5>
          <span class="d-block fw-medium text-muted mb-2">Product Manager</span>

          <p class="fs-12 mb-0 text-muted">
            <span class="me-3">
              <i class="ri-building-line me-1 align-middle"></i>Chicago
            </span>
            <span>
              <i class="ri-map-pin-line me-1 align-middle"></i>USA
            </span>
          </p>

          <button class="btn btn-light-primary btn-sm mt-4 px-4">View Profile</button>
        </div>

        <div class="card-footer py-3">
          <div class="row justify-content-between align-items-center">
            <div class="col-auto py-1">
              <button type="button" class="btn btn-outline-primary btn-sm custom-toggle" aria-pressed="false">
                <span class="icon-on">
                  <i class="ri-add-line align-bottom me-1"></i> Unfollow
                </span>
                <span class="icon-off">
                  <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
                </span>
              </button>
            </div>
            <div class="col-auto py-1">
              <a class="fs-6 text-body fs-12" href="#!">120 Connections</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="d-flex flex-center mt-4">
    <button class="btn btn-primary">
      Show more
    </button>
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