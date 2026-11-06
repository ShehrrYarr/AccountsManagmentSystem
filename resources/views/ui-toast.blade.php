@extends('partials.layouts.master2')

    @section('title', 'UI Toast | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Toast' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')


    @section('content')
 
    <div class="row">

        <div class="col-12 col-lg-6">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Toast</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use Bootstrap's <strong class="text-body-emphasis fw-medium">default toast</strong> to display notifications with <code>.toast</code> class. To show a toast, add the <code>.show</code> class and use JavaScript for automatic dismissal.</p>

                    <div class="toast show mb-4" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img height="25" src="{{ asset('assets/images/Favicon.png') }}" class="rounded me-2" alt="...">
                            <strong class="me-auto">Herozi</strong>
                            <small>11 mins ago</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body fs-13 text-muted">
                            Hello, world! This is a toast message.
                        </div>
                    </div>
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img height="25" src="{{ asset('assets/images/Favicon.png') }}" class="rounded me-2" alt="...">
                            <strong class="me-auto">Herozi</strong>
                            <small>11 mins ago</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <h5 class="mb-1 fw-medium fs-14">Your account will be permanently deleted?</h5>
                            <p class="mb-0 fs-13 text-muted">Do you intend to continue?</p>
                            <div class="mt-3 pt-3 border-top d-flex flex-wrap justify-content-end gap-3">
                                <button class="btn btn-light-primary btn-sm" type="button">I'm not sure</button>
                                <button class="btn btn-outline-danger btn-sm" type="button" data-bs-dismiss="toast">Remove My Account</button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->

            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Live example </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Check out the <strong class="text-body-emphasis fw-medium">live example</strong> of a Bootstrap toast by adding a <code>&lt;div class="toast"&gt;</code> with <code>.toast</code> class to your page. Use JavaScript to show or hide the toast and customize its content as needed.</p>

                    <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

                    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <img height="25" src="{{ asset('assets/images/Favicon.png') }}" class="rounded me-2" alt="...">
                                <strong class="me-auto">Herozi</strong>
                                <small>11 mins ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                <h6 class="mb-2">Your account will be permanently deleted?</h6>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Color schemes </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Apply <strong class="text-body-emphasis fw-medium">color schemes</strong> to Bootstrap toasts using classes like <code>.bg-success</code> or <code>.bg-danger</code>. These classes change the toast's background color to match different themes, such as success or error.</p>

                    <div class="toast show align-items-center text-white text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Hello, world! This is the Primary toast message.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="toast show align-items-center text-white text-bg-secondary border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Hello, world! This is the Secondary toast message.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="toast show align-items-center text-white text-bg-success border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Hello, world! This is the Success toast message.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="toast show align-items-center text-white text-bg-info border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Hello, world! This is the Info toast message.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="toast show align-items-center text-white text-bg-warning border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Hello, world! This is the warning toast message.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="toast show align-items-center text-white text-bg-danger border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Hello, world! This is the danger toast message.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="toast show align-items-center text-bg-light border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Hello, world! This is the light toast message.
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="toast show align-items-center text-white text-bg-dark border-0 mt-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                Hello, world! This is the dark toast message.
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Toast Placement </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Set <strong class="text-body-emphasis fw-medium">toast placement</strong> in Bootstrap using classes like <code>.top-0 .start-50</code> or <code>.bottom-0 .end-0</code>. These classes position the toast in different corners of the screen.</p>

                    <form>
                        <div class="mb-3">
                            <label for="selectToastPlacement">Toast placement</label>
                            <select class="form-select mt-2" id="selectToastPlacement">
                                <option value="top-0 start-0" selected>Top left</option>
                                <option value="top-0 start-50 translate-middle-x">Top center</option>
                                <option value="top-0 end-0">Top right</option>
                                <option value="top-50 start-0 translate-middle-y">Middle left</option>
                                <option value="top-50 start-50 translate-middle">Middle center</option>
                                <option value="top-50 end-0 translate-middle-y">Middle right</option>
                                <option value="bottom-0 start-0">Bottom left</option>
                                <option value="bottom-0 start-50 translate-middle-x">Bottom center</option>
                                <option value="bottom-0 end-0">Bottom right</option>
                            </select>
                        </div>
                    </form>
                    <div aria-live="polite" aria-atomic="true" class="bg-light bg-opacity-30 border border-dashed position-relative h-300px">
                        <div class="toast-container position-absolute p-3" id="toastPlacement">
                            <div class="toast show">
                                <div class="toast-header">
                                    <img height="25" src="{{ asset('assets/images/Favicon.png') }}" class="rounded me-2" alt="..." height="20">
                                    <strong class="me-auto">Herozi</strong>
                                    <small>11 mins ago</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    Hello, world! This is a toast message.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Custom toast color example </h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Customize <strong class="text-body-emphasis fw-medium">toast colors</strong> in Bootstrap by applying classes like <code>.bg-primary</code> or <code>.text-light</code> to the <code>&lt;div class="toast"&gt;</code>. This allows you to set custom background and text colors for your toasts.</p>

                    <!-- Buttons to trigger toasts with dynamic placement -->
                    <div class="hstack gap-3 flex-wrap">
                        <button class="btn btn-primary" id="showPrimaryToastBtn">New Message</button>
                        <button class="btn btn-secondary" id="showSecondaryToastBtn">System Update</button>
                        <button class="btn btn-success" id="showSuccessToastBtn">Payment Successful</button>
                        <button class="btn btn-info" id="showInfoToastBtn">Profile Updated</button>
                        <button class="btn btn-warning" id="showWarningToastBtn">Low Storage</button>
                        <button class="btn btn-danger" id="showDangerToastBtn">Security Alert</button>
                        <button class="btn btn-light" id="showLightToastBtn">Friend Request</button>
                        <button class="btn btn-dark" id="showDarkToastBtn">Night Mode</button>
                    </div>

                    <!-- Toasts Section with different placements -->
                    <!-- Top-Right Placement -->
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <!-- Primary Toast -->
                        <div id="toastPrimary" class="toast align-items-center border-0 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ri-mail-fill me-2"></i>
                                <strong class="me-auto">New Message</strong>
                                <small>Just Now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                You have a new message from Jane: <br>
                                <strong class="text-body-emphasis fw-medium">"Hey, can we reschedule our meeting?"</strong> <br>
                                <a href="#!">Reply now</a> or check your inbox for more details.
                            </div>
                        </div>

                        <!-- Secondary Toast -->
                        <div id="toastSecondary" class="toast align-items-center text-bg-secondary border-0 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ri-settings-3-fill me-2"></i>
                                <strong class="me-auto">System Update</strong>
                                <small>10 mins ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Your system has been updated to version 2.5.2. <br>
                                <strong class="text-body-emphasis fw-medium">What's new:</strong>
                                <ul>
                                    <li>Improved performance on startup</li>
                                    <li>Bug fixes and UI enhancements</li>
                                </ul>
                                <a href="#!" class="text-white">View full changelog</a>.
                            </div>
                        </div>
                    </div>

                    <!-- Bottom-Left Placement -->
                    <div class="toast-container position-fixed bottom-0 start-0 p-3">
                        <!-- Success Toast -->
                        <div id="toastSuccess" class="toast align-items-center border-0 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ri-check-fill me-2"></i>
                                <strong class="me-auto">Payment Successful</strong>
                                <small>Just Now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Your payment of $250 has been successfully processed. <br>
                                Transaction ID: <strong class="text-body-emphasis fw-medium">124589</strong>. <br>
                                <a href="#!">View receipt</a> or <a href="#!">download PDF</a>.
                            </div>
                        </div>

                        <!-- Info Toast -->
                        <div id="toastInfo" class="toast align-items-center border-0 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ri-information-fill me-2"></i>
                                <strong class="me-auto">Profile Updated</strong>
                                <small>2 hours ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Your profile was successfully updated with the following details: <br>
                                <strong class="text-body-emphasis fw-medium">Email:</strong> john.doe@example.com <br>
                                <strong class="text-body-emphasis fw-medium">Phone:</strong> +1234567890 <br>
                                <a href="#!">Review changes</a>.
                            </div>
                        </div>
                    </div>

                    <!-- Middle-Center Placement -->
                    <div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
                        <!-- Warning Toast -->
                        <div id="toastWarning" class="toast align-items-center border-0 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ri-alert-fill me-2"></i>
                                <strong class="me-auto">Low Storage</strong>
                                <small>45 mins ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Your device is running low on storage (<strong class="text-body-emphasis fw-medium">2GB left</strong>). <br>
                                <a href="#!">Manage storage</a> or <a href="#!">buy more space</a>.
                            </div>
                        </div>
                    </div>

                    <!-- Bottom-Right Placement -->
                    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <!-- Danger Toast -->
                        <div id="toastDanger" class="toast align-items-center text-bg-danger border-0 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-danger-subtle">
                                <i class="ri-shield-cross-fill me-2 text-danger"></i>
                                <strong class="me-auto">Security Alert</strong>
                                <small>30 mins ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Suspicious login attempt detected from Los Angeles, USA. <br>
                                <a href="#!" class="text-white">Secure your account</a> or review recent activity.
                            </div>
                        </div>

                        <!-- Light Toast -->
                        <div id="toastLight" class="toast align-items-center text-bg-light border-0 mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ri-user-add-fill me-2"></i>
                                <strong class="me-auto">Friend Request</strong>
                                <small>1 hour ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                You have a new friend request from Emily Brown. <br>
                                <a href="#!">View profile</a> or <a href="#!">Accept request</a>.
                            </div>
                        </div>

                        <!-- Dark Toast -->
                        <div id="toastDark" class="toast align-items-center text-bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <i class="ri-moon-fill me-2"></i>
                                <strong class="me-auto">Night Mode</strong>
                                <small>2 mins ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Night Mode has been activated. Enjoy a more comfortable browsing experience in low-light settings.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

    </div>
@endsection

@section('js')

    <!-- Toast js -->
    <script src="{{ asset('assets/js/plugins/toast.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection