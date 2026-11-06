@extends('partials.layouts.master2')
@section('title', 'Social Event | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Event')
@section('pagetitle', 'social')
@section('buttonTitle', 'Message')
@section('link', 'apps-chat')

@section('content')
    @include('partials.social-user-profile')

    <div class="row">

        <div class="col-12 col-lg-4 col-xl-3 col-xxl-2">
            @include('partials.social-sidebar')
        </div>
        <div class="col-12 col-lg-8 col-xl-9 col-xxl-10">
            <div class="row g-4">
                <div class="col-auto col-md-6 col-xxl-4">
                    <div class="card mb-0 h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/small/img-2.jpg') }}" alt="Social Media Event"
                                    class="img-fluid rounded">
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                <p class="mb-0 fw-semibold text-primary text-uppercase">Fri 6:00 PM</p>
                                <div class="badge p-3 bg-body-secondary shadow-sm rounded-3 text-uppercase mt-n10 z-1 m-3">
                                    <span class="text-uppercase text-muted fs-6">sep</span>
                                    <h5 class="mb-0 fs-4 mt-1 lh-1">15</h5>
                                </div>
                            </div>
                            <a href="#!" class="d-block fw-medium text-body my-2">
                                <h5 class="mb-0 fs-4 text-truncate overflow-hidden">Social Media Marketing Workshop</h5>
                            </a>
                            <div class="d-flex flex-wrap align-items-center row-gap-0 column-gap-2">
                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <p class="mb-0 fw-medium text-muted">Location</p>
                                    <span
                                        class="d-block h-6px w-6px bg-primary bg-opacity-70 align-middle rounded-circle"></span>
                                </div>
                                <p class="mb-0 fw-semibold text-muted flex-grow-1">123 Social St, New York, NY</p>
                            </div>
                            <hr>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="avatar-group">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="avatar image">
                                    <div class="avatar-item border-2 avatar fw-medium fs-12 avatar-title bg-text-primary">
                                        10+</div>
                                </div>
                                <p class="mb-0 fw-medium text-muted">Attendees</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-md-6 col-xxl-4">
                    <div class="card mb-0 h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/small/img-3.jpg') }}" alt="Tech Conference"
                                    class="img-fluid rounded">
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                <p class="mb-0 fw-semibold text-primary text-uppercase">Wed 10:00 AM</p>
                                <div class="badge p-3 bg-body-secondary shadow-sm rounded-3 text-uppercase mt-n10 z-1 m-3">
                                    <span class="text-uppercase text-muted fs-6">oct</span>
                                    <h5 class="mb-0 fs-4 mt-1 lh-1">25</h5>
                                </div>
                            </div>
                            <a href="#!" class="d-block fw-medium text-body my-2">
                                <h5 class="mb-0 fs-4 text-truncate overflow-hidden">Tech Innovations Conference 2025</h5>
                            </a>
                            <div class="d-flex flex-wrap align-items-center row-gap-0 column-gap-2">
                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <p class="mb-0 fw-medium text-muted">Location</p>
                                    <span
                                        class="d-block h-6px w-6px bg-primary bg-opacity-70 align-middle rounded-circle"></span>
                                </div>
                                <p class="mb-0 fw-semibold text-muted flex-grow-1">Tech Arena, Silicon Valley, CA</p>
                            </div>
                            <hr>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="avatar-group">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="avatar image">
                                    <div class="avatar-item border-2 avatar fw-medium fs-12 avatar-title bg-text-primary">
                                        50+</div>
                                </div>
                                <p class="mb-0 fw-medium text-muted">Speakers</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-md-6 col-xxl-4">
                    <div class="card mb-0 h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/small/img-4.jpg') }}" alt="Tech Meetup"
                                    class="img-fluid rounded">
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                <p class="mb-0 fw-semibold text-primary text-uppercase">Tue 5:00 PM</p>
                                <div class="badge p-3 bg-body-secondary shadow-sm rounded-3 text-uppercase mt-n10 z-1 m-3">
                                    <span class="text-uppercase text-muted fs-6">oct</span>
                                    <h5 class="mb-0 fs-4 mt-1 lh-1">20</h5>
                                </div>
                            </div>
                            <a href="#!" class="d-block fw-medium text-body my-2">
                                <h5 class="mb-0 fs-4 text-truncate overflow-hidden">ReactJS Meetup: Getting Started</h5>
                            </a>
                            <div class="d-flex flex-wrap align-items-center row-gap-0 column-gap-2">
                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <p class="mb-0 fw-medium text-muted">Location</p>
                                    <span
                                        class="d-block h-6px w-6px bg-primary bg-opacity-70 align-middle rounded-circle"></span>
                                </div>
                                <p class="mb-0 fw-semibold text-muted flex-grow-1">123 Meetup Venue, Downtown, NYC</p>
                            </div>
                            <hr>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="avatar-group">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
                                    <div class="avatar-item border-2 avatar fw-medium fs-12 avatar-title bg-text-primary">
                                        30+</div>
                                </div>
                                <p class="mb-0 fw-medium text-muted">Attendees</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-md-6 col-xxl-4">
                    <div class="card mb-0 h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/small/img-5.jpg') }}" alt="Webinar"
                                    class="img-fluid rounded">
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                <p class="mb-0 fw-semibold text-primary text-uppercase">Thu 2:00 PM</p>
                                <div class="badge p-3 bg-body-secondary shadow-sm rounded-3 text-uppercase mt-n10 z-1 m-3">
                                    <span class="text-uppercase text-muted fs-6">nov</span>
                                    <h5 class="mb-0 fs-4 mt-1 lh-1">5</h5>
                                </div>
                            </div>
                            <a href="#!" class="d-block fw-medium text-body my-2">
                                <h5 class="mb-0 fs-4 text-truncate overflow-hidden">SEO Mastery: Boost Your Ranking</h5>
                            </a>
                            <div class="d-flex flex-wrap align-items-center row-gap-0 column-gap-2">
                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <p class="mb-0 fw-medium text-muted">Online</p>
                                </div>
                                <p class="mb-0 fw-semibold text-muted flex-grow-1">Join us online via Zoom</p>
                            </div>
                            <hr>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="avatar-group">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="avatar image">
                                    <div class="avatar-item border-2 avatar fw-medium fs-12 avatar-title bg-text-primary">
                                        99+</div>
                                </div>
                                <p class="mb-0 fw-medium text-muted">Registrants</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-md-6 col-xxl-4">
                    <div class="card mb-0 h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/small/img-6.jpg') }}" alt="Concert Event"
                                    class="img-fluid rounded">
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                <p class="mb-0 fw-semibold text-primary text-uppercase">Fri 8:00 PM</p>
                                <div class="badge p-3 bg-body-secondary shadow-sm rounded-3 text-uppercase mt-n10 z-1 m-3">
                                    <span class="text-uppercase text-muted fs-6">dec</span>
                                    <h5 class="mb-0 fs-4 mt-1 lh-1">10</h5>
                                </div>
                            </div>
                            <a href="#!" class="d-block fw-medium text-body my-2">
                                <h5 class="mb-0 fs-4 text-truncate overflow-hidden">Live Concert: The Weeknd</h5>
                            </a>
                            <div class="d-flex flex-wrap align-items-center row-gap-0 column-gap-2">
                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <p class="mb-0 fw-medium text-muted">Location</p>
                                    <span
                                        class="d-block h-6px w-6px bg-primary bg-opacity-70 align-middle rounded-circle"></span>
                                </div>
                                <p class="mb-0 fw-semibold text-muted flex-grow-1">Madison Square Garden, NYC</p>
                            </div>
                            <hr>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="avatar-group">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="avatar image">
                                    <div class="avatar-item border-2 avatar fw-medium fs-12 avatar-title bg-text-primary">
                                        99+</div>
                                </div>
                                <p class="mb-0 fw-medium text-muted">Attendees</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-md-6 col-xxl-4">
                    <div class="card mb-0 h-100 shadow-sm">
                        <div class="card-body p-4">
                            <div class="position-relative">
                                <img src="{{ asset('assets/images/small/img-7.jpg') }}" alt="Charity Fundraiser"
                                    class="img-fluid rounded">
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                                <p class="mb-0 fw-semibold text-primary text-uppercase">Sun 3:00 PM</p>
                                <div class="badge p-3 bg-body-secondary shadow-sm rounded-3 text-uppercase mt-n10 z-1 m-3">
                                    <span class="text-uppercase text-muted fs-6">nov</span>
                                    <h5 class="mb-0 fs-4 mt-1 lh-1">12</h5>
                                </div>
                            </div>
                            <a href="#!" class="d-block fw-medium text-body my-2">
                                <h5 class="mb-0 fs-4 text-truncate overflow-hidden">Annual Charity Fundraiser Gala</h5>
                            </a>
                            <div class="d-flex flex-wrap align-items-center row-gap-0 column-gap-2">
                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <p class="mb-0 fw-medium text-muted">Location</p>
                                    <span
                                        class="d-block h-6px w-6px bg-primary bg-opacity-70 align-middle rounded-circle"></span>
                                </div>
                                <p class="mb-0 fw-semibold text-muted flex-grow-1">Grand Ballroom, City Hotel, LA</p>
                            </div>
                            <hr>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="avatar-group">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                    <img class="img-fluid avatar avatar-item border-2"
                                        src="{{ asset('assets/images/avatar/avatar-10.jpg') }}" alt="avatar image">
                                    <div class="avatar-item border-2 avatar fw-medium fs-12 avatar-title bg-text-primary">
                                        20+</div>
                                </div>
                                <p class="mb-0 fw-medium text-muted">Hosts</p>
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
