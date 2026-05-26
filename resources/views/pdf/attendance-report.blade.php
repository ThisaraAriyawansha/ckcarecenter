<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Monthly Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            color: #333;
            margin: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }
        .header .logo {
            width: 80px;
            height: auto;
            margin-bottom: 5px;
        }
        .header h1 {
            margin: 0;
            font-size: 14px;
            color: #2563eb;
        }
        .header p {
            margin: 3px 0;
            font-size: 9px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        th {
            background-color: #2563eb;
            color: white;
            padding: 4px 2px;
            text-align: left;
            font-size: 7px;
            border: 1px solid #1e40af;
        }
        td {
            padding: 3px 2px;
            border: 1px solid #ddd;
            font-size: 7px;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .absent {
            background-color: #fee2e2 !important;
            font-weight: bold;
            color: #991b1b;
        }
        .present {
            background-color: #d1fae5;
        }
        .weekend {
            background-color: #f3f4f6;
        }
        .summary {
            margin: 5px 0;
            padding: 4px;
            background-color: #f0f9ff;
            border-left: 3px solid #2563eb;
            font-size: 7px;
        }
        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 6px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }
        .status-approved {
            color: #059669;
            font-weight: bold;
        }
        .status-pending {
            color: #d97706;
            font-weight: bold;
        }
        .status-rejected {
            color: #dc2626;
            font-weight: bold;
        }
        .user-section {
            margin-bottom: 12px;
            page-break-inside: avoid;
        }
        .user-header {
            margin: 8px 0 3px 0;
            color: #1e40af;
            font-size: 9px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/care365.svg') }}" alt="Care365 Logo" class="logo">
        <h1>CARE 365 - Monthly Attendance Report</h1>
        <p>Period: {{ $month_name }} {{ $year }}</p>
        <p>Generated on: {{ $generated_at }}</p>
    </div>

    @foreach($report_data as $data)
        <div class="user-section">
            <div class="user-header">
                {{ $data['user']->name }}
                @if($data['user']->branch)
                    - {{ $data['user']->branch->name }}
                @endif
            </div>

            <div class="summary">
                <strong>Summary:</strong>
                Total: {{ count($data['daily_records']) }} days |
                Present: <span style="color: #059669; font-weight: bold;">{{ $data['total_present'] }}</span> |
                Absent: <span style="color: #dc2626; font-weight: bold;">{{ $data['total_absent'] }}</span> |
                Rate: <strong>{{ count($data['daily_records']) > 0 ? round(($data['total_present'] / count($data['daily_records'])) * 100, 1) : 0 }}%</strong>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 6%;">Date</th>
                        <th style="width: 8%;">Day</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 8%;">In</th>
                        <th style="width: 8%;">Out</th>
                        <th style="width: 6%;">Hrs</th>
                        <th style="width: 10%;">Approval</th>
                        <th style="width: 44%;">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['daily_records'] as $record)
                        @php
                            $isWeekend = in_array($record['day_of_week'], ['Saturday', 'Sunday']);
                            $rowClass = '';
                            if (!$record['present']) {
                                $rowClass = 'absent';
                            } elseif ($isWeekend) {
                                $rowClass = 'weekend';
                            } else {
                                $rowClass = 'present';
                            }
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td>{{ $record['date']->format('d') }}</td>
                            <td>{{ substr($record['day_of_week'], 0, 3) }}</td>
                            <td>
                                @if($record['present'])
                                    ✓ P
                                @else
                                    <strong>✗ A</strong>
                                @endif
                            </td>
                            <td>{{ $record['attendance'] ? $record['attendance']->time_in->format('H:i') : '-' }}</td>
                            <td>{{ $record['attendance'] && $record['attendance']->time_out ? $record['attendance']->time_out->format('H:i') : '-' }}</td>
                            <td>{{ $record['attendance'] && $record['attendance']->total_hours ? number_format($record['attendance']->total_hours, 1) : '-' }}</td>
                            <td>
                                @if($record['attendance'])
                                    <span class="status-{{ $record['attendance']->status }}">
                                        {{ substr(ucfirst($record['attendance']->status), 0, 3) }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($record['attendance'])
                                    {{ $record['attendance']->notes ?? '' }}
                                    @if($record['attendance']->manager_notes)
                                        {{ $record['attendance']->notes ? ' | ' : '' }}Mgr: {{ $record['attendance']->manager_notes }}
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <div class="footer">
        <p>This report was generated by CARE 365 Management System</p>
        <p>© {{ date('Y') }} CARE 365. All rights reserved.</p>
        <p><strong>Note:</strong> Red highlighted rows indicate absent days. Weekend days are shown in gray.</p>
    </div>
</body>
</html>
