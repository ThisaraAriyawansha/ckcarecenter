<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2196F3;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }
        .details {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: bold;
            color: #666;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">Care365</h1>
            <p style="margin: 10px 0 0 0;">Monthly Payslip</p>
        </div>

        <div class="content">
            <p>Dear {{ $career->full_name }},</p>

            <p>Your payslip for <strong>{{ $payslip->month_name }} {{ $payslip->year }}</strong> is ready.</p>

            <div class="details">
                <div class="detail-row">
                    <span class="detail-label">Payslip Number:</span>
                    <span>{{ $payslip->payslip_number }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Pay Period:</span>
                    <span>{{ $payslip->month_name }} {{ $payslip->year }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Payment Date:</span>
                    <span>{{ $payslip->payment_date->format('F d, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Gross Salary:</span>
                    <span>LKR {{ number_format($payslip->gross_salary, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Deductions:</span>
                    <span>LKR {{ number_format($payslip->total_deductions, 2) }}</span>
                </div>
                <div class="detail-row" style="border-bottom: none; font-size: 16px; font-weight: bold; color: #2196F3;">
                    <span class="detail-label">Net Salary:</span>
                    <span>LKR {{ number_format($payslip->net_salary, 2) }}</span>
                </div>
            </div>

            <p>Your detailed payslip is attached to this email as a PDF document.</p>

            @if($payslip->notes)
            <div style="background-color: #fff3cd; padding: 15px; border-radius: 5px; border-left: 4px solid #ffc107; margin-top: 20px;">
                <strong>Note:</strong> {{ $payslip->notes }}
            </div>
            @endif

            <p style="margin-top: 30px;">If you have any questions regarding your payslip, please contact the HR department.</p>

            <p>Best regards,<br>
            <strong>Care365 HR Team</strong></p>

            <div class="footer">
                <p>This is an automated email. Please do not reply to this message.</p>
                <p>&copy; {{ date('Y') }} Care365. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
