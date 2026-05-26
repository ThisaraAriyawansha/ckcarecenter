<?php

namespace App\Filament\Widgets;

use App\Models\ChefChecklist;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ChefChecklistStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = Auth::user();
        $isChef = $user->hasRole('chef') && !$user->hasAnyRole(['admin', 'manager']);

        // If chef, show their stats only
        if ($isChef) {
            $thisMonth = ChefChecklist::where('chef_id', $user->id)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->count();

            $thisSigned = ChefChecklist::where('chef_id', $user->id)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year)
                ->where('chef_signed', true)
                ->count();

            $todayChecklist = ChefChecklist::where('chef_id', $user->id)
                ->whereDate('date', today())
                ->first();

            return [
                Stat::make('This Month Checklists', $thisMonth)
                    ->description('Total checklists this month')
                    ->descriptionIcon('heroicon-m-calendar')
                    ->color('primary'),

                Stat::make('Signed This Month', $thisSigned)
                    ->description('Completed & signed')
                    ->descriptionIcon('heroicon-m-check-circle')
                    ->color('success'),

                Stat::make('Today\'s Checklist', $todayChecklist ? ($todayChecklist->chef_signed ? 'Completed ✓' : 'In Progress') : 'Not Started')
                    ->description($todayChecklist ? $todayChecklist->date->format('M d, Y') : 'Create today\'s checklist')
                    ->descriptionIcon('heroicon-m-clipboard-document-check')
                    ->color($todayChecklist && $todayChecklist->chef_signed ? 'success' : 'warning'),
            ];
        }

        // If manager/admin, show overall stats
        $isManager = $user->hasRole('manager') && !$user->hasRole('admin');
        $branchId = $isManager ? $user->branch_id : null;

        $totalThisMonth = ChefChecklist::when($isManager, function ($query) use ($branchId) {
                $query->whereHas('chef', function ($chefQuery) use ($branchId) {
                    $chefQuery->where('branch_id', $branchId);
                });
            })
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();

        $pendingApproval = ChefChecklist::when($isManager, function ($query) use ($branchId) {
                $query->whereHas('chef', function ($chefQuery) use ($branchId) {
                    $chefQuery->where('branch_id', $branchId);
                });
            })
            ->where('chef_signed', true)
            ->where('manager_signed', false)
            ->count();

        $branchName = $isManager ? $user->branch?->name : null;
        $description = $isManager ? ($branchName . ' branch this month') : 'This month';

        return [
            Stat::make('Total Chef\'s Checklist', $totalThisMonth)
                ->description($description)
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),

            Stat::make('Chef\'s Checklist Pending Approval', $pendingApproval)
                ->description('Needs manager signature')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager', 'chef']);
    }
}
