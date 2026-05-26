<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\ClientDailyChecklist;
use Carbon\Carbon;
use Filament\Notifications\Notification;

class DailyChecklistsRelationManager extends RelationManager
{
    protected static string $relationship = 'dailyChecklists';

    protected static ?string $title = 'Daily/Weekly Checklist';

    protected static ?string $icon = 'heroicon-o-clipboard-document-check';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->required()
                    ->default(now())
                    ->native(false),
                Forms\Components\Select::make('category')
                    ->label('Category')
                    ->options([
                        'DRESSING & PERSONAL HYGIENE' => 'Dressing & Personal Hygiene',
                        'COMPANIONSHIP' => 'Companionship',
                        'HEALTH & MEDI MANAGEMENT' => 'Health & Medi Management',
                        'EATING & NUTRITION' => 'Eating & Nutrition',
                    ])
                    ->required()
                    ->reactive()
                    ->native(false),
                Forms\Components\Select::make('task_key')
                    ->label('Task')
                    ->options(function (callable $get) {
                        $category = $get('category');
                        if (!$category) {
                            return [];
                        }
                        $tasks = ClientDailyChecklist::getChecklistTasks();
                        return $tasks[$category] ?? [];
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $tasks = ClientDailyChecklist::getChecklistTasks();
                            foreach ($tasks as $category => $categoryTasks) {
                                if (isset($categoryTasks[$state])) {
                                    $set('task_name', $categoryTasks[$state]);
                                    break;
                                }
                            }
                        }
                    })
                    ->native(false),
                Forms\Components\Hidden::make('task_name'),
                Forms\Components\Select::make('day_of_week')
                    ->label('Day of Week')
                    ->options([
                        'Monday' => 'Monday',
                        'Tuesday' => 'Tuesday',
                        'Wednesday' => 'Wednesday',
                        'Thursday' => 'Thursday',
                        'Friday' => 'Friday',
                        'Saturday' => 'Saturday',
                        'Sunday' => 'Sunday',
                    ])
                    ->native(false),
                Forms\Components\Toggle::make('completed')
                    ->label('Mark as Completed')
                    ->default(false)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $set('completed_by', auth()->id());
                            $set('completed_at', now());
                        } else {
                            $set('completed_by', null);
                            $set('completed_at', null);
                        }
                    }),
                Forms\Components\Hidden::make('completed_by'),
                Forms\Components\Hidden::make('completed_at'),
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                // Careers can only see today's tasks
                if (auth()->user()->hasRole('career')) {
                    $query->where('date', today());
                }
                // Admins and managers can see all dates
            })
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(fn () => auth()->user()->hasRole('career')),
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Day')
                    ->badge()
                    ->sortable()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color('primary')
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('task_name')
                    ->label('Task')
                    ->wrap()
                    ->searchable()
                    ->weight('medium'),
                Tables\Columns\IconColumn::make('completed')
                    ->label('Completed')
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
                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(50)
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('date')
                    ->label('Select Date')
                    ->options(function () {
                        return collect(range(0, 30))->mapWithKeys(function ($day) {
                            $date = now()->subDays($day);
                            return [$date->format('Y-m-d') => $date->format('M d, Y (l)')];
                        });
                    })
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'DRESSING & PERSONAL HYGIENE' => 'Dressing & Personal Hygiene',
                        'COMPANIONSHIP' => 'Companionship',
                        'HEALTH & MEDI MANAGEMENT' => 'Health & Medi Management',
                        'EATING & NUTRITION' => 'Eating & Nutrition',
                    ]),
                Tables\Filters\TernaryFilter::make('completed')
                    ->label('Completion Status')
                    ->placeholder('All tasks')
                    ->trueLabel('Completed only')
                    ->falseLabel('Pending only'),
            ])
            ->headerActions([
                Tables\Actions\Action::make('generate_today_checklist')
                    ->label(function (RelationManager $livewire) {
                        $client = $livewire->getOwnerRecord();
                        $todayExists = ClientDailyChecklist::where('client_id', $client->id)
                            ->where('date', today())
                            ->exists();

                        return $todayExists ? 'Today\'s Checklist Already Generated' : 'Generate Today\'s Checklist';
                    })
                    ->icon('heroicon-o-document-plus')
                    ->color(function (RelationManager $livewire) {
                        $client = $livewire->getOwnerRecord();
                        $todayExists = ClientDailyChecklist::where('client_id', $client->id)
                            ->where('date', today())
                            ->exists();

                        return $todayExists ? 'gray' : 'success';
                    })
                    ->disabled(function (RelationManager $livewire) {
                        $client = $livewire->getOwnerRecord();
                        return ClientDailyChecklist::where('client_id', $client->id)
                            ->where('date', today())
                            ->exists();
                    })
                    ->action(function (RelationManager $livewire) {
                        $client = $livewire->getOwnerRecord();
                        $today = now()->toDateString();
                        $dayOfWeek = now()->format('l');

                        $tasks = ClientDailyChecklist::getChecklistTasks();
                        $created = 0;

                        foreach ($tasks as $category => $categoryTasks) {
                            foreach ($categoryTasks as $taskKey => $taskName) {
                                // Check if task already exists for today
                                $exists = ClientDailyChecklist::where('client_id', $client->id)
                                    ->where('date', $today)
                                    ->where('task_key', $taskKey)
                                    ->exists();

                                if (!$exists) {
                                    ClientDailyChecklist::create([
                                        'client_id' => $client->id,
                                        'date' => $today,
                                        'category' => $category,
                                        'task_key' => $taskKey,
                                        'task_name' => $taskName,
                                        'day_of_week' => $dayOfWeek,
                                        'completed' => false,
                                    ]);
                                    $created++;
                                }
                            }
                        }

                        Notification::make()
                            ->title('Checklist Generated')
                            ->body("Created {$created} tasks for today.")
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Generate Today\'s Checklist?')
                    ->modalDescription('This will create all checklist tasks for today. Tasks that already exist will not be duplicated.')
                    ->modalSubmitActionLabel('Generate'),
                Tables\Actions\CreateAction::make()
                    ->label('Add Custom Task')
                    ->icon('heroicon-o-plus')
                    ->mutateFormDataUsing(function (array $data, RelationManager $livewire): array {
                        if (!isset($data['day_of_week']) || !$data['day_of_week']) {
                            $data['day_of_week'] = Carbon::parse($data['date'])->format('l');
                        }
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle_complete')
                    ->label(fn (ClientDailyChecklist $record) => $record->completed ? 'Mark Incomplete' : 'Mark Complete')
                    ->icon(fn (ClientDailyChecklist $record) => $record->completed ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn (ClientDailyChecklist $record) => $record->completed ? 'danger' : 'success')
                    ->visible(function (ClientDailyChecklist $record) {
                        // If task is not completed, anyone can mark it complete
                        if (!$record->completed) {
                            return true;
                        }

                        // If task is completed, only the person who completed it or admin/manager can modify
                        return $record->completed_by === auth()->id()
                            || auth()->user()->hasAnyRole(['admin', 'manager']);
                    })
                    ->form([
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes (Optional)')
                            ->rows(2)
                            ->default(fn (ClientDailyChecklist $record) => $record->notes),
                    ])
                    ->action(function (ClientDailyChecklist $record, array $data) {
                        // Double-check permission before changing
                        if ($record->completed && $record->completed_by !== auth()->id() && !auth()->user()->hasAnyRole(['admin', 'manager'])) {
                            Notification::make()
                                ->title('Permission Denied')
                                ->body('This task was completed by ' . $record->completedBy->name . '. Only they or an admin can modify it.')
                                ->danger()
                                ->send();
                            return;
                        }

                        if ($record->completed) {
                            // Mark as incomplete
                            $record->update([
                                'completed' => false,
                                'completed_by' => null,
                                'completed_at' => null,
                                'notes' => $data['notes'] ?? $record->notes,
                            ]);

                            Notification::make()
                                ->title('Task marked as incomplete')
                                ->success()
                                ->send();
                        } else {
                            // Mark as complete
                            $record->update([
                                'completed' => true,
                                'completed_by' => auth()->id(),
                                'completed_at' => now(),
                                'notes' => $data['notes'] ?? $record->notes,
                            ]);

                            Notification::make()
                                ->title('Task completed successfully')
                                ->body('Completed by ' . auth()->user()->name)
                                ->success()
                                ->send();
                        }
                    }),
                Tables\Actions\EditAction::make()
                    ->visible(function (ClientDailyChecklist $record) {
                        // Can only edit if not completed, or if you completed it, or if admin/manager
                        return !$record->completed
                            || $record->completed_by === auth()->id()
                            || auth()->user()->hasAnyRole(['admin', 'manager']);
                    }),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                ]),
            ])
            ->defaultSort('date', 'desc')
            ->emptyStateHeading('No checklist tasks yet')
            ->emptyStateDescription('Click "Generate Today\'s Checklist" to create all daily tasks for today.')
            ->emptyStateIcon('heroicon-o-clipboard-document-check');
    }
}
