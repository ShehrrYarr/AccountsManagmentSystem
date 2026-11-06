@extends('partials.layouts.master2')

    @section('title', 'Social Media Dashboard | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Social Media' )
    @section('pagetitle', 'Dashboard')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  
    @section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jsvectormap/jsvectormap.min.css') }}">
    @endsection
    
    @section('content')


    <div class="row g-4">
        <div class="col-md-6 col-xl-7">
            <div class="card card-body border border-dashed bg-primary bg-opacity-10 border-primary">
                <div class="d-flex justify-content-between align-items-center gap-3 flex-shrink-0">
                    <div class="hstack align-items-center gap-3">
                        <i class="ri-information-line text-primary fs-4"></i>
                        <div>
                            <p class="fw-medium fs-5 mb-0">Easily Manage Your Social Media Accounts</p>
                            <p class="text-muted fs-13 mb-0">Track followers, likes, comments, and more across Instagram, YouTube, and Facebook. Manage multiple accounts in the same Brand Account under <a href="#!">Video Content and Insights.</a></p>
                        </div>
                    </div>
                    <button class="btn btn-primary text-nowrap flex-grow-1">Learn More</button>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">Overview</h5>
                    <div class="dropdown flex-shrink-0">
                        <a class="text-reset dropdown-toggle" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Today</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#!">Today</a>
                            <a class="dropdown-item" href="#!">Last Week</a>
                            <a class="dropdown-item" href="#!">Last Month</a>
                            <a class="dropdown-item" href="#!">Current Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="hstack justify-content-between gap-3 mb-6">
                        <h6 class="flex-grow-1 mb-0 text-truncate">Connected Accounts</h6>
                        <div class="hstack gap-2 flex-shrink-0">
                            <p class="text-muted fs-12 mb-0">Refreshed 20 sec ago</p>
                            <span class="d-inline-flex align-items-center gap-2 text-body"><i class="ri-refresh-line fs-16 text-muted"></i>Refresh</span>
                        </div>
                    </div>
                    <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-xl-3">
                        <div class="col">
                            <div class="card card-body mb-0 border border-dashed shadow-none bg-light bg-opacity-20">
                                <div class="hstack gap-2 flex-grow-1 mb-3">
                                    <img class="img-fluid avatar-xs rounded-0" src="{{ asset('assets/images/social-media/instagram.svg') }}" alt="instagram">
                                    <a href="#!" class="text-body">Instagram</a>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <h4 class="mb-0 fw-semibold">12,345</h4>
                                        <p class="badge m-0 bg-info-subtle text-info">+1,234</p>
                                    </div>
                                    <p class="text-muted fs-6 mb-0">Followers</p>
                                </div>
                                <hr>
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div>
                                        <h6 class="mb-0 fw-semibold">5,678</h6>
                                        <p class="fs-12 text-muted mb-0">Comments</p>
                                    </div>
                                    <div class="vr h-30px align-self-center bg-secondary-subtle"></div>
                                    <div>
                                        <h5 class="mb-0 fw-semibold">2,345,678</h5>
                                        <p class="fs-12 text-muted mb-0">Likes/day</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-body mb-0 border border-dashed shadow-none bg-light bg-opacity-20">
                                <div class="hstack gap-2 flex-grow-1 mb-3">
                                    <img class="img-fluid avatar-xs rounded-0" src="{{ asset('assets/images/social-media/youtube.svg') }}" alt="youtube">
                                    <a href="#!" class="text-body">YouTube</a>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <h4 class="mb-0 fw-semibold">25,678</h4>
                                        <p class="badge m-0 bg-info-subtle text-info">+2,345</p>
                                    </div>
                                    <p class="text-muted fs-6 mb-0">Subscribers</p>
                                </div>
                                <hr>
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div>
                                        <p class="fs-12 text-muted mb-0">Comments</p>
                                        <p class="mb-0 fw-semibold">1,234</p>
                                    </div>
                                    <div class="vr h-30px align-self-center bg-secondary-subtle"></div>
                                    <div>
                                        <p class="fs-12 text-muted mb-0">Likes</p>
                                        <p class="mb-0 fw-semibold">10,456</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-body mb-0 border border-dashed shadow-none bg-light bg-opacity-20">
                                <div class="hstack gap-2 flex-grow-1 mb-3">
                                    <img class="img-fluid avatar-xs rounded-0" src="{{ asset('assets/images/social-media/facebook.svg') }}" alt="facebook">
                                    <a href="#!" class="text-body">Facebook</a>
                                </div>
                                <div class="mb-1">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <h4 class="mb-0 fw-semibold">15,789</h4>
                                        <p class="badge m-0 bg-info-subtle text-info">+567</p>
                                    </div>
                                    <p class="text-muted fs-6 mb-0">Followers</p>
                                </div>
                                <hr>
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div>
                                        <p class="fs-12 text-muted mb-0">Comments</p>
                                        <p class="mb-0 fw-semibold">3,456</p>
                                    </div>
                                    <div class="vr h-30px align-self-center bg-secondary-subtle"></div>
                                    <div>
                                        <p class="fs-12 text-muted mb-0">Likes</p>
                                        <p class="mb-0 fw-semibold">8,910</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-5">
            <div class="card mb-0">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">Active Promotion</h5>
                    <button class="btn btn-sm btn-light-primary">Generate Report</button>
                </div>
                <div class="card-body project-dashboard pe-0">
                    <!-- Nav tabs -->
                    <ul class="nav gap-2 custom-verti-nav-pills text-center px-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#demo-tab-instagram" role="tab" aria-selected="true">Instagram</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#demo-tab-youtube" role="tab" aria-selected="false" tabindex="-1">Youtube</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#demo-tab-twitter" role="tab" aria-selected="false" tabindex="-1">Twitter</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active show" id="demo-tab-instagram" role="tabpanel">
                            <div id="instagram-chart"></div>

                            <div class="hstack gap-5">
                                <div>
                                    <p class="mb-1 text-muted fs-12">Followers</p>
                                    <h4 class="mb-2 fs-18">+12,345K</h4>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <p class="badge m-0 bg-info-subtle text-info">+1,800</p>
                                        <span class="mb-0 text-muted fs-12">In last 2 days</span>
                                    </div>
                                </div>
                                <div class="ps-md-5">
                                    <p class="mb-1 text-muted fs-12">Spending</p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-currency-rupee"></i>
                                        <h4 class="mb-0 fs-18">5,000</h4>
                                    </div>
                                    <p class="badge m-0 bg-danger-subtle text-danger mb-1">3 days left</p>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="demo-tab-youtube" role="tabpanel">
                            <div id="youtube-chart"></div>

                            <div class="hstack gap-5">
                                <div>
                                    <p class="mb-1 text-muted fs-12">Subscribers</p>
                                    <h4 class="mb-2 fs-18">+15,432K</h4>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <p class="badge m-0 bg-info-subtle text-info">+2,000</p>
                                        <span class="mb-0 text-muted fs-12">In last 5 days</span>
                                    </div>
                                </div>
                                <div class="ps-md-5">
                                    <p class="mb-1 text-muted fs-12">Spending</p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-currency-rupee"></i>
                                        <h4 class="mb-0 fs-18">8,000</h4>
                                    </div>
                                    <p class="badge m-0 bg-danger-subtle text-danger mb-1">2 days left</p>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="demo-tab-twitter" role="tabpanel">
                            <div id="twitter-chart"></div>

                            <div class="hstack gap-5">
                                <div>
                                    <p class="mb-1 text-muted fs-12">Followers</p>
                                    <h4 class="mb-2 fs-18">+8,765K</h4>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <p class="badge m-0 bg-info-subtle text-info">+1,200</p>
                                        <span class="mb-0 text-muted fs-12">In last 3 days</span>
                                    </div>
                                </div>
                                <div class="ps-md-5">
                                    <p class="mb-1 text-muted fs-12">Spending</p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-currency-rupee"></i>
                                        <h4 class="mb-0 fs-18">3,500</h4>
                                    </div>
                                    <p class="badge m-0 bg-danger-subtle text-danger mb-1">1 day left</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-7">
            <div class="card mb-0 h-100">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">Most active time</h5>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-outline-primary btn-sm active">1W</button>
                        <button type="button" class="btn btn-outline-primary btn-sm">1M</button>
                        <button type="button" class="btn btn-outline-primary btn-sm">6M</button>
                        <button type="button" class="btn btn-outline-primary btn-sm">1Y</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="active-time-chart"></div>
                    <hr class="mt-0">
                    <div class="d-flex flex-wrap align-items-center gap-5">
                        <div>
                            <p class="fs-12 text-muted mb-0">Most active time</p>
                            <p class="mb-0 fw-semibold">12:00 PM - 13:45 PM</p>
                        </div>
                        <div class="vr h-30px align-self-center bg-secondary-subtle"></div>
                        <div>
                            <p class="fs-12 text-muted mb-0">Engagements</p>
                            <p class="mb-0 fw-semibold">14,487</p>
                        </div>
                        <div class="vr h-30px align-self-center bg-secondary-subtle"></div>
                        <div>
                            <p class="fs-12 text-muted mb-0">Likes</p>
                            <p class="mb-0 fw-semibold">1,254</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-5">
            <div class="card mb-0 h-100">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">Recent Posts</h5>
                    <div class="dropdown flex-shrink-0">
                        <a class="text-reset dropdown-toggle" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Current Week</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#!">Today</a>
                            <a class="dropdown-item" href="#!">Last Week</a>
                            <a class="dropdown-item" href="#!">Last Month</a>
                            <a class="dropdown-item" href="#!">Current Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table table-nowrap mb-0 align-middle">
                            <thead class="bg-light bg-opacity-30">
                                <tr>
                                    <th scope="col">Social Media</th>
                                    <th scope="col">Reach</th>
                                    <th scope="col">Engagements</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/social-media/facebook.svg') }}" alt="facebook" class="avatar-sm rounded-2">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fs-14">Facebook</h6>
                                                <span class="text-muted fs-12">Today at 3.00PM</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">1.2k day</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">5.8k day</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/social-media/twitter.svg') }}" alt="twitter" class="avatar-sm rounded-2">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fs-14">Twitter</h6>
                                                <span class="text-muted fs-12">Today at 2.30PM</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">800 day</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">2.1k day</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/social-media/instagram.svg') }}" alt="instagram" class="avatar-sm rounded-2">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fs-14">Instagram</h6>
                                                <span class="text-muted fs-12">Today at 1.00PM</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">1.5k day</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">3.5k day</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/social-media/linkedin.svg') }}" alt="linkedin" class="avatar-sm rounded-2">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fs-14">LinkedIn</h6>
                                                <span class="text-muted fs-12">Today at 12.00PM</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">600 day</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">1.2k day</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/images/social-media/dribble.svg') }}" alt="dribble" class="avatar-sm rounded-2">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fs-14">Dribble</h6>
                                                <span class="text-muted fs-12">Today at 11.00AM</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">900 day</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-14">2.5k day</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-8">
            <div class="card mb-0 h-100">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">Global Reach</h5>
                    <button class="btn btn-sm btn-light-primary flex-shrink-0">Generate Report</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="pe-lg-5">
                                <div id="global-reach-map" class="min-h-320px"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-nowrap d-flex flex-column justify-content-center h-100 gap-4">
                                <div>
                                    <p class="mb-0 fw-semibold">United States</p>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success w-50"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0 lh-1">50%</span>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold">India</p>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-info w-25"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0 lh-1">25%</span>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold">Russia</p>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-warning" style="width: 14%;"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0 lh-1">14%</span>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold">Germany</p>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 35%;"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0 lh-1">35%</span>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold">United Kingdom</p>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-danger w-50"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0 lh-1">50%</span>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0 fw-semibold">France</p>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress progress-xs flex-grow-1" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-info" style="width: 30%;"></div>
                                        </div>
                                        <span class="w-30px text-end fw-semibold flex-shrink-0 lh-1">30%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-0 h-100">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <h5 class="card-title mb-0 flex-grow-1">All Channels</h5>
                    <div class="dropdown flex-shrink-0">
                        <a class="text-reset dropdown-toggle" href="#!" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Nov 2021</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#!">Oct 2021</a>
                            <a class="dropdown-item" href="#!">Nov 2021</a>
                            <a class="dropdown-item" href="#!">Dec 2021</a>
                            <a class="dropdown-item" href="#!">Jan 2022</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group fs-13 fw-medium list-group-flush">
                        <li class="list-group-item hstack gap-2 px-0">
                            <img class="avatar avatar-item overflow-hidden border-0 rounded-0 bg-transparent flex-shrink-0" src="{{ asset('assets/images/social-media/twitter.svg') }}" alt="Twitter">
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Twitter</a>
                                    <span class="text-muted fw-normal text-truncate fs-12">Social Media Platform for News & Updates</span>
                                </div>
                                <div class="badge text-success bg-success-subtle p-1"><i class="ri-arrow-up-line me-1"></i>5.12%</div>
                            </div>
                        </li>
                        <li class="list-group-item hstack gap-2 px-0">
                            <img class="avatar avatar-item overflow-hidden border-0 rounded-0 bg-transparent flex-shrink-0" src="{{ asset('assets/images/social-media/linkedin.svg') }}" alt="LinkedIn">
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">LinkedIn</a>
                                    <span class="text-muted fw-normal text-truncate fs-12">Professional Networking Platform</span>
                                </div>
                                <div class="badge text-danger bg-danger-subtle p-1"><i class="ri-arrow-down-line me-1"></i>1.45%</div>
                            </div>
                        </li>
                        <li class="list-group-item hstack gap-2 px-0">
                            <img class="avatar avatar-item overflow-hidden border-0 rounded-0 bg-transparent flex-shrink-0" src="{{ asset('assets/images/social-media/dribble.svg') }}" alt="Dribbble">
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Dribbble</a>
                                    <span class="text-muted fw-normal text-truncate fs-12">Design Community & Showcase</span>
                                </div>
                                <div class="badge text-success bg-success-subtle p-1"><i class="ri-arrow-up-line me-1"></i>3.75%</div>
                            </div>
                        </li>
                        <li class="list-group-item hstack gap-2 px-0">
                            <img class="avatar avatar-item overflow-hidden border-0 rounded-0 bg-transparent flex-shrink-0" src="{{ asset('assets/images/social-media/facebook.svg') }}" alt="Facebook">
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Facebook</a>
                                    <span class="text-muted fw-normal text-truncate fs-12">Social Media Platform for Connections</span>
                                </div>
                                <div class="badge text-danger bg-danger-subtle p-1"><i class="ri-arrow-down-line me-1"></i>2.10%</div>
                            </div>
                        </li>
                        <li class="list-group-item hstack gap-2 px-0">
                            <img class="avatar avatar-item overflow-hidden border-0 rounded-0 bg-transparent flex-shrink-0" src="{{ asset('assets/images/social-media/instagram.svg') }}" alt="Instagram">
                            <div class="hstack gap-2 flex-grow-1 overflow-hidden">
                                <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                                    <a href="#!" class="fs-6 fw-bold text-truncate text-body">Instagram</a>
                                    <span class="text-muted fw-normal text-truncate fs-12">Photo & Video Sharing Platform</span>
                                </div>
                                <div class="badge text-success bg-success-subtle p-1"><i class="ri-arrow-up-line me-1"></i>4.20%</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Countup init -->
    <script type="module" src="{{ asset('assets/js/pages/countup.init.js') }}"></script>

    <!-- ApexChat js -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world.js') }}"></script>

    <!-- Social Media Dashboard init -->
    <script src="{{ asset('assets/js/charts/apexcharts-config.init.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard-social-media.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @endsection
