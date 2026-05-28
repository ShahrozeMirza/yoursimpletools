<?php $pageJS = '../js/construction-material-estimator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Construction Material Estimator - Bricks Cement Sand Calculator | YourSimpleTools</title>
<meta name="description" content="Calculate how many bricks, cement bags and sand you need for your wall. Free construction material estimator for Pakistan." />
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Construction Material Estimator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Construction Material Estimator</h1>
            <p class="tool-page-desc">
              Estimate bricks, cement bags and sand required for your wall construction.
              Based on standard Pakistani construction ratios.
            </p>
          </div>

          <div class="notice-box notice-warning" role="note">
            <span class="notice-icon">
              <i data-lucide="triangle-alert" aria-hidden="true"></i>
            </span>
            <p>
              These are estimated quantities based on standard construction ratios. Actual
              requirements may vary depending on brick quality, workmanship, and site conditions.
              Always consult your engineer or contractor before purchasing materials.
            </p>
          </div>

          <div class="tool-container">

            <!-- Section 1: Wall Dimensions -->
            <div class="form-group">
              <h2 class="calc-section-title">
                <i data-lucide="ruler" aria-hidden="true"></i>
                Wall Dimensions
              </h2>

              <div class="form-group">
                <label class="form-label" for="wall-length">Wall Length</label>
                <div class="input-with-unit">
                  <input
                    type="number"
                    id="wall-length"
                    class="form-input"
                    placeholder="Enter length"
                    min="0"
                    step="any"
                  />
                  <select id="length-unit" class="form-select">
                    <option value="feet">Feet</option>
                    <option value="meters">Meters</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label" for="wall-height">Wall Height</label>
                <div class="input-with-unit">
                  <input
                    type="number"
                    id="wall-height"
                    class="form-input"
                    placeholder="Enter height"
                    min="0"
                    step="any"
                  />
                  <select id="height-unit" class="form-select">
                    <option value="feet">Feet</option>
                    <option value="meters">Meters</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label" for="num-walls">
                  Number of Walls (same dimensions)
                </label>
                <input
                  type="number"
                  id="num-walls"
                  class="form-input"
                  value="1"
                  min="1"
                  step="1"
                />
              </div>
            </div>

            <!-- Section 2: Wall Type -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="layers" aria-hidden="true"></i>
                Wall Type
              </h2>

              <div class="form-group">
                <label class="flex-center gap-8">
                  <input
                    type="radio"
                    name="wall-type"
                    value="9inch"
                    checked
                    class="form-checkbox"
                  />
                  <span>9 inch brick wall (standard - load bearing)</span>
                </label>
              </div>
              <div class="form-group">
                <label class="flex-center gap-8">
                  <input
                    type="radio"
                    name="wall-type"
                    value="4.5inch"
                    class="form-checkbox"
                  />
                  <span>4.5 inch brick wall (half brick - partition)</span>
                </label>
              </div>
            </div>

            <!-- Section 3: Deductions -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="scissors" aria-hidden="true"></i>
                Deduct Openings (Doors and Windows)
              </h2>
              <p class="calc-section-note">
                Add your doors and windows to deduct their area from the wall calculation
              </p>

              <div id="openings-list"></div>

              <button
                type="button"
                class="btn-secondary flex-center gap-8 mt-16"
                id="add-opening-btn"
              >
                <i data-lucide="plus" aria-hidden="true"></i>
                Add Opening
              </button>
            </div>

            <!-- Section 4: Wastage Factor -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="percent" aria-hidden="true"></i>
                Wastage Factor
              </h2>

              <div class="form-group">
                <label class="flex-center gap-8">
                  <input
                    type="radio"
                    name="wastage"
                    value="0.10"
                    checked
                    class="form-checkbox"
                  />
                  <span>10% - Standard straight walls (default)</span>
                </label>
              </div>
              <div class="form-group">
                <label class="flex-center gap-8">
                  <input
                    type="radio"
                    name="wastage"
                    value="0.15"
                    class="form-checkbox"
                  />
                  <span>15% - Complex cuts or corners</span>
                </label>
              </div>
              <div class="form-group">
                <label class="flex-center gap-8">
                  <input
                    type="radio"
                    name="wastage"
                    value="0.20"
                    class="form-checkbox"
                  />
                  <span>20% - Curved walls or decorative work</span>
                </label>
              </div>
            </div>

            <!-- Calculate Button -->
            <div class="calc-section">
              <button
                type="button"
                class="btn-primary w-full flex-center gap-8 justify-center"
                id="calculate-btn"
              >
                <i data-lucide="calculator" aria-hidden="true"></i>
                Calculate Materials
              </button>
            </div>

            <!-- Results Section -->
            <div class="results-section hidden" id="results-section">
              <h2 class="results-section-title">
                <i data-lucide="bar-chart-2" aria-hidden="true"></i>
                Estimated Materials
              </h2>

              <!-- Primary Results Grid -->
              <div class="results-grid">
                <div class="result-card result-card--accent">
                  <div class="tool-icon">
                    <i data-lucide="layers" aria-hidden="true"></i>
                  </div>
                  <p class="result-value" id="result-bricks">-</p>
                  <p class="result-label">Bricks (including wastage)</p>
                </div>
                <div class="result-card">
                  <div class="tool-icon">
                    <i data-lucide="package" aria-hidden="true"></i>
                  </div>
                  <p class="result-value" id="result-cement">-</p>
                  <p class="result-label">Cement Bags (50kg each)</p>
                </div>
                <div class="result-card">
                  <div class="tool-icon">
                    <i data-lucide="triangle" aria-hidden="true"></i>
                  </div>
                  <p class="result-value" id="result-sand">-</p>
                  <p class="result-label">Sand (cubic feet)</p>
                </div>
              </div>

              <!-- Calculation Breakdown Toggle -->
              <div class="mt-20">
                <button
                  type="button"
                  class="btn-secondary w-full flex-center gap-8 justify-center"
                  id="breakdown-toggle"
                  aria-expanded="false"
                  aria-controls="breakdown-content"
                >
                  <i data-lucide="chevron-down" aria-hidden="true"></i>
                  Show Calculation Breakdown
                </button>
                <div id="breakdown-content" class="hidden mt-12">
                  <div class="auto-display">
                    Wall area: <strong id="bd-wall-area">-</strong>
                  </div>
                  <div class="auto-display">
                    Deductions: <strong id="bd-deductions">-</strong>
                  </div>
                  <div class="auto-display">
                    Net wall area: <strong id="bd-net-area">-</strong>
                  </div>
                  <div class="auto-display">
                    Wall volume: <strong id="bd-wall-volume">-</strong>
                  </div>
                  <div class="auto-display">
                    Bricks before wastage: <strong id="bd-bricks-before">-</strong>
                  </div>
                  <div class="auto-display">
                    Wastage: <strong id="bd-wastage">-</strong>
                  </div>
                  <div class="auto-display">
                    Total bricks: <strong id="bd-total-bricks">-</strong>
                  </div>
                  <div class="auto-display">
                    Cement: <strong id="bd-cement">-</strong>
                  </div>
                  <div class="auto-display">
                    Sand: <strong id="bd-sand">-</strong>
                  </div>
                </div>
              </div>

              <!-- Construction Tips -->
              <div class="nisaab-card mt-20">
                <h3 class="nisaab-card-title">Construction Tips</h3>
                <ul>
                  <li>Always buy 10% extra materials as buffer</li>
                  <li>Check brick quality before bulk purchase</li>
                  <li>Store cement in dry place - use within 3 months</li>
                  <li>Mix cement mortar ratio 1:6 for 9 inch walls</li>
                  <li>Mix cement mortar ratio 1:4 for 4.5 inch walls</li>
                </ul>
              </div>

              <!-- Reset Button -->
              <button
                type="button"
                class="btn-secondary flex-center gap-8 mt-20"
                id="reset-btn"
              >
                <i data-lucide="rotate-ccw" aria-hidden="true"></i>
                Reset Calculator
              </button>
            </div>

          </div>
        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
