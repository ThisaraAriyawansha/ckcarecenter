<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhoweareResource\Pages;
use App\Models\Whoweare;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class WhoweareResource extends Resource
{
    protected static ?string $model = Whoweare::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Who We Are';

    protected static ?string $navigationGroup = 'Frontend Management';

    protected static ?int $navigationSort = 8;
    
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->columnSpan(1),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(6)
                            ->maxLength(3000)
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('display_order')
                            ->label('Display Order')
                            ->helperText('Lower number = appears first (e.g. 1, 2, 3...)')
                            ->numeric()
                            ->default(999)
                            ->minValue(1)
                            ->required()
                            ->columnSpan(1),

                        Forms\Components\Toggle::make('is_public')
                            ->label('Publicly Visible')
                            ->default(true)
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Image')
                            ->image()
                            ->imageEditor()
                            ->directory('')
                            ->disk('whoweare_public')
                            ->preserveFilenames(false)
                            ->maxSize(3072) // 3MB
                            ->imageResizeTargetWidth(800)
                            ->imageResizeTargetHeight(600)
                            ->getUploadedFileNameForStorageUsing(function ($file): string {
                                $ext = $file->getClientOriginalExtension();
                                $timestamp = now()->format('YmdHis');
                                $random = Str::random(8);
                                return "whoweare_{$timestamp}_{$random}.{$ext}";
                            })
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->disk('whoweare_public')
                    ->label('Image')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->description)
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('display_order')
                    ->label('Order')
                    ->sortable()
                    ->numeric(),

                Tables\Columns\IconColumn::make('is_public')
                    ->label('Public')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('display_order', 'asc') // keeps your ordering
            ->filters([
                Tables\Filters\TernaryFilter::make('is_public')
                    ->label('Visibility')
                    ->placeholder('All')
                    ->trueLabel('Public Only')
                    ->falseLabel('Private Only'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'   => Pages\ListWhoweares::route('/'),            // /admin/whoweares
            'create'  => Pages\CreateWhoweare::route('/create'),     // /admin/whoweares/create
            'edit'    => Pages\EditWhoweare::route('/{record}/edit'), // /admin/whoweares/1/edit
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}