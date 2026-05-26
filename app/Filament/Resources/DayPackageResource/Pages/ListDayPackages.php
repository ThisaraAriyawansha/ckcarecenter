<?php

namespace App\Filament\Resources\DayPackageResource\Pages;

use App\Filament\Resources\DayPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDayPackages extends ListRecords
{
    protected static string $resource = DayPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
