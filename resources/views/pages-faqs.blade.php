@extends('partials.layouts.master3')

    @section('title', 'Blog Details | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'FAQs List' )
    @section('pagetitle', 'Pages')
    @section('buttonTitle', 'View All')
    @section('link', 'apps-invoices-list')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
    @endsection
    
    @section('content')

  <div class="card mb-4">
    <div class="card-body">
      <div class="row justify-content-center mb-4">
        <div class="col-xl-7">
          <div class="py-2">
            <div class="text-center">
              <h3 class="text-primary1 mb-3">FAQs</h3>
              <h5 class="d-block">Require assistance? Here are some of our commonly asked questions!</h5>
              <p class="text-muted mb-2 px-4">Discover answers to common queries and find solutions to your concerns with our comprehensive list of frequently asked questions.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-body p-2 rounded-3">
        <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
          <ul class="nav nav-pills" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link py-1 active" data-bs-toggle="tab" href="#demo-tab-3_home" role="tab" aria-selected="true" tabindex="-1">
                Overview
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link py-1" data-bs-toggle="tab" href="#demo-tab-3_profile" role="tab" aria-selected="false">
                Customization
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link py-1" data-bs-toggle="tab" href="#demo-tab-3_messages" role="tab" aria-selected="false" tabindex="-1">
                Support
              </a>
            </li>
          </ul>
          <button class="btn btn-primary btn-sm rounded-3">Create Ticket</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active show" id="demo-tab-3_home" role="tabpanel">

      <div class="row g-2">
        <div class="col-lg-9">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="h6">Support Tickets</h6>
                <div class="dropdown">
                  <button class="btn icon-btn-sm btn-light-light rounded-pill" type="button" id="dropdownSupport" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-2-fill text-secondary"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownSupport">
                    <li><a class="dropdown-item" href="#!">Create</a></li>
                    <li><a class="dropdown-item" href="#!">Edit</a></li>
                    <li><a class="dropdown-item" href="#!">Delete</a></li>
                  </ul>
                </div>
              </div>
              <div class="accordion accordion-light accordion-border-box" id="demo_accordion_main_09">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_91" aria-expanded="true" aria-controls="demo_accordion_item_91">
                      1. How can I submit a support ticket?
                    </button>
                  </h2>
                  <div id="demo_accordion_item_91" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_09">
                    <div class="accordion-body">
                      To submit a support ticket, navigate to the support section and fill out the required form. Make sure to include all relevant details to expedite the process.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_92" aria-expanded="false" aria-controls="demo_accordion_item_92">
                      2. What information should I include in my ticket?
                    </button>
                  </h2>
                  <div id="demo_accordion_item_92" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_09">
                    <div class="accordion-body">
                      It's important to include your account details, a clear description of the issue, and any error messages you’ve encountered to assist the support team.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_93" aria-expanded="false" aria-controls="demo_accordion_item_93">
                      3. How long will it take to get a response?
                    </button>
                  </h2>
                  <div id="demo_accordion_item_93" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_09">
                    <div class="accordion-body">
                      Our support team typically responds within 24-48 hours. However, response times may vary based on ticket volume.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_94" aria-expanded="false" aria-controls="demo_accordion_item_94">
                      4. Can I check the status of my ticket?
                    </button>
                  </h2>
                  <div id="demo_accordion_item_94" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_09">
                    <div class="accordion-body">
                      Yes, you can check the status of your ticket by logging into your account and navigating to the support tickets section.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_95" aria-expanded="false" aria-controls="demo_accordion_item_95">
                      5. What should I do if I don't receive a response?
                    </button>
                  </h2>
                  <div id="demo_accordion_item_95" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_09">
                    <div class="accordion-body">
                      If you haven't received a response within the expected timeframe, feel free to follow up on your ticket or reach out through other support channels.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <h5 class="fw-semibold mb-3">Documentations</h5>
              <ul class="list-group email-label list-group-flush">
                <li class="list-group-item border-0 p-0 pb-3 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Quick Start
                  </div>
                </li>
                <li class="list-group-item border-0 p-0 pb-3 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Folder Structure
                  </div>
                </li>
                <li class="list-group-item border-0 p-0 pb-3 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Color
                  </div>
                </li>
                <li class="list-group-item border-0 p-0 pb-3 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Components
                  </div>
                </li>
                <li class="list-group-item border-0 p-0 pb-3 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Routing
                  </div>
                </li>
                <li class="list-group-item border-0 p-0 pb-3 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Navigations
                  </div>
                </li>
                <li class="list-group-item border-0 p-0 pb-3 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Environment Variables
                  </div>
                </li>
                <li class="list-group-item border-0 p-0 pb-3 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Mock Axios Adapter
                  </div>
                </li>
                <li class="list-group-item border-0 p-0 d-flex align-items-center gap-2">
                  <span class="d-inline-block rounded-pill bg-secondary-subtle w-8px h-8px"></span>
                  <div class="fw-medium text-truncate mb-0">
                    Setting
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="tab-pane" id="demo-tab-3_profile" role="tabpanel">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="h6">Theme Customization</h6>
            <div class="dropdown">
              <button class="btn icon-btn-sm btn-light-light rounded-pill" type="button" id="dropdownTheme" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-more-2-fill text-secondary"></i>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownTheme">
                <li><a class="dropdown-item" href="#!">Create</a></li>
                <li><a class="dropdown-item" href="#!">Edit</a></li>
                <li><a class="dropdown-item" href="#!">Delete</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion accordion-light accordion-border-box" id="demo_accordion_main_10">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_101" aria-expanded="true" aria-controls="demo_accordion_item_101">
                  1. How do I change the theme colors?
                </button>
              </h2>
              <div id="demo_accordion_item_101" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_10">
                <div class="accordion-body">
                  You can change the theme colors by modifying the SCSS variables in the `_variables.scss` file and recompiling your SCSS.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_102" aria-expanded="false" aria-controls="demo_accordion_item_102">
                  2. Can I add custom fonts to the theme?
                </button>
              </h2>
              <div id="demo_accordion_item_102" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_10">
                <div class="accordion-body">
                  Yes, you can add custom fonts by importing them in your SCSS file and updating the font family variables accordingly.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_103" aria-expanded="false" aria-controls="demo_accordion_item_103">
                  3. Are there examples of theme customizations?
                </button>
              </h2>
              <div id="demo_accordion_item_103" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_10">
                <div class="accordion-body">
                  Yes, you can find examples of theme customizations in the documentation, which includes code snippets and screenshots.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_104" aria-expanded="false" aria-controls="demo_accordion_item_104">
                  4. Can I reset to the default theme?
                </button>
              </h2>
              <div id="demo_accordion_item_104" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_10">
                <div class="accordion-body">
                  Yes, you can reset to the default theme by restoring the original SCSS files or using the reset option in the theme settings.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_105" aria-expanded="false" aria-controls="demo_accordion_item_105">
                  5. How do I save my customizations?
                </button>
              </h2>
              <div id="demo_accordion_item_105" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_10">
                <div class="accordion-body">
                  To save your customizations, make sure to compile your SCSS changes and upload the CSS file to your project.
                </div>
              </div>
            </div>
          </div>
          <nav class="mt-5 mx-auto d-flex justify-content-center" aria-label="Page navigation example">
            <ul class="pagination pagination-md mb-0">
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
        </div>
      </div>
    </div>

    <div class="tab-pane" id="demo-tab-3_messages" role="tabpanel">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="h6">Support</h6>
            <div class="dropdown">
              <button class="btn icon-btn-sm btn-light-light rounded-pill" type="button" id="dropdownSupportMessages" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-more-2-fill text-secondary"></i>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownSupportMessages">
                <li><a class="dropdown-item" href="#!">Create</a></li>
                <li><a class="dropdown-item" href="#!">Edit</a></li>
                <li><a class="dropdown-item" href="#!">Delete</a></li>
              </ul>
            </div>
          </div>
          <div class="accordion accordion-light accordion-border-box" id="demo_accordion_main_11">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_111" aria-expanded="true" aria-controls="demo_accordion_item_111">
                  1. What is the response time for support inquiries?
                </button>
              </h2>
              <div id="demo_accordion_item_111" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_11">
                <div class="accordion-body">
                  Our typical response time for support inquiries is within 48 hours, depending on the complexity of the issue.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_112" aria-expanded="false" aria-controls="demo_accordion_item_112">
                  2. How can I escalate my support ticket?
                </button>
              </h2>
              <div id="demo_accordion_item_112" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_11">
                <div class="accordion-body">
                  If you need to escalate a ticket, please reply to your existing ticket and request an escalation, providing a brief explanation.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_113" aria-expanded="false" aria-controls="demo_accordion_item_113">
                  3. Are there live chat options available?
                </button>
              </h2>
              <div id="demo_accordion_item_113" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_11">
                <div class="accordion-body">
                  Yes, we offer live chat support during business hours. You can access it from the support page.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_114" aria-expanded="false" aria-controls="demo_accordion_item_114">
                  4. Can I access support resources online?
                </button>
              </h2>
              <div id="demo_accordion_item_114" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_11">
                <div class="accordion-body">
                  Yes, we have an extensive knowledge base and FAQ section available on our website to help you with common issues.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_115" aria-expanded="false" aria-controls="demo_accordion_item_115">
                  5. What should I do if my issue is not resolved?
                </button>
              </h2>
              <div id="demo_accordion_item_115" class="accordion-collapse collapse" data-bs-parent="#demo_accordion_main_11">
                <div class="accordion-body">
                  If your issue remains unresolved, please follow up on your ticket or contact our support team through an alternate channel for assistance.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('js')
  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection
