<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\MedicationRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class MedicationChartExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, ShouldAutoSize
{
    protected $clientId;
    protected $month;
    protected $year;

    public function __construct(int $clientId, int $month, int $year)
    {
        $this->clientId = $clientId;
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        $startDate = Carbon::create($this->year, $this->month, 1)->startOfMonth();
        $endDate = Carbon::create($this->year, $this->month, 1)->endOfMonth();

        return MedicationRecord::with(['medication', 'client', 'givenByUser'])
            ->where('client_id', $this->clientId)
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->orderBy('time_of_day')
            ->get();
    }

    public function headings(): array
    {
        $client = Client::find($this->clientId);
        $monthName = Carbon::create($this->year, $this->month, 1)->format('F Y');

        return [
            ["Medication Chart - {$client->name}"],
            ["Month: {$monthName}"],
            ["Reg Number: {$client->reg_number}"],
            [],
            [
                'Date',
                'Day',
                'Medication',
                'Dosage',
                'Time of Day',
                'Given',
                'Given By',
                'Time Given',
                'Notes'
            ]
        ];
    }

    public function map($record): array
    {
        return [
            $record->date->format('Y-m-d'),
            $record->date->format('l'),
            $record->medication->drug_name,
            $record->medication->dosage ?? 'N/A',
            ucfirst($record->time_of_day),
            $record->given ? 'Yes' : 'No',
            $record->givenByUser?->name ?? 'Not given',
            $record->given_at ? $record->given_at->format('H:i') : '-',
            $record->notes ?? '',
        ];
    }

    public function title(): string
    {
        return Carbon::create($this->year, $this->month, 1)->format('F Y');
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 16]],
            2 => ['font' => ['bold' => true]],
            3 => ['font' => ['bold' => true]],
            5 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'color' => ['rgb' => 'E2E8F0']]],
        ];
    }
}
