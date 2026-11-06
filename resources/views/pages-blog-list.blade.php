@extends('partials.layouts.master3')

    @section('title', 'Blog List | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Blog List' )
    @section('pagetitle', 'Pages')
    @section('buttonTitle', 'View All')
    @section('link', 'apps-invoices-list')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
    @endsection
    
    @section('content')


  <div class="row g-4">
    <div class="col-lg-8 col-xl-9">
      <div class="row g-4">
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt="Health Summit" class="img-fluid rounded">
                <span class="badge text-bg-primary text-uppercase position-absolute end-0 top-0 m-3">Speaker</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">Health Summit: Exploring Nutrition’s Impact on Mental Health</a>
              <p class="text-muted text-truncate-2">Experts from the Health Summit emphasize how nutrition plays a central role in mental health. Learn about the latest research on food's impact on mood, stress, and cognition.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Speaker Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">Dr. Sarah Williams</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  15 February 2025
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-5.jpg') }}" alt="Tech for Good Conference" class="img-fluid rounded">
                <span class="badge text-bg-info text-uppercase position-absolute end-0 top-0 m-3">Seminar</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">Tech for Good: Leveraging Technology for Social Change</a>
              <p class="text-muted text-truncate-2">A seminar focusing on how technology can be used to tackle social issues like poverty, inequality, and climate change.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Speaker Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">Linda Carter</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  18 June 2025
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-4.jpg') }}" alt="Fitness Expo" class="img-fluid rounded">
                <span class="badge text-bg-danger text-uppercase position-absolute end-0 top-0 m-3">Keynote</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">Fitness Expo: The Science of Strength Training</a>
              <p class="text-muted text-truncate-2">A deep dive into strength training, muscle growth, and injury prevention. Leading fitness experts will share their insights and techniques.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Speaker Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">Mike Johnson</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  30 May 2025
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Global Health Forum" class="img-fluid rounded">
                <span class="badge text-bg-success text-uppercase position-absolute end-0 top-0 m-3">Panel Discussion</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">Global Health Forum: Addressing the Climate Crisis</a>
              <p class="text-muted text-truncate-2">Global leaders in health discuss how the climate crisis is affecting public health worldwide. The forum focuses on adaptation strategies and sustainable solutions.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Speaker Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">Dr. Emily Ross</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  10 April 2025
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-2.jpg') }}" alt="Mental Wellness" class="img-fluid rounded">
                <span class="badge text-bg-primary text-uppercase position-absolute end-0 top-0 m-3">Growth</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">Promoting Mental Wellness through Balanced Nutrition</a>
              <p class="text-muted text-truncate-2">Adopting a balanced diet can significantly impact mental wellness. Studies show that proper nutrition can help manage anxiety, stress, and depression. Learn how food choices support overall well-being.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Growth Expert Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">Emily Johnson</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  17 February 2025
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Nutrition Strategies" class="img-fluid rounded">
                <span class="badge text-bg-primary text-uppercase position-absolute end-0 top-0 m-3">Diet & Wellness</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">Nutrition Strategies for Mental Health Management</a>
              <p class="text-muted text-truncate-2">Discover how strategic nutrition can help you manage mental health challenges. Learn about the foods that improve mood, focus, and reduce anxiety and depression symptoms.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Diet & Wellness Expert Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">Michael Brown</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  20 February 2025
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-6.jpg') }}" alt="Social Wellbeing" class="img-fluid rounded">
                <span class="badge text-bg-primary text-uppercase position-absolute end-0 top-0 m-3">Influence</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">How Diet Influences Mental Health and Wellbeing</a>
              <p class="text-muted text-truncate-2">The connection between diet and mental health is becoming more evident. A balanced diet can alleviate stress, improve mood, and boost cognitive performance. Learn the role food plays in mental well-being.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Social Influence Expert Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">Lisa Green</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  22 February 2025
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-7.jpg') }}" alt="Healthy Diet" class="img-fluid rounded">
                <span class="badge text-bg-primary text-uppercase position-absolute end-0 top-0 m-3">Wellness</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">The Impact of a Healthy Diet on Mental Clarity</a>
              <p class="text-muted text-truncate-2">Discover how a healthy diet can enhance mental clarity and cognitive function. Nutrition plays a key role in improving focus, memory, and overall brain performance.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="Wellness Expert Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">David Harris</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  25 February 2025
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-4">
          <div class="card mb-0">
            <div class="card-body p-4">
              <div class="position-relative">
                <img src="{{ asset('assets/images/small/img-8.jpg') }}" alt="Brain Health" class="img-fluid rounded">
                <span class="badge text-bg-primary text-uppercase position-absolute end-0 top-0 m-3">Brain Power</span>
              </div>
              <a href="pages-blog-details" class="d-block fs-18 fw-medium text-body my-2 text-truncate">Optimizing Brain Health with the Right Nutrition</a>
              <p class="text-muted text-truncate-2">Brain health is heavily influenced by the foods we consume. This article dives into the key nutrients and diets that promote cognitive function, memory, and mental performance.</p>
              <hr>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="avatar-item avatar-sm">
                  <img class="img-fluid avatar-sm" src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="Brain Health Expert Avatar">
                </div>
                <p class="mb-0 text-muted">by <a href="#!" class="text-body-emphasis">Dr. Olivia Carter</a></p>
                <div class="vr h-6px align-self-center bg-secondary-subtle"></div>
                <p class="mb-0 text-muted">
                  <i class="ri-time-line"></i>
                  28 February 2025
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Pagination -->
      <nav class="d-flex justify-content-center pt-8" aria-label="Page navigation example">
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
    </div>
    <div class="col-lg-4 col-xl-3">
      <div class="card card-body">

        <div class="form-icon">
          <input type="search" class="form-control form-control-icon" id="firstNameLayout4" placeholder="Search">
          <i class="ri-search-2-line text-muted"></i>
        </div>
        <div class="border-top mt-5 pt-5">
          <h5>About Me</h5>
          <div class="text-muted">
            <p class="mb-3">Hi! I am Aaliyah.</p>
            <p>Over the last fifteen years of my career, I earned a sense of creativity. I want to show the beauty of life in a chaotic world.</p>
            <p>In my first year as a photographer, I thought the photos I took needed more spark. So I enrolled in a graphic design class. I combined my photographs with visual arts and finally saw
              what I was looking for. The spark!</p>
          </div>
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex flex-wrap align-items-center gap-2">
              <button type="button" class="btn btn-facebook icon-btn">
                <i class="ri-facebook-fill"></i>
              </button>
              <button type="button" class="btn btn-google icon-btn">
                <i class="ri-google-fill"></i>
              </button>
              <button type="button" class="btn btn-twitter icon-btn">
                <i class="ri-twitter-fill"></i>
              </button>
              <button type="button" class="btn btn-instagram icon-btn">
                <i class="ri-instagram-fill"></i>
              </button>
              <button type="button" class="btn btn-youtube icon-btn">
                <i class="ri-youtube-fill"></i>
              </button>
              <button type="button" class="btn btn-linkedin icon-btn">
                <i class="ri-linkedin-box-fill"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="border-top product-sidebar mt-5 pt-5">
          <h5 class="mb-5">Categories</h5>
          <ul class="list-group fw-medium list-group-flush list-group-sm list-borderless">
            <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
              <div class="fw-medium text-truncate text-muted mb-0">Web Development</div>
              <span class="fs-12">250</span>
            </li>
            <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
              <div class="fw-medium text-truncate text-muted mb-0">Mobile Development</div>
              <span class="fs-12">120</span>
            </li>
            <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
              <div class="fw-medium text-truncate text-muted mb-0">DevOps</div>
              <span class="fs-12">320</span>
            </li>
            <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
              <div class="fw-medium text-truncate text-muted mb-0">Cloud Computing</div>
              <span class="fs-12">450</span>
            </li>
            <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
              <div class="fw-medium text-truncate text-muted mb-0">Data Science</div>
              <span class="fs-12">180</span>
            </li>
            <!-- Collapsible Content Area -->
            <li class="list-unstyled">
              <ul class="collapse" id="collapseEmailContent">
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">Software Engineering</div>
                  <span class="fs-12">210</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">UI/UX Design</div>
                  <span class="fs-12">220</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">API Development</div>
                  <span class="fs-12">160</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">Testing & QA</div>
                  <span class="fs-12">90</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">Software Tools</div>
                  <span class="fs-12">250</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">Tech News</div>
                  <span class="fs-12">80</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">Developer Tools</div>
                  <span class="fs-12">400</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">Emerging Technologies</div>
                  <span class="fs-12">50</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">Software Architecture</div>
                  <span class="fs-12">220</span>
                </li>
                <li class="list-group-item list-hover-arrow hstack justify-content-between gap-2">
                  <div class="fw-medium text-truncate text-muted mb-0">Personal Projects</div>
                  <span class="fs-12">180</span>
                </li>
              </ul>
            </li>
            <li class="list-group-item show-all">
              <div class="custom-toggle fs-12 text-muted d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseEmailContent" aria-expanded="false" aria-controls="collapseEmailContent" role="button">
                <span class="icon-on">
                  Show Less
                  <i class="ri-arrow-up-s-line ms-2"></i>
                </span>
                <span class="icon-off">
                  Show All
                  <i class="ri-arrow-down-s-line ms-2"></i>
                </span>
              </div>
            </li>
          </ul>
        </div>
        <div class="border-top mt-5 pt-5">
          <h5 class="mb-5">Popular Posts</h5>
          <div class="vstack gap-3">
            <div class="hstack gap-3 border-bottom pb-3">
              <div class="flex-shrink-0">
                <img src="{{ asset('assets/images/blog/blog-small-1.jpg') }}" class="img-fluid w-75px rounded-1" alt="Web Development">
              </div>
              <div class="flex-grow-1 overflow-hidden">
                <h6 class="mb-0 text-truncate">
                  <a href="#!" class="text-decoration-none text-truncate text-body-emphasis fs-16 fw-semibold">Web Development Trends 2025</a>
                </h6>
                <p class="text-muted fs-13 lh-base mt-1 mb-0 text-truncate-2">Explore key trends shaping web development in 2025.</p>
              </div>
            </div>

            <div class="hstack gap-3 border-bottom pb-3">
              <div class="flex-shrink-0">
                <img src="{{ asset('assets/images/blog/blog-small-2.jpg') }}" class="img-fluid w-75px rounded-1" alt="Mobile Development">
              </div>
              <div class="flex-grow-1 overflow-hidden">
                <h6 class="mb-0 text-truncate">
                  <a href="#!" class="text-decoration-none text-truncate text-body-emphasis fs-16 fw-semibold">Top Mobile Development Frameworks</a>
                </h6>
                <p class="text-muted fs-13 lh-base mt-1 mb-0 text-truncate-2">Discover popular frameworks for mobile app development.</p>
              </div>
            </div>

            <div class="hstack gap-3 border-bottom pb-3">
              <div class="flex-shrink-0">
                <img src="{{ asset('assets/images/blog/blog-small-3.jpg') }}" class="img-fluid w-75px rounded-1" alt="DevOps">
              </div>
              <div class="flex-grow-1 overflow-hidden">
                <h6 class="mb-0 text-truncate">
                  <a href="#!" class="text-decoration-none text-truncate text-body-emphasis fs-16 fw-semibold">Understanding DevOps Culture</a>
                </h6>
                <p class="text-muted fs-13 lh-base mt-1 mb-0 text-truncate-2">Learn the core principles of DevOps culture.</p>
              </div>
            </div>

            <div class="hstack gap-3 border-bottom pb-3">
              <div class="flex-shrink-0">
                <img src="{{ asset('assets/images/blog/blog-small-4.jpg') }}" class="img-fluid w-75px rounded-1" alt="Machine Learning">
              </div>
              <div class="flex-grow-1 overflow-hidden">
                <h6 class="mb-0 text-truncate">
                  <a href="#!" class="text-decoration-none text-truncate text-body-emphasis fs-16 fw-semibold">Machine Learning in 2025: What's Next?</a>
                </h6>
                <p class="text-muted fs-13 lh-base mt-1 mb-0 text-truncate-2">What’s on the horizon for machine learning in 2025?</p>
              </div>
            </div>

            <div class="hstack gap-3">
              <div class="flex-shrink-0">
                <img src="{{ asset('assets/images/blog/blog-small-5.jpg') }}" class="img-fluid w-75px rounded-1" alt="Cybersecurity">
              </div>
              <div class="flex-grow-1 overflow-hidden">
                <h6 class="mb-0 text-truncate">
                  <a href="#!" class="text-decoration-none text-truncate text-body-emphasis fs-16 fw-semibold">Cybersecurity Best Practices for Developers</a>
                </h6>
                <p class="text-muted fs-13 lh-base mt-1 mb-0 text-truncate-2">Essential tips to secure your applications.</p>
              </div>
            </div>
          </div>

        </div>
        <div class="border-top mt-5 pt-5">
          <h5 class="mb-5">Tags</h5>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-muted">Web Development</span>
            <span class="badge bg-light text-muted">Mobile Development</span>
            <span class="badge bg-light text-muted">Open Source</span>
            <span class="badge bg-light text-muted">DevOps</span>
            <span class="badge bg-light text-muted">Machine Learning</span>
            <span class="badge bg-light text-muted">API Development</span>
            <span class="badge bg-light text-muted">Cybersecurity</span>
            <span class="badge bg-light text-muted">Data Science</span>
            <span class="badge bg-light text-muted">UI/UX Design</span>
            <span class="badge bg-light text-muted">Software Engineering</span>
            <span class="badge bg-light text-muted">Cloud Computing</span>
            <span class="badge bg-light text-muted">Career Development</span>
          </div>
        </div>
        <div class="border-top mt-5 pt-5">
          <h5 class="mb-5">Gallery</h5>
          <div class="row g-2 gy-3">
            <div class="col-4">
              <a href="{{ asset('assets/images/gallery/image-1.jpg') }}" class="thumbnail lightbox">
                <img src="{{ asset('assets/images/gallery/image-1.jpg') }}" class="img-fluid rounded-2" alt="gallery image">
              </a>
            </div><!-- .col -->
            <div class="col-4">
              <a href="{{ asset('assets/images/gallery/image-2.jpg') }}" class="thumbnail lightbox">
                <img src="{{ asset('assets/images/gallery/image-2.jpg') }}" class="img-fluid rounded-2" alt="gallery image">
              </a>
            </div><!-- .col -->
            <div class="col-4">
              <a href="{{ asset('assets/images/gallery/image-3.jpg') }}" class="thumbnail lightbox">
                <img src="{{ asset('assets/images/gallery/image-3.jpg') }}" class="img-fluid rounded-2" alt="gallery image">
              </a>
            </div><!-- .col -->
            <div class="col-4">
              <a href="{{ asset('assets/images/gallery/image-4.jpg') }}" class="thumbnail lightbox">
                <img src="{{ asset('assets/images/gallery/image-4.jpg') }}" class="img-fluid rounded-2" alt="gallery image">
              </a>
            </div><!-- .col -->
            <div class="col-4">
              <a href="{{ asset('assets/images/gallery/image-5.jpg') }}" class="thumbnail lightbox">
                <img src="{{ asset('assets/images/gallery/image-5.jpg') }}" class="img-fluid rounded-2" alt="gallery image">
              </a>
            </div><!-- .col -->
            <div class="col-4">
              <a href="{{ asset('assets/images/gallery/image-6.jpg') }}" class="thumbnail lightbox">
                <img src="{{ asset('assets/images/gallery/image-6.jpg') }}" class="img-fluid rounded-2" alt="gallery image">
              </a>
            </div><!-- .col -->
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

@section('js')

  <!-- Lightbox2 js -->
  <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Blog init -->
  <script src="{{ asset('assets/js/pages/blog.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection