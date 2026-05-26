<?php

namespace App\Filament\Resources\CareerResource\RelationManagers;

use App\Models\ClientDailyChecklist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompletedChecklistsRelationManager extends RelationManager
{
    protected static string $relationship = 'completedChecklists';

    protected static ?string $title = 'Daily Checklist Reports';

    protected static ?string $recordTitleAttribute = 'task_name';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('task_name')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->searchable()
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'DRESSING & PERSONAL HYGIENE' => 'info',
                        'COMPANIONSHIP' => 'success',
                        'HEALTH & MEDI MANAGEMENT' => 'danger',
                        'EATING & NUTRITION' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('task_name')
                    ->label('Task')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn($record) => $record->task_name),
                Tables\Columns\IconColumn::make('completed')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                Tables\Columns\TextColumn::make('completed_at')
                    ->label('Completed At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(40)
                    ->tooltip(fn($record) => $record->notes)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                Tables\Grouping\Group::make('date')
                    ->label('Date')
                    ->date()
                    ->collapsible(),
            ])
            ->defaultGroup('date')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'DRESSING & PERSONAL HYGIENE' => 'Dressing & Personal Hygiene',
                        'COMPANIONSHIP' => 'Companionship',
                        'HEALTH & MEDI MANAGEMENT' => 'Health & Medi Management',
                        'EATING & NUTRITION' => 'Eating & Nutrition',
                    ])
                    ->multiple(),
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
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
                Tables\Filters\TernaryFilter::make('completed')
                    ->label('Completion Status')
                    ->placeholder('All tasks')
                    ->trueLabel('Completed only')
                    ->falseLabel('Incomplete only'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\TextInput::make('client.name')
                            ->label('Client')
                            ->disabled(),
                        Forms\Components\DatePicker::make('date')
                            ->label('Date')
                            ->disabled(),
                        Forms\Components\TextInput::make('category')
                            ->label('Category')
                            ->disabled(),
                        Forms\Components\TextInput::make('task_name')
                            ->label('Task')
                            ->disabled(),
                        Forms\Components\Toggle::make('completed')
                            ->label('Completed')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('completed_at')
                            ->label('Completed At')
                            ->disabled(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->disabled()
                            ->rows(3),
                    ]),
            ])
            ->defaultSort('date', 'desc')
            ->emptyStateHeading('No checklist tasks completed')
            ->emptyStateDescription('This career staff member has not completed any daily checklist tasks yet.')
            ->emptyStateIcon('heroicon-o-clipboard-document-list');
    }
}
