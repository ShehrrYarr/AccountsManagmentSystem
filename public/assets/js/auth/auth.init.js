/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Auth init js
*/

const otpInputs = document.querySelectorAll('[data-otp-input]');

if (otpInputs.length > 0) {
  document.addEventListener('DOMContentLoaded', () => {
    otpInputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        // Move focus to the next input if current input is filled
        if (input.value.length >= input.maxLength) {
          const nextInput = otpInputs[index + 1];
          if (nextInput) {
            nextInput.focus();
          } else {
            // If it's the last input, you can perform additional actions if needed
            input.blur(); // Optional: remove focus
          }
        }
      });

      input.addEventListener('keydown', (event) => {
        if (event.key === 'Backspace' && !input.value) {
          const previousInput = otpInputs[index - 1];
          if (previousInput) {
            previousInput.focus();
          }
        }
      });
    });

    otpInputs[0].focus(); // Focus on the first input
  });
}
