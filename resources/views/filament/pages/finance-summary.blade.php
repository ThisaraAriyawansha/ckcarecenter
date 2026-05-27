<x-filament-panels::page>
    {{-- Filters --}}
    <x-filament::section class="mb-6">
        <x-slot name="heading">Filter</x-slot>
        <form wire:change="$refresh">
            {{ $this->form }}
        </form>
    </x-filament::section>

    @php
        $stats    = $this->getStats();
        $income   = $this->getIncomeBreakdown();
        $expenses = $this->getExpenseBreakdown();
    @endphp

    {{-- Summary Cards --}}
    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:1rem; margin-bottom:1.5rem;">

        {{-- Total Income --}}
        <div style="border-radius:0.75rem; border:1px solid #bbf7d0; background:#f0fdf4; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.08);">
            <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.5rem;">
                <x-filament::icon icon="heroicon-o-arrow-trending-up" style="width:1.5rem;height:1.5rem;color:#16a34a;" />
                <span style="font-size:0.875rem; font-weight:500; color:#15803d;">Total Income</span>
            </div>
            <p style="font-size:1.5rem; font-weight:700; color:#14532d;">
                LKR {{ number_format($stats['total_income'], 2) }}
            </p>
            <p style="font-size:0.75rem; color:#16a34a; margin-top:0.25rem;">{{ $stats['month'] }}</p>
        </div>

        {{-- Total Expenses --}}
        <div style="border-radius:0.75rem; border:1px solid #fecaca; background:#fef2f2; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.08);">
            <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.5rem;">
                <x-filament::icon icon="heroicon-o-arrow-trending-down" style="width:1.5rem;height:1.5rem;color:#dc2626;" />
                <span style="font-size:0.875rem; font-weight:500; color:#b91c1c;">Total Expenses</span>
            </div>
            <p style="font-size:1.5rem; font-weight:700; color:#7f1d1d;">
                LKR {{ number_format($stats['total_expenses'], 2) }}
            </p>
            <p style="font-size:0.75rem; color:#dc2626; margin-top:0.25rem;">{{ $stats['month'] }}</p>
        </div>

        {{-- Net Profit / Loss --}}
        @if($stats['is_profit'])
        <div style="border-radius:0.75rem; border:1px solid #bfdbfe; background:#eff6ff; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.08);">
            <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.5rem;">
                <x-filament::icon icon="heroicon-o-banknotes" style="width:1.5rem;height:1.5rem;color:#1C3F6E;" />
                <span style="font-size:0.875rem; font-weight:500; color:#1C3F6E;">Net Profit</span>
            </div>
            <p style="font-size:1.5rem; font-weight:700; color:#1e3a8a;">
                LKR {{ number_format(abs($stats['profit']), 2) }}
            </p>
            <p style="font-size:0.75rem; color:#1C3F6E; margin-top:0.25rem;">{{ $stats['month'] }}</p>
        </div>
        @else
        <div style="border-radius:0.75rem; border:1px solid #fed7aa; background:#fff7ed; padding:1.5rem; box-shadow:0 1px 3px rgba(0,0,0,.08);">
            <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.5rem;">
                <x-filament::icon icon="heroicon-o-exclamation-triangle" style="width:1.5rem;height:1.5rem;color:#ea580c;" />
                <span style="font-size:0.875rem; font-weight:500; color:#c2410c;">Net Loss</span>
            </div>
            <p style="font-size:1.5rem; font-weight:700; color:#7c2d12;">
                LKR {{ number_format(abs($stats['profit']), 2) }}
            </p>
            <p style="font-size:0.75rem; color:#ea580c; margin-top:0.25rem;">{{ $stats['month'] }}</p>
        </div>
        @endif

    </div>

    {{-- Breakdowns --}}
    <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:1.5rem;">

        {{-- Income Breakdown --}}
        <x-filament::section>
            <x-slot name="heading">Income Breakdown</x-slot>
            @if(count($income) > 0)
                @foreach($income as $row)
                    <div style="display:flex; justify-content:space-between; align-items:center; padding:0.75rem 0; border-bottom:1px solid #f3f4f6;">
                        <span style="font-size:0.875rem; font-weight:500;">{{ $row['payment_type'] }}</span>
                        <span style="font-size:0.875rem; font-weight:600; color:#16a34a;">LKR {{ number_format($row['total'], 2) }}</span>
                    </div>
                @endforeach
                <div style="display:flex; justify-content:space-between; padding-top:0.75rem; margin-top:0.25rem; border-top:2px solid #e5e7eb;">
                    <span style="font-size:0.875rem; font-weight:700;">Total</span>
                    <span style="font-size:0.875rem; font-weight:700; color:#16a34a;">LKR {{ number_format($stats['total_income'], 2) }}</span>
                </div>
            @else
                <p style="font-size:0.875rem; color:#6b7280;">No income recorded for this period.</p>
            @endif
        </x-filament::section>

        {{-- Expense Breakdown --}}
        <x-filament::section>
            <x-slot name="heading">Expense Breakdown</x-slot>
            @if(count($expenses) > 0)
                @foreach($expenses as $row)
                    <div style="display:flex; justify-content:space-between; align-items:center; padding:0.75rem 0; border-bottom:1px solid #f3f4f6;">
                        <span style="font-size:0.875rem; font-weight:500;">{{ $row['category'] }}</span>
                        <span style="font-size:0.875rem; font-weight:600; color:#dc2626;">LKR {{ number_format($row['total'], 2) }}</span>
                    </div>
                @endforeach
                <div style="display:flex; justify-content:space-between; padding-top:0.75rem; margin-top:0.25rem; border-top:2px solid #e5e7eb;">
                    <span style="font-size:0.875rem; font-weight:700;">Total</span>
                    <span style="font-size:0.875rem; font-weight:700; color:#dc2626;">LKR {{ number_format($stats['total_expenses'], 2) }}</span>
                </div>
            @else
                <p style="font-size:0.875rem; color:#6b7280;">No expenses recorded for this period.</p>
            @endif
        </x-filament::section>

    </div>
</x-filament-panels::page>
