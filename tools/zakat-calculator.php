<?php include '../includes/head.php'; ?>
<title>Zakat Calculator - Calculate Your Zakat | YourSimpleTools</title>
<meta name="description" content="Calculate your annual Zakat obligation accurately. Supports multiple currencies and all asset types. Free Islamic Zakat calculator." />
<style>
  /* Problem 2 - align grid items to top so fields line up when labels wrap */
  .form-grid-2 {
    align-items: start;
  }

  /* Problem 3 - section title bottom spacing */
  .calc-section-title {
    margin-bottom: 1rem;
  }

  /* Problem 4 - breathing room on helper text below price inputs */
  .form-group .auto-display {
    margin-top: 6px;
    margin-bottom: 12px;
  }
</style>
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> › </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> › </span>
            <span>Zakat Calculator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Zakat Calculator</h1>
            <p class="tool-page-desc">Estimate your annual Zakat obligation. Supports multiple currencies.</p>
          </div>

          <div class="notice-box notice-warning" role="note">
            <span class="notice-icon">
              <i data-lucide="alert-triangle" aria-hidden="true"></i>
            </span>
            <p>
              All assets must have been in your possession for a complete lunar year (Hawl) to be
              eligible for Zakat.
            </p>
          </div>

          <div class="notice-box notice-info" role="note">
            <span class="notice-icon">
              <i data-lucide="info" aria-hidden="true"></i>
            </span>
            <p>
              This calculator is for guidance only. Please consult a qualified Islamic scholar for
              your specific situation.
            </p>
          </div>

          <div class="tool-container">

            <!-- Currency Selector -->
            <div class="form-group">
              <label class="form-label" for="currency-select">Select Your Currency</label>
              <select id="currency-select" class="form-select">
                <option value="PKR">PKR - Pakistani Rupee</option>
                <option value="USD">USD - US Dollar</option>
                <option value="GBP">GBP - British Pound</option>
                <option value="EUR">EUR - Euro</option>
                <option value="AED">AED - UAE Dirham</option>
                <option value="SAR">SAR - Saudi Riyal</option>
                <option value="CAD">CAD - Canadian Dollar</option>
                <option value="AUD">AUD - Australian Dollar</option>
                <option value="MYR">MYR - Malaysian Ringgit</option>
                <option value="BDT">BDT - Bangladeshi Taka</option>
                <option value="INR">INR - Indian Rupee</option>
                <option value="TRY">TRY - Turkish Lira</option>
                <option value="IDR">IDR - Indonesian Rupiah</option>
                <option value="EGP">EGP - Egyptian Pound</option>
                <option value="ZAR">ZAR - South African Rand</option>
              </select>
            </div>

            <!-- Nisaab Info Card -->
            <div class="nisaab-card">
              <h2 class="nisaab-card-title">Nisaab Threshold: Islamic Standard</h2>
              <p>
                Nisaab is the minimum amount of wealth a Muslim must possess before Zakat becomes
                obligatory. It is based on either:
              </p>
              <ul>
                <li><strong>Gold Nisaab:</strong> 87.48 grams of gold</li>
                <li><strong>Silver Nisaab:</strong> 612.36 grams of silver</li>
              </ul>
              <p>
                Most scholars recommend using the Silver Nisaab as it includes more people and is
                more conservative. This calculator uses the Silver Nisaab by default.
              </p>
            </div>

            <!-- Section 1: Market Prices -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="trending-up" aria-hidden="true"></i>
                Current Market Prices
              </h2>
              <p class="calc-section-note">
                Enter today's local market price in your selected currency
                (<span class="cur-sym">PKR</span>)
              </p>

              <div class="form-grid-2">
                <div class="form-group">
                  <label class="form-label" for="gold-price">
                    Gold price (<span class="cur-sym">PKR</span>)
                  </label>
                  <div class="input-with-unit">
                    <input
                      type="number"
                      id="gold-price"
                      class="form-input"
                      placeholder="0"
                      min="0"
                      step="any"
                    />
                    <select id="gold-price-unit" class="form-select">
                      <option value="tola" selected>Per Tola</option>
                      <option value="grams">Per Gram</option>
                    </select>
                  </div>
                  <div class="auto-display" id="gold-price-helper">
                    = <span class="cur-sym">PKR</span>0.00 per gram
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="silver-price">
                    Silver price (<span class="cur-sym">PKR</span>)
                  </label>
                  <div class="input-with-unit">
                    <input
                      type="number"
                      id="silver-price"
                      class="form-input"
                      placeholder="0"
                      min="0"
                      step="any"
                    />
                    <select id="silver-price-unit" class="form-select">
                      <option value="tola" selected>Per Tola</option>
                      <option value="grams">Per Gram</option>
                    </select>
                  </div>
                  <div class="auto-display" id="silver-price-helper">
                    = <span class="cur-sym">PKR</span>0.00 per gram
                  </div>
                </div>
              </div>

              <div class="auto-display" id="silver-nisaab-display">
                Silver Nisaab (612.36g &times; 0.00 per gram): <strong>0.00</strong>
              </div>
              <div class="auto-display" id="gold-nisaab-display">
                Gold Nisaab (87.48g &times; 0.00 per gram): <strong>0.00</strong>
              </div>
            </div>

            <!-- Section 2: Gold -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="circle-dot" aria-hidden="true"></i>
                Gold
              </h2>
              <div class="form-group">
                <label class="form-label" for="gold-amount">Gold amount</label>
                <div class="input-with-unit">
                  <input
                    type="number"
                    id="gold-amount"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                  <select id="gold-unit" class="form-select">
                    <option value="tola" selected>Tola</option>
                    <option value="grams">Grams</option>
                  </select>
                </div>
              </div>
              <div class="auto-display" id="gold-value-display">
                Gold value: <strong>0.00</strong>
              </div>
            </div>

            <!-- Section 3: Silver -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="circle" aria-hidden="true"></i>
                Silver
              </h2>
              <div class="form-group">
                <label class="form-label" for="silver-amount">Silver amount</label>
                <div class="input-with-unit">
                  <input
                    type="number"
                    id="silver-amount"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                  <select id="silver-unit" class="form-select">
                    <option value="tola" selected>Tola</option>
                    <option value="grams">Grams</option>
                  </select>
                </div>
              </div>
              <div class="auto-display" id="silver-value-display">
                Silver value: <strong>0.00</strong>
              </div>
            </div>

            <!-- Section 4: Cash & Bank Balances -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="banknote" aria-hidden="true"></i>
                Cash &amp; Bank Balances
              </h2>
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="form-label" for="cash-hand">
                    Cash in hand (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="cash-hand"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="bank-balance">
                    Bank account balance (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="bank-balance"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="fixed-deposits">
                    Fixed deposits (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="fixed-deposits"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="foreign-currency">
                    Foreign currency held, converted value (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="foreign-currency"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
              </div>
            </div>

            <!-- Section 5: Business & Trade Assets -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="briefcase" aria-hidden="true"></i>
                Business &amp; Trade Assets
              </h2>
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="form-label" for="business-inventory">
                    Business inventory or stock value (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="business-inventory"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="receivables">
                    Money owed to you, receivables (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="receivables"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="shares">
                    Shares and stocks current value (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="shares"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="mutual-funds">
                    Mutual funds value (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="mutual-funds"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="crypto">
                    Cryptocurrency current value (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="crypto"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="other-business">
                    Other business assets (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="other-business"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
              </div>
            </div>

            <!-- Section 6: Investment Assets -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="building-2" aria-hidden="true"></i>
                Investment Assets
              </h2>
              <p class="calc-section-note">
                Only include properties and assets held for investment. Not your primary residence or
                personal use items.
              </p>
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="form-label" for="investment-property">
                    Investment property value (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="investment-property"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="rental-income">
                    Rental income receivable (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="rental-income"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="other-investments">
                    Other investments (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="other-investments"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
              </div>
            </div>

            <!-- Section 7: Debts & Liabilities -->
            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="minus-circle" aria-hidden="true"></i>
                Debts &amp; Liabilities to Deduct
              </h2>
              <p class="calc-section-note">
                Only include debts currently due within this lunar year
              </p>
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="form-label" for="personal-loans">
                    Personal loans due (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="personal-loans"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="business-debts">
                    Business debts due (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="business-debts"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="other-liabilities">
                    Other liabilities due (<span class="cur-sym">PKR</span>)
                  </label>
                  <input
                    type="number"
                    id="other-liabilities"
                    class="form-input"
                    placeholder="0"
                    min="0"
                    step="any"
                  />
                </div>
              </div>
            </div>

            <!-- Results Section -->
            <div class="results-section" id="results-section">
              <h2 class="results-section-title">
                <i data-lucide="calculator" aria-hidden="true"></i>
                Your Zakat Summary
              </h2>

              <div class="results-grid">
                <div class="result-card">
                  <p class="result-label">Total Assets</p>
                  <p class="result-value" id="result-total-assets">0.00</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Total Liabilities</p>
                  <p class="result-value" id="result-total-liabilities">0.00</p>
                </div>
                <div class="result-card result-card--accent">
                  <p class="result-label">Net Zakatable Wealth</p>
                  <p class="result-value" id="result-net-wealth">0.00</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Silver Nisaab Threshold</p>
                  <p class="result-value" id="result-silver-nisaab">0.00</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Gold Nisaab Threshold</p>
                  <p class="result-value" id="result-gold-nisaab">0.00</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Nisaab Status</p>
                  <div id="nisaab-status"></div>
                </div>
              </div>

              <div id="zakat-amount-card" class="zakat-amount-card">
                <div>
                  <p class="zakat-amount-label">Zakat Due</p>
                  <p class="zakat-amount-sub">2.5% of Net Zakatable Wealth</p>
                </div>
                <p class="zakat-amount-value" id="zakat-amount-big">0.00</p>
              </div>

              <p class="results-note">Zakat rate: 2.5% (1/40th of total wealth)</p>

              <button type="button" class="btn-reset" id="reset-btn">
                <i data-lucide="rotate-ccw" aria-hidden="true"></i>
                Clear all fields
              </button>
            </div>

            <!-- Footer Disclaimer -->
            <div class="tool-disclaimer">
              <p>
                Zakat calculations may vary based on scholarly opinion and individual circumstances.
                Gold and silver prices fluctuate daily. Always use current local market rates. This
                tool provides an estimate only. Verify with a trusted Islamic scholar or institution
                before paying Zakat.
              </p>
            </div>

          </div>
        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>
      (function () {
        var GOLD_NISAAB_GRAMS = 87.48;
        var SILVER_NISAAB_GRAMS = 612.36;
        var TOLA_TO_GRAMS = 11.664;
        var ZAKAT_RATE = 0.025;

        var CURRENCIES = {
          PKR: "\u20a8",
          USD: "$",
          GBP: "\u00a3",
          EUR: "\u20ac",
          AED: "AED ",
          SAR: "SAR ",
          CAD: "CA$",
          AUD: "A$",
          MYR: "RM",
          BDT: "\u09f3",
          INR: "\u20b9",
          TRY: "\u20ba",
          IDR: "Rp",
          EGP: "E\u00a3",
          ZAR: "R",
        };

        function getVal(id) {
          var v = parseFloat(document.getElementById(id).value);
          return isNaN(v) || v < 0 ? 0 : v;
        }

        function fmt(n) {
          return n.toLocaleString("en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          });
        }

        function getCurrencyCode() {
          return document.getElementById("currency-select").value;
        }

        function getCurrencySymbol() {
          var code = getCurrencyCode();
          return CURRENCIES[code] || code + " ";
        }

        function updateCurrencySymbols() {
          var sym = getCurrencySymbol();
          document.querySelectorAll(".cur-sym").forEach(function (el) {
            el.textContent = sym;
          });
        }

        function calculate() {
          var sym = getCurrencySymbol();

          // Resolve price per gram regardless of which unit the user entered
          var goldPriceRaw = getVal("gold-price");
          var goldPriceUnit = document.getElementById("gold-price-unit").value;
          var goldPricePerGram = goldPriceUnit === "tola"
            ? goldPriceRaw / TOLA_TO_GRAMS
            : goldPriceRaw;
          var goldPricePerTola = goldPriceUnit === "tola"
            ? goldPriceRaw
            : goldPriceRaw * TOLA_TO_GRAMS;

          var silverPriceRaw = getVal("silver-price");
          var silverPriceUnit = document.getElementById("silver-price-unit").value;
          var silverPricePerGram = silverPriceUnit === "tola"
            ? silverPriceRaw / TOLA_TO_GRAMS
            : silverPriceRaw;
          var silverPricePerTola = silverPriceUnit === "tola"
            ? silverPriceRaw
            : silverPriceRaw * TOLA_TO_GRAMS;

          // Helper text: show the converted equivalent
          document.getElementById("gold-price-helper").innerHTML = goldPriceUnit === "tola"
            ? "= " + sym + fmt(goldPricePerGram) + " per gram"
            : "= " + sym + fmt(goldPricePerTola) + " per tola";

          document.getElementById("silver-price-helper").innerHTML = silverPriceUnit === "tola"
            ? "= " + sym + fmt(silverPricePerGram) + " per gram"
            : "= " + sym + fmt(silverPricePerTola) + " per tola";

          // Nisaab always calculated from per-gram price
          var silverNisaab = SILVER_NISAAB_GRAMS * silverPricePerGram;
          var goldNisaab = GOLD_NISAAB_GRAMS * goldPricePerGram;

          document.getElementById("silver-nisaab-display").innerHTML =
            "Silver Nisaab (612.36g &times; " +
            sym +
            fmt(silverPricePerGram) +
            " per gram): <strong>" +
            sym +
            fmt(silverNisaab) +
            "</strong>";

          document.getElementById("gold-nisaab-display").innerHTML =
            "Gold Nisaab (87.48g &times; " +
            sym +
            fmt(goldPricePerGram) +
            " per gram): <strong>" +
            sym +
            fmt(goldNisaab) +
            "</strong>";

          var goldAmount = getVal("gold-amount");
          var goldUnit = document.getElementById("gold-unit").value;
          var goldGrams =
            goldUnit === "tola" ? goldAmount * TOLA_TO_GRAMS : goldAmount;
          var goldValue = goldGrams * goldPricePerGram;
          document.getElementById("gold-value-display").innerHTML =
            "Gold value: <strong>" + sym + fmt(goldValue) + "</strong>";

          var silverAmount = getVal("silver-amount");
          var silverUnit = document.getElementById("silver-unit").value;
          var silverGrams =
            silverUnit === "tola" ? silverAmount * TOLA_TO_GRAMS : silverAmount;
          var silverValue = silverGrams * silverPricePerGram;
          document.getElementById("silver-value-display").innerHTML =
            "Silver value: <strong>" + sym + fmt(silverValue) + "</strong>";

          var cashInHand = getVal("cash-hand");
          var bankBalance = getVal("bank-balance");
          var fixedDeposits = getVal("fixed-deposits");
          var foreignCurrency = getVal("foreign-currency");

          var businessInventory = getVal("business-inventory");
          var receivables = getVal("receivables");
          var shares = getVal("shares");
          var mutualFunds = getVal("mutual-funds");
          var crypto = getVal("crypto");
          var otherBusiness = getVal("other-business");

          var investmentProperty = getVal("investment-property");
          var rentalIncome = getVal("rental-income");
          var otherInvestments = getVal("other-investments");

          var personalLoans = getVal("personal-loans");
          var businessDebts = getVal("business-debts");
          var otherLiabilities = getVal("other-liabilities");

          var totalAssets =
            goldValue +
            silverValue +
            cashInHand +
            bankBalance +
            fixedDeposits +
            foreignCurrency +
            businessInventory +
            receivables +
            shares +
            mutualFunds +
            crypto +
            otherBusiness +
            investmentProperty +
            rentalIncome +
            otherInvestments;

          var totalLiabilities =
            personalLoans + businessDebts + otherLiabilities;

          var netWealth = Math.max(0, totalAssets - totalLiabilities);

          var aboveNisaab = silverNisaab > 0 && netWealth >= silverNisaab;
          var zakatDue = aboveNisaab ? netWealth * ZAKAT_RATE : 0;

          document.getElementById("result-total-assets").textContent =
            sym + fmt(totalAssets);
          document.getElementById("result-total-liabilities").textContent =
            sym + fmt(totalLiabilities);
          document.getElementById("result-net-wealth").textContent =
            sym + fmt(netWealth);
          document.getElementById("result-silver-nisaab").textContent =
            sym + fmt(silverNisaab);
          document.getElementById("result-gold-nisaab").textContent =
            sym + fmt(goldNisaab);

          var statusEl = document.getElementById("nisaab-status");
          if (silverPriceRaw === 0 || totalAssets === 0) {
            statusEl.innerHTML = "";
          } else if (aboveNisaab) {
            statusEl.innerHTML =
              '<span class="badge-due">Zakat is Due</span>';
          } else {
            statusEl.innerHTML =
              '<span class="badge-none">Below Nisaab - No Zakat Due</span>';
          }

          document.getElementById("zakat-amount-big").textContent =
            sym + fmt(zakatDue);
        }

        function onCurrencyChange() {
          updateCurrencySymbols();
          calculate();
        }

        function resetAll() {
          // Clear all number inputs
          document
            .querySelectorAll(".tool-container input[type='number']")
            .forEach(function (input) {
              input.value = "";
            });

          // Reset all selects to defaults
          document.getElementById("gold-price-unit").value = "tola";
          document.getElementById("silver-price-unit").value = "tola";
          document.getElementById("gold-unit").value = "tola";
          document.getElementById("silver-unit").value = "tola";

          var sym = getCurrencySymbol();
          var zero = sym + "0.00";

          // Reset price helper text
          document.getElementById("gold-price-helper").innerHTML =
            "= " + zero + " per gram";
          document.getElementById("silver-price-helper").innerHTML =
            "= " + zero + " per gram";

          // Reset nisaab displays
          document.getElementById("silver-nisaab-display").innerHTML =
            "Silver Nisaab (612.36g &times; " + zero + " per gram): <strong>" + zero + "</strong>";
          document.getElementById("gold-nisaab-display").innerHTML =
            "Gold Nisaab (87.48g &times; " + zero + " per gram): <strong>" + zero + "</strong>";

          // Reset metal value displays
          document.getElementById("gold-value-display").innerHTML =
            "Gold value: <strong>" + zero + "</strong>";
          document.getElementById("silver-value-display").innerHTML =
            "Silver value: <strong>" + zero + "</strong>";

          // Reset result cards
          document.getElementById("result-total-assets").textContent = zero;
          document.getElementById("result-total-liabilities").textContent = zero;
          document.getElementById("result-net-wealth").textContent = zero;
          document.getElementById("result-silver-nisaab").textContent = zero;
          document.getElementById("result-gold-nisaab").textContent = zero;

          // Reset nisaab status badge to empty
          document.getElementById("nisaab-status").innerHTML = "";

          // Reset zakat due amount
          document.getElementById("zakat-amount-big").textContent = zero;
          document.getElementById("zakat-amount-sub").textContent =
            "2.5% of Net Zakatable Wealth";
        }

        function init() {
          // Single delegated listener on the container covers every input
          // and select inside it - no per-element loops, no duplicates
          var container = document.querySelector(".tool-container");
          container.addEventListener("input", calculate);
          container.addEventListener("change", calculate);

          document
            .getElementById("currency-select")
            .addEventListener("change", onCurrencyChange);

          document
            .getElementById("reset-btn")
            .addEventListener("click", resetAll);

          updateCurrencySymbols();
          calculate();
        }

        if (document.readyState === "loading") {
          document.addEventListener("DOMContentLoaded", init);
        } else {
          init();
        }
      })();
    </script>
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
