<?php $pageJS = '/js/bmi-calculator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>BMI Calculator - Body Mass Index Calculator | YourSimpleTools</title>
<meta name="description" content="Calculate your Body Mass Index (BMI) instantly. Supports metric and imperial units. Free online BMI calculator with weight category and health tips." />
<meta name="keywords" content="bmi calculator, body mass index, bmi chart, healthy weight calculator, bmi formula" />
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>BMI Calculator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">BMI Calculator</h1>
            <p class="tool-page-desc">Calculate your Body Mass Index instantly. Supports metric and imperial.</p>
          </div>

          <div class="notice-box notice-warning">
            <span class="notice-icon">
              <i data-lucide="triangle-alert" aria-hidden="true"></i>
            </span>
            <p>This BMI calculator is for informational purposes only. BMI is a screening tool and not a diagnostic measure. Please consult a healthcare professional for medical advice.</p>
          </div>

          <div class="tool-container mt-20">

            <div class="bmi-unit-toggle" role="group" aria-label="Unit system">
              <button type="button" id="btn-metric" class="bmi-unit-btn bmi-unit-btn--active" aria-pressed="true">
                Metric (kg / cm)
              </button>
              <button type="button" id="btn-imperial" class="bmi-unit-btn" aria-pressed="false">
                Imperial (lbs / ft &amp; in)
              </button>
            </div>

            <!-- Metric Inputs -->
            <div id="metric-inputs">
              <div class="form-grid-2">
                <div class="form-group">
                  <label for="height-cm" class="form-label">Height</label>
                  <div class="bmi-input-unit-wrapper">
                    <input
                      type="number"
                      id="height-cm"
                      class="form-input"
                      placeholder="Enter height in cm"
                      min="50"
                      max="300"
                      aria-label="Height in centimetres"
                    />
                    <span class="bmi-unit-suffix">cm</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="weight-kg" class="form-label">Weight</label>
                  <div class="bmi-input-unit-wrapper">
                    <input
                      type="number"
                      id="weight-kg"
                      class="form-input"
                      placeholder="Enter weight in kg"
                      min="1"
                      max="500"
                      aria-label="Weight in kilograms"
                    />
                    <span class="bmi-unit-suffix">kg</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Imperial Inputs -->
            <div id="imperial-inputs" class="hidden">
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="form-label">Height</label>
                  <div class="bmi-height-imperial">
                    <div class="bmi-input-unit-wrapper">
                      <input
                        type="number"
                        id="height-ft"
                        class="form-input"
                        placeholder="ft"
                        min="1"
                        max="9"
                        aria-label="Height feet"
                      />
                      <span class="bmi-unit-suffix">ft</span>
                    </div>
                    <div class="bmi-input-unit-wrapper">
                      <input
                        type="number"
                        id="height-in"
                        class="form-input"
                        placeholder="in"
                        min="0"
                        max="11"
                        aria-label="Height inches"
                      />
                      <span class="bmi-unit-suffix">in</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="weight-lbs" class="form-label">Weight</label>
                  <div class="bmi-input-unit-wrapper">
                    <input
                      type="number"
                      id="weight-lbs"
                      class="form-input"
                      placeholder="Enter weight in lbs"
                      min="1"
                      max="1000"
                      aria-label="Weight in pounds"
                    />
                    <span class="bmi-unit-suffix">lbs</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Age and Gender (optional) -->
            <div class="form-grid-2">
              <div class="form-group">
                <label for="age-input" class="form-label">Age (optional)</label>
                <input
                  type="number"
                  id="age-input"
                  class="form-input"
                  placeholder="Enter your age"
                  min="2"
                  max="120"
                  aria-label="Age in years"
                />
                <p class="text-small text-muted mt-4">Age helps provide more context about your BMI result</p>
              </div>
              <div class="form-group">
                <label for="gender-input" class="form-label">Gender (optional)</label>
                <select id="gender-input" class="form-select" aria-label="Gender">
                  <option value="">Select gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
            </div>

            <!-- Error notice -->
            <div id="bmi-error" class="notice-box notice-warning hidden" role="alert" aria-live="polite">
              <span class="notice-icon">
                <i data-lucide="triangle-alert" aria-hidden="true"></i>
              </span>
              <p id="bmi-error-msg">Please enter valid height and weight values.</p>
            </div>

            <button type="button" id="calculate-btn" class="btn-primary w-full flex-center gap-8 mt-20">
              <i data-lucide="calculator" aria-hidden="true"></i>
              Calculate BMI
            </button>

            <!-- Results -->
            <div id="bmi-results" class="hidden">

              <!-- Primary Result Card -->
              <div class="results-section mt-20" id="bmi-result-card">
                <h2 class="results-section-title">
                  <i data-lucide="activity" aria-hidden="true"></i>
                  Your BMI Result
                </h2>
                <div class="result-card result-card--accent">
                  <p class="result-label">Body Mass Index</p>
                  <p id="bmi-value" class="bmi-value-display">0.0</p>
                  <span id="bmi-category" class="bmi-badge-normal">Normal weight</span>
                </div>

                <!-- BMI Scale Visual -->
                <div class="bmi-scale-wrapper" aria-label="BMI scale indicator">
                  <div class="bmi-scale-track">
                    <div class="bmi-scale-bar"></div>
                    <div id="bmi-scale-pointer" class="bmi-scale-pointer" role="presentation"></div>
                  </div>
                  <div class="bmi-scale-labels" aria-hidden="true">
                    <span>10</span>
                    <span>18.5</span>
                    <span>25</span>
                    <span>30</span>
                    <span>35</span>
                    <span>40+</span>
                  </div>
                </div>
              </div>

              <!-- Stats Grid -->
              <div class="results-section mt-20">
                <h2 class="results-section-title">
                  <i data-lucide="bar-chart-2" aria-hidden="true"></i>
                  Detailed Stats
                </h2>
                <div class="results-grid">
                  <div class="result-card">
                    <p class="result-label">Your BMI</p>
                    <p class="result-value text-accent" id="stat-bmi">-</p>
                  </div>
                  <div class="result-card">
                    <p class="result-label">BMI Category</p>
                    <p class="result-value" id="stat-category">-</p>
                  </div>
                  <div class="result-card">
                    <p class="result-label">Healthy Weight Range</p>
                    <p class="result-value text-accent" id="stat-healthy-range">-</p>
                  </div>
                  <div class="result-card">
                    <p class="result-label">BMI Prime</p>
                    <p class="result-value text-accent" id="stat-bmi-prime">-</p>
                  </div>
                </div>

                <div class="result-card mt-12">
                  <p class="result-label">Weight Status</p>
                  <p class="result-value" id="weight-diff-text">-</p>
                </div>
              </div>

              <!-- BMI Categories Table -->
              <div class="calc-section">
                <h2 class="calc-section-title">
                  <i data-lucide="table-2" aria-hidden="true"></i>
                  BMI Categories
                </h2>
                <div class="conv-table-wrapper">
                  <table class="conv-table" id="bmi-categories-table">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>BMI Range</th>
                        <th>Health Risk</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr data-category="Underweight">
                        <td>Underweight</td>
                        <td>Below 18.5</td>
                        <td>Increased risk</td>
                      </tr>
                      <tr data-category="Normal weight">
                        <td>Normal weight</td>
                        <td>18.5 - 24.9</td>
                        <td>Lowest risk</td>
                      </tr>
                      <tr data-category="Overweight">
                        <td>Overweight</td>
                        <td>25.0 - 29.9</td>
                        <td>Increased risk</td>
                      </tr>
                      <tr data-category="Obese Class I">
                        <td>Obese Class I</td>
                        <td>30.0 - 34.9</td>
                        <td>High risk</td>
                      </tr>
                      <tr data-category="Obese Class II">
                        <td>Obese Class II</td>
                        <td>35.0 - 39.9</td>
                        <td>Very high risk</td>
                      </tr>
                      <tr data-category="Obese Class III">
                        <td>Obese Class III</td>
                        <td>40.0 and above</td>
                        <td>Extremely high risk</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="mt-20">
                <button type="button" id="reset-btn" class="btn-secondary flex-center gap-8">
                  <i data-lucide="rotate-ccw" aria-hidden="true"></i>
                  Reset Calculator
                </button>
              </div>

            </div>
            <!-- end bmi-results -->

          </div>
          <!-- end tool-container -->

          <!-- Health Tips -->
          <div id="health-tips-container" class="tool-container mt-20 hidden">

            <div id="tips-underweight" class="hidden">
              <h2 class="calc-section-title">
                <i data-lucide="heart" aria-hidden="true"></i>
                Tips for Healthy Weight Gain
              </h2>
              <ul class="bmi-tips-list">
                <li>Eat nutrient-dense foods more frequently</li>
                <li>Include healthy fats like nuts and avocado</li>
                <li>Do strength training to build muscle</li>
                <li>Consult a nutritionist for a personalized plan</li>
              </ul>
            </div>

            <div id="tips-normal" class="hidden">
              <h2 class="calc-section-title">
                <i data-lucide="heart" aria-hidden="true"></i>
                Tips to Maintain Healthy Weight
              </h2>
              <ul class="bmi-tips-list">
                <li>Continue balanced diet with whole foods</li>
                <li>Stay active with at least 150 minutes of moderate exercise per week</li>
                <li>Stay hydrated with 8 glasses of water daily</li>
                <li>Get regular health checkups</li>
              </ul>
            </div>

            <div id="tips-overweight" class="hidden">
              <h2 class="calc-section-title">
                <i data-lucide="heart" aria-hidden="true"></i>
                Tips for Healthy Weight Management
              </h2>
              <ul class="bmi-tips-list">
                <li>Focus on portion control and whole foods</li>
                <li>Aim for 30 minutes of daily activity</li>
                <li>Reduce processed foods and sugary drinks</li>
                <li>Track your meals to stay accountable</li>
                <li>Consult a healthcare professional</li>
              </ul>
            </div>

            <div id="tips-obese" class="hidden">
              <h2 class="calc-section-title">
                <i data-lucide="heart" aria-hidden="true"></i>
                Important Health Recommendations
              </h2>
              <ul class="bmi-tips-list">
                <li>Consult a healthcare professional before starting any diet or exercise plan</li>
                <li>Focus on gradual sustainable changes</li>
                <li>Small steps lead to lasting results</li>
                <li>Consider speaking to a registered dietitian</li>
              </ul>
            </div>

          </div>
          <!-- end health-tips-container -->

          <div class="tool-disclaimer mt-20">
            <p>BMI is a general screening tool and does not account for muscle mass, bone density, age, gender, or ethnicity. Athletes and muscular individuals may have a high BMI without excess body fat. Always consult a qualified healthcare professional for personalized medical advice.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
  </body>
</html>
