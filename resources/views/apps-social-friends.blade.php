@extends('partials.layouts.master2')

@section('title', 'Social Friends | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Friends')
@section('pagetitle', 'Social')
@section('buttonTitle', 'Message')
@section('link', 'apps-chat')

@section('content')

    @include('partials.social-user-profile')

    <div class="row">

        <div class="col-12 col-lg-4 col-xl-3 col-xxl-2">
            @include('partials.social-sidebar')

        </div>
        <div class="col-12 col-lg-8 col-xl-9 col-xxl-10">
            <div class="row">
                <div class="col-12 col-xl-8">

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <div class="card overflow-hidden shadow-sm">
                                <img class="img-fluid w-100 object-fit-cover h-128px"
                                    src="{{ asset('assets/images/small/img-3.jpg') }}" alt="cover image">
                                <div class="p-4 d-flex flex-column flex-sm-row gap-3 align-items-start">
                                    <div
                                        class="avatar-xl avatar-item border-2 border-primary overflow-hidden flex-shrink-0">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <div class="d-flex flex-column gap-3 flex-grow-1">
                                        <div>
                                            <h5 class="mb-0 text-truncate fw-bold">Sam Lanson <i
                                                    class="ri-verified-badge-fill text-success align-middle ms-1"></i></h5>
                                            <p class="text-muted fs-12 mb-1">@sam_lanson</p>
                                            <p class="fs-12 mb-0 text-muted text-truncate-2">Hello! I'm Theresa Flores, a
                                                passionate and dedicated Web Designer based in Australia.</p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary ms-auto rounded-pill d-flex align-items-center px-4 custom-toggle active"
                                            aria-pressed="false">
                                            <span class="icon-on lh-lg"><i
                                                    class="ri-user-minus-line me-1 align-middle fs-14"></i>Unfollow</span>
                                            <span class="icon-off lh-lg"><i
                                                    class="ri-user-add-line me-1 align-middle fs-14"></i>Follow</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <div class="card overflow-hidden shadow-sm">
                                <img class="img-fluid w-100 object-fit-cover h-128px"
                                    src="{{ asset('assets/images/small/img-5.jpg') }}" alt="cover image">
                                <div class="p-4 d-flex flex-column flex-sm-row gap-3 align-items-start">
                                    <div
                                        class="avatar-xl avatar-item border-2 border-primary overflow-hidden flex-shrink-0">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <div class="d-flex flex-column gap-3 flex-grow-1">
                                        <div>
                                            <h5 class="mb-0 text-truncate fw-bold">Nina Patel</h5>
                                            <p class="text-muted fs-12 mb-1">@nina_patel</p>
                                            <p class="fs-12 mb-0 text-muted text-truncate-2">Graphic Designer and Digital
                                                Artist. Passionate about minimalism and clean aesthetics.</p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary ms-auto rounded-pill d-flex align-items-center px-4 custom-toggle active"
                                            aria-pressed="false">
                                            <span class="icon-on lh-lg"><i
                                                    class="ri-user-minus-line me-1 align-middle fs-14"></i>Unfollow</span>
                                            <span class="icon-off lh-lg"><i
                                                    class="ri-user-add-line me-1 align-middle fs-14"></i>Follow</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <div class="card overflow-hidden shadow-sm">
                                <img class="img-fluid w-100 object-fit-cover h-128px"
                                    src="{{ asset('assets/images/small/img-6.jpg') }}" alt="cover image">
                                <div class="p-4 d-flex flex-column flex-sm-row gap-3 align-items-start">
                                    <div
                                        class="avatar-xl avatar-item border-2 border-primary overflow-hidden flex-shrink-0">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <div class="d-flex flex-column gap-3 flex-grow-1">
                                        <div>
                                            <h5 class="mb-0 text-truncate fw-bold">Jack Thomas</h5>
                                            <p class="text-muted fs-12 mb-1">@jack_thomas</p>
                                            <p class="fs-12 mb-0 text-muted text-truncate-2">Developer, Tech Enthusiast, and
                                                AI Advocate. Sharing tech news, tutorials, and innovation updates.</p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary ms-auto rounded-pill d-flex align-items-center px-4 custom-toggle active"
                                            aria-pressed="false">
                                            <span class="icon-on lh-lg"><i
                                                    class="ri-user-minus-line me-1 align-middle fs-14"></i>Unfollow</span>
                                            <span class="icon-off lh-lg"><i
                                                    class="ri-user-add-line me-1 align-middle fs-14"></i>Follow</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <div class="card overflow-hidden shadow-sm">
                                <img class="img-fluid w-100 object-fit-cover h-128px"
                                    src="{{ asset('assets/images/small/img-7.jpg') }}" alt="cover image">
                                <div class="p-4 d-flex flex-column flex-sm-row gap-3 align-items-start">
                                    <div
                                        class="avatar-xl avatar-item border-2 border-primary overflow-hidden flex-shrink-0">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <div class="d-flex flex-column gap-3 flex-grow-1">
                                        <div>
                                            <h5 class="mb-0 text-truncate fw-bold">Mia Wong <i
                                                    class="ri-verified-badge-fill text-success align-middle ms-1"></i></h5>
                                            <p class="text-muted fs-12 mb-1">@mia_wong</p>
                                            <p class="fs-12 mb-0 text-muted text-truncate-2">Full-stack Developer and UI/UX
                                                Designer. Creating seamless experiences for web and mobile.</p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary ms-auto rounded-pill d-flex align-items-center px-4 custom-toggle active"
                                            aria-pressed="false">
                                            <span class="icon-on lh-lg"><i
                                                    class="ri-user-minus-line me-1 align-middle fs-14"></i>Unfollow</span>
                                            <span class="icon-off lh-lg"><i
                                                    class="ri-user-add-line me-1 align-middle fs-14"></i>Follow</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <div class="card overflow-hidden shadow-sm">
                                <img class="img-fluid w-100 object-fit-cover h-128px"
                                    src="{{ asset('assets/images/small/img-8.jpg') }}" alt="cover image">
                                <div class="p-4 d-flex flex-column flex-sm-row gap-3 align-items-start">
                                    <div
                                        class="avatar-xl avatar-item border-2 border-primary overflow-hidden flex-shrink-0">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <div class="d-flex flex-column gap-3 flex-grow-1">
                                        <div>
                                            <h5 class="mb-0 text-truncate fw-bold">Olivia Smith</h5>
                                            <p class="text-muted fs-12 mb-1">@olivia_smith</p>
                                            <p class="fs-12 mb-0 text-muted text-truncate-2">Marketing Expert and Content
                                                Creator. Helping businesses grow with data-driven strategies.</p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary ms-auto rounded-pill d-flex align-items-center px-4 custom-toggle active"
                                            aria-pressed="false">
                                            <span class="icon-on lh-lg"><i
                                                    class="ri-user-minus-line me-1 align-middle fs-14"></i>Unfollow</span>
                                            <span class="icon-off lh-lg"><i
                                                    class="ri-user-add-line me-1 align-middle fs-14"></i>Follow</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <div class="card overflow-hidden shadow-sm">
                                <img class="img-fluid w-100 object-fit-cover h-128px"
                                    src="{{ asset('assets/images/small/img-9.jpg') }}" alt="cover image">
                                <div class="p-4 d-flex flex-column flex-sm-row gap-3 align-items-start">
                                    <div
                                        class="avatar-xl avatar-item border-2 border-primary overflow-hidden flex-shrink-0">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-8.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <div class="d-flex flex-column gap-3 flex-grow-1">
                                        <div>
                                            <h5 class="mb-0 text-truncate fw-bold">Brian King <i
                                                    class="ri-verified-badge-fill text-success align-middle ms-1"></i></h5>
                                            <p class="text-muted fs-12 mb-1">@brian_king</p>
                                            <p class="fs-12 mb-0 text-muted text-truncate-2">AI Engineer and Data
                                                Scientist. Passionate about revolutionizing industries with machine
                                                learning.</p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary ms-auto rounded-pill d-flex align-items-center px-4 custom-toggle active"
                                            aria-pressed="false">
                                            <span class="icon-on lh-lg"><i
                                                    class="ri-user-minus-line me-1 align-middle fs-14"></i>Unfollow</span>
                                            <span class="icon-off lh-lg"><i
                                                    class="ri-user-add-line me-1 align-middle fs-14"></i>Follow</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Collapsible Content Area -->
                    <div class="collapse row" id="collapseEmailContent">

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <div class="card overflow-hidden shadow-sm">
                                <img class="img-fluid w-100 object-fit-cover h-128px"
                                    src="{{ asset('assets/images/small/img-11.jpg') }}" alt="cover image">
                                <div class="p-4 d-flex flex-column flex-sm-row gap-3 align-items-start">
                                    <div
                                        class="avatar-xl avatar-item border-2 border-primary overflow-hidden flex-shrink-0">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-10.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <div class="d-flex flex-column gap-3 flex-grow-1">
                                        <div>
                                            <h5 class="mb-0 text-truncate fw-bold">John Cooper <i
                                                    class="ri-verified-badge-fill text-success align-middle ms-1"></i></h5>
                                            <p class="text-muted fs-12 mb-1">@john_cooper</p>
                                            <p class="fs-12 mb-0 text-muted text-truncate-2">Fitness Coach and Nutrition
                                                Expert. Helping you live a healthier, stronger life with personalized plans.
                                            </p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary ms-auto rounded-pill d-flex align-items-center px-4 custom-toggle active"
                                            aria-pressed="false">
                                            <span class="icon-on lh-lg"><i
                                                    class="ri-user-minus-line me-1 align-middle fs-14"></i>Unfollow</span>
                                            <span class="icon-off lh-lg"><i
                                                    class="ri-user-add-line me-1 align-middle fs-14"></i>Follow</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                            <div class="card overflow-hidden shadow-sm">
                                <img class="img-fluid w-100 object-fit-cover h-128px"
                                    src="{{ asset('assets/images/small/img-12.jpg') }}" alt="cover image">
                                <div class="p-4 d-flex flex-column flex-sm-row gap-3 align-items-start">
                                    <div
                                        class="avatar-xl avatar-item border-2 border-primary overflow-hidden flex-shrink-0">
                                        <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-9.jpg') }}"
                                            alt="avatar image">
                                    </div>
                                    <div class="d-flex flex-column gap-3 flex-grow-1">
                                        <div>
                                            <h5 class="mb-0 text-truncate fw-bold">Ella Roberts <i
                                                    class="ri-verified-badge-fill text-success align-middle ms-1"></i></h5>
                                            <p class="text-muted fs-12 mb-1">@ella_roberts</p>
                                            <p class="fs-12 mb-0 text-muted text-truncate-2">Artist and Illustrator.
                                                Turning everyday moments into colorful art. Let’s create something
                                                beautiful!</p>
                                        </div>
                                        <button type="button"
                                            class="btn btn-sm btn-light-primary ms-auto rounded-pill d-flex align-items-center px-4 custom-toggle active"
                                            aria-pressed="false">
                                            <span class="icon-on lh-lg"><i
                                                    class="ri-user-minus-line me-1 align-middle fs-14"></i>Unfollow</span>
                                            <span class="icon-off lh-lg"><i
                                                    class="ri-user-add-line me-1 align-middle fs-14"></i>Follow</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="show-all d-flex justify-content-center">
                        <button type="button" class="btn btn-primary custom-toggle" data-bs-toggle="collapse"
                            data-bs-target="#collapseEmailContent" aria-expanded="false"
                            aria-controls="collapseEmailContent">
                            <span class="icon-on">
                                Show Less
                                <i class="ri-arrow-up-s-line ms-2"></i>
                            </span>
                            <span class="icon-off">
                                Show All
                                <i class="ri-arrow-down-s-line ms-2"></i>
                            </span>
                        </button>
                    </div>

                </div>

                <div class="col-12 col-xl-4">
                    <div class="card card-body">
                        <div class="hstack align-items-center justify-content-between">
                            <p class="text-uppercase fw-semibold text-muted mb-0">Requests</p>
                            <span class="badge border border-light rounded-circle bg-primary p-1 w-20px">4</span>
                        </div>
                    </div>
                    <div class="card card-body delete-element">
                        <div class="hstack gap-2">
                            <div class="avatar avatar-item overflow-hidden flex-shrink-0">
                                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                    alt="avatar image">
                            </div>
                            <div class="text-muted fw-medium">
                                <a href="#!" class="fw-semibold text-body">Tyrell Barrows</a>
                                wants to add you to friends
                            </div>
                        </div>
                        <div class="hstack justify-content-center mt-3 gap-2">
                            <button class="btn rounded-4 btn-primary">Accept</button>
                            <button class="btn rounded-4 btn-light-light delete-btn">Decline</button>
                        </div>
                    </div>
                    <div class="card card-body delete-element">
                        <div class="hstack gap-2">
                            <div class="avatar avatar-item overflow-hidden flex-shrink-0">
                                <img class="img-fluid" src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                    alt="avatar image">
                            </div>
                            <div class="text-muted fw-medium">
                                <a href="#!" class="fw-semibold text-body">Selena Gomez</a>
                                wants to add you to friends
                            </div>
                        </div>
                        <div class="hstack justify-content-center mt-3 gap-2">
                            <button class="btn rounded-4 btn-primary">Accept</button>
                            <button class="btn rounded-4 btn-light-light delete-btn">Decline</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-icon flex-grow-1">
                                <i class="ri-search-line cursor-pointer text-muted"></i>
                                <input type="text" name="new-search" id="new-search"
                                    class="form-control form-control-icon" placeholder="Search" aria-label="search">
                            </div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs-bordered gap-4 my-4" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link px-0 py-1 active" data-bs-toggle="tab" href="#primary_chat"
                                        role="tab" aria-selected="true">
                                        Primary
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link px-0 py-1" data-bs-toggle="tab" href="#general_chat"
                                        role="tab" aria-selected="false" tabindex="-1">
                                        General
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active show" id="primary_chat" role="tabpanel">
                                    <ul class="list-group fs-13 fw-medium list-group-flush">
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">John Doe</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Emily Johnson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Alice Smith</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-10.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Michael Jackson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Rachel Green</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Liam Peters</a>
                                        </li>

                                    </ul>
                                    <a href="#!" class="fs-6 fw-semibold text-muted">View All</a>

                                </div>
                                <div class="tab-pane" id="general_chat" role="tabpanel">
                                    <ul class="list-group fs-13 fw-medium list-group-flush">
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">John Doe</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-3.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Alice Smith</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Emily Johnson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-10.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Michael Jackson</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-5.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Liam Peters</a>
                                        </li>
                                        <li class="list-group-item d-flex gap-3 hstack rounded-0 px-0">
                                            <div class="position-relative">
                                                <img class="img-fluid avatar avatar-item"
                                                    src="{{ asset('assets/images/avatar/avatar-4.jpg') }}"
                                                    alt="avatar image">
                                                <span
                                                    class="position-absolute border-2 border border-white h-12px w-12px rounded-circle bg-success end-0 bottom-0"></span>
                                            </div>
                                            <a href="#!" class="fs-6 fw-bold text-body">Rachel Green</a>
                                        </li>

                                    </ul>
                                    <a href="#!" class="fs-6 fw-semibold text-muted">View All</a>
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
    <!-- social feeds init -->
    <script src="{{ asset('assets/js/apps/social/apps-social-feeds.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
