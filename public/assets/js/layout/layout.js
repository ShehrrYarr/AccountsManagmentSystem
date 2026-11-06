
function updateLayout() {
  // Function to detect system preference (light or dark)
  function getSystemTheme() {
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? THEME_MODES.DARK : THEME_MODES.LIGHT;
  }
  function initializeSettings() {
    pageLoader();
    // Apply stored or default settings on page load
    if (DEFAULT_VALUES.AUTH_LAYOUT === false) {
      applySettings();

      // Handle changes in the modal
      handleModalChanges();

      // Add reset button functionality
      const resetButton = document.getElementById('resetSettings'); // Replace with your reset button ID
      if (resetButton) {
        resetButton.addEventListener('click', resetSettings);
      }
    }
    // Listen for system theme changes (if "system" mode is selected)
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
      const storedTheme = sessionStorage.getItem(ATTRIBUTES.THEME);
      if (storedTheme === THEME_MODES.SYSTEM) {
        applyTheme(THEME_MODES.SYSTEM);
      }
    });
  }

  // Function to apply the selected theme
  function applyTheme(theme) {
    let appliedTheme = theme;

    // If the theme is "system", use the system preference
    if (theme === THEME_MODES.SYSTEM) {
      appliedTheme = getSystemTheme();
    }

    // Update the theme attribute on the <html> element
    document.documentElement.setAttribute(ATTRIBUTES.THEME, appliedTheme);

    // Store the selected theme in sessionStorage
    sessionStorage.setItem(ATTRIBUTES.THEME, theme);
  }

  // Function to add/remove the 'active' class based on the selected input
  function updateActiveClass(attribute, value) {
    // Remove 'active' class from all labels with the same attribute
    document.querySelectorAll(`[data-attribute="${attribute}"]`).forEach((input) => {
      const label = input.nextElementSibling;
      if (label && label.classList.contains('switcher-card')) {
        label.classList.remove('active');
      } else {
        if (attribute === "data-font-body" || attribute === "data-font-heading")
          input.value = value;
        else
          input.closest('.list-group-item')?.classList.contains('form-check') ? input.closest('.list-group-item')?.classList.remove('active') : '';
      }
    });

    // Add 'active' class to the label of the selected input
    const selectedInput = document.querySelector(`[data-attribute="${attribute}"][value="${value}"]`);
    if (selectedInput) {
      const selectedLabel = selectedInput.nextElementSibling;
      if (selectedLabel && selectedLabel.classList.contains('switcher-card')) {
        selectedLabel.classList.add('active');
      } else {
        if (attribute === "data-font-body" || attribute === "data-font-heading")
          selectedInput.value = value;
        else
          selectedInput.closest('.list-group-item')?.classList.contains('form-check') ? selectedInput.closest('.list-group-item')?.classList.add('active') : '';
      }
    }
  }

  // Function to apply stored or default values to the DOM
  function applySettings() {
    Object.keys(ATTRIBUTES).forEach((key) => {
      const attribute = ATTRIBUTES[key];
      const value = sessionStorage.getItem(attribute) || DEFAULT_VALUES[attribute];
      document.documentElement.setAttribute(attribute, value);
      if (attribute !== "AUTH_LAYOUT")
        sessionStorage.setItem(attribute, value);
      updateActiveClass(attribute, value);
      if (attribute === ATTRIBUTES.MAIN_LAYOUT && value === 'horizontal')
        document.getElementById('sidebarMenu')?.classList.add('container-fluid');
      else if (attribute === ATTRIBUTES.MAIN_LAYOUT)
        document.getElementById('sidebarMenu')?.classList.remove('container-fluid');
      if (attribute === ATTRIBUTES.MAIN_LAYOUT && (value === 'vertical' || value === 'two-column'))
        initSimpleBar()
      if (attribute === ATTRIBUTES.DIRECTION_MODE)
        updateLayoutDirection(value);
    });

    // Apply the theme (handles system mode)
    const theme = sessionStorage.getItem(ATTRIBUTES.THEME) || DEFAULT_VALUES[ATTRIBUTES.THEME];
    applyTheme(theme);
  }

  updateLayoutDirection = (direction) => {
    setTimeout(() => {
      const bootstrapCss = document.getElementById('bootstrap-style');
      const appCss = document.getElementById('app-style');
      const customCss = document.getElementById('custom-style');
      if (bootstrapCss === null || appCss === null) return;
      if (direction === 'rtl') {
        bootstrapCss.href = bootstrapCss.href.replace('bootstrap.min.css', 'bootstrap-rtl.min.css');
        appCss.href = appCss.href.replace('app.min.css', 'app-rtl.min.css');
        customCss.href = customCss.href.replace('custom.min.css', 'custom-rtl.min.css');
      } else {
        bootstrapCss.href = bootstrapCss.href.replace('bootstrap-rtl.min.css', 'bootstrap.min.css');
        appCss.href = appCss.href.replace('app-rtl.min.css', 'app.min.css');
        customCss.href = customCss.href.replace('custom-rtl.min.css', 'custom.min.css');
      }
    }, 100);
  }

  // Function to remove SimpleBar completely
  function removeSimpleBarCompletely() {
    setTimeout(() => {
      const element = document.getElementById('sidebarMenu');

      if (element && element.classList.contains('simplebar')) {
        //   // Unmount the SimpleBar instance if it's there
        if (window.SimpleBar) {
          const simpleBarInstance = SimpleBar.instances.get(element);
          if (simpleBarInstance) {
            simpleBarInstance.unMount();  // Unmount and remove the instance
            const allMenus = document.getElementById('all-menu-items');
            if (allMenus) {
              element.innerHTML = allMenus.parentElement.innerHTML;
            }
            dropdownInit();
          }
        }
      }
    }, 500);
  }

  // Function to initialize SimpleBar
  function initSimpleBar() {
    setTimeout(() => {
      const sidebarMenu = document.getElementById('sidebarMenu');

      // Check if SimpleBar is already applied
      if (sidebarMenu) {
        const allMenus = document.getElementById('all-menu-items');
        if (allMenus) {
          sidebarMenu.innerHTML = allMenus.parentElement.innerHTML;
        }
        // Add 'simplebar' class to initialize it
        sidebarMenu.classList.add('simplebar');

        // Initialize SimpleBar for custom scrolling
        if (window.SimpleBar) {
          new SimpleBar(sidebarMenu);  // Initialize a new SimpleBar instance
          dropdownInit();
        }
      }
    }, 100);
  }

  setTimeout(() => {
    const sidebarToggle = document.querySelector(".sidebar-toggle");
    const smallScreenHorizontalToggle = document.querySelector(".small-screen-horizontal-toggle");
    const htmlElement = document.documentElement;
    const appSidebar = document.querySelector(".app-sidebar");
    const horizontalOverlay = document.querySelector(".horizontal-overlay");

    // Handle sidebar toggle click
    sidebarToggle?.addEventListener("click", () => {
      const currentState = htmlElement.getAttribute("data-main-layout");
      const newState = currentState === "small-icon" ? "vertical" : "small-icon";
      saveSetting("data-main-layout", newState);
    });

    // Handle sidebar toggle click
    smallScreenHorizontalToggle?.addEventListener("click", () => {
      appSidebar.classList.toggle("show");
      horizontalOverlay.classList.toggle("show");
    });
  }, 100);

  // Function to save a setting to sessionStorage and apply it to the DOM
  function saveSetting(attribute, value) {
    if (attribute === ATTRIBUTES.MAIN_LAYOUT) {
      if (value === 'vertical' || value === 'two-column') {
        initSimpleBar();
        setTimeout(() => {
          findActiveMenu(value);
        }, 0);
      } else {
        setTimeout(() => {
          removeSimpleBarCompletely();
        }, 0);
      }
      if (value === 'horizontal')
        document.getElementById('sidebarMenu')?.classList.add('container-fluid');
      else
        document.getElementById('sidebarMenu')?.classList.remove('container-fluid');
    }
    if (attribute !== "AUTH_LAYOUT")
      sessionStorage.setItem(attribute, value);
    document.documentElement.setAttribute(attribute, value);

    if (attribute === ATTRIBUTES.DIRECTION_MODE)
      updateLayoutDirection(value);

    // If the theme is updated, apply it
    if (attribute === ATTRIBUTES.THEME) {
      applyTheme(value);
    }

    // Update the active class for the corresponding input
    updateActiveClass(attribute, value);
  }

  // Function to reset all settings to default
  function resetSettings() {
    Object.keys(DEFAULT_VALUES).forEach((attribute) => {
      saveSetting(attribute, DEFAULT_VALUES[attribute]);
    });
  }

  // Function to handle changes in the modal
  function handleModalChanges() {
    const modal = document.getElementById('switcher'); // Replace with your modal ID
    if (!modal) return;
    modal.addEventListener('change', (event) => {
      const target = event.target;

      // Check if the changed element has a data-attribute
      const attribute = target.getAttribute('data-attribute');
      if (!attribute) return;

      const value = target.value;
      saveSetting(attribute, value);
      updateActiveClass(attribute, value);
    });
  }

  // Function to handle the page loader
  function pageLoader() {
    var preloader = document.getElementById('preloader');
    if (preloader && ATTRIBUTES.PAGE_LOADER !== "hidden") {
      setTimeout(function () {
        preloader.classList.add("hidden");
      }, 1500);
    } else {
      preloader?.classList.add("hidden");
    }
  }

  // Function to handle layout change on medium screen sizes
  function mediumScreenSidebar() {
    const layoutElement = sessionStorage.getItem('data-main-layout');
    if (layoutElement && layoutElement !== 'horizontal') {
      if (window.innerWidth < 768.99) {
        sessionStorage.setItem(ATTRIBUTES.MAIN_LAYOUT, "close-sidebar");
      } else if (window.innerWidth < 1250) {
        sessionStorage.setItem(ATTRIBUTES.MAIN_LAYOUT, "small-icon");
      } else {
        sessionStorage.setItem(ATTRIBUTES.MAIN_LAYOUT, "vertical");
      }
      document.documentElement.setAttribute(ATTRIBUTES.MAIN_LAYOUT, sessionStorage.getItem(ATTRIBUTES.MAIN_LAYOUT)); // Apply the layout
    }
  }

  // Function to initialize the settings
  
  /// Initialize settings when the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', () => {
    initializeSettings();
    const lightButton = document.getElementById('light-theme');
    const darkButton = document.getElementById('dark-theme');
    const systemButton = document.getElementById('system-theme');
    lightButton?.addEventListener('click', () => { applyTheme(THEME_MODES.LIGHT); updateActiveClass('data-bs-theme', 'light'); });
    darkButton?.addEventListener('click', () => { applyTheme(THEME_MODES.DARK); updateActiveClass('data-bs-theme', 'dark'); });
    systemButton?.addEventListener('click', () => { applyTheme(THEME_MODES.SYSTEM); updateActiveClass('data-bs-theme', 'auto'); });
  });

  if (DEFAULT_VALUES.AUTH_LAYOUT === false) {
    initializeSettings();
    applySettings();
    window.addEventListener('resize', mediumScreenSidebar);
  } else {
    document.documentElement.setAttribute('data-main-layout', 'close-sidebar');
    document.documentElement.setAttribute('data-nav-position', 'hidden');
  }
  pageLoader();

  // Update layout on window resize
}
console.log("AUTH_LAYOUT is", DEFAULT_VALUES.AUTH_LAYOUT);
console.log(window.DEFAULT_VALUES);
updateLayout();
