<?php

namespace App\Filament\Resources\CareHomeResource\Pages;

use App\Filament\Resources\CareHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareHomes extends ListRecords
{
    protected static string $resource = CareHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
