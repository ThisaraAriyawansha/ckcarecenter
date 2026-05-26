<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Branch;

class BranchClientsChart extends ChartWidget
{
    protected static ?string $heading = 'Clients by Branch';

    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    protected function getData(): array
    {
        $branches = Branch::where('is_active', true)
            ->withCount('clients')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Clients per Branch',
                    'data' => $branches->pluck('clients_count')->toArray(),
                    'backgroundColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(139, 92, 246)',
                        'rgb(251, 146, 60)',
                        'rgb(236, 72, 153)',
                        'rgb(14, 165, 233)',
                    ],
                ],
            ],
            'labels' => $branches->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
