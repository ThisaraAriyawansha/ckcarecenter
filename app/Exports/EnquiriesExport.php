<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class EnquiriesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $enquiries;

    public function __construct($enquiries)
    {
        $this->enquiries = $enquiries;
    }

    public function collection()
    {
        return $this->enquiries instanceof Collection
            ? $this->enquiries
            : collect($this->enquiries);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Primary Phone',
            'Alternative Phone',
            'Address',
            'Joining Potential',
            'Status',
            'Follow Up Date',
            'Requirements',
            'Notes',
            'Handled By',
            'Enquiry Date',
            'Last Updated',
        ];
    }

    public function map($enquiry): array
    {
        $priorityLabels = [
            'level_1' => 'Level 1 - High Priority',
            'level_2' => 'Level 2 - Medium Priority',
            'level_3' => 'Level 3 - Low Priority',
            'level_4' => 'Level 4 - Very Low Priority',
        ];

        $statusLabels = [
            'new' => 'New Enquiry',
            'contacted' => 'Contacted',
            'scheduled' => 'Visit Scheduled',
            'converted' => 'Converted to Client',
            'not_interested' => 'Not Interested',
            'follow_up' => 'Follow Up Required',
        ];

        return [
            $enquiry->id,
            $enquiry->name,
            $enquiry->email ?? 'N/A',
            $enquiry->phone,
            $enquiry->alternative_phone ?? 'N/A',
            $enquiry->address ?? 'N/A',
            $priorityLabels[$enquiry->joining_potential] ?? $enquiry->joining_potential,
            $statusLabels[$enquiry->status] ?? $enquiry->status,
            $enquiry->follow_up_date ? \Carbon\Carbon::parse($enquiry->follow_up_date)->format('Y-m-d') : 'Not scheduled',
            $enquiry->requirements ?? 'N/A',
            $enquiry->notes ?? 'N/A',
            $enquiry->handler->name ?? 'Not assigned',
            $enquiry->created_at->format('Y-m-d H:i:s'),
            $enquiry->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563eb'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // ID
            'B' => 25,  // Name
            'C' => 30,  // Email
            'D' => 18,  // Primary Phone
            'E' => 18,  // Alternative Phone
            'F' => 40,  // Address
            'G' => 30,  // Joining Potential
            'H' => 25,  // Status
            'I' => 18,  // Follow Up Date
            'J' => 40,  // Requirements
            'K' => 40,  // Notes
            'L' => 20,  // Handled By
            'M' => 20,  // Enquiry Date
            'N' => 20,  // Last Updated
        ];
    }
}
