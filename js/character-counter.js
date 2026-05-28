document.addEventListener('DOMContentLoaded', function() {
  var textarea      = document.getElementById('char-input');
  var liveCount     = document.getElementById('live-count');
  var limitToggle   = document.getElementById('limit-toggle');
  var limitControls = document.getElementById('limit-controls');
  var limitInput    = document.getElementById('limit-input');
  var progressTrack = document.getElementById('progress-track');
  var progressBar   = document.getElementById('progress-bar');
  var remainingCount = document.getElementById('remaining-count');
  var presetButtons = document.getElementById('preset-buttons');
  var btnClear      = document.getElementById('btn-clear');
  var btnCopy       = document.getElementById('btn-copy');
  var btnCopyLabel  = document.getElementById('btn-copy-label');

  var statTotal    = document.getElementById('stat-total');
  var statNoSpaces = document.getElementById('stat-no-spaces');
  var statLetters  = document.getElementById('stat-letters');
  var statNumbers  = document.getElementById('stat-numbers');
  var statSpaces   = document.getElementById('stat-spaces');
  var statPunct    = document.getElementById('stat-punct');
  var statWords    = document.getElementById('stat-words');
  var statLines    = document.getElementById('stat-lines');

  // Set textarea min-height to satisfy 220px requirement
  textarea.style.minHeight = '220px';

  // Initialize progress bar track and fill via JS - no inline HTML styles
  progressTrack.style.height = '10px';
  progressTrack.style.backgroundColor = '#e5e7e3';
  progressTrack.style.borderRadius = '99px';
  progressTrack.style.overflow = 'hidden';
  progressBar.style.height = '100%';
  progressBar.style.width = '0%';
  progressBar.style.backgroundColor = '#1F6B57';
  progressBar.style.borderRadius = '99px';
  progressBar.style.transition = 'width 0.2s ease, background-color 0.2s ease';

  // Allow preset buttons row to wrap on small screens
  presetButtons.style.flexWrap = 'wrap';

  // Center-align all stat cards
  var statCards = document.querySelectorAll('#stats-grid .result-card');
  statCards.forEach(function(card) {
    card.style.textAlign = 'center';
  });

  function updateProgress() {
    if (!limitToggle.checked) return;

    var text  = textarea.value;
    var len   = text.length;
    var limit = parseInt(limitInput.value, 10) || 280;
    var pct   = Math.min((len / limit) * 100, 100);

    progressBar.style.width = pct + '%';

    if (pct < 80) {
      progressBar.style.backgroundColor = '#1F6B57';
    } else if (pct < 95) {
      progressBar.style.backgroundColor = '#F59E0B';
    } else {
      progressBar.style.backgroundColor = '#EF4444';
    }

    var remaining = limit - len;
    if (remaining >= 0) {
      remainingCount.textContent = remaining.toLocaleString() + ' characters remaining';
      remainingCount.style.color = '';
    } else {
      remainingCount.textContent = Math.abs(remaining).toLocaleString() + ' characters over limit';
      remainingCount.style.color = '#EF4444';
    }
  }

  function updateStats() {
    var text = textarea.value;
    var len  = text.length;

    liveCount.textContent = len.toLocaleString() + ' characters';

    statTotal.textContent    = len.toLocaleString();
    statNoSpaces.textContent = text.replace(/\s/g, '').length.toLocaleString();
    statLetters.textContent  = (text.match(/[a-zA-Z]/g) || []).length.toLocaleString();
    statNumbers.textContent  = (text.match(/[0-9]/g) || []).length.toLocaleString();
    statSpaces.textContent   = (text.match(/ /g) || []).length.toLocaleString();
    statPunct.textContent    = (text.match(/[^\w\s]/g) || []).length.toLocaleString();
    statWords.textContent    = text.trim()
      ? text.trim().split(/\s+/).filter(function(w) { return w.length > 0; }).length.toLocaleString()
      : '0';
    statLines.textContent    = text ? text.split('\n').length.toLocaleString() : '0';

    updateProgress();
  }

  textarea.addEventListener('input', updateStats);

  limitToggle.addEventListener('change', function() {
    if (this.checked) {
      limitControls.classList.remove('hidden');
      updateProgress();
    } else {
      limitControls.classList.add('hidden');
    }
  });

  limitInput.addEventListener('input', updateProgress);

  // Preset buttons
  document.querySelectorAll('[data-limit]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var limit = parseInt(this.dataset.limit, 10);
      limitInput.value = limit;
      if (!limitToggle.checked) {
        limitToggle.checked = true;
        limitControls.classList.remove('hidden');
      }
      updateProgress();
    });
  });

  btnClear.addEventListener('click', function() {
    textarea.value = '';
    updateStats();
    textarea.focus();
  });

  btnCopy.addEventListener('click', function() {
    var text = textarea.value;
    if (!text) return;
    navigator.clipboard.writeText(text).then(function() {
      btnCopyLabel.textContent = 'Copied!';
      setTimeout(function() { btnCopyLabel.textContent = 'Copy Text'; }, 2000);
    }).catch(function() {
      var ta = document.createElement('textarea');
      ta.value = text;
      ta.style.position = 'fixed';
      ta.style.opacity = '0';
      document.body.appendChild(ta);
      ta.select();
      document.execCommand('copy');
      document.body.removeChild(ta);
      btnCopyLabel.textContent = 'Copied!';
      setTimeout(function() { btnCopyLabel.textContent = 'Copy Text'; }, 2000);
    });
  });

});
