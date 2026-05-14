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
    <script>
      (function () {
        var openingCount = 0;

        function addOpening() {
          openingCount++;
          var id = openingCount;
          var list = document.getElementById('openings-list');
          var row = document.createElement('div');
          row.className = 'opening-row nisaab-card mt-8 mb-8';
          row.setAttribute('data-id', id);
          row.innerHTML =
            '<div class="form-grid-2">' +
              '<div class="form-group">' +
                '<label class="form-label" for="opening-type-' + id + '">Type</label>' +
                '<select id="opening-type-' + id + '" class="form-select opening-type">' +
                  '<option value="door">Door</option>' +
                  '<option value="window">Window</option>' +
                '</select>' +
              '</div>' +
              '<div></div>' +
            '</div>' +
            '<div class="form-grid-2">' +
              '<div class="form-group">' +
                '<label class="form-label" for="opening-width-' + id + '">Width (feet)</label>' +
                '<input type="number" id="opening-width-' + id + '" class="form-input opening-width" placeholder="e.g. 3" min="0" step="any" />' +
              '</div>' +
              '<div class="form-group">' +
                '<label class="form-label" for="opening-height-' + id + '">Height (feet)</label>' +
                '<input type="number" id="opening-height-' + id + '" class="form-input opening-height" placeholder="e.g. 7" min="0" step="any" />' +
              '</div>' +
            '</div>' +
            '<button type="button" class="btn-reset remove-opening-btn" aria-label="Remove opening">' +
              '<i data-lucide="x" aria-hidden="true"></i>' +
              ' Remove' +
            '</button>';
          row.querySelector('.remove-opening-btn').addEventListener('click', function () {
            row.remove();
          });
          list.appendChild(row);
          lucide.createIcons();
        }

        function getVal(id) {
          var v = parseFloat(document.getElementById(id).value);
          return isNaN(v) || v < 0 ? 0 : v;
        }

        function toMeters(value, unit) {
          return unit === 'feet' ? value / 3.28084 : value;
        }

        function calculate() {
          var length = getVal('wall-length');
          var height = getVal('wall-height');

          if (length <= 0 || height <= 0) {
            alert('Please enter valid wall length and height.');
            return;
          }

          var numWalls = Math.max(1, parseInt(document.getElementById('num-walls').value) || 1);
          var lengthUnit = document.getElementById('length-unit').value;
          var heightUnit = document.getElementById('height-unit').value;

          var lengthM = toMeters(length, lengthUnit);
          var heightM = toMeters(height, heightUnit);

          var wallType = document.querySelector('input[name="wall-type"]:checked').value;
          var thickness = wallType === '9inch' ? 0.2286 : 0.1143;

          var wastage = parseFloat(document.querySelector('input[name="wastage"]:checked').value);

          var wallAreaM2 = lengthM * heightM;
          var wallVolumeM3 = wallAreaM2 * thickness;

          var openingAreaM2 = 0;
          var openingAreaSqFt = 0;
          document.querySelectorAll('.opening-row').forEach(function (row) {
            var wFt = parseFloat(row.querySelector('.opening-width').value) || 0;
            var hFt = parseFloat(row.querySelector('.opening-height').value) || 0;
            if (wFt > 0 && hFt > 0) {
              var wM = wFt / 3.28084;
              var hM = hFt / 3.28084;
              openingAreaM2 += wM * hM;
              openingAreaSqFt += wFt * hFt;
            }
          });

          var netAreaM2PerWall = Math.max(0, wallAreaM2 - openingAreaM2);
          var netVolumePerWall = netAreaM2PerWall * thickness;
          var totalNetVolumeM3 = netVolumePerWall * numWalls;

          var bricksBeforeWastage = totalNetVolumeM3 * 500;
          var wastageCount = Math.ceil(bricksBeforeWastage * wastage);
          var bricksWithWastage = Math.ceil(bricksBeforeWastage * (1 + wastage));

          var cementBags = Math.ceil(totalNetVolumeM3 * 1.26);
          var sandCubicMeters = totalNetVolumeM3 * 0.263;
          var sandCubicFeet = sandCubicMeters * 35.3147;

          document.getElementById('result-bricks').textContent =
            bricksWithWastage.toLocaleString();
          document.getElementById('result-cement').textContent =
            cementBags.toLocaleString();
          document.getElementById('result-sand').textContent =
            sandCubicFeet.toFixed(2);

          var wallAreaSqFt = wallAreaM2 * 10.7639;
          var totalWallAreaSqFt = wallAreaSqFt * numWalls;
          var totalDeductionsSqFt = openingAreaSqFt * numWalls;
          var totalNetAreaSqFt = totalWallAreaSqFt - totalDeductionsSqFt;
          var totalNetVolumeCubicFt = totalNetVolumeM3 * 35.3147;

          document.getElementById('bd-wall-area').textContent =
            totalWallAreaSqFt.toFixed(2) + ' sq ft';
          document.getElementById('bd-deductions').textContent =
            totalDeductionsSqFt.toFixed(2) + ' sq ft';
          document.getElementById('bd-net-area').textContent =
            totalNetAreaSqFt.toFixed(2) + ' sq ft';
          document.getElementById('bd-wall-volume').textContent =
            totalNetVolumeCubicFt.toFixed(2) + ' cubic feet / ' +
            totalNetVolumeM3.toFixed(4) + ' cubic meters';
          document.getElementById('bd-bricks-before').textContent =
            Math.round(bricksBeforeWastage).toLocaleString() + ' bricks';
          document.getElementById('bd-wastage').textContent =
            (wastage * 100).toFixed(0) + '% = ' + wastageCount.toLocaleString() + ' bricks';
          document.getElementById('bd-total-bricks').textContent =
            bricksWithWastage.toLocaleString() + ' bricks';
          document.getElementById('bd-cement').textContent =
            cementBags.toLocaleString() + ' bags';
          document.getElementById('bd-sand').textContent =
            sandCubicFeet.toFixed(2) + ' cubic feet';

          document.getElementById('results-section').classList.remove('hidden');
          document.getElementById('results-section').scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
          });
        }

        function toggleBreakdown() {
          var content = document.getElementById('breakdown-content');
          var btn = document.getElementById('breakdown-toggle');
          var isHidden = content.classList.contains('hidden');
          if (isHidden) {
            content.classList.remove('hidden');
            btn.setAttribute('aria-expanded', 'true');
            btn.innerHTML =
              '<i data-lucide="chevron-up" aria-hidden="true"></i> Hide Calculation Breakdown';
          } else {
            content.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
            btn.innerHTML =
              '<i data-lucide="chevron-down" aria-hidden="true"></i> Show Calculation Breakdown';
          }
          lucide.createIcons();
        }

        function resetCalculator() {
          document.getElementById('wall-length').value = '';
          document.getElementById('wall-height').value = '';
          document.getElementById('num-walls').value = '1';
          document.getElementById('length-unit').value = 'feet';
          document.getElementById('height-unit').value = 'feet';

          document.querySelector('input[name="wall-type"][value="9inch"]').checked = true;
          document.querySelector('input[name="wastage"][value="0.10"]').checked = true;

          document.getElementById('openings-list').innerHTML = '';
          openingCount = 0;

          document.getElementById('results-section').classList.add('hidden');

          var breakdownContent = document.getElementById('breakdown-content');
          breakdownContent.classList.add('hidden');
          var breakdownToggle = document.getElementById('breakdown-toggle');
          breakdownToggle.setAttribute('aria-expanded', 'false');
          breakdownToggle.innerHTML =
            '<i data-lucide="chevron-down" aria-hidden="true"></i> Show Calculation Breakdown';
          lucide.createIcons();
        }

        function init() {
          document
            .getElementById('add-opening-btn')
            .addEventListener('click', addOpening);
          document
            .getElementById('calculate-btn')
            .addEventListener('click', calculate);
          document
            .getElementById('breakdown-toggle')
            .addEventListener('click', toggleBreakdown);
          document
            .getElementById('reset-btn')
            .addEventListener('click', resetCalculator);
        }

        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', init);
        } else {
          init();
        }
      })();
    </script>
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
