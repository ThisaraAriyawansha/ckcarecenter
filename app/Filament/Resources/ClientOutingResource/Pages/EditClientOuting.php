<?php

namespace App\Filament\Resources\ClientOutingResource\Pages;

use App\Filament\Resources\ClientOutingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientOuting extends EditRecord
{
    protected static string $resource = ClientOutingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
