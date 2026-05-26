<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $user = auth()->user();

        $tabs = [
            'all' => Tab::make('All Users')
                ->badge(function () {
                    $query = UserResource::getEloquentQuery();
                    return $query->count();
                }),
        ];

        // Admin tab - only visible to Admins
        if ($user->isAdmin()) {
            $tabs['admin'] = Tab::make('Admins')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', fn ($q) => $q->where('name', 'admin')))
                ->badge(function () {
                    return UserResource::getEloquentQuery()
                        ->whereHas('roles', fn ($q) => $q->where('name', 'admin'))
                        ->count();
                })
                ->badgeColor('danger');
        }

        // Manager tab
        $tabs['manager'] = Tab::make('Managers')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', fn ($q) => $q->where('name', 'manager')))
            ->badge(function () {
                return UserResource::getEloquentQuery()
                    ->whereHas('roles', fn ($q) => $q->where('name', 'manager'))
                    ->count();
            })
            ->badgeColor('warning');

        // Career tab
        $tabs['career'] = Tab::make('Careers')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', fn ($q) => $q->where('name', 'career')))
            ->badge(function () {
                return UserResource::getEloquentQuery()
                    ->whereHas('roles', fn ($q) => $q->where('name', 'career'))
                    ->count();
            })
            ->badgeColor('success');

        // Chef tab
        $tabs['chef'] = Tab::make('Chefs')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', fn ($q) => $q->where('name', 'chef')))
            ->badge(function () {
                return UserResource::getEloquentQuery()
                    ->whereHas('roles', fn ($q) => $q->where('name', 'chef'))
                    ->count();
            })
            ->badgeColor('info');

        // User tab
        $tabs['user'] = Tab::make('Users')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', fn ($q) => $q->where('name', 'user')))
            ->badge(function () {
                return UserResource::getEloquentQuery()
                    ->whereHas('roles', fn ($q) => $q->where('name', 'user'))
                    ->count();
            })
            ->badgeColor('gray');

        return $tabs;
    }
}
