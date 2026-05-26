<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        $user = auth()->user();

        // Show admin widgets for admin and manager users
        if ($user && $user->hasAnyRole(['admin', 'manager'])) {
            return [
                \App\Filament\Widgets\AdminStatsOverviewWidget::class,
                \App\Filament\Widgets\AttendancePendingApprovalWidget::class,
                \App\Filament\Widgets\BranchClientsChart::class,
                \App\Filament\Widgets\ClientDemographicsChart::class,
            ];
        }

        // Show career widgets for career users
        if ($user && $user->hasRole('career')) {
            return [
                \App\Filament\Widgets\CareerStatsOverviewWidget::class,
            ];
        }

        // Show chef widgets for chef users
        if ($user && $user->hasRole('chef')) {
            return [
                \App\Filament\Widgets\ChefChecklistStatsWidget::class,
            ];
        }

        // Default to no widgets if no role matched
        return [];
    }
}
