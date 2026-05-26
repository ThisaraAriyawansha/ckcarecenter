<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #1a1a1a;
            background: #ffffff;
            padding: 40px;
        }

        /* Header */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 40px;
        }
        .header-left {
            display: table-cell;
            vertical-align: middle;
        }
        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }
        .brand {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
            letter-spacing: 1px;
        }
        .brand-sub {
            font-size: 11px;
            color: #999;
            margin-top: 2px;
        }
        .invoice-label {
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .invoice-number {
            font-size: 18px;
            font-weight: bold;
            color: #1a1a1a;
            margin-top: 3px;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 20px 0;
        }
        .divider-blue {
            border: none;
            border-top: 2px solid #2563eb;
            margin: 20px 0;
        }

        /* Meta section */
        .meta {
            display: table;
            width: 100%;
            margin: 25px 0;
        }
        .meta-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .meta-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: right;
        }
        .meta-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #2563eb;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .meta-name {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 4px;
        }
        .meta-detail {
            font-size: 11px;
            color: #555;
            line-height: 1.7;
        }

        /* Period badge */
        .period {
            display: inline-block;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
            font-size: 11px;
            padding: 5px 12px;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        /* Table */
        table.items {
            width: 100%;
            border-collapse: collapse;
        }
        table.items thead tr {
            border-bottom: 2px solid #2563eb;
        }
        table.items thead th {
            padding: 10px 8px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #2563eb;
            font-weight: bold;
        }
        table.items thead th.right {
            text-align: right;
        }
        table.items tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }
        table.items tbody td {
            padding: 11px 8px;
            font-size: 11px;
            color: #374151;
        }
        table.items tbody td.right {
            text-align: right;
        }
        table.items tbody tr:last-child {
            border-bottom: none;
        }

        /* Total */
        .total-row {
            display: table;
            width: 100%;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }
        .total-spacer {
            display: table-cell;
            width: 60%;
        }
        .total-box {
            display: table-cell;
            width: 40%;
            text-align: right;
        }
        .total-label {
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }
        .total-amount {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #bbb;
            line-height: 1.8;
        }

        .empty-note {
            text-align: center;
            color: #ccc;
            padding: 25px 0;
            font-size: 11px;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="header-left">
            <div class="brand">CARE 365</div>
            <div class="brand-sub">{{ $branch_name ?? 'Care Home' }}</div>
        </div>
        <div class="header-right">
            <div class="invoice-label">Invoice</div>
            <div class="invoice-number">#INV-{{ str_pad($client->id, 5, '0', STR_PAD_LEFT) }}-{{ now()->format('Ymd') }}</div>
        </div>
    </div>

    <hr class="divider-blue">

    {{-- Billed To / Invoice Details --}}
    <div class="meta">
        <div class="meta-left">
            <div class="meta-label">Billed To</div>
            <div class="meta-name">{{ $client->name }}</div>
            <div class="meta-detail">
                Reg No: {{ $client->reg_number }}<br>
                @if($guardian)
                    Guardian: {{ $guardian->name }}<br>
                    @if($guardian->email) {{ $guardian->email }}<br> @endif
                @endif
            </div>
        </div>
        <div class="meta-right">
            <div class="meta-label">Details</div>
            <div class="meta-detail">
                Issue Date: {{ now()->format('M d, Y') }}<br>
                Payments: {{ $payments->count() }}
            </div>
        </div>
    </div>

    <hr class="divider">

    {{-- Period --}}
    @if($date_from || $date_until)
    <div class="period">
        {{ $date_from ? \Carbon\Carbon::parse($date_from)->format('M d, Y') : 'Beginning' }}
        &nbsp;&mdash;&nbsp;
        {{ $date_until ? \Carbon\Carbon::parse($date_until)->format('M d, Y') : 'Today' }}
    </div>
    @endif

    {{-- Payment Type Filter Badge --}}
    @if(!empty($payment_types))
    <div class="period" style="background:#f0fdf4; border-color:#bbf7d0; color:#15803d;">
        Types: {{ implode(', ', $payment_types) }}
    </div>
    @endif

    {{-- Items Table --}}
    <table class="items">
        <thead>
            <tr>
                <th style="width: 30px;">#</th>
                <th style="width: 100px;">Date</th>
                <th style="width: 130px;">Type</th>
                <th>Description</th>
                <th class="right" style="width: 110px;">Amount (LKR)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $i => $payment)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $payment->payment_date->format('M d, Y') }}</td>
                <td>{{ $payment->payment_type }}</td>
                <td>{{ $payment->description }}</td>
                <td class="right">{{ number_format($payment->amount, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-note">No payments found for this period.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Total --}}
    <div class="total-row">
        <div class="total-spacer"></div>
        <div class="total-box">
            <div class="total-label">Total Amount</div>
            <div class="total-amount">LKR {{ number_format($total, 2) }}</div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        System-generated invoice &nbsp;&bull;&nbsp; Care 365 &nbsp;&bull;&nbsp; {{ now()->format('M d, Y \a\t H:i') }}
    </div>

</body>
</html>
