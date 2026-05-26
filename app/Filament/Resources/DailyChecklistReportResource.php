<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyChecklistReportResource\Pages;
use App\Models\ClientDailyChecklist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DailyChecklistReportResource extends Resource
{
    protected static ?string $model = ClientDailyChecklist::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Daily Operations';

    protected static ?string $navigationLabel = 'Daily Checklist Reports';

    protected static ?string $modelLabel = 'Daily Checklist Report';

    protected static ?string $pluralModelLabel = 'Daily Checklist Reports';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Read-only form - not used for creation/editing
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();

                // Managers can only see clients from their branch
                if ($user->hasRole('manager')) {
                    $query->whereHas('client', function ($q) use ($user) {
                        $q->where('branch_id', $user->branch_id);
                    });
                }

                // Admins see all clients (no filter)
            })
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => \App\Filament\Pages\ClientChecklistDetail::getUrl(['client' => $record->client_id]))
                    ->color('primary')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('client.reg_number')
                    ->label('Reg. Number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.branch.name')
                    ->label('Branch')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Day')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('task_name')
                    ->label('Task')
                    ->wrap()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\IconColumn::make('completed')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('completedBy.name')
                    ->label('Completed By')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('completed_at')
                    ->label('Completed At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('client')
                    ->relationship('client', 'name', function ($query) {
                        $user = auth()->user();
                        // Managers can only see clients from their branch in the filter
                        if ($user->hasRole('manager')) {
                            $query->where('branch_id', $user->branch_id);
                        }
                    })
                    ->label('Client Name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->placeholder('All Clients'),
                Tables\Filters\SelectFilter::make('branch')
                    ->relationship('client.branch', 'name', function ($query) {
                        $user = auth()->user();
                        // Managers can only see their own branch in the filter
                        if ($user->hasRole('manager')) {
                            $query->where('id', $user->branch_id);
                        }
                    })
                    ->label('Branch')
                    ->searchable()
                    ->preload()
                    ->placeholder('All Branches')
                    ->visible(fn () => auth()->user()->hasRole('admin')), // Only admins need to see branch filter
                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From Date')
                            ->native(false)
                            ->placeholder('Select start date')
                            ->default(now()->startOfMonth()),
                        Forms\Components\DatePicker::make('to')
                            ->label('To Date')
                            ->native(false)
                            ->placeholder('Select end date')
                            ->default(now()->endOfMonth()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn ($query, $date) => $query->whereDate('date', '>=', $date))
                            ->when($data['to'], fn ($query, $date) => $query->whereDate('date', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['from'] ?? null) {
                            $indicators[] = 'From: ' . \Carbon\Carbon::parse($data['from'])->format('M d, Y');
                        }
                        if ($data['to'] ?? null) {
                            $indicators[] = 'To: ' . \Carbon\Carbon::parse($data['to'])->format('M d, Y');
                        }
                        return $indicators;
                    }),
                Tables\Filters\SelectFilter::make('week')
                    ->label('Quick Select Week')
                    ->options(function () {
                        $weeks = [];
                        for ($i = 0; $i < 12; $i++) {
                            $startOfWeek = now()->subWeeks($i)->startOfWeek();
                            $endOfWeek = now()->subWeeks($i)->endOfWeek();
                            $key = $startOfWeek->format('Y-m-d') . '|' . $endOfWeek->format('Y-m-d');
                            $label = $startOfWeek->format('M d') . ' - ' . $endOfWeek->format('M d, Y');
                            if ($i === 0) {
                                $label .= ' (This Week)';
                            } elseif ($i === 1) {
                                $label .= ' (Last Week)';
                            }
                            $weeks[$key] = $label;
                        }
                        return $weeks;
                    })
                    ->query(function (Builder $query, $data) {
                        if (!empty($data['value'])) {
                            [$start, $end] = explode('|', $data['value']);
                            $query->whereBetween('date', [$start, $end]);
                        }
                    })
                    ->placeholder('Select a week'),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Task Category')
                    ->options([
                        'DRESSING & PERSONAL HYGIENE' => 'Dressing & Personal Hygiene',
                        'COMPANIONSHIP' => 'Companionship',
                        'HEALTH & MEDI MANAGEMENT' => 'Health & Medi Management',
                        'EATING & NUTRITION' => 'Eating & Nutrition',
                    ])
                    ->placeholder('All Categories'),
                Tables\Filters\TernaryFilter::make('completed')
                    ->label('Completion Status')
                    ->placeholder('All tasks')
                    ->trueLabel('Completed only')
                    ->falseLabel('Pending only'),
            ])
            ->actions([
                // No edit/delete actions - this is a report view only
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('export_pdf')
                        ->label('Export to PDF')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {
                            $data = [
                                'records' => $records,
                                'generated_at' => now()->format('M d, Y H:i'),
                            ];

                            $pdf = Pdf::loadView('pdf.daily-checklist-report', $data);
                            return response()->streamDownload(
                                fn () => print($pdf->output()),
                                'daily-checklist-report-' . now()->format('Y-m-d-His') . '.pdf'
                            );
                        }),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export_all_pdf')
                    ->label('Export Current View to PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($livewire) {
                        $query = $livewire->getFilteredTableQuery();
                        $records = $query->get();

                        $data = [
                            'records' => $records,
                            'generated_at' => now()->format('M d, Y H:i'),
                        ];

                        $pdf = Pdf::loadView('pdf.daily-checklist-report', $data);
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'daily-checklist-report-' . now()->format('Y-m-d-His') . '.pdf'
                        );
                    }),
            ])
            ->defaultSort('date', 'desc')
            ->defaultGroup('client.name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyChecklistReports::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // This is a report, not for creating records
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }
}
