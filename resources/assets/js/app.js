document.addEventListener('DOMContentLoaded', () => {

  //tooltips
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

  // popover
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

  // SimpleBar
  const elements = document.querySelectorAll('[data-simplebar]');
  elements.forEach(el => {
    new SimpleBar(el);
  });

});

(function () {
  "use strict";
  document.querySelector('.horizontal-overlay').addEventListener('click', function () {
    document.querySelector('.small-screen-horizontal-toggle').click();
  });

  // Tagify User-profile, User-name select menu
  function tagifyUserProfileSelectMenu() {
    // User list with avatars, names, and emails
    const usersList = [
      { value: 1, name: 'Emma Smith', avatar: 'assets/images/avatar/avatar-1.jpg', email: 'e.smith@kpmg.com.au' },
      { value: 2, name: 'Max Smith', avatar: 'assets/images/avatar/avatar-2.jpg', email: 'max@kt.com' },
      { value: 3, name: 'Sean Bean', avatar: 'assets/images/avatar/avatar-3.jpg', email: 'sean@dellito.com' },
      { value: 4, name: 'Brian Cox', avatar: 'assets/images/avatar/avatar-4.jpg', email: 'brian@exchange.com' },
      { value: 5, name: 'Francis Mitcham', avatar: 'assets/images/avatar/avatar-5.jpg', email: 'f.mitcham@kpmg.com.au' },
      { value: 6, name: 'Dan Wilson', avatar: 'assets/images/avatar/avatar-6.jpg', email: 'dam@consilting.com' },
      { value: 7, name: 'Ana Crown', avatar: 'assets/images/avatar/avatar-7.jpg', email: 'ana.cf@limtel.com' },
      { value: 8, name: 'John Miller', avatar: 'assets/images/avatar/avatar-8.jpg', email: 'miller@mapple.com' }
    ];

    // Define custom template for tags
    function tagTemplate(tagData) {
      return `<tag title="${tagData.title || tagData.email}"
          contenteditable="false"
          spellcheck="false"
          class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
          ${this.getAttributes(tagData)}>
          <x title="" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x>
          <div class="d-flex align-items-center">
              <div class="tagify__tag__avatar-wrap ps-0">
                <img onerror="this.style.visibility='hidden'" class="img-fluid" src="${tagData.avatar}">
              </div>
              <span class="tagify__tag-text">${tagData.name}</span>
          </div>
      </tag>`;
    }

    // Define custom template for dropdown items
    function suggestionItemTemplate(tagData) {
      return `
      <div ${this.getAttributes(tagData)} class="tagify__dropdown__item d-flex align-items-start justify-content-start gap-2" tabindex="0" role="option">
          <img onerror="this.style.visibility='hidden'" class="rounded-circle avatar max-w-36px avatar-item" src="${tagData.avatar}">
          <div class="d-flex flex-column w-100">
              <strong class="text-truncate">${tagData.name}</strong>
              <span class="text-truncate">${tagData.email}</span>
          </div>
      </div>`;
    }

    // Select all the input fields that need Tagify applied
    var inputElements = document.querySelectorAll('[data-name="team-members"]');

    // Loop through each input field and initialize a Tagify instance
    inputElements.forEach(function (inputElm) {
      new Tagify(inputElm, {
        tagTextProp: 'name',
        enforceWhitelist: true,
        skipInvalid: true,
        dropdown: {
          closeOnSelect: true,  // Close the dropdown when selecting a suggestion
          enabled: 0,           // Disable auto-suggest when typing, show on click only
          classname: 'users-list',
          searchKeys: ['name', 'email']  // Allow searching by name or email
        },
        templates: {
          tag: tagTemplate,
          dropdownItem: suggestionItemTemplate
        },
        whitelist: usersList
      });
    });
  }

  function removeElement() {
    const deleteButtons = document.querySelectorAll('.delete-btn');  // Select all delete buttons
    deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
        // Show SweetAlert2 confirmation dialog
        Swal.fire({
          title: 'Are you sure?',
          text: "Are you sure you want to remove this item ?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            // If confirmed, find the closest parent element with the class 'delete-element' and remove it
            const parentElement = button.closest('.delete-element');
            if (parentElement) {
              parentElement.remove();  // Remove the element from the DOM
            }
          }
        });
      });
    });
  }

  function fullScreenSetup() {
    // Function to toggle fullscreen mode
    const toggleFullscreen = () => {
      const element = document.documentElement; // Fullscreen the entire page

      if (!document.fullscreenElement) {
        // Enter fullscreen
        if (element.requestFullscreen) {
          element.requestFullscreen();
        } else if (element.mozRequestFullScreen) { // Firefox
          element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) { // Chrome, Safari, and Opera
          element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) { // IE/Edge
          element.msRequestFullscreen();
        }
      } else {
        // Exit fullscreen
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.mozCancelFullScreen) { // Firefox
          document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) { // Chrome, Safari, and Opera
          document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { // IE/Edge
          document.msExitFullscreen();
        }
      }
    };

    // Add event listener to the fullscreen button
    const fullscreenButton = document.getElementById('fullscreen-button');
    if (fullscreenButton) {
      fullscreenButton.addEventListener('click', toggleFullscreen);
    }
  }

  function togglePassword() {
    const togglePassword = document.getElementsByClassName('.toggle-password');
    if (togglePassword) {
      document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
          const input = this.previousElementSibling; // Get the input element
          const icon = this.querySelector('.toggle-icon'); // Get the icon

          // Toggle the input type and visibility state
          const isVisible = input.getAttribute('data-visible') === 'true';
          input.setAttribute('type', isVisible ? 'password' : 'text');
          input.setAttribute('data-visible', !isVisible);
          icon.classList.toggle('ri-eye-off-line', isVisible);
          icon.classList.toggle('ri-eye-line', !isVisible);
        });
      });

      // Show password by default if data-visible is true
      document.querySelectorAll('input[data-visible="true"]').forEach(input => {
        input.setAttribute('type', 'text');
        const icon = input.nextElementSibling.querySelector('.toggle-icon');
        icon.classList.remove('ri-eye-off-line');
        icon.classList.add('ri-eye-line');
      });
    }
  }

  function clipboardButton() {
    const buttons = document.querySelectorAll('.clipboard-button');
    buttons.forEach(button => {
      button.addEventListener('click', () => {
        const action = button.dataset.clipboardAction;
        const container = button.closest('.clipboard-container');
        const targetInput = container.querySelector('.clipboard-input');

        // Get the selected text
        const selectedText = targetInput.value.substring(targetInput.selectionStart, targetInput.selectionEnd);
        const inputValue = selectedText || targetInput.value.trim(); // Use selected text or entire value

        if (inputValue === '') {
          return; // Exit the function if input is empty
        }

        if (action === 'copy') {
          navigator.clipboard.writeText(inputValue).then(() => {
            // Change the icon after copying
            const clipboardIcon = button.querySelector('.clipboard-icon');
            if (clipboardIcon) {
              clipboardIcon.classList.remove('ri-file-copy-line'); // Remove the copy icon
              clipboardIcon.classList.add('ri-check-double-line'); // Add a success icon
              button.dataset.bsTitle = 'Copied!'; // Update tooltip text

              // Reset icon and tooltip after a few seconds
              setTimeout(() => {
                clipboardIcon.classList.remove('ri-check-double-line');
                clipboardIcon.classList.add('ri-file-copy-line');
                button.dataset.bsTitle = 'Copy to clipboard!';
              }, 3000);
            }
          })
        } else if (action === 'cut') {
          navigator.clipboard.writeText(inputValue).then(() => {
            targetInput.value = '';
          });
        }

      });
    });
  }

  function qtyInputs() {
    const qtyInputs = document.querySelectorAll('.qty-input');
    qtyInputs.forEach(qtyInput => {
      const input = qtyInput.querySelector('input');

      qtyInput.querySelectorAll('button').forEach(button => {

        // Add event listener to buttons
        button.addEventListener('click', function () {
          const action = this.getAttribute('data-action');
          const min = parseInt(input.getAttribute('min'));
          const max = parseInt(input.getAttribute('max'));
          let currentVal = parseInt(input.value);

          // Update input value
          if (!isNaN(currentVal)) {
            if (action === 'minus' && currentVal > min) {
              currentVal -= 1;
            } else if (action === 'plus' && currentVal < max) {
              currentVal += 1;
            }
            input.value = currentVal;
          } else {
            input.value = min;
          }
        });
      });
    });
  }

  function customToggle() {
    const customToggle = document.querySelectorAll('.custom-toggle');
    customToggle.forEach(button => {
      button.addEventListener('click', () => {

        // Toggle the 'active' class
        button.classList.toggle('active');

        // Toggle aria-pressed attribute
        const isPressed = button.getAttribute('aria-pressed') === 'true';
        button.setAttribute('aria-pressed', !isPressed);
      });
    });
  }

  function btnLoader() {
    const btnLoader = document.querySelectorAll('.btn-loader');
    btnLoader.forEach(button => {
      button.addEventListener('click', function () {
        const originalText = this.querySelector('.indicator-label').textContent;
        const loadingText = this.getAttribute('data-loading-text');

        // Show loading indicator and disable button
        this.classList.add('loading');
        this.querySelector('.indicator-label').textContent = loadingText;
        this.disabled = true;

        // Simulate an asynchronous operation (e.g., form submission)
        setTimeout(() => {
          // Hide loading indicator and reset button
          this.classList.remove('loading');
          this.querySelector('.indicator-label').textContent = originalText;
          this.disabled = false;

        }, 1500); // Simulated delay of 2 seconds
      });
    });
  }

  function needsValidation() {
    const needsValidation = document.getElementsByClassName('.needs-validation');
    if (needsValidation) {
      // Select all forms with the class 'needs-validation'
      const forms = document.querySelectorAll('.needs-validation');

      // Iterate over each form to attach the submit event listener
      forms.forEach(form => {
        form.addEventListener('submit', (event) => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add('was-validated');
        });
      });
    }
  }

  function socialShareModal() {
    const shareModalEl = document.getElementById('shareModal');
    if (shareModalEl) {
      const shareLinkInput = document.getElementById('shareLink');
      const copyButton = document.getElementById('copyButton');

      // Set current page URL into the share link input
      const currentUrl = window.location.href;
      shareLinkInput.value = currentUrl;

      copyButton.addEventListener('click', async () => {
        try {
          await navigator.clipboard.writeText(shareLinkInput.value);

          // Show SweetAlert on success
          Swal.fire({
            icon: 'success',
            title: 'Link copied!',
            text: 'The link has been copied to your clipboard.',
            timer: 1500,
            showConfirmButton: false
          });

          // Close the modal after alert
          // If using Bootstrap 5 modal:
          const modalInstance = bootstrap.Modal.getInstance(shareModalEl);
          modalInstance.hide();

        } catch (err) {

          // Show SweetAlert on failure
          Swal.fire({
            icon: 'error',
            title: 'Copy failed',
            text: 'Something went wrong while copying.',
          });
          console.error('Failed to copy text: ', err);
        }
      });
    }
  }

  function handleSidebarToggle() {
    const sidebarOffCanvas = document.querySelector('#smallScreenSidebar');
    const offcanvas = new bootstrap.Offcanvas(sidebarOffCanvas);

    if (window.innerWidth <= 767.98) {
      sidebarOffCanvas.classList.remove('show');

      const backdrop = document.querySelector('.offcanvas-backdrop');
      if (backdrop) {
        backdrop.classList.remove('show'); // Remove the backdrop visibility
        document.body.classList.remove('offcanvas-backdrop'); // Remove backdrop-related classes from the body
      }

      offcanvas.hide();
    }
  }

  // Initialize application state and event listeners
  function init() {
    tagifyUserProfileSelectMenu();
    removeElement();
    fullScreenSetup();
    togglePassword();
    clipboardButton();
    qtyInputs();
    customToggle();
    btnLoader();
    needsValidation();
    socialShareModal();
    handleSidebarToggle();
  }

  // Run the app initialization
  init();

  // Add an event listener to handle resize events
  window.addEventListener('resize', handleSidebarToggle);
})();
