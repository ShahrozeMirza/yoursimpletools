document.addEventListener('DOMContentLoaded', function() {
  var DEFAULT_BASE = 16;

  var commonPX = [8, 10, 12, 14, 16, 18, 20, 24, 28, 32, 36, 48, 64];

  var baseFontSize = document.getElementById('base-font-size');
  var pxInput = document.getElementById('px-input');
  var remInput = document.getElementById('rem-input');
  var formulaDisplay = document.getElementById('formula-display');
  var resetBtn = document.getElementById('reset-btn');
  var copyPxBtn = document.getElementById('copy-px-btn');
  var copyRemBtn = document.getElementById('copy-rem-btn');
  var copyPxLabel = document.getElementById('copy-px-label');
  var copyRemLabel = document.getElementById('copy-rem-label');

  function getBase() {
    var el = document.getElementById('base-font-size');
    var v = parseFloat(el.value);
    return (isNaN(v) || v <= 0) ? DEFAULT_BASE : v;
  }

  function fmt(n) {
    return parseFloat(n.toFixed(4)).toString();
  }

  function updateFormula() {
    var base = getBase();
    formulaDisplay.textContent = 'Formula: REM = PX / ' + base + ' | PX = REM x ' + base;
  }

  function updateTable() {
    var base = getBase();
    commonPX.forEach(function(px) {
      var rem = px / base;
      var row = document.querySelector('tr[data-px="' + px + '"]');
      if (row) {
        var cell = row.querySelector('.rem-val');
        if (cell) {
          cell.textContent = fmt(rem);
        }
      }
    });
  }

  function onPxChange() {
    var px = parseFloat(pxInput.value);
    if (isNaN(px)) {
      remInput.value = '';
      return;
    }
    var rem = px / getBase();
    remInput.value = fmt(rem);
  }

  function onRemChange() {
    var rem = parseFloat(remInput.value);
    if (isNaN(rem)) {
      pxInput.value = '';
      return;
    }
    var px = rem * getBase();
    pxInput.value = fmt(px);
  }

  function onBaseChange() {
    if (pxInput.value !== '') {
      onPxChange();
    } else if (remInput.value !== '') {
      onRemChange();
    }
    updateFormula();
    updateTable();
  }

  function copyToClipboard(text, labelEl, originalText) {
    if (!text) return;
    navigator.clipboard.writeText(text).then(function() {
      labelEl.textContent = 'Copied!';
      setTimeout(function() {
        labelEl.textContent = originalText;
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
      labelEl.textContent = 'Copied!';
      setTimeout(function() {
        labelEl.textContent = originalText;
      }, 2000);
    });
  }

  pxInput.addEventListener('input', onPxChange);
  pxInput.addEventListener('change', onPxChange);

  remInput.addEventListener('input', onRemChange);
  remInput.addEventListener('change', onRemChange);

  baseFontSize.addEventListener('input', onBaseChange);
  baseFontSize.addEventListener('change', onBaseChange);

  resetBtn.addEventListener('click', function() {
    pxInput.value = '';
    remInput.value = '';
    baseFontSize.value = DEFAULT_BASE;
    updateFormula();
    updateTable();
  });

  copyPxBtn.addEventListener('click', function() {
    copyToClipboard(pxInput.value, copyPxLabel, 'Copy PX');
  });

  copyRemBtn.addEventListener('click', function() {
    copyToClipboard(remInput.value, copyRemLabel, 'Copy REM');
  });

  updateFormula();
  updateTable();
});
