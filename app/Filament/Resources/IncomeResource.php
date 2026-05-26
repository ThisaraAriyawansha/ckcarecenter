<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IncomeResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    protected static ?string $navigationLabel = 'Income';

    protected static ?string $modelLabel = 'Income';

    protected static ?string $pluralModelLabel = 'Income';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = auth()->user();

        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
            $query->where('branch_id', $user->branch_id);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Income / Payment Information')
                    ->schema([
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->relationship('branch', 'name', function ($query) {
                                $user = auth()->user();
                                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                    $query->where('id', $user->branch_id);
                                }
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(function () {
                                $user = auth()->user();
                                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                    return $user->branch_id;
                                }
                                return null;
                            })
                            ->disabled(fn () => auth()->user()->hasRole('manager') && !auth()->user()->hasRole('admin'))
                            ->dehydrated()
                            ->native(false),

                        Forms\Components\Select::make('client_id')
                            ->label('Client')
                            ->relationship('client', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false),

                        Forms\Components\Select::make('payment_type')
                            ->label('Payment Type')
                            ->options([
                                'Monthly Fee' => 'Monthly Fee',
                                'Medical Expenses' => 'Medical Expenses',
                                'Activity Fee' => 'Activity Fee',
                                'Special Care' => 'Special Care',
                                'Equipment' => 'Equipment',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->searchable()
                            ->native(false),

                        Forms\Components\DatePicker::make('payment_date')
                            ->label('Payment Date')
                            ->required()
                            ->default(today())
                            ->native(false)
                            ->maxDate(today()),

                        Forms\Components\TextInput::make('amount')
                            ->label('Amount (LKR)')
                            ->required()
                            ->numeric()
                            ->prefix('LKR')
                            ->minValue(0)
                            ->step(0.01),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->rows(3)
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('payment_type')
                    ->label('Payment Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Monthly Fee' => 'success',
                        'Medical Expenses' => 'danger',
                        'Activity Fee' => 'info',
                        'Special Care' => 'warning',
                        'Equipment' => 'gray',
                        default => 'gray',
                    })
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->money('LKR')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('LKR')
                            ->label('Total Income'),
                    ]),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(40)
                    ->toggleable(),

                Tables\Columns\IconColumn::make('email_sent')
                    ->label('Receipt Sent')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('Recorded By')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('payment_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('branch_id')
                    ->label('Branch')
                    ->relationship('branch', 'name')
                    ->searchable()
                    ->preload()
                    ->visible(fn () => auth()->user()->hasRole('admin')),

                Tables\Filters\SelectFilter::make('payment_type')
                    ->label('Payment Type')
                    ->options([
                        'Monthly Fee' => 'Monthly Fee',
                        'Medical Expenses' => 'Medical Expenses',
                        'Activity Fee' => 'Activity Fee',
                        'Special Care' => 'Special Care',
                        'Equipment' => 'Equipment',
                        'Other' => 'Other',
                    ])
                    ->placeholder('All Types'),

                Tables\Filters\SelectFilter::make('client_id')
                    ->label('Client')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('All Clients'),

                Tables\Filters\Filter::make('payment_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('From')
                            ->native(false),
                        Forms\Components\DatePicker::make('until')
                            ->label('Until')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('payment_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('payment_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->hasRole('admin')),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIncome::route('/'),
            'create' => Pages\CreateIncome::route('/create'),
            'edit' => Pages\EditIncome::route('/{record}/edit'),
        ];
    }
}
