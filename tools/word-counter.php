<?php include '../includes/head.php'; ?>
<title>Word Counter - Free Online Word Count Tool | YourSimpleTools</title>
<meta name="description" content="Count words, characters, sentences, paragraphs and reading time instantly. Free online word counter tool - no signup required." />
<?php include '../includes/nav.php'; ?>

    <main>
      <div class="tool-page">
        <div class="container">

          <nav class="tool-breadcrumb" aria-label="Breadcrumb">
            <a href="../index.html">Home</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <a href="../index.html#popular-tools">Tools</a>
            <span aria-hidden="true"> &rsaquo; </span>
            <span>Word Counter</span>
          </nav>

          <div class="tool-page-header">
            <h1 class="tool-page-title">Word Counter</h1>
            <p class="tool-page-desc">Count words, characters, sentences, paragraphs and reading time instantly.</p>
          </div>

          <div class="tool-container">

            <div class="form-group">
              <label for="word-counter-input" class="form-label">Your text</label>
              <textarea
                id="word-counter-input"
                class="form-textarea"
                placeholder="Type or paste your text here..."
                rows="9"
                aria-label="Text to analyze"
              ></textarea>
            </div>

            <div class="results-section">
              <h2 class="results-section-title">
                <i data-lucide="bar-chart-2" aria-hidden="true"></i>
                Statistics
              </h2>
              <div class="results-grid" id="stats-grid">
                <div class="result-card">
                  <p class="result-label">Words</p>
                  <p class="result-value text-accent" id="stat-words">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Characters (with spaces)</p>
                  <p class="result-value text-accent" id="stat-chars-spaces">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Characters (without spaces)</p>
                  <p class="result-value text-accent" id="stat-chars-no-spaces">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Sentences</p>
                  <p class="result-value text-accent" id="stat-sentences">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Paragraphs</p>
                  <p class="result-value text-accent" id="stat-paragraphs">0</p>
                </div>
                <div class="result-card">
                  <p class="result-label">Reading Time</p>
                  <p class="result-value text-accent" id="stat-reading-time">-</p>
                </div>
              </div>
            </div>

            <div class="flex gap-8 mt-20">
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-clear">
                <i data-lucide="trash-2" aria-hidden="true"></i>
                Clear Text
              </button>
              <button type="button" class="btn-secondary flex-center gap-8" id="btn-copy">
                <i data-lucide="copy" aria-hidden="true"></i>
                <span id="btn-copy-label">Copy Text</span>
              </button>
            </div>

            <div class="calc-section">
              <h2 class="calc-section-title">
                <i data-lucide="trending-up" aria-hidden="true"></i>
                Keyword Density
              </h2>
              <p class="calc-section-note">Top 5 most used words, excluding common stop words</p>
              <div id="keyword-list">
                <p class="text-muted text-small">Start typing to see keyword density.</p>
              </div>
            </div>

          </div>

          <div class="tool-disclaimer">
            <p>All text processing happens locally in your browser. No text is sent to any server.</p>
          </div>

        </div>
      </div>
    </main>

<?php include '../includes/footer.php'; ?>
    <script>
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
    </script>
    <script>lucide.createIcons();</script>
    <script src="../js/main.js"></script>
  </body>
</html>
