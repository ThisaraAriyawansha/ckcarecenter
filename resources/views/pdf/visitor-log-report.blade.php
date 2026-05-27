<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Visitor Log Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #333;
            margin: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #333;
            padding-bottom: 8px;
        }
        .header .logo {
            width: 100px;
            height: auto;
            margin-bottom: 8px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
            color: #1C3F6E;
        }
        .header p {
            margin: 4px 0;
            font-size: 10px;
        }
        .summary {
            margin: 10px 0;
            padding: 8px;
            background-color: #f0f9ff;
            border-left: 4px solid #1C3F6E;
            font-size: 9px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #1C3F6E;
            color: white;
            padding: 6px 4px;
            text-align: left;
            font-size: 8px;
            border: 1px solid #1e40af;
        }
        td {
            padding: 5px 4px;
            border: 1px solid #ddd;
            font-size: 8px;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .no-timeout {
            background-color: #fef3c7;
        }
        .branch-section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .branch-header {
            margin: 12px 0 6px 0;
            color: #1e40af;
            font-size: 11px;
            font-weight: bold;
            padding: 4px 0;
            border-bottom: 1px solid #1C3F6E;
        }
        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 7px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/logo_2.png') }}" alt="C & K Home Nursing and Care Center Logo" class="logo">
        <h1>C & K Home Nursing and Care Center - Visitor Log Report</h1>
        @if($branch_name)
            <p>Branch: {{ $branch_name }}</p>
        @endif
        <p>Period: {{ $date_from }} - {{ $date_to }}</p>
        <p>Generated on: {{ $generated_at }}</p>
    </div>

    <div class="summary">
        <strong>Summary:</strong>
        Total Visitors: <strong>{{ $logs->count() }}</strong> |
        Completed Visits: <strong>{{ $logs->whereNotNull('time_out')->count() }}</strong> |
        Ongoing Visits: <strong>{{ $logs->whereNull('time_out')->count() }}</strong>
    </div>

    @php
        $groupedByBranch = $logs->groupBy('branch_id');
    @endphp

    @foreach($groupedByBranch as $branchId => $branchLogs)
        <div class="branch-section">
            @if($branchLogs->first()->branch)
                <div class="branch-header">
                    {{ $branchLogs->first()->branch->name }}
                    ({{ $branchLogs->count() }} {{ $branchLogs->count() === 1 ? 'visitor' : 'visitors' }})
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">Date</th>
                        <th style="width: 18%;">Visitor Name</th>
                        <th style="width: 12%;">Contact</th>
                        <th style="width: 20%;">Purpose</th>
                        <th style="width: 8%;">Time In</th>
                        <th style="width: 8%;">Time Out</th>
                        <th style="width: 7%;">Duration</th>
                        <th style="width: 17%;">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branchLogs as $log)
                        <tr class="{{ !$log->time_out ? 'no-timeout' : '' }}">
                            <td>{{ $log->visit_date->format('M d, Y') }}</td>
                            <td>{{ $log->visitor_name }}</td>
                            <td>{{ $log->visitor_contact ?? '-' }}</td>
                            <td>{{ $log->purpose }}</td>
                            <td>{{ $log->time_in->format('H:i') }}</td>
                            <td>{{ $log->time_out ? $log->time_out->format('H:i') : 'Ongoing' }}</td>
                            <td>
                                @if($log->total_hours)
                                    {{ number_format($log->total_hours, 1) }}h
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $log->notes ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <div class="footer">
        <p>This report was generated by C & K Home Nursing and Care Center Management System</p>
        <p>© {{ date('Y') }} C & K Home Nursing and Care Center. All rights reserved.</p>
        <p><strong>Note:</strong> Rows highlighted in yellow indicate ongoing visits without time out.</p>
    </div>
</body>
</html>
