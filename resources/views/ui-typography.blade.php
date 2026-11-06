@extends('partials.layouts.master2')

    @section('title', 'Home Default | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Typography' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')


  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <!--start::card-->
        <div class="card-header">
          <h5 class="card-title mb-0">Font Family</h5>
        </div>
        <!--end::card-->
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 text-muted">
              <p>Body Font Family</p>
              <p class="display-4 text-body">Aa</p>
              <p class="mb-2">Font Family</p>
              <h5 class="mb-0">"Rubik", sans-serif</h5>
            </div>

            <div class="col-sm-6 text-muted mt-4 mt-sm-0">
              <p>Heading Font Family</p>
              <h1 class="display-4 text-body">Aa</h1>
              <p class="mb-2">Font Family</p>
              <h5 class="mb-0">"Montserrat", sans-serif</h5>
            </div>
          </div>
        </div>
        <!-- end card-body -->
      </div>
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Headings</h5>
        </div>
        <!-- end card header -->

        <div class="card-body">
          <p class="text-muted">
            All HTML headings, <code>&lt;h1&gt;</code> through <code>&lt;h6&gt;</code>, are available.
          </p>
          <p class="h1">h1. Bootstrap heading</p>
          <p class="h2">h2. Bootstrap heading</p>
          <p class="h3">h3. Bootstrap heading</p>
          <p class="h4">h4. Bootstrap heading</p>
          <p class="h5">h5. Bootstrap heading</p>
          <p class="h6 mb-0">h6. Bootstrap heading</p>
        </div>
        <!-- end card-body -->
      </div>
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Display Headings</h5>
        </div>
        <!-- end card header -->

        <div class="card-body">
          <p class="text-muted">Use <code>fs-1</code>, <code>fs-2</code>, <code>fs-3</code>,
            <code>fs-4</code>, <code>fs-5</code>, or <code>fs-6</code>, class to change the
            font-size respectively.
          </p>
          <p class="fs-1">.fs-1 text</p>
          <p class="fs-2">.fs-2 text</p>
          <p class="fs-3">.fs-3 text</p>
          <p class="fs-4">.fs-4 text</p>
          <p class="fs-5">.fs-5 text</p>
          <p class="fs-6 mb-0">.fs-6 text</p>
        </div>
        <!-- end card-body -->
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Display Headings</h5>
        </div>
        <!-- end card header -->

        <div class="card-body">
          <p class="text-muted">
            Traditional heading elements are designed to work best in
            the meat of your page content.
          </p>
          <h1 class="display-1">Display 1</h1>
          <h1 class="display-2">Display 2</h1>
          <h1 class="display-3">Display 3</h1>
          <h1 class="display-4">Display 4</h1>
          <h1 class="display-5">Display 5</h1>
          <h1 class="display-6 mb-0">Display 6</h1>
        </div>
        <!-- end card-body -->
      </div>
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Inline Text Elements</h5>
        </div>
        <!-- end card header -->

        <div class="card-body">
          <p class="text-muted">
            Styling for common inline HTML5 elements.
          </p>
          <p>
            You can use the mark tag to <mark>highlight</mark> text.
          </p>
          <p>
            <del>This line of text is meant to be treated as deleted
              text.</del>
          </p>
          <p>
            <s>This line of text is meant to be treated as no longeraccurate.</s>
          </p>
          <p>
            <ins>This line of text is meant to be treated as an addition
              to the document.</ins>
          </p>
          <p><u>This line of text will render as underlined.</u></p>
          <p>
            <small>This line of text is meant to be treated as fine
              print.</small>
          </p>
          <p><strong>This line rendered as bold text.</strong></p>
          <p class="mb-0">
            <em>This line rendered as italicized text.</em>
          </p>
        </div>
        <!-- end card-body -->
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Left Aligned Blockquotes</h5>
        </div>
        <!-- end card header -->

        <div class="card-body">
          <blockquote class="blockquote mb-0 p-4 rounded-2 fst-italic border-light">
            <h6>Goodness isn't about avoiding falls, but about the courage to rise, stronger and kinder, with every stumble.</h6>
            <footer class="blockquote-footer mt-0 text-muted text-opacity-70 fs-12">Someone famous in <cite title="Source Title">Source Title</cite></footer>
          </blockquote>
        </div>
        <!-- end card-body -->
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Right Aligned Blockquotes</h5>
        </div>
        <!-- end card header -->

        <div class="card-body">
          <blockquote class="blockquote blockquote-right mb-0 p-4 rounded-2 fst-italic border-light">
            <h6>Goodness isn't about avoiding falls, but about the courage to rise, stronger and kinder, with every stumble.</h6>
            <footer class="blockquote-footer mt-0 text-muted text-opacity-70 fs-12">Someone famous in <cite title="Source Title">Source Title</cite></footer>
          </blockquote>
        </div>
        <!-- end card-body -->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">Blockquote Background Color</h5>
    </div>
    <!-- end card header -->

    <div class="card-body">
      <p class="text-muted">Use <code>blockquote-</code> class with the
        below-mentioned color variation to set the blockquote background color.</p>
      <div class="row">
        <div class="col-lg-4">
          <blockquote class="blockquote mb-0 p-4 rounded-2 fst-italic border-primary">
            <h6>Custom Blockquote Primary Example</h6>
            <footer class="blockquote-footer mt-0 text-muted text-opacity-70 fs-12">Angie Burt Designer <cite title="Source Title">Designer</cite></footer>
          </blockquote>
        </div>
      </div>
    </div>
    <!-- end card-body -->
  </div>
@endsection

@section('js')
  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection