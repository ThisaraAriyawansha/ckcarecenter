<?php

namespace App\Filament\Resources\DailyChecklistReportResource\Pages;

use App\Filament\Resources\DailyChecklistReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyChecklistReports extends ListRecords
{
    protected static string $resource = DailyChecklistReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
