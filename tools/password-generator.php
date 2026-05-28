<?php $pageJS = '/js/password-generator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Password Generator - Free Strong Password Generator | YourSimpleTools</title>
<meta name="description" content="Generate strong, secure, random passwords instantly. Customizable length and character sets. 100% free, no signup required." />
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Password Generator</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Password Generator</h1>
            <p class="tool-page-desc">Generate strong, secure, random passwords instantly. Nothing is stored or sent anywhere.</p>
          </div>

          <div class="notice-box notice-security">
            <span class="notice-icon">
              <i data-lucide="shield-check" aria-hidden="true"></i>
            </span>
            <p>All passwords are generated locally in your browser. Nothing is sent to any server.</p>
          </div>

          <div class="tool-container">

            <!-- Password Output -->
            <div class="form-group">
              <div class="password-display-wrapper">
                <span
                  class="password-text"
                  id="password-output"
                  aria-live="polite"
                  aria-label="Generated password"
                ></span>
                <div class="password-actions">
                  <button
                    type="button"
                    class="btn-sm"
                    id="btn-copy"
                    aria-label="Copy password to clipboard"
                  >Copy</button>
                  <button
                    type="button"
                    class="btn-sm"
                    id="btn-refresh"
                    aria-label="Generate new password"
                  >New</button>
                </div>
              </div>

              <!-- Strength Indicator -->
              <div class="strength-wrapper">
                <div
                  class="strength-track"
                  role="progressbar"
                  aria-label="Password strength"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  aria-valuenow="0"
                  id="strength-track"
                >
                  <div class="strength-fill" id="strength-fill"></div>
                </div>
                <span class="strength-label" id="strength-label">-</span>
              </div>
            </div>

            <hr class="controls-divider" />

            <!-- Password Length -->
            <div class="form-group">
              <label class="form-label" for="length-slider">
                Password Length: <span id="length-display" class="text-accent font-semibold">16</span>
              </label>
              <input
                type="range"
                class="form-range mt-8"
                id="length-slider"
                min="6"
                max="64"
                value="16"
                aria-label="Password length"
              />
            </div>

            <hr class="controls-divider" />

            <!-- Character Sets -->
            <div class="form-group">
              <p class="controls-group-label">Character Sets</p>
              <div class="toggle-list">
                <div class="toggle-row">
                  <label class="toggle-label" for="toggle-upper">Uppercase letters (A-Z)</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="toggle-upper" checked />
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="toggle-row">
                  <label class="toggle-label" for="toggle-lower">Lowercase letters (a-z)</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="toggle-lower" checked />
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="toggle-row">
                  <label class="toggle-label" for="toggle-numbers">Numbers (0-9)</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="toggle-numbers" checked />
                    <span class="toggle-slider"></span>
                  </label>
                </div>
                <div class="toggle-row">
                  <label class="toggle-label" for="toggle-symbols">Symbols (!@#$%^&amp;*)</label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="toggle-symbols" checked />
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>

            <hr class="controls-divider" />

            <!-- Exclude Ambiguous -->
            <div class="form-group">
              <div class="toggle-list">
                <div class="toggle-row">
                  <label class="toggle-label" for="toggle-ambiguous">
                    Exclude ambiguous characters (0, O, l, 1, I)
                  </label>
                  <label class="toggle-switch">
                    <input type="checkbox" id="toggle-ambiguous" />
                    <span class="toggle-slider"></span>
                  </label>
                </div>
              </div>
            </div>

            <!-- Generate Button -->
            <button
              type="button"
              class="btn-primary w-full flex-center justify-center gap-8 mt-8"
              id="btn-generate"
            >
              <i data-lucide="refresh-cw" aria-hidden="true"></i>
              Generate New Password
            </button>

            <!-- Multiple Passwords -->
            <div class="multi-passwords-section">
              <button
                type="button"
                class="btn-secondary w-full"
                id="btn-generate-multi"
              >
                Generate 5 Passwords
              </button>
              <div id="multi-password-list" class="multi-password-list hidden"></div>
            </div>

          </div>

          <div class="tool-disclaimer">
            <p>All passwords are generated locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
