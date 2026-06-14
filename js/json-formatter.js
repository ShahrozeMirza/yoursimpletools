document.addEventListener('DOMContentLoaded', function() {

  var sampleJSON = {
    'name': 'John Doe',
    'age': 30,
    'email': 'john@example.com',
    'address': {
      'street': '123 Main Street',
      'city': 'New York',
      'country': 'USA',
      'zipCode': '10001'
    },
    'phoneNumbers': [
      {
        'type': 'home',
        'number': '555-1234'
      },
      {
        'type': 'work',
        'number': '555-5678'
      }
    ],
    'skills': ['JavaScript', 'Python', 'React'],
    'isActive': true,
    'score': 98.5,
    'metadata': null
  };

  function getIndent() {
    var sel = document.getElementById('indent-size');
    var val = sel ? sel.value : '2';
    if (val === 'tab') return '\t';
    return parseInt(val);
  }

  function getInput() {
    return document.getElementById('json-input').value.trim();
  }

  function setOutput(text) {
    document.getElementById('json-output').value = text;
    updateOutputStats(text);
  }

  function showSuccess(msg) {
    var el = document.getElementById('validation-status');
    el.className = 'validation-success';
    el.textContent = msg;
    el.classList.remove('hidden');
  }

  function showError(msg) {
    var el = document.getElementById('validation-status');
    el.className = 'validation-error';
    el.textContent = msg;
    el.classList.remove('hidden');
  }

  function hideStatus() {
    var el = document.getElementById('validation-status');
    el.classList.add('hidden');
  }

  function sortObjectKeys(obj) {
    if (Array.isArray(obj)) {
      return obj.map(sortObjectKeys);
    }
    if (obj !== null && typeof obj === 'object') {
      var sorted = {};
      Object.keys(obj).sort().forEach(function(key) {
        sorted[key] = sortObjectKeys(obj[key]);
      });
      return sorted;
    }
    return obj;
  }

  function setText(id, text) {
    var el = document.getElementById(id);
    if (el) el.textContent = text;
  }

  function updateInputStatus() {
    var input = document.getElementById('json-input').value;
    var chars = input.length;
    var lines = input.split('\n').length;
    document.getElementById('input-status').textContent =
      'Characters: ' + chars.toLocaleString() +
      ' | Lines: ' + lines.toLocaleString();
  }

  function updateOutputStats(text) {
    var chars = text.length;
    var lines = text ? text.split('\n').length : 0;
    var sizeKB = (new Blob([text]).size / 1024).toFixed(2);
    document.getElementById('output-stats').textContent =
      'Characters: ' + chars.toLocaleString() +
      ' | Lines: ' + lines.toLocaleString() +
      ' | Size: ' + sizeKB + ' KB';
  }

  function updateJSONStats(parsed, formatted) {
    var stats = {
      keys: 0,
      values: 0,
      arrays: 0,
      objects: 0,
      depth: 0
    };

    function traverse(obj, depth) {
      if (depth > stats.depth) stats.depth = depth;
      if (Array.isArray(obj)) {
        stats.arrays++;
        obj.forEach(function(item) {
          stats.values++;
          if (typeof item === 'object' && item !== null) {
            traverse(item, depth + 1);
          }
        });
      } else if (obj !== null && typeof obj === 'object') {
        stats.objects++;
        Object.keys(obj).forEach(function(key) {
          stats.keys++;
          stats.values++;
          if (typeof obj[key] === 'object' && obj[key] !== null) {
            traverse(obj[key], depth + 1);
          }
        });
      }
    }

    traverse(parsed, 0);

    var sizeBytes = new Blob([formatted]).size;
    var sizeKB = (sizeBytes / 1024).toFixed(2);

    setText('stat-keys', stats.keys);
    setText('stat-values', stats.values);
    setText('stat-arrays', stats.arrays);
    setText('stat-objects', stats.objects);
    setText('stat-depth', stats.depth);
    setText('stat-size', sizeKB + ' KB');

    document.getElementById('json-stats').classList.remove('hidden');
  }

  function formatJSON() {
    var input = getInput();
    if (!input) {
      showError('Please enter JSON to format');
      return;
    }
    try {
      var parsed = JSON.parse(input);
      var sortKeys = document.getElementById('sort-keys').checked;
      if (sortKeys) {
        parsed = sortObjectKeys(parsed);
      }
      var indent = getIndent();
      var formatted = JSON.stringify(parsed, null, indent);
      setOutput(formatted);
      showSuccess('Valid JSON - Formatted successfully');
      updateJSONStats(parsed, formatted);
    } catch (e) {
      showError('Invalid JSON: ' + e.message);
      setOutput('');
    }
  }

  function minifyJSON() {
    var input = getInput();
    if (!input) {
      showError('Please enter JSON to minify');
      return;
    }
    try {
      var parsed = JSON.parse(input);
      var minified = JSON.stringify(parsed);
      setOutput(minified);
      showSuccess('Valid JSON - Minified successfully');
      updateJSONStats(parsed, minified);
    } catch (e) {
      showError('Invalid JSON: ' + e.message);
      setOutput('');
    }
  }

  function validateJSON() {
    var input = getInput();
    if (!input) {
      showError('Please enter JSON to validate');
      return;
    }
    try {
      JSON.parse(input);
      showSuccess('Valid JSON');
    } catch (e) {
      showError('Invalid JSON: ' + e.message);
    }
  }

  function copyOutput() {
    var output = document.getElementById('json-output').value;
    if (!output) return;
    navigator.clipboard.writeText(output);
    var btn = document.getElementById('btn-copy');
    btn.textContent = 'Copied!';
    setTimeout(function() {
      btn.textContent = 'Copy';
    }, 2000);
  }

  function clearAll() {
    document.getElementById('json-input').value = '';
    document.getElementById('json-output').value = '';
    hideStatus();
    updateInputStatus();
    updateOutputStats('');
    document.getElementById('json-stats').classList.add('hidden');
  }

  function loadSample() {
    var sample = JSON.stringify(sampleJSON, null, 2);
    document.getElementById('json-input').value = sample;
    updateInputStatus();
    formatJSON();
  }

  document.getElementById('btn-format').addEventListener('click', formatJSON);
  document.getElementById('btn-minify').addEventListener('click', minifyJSON);
  document.getElementById('btn-validate').addEventListener('click', validateJSON);
  document.getElementById('btn-clear').addEventListener('click', clearAll);
  document.getElementById('btn-copy').addEventListener('click', copyOutput);
  document.getElementById('btn-sample').addEventListener('click', loadSample);

  document.getElementById('json-input').addEventListener('input', updateInputStatus);

  document.getElementById('indent-size').addEventListener('change', function() {
    if (document.getElementById('json-output').value) {
      formatJSON();
    }
  });

  document.getElementById('sort-keys').addEventListener('change', function() {
    if (document.getElementById('json-output').value) {
      formatJSON();
    }
  });

  document.getElementById('json-input').addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'Enter') {
      formatJSON();
    }
  });

  document.getElementById('json-stats').classList.add('hidden');
  document.getElementById('validation-status').classList.add('hidden');
  updateInputStatus();
  updateOutputStats('');

});
