<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Details - {{ $enquiry->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            color: #2563eb;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #6b7280;
        }

        .enquiry-info {
            margin-bottom: 20px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 3px;
        }

        .info-label {
            display: table-cell;
            font-weight: bold;
            width: 180px;
            padding: 8px;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
        }

        .info-value {
            display: table-cell;
            padding: 8px;
            border: 1px solid #e5e7eb;
            border-left: none;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e5e7eb;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-gray {
            background-color: #f3f4f6;
            color: #374151;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-primary {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .notes-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 12px;
            border-radius: 4px;
            min-height: 80px;
            margin-top: 5px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }

        .meta-info {
            margin-top: 30px;
            padding: 10px;
            background-color: #f9fafb;
            border-radius: 4px;
        }

        .meta-info p {
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 3px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ENQUIRY DETAILS</h1>
        <p>Care365 Management System</p>
    </div>

    <!-- Contact Information Section -->
    <div class="section">
        <div class="section-title">Contact Information</div>
        <div class="enquiry-info">
            <div class="info-row">
                <div class="info-label">Full Name</div>
                <div class="info-value">{{ $enquiry->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email Address</div>
                <div class="info-value">{{ $enquiry->email ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Primary Phone</div>
                <div class="info-value">{{ $enquiry->phone }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Alternative Phone</div>
                <div class="info-value">{{ $enquiry->alternative_phone ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Address</div>
                <div class="info-value">{{ $enquiry->address ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Enquiry Details Section -->
    <div class="section">
        <div class="section-title">Enquiry Details</div>
        <div class="enquiry-info">
            <div class="info-row">
                <div class="info-label">Joining Potential</div>
                <div class="info-value">
                    @php
                        $priorityLabels = [
                            'level_1' => 'Level 1 - High Priority',
                            'level_2' => 'Level 2 - Medium Priority',
                            'level_3' => 'Level 3 - Low Priority',
                            'level_4' => 'Level 4 - Very Low Priority',
                        ];
                        $priorityColors = [
                            'level_1' => 'badge-success',
                            'level_2' => 'badge-warning',
                            'level_3' => 'badge-info',
                            'level_4' => 'badge-gray',
                        ];
                    @endphp
                    <span class="badge {{ $priorityColors[$enquiry->joining_potential] ?? 'badge-gray' }}">
                        {{ $priorityLabels[$enquiry->joining_potential] ?? $enquiry->joining_potential }}
                    </span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Status</div>
                <div class="info-value">
                    @php
                        $statusLabels = [
                            'new' => 'New Enquiry',
                            'contacted' => 'Contacted',
                            'scheduled' => 'Visit Scheduled',
                            'converted' => 'Converted to Client',
                            'not_interested' => 'Not Interested',
                            'follow_up' => 'Follow Up Required',
                        ];
                        $statusColors = [
                            'new' => 'badge-info',
                            'contacted' => 'badge-warning',
                            'scheduled' => 'badge-primary',
                            'converted' => 'badge-success',
                            'not_interested' => 'badge-danger',
                            'follow_up' => 'badge-warning',
                        ];
                    @endphp
                    <span class="badge {{ $statusColors[$enquiry->status] ?? 'badge-gray' }}">
                        {{ $statusLabels[$enquiry->status] ?? $enquiry->status }}
                    </span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Follow Up Date</div>
                <div class="info-value">
                    {{ $enquiry->follow_up_date ? \Carbon\Carbon::parse($enquiry->follow_up_date)->format('F d, Y') : 'Not scheduled' }}
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">Handled By</div>
                <div class="info-value">{{ $enquiry->handler->name ?? 'Not assigned' }}</div>
            </div>
        </div>
    </div>

    <!-- Additional Information Section -->
    <div class="section">
        <div class="section-title">Requirements</div>
        <div class="notes-box">
            {{ $enquiry->requirements ?? 'No requirements specified' }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">Additional Notes</div>
        <div class="notes-box">
            {{ $enquiry->notes ?? 'No additional notes' }}
        </div>
    </div>

    <!-- Meta Information -->
    <div class="meta-info">
        <p><strong>Enquiry ID:</strong> #{{ $enquiry->id }}</p>
        <p><strong>Enquiry Date:</strong> {{ $enquiry->created_at->format('F d, Y h:i A') }}</p>
        <p><strong>Last Updated:</strong> {{ $enquiry->updated_at->format('F d, Y h:i A') }}</p>
        <p><strong>Generated On:</strong> {{ now()->format('F d, Y h:i A') }}</p>
    </div>

    <div class="footer">
        <p>Care365 Management System - Confidential Document</p>
        <p>This document contains sensitive information and should be handled accordingly.</p>
    </div>
</body>
</html>
