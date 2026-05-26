<?php

namespace App\Filament\Widgets;

use App\Models\ChefChecklist;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class ChefChecklistQuickActionsWidget extends Widget
{
    protected static string $view = 'filament.widgets.chef-checklist-quick-actions';

    protected static ?int $sort = 2;

    public function getTodayChecklist()
    {
        return ChefChecklist::where('chef_id', Auth::id())
            ->whereDate('date', today())
            ->first();
    }

    public function downloadTodayPdf()
    {
        $checklist = $this->getTodayChecklist();

        if (!$checklist) {
            $checklist = ChefChecklist::create([
                'chef_id' => Auth::id(),
                'date' => today(),
                'week_number' => now()->weekOfMonth,
                'month' => now()->format('F Y'),
                'chef_signed' => false,
                'manager_signed' => false,
            ]);
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.chef-checklist', [
            'checklist' => $checklist
        ]);

        $pdf->setPaper('a4', 'portrait');

        $filename = 'checklist-today-' . now()->format('Y-m-d') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public static function canView(): bool
    {
        $user = auth()->user();
        return $user->hasRole('chef') && !$user->hasAnyRole(['admin', 'manager']);
    }
}
