(function () {
  "use strict";

  var APPLIANCE_IDS = [
    "ac1ton", "ac15ton", "ac2ton", "fan", "lights", "fridge",
    "pump05hp", "pump1hp", "washer", "geyser", "computer",
    "tv", "iron", "microwave", "custom"
  ];

  function fmt(n) {
    return Math.round(n).toLocaleString("en-PK");
  }

  function fmtDec(n, d) {
    return parseFloat(n.toFixed(d)).toLocaleString("en-PK");
  }

  function getNum(id) {
    var el = document.getElementById(id);
    if (!el) return 0;
    var v = parseFloat(el.value);
    return isNaN(v) ? 0 : v;
  }

  function getActiveTab() {
    var tabUnits = document.getElementById("tab-units");
    return tabUnits.classList.contains("hidden") ? "appliances" : "units";
  }

  function switchTab(tab) {
    var tabUnits = document.getElementById("tab-units");
    var tabAppl = document.getElementById("tab-appliances");
    var btnUnits = document.getElementById("btn-tab-units");
    var btnAppl = document.getElementById("btn-tab-appliances");

    if (tab === "units") {
      tabUnits.classList.remove("hidden");
      tabAppl.classList.add("hidden");
      btnUnits.className = "btn-primary";
      btnAppl.className = "btn-secondary";
      btnUnits.setAttribute("aria-selected", "true");
      btnAppl.setAttribute("aria-selected", "false");
    } else {
      tabUnits.classList.add("hidden");
      tabAppl.classList.remove("hidden");
      btnUnits.className = "btn-secondary";
      btnAppl.className = "btn-primary";
      btnUnits.setAttribute("aria-selected", "false");
      btnAppl.setAttribute("aria-selected", "true");
    }
  }

  function updateEffectiveRate() {
    var units = getNum("monthly-units");
    var bill = getNum("monthly-bill");
    var rateEl = document.getElementById("effective-rate-display");
    var rateInput = document.getElementById("grid-rate");

    if (units > 0 && bill > 0) {
      var rate = bill / units;
      rateEl.innerHTML =
        "Your effective rate: <strong>PKR " + rate.toFixed(2) + " per unit</strong>";
      if (!rateInput.dataset.manuallyEdited) {
        rateInput.value = rate.toFixed(2);
      }
    } else {
      rateEl.textContent = "Enter units and bill to calculate your rate";
    }
  }

  var LITHIUM_CAPACITIES = [
    { value: "2.5",    label: "2.5 kWh (e.g. Pylon, Dyness, Felicity)" },
    { value: "5",      label: "5 kWh (e.g. Pylon US5000, Felicity 5kWh)" },
    { value: "7.5",    label: "7.5 kWh" },
    { value: "10",     label: "10 kWh (e.g. Solis, Huawei LUNA2000)" },
    { value: "15",     label: "15 kWh" },
    { value: "custom", label: "Custom (enter kWh manually)" }
  ];

  var LEADACID_CAPACITIES = [
    { value: "1.44",   label: "1.44 kWh (150Ah / 12V)" },
    { value: "1.92",   label: "1.92 kWh (200Ah / 12V)" },
    { value: "2.4",    label: "2.4 kWh (250Ah / 12V)" },
    { value: "custom", label: "Custom (enter kWh manually)" }
  ];

  var AGM_CAPACITIES = [
    { value: "1.2",    label: "1.2 kWh (100Ah / 12V)" },
    { value: "2.4",    label: "2.4 kWh (200Ah / 12V)" },
    { value: "custom", label: "Custom (enter kWh manually)" }
  ];

  function getBatteryCapacityOptions(type) {
    if (type === "leadacid") return LEADACID_CAPACITIES;
    if (type === "agm") return AGM_CAPACITIES;
    return LITHIUM_CAPACITIES;
  }

  function refreshBatteryCapacitySelect() {
    var typeEl = document.getElementById("battery-type");
    var capEl = document.getElementById("battery-capacity");
    if (!typeEl || !capEl) return;

    var options = getBatteryCapacityOptions(typeEl.value);
    var prevVal = capEl.value;

    capEl.innerHTML = "";
    options.forEach(function (opt) {
      var el = document.createElement("option");
      el.value = opt.value;
      el.textContent = opt.label;
      capEl.appendChild(el);
    });

    // Restore previous selection if still valid
    var stillValid = options.some(function (o) { return o.value === prevVal; });
    if (stillValid) capEl.value = prevVal;

    onBatteryCapacityChange();
  }

  function onBatteryCapacityChange() {
    var capEl = document.getElementById("battery-capacity");
    var customGroup = document.getElementById("battery-custom-group");
    if (!capEl || !customGroup) return;

    if (capEl.value === "custom") {
      customGroup.classList.remove("hidden");
    } else {
      customGroup.classList.add("hidden");
    }

    updateBatteryBankDisplay();
  }

  function getBatteryCapacityKwh() {
    var capEl = document.getElementById("battery-capacity");
    if (!capEl) return 0;
    if (capEl.value === "custom") {
      return getNum("battery-custom-kwh");
    }
    return parseFloat(capEl.value) || 0;
  }

  function updateBatteryBankDisplay() {
    var numBatt = getNum("num-batteries");
    var capKwh = getBatteryCapacityKwh();
    var displayEl = document.getElementById("battery-bank-display");

    if (!displayEl) return;

    if (numBatt > 0 && capKwh > 0) {
      var totalKwh = numBatt * capKwh;
      var backupAvg = totalKwh / 0.5;
      var backupHeavy = totalKwh / 1.5;

      document.getElementById("batt-total-kwh").textContent =
        fmtDec(totalKwh, 1);
      document.getElementById("batt-backup-avg").textContent =
        fmtDec(backupAvg, 1);
      document.getElementById("batt-backup-heavy").textContent =
        fmtDec(backupHeavy, 1);

      displayEl.classList.remove("hidden");
    } else {
      displayEl.classList.add("hidden");
    }
  }

  function updateBatterySection() {
    var checked = document.querySelector("input[name=\"system-type\"]:checked");
    var batterySection = document.getElementById("battery-section");
    if (checked && (checked.value === "hybrid" || checked.value === "offgrid")) {
      batterySection.classList.remove("hidden");
    } else {
      batterySection.classList.add("hidden");
    }
  }

  function selectSystemCard(value) {
    document.querySelectorAll(".system-card").forEach(function (card) {
      card.classList.remove("result-card--accent");
      card.setAttribute("aria-checked", "false");
    });
    var targetCard = document.getElementById("card-" + value);
    if (targetCard) {
      targetCard.classList.add("result-card--accent");
      targetCard.setAttribute("aria-checked", "true");
    }
    var radio = document.getElementById("system-" + value);
    if (radio) radio.checked = true;
    updateBatterySection();
  }

  function updateApplianceDaily(id) {
    var toggle = document.getElementById("toggle-" + id);
    var qty = parseFloat(document.getElementById("qty-" + id).value) || 0;
    var hours = parseFloat(document.getElementById("hours-" + id).value) || 0;
    var watts = parseFloat(document.getElementById("watts-" + id).value) || 0;

    var dailyKwh = toggle && toggle.checked ? (qty * watts * hours) / 1000 : 0;

    var displayEl = document.getElementById("daily-" + id);
    if (displayEl) {
      displayEl.textContent = dailyKwh.toFixed(2) + " kWh/day";
    }

    updateTab2Total();
  }

  function updateTab2Total() {
    var totalWh = 0;
    APPLIANCE_IDS.forEach(function (id) {
      var toggle = document.getElementById("toggle-" + id);
      if (!toggle || !toggle.checked) return;
      var qty = parseFloat(document.getElementById("qty-" + id).value) || 0;
      var hours = parseFloat(document.getElementById("hours-" + id).value) || 0;
      var watts = parseFloat(document.getElementById("watts-" + id).value) || 0;
      totalWh += qty * watts * hours;
    });

    var totalKwh = totalWh / 1000;
    var monthlyKwh = totalKwh * 30;

    document.getElementById("tab2-total-daily").textContent =
      fmtDec(totalKwh, 2) + " kWh";
    document.getElementById("tab2-total-monthly").textContent =
      fmtDec(monthlyKwh, 1) + " kWh";
  }

  function toggleApplianceInputs(id) {
    var toggle = document.getElementById("toggle-" + id);
    var inputs = document.getElementById("inputs-" + id);
    if (inputs) {
      if (toggle && toggle.checked) {
        inputs.classList.add("is-visible");
      } else {
        inputs.classList.remove("is-visible");
      }
    }
    updateApplianceDaily(id);
  }

  function getSystemType() {
    var checked = document.querySelector("input[name=\"system-type\"]:checked");
    return checked ? checked.value : "hybrid";
  }

  function getPanelPricePerWatt() {
    var modeEl = document.querySelector("input[name=\"price-mode\"]:checked");
    var priceInput = parseFloat(document.getElementById("panel-price").value) || 0;
    if (modeEl && modeEl.value === "panel") {
      var panelWatt = getNum("panel-watt");
      return panelWatt > 0 ? priceInput / panelWatt : 0;
    }
    return priceInput;
  }

  function updatePanelPriceLive() {
    var modeEl = document.querySelector("input[name=\"price-mode\"]:checked");
    var priceInput = parseFloat(document.getElementById("panel-price").value) || 0;
    var panelWatt = getNum("panel-watt");
    var liveEl = document.getElementById("panel-price-live");
    var hintEl = document.getElementById("panel-price-hint");

    if (!modeEl || !liveEl || !hintEl) return;

    if (modeEl.value === "panel") {
      hintEl.textContent = "Price for one complete panel";
      if (priceInput > 0 && panelWatt > 0) {
        var perWatt = priceInput / panelWatt;
        liveEl.innerHTML = "= PKR <strong>" + perWatt.toFixed(2) + "</strong> per watt";
        liveEl.classList.remove("hidden");
      } else {
        liveEl.classList.add("hidden");
      }
    } else {
      hintEl.textContent = "Typical range: PKR 28-45 per watt";
      if (priceInput > 0 && panelWatt > 0) {
        var perPanel = Math.round(priceInput * panelWatt);
        liveEl.innerHTML = "= PKR <strong>" + perPanel.toLocaleString("en-PK") + "</strong> per panel";
        liveEl.classList.remove("hidden");
      } else {
        liveEl.classList.add("hidden");
      }
    }
  }

  function onPriceModeChange() {
    var modeEl = document.querySelector("input[name=\"price-mode\"]:checked");
    var priceInput = document.getElementById("panel-price");
    if (!modeEl) return;

    priceInput.value = "";
    if (modeEl.value === "panel") {
      priceInput.placeholder = "e.g. 19000";
    } else {
      priceInput.placeholder = "e.g. 32";
    }
    document.getElementById("panel-price-live").classList.add("hidden");
  }

  function calculate() {
    var activeTab = getActiveTab();
    var cityMultiplier = parseFloat(document.getElementById("city-select").value) || 1.0;

    var panelWatt = getNum("panel-watt");
    var panelPricePerWatt = getPanelPricePerWatt();
    var inverterCost = getNum("inverter-cost");
    var installationCost = getNum("installation-cost");
    var gridUnitRate = getNum("grid-rate");

    if (panelWatt <= 0) {
      alert("Please enter panel wattage to calculate.");
      return;
    }
    if (panelPricePerWatt <= 0) {
      alert("Please enter the panel price to calculate.");
      return;
    }
    if (gridUnitRate <= 0) {
      alert("Please enter your grid electricity rate (PKR/unit) to calculate savings.");
      return;
    }

    var monthlyUnits;
    var systemKW;

    if (activeTab === "units") {
      monthlyUnits = getNum("monthly-units");
      if (monthlyUnits < 50) {
        alert("Please enter your average monthly units consumed (minimum 50 kWh).");
        return;
      }
      var effectiveUnits = monthlyUnits / cityMultiplier;
      systemKW = effectiveUnits / 125;
      systemKW = Math.ceil(systemKW * 2) / 2;
    } else {
      var totalDailyWh = 0;
      APPLIANCE_IDS.forEach(function (id) {
        var toggle = document.getElementById("toggle-" + id);
        if (!toggle || !toggle.checked) return;
        var qty = parseFloat(document.getElementById("qty-" + id).value) || 0;
        var hours = parseFloat(document.getElementById("hours-" + id).value) || 0;
        var watts = parseFloat(document.getElementById("watts-" + id).value) || 0;
        totalDailyWh += qty * watts * hours;
      });

      var monthlyKwh = (totalDailyWh * 30) / 1000;
      monthlyUnits = monthlyKwh;

      if (monthlyUnits <= 0) {
        alert("Please enable and configure at least one appliance.");
        return;
      }

      systemKW = Math.ceil((monthlyKwh / 30 / 5) * 2) / 2;
    }

    var numberOfPanels = Math.ceil((systemKW * 1000) / panelWatt);
    var actualSystemKW = (numberOfPanels * panelWatt) / 1000;
    var monthlyGeneration = actualSystemKW * 125 * cityMultiplier;

    var systemType = getSystemType();
    var numberOfBatteries = 0;
    var batteryCostEach = 0;
    var batteryCapacityKwh = 0;

    if (systemType !== "ongrid") {
      numberOfBatteries = getNum("num-batteries");
      batteryCostEach = getNum("battery-cost-each");
      batteryCapacityKwh = getBatteryCapacityKwh();
    }

    var panelsCost = numberOfPanels * panelWatt * panelPricePerWatt;
    var mountingCost = getNum("mounting-cost");
    var miscCost = getNum("misc-cost");
    var batteriesCost = numberOfBatteries * batteryCostEach;
    var totalCost =
      panelsCost + inverterCost + installationCost + mountingCost + miscCost + batteriesCost;

    var monthlySavings = monthlyGeneration * gridUnitRate;
    var annualSavings = monthlySavings * 12;
    var paybackMonths = totalCost / monthlySavings;
    var paybackYears = Math.floor(paybackMonths / 12);
    var paybackMonthsRem = Math.round(paybackMonths % 12);

    var annualGenBase = monthlyGeneration * 12;
    var tenYearSavings = 0;
    var twentyFiveYearSavings = 0;

    for (var year = 1; year <= 25; year++) {
      var degradedGen = annualGenBase * Math.pow(0.995, year - 1);
      var yearSavings = degradedGen * gridUnitRate;
      if (year <= 10) tenYearSavings += yearSavings;
      twentyFiveYearSavings += yearSavings;
    }

    var tenYearProfit = tenYearSavings - totalCost;
    var twentyFiveYearProfit = twentyFiveYearSavings - totalCost;
    var annualCO2Offset = monthlyGeneration * 12 * 0.5;

    var monthlyBill = getNum("monthly-bill");
    var currentBill = monthlyBill > 0 ? monthlyBill : monthlyUnits * gridUnitRate;
    var billAfterSolar = Math.max(0, (monthlyUnits - monthlyGeneration) * gridUnitRate);

    var cityPct = ((cityMultiplier - 1) * 100);
    var cityFactorStr =
      "City solar factor applied: " +
      (cityPct >= 0 ? "+" : "") +
      cityPct.toFixed(0) + "% (multiplier: " + cityMultiplier + "x)";

    displayResults({
      systemKW: actualSystemKW,
      numberOfPanels: numberOfPanels,
      panelWatt: panelWatt,
      monthlyGeneration: monthlyGeneration,
      cityFactorStr: cityFactorStr,
      panelsCost: panelsCost,
      mountingCost: mountingCost,
      miscCost: miscCost,
      inverterCost: inverterCost,
      installationCost: installationCost,
      batteriesCost: batteriesCost,
      numberOfBatteries: numberOfBatteries,
      batteryCostEach: batteryCostEach,
      batteryCapacityKwh: batteryCapacityKwh,
      totalCost: totalCost,
      monthlySavings: monthlySavings,
      annualSavings: annualSavings,
      paybackYears: paybackYears,
      paybackMonthsRem: paybackMonthsRem,
      tenYearProfit: tenYearProfit,
      twentyFiveYearProfit: twentyFiveYearProfit,
      annualCO2Offset: annualCO2Offset,
      currentBill: currentBill,
      billAfterSolar: billAfterSolar,
      monthlyUnits: monthlyUnits,
      gridUnitRate: gridUnitRate,
      panelPricePerWatt: panelPricePerWatt
    });
  }

  function displayResults(d) {
    var section = document.getElementById("results-section");
    section.classList.remove("hidden");

    // System recommendation
    document.getElementById("res-system-kw").textContent =
      fmtDec(d.systemKW, 1) + " kW";
    document.getElementById("res-num-panels").textContent =
      d.numberOfPanels + " panels";
    document.getElementById("res-panel-size").textContent =
      d.panelWatt + "W each";
    document.getElementById("res-monthly-gen").textContent =
      fmtDec(d.monthlyGeneration, 0) + " units estimated";
    document.getElementById("res-city-factor").textContent = d.cityFactorStr;

    // Cost breakdown
    document.getElementById("cost-panels").textContent =
      "PKR " + fmt(d.panelsCost);
    document.getElementById("cost-panels-desc").textContent =
      d.numberOfPanels + " panels x " + d.panelWatt + "W x PKR " +
      d.panelPricePerWatt.toFixed(2) + "/W";
    document.getElementById("cost-inverter").textContent =
      d.inverterCost > 0 ? "PKR " + fmt(d.inverterCost) : "Not entered";
    document.getElementById("cost-installation").textContent =
      d.installationCost > 0 ? "PKR " + fmt(d.installationCost) : "Not entered";
    var mountingRow = document.getElementById("cost-mounting-row");
    if (d.mountingCost > 0) {
      mountingRow.classList.remove("hidden");
      document.getElementById("cost-mounting").textContent =
        "PKR " + fmt(d.mountingCost);
    } else {
      mountingRow.classList.add("hidden");
    }

    var miscRow = document.getElementById("cost-misc-row");
    if (d.miscCost > 0) {
      miscRow.classList.remove("hidden");
      document.getElementById("cost-misc").textContent =
        "PKR " + fmt(d.miscCost);
    } else {
      miscRow.classList.add("hidden");
    }

    var battRow = document.getElementById("cost-battery-row");
    var resBattCard = document.getElementById("res-battery-card");

    if (d.numberOfBatteries > 0 && d.batteryCostEach > 0) {
      battRow.classList.remove("hidden");
      document.getElementById("cost-batteries").textContent =
        "PKR " + fmt(d.batteriesCost);
      var capLabel = d.batteryCapacityKwh > 0
        ? d.numberOfBatteries + " x " + fmtDec(d.batteryCapacityKwh, 1) + " kWh x PKR " + fmt(d.batteryCostEach) + " each"
        : d.numberOfBatteries + " x PKR " + fmt(d.batteryCostEach) + " each";
      document.getElementById("cost-batteries-desc").textContent = capLabel;
    } else {
      battRow.classList.add("hidden");
    }

    if (d.numberOfBatteries > 0 && d.batteryCapacityKwh > 0) {
      var totalBankKwh = d.numberOfBatteries * d.batteryCapacityKwh;
      resBattCard.classList.remove("hidden");
      document.getElementById("res-battery-bank").textContent =
        fmtDec(totalBankKwh, 1) + " kWh total (" +
        d.numberOfBatteries + " batteries x " +
        fmtDec(d.batteryCapacityKwh, 1) + " kWh each)";
    } else {
      resBattCard.classList.add("hidden");
    }

    document.getElementById("cost-total").textContent =
      "PKR " + fmt(d.totalCost);

    // Savings
    document.getElementById("res-monthly-savings").textContent =
      "PKR " + fmt(d.monthlySavings);
    document.getElementById("res-monthly-savings-sub").textContent =
      fmtDec(d.monthlyGeneration, 0) + " units x PKR " +
      d.gridUnitRate.toFixed(2) + "/unit";
    document.getElementById("res-annual-savings").textContent =
      "PKR " + fmt(d.annualSavings);
    document.getElementById("res-payback").textContent =
      d.paybackYears + " Years " + d.paybackMonthsRem + " Months";
    document.getElementById("res-10yr").textContent =
      (d.tenYearProfit >= 0 ? "" : "-") + "PKR " + fmt(Math.abs(d.tenYearProfit));
    document.getElementById("res-25yr").textContent =
      (d.twentyFiveYearProfit >= 0 ? "" : "-") + "PKR " + fmt(Math.abs(d.twentyFiveYearProfit));

    // What you gain
    document.getElementById("res-current-bill").textContent =
      "PKR " + fmt(d.currentBill);
    document.getElementById("res-bill-after").textContent =
      "PKR " + fmt(d.billAfterSolar);
    document.getElementById("res-co2").textContent =
      fmt(d.annualCO2Offset) + " kg";
    document.getElementById("res-system-kw2").textContent =
      fmtDec(d.systemKW, 1);

    // Print date
    var now = new Date();
    var dateStr = now.toLocaleDateString("en-GB", {
      day: "2-digit",
      month: "long",
      year: "numeric"
    });
    var printDateEl = document.getElementById("print-date-el");
    if (printDateEl) {
      printDateEl.textContent = "Generated: " + dateStr + " | YourSimpleTools.com";
    }

    section.scrollIntoView({ behavior: "smooth", block: "start" });
  }

  function initSystemCards() {
    document.querySelectorAll(".system-card").forEach(function (card) {
      card.addEventListener("click", function () {
        var radio = card.querySelector("input[type=\"radio\"]");
        if (radio) {
          selectSystemCard(radio.value);
        }
      });

      card.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === " ") {
          e.preventDefault();
          card.click();
        }
      });
    });
  }

  function initAppliances() {
    APPLIANCE_IDS.forEach(function (id) {
      var toggle = document.getElementById("toggle-" + id);
      if (toggle) {
        toggle.addEventListener("change", function () {
          toggleApplianceInputs(id);
        });
        // Initialize display for pre-checked appliances
        if (toggle.checked) {
          updateApplianceDaily(id);
        }
      }

      ["qty-", "hours-", "watts-"].forEach(function (prefix) {
        var input = document.getElementById(prefix + id);
        if (input) {
          input.addEventListener("input", function () {
            updateApplianceDaily(id);
          });
        }
      });
    });

    // Initial total update
    updateTab2Total();
  }

  function initFaq() {
    document.querySelectorAll(".faq-question").forEach(function (btn) {
      btn.addEventListener("click", function () {
        var item = btn.closest(".faq-item");
        var isOpen = item.classList.contains("is-open");
        item.classList.toggle("is-open");
        btn.setAttribute("aria-expanded", isOpen ? "false" : "true");
      });
    });
  }

  function init() {
    // Tab buttons
    document.getElementById("btn-tab-units").addEventListener("click", function () {
      switchTab("units");
    });
    document.getElementById("btn-tab-appliances").addEventListener("click", function () {
      switchTab("appliances");
    });

    // Effective rate auto-calculation
    document.getElementById("monthly-units").addEventListener("input", updateEffectiveRate);
    document.getElementById("monthly-bill").addEventListener("input", updateEffectiveRate);

    // Mark grid-rate as manually edited when user types in it
    document.getElementById("grid-rate").addEventListener("input", function () {
      this.dataset.manuallyEdited = "1";
    });

    // Battery type and capacity selectors
    document.getElementById("battery-type").addEventListener("change", refreshBatteryCapacitySelect);
    document.getElementById("battery-capacity").addEventListener("change", onBatteryCapacityChange);
    document.getElementById("battery-custom-kwh").addEventListener("input", updateBatteryBankDisplay);
    document.getElementById("num-batteries").addEventListener("input", updateBatteryBankDisplay);

    // Panel price mode toggle
    document.querySelectorAll("input[name=\"price-mode\"]").forEach(function (radio) {
      radio.addEventListener("change", onPriceModeChange);
    });

    // Live panel price converter
    document.getElementById("panel-price").addEventListener("input", updatePanelPriceLive);
    document.getElementById("panel-watt").addEventListener("input", updatePanelPriceLive);

    // System type radio changes via labels/inputs
    document.querySelectorAll("input[name=\"system-type\"]").forEach(function (radio) {
      radio.addEventListener("change", function () {
        selectSystemCard(radio.value);
      });
    });

    // System cards
    initSystemCards();

    // Set hybrid as default selected visually
    selectSystemCard("hybrid");

    // Appliances
    initAppliances();

    // FAQ
    initFaq();

    // Calculate button
    document.getElementById("calc-btn-1").addEventListener("click", calculate);

    // Print button (added after results appear)
    document.getElementById("print-btn").addEventListener("click", function () {
      window.print();
    });

    // Mobile nav toggle (same pattern as main.js)
    var mobileToggle = document.querySelector(".nav-mobile-toggle");
    var navLinks = document.querySelector(".nav-links");
    if (mobileToggle && navLinks) {
      mobileToggle.addEventListener("click", function () {
        var expanded = mobileToggle.getAttribute("aria-expanded") === "true";
        mobileToggle.setAttribute("aria-expanded", String(!expanded));
        navLinks.classList.toggle("is-open");
      });
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
