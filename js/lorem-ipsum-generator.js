document.addEventListener('DOMContentLoaded', function() {

  var currentType = 'paragraphs';

  var loremWords = [
    "lorem", "ipsum", "dolor", "sit", "amet",
    "consectetur", "adipiscing", "elit", "sed",
    "do", "eiusmod", "tempor", "incididunt", "ut",
    "labore", "et", "dolore", "magna", "aliqua",
    "enim", "ad", "minim", "veniam", "quis",
    "nostrud", "exercitation", "ullamco", "laboris",
    "nisi", "aliquip", "ex", "ea", "commodo",
    "consequat", "duis", "aute", "irure", "in",
    "reprehenderit", "voluptate", "velit", "esse",
    "cillum", "eu", "fugiat", "nulla", "pariatur",
    "excepteur", "sint", "occaecat", "cupidatat",
    "non", "proident", "sunt", "culpa", "qui",
    "officia", "deserunt", "mollit", "anim", "id",
    "est", "laborum", "perspiciatis", "unde", "omnis",
    "iste", "natus", "error", "accusantium",
    "doloremque", "laudantium", "totam", "rem",
    "aperiam", "eaque", "ipsa", "quae", "ab",
    "inventore", "veritatis", "architecto", "beatae",
    "vitae", "dicta", "explicabo", "nemo", "ipsam",
    "voluptatem", "quia", "voluptas", "aspernatur",
    "odit", "fugit", "consequuntur", "magni",
    "dolores", "ratione", "sequi", "nesciunt",
    "neque", "porro", "quisquam", "dolorem", "ac",
    "numquam", "eius", "modi", "tempora", "quaerat",
    "etiam", "vero", "accumsan", "convallis",
    "curabitur", "diam", "dictum", "dignissim",
    "dui", "dapibus", "eleifend", "feugiat",
    "faucibus", "gravida", "hendrerit", "imperdiet",
    "lacus", "laoreet", "lectus", "leo", "libero",
    "luctus", "maecenas", "massa", "mauris",
    "metus", "mi", "molestie", "morbi", "nam",
    "nibh", "nisl", "nullam", "nunc", "odio",
    "orci", "pellentesque", "pharetra", "placerat",
    "porta", "porttitor", "pretium", "proin",
    "pulvinar", "purus", "quam", "rhoncus",
    "risus", "rutrum", "sagittis", "scelerisque",
    "semper", "senectus", "sociis", "sodales",
    "suscipit", "tellus", "tempus", "tincidunt",
    "tortor", "tristique", "turpis", "ultrices",
    "urna", "varius", "vehicula", "vel", "velit",
    "venenatis", "vestibulum", "vitae", "viverra",
    "vulputate"
  ];

  var classicOpening = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";

  function getRandomWord() {
    return loremWords[Math.floor(Math.random() * loremWords.length)];
  }

  function generateSentence(minWords, maxWords) {
    var count = minWords + Math.floor(Math.random() * (maxWords - minWords));
    var words = [];
    for (var i = 0; i < count; i++) {
      words.push(getRandomWord());
    }
    var sentence = words.join(' ');
    sentence = sentence.charAt(0).toUpperCase() + sentence.slice(1) + '.';
    return sentence;
  }

  function generateParagraph(minSentences, maxSentences) {
    var count = minSentences + Math.floor(Math.random() * (maxSentences - minSentences));
    var sentences = [];
    for (var i = 0; i < count; i++) {
      sentences.push(generateSentence(8, 20));
    }
    return sentences.join(' ');
  }

  function generateParagraphs(count, startWithLorem) {
    var paragraphs = [];
    for (var i = 0; i < count; i++) {
      var para = generateParagraph(3, 7);
      if (i === 0 && startWithLorem) {
        para = classicOpening + ' ' + generateParagraph(2, 5);
      }
      paragraphs.push(para);
    }
    return paragraphs;
  }

  function generateSentences(count, startWithLorem) {
    var sentences = [];
    for (var i = 0; i < count; i++) {
      if (i === 0 && startWithLorem) {
        sentences.push(classicOpening);
      } else {
        sentences.push(generateSentence(8, 20));
      }
    }
    return sentences;
  }

  function generateWords(count, startWithLorem) {
    var words = [];
    if (startWithLorem) {
      var loremStart = ["lorem", "ipsum", "dolor", "sit", "amet", "consectetur", "adipiscing", "elit"];
      loremStart.forEach(function(w) {
        if (words.length < count) words.push(w);
      });
    }
    while (words.length < count) {
      words.push(getRandomWord());
    }
    return words.slice(0, count);
  }

  function updateStats(text) {
    var words = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;
    var chars = text.length;
    var paras = text.trim() === '' ? 0 : text.trim().split(/\n\n+/).length;
    document.getElementById('output-stats').textContent = 'Words: ' + words + ' | Characters: ' + chars + ' | Paragraphs: ' + paras;
  }

  function generate() {
    var type = currentType;
    var quantity = parseInt(document.getElementById('quantity-input').value) || 5;
    var startWithLorem = document.getElementById('start-with-lorem').checked;
    var htmlFormat = document.getElementById('html-format').checked;
    var output = '';

    if (type === 'paragraphs') {
      var paras = generateParagraphs(quantity, startWithLorem);
      if (htmlFormat) {
        output = paras.map(function(p) {
          return '<p>' + p + '</p>';
        }).join('\n\n');
      } else {
        output = paras.join('\n\n');
      }
    } else if (type === 'sentences') {
      var sents = generateSentences(quantity, startWithLorem);
      output = sents.join(' ');
    } else if (type === 'words') {
      var words = generateWords(quantity, startWithLorem);
      output = words.join(' ');
    }

    document.getElementById('output-text').value = output;
    updateStats(output);
  }

  function setActiveType(type) {
    currentType = type;
    var quantityInput = document.getElementById('quantity-input');
    var quantityHint = document.getElementById('quantity-hint');

    document.getElementById('btn-paragraphs').classList.remove('bmi-unit-btn--active');
    document.getElementById('btn-sentences').classList.remove('bmi-unit-btn--active');
    document.getElementById('btn-words').classList.remove('bmi-unit-btn--active');

    if (type === 'paragraphs') {
      document.getElementById('btn-paragraphs').classList.add('bmi-unit-btn--active');
      quantityInput.max = '100';
      quantityHint.textContent = 'Number of paragraphs (1-100)';
    } else if (type === 'sentences') {
      document.getElementById('btn-sentences').classList.add('bmi-unit-btn--active');
      quantityInput.max = '100';
      quantityHint.textContent = 'Number of sentences (1-100)';
    } else if (type === 'words') {
      document.getElementById('btn-words').classList.add('bmi-unit-btn--active');
      quantityInput.max = '1000';
      quantityHint.textContent = 'Number of words (1-1000)';
    }
  }

  function copyOutput() {
    var text = document.getElementById('output-text').value;
    if (!text.trim()) return;
    var btn = document.getElementById('copy-btn');
    var label = btn.querySelector('span');

    function onSuccess() {
      label.textContent = 'Copied!';
      setTimeout(function() {
        label.textContent = 'Copy Text';
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

  function downloadOutput() {
    var text = document.getElementById('output-text').value;
    if (!text.trim()) return;
    var blob = new Blob([text], { type: 'text/plain' });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'lorem-ipsum.txt';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  }

  function clearOutput() {
    document.getElementById('output-text').value = '';
    updateStats('');
  }

  document.getElementById('btn-paragraphs').addEventListener('click', function() {
    setActiveType('paragraphs');
  });

  document.getElementById('btn-sentences').addEventListener('click', function() {
    setActiveType('sentences');
  });

  document.getElementById('btn-words').addEventListener('click', function() {
    setActiveType('words');
  });

  document.getElementById('generate-btn').addEventListener('click', generate);
  document.getElementById('copy-btn').addEventListener('click', copyOutput);
  document.getElementById('download-btn').addEventListener('click', downloadOutput);
  document.getElementById('clear-btn').addEventListener('click', clearOutput);

  generate();

});
