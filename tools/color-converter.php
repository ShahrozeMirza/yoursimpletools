<?php $pageJS = '/js/color-converter.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Color Converter - HEX RGB HSL CMYK Color Tool | YourSimpleTools</title>
<meta name="description" content="Convert colors between HEX, RGB, HSL, HSB, CMYK formats instantly. Pick any color and get all formats at once. Free online color converter tool.">
<meta name="keywords" content="color converter, hex to rgb, rgb to hex, hsl converter, cmyk converter, color picker, css color converter">
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="/">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="/tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Color Converter</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Color Converter</h1>
            <p class="tool-page-desc">Convert colors between HEX, RGB, HSL, HSB and CMYK formats instantly.</p>
          </div>

          <div class="tool-container">

            <!-- Pick a Color -->
            <h2 class="calc-section-title">
              <i data-lucide="pipette" aria-hidden="true"></i>
              Pick a Color
            </h2>

            <div class="color-picker-row mt-12">
              <input
                type="color"
                id="color-picker"
                class="color-picker-input"
                value="#1F6B57"
                aria-label="Color picker"
              />
              <div class="form-group">
                <label for="hex-input" class="form-label">HEX</label>
                <input
                  type="text"
                  id="hex-input"
                  class="form-input"
                  placeholder="#1F6B57"
                  maxlength="7"
                  aria-label="Hex color value"
                  spellcheck="false"
                  autocomplete="off"
                />
              </div>
            </div>

            <div id="color-preview" class="color-preview-box" role="presentation" aria-label="Color preview"></div>
            <p id="color-name-display" class="color-name-display"></p>

            <!-- Color Formats -->
            <div class="results-section mt-20">
              <h2 class="results-section-title">
                Color Formats
              </h2>

              <div class="format-outputs-grid">

                <div class="format-output-card">
                  <p class="result-label">HEX</p>
                  <p class="format-output-value" id="output-hex">#1F6B57</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-hex" aria-label="Copy HEX value">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">HEX8 (with alpha)</p>
                  <p class="format-output-value" id="output-hex8">#1F6B57FF</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-hex8" aria-label="Copy HEX8 value">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">RGB</p>
                  <p class="format-output-value" id="output-rgb">rgb(31, 107, 87)</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-rgb" aria-label="Copy RGB value">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">RGB Values</p>
                  <p class="format-output-value" id="output-rgb-values">31, 107, 87</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-rgb-values" aria-label="Copy RGB values">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">HSL</p>
                  <p class="format-output-value" id="output-hsl">hsl(161, 55%, 27%)</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-hsl" aria-label="Copy HSL value">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">HSL Values</p>
                  <p class="format-output-value" id="output-hsl-values">161deg, 55%, 27%</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-hsl-values" aria-label="Copy HSL values">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">HSB / HSV</p>
                  <p class="format-output-value" id="output-hsb">hsb(161, 71%, 42%)</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-hsb" aria-label="Copy HSB value">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">CMYK</p>
                  <p class="format-output-value" id="output-cmyk">cmyk(71%, 0%, 19%, 58%)</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-cmyk" aria-label="Copy CMYK value">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">CSS Variable</p>
                  <p class="format-output-value" id="output-css-var">--color: #1F6B57;</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-css-var" aria-label="Copy CSS variable">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

                <div class="format-output-card">
                  <p class="result-label">RGB Decimal (0-1)</p>
                  <p class="format-output-value" id="output-rgb-decimal">0.122, 0.420, 0.341</p>
                  <div class="format-output-footer">
                    <button type="button" class="btn-sm flex-center gap-8" id="copy-rgb-decimal" aria-label="Copy RGB decimal value">
                      <i data-lucide="copy" aria-hidden="true"></i>
                      Copy
                    </button>
                  </div>
                </div>

              </div>
            </div>
            <!-- end Color Formats -->

            <!-- Convert from Any Format -->
            <div class="results-section mt-20">
              <h2 class="results-section-title">
                Convert from Any Format
              </h2>

              <div class="form-group">
                <label class="form-label">RGB</label>
                <div class="input-row-3">
                  <div class="form-group">
                    <label for="rgb-r" class="form-label text-small">R</label>
                    <input
                      type="number"
                      id="rgb-r"
                      class="form-input"
                      min="0"
                      max="255"
                      placeholder="31"
                      aria-label="Red channel value"
                    />
                  </div>
                  <div class="form-group">
                    <label for="rgb-g" class="form-label text-small">G</label>
                    <input
                      type="number"
                      id="rgb-g"
                      class="form-input"
                      min="0"
                      max="255"
                      placeholder="107"
                      aria-label="Green channel value"
                    />
                  </div>
                  <div class="form-group">
                    <label for="rgb-b" class="form-label text-small">B</label>
                    <input
                      type="number"
                      id="rgb-b"
                      class="form-input"
                      min="0"
                      max="255"
                      placeholder="87"
                      aria-label="Blue channel value"
                    />
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">HSL</label>
                <div class="input-row-3">
                  <div class="form-group">
                    <label for="hsl-h" class="form-label text-small">H (0-360)</label>
                    <input
                      type="number"
                      id="hsl-h"
                      class="form-input"
                      min="0"
                      max="360"
                      placeholder="161"
                      aria-label="Hue value"
                    />
                  </div>
                  <div class="form-group">
                    <label for="hsl-s" class="form-label text-small">S %</label>
                    <div class="input-with-suffix">
                      <input
                        type="number"
                        id="hsl-s"
                        class="form-input"
                        min="0"
                        max="100"
                        placeholder="55"
                        aria-label="Saturation value"
                      />
                      <span class="input-suffix">%</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="hsl-l" class="form-label text-small">L %</label>
                    <div class="input-with-suffix">
                      <input
                        type="number"
                        id="hsl-l"
                        class="form-input"
                        min="0"
                        max="100"
                        placeholder="27"
                        aria-label="Lightness value"
                      />
                      <span class="input-suffix">%</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">CMYK</label>
                <div class="input-row-4">
                  <div class="form-group">
                    <label for="cmyk-c" class="form-label text-small">C %</label>
                    <div class="input-with-suffix">
                      <input
                        type="number"
                        id="cmyk-c"
                        class="form-input"
                        min="0"
                        max="100"
                        placeholder="71"
                        aria-label="Cyan value"
                      />
                      <span class="input-suffix">%</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cmyk-m" class="form-label text-small">M %</label>
                    <div class="input-with-suffix">
                      <input
                        type="number"
                        id="cmyk-m"
                        class="form-input"
                        min="0"
                        max="100"
                        placeholder="0"
                        aria-label="Magenta value"
                      />
                      <span class="input-suffix">%</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cmyk-y" class="form-label text-small">Y %</label>
                    <div class="input-with-suffix">
                      <input
                        type="number"
                        id="cmyk-y"
                        class="form-input"
                        min="0"
                        max="100"
                        placeholder="19"
                        aria-label="Yellow value"
                      />
                      <span class="input-suffix">%</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="cmyk-k" class="form-label text-small">K %</label>
                    <div class="input-with-suffix">
                      <input
                        type="number"
                        id="cmyk-k"
                        class="form-input"
                        min="0"
                        max="100"
                        placeholder="58"
                        aria-label="Key (Black) value"
                      />
                      <span class="input-suffix">%</span>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <!-- end Convert from Any Format -->

            <!-- Color Palette -->
            <div class="results-section mt-20">
              <h2 class="results-section-title">
                <i data-lucide="palette" aria-hidden="true"></i>
                Color Palette
              </h2>

              <p class="form-label">Tints</p>
              <div class="palette-swatches">
                <div class="swatch-item" data-palette="tint-0">
                  <div id="tint-0" class="palette-swatch" role="button" tabindex="0" aria-label="Tint 1"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="tint-1">
                  <div id="tint-1" class="palette-swatch" role="button" tabindex="0" aria-label="Tint 2"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="tint-2">
                  <div id="tint-2" class="palette-swatch" role="button" tabindex="0" aria-label="Tint 3"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="tint-3">
                  <div id="tint-3" class="palette-swatch" role="button" tabindex="0" aria-label="Tint 4"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="tint-4">
                  <div id="tint-4" class="palette-swatch" role="button" tabindex="0" aria-label="Tint 5"></div>
                  <span class="swatch-label">--</span>
                </div>
              </div>

              <p class="form-label mt-16">Shades</p>
              <div class="palette-swatches">
                <div class="swatch-item" data-palette="shade-0">
                  <div id="shade-0" class="palette-swatch" role="button" tabindex="0" aria-label="Shade 1"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="shade-1">
                  <div id="shade-1" class="palette-swatch" role="button" tabindex="0" aria-label="Shade 2"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="shade-2">
                  <div id="shade-2" class="palette-swatch" role="button" tabindex="0" aria-label="Shade 3"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="shade-3">
                  <div id="shade-3" class="palette-swatch" role="button" tabindex="0" aria-label="Shade 4"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="shade-4">
                  <div id="shade-4" class="palette-swatch" role="button" tabindex="0" aria-label="Shade 5"></div>
                  <span class="swatch-label">--</span>
                </div>
              </div>

              <p class="form-label mt-16">Complementary</p>
              <div class="palette-swatches">
                <div class="swatch-item" data-palette="complementary">
                  <div id="complementary" class="palette-swatch" role="button" tabindex="0" aria-label="Complementary color"></div>
                  <span class="swatch-label">--</span>
                </div>
              </div>

              <p class="form-label mt-16">Analogous</p>
              <div class="palette-swatches">
                <div class="swatch-item" data-palette="analogous-1">
                  <div id="analogous-1" class="palette-swatch" role="button" tabindex="0" aria-label="Analogous color 1"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="analogous-2">
                  <div id="analogous-2" class="palette-swatch" role="button" tabindex="0" aria-label="Analogous color 2"></div>
                  <span class="swatch-label">--</span>
                </div>
              </div>

              <p class="form-label mt-16">Triadic</p>
              <div class="palette-swatches">
                <div class="swatch-item" data-palette="triadic-1">
                  <div id="triadic-1" class="palette-swatch" role="button" tabindex="0" aria-label="Triadic color 1"></div>
                  <span class="swatch-label">--</span>
                </div>
                <div class="swatch-item" data-palette="triadic-2">
                  <div id="triadic-2" class="palette-swatch" role="button" tabindex="0" aria-label="Triadic color 2"></div>
                  <span class="swatch-label">--</span>
                </div>
              </div>

            </div>
            <!-- end Color Palette -->

            <!-- Common CSS Colors -->
            <div class="results-section mt-20">
              <h2 class="results-section-title">
                Common CSS Colors
              </h2>
              <div class="css-color-swatches">
                <div class="css-swatch-item" data-css-color="red">
                  <div class="css-swatch" aria-label="red"></div>
                  <span class="css-swatch-name">red</span>
                </div>
                <div class="css-swatch-item" data-css-color="orange">
                  <div class="css-swatch" aria-label="orange"></div>
                  <span class="css-swatch-name">orange</span>
                </div>
                <div class="css-swatch-item" data-css-color="yellow">
                  <div class="css-swatch" aria-label="yellow"></div>
                  <span class="css-swatch-name">yellow</span>
                </div>
                <div class="css-swatch-item" data-css-color="green">
                  <div class="css-swatch" aria-label="green"></div>
                  <span class="css-swatch-name">green</span>
                </div>
                <div class="css-swatch-item" data-css-color="blue">
                  <div class="css-swatch" aria-label="blue"></div>
                  <span class="css-swatch-name">blue</span>
                </div>
                <div class="css-swatch-item" data-css-color="purple">
                  <div class="css-swatch" aria-label="purple"></div>
                  <span class="css-swatch-name">purple</span>
                </div>
                <div class="css-swatch-item" data-css-color="pink">
                  <div class="css-swatch" aria-label="pink"></div>
                  <span class="css-swatch-name">pink</span>
                </div>
                <div class="css-swatch-item" data-css-color="brown">
                  <div class="css-swatch" aria-label="brown"></div>
                  <span class="css-swatch-name">brown</span>
                </div>
                <div class="css-swatch-item" data-css-color="gray">
                  <div class="css-swatch" aria-label="gray"></div>
                  <span class="css-swatch-name">gray</span>
                </div>
                <div class="css-swatch-item" data-css-color="black">
                  <div class="css-swatch" aria-label="black"></div>
                  <span class="css-swatch-name">black</span>
                </div>
                <div class="css-swatch-item" data-css-color="white">
                  <div class="css-swatch" aria-label="white"></div>
                  <span class="css-swatch-name">white</span>
                </div>
                <div class="css-swatch-item" data-css-color="cyan">
                  <div class="css-swatch" aria-label="cyan"></div>
                  <span class="css-swatch-name">cyan</span>
                </div>
                <div class="css-swatch-item" data-css-color="magenta">
                  <div class="css-swatch" aria-label="magenta"></div>
                  <span class="css-swatch-name">magenta</span>
                </div>
                <div class="css-swatch-item" data-css-color="lime">
                  <div class="css-swatch" aria-label="lime"></div>
                  <span class="css-swatch-name">lime</span>
                </div>
                <div class="css-swatch-item" data-css-color="navy">
                  <div class="css-swatch" aria-label="navy"></div>
                  <span class="css-swatch-name">navy</span>
                </div>
                <div class="css-swatch-item" data-css-color="teal">
                  <div class="css-swatch" aria-label="teal"></div>
                  <span class="css-swatch-name">teal</span>
                </div>
                <div class="css-swatch-item" data-css-color="maroon">
                  <div class="css-swatch" aria-label="maroon"></div>
                  <span class="css-swatch-name">maroon</span>
                </div>
                <div class="css-swatch-item" data-css-color="olive">
                  <div class="css-swatch" aria-label="olive"></div>
                  <span class="css-swatch-name">olive</span>
                </div>
                <div class="css-swatch-item" data-css-color="silver">
                  <div class="css-swatch" aria-label="silver"></div>
                  <span class="css-swatch-name">silver</span>
                </div>
                <div class="css-swatch-item" data-css-color="gold">
                  <div class="css-swatch" aria-label="gold"></div>
                  <span class="css-swatch-name">gold</span>
                </div>
                <div class="css-swatch-item" data-css-color="coral">
                  <div class="css-swatch" aria-label="coral"></div>
                  <span class="css-swatch-name">coral</span>
                </div>
                <div class="css-swatch-item" data-css-color="salmon">
                  <div class="css-swatch" aria-label="salmon"></div>
                  <span class="css-swatch-name">salmon</span>
                </div>
                <div class="css-swatch-item" data-css-color="turquoise">
                  <div class="css-swatch" aria-label="turquoise"></div>
                  <span class="css-swatch-name">turquoise</span>
                </div>
                <div class="css-swatch-item" data-css-color="violet">
                  <div class="css-swatch" aria-label="violet"></div>
                  <span class="css-swatch-name">violet</span>
                </div>
                <div class="css-swatch-item" data-css-color="indigo">
                  <div class="css-swatch" aria-label="indigo"></div>
                  <span class="css-swatch-name">indigo</span>
                </div>
                <div class="css-swatch-item" data-css-color="crimson">
                  <div class="css-swatch" aria-label="crimson"></div>
                  <span class="css-swatch-name">crimson</span>
                </div>
                <div class="css-swatch-item" data-css-color="darkgreen">
                  <div class="css-swatch" aria-label="darkgreen"></div>
                  <span class="css-swatch-name">darkgreen</span>
                </div>
                <div class="css-swatch-item" data-css-color="skyblue">
                  <div class="css-swatch" aria-label="skyblue"></div>
                  <span class="css-swatch-name">skyblue</span>
                </div>
              </div>
            </div>
            <!-- end Common CSS Colors -->

            <!-- Contrast Checker -->
            <div class="results-section mt-20">
              <h2 class="results-section-title">
                <i data-lucide="eye" aria-hidden="true"></i>
                Contrast Checker
              </h2>

              <div class="contrast-pickers">
                <div class="form-group">
                  <label class="form-label" for="contrast-text-color">Text Color</label>
                  <div class="contrast-picker-group">
                    <input
                      type="color"
                      id="contrast-text-color"
                      class="contrast-color-input"
                      value="#FFFFFF"
                      aria-label="Text color picker"
                    />
                    <span class="contrast-picker-label">#FFFFFF</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="contrast-bg-color">Background Color</label>
                  <div class="contrast-picker-group">
                    <input
                      type="color"
                      id="contrast-bg-color"
                      class="contrast-color-input"
                      value="#1F6B57"
                      aria-label="Background color picker"
                    />
                    <span class="contrast-picker-label">#1F6B57</span>
                  </div>
                </div>
              </div>

              <div class="contrast-ratio-display" id="contrast-ratio">--</div>
              <p class="contrast-ratio-label">Contrast Ratio</p>

              <div class="wcag-grid">
                <div class="wcag-item">
                  <span class="wcag-item-label">AA Normal text (4.5:1)</span>
                  <span id="wcag-aa-normal" class="wcag-fail">--</span>
                </div>
                <div class="wcag-item">
                  <span class="wcag-item-label">AA Large text (3:1)</span>
                  <span id="wcag-aa-large" class="wcag-fail">--</span>
                </div>
                <div class="wcag-item">
                  <span class="wcag-item-label">AAA Normal text (7:1)</span>
                  <span id="wcag-aaa-normal" class="wcag-fail">--</span>
                </div>
                <div class="wcag-item">
                  <span class="wcag-item-label">AAA Large text (4.5:1)</span>
                  <span id="wcag-aaa-large" class="wcag-fail">--</span>
                </div>
              </div>

              <div id="contrast-preview" class="contrast-preview" aria-live="polite">
                <p class="contrast-preview-normal">The quick brown fox</p>
                <p class="contrast-preview-large">The quick brown fox</p>
              </div>

            </div>
            <!-- end Contrast Checker -->

            <!-- Color Format Guide -->
            <div class="results-section mt-20">
              <h2 class="results-section-title">
                <i data-lucide="book-open" aria-hidden="true"></i>
                Color Format Guide
              </h2>

              <div class="format-guide-grid">

                <div class="format-guide-item">
                  <p class="format-guide-name">HEX</p>
                  <p class="format-guide-desc">Hexadecimal color codes use base-16 numbers. Each pair represents Red, Green, Blue values from 00 to FF.</p>
                </div>

                <div class="format-guide-item">
                  <p class="format-guide-name">RGB</p>
                  <p class="format-guide-desc">RGB defines colors using Red, Green, Blue values from 0 to 255. The most common format for screens.</p>
                </div>

                <div class="format-guide-item">
                  <p class="format-guide-name">HSL</p>
                  <p class="format-guide-desc">HSL uses Hue (0-360 degrees), Saturation (0-100%), and Lightness (0-100%). Intuitive for design adjustments.</p>
                </div>

                <div class="format-guide-item">
                  <p class="format-guide-name">HSB / HSV</p>
                  <p class="format-guide-desc">HSB uses Hue, Saturation, and Brightness (Value) instead of Lightness. Common in design tools like Photoshop.</p>
                </div>

                <div class="format-guide-item">
                  <p class="format-guide-name">CMYK</p>
                  <p class="format-guide-desc">CMYK is used in printing. Cyan, Magenta, Yellow, and Key (Black) values from 0 to 100%.</p>
                </div>

              </div>
            </div>
            <!-- end Color Format Guide -->

          </div>
          <!-- end tool-container -->

          <div class="tool-disclaimer mt-20">
            <p>All color conversions happen locally in your browser. No data is sent to any server.</p>
          </div>

        </div>
      </div>
      
    </main>

<?php include '../includes/footer.php'; ?>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
  </body>
</html>
