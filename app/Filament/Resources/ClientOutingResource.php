<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientOutingResource\Pages;
use App\Filament\Resources\ClientOutingResource\RelationManagers;
use App\Models\ClientOuting;
use App\Models\Client;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientOutingResource extends Resource
{
    protected static ?string $model = ClientOuting::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-on-rectangle';

    protected static ?string $navigationGroup = 'Client Management';

    protected static ?string $navigationLabel = 'Client Outings';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Outing Details')
                    ->schema([
                        Forms\Components\Select::make('client_id')
                            ->label('Client')
                            ->relationship('client', 'name', function ($query) {
                                $user = auth()->user();

                                // Carers can only select clients from their branch
                                if ($user->hasRole('career')) {
                                    $query->where('branch_id', $user->branch_id);
                                }

                                // Managers can only select clients from their branch
                                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                    $query->where('branch_id', $user->branch_id);
                                }
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Select the client who is going out'),
                        Forms\Components\DatePicker::make('date')
                            ->label('Date')
                            ->required()
                            ->default(today())
                            ->native(false),
                        Forms\Components\TimePicker::make('time_out')
                            ->label('Time Out')
                            ->required()
                            ->default(now())
                            ->seconds(false)
                            ->native(false),
                        Forms\Components\TimePicker::make('time_in')
                            ->label('Time In')
                            ->seconds(false)
                            ->native(false)
                            ->helperText('Leave empty if client is still out'),
                        Forms\Components\Textarea::make('reason')
                            ->label('Reason for Outing')
                            ->required()
                            ->rows(3)
                            ->placeholder('e.g., Medical appointment, Family visit, Shopping')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('destination')
                            ->label('Destination')
                            ->placeholder('e.g., City Hospital, Shopping Mall')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Accompaniment & Authorization')
                    ->schema([
                        Forms\Components\Select::make('accompanied_by')
                            ->label('Accompanied By')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->helperText('Staff member accompanying the client'),
                        Forms\Components\Select::make('authorized_by')
                            ->label('Authorized By')
                            ->options(function () {
                                return User::whereHas('roles', function ($query) {
                                    $query->whereIn('name', ['admin', 'manager']);
                                })->pluck('name', 'id');
                            })
                            ->searchable()
                            ->helperText('Manager/Admin who authorized this outing'),
                        Forms\Components\Select::make('transport_mode')
                            ->label('Transport Mode')
                            ->options([
                                'Walking' => 'Walking',
                                'Wheelchair' => 'Wheelchair',
                                'Car' => 'Car',
                                'Taxi' => 'Taxi',
                                'Ambulance' => 'Ambulance',
                                'Public Transport' => 'Public Transport',
                                'Family Vehicle' => 'Family Vehicle',
                                'Other' => 'Other',
                            ])
                            ->native(false)
                            ->placeholder('Select transport mode'),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'out' => 'Out',
                                'returned' => 'Returned',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('out')
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Additional Notes')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3)
                            ->placeholder('Any additional information about this outing')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();

                // Carers can only see outings for clients from their branch
                if ($user->hasRole('career')) {
                    $query->whereHas('client', function ($clientQuery) use ($user) {
                        $clientQuery->where('branch_id', $user->branch_id);
                    });
                }

                // Managers can only see outings for clients from their branch
                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                    $query->whereHas('client', function ($clientQuery) use ($user) {
                        $clientQuery->where('branch_id', $user->branch_id);
                    });
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_out')
                    ->label('Time Out')
                    ->time('H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_in')
                    ->label('Time In')
                    ->time('H:i')
                    ->placeholder('Still out')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration')
                    ->getStateUsing(function (ClientOuting $record) {
                        return $record->duration ?? 'Ongoing';
                    })
                    ->badge()
                    ->color(function (ClientOuting $record) {
                        return $record->time_in ? 'success' : 'warning';
                    }),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Reason')
                    ->limit(30)
                    ->searchable()
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('destination')
                    ->label('Destination')
                    ->searchable()
                    ->toggleable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('accompaniedBy.name')
                    ->label('Accompanied By')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transport_mode')
                    ->label('Transport')
                    ->badge()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'out',
                        'success' => 'returned',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('authorizedBy.name')
                    ->label('Authorized By')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('client')
                    ->relationship('client', 'name', function ($query) {
                        $user = auth()->user();

                        // Carers can only see clients from their branch
                        if ($user->hasRole('career')) {
                            $query->where('branch_id', $user->branch_id);
                        }

                        // Managers can only see clients from their branch
                        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                            $query->where('branch_id', $user->branch_id);
                        }
                    })
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'out' => 'Out',
                        'returned' => 'Returned',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From Date'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_returned')
                    ->label('Mark Returned')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (ClientOuting $record) => $record->status === 'out' && !$record->time_in)
                    ->form([
                        Forms\Components\TimePicker::make('time_in')
                            ->label('Time Returned')
                            ->required()
                            ->default(now())
                            ->seconds(false)
                            ->native(false),
                    ])
                    ->action(function (ClientOuting $record, array $data) {
                        $record->update([
                            'time_in' => $data['time_in'],
                            'status' => 'returned',
                        ]);
                    })
                    ->successNotification(
                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Client marked as returned')
                    ),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
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
            'index' => Pages\ListClientOutings::route('/'),
            'create' => Pages\CreateClientOuting::route('/create'),
            'edit' => Pages\EditClientOuting::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager', 'career']);
    }
}
