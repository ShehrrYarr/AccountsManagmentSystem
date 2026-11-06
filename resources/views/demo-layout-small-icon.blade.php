@extends('partials.layouts.master')

@section('title', 'Small Icon Layout | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')

@section('sub-title', 'Course Overview')
@section('pagetitle', 'Dashboard')
@section('buttonTitle', 'View Course')
@section('link', 'apps-my-course')

@section('css')
@include('partials.head-css', ['smallicon' => 'layout-smallicon'])

<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
@endsection

@section('content')


  <div class="row h-100">
    <!-- Total Students Enrolled Section -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card card-h-100 overflow-hidden">
        <div class="card-body p-4 flex-fill h-100 d-flex gap-4 flex-column justify-content-between">
          <div>
            <h6 class="mb-2 fs-12">Total Students</h6>
            <h4 class="fw-medium mb-1"><span data-target="328" data-duration="5" data-suffix="k">328</span></h4>
          </div>
          <div>
            <div class="progress progress-xs animated-progess">
              <div class="progress-bar bg-primary w-75"></div>
            </div>
            <div class="text-muted fs-12 mt-3"><span class="text-success">75% <i class="ri-arrow-up-line fs-16 me-1"></i></span> growth in students</div>
          </div>
        </div>
      </div>
    </div>

    <!-- New Students Section -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card card-h-100 overflow-hidden">
        <div class="card-body p-4 flex-fill h-100 d-flex gap-4 flex-column justify-content-between">
          <div>
            <h6 class="mb-2 fs-12">New Students</h6>
            <h4 class="fw-medium mb-1"><span data-target="2450" data-duration="5">2450</span></h4>
          </div>
          <div>
            <div class="progress progress-xs animated-progess">
              <div class="progress-bar bg-danger w-50"></div>
            </div>
            <div class="text-muted fs-12 mt-3"><span class="text-danger">50% <i class="ri-arrow-up-line fs-16 me-1"></i></span> growth this month</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Earnings Section -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card card-h-100 overflow-hidden">
        <div class="card-body p-4 flex-fill h-100 d-flex gap-4 flex-column justify-content-between">
          <div>
            <h6 class="mb-2 fs-12">Total Earnings</h6>
            <h4 class="fw-medium mb-1"><span data-target="25160" data-duration="5" data-suffix="$">25160</span></h4>
          </div>
          <div>
            <div class="progress progress-xs animated-progess">
              <div class="progress-bar bg-success w-20"></div>
            </div>
            <div class="text-muted fs-12 mt-3"><span class="text-success">20% <i class="ri-arrow-up-line fs-16 me-1"></i></span> earnings increase</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Student Engagement Section -->
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="card card-h-100 overflow-hidden">
        <div class="card-body p-4 flex-fill h-100 d-flex gap-4 flex-column justify-content-between">
          <div>
            <h6 class="mb-2 fs-12">Engagement Rate</h6>
            <h4 class="fw-medium mb-1"><span data-target="72" data-duration="5">72%</span></h4>
          </div>
          <div>
            <div class="progress progress-xs animated-progess">
              <div class="progress-bar bg-info w-75"></div>
            </div>
            <div class="text-muted fs-12 mt-3"><span class="text-info">75% <i class="ri-arrow-up-line fs-16 me-1"></i></span> engagement rate</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-6 col-lg-8">
      <div class="card card-h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="flex-grow-1">
            <h5 class="mb-1">Visits by Day</h5>
            <p class="mb-0 card-subtitle">Total 248.5k Visits</p>
          </div>
          <div class="flex-shrink-0">
            <button type="button" class="btn btn-outline-primary btn-sm active">
              1W
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm">
              1M
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm">
              6M
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm">
              1Y
            </button>
          </div>
        </div>
        <div class="card-body">
          <div id="totalVisitedViewsChart"></div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="card card-h-100">
        <div class="card-header hstack justify-content-between gap-3">
          <h5 class="card-title mb-0">Teachers List</h5>
          <a href="apps-chat" class="btn btn-light-primary btn-sm">Chat</a>
        </div>

        <div class="card-body">
          <ul class="list-group fs-13 fw-medium list-group-flush">
            <!-- Teacher 1 -->
            <li class="list-group-item d-flex hstack rounded px-0 pt-0">
              <div class="avatar avatar-item border-0 overflow-hidden me-3 flex-shrink-0">
                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="user Image">
              </div>
              <div class="d-flex align-items-center flex-row-fluid flex-grow-1">
                <div class="flex-grow-1 me-2">
                  <a href="#!" class="fs-6 fw-bold text-body">Bess Willis <small class="text-muted">( M.Com )</small></a>
                  <span class="text-danger fw-medium d-block fs-12">Not Available</span>
                </div>
                <button type="button" class="btn btn-text-primary rounded-circle icon-btn-sm flex-shrink-0" data-bs-toggle="dropdown">
                  <i class="ri-more-2-line fs-14 fw-semibold"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="apps-chat">Send Message</a></li>
                  <li><a class="dropdown-item" href="pages-profile-overview">View Profile</a></li>
                  <li><a class="dropdown-item" href="apps-calendar">Schedule Meeting</a></li>
                </ul>
              </div>
            </li>

            <!-- Teacher 2 -->
            <li class="list-group-item d-flex hstack rounded px-0">
              <div class="avatar avatar-item border-0 overflow-hidden me-3 flex-shrink-0">
                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="user Image">
              </div>
              <div class="d-flex align-items-center flex-row-fluid flex-grow-1">
                <div class="flex-grow-1 me-2">
                  <a href="#!" class="fs-6 fw-bold text-body">John Smith <small class="text-muted">( M.Sc )</small></a>
                  <span class="text-success fw-medium d-block fs-12">Available</span>
                </div>
                <button type="button" class="btn btn-text-primary rounded-circle icon-btn-sm flex-shrink-0" data-bs-toggle="dropdown">
                  <i class="ri-more-2-line fs-14 fw-semibold"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="apps-chat">Send Message</a></li>
                  <li><a class="dropdown-item" href="pages-profile-overview">View Profile</a></li>
                  <li><a class="dropdown-item" href="apps-calendar">Schedule Meeting</a></li>
                </ul>
              </div>
            </li>

            <!-- Teacher 3 -->
            <li class="list-group-item d-flex hstack rounded px-0">
              <div class="avatar avatar-item border-0 overflow-hidden me-3 flex-shrink-0">
                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image">
              </div>
              <div class="d-flex align-items-center flex-row-fluid flex-grow-1">
                <div class="flex-grow-1 me-2">
                  <a href="#!" class="fs-6 fw-bold text-body">Sophia Adams <small class="text-muted">( Ph.D )</small></a>
                  <span class="text-warning fw-medium d-block fs-12">Away</span>
                </div>
                <button type="button" class="btn btn-text-primary rounded-circle icon-btn-sm flex-shrink-0" data-bs-toggle="dropdown">
                  <i class="ri-more-2-line fs-14 fw-semibold"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="apps-chat">Send Message</a></li>
                  <li><a class="dropdown-item" href="pages-profile-overview">View Profile</a></li>
                  <li><a class="dropdown-item" href="apps-calendar">Schedule Meeting</a></li>
                </ul>
              </div>
            </li>

            <!-- Teacher 4 -->
            <li class="list-group-item d-flex hstack rounded px-0">
              <div class="avatar avatar-item border-0 overflow-hidden me-3 flex-shrink-0">
                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="user Image">
              </div>
              <div class="d-flex align-items-center flex-row-fluid flex-grow-1">
                <div class="flex-grow-1 me-2">
                  <a href="#!" class="fs-6 fw-bold text-body">Mark Johnson <small class="text-muted">( B.A. English )</small></a>
                  <span class="text-danger fw-medium d-block fs-12">Not Available</span>
                </div>
                <button type="button" class="btn btn-text-primary rounded-circle icon-btn-sm flex-shrink-0" data-bs-toggle="dropdown">
                  <i class="ri-more-2-line fs-14 fw-semibold"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="apps-chat">Send Message</a></li>
                  <li><a class="dropdown-item" href="pages-profile-overview">View Profile</a></li>
                  <li><a class="dropdown-item" href="apps-calendar">Schedule Meeting</a></li>
                </ul>
              </div>
            </li>

            <!-- Teacher 5 -->
            <li class="list-group-item d-flex hstack rounded px-0">
              <div class="avatar avatar-item border-0 overflow-hidden me-3 flex-shrink-0">
                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="user Image">
              </div>
              <div class="d-flex align-items-center flex-row-fluid flex-grow-1">
                <div class="flex-grow-1 me-2">
                  <a href="#!" class="fs-6 fw-bold text-body">Ella Davis <small class="text-muted">( M.Ed )</small></a>
                  <span class="text-success fw-medium d-block fs-12">Available</span>
                </div>
                <button type="button" class="btn btn-text-primary rounded-circle icon-btn-sm flex-shrink-0" data-bs-toggle="dropdown">
                  <i class="ri-more-2-line fs-14 fw-semibold"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="apps-chat">Send Message</a></li>
                  <li><a class="dropdown-item" href="pages-profile-overview">View Profile</a></li>
                  <li><a class="dropdown-item" href="apps-calendar">Schedule Meeting</a></li>
                </ul>
              </div>
            </li>

            <!-- Teacher 6 -->
            <li class="list-group-item d-flex hstack rounded px-0 pb-0">
              <div class="avatar avatar-item border-0 overflow-hidden me-3 flex-shrink-0">
                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="user Image">
              </div>
              <div class="d-flex align-items-center flex-row-fluid flex-grow-1">
                <div class="flex-grow-1 me-2">
                  <a href="#!" class="fs-6 fw-bold text-body">David Lee <small class="text-muted">( M.S. Computer Science )</small></a>
                  <span class="text-warning fw-medium d-block fs-12">Away</span>
                </div>
                <button type="button" class="btn btn-text-primary rounded-circle icon-btn-sm flex-shrink-0" data-bs-toggle="dropdown">
                  <i class="ri-more-2-line fs-14 fw-semibold"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="apps-chat">Send Message</a></li>
                  <li><a class="dropdown-item" href="pages-profile-overview">View Profile</a></li>
                  <li><a class="dropdown-item" href="apps-calendar">Schedule Meeting</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-0">
    <table class="dt-student-list table-nowrap align-middle table w-100">
      <thead class="bg-light bg-opacity-30">
        <tr>
          <th class="px-5"></th>
          <th class="w-64px">Roll No.</th>
          <th>Name</th>
          <th>Course</th>
          <th>Phone Number</th>
          <th>Gender</th>
          <th class="text-truncate">Date of Join</th>
          <th>Email</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>

  <div class="modal fade" id="edit-student-profile" tabindex="-1" role="dialog" aria-labelledby="edit-student-profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Student Profile</h5>
          <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
            <i class="ri-close-large-line fw-semibold"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center flex-wrap gap-3 mb-5">
            <div class="avatar-item avatar-xl overflow-hidden">
              <img class="img-fluid" alt="avatar image" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}">
            </div>
            <div>
              <div class="hstack gap-3 mb-3">
                <button class="btn btn-sm btn-light-primary">Upload</button>
                <button class="btn btn-sm btn-danger">Remove</button>
              </div>
              <p class="mb-0 text-muted fs-13">Upload image size 4MB, Format JPG, PNG, SVG</p>
            </div>
          </div>
          <div class="row g-4">
            <div class="col-sm-6">
              <label class="form-label" for="teacher-name">Name</label>
              <input type="text" class="form-control" id="teacher-name" placeholder="Enter your name">
            </div>

            <div class="col-sm-6">
              <label class="form-label" for="teacher-designation">Designation</label>
              <input type="text" class="form-control" id="teacher-designation" placeholder="Enter your designation">
            </div>

            <div class="col-sm-6">
              <label class="form-label" for="teacher-email">Email</label>
              <input type="email" class="form-control" id="teacher-email" placeholder="Enter your email">
            </div>

            <div class="col-sm-6">
              <label class="form-label" for="teacher-phone">Phone Number</label>
              <input type="number" class="form-control" id="teacher-phone" placeholder="Enter your phone number">
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')

  <!-- Countup init -->
  <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

  <!-- ApexChat js -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>

  <!-- Course overview init -->
  <script src="{{ asset('assets/js/apps/course/apps-course-overview.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

  @endsection