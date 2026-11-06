@extends('partials.layouts.master2')

    @section('title', 'Blog Details | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Blog Details' )
    @section('pagetitle', 'Chart')
    @section('buttonTitle', 'View All')
    @section('link', 'apps-invoices-list')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">

@endsection
    @section('content')

  <div class="row g-4 blog">
    <div class="col-md-8 col-lg-8 col-xl-9">
      <div class="card card-body">
        <div class="row g-2">
          <div class="col-sm-6">
            <div>
              <img src="{{ asset('assets/images/small/img-7.jpg') }}" class="img-fluid rounded" alt="User Image">
            </div>
            <div class="row gx-2 mt-2">
              <div class="col-6">
                <img src="{{ asset('assets/images/small/img-2.jpg') }}" class="img-fluid rounded" alt="User Image">
              </div>
              <div class="col-6">
                <img src="{{ asset('assets/images/small/img-3.jpg') }}" class="img-fluid rounded" alt="User Image">
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div>
              <img src="{{ asset('assets/images/small/img-8.jpg') }}" class="img-fluid rounded" alt="User Image">
            </div>
            <div class="row gx-2 mt-2">
              <div class="col-6">
                <img src="{{ asset('assets/images/small/img-5.jpg') }}" class="img-fluid rounded" alt="User Image">
              </div>
              <div class="col-6">
                <img src="{{ asset('assets/images/small/img-1.jpg') }}" class="img-fluid rounded" alt="User Image">
              </div>
            </div>
          </div>
        </div>

        <div class="pt-6">
          <div class="d-flex align-items-center justify-content-between mb-3 overflow-hidden">
            <h5 class="mb-0 text-truncate-2">Using a camera's lens to record moments in time is the art form known as photography.</h5>
            <span class="badge bg-light text-muted">Photography</span>
          </div>
          <div class="d-sm-flex align-items-center mb-3">
            <div class="flex-grow-1 d-flex align-items-center gap-2">
              <div class="avatar-item w-max">
                <img class="img-fluid avatar" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Author Avatar">
              </div>
              <div>
                <h5 class="card-title mb-0"><a href="pages-profile-overview" class="text-body">Dev Team</a></h5>
                <p class="text-muted fs-11 mb-0"><i class="ri-time-line me-1"></i>January, 6, 2025</p>
              </div>
            </div>
            <div class="btn-list mt-sm-0 mt-2">
              <button type="button" class="btn btn-sm btn-light-primary fw-medium custom-toggle" aria-pressed="false">
                <span class="icon-off lh-base">
                  <i class="ri-heart-line me-1"></i>124 Likes
                </span>
                <span class="icon-on lh-base">
                  <i class="ri-heart-fill me-1"></i>125 Likes
                </span>
              </button>
              <button class="btn btn-sm fw-medium btn-light-secondary" data-bs-toggle="modal" data-bs-target="#shareModal">
                <i class="ri-share-line me-1"></i>Share
              </button>
            </div>
          </div>
          <p class="mb-4">To produce aesthetically striking photos, it entails the deft use of light, composition, and subject matter. Technology breakthroughs have made photography more widely available to the public, enabling people to express their creativity and share their own viewpoints with a global audience. Photographers use meticulous attention to details like colour balance, depth of focus, and framing to produce visually stunning photos that arouse emotions and convey stories.</p>

          <p class="mb-4">From the therapeutic rhythms of drumming circles to the transcendent harmonies of choral singing, <span class="fs-14 fw-medium">"Music for the Soul"</span> celebrates the diverse ways in which music enriches our lives and nourishes our innermost being. Whether you're seeking refuge from the stresses of daily life, seeking inspiration for your artistic pursuits, or simply yearning to connect with something greater than yourself, photography has a similar way of capturing the essence of our experiences.</p>

          <p class="mb-4">There are many diverse genres within the realm of photography, such as fashion, landscape, portrait, and documentary photography. Each genre requires a unique blend of technical skills and creative vision. Expert photographers have a thorough understanding of their gear and know how to get the best results by experimenting with different lenses, lighting setups, and post-processing software.</p>

          <p class="mb-4"> From the therapeutic rhythms of drumming circles to the transcendent harmonies of choral singing,
            <span class="fs-14 fw-medium"> "Music for the Soul" </span>
            celebrates the diverse ways in which music enriches our lives and nourishes our innermost being.. Whether you're seeking refuge from the stresses of daily life, seeking inspiration for your artistic pursuits, or simply yearning to connect with something greater than yourself.
          </p>

          <p class="mb-0">For those interested in mastering the art of photography, it is essential to develop both technical proficiency and an eye for composition. Whether you're shooting a portrait, capturing a breathtaking landscape, or documenting everyday life, a strong understanding of your camera's settings, as well as a keen sense of the aesthetic, can help you craft truly remarkable images that stand the test of time.</p>
        </div>
      </div>

      <div class="card custom-card overflow-hidden">
        <div class="card-header">
          <div class="card-title mb-0 fw-semibold"> Comments </div>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush max-h-384px" data-simplebar>
            <!-- Comment 1 -->
            <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
              <div class="flex-shrink-0">
                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="User Image" class="avatar rounded-circle">
              </div>
              <div class="flex-grow-1 ms-3">
                <div class="hstack justify-content-between gap-2">
                  <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">David Harris <small class="text-muted">25 Feb 2025 - 10:00AM</small></h5>
                  <div class="d-flex align-items-center gap-1">
                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle" aria-pressed="false">
                      <span class="icon-on">
                        <i class="ri-thumb-up-fill"></i>
                      </span>
                      <span class="icon-off">
                        <i class="ri-thumb-up-line"></i>
                      </span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle" aria-pressed="false">
                      <span class="icon-on">
                        <i class="ri-thumb-down-fill"></i>
                      </span>
                      <span class="icon-off">
                        <i class="ri-thumb-down-line"></i>
                      </span>
                    </button>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share</a></li>
                        <li><a class="dropdown-item" href="#!">Edit</a></li>
                        <li><a class="dropdown-item delete-item delete-btn" href="#!">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <p class="text-muted mb-2">The Impact of a Healthy Diet on Mental Clarity: Nutrition plays a key role in improving focus, memory, and overall brain performance.</p>
                <a href="#!" class="badge bg-light text-muted">Reply <i class="ri-reply-line ms-1"></i></a>
                <div class="d-flex mt-4">
                  <div class="flex-shrink-0">
                    <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="User Image" class="avatar rounded-circle">
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h5 class="fs-13">Dr. Olivia Carter <small class="text-muted ms-2">25 Feb 2025 - 10:30AM</small></h5>
                    <p class="text-muted mb-2">Sure! I'll take a closer look at the role of a healthy diet in mental clarity. It’s such an important topic!</p>
                    <a href="#!" class="badge bg-light text-muted">Reply <i class="ri-reply-line ms-1"></i></a>
                  </div>
                </div>
              </div>
            </li>

            <!-- Comment 2 -->
            <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
              <div class="flex-shrink-0">
                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="User Image" class="avatar rounded-circle">
              </div>
              <div class="flex-grow-1 ms-3">
                <div class="hstack justify-content-between gap-2">
                  <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">David Harris <small class="text-muted">28 Feb 2025 - 02:00PM</small></h5>
                  <div class="d-flex align-items-center gap-1">
                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle" aria-pressed="false">
                      <span class="icon-on">
                        <i class="ri-thumb-up-fill"></i>
                      </span>
                      <span class="icon-off">
                        <i class="ri-thumb-up-line"></i>
                      </span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle" aria-pressed="false">
                      <span class="icon-on">
                        <i class="ri-thumb-down-fill"></i>
                      </span>
                      <span class="icon-off">
                        <i class="ri-thumb-down-line"></i>
                      </span>
                    </button>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share</a></li>
                        <li><a class="dropdown-item" href="#!">Edit</a></li>
                        <li><a class="dropdown-item delete-item delete-btn" href="#!">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <p class="text-muted mb-2">Optimizing Brain Health with the Right Nutrition: Brain health is heavily influenced by the foods we consume. Key nutrients can promote cognitive function and mental performance.</p>
                <a href="#!" class="badge bg-light text-muted">Reply <i class="ri-reply-line ms-1"></i></a>
                <div class="d-flex mt-4">
                  <div class="flex-shrink-0">
                    <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="User Image" class="avatar rounded-circle">
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h5 class="fs-13">Dr. Olivia Carter <small class="text-muted ms-2">28 Feb 2025 - 02:30PM</small></h5>
                    <p class="text-muted mb-2">I agree! A good diet is key to maintaining a sharp mind. I will look deeper into which foods contribute most to cognitive health.</p>
                    <a href="#!" class="badge bg-light text-muted">Reply <i class="ri-reply-line ms-1"></i></a>
                  </div>
                </div>
              </div>
            </li>

            <!-- Comment 3 -->
            <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
              <div class="flex-shrink-0">
                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="User Image" class="avatar rounded-circle">
              </div>
              <div class="flex-grow-1 ms-3">
                <div class="hstack justify-content-between gap-2">
                  <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">David Harris <small class="text-muted">28 Feb 2025 - 04:00PM</small></h5>
                  <div class="d-flex align-items-center gap-1">
                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle" aria-pressed="false">
                      <span class="icon-on">
                        <i class="ri-thumb-up-fill"></i>
                      </span>
                      <span class="icon-off">
                        <i class="ri-thumb-up-line"></i>
                      </span>
                    </button>
                    <button type="button" class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle" aria-pressed="false">
                      <span class="icon-on">
                        <i class="ri-thumb-down-fill"></i>
                      </span>
                      <span class="icon-off">
                        <i class="ri-thumb-down-line"></i>
                      </span>
                    </button>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light-primary icon-btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#shareModal">Share</a></li>
                        <li><a class="dropdown-item" href="#!">Edit</a></li>
                        <li><a class="dropdown-item delete-item delete-btn" href="#!">Delete</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <p class="text-muted mb-2">The Power of Proper Sleep: Good sleep hygiene is crucial for maintaining productivity, focus, and overall well-being.</p>
                <a href="#!" class="badge bg-light text-muted">Reply <i class="ri-reply-line ms-1"></i></a>
                <div class="d-flex mt-4">
                  <div class="flex-shrink-0">
                    <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="User Image" class="avatar rounded-circle">
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h5 class="fs-13">Dr. Olivia Carter <small class="text-muted ms-2">28 Feb 2025 - 04:30PM</small></h5>
                    <p class="text-muted mb-2">Agreed! Sleep is often underestimated, but it's a pillar of health. I’ll be working on an article about its effects on cognitive abilities soon.</p>
                    <a href="#!" class="badge bg-light text-muted">Reply <i class="ri-reply-line ms-1"></i></a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="card mb-0">
        <div class="card-header">
          <div class="card-title mb-0 fw-semibold"> Leave a Comment </div>
        </div>
        <div class="card-body">
          <div class="row gy-3">
            <div class="col-xl-6">
              <label for="blog-first-name" class="form-label">First Name</label>
              <input type="text" class="form-control" id="blog-first-name" placeholder="Enter Name">
            </div>
            <div class="col-xl-6">
              <label for="blog-email" class="form-label">Email ID</label>
              <input type="text" class="form-control" id="blog-email" placeholder="Enter Email">
            </div>
            <div class="col-xl-12">
              <label for="blog-comment" class="form-label">Write Comment</label>
              <textarea class="form-control" id="blog-comment" rows="4" placeholder="Write Here......."></textarea>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="text-end">
            <button class="btn btn-primary">Post Comment</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-lg-4 col-xl-3">
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
