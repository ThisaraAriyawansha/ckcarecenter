<?php

namespace App\Filament\Resources\WhoweareResource\Pages;

use App\Filament\Resources\WhoweareResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhoweare extends EditRecord
{
    protected static string $resource = WhoweareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
