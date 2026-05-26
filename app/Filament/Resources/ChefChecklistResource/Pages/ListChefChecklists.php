<?php

namespace App\Filament\Resources\ChefChecklistResource\Pages;

use App\Filament\Resources\ChefChecklistResource;
use App\Models\ChefChecklist;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListChefChecklists extends ListRecords
{
    protected static string $resource = ChefChecklistResource::class;

    protected function getHeaderActions(): array
    {
        $user = auth()->user();
        $isChef = $user->hasRole('chef') && !$user->hasAnyRole(['admin', 'manager']);

        return [
            Actions\Action::make('today')
                ->label('Today\'s Checklist')
                ->icon('heroicon-o-clipboard-document-check')
                ->color('success')
                ->action(function () {
                    $today = today();
                    $chefId = auth()->id();

                    // Find or create today's checklist
                    $checklist = ChefChecklist::firstOrCreate(
                        [
                            'chef_id' => $chefId,
                            'date' => $today,
                        ],
                        [
                            'week_number' => $today->weekOfMonth,
                            'month' => $today->format('F Y'),
                            'chef_signed' => false,
                            'manager_signed' => false,
                        ]
                    );

                    // Redirect to edit page for today's checklist
                    $this->redirect(ChefChecklistResource::getUrl('edit', ['record' => $checklist->id]));
                })
                ->visible($isChef),

            Actions\CreateAction::make()
                ->label('New Chef Checklist')
                ->visible($isChef), // Only chefs can create new checklists
        ];
    }
}
