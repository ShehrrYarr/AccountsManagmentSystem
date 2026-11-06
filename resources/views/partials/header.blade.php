<!-- START HEADER -->
<header class="app-header">
  <div class="container-fluid">
    <div class="nav-header">

      <div class="header-left hstack gap-3">
        <!-- HORIZONTAL BRAND LOGO -->
        <div class="app-sidebar-logo app-horizontal-logo justify-content-center align-items-center">
          <a href="index">
            <img height="35" class="app-sidebar-logo-default" alt="Logo" loading="lazy" src="{{ asset('assets/images/light-logo.png') }}">">
            <img height="40" class="app-sidebar-logo-minimize" alt="Logo" loading="lazy" src="{{ asset('assets/images/Favicon.png') }}">">
          </a>
        </div>

        <!-- Sidebar Toggle Btn -->
        <button type="button" class="btn btn-light-light icon-btn sidebar-toggle d-none d-md-block" aria-expanded="false" aria-controls="main-menu">
          <span class="visually-hidden">Toggle sidebar</span>
          <i class="ri-menu-2-fill"></i>
        </button>

        <!-- Sidebar Toggle for Mobile -->
        <button class="btn btn-light-light icon-btn d-md-none small-screen-toggle" id="smallScreenSidebarLabel" type="button" data-bs-toggle="offcanvas" data-bs-target="#smallScreenSidebar" aria-controls="smallScreenSidebar">
          <span class="visually-hidden">Sidebar toggle for mobile</span>
          <i class="ri-arrow-right-fill"></i>
        </button>

        <!-- Sidebar Toggle for Horizontal Menu -->
        <button class="btn btn-light-light icon-btn d-lg-none small-screen-horizontal-toggle" type="button" ria-expanded="false" aria-controls="main-menu">
          <span class="visually-hidden">Sidebar toggle for horizontal</span>
          <i class="ri-arrow-right-fill"></i>
        </button>

        <!-- Search Dropdown -->
        <div class="dropdown features-dropdown">

          <!-- Search Input for Desktop -->
          <form class="d-none d-sm-block header-search" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="form-icon">
              <input type="search" class="form-control form-control-icon" id="firstNameLayout4" placeholder="Search in Herozi" required>
              <i class="ri-search-2-line text-muted"></i>
            </div>
          </form>

          <!-- Search Button for Mobile -->
          <button type="button" class="btn btn-light-light icon-btn d-sm-none" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="visually-hidden">Search</span>
            <i class="ri-search-2-line text-muted"></i>
          </button>

          <div class="dropdown-menu">
            <span class="dropdown-header fs-12">Recent searches</span>
            <div class="dropdown-item text-wrap bg-transparent">
              <span class="badge bg-light text-muted me-2">Gulp</span>
              <span class="badge bg-light text-muted me-2">Notification panel</span>
            </div>
            <div class="dropdown-divider"></div>
            <span class="dropdown-header fs-12">Tutorials</span>
            <div class="dropdown-item">
              <div class="hstack gap-2 overflow-hidden">
                <button type="button" class="btn btn-light-light rounded-pill icon-btn-sm flex-shrink-0">
                  <span class="visually-hidden">Equalizer settings</span>
                  <i class="ri-equalizer-3-line m-0"></i>
                </button>
                <div class="flex-grow-1 text-truncate">
                  <span>How to set up Gulp?</span>
                </div>
              </div>
            </div>
            <div class="dropdown-item">
              <div class="hstack gap-2 overflow-hidden">
                <button type="button" class="btn btn-light-light rounded-pill icon-btn-sm flex-shrink-0">
                  <span class="visually-hidden">How to change theme color?</span>
                  <i class="ri-palette-line m-0"></i>
                </button>
                <div class="flex-grow-1 text-truncate">
                  <span>How to change theme color?</span>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <span class="dropdown-header fs-12">Members</span>
            <div class="dropdown-item">
              <div class="hstack gap-2 overflow-hidden">
                <div class="flex-shrink-0">
                  <img class="img-fluid avatar-sm avatar-item" src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
                </div>
                <div class="flex-grow-1 text-truncate">
                  <span>Amanda Harvey <i class="bi-patch-check-fill text-primary"></i></span>
                </div>
              </div>
            </div>
            <div class="dropdown-item">
              <div class="hstack gap-2 overflow-hidden">
                <div class="flex-shrink-0">
                  <img class="img-fluid avatar-sm avatar-item" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                </div>
                <div class="flex-grow-1 text-truncate">
                  <span>David Harrison</span>
                </div>
              </div>
            </div>
            <div class="dropdown-item">
              <div class="hstack gap-2 overflow-hidden">
                <div class="flex-shrink-0">
                  <div class="avatar-item avatar-sm avatar-title border-0 text-bg-info">A</div>
                </div>
                <div class="flex-grow-1 text-truncate ms-2">
                  <span>Anne Richard</span>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="px-5 py-2 d-block text-center link-primary">
              See all results
              <i class="ri-arrow-right-s-line"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="header-right hstack gap-3">
        <div class="hstack gap-0 gap-sm-1">
          <!-- Cart -->
          <div class="dropdown features-dropdown">
            <button type="button" class="btn icon-btn btn-text-primary rounded-circle position-relative" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-bag fs-2xl"></i>
              <span class="position-absolute translate-middle badge rounded-pill p-1 min-w-20px badge text-bg-primary">5</span>
            </button>
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0" aria-labelledby="page-header-cart-dropdown">
              <div class="card mb-0">

                <!-- Cart Header -->
                <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fs-5 fw-semibold">My Cart <span class="badge bg-secondary ms-1">7</span></h6>
                    <a href="#!" class="text-muted fs-6">View All</a>
                  </div>
                </div>

                <!-- Cart Items List (Scrollable) -->
                <div class="header-cart-scrollable card-body px-0 py-2" data-simplebar>

                  <!-- Cart Item 1 -->
                  <div class="dropdown-item d-flex align-items-center gap-3 py-2">
                    <img src="{{ asset('assets/images/product/product-3.jpg') }}" class="img-fluid rounded-3 avatar-lg" loading="lazy" alt="SoundMaster Wireless Headphones">
                    <div class="flex-grow-1 text-truncate">
                      <a href="apps-product-details" class="text-body fw-semibold">SoundMaster Wireless Headphones</a>
                      <div class="text-muted fs-7 text-truncate">Both fashion and functionality</div>
                    </div>
                    <span class="text-muted fs-12">3 x $219.99</span>
                  </div>

                  <!-- Cart Item 2 -->
                  <div class="dropdown-item d-flex align-items-center gap-3 py-2">
                    <img src="{{ asset('assets/images/product/product-4.jpg') }}" class="img-fluid rounded-3 avatar-lg" loading="lazy" alt="Cocooil Body Oil">
                    <div class="flex-grow-1 text-truncate">
                      <a href="apps-product-details" class="text-body fw-semibold">Cocooil Body Oil</a>
                      <div class="text-muted fs- text-truncate">Natural and nourishing body oil</div>
                    </div>
                    <span class="text-muted fs-12">2 x $45.00</span>
                  </div>

                  <!-- Cart Item 3 -->
                  <div class="dropdown-item d-flex align-items-center gap-3 py-2">
                    <img src="{{ asset('assets/images/product/product-6.jpg') }}" class="img-fluid rounded-3 avatar-lg" loading="lazy" alt="Luxury Sunglasses">
                    <div class="flex-grow-1 text-truncate">
                      <a href="apps-product-details" class="text-body fw-semibold">Luxury Sunglasses</a>
                      <div class="text-muted fs- text-truncate">Stylish and durable sunglasses</div>
                    </div>
                    <span class="text-muted fs-12">6 x $149.99</span>
                  </div>

                  <!-- Cart Item 3 -->
                  <div class="dropdown-item d-flex align-items-center gap-3 py-2">
                    <img src="{{ asset('assets/images/product/product-6.jpg') }}" class="img-fluid rounded-3 avatar-lg" loading="lazy" alt="Luxury Sunglasses">
                    <div class="flex-grow-1 text-truncate">
                      <a href="apps-product-details" class="text-body fw-semibold">Luxury Sunglasses</a>
                      <div class="text-muted fs- text-truncate">Stylish and durable sunglasses</div>
                    </div>
                    <span class="text-muted fs-12">6 x $149.99</span>
                  </div>

                  <!-- Cart Item 3 -->
                  <div class="dropdown-item d-flex align-items-center gap-3 py-2">
                    <img src="{{ asset('assets/images/product/product-6.jpg') }}" class="img-fluid rounded-3 avatar-lg" loading="lazy" alt="Luxury Sunglasses">
                    <div class="flex-grow-1 text-truncate">
                      <a href="apps-product-details" class="text-body fw-semibold">Luxury Sunglasses</a>
                      <div class="text-muted fs- text-truncate">Stylish and durable sunglasses</div>
                    </div>
                    <span class="text-muted fs-12">6 x $149.99</span>
                  </div>
                </div>

                <!-- Cart Summary -->
                <div class="card-footer border-top">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 text-muted">Total</h6>
                    <div class="px-2">
                      <h5 class="m-0">$205.86</h5>
                    </div>
                  </div>
                  <a href="apps-product-checkout" class="btn btn-primary text-center w-100 mt-3">Proceed to Checkout</a>
                </div>

              </div>
            </div>
          </div>

          <!-- Apps -->
          <div class="dropdown features-dropdown">
            <button type="button" class="btn icon-btn btn-text-primary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="visually-hidden">Browse by Apps</span>
              <i class="bi bi-grid"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
              <div class="card shadow-none mb-0 border-0">
                <div class="card-header hstack gap-2">
                  <h5 class="card-title mb-0 flex-grow-1">Browse by Apps</h5>
                  <a href="#!" class="btn btn-sm btn-subtle-info flex-shrink-0">View All Apps
                    <i class="ri-arrow-right-s-line align-middle"></i>
                  </a>
                </div>
                <div class="card-body px-3">
                  <div class="row g-0">
                    <div class="col">
                      <a class="dropdown-icon-item" href="../apps-calendar">
                        <div class="avatar border-0 avatar-item bg-light mx-auto mb-2">
                          <i class="bi bi-calendar-event align-middle text-muted"></i>
                        </div>
                        <p class="mb-1 h6 fw-medium">Calendar</p>
                        <p class="mb-0 text-muted fs-11">Events</p>
                      </a>
                    </div>

                    <div class="col">
                      <a class="dropdown-icon-item" href="../apps-tasks-kanban">
                        <div class="avatar border-0 avatar-item bg-light mx-auto mb-2">
                          <i class="bi bi-view-stacked align-middle text-muted"></i>
                        </div>
                        <p class="mb-1 h6 fw-medium">Kanban</p>
                        <p class="mb-0 text-muted fs-11">Projects</p>
                      </a>
                    </div>

                    <div class="col">
                      <a class="dropdown-icon-item" href="../apps-todo">
                        <div class="avatar border-0 avatar-item bg-light mx-auto mb-2">
                          <i class="ri-check-double-line align-middle text-muted"></i>
                        </div>
                        <p class="mb-1 h6 fw-medium">To-Do</p>
                        <p class="mb-0 text-muted fs-11">Tasks</p>
                      </a>
                    </div>
                  </div>

                  <div class="row g-0">
                    <div class="col">
                      <a class="dropdown-icon-item" href="../apps-chat">
                        <div class="avatar border-0 avatar-item bg-light mx-auto mb-2">
                          <i class="ri-chat-1-line align-middle text-muted"></i>
                        </div>
                        <p class="mb-1 h6 fw-medium">Chat</p>
                        <p class="mb-0 text-muted fs-11">Messages</p>
                      </a>
                    </div>

                    <div class="col">
                      <a class="dropdown-icon-item" href="../apps-email-list">
                        <div class="avatar border-0 avatar-item bg-light mx-auto mb-2">
                          <i class="ri-mail-line align-middle text-muted"></i>
                        </div>
                        <p class="mb-1 h6 fw-medium">Email</p>
                        <p class="mb-0 text-muted fs-11">Mail</p>
                      </a>
                    </div>

                    <div class="col">
                      <a class="dropdown-icon-item" href="../index">
                        <div class="avatar border-0 avatar-item bg-light mx-auto mb-2">
                          <i class="ri-shopping-cart-line align-middle text-muted"></i>
                        </div>
                        <p class="mb-1 h6 fw-medium">E-Commerce</p>
                        <p class="mb-0 text-muted fs-11">Store</p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Language -->
          <div class="dropdown features-dropdown" id="language-dropdown">
            <a href="#!" class="btn icon-btn btn-text-primary rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="avatar-item avatar-xs">
                <img class="img-fluid avatar-xs" src="{{ asset('assets/images/flags/us.svg') }}" loading="lazy" alt="avatar image">
              </div>
            </a>

            <div class="dropdown-menu header-language-scrollable dropdown-menu-end" data-simplebar>

              <a href="#!" class="dropdown-item py-2">
                <img src="{{ asset('assets/images/flags/us.svg') }}" alt="en" loading="lazy" class="me-2 rounded h-20px w-20px img-fluid object-fit-cover">
                <span class="align-middle">English</span>
              </a>

              <a href="#!" class="dropdown-item">
                <img src="{{ asset('assets/images/flags/es.svg') }}" alt="es" loading="lazy" class="me-2 rounded h-20px w-20px img-fluid object-fit-cover">
                <span class="align-middle">Spanish</span>
              </a>

              <a href="#!" class="dropdown-item">
                <img src="{{ asset('assets/images/flags/fr.svg') }}" alt="fr" loading="lazy" class="me-2 rounded h-20px w-20px img-fluid object-fit-cover">
                <span class="align-middle">French</span>
              </a>

              <a href="#!" class="dropdown-item">
                <img src="{{ asset('assets/images/flags/ru.svg') }}" alt="ru" loading="lazy" class="me-2 rounded h-20px w-20px img-fluid object-fit-cover">
                <span class="align-middle">Russian</span>
              </a>

              <a href="#!" class="dropdown-item">
                <img src="{{ asset('assets/images/flags/de.svg') }}" alt="de" loading="lazy" class="me-2 rounded h-20px w-20px img-fluid object-fit-cover">
                <span class="align-middle">German</span>
              </a>

              <a href="#!" class="dropdown-item">
                <img src="{{ asset('assets/images/flags/it.svg') }}" alt="it" loading="lazy" class="me-2 rounded h-20px w-20px img-fluid object-fit-cover">
                <span class="align-middle">Italian</span>
              </a>

              <a href="#!" class="dropdown-item">
                <img src="{{ asset('assets/images/flags/zh.svg') }}" alt="zh" loading="lazy" class="me-2 rounded h-20px w-20px img-fluid object-fit-cover">
                <span class="align-middle">Chinese</span>
              </a>

              <a href="#!" class="dropdown-item">
                <img src="{{ asset('assets/images/flags/ar.svg') }}" alt="ar" loading="lazy" class="me-2 rounded h-20px w-20px img-fluid object-fit-cover">
                <span class="align-middle">Arabic</span>
              </a>

            </div>
          </div>

          <!-- Theme -->
          <div class="dropdown features-dropdown d-none d-sm-block">
            <button type="button" class="btn icon-btn btn-text-primary rounded-circle" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="visually-hidden">Light or Dark Mode Switch</span>
              <i class="ri-sun-line fs-20"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-end header-language-scrollable" data-simplebar>

              <div class="dropdown-item cursor-pointer" id="light-theme">
                <span class="hstack gap-2 align-middle"><i class="ri-sun-line"></i>Light</span>
              </div>
              <div class="dropdown-item cursor-pointer" id="dark-theme">
                <span class="hstack gap-2 align-middle"><i class="ri-moon-clear-line"></i>Dark</span>
              </div>
              <div class="dropdown-item cursor-pointer" id="system-theme">
                <span class="hstack gap-2 align-middle"><i class="ri-computer-line"></i>System</span>
              </div>

            </div>
          </div>

          <!-- Notification -->
          <div class="dropdown features-dropdown">
            <button type="button" class="btn icon-btn btn-text-primary rounded-circle position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
              <i class="ri-notification-2-line fs-20"></i>
              <span class="position-absolute translate-middle badge rounded-pill p-1 min-w-20px badge text-bg-danger">3</span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
              <div class="dropdown-header d-flex align-items-center py-3">
                <h6 class="mb-0 me-auto">Notification</h6>
                <div class="d-flex align-items-center h6 mb-0">
                  <span class="badge bg-primary me-2">8 New</span>

                  <div class="dropdown">
                    <a href="#!" class="btn btn-text-primary rounded-pill icon-btn-sm" id="remix-cion-notifications-dropdown-settings" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="visually-hidden">Notification Settings</span>
                      <i class="ri-more-2-fill"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="remix-cion-notifications-dropdown-settings">
                      <span class="dropdown-header fw-medium text-body">Settings</span>
                      <a class="dropdown-item" href="#!">
                        <i class="ri-archive-line"></i> Archive all
                      </a>
                      <a class="dropdown-item" href="#!">
                        <i class="ri-checkbox-circle-line"></i> Mark all as read
                      </a>
                      <a class="dropdown-item" href="#!">
                        <i class="ri-notification-off-line"></i> Disable notifications
                      </a>
                      <a class="dropdown-item" href="#!">
                        <i class="ri-gift-line"></i> What's new?
                      </a>
                      <div class="dropdown-divider"></div>
                      <span class="dropdown-header fw-medium text-body">Feedback</span>
                      <a class="dropdown-item" href="#!">
                        <i class="ri-chat-1-line"></i> Report
                      </a>
                    </div>
                  </div>

                </div>
              </div>
              <ul class="list-group list-group-flush header-notification-scrollable" data-simplebar>
                <li class="list-group-item list-group-item-action border-start-0 border-end-0">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar-item avatar avatar-title bg-danger-subtle text-danger">
                        CF
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 small">Charles Franklin</h6>
                      <small class="mb-1 d-block text-body">Accepted your connection</small>
                      <small class="text-muted">12hr ago</small>
                    </div>
                  </div>
                </li>
                <li class="list-group-item list-group-item-action border-start-0 border-end-0">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar-item avatar">
                        <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="avatar image">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 small">Jenny Wilson</h6>
                      <small class="mb-0 d-block text-body">Create New Apps</small>
                      <small class="text-muted">14hr ago</small>
                    </div>
                  </div>
                </li>
                <li class="list-group-item list-group-item-action border-start-0 border-end-0">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3 position-relative">
                      <div class="avatar-item avatar">
                        <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                      </div>
                      <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 top-0"></span>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 small">Ralph Edwards</h6>
                      <div class="d-block">
                        <small>Wants to edit</small>
                        <small class="mb-1 text-body fw-semibold">Herozi Design system</small>
                      </div>
                      <small class="text-muted">12hr ago</small>
                      <div class="d-flex align-items-center gap-2 mt-3">
                        <button class="btn btn-primary btn-sm">Accept</button>
                        <button class="btn btn-light-secondary btn-sm">Deny</button>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item list-group-item-action border-start-0 border-end-0">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar-item avatar avatar-title bg-danger-subtle text-danger">
                        JJ
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 small">Jacob Jones</h6>
                      <div class="d-block">
                        <small>Mentioned you in</small>
                        <small class="mb-1 text-body fw-semibold">Rewrite Button components</small>
                      </div>
                      <small class="text-muted">15hr ago</small>
                    </div>
                  </div>
                </li>
                <li class="list-group-item list-group-item-action border-start-0 border-end-0">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar-item avatar avatar-title bg-success-subtle text-success">
                        <i class="ri-pie-chart-2-line"></i>
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 small">Monthly report is generated</h6>
                      <small class="mb-1 d-block text-body">July monthly financial report is generated </small>
                      <small class="text-muted">3 days ago</small>
                    </div>
                  </div>
                </li>
                <li class="list-group-item list-group-item-action border-start-0 border-end-0">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar-item avatar avatar-title bg-warning-subtle text-warning">
                        <i class="ri-error-warning-line"></i>
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-1 small">CPU is running high</h6>
                      <small class="mb-1 d-block text-body">CPU Utilization Percent is currently at 88.63%,</small>
                      <small class="text-muted">5 days ago</small>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- Fullscreen -->
          <button type="button" id="fullscreen-button" class="btn icon-btn btn-text-primary rounded-circle custom-toggle d-none d-sm-block" aria-pressed="false">
            <span class="visually-hidden">Toggle Fullscreen</span>
            <span class="icon-on">
              <i class="ri-fullscreen-exit-line fs-16"></i>
            </span>
            <span class="icon-off">
              <i class="ri-fullscreen-line fs-16"></i>
            </span>
          </button>
        </div>

        <!-- Profile Section -->
        <div class="dropdown profile-dropdown features-dropdown">
          <button type="button" id="accountNavbarDropdown" class="btn profile-btn shadow-none px-0 hstack gap-0 gap-sm-3" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
            <span class="position-relative">
              <span class="avatar-item avatar overflow-hidden">
                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
              </span>
              <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
            </span>
            <span>
              <span class="h6 d-none d-xl-inline-block text-start fw-semibold mb-0">Sophia Johnson</span>
              <span class="d-none d-xl-block fs-12 text-start text-muted">CEO</span>
            </span>
          </button>

          <div class="dropdown-menu dropdown-menu-end header-language-scrollable" aria-labelledby="accountNavbarDropdown">
            <div class="dropdown dropstart d-block">
              <a class="dropdown-item d-block w-100 text-start" href="#!" data-bs-toggle="dropdown" aria-expanded="false">
                Set status
              </a>
              <ul class="dropdown-menu">
                <li class="dropdown-item">
                  <span class="h-8px w-8px rounded-pill bg-success me-2"></span>
                  Available
                </li>
                <li class="dropdown-item">
                  <span class="h-8px w-8px rounded-pill bg-danger me-2"></span>
                  Busy
                </li>
                <li class="dropdown-item">
                  <span class="h-8px w-8px rounded-pill bg-warning me-2"></span>
                  Away
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-item">
                  Reset status
                </li>
              </ul>
            </div>

            <a class="dropdown-item" href="../pages-profile-overview">Profile</a>
            <a class="dropdown-item" href="../apps-chat">Messages</a>
            <a class="dropdown-item" href="../apps-todo">My Task</a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="#!">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avatar-item avatar avatar-title text-white bg-primary border-0 fs-12">
                    SRB
                  </div>
                </div>
                <div class="flex-grow-1 ms-2">
                  <h6 class="mb-0 lh-1">SRBThemes <span class="badge bg-primary-subtle text-primary rounded-pill text-uppercase ms-1 mb-0 py-1 fs-10">PRO</span></h6>
                  <span class="card-text text-muted">google.com</span>
                </div>
              </div>
            </a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="../pages-profile-edit-overview">Settings</a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="../auth-signin">Sign out</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</header>
<!-- END HEADER -->
