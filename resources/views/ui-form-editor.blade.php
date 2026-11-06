@extends('partials.layouts.master2')

    @section('title', 'Form Editor | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Checkbox & Radio' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
    
@section('css')  
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.bubble.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/quill/quill.snow.css') }}">
@endsection

    @section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Editor</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Default Editor</strong> example demonstrates the use of Quill, a rich text editor, with the <code>snow</code> theme configuration. It provides a clean and user-friendly interface with basic text formatting options like bold, italic, and bullet points.
                    </p>

                    <div id="snowEditor">
                        <p>Hello World!</p>
                        <p>Some initial <strong>bold</strong> text</p>
                        <p><br></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Bubble Editor</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        The <strong class="text-body fw-medium">Bubble Editor</strong> example demonstrates the use of Quill, a rich text editor, with the <code>bubble</code> theme configuration. This theme provides a more compact and minimalistic interface for text formatting options, appearing as a floating toolbar over the content area.
                    </p>

                    <div id="bubbleEditor">
                        <p>Hello World!</p>
                        <p>Some initial <strong>bold</strong> text</p>
                        <p><br></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Quill js -->
    <script src="{{ asset('assets/libs/quill/quill.js') }}"></script>

    <!-- Form-editor init -->
    <script src="{{ asset('assets/js/form/form-editor.init.js') }}"></script>

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
    @endsection
