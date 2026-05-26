<?php

namespace App\Filament\Resources\CareerResource\RelationManagers;

use App\Mail\PayslipMail;
use App\Models\Payslip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class PayslipsRelationManager extends RelationManager
{
    protected static string $relationship = 'payslips';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
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
                            ->required()
                            ->default(now()->month),

                        Forms\Components\TextInput::make('year')
                            ->label('Year')
                            ->numeric()
                            ->required()
                            ->default(now()->year)
                            ->minValue(2020)
                            ->maxValue(2050),

                        Forms\Components\DatePicker::make('payment_date')
                            ->label('Payment Date')
                            ->required()
                            ->default(now()),
                    ]),

                Forms\Components\Section::make('Earnings')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('basic_salary')
                                    ->label('Basic Salary')
                                    ->numeric()
                                    ->prefix('LKR')
                                    ->required()
                                    ->default(fn () => $this->getOwnerRecord()->salary ?? 0)
                                    ->live()
                                    ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => self::updateTotals($set, $get)),

                                Forms\Components\TextInput::make('allowances')
                                    ->label('Allowances')
                                    ->numeric()
                                    ->prefix('LKR')
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => self::updateTotals($set, $get)),

                                Forms\Components\TextInput::make('overtime')
                                    ->label('Overtime')
                                    ->numeric()
                                    ->prefix('LKR')
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => self::updateTotals($set, $get)),

                                Forms\Components\TextInput::make('bonus')
                                    ->label('Bonus')
                                    ->numeric()
                                    ->prefix('LKR')
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => self::updateTotals($set, $get)),
                            ]),

                        Forms\Components\TextInput::make('gross_salary')
                            ->label('Gross Salary')
                            ->numeric()
                            ->prefix('LKR')
                            ->required()
                            ->readOnly()
                            ->default(0),
                    ]),

                Forms\Components\Section::make('Deductions')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('epf_employee')
                                    ->label('EPF (Employee 8%)')
                                    ->numeric()
                                    ->prefix('LKR')
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => self::updateTotals($set, $get)),

                                Forms\Components\TextInput::make('tax')
                                    ->label('Tax')
                                    ->numeric()
                                    ->prefix('LKR')
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => self::updateTotals($set, $get)),

                                Forms\Components\TextInput::make('other_deductions')
                                    ->label('Other Deductions')
                                    ->numeric()
                                    ->prefix('LKR')
                                    ->default(0)
                                    ->live()
                                    ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => self::updateTotals($set, $get)),
                            ]),

                        Forms\Components\TextInput::make('total_deductions')
                            ->label('Total Deductions')
                            ->numeric()
                            ->prefix('LKR')
                            ->required()
                            ->readOnly()
                            ->default(0),
                    ]),

                Forms\Components\Section::make('Summary')
                    ->schema([
                        Forms\Components\TextInput::make('net_salary')
                            ->label('Net Salary')
                            ->numeric()
                            ->prefix('LKR')
                            ->required()
                            ->readOnly()
                            ->extraInputAttributes(['class' => 'font-bold text-lg'])
                            ->default(0),

                        Forms\Components\Select::make('status')
                            ->options(Payslip::getStatusLabels())
                            ->default('draft')
                            ->required(),

                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    protected static function updateTotals(Forms\Set $set, Forms\Get $get): void
    {
        $basicSalary = (float) ($get('basic_salary') ?? 0);
        $allowances = (float) ($get('allowances') ?? 0);
        $overtime = (float) ($get('overtime') ?? 0);
        $bonus = (float) ($get('bonus') ?? 0);

        $grossSalary = $basicSalary + $allowances + $overtime + $bonus;
        $set('gross_salary', number_format($grossSalary, 2, '.', ''));

        $epf = (float) ($get('epf_employee') ?? 0);
        $tax = (float) ($get('tax') ?? 0);
        $otherDeductions = (float) ($get('other_deductions') ?? 0);

        $totalDeductions = $epf + $tax + $otherDeductions;
        $set('total_deductions', number_format($totalDeductions, 2, '.', ''));

        $netSalary = $grossSalary - $totalDeductions;
        $set('net_salary', number_format($netSalary, 2, '.', ''));
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('payslip_number')
            ->columns([
                Tables\Columns\TextColumn::make('payslip_number')
                    ->label('Payslip #')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('month_name')
                    ->label('Month')
                    ->sortable('month'),

                Tables\Columns\TextColumn::make('year')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('gross_salary')
                    ->label('Gross')
                    ->money('LKR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_deductions')
                    ->label('Deductions')
                    ->money('LKR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('net_salary')
                    ->label('Net Salary')
                    ->money('LKR')
                    ->weight('bold')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'sent',
                        'primary' => 'paid',
                    ])
                    ->formatStateUsing(fn ($state) => Payslip::getStatusLabels()[$state] ?? $state),

                Tables\Columns\TextColumn::make('sent_at')
                    ->label('Sent On')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Payslip::getStatusLabels()),

                Tables\Filters\SelectFilter::make('year')
                    ->options(function () {
                        $currentYear = now()->year;
                        $years = [];
                        for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                            $years[$i] = $i;
                        }
                        return $years;
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['generated_by'] = auth()->id();
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('send_email')
                    ->label('Send Email')
                    ->icon('heroicon-o-envelope')
                    ->color('success')
                    ->visible(fn (Payslip $record) => $record->status !== 'sent')
                    ->requiresConfirmation()
                    ->action(function (Payslip $record) {
                        try {
                            Mail::to($record->career->email)->send(new PayslipMail($record));

                            $record->update([
                                'status' => 'sent',
                                'sent_at' => now(),
                            ]);

                            Notification::make()
                                ->title('Payslip sent successfully')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Failed to send payslip')
                                ->danger()
                                ->body($e->getMessage())
                                ->send();
                        }
                    }),

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn (Payslip $record) => $record->status === 'draft'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
