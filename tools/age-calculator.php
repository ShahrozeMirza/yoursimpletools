<?php $pageJS = '../js/age-calculator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Age Calculator - Calculate Your Exact Age | YourSimpleTools</title>
<meta name="description" content="Calculate your exact age in years, months, days, hours and minutes. Find days until your next birthday. Free online age calculator." />
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Age Calculator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Age Calculator</h1>
            <p class="tool-page-desc">Calculate your exact age in years, months, days and more instantly.</p>
          </div>

          <div class="tool-container">

            <!-- Section 1: Date Inputs -->
            <div class="form-grid-2">
              <div class="form-group">
                <label for="dob-input" class="form-label">Date of Birth</label>
                <input
                  type="date"
                  id="dob-input"
                  class="form-input"
                  aria-label="Date of birth"
                />
              </div>
              <div class="form-group">
                <label for="asof-input" class="form-label">Calculate Age As Of</label>
                <input
                  type="date"
                  id="asof-input"
                  class="form-input"
                  aria-label="Calculate age as of date"
                />
              </div>
            </div>

            <button type="button" class="btn-primary w-full flex-center gap-8" id="btn-calculate">
              <i data-lucide="calculator" aria-hidden="true"></i>
              Calculate Age
            </button>

            <!-- Error notice -->
            <div id="error-notice" class="notice-box notice-warning mt-20 hidden" role="alert">
              <span class="notice-icon">
                <i data-lucide="alert-triangle" aria-hidden="true"></i>
              </span>
              <p id="error-message">Please enter your date of birth.</p>
            </div>

            <!-- Results container -->
            <div id="results-container" class="hidden">

              <!-- Section 2: Primary Result -->
              <div class="results-section mt-20">
                <h2 class="results-section-title">
                  <i data-lucide="cake" aria-hidden="true"></i>
                  Your Age
                </h2>
                <div class="result-card result-card--accent">
                  <p class="result-label">Exact age</p>
                  <p class="tool-page-title text-accent mt-4" id="age-primary">0</p>
                  <p class="text-muted text-small mt-4" id="age-formatted">0 Years, 0 Months, 0 Days</p>
                </div>
              </div>

              <!-- Section 3: Detailed Breakdown -->
              <div class="results-section mt-20">
                <h2 class="results-section-title">
                  <i data-lucide="bar-chart-2" aria-hidden="true"></i>
                  Detailed Breakdown
                </h2>
                <div class="results-grid">
                  <div class="result-card">
                    <p class="result-label">Total Years</p>
                    <p class="result-value text-accent" id="total-years">0</p>
                  </div>
                  <div class="result-card">
                    <p class="result-label">Total Months</p>
                    <p class="result-value text-accent" id="total-months">0</p>
                  </div>
                  <div class="result-card">
                    <p class="result-label">Total Weeks</p>
                    <p class="result-value text-accent" id="total-weeks">0</p>
                  </div>
                  <div class="result-card">
                    <p class="result-label">Total Days</p>
                    <p class="result-value text-accent" id="total-days">0</p>
                  </div>
                  <div class="result-card">
                    <p class="result-label">Total Hours</p>
                    <p class="result-value text-accent" id="total-hours">0</p>
                  </div>
                  <div class="result-card">
                    <p class="result-label">Total Minutes</p>
                    <p class="result-value text-accent" id="total-minutes">0</p>
                  </div>
                </div>
              </div>

              <!-- Section 4: Birthday Info -->
              <div class="calc-section">
                <h2 class="calc-section-title">
                  <i data-lucide="gift" aria-hidden="true"></i>
                  Birthday Info
                </h2>
                <div id="birthday-info-list">
                  <div class="auto-display" id="info-born-day">
                    <strong>Day born:</strong> <span id="born-day-text">-</span>
                  </div>
                  <div class="auto-display" id="info-days-until">
                    <strong>Next birthday:</strong> <span id="days-until-text">-</span>
                  </div>
                  <div class="auto-display" id="info-next-date">
                    <strong>Next birthday date:</strong> <span id="next-date-text">-</span>
                  </div>
                  <div class="auto-display" id="info-next-age">
                    <strong>Turning:</strong> <span id="next-age-text">-</span>
                  </div>
                  <div class="auto-display" id="info-zodiac">
                    <strong>Zodiac sign:</strong> <span id="zodiac-text">-</span>
                  </div>
                </div>
              </div>

              <!-- Section 5: Fun Facts -->
              <div class="calc-section">
                <h2 class="calc-section-title">
                  <i data-lucide="sparkles" aria-hidden="true"></i>
                  Fun Facts
                </h2>
                <p class="calc-section-note">Based on average estimates for a healthy adult</p>
                <div id="fun-facts-list">
                  <div class="auto-display" id="fact-heartbeats">
                    <strong>Heartbeats:</strong> <span id="fact-heartbeats-text">-</span>
                  </div>
                  <div class="auto-display" id="fact-breaths">
                    <strong>Breaths taken:</strong> <span id="fact-breaths-text">-</span>
                  </div>
                  <div class="auto-display" id="fact-sleep">
                    <strong>Days slept:</strong> <span id="fact-sleep-text">-</span>
                  </div>
                </div>
              </div>

            </div>
            <!-- end results-container -->

          </div>

          <div class="tool-disclaimer">
            <p>All calculations happen locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
