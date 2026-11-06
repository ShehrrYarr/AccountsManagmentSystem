@extends('partials.layouts.master2')


    @section('title', 'Calendar | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Calendar')
    @section('pagetitle', 'Apps')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    @endsection
    @section('content')

        <div class="row">

            <div class="col-12 col-lg-4 col-xl-3">
                <div class="card h-100 m-0">
                    <div class="card-header p-5">
                        <button id="addEventBtn"
                            class="btn btn-primary w-100 d-flex align-items-center gap-2 justify-content-center">
                            <i class="ri-add-line fs-16 lh-1"></i> Add Event
                        </button>
                    </div>
                    <div class="card-body p-5">
                        <div class="hstack full-picker">
                            <input type="text" class="form-control d-none" id="inline-date-picker"
                                placeholder="Select a date">
                        </div>
                        <div class="mt-5 pt-3">
                            <h5 class="text-uppercase">Filter</h5>
                            <ul class="list-unstyled d-flex flex-column gap-2 mb-0 px-0">
                                <li class="form-check form-check-sm form-check-primary d-flex align-items-center gap-2">
                                    <input class="labelFilter form-check-input" type="checkbox" value="Business"
                                        id="business-check" checked>
                                    <label class="form-check-label mb-0 text-muted fw-normal"
                                        for="business-check">Business</label>
                                </li>
                                <li class="form-check form-check-sm form-check-success d-flex align-items-center gap-2">
                                    <input class="labelFilter form-check-input" type="checkbox" value="Personal"
                                        id="personal-check" checked>
                                    <label class="form-check-label mb-0 text-muted fw-normal"
                                        for="personal-check">Personal</label>
                                </li>
                                <li class="form-check form-check-sm form-check-info d-flex align-items-center gap-2">
                                    <input class="labelFilter form-check-input" type="checkbox" value="Family"
                                        id="family-check" checked>
                                    <label class="form-check-label mb-0 text-muted fw-normal"
                                        for="family-check">Family</label>
                                </li>
                                <li class="form-check form-check-sm form-check-warning d-flex align-items-center gap-2">
                                    <input class="labelFilter form-check-input" type="checkbox" value="Holiday"
                                        id="holiday-check" checked>
                                    <label class="form-check-label mb-0 text-muted fw-normal"
                                        for="holiday-check">Holiday</label>
                                </li>
                                <li class="form-check form-check-sm form-check-danger d-flex align-items-center gap-2">
                                    <input class="labelFilter form-check-input" type="checkbox" value="ETC"
                                        id="etc-check" checked>
                                    <label class="form-check-label mb-0 text-muted fw-normal" for="etc-check">ETC</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xl-9">
                <div class="card m-0 card-body calendar-wrapper">
                    <div id='calendar'></div>
                </div>
            </div>

        </div>

        <!-- Add/Edit Event Modal -->
        <div class="modal" id="eventModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add/Edit Event</h5>
                        <button type="button" class="close btn btn-text-primary icon-btn-sm" id="closeModalBtn"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="ri-close-large-line fw-semibold"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="eventForm">
                            <div class="mb-3">
                                <label for="eventName" class="form-label">Event Name</label>
                                <input type="text" id="eventName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="text" id="startDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="text" id="endDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="eventLabel" class="form-label">Label</label>
                                <select id="eventLabel" class="form-select" required>
                                    <option value="Business">Business</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Family">Family</option>
                                    <option value="Holiday">Holiday</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="eventDescription" class="form-label">Description</label>
                                <textarea id="eventDescription" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Event</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Details Modal -->
        <div class="modal" id="eventDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event Details</h5>
                        <button type="button" class="close btn btn-text-primary icon-btn-sm" id="closeDetailsModalBtn"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="ri-close-large-line fw-semibold"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> <span id="eventDetailsName"></span></p>
                        <p><strong>Description:</strong> <span id="eventDetailsDescription"></span></p>
                        <p><strong>Start:</strong> <span id="eventDetailsStart"></span></p>
                        <p><strong>End:</strong> <span id="eventDetailsEnd"></span></p>
                        <p><strong>Label:</strong> <span id="eventDetailsLabel"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" id="editEventBtn">Edit Event</button>
                        <button class="btn btn-danger" id="deleteEventBtn">Delete Event</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div id="modalOverlay" class="modal-backdrop fade show mt-0"></div>
    @endsection

    @section('js')

        <!-- Air Datepicker js -->
        <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

        <!-- Full Calender js -->
        <script src="{{ asset('assets/libs/fullcalendar/index.global.min.js') }}"></script>

        <!-- Calendar init -->
        <script src="{{ asset('assets/js/apps/apps-calendar.init.js') }}"></script>

        <!-- App js -->
        <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @endsection
