<?php

namespace App\Filament\Resources\VisitorLogResource\Pages;

use App\Filament\Resources\VisitorLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVisitorLog extends CreateRecord
{
    protected static string $resource = VisitorLogResource::class;

    /**
     * Auto-fill the created_by field with the current user
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }
}
