@extends('partials.layouts.master3')

    @section('title', 'Pricing | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Pricing' )
    @section('pagetitle', 'Pages')
    @section('buttonTitle', 'Share')
    @section('link', '#!')

    @section('content')


  <div class="text-center mb-4">
    <h4 class="fs-22">Find the right plan for your site</h4>
    <p class="text-muted mb-4 fs-15">Get started with us - it's perfect for individuals and teams. Choose a subscription plan that meets your needs.</p>
  </div>
  <div class="d-flex flex-column align-items-center mx-auto flex-wrap gap-2 py-5 max-w-384px">
    <div class="d-flex align-items-end justify-content-end gap-2 w-100">
      <i class="ri-corner-left-down-line fs-18 lh-1"></i>
      <span class="badge badge-sm bg-primary rounded-pill">GET 2 MONTHS FREE</span>
    </div>
    <div class="form-check form-switch form-switch-primary mb-3 d-flex align-items-center gap-2 p-0">
      <label class="form-check-label mb-0" for="toggleSwitch">Monthly</label>
      <input class="form-check-input m-0" type="checkbox" role="switch" id="toggleSwitch">
      <label class="form-check-label mb-0" for="toggleSwitch">Annually</label>
    </div>
  </div>

  <div class="row">
    <!-- Starter Plan -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card card-h-100">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="text-start text-uppercase">Starter Plan</h5>
            <div class="position-relative mb-5 pb-1">
              <div class="monthly-price">
                <div class="d-flex">
                  <h1 class="text-primary mb-0">$49</h1>
                  <sub class="h5 text-muted mt-auto mb-2">/mo</sub>
                </div>
                <small class="position-absolute m-auto text-muted d-block">$588 / year</small>
              </div>
              <div class="yearly-price d-flex d-none">
                <h1 class="text-primary mb-0">$149</h1>
                <sub class="h5 text-muted mt-auto mb-2">/year</sub>
              </div>
            </div>
            <p>Everything you need to launch your business</p>
            <hr>
            <ul class="list-unstyled pt-2 pb-1">
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                Up to 10 users
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                150+ components
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                Basic support via email
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-muted bg-light me-2">
                  <i class="ri-close-line fs-12"></i>
                </span>
                Monthly updates
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-muted bg-light me-2">
                  <i class="ri-close-line fs-12"></i>
                </span>
                Integrations
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-muted bg-light me-2">
                  <i class="ri-close-line fs-12"></i>
                </span>
                Full Support
              </li>
            </ul>
          </div>
          <button class="btn btn-light-primary w-100">Choose Plan</button>
        </div>
      </div>
    </div>

    <!-- Pro Plan -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card card-h-100 border-primary shadow-sm">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="text-start text-uppercase">Pro Plan</h5>
            <div class="position-relative mb-5 pb-1">
              <div class="monthly-price">
                <div class="d-flex">
                  <h1 class="text-primary mb-0">$99</h1>
                  <sub class="h5 text-muted mt-auto mb-2">/mo</sub>
                </div>
                <small class="position-absolute m-auto text-muted d-block">$1,188 / year</small>
              </div>
              <div class="yearly-price d-flex d-none">
                <h1 class="text-primary mb-0">$839</h1>
                <sub class="h5 text-muted mt-auto mb-2">/year</sub>
              </div>
            </div>
            <p>Advanced tools for growing your business</p>
            <hr>
            <ul class="list-unstyled pt-2 pb-1">
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                Up to 50 users
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                300+ components
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                Priority support via email and chat
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-muted bg-light me-2">
                  <i class="ri-close-line fs-12"></i>
                </span>
                Monthly updates
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-muted bg-light me-2">
                  <i class="ri-close-line fs-12"></i>
                </span>
                Integrations
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-muted bg-light me-2">
                  <i class="ri-close-line fs-12"></i>
                </span>
                Full Support
              </li>
            </ul>
          </div>
          <button class="btn btn-primary w-100">Choose Plan</button>
        </div>
      </div>
    </div>

    <!-- Enterprise Plan -->
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card card-h-100">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="text-start text-uppercase">Enterprise Plan</h5>
            <div class="d-flex mb-5 pb-1">
              <h1 class="text-primary mb-0">Contact Us</h1>
            </div>
            <p>Custom solutions for large organizations</p>
            <hr>
            <ul class="list-unstyled pt-2 pb-1">
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                Unlimited users
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                All components
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                24/7 premium support
              </li>
              <li class="mb-2 d-flex align-items-center">
                <span class="badge w-24px h-24px d-flex justify-content-center align-items-center rounded-pill text-primary bg-primary-subtle me-2">
                  <i class="ri-check-line fs-12"></i>
                </span>
                Custom integrations
              </li>
            </ul>
          </div>
          <button class="btn btn-light-primary w-100">Contact Us</button>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('js')
  <!-- Pricing init js -->
  <script src="{{ asset('assets/js/pages/pricing.init.js') }}"></script>

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection