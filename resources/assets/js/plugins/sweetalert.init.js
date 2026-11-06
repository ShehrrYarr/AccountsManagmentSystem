/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: sweetalert.init.js
*/
const commonAlertOptions = {
    customClass: {
        confirmButton: 'btn btn-primary',
        denyButton: 'btn btn-warning',
        cancelButton: 'btn btn-secondary'
    }
};

const alerts = {
    basicMessage: () => Swal.fire("Any fool can use a computer", '', 'info', commonAlertOptions),

    titleText: () => Swal.fire("The Internet?", "That thing is still around?", "question", commonAlertOptions),

    errorType: () => Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
        ...commonAlertOptions
    }),

    customHtml: () => Swal.fire({
        title: '<h2 class="fs-5">Welcome to Our Platform!</h2>',
        icon: "info",
        html: `
            <p class="mb-4">We're thrilled to share the latest features designed to enhance your experience:</p>
            <ul class="list-group">
                <li class="list-group-item border-0 py-1">
                    <i class="ri-search-line me-2 text-primary"></i>Enhanced Search Functionality
                </li>
                <li class="list-group-item border-0 py-1">
                    <i class="ri-bar-chart-line me-2 text-success"></i>Improved Analytics Dashboard
                </li>
                <li class="list-group-item border-0 py-1">
                    <i class="ri-user-line me-2 text-warning"></i>User-Friendly Interface Updates
                </li>
            </ul>
            <p class="mt-4 mb-0">Join us as we continue to evolve and innovate!</p>
    `,
        // html: 'You can use <b>bold text</b>, <a href="//sweetalert2.github.io" class="btn btn-link">links</a> and other HTML tags',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: '<i class="ri-thumb-up-line"></i> Great!',
        cancelButtonText: 'Cancel <i class="ri-thumb-down-line"></i>',
        ...commonAlertOptions
    }),

    threeButtons: () => Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save As",
        denyButtonText: "Don't save",
        ...commonAlertOptions
    }).then(result => {
        if (result.isConfirmed) {
            Swal.fire("Saved!", "", "success");
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    }),

    customPosition: () => Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500,
    }),

    customImage: () => Swal.fire({
        title: "Herozi!",
        text: "Modal with a Brand Logo.",
        imageUrl: "https://via.placeholder.com/80",
        imageWidth: 80,
        imageHeight: 80,
        imageAlt: "Custom image",
        ...commonAlertOptions
    }),

    customWidth: () => Swal.fire({
        title: "Custom width, padding, background.",
        width: 600,
        padding: 50,
        background: "rgba(254,254,254,0.01) url(https://via.placeholder.com/600)",
        backgroundSize: "cover",
        backgroundPosition: "center",
        ...commonAlertOptions
    }),

    rtl: () => Swal.fire({
        title: "هل تريد الاستمرار؟",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        showCancelButton: true,
        showCloseButton: true,
        // ...commonAlertOptions
    }),

    timer: () => {
        let timerInterval;
        Swal.fire({
            title: "Auto close alert!",
            html: "I will close in <b></b> milliseconds.",
            timer: 2000, // Set timer to 20 seconds
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                    const content = Swal.getHtmlContainer(); // Get the HTML container
                    if (content) {
                        const b = content.querySelector("b");
                        if (b) {
                            b.textContent = Swal.getTimerLeft(); // Update remaining time
                        }
                    }
                }, 100); // Update every 100 milliseconds
            },
            willClose: () => {
                clearInterval(timerInterval); // Clear the interval when closing
            },
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            ...commonAlertOptions
        });
    },

    warningConfirm: () => Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        ...commonAlertOptions
    }).then(result => {
        if (result.isConfirmed) {
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
    }),

    handleDismiss: () => Swal.fire({
        buttonsStyling: false,
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
        ...commonAlertOptions
    }).then(result => {
        if (result.isConfirmed) {
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        } else (
            Swal.fire("Cancelled!", "Your imaginary file is safe :)", "error")
        )
    }),

    ajaxRequest: () => Swal.fire({
        title: "Submit your Github username",
        input: "text",
        inputAttributes: { autocapitalize: "off" },
        showCancelButton: true,
        confirmButtonText: "Look up",
        showLoaderOnConfirm: true,
        preConfirm: (username) => fetch(`https://api.github.com/users/${username}`)
            .then(response => {
                if (!response.ok) throw new Error(response.statusText);
                return response.json();
            }).catch(() => {
                Swal.showValidationMessage("Request failed");
            }),
        allowOutsideClick: () => !Swal.isLoading(),
        ...commonAlertOptions
    }).then(result => {
        if (result.isConfirmed) {
            Swal.fire({
                title: `${result.value.login}'s avatar`,
                imageUrl: result.value.avatar_url,
                ...commonAlertOptions
            });
        }
    }),

    showSuccessToast: () => ToastMixin.fire({
        icon: "success",
        title: "Signed in successfully"
    }),

    showErrorToast: () => ToastMixin.fire({
        icon: "error",
        title: "Error occurred while signing in"
    }),

    showWarningToast: () => ToastMixin.fire({
        icon: "warning",
        title: "Please check your details"
    }),

    showInfoToast: () => ToastMixin.fire({
        icon: "info",
        title: "You have new notifications"
    })
};

function executeAlert(key) {
    const alertFunc = alerts[key];
    if (alertFunc) {
        alertFunc();
    } else {
        console.warn(`Alert "${key}" not found.`);
    }
}

// Add event listeners for buttons with data-alert attribute
document.querySelectorAll('button[data-alert]').forEach(button => {
    button.addEventListener('click', () => {
        const alertKey = button.getAttribute('data-alert');
        executeAlert(alertKey);
    });
});


const ToastMixin = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 30000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});
