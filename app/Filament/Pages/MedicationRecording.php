<?php

namespace App\Filament\Pages;

use App\Models\Client;
use App\Models\Medication;
use App\Models\MedicationRecord;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use Filament\Actions\Action as PageAction;
use Filament\Forms\Components\Grid;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MedicationChartExport;
use Barryvdh\DomPDF\Facade\Pdf;

class MedicationRecording extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static string $view = 'filament.pages.medication-recording';

    protected static ?string $navigationGroup = 'Client Management';

    protected static ?int $navigationSort = 3;

    protected static ?string $title = 'Medication Recording';

    public ?string $selectedDateFrom = null;
    public ?string $selectedDateTo = null;
    public ?int $selectedClient = null;
    public ?string $selectedTime = null;

    public function mount(): void
    {
        $this->selectedDateFrom = today()->toDateString();
        $this->selectedDateTo = today()->toDateString();
        $this->selectedTime = 'all';
    }

    protected function getHeaderActions(): array
    {
        return [
            PageAction::make('download_pdf')
                ->label('Download PDF Report')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->form([
                    Select::make('client_id')
                        ->label('Client')
                        ->options(function () {
                            $user = auth()->user();
                            $query = Client::query();

                            // Managers can only see clients from their branch
                            if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                $query->where('branch_id', $user->branch_id);
                            }

                            return $query->pluck('name', 'id');
                        })
                        ->required()
                        ->searchable()
                        ->preload()
                        ->helperText('Select the client for the medication report'),
                ])
                ->action(function (array $data) {
                    $dateFrom = $this->selectedDateFrom ?? today()->toDateString();
                    $dateTo = $this->selectedDateTo ?? today()->toDateString();
                    $user = auth()->user();

                    // Get client
                    $client = Client::find($data['client_id']);
                    $clientName = $client?->name;

                    // Get medication records for the selected client and date range
                    $records = MedicationRecord::with(['client', 'medication', 'givenByUser'])
                        ->where('client_id', $data['client_id'])
                        ->whereBetween('date', [$dateFrom, $dateTo])
                        ->when($this->selectedTime && $this->selectedTime !== 'all', function ($query) {
                            $query->where('time_of_day', $this->selectedTime);
                        })
                        ->get();

                    // Get branch name for managers
                    $branchName = null;
                    if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                        $branchName = $user->branch?->name;
                    }

                    // Calculate statistics
                    $totalRecords = $records->count();
                    $totalGiven = $records->where('given', true)->count();
                    $totalPending = $totalRecords - $totalGiven;
                    $complianceRate = $totalRecords > 0 ? round(($totalGiven / $totalRecords) * 100, 1) : 0;

                    // Prepare report title and date range
                    $reportTitle = 'Medication Administration Report - ' . $clientName;

                    $dateRangeFormatted = $dateFrom === $dateTo
                        ? \Carbon\Carbon::parse($dateFrom)->format('F d, Y')
                        : \Carbon\Carbon::parse($dateFrom)->format('F d, Y') . ' - ' . \Carbon\Carbon::parse($dateTo)->format('F d, Y');

                    $pdfData = [
                        'records' => $records,
                        'date' => $dateRangeFormatted,
                        'client_name' => $clientName,
                        'branch_name' => $branchName,
                        'time_filter' => $this->selectedTime ?? 'all',
                        'report_title' => $reportTitle,
                        'total_records' => $totalRecords,
                        'total_given' => $totalGiven,
                        'total_pending' => $totalPending,
                        'compliance_rate' => $complianceRate,
                        'generated_at' => now()->format('F d, Y H:i'),
                    ];

                    $pdf = Pdf::loadView('pdf.medication-report', $pdfData)
                        ->setPaper('a4', 'portrait');

                    $dateString = $dateFrom === $dateTo
                        ? \Carbon\Carbon::parse($dateFrom)->format('Y-m-d')
                        : \Carbon\Carbon::parse($dateFrom)->format('Y-m-d') . '_to_' . \Carbon\Carbon::parse($dateTo)->format('Y-m-d');
                    $clientSlug = '_' . str_replace(' ', '_', $clientName);
                    $filename = "medication_report_{$dateString}{$clientSlug}.pdf";

                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        $filename
                    );
                }),

            PageAction::make('export')
                ->label('Export Monthly Chart')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->form([
                    Select::make('client_id')
                        ->label('Client')
                        ->options(function () {
                            $user = auth()->user();
                            $query = Client::query();

                            // Managers can only see clients from their branch
                            if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                $query->where('branch_id', $user->branch_id);
                            }

                            return $query->pluck('name', 'id');
                        })
                        ->required()
                        ->searchable()
                        ->helperText('Select the client for export'),
                    Grid::make(2)
                        ->schema([
                            Select::make('month')
                                ->label('Month')
                                ->options([
                                    1 => 'January',
                                    2 => 'February',
                                    3 => 'March',
                                    4 => 'April',
                                    5 => 'May',
                                    6 => 'June',
                                    7 => 'July',
                                    8 => 'August',
                                    9 => 'September',
                                    10 => 'October',
                                    11 => 'November',
                                    12 => 'December',
                                ])
                                ->default(now()->month)
                                ->required()
                                ->native(false),
                            Select::make('year')
                                ->label('Year')
                                ->options(function () {
                                    $years = [];
                                    $currentYear = now()->year;
                                    for ($i = $currentYear - 2; $i <= $currentYear + 1; $i++) {
                                        $years[$i] = $i;
                                    }
                                    return $years;
                                })
                                ->default(now()->year)
                                ->required()
                                ->native(false),
                        ]),
                ])
                ->action(function (array $data) {
                    $client = Client::find($data['client_id']);
                    $monthName = date('F', mktime(0, 0, 0, $data['month'], 1));
                    $fileName = "medication_chart_{$client->name}_{$monthName}_{$data['year']}.xlsx";

                    Notification::make()
                        ->title('Export started')
                        ->success()
                        ->send();

                    return Excel::download(
                        new MedicationChartExport($data['client_id'], $data['month'], $data['year']),
                        $fileName
                    );
                }),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('selectedDateFrom')
                    ->label('Date From')
                    ->default(today())
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(fn () => $this->resetTable())
                    ->maxDate(fn ($get) => $get('selectedDateTo') ?? today()),
                DatePicker::make('selectedDateTo')
                    ->label('Date To')
                    ->default(today())
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(fn () => $this->resetTable())
                    ->minDate(fn ($get) => $get('selectedDateFrom') ?? today())
                    ->maxDate(today()),
                Select::make('selectedClient')
                    ->label('Client')
                    ->options(function () {
                        $user = auth()->user();
                        $query = Client::query();

                        // Managers can only see clients from their branch
                        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                            $query->where('branch_id', $user->branch_id);
                        }

                        return $query->pluck('name', 'id');
                    })
                    ->searchable()
                    ->placeholder('All Clients')
                    ->live()
                    ->afterStateUpdated(fn () => $this->resetTable()),
                Select::make('selectedTime')
                    ->label('Time of Day')
                    ->options([
                        'all' => 'All Times',
                        'morning' => 'Morning',
                        'afternoon' => 'Afternoon',
                        'evening' => 'Evening',
                    ])
                    ->default('all')
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(fn () => $this->resetTable()),
            ])
            ->columns(4);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),
                TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('medication.drug_name')
                    ->label('Medication')
                    ->searchable(),
                TextColumn::make('medication.dosage')
                    ->label('Dosage'),
                TextColumn::make('time_of_day')
                    ->label('Time')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->color(fn ($state) => match($state) {
                        'morning' => 'warning',
                        'afternoon' => 'info',
                        'evening' => 'success',
                    }),
                IconColumn::make('given')
                    ->label('Given')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('givenByUser.name')
                    ->label('Given By')
                    ->placeholder('Not given'),
                TextColumn::make('given_at')
                    ->label('Time Given')
                    ->time()
                    ->placeholder('-'),
            ])
            ->actions([
                Action::make('mark_given')
                    ->label('Mark as Given')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (MedicationRecord $record) => !$record->given)
                    ->form([
                        Select::make('given_by')
                            ->label('Given By (Career)')
                            ->options(function () {
                                $user = auth()->user();

                                $query = User::whereHas('roles', function ($roleQuery) {
                                    $roleQuery->where('name', 'career');
                                });

                                // Managers can only see careers from their branch
                                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                    $query->where('branch_id', $user->branch_id);
                                }

                                return $query->pluck('name', 'id');
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText('Select the career who gave this medication'),
                        TimePicker::make('given_at')
                            ->label('Time Given')
                            ->required()
                            ->default(now())
                            ->seconds(false)
                            ->helperText('Enter the time when medication was given'),
                    ])
                    ->action(function (MedicationRecord $record, array $data) {
                        $record->update([
                            'given' => true,
                            'given_by' => $data['given_by'],
                            'given_at' => $data['given_at'],
                        ]);

                        Notification::make()
                            ->title('Medication marked as given')
                            ->success()
                            ->send();
                    }),
                Action::make('undo')
                    ->label('Undo')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->visible(fn (MedicationRecord $record) => $record->given)
                    ->requiresConfirmation()
                    ->action(function (MedicationRecord $record) {
                        $record->update([
                            'given' => false,
                            'given_by' => null,
                            'given_at' => null,
                        ]);

                        Notification::make()
                            ->title('Medication status reset')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                // No bulk actions for safety
            ])
            ->defaultSort('date', 'desc');
    }

    protected function getTableQuery(): Builder
    {
        $dateFrom = $this->selectedDateFrom ?? today()->toDateString();
        $dateTo = $this->selectedDateTo ?? today()->toDateString();
        $user = auth()->user();

        // Create date range
        $startDate = \Carbon\Carbon::parse($dateFrom);
        $endDate = \Carbon\Carbon::parse($dateTo);

        // Loop through each date in the range
        while ($startDate->lte($endDate)) {
            $currentDate = $startDate->toDateString();

            // Get all active medications for this date
            $query = Medication::where('is_active', true)
                ->where('start_date', '<=', $currentDate)
                ->where(function ($q) use ($currentDate) {
                    $q->whereNull('end_date')
                        ->orWhere('end_date', '>=', $currentDate);
                });

            // Managers can only see medications for clients from their branch
            if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                $query->whereHas('client', function ($clientQuery) use ($user) {
                    $clientQuery->where('branch_id', $user->branch_id);
                });
            }

            // Filter by client if selected
            if ($this->selectedClient) {
                $query->where('client_id', $this->selectedClient);
            }

            // Create medication records for this date
            $medications = $query->get();

            foreach ($medications as $medication) {
                $times = $this->getTimesForFrequency($medication->frequency);

                foreach ($times as $time) {
                    MedicationRecord::firstOrCreate([
                        'medication_id' => $medication->id,
                        'client_id' => $medication->client_id,
                        'date' => $currentDate,
                        'time_of_day' => $time,
                    ]);
                }
            }

            $startDate->addDay();
        }

        // Return medication records query for the date range
        $recordsQuery = MedicationRecord::with(['client', 'medication', 'givenByUser'])
            ->whereBetween('date', [$dateFrom, $dateTo]);

        // Filter by time if not 'all'
        if ($this->selectedTime && $this->selectedTime !== 'all') {
            $recordsQuery->where('time_of_day', $this->selectedTime);
        }

        // Filter by client if selected
        if ($this->selectedClient) {
            $recordsQuery->where('client_id', $this->selectedClient);
        }

        return $recordsQuery;
    }

    protected function getTimesForFrequency(string $frequency): array
    {
        return match($frequency) {
            'morning' => ['morning'],
            'afternoon' => ['afternoon'],
            'evening' => ['evening'],
            'morning_afternoon' => ['morning', 'afternoon'],
            'morning_evening' => ['morning', 'evening'],
            'afternoon_evening' => ['afternoon', 'evening'],
            'all_three' => ['morning', 'afternoon', 'evening'],
            default => [],
        };
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }
}
