<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MedicationChartExport;
use Filament\Notifications\Notification;

class MedicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'medications';

    protected static ?string $title = 'Medications';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Medication Details')
                    ->schema([
                        Forms\Components\TextInput::make('drug_name')
                            ->label('Drug Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('dosage')
                            ->label('Dosage')
                            ->maxLength(255)
                            ->helperText('e.g., 500mg, 2 tablets, 5ml'),
                        Forms\Components\Select::make('frequency')
                            ->label('Time of Day')
                            ->options([
                                'morning' => 'Morning Only',
                                'afternoon' => 'Afternoon Only',
                                'evening' => 'Evening Only',
                                'morning_afternoon' => 'Morning & Afternoon',
                                'morning_evening' => 'Morning & Evening',
                                'afternoon_evening' => 'Afternoon & Evening',
                                'all_three' => 'Three Times Daily (Morning, Afternoon & Evening)',
                            ])
                            ->required()
                            ->native(false)
                            ->helperText('Select when this medication should be given'),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required()
                            ->default(now()),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('End Date')
                            ->helperText('Leave empty for ongoing medication'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Inactive medications won\'t appear in daily records'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Instructions')
                    ->schema([
                        Forms\Components\Textarea::make('instructions')
                            ->label('Special Instructions')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('e.g., Take with food, Take before bedtime'),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('drug_name')
            ->columns([
                Tables\Columns\TextColumn::make('drug_name')
                    ->label('Drug Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dosage')
                    ->label('Dosage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('frequency')
                    ->label('Frequency')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match($state) {
                        'morning' => 'Morning',
                        'afternoon' => 'Afternoon',
                        'evening' => 'Evening',
                        'morning_afternoon' => 'Morning & Afternoon',
                        'morning_evening' => 'Morning & Evening',
                        'afternoon_evening' => 'Afternoon & Evening',
                        'all_three' => '3x Daily',
                        default => $state,
                    })
                    ->color(fn ($state) => match($state) {
                        'morning' => 'warning',
                        'afternoon' => 'info',
                        'evening' => 'success',
                        'all_three' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->date()
                    ->sortable()
                    ->placeholder('Ongoing'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Active medications')
                    ->falseLabel('Inactive medications')
                    ->placeholder('All medications'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Medication')
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                Tables\Actions\Action::make('export_chart')
                    ->label('Export Monthly Chart')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager']))
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
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
                                        $currentYear = now()->year;
                                        for ($i = $currentYear - 2; $i <= $currentYear + 1; $i++) {
                                            $years[$i] = $i;
                                        }
                                        return $years;
                                    })
                                    ->default(now()->year)
                                    ->required()
                                    ->native(false),
                            ]),
                    ])
                    ->action(function (array $data, RelationManager $livewire) {
                        $client = $livewire->getOwnerRecord();
                        $monthName = date('F', mktime(0, 0, 0, $data['month'], 1));
                        $fileName = "medication_chart_{$client->name}_{$monthName}_{$data['year']}.xlsx";

                        Notification::make()
                            ->title('Export started')
                            ->success()
                            ->send();

                        return Excel::download(
                            new MedicationChartExport($client->id, $data['month'], $data['year']),
                            $fileName
                        );
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
            ])
            ->defaultSort('created_at', 'desc');
    }
}
