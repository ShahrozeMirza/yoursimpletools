<?php $pageJS = '/js/unit-converter.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Unit Converter - Convert Length Weight Temperature and More | YourSimpleTools</title>
<meta name="description" content="Convert units instantly. Length, weight, temperature, area, volume, speed and more. Free online unit converter tool - no signup required.">
<meta name="keywords" content="unit converter, length converter, weight converter, temperature converter, metric converter, measurement converter">
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="/">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="/tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Unit Converter</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Unit Converter</h1>
            <p class="tool-page-desc">Convert between units of length, weight, temperature, area, volume and speed instantly.</p>
          </div>

          <div class="tool-container">

            <!-- Category Tabs -->
            <div class="bmi-unit-toggle" role="tablist" aria-label="Unit category">
              <button
                type="button"
                class="bmi-unit-btn bmi-unit-btn--active"
                id="tab-length"
                role="tab"
                aria-selected="true"
                data-category="length"
              >Length</button>
              <button
                type="button"
                class="bmi-unit-btn"
                id="tab-weight"
                role="tab"
                aria-selected="false"
                data-category="weight"
              >Weight</button>
              <button
                type="button"
                class="bmi-unit-btn"
                id="tab-temperature"
                role="tab"
                aria-selected="false"
                data-category="temperature"
              >Temp</button>
              <button
                type="button"
                class="bmi-unit-btn"
                id="tab-area"
                role="tab"
                aria-selected="false"
                data-category="area"
              >Area</button>
              <button
                type="button"
                class="bmi-unit-btn"
                id="tab-volume"
                role="tab"
                aria-selected="false"
                data-category="volume"
              >Volume</button>
              <button
                type="button"
                class="bmi-unit-btn"
                id="tab-speed"
                role="tab"
                aria-selected="false"
                data-category="speed"
              >Speed</button>
              <button
                type="button"
                class="bmi-unit-btn"
                id="tab-time"
                role="tab"
                aria-selected="false"
                data-category="time"
              >Time</button>
              <button
                type="button"
                class="bmi-unit-btn"
                id="tab-data"
                role="tab"
                aria-selected="false"
                data-category="data"
              >Data</button>
            </div>

            <!-- Value Input -->
            <div class="form-group">
              <label class="form-label" for="input-value">Value</label>
              <input
                type="number"
                class="form-input"
                id="input-value"
                placeholder="Enter value"
                step="any"
                aria-label="Value to convert"
              />
            </div>

            <!-- From Unit -->
            <div class="form-group">
              <label class="form-label" for="from-unit">From</label>
              <select class="form-select" id="from-unit" aria-label="Convert from unit"></select>
            </div>

            <!-- Swap Button -->
            <div class="flex-center mt-4">
              <button
                type="button"
                class="btn-secondary flex-center gap-8"
                id="swap-btn"
                aria-label="Swap from and to units"
              >
                <i data-lucide="arrow-left-right" aria-hidden="true"></i>
                Swap
              </button>
            </div>

            <!-- To Unit -->
            <div class="form-group mt-12">
              <label class="form-label" for="to-unit">To</label>
              <select class="form-select" id="to-unit" aria-label="Convert to unit"></select>
            </div>

            <!-- Convert Button -->
            <button
              type="button"
              class="btn-primary w-full flex-center gap-8 mt-20"
              id="convert-btn"
            >
              <i data-lucide="refresh-cw" aria-hidden="true"></i>
              Convert
            </button>

            <!-- Result Display -->
            <div class="results-section mt-20" id="result-section">
              <h2 class="results-section-title">
                <i data-lucide="calculator" aria-hidden="true"></i>
                Result
              </h2>
              <div class="result-card result-card--accent">
                <p class="result-label">Converted Value</p>
                <p class="result-value text-accent" id="result-display">--</p>
              </div>
              <p class="text-muted text-small mt-4" id="result-formula"></p>
              <div class="mt-12">
                <button
                  type="button"
                  class="btn-secondary flex-center gap-8"
                  id="copy-result-btn"
                  aria-label="Copy result to clipboard"
                >
                  <i data-lucide="copy" aria-hidden="true"></i>
                  <span id="copy-btn-label">Copy Result</span>
                </button>
              </div>
            </div>

            <!-- Reference Table: Length -->
            <div class="results-section mt-20" id="ref-length">
              <h2 class="results-section-title">
                <i data-lucide="ruler" aria-hidden="true"></i>
                Common Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>Value</th>
                      <th>Equivalents</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 km</td>
                      <td>0.621 mi | 1093.61 yd | 3280.84 ft</td>
                    </tr>
                    <tr>
                      <td>1 mile</td>
                      <td>1.609 km | 1760 yd | 5280 ft</td>
                    </tr>
                    <tr>
                      <td>1 meter</td>
                      <td>3.281 ft | 1.094 yd | 39.37 in</td>
                    </tr>
                    <tr>
                      <td>1 foot</td>
                      <td>30.48 cm | 0.305 m | 12 in</td>
                    </tr>
                    <tr>
                      <td>1 inch</td>
                      <td>2.54 cm | 0.0254 m | 0.0833 ft</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Reference Table: Weight -->
            <div class="results-section mt-20 hidden" id="ref-weight">
              <h2 class="results-section-title">
                <i data-lucide="scale" aria-hidden="true"></i>
                Common Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>Value</th>
                      <th>Equivalents</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 kg</td>
                      <td>2.205 lb | 35.274 oz | 1000 g</td>
                    </tr>
                    <tr>
                      <td>1 lb</td>
                      <td>0.454 kg | 16 oz | 453.59 g</td>
                    </tr>
                    <tr>
                      <td>1 stone</td>
                      <td>6.35 kg | 14 lb</td>
                    </tr>
                    <tr>
                      <td>1 oz</td>
                      <td>28.35 g | 0.0625 lb</td>
                    </tr>
                    <tr>
                      <td>1 tola</td>
                      <td>11.664 g | 0.4114 oz</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Reference Table: Temperature -->
            <div class="results-section mt-20 hidden" id="ref-temperature">
              <h2 class="results-section-title">
                <i data-lucide="thermometer" aria-hidden="true"></i>
                Common Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>Celsius</th>
                      <th>Fahrenheit</th>
                      <th>Kelvin</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>0 C</td>
                      <td>32 F</td>
                      <td>273.15 K</td>
                      <td>Freezing point</td>
                    </tr>
                    <tr>
                      <td>100 C</td>
                      <td>212 F</td>
                      <td>373.15 K</td>
                      <td>Boiling point</td>
                    </tr>
                    <tr>
                      <td>37 C</td>
                      <td>98.6 F</td>
                      <td>310.15 K</td>
                      <td>Body temperature</td>
                    </tr>
                    <tr>
                      <td>-40 C</td>
                      <td>-40 F</td>
                      <td>233.15 K</td>
                      <td>Same in C and F</td>
                    </tr>
                    <tr>
                      <td>20 C</td>
                      <td>68 F</td>
                      <td>293.15 K</td>
                      <td>Room temperature</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Reference Table: Area -->
            <div class="results-section mt-20 hidden" id="ref-area">
              <h2 class="results-section-title">
                <i data-lucide="square" aria-hidden="true"></i>
                Common Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>Value</th>
                      <th>Equivalents</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 acre</td>
                      <td>4046.86 sq m | 43560 sq ft | 4840 sq yd</td>
                    </tr>
                    <tr>
                      <td>1 hectare</td>
                      <td>10000 sq m | 2.471 acres</td>
                    </tr>
                    <tr>
                      <td>1 sq km</td>
                      <td>100 hectares | 0.386 sq mi</td>
                    </tr>
                    <tr>
                      <td>1 sq mile</td>
                      <td>640 acres | 2.59 sq km</td>
                    </tr>
                    <tr>
                      <td>1 marla</td>
                      <td>25.29 sq m | 272.25 sq ft</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Reference Table: Volume -->
            <div class="results-section mt-20 hidden" id="ref-volume">
              <h2 class="results-section-title">
                <i data-lucide="droplets" aria-hidden="true"></i>
                Common Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>Value</th>
                      <th>Equivalents</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 L</td>
                      <td>1000 mL | 0.264 gal | 33.814 fl oz</td>
                    </tr>
                    <tr>
                      <td>1 gallon</td>
                      <td>3.785 L | 4 qt | 8 pt</td>
                    </tr>
                    <tr>
                      <td>1 cup</td>
                      <td>236.59 mL | 8 fl oz | 16 tbsp</td>
                    </tr>
                    <tr>
                      <td>1 tbsp</td>
                      <td>3 tsp | 14.79 mL</td>
                    </tr>
                    <tr>
                      <td>1 pint</td>
                      <td>2 cups | 473.18 mL</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Reference Table: Speed -->
            <div class="results-section mt-20 hidden" id="ref-speed">
              <h2 class="results-section-title">
                <i data-lucide="gauge" aria-hidden="true"></i>
                Common Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>Value</th>
                      <th>Equivalents</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 km/h</td>
                      <td>0.621 mph | 0.278 m/s</td>
                    </tr>
                    <tr>
                      <td>1 mph</td>
                      <td>1.609 km/h | 0.447 m/s</td>
                    </tr>
                    <tr>
                      <td>1 m/s</td>
                      <td>3.6 km/h | 2.237 mph</td>
                    </tr>
                    <tr>
                      <td>1 knot</td>
                      <td>1.852 km/h | 1.151 mph</td>
                    </tr>
                    <tr>
                      <td>Speed of sound</td>
                      <td>343 m/s | 1235 km/h</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Reference Table: Time -->
            <div class="results-section mt-20 hidden" id="ref-time">
              <h2 class="results-section-title">
                <i data-lucide="clock" aria-hidden="true"></i>
                Common Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>Value</th>
                      <th>Equivalents</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 min</td>
                      <td>60 sec | 0.0167 hr</td>
                    </tr>
                    <tr>
                      <td>1 hour</td>
                      <td>60 min | 3600 sec</td>
                    </tr>
                    <tr>
                      <td>1 day</td>
                      <td>24 hr | 1440 min | 86400 sec</td>
                    </tr>
                    <tr>
                      <td>1 week</td>
                      <td>7 days | 168 hr</td>
                    </tr>
                    <tr>
                      <td>1 year</td>
                      <td>365.25 days | 8766 hr | 525960 min</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Reference Table: Data Storage -->
            <div class="results-section mt-20 hidden" id="ref-data">
              <h2 class="results-section-title">
                <i data-lucide="hard-drive" aria-hidden="true"></i>
                Common Conversions
              </h2>
              <div class="conv-table-wrapper">
                <table class="conv-table">
                  <thead>
                    <tr>
                      <th>Value</th>
                      <th>Equivalents</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 KB</td>
                      <td>1000 B | 8000 bits</td>
                    </tr>
                    <tr>
                      <td>1 MB</td>
                      <td>1000 KB | 1000000 B</td>
                    </tr>
                    <tr>
                      <td>1 GB</td>
                      <td>1000 MB | 1000000 KB</td>
                    </tr>
                    <tr>
                      <td>1 TB</td>
                      <td>1000 GB | 1000000 MB</td>
                    </tr>
                    <tr>
                      <td>1 GiB</td>
                      <td>1.074 GB | 1024 MiB</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <!-- end tool-container -->

          <div class="tool-disclaimer mt-20">
            <p>All conversions happen locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
  </body>
</html>
