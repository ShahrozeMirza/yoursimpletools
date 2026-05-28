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
