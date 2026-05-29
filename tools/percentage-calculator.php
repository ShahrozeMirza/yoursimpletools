<?php $pageJS = '/js/percentage-calculator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Percentage Calculator - Free Online Percentage Tool | YourSimpleTools</title>
<meta name="description" content="Calculate percentages instantly. Find what percent of a number is, percentage change, percentage difference and more. Free online percentage calculator.">
<meta name="keywords" content="percentage calculator, percent calculator, percentage change, what percent of, percentage difference">
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Percentage Calculator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Percentage Calculator</h1>
            <p class="tool-page-desc">Calculate percentages instantly. Multiple percentage calculators in one place.</p>
          </div>

          <!-- Calculator 1: What is X% of Y -->
          <div class="tool-container" id="calc-1">
            <h2 class="calc-section-title">
              <i data-lucide="percent" aria-hidden="true"></i>
              What is X% of Y?
            </h2>
            <p class="calc-section-note">Example: What is 20% of 500? = 100</p>

            <div class="form-group">
              <label for="c1-percent" class="form-label">Percentage</label>
              <div class="bmi-input-unit-wrapper">
                <input
                  type="number"
                  id="c1-percent"
                  class="form-input"
                  placeholder="e.g. 20"
                  aria-label="Percentage value"
                />
                <span class="bmi-unit-suffix">%</span>
              </div>
            </div>

            <div class="form-group">
              <label for="c1-number" class="form-label">Of number</label>
              <input
                type="number"
                id="c1-number"
                class="form-input"
                placeholder="e.g. 500"
                aria-label="Base number"
              />
            </div>

            <div class="result-box" id="c1-result" aria-live="polite" aria-label="Result"></div>
          </div>

          <!-- Calculator 2: X is what percent of Y -->
          <div class="tool-container mt-20" id="calc-2">
            <h2 class="calc-section-title">
              <i data-lucide="divide" aria-hidden="true"></i>
              X is what percent of Y?
            </h2>
            <p class="calc-section-note">Example: 100 is what percent of 500? = 20%</p>

            <div class="form-group">
              <label for="c2-value" class="form-label">Value</label>
              <input
                type="number"
                id="c2-value"
                class="form-input"
                placeholder="e.g. 100"
                aria-label="Value"
              />
            </div>

            <div class="form-group">
              <label for="c2-total" class="form-label">Total</label>
              <input
                type="number"
                id="c2-total"
                class="form-input"
                placeholder="e.g. 500"
                aria-label="Total value"
              />
            </div>

            <div class="result-box" id="c2-result" aria-live="polite" aria-label="Result"></div>
          </div>

          <!-- Calculator 3: Percentage Change -->
          <div class="tool-container mt-20" id="calc-3">
            <h2 class="calc-section-title">
              <i data-lucide="trending-up" aria-hidden="true"></i>
              Percentage Change
            </h2>
            <p class="calc-section-note">Example: From 200 to 250 = 25% increase</p>

            <div class="form-group">
              <label for="c3-from" class="form-label">From value</label>
              <input
                type="number"
                id="c3-from"
                class="form-input"
                placeholder="e.g. 200"
                aria-label="Starting value"
              />
            </div>

            <div class="form-group">
              <label for="c3-to" class="form-label">To value</label>
              <input
                type="number"
                id="c3-to"
                class="form-input"
                placeholder="e.g. 250"
                aria-label="Ending value"
              />
            </div>

            <div class="result-box" id="c3-result" aria-live="polite" aria-label="Result"></div>
          </div>

          <!-- Calculator 4: Add Percentage to Number -->
          <div class="tool-container mt-20" id="calc-4">
            <h2 class="calc-section-title">
              <i data-lucide="plus-circle" aria-hidden="true"></i>
              Add Percentage to Number
            </h2>
            <p class="calc-section-note">Example: 500 + 20% = 600</p>

            <div class="form-group">
              <label for="c4-number" class="form-label">Number</label>
              <input
                type="number"
                id="c4-number"
                class="form-input"
                placeholder="e.g. 500"
                aria-label="Base number"
              />
            </div>

            <div class="form-group">
              <label for="c4-percent" class="form-label">Add percentage</label>
              <div class="bmi-input-unit-wrapper">
                <input
                  type="number"
                  id="c4-percent"
                  class="form-input"
                  placeholder="e.g. 20"
                  aria-label="Percentage to add"
                />
                <span class="bmi-unit-suffix">%</span>
              </div>
            </div>

            <div class="result-box" id="c4-result" aria-live="polite" aria-label="Result"></div>
          </div>

          <!-- Calculator 5: Subtract Percentage -->
          <div class="tool-container mt-20" id="calc-5">
            <h2 class="calc-section-title">
              <i data-lucide="minus-circle" aria-hidden="true"></i>
              Subtract Percentage from Number
            </h2>
            <p class="calc-section-note">Example: 500 - 20% = 400</p>

            <div class="form-group">
              <label for="c5-number" class="form-label">Number</label>
              <input
                type="number"
                id="c5-number"
                class="form-input"
                placeholder="e.g. 500"
                aria-label="Base number"
              />
            </div>

            <div class="form-group">
              <label for="c5-percent" class="form-label">Subtract percentage</label>
              <div class="bmi-input-unit-wrapper">
                <input
                  type="number"
                  id="c5-percent"
                  class="form-input"
                  placeholder="e.g. 20"
                  aria-label="Percentage to subtract"
                />
                <span class="bmi-unit-suffix">%</span>
              </div>
            </div>

            <div class="result-box" id="c5-result" aria-live="polite" aria-label="Result"></div>
          </div>

          <!-- Calculator 6: Percentage Difference -->
          <div class="tool-container mt-20" id="calc-6">
            <h2 class="calc-section-title">
              <i data-lucide="arrow-left-right" aria-hidden="true"></i>
              Percentage Difference Between Two Numbers
            </h2>
            <p class="calc-section-note">Example: Difference between 200 and 300 = 40%</p>

            <div class="form-group">
              <label for="c6-num1" class="form-label">First number</label>
              <input
                type="number"
                id="c6-num1"
                class="form-input"
                placeholder="e.g. 200"
                aria-label="First number"
              />
            </div>

            <div class="form-group">
              <label for="c6-num2" class="form-label">Second number</label>
              <input
                type="number"
                id="c6-num2"
                class="form-input"
                placeholder="e.g. 300"
                aria-label="Second number"
              />
            </div>

            <div class="result-box" id="c6-result" aria-live="polite" aria-label="Result"></div>
          </div>

          <!-- Quick Percentage Reference Table -->
          <div class="tool-container mt-20">
            <h2 class="calc-section-title">
              <i data-lucide="table-2" aria-hidden="true"></i>
              Quick Percentage Reference
            </h2>

            <div class="conv-table-wrapper">
              <table class="conv-table">
                <thead>
                  <tr>
                    <th>Percentage</th>
                    <th>Decimal</th>
                    <th>Fraction</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1%</td>
                    <td class="rem-val">0.01</td>
                    <td>1/100</td>
                  </tr>
                  <tr>
                    <td>5%</td>
                    <td class="rem-val">0.05</td>
                    <td>1/20</td>
                  </tr>
                  <tr>
                    <td>10%</td>
                    <td class="rem-val">0.10</td>
                    <td>1/10</td>
                  </tr>
                  <tr>
                    <td>12.5%</td>
                    <td class="rem-val">0.125</td>
                    <td>1/8</td>
                  </tr>
                  <tr>
                    <td>20%</td>
                    <td class="rem-val">0.20</td>
                    <td>1/5</td>
                  </tr>
                  <tr>
                    <td>25%</td>
                    <td class="rem-val">0.25</td>
                    <td>1/4</td>
                  </tr>
                  <tr>
                    <td>33.33%</td>
                    <td class="rem-val">0.333</td>
                    <td>1/3</td>
                  </tr>
                  <tr>
                    <td>50%</td>
                    <td class="rem-val">0.50</td>
                    <td>1/2</td>
                  </tr>
                  <tr>
                    <td>66.67%</td>
                    <td class="rem-val">0.667</td>
                    <td>2/3</td>
                  </tr>
                  <tr>
                    <td>75%</td>
                    <td class="rem-val">0.75</td>
                    <td>3/4</td>
                  </tr>
                  <tr>
                    <td>100%</td>
                    <td class="rem-val">1.00</td>
                    <td>1/1</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="tool-disclaimer mt-20">
            <p>All calculations happen locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
  </body>
</html>
