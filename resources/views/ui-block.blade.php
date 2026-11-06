@extends('partials.layouts.master2')

    @section('title', 'UI Draggable Cards | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Block' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  
@section('css')
<link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection

    @section('content')
    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0" data-blockui-element="block-1">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Basic Example</h5>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#!" class="card-collapsible" data-bs-toggle="collapse" data-bs-target="#cardContent201">
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-blockui-button>
                                <i class="ri-refresh-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-expand-button>
                                <i class="ri-fullscreen-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-close-button>
                                <i class="ri-close-line"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body collapse show" id="cardContent201">
                    <p class="mb-3">
                        The <code>initializeBlockUI</code> function initializes the BlockUI component for the element with the attribute
                        <code>data-blockui-element="block-1"</code>.
                    </p>
                    <p class="m-0">
                        It displays a loading overlay with a
                        red spinner, indicated by <code>&lt;span class="spinner-border text-danger"&gt;&lt;/span&gt;</code>, while blocking user interaction. This overlay effectively signals that a process is currently in progress.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0" data-blockui-element="block-2">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Custom Message</h5>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#!" class="card-collapsible" data-bs-toggle="collapse" data-bs-target="#cardContent202">
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-blockui-button>
                                <i class="ri-refresh-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-expand-button>
                                <i class="ri-fullscreen-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-close-button>
                                <i class="ri-close-line"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body collapse show" id="cardContent202">
                    <p class="mb-3">
                        The <code>initializeBlockUI</code> function initializes the BlockUI component for the element with the attribute
                        <code>data-blockui-element="block-2"</code>.
                    </p>
                    <p class="m-0">
                        It displays a loading overlay with a blue spinner, indicated by
                        <code>&lt;span class="spinner-border text-primary"&gt;&lt;/span&gt;</code>, along with the message "Loading...". This overlay effectively blocks user interaction, signaling that a process is currently in progress.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0" data-blockui-element="block-3">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Overlay Class</h5>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#!" class="card-collapsible" data-bs-toggle="collapse" data-bs-target="#cardContent203">
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-blockui-button>
                                <i class="ri-refresh-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-expand-button>
                                <i class="ri-fullscreen-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-close-button>
                                <i class="ri-close-line"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body collapse show" id="cardContent203">
                    <p class="mb-3">
                        The <code>initializeBlockUI</code> function initializes the BlockUI component for the element with the attribute
                        <code>data-blockui-element="block-3"</code>.
                    </p>
                    <p class="m-0">
                        It displays a loading overlay featuring a blue spinner, represented by
                        <code>&lt;span class="spinner-border text-primary"&gt;&lt;/span&gt;</code>, and applies a custom overlay class for styling, specified as <code>custom-overlay fw-semibold</code>. This overlay blocks user interaction, effectively signaling that a process is currently in progress.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0" data-blockui-element="block-4">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Loader style 1</h5>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#!" class="card-collapsible" data-bs-toggle="collapse" data-bs-target="#cardContent204">
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-blockui-button>
                                <i class="ri-refresh-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-expand-button>
                                <i class="ri-fullscreen-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-close-button>
                                <i class="ri-close-line"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body collapse show" id="cardContent204">
                    <p class="mb-3">
                        The <code>initializeBlockUI</code> function initializes the BlockUI component for the element with the attribute
                        <code>data-blockui-element="block-4"</code>.
                    </p>
                    <p class="m-0">
                        It displays a loading overlay featuring a primary-colored button loader, represented by
                        <code>&lt;span class="btn-loader text-primary"&gt;&lt;i class="ri-loader-2-fill fs-20"&gt;&lt;/i&gt;&lt;/span&gt;</code>. This overlay blocks user interaction, effectively indicating that a process is currently in progress.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0" data-blockui-element="block-5">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Loader style 2</h5>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#!" class="card-collapsible" data-bs-toggle="collapse" data-bs-target="#cardContent205">
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-blockui-button>
                                <i class="ri-refresh-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-expand-button>
                                <i class="ri-fullscreen-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-close-button>
                                <i class="ri-close-line"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body collapse show" id="cardContent205">
                    <p class="mb-3">
                        The <code>initializeBlockUI</code> function initializes the BlockUI component for the element with the attribute
                        <code>data-blockui-element="block-5"</code>.
                    </p>
                    <p class="m-0">
                        It displays a loading overlay featuring a primary-colored button loader, represented by
                        <code>&lt;span class="btn-loader text-primary"&gt;&lt;i class="ri-refresh-line fs-20"&gt;&lt;/i&gt;&lt;/span&gt;</code>. This overlay blocks user interaction, effectively signaling that a refreshing process is currently in progress.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0" data-blockui-element="block-6">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Loader style 3</h5>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#!" class="card-collapsible" data-bs-toggle="collapse" data-bs-target="#cardContent206">
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-blockui-button>
                                <i class="ri-refresh-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-expand-button>
                                <i class="ri-fullscreen-line"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!" data-close-button>
                                <i class="ri-close-line"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body collapse show" id="cardContent206">
                    <p class="mb-3">
                        The <code>initializeBlockUI</code> function initializes the BlockUI component for the element with the attribute
                        <code>data-blockui-element="block-6"</code>.
                    </p>
                    <p class="m-0">
                        It displays a loading overlay featuring a primary-colored spinner, represented by
                        <code>&lt;span class="spinner-grow text-primary"&gt;&lt;/span&gt;</code>. This overlay blocks user interaction, effectively indicating that a process is currently in progress.
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <!-- Block-ui init -->
    <script src="{{ asset('assets/js/pages/block-ui.init.js') }}"></script>
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection