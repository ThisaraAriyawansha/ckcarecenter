<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        $user = auth()->user();
        $isCareer = $user->hasRole('career') && !$user->hasAnyRole(['admin', 'manager']);

        return [
            Actions\CreateAction::make()
                ->visible(!$isCareer), // Hide from carers
        ];
    }
}
