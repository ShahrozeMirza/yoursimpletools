<?php $pageJS = '/js/invoice-generator.js'; ?>
<?php include '../includes/head.php'; ?>
<title>Invoice Generator - Free Online Invoice Maker | YourSimpleTools</title>
<meta name="description" content="Create professional invoices instantly. Add your business details, client info, line items and download as PDF. Free online invoice generator - no signup required." />
<meta name="keywords" content="invoice generator, free invoice maker, online invoice, invoice template, pdf invoice generator" />
<?php include '../includes/nav.php'; ?>

<main>
  <div class="tool-page">
    <div class="container">

      <nav class="tool-breadcrumb" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <span aria-hidden="true"> &rsaquo; </span>
        <a href="/tools">Tools</a>
        <span aria-hidden="true"> &rsaquo; </span>
        <span>Invoice Generator</span>
      </nav>

      <div class="tool-page-header">
        <h1 class="tool-page-title">Invoice Generator</h1>
        <p class="tool-page-desc">Create professional invoices instantly and download as PDF. Free and no signup required.</p>
      </div>

      <div class="tool-container">

        <div class="invoice-info-box">
          <i data-lucide="info" aria-hidden="true"></i>
          <p>Your invoice data stays in your browser. Nothing is sent to any server. Download as PDF directly from your browser.</p>
        </div>

        <!-- Business / Sender Details -->
        <div class="invoice-form-section">
          <h2 class="invoice-section-title">
            <i data-lucide="building-2" aria-hidden="true"></i>
            Your Business / Sender Details
          </h2>

          <div class="invoice-grid-2">
            <div class="form-group">
              <label for="from-name" class="form-label">Business / Your Name</label>
              <input type="text" id="from-name" class="form-input" placeholder="Your Name or Business Name" />
            </div>
            <div class="form-group">
              <label for="from-email" class="form-label">Email</label>
              <input type="email" id="from-email" class="form-input" placeholder="your@email.com" />
            </div>
            <div class="form-group">
              <label for="from-phone" class="form-label">Phone</label>
              <input type="text" id="from-phone" class="form-input" placeholder="+1 234 567 8900" />
            </div>
            <div class="form-group">
              <label for="from-website" class="form-label">Website (optional)</label>
              <input type="text" id="from-website" class="form-input" placeholder="www.yourwebsite.com" />
            </div>
          </div>
          <div class="form-group">
            <label for="from-address" class="form-label">Address</label>
            <textarea id="from-address" class="form-textarea" rows="3" placeholder="123 Main Street, City, Country"></textarea>
          </div>
        </div>

        <!-- Client Details -->
        <div class="invoice-form-section">
          <h2 class="invoice-section-title">
            <i data-lucide="user" aria-hidden="true"></i>
            Bill To / Client Details
          </h2>

          <div class="invoice-grid-2">
            <div class="form-group">
              <label for="to-name" class="form-label">Client Name / Company</label>
              <input type="text" id="to-name" class="form-input" placeholder="Client Name" />
            </div>
            <div class="form-group">
              <label for="to-email" class="form-label">Client Email</label>
              <input type="email" id="to-email" class="form-input" placeholder="client@email.com" />
            </div>
            <div class="form-group">
              <label for="to-phone" class="form-label">Client Phone (optional)</label>
              <input type="text" id="to-phone" class="form-input" placeholder="+1 234 567 8900" />
            </div>
          </div>
          <div class="form-group">
            <label for="to-address" class="form-label">Client Address</label>
            <textarea id="to-address" class="form-textarea" rows="3" placeholder="Client Address"></textarea>
          </div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-form-section">
          <h2 class="invoice-section-title">
            <i data-lucide="file-text" aria-hidden="true"></i>
            Invoice Details
          </h2>

          <div class="invoice-grid-2">
            <div class="form-group">
              <label for="invoice-number" class="form-label">Invoice Number</label>
              <input type="text" id="invoice-number" class="form-input" placeholder="INV-001" />
            </div>
            <div class="form-group">
              <label for="invoice-date" class="form-label">Invoice Date</label>
              <input type="date" id="invoice-date" class="form-input" />
            </div>
            <div class="form-group">
              <label for="due-date" class="form-label">Due Date</label>
              <input type="date" id="due-date" class="form-input" />
            </div>
            <div class="form-group">
              <label for="currency" class="form-label">Currency</label>
              <select id="currency" class="form-select">
                <option value="USD">USD - US Dollar ($)</option>
                <option value="GBP">GBP - British Pound (£)</option>
                <option value="EUR">EUR - Euro (€)</option>
                <option value="PKR">PKR - Pakistani Rupee (Rs)</option>
                <option value="AED">AED - UAE Dirham (AED)</option>
                <option value="SAR">SAR - Saudi Riyal (SAR)</option>
                <option value="CAD">CAD - Canadian Dollar (CA$)</option>
                <option value="AUD">AUD - Australian Dollar (A$)</option>
              </select>
            </div>
            <div class="form-group">
              <label for="payment-terms" class="form-label">Payment Terms</label>
              <select id="payment-terms" class="form-select">
                <option value="Due on Receipt">Due on Receipt</option>
                <option value="Net 15">Net 15</option>
                <option value="Net 30">Net 30</option>
                <option value="Net 45">Net 45</option>
                <option value="Net 60">Net 60</option>
                <option value="Custom">Custom</option>
              </select>
            </div>
            <div class="form-group">
              <label for="invoice-status" class="form-label">Status</label>
              <select id="invoice-status" class="form-select">
                <option value="Draft">Draft</option>
                <option value="Sent">Sent</option>
                <option value="Paid">Paid</option>
                <option value="Overdue">Overdue</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Line Items -->
        <div class="invoice-form-section">
          <h2 class="invoice-section-title">
            <i data-lucide="list" aria-hidden="true"></i>
            Items / Services
          </h2>

          <div class="invoice-items-table-wrapper">
            <table class="invoice-items-table">
              <thead>
                <tr>
                  <th class="item-desc-col">Description</th>
                  <th class="item-qty-col">Quantity</th>
                  <th class="item-price-col">Unit Price</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="invoice-items-body">
                <tr id="item-row-1" data-row="1">
                  <td><input type="text" id="item-desc-1" class="form-input" placeholder="Service or product description" /></td>
                  <td><input type="number" id="item-qty-1" class="form-input" min="1" step="any" value="1" /></td>
                  <td><input type="number" id="item-price-1" class="form-input" min="0" step="0.01" placeholder="0.00" /></td>
                  <td class="item-total-cell" id="item-total-1">0.00</td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>

          <button type="button" class="btn-secondary flex-center gap-8 mt-16" id="btn-add-item">
            <i data-lucide="plus" aria-hidden="true"></i>
            Add Item
          </button>
        </div>

        <!-- Totals -->
        <div class="invoice-form-section">
          <div class="invoice-totals-wrapper">
            <div class="invoice-totals">
              <div class="invoice-totals-row">
                <span class="form-label">Subtotal</span>
                <span class="invoice-totals-value" id="invoice-subtotal">$0.00</span>
              </div>
              <div class="invoice-totals-row">
                <label for="tax-rate" class="form-label">Tax Rate (%)</label>
                <input type="number" id="tax-rate" class="form-input" min="0" max="100" step="0.1" placeholder="0" value="0" />
              </div>
              <div class="invoice-totals-row">
                <span class="form-label">Tax Amount</span>
                <span class="invoice-totals-value" id="invoice-tax">$0.00</span>
              </div>
              <div class="invoice-totals-row">
                <label for="discount-amount" class="form-label">Discount Amount</label>
                <input type="number" id="discount-amount" class="form-input" min="0" step="0.01" value="0" />
              </div>
              <div class="invoice-totals-row invoice-totals-row--total">
                <span class="form-label">Total Due</span>
                <span class="invoice-totals-value" id="invoice-total">$0.00</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Additional Info -->
        <div class="invoice-form-section">
          <h2 class="invoice-section-title">
            <i data-lucide="message-square" aria-hidden="true"></i>
            Additional Information
          </h2>

          <div class="form-group">
            <label for="invoice-notes" class="form-label">Notes / Payment Instructions</label>
            <textarea id="invoice-notes" class="form-textarea" rows="3" placeholder="Payment instructions, thank you message, or any additional notes..."></textarea>
          </div>
          <div class="form-group">
            <label for="invoice-terms" class="form-label">Terms and Conditions (optional)</label>
            <textarea id="invoice-terms" class="form-textarea" rows="3" placeholder="Your terms and conditions..."></textarea>
          </div>
        </div>

        <div class="invoice-actions">
          <button type="button" class="btn-primary flex-center gap-8" id="btn-preview">
            <i data-lucide="eye" aria-hidden="true"></i>
            Preview Invoice
          </button>
          <button type="button" class="btn-primary flex-center gap-8" id="btn-download-pdf">
            <i data-lucide="download" aria-hidden="true"></i>
            Download PDF
          </button>
          <button type="button" class="btn-secondary flex-center gap-8" id="btn-clear-form">
            <i data-lucide="rotate-ccw" aria-hidden="true"></i>
            Clear Form
          </button>
        </div>

      </div>

      <div class="tool-disclaimer">
        <p>This tool generates invoices in your browser. No data is stored or transmitted. Always keep a copy of your invoices for your records.</p>
      </div>

    </div>
  </div>
</main>

<!-- Invoice Preview Modal -->
<div class="invoice-modal" id="invoice-modal">
  <div class="invoice-modal-inner">
    <div class="invoice-modal-header">
      <button type="button" class="btn-primary flex-center gap-8" id="btn-modal-download">
        <i data-lucide="download" aria-hidden="true"></i>
        Download PDF
      </button>
      <button type="button" class="btn-secondary flex-center gap-8" id="btn-modal-close">
        <i data-lucide="x" aria-hidden="true"></i>
        Close
      </button>
    </div>
    <div id="invoice-print-area"></div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
<script>lucide.createIcons();</script>
</body>
</html>
