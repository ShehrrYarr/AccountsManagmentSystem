@extends('partials.layouts.master2')

    @section('title', 'UI Columns | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Checkbox & Radio' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')  
<link rel="stylesheet" href="{{ asset('assets/libs/@yaireo/tagify/tagify.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/dual-listbox/dual-listbox.css') }}">
@endsection

    @section('content')

    <div class="row g-4">

        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Default Checks </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Default Checks</strong> example shows how to use the <code>.form-check-input</code> class to create standard checkbox inputs with proper spacing and alignment. 
                    </p>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="flexCheckDefault" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Default checkbox
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="flexCheckChecked" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Checked checkbox
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Disabled </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Disabled</strong> example demonstrates how to use the <code>disabled</code> attribute on form controls, preventing user interaction while maintaining a consistent style. 
                    </p>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="flexCheckDisabled" id="flexCheckDisabled" disabled>
                        <label class="form-check-label" for="flexCheckDisabled">
                            Disabled checkbox
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="flexCheckCheckedDisabled" id="flexCheckCheckedDisabled" checked disabled>
                        <label class="form-check-label" for="flexCheckCheckedDisabled">
                            Disabled checked checkbox
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Sizing </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Sizing</strong> example showcases how to adjust the size of form controls using classes like <code>.form-check-sm</code> and <code>.form-check-lg</code> for a more compact or larger appearance. 
                    </p>

                    <div class="form-check form-check-sm mb-3">
                        <input class="form-check-input" type="checkbox" value="flexCheckSmall" id="flexCheckSmall" checked>
                        <label class="form-check-label" for="flexCheckSmall">
                            Small Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-lg">
                        <input class="form-check-input" type="checkbox" value="flexCheckLarge" id="flexCheckLarge" checked>
                        <label class="form-check-label" for="flexCheckLarge">
                            Large Checkbox
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Radio Buttons </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Radio Buttons</strong> example demonstrates how to use <code>.form-check-input</code> to create selectable options where only one choice can be selected at a time. 
                    </p>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Default radio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Default checked radio
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Disabled </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Disabled</strong> example shows how to use the <code>disabled</code> attribute with <code>.form-check-input</code> to create non-selectable checkboxes or radio buttons. 
                    </p>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled>
                        <label class="form-check-label" for="flexRadioDisabled">
                            Disabled radio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" checked disabled>
                        <label class="form-check-label" for="flexRadioCheckedDisabled">
                            Disabled checked radio
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Sizing </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Sizing</strong> example demonstrates how to use <code>.form-control-sm</code> and <code>.form-control-lg</code> to create smaller or larger input fields for better UI adaptability. 
                    </p>

                    <div class="form-check form-check-sm mb-3">
                        <input class="form-check-input" type="radio" name="flexRadioSize" id="flexRadioSmall">
                        <label class="form-check-label" for="flexRadioSmall">
                            Small radio
                        </label>
                    </div>
                    <div class="form-check form-check-lg">
                        <input class="form-check-input" type="radio" name="flexRadioSize" id="flexRadioLarge">
                        <label class="form-check-label" for="flexRadioLarge">
                            Large radio
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Indeterminate </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Indeterminate</strong> example shows how to create a checkbox with an indeterminate state using JavaScript, providing a visual cue for a partially selected option. 
                    </p>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="flexCheckIndeterminate" id="flexCheckIndeterminate">
                        <label class="form-check-label" for="flexCheckIndeterminate">
                            Indeterminate checkbox
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Checkbox Color Variants </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Color Variants</strong> example demonstrates how to use the <code>.form-check-*</code> classes to apply different colors to checkboxes and radio buttons for better visual distinction. 
                    </p>

                    <div class="form-check form-check-primary mb-3">
                        <input class="form-check-input" type="checkbox" value="CustomflexCheck01" id="CustomflexCheck01" checked>
                        <label class="form-check-label" for="CustomflexCheck01">
                            Primary Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-secondary mb-3">
                        <input class="form-check-input" type="checkbox" value="CustomflexCheck02" id="CustomflexCheck02" checked>
                        <label class="form-check-label" for="CustomflexCheck02">
                            Secondary Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-success mb-3">
                        <input class="form-check-input" type="checkbox" value="CustomflexCheck03" id="CustomflexCheck03" checked>
                        <label class="form-check-label" for="CustomflexCheck03">
                            Success Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-info mb-3">
                        <input class="form-check-input" type="checkbox" value="CustomflexCheck04" id="CustomflexCheck04" checked>
                        <label class="form-check-label" for="CustomflexCheck04">
                            Info Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-warning mb-3">
                        <input class="form-check-input" type="checkbox" value="CustomflexCheck05" id="CustomflexCheck05" checked>
                        <label class="form-check-label" for="CustomflexCheck05">
                            Warning Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-danger mb-3">
                        <input class="form-check-input" type="checkbox" value="CustomflexCheck06" id="CustomflexCheck06" checked>
                        <label class="form-check-label" for="CustomflexCheck06">
                            Danger Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-dark">
                        <input class="form-check-input" type="checkbox" value="CustomflexCheck07" id="CustomflexCheck07" checked>
                        <label class="form-check-label" for="CustomflexCheck07">
                            Dark Checkbox
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Radio Color Variants </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"> 
                        The <strong class="text-body fw-medium">Color Variants</strong> example demonstrates how to use the <code>.form-check-*</code> classes to apply different colors to checkboxes and radio buttons for better visual distinction. 
                    </p>

                    <div class="form-check form-check-primary mb-3">
                        <input class="form-check-input" type="radio" value="CustomflexRadio01" id="CustomflexRadio01" checked>
                        <label class="form-check-label" for="CustomflexRadio01">
                            Primary Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-secondary mb-3">
                        <input class="form-check-input" type="radio" value="CustomflexRadio02" id="CustomflexRadio02" checked>
                        <label class="form-check-label" for="CustomflexRadio02">
                            Secondary Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-success mb-3">
                        <input class="form-check-input" type="radio" value="CustomflexRadio03" id="CustomflexRadio03" checked>
                        <label class="form-check-label" for="CustomflexRadio03">
                            Success Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-info mb-3">
                        <input class="form-check-input" type="radio" value="CustomflexRadio04" id="CustomflexRadio04" checked>
                        <label class="form-check-label" for="CustomflexRadio04">
                            Info Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-warning mb-3">
                        <input class="form-check-input" type="radio" value="CustomflexRadio05" id="CustomflexRadio05" checked>
                        <label class="form-check-label" for="CustomflexRadio05">
                            Warning Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-danger mb-3">
                        <input class="form-check-input" type="radio" value="CustomflexRadio06" id="CustomflexRadio06" checked>
                        <label class="form-check-label" for="CustomflexRadio06">
                            Danger Checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-dark">
                        <input class="form-check-input" type="radio" value="CustomflexRadio07" id="CustomflexRadio07" checked>
                        <label class="form-check-label" for="CustomflexRadio07">
                            Dark Checkbox
                        </label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Switches </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Switches</strong> example shows how to use the <code>.form-switch</code> class to create a toggle-style checkbox for a modern and interactive user experience.  
                    </p>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Switches Disabled </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Disabled Switch</strong> example demonstrates how to use the <code>.form-switch</code> and <code>disabled</code> attributes to create a non-interactive toggle switch.  
                    </p>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                        <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" checked disabled>
                        <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6 col-xl-4">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Switches Sizes </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Switch Sizes</strong> example demonstrates various switch sizes using the <code>.form-switch</code> class. Use <code>.form-check-sm</code> for a smaller switch size.  
                    </p>                    

                    <div class="form-check form-check-sm form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckSmall" checked>
                        <label class="form-check-label" for="flexSwitchCheckSmall">Small Form switch</label>
                    </div>
                    <div class="form-check form-check-lg form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedLarge" checked>
                        <label class="form-check-label" for="flexSwitchCheckCheckedLarge">Large Form Switch</label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Switches Color Variants </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Switch Color Variants</strong> example demonstrates how to apply different colors to switches using classes like <code>.form-switch-*</code> for a styled secondary switch.  
                    </p>

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch form-switch-primary mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck01" checked>
                                <label class="form-check-label" for="SwitchCheck01">Switch Primary</label>
                            </div>
                            <div class="form-check form-switch form-switch-secondary mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck02" checked>
                                <label class="form-check-label" for="SwitchCheck02">Switch Secondary</label>
                            </div>
                            <div class="form-check form-switch form-switch-success mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck03" checked>
                                <label class="form-check-label" for="SwitchCheck03">Switch Success</label>
                            </div>
                            <div class="form-check form-switch form-switch-info">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck04" checked>
                                <label class="form-check-label" for="SwitchCheck04">Switch Info</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch form-switch-warning mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck05" checked>
                                <label class="form-check-label" for="SwitchCheck05">Switch Warning</label>
                            </div>
                            <div class="form-check form-switch form-switch-danger mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck06" checked>
                                <label class="form-check-label" for="SwitchCheck06">Switch Danger</label>
                            </div>
                            <div class="form-check form-switch form-switch-dark">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck07" checked>
                                <label class="form-check-label" for="SwitchCheck07">Switch Dark</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Inline </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Inline Checkboxes & Radios</strong> example shows how to use the <code>.form-check-inline</code> class to display checkboxes or radio buttons in a single horizontal line.  
                    </p>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                <label class="form-check-label" for="inlineCheckbox2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4">
                            <div class="form-check form-switch form-check-inline" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="inlineswitch5">
                                <label class="form-check-label" for="inlineswitch5">1</label>
                            </div>
                            <div class="form-check form-switch form-check-inline" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="inlineswitch6">
                                <label class="form-check-label" for="inlineswitch6">2</label>
                            </div>
                            <div class="form-check form-switch form-check-inline" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="inlineswitchdisabled2" disabled>
                                <label class="form-check-label" for="inlineswitchdisabled2">2</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Reverse </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Reverse Checkboxes & Radios</strong> example demonstrates how to use the <code>.form-check-reverse</code> class to position the label on the left side of the checkbox or radio button.  
                    </p>

                    <div class="form-check form-check-reverse mb-3">
                        <input class="form-check-input" type="checkbox" value="reverseCheck1" id="reverseCheck1">
                        <label class="form-check-label" for="reverseCheck1">
                            Reverse checkbox
                        </label>
                    </div>
                    <div class="form-check form-check-reverse mb-3">
                        <input class="form-check-input" type="checkbox" value="reverseCheck2" id="reverseCheck2" disabled>
                        <label class="form-check-label" for="reverseCheck2">
                            Disabled reverse checkbox
                        </label>
                    </div>

                    <div class="form-check form-switch form-check-reverse">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckReverse">
                        <label class="form-check-label" for="flexSwitchCheckReverse">Reverse switch checkbox input</label>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Without labels </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Without Labels</strong> example shows how to use checkboxes and radio buttons without labels, ensuring a minimal and clean design while maintaining accessibility.  
                    </p>

                    <div>
                        <input class="form-check-input mb-3" type="checkbox" id="checkboxNoLabel" value="checkboxNoLabel" aria-label="...">
                    </div>

                    <div>
                        <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1" value="radioNoLabel1" aria-label="...">
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Checkbox toggle buttons </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Checkbox Toggle Buttons</strong> example demonstrates how to use checkboxes styled as buttons for an interactive and user-friendly selection experience.  
                    </p>

                    <div class="d-flex flex-wrap gap-2">

                        <div>
                            <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off">
                            <label class="btn btn-light-primary" for="btn-check">Single toggle</label>
                        </div>

                        <div>
                            <input type="checkbox" class="btn-check" id="btn-check-2" checked autocomplete="off">
                            <label class="btn btn-light-primary" for="btn-check-2">Checked</label>
                        </div>

                        <div>
                            <input type="checkbox" class="btn-check" id="btn-check-3" autocomplete="off" disabled>
                            <label class="btn btn-light-primary" for="btn-check-3">Disabled</label>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Radio toggle buttons </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Radio Toggle Buttons</strong> example showcases how to style radio buttons as toggle buttons, allowing users to select a single option in a visually appealing way.  
                    </p>

                    <div class="d-flex flex-wrap gap-2">

                        <div>
                            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                            <label class="btn btn-light-info" for="option1">Checked</label>
                        </div>

                        <div>
                            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                            <label class="btn btn-light-info" for="option2">Radio</label>
                        </div>

                        <div>
                            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" disabled>
                            <label class="btn btn-light-info" for="option3">Disabled</label>
                        </div>

                        <div>
                            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
                            <label class="btn btn-light-info" for="option4">Radio</label>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Checkbox With Icons </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Checkbox With Icons</strong> example uses the <code>.btn-check</code> class to create toggle-style checkboxes with icon-based buttons for a more interactive and visually appealing selection.  
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <div>
                            <input type="checkbox" class="btn-check" id="btn-check001" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btn-check001">
                                <i class="ri-instagram-line"></i> Instagram
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="btn-check" id="btn-check002" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btn-check002">
                                <i class="ri-twitter-line"></i> Twitter
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="btn-check" id="btn-check003" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btn-check003">
                                <i class="ri-facebook-line"></i> Facebook
                            </label>
                        </div>
                        <div>
                            <input type="checkbox" class="btn-check" id="btn-check004" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btn-check004">
                                <i class="ri-linkedin-box-fill"></i> LinkedIn
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Radio With Icons </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Radio With Icons</strong> example uses the <code>.btn-check</code> class to create stylish radio buttons with icons, enhancing the user experience with a more interactive selection style.  
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <div>
                            <input type="radio" name="radioIcons" class="btn-check" id="btn-check011" autocomplete="off">
                            <label class="btn btn-outline-info" for="btn-check011">
                                <i class="ri-instagram-line"></i> Instagram
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="radioIcons" class="btn-check" id="btn-check012" autocomplete="off">
                            <label class="btn btn-outline-info" for="btn-check012">
                                <i class="ri-twitter-line"></i> Twitter
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="radioIcons" class="btn-check" id="btn-check013" autocomplete="off" checked>
                            <label class="btn btn-outline-info" for="btn-check013">
                                <i class="ri-facebook-line"></i> Facebook
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="radioIcons" class="btn-check" id="btn-check014" autocomplete="off">
                            <label class="btn btn-outline-info" for="btn-check014">
                                <i class="ri-linkedin-box-fill"></i> LinkedIn
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Payment Method Group </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Radio With Payment Method Group</strong> example uses the <code>.form-check-input</code> class to create structured and accessible radio buttons with payment method icons for easy selection.  
                    </p>

                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="payment-check1" value="visa">
                            <label class="form-check-label" for="payment-check1">
                                <span class="d-flex align-items-center flex-wrap column-gap-3">
                                    <img src="{{ asset('assets/images/payment-method/method1.png') }}">" class="w-30 h-30" alt="Visa">
                                    <div>
                                        <span class="fs-6 fw-bold">Visa Card</span>
                                        <span class="d-block text-muted">Fast and secure transactions with your Visa card.</span>
                                    </div>
                                </span>
                            </label>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="payment-check2" value="mastercard">
                            <label class="form-check-label" for="payment-check2">
                                <span class="d-flex align-items-center flex-wrap column-gap-3">
                                    <img src="{{ asset('assets/images/payment-method/method2.png') }}">" class="w-30 h-30" alt="MasterCard">
                                    <div>
                                        <span class="fs-6 fw-bold">MasterCard</span>
                                        <span class="d-block text-muted">Enjoy flexibility with your MasterCard for easy payments.</span>
                                    </div>
                                </span>
                            </label>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="payment-check3" value="paypal" checked>
                            <label class="form-check-label" for="payment-check3">
                                <span class="d-flex align-items-center flex-wrap column-gap-3">
                                    <img src="{{ asset('assets/images/payment-method/method3.png') }}">" class="w-30 h-30" alt="PayPal">
                                    <div>
                                        <span class="fs-6 fw-bold">PayPal</span>
                                        <span class="d-block text-muted">Secure and convenient payments with your PayPal account.</span>
                                    </div>
                                </span>
                            </label>
                        </li>
                        <li class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="payment-check4" value="bitcoin">
                            <label class="form-check-label" for="payment-check4">
                                <span class="d-flex align-items-center flex-wrap column-gap-3">
                                    <img src="{{ asset('assets/images/payment-method/method4.png') }}">" class="w-30 h-30" alt="Bitcoin">
                                    <div>
                                        <span class="fs-6 fw-bold">Bitcoin</span>
                                        <span class="d-block text-muted">Utilize your Bitcoin wallet for secure transactions.</span>
                                    </div>
                                </span>
                            </label>
                        </li>
                    </ul>

                </div>
            </div>
            <!--end::card-->
        </div>
        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0"> Payment Method Group </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">  
                        The <strong class="text-body fw-medium">Radio With Payment Method Group</strong> example uses the <code>.form-check-input</code> class to create structured and accessible radio buttons with payment method icons for easy selection.  
                    </p>

                    <div class="main-img-checkbox">
                        <div class="row g-4">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card-wrapper overflow-hidden">
                                    <div class="img-checkbox">
                                        <input class="main-img-cover form-check-input" id="img-check-1" type="checkbox">
                                        <label class="form-check-label mb-0" for="img-check-1">
                                            <img class="h-224px" src="{{ asset('assets/images/small/img-1.jpg') }}" alt="coffee-beans">
                                        </label>
                                    </div>
                                </div>
                                <h6 class="sub-title text-center m-3 mb-0">Custom</h6>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card-wrapper overflow-hidden">
                                    <div class="img-checkbox">
                                        <input class="main-img-cover form-check-input" id="img-check-2" type="checkbox" checked>
                                        <label class="form-check-label mb-0" for="img-check-2">
                                            <img class="h-224px" src="{{ asset('assets/images/small/img-2.jpg') }}" alt="tree">
                                        </label>
                                    </div>
                                </div>
                                <h6 class="sub-title text-center m-3 mb-0">Checked Image</h6>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card-wrapper overflow-hidden">
                                    <div class="img-checkbox">
                                        <input class="main-img-cover form-check-input" id="img-check-3" type="checkbox" disabled>
                                        <label class="form-check-label mb-0" for="img-check-3">
                                            <img class="h-224px" src="{{ asset('assets/images/small/img-3.jpg') }}" alt="flowers">
                                        </label>
                                    </div>
                                </div>
                                <h6 class="sub-title text-center m-3 mb-0">Disabled Image</h6>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card-wrapper overflow-hidden">
                                    <div class="img-checkbox">
                                        <input class="main-img-cover form-check-input" id="img-check-4" type="checkbox" disabled checked>
                                        <label class="form-check-label mb-0" for="img-check-4">
                                            <img class="h-224px" src="{{ asset('assets/images/small/img-4.jpg') }}" alt="rose-tea">
                                        </label>
                                    </div>
                                </div>
                                <h6 class="sub-title text-center m-3 mb-0">Disabled Checked Image</h6>
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
    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection