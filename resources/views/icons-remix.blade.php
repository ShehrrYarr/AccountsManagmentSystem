@extends('partials.layouts.master2')

    @section('title', 'Remix Icons | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Remix Icon' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  

    @section('content')


    <div class="row">

        <div class="col-12">

            <div class="card mb-0">
                <div class="card-header">
                    <h5 class="card-title">
                        Remix Icons
                    </h5>
                    <p class="card-title-desc text-muted mb-0">
                        Easily incorporate icons into your project. Use <code>&lt;i class="ri-ICONNAME"&gt;&lt;/i&gt;</code> to display any icon from the list below.
                    </p>
                </div>
                <div class="card-body">
                    <div class="row mb-5 pb-1">
                        <div class="col-md-4 justify-content-end ms-auto">
                            <div class="search-bar position-relative">
                                <input type="search" id="iconSearch" class="form-control" name="search" placeholder="Type to search">
                            </div>
                        </div>
                    </div>
                    <div class="icon-list" id="iconList"></div>
                    <div class="p-3 border border-primary bg-primary-subtle rounded mt-5">
                        <div class="row">
                            <div class="col">
                                <h5 class="text-primary mb-2 fw-medium">Remix Icons</h5>
                                <p class="text-muted mb-0 text-sm">Open-source neutral-style system symbols elaborately crafted for designers and developers.
                                    All of the icons are free for both personal and commercial use.</p>
                            </div> <!--end col-->
                            <div class="col-auto align-self-center">
                                <a href="https://remixicon.com" target="_blank" type="button" class="btn btn-primary btn-sm">View All Icons</a>
                            </div> <!--end col-->
                        </div><!--end row-->
                    </div>
                    <div class="alert alert-border-primary bg-primary-subtle fade show position-fixed mx-auto" id="copyAlert" role="alert">
                        <strong class="fw-semibold">Copied!</strong>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('js')

    <!-- Remix-icon init -->
    <script src="{{ asset('assets/js/icons/icons-remix.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

    @endsection
