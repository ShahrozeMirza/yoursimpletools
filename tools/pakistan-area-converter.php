<?php include '../includes/head.php'; ?>
<title>Pakistan Area Converter - Marla Kanal Square Feet Gaz | YourSimpleTools</title>
<meta name="description" content="Convert between Marla, Kanal, Square Feet, Square Yards and Acre. Supports Lahore LDA and Standard Punjab standards. Free Pakistan property calculator." />
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Pakistan Area Converter</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Pakistan Area Converter</h1>
            <p class="tool-page-desc">
              Convert between Marla, Kanal, Square Feet, Square Yards (Gaz), and Acre.
              Supports all regional Pakistani standards.
            </p>
          </div>

          <!-- Regional Standard Selector -->
          <div class="tool-container">
            <p class="calc-section-title">
              <i data-lucide="map-pin" aria-hidden="true"></i>
              Select Your Regional Standard
            </p>
            <div class="results-grid mt-16" role="radiogroup" aria-label="Select regional standard">

              <label class="result-card tool-card result-card--accent" id="card-punjab" for="std-punjab">
                <input type="radio" name="standard" id="std-punjab" value="punjab" class="hidden" checked />
                <p class="result-label">Standard Punjab / KPK / Revenue</p>
                <p class="result-value">1 Marla = 272.25 sq ft</p>
                <p class="text-small text-muted mt-8">Used in: Islamabad, KPK, Rural Punjab, Revenue records</p>
              </label>

              <label class="result-card tool-card" id="card-lahore" for="std-lahore">
                <input type="radio" name="standard" id="std-lahore" value="lahore" class="hidden" />
                <p class="result-label">Lahore / LDA / DHA</p>
                <p class="result-value">1 Marla = 225 sq ft</p>
                <p class="text-small text-muted mt-8">Used in: Lahore city, LDA schemes, DHA Lahore, most Lahore housing societies</p>
              </label>

              <label class="result-card tool-card" id="card-karachi" for="std-karachi">
                <input type="radio" name="standard" id="std-karachi" value="karachi" class="hidden" />
                <p class="result-label">Karachi / Sindh</p>
                <p class="result-value">Measurements in Gaz (Sq Yards)</p>
                <p class="text-small text-muted mt-8">Used in: Karachi, Hyderabad, Sindh cities</p>
              </label>

            </div>
          </div>

          <!-- Converter Interface -->
          <div class="tool-container mt-24">

            <div class="form-grid-2">
              <div class="form-group">
                <label class="form-label" for="area-input">Enter Value</label>
                <input
                  type="number"
                  id="area-input"
                  class="form-input"
                  placeholder="Enter area"
                  min="0"
                  step="any"
                />
              </div>
              <div class="form-group">
                <label class="form-label" for="from-unit">From Unit</label>
                <select id="from-unit" class="form-select">
                  <!-- Populated by JS -->
                </select>
              </div>
            </div>

            <button
              type="button"
              id="convert-btn"
              class="btn-primary w-full flex-center gap-8 justify-center"
            >
              <i data-lucide="refresh-cw" aria-hidden="true"></i>
              Convert
            </button>

            <!-- Results: Punjab / Lahore -->
            <div id="results-punjab" class="results-section hidden">
              <p class="results-section-title">
                <i data-lucide="calculator" aria-hidden="true"></i>
                Conversion Results
              </p>
              <div class="results-grid">

                <div class="result-card">
                  <p class="result-label">Marla</p>
                  <p class="result-value text-accent" id="res-marla">--</p>
                  <p class="text-small text-muted mt-8" id="marla-note">272.25 sq ft per Marla</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-marla" aria-label="Copy Marla value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Kanal</p>
                  <p class="result-value text-accent" id="res-kanal">--</p>
                  <p class="text-small text-muted mt-8">1 Kanal = 20 Marla</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-kanal" aria-label="Copy Kanal value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Acre / Killa</p>
                  <p class="result-value text-accent" id="res-acre-pk">--</p>
                  <p class="text-small text-muted mt-8">1 Acre = 43,560 sq ft</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-acre-pk" aria-label="Copy Acre value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Murabba</p>
                  <p class="result-value text-accent" id="res-murabba">--</p>
                  <p class="text-small text-muted mt-8">1 Murabba = 25 Acres</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-murabba" aria-label="Copy Murabba value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Square Feet</p>
                  <p class="result-value text-accent" id="res-sqft-pk">--</p>
                  <p class="text-small text-muted mt-8">International standard</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-sqft-pk" aria-label="Copy Square Feet value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Square Yards (Gaz)</p>
                  <p class="result-value text-accent" id="res-sqyd-pk">--</p>
                  <p class="text-small text-muted mt-8">1 Gaz = 9 sq ft</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-sqyd-pk" aria-label="Copy Square Yards value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Square Meters</p>
                  <p class="result-value text-accent" id="res-sqm-pk">--</p>
                  <p class="text-small text-muted mt-8">1 sq m = 10.7639 sq ft</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-sqm-pk" aria-label="Copy Square Meters value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Sarsai</p>
                  <p class="result-value text-accent" id="res-sarsai">--</p>
                  <p class="text-small text-muted mt-8">1 Sarsai = 30.25 sq ft</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-sarsai" aria-label="Copy Sarsai value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

              </div>
            </div>

            <!-- Results: Karachi / Sindh -->
            <div id="results-karachi" class="results-section hidden">
              <p class="results-section-title">
                <i data-lucide="calculator" aria-hidden="true"></i>
                Conversion Results
              </p>
              <div class="results-grid">

                <div class="result-card">
                  <p class="result-label">Square Yards (Gaz)</p>
                  <p class="result-value text-accent" id="res-sqyd-khi">--</p>
                  <p class="text-small text-muted mt-8">Primary unit in Karachi</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-sqyd-khi" aria-label="Copy Square Yards value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Square Feet</p>
                  <p class="result-value text-accent" id="res-sqft-khi">--</p>
                  <p class="text-small text-muted mt-8">1 Gaz = 9 sq ft</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-sqft-khi" aria-label="Copy Square Feet value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Square Meters</p>
                  <p class="result-value text-accent" id="res-sqm-khi">--</p>
                  <p class="text-small text-muted mt-8">1 sq yd = 0.8361 sq m</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-sqm-khi" aria-label="Copy Square Meters value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

                <div class="result-card">
                  <p class="result-label">Acre</p>
                  <p class="result-value text-accent" id="res-acre-khi">--</p>
                  <p class="text-small text-muted mt-8">1 Acre = 4,840 sq yd</p>
                  <button class="multi-copy-btn copy-result-btn mt-8" data-target="res-acre-khi" aria-label="Copy Acre value">
                    <i data-lucide="copy" aria-hidden="true"></i>
                  </button>
                </div>

              </div>
            </div>

          </div>

          <!-- Quick Reference Table -->
          <div class="tool-container mt-24">
            <p class="calc-section-title">
              <i data-lucide="table-2" aria-hidden="true"></i>
              Common Plot Sizes in Pakistan
            </p>

            <div id="ref-table-punjab" class="mt-16">
              <p class="text-small text-muted mb-8">Standard Punjab / Islamabad (272.25 sq ft per Marla)</p>
              <table>
                <thead>
                  <tr>
                    <th>Plot Size</th>
                    <th>Marla</th>
                    <th>Square Feet</th>
                    <th>Square Yards</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>3 Marla</td><td>3</td><td>817 sqft</td><td>90.75 sqyd</td>
                  </tr>
                  <tr>
                    <td>5 Marla</td><td>5</td><td>1,361 sqft</td><td>151.25 sqyd</td>
                  </tr>
                  <tr>
                    <td>7 Marla</td><td>7</td><td>1,905 sqft</td><td>211.75 sqyd</td>
                  </tr>
                  <tr>
                    <td>10 Marla</td><td>10</td><td>2,723 sqft</td><td>302.5 sqyd</td>
                  </tr>
                  <tr>
                    <td>1 Kanal</td><td>20</td><td>5,445 sqft</td><td>605 sqyd</td>
                  </tr>
                  <tr>
                    <td>2 Kanal</td><td>40</td><td>10,890 sqft</td><td>1,210 sqyd</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div id="ref-table-lahore" class="mt-16 hidden">
              <p class="text-small text-muted mb-8">Lahore / LDA / DHA (225 sq ft per Marla)</p>
              <table>
                <thead>
                  <tr>
                    <th>Plot Size</th>
                    <th>Marla</th>
                    <th>Square Feet</th>
                    <th>Square Yards</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>3 Marla</td><td>3</td><td>675 sqft</td><td>75 sqyd</td>
                  </tr>
                  <tr>
                    <td>5 Marla</td><td>5</td><td>1,125 sqft</td><td>125 sqyd</td>
                  </tr>
                  <tr>
                    <td>7 Marla</td><td>7</td><td>1,575 sqft</td><td>175 sqyd</td>
                  </tr>
                  <tr>
                    <td>10 Marla</td><td>10</td><td>2,250 sqft</td><td>250 sqyd</td>
                  </tr>
                  <tr>
                    <td>1 Kanal</td><td>20</td><td>4,500 sqft</td><td>500 sqyd</td>
                  </tr>
                  <tr>
                    <td>2 Kanal</td><td>40</td><td>9,000 sqft</td><td>1,000 sqyd</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div id="ref-table-karachi" class="mt-16 hidden">
              <p class="text-small text-muted mb-8">Karachi / Sindh (1 Gaz = 9 sq ft)</p>
              <table>
                <thead>
                  <tr>
                    <th>Plot Size</th>
                    <th>Square Yards</th>
                    <th>Square Feet</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>80 Gaz</td><td>80 sqyd</td><td>720 sqft</td>
                  </tr>
                  <tr>
                    <td>120 Gaz</td><td>120 sqyd</td><td>1,080 sqft</td>
                  </tr>
                  <tr>
                    <td>240 Gaz</td><td>240 sqyd</td><td>2,160 sqft</td>
                  </tr>
                  <tr>
                    <td>400 Gaz</td><td>400 sqyd</td><td>3,600 sqft</td>
                  </tr>
                  <tr>
                    <td>500 Gaz</td><td>500 sqyd</td><td>4,500 sqft</td>
                  </tr>
                  <tr>
                    <td>1000 Gaz</td><td>1,000 sqyd</td><td>9,000 sqft</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Land Unit Guide -->
          <div class="mt-48">
            <h2 class="section-title">Pakistan Land Measurement Guide</h2>
            <p class="section-subtitle mt-8">Understand every unit used in Pakistani property transactions</p>
          </div>

          <div class="mt-24">

            <div class="nisaab-card">
              <p class="nisaab-card-title">Marla</p>
              <p>
                The most commonly used unit for residential plots in Pakistan. Important: The size of a
                Marla varies by region.
              </p>
              <ul>
                <li>Standard / Revenue Marla: 272.25 sq ft - Used in KPK, rural Punjab, revenue records, Islamabad housing schemes</li>
                <li>Lahore / LDA Marla: 225 sq ft - Used in Lahore city, LDA-approved schemes, DHA Lahore, most Lahore private societies</li>
              </ul>
              <p>Always confirm which standard applies before purchasing a plot.</p>
            </div>

            <div class="nisaab-card mt-16">
              <p class="nisaab-card-title">Kanal</p>
              <p>1 Kanal = 20 Marla (fixed everywhere)</p>
              <p>Standard: 5,445 sq ft / Lahore: 4,500 sq ft</p>
              <p>
                Commonly used for larger residential plots and farmhouses in Punjab.
              </p>
            </div>

            <div class="nisaab-card mt-16">
              <p class="nisaab-card-title">Gaz (Square Yard)</p>
              <p>1 Gaz = 9 Square Feet (fixed)</p>
              <p>
                The standard unit in Karachi and Sindh.
                Common plot sizes: 80, 120, 240, 400, 500 Gaz.
                DHA Karachi uses Gaz as the primary unit.
              </p>
            </div>

            <div class="nisaab-card mt-16">
              <p class="nisaab-card-title">Acre / Killa</p>
              <p>1 Acre = 8 Kanal = 43,560 sq ft = 4,840 sq yd (fixed internationally)</p>
              <p>
                Used for agricultural land and large commercial plots across all of Pakistan.
              </p>
            </div>

            <div class="nisaab-card mt-16">
              <p class="nisaab-card-title">Murabba</p>
              <p>1 Murabba = 25 Acres = 200 Kanal</p>
              <p>
                A traditional unit used exclusively for large agricultural land in Punjab.
                Rarely used in modern real estate.
              </p>
            </div>

            <div class="nisaab-card mt-16">
              <p class="nisaab-card-title">Sarsai</p>
              <p>1 Sarsai = 30.25 sq ft (1 square Karam)</p>
              <p>9 Sarsai = 1 Marla</p>
              <p>
                Traditional unit from Punjab revenue system.
                Still used in older land records.
              </p>
            </div>

          </div>

          <!-- Disclaimer -->
          <div class="tool-disclaimer mt-32">
            <p>
              Land measurement standards vary by housing society, city, and region. Always verify the
              applicable standard with your real estate agent or housing authority before making
              any property decisions. This tool uses the most widely accepted standards for each region.
            </p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>
      (function () {
        // Conversion constants
        var STD = {
          punjab: {
            marla: 272.25,
            sarsai: 30.25,
            kanal: 272.25 * 20,
            acre: 43560,
            murabba: 43560 * 25,
            sqyd: 9,
            sqmeter: 10.7639
          },
          lahore: {
            marla: 225,
            sarsai: 30.25,
            kanal: 225 * 20,
            acre: 43560,
            murabba: 43560 * 25,
            sqyd: 9,
            sqmeter: 10.7639
          },
          karachi: {
            sqyd: 9,
            acre: 4840,
            sqmeter_per_sqyd: 10.7639 / 9
          }
        };

        var currentStandard = "punjab";

        function formatNum(n) {
          if (!isFinite(n) || isNaN(n)) return "--";
          if (n === 0) return "0";
          if (n < 1) return n.toFixed(4);
          if (n < 1000) return n.toFixed(2);
          return n.toLocaleString("en", { maximumFractionDigits: 2 });
        }

        function toBaseSqft(value, unit, std) {
          var s = STD[std];
          switch (unit) {
            case "marla": return value * s.marla;
            case "kanal": return value * s.kanal;
            case "acre": return value * s.acre;
            case "murabba": return value * s.murabba;
            case "sqft": return value;
            case "sqyd": return value * s.sqyd;
            case "sqmeter": return value * s.sqmeter;
            default: return 0;
          }
        }

        function fromBaseSqft(base, unit, std) {
          var s = STD[std];
          switch (unit) {
            case "marla": return base / s.marla;
            case "kanal": return base / s.kanal;
            case "acre": return base / s.acre;
            case "murabba": return base / s.murabba;
            case "sqft": return base;
            case "sqyd": return base / s.sqyd;
            case "sqmeter": return base / s.sqmeter;
            case "sarsai": return base / s.sarsai;
            default: return 0;
          }
        }

        function toBaseSqyd(value, unit) {
          var s = STD.karachi;
          switch (unit) {
            case "sqyd": return value;
            case "sqft": return value / s.sqyd;
            case "sqmeter": return value * s.sqmeter_per_sqyd;
            case "acre": return value * s.acre;
            default: return 0;
          }
        }

        function fromBaseSqyd(base, unit) {
          var s = STD.karachi;
          switch (unit) {
            case "sqyd": return base;
            case "sqft": return base * s.sqyd;
            case "sqmeter": return base / s.sqmeter_per_sqyd;
            case "acre": return base / s.acre;
            default: return 0;
          }
        }

        function updateUnitOptions() {
          var select = document.getElementById("from-unit");
          var prevVal = select.value;
          select.innerHTML = "";
          var options;

          if (currentStandard === "karachi") {
            options = [
              { value: "sqyd", label: "Square Yards (Gaz)" },
              { value: "sqft", label: "Square Feet" },
              { value: "sqmeter", label: "Square Meters" },
              { value: "acre", label: "Acre" }
            ];
          } else {
            var ms = currentStandard === "punjab" ? "272.25" : "225";
            options = [
              { value: "marla", label: "Marla (" + ms + " sq ft)" },
              { value: "kanal", label: "Kanal (20 Marla)" },
              { value: "acre", label: "Acre / Killa (8 Kanal)" },
              { value: "murabba", label: "Murabba (25 Acres)" },
              { value: "sqft", label: "Square Feet" },
              { value: "sqyd", label: "Square Yards (Gaz)" },
              { value: "sqmeter", label: "Square Meters" }
            ];
          }

          options.forEach(function (opt) {
            var el = document.createElement("option");
            el.value = opt.value;
            el.textContent = opt.label;
            select.appendChild(el);
          });

          // Restore selection if the unit still exists in the new list
          var validVals = options.map(function (o) { return o.value; });
          if (validVals.indexOf(prevVal) !== -1) {
            select.value = prevVal;
          }
        }

        function updateResults() {
          var inputEl = document.getElementById("area-input");
          var value = parseFloat(inputEl.value);
          var unit = document.getElementById("from-unit").value;

          var resultsPunjab = document.getElementById("results-punjab");
          var resultsKarachi = document.getElementById("results-karachi");

          if (!inputEl.value || isNaN(value) || value < 0) {
            resultsPunjab.classList.add("hidden");
            resultsKarachi.classList.add("hidden");
            return;
          }

          if (currentStandard === "karachi") {
            resultsPunjab.classList.add("hidden");
            resultsKarachi.classList.remove("hidden");

            var baseKhi = toBaseSqyd(value, unit);
            document.getElementById("res-sqyd-khi").textContent = formatNum(fromBaseSqyd(baseKhi, "sqyd"));
            document.getElementById("res-sqft-khi").textContent = formatNum(fromBaseSqyd(baseKhi, "sqft"));
            document.getElementById("res-sqm-khi").textContent = formatNum(fromBaseSqyd(baseKhi, "sqmeter"));
            document.getElementById("res-acre-khi").textContent = formatNum(fromBaseSqyd(baseKhi, "acre"));
          } else {
            resultsKarachi.classList.add("hidden");
            resultsPunjab.classList.remove("hidden");

            var basePk = toBaseSqft(value, unit, currentStandard);
            document.getElementById("res-marla").textContent = formatNum(fromBaseSqft(basePk, "marla", currentStandard));
            document.getElementById("res-kanal").textContent = formatNum(fromBaseSqft(basePk, "kanal", currentStandard));
            document.getElementById("res-acre-pk").textContent = formatNum(fromBaseSqft(basePk, "acre", currentStandard));
            document.getElementById("res-murabba").textContent = formatNum(fromBaseSqft(basePk, "murabba", currentStandard));
            document.getElementById("res-sqft-pk").textContent = formatNum(fromBaseSqft(basePk, "sqft", currentStandard));
            document.getElementById("res-sqyd-pk").textContent = formatNum(fromBaseSqft(basePk, "sqyd", currentStandard));
            document.getElementById("res-sqm-pk").textContent = formatNum(fromBaseSqft(basePk, "sqmeter", currentStandard));
            document.getElementById("res-sarsai").textContent = formatNum(fromBaseSqft(basePk, "sarsai", currentStandard));
          }
        }

        function updateRefTable(std) {
          ["punjab", "lahore", "karachi"].forEach(function (key) {
            var el = document.getElementById("ref-table-" + key);
            if (el) el.classList.add("hidden");
          });
          var target = std === "lahore" ? "lahore" : std === "karachi" ? "karachi" : "punjab";
          var targetEl = document.getElementById("ref-table-" + target);
          if (targetEl) targetEl.classList.remove("hidden");
        }

        function changeStandard(std) {
          currentStandard = std;

          // Update card selected state
          ["punjab", "lahore", "karachi"].forEach(function (s) {
            var card = document.getElementById("card-" + s);
            if (s === std) {
              card.classList.add("result-card--accent");
            } else {
              card.classList.remove("result-card--accent");
            }
          });

          // Update marla note text
          var marlaNote = document.getElementById("marla-note");
          if (marlaNote) {
            marlaNote.textContent = std === "lahore" ? "225 sq ft per Marla" : "272.25 sq ft per Marla";
          }

          updateUnitOptions();
          updateRefTable(std);
          updateResults();
        }

        function copyValue(btn, value) {
          if (!navigator.clipboard) {
            return;
          }
          navigator.clipboard.writeText(value).then(function () {
            var origHTML = btn.innerHTML;
            btn.innerHTML = '<i data-lucide="check" aria-hidden="true"></i>';
            lucide.createIcons();
            setTimeout(function () {
              btn.innerHTML = origHTML;
              lucide.createIcons();
            }, 1500);
          });
        }

        function init() {
          // Standard card clicks
          ["punjab", "lahore", "karachi"].forEach(function (std) {
            document.getElementById("card-" + std).addEventListener("click", function () {
              document.getElementById("std-" + std).checked = true;
              changeStandard(std);
            });
          });

          // Live conversion on input
          document.getElementById("area-input").addEventListener("input", updateResults);
          document.getElementById("from-unit").addEventListener("change", updateResults);

          // Convert button
          document.getElementById("convert-btn").addEventListener("click", updateResults);

          // Copy buttons
          document.querySelectorAll(".copy-result-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
              var targetId = btn.getAttribute("data-target");
              var valEl = document.getElementById(targetId);
              if (valEl) copyValue(btn, valEl.textContent);
            });
          });

          // Initialize unit options and reference table
          updateUnitOptions();
          updateRefTable("punjab");
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
