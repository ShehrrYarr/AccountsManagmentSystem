@extends('partials.layouts.master2')

    @section('title', 'UI Card | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Card' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')
  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <h5 class="mb-4 mt-4">Basic Cards</h5>
    </div>
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <img class="card-img-top rounded-top" src="{{ asset('assets/images/small/img-11.jpg') }}" alt="Smartphone">
        <div class="card-body">
          <h5 class="card-title">Smartphone XYZ</h5>
          <p class="card-text">The latest Smartphone XYZ with cutting-edge features. Enjoy a seamless experience with a 6.5-inch display, 128GB storage, and powerful performance.</p>
          <a href="#!" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <img class="card-img-top rounded-top" src="{{ asset('assets/images/small/img-12.jpg') }}" alt="Laptop">
        <div class="card-body">
          <h5 class="card-title">Laptop Pro 15</h5>
          <p class="card-text">Laptop Pro 15 is perfect for work and play. Equipped with the latest Intel processor, 16GB RAM, and an ultra-high-definition screen.</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Intel Core i7</li>
          <li class="list-group-item">16GB RAM</li>
        </ul>
        <div class="card-body">
          <a href="product-details" class="card-link fw-medium">View Details</a>
          <a href="#!" class="card-link fw-medium">Add to Cart</a>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <img class="card-img-top rounded-top" src="{{ asset('assets/images/small/img-13.jpg') }}" alt="Headphones">
        <div class="card-body">
          <p class="card-text">Experience superior sound quality with the Noise Cancelling Headphones. Perfect for music lovers and frequent travelers. Built to last with comfortable ear cups.</p>
          <a href="#!" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-sm-6 col-xl-3">
      <div class="card d-block">
        <div class="card-body">
          <h5 class="card-title">Smartwatch 3.0</h5>
          <h6 class="card-subtitle">Your Personal Fitness Assistant</h6>
        </div>
        <img class="img-fluid" src="{{ asset('assets/images/small/img-10.jpg') }}" alt="Smartwatch">
        <div class="card-body">
          <p class="card-text">The Smartwatch 3.0 comes with health tracking, GPS, and a sleek design. Monitor your steps, heart rate, and sleep patterns with ease.</p>
          <a href="#!" class="card-link text-custom">View Details</a>
          <a href="#!" class="card-link text-custom">Add to Cart</a>
        </div>
      </div>
    </div><!-- END COL -->
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <h5 class="mb-4 mt-4">Header and footer</h5>
    </div>
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-sm-6 col-lg-4">
      <div class="card d-block">
        <h5 class="card-header">Featured Article</h5>
        <div class="card-body">
          <h6 class="card-title">How Technology is Changing the Future</h6>
          <p class="card-text">Explore the latest advancements in technology, from AI to quantum computing, and how they are shaping the future of our world.</p>
          <a href="#!" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-sm-6 col-lg-4">
      <div class="card d-block">
        <h5 class="card-header">Inspirational Quote</h5>
        <div class="card-body">
          <blockquote class="card-blockquote mb-0">
            <p class="card-text">"The only limit to our realization of tomorrow is our doubts of today."</p>
            <footer class="blockquote-footer mt-0 font-size-12">
              Franklin D. Roosevelt <cite title="Source Title">The American President</cite>
            </footer>
          </blockquote>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-sm-6 col-lg-4">
      <div class="card d-block">
        <h5 class="card-header">Featured Article</h5>
        <div class="card-body">
          <h6 class="card-title">Sustainable Living in Urban Spaces</h6>
          <p class="card-text">
            A deep dive into sustainable living practices that are reshaping the way we design and build cities for the future.
          </p>
          <a href="#!" class="btn btn-primary">Read More</a>
        </div>
        <div class="card-footer text-body-secondary bg-transparent border-top">2 days ago</div>
      </div>
    </div><!-- END COL -->

    <div class="col-sm-6 col-lg-4">
      <div class="card d-block">
        <div class="card-header">
          <h5 class="card-title mb-0">Tech Industry Insights</h5>
        </div>
        <div class="card-body">
          <p>Discover the latest trends in the tech industry, including developments in machine learning, robotics, and cybersecurity.</p>
          <p class="mb-0">Stay ahead of the curve with insights from industry leaders and experts who are driving innovation forward.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-sm-6 col-lg-4">
      <div class="card d-block">
        <div class="card-header">
          <h5 class="card-title">The Future of Renewable Energy</h5>
          <p class="card-text mb-0">A look into how renewable energy technologies are evolving and their potential impact on global economies.</p>
        </div>
        <div class="card-body">
          <p class="card-text mb-0">As countries around the world seek cleaner, more sustainable energy solutions, the renewable energy sector is booming.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-sm-6 col-lg-4">
      <div class="card d-block">
        <div class="card-header">
          <h5 class="card-title mb-0"><i class="ri-user-line me-1"></i> Meet the Expert</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Meet Dr. Jane Doe, a renowned environmental scientist who is helping shape global sustainability efforts. In this article, she shares her vision for a greener future.</p>
        </div>
      </div>
    </div><!-- END COL -->
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <h5 class="mb-4 mt-4">Text Alignment Examples</h5>
    </div>
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-lg-4">
      <div class="card card-body">
        <h5 class="card-title">Discover the Future of AI</h5>
        <p class="card-text">Explore the latest developments in Artificial Intelligence and how it's revolutionizing various industries from healthcare to finance.</p>
        <a href="#!" class="btn btn-primary">Read More</a>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 text-center">
      <div class="card card-body">
        <h5 class="card-title">Sustainable Living Practices</h5>
        <p class="card-text">Learn how adopting sustainable living practices can reduce your carbon footprint and create a better environment for future generations.</p>
        <a href="#!" class="btn btn-primary">Read More</a>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 text-end">
      <div class="card card-body">
        <h5 class="card-title">The Power of Remote Work</h5>
        <p class="card-text">Discover the benefits of remote work and how businesses are adapting to this new trend while keeping their workforce productive and engaged.</p>
        <a href="#!" class="btn btn-primary">Read More</a>
      </div>
    </div><!-- END COL -->
  </div>

  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <h5 class="mb-4 mt-4">Image Caps & Overlays</h5>
    </div>
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="card">
        <img class="card-img-top rounded-top" src="{{ asset('assets/images/small/img-5.jpg') }}" alt="Card image top">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text ">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text ">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
        </div>
        <img class="card-img-bottom rounded-bottom" src="{{ asset('assets/images/small/img-7.jpg') }}" alt="Card image bottom">
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-dark">
        <img class="card-img rounded" src="{{ asset('assets/images/small/img-2.jpg') }}" alt="Card image overlay">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small>Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div><!-- END COL -->
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <h5 class="mb-4 mt-4">Horizontal</h5>
    </div>
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-lg-6">
      <div class="card overflow-hidden">
        <div class="row g-0 align-items-center">
          <div class="col-md-5">
            <img class="card-img img-fluid" src="{{ asset('assets/images/small/img-8.jpg') }}" alt="Card image">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <h5 class="card-title mb-1">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-6">
      <div class="card overflow-hidden">
        <div class="row g-0 align-items-center">
          <div class="col-md-7">
            <div class="card-body">
              <h5 class="card-title mb-1">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="col-md-5">
            <img class="card-img img-fluid" src="{{ asset('assets/images/small/img-9.jpg') }}" alt="Card image">
          </div>
        </div>
      </div>
    </div><!-- END COL -->
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <h5 class="mb-4 mt-4">Theme Color</h5>
    </div>
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-primary">
        <div class="card-header">
          <h5 class="card-title mb-0">Primary Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-secondary">
        <div class="card-header">
          <h5 class="card-title mb-0">Secondary Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-success">
        <div class="card-header">
          <h5 class="card-title mb-0">Success Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-danger">
        <div class="card-header">
          <h5 class="card-title mb-0">Danger Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-warning">
        <div class="card-header">
          <h5 class="card-title mb-0">Warning Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-info">
        <div class="card-header">
          <h5 class="card-title mb-0">Info Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-light">
        <div class="card-header">
          <h5 class="card-title mb-0">Light Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card text-bg-dark">
        <div class="card-header">
          <h5 class="card-title mb-0">Dark Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">White Card</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->
  </div>

  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <h5 class="mb-4 mt-4">Theme Color Border</h5>
    </div>
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="card border border-primary">
        <div class="card-header bg-transparent border-primary">
          <h5 class="card-title mb-0 text-primary">Primary Outline Card</h5>
        </div>
        <div class="card-body text-primary">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card border border-secondary">
        <div class="card-header bg-transparent border-secondary">
          <h5 class="card-title mb-0 text-secondary">Secondary Outline Card</h5>
        </div>
        <div class="card-body text-secondary">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card border border-success">
        <div class="card-header bg-transparent border-success">
          <h5 class="card-title mb-0 text-success">Success Outline Card</h5>
        </div>
        <div class="card-body text-success">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card border border-danger">
        <div class="card-header bg-transparent border-danger">
          <h5 class="card-title mb-0 text-danger">Danger Outline Card</h5>
        </div>
        <div class="card-body text-danger">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card border border-warning">
        <div class="card-header bg-transparent border-warning">
          <h5 class="card-title mb-0 text-warning">Warning Outline Card</h5>
        </div>
        <div class="card-body text-warning">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card border border-info">
        <div class="card-header bg-transparent border-info">
          <h5 class="card-title mb-0 text-info">Info Outline Card</h5>
        </div>
        <div class="card-body text-info">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card border border-light">
        <div class="card-header bg-transparent border-light">
          <h5 class="card-title mb-0">Light Outline Card</h5>
        </div>
        <div class="card-body text-body-emphasis">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card border border-dark">
        <div class="card-header bg-transparent border-dark">
          <h5 class="card-title mb-0">Dark Outline Card</h5>
        </div>
        <div class="card-body text-body-emphasis">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-4 col-md-6">
      <div class="card border border-white">
        <div class="card-header bg-transparent border-white">
          <h5 class="card-title mb-0">White Outline Card</h5>
        </div>
        <div class="card-body text-body-emphasis">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div><!-- END COL -->
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <h5 class="mb-4 mt-4">Card Groups</h5>
    </div>
  </div><!-- END ROW -->

  <!-- START ROW -->
  <div class="row">
    <div class="col-12">
      <div class="card-deck-wrapper">
        <div class="card-group">
          <div class="card overflow-hidden">
            <img class="card-img-top img-fluid" src="{{ asset('assets/images/small/img-6.jpg') }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
          </div>

          <div class="card overflow-hidden">
            <img class="card-img-top img-fluid" src="{{ asset('assets/images/small/img-7.jpg') }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
          </div>

          <div class="card overflow-hidden">
            <img class="card-img-top img-fluid" src="{{ asset('assets/images/small/img-9.jpg') }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
          </div>

        </div>
      </div>
    </div><!-- END COL -->
  </div><!-- END ROW -->
@endsection

@section('js')

  <!-- ========== MAIN JS ========== -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
@endsection
