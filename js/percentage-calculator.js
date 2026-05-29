document.addEventListener('DOMContentLoaded', function () {

  function getVal(id) {
    var el = document.getElementById(id);
    if (!el) return 0;
    var v = parseFloat(el.value);
    return isNaN(v) ? 0 : v;
  }

  function fmt(n) {
    return parseFloat(n.toFixed(4)).toString();
  }

  function setResult(id, text, color) {
    var el = document.getElementById(id);
    if (!el) return;
    el.textContent = text;
    if (color) {
      el.style.color = color;
    } else {
      el.style.color = '';
    }
  }

  function calcC1() {
    var percent = getVal('c1-percent');
    var number = getVal('c1-number');
    if (percent === 0 && number === 0) {
      setResult('c1-result', '');
      return;
    }
    var result = (percent / 100) * number;
    setResult('c1-result', percent + '% of ' + number + ' = ' + fmt(result));
  }

  function calcC2() {
    var value = getVal('c2-value');
    var total = getVal('c2-total');
    if (total === 0) {
      setResult('c2-result', '');
      return;
    }
    var result = (value / total) * 100;
    setResult('c2-result', value + ' is ' + fmt(result) + '% of ' + total);
  }

  function calcC3() {
    var from = getVal('c3-from');
    var to = getVal('c3-to');
    if (from === 0) {
      setResult('c3-result', '');
      return;
    }
    var change = ((to - from) / Math.abs(from)) * 100;
    var isIncrease = change >= 0;
    var text = fmt(Math.abs(change)) + '%' + (isIncrease ? ' increase' : ' decrease');
    var color = isIncrease ? '#1F6B57' : '#EF4444';
    setResult('c3-result', text, color);
  }

  function calcC4() {
    var number = getVal('c4-number');
    var percent = getVal('c4-percent');
    var added = (percent / 100) * number;
    var result = number + added;
    setResult('c4-result',
      number + ' + ' + percent + '% = ' + fmt(result)
      + ' (Added: ' + fmt(added) + ')');
  }

  function calcC5() {
    var number = getVal('c5-number');
    var percent = getVal('c5-percent');
    var subtracted = (percent / 100) * number;
    var result = number - subtracted;
    setResult('c5-result',
      number + ' - ' + percent + '% = ' + fmt(result)
      + ' (Subtracted: ' + fmt(subtracted) + ')');
  }

  function calcC6() {
    var num1 = getVal('c6-num1');
    var num2 = getVal('c6-num2');
    if (num1 === 0 && num2 === 0) {
      setResult('c6-result', '');
      return;
    }
    var avg = (Math.abs(num1) + Math.abs(num2)) / 2;
    if (avg === 0) {
      setResult('c6-result', '');
      return;
    }
    var diff = (Math.abs(num1 - num2) / avg) * 100;
    setResult('c6-result', 'Percentage difference = ' + fmt(diff) + '%');
  }

  document.getElementById('c1-percent').addEventListener('input', calcC1);
  document.getElementById('c1-percent').addEventListener('change', calcC1);
  document.getElementById('c1-number').addEventListener('input', calcC1);
  document.getElementById('c1-number').addEventListener('change', calcC1);

  document.getElementById('c2-value').addEventListener('input', calcC2);
  document.getElementById('c2-value').addEventListener('change', calcC2);
  document.getElementById('c2-total').addEventListener('input', calcC2);
  document.getElementById('c2-total').addEventListener('change', calcC2);

  document.getElementById('c3-from').addEventListener('input', calcC3);
  document.getElementById('c3-from').addEventListener('change', calcC3);
  document.getElementById('c3-to').addEventListener('input', calcC3);
  document.getElementById('c3-to').addEventListener('change', calcC3);

  document.getElementById('c4-number').addEventListener('input', calcC4);
  document.getElementById('c4-number').addEventListener('change', calcC4);
  document.getElementById('c4-percent').addEventListener('input', calcC4);
  document.getElementById('c4-percent').addEventListener('change', calcC4);

  document.getElementById('c5-number').addEventListener('input', calcC5);
  document.getElementById('c5-number').addEventListener('change', calcC5);
  document.getElementById('c5-percent').addEventListener('input', calcC5);
  document.getElementById('c5-percent').addEventListener('change', calcC5);

  document.getElementById('c6-num1').addEventListener('input', calcC6);
  document.getElementById('c6-num1').addEventListener('change', calcC6);
  document.getElementById('c6-num2').addEventListener('input', calcC6);
  document.getElementById('c6-num2').addEventListener('change', calcC6);

});
