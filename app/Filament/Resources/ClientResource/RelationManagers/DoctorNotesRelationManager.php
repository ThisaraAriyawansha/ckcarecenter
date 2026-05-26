<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorNotesRelationManager extends RelationManager
{
    protected static string $relationship = 'doctorNotes';

    protected static ?string $title = 'Doctor Notes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('doctor_id')
                    ->label('Doctor')
                    ->options(function () {
                        // Get all active doctors from doctors table
                        return \App\Models\Doctor::where('is_active', true)
                            ->pluck('name', 'id');
                    })
                    ->required()
                    ->searchable()
                    ->native(false),

                Forms\Components\DatePicker::make('note_date')
                    ->label('Note Date')
                    ->required()
                    ->default(today())
                    ->native(false),

                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->required()
                    ->rows(5)
                    ->maxLength(65535),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('notes')
            ->columns([
                Tables\Columns\TextColumn::make('note_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('doctor.name')
                    ->label('Doctor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(50)
                    ->wrap()
                    ->searchable(),

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
            ->defaultSort('note_date', 'desc')
            ->filters([
                Tables\Filters\Filter::make('note_date')
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
                                fn (Builder $query, $date): Builder => $query->whereDate('note_date', '>=', $date),
                            )
                            ->when(
                                $data['date_to'],
                                fn (Builder $query, $date): Builder => $query->whereDate('note_date', '<=', $date),
                            );
                    }),

                Tables\Filters\SelectFilter::make('doctor')
                    ->relationship('doctor', 'name', function ($query) {
                        $query->where('is_active', true);
                    })
                    ->label('Doctor')
                    ->searchable()
                    ->preload()
                    ->placeholder('All Doctors'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager']))
                    ->mutateFormDataUsing(function (array $data): array {
                        // Auto-fill branch_id from client
                        $data['branch_id'] = $this->getOwnerRecord()->branch_id;
                        // Auto-fill created_by
                        $data['created_by'] = auth()->id();
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                ]),
            ]);
    }
}
