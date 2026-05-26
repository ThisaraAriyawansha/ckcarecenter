<?php

namespace App\Filament\Resources\ClientOutingResource\Pages;

use App\Filament\Resources\ClientOutingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListClientOutings extends ListRecords
{
    protected static string $resource = ClientOutingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        // Get the parent query
        $query = parent::getTableQuery();

        // Check if date filter is applied
        $filters = $this->tableFilters;

        // If no date filter is set, default to today's outings
        if (empty($filters['date']['from']) && empty($filters['date']['until'])) {
            $query->whereDate('date', today());
        }

        return $query;
    }
}
