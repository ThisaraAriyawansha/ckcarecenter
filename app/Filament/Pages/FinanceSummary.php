<?php

namespace App\Filament\Pages;

use App\Models\Expense;
use App\Models\Payment;
use App\Models\Branch;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;

class FinanceSummary extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Finance Summary';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.finance-summary';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    public function mount(): void
    {
        $user = auth()->user();

        $this->form->fill([
            'month'     => now()->format('m'),
            'year'      => (string) now()->year,
            'branch_id' => ($user->hasRole('manager') && !$user->hasRole('admin'))
                ? $user->branch_id
                : null,
        ]);
    }

    public function form(Form $form): Form
    {
        $user = auth()->user();

        return $form
            ->schema([
                Select::make('month')
                    ->label('Month')
                    ->options([
                        '01' => 'January', '02' => 'February', '03' => 'March',
                        '04' => 'April',   '05' => 'May',       '06' => 'June',
                        '07' => 'July',    '08' => 'August',    '09' => 'September',
                        '10' => 'October', '11' => 'November',  '12' => 'December',
                    ])
                    ->native(false)
                    ->live(),

                Select::make('year')
                    ->label('Year')
                    ->options(function () {
                        $years = [];
                        $current = now()->year;
                        for ($i = $current; $i >= $current - 5; $i--) {
                            $years[(string) $i] = $i;
                        }
                        return $years;
                    })
                    ->native(false)
                    ->live(),

                Select::make('branch_id')
                    ->label('Branch')
                    ->options(function () use ($user) {
                        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                            return Branch::where('id', $user->branch_id)->pluck('name', 'id');
                        }
                        return Branch::pluck('name', 'id');
                    })
                    ->placeholder('All Branches')
                    ->native(false)
                    ->live()
                    ->disabled(fn () => $user->hasRole('manager') && !$user->hasRole('admin'))
                    ->dehydrated(),
            ])
            ->columns(3)
            ->statePath('data');
    }

    public function getStats(): array
    {
        $month    = $this->data['month'] ?? now()->format('m');
        $year     = $this->data['year']  ?? now()->year;
        $branchId = $this->data['branch_id'] ?? null;

        $user = auth()->user();
        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
            $branchId = $user->branch_id;
        }

        $incomeQuery  = Payment::query()->whereYear('payment_date', $year)->whereMonth('payment_date', $month);
        $expenseQuery = Expense::query()->whereYear('expense_date', $year)->whereMonth('expense_date', $month);

        if ($branchId) {
            $incomeQuery->where('branch_id', $branchId);
            $expenseQuery->where('branch_id', $branchId);
        }

        $totalIncome   = (float) $incomeQuery->sum('amount');
        $totalExpenses = (float) $expenseQuery->sum('amount');
        $profit        = $totalIncome - $totalExpenses;

        return [
            'month'          => Carbon::create($year, $month, 1)->format('F Y'),
            'total_income'   => $totalIncome,
            'total_expenses' => $totalExpenses,
            'profit'         => $profit,
            'is_profit'      => $profit >= 0,
        ];
    }

    public function getIncomeBreakdown(): array
    {
        $month    = $this->data['month'] ?? now()->format('m');
        $year     = $this->data['year']  ?? now()->year;
        $branchId = $this->data['branch_id'] ?? null;

        $user = auth()->user();
        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
            $branchId = $user->branch_id;
        }

        $query = Payment::query()
            ->selectRaw('payment_type, SUM(amount) as total')
            ->whereYear('payment_date', $year)
            ->whereMonth('payment_date', $month)
            ->groupBy('payment_type')
            ->orderByDesc('total');

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        return $query->get()->toArray();
    }

    public function getExpenseBreakdown(): array
    {
        $month    = $this->data['month'] ?? now()->format('m');
        $year     = $this->data['year']  ?? now()->year;
        $branchId = $this->data['branch_id'] ?? null;

        $user = auth()->user();
        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
            $branchId = $user->branch_id;
        }

        $query = Expense::query()
            ->selectRaw('category, SUM(amount) as total')
            ->whereYear('expense_date', $year)
            ->whereMonth('expense_date', $month)
            ->groupBy('category')
            ->orderByDesc('total');

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        return $query->get()->toArray();
    }
}
