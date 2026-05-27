<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #1a1a1a;
            background: #ffffff;
            padding: 36px 40px 130px 40px;
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
            font-size: 30px;
            font-weight: bold;
            color: #1C3F6E;
            letter-spacing: 1px;
        }
        .doc-date {
            font-size: 11px;
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

        /* ── Payments table ── */
        table.payments {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.payments thead tr { background-color: #1C3F6E; }
        table.payments thead th {
            padding: 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #ffffff;
            font-weight: bold;
        }
        table.payments thead th.right  { text-align: right; }
        table.payments thead th.center { text-align: center; }

        table.payments tbody tr:nth-child(even) { background: #f0f9ff; }
        table.payments tbody td {
            padding: 9px 10px;
            font-size: 11px;
            color: #374151;
            vertical-align: top;
        }
        table.payments tbody td.right  { text-align: right; }
        table.payments tbody td.center { text-align: center; }

        table.payments tbody tr:last-child td { border-bottom: 2px solid #e5e7eb; }

        /* ── Totals ── */
        .totals-wrap   { display: table; width: 100%; margin-top: 10px; }
        .totals-spacer { display: table-cell; width: 50%; vertical-align: top; }
        .totals-box    { display: table-cell; width: 50%; padding-left: 16px; vertical-align: top; }

        .totals-final-row {
            display: table;
            width: 100%;
            margin-top: 8px;
            background: #1C3F6E;
            padding: 10px 12px;
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
            font-size: 15px;
            font-weight: bold;
            color: #fff;
            text-align: right;
        }

        /* ── Paid stamp ── */
        .stamp {
            display: inline-block;
            border: 3px solid #16a34a;
            color: #16a34a;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 2px;
            padding: 8px 18px;
            text-transform: uppercase;
            transform: rotate(-5deg);
            margin-top: 16px;
        }

        /* ── Bottom fixed section ── */
        .bottom-fixed {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }

        /* ── Billed to / Received from ── */
        .billed-section {
            background: #f0f9ff;
            padding: 8px 40px;
            border-top: 1px solid #dbeafe;
        }
        .billed-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #1C3F6E;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .billed-text { font-size: 11px; color: #374151; }

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
        .footer-item  { display: inline-block; color: #374151; font-size: 9px; }
        .footer-sep   { display: inline-block; color: #d1d5db; font-size: 9px; margin: 0 8px; }
    </style>
</head>
<body>

    {{-- ── Header ── --}}
    <div class="header">
        <div class="header-left">
            <div class="logo-text">C & K Home Nursing and Care Center</div>
            @if($branch_name)
                <div style="font-size:11px; color:#555; margin-top:4px;">{{ $branch_name }}</div>
            @endif
        </div>
        <div class="header-right">
            <div class="doc-type">Payment Receipt</div>
            <div class="doc-date">Generated {{ now()->format('d F Y') }}</div>
        </div>
    </div>

    <hr class="divider-blue">

    {{-- ── Client Info ── --}}
    <div class="client-section">
        <div class="client-label">Client</div>
        <div class="client-name">{{ $client_name }}</div>
        <div class="client-meta">
            <div class="client-meta-row">
                <div class="client-meta-key">Reg No</div>
                <div class="client-meta-val">{{ $client_reg_number }}</div>
            </div>
            <div class="client-meta-row">
                <div class="client-meta-key">Receipt No</div>
                <div class="client-meta-val">#{{ str_pad($payments->first()->id, 6, '0', STR_PAD_LEFT) }}{{ $payments->count() > 1 ? ' — #'.str_pad($payments->last()->id, 6, '0', STR_PAD_LEFT) : '' }}</div>
            </div>
            <div class="client-meta-row">
                <div class="client-meta-key">Period</div>
                <div class="client-meta-val">
                    @if($payments->count() === 1)
                        {{ $payments->first()->payment_date->format('d F Y') }}
                    @else
                        {{ $payments->first()->payment_date->format('d M Y') }} — {{ $payments->last()->payment_date->format('d M Y') }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <hr class="divider">

    {{-- ── Payments Table ── --}}
    <table class="payments">
        <thead>
            <tr>
                <th class="center" style="width:30px;">#</th>
                <th style="width:100px;">Date</th>
                <th>Type</th>
                <th>Description</th>
                <th class="right" style="width:120px;">Amount (LKR)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $i => $payment)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $payment->payment_date->format('d M Y') }}</td>
                <td>{{ $payment->payment_type }}</td>
                <td>{{ $payment->description }}</td>
                <td class="right">{{ number_format($payment->amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ── Totals ── --}}
    @php $total = $payments->sum('amount'); @endphp
    <div class="totals-wrap">
        <div class="totals-spacer">
            <span class="stamp">PAID</span>
        </div>
        <div class="totals-box">
            <div class="totals-final-row">
                <div class="totals-final-key">TOTAL PAID</div>
                <div class="totals-final-val">LKR {{ number_format($total, 2) }}</div>
            </div>
        </div>
    </div>

    {{-- ── Bottom Fixed Section ── --}}
    <div class="bottom-fixed">

        @if($guardian_name)
        <div class="billed-section">
            <div class="billed-label">Received From</div>
            <div class="billed-text">
                <strong>{{ $guardian_name }}</strong>
                @if($guardian_email) &nbsp;|&nbsp; {{ $guardian_email }} @endif
                @if($guardian_phone) &nbsp;|&nbsp; {{ $guardian_phone }} @endif
            </div>
        </div>
        @endif

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
                <span class="footer-item">407 C1, Nomis Weragala Mw, Hokandara, SL</span>
            </div>
        </div>

    </div>

</body>
</html>
