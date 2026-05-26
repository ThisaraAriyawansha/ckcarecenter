<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuccessStoryResource\Pages;
use App\Models\SuccessStory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class SuccessStoryResource extends Resource
{
    protected static ?string $model = SuccessStory::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $navigationLabel = 'Success Stories';
    protected static ?int $navigationSort = 3;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make('Story Details')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Story Title')
                                    ->placeholder('e.g.,  A Comfortable Life at Care 365')
                                    ->maxLength(255),
                                    
                                Forms\Components\TextInput::make('image_alt')
                                    ->label('Image Alt Text')
                                    ->placeholder('e.g., Senior resident smiling with caregiver')
                                    ->maxLength(255)
                                    ->required(),
                                    
                                Forms\Components\Select::make('layout_type')
                                    ->label('Layout Type')
                                    ->options([
                                        'single' => 'Single Image (Full Width)',
                                        'paired_left' => 'Paired - Left Image',
                                        'paired_right' => 'Paired - Right Image',
                                    ])
                                    ->default('single')
                                    ->required()
                                    ->helperText('Select "Paired - Left" for first image in pair, "Paired - Right" for second'),
                                    
                                Forms\Components\FileUpload::make('image')
                                    ->label('Story Image')
                                    ->disk('success_stories')
                                    ->directory('')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('4:3')
                                    ->imageResizeTargetWidth('800')
                                    ->required()
                                    ->helperText('Recommended size: 800x600px')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                                    
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Display Order')
                                    ->numeric()
                                    ->default(0)
                                    ->required()
                                    ->helperText('Lower number displays first'),
                                    
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true)
                                    ->required(),
                            ])
                            ->columns(1),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('success_stories')
                    ->width(100)
                    ->height(75),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('layout_type')
                    ->label('Layout')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'single' => 'primary',
                        'paired_left' => 'success',
                        'paired_right' => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'single' => 'Single',
                        'paired_left' => 'Paired Left',
                        'paired_right' => 'Paired Right',
                    }),
                    
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter(),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('layout_type')
                    ->label('Layout Type')
                    ->options([
                        'single' => 'Single',
                        'paired_left' => 'Paired Left',
                        'paired_right' => 'Paired Right',
                    ]),
                    
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (SuccessStory $record) {
                        // Delete image file when deleting record
                        if ($record->image) {
                            Storage::disk('success_stories')->delete($record->image);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Delete image files for all selected records
                            foreach ($records as $record) {
                                if ($record->image) {
                                    Storage::disk('success_stories')->delete($record->image);
                                }
                            }
                        }),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuccessStories::route('/'),
            'create' => Pages\CreateSuccessStory::route('/create'),
            'edit' => Pages\EditSuccessStory::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}