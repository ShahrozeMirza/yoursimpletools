document.addEventListener('DOMContentLoaded', function () {

  var itemCount = 1;

  var currencies = {
    USD: '$',
    GBP: '£',
    EUR: '€',
    PKR: 'Rs ',
    AED: 'AED ',
    SAR: 'SAR ',
    CAD: 'CA$',
    AUD: 'A$'
  };

  function getCurrencySymbol() {
    var sel = document.getElementById('currency');
    return currencies[sel ? sel.value : 'USD'] || '$';
  }

  function formatNumber(n) {
    return n.toLocaleString('en-US', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
  }

  function formatCurrency(n) {
    return getCurrencySymbol() + formatNumber(n);
  }

  function setText(id, text) {
    var el = document.getElementById(id);
    if (el) el.textContent = text;
  }

  function formatDate(d) {
    var yyyy = d.getFullYear();
    var mm = String(d.getMonth() + 1).padStart(2, '0');
    var dd = String(d.getDate()).padStart(2, '0');
    return yyyy + '-' + mm + '-' + dd;
  }

  function displayDate(value) {
    if (!value) return '';
    var parts = value.split('-');
    if (parts.length !== 3) return value;
    var d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
    return d.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
  }

  function getNextInvoiceNumber() {
    var counter = parseInt(localStorage.getItem('yst_invoice_counter'), 10);
    if (!counter || counter < 1) counter = 1;
    return counter;
  }

  function setInvoiceNumberFromCounter() {
    var counter = getNextInvoiceNumber();
    var el = document.getElementById('invoice-number');
    if (el) el.value = 'INV-' + String(counter).padStart(3, '0');
  }

  function updateItemTotal(n) {
    var qtyEl = document.getElementById('item-qty-' + n);
    var priceEl = document.getElementById('item-price-' + n);
    var qty = parseFloat(qtyEl ? qtyEl.value : 0) || 0;
    var price = parseFloat(priceEl ? priceEl.value : 0) || 0;
    var total = qty * price;
    var cell = document.getElementById('item-total-' + n);
    if (cell) {
      cell.setAttribute('data-value', total);
      cell.textContent = formatCurrency(total);
    }
    updateTotals();
  }

  function updateTotals() {
    var subtotal = 0;
    var totalCells = document.querySelectorAll('.item-total-cell');
    totalCells.forEach(function (cell) {
      subtotal += parseFloat(cell.getAttribute('data-value')) || 0;
    });

    var taxRateEl = document.getElementById('tax-rate');
    var discountEl = document.getElementById('discount-amount');
    var taxRate = parseFloat(taxRateEl ? taxRateEl.value : 0) || 0;
    var discount = parseFloat(discountEl ? discountEl.value : 0) || 0;

    var taxAmount = subtotal * (taxRate / 100);
    var total = subtotal + taxAmount - discount;

    var sym = getCurrencySymbol();
    setText('invoice-subtotal', sym + formatNumber(subtotal));
    setText('invoice-tax', sym + formatNumber(taxAmount));
    setText('invoice-total', sym + formatNumber(total));
  }

  function refreshItemCurrencyDisplays() {
    var totalCells = document.querySelectorAll('.item-total-cell');
    totalCells.forEach(function (cell) {
      var value = parseFloat(cell.getAttribute('data-value')) || 0;
      cell.textContent = formatCurrency(value);
    });
  }

  function updateRemoveButtons() {
    var rows = document.querySelectorAll('#invoice-items-body tr');
    rows.forEach(function (row) {
      var cell = row.querySelector('.invoice-remove-item-cell');
      if (rows.length > 1) {
        if (!cell) {
          var n = row.getAttribute('data-row');
          var td = row.children[row.children.length - 1];
          td.classList.add('invoice-remove-item-cell');
          td.innerHTML = '<button type="button" class="invoice-remove-item" data-remove="' + n + '" aria-label="Remove item"><i data-lucide="trash-2" aria-hidden="true"></i></button>';
          if (window.lucide) lucide.createIcons();
          td.querySelector('.invoice-remove-item').addEventListener('click', function () {
            removeItem(n);
          });
        }
      } else if (cell) {
        cell.innerHTML = '';
        cell.classList.remove('invoice-remove-item-cell');
      }
    });
  }

  function addItem() {
    itemCount++;
    var n = itemCount;
    var tbody = document.getElementById('invoice-items-body');
    var row = document.createElement('tr');
    row.id = 'item-row-' + n;
    row.setAttribute('data-row', n);
    row.innerHTML =
      '<td><input type="text" id="item-desc-' + n + '" class="form-input" placeholder="Service or product description" /></td>' +
      '<td><input type="number" id="item-qty-' + n + '" class="form-input" min="1" step="any" value="1" /></td>' +
      '<td><input type="number" id="item-price-' + n + '" class="form-input" min="0" step="0.01" placeholder="0.00" /></td>' +
      '<td class="item-total-cell" id="item-total-' + n + '">0.00</td>' +
      '<td></td>';
    tbody.appendChild(row);

    document.getElementById('item-qty-' + n).addEventListener('input', function () { updateItemTotal(n); });
    document.getElementById('item-price-' + n).addEventListener('input', function () { updateItemTotal(n); });

    updateRemoveButtons();
    updateItemTotal(n);
  }

  function removeItem(n) {
    var row = document.getElementById('item-row-' + n);
    if (row) row.remove();
    updateRemoveButtons();
    updateTotals();
  }

  function buildInvoiceHtml() {
    var currency = document.getElementById('currency').value;
    var status = document.getElementById('invoice-status').value;
    var invoiceNumber = document.getElementById('invoice-number').value || 'INV-001';
    var invoiceDate = displayDate(document.getElementById('invoice-date').value);
    var dueDate = displayDate(document.getElementById('due-date').value);
    var paymentTerms = document.getElementById('payment-terms').value;

    var fromName = document.getElementById('from-name').value;
    var fromEmail = document.getElementById('from-email').value;
    var fromPhone = document.getElementById('from-phone').value;
    var fromAddress = document.getElementById('from-address').value;
    var fromWebsite = document.getElementById('from-website').value;

    var toName = document.getElementById('to-name').value;
    var toEmail = document.getElementById('to-email').value;
    var toPhone = document.getElementById('to-phone').value;
    var toAddress = document.getElementById('to-address').value;

    var notes = document.getElementById('invoice-notes').value;
    var terms = document.getElementById('invoice-terms').value;

    var sym = currencies[currency] || '$';

    var rows = document.querySelectorAll('#invoice-items-body tr');
    var itemsHtml = '';
    rows.forEach(function (row) {
      var n = row.getAttribute('data-row');
      var desc = document.getElementById('item-desc-' + n).value || 'Item';
      var qty = parseFloat(document.getElementById('item-qty-' + n).value) || 0;
      var price = parseFloat(document.getElementById('item-price-' + n).value) || 0;
      var total = qty * price;
      itemsHtml +=
        '<tr>' +
        '<td>' + escapeHtml(desc) + '</td>' +
        '<td>' + qty + '</td>' +
        '<td>' + sym + formatNumber(price) + '</td>' +
        '<td>' + sym + formatNumber(total) + '</td>' +
        '</tr>';
    });

    var subtotalText = document.getElementById('invoice-subtotal').textContent;
    var taxText = document.getElementById('invoice-tax').textContent;
    var totalText = document.getElementById('invoice-total').textContent;
    var discount = parseFloat(document.getElementById('discount-amount').value) || 0;
    var taxRate = parseFloat(document.getElementById('tax-rate').value) || 0;

    var html =
      '<div class="invoice-print-header">' +
      '<div>' +
      '<p class="invoice-print-title">INVOICE</p>' +
      '<p>' + escapeHtml(invoiceNumber) + '</p>' +
      '<span class="invoice-status-badge">' + escapeHtml(status) + '</span>' +
      '</div>' +
      '</div>' +
      '<div class="invoice-print-parties">' +
      '<div><h3>From</h3>' +
      '<p>' + escapeHtml(fromName) + '</p>' +
      (fromAddress ? '<p>' + escapeHtml(fromAddress) + '</p>' : '') +
      (fromEmail ? '<p>' + escapeHtml(fromEmail) + '</p>' : '') +
      (fromPhone ? '<p>' + escapeHtml(fromPhone) + '</p>' : '') +
      (fromWebsite ? '<p>' + escapeHtml(fromWebsite) + '</p>' : '') +
      '</div>' +
      '<div><h3>Bill To</h3>' +
      '<p>' + escapeHtml(toName) + '</p>' +
      (toAddress ? '<p>' + escapeHtml(toAddress) + '</p>' : '') +
      (toEmail ? '<p>' + escapeHtml(toEmail) + '</p>' : '') +
      (toPhone ? '<p>' + escapeHtml(toPhone) + '</p>' : '') +
      '</div>' +
      '</div>' +
      '<div class="invoice-print-details">' +
      '<div><p>Invoice Date</p><p>' + escapeHtml(invoiceDate) + '</p></div>' +
      '<div><p>Due Date</p><p>' + escapeHtml(dueDate) + '</p></div>' +
      '<div><p>Payment Terms</p><p>' + escapeHtml(paymentTerms) + '</p></div>' +
      '</div>' +
      '<table class="invoice-print-table">' +
      '<thead><tr><th>Description</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead>' +
      '<tbody>' + itemsHtml + '</tbody>' +
      '</table>' +
      '<div class="invoice-print-totals">' +
      '<div class="invoice-print-totals-row"><span>Subtotal</span><span>' + subtotalText + '</span></div>' +
      '<div class="invoice-print-totals-row"><span>Tax (' + taxRate + '%)</span><span>' + taxText + '</span></div>' +
      '<div class="invoice-print-totals-row"><span>Discount</span><span>' + sym + formatNumber(discount) + '</span></div>' +
      '<div class="invoice-print-totals-row invoice-print-totals-row--total"><span>Total Due</span><span>' + totalText + '</span></div>' +
      '</div>' +
      (notes ? '<div class="invoice-print-notes"><h3>Notes</h3><p>' + escapeHtml(notes) + '</p></div>' : '') +
      (terms ? '<div class="invoice-print-notes"><h3>Terms and Conditions</h3><p>' + escapeHtml(terms) + '</p></div>' : '');

    return html;
  }

  function escapeHtml(text) {
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  function previewInvoice() {
    var area = document.getElementById('invoice-print-area');
    area.innerHTML = buildInvoiceHtml();
    document.getElementById('invoice-modal').classList.add('is-open');
  }

  function closeModal() {
    document.getElementById('invoice-modal').classList.remove('is-open');
  }

  function clearForm() {
    document.getElementById('from-name').value = '';
    document.getElementById('from-email').value = '';
    document.getElementById('from-phone').value = '';
    document.getElementById('from-address').value = '';
    document.getElementById('from-website').value = '';
    document.getElementById('to-name').value = '';
    document.getElementById('to-email').value = '';
    document.getElementById('to-phone').value = '';
    document.getElementById('to-address').value = '';
    document.getElementById('invoice-notes').value = '';
    document.getElementById('invoice-terms').value = '';
    document.getElementById('tax-rate').value = 0;
    document.getElementById('discount-amount').value = 0;
    document.getElementById('currency').value = 'USD';
    document.getElementById('payment-terms').value = 'Due on Receipt';
    document.getElementById('invoice-status').value = 'Draft';

    var tbody = document.getElementById('invoice-items-body');
    tbody.innerHTML =
      '<tr id="item-row-1" data-row="1">' +
      '<td><input type="text" id="item-desc-1" class="form-input" placeholder="Service or product description" /></td>' +
      '<td><input type="number" id="item-qty-1" class="form-input" min="1" step="any" value="1" /></td>' +
      '<td><input type="number" id="item-price-1" class="form-input" min="0" step="0.01" placeholder="0.00" /></td>' +
      '<td class="item-total-cell" id="item-total-1">0.00</td>' +
      '<td></td>' +
      '</tr>';
    itemCount = 1;
    document.getElementById('item-qty-1').addEventListener('input', function () { updateItemTotal(1); });
    document.getElementById('item-price-1').addEventListener('input', function () { updateItemTotal(1); });
    updateItemTotal(1);

    var counter = getNextInvoiceNumber();
    localStorage.setItem('yst_invoice_counter', String(counter + 1));
    setInvoiceNumberFromCounter();

    var today = new Date();
    var due = new Date();
    due.setDate(due.getDate() + 30);
    document.getElementById('invoice-date').value = formatDate(today);
    document.getElementById('due-date').value = formatDate(due);

    updateTotals();
  }

  function init() {
    setInvoiceNumberFromCounter();

    var today = new Date();
    var due = new Date();
    due.setDate(due.getDate() + 30);
    document.getElementById('invoice-date').value = formatDate(today);
    document.getElementById('due-date').value = formatDate(due);

    updateRemoveButtons();

    document.getElementById('item-qty-1').addEventListener('input', function () { updateItemTotal(1); });
    document.getElementById('item-price-1').addEventListener('input', function () { updateItemTotal(1); });
    updateItemTotal(1);

    document.getElementById('btn-add-item').addEventListener('click', addItem);
    document.getElementById('btn-preview').addEventListener('click', previewInvoice);
    document.getElementById('btn-download-pdf').addEventListener('click', function () { window.print(); });
    document.getElementById('btn-modal-download').addEventListener('click', function () { window.print(); });
    document.getElementById('btn-modal-close').addEventListener('click', closeModal);
    document.getElementById('btn-clear-form').addEventListener('click', clearForm);

    document.getElementById('currency').addEventListener('change', function () {
      refreshItemCurrencyDisplays();
      updateTotals();
    });
    document.getElementById('tax-rate').addEventListener('input', updateTotals);
    document.getElementById('discount-amount').addEventListener('input', updateTotals);
  }

  init();

});
