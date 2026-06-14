document.addEventListener('DOMContentLoaded', function() {

  var cssColors = {
    'red': '#FF0000',
    'orange': '#FFA500',
    'yellow': '#FFFF00',
    'green': '#008000',
    'blue': '#0000FF',
    'purple': '#800080',
    'pink': '#FFC0CB',
    'brown': '#A52A2A',
    'gray': '#808080',
    'black': '#000000',
    'white': '#FFFFFF',
    'cyan': '#00FFFF',
    'magenta': '#FF00FF',
    'lime': '#00FF00',
    'navy': '#000080',
    'teal': '#008080',
    'maroon': '#800000',
    'olive': '#808000',
    'silver': '#C0C0C0',
    'gold': '#FFD700',
    'coral': '#FF7F50',
    'salmon': '#FA8072',
    'turquoise': '#40E0D0',
    'violet': '#EE82EE',
    'indigo': '#4B0082',
    'crimson': '#DC143C',
    'darkgreen': '#006400',
    'skyblue': '#87CEEB'
  };

  function hexToRgb(hex) {
    hex = hex.replace('#', '');
    if (hex.length === 3) {
      hex = hex.split('').map(function(c) {
        return c + c;
      }).join('');
    }
    if (hex.length !== 6) return null;
    var r = parseInt(hex.substr(0, 2), 16);
    var g = parseInt(hex.substr(2, 2), 16);
    var b = parseInt(hex.substr(4, 2), 16);
    if (isNaN(r) || isNaN(g) || isNaN(b)) return null;
    return { r: r, g: g, b: b };
  }

  function rgbToHex(r, g, b) {
    function toHex(n) {
      var hex = Math.round(Math.max(0, Math.min(255, n))).toString(16);
      return hex.length === 1 ? '0' + hex : hex;
    }
    return '#' + toHex(r) + toHex(g) + toHex(b);
  }

  function rgbToHsl(r, g, b) {
    r /= 255; g /= 255; b /= 255;
    var max = Math.max(r, g, b);
    var min = Math.min(r, g, b);
    var h, s;
    var l = (max + min) / 2;
    if (max === min) {
      h = s = 0;
    } else {
      var d = max - min;
      s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
      switch (max) {
        case r: h = ((g - b) / d + (g < b ? 6 : 0)) / 6; break;
        case g: h = ((b - r) / d + 2) / 6; break;
        case b: h = ((r - g) / d + 4) / 6; break;
      }
    }
    return {
      h: Math.round(h * 360),
      s: Math.round(s * 100),
      l: Math.round(l * 100)
    };
  }

  function hslToRgb(h, s, l) {
    h /= 360; s /= 100; l /= 100;
    var r, g, b;
    if (s === 0) {
      r = g = b = l;
    } else {
      var hue2rgb = function(p, q, t) {
        if (t < 0) t += 1;
        if (t > 1) t -= 1;
        if (t < 1 / 6) return p + (q - p) * 6 * t;
        if (t < 1 / 2) return q;
        if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
        return p;
      };
      var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
      var p = 2 * l - q;
      r = hue2rgb(p, q, h + 1 / 3);
      g = hue2rgb(p, q, h);
      b = hue2rgb(p, q, h - 1 / 3);
    }
    return {
      r: Math.round(r * 255),
      g: Math.round(g * 255),
      b: Math.round(b * 255)
    };
  }

  function rgbToHsb(r, g, b) {
    r /= 255; g /= 255; b /= 255;
    var max = Math.max(r, g, b);
    var min = Math.min(r, g, b);
    var h;
    var v = max;
    var d = max - min;
    var s = max === 0 ? 0 : d / max;
    if (max === min) {
      h = 0;
    } else {
      switch (max) {
        case r: h = ((g - b) / d + (g < b ? 6 : 0)) / 6; break;
        case g: h = ((b - r) / d + 2) / 6; break;
        case b: h = ((r - g) / d + 4) / 6; break;
      }
    }
    return {
      h: Math.round(h * 360),
      s: Math.round(s * 100),
      b: Math.round(v * 100)
    };
  }

  function rgbToCmyk(r, g, b) {
    r /= 255; g /= 255; b /= 255;
    var k = 1 - Math.max(r, g, b);
    if (k === 1) {
      return { c: 0, m: 0, y: 0, k: 100 };
    }
    var c = (1 - r - k) / (1 - k);
    var m = (1 - g - k) / (1 - k);
    var y = (1 - b - k) / (1 - k);
    return {
      c: Math.round(c * 100),
      m: Math.round(m * 100),
      y: Math.round(y * 100),
      k: Math.round(k * 100)
    };
  }

  function cmykToRgb(c, m, y, k) {
    c /= 100; m /= 100; y /= 100; k /= 100;
    var r = 255 * (1 - c) * (1 - k);
    var g = 255 * (1 - m) * (1 - k);
    var b = 255 * (1 - y) * (1 - k);
    return {
      r: Math.round(r),
      g: Math.round(g),
      b: Math.round(b)
    };
  }

  function getLuminance(r, g, b) {
    var rgb = [r, g, b].map(function(v) {
      v /= 255;
      return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
    });
    return 0.2126 * rgb[0] + 0.7152 * rgb[1] + 0.0722 * rgb[2];
  }

  function setText(id, text) {
    var el = document.getElementById(id);
    if (el) el.textContent = text;
  }

  function setWcagResult(id, result) {
    var el = document.getElementById(id);
    if (!el) return;
    el.textContent = result;
    el.className = result === 'Pass' ? 'wcag-pass' : 'wcag-fail';
  }

  function updateAll(r, g, b) {
    r = Math.round(Math.max(0, Math.min(255, r)));
    g = Math.round(Math.max(0, Math.min(255, g)));
    b = Math.round(Math.max(0, Math.min(255, b)));

    var hex = rgbToHex(r, g, b);
    var hsl = rgbToHsl(r, g, b);
    var hsb = rgbToHsb(r, g, b);
    var cmyk = rgbToCmyk(r, g, b);

    document.getElementById('color-picker').value = hex;
    document.getElementById('hex-input').value = hex;

    var preview = document.getElementById('color-preview');
    if (preview) preview.style.backgroundColor = hex;

    document.getElementById('rgb-r').value = r;
    document.getElementById('rgb-g').value = g;
    document.getElementById('rgb-b').value = b;

    document.getElementById('hsl-h').value = hsl.h;
    document.getElementById('hsl-s').value = hsl.s;
    document.getElementById('hsl-l').value = hsl.l;

    document.getElementById('cmyk-c').value = cmyk.c;
    document.getElementById('cmyk-m').value = cmyk.m;
    document.getElementById('cmyk-y').value = cmyk.y;
    document.getElementById('cmyk-k').value = cmyk.k;

    setText('output-hex', hex.toUpperCase());
    setText('output-hex8', hex.toUpperCase() + 'FF');
    setText('output-rgb', 'rgb(' + r + ', ' + g + ', ' + b + ')');
    setText('output-rgb-values', r + ', ' + g + ', ' + b);
    setText('output-hsl', 'hsl(' + hsl.h + ', ' + hsl.s + '%, ' + hsl.l + '%)');
    setText('output-hsl-values', hsl.h + 'deg, ' + hsl.s + '%, ' + hsl.l + '%');
    setText('output-hsb', 'hsb(' + hsb.h + ', ' + hsb.s + '%, ' + hsb.b + '%)');
    setText('output-cmyk', 'cmyk(' + cmyk.c + '%, ' + cmyk.m + '%, ' + cmyk.y + '%, ' + cmyk.k + '%)');
    setText('output-css-var', '--color: ' + hex.toUpperCase() + ';');

    var rd = (r / 255).toFixed(3);
    var gd = (g / 255).toFixed(3);
    var bd = (b / 255).toFixed(3);
    setText('output-rgb-decimal', rd + ', ' + gd + ', ' + bd);

    updatePalette(r, g, b, hsl);
    checkCSSColorName(hex);
    updateContrastChecker();
  }

  function updatePalette(r, g, b, hsl) {
    generateTints(r, g, b);
    generateShades(r, g, b);
    generateHarmony(hsl);
  }

  function generateTints(r, g, b) {
    var percents = [10, 30, 50, 70, 90];
    percents.forEach(function(pct, i) {
      var tr = Math.round(r + (255 - r) * pct / 100);
      var tg = Math.round(g + (255 - g) * pct / 100);
      var tb = Math.round(b + (255 - b) * pct / 100);
      var hex = rgbToHex(tr, tg, tb);
      updatePaletteItem('tint-' + i, hex, tr, tg, tb);
    });
  }

  function generateShades(r, g, b) {
    var percents = [10, 30, 50, 70, 90];
    percents.forEach(function(pct, i) {
      var sr = Math.round(r * (1 - pct / 100));
      var sg = Math.round(g * (1 - pct / 100));
      var sb = Math.round(b * (1 - pct / 100));
      var hex = rgbToHex(sr, sg, sb);
      updatePaletteItem('shade-' + i, hex, sr, sg, sb);
    });
  }

  function generateHarmony(hsl) {
    var compH = (hsl.h + 180) % 360;
    var compRgb = hslToRgb(compH, hsl.s, hsl.l);
    updatePaletteItem(
      'complementary',
      rgbToHex(compRgb.r, compRgb.g, compRgb.b),
      compRgb.r, compRgb.g, compRgb.b
    );

    var ana1H = (hsl.h + 30) % 360;
    var ana2H = (hsl.h - 30 + 360) % 360;
    var ana1 = hslToRgb(ana1H, hsl.s, hsl.l);
    var ana2 = hslToRgb(ana2H, hsl.s, hsl.l);
    updatePaletteItem('analogous-1', rgbToHex(ana1.r, ana1.g, ana1.b), ana1.r, ana1.g, ana1.b);
    updatePaletteItem('analogous-2', rgbToHex(ana2.r, ana2.g, ana2.b), ana2.r, ana2.g, ana2.b);

    var tri1H = (hsl.h + 120) % 360;
    var tri2H = (hsl.h + 240) % 360;
    var tri1 = hslToRgb(tri1H, hsl.s, hsl.l);
    var tri2 = hslToRgb(tri2H, hsl.s, hsl.l);
    updatePaletteItem('triadic-1', rgbToHex(tri1.r, tri1.g, tri1.b), tri1.r, tri1.g, tri1.b);
    updatePaletteItem('triadic-2', rgbToHex(tri2.r, tri2.g, tri2.b), tri2.r, tri2.g, tri2.b);
  }

  function updatePaletteItem(id, hex, r, g, b) {
    var el = document.getElementById(id);
    if (!el) return;
    el.style.backgroundColor = hex;
    el.setAttribute('data-r', r);
    el.setAttribute('data-g', g);
    el.setAttribute('data-b', b);
    var label = el.nextElementSibling;
    if (label) label.textContent = hex.toUpperCase();
  }

  function updateContrastChecker() {
    var textInput = document.getElementById('contrast-text-color');
    var bgInput = document.getElementById('contrast-bg-color');
    if (!textInput || !bgInput) return;

    var textColor = textInput.value;
    var bgColor = bgInput.value;

    var textColorLabel = textInput.nextElementSibling;
    var bgColorLabel = bgInput.nextElementSibling;
    if (textColorLabel) textColorLabel.textContent = textColor.toUpperCase();
    if (bgColorLabel) bgColorLabel.textContent = bgColor.toUpperCase();

    var textRgb = hexToRgb(textColor);
    var bgRgb = hexToRgb(bgColor);
    if (!textRgb || !bgRgb) return;

    var textLum = getLuminance(textRgb.r, textRgb.g, textRgb.b);
    var bgLum = getLuminance(bgRgb.r, bgRgb.g, bgRgb.b);

    var ratio = textLum > bgLum
      ? (textLum + 0.05) / (bgLum + 0.05)
      : (bgLum + 0.05) / (textLum + 0.05);
    ratio = Math.round(ratio * 100) / 100;

    setText('contrast-ratio', ratio + ':1');

    setWcagResult('wcag-aa-normal', ratio >= 4.5 ? 'Pass' : 'Fail');
    setWcagResult('wcag-aa-large', ratio >= 3.0 ? 'Pass' : 'Fail');
    setWcagResult('wcag-aaa-normal', ratio >= 7.0 ? 'Pass' : 'Fail');
    setWcagResult('wcag-aaa-large', ratio >= 4.5 ? 'Pass' : 'Fail');

    var contrastPreview = document.getElementById('contrast-preview');
    if (contrastPreview) {
      contrastPreview.style.backgroundColor = bgColor;
      contrastPreview.style.color = textColor;
    }
  }

  function checkCSSColorName(hex) {
    var match = null;
    Object.keys(cssColors).forEach(function(name) {
      if (cssColors[name].toLowerCase() === hex.toLowerCase()) {
        match = name;
      }
    });
    var el = document.getElementById('color-name-display');
    if (el) {
      el.textContent = match ? 'CSS name: ' + match : '';
    }
  }

  function setupCopyButton(buttonId, outputId) {
    var btn = document.getElementById(buttonId);
    if (!btn) return;
    btn.addEventListener('click', function() {
      var output = document.getElementById(outputId);
      if (!output) return;
      var text = output.textContent;
      if (!text) return;
      navigator.clipboard.writeText(text).then(function() {
        var originalHTML = btn.innerHTML;
        btn.textContent = 'Copied!';
        btn.classList.add('is-copied');
        setTimeout(function() {
          btn.innerHTML = originalHTML;
          btn.classList.remove('is-copied');
          if (window.lucide) window.lucide.createIcons();
        }, 2000);
      }).catch(function() {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
        var originalHTML = btn.innerHTML;
        btn.textContent = 'Copied!';
        btn.classList.add('is-copied');
        setTimeout(function() {
          btn.innerHTML = originalHTML;
          btn.classList.remove('is-copied');
          if (window.lucide) window.lucide.createIcons();
        }, 2000);
      });
    });
  }

  function initCssSwatches() {
    var items = document.querySelectorAll('.css-swatch-item');
    items.forEach(function(item) {
      var colorName = item.getAttribute('data-css-color');
      if (!colorName) return;
      var swatch = item.querySelector('.css-swatch');
      if (swatch) {
        swatch.style.backgroundColor = colorName;
      }
      item.addEventListener('click', function() {
        var hex = cssColors[colorName];
        if (!hex) return;
        var rgb = hexToRgb(hex);
        if (!rgb) return;
        updateAll(rgb.r, rgb.g, rgb.b);
      });
    });
  }

  function initPaletteClicks() {
    var swatches = document.querySelectorAll('.palette-swatch');
    swatches.forEach(function(swatch) {
      swatch.addEventListener('click', function() {
        var r = parseInt(swatch.getAttribute('data-r'));
        var g = parseInt(swatch.getAttribute('data-g'));
        var b = parseInt(swatch.getAttribute('data-b'));
        if (!isNaN(r) && !isNaN(g) && !isNaN(b)) {
          updateAll(r, g, b);
        }
      });
      swatch.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          swatch.click();
        }
      });
    });
  }

  // Color picker event listener
  document.getElementById('color-picker').addEventListener('input', function() {
    var rgb = hexToRgb(this.value);
    if (rgb) updateAll(rgb.r, rgb.g, rgb.b);
  });

  // Hex input event listener
  document.getElementById('hex-input').addEventListener('input', function() {
    var val = this.value.trim();
    if (!val.startsWith('#')) val = '#' + val;
    if (val.length === 4 || val.length === 7) {
      var rgb = hexToRgb(val);
      if (rgb) updateAll(rgb.r, rgb.g, rgb.b);
    }
  });

  // RGB input event listeners
  function handleRgbInput() {
    var r = parseInt(document.getElementById('rgb-r').value);
    var g = parseInt(document.getElementById('rgb-g').value);
    var b = parseInt(document.getElementById('rgb-b').value);
    if (!isNaN(r) && !isNaN(g) && !isNaN(b)) {
      updateAll(r, g, b);
    }
  }
  document.getElementById('rgb-r').addEventListener('input', handleRgbInput);
  document.getElementById('rgb-g').addEventListener('input', handleRgbInput);
  document.getElementById('rgb-b').addEventListener('input', handleRgbInput);

  // HSL input event listeners
  function handleHslInput() {
    var h = parseFloat(document.getElementById('hsl-h').value);
    var s = parseFloat(document.getElementById('hsl-s').value);
    var l = parseFloat(document.getElementById('hsl-l').value);
    if (!isNaN(h) && !isNaN(s) && !isNaN(l)) {
      var rgb = hslToRgb(
        Math.max(0, Math.min(360, h)),
        Math.max(0, Math.min(100, s)),
        Math.max(0, Math.min(100, l))
      );
      updateAll(rgb.r, rgb.g, rgb.b);
    }
  }
  document.getElementById('hsl-h').addEventListener('input', handleHslInput);
  document.getElementById('hsl-s').addEventListener('input', handleHslInput);
  document.getElementById('hsl-l').addEventListener('input', handleHslInput);

  // CMYK input event listeners
  function handleCmykInput() {
    var c = parseFloat(document.getElementById('cmyk-c').value);
    var m = parseFloat(document.getElementById('cmyk-m').value);
    var y = parseFloat(document.getElementById('cmyk-y').value);
    var k = parseFloat(document.getElementById('cmyk-k').value);
    if (!isNaN(c) && !isNaN(m) && !isNaN(y) && !isNaN(k)) {
      var rgb = cmykToRgb(
        Math.max(0, Math.min(100, c)),
        Math.max(0, Math.min(100, m)),
        Math.max(0, Math.min(100, y)),
        Math.max(0, Math.min(100, k))
      );
      updateAll(rgb.r, rgb.g, rgb.b);
    }
  }
  document.getElementById('cmyk-c').addEventListener('input', handleCmykInput);
  document.getElementById('cmyk-m').addEventListener('input', handleCmykInput);
  document.getElementById('cmyk-y').addEventListener('input', handleCmykInput);
  document.getElementById('cmyk-k').addEventListener('input', handleCmykInput);

  // Contrast checker event listeners
  document.getElementById('contrast-text-color').addEventListener('input', updateContrastChecker);
  document.getElementById('contrast-bg-color').addEventListener('input', updateContrastChecker);

  // Copy button event listeners
  setupCopyButton('copy-hex', 'output-hex');
  setupCopyButton('copy-hex8', 'output-hex8');
  setupCopyButton('copy-rgb', 'output-rgb');
  setupCopyButton('copy-rgb-values', 'output-rgb-values');
  setupCopyButton('copy-hsl', 'output-hsl');
  setupCopyButton('copy-hsl-values', 'output-hsl-values');
  setupCopyButton('copy-hsb', 'output-hsb');
  setupCopyButton('copy-cmyk', 'output-cmyk');
  setupCopyButton('copy-css-var', 'output-css-var');
  setupCopyButton('copy-rgb-decimal', 'output-rgb-decimal');

  // Initialize
  initCssSwatches();
  initPaletteClicks();
  updateAll(31, 107, 87);
  updateContrastChecker();

});
