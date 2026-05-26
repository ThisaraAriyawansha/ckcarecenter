<?php

namespace App\Filament\Resources\CareHomeResource\Pages;

use App\Filament\Resources\CareHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareHome extends EditRecord
{
    protected static string $resource = CareHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
