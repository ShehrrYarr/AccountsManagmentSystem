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
          <a class="nav-link active" href="pages-profile-overview">Overview</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" href="pages-profile-project">Project</a>
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

  <div class="row g-4 justify-content-center">
    <div class="col-md-4">
      <div class="card card-body mb-0">
        <h5>Personal Information</h5>
        <p class="text-muted fs-13 mb-3">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
        <div class="mb-3">
          <span class="badge fw-medium bg-light text-muted">Javascript</span>
          <span class="badge fw-medium bg-light text-muted">Python</span>
          <span class="badge fw-medium bg-light text-muted">Angular</span>
          <span class="badge fw-medium bg-light text-muted">Reactjs</span>
          <span class="badge fw-medium bg-light text-muted">Flutter</span>
        </div>
        <ul class="list-unstyled mb-0">
          <li class="fs-13 text-muted hstack flex-wrap"><i class="ri-cake-2-line me-2 text-light fs-18 align-middle"></i> <b class="fw-semibold text-body"> Birth Date </b> : 06 June 1989</li>
          <li class="fs-13 text-muted hstack flex-wrap"><i class="ri-briefcase-2-line me-2 text-light fs-18 align-middle"></i> <b class="fw-semibold text-body"> Position </b> : Full Stack Developer</li>
          <li class="fs-13 text-muted hstack flex-wrap"><i class="ri-community-line me-2 text-light fs-18 align-middle"></i> <b class="fw-semibold text-body"> Education </b> : Stanford University</li>
          <li class="fs-13 text-muted hstack flex-wrap"><i class="ri-phone-line me-2 text-light fs-18 align-middle"></i> <b class="fw-semibold text-body"> Phone </b> : +91 23456 78910</li>
          <li class="fs-13 text-muted hstack flex-wrap"><i class="ri-mail-line text-light fs-18 align-middle me-2"></i> <b class="fw-semibold text-body"> Email </b> : srbthemes.theme@gmail.com</li>
        </ul>
        <h5 class="my-5">Active Teams</h5>
        <ul class="list-unstyled mb-0">
          <li class="d-flex align-items-center gap-2 fs-13 text-muted">
            <img src="{{ asset('assets/images/other/figma.png') }}">" alt="figma icons">
            <b class="fw-semibold text-body"> UI/UX Designer </b> (65 members)
          </li>
          <li class="d-flex align-items-center gap-2 fs-13 text-muted mt-2">
            <img src="{{ asset('assets/images/other/react.png') }}">" alt="react icons">
            <b class="fw-semibold text-body"> Frontend Developer </b> (126 members)
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-body">
        <h5 class="mb-4">About</h5>
        <p class="fs-13 text-muted">Hi I'm Jennyfer Frankin, It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is European languages are members of the same family.</p>
        <p class="fs-13 text-muted mb-0">You always want to make sure that your fonts work well together and try to limit the number of fonts you use to three or less. Experiment and play around with the fonts that you already have in the software you’re working with reputable font websites. This may be the most commonly encountered tip I received from the designers I spoke with. They highly encourage that you use different fonts in one design, but do not over-exaggerate and go overboard.</p>
      </div>
      <div class="card card-body mb-0">
        <h5 class="mb-4">Recent Activity</h5>

        <!-- Timeline -->
        <ul class="timeline-box mb-0">
          <li class="timeline-section">
            <div class="position-relative timeline-icon h-max">
              <div class="border-0 text-bg-primary avatar-item avatar">AG</div>
            </div>
            <div class="timeline-content p-0">
              <div class="d-flex flex-column gap-1">
                <p class="mb-0 text-muted fs-12">15:36, Monday</p>
              </div>
              <div class="card card-body shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mt-3 mb-0">
                <p class="mb-2">
                  <b>You</b> tagged <b>Emma Thompson</b> in a photo.
                </p>
                <p class="text-muted fs-13">
                  "Sharing a joyful moment by tagging Emma in a photo from last weekend's picnic, celebrating our friendship and the beautiful memories we've created together."
                </p>
                <p class="profile-activity-media mb-0 hstack gap-3 flex-wrap">
                  <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt="user Image" class="mb-0 w-64px h-40px img-fluid rounded overflow-hidden">
                  <img src="{{ asset('assets/images/small/img-2.jpg') }}" alt="user Image" class="mb-0 w-64px h-40px img-fluid rounded overflow-hidden">
                </p>
              </div>
            </div>
          </li>

          <li class="timeline-section">
            <div class="position-relative timeline-icon h-max">
              <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" class="border-0 avatar-item avatar" alt="user Image">
              <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
            </div>
            <div class="timeline-content p-0">
              <div class="d-flex flex-column gap-1">
                <h5 class="mb-0 fw-medium">Max Alexander</h5>
                <p class="mb-0 text-muted fs-12">08:15 AM</p>
              </div>
              <div class="mt-1 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                <span>commented on the task</span>
                <span class="fw-semibold text-body">TASK-1125</span>
              </div>
              <div class="card card-body shadow-none border border-dashed text-muted fs-13 bg-light bg-opacity-30 mt-3 mb-0">Looks like the latest feature implementation has a few issues with the integration. Let's focus on fixing that bug before deployment.</div>
            </div>
          </li>

          <li class="timeline-section">
            <div class="position-relative timeline-icon h-max">
              <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" class="border-0 avatar-item avatar" alt="user Image">
              <span class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
            </div>
            <div class="timeline-content p-0">
              <div class="d-flex flex-column gap-1">
                <h5 class="mb-0 fw-medium">Max Alexander</h5>
                <p class="mb-0 text-muted fs-12">08:15 AM</p>
              </div>
              <div class="card card-body shadow-none border border-dashed fs-13 bg-light bg-opacity-30 mt-3 mb-0">
                <div class="d-flex flex-column flex-sm-row gap-4">
                  <div class="flex-shrink-0">
                    <img src="{{ asset('assets/images/product/product-5.jpg') }}" alt="product image" class="avatar-lg rounded">
                  </div>
                  <div class="flex-grow-1">
                    <h5 class="fs-15">@Erica245 <small class="text-muted fs-13 fw-normal">- 10 min ago</small></h5>
                    <p class="text-muted mb-2">"Wishing you all the best in your new job! Don't forget to celebrate this exciting new chapter in your life with some fun and relaxation. A thoughtful card and a bouquet of flowers can make this moment even more special!"</p>
                    <div class="hstack flex-wrap gap-3">
                      <div class="badge bg-light text-body">
                        <span class="me-1">&#128293;</span> 19 Likes
                      </div>
                      <div class="badge bg-light text-body">
                        <span class="me-1">&#129321;</span> 22 Comments
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li class="timeline-section">
            <div class="position-relative timeline-icon h-max">
              <div class="border-0 text-bg-light avatar-item avatar"><i class="ri-price-tag-3-line"></i></div>
            </div>
            <div class="timeline-content p-0">
              <div class="d-flex flex-column gap-1">
                <h5 class="mb-0 fw-medium">Eugene Stewart</h5>
                <p class="mb-0 text-muted fs-12">07:45 AM</p>
              </div>
              <div class="mt-1 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                <span>added labels to</span>
                <span class="fw-semibold text-body">TASK-1156</span>
                <span>including</span>
                <span class="d-inline-flex align-items-center gap-2">
                  <span class="badge bg-light d-flex align-items-center gap-1">
                    <span class="bullet d-flex align-items-center bg-danger flex-shrink-0"></span>
                    <span class="fw-semibold text-body">Critical</span>
                  </span>
                  <span class="badge bg-light d-flex align-items-center gap-1">
                    <span class="bullet d-flex align-items-center bg-primary flex-shrink-0"></span>
                    <span class="fw-semibold text-body">Frontend</span>
                  </span>
                </span>
              </div>
            </div>
          </li>

          <li class="timeline-section">
            <div class="position-relative timeline-icon h-max">
              <div class="border-0 text-bg-light avatar-item avatar"><i class="ri-file-upload-line"></i></div>
            </div>
            <div class="timeline-content p-0">
              <div class="d-flex flex-column gap-1">
                <h5 class="mb-0 fw-medium">Creating a New Event with Attachments</h5>
                <p class="text-muted fs-12">Organizing events effectively is crucial. Proper spacing and layout enhance readability and engagement. Below are the attachments related to the upcoming marketing workshop.</p>
              </div>
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="card card-body mb-0 flex-row gap-3 flex-wrap border border-dashed position-relative bg-light bg-opacity-30">
                    <div class="avatar-item avatar border-0 bg-light text-primary flex-shrink-0">
                      <i class="ri-image-2-line fs-20"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h6 class="mb-1">
                        <a href="#!" class="text-decoration-none text-body-emphasis">Marketing Workshop Agenda - PDF</a>
                      </h6>
                      <small class="text-muted">File Size: 1.2 MB</small>
                    </div>
                    <div class="align-self-center ms-2">
                      <button class="btn btn-outline-primary btn-sm">Download</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-body mb-0 flex-row gap-3 flex-wrap border border-dashed position-relative bg-light bg-opacity-30">
                    <div class="avatar-item avatar border-0 bg-light text-info flex-shrink-0">
                      <i class="ri-file-zip-line fs-20"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h6 class="mb-1">
                        <a href="#!" class="text-decoration-none text-body-emphasis">Workshop Presentation Slides - ZIP</a>
                      </h6>
                      <small class="text-muted">File Size: 3.5 MB</small>
                    </div>
                    <div class="align-self-center ms-2">
                      <button class="btn btn-outline-info btn-sm">Download</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li class="timeline-section">
            <div class="position-relative timeline-icon h-max">
              <img src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" class="border-0 avatar-item avatar" alt="user Image">
            </div>
            <div class="timeline-content p-0">
              <div class="d-flex flex-column gap-1">
                <h5 class="mb-0 fw-medium">Initiating a New Project for Product Development</h5>
                <p class="mb-0 text-muted fs-12">Every team project benefits from a structured approach. Use this platform to share vital information, track progress, and collaborate effectively with your team members.</p>
              </div>
              <div class="mt-1 mb-3 d-inline-flex flex-wrap align-items-center gap-2 text-muted">
                <span>mentioned you in a comment on</span>
                <span class="fw-semibold text-body">TASK-1109</span>
              </div>
              <div class="avatar-group">

                <div class="avatar-item avatar-sm overflow-hidden" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Christi">
                  <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
                </div>

                <div class="avatar-item avatar-sm overflow-hidden" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Alex">
                  <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                </div>

                <div class="avatar-item avatar-sm overflow-hidden" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Jordan">
                  <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
                </div>

                <div class="avatar-item avatar-sm avatar-title text-danger bg-danger-subtle">SR</div>

              </div>
            </div>
          </li>

        </ul>

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
