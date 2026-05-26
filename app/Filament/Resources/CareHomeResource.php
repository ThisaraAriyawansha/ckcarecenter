<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareHomeResource\Pages;
use App\Models\CareHome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CareHomeResource extends Resource
{
    protected static ?string $model = CareHome::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationLabel = 'Care Homes';

    protected static ?string $navigationGroup = 'Frontend Management';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('subtitle')
                            ->maxLength(150)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('location')
                            ->maxLength(150)
                            ->placeholder('e.g. Tangalle, Matara')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('contact_no')
                            ->label('Contact Number')
                            ->tel()
                            ->maxLength(30)
                            ->placeholder('+94 71 234 5678')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('badge_text')
                            ->maxLength(50)
                            ->placeholder('e.g. New, Premium, Recommended')
                            ->columnSpan(1),

                        Forms\Components\Toggle::make('is_public')
                            ->label('Publicly Visible')
                            ->default(true)
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Description & Image')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->rows(6)
                            ->maxLength(4000)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image_path')
                            ->label('Main Image')
                            ->image()
                            ->imageEditor()
                            ->directory('')
                            ->disk('care_homes_public')
                            ->preserveFilenames(false)
                            ->maxSize(3072) // 3MB
                            ->imageResizeTargetWidth(800)
                            ->imageResizeTargetHeight(600)
                            ->getUploadedFileNameForStorageUsing(function ($file): string {
                                $ext = $file->getClientOriginalExtension();
                                $timestamp = now()->format('YmdHis');
                                $random = Str::random(8);
                                return "carehome_{$timestamp}_{$random}.{$ext}";
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
                    ->disk('care_homes_public')
                    ->label('Image')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('contact_no')
                    ->label('Contact'),

                Tables\Columns\TextColumn::make('badge_text')
                    ->badge()
                    ->color('success'),

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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'   => Pages\ListCareHomes::route('/'),             // /admin/care-homes
            'create'  => Pages\CreateCareHome::route('/create'),      // /admin/care-homes/create
            'edit'    => Pages\EditCareHome::route('/{record}/edit'), // /admin/care-homes/1/edit
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}