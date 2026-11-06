@extends('partials.layouts.master')

@section('title', 'Compact Layout | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')

@section('sub-title', 'To Do')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'Add Task')
@section('modalTarget', 'addTasksModal')

@section('css')
@include('partials.head-css', ['compact' => 'layout-compact'])

<link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
@endsection

@section('content')



  <div class="apps-todo">

    <div class="row">
      <div class="col-12 col-lg-6 col-xl-4">
        <div class="card card-h-100">
          <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
            <h5 class="card-title mb-0 flex-grow-1">Team Memebers</h5>
            <a href="apps-chat" class="btn btn-light btn-sm flex-shrink-0">Chat</a>
          </div>

          <div class="card-body py-5">
            <ul class="list-group fs-13 list-group-flush">
              <li class="list-group-item d-flex hstack rounded px-0 pt-0">
                <div class="avatar-item border-0 avatar avatar-title text-white bg-danger me-3 flex-shrink-0">JD</div>
                <div class="d-flex align-items-center flex-row-fluid flex-wrap flex-grow-1">
                  <div class="flex-grow-1 me-2">
                    <a href="#!" class="fs-6 fw-semibold text-body">John Doe</a>
                    <span class="text-muted fw-medium d-block fs-12">Web Designer</span>
                  </div>
                  <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                  </button>
                </div>
              </li>
              <li class="list-group-item d-flex hstack rounded px-0">
                <div class="avatar-item border-0 avatar avatar-title text-white bg-success me-3 flex-shrink-0">EJ</div>
                <div class="d-flex align-items-center flex-row-fluid flex-wrap flex-grow-1">
                  <div class="flex-grow-1 me-2">
                    <a href="#!" class="fs-6 fw-semibold text-body">Emily Johnson</a>
                    <span class="text-muted fw-medium d-block fs-12">JavaScript Developer</span>
                  </div>
                  <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                  </button>
                </div>
              </li>
              <li class="list-group-item d-flex hstack rounded px-0">
                <div class="avatar-item border-0 avatar avatar-title text-white bg-info me-3 flex-shrink-0">AS</div>
                <div class="d-flex align-items-center flex-row-fluid flex-wrap flex-grow-1">
                  <div class="flex-grow-1 me-2">
                    <a href="#!" class="fs-6 fw-semibold text-body">Alice Smith</a>
                    <span class="text-muted fw-medium d-block fs-12">UI/UX Designer</span>
                  </div>
                  <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                  </button>
                </div>
              </li>
              <li class="list-group-item d-flex hstack rounded px-0">
                <div class="avatar-item border-0 avatar avatar-title text-white bg-warning me-3 flex-shrink-0">MJ</div>
                <div class="d-flex align-items-center flex-row-fluid flex-wrap flex-grow-1">
                  <div class="flex-grow-1 me-2">
                    <a href="#!" class="fs-6 fw-semibold text-body">Michael Jackson</a>
                    <span class="text-muted fw-medium d-block fs-12">Marketing Specialist</span>
                  </div>
                  <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                  </button>
                </div>
              </li>
              <li class="list-group-item d-flex hstack rounded px-0">
                <div class="avatar-item border-0 avatar avatar-title text-white bg-primary me-3 flex-shrink-0">RG</div>
                <div class="d-flex align-items-center flex-row-fluid flex-wrap flex-grow-1">
                  <div class="flex-grow-1 me-2">
                    <a href="#!" class="fs-6 fw-semibold text-body">Rachel Green</a>
                    <span class="text-muted fw-medium d-block fs-12">Product Manager</span>
                  </div>
                  <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                  </button>
                </div>
              </li>
              <li class="list-group-item d-flex hstack rounded px-0 pb-0">
                <div class="avatar-item border-0 avatar avatar-title bg-secondary-subtle text-secondary me-3 flex-shrink-0">LP</div>
                <div class="d-flex align-items-center flex-row-fluid flex-wrap flex-grow-1">
                  <div class="flex-grow-1 me-2">
                    <a href="#!" class="fs-6 fw-semibold text-body">Liam Peters</a>
                    <span class="text-muted fw-medium d-block fs-12">Back-End Developer</span>
                  </div>
                  <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                    <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-4">
        <div class="card card-h-100 overflow-hidden">
          <div class="card-header hstack justify-content-between gap-3">
            <h5 class="card-title mb-0">Weekly Report</h5>
            <a href="#!" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTasksModal">Create Task</a>
          </div>
          <div class="card-body h-100">
            <ul class="nav nav-pills nav-justified gap-2 flex-nowrap mb-8 overflow-x-hide-scroll" role="tablist">
              <li class="nav-item p-0 ms-0" role="presentation">
                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 active" data-bs-toggle="tab" href="#weekly-report-1" aria-selected="false" role="tab" tabindex="-1">
                  <span class="fs-12 fw-semibold">Su</span>
                  <span class="fs-14 fw-semibold">22</span>
                </a>
              </li>
              <li class="nav-item p-0 ms-0" role="presentation">
                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3" data-bs-toggle="tab" href="#weekly-report-2" aria-selected="false" role="tab" tabindex="-1">
                  <span class="fs-12 fw-semibold">Mo</span>
                  <span class="fs-14 fw-semibold">23</span>
                </a>
              </li>
              <li class="nav-item p-0 ms-0" role="presentation">
                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3" data-bs-toggle="tab" href="#weekly-report-3" aria-selected="false" role="tab" tabindex="-1">
                  <span class="fs-12 fw-semibold">Tu</span>
                  <span class="fs-14 fw-semibold">24</span>
                </a>
              </li>
              <li class="nav-item p-0 ms-0" role="presentation">
                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3" data-bs-toggle="tab" href="#weekly-report-4" aria-selected="false" tabindex="-1" role="tab">
                  <span class="fs-12 fw-semibold">We</span>
                  <span class="fs-14 fw-semibold">25</span>
                </a>
              </li>
              <li class="nav-item p-0 ms-0" role="presentation">
                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3" data-bs-toggle="tab" href="#weekly-report-5" aria-selected="false" tabindex="-1" role="tab">
                  <span class="fs-12 fw-semibold">Th</span>
                  <span class="fs-14 fw-semibold">26</span>
                </a>
              </li>
              <li class="nav-item p-0 ms-0" role="presentation">
                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3" data-bs-toggle="tab" href="#weekly-report-6" aria-selected="false" tabindex="-1" role="tab">
                  <span class="fs-12 fw-semibold">Fri</span>
                  <span class="fs-14 fw-semibold">27</span>
                </a>
              </li>
              <li class="nav-item p-0 ms-0" role="presentation">
                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3" data-bs-toggle="tab" href="#weekly-report-7" aria-selected="false" role="tab" tabindex="-1">
                  <span class="fs-12 fw-semibold">Sa</span>
                  <span class="fs-14 fw-semibold">28</span>
                </a>
              </li>
            </ul>

            <div class="tab-content mb-2">
              <div class="tab-pane fade active show" id="weekly-report-1" role="tabpanel">

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-primary flex-shrink-0"></span>
                  <div class="flex-grow-1 overflow-hidden me-5">
                    <h5 class="fw-semibold mb-0">11:30 - 12:00<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1 text-truncate">Develop User Authentication System</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Alice Johnson</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-success"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">12:15 - 12:45<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Implement Frontend Features for Dashboard</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">John Doe</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center">
                  <span class="bullet d-flex align-items-center me-4 bg-warning"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">1:00 - 1:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Optimize Database Queries for Performance</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Michael Green</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>
              </div>
              <div class="tab-pane fade" id="weekly-report-2" role="tabpanel">
                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-info"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">9:30 - 10:00<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Design Login Page UI</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Emma Clark</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-danger"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">10:15 - 10:45<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Set up API Authentication</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">James Porter</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-dark"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">11:00 - 11:30<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Create User Profile Page</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Sophia Lee</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>
              </div>
              <div class="tab-pane fade" id="weekly-report-3" role="tabpanel">
                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-warning"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">8:00 - 8:30<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Improve API Response Times</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Robert Smith</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-secondary"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">10:00 - 10:30<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Implement Payment Gateway</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">David Miller</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-success"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">1:30 - 2:00<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Test and Debug Backend Code</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Rachel Green</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>
              </div>
              <div class="tab-pane fade " id="weekly-report-4" role="tabpanel">
                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-primary"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">3:00 - 3:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Update Frontend Styles for Dashboard</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Benjamin Scott</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-info"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">4:00 - 4:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Integrate 3rd Party APIs</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Liam Harris</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-danger"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">5:00 - 5:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Conduct Code Review and Refactor</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Isabella Moore</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>
              </div>
              <div class="tab-pane fade " id="weekly-report-5" role="tabpanel">
                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-success"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">10:45 - 11:15<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Create Mockups for New Feature</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Olivia Brown</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-primary"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">12:00 - 12:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Set Up New Database Schema</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Ethan Wright</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-warning"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">2:00 - 2:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Fix Bugs in User Authentication</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Lucas Miller</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>
              </div>
              <div class="tab-pane fade " id="weekly-report-6" role="tabpanel">
                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-info"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">8:30 - 9:00<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Develop New Chat Feature</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Mia Williams</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-danger"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">1:00 - 1:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Refactor User Profile Code</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Samuel Davis</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-secondary"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">3:45 - 4:15<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Optimize App for Mobile Devices</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Charlotte Evans</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>
              </div>
              <div class="tab-pane fade" id="weekly-report-7" role="tabpanel">
                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-primary"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">7:45 - 8:15<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Implement User Notification System</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Jack Thompson</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-warning"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">9:30 - 10:00<span class="text-muted fw-semibold fs-12 ms-1">AM </span></h5>
                    <div class="fw-medium mb-1">Enhance Data Security Features</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Sophia Clark</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>

                <div class="d-flex align-items-center mb-6">
                  <span class="bullet d-flex align-items-center me-4 bg-info"></span>
                  <div class="flex-grow-1 me-5">
                    <h5 class="fw-semibold mb-0">12:00 - 12:30<span class="text-muted fw-semibold fs-12 ms-1">PM </span></h5>
                    <div class="fw-medium mb-1">Test Frontend User Interface</div>
                    <div class="text-muted fw-medium fs-12">Lead by
                      <a href="#!" class="fw-semibold">Zoe Harris</a>
                    </div>
                  </div>
                  <a href="#!" class="btn btn-sm btn-light-primary">View</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-4">
        <div class="card card-h-100">
          <div class="card-header hstack justify-content-between gap-3">
            <h5 class="card-title mb-0">Tasks Summary</h5>
            <a href="#!" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTasksModal">Create Task</a>
          </div>
          <div class="card-body px-2 py-4">
            <div class="vstack">
              <div id="task-overview" class="position-relative d-flex flex-center h-175px w-175px me-10 mb-7 flex-shrink-0"></div>
              <div class="d-flex flex-column justify-content-center flex-row-fluid flex-grow-1 px-4 px-lg-10">
                <div class="d-flex fs-6 fw-semibold align-items-center mb-2">
                  <div class="bullet bg-primary me-3"></div>
                  <div class="fw-normal">Todo</div>
                  <div class="ms-auto fw-bold">25</div>
                </div>

                <div class="d-flex fs-6 fw-semibold align-items-center mb-2">
                  <div class="bullet bg-info me-3"></div>
                  <div class="fw-normal">In Progress</div>
                  <div class="ms-auto fw-bold">13</div>
                </div>

                <div class="d-flex fs-6 fw-semibold align-items-center mb-2">
                  <div class="bullet bg-danger me-3"></div>
                  <div class="fw-normal">On Hold</div>
                  <div class="ms-auto fw-bold">22</div>
                </div>

                <div class="d-flex fs-6 fw-semibold align-items-center mb-2">
                  <div class="bullet bg-secondary me-3"></div>
                  <div class="fw-normal">Bug</div>
                  <div class="ms-auto fw-bold">04</div>
                </div>

                <div class="d-flex fs-6 fw-semibold align-items-center">
                  <div class="bullet bg-success me-3"></div>
                  <div class="fw-normal">Done</div>
                  <div class="ms-auto fw-bold">40</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-0">
      <table class="dt-task-list table-nowrap align-middle table w-100">
        <thead class="bg-light bg-opacity-30">
          <tr>
            <th></th>
            <th>Task Name</th>
            <th>Assigned</th>
            <th class="text-truncate">Due Date</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>

  </div>

  @include('partials.create-task')

@endsection

@section('js')

  <!-- Tagify js -->
  <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

  <!-- ApexChat js -->
  <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

  <!-- Air Datepicker js -->
  <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

  <!-- Create Task init -->
  <script src="{{ asset('assets/js/partials/create-task.init.js') }}"></script>

  <!-- To Do init -->
  <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
  <script src="{{ asset('assets/js/apps/apps-todo.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection
