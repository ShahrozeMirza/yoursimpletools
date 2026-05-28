document.addEventListener('DOMContentLoaded', function() {
  var STOP_WORDS = [
    'the', 'a', 'an', 'and', 'or', 'but', 'in', 'on', 'at', 'to',
    'for', 'of', 'with', 'by', 'from', 'is', 'was', 'are', 'were',
    'be', 'been', 'i', 'it', 'this', 'that', 'as', 'if', 'not',
    'he', 'she', 'we', 'they', 'you', 'my', 'his', 'her', 'its',
    'our', 'their', 'do', 'did', 'have', 'has', 'had', 'will',
    'would', 'can', 'could', 'should', 'may', 'might', 'so', 'up'
  ];

  var textarea = document.getElementById('word-counter-input');
  var statWords = document.getElementById('stat-words');
  var statCharsSpaces = document.getElementById('stat-chars-spaces');
  var statCharsNoSpaces = document.getElementById('stat-chars-no-spaces');
  var statSentences = document.getElementById('stat-sentences');
  var statParagraphs = document.getElementById('stat-paragraphs');
  var statReadingTime = document.getElementById('stat-reading-time');
  var keywordList = document.getElementById('keyword-list');
  var btnClear = document.getElementById('btn-clear');
  var btnCopy = document.getElementById('btn-copy');
  var btnCopyLabel = document.getElementById('btn-copy-label');

  function countWords(text) {
    if (!text.trim()) return 0;
    return text.trim().split(/\s+/).filter(function(w) { return w.length > 0; }).length;
  }

  function countSentences(text) {
    if (!text.trim()) return 0;
    return text.split(/[.!?]+/).filter(function(s) { return s.trim().length > 0; }).length;
  }

  function countParagraphs(text) {
    if (!text.trim()) return 0;
    return text.split(/\n\s*\n/).filter(function(p) { return p.trim().length > 0; }).length;
  }

  function getReadingTime(wordCount) {
    if (wordCount === 0) return '-';
    var minutes = Math.ceil(wordCount / 200);
    if (minutes < 1) return 'Less than a minute';
    return minutes === 1 ? '1 min' : minutes + ' mins';
  }

  function getKeywords(text) {
    if (!text.trim()) return [];
    var words = text.toLowerCase().replace(/[^a-z0-9\s]/g, '').split(/\s+/).filter(function(w) {
      return w.length > 1 && STOP_WORDS.indexOf(w) === -1;
    });
    var freq = {};
    words.forEach(function(w) {
      freq[w] = (freq[w] || 0) + 1;
    });
    return Object.keys(freq)
      .sort(function(a, b) { return freq[b] - freq[a]; })
      .slice(0, 5)
      .map(function(w) { return { word: w, count: freq[w] }; });
  }

  function renderKeywords(keywords) {
    if (keywords.length === 0) {
      keywordList.innerHTML = '<p class="text-muted text-small">Start typing to see keyword density.</p>';
      return;
    }
    var html = '';
    keywords.forEach(function(item) {
      html += '<div class="auto-display">';
      html += '<strong>' + item.word + '</strong>';
      html += ' - ' + item.count + (item.count === 1 ? ' occurrence' : ' occurrences');
      html += '</div>';
    });
    keywordList.innerHTML = html;
  }

  function updateStats() {
    var text = textarea.value;
    var wordCount = countWords(text);

    statWords.textContent = wordCount.toLocaleString();
    statCharsSpaces.textContent = text.length.toLocaleString();
    statCharsNoSpaces.textContent = text.replace(/\s/g, '').length.toLocaleString();
    statSentences.textContent = countSentences(text).toLocaleString();
    statParagraphs.textContent = countParagraphs(text).toLocaleString();
    statReadingTime.textContent = getReadingTime(wordCount);

    renderKeywords(getKeywords(text));
  }

  textarea.addEventListener('input', updateStats);

  btnClear.addEventListener('click', function() {
    textarea.value = '';
    updateStats();
    textarea.focus();
  });

  btnCopy.addEventListener('click', function() {
    var text = textarea.value;
    if (!text) return;
    navigator.clipboard.writeText(text).then(function() {
      btnCopyLabel.textContent = 'Copied!';
      setTimeout(function() {
        btnCopyLabel.textContent = 'Copy Text';
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
      btnCopyLabel.textContent = 'Copied!';
      setTimeout(function() {
        btnCopyLabel.textContent = 'Copy Text';
      }, 2000);
    });
  });

});
