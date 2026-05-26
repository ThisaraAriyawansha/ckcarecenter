<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Monthly Expense Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header .logo {
            width: 100px;
            height: auto;
            margin-bottom: 8px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #2563eb;
        }
        .header p {
            margin: 5px 0;
            font-size: 10px;
        }
        .summary {
            margin: 15px 0;
            padding: 10px;
            background-color: #f0f9ff;
            border-left: 4px solid #2563eb;
        }
        .summary-grid {
            display: table;
            width: 100%;
            margin-top: 10px;
        }
        .summary-row {
            display: table-row;
        }
        .summary-label {
            display: table-cell;
            font-weight: bold;
            padding: 5px;
            width: 40%;
        }
        .summary-value {
            display: table-cell;
            padding: 5px;
            text-align: right;
        }
        .category-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .category-header {
            background-color: #dbeafe;
            padding: 8px;
            margin-bottom: 10px;
            border-left: 5px solid #2563eb;
            border-radius: 4px;
        }
        .category-title {
            font-size: 14px;
            font-weight: bold;
            color: #1e40af;
            margin: 0;
        }
        .category-total {
            font-size: 11px;
            color: #64748b;
            margin-top: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #2563eb;
            color: white;
            padding: 8px 5px;
            text-align: left;
            font-size: 9px;
            border: 1px solid #1e40af;
        }
        td {
            padding: 6px 5px;
            border: 1px solid #ddd;
            font-size: 9px;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .amount {
            text-align: right;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .total-summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #dcfce7;
            border-left: 5px solid #16a34a;
            border-radius: 4px;
        }
        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #166534;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/care365.svg') }}" alt="Care365 Logo" class="logo">
        <h1>CARE 365 - Monthly Expense Report</h1>
        <p>{{ $month }}</p>
        @if($branch_name)
            <p>Branch: {{ $branch_name }}</p>
        @endif
        <p>Generated on: {{ $generated_at }}</p>
    </div>

    <div class="summary">
        <strong style="font-size: 12px;">Summary</strong>
        <div class="summary-grid">
            <div class="summary-row">
                <div class="summary-label">Total Expenses:</div>
                <div class="summary-value">LKR {{ number_format($totalExpenses, 2) }}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Number of Transactions:</div>
                <div class="summary-value">{{ $expenses->count() }}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Number of Categories:</div>
                <div class="summary-value">{{ $groupedByCategory->count() }}</div>
            </div>
        </div>
    </div>

    @if($expenses->isEmpty())
        <div style="text-align: center; padding: 30px; background-color: #f9fafb; border-radius: 8px;">
            <p style="font-size: 14px; color: #6b7280;">No expenses found for the selected month.</p>
        </div>
    @else
        @foreach($groupedByCategory as $category => $categoryExpenses)
            <div class="category-section">
                <div class="category-header">
                    <div class="category-title">{{ $category }}</div>
                    <div class="category-total">
                        {{ $categoryExpenses->count() }} {{ $categoryExpenses->count() === 1 ? 'transaction' : 'transactions' }} |
                        Total: LKR {{ number_format($categoryTotals[$category], 2) }}
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="width: 10%;">Date</th>
                            <th style="width: 12%;">Sub Category</th>
                            <th style="width: 18%;">Description</th>
                            <th style="width: 15%;">Vendor</th>
                            <th style="width: 12%;">Payment</th>
                            <th style="width: 12%;">Receipt #</th>
                            <th style="width: 12%;">Branch</th>
                            <th style="width: 9%;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoryExpenses->sortBy('expense_date') as $expense)
                            <tr>
                                <td>{{ $expense->expense_date->format('M d') }}</td>
                                <td>{{ $expense->sub_category ?? '-' }}</td>
                                <td>{{ $expense->description ?? '-' }}</td>
                                <td>{{ $expense->vendor_name ?? '-' }}</td>
                                <td>{{ $expense->payment_method ?? '-' }}</td>
                                <td>{{ $expense->receipt_number ?? '-' }}</td>
                                <td>{{ $expense->branch?->name ?? '-' }}</td>
                                <td class="amount">{{ number_format($expense->amount, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color: #e0f2fe; font-weight: bold;">
                            <td colspan="7" style="text-align: right; padding-right: 10px;">{{ $category }} Total:</td>
                            <td class="amount">{{ number_format($categoryTotals[$category], 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach

        <div class="total-summary">
            <div style="text-align: center; margin-bottom: 5px; font-size: 12px; color: #166534;">
                <strong>TOTAL MONTHLY EXPENSES</strong>
            </div>
            <div class="total-amount">
                LKR {{ number_format($totalExpenses, 2) }}
            </div>
        </div>
    @endif

    <div class="footer">
        <p>This report was generated by CARE 365 Management System</p>
        <p>© {{ date('Y') }} CARE 365. All rights reserved.</p>
    </div>
</body>
</html>
