<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\CareerAttendance;
use Illuminate\Database\Eloquent\Builder;

class AttendancePendingApprovalWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    protected function getTableHeading(): ?string
    {
        return 'Pending Attendance Approvals';
    }

    public function table(Table $table): Table
    {
        $user = auth()->user();
        $isManager = $user->hasRole('manager') && !$user->hasRole('admin');

        return $table
            ->query(
                CareerAttendance::query()
                    ->where('status', 'pending')
                    ->when($isManager, function ($query) use ($user) {
                        // Managers only see pending approvals from their branch
                        $query->where('branch_id', $user->branch_id);
                    })
                    ->with(['user', 'branch'])
                    ->orderBy('date', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Carer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->badge()
                    ->color('primary')
                    ->visible(!$isManager),

                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time_in')
                    ->label('Time In')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('time_out')
                    ->label('Time Out')
                    ->time('H:i')
                    ->placeholder('Not set'),

                Tables\Columns\TextColumn::make('total_hours')
                    ->label('Hours')
                    ->getStateUsing(fn ($record) => $record->total_hours ? $record->total_hours . 'h' : '-')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                    ]),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    })
                    ->placeholder('No notes'),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Attendance')
                    ->modalDescription(fn ($record) => "Approve attendance for {$record->user->name} on {$record->date->format('M d, Y')}?")
                    ->form([
                        \Filament\Forms\Components\Textarea::make('manager_notes')
                            ->label('Manager Notes (Optional)')
                            ->rows(2)
                            ->placeholder('Add any notes about this approval...'),
                    ])
                    ->action(function (CareerAttendance $record, array $data) {
                        $record->update([
                            'status' => 'approved',
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                            'manager_notes' => $data['manager_notes'] ?? null,
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Attendance Approved')
                            ->body("Attendance for {$record->user->name} has been approved.")
                            ->send();
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Attendance')
                    ->modalDescription(fn ($record) => "Reject attendance for {$record->user->name} on {$record->date->format('M d, Y')}?")
                    ->form([
                        \Filament\Forms\Components\Textarea::make('manager_notes')
                            ->label('Reason for Rejection')
                            ->required()
                            ->rows(2)
                            ->placeholder('Please provide a reason for rejecting this attendance...'),
                    ])
                    ->action(function (CareerAttendance $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                            'manager_notes' => $data['manager_notes'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Attendance Rejected')
                            ->body("Attendance for {$record->user->name} has been rejected.")
                            ->send();
                    }),

                Tables\Actions\ViewAction::make()
                    ->modalHeading('Attendance Details'),
            ])
            ->emptyStateHeading('No Pending Approvals')
            ->emptyStateDescription('All attendance records have been reviewed.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
