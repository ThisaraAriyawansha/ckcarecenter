<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\User;
use App\Models\ClientOuting;

class OutingsRelationManager extends RelationManager
{
    protected static string $relationship = 'outings';

    protected static ?string $recordTitleAttribute = 'date';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('destination')
                    ->label('Destination')
                    ->maxLength(255),
                Forms\Components\Select::make('accompanied_by')
                    ->label('Accompanied By')
                    ->options(User::pluck('name', 'id'))
                    ->searchable(),
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
                    ->native(false),
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
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_out')
                    ->label('Time Out')
                    ->time('H:i'),
                Tables\Columns\TextColumn::make('time_in')
                    ->label('Time In')
                    ->time('H:i')
                    ->placeholder('Still out'),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Reason')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('destination')
                    ->label('Destination')
                    ->limit(20),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'out',
                        'success' => 'returned',
                        'danger' => 'cancelled',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'out' => 'Out',
                        'returned' => 'Returned',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Outing'),
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
                    }),
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
}
