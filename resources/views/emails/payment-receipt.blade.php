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
        .message {
            background-color: #f0f9ff;
            border-left: 4px solid #2563eb;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        .message p {
            margin: 0 0 12px 0;
            font-size: 15px;
            color: #374151;
        }
        .message p:last-child {
            margin-bottom: 0;
        }
        .icon {
            display: inline-block;
            width: 24px;
            height: 24px;
            vertical-align: middle;
            margin-right: 8px;
        }
        .attachment-notice {
            background-color: #fef3c7;
            border: 2px dashed #f59e0b;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 25px 0;
        }
        .attachment-notice p {
            margin: 0;
            color: #92400e;
            font-weight: 600;
            font-size: 14px;
        }
        .signature {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }
        .signature p {
            margin: 0;
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
            margin: 5px 0;
            color: #6b7280;
            font-size: 13px;
        }
        @media only screen and (max-width: 600px) {
            .container {
                margin: 20px;
                border-radius: 8px;
            }
            .header {
                padding: 30px 20px;
            }
            .content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CARE 365</h1>
            <p>Payment Receipt</p>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $guardianName }},
            </div>

            <div class="message">
                <p>
                    <svg class="icon" fill="#2563eb" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Your payment has been successfully received.
                </p>
                <p>Your payment receipt is attached to this email as a PDF document.</p>
            </div>

            <div class="attachment-notice">
                <p>📎 Payment Receipt Attached</p>
            </div>

            <div class="message">
                <p style="text-align: center; font-size: 16px; color: #2563eb; font-weight: 600;">
                    Thank you for your payment! 💙
                </p>
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
