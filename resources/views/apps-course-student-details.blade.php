@extends('partials.layouts.master3')

@section('title', 'My Course | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Student Details')
@section('pagetitle', 'Online Course')
@section('buttonTitle', 'Back to List')
@section('link', 'apps-course-student-list')

@section('css')
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row g-4">
        <div class="col-md-5 col-lg-4 col-xl-3">
            <div class="card card-body">
                <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                    class="img-fluid object-fit-cover rounded-2 max-h-256px w-100 mb-3" alt="profile image">
                <div class="hstack mb-3">
                    <div class="flex-grow-1 overflow-hidden">
                        <h4 class="mb-0 fw-semibold text-truncate">Roy Southerell</h4>
                        <span class="text-muted fs-12 text-truncate-2">Computer Teacher</span>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-light text-muted icon-btn-sm rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#chat-audio-modal">
                                <i class="ri-phone-line"></i>
                            </button>
                            <button type="button" class="btn btn-light text-muted icon-btn-sm rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#chat-video-modal">
                                <i class="ri-vidicon-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="hstack gap-2">
                    <button class="btn btn-outline-primary w-100">Book a class</button>
                    <button class="btn btn-light min-w-100px">Share</button>
                </div>
            </div>
            <div class="card card-body">
                <h5 class="card-title">Contact Info</h5>

                <div class="mb-3">
                    <p class="text-muted fs-13 mb-0">Location</p>
                    <div class="hstack gap-1">
                        <i class="ri ri-map-pin-2-line fw-medium flex-shrink-0"></i>
                        <p class="flex-grow-1 mb-0 text-truncate-2">Melbourne, Australia</p>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="text-muted fs-13 mb-0">Email Address</p>
                    <div class="hstack gap-1">
                        <i class="ri ri-mail-line fw-medium flex-shrink-0"></i>
                        <p class="flex-grow-1 mb-0 text-truncate-2">sup.srbthemes@gmail.com</p>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="text-muted fs-13 mb-0">Phone Number</p>
                    <div class="hstack gap-1">
                        <i class="ri ri-phone-line fw-medium flex-shrink-0"></i>
                        <p class="flex-grow-1 mb-0 text-truncate-2">+61 400 000 000</p>
                    </div>
                </div>

                <div class="mb-3">
                    <p class="text-muted fs-13 mb-0">Portfolio Website</p>
                    <div class="hstack gap-1">
                        <i class="ri ri-link-line fw-medium flex-shrink-0"></i>
                        <p class="flex-grow-1 mb-0 text-truncate-2">
                            <a href="https://www.google.com" target="_blank">google.com</a>
                        </p>
                    </div>
                </div>

                <div>
                    <p class="text-muted fs-13 mb-2">Follow Me</p>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button type="button" class="btn btn-outline-twitter rounded-circle icon-btn-sm">
                            <i class="ri-twitter-fill"></i>
                        </button>
                        <button type="button" class="btn btn-outline-github rounded-circle icon-btn-sm">
                            <i class="ri-github-fill"></i>
                        </button>
                        <button type="button" class="btn btn-outline-linkedin rounded-circle icon-btn-sm">
                            <i class="ri-linkedin-box-fill"></i>
                        </button>
                        <button type="button" class="btn btn-outline-dribbble rounded-circle icon-btn-sm">
                            <i class="ri-dribbble-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="row">
                <div class="col-xxl-7">
                    <div class="card card-body">
                        <h5 class="card-title">About me</h5>
                        <p class="text-muted fs-13 mb-2">
                            Hello! I'm Theresa Flores, a passionate and dedicated Web Designer based in Australia. I hold a
                            PhD in Academic Studies and have over 4 years of professional experience in crafting
                            user-friendly, aesthetically pleasing websites. My goal is not only to create functional designs
                            but to produce innovative digital experiences that resonate with users and meet business goals.
                        </p>
                        <p class="text-muted fs-13 mb-2">
                            My design journey started after completing my studies in graphic design, where I developed a
                            keen interest in user-centric design. Over the years, I have honed my skills in front-end
                            development, UI/UX design, and product design. I have worked with clients from various
                            industries, ranging from e-commerce platforms to education startups, delivering high-quality
                            websites and digital solutions that stand out.
                        </p>
                        <p class="text-muted fs-13 mb-2">
                            I believe in the power of design to communicate ideas, solve problems, and enhance user
                            experiences. That's why I focus on creating intuitive, responsive designs that are both
                            functional and beautiful. I embrace a collaborative approach with clients, as I believe that the
                            best results come from understanding their needs and aligning my design choices with their brand
                            vision.
                        </p>
                        <p class="text-muted fs-13 mb-2">
                            In addition to my design work, I have a passion for baking. It helps me recharge creatively, and
                            the attention to detail required in baking often translates into my work as a designer. Whether
                            it’s mixing the right ingredients for a cake or crafting the perfect layout for a website, I
                            love creating something that brings joy to others. When I'm not designing, you can usually find
                            me exploring new baking recipes or enjoying a cup of tea with friends.
                        </p>
                        <p class="text-muted fs-13 mb-2">
                            I’m always excited about new opportunities and love connecting with like-minded professionals or
                            businesses who are passionate about good design. Let’s work together to bring your ideas to life
                            and create digital experiences that leave a lasting impact!
                        </p>
                        <p class="text-muted fs-13 mb-0">
                            In addition to my design work, I have a passion for baking. It helps me recharge creatively, and
                            the attention to detail required in baking often translates into my work as a designer. Whether
                            it’s mixing the right ingredients for a cake or crafting the perfect layout for a website, I
                            love creating something that brings joy to others. When I'm not designing, you can usually find
                            me exploring new baking recipes or enjoying a cup of tea with friends.
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-header hstack justify-content-between">
                            <div class="vstack gap-1">
                                <p class="card-subtitle fs-12 mb-0">Time Spent on Learning</p>
                                <h5 class="card-title fs-18 mb-0">
                                    10<span class="text-muted fs-12 fw-medium">h</span>
                                    20<span class="text-muted fs-12 fw-medium">m</span>
                                </h5>
                            </div>
                            <select id="time-frame-select" class="form-select flex-shrink-0">
                                <option value="1week" selected>Weekly</option>
                                <option value="1month">Monthly</option>
                                <option value="1year">Yearly</option>
                            </select>
                        </div>
                        <div class="card-body pb-0">
                            <div id="learningAnalyticsDashboard" class="apexcharts-white"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5">
                    <div class="card overflow-hidden">
                        <div class="card-header d-flex align-items-center justify-content-between gap-2">
                            <h6 class="card-title mb-0 flex-grow-1">Recent Activity</h6>
                            <button class="btn btn-light-secondary btn-sm flex-shrink-0">Edit</button>
                        </div>
                        <div class="p-4 h-300px" data-simplebar>
                            <ul class="timeline-box mb-0">
                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 text-bg-primary avatar-item avatar">AC</div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">Admin Console</h5>
                                            <p class="mb-0 text-muted fs-12">09:30 AM</p>
                                        </div>
                                        <div
                                            class="mt-1 d-inline-flex flex-wrap align-items-center column-gap-2 text-muted">
                                            <span>created a new course</span>
                                            <span class="fw-semibold text-body">"Advanced Machine Learning"</span>
                                            <span>with a batch of</span>
                                            <span class="fw-semibold text-body">30 students.</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                            class="border-0 avatar-item avatar" alt="user Image">
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">John Doe</h5>
                                            <p class="mb-0 text-muted fs-12">08:15 AM</p>
                                        </div>
                                        <div
                                            class="mt-1 d-inline-flex flex-wrap align-items-center column-gap-2 text-muted">
                                            <span>updated the schedule for the course</span>
                                            <span class="fw-semibold text-body">"Web Development Basics".</span>
                                        </div>
                                        <div class="p-4 fs-13 rounded-4 bg-light bg-opacity-30 mt-3">The next session has
                                            been moved to <strong>Monday, 10:00 AM</strong>. Please update the calendar
                                            accordingly.</div>
                                    </div>
                                </li>

                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 text-bg-light avatar-item avatar"><i
                                                class="ri-user-add-line"></i></div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">Sarah Johnson</h5>
                                            <p class="mb-0 text-muted fs-12">07:45 AM</p>
                                        </div>
                                        <div
                                            class="mt-1 d-inline-flex flex-wrap align-items-center column-gap-2 text-muted">
                                            <span>added new instructors to</span>
                                            <span class="fw-semibold text-body">"Data Analytics Program".</span>
                                        </div>
                                        <div class="badge bg-light d-inline-flex align-items-center gap-1 mt-2">
                                            <span class="bullet d-flex align-items-center bg-success flex-shrink-0"></span>
                                            <span class="fw-semibold text-body">Dr. Emily Carter</span>
                                        </div>
                                        <div class="badge bg-light d-inline-flex align-items-center gap-1">
                                            <span class="bullet d-flex align-items-center bg-primary flex-shrink-0"></span>
                                            <span class="fw-semibold text-body">Mr. Robert James</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 text-bg-light avatar-item avatar"><i
                                                class="ri-notification-3-line"></i></div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">System Notification</h5>
                                            <p class="mb-0 text-muted fs-12">06:30 AM</p>
                                        </div>
                                        <div
                                            class="mt-1 d-inline-flex flex-wrap align-items-center column-gap-2 text-muted">
                                            <span>An announcement was sent to all students for</span>
                                            <span class="fw-semibold text-body">"Semester End Examination Schedule".</span>
                                        </div>
                                    </div>
                                </li>

                                <li class="timeline-section">
                                    <div class="position-relative timeline-icon h-max">
                                        <img src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                            class="border-0 avatar-item avatar" alt="user Image">
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">David White</h5>
                                            <p class="mb-0 text-muted fs-12">05:10 AM</p>
                                        </div>
                                        <div
                                            class="mt-1 d-inline-flex flex-wrap align-items-center column-gap-2 text-muted">
                                            <span>reported an issue with</span>
                                            <span class="fw-semibold text-body">"Quiz Submission Module".</span>
                                        </div>
                                        <div class="p-4 fs-13 rounded-4 bg-light bg-opacity-30 mt-3">The submissions are
                                            not being saved properly. It seems to be a bug with the latest update. Please
                                            check and resolve.</div>
                                    </div>
                                </li>

                                <li class="timeline-section pb-0">
                                    <div class="position-relative timeline-icon h-max">
                                        <div class="border-0 text-bg-info avatar-item avatar">RG</div>
                                    </div>
                                    <div class="timeline-content p-0">
                                        <div class="d-flex flex-column gap-1">
                                            <h5 class="mb-0 fw-medium">Rachel Green</h5>
                                            <p class="mb-0 text-muted fs-12">03:00 AM</p>
                                        </div>
                                        <div
                                            class="mt-1 d-inline-flex flex-wrap align-items-center column-gap-2 text-muted">
                                            <span>removed inactive users from</span>
                                            <span class="fw-semibold text-body">"Marketing 101".</span>
                                            <span>Total removed:</span>
                                            <span class="fw-semibold text-body">12 users.</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Homework Progress</h6>
                        </div>
                        <div class="card-body p-0">
                            <ul class="d-flex flex-column list-group">
                                <!-- Graphic Design Progress -->
                                <li class="list-group-item d-flex align-items-center border-0 border-bottom">
                                    <div id="graphic-design-progress" class="chart-small-text"></div>
                                    <div class="ms-3 flex-grow-1">
                                        <h5 class="fw-semibold mb-1">Graphic Design</h5>
                                        <p class="fs-12 text-muted mb-0">8 Tasks Remaining</p>
                                    </div>
                                    <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                        <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                    </button>
                                </li>

                                <!-- Web Development Progress -->
                                <li class="list-group-item d-flex align-items-center border-0 border-bottom">
                                    <div id="web-development-progress" class="chart-small-text"></div>
                                    <div class="ms-3 flex-grow-1">
                                        <h5 class="fw-semibold mb-1">Web Development</h5>
                                        <p class="fs-12 text-muted mb-0">5 Tasks Remaining</p>
                                    </div>
                                    <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                        <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                    </button>
                                </li>

                                <!-- Mobile App Development Progress -->
                                <li class="list-group-item d-flex align-items-center border-0">
                                    <div id="mobile-app-progress" class="chart-small-text"></div>
                                    <div class="ms-3 flex-grow-1">
                                        <h5 class="fw-semibold mb-1">Mobile App Development</h5>
                                        <p class="fs-12 text-muted mb-0">15 Tasks Remaining</p>
                                    </div>
                                    <button type="button" class="btn btn-light-primary icon-btn-sm flex-shrink-0">
                                        <i class="ri-arrow-right-line fs-14 fw-semibold"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Upcoming Tasks:</h5>
                        </div>
                        <div class="h-256px" data-simplebar>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_a" checked>
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_a">Finalize project proposal
                                                and send to clients</label>
                                            <p class="text-muted fs-12 mb-0">1 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-success-subtle text-success flex-shrink-0">Completed</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_b">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_b">Schedule weekly check-in
                                                with development team</label>
                                            <p class="text-muted fs-12 mb-0">3 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-warning-subtle text-warning flex-shrink-0">In Progress</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_c">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_c">Review website analytics
                                                and update strategy</label>
                                            <p class="text-muted fs-12 mb-0">5 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-secondary-subtle text-secondary flex-shrink-0">Pending</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_d" checked>
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_d">Update product pricing on
                                                website</label>
                                            <p class="text-muted fs-12 mb-0">7 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-warning-subtle text-warning flex-shrink-0">In Progress</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_e">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_e">Prepare meeting agenda for
                                                next executive meeting</label>
                                            <p class="text-muted fs-12 mb-0">8 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-warning-subtle text-warning flex-shrink-0">In Progress</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_f">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_f">Design promotional
                                                material for new product launch</label>
                                            <p class="text-muted fs-12 mb-0">10 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-warning-subtle text-warning flex-shrink-0">In Progress</span>
                                    </div>
                                </li>

                                <!-- New Tasks -->
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_g">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_g">Conduct market research
                                                for upcoming product</label>
                                            <p class="text-muted fs-12 mb-0">12 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-secondary-subtle text-secondary flex-shrink-0">Pending</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_h">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_h">Prepare and send monthly
                                                newsletter</label>
                                            <p class="text-muted fs-12 mb-0">15 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-secondary-subtle text-secondary flex-shrink-0">Pending</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_i">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_i">Organize team-building
                                                event for the company</label>
                                            <p class="text-muted fs-12 mb-0">18 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-warning-subtle text-warning flex-shrink-0">In Progress</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_j">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_j">Update the team on the
                                                latest project developments</label>
                                            <p class="text-muted fs-12 mb-0">20 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-secondary-subtle text-secondary flex-shrink-0">Pending</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_k">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_k">Launch new marketing
                                                campaign for Q2</label>
                                            <p class="text-muted fs-12 mb-0">22 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-secondary-subtle text-secondary flex-shrink-0">Pending</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 border-bottom">
                                    <div class="hstack gap-3">
                                        <div class="form-check p-0 m-0 flex-shrink-0">
                                            <input type="checkbox" class="form-check-input ms-0" id="task_l">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label class="form-check-label mb-0" for="task_l">Finalize Q1 financial
                                                report</label>
                                            <p class="text-muted fs-12 mb-0">25 Feb, 2025</p>
                                        </div>
                                        <span class="badge bg-warning-subtle text-warning flex-shrink-0">In Progress</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-0">
        <div class="card-header hstack flex-wrap justify-content-between gap-3">
            <div class="card-title mb-0 me-1">
                <h5 class="mb-0 fw-semibold">My Courses</h5>
                <p class="mb-0">Total 6 course you have purchased</p>
            </div>
            <select class="form-select w-max" id="all-courses-select">
                <option value="All Courses">All Courses</option>
                <option value="ui/ux">UI/UX</option>
                <option value="seo">SEO</option>
                <option value="web">Web</option>
                <option value="music">Music</option>
                <option value="painting">Painting</option>
            </select>
        </div>
        <div class="card-body pb-0">
            <div class="swiper recent-swiper swiper-pagination-primary">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card">
                            <a href="#!" class="position-relative">
                                <img class="img-fluid rounded-top max-h-224px w-100"
                                    src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Figma Course Image">
                                <span
                                    class="position-absolute top-0 end-0 badge rounded-pill bg-black bg-opacity-50 m-3">10K
                                    Enrolled</span>
                            </a>
                            <div class="card-body">
                                <a href="#!">
                                    <h5 class="fw-semibold mb-2 text-truncate-2">Figma for Beginners: Fundamentals of Figma
                                        App</h5>
                                </a>

                                <p class="text-muted mb-3 text-truncate-2">
                                    Learn the latest design skills with Figma and create beautiful interfaces. Ideal for
                                    beginners who want to get hands-on experience with design tools.
                                </p>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <div class="badge fw-medium bg-light text-muted">UI/UX</div>
                                    <div class="badge fw-medium bg-light text-muted">Figma</div>
                                    <div class="badge fw-medium bg-light text-muted">HTML</div>
                                </div>

                                <div class="d-flex justify-content-between mb-1">
                                    <p class="fw-medium mb-0 small">30m</p>
                                    <p class="fw-medium mb-0 small">5<span class="text-muted">/20 lessons</span></p>
                                </div>

                                <div class="progress progress-xs mb-4">
                                    <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <div class="d-flex gap-3 justify-content-between">
                                    <button class="btn btn-light-primary w-100">
                                        <span class="me-2">Enroll now</span><i class="ri ri-arrow-right-line"></i>
                                    </button>
                                    <button class="btn btn-light w-100">
                                        <i class="ri ri-play-circle-line me-2"></i><span>Watch now</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card">
                            <a href="#!" class="position-relative">
                                <img class="img-fluid rounded-top max-h-224px w-100"
                                    src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Figma Course Image">
                                <span
                                    class="position-absolute top-0 end-0 badge rounded-pill bg-black bg-opacity-50 m-3">10K
                                    Enrolled</span>
                            </a>
                            <div class="card-body">
                                <a href="#!">
                                    <h5 class="fw-semibold mb-2 text-truncate-2">Figma for Beginners: Fundamentals of Figma
                                        App</h5>
                                </a>

                                <p class="text-muted mb-3 text-truncate-2">
                                    Learn the latest design skills with Figma and create beautiful interfaces. Ideal for
                                    beginners who want to get hands-on experience with design tools.
                                </p>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <div class="badge fw-medium bg-light text-muted">UI/UX</div>
                                    <div class="badge fw-medium bg-light text-muted">Figma</div>
                                    <div class="badge fw-medium bg-light text-muted">HTML</div>
                                </div>

                                <div class="d-flex justify-content-between mb-1">
                                    <p class="fw-medium mb-0 small">30m</p>
                                    <p class="fw-medium mb-0 small">5<span class="text-muted">/20 lessons</span></p>
                                </div>

                                <div class="progress progress-xs mb-4">
                                    <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <div class="d-flex gap-3 justify-content-between">
                                    <button class="btn btn-light-primary w-100">
                                        <span class="me-2">Enroll now</span><i class="ri ri-arrow-right-line"></i>
                                    </button>
                                    <button class="btn btn-light w-100">
                                        <i class="ri ri-play-circle-line me-2"></i><span>Watch now</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card">
                            <a href="#!" class="position-relative">
                                <img class="img-fluid rounded-top max-h-224px w-100"
                                    src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Figma Course Image">
                                <span
                                    class="position-absolute top-0 end-0 badge rounded-pill bg-black bg-opacity-50 m-3">10K
                                    Enrolled</span>
                            </a>
                            <div class="card-body">
                                <a href="#!">
                                    <h5 class="fw-semibold mb-2 text-truncate-2">Figma for Beginners: Fundamentals of Figma
                                        App</h5>
                                </a>

                                <p class="text-muted mb-3 text-truncate-2">
                                    Learn the latest design skills with Figma and create beautiful interfaces. Ideal for
                                    beginners who want to get hands-on experience with design tools.
                                </p>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <div class="badge fw-medium bg-light text-muted">UI/UX</div>
                                    <div class="badge fw-medium bg-light text-muted">Figma</div>
                                    <div class="badge fw-medium bg-light text-muted">HTML</div>
                                </div>

                                <div class="d-flex justify-content-between mb-1">
                                    <p class="fw-medium mb-0 small">30m</p>
                                    <p class="fw-medium mb-0 small">5<span class="text-muted">/20 lessons</span></p>
                                </div>

                                <div class="progress progress-xs mb-4">
                                    <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <div class="d-flex gap-3 justify-content-between">
                                    <button class="btn btn-light-primary w-100">
                                        <span class="me-2">Enroll now</span><i class="ri ri-arrow-right-line"></i>
                                    </button>
                                    <button class="btn btn-light w-100">
                                        <i class="ri ri-play-circle-line me-2"></i><span>Watch now</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card">
                            <a href="#!" class="position-relative">
                                <img class="img-fluid rounded-top max-h-224px w-100"
                                    src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Figma Course Image">
                                <span
                                    class="position-absolute top-0 end-0 badge rounded-pill bg-black bg-opacity-50 m-3">10K
                                    Enrolled</span>
                            </a>
                            <div class="card-body">
                                <a href="#!">
                                    <h5 class="fw-semibold mb-2 text-truncate-2">Figma for Beginners: Fundamentals of Figma
                                        App</h5>
                                </a>

                                <p class="text-muted mb-3 text-truncate-2">
                                    Learn the latest design skills with Figma and create beautiful interfaces. Ideal for
                                    beginners who want to get hands-on experience with design tools.
                                </p>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <div class="badge fw-medium bg-light text-muted">UI/UX</div>
                                    <div class="badge fw-medium bg-light text-muted">Figma</div>
                                    <div class="badge fw-medium bg-light text-muted">HTML</div>
                                </div>

                                <div class="d-flex justify-content-between mb-1">
                                    <p class="fw-medium mb-0 small">30m</p>
                                    <p class="fw-medium mb-0 small">5<span class="text-muted">/20 lessons</span></p>
                                </div>

                                <div class="progress progress-xs mb-4">
                                    <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <div class="d-flex gap-3 justify-content-between">
                                    <button class="btn btn-light-primary w-100">
                                        <span class="me-2">Enroll now</span><i class="ri ri-arrow-right-line"></i>
                                    </button>
                                    <button class="btn btn-light w-100">
                                        <i class="ri ri-play-circle-line me-2"></i><span>Watch now</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    <!-- start:: Chat Audio Modal -->
    <div class="modal fade chat-audio-modal" id="chat-audio-modal" data-bs-keyboard="false" tabindex="-1"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="chat-audio-modal" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content overflow-hidden border-0">
                <img class="img-fluid h-160px" src="{{ asset('assets/images/small/img-7.jpg') }}" alt="teacher Image">

                <div class="d-flex justify-content-center">
                    <div class="avatar-item border-2">
                        <img class="img-fluid avatar-xl" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                            alt="avatar image">
                    </div>
                </div>
                <div class="mt-5 d-flex flex-column justify-content-center text-center">
                    <span class="text-muted fs-12 mb-1">Calling ...</span>
                    <h5 class="m-0 fw-semibold">Alon Smith</h5>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-2 min-h-80px">
                    <button type="button" class="btn btn-light-secondary icon-btn rounded-pill">
                        <i class="ri-user-add-line"></i>
                    </button>
                    <button type="button" class="btn btn-light-secondary icon-btn rounded-pill">
                        <i class="ri-volume-mute-line"></i>
                    </button>
                    <button type="button" class="btn btn-light-danger icon-btn rounded-pill" data-bs-dismiss="modal">
                        <i class="ri-phone-line"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: Chat Audio Modal -->

    <!-- start:: Chat Video Modal -->
    <div class="modal fade" id="chat-video-modal" data-bs-keyboard="false" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="chat-video-modal" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content overflow-hidden border-0 p-5">
                <div class="z-1 min-h-384px d-flex flex-column justify-content-between gap-5">
                    <div>
                        <div class="d-flex justify-content-center">
                            <div class="avatar-item border-2 rounded-0">
                                <img class="img-fluid avatar-xl rounded-0"
                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                            </div>
                        </div>
                        <div class="mt-5 d-flex flex-column justify-content-center text-center">
                            <span class="fs-12 mb-1 text-white">Talking With ...</span>
                            <h5 class="m-0 fw-semibold text-white">Alon Smith</h5>
                            <span class="fs-12 mb-1 text-white">02:09 min</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button type="button" class="btn btn-light-secondary icon-btn rounded-pill">
                            <i class="ri-user-add-line"></i>
                        </button>
                        <button type="button" class="btn btn-light-secondary icon-btn rounded-pill">
                            <i class="ri-volume-mute-line"></i>
                        </button>
                        <button type="button" class="btn btn-light-danger icon-btn rounded-pill"
                            data-bs-dismiss="modal">
                            <i class="ri-phone-line"></i>
                        </button>
                    </div>
                </div>
                <img class="img-fluid position-absolute top-0 bottom-0 start-0 end-0 object-fit-cover w-100 h-100 z-0"
                    src="{{ asset('assets/images/small/img-7.jpg') }}" alt="teacher Image">

            </div>
        </div>
    </div>
    <!-- End:: Chat Video Modal -->
@endsection

@section('js')

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>

    <!-- Swiper init -->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Student details init -->
    <script src="{{ asset('assets/js/apps/course/apps-course-student-details.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
