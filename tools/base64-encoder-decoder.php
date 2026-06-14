<?php $pageJS = '/js/base64-encoder-decoder.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Base64 Encoder Decoder - Encode and Decode Base64 Online | YourSimpleTools</title>
<meta name="description" content="Encode and decode Base64 strings instantly online. Support for text, URLs and files. Free online Base64 encoder and decoder tool.">
<meta name="keywords" content="base64 encoder, base64 decoder, encode base64, decode base64, base64 online, base64 converter">
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="/">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="/tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Base64 Encoder Decoder</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Base64 Encoder / Decoder</h1>
            <p class="tool-page-desc">Encode text to Base64 or decode Base64 strings back to text instantly.</p>
          </div>

          <div class="notice-box notice-info">
            <span class="notice-icon">
              <i data-lucide="info" aria-hidden="true"></i>
            </span>
            <p>Base64 encoding converts binary data into ASCII text format. It is commonly used to encode data in URLs, emails, and web pages.</p>
          </div>

          <div class="tool-container">

            <!-- Tab Navigation -->
            <div class="bmi-unit-toggle" role="tablist" aria-label="Encoder or Decoder">
              <button
                type="button"
                class="bmi-unit-btn bmi-unit-btn--active"
                id="tab-encode"
                role="tab"
                aria-selected="true"
              >Encode (Text to Base64)</button>
              <button
                type="button"
                class="bmi-unit-btn"
                id="tab-decode"
                role="tab"
                aria-selected="false"
              >Decode (Base64 to Text)</button>
            </div>

            <!-- Encode Section -->
            <div id="encode-section">

              <div class="form-group mt-20">
                <label class="form-label" for="encode-input">Text to Encode</label>
                <textarea
                  class="form-textarea"
                  id="encode-input"
                  placeholder="Enter text to encode to Base64..."
                  aria-label="Text to encode"
                ></textarea>
              </div>

              <div class="form-group">
                <label class="form-label" for="encode-charset">Character Encoding</label>
                <select class="form-select" id="encode-charset" aria-label="Character encoding">
                  <option value="UTF-8" selected>UTF-8</option>
                  <option value="ASCII">ASCII</option>
                  <option value="Latin-1">Latin-1</option>
                </select>
              </div>

              <div class="toggle-row">
                <div>
                  <label class="toggle-label" for="url-safe-encode">URL Safe Base64</label>
                  <p class="text-muted text-small">Use this for Base64 in URLs and filenames</p>
                </div>
                <label class="toggle-switch">
                  <input type="checkbox" id="url-safe-encode" />
                  <span class="toggle-slider"></span>
                </label>
              </div>

              <div class="toggle-row">
                <label class="toggle-label" for="live-encode">Encode automatically as I type</label>
                <label class="toggle-switch">
                  <input type="checkbox" id="live-encode" checked />
                  <span class="toggle-slider"></span>
                </label>
              </div>

              <button
                type="button"
                class="btn-primary w-full flex-center gap-8 mt-20"
                id="btn-encode"
              >
                <i data-lucide="lock" aria-hidden="true"></i>
                Encode to Base64
              </button>

              <div class="form-group mt-20">
                <label class="form-label" for="encode-output">Base64 Output</label>
                <textarea
                  class="form-textarea"
                  id="encode-output"
                  readonly
                  placeholder="Base64 encoded output will appear here..."
                  aria-label="Base64 encoded output"
                ></textarea>
              </div>

              <p class="text-muted text-small" id="encode-stats"></p>

              <div class="flex-center gap-8 mt-12">
                <button
                  type="button"
                  class="btn-secondary flex-center gap-8"
                  id="copy-encode-btn"
                  aria-label="Copy Base64 output"
                >
                  <i data-lucide="copy" aria-hidden="true"></i>
                  Copy Base64
                </button>
                <button
                  type="button"
                  class="btn-secondary flex-center gap-8"
                  id="clear-encode-btn"
                  aria-label="Clear encode inputs"
                >
                  <i data-lucide="trash-2" aria-hidden="true"></i>
                  Clear
                </button>
                <button
                  type="button"
                  class="btn-secondary flex-center gap-8"
                  id="download-encode-btn"
                  aria-label="Download Base64 as text file"
                >
                  <i data-lucide="download" aria-hidden="true"></i>
                  Download as TXT
                </button>
              </div>

            </div>
            <!-- end encode-section -->

            <!-- Decode Section -->
            <div id="decode-section" class="hidden">

              <div class="form-group mt-20">
                <label class="form-label" for="decode-input">Base64 to Decode</label>
                <textarea
                  class="form-textarea"
                  id="decode-input"
                  placeholder="Paste Base64 string to decode..."
                  aria-label="Base64 string to decode"
                ></textarea>
              </div>

              <div class="toggle-row">
                <label class="toggle-label" for="url-safe-decode">URL Safe Base64 input</label>
                <label class="toggle-switch">
                  <input type="checkbox" id="url-safe-decode" />
                  <span class="toggle-slider"></span>
                </label>
              </div>

              <div class="toggle-row">
                <label class="toggle-label" for="live-decode">Decode automatically as I type</label>
                <label class="toggle-switch">
                  <input type="checkbox" id="live-decode" checked />
                  <span class="toggle-slider"></span>
                </label>
              </div>

              <button
                type="button"
                class="btn-primary w-full flex-center gap-8 mt-20"
                id="btn-decode"
              >
                <i data-lucide="unlock" aria-hidden="true"></i>
                Decode from Base64
              </button>

              <div class="form-group mt-20">
                <label class="form-label" for="decode-output">Decoded Text Output</label>
                <textarea
                  class="form-textarea"
                  id="decode-output"
                  readonly
                  placeholder="Decoded text will appear here..."
                  aria-label="Decoded text output"
                ></textarea>
              </div>

              <div id="decode-status" class="hidden" aria-live="polite"></div>

              <p class="text-muted text-small" id="decode-stats"></p>

              <div class="flex-center gap-8 mt-12">
                <button
                  type="button"
                  class="btn-secondary flex-center gap-8"
                  id="copy-decode-btn"
                  aria-label="Copy decoded text"
                >
                  <i data-lucide="copy" aria-hidden="true"></i>
                  Copy Text
                </button>
                <button
                  type="button"
                  class="btn-secondary flex-center gap-8"
                  id="clear-decode-btn"
                  aria-label="Clear decode inputs"
                >
                  <i data-lucide="trash-2" aria-hidden="true"></i>
                  Clear
                </button>
              </div>

            </div>
            <!-- end decode-section -->

            <!-- File Encode Section -->
            <div class="results-section mt-20">
              <h2 class="results-section-title">
                <i data-lucide="file-up" aria-hidden="true"></i>
                Encode a File to Base64
              </h2>

              <div class="form-group">
                <label class="form-label" for="file-input">Choose a file to encode</label>
                <input
                  type="file"
                  class="form-input"
                  id="file-input"
                  aria-label="Choose a file to encode to Base64"
                />
              </div>

              <button
                type="button"
                class="btn-secondary flex-center gap-8 mt-12"
                id="btn-encode-file"
                aria-label="Encode selected file to Base64"
              >
                <i data-lucide="upload" aria-hidden="true"></i>
                Encode File
              </button>

              <div class="form-group mt-20">
                <label class="form-label" for="file-output">File Base64 Output</label>
                <textarea
                  class="form-textarea"
                  id="file-output"
                  readonly
                  placeholder="Base64 of file content will appear here..."
                  aria-label="File Base64 output"
                ></textarea>
              </div>

              <p class="text-muted text-small" id="file-stats"></p>

              <div class="mt-12">
                <button
                  type="button"
                  class="btn-secondary flex-center gap-8"
                  id="copy-file-btn"
                  aria-label="Copy file Base64 to clipboard"
                >
                  <i data-lucide="copy" aria-hidden="true"></i>
                  Copy Base64
                </button>
              </div>

            </div>
            <!-- end file encode section -->

          </div>
          <!-- end tool-container -->

          <!-- What is Base64 Section -->
          <div class="json-info-section">
            <h2>
              <i data-lucide="book-open" aria-hidden="true"></i>
              What is Base64?
            </h2>
            <p>Base64 is a binary-to-text encoding scheme that represents binary data in an ASCII string format by translating it into a radix-64 representation.</p>
            <p>It is commonly used when there is a need to encode binary data that needs to be stored and transferred over media designed to deal with ASCII text.</p>
            <p>Common uses:</p>
            <ul>
              <li>Embedding images in HTML and CSS</li>
              <li>Encoding email attachments (MIME)</li>
              <li>Storing complex data in URLs</li>
              <li>Encoding data in JSON APIs</li>
              <li>Authentication tokens (JWT)</li>
              <li>Storing binary data in databases</li>
            </ul>
          </div>

          <!-- Base64 Character Set -->
          <div class="json-info-section">
            <h2>
              <i data-lucide="grid" aria-hidden="true"></i>
              Base64 Character Set
            </h2>
            <p>Base64 uses 64 characters:</p>
            <p>A-Z (26) + a-z (26) + 0-9 (10) + + and / (2)</p>
            <p>= sign is used for padding</p>
          </div>

          <div class="tool-disclaimer">
            <p>All encoding and decoding happens locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
</body>
</html>
