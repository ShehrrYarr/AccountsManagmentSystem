@extends('partials.layouts.master3')

    @section('title', 'Start | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Starter' )
    @section('pagetitle', 'Pages')
    @section('buttonTitle', 'View All')
    @section('link', 'index')


    @section('content')



  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-1">Trends and Tools in Web Design</h5>
          <p class="mb-0 card-subtitle fs-13">Explore the latest insights and resources for your web design journey.</p>
        </div>
        <div class="card-body">
          <p class="card-text fs-13"><strong class="text-body">Current Web Design Trends: </strong> Stay informed about the latest developments in web design, including the use of animations, micro-interactions, dark mode, and innovative navigation methods. Ensure your website has a straightforward and user-friendly navigation system, allowing visitors to easily access what they need without feeling overwhelmed.</p>
          <p class="card-text fs-13"><strong class="text-body">Essential Design Tools: </strong> Discover popular design software such as Adobe Photoshop, Sketch, Figma, and Adobe XD, along with tips for maximizing efficiency in your workflow and collaboration. Don't forget to compress and optimize images to enhance loading speeds and overall site performance, resulting in a smoother user experience.</p>
          <p class="mb-0 card-text fs-13"><strong class="text-body">Front-End Development Basics: </strong> A foundational knowledge of HTML, CSS, and JavaScript can significantly boost your web design capabilities, enabling the creation of engaging and dynamic features. Prioritize sufficient contrast between text and background colors to improve readability and accessibility, especially for users with visual challenges.</p>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <!-- App js -->
  <script type="module" src="{{ asset('assets/js/app.js') }}"></script>
  @endsection