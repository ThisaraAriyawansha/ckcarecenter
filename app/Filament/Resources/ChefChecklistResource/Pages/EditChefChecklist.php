<?php

namespace App\Filament\Resources\ChefChecklistResource\Pages;

use App\Filament\Resources\ChefChecklistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditChefChecklist extends EditRecord
{
    protected static string $resource = ChefChecklistResource::class;

    protected function getHeaderActions(): array
    {
        $isChef = auth()->user()->hasRole('chef') && !auth()->user()->hasAnyRole(['admin', 'manager']);

        return [
            Actions\DeleteAction::make()
                ->visible(!$isChef),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $isChef = auth()->user()->hasRole('chef') && !auth()->user()->hasAnyRole(['admin', 'manager']);

        // Ensure chef_signed_at is set when chef signs
        if (isset($data['chef_signed']) && $data['chef_signed'] && empty($data['chef_signed_at'])) {
            $data['chef_signed_at'] = now();
        }

        // Ensure manager_signed_at is set when manager signs
        if (isset($data['manager_signed']) && $data['manager_signed'] && empty($data['manager_signed_at'])) {
            $data['manager_signed_at'] = now();
            $data['manager_id'] = auth()->id();
        }

        return $data;
    }

    protected function beforeValidate(): void
    {
        $isChef = auth()->user()->hasRole('chef') && !auth()->user()->hasAnyRole(['admin', 'manager']);

        // Additional validation for chefs
        if ($isChef) {
            $data = $this->form->getState();

            if (!isset($data['chef_signed']) || !$data['chef_signed']) {
                Notification::make()
                    ->title('Signature Required')
                    ->body('You must enable the Chef Signature toggle before saving the checklist.')
                    ->danger()
                    ->send();

                $this->halt();
            }
        }
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Checklist updated successfully!';
    }
}
