<?php $pageJS = '/js/json-formatter.js'; ?>
<?php include '../includes/head.php'; ?>
<title>JSON Formatter - Format and Validate JSON Online | YourSimpleTools</title>
<meta name="description" content="Format, beautify, minify and validate JSON instantly. Free online JSON formatter and validator tool - no signup required.">
<meta name="keywords" content="json formatter, json validator, json beautifier, json minifier, format json online, json pretty print">
<style>
  .json-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 16px;
  }
  .json-actions .btn-primary,
  .json-actions .btn-secondary {
    padding: 8px 16px;
    width: auto;
  }
  .jf-options {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 16px;
    padding: 12px 16px;
    background: var(--color-bg);
    border: 0.0625rem solid var(--color-border);
    border-radius: var(--border-radius-btn);
  }
  .jf-options .form-label {
    margin-bottom: 0;
    white-space: nowrap;
  }
  .jf-options .form-select {
    width: auto;
    min-width: 8rem;
  }
  .jf-sort-toggle {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .jf-textarea-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 16px;
  }
  .jf-textarea-grid .form-group {
    margin-bottom: 0;
  }
  .jf-stats {
    margin-top: 16px;
  }
  @media (max-width: 48rem) {
    .jf-textarea-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="/">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="/tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>JSON Formatter</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">JSON Formatter</h1>
            <p class="tool-page-desc">Format, beautify, minify and validate JSON instantly.</p>
          </div>

          <div class="notice-box notice-info">
            <span class="notice-icon">
              <i data-lucide="info" aria-hidden="true"></i>
            </span>
            <p>Paste your JSON below to format and validate it. All processing happens locally in your browser.</p>
          </div>

          <div class="tool-container">

            <div class="json-actions">
              <button type="button" class="btn-primary flex-center gap-8" id="btn-format">
                <i data-lucide="sparkles" aria-hidden="true"></i>
                Format JSON
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-minify">
                <i data-lucide="minimize-2" aria-hidden="true"></i>
                Minify
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-validate">
                <i data-lucide="check-circle" aria-hidden="true"></i>
                Validate
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-clear">
                <i data-lucide="trash-2" aria-hidden="true"></i>
                Clear
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-copy">
                <i data-lucide="copy" aria-hidden="true"></i>
                Copy
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-sample">
                <i data-lucide="file-json" aria-hidden="true"></i>
                Load Sample
              </button>
            </div>

            <div class="jf-options">
              <div class="indent-select-group">
                <label class="form-label" for="indent-size">Indent Size</label>
                <select class="form-select" id="indent-size">
                  <option value="2" selected>2 spaces</option>
                  <option value="4">4 spaces</option>
                  <option value="tab">Tab</option>
                </select>
              </div>
              <div class="jf-sort-toggle">
                <label class="toggle-label" for="sort-keys">Sort keys alphabetically</label>
                <label class="toggle-switch">
                  <input type="checkbox" id="sort-keys" />
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>

            <div id="validation-status" class="hidden" aria-live="polite"></div>

            <div class="jf-textarea-grid">
              <div class="form-group">
                <label class="form-label" for="json-input">Input JSON</label>
                <textarea
                  class="form-textarea json-textarea"
                  id="json-input"
                  placeholder="Paste your JSON here..."
                  aria-label="Input JSON"
                ></textarea>
                <p class="json-status-bar" id="input-status">Characters: 0 | Lines: 1</p>
              </div>
              <div class="form-group">
                <label class="form-label" for="json-output">Formatted Output</label>
                <textarea
                  class="form-textarea json-textarea"
                  id="json-output"
                  readonly
                  aria-label="Formatted JSON output"
                ></textarea>
                <p class="json-status-bar" id="output-stats">Characters: 0 | Lines: 0 | Size: 0.00 KB</p>
              </div>
            </div>

            <div id="json-stats" class="results-section jf-stats hidden">
              <h2 class="results-section-title">
                <i data-lucide="bar-chart-2" aria-hidden="true"></i>
                JSON Statistics
              </h2>
              <div class="results-grid">
                <div class="result-card">
                  <p class="result-label">Total Keys</p>
                  <p class="result-value" id="stat-keys">-</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Total Values</p>
                  <p class="result-value" id="stat-values">-</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Arrays</p>
                  <p class="result-value" id="stat-arrays">-</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Objects</p>
                  <p class="result-value" id="stat-objects">-</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Nesting Depth</p>
                  <p class="result-value" id="stat-depth">-</p>
                </div>
                <div class="result-card">
                  <p class="result-label">File Size</p>
                  <p class="result-value" id="stat-size">-</p>
                </div>
              </div>
            </div>

          </div>

          <div class="json-info-section">
            <h2>
              <i data-lucide="book-open" aria-hidden="true"></i>
              What is JSON?
            </h2>
            <p>JSON (JavaScript Object Notation) is a lightweight data interchange format that is easy for humans to read and write and easy for machines to parse and generate.</p>
            <p>JSON is built on two structures:</p>
            <ul>
              <li>A collection of name/value pairs (object)</li>
              <li>An ordered list of values (array)</li>
            </ul>
            <p>It is used primarily to transmit data between a server and web application as an alternative to XML.</p>
          </div>

          <div class="tool-disclaimer">
            <p>All JSON processing happens locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>

    </main>

<?php include '../includes/footer.php'; ?>
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
</body>
</html>
