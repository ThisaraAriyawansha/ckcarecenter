<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerAttendanceResource\Pages;
use App\Models\CareerAttendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf;

class CareerAttendanceResource extends Resource
{
    protected static ?string $model = CareerAttendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'HR Management';

    protected static ?string $navigationLabel = 'Attendance';

    protected static ?string $modelLabel = 'Attendance';

    protected static ?string $pluralModelLabel = 'Attendances';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Attendance Details')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Employee')
                            ->relationship('user', 'name', function ($query) {
                                $query->whereHas('roles', fn($q) => $q->whereIn('name', ['career', 'chef']));

                                // Managers can only see employees from their branch
                                if (auth()->user()->hasRole('manager')) {
                                    $query->where('branch_id', auth()->user()->branch_id);
                                }
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(function () {
                                // Auto-fill for career/chef creating their own attendance
                                if (auth()->user()->hasAnyRole(['career', 'chef'])) {
                                    return auth()->id();
                                }
                                return null;
                            })
                            ->disabled(fn () => auth()->user()->hasAnyRole(['career', 'chef']))
                            ->dehydrated()
                            ->native(false),

                        Forms\Components\DatePicker::make('date')
                            ->label('Date')
                            ->required()
                            ->default(today())
                            ->maxDate(today()) // Can't select future dates
                            ->native(false)
                            ->disabled(function ($record) {
                                // Career/Chef: always disabled (read-only), auto-set to today
                                if (auth()->user()->hasAnyRole(['career', 'chef'])) {
                                    return true;
                                }
                                // Managers/admins can edit
                                return false;
                            })
                            ->dehydrated() // Ensure disabled field value is still saved
                            ->formatStateUsing(function ($state) {
                                // For career/chef creating new record, always show today
                                if (auth()->user()->hasAnyRole(['career', 'chef']) && !$state) {
                                    return today();
                                }
                                return $state;
                            }),

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

                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Management')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->required()
                            ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager']))
                            ->native(false),

                        Forms\Components\Textarea::make('manager_notes')
                            ->label('Manager Notes')
                            ->rows(2)
                            ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager']))
                            ->columnSpanFull(),
                    ])
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager']))
                    ->collapsed(),

                Forms\Components\Hidden::make('branch_id')
                    ->default(function () {
                        if (auth()->user()->hasAnyRole(['career', 'chef'])) {
                            return auth()->user()->branch_id;
                        }
                        return null;
                    })
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();

                // Career/Chef see only their own attendance
                if ($user->hasAnyRole(['career', 'chef'])) {
                    $query->where('user_id', $user->id);
                }

                // Managers see only their branch's employees
                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                    $query->where('branch_id', $user->branch_id);
                }

                // Admins see all
            })
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Employee')
                    ->searchable()
                    ->sortable()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),

                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->badge()
                    ->color('primary')
                    ->visible(fn () => auth()->user()->hasRole('admin')),

                Tables\Columns\TextColumn::make('time_in')
                    ->label('Time In')
                    ->time('H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time_out')
                    ->label('Time Out')
                    ->time('H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_hours')
                    ->label('Total Hours')
                    ->state(function (CareerAttendance $record) {
                        return $record->total_hours ? $record->total_hours . 'h' : '-';
                    })
                    ->sortable(false),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('approvedBy.name')
                    ->label('Approved By')
                    ->toggleable()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name', function ($query) {
                        $query->whereHas('roles', fn($q) => $q->whereIn('name', ['career', 'chef']));

                        if (auth()->user()->hasRole('manager') && !auth()->user()->hasRole('admin')) {
                            $query->where('branch_id', auth()->user()->branch_id);
                        }
                    })
                    ->label('Employee')
                    ->searchable()
                    ->preload()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),

                Tables\Filters\SelectFilter::make('branch')
                    ->relationship('branch', 'name')
                    ->label('Branch')
                    ->searchable()
                    ->preload()
                    ->visible(fn () => auth()->user()->hasRole('admin')),

                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From Date')
                            ->native(false),
                        Forms\Components\DatePicker::make('to')
                            ->label('To Date')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn ($query, $date) => $query->whereDate('date', '>=', $date))
                            ->when($data['to'], fn ($query, $date) => $query->whereDate('date', '<=', $date));
                    }),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (CareerAttendance $record) =>
                        auth()->user()->hasAnyRole(['admin', 'manager']) &&
                        $record->status !== 'approved'
                    )
                    ->form([
                        Forms\Components\Textarea::make('manager_notes')
                            ->label('Manager Notes (Optional)')
                            ->rows(2),
                    ])
                    ->action(function (CareerAttendance $record, array $data) {
                        $record->update([
                            'status' => 'approved',
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                            'manager_notes' => $data['manager_notes'] ?? $record->manager_notes,
                        ]);

                        Notification::make()
                            ->title('Attendance Approved')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (CareerAttendance $record) =>
                        auth()->user()->hasAnyRole(['admin', 'manager']) &&
                        $record->status !== 'rejected'
                    )
                    ->form([
                        Forms\Components\Textarea::make('manager_notes')
                            ->label('Reason for Rejection')
                            ->required()
                            ->rows(2),
                    ])
                    ->action(function (CareerAttendance $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                            'manager_notes' => $data['manager_notes'],
                        ]);

                        Notification::make()
                            ->title('Attendance Rejected')
                            ->danger()
                            ->send();
                    }),

                Tables\Actions\EditAction::make()
                    ->visible(function (CareerAttendance $record) {
                        // Admins and managers can always edit
                        if (auth()->user()->hasAnyRole(['admin', 'manager'])) {
                            return true;
                        }

                        // Career/Chef can only edit today's attendance if not approved
                        if (auth()->user()->hasAnyRole(['career', 'chef'])) {
                            return $record->date->isToday()
                                && $record->user_id === auth()->id()
                                && $record->status !== 'approved'; // Hide edit if approved
                        }

                        return false;
                    }),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export_monthly_pdf')
                    ->label('Download Monthly Report')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->form([
                        Forms\Components\Select::make('user_id')
                            ->label('Employee')
                            ->relationship('user', 'name', function ($query) {
                                $query->whereHas('roles', fn($q) => $q->whereIn('name', ['career', 'chef']));

                                // Managers can only see employees from their branch
                                if (auth()->user()->hasRole('manager') && !auth()->user()->hasRole('admin')) {
                                    $query->where('branch_id', auth()->user()->branch_id);
                                }

                                // Career/Chef can only select themselves
                                if (auth()->user()->hasAnyRole(['career', 'chef'])) {
                                    $query->where('id', auth()->id());
                                }
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->multiple()
                            ->default(function () {
                                // Auto-select for career/chef
                                if (auth()->user()->hasAnyRole(['career', 'chef'])) {
                                    return [auth()->id()];
                                }
                                return null;
                            })
                            ->disabled(fn () => auth()->user()->hasAnyRole(['career', 'chef']))
                            ->dehydrated()
                            ->native(false),
                        Forms\Components\Select::make('month')
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
                        Forms\Components\Select::make('year')
                            ->label('Year')
                            ->options(function () {
                                $years = [];
                                for ($i = now()->year; $i >= now()->year - 2; $i--) {
                                    $years[$i] = $i;
                                }
                                return $years;
                            })
                            ->default(now()->year)
                            ->required()
                            ->native(false),
                    ])
                    ->action(function (array $data) {
                        $month = $data['month'];
                        $year = $data['year'];
                        $userIds = $data['user_id'];

                        // Get all users
                        $users = \App\Models\User::whereIn('id', $userIds)
                            ->whereHas('roles', fn($q) => $q->whereIn('name', ['career', 'chef']))
                            ->get();

                        // Generate report data for each user
                        $reportData = [];
                        foreach ($users as $user) {
                            $attendances = CareerAttendance::where('user_id', $user->id)
                                ->whereMonth('date', $month)
                                ->whereYear('date', $year)
                                ->orderBy('date')
                                ->get()
                                ->keyBy(fn($a) => $a->date->format('Y-m-d'));

                            // Get all days in the month
                            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                            $dailyRecords = [];

                            for ($day = 1; $day <= $daysInMonth; $day++) {
                                $date = \Carbon\Carbon::create($year, $month, $day);
                                $dateKey = $date->format('Y-m-d');

                                if (isset($attendances[$dateKey])) {
                                    $dailyRecords[] = [
                                        'date' => $date,
                                        'day_of_week' => $date->format('l'),
                                        'attendance' => $attendances[$dateKey],
                                        'present' => true,
                                    ];
                                } else {
                                    $dailyRecords[] = [
                                        'date' => $date,
                                        'day_of_week' => $date->format('l'),
                                        'attendance' => null,
                                        'present' => false,
                                    ];
                                }
                            }

                            $reportData[] = [
                                'user' => $user,
                                'daily_records' => $dailyRecords,
                                'total_present' => count(array_filter($dailyRecords, fn($r) => $r['present'])),
                                'total_absent' => count(array_filter($dailyRecords, fn($r) => !$r['present'])),
                            ];
                        }

                        $pdfData = [
                            'report_data' => $reportData,
                            'month' => $month,
                            'year' => $year,
                            'month_name' => \Carbon\Carbon::create($year, $month, 1)->format('F'),
                            'generated_at' => now()->format('M d, Y H:i'),
                        ];

                        $pdf = Pdf::loadView('pdf.attendance-report', $pdfData)
                            ->setPaper('a4', 'portrait');

                        // Generate filename with employee names
                        $employeeNames = $users->pluck('name')->map(fn($name) => str_replace(' ', '_', $name))->join('_');
                        $filename = 'attendance_' . $employeeNames . '_' . $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '.pdf';

                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            $filename
                        );
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('approve_selected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager']))
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update([
                                    'status' => 'approved',
                                    'approved_by' => auth()->id(),
                                    'approved_at' => now(),
                                ]);
                            }

                            Notification::make()
                                ->title('Attendances Approved')
                                ->body(count($records) . ' attendance records approved.')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),

                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                ]),
            ])
            ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCareerAttendances::route('/'),
            'create' => Pages\CreateCareerAttendance::route('/create'),
            'edit' => Pages\EditCareerAttendance::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager', 'career', 'chef']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager', 'career', 'chef']);
    }
}
