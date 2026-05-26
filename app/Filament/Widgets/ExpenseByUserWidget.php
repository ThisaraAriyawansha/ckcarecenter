<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ExpenseByUserWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $authUser = auth()->user();

        $query = Expense::query()
            ->with('user')
            ->whereNotNull('user_id')
            ->selectRaw('user_id, SUM(amount) as total')
            ->groupBy('user_id');

        if ($authUser->hasRole('manager') && !$authUser->hasRole('admin')) {
            $query->where('branch_id', $authUser->branch_id);
        }

        $results = $query->get();

        if ($results->isEmpty()) {
            return [
                Stat::make('Spent by User', 'No data')
                    ->description('No expenses linked to users yet')
                    ->color('gray'),
            ];
        }

        return $results->map(function ($row) {
            $name = $row->user?->name ?? 'Unknown';
            $total = number_format($row->total, 2);

            return Stat::make($name, 'LKR ' . $total)
                ->description('Total expenses')
                ->color('warning')
                ->icon('heroicon-o-banknotes');
        })->toArray();
    }
}
