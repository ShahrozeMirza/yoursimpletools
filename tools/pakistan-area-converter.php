<?php $pageJS = '../js/pakistan-area-converter.js'; ?>
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
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
