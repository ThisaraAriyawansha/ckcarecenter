<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Checklist Report</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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
        .completed {
            color: #10b981;
            font-weight: bold;
        }
        .pending {
            color: #ef4444;
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
        .summary {
            margin: 15px 0;
            padding: 10px;
            background-color: #f0f9ff;
            border-left: 4px solid #2563eb;
        }
        .category-badge {
            display: inline-block;
            padding: 2px 6px;
            background-color: #dbeafe;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/care365.svg') }}" alt="Care365 Logo" class="logo">
        <h1>CARE 365 - Daily Checklist Report</h1>
        <p>Generated on: {{ $generated_at }}</p>
        @if($records->count() > 0)
            <p>Period: {{ $records->min('date')->format('M d, Y') }} - {{ $records->max('date')->format('M d, Y') }}</p>
        @endif
        <p>Total Records: {{ $records->count() }}</p>
    </div>

    @php
        $groupedByClient = $records->groupBy('client_id');
        $totalCompleted = $records->where('completed', true)->count();
        $totalPending = $records->where('completed', false)->count();
        $completionRate = $records->count() > 0 ? round(($totalCompleted / $records->count()) * 100, 1) : 0;
    @endphp

    <div class="summary">
        <strong>Summary:</strong>
        Completed: <span class="completed">{{ $totalCompleted }}</span> |
        Pending: <span class="pending">{{ $totalPending }}</span> |
        Completion Rate: <strong>{{ $completionRate }}%</strong>
    </div>

    @foreach($groupedByClient as $clientId => $clientRecords)
        @php
            $client = $clientRecords->first()->client;
            $clientCompleted = $clientRecords->where('completed', true)->count();
            $clientTotal = $clientRecords->count();
            $clientRate = round(($clientCompleted / $clientTotal) * 100, 1);
        @endphp

        <h3 style="margin-top: 20px; color: #1e40af; font-size: 12px;">
            {{ $client->name }} ({{ $client->reg_number }}) - {{ $client->branch->name ?? 'N/A' }}
        </h3>
        <p style="font-size: 9px; margin: 5px 0;">
            Completed: {{ $clientCompleted }}/{{ $clientTotal }} ({{ $clientRate }}%)
        </p>

        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">Date</th>
                    <th style="width: 8%;">Day</th>
                    <th style="width: 18%;">Category</th>
                    <th style="width: 32%;">Task</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 12%;">Completed By</th>
                    <th style="width: 10%;">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientRecords->sortBy('date') as $record)
                <tr>
                    <td>{{ $record->date->format('M d, Y') }}</td>
                    <td>{{ $record->day_of_week }}</td>
                    <td><span class="category-badge">{{ $record->category }}</span></td>
                    <td>{{ $record->task_name }}</td>
                    <td class="{{ $record->completed ? 'completed' : 'pending' }}">
                        {{ $record->completed ? 'Done' : 'Pending' }}
                    </td>
                    <td>{{ $record->completedBy->name ?? '-' }}</td>
                    <td>{{ $record->completed_at ? $record->completed_at->format('H:i') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="footer">
        <p>This report was generated by CARE 365 Management System</p>
        <p>© {{ date('Y') }} CARE 365. All rights reserved.</p>
    </div>
</body>
</html>
