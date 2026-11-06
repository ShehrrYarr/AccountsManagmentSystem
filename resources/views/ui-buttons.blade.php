@extends('partials.layouts.master2')

    @section('title', 'Button | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Button' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')

    @section('content')
  <!-- START ROW -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Default Button</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create buttons in Bootstrap by adding the <code>.btn</code> class along with contextual classes like <code>.btn-primary</code>, <code>.btn-secondary</code>, or <code>.btn-success</code> to style the button.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-primary">Primary</button>
            <button type="button" class="btn btn-secondary">Secondary</button>
            <button type="button" class="btn btn-success">Success</button>
            <button type="button" class="btn btn-info">Info</button>
            <button type="button" class="btn btn-warning">Warning</button>
            <button type="button" class="btn btn-danger">Danger</button>
            <button type="button" class="btn btn-dark">Dark</button>
            <button type="button" class="btn btn-link">Link</button>
            <button type="button" class="btn btn-light">Light</button>
          </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Use the <code>.btn</code> class to create buttons in Bootstrap. Add the <code>.rounded-pill</code> class to give the button rounded edges, creating a pill-shaped button.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn rounded-pill btn-primary">Primary</button>
            <button type="button" class="btn rounded-pill btn-secondary">Secondary</button>
            <button type="button" class="btn rounded-pill btn-success">Success</button>
            <button type="button" class="btn rounded-pill btn-info">Info</button>
            <button type="button" class="btn rounded-pill btn-warning">Warning</button>
            <button type="button" class="btn rounded-pill btn-danger">Danger</button>
            <button type="button" class="btn rounded-pill btn-dark">Dark</button>
            <button type="button" class="btn rounded-pill btn-link">Link</button>
            <button type="button" class="btn rounded-pill btn-light">Light</button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Light Button</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create light-themed buttons in Bootstrap by using the <code>.btn-light</code> class. You can also add variations like <code>.btn-light-primary</code> or <code>.btn-light-secondary</code> for different color accents.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-light-primary">Primary</button>
            <button type="button" class="btn btn-light-secondary">Secondary</button>
            <button type="button" class="btn btn-light-success">Success</button>
            <button type="button" class="btn btn-light-info">Info</button>
            <button type="button" class="btn btn-light-warning">Warning</button>
            <button type="button" class="btn btn-light-danger">Danger</button>
            <button type="button" class="btn btn-light-dark">Dark</button>
            <button type="button" class="btn btn-light-light">Light</button>
          </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Create light-themed, pill-shaped buttons in Bootstrap by combining the <code>.btn-light-*</code> class with <code>.rounded-pill</code>. This gives the button a light color and rounded edges for a sleek look.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn rounded-pill btn-light-primary">Primary</button>
            <button type="button" class="btn rounded-pill btn-light-secondary">Secondary</button>
            <button type="button" class="btn rounded-pill btn-light-success">Success</button>
            <button type="button" class="btn rounded-pill btn-light-info">Info</button>
            <button type="button" class="btn rounded-pill btn-light-warning">Warning</button>
            <button type="button" class="btn rounded-pill btn-light-danger">Danger</button>
            <button type="button" class="btn rounded-pill btn-light-dark">Dark</button>
            <button type="button" class="btn rounded-pill btn-light-light">Light</button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Outline Buttons</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create outline buttons in Bootstrap using the <code>.btn-outline-*</code> class. This gives the button a border and transparent background, with color variations like <code>.btn-outline-primary</code> or <code>.btn-outline-secondary</code>.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-outline-primary">Primary</button>
            <button type="button" class="btn btn-outline-secondary">Secondary</button>
            <button type="button" class="btn btn-outline-success">Success</button>
            <button type="button" class="btn btn-outline-info">Info</button>
            <button type="button" class="btn btn-outline-warning">Warning</button>
            <button type="button" class="btn btn-outline-danger">Danger</button>
            <button type="button" class="btn btn-outline-dark">Dark</button>
          </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Create outline buttons with rounded edges in Bootstrap by using the <code>.btn-outline-*</code> class along with <code>.rounded-pill</code>. This combines a transparent button with a sleek, pill-shaped design.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn rounded-pill btn-outline-primary">Primary</button>
            <button type="button" class="btn rounded-pill btn-outline-secondary">Secondary</button>
            <button type="button" class="btn rounded-pill btn-outline-success">Success</button>
            <button type="button" class="btn rounded-pill btn-outline-info">Info</button>
            <button type="button" class="btn rounded-pill btn-outline-warning">Warning</button>
            <button type="button" class="btn rounded-pill btn-outline-danger">Danger</button>
            <button type="button" class="btn rounded-pill btn-outline-dark">Dark</button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Text Button</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create text-only buttons in Bootstrap using the <code>.btn-text-*</code> class. This removes the background and border, leaving only the text styled as a button.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-text-primary">Primary</button>
            <button type="button" class="btn btn-text-secondary">Secondary</button>
            <button type="button" class="btn btn-text-success">Success</button>
            <button type="button" class="btn btn-text-info">Info</button>
            <button type="button" class="btn btn-text-warning">Warning</button>
            <button type="button" class="btn btn-text-danger">Danger</button>
            <button type="button" class="btn btn-text-dark">Dark</button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Buttons Size</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Adjust button sizes in Bootstrap by using the size classes <code>.btn-sm</code> for smaller buttons and <code>.btn-lg</code> for larger buttons. The default size is applied when no size class is used.</p>
          <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" class="btn btn-primary btn-sm">Small button</button>
            <button type="button" class="btn btn-primary">Large button</button>
            <button type="button" class="btn btn-primary btn-lg">Large button</button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Social Buttons</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create social media buttons in Bootstrap by using the <code>.btn</code> class along with custom color classes for each platform, such as <code>.btn-facebook</code>, <code>.btn-light-facebook</code>,<code>.btn-twitter</code> or <code>.btn-light-twitter</code>, to match the respective brand styles.</p>
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex flex-wrap align-items-center gap-2">
              <button type="button" class="btn btn-sm btn-facebook"><i class="ri-facebook-fill"></i></button>
              <button type="button" class="btn btn-sm btn-google"><i class="ri-google-fill"></i></button>
              <button type="button" class="btn btn-sm btn-twitter"><i class="ri-twitter-fill"></i></button>
              <button type="button" class="btn btn-sm btn-instagram"><i class="ri-instagram-fill"></i></button>
              <button type="button" class="btn btn-sm btn-youtube"><i class="ri-youtube-fill"></i></button>
              <button type="button" class="btn btn-sm btn-linkedin"><i class="ri-linkedin-box-fill"></i></button>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-2">
              <button type="button" class="btn btn-sm btn-light-facebook"><i class="ri-facebook-fill"></i></button>
              <button type="button" class="btn btn-sm btn-light-google"><i class="ri-google-fill"></i></button>
              <button type="button" class="btn btn-sm btn-light-twitter"><i class="ri-twitter-fill"></i></button>
              <button type="button" class="btn btn-sm btn-light-instagram"><i class="ri-instagram-fill"></i></button>
              <button type="button" class="btn btn-sm btn-light-youtube"><i class="ri-youtube-fill"></i></button>
              <button type="button" class="btn btn-sm btn-light-linkedin"><i class="ri-linkedin-box-fill"></i></button>
            </div>
          </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Create social media outline buttons in Bootstrap using the <code>.btn btn-outline-youtube</code> class. This gives the button a transparent background with a colored border, styled for the YouTube brand.</p>
          <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" class="btn btn-sm btn-outline-facebook"><i class="ri-facebook-fill"></i></button>
            <button type="button" class="btn btn-sm btn-outline-google"><i class="ri-google-fill"></i></button>
            <button type="button" class="btn btn-sm btn-outline-twitter"><i class="ri-twitter-fill"></i></button>
            <button type="button" class="btn btn-sm btn-outline-instagram"><i class="ri-instagram-fill"></i></button>
            <button type="button" class="btn btn-sm btn-outline-youtube"><i class="ri-youtube-fill"></i></button>
            <button type="button" class="btn btn-sm btn-outline-linkedin"><i class="ri-linkedin-box-fill"></i></button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Icon Buttons</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create icon buttons in Bootstrap by combining the <code>.btn</code> class with an icon, such as using an icon from a library like Remix Icon. This allows you to add visual elements alongside button text.</p>
          <div class="row g-2">
            <div class="col-sm-6 col-lg-4">
              <div class="d-flex flex-wrap gap-2">
                <div class="d-flex flex-column gap-2">
                  <button type="button" class="btn btn-primary"><i class="ri-star-line me-2"></i>Primary</button>
                  <button type="button" class="btn rounded-pill btn-primary"><i class="ri-star-line me-2"></i>Primary</button>
                </div>
                <div class="d-flex flex-column gap-2">
                  <button type="button" class="btn btn-secondary"><i class="ri-notification-4-line me-2"></i>Secondary</button>
                  <button type="button" class="btn rounded-pill btn-secondary"><i class="ri-notification-4-line me-2"></i>Secondary</button>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="d-flex flex-wrap gap-2">
                <div class="d-flex flex-column gap-2">
                  <button type="button" class="btn btn-light-primary"><i class="ri-star-line me-2"></i>Primary</button>
                  <button type="button" class="btn rounded-pill btn-light-primary"><i class="ri-star-line me-2"></i>Primary</button>
                </div>
                <div class="d-flex flex-column gap-2">
                  <button type="button" class="btn btn-light-secondary"><i class="ri-notification-4-line me-2"></i>Secondary</button>
                  <button type="button" class="btn rounded-pill btn-light-secondary"><i class="ri-notification-4-line me-2"></i>Secondary</button>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-4">
              <div class="d-flex flex-wrap gap-2">
                <div class="d-flex flex-column gap-2">
                  <button type="button" class="btn btn-outline-primary"><i class="ri-star-line me-2"></i>Primary</button>
                  <button type="button" class="btn rounded-pill btn-outline-primary"><i class="ri-star-line me-2"></i>Primary</button>
                </div>
                <div class="d-flex flex-column gap-2">
                  <button type="button" class="btn btn-outline-secondary"><i class="ri-notification-4-line me-2"></i>Secondary</button>
                  <button type="button" class="btn rounded-pill btn-outline-secondary"><i class="ri-notification-4-line me-2"></i>Secondary</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="m-0">
        <div class="card-body">
          <p class="text-muted">Create icon buttons in Bootstrap by using the <code>.icon-btn</code> class along with an icon from an icon library. This class styles the button to incorporate an icon, making it visually appealing and functional.</p>
          <div class="row g-2">
            <div class="col-lg-4">
              <div class="d-flex flex-wrap gap-2 align-items-center">
                <button type="button" class="btn btn-primary icon-btn">
                  <i class="ri-star-line"></i>
                </button>
                <button type="button" class="btn btn-secondary icon-btn">
                  <i class="ri-notification-4-line"></i>
                </button>
                <button type="button" class="btn btn-primary rounded-pill icon-btn">
                  <i class="ri-star-line"></i>
                </button>
                <button type="button" class="btn btn-secondary rounded-pill icon-btn">
                  <i class="ri-notification-4-line"></i>
                </button>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-wrap gap-2 align-items-center">
                <button type="button" class="btn btn-light-primary icon-btn">
                  <i class="ri-star-line"></i>
                </button>
                <button type="button" class="btn btn-light-secondary icon-btn">
                  <i class="ri-notification-4-line"></i>
                </button>
                <button type="button" class="btn btn-light-primary rounded-pill icon-btn">
                  <i class="ri-star-line"></i>
                </button>
                <button type="button" class="btn btn-light-secondary rounded-pill icon-btn">
                  <i class="ri-notification-4-line"></i>
                </button>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="d-flex flex-wrap gap-2 align-items-center">
                <button type="button" class="btn btn-outline-primary icon-btn">
                  <i class="ri-star-line"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary icon-btn">
                  <i class="ri-notification-4-line"></i>
                </button>
                <button type="button" class="btn btn-outline-primary rounded-pill icon-btn">
                  <i class="ri-star-line"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary rounded-pill icon-btn">
                  <i class="ri-notification-4-line"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Icon Button Size</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create icon buttons in Bootstrap using the <code>.icon-btn</code> class. Adjust the size with <code>.icon-btn-sm</code> for smaller buttons, allowing for a compact design while incorporating icons.</p>
          <div class="d-flex align-items-center flex-wrap gap-2">
            <button type="button" class="btn btn-primary icon-btn-sm">
              <i class="ri-home-2-line"></i>
            </button>
            <button type="button" class="btn btn-primary icon-btn">
              <i class="ri-home-2-line"></i>
            </button>
            <button type="button" class="btn btn-primary icon-btn-lg">
              <i class="ri-home-2-line"></i>
            </button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Custom Toggle Buttons</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create custom toggle buttons in Bootstrap using the <code>.btn-loader</code> class to show a loading state. By default, use <code>.indicator-label</code> for button text, which changes to <code>.indicator-progress</code> after clicking to indicate the loading process.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-primary btn-loader">
              <span class="indicator-label">
                Submit
              </span>
              <span class="indicator-progress flex gap-2 align-items-center">
                <span>Loading...</span>
                <i class="ri-loader-2-fill"></i>
              </span>
            </button>

            <button type="button" class="btn btn-danger btn-loader">
              <span class="indicator-label">
                Submit
              </span>
              <span class="indicator-progress flex gap-2 align-items-center">
                <span>Please Wait...</span>
                <i class="ri-loader-2-fill"></i>
              </span>
            </button>

            <button type="button" class="btn btn-primary custom-toggle" aria-pressed="false">
              <span class="icon-on">
                <i class="ri-add-line align-bottom me-1"></i> Unfollow
              </span>
              <span class="icon-off">
                <i class="ri-user-unfollow-line align-bottom me-1"></i> Follow
              </span>
            </button>

            <button type="button" class="btn btn-primary custom-toggle" aria-pressed="false">
              <span class="icon-on">
                Unactive
              </span>
              <span class="icon-off">
                Active
              </span>
            </button>

            <button type="button" class="btn btn-dark icon-btn custom-toggle" aria-pressed="false">
              <span class="icon-on">
                <i class="ri-bookmark-line"></i>
              </span>
              <span class="icon-off">
                <i class="ri-bookmark-fill"></i>
              </span>
            </button>

            <button type="button" class="btn btn-success icon-btn custom-toggle" aria-pressed="false">
              <span class="icon-on">
                <i class="ri-heart-line"></i>
              </span>
              <span class="icon-off">
                <i class="ri-heart-fill"></i>
              </span>
            </button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Loading Animations</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Add loading animations in Bootstrap using the <code>.btn-loader</code> class. Incorporate <code>.spinner-grow</code> or <code>.spinner-border</code> classes to show different types of spinners, providing visual feedback during loading processes.</p>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-primary btn-loader">
              <span class="d-flex gap-2 align-items-center">
                <span class="flex-grow-1">
                  Loading...
                </span>
                <span class="flex-shrink-0">
                  <i class="ri-loader-2-fill"></i>
                  <span class="visually-hidden">Loading...</span>
                </span>
              </span>
            </button>
            <button type="button" class="btn btn-secondary btn-loader">
              <span class="d-flex gap-2 align-items-center">
                <span class="flex-grow-1">
                  Please Wait...
                </span>
                <span class="flex-shrink-0">
                  <i class="ri-refresh-line"></i>
                  <span class="visually-hidden">Please Wait...</span>
                </span>
              </span>
            </button>
            <button type="button" class="btn btn-primary">
              <span class="d-flex align-items-center">
                <span class="spinner-border spinner-border-sm me-2 flex-shrink-0" role="status">
                  <span class="visually-hidden">Loading...</span>
                </span>
                <span class="flex-grow-1 ms-2">
                  Loading...
                </span>
              </span>
            </button>
            <button type="button" class="btn btn-secondary">
              <span class="d-flex align-items-center">
                <span class="flex-grow-1 me-2">
                  Wait...
                </span>
                <span class="spinner-border spinner-border-sm me-2 flex-shrink-0" role="status">
                  <span class="visually-hidden">Wait...</span>
                </span>
              </span>
            </button>
            <button type="button" class="btn btn-success icon-btn">
              <span class="spinner-grow spinner-grow-sm flex-shrink-0" role="status">
                <span class="visually-hidden">Wait...</span>
              </span>
            </button>
            <button type="button" class="btn btn-success icon-btn">
              <span class="spinner-border spinner-border-sm flex-shrink-0" role="status">
                <span class="visually-hidden">Wait...</span>
              </span>
            </button>
          </div>
        </div>
      </div>
    </div><!-- END COL -->

    <div class="col-lg-12">
      <div class="card mb-0">
        <div class="card-header">
          <h5 class="card-title mb-0">Full width button</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">Create a full-width button in Bootstrap by using the <code>.w-100</code> class along with the <code>.btn</code> class. This makes the button stretch to fill its container, ensuring it occupies the entire width available.</p>
          <div class="row g-2">
            <div class="col-md-6 col-lg-4 col-12">
              <button class="btn btn-primary w-100 mb-2" type="button">Button</button>
              <button class="btn btn-secondary w-100" type="button">Button</button>
            </div>
            <div class="col-md-6 col-lg-4 col-12">
              <button class="btn btn-light-primary w-100 mb-2" type="button">Button</button>
              <button class="btn btn-light-secondary w-100" type="button">Button</button>
            </div>
            <div class="col-md-6 col-lg-4 col-12">
              <button class="btn btn-outline-primary w-100 mb-2" type="button">Button</button>
              <button class="btn btn-outline-secondary w-100" type="button">Button</button>
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