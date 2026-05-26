<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PayslipResource\Pages;
use App\Filament\Resources\PayslipResource\RelationManagers;
use App\Models\Payslip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PayslipResource extends Resource
{
    protected static ?string $model = Payslip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'HR Management';

    protected static ?string $navigationLabel = 'Payslips';

    /**
     * Allow admin, manager, career, and chef to view payslips
     * Non-admin users can only see their own payslips
     */
    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager', 'career', 'chef']);
    }

    /**
     * Query modification based on user role
     * Career, chef, and manager see only their own payslips
     * Admin sees all payslips
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        // Non-admin users can only see their own payslips
        if (!$user->hasRole('admin')) {
            // Find the career record linked to this user
            $career = \App\Models\Career::where('user_id', $user->id)->first();

            if ($career) {
                $query->where('career_id', $career->id);
            } else {
                // If no career record found, show no payslips
                $query->whereRaw('1 = 0');
            }
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('career_id')
                    ->relationship('career', 'id')
                    ->required(),
                Forms\Components\TextInput::make('payslip_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('month')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('year')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('payment_date')
                    ->required(),
                Forms\Components\TextInput::make('basic_salary')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('allowances')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('overtime')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('bonus')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('gross_salary')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('epf_employee')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('tax')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('other_deductions')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_deductions')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('net_salary')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\DateTimePicker::make('sent_at'),
                Forms\Components\TextInput::make('generated_by')
                    ->numeric(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('career.full_name')
                    ->label('Employee Name')
                    ->searchable()
                    ->sortable()
                    ->visible(fn() => auth()->user()->hasRole('admin')),

                Tables\Columns\TextColumn::make('payslip_number')
                    ->label('Payslip Number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('month')
                    ->label('Month')
                    ->formatStateUsing(fn ($state) => date('F', mktime(0, 0, 0, $state, 1)))
                    ->sortable(),

                Tables\Columns\TextColumn::make('year')
                    ->label('Year')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('gross_salary')
                    ->label('Gross Salary')
                    ->money('LKR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_deductions')
                    ->label('Deductions')
                    ->money('LKR')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('net_salary')
                    ->label('Net Salary')
                    ->money('LKR')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'sent' => 'warning',
                        'paid' => 'success',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                Tables\Columns\TextColumn::make('basic_salary')
                    ->label('Basic Salary')
                    ->money('LKR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('allowances')
                    ->label('Allowances')
                    ->money('LKR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('overtime')
                    ->label('Overtime')
                    ->money('LKR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('bonus')
                    ->label('Bonus')
                    ->money('LKR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('epf_employee')
                    ->label('EPF (8%)')
                    ->money('LKR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('tax')
                    ->label('Tax')
                    ->money('LKR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('other_deductions')
                    ->label('Other Deductions')
                    ->money('LKR')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('sent_at')
                    ->label('Sent At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('generatedBy.name')
                    ->label('Generated By')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visible(fn() => auth()->user()->hasRole('admin')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('payment_date', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('download_pdf')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function ($record) {
                        // Load the career relationship if not already loaded
                        $record->load('career');

                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.payslip', [
                            'payslip' => $record
                        ]);

                        $pdf->setPaper('a4', 'portrait');

                        $filename = 'payslip-' . $record->payslip_number . '-' . $record->career->full_name . '.pdf';

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, $filename);
                    }),

                Tables\Actions\ViewAction::make()
                    ->visible(fn() => auth()->user()->hasRole('admin')),

                Tables\Actions\EditAction::make()
                    ->visible(fn() => auth()->user()->hasRole('admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn() => auth()->user()->hasRole('admin')),
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
            'index' => Pages\ListPayslips::route('/'),
            'create' => Pages\CreatePayslip::route('/create'),
            'edit' => Pages\EditPayslip::route('/{record}/edit'),
        ];
    }

    /**
     * Determine if a user can create a payslip
     * Only admins can create payslips
     */
    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine if a user can edit a payslip
     * Only admins can edit payslips
     */
    public static function canEdit($record): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine if a user can delete a payslip
     * Only admins can delete payslips
     */
    public static function canDelete($record): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Determine if a user can delete multiple payslips
     * Only admins can bulk delete payslips
     */
    public static function canDeleteAny(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
