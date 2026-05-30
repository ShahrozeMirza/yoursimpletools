<?php $pageJS = '/js/tip-calculator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Tip Calculator - Calculate Tip and Split Bill | YourSimpleTools</title>
<meta name="description" content="Calculate tip amount and split the bill instantly. Choose tip percentage, number of people, and get per person amount. Free online tip calculator.">
<meta name="keywords" content="tip calculator, bill splitter, how much to tip, restaurant tip calculator, split bill calculator">
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Tip Calculator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Tip Calculator</h1>
            <p class="tool-page-desc">Calculate tip amount and split the bill easily between friends.</p>
          </div>

          <div class="tool-container">

            <h2 class="calc-section-title">
              <i data-lucide="receipt" aria-hidden="true"></i>
              Bill Details
            </h2>

            <div class="form-group">
              <label for="bill-amount" class="form-label">Bill Amount</label>
              <div class="bmi-input-unit-wrapper">
                <input
                  type="number"
                  id="bill-amount"
                  class="form-input"
                  placeholder="Enter bill amount"
                  min="0"
                  step="0.01"
                  aria-label="Bill amount"
                />
                <span class="bmi-unit-suffix" id="currency-symbol">$</span>
              </div>
            </div>

            <div class="form-group">
              <label for="currency-select" class="form-label">Currency</label>
              <select id="currency-select" class="form-select" aria-label="Select currency">
                <option value="USD">USD - $</option>
                <option value="GBP">GBP - pound</option>
                <option value="EUR">EUR - euro</option>
                <option value="CAD">CAD - CA$</option>
                <option value="AUD">AUD - A$</option>
                <option value="PKR">PKR - Rs</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Tip Percentage</label>
              <div class="rng-chips" role="group" aria-label="Tip percentage presets">
                <button type="button" id="tip-5" class="rng-chip" aria-pressed="false">5%</button>
                <button type="button" id="tip-10" class="rng-chip" aria-pressed="false">10%</button>
                <button type="button" id="tip-15" class="rng-chip bmi-unit-btn--active" aria-pressed="true">15%</button>
                <button type="button" id="tip-18" class="rng-chip" aria-pressed="false">18%</button>
                <button type="button" id="tip-20" class="rng-chip" aria-pressed="false">20%</button>
                <button type="button" id="tip-25" class="rng-chip" aria-pressed="false">25%</button>
                <button type="button" id="tip-custom" class="rng-chip" aria-pressed="false">Custom</button>
              </div>
              <div class="mt-8">
                <input
                  type="number"
                  id="custom-tip-input"
                  class="form-input hidden"
                  placeholder="Enter custom %"
                  min="0"
                  max="100"
                  aria-label="Custom tip percentage"
                />
              </div>
            </div>

            <div class="form-group">
              <label for="num-people" class="form-label">Split Between</label>
              <div class="bmi-input-unit-wrapper">
                <input
                  type="number"
                  id="num-people"
                  class="form-input"
                  value="1"
                  min="1"
                  max="100"
                  aria-label="Number of people splitting the bill"
                />
                <span class="bmi-unit-suffix">people</span>
              </div>
            </div>

            <div class="toggle-list">
              <div class="toggle-row">
                <label for="round-up" class="toggle-label">Round up per person amount</label>
                <label class="toggle-switch" aria-label="Round up toggle">
                  <input type="checkbox" id="round-up" />
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>

          </div>
          <!-- end bill details -->

          <div class="tool-container mt-20">

            <h2 class="calc-section-title">
              <i data-lucide="calculator" aria-hidden="true"></i>
              Results
            </h2>

            <div class="form-grid-2">
              <div class="result-card result-card--accent">
                <p class="result-label">Tip Amount</p>
                <p id="result-tip-amount" class="result-value text-accent">$0.00</p>
              </div>
              <div class="result-card result-card--accent">
                <p class="result-label">Total Bill</p>
                <p id="result-total-bill" class="result-value text-accent">$0.00</p>
              </div>
            </div>

            <div class="form-grid-2 mt-12">
              <div class="result-card result-card--accent">
                <p class="result-label">Per Person</p>
                <p id="result-per-person" class="result-value text-accent">$0.00</p>
              </div>
              <div class="result-card">
                <p class="result-label">Tip Per Person</p>
                <p id="result-tip-per-person" class="result-value text-accent">$0.00</p>
              </div>
            </div>

            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="table-2" aria-hidden="true"></i>
                Bill Breakdown
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <tbody>
                    <tr>
                      <td>Bill Amount</td>
                      <td id="breakdown-bill">$0.00</td>
                    </tr>
                    <tr>
                      <td>Tip</td>
                      <td id="breakdown-tip">$0.00 (15%)</td>
                    </tr>
                    <tr>
                      <td>Total</td>
                      <td id="breakdown-total">$0.00</td>
                    </tr>
                    <tr>
                      <td>Number of People</td>
                      <td id="breakdown-people">1</td>
                    </tr>
                    <tr>
                      <td>Per Person</td>
                      <td id="breakdown-per-person">$0.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <!-- end results -->

          <div class="tool-container mt-20">

            <h2 class="calc-section-title">
              <i data-lucide="book-open" aria-hidden="true"></i>
              Tipping Guide by Service
            </h2>

            <div class="conv-table-wrapper">
              <table class="conv-table">
                <thead>
                  <tr>
                    <th>Service</th>
                    <th>Suggested Tip</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Restaurant (sit-down)</td>
                    <td>15-20%</td>
                  </tr>
                  <tr>
                    <td>Restaurant (buffet)</td>
                    <td>10%</td>
                  </tr>
                  <tr>
                    <td>Food delivery</td>
                    <td>10-15%</td>
                  </tr>
                  <tr>
                    <td>Taxi / Rideshare</td>
                    <td>10-15%</td>
                  </tr>
                  <tr>
                    <td>Hotel housekeeping</td>
                    <td>$2-5 per night</td>
                  </tr>
                  <tr>
                    <td>Hotel bellhop</td>
                    <td>$1-2 per bag</td>
                  </tr>
                  <tr>
                    <td>Hair salon</td>
                    <td>15-20%</td>
                  </tr>
                  <tr>
                    <td>Spa services</td>
                    <td>15-20%</td>
                  </tr>
                  <tr>
                    <td>Tour guide</td>
                    <td>10-15%</td>
                  </tr>
                  <tr>
                    <td>Bartender</td>
                    <td>$1-2 per drink or 15-20%</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
          <!-- end tipping guide -->

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
