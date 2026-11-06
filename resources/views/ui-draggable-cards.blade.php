@extends('partials.layouts.master2')

    @section('title', 'UI Draggable Cards | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Draggable Cards' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')  
<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
@endsection

    @section('content')


    <div class="row">

        <div class="col-12">
            <div class="card">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Draggable Cards Example</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create draggable cards using <code>Sortable.js</code> by applying it to a container with card elements. This allows users to drag and rearrange cards within the container, making the layout interactive and customizable.</p>

                    <div class="row g-4" id="sortable-container">
                        <div class="col-md-4 col-sm-12">
                            <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none" id="card001">
                                <div class="card-header d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                    <h5 class="card-title mb-0">1. Drag me!</h5>
                                    <ul class="card-actions list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-move">
                                                <i class="ri-drag-move-2-fill"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-close">
                                                <i class="ri-close-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                    <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none" id="card02">
                                <div class="card-header d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                    <h5 class="card-title mb-0">2. Drag me!</h5>
                                    <ul class="card-actions list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-move">
                                                <i class="ri-drag-move-2-fill"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-close">
                                                <i class="ri-close-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                    <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none" id="card03">
                                <div class="card-header d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                    <h5 class="card-title mb-0">3. Drag me!</h5>
                                    <ul class="card-actions list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-move">
                                                <i class="ri-drag-move-2-fill"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-close">
                                                <i class="ri-close-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                    <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none" id="card04">
                                <div class="card-header d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                    <h5 class="card-title mb-0">4. Drag me!</h5>
                                    <ul class="card-actions list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-move">
                                                <i class="ri-drag-move-2-fill"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-close">
                                                <i class="ri-close-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                    <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none" id="card05">
                                <div class="card-header d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                    <h5 class="card-title mb-0">5. Drag me!</h5>
                                    <ul class="card-actions list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-move">
                                                <i class="ri-drag-move-2-fill"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-close">
                                                <i class="ri-close-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                    <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none" id="card06">
                                <div class="card-header d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                    <h5 class="card-title mb-0">6. Drag me!</h5>
                                    <ul class="card-actions list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-move">
                                                <i class="ri-drag-move-2-fill"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#!" class="card-close">
                                                <i class="ri-close-line"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                    <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
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
                    <h5 class="card-title mb-0">Draggable over Multiple Containers Example</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Enable dragging of items across multiple containers using <code>Sortable.js</code>. Apply <code>Sortable</code> to each container and configure the <code>group</code> option to allow items to be moved between them.</p>
                    <div class="card bg-light bg-opacity-30 border border-dashed shadow-none">
                        <!--start::card-->
                        <div class="card-header">
                            <h5 class="card-title mb-0">Container A</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6 col-sm-12" id="multiple-containers01">
                                    <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none" id="card08">
                                        <div class="card-header d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                            <h5 class="card-title mb-0">A1. Drag me!</h5>
                                            <ul class="card-actions list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-move">
                                                        <i class="ri-drag-move-2-fill"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-close">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                            <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12" id="multiple-containers03">
                                    <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none" id="card09">
                                        <div class="card-header d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                            <h5 class="card-title mb-0">A2. Drag me!</h5>
                                            <ul class="card-actions list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-move">
                                                        <i class="ri-drag-move-2-fill"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-close">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                            <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::card-->
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <!--start::card-->
                            <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Container B</h5>
                                </div>
                                <div class="card-body vstack gap-4" id="multiple-containers02">
                                    <div class="card mb-0 bg-primary bg-opacity-10 border border-primary border-dashed shadow-none" id="card10">
                                        <div class="card-header border-0 border-bottom border-primary border-dashed d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                            <h5 class="card-title mb-0">B1. Drag me!</h5>
                                            <ul class="card-actions list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-move">
                                                        <i class="ri-drag-move-2-fill"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-close">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                            <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                        </div>
                                    </div>
                                    <div class="card mb-0 bg-primary bg-opacity-10 border border-primary border-dashed shadow-none" id="card11">
                                        <div class="card-header border-0 border-bottom border-primary border-dashed d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                            <h5 class="card-title mb-0">B2. Drag me!</h5>
                                            <ul class="card-actions list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-move">
                                                        <i class="ri-drag-move-2-fill"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-close">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                            <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                        </div>
                                    </div>
                                    <div class="card mb-0 bg-primary bg-opacity-10 border border-primary border-dashed shadow-none" id="card12">
                                        <div class="card-header border-0 border-bottom border-primary border-dashed d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                            <h5 class="card-title mb-0">B3. Drag me!</h5>
                                            <ul class="card-actions list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-move">
                                                        <i class="ri-drag-move-2-fill"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-close">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                            <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::card-->
                        </div>
                        <div class="col-md-6">
                            <!--start::card-->
                            <div class="card mb-0 bg-light bg-opacity-30 border border-dashed shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Container C</h5>
                                </div>
                                <div class="card-body vstack gap-4" id="multiple-containers04">
                                    <div class="card mb-0 bg-danger bg-opacity-10 border border-danger border-dashed shadow-none" id="card10">
                                        <div class="card-header border-0 border-bottom border-danger border-dashed d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                            <h5 class="card-title mb-0">C1. Drag me!</h5>
                                            <ul class="card-actions list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-move">
                                                        <i class="ri-drag-move-2-fill"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-close">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                            <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                        </div>
                                    </div>
                                    <div class="card mb-0 bg-danger bg-opacity-10 border border-danger border-dashed shadow-none" id="card11">
                                        <div class="card-header border-0 border-bottom border-danger border-dashed d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                            <h5 class="card-title mb-0">C2. Drag me!</h5>
                                            <ul class="card-actions list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-move">
                                                        <i class="ri-drag-move-2-fill"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-close">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                            <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                        </div>
                                    </div>
                                    <div class="card mb-0 bg-danger bg-opacity-10 border border-danger border-dashed shadow-none" id="card12">
                                        <div class="card-header border-0 border-bottom border-danger border-dashed d-flex align-items-center gap-3 justify-content-between flex-wrap">
                                            <h5 class="card-title mb-0">C3. Drag me!</h5>
                                            <ul class="card-actions list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-move">
                                                        <i class="ri-drag-move-2-fill"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#!" class="card-close">
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <p>This is a draggable card. It can be dragged and dropped between columns. Try moving it around!</p>
                                            <p class="mb-0">Suggestions: Add more interactive elements or dynamic content here for a better user experience.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::card-->
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

    <!-- Sortable js -->
    <script src="{{ asset('assets/libs/sortablejs/Sortable.min.js') }}"></script>

    <!-- Card init -->
    <script src="{{ asset('assets/js/pages/card.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection