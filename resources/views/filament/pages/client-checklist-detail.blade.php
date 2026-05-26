<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Client Info Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-start gap-6">
                @if($client->image)
                    <img src="{{ Storage::url($client->image) }}" alt="{{ $client->name }}"
                         class="w-24 h-24 rounded-full object-cover border-4 border-primary-500">
                @else
                    <div class="w-24 h-24 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center border-4 border-primary-500">
                        <span class="text-3xl font-bold text-primary-600 dark:text-primary-400">
                            {{ substr($client->name, 0, 1) }}
                        </span>
                    </div>
                @endif

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $client->name }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Reg #: {{ $client->reg_number }}</p>
                        </div>
                        <a href="{{ \App\Filament\Pages\DailyChecklistReports::getUrl() }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Reports
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Branch</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $client->branch->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Carer in Charge</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $client->officerInCharge->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Date</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ now()->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checklist Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Today's Checklist Tasks</h3>
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>
