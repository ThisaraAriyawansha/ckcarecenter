<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 8px 0 0 0;
            color: #e0e7ff;
            font-size: 14px;
            font-weight: 500;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .info-box {
            background-color: #f0f9ff;
            border-left: 4px solid #2563eb;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .info-box p {
            margin: 0 0 8px 0;
            font-size: 14px;
            color: #374151;
        }
        .info-box p:last-child { margin-bottom: 0; }
        .info-box strong { color: #1d4ed8; }
        .attachment-notice {
            background-color: #eff6ff;
            border: 2px dashed #93c5fd;
            padding: 18px;
            border-radius: 8px;
            text-align: center;
            margin: 25px 0;
        }
        .attachment-notice p {
            margin: 0;
            color: #1d4ed8;
            font-weight: 600;
            font-size: 14px;
        }
        .signature {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }
        .signature p {
            margin: 0 0 4px 0;
            color: #4b5563;
            font-size: 15px;
        }
        .company-name {
            color: #2563eb;
            font-weight: 700;
            font-size: 16px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            margin: 4px 0;
            color: #6b7280;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CARE 365</h1>
            <p>Client Invoice</p>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $guardian->name }},
            </div>

            <p style="color: #4b5563; font-size: 15px;">
                Please find attached the invoice for <strong>{{ $client->name }}</strong> from Care 365.
            </p>

            <div class="info-box">
                <p><strong>Client:</strong> {{ $client->name }}</p>
                <p><strong>Registration No:</strong> {{ $client->reg_number }}</p>
                @if(!empty($invoiceData['date_from']) || !empty($invoiceData['date_until']))
                <p>
                    <strong>Period:</strong>
                    {{ !empty($invoiceData['date_from']) ? \Carbon\Carbon::parse($invoiceData['date_from'])->format('M d, Y') : 'Beginning' }}
                    &mdash;
                    {{ !empty($invoiceData['date_until']) ? \Carbon\Carbon::parse($invoiceData['date_until'])->format('M d, Y') : 'Today' }}
                </p>
                @endif
                <p><strong>Total Amount:</strong> LKR {{ number_format($invoiceData['total'], 2) }}</p>
            </div>

            <div class="attachment-notice">
                <p>📎 Invoice PDF Attached</p>
            </div>

            <div class="signature">
                <p>Best regards,</p>
                <p class="company-name">CARE 365 Team</p>
            </div>
        </div>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
            <p>&copy; {{ date('Y') }} CARE 365. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
