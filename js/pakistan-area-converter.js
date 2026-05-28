document.addEventListener('DOMContentLoaded', function() {
  (function () {
    // Conversion constants
    var STD = {
      punjab: {
        marla: 272.25,
        sarsai: 30.25,
        kanal: 272.25 * 20,
        acre: 43560,
        murabba: 43560 * 25,
        sqyd: 9,
        sqmeter: 10.7639
      },
      lahore: {
        marla: 225,
        sarsai: 30.25,
        kanal: 225 * 20,
        acre: 43560,
        murabba: 43560 * 25,
        sqyd: 9,
        sqmeter: 10.7639
      },
      karachi: {
        sqyd: 9,
        acre: 4840,
        sqmeter_per_sqyd: 10.7639 / 9
      }
    };

    var currentStandard = "punjab";

    function formatNum(n) {
      if (!isFinite(n) || isNaN(n)) return "--";
      if (n === 0) return "0";
      if (n < 1) return n.toFixed(4);
      if (n < 1000) return n.toFixed(2);
      return n.toLocaleString("en", { maximumFractionDigits: 2 });
    }

    function toBaseSqft(value, unit, std) {
      var s = STD[std];
      switch (unit) {
        case "marla": return value * s.marla;
        case "kanal": return value * s.kanal;
        case "acre": return value * s.acre;
        case "murabba": return value * s.murabba;
        case "sqft": return value;
        case "sqyd": return value * s.sqyd;
        case "sqmeter": return value * s.sqmeter;
        default: return 0;
      }
    }

    function fromBaseSqft(base, unit, std) {
      var s = STD[std];
      switch (unit) {
        case "marla": return base / s.marla;
        case "kanal": return base / s.kanal;
        case "acre": return base / s.acre;
        case "murabba": return base / s.murabba;
        case "sqft": return base;
        case "sqyd": return base / s.sqyd;
        case "sqmeter": return base / s.sqmeter;
        case "sarsai": return base / s.sarsai;
        default: return 0;
      }
    }

    function toBaseSqyd(value, unit) {
      var s = STD.karachi;
      switch (unit) {
        case "sqyd": return value;
        case "sqft": return value / s.sqyd;
        case "sqmeter": return value * s.sqmeter_per_sqyd;
        case "acre": return value * s.acre;
        default: return 0;
      }
    }

    function fromBaseSqyd(base, unit) {
      var s = STD.karachi;
      switch (unit) {
        case "sqyd": return base;
        case "sqft": return base * s.sqyd;
        case "sqmeter": return base / s.sqmeter_per_sqyd;
        case "acre": return base / s.acre;
        default: return 0;
      }
    }

    function updateUnitOptions() {
      var select = document.getElementById("from-unit");
      var prevVal = select.value;
      select.innerHTML = "";
      var options;

      if (currentStandard === "karachi") {
        options = [
          { value: "sqyd", label: "Square Yards (Gaz)" },
          { value: "sqft", label: "Square Feet" },
          { value: "sqmeter", label: "Square Meters" },
          { value: "acre", label: "Acre" }
        ];
      } else {
        var ms = currentStandard === "punjab" ? "272.25" : "225";
        options = [
          { value: "marla", label: "Marla (" + ms + " sq ft)" },
          { value: "kanal", label: "Kanal (20 Marla)" },
          { value: "acre", label: "Acre / Killa (8 Kanal)" },
          { value: "murabba", label: "Murabba (25 Acres)" },
          { value: "sqft", label: "Square Feet" },
          { value: "sqyd", label: "Square Yards (Gaz)" },
          { value: "sqmeter", label: "Square Meters" }
        ];
      }

      options.forEach(function (opt) {
        var el = document.createElement("option");
        el.value = opt.value;
        el.textContent = opt.label;
        select.appendChild(el);
      });

      // Restore selection if the unit still exists in the new list
      var validVals = options.map(function (o) { return o.value; });
      if (validVals.indexOf(prevVal) !== -1) {
        select.value = prevVal;
      }
    }

    function updateResults() {
      var inputEl = document.getElementById("area-input");
      var value = parseFloat(inputEl.value);
      var unit = document.getElementById("from-unit").value;

      var resultsPunjab = document.getElementById("results-punjab");
      var resultsKarachi = document.getElementById("results-karachi");

      if (!inputEl.value || isNaN(value) || value < 0) {
        resultsPunjab.classList.add("hidden");
        resultsKarachi.classList.add("hidden");
        return;
      }

      if (currentStandard === "karachi") {
        resultsPunjab.classList.add("hidden");
        resultsKarachi.classList.remove("hidden");

        var baseKhi = toBaseSqyd(value, unit);
        document.getElementById("res-sqyd-khi").textContent = formatNum(fromBaseSqyd(baseKhi, "sqyd"));
        document.getElementById("res-sqft-khi").textContent = formatNum(fromBaseSqyd(baseKhi, "sqft"));
        document.getElementById("res-sqm-khi").textContent = formatNum(fromBaseSqyd(baseKhi, "sqmeter"));
        document.getElementById("res-acre-khi").textContent = formatNum(fromBaseSqyd(baseKhi, "acre"));
      } else {
        resultsKarachi.classList.add("hidden");
        resultsPunjab.classList.remove("hidden");

        var basePk = toBaseSqft(value, unit, currentStandard);
        document.getElementById("res-marla").textContent = formatNum(fromBaseSqft(basePk, "marla", currentStandard));
        document.getElementById("res-kanal").textContent = formatNum(fromBaseSqft(basePk, "kanal", currentStandard));
        document.getElementById("res-acre-pk").textContent = formatNum(fromBaseSqft(basePk, "acre", currentStandard));
        document.getElementById("res-murabba").textContent = formatNum(fromBaseSqft(basePk, "murabba", currentStandard));
        document.getElementById("res-sqft-pk").textContent = formatNum(fromBaseSqft(basePk, "sqft", currentStandard));
        document.getElementById("res-sqyd-pk").textContent = formatNum(fromBaseSqft(basePk, "sqyd", currentStandard));
        document.getElementById("res-sqm-pk").textContent = formatNum(fromBaseSqft(basePk, "sqmeter", currentStandard));
        document.getElementById("res-sarsai").textContent = formatNum(fromBaseSqft(basePk, "sarsai", currentStandard));
      }
    }

    function updateRefTable(std) {
      ["punjab", "lahore", "karachi"].forEach(function (key) {
        var el = document.getElementById("ref-table-" + key);
        if (el) el.classList.add("hidden");
      });
      var target = std === "lahore" ? "lahore" : std === "karachi" ? "karachi" : "punjab";
      var targetEl = document.getElementById("ref-table-" + target);
      if (targetEl) targetEl.classList.remove("hidden");
    }

    function changeStandard(std) {
      currentStandard = std;

      // Update card selected state
      ["punjab", "lahore", "karachi"].forEach(function (s) {
        var card = document.getElementById("card-" + s);
        if (s === std) {
          card.classList.add("result-card--accent");
        } else {
          card.classList.remove("result-card--accent");
        }
      });

      // Update marla note text
      var marlaNote = document.getElementById("marla-note");
      if (marlaNote) {
        marlaNote.textContent = std === "lahore" ? "225 sq ft per Marla" : "272.25 sq ft per Marla";
      }

      updateUnitOptions();
      updateRefTable(std);
      updateResults();
    }

    function copyValue(btn, value) {
      if (!navigator.clipboard) {
        return;
      }
      navigator.clipboard.writeText(value).then(function () {
        var origHTML = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="check" aria-hidden="true"></i>';
        lucide.createIcons();
        setTimeout(function () {
          btn.innerHTML = origHTML;
          lucide.createIcons();
        }, 1500);
      });
    }

    function init() {
      // Standard card clicks
      ["punjab", "lahore", "karachi"].forEach(function (std) {
        document.getElementById("card-" + std).addEventListener("click", function () {
          document.getElementById("std-" + std).checked = true;
          changeStandard(std);
        });
      });

      // Live conversion on input
      document.getElementById("area-input").addEventListener("input", updateResults);
      document.getElementById("from-unit").addEventListener("change", updateResults);

      // Convert button
      document.getElementById("convert-btn").addEventListener("click", updateResults);

      // Copy buttons
      document.querySelectorAll(".copy-result-btn").forEach(function (btn) {
        btn.addEventListener("click", function () {
          var targetId = btn.getAttribute("data-target");
          var valEl = document.getElementById(targetId);
          if (valEl) copyValue(btn, valEl.textContent);
        });
      });

      // Initialize unit options and reference table
      updateUnitOptions();
      updateRefTable("punjab");
    }

    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", init);
    } else {
      init();
    }
  })();

});
