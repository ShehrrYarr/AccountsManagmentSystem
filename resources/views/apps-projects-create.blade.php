@extends('partials.layouts.master3')

@section('title', 'Create Project | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
@section('sub-title', 'Add Project')
@section('pagetitle', 'Project')
@section('buttonTitle', 'View All')
@section('link', 'apps-projects-list')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/air-datepicker/air-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection
@section('content')


    <div class="card mb-0">
        <div class="card-header">
            <h5 class="mb-0 card-title">Create Project</h5>
        </div>
        <div class="card-body">
            <form class="row needs-validation" novalidate>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="validationCustom01">Project Name:</label>
                        <input class="form-control" id="validationCustom01" type="text" placeholder="Project Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="select-client">Client:</label>
                        <select id="select-client">
                            <option value="Roy Southerell">Roy Southerell</option>
                            <option value="Briny Undrell">Briny Undrell</option>
                            <option value="Kendell Longstreeth">Kendell Longstreeth</option>
                            <option value="Dorris Grigoriev">Dorris Grigoriev</option>
                            <option value="Zeb Kenningham">Zeb Kenningham</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="project-start-date">Start Date:</label>
                        <input type="text" class="form-control" id="project-start-date"
                            placeholder="Select project start date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="project-end-date">End Date:</label>
                        <input type="text" class="form-control" id="project-end-date"
                            placeholder="Select project end date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="project-priority">Priority:</label>
                        <select id="project-priority">
                            <option value="High">High</option>
                            <option value="Low">Low</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="project-team-leader">Team Leader:</label>
                        <select id="project-team-leader">
                            <option value="john_doe">John Doe</option>
                            <option value="jane_smith">Jane Smith</option>
                            <option value="michael_jones">Michael Jones</option>
                            <option value="susan_lee">Susan Lee</option>
                            <option value="david_williams">David Williams</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="project-team-member">Team Members:</label>
                        <input class="form-control" id="project-team-member" placeholder="Select team members"
                            type="text" data-name="team-members">
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label">Project description <span
                                class="text-muted fs-12">(Optional)</span></label>
                        <div id="createBlogEditor">
                            <p>It will be as simple as occidental in fact, it will be Occidental. To an English person, it
                                will seem like simplified English, as a skeptical Cambridge friend of mine told me what
                                Occidental is. The European languages are members of the same family. Their separate
                                existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary.</p>
                            <ul>
                                <li>Product Design, Figma (Software), Prototype</li>
                                <li>Four Dashboards : Ecommerce, Analytics, Project etc.</li>
                                <li>Create calendar, chat and email app pages.</li>
                                <li>Add authentication pages</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="project-terms">Terms:</label>
                        <select id="project-terms">
                            <option value="Fixed">Fixed</option>
                            <option value="Per hour">Per hour</option>
                            <option value="Per day">Per day</option>
                            <option value="Per week">Per week</option>
                            <option value="Per month">Per month</option>
                            <option value="Per quarter">Per quarter</option>
                            <option value="Per year">Per year</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="expected-value">Expected value:</label>
                        <input type="number" name="expected-value" id="expected-value" class="form-control"
                            placeholder="Enter value here">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="project-milestone" class="form-label">
                            Milestone
                            <a class="small ms-1" href="javascript:;">Change probability</a>
                        </label>
                        <select id="project-milestone">
                            <option value="New">New</option>
                            <option value="Qualified">Qualified</option>
                            <option value="Meeting">Meeting</option>
                            <option value="Proposal">Proposal</option>
                            <option value="Negotiation">Negotiation</option>
                            <option value="Contact">Contact</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-primary" type="submit">Create Project</button>
                    <input class="btn btn-light" type="reset" value="Cancel">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

    <!-- Tagify js -->
    <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

    <!-- Air Datepicker js -->
    <script src="{{ asset('assets/libs/air-datepicker/air-datepicker.js') }}"></script>

    <!-- Dropzone js -->
    <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>

    <!-- Editor js -->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Create Products js -->
    <script src="{{ asset('assets/js/apps/ecommerce/apps-projects-create.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection
