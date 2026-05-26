<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Client;

class ClientDemographicsChart extends ChartWidget
{
    protected static ?string $heading = 'Client Demographics';

    protected static ?int $sort = 3;

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    protected function getData(): array
    {
        $maleClients = Client::where('gender', 'male')->count();
        $femaleClients = Client::where('gender', 'female')->count();
        $otherClients = Client::where('gender', 'other')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Client Distribution',
                    'data' => [$maleClients, $femaleClients, $otherClients],
                    'backgroundColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(236, 72, 153)',
                        'rgb(156, 163, 175)',
                    ],
                ],
            ],
            'labels' => ['Male', 'Female', 'Other'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
