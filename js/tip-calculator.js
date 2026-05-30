document.addEventListener('DOMContentLoaded', function () {

  var DEFAULT_TIP = 15;
  var currentTip = DEFAULT_TIP;

  var currencies = {
    USD: '$',
    GBP: 'pound',
    EUR: 'euro',
    CAD: 'CA$',
    AUD: 'A$',
    PKR: 'Rs '
  };

  function getVal(id) {
    var el = document.getElementById(id);
    if (!el) return 0;
    var v = parseFloat(el.value);
    return (isNaN(v) || v < 0) ? 0 : v;
  }

  function getSym() {
    var sel = document.getElementById('currency-select');
    var currency = sel ? sel.value : 'USD';
    return currencies[currency] || '$';
  }

  function fmt(n) {
    return n.toFixed(2);
  }

  function setText(id, text) {
    var el = document.getElementById(id);
    if (el) el.textContent = text;
  }

  function updateCurrencySymbol() {
    var sym = getSym();
    var symEl = document.getElementById('currency-symbol');
    if (symEl) symEl.textContent = sym;
  }

  function calculate() {
    var bill = getVal('bill-amount');
    var tip = currentTip;
    var people = getVal('num-people') || 1;
    var roundUpEl = document.getElementById('round-up');
    var roundUp = roundUpEl ? roundUpEl.checked : false;
    var sym = getSym();

    var tipAmount = bill * (tip / 100);
    var totalBill = bill + tipAmount;
    var perPerson = totalBill / people;
    var tipPerPerson = tipAmount / people;

    if (roundUp) {
      perPerson = Math.ceil(perPerson);
      tipPerPerson = Math.ceil(tipPerPerson);
    }

    setText('result-tip-amount', sym + fmt(tipAmount));
    setText('result-total-bill', sym + fmt(totalBill));
    setText('result-per-person', sym + fmt(perPerson));
    setText('result-tip-per-person', sym + fmt(tipPerPerson));

    updateBreakdownTable(bill, tipAmount, totalBill, people, perPerson, sym, tip);
  }

  function updateBreakdownTable(bill, tipAmount, totalBill, people, perPerson, sym, tip) {
    setText('breakdown-bill', sym + fmt(bill));
    setText('breakdown-tip', sym + fmt(tipAmount) + ' (' + tip + '%)');
    setText('breakdown-total', sym + fmt(totalBill));
    setText('breakdown-people', people);
    setText('breakdown-per-person', sym + fmt(perPerson));
  }

  var tipButtons = document.querySelectorAll('[id^="tip-"]');

  tipButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      tipButtons.forEach(function (b) {
        b.classList.remove('bmi-unit-btn--active');
        b.setAttribute('aria-pressed', 'false');
      });
      btn.classList.add('bmi-unit-btn--active');
      btn.setAttribute('aria-pressed', 'true');

      if (btn.id === 'tip-custom') {
        document.getElementById('custom-tip-input').classList.remove('hidden');
        var customVal = getVal('custom-tip-input');
        currentTip = customVal || 0;
      } else {
        document.getElementById('custom-tip-input').classList.add('hidden');
        currentTip = parseInt(btn.textContent.replace('%', ''));
      }
      calculate();
    });
  });

  document.getElementById('custom-tip-input').addEventListener('input', function () {
    currentTip = getVal('custom-tip-input') || 0;
    calculate();
  });

  document.getElementById('bill-amount').addEventListener('input', calculate);
  document.getElementById('bill-amount').addEventListener('change', calculate);

  document.getElementById('num-people').addEventListener('input', calculate);
  document.getElementById('num-people').addEventListener('change', calculate);

  document.getElementById('round-up').addEventListener('change', calculate);

  document.getElementById('currency-select').addEventListener('change', function () {
    updateCurrencySymbol();
    calculate();
  });

  calculate();

});
