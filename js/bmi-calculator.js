document.addEventListener('DOMContentLoaded', function () {
  var NORMAL_BMI_MIN = 18.5;
  var NORMAL_BMI_MAX = 24.9;

  var currentUnit = 'metric';

  function getVal(id) {
    return parseFloat(document.getElementById(id).value) || 0;
  }

  function getBMICategory(bmi) {
    if (bmi < 18.5) return 'Underweight';
    if (bmi < 25) return 'Normal weight';
    if (bmi < 30) return 'Overweight';
    if (bmi < 35) return 'Obese Class I';
    if (bmi < 40) return 'Obese Class II';
    return 'Obese Class III';
  }

  function getBMIColor(bmi) {
    if (bmi < 18.5) return '#3B82F6';
    if (bmi < 25) return '#1F6B57';
    if (bmi < 30) return '#F59E0B';
    if (bmi < 35) return '#EF4444';
    if (bmi < 40) return '#DC2626';
    return '#991B1B';
  }

  function getBMIBadgeClass(category) {
    switch (category) {
      case 'Underweight':   return 'bmi-badge-underweight';
      case 'Normal weight': return 'bmi-badge-normal';
      case 'Overweight':    return 'bmi-badge-overweight';
      case 'Obese Class I': return 'bmi-badge-obese1';
      case 'Obese Class II': return 'bmi-badge-obese2';
      default:              return 'bmi-badge-obese3';
    }
  }

  function showError(msg) {
    document.getElementById('bmi-error-msg').textContent = msg;
    document.getElementById('bmi-error').classList.remove('hidden');
  }

  function hideError() {
    document.getElementById('bmi-error').classList.add('hidden');
  }

  function clearResults() {
    document.getElementById('bmi-results').classList.add('hidden');
    document.getElementById('health-tips-container').classList.add('hidden');
    hideError();
  }

  function clearInputs() {
    var fieldIds = ['height-cm', 'weight-kg', 'height-ft', 'height-in', 'weight-lbs', 'age-input'];
    fieldIds.forEach(function (id) {
      document.getElementById(id).value = '';
    });
    document.getElementById('gender-input').value = '';
  }

  function updateToggleButtons() {
    var metricBtn = document.getElementById('btn-metric');
    var imperialBtn = document.getElementById('btn-imperial');
    if (currentUnit === 'metric') {
      metricBtn.className = 'bmi-unit-btn bmi-unit-btn--active';
      metricBtn.setAttribute('aria-pressed', 'true');
      imperialBtn.className = 'bmi-unit-btn';
      imperialBtn.setAttribute('aria-pressed', 'false');
    } else {
      metricBtn.className = 'bmi-unit-btn';
      metricBtn.setAttribute('aria-pressed', 'false');
      imperialBtn.className = 'bmi-unit-btn bmi-unit-btn--active';
      imperialBtn.setAttribute('aria-pressed', 'true');
    }
  }

  function switchToMetric() {
    currentUnit = 'metric';
    document.getElementById('metric-inputs').classList.remove('hidden');
    document.getElementById('imperial-inputs').classList.add('hidden');
    clearInputs();
    clearResults();
    updateToggleButtons();
  }

  function switchToImperial() {
    currentUnit = 'imperial';
    document.getElementById('metric-inputs').classList.add('hidden');
    document.getElementById('imperial-inputs').classList.remove('hidden');
    clearInputs();
    clearResults();
    updateToggleButtons();
  }

  function updateBMIScale(bmi) {
    var clampedBMI = Math.min(Math.max(bmi, 10), 45);
    var position = ((clampedBMI - 10) / (45 - 10)) * 100;
    document.getElementById('bmi-scale-pointer').style.left = position + '%';
  }

  function highlightCategoryRow(category) {
    var rows = document.querySelectorAll('#bmi-categories-table tbody tr');
    rows.forEach(function (row) {
      row.classList.remove('bmi-row-highlight');
      if (row.getAttribute('data-category') === category) {
        row.classList.add('bmi-row-highlight');
      }
    });
  }

  function showHealthTips(category) {
    var tipsContainer = document.getElementById('health-tips-container');
    tipsContainer.classList.remove('hidden');

    var allTipIds = ['tips-underweight', 'tips-normal', 'tips-overweight', 'tips-obese'];
    allTipIds.forEach(function (id) {
      document.getElementById(id).classList.add('hidden');
    });

    if (category === 'Underweight') {
      document.getElementById('tips-underweight').classList.remove('hidden');
    } else if (category === 'Normal weight') {
      document.getElementById('tips-normal').classList.remove('hidden');
    } else if (category === 'Overweight') {
      document.getElementById('tips-overweight').classList.remove('hidden');
    } else {
      document.getElementById('tips-obese').classList.remove('hidden');
    }
  }

  function calculate() {
    var bmi, heightM, totalInches, minHealthy, maxHealthy, weightUnit, currentWeight;

    if (currentUnit === 'metric') {
      var heightCm = getVal('height-cm');
      var weightKg = getVal('weight-kg');

      if (!heightCm || !weightKg) {
        showError('Please enter valid height and weight values.');
        return;
      }

      heightM = heightCm / 100;
      bmi = weightKg / (heightM * heightM);
      minHealthy = 18.5 * heightM * heightM;
      maxHealthy = 24.9 * heightM * heightM;
      weightUnit = 'kg';
      currentWeight = weightKg;
    } else {
      var heightFt = getVal('height-ft');
      var heightIn = getVal('height-in');
      var weightLbs = getVal('weight-lbs');

      if (!heightFt || !weightLbs) {
        showError('Please enter valid height and weight values.');
        return;
      }

      totalInches = (heightFt * 12) + heightIn;
      bmi = (weightLbs / (totalInches * totalInches)) * 703;
      minHealthy = (18.5 * totalInches * totalInches) / 703;
      maxHealthy = (24.9 * totalInches * totalInches) / 703;
      weightUnit = 'lbs';
      currentWeight = weightLbs;
    }

    hideError();

    var category = getBMICategory(bmi);
    var color = getBMIColor(bmi);
    var bmiPrime = bmi / 25;

    document.getElementById('bmi-value').textContent = bmi.toFixed(1);

    var categoryEl = document.getElementById('bmi-category');
    categoryEl.textContent = category;
    categoryEl.className = getBMIBadgeClass(category);

    document.getElementById('stat-bmi').textContent = bmi.toFixed(1);

    var statCategoryEl = document.getElementById('stat-category');
    statCategoryEl.textContent = category;
    statCategoryEl.style.color = color;

    document.getElementById('stat-healthy-range').textContent =
      minHealthy.toFixed(1) + ' - ' + maxHealthy.toFixed(1) + ' ' + weightUnit;

    document.getElementById('stat-bmi-prime').textContent = bmiPrime.toFixed(2);

    var weightDiffEl = document.getElementById('weight-diff-text');
    if (bmi > NORMAL_BMI_MAX) {
      var toLose = currentWeight - maxHealthy;
      weightDiffEl.textContent = 'To reach a healthy BMI, you need to lose approximately ' + toLose.toFixed(1) + ' ' + weightUnit + '.';
    } else if (bmi < NORMAL_BMI_MIN) {
      var toGain = minHealthy - currentWeight;
      weightDiffEl.textContent = 'To reach a healthy BMI, you need to gain approximately ' + toGain.toFixed(1) + ' ' + weightUnit + '.';
    } else {
      weightDiffEl.textContent = 'You are within the healthy weight range. Great job!';
    }

    updateBMIScale(bmi);
    highlightCategoryRow(category);
    showHealthTips(category);

    document.getElementById('bmi-results').classList.remove('hidden');
  }

  function reset() {
    clearInputs();
    clearResults();
    currentUnit = 'metric';
    document.getElementById('metric-inputs').classList.remove('hidden');
    document.getElementById('imperial-inputs').classList.add('hidden');
    updateToggleButtons();

    var rows = document.querySelectorAll('#bmi-categories-table tbody tr');
    rows.forEach(function (row) {
      row.classList.remove('bmi-row-highlight');
    });
  }

  document.getElementById('btn-metric').addEventListener('click', switchToMetric);
  document.getElementById('btn-imperial').addEventListener('click', switchToImperial);
  document.getElementById('calculate-btn').addEventListener('click', calculate);
  document.getElementById('reset-btn').addEventListener('click', reset);
});
