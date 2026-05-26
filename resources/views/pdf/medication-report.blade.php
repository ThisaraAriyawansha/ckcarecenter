<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medication Administration Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #2563eb;
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
            font-weight: bold;
        }
        .header p {
            margin: 4px 0;
            font-size: 11px;
            color: #666;
        }
        .info-section {
            background-color: #f0f9ff;
            border-left: 4px solid #2563eb;
            padding: 10px;
            margin-bottom: 15px;
        }
        .info-row {
            display: inline-block;
            width: 48%;
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            color: #1e40af;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #2563eb;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-size: 10px;
            border: 1px solid #1e40af;
            font-weight: bold;
        }
        td {
            padding: 6px;
            border: 1px solid #ddd;
            font-size: 9px;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .status-given {
            background-color: #d1fae5;
            color: #065f46;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }
        .status-not-given {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }
        .time-badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            font-size: 8px;
        }
        .time-morning {
            background-color: #fef3c7;
            color: #92400e;
        }
        .time-afternoon {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .time-evening {
            background-color: #d1fae5;
            color: #065f46;
        }
        .summary {
            margin-top: 15px;
            padding: 10px;
            background-color: #f0fdf4;
            border-left: 4px solid #22c55e;
        }
        .summary-item {
            display: inline-block;
            width: 32%;
            margin-bottom: 5px;
        }
        .summary-label {
            font-weight: bold;
            color: #166534;
        }
        .summary-value {
            font-size: 14px;
            font-weight: bold;
            color: #15803d;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .date-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .date-header {
            background-color: #f0f9ff;
            padding: 10px;
            margin-bottom: 15px;
            border-left: 5px solid #2563eb;
            border-radius: 4px;
        }
        .date-title {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        .date-summary {
            font-size: 10px;
            color: #64748b;
        }
        .client-section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .client-header {
            background-color: #eff6ff;
            padding: 8px;
            margin-bottom: 10px;
            border-left: 4px solid #3b82f6;
        }
        .client-name {
            font-size: 12px;
            font-weight: bold;
            color: #1e40af;
        }
        .client-info {
            font-size: 9px;
            color: #64748b;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/care365.svg') }}" alt="Care365 Logo" class="logo">
        <h1>MEDICATION ADMINISTRATION REPORT</h1>
        <p>{{ $report_title }}</p>
        <p>Generated on: {{ $generated_at }}</p>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Date:</span> {{ $date }}
        </div>
        @if($client_name)
        <div class="info-row">
            <span class="info-label">Client:</span> {{ $client_name }}
        </div>
        @endif
        @if($branch_name)
        <div class="info-row">
            <span class="info-label">Branch:</span> {{ $branch_name }}
        </div>
        @endif
        <div class="info-row">
            <span class="info-label">Time Filter:</span> {{ ucfirst($time_filter) }}
        </div>
    </div>

    @if($records->isEmpty())
        <div style="text-align: center; padding: 30px; background-color: #f9fafb; border-radius: 8px;">
            <p style="font-size: 14px; color: #6b7280;">No medication records found for the selected date and filters.</p>
        </div>
    @else
        @php
            $groupedByDate = $records->groupBy('date');
        @endphp

        @foreach($groupedByDate as $date => $dateRecords)
            <div class="date-section">
                <div class="date-header">
                    <div class="date-title">{{ \Carbon\Carbon::parse($date)->format('F d, Y') }}</div>
                    <div class="date-summary">
                        @php
                            $dateTotalMeds = $dateRecords->count();
                            $dateGivenMeds = $dateRecords->where('given', true)->count();
                            $datePendingMeds = $dateTotalMeds - $dateGivenMeds;
                        @endphp
                        Total Medications: {{ $dateTotalMeds }} |
                        Given: <span style="color: #22c55e; font-weight: bold;">{{ $dateGivenMeds }}</span> |
                        Pending: <span style="color: #ef4444; font-weight: bold;">{{ $datePendingMeds }}</span> |
                        Compliance: <strong>{{ $dateTotalMeds > 0 ? round(($dateGivenMeds / $dateTotalMeds) * 100, 1) : 0 }}%</strong>
                    </div>
                </div>

                @php
                    $groupedByClient = $dateRecords->groupBy('client.name');
                @endphp

                @foreach($groupedByClient as $clientName => $clientRecords)
                    <div class="client-section">
                        <div class="client-header">
                            <div class="client-name">{{ $clientName }}</div>
                            <div class="client-info">
                                @php
                                    $client = $clientRecords->first()->client;
                                    $totalMeds = $clientRecords->count();
                                    $givenMeds = $clientRecords->where('given', true)->count();
                                @endphp
                                Branch: {{ $client->branch?->name ?? 'N/A' }} |
                                Total Medications: {{ $totalMeds }} |
                                Given: {{ $givenMeds }} |
                                Pending: {{ $totalMeds - $givenMeds }}
                            </div>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Medication</th>
                                    <th style="width: 12%;">Dosage</th>
                                    <th style="width: 10%;">Time</th>
                                    <th style="width: 12%;">Status</th>
                                    <th style="width: 18%;">Given By</th>
                                    <th style="width: 12%;">Time Given</th>
                                    <th style="width: 16%;">Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientRecords as $record)
                                    <tr>
                                        <td>
                                            <strong>{{ $record->medication->drug_name }}</strong>
                                            @if($record->medication->type)
                                                <br><small style="color: #64748b;">{{ ucfirst($record->medication->type) }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $record->medication->dosage }}</td>
                                        <td>
                                            <span class="time-badge time-{{ $record->time_of_day }}">
                                                {{ ucfirst($record->time_of_day) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($record->given)
                                                <span class="status-given">✓ Given</span>
                                            @else
                                                <span class="status-not-given">✗ Not Given</span>
                                            @endif
                                        </td>
                                        <td>{{ $record->givenByUser?->name ?? '-' }}</td>
                                        <td>{{ $record->given_at ? \Carbon\Carbon::parse($record->given_at)->format('H:i') : '-' }}</td>
                                        <td>{{ $record->medication->notes ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div class="summary">
            <h3 style="margin-top: 0; color: #166534; font-size: 12px;">Overall Summary</h3>
            <div class="summary-item">
                <span class="summary-label">Total Records:</span>
                <span class="summary-value">{{ $total_records }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Given:</span>
                <span class="summary-value" style="color: #22c55e;">{{ $total_given }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Pending:</span>
                <span class="summary-value" style="color: #ef4444;">{{ $total_pending }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Compliance Rate:</span>
                <span class="summary-value">{{ $compliance_rate }}%</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Total Clients:</span>
                <span class="summary-value">{{ $records->pluck('client.name')->unique()->count() }}</span>
            </div>
        </div>
    @endif

    <div class="footer">
        <p><strong>CARE 365 Management System</strong> - Medication Administration Report</p>
        <p>© {{ date('Y') }} CARE 365. All rights reserved.</p>
        <p style="margin-top: 5px;"><em>This report is generated electronically and contains sensitive patient information. Please handle with care.</em></p>
    </div>
</body>
</html>
