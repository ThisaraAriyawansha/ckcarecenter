<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background-color: #f3f4f6;
        }

        .wrapper {
            max-width: 620px;
            margin: 36px auto;
        }

        /* ── Top brand bar ── */
        .brand-bar {
            background: #1C3F6E;
            padding: 18px 32px;
            display: table;
            width: 100%;
        }
        .brand-bar-left {
            display: table-cell;
            vertical-align: middle;
        }
        .brand-bar-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }
        .brand-name {
            color: #ffffff;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 3px;
        }
        .brand-tagline {
            color: #dbeafe;
            font-size: 11px;
            margin-top: 2px;
            letter-spacing: 1px;
        }
        .doc-badge {
            display: inline-block;
            background: #1C3F6E;
            color: #ffffff;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 20px;
        }

        /* ── Blue accent line ── */
        .accent-line {
            height: 4px;
            background: #2d5f9e;
        }

        /* ── Main card ── */
        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-top: none;
        }

        /* ── Content area ── */
        .content {
            padding: 32px 32px 24px 32px;
        }

        .greeting {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }
        .body-text {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 24px;
            line-height: 1.7;
        }

        /* ── Summary table ── */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }
        .summary-table thead tr {
            background: #1C3F6E;
        }
        .summary-table thead th {
            padding: 10px 16px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #ffffff;
            font-weight: 600;
            text-align: left;
        }
        .summary-table tbody tr { border-bottom: 1px solid #f3f4f6; }
        .summary-table tbody tr:last-child { border-bottom: none; }
        .summary-table tbody td {
            padding: 10px 16px;
            font-size: 13px;
            color: #374151;
        }
        .summary-table tbody td:first-child {
            color: #6b7280;
            width: 45%;
        }
        .summary-table tbody td strong { color: #111827; }
        .summary-table .total-row td {
            background: #f0f7ff;
            font-weight: 700;
            font-size: 14px;
            color: #1C3F6E;
        }

        /* ── Attachment notice ── */
        .attachment-box {
            border: 1.5px solid #bfdbfe;
            background: #eff6ff;
            border-radius: 8px;
            padding: 14px 20px;
            margin-bottom: 24px;
            display: table;
            width: 100%;
        }
        .attachment-icon {
            display: table-cell;
            vertical-align: middle;
            width: 36px;
            font-size: 22px;
        }
        .attachment-text {
            display: table-cell;
            vertical-align: middle;
        }
        .attachment-text strong {
            display: block;
            font-size: 13px;
            color: #1C3F6E;
            font-weight: 700;
        }
        .attachment-text span {
            font-size: 12px;
            color: #2d5f9e;
        }

        /* ── Bank details ── */
        .bank-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #1C3F6E;
            border-radius: 4px;
            padding: 16px 20px;
            margin-bottom: 24px;
        }
        .bank-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #1C3F6E;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .bank-section table { width: 100%; border-collapse: collapse; }
        .bank-section td {
            font-size: 13px;
            padding: 3px 0;
            color: #374151;
        }
        .bank-section td:first-child {
            color: #6b7280;
            width: 130px;
        }

        /* ── Remarks ── */
        .remarks-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            padding: 12px 16px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #374151;
            line-height: 1.6;
        }
        .remarks-box strong {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #d97706;
            margin-bottom: 4px;
        }

        /* ── Signature ── */
        .signature {
            border-top: 1px solid #f3f4f6;
            padding-top: 20px;
            margin-top: 8px;
        }
        .signature p { font-size: 14px; color: #4b5563; margin-bottom: 2px; }
        .signature .name { font-size: 15px; font-weight: 700; color: #1C3F6E; }
        .signature .role { font-size: 12px; color: #9ca3af; }

        /* ── Footer ── */
        .footer {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-top: none;
            padding: 16px 32px;
            text-align: center;
        }
        .footer p { font-size: 11px; color: #9ca3af; margin: 2px 0; }
        .footer a { color: #1C3F6E; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrapper">

    {{-- ── Brand Bar ── --}}
    <div class="brand-bar">
        <div class="brand-bar-left">
            <div class="brand-name">C & K Home Nursing and Care Center</div>
            <div class="brand-tagline">Professional Care Services</div>
        </div>
        <div class="brand-bar-right">
            <span class="doc-badge">{{ ucfirst($invoice->type) }}</span>
        </div>
    </div>
    <div class="accent-line"></div>

    <div class="card">
        <div class="content">

            {{-- Greeting --}}
            <div class="greeting">Dear {{ $guardian?->name ?? 'Guardian' }},</div>
            <p class="body-text">
                Please find attached the <strong>{{ strtolower($invoice->type) }}</strong>
                <strong>{{ $invoice->invoice_number }}</strong> for
                <strong>{{ $invoice->client->name }}</strong>.
                Kindly review the details below.
            </p>

            {{-- Summary Table --}}
            <table class="summary-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Client</td>
                        <td><strong>{{ $invoice->client->name }}</strong></td>
                    </tr>
                    <tr>
                        <td>Registration No</td>
                        <td><strong>{{ $invoice->client->reg_number }}</strong></td>
                    </tr>
                    <tr>
                        <td>{{ ucfirst($invoice->type) }} No</td>
                        <td><strong>{{ $invoice->invoice_number }}</strong></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><strong>{{ $invoice->invoice_date->format('d M Y') }}</strong></td>
                    </tr>
                    @if($invoice->discount > 0)
                    <tr>
                        <td>Sub Total</td>
                        <td><strong>Rs {{ number_format($invoice->subtotal, 2) }}</strong></td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td><strong style="color:#dc2626;">Rs {{ number_format($invoice->discount, 2) }}</strong></td>
                    </tr>
                    @endif
                    <tr class="total-row">
                        <td>Total Amount</td>
                        <td>Rs {{ number_format($invoice->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Attachment Notice --}}
            <div class="attachment-box">
                <div class="attachment-icon">&#128206;</div>
                <div class="attachment-text">
                    <strong>{{ ucfirst($invoice->type) }} PDF Attached</strong>
                    <span>{{ $invoice->invoice_number }}.pdf — Please open the attachment to view the full {{ $invoice->type }}.</span>
                </div>
            </div>

            {{-- Bank Details (invoice only) --}}
            @if($invoice->type === 'invoice')
            <div class="bank-section">
                <div class="bank-title">Bank Details</div>
                <table>
                    <tr>
                        <td>AC Name</td>
                        <td><strong>{{ $invoice->bank_ac_name }}</strong></td>
                    </tr>
                    @if($invoice->bank_ac_number_lkr)
                    <tr>
                        <td>Account No (LKR)</td>
                        <td><strong>{{ $invoice->bank_ac_number_lkr }}</strong></td>
                    </tr>
                    @endif
                    @if($invoice->bank_ac_number_usd)
                    <tr>
                        <td>Account No (USD)</td>
                        <td><strong>{{ $invoice->bank_ac_number_usd }}</strong></td>
                    </tr>
                    @endif
                    <tr>
                        <td>Bank</td>
                        <td><strong>{{ $invoice->bank_name }}</strong></td>
                    </tr>
                    <tr>
                        <td>Branch</td>
                        <td><strong>{{ $invoice->bank_branch }}</strong></td>
                    </tr>
                </table>
            </div>
            @endif

            {{-- Remarks --}}
            @if($invoice->remarks)
            <div class="remarks-box">
                <strong>Remarks</strong>
                {{ $invoice->remarks }}
            </div>
            @endif

            {{-- Signature --}}
            <div class="signature">
                <p>Best regards,</p>
                <p class="name">C & K Home Nursing and Care Center Team</p>
                <p class="role">Finance &amp; Administration</p>
            </div>

        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>This is an automated email — please do not reply directly to this message.</p>
            <p>
                <a href="http://www.ckcarecenter.com">www.ckcarecenter.com</a>
                &nbsp;&bull;&nbsp; +9477 660 40 40
                &nbsp;&bull;&nbsp; info@ckcarecenter.com
            </p>
            <p style="margin-top:6px;">&copy; {{ date('Y') }} C & K Home Nursing and Care Center. All rights reserved.</p>
        </div>
    </div>

</div>
</body>
</html>
