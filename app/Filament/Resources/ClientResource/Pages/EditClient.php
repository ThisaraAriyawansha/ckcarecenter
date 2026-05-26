<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Form;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        $isCareer = auth()->user()->hasRole('career') && !auth()->user()->hasAnyRole(['admin', 'manager']);

        return [
            Actions\DeleteAction::make()
                ->visible(!$isCareer),
        ];
    }

    public function form(Form $form): Form
    {
        $isCareer = auth()->user()->hasRole('career') && !auth()->user()->hasAnyRole(['admin', 'manager']);

        // If career, disable the entire form
        if ($isCareer) {
            return parent::form($form)->disabled();
        }

        return parent::form($form);
    }

    public function hasCombinedRelationManagerTabsWithForm(): bool
    {
        // Show tabs separately so careers can still access relation managers
        return false;
    }
}
