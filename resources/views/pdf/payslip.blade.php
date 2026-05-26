<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip - {{ $payslip->payslip_number }}</title>
    <style>
        @page {
            size: A5 landscape;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
        }
        .header {
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }
        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }
        .payslip-title {
            font-size: 11px;
            color: #666;
            margin: 2px 0 0 0;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            width: 25%;
            font-weight: bold;
            padding: 2px 5px;
            font-size: 8px;
        }
        .info-value {
            display: table-cell;
            padding: 2px 5px;
            font-size: 8px;
        }
        .content-wrapper {
            display: table;
            width: 100%;
        }
        .earnings-section, .deductions-section {
            display: table-cell;
            width: 48%;
            vertical-align: top;
        }
        .earnings-section {
            padding-right: 2%;
        }
        .deductions-section {
            padding-left: 2%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 3px 5px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 8px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .amount {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .net-salary-box {
            background-color: #e3f2fd;
            padding: 5px;
            margin-top: 8px;
            text-align: center;
            border: 1px solid #2196F3;
        }
        .net-salary-label {
            font-size: 9px;
            font-weight: bold;
        }
        .net-salary-amount {
            font-size: 14px;
            font-weight: bold;
            color: #2196F3;
        }
        .footer {
            margin-top: 8px;
            padding-top: 5px;
            border-top: 1px solid #ddd;
            font-size: 7px;
            color: #666;
            text-align: center;
        }
        .notes-box {
            margin-top: 5px;
            padding: 5px;
            background-color: #f9f9f9;
            border-left: 3px solid #2196F3;
            font-size: 8px;
        }
        .bank-details {
            margin-top: 5px;
            font-size: 7px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="company-name">Care365</div>
            <div class="payslip-title">PAYSLIP - {{ $payslip->payslip_number }}</div>
        </div>

        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Employee:</div>
                <div class="info-value">{{ $payslip->career->full_name }}</div>
                <div class="info-label">ID:</div>
                <div class="info-value">{{ $payslip->career->employee_id }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Pay Period:</div>
                <div class="info-value">{{ $payslip->month_name }} {{ $payslip->year }}</div>
                <div class="info-label">Payment Date:</div>
                <div class="info-value">{{ $payslip->payment_date->format('M d, Y') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Job Title:</div>
                <div class="info-value">{{ $payslip->career->job_title ?? 'N/A' }}</div>
                <div class="info-label">Department:</div>
                <div class="info-value">{{ $payslip->career->department ?? 'N/A' }}</div>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="earnings-section">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">EARNINGS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Basic Salary</td>
                            <td class="amount">{{ number_format($payslip->basic_salary, 2) }}</td>
                        </tr>
                        @if($payslip->allowances > 0)
                        <tr>
                            <td>Allowances</td>
                            <td class="amount">{{ number_format($payslip->allowances, 2) }}</td>
                        </tr>
                        @endif
                        @if($payslip->overtime > 0)
                        <tr>
                            <td>Overtime</td>
                            <td class="amount">{{ number_format($payslip->overtime, 2) }}</td>
                        </tr>
                        @endif
                        @if($payslip->bonus > 0)
                        <tr>
                            <td>Bonus</td>
                            <td class="amount">{{ number_format($payslip->bonus, 2) }}</td>
                        </tr>
                        @endif
                        <tr class="total-row">
                            <td>GROSS SALARY</td>
                            <td class="amount">{{ number_format($payslip->gross_salary, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="deductions-section">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">DEDUCTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($payslip->epf_employee > 0)
                        <tr>
                            <td>EPF (8%)</td>
                            <td class="amount">{{ number_format($payslip->epf_employee, 2) }}</td>
                        </tr>
                        @endif
                        @if($payslip->tax > 0)
                        <tr>
                            <td>Tax</td>
                            <td class="amount">{{ number_format($payslip->tax, 2) }}</td>
                        </tr>
                        @endif
                        @if($payslip->other_deductions > 0)
                        <tr>
                            <td>Other Deductions</td>
                            <td class="amount">{{ number_format($payslip->other_deductions, 2) }}</td>
                        </tr>
                        @endif
                        <tr class="total-row">
                            <td>TOTAL DEDUCTIONS</td>
                            <td class="amount">{{ number_format($payslip->total_deductions, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="net-salary-box">
            <div class="net-salary-label">NET SALARY</div>
            <div class="net-salary-amount">LKR {{ number_format($payslip->net_salary, 2) }}</div>
        </div>

        @if($payslip->notes)
        <div class="notes-box">
            <strong>Notes:</strong> {{ $payslip->notes }}
        </div>
        @endif

        <div class="bank-details">
            <strong>Bank Details:</strong>
            @if($payslip->career->bank_name){{ $payslip->career->bank_name }}@endif
            @if($payslip->career->bank_account_number) | A/C: {{ $payslip->career->bank_account_number }}@endif
            @if($payslip->career->bank_branch) | Branch: {{ $payslip->career->bank_branch }}@endif
        </div>

        <div class="footer">
            This is a computer-generated document. No signature is required. | Generated on {{ now()->format('M d, Y H:i') }}
        </div>
    </div>
</body>
</html>
