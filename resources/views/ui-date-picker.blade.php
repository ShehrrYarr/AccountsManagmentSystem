@extends('partials.layouts.master2')

    @section('title', 'UI Columns | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Date Picker' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')  
<link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
@endsection

    @section('content')
  

    <div class="row g-4">

        <!-- Inside Modal -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Date Picker in Modal</h5>
                </div>
                <div class="card-body">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-muted mb-4">Create a basic date picker by initializing Air Datepicker with <code>new AirDatepicker("#basic-picker")</code> to allow users to select a single date from a calendar.</p>
                                    <input type="text" class="form-control" id="modal-date-picker" placeholder="Select a date">
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
        </div>

        <!-- Basic Date Picker -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Date Picker</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a basic date picker by initializing Air Datepicker with <code>new AirDatepicker("#basic-picker")</code> to allow users to select a single date from a calendar.</p>
                    <input type="text" class="form-control" id="basic-date-picker" placeholder="Select a date">
                </div>
            </div>
        </div>

        <!-- Select date on initialization -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Select Date on Initialization</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Select a predefined date using the <code>data-select-date</code> attribute.</p>
                    <input type="text" class="form-control" id="select-date-picker" placeholder="Selected date will appear">
                </div>
            </div>
        </div>

        <!-- Month selection -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Select Month</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Choose a month from the calendar using <code>view: 'months'</code> and <code>minView: 'months'</code>.</p>
                    <input type="text" class="form-control" id="month-picker" placeholder="Select a month">
                </div>
            </div>
        </div>

        <!-- Mobile devices mode -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Mobile & Auto Close Date Picker</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Enable mobile view and automatically close the date picker after selection using <code>isMobile: true</code> and <code>autoClose: true</code>.</p>
                    <input type="text" class="form-control" id="mobile-auto-close-picker" data-provider="air-datepicker" data-date-format="dd-mm-yyyy" data-is-mobile="true" data-auto-close="true" placeholder="Select a date">
                </div>
            </div>
        </div>

        <!-- Positioning -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Position Date Picker</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Position the date picker using <code>position: 'right center'</code>.</p>
                    <input type="text" class="form-control" id="position-picker" data-provider="air-datepicker" data-date-format="dd-mm-yyyy" data-position="left center" placeholder="Select a date">
                </div>
            </div>
        </div>

        <!-- Date Range Picker -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Date Range Picker</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Allow users to select a range of dates with Air Datepicker by initializing <code>new AirDatepicker("#range-picker")</code> with the <code>data-range-date</code> attribute.</p>
                    <input type="text" class="form-control" id="range-picker" placeholder="Select a date range">
                </div>
            </div>
        </div>

        <!-- Timepicker Picker -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Timepicker Picker</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Allow users to select a range of dates with Air Datepicker by initializing <code>new AirDatepicker("#range-picker")</code> with the <code>data-range-date</code> attribute.</p>
                    <input type="text" class="form-control" id="timepicker-picker" placeholder="Select a date range">
                </div>
            </div>
        </div>

        <!-- Time format -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Time format</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Allow users to select a range of dates with Air Datepicker by initializing <code>new AirDatepicker("#range-picker")</code> with the <code>data-range-date</code> attribute.</p>
                    <input type="text" class="form-control" id="time-format" placeholder="Select a date range">
                </div>
            </div>
        </div>

        <!-- Inline Date Picker -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Inline Date Picker</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Display the calendar inline using Air Datepicker by initializing <code>new AirDatepicker("#inline-picker")</code> with <code>data-inline-date</code>.</p>
                    <div class="full-picker">
                        <input type="text" class="form-control" id="inline-date-picker" placeholder="Inline date picker">
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- Air Datepicker init -->
    <script src="{{ asset('assets/js/plugins/air-datepicker.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
