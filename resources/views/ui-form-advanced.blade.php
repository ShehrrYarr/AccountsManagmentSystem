@extends('partials.layouts.master2')

    @section('title', 'Form Wizards | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Form Advanced' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')  
<link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/dual-listbox/dual-listbox.css') }}">
@endsection

    @section('content')

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Tagify</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Basic Tagify</strong> example shows how to use Tagify to add and manage tags in an input field. You can configure it with options like <code>maxTags</code>, <code>placeholder</code>, and <code>delimiters</code>.
                    </p>
                    <label class="form-label">Default input style</label>
                    <input class="form-control" id='basic-tagify' value='tag1, tag2' autofocus>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tagify With Read Only</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Tagify With Read Only</strong> example shows how to display tags in a read-only mode, where users can't add or remove tags. This can be configured by setting the <code>readonly</code> option to <code>true</code>.
                    </p>
                    <label class="form-label">Default input style</label>
                    <input class="form-control" id='readonly-mix' placeholder='Type something' value='[
                                    {
                                        "value": "foo",
                                        "readonly": true,
                                        "title": "read-only tag"
                                    },
                                    {
                                        "value": "bar"
                                    },
                                    {
                                        "value": "Locked tag",
                                        "readonly": true,
                                        "title": "Another readonly tag"
                                    }
                                ]' />
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tagify With Item Limits</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Tagify With Item Limits</strong> example shows how to restrict the number of tags a user can add. You can configure the maximum limit using the <code>maxTags</code> option.
                    </p>
                    <label for="custom-dropdown" class="form-label">Default input style</label>
                    <input id="custom-dropdown" class='form-control' placeholder='Type an English letter' value='css, html, javascript'>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tagify With Single Select</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Tagify With Single Select</strong> example allows the user to select only one tag from the list. It is configured using the <code>maxTags: 1</code> option to enforce single selection.
                    </p>
                    <label class="form-label">Default input style</label>
                    <input class="form-control" name='tags-select-mode' placeholder="Please select">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tagify With mix</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Tagify With Mix</strong> example allows a combination of both single and multi-select tags. This lets users add a mix of single tags and multiple tags within the same input field.
                    </p>
                    <label class="form-label">Default input style</label>
                    <textarea class="form-control" name='mix'>[[{"id":101, "value":"cartman", "title":"Eric Cartman"}]] and [[kyle]] do not know [[{"value":"homer simpson", "readonly":true}]] because he's a relic.</textarea>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">users-list</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Users List</strong> example displays a list of users with their names, roles, and other information. It can be customized to show different user data or allow interactions like searching or filtering.
                    </p>
                    <label class="form-label">Default input style</label>
                    <input data-name="team-members" class='form-control' value='emma smith'>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">users-list</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">The Tagify field is placed inside a container with <code>dir="rtl"</code>, ensuring right-to-left text direction. The Tagify dropdown is also configured for RTL display for proper alignment.</p>
                    <label class="form-label">Default input style</label>
                    <div dir='rtl'>
                        <input name='rtl-example' class='form-control tagify--rtl-exmaple' placeholder='לחץ בשדה והוסף ערך'>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Select by class</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">The <strong class="text-body fw-medium">Dual Listbox</strong> package creates a user-friendly dual-selection interface.
                        It allows moving items between two lists with buttons like <code>Add</code>, <code>Remove</code>, and <code>Add All</code>.
                        Use config options to customize button labels and functionality.</p>

                    <select id="defaultDualList" multiple>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option>
                        <option value="6">Six</option>
                        <option value="7">Seven</option>
                        <option value="8">Eight</option>
                        <option value="9">Nine</option>
                        <option value="10">Ten</option>
                    </select>

                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Add options and add eventListeners </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">The <strong class="text-body fw-medium">Dual Listbox</strong> package provides an easy way to move items between two lists.
                        You can customize titles, button labels, and add a search feature using options like
                        <code>availableTitle</code>, <code>selectedTitle</code>, <code>searchPlaceholder</code>, and more.
                    </p>

                    <select id="defaultEventListeners" multiple>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option>
                        <option value="6">Six</option>
                        <option value="7">Seven</option>
                        <option value="8">Eight</option>
                        <option value="9">Nine</option>
                        <option value="10">Ten</option>
                    </select>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Toggle Password</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Enable password visibility toggle by adding a button with <code>.toggle-password</code>. Use the <code>data-visible="true"</code> attribute on the input field to show the password by default. Clicking the button switches the input type between <code>password</code> and <code>text</code>, allowing users to view or hide their password.</p>

                    <label class="form-label" for="currentPassword">Current Password</label>
                    <div class="input-group mb-3">
                        <input type="password" id="currentPassword" class="form-control" value="123456" name="password" placeholder="8+ characters required" required minlength="8" data-visible="false">
                        <a class="input-group-text toggle-password" href="javascript:;" data-target="password">
                            <i class="ri-eye-off-line text-muted toggle-icon"></i>
                        </a>
                    </div>

                    <label class="form-label" for="newPassword001">New password</label>
                    <div class="input-group">
                        <input type="password" id="newPassword001" class="form-control" value="123456" name="password" placeholder="8+ characters required" required minlength="8" data-visible="false">
                        <a class="input-group-text toggle-password" href="javascript:;" data-target="password">
                            <i class="ri-eye-off-line text-muted toggle-icon"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Show Password</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Enable password visibility toggle by adding a button with <code>.toggle-password</code>. Use the <code>data-visible="true"</code> attribute on the input field to show the password by default.</p>

                    <label class="form-label" for="newPassword">Password</label>
                    <div class="input-group">
                        <input type="password" id="newPassword" class="form-control" value="TH6R95E9LsdT" name="password" placeholder="8+ characters required" required minlength="8" data-visible="true">
                        <a class="input-group-text toggle-password" href="javascript:;" data-target="password">
                            <i class="ri-eye-off-line text-muted toggle-icon"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Clipboard on Change Icon</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Click the <code>Copy</code> button to copy the text inside the input field. After copying, the icon changes to a checkmark (<i class="ri-check-double-line"></i>) and resets after a few seconds. Uses <code>navigator.clipboard</code> for seamless copying.</p>

                    <div class="input-group clipboard-container" data-clipboard-target="clipboardInput">
                        <input type="text" class="form-control clipboard-input" value="This is a sample static text string to copy!" placeholder="Copy to clipboard">
                        <span class="input-group-text clipboard-button" role="button" id="basic-addon2" data-clipboard-action="copy" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Copy to clipboard!">
                            <i class="ri-file-copy-line me-1 clipboard-icon"></i> Copy
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Clipboard on Text Input</h5>
                </div>
                <div class="card-body">
                    <div class="clipboard-container d-flex flex-column justify-content-between h-full" data-clipboard-target="clipboardInput">
                        <div>
                            <p class="text-muted mb-4">Easily cut or copy text from the input field using the <code>Copy</code> and <code>Cut</code> buttons. The <code>Copy</code> button duplicates the text, while the <code>Cut</code> button removes it after copying. Uses <code>navigator.clipboard</code> for seamless functionality.</p>
                            <label class="form-label" for="newPassword0011">Cut/copy from text input</label>
                            <input class="form-control clipboard-input" form="newPassword0011" type="text" placeholder="type some text to copy / cut">
                        </div>
                        <div class="mt-3 text-end">
                            <button class="btn btn-primary clipboard-button" data-clipboard-action="copy" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Copy to clipboard!">
                                <i class="ri-file-copy-line"></i> Copy
                            </button>
                            <button class="btn btn-secondary clipboard-button" data-clipboard-action="cut" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Cut to clipboard!">
                                <i class="ri-scissors-line"></i> Cut
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Cut/copy from textarea</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Use the <code>Copy</code> button to duplicate text and the <code>Cut</code> button to remove and copy text from the textarea. Works smoothly with <code>navigator.clipboard</code>.</p>

                    <div class="clipboard-container" data-clipboard-target="clipboardInput">
                        <label class="form-label">Cut/copy from text input</label>
                        <textarea class="form-control fs-14 clipboard-input" rows="3" spellcheck="false">A web designer must always enhance their work since creating websites is a creative effort. Therefore, a web designer must be more imaginative to produce exceptional results. Blogs about web design assist web designers in learning about new technologies, offer lessons, news, direction for a freebie, and much more. These blogs allow web designers to stay creative and improve their abilities. Therefore, advice from web design blogs is required to improve your business.</textarea>
                        <div class="mt-3 text-end">
                            <button class="btn btn-primary clipboard-button" data-clipboard-action="copy" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Copy to clipboard!">
                                <i class="ri-file-copy-line"></i> Copy
                            </button>
                            <button class="btn btn-secondary clipboard-button" data-clipboard-action="cut" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-white" data-bs-placement="top" data-bs-title="Cut to clipboard!">
                                <i class="ri-scissors-line"></i> Cut
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Touchspin</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Create a number input with increment and decrement buttons using <code>.qty-input</code>. Each button uses <code>data-action="plus"</code> or <code>data-action="minus"</code> to increase or decrease the value within the defined <code>min</code> and <code>max</code> limits. Clicking the buttons updates the input field dynamically.</p>

                    <div class="row g-5">
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="default-touchspin">Default Touchspin</label>
                            <div class="qty-input">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="primary-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="primary-touchspin-01">Primary Touchspin</label>
                            <div class="qty-input qty-input-primary">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="primary-touchspin-01" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="secondary-touchspin">Secondary Touchspin</label>
                            <div class="qty-input qty-input-secondary">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="secondary-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="success-touchspin">Success Touchspin</label>
                            <div class="qty-input qty-input-success">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="success-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="info-touchspin">Info Touchspin</label>
                            <div class="qty-input qty-input-info">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="info-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="warning-touchspin">Warning Touchspin</label>
                            <div class="qty-input qty-input-warning">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="warning-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="danger-touchspin">Danger Touchspin</label>
                            <div class="qty-input qty-input-danger">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="danger-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="dark-touchspin">Dark Touchspin</label>
                            <div class="qty-input qty-input-dark">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="dark-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Outlined Touchspin</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Use <code>.qty-input-outline</code> to create an outlined number input spinner. Click the plus or minus buttons to increase or decrease the value within the set range.</p>

                    <div class="row g-5">
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="default-touchspin-1">Default Touchspin</label>
                            <div class="qty-input qty-input-outline">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="default-touchspin-1" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="primary-touchspin-2">Primary Touchspin</label>
                            <div class="qty-input qty-input-primary qty-input-outline">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="primary-touchspin-2" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="secondary-touchspin-3">Secondary Touchspin</label>
                            <div class="qty-input qty-input-secondary qty-input-outline">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="secondary-touchspin-3" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="success-touchspin-4">Success Touchspin</label>
                            <div class="qty-input qty-input-success qty-input-outline">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="success-touchspin-4" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="info-touchspin-5">Info Touchspin</label>
                            <div class="qty-input qty-input-info qty-input-outline">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="info-touchspin-5" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="warning-touchspin-6">Warning Touchspin</label>
                            <div class="qty-input qty-input-warning qty-input-outline">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="warning-touchspin-6" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="danger-touchspin-7">Danger Touchspin</label>
                            <div class="qty-input qty-input-danger qty-input-outline">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="danger-touchspin-7" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="dark-touchspin-8">Dark Touchspin</label>
                            <div class="qty-input qty-input-dark qty-input-outline">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="dark-touchspin-8" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Rounded Touchspin</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Use <code>.qty-input-rounded</code> to create a rounded number input spinner. Click the plus or minus buttons to adjust the value within the allowed range.</p>

                    <div class="row g-5">
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="rounded-default-touchspin">Default Touchspin</label>
                            <div class="qty-input qty-input-rounded">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="rounded-default-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="rounded-primary-touchspin">Primary Touchspin</label>
                            <div class="qty-input qty-input-primary qty-input-rounded">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="rounded-primary-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="rounded-secondary-touchspin">Secondary Touchspin</label>
                            <div class="qty-input qty-input-secondary qty-input-rounded">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input rdRounded-="secondary-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="rounded-success-touchspin">Success Touchspin</label>
                            <div class="qty-input qty-input-success qty-input-rounded">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="rounded-success-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="rounded-info-touchspin">Info Touchspin</label>
                            <div class="qty-input qty-input-info qty-input-rounded">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="rnfoRounded--touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="rounded-warning-touchspin">Warning Touchspin</label>
                            <div class="qty-input qty-input-warning qty-input-rounded">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="rounded-warning-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="rounded-danger-touchspin">Danger Touchspin</label>
                            <div class="qty-input qty-input-danger qty-input-rounded">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="rounded-danger-touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <label class="form-label fw-medium" for="rounded-dark-touchspin">Dark Touchspin</label>
                            <div class="qty-input qty-input-dark qty-input-rounded">
                                <button type="button" data-action="minus">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <input id="rarkRounded--touchspin" type="number" value="2" min="0" max="100">
                                <button type="button" data-action="plus">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Tagify js -->
    <script src="{{ asset('assets/libs/@yaireo/tagify/tagify.js') }}"></script>

    <!-- dual-listbox js -->
    <script src="{{ asset('assets/libs/dual-listbox/dual-listbox.js') }}"></script>

    <!-- Advanced-form js -->
    <script src="{{ asset('assets/js/form/advanced-form.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
