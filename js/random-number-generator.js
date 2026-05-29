document.addEventListener('DOMContentLoaded', function () {

  var singleHistory = [];

  // -----------------------------------------------
  // Helper functions
  // -----------------------------------------------

  function getVal(id) {
    var el = document.getElementById(id);
    if (!el) return 0;
    var v = parseFloat(el.value);
    return isNaN(v) ? 0 : v;
  }

  function cryptoRandom(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    var range = max - min + 1;
    var array = new Uint32Array(1);
    crypto.getRandomValues(array);
    return min + (array[0] % range);
  }

  function shuffle(array) {
    for (var i = array.length - 1; i > 0; i--) {
      var j = cryptoRandom(0, i);
      var temp = array[i];
      array[i] = array[j];
      array[j] = temp;
    }
    return array;
  }

  // -----------------------------------------------
  // Error display helpers
  // -----------------------------------------------

  function showError(boxId, msgId, message) {
    var box = document.getElementById(boxId);
    var msg = document.getElementById(msgId);
    if (!box || !msg) return;
    msg.textContent = message;
    box.classList.remove('hidden');
  }

  function hideError(boxId) {
    var box = document.getElementById(boxId);
    if (box) box.classList.add('hidden');
  }

  // -----------------------------------------------
  // Single number generation
  // -----------------------------------------------

  function animateSingleResult(el) {
    el.classList.add('is-animating');
    el.getBoundingClientRect();
    el.classList.remove('is-animating');
  }

  function updateHistory() {
    var container = document.getElementById('single-history');
    if (!container) return;
    container.innerHTML = '';

    if (singleHistory.length === 0) {
      var empty = document.createElement('span');
      empty.className = 'rng-empty-state';
      empty.textContent = 'No numbers generated yet';
      container.appendChild(empty);
      return;
    }

    singleHistory.forEach(function (num) {
      var chip = document.createElement('button');
      chip.type = 'button';
      chip.className = 'rng-chip';
      chip.textContent = num;
      chip.setAttribute('aria-label', 'Copy ' + num + ' to clipboard');
      chip.addEventListener('click', function () {
        navigator.clipboard.writeText(String(num)).catch(function () {});
      });
      container.appendChild(chip);
    });
  }

  function generateSingle() {
    var min = getVal('single-min');
    var max = getVal('single-max');

    if (min > max) {
      showError('single-error', 'single-error-msg', 'Minimum must be less than or equal to maximum');
      return;
    }

    hideError('single-error');

    var result = cryptoRandom(min, max);
    var resultEl = document.getElementById('single-result');
    if (resultEl) {
      resultEl.textContent = result;
      resultEl.classList.remove('is-empty');
      animateSingleResult(resultEl);
    }

    singleHistory.unshift(result);
    if (singleHistory.length > 10) {
      singleHistory.pop();
    }
    updateHistory();
  }

  // -----------------------------------------------
  // Multiple numbers generation
  // -----------------------------------------------

  function generateMultiple() {
    var min = getVal('multi-min');
    var max = getVal('multi-max');
    var quantity = getVal('multi-quantity');
    var allowDupsEl = document.getElementById('allow-duplicates');
    var sortEl = document.getElementById('sort-results');
    var allowDups = allowDupsEl ? allowDupsEl.checked : true;
    var sort = sortEl ? sortEl.checked : false;

    var resultEl = document.getElementById('multi-result');
    var countEl = document.getElementById('multi-count');

    if (min > max) {
      showError('multi-error', 'multi-error-msg', 'Minimum must be less than or equal to maximum');
      return;
    }

    hideError('multi-error');

    quantity = Math.floor(quantity);
    if (quantity < 1) quantity = 1;
    if (quantity > 1000) quantity = 1000;

    var range = max - min + 1;

    if (!allowDups && quantity > range) {
      showError(
        'multi-error',
        'multi-error-msg',
        'Cannot generate ' + quantity + ' unique numbers in range ' + min + ' to ' + max + '. Maximum unique numbers: ' + range
      );
      return;
    }

    var numbers = [];

    if (allowDups) {
      for (var i = 0; i < quantity; i++) {
        numbers.push(cryptoRandom(min, max));
      }
    } else {
      var pool = [];
      for (var n = min; n <= max; n++) {
        pool.push(n);
      }
      shuffle(pool);
      numbers = pool.slice(0, quantity);
    }

    if (sort) {
      numbers.sort(function (a, b) { return a - b; });
    }

    if (resultEl) {
      resultEl.textContent = numbers.join(', ');
      resultEl.classList.remove('is-placeholder');
    }

    if (countEl) {
      countEl.textContent = 'Generated ' + quantity + ' number' + (quantity !== 1 ? 's' : '');
    }
  }

  // -----------------------------------------------
  // Copy functions
  // -----------------------------------------------

  function copyWithFeedback(btnId, originalLabel, textFn) {
    var btn = document.getElementById(btnId);
    if (!btn) return;
    var text = textFn();
    if (!text) return;

    navigator.clipboard.writeText(text).then(function () {
      var span = btn.querySelector('span');
      if (span) {
        span.textContent = 'Copied!';
        setTimeout(function () {
          span.textContent = originalLabel;
        }, 2000);
      }
    }).catch(function () {});
  }

  function copySingleResult() {
    var resultEl = document.getElementById('single-result');
    if (!resultEl || resultEl.classList.contains('is-empty')) return;
    var text = resultEl.textContent.trim();
    if (!text || text === '--') return;

    copyWithFeedback('single-copy-btn', 'Copy Number', function () {
      return text;
    });
  }

  function copyMultiResult() {
    var resultEl = document.getElementById('multi-result');
    if (!resultEl || resultEl.classList.contains('is-placeholder')) return;
    var text = resultEl.textContent.trim();
    if (!text || text === 'Numbers will appear here') return;

    copyWithFeedback('multi-copy-btn', 'Copy All Numbers', function () {
      return text;
    });
  }

  // -----------------------------------------------
  // Clear history
  // -----------------------------------------------

  function clearHistory() {
    singleHistory = [];
    updateHistory();
  }

  // -----------------------------------------------
  // Quick tools
  // -----------------------------------------------

  function flipCoin() {
    var result = cryptoRandom(0, 1);
    var text = result === 0 ? 'Heads' : 'Tails';
    var resultEl = document.getElementById('coin-result');
    if (!resultEl) return;

    resultEl.textContent = text;
    resultEl.classList.remove('is-placeholder', 'rng-result-heads', 'rng-result-tails');

    if (result === 0) {
      resultEl.classList.add('rng-result-heads');
    } else {
      resultEl.classList.add('rng-result-tails');
    }
  }

  function rollDice() {
    var sidesEl = document.getElementById('dice-sides');
    var sides = sidesEl ? parseInt(sidesEl.value, 10) : 6;
    var result = cryptoRandom(1, sides);

    var resultEl = document.getElementById('dice-result');
    var subEl = document.getElementById('dice-result-sub');

    if (resultEl) {
      resultEl.textContent = result;
      resultEl.classList.remove('is-placeholder');
    }

    if (subEl) {
      subEl.textContent = 'd' + sides + ' rolled';
    }
  }

  function getLucky() {
    var result = cryptoRandom(1, 9);
    var resultEl = document.getElementById('lucky-result');
    if (resultEl) {
      resultEl.textContent = result;
      resultEl.classList.remove('is-placeholder');
    }
  }

  // -----------------------------------------------
  // Enter key support on inputs
  // -----------------------------------------------

  function addEnterListener(id, fn) {
    var el = document.getElementById(id);
    if (!el) return;
    el.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') fn();
    });
  }

  addEnterListener('single-min', generateSingle);
  addEnterListener('single-max', generateSingle);
  addEnterListener('multi-min', generateMultiple);
  addEnterListener('multi-max', generateMultiple);
  addEnterListener('multi-quantity', generateMultiple);

  // -----------------------------------------------
  // Event listeners
  // -----------------------------------------------

  var singleGenBtn = document.getElementById('single-generate-btn');
  if (singleGenBtn) singleGenBtn.addEventListener('click', generateSingle);

  var multiGenBtn = document.getElementById('multi-generate-btn');
  if (multiGenBtn) multiGenBtn.addEventListener('click', generateMultiple);

  var singleCopyBtn = document.getElementById('single-copy-btn');
  if (singleCopyBtn) singleCopyBtn.addEventListener('click', copySingleResult);

  var multiCopyBtn = document.getElementById('multi-copy-btn');
  if (multiCopyBtn) multiCopyBtn.addEventListener('click', copyMultiResult);

  var clearHistoryBtn = document.getElementById('clear-history-btn');
  if (clearHistoryBtn) clearHistoryBtn.addEventListener('click', clearHistory);

  var coinFlipBtn = document.getElementById('coin-flip-btn');
  if (coinFlipBtn) coinFlipBtn.addEventListener('click', flipCoin);

  var diceRollBtn = document.getElementById('dice-roll-btn');
  if (diceRollBtn) diceRollBtn.addEventListener('click', rollDice);

  var luckyBtn = document.getElementById('lucky-btn');
  if (luckyBtn) luckyBtn.addEventListener('click', getLucky);

  // -----------------------------------------------
  // Initialize
  // -----------------------------------------------

  updateHistory();

});
