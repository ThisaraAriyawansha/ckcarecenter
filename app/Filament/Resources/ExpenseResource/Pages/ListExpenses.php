<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use App\Filament\Widgets\ExpenseByUserWidget;
use App\Models\Expense;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use Barryvdh\DomPDF\Facade\Pdf;

class ListExpenses extends ListRecords
{
    protected static string $resource = ExpenseResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            ExpenseByUserWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('download_monthly_report')
                ->label('Download Monthly Report')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->form([
                    Forms\Components\Select::make('month')
                        ->label('Month')
                        ->options([
                            '01' => 'January',
                            '02' => 'February',
                            '03' => 'March',
                            '04' => 'April',
                            '05' => 'May',
                            '06' => 'June',
                            '07' => 'July',
                            '08' => 'August',
                            '09' => 'September',
                            '10' => 'October',
                            '11' => 'November',
                            '12' => 'December',
                        ])
                        ->required()
                        ->default(now()->format('m'))
                        ->native(false),

                    Forms\Components\Select::make('year')
                        ->label('Year')
                        ->options(function () {
                            $years = [];
                            $currentYear = now()->year;
                            for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                                $years[$i] = $i;
                            }
                            return $years;
                        })
                        ->required()
                        ->default(now()->year)
                        ->native(false),

                    Forms\Components\Select::make('branch_id')
                        ->label('Branch (Optional)')
                        ->relationship('branch', 'name', function ($query) {
                            $user = auth()->user();
                            if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                $query->where('id', $user->branch_id);
                            }
                        })
                        ->searchable()
                        ->preload()
                        ->native(false)
                        ->default(function () {
                            $user = auth()->user();
                            if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                return $user->branch_id;
                            }
                            return null;
                        })
                        ->helperText('Leave blank for all branches'),
                ])
                ->action(function (array $data) {
                    $month = $data['month'];
                    $year = $data['year'];
                    $branchId = $data['branch_id'] ?? null;

                    $user = auth()->user();

                    // Build query
                    $query = Expense::with(['branch', 'creator'])
                        ->whereYear('expense_date', $year)
                        ->whereMonth('expense_date', $month);

                    // Apply branch filter
                    if ($branchId) {
                        $query->where('branch_id', $branchId);
                    } elseif ($user->hasRole('manager') && !$user->hasRole('admin')) {
                        $query->where('branch_id', $user->branch_id);
                    }

                    $expenses = $query->orderBy('expense_date', 'asc')->get();

                    // Get branch name
                    $branchName = null;
                    if ($branchId) {
                        $branchName = \App\Models\Branch::find($branchId)?->name;
                    } elseif ($user->hasRole('manager') && !$user->hasRole('admin')) {
                        $branchName = $user->branch?->name;
                    }

                    // Group expenses by category
                    $groupedByCategory = $expenses->groupBy('category');

                    // Calculate category totals
                    $categoryTotals = [];
                    foreach ($groupedByCategory as $category => $categoryExpenses) {
                        $categoryTotals[$category] = $categoryExpenses->sum('amount');
                    }

                    // Calculate overall total
                    $totalExpenses = $expenses->sum('amount');

                    // Month name
                    $monthName = \Carbon\Carbon::create($year, $month, 1)->format('F Y');

                    $pdfData = [
                        'expenses' => $expenses,
                        'groupedByCategory' => $groupedByCategory,
                        'categoryTotals' => $categoryTotals,
                        'totalExpenses' => $totalExpenses,
                        'month' => $monthName,
                        'branch_name' => $branchName,
                        'generated_at' => now()->format('F d, Y H:i'),
                    ];

                    $pdf = Pdf::loadView('pdf.expense-report', $pdfData)
                        ->setPaper('a4', 'portrait');

                    $branchSlug = $branchName ? '_' . str_replace(' ', '_', $branchName) : '';
                    $filename = 'expense_report_' . $year . '_' . $month . $branchSlug . '.pdf';

                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        $filename
                    );
                }),
        ];
    }
}
