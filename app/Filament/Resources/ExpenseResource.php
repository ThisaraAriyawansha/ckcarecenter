<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Expenses';

    protected static ?string $modelLabel = 'Expense';

    protected static ?string $navigationGroup = 'Finance';

    protected static ?int $navigationSort = 1;

    /**
     * Only admins and managers can see this resource
     */
    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager']);
    }

    /**
     * Query modification based on user role
     * Managers see only their branch's expenses
     * Admins see all expenses
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = auth()->user();

        // Managers can only see expenses from their branch
        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
            $query->where('branch_id', $user->branch_id);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        $categories = [
            'Groceries' => 'Groceries',
            'Laundry' => 'Laundry',
            'Cleaning' => 'Cleaning',
            'Transport' => 'Transport',
            'Bills' => 'Bills',
            'House Rent' => 'House Rent',
            'Services' => 'Services',
            'Medical' => 'Medical',
            'Salaries' => 'Salaries',
            'Marketing' => 'Marketing',
            'Monthly Settlement' => 'Monthly Settlement',
            'Other' => 'Other',
            'Capital' => 'Capital',
            'Refund' => 'Refund',
        ];

        $subCategories = [
            'Groceries' => ['Supermarket', 'Shops'],
            'Bills' => ['Electricity', 'Water', 'Mobile', 'Internet', 'Other'],
            'Salaries' => ['Staff 1', 'Staff 2', 'Staff 3', 'Other'],
        ];

        return $form
            ->schema([
                Forms\Components\Section::make('Expense Information')
                    ->schema([
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->relationship('branch', 'name', function ($query) {
                                $user = auth()->user();
                                // Managers can only select their own branch
                                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                    $query->where('id', $user->branch_id);
                                }
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(function () {
                                // Auto-select manager's branch
                                $user = auth()->user();
                                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                                    return $user->branch_id;
                                }
                                return null;
                            })
                            ->disabled(fn () => auth()->user()->hasRole('manager') && !auth()->user()->hasRole('admin'))
                            ->dehydrated()
                            ->native(false)
                            ->columnSpan(1),

                        Forms\Components\Select::make('user_id')
                            ->label('Spend By')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->native(false)
                            ->placeholder('Select a user')
                            ->columnSpan(1),

                        Forms\Components\DatePicker::make('expense_date')
                            ->label('Expense Date')
                            ->required()
                            ->default(today())
                            ->native(false)
                            ->maxDate(today())
                            ->columnSpan(1),

                        Forms\Components\Select::make('category')
                            ->label('Category')
                            ->options($categories)
                            ->required()
                            ->searchable()
                            ->native(false)
                            ->live()
                            ->columnSpan(1),

                        Forms\Components\Select::make('sub_category')
                            ->label('Sub Category')
                            ->options(function (callable $get) use ($subCategories) {
                                $category = $get('category');
                                return $subCategories[$category] ?? [];
                            })
                            ->searchable()
                            ->native(false)
                            ->visible(fn (callable $get) => in_array($get('category'), ['Groceries', 'Bills', 'Salaries']))
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('amount')
                            ->label('Amount (LKR)')
                            ->required()
                            ->numeric()
                            ->prefix('LKR')
                            ->minValue(0)
                            ->step(0.01)
                            ->columnSpan(1),

                        Forms\Components\Select::make('payment_method')
                            ->label('Payment Method')
                            ->options([
                                'Cash' => 'Cash',
                                'Bank Transfer' => 'Bank Transfer',
                                'Card' => 'Card',
                                'Check' => 'Check',
                                'Online Payment' => 'Online Payment',
                            ])
                            ->native(false)
                            ->columnSpan(1),
                    ])->columns(2),

                Forms\Components\Section::make('Additional Details')
                    ->schema([
                        Forms\Components\TextInput::make('vendor_name')
                            ->label('Vendor/Supplier Name')
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('receipt_number')
                            ->label('Receipt/Invoice Number')
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpan(2),

                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpan(2),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expense_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Spend By')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Groceries' => 'success',
                        'Salaries' => 'danger',
                        'Bills' => 'warning',
                        'House Rent' => 'info',
                        'Medical' => 'danger',
                        'Transport' => 'gray',
                        'Capital' => 'purple',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sub_category')
                    ->label('Sub Category')
                    ->searchable()
                    ->toggleable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->money('LKR')
                    ->sortable()
                    ->searchable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('LKR')
                            ->label('Total'),
                    ]),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment')
                    ->toggleable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('vendor_name')
                    ->label('Vendor')
                    ->searchable()
                    ->toggleable()
                    ->limit(30)
                    ->default('-'),

                Tables\Columns\TextColumn::make('description')
                    ->limit(40)
                    ->toggleable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Created By')
                    ->toggleable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('expense_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('branch_id')
                    ->label('Branch')
                    ->relationship('branch', 'name')
                    ->searchable()
                    ->preload()
                    ->visible(fn () => auth()->user()->hasRole('admin')),

                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Groceries' => 'Groceries',
                        'Laundry' => 'Laundry',
                        'Cleaning' => 'Cleaning',
                        'Transport' => 'Transport',
                        'Bills' => 'Bills',
                        'House Rent' => 'House Rent',
                        'Services' => 'Services',
                        'Medical' => 'Medical',
                        'Salaries' => 'Salaries',
                        'Marketing' => 'Marketing',
                        'Monthly Settlement' => 'Monthly Settlement',
                        'Other' => 'Other',
                        'Capital' => 'Capital',
                        'Refund' => 'Refund',
                    ])
                    ->searchable(),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'Cash' => 'Cash',
                        'Bank Transfer' => 'Bank Transfer',
                        'Card' => 'Card',
                        'Check' => 'Check',
                        'Online Payment' => 'Online Payment',
                    ])
                    ->placeholder('All Methods'),

                Tables\Filters\SelectFilter::make('sub_category')
                    ->label('Sub Category')
                    ->options([
                        'Supermarket' => 'Supermarket',
                        'Shops' => 'Shops',
                        'Electricity' => 'Electricity',
                        'Water' => 'Water',
                        'Mobile' => 'Mobile',
                        'Internet' => 'Internet',
                        'Staff 1' => 'Staff 1',
                        'Staff 2' => 'Staff 2',
                        'Staff 3' => 'Staff 3',
                        'Other' => 'Other',
                    ])
                    ->placeholder('All Sub Categories'),

                Tables\Filters\Filter::make('expense_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->native(false),
                        Forms\Components\DatePicker::make('until')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('expense_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('expense_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
