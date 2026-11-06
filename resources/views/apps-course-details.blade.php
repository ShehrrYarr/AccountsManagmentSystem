@extends('partials.layouts.master2')


    @section('title', 'Course Details| Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
        SRBThemes')
    @section('sub-title', 'Course Overview')
    @section('pagetitle', 'Online Course')
    @section('buttonTitle', 'View Course')
    @section('link', '#!')

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/libs/star-rating.js/star-rating.min.css') }}">
    @endsection
    @section('content')


        <div class="row g-4">
            <div class="col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-header hstack gap-3">
                        <h5 class="card-title mb-0 flex-grow-1">
                            Course Details
                        </h5>
                        <div class="dropdown flex-shrink-0">
                            <button type="button" class="btn btn-sm btn-text-secondary rounded-circle icon-btn-sm"
                                id="feedpost" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill fw-semibold"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="feedpost">
                                <a class="dropdown-item" href="#!" data-bs-toggle="modal"
                                    data-bs-target="#shareModal">Share Course</a>
                                <a class="dropdown-item" href="#!">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete-item delete-btn" href="#!">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative  mb-4">
                            <div class="ratio ratio-21x9">
                                <iframe src="https://www.youtube.com/embed/Hu4Yvq-g7_Y" class="rounded overflow-hidden"
                                    title="YouTube video player"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="hstack gap-3 mb-3 justify-content-between">
                            <h4 class="flex-grow-1 text-truncate-2 mb-0">React Development: A Step-by-Step Guide from
                                Beginner to Advanced</h4>
                            <button type="button"
                                class="btn btn-sm btn-light-primary fw-medium custom-toggle flex-shrink-0"
                                aria-pressed="false">
                                <span class="icon-off lh-base">
                                    <i class="ri-bookmark-line"></i>
                                </span>
                                <span class="icon-on lh-base">
                                    <i class="ri-bookmark-fill"></i>
                                </span>
                            </button>
                        </div>
                        <ul class="list-unstyled hstack gap-2 flex-wrap mb-0">
                            <li><a href="#!" class="text-reset"><i class="bi bi-box-seam align-baseline me-1"></i>
                                    React Development</a></li>
                            <li class="text-warning">
                                <i class="bi bi-star-fill align-baseline"></i>
                                <i class="bi bi-star-fill align-baseline"></i>
                                <i class="bi bi-star-fill align-baseline"></i>
                                <i class="bi bi-star-fill align-baseline"></i>
                                <i class="bi bi-star-half align-baseline"></i>
                                <span class="text-body ms-1">4.5</span>
                            </li>
                            <li>
                                <span class="badge bg-success-subtle text-success">Beginner</span>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav nav-tabs-bordered" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#description" role="tab"
                                aria-selected="true">
                                Description
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#videoTutorials" role="tab"
                                aria-selected="false" tabindex="-1">
                                Video Tutorials
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#reviews" role="tab" aria-selected="false"
                                tabindex="-1">
                                Reviews
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="description" role="tabpanel">
                        <div class="card card-body mb-0">
                            <h6 class="card-title mb-3">Overview</h6>
                            <p class="text-muted mb-2">React is a powerful JavaScript library used for building dynamic user
                                interfaces, particularly single-page applications (SPAs). Developed by Facebook, React makes
                                it easier to create interactive UIs by breaking down the interface into reusable components.
                                Whether you're building simple websites or complex web applications, React provides the
                                tools to handle data flow, state management, and component-based structure efficiently. This
                                course will take you through the core concepts and advanced features of React, empowering
                                you to create scalable and maintainable web applications.</p>
                            <p class="text-muted">In this course, we'll cover everything from the fundamentals of React to
                                more advanced topics like hooks, state management, and performance optimization. By the end
                                of the course, you'll be equipped to build sophisticated applications with React that are
                                efficient and easy to maintain.</p>
                            <h6 class="card-title mb-3">What We'll Cover in this Course</h6>
                            <ul class="list-group list-group-sm mb-4">
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Introduction to React – What it is
                                    and how it works</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Setting up your React development
                                    environment</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Building your first React
                                    component</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Understanding JSX and rendering UI
                                </li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Handling events in React</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Managing state with useState hook
                                </li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Component lifecycle and useEffect
                                    hook</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> React Router for building
                                    single-page applications</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Advanced state management with
                                    Context API and Redux</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Optimizing performance with
                                    React.memo and lazy loading</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Testing React components with
                                    Jest and React Testing Library</li>
                                <li class="list-group-item bg-transparent text-muted border-0 px-0"><i
                                        class="ri-checkbox-circle-line text-success"></i> Building and deploying
                                    production-ready React applications</li>
                            </ul>
                            <h6 class="card-title mb-3">How to Practice React Development</h6>
                            <p class="text-muted mb-2">To master React, practice is key. Whether you’re a beginner or an
                                advanced developer, hands-on coding will accelerate your learning and help you solidify the
                                concepts. Building projects, debugging code, and experimenting with different approaches
                                will help you become proficient.</p>
                            <p class="text-muted">React's component-based structure allows you to build projects
                                incrementally, making it easier to manage and scale applications as you gain more
                                experience. Start small, then gradually tackle more complex challenges. Practice is the
                                foundation of becoming a skilled React developer.</p>
                            <h6 class="card-title mb-3">Work through Courses and Tutorials</h6>
                            <p class="text-muted mb-2">Learning through structured courses and tutorials will give you a
                                clear roadmap to follow. There are many high-quality React tutorials and courses available
                                on the web. If you prefer a structured approach, consider enrolling in courses on platforms
                                like Udemy, LinkedIn Learning, or freeCodeCamp.</p>
                            <p class="text-muted mb-0">For video-based learning, YouTube is a treasure trove of free
                                resources. Some of the top React YouTube channels offer step-by-step tutorials that cover
                                both basic and advanced topics. A great place to start is the <a
                                    href="https://reactjs.org/tutorial/tutorial" target="_blank">official React
                                    tutorial</a>.</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="videoTutorials" role="tabpanel">
                        <div class="accordion accordion-primary" id="accordionReactCourse">
                            <!-- React Introduction + Setup -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="accordionReactExample1">
                                    <button class="accordion-button gap-3" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accor_ReactExamplecollapse1" aria-expanded="true"
                                        aria-controls="accor_ReactExamplecollapse1">
                                        Introduction to React + Setup <small class="ms-1 align-baseline text-nowrap">(5
                                            Lessons)</small>
                                    </button>
                                </h2>
                                <div id="accor_ReactExamplecollapse1" class="accordion-collapse collapse show"
                                    aria-labelledby="accordionReactExample1" data-bs-parent="#accordionReactCourse">
                                    <div class="accordion-body p-0">
                                        <ul class="list-group rounded-0">
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-info-subtle text-info">
                                                        <i class="ri ri-code-box-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">What is React and Why Use
                                                            It?</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        08:15 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-info-subtle text-info">
                                                        <i class="ri ri-code-box-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Setting up your React
                                                            Development Environment</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        12:00 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-info-subtle text-info">
                                                        <i class="ri ri-arrow-right-circle-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">React Fundamentals: JSX and
                                                            Components</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        10:30 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-info-subtle text-info">
                                                        <i class="ri ri-play-circle-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Setting up React App with
                                                            Create React App</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        14:00 min
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- React Components Basics -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="accordionReactExample2">
                                    <button class="accordion-button gap-3 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#accor_ReactExamplecollapse2"
                                        aria-expanded="false" aria-controls="accor_ReactExamplecollapse2">
                                        React Components Basics <small class="ms-1 align-baseline text-nowrap">(4
                                            Lessons)</small>
                                    </button>
                                </h2>
                                <div id="accor_ReactExamplecollapse2" class="accordion-collapse collapse"
                                    aria-labelledby="accordionReactExample2" data-bs-parent="#accordionReactCourse">
                                    <div class="accordion-body p-0">
                                        <ul class="list-group rounded-0">
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-success-subtle text-success">
                                                        <i class="ri ri-code-s-slash-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Understanding Functional and
                                                            Class Components</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        12:00 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-success-subtle text-success">
                                                        <i class="ri ri-play-circle-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Creating Your First React
                                                            Component</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        15:45 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-success-subtle text-success">
                                                        <i class="ri ri-restart-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">React Component Lifecycle</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        18:20 min
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- React State Management -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="accordionReactExample3">
                                    <button class="accordion-button gap-3 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#accor_ReactExamplecollapse3"
                                        aria-expanded="false" aria-controls="accor_ReactExamplecollapse3">
                                        React State Management <small class="ms-1 align-baseline text-nowrap">(6
                                            Lessons)</small>
                                    </button>
                                </h2>
                                <div id="accor_ReactExamplecollapse3" class="accordion-collapse collapse"
                                    aria-labelledby="accordionReactExample3" data-bs-parent="#accordionReactCourse">
                                    <div class="accordion-body p-0">
                                        <ul class="list-group rounded-0">
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-warning-subtle text-warning">
                                                        <i class="ri ri-database-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Understanding React State</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        14:20 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-warning-subtle text-warning">
                                                        <i class="ri ri-arrow-right-circle-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Using the useState Hook for
                                                            Dynamic Content</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        11:40 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-warning-subtle text-warning">
                                                        <i class="ri ri-arrow-left-right-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Handling Multiple States with
                                                            useState</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        13:25 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-warning-subtle text-warning">
                                                        <i class="ri ri-bubble-chart-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Optimizing State Updates in
                                                            React</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        12:30 min
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Advanced React: Context and Redux -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="accordionReactExample4">
                                    <button class="accordion-button gap-3 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#accor_ReactExamplecollapse4"
                                        aria-expanded="false" aria-controls="accor_ReactExamplecollapse4">
                                        Advanced React: Context API & Redux <small
                                            class="ms-1 align-baseline text-nowrap">(8 Lessons)</small>
                                    </button>
                                </h2>
                                <div id="accor_ReactExamplecollapse4" class="accordion-collapse collapse"
                                    aria-labelledby="accordionReactExample4" data-bs-parent="#accordionReactCourse">
                                    <div class="accordion-body p-0">
                                        <ul class="list-group rounded-0">
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-danger-subtle text-danger">
                                                        <i class="ri ri-settings-2-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Understanding React Context
                                                            API</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        16:10 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-danger-subtle text-danger">
                                                        <i class="ri ri-refresh-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Mastering Redux for State
                                                            Management</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        20:05 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-danger-subtle text-danger">
                                                        <i class="ri ri-refresh-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Using Redux with React</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        18:00 min
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- React Router -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="accordionReactExample5">
                                    <button class="accordion-button gap-3 collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#accor_ReactExamplecollapse5"
                                        aria-expanded="false" aria-controls="accor_ReactExamplecollapse5">
                                        React Router for SPAs <small class="ms-1 align-baseline text-nowrap">(3
                                            Lessons)</small>
                                    </button>
                                </h2>
                                <div id="accor_ReactExamplecollapse5" class="accordion-collapse collapse"
                                    aria-labelledby="accordionReactExample5" data-bs-parent="#accordionReactCourse">
                                    <div class="accordion-body p-0">
                                        <ul class="list-group rounded-0">
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-primary-subtle text-primary">
                                                        <i class="ri ri-route-line"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Getting Started with React
                                                            Router</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        12:45 min
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item border-0">
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="flex-shrink-0 avatar-sm avatar-item rounded bg-primary-subtle text-primary">
                                                        <i class="ri ri-link-m"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="#!" class="text-reset">Routing with Dynamic
                                                            Parameters</a>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        10:30 min
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="reviews" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0 flex-grow-1">Reviews</h5>
                            </div>
                            <div class="card-body">
                                <div class="border border-dashed rounded p-4">
                                    <div class="row g-3 g-md-0">
                                        <div
                                            class="col-md-5 border-end-md d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3">
                                            <div id="review-chart"></div>
                                            <div>
                                                <div
                                                    class="text-muted fs-20 mb-2 d-flex align-items-center justify-content-center justify-content-sm-start gap-1">
                                                    <i class="ri-star-fill text-warning"></i>
                                                    <i class="ri-star-fill text-warning"></i>
                                                    <i class="ri-star-fill text-warning"></i>
                                                    <i class="ri-star-fill text-warning"></i>
                                                    <i class="ri-star-line text-muted"></i>
                                                </div>
                                                <h5 class="mb-1 fw-semibold text-center text-sm-start">95% of buyers are
                                                    satisfied</h5>
                                                <div
                                                    class="d-flex align-items-center gap-2 justify-content-center justify-content-sm-start">
                                                    <p class="mb-0 text-muted fs-13">96 Rating</p>
                                                    <span
                                                        class="bg-secondary-subtle h-6px w-6px rounded-circle inline-block"></span>
                                                    <p class="mb-0 text-muted fs-13">125 Reviews</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="col-md-7 text-nowrap d-flex flex-column justify-content-between px-sm-6">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">5<i
                                                        class="ri-star-fill text-warning"></i></span>
                                                <div class="progress progress-sm flex-grow-1" role="progressbar"
                                                    aria-valuenow="61" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar w-75"></div>
                                                </div>
                                                <span class="w-30px text-end fw-semibold flex-shrink-0">128</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">4<i
                                                        class="ri-star-fill text-warning"></i></span>
                                                <div class="progress progress-sm flex-grow-1" role="progressbar"
                                                    aria-valuenow="24" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar w-25"></div>
                                                </div>
                                                <span class="w-30px text-end fw-semibold flex-shrink-0">40</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">3<i
                                                        class="ri-star-fill text-warning"></i></span>
                                                <div class="progress progress-sm flex-grow-1" role="progressbar"
                                                    aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar w-20"></div>
                                                </div>
                                                <span class="w-30px text-end fw-semibold flex-shrink-0">12</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">2<i
                                                        class="ri-star-fill text-warning"></i></span>
                                                <div class="progress progress-sm flex-grow-1" role="progressbar"
                                                    aria-valuenow="7" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 7%"></div>
                                                </div>
                                                <span class="w-30px text-end fw-semibold flex-shrink-0">7</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="d-flex gap-1 align-items-center text-muted flex-shrink-0">1<i
                                                        class="ri-star-fill text-warning"></i></span>
                                                <div class="progress progress-sm flex-grow-1" role="progressbar"
                                                    aria-valuenow="2" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 2%"></div>
                                                </div>
                                                <span class="w-30px text-end fw-semibold flex-shrink-0">2</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush max-h-384px" data-simplebar>
                                <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image"
                                            class="avatar rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="hstack justify-content-between gap-2">
                                            <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">John Smith <small
                                                    class="text-muted">28 Nov 2024 - 10:15AM</small></h5>
                                            <div class="d-flex align-items-center gap-1">
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                                    aria-pressed="false">
                                                    <span class="icon-on">
                                                        <i class="ri-thumb-up-fill"></i>
                                                    </span>
                                                    <span class="icon-off">
                                                        <i class="ri-thumb-up-line"></i>
                                                    </span>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                                    aria-pressed="false">
                                                    <span class="icon-on">
                                                        <i class="ri-thumb-down-fill"></i>
                                                    </span>
                                                    <span class="icon-off">
                                                        <i class="ri-thumb-down-line"></i>
                                                    </span>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light-primary icon-btn-sm"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-2-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#!"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#shareModal">Share</a></li>
                                                        <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                        <li><a class="dropdown-item delete-item delete-btn"
                                                                href="#!">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-2">Hi! I noticed the website is a bit slow on mobile
                                            devices. Could you look into optimizing it?</p>
                                        <a href="#!" class="badge bg-light text-muted">Reply <i
                                                class="ri-reply-line ms-1"></i></a>
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="user Image" class="avatar rounded-circle">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13">Sarah Lee <small class="text-muted ms-2">28 Nov 2024 -
                                                        11:00AM</small></h5>
                                                <p class="text-muted mb-2">Sure! I’ll check the mobile version and improve
                                                    the loading times. It should be faster soon.</p>
                                                <a href="#!" class="badge bg-light text-muted">Reply <i
                                                        class="ri-reply-line ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image"
                                            class="avatar rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="hstack justify-content-between gap-2">
                                            <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">John Smith <small
                                                    class="text-muted">28 Nov 2024 - 01:30PM</small></h5>
                                            <div class="d-flex align-items-center gap-1">
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                                    aria-pressed="false">
                                                    <span class="icon-on">
                                                        <i class="ri-thumb-up-fill"></i>
                                                    </span>
                                                    <span class="icon-off">
                                                        <i class="ri-thumb-up-line"></i>
                                                    </span>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                                    aria-pressed="false">
                                                    <span class="icon-on">
                                                        <i class="ri-thumb-down-fill"></i>
                                                    </span>
                                                    <span class="icon-off">
                                                        <i class="ri-thumb-down-line"></i>
                                                    </span>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light-primary icon-btn-sm"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-2-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#!"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#shareModal">Share</a></li>
                                                        <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                        <li><a class="dropdown-item delete-item delete-btn"
                                                                href="#!">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-2">I also noticed the form validation on the contact page
                                            is not working properly. It allows the form to be submitted with empty fields.
                                            Can we fix that too?</p>
                                        <a href="#!" class="badge bg-light text-muted">Reply <i
                                                class="ri-reply-line ms-1"></i></a>
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="user Image" class="avatar rounded-circle">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13">Sarah Lee <small class="text-muted ms-2">28 Nov 2024 -
                                                        02:00PM</small></h5>
                                                <p class="text-muted mb-2">Yes, I see that. I'll adjust the validation
                                                    script so that users can't submit the form without filling out all
                                                    fields. I’ll have that ready shortly.</p>
                                                <a href="#!" class="badge bg-light text-muted">Reply <i
                                                        class="ri-reply-line ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image"
                                            class="avatar rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="hstack justify-content-between gap-2">
                                            <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">John Smith <small
                                                    class="text-muted">28 Nov 2024 - 04:00PM</small></h5>
                                            <div class="d-flex align-items-center gap-1">
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                                    aria-pressed="false">
                                                    <span class="icon-on">
                                                        <i class="ri-thumb-up-fill"></i>
                                                    </span>
                                                    <span class="icon-off">
                                                        <i class="ri-thumb-up-line"></i>
                                                    </span>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                                    aria-pressed="false">
                                                    <span class="icon-on">
                                                        <i class="ri-thumb-down-fill"></i>
                                                    </span>
                                                    <span class="icon-off">
                                                        <i class="ri-thumb-down-line"></i>
                                                    </span>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light-primary icon-btn-sm"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-2-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#!"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#shareModal">Share</a></li>
                                                        <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                        <li><a class="dropdown-item delete-item delete-btn"
                                                                href="#!">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-2">Great! One more thing: Can we update the header section
                                            of the homepage? The logo looks too small on high-resolution screens. It would
                                            look better if it was a bit larger.</p>
                                        <a href="#!" class="badge bg-light text-muted">Reply <i
                                                class="ri-reply-line ms-1"></i></a>
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="user Image" class="avatar rounded-circle">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13">Sarah Lee <small class="text-muted ms-2">28 Nov 2024 -
                                                        04:30PM</small></h5>
                                                <p class="text-muted mb-2">Definitely! I will increase the size of the logo
                                                    and adjust the layout to make sure it looks good on all screen sizes.
                                                    I'll make this update later today.</p>
                                                <a href="#!" class="badge bg-light text-muted">Reply <i
                                                        class="ri-reply-line ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item bg-transparent border-0 border-bottom d-flex delete-element">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="user Image"
                                            class="avatar rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="hstack justify-content-between gap-2">
                                            <h5 class="fs-13 d-flex flex-column flex-sm-row gap-2 mb-0">John Smith <small
                                                    class="text-muted">29 Nov 2024 - 09:00AM</small></h5>
                                            <div class="d-flex align-items-center gap-1">
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                                    aria-pressed="false">
                                                    <span class="icon-on">
                                                        <i class="ri-thumb-up-fill"></i>
                                                    </span>
                                                    <span class="icon-off">
                                                        <i class="ri-thumb-up-line"></i>
                                                    </span>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary icon-btn-sm custom-toggle"
                                                    aria-pressed="false">
                                                    <span class="icon-on">
                                                        <i class="ri-thumb-down-fill"></i>
                                                    </span>
                                                    <span class="icon-off">
                                                        <i class="ri-thumb-down-line"></i>
                                                    </span>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light-primary icon-btn-sm"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-2-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#!"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#shareModal">Share</a></li>
                                                        <li><a class="dropdown-item" href="#!">Edit</a></li>
                                                        <li><a class="dropdown-item delete-item delete-btn"
                                                                href="#!">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-2">I saw the changes, and everything looks great! Thanks
                                            for the updates!</p>
                                        <a href="#!" class="badge bg-light text-muted">Reply <i
                                                class="ri-reply-line ms-1"></i></a>
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="user Image" class="avatar rounded-circle">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13">Sarah Lee <small class="text-muted ms-2">29 Nov 2024 -
                                                        09:30AM</small></h5>
                                                <p class="text-muted mb-2">You're welcome! I'm glad it all works for you.
                                                    Let me know if there's anything else I can assist with.</p>
                                                <a href="#!" class="badge bg-light text-muted">Reply <i
                                                        class="ri-reply-line ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card mb-0">
                            <div class="card-body">
                                <label for="blog-comment" class="form-label">Write Comment</label>
                                <textarea class="form-control" id="blog-comment" rows="4" placeholder="Write Here......."></textarea>
                                <div class="text-end mt-4">
                                    <button class="btn btn-primary">Post Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-lg-4 col-xl-3">
                <div class="card overflow-hidden ribbon-box">
                    <div class="position-relative">
                        <div class="position-absolute end-0 top-0 vstack gap-1 align-items-end p-4">
                            <span class="badge bg-warning">
                                <i class="ri-flashlight-line me-1"></i>Exclusive
                            </span>
                            <div class="badge bg-danger d-inline-block">15% Off</div>
                        </div>
                        <img src="{{ asset('assets/images/small/img-3.jpg') }}" alt="course image"
                            class="img-fluid w-100">
                    </div>
                    <div class="card-body">
                        <h4 class="text-truncate text-capitalize">$245.95 <small
                                class="text-decoration-line-through fs-xs text-muted align-baseline">499.99</small></h4>
                        <p class="text-danger"><i class="bi bi-clock me-2"></i> <b>10</b> days left at this price</p>
                        <div class="hstack gap-2">
                            <button class="btn btn-secondary w-100">Free Trial</button>
                            <button class="btn btn-primary w-100"><i class="bi bi-bag align-baseline me-1"></i> Buy
                                Now</button>
                        </div>
                    </div>
                </div><!--end card-->
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">This course includes</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 mb-0">
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 hstack">
                                        <i class="ri ri-book-line align-middle me-1 text-primary-emphasis"></i>
                                        <span>Lessons</span>
                                    </div>
                                    <div class="flex-shrink-0 text-muted">45</div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 hstack">
                                        <i class="ri ri-video-line align-middle me-1 text-primary-emphasis"></i>
                                        <span>Video Tutorials</span>
                                    </div>
                                    <div class="flex-shrink-0 text-muted">20 hours</div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 hstack">
                                        <i class="ri ri-code-box-line align-middle me-1 text-primary-emphasis"></i>
                                        <span>Hands-on Projects</span>
                                    </div>
                                    <div class="flex-shrink-0 text-muted">10 Projects</div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 hstack">
                                        <i class="ri ri-chat-1-line align-middle me-1 text-primary-emphasis"></i>
                                        <span>Community Support</span>
                                    </div>
                                    <div class="flex-shrink-0 text-muted">24/7</div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 hstack">
                                        <i class="ri ri-award-line align-middle me-1 text-primary-emphasis"></i>
                                        <span>Certification</span>
                                    </div>
                                    <div class="flex-shrink-0 text-muted">Yes</div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 hstack">
                                        <i class="ri ri-lifebuoy-line align-middle me-1 text-primary-emphasis"></i>
                                        <span>Lifetime Access</span>
                                    </div>
                                    <div class="flex-shrink-0 text-muted">Yes</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Instructor Details</h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="avatar-xl overflow-hidden mx-auto mb-3">
                            <img src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" class="img-fluid"
                                alt="user Image">
                        </div>
                        <div>
                            <h5 class="mb-0"><strong>Jessica</strong> Doe</h5>
                            <span class="text-muted fs-13">Washington, d.c.</span>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-sm btn-primary me-2">Profile</button>
                            <button class="btn btn-sm btn-outline-secondary">Message</button>
                        </div>
                    </div>
                </div>
                <div class="card overflow-hidden mb-0">
                    <div class="card-header gap-2 d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Project Documents</h6>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                View All <i class="ri-arrow-down-s-line ms-1"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="#!">Download</a></li>
                                <li><a class="dropdown-item" href="#!">Import</a></li>
                                <li><a class="dropdown-item" href="#!">Export</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center gap-2 py-3 delete-element">
                                <span class="avatar-lg border-0 avatar-item bg-light flex-shrink-0">
                                    <i class="ri-file-pdf-line ri-2x text-danger"></i>
                                </span>
                                <div class="flex-fill flex-grow-1 overflow-hidden">
                                    <a href="#!">
                                        <span class="d-block fw-semibold text-truncate">Project Proposal.pdf</span>
                                    </a>
                                    <span class="d-block text-muted fs-12">1.2MB</span>
                                </div>
                                <div class="hstack gap-1 flex-shrink-0">
                                    <button class="btn icon-btn-sm btn-light-primary"><i
                                            class="ri-pencil-line"></i></button>
                                    <button class="btn icon-btn-sm btn-light-danger delete-btn"><i
                                            class="ri-delete-bin-line"></i></button>
                                </div>
                            </li>

                            <li class="list-group-item d-flex align-items-center gap-2 py-3 delete-element">
                                <span class="avatar-lg border-0 avatar-item bg-light flex-shrink-0">
                                    <i class="ri-file-word-line ri-2x text-primary"></i>
                                </span>
                                <div class="flex-fill flex-grow-1 overflow-hidden">
                                    <a href="#!">
                                        <span class="d-block fw-semibold text-truncate">Contracts.docx</span>
                                    </a>
                                    <span class="d-block text-muted fs-12">1.5MB</span>
                                </div>
                                <div class="hstack gap-1 flex-shrink-0">
                                    <button class="btn icon-btn-sm btn-light-primary"><i
                                            class="ri-pencil-line"></i></button>
                                    <button class="btn icon-btn-sm btn-light-danger delete-btn"><i
                                            class="ri-delete-bin-line"></i></button>
                                </div>
                            </li>

                            <li class="list-group-item d-flex align-items-center gap-2 py-3 delete-element">
                                <span class="avatar-lg border-0 avatar-item bg-light flex-shrink-0">
                                    <i class="ri-file-text-line ri-2x text-secondary"></i>
                                </span>
                                <div class="flex-fill flex-grow-1 overflow-hidden">
                                    <a href="#!">
                                        <span class="d-block fw-semibold text-truncate">Meeting Notes.txt</span>
                                    </a>
                                    <span class="d-block text-muted fs-12">256KB</span>
                                </div>
                                <div class="hstack gap-1 flex-shrink-0">
                                    <button class="btn icon-btn-sm btn-light-primary"><i
                                            class="ri-pencil-line"></i></button>
                                    <button class="btn icon-btn-sm btn-light-danger delete-btn"><i
                                            class="ri-delete-bin-line"></i></button>
                                </div>
                            </li>

                            <li class="list-group-item d-flex align-items-center gap-2 py-3 delete-element">
                                <span class="avatar-lg border-0 avatar-item bg-light flex-shrink-0">
                                    <i class="ri-file-pdf-line ri-2x text-danger"></i>
                                </span>
                                <div class="flex-fill flex-grow-1 overflow-hidden">
                                    <a href="#!">
                                        <span class="d-block fw-semibold text-truncate">User Manual.pdf</span>
                                    </a>
                                    <span class="d-block text-muted fs-12">1.8MB</span>
                                </div>
                                <div class="hstack gap-1 flex-shrink-0">
                                    <button class="btn icon-btn-sm btn-light-primary"><i
                                            class="ri-pencil-line"></i></button>
                                    <button class="btn icon-btn-sm btn-light-danger delete-btn"><i
                                            class="ri-delete-bin-line"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!--end col-->
        </div>
    @endsection

    @section('js')
        <!-- Countup init -->
        <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

        <!-- Star Rating js -->
        <script src="{{ asset('assets/libs/star-rating.js/star-rating.min.js') }}"></script>

        <!-- ApexChat js -->
        <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>

        <!-- Calendar init -->
        <script src="{{ asset('assets/js/apps/course/apps-course-details.init.js') }}"></script>

        <!-- App js -->
        <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @endsection
