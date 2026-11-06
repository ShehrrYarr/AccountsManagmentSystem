@extends('partials.layouts.master2')

    @section('title', 'UI Columns | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Inputs Select' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/nouislider/nouislider.min.css') }}">
    @endsection
    
    @section('content')

    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Default Select </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Default Select</strong> example demonstrates how to use the <code>.form-select</code> class to create a styled dropdown for selecting options easily.
                    </p>

                    <select class="form-select mb-4" id="form-select-01" name="form-select-01" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <select class="form-select" id="form-select-02" name="form-select-02" aria-label="Disabled select example" disabled>
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Sizing </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Sizing</strong> example shows how to adjust the size of a select dropdown using Bootstrap's <code>.form-select-lg</code> and <code>.form-select-sm</code> classes for better UI adaptability.
                    </p>

                    <select class="form-select form-select-lg mb-4" id="form-select-03" name="form-select-03" aria-label="Large select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>

                    <select class="form-select form-select-sm" id="form-select-04" name="form-select-04" aria-label="Small select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Single Select </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Single Select</strong> example uses Choice.js to create a searchable dropdown. You can configure it using options like <code>searchEnabled</code>, <code>placeholderValue</code>, and <code>removeItemButton</code>.
                    </p>

                    <select class="form-select" id="default-choice">
                        <option value="Select a language">Select a language</option>
                        <option value="javascript">JavaScript</option>
                        <option value="python">Python</option>
                        <option value="java">Java</option>
                        <option value="csharp">C#</option>
                        <option value="ruby">Ruby</option>
                    </select>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Option Groups </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Option Groups</strong> example organizes related options within a <code>select</code> dropdown using the <code>&lt;optgroup&gt;</code> tag, improving readability and user experience.
                    </p>

                    <select class="form-control" name="choices-groups" id="choices-groups">
                        <optgroup label="Agile">
                            <option value="jira">Jira</option>
                            <option value="trello">Trello</option>
                        </optgroup>
                        <optgroup label="Waterfall">
                            <option value="ms_project">Microsoft Project</option>
                        </optgroup>
                        <optgroup label="Hybrid" disabled>
                            <option value="asana">Asana</option>
                            <option value="clickup">ClickUp</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Default Multiple Select </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Default Multiple Select</strong> example demonstrates how to use the <code>.form-select</code> class with the <code>multiple</code> attribute to allow users to select multiple options from a dropdown.
                    </p>

                    <select id="choices-default-multiple" multiple>
                        <option value="Select frameworks">Select frameworks</option>
                        <option value="react">React</option>
                        <option value="vue">Vue.js</option>
                        <option value="angular">Angular</option>
                        <option value="svelte">Svelte</option>
                        <option value="ember">Ember.js</option>
                    </select>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Multiple Select With Close Icon </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Multiple Select With Close Icon</strong> lets users select multiple options and remove them easily with a close icon. Use <code>removeItemButton = "true"</code> to enable this feature.
                    </p>

                    <select id="choices-multiple-close-icon" multiple>
                        <option value="Select databases">Select databases</option>
                        <option value="mysql">MySQL</option>
                        <option value="postgresql">PostgreSQL</option>
                        <option value="mongodb">MongoDB</option>
                        <option value="sqlite">SQLite</option>
                        <option value="oracle">Oracle</option>
                    </select>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Multiple Select With Limit </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Multiple Select With Limit</strong> allows users to select multiple options up to a set limit. Use <code>maxItemCount</code> to define the selection limit.
                    </p>

                    <select id="choices-multiple-limit" multiple>
                        <option value="Select cloud platforms">Select cloud platforms</option>
                        <option value="aws">AWS</option>
                        <option value="azure">Microsoft Azure</option>
                        <option value="gcp">Google Cloud Platform</option>
                        <option value="digitalocean">DigitalOcean</option>
                        <option value="heroku">Heroku</option>
                    </select>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Multiple Select With Option Groups </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Multiple Select With Option Groups</strong> organizes choices into categories, making selection easier. Groups help users find related options quickly.
                    </p>

                    <select id="choices-multiple-option-group" multiple>
                        <optgroup label="Agile">
                            <option value="scrum">Scrum</option>
                            <option value="kanban">Kanban</option>
                        </optgroup>
                        <optgroup label="Waterfall">
                            <option value="classic">Classic Waterfall</option>
                        </optgroup>
                        <optgroup label="DevOps">
                            <option value="devops">DevOps</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Text Inputs </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Text Inputs</strong> allow users to enter and edit text in a form using the <code>.form-control</code> class for a clean and responsive design.
                    </p>

                    <input type="text" value="VSCode, Git, Docker" name="choices-text-inputs" id="choices-text-inputs">
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Unique Values Only, No Pasting </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Users can enter only unique values and prevents pasting. Configure it using options like <code>duplicateItemsAllowed: false</code> and <code>paste: false</code>.
                    </p>

                    <input type="text" value="JavaScript, Python" name="choices-unique-text-inputs" id="choices-unique-text-inputs">
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Email Address Only </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Email Address Only</strong> example ensures users enter a valid email format.
                        Use <code>pattern</code> to validate input.
                    </p>

                    <input type="text" value="example@gmail.com" name="choices-text-email-filter" id="choices-text-email-filter" multiple>
                </div>
            </div>
            <!--end::card-->
        </div>

    </div>
@endsection

@section('js')
    <!-- Forms-select init -->
    <script src="{{ asset('assets/js/form/forms-select.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection