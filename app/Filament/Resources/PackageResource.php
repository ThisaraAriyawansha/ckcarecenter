<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Set;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Frontend Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Package Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('title_slug', Str::slug($state));
                            }),

                        Forms\Components\TextInput::make('title_slug')
                            ->label('URL Slug')
                            ->required()
                            ->maxLength(120)
                            ->unique(Package::class, 'title_slug', ignoreRecord: true)
                            ->helperText('Auto-generated from title'),

                        Forms\Components\Select::make('status')
                            ->options(Package::getStatuses())
                            ->default('active')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Package Features & Inclusions')
                    ->description('List what is included in this package.')
                    ->collapsible()
                    ->schema([
                        Repeater::make('features')
                            ->relationship('features')
                            ->label('Features')
                            ->schema([
                                Forms\Components\TextInput::make('feature')
                                    ->label('Feature / Inclusion')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g. Daily breakfast, Free Wi-Fi, Airport transfer'),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->inline(false)
                                    ->default(true),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->collapsible()
                            ->cloneable()
                            ->reorderable()
                            ->itemLabel(fn (array $state): ?string => $state['feature'] ?? 'New feature')
                            ->addActionLabel('Add new feature')
                            ->grid(2),
                    ]),

                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price_lkr')
                            ->label('Price (LKR)')
                            ->required()
                            ->numeric()
                            ->prefix('Rs.')
                            ->minValue(0)
                            ->step(0.01),

                        Forms\Components\TextInput::make('price_usd')
                            ->label('Price (USD)')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->step(0.01),
                    ])->columns(2),

                Forms\Components\Section::make('Room Details')
                    ->schema([
                        Forms\Components\TextInput::make('room_type')
                            ->required()
                            ->maxLength(50)
                            ->default('Shared by 2 persons'),

                        Forms\Components\TextInput::make('sharing_capacity')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->default(2),

                        Forms\Components\Select::make('bathroom_type')
                            ->options(Package::getBathroomTypes())
                            ->default('mixed')
                            ->required(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title_slug')
                    ->label('Slug')
                    ->copyable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_lkr')
                    ->label('Price (LKR)')
                    ->money('LKR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('room_type')
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->options(Package::getStatuses())
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Package::getStatuses()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('activate')
                    ->label('Activate')
                    ->action(fn ($records) => $records->each->update(['status' => 'active']))
                    ->icon('heroicon-o-check'),
                Tables\Actions\BulkAction::make('deactivate')
                    ->label('Deactivate')
                    ->action(fn ($records) => $records->each->update(['status' => 'inactive']))
                    ->icon('heroicon-o-x-mark'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add relation manager later if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit'   => Pages\EditPackage::route('/{record}/edit'),
            // 'view'   => Pages\ViewPackage::route('/{record}'),  // Keep commented or remove if not generated
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}