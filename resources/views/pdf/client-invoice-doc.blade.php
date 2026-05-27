<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ ucfirst($invoice->type) }} {{ $invoice->invoice_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #1a1a1a;
            background: #ffffff;
            padding: 36px 40px 210px 40px;
        }

        /* ── Header ── */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .header-left  { display: table-cell; vertical-align: middle; width: 50%; }
        .header-right { display: table-cell; vertical-align: middle; text-align: right; width: 50%; }

        .logo-text {
            font-size: 28px;
            font-weight: bold;
            color: #1C3F6E;
            letter-spacing: 3px;
        }
        .doc-type {
            font-size: 38px;
            font-weight: bold;
            color: #1C3F6E;
            letter-spacing: 1px;
        }
        .doc-date {
            font-size: 12px;
            color: #555;
            margin-top: 4px;
        }

        /* ── Dividers ── */
        .divider      { border: none; border-top: 1px solid #e5e7eb; margin: 14px 0; }
        .divider-blue { border: none; border-top: 3px solid #1C3F6E; margin: 0 0 20px 0; }

        /* ── Client section ── */
        .client-section { margin-bottom: 18px; }
        .client-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #888;
            margin-bottom: 4px;
        }
        .client-name {
            font-size: 15px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 6px;
        }
        .client-meta     { display: table; }
        .client-meta-row { display: table-row; }
        .client-meta-key {
            display: table-cell;
            font-size: 11px;
            color: #555;
            padding: 2px 24px 2px 0;
            white-space: nowrap;
        }
        .client-meta-val {
            display: table-cell;
            font-size: 11px;
            color: #1a1a1a;
            padding: 2px 0;
        }

        /* ── Items table ── */
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.items thead tr { background-color: #6b7280; }
        table.items thead th {
            padding: 10px 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #ffffff;
            font-weight: bold;
        }
        table.items thead th.right  { text-align: right; }
        table.items thead th.center { text-align: center; }

        table.items tbody tr:nth-child(even) { background: #f9fafb; }
        table.items tbody td {
            padding: 9px 10px;
            font-size: 11px;
            color: #374151;
            vertical-align: top;
        }
        table.items tbody td.right  { text-align: right; }
        table.items tbody td.center { text-align: center; }

        .item-sub {
            font-size: 10px;
            color: #9ca3af;
            margin-top: 3px;
        }

        table.items tbody tr:last-child td { border-bottom: 2px solid #e5e7eb; }

        /* ── Totals ── */
        .totals-wrap   { display: table; width: 100%; margin-top: 10px; }
        .totals-spacer { display: table-cell; width: 52%; vertical-align: top; }
        .totals-box    { display: table-cell; width: 48%; padding-left: 16px; vertical-align: top; }

        .totals-row {
            display: table;
            width: 100%;
            border-bottom: 1px solid #f0f0f0;
            padding: 5px 0;
        }
        .totals-row:last-child { border-bottom: none; }
        .totals-key {
            display: table-cell;
            font-size: 11px;
            color: #666;
            width: 55%;
        }
        .totals-val {
            display: table-cell;
            font-size: 12px;
            color: #1a1a1a;
            text-align: right;
        }
        .totals-val.discount { color: #dc2626; }

        .totals-final-row {
            display: table;
            width: 100%;
            margin-top: 4px;
            background: #6b7280;
            padding: 8px 10px;
        }
        .totals-final-key {
            display: table-cell;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
            letter-spacing: 1px;
            width: 55%;
        }
        .totals-final-val {
            display: table-cell;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            text-align: right;
        }

        /* ── Payment Required stamp ── */
        .stamp {
            display: inline-block;
            border: 3px solid #dc2626;
            color: #dc2626;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 2px;
            padding: 7px 16px;
            text-transform: uppercase;
            transform: rotate(-5deg);
            margin-top: 20px;
            line-height: 1.6;
        }

        /* ── Bottom fixed section (Remarks + Bank Details + Footer) ── */
        .bottom-fixed {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }

        /* ── Remarks ── */
        .remarks-section {
            background: #ffffff;
            padding: 10px 40px;
            border-top: 1px solid #e5e7eb;
        }
        .remarks-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #1C3F6E;
            font-weight: bold;
            margin-bottom: 3px;
        }
        .remarks-text {
            font-size: 10px;
            color: #374151;
            line-height: 1.6;
        }

        /* ── Bank details ── */
        .bank-section {
            background: #f1f5f9;
            padding: 12px 40px;
        }
        .bank-title {
            font-size: 12px;
            font-weight: bold;
            color: #1C3F6E;
            letter-spacing: 1px;
            margin-bottom: 7px;
            text-transform: uppercase;
        }
        .bank-table { display: table; }
        .bank-row   { display: table-row; }
        .bank-key {
            display: table-cell;
            font-size: 11px;
            color: #6b7280;
            padding: 2px 30px 2px 0;
            white-space: nowrap;
            width: 100px;
        }
        .bank-val {
            display: table-cell;
            font-size: 11px;
            font-weight: bold;
            color: #111827;
            padding: 2px 0;
        }

        /* ── Footer bar ── */
        .footer-bar {
            background: #ffffff;
            border-top: 2px solid #1C3F6E;
            padding: 8px 40px;
            display: table;
            width: 100%;
        }
        .footer-left  { display: table-cell; vertical-align: middle; width: 68%; }
        .footer-right { display: table-cell; vertical-align: middle; text-align: right; width: 32%; }

        .footer-item {
            display: inline-block;
            color: #374151;
            font-size: 9px;
        }
        .footer-sep {
            display: inline-block;
            color: #d1d5db;
            font-size: 9px;
            margin: 0 8px;
        }
    </style>
</head>
<body>

    {{-- ── Header ── --}}
    <div class="header">
        <div class="header-left">
            <div class="logo-text">C & K Home Nursing and Care Center</div>
        </div>
        <div class="header-right">
            <div class="doc-type">{{ ucfirst($invoice->type) }}</div>
            <div class="doc-date">{{ $invoice->invoice_date->format('d F Y') }}</div>
        </div>
    </div>

    <hr class="divider-blue">

    {{-- ── Client Info ── --}}
    <div class="client-section">
        <div class="client-label">Client</div>
        <div class="client-name">{{ $client->name }}</div>
        <div class="client-meta">
            <div class="client-meta-row">
                <div class="client-meta-key">Date Issued</div>
                <div class="client-meta-val">{{ $invoice->invoice_date->format('d.m.Y') }}</div>
            </div>
            <div class="client-meta-row">
                <div class="client-meta-key">{{ ucfirst($invoice->type) }} No</div>
                <div class="client-meta-val">{{ $invoice->invoice_number }}</div>
            </div>
            <div class="client-meta-row">
                <div class="client-meta-key">Reg No</div>
                <div class="client-meta-val">{{ $client->reg_number }}</div>
            </div>
        </div>
    </div>

    <hr class="divider">

    {{-- ── Items Table ── --}}
    <table class="items">
        <thead>
            <tr>
                <th class="center" style="width:30px;">#</th>
                <th>Item</th>
                <th class="right" style="width:100px;">Price</th>
                <th class="right" style="width:80px;">Disc</th>
                <th class="right" style="width:100px;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $i => $item)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>
                    {{ $item->item_name }}
                    @if($item->description)
                        <div class="item-sub">{{ $item->description }}</div>
                    @endif
                </td>
                <td class="right">Rs {{ number_format($item->price, 2) }}</td>
                <td class="right">{{ $item->discount > 0 ? 'Rs '.number_format($item->discount, 2) : '-' }}</td>
                <td class="right">Rs {{ number_format($item->amount, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#ccc; padding:20px;">No items.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ── Totals ── --}}
    <div class="totals-wrap">
        <div class="totals-spacer">
            @if($invoice->type === 'invoice')
                <span class="stamp">Payment<br>Required</span>
            @endif
        </div>
        <div class="totals-box">
            <div class="totals-row">
                <div class="totals-key">Sub Total</div>
                <div class="totals-val">Rs {{ number_format($invoice->subtotal, 2) }}</div>
            </div>
            <div class="totals-row">
                <div class="totals-key">Discount</div>
                <div class="totals-val discount">
                    {{ $invoice->discount > 0 ? 'Rs '.number_format($invoice->discount, 2) : '-' }}
                </div>
            </div>
            <div class="totals-final-row">
                <div class="totals-final-key">TOTAL</div>
                <div class="totals-final-val">Rs {{ number_format($invoice->total, 2) }}</div>
            </div>
        </div>
    </div>

    {{-- ── Bottom Fixed Section ── --}}
    <div class="bottom-fixed">

        {{-- Remarks --}}
        @if($invoice->remarks)
        <div class="remarks-section">
            <div class="remarks-label">Remarks</div>
            <div class="remarks-text">{{ $invoice->remarks }}</div>
        </div>
        @endif

        {{-- Bank Details --}}
        <div class="bank-section">
            <div class="bank-title">Bank Details</div>
            <div class="bank-table">
                <div class="bank-row">
                    <div class="bank-key">AC Name</div>
                    <div class="bank-val">{{ $invoice->bank_ac_name }}</div>
                </div>
                @if($invoice->bank_ac_number_lkr)
                <div class="bank-row">
                    <div class="bank-key">Account No</div>
                    <div class="bank-val">{{ $invoice->bank_ac_number_lkr }}</div>
                </div>
                @endif
                @if($invoice->bank_ac_number_usd)
                <div class="bank-row">
                    <div class="bank-key"></div>
                    <div class="bank-val">{{ $invoice->bank_ac_number_usd }}</div>
                </div>
                @endif
                <div class="bank-row">
                    <div class="bank-key">Bank</div>
                    <div class="bank-val">{{ $invoice->bank_name }}</div>
                </div>
                <div class="bank-row">
                    <div class="bank-key"></div>
                    <div class="bank-val">{{ $invoice->bank_branch }}</div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="footer-bar">
            <div class="footer-left">
                <span class="footer-item">www.ckcarecenter.com</span>
                <span class="footer-sep">|</span>
                <span class="footer-item">C & K Home Nursing and Care Center</span>
                <span class="footer-sep">|</span>
                <span class="footer-item">+9477 660 40 40</span>
                <span class="footer-sep">|</span>
                <span class="footer-item">info@ckcarecenter.com</span>
            </div>
            <div class="footer-right">
                <span class="footer-item">Colombo, Sri Lanka</span>
            </div>
        </div>

    </div>

</body>
</html>
