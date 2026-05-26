<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncome extends ListRecords
{
    protected static string $resource = IncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn () => auth()->user()->hasRole('admin')),
        ];
    }
}
