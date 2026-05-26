<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DayPackageResource\Pages;
use App\Models\DayPackage;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DayPackageResource extends Resource
{
    protected static ?string $model = DayPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Day Packages';

    protected static ?string $navigationGroup = 'Frontend Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Package Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Basic Day Care Package')
                            ->columnSpan(1),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.')
                            ->minValue(0)
                            ->maxValue(9999999.99)
                            ->step(0.01)
                            ->placeholder('2500.00')
                            ->columnSpan(1),

                        Toggle::make('active')
                            ->label('Active (Visible on website)')
                            ->default(true)
                            ->inline(false)
                            ->columnSpan(2),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold),

                TextColumn::make('price')
                    ->money('LKR')  // shows as Rs. 2,500.00 (nice formatting)
                    ->sortable()
                    ->searchable(),

                IconColumn::make('active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Status')
                    ->placeholder('All packages')
                    ->trueLabel('Active Only')
                    ->falseLabel('Inactive Only'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index'  => Pages\ListDayPackages::route('/'),
            'create' => Pages\CreateDayPackage::route('/create'),
            'edit'   => Pages\EditDayPackage::route('/{record}/edit'),
            // Removed 'view' to avoid error – add later if needed with: php artisan make:filament-page ViewDayPackage --resource=DayPackageResource --type=view-record
        ];
    }
}