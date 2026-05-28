<?php $pageJS = '/js/px-to-rem.js'; ?>
<?php include '../includes/head.php'; ?>
<title>PX to REM Converter - Free Online Tool | YourSimpleTools</title>
<meta name="description" content="Convert PX to REM and REM to PX instantly. Set your base font size for accurate conversions. Free online PX to REM converter tool.">
<meta name="keywords" content="px to rem, rem to px, px to rem converter, css unit converter, font size converter">
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>PX to REM Converter</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">PX to REM Converter</h1>
            <p class="tool-page-desc">Convert between PX and REM instantly. Set your own base font size.</p>
          </div>

          <div class="notice-box notice-info">
            <span class="notice-icon">
              <i data-lucide="info" aria-hidden="true"></i>
            </span>
            <p>REM (Root EM) is relative to the root element font size. The default browser base font size is 16px. 1rem = 16px by default. Change the base font size below to match your project settings.</p>
          </div>

          <div class="tool-container">

            <div class="form-group">
              <label for="base-font-size" class="form-label">Base Font Size (px)</label>
              <input
                type="number"
                id="base-font-size"
                class="form-input"
                value="16"
                min="1"
                max="100"
                aria-label="Base font size in pixels"
              />
              <p class="text-muted text-small mt-8">Default browser base font size is 16px. Change this to match your project root font size.</p>
            </div>

            <div class="conv-grid mt-20">
              <div class="form-group">
                <label for="px-input" class="form-label">Pixels (PX)</label>
                <input
                  type="number"
                  id="px-input"
                  class="form-input"
                  placeholder="Enter PX value"
                  min="0"
                  step="any"
                  aria-label="Value in pixels"
                />
                <div class="mt-8">
                  <button type="button" class="btn-secondary flex-center gap-8" id="copy-px-btn">
                    <i data-lucide="copy" aria-hidden="true"></i>
                    <span id="copy-px-label">Copy PX</span>
                  </button>
                </div>
              </div>

              <div class="conv-swap">
                <i data-lucide="arrow-left-right" aria-hidden="true"></i>
              </div>

              <div class="form-group">
                <label for="rem-input" class="form-label">REM</label>
                <input
                  type="number"
                  id="rem-input"
                  class="form-input"
                  placeholder="Enter REM value"
                  min="0"
                  step="any"
                  aria-label="Value in REM"
                />
                <div class="mt-8">
                  <button type="button" class="btn-secondary flex-center gap-8" id="copy-rem-btn">
                    <i data-lucide="copy" aria-hidden="true"></i>
                    <span id="copy-rem-label">Copy REM</span>
                  </button>
                </div>
              </div>
            </div>

            <p class="text-muted text-small mt-12" id="formula-display">Formula: REM = PX / 16 | PX = REM x 16</p>

            <div class="mt-16">
              <button type="button" class="btn-secondary flex-center gap-8" id="reset-btn">
                <i data-lucide="rotate-ccw" aria-hidden="true"></i>
                Reset
              </button>
            </div>

            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="table" aria-hidden="true"></i>
                Common PX to REM Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>PX</th>
                      <th>REM</th>
                      <th>Common Use</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr data-px="8">
                      <td>8px</td>
                      <td class="rem-val">0.5</td>
                      <td class="text-muted">Extra small text</td>
                    </tr>
                    <tr data-px="10">
                      <td>10px</td>
                      <td class="rem-val">0.625</td>
                      <td class="text-muted">Small text</td>
                    </tr>
                    <tr data-px="12">
                      <td>12px</td>
                      <td class="rem-val">0.75</td>
                      <td class="text-muted">Small text</td>
                    </tr>
                    <tr data-px="14">
                      <td>14px</td>
                      <td class="rem-val">0.875</td>
                      <td class="text-muted">Body text (small)</td>
                    </tr>
                    <tr data-px="16">
                      <td>16px</td>
                      <td class="rem-val">1</td>
                      <td class="text-muted">Body text (default)</td>
                    </tr>
                    <tr data-px="18">
                      <td>18px</td>
                      <td class="rem-val">1.125</td>
                      <td class="text-muted">Body text (large)</td>
                    </tr>
                    <tr data-px="20">
                      <td>20px</td>
                      <td class="rem-val">1.25</td>
                      <td class="text-muted">H4 heading</td>
                    </tr>
                    <tr data-px="24">
                      <td>24px</td>
                      <td class="rem-val">1.5</td>
                      <td class="text-muted">H3 heading</td>
                    </tr>
                    <tr data-px="28">
                      <td>28px</td>
                      <td class="rem-val">1.75</td>
                      <td class="text-muted">H2 heading</td>
                    </tr>
                    <tr data-px="32">
                      <td>32px</td>
                      <td class="rem-val">2</td>
                      <td class="text-muted">H1 heading</td>
                    </tr>
                    <tr data-px="36">
                      <td>36px</td>
                      <td class="rem-val">2.25</td>
                      <td class="text-muted">Display text</td>
                    </tr>
                    <tr data-px="48">
                      <td>48px</td>
                      <td class="rem-val">3</td>
                      <td class="text-muted">Hero text</td>
                    </tr>
                    <tr data-px="64">
                      <td>64px</td>
                      <td class="rem-val">4</td>
                      <td class="text-muted">Large hero text</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>

          <div class="tool-disclaimer">
            <p>All conversions happen locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>lucide.createIcons();</script>
  </body>
</html>
