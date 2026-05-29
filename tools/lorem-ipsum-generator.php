<?php $pageJS = '/js/lorem-ipsum-generator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Lorem Ipsum Generator - Free Placeholder Text | YourSimpleTools</title>
<meta name="description" content="Generate Lorem Ipsum placeholder text instantly. Choose paragraphs, sentences or words. Copy with one click. Free online Lorem Ipsum generator.">
<meta name="keywords" content="lorem ipsum generator, placeholder text, dummy text generator, lorem ipsum, random text generator">
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Lorem Ipsum Generator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Lorem Ipsum Generator</h1>
            <p class="tool-page-desc">Generate Lorem Ipsum placeholder text instantly for your designs and mockups.</p>
          </div>

          <div class="notice-box notice-info">
            <span class="notice-icon">
              <i data-lucide="info" aria-hidden="true"></i>
            </span>
            <p>Lorem Ipsum has been the industry standard dummy text since the 1500s. It is used by designers and developers as placeholder text in layouts and mockups.</p>
          </div>

          <div class="tool-container">

            <div class="form-group">
              <p class="controls-group-label">Generate Type</p>
              <div class="bmi-unit-toggle">
                <button type="button" class="bmi-unit-btn bmi-unit-btn--active" id="btn-paragraphs">Paragraphs</button>
                <button type="button" class="bmi-unit-btn" id="btn-sentences">Sentences</button>
                <button type="button" class="bmi-unit-btn" id="btn-words">Words</button>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="quantity-input">Amount</label>
              <input
                type="number"
                class="form-input"
                id="quantity-input"
                min="1"
                max="100"
                value="5"
                aria-label="Amount to generate"
              />
              <p class="text-muted text-small mt-4" id="quantity-hint">Number of paragraphs (1-100)</p>
            </div>

            <div class="form-group">
              <div class="toggle-list">
                <div class="toggle-row">
                  <label class="toggle-label" for="start-with-lorem">Start with Lorem ipsum dolor sit amet</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="start-with-lorem" checked />
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="toggle-row">
                  <label class="toggle-label" for="html-format">Wrap paragraphs in HTML tags</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="html-format" />
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>

            <button
              type="button"
              class="btn-primary w-full flex-center justify-center gap-8"
              id="generate-btn"
            >
              <i data-lucide="wand-2" aria-hidden="true"></i>
              Generate Lorem Ipsum
            </button>

            <div class="form-group mt-20">
              <label class="form-label" for="output-text">Generated Text</label>
              <textarea
                id="output-text"
                class="form-textarea lorem-output"
                readonly
                aria-label="Generated lorem ipsum text"
                aria-live="polite"
              ></textarea>
              <p class="text-muted text-small mt-4" id="output-stats">Words: 0 | Characters: 0 | Paragraphs: 0</p>
            </div>

            <div class="flex gap-8">
              <button type="button" class="btn-secondary flex-center gap-8" id="copy-btn">
                <i data-lucide="copy" aria-hidden="true"></i>
                <span>Copy Text</span>
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="download-btn">
                <i data-lucide="download" aria-hidden="true"></i>
                <span>Download as TXT</span>
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="clear-btn">
                <i data-lucide="trash-2" aria-hidden="true"></i>
                <span>Clear</span>
              </button>
            </div>

            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="book-open" aria-hidden="true"></i>
                What is Lorem Ipsum?
              </h2>
              <p class="calc-section-note">Lorem Ipsum is simply dummy text used in the printing and typesetting industry. The standard passage has been used since the 1500s when an unknown printer scrambled a passage of Latin text to make a type specimen book.</p>
              <p class="text-muted text-small mt-8">It is used because it has a normal distribution of letters making it look like readable English as opposed to using plain repetitive text like 'Content here content here' which makes it look like readable English.</p>
              <p class="text-muted text-small mt-8">Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</p>
            </div>

            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="list" aria-hidden="true"></i>
                Common Uses
              </h2>
              <ul class="lorem-uses-list">
                <li class="lorem-uses-item">
                  <i data-lucide="check" aria-hidden="true"></i>
                  Web design mockups and wireframes
                </li>
                <li class="lorem-uses-item">
                  <i data-lucide="check" aria-hidden="true"></i>
                  Print layout and typography testing
                </li>
                <li class="lorem-uses-item">
                  <i data-lucide="check" aria-hidden="true"></i>
                  App UI prototyping
                </li>
                <li class="lorem-uses-item">
                  <i data-lucide="check" aria-hidden="true"></i>
                  Email template design
                </li>
                <li class="lorem-uses-item">
                  <i data-lucide="check" aria-hidden="true"></i>
                  Presentation placeholder content
                </li>
              </ul>
            </div>

          </div>

          <div class="tool-disclaimer">
            <p>All text is generated locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>lucide.createIcons();</script>
  </body>
</html>
