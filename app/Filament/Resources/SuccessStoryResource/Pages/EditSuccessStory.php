<?php

namespace App\Filament\Resources\SuccessStoryResource\Pages;

use App\Filament\Resources\SuccessStoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuccessStory extends EditRecord
{
    protected static string $resource = SuccessStoryResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($record) {
                    // Delete old image if new one is uploaded
                    if ($record->image && $this->data['image'] !== $record->image) {
                        \Illuminate\Support\Facades\Storage::disk('success_stories')->delete($record->image);
                    }
                }),
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}