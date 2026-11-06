@extends('partials.layouts.master2')

    @section('title', 'UI Modal | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Media Player' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
    @section('content')


    <div class="row g-4">

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Modal View</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a modal view using Bootstrap by adding a <code>&lt;div class="modal"&gt;</code> container. Use <code>.modal-dialog</code> and <code>.modal-content</code> to structure the modal, and trigger it with buttons or links using <code>data-bs-toggle="modal"</code>.</p>
                    <!-- start:: Modal View -->
                    <div class="modal d-block position-relative z-1" role="dialog">
                        <div class="modal-dialog mb-0" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">🌟 Exciting Updates!</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="fs-5 mb-3">Welcome to Our Platform!</h2>
                                    <p class="mb-4">We're thrilled to share the latest features designed to enhance your experience:</p>
                                    <ul class="list-group">
                                        <li class="list-group-item hstack border-0 py-1">
                                            <i class="ri-search-line me-2 text-primary"></i>
                                            <span>Enhanced Search Functionality</span>
                                        </li>
                                        <li class="list-group-item hstack border-0 py-1">
                                            <i class="ri-bar-chart-line me-2 text-success"></i>
                                            <span>Improved Analytics Dashboard</span>
                                        </li>
                                        <li class="list-group-item hstack border-0 py-1">
                                            <i class="ri-user-line me-2 text-warning"></i>
                                            <span>User-Friendly Interface Updates</span>
                                        </li>
                                    </ul>
                                    <p class="mt-4 mb-0">Join us as we continue to evolve and innovate!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- end:: Modal View -->
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Modal</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Display a default modal using Bootstrap by adding a <code>&lt;div class="modal fade"&gt;</code> structure. Trigger it with a button or link using <code>data-bs-toggle="modal"</code> and <code>data-bs-target="#defaultModal"</code> for a live demo experience.</p>
                    <!-- Default Modal Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModal">
                        Launch Default Modal
                    </button>

                    <!-- start:: Default Modal -->
                    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">🚀 Get Ready for Our Next Event!</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="fs-5 mb-3">Join Us for an Exclusive Webinar!</h2>
                                    <p class="mb-4">We're excited to invite you to our upcoming webinar, where you'll learn:</p>
                                    <ul class="mt-3 list-group">
                                        <li class="list-group-item border-0">
                                            <i class="ri-bar-chart-line me-2 text-primary"></i>Tips and tricks for maximizing productivity
                                        </li>
                                        <li class="list-group-item border-0">
                                            <i class="ri-user-heart-line me-2 text-success"></i>Networking opportunities with industry leaders
                                        </li>
                                        <li class="list-group-item border-0">
                                            <i class="ri-search-line me-2 text-warning"></i>Insights into the latest trends and technologies
                                        </li>
                                    </ul>
                                    <hr class="my-4">
                                    <div class="text-center">
                                        <p class="fw-bold mb-1">📅 <span class="text-primary">Date:</span> September 30, 2024</p>
                                        <p class="fw-bold mb-1">🕒 <span class="text-primary">Time:</span> 3:00 PM - 4:00 PM (EST)</p>
                                        <p class="fw-bold mb-4">🔗 <span class="text-primary">Location:</span> Online (link to be provided upon registration)</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Register Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end:: Default Modal -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Static backdrop</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a static backdrop modal using Bootstrap by adding the <code>data-bs-backdrop="static"</code> attribute to your modal. This prevents the modal from closing when clicking outside of it.</p>
                    <!-- Static Modal Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Launch static backdrop modal
                    </button>

                    <!-- start:: Static Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end:: Default Modal -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Scrolling long content</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Handle long content in a Bootstrap modal by adding <code>.modal-dialog-scrollable</code> to the <code>&lt;div class="modal-dialog"&gt;</code>. This allows the modal body to scroll while keeping the header and footer fixed.</p>
                    <!-- Scrollable  Modal Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scrollable">
                        Launch Scrollable modal
                    </button>

                    <!-- start:: Scrollable  Modal -->
                    <div class="modal fade" id="scrollable" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="scrollableLabel">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>This is some placeholder content to show the scrolling behavior for modals. We use repeated line breaks to demonstrate how content can exceed minimum inner height, thereby showing inner scrolling. When content becomes longer than the predefined max-height of modal, content will be cropped and scrollable within the modal.</p>
                                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                    <p>This content should appear at the bottom after you scroll.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end:: Default Modal -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Vertically centered</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Center a Bootstrap modal vertically by adding <code>.modal-dialog-centered</code> to the <code>&lt;div class="modal-dialog"&gt;</code>. This aligns the modal in the middle of the viewport.</p>
                    <!-- Centered Modal Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#centered">
                        Vertically Centered modal
                    </button>

                    <!-- start:: Centered Modal -->
                    <div class="modal fade" id="centered" data-bs-keyboard="false" tabindex="-1" aria-labelledby="centeredLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="centeredLabel">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end:: Default Modal -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Tooltips and popovers</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Enable tooltips and popovers inside a Bootstrap modal by initializing them with <code>data-bs-toggle="tooltip"</code> or <code>data-bs-toggle="popover"</code>. This allows interactive elements within the modal to display additional information.</p>
                    <!-- Tooltips and popovers Modal Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popovers">
                        Tooltips and Popovers modal
                    </button>

                    <!-- start:: Tooltips and popovers Modal -->
                    <div class="modal fade" id="popovers" data-bs-keyboard="false" tabindex="-1" aria-labelledby="popoversLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content rounded-4 shadow">
                                <div class="modal-header text-white">
                                    <h5 class="modal-title" id="popoversLabel">✨ Discover Exciting Features!</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h2 class="fs-5 text-primary">🎉 Popover in a Modal</h2>
                                    <p>
                                        Experience our interactive feature:
                                        <button type="button" class="btn btn-primary" data-bs-custom-class="popover-primary" data-bs-placement="top" data-bs-toggle="popover" title="✨ Primary Popover" data-bs-content="This is a delightful popover, show some love! 💖">
                                            Click Me!
                                        </button>
                                        to unveil a surprise.
                                    </p>
                                    <hr>
                                    <h2 class="fs-5 text-success">💡 Tooltips in Action</h2>
                                    <p>
                                        Hover over these links for more info:
                                        <a href="#!" data-bs-toggle="tooltip" title="Tooltip with additional details! 🌟">This link</a>
                                        and
                                        <a href="#!" data-bs-toggle="tooltip" title="Learn more here! 🌈">that link</a>.
                                    </p>
                                    <hr>
                                    <div class="text-center mt-4 avatar-xl avatar-item border-0 overflow-hidden mx-auto">
                                        <img src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Exciting Feature" class="h-100 w-100 img-fluid" />
                                    </div>
                                    <p class="mt-2 text-center">Join our community and stay updated with the latest features!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end:: Tooltips and popovers Modal -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Fullscreen Modal</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a fullscreen modal in Bootstrap by adding the <code>.modal-fullscreen</code> class to the <code>&lt;div class="modal-dialog"&gt;</code>. This expands the modal to cover the entire viewport.</p>
                    <!-- Fullscreen Modal Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fullscreenModal">
                        Launch Fullscreen modal
                    </button>

                    <!-- start:: Fullscreen Modal -->
                    <div class="modal fade" id="fullscreenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fullscreenModalLabel">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end:: Fullscreen Modal -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Modal Size</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Adjust the size of a Bootstrap modal by adding size-specific classes like <code>.modal-sm</code> for small, <code>.modal-lg</code> for large, or <code>.modal-xl</code> for extra-large to the <code>&lt;div class="modal-dialog"&gt;</code>.</p>
                    <!-- Extra Large Modal Size Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#extraLargeModel">
                        Extra Large Modal
                    </button>

                    <!-- Large Modal Size Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModel">
                        Large Modal
                    </button>

                    <!-- Small Modal Size Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smallModel">
                        Small Modal
                    </button>

                    <!-- start:: Extra Large Modal Size -->
                    <div class="modal fade" id="extraLargeModel" data-bs-keyboard="false" tabindex="-1" aria-labelledby="extraLargeModelLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="extraLargeModelLabel">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- end:: Extra Large Modal Size -->

                    <!-- start:: Large Modal Size -->
                    <div class="modal fade" id="largeModel" data-bs-keyboard="false" tabindex="-1" aria-labelledby="largeModelLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="largeModelLabel">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- end:: Large Modal Size -->

                    <!-- start:: Small Modal Size -->
                    <div class="modal fade" id="smallModel" data-bs-keyboard="false" tabindex="-1" aria-labelledby="smallModelLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="smallModelLabel">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-0">Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- end:: Small Modal Size -->
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Fullscreen Modals Example</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Handle long content in a Bootstrap modal by adding <code>.modal-dialog-scrollable</code> to the <code>&lt;div class="modal-dialog"&gt;</code>. This allows the modal body to scroll while keeping the header and footer fixed.</p>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Availability</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>.modal-fullscreen</code></td>
                                    <td>Always</td>
                                </tr>
                                <tr>
                                    <td><code>.modal-fullscreen-sm-down</code></td>
                                    <td><code>576px</code></td>
                                </tr>
                                <tr>
                                    <td><code>.modal-fullscreen-md-down</code></td>
                                    <td><code>768px</code></td>
                                </tr>
                                <tr>
                                    <td><code>.modal-fullscreen-lg-down</code></td>
                                    <td><code>992px</code></td>
                                </tr>
                                <tr>
                                    <td><code>.modal-fullscreen-xl-down</code></td>
                                    <td><code>1200px</code></td>
                                </tr>
                                <tr>
                                    <td><code>.modal-fullscreen-xxl-down</code></td>
                                    <td><code>1400px</code></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Scrollable  Modal Button -->
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">Full Screen</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreenSm">Full Screen below sm</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreenMd">Full Screen below md</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreenLg">Full Screen below lg</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreenXl">Full Screen below xl</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreenXxl">Full Screen below xxl</button>
                    </div>

                    <!-- Modals -->
                    <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalFullscreenLabel">Fullscreen Modal</h5>
                                    <button type="button" class="btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-2 fw-semibold">This is a <span class="highlight">fullscreen modal</span> that occupies the entire viewport.</p>
                                    <p class="m-0">It is useful for displaying important content without distractions.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalFullscreenSm" tabindex="-1" aria-labelledby="exampleModalFullscreenSmLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-sm-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalFullscreenSmLabel">Fullscreen below sm</h5>
                                    <button type="button" class="btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-2 fw-semibold">This modal is designed to be <span class="highlight">fullscreen below 576px</span>.</p>
                                    <p class="m-0">It ensures a better viewing experience on small devices.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalFullscreenMd" tabindex="-1" aria-labelledby="exampleModalFullscreenMdLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalFullscreenMdLabel">Fullscreen below md</h5>
                                    <button type="button" class="btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-2 fw-semibold">This modal will appear <span class="highlight">fullscreen below 768px</span>.</p>
                                    <p class="m-0">Ideal for mid-sized screens, allowing for more content visibility.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalFullscreenLg" tabindex="-1" aria-labelledby="exampleModalFullscreenLgLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-lg-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalFullscreenLgLabel">Fullscreen below lg</h5>
                                    <button type="button" class="btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-2 fw-semibold">This modal is designed to be <span class="highlight">fullscreen below 992px</span>.</p>
                                    <p class="m-0">Useful for tablets and larger mobile devices.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalFullscreenXl" tabindex="-1" aria-labelledby="exampleModalFullscreenXlLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-xl-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalFullscreenXlLabel">Fullscreen below xl</h5>
                                    <button type="button" class="btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-2 fw-semibold">This modal will be <span class="highlight">fullscreen below 1200px</span>.</p>
                                    <p class="m-0">Great for larger screens to maintain a focused view.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalFullscreenXxl" tabindex="-1" aria-labelledby="exampleModalFullscreenXxlLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-xxl-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalFullscreenXxlLabel">Fullscreen below xxl</h5>
                                    <button type="button" class="btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-2 fw-semibold">This modal is set to be <span class="highlight">fullscreen below 1400px</span>.</p>
                                    <p class="m-0">It's ideal for a clean and uninterrupted display of content.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Draggable Modal</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Make a Bootstrap modal draggable by adding the <code>data-draggable="true"</code> attribute to the <code>&lt;div class="modal"&gt;</code> element. This allows users to move the modal around the screen.</p>
                    <!-- Scrollable  Modal Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dragModal">
                        Launch Scrollable modal
                    </button>

                    <!-- start:: Scrollable  Modal -->
                    <div class="modal fade" id="dragModal" data-draggable="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="dragModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dragModalLabel">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body" id="draggableContent">
                                    <p>This content should appear at the bottom after you scroll.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end:: Default Modal -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Animated Modal</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Choose an animation from the dropdown and click <strong>Show Modal</strong> to see the Bootstrap modal open with a smooth animation effect.</p>

                    <div class="input-group">
                        <!-- Animation Selector -->
                        <select id="animationSelector" class="form-select">
                            <option value="fade" selected>Fade</option>
                            <option value="scale-in">Scale In</option>
                            <option value="slide-in-right">Slide In Right</option>
                            <option value="slide-in-bottom">Slide In Bottom</option>
                            <option value="flip-vertical">Flip Vertical</option>
                            <option value="flip-horizontal">Flip Horizontal</option>
                            <option value="zoom-in">Zoom In</option>
                            <option value="slide-in-left">Slide In Left</option>
                            <option value="slide-in-top">Slide In Top</option>
                            <option value="rotate-in">Rotate In</option>
                            <option value="shake">Shake</option>
                            <option value="swing">Swing</option>
                            <option value="zoom-out">Zoom Out</option>
                        </select>
                        <!-- Scrollable  Modal Button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#anime1">
                            Show modal
                        </button>
                    </div>

                    <!-- start:: Scrollable  Modal -->
                    <div class="modal" id="anime1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="anime1Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="anime1Label">Modal title</h5>
                                    <button type="button" class="close btn btn-text-primary icon-btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ri-close-large-line fw-semibold"></i>
                                    </button>
                                </div>
                                <div class="modal-body" id="draggableContent">
                                    <p>This content should appear at the bottom after you scroll.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- end:: Default Modal -->
                </div>
            </div>
            <!--end::card-->
        </div>

    </div>

@endsection

@section('js')
    <!-- Sortablejs js -->
    <script src="{{ asset('assets/libs/sortablejs/Sortable.min.js') }}"></script>

    <!-- Modal init -->
    <script src="{{ asset('assets/js/pages/modal.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
