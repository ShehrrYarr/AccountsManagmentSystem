@extends('partials.layouts.master2')

    @section('title', 'Profile Project | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Profile Project' )
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
          <a class="nav-link" href="pages-profile-overview">Overview</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link active" href="pages-profile-project">Project</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-documents">Documents</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-connections">Connections</a>
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

  <div class="row g-4">
    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">Website Development</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">Sarah Lee</span>
                </div>
              </div>
            </div>
            <span class="badge bg-primary-subtle text-primary">In Progress</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            Our team is working on creating a dynamic, responsive, and user-friendly website tailored to meet your business objectives and improve your online presence.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$18.5k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>01/05/2024</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>30/06/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-primary w-50"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">50%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Liam Turner" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Avatar" >
                </li>
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Emma Rogers" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Avatar" >
                </li>
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Oliver Reed" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Due in</strong> <span>10 Days</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">E-Commerce Website</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">James Carter</span>
                </div>
              </div>
            </div>
            <span class="badge bg-warning-subtle text-warning">On Hold</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            Developing an e-commerce platform with secure payment processing, user-friendly navigation, and scalable infrastructure.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$50k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>01/03/2024</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>01/09/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-warning" style="width: 30%"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">30%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Alice Walker" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Avatar" >
                </li>
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Ethan Lee" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Due in</strong> <span>180 Days</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">Corporate Blog</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">Global Corp</span>
                </div>
              </div>
            </div>
            <span class="badge bg-success-subtle text-success">Completed</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            A blog platform for corporate use, optimized for content marketing with a clean design and SEO-friendly features.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$12k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>01/11/2023</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>01/02/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-success w-100"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">100%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Rosa Clark" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Due in</strong> <span>0 Days</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">Landing Page Redesign</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">BrightTech Solutions</span>
                </div>
              </div>
            </div>
            <span class="badge bg-danger-subtle text-danger">Delayed</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            Redesigning a landing page to improve conversion rates with modern design trends, faster load time, and A/B testing.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$5k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>15/06/2024</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>01/08/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-danger w-20"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">10%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Samuel Gray" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="Avatar" >
                </li>
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Sophie Patel" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Due in</strong> <span>45 Days</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">Portfolio Website</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">Jessica Roberts</span>
                </div>
              </div>
            </div>
            <span class="badge bg-info-subtle text-info">Pending</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            Building a personal portfolio site with interactive elements and a showcase of design and development work.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$8k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>01/07/2024</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>01/09/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-info" style="width: 5%"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">5%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Daniel Thomas" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Due in</strong> <span>60 Days</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">Blog Platform</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">Creative Minds</span>
                </div>
              </div>
            </div>
            <span class="badge bg-primary-subtle text-primary">In Progress</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            Developing a blog platform with support for multiple contributors, custom themes, and robust commenting systems.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$10k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>01/05/2024</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>15/07/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-primary w-75"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">75%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Sophia Clark" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Due in</strong> <span>45 Days</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">Restaurant Website</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">Foodie Delight</span>
                </div>
              </div>
            </div>
            <span class="badge bg-secondary-subtle text-secondary">Under Review</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            Creating an interactive website with online menu, reservations, and order management for a local restaurant.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$7.5k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>01/08/2024</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>15/09/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-secondary w-50"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">50%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Liam Patel" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Due in</strong> <span>30 Days</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">React Web Application</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">Tech Innovators</span>
                </div>
              </div>
            </div>
            <span class="badge bg-primary-subtle text-primary">In Progress</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            Developing a dynamic web application with React for a seamless user experience and scalable performance.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$22k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>01/03/2024</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>01/06/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-primary" style="width: 40%"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">40%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="John Doe" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Avatar" >
                </li>
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Alice Smith" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Due in</strong> <span>60 Days</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-0 overflow-hidden">
        <div class="card-header pb-4">
          <div class="hstack justify-content-between gap-3">
            <div class="hstack gap-4 flex-grow-1">
              <button type="button" class="btn btn-light-primary icon-btn flex-shrink-0">
                <i class="ri-pencil-fill"></i>
              </button>
              <div class="flex-grow-1">
                <h5 class="mb-0">
                  <a href="apps-projects-overview" class="text-truncate">Web Design & UI/UX</a>
                </h5>
                <div class="text-body">
                  <span class="fw-semibold">Client: </span><span class="fs-13 text-muted">Global Trends</span>
                </div>
              </div>
            </div>
            <span class="badge bg-success-subtle text-success">Completed</span>
          </div>
        </div>

        <div class="card-body py-5">
          <p class="text-muted mb-3 text-truncate-2 fs-13">
            Creating an intuitive and visually appealing design with seamless user interactions to enhance user engagement.
          </p>

          <div class="d-flex justify-content-between gap-3 align-items-center mb-5">
            <div class="bg-light border border-dashed bg-opacity-20 rounded-4 p-3 w-50">
              <small class="text-muted">Total Budget</small>
              <p class="mb-0 fs-4"><strong class="text-body">$15k</strong></p>
            </div>
            <div class="w-50 text-end">
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Start Date:</strong> <span>15/02/2024</span></p>
              <p class="mb-1 fs-6 text-muted fs-13"><strong class="text-body">Deadline:</strong> <span>01/05/2024</span></p>
            </div>
          </div>

          <div class="d-flex align-items-center mb-4">
            <div class="progress progress-sm w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-success w-100"></div>
            </div>
            <span class="ms-3 fw-bold text-body-emphasis">100%</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 z-2">
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Oliver Reed" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Avatar" >
                </li>
                <li data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" title="Eva Green" class="avatar-item">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Avatar" >
                </li>
              </ul>
            </div>
            <div class="ms-auto text-end">
              <p class="text-muted m-0 fs-12"><strong class="text-body">Completed On:</strong> <span>01/05/2024</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Pagination -->
  <nav class="pt-4 hstack justify-content-center" aria-label="Page navigation example">
    <ul class="pagination pagination-primary mb-0">
      <li class="page-item">
        <a class="page-link" href="#!">
          <i class="ri-arrow-left-s-line fw-semibold"></i>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#!">1</a></li>
      <li class="page-item active"><a class="page-link" href="#!">2</a></li>
      <li class="page-item"><a class="page-link" href="#!">3</a></li>
      <li class="page-item"><a class="page-link" href="#!">4</a></li>
      <li class="page-item"><a class="page-link" href="#!">5</a></li>
      <li class="page-item">
        <a class="page-link" href="#!">
          <i class="ri-arrow-right-s-line fw-semibold"></i>
        </a>
      </li>
    </ul>
  </nav>

@endsection

@section('js')

  <!-- Countup init -->
  <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

  <!-- Profile init -->
  <script src="{{ asset('assets/js/pages/pages-profile.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

  @endsection
