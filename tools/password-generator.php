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
    <script>
      var CHARSET_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var CHARSET_LOWER = 'abcdefghijklmnopqrstuvwxyz';
      var CHARSET_NUMS = '0123456789';
      var CHARSET_SYMS = '!@#$%^&*()_+-=[]{}|;:,.<>?';

      var AMBIG_UPPER = /[OI]/g;
      var AMBIG_LOWER = /[l]/g;
      var AMBIG_NUMS = /[01]/g;

      var lengthSlider = document.getElementById('length-slider');
      var lengthDisplay = document.getElementById('length-display');
      var passwordOutput = document.getElementById('password-output');
      var strengthFill = document.getElementById('strength-fill');
      var strengthLabel = document.getElementById('strength-label');
      var strengthTrack = document.getElementById('strength-track');
      var toggleUpper = document.getElementById('toggle-upper');
      var toggleLower = document.getElementById('toggle-lower');
      var toggleNumbers = document.getElementById('toggle-numbers');
      var toggleSymbols = document.getElementById('toggle-symbols');
      var toggleAmbiguous = document.getElementById('toggle-ambiguous');
      var btnCopy = document.getElementById('btn-copy');
      var btnRefresh = document.getElementById('btn-refresh');
      var btnGenerate = document.getElementById('btn-generate');
      var btnGenerateMulti = document.getElementById('btn-generate-multi');
      var multiPasswordList = document.getElementById('multi-password-list');

      var currentPassword = '';
      var SET_TOGGLES = [toggleUpper, toggleLower, toggleNumbers, toggleSymbols];

      function buildCharset() {
        var charset = '';
        var ambig = toggleAmbiguous.checked;
        if (toggleUpper.checked) {
          charset += ambig ? CHARSET_UPPER.replace(AMBIG_UPPER, '') : CHARSET_UPPER;
        }
        if (toggleLower.checked) {
          charset += ambig ? CHARSET_LOWER.replace(AMBIG_LOWER, '') : CHARSET_LOWER;
        }
        if (toggleNumbers.checked) {
          charset += ambig ? CHARSET_NUMS.replace(AMBIG_NUMS, '') : CHARSET_NUMS;
        }
        if (toggleSymbols.checked) {
          charset += CHARSET_SYMS;
        }
        return charset;
      }

      function countActiveSets() {
        var n = 0;
        if (toggleUpper.checked) n++;
        if (toggleLower.checked) n++;
        if (toggleNumbers.checked) n++;
        if (toggleSymbols.checked) n++;
        return n;
      }

      function generateRandom(length) {
        var charset = buildCharset();
        if (!charset.length) return '';
        var bytes = new Uint32Array(length);
        crypto.getRandomValues(bytes);
        var result = '';
        for (var i = 0; i < length; i++) {
          result += charset[bytes[i] % charset.length];
        }
        return result;
      }

      function calcStrength(len, sets) {
        if (len < 8) return { label: 'Weak', color: '#EF4444', pct: 25 };
        if (len >= 16 && sets >= 4) return { label: 'Very Strong', color: '#1F6B57', pct: 100 };
        if (len >= 12 && sets >= 3) return { label: 'Strong', color: '#3B82F6', pct: 75 };
        if (len >= 8 && sets >= 2) return { label: 'Fair', color: '#F59E0B', pct: 50 };
        return { label: 'Weak', color: '#EF4444', pct: 25 };
      }

      function updateStrength(pwd) {
        var s = calcStrength(pwd.length, countActiveSets());
        strengthFill.style.width = s.pct + '%';
        strengthFill.style.backgroundColor = s.color;
        strengthLabel.textContent = s.label;
        strengthLabel.style.color = s.color;
        strengthTrack.setAttribute('aria-valuenow', s.pct);
      }

      function generate() {
        var len = parseInt(lengthSlider.value, 10);
        currentPassword = generateRandom(len);
        passwordOutput.textContent = currentPassword;
        updateStrength(currentPassword);
      }

      function copyToClipboard(text, btn) {
        function onSuccess() {
          btn.textContent = 'Copied!';
          btn.classList.add('is-copied');
          setTimeout(function() {
            btn.textContent = 'Copy';
            btn.classList.remove('is-copied');
          }, 2000);
        }
        function fallback() {
          var ta = document.createElement('textarea');
          ta.value = text;
          ta.style.position = 'fixed';
          ta.style.opacity = '0';
          document.body.appendChild(ta);
          ta.select();
          document.execCommand('copy');
          document.body.removeChild(ta);
          onSuccess();
        }
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(text).then(onSuccess).catch(fallback);
        } else {
          fallback();
        }
      }

      SET_TOGGLES.forEach(function(toggle) {
        toggle.addEventListener('change', function() {
          var anyOn = SET_TOGGLES.some(function(t) { return t.checked; });
          if (!anyOn) {
            toggle.checked = true;
            return;
          }
          generate();
        });
      });

      toggleAmbiguous.addEventListener('change', generate);

      lengthSlider.addEventListener('input', function() {
        lengthDisplay.textContent = this.value;
        generate();
      });

      btnRefresh.addEventListener('click', generate);
      btnGenerate.addEventListener('click', generate);

      btnCopy.addEventListener('click', function() {
        if (!currentPassword) return;
        copyToClipboard(currentPassword, btnCopy);
      });

      btnGenerateMulti.addEventListener('click', function() {
        var len = parseInt(lengthSlider.value, 10);
        multiPasswordList.innerHTML = '';
        multiPasswordList.classList.remove('hidden');

        for (var i = 0; i < 5; i++) {
          var pwd = generateRandom(len);

          var item = document.createElement('div');
          item.className = 'multi-password-item';

          var textSpan = document.createElement('span');
          textSpan.className = 'multi-password-text';
          textSpan.textContent = pwd;

          var copyBtn = document.createElement('button');
          copyBtn.type = 'button';
          copyBtn.className = 'btn-sm';
          copyBtn.setAttribute('aria-label', 'Copy password ' + (i + 1));
          copyBtn.textContent = 'Copy';
          copyBtn.dataset.pwd = pwd;

          copyBtn.addEventListener('click', function() {
            var p = this.dataset.pwd;
            copyToClipboard(p, this);
          });

          item.appendChild(textSpan);
          item.appendChild(copyBtn);
          multiPasswordList.appendChild(item);
        }
      });

      generate();
    </script>
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
