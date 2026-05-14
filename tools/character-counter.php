<?php include '../includes/head.php'; ?>
<title>Character Counter - Free Online Character Count Tool | YourSimpleTools</title>
<meta name="description" content="Count characters, letters, spaces, punctuation and more instantly. Free online character counter - no signup required." />
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Character Counter</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Character Counter</h1>
            <p class="tool-page-desc">Count characters, letters, spaces, punctuation and more instantly.</p>
          </div>

          <div class="tool-container">

            <div class="form-group">
              <label for="char-input" class="form-label">Your text</label>
              <p class="text-small text-muted mb-8" id="live-count">0 characters</p>
              <textarea
                id="char-input"
                class="form-textarea"
                placeholder="Type or paste your text here..."
                rows="10"
                aria-label="Text to analyze"
              ></textarea>
            </div>

            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="sliders" aria-hidden="true"></i>
                Character Limit
              </h2>
              <div class="flex-center gap-8">
                <input
                  type="checkbox"
                  id="limit-toggle"
                  class="form-checkbox"
                  aria-controls="limit-controls"
                />
                <label for="limit-toggle">Enable character limit</label>
              </div>

              <div id="limit-controls" class="hidden">
                <div class="form-group mt-16">
                  <label for="limit-input" class="form-label">Character limit</label>
                  <input
                    type="number"
                    id="limit-input"
                    class="form-input"
                    value="280"
                    min="1"
                    max="100000"
                    aria-label="Set character limit"
                  />
                </div>

                <div class="flex gap-8" id="preset-buttons">
                  <button type="button" class="btn-secondary" data-limit="280">Twitter (280)</button>
                  <button type="button" class="btn-secondary" data-limit="700">LinkedIn (700)</button>
                  <button type="button" class="btn-secondary" data-limit="2200">Instagram (2,200)</button>
                  <button type="button" class="btn-secondary" data-limit="160">SMS (160)</button>
                </div>

                <div id="progress-track" class="mt-16">
                  <div id="progress-bar"></div>
                </div>

                <p class="text-small text-muted mt-8" id="remaining-count">280 characters remaining</p>
              </div>
            </div>

            <div class="results-section">
              <h2 class="results-section-title">
                <i data-lucide="bar-chart-2" aria-hidden="true"></i>
                Statistics
              </h2>
              <div class="results-grid" id="stats-grid">
                <div class="result-card">
                  <p class="result-value text-accent" id="stat-total">0</p>
                  <p class="result-label">Total Characters</p>
                </div>
                <div class="result-card">
                  <p class="result-value text-accent" id="stat-no-spaces">0</p>
                  <p class="result-label">Characters (no spaces)</p>
                </div>
                <div class="result-card">
                  <p class="result-value text-accent" id="stat-letters">0</p>
                  <p class="result-label">Letters only</p>
                </div>
                <div class="result-card">
                  <p class="result-value text-accent" id="stat-numbers">0</p>
                  <p class="result-label">Numbers only</p>
                </div>
                <div class="result-card">
                  <p class="result-value text-accent" id="stat-spaces">0</p>
                  <p class="result-label">Spaces</p>
                </div>
                <div class="result-card">
                  <p class="result-value text-accent" id="stat-punct">0</p>
                  <p class="result-label">Punctuation marks</p>
                </div>
                <div class="result-card">
                  <p class="result-value text-accent" id="stat-words">0</p>
                  <p class="result-label">Words</p>
                </div>
                <div class="result-card">
                  <p class="result-value text-accent" id="stat-lines">0</p>
                  <p class="result-label">Lines</p>
                </div>
              </div>
            </div>

            <div class="flex gap-8 mt-20">
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-clear">
                <i data-lucide="trash-2" aria-hidden="true"></i>
                Clear Text
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-copy">
                <i data-lucide="copy" aria-hidden="true"></i>
                <span id="btn-copy-label">Copy Text</span>
              </button>
            </div>

          </div>

          <div class="tool-disclaimer">
            <p>All text processing happens locally in your browser. No text is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>
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
    </script>
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
