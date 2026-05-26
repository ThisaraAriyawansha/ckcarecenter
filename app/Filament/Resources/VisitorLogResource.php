<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitorLogResource\Pages;
use App\Filament\Resources\VisitorLogResource\RelationManagers;
use App\Models\VisitorLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Barryvdh\DomPDF\Facade\Pdf;

class VisitorLogResource extends Resource
{
    protected static ?string $model = VisitorLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Visitor Logs';

    protected static ?string $modelLabel = 'Visitor Log';

    protected static ?string $navigationGroup = 'Branch Management';

    protected static ?int $navigationSort = 5;

    /**
     * Only managers and admins can see this resource
     * Careers cannot access visitor logs
     */
    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    /**
     * Query modification based on user role
     * Managers see only their branch's visitor logs
     * Admins see all visitor logs
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = auth()->user();

        // Managers can only see visitor logs from their branch
        if ($user->hasRole('manager')) {
            $query->where('branch_id', $user->branch_id);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Visitor Information')
                    ->schema([
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->relationship('branch', 'name', function ($query) {
                                $user = auth()->user();
                                // Managers can only select their own branch
                                if ($user->hasRole('manager')) {
                                    $query->where('id', $user->branch_id);
                                }
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(function () {
                                // Auto-select manager's branch
                                if (auth()->user()->hasRole('manager')) {
                                    return auth()->user()->branch_id;
                                }
                                return null;
                            })
                            ->disabled(fn () => auth()->user()->hasRole('manager'))
                            ->dehydrated()
                            ->native(false)
                            ->live(),

                        Forms\Components\Select::make('client_id')
                            ->label('Client (Optional)')
                            ->helperText('Select a client if this visitor is a relative/visitor of a specific client')
                            ->relationship('client', 'name', function ($query, $get) {
                                $branchId = $get('branch_id');
                                if ($branchId) {
                                    $query->where('branch_id', $branchId);
                                }
                            })
                            ->searchable()
                            ->preload()
                            ->native(false),

                        Forms\Components\DatePicker::make('visit_date')
                            ->label('Visit Date')
                            ->required()
                            ->default(today())
                            ->maxDate(today())
                            ->native(false),

                        Forms\Components\TextInput::make('visitor_name')
                            ->label('Visitor Name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('visitor_contact')
                            ->label('Contact Number')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('purpose')
                            ->label('Purpose of Visit')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Visit Time')
                    ->schema([
                        Forms\Components\TimePicker::make('time_in')
                            ->label('Time In')
                            ->required()
                            ->seconds(false)
                            ->native(false),

                        Forms\Components\TimePicker::make('time_out')
                            ->label('Time Out')
                            ->seconds(false)
                            ->native(false)
                            ->after('time_in'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3)
                            ->maxLength(65535),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Visit Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('visitor_name')
                    ->label('Visitor Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('visitor_contact')
                    ->label('Contact')
                    ->searchable(),

                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->placeholder('General Visitor')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('purpose')
                    ->label('Purpose')
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->searchable()
                    ->sortable()
                    ->visible(fn () => auth()->user()->hasRole('admin')),

                Tables\Columns\TextColumn::make('time_in')
                    ->label('Time In')
                    ->time('H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time_out')
                    ->label('Time Out')
                    ->time('H:i')
                    ->sortable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('total_hours')
                    ->label('Duration (hrs)')
                    ->getStateUsing(fn (VisitorLog $record) => $record->total_hours)
                    ->placeholder('-')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('Created By')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('visit_date', 'desc')
            ->filters([
                Tables\Filters\Filter::make('visit_date')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('From Date')
                            ->native(false),
                        Forms\Components\DatePicker::make('date_to')
                            ->label('To Date')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('visit_date', '>=', $date),
                            )
                            ->when(
                                $data['date_to'],
                                fn (Builder $query, $date): Builder => $query->whereDate('visit_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['date_from'] ?? null) {
                            $indicators[] = Tables\Filters\Indicator::make('From: ' . \Carbon\Carbon::parse($data['date_from'])->toFormattedDateString())
                                ->removeField('date_from');
                        }

                        if ($data['date_to'] ?? null) {
                            $indicators[] = Tables\Filters\Indicator::make('To: ' . \Carbon\Carbon::parse($data['date_to'])->toFormattedDateString())
                                ->removeField('date_to');
                        }

                        return $indicators;
                    }),

                Tables\Filters\SelectFilter::make('branch')
                    ->relationship('branch', 'name')
                    ->label('Branch')
                    ->searchable()
                    ->preload()
                    ->placeholder('All Branches')
                    ->visible(fn () => auth()->user()->hasRole('admin')),

                Tables\Filters\SelectFilter::make('client')
                    ->relationship('client', 'name', function ($query) {
                        $user = auth()->user();
                        if ($user->hasRole('manager')) {
                            $query->where('branch_id', $user->branch_id);
                        }
                    })
                    ->label('Client')
                    ->searchable()
                    ->preload()
                    ->placeholder('All Visitors'),
            ])
            ->actions([
                Tables\Actions\Action::make('clock_out')
                    ->label('Clock Out')
                    ->icon('heroicon-o-clock')
                    ->color('warning')
                    ->visible(function (VisitorLog $record) {
                        // Only show if time_out is not set and user is manager
                        return auth()->user()->hasRole('manager') && !$record->time_out;
                    })
                    ->form([
                        Forms\Components\TimePicker::make('time_out')
                            ->label('Time Out')
                            ->required()
                            ->seconds(false)
                            ->native(false)
                            ->default(now())
                            ->after('time_in'),
                    ])
                    ->action(function (VisitorLog $record, array $data) {
                        $record->update([
                            'time_out' => $data['time_out'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Clock Out Successful')
                            ->success()
                            ->body('Time out has been recorded successfully.')
                            ->send();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => auth()->user()->hasRole('manager')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasRole('manager')),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export_pdf')
                    ->label('Download Report')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('From Date')
                            ->required()
                            ->default(now()->startOfMonth())
                            ->native(false),
                        Forms\Components\DatePicker::make('date_to')
                            ->label('To Date')
                            ->required()
                            ->default(now())
                            ->native(false)
                            ->after('date_from'),
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->relationship('branch', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false)
                            ->visible(fn () => auth()->user()->hasRole('admin')),
                    ])
                    ->action(function (array $data) {
                        $dateFrom = \Carbon\Carbon::parse($data['date_from']);
                        $dateTo = \Carbon\Carbon::parse($data['date_to']);

                        // Determine branch filter
                        if (auth()->user()->hasRole('manager')) {
                            // Managers: use their own branch
                            $branchId = auth()->user()->branch_id;
                        } else {
                            // Admins: use selected branch (required)
                            $branchId = $data['branch_id'];
                        }

                        // Build query - always filter by branch
                        $query = VisitorLog::query()
                            ->with(['branch', 'createdBy'])
                            ->where('branch_id', $branchId)
                            ->whereDate('visit_date', '>=', $dateFrom)
                            ->whereDate('visit_date', '<=', $dateTo);

                        $logs = $query->orderBy('visit_date')
                            ->orderBy('time_in')
                            ->get();

                        // Get branch name for header
                        $branchName = \App\Models\Branch::find($branchId)->name ?? null;

                        $pdfData = [
                            'logs' => $logs,
                            'date_from' => $dateFrom->format('M d, Y'),
                            'date_to' => $dateTo->format('M d, Y'),
                            'branch_name' => $branchName,
                            'generated_at' => now()->format('M d, Y H:i'),
                        ];

                        $pdf = Pdf::loadView('pdf.visitor-log-report', $pdfData)
                            ->setPaper('a4', 'portrait');

                        // Generate filename
                        $branchSlug = $branchName ? str_replace(' ', '_', $branchName) . '_' : '';
                        $filename = 'visitor_log_' . $branchSlug . $dateFrom->format('Y-m-d') . '_to_' . $dateTo->format('Y-m-d') . '.pdf';

                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            $filename
                        );
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->hasRole('manager')),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisitorLogs::route('/'),
            'create' => Pages\CreateVisitorLog::route('/create'),
            'edit' => Pages\EditVisitorLog::route('/{record}/edit'),
        ];
    }
}
