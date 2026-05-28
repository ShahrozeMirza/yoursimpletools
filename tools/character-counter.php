<?php $pageJS = '/js/character-counter.js'; ?>
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
    <script>lucide.createIcons();</script>
  </body>
</html>
