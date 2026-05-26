<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\ClientMeal;
use App\Models\ClientDailyChecklist;
use App\Models\CareerAttendance;

class CareerStatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return Auth::user()->hasRole('career');
    }

    protected function getStats(): array
    {
        $user = Auth::user();
        $branchId = $user->branch_id;
        $branchName = $user->branch?->name ?? 'No Branch Assigned';

        // Get analytics data
        $totalClients = Client::where('branch_id', $branchId)->count();

        $mealsRecordedToday = ClientMeal::whereHas('client', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
        ->where('recorded_by', $user->id)
        ->whereDate('meal_date', today())
        ->count();

        $checklistsCompletedToday = ClientDailyChecklist::whereHas('client', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
        ->where('completed_by', $user->id)
        ->whereDate('date', today())
        ->count();

        $myAttendanceThisMonth = CareerAttendance::where('user_id', $user->id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();

        // Previous comparisons
        $mealsYesterday = ClientMeal::whereHas('client', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
        ->where('recorded_by', $user->id)
        ->whereDate('meal_date', today()->subDay())
        ->count();

        $checklistsYesterday = ClientDailyChecklist::whereHas('client', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
        ->where('completed_by', $user->id)
        ->whereDate('date', today()->subDay())
        ->count();

        return [
            Stat::make('Total Clients', $totalClients)
                ->description($branchName)
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info')
                ->chart([10, 15, 20, 22, 25, 28, $totalClients]),

            Stat::make('Meals Recorded Today', $mealsRecordedToday)
                ->description($mealsYesterday > 0 ? $mealsYesterday . ' yesterday' : 'Keep up the good work!')
                ->descriptionIcon($mealsRecordedToday >= $mealsYesterday ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($mealsRecordedToday >= $mealsYesterday ? 'success' : 'warning')
                ->chart([5, 8, 12, 15, 18, 20, $mealsRecordedToday]),

            Stat::make('Checklists Completed Today', $checklistsCompletedToday)
                ->description($checklistsYesterday > 0 ? $checklistsYesterday . ' yesterday' : 'Great job!')
                ->descriptionIcon($checklistsCompletedToday >= $checklistsYesterday ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($checklistsCompletedToday >= $checklistsYesterday ? 'success' : 'warning')
                ->chart([3, 6, 9, 12, 15, 18, $checklistsCompletedToday]),

            Stat::make('Attendance This Month', $myAttendanceThisMonth)
                ->description('Days present')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning')
                ->chart([5, 10, 12, 15, 18, 20, $myAttendanceThisMonth]),
        ];
    }

    protected function getColumns(): int
    {
        return 2; // Display 2 columns on larger screens
    }
}
