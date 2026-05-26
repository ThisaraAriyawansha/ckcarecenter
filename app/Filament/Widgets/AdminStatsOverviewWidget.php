<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Client;
use App\Models\User;
use App\Models\Branch;
use App\Models\CareerAttendance;
use App\Models\ClientMeal;
use App\Models\ClientDailyChecklist;
use App\Models\Medication;
use App\Models\Payment;

class AdminStatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

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
        $user = auth()->user();
        $isManager = $user->hasRole('manager') && !$user->hasRole('admin');
        $branchId = $isManager ? $user->branch_id : null;

        // Overall Statistics
        $totalClients = $isManager
            ? Client::where('branch_id', $branchId)->count()
            : Client::count();

        $totalBranches = Branch::where('is_active', true)->count();

        $totalCarers = User::whereHas('roles', function ($query) {
            $query->where('name', 'career');
        })
        ->when($isManager, function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
        ->count();

        // Today's Activity
        $mealsRecordedToday = ClientMeal::when($isManager, function ($query) use ($branchId) {
            $query->whereHas('client', function ($clientQuery) use ($branchId) {
                $clientQuery->where('branch_id', $branchId);
            });
        })
        ->whereDate('meal_date', today())
        ->count();

        $checklistsCompletedToday = ClientDailyChecklist::when($isManager, function ($query) use ($branchId) {
            $query->whereHas('client', function ($clientQuery) use ($branchId) {
                $clientQuery->where('branch_id', $branchId);
            });
        })
        ->whereDate('date', today())
        ->count();

        $attendanceMarkedToday = CareerAttendance::when($isManager, function ($query) use ($branchId) {
            $query->whereHas('user', function ($userQuery) use ($branchId) {
                $userQuery->where('branch_id', $branchId);
            });
        })
        ->whereDate('date', today())
        ->count();

        // This Month Statistics
        $newClientsThisMonth = Client::when($isManager, function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

        $totalPaymentsThisMonth = Payment::when($isManager, function ($query) use ($branchId) {
            $query->whereHas('client', function ($clientQuery) use ($branchId) {
                $clientQuery->where('branch_id', $branchId);
            });
        })
        ->whereMonth('payment_date', now()->month)
        ->whereYear('payment_date', now()->year)
        ->sum('amount');

        $activeMedications = Medication::when($isManager, function ($query) use ($branchId) {
            $query->whereHas('client', function ($clientQuery) use ($branchId) {
                $clientQuery->where('branch_id', $branchId);
            });
        })
        ->where('is_active', true)
        ->count();

        // Previous month comparisons
        $clientsLastMonth = Client::when($isManager, function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })
        ->whereMonth('created_at', now()->subMonth()->month)
        ->whereYear('created_at', now()->subMonth()->year)
        ->count();

        $paymentsLastMonth = Payment::when($isManager, function ($query) use ($branchId) {
            $query->whereHas('client', function ($clientQuery) use ($branchId) {
                $clientQuery->where('branch_id', $branchId);
            });
        })
        ->whereMonth('payment_date', now()->subMonth()->month)
        ->whereYear('payment_date', now()->subMonth()->year)
        ->sum('amount');

        // Get branch name for managers
        $branchName = $isManager ? $user->branch?->name : null;

        $stats = [
            Stat::make('Total Clients', $totalClients)
                ->description($isManager ? $branchName . ' branch' : 'Registered in system')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart([7, 12, 15, 18, 22, 25, $totalClients]),
        ];

        // Only show Active Branches for admins
        if (!$isManager) {
            $stats[] = Stat::make('Active Branches', $totalBranches)
                ->description('Operating locations')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info')
                ->chart([3, 4, 5, 5, 6, 6, $totalBranches]);
        }

        $stats[] = Stat::make('Total Carers', $totalCarers)
            ->description($isManager ? 'In your branch' : 'Active staff members')
            ->descriptionIcon('heroicon-m-users')
            ->color('warning')
            ->chart([10, 12, 15, 18, 20, 22, $totalCarers]);

        $stats[] = Stat::make('New Clients This Month', $newClientsThisMonth)
            ->description($clientsLastMonth > 0 ? ($newClientsThisMonth > $clientsLastMonth ? 'Increase from last month' : 'Decrease from last month') : 'First month')
            ->descriptionIcon($newClientsThisMonth > $clientsLastMonth ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
            ->color($newClientsThisMonth > $clientsLastMonth ? 'success' : 'danger')
            ->chart([2, 3, 4, 5, 6, 7, $newClientsThisMonth]);

        $stats[] = Stat::make('Meals Recorded Today', $mealsRecordedToday)
            ->description('Meal entries logged')
            ->descriptionIcon('heroicon-m-shopping-cart')
            ->color('success')
            ->chart([10, 15, 20, 25, 30, 35, $mealsRecordedToday]);

        $stats[] = Stat::make('Career Checklists Completed Today', $checklistsCompletedToday)
            ->description('Daily checks done')
            ->descriptionIcon('heroicon-m-clipboard-document-check')
            ->color('info')
            ->chart([5, 10, 15, 20, 25, 30, $checklistsCompletedToday]);

        $stats[] = Stat::make('Attendance Marked Today', $attendanceMarkedToday)
            ->description('Staff check-ins')
            ->descriptionIcon('heroicon-m-clock')
            ->color('warning')
            ->chart([8, 12, 15, 18, 20, 22, $attendanceMarkedToday]);

        // Only show Total Payments for admins
        if (!$isManager) {
            $stats[] = Stat::make('Total Payments This Month', 'LKR ' . number_format($totalPaymentsThisMonth, 2))
                ->description($paymentsLastMonth > 0 ? 'LKR ' . number_format($paymentsLastMonth, 2) . ' last month' : 'Revenue collected')
                ->descriptionIcon($totalPaymentsThisMonth > $paymentsLastMonth ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($totalPaymentsThisMonth > $paymentsLastMonth ? 'success' : 'danger')
                ->chart([1000, 2000, 3000, 4000, 5000, 6000, $totalPaymentsThisMonth]);
        }

        $stats[] = Stat::make('Active Medications', $activeMedications)
            ->description('Currently prescribed')
            ->descriptionIcon('heroicon-m-beaker')
            ->color('danger')
            ->chart([20, 25, 30, 35, 40, 45, $activeMedications]);

        return $stats;
    }
}
