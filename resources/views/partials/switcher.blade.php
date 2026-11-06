<!-- START SWITCHER -->
<div class="switcher">
  <button type="button" class="switcher-icon btn btn-dark" data-bs-toggle="offcanvas" data-bs-target="#switcher">
    <i class="bi-sliders fs-6 me-2"></i> Customize
  </button>

  <!-- OFFCANVAS -->
  <div class="offcanvas offcanvas-end" id="switcher" tabindex="-1" aria-labelledby="switcherLabel">
    <div class="offcanvas-header border-bottom hstack">
      <h1 class="offcanvas-title fs-5 flex-grow-1" id="switcherLabel">Preview Settings</h1>
      <button type="button" class="close btn btn-text-primary icon-btn-sm flex-shrink-0" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="ri-close-large-line fw-semibold"></i>
      </button>
    </div>
    <div class="offcanvas-body">

      <!-- MAIN_LAYOUT -->
      <div class="d-none d-lg-block">
        <h6 class="mb-2 fs-5">Theme Layouts</h6>
        <p class="text-muted">Defines the admin panel's layout style, allowing you to choose from different design options.</p>
        <div class="row g-4 mb-5">
          <div class="col-12 col-sm-4">
            <!-- VERTICAL -->
            <input class="form-check-input d-none" data-attribute="data-main-layout" name="layoutsModes" value="vertical" type="radio" id="verticalLayouts">
            <label for="verticalLayouts" class="switcher-card w-100">
              <span class="border d-block rounded h-100px overflow-hidden">
                <span class="d-flex h-100">
                  <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                    <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                    <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                      <span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                      </span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                  </span>
                  <span class="d-flex flex-column flex-grow-1">
                    <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                      <span class="d-flex align-items-center gap-1">
                        <span class="w-8px h-8px bg-danger rounded-pill"></span>
                        <span class="w-8px h-8px bg-success rounded-pill"></span>
                        <span class="w-8px h-8px bg-warning rounded-pill"></span>
                      </span>
                      <span class="w-8px h-8px bg-light rounded-pill"></span>
                    </span>
                    <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                      <span class="p-2">
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      </span>
                      <span class="w-100 bg-light h-6px ms-1"></span>
                    </span>
                  </span>
                </span>
              </span>
              <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Vertical</span>
            </label>
          </div>
          <div class="col-12 col-sm-4">
            <!-- HORIZONTAL -->
            <input class="form-check-input d-none" data-attribute="data-main-layout" name="layoutsModes" value="horizontal" type="radio" id="horizontalLayouts">
            <label for="horizontalLayouts" class="switcher-card w-100">
              <span class="border d-block rounded h-100px overflow-hidden">
                <span class="d-flex h-100">
                  <span class="d-flex flex-column flex-grow-1">
                    <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                      <span class="d-flex align-items-center gap-1">
                        <span class="w-8px h-8px bg-danger rounded-pill"></span>
                        <span class="w-8px h-8px bg-success rounded-pill"></span>
                        <span class="w-8px h-8px bg-warning rounded-pill"></span>
                      </span>
                      <span class="w-8px h-8px bg-light rounded-pill"></span>
                    </span>
                    <span class="d-flex h-16px flex-shrink-0 border-end">
                      <span class="w-20px h-16px bg-light d-block"></span>
                      <span class="w-100 bg-primary-subtle d-flex justify-content-between p-1">
                        <span class="d-flex gap-2">
                          <span class="w-20px h-6px bg-light rounded d-block mb-1"></span>
                          <span class="w-20px h-6px bg-light rounded d-block mb-1"></span>
                        </span>
                        <span class="w-20px h-6px bg-light rounded d-block mb-1"></span>
                      </span>
                    </span>
                    <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                      <span class="p-2">
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      </span>
                      <span class="w-100 bg-light h-6px"></span>
                    </span>
                  </span>
                </span>
              </span>
              <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Horizontal</span>
            </label>
          </div>
          <div class="col-12 col-sm-4">
            <!-- 2 COLUMN -->
            <input class="form-check-input d-none" data-attribute="data-main-layout" name="layoutsModes" value="two-column" type="radio" id="2ColumnLayouts">
            <label for="2ColumnLayouts" class="switcher-card w-100">
              <span class="border d-block rounded h-100px overflow-hidden">
                <span class="d-flex h-100">
                  <span class="w-16px d-flex flex-column h-100 flex-shrink-0 border-end">
                    <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                    <span class="h-100 bg-light d-flex flex-column justify-content-between p-1">
                      <span>
                        <span class="h-6px bg-primary-subtle rounded d-block mb-1"></span>
                        <span class="h-6px bg-primary-subtle rounded d-block mb-1"></span>
                      </span>
                      <span class="h-6px bg-primary-subtle rounded d-block mb-1"></span>
                    </span>
                  </span>
                  <span class="w-30px ms-1 d-flex flex-column h-100 flex-shrink-0 border-end">
                    <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                    <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                      <span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                      </span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                  </span>
                  <span class="d-flex flex-column flex-grow-1">
                    <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                      <span class="d-flex align-items-center gap-1">
                        <span class="w-8px h-8px bg-danger rounded-pill"></span>
                        <span class="w-8px h-8px bg-success rounded-pill"></span>
                        <span class="w-8px h-8px bg-warning rounded-pill"></span>
                      </span>
                      <span class="w-8px h-8px bg-light rounded-pill"></span>
                    </span>
                    <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                      <span class="p-2">
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      </span>
                      <span class="w-100 bg-light h-6px ms-1"></span>
                    </span>
                  </span>
                </span>
              </span>
              <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Two Column</span>
            </label>
          </div>
          <div class="col-12 col-sm-4">
            <!-- SEMI BOXED -->
            <input class="form-check-input d-none" data-attribute="data-main-layout" name="layoutsModes" value="semi-boxed" type="radio" id="semiBoxLayouts">
            <label for="semiBoxLayouts" class="switcher-card w-100">
              <span class="border d-block rounded h-100px overflow-hidden p-2">
                <span class="d-flex h-100 rounded">
                  <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                    <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                    <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                      <span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                      </span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                  </span>
                  <span class="d-flex flex-column flex-grow-1">
                    <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                      <span class="d-flex align-items-center gap-1">
                        <span class="w-8px h-8px bg-danger rounded-pill"></span>
                        <span class="w-8px h-8px bg-success rounded-pill"></span>
                        <span class="w-8px h-8px bg-warning rounded-pill"></span>
                      </span>
                      <span class="w-8px h-8px bg-light rounded-pill"></span>
                    </span>
                    <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                      <span class="p-2">
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      </span>
                      <span class="w-100 bg-light h-6px ms-1"></span>
                    </span>
                  </span>
                </span>
              </span>
              <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Semi Box</span>
            </label>
          </div>
          <div class="col-12 col-sm-4">
            <!-- COMPACT -->
            <input class="form-check-input d-none" data-attribute="data-main-layout" name="layoutsModes" value="compact" type="radio" id="compactSidebar">
            <label for="compactSidebar" class="switcher-card w-100">
              <span class="border d-block rounded h-100px overflow-hidden">
                <span class="d-flex h-100">
                  <span class="w-20px d-flex flex-column h-100 flex-shrink-0 border-end">
                    <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                    <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                      <span>
                        <span class="h-8px bg-light rounded d-block mb-1"></span>
                        <span class="h-8px bg-light rounded d-block mb-1"></span>
                      </span>
                      <span class="h-8px bg-light rounded d-block mb-1"></span>
                    </span>
                  </span>
                  <span class="d-flex flex-column flex-grow-1">
                    <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                      <span class="d-flex align-items-center gap-1">
                        <span class="w-8px h-8px bg-danger rounded-pill"></span>
                        <span class="w-8px h-8px bg-success rounded-pill"></span>
                        <span class="w-8px h-8px bg-warning rounded-pill"></span>
                      </span>
                      <span class="w-8px h-8px bg-light rounded-pill"></span>
                    </span>
                    <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                      <span class="p-2">
                        <span class="w-25 bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-50 bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-100 bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-75 bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-25 bg-light rounded-1 h-6px mb-1"></span>
                      </span>
                      <span class="w-100 bg-light h-6px ms-1"></span>
                    </span>
                  </span>
                </span>
              </span>
              <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Compact</span>
            </label>
          </div>
          <div class="col-12 col-sm-4">
            <!-- SMALL ICON -->
            <input class="form-check-input d-none" data-attribute="data-main-layout" name="layoutsModes" value="small-icon" type="radio" id="smallIconSidebar">
            <label for="smallIconSidebar" class="switcher-card w-100">
              <span class="border d-block rounded h-100px overflow-hidden">
                <span class="d-flex h-100">
                  <span class="w-14px d-flex flex-column h-100 flex-shrink-0 border-end">
                    <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                    <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                      <span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                      </span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                  </span>
                  <span class="d-flex flex-column flex-grow-1">
                    <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                      <span class="d-flex align-items-center gap-1">
                        <span class="w-8px h-8px bg-danger rounded-pill"></span>
                        <span class="w-8px h-8px bg-success rounded-pill"></span>
                        <span class="w-8px h-8px bg-warning rounded-pill"></span>
                      </span>
                      <span class="w-8px h-8px bg-light rounded-pill"></span>
                    </span>
                    <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                      <span class="p-2">
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      </span>
                      <span class="w-100 bg-light h-6px ms-1"></span>
                    </span>
                  </span>
                </span>
              </span>
              <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Small Icon View</span>
            </label>
          </div>
        </div>
      </div>

      <!-- THEME -->
      <h6 class="mb-2 fs-5">Color Mode</h6>
      <p class="text-muted">Choose if app's appearance should be light or dark, or follow your computer's settings.</p>
      <div class="list-group flex-row gap-3 mb-3 template-customizer mb-5">
        <!-- LIGHT -->
        <label for="lightTheme" class="list-group-item p-2 form-check rounded m-0 hstack gap-3 w-max">
          <span class="form-check-label hstack gap-2">
            <i class="ri-sun-line"></i>
            <span class="fw-semibold fs-12">Light Theme</span>
          </span>
          <input id="lightTheme" type="radio" data-attribute="data-bs-theme" class="form-check-input" name="layoutsModes" value="light">
        </label>
        <!-- DARK -->
        <label for="darkTheme" class="list-group-item p-2 form-check rounded m-0 hstack gap-3 w-max">
          <span class="form-check-label hstack gap-2">
            <i class="ri-moon-clear-line"></i>
            <span class="fw-semibold fs-12">Dark Theme</span>
          </span>
          <input id="darkTheme" type="radio" data-attribute="data-bs-theme" class="form-check-input" name="layoutsModes" value="dark">
        </label>
        <!-- AUTO -->
        <label for="autoTheme" class="list-group-item p-2 form-check rounded m-0 hstack gap-3 w-max">
          <span class="form-check-label hstack gap-2">
            <i class="ri-computer-line"></i>
            <span class="fw-semibold fs-12">Auto Theme</span>
          </span>
          <input id="autoTheme" type="radio" data-attribute="data-bs-theme" class="form-check-input cursor-pointer ms-auto" name="layoutsModes" value="auto">
        </label>
      </div>

      <!-- RTL MODE -->
      <h6 class="mb-2 fs-5">RTL Mode</h6>
      <p class="text-muted">Toggle between LTR and RTL layouts to support different language directions.</p>

      <div class="row g-4 mb-5">
        <div class="col-4">
          <!-- LTR MODE -->
          <input class="form-check-input d-none" data-attribute="dir" name="directionModes" value="ltr" type="radio" id="ltrLayouts">
          <label for="ltrLayouts" class="switcher-card w-100">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">LTR Direction</span>
          </label>
        </div>
        <div class="col-4">
          <!-- RTL MODE -->
          <input class="form-check-input d-none" data-attribute="dir" name="directionModes" value="rtl" type="radio" id="rtlLayouts">
          <label for="rtlLayouts" class="switcher-card w-100">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2 vstack align-items-end">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px me-1"></span>
                  </span>
                </span>
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">RTL Direction</span>
          </label>
        </div>
      </div>

      <!-- THEME_COLOR -->
      <h6 class="mb-2 fs-5">Preset Themes</h6>
      <p class="text-muted">Choose a preset theme from out theme library.</p>
      <div class="list-group flex-row flex-wrap gap-2 mb-5 template-customizer">

        <!-- PRIMARY -->
        <label for="primary-variant-01" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="primary">
          <span class="form-check-label hstack avatar avatar-item theme-bg-primary rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-01" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="primary" checked>
        </label>

        <!-- SECONDARY -->
        <label for="primary-variant-02" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="secondary">
          <span class="form-check-label hstack avatar avatar-item theme-bg-secondary rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-02" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="secondary">
        </label>

        <!-- SUCCESS -->
        <label for="primary-variant-03" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="success">
          <span class="form-check-label hstack avatar avatar-item theme-bg-success rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-03" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="success">
        </label>

        <!-- INFO -->
        <label for="primary-variant-04" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="info">
          <span class="form-check-label hstack avatar avatar-item theme-bg-info rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-04" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="info">
        </label>

        <!-- WARNING -->
        <label for="primary-variant-05" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="warning">
          <span class="form-check-label hstack avatar avatar-item theme-bg-warning rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-05" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="warning">
        </label>

        <!-- DANGER -->
        <label for="primary-variant-06" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="danger">
          <span class="form-check-label hstack avatar avatar-item theme-bg-danger rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-06" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="danger">
        </label>

        <!-- BLUE -->
        <label for="primary-variant-09" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="blue">
          <span class="form-check-label hstack avatar avatar-item theme-bg-blue rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-09" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="blue">
        </label>

        <!-- PURPLE -->
        <label for="primary-variant-11" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="purple">
          <span class="form-check-label hstack avatar avatar-item theme-bg-purple rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-11" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="purple">
        </label>

        <!-- PINK -->
        <label for="primary-variant-12" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="pink">
          <span class="form-check-label hstack avatar avatar-item theme-bg-pink rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-12" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="pink">
        </label>

        <!-- ORANGE -->
        <label for="primary-variant-13" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="orange">
          <span class="form-check-label hstack avatar avatar-item theme-bg-orange rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-13" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="orange">
        </label>

        <!-- TEAL -->
        <label for="primary-variant-16" class="list-group-item form-check p-1 rounded-3 m-0" data-theme-color="teal">
          <span class="form-check-label hstack avatar avatar-item theme-bg-teal rounded-3 border-0">
            <i class="ri-palette-line"></i>
          </span>
          <input id="primary-variant-16" type="radio" data-attribute="data-theme-color" class="form-check-input d-none" name="data-theme-color" value="teal">
        </label>

      </div>

      <!-- SIDEBAR -->
      <h6 class="mb-2 fs-5">Sidebar Colors</h6>
      <p class="text-muted text-sm">Sets the sidebar color scheme. Options include light, dark, or gradient styles.</p>
      <div class="row g-4 mb-5">

        <div class="col-4">
          <!-- LIGHT SIDEBAR -->
          <input class="form-check-input d-none" data-attribute="data-sidebar" name="sidebar-color" value="light-sidebar" type="radio" id="sidebar-color-light" checked>
          <label for="sidebar-color-light" class="switcher-card w-100 active" data-sidebar="light-sidebar">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-20px bg-white border-bottom d-block"></span>
                  <span class="h-100 bg-white d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Light</span>
          </label>
        </div>

        <div class="col-4">
          <!-- DARK SIDEBAR -->
          <input class="form-check-input d-none" data-attribute="data-sidebar" name="sidebar-color" value="dark-sidebar" type="radio" id="sidebar-color-dark">
          <label for="sidebar-color-dark" class="switcher-card w-100" data-sidebar="dark-sidebar">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-20px bg-dark border-bottom d-block"></span>
                  <span class="h-100 bg-dark d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Dark</span>
          </label>
        </div>

        <div class="col-4">
          <!-- GRADIENT SIDEBAR -->
          <input class="form-check-input d-none" data-attribute="data-sidebar" name="sidebar-color" value="gradient-sidebar" type="radio" id="sidebar-color-gradient">
          <label for="sidebar-color-gradient" class="switcher-card w-100" data-sidebar="gradient-sidebar">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Gradient</span>
          </label>
        </div>

      </div>

      <!-- NAV_POSITION -->
      <h6 class="mb-2 fs-5">Navbar Positions Options</h6>
      <p class="text-muted">Sets the navbar position: sticky, static, or hidden.</p>

      <div class="row g-4 mb-5">
        <div class="col-4">
          <!-- STICKY -->
          <input class="form-check-input d-none" data-attribute="data-nav-position" name="navbarPositionsOption" value="sticky" type="radio" id="navbarPositionsSticky">
          <label for="navbarPositionsSticky" class="switcher-card w-100 active" data-nav-position="sticky">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Sticky</span>
          </label>
        </div>
        <div class="col-4">
          <!-- STATIC -->
          <input class="form-check-input d-none" data-attribute="data-nav-position" name="navbarPositionsOption" value="static" type="radio" id="navbarPositionsStatic">
          <label for="navbarPositionsStatic" class="switcher-card w-100" data-nav-position="static">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Static</span>
          </label>
        </div>
        <div class="col-4 nav-hidden">
          <!-- HIDDEN -->
          <input class="form-check-input d-none" data-attribute="data-nav-position" name="navbarPositionsOption" value="hidden" type="radio" id="navbarPositionsHidden">
          <label for="navbarPositionsHidden" class="switcher-card w-100" data-nav-position="hidden">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Hidden</span>
          </label>
        </div>
      </div>

      <!-- NAV_TYPE -->
      <h6 class="mb-2 fs-5">Navbar Type Options</h6>
      <p class="text-muted">Sets the navbar style: default, dark, transparent, or glass.</p>

      <div class="row g-4 mb-5">
        <div class="col-4">
          <!-- DEFAULT -->
          <input class="form-check-input d-none" data-attribute="data-nav-type" name="navbarTypeOption" value="default" type="radio" id="data-nav-default" checked>
          <label for="data-nav-default" class="switcher-card w-100 active" data-nav-type="default">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Default</span>
          </label>
        </div>
        <div class="col-4">
          <!-- DARK -->
          <input class="form-check-input d-none" data-attribute="data-nav-type" name="navbarTypeOption" value="dark" type="radio" id="data-nav-dark">
          <label for="data-nav-dark" class="switcher-card w-100" data-nav-type="dark">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between bg-dark">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Dark</span>
          </label>
        </div>
        <div class="col-4">
          <!-- GLASS -->
          <input class="form-check-input d-none" data-attribute="data-nav-type" name="navbarTypeOption" value="glass" type="radio" id="data-nav-glass">
          <label for="data-nav-glass" class="switcher-card w-100" data-nav-type="glass">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 h-20px bg-light border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-12px h-12px bg-secondary-subtle rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Glass</span>
          </label>
        </div>
      </div>

      <!-- FONT  -->
      <h6 class="mb-2 fs-5">Font Options</h6>
      <p class="text-muted">Sets the fonts for headings and body text.</p>
      <div class="row g-4 mb-5">
        <div class="col-12 col-sm-6">
          <!-- FONT_BODY -->
          <label class="form-label text-muted fw-semibold fs-12 d-block" for="body-font-choice">Body Font</label>
          <select class="form-select" id="body-font-choice" data-attribute="data-font-body">
            <option value="Inter">Inter</option>
            <option value="Poppins">Poppins</option>
            <option value="Roboto">Roboto</option>
            <option value="Open Sans">Open Sans</option>
            <option value="Lato">Lato</option>
          </select>
        </div>
        <div class="col-12 col-sm-6">
          <!-- FONT_HEADING -->
          <label class="form-label text-muted fw-semibold fs-12 d-block" for="heading-font-choice">Heading Font</label>
          <select class="form-select" id="heading-font-choice" data-attribute="data-font-heading">
            <option value="Inter">Inter</option>
            <option value="Poppins">Poppins</option>
            <option value="Roboto">Roboto</option>
            <option value="Open Sans">Open Sans</option>
            <option value="Lato">Lato</option>
          </select>
        </div>
      </div>

      <!-- FONT_SIZE -->
      <h6 class="mb-2 fs-5">Font Size Options</h6>
      <p class="text-muted">Sets the font size: sm, md, or lg.</p>

      <div class="list-group flex-row gap-3 mb-3 template-customizer mb-5">
        <!-- SM -->
        <label class="list-group-item form-check rounded mb-0">
          <span class="d-flex flex-fill my-1">
            <span class="form-check-label d-flex">
              <span class="fw-semibold">SM</span>
            </span>
            <input type="radio" data-attribute="data-font-size" class="form-check-input cursor-pointer ms-auto" name="font-size-options" value="sm">
          </span>
        </label>
        <!-- MD -->
        <label class="list-group-item form-check rounded mb-0">
          <span class="d-flex flex-fill my-1">
            <span class="form-check-label d-flex">
              <span class="fw-semibold">MD</span>
            </span>
            <input type="radio" data-attribute="data-font-size" class="form-check-input cursor-pointer ms-auto" name="font-size-options" value="md">
          </span>
        </label>
        <!-- LG -->
        <label class="list-group-item form-check rounded mb-0">
          <span class="d-flex flex-fill my-1">
            <span class="form-check-label d-flex">
              <span class="fw-semibold">LG</span>
            </span>
            <input type="radio" data-attribute="data-font-size" class="form-check-input cursor-pointer ms-auto" name="font-size-options" value="lg">
          </span>
        </label>
      </div>

      <!-- LAYOUT_ROUNDED -->
      <h6 class="mb-2 fs-5">Rounded Options</h6>
      <p class="text-muted">Sets the border radius size: xs, sm, md, lg, or xl.</p>

      <div class="list-group flex-row flex-wrap flex-sm-nowrap gap-3 mb-3 template-customizer mb-5">
        <!-- XS -->
        <label class="list-group-item form-check rounded mb-0">
          <span class="d-flex flex-fill my-1">
            <span class="form-check-label d-flex">
              <span class="fw-semibold">XS</span>
            </span>
            <input type="radio" data-attribute="data-layout-rounded" class="form-check-input cursor-pointer ms-auto" name="rounded-options" value="xs">
          </span>
        </label>
        <!-- SM -->
        <label class="list-group-item form-check rounded mb-0">
          <span class="d-flex flex-fill my-1">
            <span class="form-check-label d-flex">
              <span class="fw-semibold">SM</span>
            </span>
            <input type="radio" data-attribute="data-layout-rounded" class="form-check-input cursor-pointer ms-auto" name="rounded-options" value="sm">
          </span>
        </label>
        <!-- MD -->
        <label class="list-group-item form-check rounded mb-0">
          <span class="d-flex flex-fill my-1">
            <span class="form-check-label d-flex">
              <span class="fw-semibold">MD</span>
            </span>
            <input type="radio" data-attribute="data-layout-rounded" class="form-check-input cursor-pointer ms-auto" name="rounded-options" value="md">
          </span>
        </label>
        <!-- LG -->
        <label class="list-group-item form-check rounded mb-0">
          <span class="d-flex flex-fill my-1">
            <span class="form-check-label d-flex">
              <span class="fw-semibold">LG</span>
            </span>
            <input type="radio" data-attribute="data-layout-rounded" class="form-check-input cursor-pointer ms-auto" name="rounded-options" value="lg">
          </span>
        </label>
        <!-- XL -->
        <label class="list-group-item form-check rounded mb-0">
          <span class="d-flex flex-fill my-1">
            <span class="form-check-label d-flex">
              <span class="fw-semibold">XL</span>
            </span>
            <input type="radio" data-attribute="data-layout-rounded" class="form-check-input cursor-pointer ms-auto" name="rounded-options" value="xl">
          </span>
        </label>
      </div>

      <!-- LAYOUT_CONTAINER -->
      <div class="two-column-hidden">
        <h6 class="mb-2 fs-5">Container Options</h6>
        <p class="text-muted">Defines the container style: fluid (full-width) or boxed (fixed width).</p>
        <div class="row g-4 mb-5">
          <div class="col-4">
            <!-- FLUID -->
            <input class="form-check-input d-none" data-attribute="data-layout-container" name="layoutsContainer" value="fluid" type="radio" id="fluidLayouts" checked>
            <label for="fluidLayouts" class="switcher-card w-100 active" data-layout-container="fluid">
              <span class="border d-block rounded h-100px overflow-hidden">
                <span class="d-flex h-100">
                  <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                    <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                    <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                      <span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                      </span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                  </span>
                  <span class="d-flex flex-column flex-grow-1">
                    <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                      <span class="d-flex align-items-center gap-1">
                        <span class="w-8px h-8px bg-danger rounded-pill"></span>
                        <span class="w-8px h-8px bg-success rounded-pill"></span>
                        <span class="w-8px h-8px bg-warning rounded-pill"></span>
                      </span>
                      <span class="w-8px h-8px bg-light rounded-pill"></span>
                    </span>
                    <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                      <span class="p-2">
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      </span>
                      <span class="w-100 bg-light h-6px ms-1"></span>
                    </span>
                  </span>
                </span>
              </span>
              <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Default</span>
            </label>
          </div>
          <div class="col-4">
            <!-- BOXED -->
            <input class="form-check-input d-none" data-attribute="data-layout-container" name="layoutsContainer" value="boxed" type="radio" id="boxedLayouts">
            <label for="boxedLayouts" class="switcher-card w-100" data-layout-container="boxed">
              <span class="border d-block rounded h-100px overflow-hidden bg-secondary-subtle">
                <span class="d-flex h-100 mx-3 bg-white">
                  <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                    <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                    <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                      <span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                        <span class="h-6px bg-light rounded d-block mb-1"></span>
                      </span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                  </span>
                  <span class="d-flex flex-column flex-grow-1">
                    <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                      <span class="d-flex align-items-center gap-1">
                        <span class="w-8px h-8px bg-danger rounded-pill"></span>
                        <span class="w-8px h-8px bg-success rounded-pill"></span>
                        <span class="w-8px h-8px bg-warning rounded-pill"></span>
                      </span>
                      <span class="w-8px h-8px bg-light rounded-pill"></span>
                    </span>
                    <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                      <span class="p-2">
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                        <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      </span>
                      <span class="w-100 bg-light h-6px ms-1"></span>
                    </span>
                  </span>
                </span>
              </span>
              <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Boxed</span>
            </label>
          </div>
        </div>
      </div>

      <!-- PAGE_LOADER -->
      <h6 class="mb-2 fs-5">Loader Options</h6>
      <p class="text-muted">Sets the page loader visibility: hidden or visible.</p>
      <div class="row g-4">
        <div class="col-4">
          <!-- VISIBLE -->
          <input class="form-check-input d-none" data-attribute="data-page-loader" name="page-loader" value="visible" type="radio" id="page-loader-visible">
          <label for="page-loader-visible" class="switcher-card w-100" data-page-loader="visible">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1 h-100">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 d-flex flex-column justify-content-center align-items-center gap-3">
                    <span id="status" class="d-flex align-items-center justify-content-center">
                      <span class="spinner-border text-primary avatar-xxs m-auto" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </span>
                    </span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Loader</span>
          </label>
        </div>
        <div class="col-4">
          <!-- HIDDEN -->
          <input class="form-check-input d-none" data-attribute="data-page-loader" name="page-loader" value="hidden" type="radio" id="page-loader-hidden">
          <label for="page-loader-hidden" class="switcher-card w-100" data-page-loader="hidden">
            <span class="border d-block rounded h-100px overflow-hidden">
              <span class="d-flex h-100">
                <span class="w-30px d-flex flex-column h-100 flex-shrink-0 border-end">
                  <span class="h-16px flex-shrink-0 bg-light d-block"></span>
                  <span class="h-100 flex-grow-1 bg-primary-subtle d-flex flex-column justify-content-between p-1">
                    <span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                      <span class="h-6px bg-light rounded d-block mb-1"></span>
                    </span>
                    <span class="h-6px bg-light rounded d-block mb-1"></span>
                  </span>
                </span>
                <span class="d-flex flex-column flex-grow-1">
                  <span class="px-2 flex-shrink-0 h-16px border-bottom d-flex align-items-center gap-3 justify-content-between">
                    <span class="d-flex align-items-center gap-1">
                      <span class="w-8px h-8px bg-danger rounded-pill"></span>
                      <span class="w-8px h-8px bg-success rounded-pill"></span>
                      <span class="w-8px h-8px bg-warning rounded-pill"></span>
                    </span>
                    <span class="w-8px h-8px bg-light rounded-pill"></span>
                  </span>
                  <span class="h-100 flex-grow-1 d-flex flex-column justify-content-between gap-1">
                    <span class="p-2">
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-50 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-100 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-75 d-block bg-light rounded-1 h-6px mb-1"></span>
                      <span class="w-25 d-block bg-light rounded-1 h-6px mb-1"></span>
                    </span>
                    <span class="w-100 bg-light h-6px ms-1"></span>
                  </span>
                </span>
              </span>
            </span>
            <span class="d-block shadow-none fs-12 fw-semibold text-center pt-2">Disable</span>
          </label>
        </div>
      </div>
    </div>
    <div class="offcanvas-header border-top hstack gap-3 justify-content-center">
      <button type="button" id="resetSettings" class="btn btn-dark">Reset Layouts</button>
      <button type="button" class="btn btn-danger">Buy Now</button>
    </div>
  </div>
</div>
<!-- END SWITCHER -->
