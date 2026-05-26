<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Handle the record creation and assign role
     */
    protected function afterCreate(): void
    {
        $role = $this->data['role'] ?? null;

        if ($role) {
            $this->record->syncRoles([$role]);
        }
    }
}
