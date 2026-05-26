<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MealsRelationManager extends RelationManager
{
    protected static string $relationship = 'meals';

    protected static ?string $title = 'Client Meals';

    public function form(Form $form): Form
    {
        $isCareer = auth()->user()->hasRole('career');

        return $form
            ->schema([
                Forms\Components\Section::make('Meal Details')
                    ->schema([
                        Forms\Components\DatePicker::make('meal_date')
                            ->label('Date')
                            ->required()
                            ->default(today())
                            ->maxDate(today())
                            ->disabled($isCareer)
                            ->dehydrated()
                            ->native(false),

                        Forms\Components\TimePicker::make('meal_time')
                            ->label('Time')
                            ->required()
                            ->default(now()->format('H:i'))
                            ->seconds(false)
                            ->native(false),

                        Forms\Components\Select::make('meal_type')
                            ->label('Meal Type')
                            ->options([
                                'breakfast' => 'Breakfast',
                                'lunch' => 'Lunch',
                                'dinner' => 'Dinner',
                                'snack' => 'Snack',
                            ])
                            ->required()
                            ->default('lunch')
                            ->native(false),

                        Forms\Components\Textarea::make('meal_items')
                            ->label('Meal Items')
                            ->required()
                            ->rows(3)
                            ->placeholder('E.g., Rice, Chicken Curry, Vegetables, Salad')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('notes')
                            ->label('Additional Notes')
                            ->rows(2)
                            ->placeholder('Any observations about appetite, preferences, etc.')
                            ->columnSpanFull(),

                        Forms\Components\Hidden::make('recorded_by')
                            ->default(auth()->id()),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('meal_date')
            ->columns([
                Tables\Columns\TextColumn::make('meal_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('meal_time')
                    ->label('Time')
                    ->time('H:i')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('meal_type')
                    ->label('Type')
                    ->colors([
                        'warning' => 'breakfast',
                        'success' => 'lunch',
                        'primary' => 'dinner',
                        'secondary' => 'snack',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('meal_items')
                    ->label('Meal Items')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('recordedBy.name')
                    ->label('Recorded By')
                    ->toggleable()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Recorded At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('meal_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('meal_type')
                    ->label('Meal Type')
                    ->options([
                        'breakfast' => 'Breakfast',
                        'lunch' => 'Lunch',
                        'dinner' => 'Dinner',
                        'snack' => 'Snack',
                    ])
                    ->native(false),

                Tables\Filters\Filter::make('meal_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From Date')
                            ->native(false),
                        Forms\Components\DatePicker::make('until')
                            ->label('Until Date')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('meal_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('meal_date', '<=', $date),
                            );
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager', 'career'])),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(function ($record) {
                        // Admins and managers can edit any meal
                        if (auth()->user()->hasAnyRole(['admin', 'manager'])) {
                            return true;
                        }

                        // Career can only edit today's meals
                        if (auth()->user()->hasRole('career')) {
                            return $record->meal_date->isToday();
                        }

                        return false;
                    }),
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
