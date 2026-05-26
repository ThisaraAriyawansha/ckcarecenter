<?php

namespace App\Filament\Resources\DayPackageResource\Pages;

use App\Filament\Resources\DayPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDayPackage extends EditRecord
{
    protected static string $resource = DayPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
