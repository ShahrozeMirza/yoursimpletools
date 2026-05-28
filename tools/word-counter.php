<?php $pageJS = '/js/word-counter.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Word Counter - Free Online Word Count Tool | YourSimpleTools</title>
<meta name="description" content="Count words, characters, sentences, paragraphs and reading time instantly. Free online word counter tool - no signup required." />
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Word Counter</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Word Counter</h1>
            <p class="tool-page-desc">Count words, characters, sentences, paragraphs and reading time instantly.</p>
          </div>

          <div class="tool-container">

            <div class="form-group">
              <label for="word-counter-input" class="form-label">Your text</label>
              <textarea
                id="word-counter-input"
                class="form-textarea"
                placeholder="Type or paste your text here..."
                rows="9"
                aria-label="Text to analyze"
              ></textarea>
            </div>

            <div class="results-section">
              <h2 class="results-section-title">
                <i data-lucide="bar-chart-2" aria-hidden="true"></i>
                Statistics
              </h2>
              <div class="results-grid" id="stats-grid">
                <div class="result-card">
                  <p class="result-label">Words</p>
                  <p class="result-value text-accent" id="stat-words">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Characters (with spaces)</p>
                  <p class="result-value text-accent" id="stat-chars-spaces">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Characters (without spaces)</p>
                  <p class="result-value text-accent" id="stat-chars-no-spaces">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Sentences</p>
                  <p class="result-value text-accent" id="stat-sentences">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Paragraphs</p>
                  <p class="result-value text-accent" id="stat-paragraphs">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Reading Time</p>
                  <p class="result-value text-accent" id="stat-reading-time">-</p>
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

            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="trending-up" aria-hidden="true"></i>
                Keyword Density
              </h2>
              <p class="calc-section-note">Top 5 most used words, excluding common stop words</p>
              <div id="keyword-list">
                <p class="text-muted text-small">Start typing to see keyword density.</p>
              </div>
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
    <script src="../js/main.js"></script>
  </body>
</html>
