<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chef Checklist - {{ $checklist->date->format('M d, Y') }}</title>
    <style>
        @page {
            size: portrait;
            margin: 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #007bff;
        }

        .header .subtitle {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .info-section {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }

        .info-row {
            display: inline-block;
            margin-right: 30px;
            margin-bottom: 5px;
        }

        .info-label {
            font-weight: bold;
            color: #555;
        }

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .section-title {
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 10px;
            border-radius: 3px;
        }

        .tasks-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .tasks-table tr {
            border-bottom: 1px solid #ddd;
        }

        .tasks-table td {
            padding: 8px 5px;
        }

        .tasks-table td:first-child {
            width: 30px;
            text-align: center;
        }

        .checkbox {
            width: 16px;
            height: 16px;
            border: 2px solid #333;
            display: inline-block;
            position: relative;
            vertical-align: middle;
            background-color: white;
        }

        .checkbox.checked {
            background-color: #28a745;
            border-color: #28a745;
        }

        .checkbox.checked::after {
            content: 'X';
            position: absolute;
            top: -1px;
            left: 3px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .signature-section {
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-box {
            display: inline-block;
            width: 48%;
            vertical-align: top;
            margin-right: 2%;
            border: 2px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }

        .signature-box:last-child {
            margin-right: 0;
        }

        .signature-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 10px;
            color: #007bff;
        }

        .signature-status {
            font-size: 13px;
            padding: 5px 10px;
            border-radius: 3px;
            display: inline-block;
            margin-bottom: 8px;
        }

        .signature-status.signed {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .signature-status.unsigned {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .signature-line {
            border-top: 2px solid #333;
            margin-top: 40px;
            padding-top: 5px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .notes-section {
            border: 1px solid #ddd;
            padding: 12px;
            background-color: #fffef7;
            border-radius: 5px;
            margin-top: 15px;
        }

        .notes-title {
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }

        .notes-content {
            font-size: 11px;
            line-height: 1.6;
            color: #333;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #999;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        @if(file_exists(public_path('logo/care365.svg')))
        <div style="margin-bottom: 15px;">
            <img src="{{ public_path('logo/care365.svg') }}" alt="Care365 Logo" style="height: 60px; width: auto;">
        </div>
        @endif
        <h1>COOKING ASSISTANT CHECKLIST</h1>
        <div class="subtitle">Daily Task Completion Report</div>
    </div>

    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Chef:</span> {{ $checklist->chef->name }}
        </div>
        <div class="info-row">
            <span class="info-label">Date:</span> {{ $checklist->date->format('l, F d, Y') }}
        </div>
        <div class="info-row">
            <span class="info-label">Month:</span> {{ $checklist->month }}
        </div>
        <div class="info-row">
            <span class="info-label">Week:</span> {{ $checklist->week_number }}
        </div>
    </div>

    <!-- DINING TASKS -->
    <div class="section">
        <div class="section-title">Daily Tasks - DINING</div>
        <table class="tasks-table">
            @foreach([
                'wipe_table' => 'Wipe down table & chairs',
                'sweep_floor' => 'Sweep/ Vacuum floor',
                'clean_windows' => 'Clean windows',
                'clean_baseboards' => 'Clean baseboards',
                'set_table' => 'Set table',
            ] as $key => $task)
            <tr>
                <td>
                    <div class="checkbox {{ in_array($key, $checklist->dining_tasks ?? []) ? 'checked' : '' }}"></div>
                </td>
                <td>{{ $task }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- KITCHEN & DINNING TASKS -->
    <div class="section">
        <div class="section-title">Daily Tasks - KITCHEN & DINNING</div>
        <table class="tasks-table">
            @foreach([
                'clean_kitchen' => 'Clean kitchen after food preparation',
                'vacuum_spills' => 'VACUUM / Mop up spills',
                'wash_dishes' => 'Wash Dishes',
                'laundry' => 'Do laundry & put away cloths',
                'take_trash' => 'Take out trash',
                'make_bed' => 'Make & change bed as needed',
                'wipe_bathroom' => 'Wipe down bathroom sink & shower',
                'clean_appliances' => 'Clean refrigerator/Toaster/Etc',
                'sanitize_switch' => 'Sanitize light switch',
                'mail_bills' => 'RETRIEVE mail & help with bill payments',
            ] as $key => $task)
            <tr>
                <td>
                    <div class="checkbox {{ in_array($key, $checklist->kitchen_dinning_tasks ?? []) ? 'checked' : '' }}"></div>
                </td>
                <td>{{ $task }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- BATHROOMS TASKS -->
    <div class="section">
        <div class="section-title">Daily Tasks - BATHROOMS</div>
        <table class="tasks-table">
            @foreach([
                'clean_windows_mirror' => 'Clean Windows / mirror',
                'dust_surface' => 'Dust & wipe surface',
                'empty_trash' => 'Empty Trash',
                'make_bed' => 'Make bed',
                'flip_mattress' => 'Flip rotate mattress',
            ] as $key => $task)
            <tr>
                <td>
                    <div class="checkbox {{ in_array($key, $checklist->bathroom_tasks ?? []) ? 'checked' : '' }}"></div>
                </td>
                <td>{{ $task }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- COMMON AREAS TASKS -->
    <div class="section">
        <div class="section-title">Daily Tasks - COMMON AREAS</div>
        <table class="tasks-table">
            @foreach([
                'clean_drains' => 'Clean drains',
                'sanitize_basin' => 'Sanitize Wash basin/toilet',
                'clean_fixtures' => 'Dust & wipe down light fixtures / ceiling fans',
                'sweep_mop' => 'Sweep & mop floors / Clean mirrors',
                'vacuum_corners' => 'Vacuum under furniture and in corners',
                'tv_lobby' => 'TV Lobby / Stair Case / Book Shelves /Pic Frames',
                'garden_outside' => 'Garden /Outside & other service Areas',
                'reports' => 'Reports / Day end sharing to admin group',
            ] as $key => $task)
            <tr>
                <td>
                    <div class="checkbox {{ in_array($key, $checklist->common_area_tasks ?? []) ? 'checked' : '' }}"></div>
                </td>
                <td>{{ $task }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- NOTES -->
    @if($checklist->notes)
    <div class="notes-section">
        <div class="notes-title">Additional Notes:</div>
        <div class="notes-content">{{ $checklist->notes }}</div>
    </div>
    @endif

    <!-- SIGNATURES -->
    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-title">Chef Signature</div>
            <div class="signature-status {{ $checklist->chef_signed ? 'signed' : 'unsigned' }}">
                @if($checklist->chef_signed)
                    [YES] SIGNED
                @else
                    [NO] NOT SIGNED
                @endif
            </div>
            @if($checklist->chef_signed && $checklist->chef_signed_at)
            <div style="font-size: 10px; color: #666; margin-top: 5px;">
                Signed at: {{ $checklist->chef_signed_at->format('M d, Y H:i') }}
            </div>
            @endif
            <div class="signature-line">Chef: {{ $checklist->chef->name }}</div>
        </div>

        <div class="signature-box">
            <div class="signature-title">Manager Signature</div>
            <div class="signature-status {{ $checklist->manager_signed ? 'signed' : 'unsigned' }}">
                @if($checklist->manager_signed)
                    [YES] APPROVED
                @else
                    [NO] PENDING
                @endif
            </div>
            @if($checklist->manager_signed && $checklist->manager_signed_at)
            <div style="font-size: 10px; color: #666; margin-top: 5px;">
                Approved at: {{ $checklist->manager_signed_at->format('M d, Y H:i') }}
            </div>
            @endif
            @if($checklist->manager)
            <div class="signature-line">Manager: {{ $checklist->manager->name }}</div>
            @else
            <div class="signature-line">Manager: ___________________</div>
            @endif
        </div>
    </div>

    <div class="footer">
        Generated on {{ now()->format('F d, Y \a\t H:i') }} | Care365 Management System
    </div>
</body>
</html>
