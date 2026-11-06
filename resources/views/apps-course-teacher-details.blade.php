@extends('partials.layouts.master3')

@section('title', 'Course Teacher Details | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by
    SRBThemes')
@section('sub-title', 'Teacher Details')
@section('pagetitle', 'Apps')
@section('buttonTitle', 'Add Product')
@section('link', '#!')


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
                            <button type="button" class="btn btn-light-primary icon-btn-sm rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#chat-audio-modal">
                                <i class="ri-phone-line"></i>
                            </button>
                            <button type="button" class="btn btn-light-primary icon-btn-sm rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#chat-video-modal">
                                <i class="ri-vidicon-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="hstack gap-2">
                    <button class="btn btn-outline-primary w-100">Book a class</button>
                    <button class="btn btn-light-primary min-w-100px">Share</button>
                </div>
            </div>
            <div class="card card-body">
                <h5 class="card-title">Skills</h5>
                <div class="d-flex flex-wrap gap-2">
                    <div class="badge fw-medium bg-light text-muted">Web Design</div>
                    <div class="badge fw-medium bg-light text-muted">UI/UX</div>
                    <div class="badge fw-medium bg-light text-muted">Figma</div>
                    <div class="badge fw-medium bg-light text-muted">Adobe XD</div>
                    <div class="badge fw-medium bg-light text-muted">HTML</div>
                    <div class="badge fw-medium bg-light text-muted">CSS</div>
                    <div class="badge fw-medium bg-light text-muted">JavaScript</div>
                    <div class="badge fw-medium bg-light text-muted">Responsive Design</div>
                    <div class="badge fw-medium bg-light text-muted">Wireframing</div>
                    <div class="badge fw-medium bg-light text-muted">Prototyping</div>
                </div>
            </div>
            <div class="card mb-0 card-body">
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
            <div class="card card-body">
                <h5 class="card-title">About me</h5>
                <p class="text-muted fs-13 mb-2">
                    Hello! I'm Theresa Flores, a passionate and dedicated Web Designer based in Australia. I hold a PhD in
                    Academic Studies and have over 4 years of professional experience in crafting user-friendly,
                    aesthetically pleasing websites. My goal is not only to create functional designs but to produce
                    innovative digital experiences that resonate with users and meet business goals.
                </p>
                <p class="text-muted fs-13 mb-2">
                    My design journey started after completing my studies in graphic design, where I developed a keen
                    interest in user-centric design. Over the years, I have honed my skills in front-end development, UI/UX
                    design, and product design. I have worked with clients from various industries, ranging from e-commerce
                    platforms to education startups, delivering high-quality websites and digital solutions that stand out.
                </p>
                <p class="text-muted fs-13 mb-2">
                    I believe in the power of design to communicate ideas, solve problems, and enhance user experiences.
                    That's why I focus on creating intuitive, responsive designs that are both functional and beautiful. I
                    embrace a collaborative approach with clients, as I believe that the best results come from
                    understanding their needs and aligning my design choices with their brand vision.
                </p>
                <p class="text-muted fs-13">
                    In addition to my design work, I have a passion for baking. It helps me recharge creatively, and the
                    attention to detail required in baking often translates into my work as a designer. Whether it’s mixing
                    the right ingredients for a cake or crafting the perfect layout for a website, I love creating something
                    that brings joy to others. When I'm not designing, you can usually find me exploring new baking recipes
                    or enjoying a cup of tea with friends.
                </p>
                <p class="text-muted fs-13 mb-0">
                    I’m always excited about new opportunities and love connecting with like-minded professionals or
                    businesses who are passionate about good design. Let’s work together to bring your ideas to life and
                    create digital experiences that leave a lasting impact!
                </p>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Educational Background</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-4 align-items-center border-solid border-bottom pb-3 mb-3">
                        <div class="flex-shrink-0 ">
                            <i class="ri-graduation-cap-line fs-3 text-primary"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-medium">Bachelor of Science in Computer Science</h6>
                                    <p class="text-muted lh-sm fs-13 mb-0">University of California, Berkeley</p>
                                    <span class="text-muted lh-sm fs-11">Sep 2018 - May 2022</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="#!" class="btn btn-sm btn-light-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-4 align-items-center border-solid border-bottom pb-3 mb-3">
                        <div class="flex-shrink-0 ">
                            <i class="ri-flag-line fs-3 text-info"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-medium">High School Diploma</h6>
                                    <p class="text-muted lh-sm fs-13 mb-0">Lincoln High School</p>
                                    <span class="text-muted lh-sm fs-11">Sep 2014 - Jun 2018</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="#!" class="btn btn-sm btn-light-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-4 align-items-center">
                        <div class="flex-shrink-0 ">
                            <i class="ri-computer-line fs-3 text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-medium">UI/UX Design Certification</h6>
                                    <p class="text-muted lh-sm fs-13 mb-0">Coursera (Offered by Google)</p>
                                    <span class="text-muted lh-sm fs-11">Jan 2021 - Mar 2021</span>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="#!" class="btn btn-sm btn-light-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header">
                    <h5 class="mb-0">Course List</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap align-middle table-hover mb-0">
                        <!-- Course 1 -->
                        <tr>
                            <td>
                                <h6 class="mb-1">Bachelor of Science in Computer Science</h6>
                                <small class="text-muted d-block">CS-101-001</small>
                            </td>
                            <td>12 lessons/3 months</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="h-8px w-8px rounded bg-success"></span>
                                    <p class="mb-0">Ongoing</p>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 fw-semibold">$1,250.00</p>
                            </td>
                        </tr>

                        <!-- Course 2 -->
                        <tr>
                            <td>
                                <h6 class="mb-1">UI/UX Design Fundamentals</h6>
                                <small class="text-muted d-block">UX-202-010</small>
                            </td>
                            <td>8 lessons/2 months</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="h-8px w-8px rounded bg-warning"></span>
                                    <p class="mb-0">Upcoming</p>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 fw-semibold">$500.00</p>
                            </td>
                        </tr>

                        <!-- Course 3 -->
                        <tr>
                            <td>
                                <h6 class="mb-1">Web Development Bootcamp</h6>
                                <small class="text-muted d-block">WD-110-034</small>
                            </td>
                            <td>20 lessons/5 months</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="h-8px w-8px rounded bg-success"></span>
                                    <p class="mb-0">Ongoing</p>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 fw-semibold">$1,799.00</p>
                            </td>
                        </tr>

                        <!-- Course 4 -->
                        <tr>
                            <td>
                                <h6 class="mb-1">Data Science and AI Specialization</h6>
                                <small class="text-muted d-block">DSAI-315-067</small>
                            </td>
                            <td>16 lessons/4 months</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="h-8px w-8px rounded bg-danger"></span>
                                    <p class="mb-0">Completed</p>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 fw-semibold">$2,300.00</p>
                            </td>
                        </tr>

                        <!-- Course 5 -->
                        <tr>
                            <td>
                                <h6 class="mb-1">Introduction to Machine Learning</h6>
                                <small class="text-muted d-block">ML-401-092</small>
                            </td>
                            <td>10 lessons/2 months</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="h-8px w-8px rounded bg-success"></span>
                                    <p class="mb-0">Ongoing</p>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 fw-semibold">$999.99</p>
                            </td>
                        </tr>

                        <!-- Course 6 -->
                        <tr>
                            <td>
                                <h6 class="mb-1">Full Stack Web Development</h6>
                                <small class="text-muted d-block">FSWD-502-019</small>
                            </td>
                            <td>25 lessons/6 months</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="h-8px w-8px rounded bg-info"></span>
                                    <p class="mb-0">Upcoming</p>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 fw-semibold">$1,850.00</p>
                            </td>
                        </tr>
                    </table>
                </div>
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

    <!-- Teacher Details js -->
    <script src="{{ asset('assets/js/apps/course/apps-course-teacher-add.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
