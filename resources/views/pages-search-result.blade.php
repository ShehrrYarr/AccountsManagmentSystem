@extends('partials.layouts.master3')

    @section('title', 'Search Result | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Search Result' )
    @section('pagetitle', 'Pages')
    @section('buttonTitle', 'Share')
    @section('link', 'index')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/plyr/plyr.css') }}">
    @endsection
    @section('content')

  <div class="card">
    <div class="card-body">
      <div class="hstack gap-3 mb-3">
        <div class="form-icon flex-grow-1">
          <i class="ri-search-line text-muted"></i>
          <input type="search" class="form-control form-control-icon" id="firstNameLayout6" placeholder="Search here">
        </div>
        <div class="hstack gap-3 flex-shrink-0">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </div>

      <div class="hstack flex-wrap gap-2 my-4">
        <span class="badge bg-light text-muted">Designs <i class="ri-close-line cursor-pointer"></i></span>
        <span class="badge bg-light text-muted">Template <i class="ri-close-line cursor-pointer"></i></span>
        <span class="badge bg-light text-muted">Dashboard <i class="ri-close-line cursor-pointer"></i></span>
        <span class="badge bg-light text-muted">Admin Templates <i class="ri-close-line cursor-pointer"></i></span>
        <span class="badge bg-light text-muted">Templates <i class="ri-close-line cursor-pointer"></i></span>
      </div>

      <div class="hstack flex-wrap gap-2">
        <div class="project-dashboard flex-grow-1">
          <ul class="nav gap-2 custom-verti-nav-pills text-center" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" data-bs-toggle="tab" href="#search-all-result" role="tab" aria-selected="true"><i class="ri-search-2-line text-muted align-bottom me-1"></i> All Results</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-bs-toggle="tab" href="#search-images" role="tab" aria-selected="false" tabindex="-1"><i class="ri-image-fill text-muted align-bottom me-1"></i> Images</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-bs-toggle="tab" href="#search-videos" role="tab" aria-selected="false" tabindex="-1"><i class="ri-video-line text-muted align-bottom me-1"></i> Videos</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" data-bs-toggle="tab" href="#search-shopping" role="tab" aria-selected="false" tabindex="-1"><i class="ri-video-line text-muted align-bottom me-1"></i> Shopping</a>
            </li>
          </ul>
        </div>
        <div class="flex-shrink-0">
          <button class="btn btn-sm btn-light-primary" type="button" data-bs-toggle="collapse" data-bs-target="#advanced-search-input" aria-expanded="false" aria-controls="advanced-search-input">
            Advanced Search
          </button>
        </div>
      </div>

      <div class="collapse mt-4" id="advanced-search-input">
        <div class="row g-4">
          <div class="col-md-6">
            <label class="form-label" for="product-status">Status<span class="text-danger fw-semibold ps-1">*</span></label>
            <select id="product-status">
              <option value="draft" selected>Draft</option>
              <option value="published">Published</option>
              <option value="scheduled">Scheduled</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
          <div class="col-md-6 scheduled-input">
            <label class="form-label" for="publishing-date">Select publishing date and time</label>
            <input type="text" class="form-control" id="publishing-date" placeholder="Pick date & time">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="product-tags">Tags<span class="text-danger fw-semibold ps-1">*</span></label>
            <input id="product-tags" class='form-control' placeholder='Enter tags here' value="Clothing">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap mb-4">
    <h5 class="mb-0">Search Results</h5>
    <select id="choices-multiple-close-icon">
      <option value="Any time">Any time</option>
      <option value="Past hour">Past hour</option>
      <option value="Past 24 hours">Past 24 hours</option>
      <option value="Past week">Past week</option>
      <option value="Past month">Past month</option>
      <option value="Past year">Past year</option>
    </select>
  </div>

  <div class="tab-content">

    <div class="tab-pane active show" id="search-all-result" role="tabpanel">

      <!-- Search Results Header -->
      <div class="card mb-0">
        <div class="card-header">
          <div class="hstack gap-3 flex-wrap justify-content-between">
            <h5 class="fw-normal text-muted m-0 fs-14">There are <span class="fw-semibold text-body fs-13">55,142</span> results in total.</h5>
            <span class="text-muted">Showing 1-10 of 55,142 results</span>
          </div>
        </div>
        <div class="card-body">

          <div class="vstack gap-4">

            <!-- Search Result 1 -->
            <div class="d-flex gap-3 justify-content-between border border-dashed rounded-3 p-4">
              <div class="flex-grow-1 d-flex justify-content-between gap-3 overflow-hidden">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/small/img-2.jpg') }}" alt="Web Development Article" class="img-fluid rounded-3 avatar-xl border-0 object-fit-cover avatar-item">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                  <h5 class="mb-0"><a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Using_promises" class="fs-5 text-reset text-truncate-2">Mastering JavaScript Promises: A Guide for Modern Web Apps</a></h5>
                  <p class="mb-1 fs-12">https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Using_promises</p>
                  <p class="fs-13 lh-sm text-truncate-2 text-muted mb-2">
                    Learn the essential techniques of handling asynchronous operations in JavaScript using promises. This guide covers promise chaining, error handling, and how to effectively use async/await for better code structure and readability.
                  </p>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <p class="mb-0 text-primary fw-semibold fs-12">Web Development</p>
                    <span class="w-4px h-4px align-middle rounded-circle bg-secondary-subtle"></span>
                    <p class="mb-0 text-muted fw-medium fs-12">By John Doe</p>
                  </div>
                </div>
              </div>
              <div class="dropdown flex-shrink-0">
                <a href="#!" class="btn icon-btn-sm btn-light-primary" id="taskactions1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                <ul class="dropdown-menu" aria-labelledby="taskactions1">
                  <li class="dropdown-item">Save</li>
                  <li class="dropdown-item">Share</li>
                  <li class="dropdown-item">Report</li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li class="dropdown-item delete-item delete-btn">Remove</li>
                </ul>
              </div>
            </div>

            <!-- Search Result 2 -->
            <div class="d-flex gap-3 justify-content-between border border-dashed rounded-3 p-4">
              <div class="flex-grow-1 d-flex justify-content-between gap-3 overflow-hidden">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/small/img-3.jpg') }}" alt="CSS Guide" class="img-fluid rounded-3 avatar-xl border-0 object-fit-cover avatar-item">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                  <h5 class="mb-0"><a href="https://css-tricks.com/snippets/css/a-guide-to-flexbox/" class="fs-5 text-reset text-truncate-2">A Complete Guide to Flexbox</a></h5>
                  <p class="mb-1 fs-12">https://css-tricks.com/snippets/css/a-guide-to-flexbox/</p>
                  <p class="fs-13 lh-sm text-truncate-2 text-muted mb-2">
                    This guide will help you master Flexbox and create dynamic layouts in CSS. It covers everything from the basic concepts to advanced use cases, with practical examples.
                  </p>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <p class="mb-0 text-primary fw-semibold fs-12">CSS Design</p>
                    <span class="w-4px h-4px align-middle rounded-circle bg-secondary-subtle"></span>
                    <p class="mb-0 text-muted fw-medium fs-12">By Sarah Lee</p>
                  </div>
                </div>
              </div>
              <div class="dropdown flex-shrink-0">
                <a href="#!" class="btn icon-btn-sm btn-light-primary" id="taskactions2" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                <ul class="dropdown-menu" aria-labelledby="taskactions2">
                  <li class="dropdown-item">Save</li>
                  <li class="dropdown-item">Share</li>
                  <li class="dropdown-item">Report</li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li class="dropdown-item delete-item delete-btn">Remove</li>
                </ul>
              </div>
            </div>

            <!-- Search Result 3 -->
            <div class="d-flex gap-3 justify-content-between border border-dashed rounded-3 p-4">
              <div class="flex-grow-1 d-flex justify-content-between gap-3 overflow-hidden">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/small/img-4.jpg') }}" alt="Web Accessibility" class="img-fluid rounded-3 avatar-xl border-0 object-fit-cover avatar-item">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                  <h5 class="mb-0"><a href="https://www.w3.org/WAI/test-evaluate/" class="fs-5 text-reset text-truncate-2">How to Test Web Accessibility: Tools and Techniques</a></h5>
                  <p class="mb-1 fs-12">https://www.w3.org/WAI/test-evaluate/</p>
                  <p class="fs-13 lh-sm text-truncate-2 text-muted mb-2">
                    Learn how to use various web accessibility tools to ensure that your website is accessible to people with disabilities. This article explains the importance of web accessibility and offers practical techniques for testing.
                  </p>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <p class="mb-0 text-primary fw-semibold fs-12">Web Accessibility</p>
                    <span class="w-4px h-4px align-middle rounded-circle bg-secondary-subtle"></span>
                    <p class="mb-0 text-muted fw-medium fs-12">By David Smith</p>
                  </div>
                </div>
              </div>
              <div class="dropdown flex-shrink-0">
                <a href="#!" class="btn icon-btn-sm btn-light-primary" id="taskactions3" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                <ul class="dropdown-menu" aria-labelledby="taskactions3">
                  <li class="dropdown-item">Save</li>
                  <li class="dropdown-item">Share</li>
                  <li class="dropdown-item">Report</li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li class="dropdown-item delete-item delete-btn">Remove</li>
                </ul>
              </div>
            </div>

            <!-- Search Result 4 -->
            <div class="d-flex gap-3 justify-content-between border border-dashed rounded-3 p-4">
              <div class="flex-grow-1 d-flex justify-content-between gap-3 overflow-hidden">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/small/img-5.jpg') }}" alt="JavaScript Basics" class="img-fluid rounded-3 avatar-xl border-0 object-fit-cover avatar-item">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                  <h5 class="mb-0"><a href="https://www.freecodecamp.org/news/javascript-tutorial-for-beginners/" class="fs-5 text-reset text-truncate-2">JavaScript Basics for Beginners</a></h5>
                  <p class="mb-1 fs-12">https://www.freecodecamp.org/news/javascript-tutorial-for-beginners/</p>
                  <p class="fs-13 lh-sm text-truncate-2 text-muted mb-2">
                    This is a beginner-friendly guide that will take you through the basics of JavaScript. You will learn how to use variables, functions, loops, and other JavaScript essentials.
                  </p>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <p class="mb-0 text-primary fw-semibold fs-12">JavaScript</p>
                    <span class="w-4px h-4px align-middle rounded-circle bg-secondary-subtle"></span>
                    <p class="mb-0 text-muted fw-medium fs-12">By Emily Green</p>
                  </div>
                </div>
              </div>
              <div class="dropdown flex-shrink-0">
                <a href="#!" class="btn icon-btn-sm btn-light-primary" id="taskactions4" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                <ul class="dropdown-menu" aria-labelledby="taskactions4">
                  <li class="dropdown-item">Save</li>
                  <li class="dropdown-item">Share</li>
                  <li class="dropdown-item">Report</li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li class="dropdown-item delete-item delete-btn">Remove</li>
                </ul>
              </div>
            </div>

            <!-- Search Result 5 -->
            <div class="d-flex gap-3 justify-content-between border border-dashed rounded-3 p-4">
              <div class="flex-grow-1 d-flex justify-content-between gap-3 overflow-hidden">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/gallery/project-img-2.jpg') }}" alt="Responsive Design" class="img-fluid rounded-3 avatar-xl border-0 object-fit-cover avatar-item">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                  <h5 class="mb-0"><a href="https://www.smashingmagazine.com/2011/01/guidelines-for-responsive-web-design/" class="fs-5 text-reset text-truncate-2">Guidelines for Responsive Web Design</a></h5>
                  <p class="mb-1 fs-12">https://www.smashingmagazine.com/2011/01/guidelines-for-responsive-web-design/</p>
                  <p class="fs-13 lh-sm text-truncate-2 text-muted mb-2">
                    This article explains the fundamental principles and guidelines for building responsive websites that adapt to various screen sizes and devices.
                  </p>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <p class="mb-0 text-primary fw-semibold fs-12">Web Design</p>
                    <span class="w-4px h-4px align-middle rounded-circle bg-secondary-subtle"></span>
                    <p class="mb-0 text-muted fw-medium fs-12">By Michael Sullivan</p>
                  </div>
                </div>
              </div>
              <div class="dropdown flex-shrink-0">
                <a href="#!" class="btn icon-btn-sm btn-light-primary" id="taskactions5" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                <ul class="dropdown-menu" aria-labelledby="taskactions5">
                  <li class="dropdown-item">Save</li>
                  <li class="dropdown-item">Share</li>
                  <li class="dropdown-item">Report</li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li class="dropdown-item delete-item delete-btn">Remove</li>
                </ul>
              </div>
            </div>

            <!-- Search Result 6 -->
            <div class="d-flex gap-3 justify-content-between border border-dashed rounded-3 p-4">
              <div class="flex-grow-1 d-flex justify-content-between gap-3 overflow-hidden">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/gallery/project-img-3.jpg') }}" alt="React JS" class="img-fluid rounded-3 avatar-xl border-0 object-fit-cover avatar-item">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                  <h5 class="mb-0"><a href="https://reactjs.org/docs/getting-started" class="fs-5 text-reset text-truncate-2">Getting Started with React</a></h5>
                  <p class="mb-1 fs-12">https://reactjs.org/docs/getting-started.html</p>
                  <p class="fs-13 lh-sm text-truncate-2 text-muted mb-2">
                    A comprehensive guide for beginners to start building applications with React, a popular JavaScript library for building user interfaces.
                  </p>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <p class="mb-0 text-primary fw-semibold fs-12">React JS</p>
                    <span class="w-4px h-4px align-middle rounded-circle bg-secondary-subtle"></span>
                    <p class="mb-0 text-muted fw-medium fs-12">By React Team</p>
                  </div>
                </div>
              </div>
              <div class="dropdown flex-shrink-0">
                <a href="#!" class="btn icon-btn-sm btn-light-primary" id="taskactions6" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                <ul class="dropdown-menu" aria-labelledby="taskactions6">
                  <li class="dropdown-item">Save</li>
                  <li class="dropdown-item">Share</li>
                  <li class="dropdown-item">Report</li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li class="dropdown-item delete-item delete-btn">Remove</li>
                </ul>
              </div>
            </div>

            <!-- Search Result 7 -->
            <div class="d-flex gap-3 justify-content-between border border-dashed rounded-3 p-4">
              <div class="flex-grow-1 d-flex justify-content-between gap-3 overflow-hidden">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/gallery/project-img-4.jpg') }}" alt="SEO Guide" class="img-fluid rounded-3 avatar-xl border-0 object-fit-cover avatar-item">
                </div>
                <div class="flex-grow-1 overflow-hidden">
                  <h5 class="mb-0"><a href="https://moz.com/beginners-guide-to-seo" class="fs-5 text-reset text-truncate-2">The Beginner's Guide to SEO</a></h5>
                  <p class="mb-1 fs-12">https://moz.com/beginners-guide-to-seo</p>
                  <p class="fs-13 lh-sm text-truncate-2 text-muted mb-2">
                    This beginner's guide to SEO explains how search engines work and provides strategies and tips for improving your website's search engine ranking.
                  </p>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <p class="mb-0 text-primary fw-semibold fs-12">SEO</p>
                    <span class="w-4px h-4px align-middle rounded-circle bg-secondary-subtle"></span>
                    <p class="mb-0 text-muted fw-medium fs-12">By Moz Team</p>
                  </div>
                </div>
              </div>
              <div class="dropdown flex-shrink-0">
                <a href="#!" class="btn icon-btn-sm btn-light-primary" id="taskactions7" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-fill"></i></a>
                <ul class="dropdown-menu" aria-labelledby="taskactions7">
                  <li class="dropdown-item">Save</li>
                  <li class="dropdown-item">Share</li>
                  <li class="dropdown-item">Report</li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li class="dropdown-item delete-item delete-btn">Remove</li>
                </ul>
              </div>
            </div>

          </div>

          <!-- Pagination -->
          <nav class="hstack justify-content-center mt-5 mb-1" aria-label="Page navigation">
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
      </div>

    </div>

    <div class="tab-pane" id="search-images" role="tabpanel">

      <div class="card">
        <div class="card-header">
          <div class="hstack gap-3 flex-wrap justify-content-between">
            <h5 class="fw-normal text-muted m-0 fs-14">There are <span class="fw-semibold text-body fs-13">55,142</span> results in total.</h5>
            <span class="text-muted">Showing 1-10 of 55,142 results</span>
          </div>
        </div>
      </div>
      <div class="masonry-grid">
        <div class="masonry-column">
          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-1.jpg') }}" alt="Photography">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Charming Concept</h3>
                <div class="text-white hover-fadeInRight">Photography</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-4.jpg') }}" alt="Fashion">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
                <div class="text-white hover-fadeInRight">Fashion</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-2.jpg') }}" alt="Inspiration">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Linear Architecture</h3>
                <div class="text-white hover-fadeInRight">Inspiration</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-3.jpg') }}" alt="Nature">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Endless Looks</h3>
                <div class="text-white hover-fadeInRight">Nature</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-4.jpg') }}" alt="Design">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Sleek Typography</h3>
                <div class="text-white hover-fadeInRight">Design</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-1.jpg') }}" alt="Fashion">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
                <div class="text-white hover-fadeInRight">Fashion</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-2.jpg') }}" alt="Fashion">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
                <div class="text-white hover-fadeInRight">Fashion</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-3.jpg') }}" alt="Fashion">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
                <div class="text-white hover-fadeInRight">Fashion</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-5.jpg') }}" alt="Fashion">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
                <div class="text-white hover-fadeInRight">Fashion</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-6.jpg') }}" alt="Fashion">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
                <div class="text-white hover-fadeInRight">Fashion</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-5.jpg') }}" alt="Fashion">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
                <div class="text-white hover-fadeInRight">Fashion</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-7.jpg') }}" alt="Food">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Orange Shine</h3>
                <div class="text-white hover-fadeInRight">Food</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-8.jpg') }}" alt="Health">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Boat Adventure</h3>
                <div class="text-white hover-fadeInRight">Health</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-6.jpg') }}" alt="Fashion">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
                <div class="text-white hover-fadeInRight">Fashion</div>
              </figcaption>
            </figure>
          </div>

          <div class="card card-body rounded rounded-4">
            <figure class="m-0 rounded-4 overflow-hidden position-relative h-100">
              <a href="#!" class="h-100 position-relative d-block">
                <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-9.jpg') }}" alt="Nature">
              </a>
              <figcaption>
                <h3 class="text-white hover-fadeInLeft">Offroad Moves</h3>
                <div class="text-white hover-fadeInRight">Nature</div>
              </figcaption>
            </figure>
          </div>

        </div>
      </div>

      <div class="hstack justify-content-center mt-5">
        <button type="button" class="btn btn-primary btn-loader">
          <span class="indicator-label">
            Load More
          </span>
          <span class="indicator-progress flex gap-2 align-items-center">
            <span>Loading...</span>
            <i class="ri-loader-2-fill"></i>
          </span>
        </button>
      </div>

    </div>

    <div class="tab-pane" id="search-videos" role="tabpanel">
      <!-- Search Results Header -->
      <div class="card mb-4">
        <div class="card-header">
          <div class="hstack gap-3 flex-wrap justify-content-between">
            <h5 class="fw-normal text-muted m-0 fs-14">There are <span class="fw-semibold text-body fs-13">55,142</span> results in total.</h5>
            <span class="text-muted">Showing 1-10 of 55,142 results</span>
          </div>
        </div>
      </div>

      <div class="vstack gap-3">
        <div class="card overflow-hidden list-element">
          <!-- Thumbnail Section -->
          <div id="video_player-1" class="plyr__video-embed h-100">
            <iframe class="h-100" src="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com" allowfullscreen allow="autoplay"></iframe>
          </div>

          <!-- Video Info Section -->
          <div class="card-body">
            <div class="hstack gap-3 mb-3">
              <!-- Video Title -->
              <h5 class="flex-grow-1 mb-0">
                <a href="https://www.youtube.com/watch?v=kPjw2-L8y2M" target="_blank" class="text-reset text-truncate-2 text-decoration-none">
                  Python for Beginners - Full Tutorial
                </a>
              </h5>
              <!-- Dropdown for Share, Download, and Other Options -->
              <div class="dropdown flex-shrink-0">
                <button class="btn btn-sm btn-light-primary" type="button" id="videoOptions1" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ri-more-2-fill"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="videoOptions1">
                  <li><a class="dropdown-item" href="#!"><i class="ri-share-line align-middle me-2"></i> Share</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-download-line align-middle me-2"></i> Download</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-save-line align-middle me-2"></i> Save to Playlist</a></li>
                </ul>
              </div>
            </div>

            <!-- Video Stats -->
            <ul class="list-inline d-flex flex-wrap align-items-center g-3 text-muted fs-14 mb-3">
              <li class="list-inline-item">
                <i class="ri-eye-line align-middle me-1"></i>500K views
              </li>
              <li class="list-inline-item">
                <i class="ri-calendar-line align-middle me-1"></i>1 week ago
              </li>
              <li class="list-inline-item">
                <div class="custom-toggle hstack gap-1 cursor-pointer" role="button" aria-pressed="false">
                  <span class="icon-off lh-base cursor-pointer">
                    <i class="ri-thumb-up-line align-middle me-1"></i>7.2K
                  </span>
                  <span class="icon-on lh-base cursor-pointer">
                    <i class="ri-thumb-up-fill align-middle me-1"></i>7.2K
                  </span>
                  Likes
                </div>
              </li>
            </ul>

            <!-- Video Description -->
            <p class="text-muted text-truncate-2 fs-14 mb-0">
              Learn Python programming from scratch. This tutorial covers all basics and fundamentals, perfect for complete beginners.
            </p>

            <!-- Channel Info -->
            <div class="d-flex gap-2 justify-content-between align-items-center mt-3">
              <div class="d-flex gap-2 align-items-center">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Channel Logo" class="avatar-sm avatar-item border-0">
                </div>
                <div class="flex-grow-1">
                  <span class="fw-medium">Tech With Tim</span><br>
                </div>
              </div>
              <div>
                <button type="button" class="btn btn-sm btn-outline-primary custom-toggle" aria-pressed="false">
                  <span class="icon-on">Unsubscribe</span>
                  <span class="icon-off">Subscribe</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="card overflow-hidden list-element">
          <!-- Thumbnail Section -->
          <div id="video_player-2" class="plyr__video-embed h-100">
            <iframe class="h-100" src="https://www.youtube.com/embed/dQw4w9WgXcQ?enablejsapi=1&origin=http://example.com" allowfullscreen allow="autoplay"></iframe>
          </div>

          <!-- Video Info Section -->
          <div class="card-body">
            <div class="hstack gap-3 mb-3">
              <!-- Video Title -->
              <h5 class="flex-grow-1 mb-0">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="text-reset text-truncate-2 text-decoration-none">
                  Digital Marketing for Beginners - Learn SEO, SEM & More
                </a>
              </h5>
              <!-- Dropdown for Share, Download, and Other Options -->
              <div class="dropdown flex-shrink-0">
                <button class="btn btn-sm btn-light-primary" type="button" id="videoOptions2" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ri-more-2-fill"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="videoOptions2">
                  <li><a class="dropdown-item" href="#!"><i class="ri-share-line align-middle me-2"></i> Share</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-download-line align-middle me-2"></i> Download</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-save-line align-middle me-2"></i> Save to Playlist</a></li>
                </ul>
              </div>
            </div>

            <!-- Video Stats -->
            <ul class="list-inline d-flex flex-wrap align-items-center g-3 text-muted fs-14 mb-3">
              <li class="list-inline-item">
                <i class="ri-eye-line align-middle me-1"></i>15M views
              </li>
              <li class="list-inline-item">
                <i class="ri-calendar-line align-middle me-1"></i>1 month ago
              </li>
              <li class="list-inline-item">
                <div class="custom-toggle hstack gap-1 cursor-pointer" role="button" aria-pressed="false">
                  <span class="icon-off lh-base cursor-pointer">
                    <i class="ri-thumb-up-line align-middle me-1"></i>50K
                  </span>
                  <span class="icon-on lh-base cursor-pointer">
                    <i class="ri-thumb-up-fill align-middle me-1"></i>50K
                  </span>
                  Likes
                </div>
              </li>
            </ul>

            <!-- Video Description -->
            <p class="text-muted text-truncate-2 fs-14 mb-0">
              Master the essentials of digital marketing in this comprehensive tutorial, covering SEO, SEM, and everything in between.
            </p>

            <!-- Channel Info -->
            <div class="d-flex gap-2 justify-content-between align-items-center mt-3">
              <div class="d-flex gap-2 align-items-center">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Channel Logo" class="avatar-sm avatar-item border-0">
                </div>
                <div class="flex-grow-1">
                  <span class="fw-medium">Neil Patel</span><br>
                </div>
              </div>
              <div>
                <button type="button" class="btn btn-sm btn-outline-primary custom-toggle" aria-pressed="false">
                  <span class="icon-on">Unsubscribe</span>
                  <span class="icon-off">Subscribe</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="card overflow-hidden list-element">
          <!-- Thumbnail Section -->
          <div id="video_player-3" class="plyr__video-embed h-100">
            <iframe class="h-100" src="https://www.youtube.com/embed/JwSS70SZdyM?enablejsapi=1&origin=http://example.com" allowfullscreen allow="autoplay"></iframe>
          </div>

          <!-- Video Info Section -->
          <div class="card-body">
            <div class="hstack gap-3 mb-3">
              <!-- Video Title -->
              <h5 class="flex-grow-1 mb-0">
                <a href="https://www.youtube.com/watch?v=JwSS70SZdyM" target="_blank" class="text-reset text-truncate-2 text-decoration-none">
                  Learn JavaScript in 10 Minutes
                </a>
              </h5>
              <!-- Dropdown for Share, Download, and Other Options -->
              <div class="dropdown flex-shrink-0">
                <button class="btn btn-sm btn-light-primary" type="button" id="videoOptions3" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ri-more-2-fill"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="videoOptions3">
                  <li><a class="dropdown-item" href="#!"><i class="ri-share-line align-middle me-2"></i> Share</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-download-line align-middle me-2"></i> Download</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-save-line align-middle me-2"></i> Save to Playlist</a></li>
                </ul>
              </div>
            </div>

            <!-- Video Stats -->
            <ul class="list-inline d-flex flex-wrap align-items-center g-3 text-muted fs-14 mb-3">
              <li class="list-inline-item">
                <i class="ri-eye-line align-middle me-1"></i>3M views
              </li>
              <li class="list-inline-item">
                <i class="ri-calendar-line align-middle me-1"></i>2 weeks ago
              </li>
              <li class="list-inline-item">
                <div class="custom-toggle hstack gap-1 cursor-pointer" role="button" aria-pressed="false">
                  <span class="icon-off lh-base cursor-pointer">
                    <i class="ri-thumb-up-line align-middle me-1"></i>8K
                  </span>
                  <span class="icon-on lh-base cursor-pointer">
                    <i class="ri-thumb-up-fill align-middle me-1"></i>8K
                  </span>
                  Likes
                </div>
              </li>
            </ul>

            <!-- Video Description -->
            <p class="text-muted text-truncate-2 fs-14 mb-0">
              This tutorial will teach you the basics of JavaScript in just 10 minutes, perfect for absolute beginners.
            </p>

            <!-- Channel Info -->
            <div class="d-flex gap-2 justify-content-between align-items-center mt-3">
              <div class="d-flex gap-2 align-items-center">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="Channel Logo" class="avatar-sm avatar-item border-0">
                </div>
                <div class="flex-grow-1">
                  <span class="fw-medium">Codecademy</span><br>
                </div>
              </div>
              <div>
                <button type="button" class="btn btn-sm btn-outline-primary custom-toggle" aria-pressed="false">
                  <span class="icon-on">Unsubscribe</span>
                  <span class="icon-off">Subscribe</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="card overflow-hidden list-element">
          <!-- Thumbnail Section -->
          <div id="video_player-4" class="plyr__video-embed h-100">
            <iframe class="h-100" src="https://www.youtube.com/embed/JwSS70SZdyM?enablejsapi=1&origin=http://example.com" allowfullscreen allow="autoplay"></iframe>
          </div>

          <!-- Video Info Section -->
          <div class="card-body">
            <div class="hstack gap-3 mb-3">
              <!-- Video Title -->
              <h5 class="flex-grow-1 mb-0">
                <a href="https://www.youtube.com/watch?v=T8lrQGh7pyI" target="_blank" class="text-reset text-truncate-2 text-decoration-none">
                  Full Stack Development - Project-Based Learning
                </a>
              </h5>
              <!-- Dropdown for Share, Download, and Other Options -->
              <div class="dropdown flex-shrink-0">
                <button class="btn btn-sm btn-light-primary" type="button" id="videoOptions4" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ri-more-2-fill"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="videoOptions4">
                  <li><a class="dropdown-item" href="#!"><i class="ri-share-line align-middle me-2"></i> Share</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-download-line align-middle me-2"></i> Download</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-save-line align-middle me-2"></i> Save to Playlist</a></li>
                </ul>
              </div>
            </div>

            <!-- Video Stats -->
            <ul class="list-inline d-flex flex-wrap align-items-center g-3 text-muted fs-14 mb-3">
              <li class="list-inline-item">
                <i class="ri-eye-line align-middle me-1"></i>2.5M views
              </li>
              <li class="list-inline-item">
                <i class="ri-calendar-line align-middle me-1"></i>1 month ago
              </li>
              <li class="list-inline-item">
                <div class="custom-toggle hstack gap-1 cursor-pointer" role="button" aria-pressed="false">
                  <span class="icon-off lh-base cursor-pointer">
                    <i class="ri-thumb-up-line align-middle me-1"></i>12K
                  </span>
                  <span class="icon-on lh-base cursor-pointer">
                    <i class="ri-thumb-up-fill align-middle me-1"></i>12K
                  </span>
                  Likes
                </div>
              </li>
            </ul>

            <!-- Video Description -->
            <p class="text-muted text-truncate-2 fs-14 mb-0">
              Build full-stack web applications using HTML, CSS, JavaScript, and Node.js. Learn through real-world projects.
            </p>

            <!-- Channel Info -->
            <div class="d-flex gap-2 justify-content-between align-items-center mt-3">
              <div class="d-flex gap-2 align-items-center">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Channel Logo" class="avatar-sm avatar-item border-0">
                </div>
                <div class="flex-grow-1">
                  <span class="fw-medium">Traversy Media</span><br>
                </div>
              </div>
              <div>
                <button type="button" class="btn btn-sm btn-outline-primary custom-toggle" aria-pressed="false">
                  <span class="icon-on">Unsubscribe</span>
                  <span class="icon-off">Subscribe</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="card overflow-hidden list-element">
          <!-- Thumbnail Section -->
          <div id="video_player-5" class="plyr__video-embed h-100">
            <iframe class="h-100" src="https://www.youtube.com/embed/bTqVqk7FSmY?enablejsapi=1&origin=http://example.com" allowfullscreen allow="autoplay"></iframe>
          </div>

          <!-- Video Info Section -->
          <div class="card-body">
            <div class="hstack gap-3 mb-3">
              <!-- Video Title -->
              <h5 class="flex-grow-1 mb-0">
                <a href="https://www.youtube.com/watch?v=bTqVqk7FSmY" target="_blank" class="text-reset text-truncate-2 text-decoration-none">
                  Introduction to Web Development - Full Course
                </a>
              </h5>
              <!-- Dropdown for Share, Download, and Other Options -->
              <div class="dropdown flex-shrink-0">
                <button class="btn btn-sm btn-light-primary" type="button" id="videoOptions5" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ri-more-2-fill"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="videoOptions5">
                  <li><a class="dropdown-item" href="#!"><i class="ri-share-line align-middle me-2"></i> Share</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-download-line align-middle me-2"></i> Download</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-save-line align-middle me-2"></i> Save to Playlist</a></li>
                </ul>
              </div>
            </div>

            <!-- Video Stats -->
            <ul class="list-inline d-flex flex-wrap align-items-center g-3 text-muted fs-14 mb-3">
              <li class="list-inline-item">
                <i class="ri-eye-line align-middle me-1"></i>3.1M views
              </li>
              <li class="list-inline-item">
                <i class="ri-calendar-line align-middle me-1"></i>3 days ago
              </li>
              <li class="list-inline-item">
                <div class="custom-toggle hstack gap-1 cursor-pointer" role="button" aria-pressed="false">
                  <span class="icon-off lh-base cursor-pointer">
                    <i class="ri-thumb-up-line align-middle me-1"></i>12K
                  </span>
                  <span class="icon-on lh-base cursor-pointer">
                    <i class="ri-thumb-up-fill align-middle me-1"></i>12K
                  </span>
                  Likes
                </div>
              </li>
            </ul>

            <!-- Video Description -->
            <p class="text-muted text-truncate-2 fs-14 mb-0">
              Learn web development with this comprehensive course! Understand HTML, CSS, JavaScript, and much more. Perfect for beginners and experienced developers alike.
            </p>

            <!-- Channel Info -->
            <div class="d-flex gap-2 justify-content-between align-items-center mt-3">
              <div class="d-flex gap-2 align-items-center">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Channel Logo" class="avatar-sm avatar-item border-0">
                </div>
                <div class="flex-grow-1">
                  <span class="fw-medium">FreeCodeCamp</span><br>
                </div>
              </div>
              <div>
                <button type="button" class="btn btn-sm btn-outline-primary custom-toggle" aria-pressed="false">
                  <span class="icon-on">Unsubscribe</span>
                  <span class="icon-off">Subscribe</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="card overflow-hidden list-element">
          <!-- Thumbnail Section -->
          <div id="video_player-6" class="plyr__video-embed h-100">
            <iframe class="h-100" src="https://www.youtube.com/embed/T8lrQGh7pyI?enablejsapi=1&origin=http://example.com" allowfullscreen allow="autoplay"></iframe>
          </div>

          <!-- Video Info Section -->
          <div class="card-body">
            <div class="hstack gap-3 mb-3">
              <!-- Video Title -->
              <h5 class="flex-grow-1 mb-0">
                <a href="https://www.youtube.com/watch?v=_5ZjGiZyybI" target="_blank" class="text-reset text-truncate-2 text-decoration-none">
                  Advanced CSS Techniques for Modern Web Design
                </a>
              </h5>
              <!-- Dropdown for Share, Download, and Other Options -->
              <div class="dropdown flex-shrink-0">
                <button class="btn btn-sm btn-light-primary" type="button" id="videoOptions6" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ri-more-2-fill"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="videoOptions6">
                  <li><a class="dropdown-item" href="#!"><i class="ri-share-line align-middle me-2"></i> Share</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-download-line align-middle me-2"></i> Download</a></li>
                  <li><a class="dropdown-item" href="#!"><i class="ri-save-line align-middle me-2"></i> Save to Playlist</a></li>
                </ul>
              </div>
            </div>

            <!-- Video Stats -->
            <ul class="list-inline d-flex flex-wrap align-items-center g-3 text-muted fs-14 mb-3">
              <li class="list-inline-item">
                <i class="ri-eye-line align-middle me-1"></i>850K views
              </li>
              <li class="list-inline-item">
                <i class="ri-calendar-line align-middle me-1"></i>5 days ago
              </li>
              <li class="list-inline-item">
                <div class="custom-toggle hstack gap-1 cursor-pointer" role="button" aria-pressed="false">
                  <span class="icon-off lh-base cursor-pointer">
                    <i class="ri-thumb-up-line align-middle me-1"></i>3.4K
                  </span>
                  <span class="icon-on lh-base cursor-pointer">
                    <i class="ri-thumb-up-fill align-middle me-1"></i>3.4K
                  </span>
                  Likes
                </div>
              </li>
            </ul>

            <!-- Video Description -->
            <p class="text-muted text-truncate-2 fs-14 mb-0">
              Master advanced CSS concepts such as Flexbox, Grid, and animations to build modern, responsive layouts and interactive designs for the web.
            </p>

            <!-- Channel Info -->
            <div class="d-flex gap-2 justify-content-between align-items-center mt-3">
              <div class="d-flex gap-2 align-items-center">
                <div class="flex-shrink-0">
                  <img src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="Channel Logo" class="avatar-sm avatar-item border-0">
                </div>
                <div class="flex-grow-1">
                  <span class="fw-medium">DevEd</span><br>
                </div>
              </div>
              <div>
                <button type="button" class="btn btn-sm btn-outline-primary custom-toggle" aria-pressed="false">
                  <span class="icon-on">Unsubscribe</span>
                  <span class="icon-off">Subscribe</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

    <div class="tab-pane" id="search-shopping" role="tabpanel">
      <div class="row">
        <!-- Sidebar (Optional Filters) -->
        <div class="col-12 col-lg-3 col-xxl-2 product-sidebar">
          <div class="card mb-0">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Filters</h5>
              </div>
            </div>
            <div class="card-body px-0 py-3">
              @include('partials.product-filter')
            

            </div>
          </div>
        </div>

        <!-- Search Results Area -->
        <div class="col-12 col-lg-9 col-xxl-10">

          <div class="hstack gap-3 flex-wrap justify-content-between mb-3">
            <h5 class="fw-normal text-muted m-0 fs-14">There are <span class="fw-semibold text-body fs-13">55,142</span> results in total.</h5>
            <span class="text-muted">Showing 1-10 of 55,142 results</span>
          </div>

          <!-- Search Results List -->
          <div class="row">

            <!-- Product 1 -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
              <div class="card card-h-100 product-card overflow-hidden">
                <div class="position-relative">
                  <div class="product-img position-relative z-1 overflow-hidden">
                    <img class="card-img-top rounded-top object-fit-cover" src="{{ asset('assets/images/product/product-1.jpg') }}" alt="Headphones">
                  </div>
                  <div class="card-img-overlay p-0">
                    <div class="position-absolute start-0 top-0 vstack gap-1 align-items-start p-4">
                      <span class="badge bg-info">
                        <i class="ri-flashlight-line me-1"></i>New Arrival
                      </span>
                      <div class="badge bg-primary d-inline-block">20% Off</div>
                    </div>
                  </div>
                </div>
                <div class="card-body h-100 d-flex flex-column justify-content-between">
                  <h6 class="mb-3 fw-semibold fs-16">
                    <a href="#!" class="text-body text-truncate-2">AirMax Pro Sneakers</a>
                  </h6>
                  <div>
                    <div class="d-flex gap-2 align-items-end justify-content-between flex-wrap">
                      <div class="flex-grow-1">
                        <div class="d-flex gap-1 align-items-baseline fs-12">
                          <div class="min-w-fit-content">
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                          </div>
                          <p class="min-w-fit-content card-text">
                            <span>(823)</span>
                            <span>Ratings</span>
                          </p>
                        </div>
                        <a href="#!" class="card-text fs-13 fw-medium"><i class="ri-user-3-line me-1"></i>Nike</a>
                      </div>
                      <div class="min-w-fit-content d-flex flex-column align-items-end">
                        <h5 class="fw-semibold mb-0">$159.99</h5> <span class="fs-13 text-muted text-decoration-line-through">$199.99</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Product 2 -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
              <div class="card card-h-100 product-card overflow-hidden">
                <div class="position-relative">
                  <div class="product-img position-relative z-1 overflow-hidden">
                    <img class="card-img-top rounded-top object-fit-cover" src="{{ asset('assets/images/product/product-2.jpg') }}" alt="Headphones">
                  </div>
                  <div class="card-img-overlay p-0">
                    <div class="position-absolute start-0 top-0 vstack gap-1 align-items-start p-4">
                      <span class="badge bg-info">
                        <i class="ri-flashlight-line me-1"></i>New Arrival
                      </span>
                      <div class="badge bg-primary d-inline-block">20% Off</div>
                    </div>
                  </div>
                </div>
                <div class="card-body h-100 d-flex flex-column justify-content-between">
                  <h6 class="mb-3 fw-semibold fs-16">
                    <a href="#!" class="text-body text-truncate-2">Gabrielle Chanel Perfume</a>
                  </h6>
                  <div>
                    <div class="d-flex gap-2 align-items-end justify-content-between flex-wrap">
                      <div class="flex-grow-1">
                        <div class="d-flex gap-1 align-items-baseline fs-12">
                          <div class="min-w-fit-content">
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-half fs-12"></i></span>
                          </div>
                          <p class="min-w-fit-content card-text">
                            <span>(1124)</span>
                            <span>Ratings</span>
                          </p>
                        </div>
                        <a href="#!" class="card-text fs-13 fw-medium"><i class="ri-user-3-line me-1"></i>Chanel</a>
                      </div>
                      <div class="min-w-fit-content d-flex flex-column align-items-end">
                        <h5 class="fw-semibold mb-0">$89.99</h5> <span class="fs-13 text-muted text-decoration-line-through">$99.99</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Product 3 -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
              <div class="card card-h-100 product-card overflow-hidden">
                <div class="position-relative">
                  <div class="product-img position-relative z-1 overflow-hidden">
                    <img class="card-img-top rounded-top object-fit-cover" src="{{ asset('assets/images/product/product-3.jpg') }}" alt="Headphones">
                  </div>
                  <div class="card-img-overlay p-0">
                    <div class="position-absolute start-0 top-0 vstack gap-1 align-items-start p-4">
                      <span class="badge bg-info">
                        <i class="ri-flashlight-line me-1"></i>New Arrival
                      </span>
                      <div class="badge bg-primary d-inline-block">20% Off</div>
                    </div>
                  </div>
                </div>
                <div class="card-body h-100 d-flex flex-column justify-content-between">
                  <h6 class="mb-3 fw-semibold fs-16">
                    <a href="#!" class="text-body text-truncate-2">SoundMaster Wireless Headphones</a>
                  </h6>
                  <div>
                    <div class="d-flex gap-2 align-items-end justify-content-between flex-wrap">
                      <div class="flex-grow-1">
                        <div class="d-flex gap-1 align-items-baseline fs-12">
                          <div class="min-w-fit-content">
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-half fs-12"></i></span>
                          </div>
                          <p class="min-w-fit-content card-text">
                            <span>(674)</span>
                            <span>Ratings</span>
                          </p>
                        </div>
                        <a href="#!" class="card-text fs-13 fw-medium"><i class="ri-user-3-line me-1"></i>Bose</a>
                      </div>
                      <div class="min-w-fit-content d-flex flex-column align-items-end">
                        <h5 class="fw-semibold mb-0">$219.99</h5> <span class="fs-13 text-muted text-decoration-line-through">$259.99</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Product 4 -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
              <div class="card card-h-100 product-card overflow-hidden">
                <div class="position-relative">
                  <div class="product-img position-relative z-1 overflow-hidden">
                    <img class="card-img-top rounded-top object-fit-cover" src="{{ asset('assets/images/product/product-4.jpg') }}" alt="Headphones">
                  </div>
                  <div class="card-img-overlay p-0">
                    <div class="position-absolute start-0 top-0 vstack gap-1 align-items-start p-4">
                      <span class="badge bg-warning">
                        <i class="ri-flashlight-line me-1"></i>Exclusive
                      </span>
                      <div class="badge bg-danger d-inline-block">15% Off</div>
                    </div>
                  </div>
                </div>
                <div class="card-body h-100 d-flex flex-column justify-content-between">
                  <h6 class="mb-3 fw-semibold fs-16">
                    <a href="#!" class="text-body text-truncate-2">Cocooil Body Oil</a>
                  </h6>
                  <div>
                    <div class="d-flex gap-2 align-items-end justify-content-between flex-wrap">
                      <div class="flex-grow-1">
                        <div class="d-flex gap-1 align-items-baseline fs-12">
                          <div class="min-w-fit-content">
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-half fs-12"></i></span>
                          </div>
                          <p class="min-w-fit-content card-text">
                            <span>(320)</span>
                            <span>Ratings</span>
                          </p>
                        </div>
                        <a href="#!" class="card-text fs-13 fw-medium"><i class="ri-user-3-line me-1"></i>NaturaCo</a>
                      </div>
                      <div class="min-w-fit-content d-flex flex-column align-items-end">
                        <h5 class="fw-semibold mb-0">$10245</h5> <span class="fs-13 text-muted text-decoration-line-through">$12000</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Product 5 -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
              <div class="card card-h-100 product-card overflow-hidden">
                <div class="position-relative">
                  <div class="product-img position-relative z-1 overflow-hidden">
                    <img class="card-img-top rounded-top object-fit-cover" src="{{ asset('assets/images/product/product-5.jpg') }}" alt="Headphones">
                  </div>
                  <div class="card-img-overlay p-0">
                    <div class="position-absolute start-0 top-0 vstack gap-1 align-items-start p-4">
                      <span class="badge bg-info">
                        <i class="ri-flashlight-line me-1"></i>Best Seller
                      </span>
                      <div class="badge bg-primary d-inline-block">20% Off</div>
                    </div>
                  </div>
                </div>
                <div class="card-body h-100 d-flex flex-column justify-content-between">
                  <h6 class="mb-3 fw-semibold fs-16">
                    <a href="#!" class="text-body text-truncate-2">Wireless Earbuds</a>
                  </h6>
                  <div>
                    <div class="d-flex gap-2 align-items-end justify-content-between flex-wrap">
                      <div class="flex-grow-1">
                        <div class="d-flex gap-1 align-items-baseline fs-12">
                          <div class="min-w-fit-content">
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                          </div>
                          <p class="min-w-fit-content card-text">
                            <span>(420)</span>
                            <span>Ratings</span>
                          </p>
                        </div>
                        <a href="#!" class="card-text fs-13 fw-medium"><i class="ri-user-3-line me-1"></i>ElectroGear</a>
                      </div>
                      <div class="min-w-fit-content d-flex flex-column align-items-end">
                        <h5 class="fw-semibold mb-0">$89.99</h5> <span class="fs-13 text-muted text-decoration-line-through">$112.00</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Product 6 -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
              <div class="card card-h-100 product-card overflow-hidden">
                <div class="position-relative">
                  <div class="product-img position-relative z-1 overflow-hidden">
                    <img class="card-img-top rounded-top object-fit-cover" src="{{ asset('assets/images/product/product-6.jpg') }}" alt="Headphones">
                  </div>
                  <div class="card-img-overlay p-0">
                    <div class="position-absolute start-0 top-0 vstack gap-1 align-items-start p-4">
                      <span class="badge bg-info">
                        <i class="ri-flashlight-line me-1"></i>Hot Deal
                      </span>
                      <div class="badge bg-primary d-inline-block">10% Off</div>
                    </div>
                  </div>
                </div>
                <div class="card-body h-100 d-flex flex-column justify-content-between">
                  <h6 class="mb-3 fw-semibold fs-16">
                    <a href="#!" class="text-body text-truncate-2">Luxury Sunglasses</a>
                  </h6>
                  <div>
                    <div class="d-flex gap-2 align-items-end justify-content-between flex-wrap">
                      <div class="flex-grow-1">
                        <div class="d-flex gap-1 align-items-baseline fs-12">
                          <div class="min-w-fit-content">
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                          </div>
                          <p class="min-w-fit-content card-text">
                            <span>(300)</span>
                            <span>Ratings</span>
                          </p>
                        </div>
                        <a href="#!" class="card-text fs-13 fw-medium"><i class="ri-user-3-line me-1"></i>LuxOptics</a>
                      </div>
                      <div class="min-w-fit-content d-flex flex-column align-items-end">
                        <h5 class="fw-semibold mb-0">$149.99</h5> <span class="fs-13 text-muted text-decoration-line-through">$166.99</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Product 7 -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
              <div class="card card-h-100 product-card overflow-hidden">
                <div class="position-relative">
                  <div class="product-img position-relative z-1 overflow-hidden">
                    <img class="card-img-top rounded-top object-fit-cover" src="{{ asset('assets/images/product/product-7.jpg') }}" alt="Headphones">
                  </div>
                  <div class="card-img-overlay p-0">
                    <div class="position-absolute start-0 top-0 vstack gap-1 align-items-start p-4">
                      <span class="badge bg-danger">
                        <i class="ri-flashlight-line me-1"></i>Exclusive
                      </span>
                      <div class="badge bg-warning d-inline-block">15% Off</div>
                    </div>
                  </div>
                </div>
                <div class="card-body h-100 d-flex flex-column justify-content-between">
                  <h6 class="mb-3 fw-semibold fs-16">
                    <a href="#!" class="text-body text-truncate-2">Brand new dark shirt</a>
                  </h6>
                  <div>
                    <div class="d-flex gap-2 align-items-end justify-content-between flex-wrap">
                      <div class="flex-grow-1">
                        <div class="d-flex gap-1 align-items-baseline fs-12">
                          <div class="min-w-fit-content">
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                          </div>
                          <p class="min-w-fit-content card-text">
                            <span>(823)</span>
                            <span>Ratings</span>
                          </p>
                        </div>
                        <a href="#!" class="card-text fs-13 fw-medium"><i class="ri-user-3-line me-1"></i>UrbanStyle</a>
                      </div>
                      <div class="min-w-fit-content d-flex flex-column align-items-end">
                        <h5 class="fw-semibold mb-0">$89.99</h5> <span class="fs-13 text-muted text-decoration-line-through">$104.99</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Product 8 -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-4 col-xxl-3">
              <div class="card card-h-100 product-card overflow-hidden">
                <div class="position-relative">
                  <div class="product-img position-relative z-1 overflow-hidden">
                    <img class="card-img-top rounded-top object-fit-cover" src="{{ asset('assets/images/product/product-8.jpg') }}" alt="Headphones">
                  </div>
                  <div class="card-img-overlay p-0">
                    <div class="position-absolute start-0 top-0 vstack gap-1 align-items-start p-4">
                      <span class="badge bg-info">
                        <i class="ri-flashlight-line me-1"></i>New Arrival
                      </span>
                      <div class="badge bg-primary d-inline-block">20% Off</div>
                    </div>
                  </div>
                </div>
                <div class="card-body h-100 d-flex flex-column justify-content-between">
                  <h6 class="mb-3 fw-semibold fs-16">
                    <a href="#!" class="text-body text-truncate-2">JBL Pulse 3 Bluetooth Speaker</a>
                  </h6>
                  <div>
                    <div class="d-flex gap-2 align-items-end justify-content-between flex-wrap">
                      <div class="flex-grow-1">
                        <div class="d-flex gap-1 align-items-baseline fs-12">
                          <div class="min-w-fit-content">
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-fill fs-12"></i></span>
                            <span class="text-warning"><i class="bi bi-star-line fs-12"></i></span>
                          </div>
                          <p class="min-w-fit-content card-text">
                            <span>(980)</span>
                            <span>Ratings</span>
                          </p>
                        </div>
                        <a href="#!" class="card-text fs-13 fw-medium"><i class="ri-user-3-line me-1"></i>JBL</a>
                      </div>
                      <div class="min-w-fit-content d-flex flex-column align-items-end">
                        <h5 class="fw-semibold mb-0">$179.99</h5> <span class="fs-13 text-muted text-decoration-line-through">$224.99</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Pagination -->
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <li class="page-item">
                <a class="page-link" href="#!" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item active"><a class="page-link" href="#!">1</a></li>
              <li class="page-item"><a class="page-link" href="#!">2</a></li>
              <li class="page-item"><a class="page-link" href="#!">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#!" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')

  <!-- Plyr js -->
  <script src="{{ asset('assets/libs/plyr/plyr.min.js') }}"></script>

  <!-- Tagify js -->
  <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

  <!-- Air Datepicker js -->
  <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

  <!-- Search page js -->
  <script src="{{ asset('assets/js/pages/pages-search-result.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection
