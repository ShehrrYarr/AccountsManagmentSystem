@extends('partials.layouts.master2')

    @section('title', 'UI Cookies | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Cookies' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  


    @section('content')


    <div class="row">

        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Simple Cookie Alert Example </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Creates a simple notification for users about cookie usage, ensuring compliance with cookie laws while maintaining a user-friendly experience. It effectively informs users without disrupting their interaction with the site.</p>
                    <div class="min-h-300px">
                        <div class="position-absolute bottom-0 end-0 w-100">
                            <div class="d-flex align-items-center rounded p-4 border border-primary-subtle bg-primary-subtle mx-6 mb-6">
                                <i class="ri-error-warning-line lh-1 fs-20 text-primary me-2"></i>
                                <div class="text-gray-800 fs-6">
                                    The cookie alert element can include all of Bootstrap 5 classes, along with our own extended Boostrap 5 CSS classes to make it look and feel exactly as required.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Cookie Notification Example </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">This cookie notification creates a user-friendly alert about cookie usage, informing visitors while allowing them to customize their preferences or agree to the policy. It enhances user experience without interrupting site navigation.</p>
                    <div class="min-h-500px position-relative">
                        <div class="position-absolute bottom-0 end-0 w-100 max-w-384px">
                            <div class="card card-body border mb-0">
                                <span class="card-title h5 fw-semibold mb-3">🍪 Cookie Notification</span>
                                <p class="card-text">To provide you with the best browsing experience, we use cookies on our website. <a href="#!">Learn more about our cookie policy</a>.</p>
                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <a href="#!" class="link-dark">Customize your preferences</a>
                                    <button class="btn btn-dark">Agree</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Cookie Usage Notification </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">This cookie usage notification provides a clear message to users about cookie usage, ensuring they have the best experience on the website. It includes a link to learn more and a prominent button to acknowledge the message.</p>
                    <div class="min-h-500px position-relative">
                        <div class="position-absolute bottom-0 end-0 w-100 max-w-384px">
                            <div class="card card-body mb-0 text-bg-dark rounded-0">
                                <p class="card-text mb-2">This website uses cookies to ensure you get the best experience on our website.</p>
                                <a href="#!" class="text-decoration-underline mb-5 link-light link-offset-1 link-opacity-75-hover">Learn more</a>
                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <button class="btn btn-warning w-full rounded-0">Got it!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Cookies Consent Message </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">This example presents a cookies consent message that informs users about the website's use of cookies to enhance their browsing experience. It includes a clear message, a link for more information, and buttons for users to accept or decline cookie usage. This design effectively communicates transparency while allowing users to make informed choices.</p>
                    <div class="min-h-500px position-relative">
                        <div class="position-absolute bottom-0 end-0 w-100 max-w-384px">
                            <div class="card card-body mb-0 border">
                                <span class="card-title h5 fw-semibold mb-3">🍪 Cookies Consent</span>
                                <p class="card-text mb-2">This website use cookies to help you have a superior and more relevant browsing experience on the website.</p>
                                <a href="#!" class="text-decoration-underline mb-5 link-primary link-offset-1 link-opacity-75-hover">Read more</a>
                                <div class="d-flex align-items-center justify-content-between gap-5">
                                    <button class="btn btn-primary w-100">Accept</button>
                                    <button class="btn btn-outline-primary w-100">Decline</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Cookie Usage Box </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">This example features a cookie usage notification that informs users about the website's cookie practices. It explains how cookies are used for personalizing content, providing social media features, and analyzing traffic. Users can accept or decline the use of cookies, promoting transparency and user choice in their browsing experience.</p>
                    <div class="min-h-500px position-relative">
                        <div class="position-absolute bottom-0 end-0 w-100">
                            <div class="card card-body border mb-0 rounded-0">
                                <h5 class="card-title mb-3 text-uppercase fw-semibold">THIS WEBSITE USES COOKIES</h5>
                                <p class="mb-3">We use cookies to personalise content and ads, to provide social media features and to analyse our traffic. We also share information about your use of our site with our social media, advertising and analytics partners who may combine it with other information that you’ve provided to them or that they’ve collected from your use of their services. You consent to our cookies if you continue to use our website.</p>
                                <div class="d-flex align-items-center gap-5 mt-5">
                                    <button class="btn btn-primary rounded-0 w-144px">Accept</button>
                                    <button class="btn btn-outline-primary rounded-0 w-144px">Decline</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Cookie Policy Reminder </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">This example presents a cookie policy reminder that notifies users about the use of cookies on the website. It offers a short message with a link to the cookie policy for more details. Users can confirm their acknowledgment by clicking the "Okay" button, promoting transparency while ensuring a smooth browsing experience.</p>
                    <div class="min-h-500px position-relative">
                        <div class="position-absolute bottom-0 end-0 w-100">
                            <div class="card card-body mb-0 text-bg-dark rounded-0">
                                <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap">
                                    <p class="d-flex align-items-center gap-1 flex-wrap m-0"><span class="fs-20">🍪</span> We are using Cookies! For more information visit this page<a href="#!" class="text-decoration-underline link-primary link-offset-2 link-opacity-75-hover">Cookie policy.</a></p>
                                    <button class="btn btn-sm btn-light rounded-0">Okay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Cookie Experience Notification </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">This example features a cookie experience notification that informs users about the use of cookies to personalize their experience on the website. It includes a brief message and a link to the cookie policy for further details. Users can accept the notification by clicking the "Accept" button, fostering transparency while enhancing user engagement.</p>
                    <div class="min-h-500px position-relative">
                        <div class="position-absolute bottom-0 end-0 w-100 d-flex justify-content-center">
                            <div class="card card-body mb-0 text-bg-dark fs-12 p-4 max-w-620px">
                                <div class="d-flex align-items-center gap-2 justify-content-between">
                                    <p class="m-0">MyApp uses cookies to personalize your experience on our website. By continuing to use this site, you agree to our
                                        <a href="#!" class="text-decoration-underline link-primary link-offset-2 link-opacity-75-hover">Cookie policy</a>.
                                    </p>
                                    <button class="btn btn-sm btn-light">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

    </div>
@endsection

@section('js') 
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @endsection

