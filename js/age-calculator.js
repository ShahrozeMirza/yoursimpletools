var DAY_NAMES = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
var MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

var dobInput = document.getElementById('dob-input');
var asofInput = document.getElementById('asof-input');
var btnCalculate = document.getElementById('btn-calculate');
var errorNotice = document.getElementById('error-notice');
var errorMessage = document.getElementById('error-message');
var resultsContainer = document.getElementById('results-container');

// Set default "as of" date to today
var today = new Date();
var todayStr = today.getFullYear() + '-'
  + String(today.getMonth() + 1).padStart(2, '0') + '-'
  + String(today.getDate()).padStart(2, '0');
asofInput.value = todayStr;
dobInput.setAttribute('max', todayStr);

function showError(msg) {
  errorMessage.textContent = msg;
  errorNotice.classList.remove('hidden');
  resultsContainer.classList.add('hidden');
}

function hideError() {
  errorNotice.classList.add('hidden');
}

function getZodiac(month, day) {
  if ((month === 3 && day >= 21) || (month === 4 && day <= 19)) return 'Aries';
  if ((month === 4 && day >= 20) || (month === 5 && day <= 20)) return 'Taurus';
  if ((month === 5 && day >= 21) || (month === 6 && day <= 20)) return 'Gemini';
  if ((month === 6 && day >= 21) || (month === 7 && day <= 22)) return 'Cancer';
  if ((month === 7 && day >= 23) || (month === 8 && day <= 22)) return 'Leo';
  if ((month === 8 && day >= 23) || (month === 9 && day <= 22)) return 'Virgo';
  if ((month === 9 && day >= 23) || (month === 10 && day <= 22)) return 'Libra';
  if ((month === 10 && day >= 23) || (month === 11 && day <= 21)) return 'Scorpio';
  if ((month === 11 && day >= 22) || (month === 12 && day <= 21)) return 'Sagittarius';
  if ((month === 12 && day >= 22) || (month === 1 && day <= 19)) return 'Capricorn';
  if ((month === 1 && day >= 20) || (month === 2 && day <= 18)) return 'Aquarius';
  return 'Pisces';
}

function calculateAge() {
  var dobVal = dobInput.value;
  var asofVal = asofInput.value;

  if (!dobVal) {
    showError('Please enter your date of birth.');
    return;
  }

  if (!asofVal) {
    showError('Please enter the "Calculate Age As Of" date.');
    return;
  }

  // Parse dates at noon to avoid DST edge cases
  var dob = new Date(dobVal + 'T12:00:00');
  var asof = new Date(asofVal + 'T12:00:00');

  if (dob > asof) {
    showError('Date of birth cannot be after the "Calculate Age As Of" date.');
    return;
  }

  hideError();

  // Precise calendar years, months, days
  var years = asof.getFullYear() - dob.getFullYear();
  var months = asof.getMonth() - dob.getMonth();
  var days = asof.getDate() - dob.getDate();

  if (days < 0) {
    months--;
    var daysInPrevMonth = new Date(asof.getFullYear(), asof.getMonth(), 0).getDate();
    days += daysInPrevMonth;
  }

  if (months < 0) {
    years--;
    months += 12;
  }

  // Totals
  var totalDays = Math.floor((asof - dob) / 86400000);
  var totalMonths = years * 12 + months;
  var totalWeeks = Math.floor(totalDays / 7);
  var totalHours = totalDays * 24;
  var totalMinutes = totalHours * 60;

  // Birthday info
  var dayOfWeek = DAY_NAMES[dob.getDay()];

  var nextBirthday = new Date(asof.getFullYear(), dob.getMonth(), dob.getDate());
  if (nextBirthday <= asof) {
    nextBirthday = new Date(asof.getFullYear() + 1, dob.getMonth(), dob.getDate());
  }
  var daysUntilBirthday = Math.ceil((nextBirthday - asof) / 86400000);
  var nextBirthdayFormatted = DAY_NAMES[nextBirthday.getDay()] + ', '
    + MONTH_NAMES[nextBirthday.getMonth()] + ' '
    + nextBirthday.getDate() + ' '
    + nextBirthday.getFullYear();
  var nextAge = nextBirthday.getFullYear() - dob.getFullYear();

  // Zodiac
  var zodiac = getZodiac(dob.getMonth() + 1, dob.getDate());

  // Fun facts
  var heartbeats = Math.floor(totalMinutes * 70);
  var breaths = Math.floor(totalMinutes * 15);
  var sleptDays = Math.floor(totalDays * 8 / 24);

  // Render primary result
  document.getElementById('age-primary').textContent = years + ' years old';
  document.getElementById('age-formatted').textContent =
    years.toLocaleString() + ' Years, ' +
    months.toLocaleString() + ' Months, ' +
    days.toLocaleString() + ' Days';

  // Render detailed breakdown
  document.getElementById('total-years').textContent = years.toLocaleString();
  document.getElementById('total-months').textContent = totalMonths.toLocaleString();
  document.getElementById('total-weeks').textContent = totalWeeks.toLocaleString();
  document.getElementById('total-days').textContent = totalDays.toLocaleString();
  document.getElementById('total-hours').textContent = totalHours.toLocaleString();
  document.getElementById('total-minutes').textContent = totalMinutes.toLocaleString();

  // Render birthday info
  document.getElementById('born-day-text').textContent =
    'You were born on a ' + dayOfWeek;
  document.getElementById('days-until-text').textContent =
    'Your next birthday is in ' + daysUntilBirthday + ' days';
  document.getElementById('next-date-text').textContent =
    'Your next birthday is on ' + nextBirthdayFormatted;
  document.getElementById('next-age-text').textContent =
    'You will turn ' + nextAge;
  document.getElementById('zodiac-text').textContent = zodiac;

  // Render fun facts
  document.getElementById('fact-heartbeats-text').textContent =
    'Your heart has beaten approximately ' + heartbeats.toLocaleString() + ' times (avg 70 beats per minute)';
  document.getElementById('fact-breaths-text').textContent =
    'You have taken approximately ' + breaths.toLocaleString() + ' breaths (avg 15 breaths per minute)';
  document.getElementById('fact-sleep-text').textContent =
    'You have slept approximately ' + sleptDays.toLocaleString() + ' days (avg 8 hours per day)';

  // Show results
  resultsContainer.classList.remove('hidden');
}

btnCalculate.addEventListener('click', calculateAge);

function autoCalculate() {
  if (dobInput.value && asofInput.value) {
    calculateAge();
  }
}

dobInput.addEventListener('change', autoCalculate);
asofInput.addEventListener('change', autoCalculate);
