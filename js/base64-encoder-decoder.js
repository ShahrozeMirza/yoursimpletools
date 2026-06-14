document.addEventListener('DOMContentLoaded', function() {

  var activeTab = 'encode';

  function switchTab(tab) {
    activeTab = tab;
    var encodeSection = document.getElementById('encode-section');
    var decodeSection = document.getElementById('decode-section');
    var tabEncode = document.getElementById('tab-encode');
    var tabDecode = document.getElementById('tab-decode');

    if (tab === 'encode') {
      encodeSection.classList.remove('hidden');
      decodeSection.classList.add('hidden');
      tabEncode.classList.add('bmi-unit-btn--active');
      tabEncode.setAttribute('aria-selected', 'true');
      tabDecode.classList.remove('bmi-unit-btn--active');
      tabDecode.setAttribute('aria-selected', 'false');
    } else {
      decodeSection.classList.remove('hidden');
      encodeSection.classList.add('hidden');
      tabDecode.classList.add('bmi-unit-btn--active');
      tabDecode.setAttribute('aria-selected', 'true');
      tabEncode.classList.remove('bmi-unit-btn--active');
      tabEncode.setAttribute('aria-selected', 'false');
    }
  }

  function encodeBase64() {
    var input = document.getElementById('encode-input').value;
    if (!input) {
      document.getElementById('encode-output').value = '';
      updateEncodeStats('', '');
      return;
    }
    try {
      var urlSafe = document.getElementById('url-safe-encode').checked;
      var encoded = btoa(unescape(encodeURIComponent(input)));
      if (urlSafe) {
        encoded = encoded
          .replace(/\+/g, '-')
          .replace(/\//g, '_')
          .replace(/=/g, '');
      }
      document.getElementById('encode-output').value = encoded;
      updateEncodeStats(input, encoded);
    } catch (e) {
      document.getElementById('encode-output').value = '';
      showEncodeError('Encoding failed: ' + e.message);
    }
  }

  function decodeBase64() {
    var input = document.getElementById('decode-input').value.trim();
    if (!input) {
      document.getElementById('decode-output').value = '';
      updateDecodeStats('', '');
      hideDecodeStatus();
      return;
    }
    try {
      var urlSafe = document.getElementById('url-safe-decode').checked;
      var normalized = input;
      if (urlSafe) {
        normalized = input
          .replace(/-/g, '+')
          .replace(/_/g, '/');
        while (normalized.length % 4 !== 0) {
          normalized += '=';
        }
      }
      var decoded = decodeURIComponent(escape(atob(normalized)));
      document.getElementById('decode-output').value = decoded;
      showDecodeSuccess('Valid Base64 string');
      updateDecodeStats(input, decoded);
    } catch (e) {
      document.getElementById('decode-output').value = '';
      showDecodeError('Invalid Base64: ' + e.message);
    }
  }

  function updateEncodeStats(input, output) {
    var inputLen = input.length;
    var outputLen = output.length;
    var increase = inputLen > 0
      ? Math.round(((outputLen - inputLen) / inputLen) * 100)
      : 0;
    document.getElementById('encode-stats').textContent =
      'Input: ' + inputLen + ' chars | Output: ' + outputLen +
      ' chars | Size increase: ' + increase + '%';
  }

  function updateDecodeStats(input, output) {
    document.getElementById('decode-stats').textContent =
      'Input: ' + input.length + ' chars | Output: ' + output.length + ' chars';
  }

  function showDecodeSuccess(msg) {
    var el = document.getElementById('decode-status');
    el.className = 'validation-success';
    el.textContent = msg;
    el.classList.remove('hidden');
  }

  function showDecodeError(msg) {
    var el = document.getElementById('decode-status');
    el.className = 'validation-error';
    el.textContent = msg;
    el.classList.remove('hidden');
  }

  function hideDecodeStatus() {
    document.getElementById('decode-status').classList.add('hidden');
  }

  function showEncodeError(msg) {
    var outputEl = document.getElementById('encode-output');
    outputEl.value = '';
    document.getElementById('encode-stats').textContent = msg;
  }

  function copyEncode() {
    var val = document.getElementById('encode-output').value;
    if (!val) return;
    navigator.clipboard.writeText(val);
    var btn = document.getElementById('copy-encode-btn');
    btn.textContent = 'Copied!';
    setTimeout(function() {
      btn.textContent = 'Copy Base64';
    }, 2000);
  }

  function copyDecode() {
    var val = document.getElementById('decode-output').value;
    if (!val) return;
    navigator.clipboard.writeText(val);
    var btn = document.getElementById('copy-decode-btn');
    btn.textContent = 'Copied!';
    setTimeout(function() {
      btn.textContent = 'Copy Text';
    }, 2000);
  }

  function clearEncode() {
    document.getElementById('encode-input').value = '';
    document.getElementById('encode-output').value = '';
    document.getElementById('encode-stats').textContent = '';
  }

  function clearDecode() {
    document.getElementById('decode-input').value = '';
    document.getElementById('decode-output').value = '';
    document.getElementById('decode-stats').textContent = '';
    hideDecodeStatus();
  }

  function downloadEncode() {
    var content = document.getElementById('encode-output').value;
    if (!content) return;
    var blob = new Blob([content], { type: 'text/plain' });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'base64-encoded.txt';
    a.click();
    URL.revokeObjectURL(url);
  }

  function encodeFile() {
    var fileInput = document.getElementById('file-input');
    var file = fileInput.files[0];
    if (!file) {
      alert('Please select a file first');
      return;
    }
    var reader = new FileReader();
    reader.onload = function(e) {
      var base64 = e.target.result.split(',')[1];
      document.getElementById('file-output').value = base64;
      var originalKB = (file.size / 1024).toFixed(2);
      var base64KB = (base64.length / 1024).toFixed(2);
      document.getElementById('file-stats').textContent =
        'File: ' + file.name +
        ' | Size: ' + originalKB + ' KB' +
        ' | Base64 Size: ' + base64KB + ' KB';
    };
    reader.readAsDataURL(file);
  }

  function copyFileBase64() {
    var val = document.getElementById('file-output').value;
    if (!val) return;
    navigator.clipboard.writeText(val);
    var btn = document.getElementById('copy-file-btn');
    btn.textContent = 'Copied!';
    setTimeout(function() {
      btn.textContent = 'Copy Base64';
    }, 2000);
  }

  document.getElementById('tab-encode').addEventListener('click', function() {
    switchTab('encode');
  });

  document.getElementById('tab-decode').addEventListener('click', function() {
    switchTab('decode');
  });

  document.getElementById('btn-encode').addEventListener('click', encodeBase64);

  document.getElementById('btn-decode').addEventListener('click', decodeBase64);

  document.getElementById('encode-input').addEventListener('input', function() {
    if (document.getElementById('live-encode').checked) {
      encodeBase64();
    }
  });

  document.getElementById('decode-input').addEventListener('input', function() {
    if (document.getElementById('live-decode').checked) {
      decodeBase64();
    }
  });

  document.getElementById('url-safe-encode').addEventListener('change', encodeBase64);

  document.getElementById('url-safe-decode').addEventListener('change', decodeBase64);

  document.getElementById('copy-encode-btn').addEventListener('click', copyEncode);

  document.getElementById('copy-decode-btn').addEventListener('click', copyDecode);

  document.getElementById('clear-encode-btn').addEventListener('click', clearEncode);

  document.getElementById('clear-decode-btn').addEventListener('click', clearDecode);

  document.getElementById('download-encode-btn').addEventListener('click', downloadEncode);

  document.getElementById('btn-encode-file').addEventListener('click', encodeFile);

  document.getElementById('copy-file-btn').addEventListener('click', copyFileBase64);

  switchTab('encode');
  hideDecodeStatus();

});
