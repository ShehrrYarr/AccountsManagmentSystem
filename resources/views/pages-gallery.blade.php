@extends('partials.layouts.master3')

    @section('title', 'Gallery | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Masonry Gallery' )
    @section('pagetitle', 'Pages')
    @section('buttonTitle', 'Share')
    @section('link', '#!')

    @section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
    @endsection
    
    @section('content')


  <div class="masonry-grid">
    <div class="masonry-column">
      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-1.jpg') }}" alt="Photography">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Charming Concept</h3>
          <div class="text-white hover-fadeInRight">Photography</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-4.jpg') }}" alt="Fashion">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
          <div class="text-white hover-fadeInRight">Fashion</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-2.jpg') }}" alt="Inspiration">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Linear Architecture</h3>
          <div class="text-white hover-fadeInRight">Inspiration</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-3.jpg') }}" alt="Nature">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Endless Looks</h3>
          <div class="text-white hover-fadeInRight">Nature</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-4.jpg') }}" alt="Design">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Sleek Typography</h3>
          <div class="text-white hover-fadeInRight">Design</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-1.jpg') }}" alt="Fashion">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
          <div class="text-white hover-fadeInRight">Fashion</div>
        </figcaption>
      </figure>
      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-2.jpg') }}" alt="Fashion">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
          <div class="text-white hover-fadeInRight">Fashion</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-3.jpg') }}" alt="Fashion">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
          <div class="text-white hover-fadeInRight">Fashion</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-5.jpg') }}" alt="Fashion">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
          <div class="text-white hover-fadeInRight">Fashion</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-6.jpg') }}" alt="Fashion">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
          <div class="text-white hover-fadeInRight">Fashion</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-5.jpg') }}" alt="Fashion">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
          <div class="text-white hover-fadeInRight">Fashion</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-7.jpg') }}" alt="Food">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Orange Shine</h3>
          <div class="text-white hover-fadeInRight">Food</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-8.jpg') }}" alt="Health">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Boat Adventure</h3>
          <div class="text-white hover-fadeInRight">Health</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/image-6.jpg') }}" alt="Fashion">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Ebony Vintage</h3>
          <div class="text-white hover-fadeInRight">Fashion</div>
        </figcaption>
      </figure>

      <figure class="rounded rounded-4 overflow-hidden position-relative h-100">
        <a href="#!" class="h-100 position-relative d-block">
          <img class="img-fluid scale-up" src="{{ asset('assets/images/gallery/project-img-9.jpg') }}" alt="Nature">
        </a>
        <figcaption>
          <h3 class="text-white hover-fadeInLeft">Offroad Moves</h3>
          <div class="text-white hover-fadeInRight">Nature</div>
        </figcaption>
      </figure>

    </div>
  </div>
@endsection

@section('js')

  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection