<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn () => auth()->user()->isAdmin() ||
                    (auth()->user()->isManager() && !$this->record->hasRole('admin'))),
        ];
    }

    /**
     * Handle the record update and sync role
     */
    protected function afterSave(): void
    {
        $role = $this->data['role'] ?? null;

        if ($role) {
            $this->record->syncRoles([$role]);
        }
    }
}
