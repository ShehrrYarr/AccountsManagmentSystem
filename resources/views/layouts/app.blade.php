<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/Favicon.png') }}">

    @yield('css')
    @include('partials.head-css')
    <link rel="stylesheet" href="{{ asset('assets/css/ams.css') }}">
    @livewireStyles
</head>

<body>
    @include('layouts.partials.header')
    @include('layouts.partials.sidebar')
    @include('partials.preloader')

    <main class="app-wrapper">
        <div class="app-container">

            {{-- Page title + breadcrumb + optional action buttons --}}
            <div class="hstack flex-wrap gap-3 mb-4">
                <div class="flex-grow-1">
                    <h4 class="mb-1 fw-semibold">@yield('page-title')</h4>
                    <nav>
                        <ol class="breadcrumb breadcrumb-arrow mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            @hasSection('breadcrumb-parent')
                                <li class="breadcrumb-item">@yield('breadcrumb-parent')</li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex flex-wrap my-xl-auto align-items-center gap-2 flex-shrink-0">
                    @yield('page-actions')
                </div>
            </div>

            @yield('content')

        </div>
    </main>

    @include('partials.scroll-to-top')

    <footer class="footer d-flex align-items-center text-center">
        <div class="container-fluid">
            <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </footer>

    @include('partials.vendor-scripts')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    @include('layouts.partials.livewire-glue')
    @livewireScripts
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @stack('scripts')
    @yield('js')
</body>

</html>
