<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitorsRelationManager extends RelationManager
{
    protected static string $relationship = 'visitors';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Visitor Information')
                    ->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('visitor_name')
            ->columns([
                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Visit Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('visitor_name')
                    ->label('Visitor Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('visitor_contact')
                    ->label('Contact')
                    ->searchable(),

                Tables\Columns\TextColumn::make('purpose')
                    ->label('Purpose')
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('time_in')
                    ->label('Time In')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('time_out')
                    ->label('Time Out')
                    ->time('H:i')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('total_hours')
                    ->label('Duration (hrs)')
                    ->getStateUsing(fn ($record) => $record->total_hours)
                    ->placeholder('-'),
            ])
            ->defaultSort('visit_date', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['branch_id'] = $this->ownerRecord->branch_id;
                        $data['created_by'] = auth()->id();
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('clock_out')
                    ->label('Clock Out')
                    ->icon('heroicon-o-clock')
                    ->color('warning')
                    ->visible(function ($record) {
                        return !$record->time_out;
                    })
                    ->form([
                        Forms\Components\TimePicker::make('time_out')
                            ->label('Time Out')
                            ->required()
                            ->seconds(false)
                            ->native(false)
                            ->default(now()),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'time_out' => $data['time_out'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Clock Out Successful')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
