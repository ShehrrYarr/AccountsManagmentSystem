<div class="hstack flex-wrap gap-3 mb-4">
    <div class="flex-grow-1">
        <h4 class="mb-1 fw-semibold">@yield('sub-title')</h4>
        <nav>
            <ol class="breadcrumb breadcrumb-arrow mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('index') }}">@yield('pagetitle')</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">@yield('sub-title')</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto align-items-center flex-shrink-0">
        @if (!empty(trim(View::yieldContent('modalTarget'))))
            <a href="javascript:void(0)" 
               class="btn btn-sm btn-primary" 
               data-bs-toggle="modal" 
               data-bs-target="#@yield('modalTarget')">
                @yield('buttonTitle')
            </a>
        @else
            <a href="{{ url(trim(View::yieldContent('link'))) }}" class="btn btn-sm btn-primary">
                @yield('buttonTitle')
            </a>
        @endif
    </div>
  </div>
  