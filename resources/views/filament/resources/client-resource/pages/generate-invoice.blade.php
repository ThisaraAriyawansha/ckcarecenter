<x-filament-panels::page>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Left column: Client info + Filters --}}
        <div class="xl:col-span-1 space-y-4">

            {{-- Client Info Card --}}
            <div style="border-radius:12px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.08); border:1px solid rgba(0,0,0,0.06);">

                {{-- Blue header banner --}}
                <div style="background:linear-gradient(135deg,#2563eb,#3b82f6); padding:20px 20px 32px;">
                    <div style="font-size:10px; font-weight:600; letter-spacing:2px; color:#bfdbfe; text-transform:uppercase; margin-bottom:6px;">Client</div>
                    <div style="color:#fff; font-size:18px; font-weight:700; line-height:1.2;">{{ $record->name }}</div>
                    <div style="color:#bfdbfe; font-size:12px; margin-top:3px;">{{ $record->reg_number }}</div>
                </div>

                {{-- White body with avatar overlapping banner --}}
                <div style="background:#fff; padding:0 20px 20px; margin-top:-20px;">

                    {{-- Avatar row --}}
                    <div style="display:flex; align-items:flex-end; gap:12px; margin-bottom:16px;">
                        @if($record->image)
                            <img src="{{ asset('storage/' . $record->image) }}"
                                 style="width:60px; height:60px; border-radius:50%; object-fit:cover; border:3px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,0.15); flex-shrink:0;" />
                        @else
                            <div style="width:60px; height:60px; border-radius:50%; background:#2563eb; border:3px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,0.15); display:flex; align-items:center; justify-content:center; color:#fff; font-size:20px; font-weight:700; flex-shrink:0;">
                                {{ strtoupper(substr($record->name, 0, 2)) }}
                            </div>
                        @endif
                        @if($record->branch)
                            <span style="margin-bottom:4px; display:inline-flex; align-items:center; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:600; background:#eff6ff; color:#1d4ed8; white-space:nowrap;">
                                {{ $record->branch->name }}
                            </span>
                        @endif
                    </div>

                    {{-- Detail rows --}}
                    @php
                        $details = [
                            ['label' => 'Gender', 'value' => ucfirst($record->gender ?? '—')],
                            ['label' => 'Age',    'value' => ($record->age ?? '—') . ' years'],
                            ['label' => 'DOB',    'value' => $record->dob ? \Carbon\Carbon::parse($record->dob)->format('M d, Y') : '—'],
                            ['label' => 'Officer','value' => $record->officerInCharge?->name ?? '—'],
                        ];
                    @endphp

                    <div style="border-top:1px solid #f3f4f6; padding-top:14px;">
                        @foreach($details as $detail)
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:5px 0;">
                                <span style="font-size:11px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.8px;">
                                    {{ $detail['label'] }}
                                </span>
                                <span style="font-size:13px; color:#374151; font-weight:500;">
                                    {{ $detail['value'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Guardians --}}
                    @if($record->guardians->isNotEmpty())
                        <div style="border-top:1px solid #f3f4f6; margin-top:12px; padding-top:12px;">
                            <div style="font-size:11px; font-weight:600; color:#9ca3af; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:10px;">
                                Guardians
                            </div>
                            @foreach($record->guardians as $g)
                                <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                                    <div style="width:30px; height:30px; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; color:#2563eb; font-size:12px; font-weight:700; flex-shrink:0;">
                                        {{ strtoupper(substr($g->name, 0, 1)) }}
                                    </div>
                                    <div style="min-width:0;">
                                        <div style="font-size:13px; color:#111827; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $g->name }}</div>
                                        @if($g->email)
                                            <div style="font-size:11px; color:#6b7280; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $g->email }}</div>
                                        @endif
                                        @if($g->phone)
                                            <div style="font-size:11px; color:#6b7280;">{{ $g->phone }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Filter Form --}}
            <x-filament-panels::form wire:submit="generatePdf">
                {{ $this->form }}

                {{-- Buttons: stacked on mobile, side-by-side on desktop --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-2">

                    {{-- Generate PDF: Filament handles its own loading spinner on submit.
                         Also disabled while sendEmail is running. --}}
                    <x-filament::button
                        type="submit"
                        icon="heroicon-o-document-arrow-down"
                        color="success"
                        size="lg"
                        class="flex-1 justify-center"
                        wire:loading.attr="disabled"
                        wire:target="sendEmail"
                    >
                        Generate PDF
                    </x-filament::button>

                    {{-- Send Email: Filament handles its own loading spinner on wire:click.
                         Also disabled while generatePdf is running. --}}
                    <x-filament::button
                        type="button"
                        wire:click="sendEmail"
                        icon="heroicon-o-envelope"
                        color="info"
                        size="lg"
                        class="flex-1 justify-center"
                        wire:loading.attr="disabled"
                        wire:target="generatePdf"
                    >
                        Send by Email
                    </x-filament::button>

                </div>
            </x-filament-panels::form>
        </div>

        {{-- Right column: Live preview table --}}
        <div class="xl:col-span-2">
            <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 h-full">

                {{-- Preview header --}}
                @php $payments = $this->getPreviewPayments(); @endphp
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-800">
                    <h3 class="font-semibold text-gray-900 dark:text-white text-sm">
                        Payment Preview
                    </h3>
                    @if($payments->isNotEmpty())
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $payments->count() }} payment{{ $payments->count() !== 1 ? 's' : '' }}
                            &nbsp;&bull;&nbsp;
                            LKR {{ number_format($payments->sum('amount'), 2) }}
                        </span>
                    @endif
                </div>

                {{-- No data state --}}
                @if($payments->isEmpty())
                    <div class="flex flex-col items-center justify-center py-20 text-center px-6">
                        <div class="w-14 h-14 rounded-full bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center mb-4">
                            <x-heroicon-o-exclamation-triangle class="w-7 h-7 text-amber-400" />
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 font-medium text-sm">No payments found</p>
                        <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">
                            Try adjusting the date range or payment types.
                        </p>
                    </div>

                {{-- Payments table --}}
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-800/60">
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide w-10">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Type</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Description</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Amount (LKR)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @foreach($payments as $i => $payment)
                                    <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-800/40 transition-colors">
                                        <td class="px-4 py-3 text-gray-400 dark:text-gray-600 text-xs">
                                            {{ $i + 1 }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                            {{ $payment->payment_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 whitespace-nowrap">
                                                {{ $payment->payment_type }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400 max-w-xs truncate">
                                            {{ $payment->description ?? '—' }}
                                        </td>
                                        <td class="px-4 py-3 text-right font-semibold text-gray-900 dark:text-white tabular-nums">
                                            {{ number_format($payment->amount, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-blue-50 dark:bg-blue-900/20 border-t-2 border-blue-200 dark:border-blue-800">
                                    <td colspan="4" class="px-4 py-4 font-bold text-blue-700 dark:text-blue-300 text-sm">
                                        Total &mdash; {{ $payments->count() }} payment{{ $payments->count() !== 1 ? 's' : '' }}
                                    </td>
                                    <td class="px-4 py-4 text-right font-bold text-blue-700 dark:text-blue-300 text-base tabular-nums">
                                        {{ number_format($payments->sum('amount'), 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif

            </div>
        </div>

    </div>
</x-filament-panels::page>
