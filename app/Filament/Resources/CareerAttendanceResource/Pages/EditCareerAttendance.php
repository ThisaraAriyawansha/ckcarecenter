<?php

namespace App\Filament\Resources\CareerAttendanceResource\Pages;

use App\Filament\Resources\CareerAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareerAttendance extends EditRecord
{
    protected static string $resource = CareerAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
