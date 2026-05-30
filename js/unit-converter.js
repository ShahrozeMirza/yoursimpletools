document.addEventListener('DOMContentLoaded', function () {

  var categories = {
    length: {
      name: 'Length',
      baseUnit: 'meter',
      units: {
        kilometer:     { name: 'Kilometer',     symbol: 'km',  toBase: 1000 },
        meter:         { name: 'Meter',         symbol: 'm',   toBase: 1 },
        centimeter:    { name: 'Centimeter',    symbol: 'cm',  toBase: 0.01 },
        millimeter:    { name: 'Millimeter',    symbol: 'mm',  toBase: 0.001 },
        mile:          { name: 'Mile',          symbol: 'mi',  toBase: 1609.344 },
        yard:          { name: 'Yard',          symbol: 'yd',  toBase: 0.9144 },
        foot:          { name: 'Foot',          symbol: 'ft',  toBase: 0.3048 },
        inch:          { name: 'Inch',          symbol: 'in',  toBase: 0.0254 },
        nautical_mile: { name: 'Nautical Mile', symbol: 'nmi', toBase: 1852 },
        light_year:    { name: 'Light Year',    symbol: 'ly',  toBase: 9.461e15 }
      }
    },
    weight: {
      name: 'Weight',
      baseUnit: 'kilogram',
      units: {
        kilogram:   { name: 'Kilogram',   symbol: 'kg',   toBase: 1 },
        gram:       { name: 'Gram',       symbol: 'g',    toBase: 0.001 },
        milligram:  { name: 'Milligram',  symbol: 'mg',   toBase: 0.000001 },
        metric_ton: { name: 'Metric Ton', symbol: 't',    toBase: 1000 },
        pound:      { name: 'Pound',      symbol: 'lb',   toBase: 0.453592 },
        ounce:      { name: 'Ounce',      symbol: 'oz',   toBase: 0.0283495 },
        stone:      { name: 'Stone',      symbol: 'st',   toBase: 6.35029 },
        tola:       { name: 'Tola',       symbol: 'tola', toBase: 0.011664 },
        seer:       { name: 'Seer',       symbol: 'seer', toBase: 0.933105 }
      }
    },
    temperature: {
      name: 'Temperature',
      baseUnit: 'celsius',
      units: {
        celsius:    { name: 'Celsius',    symbol: 'C' },
        fahrenheit: { name: 'Fahrenheit', symbol: 'F' },
        kelvin:     { name: 'Kelvin',     symbol: 'K' }
      }
    },
    area: {
      name: 'Area',
      baseUnit: 'square_meter',
      units: {
        square_kilometer:  { name: 'Square Kilometer',  symbol: 'sq km', toBase: 1000000 },
        square_meter:      { name: 'Square Meter',      symbol: 'sq m',  toBase: 1 },
        square_centimeter: { name: 'Square Centimeter', symbol: 'sq cm', toBase: 0.0001 },
        square_mile:       { name: 'Square Mile',       symbol: 'sq mi', toBase: 2589988.11 },
        square_yard:       { name: 'Square Yard',       symbol: 'sq yd', toBase: 0.836127 },
        square_foot:       { name: 'Square Foot',       symbol: 'sq ft', toBase: 0.092903 },
        square_inch:       { name: 'Square Inch',       symbol: 'sq in', toBase: 0.00064516 },
        hectare:           { name: 'Hectare',           symbol: 'ha',    toBase: 10000 },
        acre:              { name: 'Acre',              symbol: 'ac',    toBase: 4046.86 },
        marla:             { name: 'Marla',             symbol: 'marla', toBase: 25.2929 },
        kanal:             { name: 'Kanal',             symbol: 'kanal', toBase: 505.857 }
      }
    },
    volume: {
      name: 'Volume',
      baseUnit: 'liter',
      units: {
        liter:            { name: 'Liter',            symbol: 'L',      toBase: 1 },
        milliliter:       { name: 'Milliliter',       symbol: 'mL',     toBase: 0.001 },
        cubic_meter:      { name: 'Cubic Meter',      symbol: 'cu m',   toBase: 1000 },
        cubic_centimeter: { name: 'Cubic Centimeter', symbol: 'cu cm',  toBase: 0.001 },
        us_gallon:        { name: 'US Gallon',        symbol: 'gal',    toBase: 3.78541 },
        uk_gallon:        { name: 'UK Gallon',        symbol: 'UK gal', toBase: 4.54609 },
        us_quart:         { name: 'US Quart',         symbol: 'qt',     toBase: 0.946353 },
        us_pint:          { name: 'US Pint',          symbol: 'pt',     toBase: 0.473176 },
        us_cup:           { name: 'US Cup',           symbol: 'cup',    toBase: 0.236588 },
        us_fluid_ounce:   { name: 'US Fluid Ounce',  symbol: 'fl oz',  toBase: 0.0295735 },
        tablespoon:       { name: 'Tablespoon',       symbol: 'tbsp',   toBase: 0.0147868 },
        teaspoon:         { name: 'Teaspoon',         symbol: 'tsp',    toBase: 0.00492892 }
      }
    },
    speed: {
      name: 'Speed',
      baseUnit: 'ms',
      units: {
        kmh:  { name: 'Kilometer per hour', symbol: 'km/h', toBase: 0.277778 },
        ms:   { name: 'Meter per second',   symbol: 'm/s',  toBase: 1 },
        mph:  { name: 'Mile per hour',      symbol: 'mph',  toBase: 0.44704 },
        fps:  { name: 'Foot per second',    symbol: 'ft/s', toBase: 0.3048 },
        knot: { name: 'Knot',               symbol: 'kn',   toBase: 0.514444 },
        mach: { name: 'Mach',               symbol: 'Mach', toBase: 343 }
      }
    },
    time: {
      name: 'Time',
      baseUnit: 'second',
      units: {
        second:      { name: 'Second',      symbol: 's',   toBase: 1 },
        millisecond: { name: 'Millisecond', symbol: 'ms',  toBase: 0.001 },
        minute:      { name: 'Minute',      symbol: 'min', toBase: 60 },
        hour:        { name: 'Hour',        symbol: 'h',   toBase: 3600 },
        day:         { name: 'Day',         symbol: 'd',   toBase: 86400 },
        week:        { name: 'Week',        symbol: 'wk',  toBase: 604800 },
        month:       { name: 'Month',       symbol: 'mo',  toBase: 2629800 },
        year:        { name: 'Year',        symbol: 'yr',  toBase: 31557600 },
        decade:      { name: 'Decade',      symbol: 'dec', toBase: 315576000 },
        century:     { name: 'Century',     symbol: 'cen', toBase: 3155760000 }
      }
    },
    data: {
      name: 'Data Storage',
      baseUnit: 'byte',
      units: {
        bit:      { name: 'Bit',      symbol: 'b',   toBase: 0.125 },
        byte:     { name: 'Byte',     symbol: 'B',   toBase: 1 },
        kilobyte: { name: 'Kilobyte', symbol: 'KB',  toBase: 1000 },
        megabyte: { name: 'Megabyte', symbol: 'MB',  toBase: 1000000 },
        gigabyte: { name: 'Gigabyte', symbol: 'GB',  toBase: 1000000000 },
        terabyte: { name: 'Terabyte', symbol: 'TB',  toBase: 1000000000000 },
        petabyte: { name: 'Petabyte', symbol: 'PB',  toBase: 1000000000000000 },
        kibibyte: { name: 'Kibibyte', symbol: 'KiB', toBase: 1024 },
        mebibyte: { name: 'Mebibyte', symbol: 'MiB', toBase: 1048576 },
        gibibyte: { name: 'Gibibyte', symbol: 'GiB', toBase: 1073741824 }
      }
    }
  };

  var defaultUnits = {
    length:      { from: 'kilometer',    to: 'mile' },
    weight:      { from: 'kilogram',     to: 'pound' },
    temperature: { from: 'celsius',      to: 'fahrenheit' },
    area:        { from: 'square_meter', to: 'square_foot' },
    volume:      { from: 'liter',        to: 'us_gallon' },
    speed:       { from: 'kmh',          to: 'mph' },
    time:        { from: 'hour',         to: 'minute' },
    data:        { from: 'gigabyte',     to: 'megabyte' }
  };

  var categoryRefs = ['length', 'weight', 'temperature', 'area', 'volume', 'speed', 'time', 'data'];

  var activeCategory = 'length';

  function populateSelects(category) {
    var fromSel = document.getElementById('from-unit');
    var toSel = document.getElementById('to-unit');
    fromSel.innerHTML = '';
    toSel.innerHTML = '';
    var units = categories[category].units;
    Object.keys(units).forEach(function (key) {
      var opt1 = document.createElement('option');
      opt1.value = key;
      opt1.textContent = units[key].name + ' (' + units[key].symbol + ')';
      fromSel.appendChild(opt1);
      var opt2 = opt1.cloneNode(true);
      toSel.appendChild(opt2);
    });
  }

  function switchCategory(category) {
    activeCategory = category;

    categoryRefs.forEach(function (cat) {
      var btn = document.getElementById('tab-' + cat);
      if (btn) {
        if (cat === category) {
          btn.classList.add('bmi-unit-btn--active');
          btn.setAttribute('aria-selected', 'true');
        } else {
          btn.classList.remove('bmi-unit-btn--active');
          btn.setAttribute('aria-selected', 'false');
        }
      }
    });

    populateSelects(category);

    var defaults = defaultUnits[category];
    if (defaults) {
      document.getElementById('from-unit').value = defaults.from;
      document.getElementById('to-unit').value = defaults.to;
    }

    document.getElementById('input-value').value = '';
    clearResult();
    updateReferenceTable(category);
  }

  function clearResult() {
    document.getElementById('result-display').textContent = '--';
    document.getElementById('result-formula').textContent = '';
  }

  function updateReferenceTable(category) {
    categoryRefs.forEach(function (cat) {
      var el = document.getElementById('ref-' + cat);
      if (el) {
        if (cat === category) {
          el.classList.remove('hidden');
        } else {
          el.classList.add('hidden');
        }
      }
    });
  }

  function convertTemperature(value, from, to) {
    var celsius;
    if (from === 'celsius') {
      celsius = value;
    } else if (from === 'fahrenheit') {
      celsius = (value - 32) * 5 / 9;
    } else if (from === 'kelvin') {
      celsius = value - 273.15;
    }

    if (to === 'celsius') return celsius;
    if (to === 'fahrenheit') return (celsius * 9 / 5) + 32;
    if (to === 'kelvin') return celsius + 273.15;
  }

  function formatNumber(n) {
    if (Math.abs(n) >= 1000000) {
      return n.toExponential(4);
    }
    if (Math.abs(n) >= 1) {
      return parseFloat(n.toFixed(6)).toString();
    }
    if (Math.abs(n) >= 0.0001) {
      return parseFloat(n.toFixed(8)).toString();
    }
    return n.toExponential(4);
  }

  function displayResult(result, fromUnit, toUnit, inputVal) {
    var units = categories[activeCategory].units;
    var fromSym = units[fromUnit].symbol;
    var toSym = units[toUnit].symbol;
    var formatted = formatNumber(result);

    document.getElementById('result-display').textContent = formatted + ' ' + toSym;
    document.getElementById('result-formula').textContent =
      inputVal + ' ' + fromSym + ' = ' + formatted + ' ' + toSym;
  }

  function convert() {
    var inputVal = parseFloat(document.getElementById('input-value').value);
    if (isNaN(inputVal)) {
      clearResult();
      return;
    }

    var fromUnit = document.getElementById('from-unit').value;
    var toUnit = document.getElementById('to-unit').value;
    var result;

    if (activeCategory === 'temperature') {
      result = convertTemperature(inputVal, fromUnit, toUnit);
    } else {
      var units = categories[activeCategory].units;
      var valueInBase = inputVal * units[fromUnit].toBase;
      result = valueInBase / units[toUnit].toBase;
    }

    displayResult(result, fromUnit, toUnit, inputVal);
  }

  function swapUnits() {
    var fromSel = document.getElementById('from-unit');
    var toSel = document.getElementById('to-unit');
    var fromVal = fromSel.value;
    var toVal = toSel.value;
    fromSel.value = toVal;
    toSel.value = fromVal;
    convert();
  }

  function copyResult() {
    var result = document.getElementById('result-display').textContent;
    if (result === '--') return;
    navigator.clipboard.writeText(result);
    var label = document.getElementById('copy-btn-label');
    label.textContent = 'Copied!';
    setTimeout(function () {
      label.textContent = 'Copy Result';
    }, 2000);
  }

  categoryRefs.forEach(function (cat) {
    var btn = document.getElementById('tab-' + cat);
    if (btn) {
      btn.addEventListener('click', function () {
        switchCategory(cat);
      });
    }
  });

  document.getElementById('input-value').addEventListener('input', convert);
  document.getElementById('input-value').addEventListener('change', convert);
  document.getElementById('from-unit').addEventListener('change', convert);
  document.getElementById('to-unit').addEventListener('change', convert);
  document.getElementById('swap-btn').addEventListener('click', swapUnits);
  document.getElementById('convert-btn').addEventListener('click', convert);
  document.getElementById('copy-result-btn').addEventListener('click', copyResult);

  switchCategory('length');

});
