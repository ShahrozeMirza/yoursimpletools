<?php $pageJS = '/js/random-number-generator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Random Number Generator - Free Online Tool | YourSimpleTools</title>
<meta name="description" content="Generate random numbers instantly. Set your own min and max range. Generate single or multiple random numbers. Free online random number generator.">
<meta name="keywords" content="random number generator, random number, random number picker, random number between, lucky number generator">
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Random Number Generator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Random Number Generator</h1>
            <p class="tool-page-desc">Generate random numbers instantly. Set your own range and quantity.</p>
          </div>

          <!-- Section 1: Single Random Number -->
          <div class="tool-container">

            <h2 class="calc-section-title">
              <i data-lucide="dice-5" aria-hidden="true"></i>
              Generate a Random Number
            </h2>

            <div class="form-grid-2">
              <div class="form-group">
                <label for="single-min" class="form-label">Minimum</label>
                <input
                  type="number"
                  id="single-min"
                  class="form-input"
                  value="1"
                  placeholder="Min"
                  aria-label="Minimum value"
                />
              </div>
              <div class="form-group">
                <label for="single-max" class="form-label">Maximum</label>
                <input
                  type="number"
                  id="single-max"
                  class="form-input"
                  value="100"
                  placeholder="Max"
                  aria-label="Maximum value"
                />
              </div>
            </div>

            <div class="notice-box notice-warning hidden" id="single-error" role="alert">
              <span class="notice-icon">
                <i data-lucide="alert-triangle" aria-hidden="true"></i>
              </span>
              <p id="single-error-msg"></p>
            </div>

            <button
              type="button"
              class="btn-primary w-full flex-center justify-center gap-8"
              id="single-generate-btn"
              aria-label="Generate random number"
            >
              <i data-lucide="shuffle" aria-hidden="true"></i>
              <span>Generate Random Number</span>
            </button>

            <div
              class="rng-big-number is-empty"
              id="single-result"
              aria-live="polite"
              aria-label="Generated number"
            >--</div>

            <button
              type="button"
              class="btn-secondary w-full flex-center justify-center gap-8 mt-12"
              id="single-copy-btn"
              aria-label="Copy number to clipboard"
            >
              <i data-lucide="copy" aria-hidden="true"></i>
              <span>Copy Number</span>
            </button>

            <div class="rng-history-header">
              <span class="rng-section-label">Previous Numbers</span>
              <button
                type="button"
                class="btn-secondary flex-center gap-8"
                id="clear-history-btn"
                aria-label="Clear number history"
              >
                <i data-lucide="trash-2" aria-hidden="true"></i>
                <span>Clear History</span>
              </button>
            </div>

            <div
              id="single-history"
              class="rng-chips"
              aria-label="Previous generated numbers"
            >
              <span class="rng-empty-state">No numbers generated yet</span>
            </div>

          </div>

          <!-- Section 2: Multiple Random Numbers -->
          <div class="tool-container mt-20">

            <h2 class="calc-section-title">
              <i data-lucide="list" aria-hidden="true"></i>
              Generate Multiple Numbers
            </h2>

            <div class="form-grid-2">
              <div class="form-group">
                <label for="multi-min" class="form-label">Minimum</label>
                <input
                  type="number"
                  id="multi-min"
                  class="form-input"
                  value="1"
                  aria-label="Minimum value"
                />
              </div>
              <div class="form-group">
                <label for="multi-max" class="form-label">Maximum</label>
                <input
                  type="number"
                  id="multi-max"
                  class="form-input"
                  value="100"
                  aria-label="Maximum value"
                />
              </div>
            </div>

            <div class="form-group">
              <label for="multi-quantity" class="form-label">How many numbers</label>
              <input
                type="number"
                id="multi-quantity"
                class="form-input"
                value="5"
                min="1"
                max="1000"
                aria-label="Quantity of numbers to generate"
              />
            </div>

            <div class="toggle-list">
              <div class="toggle-row">
                <label class="toggle-label" for="allow-duplicates">Allow duplicate numbers</label>
                <label class="toggle-switch">
                  <input type="checkbox" id="allow-duplicates" checked />
                  <span class="toggle-slider"></span>
                </label>
              </div>
              <div class="toggle-row">
                <label class="toggle-label" for="sort-results">Sort results</label>
                <label class="toggle-switch">
                  <input type="checkbox" id="sort-results" />
                  <span class="toggle-slider"></span>
                </label>
              </div>
            </div>

            <div class="notice-box notice-warning hidden mt-20" id="multi-error" role="alert">
              <span class="notice-icon">
                <i data-lucide="alert-triangle" aria-hidden="true"></i>
              </span>
              <p id="multi-error-msg"></p>
            </div>

            <button
              type="button"
              class="btn-primary w-full flex-center justify-center gap-8 mt-20"
              id="multi-generate-btn"
              aria-label="Generate multiple random numbers"
            >
              <i data-lucide="shuffle" aria-hidden="true"></i>
              <span>Generate Numbers</span>
            </button>

            <div
              class="rng-multi-output is-placeholder"
              id="multi-result"
              aria-live="polite"
              aria-label="Generated numbers"
            >Numbers will appear here</div>

            <p class="rng-count-label" id="multi-count" aria-live="polite"></p>

            <button
              type="button"
              class="btn-secondary w-full flex-center justify-center gap-8 mt-12"
              id="multi-copy-btn"
              aria-label="Copy all numbers to clipboard"
            >
              <i data-lucide="copy" aria-hidden="true"></i>
              <span>Copy All Numbers</span>
            </button>

          </div>

          <!-- Section 3: Quick Tools -->
          <div class="tool-container mt-20">

            <h2 class="calc-section-title">
              <i data-lucide="zap" aria-hidden="true"></i>
              Quick Tools
            </h2>

            <div class="rng-quick-grid">

              <!-- Coin Flip -->
              <div class="rng-quick-card">
                <p class="rng-quick-title">Coin Flip</p>
                <p class="rng-quick-desc">Heads or Tails?</p>
                <div
                  class="rng-quick-result is-placeholder"
                  id="coin-result"
                  aria-live="polite"
                  aria-label="Coin flip result"
                >-</div>
                <button
                  type="button"
                  class="btn-primary w-full"
                  id="coin-flip-btn"
                  aria-label="Flip a coin"
                >Flip Coin</button>
              </div>

              <!-- Dice Roll -->
              <div class="rng-quick-card">
                <p class="rng-quick-title">Roll a Dice</p>
                <p class="rng-quick-desc">Roll a standard 6-sided dice</p>
                <div
                  class="rng-quick-result is-placeholder"
                  id="dice-result"
                  aria-live="polite"
                  aria-label="Dice roll result"
                >-</div>
                <p class="rng-quick-sub" id="dice-result-sub"></p>
                <div class="form-group">
                  <label for="dice-sides" class="form-label">Dice type</label>
                  <select id="dice-sides" class="form-select" aria-label="Number of sides">
                    <option value="4">d4 (4-sided)</option>
                    <option value="6" selected>d6 (6-sided)</option>
                    <option value="8">d8 (8-sided)</option>
                    <option value="10">d10 (10-sided)</option>
                    <option value="12">d12 (12-sided)</option>
                    <option value="20">d20 (20-sided)</option>
                  </select>
                </div>
                <button
                  type="button"
                  class="btn-primary w-full"
                  id="dice-roll-btn"
                  aria-label="Roll the dice"
                >Roll Dice</button>
              </div>

              <!-- Lucky Number -->
              <div class="rng-quick-card">
                <p class="rng-quick-title">Lucky Number</p>
                <p class="rng-quick-desc">Generate your lucky number between 1 and 9</p>
                <div
                  class="rng-quick-result is-placeholder"
                  id="lucky-result"
                  aria-live="polite"
                  aria-label="Lucky number result"
                >-</div>
                <button
                  type="button"
                  class="btn-primary w-full"
                  id="lucky-btn"
                  aria-label="Get your lucky number"
                >Get Lucky Number</button>
              </div>

            </div>

          </div>

          <div class="tool-disclaimer mt-20">
            <p>Numbers are generated using crypto.getRandomValues() which provides strong randomness suitable for most everyday uses. For cryptographic or security-critical purposes, use a dedicated security tool.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
  </body>
</html>
