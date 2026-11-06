/*
Template Name: Herozi - Admin & Dashboard Template
Author: SRBThemes
Contact: sup.srbthemes@gmail.com
File: Coming Soon init js
*/

const countdown = document.getElementById("countdown");
if (countdown) {
  const SECOND = 1000,
    MINUTE = SECOND * 60,
    HOUR = MINUTE * 60,
    DAY = HOUR * 24;

  function getNextBirthday() {
    const today = new Date();
    const currentYear = today.getFullYear();
    const birthdayDate = new Date(`${currentYear}-9-7`);

    // If the birthday has already passed this year, use the next year
    if (today > birthdayDate) {
      birthdayDate.setFullYear(currentYear + 1);
    }

    return birthdayDate.getTime();
  }

  function updateCountdown(countDown) {
    const now = new Date().getTime();
    const distance = countDown - now;

    document.getElementById("days").innerText = Math.floor(distance / DAY);
    document.getElementById("hours").innerText = Math.floor((distance % DAY) / HOUR);
    document.getElementById("minutes").innerText = Math.floor((distance % HOUR) / MINUTE);
    document.getElementById("seconds").innerText = Math.floor((distance % MINUTE) / SECOND);

    // Check if the countdown is finished
    if (distance < 0) {
      document.getElementById("headline").innerText = "It's my birthday!";
      document.getElementById("countdown").style.display = "none";
      clearInterval(interval);
    }
  }

  const countDown = getNextBirthday();
  const interval = setInterval(() => updateCountdown(countDown), 1000);
}
